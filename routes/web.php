<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CekLoginPemohon;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SapraController;
use App\Http\Controllers\OperatorMedsosController;
use App\Http\Controllers\DamtanController;
<<<<<<< HEAD
use App\Http\Controllers\PermohonanController; // <-- TAMBAHAN: Import PermohonanController
use App\Http\Controllers\PermohonanEdukasiController;
=======
use App\Http\Controllers\RedkarController; 
use App\Http\Controllers\SuratKorbanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\PublicController;
<<<<<<< HEAD
use App\Http\Controllers\KabarDamkarController;
use App\Http\Controllers\PencegahanController;
=======
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
use App\Models\Berita;
use App\Models\Infografis;
use App\Models\BeritaMedsos;

// ==========================================
// 1. RUTE PUBLIK (HALAMAN UTAMA & INFO)
// ==========================================
Route::get('/', function () {
    $daftar_berita = Berita::orderBy('tanggal_kejadian', 'desc')->take(4)->get();
    $daftar_infografis = Infografis::latest()->take(6)->get();
    $daftar_medsos = BeritaMedsos::latest()->take(6)->get();
    return view('homepage.index', compact('daftar_berita', 'daftar_infografis', 'daftar_medsos'));
});

<<<<<<< HEAD
// Program Kerja
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

// Informasi Layanan (Publik)
Route::get('/informasi-layanan', [PublicController::class, 'indexLayanan']);
Route::get('/informasi-sarana', [PublicController::class, 'informasiSarana']);
=======
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
<<<<<<< HEAD

// <-- TAMBAHAN: Route POST permohonan.store untuk menangani form submit
=======
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
Route::post('/layanan-fasilitas/layanan_perizinan/store', [PermohonanController::class, 'store'])->name('permohonan.store');

Route::get('/layanan-fasilitas/skk', function () { return view('layanan-fasilitas.skk'); });
Route::get('/layanan-fasilitas/perpanjang_skk', function () { return view('layanan-fasilitas.perpanjang_skk'); });
<<<<<<< HEAD
Route::get('/layanan-fasilitas/izin_penjualan', function () { return view('layanan-fasilitas.izin_penjualan'); });
Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () { return view('layanan-fasilitas.edukasi_sosialisasi'); });
Route::get('/layanan-fasilitas/pks', function () { return view('layanan-fasilitas.pks'); });

// Route untuk menampilkan halaman Kelola RPKBGL
Route::get('/internal/pencegahan/kelola-rpkbgl', function () {
    $permohonan = App\Models\PermohonanRpkbgl::orderBy('created_at', 'desc')->get();
    return view('internal.pencegahan.kelola_rpkbgl', compact('permohonan'));
});

// TAMBAHKAN ROUTE INI UNTUK UPDATE STATUS
Route::post('/internal/pencegahan/kelola-rpkbgl/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanRpkbgl::where('id', $id)->update([
        'status_permohonan' => $request->status_permohonan
    ]);
    return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui!');
});
// ROUTE UNTUK MENAMPILKAN HALAMAN DETAIL RPKBGL
Route::get('/internal/pencegahan/kelola-rpkbgl/{id}', function ($id) {
    $permohonan = App\Models\PermohonanRpkbgl::findOrFail($id);
    return view('internal.pencegahan.detail_rpkbgl', compact('permohonan'));
});

Route::post('/permohonan-skk', [App\Http\Controllers\PermohonanSkkController::class, 'store'])->name('permohonan.skk.store');

Route::get('/permohonan-skk', function () {
    return redirect('/layanan-fasilitas/skk'); // Redirect jika user mencoba akses manual via URL
});
Route::post('/permohonan-perpanjang-skk', [App\Http\Controllers\PermohonanPerpanjangSkkController::class, 'store'])->name('permohonan.perpanjang_skk.store');

=======
Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () { return view('layanan-fasilitas.edukasi_sosialisasi'); });
Route::get('/layanan-fasilitas/informasi_layanan', function () { return view('layanan-fasilitas.informasi_layanan'); });

Route::post('/permohonan-skk', [App\Http\Controllers\PermohonanSkkController::class, 'store'])->name('permohonan.skk.store');
Route::get('/permohonan-skk', function () {
    return redirect('/layanan-fasilitas/skk'); 
});

Route::post('/permohonan-perpanjang-skk', [App\Http\Controllers\PermohonanPerpanjangSkkController::class, 'store'])->name('permohonan.perpanjang_skk.store');
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
Route::get('/permohonan-perpanjang-skk', function () {
    return redirect('/layanan-fasilitas/perpanjang_skk');
});

<<<<<<< HEAD
// ==========================================
// ROUTE KELOLA SKK & PERPANJANG SKK
// ==========================================
Route::get('/internal/pencegahan/kelola-skk', function () {
    // Memanggil 2 model sekaligus untuk ditampilkan di 2 Tab berbeda
    $skk_baru = App\Models\PermohonanSkk::orderBy('created_at', 'desc')->get();
    $skk_perpanjang = App\Models\PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get();
    
    return view('internal.pencegahan.kelola_skk', compact('skk_baru', 'skk_perpanjang'));
});

// Update Status SKK Baru
Route::post('/internal/pencegahan/kelola-skk/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanSkk::where('id', $id)->update([
        'status_permohonan' => $request->status_permohonan
    ]);
    return redirect()->back()->with('success', 'Status Permohonan SKK Baru berhasil diperbarui!');
});

// Update Status Perpanjang SKK
Route::post('/internal/pencegahan/kelola-perpanjang-skk/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanPerpanjangSkk::where('id', $id)->update([
        'status_permohonan' => $request->status_permohonan
    ]);
    return redirect()->back()->with('success', 'Status Permohonan Perpanjangan SKK berhasil diperbarui!');
});

// ROUTE UNTUK MENAMPILKAN HALAMAN DETAIL SKK (BARU & PERPANJANGAN)
Route::get('/internal/pencegahan/kelola-skk/{id}', function (Illuminate\Http\Request $request, $id) {
    $tipe = $request->query('tipe', 'baru'); // default 'baru'
    
    if ($tipe === 'perpanjang') {
        $permohonan = App\Models\PermohonanPerpanjangSkk::findOrFail($id);
        $jenis_layanan = "Perpanjangan SKK";
    } else {
        $permohonan = App\Models\PermohonanSkk::findOrFail($id);
        $jenis_layanan = "SKK Baru";
    }
    
    return view('internal.pencegahan.detail_skk', compact('permohonan', 'tipe', 'jenis_layanan'));
});

// Route POST untuk memproses form Edukasi
Route::post('/layanan-fasilitas/edukasi_sosialisasi/store', [App\Http\Controllers\PermohonanEdukasiController::class, 'store'])->name('permohonan.edukasi.store');
// ==========================================
// ROUTE KELOLA EDUKASI & SOSIALISASI
// ==========================================
Route::get('/internal/pencegahan/kelola-edukasi', function () {
    $permohonan = App\Models\PermohonanEdukasi::orderBy('created_at', 'desc')->get();
    return view('internal.pencegahan.kelola_edukasi', compact('permohonan'));
});

Route::post('/internal/pencegahan/kelola-edukasi/update-status/{id}', function (Illuminate\Http\Request $request, $id) {
    App\Models\PermohonanEdukasi::where('id', $id)->update([
        'status_permohonan' => $request->status_permohonan
    ]);
    return redirect()->back()->with('success', 'Status Permohonan Edukasi berhasil diperbarui!');
});

Route::get('/internal/pencegahan/kelola-edukasi/{id}', function ($id) {
    $permohonan = App\Models\PermohonanEdukasi::findOrFail($id);
    return view('internal.pencegahan.detail_edukasi', compact('permohonan'));
});
// ==========================================
// ROUTE AUTH (LOGIN, LUPA PASSWORD, LOGOUT)
=======
Route::post('/layanan-fasilitas/edukasi_sosialisasi/store', [App\Http\Controllers\PermohonanEdukasiController::class, 'store'])->name('permohonan.edukasi.store');


// ==========================================
// RUTE INFORMASI LAYANAN PUBLIK (SAPRA)
// ==========================================
Route::get('/informasi-layanan', [PublicController::class, 'informasiLayanan']);
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
Route::get('/informasi-prasarana', [PublicController::class, 'informasiPrasarana']);
Route::get('/informasi-penyelamatan', [PublicController::class, 'informasiPenyelamatan']);
Route::get('/informasi-pemeriksaan', [PublicController::class, 'informasiPemeriksaan']);
Route::get('/berita/{id}', [BeritaController::class, 'showPublic']);


// ==========================================
// 2. RUTE AKUN PEMOHON (MASYARAKAT / PERUSAHAAN)
// ==========================================
Route::get('/pemohon/register', function () { 
    return view('pemohon.register'); 
})->name('pemohon.register');

Route::get('/pemohon/login', function () { 
    return view('pemohon.login'); 
})->name('pemohon.login');


// ==========================================
// 3. RUTE WAJIB LOGIN PEMOHON 
// ==========================================
// Menggunakan Middleware File 'CekLoginPemohon'
Route::middleware([CekLoginPemohon::class])->group(function () {
    
    // --- Layanan Perizinan & SKK ---
    Route::get('/layanan-fasilitas/layanan_perizinan', function () { 
        return view('layanan-fasilitas.layanan_perizinan'); 
    });
    Route::post('/layanan-fasilitas/layanan_perizinan/store', [PermohonanController::class, 'store'])->name('permohonan.store');

    Route::get('/layanan-fasilitas/skk', function () { 
        return view('layanan-fasilitas.skk'); 
    });
    Route::post('/permohonan-skk', [App\Http\Controllers\PermohonanSkkController::class, 'store'])->name('permohonan.skk.store');
    
    // --- Layanan Edukasi & Sosialisasi ---
    Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () { 
        return view('layanan-fasilitas.edukasi_sosialisasi'); 
    });
    Route::post('/layanan-fasilitas/edukasi_sosialisasi/store', [App\Http\Controllers\PermohonanEdukasiController::class, 'store'])->name('permohonan.edukasi.store');

    // --- Pendaftaran Redkar ---
    Route::get('/redkar', [RedkarController::class, 'index'])->name('redkar.register');
    Route::post('/redkar', [RedkarController::class, 'store']);
});


// ==========================================
// 4. RUTE LOGIN & DASHBOARD REDKAR
// ==========================================
Route::get('/login-redkar', function () { 
    return view('redkar.login_redkar'); 
})->name('login.redkar');
Route::post('/login-redkar', [RedkarController::class, 'processLoginRedkar']);
Route::post('/logout-redkar', [RedkarController::class, 'logoutRedkar'])->name('logout.redkar');

Route::middleware('auth:redkar')->group(function () {
    Route::get('/redkar/dashboard', function () { 
        return view('redkar.halaman_utama'); 
    })->name('redkar.dashboard');
    Route::get('/redkar/profil', [RedkarController::class, 'profilRedkar'])->name('redkar.profil');
});


// ==========================================
<<<<<<< HEAD
// 5. RUTE AUTH INTERNAL (ADMIN & PEGAWAI)
=======
// ROUTE AUTH (LOGIN INTERNAL PEGAWAI, LUPA PASSWORD, LOGOUT)
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/lupa-password', [AuthController::class, 'showForgotPassword']);
Route::post('/lupa-password', [AuthController::class, 'processForgotPassword']);
Route::post('/logout', [AuthController::class, 'logout']);

<<<<<<< HEAD
// ==========================================
// ROUTE INTERNAL & KELOLA USER
// ==========================================
Route::get('/internal/index', function () {
    return view('internal.index');
});
=======

// ==========================================
// 6. RUTE INTERNAL PEGAWAI (DILINDUNGI)
// ==========================================
<<<<<<< HEAD
=======
Route::get('/internal/index', function () {
    return view('internal.index');
})->middleware('auth');
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573

Route::get('/internal/profil', [AuthController::class, 'showProfile'])->middleware('auth');
Route::post('/internal/profil/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');

Route::get('/internal/kelola-user', [AuthController::class, 'kelolaUser'])->middleware('auth');
Route::post('/internal/kelola-user/tambah', [AuthController::class, 'storeUser'])->middleware('auth');
Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser'])->middleware('auth');
<<<<<<< HEAD
Route::get('/internal/pencegahan/kelola-redkar', [AuthController::class, 'kelolaRedkar']);
=======


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

>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
Route::middleware(['auth'])->group(function () {
    
    // --- A. DASBOR & KELOLA USER ---
    Route::get('/internal/index', function () { 
        return view('internal.index'); 
    });
    Route::get('/internal/profil', [AuthController::class, 'showProfile']);
    Route::post('/internal/profil/update-password', [AuthController::class, 'updatePassword']);
    Route::get('/internal/kelola-user', [AuthController::class, 'kelolaUser']);
    Route::post('/internal/kelola-user/tambah', [AuthController::class, 'storeUser']);
    Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser']);

    // --- B. OPERATOR MEDSOS ---
    Route::get('/internal/operator/kelola-berita', [BeritaController::class, 'indexInternal']);
    Route::get('/internal/operator/kelola-berita/tambah', [BeritaController::class, 'create']);
    Route::post('/internal/operator/kelola-berita/store', [BeritaController::class, 'store']);
    Route::get('/internal/operator/kelola-berita/edit/{id}', [BeritaController::class, 'edit']);
    Route::put('/internal/operator/kelola-berita/update/{id}', [BeritaController::class, 'update']);
    Route::delete('/internal/operator/kelola-berita/hapus/{id}', [BeritaController::class, 'destroy']);
    
    Route::get('/internal/operator/infografis', [OperatorMedsosController::class, 'indexInfografis']);
    Route::post('/internal/operator/infografis/store', [OperatorMedsosController::class, 'storeInfografis']);
    Route::delete('/internal/operator/infografis/hapus/{id}', [OperatorMedsosController::class, 'destroyInfografis']);
    
    Route::get('/internal/operator/berita-medsos', [OperatorMedsosController::class, 'indexMedsos']);
    Route::post('/internal/operator/berita-medsos/store', [OperatorMedsosController::class, 'storeMedsos']);
    Route::put('/internal/operator/berita-medsos/update/{id}', [OperatorMedsosController::class, 'updateMedsos']);
    Route::delete('/internal/operator/berita-medsos/hapus/{id}', [OperatorMedsosController::class, 'destroyMedsos']);

<<<<<<< HEAD
    // --- C. DAMTAN (PEMADAMAN & PENYELAMATAN) ---
    Route::get('/internal/damtan/input-data', [DamtanController::class, 'createPenyelamatan'])->name('damtan.laporan.create');
    Route::post('/internal/damtan/input-data/store', [DamtanController::class, 'storePenyelamatan'])->name('damtan.laporan.store');
    Route::get('/internal/damtan/data-laporan', [DamtanController::class, 'indexPenyelamatan'])->name('damtan.laporan.index');
    Route::get('/internal/damtan/edit-data/{id}', [DamtanController::class, 'editPenyelamatan'])->name('damtan.laporan.edit');
    Route::put('/internal/damtan/update-data/{id}', [DamtanController::class, 'updatePenyelamatan'])->name('damtan.laporan.update');
    Route::delete('/internal/damtan/hapus-data/{id}', [DamtanController::class, 'destroyPenyelamatan']);
    Route::get('/internal/damtan/lihat-data/{id}', [DamtanController::class, 'showPenyelamatan']);
=======
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

// Halaman Landing Umum (Kosongan)
Route::get('/informasi-layanan', [PublicController::class, 'indexLayanan']);
// Halaman Spesifik Sarana Pemadam
Route::get('/informasi-sarana', [PublicController::class, 'informasiSarana']);
Route::get('/informasi-prasarana', [PublicController::class, 'informasiPrasarana']);
Route::get('/informasi-penyelamatan', [PublicController::class, 'informasiPenyelamatan']);
Route::get('/informasi-pemeriksaan', [PublicController::class, 'informasiPemeriksaan']);
// --- ROUTE SURAT KORBAN KEBAKARAN (BARU) ---
Route::get('/internal/surat-korban/create', [DamtanController::class, 'createSurat'])->middleware('auth');
Route::post('/internal/surat-korban/store', [DamtanController::class, 'storeSurat'])->middleware('auth');
Route::get('/internal/surat-korban/cetak/{id}', [DamtanController::class, 'cetakSurat'])->middleware('auth');
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573


// ==========================================
// ROUTE PENCEGAHAN (SUPER LENGKAP)
// ==========================================

// 1. LAYANAN INSPEKSI
Route::get('/internal/pencegahan/layanan-inspeksi', function () {
    $data_inspeksi = DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.layanan_inspeksi', compact('data_inspeksi'));
});
Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () {
    return view('internal.pencegahan.create_inspeksi');
});
Route::get('/internal/pencegahan/inspeksi-kebakaran', function () {
    return view('internal.pencegahan.pencegahan_inspeksi'); // Sesuaikan nama file blade lu
});
// =======================================================
// ROUTE SEMUA TAB PENINGKATAN KAPASITAS APARATUR
// =======================================================

// 1. Semua Data (Bawaan)
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    $data_peningkatan = DB::table('peningkatan_kapasitas')->orderBy('id', 'desc')->get();
    return view('internal.pencegahan.peningkatan_kapasitas', compact('data_peningkatan'));
});

// 2. DIKSAR
Route::get('/internal/pencegahan/peningkatan-kapasitas/diksar', function () {
    return view('internal.pencegahan.diksar'); 
});

// 3. DIKLAT F1
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-f1', function () {
    return view('internal.pencegahan.diklat_f1'); 
});

// 4. DIKLAT F2
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-f2', function () {
    return view('internal.pencegahan.diklat_f2'); 
});

// 5. DIKLAT RESCUE
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-rescue', function () {
    return view('internal.pencegahan.diklat_rescue'); 
});

// 6. DIKLAT MFA
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-mfr', function () {
    return view('internal.pencegahan.diklat_mfa'); 
});

// 7. DIKLAT OPERATOR
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-operator', function () {
    return view('internal.pencegahan.diklat_operator'); 
});

// 8. DIKLAT INSPEKTUR
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur', function () {
    return view('internal.pencegahan.diklat_inspektur'); 
});

// 9. DIKLAT PPL
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-ppl', function () {
    return view('internal.pencegahan.diklat_ppl'); 
});
// ROUTE TAMBAH DATA DIKLAT
Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', function () {
    return view('internal.pencegahan.tambah_diklat'); 
});
// ROUTE MENU PENCEGAHAN KEBAKARAN DAN INSPEKSI (SEMUA DATA)
Route::get('/internal/pencegahan/inspeksi-kebakaran', function () {
    return view('internal.pencegahan.pencegahan_inspeksi'); 
});

// ROUTE TAB: INSPEKSI BANGUNAN GEDUNG DAN LINGKUNGAN
Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan', function () {
    return view('internal.pencegahan.inspeksi_bangunan'); 
});
// ROUTE TAMBAH DATA INSPEKSI BANGUNAN
Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah', function () {
    return view('internal.pencegahan.tambah_inspeksi_bangunan'); 
});
// ROUTE TAB: FIRE DRILL
Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill', function () {
    return view('internal.pencegahan.fire_drill'); 
});
Route::get('/internal/pencegahan/inspeksi-kebakaran', function () {
    return view('internal.pencegahan.pencegahan_inspeksi'); 
});

Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan', function () {
    return view('internal.pencegahan.inspeksi_bangunan'); 
});

Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill', function () {
    return view('internal.pencegahan.fire_drill'); 
});
use App\Http\Controllers\PencegahanController;

Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-f1', [PencegahanController::class, 'indexDiklatF1']);
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-f2', [App\Http\Controllers\PencegahanController::class, 'indexDiklatF2']);
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur', [App\Http\Controllers\PencegahanController::class, 'indexDiklatInspektur']);
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-mfr', [App\Http\Controllers\PencegahanController::class, 'indexDiklatMfr']);
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-rescue', [App\Http\Controllers\PencegahanController::class, 'indexDiklatRescue']);
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-operator', [App\Http\Controllers\PencegahanController::class, 'indexDiklatOperator']);
Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-ppl', [App\Http\Controllers\PencegahanController::class, 'indexDiklatPpl']);
// =======================================================
// ROUTE PEMBERDAYAAN MASYARAKAT DAN DUNIA USAHA
// =======================================================
Route::get('/internal/pencegahan/pemberdayaan-masyarakat', function () {
    return view('internal.pencegahan.pemberdayaan_masyarakat'); 
});

Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga', function () {
    return view('internal.pencegahan.pelatihan_keluarga'); 
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
Route::get('/internal/pencegahan/layanan-sosialisasi/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_sosialisasi', compact('data'));
});
Route::get('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('sosialisasi')->where('id', $id)->first();
    return view('internal.pencegahan.edit_sosialisasi', compact('data'));
});
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
Route::get('/internal/pencegahan/pelatihan/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pelatihan')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_pelatihan', compact('data'));
});
Route::get('/internal/pencegahan/pelatihan/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pelatihan')->where('id', $id)->first();
    return view('internal.pencegahan.edit_pelatihan', compact('data'));
});
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
Route::get('/internal/pencegahan/pembinaan-pengembangan/lihat/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pembinaan')->where('id', $id)->first();
    return view('internal.pencegahan.lihat_pembinaan', compact('data'));
});
Route::get('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function ($id) {
    $data = \Illuminate\Support\Facades\DB::table('pembinaan')->where('id', $id)->first();
    return view('internal.pencegahan.edit_pembinaan', compact('data'));
});
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
});

// 5. PENINGKATAN KAPASITAS (SUDAH DIPERBAIKI UNTUK MULTI TABEL F1, F2, DLL)
Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
    $dataDiksar = \Illuminate\Support\Facades\Schema::hasTable('tbl_diksar') ? DB::table('tbl_diksar')->orderBy('id', 'desc')->get() : [];
    $dataF1 = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f1') ? DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get() : [];
    $dataF2 = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f2') ? DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get() : [];
    $dataRescue = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_rescue') ? DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get() : [];
    $dataMfr = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_mfr') ? DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get() : [];
    $dataOperator = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_operator') ? DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get() : [];
    $dataInspektur = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_inspektur') ? DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get() : [];
    $dataPpl = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_ppl') ? DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get() : [];

    return view('internal.pencegahan.peningkatan_kapasitas', compact(
        'dataDiksar', 'dataF1', 'dataF2', 'dataRescue', 'dataMfr', 'dataOperator', 'dataInspektur', 'dataPpl'
    ));
});

Route::post('/internal/pencegahan/peningkatan-kapasitas/tambah', function (Request $request) {
    $jenis = strtoupper($request->jenis_diklat);
    $tabel_tujuan = 'tbl_diklat_f1'; // Default
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
    
    Route::get('/internal/surat-korban/create', [DamtanController::class, 'createSurat']);
    Route::post('/internal/surat-korban/store', [DamtanController::class, 'storeSurat']);
    Route::get('/internal/surat-korban/cetak/{id}', [DamtanController::class, 'cetakSurat']);

    // --- D. SAPRA (SARANA PRASARANA) ---
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
    
    Route::get('/sapra/prasarana-mako', [SapraController::class, 'prasaranaMako']);
    Route::get('/sapra/prasarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfMako']);
    Route::post('/sapra/prasarana-mako/store', [SapraController::class, 'storePrasaranaMako']);
    Route::put('/sapra/prasarana-mako/update/{id}', [SapraController::class, 'updatePrasaranaMako']);
    Route::delete('/sapra/prasarana-mako/delete/{id}', [SapraController::class, 'destroyPrasaranaMako']);
    
    Route::get('/sapra/sarana-mako', [SapraController::class, 'saranaMako']);
    Route::get('/sapra/sarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfSaranaMako']);
    Route::post('/sapra/sarana-mako/store', [SapraController::class, 'storeSaranaMako']);
    Route::put('/sapra/sarana-mako/update/{id}', [SapraController::class, 'updateSaranaMako']);
    Route::delete('/sapra/sarana-mako/delete/{id}', [SapraController::class, 'destroySaranaMako']);
    
    Route::get('/sapra/kelola-pos', [SapraController::class, 'kelolaPos']);
    Route::post('/sapra/kelola-pos/store', [SapraController::class, 'storePos']);
    Route::put('/sapra/kelola-pos/update/{id}', [SapraController::class, 'updatePos']);
    Route::delete('/sapra/kelola-pos/delete/{id}', [SapraController::class, 'destroyPos']);
    
    Route::get('/sapra/sarana-penyelamatan', [SapraController::class, 'saranaPenyelamatan']);
    Route::post('/sapra/sarana-penyelamatan/store', [SapraController::class, 'storeSaranaPenyelamatan']);
    Route::put('/sapra/sarana-penyelamatan/update/{id}', [SapraController::class, 'updateSaranaPenyelamatan']);
    Route::delete('/sapra/sarana-penyelamatan/delete/{id}', [SapraController::class, 'destroySaranaPenyelamatan']);
    Route::get('/sapra/sarana-penyelamatan/cetak-pdf', [SapraController::class, 'cetakPdfSaranaPenyelamatan']);
    
    Route::get('/sapra/kebutuhan-sarpras', [SapraController::class, 'kebutuhanSarpras']);
    Route::post('/sapra/kebutuhan-sarpras/store', [SapraController::class, 'storeKebutuhanSarpras']);
    Route::put('/sapra/kebutuhan-sarpras/update/{id}', [SapraController::class, 'updateKebutuhanSarpras']);
    Route::delete('/sapra/kebutuhan-sarpras/delete/{id}', [SapraController::class, 'destroyKebutuhanSarpras']);
    
    Route::post('/sapra/pengadaan-sarpras/store', [SapraController::class, 'storePengadaan']);
    Route::delete('/sapra/pengadaan-sarpras/delete/{kebutuhan_id}/{tahun}', [SapraController::class, 'destroyPengadaan']);
    Route::get('/sapra/kebutuhan-sarpras/cetak', [SapraController::class, 'cetakKebutuhan']);
    
    Route::get('/sapra/distribusi-staff', [SapraController::class, 'distribusiStaff']);
    Route::post('/sapra/distribusi-staff/store', [SapraController::class, 'storeDistribusiStaff']);
    Route::put('/sapra/distribusi-staff/update/{id}', [SapraController::class, 'updateDistribusiStaff']);
    Route::delete('/sapra/distribusi-staff/delete/{id}', [SapraController::class, 'destroyDistribusiStaff']);
    Route::get('/sapra/distribusi-staff/cetak', [SapraController::class, 'cetakDistribusiStaff']);
    
    Route::get('/sapra/sarana-pemeriksaan', [SapraController::class, 'saranaPemeriksaan']);
    Route::post('/sapra/sarana-pemeriksaan/store', [SapraController::class, 'storeSaranaPemeriksaan']);
    Route::put('/sapra/sarana-pemeriksaan/update/{id}', [SapraController::class, 'updateSaranaPemeriksaan']);
    Route::delete('/sapra/sarana-pemeriksaan/delete/{id}', [SapraController::class, 'destroySaranaPemeriksaan']);
    Route::get('/sapra/sarana-pemeriksaan/cetak', [SapraController::class, 'cetakPdfSaranaPemeriksaan']);

    // --- E. PENCEGAHAN ---
    
    // Kelola Redkar
    Route::get('/internal/pencegahan/kelola-redkar', [AuthController::class, 'kelolaRedkar']);
    Route::post('/internal/pencegahan/verifikasi-redkar/{id}', [RedkarController::class, 'verifikasiRedkar']);
    Route::get('/internal/pencegahan/edit-redkar/{id}', [RedkarController::class, 'editRedkar']);
    Route::put('/internal/pencegahan/update-redkar/{id}', [RedkarController::class, 'updateRedkar']);
    Route::delete('/internal/pencegahan/hapus-redkar/{id}', [RedkarController::class, 'hapusRedkar']);
    Route::get('/internal/pencegahan/cetak-redkar/{id}', [RedkarController::class, 'cetakRedkar']);
    Route::get('/internal/pencegahan/tambah-redkar', [RedkarController::class, 'createRedkar']);
    Route::post('/internal/pencegahan/simpan-redkar-offline', [RedkarController::class, 'storeRedkarOffline']);
    
    // Kelola RPKBGL
    Route::get('/internal/pencegahan/kelola-rpkbgl', function () { 
        return view('internal.pencegahan.kelola_rpkbgl', [
            'permohonan' => App\Models\PermohonanRpkbgl::orderBy('created_at', 'desc')->get()
        ]); 
    });
    Route::post('/internal/pencegahan/kelola-rpkbgl/update-status/{id}', function (Illuminate\Http\Request $request, $id) { 
        App\Models\PermohonanRpkbgl::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui!'); 
    });
    Route::get('/internal/pencegahan/kelola-rpkbgl/{id}', function ($id) { 
        return view('internal.pencegahan.detail_rpkbgl', [
            'permohonan' => App\Models\PermohonanRpkbgl::findOrFail($id)
        ]); 
    });

    // Kelola SKK
    Route::get('/internal/pencegahan/kelola-skk', function () { 
        return view('internal.pencegahan.kelola_skk', [
            'skk_baru' => App\Models\PermohonanSkk::orderBy('created_at', 'desc')->get(), 
            'skk_perpanjang' => App\Models\PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get()
        ]); 
    });
    Route::post('/internal/pencegahan/kelola-skk/update-status/{id}', function (Illuminate\Http\Request $request, $id) { 
        App\Models\PermohonanSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status Permohonan SKK Baru berhasil diperbarui!'); 
    });
    Route::post('/internal/pencegahan/kelola-perpanjang-skk/update-status/{id}', function (Illuminate\Http\Request $request, $id) { 
        App\Models\PermohonanPerpanjangSkk::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status Permohonan Perpanjangan SKK berhasil diperbarui!'); 
    });
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
    });

    // Kelola Edukasi
    Route::get('/internal/pencegahan/kelola-edukasi', function () { 
        return view('internal.pencegahan.kelola_edukasi', [
            'permohonan' => App\Models\PermohonanEdukasi::orderBy('created_at', 'desc')->get()
        ]); 
    });
    Route::post('/internal/pencegahan/kelola-edukasi/update-status/{id}', function (Illuminate\Http\Request $request, $id) { 
        App\Models\PermohonanEdukasi::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status Permohonan Edukasi berhasil diperbarui!'); 
    });
    Route::get('/internal/pencegahan/kelola-edukasi/{id}', function ($id) { 
        return view('internal.pencegahan.detail_edukasi', [
            'permohonan' => App\Models\PermohonanEdukasi::findOrFail($id)
        ]); 
    });

    // Inspeksi Kebakaran & Fire Drill
    Route::get('/internal/pencegahan/inspeksi-kebakaran', function () { 
        return view('internal.pencegahan.pencegahan_inspeksi'); 
    });
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan', function () { 
        return view('internal.pencegahan.inspeksi_bangunan'); 
    });
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah', function () { 
        return view('internal.pencegahan.tambah_inspeksi_bangunan'); 
    });
    Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill', function () { 
        return view('internal.pencegahan.fire_drill'); 
    });

    // Layanan Inspeksi
    Route::get('/internal/pencegahan/layanan-inspeksi', function () { 
        return view('internal.pencegahan.layanan_inspeksi', [
            'data_inspeksi' => DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get()
        ]); 
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
        return view('internal.pencegahan.lihat_inspeksi', [
            'data' => DB::table('jadwal_inspeksis')->where('id', $id)->first()
        ]); 
    });
    Route::get('/internal/pencegahan/layanan-inspeksi/edit/{id}', function ($id) { 
        return view('internal.pencegahan.edit_inspeksi', [
            'data' => DB::table('jadwal_inspeksis')->where('id', $id)->first()
        ]); 
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

    // Layanan Sosialisasi
    Route::get('/internal/pencegahan/layanan-sosialisasi', function () { 
        return view('internal.pencegahan.layanan_sosialisasi', [
            'data_sosialisasi' => DB::table('sosialisasi')->orderBy('id', 'desc')->get()
        ]); 
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
    Route::get('/internal/pencegahan/layanan-sosialisasi/lihat/{id}', function ($id) { 
        return view('internal.pencegahan.lihat_sosialisasi', [
            'data' => DB::table('sosialisasi')->where('id', $id)->first()
        ]); 
    });
    Route::get('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function ($id) { 
        return view('internal.pencegahan.edit_sosialisasi', [
            'data' => DB::table('sosialisasi')->where('id', $id)->first()
        ]); 
    });
    Route::post('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function (Request $request, $id) { 
        $updateData = $request->except(['_token']); 
        if ($request->hasFile('surat_permohonan')) { 
            $file = $request->file('surat_permohonan'); 
            $namaFile = time() . "_" . $file->getClientOriginalName(); 
            $file->move(public_path('uploads/sosialisasi'), $namaFile); 
            $updateData['surat_permohonan'] = $namaFile; 
        } 
        $updateData['updated_at'] = now(); 
        DB::table('sosialisasi')->where('id', $id)->update($updateData); 
        return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil diperbarui!'); 
    });

    // Pelatihan Umum
    Route::get('/internal/pencegahan/pelatihan', function () { 
        return view('internal.pencegahan.pelatihan', [
            'data_pelatihan' => DB::table('pelatihan')->orderBy('id', 'desc')->get()
        ]); 
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
    Route::get('/internal/pencegahan/pelatihan/lihat/{id}', function ($id) { 
        return view('internal.pencegahan.lihat_pelatihan', [
            'data' => DB::table('pelatihan')->where('id', $id)->first()
        ]); 
    });
    Route::get('/internal/pencegahan/pelatihan/edit/{id}', function ($id) { 
        return view('internal.pencegahan.edit_pelatihan', [
            'data' => DB::table('pelatihan')->where('id', $id)->first()
        ]); 
    });
    Route::post('/internal/pencegahan/pelatihan/edit/{id}', function (Request $request, $id) { 
        $updateData = $request->except(['_token']); 
        if ($request->hasFile('surat_permohonan')) { 
            $file = $request->file('surat_permohonan'); 
            $namaFile = time() . "_" . $file->getClientOriginalName(); 
            $file->move(public_path('uploads/pelatihan'), $namaFile); 
            $updateData['surat_permohonan'] = $namaFile; 
        } 
        $updateData['updated_at'] = now(); 
        DB::table('pelatihan')->where('id', $id)->update($updateData); 
        return redirect('/internal/pencegahan/pelatihan')->with('success', 'Data Pelatihan berhasil diperbarui!'); 
    });

    // Pembinaan & Pengembangan
    Route::get('/internal/pencegahan/pembinaan-pengembangan', function () { 
        return view('internal.pencegahan.pembinaan_pengembangan', [
            'data_pembinaan' => DB::table('pembinaan')->orderBy('id', 'desc')->get()
        ]); 
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
    Route::get('/internal/pencegahan/pembinaan-pengembangan/lihat/{id}', function ($id) { 
        return view('internal.pencegahan.lihat_pembinaan', [
            'data' => DB::table('pembinaan')->where('id', $id)->first()
        ]); 
    });
    Route::get('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function ($id) { 
        return view('internal.pencegahan.edit_pembinaan', [
            'data' => DB::table('pembinaan')->where('id', $id)->first()
        ]); 
    });
    Route::post('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function (Request $request, $id) { 
        $updateData = $request->except(['_token']); 
        if ($request->hasFile('dokumen_pendukung')) { 
            $file = $request->file('dokumen_pendukung'); 
            $namaFile = time() . "_" . $file->getClientOriginalName(); 
            $file->move(public_path('uploads/pembinaan'), $namaFile); 
            $updateData['dokumen_pendukung'] = $namaFile; 
        } 
        $updateData['updated_at'] = now(); 
        DB::table('pembinaan')->where('id', $id)->update($updateData); 
        return redirect('/internal/pencegahan/pembinaan-pengembangan')->with('success', 'Data Pembinaan berhasil diperbarui!'); 
    });

    // Pemberdayaan Masyarakat
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat', function () { 
        return view('internal.pencegahan.pemberdayaan_masyarakat'); 
    });
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga', function () { 
        return view('internal.pencegahan.pelatihan_keluarga'); 
    });

    // Peningkatan Kapasitas Aparatur (Multi Tabel)
    Route::get('/internal/pencegahan/peningkatan-kapasitas', function () {
        $dataDiksar = \Illuminate\Support\Facades\Schema::hasTable('tbl_diksar') ? DB::table('tbl_diksar')->orderBy('id', 'desc')->get() : [];
        $dataF1 = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f1') ? DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get() : [];
        $dataF2 = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f2') ? DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get() : [];
        $dataRescue = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_rescue') ? DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get() : [];
        $dataMfr = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_mfr') ? DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get() : [];
        $dataOperator = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_operator') ? DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get() : [];
        $dataInspektur = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_inspektur') ? DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get() : [];
        $dataPpl = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_ppl') ? DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get() : [];

        return view('internal.pencegahan.peningkatan_kapasitas', compact(
            'dataDiksar', 'dataF1', 'dataF2', 'dataRescue', 'dataMfr', 'dataOperator', 'dataInspektur', 'dataPpl'
        ));
    });

    Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', function () { 
        return view('internal.pencegahan.tambah_diklat'); 
    });

    Route::post('/internal/pencegahan/peningkatan-kapasitas/tambah', function (Request $request) {
        $jenis = strtoupper($request->jenis_diklat);
        $tabel_tujuan = 'tbl_diklat_f1'; // Default
        
        if ($jenis == 'DIKSAR') { $tabel_tujuan = 'tbl_diksar'; }
        elseif ($jenis == 'DIKLAT F1') { $tabel_tujuan = 'tbl_diklat_f1'; }
        elseif ($jenis == 'DIKLAT F2') { $tabel_tujuan = 'tbl_diklat_f2'; }
        elseif ($jenis == 'DIKLAT RESCUE') { $tabel_tujuan = 'tbl_diklat_rescue'; }
        elseif ($jenis == 'DIKLAT MFR') { $tabel_tujuan = 'tbl_diklat_mfr'; }
        elseif ($jenis == 'DIKLAT OPERATOR') { $tabel_tujuan = 'tbl_diklat_operator'; }
        elseif ($jenis == 'DIKLAT INSPEKTUR') { $tabel_tujuan = 'tbl_diklat_inspektur'; }
        elseif ($jenis == 'DIKLAT PPL') { $tabel_tujuan = 'tbl_diklat_ppl'; }

        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi_daerah ?? $request->instansi,
            'jenis_diklat' => $request->jenis_diklat,
            'instansi_penyelenggara' => $request->penyelenggara ?? $request->instansi_penyelenggara,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'tanggal_pelaksanaan' => $request->tgl_pelaksanaan ?? $request->tanggal_pelaksanaan,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'ditandatangani_oleh' => $request->ditanda_tangani ?? $request->ditandatangani_oleh,
            'jumlah_jam_pelajaran' => $request->jumlah_jp ?? $request->jumlah_jam_pelajaran,
            'kode_verifikasi' => $request->kode_verifikasi,
            'persentasi_penilaian' => $request->persentase_penilaian ?? $request->persentasi_penilaian,
            'ket' => $request->keterangan ?? $request->ket,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table($tabel_tujuan)->insert($data);
        return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil ditambahkan!');
    });

    Route::get('/internal/pencegahan/peningkatan-kapasitas/lihat/{jenis}/{id}', function ($jenis, $id) { 
        $tabel = 'tbl_' . str_replace('-', '_', $jenis); 
        $data = DB::table($tabel)->where('id', $id)->first(); 
        return view('internal.pencegahan.lihat_peningkatan', compact('data', 'jenis')); 
    });

    Route::get('/internal/pencegahan/peningkatan-kapasitas/edit/{jenis}/{id}', function ($jenis, $id) { 
        $tabel = 'tbl_' . str_replace('-', '_', $jenis); 
        $data = DB::table($tabel)->where('id', $id)->first(); 
        return view('internal.pencegahan.edit_peningkatan', compact('data', 'jenis')); 
    });

    Route::post('/internal/pencegahan/peningkatan-kapasitas/edit/{jenis}/{id}', function (Request $request, $jenis, $id) { 
        $tabel = 'tbl_' . str_replace('-', '_', $jenis); 
        $updateData = [ 
            'nama' => $request->nama, 
            'nik' => $request->nik, 
            'tempat_lahir' => $request->tempat_lahir, 
            'tgl_lahir' => $request->tgl_lahir, 
            'jabatan' => $request->jabatan, 
            'instansi' => $request->instansi_daerah ?? $request->instansi, 
            'jenis_diklat' => $request->jenis_diklat, 
            'instansi_penyelenggara' => $request->penyelenggara ?? $request->instansi_penyelenggara, 
            'provinsi' => $request->provinsi, 
            'kota' => $request->kota, 
            'tanggal_pelaksanaan' => $request->tgl_pelaksanaan ?? $request->tanggal_pelaksanaan, 
            'nomor_sertifikat' => $request->nomor_sertifikat, 
            'ditandatangani_oleh' => $request->ditanda_tangani ?? $request->ditandatangani_oleh, 
            'jumlah_jam_pelajaran' => $request->jumlah_jp ?? $request->jumlah_jam_pelajaran, 
            'kode_verifikasi' => $request->kode_verifikasi, 
            'persentasi_penilaian' => $request->persentase_penilaian ?? $request->persentasi_penilaian, 
            'ket' => $request->keterangan ?? $request->ket, 
            'updated_at' => now(), 
        ]; 
        DB::table($tabel)->where('id', $id)->update($updateData); 
        return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil diperbarui!'); 
    });

    Route::delete('/internal/pencegahan/peningkatan-kapasitas/hapus/{jenis}/{id}', function ($jenis, $id) { 
        $tabel = 'tbl_' . str_replace('-', '_', $jenis); 
        DB::table($tabel)->where('id', $id)->delete(); 
        return redirect()->back()->with('success', 'Data berhasil dihapus!'); 
    });

    // Halaman Index Masing-masing Diklat (Controller Based)
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diksar', function () { 
        return view('internal.pencegahan.diksar'); 
    });
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-f1', [PencegahanController::class, 'indexDiklatF1']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-f2', [PencegahanController::class, 'indexDiklatF2']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur', [PencegahanController::class, 'indexDiklatInspektur']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-mfr', [PencegahanController::class, 'indexDiklatMfr']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-rescue', [PencegahanController::class, 'indexDiklatRescue']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-operator', [PencegahanController::class, 'indexDiklatOperator']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/diklat-ppl', [PencegahanController::class, 'indexDiklatPpl']);

});
// ==========================================
// 2. RUTE AKUN PEMOHON (MASYARAKAT / PERUSAHAAN)
// ==========================================

<<<<<<< HEAD
// Pendaftaran
Route::get('/pemohon/register', function () { 
    return view('pemohon.register'); 
})->name('pemohon.register');
Route::post('/pemohon/register', [App\Http\Controllers\PemohonAuthController::class, 'register']);

// Login & Logout
Route::get('/pemohon/login', function () { 
    return view('pemohon.login'); 
})->name('pemohon.login');

// 👇 INI ADALAH BARIS YANG KEMUNGKINAN BELUM ADA / TERLEWAT 👇
Route::post('/pemohon/login', [App\Http\Controllers\PemohonAuthController::class, 'login']);

Route::post('/pemohon/logout', [App\Http\Controllers\PemohonAuthController::class, 'logout'])->name('pemohon.logout');
=======
Route::delete('/internal/pencegahan/peningkatan-kapasitas/hapus/{jenis}/{id}', function ($jenis, $id) {
    $tabel = 'tbl_' . str_replace('-', '_', $jenis);
    \Illuminate\Support\Facades\DB::table($tabel)->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Data berhasil dihapus!');
<<<<<<< HEAD
});

// ==========================================
// RUTE PUBLIK & CETAK REDKAR
// ==========================================
Route::get('/redkar', function () { return view('public.form_redkar'); });
Route::post('/redkar', [AuthController::class, 'storeRedkar']);
Route::get('/internal/pencegahan/cetak-redkar/{id}', [AuthController::class, 'cetakRedkar']);

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
Route::get('/sapra/logistik', [SapraController::class, 'logistik']);

// Data Hidrant Kota
Route::get('/sapra/data-hidrant-kota', [SapraController::class, 'dataHidrantKota']);
Route::get('/sapra/data-hidrant-kota/cetak-pdf', [SapraController::class, 'cetakPdfKota']);
Route::post('/sapra/data-hidrant-kota/store', [SapraController::class, 'storeHidrantKota']);
Route::put('/sapra/data-hidrant-kota/update/{id}', [SapraController::class, 'updateHidrantKota']);
Route::delete('/sapra/data-hidrant-kota/delete/{id}', [SapraController::class, 'destroyHidrantKota']);
Route::get('/sapra/data-hidrant-kota/cetak-excel', [SapraController::class, 'cetakExcelKota']);

// Data Hidrant Gedung
Route::get('/sapra/data_hidrant_gedung', [SapraController::class, 'dataHidrantGedung']);
Route::post('/sapra/hidran/store', [SapraController::class, 'storeHidran']);
Route::put('/sapra/hidran/update/{id}', [SapraController::class, 'updateHidran']);
Route::delete('/sapra/hidran/delete/{id}', [SapraController::class, 'destroyHidran']);
Route::get('/sapra/hidran/cetak-pdf', [SapraController::class, 'cetakPdfHidranGedung']);
Route::get('/sapra/hidran/cetak-excel', [SapraController::class, 'cetakExcelHidran']);

// Prasarana Mako
Route::get('/sapra/prasarana-mako', [SapraController::class, 'prasaranaMako']);
Route::get('/sapra/prasarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfMako']);
Route::post('/sapra/prasarana-mako/store', [SapraController::class, 'storePrasaranaMako']);
Route::put('/sapra/prasarana-mako/update/{id}', [SapraController::class, 'updatePrasaranaMako']);
Route::delete('/sapra/prasarana-mako/delete/{id}', [SapraController::class, 'destroyPrasaranaMako']);

// Sarana Mako & Pos 
Route::get('/sapra/sarana-mako', [SapraController::class, 'saranaMako']);
Route::get('/sapra/sarana-mako/cetak-pdf', [SapraController::class, 'cetakPdfSaranaMako']);
Route::post('/sapra/sarana-mako/store', [SapraController::class, 'storeSaranaMako']);
Route::put('/sapra/sarana-mako/update/{id}', [SapraController::class, 'updateSaranaMako']);
Route::delete('/sapra/sarana-mako/delete/{id}', [SapraController::class, 'destroySaranaMako']);

// Nambah pos
Route::get('/sapra/kelola-pos', [SapraController::class, 'kelolaPos']);
Route::post('/sapra/kelola-pos/store', [SapraController::class, 'storePos']);
Route::put('/sapra/kelola-pos/update/{id}', [SapraController::class, 'updatePos']);
Route::delete('/sapra/kelola-pos/delete/{id}', [SapraController::class, 'destroyPos']);

// RUTE SARANA MAKO & POS PENYELAMATAN
Route::get('/sapra/sarana-penyelamatan', [SapraController::class, 'saranaPenyelamatan']);
Route::post('/sapra/sarana-penyelamatan/store', [SapraController::class, 'storeSaranaPenyelamatan']);
Route::put('/sapra/sarana-penyelamatan/update/{id}', [SapraController::class, 'updateSaranaPenyelamatan']);
Route::delete('/sapra/sarana-penyelamatan/delete/{id}', [SapraController::class, 'destroySaranaPenyelamatan']);
Route::get('/sapra/sarana-penyelamatan/cetak-pdf', [SapraController::class, 'cetakPdfSaranaPenyelamatan']);

// Rute kebutuhan sapras
Route::get('/sapra/kebutuhan-sarpras', [SapraController::class, 'kebutuhanSarpras']);
Route::post('/sapra/kebutuhan-sarpras/store', [SapraController::class, 'storeKebutuhanSarpras']);
Route::put('/sapra/kebutuhan-sarpras/update/{id}', [SapraController::class, 'updateKebutuhanSarpras']);
Route::delete('/sapra/kebutuhan-sarpras/delete/{id}', [SapraController::class, 'destroyKebutuhanSarpras']);

// Tambahan route khusus untuk Pengadaan
Route::post('/sapra/pengadaan-sarpras/store', [SapraController::class, 'storePengadaan']);
Route::delete('/sapra/pengadaan-sarpras/delete/{kebutuhan_id}/{tahun}', [SapraController::class, 'destroyPengadaan']);

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
Route::get('/internal/damtan/input-data', [DamtanController::class, 'createPenyelamatan'])->name('damtan.laporan.create');
Route::post('/internal/damtan/input-data/store', [DamtanController::class, 'storePenyelamatan'])->name('damtan.laporan.store');
Route::get('/internal/damtan/data-laporan', [DamtanController::class, 'indexPenyelamatan'])->name('damtan.laporan.index');
Route::get('/internal/damtan/edit-data/{id}', [DamtanController::class, 'editPenyelamatan'])->name('damtan.laporan.edit');
Route::put('/internal/damtan/update-data/{id}', [DamtanController::class, 'updatePenyelamatan'])->name('damtan.laporan.update');
Route::delete('/internal/damtan/hapus-data/{id}', [DamtanController::class, 'destroyPenyelamatan']);
Route::get('/internal/damtan/lihat-data/{id}', [DamtanController::class, 'showPenyelamatan']);
=======
});
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
