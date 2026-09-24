<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sarana Penyelamatan - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s; }
        #globalSuccessAlert .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }

        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1030; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; transition: opacity 0.3s;}
        .nav-brand:hover { opacity: 0.8; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* SIDEBAR STYLES (Sama dengan sebelumnya) */
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

        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }

        .nav-tabs { border-bottom: 2px solid #e2e8f0; margin-bottom: 25px; flex-wrap: nowrap; overflow-x: auto; white-space: nowrap; gap: 10px; }
        .nav-tabs .nav-link { color: #64748b; font-weight: 700; font-size: 12.5px; text-transform: uppercase; border: none; padding: 12px 24px; transition: all 0.2s; position: relative; background: transparent; }
        .nav-tabs .nav-link:hover { color: #0f172a; }
        .nav-tabs .nav-link.active { color: #0284c7; background: transparent; }
        .nav-tabs .nav-link.active::after { content: ''; position: absolute; bottom: -2px; left: 0; right: 0; height: 3px; background-color: #0284c7; border-radius: 3px 3px 0 0; }

        .info-card { background: linear-gradient(to right, #ffffff, #f8fafc); border-left: 4px solid #0284c7; border-radius: 8px; padding: 20px; margin-bottom: 25px; box-shadow: 0 2px 4px -1px rgba(0,0,0,0.05); }
        .info-card h5 { font-size: 17px; font-weight: 800; color: #0f172a; margin-bottom: 10px; text-transform: uppercase; }
        .info-card p { font-size: 13.5px; color: #475569; margin: 0 0 6px 0; display: flex; align-items: center; gap: 10px; font-weight: 500; }
        .info-card p:last-child { margin-bottom: 0; }

        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13.5px; }
        .table-custom thead th { background-color: #111827; color: #f8fafc; font-weight: 600; padding: 16px 12px; text-align: center; font-size: 11.5px; letter-spacing: 0.5px; text-transform: uppercase; border-bottom: none; }
        .table-custom tbody td { padding: 18px 12px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        
        .img-sarana { width: 180px; height: 120px; object-fit: cover; border-radius: 6px; transition: transform 0.2s; }
        .img-wrapper { display: inline-block; padding: 4px; border: 1px solid #e2e8f0; border-radius: 8px; background-color: #f8fafc; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .img-wrapper:hover .img-sarana { transform: scale(1.03); }

        .btn-action { padding: 8px 12px; font-size: 12.5px; border-radius: 6px; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-edit { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-edit:hover { background-color: #e2e8f0; color: #0f172a; }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .btn-delete:hover { background-color: #fecaca; color: #991b1b; }

        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
    </style>
</head>
<body>

<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
</div>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a href="/internal/index" class="brand">
            <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
            <span>SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
    </nav>

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
<<<<<<< HEAD
            </details>
        @endif

        <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-user-tie grp-ico"></i>
                <span class="grp-label">KEPEGAWAIAN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <a href="/internal/kepegawaian/duk" class="side-a {{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}"><i class="fas fa-user-tie"></i> Data Urut Kepegawaian</a>
            </div>
        </details>

        @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>
                    <i class="fas fa-warehouse grp-ico"></i>
                    <span class="grp-label">BAGIAN SAPRA</span>
                    <i class="fas fa-chevron-down chev"></i>
                </summary>
                <div class="side-sub">
                    <span class="side-sub-kicker">SARANA &amp; PRASARANA</span>

                    <a href="/sapra/sarana-mako" class="side-a {{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako" class="side-a {{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>

                    <!-- ACTIVE karena ini halaman Sarana Penyelamatan -->
                    <a href="/sapra/sarana-penyelamatan" class="side-a active"><i class="fas fa-life-ring"></i> Sarana penyelamatan &amp; evakuasi</a>

                    <a href="/sapra/sarana-pemeriksaan" class="side-a {{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana pemeriksaan proteksi kebakaran</a>
                    <a href="/sapra/kelola-pos" class="side-a {{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-sub-kicker">MANAJEMEN AIR</span>
                    <a href="/sapra/data_hidrant_gedung" class="side-a {{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="side-a {{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data hidrant Kota Jambi</a>

                    <span class="side-sub-kicker">LOGISTIK &amp; DISTRIBUSI</span>
                    <a href="/sapra/kebutuhan-sarpras" class="side-a {{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu baku kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="side-a {{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i>Serah Terima Barang</a>
=======
                    </div>
>>>>>>> 564918155729b149c2bfa260c20d0a2eb0b2f080
                </div>
                <div class="sidebar-separator"></div>

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
<a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

<!-- GRUP FASILITAS & POS -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
<a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
<a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
<a href="/sapra/sarana-penyelamatan" class="sidebar-item active"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
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
            </details>
        @endif

        <div class="side-divider"></div>

        <div class="side-kicker">AKUN</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-user-gear grp-ico"></i>
                <span class="grp-label">PENGATURAN AKUN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <a href="/internal/profil" class="side-a {{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="side-a {{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola pengguna</a>
                @endif
            </div>
        </details>
    </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Sarana Penyelamatan</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">Manajemen dokumentasi alat dan sarana penyelamatan di Markas Komando dan Pos.</p>
                </div>
               <div class="d-flex gap-2 align-items-center">
                    <div class="input-group shadow-sm me-2 search-container" style="width: 250px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #cbd5e1;"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari alat rescue..." style="border-color: #cbd5e1; font-size: 14px;">
                    </div>

                    <button class="btn btn-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none; padding: 10px 16px; border-radius: 8px;">
                        <i class="fas fa-plus me-1"></i> Tambah Data
                    </button>
                    
                    <!-- TAMBAHIN TOMBOL PDF INI DI SINI -->
                    <a href="/sapra/sarana-penyelamatan/cetak-pdf" class="btn btn-danger fw-bold shadow-sm" style="background-color: #ef4444; border: none; padding: 10px 16px; border-radius: 8px; text-decoration: none; color: white;">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </a>
                </div>
            </div>
        </div>

            @php $activeTab = session('active_tab'); @endphp

            <ul class="nav nav-tabs" id="posTabs" role="tablist">
                @foreach($posPemadam as $pos)
                    @php $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first; @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $isActive ? 'active' : '' }}" id="tab-{{ $pos->id_pos }}" data-bs-toggle="tab" data-bs-target="#content-{{ $pos->id_pos }}" type="button" role="tab">
                            {{ $pos->nama_pos }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="posTabsContent">
                @foreach($posPemadam as $pos)
                    @php $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first; @endphp
                    <div class="tab-pane fade {{ $isActive ? 'show active' : '' }}" id="content-{{ $pos->id_pos }}" role="tabpanel">
                        
                        <div class="info-card">
                            <h5>{{ $pos->nama_pos }}</h5>
                            <p><i class="fas fa-map-marker-alt text-danger" style="width: 20px;"></i> {{ $pos->alamat ?? 'Alamat belum diatur' }}</p>
                            <p><i class="fas fa-map text-success" style="width: 20px;"></i> Kode Map: <span class="badge bg-light text-dark border ms-1">{{ $pos->kode_map ?? '-' }}</span></p>
                        </div>

                        <div class="table-card">
                            <div class="table-responsive">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th width="5%">NO</th>
                                            <th width="35%" style="text-align: left; padding-left: 20px;">JENIS SARANA PENYELAMATAN</th>
                                            <th width="10%">JUMLAH</th>
                                            <th width="30%">GAMBAR</th>
                                            <th width="20%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $dataFilter = $dataPenyelamatan->where('id_pos', $pos->id_pos); @endphp
                                        
                                        @forelse($dataFilter as $index => $item)
                                            <tr class="data-row">
                                                <td class="text-center fw-bold text-dark">{{ $loop->iteration }}</td>
                                                <td class="fw-bold text-dark" style="padding-left: 20px;">{{ $item->jenis_sarana }}</td>
                                                <td class="text-center fw-bold text-primary" style="font-size: 15px;">{{ $item->jumlah }}</td>
                                                <td class="text-center">
                                                    @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                                        <div class="img-wrapper">
                                                            <a href="{{ asset($item->path_gambar) }}" target="_blank">
                                                                <img src="{{ asset($item->path_gambar) }}" alt="{{ $item->jenis_sarana }}" class="img-sarana" onerror="this.onerror=null; this.src='https://via.placeholder.com/200x130?text=Gambar+Hilang';">
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="badge bg-light text-secondary border py-2 px-3"><i class="fas fa-image me-1"></i> Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id_sarana_penyelamatan }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="/sapra/sarana-penyelamatan/delete/{{ $item->id_sarana_penyelamatan }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sarana penyelamatan ini?');">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="p-5 text-center text-muted">
                                                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                                            <i class="fas fa-life-ring" style="font-size: 32px; color: #cbd5e1;"></i>
                                                        </div>
                                                        <p class="mb-0 fw-bold text-dark">Belum ada data sarana penyelamatan.</p>
                                                        <p class="small mt-1">Silakan tambah data untuk {{ $pos->nama_pos }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- MODAL EDIT DATA -->
                        @foreach($dataFilter as $item)
                            <div class="modal fade" id="modalEdit{{ $item->id_sarana_penyelamatan }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-light pb-3">
                                            <h5 class="modal-title fw-bold text-dark">Edit Data Sarana Penyelamatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Dialog edit -->
                                <dialog class="sheet" id="dlgEdit{{ $item->id_sarana_penyelamatan }}">
                                    <div class="sheet-head">
                                        <h2>Edit Data Sarana Penyelamatan</h2>
                                        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                    </div>
                                    <form action="/sapra/sarana-penyelamatan/update/{{ $item->id_sarana_penyelamatan }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="sheet-body">
                                            <div>
                                                <label class="f-label" for="id_pos{{ $item->id_sarana_penyelamatan }}">Pilih lokasi / pos</label>
                                                <select class="f-input" id="id_pos{{ $item->id_sarana_penyelamatan }}" name="id_pos" required>
                                                    <option value="">— Pilih lokasi —</option>
                                                    @foreach($posPemadam as $posOption)
                                                        <option value="{{ $posOption->id_pos }}" {{ $posOption->id_pos == $item->id_pos ? 'selected' : '' }}>{{ strtoupper($posOption->nama_pos) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="jenis{{ $item->id_sarana_penyelamatan }}">Jenis sarana</label>
                                                    <input class="f-input" type="text" id="jenis{{ $item->id_sarana_penyelamatan }}" name="jenis_sarana" value="{{ $item->jenis_sarana }}" required>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="jumlah{{ $item->id_sarana_penyelamatan }}">Jumlah</label>
                                                    <input class="f-input" type="number" id="jumlah{{ $item->id_sarana_penyelamatan }}" name="jumlah" value="{{ $item->jumlah }}" required>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="f-label" for="gambar{{ $item->id_sarana_penyelamatan }}">Ganti gambar <span class="f-optional">(opsional)</span></label>
                                                <input class="f-input" type="file" id="gambar{{ $item->id_sarana_penyelamatan }}" name="gambar" accept="image/*">
                                                <p class="f-hint">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                                            </div>
                                        </div>
                                        <div class="sheet-foot">
                                            <button type="button" class="btn-cancel" data-close>Batal</button>
                                            <button type="submit" class="btn-save">Simpan perubahan</button>
                                        </div>
                                    </form>
                                </dialog>
                                @empty
                                <tr>
                                    <td colspan="5" class="cell-empty">Belum ada data sarana penyelamatan untuk {{ $pos->nama_pos }}.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

    </main>
</div>

<!-- ==================== DIALOG TAMBAH (GLOBAL) ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah data sarana penyelamatan</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/sarana-penyelamatan/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="sheet-body">
            <div>
                <label class="f-label" for="tambahIdPos">Pilih lokasi / pos</label>
                <select class="f-input" id="tambahIdPos" name="id_pos" required>
                    <option value="">— Pilih lokasi —</option>
                    @foreach($posPemadam as $pos)
                        <option value="{{ $pos->id_pos }}">{{ strtoupper($pos->nama_pos) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahJenis">Jenis sarana</label>
                    <input class="f-input" type="text" id="tambahJenis" name="jenis_sarana" placeholder="Contoh: Perahu Karet" required>
                </div>
                <form action="/sapra/sarana-penyelamatan/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Pilih Lokasi / Pos</label>
                            <select class="form-select border-light-subtle shadow-sm" name="id_pos" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach($posPemadam as $pos)
                                    <option value="{{ $pos->id_pos }}">{{ $pos->nama_pos }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jenis Sarana Penyelamatan</label>
                                <input type="text" class="form-control border-light-subtle shadow-sm" name="jenis_sarana" placeholder="Contoh: ALAT PELINDUNG DIRI (RESCUE)" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jumlah</label>
                                <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah" value="1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Upload Gambar</label>
                            <input type="file" class="form-control border-light-subtle shadow-sm" name="gambar" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light pt-3">
                        <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4" style="background-color: #0284c7; border: none;">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK SEARCH REAL-TIME -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let activeTab = document.querySelector('.tab-pane.active');
            if(!activeTab) return;

            let rows = activeTab.querySelectorAll('.data-row');
            
            rows.forEach(row => {
                let textContent = row.textContent.toLowerCase();
                if(textContent.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            if (searchInput) {
                searchInput.value = '';
                document.querySelectorAll('.data-row').forEach(function (row) { row.style.display = ''; });
            }
        });
    });

    /* ---------- Modal / Dialog ---------- */
    document.querySelectorAll('[data-open]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = document.getElementById(btn.dataset.open);
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });

    document.querySelectorAll('dialog').forEach(function (dlg) {
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg || e.target.closest('[data-close]')) dlg.close();
        });
    });

    /* ---------- Live Search Table ---------- */
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = searchInput.value.trim().toLowerCase();
            var activePanel = document.querySelector('.panel:not([hidden])');
            if (!activePanel) return;

            activePanel.querySelectorAll('.data-row').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    }
})();
</script>
</body>
</html>