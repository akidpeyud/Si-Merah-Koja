<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hidrant Kota Jambi - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4), 0 8px 10px -6px rgba(16, 185, 129, 0.1); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        #globalSuccessAlert .alert-icon { font-size: 22px; }
        #globalSuccessAlert .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        #globalSuccessAlert .btn-close-alert:hover { opacity: 1; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; transition: opacity 0.3s;}
        .nav-brand:hover { opacity: 0.8; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR ACCORDION STYLES --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f8fafc; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; transition: color 0.2s; }
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        /* --- MAIN AREA & TABLE STYLES --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-y: auto; }
        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 12.5px; white-space: nowrap; }
        .table-custom thead th { background-color: #111827; color: #f8fafc; font-weight: 600; padding: 16px 12px; border-bottom: none; text-align: center; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase; }
        .table-custom tbody td { padding: 12px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .table-custom tbody tr:hover { background-color: #f8fafc; }
        
        /* STATUS BADGES */
        .status-badge { padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; }
        .bg-baik { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .bg-rusak { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .bg-sedang { background-color: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
        .bg-kuat { background-color: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .bg-lemah { background-color: #ffedd5; color: #9a3412; border: 1px solid #fed7aa; }
        .bg-null { background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }

        .btn-action { padding: 6px 10px; font-size: 12px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-edit { background-color: #f59e0b; color: white; }
        .btn-delete { background-color: #ef4444; color: white; }

        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
    </style>
</head>
<body>

    <!-- ALERT SUCCESS GLOBAL -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert()"><i class="fas fa-times"></i></button>
        </div>
        <script>
            function closeAlert() {
                let alertBox = document.getElementById('globalSuccessAlert');
                if(alertBox) {
                    alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                    setTimeout(() => alertBox.remove(), 400); 
                }
            }
            setTimeout(closeAlert, 4000);
        </script>
    @endif

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA </span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</span>
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
        
        <!-- SIDEBAR UTUH MANUAL -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="false">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data & Laporan</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
                        <a href="#" class="sidebar-item"><i class="fas fa-users-cog"></i> Jadwal Piket Regu</a>
                        <a href="#" class="sidebar-item"><i class="fas fa-running"></i> Data Relawan Redkar</a>
                    </div>
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                       <!-- GRUP MANAJEMEN AIR -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
<a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
<a href="/sapra/data-hidrant-kota" class="sidebar-item active"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

<!-- GRUP FASILITAS & POS -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
<a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
<a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
<a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
<a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

<!-- GRUP PERENCANAAN / MUTU BAKU -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
<a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
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
                        <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>
            @endif

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

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Hidrant Kota Jambi</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">Monitoring kondisi, tekanan air, dan machino hidrant di wilayah Kota Jambi.</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    
                    <!-- Form Pencarian (REAL TIME JAVASCRIPT) -->
                    <div class="input-group shadow-sm me-2" style="width: 280px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #cbd5e1;"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari jalan, kecamatan, RT..." style="border-color: #cbd5e1; font-size: 14px;">
                    </div>
                    
                    <button class="btn btn-primary fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none;">
                        <i class="fas fa-plus me-1"></i> Tambah Data
                    </button>
                    
                    <a href="/sapra/data-hidrant-kota/cetak-excel" class="btn btn-success fw-bold px-3 shadow-sm" style="background-color: #10b981; border: none;">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </a>

                    <a href="/sapra/data-hidrant-kota/cetak-pdf" class="btn btn-danger fw-bold px-3 shadow-sm" style="background-color: #ef4444; border: none;">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </a>
                </div>
            </div>

            <!-- TABEL DATA UTAMA -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th width="16%" style="text-align: left; padding-left: 20px;">JALAN</th>
                                <th width="14%" style="text-align: left;">KECAMATAN / KELURAHAN</th>
                                <th width="4%">RT</th>
                                <th width="14%" style="text-align: left;">LOKASI TERDEKAT</th>
                                <th width="7%">KODE MAP</th>
                                <th width="7%">KONDISI</th>
                                <th width="7%">TEKANAN</th>
                                <th width="7%">MACHINO</th>
                                <th width="18%" style="text-align: left;">KETERANGAN</th>
                                <th width="6%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($dataMaintenance as $item)
                            <tr class="data-row">
                                <td class="fw-bold text-dark text-wrap" style="min-width: 130px; padding-left: 20px;">{{ $item->jalan }}</td>
                                <td>
                                    <span class="d-block fw-bold text-dark">{{ $item->kecamatan }}</span>
                                    <span class="small text-muted">{{ $item->kelurahan }}</span>
                                </td>
                                <td class="text-center">{{ $item->rt ?? '-' }}</td>
                                <td class="text-wrap" style="min-width: 130px;">{{ $item->lokasi_terdekat }}</td>
                                <td class="text-center fw-medium text-secondary">{{ $item->kode_map ?? '-' }}</td>
                                
                                <td class="text-center data-kondisi">
                                    @php $kondisi = strtolower(trim($item->kondisi_hidran)); @endphp
                                    <span class="status-badge {{ $kondisi == 'baik' ? 'bg-baik' : ($kondisi == 'rusak' ? 'bg-rusak' : 'bg-null') }}">
                                        {{ $item->kondisi_hidran ?? '-' }}
                                    </span>
                                </td>
                                
                                <td class="text-center data-tekanan">
                                    @php $tekanan = strtolower(trim($item->tekanan)); @endphp
                                    <span class="status-badge {{ $tekanan == 'kuat' ? 'bg-kuat' : ($tekanan == 'sedang' ? 'bg-sedang' : ($tekanan == 'lemah' ? 'bg-lemah' : 'bg-null') )}}">
                                        {{ $item->tekanan ?? '-' }}
                                    </span>
                                </td>
                                
                                <td class="text-center data-machino">
                                    @php $machino = strtolower(trim($item->machino)); @endphp
                                    <span class="status-badge {{ $machino == 'baik' ? 'bg-baik' : ($machino == 'rusak' ? 'bg-rusak' : 'bg-null') }}">
                                        {{ $item->machino ?? '-' }}
                                    </span>
                                </td>
                                
                                <td class="text-wrap text-muted data-keterangan" style="min-width: 180px; font-size: 11.5px;">{{ $item->keterangan }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        <form action="/sapra/data-hidrant-kota/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- MODAL EDIT -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title fw-bold text-dark">Edit Data Hidrant Kota Jambi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="/sapra/data-hidrant-kota/update/{{ $item->id }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-body text-start text-wrap">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3"><label class="form-label fw-bold small">Jalan</label><input type="text" class="form-control" name="jalan" value="{{ $item->jalan }}" required></div>
                                                    <div class="col-md-6 mb-3"><label class="form-label fw-bold small">Lokasi Terdekat</label><input type="text" class="form-control" name="lokasi_terdekat" value="{{ $item->lokasi_terdekat }}" required></div>
                                                    <div class="col-md-5 mb-3"><label class="form-label fw-bold small">Kecamatan</label><input type="text" class="form-control" name="kecamatan" value="{{ $item->kecamatan }}" required></div>
                                                    <div class="col-md-5 mb-3"><label class="form-label fw-bold small">Kelurahan</label><input type="text" class="form-control" name="kelurahan" value="{{ $item->kelurahan }}" required></div>
                                                    <div class="col-md-2 mb-3"><label class="form-label fw-bold small">RT</label><input type="text" class="form-control" name="rt" value="{{ $item->rt }}"></div>
                                                    <div class="col-md-12 mb-3"><label class="form-label fw-bold small">Kode Map</label><input type="text" class="form-control" name="kode_map" value="{{ $item->kode_map }}"></div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label fw-bold small">Kondisi Hidran</label>
                                                        <select class="form-select" name="kondisi_hidran">
                                                            <option value="">-- Pilih --</option>
                                                            <option value="Baik" {{ strcasecmp($item->kondisi_hidran, 'Baik') == 0 ? 'selected' : '' }}>Baik</option>
                                                            <option value="Rusak" {{ strcasecmp($item->kondisi_hidran, 'Rusak') == 0 ? 'selected' : '' }}>Rusak</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label fw-bold small">Tekanan Air</label>
                                                        <select class="form-select" name="tekanan">
                                                            <option value="">-- Pilih --</option>
                                                            <option value="Kuat" {{ strcasecmp($item->tekanan, 'Kuat') == 0 ? 'selected' : '' }}>Kuat</option>
                                                            <option value="Sedang" {{ strcasecmp($item->tekanan, 'Sedang') == 0 ? 'selected' : '' }}>Sedang</option>
                                                            <option value="Lemah" {{ strcasecmp($item->tekanan, 'Lemah') == 0 ? 'selected' : '' }}>Lemah</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label fw-bold small">Machino</label>
                                                        <select class="form-select" name="machino">
                                                            <option value="">-- Pilih --</option>
                                                            <option value="Baik" {{ strcasecmp($item->machino, 'Baik') == 0 ? 'selected' : '' }}>Baik</option>
                                                            <option value="Rusak" {{ strcasecmp($item->machino, 'Rusak') == 0 ? 'selected' : '' }}>Rusak</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3"><label class="form-label fw-bold small">Keterangan</label><textarea class="form-control" name="keterangan" rows="2">{{ $item->keterangan }}</textarea></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light"><button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #0284c7; border: none;">Simpan Perubahan</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr><td colspan="10" class="text-center py-5 text-muted fw-medium">Belum ada data hidrant kota.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- REKAPITULASI DATA -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="table-card p-4">
                        <h5 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-chart-pie me-2" style="color: #0284c7;"></i> Rekapitulasi Data Hidrant</h5>
                        <div class="row fw-medium text-secondary" style="font-size: 13px;">
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Kondisi Baik</span> <span id="stat-baik" class="fw-bold text-dark">: {{ $stats['kondisi_baik'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Bisa Dipakai</span> <span id="stat-bisa-dipakai" class="fw-bold text-dark">: {{ $stats['bisa_dipakai'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Kondisi Rusak</span> <span id="stat-rusak" class="fw-bold text-dark">: {{ $stats['kondisi_rusak'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Tidak Bisa Dipakai</span> <span id="stat-tidak-bisa-dipakai" class="fw-bold text-dark">: {{ $stats['tidak_bisa_dipakai'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Tekanan Kuat</span> <span id="stat-kuat" class="fw-bold text-dark">: {{ $stats['tekanan_kuat'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Tergantung Listrik</span> <span id="stat-listrik" class="fw-bold text-dark">: {{ $stats['tergantung_listrik'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Tekanan Sedang</span> <span id="stat-sedang" class="fw-bold text-dark">: {{ $stats['tekanan_sedang'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Tidak Keluar Air</span> <span id="stat-tidak-keluar-air" class="fw-bold text-dark">: {{ $stats['tidak_keluar_air'] ?? 0 }} Hidrant</span></div>
                            <div class="col-6 mb-2 d-flex justify-content-between"><span>Tekanan Lemah</span> <span id="stat-lemah" class="fw-bold text-dark">: {{ $stats['tekanan_lemah'] ?? 0 }} Hidrant</span></div>
                        </div>
                        <div class="mt-3 pt-3 border-top d-flex justify-content-between fw-bold" style="font-size: 15px; color: #111827;">
                            <span>Total Seluruh Hidrant</span>
                            <span id="stat-total">: {{ $stats['total'] ?? 0 }} Titik Hidrant</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH DATA -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold text-dark">Tambah Data Hidrant Kota Jambi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/sapra/data-hidrant-kota/store" method="POST">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label fw-bold small">Jalan</label><input type="text" class="form-control" name="jalan" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label fw-bold small">Lokasi Terdekat</label><input type="text" class="form-control" name="lokasi_terdekat" required></div>
                            <div class="col-md-5 mb-3"><label class="form-label fw-bold small">Kecamatan</label><input type="text" class="form-control" name="kecamatan" required></div>
                            <div class="col-md-5 mb-3"><label class="form-label fw-bold small">Kelurahan</label><input type="text" class="form-control" name="kelurahan" required></div>
                            <div class="col-md-2 mb-3"><label class="form-label fw-bold small">RT</label><input type="text" class="form-control" name="rt"></div>
                            <div class="col-md-12 mb-3"><label class="form-label fw-bold small">Kode Map</label><input type="text" class="form-control" name="kode_map"></div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold small">Kondisi Hidran</label>
                                <select class="form-select" name="kondisi_hidran">
                                    <option value="">-- Pilih --</option><option value="Baik">Baik</option><option value="Rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold small">Tekanan Air</label>
                                <select class="form-select" name="tekanan">
                                    <option value="">-- Pilih --</option><option value="Kuat">Kuat</option><option value="Sedang">Sedang</option><option value="Lemah">Lemah</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold small">Machino</label>
                                <select class="form-select" name="machino">
                                    <option value="">-- Pilih --</option><option value="Baik">Baik</option><option value="Rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3"><label class="form-label fw-bold small">Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light"><button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #0284c7; border: none;">Simpan Data</button></div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK SEARCH BAR & UPDATE REKAPITULASI REAL-TIME -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.data-row');
            
            // Variabel penampung perhitungan baru
            let stats = {
                total: 0, baik: 0, rusak: 0, kuat: 0, sedang: 0, lemah: 0,
                bisaDipakai: 0, tidakBisaDipakai: 0, listrik: 0, tidakKeluarAir: 0
            };

            rows.forEach(row => {
                let textContent = row.textContent.toLowerCase();
                
                // Kalau baris ini cocok dengan ketikan pencarian
                if(textContent.includes(filter)) {
                    row.style.display = ''; // Munculkan baris
                    stats.total++;          // Tambah total

                    // Ambil teks spesifik dari kolom Kondisi, Tekanan, dan Keterangan
                    let kondisiText = row.querySelector('.data-kondisi').textContent.trim().toLowerCase();
                    let tekananText = row.querySelector('.data-tekanan').textContent.trim().toLowerCase();
                    let keteranganText = row.querySelector('.data-keterangan').textContent.trim().toLowerCase();

                    // Cek Kondisi
                    if(kondisiText === 'baik') stats.baik++;
                    if(kondisiText === 'rusak') stats.rusak++;

                    // Cek Tekanan
                    if(tekananText === 'kuat') stats.kuat++;
                    if(tekananText === 'sedang') stats.sedang++;
                    if(tekananText === 'lemah') stats.lemah++;

                    // Cek Keterangan
                    if(keteranganText.includes('tidak bisa dipakai')) {
                        stats.tidakBisaDipakai++;
                    } else if (keteranganText.includes('bisa dipakai')) {
                        stats.bisaDipakai++;
                    }

                    if(keteranganText.includes('listrik')) stats.listrik++;
                    if(keteranganText.includes('tidak keluar air')) stats.tidakKeluarAir++;

                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });

            // Update DOM / Layar Rekapitulasi dengan data baru
            document.getElementById('stat-baik').textContent = ': ' + stats.baik + ' Hidrant';
            document.getElementById('stat-rusak').textContent = ': ' + stats.rusak + ' Hidrant';
            document.getElementById('stat-kuat').textContent = ': ' + stats.kuat + ' Hidrant';
            document.getElementById('stat-sedang').textContent = ': ' + stats.sedang + ' Hidrant';
            document.getElementById('stat-lemah').textContent = ': ' + stats.lemah + ' Hidrant';
            document.getElementById('stat-bisa-dipakai').textContent = ': ' + stats.bisaDipakai + ' Hidrant';
            document.getElementById('stat-tidak-bisa-dipakai').textContent = ': ' + stats.tidakBisaDipakai + ' Hidrant';
            document.getElementById('stat-listrik').textContent = ': ' + stats.listrik + ' Hidrant';
            document.getElementById('stat-tidak-keluar-air').textContent = ': ' + stats.tidakKeluarAir + ' Hidrant';
            document.getElementById('stat-total').textContent = ': ' + stats.total + ' Titik Hidrant';
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>