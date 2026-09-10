<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Leaflet CSS (Untuk Peta) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; padding-left: 15px; letter-spacing: 1px; border-top: 1px dashed #e5e7eb; padding-top: 15px; }

        /* --- MAIN AREA --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;}
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        /* Custom Tab Styles */
        .nav-tabs .nav-link { color: #6b7280; font-weight: 600; border: none; padding: 12px 20px; }
        .nav-tabs .nav-link:hover { color: #10b981; }
        .nav-tabs .nav-link.active { color: #111827 !important; border-bottom: 3px solid #10b981 !important; background: transparent; }

        #map { height: 400px; width: 100%; border-radius: 8px; border: 1px solid #e5e7eb; }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
                </span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'pemadaman' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item active"><i class="fas fa-users-cog"></i> Data Laporan</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
        </aside>

        <!-- MAIN AREA (FORM EDIT) -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Edit Data Penyelamatan</h1>
                    <p>Memperbarui data untuk Nomor Laporan: <strong class="text-primary">REG-20240101-003</strong></p>
                </div>
                <div>
                    <a href="/internal/damtan/data-laporan" class="btn btn-outline-secondary fw-bold shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Batal / Kembali
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white pt-4 pb-0 border-bottom" style="border-bottom: 2px solid #f3f4f6 !important;">
                    <!-- BOOTSTRAP TABS -->
                    <ul class="nav nav-tabs border-0" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">1. Informasi Dasar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teknis-tab" data-bs-toggle="tab" data-bs-target="#teknis" type="button" role="tab">2. Teknis & Logistik</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dokumentasi-tab" data-bs-toggle="tab" data-bs-target="#dokumentasi" type="button" role="tab">3. Dokumentasi & Validasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="khusus-tab" data-bs-toggle="tab" data-bs-target="#khusus" type="button" role="tab">4. Kategori Khusus</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4 bg-white">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- PENTING: Directive PUT untuk mengupdate data di Laravel -->
                        @method('PUT') 
                        
                        <div class="tab-content" id="formTabsContent">
                            
                            <!-- TAB 1: INFORMASI DASAR -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Dasar Kejadian</h5>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Nomor Laporan (Auto)</label>
                                        <!-- Value pre-filled -->
                                        <input type="text" class="form-control" name="nomor_laporan" value="REG-20240101-003" readonly style="background-color: #f9fafb;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">ID Laporan (Auto)</label>
                                        <!-- Value pre-filled -->
                                        <input type="text" class="form-control" name="id_laporan" value="UUID-ANIM-789" readonly style="background-color: #f9fafb;">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-danger fw-bold" style="font-size: 13px;">Kategori Laporan (Kebakaran)</label>
                                        <select class="form-select" name="kategori_kebakaran">
                                            <option value="">-- Pilih Jenis Kebakaran --</option>
                                            <option value="rumah_tinggal">Rumah Tinggal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-primary fw-bold" style="font-size: 13px;">Kategori Laporan (Non-Kebakaran)</label>
                                        <select class="form-select" name="kategori_non_kebakaran">
                                            <option value="">-- Pilih Jenis Evakuasi/Penyelamatan --</option>
                                            <!-- Option Selected -->
                                            <option value="animal_rescue" selected>Evakuasi Hewan (Animal Rescue)</option>
                                            <option value="pohon_tumbang">Pohon Tumbang</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold" style="font-size: 13px; color: #4b5563;">Kategori Kejadian Umum</label>
                                        <select class="form-select" name="kategori_kejadian">
                                            <option value="">-- Pilih Kategori Kejadian --</option>
                                            <option value="kebakaran">Kebakaran</option>
                                            <!-- Option Selected -->
                                            <option value="penyelamatan_hewan" selected>Penyelamatan Hewan</option>
                                            <option value="bencana_alam">Bencana Alam</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label d-block" style="font-size: 13px; font-weight: 600; color: #4b5563;">Tingkat Prioritas</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="rendah">
                                            <label class="form-check-label text-secondary fw-bold">Rendah</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <!-- Radio Checked -->
                                            <input class="form-check-input" type="radio" name="prioritas" value="sedang" checked>
                                            <label class="form-check-label text-primary fw-bold">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="tinggi">
                                            <label class="form-check-label text-warning fw-bold">Tinggi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="darurat">
                                            <label class="form-check-label text-danger fw-bold">Darurat</label>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-4" style="font-size: 14px;">Detail Waktu Operasi</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Waktu Kejadian</label>
                                        <!-- Value pre-filled date & time format -->
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control" value="2024-01-10T16:00">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Waktu Terima Laporan</label>
                                        <input type="datetime-local" name="waktu_terima" class="form-control" value="2024-01-10T16:15">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Waktu Berangkat Unit</label>
                                        <input type="datetime-local" name="waktu_berangkat" class="form-control" value="2024-01-10T16:20">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Waktu Tiba di Lokasi</label>
                                        <input type="datetime-local" name="waktu_tiba" class="form-control" value="2024-01-10T16:30">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Waktu Operasi Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control" value="2024-01-10T16:45">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Alamat Lengkap</label>
                                        <!-- Textarea Content -->
                                        <textarea class="form-control" name="alamat" rows="3">Jl. Pattimura No. 12, RT 09, Kecamatan Telanaipura</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Titik Koordinat (Lat, Long)</label>
                                        <input type="text" class="form-control mb-2" id="inputKoordinat" name="koordinat" value="-1.60921, 103.58231">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#mapModal">
                                            <i class="fas fa-map-marker-alt me-1"></i> Ubah Peta Interaktif
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: TEKNIS & LOGISTIK -->
                            <div class="tab-pane fade" id="teknis" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-tools me-2"></i>Teknis Penyelamatan & Logistik</h5>
                                
                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3" style="font-size: 14px;">Status Korban</h6>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Selamat</label>
                                        <input type="number" name="korban_selamat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Luka Ringan</label>
                                        <input type="number" name="korban_ringan" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Luka Berat</label>
                                        <input type="number" name="korban_berat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-danger" style="font-size: 12px; font-weight: 600;">Manusia: Meninggal Dunia</label>
                                        <input type="number" name="korban_meninggal" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Hewan / Aset (Jika relevan)</label>
                                        <!-- Value -->
                                        <input type="text" name="korban_hewan_aset" class="form-control" value="1 Ekor Ular Piton Dievakuasi">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3" style="font-size: 14px;">Detail Evakuasi & Lapangan</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Status Evakuasi</label>
                                        <select class="form-select" name="status_evakuasi">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="selesai" selected>Selesai</option> <!-- Selected -->
                                            <option value="dalam_proses">Dalam Proses</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Objek Terdampak</label>
                                        <input type="text" name="objek_terdampak" class="form-control" value="Plafon atas rumah warga"> <!-- Value -->
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Hambatan Lapangan</label>
                                        <textarea class="form-control" name="hambatan_lapangan" rows="2">Ular bersembunyi di sela-sela rangka baja ringan atap yang sulit dijangkau alat.</textarea> <!-- Text -->
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-4" style="font-size: 14px;">Alat, Logistik & Personel</h6>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Konsumsi Alat Umum</label>
                                        <input type="text" name="konsumsi_alat" class="form-control" value="Tongkat penjepit ular, Lakban, Karung Goni"> <!-- Value -->
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Unit Armada (Checklist)</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="armada[]" value="pompa">
                                            <label class="form-check-label">Unit Pompa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="armada[]" value="rescue" checked> <!-- Checked -->
                                            <label class="form-check-label">Unit Rescue</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Jumlah Personel</label>
                                        <input type="number" name="jumlah_personel" class="form-control" value="4"> <!-- Value -->
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Personel yang Terlibat</label>
                                        <textarea class="form-control" name="daftar_personel" rows="2">Budi Santoso, Andi Wijaya, Joko Anwar, Slamet</textarea> <!-- Text -->
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3: DOKUMENTASI & VALIDASI -->
                            <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-search-dollar me-2"></i>Analisis Risiko & Penyebab</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Dugaan Penyebab</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="dugaan_penyebab" style="width: 50%;">
                                                <option value="">-- Pilih Penyebab --</option>
                                                <option value="faktor_alam" selected>Faktor alam</option> <!-- Selected -->
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control" name="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Sumber Api / Titik Awal</label>
                                        <input type="text" name="sumber_api" class="form-control" value="-">
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-handshake me-2"></i>Kerjasama Lintas Sektoral</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label mb-2" style="font-size: 13px; font-weight: 600; color: #4b5563;">Instansi Pendukung di Lokasi</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln">
                                            <label class="form-check-label" for="inst_pln" style="font-size: 13px;">PLN</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" checked> <!-- Checked -->
                                            <label class="form-check-label" for="inst_relawan" style="font-size: 13px;">Relawan Lokal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Tindakan Instansi Samping</label>
                                        <textarea class="form-control" name="tindakan_instansi" rows="2">Relawan membantu menunjukkan rute evakuasi tercepat ke rumah warga.</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Nomor Kontak Saksi/Warga</label>
                                        <input type="text" name="kontak_saksi" class="form-control" value="0812-3456-7890">
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-clipboard-check me-2"></i>Evaluasi & Rekomendasi</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label d-block" style="font-size: 13px; font-weight: 600; color: #4b5563;">Ketepatan Alat (Skala 1-5)</label>
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="ketepatan_alat" id="alat_1" value="1">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_1">1</label>
                                            
                                            <input type="radio" class="btn-check" name="ketepatan_alat" id="alat_5" value="5" checked> <!-- Checked 5 -->
                                            <label class="btn btn-outline-primary btn-sm" for="alat_5">5</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-camera me-2"></i>Dokumentasi & Catatan Akhir</h5>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Kronologi Kejadian Terperinci</label>
                                        <textarea class="form-control" name="kronologi_lengkap" rows="5">Tim menerima laporan melalui Call Center terkait adanya ular di plafon rumah warga. Tim rescue berjumlah 4 orang diberangkatkan. Sesampainya di lokasi, ular berhasil diamankan dengan tongkat penjepit setelah membongkar sedikit bagian plafon.</textarea> <!-- Text -->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Update File Dokumentasi (Biarkan kosong jika tidak diubah)</label>
                                        <input class="form-control mb-2" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        <small class="text-success"><i class="fas fa-check me-1"></i> Terdapat 3 foto yang sudah terunggah.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: KATEGORI KHUSUS -->
                            <div class="tab-pane fade" id="khusus" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-paw me-2"></i>Kategori Khusus Penyelamatan Hewan</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Jenis Hewan</label>
                                        <select class="form-select" name="jenis_hewan">
                                            <option value="">-- Pilih Jenis Hewan --</option>
                                            <option value="ular" selected>Ular</option> <!-- Selected -->
                                            <option value="tawon">Tawon/Vespa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Spesies / Nama Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" value="Ular Piton (Sanca Kembang)"> <!-- Value -->
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Dimensi Hewan</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" value="Panjang ±3.5 meter, Berat ±15 Kg"> <!-- Value -->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Status Hewan Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="dilepasliarkan">Dilepasliarkan ke habitat</option>
                                            <option value="diserahkan_bksda" selected>Diserahkan ke BKSDA</option> <!-- Selected -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Lokasi Habitat Pelepasan / Instansi</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" value="Kantor BKSDA Provinsi Jambi"> <!-- Value -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON - Berubah Menjadi Update -->
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <a href="/internal/damtan/data-laporan" class="btn btn-light me-2 fw-bold text-secondary">Batal</a>
                            <!-- Tombol Update -->
                            <button type="submit" class="btn btn-warning fw-bold px-4" style="color: #614000; border: none;">
                                <i class="fas fa-save me-2"></i> Update Data Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- PETA MODAL -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h5 class="modal-title fw-bold" id="mapModalLabel"><i class="fas fa-map-marked-alt text-primary me-2"></i>Ubah Titik Lokasi Kejadian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <div id="map"></div>
          </div>
          <div class="modal-footer bg-light d-flex justify-content-between">
            <span class="text-muted" style="font-size: 12px;">Geser pin merah atau klik peta untuk menentukan koordinat. <br>Koordinat saat ini: <strong id="latlngDisplay">-1.60921, 103.58231</strong></span>
            <div>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanKoordinat()">Simpan Perubahan Koordinat</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Script Bootstrap & Leaflet -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map;
        let marker;
        const myModalEl = document.getElementById('mapModal');

        myModalEl.addEventListener('shown.bs.modal', event => {
            if(!map) {
                // Posisi Peta diatur sesuai value database (-1.60921, 103.58231)
                map = L.map('map').setView([-1.60921, 103.58231], 15);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([-1.60921, 103.58231], {draggable: true}).addTo(map);

                marker.on('dragend', function (e) {
                    document.getElementById('latlngDisplay').innerText = marker.getLatLng().lat.toFixed(5) + ', ' + marker.getLatLng().lng.toFixed(5);
                });

                map.on('click', function(e){
                    marker.setLatLng(e.latlng);
                    document.getElementById('latlngDisplay').innerText = e.latlng.lat.toFixed(5) + ', ' + e.latlng.lng.toFixed(5);
                });
            }
            setTimeout(function() { map.invalidateSize(); }, 10);
        });

        function simpanKoordinat() {
            if(marker) {
                const lat = marker.getLatLng().lat.toFixed(5);
                const lng = marker.getLatLng().lng.toFixed(5);
                document.getElementById('inputKoordinat').value = lat + ', ' + lng;
            }
            let modalInstance = bootstrap.Modal.getInstance(myModalEl);
            modalInstance.hide();
        }
    </script>
</body>
</html>