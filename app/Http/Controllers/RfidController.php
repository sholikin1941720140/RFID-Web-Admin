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
                'code' => 0,
                'uid' => $uid,
                'time' => $now
            ], 400);
        }
    
        // Cek apakah UID ada di database
        $user = User::where('uid', $uid)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Kartu belum terdaftar',
                'code' => 1
            ], 404);
        }
    
        // Pengambilan nama dan waktu
        $nama = $user->name;
        $created_at = Carbon::now()->format('Y-m-d H:i:s');
        $currentTime = Carbon::now()->format('H:i:s');
        $currentDay = Carbon::now()->translatedFormat('l'); // Hari dalam format penuh, misalnya 'Monday'
    
        if ($user->role == 'dosen') {
            // Cek apakah dosen memiliki jadwal pada hari ini
            $jadwal = DB::table('jadwal_mengajars as jm')
                        ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
                        ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                        ->where('jm.hari', $currentDay)
                        ->where('jm.dosen_id', $user->id)
                        ->whereTime('j.jam_mulai', '<=', $currentTime)
                        ->whereTime('j.jam_selesai', '>=', $currentTime)
                        ->select('jm.id as jadwal_mengajar_id', 'j.jam_mulai', 'j.jam_selesai')
                        ->first();
                        // return response()->json($jadwal);

            // Jika tidak ada jadwal maka mengirim pesan ini
            if (!$jadwal) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Tidak ada jadwal',
                    'code' => 2
                ], 400);
            }

            // Cek apakah dosen sudah pernah absen pada jadwal ini
            $absen = DB::table('absensi_dosens')
                        ->where('dosen_id', $user->id)
                        ->where('jadwal_mengajar_id', $jadwal->jadwal_mengajar_id)
                        ->whereDate('created_at', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                        ->first();

            if ($absen && $absen->jam_masuk && !$absen->jam_keluar) {
                // Jika sudah absen masuk, lakukan absen keluar
                DB::table('absensi_dosens')
                    ->where('id', $absen->id)
                    ->update(['jam_keluar' => $currentTime]);

                return response()->json([
                    'status' => 'success', 
                    'message' => $nama . ' berhasil absen keluar',
                    'code' => 4
                ]);
            } elseif ($absen && $absen->jam_masuk && $absen->jam_keluar) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Anda sudah absen keluar',
                    'code' => 4
                ], 400);
            } else {
                // Simpan data absen masuk
                DB::table('absensi_dosens')->insert([
                    'dosen_id' => $user->id,
                    'jadwal_mengajar_id' => $jadwal->jadwal_mengajar_id,
                    'jam_masuk' => $currentTime,
                    'status' => true,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ]);

                return response()->json([
                    'status' => 'success', 
                    'message' => $nama . ' berhasil absen masuk',
                    'code' => 3
                ]);
            }
        } elseif ($user->role == 'mahasiswa') {
            // Cek jadwal mahasiswa
            $jadwalMahasiswa = DB::table('jadwal_mahasiswas as jma')
                                    ->join('jadwal_mahasiswa_items as jmai', 'jma.id', '=', 'jmai.jadwal_mahasiswa_id')
                                    ->join('jadwal_mengajars as jm', 'jmai.jadwal_mengajar_id', '=', 'jm.id')
                                    ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
                                    ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                                    ->where('jm.hari', $currentDay)
                                    ->where('jma.mahasiswa_id', $user->id)
                                    ->whereTime('j.jam_mulai', '<=', $currentTime)
                                    ->whereTime('j.jam_selesai', '>=', $currentTime)
                                    ->select('jm.id as jadwal_mengajar_id', 'j.jam_mulai', 'j.jam_selesai', 'jm.dosen_id')
                                    ->first();
                                    // return response()->json($jadwalMahasiswa);

            if (!$jadwalMahasiswa) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Tidak ada jadwal',
                    'code' => 2
                ], 400);
            }

            // Cek apakah dosen sudah absen
            $dosenSudahAbsen = DB::table('absensi_dosens')
                                ->where('dosen_id', $jadwalMahasiswa->dosen_id)
                                ->where('jadwal_mengajar_id', $jadwalMahasiswa->jadwal_mengajar_id)
                                ->whereDate('created_at', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                                ->exists();
                                // return response()->json($dosenSudahAbsen);

            if (!$dosenSudahAbsen) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Dosen belum absen, silakan coba lagi nanti',
                    'code' => 2
                ], 400);
            }

            // Cek apakah mahasiswa sudah absen masuk
            $absen = DB::table('absensi_mahasiswas')
                        ->where('mahasiswa_id', $user->id)
                        ->where('jadwal_mengajar_id', $jadwalMahasiswa->jadwal_mengajar_id)
                        ->whereDate('created_at', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                        ->first();

            if ($absen && $absen->jam_masuk && !$absen->jam_keluar) {
                // Jika sudah absen masuk, lakukan absen keluar
                DB::table('absensi_mahasiswas')
                    ->where('id', $absen->id)
                    ->update(['jam_keluar' => $currentTime]);

                return response()->json([
                    'status' => 'success', 
                    'message' => 'Mahasiswa ' . $nama . ' berhasil absen keluar',
                    'code' => 4
                ]);
            } elseif ($absen && $absen->jam_masuk && $absen->jam_keluar) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Anda sudah absen keluar',
                    'code' => 4
                ], 400);
            } else {
                // Simpan data absen masuk
                DB::table('absensi_mahasiswas')->insert([
                    'mahasiswa_id' => $user->id,
                    'jadwal_mengajar_id' => $jadwalMahasiswa->jadwal_mengajar_id,
                    'jam_masuk' => $currentTime,
                    'status' => true,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ]);

                return response()->json([
                    'status' => 'success', 
                    'message' => 'Mahasiswa ' . $nama . ' berhasil absen masuk',
                    'code' => 3
                ]);
            }
        }
    }
}
