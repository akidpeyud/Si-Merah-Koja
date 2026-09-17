<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SapraController;
use App\Http\Controllers\OperatorMedsosController;
use App\Http\Controllers\DamtanController;
use App\Http\Controllers\RedkarController; 
use App\Http\Controllers\PermohonanController;
use App\Models\Berita;
use App\Models\Infografis;
use App\Models\BeritaMedsos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// ==========================================
// ROUTE UNTUK HALAMAN UTAMA (HOMEPAGE)
// ==========================================
Route::get('/', function () {
    $daftar_berita = Berita::orderBy('tanggal_kejadian', 'desc')->take(4)->get();
    $daftar_infografis = Infografis::latest()->take(6)->get();
    $daftar_medsos = BeritaMedsos::latest()->take(6)->get();
    
    return view('homepage.index', compact('daftar_berita', 'daftar_infografis', 'daftar_medsos'));
});

// ==========================================
// ROUTE UNTUK MENU PROGRAM KERJA
// ==========================================
Route::get('/sotk', function () { return view('programkerja.sotk'); });
Route::get('/pelaporan', function () { return view('programkerja.pelaporan'); });
Route::get('/perencanaan', function () { return view('programkerja.perencanaan'); });
Route::get('/produkhukum', function () { return view('programkerja.produkhukum'); });
Route::get('/sop', function () { return view('programkerja.sop'); });

// ==========================================
// ROUTE LAYANAN & FASILITAS
// ==========================================
Route::get('/layanan-fasilitas/layanan_perizinan', function () { return view('layanan-fasilitas.layanan_perizinan'); });
Route::post('/layanan-fasilitas/layanan_perizinan/store', [PermohonanController::class, 'store'])->name('permohonan.store');

Route::get('/layanan-fasilitas/skk', function () { return view('layanan-fasilitas.skk'); });
Route::get('/layanan-fasilitas/perpanjang_skk', function () { return view('layanan-fasilitas.perpanjang_skk'); });
Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () { return view('layanan-fasilitas.edukasi_sosialisasi'); });
Route::get('/layanan-fasilitas/informasi_layanan', function () { return view('layanan-fasilitas.informasi_layanan'); });

Route::post('/permohonan-skk', [App\Http\Controllers\PermohonanSkkController::class, 'store'])->name('permohonan.skk.store');
Route::get('/permohonan-skk', function () {
    return redirect('/layanan-fasilitas/skk'); 
});

Route::post('/permohonan-perpanjang-skk', [App\Http\Controllers\PermohonanPerpanjangSkkController::class, 'store'])->name('permohonan.perpanjang_skk.store');
Route::get('/permohonan-perpanjang-skk', function () {
    return redirect('/layanan-fasilitas/perpanjang_skk');
});

Route::post('/layanan-fasilitas/edukasi_sosialisasi/store', [App\Http\Controllers\PermohonanEdukasiController::class, 'store'])->name('permohonan.edukasi.store');


// ==========================================
// RUTE PUBLIK REDKAR & LOGIN REDKAR
// ==========================================
// Form pendaftaran publik (calon relawan)
Route::get('/redkar', [RedkarController::class, 'index'])->name('redkar.register');
Route::post('/redkar', [RedkarController::class, 'store']);

// Form login publik untuk relawan yang sudah punya akun
Route::get('/login-redkar', function () {
    return view('redkar.login_redkar'); 
})->name('login.redkar');

// Proses login & logout untuk relawan (menggunakan Guard 'redkar')
Route::post('/login-redkar', [RedkarController::class, 'processLoginRedkar']);
Route::post('/logout-redkar', [RedkarController::class, 'logoutRedkar'])->name('logout.redkar');

// Dashboard Relawan Redkar (Hanya bisa diakses jika sudah login lewat guard 'redkar')
Route::get('/redkar/dashboard', function () {
    return view('redkar.halaman_utama'); 
})->name('redkar.dashboard')->middleware('auth:redkar');


// ==========================================
// ROUTE AUTH (LOGIN INTERNAL PEGAWAI, LUPA PASSWORD, LOGOUT)
// ==========================================
// Rute default 'login' penting ada untuk sistem autentikasi bawaan Laravel
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/lupa-password', [AuthController::class, 'showForgotPassword']);
Route::post('/lupa-password', [AuthController::class, 'processForgotPassword']);
Route::post('/logout', [AuthController::class, 'logout']);


// ==========================================
// ROUTE INTERNAL & KELOLA USER (ADMIN)
// ==========================================
Route::get('/internal/index', function () {
    return view('internal.index');
})->middleware('auth');

Route::get('/internal/profil', [AuthController::class, 'showProfile'])->middleware('auth');
Route::post('/internal/profil/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');

Route::get('/internal/kelola-user', [AuthController::class, 'kelolaUser'])->middleware('auth');
Route::post('/internal/kelola-user/tambah', [AuthController::class, 'storeUser'])->middleware('auth');
Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser'])->middleware('auth');


// ==========================================
// ROUTE PENCEGAHAN (SUPER LENGKAP)
// ==========================================

// KELOLA REDKAR
Route::get('/internal/pencegahan/kelola-redkar', [AuthController::class, 'kelolaRedkar'])->middleware('auth');
Route::post('/internal/pencegahan/verifikasi-redkar/{id}', [RedkarController::class, 'verifikasiRedkar'])->middleware('auth');
Route::get('/internal/pencegahan/edit-redkar/{id}', [RedkarController::class, 'editRedkar'])->middleware('auth');
Route::put('/internal/pencegahan/update-redkar/{id}', [RedkarController::class, 'updateRedkar'])->middleware('auth');
Route::delete('/internal/pencegahan/hapus-redkar/{id}', [RedkarController::class, 'hapusRedkar'])->middleware('auth');
Route::get('/internal/pencegahan/cetak-redkar/{id}', [RedkarController::class, 'cetakRedkar'])->middleware('auth');
Route::get('/internal/pencegahan/tambah-redkar', [RedkarController::class, 'createRedkar'])->middleware('auth');
Route::post('/internal/pencegahan/simpan-redkar-offline', [RedkarController::class, 'storeRedkarOffline'])->middleware('auth');

// KELOLA RPKBGL
Route::get('/internal/pencegahan/kelola-rpkbgl', function () {
    $permohonan = App\Models\PermohonanRpkbgl::orderBy('created_at', 'desc')->get();
    return view('internal.pencegahan.kelola_rpkbgl', compact('permohonan'));
})->middleware('auth');

Route::post('/internal/pencegahan/kelola-rpkbgl/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanRpkbgl::where('id', $id)->update([
        'status_permohonan' => $request->status_permohonan
    ]);
    return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui!');
})->middleware('auth');

Route::get('/internal/pencegahan/kelola-rpkbgl/{id}', function ($id) {
    $permohonan = App\Models\PermohonanRpkbgl::findOrFail($id);
    return view('internal.pencegahan.detail_rpkbgl', compact('permohonan'));
})->middleware('auth');

// KELOLA SKK & PERPANJANG SKK
Route::get('/internal/pencegahan/kelola-skk', function () {
    $skk_baru = App\Models\PermohonanSkk::orderBy('created_at', 'desc')->get();
    $skk_perpanjang = App\Models\PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get();
    return view('internal.pencegahan.kelola_skk', compact('skk_baru', 'skk_perpanjang'));
})->middleware('auth');

Route::post('/internal/pencegahan/kelola-skk/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]);
    return redirect()->back()->with('success', 'Status Permohonan SKK Baru berhasil diperbarui!');
})->middleware('auth');

Route::post('/internal/pencegahan/kelola-perpanjang-skk/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanPerpanjangSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]);
    return redirect()->back()->with('success', 'Status Permohonan Perpanjangan SKK berhasil diperbarui!');
})->middleware('auth');

Route::get('/internal/pencegahan/kelola-skk/{id}', function (Illuminate\Http\Request $request, $id) {
    $tipe = $request->query('tipe', 'baru'); 
    if ($tipe === 'perpanjang') {
        $permohonan = App\Models\PermohonanPerpanjangSkk::findOrFail($id);
        $jenis_layanan = "Perpanjangan SKK";
    } else {
        $permohonan = App\Models\PermohonanSkk::findOrFail($id);
        $jenis_layanan = "SKK Baru";
    }
    return view('internal.pencegahan.detail_skk', compact('permohonan', 'tipe', 'jenis_layanan'));
})->middleware('auth');

// KELOLA EDUKASI & SOSIALISASI
Route::get('/internal/pencegahan/kelola-edukasi', function () {
    $permohonan = App\Models\PermohonanEdukasi::orderBy('created_at', 'desc')->get();
    return view('internal.pencegahan.kelola_edukasi', compact('permohonan'));
})->middleware('auth');

Route::post('/internal/pencegahan/kelola-edukasi/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanEdukasi::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]);
    return redirect()->back()->with('success', 'Status Permohonan Edukasi berhasil diperbarui!');
})->middleware('auth');

Route::get('/internal/pencegahan/kelola-edukasi/{id}', function ($id) {
    $permohonan = App\Models\PermohonanEdukasi::findOrFail($id);
    return view('internal.pencegahan.detail_edukasi', compact('permohonan'));
})->middleware('auth');

// LAYANAN INSPEKSI
Route::get('/internal/pencegahan/layanan-inspeksi', function () {
    $data_inspeksi = DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.layanan_inspeksi', compact('data_inspeksi'));
})->middleware('auth');

Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () {
    return view('internal.pencegahan.create_inspeksi');
})->middleware('auth');

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
})->middleware('auth');

Route::get('/internal/pencegahan/layanan-inspeksi/lihat/{id}', function ($id) {
    $data = DB::table('jadwal_inspeksis')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_inspeksi', compact('data'));
})->middleware('auth');

Route::get('/internal/pencegahan/layanan-inspeksi/edit/{id}', function ($id) {
    $data = DB::table('jadwal_inspeksis')->where('id', $id)->first();
    return view('internal.pencegahan.edit_inspeksi', compact('data'));
})->middleware('auth');

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
})->middleware('auth');

// LAYANAN SOSIALISASI
Route::get('/internal/pencegahan/layanan-sosialisasi', function () {
    $data_sosialisasi = DB::table('sosialisasi')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.layanan_sosialisasi', compact('data_sosialisasi'));
})->middleware('auth');

Route::get('/internal/pencegahan/layanan-sosialisasi/tambah', function () {
    return view('internal.pencegahan.create_sosialisasi');
})->middleware('auth');

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
})->middleware('auth');

Route::get('/internal/pencegahan/layanan-sosialisasi/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_sosialisasi', compact('data'));
})->middleware('auth');

Route::get('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->first();
    return view('internal.pencegahan.edit_sosialisasi', compact('data'));
})->middleware('auth');

Route::post('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function (\Illuminate\Http\Request $request, $id) {
    $updateData = $request->except(['_token']);
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/sosialisasi'), $namaFile);
        $updateData['surat_permohonan'] = $namaFile;
    }
    $updateData['updated_at'] = now();
    \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->update($updateData);
    return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil diperbarui!');
})->middleware('auth');

// PELATIHAN
Route::get('/internal/pencegahan/pelatihan', function () {
    $data_pelatihan = DB::table('pelatihan')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.pelatihan', compact('data_pelatihan'));
})->middleware('auth');

Route::get('/internal/pencegahan/pelatihan/tambah', function () {
    return view('internal.pencegahan.create_pelatihan');
})->middleware('auth');

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
})->middleware('auth');

Route::get('/internal/pencegahan/pelatihan/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pelatihan')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_pelatihan', compact('data'));
})->middleware('auth');

Route::get('/internal/pencegahan/pelatihan/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pelatihan')->where('id', $id)->first();
    return view('internal.pencegahan.edit_pelatihan', compact('data'));
})->middleware('auth');

Route::post('/internal/pencegahan/pelatihan/edit/{id}', function (\Illuminate\Http\Request $request, $id) {
    $updateData = $request->except(['_token']);
    if ($request->hasFile('surat_permohonan')) {
        $file = $request->file('surat_permohonan');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/pelatihan'), $namaFile);
        $updateData['surat_permohonan'] = $namaFile;
    }
    $updateData['updated_at'] = now();
    \Illuminate\Support\Facades\DB::table('pelatihan')->where('id', $id)->update($updateData);
    return redirect('/internal/pencegahan/pelatihan')->with('success', 'Data Pelatihan berhasil diperbarui!');
})->middleware('auth');

// PEMBINAAN & PENGEMBANGAN
Route::get('/internal/pencegahan/pembinaan-pengembangan', function () {
    $data_pembinaan = DB::table('pembinaan')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.pembinaan_pengembangan', compact('data_pembinaan'));
})->middleware('auth');

Route::get('/internal/pencegahan/pembinaan-pengembangan/tambah', function () {
    return view('internal.pencegahan.create_pembinaan');
})->middleware('auth');

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
})->middleware('auth');

Route::get('/internal/pencegahan/pembinaan-pengembangan/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pembinaan')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_pembinaan', compact('data'));
})->middleware('auth');

Route::get('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pembinaan')->where('id', $id)->first();
    return view('internal.pencegahan.edit_pembinaan', compact('data'));
})->middleware('auth');

Route::post('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function (\Illuminate\Http\Request $request, $id) {
    $updateData = $request->except(['_token']);
    if ($request->hasFile('dokumen_pendukung')) {
        $file = $request->file('dokumen_pendukung');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/pembinaan'), $namaFile);
        $updateData['dokumen_pendukung'] = $namaFile;
    }
    $updateData['updated_at'] = now();
    \Illuminate\Support\Facades\DB::table('pembinaan')->where('id', $id)->update($updateData);
    return redirect('/internal/pencegahan/pembinaan-pengembangan')->with('success', 'Data Pembinaan berhasil diperbarui!');
})->middleware('auth');

// PENINGKATAN KAPASITAS
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    $data_peningkatan = DB::table('peningkatan_kapasitas')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.peningkatan_kapasitas', compact('data_peningkatan'));
})->middleware('auth');

Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', function () {
    return view('internal.pencegahan.create_peningkatan');
})->middleware('auth');

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
})->middleware('auth');

Route::get('/internal/pencegahan/peningkatan-kapasitas/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('peningkatan_kapasitas')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_peningkatan', compact('data'));
})->middleware('auth');

Route::get('/internal/pencegahan/peningkatan-kapasitas/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('peningkatan_kapasitas')->where('id', $id)->first();
    return view('internal.pencegahan.edit_peningkatan', compact('data'));
})->middleware('auth');

Route::post('/internal/pencegahan/peningkatan-kapasitas/edit/{id}', function (\Illuminate\Http\Request $request, $id) {
    $updateData = $request->except(['_token']);
    if ($request->hasFile('dokumen_terkait')) {
        $file = $request->file('dokumen_terkait');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/peningkatan'), $namaFile);
        $updateData['dokumen_terkait'] = $namaFile;
    }
    $updateData['updated_at'] = now();
    \Illuminate\Support\Facades\DB::table('peningkatan_kapasitas')->where('id', $id)->update($updateData);
    return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil diperbarui!');
})->middleware('auth');


// ==========================================
// ROUTE BERITA (PUBLIK & INTERNAL OPERATOR)
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
// ROUTE BAGIAN SAPRA (SARANA PRASARANA)
// ==========================================
Route::get('/sapra/logistik', [SapraController::class, 'logistik'])->middleware('auth');

// Data Hidrant Kota
Route::get('/sapra/data-hidrant-kota', [SapraController::class, 'dataHidrantKota'])->middleware('auth');
Route::get('/sapra/data-hidrant-kota/cetak-pdf', [SapraController::class, 'cetakPdfKota'])->middleware('auth');
Route::post('/sapra/data-hidrant-kota/store', [SapraController::class, 'storeHidrantKota'])->middleware('auth');
Route::put('/sapra/data-hidrant-kota/update/{id}', [SapraController::class, 'updateHidrantKota'])->middleware('auth');
Route::delete('/sapra/data-hidrant-kota/delete/{id}', [SapraController::class, 'destroyHidrantKota'])->middleware('auth');
Route::get('/sapra/data-hidrant-kota/cetak-excel', [SapraController::class, 'cetakExcelKota'])->middleware('auth');

// Data Hidrant Gedung
Route::get('/sapra/data_hidrant_gedung', [SapraController::class, 'dataHidrantGedung'])->middleware('auth');
Route::post('/sapra/hidran/store', [SapraController::class, 'storeHidran'])->middleware('auth');
Route::put('/sapra/hidran/update/{id}', [SapraController::class, 'updateHidran'])->middleware('auth');
Route::delete('/sapra/hidran/delete/{id}', [SapraController::class, 'destroyHidran'])->middleware('auth');
Route::get('/sapra/hidran/cetak-pdf', [SapraController::class, 'cetakPdfHidranGedung'])->middleware('auth');
Route::get('/sapra/hidran/cetak-excel', [SapraController::class, 'cetakExcelHidran'])->middleware('auth');

// Prasarana Mako
Route::get('/sapra/prasarana-mako', [SapraController::class, 'prasaranaMako'])->middleware('auth');
Route::get('/sapra/prasarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfMako'])->middleware('auth');
Route::post('/sapra/prasarana-mako/store', [SapraController::class, 'storePrasaranaMako'])->middleware('auth');
Route::put('/sapra/prasarana-mako/update/{id}', [SapraController::class, 'updatePrasaranaMako'])->middleware('auth');
Route::delete('/sapra/prasarana-mako/delete/{id}', [SapraController::class, 'destroyPrasaranaMako'])->middleware('auth');

// Sarana Mako & Pos 
Route::get('/sapra/sarana-mako', [SapraController::class, 'saranaMako'])->middleware('auth');
Route::get('/sapra/sarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfSaranaMako'])->middleware('auth');
Route::post('/sapra/sarana-mako/store', [SapraController::class, 'storeSaranaMako'])->middleware('auth');
Route::put('/sapra/sarana-mako/update/{id}', [SapraController::class, 'updateSaranaMako'])->middleware('auth');
Route::delete('/sapra/sarana-mako/delete/{id}', [SapraController::class, 'destroySaranaMako'])->middleware('auth');

// Nambah pos
Route::get('/sapra/kelola-pos', [SapraController::class, 'kelolaPos'])->middleware('auth');
Route::post('/sapra/kelola-pos/store', [SapraController::class, 'storePos'])->middleware('auth');
Route::put('/sapra/kelola-pos/update/{id}', [SapraController::class, 'updatePos'])->middleware('auth');
Route::delete('/sapra/kelola-pos/delete/{id}', [SapraController::class, 'destroyPos'])->middleware('auth');

// RUTE SARANA MAKO & POS PENYELAMATAN
Route::get('/sapra/sarana-penyelamatan', [SapraController::class, 'saranaPenyelamatan'])->middleware('auth');
Route::post('/sapra/sarana-penyelamatan/store', [SapraController::class, 'storeSaranaPenyelamatan'])->middleware('auth');
Route::put('/sapra/sarana-penyelamatan/update/{id}', [SapraController::class, 'updateSaranaPenyelamatan'])->middleware('auth');
Route::delete('/sapra/sarana-penyelamatan/delete/{id}', [SapraController::class, 'destroySaranaPenyelamatan'])->middleware('auth');
Route::get('/sapra/sarana-penyelamatan/cetak-pdf', [SapraController::class, 'cetakPdfSaranaPenyelamatan'])->middleware('auth');

// Rute kebutuhan sapras
Route::get('/sapra/kebutuhan-sarpras', [SapraController::class, 'kebutuhanSarpras'])->middleware('auth');
Route::post('/sapra/kebutuhan-sarpras/store', [SapraController::class, 'storeKebutuhanSarpras'])->middleware('auth');
Route::put('/sapra/kebutuhan-sarpras/update/{id}', [SapraController::class, 'updateKebutuhanSarpras'])->middleware('auth');
Route::delete('/sapra/kebutuhan-sarpras/delete/{id}', [SapraController::class, 'destroyKebutuhanSarpras'])->middleware('auth');

// Tambahan route khusus untuk Pengadaan
Route::post('/sapra/pengadaan-sarpras/store', [SapraController::class, 'storePengadaan'])->middleware('auth');
Route::delete('/sapra/pengadaan-sarpras/delete/{kebutuhan_id}/{tahun}', [SapraController::class, 'destroyPengadaan'])->middleware('auth');
Route::get('/sapra/kebutuhan-sarpras/cetak', [SapraController::class, 'cetakKebutuhan'])->middleware('auth');

// === MENU DISTRIBUSI BARANG STAFF =========
Route::get('/sapra/distribusi-staff', [SapraController::class, 'distribusiStaff'])->middleware('auth');
Route::post('/sapra/distribusi-staff/store', [SapraController::class, 'storeDistribusiStaff'])->middleware('auth');
Route::put('/sapra/distribusi-staff/update/{id}', [SapraController::class, 'updateDistribusiStaff'])->middleware('auth');
Route::delete('/sapra/distribusi-staff/delete/{id}', [SapraController::class, 'destroyDistribusiStaff'])->middleware('auth');
Route::get('/sapra/distribusi-staff/cetak', [SapraController::class, 'cetakDistribusiStaff'])->middleware('auth');

// SARANA PEMERIKSAAN PROTEKSI
Route::get('/sapra/sarana-pemeriksaan', [SapraController::class, 'saranaPemeriksaan'])->middleware('auth');
Route::post('/sapra/sarana-pemeriksaan/store', [SapraController::class, 'storeSaranaPemeriksaan'])->middleware('auth');
Route::put('/sapra/sarana-pemeriksaan/update/{id}', [SapraController::class, 'updateSaranaPemeriksaan'])->middleware('auth');
Route::delete('/sapra/sarana-pemeriksaan/delete/{id}', [SapraController::class, 'destroySaranaPemeriksaan'])->middleware('auth');
Route::get('/sapra/sarana-pemeriksaan/cetak', [SapraController::class, 'cetakPdfSaranaPemeriksaan'])->middleware('auth');

// ==========================================
// ROUTE KELOLA INFOGRAFIS & BERITA MEDSOS (OPERATOR)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/internal/operator/infografis', [OperatorMedsosController::class, 'indexInfografis']);
    Route::post('/internal/operator/infografis/store', [OperatorMedsosController::class, 'storeInfografis']);
    Route::delete('/internal/operator/infografis/hapus/{id}', [OperatorMedsosController::class, 'destroyInfografis']);

    Route::get('/internal/operator/berita-medsos', [OperatorMedsosController::class, 'indexMedsos']);
    Route::post('/internal/operator/berita-medsos/store', [OperatorMedsosController::class, 'storeMedsos']);
    Route::put('/internal/operator/berita-medsos/update/{id}', [OperatorMedsosController::class, 'updateMedsos']);
    Route::delete('/internal/operator/berita-medsos/hapus/{id}', [OperatorMedsosController::class, 'destroyMedsos']);
});

// ==========================================
// ROUTE DAMTAN (PEMADAMAN & PENYELAMATAN)
// ==========================================
Route::get('/internal/damtan/input-data', [DamtanController::class, 'createPenyelamatan'])->name('damtan.laporan.create')->middleware('auth');
Route::post('/internal/damtan/input-data/store', [DamtanController::class, 'storePenyelamatan'])->name('damtan.laporan.store')->middleware('auth');
Route::get('/internal/damtan/data-laporan', [DamtanController::class, 'indexPenyelamatan'])->name('damtan.laporan.index')->middleware('auth');
Route::get('/internal/damtan/edit-data/{id}', [DamtanController::class, 'editPenyelamatan'])->name('damtan.laporan.edit')->middleware('auth');
Route::put('/internal/damtan/update-data/{id}', [DamtanController::class, 'updatePenyelamatan'])->name('damtan.laporan.update')->middleware('auth');
Route::delete('/internal/damtan/hapus-data/{id}', [DamtanController::class, 'destroyPenyelamatan'])->middleware('auth');
Route::get('/internal/damtan/lihat-data/{id}', [DamtanController::class, 'showPenyelamatan'])->middleware('auth');
// Dashboard Relawan Redkar
Route::get('/redkar/dashboard', function () {
    return view('redkar.halaman_utama'); 
})->name('redkar.dashboard')->middleware('auth:redkar');

// TAMBAHKAN RUTE PROFIL INI:
Route::get('/redkar/profil', [RedkarController::class, 'profilRedkar'])->name('redkar.profil')->middleware('auth:redkar');