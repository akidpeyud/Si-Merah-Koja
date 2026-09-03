<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman utama (Homepage)
Route::get('/', function () {
    return view('homepage.index');
});

// === ROUTE UNTUK MENU PROGRAM KERJA ===

// Route untuk halaman SOTK
Route::get('/sotk', function () {
    return view('programkerja.sotk');
});

// Route untuk halaman Pelaporan
Route::get('/pelaporan', function () {
    return view('programkerja.pelaporan');
});

// Route untuk halaman Perencanaan (Pastikan file sudah di-rename jadi perencanaan.php)
Route::get('/perencanaan', function () {
    return view('programkerja.perencanaan');
});

// Route untuk halaman Produk Hukum
Route::get('/produkhukum', function () {
    return view('programkerja.produkhukum');
});

// Route untuk halaman SOP
Route::get('/sop', function () {
    return view('programkerja.sop');
});
Route::get('/redkar', function () {
    return view('redkar.redkar'); 
});
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