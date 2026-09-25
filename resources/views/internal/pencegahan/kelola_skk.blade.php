<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola SKK | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
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
<<<<<<<<< Temporary merge branch 1
        a { text-decoration: none; color: inherit; }
        button { font: inherit; }
=========
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }
>>>>>>>>> Temporary merge branch 2

        /* ==========================================================
           NOTIFIKASI (TOAST)
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast {
            display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px;
            border-radius: 999px; background: #fff; border: 1px solid var(--line);
            box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem;
            animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
        }
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
        .topbar {
            position: sticky; top: 0; z-index: 60; height: var(--topbar-h);
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
           SHELL: SIDEBAR + KONTEN
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
                position: fixed; z-index: 90; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           KONTEN UTAMA & TABEL KELOLA
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

        .page-head { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .98rem; }

        .content-card {
            background: #fff; border-radius: var(--r-lg); border: 1px solid var(--line);
            padding: 0; box-shadow: var(--shadow-sm); width: 100%; overflow: hidden;
        }

        /* Nav Tabs Custom */
        .nav-tabs { background-color: var(--paper); border-bottom: 2px solid var(--line); padding: 10px 20px 0 20px; }
        .nav-tabs .nav-link { color: var(--steel); font-weight: 700; font-size: 0.9rem; border: none; padding: 12px 25px; margin-bottom: -2px; border-bottom: 3px solid transparent; transition: all 0.2s; }
        .nav-tabs .nav-link:hover { color: var(--ink); border-color: var(--steel-soft); }
        .nav-tabs .nav-link.active { color: var(--info); background: transparent; border-bottom: 3px solid var(--info); }
        .tab-content { padding: 25px; }

        .table th { background-color: var(--paper); color: var(--navy); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; padding: 15px 12px; border-bottom: 2px solid var(--line); }
        .table td { padding: 15px 12px; vertical-align: middle; font-size: 0.92rem; color: var(--ink); border-bottom: 1px solid var(--line); }

        .badge-status { padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 700; display: inline-block; }
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-diproses { background-color: #dbeafe; color: #2563eb; }
        .status-memenuhi { background-color: #d1fae5; color: #059669; }
        .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }

        .btn-add { background-color: var(--success); color: white; font-weight: 700; font-size: 0.88rem; padding: 10px 20px; border-radius: 999px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: background .2s; }
        .btn-add:hover { background-color: #059669; color: white; }

        .btn-print-rekap { background-color: var(--info); color: white; font-weight: 700; font-size: 0.88rem; padding: 10px 20px; border-radius: 999px; border: none; transition: background .2s; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; }
        .btn-print-rekap:hover { background-color: #1d55c7; color: white; }

        .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
        .btn-action { 
            display: inline-flex; align-items: center; justify-content: center; 
            width: 100%; padding: 7px 10px; border-radius: 8px; 
            font-weight: 700; font-size: 0.78rem; border: none; text-decoration: none; 
            transition: all 0.2s; cursor: pointer; color: white;
        }
        .btn-action i { font-size: 0.78rem; }
        .btn-action:hover { opacity: 0.9; color: white; transform: translateY(-1px); }
        .bg-detail { background-color: var(--info); }
        .bg-status { background-color: var(--success); }
        .bg-cetak { background-color: var(--steel); }

        /* CSS Print */
        @media print {
            .topbar, .sidebar, .btn-print-rekap, .btn-logout, .page-head p, .nav-tabs, .btn-add { display: none !important; }
            .no-print-col { display: none !important; } 
            .shell { display: block; }
            .content { padding: 0 !important; margin: 0 !important; background-color: white; }
            .content-card { border: none; box-shadow: none; padding: 0; }
            body { background-color: white; margin: 0; padding: 0; }
            .page-head h1 { font-size: 18px; text-align: center; margin-bottom: 20px; }
            table { width: 100% !important; border-collapse: collapse; }
            table th, table td { border: 1px solid #000 !important; padding: 8px !important; font-size: 10px !important; }
>>>>>>>>> Temporary merge branch 2
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
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input Data
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Data Laporan
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
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
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i> Sarana Penyelamatan &amp; Evakuasi
                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i> Sarana Pemeriksaan Proteksi Kebakaran
                    </a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i> Kelola Data Pos
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}">
                        <i class="fas fa-droplet"></i> Sumber Air
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}">
                        <i class="fas fa-map-location-dot"></i> Data Hidrant Kota Jambi
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik &amp; Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box"></i> Distribusi Barang Staff
                    </a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i> Input &amp; Kelola Berita
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i> Kelola Info Grafis
                    </a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                        <i class="fab fa-instagram"></i> Kelola Berita Medsos
                    </a>
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Profil Saya
                </a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i> Kelola Semua Pengguna
                    </a>
                    <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                    </a>
                @endif
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
                <button onclick="window.print()" class="btn-print-rekap shadow-sm"><i class="fas fa-print me-2"></i>Cetak Rekap</button>
            </div>
        </div>

        <div class="content-card">
            <!-- NAV TABS UNTUK MEMISAHKAN SKK BARU DAN PERPANJANG -->
            <ul class="nav nav-tabs" id="skkTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="baru-tab" data-bs-toggle="tab" data-bs-target="#baru" type="button" role="tab"><i class="fas fa-certificate me-2"></i>SKK Baru</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="perpanjang-tab" data-bs-toggle="tab" data-bs-target="#perpanjang" type="button" role="tab"><i class="fas fa-sync-alt me-2"></i>Perpanjangan SKK</button>
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
                                        <div class="fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $p->nama_pemohon }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:600;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a><br>
                                        <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $p->kategori_bangunan }}</div>
                                    </td>
                                    <td>
                                        @if($p->status_permohonan == 'Pending') <span class="badge-status status-pending">Pending</span>
                                        @elseif($p->status_permohonan == 'Diproses') <span class="badge-status status-diproses">Diproses</span>
                                        @elseif($p->status_permohonan == 'Memenuhi Syarat') <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                                        @else <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi</span>
                                        @endif
                                    </td>
                                    <td class="no-print-col text-center">
                                        <!-- Tombol Surat: Selalu ada, jika kosong/offline_registered memunculkan alert "Lampiran Kosong" -->
                                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered')
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="badge bg-danger text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="badge bg-secondary text-decoration-none mb-1" style="opacity: 0.65;"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @endif

                                        <!-- Tombol Syarat: Selalu ada, jika kosong memunculkan alert "Lampiran Kosong" -->
                                        @if($p->file_persyaratan_lainnya)
                                            <br><a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="badge bg-secondary text-decoration-none"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @else
                                            <br><a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="badge bg-secondary text-decoration-none" style="opacity: 0.65;"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @endif
                                    </td>
                                    <td class="no-print-col">
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=baru" class="btn-action bg-detail"><i class="fas fa-search me-1"></i> Detail</a>
                                            <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatusBaru{{ $p->id }}"><i class="fas fa-edit me-1"></i> Status</button>
                                            
                                            <!-- TOMBOL CRUD (EDIT & HAPUS) -->
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('skk.edit', $p->id) }}" class="btn-action flex-grow-1" style="background-color: var(--amber); color: var(--ink);"><i class="fas fa-pencil-alt me-1"></i> Edit</a>
                                                <form action="{{ route('skk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data permohonan SKK ini?');" style="flex-grow: 1; margin:0;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action w-100" style="background-color: var(--signal);"><i class="fas fa-trash me-1"></i> Hapus</button>
>>>>>>>>> Temporary merge branch 2
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
                                                <h5 class="modal-title fw-bold" style="font-size: 16px;">Update Status SKK Baru</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/internal/pencegahan/kelola-skk/update-status/{{ $p->id }}" method="POST">
                                                @csrf
                                                <div class="modal-body text-start">
                                                    <p class="mb-3 text-muted" style="font-size: 13px;">Ubah status berkas pengajuan <strong>{{ $p->nama_usaha }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="font-size: 13px;">Pilih Status Baru</label>
                                                        <select name="status_permohonan" class="form-select" required>
                                                            <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                            <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                            <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-folder-open mb-2" style="font-size: 30px; color:#cbd5e1;"></i><br>Belum ada pengajuan SKK Baru.</td>
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
                                    <th class="text-center no-print-col" width="140px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skk_perpanjang as $p)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $p->nama_pemohon }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:600;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a><br>
                                        <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $p->kategori_bangunan }}</div>
                                    </td>
                                    <td>
                                        @if($p->status_permohonan == 'Pending') <span class="badge-status status-pending">Pending</span>
                                        @elseif($p->status_permohonan == 'Diproses') <span class="badge-status status-diproses">Diproses</span>
                                        @elseif($p->status_permohonan == 'Memenuhi Syarat') <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                                        @else <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi</span>
                                        @endif
                                    </td>
                                    <td class="no-print-col text-center">
                                        <!-- Tombol Surat: Selalu ada, jika kosong memunculkan alert "Lampiran Kosong" -->
                                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered')
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="badge bg-danger text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="badge bg-secondary text-decoration-none mb-1" style="opacity: 0.65;"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @endif

                                        <!-- Tombol Syarat: Selalu ada, jika kosong memunculkan alert "Lampiran Kosong" -->
                                        @if($p->file_persyaratan_lainnya)
                                            <br><a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="badge bg-secondary text-decoration-none"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @else
                                            <br><a href="javascript:void(0);" onclick="alert('Lampiran Kosong');" class="badge bg-secondary text-decoration-none" style="opacity: 0.65;"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @endif
                                    </td>
                                    <td class="no-print-col">
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=perpanjang" class="btn-action bg-detail"><i class="fas fa-search me-1"></i> Detail</a>
                                            <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatusPerpanjang{{ $p->id }}"><i class="fas fa-edit me-1"></i> Status</button>
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=perpanjang&auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print me-1"></i> Cetak</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL UPDATE STATUS PERPANJANG SKK -->
                                <div class="modal fade" id="modalStatusPerpanjang{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" style="font-size: 16px;">Update Status Perpanjangan SKK</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/internal/pencegahan/kelola-perpanjang-skk/update-status/{{ $p->id }}" method="POST">
                                                @csrf
                                                <div class="modal-body text-start">
                                                    <p class="mb-3 text-muted" style="font-size: 13px;">Ubah status berkas perpanjangan <strong>{{ $p->nama_usaha }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="font-size: 13px;">Pilih Status Baru</label>
                                                        <select name="status_permohonan" class="form-select" required>
                                                            <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                            <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                            <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-folder-open mb-2" style="font-size: 30px; color:#cbd5e1;"></i><br>Belum ada pengajuan Perpanjang SKK.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
>>>>>>>>> Temporary merge branch 2
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
(function () {
    'use strict';

    /* ---------- Notifikasi ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- Sidebar (mobile) ---------- */
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

    /* ---------- Hanya satu grup sidebar terbuka pada satu waktu ---------- */
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>