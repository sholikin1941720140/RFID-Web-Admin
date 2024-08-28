<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class MataKuliahController extends Controller
{
    public function index()
    {
        $data = DB::table('mata_kuliahs')->get();

        return view('dashboard.data-master.mata-kuliah.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
        ]);

        DB::table('mata_kuliahs')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tahun' => $request->tahun,
        ]);

        return redirect('/data-master/matkul')->with('success', 'Data Mata Kuliah Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
        ]);

        DB::table('mata_kuliahs')->where('id', $id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tahun' => $request->tahun,
        ]);

        return redirect('/data-master/matkul')->with('success', 'Data Mata Kuliah Berhasil Diubah!');
    }

    public function delete($id)
    {
        DB::table('mata_kuliahs')->where('id', $id)->delete();

        return redirect('/data-master/matkul')->with('success', 'Data Mata Kuliah Berhasil Dihapus!');
    }
}
