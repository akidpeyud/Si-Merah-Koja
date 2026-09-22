<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspeksi Bangunan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* NAVBAR */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; } 
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        /* SIDEBAR (UTUH & LENGKAP) */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }

        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        /* MAIN AREA */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        
        /* Custom Tabs Menyamping */
        .custom-nav-tabs { border-bottom: 2px solid #e2e8f0; margin-top: 25px; gap: 10px; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 5px; }
        .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
        .custom-nav-tabs::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-nav-tabs .nav-link { border: none; color: #64748b; font-weight: 700; font-size: 13px; padding: 12px 18px; background: transparent; white-space: nowrap; cursor: pointer; transition: all 0.2s; }
        .custom-nav-tabs .nav-link:hover { color: #0f172a; }
        .custom-nav-tabs .nav-link.active { color: #10b981; border-bottom: 3px solid #10b981; }

        /* TABEL HEADER GELAP */
        .table-wrapper { background-color: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-top: 20px; overflow: hidden; }
        .table-responsive { width: 100%; overflow-x: auto; }
        .table-custom { margin-bottom: 0; width: 100%; min-width: 800px; } /* Lebar secukupnya karena cuma 4 kolom */
        
        .table-custom thead th {
            background-color: #1e293b !important; 
            color: #ffffff !important;
            font-size: 12px;
            font-weight: 700;
            padding: 18px 15px;
            letter-spacing: 0.5px;
            border: none;
            border-right: 1px solid #334155 !important; 
            text-transform: uppercase;
            white-space: nowrap;
            vertical-align: middle;
        }
        
        .table-custom tbody td {
            padding: 15px;
            vertical-align: middle;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            border-right: 1px solid #f1f5f9;
            white-space: nowrap;
        }
        
        /* Badges & Buttons */
        .btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 6px; font-size: 13px; color: white; border: none; margin-right: 5px; }
        .btn-edit { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; }

        /* Sticky Action Column */
        .sticky-action { position: sticky; right: 0; background-color: white !important; z-index: 1; box-shadow: -2px 0 5px rgba(0,0,0,0.05); }
        .table-custom thead th.sticky-action { background-color: #1e293b !important; box-shadow: -2px 0 5px rgba(0,0,0,0.2); border-left: 2px solid #0f172a !important; }
        .table-custom tbody td.sticky-action { border-left: 2px solid #e2e8f0; }
    </style>
</head>
<body>

    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah" onerror="this.style.display='none'">
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

    <div class="dashboard-container">
        
        <!-- SIDEBAR UTUH -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- ACCORDION PENCEGAHAN -->
            <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                <span>Bagian Pencegahan</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                        PENINGKATAN KAPASITAS APARATUR
                    </a>
                    <!-- INI YANG AKTIF KARENA HALAMAN INSPEKSI -->
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="sidebar-item active" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                        PENCEGAHAN KEBAKARAN DAN INSPEKSI
                    </a>
                    <a href="#" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                        PEMBERDAYAAN MASYARAKAT DAN DUNIA USAHA
                    </a>
                </div>
            </div>

            <!-- ACCORDION PEMADAMAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman">
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
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra">
                <span>Bagian Sapra</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                    <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                    <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                </div>
            </div>
            
            <!-- ACCORDION MANAJEMEN BERITA -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita">
                <span>Manajemen Berita</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                    <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            
            <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-3">
                <div>
                    <h1 class="fw-bolder text-dark mb-2" style="font-size: 28px;">Pencegahan Kebakaran & Inspeksi</h1>
                    <p class="text-muted mb-0" style="font-size: 15px;">Kelola data inspeksi bangunan gedung, lingkungan, dan pelaksanaan fire drill.</p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group" style="width: 260px;">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama tempat...">
                    </div>
                    
                   <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #0284c7; padding: 9px 16px;">
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

            <!-- TABEL 4 KOLOM SESUAI EXCEL LU -->
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="table table-hover table-custom">
                        <thead>
                            <tr>
                                <th class="text-center" width="80px">NO</th>
                                <th>NAMA TEMPAT</th>
                                <th>BULAN</th>
                                <th>JENIS USAHA</th>
                                <th class="sticky-action text-center" width="100px">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data sesuai foto excel lu -->
                            <tr>
                                <td class="text-center fw-bold">1</td>
                                <td><div class="fw-bold text-dark">INFINITY HOTEL</div></td>
                                <td>6 FEBRUARI 2025</td>
                                <td>HOTEL</td>
                                <td class="sticky-action text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="text-center fw-bold">2</td>
                                <td><div class="fw-bold text-dark">RSUD RADEN MATAHER</div></td>
                                <td>13 FEBRUARI 2025</td>
                                <td>RUMAH SAKIT</td>
                                <td class="sticky-action text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-bold">3</td>
                                <td><div class="fw-bold text-dark">PT. Trona sentosa lestari</div></td>
                                <td>20 FEBRUARI 2025</td>
                                <td>Mall</td>
                                <td class="sticky-action text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-bold">4</td>
                                <td><div class="fw-bold text-dark">Mandala</div></td>
                                <td>4 MARET 2025</td>
                                <td>MALL</td>
                                <td class="sticky-action text-center">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>