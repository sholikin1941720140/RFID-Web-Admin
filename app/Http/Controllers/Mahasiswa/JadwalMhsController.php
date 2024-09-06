<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class JadwalMhsController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        // Ambil data mahasiswa dan jadwalnya
        $data = DB::table('jadwal_mahasiswas as jm')
                    ->join('users as u', 'jm.mahasiswa_id', '=', 'u.id')
                    ->where('jm.mahasiswa_id', $auth->id)
                    ->select('jm.*', 'u.name as mahasiswa')
                    ->get();
        // return response()->json($data);

        // Iterasi untuk setiap jadwal mahasiswa
        foreach ($data as $key => $value) {
            $items = DB::table('jadwal_mahasiswa_items as jmi')
                        ->where('jmi.jadwal_mahasiswa_id', $value->id)
                        ->join('jadwal_mengajars as jm', 'jmi.jadwal_mengajar_id', '=', 'jm.id')
                        ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                        ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                        ->join('jadwal_mengajar_items as jmi_item', 'jmi_item.jadwal_mengajar_id', '=', 'jm.id')
                        ->join('jams as jam', 'jmi_item.jam_id', '=', 'jam.id')
                        ->select('jm.hari', 'u.name as dosen', 'mk.nama as matkul', 'mk.kode', 'mk.tahun', 'jam.nama as jam_nama', 'jam.jam_mulai', 'jam.jam_selesai')
                        // ->orderBy('jm.hari')
                        // ->orderBy('jam.jam_mulai')
                        ->get();
            // return response()->json($items);

            // Kelompokkan berdasarkan hari dan gabungkan dosen dengan mata kuliah
            $groupedByHari = [];
            foreach ($items as $item) {
                // Jika mata kuliah belum ada di dalam array hari, inisialisasi dengan dosen dan array jam kosong
                if (!isset($groupedByHari[$item->hari][$item->matkul])) {
                    $groupedByHari[$item->hari][$item->matkul] = [
                        'dosen' => $item->dosen,
                        'jam' => []
                    ];
                }

                // Masukkan data jam ke dalam array 'jam'
                $groupedByHari[$item->hari][$item->matkul]['jam'][] = [
                    'jam_nama' => $item->jam_nama,
                    'jam_mulai' => $item->jam_mulai,
                    'jam_selesai' => $item->jam_selesai,
                ];
            }

            // Masukkan jadwal yang sudah dikelompokkan ke dalam data mahasiswa
            $data[$key]->jadwal = $groupedByHari;
        }
        // return response()->json($data);

        return view('dashboard.mahasiswa.jadwal', compact('data'));
    }
}
