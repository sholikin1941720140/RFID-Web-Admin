<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MataKuliahController extends Controller
{
    public function index()
    {
        $data = DB::table('mata_kuliahs')->get();

        return view('dashboard.data-master.mata-kuliah.index', compact('data'));
    }
}
