<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Rincian Data - SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    
    <!-- PRELOAD LOGO AGAR TIDAK TELAT LOADING SAAT DI-PRINT -->
    <link rel="preload" href="/images/logo.png" as="image">
    <link rel="preload" href="/images/jambi.png" as="image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome & HTML2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        /* ==========================================================
           DESIGN TOKENS UTAMA (Sidebar, Topbar, Background)
           ========================================================== */
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;
            --paper: #f7f9fc;
            --white: #ffffff;

            --navy: #1e3a5f;
            --navy-d: #14283f;
            --navy-tint: rgba(30, 58, 95, .09);

            --signal: #e5392d;
            --signal-d: #c22b20;

            --amber: #ffb627;
            --success: #10b981;
            --info: #2f6fed;
            --steel: #64748b;
            --steel-soft: #94a3b8;
            --line: #e6eaf1;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --sidebar-w: 272px;
            --topbar-h: 72px;
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        
        /* ==========================================================
           GLOBAL ALERTS
           ========================================================== */
        #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: 12px; z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* ==========================================================
           TOPBAR & SIDEBAR
           ========================================================== */
        .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: rgba(255,255,255,.86); -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px); border-bottom: 1px solid var(--line); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; transition: background .2s; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; }

        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 16px 6px 6px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; color: var(--ink); }
        .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; transition: background .2s; }
        .btn-logout:hover { background: var(--navy-d); }

        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; }
        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: 10px; font-size: .9rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; transition: background .2s, color .2s; }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: .8rem; font-weight: 700; text-transform: uppercase; color: var(--navy); }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: nowrap; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: 10px; font-size: .85rem; font-weight: 500; color: var(--steel); transition: background .2s, color .2s; }
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
        .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .9rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }
        .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; text-transform: uppercase; color: var(--steel-soft); }
        
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .back-link { color: var(--steel); font-size: 14px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; margin-bottom: 10px; transition: color .2s;}
        .back-link:hover { color: var(--navy); }
        .page-head { margin-bottom: 28px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; color: var(--ink); }
        
        .card-custom { background: #fff; border: 1px solid var(--line); border-radius: 14px; box-shadow: var(--shadow-sm); padding: clamp(24px, 4vw, 40px); margin-bottom: 30px; }
        
        .btn-custom-edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; font-weight: 700; border: none; padding: 10px 24px; border-radius: 12px; transition: background 0.2s; display: inline-flex; align-items: center; text-decoration: none;}
        .btn-custom-edit:hover { background-color: rgba(255, 182, 39, 0.3); color: #d97706;}

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
            .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; transform: translateX(-100%); transition: transform .3s; }
            body.side-open .sidebar { transform: none; }
        }

        /* ==========================================================
           PENGATURAN PDF LAMA (ANTI-ERROR HTML2PDF)
           Gunakan PX dan Hex Colors murni di dalam #report-content
           ========================================================== */
        
        /* Kop Surat */
        .tabel-kop { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
        .tabel-kop td { vertical-align: middle; }
        .tabel-kop img { width: 80px; height: auto; }
        .kop-text { text-align: center; }
        .kop-text h2 { margin: 0; font-size: 14pt; font-weight: normal; font-family: 'Times New Roman', Times, serif; color: #000; }
        .kop-text h1 { margin: 0; font-size: 16pt; font-weight: bold; line-height: 1.1; font-family: 'Times New Roman', Times, serif; color: #000; }
        .kop-text p { margin: 2px 0 0 0; font-size: 10pt; font-family: 'Times New Roman', Times, serif; color: #000; }
        .garis-kop { border-top: 3px solid black; border-bottom: 1px solid black; height: 2px; margin-top: 5px; margin-bottom: 20px; }
        .judul-laporan { text-align: center; margin-bottom: 25px; line-height: 1.2; font-family: 'Times New Roman', Times, serif; color: #000; }
        .judul-laporan h3 { margin: 0; font-size: 14pt; font-weight: bold; text-decoration: underline; }

        /* Grid Data Laporan Asli */
        .section-header { clear: both; display: flex; align-items: center; gap: 12px; margin-bottom: 12px; margin-top: 25px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb; page-break-after: avoid; page-break-inside: avoid; }
        .section-header::before { content: ''; width: 4px; height: 18px; background-color: #3b82f6; border-radius: 4px; }
        .section-header h3 { font-size: 16px; font-weight: 800; margin: 0; color: #111827; text-transform: uppercase; font-family: 'Plus Jakarta Sans', sans-serif;}

        .pdf-grid { display: block; width: 100%; margin-bottom: 15px; } 
        .pdf-grid::after { content: ""; display: table; clear: both; } 
        .pdf-item { float: left; width: 49%; padding-right: 15px; margin-bottom: 10px; box-sizing: border-box; page-break-inside: avoid; }
        .pdf-item-full { clear: both; display: block; width: 100%; margin-bottom: 10px; box-sizing: border-box; page-break-inside: avoid; }
        
        .data-row { display: flex; align-items: flex-start; page-break-inside: avoid; break-inside: avoid; width: 100%; }
        .data-icon { width: 22px; color: #0284c7; flex-shrink: 0; font-size: 13px; margin-top: 1px; }
        .data-label { width: 135px; font-weight: 700; color: #4b5563; flex-shrink: 0; font-size: 12px; line-height: 1.4; font-family: 'Plus Jakarta Sans', sans-serif;}
        .data-colon { width: 12px; font-weight: 700; color: #4b5563; text-align: center; flex-shrink: 0; font-size: 12px; line-height: 1.4; }
        .data-value { flex-grow: 1; font-weight: 600; color: #1f2937; font-size: 12px; word-break: break-word; line-height: 1.4; font-family: 'Plus Jakarta Sans', sans-serif;}
        
        .sub-header { clear: both; display: block; width: 100%; font-size: 14px; font-weight: 700; color: #0284c7; margin-top: 20px; margin-bottom: 10px; page-break-after: avoid; page-break-inside: avoid; font-family: 'Plus Jakarta Sans', sans-serif;}
        
        .text-capitalize { text-transform: capitalize; }
        .text-uppercase { text-transform: uppercase; }

        @media print {
            .topbar, .sidebar, .sidebar-backdrop, #action-buttons-container, .back-link, .d-print-none, #globalSuccessAlert, #globalErrorAlert, .page-head { display: none !important; }
            body, .content { background-color: white !important; padding: 0 !important; margin: 0 !important;}
            .card-custom { box-shadow: none !important; border: none !important; padding: 0 !important; margin: 0 !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
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

    <!-- ==================== TOPBAR ==================== -->
    <header class="topbar d-print-none">
        <div class="topbar-left">
            <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/internal/index" class="brand">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
                <span>SIMERAH KOJA</span>
            </a>
        </div>
        <div class="topbar-right">
            <div class="user-chip">
                <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'R', 0, 1)) }}</span>
                <div class="user-meta">
                    <strong>{{ Auth::user()->nama_lengkap ?? 'Rekan kerja' }}</strong>
                    <small>{{ str_replace('_', ' ', Auth::user()->role ?? '') }}</small>
                </div>
            </div>
            <form action="/logout" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> Keluar</button>
            </form>
        </div>
    </header>

    <div class="shell">
        <div class="sidebar-backdrop" id="sideBackdrop"></div>

        <!-- ==================== SIDEBAR ==================== -->
        <aside class="sidebar d-print-none" id="sidebar" aria-label="Navigasi internal">
            <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-house"></i> Dashboard utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="side-kicker">Modul operasional</div>

                <!-- BAGIAN PENCEGAHAN -->
                <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                    <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                    <div class="side-sub">
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                            <i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas Aparatur
                        </a>
                        <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                            <i class="fas fa-magnifying-glass-chart"></i> Pencegahan Kebakaran dan Inspeksi
                        </a>
                        <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}">
                            <i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat dan Dunia Usaha
                        </a>
                        <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}">
                            <i class="fas fa-bullhorn"></i> Kelola Edukasi
                        </a>
                        <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}">
                            <i class="fas fa-users-rectangle"></i> Kelola Redkar
                        </a>
                        <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}">
                            <i class="fas fa-building-circle-check"></i> Kelola RPKBGL
                        </a>
                        <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}">
                            <i class="fas fa-file-shield"></i> Kelola SKK
                        </a>
                    </div>
                </details>

                <!-- BAGIAN PEMADAMAN -->
                <details class="side-group" open>
                    <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                   <div class="side-sub">
                        <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                            <i class="fas fa-fire-extinguisher"></i> Input data
                        </a>
                        <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                            <i class="fas fa-file-signature"></i> Buat Surat Korban
                        </a>
                        <a href="/internal/damtan/data-laporan" class="active">
                            <i class="fas fa-clipboard-list"></i> Kelola Data Laporan
                        </a>
                        <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                            <i class="fas fa-folder-open"></i> Kelola Surat Korban
                        </a>
                    </div>
                </details>

                <!-- BAGIAN KEPEGAWAIAN -->
                <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
                    <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                    <div class="side-sub">
                        <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                            <i class="fas fa-user-tie"></i> Data Urut Kepegawaian
                        </a>
                    </div>
                </details>

                <!-- BAGIAN SAPRA -->
                <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                    <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                    <div class="side-sub">
                        <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                        <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam</a>
                        <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Pemadam</a>
                        <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan</a> 
                        <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                        <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-location-dot"></i> Data Hidrant Kota Jambi</a>

                        <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                        <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i> Distribusi Barang Staff</a>
                    </div>
                </details>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="side-kicker">Konten publik</div>
                <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                    <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                    <div class="side-sub">
                        <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input &amp; Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </details>
            @endif

            <div class="side-kicker">Akun</div>
            <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola Semua Pengguna</a>
                        <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}"><i class="fas fa-address-book"></i> Kelola Akun Pemohon</a>
                    @endif
                </div>
            </details>
        </aside>

        <!-- ==================== KONTEN UTAMA ==================== -->
        <main class="content">
            <a href="/internal/damtan/data-laporan" class="back-link d-print-none"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <div class="page-head d-print-none mt-2">
                <h1 class="page-title">Rincian Laporan Tervalidasi</h1>
            </div>

            <!-- ID report-content untuk di-render oleh html2pdf -->
            <div class="card-custom" id="report-content">
                
                <!-- KOP SURAT PDF (Tersembunyi secara default, akan dimunculkan via JS saat cetak) -->
                <div id="pdf-header" style="display: none;">
                    <table class="tabel-kop">
                        <tr>
                            <td style="width: 15%; text-align: left;">
                                <img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi">
                            </td>
                            <td style="width: 70%;" class="kop-text">
                                <h2>PEMERINTAH KOTA JAMBI</h2>
                                <h1>DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</h1>
                                <p>Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</p>
                            </td>
                            <td style="width: 15%; text-align: right;">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar">
                            </td>
                        </tr>
                    </table>
                    
                    <div class="garis-kop"></div>

                    <div class="judul-laporan">
                        <h3>LAPORAN DATA PENYELAMATAN & KEBAKARAN</h3>
                    </div>
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
                    @if(!empty($laporan->pimpinan_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="data-label">Pimpinan Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->pimpinan_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->pendamping_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-friends"></i></div>
                            <div class="data-label">Pendamping Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->pendamping_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->satuan_tugas))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users-cog"></i></div>
                            <div class="data-label">Satuan Tugas / Regu</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->satuan_tugas }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->tim_respontime))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-stopwatch"></i></div>
                            <div class="data-label">Tim Respon Time</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->tim_respontime }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->status_evakuasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Status Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->status_evakuasi) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($laporan->metode_evakuasi)))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Metode Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $laporan->metode_evakuasi) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($laporan->metode_penyelamatan)))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Met. Penyelamatan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $laporan->metode_penyelamatan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->objek_terdampak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                            <div class="data-label">Objek Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->objek_terdampak }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($laporan->jumlah_personel) && $laporan->jumlah_personel > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users"></i></div>
                            <div class="data-label">Jumlah Anggota</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->jumlah_personel }} Personel</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->daftar_personel))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-tag"></i></div>
                            <div class="data-label">Anggota Terlibat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->daftar_personel }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                @if(
                    (!empty($laporan->korban_selamat) && $laporan->korban_selamat > 0) ||
                    (!empty($laporan->korban_ringan) && $laporan->korban_ringan > 0) ||
                    (!empty($laporan->korban_berat) && $laporan->korban_berat > 0) ||
                    (!empty($laporan->korban_meninggal) && $laporan->korban_meninggal > 0) ||
                    !empty($laporan->korban_hewan_aset)
                )
                <div class="sub-header">Data Korban & Aset</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->korban_selamat) && $laporan->korban_selamat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-check"></i></div>
                            <div class="data-label">Korban Selamat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->korban_selamat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->korban_ringan) && $laporan->korban_ringan > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-injured"></i></div>
                            <div class="data-label">Korban Luka Ringan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->korban_ringan }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->korban_berat) && $laporan->korban_berat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-procedures"></i></div>
                            <div class="data-label">Korban Luka Berat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->korban_berat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->korban_meninggal) && $laporan->korban_meninggal > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-times"></i></div>
                            <div class="data-label">Korban Meninggal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value" style="color: #dc2626;">{{ $laporan->korban_meninggal }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->korban_hewan_aset))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-cat"></i></div>
                            <div class="data-label">Korban Hewan/Aset</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->korban_hewan_aset }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <div class="sub-header">Alat & Logistik Terpakai</div>
                <div class="pdf-grid">
                    @if(!empty(json_decode($laporan->armada)))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck"></i></div>
                            <div class="data-label">Armada Diturunkan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace(['"', '[', ']'], '', $laporan->armada) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($laporan->peralatan)))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-toolbox"></i></div>
                            <div class="data-label">Peralatan Khusus</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ str_replace(['"', '[', ']'], '', $laporan->peralatan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->peralatan_lain))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tools"></i></div>
                            <div class="data-label">Peralatan Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->peralatan_lain }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->liter_air) && $laporan->liter_air > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tint"></i></div>
                            <div class="data-label">Konsumsi Air</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->liter_air }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->liter_foam) && $laporan->liter_foam > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-soap"></i></div>
                            <div class="data-label">Konsumsi Foam</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->liter_foam }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->liter_bbm) && $laporan->liter_bbm > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-gas-pump"></i></div>
                            <div class="data-label">Konsumsi BBM</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->liter_bbm }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->konsumsi_alat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-spray-can"></i></div>
                            <div class="data-label">Konsumsi Alat Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->konsumsi_alat }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- TAB 3: DOKUMENTASI & EVALUASI -->
                <div class="section-header" style="margin-top: 20px;"><h3>III. Analisis, Evaluasi & Dokumentasi Kejadian</h3></div>

                <div class="pdf-grid">
                    @if(!empty($laporan->langkah_penanganan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tasks"></i></div>
                            <div class="data-label">Langkah Penanganan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->langkah_penanganan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->hambatan_lapangan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="data-label">Hambatan Lapangan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->hambatan_lapangan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->hasil_tindakan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-check-double"></i></div>
                            <div class="data-label">Hasil Tindakan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->hasil_tindakan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->kronologi_lengkap))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-align-left"></i></div>
                            <div class="data-label">Kronologi Lengkap</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->kronologi_lengkap }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Investigasi Lapangan</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->dugaan_penyebab))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-bolt"></i></div>
                            <div class="data-label">Dugaan Penyebab</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->dugaan_penyebab) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->dugaan_penyebab_lainnya))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-search"></i></div>
                            <div class="data-label">Penyebab Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->dugaan_penyebab_lainnya }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->sumber_api))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire-alt"></i></div>
                            <div class="data-label">Sumber Api / Awal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->sumber_api }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->luas_area) && $laporan->luas_area > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-ruler-combined"></i></div>
                            <div class="data-label">Luas Area Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->luas_area }} m²</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty(json_decode($laporan->instansi_pendukung)))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Instansi Pendukung</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-uppercase">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $laporan->instansi_pendukung) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->tindakan_instansi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Tindakan Instansi Lain</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->tindakan_instansi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->kontak_saksi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="data-label">Kontak Saksi/Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->kontak_saksi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->cara_bertindak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div class="data-label">Cara Bertindak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->cara_bertindak }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                @if(!empty($laporan->kebutuhan_tambahan) || !empty($laporan->saran_mitigasi))
                <div class="sub-header">Evaluasi Pasca Operasi</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->kebutuhan_tambahan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-plus-circle"></i></div>
                            <div class="data-label">Kebutuhan Tambahan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->kebutuhan_tambahan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->saran_mitigasi))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-lightbulb"></i></div>
                            <div class="data-label">Saran Mitigasi Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->saran_mitigasi }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- TAB 4: KATEGORI KHUSUS -->
                @if(!empty($laporan->jenis_hewan) || !empty($laporan->jenis_objek_tumbang) || !empty($laporan->kondisi_perairan) || !empty($laporan->jenis_benda_bahaya))
                <div class="section-header"><h3>IV. Rincian Modul Kategori Khusus</h3></div>

                    @if(!empty($laporan->jenis_hewan))
                    <div class="sub-header"><i class="fas fa-paw me-2"></i>Data Animal Rescue</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-paw"></i></div>
                                <div class="data-label">Jenis Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ $laporan->jenis_hewan }}</div>
                            </div>
                        </div>
                        
                        @if(!empty($laporan->spesies_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-tag"></i></div>
                                <div class="data-label">Spesies / Lokal</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->spesies_hewan }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->dimensi_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ruler"></i></div>
                                <div class="data-label">Dimensi / Panjang</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->dimensi_hewan }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($laporan->berat_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-balance-scale"></i></div>
                                <div class="data-label">Berat Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->berat_hewan }} Kg</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->status_hewan_pasca))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-share-square"></i></div>
                                <div class="data-label">Status Evakuasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->status_hewan_pasca) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->lokasi_pelepasan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="data-label">Lokasi Pelepasan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->lokasi_pelepasan }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($laporan->jenis_objek_tumbang))
                    <div class="sub-header"><i class="fas fa-tree me-2"></i>Data Objek Tumbang/Bangunan</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cube"></i></div>
                                <div class="data-label">Jenis Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->jenis_objek_tumbang) }}</div>
                            </div>
                        </div>

                        @if(!empty($laporan->dimensi_objek))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                                <div class="data-label">Dimensi Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->dimensi_objek }} cm</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->status_utilitas))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-plug"></i></div>
                                <div class="data-label">Utilitas Terkait</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->status_utilitas) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->dampak_properti))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                                <div class="data-label">Dampak Properti</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->dampak_properti }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($laporan->kondisi_perairan))
                    <div class="sub-header"><i class="fas fa-water me-2"></i>Data Water Rescue</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-water"></i></div>
                                <div class="data-label">Kondisi Perairan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->kondisi_perairan) }}</div>
                            </div>
                        </div>

                        @if(!empty($laporan->radius_pencarian))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-search-location"></i></div>
                                <div class="data-label">Radius Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->radius_pencarian }} meter</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->metode_pencarian_air))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-binoculars"></i></div>
                                <div class="data-label">Metode Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->metode_pencarian_air) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->daftar_penyelam))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-swimmer"></i></div>
                                <div class="data-label">Daftar Penyelam</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->daftar_penyelam }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($laporan->jenis_benda_bahaya) || !empty($laporan->jenis_medan))
                    <div class="sub-header"><i class="fas fa-ring me-2"></i>Data Pelepasan Cincin & Geografis Lapangan</div>
                    <div class="pdf-grid">
                        @if(!empty($laporan->jenis_benda_bahaya))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ring"></i></div>
                                <div class="data-label">Jenis Benda</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $laporan->jenis_benda_bahaya }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->kondisi_anggota_tubuh))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-hand-paper"></i></div>
                                <div class="data-label">Kondisi Tubuh</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->kondisi_anggota_tubuh) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->alat_potong_cincin))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cut"></i></div>
                                <div class="data-label">Alat Potong</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->alat_potong_cincin) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->cuaca_operasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="data-label">Cuaca Operasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->cuaca_operasi) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->jenis_medan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-mountain"></i></div>
                                <div class="data-label">Jenis Medan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->jenis_medan) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($laporan->akses_lokasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-road"></i></div>
                                <div class="data-label">Akses Lokasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->akses_lokasi) }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                @endif

                <!-- TAB 5: DOKUMENTASI FOTO & VIDEO -->
                @if((!empty($laporan->foto) && $laporan->foto !== 'null' && $laporan->foto !== '[]') || !empty($laporan->video))
                <div class="section-header" style="page-break-before: always;"><h3>V. Dokumentasi Lapangan</h3></div>
                
                @if(!empty($laporan->foto) && $laporan->foto !== 'null' && $laporan->foto !== '[]')
                    @php $fotos = json_decode($laporan->foto, true); @endphp
                    @if(is_array($fotos) && count($fotos) > 0)
                    <div class="sub-header"><i class="fas fa-camera me-2"></i>Lampiran Foto</div>
                    <div style="display: block; width: 100%; margin-bottom: 20px;">
                        @foreach($fotos as $foto)
                            <img src="{{ asset('uploads/damtan/foto/' . $foto) }}" style="display: inline-block; width: 48%; height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; margin-right: 1%; margin-bottom: 10px;">
                        @endforeach
                    </div>
                    @endif
                @endif

                @if(!empty($laporan->video))
                    <div class="sub-header"><i class="fas fa-video me-2"></i>Lampiran Video</div>
                    <div class="pdf-grid">
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-file-video"></i></div>
                                <div class="data-label">File Terlampir</div>
                                <div class="data-colon">:</div>
                                <div class="data-value"><a href="{{ asset('uploads/damtan/video/' . $laporan->video) }}" target="_blank" style="color: #0284c7; text-decoration: none;">{{ $laporan->video }} <small class="text-muted">(Klik untuk memutar di browser)</small></a></div>
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
                    <div class="dropdown">
                        <button class="btn btn-custom-light shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download me-2"></i> Download Laporan
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="#" onclick="downloadDetailPDF()"><i class="fas fa-file-pdf me-2"></i> Format PDF</a></li>
                            <li><a class="dropdown-item py-2 text-success fw-bold" href="#" onclick="downloadDetailExcel()"><i class="fas fa-file-excel me-2"></i> Format Excel</a></li>
                            <li><a class="dropdown-item py-2 text-primary fw-bold" href="#" onclick="downloadDetailWord()"><i class="fas fa-file-word me-2"></i> Format Word</a></li>
                        </ul>
                    </div>
                    <a href="/internal/damtan/edit-data/{{ $laporan->id }}" class="btn btn-custom-edit shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Data Ini
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict';
            /* ---------- Sidebar (Mobile Toggle) ---------- */
            var toggle = document.getElementById('sideToggle');
            var backdrop = document.getElementById('sideBackdrop');
            function closeSide() {
                document.body.classList.remove('side-open');
                if(toggle) toggle.setAttribute('aria-expanded', 'false');
            }
            if (toggle) {
                toggle.addEventListener('click', function () {
                    var open = document.body.classList.toggle('side-open');
                    toggle.setAttribute('aria-expanded', open);
                });
            }
            if (backdrop) backdrop.addEventListener('click', closeSide);
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

            /* ---------- Eksklusivitas Accordion Sidebar ---------- */
            var groups = document.querySelectorAll('.side-group');
            groups.forEach(function (g) {
                g.addEventListener('toggle', function () {
                    if (g.open) {
                        groups.forEach(function (o) { if (o !== g) o.open = false; });
                    }
                });
            });
        })();

        function downloadDetailPDF() {
            window.scrollTo(0, 0);

            const element = document.getElementById('report-content');
            const pdfHeader = document.getElementById('pdf-header');
            const btnContainer = document.getElementById('action-buttons-container');
            const topbar = document.querySelector('.topbar');
            const sidebar = document.querySelector('.sidebar');
            const backLink = document.querySelector('.back-link');
            const pageHead = document.querySelector('.page-head');

            pdfHeader.style.display = 'block'; 
            btnContainer.style.display = 'none';
            if(topbar) topbar.style.display = 'none';
            if(sidebar) sidebar.style.display = 'none';
            if(backLink) backLink.style.display = 'none';
            if(pageHead) pageHead.style.display = 'none';

            const originalPadding = element.style.padding;
            const originalMargin = element.style.margin;
            const originalShadow = element.style.boxShadow;
            const originalBorder = element.style.border;
            element.style.padding = '10px 20px';
            element.style.margin = '0px';
            element.style.boxShadow = 'none';
            element.style.border = 'none';

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
                    if(topbar) topbar.style.display = 'flex';
                    if(sidebar) sidebar.style.display = 'block';
                    if(backLink) backLink.style.display = 'inline-flex';
                    if(pageHead) pageHead.style.display = 'block';
                    
                    element.style.padding = originalPadding;
                    element.style.margin = originalMargin;
                    element.style.boxShadow = originalShadow;
                    element.style.border = originalBorder;
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
            
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

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
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>