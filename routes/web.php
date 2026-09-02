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