<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Data Hidrant - SIMERAH KOJA</title>

=======
    <title>Sumber Air - SIMERAH KOJA</title>
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
<<<<<<< HEAD
        body { background-color: #f4f6f9; color: #1f2937; }

        /* NAVBAR & SIDEBAR */
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
=======
        
        /* 1. KUNCI BODY BIAR GAK BISA DI-SCROLL KESELURUHAN */
        body { background-color: #f8fafc; color: #1e293b; overflow: hidden; }

        /* ALERT STYLES */
        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s; }
        #globalSuccessAlert .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }

        /* 2. TINGGI TETAP UNTUK NAVBAR */
        .navbar-internal { background-color: #0f172a; padding: 0 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1030; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); height: 74px; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }
<<<<<<< HEAD
        
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f8fafc; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; }
        .sidebar-item.active i { color: #2563eb; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; transition: color 0.2s; }
        
        /* --- SIDEBAR ACCORDION STYLES --- */
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        
        /* TABEL & TABS STYLE MODERN */
        .table-card { background: white; border-radius: 0 12px 12px 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13px; }
        .table-custom thead th { background-color: #1e293b; color: #f8fafc; font-weight: 600; padding: 16px; border-bottom: none; text-align: center; font-size: 12px; letter-spacing: 0.5px; text-transform: uppercase; }
=======

        /* --- LAYOUT UTAMA (INDEPENDENT SCROLLING) --- */
        /* 3. TINGGI SISA DARI LAYAR - NAVBAR */
        .dashboard-container { display: flex; height: calc(100vh - 74px); }
        
        /* 4. SCROLL MANDIRI UNTUK SIDEBAR */
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 30px 15px; display: flex; flex-direction: column; gap: 4px; height: 100%; overflow-y: auto; flex-shrink: 0; }
        
        /* 5. SCROLL MANDIRI UNTUK KONTEN UTAMA */
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; height: 100%; }

        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #475569; text-decoration: none; font-size: 13.5px; font-weight: 600; border-radius: 8px; transition: all 0.2s; margin-bottom: 2px; }
        .sidebar-item:hover { background-color: #f1f5f9; color: #0f172a; }
        
        /* State Active untuk Menu Terpilih */
        .sidebar-item.active { background-color: #eff6ff; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #94a3b8; transition: color 0.2s; }

        /* Tombol Accordion */
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 12px 15px; background: transparent; border: none; text-align: left; font-size: 11.5px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; transition: all 0.2s; border-radius: 8px; }
        .sidebar-collapse-btn:hover { color: #475569; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }

        /* Garis Putus-putus antar bidang */
        .sidebar-separator { border-top: 1.5px dashed #e2e8f0; margin: 10px 15px; }
        
        /* Label Judul Kecil */
        .sidebar-heading { display: block; font-size: 11px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 12px; margin-bottom: 6px; letter-spacing: 0.5px; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 2px; padding-left: 5px; margin-top: 4px; }

        /* TABEL & TABS STYLE MODERN */
        .table-card { background: white; border-radius: 0 12px 12px 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13px; }
        
        /* 6. HEADER TABEL STICKY */
        .table-custom thead th { background-color: #0f172a; color: #f8fafc; font-weight: 600; padding: 16px; border-bottom: none; text-align: center; font-size: 12px; letter-spacing: 0.5px; text-transform: uppercase; position: sticky; top: 0; z-index: 10; }
        
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
        .table-custom tbody td { padding: 14px 16px; color: #475569; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .table-custom tbody tr:hover { background-color: #f8fafc; }
        
        /* Badges untuk angka */
<<<<<<< HEAD
        .badge-qty { background: #eff6ff; color: #2563eb; padding: 6px 12px; border-radius: 6px; font-weight: 700; border: 1px solid #bfdbfe; display: inline-block; }
=======
        .badge-qty { background: #eff6ff; color: #0284c7; padding: 6px 12px; border-radius: 6px; font-weight: 700; border: 1px solid #bae6fd; display: inline-block; }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
        .badge-area { background: #f0fdf4; color: #16a34a; padding: 6px 12px; border-radius: 6px; font-weight: 700; border: 1px solid #bbf7d0; display: inline-block; }

        .nav-tabs { border-bottom: 2px solid #e2e8f0; }
        .nav-tabs .nav-link { font-weight: 700; color: #64748b; border: none; padding: 12px 24px; transition: all 0.3s; margin-bottom: -2px; }
        .nav-tabs .nav-link:hover { color: #10b981; }
        .nav-tabs .nav-link.active { color: #10b981; border-bottom: 3px solid #10b981; background-color: transparent; }

        .btn-action { padding: 6px 12px; font-size: 13px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-edit { background-color: #f59e0b; color: white; }
        .btn-delete { background-color: #ef4444; color: white; }
        
<<<<<<< HEAD
        /* Input Search Focus Style */
        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
=======
        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
        
        .badge.btn-hover:hover { background-color: #f8fafc !important; opacity: 0.8; }

        /* ==================================================
           CSS KHUSUS UNTUK PRINT / CETAK PDF
           ================================================== */
        @media print {
            .navbar-internal, .sidebar, .btn, .nav-tabs, .modal, .btn-action, .search-container {
                display: none !important;
            }
            body, .main-content {
                background-color: white !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                overflow: visible !important;
                height: auto !important;
            }
            .dashboard-container { display: block !important; height: auto !important;}
            .table-card { box-shadow: none !important; border: none !important; }
            
            table th:last-child, table td:last-child {
                display: none !important;
            }

            .tab-pane { display: none !important; }
            .tab-pane.active { display: block !important; opacity: 1 !important; }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    </style>
</head>
<body>

<<<<<<< HEAD
    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA </span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
              
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky' }}</span>
                <i class="fas fa-user-circle"></i>
=======
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
        <script>setTimeout(() => document.getElementById('globalSuccessAlert')?.remove(), 4000);</script>
    @endif

    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</span>
                <i class="fas fa-user-circle" style="font-size: 20px; color: #9ca3af;"></i>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        
<<<<<<< HEAD
        <!-- SIDEBAR UTUH MANUAL -->
        <aside class="sidebar" id="sidebarAccordion">
=======
        <!-- SIDEBAR FULL PERSIS DESAIN TERBARU -->
        <aside class="sidebar" id="sidebarAccordion">
            
            <!-- Dashboard Utama -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

<<<<<<< HEAD
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <!-- ACCORDION PENCEGAHAN -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="false">
                    <span>Bagian Pencegahan</span>
=======
            <div class="sidebar-separator"></div>

            <!-- BAGIAN PENCEGAHAN -->
            @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan">
                    <span>BAGIAN PENCEGAHAN</span>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
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
<<<<<<< HEAD

                <!-- ACCORDION PEMADAMAN -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>Bagian Pemadaman</span>
=======
                <div class="sidebar-separator"></div>
            @endif

            <!-- BAGIAN PEMADAMAN -->
            @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman">
                    <span>BAGIAN PEMADAMAN</span>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
<<<<<<< HEAD
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA (DIBUKA OTOMATIS) -->
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>Bagian Sapra</span>
=======
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data & Laporan</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
                    
                    </div>
                </div>
                <div class="sidebar-separator"></div>
            @endif

            <!-- BAGIAN SAPRA -->
            @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>BAGIAN SAPRA</span>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
<<<<<<< HEAD
                        <!-- GRUP MANAJEMEN AIR -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota jambi</a>

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
                <!-- ACCORDION MANAJEMEN BERITA -->
=======
                        
                        <!-- MANAJEMEN SARANA DAN PRASARANA -->
                       <span class="sidebar-heading" style="text-transform: uppercase;">SARANA DAN PRASARANA</span>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam Kebakaran</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pemadam Kebakaran</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                        <a href="/sapra/sarana-pemeriksaan" class="sidebar-item"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi Kebakaran</a>    
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>
                        
                        <!-- ACTIVE ADA DI SINI KARENA INI HALAMAN SUMBER AIR -->
                          <span class="sidebar-heading" style="text-transform: uppercase;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota jambi</a>

                        <!-- LOGISTIK & DISTRIBUSI -->
                        <span class="sidebar-heading" style="text-transform: uppercase;">LOGISTIK & DISTRIBUSI</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="sidebar-item"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                    </div>
                </div>
                <div class="sidebar-separator"></div>
            @endif

            <!-- MANAJEMEN BERITA -->
            @if(in_array(Auth::user()->role, ['operator', 'super_user']))
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
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
<<<<<<< HEAD
            @endif

            <!-- ACCORDION PENGATURAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false">
                <span>Pengaturan Akun</span>
=======
                <div class="sidebar-separator"></div>
            @endif

            <!-- PENGATURAN AKUN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan">
                <span>PENGATURAN AKUN</span>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
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
<<<<<<< HEAD
        </aside>

        <main class="main-content">
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

=======

        </aside>

        <main class="main-content">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">Sumber Air</h1>
                    <p style="color: #64748b; font-size: 14px; margin: 0;">Kelola data ketersediaan hidrant pilar, gedung, embung, dan danau.</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <!-- FITUR SEARCH BAR -->
                    <div class="input-group shadow-sm me-2" style="width: 280px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #cbd5e1;"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari lokasi atau alamat..." style="border-color: #cbd5e1; font-size: 14px;">
                    </div>
                    
                    <button class="btn btn-primary fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none;">
                        <i class="fas fa-plus me-1"></i> Tambah Data
                    </button>
                    
                    <!-- TOMBOL EXCEL BARU -->
                    <a href="/sapra/hidran/cetak-excel" class="btn btn-success fw-bold px-3 shadow-sm" style="background-color: #10b981; border: none;">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </a>

                    <a href="/sapra/hidran/cetak-pdf" class="btn btn-danger fw-bold px-3 shadow-sm" style="background-color: #ef4444; border: none;">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </a>
                </div>
            </div>

            <ul class="nav nav-tabs" id="sapraTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pilar" type="button">Hidrant Pilar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#gedung" type="button">Hidrant Gedung</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#embung" type="button">Embung / Kolam</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#danau" type="button">Danau</button>
                </li>
            </ul>

            <div class="tab-content mt-4">
                
                <!-- TAB HIDRANT PILAR -->
                <div class="tab-pane fade show active" id="pilar">
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="25%" style="text-align: left;">NAMA GEDUNG / LOKASI</th>
                                        <th width="35%" style="text-align: left;">ALAMAT</th>
                                        <th width="15%">KODE MAPS</th>
                                        <th width="10%">JUMLAH</th>
                                        <th width="10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hidranPilar as $item)
                                    <tr class="data-row">
                                        <td class="text-center fw-bold text-dark">{{ $item->no_urut }}</td>
                                        <td class="fw-bold text-dark data-name">{{ $item->nama_gedung }}</td>
                                        <td class="data-address">{{ $item->alamat }}</td>
<<<<<<< HEAD
                                        <td class="text-center fw-medium">{{ $item->kode_maps ?? '-' }}</td>
=======
                                        
                                        <!-- KODE MAPS CLICKABLE -->
                                        <td class="text-center align-middle">
                                            @if($item->kode_maps)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_maps) }}" target="_blank" class="badge bg-light btn-hover text-primary border shadow-sm text-decoration-none px-3 py-2" style="font-size: 12px; transition: 0.2s;">
                                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $item->kode_maps }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                        <td class="text-center"><span class="badge-qty">{{ $item->jumlah ?? '0' }} Unit</span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="/sapra/hidran/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title fw-bold text-dark">Edit Data Hidrant Pilar</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/sapra/hidran/update/{{ $item->id }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kategori Pindah Tab</label>
                                                            <select class="form-select" name="kategori" required>
                                                                <option value="Hidrant Pilar" {{ $item->kategori == 'Hidrant Pilar' ? 'selected' : '' }}>Hidrant Pilar</option>
                                                                <option value="Hidrant Gedung" {{ $item->kategori == 'Hidrant Gedung' ? 'selected' : '' }}>Hidrant Gedung</option>
                                                                <option value="Embung" {{ $item->kategori == 'Embung' ? 'selected' : '' }}>Embung / Kolam</option>
                                                                <option value="Danau" {{ $item->kategori == 'Danau' ? 'selected' : '' }}>Danau</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">No Urut (Otomatis dari Sistem)</label>
                                                            <input type="number" class="form-control bg-light" name="no_urut" value="{{ $item->no_urut }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Nama Gedung / Lokasi</label>
                                                            <input type="text" class="form-control" name="nama_gedung" value="{{ $item->nama_gedung }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Alamat Lengkap</label>
                                                            <textarea class="form-control" name="alamat" rows="2" required>{{ $item->alamat }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kode Maps</label>
                                                            <input type="text" class="form-control" name="kode_maps" value="{{ $item->kode_maps }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label fw-bold small text-primary">Jumlah (Unit)</label>
                                                                <input type="number" class="form-control" name="jumlah" value="{{ $item->jumlah }}">
                                                            </div>
                                                            <div class="col-6 mb-3">
<<<<<<< HEAD
                                                                <label class="form-label fw-bold small text-success">Luas (M²/Ha)</label>
                                                                <input type="text" class="form-control" name="luas" value="{{ $item->luas }}">
=======
                                                                <!-- Hanya Tampilan saja untuk Pilar, tidak relevan -->
                                                                <label class="form-label fw-bold small text-muted">Kapasitas Air</label>
                                                                <input type="text" class="form-control" name="luas" value="{{ $item->luas }}" disabled placeholder="-">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
<<<<<<< HEAD
                                                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
=======
                                                        <button type="button" class="btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="6" class="text-center py-5 text-muted fw-medium">Belum ada data Hidrant Pilar tersimpan.</td></tr>
                                    @endforelse
                                    @if($hidranPilar->count() > 0)
                                    <tr style="background-color: #f1f5f9; border-top: 2px solid #cbd5e1;">
                                        <td colspan="4" class="text-end fw-bold text-dark pe-4">TOTAL KESELURUHAN :</td>
                                        <td class="text-center">
<<<<<<< HEAD
                                            <span class="badge-qty" style="background-color: #2563eb; color: white; border: none; box-shadow: 0 2px 4px rgba(37,99,235,0.2);">
=======
                                            <span class="badge-qty" style="background-color: #0284c7; color: white; border: none; box-shadow: 0 2px 4px rgba(2,132,199,0.2);">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                {{ $hidranPilar->sum('jumlah') }} Unit
                                            </span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB HIDRANT GEDUNG -->
                <div class="tab-pane fade" id="gedung">
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="25%" style="text-align: left;">NAMA GEDUNG</th>
                                        <th width="35%" style="text-align: left;">ALAMAT</th>
                                        <th width="15%">KODE MAPS</th>
                                        <th width="10%">JUMLAH</th>
                                        <th width="10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hidranGedung as $item)
                                    <tr class="data-row">
                                        <td class="text-center fw-bold text-dark">{{ $item->no_urut }}</td>
                                        <td class="fw-bold text-dark data-name">{{ $item->nama_gedung }}</td>
                                        <td class="data-address">{{ $item->alamat }}</td>
<<<<<<< HEAD
                                        <td class="text-center fw-medium">{{ $item->kode_maps ?? '-' }}</td>
=======
                                        
                                        <!-- KODE MAPS CLICKABLE -->
                                        <td class="text-center align-middle">
                                            @if($item->kode_maps)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_maps) }}" target="_blank" class="badge bg-light btn-hover text-primary border shadow-sm text-decoration-none px-3 py-2" style="font-size: 12px; transition: 0.2s;">
                                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $item->kode_maps }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                        <td class="text-center"><span class="badge-qty">{{ $item->jumlah ?? '0' }} Unit</span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditGedung{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="/sapra/hidran/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="modalEditGedung{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title fw-bold text-dark">Edit Data Hidrant Gedung</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/sapra/hidran/update/{{ $item->id }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kategori Pindah Tab</label>
                                                            <select class="form-select" name="kategori" required>
                                                                <option value="Hidrant Pilar" {{ $item->kategori == 'Hidrant Pilar' ? 'selected' : '' }}>Hidrant Pilar</option>
                                                                <option value="Hidrant Gedung" {{ $item->kategori == 'Hidrant Gedung' ? 'selected' : '' }}>Hidrant Gedung</option>
                                                                <option value="Embung" {{ $item->kategori == 'Embung' ? 'selected' : '' }}>Embung / Kolam</option>
                                                                <option value="Danau" {{ $item->kategori == 'Danau' ? 'selected' : '' }}>Danau</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">No Urut (Otomatis dari Sistem)</label>
                                                            <input type="number" class="form-control bg-light" name="no_urut" value="{{ $item->no_urut }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Nama Gedung</label>
                                                            <input type="text" class="form-control" name="nama_gedung" value="{{ $item->nama_gedung }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Alamat Lengkap</label>
                                                            <textarea class="form-control" name="alamat" rows="2" required>{{ $item->alamat }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kode Maps</label>
                                                            <input type="text" class="form-control" name="kode_maps" value="{{ $item->kode_maps }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label fw-bold small text-primary">Jumlah (Unit)</label>
                                                                <input type="number" class="form-control" name="jumlah" value="{{ $item->jumlah }}">
                                                            </div>
                                                            <div class="col-6 mb-3">
<<<<<<< HEAD
                                                                <label class="form-label fw-bold small text-success">Luas (M²/Ha)</label>
                                                                <input type="text" class="form-control" name="luas" value="{{ $item->luas }}">
=======
                                                                <label class="form-label fw-bold small text-muted">Kapasitas Air</label>
                                                                <input type="text" class="form-control" name="luas" value="{{ $item->luas }}" disabled placeholder="-">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="6" class="text-center py-5 text-muted fw-medium">Belum ada data Hidrant Gedung tersimpan.</td></tr>
                                    @endforelse
                                    @if($hidranGedung->count() > 0)
                                    <tr style="background-color: #f1f5f9; border-top: 2px solid #cbd5e1;">
                                        <td colspan="4" class="text-end fw-bold text-dark pe-4">TOTAL KESELURUHAN :</td>
                                        <td class="text-center">
<<<<<<< HEAD
                                            <span class="badge-qty" style="background-color: #2563eb; color: white; border: none; box-shadow: 0 2px 4px rgba(37,99,235,0.2);">
=======
                                            <span class="badge-qty" style="background-color: #0284c7; color: white; border: none; box-shadow: 0 2px 4px rgba(2,132,199,0.2);">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                {{ $hidranGedung->sum('jumlah') }} Unit
                                            </span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
                <!-- TAB EMBUNG -->
=======
                <!-- TAB EMBUNG (Ubah LUAS jadi KAPASITAS AIR) -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <div class="tab-pane fade" id="embung">
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="25%" style="text-align: left;">NAMA LOKASI</th>
                                        <th width="35%" style="text-align: left;">ALAMAT</th>
                                        <th width="15%">KODE MAPS</th>
<<<<<<< HEAD
                                        <th width="10%">LUAS LOKASI</th> 
=======
                                        <th width="10%">KAPASITAS AIR</th> 
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                        <th width="10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($embung as $item)
                                    <tr class="data-row">
                                        <td class="text-center fw-bold text-dark">{{ $item->no_urut }}</td>
                                        <td class="fw-bold text-dark data-name">{{ $item->nama_gedung }}</td>
                                        <td class="data-address">{{ $item->alamat }}</td>
<<<<<<< HEAD
                                        <td class="text-center fw-medium">{{ $item->kode_maps ?? '-' }}</td>
=======
                                        
                                        <!-- KODE MAPS CLICKABLE -->
                                        <td class="text-center align-middle">
                                            @if($item->kode_maps)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_maps) }}" target="_blank" class="badge bg-light btn-hover text-primary border shadow-sm text-decoration-none px-3 py-2" style="font-size: 12px; transition: 0.2s;">
                                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $item->kode_maps }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                        <td class="text-center"><span class="badge-area">{{ $item->luas ?? '-' }}</span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditEmbung{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="/sapra/hidran/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="modalEditEmbung{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title fw-bold text-dark">Edit Data Embung</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/sapra/hidran/update/{{ $item->id }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kategori Pindah Tab</label>
                                                            <select class="form-select" name="kategori" required>
                                                                <option value="Hidrant Pilar" {{ $item->kategori == 'Hidrant Pilar' ? 'selected' : '' }}>Hidrant Pilar</option>
                                                                <option value="Hidrant Gedung" {{ $item->kategori == 'Hidrant Gedung' ? 'selected' : '' }}>Hidrant Gedung</option>
                                                                <option value="Embung" {{ $item->kategori == 'Embung' ? 'selected' : '' }}>Embung / Kolam</option>
                                                                <option value="Danau" {{ $item->kategori == 'Danau' ? 'selected' : '' }}>Danau</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">No Urut (Otomatis dari Sistem)</label>
                                                            <input type="number" class="form-control bg-light" name="no_urut" value="{{ $item->no_urut }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Nama Lokasi</label>
                                                            <input type="text" class="form-control" name="nama_gedung" value="{{ $item->nama_gedung }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Alamat Lengkap</label>
                                                            <textarea class="form-control" name="alamat" rows="2" required>{{ $item->alamat }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kode Maps</label>
                                                            <input type="text" class="form-control" name="kode_maps" value="{{ $item->kode_maps }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
<<<<<<< HEAD
                                                                <label class="form-label fw-bold small text-primary">Jumlah (Unit)</label>
                                                                <input type="number" class="form-control" name="jumlah" value="{{ $item->jumlah }}">
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label fw-bold small text-success">Luas (M²/Ha)</label>
=======
                                                                <label class="form-label fw-bold small text-muted">Jumlah (Unit)</label>
                                                                <input type="number" class="form-control" name="jumlah" value="{{ $item->jumlah }}" disabled placeholder="-">
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label fw-bold small text-success">Kapasitas Air (Liter/m³)</label>
                                                                <!-- Tetap name="luas" agar db tidak error -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                                <input type="text" class="form-control" name="luas" value="{{ $item->luas }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="6" class="text-center py-5 text-muted fw-medium">Belum ada data Embung tersimpan.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
                <!-- TAB DANAU -->
=======
                <!-- TAB DANAU (Ubah LUAS jadi KAPASITAS AIR) -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <div class="tab-pane fade" id="danau">
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="25%" style="text-align: left;">NAMA DANAU</th>
                                        <th width="35%" style="text-align: left;">ALAMAT</th>
                                        <th width="15%">KODE MAPS</th>
<<<<<<< HEAD
                                        <th width="10%">LUAS AREA</th>
=======
                                        <th width="10%">KAPASITAS AIR</th>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                        <th width="10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($danau as $item)
                                    <tr class="data-row">
                                        <td class="text-center fw-bold text-dark">{{ $item->no_urut }}</td>
                                        <td class="fw-bold text-dark data-name">{{ $item->nama_gedung }}</td>
                                        <td class="data-address">{{ $item->alamat }}</td>
<<<<<<< HEAD
                                        <td class="text-center fw-medium">{{ $item->kode_maps ?? '-' }}</td>
=======
                                        
                                        <!-- KODE MAPS CLICKABLE -->
                                        <td class="text-center align-middle">
                                            @if($item->kode_maps)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_maps) }}" target="_blank" class="badge bg-light btn-hover text-primary border shadow-sm text-decoration-none px-3 py-2" style="font-size: 12px; transition: 0.2s;">
                                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $item->kode_maps }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                        <td class="text-center"><span class="badge-area">{{ $item->luas ?? '-' }}</span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditDanau{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="/sapra/hidran/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- MODAL EDIT -->
                                    <div class="modal fade" id="modalEditDanau{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title fw-bold text-dark">Edit Data Danau</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/sapra/hidran/update/{{ $item->id }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kategori Pindah Tab</label>
                                                            <select class="form-select" name="kategori" required>
                                                                <option value="Hidrant Pilar" {{ $item->kategori == 'Hidrant Pilar' ? 'selected' : '' }}>Hidrant Pilar</option>
                                                                <option value="Hidrant Gedung" {{ $item->kategori == 'Hidrant Gedung' ? 'selected' : '' }}>Hidrant Gedung</option>
                                                                <option value="Embung" {{ $item->kategori == 'Embung' ? 'selected' : '' }}>Embung / Kolam</option>
                                                                <option value="Danau" {{ $item->kategori == 'Danau' ? 'selected' : '' }}>Danau</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">No Urut (Otomatis dari Sistem)</label>
                                                            <input type="number" class="form-control bg-light" name="no_urut" value="{{ $item->no_urut }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Nama Danau</label>
                                                            <input type="text" class="form-control" name="nama_gedung" value="{{ $item->nama_gedung }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Alamat Lengkap</label>
                                                            <textarea class="form-control" name="alamat" rows="2" required>{{ $item->alamat }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Kode Maps</label>
                                                            <input type="text" class="form-control" name="kode_maps" value="{{ $item->kode_maps }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
<<<<<<< HEAD
                                                                <label class="form-label fw-bold small text-primary">Jumlah (Unit)</label>
                                                                <input type="number" class="form-control" name="jumlah" value="{{ $item->jumlah }}">
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label fw-bold small text-success">Luas (M²/Ha)</label>
=======
                                                                <label class="form-label fw-bold small text-muted">Jumlah (Unit)</label>
                                                                <input type="number" class="form-control" name="jumlah" value="{{ $item->jumlah }}" disabled placeholder="-">
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label fw-bold small text-success">Kapasitas Air (Liter/m³)</label>
                                                                <!-- Tetap name="luas" agar db tidak error -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                                <input type="text" class="form-control" name="luas" value="{{ $item->luas }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="6" class="text-center py-5 text-muted fw-medium">Belum ada data Danau tersimpan.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH DATA (Global) -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold text-dark">Tambah Data Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/sapra/hidran/store" method="POST">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Pilih Kategori Tab</label>
<<<<<<< HEAD
                            <select class="form-select" name="kategori" required>
=======
                            <select class="form-select" name="kategori" id="pilihKategoriTambah" required>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Hidrant Pilar">Hidrant Pilar</option>
                                <option value="Hidrant Gedung">Hidrant Gedung</option>
                                <option value="Embung">Embung / Kolam</option>
                                <option value="Danau">Danau</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nama Gedung / Lokasi</label>
                            <input type="text" class="form-control" name="nama_gedung" placeholder="Masukkan nama..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan alamat..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Kode Maps</label>
                            <input type="text" class="form-control" name="kode_maps" placeholder="Cth: 9HM5+6X">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
<<<<<<< HEAD
                                <label class="form-label fw-bold small text-primary">Jumlah (Untuk Hidrant)</label>
                                <input type="number" class="form-control" name="jumlah" placeholder="Cth: 5">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-success">Luas (Danau/Embung)</label>
                                <input type="text" class="form-control" name="luas" placeholder="Cth: 15 Hektar">
=======
                                <label class="form-label fw-bold small text-primary" id="labelTambahJumlah">Jumlah (Untuk Hidrant)</label>
                                <input type="number" class="form-control" name="jumlah" id="inputTambahJumlah" placeholder="Cth: 5">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-success" id="labelTambahLuas">Kapasitas Air (Embung/Danau)</label>
                                <input type="text" class="form-control" name="luas" id="inputTambahLuas" placeholder="Cth: 50.000 Liter">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <!-- JAVASCRIPT UNTUK SEARCH BAR -->
=======
    <!-- JAVASCRIPT UNTUK SEARCH BAR & LOGIKA FORM TAMBAH -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.data-row');
            
            rows.forEach(row => {
                let nama = row.querySelector('.data-name').textContent.toLowerCase();
                let alamat = row.querySelector('.data-address').textContent.toLowerCase();
                
                if(nama.includes(filter) || alamat.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
<<<<<<< HEAD
=======

        // Script untuk mengatur disable/enable input di modal Tambah berdasarkan kategori
        document.getElementById('pilihKategoriTambah').addEventListener('change', function() {
            let kategori = this.value;
            let inputJumlah = document.getElementById('inputTambahJumlah');
            let inputLuas = document.getElementById('inputTambahLuas');
            
            if (kategori === 'Hidrant Pilar' || kategori === 'Hidrant Gedung') {
                inputJumlah.disabled = false;
                inputLuas.disabled = true;
                inputLuas.value = '';
            } else if (kategori === 'Embung' || kategori === 'Danau') {
                inputJumlah.disabled = true;
                inputJumlah.value = '';
                inputLuas.disabled = false;
            } else {
                inputJumlah.disabled = false;
                inputLuas.disabled = false;
            }
        });
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>