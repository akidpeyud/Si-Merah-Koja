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
//pencegahan
Route::get('/internal/pencegahan/layanan-inspeksi', function () {
    return view('internal.pencegahan.layanan_inspeksi');
});
Route::get('/internal/pencegahan/layanan-sosialisasi', function () {
    // Ingat ya bro, karena di folder lu namanya pakai underscore
    return view('internal.pencegahan.layanan_sosialisasi');
});
Route::get('/internal/pencegahan/pelatihan', function () {
    // Ingat untuk rename filenya jadi pelatihan.blade.php ya
    return view('internal.pencegahan.pelatihan');
});
Route::get('/internal/pencegahan/pembinaan-pengembangan', function () {
    // Pastikan nama filenya nanti pembinaan_pengembangan.blade.php ya
    return view('internal.pencegahan.pembinaan_pengembangan');
});
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    // Pastikan nama filenya nanti peningkatan_kapasitas.blade.php
    return view('internal.pencegahan.peningkatan_kapasitas');
});
// Route untuk nampilin form tambah inspeksi
Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () {
    return view('internal.pencegahan.create_inspeksi');
});

// Route untuk nyimpen data (nantinya kalau lu udah bikin controller)
// Route::post('/internal/pencegahan/layanan-inspeksi/simpan', [InspeksiController::class, 'store']);
// Route untuk nampilin form tambah sosialisasi
Route::get('/internal/pencegahan/layanan-sosialisasi/tambah', function () {
    return view('internal.pencegahan.create_sosialisasi');
});
Route::get('/internal/pencegahan/pelatihan/tambah', function () {
    return view('internal.pencegahan.create_pelatihan');
});
Route::get('/internal/pencegahan/pembinaan-pengembangan/tambah', function () {
    return view('internal.pencegahan.create_pembinaan');
});
Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', function () {
    return view('internal.pencegahan.create_peningkatan');
});