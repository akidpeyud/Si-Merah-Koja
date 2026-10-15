@extends('layouts.dashboard')

@section('content')
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>{{ $judulKategori ?? 'Produk Hukum' }} | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           SIMERAH KOJA - CLEAN NAVY DASHBOARD
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
            --success: #198754;
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

            --sidebar-w: 288px;
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
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
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
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
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
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

        .side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
        .side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
        .side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: #ffffff; }

        .lbl { flex: 1 1 auto; min-width: 0; overflow-wrap: break-word; line-height: 1.4; }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
        .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 0 10px 8px; border-left: 2px solid var(--line); margin: 2px 0 8px 18px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; flex: none; margin-top: 3px; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }
        
        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
            .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           MAIN CONTENT
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

        /* Card Container */
        .card-container { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 26px; box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease; }
        .card-container:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
        
        /* Table Customization */
        .table { margin-bottom: 0; }
        .table th { white-space: nowrap; font-size: 0.85rem; text-transform: uppercase; color: var(--steel-soft); font-family: var(--font-body); font-weight: 700; letter-spacing: .02em; border-bottom: 2px solid var(--line-dark); background-color: #fcfdfe; }
        .table td { font-size: 0.9rem; vertical-align: middle; border-color: var(--line); }
        .table-hover tbody tr:hover { background-color: #f8fafc; }

        /* Button Customization */
        .btn-tambah { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 42px; padding: 0 20px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s ease; }
        .btn-tambah:hover { background: var(--navy-dark); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
        .btn-tambah:active { transform: translateY(0); }
        
        /* Custom Badges */
        .badge { padding: 6px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
        .badge-navy { background-color: var(--navy-soft); color: var(--navy); }

        /* Search Box */
        .search-wrap { position: relative; max-width: 340px; width: 100%; }
        .search-wrap input { padding-left: 38px; border-radius: 8px; border: 1px solid var(--line-dark); font-size: .9rem; height: 40px; }
        .search-wrap input:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        .search-wrap i { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .88rem; }

        /* Modal Preview Customization */
        .modal-content { border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); overflow: hidden; }
        .modal-header { background: var(--ink); color: #fff; padding: 16px 22px; border-bottom: 1px solid rgba(255,255,255,.08); }
        .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; }
        .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

        /* PDF Canvas Viewer Container */
        .pdf-viewer-body {
            height: 75vh;
            overflow-y: auto;
            background: #334155;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }
        .pdf-page-canvas {
            max-width: 100%;
            height: auto !important;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .35);
        }
    </style>
</head>
<body>

<!-- TOAST NOTIFICATION -->
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
    @if ($errors->any())
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>Gagal memproses data. Silakan periksa kembali.</span>
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
                <small>{{ Auth::user()->role ?? '' }}</small>
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

    <!-- ==================== SIDEBAR TERBARU ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">

        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i><span class="lbl">Dashboard utama</span>
        </a>

        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')

            <div class="side-kicker">Modul operasional</div>

            <!-- BAGIAN PENCEGAHAN -->
            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-trend-up"></i><span class="lbl">Peningkatan Kapasitas Aparatur</span>
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass-chart"></i><span class="lbl">Pencegahan Kebakaran dan Inspeksi</span>
                    </a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}">
                        <i class="fas fa-handshake-angle"></i><span class="lbl">Pemberdayaan Masyarakat dan Dunia Usaha</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-edukasi" class="{{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i><span class="lbl">Kelola Edukasi</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-redkar" class="{{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Redkar</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="{{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}">
                        <i class="fas fa-building-circle-check"></i><span class="lbl">Kelola RPKBGL</span>
                    </a>
                    <a href="/internal/pencegahan/kelola-skk" class="{{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}">
                        <i class="fas fa-file-shield"></i><span class="lbl">Kelola SKK</span>
                    </a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">

                    @php
                        $aksesMenuRekap = false;
                        if (method_exists(Auth::user(), 'hasAnyRole')) {
                            $aksesMenuRekap = Auth::user()->hasAnyRole(['Damtan', 'Super User']);
                        }
                    @endphp

                    @if($aksesMenuRekap)
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i><span class="lbl">Input Rekap Layanan</span>
                    </a>
                    <a href="/internal/damtan/rekap-objek" class="{{ Request::is('internal/damtan/rekap-objek*') ? 'active' : '' }}">
                        <i class="fas fa-house-chimney-crack"></i><span class="lbl">Input Rekap Objek Kebakaran</span>
                    </a>
                    @endif

                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span>
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i><span class="lbl">Kelola Surat Korban</span>
                    </a>
                    <a href="{{ route('internal.izin-keramaian.index') }}" class="{{ Request::is('internal/damtan/kelola-izin-keramaian*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span>
                    </a>
                    <a href="{{ route('internal.penggunaan-sarana.index') }}" class="{{ Request::is('internal/damtan/kelola-penggunaan-sarana*') ? 'active' : '' }}">
                        <i class="fas fa-truck-droplet"></i><span class="lbl">Kelola Penggunaan Sarana</span>
                    </a>
                </div>
            </details>

            <!-- BAGIAN SAPRA -->
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i><span class="lbl">Sarana pemadam kebakaran</span>
                    </a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i><span class="lbl">Prasarana pemadam kebakaran</span>
                    </a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i><span class="lbl">Sarana Penyelamatan &amp; Evakuasi</span>
                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i><span class="lbl">Sarana Pemeriksaan Proteksi Kebakaran</span>
                    </a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i><span class="lbl">Kelola Data Pos</span>
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}">
                        <i class="fas fa-droplet"></i><span class="lbl">Sumber Air</span>
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}">
                        <i class="fas fa-map-location-dot"></i><span class="lbl">Data Hidrant Kota Jambi</span>
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik &amp; Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i><span class="lbl">Mutu Baku Kebutuhan</span>
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box"></i><span class="lbl">Serah terima Barang</span>
                    </a>
                </div>
            </details>

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') || Request::is('internal/program-kerja*') || Request::is('internal/data-asn*') || Request::is('dokumen-publik*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i><span class="lbl">Data Urut Kepegawaian</span>
                    </a>
                    <a href="/internal/data-asn" class="{{ Request::is('internal/data-asn*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i><span class="lbl">Rekap Data ASN</span>
                    </a>
                    <a href="/internal/program-kerja" class="{{ Request::is('internal/program-kerja*') ? 'active' : '' }}">
                        <i class="fas fa-file-contract"></i><span class="lbl">SOP &amp; Dokumen</span>
                    </a>
                    <a href="{{ route('dokumen-publik.index') }}" class="{{ Request::is('dokumen-publik*') ? 'active' : '' }}">
                        <i class="fas fa-file-lines"></i><span class="lbl">Dokumen Publik</span>
                    </a>
                </div>
            </details>
        @endhasanyrole

        <!-- MANAJEMEN INFORMASI: semua pegawai internal bisa melihat menu ini -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('internal/peta-sigap*') || Request::is('internal/produk-hukum*') || Request::is('internal/profil-instansi*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i><span class="lbl">Kelola Berita</span>
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i><span class="lbl">Kelola Infografis</span>
                    </a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                        <i class="fab fa-instagram"></i><span class="lbl">Kelola Berita Medsos</span>
                    </a>
                    <a href="/internal/operator/ujung-damkar" class="{{ Request::is('internal/operator/ujung-damkar*') ? 'active' : '' }}">
                        <i class="fab fa-youtube"></i><span class="lbl">Ujung-Ujung Damkar</span>
                    </a>
                    <a href="/internal/operator/edu-damkar" class="{{ Request::is('internal/operator/edu-damkar*') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i><span class="lbl">Edu Damkar</span>
                    </a>
                    <a href="/internal/operator/pengumuman" class="{{ Request::is('internal/operator/pengumuman*') || Request::is('internal/operator/opratorpengumuman*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i><span class="lbl">Kelola Pengumuman</span>
                    </a>

                    <!-- PRODUK HUKUM -->
                    <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PRODUK HUKUM</div>
                    <a href="/internal/produk-hukum/undang-undang" class="{{ Request::is('internal/produk-hukum/undang-undang*') ? 'active' : '' }}">
                        <i class="fas fa-scale-balanced"></i><span class="lbl">Undang-Undang</span>
                    </a>
                    <a href="/internal/produk-hukum/peraturan-pemerintah" class="{{ Request::is('internal/produk-hukum/peraturan-pemerintah*') ? 'active' : '' }}">
                        <i class="fas fa-landmark"></i><span class="lbl">Peraturan Pemerintah</span>
                    </a>
                    <a href="/internal/produk-hukum/peraturan-menteri" class="{{ Request::is('internal/produk-hukum/peraturan-menteri*') ? 'active' : '' }}">
                        <i class="fas fa-book-bookmark"></i><span class="lbl">Peraturan Menteri</span>
                    </a>
                    <a href="/internal/produk-hukum/peraturan-daerah" class="{{ Request::is('internal/produk-hukum/peraturan-daerah*') ? 'active' : '' }}">
                        <i class="fas fa-file-shield"></i><span class="lbl">Peraturan Daerah</span>
                    </a>
                    <a href="/internal/produk-hukum/peraturan-kepala-daerah" class="{{ Request::is('internal/produk-hukum/peraturan-kepala-daerah*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i><span class="lbl">Peraturan Kepala Daerah</span>
                    </a>

                    <!-- PROFIL -->
                    <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PROFIL</div>
                    <a href="/internal/profil-instansi/visi-misi" class="{{ Request::is('internal/profil-instansi/visi-misi*') ? 'active' : '' }}">
                        <i class="fas fa-bullseye"></i><span class="lbl">Visi Misi</span>
                    </a>
                    <a href="/internal/profil-instansi/sotk" class="{{ Request::is('internal/profil-instansi/sotk*') ? 'active' : '' }}">
                        <i class="fas fa-sitemap"></i><span class="lbl">SOTK</span>
                    </a>
                    <a href="/internal/profil-instansi/tupoksi" class="{{ Request::is('internal/profil-instansi/tupoksi*') ? 'active' : '' }}">
                        <i class="fas fa-list-check"></i><span class="lbl">Tupoksi</span>
                    </a>
                    <a href="/internal/profil-instansi/kepegawaian" class="{{ Request::is('internal/profil-instansi/kepegawaian*') ? 'active' : '' }}">
                        <i class="fas fa-id-card-clip"></i><span class="lbl">Kepegawaian</span>
                    </a>
                    <a href="/internal/profil-instansi/program-kegiatan" class="{{ Request::is('internal/profil-instansi/program-kegiatan*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i><span class="lbl">Program Kegiatan</span>
                    </a>
                    <a href="/internal/profil-instansi/cascading" class="{{ Request::is('internal/profil-instansi/cascading*') ? 'active' : '' }}">
                        <i class="fas fa-diagram-project"></i><span class="lbl">Cascading</span>
                    </a>

                    <!-- PEMETAAN SIGAP -->
                    <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PEMETAAN SIGAP</div>
                    @hasanyrole('Super User|Operator')
                    <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                    </a>
                    @endhasanyrole

                    <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
                        <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                    </a>
                </div>
            </details>
        @endhasanyrole

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ request()->is('internal/profil') || request()->is('internal/profil/*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}" class="{{ request()->is('internal/profil') || request()->is('internal/profil/*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i><span class="lbl">Profil Saya</span>
                </a>

                @hasrole('Super User')
                    <a href="{{ url('/internal/kelola-user') }}" class="{{ request()->is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i><span class="lbl">Kelola Pengguna</span>
                    </a>
                    <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span>
                    </a>
                @endhasrole
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div class="page-head mb-0">
                <h1>{{ $judulKategori }}</h1>
                <p>Manajemen dokumen dan arsip publik {{ strtolower($judulKategori) }} Disdamkartan Kota Jambi.</p>
            </div>
            
            <!-- Pembatasan akses CRUD Create: Hanya Super User & Operator -->
            @hasanyrole('Super User|Operator')
            <a href="{{ route('internal.produk-hukum.create', $kategori) }}" class="btn-tambah text-decoration-none">
                <i class="fas fa-plus me-1"></i> Tambah {{ $judulKategori }}
            </a>
            @endhasanyrole
        </div>

        <div class="card-container">
            <!-- Baris Pencarian & Info -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <form action="{{ route('internal.produk-hukum.index', $kategori) }}" method="GET" class="search-wrap">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nomor, tahun, atau judul..." value="{{ request('search') }}">
                </form>

                <div class="text-muted small fw-medium">
                    Total: <strong class="text-dark">{{ $data->total() }}</strong> dokumen
                </div>
            </div>

            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="18%">Nomor Peraturan</th>
                            <th class="text-center" width="10%">Tahun</th>
                            <th>Judul / Tentang</th>
                            <th width="20%">Keterangan</th>
                            <th class="text-center" width="18%">Dokumen</th>
                            @hasanyrole('Super User|Operator')
                            <th class="text-center" width="10%">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="text-center fw-bold text-secondary">{{ $data->firstItem() + $index }}</td>
                            <td class="fw-bold">{{ $item->nomor ?: '-' }}</td>
                            <td class="text-center">
                                @if($item->tahun)
                                    <span class="badge badge-navy">{{ $item->tahun }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="fw-semibold" style="min-width: 240px; white-space: normal;">{{ $item->judul }}</td>
                            <td class="text-muted" style="min-width: 180px; white-space: normal;">{{ $item->keterangan ?: '-' }}</td>
                            
                            <!-- Kolom Dokumen: Tombol Lihat & Unduh Seragam (Semua Role Bisa Mengakses) -->
                            <td class="text-center" style="white-space: nowrap;">
                                @if($item->file_dokumen)
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <!-- Tombol Lihat (Buka Modal Pratinjau PDF tanpa terdownload) -->
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-success btn-preview-pdf d-inline-flex align-items-center gap-1" 
                                                style="border-radius: 6px; font-weight: 600;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalPreviewPdf"
                                                data-judul="{{ $item->judul }}"
                                                data-url="{{ route('internal.produk-hukum.view-file', [$kategori, $item->id]) }}?raw=1"
                                                data-download="{{ route('internal.produk-hukum.download-file', [$kategori, $item->id]) }}"
                                                title="Lihat Pratinjau PDF">
                                            <i class="fas fa-eye"></i> <span>Lihat</span>
                                        </button>

                                        <!-- Tombol Unduh PDF -->
                                        <a href="{{ route('internal.produk-hukum.download-file', [$kategori, $item->id]) }}" 
                                           class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1" 
                                           style="border-radius: 6px; font-weight: 600;"
                                           title="Unduh PDF">
                                            <i class="fas fa-download"></i> <span>Unduh</span>
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted small">Tidak ada file</span>
                                @endif
                            </td>
                            
                            <!-- Pembatasan Aksi Edit & Hapus: Hanya Super User & Operator -->
                            @hasanyrole('Super User|Operator')
                            <td class="text-center" style="white-space: nowrap;">
                                <a href="{{ route('internal.produk-hukum.edit', [$kategori, $item->id]) }}" 
                                   class="btn btn-sm btn-outline-primary" 
                                   style="border-radius: 6px;" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('internal.produk-hukum.destroy', [$kategori, $item->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;" title="Hapus" onclick="return confirm('Yakin ingin menghapus dokumen {{ addslashes($item->judul) }}?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@hasanyrole('Super User|Operator') 7 @else 6 @endhasanyrole" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open mb-3" style="font-size: 2.5rem; color: var(--steel-soft); opacity: 0.7;"></i><br>
                                    Belum ada data dokumen {{ strtolower($judulKategori) }}.
                                    @hasanyrole('Super User|Operator')
                                    Silakan tambah data baru.
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($data->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </main>
</div>

<!-- ==================== MODAL PREVIEW PDF (RENDER CANVAS ANTI AUTO-DOWNLOAD) ==================== -->
<div class="modal fade" id="modalPreviewPdf" tabindex="-1" aria-labelledby="modalPreviewPdfLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-truncate pe-3" id="modalPreviewPdfLabel">
                    <i class="fas fa-file-pdf me-2 text-danger"></i><span id="previewJudul">Pratinjau Dokumen</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0">
                <div id="pdfViewerContainer" class="pdf-viewer-body">
                    <div id="pdfLoadingState" class="text-white my-auto text-center py-5">
                        <div class="spinner-border text-light mb-3" role="status"></div>
                        <div>Memuat pratinjau dokumen PDF...</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 d-flex justify-content-between align-items-center">
                <span class="text-muted small" id="pdfPageInfo"></span>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Tutup</button>
                    <a href="#" id="previewDownloadBtn" class="btn-tambah text-decoration-none">
                        <i class="fas fa-download me-1"></i> Unduh PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- PDF.js Library untuk merender PDF ke Canvas tanpa memicu IDM / Auto-Download -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
(function () {
    'use strict';

    if (window.pdfjsLib) {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

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

    /* ---------- Sidebar (mobile) ---------- */
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

    /* ---------- Accordion Sidebar Logic ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });

    /* ---------- Render PDF via PDF.js (JSON Base64 Anti-IDM) ---------- */
    var modalPreview = document.getElementById('modalPreviewPdf');
    var viewerContainer = document.getElementById('pdfViewerContainer');
    var previewJudul = document.getElementById('previewJudul');
    var previewDownloadBtn = document.getElementById('previewDownloadBtn');
    var pdfPageInfo = document.getElementById('pdfPageInfo');

    function renderPdfToContainer(url) {
        if (!viewerContainer) return;
        viewerContainer.innerHTML = '<div class="text-white my-auto text-center py-5"><div class="spinner-border text-light mb-3" role="status"></div><div>Memuat pratinjau dokumen PDF...</div></div>';
        if (pdfPageInfo) pdfPageInfo.textContent = '';

        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
            .then(function (res) {
                if (!res.ok) throw new Error('Gagal mengambil dokumen');
                return res.json();
            })
            .then(function (json) {
                var binaryString = window.atob(json.base64);
                var len = binaryString.length;
                var bytes = new Uint8Array(len);
                for (var i = 0; i < len; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }
                return window.pdfjsLib.getDocument({ data: bytes }).promise;
            })
            .then(function (pdf) {
                viewerContainer.innerHTML = '';
                if (pdfPageInfo) pdfPageInfo.textContent = 'Total: ' + pdf.numPages + ' halaman';

                for (var pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    (function (num) {
                        var canvas = document.createElement('canvas');
                        canvas.className = 'pdf-page-canvas';
                        viewerContainer.appendChild(canvas);

                        pdf.getPage(num).then(function (page) {
                            var viewport = page.getViewport({ scale: 1.4 });
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            page.render({
                                canvasContext: context,
                                viewport: viewport
                            });
                        });
                    })(pageNum);
                }
            })
            .catch(function () {
                viewerContainer.innerHTML = '<div class="text-white my-auto text-center py-5"><i class="fas fa-triangle-exclamation fs-2 text-warning mb-2"></i><div>Gagal memuat pratinjau PDF. Silakan gunakan tombol Unduh PDF di bawah.</div></div>';
            });
    }

    document.querySelectorAll('.btn-preview-pdf').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var url = btn.getAttribute('data-url');
            var downloadUrl = btn.getAttribute('data-download');
            var judul = btn.getAttribute('data-judul');

            if (previewJudul) previewJudul.textContent = judul || 'Pratinjau Dokumen';
            if (previewDownloadBtn) previewDownloadBtn.href = downloadUrl;

            renderPdfToContainer(url);
        });
    });

    if (modalPreview) {
        modalPreview.addEventListener('hidden.bs.modal', function () {
            if (viewerContainer) viewerContainer.innerHTML = '';
            if (pdfPageInfo) pdfPageInfo.textContent = '';
        });
    }
})();
</script>
</body>
</html>