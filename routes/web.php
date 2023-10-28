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
    Route::get('/login', [LoginController::class,'index'])->name('login');
    Route::post('/login', [LoginController::class,'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [LoginController::class,'dashboard']);
    Route::post('/logout', [LoginController::class,'logout']);
  
    Route::middleware('is.role:petugas')->group(function () {
        Route::post('/sidebar', [PreferenceController::class, 'sidebarCookie'])->name("sidebar");
        Route::post('/theme', [PreferenceController::class, 'themeCookie'])->name("theme");

        Route::resource('/buku', BukuController::class);
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/anggota', AnggotaController::class);
        Route::resource('/pengembalian', TransaksiController::class);
        
        Route::delete('/pendaftar/hapus/{noktp}', [AnggotaController::class, 'hapus']);
        Route::post('/anggota/change-status',[AnggotaController::class,'changeStatus']);
        Route::get('/anggota/reset/{noktp}', [AnggotaController::class, 'resetPassword']);

        Route::get('/peminjaman', [TransaksiController::class, 'indexPeminjamanBuku']);
        Route::post('/peminjaman', [TransaksiController::class, 'storePeminjamanBuku']);
        Route::delete('/peminjaman/hapus/{idtransaksi}', [TransaksiController::class, 'deletePeminjaman']);

        Route::post('/pengembalian/kembalikan', [TransaksiController::class, 'pengembalianBuku']);
        Route::post('/pengembalian/batal', [TransaksiController::class, 'batalPengembalian'])->name('pengembalian.batal');

        Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayatTransaksi']);
        
        Route::get('/ajaxAnggota', [AnggotaController::class, 'viewAnggota']);
        Route::get('/ajaxPengembalian', [TransaksiController::class, 'viewPengembalian']);
        Route::get('/ajaxTabelTransaksi', [TransaksiController::class, 'updateTabelTransaksi']);
    });
});