<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SapraController;
use App\Http\Controllers\OperatorMedsosController;
use App\Models\Berita;
use App\Models\Infografis;
use App\Models\BeritaMedsos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Route untuk halaman utama (Homepage) - DINAMIS LENGKAP
Route::get('/', function () {
    $daftar_berita = Berita::orderBy('tanggal_kejadian', 'desc')->take(4)->get();
    $daftar_infografis = Infografis::latest()->take(6)->get();
    $daftar_medsos = BeritaMedsos::latest()->take(6)->get();
    
    return view('homepage.index', compact('daftar_berita', 'daftar_infografis', 'daftar_medsos'));
});

// === ROUTE UNTUK MENU PROGRAM KERJA ===
Route::get('/sotk', function () { return view('programkerja.sotk'); });
Route::get('/pelaporan', function () { return view('programkerja.pelaporan'); });
Route::get('/perencanaan', function () { return view('programkerja.perencanaan'); });
Route::get('/produkhukum', function () { return view('programkerja.produkhukum'); });
Route::get('/sop', function () { return view('programkerja.sop'); });

Route::get('/internal/pencegahan/kelola-redkar', [AuthController::class, 'kelolaRedkar']);

// === ROUTE LAYANAN & FASILITAS ===
Route::get('/layanan-fasilitas/layanan_perizinan', function () { return view('layanan-fasilitas.layanan_perizinan'); });
Route::get('/layanan-fasilitas/skk', function () { return view('layanan-fasilitas.skk'); });
Route::get('/layanan-fasilitas/perpanjang_skk', function () { return view('layanan-fasilitas.perpanjang_skk'); });
Route::get('/layanan-fasilitas/izin_penjualan', function () { return view('layanan-fasilitas.izin_penjualan'); });
Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () { return view('layanan-fasilitas.edukasi_sosialisasi'); });
Route::get('/layanan-fasilitas/pks', function () { return view('layanan-fasilitas.pks'); });

// === ROUTE AUTH (LOGIN, LUPA PASSWORD, LOGOUT) ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/lupa-password', [AuthController::class, 'showForgotPassword']);
Route::post('/lupa-password', [AuthController::class, 'processForgotPassword']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/internal/index', function () {
    return view('internal.index');
});

Route::get('/internal/profil', [AuthController::class, 'showProfile'])->middleware('auth');
Route::post('/internal/profil/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');

Route::get('/internal/kelola-user', [AuthController::class, 'kelolaUser'])->middleware('auth');
Route::post('/internal/kelola-user/tambah', [AuthController::class, 'storeUser'])->middleware('auth');
Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser'])->middleware('auth');


// ==========================================
// === ROUTE PENCEGAHAN (SUPER LENGKAP) ===
// ==========================================

// 1. LAYANAN INSPEKSI
Route::get('/internal/pencegahan/layanan-inspeksi', function () {
    $data_inspeksi = DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.layanan_inspeksi', compact('data_inspeksi'));
});
Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () {
    return view('internal.pencegahan.create_inspeksi');
});
Route::post('/internal/pencegahan/layanan-inspeksi/tambah', function (Request $request) {
    $data = $request->except(['_token']);
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/inspeksi'), $namaFile);
        $data['dokumen_pendukung'] = $namaFile;
    }
    $data['created_at'] = now();
    $data['updated_at'] = now();
    DB::table('jadwal_inspeksis')->insert($data);
    return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil ditambahkan!');
});
Route::get('/internal/pencegahan/layanan-inspeksi/lihat/{id}', function ($id) {
    $data = DB::table('jadwal_inspeksis')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_inspeksi', compact('data'));
});
Route::get('/internal/pencegahan/layanan-inspeksi/edit/{id}', function ($id) {
    $data = DB::table('jadwal_inspeksis')->where('id', $id)->first();
    return view('internal.pencegahan.edit_inspeksi', compact('data'));
});
Route::post('/internal/pencegahan/layanan-inspeksi/edit/{id}', function (Request $request, $id) {
    $updateData = $request->except(['_token']);
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/inspeksi'), $namaFile);
        $updateData['dokumen_pendukung'] = $namaFile;
    }
    $updateData['updated_at'] = now();
    DB::table('jadwal_inspeksis')->where('id', $id)->update($updateData);
    return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil diperbarui!');
});

// 2. LAYANAN SOSIALISASI
Route::get('/internal/pencegahan/layanan-sosialisasi', function () {
    $data_sosialisasi = DB::table('sosialisasi')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.layanan_sosialisasi', compact('data_sosialisasi'));
});
Route::get('/internal/pencegahan/layanan-sosialisasi/tambah', function () {
    return view('internal.pencegahan.create_sosialisasi');
});
Route::post('/internal/pencegahan/layanan-sosialisasi/tambah', function (Request $request) {
    $data = $request->except(['_token']);
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/sosialisasi'), $namaFile);
        $data['surat_permohonan'] = $namaFile;
    }
    $data['created_at'] = now();
    $data['updated_at'] = now();
    DB::table('sosialisasi')->insert($data);
    return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil ditambahkan!');
});

// 3. PELATIHAN
Route::get('/internal/pencegahan/pelatihan', function () {
    $data_pelatihan = DB::table('pelatihan')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.pelatihan', compact('data_pelatihan'));
});
Route::get('/internal/pencegahan/pelatihan/tambah', function () {
    return view('internal.pencegahan.create_pelatihan');
});
Route::post('/internal/pencegahan/pelatihan/tambah', function (Request $request) {
    $data = $request->except(['_token']);
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/pelatihan'), $namaFile);
        $data['surat_permohonan'] = $namaFile;
    }
    $data['created_at'] = now();
    $data['updated_at'] = now();
    DB::table('pelatihan')->insert($data);
    return redirect('/internal/pencegahan/pelatihan')->with('success', 'Data Pelatihan berhasil ditambahkan!');
});

// 4. PEMBINAAN & PENGEMBANGAN
Route::get('/internal/pencegahan/pembinaan-pengembangan', function () {
    $data_pembinaan = DB::table('pembinaan')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.pembinaan_pengembangan', compact('data_pembinaan'));
});
Route::get('/internal/pencegahan/pembinaan-pengembangan/tambah', function () {
    return view('internal.pencegahan.create_pembinaan');
});
Route::post('/internal/pencegahan/pembinaan-pengembangan/tambah', function (Request $request) {
    $data = $request->except(['_token']);
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/pembinaan'), $namaFile);
        $data['dokumen_pendukung'] = $namaFile;
    }
    $data['created_at'] = now();
    $data['updated_at'] = now();
    DB::table('pembinaan')->insert($data);
    return redirect('/internal/pencegahan/pembinaan-pengembangan')->with('success', 'Data Pembinaan berhasil ditambahkan!');
});

// 5. PENINGKATAN KAPASITAS
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    $data_peningkatan = DB::table('peningkatan_kapasitas')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.peningkatan_kapasitas', compact('data_peningkatan'));
});
Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', function () {
    return view('internal.pencegahan.create_peningkatan');
});
Route::post('/internal/pencegahan/peningkatan-kapasitas/tambah', function (Request $request) {
    $data = $request->except(['_token']);
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/peningkatan'), $namaFile);
        $data['dokumen_pendukung'] = $namaFile;
    }
    $data['created_at'] = now();
    $data['updated_at'] = now();
    DB::table('peningkatan_kapasitas')->insert($data);
    return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil ditambahkan!');
});


// ==========================================
// RUTE PUBLIK REDKAR
// ==========================================
Route::get('/redkar', function () {
    return view('public.form_redkar'); 
});
Route::post('/redkar', [AuthController::class, 'storeRedkar']);
// Rute Cetak Redkar di menu Pencegahan
Route::get('/internal/pencegahan/cetak-redkar/{id}', [AuthController::class, 'cetakRedkar']);


// ==========================================
// === RUTE BERITA (PUBLIK & INTERNAL OPERATOR) ===
// ==========================================
Route::get('/berita/{id}', [BeritaController::class, 'showPublic']);

Route::middleware(['auth'])->group(function () {
    Route::get('/internal/operator/kelola-berita', [BeritaController::class, 'indexInternal']);
    Route::get('/internal/operator/kelola-berita/tambah', [BeritaController::class, 'create']);
    Route::post('/internal/operator/kelola-berita/store', [BeritaController::class, 'store']);
    Route::get('/internal/operator/kelola-berita/edit/{id}', [BeritaController::class, 'edit']);
    Route::put('/internal/operator/kelola-berita/update/{id}', [BeritaController::class, 'update']);
    Route::delete('/internal/operator/kelola-berita/hapus/{id}', [BeritaController::class, 'destroy']);
});


// ==========================================
// === ROUTE BAGIAN SAPRA (SARANA PRASARANA) ===
// ==========================================
Route::get('/sapra/logistik', [SapraController::class, 'logistik']);

Route::get('/sapra/data-hidrant-kota', [SapraController::class, 'dataHidrantKota']);
Route::get('/sapra/data-hidrant-kota/cetak-pdf', [SapraController::class, 'cetakPdfKota']);
Route::post('/sapra/data-hidrant-kota/store', [SapraController::class, 'storeHidrantKota']);
Route::put('/sapra/data-hidrant-kota/update/{id}', [SapraController::class, 'updateHidrantKota']);
Route::delete('/sapra/data-hidrant-kota/delete/{id}', [SapraController::class, 'destroyHidrantKota']);
Route::get('/sapra/data-hidrant-kota/cetak-excel', [SapraController::class, 'cetakExcelKota']);

Route::get('/sapra/data_hidrant_gedung', [SapraController::class, 'dataHidrantGedung']);
Route::post('/sapra/hidran/store', [SapraController::class, 'storeHidran']);
Route::put('/sapra/hidran/update/{id}', [SapraController::class, 'updateHidran']);
Route::delete('/sapra/hidran/delete/{id}', [SapraController::class, 'destroyHidran']);
Route::get('/sapra/hidran/cetak-pdf', [SapraController::class, 'cetakPdfHidranGedung']);
Route::get('/sapra/hidran/cetak-excel', [SapraController::class, 'cetakExcelHidran']);

// RUTE PRASARANA MAKO
Route::get('/sapra/prasarana-mako', [SapraController::class, 'prasaranaMako']);
Route::get('/sapra/prasarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfMako']);
Route::post('/sapra/prasarana-mako/store', [SapraController::class, 'storePrasaranaMako']);
Route::put('/sapra/prasarana-mako/update/{id}', [SapraController::class, 'updatePrasaranaMako']);
Route::delete('/sapra/prasarana-mako/delete/{id}', [SapraController::class, 'destroyPrasaranaMako']);

// RUTE SARANA MAKO & POS 
Route::get('/sapra/sarana-mako', [SapraController::class, 'saranaMako']);
Route::get('/sapra/sarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfSaranaMako']);
Route::post('/sapra/sarana-mako/store', [SapraController::class, 'storeSaranaMako']);
Route::put('/sapra/sarana-mako/update/{id}', [SapraController::class, 'updateSaranaMako']);
Route::delete('/sapra/sarana-mako/delete/{id}', [SapraController::class, 'destroySaranaMako']);


// ==========================================
// === RUTE KELOLA INFOGRAFIS & BERITA MEDSOS (OPERATOR) ===
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Rute Kelola Info Grafis
    Route::get('/internal/operator/infografis', [OperatorMedsosController::class, 'indexInfografis']);
    Route::post('/internal/operator/infografis/store', [OperatorMedsosController::class, 'storeInfografis']);
    Route::delete('/internal/operator/infografis/hapus/{id}', [OperatorMedsosController::class, 'destroyInfografis']);

    // Rute Kelola Berita Medsos
    Route::get('/internal/operator/berita-medsos', [OperatorMedsosController::class, 'indexMedsos']);
    Route::post('/internal/operator/berita-medsos/store', [OperatorMedsosController::class, 'storeMedsos']);
    Route::put('/internal/operator/berita-medsos/update/{id}', [OperatorMedsosController::class, 'updateMedsos']);
    Route::delete('/internal/operator/berita-medsos/hapus/{id}', [OperatorMedsosController::class, 'destroyMedsos']);
});
// ==========================================
// FITUR TOMBOL MATA (LIHAT DETAIL & PDF) - SOSIALISASI
// ==========================================
Route::get('/internal/pencegahan/layanan-sosialisasi/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_sosialisasi', compact('data'));
});

// ==========================================
// FITUR TOMBOL PENSIL (EDIT DATA) - SOSIALISASI
// ==========================================
Route::get('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->first();
    return view('internal.pencegahan.edit_sosialisasi', compact('data'));
});

Route::post('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function (\Illuminate\Http\Request $request, $id) {
    $updateData = $request->except(['_token']);
    
    // Sesuaikan 'surat_permohonan' kalau field upload file lu beda
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/sosialisasi'), $namaFile);
        $updateData['surat_permohonan'] = $namaFile;
    }

    $updateData['updated_at'] = now();
    \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->update($updateData);
    
    return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil diperbarui!');
});