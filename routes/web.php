<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\Admin\AbsensiDosenController;
use App\Http\Controllers\Admin\AbsensiMahasiswaController;
use App\Http\Controllers\DataMaster\JamController;
use App\Http\Controllers\DataMaster\MataKuliahController;
use App\Http\Controllers\Admin\JadwalMengajarController;
use App\Http\Controllers\Admin\JadwalMahasiswaController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Dosen\JadwalDsnController;
use App\Http\Controllers\Mahasiswa\JadwalMhsController;

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

    //get-api
    Route::get('/get-api', [ApiController::class, 'getApiData']);

    //get-jadwal
    Route::get('/get-jadwal', [ApiController::class, 'getJadwal']);

    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);

    //data master jam
    Route::get('/data-master/jam', [JamController::class, 'index']);
    Route::post('/data-master/jam/store', [JamController::class, 'store']);
    Route::post('/data-master/jam/update/{id}', [JamController::class, 'update']);
    Route::get('/data-master/jam/delete/{id}', [JamController::class, 'delete']);

    Route::get('/data-master/matkul', [MataKuliahController::class, 'index']);
    Route::post('/data-master/matkul/store', [MataKuliahController::class, 'store']);
    Route::post('/data-master/matkul/update/{id}', [MataKuliahController::class, 'update']);
    Route::get('/data-master/matkul/delete/{id}', [MataKuliahController::class, 'delete']);

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
    Route::post('/get-jadwal', [JadwalMahasiswaController::class, 'getJadwal']);

    //absensi dosen
    Route::get('/absensi/dosen', [AbsensiDosenController::class, 'index']);

    //absensi mahasiswa
    Route::get('/absensi/mahasiswa', [AbsensiMahasiswaController::class, 'index']);

    //dosen
    Route::get('/dosen-jadwal', [JadwalDsnController::class, 'index']);

    //mahasiswa
    Route::get('/mahasiswa-jadwal', [JadwalMhsController::class, 'index']);

    Route::get('/logout', [LoginController::class, 'logout']);
});