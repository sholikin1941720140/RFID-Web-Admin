<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RuanganController extends Controller
{
    public function index()
    {
        $data = DB::table('ruangans')->get();

        return view('dashboard.data-master.ruangan.index', compact('data'));
    }
}
