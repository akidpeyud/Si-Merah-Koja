<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Data hidrant Kota Jambi | SIMERAH KOJA</title>
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
            --paper: #f7f9fc; --white: #ffffff;
            --signal: #e5392d; --signal-d: #c22b20; --amber: #ffb627; --amber-d: #b45309;
            --green: #16a34a; --blue: #2563eb; --blue-d: #1d4fd6; --orange: #f97316; --orange-d: #c2410c;
            --steel: #5b6c7f; --line: #dbe2ea;
            
            --navy: #1e3a5f;
            --navy-d: #14283f;
            --navy-tint: rgba(30, 58, 95, .09);

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
            --r-lg: 22px; --r-md: 16px; --r-sm: 10px;
            --sidebar-w: 272px; --topbar-h: 72px;

            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
            --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; transition: color .2s, background .2s, border-color .2s; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; transition: background .2s, color .2s; }
        table { border-collapse: collapse; width: 100%; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

        /* ==========================================================
           MODERN SCROLLBAR
           ========================================================== */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #ccd5df; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b1b9c2; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); }
        .sidebar::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.15); }

        /* ==========================================================
           TOAST
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; background: var(--success); }
        .toast.err .toast-ico { background: var(--signal); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* ==========================================================
           TOPBAR (PERSIS DASHBOARD)
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
        .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--ink); }

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
            .topbar { padding: 0 16px; }
        }

        /* ==========================================================
           SHELL & SIDEBAR MASTER
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: var(--white); border-right: 1px solid var(--line); padding: 16px 10px 32px; display: flex; flex-direction: column; gap: 4px; }
        
        .side-a { display: flex; align-items: center; gap: 12px; border-radius: 10px; font-weight: 600; color: var(--ink); }
        .side-a:hover { background: var(--paper); color: var(--blue-d); }
        .side-a i { width: 20px; text-align: center; font-size: 0.95rem; color: var(--steel); transition: color .2s; }
        .side-a:hover i { color: var(--blue-d); }
        
        .side-link { padding: 12px 14px; font-size: 0.88rem; }
        .side-link.active { background: var(--ink); color: #fff; font-weight: 700; }
        .side-link.active i { color: var(--amber); }
        
        .side-group { margin-top: 2px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--ink-2); position: relative; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); color: var(--blue-d); }
        .side-group summary .chev { margin-left: auto; font-size: 0.65rem; color: var(--steel); transition: transform .25s ease, color .2s; }
        .side-group[open] > summary .chev { transform: rotate(180deg); color: var(--blue-d); }
        
        .side-sub { display: grid; gap: 2px; padding: 2px 2px 6px 12px; margin-left: 23px; border-left: 1px solid #e2e8f0; }
        .side-sub a { padding: 8px 12px; font-size: 0.84rem; font-weight: 500; color: var(--ink-2); position: relative; }
        .side-sub a i { width: 16px; font-size: 0.8rem; }
        .side-sub a.active { background: #eef2ff; color: var(--blue-d); font-weight: 700; }
        .side-sub a.active i { color: var(--blue-d); }
        .side-sub a.active::before { content: ""; position: absolute; left: -13px; top: 50%; transform: translateY(-50%); height: 16px; width: 2px; background: var(--blue); border-radius: 99px; }

        .side-kicker { padding: 12px 14px 4px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: #a9b6c4; margin-top: 8px; }
        .side-sub-kicker { display: block; padding: 12px 12px 4px 0; font-size: 0.65rem; font-weight: 800; color: #a9b6c4; text-transform: uppercase; letter-spacing: 0.05em; }
        .side-divider { height: 1px; background: var(--line); margin: 6px 10px; flex: none; }
        
        .sidebar-backdrop { display: none; }
        
        @media (max-width: 900px) {
            .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: 12px 0 30px rgba(0,0,0,0.1); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,0.4); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           KONTEN HALAMAN
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(20px, 3vw, 36px) clamp(18px, 3vw, 40px) 60px; }

        .page-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .page-toolbar h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.5rem, 3vw, 1.9rem); line-height: 1.15; letter-spacing: -0.02em; color: var(--ink); }
        .page-toolbar p { margin-top: 4px; color: var(--steel); font-size: .92rem; }
        .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }

        .search { position: relative; width: 260px; max-width: 100%; }
        .search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .search input { width: 100%; height: 42px; padding: 0 14px 0 40px; border-radius: 999px; border: 1.5px solid var(--line); background: #fff; font: inherit; font-size: .88rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }

        .btn { display: inline-flex; align-items: center; gap: 8px; height: 42px; padding: 0 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; transition: background .2s, transform .2s, box-shadow .2s; white-space: nowrap; }
        .btn:active { transform: scale(.98); }
        .btn-primary { background: var(--navy); color: #fff; box-shadow: 0 4px 6px -1px rgba(37,99,235,0.1); }
        .btn-primary:hover { background: var(--navy-d); box-shadow: 0 6px 8px -1px rgba(37,99,235,0.2); }
        .btn-outline { background: #fff; border: 1.5px solid var(--line); color: var(--ink); }
        .btn-outline:hover { border-color: var(--ink); background: var(--paper); }
        .btn-outline.green i { color: var(--green); }
        .btn-outline.red i { color: var(--signal); }

        /* ==========================================================
           TABEL HIDRANT KOTA (Tanpa Tabs)
           ========================================================== */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.02); }
        .table-scroll { overflow-x: auto; }
        .data-table { font-size: .85rem; min-width: 1080px; }
        .data-table thead th { position: sticky; top: 0; z-index: 5; background: var(--paper); color: var(--steel); padding: 14px 12px; font-weight: 800; font-size: .68rem; letter-spacing: .05em; text-transform: uppercase; text-align: left; white-space: nowrap; border-bottom: 2px solid var(--line); }
        .data-table thead th.c { text-align: center; }
        .data-table tbody td { padding: 14px 12px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
        .data-table tbody td.c { text-align: center; }
        .data-table tbody tr:hover { background: var(--paper); }
        .data-table tbody tr:last-child td { border-bottom: 0; }
        
        .cell-name { font-weight: 700; color: var(--ink); }
        .cell-sub { display: block; font-size: .78rem; font-weight: 500; color: var(--steel); margin-top: 2px; }
        .cell-empty { text-align: center; padding: 48px 16px; color: var(--steel-soft); font-weight: 600; }

        .chip { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: .74rem; letter-spacing: .02em; text-transform: uppercase; border: 1px solid transparent; white-space: nowrap; }
        .chip-blue { background: var(--info-tint); color: var(--info); border-color: rgba(47, 111, 237, 0.2); }
        .chip-green { background: rgba(16, 185, 129, 0.1); color: var(--success); border-color: rgba(16, 185, 129, 0.2); }
        .chip-red { background: var(--signal-tint); color: var(--signal-d); border-color: rgba(229, 57, 45, 0.2); }
        .chip-amber { background: rgba(255, 182, 39, 0.15); color: #b45309; border-color: rgba(255, 182, 39, 0.3); }
        .chip-orange { background: rgba(249, 115, 22, 0.1); color: #c2410c; border-color: rgba(249, 115, 22, 0.2); }
        .chip-muted { color: var(--steel-soft); background: var(--paper); border-color: var(--line); font-weight: 600; text-transform: none; }

        .maps-chip { display: inline-flex; align-items: center; gap: 7px; padding: 6px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .78rem; font-weight: 700; color: var(--blue); transition: background .2s, color .2s; }
        .maps-chip:hover { background: var(--ink); color: #fff; }
        .maps-chip i { color: var(--signal); }
        .maps-chip:hover i { color: var(--amber); }

        .row-actions { display: inline-flex; gap: 6px; }
        .icon-btn { width: 32px; height: 32px; border-radius: 9px; display: inline-grid; place-items: center; font-size: .82rem; color: #fff; transition: filter .2s, transform .2s; }
        .icon-btn:hover { filter: brightness(.92); transform: translateY(-1px); }
        .icon-btn.edit { background: var(--amber); color: var(--ink); }
        .icon-btn.delete { background: var(--signal); }

        /* ==========================================================
           REKAPITULASI
           ========================================================== */
        .recap-wrap { margin-top: 24px; display: grid; grid-template-columns: minmax(280px, 460px); gap: 20px; }
        .recap-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: 22px 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.02); }
        .recap-card h2 { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; letter-spacing: -0.01em; padding-bottom: 14px; margin-bottom: 14px; border-bottom: 1px solid var(--line); color: var(--ink); }
        .recap-card h2 i { color: var(--info); }
        .recap-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 18px; font-size: .85rem; }
        .recap-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; color: var(--steel); font-weight: 600; }
        .recap-row strong { color: var(--ink); font-weight: 800; }
        .recap-total { margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: var(--ink); }

        /* ==========================================================
           DIALOG (TAMBAH / EDIT)
           ========================================================== */
        dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-lg); width: min(620px, calc(100vw - 24px)); max-height: min(90vh, 780px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,.45); }
        dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
        dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
        @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
        .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 18px 24px; border-bottom: 1px solid var(--line); }
        .sheet-head h2 { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.15rem; letter-spacing: -0.01em; color: var(--ink); }
        .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; color: var(--steel); }
        .sheet-x:hover { background: var(--signal-tint); color: var(--signal-d); }
        .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
        .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: var(--paper); display: flex; justify-content: flex-end; gap: 10px; }

        .f-label { block; margin-bottom: 6px; font-size: .8rem; font-weight: 800; color: var(--ink); text-transform: uppercase; letter-spacing: .04em; }
        .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid var(--line); border-radius: 12px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        textarea.f-input { height: auto; padding: 12px 14px; resize: vertical; min-height: 80px; }
        .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }
        select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
        .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .f-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
        @media (max-width: 520px) { .f-row, .f-row-3 { grid-template-columns: 1fr; } }

        .btn-cancel { height: 42px; padding: 0 18px; border-radius: 999px; background: var(--paper); color: var(--ink); font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-cancel:hover { background: var(--line); }
        .btn-save { height: 42px; padding: 0 22px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-save:hover { background: var(--navy-d); }

        /* ==========================================================
           PRINT
           ========================================================== */
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .row-actions, dialog, .toast-wrap, .recap-wrap { display: none !important; }
            body { background: #fff !important; }
            .shell { display: block !important; }
            .content { padding: 0 !important; }
            .table-wrap { border: none !important; box-shadow: none !important; }
            .data-table thead th:last-child, .data-table tbody td:last-child { display: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
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
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</strong>
                <small>{{ str_replace('_', ' ', Auth::user()->role ?? 'User') }}</small>
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

        <a href="/internal/index" class="side-a side-link {{ Request::is('internal/index') || Request::is('/') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        <!-- KICKER MODUL OPERASIONAL -->
        <div class="side-kicker" style="margin-top: 16px;">MODUL OPERASIONAL</div>

        @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary>
                    <i class="fas fa-shield-halved grp-ico"></i>
                    <span class="grp-label">BAGIAN PENCEGAHAN</span>
                    <i class="fas fa-chevron-down chev"></i>
                </summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/layanan-inspeksi" class="side-a {{ Request::is('internal/pencegahan/layanan-inspeksi*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Layanan inspeksi</a>
                    <a href="/internal/pencegahan/layanan-sosialisasi" class="side-a {{ Request::is('internal/pencegahan/layanan-sosialisasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Layanan sosialisasi</a>
                    <a href="/internal/pencegahan/pelatihan" class="side-a {{ Request::is('internal/pencegahan/pelatihan*') ? 'active' : '' }}"><i class="fas fa-chalkboard-user"></i> Pelatihan</a>
                    <a href="/internal/pencegahan/pembinaan-pengembangan" class="side-a {{ Request::is('internal/pencegahan/pembinaan-pengembangan*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pembinaan &amp; pengembangan</a>
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="side-a {{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-level-up-alt"></i> Peningkatan kapasitas</a>
                    <a href="/internal/pencegahan/kelola-redkar" class="side-a {{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola Redkar</a>
                </div>
            </details>
        @endif

        @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary>
                    <i class="fas fa-fire-extinguisher grp-ico"></i>
                    <span class="grp-label">BAGIAN PEMADAMAN</span>
                    <i class="fas fa-chevron-down chev"></i>
                </summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="side-a {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input data &amp; laporan</a>
                    <a href="/internal/damtan/data-laporan" class="side-a {{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-file-lines"></i> Data laporan</a>
                    <a href="/internal/surat-korban/create" class="side-a {{ Request::is('internal/surat-korban*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat surat korban</a>
                </div>
            </details>
        @endif

        <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-user-tie grp-ico"></i>
                <span class="grp-label">KEPEGAWAIAN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <a href="/internal/kepegawaian/duk" class="side-a {{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}"><i class="fas fa-user-tie"></i> Data Urut Kepegawaian</a>
            </div>
        </details>

        @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>
                    <i class="fas fa-warehouse grp-ico"></i>
                    <span class="grp-label">BAGIAN SAPRA</span>
                    <i class="fas fa-chevron-down chev"></i>
                </summary>
                <div class="side-sub">
                    <span class="side-sub-kicker">SARANA & PRASARANA</span>
                    <a href="/sapra/sarana-mako" class="side-a {{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako" class="side-a {{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
                    <a href="/sapra/sarana-penyelamatan" class="side-a {{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                    <a href="/sapra/sarana-pemeriksaan" class="side-a {{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi Kebakaran</a>
                    <a href="/sapra/kelola-pos" class="side-a {{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                    <span class="side-sub-kicker">MANAJEMEN AIR</span>
                    <a href="/sapra/data_hidrant_gedung" class="side-a {{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota" class="side-a {{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                    <span class="side-sub-kicker">LOGISTIK & DISTRIBUSI</span>
                    <a href="/sapra/kebutuhan-sarpras" class="side-a {{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="side-a {{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i> Serah Terima Barang</a>
                </div>
            </details>
        @endif

        <div class="side-divider"></div>

        <!-- KICKER AKUN -->
        <div class="side-kicker">AKUN</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-user-gear grp-ico"></i>
                <span class="grp-label">PENGATURAN AKUN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <a href="/internal/profil" class="side-a {{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="side-a {{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola pengguna</a>
                @endif
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <div class="page-toolbar">
            <div>
                <h1>Data hidrant Kota Jambi</h1>
                <p>Monitoring kondisi, tekanan air, dan machino hidrant di wilayah Kota Jambi.</p>
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari jalan, kecamatan, RT</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari jalan, kecamatan, RT..." autocomplete="off">
                </label>
                <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah data</button>
                <a href="/sapra/data-hidrant-kota/cetak-excel" class="btn btn-outline green"><i class="fas fa-file-excel"></i> Excel</a>
                <a href="/sapra/data-hidrant-kota/cetak-pdf" class="btn btn-outline red"><i class="fas fa-file-pdf"></i> PDF</a>
            </div>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:12%">Jalan</th>
                            <th style="width:13%">Kecamatan / kelurahan</th>
                            <th class="c" style="width:5%">RT</th>
                            <th style="width:13%">Lokasi terdekat</th>
                            <th class="c" style="width:10%">Kode maps</th>
                            <th class="c" style="width:9%">Kondisi</th>
                            <th class="c" style="width:9%">Tekanan</th>
                            <th class="c" style="width:9%">Machino</th>
                            <th style="width:13%">Keterangan</th>
                            <th class="c" style="width:7%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($dataMaintenance ?? [] as $item)
                        @php
                            $kondisi = strtolower(trim($item->kondisi_hidran ?? ''));
                            $tekanan = strtolower(trim($item->tekanan ?? ''));
                            $machino = strtolower(trim($item->machino ?? ''));
                        @endphp
                        <tr class="data-row">
                            <td class="cell-name data-jalan">{{ $item->jalan }}</td>
                            <td class="data-kec-kel">
                                {{ $item->kecamatan }}
                                <span class="cell-sub">{{ $item->kelurahan }}</span>
                            </td>
                            <td class="c">{{ $item->rt ?? '—' }}</td>
                            <td class="data-lokasi">{{ $item->lokasi_terdekat }}</td>
                            <td class="c">
                                @if($item->kode_map)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_map) }}" target="_blank" rel="noopener" class="maps-chip">
                                        <i class="fas fa-map-marker-alt"></i> {{ $item->kode_map }}
                                    </a>
                                @else
                                    <span class="chip-muted">&mdash;</span>
                                @endif
                            </td>
                            <td class="c data-kondisi">
                                <span class="chip {{ $kondisi == 'baik' ? 'chip-green' : ($kondisi == 'rusak' ? 'chip-red' : 'chip-muted') }}">
                                    @if($kondisi == 'baik') <i class="fas fa-check-circle"></i>
                                    @elseif($kondisi == 'rusak') <i class="fas fa-times-circle"></i>
                                    @endif
                                    {{ $item->kondisi_hidran ?? '—' }}
                                </span>
                            </td>
                            <td class="c data-tekanan">
                                <span class="chip {{ $tekanan == 'kuat' ? 'chip-blue' : ($tekanan == 'sedang' ? 'chip-amber' : ($tekanan == 'lemah' ? 'chip-orange' : 'chip-muted')) }}">
                                    @if($tekanan == 'kuat') <i class="fas fa-check-circle"></i>
                                    @elseif($tekanan == 'sedang') <i class="fas fa-info-circle"></i>
                                    @elseif($tekanan == 'lemah') <i class="fas fa-exclamation-triangle"></i>
                                    @endif
                                    {{ $item->tekanan ?? '—' }}
                                </span>
                            </td>
                            <td class="c data-machino">
                                <span class="chip {{ $machino == 'baik' ? 'chip-green' : ($machino == 'rusak' ? 'chip-red' : 'chip-muted') }}">
                                    @if($machino == 'baik') <i class="fas fa-check-circle"></i>
                                    @elseif($machino == 'rusak') <i class="fas fa-times-circle"></i>
                                    @endif
                                    {{ $item->machino ?? '—' }}
                                </span>
                            </td>
                            <td class="data-keterangan">{{ $item->keterangan }}</td>
                            <td class="c">
                                <div class="row-actions">
                                    <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                    <form action="/sapra/data-hidrant-kota/delete/{{ $item->id }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin hapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Dialog edit -->
                        <dialog class="sheet" id="dlgEdit{{ $item->id }}">
                            <div class="sheet-head">
                                <h2>Edit data hidrant</h2>
                                <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                            </div>
                            <form action="/sapra/data-hidrant-kota/update/{{ $item->id }}" method="POST">
                                @csrf @method('PUT')
                                <div class="sheet-body">
                                    <div class="f-row">
                                        <div>
                                            <label class="f-label" for="jalan{{ $item->id }}">Jalan</label>
                                            <input class="f-input" type="text" id="jalan{{ $item->id }}" name="jalan" value="{{ $item->jalan }}" required>
                                        </div>
                                        <div>
                                            <label class="f-label" for="lokasi{{ $item->id }}">Lokasi terdekat</label>
                                            <input class="f-input" type="text" id="lokasi{{ $item->id }}" name="lokasi_terdekat" value="{{ $item->lokasi_terdekat }}" required>
                                        </div>
                                    </div>
                                    <div class="f-row-3">
                                        <div>
                                            <label class="f-label" for="kecamatan{{ $item->id }}">Kecamatan</label>
                                            <input class="f-input" type="text" id="kecamatan{{ $item->id }}" name="kecamatan" value="{{ $item->kecamatan }}" required>
                                        </div>
                                        <div>
                                            <label class="f-label" for="kelurahan{{ $item->id }}">Kelurahan</label>
                                            <input class="f-input" type="text" id="kelurahan{{ $item->id }}" name="kelurahan" value="{{ $item->kelurahan }}" required>
                                        </div>
                                        <div>
                                            <label class="f-label" for="rt{{ $item->id }}">RT</label>
                                            <input class="f-input" type="text" id="rt{{ $item->id }}" name="rt" value="{{ $item->rt }}">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="f-label" for="kode_map{{ $item->id }}">Kode maps</label>
                                        <input class="f-input" type="text" id="kode_map{{ $item->id }}" name="kode_map" value="{{ $item->kode_map }}">
                                    </div>
                                    <div class="f-row-3">
                                        <div>
                                            <label class="f-label" for="kondisi{{ $item->id }}">Kondisi hidran</label>
                                            <select class="f-input" id="kondisi{{ $item->id }}" name="kondisi_hidran">
                                                <option value="">— Pilih —</option>
                                                <option value="Baik" {{ strcasecmp($item->kondisi_hidran, 'Baik') == 0 ? 'selected' : '' }}>Baik</option>
                                                <option value="Rusak" {{ strcasecmp($item->kondisi_hidran, 'Rusak') == 0 ? 'selected' : '' }}>Rusak</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="f-label" for="tekanan{{ $item->id }}">Tekanan air</label>
                                            <select class="f-input" id="tekanan{{ $item->id }}" name="tekanan">
                                                <option value="">— Pilih —</option>
                                                <option value="Kuat" {{ strcasecmp($item->tekanan, 'Kuat') == 0 ? 'selected' : '' }}>Kuat</option>
                                                <option value="Sedang" {{ strcasecmp($item->tekanan, 'Sedang') == 0 ? 'selected' : '' }}>Sedang</option>
                                                <option value="Lemah" {{ strcasecmp($item->tekanan, 'Lemah') == 0 ? 'selected' : '' }}>Lemah</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="f-label" for="machino{{ $item->id }}">Machino</label>
                                            <select class="f-input" id="machino{{ $item->id }}" name="machino">
                                                <option value="">— Pilih —</option>
                                                <option value="Baik" {{ strcasecmp($item->machino, 'Baik') == 0 ? 'selected' : '' }}>Baik</option>
                                                <option value="Rusak" {{ strcasecmp($item->machino, 'Rusak') == 0 ? 'selected' : '' }}>Rusak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="f-label" for="keterangan{{ $item->id }}">Keterangan</label>
                                        <textarea class="f-input" id="keterangan{{ $item->id }}" name="keterangan" rows="2">{{ $item->keterangan }}</textarea>
                                    </div>
                                </div>
                                <div class="sheet-foot">
                                    <button type="button" class="btn-cancel" data-close>Batal</button>
                                    <button type="submit" class="btn-save">Simpan perubahan</button>
                                </div>
                            </form>
                        </dialog>
                        @empty
                        <tr><td colspan="10" class="cell-empty">Belum ada data hidrant Kota Jambi tersimpan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==================== REKAPITULASI ==================== -->
        <div class="recap-wrap">
            <div class="recap-card">
                <h2><i class="fas fa-chart-pie"></i> Rekapitulasi data hidrant</h2>
                <div class="recap-grid">
                    <div class="recap-row"><span>Kondisi baik</span> <strong id="stat-baik">{{ $stats['kondisi_baik'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Bisa dipakai</span> <strong id="stat-bisa-dipakai">{{ $stats['bisa_dipakai'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Kondisi rusak</span> <strong id="stat-rusak">{{ $stats['kondisi_rusak'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Tidak bisa dipakai</span> <strong id="stat-tidak-bisa-dipakai">{{ $stats['tidak_bisa_dipakai'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Tekanan kuat</span> <strong id="stat-kuat">{{ $stats['tekanan_kuat'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Tergantung listrik</span> <strong id="stat-listrik">{{ $stats['tergantung_listrik'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Tekanan sedang</span> <strong id="stat-sedang">{{ $stats['tekanan_sedang'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Tidak keluar air</span> <strong id="stat-tidak-keluar-air">{{ $stats['tidak_keluar_air'] ?? 0 }}</strong></div>
                    <div class="recap-row"><span>Tekanan lemah</span> <strong id="stat-lemah">{{ $stats['tekanan_lemah'] ?? 0 }}</strong></div>
                </div>
                <div class="recap-total">
                    <span>Total seluruh hidrant</span>
                    <span id="stat-total">{{ $stats['total'] ?? 0 }} titik</span>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- ==================== DIALOG TAMBAH ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah data hidrant</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/data-hidrant-kota/store" method="POST">
        @csrf
        <div class="sheet-body">
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahJalan">Jalan</label>
                    <input class="f-input" type="text" id="tambahJalan" name="jalan" placeholder="Nama jalan" required>
                </div>
                <div>
                    <label class="f-label" for="tambahLokasi">Lokasi terdekat</label>
                    <input class="f-input" type="text" id="tambahLokasi" name="lokasi_terdekat" placeholder="Contoh: SPBU, sekolah, dll" required>
                </div>
            </div>
            <div class="f-row-3">
                <div>
                    <label class="f-label" for="tambahKecamatan">Kecamatan</label>
                    <input class="f-input" type="text" id="tambahKecamatan" name="kecamatan" required>
                </div>
                <div>
                    <label class="f-label" for="tambahKelurahan">Kelurahan</label>
                    <input class="f-input" type="text" id="tambahKelurahan" name="kelurahan" required>
                </div>
                <div>
                    <label class="f-label" for="tambahRt">RT</label>
                    <input class="f-input" type="text" id="tambahRt" name="rt">
                </div>
            </div>
            <div>
                <label class="f-label" for="tambahKodeMap">Kode maps</label>
                <input class="f-input" type="text" id="tambahKodeMap" name="kode_map" placeholder="Contoh: 9HM5+6X">
            </div>
            <div class="f-row-3">
                <div>
                    <label class="f-label" for="tambahKondisi">Kondisi hidran</label>
                    <select class="f-input" id="tambahKondisi" name="kondisi_hidran">
                        <option value="">— Pilih —</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div>
                    <label class="f-label" for="tambahTekanan">Tekanan air</label>
                    <select class="f-input" id="tambahTekanan" name="tekanan">
                        <option value="">— Pilih —</option>
                        <option value="Kuat">Kuat</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Lemah">Lemah</option>
                    </select>
                </div>
                <div>
                    <label class="f-label" for="tambahMachino">Machino</label>
                    <select class="f-input" id="tambahMachino" name="machino">
                        <option value="">— Pilih —</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="f-label" for="tambahKeterangan">Keterangan</label>
                <textarea class="f-input" id="tambahKeterangan" name="keterangan" rows="2"></textarea>
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save">Simpan data</button>
        </div>
    </form>
</dialog>

<script>
(function () {
    'use strict';

    /* ---------- Notifikasi ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () { t.classList.add('leaving'); setTimeout(function () { t.remove(); }, 350); };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- Sidebar (mobile) ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    function closeSide() { document.body.classList.remove('side-open'); toggle.setAttribute('aria-expanded', 'false'); }
    toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('side-open');
        toggle.setAttribute('aria-expanded', open);
    });
    backdrop.addEventListener('click', closeSide);

    /* ---------- Accordion Sidebar Logic ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    /* ---------- Dialog (tambah & edit) ---------- */
    document.querySelectorAll('[data-open]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = document.getElementById(btn.dataset.open);
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });
    document.querySelectorAll('dialog').forEach(function (dlg) {
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg || e.target.closest('[data-close]')) dlg.close();
        });
    });

    /* ---------- Pencarian + rekap real-time ---------- */
    var search = document.getElementById('searchInput');
    var setText = function (id, val) { var el = document.getElementById(id); if (el) el.textContent = val; };

    if (search) {
        search.addEventListener('input', function () {
            var q = search.value.trim().toLowerCase();
            var rows = document.querySelectorAll('.data-row');
            var s = { total: 0, baik: 0, rusak: 0, kuat: 0, sedang: 0, lemah: 0, bisaDipakai: 0, tidakBisaDipakai: 0, listrik: 0, tidakKeluarAir: 0 };

            rows.forEach(function (row) {
                var text = row.textContent.toLowerCase();
                if (text.indexOf(q) !== -1) {
                    row.style.display = '';
                    s.total++;

                    var kondisiElem = row.querySelector('.data-kondisi');
                    var tekananElem = row.querySelector('.data-tekanan');
                    var ketElem = row.querySelector('.data-keterangan');

                    var kondisi = kondisiElem ? kondisiElem.textContent.trim().toLowerCase() : '';
                    var tekanan = tekananElem ? tekananElem.textContent.trim().toLowerCase() : '';
                    var keterangan = ketElem ? ketElem.textContent.trim().toLowerCase() : '';

                    if (kondisi.indexOf('baik') !== -1) s.baik++;
                    if (kondisi.indexOf('rusak') !== -1) s.rusak++;
                    if (tekanan.indexOf('kuat') !== -1) s.kuat++;
                    if (tekanan.indexOf('sedang') !== -1) s.sedang++;
                    if (tekanan.indexOf('lemah') !== -1) s.lemah++;

                    if (keterangan.indexOf('tidak bisa dipakai') !== -1) s.tidakBisaDipakai++;
                    else if (keterangan.indexOf('bisa dipakai') !== -1) s.bisaDipakai++;

                    if (keterangan.indexOf('listrik') !== -1) s.listrik++;
                    if (keterangan.indexOf('tidak keluar air') !== -1) s.tidakKeluarAir++;
                } else {
                    row.style.display = 'none';
                }
            });

            setText('stat-baik', s.baik);
            setText('stat-rusak', s.rusak);
            setText('stat-kuat', s.kuat);
            setText('stat-sedang', s.sedang);
            setText('stat-lemah', s.lemah);
            setText('stat-bisa-dipakai', s.bisaDipakai);
            setText('stat-tidak-bisa-dipakai', s.tidakBisaDipakai);
            setText('stat-listrik', s.listrik);
            setText('stat-tidak-keluar-air', s.tidakKeluarAir);
            setText('stat-total', s.total + ' titik');
        });
    }
})();
</script>
</body>
</html>