<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedkarController; // Tambahkan baris ini

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

// === ROUTE REDKAR ===
Route::get('/redkar', [RedkarController::class, 'index'])->name('redkar.index');
Route::post('/redkar', [RedkarController::class, 'store'])->name('redkar.store');

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

// === ROUTE INTERNAL ===
Route::get('/internal/index', function () {
    return view('internal.index');
});
Route::get('/internal/profil', [AuthController::class, 'showProfile'])->middleware('auth');
Route::post('/internal/profil/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');