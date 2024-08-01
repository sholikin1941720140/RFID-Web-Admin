<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $data = Attendance::orderBy('created_at', 'desc')->get();

        return view('dashboard.absensi.index', compact('data'));
    }
}
