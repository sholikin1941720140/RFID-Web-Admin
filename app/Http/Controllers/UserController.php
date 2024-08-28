<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('users')->get();

        return view('dashboard.user.index', compact('data'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'role' => 'required',
            'username' => 'required',
            'nama' => 'required',
        ]);

        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('users')->insert([
            'role' => $request->role,
            'uid' => $request->uid,
            'nomor' => $request->nomor,
            'username' => $request->username,
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
            'username' => 'required',
            'nama' => 'required'
        ]);

        $updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('users')->where('id', $id)->update([
            'role' => $request->role,
            'uid' => $request->uid,
            'nomor' => $request->nomor,
            'username' => $request->username,
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'updated_at' => $updated_at,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah!');
    }

    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/user')->with('success', 'Data user berhasil dihapus!');
    }
}
