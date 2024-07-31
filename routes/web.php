<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\AttendanceController;

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

    Route::get('/absensi', [AttendanceController::class, 'index']);

    Route::get('/logout', [LoginController::class, 'logout']);
});