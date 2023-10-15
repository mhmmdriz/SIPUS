<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PreferenceController;

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

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('/buku', BukuController::class);

Route::post('/sidebar', [PreferenceController::class, 'sidebarCookie'])->name("sidebar");
Route::post('/theme', [PreferenceController::class, 'themeCookie'])->name("theme");