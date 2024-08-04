<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use DB;

class RfidController extends Controller
{
    public function store(Request $request)
    {
        // Request UID dari Arduino
        $uid = $request->query('uid');
        Carbon::setLocale('id');
        $now = Carbon::now()->translatedFormat('l');
        // Cek apakah UID ada
        if (!$uid) {
            return response()->json([
                'status' => 'error', 
                'message' => 'UID tidak terdeteksi', 
                'uid' => $uid,
                'time' => $now
            ], 400);
        }

        // Cek apakah UID ada di database
        $user = User::where('uid', $uid)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Kartu belum terdaftar'
            ], 404);
        }

        // Pengambilan nama dan waktu
        $nama = $user->name;
        $created_at = Carbon::now()->format('Y-m-d H:i:s');
        $currentTime = Carbon::now()->format('H:i:s');
        $currentDay = Carbon::now()->translatedFormat('l'); // Hari dalam format penuh, misalnya 'Monday'

        // Cek apakah user adalah dosen
        if ($user->role == 'dosen') {
            // Cek apakah dosen memiliki jadwal pada hari ini
            $jadwal = DB::table('jadwal_mengajars as jm')
                        ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
                        ->where('jm.dosen_id', $user->id)
                        ->where('jm.hari', $currentDay)
                        ->whereTime('jmi.jam_mulai', '<=', $currentTime)
                        ->whereTime('jmi.jam_selesai', '>=', $currentTime)
                        ->first();
            // return response()->json($jadwal);

            if (!$jadwal) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Tidak ada jadwal mengajar saat ini atau di luar jam mengajar'
                ], 400);
            }

            // Cek apakah dosen sudah pernah absen pada jadwal ini
            $absenSebelumnya = Absensi::where('user_id', $user->id)
                                    ->where('created_at', '>=', Carbon::now()->startOfDay())
                                    ->where('created_at', '<=', Carbon::now()->endOfDay())
                                    ->whereTime('jam_masuk', '>=', $jadwal->jam_mulai)
                                    ->whereTime('jam_masuk', '<=', $jadwal->jam_selesai)
                                    ->exists();

            if ($absenSebelumnya) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Anda sudah absen sebelumnya pada jadwal ini'
                ], 400);
            }

            // Simpan data absen
            $absen = new Absensi();
            $absen->user_id = $user->id;
            $absen->jam_masuk = $currentTime;
            $absen->status = true;
            $absen->created_at = $created_at;
            $absen->updated_at = $created_at;
            $absen->save();

            // Pesan sukses untuk Arduino
            return response()->json([
                'status' => 'success', 
                'message' => $nama . ' berhasil absen'
            ]);
        }
    }
}

