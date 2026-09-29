<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola SKK | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           SIMERAH KOJA - CLEAN NAVY DASHBOARD (KELOLA SKK)
           ========================================================== */

        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;

            --navy: #163a63;
            --navy-dark: #0d2947;
            --navy-light: #eaf1f8;
            --navy-soft: rgba(22, 58, 99, .08);

            --paper: #f5f7fa;
            --white: #ffffff;

            --signal: #dc3545;
            --signal-dark: #b42332;
            --signal-soft: rgba(220, 53, 69, .09);

            --amber: #f4b740;
            --amber-soft: #fef3c7;
            --amber-dark: #d97706;

            --success: #198754;
            --success-soft: #d1fae5;

            --info: #2563eb;
            --info-soft: rgba(37, 99, 235, .09);

            --steel: #64748b;
            --steel-soft: #94a3b8;

            --line: #e2e8f0;
            --line-dark: #d5dce6;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 18px;
            --r-md: 14px;
            --r-sm: 10px;

            --sidebar-w: 272px;
            --topbar-h: 70px;

            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
            --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
            --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
            --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
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
           TOAST / NOTIFICATION
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 2000; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
        .toast.ok .toast-ico { background: var(--success); }
        .toast.err .toast-ico { background: var(--signal); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s, transform .2s; }
        .side-toggle:hover { background: rgba(255,255,255,.10); }
        .side-toggle:active { transform: scale(.95); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); transition: background .2s, border-color .2s; }
        .user-chip:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.18); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
        .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
        .btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }
        .btn-logout:active { transform: scale(.97); }

        /* ==========================================================
           SHELL & SIDEBAR
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
        .side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
        .side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: #ffffff; }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }
        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
        .sidebar-backdrop { display: none; }

        @media (max-width: 991px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
            .sidebar { position: fixed; z-index: 1000; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 990; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           MAIN CONTENT & SKK TABLES
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        
        .page-head { margin-bottom: 26px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

        .content-card {
            background: #ffffff;
            border-radius: var(--r-md);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-xs);
            padding: 0; width: 100%; overflow: hidden;
        }

        /* Nav Tabs Custom */
        .nav-tabs { background-color: var(--paper); border-bottom: 1px solid var(--line); padding: 12px 20px 0 20px; border-radius: var(--r-md) var(--r-md) 0 0; }
        .nav-tabs .nav-link { 
            color: var(--steel); font-weight: 600; font-size: .92rem; border: none; 
            padding: 12px 24px; margin-bottom: -1px; border-bottom: 3px solid transparent; transition: all 0.25s; 
        }
        .nav-tabs .nav-link:hover { color: var(--ink); }
        .nav-tabs .nav-link.active { color: var(--navy); background: transparent; border-bottom: 3px solid var(--navy); font-weight: 700; }
        .tab-content { padding: 24px; }

        /* Tables Custom */
        .table th { background-color: var(--paper); color: var(--steel); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; padding: 16px 14px; border-bottom: 1px solid var(--line); border-top: none; }
        .table td { padding: 16px 14px; vertical-align: middle; font-size: 0.9rem; color: var(--ink); border-bottom: 1px solid var(--line); font-weight: 500; }

        /* Status Badges */
        .badge-status { padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; letter-spacing: 0.3px; }
        .status-pending { background-color: var(--amber-soft); color: var(--amber-dark); }
        .status-diproses { background-color: var(--info-soft); color: var(--info); }
        .status-memenuhi { background-color: var(--success-soft); color: var(--success); }
        .status-tidak-memenuhi { background-color: var(--signal-soft); color: var(--signal); }

        /* Actions/Buttons */
        .btn-add { background-color: var(--navy); color: white; font-weight: 600; font-size: 0.88rem; padding: 10px 22px; border-radius: var(--r-sm); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all .2s ease; border: 1px solid var(--navy); }
        .btn-add:hover { background-color: var(--navy-dark); color: white; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, 0.15); }

        .btn-print-rekap { background-color: white; color: var(--ink); font-weight: 600; font-size: 0.88rem; padding: 10px 22px; border-radius: var(--r-sm); border: 1px solid var(--line-dark); transition: all .2s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: var(--shadow-xs); }
        .btn-print-rekap:hover { background-color: var(--paper); color: var(--ink); transform: translateY(-1px); }

        .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
        .btn-action { 
            display: inline-flex; align-items: center; justify-content: center; 
            width: 100%; padding: 8px 12px; border-radius: 8px; 
            font-weight: 700; font-size: 0.75rem; border: none; text-decoration: none; 
            transition: all 0.2s ease; cursor: pointer;
        }
        .btn-action i { font-size: 0.8rem; }
        .btn-action:hover { filter: brightness(0.95); transform: translateY(-1px); }
        
        .bg-detail { background-color: var(--info-soft); color: var(--info); }
        .bg-status { background-color: var(--success-soft); color: var(--success); }
        .bg-cetak { background-color: var(--paper); color: var(--steel); border: 1px solid var(--line); }
        .bg-edit { background-color: var(--amber-soft); color: var(--amber-dark); }
        .bg-delete { background-color: var(--signal-soft); color: var(--signal); }

        .lampiran-badge { font-size: 0.72rem; padding: 6px 10px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; color: #fff; transition: opacity 0.2s;}
        .lampiran-badge:hover { opacity: 0.9; color: #fff; }
        .lampiran-badge.pdf { background: var(--signal); }
        .lampiran-badge.syarat { background: var(--steel); }
        .lampiran-badge.kosong { background: var(--line-dark); color: var(--steel); opacity: 0.7; }

        /* Modal Customization */
        .modal-content { border-radius: var(--r-lg); border: none; box-shadow: var(--shadow-md); }
        .modal-header { border-bottom: 1px solid var(--line); padding: 20px 24px; }
        .modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); font-size: 1.15rem; }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; }
        .form-select { border-radius: 8px; border: 1px solid var(--line-dark); padding: 10px 14px; font-size: 0.92rem; font-weight: 500; color: var(--ink); transition: border-color 0.2s, box-shadow 0.2s; }
        .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

        /* CSS Print */
        @media print {
            .topbar, .sidebar, .btn-print-rekap, .btn-add, .page-head p, .nav-tabs { display: none !important; }
            .no-print-col { display: none !important; } 
            .shell { display: block; }
            .content { padding: 0 !important; margin: 0 !important; background-color: white; }
            .content-card { border: none; box-shadow: none; padding: 0; }
            body { background-color: white; margin: 0; padding: 0; }
            .page-head h1 { font-size: 18px; text-align: center; margin-bottom: 20px; }
            table { width: 100% !important; border-collapse: collapse; }
            table th, table td { border: 1px solid #000 !important; padding: 8px !important; font-size: 10px !important; }
            .tab-pane { display: block !important; opacity: 1 !important; visibility: visible !important; }
        }
    </style>
</head>
<body>

<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') }}</span>
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
            <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> <span class="d-none d-md-inline">Keluar</span></button>
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
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas</a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}"><i class="fas fa-magnifying-glass-chart"></i> Pencegahan & Inspeksi</a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}"><i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat</a>
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-rectangle"></i> Kelola Redkar</a>
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}"><i class="fas fa-building-circle-check"></i> Kelola RPKBGL</a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}"><i class="fas fa-file-shield"></i> Kelola SKK</a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input data</a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Kelola Data Laporan</a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') ? 'active' : '' }}"><i class="fas fa-folder"></i> Kelola Surat Korban</a>
                </div>
            </details>

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}"><i class="fas fa-user-tie"></i> Data Urut Kepegawaian</a>
                </div>
            </details>

            <!-- BAGIAN SAPRA -->
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam</a>
                    <a href="/sapra/prasarana-mako"><i class="fas fa-building"></i> Prasarana pemadam</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search-location"></i> Pemeriksaan Proteksi</a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-location-dot"></i> Data Hidrant Kota</a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i> Serah terima Barang</a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="far fa-newspaper"></i> Input &amp; Kelola Berita</a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola Info Grafis</a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                </div>
            </details>
        @endif

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ request()->is('internal/profil*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}" class="{{ request()->is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Profil Saya
                </a>
                
                @if(auth()->user()->role === 'super_user')
                    <a href="{{ url('/internal/kelola-user') }}" class="{{ request()->is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i> Kelola Pengguna
                    </a>
                @endif
                
                <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                </a>
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <div class="page-head">
            <div>
                <h1>Daftar Permohonan SKK</h1>
                <p>Kelola pengajuan Sertifikat Keamanan Kebakaran (Baru &amp; Perpanjangan).</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('skk.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah SKK</a>
                <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print"></i> Cetak Rekap</button>
            </div>
        </div>

        <div class="content-card">
            <!-- NAV TABS -->
            <ul class="nav nav-tabs" id="skkTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="baru-tab" data-bs-toggle="tab" data-bs-target="#baru" type="button" role="tab"><i class="fas fa-certificate me-2"></i> SKK Baru</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="perpanjang-tab" data-bs-toggle="tab" data-bs-target="#perpanjang" type="button" role="tab"><i class="fas fa-sync-alt me-2"></i> Perpanjangan SKK</button>
                </li>
            </ul>

            <div class="tab-content" id="skkTabContent">
                
                <!-- ================= TAB 1: SKK BARU ================= -->
                <div class="tab-pane fade show active" id="baru" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pemohon</th>
                                    <th>Usaha &amp; Lokasi</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="no-print-col text-center">Lampiran</th>
                                    <th class="text-center no-print-col" width="160px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skk_baru as $p)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->created_at->format('d M Y') }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--info);">{{ $p->nama_pemohon }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:700;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a><br>
                                        <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="font-size: 0.85rem;">{{ $p->kategori_bangunan }}</div>
                                    </td>
                                    <td>
                                        @if($p->status_permohonan == 'Pending') <span class="badge-status status-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @elseif($p->status_permohonan == 'Diproses') <span class="badge-status status-diproses"><i class="fas fa-spinner"></i> Diproses</span>
                                        @elseif($p->status_permohonan == 'Memenuhi Syarat') <span class="badge-status status-memenuhi"><i class="fas fa-check-circle"></i> Memenuhi</span>
                                        @else <span class="badge-status status-tidak-memenuhi"><i class="fas fa-times-circle"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="no-print-col text-center">
                                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered')
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="lampiran-badge pdf text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="lampiran-badge kosong text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @endif

                                        @if($p->file_persyaratan_lainnya)
                                            <br><a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="lampiran-badge syarat text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @else
                                            <br><a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="lampiran-badge kosong text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @endif
                                    </td>
                                    <td class="no-print-col">
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=baru" class="btn-action bg-detail"><i class="fas fa-search me-1"></i> Detail</a>
                                            <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatusBaru{{ $p->id }}"><i class="fas fa-edit me-1"></i> Status</button>
                                            
                                            <!-- TOMBOL CRUD -->
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('skk.edit', $p->id) }}" class="btn-action bg-edit w-50"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('skk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data permohonan SKK ini?');" class="w-50 m-0">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action bg-delete w-100"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>

                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=baru&auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print me-1"></i> Cetak</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL UPDATE STATUS SKK BARU -->
                                <div class="modal fade" id="modalStatusBaru{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Status SKK Baru</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/internal/pencegahan/kelola-skk/update-status/{{ $p->id }}" method="POST">
                                                @csrf
                                                <div class="modal-body text-start">
                                                    <p class="mb-3 text-muted" style="font-size: 0.9rem;">Ubah status berkas pengajuan <strong>{{ $p->nama_usaha }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="font-size: 0.88rem;">Pilih Status Baru</label>
                                                        <select name="status_permohonan" class="form-select" required>
                                                            <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                            <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                            <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light" style="border-radius: 0 0 var(--r-lg) var(--r-lg);">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3 fw-bold" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background:var(--navy); border:none;"><i class="fas fa-save me-1"></i> Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-folder-open mb-2" style="font-size: 32px; color: var(--line-dark);"></i><br>Belum ada pengajuan SKK Baru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ================= TAB 2: PERPANJANG SKK ================= -->
                <div class="tab-pane fade" id="perpanjang" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pemohon</th>
                                    <th>Usaha &amp; Lokasi</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="no-print-col text-center">Lampiran</th>
                                    <th class="text-center no-print-col" width="160px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skk_perpanjang as $p)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->created_at->format('d M Y') }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--info);">{{ $p->nama_pemohon }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:700;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a><br>
                                        <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="font-size: 0.85rem;">{{ $p->kategori_bangunan }}</div>
                                    </td>
                                    <td>
                                        @if($p->status_permohonan == 'Pending') <span class="badge-status status-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @elseif($p->status_permohonan == 'Diproses') <span class="badge-status status-diproses"><i class="fas fa-spinner"></i> Diproses</span>
                                        @elseif($p->status_permohonan == 'Memenuhi Syarat') <span class="badge-status status-memenuhi"><i class="fas fa-check-circle"></i> Memenuhi</span>
                                        @else <span class="badge-status status-tidak-memenuhi"><i class="fas fa-times-circle"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="no-print-col text-center">
                                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered')
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="lampiran-badge pdf text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="lampiran-badge kosong text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @endif

                                        @if($p->file_persyaratan_lainnya)
                                            <br><a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="lampiran-badge syarat text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @else
                                            <br><a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="lampiran-badge kosong text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @endif
                                    </td>
                                    <td class="no-print-col">
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=perpanjang" class="btn-action bg-detail"><i class="fas fa-search me-1"></i> Detail</a>
                                            <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatusPerpanjang{{ $p->id }}"><i class="fas fa-edit me-1"></i> Status</button>
                                            
                                            <!-- TOMBOL CRUD -->
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('skk.edit', $p->id) }}" class="btn-action bg-edit w-50"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('skk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data permohonan SKK ini?');" class="w-50 m-0">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action bg-delete w-100"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>

                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=perpanjang&auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print me-1"></i> Cetak</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL UPDATE STATUS PERPANJANG SKK -->
                                <div class="modal fade" id="modalStatusPerpanjang{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Status Perpanjangan SKK</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/internal/pencegahan/kelola-perpanjang-skk/update-status/{{ $p->id }}" method="POST">
                                                @csrf
                                                <div class="modal-body text-start">
                                                    <p class="mb-3 text-muted" style="font-size: 0.9rem;">Ubah status berkas perpanjangan <strong>{{ $p->nama_usaha }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="font-size: 0.88rem;">Pilih Status Baru</label>
                                                        <select name="status_permohonan" class="form-select" required>
                                                            <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                            <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                            <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light" style="border-radius: 0 0 var(--r-lg) var(--r-lg);">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3 fw-bold" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background:var(--navy); border:none;"><i class="fas fa-save me-1"></i> Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-folder-open mb-2" style="font-size: 32px; color: var(--line-dark);"></i><br>Belum ada pengajuan Perpanjang SKK.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Notifikasi (Toast) ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- Sidebar Mobile Toggle ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* ---------- Accordion Sidebar Logic ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });
})();
</script>
</body>
</html>