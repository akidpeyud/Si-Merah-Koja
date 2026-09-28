<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Data Laporan Penyelamatan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    
    <!-- PRELOAD LOGO AGAR TIDAK TELAT LOADING SAAT DI-PRINT -->
    <link rel="preload" href="/images/logo.png" as="image">
    <link rel="preload" href="/images/jambi.png" as="image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================================
           DESIGN TOKENS (Konsisten dengan UI Utama)
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
            --signal-tint: rgba(229, 57, 45, .09);

            --amber: #ffb627;
            --success: #10b981;
            --info: #2f6fed;
            --info-tint: rgba(47, 111, 237, .09);
            --ink-tint: rgba(13, 27, 42, .055);

            --steel: #64748b;
            --steel-soft: #94a3b8;
            --line: #e6eaf1;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 20px;
            --r-md: 14px;
            --r-sm: 10px;

            --sidebar-w: 272px;
            --topbar-h: 72px;

            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
            --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ink);
            background: var(--paper);
            -webkit-font-smoothing: antialiased;
        }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }
        
        /* ==========================================================
           GLOBAL ALERTS
           ========================================================== */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
        
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar {
            position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 0 28px; background: rgba(255,255,255,.86);
            -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; transition: background .2s; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 16px 6px 6px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--ink); }
        .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; transition: background .2s, transform .1s; border: none; }
        .btn-logout:hover { background: var(--navy-d); }
        .btn-logout:active { transform: scale(.98); }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        /* ==========================================================
           SHELL & SIDEBAR
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

        .sidebar {
            width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
            height: calc(100vh - var(--topbar-h)); overflow-y: auto;
            background: #fff; border-right: 1px solid var(--line);
            padding: 20px 14px 32px;
            scrollbar-width: thin;
            scrollbar-color: var(--line) transparent;
        }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: var(--line); border-radius: 20px; }

        .side-link {
            display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm);
            font-size: .9rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s;
            margin-bottom: 4px;
        }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary {
            list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: var(--r-sm); font-size: .8rem; font-weight: 700;
            letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s;
            user-select: none;
        }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a {
            display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm);
            font-size: .85rem; font-weight: 500; line-height: 1.4; color: var(--steel);
            transition: background .2s, color .2s, transform .2s;
        }
        .side-sub a:hover { background: var(--paper); color: var(--ink); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .9rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }

        .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel-soft); }

        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; z-index: 1010; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           MAIN CONTENT & TABLE STYLING
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        
        .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
        .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-header-text p { color: var(--steel); font-size: .98rem; margin: 0; }

        .card-custom {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        /* Form Filter Styles */
        .form-control, .form-select {
            font-family: var(--font-body);
            font-size: .95rem;
            color: var(--ink);
            background-color: var(--paper);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 10px 16px;
            transition: all 0.2s ease-in-out;
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--navy);
            box-shadow: 0 0 0 4px var(--navy-tint);
        }
        .input-group-text { background-color: var(--paper); border: 1px solid var(--line); color: var(--steel); }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }

        /* Buttons */
        .btn-custom-primary {
            background-color: var(--navy); color: #fff; font-family: var(--font-body); font-weight: 700;
            border: none; padding: 10px 24px; border-radius: 12px; transition: background 0.2s; text-decoration: none; display: inline-flex; align-items: center;
        }
        .btn-custom-primary:hover { background-color: var(--navy-d); color: #fff; }
        
        .btn-custom-light {
            background-color: var(--paper); color: var(--ink); font-family: var(--font-body); font-weight: 700;
            border: 1px solid var(--line); padding: 10px 24px; border-radius: 12px; transition: background 0.2s; display: inline-flex; align-items: center;
        }
        .btn-custom-light:hover { background-color: var(--line); color: var(--ink); }

        /* Table Custom Styles */
        .table { margin-bottom: 0; }
        .table th { background-color: rgba(243, 245, 248, 0.6); color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); }
        .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
        .table tbody tr:hover { background-color: var(--paper); }
        
        /* Action Buttons */
        .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
        .action-btn.view { background-color: var(--info-tint); color: var(--info); }
        .action-btn.view:hover { background-color: #dbeafe; }
        .action-btn.edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; margin: 0 5px; } /* Amber tint */
        .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.25); }
        .action-btn.delete { background-color: var(--signal-tint); color: var(--signal); }
        .action-btn.delete:hover { background-color: #fecaca; }
        
        .badge-custom { padding: 6px 12px; font-weight: 600; font-size: 11px; border-radius: 8px; }

        /* Pagination */
        .pagination-container nav ul.pagination { margin-bottom: 0 !important; }
        .pagination-container nav p { display: none; }

        /* --- STYLES KHUSUS UNTUK CETAK PDF --- */
        @page { margin: 0; }
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-header, .card-header, .card-footer,
            .btn, .dropdown, form, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert {
                display: none !important;
            }

            body { background-color: white !important; font-size: 12px; margin: 1.5cm !important; -webkit-print-color-adjust: exact; }
            .shell { display: block; }
            .content { padding: 0 !important; margin: 0 !important; }
            .card-custom { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
            .card-body { padding: 0 !important; }

            /* Format tabel cetak */
            .table { width: 100% !important; border-collapse: collapse; margin-bottom: 20px; }
            .table th, .table td { border: 1px solid black !important; padding: 8px !important; text-align: left; }
            .table th { background-color: #f2f2f2 !important; font-weight: bold; color: black !important; text-align: left !important; }
            th:last-child, td:last-child { display: none !important; }
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
<header class="topbar">
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
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">
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
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Hidrant Kota Jambi</a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input &amp; kelola berita</a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola info grafis</a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola berita medsos</a>
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola semua pengguna</a>
                    <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                    </a>
                @endif
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">
        <div class="page-header">
            <div class="page-header-text">
                <h1>Data Laporan Penyelamatan</h1>
                <p>Daftar seluruh laporan kejadian yang telah diinput ke dalam sistem.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn-custom-light shadow-sm" type="button" onclick="window.print()">
                    <i class="fas fa-download me-2"></i> Ekspor Semua
                </button>
                <a href="/internal/damtan/input-data" class="btn-custom-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Buat Laporan Baru
                </a>
            </div>
        </div>

        <div class="card-custom">
            <!-- Filter & Search Bar -->
            <div class="card-header bg-white p-4 border-bottom border-light">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nomor laporan, lokasi, dsb...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select id="filterKategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <option value="Kebakaran">Kebakaran</option>
                            <option value="Non-Kebakaran">Non-Kebakaran</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="btn-custom-light w-100 p-2" onclick="resetFilter()"><i class="fas fa-sync-alt me-2"></i>Reset</button>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    
                    <!-- HEADER KHUSUS CETAK PDF MENGGUNAKAN FLEXBOX ANTI-ERROR BOOTSTRAP -->
                    <div id="print-header" class="d-none d-print-block" style="width: 100%; margin-bottom: 20px;">
                        <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; width: 100% !important; margin-bottom: 15px;">
                            
                            <!-- Logo Kiri -->
                            <div style="width: 15% !important; text-align: left !important;">
                                <img src="/images/jambi.png" style="width: 80px; height: auto;">
                            </div>
                            
                            <!-- Teks Tengah Dipaksa Center -->
                            <div style="width: 70% !important; text-align: center !important;">
                                <div style="font-size: 14pt; color: #000; margin-bottom: 2px; font-family: 'Times New Roman', Times, serif;">PEMERINTAH KOTA JAMBI</div>
                                <div style="font-size: 16pt; font-weight: bold; color: #000; line-height: 1.1; margin-bottom: 5px; font-family: 'Times New Roman', Times, serif;">DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</div>
                                <div style="font-size: 10pt; color: #000; font-family: 'Times New Roman', Times, serif;">Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</div>
                            </div>
                            
                            <!-- Logo Kanan -->
                            <div style="width: 15% !important; text-align: right !important;">
                                <img src="/images/logo.png" style="width: 100px; height: auto;">
                            </div>
                        </div>
                        
                        <!-- Garis Ganda -->
                        <div style="border-top: 3px solid black !important; border-bottom: 1px solid black !important; height: 2px !important; width: 100% !important; margin-bottom: 15px !important;"></div>
                        
                        <h3 style="text-align: center !important; font-weight: bold; margin-bottom: 5px; font-size: 16px; color: black; font-family: 'Times New Roman', Times, serif;">REKAPITULASI DATA LAPORAN PENYELAMATAN</h3>
                        <p style="text-align: center !important; font-size: 12px; margin-bottom: 15px; color: black; font-family: 'Times New Roman', Times, serif;">Dicetak pada: {{ date('d F Y') }}</p>
                    </div>
                    <!-- AKHIR HEADER CETAK -->

                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="15%">No. Laporan</th>
                                <th width="20%">Waktu Kejadian</th>
                                <th width="20%">Kategori Kejadian</th>
                                <th width="10%">Prioritas</th>
                                <th width="15%">Status Evakuasi</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($data_laporan as $index => $row)
                            <tr>
                                <td class="text-center text-muted">{{ $data_laporan->firstItem() + $index }}</td>
                                <td><strong>{{ $row->nomor_laporan }}</strong></td>
                                <td>
                                    <div class="text-dark fw-bold">
                                        {{ $row->waktu_kejadian ? \Carbon\Carbon::parse($row->waktu_kejadian)->format('d M Y') : '-' }}
                                    </div>
                                    <div class="text-muted" style="font-size: 12px;">
                                        <i class="far fa-clock me-1"></i> 
                                        {{ $row->waktu_kejadian ? \Carbon\Carbon::parse($row->waktu_kejadian)->format('H:i') : '-' }} WIB
                                    </div>
                                </td>
                                <td class="kategori-cell">
                                    @if(strtolower($row->kategori_kejadian) == 'kebakaran')
                                        <div class="fw-bold text-danger">Kebakaran</div>
                                        <div class="text-muted" style="font-size: 12px; text-transform: capitalize;">
                                            {{ str_replace('_', ' ', $row->kategori_kebakaran ?? '-') }}
                                        </div>
                                    @else
                                        <div class="fw-bold text-primary">Non-Kebakaran</div>
                                        <div class="text-muted" style="font-size: 12px; text-transform: capitalize;">
                                            {{ str_replace('_', ' ', $row->kategori_non_kebakaran ?? $row->kategori_kejadian) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $badgeClass = 'bg-secondary text-white';
                                        if($row->prioritas == 'rendah') $badgeClass = 'bg-secondary text-white';
                                        if($row->prioritas == 'sedang') $badgeClass = 'bg-primary text-white';
                                        if($row->prioritas == 'tinggi') $badgeClass = 'bg-warning text-dark';
                                        if($row->prioritas == 'darurat') $badgeClass = 'bg-danger text-white';
                                    @endphp
                                    <span class="badge badge-custom {{ $badgeClass }}" style="text-transform: capitalize;">
                                        {{ $row->prioritas ?? 'Biasa' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-custom bg-success bg-opacity-10 text-success border border-success">
                                        <i class="fas fa-check-circle me-1"></i>Terekam
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="/internal/damtan/lihat-data/{{ $row->id }}" class="action-btn view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                    <a href="/internal/damtan/edit-data/{{ $row->id }}" class="action-btn edit" title="Edit Laporan"><i class="fas fa-edit"></i></a>
                                    <form action="/internal/damtan/hapus-data/{{ $row->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan {{ $row->nomor_laporan }} secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>

                                    <!-- MODAL LIHAT DETAIL DINAMIS -->
                                    <div class="modal fade text-start" id="detailModal{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header" style="background-color: var(--ink); color: white;">
                                                    <h5 class="modal-title fw-bold" style="color: white;"><i class="fas fa-file-alt me-2 text-success"></i> Detail Laporan</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4 bg-light">
                                                    <p>Rincian laporan dapat dilihat pada menu aksi.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open mb-3" style="font-size: 24px;"></i><br>
                                    Belum ada data laporan yang diinput ke dalam sistem.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white p-4 d-flex justify-content-between align-items-center border-top">
                <span class="text-muted" style="font-size: 13px;" id="dataCount">
                    Menampilkan {{ $data_laporan->firstItem() ?? 0 }} - {{ $data_laporan->lastItem() ?? 0 }} dari total {{ $data_laporan->total() }} laporan
                </span>
                <div class="pagination-container mb-0">
                    {{ $data_laporan->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script Bootstrap & Fungsi Search/Filter JavaScript -->
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

    /* ---------- FUNGSI SEARCH & FILTER ---------- */
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const filterKategori = document.getElementById('filterKategori');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const categoryTerm = filterKategori.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) {
                if (rows[i].getElementsByTagName('td').length === 1) continue; 
                
                const rowText = rows[i].textContent.toLowerCase();
                const categoryCellText = rows[i].getElementsByTagName('td')[3].textContent.toLowerCase(); 

                const matchesSearch = rowText.includes(searchTerm);
                const matchesCategory = categoryTerm === "" || categoryCellText.includes(categoryTerm);

                rows[i].style.display = (matchesSearch && matchesCategory) ? '' : 'none';
            }
        }

        searchInput.addEventListener('keyup', filterTable);
        filterKategori.addEventListener('change', filterTable);
    });

    function resetFilter() {
        document.getElementById('searchInput').value = "";
        document.getElementById('filterKategori').value = "";
        document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
    }
</script>
</body>
</html>