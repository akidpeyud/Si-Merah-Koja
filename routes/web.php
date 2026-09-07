<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route untuk halaman utama (Homepage)
Route::get('/', function () {
    return view('homepage.index');
});

// === ROUTE UNTUK MENU PROGRAM KERJA ===
Route::get('/sotk', function () {
    return view('programkerja.sotk');
});

Route::get('/pelaporan', function () {
    return view('programkerja.pelaporan');
});

Route::get('/perencanaan', function () {
    return view('programkerja.perencanaan');
});

Route::get('/produkhukum', function () {
    return view('programkerja.produkhukum');
});

Route::get('/sop', function () {
    return view('programkerja.sop');
});

Route::get('/redkar', function () {
    return view('redkar.redkar'); 
});

// === ROUTE LAYANAN & FASILITAS ===
Route::get('/layanan-fasilitas/layanan_perizinan', function () {
    return view('layanan-fasilitas.layanan_perizinan');
});
Route::get('/layanan-fasilitas/skk', function () {
    return view('layanan-fasilitas.skk');
});
Route::get('/layanan-fasilitas/perpanjang_skk', function () {
    return view('layanan-fasilitas.perpanjang_skk');
});
Route::get('/layanan-fasilitas/izin_penjualan', function () {
    return view('layanan-fasilitas.izin_penjualan');
});
Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () {
    return view('layanan-fasilitas.edukasi_sosialisasi');
});
Route::get('/layanan-fasilitas/pks', function () {
    return view('layanan-fasilitas.pks');
});

// === ROUTE AUTH (LOGIN, LUPA PASSWORD, LOGOUT) ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);

Route::get('/lupa-password', [AuthController::class, 'showForgotPassword']);
Route::post('/lupa-password', [AuthController::class, 'processForgotPassword']);

Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/internal/index', function () {
    return view('internal.index');
});
Route::get('/internal/profil', [App\Http\Controllers\AuthController::class, 'showProfile'])->middleware('auth');
Route::post('/internal/profil/update-password', [App\Http\Controllers\AuthController::class, 'updatePassword'])->middleware('auth');
Route::get('/internal/profil', [App\Http\Controllers\AuthController::class, 'showProfile'])->middleware('auth');
Route::post('/internal/profil/update-password', [App\Http\Controllers\AuthController::class, 'updatePassword'])->middleware('auth');
Route::get('/internal/kelola-user', [App\Http\Controllers\AuthController::class, 'kelolaUser'])->middleware('auth');
Route::post('/internal/kelola-user/tambah', [App\Http\Controllers\AuthController::class, 'storeUser'])->middleware('auth');
Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser'])->middleware('auth');
// Rute untuk menerima data kiriman form publik
Route::post('/redkar/daftar', [AuthController::class, 'storeRedkar']);

// Rute khusus Operator / Super User untuk melihat daftar relawan yang masuk
Route::middleware(['auth'])->group(function () {
    Route::get('/internal/operator/redkar-masuk', [AuthController::class, 'showRedkarData']);
});
// Manajemen Redkar (Khusus Operator / Super User)
    Route::get('/internal/operator/kelola-redkar', [App\Http\Controllers\AuthController::class, 'kelolaRedkar']);
    Route::get('/internal/operator/cetak-redkar/{id}', [App\Http\Controllers\AuthController::class, 'cetakRedkar']);
