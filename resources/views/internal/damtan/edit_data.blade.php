<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penyelamatan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal {
            background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        
        .btn-logout {
            background-color: #ef4444; color: white; border: none; padding: 8px 20px;
            border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s;
        }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR & ACCORDION STYLES --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar {
            width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto;
        }
        
        .sidebar-item {
            display: flex; align-items: center; gap: 15px; padding: 12px 15px;
            color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600;
            border-radius: 8px; transition: all 0.2s;
        }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        
        .sidebar-collapse-btn {
            display: flex; justify-content: space-between; align-items: center;
            width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px;
            background: transparent; border: none; border-top: 1px dashed #e5e7eb;
            text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af;
            text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s;
        }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }

        .sidebar-submenu {
            display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px;
        }

        /* --- KONTEN UTAMA --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        /* Custom Tab Styles */
        .nav-tabs .nav-link { color: #6b7280; font-weight: 600; border: none; padding: 12px 20px; }
        .nav-tabs .nav-link.active { color: #111827 !important; border-bottom: 3px solid #10b981 !important; background: transparent; }

        .field-label { font-size: 13px; font-weight: 700; color: #0284c7; margin-bottom: 8px; display: inline-flex; align-items: center; }
        .field-label i { margin-right: 8px; font-size: 14px; }
        .form-control, .form-select { border-radius: 8px; background-color: #f4f9ff; border: 1px solid #bfdbfe; padding: 10px 15px; font-size: 14px; }
        .form-control:focus, .form-select:focus { background-color: #ffffff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
        .input-group-text { border-radius: 8px; background-color: #e0f2fe; border: 1px solid #bfdbfe; color: #0284c7; font-weight: 700; }
        
        .section-title { font-weight: 800; color: #111827; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #f3f4f6; display: flex; align-items: center; gap: 12px; }
        .section-title i { color: #10b981; background: #d1fae5; padding: 10px; border-radius: 8px; font-size: 16px; }

        .form-check-inline { padding: 8px 16px 8px 32px; border-radius: 8px; border: 1px solid transparent; transition: all 0.2s ease-in-out; margin-right: 10px; margin-bottom: 5px; cursor: pointer; }
        .form-check-inline:hover { background-color: #e0f2fe; border-color: #bfdbfe; }
        #map { height: 400px; width: 100%; border-radius: 8px; border: 1px solid #e5e7eb; }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                
                <!-- ACCORDION PENCEGAHAN -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/pencegahan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="{{ Request::is('internal/pencegahan*') ? 'true' : 'false' }}">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/pencegahan*') ? 'show' : '' }}" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/kelola-rpkbgl" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                        <a href="/internal/pencegahan/kelola-skk" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}"><i class="fas fa-shield-alt"></i> Kelola SKK</a> 
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item {{ Request::is('internal/pencegahan/layanan-inspeksi*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/kelola-edukasi" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item {{ Request::is('internal/pencegahan/pelatihan*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item {{ Request::is('internal/pencegahan/pembinaan-pengembangan*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item {{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') || Request::is('internal/surat*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                        <a href="/internal/surat-korban/create" class="sidebar-item {{ Request::is('internal/surat*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn {{ Request::is('sapra*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="{{ Request::is('sapra*') ? 'true' : 'false' }}">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('sapra*') ? 'show' : '' }}" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">

                        <!-- Sarana dan prasarana -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">SARANA DAN PRASARANA</span>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam Kebakaran</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pemadam Kebakaran</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                        <a href="/sapra/sarana-pemeriksaan" class="sidebar-item"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi Kebakaran</a>    
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>
                        
                          <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                        <!-- GRUP LOGISTIK & DISTRIBUSI -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">LOGISTIK & DISTRIBUSI</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="sidebar-item"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                    </div>
                </div>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <!-- ACCORDION MANAJEMEN BERITA -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/operator*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="{{ Request::is('internal/operator*') ? 'true' : 'false' }}">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/operator*') ? 'show' : '' }}" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item {{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item {{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item {{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </div>
            @endif

            <!-- ACCORDION PENGATURAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false">
                <span>Pengaturan Akun</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <a href="/internal/damtan/data-laporan" class="btn btn-sm btn-light mb-3 fw-bold text-secondary border"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                <h1>Edit Data Penyelamatan</h1>
                <p>Ubah data laporan penyelamatan yang sudah ada.</p>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white pt-4 pb-0 border-bottom" style="border-bottom: 2px solid #f3f4f6 !important;">
                    <ul class="nav nav-tabs border-0" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation"><button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">1. Informasi Dasar</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="teknis-tab" data-bs-toggle="tab" data-bs-target="#teknis" type="button" role="tab">2. Teknis & Logistik</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="dokumentasi-tab" data-bs-toggle="tab" data-bs-target="#dokumentasi" type="button" role="tab">3. Dokumentasi & Validasi</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="khusus-tab" data-bs-toggle="tab" data-bs-target="#khusus" type="button" role="tab">4. Kategori Khusus</button></li>
                    </ul>
                </div>

                <div class="card-body p-4 bg-white">
                   <form action="{{ route('damtan.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content" id="formTabsContent">
                            
                            <!-- TAB 1: INFORMASI DASAR -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <h5 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kejadian</h5>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan</label>
                                        <input type="text" class="form-control" name="nomor_laporan" value="{{ $laporan->nomor_laporan }}" readonly style="background-color: #e2e8f0;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan</label>
                                        <input type="text" class="form-control" name="id_laporan" value="{{ $laporan->id_laporan }}" readonly style="background-color: #e2e8f0;">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 border-bottom pb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-user"></i> Nama Pelapor</label>
                                        <input type="text" class="form-control" name="nama_pelapor" value="{{ $laporan->nama_pelapor ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-headset"></i> Layanan Pelaporan</label>
                                        <select class="form-select" name="media_pelaporan">
                                            <option value="">-- Pilih Layanan --</option>
                                            <option value="whatsapp" {{ ($laporan->media_pelaporan ?? '') == 'whatsapp' ? 'selected' : '' }}>Layanan WA Damkar</option>
                                            <option value="telepon" {{ ($laporan->media_pelaporan ?? '') == 'telepon' ? 'selected' : '' }}>Telepon Call Center</option>
                                            <option value="langsung" {{ ($laporan->media_pelaporan ?? '') == 'langsung' ? 'selected' : '' }}>Datang Langsung ke Mako/Pos</option>
                                            <option value="instansi_lain" {{ ($laporan->media_pelaporan ?? '') == 'instansi_lain' ? 'selected' : '' }}>Laporan Instansi Lain</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-route"></i> Jarak Tempuh</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" name="jarak_tempuh" class="form-control" value="{{ $laporan->jarak_tempuh ?? '' }}">
                                            <span class="input-group-text">Km</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label text-danger"><i class="fas fa-fire"></i> Kategori Laporan (Kebakaran)</label>
                                        <select class="form-select" name="kategori_kebakaran">
                                            <option value="">-- Pilih Jenis Kebakaran --</option>
                                            <option value="rumah_tinggal" {{ $laporan->kategori_kebakaran == 'rumah_tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                                            <option value="lahan" {{ $laporan->kategori_kebakaran == 'lahan' ? 'selected' : '' }}>Lahan</option>
                                            <option value="bangunan_publik" {{ $laporan->kategori_kebakaran == 'bangunan_publik' ? 'selected' : '' }}>Bangunan Publik</option>
                                            <option value="kendaraan" {{ $laporan->kategori_kebakaran == 'kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="kategori_non_kebakaran" style="width: 50%;">
                                                <option value="">-- Pilih Jenis Evakuasi --</option>
                                                <option value="fire_rescue" {{ $laporan->kategori_non_kebakaran == 'fire_rescue' ? 'selected' : '' }}>Fire Rescue</option>
                                                <option value="water_rescue" {{ $laporan->kategori_non_kebakaran == 'water_rescue' ? 'selected' : '' }}>Water Rescue</option>
                                                <option value="land_rescue" {{ $laporan->kategori_non_kebakaran == 'land_rescue' ? 'selected' : '' }}>Land Rescue</option>
                                                <option value="evakuasi_liar" {{ $laporan->kategori_non_kebakaran == 'evakuasi_liar' ? 'selected' : '' }}>Evakuasi Hewan Liar</option>
                                                <option value="evakuasi_ternak" {{ $laporan->kategori_non_kebakaran == 'evakuasi_ternak' ? 'selected' : '' }}>Evakuasi Ternak</option>
                                                <option value="evakuasi_piaraan" {{ $laporan->kategori_non_kebakaran == 'evakuasi_piaraan' ? 'selected' : '' }}>Evakuasi Hewan Peliharaan</option>
                                                <option value="evakuasi_cincin" {{ $laporan->kategori_non_kebakaran == 'evakuasi_cincin' ? 'selected' : '' }}>Evakuasi Cincin / Anting</option>
                                                <option value="evakuasi_kendaraan" {{ $laporan->kategori_non_kebakaran == 'evakuasi_kendaraan' ? 'selected' : '' }}>Evakuasi Kendaraan Bermotor</option>
                                                <option value="lainnya" {{ $laporan->kategori_non_kebakaran == 'lainnya' ? 'selected' : '' }}>Lainnya (Sebutkan...)</option>
                                            </select>
                                            <input type="text" class="form-control" name="rincian_kategori_non_kebakaran" value="{{ $laporan->rincian_kategori_non_kebakaran }}" style="width: 50%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                        <select class="form-select" name="kategori_kejadian">
                                            <option value="">-- Pilih Kategori Kejadian --</option>
                                            <option value="kebakaran" {{ $laporan->kategori_kejadian == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                            <option value="penyelamatan_hewan" {{ $laporan->kategori_kejadian == 'penyelamatan_hewan' ? 'selected' : '' }}>Penyelamatan Hewan</option>
                                            <option value="bencana_alam" {{ $laporan->kategori_kejadian == 'bencana_alam' ? 'selected' : '' }}>Bencana Alam</option>
                                            <option value="kecelakaan_lalu_lintas" {{ $laporan->kategori_kejadian == 'kecelakaan_lalu_lintas' ? 'selected' : '' }}>Kecelakaan Lalu Lintas</option>
                                            <option value="evakuasi_medis" {{ $laporan->kategori_kejadian == 'evakuasi_medis' ? 'selected' : '' }}>Evakuasi Medis</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio1" value="rendah" {{ $laporan->prioritas == 'rendah' ? 'checked' : '' }}>
                                            <label class="form-check-label text-secondary fw-bold" for="prio1">Rendah</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio2" value="sedang" {{ $laporan->prioritas == 'sedang' ? 'checked' : '' }}>
                                            <label class="form-check-label text-primary fw-bold" for="prio2">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio3" value="tinggi" {{ $laporan->prioritas == 'tinggi' ? 'checked' : '' }}>
                                            <label class="form-check-label text-warning fw-bold" for="prio3">Tinggi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" id="prio4" value="darurat" {{ $laporan->prioritas == 'darurat' ? 'checked' : '' }}>
                                            <label class="form-check-label text-danger fw-bold" for="prio4">Darurat</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 p-3 bg-light rounded border">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control" value="{{ $laporan->waktu_kejadian ? date('Y-m-d\TH:i', strtotime($laporan->waktu_kejadian)) : '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                        <input type="datetime-local" name="waktu_terima" class="form-control" value="{{ $laporan->waktu_terima ? date('Y-m-d\TH:i', strtotime($laporan->waktu_terima)) : '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                        <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ $laporan->waktu_berangkat ? date('Y-m-d\TH:i', strtotime($laporan->waktu_berangkat)) : '' }}">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                        <input type="datetime-local" name="waktu_tiba" class="form-control" value="{{ $laporan->waktu_tiba ? date('Y-m-d\TH:i', strtotime($laporan->waktu_tiba)) : '' }}">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ $laporan->waktu_selesai ? date('Y-m-d\TH:i', strtotime($laporan->waktu_selesai)) : '' }}">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-building"></i> Waktu Kembali ke Mako</label>
                                        <input type="datetime-local" name="waktu_kembali" class="form-control" value="{{ $laporan->waktu_kembali ? date('Y-m-d\TH:i', strtotime($laporan->waktu_kembali)) : '' }}">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="2">{{ $laporan->alamat }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="inputKoordinat" name="koordinat" value="{{ $laporan->koordinat }}">
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
                                
                                <div class="row g-4 mb-5 border-bottom pb-4">
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-shield"></i> Pimpinan Operasi</label>
                                        <input type="text" name="pimpinan_operasi" class="form-control" value="{{ $teknis->pimpinan_operasi ?? '' }}" placeholder="Cth: Danru 4 Mako">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-friends"></i> Pendamping Operasi</label>
                                        <input type="text" name="pendamping_operasi" class="form-control" value="{{ $teknis->pendamping_operasi ?? '' }}" placeholder="Opsional...">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-users-cog"></i> Satuan Tugas / Regu</label>
                                        <input type="text" name="satuan_tugas" class="form-control" value="{{ $teknis->satuan_tugas ?? '' }}" placeholder="Cth: Pleton 1 Mako">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-stopwatch"></i> Tim Respon Time</label>
                                        <input type="text" name="tim_respontime" class="form-control" value="{{ $teknis->tim_respontime ?? '' }}" placeholder="Cth: 15 Menit">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Status Korban Manusia & Aset</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-check"></i> Selamat</label>
                                        <input type="number" min="0" name="korban_selamat" class="form-control" value="{{ $teknis->korban_selamat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-injured"></i> Luka Ringan</label>
                                        <input type="number" min="0" name="korban_ringan" class="form-control" value="{{ $teknis->korban_ringan ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-procedures"></i> Luka Berat</label>
                                        <input type="number" min="0" name="korban_berat" class="form-control" value="{{ $teknis->korban_berat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label text-danger"><i class="fas fa-user-times"></i> Meninggal Dunia</label>
                                        <input type="number" min="0" name="korban_meninggal" class="form-control" value="{{ $teknis->korban_meninggal ?? 0 }}">
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" value="{{ $teknis->korban_hewan_aset ?? '' }}">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Detail Evakuasi & Lapangan</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                        <select class="form-select" name="status_evakuasi">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="selesai" {{ ($teknis->status_evakuasi ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dalam_proses" {{ ($teknis->status_evakuasi ?? '') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                            <option value="dirujuk_ke_rs" {{ ($teknis->status_evakuasi ?? '') == 'dirujuk_ke_rs' ? 'selected' : '' }}>Dirujuk ke RS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                        <input type="text" name="objek_terdampak" class="form-control" value="{{ $teknis->objek_terdampak ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    @php $evakuasi = json_decode($teknis->metode_evakuasi ?? '[]', true) ?? []; @endphp
                                    <div class="col-md-12 mb-2">
                                        <label class="field-label w-100"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue" {{ in_array('vertical_rescue', $evakuasi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue" {{ in_array('water_rescue', $evakuasi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="me_wr">Water Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat" {{ in_array('tangga_darurat', $evakuasi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                        </div>
                                    </div>

                                    @php $penyelamatan = json_decode($teknis->metode_penyelamatan ?? '[]', true) ?? []; @endphp
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue" {{ in_array('vertical_rescue', $penyelamatan) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue" {{ in_array('water_rescue', $penyelamatan) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis" {{ in_array('pemadaman_statis', $penyelamatan) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis" {{ in_array('pemadaman_dinamis', $penyelamatan) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar" {{ in_array('evakuasi_medis_dasar', $penyelamatan) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                        <textarea class="form-control" name="hambatan_lapangan" rows="2">{{ $teknis->hambatan_lapangan ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-tasks"></i> Langkah Penanganan</label>
                                        <textarea class="form-control" name="langkah_penanganan" rows="2">{{ $teknis->langkah_penanganan ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row g-4 mb-4 border-bottom pb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-check-double"></i> Hasil Tindakan</label>
                                        <input type="text" name="hasil_tindakan" class="form-control" value="{{ $teknis->hasil_tindakan ?? '' }}">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Alat, Logistik & Personel</h6>
                                @php $alat = json_decode($teknis->peralatan ?? '[]', true) ?? []; @endphp
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-toolbox"></i> Peralatan Khusus yang Digunakan</label>
                                        <div class="btn-group" role="group">
                                            <input type="checkbox" class="btn-check" id="alat_scba" name="peralatan[]" value="SCBA" {{ in_array('SCBA', $alat) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_scba">SCBA</label>

                                            <input type="checkbox" class="btn-check" id="alat_thermal" name="peralatan[]" value="Thermal Camera" {{ in_array('Thermal Camera', $alat) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_thermal">Thermal Camera</label>

                                            <input type="checkbox" class="btn-check" id="alat_chainsaw" name="peralatan[]" value="Chainsaw" {{ in_array('Chainsaw', $alat) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_chainsaw">Chainsaw</label>

                                            <input type="checkbox" class="btn-check" id="alat_selam" name="peralatan[]" value="Alat Selam" {{ in_array('Alat Selam', $alat) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_selam">Alat Selam</label>
                                        </div>
                                        <input type="text" name="peralatan_lain" class="form-control form-control-sm mt-3" value="{{ $teknis->peralatan_lain ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                        <input type="text" name="konsumsi_alat" class="form-control" value="{{ $teknis->konsumsi_alat ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_air" class="form-control" value="{{ $teknis->liter_air ?? 0 }}">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_foam" class="form-control" value="{{ $teknis->liter_foam ?? 0 }}">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_bbm" class="form-control" value="{{ $teknis->liter_bbm ?? 0 }}">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                </div>

                                @php $armada = json_decode($teknis->armada ?? '[]', true) ?? []; @endphp
                                <div class="row g-4 mb-4">
                                    <div class="col-md-8">
                                        <label class="field-label w-100"><i class="fas fa-truck"></i> Unit Armada Terlibat</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa" {{ in_array('pompa', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue" {{ in_array('rescue', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki" {{ in_array('tangki', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans" {{ in_array('ambulans', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                        <input type="number" min="0" name="jumlah_personel" class="form-control" value="{{ $teknis->jumlah_personel ?? 0 }}">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                        <textarea class="form-control" name="daftar_personel" rows="2">{{ $teknis->daftar_personel ?? '' }}</textarea>
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
                                                <option value="">-- Pilih Penyebab --</option>
                                                <option value="arus_pendek" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'arus_pendek' ? 'selected' : '' }}>Arus pendek listrik</option>
                                                <option value="kebocoran_gas" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'kebocoran_gas' ? 'selected' : '' }}>Kebocoran gas</option>
                                                <option value="sambaran_petir" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'sambaran_petir' ? 'selected' : '' }}>Sambaran petir</option>
                                                <option value="kelalaian_manusia" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'kelalaian_manusia' ? 'selected' : '' }}>Kelalaian manusia</option>
                                                <option value="faktor_alam" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'faktor_alam' ? 'selected' : '' }}>Faktor alam</option>
                                                <option value="lainnya" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control" name="dugaan_penyebab_lainnya" value="{{ $dokumentasi->dugaan_penyebab_lainnya ?? '' }}" style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                        <input type="text" name="sumber_api" class="form-control" value="{{ $dokumentasi->sumber_api ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 border-bottom pb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                        <div class="input-group" style="width: 50%;">
                                            <input type="number" min="0" step="0.1" name="luas_area" class="form-control" value="{{ $dokumentasi->luas_area ?? '' }}">
                                            <span class="input-group-text">m²</span>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Kerjasama Lintas Sektoral & Evaluasi</h6>
                                @php $instansi = json_decode($dokumentasi->instansi_pendukung ?? '[]', true) ?? []; @endphp
                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln" {{ in_array('pln', $instansi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_pln">PLN</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi" {{ in_array('polisi', $instansi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_polisi">Polisi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni" {{ in_array('tni', $instansi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_tni">TNI</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi" {{ in_array('pmi', $instansi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_pmi">BPBD</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" {{ in_array('relawan_lokal', $instansi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                        <textarea class="form-control" name="tindakan_instansi" rows="2">{{ $dokumentasi->tindakan_instansi ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                        <input type="text" name="kontak_saksi" class="form-control" value="{{ $dokumentasi->kontak_saksi ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 border-bottom pb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                        <textarea class="form-control" name="kebutuhan_tambahan" rows="2">{{ $dokumentasi->kebutuhan_tambahan ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                        <textarea class="form-control" name="saran_mitigasi" rows="2">{{ $dokumentasi->saran_mitigasi ?? '' }}</textarea>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-12">
                                        <label class="field-label"><i class="fas fa-hands-helping"></i> Cara Bertindak</label>
                                        <select class="form-select" name="cara_bertindak">
                                            <option value="5T" {{ ($dokumentasi->cara_bertindak ?? '') == '5T' ? 'selected' : '' }}>5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)</option>
                                            <option value="lainnya" {{ ($dokumentasi->cara_bertindak ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya...</option>
                                        </select>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">Dokumentasi Akhir</h6>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                        <textarea class="form-control" name="kronologi_lengkap" rows="4">{{ $dokumentasi->kronologi_lengkap ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="field-label"><i class="fas fa-images"></i> Upload Foto Baru (.jpg/.png)</label>
                                            <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                            <small class="text-muted d-block mt-1">*Abaikan jika tidak ingin mengubah foto</small>
                                        </div>
                                        <div>
                                            <label class="field-label"><i class="fas fa-video"></i> Upload Video Baru (.mp4)</label>
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
                                            <option value="">-- Pilih --</option>
                                            <option value="ular" {{ ($khusus->jenis_hewan ?? '') == 'ular' ? 'selected' : '' }}>Ular</option>
                                            <option value="tawon" {{ ($khusus->jenis_hewan ?? '') == 'tawon' ? 'selected' : '' }}>Tawon/Vespa</option>
                                            <option value="kera" {{ ($khusus->jenis_hewan ?? '') == 'kera' ? 'selected' : '' }}>Kera</option>
                                            <option value="biawak" {{ ($khusus->jenis_hewan ?? '') == 'biawak' ? 'selected' : '' }}>Biawak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" value="{{ $khusus->spesies_hewan ?? '' }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" value="{{ $khusus->dimensi_hewan ?? '' }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-balance-scale"></i> Berat Hewan</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" name="berat_hewan" class="form-control" value="{{ $khusus->berat_hewan ?? '' }}">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option value="">-- Pilih --</option>
                                            <option value="dilepasliarkan" {{ ($khusus->status_hewan_pasca ?? '') == 'dilepasliarkan' ? 'selected' : '' }}>Dilepasliarkan</option>
                                            <option value="diserahkan_bksda" {{ ($khusus->status_hewan_pasca ?? '') == 'diserahkan_bksda' ? 'selected' : '' }}>Diserahkan BKSDA</option>
                                            <option value="mati" {{ ($khusus->status_hewan_pasca ?? '') == 'mati' ? 'selected' : '' }}>Mati</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" value="{{ $khusus->lokasi_pelepasan ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-tree me-2"></i>Pohon Tumbang / Bangunan</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-car-crash"></i> Jenis Objek</label>
                                        <select class="form-select" name="jenis_objek_tumbang">
                                            <option value="">-- Pilih --</option>
                                            <option value="pohon" {{ ($khusus->jenis_objek_tumbang ?? '') == 'pohon' ? 'selected' : '' }}>Pohon</option>
                                            <option value="baliho" {{ ($khusus->jenis_objek_tumbang ?? '') == 'baliho' ? 'selected' : '' }}>Baliho</option>
                                            <option value="tiang_listrik" {{ ($khusus->jenis_objek_tumbang ?? '') == 'tiang_listrik' ? 'selected' : '' }}>Tiang Listrik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="dimensi_objek" class="form-control" value="{{ $khusus->dimensi_objek ?? '' }}">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                        <select class="form-select" name="status_utilitas">
                                            <option value="">-- Tidak Ada --</option>
                                            <option value="kabel_pln" {{ ($khusus->status_utilitas ?? '') == 'kabel_pln' ? 'selected' : '' }}>Kabel PLN putus</option>
                                            <option value="pipa_pdam" {{ ($khusus->status_utilitas ?? '') == 'pipa_pdam' ? 'selected' : '' }}>Pipa PDAM bocor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                        <textarea class="form-control" name="dampak_properti" rows="2">{{ $khusus->dampak_properti ?? '' }}</textarea>
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-life-ring me-2"></i>Water Rescue</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-water"></i> Kondisi Perairan</label>
                                        <select class="form-select" name="kondisi_perairan">
                                            <option value="">-- Pilih --</option>
                                            <option value="arus_deras" {{ ($khusus->kondisi_perairan ?? '') == 'arus_deras' ? 'selected' : '' }}>Arus Deras</option>
                                            <option value="arus_tenang" {{ ($khusus->kondisi_perairan ?? '') == 'arus_tenang' ? 'selected' : '' }}>Arus Tenang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-search-location"></i> Radius</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="radius_pencarian" class="form-control" value="{{ $khusus->radius_pencarian ?? '' }}">
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                        <select class="form-select" name="metode_pencarian_air">
                                            <option value="">-- Pilih --</option>
                                            <option value="penyelaman" {{ ($khusus->metode_pencarian_air ?? '') == 'penyelaman' ? 'selected' : '' }}>Penyelaman</option>
                                            <option value="penyisiran" {{ ($khusus->metode_pencarian_air ?? '') == 'penyisiran' ? 'selected' : '' }}>Penyisiran Perahu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                        <input type="text" name="daftar_penyelam" class="form-control" value="{{ $khusus->daftar_penyelam ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-4 mb-4 bg-light p-3 rounded border">
                                    <div class="col-12"><h6 class="fw-bold text-primary mb-0"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6></div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                        <input type="text" name="jenis_benda_bahaya" class="form-control" value="{{ $khusus->jenis_benda_bahaya ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                        <select class="form-select" name="kondisi_anggota_tubuh">
                                            <option value="">-- Pilih --</option>
                                            <option value="bengkak" {{ ($khusus->kondisi_anggota_tubuh ?? '') == 'bengkak' ? 'selected' : '' }}>Bengkak</option>
                                            <option value="luka_terbuka" {{ ($khusus->kondisi_anggota_tubuh ?? '') == 'luka_terbuka' ? 'selected' : '' }}>Luka Terbuka</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                        <select class="form-select" name="alat_potong_cincin">
                                            <option value="">-- Pilih --</option>
                                            <option value="gerinda_mini" {{ ($khusus->alat_potong_cincin ?? '') == 'gerinda_mini' ? 'selected' : '' }}>Gerinda Mini</option>
                                            <option value="tang_baja" {{ ($khusus->alat_potong_cincin ?? '') == 'tang_baja' ? 'selected' : '' }}>Tang Baja</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                        <select class="form-select" name="cuaca_operasi">
                                            <option value="">-- Pilih --</option>
                                            <option value="cerah" {{ ($khusus->cuaca_operasi ?? '') == 'cerah' ? 'selected' : '' }}>Cerah</option>
                                            <option value="hujan_lebat" {{ ($khusus->cuaca_operasi ?? '') == 'hujan_lebat' ? 'selected' : '' }}>Hujan Lebat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                        <select class="form-select" name="jenis_medan">
                                            <option value="">-- Pilih --</option>
                                            <option value="pemukiman_padat" {{ ($khusus->jenis_medan ?? '') == 'pemukiman_padat' ? 'selected' : '' }}>Pemukiman Padat</option>
                                            <option value="perkebunan" {{ ($khusus->jenis_medan ?? '') == 'perkebunan' ? 'selected' : '' }}>Perkebunan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-road"></i> Aksesibilitas Lokasi</label>
                                        <select class="form-select" name="akses_lokasi">
                                            <option value="">-- Pilih --</option>
                                            <option value="kendaraan_berat" {{ ($khusus->akses_lokasi ?? '') == 'kendaraan_berat' ? 'selected' : '' }}>Bisa dilalui Roda 4+</option>
                                            <option value="roda_dua" {{ ($khusus->akses_lokasi ?? '') == 'roda_dua' ? 'selected' : '' }}>Hanya Roda 2</option>
                                            <option value="jalan_kaki" {{ ($khusus->akses_lokasi ?? '') == 'jalan_kaki' ? 'selected' : '' }}>Hanya Jalan Kaki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="d-flex justify-content-end mt-5 pt-3 border-top">
                            <a href="/internal/damtan/data-laporan" class="btn btn-light me-3 fw-bold text-secondary px-4 py-2" style="border-radius: 8px;">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2 shadow-sm" style="background-color: #0284c7; border: none; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i> Perbarui Data Penyelamatan
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
            <span class="text-muted" style="font-size: 12px;">Geser pin merah atau klik peta untuk menentukan koordinat.</span>
            <div>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanKoordinat()">Gunakan Koordinat Ini</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map;
        let marker;
        const myModalEl = document.getElementById('mapModal');

        myModalEl.addEventListener('shown.bs.modal', event => {
            if(!map) {
                // Ambil koordinat awal dari inputan jika ada
                let lat = -1.61157;
                let lng = 103.57860;
                let currentKoor = document.getElementById('inputKoordinat').value;
                
                if(currentKoor && currentKoor.includes(',')) {
                    let parts = currentKoor.split(',');
                    lat = parseFloat(parts[0].trim());
                    lng = parseFloat(parts[1].trim());
                }

                map = L.map('map').setView([lat, lng], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([lat, lng], {draggable: true}).addTo(map);

                marker.on('dragend', function (e) {
                    let newLat = marker.getLatLng().lat.toFixed(5);
                    let newLng = marker.getLatLng().lng.toFixed(5);
                });

                map.on('click', function(e){
                    marker.setLatLng(e.latlng);
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