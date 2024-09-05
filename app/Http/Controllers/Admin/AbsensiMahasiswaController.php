<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AbsensiMahasiswaController extends Controller
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

        // Query untuk mengambil data absensi mahasiswa berdasarkan tanggal
        $data = DB::table('jadwal_mahasiswa_items as jmi')
                    ->join('jadwal_mahasiswas as jm', 'jmi.jadwal_mahasiswa_id', '=', 'jm.id')
                    ->join('jadwal_mengajars as jme', 'jmi.jadwal_mengajar_id', '=', 'jme.id')
                    ->join('jadwal_mengajar_items as jmei', 'jme.id', '=', 'jmei.jadwal_mengajar_id')
                    ->join('users as u', 'jm.mahasiswa_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jme.mata_kuliah_id', '=', 'mk.id')
                    ->leftJoin('absensi_mahasiswas as am', function($join) use ($selectedDate) {
                        $join->on('jme.id', '=', 'am.jadwal_mengajar_id')
                            ->whereDate('am.created_at', $selectedDate);
                    })
                    ->where('jme.hari', Carbon::parse($selectedDate)->translatedFormat('l'))
                    ->select('u.name as mahasiswa', 'mk.nama as matkul', 'jmei.jam_id', 'am.status', 'am.jam_masuk', 'am.jam_keluar')
                    ->get()
                    ->groupBy(['mahasiswa', 'matkul']);
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

        return view('dashboard.absensi-mahasiswa.index', compact('processedData', 'jam', 'selectedDate', 'hariIni', 'request'));
    }
}
