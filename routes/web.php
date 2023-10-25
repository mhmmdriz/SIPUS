<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\TransaksiController;

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

Route::middleware('guest')->group(function () {
    Route::post('/login', [LoginController::class,'authenticate']);
    Route::get('/login', [LoginController::class,'index'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::post('/logout', [LoginController::class,'logout']);
    
    Route::resource('/buku', BukuController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/anggota', AnggotaController::class);
    Route::resource('/pengembalian', TransaksiController::class);
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayatTransaksi']);
    
    Route::post('/sidebar', [PreferenceController::class, 'sidebarCookie'])->name("sidebar");
    Route::post('/theme', [PreferenceController::class, 'themeCookie'])->name("theme");
    
    Route::get('change-status/{noktp}',[AnggotaController::class,'changeStatus']);
    Route::post('/pengembalian/kembalikan', [TransaksiController::class, 'pengembalianBuku']);
    Route::post('/pengembalian/batal', [TransaksiController::class, 'batalPengembalian'])->name('pengembalian.batal');
});