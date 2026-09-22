<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencegahan Kebakaran & Inspeksi - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            background-color: #f3f4f6;
            color: #1f2937;
        }

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; 
            z-index: 99999; display: flex; align-items: center; gap: 12px; 
            font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .btn-close-alert {
            background: transparent; border: none; color: white; opacity: 0.7; 
            font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s;
        }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter {
            from { transform: translate(-50%, -50px); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }
        @keyframes fadeOutUpCenter {
            from { transform: translate(-50%, 0); opacity: 1; }
            to { transform: translate(-50%, -50px); opacity: 0; }
        }

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
            width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0;
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

        /* --- MAIN AREA (TABEL & TAB MENYAMPING) --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        
        /* Custom Tabs Menyamping */
        .custom-nav-tabs {
            border-bottom: 2px solid #e2e8f0;
            margin-top: 25px;
            gap: 10px;
            flex-wrap: nowrap; 
            overflow-x: auto; 
            padding-bottom: 5px;
        }
        .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
        .custom-nav-tabs::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-nav-tabs .nav-link {
            border: none;
            color: #64748b;
            font-weight: 700;
            font-size: 13px;
            padding: 12px 18px;
            background: transparent;
            white-space: nowrap;
        }
        .custom-nav-tabs .nav-link:hover { color: #0f172a; }
        .custom-nav-tabs .nav-link.active {
            color: #10b981;
            border-bottom: 3px solid #10b981;
        }

        /* Table Customization */
        .table-custom {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .table-custom thead { background-color: #ffffff; border-bottom: 2px solid #e2e8f0; }
        .table-custom th { color: #0f172a; font-size: 12px; font-weight: 800; padding: 20px; letter-spacing: 0.5px; border: none; text-transform: uppercase; }
        .table-custom td { padding: 18px 20px; vertical-align: middle; font-size: 14px; border-bottom: 1px solid #f1f5f9; }
        
        /* Badges & Buttons */
        .badge-soft-blue { background-color: #e0f2fe; color: #0284c7; padding: 6px 12px; font-weight: 700; border-radius: 6px; border: 1px solid #bae6fd; }
        .btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 6px; font-size: 13px; color: white; border: none; margin-right: 5px; }
        .btn-edit { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; }
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
                <span>{{ Auth::user()?->nama_lengkap ?? 'M Ariffan Hidayah' }}</span>
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
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()?->role === 'user' || Auth::user()?->role === 'super_user' || true)
                
                <!-- ACCORDION PENCEGAHAN (CUMA 3 MENU) -->
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <!-- LINK MENU 1 -->
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                            PENINGKATAN KAPASITAS APARATUR
                        </a>
                        
                        <!-- LINK MENU 2 (YANG LAGI AKTIF DI HALAMAN INI) -->
                        <a href="/internal/pencegahan/inspeksi-kebakaran" class="sidebar-item active" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                            PENCEGAHAN KEBAKARAN DAN INSPEKSI
                        </a>
                        
                        <!-- LINK MENU 3 -->
                        <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                            PEMBERDAYAAN MASYARAKAT DAN DUNIA USAHA
                        </a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="false">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    </div>
                </div>
            @endif

            @if(Auth::user()?->role === 'operator' || Auth::user()?->role === 'super_user' || true)
                <!-- ACCORDION MANAJEMEN BERITA -->
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
                    <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA (BAGIAN KANAN) -->
        <main class="main-content">
            
            <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-3">
                <div>
                    <!-- JUDUL HALAMAN -->
                    <h1 class="fw-bolder text-dark mb-2" style="font-size: 28px;">Pencegahan Kebakaran & Inspeksi</h1>
                    <p class="text-muted mb-0" style="font-size: 15px;">Kelola data inspeksi bangunan gedung, lingkungan, dan pelaksanaan fire drill.</p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group" style="width: 260px;">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama atau ST...">
                    </div>
                    
                    <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #0284c7; padding: 9px 16px;">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #10b981; padding: 9px 16px;">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                    <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #ef4444; padding: 9px 16px;">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                </div>
            </div>
<!-- TABS MENYAMPING SAKTI UNTUK SEMUA HALAMAN INSPEKSI -->
<ul class="nav custom-nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran">
            Semua Data
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/bangunan">
            INSPEKSI BANGUNAN GEDUNG DAN LINGKUNGAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/fire-drill') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/fire-drill">
            FIRE DRILL
        </a>
    </li>
</ul>

            <!-- TABEL DATA -->
            <div class="table-custom mt-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">NO</th>
                                <th width="20%">SURAT TUGAS (ST)</th>
                                <th width="25%">NAMA BANGUNAN</th>
                                <th width="25%">ALAMAT</th>
                                <th width="15%" class="text-center">DOKUMEN</th>
                                <th width="10%" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data Dummy 1 -->
                            <tr>
                                <td class="text-center fw-bold text-dark">1</td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 15px;">094/ST-INSP/2026</div>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> 15 September 2026</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 14px;">Hotel Infinity Jambi</div>
                                    <span class="badge bg-primary mt-1 px-2 py-1" style="font-size: 10px;">INSPEKSI</span>
                                </td>
                                <td>
                                    <div style="color: #334155; font-size: 13px;">Jl. Sultan Thaha No.60, Beringin, Kec. Ps. Jambi</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge-soft-blue"><i class="fas fa-file-alt me-1"></i> BA & Rekomendasi</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <!-- Data Dummy 2 -->
                            <tr>
                                <td class="text-center fw-bold text-dark">2</td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 15px;">098/ST-FD/2026</div>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> 10 Oktober 2026</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 14px;">RSUD Raden Mattaher</div>
                                    <span class="badge bg-danger mt-1 px-2 py-1" style="font-size: 10px;">FIRE DRILL</span>
                                </td>
                                <td>
                                    <div style="color: #334155; font-size: 13px;">Jl. Letjen Suprapto No.31, Telanaipura</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge-soft-blue"><i class="fas fa-file-alt me-1"></i> Dokumen Lengkap</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>