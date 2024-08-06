<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DataMaster\RuanganController;
use App\Http\Controllers\DataMaster\KelasController;
use App\Http\Controllers\DataMaster\MataKuliahController;
use App\Http\Controllers\JadwalMengajarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-user', [LoginController::class, 'loginUser']);
Route::get('/rfid-data', [RfidController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard']);

    //data master
    Route::get('/data-master/ruangan', [RuanganController::class, 'index']);
    Route::get('/data-master/kelas', [KelasController::class, 'index']);
    Route::get('/data-master/matkul', [MataKuliahController::class, 'index']);

    //data jadwal
    Route::get('/jadwal/jadwal-mengajar', [JadwalMengajarController::class, 'index']);
    Route::get('/jadwal/jadwal-mengajar/create', [JadwalMengajarController::class, 'create']);
    Route::post('/jadwal/jadwal-mengajar/store', [JadwalMengajarController::class, 'store']);
    // Route::get('/jadwal/jadwal-mengajar/edit/{id}', [JadwalMengajarController::class, 'edit']);
    // Route::post('/jadwal/jadwal-mengajar/update/{id}', [JadwalMengajarController::class, 'update']);
    Route::get('/jadwal/jadwal-mengajar/delete/{id}', [JadwalMengajarController::class, 'delete']);

    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
});