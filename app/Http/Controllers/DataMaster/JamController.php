<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class JamController extends Controller
{
    public function index()
    {
        $data = DB::table('jams')->get();

        return view('dashboard.data-master.jam.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('jams')->insert([
            'nama' => $request->nama,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'created_at' => $created_at,
            'updated_at' => $created_at
        ]);

        return redirect('/data-master/jam')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $data = DB::table('jams')->where('id', $id)->update([
            'nama' => $request->nama,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'updated_at' => $createdAt
        ]);

        return redirect('/data-master/jam')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        DB::table('jams')->where('id', $id)->delete();

        return redirect('/data-master/jam')->with('success', 'Data berhasil dihapus');
    }
}
