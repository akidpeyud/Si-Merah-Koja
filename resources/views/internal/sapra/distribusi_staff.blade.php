<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Distribusi Barang Staff | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & BASE
           ========================================================== */
        :root {
            --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
            --paper: #f3f5f8; --white: #ffffff;
            --signal: #e5392d; --signal-d: #c22b20; --amber: #ffb627;
            --green: #16a34a; --blue: #2563eb; --steel: #5b6c7f; --line: #dbe2ea;
            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
            --r-lg: 22px; --r-md: 16px; --r-sm: 10px;
            --sidebar-w: 272px; --topbar-h: 66px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; overflow: hidden; }
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        table { border-collapse: collapse; width: 100%; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

        /* ==========================================================
           TOAST (ALERT SUCCESS)
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: 0 20px 40px -16px rgba(13,27,42,.5); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; background: var(--green); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 20px 0 clamp(16px, 2vw, 24px); background: rgba(255,255,255,.85); -webkit-backdrop-filter: blur(14px); backdrop-filter: blur(14px); border-bottom: 1px solid var(--line); border-top: 4px solid #10b981; }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.05rem; letter-spacing: -0.01em; white-space: nowrap; }
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 14px 6px 6px; border-radius: 999px; background: var(--paper); }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .85rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; font-size: .85rem; transition: background .2s; }
        .btn-logout:hover { background: var(--signal-d); }
        @media (max-width: 900px) { .side-toggle { display: inline-flex; } .user-meta { display: none; } }

        /* ==========================================================
           SHELL: SIDEBAR + KONTEN
           ========================================================== */
        .shell { display: flex; align-items: flex-start; height: calc(100vh - var(--topbar-h)); overflow: hidden; }
        .sidebar { width: var(--sidebar-w); flex: none; height: 100%; overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }
        .side-link { display: flex; align-items: center; gap: 13px; padding: 12px 14px; border-radius: 13px; font-size: .87rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s; }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 18px; text-align: center; font-size: .95rem; color: var(--steel); }
        .side-link.active i { color: var(--amber); }
        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 10px; padding: 12px 14px; border-radius: 13px; font-size: .78rem; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); transition: background .2s, color .2s; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); color: var(--ink); }
        .side-group[open] > summary { color: var(--signal-d); }
        .side-group summary .chev { margin-left: auto; font-size: .68rem; transition: transform .2s; }
        .side-group[open] summary .chev { transform: rotate(180deg); }
        .side-sub { display: grid; gap: 2px; padding: 4px 2px 8px 10px; border-left: 2px solid var(--line); margin: 2px 0 4px 22px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 11px; padding: 9px 12px; border-radius: 11px; font-size: .82rem; font-weight: 600; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s; }
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
        .side-sub a.active { background: #fdeceb; color: var(--signal-d); }
        .side-sub a i { width: 16px; text-align: center; font-size: .85rem; margin-top: 2px; }
        .side-kicker { padding: 14px 12px 4px; font-size: .68rem; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; color: #a9b6c4; }
        .side-divider { height: 1px; background: var(--line); margin: 10px 10px; }
        .sidebar-backdrop { display: none; }
        @media (max-width: 900px) {
            .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: 24px 0 48px -24px rgba(13,27,42,.4); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        .content { flex: 1; min-width: 0; height: 100%; overflow-y: auto; padding: clamp(20px, 3vw, 36px) clamp(18px, 3vw, 40px) 60px; }

        /* ==========================================================
           TOOLBAR HALAMAN
           ========================================================== */
        .page-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .page-toolbar h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.5rem, 3vw, 1.9rem); line-height: 1.15; letter-spacing: -0.02em; }
        .page-toolbar p { margin-top: 4px; color: var(--steel); font-size: .92rem; }
        .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }

        .search { position: relative; width: 260px; max-width: 100%; }
        .search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .search input { width: 100%; height: 42px; padding: 0 14px 0 40px; border-radius: 999px; border: 1.5px solid var(--line); background: #fff; font: inherit; font-size: .88rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .search input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.4); }

        .btn { display: inline-flex; align-items: center; gap: 8px; height: 42px; padding: 0 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; transition: background .2s, transform .2s; white-space: nowrap; }
        .btn:active { transform: scale(.97); }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: #1d4fd6; }
        .btn-outline { background: #fff; border: 1.5px solid var(--line); color: var(--ink); }
        .btn-outline:hover { border-color: var(--ink); }
        .btn-outline.red { color: var(--signal); border-color: var(--signal); }
        .btn-outline.red:hover { background: var(--signal); color: #fff; }

        .btn-xs { height: 32px; padding: 0 14px; font-size: .75rem; }

        /* ==========================================================
           TABEL GROUPED (TREE-VIEW)
           ========================================================== */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; margin-top: 10px; }
        .table-scroll { overflow-x: auto; }
        .data-table { font-size: .85rem; min-width: 800px; }
        .data-table thead th { background: var(--ink); color: #fff; padding: 14px 16px; font-weight: 700; font-size: .7rem; letter-spacing: .04em; text-transform: uppercase; text-align: left; white-space: nowrap; position: sticky; top: 0; z-index: 10;}
        .data-table thead th.c { text-align: center; }
        
        /* Baris Kelompok (Nama Staff) */
        .staff-group { border-bottom: 4px solid var(--paper); }
        .staff-header td { background: #f8fafc; border-bottom: 2px solid var(--line); border-top: 1px solid var(--line); padding: 14px 16px; vertical-align: middle; }
        .staff-header .c { text-align: center; }
        .staff-info { display: flex; align-items: center; justify-content: space-between; }
        .staff-info-left { display: flex; align-items: center; gap: 12px; }
        .staff-icon { width: 34px; height: 34px; border-radius: 50%; background: var(--blue); color: #fff; display: grid; place-items: center; font-size: .85rem; }
        .staff-name { font-weight: 800; font-size: 1rem; color: var(--ink); text-transform: uppercase; letter-spacing: 0.5px; }
        .staff-count { background: #eff6ff; color: var(--blue); padding: 4px 10px; border-radius: 999px; font-size: .75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; }
        
        /* Baris Detail (Barang) */
        .data-table tbody.staff-group tr.data-row td { padding: 14px 16px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); transition: background .2s; }
        .data-table tbody.staff-group tr.data-row:hover td { background: var(--paper); }
        .data-table tbody.staff-group tr.data-row:last-child td { border-bottom: none; }
        .data-table tr.data-row td.c { text-align: center; }
        .tree-line { border-right: 2px solid var(--line); background: #f8fafc !important; }

        .chip-barang { display: inline-block; background: #e0f2fe; color: #0284c7; padding: 6px 12px; border-radius: 6px; font-weight: 800; border: 1px solid #bae6fd; font-size: .8rem; }
        .detail-txt { font-size: .75rem; color: var(--steel); font-weight: 600; margin-top: 6px; }
        .time-date { font-weight: 700; color: var(--ink); }
        .time-clock { font-size: .75rem; color: var(--steel); font-weight: 600; margin-top: 4px; }
        .ket-txt { font-size: .8rem; color: var(--steel); font-weight: 500; }

        .cell-empty { text-align: center; padding: 48px 16px; color: var(--steel); font-weight: 600; }

        .row-actions { display: inline-flex; gap: 6px; justify-content: center;}
        .icon-btn { width: 32px; height: 32px; border-radius: 9px; display: inline-grid; place-items: center; font-size: .82rem; color: #fff; transition: filter .2s, transform .2s; }
        .icon-btn:hover { filter: brightness(.92); transform: translateY(-1px); }
        .icon-btn.edit { background: var(--amber); color: var(--ink); }
        .icon-btn.delete { background: var(--signal); }

        /* ==========================================================
           DIALOG / MODAL (TAMBAH / EDIT)
           ========================================================== */
        dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-lg); width: min(560px, calc(100vw - 24px)); max-height: min(90vh, 780px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,.45); }
        dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
        dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(3px); backdrop-filter: blur(3px); }
        @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
        .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 18px 22px; border-bottom: 1px solid var(--line); }
        .sheet-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.1rem; letter-spacing: -0.01em; }
        .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .sheet-x:hover { background: var(--ink); color: #fff; }
        .sheet-body { padding: 20px 22px; overflow-y: auto; display: grid; gap: 16px; }
        .sheet-foot { padding: 14px 22px; border-top: 1px solid var(--line); background: var(--paper); display: flex; justify-content: flex-end; gap: 10px; }

        .f-label { display: block; margin-bottom: 6px; font-size: .82rem; font-weight: 700; }
        .f-optional { font-weight: 500; color: var(--steel); text-transform: none; }
        .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid var(--line); border-radius: 12px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        textarea.f-input { padding-top: 12px; padding-bottom: 12px; height: auto; min-height: 80px; resize: vertical; }
        .f-input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.4); }
        .f-input[readonly] { cursor: not-allowed; }
        .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media (max-width: 480px) { .f-row { grid-template-columns: 1fr; } }
        
        .f-alert { display: flex; align-items: flex-start; gap: 10px; padding: 12px 14px; border-radius: 12px; font-size: .82rem; line-height: 1.45; }
        .f-alert.info { background: #eff6ff; color: #1e3a8a; border: 1px solid #bfdbfe; }

        .btn-cancel { height: 42px; padding: 0 18px; border-radius: 999px; background: var(--paper); font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-cancel:hover { background: var(--line); }
        .btn-save { height: 42px; padding: 0 22px; border-radius: 999px; background: var(--ink); color: #fff; font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-save:hover { background: var(--ink-3); }

        /* ==========================================================
           CETAK
           ========================================================== */
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .row-actions, dialog, .toast-wrap, .btn-outline { display: none !important; }
            body { background: #fff !important; }
            .shell { display: block !important; }
            .content { padding: 0 !important; overflow: visible !important; height: auto !important;}
            .table-wrap { border: none !important; box-shadow: none !important; }
            .data-table thead th:last-child, .data-table tbody td:last-child { display: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
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
    </div>
    <div class="topbar-right">
        <div class="user-chip">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'D', 0, 1)) }}</span>
            <div class="user-meta"><strong>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</strong></div>
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

        <a href="/internal/index" class="side-link"><i class="fas fa-house"></i> Dashboard utama</a>
        <div class="side-divider"></div>

        @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
            <details class="side-group">
                <summary>Bagian pencegahan <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/layanan-inspeksi"><i class="fas fa-clipboard-check"></i> Layanan inspeksi</a>
                    <a href="/internal/pencegahan/layanan-sosialisasi"><i class="fas fa-bullhorn"></i> Layanan sosialisasi</a>
                    <a href="/internal/pencegahan/pelatihan"><i class="fas fa-chalkboard-user"></i> Pelatihan</a>
                    <a href="/internal/pencegahan/pembinaan-pengembangan"><i class="fas fa-chart-line"></i> Pembinaan &amp; pengembangan</a>
                    <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-level-up-alt"></i> Peningkatan kapasitas</a>
                    <a href="/internal/pencegahan/kelola-redkar"><i class="fas fa-users-gear"></i> Kelola Redkar</a>
                </div>
            </details>
            <div class="side-divider"></div>
        @endif

        @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
            <details class="side-group">
                <summary>Bagian pemadaman <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data"><i class="fas fa-fire-extinguisher"></i> Input data &amp; laporan</a>
                    <a href="/internal/damtan/data-laporan"><i class="fas fa-file-lines"></i> Data laporan</a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat surat korban</a>
                </div>
            </details>
            <div class="side-divider"></div>
        @endif

        @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
            <!-- SIDEBAR TERBUKA DI SINI KARENA AKTIF -->
            <details class="side-group" open>
                <summary>Bagian sapra <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana dan prasarana</span>
                    <a href="/sapra/sarana-mako"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
                    <a href="/sapra/sarana-penyelamatan"><i class="fas fa-life-ring"></i> Sarana penyelamatan &amp; evakuasi</a>
                    <a href="/sapra/sarana-pemeriksaan"><i class="fas fa-search"></i> Sarana pemeriksaan proteksi kebakaran</a>
                    <a href="/sapra/kelola-pos"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen air</span>
                    <a href="/sapra/data_hidrant_gedung"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota"><i class="fas fa-map-marker-alt"></i> Data hidrant Kota Jambi</a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik &amp; distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras"><i class="fas fa-clipboard-check"></i> Mutu baku kebutuhan</a>
                    
                    <!-- ACTIVE ADA DI SINI KARENA INI HALAMAN DISTRIBUSI -->
                    <a href="/sapra/distribusi-staff" class="active"><i class="fas fa-user-check"></i> Distribusi barang staff</a>
                </div>
            </details>
            <div class="side-divider"></div>
        @endif

        @if(in_array(Auth::user()->role, ['operator', 'super_user']))
            <details class="side-group">
                <summary>Manajemen berita <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita"><i class="fas fa-newspaper"></i> Input &amp; kelola berita</a>
                    <a href="/internal/operator/kelola-redkar"><i class="fas fa-users-gear"></i> Kelola Redkar</a>
                </div>
            </details>
            <div class="side-divider"></div>
        @endif

        <details class="side-group">
            <summary>Pengaturan akun <i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user"><i class="fas fa-users-gear"></i> Kelola semua pengguna</a>
                @endif
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        <div class="page-toolbar">
            <div>
                <h1>Bukti Distribusi Barang</h1>
                <p>Catat dan pantau waktu pembagian inventaris ke masing-masing anggota/staff.</p>
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama staff atau barang..." autocomplete="off">
                </label>
                <a href="/sapra/distribusi-staff/cetak" target="_blank" class="btn btn-outline red"><i class="fas fa-file-pdf"></i> PDF</a>
                <button type="button" class="btn btn-primary" data-open="dlgTambah" data-nama=""><i class="fas fa-user-plus"></i> Input Distribusi Baru</button>
            </div>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="c" style="width:5%; border-top-left-radius: 12px;">NO</th>
                            <th style="width:25%">NAMA PENERIMA</th>
                            <th class="c" style="width:25%">BARANG / INVENTARIS</th>
                            <th class="c" style="width:15%">WAKTU TERIMA</th>
                            <th style="width:20%">KETERANGAN</th>
                            <th class="c" style="width:10%; border-top-right-radius: 12px;">AKSI</th>
                        </tr>
                    </thead>
                    
                    @forelse($dataDistribusi as $nama => $items)
                        <tbody class="staff-group">
                            <!-- HEADER NAMA STAFF -->
                            <tr class="staff-header">
                                <td class="c" style="font-weight: 800; font-size: 1.05rem; color: var(--blue);">{{ $loop->iteration }}</td>
                                <td colspan="5" class="staff-name-search">
                                    <div class="staff-info">
                                        <div class="staff-info-left">
                                            <div class="staff-icon"><i class="fas fa-user"></i></div>
                                            <span class="staff-name">{{ $nama }}</span>
                                            <span class="staff-count"><i class="fas fa-box-open"></i> {{ count($items) }} Total Barang</span>
                                        </div>
                                        <button type="button" class="btn btn-outline btn-xs" data-open="dlgTambah" data-nama="{{ $nama }}">
                                            <i class="fas fa-plus"></i> Tambah Barang
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- LIST BARANG (TREE VIEW) -->
                            @foreach($items as $item)
                                <tr class="data-row">
                                    <!-- Kolom NO kosong (Garis Tree) -->
                                    <td class="tree-line"></td>
                                    
                                    <!-- Icon Node Tree -->
                                    <td class="c" style="color: #cbd5e1;">
                                        <i class="fas fa-level-up-alt fa-rotate-90" style="font-size: 1.3rem;"></i>
                                    </td>
                                    
                                    <!-- Info Barang -->
                                    <td class="c data-barang">
                                        <span class="chip-barang">{{ $item->nama_barang }}</span>
                                        @if($item->detail_barang)
                                            <div class="detail-txt"><i class="fas fa-caret-right"></i> {{ $item->detail_barang }}</div>
                                        @endif
                                    </td>
                                    
                                    <!-- Waktu Terima -->
                                    <td class="c">
                                        <div class="time-date">{{ \Carbon\Carbon::parse($item->waktu_terima)->format('d M Y') }}</div>
                                        <div class="time-clock"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($item->waktu_terima)->format('H:i') }} WIB</div>
                                    </td>
                                    
                                    <!-- Keterangan -->
                                    <td class="ket-txt">
                                        {{ $item->keterangan ?? '-' }}
                                    </td>
                                    
                                    <!-- Aksi -->
                                    <td class="c">
                                        <div class="row-actions">
                                            <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                            <form action="/sapra/distribusi-staff/delete/{{ $item->id }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus data penerimaan ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT DATA -->
                                <dialog class="sheet" id="dlgEdit{{ $item->id }}">
                                    <div class="sheet-head">
                                        <h2>Edit Data Distribusi</h2>
                                        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                    </div>
                                    <form action="/sapra/distribusi-staff/update/{{ $item->id }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="sheet-body">
                                            <div>
                                                <label class="f-label" for="editNama{{ $item->id }}">Nama Staff Penerima</label>
                                                <input class="f-input" type="text" id="editNama{{ $item->id }}" name="nama_penerima" value="{{ $item->nama_penerima }}" required>
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="editBarang{{ $item->id }}">Jenis Barang</label>
                                                    <input class="f-input" type="text" id="editBarang{{ $item->id }}" name="nama_barang" value="{{ $item->nama_barang }}" required>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="editDetail{{ $item->id }}">Detail <span class="f-optional">(Warna/Ukuran)</span></label>
                                                    <input class="f-input" type="text" id="editDetail{{ $item->id }}" name="detail_barang" value="{{ $item->detail_barang }}">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="f-label" for="editWaktu{{ $item->id }}">Waktu Serah Terima</label>
                                                <input class="f-input" type="datetime-local" id="editWaktu{{ $item->id }}" name="waktu_terima" value="{{ \Carbon\Carbon::parse($item->waktu_terima)->format('Y-m-d\TH:i') }}" required>
                                            </div>
                                            <div>
                                                <label class="f-label" for="editKet{{ $item->id }}">Keterangan Tambahan</label>
                                                <textarea class="f-input" id="editKet{{ $item->id }}" name="keterangan" rows="2">{{ $item->keterangan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="sheet-foot">
                                            <button type="button" class="btn-cancel" data-close>Batal</button>
                                            <button type="submit" class="btn-save">Simpan perubahan</button>
                                        </div>
                                    </form>
                                </dialog>
                            @endforeach
                        </tbody>
                    @empty
                        <tbody>
                            <tr>
                                <td colspan="6" class="cell-empty">
                                    <div style="font-size: 3rem; color: #cbd5e1; margin-bottom: 12px;"><i class="fas fa-box-open"></i></div>
                                    <div style="font-size: 1.1rem; color: var(--ink);">Belum ada data distribusi barang ke staff.</div>
                                </td>
                            </tr>
                        </tbody>
                    @endforelse
                </table>
            </div>
        </div>

    </main>
</div>

<!-- ==================== DIALOG TAMBAH (GLOBAL & INLINE) ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Input Distribusi Baru</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/distribusi-staff/store" method="POST">
        @csrf
        <div class="sheet-body">
            <div class="f-alert info" style="margin-bottom: 0;">
                <i class="fas fa-info-circle"></i>
                <div>Waktu serah terima otomatis mendeteksi jam saat ini, tapi bisa Anda ubah sesuai kejadian nyata.</div>
            </div>
            <div>
                <label class="f-label" for="inputNamaPenerima">Nama Staff Penerima</label>
                <!-- Input ini diisi otomatis oleh JS jika tombol Tambah ditekan dari baris nama staff -->
                <input class="f-input" type="text" id="inputNamaPenerima" name="nama_penerima" placeholder="Contoh: Agus Wiyoto" required>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahJenis">Jenis Barang</label>
                    <input class="f-input" type="text" id="tambahJenis" name="nama_barang" placeholder="Contoh: Baju Tahan Panas" required>
                </div>
                <div>
                    <label class="f-label" for="tambahDetail">Detail <span class="f-optional">(Warna/Ukuran)</span></label>
                    <input class="f-input" type="text" id="tambahDetail" name="detail_barang" placeholder="Contoh: Coklat / Uk. 42">
                </div>
            </div>
            <div>
                <label class="f-label" for="tambahWaktu">Waktu Serah Terima</label>
                <input class="f-input" type="datetime-local" id="tambahWaktu" name="waktu_terima" value="{{ date('Y-m-d\TH:i') }}" required>
            </div>
            <div>
                <label class="f-label" for="tambahKet">Keterangan Tambahan</label>
                <textarea class="f-input" id="tambahKet" name="keterangan" rows="2" placeholder="Kosongkan jika tidak ada..."></textarea>
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save">Simpan Bukti Terima</button>
        </div>
    </form>
</dialog>

<script>
(function () {
    'use strict';

    /* ---------- Toast Notifikasi ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () { t.classList.add('leaving'); setTimeout(function () { t.remove(); }, 350); };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- Sidebar Mobile ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    function closeSide() { document.body.classList.remove('side-open'); toggle.setAttribute('aria-expanded', 'false'); }
    toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('side-open');
        toggle.setAttribute('aria-expanded', open);
    });
    backdrop.addEventListener('click', closeSide);

    /* ---------- Accordion Sidebar ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    /* ---------- Modal / Dialog ---------- */
    // Logika Pintar untuk tombol "Tambah Barang" (Global vs Inline)
    document.querySelectorAll('[data-open="dlgTambah"]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var nama = btn.getAttribute('data-nama') || '';
            var inputNama = document.getElementById('inputNamaPenerima');
            
            inputNama.value = nama;
            if(nama !== '') {
                // Di-lock & digelapin warnanya kalau dipanggil dari baris nama spesifik
                inputNama.setAttribute('readonly', 'true');
                inputNama.style.backgroundColor = 'var(--paper)';
            } else {
                // Dibebasin kalau dipanggil dari tombol utama "Input Distribusi Baru"
                inputNama.removeAttribute('readonly');
                inputNama.style.backgroundColor = '#fff';
            }
            
            var dlg = document.getElementById('dlgTambah');
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });

    // Untuk modal Edit (standar)
    document.querySelectorAll('[data-open]:not([data-open="dlgTambah"])').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = document.getElementById(btn.dataset.open);
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });
    
    document.querySelectorAll('dialog').forEach(function (dlg) {
        dlg.addEventListener('click', function (e) {
            // Tutup jika klik backdrop (di luar modal) atau klik tombol silang (data-close)
            if (e.target === dlg || e.target.closest('[data-close]')) dlg.close();
        });
    });

    /* ---------- Live Search Canggih ---------- */
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            var filter = this.value.toLowerCase();
            var groups = document.querySelectorAll('.staff-group');
            
            groups.forEach(function(group) {
                var matchInGroup = false;
                
                // Cek nama header staf-nya
                var headerText = group.querySelector('.staff-name-search').textContent.toLowerCase();
                if(headerText.indexOf(filter) !== -1) matchInGroup = true;
                
                // Cek isi barangnya
                var rows = group.querySelectorAll('.data-row');
                rows.forEach(function(row) {
                    var textBarang = row.querySelector('.data-barang').textContent.toLowerCase();
                    // Munculin baris kalau nama barangnya cocok, ATAU kalau nama staf-nya yang dicari
                    if(textBarang.indexOf(filter) !== -1 || headerText.indexOf(filter) !== -1) {
                        row.style.display = '';
                        matchInGroup = true; // Ketemu di dalam grup ini
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Kalau ada yang cocok di grup ini, tampilkan grupnya (termasuk headernya)
                if(matchInGroup) {
                    group.style.display = '';
                    group.querySelector('.staff-header').style.display = '';
                } else {
                    group.style.display = 'none';
                }
            });
        });
    }
})();
</script>
</body>
</html>