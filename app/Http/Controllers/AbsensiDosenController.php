<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AbsensiDosenController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
    
        // Cek apakah ada parameter 'tanggal' dalam request
        $tanggal = $request->input('tanggal');
        
        if ($tanggal) {
            $selectedDate = Carbon::parse($tanggal)->format('Y-m-d');
            $hariIni = Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y');
        } else {
            $selectedDate = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $hariIni = Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y');
        }
    
        // Ambil data jam
        $jam = DB::table('jams')->get();
    
        // Query untuk mengambil data absensi dosen berdasarkan tanggal
        $data = DB::table('jadwal_mengajar_items as jmi')
                    ->join('jadwal_mengajars as jm', 'jmi.jadwal_mengajar_id', '=', 'jm.id')
                    ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->leftJoin('absensi_dosens as ad', function($join) use ($selectedDate) {
                        $join->on('jm.id', '=', 'ad.jadwal_mengajar_id')
                            ->whereDate('ad.created_at', $selectedDate);
                    })
                    ->where('jm.hari', Carbon::parse($selectedDate)->translatedFormat('l'))
                    ->select('u.name as dosen', 'mk.nama as matkul', 'jmi.jam_id', 'ad.status', 'ad.jam_masuk', 'ad.jam_keluar')
                    ->get()
                    ->groupBy(['dosen', 'matkul']);
        // return response()->json($data);
    
        // Proses data untuk menambahkan status yang tepat
        $processedData = $data->map(function ($matkulGroups) use ($selectedDate) {
            return $matkulGroups->map(function ($groupedData) use ($selectedDate) {
                return $groupedData->map(function ($item) use ($selectedDate) {
                    if (is_null($item->jam_masuk) && is_null($item->status)) {
                        // Jika tanggal yang dipilih adalah hari ini atau masa lalu, tampilkan "Alfa"
                        if (Carbon::parse($selectedDate)->isPast() || Carbon::parse($selectedDate)->isToday()) {
                            $item->status = 'Alfa';
                        } else {
                            // Jika tanggal yang dipilih adalah masa depan, tampilkan "Belum Ada Absensi"
                            $item->status = 'Belum Ada Absensi';
                        }
                    } elseif (!is_null($item->jam_masuk)) {
                        $item->status = 'Hadir';
                    }
                    return $item;
                });
            });
        });
        // return response()->json($processedData);
        // Kembalikan data ke view
        return view('dashboard.absensi-dosen.index', compact('processedData', 'jam', 'hariIni', 'request', 'selectedDate'));
    }
}
