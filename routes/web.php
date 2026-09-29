<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CekLoginPemohon;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SapraController;
use App\Http\Controllers\OperatorMedsosController;
use App\Http\Controllers\DukController; 
use App\Http\Controllers\DamtanController;
use App\Http\Controllers\RedkarController; 
use App\Http\Controllers\SuratKorbanController;
use App\Http\Controllers\PermohonanRpkbglController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\KabarDamkarController;
use App\Http\Controllers\PencegahanController;
use App\Http\Controllers\SkkAdminController;
use App\Http\Controllers\PemberdayaanController;
use App\Http\Controllers\PemohonAuthController;
use App\Http\Controllers\PermohonanSkkController;
use App\Http\Controllers\PermohonanEdukasiController;
use App\Http\Controllers\PetaController;
use App\Models\Berita;
use App\Models\Infografis;
use App\Models\BeritaMedsos;
use App\Models\EduDamkar;
use App\Models\UjungDamkar;

// ==========================================
// 1. RUTE PUBLIK (HALAMAN UTAMA & INFO)
// ==========================================
Route::get('/', function () {
    $daftar_berita = Berita::orderBy('tanggal_kejadian', 'desc')->take(4)->get();
    $daftar_infografis = Infografis::latest()->take(6)->get();
    $daftar_medsos = BeritaMedsos::latest()->take(6)->get();
    return view('homepage.index', compact('daftar_berita', 'daftar_infografis', 'daftar_medsos'));
});

// Program Kerja
Route::get('/sotk', function () { return view('programkerja.sotk'); });
Route::get('/pelaporan', function () { return view('programkerja.pelaporan'); });
Route::get('/perencanaan', function () { return view('programkerja.perencanaan'); });
Route::get('/produkhukum', function () { return view('programkerja.produkhukum'); });
Route::get('/sop', function () { return view('programkerja.sop'); });

// Informasi Layanan (Publik)
Route::get('/informasi-layanan', [PublicController::class, 'indexLayanan']);
Route::get('/informasi-sarana', [PublicController::class, 'informasiSarana']);
Route::get('/informasi-prasarana', [PublicController::class, 'informasiPrasarana']);
Route::get('/informasi-penyelamatan', [PublicController::class, 'informasiPenyelamatan']);
Route::get('/informasi-pemeriksaan', [PublicController::class, 'informasiPemeriksaan']);
Route::get('/berita/{id}', [BeritaController::class, 'showPublic']);
Route::get('/media-informasi', [KabarDamkarController::class, 'indexMediaInformasi'])->name('media.informasi');
Route::get('/sumber-air', [PublicController::class, 'sumberAir']);
Route::get('/hidrant-kota', [PublicController::class, 'hidrantKota']);
Route::get('/public-sigap', [PetaController::class, 'sigap']);

// Halaman Publik Edu Damkar, Ujung-ujung Damkar, & Info Grafis
Route::get('/edu-damkar', function () {
    $daftar_edu_damkar = EduDamkar::latest()->get();
    return view('kabardamkar.edu-damkar', compact('daftar_edu_damkar'));
})->name('publik.edu-damkar');

Route::get('/ujung-ujung-damkar', function () {
    $daftar_ujung_damkar = UjungDamkar::latest()->get();
    return view('kabardamkar.ujung-damkar', compact('daftar_ujung_damkar'));
})->name('publik.ujung-damkar');

// ---> INI ROUTE INFOGRAFIS YANG BARU DITAMBAHKAN <---
Route::get('/infografis', function () {
    $daftar_infografis = \App\Models\Infografis::latest()->paginate(12);
    return view('kabardamkar.infografis', compact('daftar_infografis'));
})->name('publik.infografis');


// ==========================================
// 2. RUTE AKUN PEMOHON (MASYARAKAT / PERUSAHAAN)
// ==========================================
Route::get('/pemohon/register', function () { 
    return view('pemohon.register'); 
})->name('pemohon.register');
Route::post('/pemohon/register', [PemohonAuthController::class, 'register']);

Route::get('/pemohon/login', function () { 
    return view('pemohon.login'); 
})->name('pemohon.login');
Route::post('/pemohon/login', [PemohonAuthController::class, 'login']);
Route::post('/pemohon/logout', [PemohonAuthController::class, 'logout'])->name('pemohon.logout');


// ==========================================
// 3. RUTE WAJIB LOGIN PEMOHON (LAYANAN)
// ==========================================
Route::middleware([CekLoginPemohon::class])->group(function () {
    
    // RPKBGL
    Route::get('/layanan-fasilitas/layanan_perizinan', function () { 
        return view('layanan-fasilitas.layanan_perizinan'); 
    })->name('layanan_perizinan');
    Route::post('/layanan-fasilitas/layanan_perizinan', [PermohonanRpkbglController::class, 'store'])->name('permohonan.store');

    // SKK
    Route::get('/layanan-fasilitas/skk', function () { 
        return view('layanan-fasilitas.skk'); 
    });
    Route::post('/permohonan-skk', [PermohonanSkkController::class, 'store'])->name('permohonan.skk.store');
    
    // Edukasi
    Route::get('/layanan-fasilitas/edukasi_sosialisasi', function () { 
        return view('layanan-fasilitas.edukasi_sosialisasi'); 
    });
    Route::post('/layanan-fasilitas/edukasi_sosialisasi/store', [PermohonanEdukasiController::class, 'store'])->name('permohonan.edukasi.store');

    // Redkar (Publik)
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

Route::middleware(['auth:redkar'])->group(function () {
    Route::get('/redkar/dashboard', function () { 
        return view('redkar.halaman_utama'); 
    })->name('redkar.dashboard');
    Route::get('/redkar/profil', [RedkarController::class, 'profilRedkar'])->name('redkar.profil');
});


// ==========================================
// 5. RUTE AUTH INTERNAL (ADMIN & PEGAWAI)
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/lupa-password', [AuthController::class, 'showForgotPassword']);
Route::post('/lupa-password', [AuthController::class, 'processForgotPassword']);
Route::post('/logout', [AuthController::class, 'logout']);


// ==========================================
// 6. RUTE INTERNAL PEGAWAI (DILINDUNGI)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // --- A. DASBOR & KELOLA USER ---
    Route::get('/internal/index', function () { return view('internal.index'); });
    Route::get('/internal/profil', [AuthController::class, 'showProfile']);
    Route::post('/internal/profil/update-password', [AuthController::class, 'updatePassword']);
    Route::get('/internal/kelola-user', [AuthController::class, 'kelolaUser']);
    Route::post('/internal/kelola-user/tambah', [AuthController::class, 'storeUser']);
    Route::put('/internal/kelola-user/update/{id}', [AuthController::class, 'updateUser']);

    Route::get('/internal/kelola-pemohon', function () {
        return view('pemohon.kelola_pemohon');
    })->name('internal.pemohon');

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

    // TAMBAHAN BARU: UJUNG-UJUNG DAMKAR
    Route::get('/internal/operator/ujung-damkar', [OperatorMedsosController::class, 'indexUjungDamkar'])->name('ujung-damkar.index');
    Route::post('/internal/operator/ujung-damkar/store', [OperatorMedsosController::class, 'storeUjungDamkar'])->name('ujung-damkar.store');
    Route::put('/internal/operator/ujung-damkar/update/{id}', [OperatorMedsosController::class, 'updateUjungDamkar'])->name('ujung-damkar.update');
    Route::delete('/internal/operator/ujung-damkar/hapus/{id}', [OperatorMedsosController::class, 'destroyUjungDamkar'])->name('ujung-damkar.destroy');

    // TAMBAHAN BARU: EDU DAMKAR
    Route::get('/internal/operator/edu-damkar', [OperatorMedsosController::class, 'indexEduDamkar'])->name('edu-damkar.index');
    Route::post('/internal/operator/edu-damkar/store', [OperatorMedsosController::class, 'storeEduDamkar'])->name('edu-damkar.store');
    Route::put('/internal/operator/edu-damkar/update/{id}', [OperatorMedsosController::class, 'updateEduDamkar'])->name('edu-damkar.update');
    Route::delete('/internal/operator/edu-damkar/hapus/{id}', [OperatorMedsosController::class, 'destroyEduDamkar'])->name('edu-damkar.destroy');

    // --- C. DAMTAN (PEMADAMAN & PENYELAMATAN) ---
    Route::get('/internal/damtan/input-data', [DamtanController::class, 'createPenyelamatan'])->name('damtan.laporan.create');
    Route::post('/internal/damtan/input-data/store', [DamtanController::class, 'storePenyelamatan'])->name('damtan.laporan.store');
    Route::get('/internal/damtan/data-laporan', [DamtanController::class, 'indexPenyelamatan'])->name('damtan.laporan.index');
    Route::get('/internal/damtan/edit-data/{id}', [DamtanController::class, 'editPenyelamatan'])->name('damtan.laporan.edit');
    Route::put('/internal/damtan/update-data/{id}', [DamtanController::class, 'updatePenyelamatan'])->name('damtan.laporan.update');
    Route::delete('/internal/damtan/hapus-data/{id}', [DamtanController::class, 'destroyPenyelamatan']);
    Route::get('/internal/damtan/lihat-data/{id}', [DamtanController::class, 'showPenyelamatan']);
    
    // Fitur Kelola Surat Korban
    Route::get('/internal/surat-korban/data', [DamtanController::class, 'indexSurat'])->name('surat-korban.data');
    Route::get('/internal/surat-korban/create', [DamtanController::class, 'createSurat']);
    Route::post('/internal/surat-korban/store', [DamtanController::class, 'storeSurat']);
    Route::get('/internal/surat-korban/cetak/{id}', [DamtanController::class, 'cetakSurat']);
    Route::get('/internal/surat-korban/edit/{id}', [DamtanController::class, 'editSurat']);
    Route::put('/internal/surat-korban/update/{id}', [DamtanController::class, 'updateSurat']);
    Route::delete('/internal/surat-korban/delete/{id}', [DamtanController::class, 'destroySurat']);

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
    // ROUTE EXCEL & PDF PENINGKATAN KAPASITAS (DIKLAT)
    Route::get('/internal/pencegahan/peningkatan-kapasitas/cetak-excel/{jenis}', [PencegahanController::class, 'cetakExcel']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/cetak-pdf/{jenis}', [PencegahanController::class, 'cetakPdf']);
    
    // ROUTE CETAK EXCEL & PDF INSPEKSI BANGUNAN & FIRE DRILL
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-excel', [PencegahanController::class, 'cetakExcelInspeksi']);
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-pdf', [PencegahanController::class, 'cetakPdfInspeksi']);
    Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill/cetak-excel', [PencegahanController::class, 'cetakExcelFireDrill']);
    Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill/cetak-pdf', [PencegahanController::class, 'cetakPdfFireDrill']);

    // 1. KELOLA REDKAR
    Route::get('/internal/pencegahan/kelola-redkar', [RedkarController::class, 'kelolaRedkarInternal']);
    Route::post('/internal/pencegahan/verifikasi-redkar/{id}', [RedkarController::class, 'verifikasiRedkar']);
    Route::get('/internal/pencegahan/edit-redkar/{id}', [RedkarController::class, 'editRedkar']);
    Route::put('/internal/pencegahan/update-redkar/{id}', [RedkarController::class, 'updateRedkar']);
    Route::delete('/internal/pencegahan/hapus-redkar/{id}', [RedkarController::class, 'hapusRedkar']);
    Route::get('/internal/pencegahan/cetak-redkar/{id}', [RedkarController::class, 'cetakRedkar']);
    Route::get('/internal/pencegahan/tambah-redkar', [RedkarController::class, 'createRedkar']);
    Route::post('/internal/pencegahan/simpan-redkar-offline', [RedkarController::class, 'storeRedkarOffline']);

    Route::get('/internal/pencegahan/kelola-rpkbgl', function () { 
    return view('internal.pencegahan.kelola_rpkbgl', [
        'permohonan' => App\Models\PermohonanRpkbgl::orderBy('created_at', 'desc')->get()
    ]); 
});
    Route::post('/internal/pencegahan/kelola-rpkbgl/update-status/{id}', function (Illuminate\Http\Request $request,$id) { 
        App\Models\PermohonanRpkbgl::where('id', $id)->update(['status_permohonan' =>$request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui!'); 
    });
    Route::get('/internal/pencegahan/kelola-rpkbgl/{id}', function ($id) { 
        return view('internal.pencegahan.detail_rpkbgl', ['permohonan' => App\Models\PermohonanRpkbgl::findOrFail($id)]); 
    });

    // -------- RUTE KELOLA SKK (MENGGUNAKAN CONTROLLER) --------
    Route::prefix('internal/pencegahan/kelola-skk')->name('skk.')->group(function () {
        Route::get('/', [SkkAdminController::class, 'index'])->name('index');
        Route::get('/tambah', [SkkAdminController::class, 'create'])->name('create');
        Route::post('/simpan', [SkkAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SkkAdminController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SkkAdminController::class, 'update'])->name('update');
        Route::delete('/hapus/{id}', [SkkAdminController::class, 'destroy'])->name('destroy');
        Route::post('/update-status/{id}', [SkkAdminController::class, 'updateStatus'])->name('update_status');
        
        // Rute detail (harus diletakkan di bawah rute lain agar parameter {id} tidak bentrok dengan kata 'tambah')
        Route::get('/{id}', [SkkAdminController::class, 'show'])->name('show'); 
    });
    
    // Pembaruan Status SKK Perpanjang
    Route::post('/internal/pencegahan/kelola-perpanjang-skk/update-status/{id}', [SkkAdminController::class, 'updateStatusPerpanjang'])->name('skk.update_status_perpanjang');
    // ----------------------------------------------------------

    // --- KELOLA EDUKASI (MENGGUNAKAN PermohonanEdukasiController) ---
    Route::get('/internal/pencegahan/kelola-edukasi', [App\Http\Controllers\PermohonanEdukasiController::class, 'index']);
    
    Route::post('/internal/pencegahan/kelola-edukasi/update-status/{id}', function (Illuminate\Http\Request $request, $id) { 
        App\Models\PermohonanEdukasi::where('id', $id)->update(['status_permohonan' => $request->status_permohonan]); 
        return redirect()->back()->with('success', 'Status Permohonan Edukasi berhasil diperbarui!'); 
    });
    
    Route::get('/internal/pencegahan/kelola-edukasi/{id}', [App\Http\Controllers\PermohonanEdukasiController::class, 'show']);
    // 3. MENU PENCEGAHAN KEBAKARAN & INSPEKSI (UTAMA)
    Route::get('/internal/pencegahan/inspeksi-kebakaran', function () { return view('internal.pencegahan.pencegahan_inspeksi'); });
    
    // Inspeksi Bangunan
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan', [PencegahanController::class, 'indexInspeksiBangunan']);
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah', [PencegahanController::class, 'create']);
    Route::post('/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah', [PencegahanController::class, 'store'])->name('inspeksi.store');
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/{id}/edit', [PencegahanController::class, 'editInspeksiBangunan'])->name('inspeksi.edit');
    Route::put('/internal/pencegahan/inspeksi-kebakaran/bangunan/{id}', [PencegahanController::class, 'updateInspeksiBangunan'])->name('inspeksi.update');
    Route::delete('/internal/pencegahan/inspeksi-kebakaran/bangunan/{id}', [PencegahanController::class, 'destroyInspeksiBangunan'])->name('inspeksi.destroy');

    // Fire Drill
    Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill', [PencegahanController::class, 'indexFireDrill']);
    Route::get('/internal/pencegahan/fire-drill/tambah', [PencegahanController::class, 'createFireDrill'])->name('fire_drill.create');
    Route::post('/internal/pencegahan/fire-drill/tambah', [PencegahanController::class, 'storeFireDrill'])->name('fire_drill.store');
    Route::get('/internal/pencegahan/fire-drill/{id}/edit', [PencegahanController::class, 'editFireDrill'])->name('fire_drill.edit');
    Route::put('/internal/pencegahan/fire-drill/{id}', [PencegahanController::class, 'updateFireDrill'])->name('fire_drill.update');
    Route::delete('/internal/pencegahan/fire-drill/{id}', [PencegahanController::class, 'destroyFireDrill'])->name('fire_drill.destroy');

    // 4. LAYANAN INSPEKSI (JADWAL)
    Route::get('/internal/pencegahan/layanan-inspeksi', function () { 
        return view('internal.pencegahan.layanan_inspeksi', ['data_inspeksi' => DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get()]); 
    });
    Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () { return view('internal.pencegahan.create_inspeksi'); });
    Route::post('/internal/pencegahan/layanan-inspeksi/tambah', function (Request $request) {
        $data =$request->except(['_token']);
        if ($request->hasFile('dokumen_pendukung')) {
            $file =$request->file('dokumen_pendukung');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/inspeksi'),$namaFile);
            $data['dokumen_pendukung'] =$namaFile;
        }
        $data['created_at'] = now();$data['updated_at'] = now();
        DB::table('jadwal_inspeksis')->insert($data);
        return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil ditambahkan!');
    });
    Route::get('/internal/pencegahan/layanan-inspeksi/lihat/{id}', function ($id) { return view('internal.pencegahan.lihat_inspeksi', ['data' => DB::table('jadwal_inspeksis')->where('id',$id)->first()]); });
    Route::get('/internal/pencegahan/layanan-inspeksi/edit/{id}', function ($id) { return view('internal.pencegahan.edit_inspeksi', ['data' => DB::table('jadwal_inspeksis')->where('id',$id)->first()]); });
    Route::post('/internal/pencegahan/layanan-inspeksi/edit/{id}', function (Request $request,$id) {
        $updateData =$request->except(['_token']);
        if ($request->hasFile('dokumen_pendukung')) {
            $file =$request->file('dokumen_pendukung');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/inspeksi'),$namaFile);
            $updateData['dokumen_pendukung'] =$namaFile;
        }
        $updateData['updated_at'] = now();
        DB::table('jadwal_inspeksis')->where('id', $id)->update($updateData);
        return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil diperbarui!');
    });

    // 5. LAYANAN SOSIALISASI
    Route::get('/internal/pencegahan/layanan-sosialisasi', function () { return view('internal.pencegahan.layanan_sosialisasi', ['data_sosialisasi' => DB::table('sosialisasi')->orderBy('id', 'desc')->get()]); });
    Route::get('/internal/pencegahan/layanan-sosialisasi/tambah', function () { return view('internal.pencegahan.create_sosialisasi'); });
    Route::post('/internal/pencegahan/layanan-sosialisasi/tambah', function (Request $request) {
        $data =$request->except(['_token']);
        if ($request->hasFile('surat_permohonan')) {
            $file =$request->file('surat_permohonan');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/sosialisasi'),$namaFile);
            $data['surat_permohonan'] =$namaFile;
        }
        $data['created_at'] = now();$data['updated_at'] = now();
        DB::table('sosialisasi')->insert($data);
        return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil ditambahkan!');
    });
    Route::get('/internal/pencegahan/layanan-sosialisasi/lihat/{id}', function ($id) { return view('internal.pencegahan.lihat_sosialisasi', ['data' => DB::table('sosialisasi')->where('id',$id)->first()]); });
    Route::get('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function ($id) { return view('internal.pencegahan.edit_sosialisasi', ['data' => DB::table('sosialisasi')->where('id',$id)->first()]); });
    Route::post('/internal/pencegahan/layanan-sosialisasi/edit/{id}', function (Request $request,$id) {
        $updateData =$request->except(['_token']);
        if ($request->hasFile('surat_permohonan')) {
            $file =$request->file('surat_permohonan');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/sosialisasi'),$namaFile);
            $updateData['surat_permohonan'] =$namaFile;
        }
        $updateData['updated_at'] = now();
        DB::table('sosialisasi')->where('id', $id)->update($updateData);
        return redirect('/internal/pencegahan/layanan-sosialisasi')->with('success', 'Data Sosialisasi berhasil diperbarui!');
    });

    // 6. LAYANAN PELATIHAN UMUM
    Route::get('/internal/pencegahan/pelatihan', function () { return view('internal.pencegahan.pelatihan', ['data_pelatihan' => DB::table('pelatihan')->orderBy('id', 'desc')->get()]); });
    Route::get('/internal/pencegahan/pelatihan/tambah', function () { return view('internal.pencegahan.create_pelatihan'); });
    Route::post('/internal/pencegahan/pelatihan/tambah', function (Request $request) {
        $data =$request->except(['_token']);
        if ($request->hasFile('surat_permohonan')) {
            $file =$request->file('surat_permohonan');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pelatihan'),$namaFile);
            $data['surat_permohonan'] =$namaFile;
        }
        $data['created_at'] = now();$data['updated_at'] = now();
        DB::table('pelatihan')->insert($data);
        return redirect('/internal/pencegahan/pelatihan')->with('success', 'Data Pelatihan berhasil ditambahkan!');
    });
    Route::get('/internal/pencegahan/pelatihan/lihat/{id}', function ($id) { return view('internal.pencegahan.lihat_pelatihan', ['data' => DB::table('pelatihan')->where('id',$id)->first()]); });
    Route::get('/internal/pencegahan/pelatihan/edit/{id}', function ($id) { return view('internal.pencegahan.edit_pelatihan', ['data' => DB::table('pelatihan')->where('id',$id)->first()]); });
    Route::post('/internal/pencegahan/pelatihan/edit/{id}', function (Request $request,$id) {
        $updateData =$request->except(['_token']);
        if ($request->hasFile('surat_permohonan')) {
            $file =$request->file('surat_permohonan');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pelatihan'),$namaFile);
            $updateData['surat_permohonan'] =$namaFile;
        }
        $updateData['updated_at'] = now();
        DB::table('pelatihan')->where('id', $id)->update($updateData);
        return redirect('/internal/pencegahan/pelatihan')->with('success', 'Data Pelatihan berhasil diperbarui!');
    });

    // 7. PEMBINAAN & PENGEMBANGAN
    Route::get('/internal/pencegahan/pembinaan-pengembangan', function () { return view('internal.pencegahan.pembinaan_pengembangan', ['data_pembinaan' => DB::table('pembinaan')->orderBy('id', 'desc')->get()]); });
    Route::get('/internal/pencegahan/pembinaan-pengembangan/tambah', function () { return view('internal.pencegahan.create_pembinaan'); });
    Route::post('/internal/pencegahan/pembinaan-pengembangan/tambah', function (Request $request) {
        $data =$request->except(['_token']);
        if ($request->hasFile('dokumen_pendukung')) {
            $file =$request->file('dokumen_pendukung');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pembinaan'),$namaFile);
            $data['dokumen_pendukung'] =$namaFile;
        }
        $data['created_at'] = now();$data['updated_at'] = now();
        DB::table('pembinaan')->insert($data);
        return redirect('/internal/pencegahan/pembinaan-pengembangan')->with('success', 'Data Pembinaan berhasil ditambahkan!');
    });
    Route::get('/internal/pencegahan/pembinaan-pengembangan/lihat/{id}', function ($id) { return view('internal.pencegahan.lihat_pembinaan', ['data' => DB::table('pembinaan')->where('id',$id)->first()]); });
    Route::get('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function ($id) { return view('internal.pencegahan.edit_pembinaan', ['data' => DB::table('pembinaan')->where('id',$id)->first()]); });
    Route::post('/internal/pencegahan/pembinaan-pengembangan/edit/{id}', function (Request $request,$id) {
        $updateData =$request->except(['_token']);
        if ($request->hasFile('dokumen_pendukung')) {
            $file =$request->file('dokumen_pendukung');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/pembinaan'),$namaFile);
            $updateData['dokumen_pendukung'] =$namaFile;
        }
        $updateData['updated_at'] = now();
        DB::table('pembinaan')->where('id', $id)->update($updateData);
        return redirect('/internal/pencegahan/pembinaan-pengembangan')->with('success', 'Data Pembinaan berhasil diperbarui!');
    });

    // 8. PEMBERDAYAAN MASYARAKAT, SOSIALISASI, & PELATIHAN KELUARGA
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat', [PemberdayaanController::class, 'index']);
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi', [PemberdayaanController::class, 'sosialisasi']);
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/create', [PemberdayaanController::class, 'create'])->name('pemberdayaan.create');
    Route::post('/internal/pencegahan/pemberdayaan-masyarakat/store', [PemberdayaanController::class, 'store'])->name('pemberdayaan.store');
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/edit/{id}', [PemberdayaanController::class, 'edit']);
    Route::put('/internal/pencegahan/pemberdayaan-masyarakat/update/{id}', [PemberdayaanController::class, 'update']);
    Route::delete('/internal/pencegahan/pemberdayaan-masyarakat/hapus/{id}', [PemberdayaanController::class, 'destroy']);
    
    // Pelatihan Keluarga
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga', [PencegahanController::class, 'indexPelatihanKeluarga'])->name('pelatihan_keluarga.index');
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/tambah', [PencegahanController::class, 'createPelatihanKeluarga'])->name('pelatihan_keluarga.create');
    Route::post('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/tambah', [PencegahanController::class, 'storePelatihanKeluarga'])->name('pelatihan_keluarga.store');
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/edit/{id}', [PencegahanController::class, 'editPelatihanKeluarga'])->name('pelatihan_keluarga.edit');
    Route::put('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/update/{id}', [PencegahanController::class, 'updatePelatihanKeluarga'])->name('pelatihan_keluarga.update');
    Route::delete('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/hapus/{id}', [PencegahanController::class, 'destroyPelatihanKeluarga'])->name('pelatihan_keluarga.destroy');

    // 9. PENINGKATAN KAPASITAS APARATUR (DIKLAT - CONTROLLER BASED)
    Route::get('/internal/pencegahan/peningkatan-kapasitas', [PencegahanController::class, 'indexPeningkatanKapasitas']);
    Route::get('/internal/pencegahan/peningkatan-kapasitas/tambah', [PencegahanController::class, 'createDiklat']);
    Route::post('/internal/pencegahan/peningkatan-kapasitas/simpan', [PencegahanController::class, 'storeDiklat']);
    // ---> TIMPA RUTE LIHAT, EDIT, DAN HAPUS DENGAN INI <---
    // Pelatihan Keluarga Tanggap Kebakaran (SESUAIKAN DENGAN URL EDIT/2)
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga', [PencegahanController::class, 'indexPelatihanKeluarga'])->name('pelatihan_keluarga.index');
    Route::get('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/tambah', [PencegahanController::class, 'createPelatihanKeluarga'])->name('pelatihan_keluarga.create');
    Route::post('/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/tambah', [PencegahanController::class, 'storePelatihanKeluarga'])->name('pelatihan_keluarga.store');
    
    Route::get('/internal/pencegahan/peningkatan-kapasitas/lihat/{jenis}/{id}', function ($jenis, $id) { 
        $map = ['diksar' => 'tbl_diksar', 'diklat-f1' => 'tbl_diklat_f1', 'diklat-f2' => 'tbl_diklat_f2', 'diklat-rescue' => 'tbl_diklat_rescue', 'diklat-mfr' => 'tbl_diklat_mfr', 'diklat-operator' => 'tbl_diklat_operator', 'diklat-inspektur' => 'tbl_diklat_inspektur', 'diklat-ppl' => 'tbl_diklat_ppl'];
        $tabel = $map[strtolower($jenis)] ?? 'tbl_diklat_f1';
        
        $data = DB::table($tabel)->where('id', $id)->first(); 
        if (!$data) return redirect()->back()->with('error', 'Data tidak ditemukan di tabel!');
        return view('internal.pencegahan.lihat_peningkatan', compact('data', 'jenis')); 
    });
    
    Route::get('/internal/pencegahan/peningkatan-kapasitas/edit/{jenis}/{id}', function ($jenis, $id) { 
        $map = ['diksar' => 'tbl_diksar', 'diklat-f1' => 'tbl_diklat_f1', 'diklat-f2' => 'tbl_diklat_f2', 'diklat-rescue' => 'tbl_diklat_rescue', 'diklat-mfr' => 'tbl_diklat_mfr', 'diklat-operator' => 'tbl_diklat_operator', 'diklat-inspektur' => 'tbl_diklat_inspektur', 'diklat-ppl' => 'tbl_diklat_ppl'];
        $tabel = $map[strtolower($jenis)] ?? 'tbl_diklat_f1';
        
        $data = DB::table($tabel)->where('id', $id)->first(); 
        
        // PENCEGAH ERROR NULL
        if (!$data) return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('error', 'Gagal Edit: Data tidak ada di database!');
        
        return view('internal.pencegahan.edit_peningkatan', compact('data', 'jenis')); 
    });
    
    // Kelola Redkar - Disesuaikan URL method POST Verifikasi agar cocok dengan Form Modal
    Route::get('/internal/pencegahan/kelola-redkar', [RedkarController::class, 'kelolaRedkarInternal']);
    Route::post('/internal/pencegahan/update-status-redkar/{id}', [RedkarController::class, 'verifikasiRedkar']);
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

    // Kelola SKK & CRUD Admin SKK
    Route::get('/internal/pencegahan/kelola-skk', function () { 
        return view('internal.pencegahan.kelola_skk', [
            'skk_baru' => App\Models\PermohonanSkk::orderBy('created_at', 'desc')->get(), 
            'skk_perpanjang' => App\Models\PermohonanPerpanjangSkk::orderBy('created_at', 'desc')->get()
        ]); 
    });
    Route::get('/internal/pencegahan/kelola-skk/tambah', [SkkAdminController::class, 'create'])->name('skk.create');
    Route::post('/internal/pencegahan/kelola-skk/store', [SkkAdminController::class, 'store'])->name('skk.store');
    Route::get('/internal/pencegahan/kelola-skk/edit/{id}', [SkkAdminController::class, 'edit'])->name('skk.edit');
    Route::put('/internal/pencegahan/kelola-skk/update/{id}', [SkkAdminController::class, 'update'])->name('skk.update');
    Route::delete('/internal/pencegahan/kelola-skk/hapus/{id}', [SkkAdminController::class, 'destroy'])->name('skk.destroy');

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

    // Inspeksi Kebakaran & Fire Drill (Halaman Utama)
    Route::get('/internal/pencegahan/inspeksi-kebakaran', [App\Http\Controllers\PencegahanController::class, 'index']);

    // Rute Inspeksi Bangunan
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan', [App\Http\Controllers\PencegahanController::class, 'indexInspeksiBangunan']);
    Route::get('/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah', [App\Http\Controllers\PencegahanController::class, 'create']);

    // Rute Fire Drill
    Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill', [App\Http\Controllers\PencegahanController::class, 'indexFireDrill']);
    Route::get('/internal/pencegahan/inspeksi-kebakaran/fire-drill/tambah', [App\Http\Controllers\PencegahanController::class, 'createFireDrill']);
    
    // Layanan Inspeksi
    Route::get('/internal/pencegahan/layanan-inspeksi', function () { 
        return view('internal.pencegahan.layanan_inspeksi', [
            'data_inspeksi' => DB::table('jadwal_inspeksis')->orderBy('id', 'desc')->get()
        ]); 
    });
    Route::get('/internal/pencegahan/layanan-inspeksi/tambah', function () { return view('internal.pencegahan.create_inspeksi'); });
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
    Route::get('/internal/pencegahan/layanan-sosialisasi/tambah', function () { return view('internal.pencegahan.create_sosialisasi'); });
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
    Route::get('/internal/pencegahan/pelatihan/tambah', function () { return view('internal.pencegahan.create_pelatihan'); });
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
    Route::get('/internal/pencegahan/pembinaan-pengembangan/tambah', function () { return view('internal.pencegahan.create_pembinaan'); });
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

    // ROUTE DUK KEPEGAWAIAN
    Route::prefix('internal/kepegawaian')->name('kepegawaian.')->group(function () {
        Route::get('/duk', [DukController::class, 'index'])->name('duk.index');
        Route::get('/duk/tambah', [DukController::class, 'create'])->name('duk.create'); 
        Route::post('/duk', [DukController::class, 'store'])->name('duk.store');
        Route::delete('/duk/{id}', [DukController::class, 'destroy'])->name('duk.destroy');
    });

});