<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KelasController extends Controller
{
    public function index()
    {
        $data = DB::table('kelas')->get();

        return view('dashboard.data-master.kelas.index', compact('data'));
    }
}
