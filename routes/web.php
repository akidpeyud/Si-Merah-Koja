<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InspeksiController; 
use Illuminate\Support\Facades\DB; // <-- Tambahan buat manggil database langsung

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
Route::get('/internal/kelola-user', [App\Http\Controllers\AuthController::class, 'kelolaUser'])->middleware('auth');
Route::post('/internal/kelola-user/tambah', [App\Http\Controllers\AuthController::class, 'storeUser'])->middleware('auth');
Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser'])->middleware('auth');

// === ROUTE PENCEGAHAN ===

// ROUTE INI YANG UDAH DIUBAH BUAT NARIK DATA INSPEKSI
Route::get('/internal/pencegahan/layanan-inspeksi', function () {
    // Tarik semua data dari tabel jadwal_inspeksis, urutkan dari yang terbaru
    $data_inspeksi = DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get();
    
    // Kirim datanya ke file tampilan HTML
    return view('internal.pencegahan.layanan_inspeksi', compact('data_inspeksi'));
});

Route::get('/internal/pencegahan/layanan-sosialisasi', function () {
    return view('internal.pencegahan.layanan_sosialisasi');
});
Route::get('/internal/pencegahan/pelatihan', function () {
    return view('internal.pencegahan.pelatihan');
});
Route::get('/internal/pencegahan/pembinaan-pengembangan', function () {
    return view('internal.pencegahan.pembinaan_pengembangan');
});
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    return view('internal.pencegahan.peningkatan_kapasitas');
});

// Route untuk nampilin form tambah inspeksi
Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () {
    return view('internal.pencegahan.create_inspeksi');
});
// Route untuk MENYIMPAN data dari form ke database
Route::post('/internal/pencegahan/layanan-inspeksi/tambah', [InspeksiController::class, 'store']);

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
// Route untuk buka halaman LIHAT data
Route::get('/internal/pencegahan/layanan-inspeksi/lihat/{id}', [InspeksiController::class, 'show']);

// Route untuk buka halaman EDIT data
Route::get('/internal/pencegahan/layanan-inspeksi/edit/{id}', [InspeksiController::class, 'edit']);

// Route untuk NYIMPAN PERUBAHAN data yang diedit
Route::post('/internal/pencegahan/layanan-inspeksi/update/{id}', [InspeksiController::class, 'update']);