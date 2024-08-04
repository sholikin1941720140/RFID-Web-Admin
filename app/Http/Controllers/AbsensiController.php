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
        $currentDate = Carbon::now()->toDateString();

        // Ambil data jadwal dan absensi
        $jadwal = DB::table('jadwal_mengajars as jm')
            ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
            ->join('users as us', 'jm.dosen_id', '=', 'us.id')
            ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
            ->join('ruangans as ru', 'jm.ruangan_id', '=', 'ru.id')
            ->leftJoin('absensis as ab', function($join) use ($currentDate) {
                $join->on('us.id', '=', 'ab.user_id')
                    ->whereDate('ab.created_at', '=', $currentDate);
            })
            ->select('jm.id', 'us.name as dosen', 'mk.nama as mata_kuliah', 'ru.nama as ruangan', 'jmi.jam_mulai', 'jmi.jam_selesai', 'ab.status')
            ->orderBy('jm.id')
            ->get();
    
        // Susun data dalam format yang sesuai
        $data = [];
        foreach ($jadwal as $item) {
            $data[$item->dosen][$item->mata_kuliah][] = [
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai,
                'status' => $item->status
            ];
        }
    
        return response()->json($data);

        return view('dashboard.absensi.index', compact('data'));
    }
}
