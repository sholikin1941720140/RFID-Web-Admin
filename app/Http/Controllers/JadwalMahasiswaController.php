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
                    // ->join('users as u', 'jm.mahasiswa_id', '=', 'u.id')
                    // ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    // ->join('jadwal_mengajars as jma', 'jm.jadwal_mengajar_id', '=', 'jma.id')
                    // ->join('users as d', 'jma.dosen_id', '=', 'd.id')
                    // ->select('jm.*', 'u.name as mahasiswa', 'mk.nama as matkul', 'mk.kode', 'mk.tahun', 'd.name as dosen')
                    ->orderBy('jm.created_at', 'DESC')
                    ->get();
                    // return response()->json($data);

        return view('dashboard.jadwal-mahasiswa.index', compact('data'));
    }

    public function create()
    {
        $data = DB::table('jadwal_mengajars as jm')
            ->join('users as u', 'jm.dosen_id', '=', 'u.id')
            ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
            ->select('jm.*', 'u.name as dosen', 'mk.nama as matkul', 'mk.kode', 'mk.tahun')
            ->get();

        foreach($data as $key => $value)
        {
            $items = DB::table('jadwal_mengajar_items as jmi')
                        ->where('jmi.jadwal_mengajar_id', $value->id)
                        ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                        ->select('jmi.*', 'j.nama', 'j.jam_mulai', 'j.jam_selesai')
                        ->get()
                        ->groupBy('jadwal_mengajar_id');

            $items = json_decode(json_encode($items), true);
            $data[$key]->jam = $items;
        }

        return response()->json($data);
        $mahasiswa = DB::table('users')
                        ->where('role', 'mahasiswa')
                        ->get();
                    return response()->json($mahasiswa);

        return view('dashboard.jadwal-mahasiswa.create');
    }
}
