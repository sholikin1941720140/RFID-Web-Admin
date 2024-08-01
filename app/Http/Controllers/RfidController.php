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
        //request uid dari arduino
        $uid = $request->query('uid');

        //cek apakah uid ada
        if (!$uid) {
            return response()->json(['status' => 'error', 'message' => 'UID tidak terdeteksi'], 400);
        }

        //cek apakah uid ada di database
        $user = User::where('uid', $uid)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Kartu belum terdaftar'], 404);
        }

        //pengambilan nama dan waktu
        $nama = $user->name;
        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        // $today = Carbon::today();
        // $absenHariIni = Attendance::where('user_id', $user->id)->whereDate('created_at', $today)->first();
        // if ($absenHariIni) {
        //     return response()->json(['status' => 'already_absent', 'message' => $nama . ' sudah absen']);
        // }

        //simpan data absen
        $absen = new Attendance();
        $absen->user_id = $user->id;
        $absen->created_at = $created_at;
        $absen->updated_at = $created_at;
        $absen->save();

        //pesan sukses untuk arduino
        return response()->json(['status' => 'success', 'message' => $nama . ' berhasil absen']);
    }
}
