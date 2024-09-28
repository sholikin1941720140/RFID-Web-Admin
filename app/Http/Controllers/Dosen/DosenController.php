<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class DosenController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $data = DB::table('jadwal_mengajars as jm')
                    ->join('jadwal_mengajar_items as jmi', 'jm.id', '=', 'jmi.jadwal_mengajar_id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                    ->where('jm.dosen_id', $auth->id)
                    ->select('jm.id', 'jm.hari', 'mk.nama as mata_kuliah', 'mk.kode', 'mk.tahun', 'j.nama as jam_ke', 'j.jam_mulai', 'j.jam_selesai')
                    // ->orderBy('jm.hari')
                    // ->orderBy('j.jam_mulai')
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
                    'kode' => $item->kode,
                    'tahun' => $item->tahun,
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

    public function absen(Request $request)
    {
        Carbon::setLocale('id');

        $tanggal = $request->input('tanggal');
        if($tanggal) {
            $selectedDate = Carbon::parse($tanggal)->format('Y-m-d');
            $hariIni = Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y');
        } else {
            $selectedDate = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $hariIni = Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y');
        }

        $auth = Auth::user();
        $data = DB::table('absensi_dosens as ad')
                    ->join('users as us', 'ad.dosen_id', '=', 'us.id')
                    ->join('jadwal_mengajars as jm', 'ad.jadwal_mengajar_id', '=', 'jm.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->where('jm.dosen_id', $auth->id)
                    ->whereDate('ad.created_at', $selectedDate)
                    ->select('ad.id', 'us.name as dosen', 'mk.nama as mata_kuliah', 'mk.kode', 'mk.tahun', 'jm.hari', 'ad.status', 'ad.jam_masuk', 'ad.jam_keluar', 'ad.created_at')
                    ->get();
        // return response()->json($data);

        $data = $data->map(function ($item) {
            // return response()->json($item);
            if (is_null($item->jam_masuk) && is_null($item->status) || ($item->status == 0)) {
                $item->status = 'Alfa';
            } elseif (!is_null($item->jam_masuk) && ($item->status == 1)) {
                $item->status = 'Hadir';
            }
            return $item;
        });
        // return response()->json($data);

        return view('dashboard.dosen.absensi', compact('data', 'request', 'hariIni'));
    }
}
