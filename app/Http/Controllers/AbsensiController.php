<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;
use DB;

class AbsensiController extends Controller
{
    public function index()
    {
        $jadwal = DB::table('jadwal_mengajars as jm')
                        ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
                        ->join('users as us', 'jm.dosen_id', '=', 'us.id')
                        ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                        ->join('ruangans as ru', 'jm.ruangan_id', '=', 'ru.id')
                        ->leftJoin('absensis as ab', 'us.id', '=', 'ab.user_id')
                        ->select(
                            'jm.id', 
                            'us.name as dosen', 
                            'mk.nama as mata_kuliah', 
                            'ru.nama as ruangan', 
                            'jmi.jam_mulai', 
                            'jmi.jam_selesai', 
                            DB::raw('MAX(ab.status) as status')
                        )
                        ->groupBy(
                            'jm.id', 
                            'us.name', 
                            'mk.nama', 
                            'ru.nama', 
                            'jmi.jam_mulai', 
                            'jmi.jam_selesai'
                        )
                        ->orderBy('jm.id')
                        ->get();
        // return response()->json($jadwal);

        $data = [];
        foreach ($jadwal as $item) {
            $data[$item->dosen][$item->mata_kuliah][] = [
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai,
                'status' => $item->status
            ];
        }
        // return response()->json($data);

        return view('dashboard.absensi.index', compact('data'));
    }
    
}
