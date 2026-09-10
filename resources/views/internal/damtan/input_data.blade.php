<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penginputan Data - SIMERAH KOJA</title>

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

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

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
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        /* Custom Tab Styles */
        .nav-tabs .nav-link { color: #6b7280; font-weight: 600; border: none; padding: 12px 20px; }
        .nav-tabs .nav-link:hover { color: #10b981; }
        .nav-tabs .nav-link.active { color: #111827 !important; border-bottom: 3px solid #10b981 !important; background: transparent; }

        /* --- STYLING FORM MODERN --- */
        .field-label {
            font-size: 13px;
            font-weight: 700;
            color: #0284c7;
            margin-bottom: 8px;
            display: inline-flex;
            align-items: center;
        }
        .field-label i {
            margin-right: 8px;
            font-size: 14px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            background-color: #f4f9ff; 
            border: 1px solid #bfdbfe; 
            padding: 10px 15px;
            font-size: 14px;
            color: #1e293b;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease-in-out;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .input-group-text {
            border-radius: 8px;
            background-color: #e0f2fe; 
            border: 1px solid #bfdbfe;
            color: #0284c7;
            font-weight: 700;
        }
        
        .section-title {
            font-weight: 800;
            color: #111827;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-title i {
            color: #10b981; 
            background: #d1fae5;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
        }

        /* --- EFEK HOVER BIRU LEMBUT UNTUK CHECKBOX & RADIO --- */
        .form-check-inline {
            padding: 8px 16px 8px 32px; /* Memberi ruang klik yang lebih luas */
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s ease-in-out;
            margin-right: 10px;
            margin-bottom: 5px;
            cursor: pointer;
        }
        .form-check-inline:hover {
            background-color: #e0f2fe; /* Warna latar biru langit sangat muda */
            border-color: #bfdbfe;     /* Garis batas biru tipis */
        }
        .form-check-input {
            cursor: pointer; /* Kursor jari */
            margin-top: 4px;
        }
        .form-check-label {
            cursor: pointer; /* Kursor jari saat tulisan disorot */
            width: 100%;
        }

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

            @if(Auth::user()->role === 'pencegahan' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
            @endif

            @if(Auth::user()->role === 'pemadaman' || Auth::user()->role === 'super_user')
                <div class="sidebar-title" style="{{ Auth::user()->role === 'super_user' ? '' : 'border-top: none;' }}">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item active"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>
            @endif

            @if(Auth::user()->role === 'sapra' || Auth::user()->role === 'super_user')
                <div class="sidebar-title" style="{{ Auth::user()->role === 'super_user' ? '' : 'border-top: none;' }}">Bagian Sapra</div>
                <a href="#" class="sidebar-item"><i class="fas fa-truck-monster"></i> Kelola Armada Mobil</a>
                <a href="#" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
                <a href="#" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title" style="{{ Auth::user()->role === 'super_user' ? '' : 'border-top: none;' }}">Manajemen Berita</div>
                <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
        </aside>

        <!-- MAIN AREA (FORM PENGINPUTAN) -->
        <main class="main-content">
            <div class="page-header">
                <h1>Form Penginputan Data Penyelamatan</h1>
                <p>Bagian Pemadaman & Penyelamatan - Disdamkartan Kota Jambi.</p>
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
                        <div class="tab-content" id="formTabsContent">
                            
                            <!-- TAB 1: INFORMASI DASAR -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kejadian</h5>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="nomor_laporan" value="REG-20240101-001" readonly style="background-color: #e2e8f0;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="id_laporan" value="UUID-8A7B6C" readonly style="background-color: #e2e8f0;">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label text-danger"><i class="fas fa-fire"></i> Kategori Laporan (Kebakaran)</label>
                                        <select class="form-select" name="kategori_kebakaran">
                                            <option selected value="">-- Pilih Jenis Kebakaran --</option>
                                            <option value="rumah_tinggal">Rumah Tinggal</option>
                                            <option value="lahan">Lahan</option>
                                            <option value="bangunan_publik">Bangunan Publik</option>
                                            <option value="kendaraan">Kendaraan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="kategori_non_kebakaran" style="width: 50%;">
                                                <option selected value="">-- Pilih Jenis Evakuasi --</option>
                                                <option value="fire_rescue">Fire Rescue</option>
                                                <option value="water_rescue">Water Rescue</option>
                                                <option value="land_rescue">Land Rescue</option>
                                                <option value="evakuasi_liar">Evakuasi Hewan Liar</option>
                                                <option value="evakuasi_ternak">Evakuasi Ternak</option>
                                                <option value="evakuasi_piaraan">Evakuasi Hewan Peliharaan</option>
                                                <option value="evakuasi_cincin">Evakuasi Cincin / Anting</option>
                                                <option value="evakuasi_kendaraan">Evakuasi Kendaraan Bermotor</option>
                                                <option value="lainnya">Lainnya (Sebutkan...)</option>
                                            </select>
                                           <!-- Nama variabel dan placeholder diubah agar bisa dipakai untuk keterangan detail -->
                                            <input type="text" class="form-control" name="rincian_kategori_non_kebakaran" placeholder="Detail (Cth: Monyet / Sumur)..." style="width: 50%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                        <select class="form-select" name="kategori_kejadian">
                                            <option selected value="">-- Pilih Kategori Kejadian --</option>
                                            <option value="kebakaran">Kebakaran</option>
                                            <option value="penyelamatan_hewan">Penyelamatan Hewan</option>
                                            <option value="bencana_alam">Bencana Alam</option>
                                            <option value="kecelakaan_lalu_lintas">Kecelakaan Lalu Lintas</option>
                                            <option value="evakuasi_medis">Evakuasi Medis</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio1" value="rendah">
                                            <label class="form-check-label text-secondary fw-bold" for="prio1">Rendah</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio2" value="sedang">
                                            <label class="form-check-label text-primary fw-bold" for="prio2">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio3" value="tinggi">
                                            <label class="form-check-label text-warning fw-bold" for="prio3">Tinggi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio4" value="darurat">
                                            <label class="form-check-label text-danger fw-bold" for="prio4">Darurat</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 p-3 bg-light rounded border">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                        <input type="datetime-local" name="waktu_terima" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                        <input type="datetime-local" name="waktu_berangkat" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                        <input type="datetime-local" name="waktu_tiba" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="2" placeholder="Nama jalan, RT/RW, Kecamatan..."></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="inputKoordinat" name="koordinat" placeholder="-1.61157, 103.57860">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#mapModal">
                                            <i class="fas fa-map-marked-alt me-1"></i> Buka Peta Interaktif
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: TEKNIS & LOGISTIK -->
                            <div class="tab-pane fade" id="teknis" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-tools"></i> Teknis Penyelamatan & Logistik</h5>
                                
                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Status Korban Manusia & Aset</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-check"></i> Selamat</label>
                                        <input type="number" name="korban_selamat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-injured"></i> Luka Ringan</label>
                                        <input type="number" name="korban_ringan" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-procedures"></i> Luka Berat</label>
                                        <input type="number" name="korban_berat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label text-danger"><i class="fas fa-user-times"></i> Meninggal Dunia</label>
                                        <input type="number" name="korban_meninggal" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset (Jika relevan)</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" placeholder="Contoh: 1 ekor ular piton dievakuasi, 2 unit motor terbakar...">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Detail Evakuasi & Lapangan</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                        <select class="form-select" name="status_evakuasi">
                                            <option selected value="">-- Pilih Status --</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="dalam_proses">Dalam Proses</option>
                                            <option value="dirujuk_ke_rs">Dirujuk ke RS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                        <input type="text" name="objek_terdampak" class="form-control" placeholder="Contoh: Atap rumah warga, sumur tua, dsb.">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-md-12 mb-2">
                                        <label class="field-label w-100"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue">
                                            <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue">
                                            <label class="form-check-label" for="me_wr">Water Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat">
                                            <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue">
                                            <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue">
                                            <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis">
                                            <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis">
                                            <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar">
                                            <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                        <textarea class="form-control" name="hambatan_lapangan" rows="2" placeholder="Tuliskan hambatan spesifik saat operasi di lapangan..."></textarea>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Alat, Logistik & Personel</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-toolbox"></i> Peralatan Khusus yang Digunakan</label>
                                        <div class="btn-group" role="group" aria-label="Peralatan Khusus">
                                            <input type="checkbox" class="btn-check" id="alat_scba" name="peralatan[]" value="SCBA">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_scba">SCBA</label>

                                            <input type="checkbox" class="btn-check" id="alat_thermal" name="peralatan[]" value="Thermal Camera">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_thermal">Thermal Camera</label>

                                            <input type="checkbox" class="btn-check" id="alat_chainsaw" name="peralatan[]" value="Chainsaw">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_chainsaw">Chainsaw</label>

                                            <input type="checkbox" class="btn-check" id="alat_selam" name="peralatan[]" value="Alat Selam">
                                            <label class="btn btn-outline-primary btn-sm" for="alat_selam">Alat Selam</label>
                                        </div>
                                        <input type="text" name="peralatan_lain" class="form-control form-control-sm mt-3" placeholder="Alat khusus lainnya (pisahkan dengan koma)...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                        <input type="text" name="konsumsi_alat" class="form-control" placeholder="Contoh: penggunaan foam, jumlah liter air, atau combi tool...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                        <div class="input-group">
                                            <input type="number" name="liter_air" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                        <div class="input-group">
                                            <input type="number" name="liter_foam" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                        <div class="input-group">
                                            <input type="number" name="liter_bbm" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-8">
                                        <label class="field-label w-100"><i class="fas fa-truck"></i> Unit Armada Terlibat</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa">
                                            <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue">
                                            <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki">
                                            <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans">
                                            <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                        <input type="number" name="jumlah_personel" class="form-control" placeholder="0">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                        <textarea class="form-control" name="daftar_personel" rows="2" placeholder="Contoh: Budi, Andi, Joko..."></textarea>
                                    </div>
                                </div>
                            </div>

                           <!-- TAB 3: DOKUMENTASI, EVALUASI & VALIDASI -->
                            <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-clipboard-list"></i> Analisis & Evaluasi Kejadian</h5>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-bolt"></i> Dugaan Penyebab</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="dugaan_penyebab" style="width: 50%;">
                                                <option selected value="">-- Pilih Penyebab --</option>
                                                <option value="arus_pendek">Arus pendek listrik</option>
                                                <option value="kebocoran_gas">Kebocoran gas</option>
                                                <option value="sambaran_petir">Sambaran petir</option>
                                                <option value="kelalaian_manusia">Kelalaian manusia</option>
                                                <option value="faktor_alam">Faktor alam</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control" name="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                        <input type="text" name="sumber_api" class="form-control" placeholder="Contoh: Dapur, Panel Listrik utama...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                        <div class="input-group">
                                            <input type="number" name="luas_area" class="form-control" placeholder="0">
                                            <span class="input-group-text">m²</span>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Kerjasama Lintas Sektoral & Evaluasi</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln">
                                            <label class="form-check-label" for="inst_pln">PLN</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi">
                                            <label class="form-check-label" for="inst_polisi">Polisi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni">
                                            <label class="form-check-label" for="inst_tni">TNI</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi">
                                            <label class="form-check-label" for="inst_pmi">BPBD</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal">
                                            <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                        <textarea class="form-control" name="tindakan_instansi" rows="2" placeholder="Contoh: PLN melakukan pemutusan arus..."></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                        <input type="text" name="kontak_saksi" class="form-control" placeholder="08xx-xxxx-xxxx">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <!-- Ketepatan Alat dihapus, kolom dilebarkan jadi col-md-6 -->
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                        <textarea class="form-control" name="kebutuhan_tambahan" rows="2" placeholder="Dibutuhkan drone thermal..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                        <textarea class="form-control" name="saran_mitigasi" rows="2" placeholder="Sosialisasi APAR..."></textarea>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Dokumentasi Akhir</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                        <textarea class="form-control" name="kronologi_lengkap" rows="4" placeholder="Uraian singkat operasi..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="field-label"><i class="fas fa-images"></i> Upload Foto (.jpg/.png)</label>
                                            <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        </div>
                                        <div>
                                            <label class="field-label"><i class="fas fa-video"></i> Upload Video (.mp4)</label>
                                            <input class="form-control" type="file" name="video" accept="video/mp4">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: KATEGORI KHUSUS -->
                            <div class="tab-pane fade" id="khusus" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-star"></i> Modul Kategori Khusus</h5>
                                
                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-paw me-2"></i>Animal Rescue</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label">Jenis Hewan</label>
                                        <select class="form-select" name="jenis_hewan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="ular">Ular</option>
                                            <option value="tawon">Tawon/Vespa</option>
                                            <option value="kera">Kera</option>
                                            <option value="biawak">Biawak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" placeholder="Cth: King Cobra">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" placeholder="Panjang ±3 meter">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="dilepasliarkan">Dilepasliarkan</option>
                                            <option value="diserahkan_bksda">Diserahkan BKSDA</option>
                                            <option value="mati">Mati</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" placeholder="Habitat...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-tree me-2"></i>Pohon Tumbang / Bangunan</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-car-crash"></i> Jenis Objek</label>
                                        <select class="form-select" name="jenis_objek_tumbang">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="pohon">Pohon</option>
                                            <option value="baliho">Baliho</option>
                                            <option value="tiang_listrik">Tiang Listrik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                        <div class="input-group">
                                            <input type="number" name="dimensi_objek" class="form-control" placeholder="0">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                        <select class="form-select" name="status_utilitas">
                                            <option selected value="">-- Tidak Ada --</option>
                                            <option value="kabel_pln">Kabel PLN putus</option>
                                            <option value="pipa_pdam">Pipa PDAM bocor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                        <textarea class="form-control" name="dampak_properti" rows="2" placeholder="Menutup jalan, menimpa pagar..."></textarea>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-life-ring me-2"></i>Water Rescue</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-water"></i> Kondisi Perairan</label>
                                        <select class="form-select" name="kondisi_perairan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="arus_deras">Arus Deras</option>
                                            <option value="arus_tenang">Arus Tenang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-search-location"></i> Radius</label>
                                        <div class="input-group">
                                            <input type="number" name="radius_pencarian" class="form-control" placeholder="0">
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                        <select class="form-select" name="metode_pencarian_air">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="penyelaman">Penyelaman</option>
                                            <option value="penyisiran">Penyisiran Perahu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                        <input type="text" name="daftar_penyelam" class="form-control" placeholder="Nama bersertifikasi...">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                        <input type="text" name="jenis_benda_bahaya" class="form-control" placeholder="Cincin, kaleng...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                        <select class="form-select" name="kondisi_anggota_tubuh">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="bengkak">Bengkak</option>
                                            <option value="luka_terbuka">Luka Terbuka</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                        <select class="form-select" name="alat_potong_cincin">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="gerinda_mini">Gerinda Mini</option>
                                            <option value="tang_baja">Tang Baja</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                        <select class="form-select" name="cuaca_operasi">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="cerah">Cerah</option>
                                            <option value="hujan_lebat">Hujan Lebat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                        <select class="form-select" name="jenis_medan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="pemukiman_padat">Pemukiman Padat</option>
                                            <option value="perkebunan">Perkebunan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-road"></i> Aksesibilitas Lokasi</label>
                                        <select class="form-select" name="akses_lokasi">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="kendaraan_berat">Bisa dilalui Roda 4+</option>
                                            <option value="roda_dua">Hanya Roda 2</option>
                                            <option value="jalan_kaki">Hanya Jalan Kaki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="d-flex justify-content-end mt-5 pt-3 border-top">
                            <button type="reset" class="btn btn-light me-3 fw-bold text-secondary px-4 py-2" style="border-radius: 8px;">Batal</button>
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2 shadow-sm" style="background-color: #0284c7; border: none; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i> Simpan Data Penyelamatan
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
            <h5 class="modal-title fw-bold" id="mapModalLabel"><i class="fas fa-map-marked-alt text-primary me-2"></i>Pilih Titik Lokasi Kejadian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <div id="map"></div>
          </div>
          <div class="modal-footer bg-light d-flex justify-content-between">
            <span class="text-muted" style="font-size: 12px;">Geser pin merah atau klik peta untuk menentukan koordinat. <br>Koordinat saat ini: <strong id="latlngDisplay">-1.61157, 103.57860</strong></span>
            <div>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanKoordinat()">Gunakan Koordinat Ini</button>
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
                map = L.map('map').setView([-1.61157, 103.57860], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([-1.61157, 103.57860], {draggable: true}).addTo(map);

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