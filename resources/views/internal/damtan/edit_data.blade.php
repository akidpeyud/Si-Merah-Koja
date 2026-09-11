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

        /* --- MAIN AREA & TABS --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;}
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        .nav-tabs .nav-link { color: #6b7280; font-weight: 600; border: none; padding: 12px 20px; }
        .nav-tabs .nav-link:hover { color: #10b981; }
        .nav-tabs .nav-link.active { color: #111827 !important; border-bottom: 3px solid #10b981 !important; background: transparent; }

        /* --- STYLING FORM MODERN --- */
        .field-label {
            font-size: 13px; font-weight: 700; color: #0284c7; margin-bottom: 8px;
            display: inline-flex; align-items: center;
        }
        .field-label i { margin-right: 8px; font-size: 14px; }
        
        .form-control, .form-select {
            border-radius: 8px; background-color: #f4f9ff; border: 1px solid #bfdbfe; 
            padding: 10px 15px; font-size: 14px; color: #1e293b;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s ease-in-out;
        }
        .form-control:focus, .form-select:focus { background-color: #ffffff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
        .input-group-text { border-radius: 8px; background-color: #e0f2fe; border: 1px solid #bfdbfe; color: #0284c7; font-weight: 700; }
        
        .form-check-inline {
            padding: 8px 16px 8px 32px; border-radius: 8px; border: 1px solid transparent;
            transition: all 0.2s ease-in-out; margin-right: 10px; margin-bottom: 5px; cursor: pointer;
        }
        .form-check-inline:hover { background-color: #e0f2fe; border-color: #bfdbfe; }
        .form-check-input { cursor: pointer; margin-top: 4px; }
        .form-check-label { cursor: pointer; width: 100%; }

        #map { height: 400px; width: 100%; border-radius: 8px; border: 1px solid #e5e7eb; }
    </style>
</head>
<body>

    <!-- ALERT SUCCESS GLOBAL -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- ALERT ERROR GLOBAL -->
    @if(session('error'))
        <div id="globalErrorAlert">
            <i class="fas fa-exclamation-triangle alert-icon"></i>
            <span>{{ session('error') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalErrorAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <script>
        function closeAlert(id) {
            let alertBox = document.getElementById(id);
            if(alertBox) {
                alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                setTimeout(() => alertBox.remove(), 400); 
            }
        }
        setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
        setTimeout(() => closeAlert('globalErrorAlert'), 4000);
    </script>

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
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
<<<<<<< Updated upstream
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
=======
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
>>>>>>> Stashed changes
                        <a href="/internal/damtan/data-laporan" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="false">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Hidrant</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Mako & Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Mako & Pos</a>
                        <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
                    </div>
                </div>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="false">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
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

        <!-- MAIN AREA (FORM EDIT) -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Edit Data Penyelamatan</h1>
                    <p>Memperbarui data untuk Nomor Laporan: <strong class="text-primary">{{ $laporan->nomor_laporan ?? 'N/A' }}</strong></p>
                </div>
                <div>
                    <a href="/internal/damtan/data-laporan" class="btn btn-outline-secondary fw-bold shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Batal / Kembali
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white pt-4 pb-0 border-bottom" style="border-bottom: 2px solid #f3f4f6 !important;">
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
                    <!-- INI BAGIAN YANG DIPERBAIKI (ACTION & METHOD) -->
                    <form action="/internal/damtan/update-data/{{ $laporan->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <div class="tab-content" id="formTabsContent">
                            
                            <!-- TAB 1: INFORMASI DASAR -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Dasar Kejadian</h5>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">Nomor Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="nomor_laporan" value="{{ $laporan->nomor_laporan ?? '' }}" readonly style="background-color: #f9fafb;">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #4b5563;">ID Laporan (Auto)</label>
                                        <input type="text" class="form-control" name="id_laporan" value="{{ $laporan->id_laporan ?? '' }}" readonly style="background-color: #f9fafb;">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-danger fw-bold" style="font-size: 13px;">Kategori Laporan (Kebakaran)</label>
                                        <select class="form-select" name="kategori_kebakaran">
                                            <option value="">-- Pilih Jenis Kebakaran --</option>
                                            <option value="rumah_tinggal" {{ ($laporan->kategori_kebakaran ?? '') == 'rumah_tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-primary fw-bold" style="font-size: 13px;">Kategori Laporan (Non-Kebakaran)</label>
                                        <select class="form-select" name="kategori_non_kebakaran">
                                            <option value="">-- Pilih Jenis Evakuasi --</option>
                                            <option value="animal_rescue" {{ ($laporan->kategori_non_kebakaran ?? '') == 'animal_rescue' ? 'selected' : '' }}>Evakuasi Hewan (Animal Rescue)</option>
                                            <option value="pohon_tumbang" {{ ($laporan->kategori_non_kebakaran ?? '') == 'pohon_tumbang' ? 'selected' : '' }}>Pohon Tumbang</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold" style="font-size: 13px; color: #4b5563;">Kategori Kejadian Umum</label>
                                        <select class="form-select" name="kategori_kejadian">
                                            <option value="">-- Pilih Kategori Kejadian --</option>
                                            <option value="kebakaran" {{ ($laporan->kategori_kejadian ?? '') == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                            <option value="penyelamatan_hewan" {{ ($laporan->kategori_kejadian ?? '') == 'penyelamatan_hewan' ? 'selected' : '' }}>Penyelamatan Hewan</option>
                                            <option value="bencana_alam" {{ ($laporan->kategori_kejadian ?? '') == 'bencana_alam' ? 'selected' : '' }}>Bencana Alam</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label d-block" style="font-size: 13px; font-weight: 600; color: #4b5563;">Tingkat Prioritas</label>
                                        @php $prio = $laporan->prioritas ?? ''; @endphp
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="rendah" {{ $prio == 'rendah' ? 'checked' : '' }}>
                                            <label class="form-check-label text-secondary fw-bold">Rendah</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="sedang" {{ $prio == 'sedang' ? 'checked' : '' }}>
                                            <label class="form-check-label text-primary fw-bold">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="tinggi" {{ $prio == 'tinggi' ? 'checked' : '' }}>
                                            <label class="form-check-label text-warning fw-bold">Tinggi</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-1">
                                            <input class="form-check-input" type="radio" name="prioritas" value="darurat" {{ $prio == 'darurat' ? 'checked' : '' }}>
                                            <label class="form-check-label text-danger fw-bold">Darurat</label>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-4" style="font-size: 14px;">Detail Waktu Operasi</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Kejadian</label>
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control" value="{{ $laporan->waktu_kejadian ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Terima Laporan</label>
                                        <input type="datetime-local" name="waktu_terima" class="form-control" value="{{ $laporan->waktu_terima ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Berangkat Unit</label>
                                        <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ $laporan->waktu_berangkat ?? '' }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Tiba di Lokasi</label>
                                        <input type="datetime-local" name="waktu_tiba" class="form-control" value="{{ $laporan->waktu_tiba ?? '' }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Waktu Operasi Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ $laporan->waktu_selesai ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="3">{{ $laporan->alamat ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Titik Koordinat (Lat, Long)</label>
                                        @php $coords = $laporan->koordinat ?? '-1.60921, 103.58231'; @endphp
                                        <input type="text" class="form-control mb-2" id="inputKoordinat" name="koordinat" value="{{ $coords }}">
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
                                        <input type="number" name="korban_selamat" class="form-control" value="{{ $teknis->korban_selamat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Luka Ringan</label>
                                        <input type="number" name="korban_ringan" class="form-control" value="{{ $teknis->korban_ringan ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Manusia: Luka Berat</label>
                                        <input type="number" name="korban_berat" class="form-control" value="{{ $teknis->korban_berat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-danger" style="font-size: 12px; font-weight: 600;">Manusia: Meninggal</label>
                                        <input type="number" name="korban_meninggal" class="form-control" value="{{ $teknis->korban_meninggal ?? 0 }}">
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 12px; font-weight: 600;">Hewan / Aset (Jika relevan)</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" value="{{ $teknis->korban_hewan_aset ?? '' }}">
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3" style="font-size: 14px;">Detail Evakuasi & Lapangan</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Status Evakuasi</label>
                                        <select class="form-select" name="status_evakuasi">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="selesai" {{ ($teknis->status_evakuasi ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dalam_proses" {{ ($teknis->status_evakuasi ?? '') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Objek Terdampak</label>
                                        <input type="text" name="objek_terdampak" class="form-control" value="{{ $teknis->objek_terdampak ?? '' }}">
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Hambatan Lapangan</label>
                                        <textarea class="form-control" name="hambatan_lapangan" rows="2">{{ $teknis->hambatan_lapangan ?? '' }}</textarea>
                                    </div>
                                </div>

                                <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-4" style="font-size: 14px;">Alat, Logistik & Personel</h6>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Konsumsi Alat Umum</label>
                                        <input type="text" name="konsumsi_alat" class="form-control" value="{{ $teknis->konsumsi_alat ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-8">
                                        @php $armadaData = json_decode($teknis->armada ?? '[]'); @endphp
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Unit Armada</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="armada[]" value="pompa" {{ is_array($armadaData) && in_array('pompa', $armadaData) ? 'checked' : '' }}>
                                            <label class="form-check-label">Unit Pompa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="armada[]" value="rescue" {{ is_array($armadaData) && in_array('rescue', $armadaData) ? 'checked' : '' }}>
                                            <label class="form-check-label">Unit Rescue</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Jumlah Personel</label>
                                        <input type="number" name="jumlah_personel" class="form-control" value="{{ $teknis->jumlah_personel ?? 0 }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Personel yang Terlibat</label>
                                        <textarea class="form-control" name="daftar_personel" rows="2">{{ $teknis->daftar_personel ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3: DOKUMENTASI & VALIDASI -->
                            <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-search-dollar me-2"></i>Analisis Risiko & Penyebab</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Dugaan Penyebab</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="dugaan_penyebab" style="width: 50%;">
                                                <option value="">-- Pilih Penyebab --</option>
                                                <option value="faktor_alam" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'faktor_alam' ? 'selected' : '' }}>Faktor alam</option>
                                                <option value="lainnya" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control" name="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." value="{{ $dokumentasi->dugaan_penyebab_lainnya ?? '' }}" style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Sumber Api / Titik Awal</label>
                                        <input type="text" name="sumber_api" class="form-control" value="{{ $dokumentasi->sumber_api ?? '' }}">
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-handshake me-2"></i>Kerjasama Lintas Sektoral</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        @php $instansiData = json_decode($dokumentasi->instansi_pendukung ?? '[]'); @endphp
                                        <label class="form-label mb-2" style="font-size: 13px; font-weight: 600;">Instansi Pendukung di Lokasi</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln" {{ is_array($instansiData) && in_array('pln', $instansiData) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_pln" style="font-size: 13px;">PLN</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" {{ is_array($instansiData) && in_array('relawan_lokal', $instansiData) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inst_relawan" style="font-size: 13px;">Relawan Lokal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Tindakan Instansi Samping</label>
                                        <textarea class="form-control" name="tindakan_instansi" rows="2">{{ $dokumentasi->tindakan_instansi ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Nomor Kontak Saksi</label>
                                        <input type="text" name="kontak_saksi" class="form-control" value="{{ $dokumentasi->kontak_saksi ?? '' }}">
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-clipboard-check me-2"></i>Evaluasi & Rekomendasi</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label d-block" style="font-size: 13px; font-weight: 600;">Ketepatan Alat (Skala 1-5)</label>
                                        @php $alat = $dokumentasi->ketepatan_alat ?? 5; @endphp
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="ketepatan_alat" id="alat_1" value="1" {{ $alat == 1 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_1">1</label>
                                            
                                            <input type="radio" class="btn-check" name="ketepatan_alat" id="alat_5" value="5" {{ $alat == 5 ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary btn-sm" for="alat_5">5</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-4 text-primary border-top pt-4"><i class="fas fa-camera me-2"></i>Dokumentasi & Catatan Akhir</h5>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Kronologi Kejadian Terperinci</label>
                                        <textarea class="form-control" name="kronologi_lengkap" rows="5">{{ $dokumentasi->kronologi_lengkap ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Update File Foto (Biarkan kosong jika tidak diubah)</label>
                                        <input class="form-control mb-2" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        @if(!empty($dokumentasi->foto))
                                            <small class="text-success"><i class="fas fa-check me-1"></i> Foto sudah terunggah sebelumnya.</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: KATEGORI KHUSUS -->
                            <div class="tab-pane fade" id="khusus" role="tabpanel">
                                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-paw me-2"></i>Kategori Khusus Penyelamatan Hewan</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Jenis Hewan</label>
                                        <select class="form-select" name="jenis_hewan">
                                            <option value="">-- Pilih Jenis Hewan --</option>
                                            <option value="ular" {{ ($khusus->jenis_hewan ?? '') == 'ular' ? 'selected' : '' }}>Ular</option>
                                            <option value="tawon" {{ ($khusus->jenis_hewan ?? '') == 'tawon' ? 'selected' : '' }}>Tawon/Vespa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Spesies / Nama Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" value="{{ $khusus->spesies_hewan ?? '' }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Dimensi Hewan</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" value="{{ $khusus->dimensi_hewan ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Status Hewan Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="dilepasliarkan" {{ ($khusus->status_hewan_pasca ?? '') == 'dilepasliarkan' ? 'selected' : '' }}>Dilepasliarkan ke habitat</option>
                                            <option value="diserahkan_bksda" {{ ($khusus->status_hewan_pasca ?? '') == 'diserahkan_bksda' ? 'selected' : '' }}>Diserahkan ke BKSDA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-size: 13px; font-weight: 600;">Lokasi Habitat Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" value="{{ $khusus->lokasi_pelepasan ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <a href="/internal/damtan/data-laporan" class="btn btn-light me-2 fw-bold text-secondary">Batal</a>
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
            <span class="text-muted" style="font-size: 12px;">Geser pin merah atau klik peta untuk menentukan koordinat. <br>Koordinat saat ini: <strong id="latlngDisplay">{{ $coords }}</strong></span>
            <div>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanKoordinat()">Simpan Perubahan</button>
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
        // Gunakan titik yang ada di DB untuk setting marker
        const mapCoords = [{{ $coords }}];

        myModalEl.addEventListener('shown.bs.modal', event => {
            if(!map) {
                map = L.map('map').setView(mapCoords, 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker(mapCoords, {draggable: true}).addTo(map);

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