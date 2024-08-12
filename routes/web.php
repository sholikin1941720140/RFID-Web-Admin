<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DataMaster\JamController;
use App\Http\Controllers\DataMaster\KelasController;
use App\Http\Controllers\DataMaster\MataKuliahController;
use App\Http\Controllers\JadwalMengajarController;
use App\Http\Controllers\JadwalMahasiswaController;

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

    //data master jam
    Route::get('/data-master/jam', [JamController::class, 'index']);
    Route::post('/data-master/jam/store', [JamController::class, 'store']);
    Route::get('/data-master/jam/update/{id}', [JamController::class, 'update']);
    Route::get('/data-master/jam/delete/{id}', [JamController::class, 'delete']);

    Route::get('/data-master/kelas', [KelasController::class, 'index']);
    Route::get('/data-master/matkul', [MataKuliahController::class, 'index']);

    //data jadwal mengajar dosen
    Route::get('/jadwal/jadwal-mengajar', [JadwalMengajarController::class, 'index']);
    Route::get('/jadwal/jadwal-mengajar/create', [JadwalMengajarController::class, 'create']);
    Route::post('/jadwal/jadwal-mengajar/store', [JadwalMengajarController::class, 'store']);
    Route::get('/jadwal/jadwal-mengajar/edit/{id}', [JadwalMengajarController::class, 'edit']);
    Route::post('/jadwal/jadwal-mengajar/update/{id}', [JadwalMengajarController::class, 'update']);
    Route::get('/jadwal/jadwal-mengajar/delete/{id}', [JadwalMengajarController::class, 'delete']);

    //data jadwal mahasiswa
    Route::get('/jadwal/jadwal-mahasiswa', [JadwalMahasiswaController::class, 'index']);
    Route::get('/jadwal/jadwal-mahasiswa/create', [JadwalMahasiswaController::class, 'create']);
    Route::post('/jadwal/jadwal-mahasiswa/store', [JadwalMahasiswaController::class, 'store']);
    Route::get('/jadwal/jadwal-mahasiswa/edit/{id}', [JadwalMahasiswaController::class, 'edit']);
    Route::post('/jadwal/jadwal-mahasiswa/update/{id}', [JadwalMahasiswaController::class, 'update']);
    Route::get('/jadwal/jadwal-mahasiswa/delete/{id}', [JadwalMahasiswaController::class, 'delete']);

    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
});