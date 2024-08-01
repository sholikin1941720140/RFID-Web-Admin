<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RfidController extends Controller
{
    public function store(Request $request)
    {
        // Request UID dari Arduino
        $uid = $request->query('uid');

        // Cek apakah UID ada
        if (!$uid) {
            return response()->json(['status' => 'error', 'message' => 'UID tidak terdeteksi'], 400);
        }

        // Cek apakah UID ada di database
        $user = User::where('uid', $uid)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Kartu belum terdaftar'], 404);
        }

        // Pengambilan nama dan waktu
        $nama = $user->name;
        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $currentTime = Carbon::now('Asia/Jakarta')->format('H:i:s');
        $currentDay = Carbon::now('Asia/Jakarta')->format('l'); // Hari dalam format penuh, misalnya 'Monday'

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

            if (!$jadwal) {
                return response()->json(['status' => 'error', 'message' => 'Tidak ada jadwal mengajar saat ini atau di luar jam mengajar'], 400);
            }
        }

        // Simpan data absen
        $absen = new Attendance();
        $absen->user_id = $user->id;
        $absen->created_at = $created_at;
        $absen->updated_at = $created_at;
        $absen->save();

        // Pesan sukses untuk Arduino
        return response()->json(['status' => 'success', 'message' => $nama . ' berhasil absen']);
    }
}

