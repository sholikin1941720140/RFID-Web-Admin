<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class JadwalMahasiswaController extends Controller
{
    public function index()
    {
        $data = DB::table('jadwal_mahasiswas as jm')
                    ->join('users as u', 'jm.mahasiswa_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->join('jadwal_mengajars as jma', 'jm.jadwal_mengajar_id', '=', 'jma.id')
                    ->join('users as d', 'jma.dosen_id', '=', 'd.id')
                    ->select('jm.*', 'u.name as mahasiswa', 'mk.nama as matkul', 'mk.kode', 'mk.tahun', 'd.name as dosen')
                    ->orderBy('jm.created_at', 'DESC')
                    ->get();
                    return response()->json($data);

        return view('dashboard.jadwal-mahasiswa.index');
    }
}
