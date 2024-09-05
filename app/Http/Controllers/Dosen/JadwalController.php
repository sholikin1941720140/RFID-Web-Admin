<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $data = DB::table('jadwal_mengajars as jm')
                    ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                    ->where('jm.dosen_id', $auth->id)
                    ->select('jm.id', 'jm.hari', 'mk.nama as mata_kuliah', 'j.nama as jam_ke', 'j.jam_mulai', 'j.jam_selesai')
                    ->orderBy('jm.hari')
                    ->orderBy('j.jam_mulai')
                    ->get();
        // return response()->json($data);
        
        // Mengelompokkan data berdasarkan hari dan mata kuliah
        $groupedData = [];
        foreach ($data as $item) {
            $hari = $item->hari;
            $mataKuliah = $item->mata_kuliah;
    
            if (!isset($groupedData[$hari])) {
                $groupedData[$hari] = [];
            }
    
            if (!isset($groupedData[$hari][$mataKuliah])) {
                $groupedData[$hari][$mataKuliah] = [
                    'id' => $item->id,
                    'mata_kuliah' => $mataKuliah,
                    'jam' => []
                ];
            }
    
            $groupedData[$hari][$mataKuliah]['jam'][] = [
                'jam_ke' => $item->jam_ke,
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai
            ];
        }
        // return response()->json($groupedData);
    
        return view('dashboard.dosen.jadwal', compact('groupedData'));
    }    
}
