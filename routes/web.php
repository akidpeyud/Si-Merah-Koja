<?php

use Illuminate\Support\Facades\Route;

// === 1. HOMEPAGE ===
Route::get('/', function () {
    return view('homepage.index');
})->name('home');


// === 2. PROGRAM KERJA ===
Route::prefix('program-kerja')->group(function () {
    // Jika ingin URL rapi: /sotk, /sop, dll (disediakan redirect/alias di bawah)
});

Route::get('/sotk', function () {
    return view('programkerja.sotk');
})->name('sotk');

Route::get('/sop', function () {
    return view('programkerja.sop');
})->name('sop');

Route::get('/perencanaan', function () {
    return view('programkerja.perencanaan');
})->name('perencanaan');

Route::get('/pelaporan', function () {
    return view('programkerja.pelaporan');
})->name('pelaporan');

Route::get('/produkhukum', function () {
    return view('programkerja.produkhukum');
})->name('produkhukum');


// === 3. REDKAR ===
Route::get('/redkar', function () {
    return view('redkar.redkar');
})->name('redkar');


// === 4. LAYANAN & FASILITAS ===
Route::get('/layanan-perizinan', function () {
    return view('layanan-fasilitas.layanan_perizinan');
})->name('layanan.perizinan');

Route::get('/edukasi-sosialisasi', function () {
    return view('layanan-fasilitas.edukasi_sosialisasi');
})->name('layanan.edukasi');

Route::get('/perjanjian-kerjasama', function () {
    return view('layanan-fasilitas.perjanjian_kerjasama');
})->name('layanan.pks');

Route::get('/layanan-lainnya', function () {
    return view('layanan-fasilitas.layanan_lainnya');
})->name('layanan.lainnya');


// === 5. LOGIN ===
Route::get('/login', function () {
    return view('login.login');
})->name('login');