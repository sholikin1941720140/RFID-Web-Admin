<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AbsensiDosenController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $now = Carbon::now()->translatedFormat('l');
        $jam = DB::table('jams')->get();
    
        $data = DB::table('jadwal_mengajar_items as jmi')
                    ->join('jadwal_mengajars as jm', 'jmi.jadwal_mengajar_id', '=', 'jm.id')
                    ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->leftJoin('absensi_dosens as ad', function($join) {
                        $join->on('jm.id', '=', 'ad.jadwal_mengajar_id')
                            ->whereDate('ad.created_at', Carbon::now('Asia/Jakarta')->toDateString());
                    })
                    ->where('jm.hari', $now)
                    ->select('u.name as dosen', 'mk.nama as matkul', 'jmi.jam_id', 'ad.status', 'ad.jam_masuk', 'ad.jam_keluar')
                    ->get()
                    ->groupBy(['dosen', 'matkul']);
        // return response()->json($data);

        return view('dashboard.absensi-dosen.index', compact('data', 'jam'));
    }
}
