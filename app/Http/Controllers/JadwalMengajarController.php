<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class JadwalMengajarController extends Controller
{
    public function index()
    {
        $data = DB::table('jadwal_mengajars as jm')
                    ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->select('jm.*', 'u.name as dosen', 'mk.nama as matkul', 'mk.kode', 'mk.tahun')
                    ->orderBy('jm.created_at', 'ASC')
                    ->get();
                    // return response()->json($data);
        $data = json_decode(json_encode($data), true);
        foreach ($data as $key => $value) {
            $items = DB::table('jadwal_mengajar_items as jmi')
                        ->where('jmi.jadwal_mengajar_id', $value['id'])
                        ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                        ->select('jmi.*', 'j.nama', 'j.jam_mulai', 'j.jam_selesai')
                        ->get();

            $items = json_decode(json_encode($items), true);
            $data[$key]['jam'] = $items;
        }
        // return response()->json($data);
        return view('dashboard.jadwal-mengajar.index', compact('data'));
    }

    public function create()
    {
        $matkul = DB::table('mata_kuliahs')->get();
        $jam = DB::table('jams')->get();
        $dosen = DB::table('users')->where('role', 'dosen')->get();

        return view('dashboard.jadwal-mengajar.create', compact('matkul', 'jam', 'dosen'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $jmId = DB::table('jadwal_mengajars')->insertGetId([
            'mata_kuliah_id' => $request->matkul,
            'dosen_id' => $request->dosen,
            'hari' => $request->hari,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        foreach($request->jam as $key => $value) {
            DB::table('jadwal_mengajar_items')->insert([
                'jadwal_mengajar_id' => $jmId,
                'jam_id' => $request->jam[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }

        return redirect('/jadwal/jadwal-mengajar')->with('success', 'Data jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = DB::table('jadwal_mengajars as jm')
                    ->join('users as u', 'jm.dosen_id', '=', 'u.id')
                    ->join('mata_kuliahs as mk', 'jm.mata_kuliah_id', '=', 'mk.id')
                    ->select('jm.*', 'u.name as dosen', 'mk.nama as matkul', 'mk.kode', 'mk.tahun')
                    ->where('jm.id', $id)
                    ->first();
                    // return response()->json($data);
        $data = json_decode(json_encode($data), true);
        $items = DB::table('jadwal_mengajar_items as jmi')
                    ->where('jmi.jadwal_mengajar_id', $data['id'])
                    ->join('jams as j', 'jmi.jam_id', '=', 'j.id')
                    ->select('jmi.*', 'j.nama', 'j.jam_mulai', 'j.jam_selesai')
                    ->get();

        $items = json_decode(json_encode($items), true);
        $data['jam'] = $items;
        // return response()->json($data);

        $matkul = DB::table('mata_kuliahs')->get();
        $jam = DB::table('jams')->get();
        $dosen = DB::table('users')->where('role', 'dosen')->get();

        return view('dashboard.jadwal-mengajar.edit', compact('data', 'matkul', 'jam', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        // return response()->json($request->all());
        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('jadwal_mengajar_items')->where('jadwal_mengajar_id', $id)->delete();
        foreach($request->jam as $key => $value) {
            DB::table('jadwal_mengajar_items')->insertGetId([
                'jadwal_mengajar_id' => $request->jadwal_mengajar_id,
                'jam_id' => $request->jam[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }
        DB::table('jadwal_mengajars')->where('id', $id)->update([
            'mata_kuliah_id' => $request->matkul,
            'dosen_id' => $request->dosen,
            'hari' => $request->hari,
            'updated_at' => $created_at,
        ]);

        return redirect('/jadwal/jadwal-mengajar')->with('success', 'Data jadwal berhasil diubah!');
    }

    public function delete($id)
    {
        DB::table('jadwal_mengajars')->where('id', $id)->delete();
        DB::table('jadwal_mengajar_items')->where('jadwal_mengajar_id', $id)->delete();

        return redirect('/jadwal/jadwal-mengajar')->with('success', 'Data jadwal berhasil dihapus!');
    }
}
