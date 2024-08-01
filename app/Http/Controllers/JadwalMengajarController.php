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
                ->join('ruangans as r', 'jm.ruangan_id', '=', 'r.id')
                ->select('jm.*', 'u.name as dosen', 'mk.nama as matkul', 'r.nama as ruangan')
                ->orderBy('jm.created_at', 'DESC')
                ->get();
        $data = json_decode(json_encode($data), true);
        foreach ($data as $key => $value) {
        $items = DB::table('jadwal_mengajar_items as jmi')
                    ->where('jmi.jadwal_mengajar_id', $value['id'])
                    ->select('jmi.jam_mulai', 'jmi.jam_selesai')
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
        $ruangan = DB::table('ruangans')->get();
        $dosen = DB::table('users')->where('role', 'dosen')->get();

        return view('dashboard.jadwal-mengajar.create', compact('matkul', 'ruangan', 'dosen'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $jmId = DB::table('jadwal_mengajars')->insertGetId([
            'mata_kuliah_id' => $request->matkul,
            'ruangan_id' => $request->ruangan,
            'dosen_id' => $request->dosen,
            'hari' => $request->hari,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        foreach($request->jam_mulai as $key => $value) {
            DB::table('jadwal_mengajar_items')->insert([
                'jadwal_mengajar_id' => $jmId,
                'jam_mulai' => $request->jam_mulai[$key],
                'jam_selesai' => $request->jam_selesai[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }

        return redirect('/jadwal/jadwal-mengajar')->with('success', 'Data jadwal berhasil ditambahkan!');
    }
}
