<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Data - SIMERAH KOJA</title>
<<<<<<< HEAD

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Library html2pdf.js untuk langsung Download PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
=======
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

<<<<<<< HEAD
        /* --- NAVBAR & SIDEBAR (Bawaan) --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }

        /* --- STYLING HALAMAN DETAIL --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .back-link { color: #6b7280; font-size: 14px; text-decoration: none; font-weight: 600; transition: color 0.2s; display: inline-flex; align-items: center; margin-bottom: 10px; }
        .back-link:hover { color: #111827; }
        .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 30px; }

        .detail-card { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 30px 40px; margin-bottom: 30px; }
        
        .section-header { display: flex; align-items: center; gap: 12px; margin-bottom: 25px; }
        .section-header::before { content: ''; width: 4px; height: 22px; background-color: #3b82f6; border-radius: 4px; }
        .section-header h3 { font-size: 18px; font-weight: 800; margin: 0; color: #111827; }

        .info-row { display: flex; margin-bottom: 16px; align-items: flex-start; }
        .info-label { width: 250px; color: #4b5563; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 12px; }
        .info-label i { color: #3b82f6; font-size: 16px; width: 20px; text-align: center; }
        .info-value { flex: 1; color: #1f2937; font-weight: 500; font-size: 14px; }
        
        .btn-action-bottom { border-radius: 6px; font-weight: 700; font-size: 14px; padding: 10px 24px; transition: all 0.2s; border: none; }
        .btn-edit { background-color: #fbbf24; color: #92400e; }
        .btn-edit:hover { background-color: #f59e0b; color: white; }

        /* --- DROPDOWN HOVER KUSTOM --- */
        .dropdown-menu { padding: 8px; border-radius: 10px; }
        .dropdown-item { border-radius: 6px; transition: all 0.2s ease-in-out; }
        .dropdown-item:hover, .dropdown-item:focus { background-color: #e0f2fe !important; }

        /* Sembunyikan elemen ini saat nge-print agar rapi */
        @media print {
            .navbar-internal, .sidebar, .btn-action-bottom, .back-link, .d-print-none { display: none !important; }
            .main-content { padding: 0; background-color: white; }
            .detail-card { box-shadow: none; border: 1px solid #e5e7eb; padding: 20px; }
=======
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
        .back-link { color: #6b7280; font-size: 14px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; margin-bottom: 10px; }
        .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 30px; }

        .detail-card { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 40px 50px; margin-bottom: 30px; }
        
        .section-header { clear: both; display: flex; align-items: center; gap: 12px; margin-bottom: 12px; margin-top: 25px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb; page-break-after: avoid; page-break-inside: avoid; }
        .section-header::before { content: ''; width: 4px; height: 18px; background-color: #3b82f6; border-radius: 4px; }
        .section-header h3 { font-size: 16px; font-weight: 800; margin: 0; color: #111827; text-transform: uppercase; }

        /* --- PERBAIKAN SISTEM GRID PDF (ANTI TERPOTONG HORIZONTAL) --- */
        .pdf-grid { display: block; width: 100%; margin-bottom: 15px; } 
        .pdf-grid::after { content: ""; display: table; clear: both; } /* Clear float */
        
        .pdf-item { float: left; width: 49%; padding-right: 15px; margin-bottom: 10px; box-sizing: border-box; page-break-inside: avoid; }
        .pdf-item-full { clear: both; display: block; width: 100%; margin-bottom: 10px; box-sizing: border-box; page-break-inside: avoid; }
        
        /* Pengganti Table Menjadi Flex Div murni */
        .data-row { display: flex; align-items: flex-start; page-break-inside: avoid; break-inside: avoid; width: 100%; }
        .data-icon { width: 22px; color: #0284c7; flex-shrink: 0; font-size: 13px; margin-top: 1px; }
        .data-label { width: 135px; font-weight: 700; color: #4b5563; flex-shrink: 0; font-size: 12px; line-height: 1.4; }
        .data-colon { width: 12px; font-weight: 700; color: #4b5563; text-align: center; flex-shrink: 0; font-size: 12px; line-height: 1.4; }
        .data-value { flex-grow: 1; font-weight: 600; color: #1f2937; font-size: 12px; word-break: break-word; line-height: 1.4; }
        
        .sub-header { clear: both; display: block; width: 100%; font-size: 14px; font-weight: 700; color: #0284c7; margin-top: 20px; margin-bottom: 10px; page-break-after: avoid; page-break-inside: avoid; }
        .text-capitalize { text-transform: capitalize; }
        .text-uppercase { text-transform: uppercase; }

        .btn-action-bottom { border-radius: 6px; font-weight: 700; font-size: 14px; padding: 10px 24px; border: none; }
        .btn-edit { background-color: #fbbf24; color: #92400e; text-decoration: none; }

        @media print {
            .navbar-internal, .sidebar, .btn-action-bottom, .back-link, .d-print-none { display: none !important; }
            body, .main-content { background-color: white !important; }
            .detail-card { box-shadow: none !important; border: none !important; padding: 0 !important; margin: 0 !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
        }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
<<<<<<< HEAD
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
                </span>
=======
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
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
<<<<<<< HEAD
        <!-- SIDEBAR (Dipersingkat untuk contoh) -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
            <a href="/internal/damtan/data-laporan" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="main-content">
            <a href="/internal/damtan/data-laporan" class="back-link"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <h1 class="page-title">Rincian Data Penyelamatan</h1>

            <!-- ID report-content digunakan untuk sasaran HTML2PDF -->
            <div class="detail-card" id="report-content">
                
                <!-- Kop laporan (hanya muncul saat di-download jadi PDF) -->
                <div id="pdf-header" style="display: none; text-align: center; margin-bottom: 30px; border-bottom: 2px solid #111827; padding-bottom: 10px;">
                    <h2 style="margin: 0; font-weight: bold; color: #111827;">RINCIAN DATA PENYELAMATAN</h2>
                    <p style="margin: 0; font-size: 14px; color: #4b5563;">Sistem Informasi Manajemen Pemadam Kebakaran & Penyelamatan (SIMERAH KOJA)</p>
                </div>

                <!-- Section 1 -->
                <div class="section-header"><h3>Informasi Objek Laporan</h3></div>
                
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-hashtag"></i> Nomor Laporan</div>
                    <div class="info-value">: {{ $laporan->nomor_laporan }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="far fa-calendar-alt"></i> Tanggal Kejadian</div>
                    <div class="info-value">: {{ $laporan->waktu_kejadian ? \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('d F Y') : '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="far fa-clock"></i> Waktu / Jam</div>
                    <div class="info-value">: {{ $laporan->waktu_kejadian ? \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('H:i') : '-' }} WIB</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-exclamation-triangle"></i> Kategori Kejadian</div>
                    <div class="info-value" style="text-transform: capitalize;">: {{ str_replace('_', ' ', $laporan->kategori_kejadian ?? '-') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap</div>
                    <div class="info-value">: {{ $laporan->alamat ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-thumbtack"></i> Koordinat Lokasi</div>
                    <div class="info-value">: {{ $laporan->koordinat ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-layer-group"></i> Tingkat Prioritas</div>
                    <div class="info-value" style="text-transform: capitalize;">: {{ $laporan->prioritas ?? 'Biasa' }}</div>
                </div>

                <!-- Section 2 -->
                <div class="section-header mt-5"><h3>Detail Teknis & Evakuasi</h3></div>

                <div class="info-row">
                    <div class="info-label"><i class="fas fa-shield-alt"></i> Status Evakuasi</div>
                    <div class="info-value" style="text-transform: capitalize;">: {{ $teknis->status_evakuasi ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-users"></i> Jumlah Personel Terlibat</div>
                    <div class="info-value">: {{ $teknis->jumlah_personel ?? '0' }} Orang</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-clipboard-list"></i> Hambatan Lapangan</div>
                    <div class="info-value">: {{ $teknis->hambatan_lapangan ?? 'Tidak ada hambatan.' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-paw"></i> Objek Hewan / Aset</div>
                    <div class="info-value">: {{ $teknis->korban_hewan_aset ?? '-' }}</div>
                </div>

                <!-- Action Buttons (Sejajar di Kanan Bawah) -->
                <!-- PERBAIKAN: data-html2canvas-ignore="true" ditambahkan di sini agar tombol 100% dihilangkan dari PDF -->
                <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top d-print-none" id="action-buttons-container" data-html2canvas-ignore="true">
                    
                    <!-- Tombol Dropdown Download -->
=======
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar d-print-none" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                
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

                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <button class="sidebar-collapse-btn {{ Request::is('sapra*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="{{ Request::is('sapra*') ? 'true' : 'false' }}">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('sapra*') ? 'show' : '' }}" id="collapseSapra" data-bs-parent="#sidebarAccordion">
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

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
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
            <a href="/internal/damtan/data-laporan" class="back-link d-print-none"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <h1 class="page-title d-print-none">Rincian Laporan Tervalidasi</h1>

            <div class="detail-card" id="report-content">
                
                <div id="pdf-header" style="display: none; text-align: center; margin-bottom: 25px; border-bottom: 3px double #111827; padding-bottom: 15px;">
                    <h2 style="margin: 0; font-weight: 800; color: #111827; font-size: 22px;">LAPORAN DATA PENYELAMATAN & KEBAKARAN</h2>
                    <p style="margin: 5px 0 0 0; font-size: 13px; font-weight: 600; color: #4b5563;">Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
                </div>

                <!-- TAB 1: INFORMASI DASAR -->
                <div class="section-header" style="margin-top: 0;"><h3>I. Informasi Dasar & Lokasi</h3></div>
                
                <div class="pdf-grid">
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hashtag"></i></div>
                            <div class="data-label">Nomor Laporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->nomor_laporan }}</div>
                        </div>
                    </div>

                    @if(!empty($laporan->kategori_kejadian))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-layer-group"></i></div>
                            <div class="data-label">Kategori Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->kategori_kejadian) }}</div>
                        </div>
                    </div>
                    @endif

                    @php $kategori_sub = $laporan->kategori_kebakaran ?? $laporan->kategori_non_kebakaran; @endphp
                    @if(!empty($kategori_sub))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire"></i></div>
                            <div class="data-label">Sub-Kategori</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $kategori_sub) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->rincian_kategori_non_kebakaran))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Rincian Kategori</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->rincian_kategori_non_kebakaran }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->prioritas))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-circle"></i></div>
                            <div class="data-label">Tingkat Prioritas</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ $laporan->prioritas }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->nama_pelapor))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user"></i></div>
                            <div class="data-label">Nama Pelapor</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->nama_pelapor }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->media_pelaporan))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-headset"></i></div>
                            <div class="data-label">Media Pelaporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->media_pelaporan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->alamat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-map-signs"></i></div>
                            <div class="data-label">Alamat Kejadian</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->alamat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->koordinat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-location-arrow"></i></div>
                            <div class="data-label">Titik Koordinat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->koordinat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->jarak_tempuh) && $laporan->jarak_tempuh > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Jarak Tempuh</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->jarak_tempuh }} Km</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Data Waktu Operasional</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->waktu_kejadian))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="data-label">Waktu Kejadian</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_terima))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clock"></i></div>
                            <div class="data-label">Terima Laporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_terima)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_berangkat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck-moving"></i></div>
                            <div class="data-label">Berangkat Unit</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_berangkat)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_tiba))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="data-label">Tiba di Lokasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_tiba)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_selesai))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-flag-checkered"></i></div>
                            <div class="data-label">Operasi Selesai</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_selesai)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_kembali))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Kembali ke Mako</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_kembali)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- TAB 2: TEKNIS & LOGISTIK -->
                <div class="section-header"><h3>II. Teknis Penyelamatan & Logistik Operasi</h3></div>

                <div class="pdf-grid">
                    @if(!empty($teknis->pimpinan_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="data-label">Pimpinan Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->pimpinan_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    <!-- TAMBAHAN: Pendamping Operasi -->
                    @if(!empty($teknis->pendamping_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-friends"></i></div>
                            <div class="data-label">Pendamping Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->pendamping_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->satuan_tugas))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users-cog"></i></div>
                            <div class="data-label">Satuan Tugas / Regu</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->satuan_tugas }}</div>
                        </div>
                    </div>
                    @endif

                    <!-- TAMBAHAN: Tim Respon Time -->
                    @if(!empty($teknis->tim_respontime))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-stopwatch"></i></div>
                            <div class="data-label">Tim Respon Time</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->tim_respontime }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->status_evakuasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Status Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $teknis->status_evakuasi) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($teknis->metode_evakuasi)))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Metode Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $teknis->metode_evakuasi) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($teknis->metode_penyelamatan)))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Met. Penyelamatan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $teknis->metode_penyelamatan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->objek_terdampak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                            <div class="data-label">Objek Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->objek_terdampak }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($teknis->jumlah_personel) && $teknis->jumlah_personel > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users"></i></div>
                            <div class="data-label">Jumlah Anggota</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->jumlah_personel }} Personel</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->daftar_personel))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-tag"></i></div>
                            <div class="data-label">Anggota Terlibat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->daftar_personel }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                @if(
                    (!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0) ||
                    (!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0) ||
                    (!empty($teknis->korban_berat) && $teknis->korban_berat > 0) ||
                    (!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0) ||
                    !empty($teknis->korban_hewan_aset)
                )
                <div class="sub-header">Data Korban & Aset</div>
                <div class="pdf-grid">
                    @if(!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-check"></i></div>
                            <div class="data-label">Korban Selamat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_selamat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-injured"></i></div>
                            <div class="data-label">Korban Luka Ringan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_ringan }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_berat) && $teknis->korban_berat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-procedures"></i></div>
                            <div class="data-label">Korban Luka Berat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_berat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-times"></i></div>
                            <div class="data-label">Korban Meninggal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-danger">{{ $teknis->korban_meninggal }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_hewan_aset))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-cat"></i></div>
                            <div class="data-label">Korban Hewan/Aset</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_hewan_aset }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <div class="sub-header">Alat & Logistik Terpakai</div>
                <div class="pdf-grid">
                    @if(!empty(json_decode($teknis->armada)))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck"></i></div>
                            <div class="data-label">Armada Diturunkan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace(['"', '[', ']'], '', $teknis->armada) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($teknis->peralatan)))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-toolbox"></i></div>
                            <div class="data-label">Peralatan Khusus</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ str_replace(['"', '[', ']'], '', $teknis->peralatan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->peralatan_lain))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tools"></i></div>
                            <div class="data-label">Peralatan Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->peralatan_lain }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_air) && $teknis->liter_air > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tint"></i></div>
                            <div class="data-label">Konsumsi Air</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_air }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_foam) && $teknis->liter_foam > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-soap"></i></div>
                            <div class="data-label">Konsumsi Foam</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_foam }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_bbm) && $teknis->liter_bbm > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-gas-pump"></i></div>
                            <div class="data-label">Konsumsi BBM</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_bbm }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->konsumsi_alat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-spray-can"></i></div>
                            <div class="data-label">Konsumsi Alat Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->konsumsi_alat }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- TAB 3: DOKUMENTASI & EVALUASI -->
                <div class="section-header" style="margin-top: 20px;"><h3>III. Analisis, Evaluasi & Dokumentasi Kejadian</h3></div>

                <div class="pdf-grid">
                    @if(!empty($teknis->langkah_penanganan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tasks"></i></div>
                            <div class="data-label">Langkah Penanganan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->langkah_penanganan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->hambatan_lapangan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="data-label">Hambatan Lapangan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->hambatan_lapangan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->hasil_tindakan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-check-double"></i></div>
                            <div class="data-label">Hasil Tindakan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->hasil_tindakan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->kronologi_lengkap))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-align-left"></i></div>
                            <div class="data-label">Kronologi Lengkap</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kronologi_lengkap }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Investigasi Lapangan</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->dugaan_penyebab))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-bolt"></i></div>
                            <div class="data-label">Dugaan Penyebab</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $dokumentasi->dugaan_penyebab) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->dugaan_penyebab_lainnya))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-search"></i></div>
                            <div class="data-label">Penyebab Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->dugaan_penyebab_lainnya }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->sumber_api))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire-alt"></i></div>
                            <div class="data-label">Sumber Api / Awal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->sumber_api }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->luas_area) && $dokumentasi->luas_area > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-ruler-combined"></i></div>
                            <div class="data-label">Luas Area Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->luas_area }} m²</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($dokumentasi->instansi_pendukung)))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Instansi Pendukung</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-uppercase">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $dokumentasi->instansi_pendukung) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->tindakan_instansi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Tindakan Instansi Lain</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->tindakan_instansi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->kontak_saksi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="data-label">Kontak Saksi/Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kontak_saksi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->cara_bertindak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div class="data-label">Cara Bertindak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->cara_bertindak }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                @if(!empty($dokumentasi->kebutuhan_tambahan) || !empty($dokumentasi->saran_mitigasi))
                <div class="sub-header">Evaluasi Pasca Operasi</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->kebutuhan_tambahan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-plus-circle"></i></div>
                            <div class="data-label">Kebutuhan Tambahan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kebutuhan_tambahan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->saran_mitigasi))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-lightbulb"></i></div>
                            <div class="data-label">Saran Mitigasi Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->saran_mitigasi }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- TAB 4: KATEGORI KHUSUS -->
                @if(!empty($khusus->jenis_hewan) || !empty($khusus->jenis_objek_tumbang) || !empty($khusus->kondisi_perairan) || !empty($khusus->jenis_benda_bahaya))
                <div class="section-header"><h3>IV. Rincian Modul Kategori Khusus</h3></div>

                    @if(!empty($khusus->jenis_hewan))
                    <div class="sub-header"><i class="fas fa-paw me-2"></i>Data Animal Rescue</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-paw"></i></div>
                                <div class="data-label">Jenis Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ $khusus->jenis_hewan }}</div>
                            </div>
                        </div>
                        
                        @if(!empty($khusus->spesies_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-tag"></i></div>
                                <div class="data-label">Spesies / Lokal</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->spesies_hewan }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dimensi_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ruler"></i></div>
                                <div class="data-label">Dimensi / Panjang</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dimensi_hewan }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($khusus->berat_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-balance-scale"></i></div>
                                <div class="data-label">Berat Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->berat_hewan }} Kg</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->status_hewan_pasca))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-share-square"></i></div>
                                <div class="data-label">Status Evakuasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_hewan_pasca) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->lokasi_pelepasan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="data-label">Lokasi Pelepasan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->lokasi_pelepasan }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($khusus->jenis_objek_tumbang))
                    <div class="sub-header"><i class="fas fa-tree me-2"></i>Data Objek Tumbang/Bangunan</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cube"></i></div>
                                <div class="data-label">Jenis Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_objek_tumbang) }}</div>
                            </div>
                        </div>

                        @if(!empty($khusus->dimensi_objek))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                                <div class="data-label">Dimensi Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dimensi_objek }} cm</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->status_utilitas))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-plug"></i></div>
                                <div class="data-label">Utilitas Terkait</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_utilitas) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dampak_properti))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                                <div class="data-label">Dampak Properti</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dampak_properti }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($khusus->kondisi_perairan))
                    <div class="sub-header"><i class="fas fa-water me-2"></i>Data Water Rescue</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-water"></i></div>
                                <div class="data-label">Kondisi Perairan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_perairan) }}</div>
                            </div>
                        </div>

                        @if(!empty($khusus->radius_pencarian))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-search-location"></i></div>
                                <div class="data-label">Radius Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->radius_pencarian }} meter</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->metode_pencarian_air))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-binoculars"></i></div>
                                <div class="data-label">Metode Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->metode_pencarian_air) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->daftar_penyelam))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-swimmer"></i></div>
                                <div class="data-label">Daftar Penyelam</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->daftar_penyelam }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($khusus->jenis_benda_bahaya) || !empty($khusus->jenis_medan))
                    <div class="sub-header"><i class="fas fa-ring me-2"></i>Data Pelepasan Cincin & Geografis Lapangan</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_benda_bahaya))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ring"></i></div>
                                <div class="data-label">Jenis Benda</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->jenis_benda_bahaya }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->kondisi_anggota_tubuh))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-hand-paper"></i></div>
                                <div class="data-label">Kondisi Tubuh</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_anggota_tubuh) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->alat_potong_cincin))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cut"></i></div>
                                <div class="data-label">Alat Potong</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->alat_potong_cincin) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->cuaca_operasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="data-label">Cuaca Operasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->cuaca_operasi) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->jenis_medan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-mountain"></i></div>
                                <div class="data-label">Jenis Medan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_medan) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->akses_lokasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-road"></i></div>
                                <div class="data-label">Akses Lokasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->akses_lokasi) }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                @endif

                <!-- TAB 5: DOKUMENTASI FOTO & VIDEO -->
                @if((!empty($dokumentasi->foto) && $dokumentasi->foto !== 'null' && $dokumentasi->foto !== '[]') || !empty($dokumentasi->video))
                <div class="section-header" style="page-break-before: always;"><h3>V. Dokumentasi Lapangan</h3></div>
                
                @if(!empty($dokumentasi->foto) && $dokumentasi->foto !== 'null' && $dokumentasi->foto !== '[]')
                    @php $fotos = json_decode($dokumentasi->foto, true); @endphp
                    @if(is_array($fotos) && count($fotos) > 0)
                    <div class="sub-header"><i class="fas fa-camera me-2"></i>Lampiran Foto</div>
                    <div style="display: block; width: 100%; margin-bottom: 20px;">
                        @foreach($fotos as $foto)
                            <img src="{{ asset('uploads/damtan/foto/' . $foto) }}" style="display: inline-block; width: 48%; height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; margin-right: 1%; margin-bottom: 10px;">
                        @endforeach
                    </div>
                    @endif
                @endif

                @if(!empty($dokumentasi->video))
                    <div class="sub-header"><i class="fas fa-video me-2"></i>Lampiran Video</div>
                    <div class="pdf-grid">
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-file-video"></i></div>
                                <div class="data-label">File Terlampir</div>
                                <div class="data-colon">:</div>
                                <div class="data-value"><a href="{{ asset('uploads/damtan/video/' . $dokumentasi->video) }}" target="_blank" style="color: #0284c7; text-decoration: none;">{{ $dokumentasi->video }} <small>(Klik untuk memutar di browser)</small></a></div>
                            </div>
                        </div>
                    </div>
                @endif
                @endif

                <!-- KESIMPULAN -->
                <div class="section-header" style="page-break-before: auto;"><h3>Kesimpulan & Dasar Pelaksanaan</h3></div>
                <div style="font-weight: 600; font-style: italic; color: #4b5563; font-size: 12px; line-height: 1.5; margin-left: 20px; page-break-inside: avoid;">
                    Seluruh kegiatan Pelayanan Penyelamatan dan Pemadaman ini berpedoman pada Peraturan Menteri Dalam Negeri (Permendagri) Nomor 114 Tahun 2018 tentang Standar Teknis Pelayanan Dasar Pada Standar Pelayanan Minimal (SPM) Sub Urusan Kebakaran Daerah Kabupaten/Kota.
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top d-print-none" id="action-buttons-container" data-html2canvas-ignore="true">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                    <div class="dropdown">
                        <button class="btn btn-action-bottom shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #0284c7; color: white; border: none;">
                            <i class="fas fa-download me-2"></i> Download Laporan
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="#" onclick="downloadDetailPDF()"><i class="fas fa-file-pdf me-2"></i> Format PDF</a></li>
                            <li><a class="dropdown-item py-2 text-success fw-bold" href="#" onclick="downloadDetailExcel()"><i class="fas fa-file-excel me-2"></i> Format Excel</a></li>
                            <li><a class="dropdown-item py-2 text-primary fw-bold" href="#" onclick="downloadDetailWord()"><i class="fas fa-file-word me-2"></i> Format Word</a></li>
                        </ul>
                    </div>
<<<<<<< HEAD

                    <!-- Tombol Edit -->
=======
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                    <a href="/internal/damtan/edit-data/{{ $laporan->id }}" class="btn btn-action-bottom btn-edit shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Data Ini
                    </a>
                </div>
            </div>
<<<<<<< HEAD

        </main>
    </div>

    <!-- Script Bootstrap & Download File Explorer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        // --- 1. FUNGSI DOWNLOAD PDF (Langsung via html2pdf) ---
        function downloadDetailPDF() {
            // Targetkan kotak detail card
            const element = document.getElementById('report-content');
            const pdfHeader = document.getElementById('pdf-header');
            
            // Tampilkan judul kop laporan khusus PDF
            pdfHeader.style.display = 'block'; 

            // Pengaturan PDF
            let nomorLaporan = "{{ $laporan->nomor_laporan }}";
            let filename = "Detail_Laporan_" + nomorLaporan + ".pdf";

            const opt = {
                margin:       15,
                filename:     filename,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Proses pemuatan PDF
            html2pdf().set(opt).from(element).save().then(() => {
                // Sembunyikan kop surat lagi setelah PDF berhasil didownload
                pdfHeader.style.display = 'none';
            });
        }


        // --- 2. FUNGSI DOWNLOAD EXCEL (CSV) ---
        function downloadDetailExcel() {
            let csvContent = "Atribut Informasi;Nilai / Data\n"; 
            let rows = document.querySelectorAll('.info-row');
            
            rows.forEach(row => {
                let label = row.querySelector('.info-label').innerText.trim();
                let value = row.querySelector('.info-value').innerText.trim();
                if(value.startsWith(':')) value = value.substring(1).trim();
                csvContent += '"' + label + '";"' + value + '"\n';
            });

            let filename = "Detail_Laporan_{{ $laporan->nomor_laporan }}.csv";
            let blob = new Blob(["\uFEFF" + csvContent], { type: "text/csv;charset=utf-8;" });
=======
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function downloadDetailPDF() {
            window.scrollTo(0, 0);

            const element = document.getElementById('report-content');
            const pdfHeader = document.getElementById('pdf-header');
            const btnContainer = document.getElementById('action-buttons-container');
            const nav = document.querySelector('.navbar-internal');
            const sidebar = document.querySelector('.sidebar');

            pdfHeader.style.display = 'block'; 
            btnContainer.style.display = 'none';
            if(nav) nav.style.display = 'none';
            if(sidebar) sidebar.style.display = 'none';

            const originalPadding = element.style.padding;
            const originalMargin = element.style.margin;
            const originalShadow = element.style.boxShadow;
            element.style.padding = '10px 20px';
            element.style.margin = '0px';
            element.style.boxShadow = 'none';

            let nomorLaporan = "{{ $laporan->nomor_laporan }}";
            let filename = "Laporan_Penyelamatan_Lengkap_" + nomorLaporan + ".pdf";

            const opt = {
                margin:       [15, 10, 15, 10], 
                filename:     filename,
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true, scrollY: 0 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                /* Konfigurasi ketat agar blok div tidak dipotong paksa oleh page break */
                pagebreak:    { mode: ['css', 'legacy'], avoid: ['.pdf-item', '.pdf-item-full', '.section-header', '.sub-header', '.data-row'] } 
            };

            setTimeout(() => {
                html2pdf().set(opt).from(element).save().then(() => {
                    pdfHeader.style.display = 'none';
                    btnContainer.style.display = 'flex';
                    if(nav) nav.style.display = 'flex';
                    if(sidebar) sidebar.style.display = 'flex';
                    element.style.padding = originalPadding;
                    element.style.margin = originalMargin;
                    element.style.boxShadow = originalShadow;
                });
            }, 500); 
        }

        function downloadDetailExcel() {
            let tableHTML = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            tableHTML += '<head><meta charset="utf-8"></head><body>';
            tableHTML += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-family: Arial, sans-serif;">';
            
            tableHTML += '<tr><th colspan="2" style="background-color: #111827; color: #ffffff; font-size: 16px; height: 30px; text-align: center;">LAPORAN DATA PENYELAMATAN & KEBAKARAN</th></tr>';
            tableHTML += '<tr><th colspan="2" style="background-color: #10b981; color: #ffffff; height: 25px; text-align: center;">Nomor Laporan: {{ $laporan->nomor_laporan }}</th></tr>';
            
            tableHTML += '<tr>';
            tableHTML += '<th style="background-color: #f3f4f6; width: 200px; text-align: left;">Atribut Informasi</th>';
            tableHTML += '<th style="background-color: #f3f4f6; width: 400px; text-align: left;">Nilai / Data Laporan</th>';
            tableHTML += '</tr>';
            
            let rows = document.querySelectorAll('.data-row');
            
            rows.forEach(row => {
                let labelEl = row.querySelector('.data-label');
                let valueEl = row.querySelector('.data-value');
                if(labelEl && valueEl) {
                    let label = labelEl.innerText.trim();
                    let value = valueEl.innerText.trim();
                    if(label && value) {
                        tableHTML += `<tr><td style="font-weight: bold;">${label}</td><td>${value}</td></tr>`;
                    }
                }
            });

            tableHTML += '</table></body></html>';

            let filename = "Laporan_Penyelamatan_Lengkap_{{ $laporan->nomor_laporan }}.xls";
            let blob = new Blob([tableHTML], { type: "application/vnd.ms-excel" });
            
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

<<<<<<< HEAD

        // --- 3. FUNGSI DOWNLOAD WORD (.DOC) ---
        function downloadDetailWord() {
            let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
                         "xmlns:w='urn:schemas-microsoft-com:office:word' " +
                         "xmlns='http://www.w3.org/TR/REC-html40'>" +
                         "<head><meta charset='utf-8'><title>Rincian Laporan</title></head><body style='font-family: Arial, sans-serif;'>";
            
            let footer = "</body></html>";
            let content = "<h2 style='text-align:center;'>Rincian Data Penyelamatan</h2>";
            content += "<h4 style='text-align:center;'>Nomor Laporan: {{ $laporan->nomor_laporan }}</h4><hr><ul style='list-style-type: none; padding: 0;'>";
            
            let rows = document.querySelectorAll('.info-row');
            rows.forEach(row => {
                let label = row.querySelector('.info-label').innerText.trim();
                let value = row.querySelector('.info-value').innerText.trim();
                if(value.startsWith(':')) value = value.substring(1).trim();
                
                content += "<li style='margin-bottom: 10px;'><strong>" + label + " :</strong> " + value + "</li>";
            });
            content += "</ul>";
            
            let html = header + content + footer;
            let filename = "Detail_Laporan_{{ $laporan->nomor_laporan }}.doc";
            
            let blob = new Blob(['\ufeff', html], { type: 'application/msword' });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
=======
        function downloadDetailWord() {
            let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Rincian Laporan</title></head><body style='font-family: Arial, sans-serif;'>";
            let footer = "</body></html>";
            
            let content = "<div style='text-align:center; margin-bottom: 20px;'>";
            content += "<h2 style='margin:0; padding:0; font-family: Arial, sans-serif;'>LAPORAN DATA PENYELAMATAN & KEBAKARAN</h2>";
            content += "<p style='margin:5px 0 0 0; font-size: 14px; font-family: Arial, sans-serif; color: #4b5563;'>Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>";
            content += "</div>";
            content += "<hr style='border: 1px solid black; margin-bottom: 20px;'>";
            
            content += "<table border='1' cellpadding='6' cellspacing='0' style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 13px;'>";
            
            let rows = document.querySelectorAll('.data-row');
            rows.forEach(row => {
                let labelEl = row.querySelector('.data-label');
                let valueEl = row.querySelector('.data-value');
                if(labelEl && valueEl) {
                    let label = labelEl.innerText.trim();
                    let value = valueEl.innerText.trim();
                    if(label && value) {
                        content += `<tr>
                            <td style='width: 35%; font-weight: bold; background-color: #f3f4f6; vertical-align: top; padding: 8px;'>${label}</td>
                            <td style='width: 65%; vertical-align: top; padding: 8px;'>${value}</td>
                        </tr>`;
                    }
                }
            });
            content += "</table>";

            let photos = document.querySelectorAll('img[src*="/uploads/damtan/foto/"]');
            let video = document.querySelector('a[href*="/uploads/damtan/video/"]');

            if(photos.length > 0 || video) {
                content += "<h3 style='margin-top: 30px; font-family: Arial, sans-serif; border-bottom: 1px solid #ccc; padding-bottom: 5px;'>V. Dokumentasi Lapangan</h3>";
                
                if(photos.length > 0) {
                    content += "<div style='text-align: center; margin-bottom: 20px;'>";
                    photos.forEach(img => {
                        let imageUrl = img.src; 
                        content += `<img src="${imageUrl}" style="width: 300px; height: auto; margin: 10px; border: 2px solid #ccc;" />`;
                    });
                    content += "</div>";
                }

                if(video) {
                    content += `<p style='font-family: Arial, sans-serif; font-size: 13px;'><strong>Tautan Video Terlampir:</strong> <br> <a href="${video.href}" style="color: #0284c7;">${video.href}</a></p>`;
                }
            }
            
            let blob = new Blob(['\ufeff', header + content + footer], { type: 'application/msword' });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "Laporan_Penyelamatan_Lengkap_{{ $laporan->nomor_laporan }}.doc";
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>