<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        $data = Absensi::join('users as us', 'absensis.user_id', '=', 'us.id')
            // ->join('jadwal_mengajars as jm', 'absensis.jadwal_mengajar_id', '=', 'jm.id')
            // ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
            // ->join('ruangans as ru', 'jm.ruangan_id', '=', 'ru.id')
            ->select('us.name', 'absensis.jam_masuk', 'absensis.jam_keluar')
            ->orderBy('absensis.created_at', 'desc')
            ->get();

        return view('dashboard.absensi.index', compact('data'));
    }
}
