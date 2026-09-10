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
Route::get('/internal/pencegahan/pelatihan', function () {
    // Tarik semua data dari tabel pelatihan, urutkan dari yang paling baru
    $data_pelatihan = \Illuminate\Support\Facades\DB::table('pelatihan')->orderBy('id', 'desc')->get();
    
    // Kirim datanya ke file tampilan HTML
    return view('internal.pencegahan.pelatihan', compact('data_pelatihan'));
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

// Jalur untuk nampilin form (GET)
Route::get('/internal/pencegahan/layanan-sosialisasi/tambah', function () {
    return view('internal.pencegahan.create_sosialisasi');
});

// Jalur untuk NYIMPAN data dari form (POST)
Route::post('/internal/pencegahan/layanan-sosialisasi/tambah', function (\Illuminate\Http\Request $request) {
    $data = $request->except(['_token']);
    
    // Cek kalau ada file surat permohonan yang di-upload
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/sosialisasi'), $namaFile);
        $data['surat_permohonan'] = $namaFile;
    }

    $data['created_at'] = now();
    $data['updated_at'] = now();

    \Illuminate\Support\Facades\DB::table('sosialisasi')->insert($data);

    return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil ditambahkan!');
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
Route::get('/internal/pencegahan/layanan-sosialisasi', function () {
    // Tarik data dari tabel sosialisasi, urutkan dari yang terbaru
    $data_sosialisasi = DB::table('sosialisasi')->orderBy('id', 'desc')->get();
    
    return view('internal.pencegahan.layanan_sosialisasi', compact('data_sosialisasi'));
});
// Jalur untuk NYIMPAN data dari form Pelatihan (POST)
Route::post('/internal/pencegahan/pelatihan/tambah', function (\Illuminate\Http\Request $request) {
    $data = $request->except(['_token']);
    
    // Cek kalau ada file yang di-upload (misal name di form lu 'surat_permohonan' atau 'dokumen_pendukung')
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/pelatihan'), $namaFile);
        $data['surat_permohonan'] = $namaFile;
    }

    $data['created_at'] = now();
    $data['updated_at'] = now();

    // Pastikan nama tabelnya 'pelatihan' sesuai yang ada di phpMyAdmin lu
    \Illuminate\Support\Facades\DB::table('pelatihan')->insert($data);

    return redirect('/internal/pencegahan/pelatihan')->with('success', 'Data Pelatihan berhasil ditambahkan!');
});
// 1. Jalur untuk NAMPILIN halaman tabel Pembinaan
Route::get('/internal/pencegahan/pembinaan-pengembangan', function () {
    // Tarik data dari tabel 'pembinaan'
    $data_pembinaan = \Illuminate\Support\Facades\DB::table('pembinaan')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.pembinaan_pengembangan', compact('data_pembinaan'));
});

// 2. Jalur untuk NAMPILIN form tambah (udah ada dari sebelumnya, pastiin aja begini)
Route::get('/internal/pencegahan/pembinaan-pengembangan/tambah', function () {
    return view('internal.pencegahan.create_pembinaan');
});

// 3. Jalur untuk NYIMPAN data form (POST) biar gak error Method Not Allowed
Route::post('/internal/pencegahan/pembinaan-pengembangan/tambah', function (\Illuminate\Http\Request $request) {
    $data = $request->except(['_token']);
    
    // Kalau ada upload file (sesuaikan name='dokumen_pendukung' dengan di HTML form lu)
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/pembinaan'), $namaFile);
        $data['dokumen_pendukung'] = $namaFile;
    }

    $data['created_at'] = now();
    $data['updated_at'] = now();

    \Illuminate\Support\Facades\DB::table('pembinaan')->insert($data);

    return redirect('/internal/pencegahan/pembinaan-pengembangan')->with('success', 'Data Pembinaan berhasil ditambahkan!');
});
// 1. Jalur untuk NAMPILIN halaman tabel Peningkatan Kapasitas
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    // Tarik data dari tabel peningkatan_kapasitas
    $data_peningkatan = \Illuminate\Support\Facades\DB::table('peningkatan_kapasitas')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.peningkatan_kapasitas', compact('data_peningkatan'));
});

// 2. Jalur untuk NAMPILIN form tambah
Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', function () {
    return view('internal.pencegahan.create_peningkatan');
});

// 3. Jalur untuk NYIMPAN data form (POST) 
Route::post('/internal/pencegahan/peningkatan-kapasitas/tambah', function (\Illuminate\Http\Request $request) {
    $data = $request->except(['_token']);
    
    // Fitur upload file (opsional, kalau di form lu ada)
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/peningkatan'), $namaFile);
        $data['dokumen_pendukung'] = $namaFile;
    }

    $data['created_at'] = now();
    $data['updated_at'] = now();

    \Illuminate\Support\Facades\DB::table('peningkatan_kapasitas')->insert($data);

    return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil ditambahkan!');
});
// ==========================================
// FITUR TOMBOL MATA (LIHAT DETAIL)
// ==========================================
Route::get('/internal/pencegahan/layanan-inspeksi/lihat/{id}', function ($id) {
    // Tarik 1 baris data yang ID-nya sesuai yang diklik
    $data = \Illuminate\Support\Facades\DB::table('jadwal_inspeksis')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_inspeksi', compact('data'));
});

// ==========================================
// FITUR TOMBOL PENSIL (EDIT DATA)
// ==========================================
// 1. Nampilin Form Edit (Sambil bawa data lama)
Route::get('/internal/pencegahan/layanan-inspeksi/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('jadwal_inspeksis')->where('id', $id)->first();
    return view('internal.pencegahan.edit_inspeksi', compact('data'));
});

// 2. Proses Nyimpen Perubahannya (POST)
Route::post('/internal/pencegahan/layanan-inspeksi/edit/{id}', function (\Illuminate\Http\Request $request, $id) {
    $updateData = $request->except(['_token']);
    $updateData['updated_at'] = now();
    
    // Update data di database berdasarkan ID
    \Illuminate\Support\Facades\DB::table('jadwal_inspeksis')->where('id', $id)->update($updateData);
    
    return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil diperbarui!');
});