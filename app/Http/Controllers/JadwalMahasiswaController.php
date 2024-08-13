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
                ->select('jm.*', 'u.name as mahasiswa')
                ->get();

    foreach ($data as $key => $value) {
        $items = DB::table('jadwal_mahasiswa_items as jmi')
                    ->where('jmi.jadwal_mahasiswa_id', $value->id)
                    ->join('jadwal_mengajars as jm', 'jmi.jadwal_mengajar_id', '=', 'jm.id')
                    ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->join('jadwal_mengajar_items as jmi_item', 'jmi_item.jadwal_mengajar_id', '=', 'jm.id')
                    ->join('jams as jam', 'jmi_item.jam_id', '=', 'jam.id')
                    ->select('jm.hari', 'u.name as dosen', 'mk.nama as matkul', 'mk.kode', 'mk.tahun', 'jam.nama as jam_nama', 'jam.jam_mulai', 'jam.jam_selesai')
                    ->get();

        // Group by hari
        $groupedByHari = [];
        foreach ($items as $item) {
            $groupedByHari[$item->hari][$item->matkul][] = [
                'dosen' => $item->dosen,
                'jam_nama' => $item->jam_nama,
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai,
            ];
        }

        $data[$key]->jadwal = $groupedByHari;
    }

        // return response()->json($data);

        return view('dashboard.jadwal-mahasiswa.index', compact('data'));
    }

    public function create()
    {        
        $mahasiswa = DB::table('users')
                        ->where('role', 'mahasiswa')
                        ->get();
                    // return response()->json($mahasiswa);

        return view('dashboard.jadwal-mahasiswa.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        if(!$request->hari)
        {
            return redirect()->back()->with('error', 'Jadwal Mengajar tidak boleh kosong');
        }
        if(!$request->mahasiswa)
        {
            return redirect()->back()->with('error', 'Mahasiswa tidak boleh kosong');
        }

        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $jmId = DB::table('jadwal_mahasiswas')->insertGetId([
            'mahasiswa_id' => $request->mahasiswa,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        foreach($request->jadwal_mengajar_id as $key => $value)
        {
            DB::table('jadwal_mahasiswa_items')->insert([
                'jadwal_mahasiswa_id' => $jmId,
                'jadwal_mengajar_id' => $request->jadwal_mengajar_id[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }

        return redirect('/jadwal/jadwal-mahasiswa')->with('success', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        DB::table('jadwal_mahasiswas')->where('id', $id)->delete();
        DB::table('jadwal_mahasiswa_items')->where('jadwal_mahasiswa_id', $id)->delete();

        return redirect('/jadwal/jadwal-mahasiswa')->with('success', 'Data berhasil dihapus');
    }

    public function getJadwal(Request $request)
    {
        $hari = $request->hari;
        // return response()->json($hari);
        $data = DB::table('jadwal_mengajars as jm')
                    ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->where('jm.hari', $hari)
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
    }
}
