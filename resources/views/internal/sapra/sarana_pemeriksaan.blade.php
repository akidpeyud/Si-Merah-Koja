<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Data Sarana Pemeriksaan Proteksi Kebakaran | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & BASE (MASTER DESIGN — sama seperti Data Penyelamatan)
           ========================================================== */
        :root {
            --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
            --paper: #f7f9fc; --white: #ffffff;
            --signal: #e5392d; --signal-d: #c22b20; --signal-tint: #fdeceb; --amber: #ffb627;
            --green: #16a34a; --success: #16a34a;
            --blue: #2563eb; --blue-d: #1d4fd6;
            --steel: #5b6c7f; --steel-soft: #94a3b8; --line: #dbe2ea;
            --navy: #1e3a5f; --navy-d: #14283f; --navy-tint: rgba(30, 58, 95, .09);
            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;
            --r-lg: 20px; --r-md: 14px; --r-sm: 10px;
            --sidebar-w: 272px; --topbar-h: 72px;
            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
            --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; overflow: hidden; }
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
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* ==========================================================
           TOPBAR (MASTER DESIGN)
           ========================================================== */
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: rgba(255,255,255,.9); -webkit-backdrop-filter: blur(12px); backdrop-filter: blur(12px); border-bottom: 1px solid var(--line); box-shadow: 0 2px 10px -2px rgba(0,0,0,0.02); }
        .topbar-left { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: var(--steel); transition: background .2s; }
        .side-toggle:hover { background: var(--paper); color: var(--ink); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--ink); }

        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 12px 5px 5px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink-2); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--ink); }
        .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 38px; padding: 0 16px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 700; font-size: .82rem; }
        .btn-logout:hover { background: var(--navy-d); transform: translateY(-1px); }
        @media (max-width: 900px) { .side-toggle { display: inline-flex; } .user-meta { display: none; } .topbar { padding: 0 16px; } }

        /* ==========================================================
           SHELL & SIDEBAR MASTER
           ========================================================== */
        .shell { display: flex; align-items: flex-start; height: calc(100vh - var(--topbar-h)); }

        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: var(--white); border-right: 1px solid var(--line); padding: 16px 10px 32px; box-shadow: 1px 0 0 0 rgba(0,0,0,0.01); display: flex; flex-direction: column; gap: 4px; scrollbar-width: thin; scrollbar-color: var(--line) transparent; }

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
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
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
        .content { flex: 1; min-width: 0; height: 100%; overflow-y: auto; padding: clamp(20px, 3vw, 36px) clamp(18px, 3vw, 40px) 60px; }

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
        .btn-outline.red { color: var(--signal); border-color: var(--signal); }
        .btn-outline.red:hover { background: var(--signal); color: #fff; }

        /* ==========================================================
           TAB POS
           ========================================================== */
        .tabs { display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: var(--shadow-xs); overflow-x: auto; scrollbar-width: none; margin-bottom: 20px; }
        .tabs::-webkit-scrollbar { display: none; }
        .tab { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 10px 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; color: var(--steel); transition: background .2s, color .2s; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-selected="true"] { background: var(--navy); color: #fff; }

        /* ==========================================================
           KARTU INFO POS
           ========================================================== */
        .panel[hidden] { display: none; }
        .info-card { display: flex; flex-wrap: wrap; align-items: center; gap: 10px 26px; background: #fff; border: 1px solid var(--line); border-left: 4px solid var(--blue); border-radius: var(--r-md); padding: 18px 22px; margin-bottom: 18px; box-shadow: var(--shadow-xs); }
        .info-card h2 { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.05rem; letter-spacing: -0.01em; text-transform: uppercase; flex-basis: 100%; color: var(--ink); }
        .info-row { display: flex; align-items: center; gap: 9px; font-size: .87rem; color: var(--steel); font-weight: 600; }
        .info-row i { color: var(--signal); width: 16px; text-align: center; }

        .maps-chip { display: inline-flex; align-items: center; gap: 7px; padding: 6px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .78rem; font-weight: 700; color: var(--blue); transition: background .2s, color .2s; margin-left: 4px; }
        .maps-chip:hover { background: var(--ink); color: #fff; }
        .maps-chip i { color: var(--signal); }
        .maps-chip:hover i { color: var(--amber); }

        /* ==========================================================
           TABEL SARANA PEMERIKSAAN
           ========================================================== */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: var(--shadow-xs); }
        .table-scroll { overflow-x: auto; }
        .data-table { font-size: .85rem; min-width: 780px; }
        .data-table thead th { position: sticky; top: 0; z-index: 5; background: var(--paper); color: var(--steel); padding: 14px 16px; font-weight: 800; font-size: .68rem; letter-spacing: .05em; text-transform: uppercase; text-align: left; white-space: nowrap; border-bottom: 2px solid var(--line); }
        .data-table thead th.c { text-align: center; }
        .data-table tbody td { padding: 14px 16px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
        .data-table tbody td.c { text-align: center; }
        .data-table tbody tr:hover { background: var(--paper); }
        .data-table tbody tr:last-child td { border-bottom: 0; }

        .cell-name { font-weight: 700; font-size: .92rem; text-transform: uppercase; margin-bottom: 4px; color: var(--ink); }
        .cell-empty { text-align: center; padding: 48px 16px; color: var(--steel-soft); font-weight: 600; }

        .chip { display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: .8rem; border: 1px solid transparent; }
        .chip-blue { background: #eff6ff; color: var(--blue); border-color: #bfdbfe; }

        .img-wrap { display: inline-block; padding: 4px; border: 1px solid var(--line); border-radius: var(--r-sm); background: var(--paper); }
        .img-sarana { width: 150px; height: 100px; object-fit: cover; border-radius: 7px; transition: transform .2s; }
        .img-wrap:hover .img-sarana { transform: scale(1.03); }
        .img-empty { display: inline-flex; align-items: center; gap: 7px; padding: 8px 14px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .78rem; font-weight: 600; color: var(--steel); }

        .row-actions { display: inline-flex; gap: 6px; justify-content: center; }
        .icon-btn { width: 32px; height: 32px; border-radius: 9px; display: inline-grid; place-items: center; font-size: .82rem; color: #fff; transition: filter .2s, transform .2s; }
        .icon-btn:hover { filter: brightness(.92); transform: translateY(-1px); }
        .icon-btn.edit { background: var(--amber); color: var(--ink); }
        .icon-btn.delete { background: var(--signal); }

        /* ==========================================================
           DIALOG (TAMBAH / EDIT)
           ========================================================== */
        dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-lg); width: min(560px, calc(100vw - 24px)); max-height: min(90vh, 780px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: var(--shadow-lg); }
        dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
        dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
        @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
        .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 18px 24px; border-bottom: 1px solid var(--line); }
        .sheet-head h2 { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.15rem; letter-spacing: -0.01em; color: var(--ink); }
        .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; color: var(--steel); }
        .sheet-x:hover { background: var(--signal-tint); color: var(--signal-d); }
        .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
        .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: var(--paper); display: flex; justify-content: flex-end; gap: 10px; }

        .f-label { display: block; margin-bottom: 6px; font-size: .8rem; font-weight: 800; color: var(--ink); text-transform: uppercase; letter-spacing: .04em; }
        .f-hint { margin-top: 6px; font-size: .75rem; color: var(--steel-soft); font-weight: 500; }
        .f-optional { font-weight: 500; color: var(--steel); text-transform: none; }
        .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid var(--line); border-radius: 12px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        input[type="file"].f-input { padding: 9px 14px; font-size: .85rem; }
        .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }
        select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
        .f-row { display: grid; grid-template-columns: 3fr 1fr; gap: 14px; }
        @media (max-width: 480px) { .f-row { grid-template-columns: 1fr; } }

        .btn-cancel { height: 42px; padding: 0 18px; border-radius: 999px; background: var(--paper); color: var(--ink); font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-cancel:hover { background: var(--line); }
        .btn-save { height: 42px; padding: 0 22px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-save:hover { background: var(--navy-d); }

        /* ==========================================================
           PRINT
           ========================================================== */
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .tabs, .row-actions, dialog, .toast-wrap { display: none !important; }
            body { background: #fff !important; }
            .shell { display: block !important; }
            .content { padding: 0 !important; overflow: visible !important; height: auto !important; }
            .table-wrap { border: none !important; box-shadow: none !important; }
            .panel { display: none !important; }
            .panel[data-print-active] { display: block !important; }
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
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</strong>
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

    <!-- ==================== SIDEBAR MASTER ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">

        <a href="/internal/index" class="side-a side-link {{ Request::is('internal/index') || Request::is('/') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        <div class="side-divider"></div>

        <div class="side-kicker">MODUL OPERASIONAL</div>

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
                    <span class="side-sub-kicker">SARANA &amp; PRASARANA</span>

                    <a href="/sapra/sarana-mako" class="side-a {{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako" class="side-a {{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
                    <a href="/sapra/sarana-penyelamatan" class="side-a {{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana penyelamatan &amp; evakuasi</a>

                    <!-- ACTIVE karena ini halaman Sarana Pemeriksaan -->
                    <a href="/sapra/sarana-pemeriksaan" class="side-a active"><i class="fas fa-search"></i> Sarana pemeriksaan proteksi kebakaran</a>

                    <a href="/sapra/kelola-pos" class="side-a {{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-sub-kicker">MANAJEMEN AIR</span>
                    <a href="/sapra/data_hidrant_gedung" class="side-a {{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="side-a {{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data hidrant Kota Jambi</a>

                    <span class="side-sub-kicker">LOGISTIK &amp; DISTRIBUSI</span>
                    <a href="/sapra/kebutuhan-sarpras" class="side-a {{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu baku kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="side-a {{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i> Serah Terima Barang</a>
                </div>
            </details>
        @endif

        @if(in_array(Auth::user()->role, ['operator', 'super_user']))
            <div class="side-divider"></div>
            <div class="side-kicker">KONTEN PUBLIK</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('media-informasi*') ? 'open' : '' }}>
                <summary>
                    <i class="far fa-newspaper grp-ico"></i>
                    <span class="grp-label">MANAJEMEN BERITA</span>
                    <i class="fas fa-chevron-down chev"></i>
                </summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="side-a {{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input &amp; kelola berita</a>
                    <a href="/internal/operator/infografis" class="side-a {{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola info grafis</a>
                    <a href="/internal/operator/berita-medsos" class="side-a {{ Request::is('internal/operator/berita-medsos*') || Request::is('media-informasi*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola berita medsos</a>
                </div>
            </details>
        @endif

        <div class="side-divider"></div>

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

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        <div class="page-toolbar">
            <div>
                <h1>Data Sarana Pemeriksaan Proteksi Kebakaran</h1>
                <p>Manajemen dokumentasi alat seperti Walkie Talkie dan Head Tester di tiap pos.</p>
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari alat pemeriksaan</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari alat pemeriksaan..." autocomplete="off">
                </label>
                <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah data</button>
                <a href="/sapra/sarana-pemeriksaan/cetak" class="btn btn-outline red"><i class="fas fa-file-pdf"></i> PDF</a>
            </div>
        </div>

        @php $activeTab = session('active_tab'); @endphp

        <!-- Tab per pos -->
        <nav class="tabs" role="tablist" aria-label="Pilih pos">
            @foreach($posPemadam as $pos)
                @php $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first; @endphp
                <button type="button" class="tab" role="tab" data-tab="panel-{{ $pos->id_pos }}" aria-selected="{{ $isActive ? 'true' : 'false' }}">{{ strtoupper($pos->nama_pos) }}</button>
            @endforeach
        </nav>

        @foreach($posPemadam as $pos)
            @php
                $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first;
                $dataFilter = $dataPemeriksaan->where('id_pos', $pos->id_pos);
            @endphp
            <div class="panel" id="panel-{{ $pos->id_pos }}" role="tabpanel" @if(!$isActive) hidden @endif @if($isActive) data-print-active @endif>

                <!-- Kartu info pos -->
                <div class="info-card">
                    <h2>{{ $pos->nama_pos }}</h2>
                    <span class="info-row"><i class="fas fa-map-marker-alt"></i> {{ $pos->alamat ?? 'Alamat belum diatur' }}</span>
                    <span class="info-row">
                        <i class="fas fa-map"></i> Kode map:
                        @if($pos->kode_map)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($pos->kode_map) }}" target="_blank" rel="noopener" class="maps-chip">
                                <i class="fas fa-location-arrow"></i> {{ $pos->kode_map }}
                            </a>
                        @else
                            <span class="chip-muted" style="padding:4px 8px;border-radius:6px;">&mdash;</span>
                        @endif
                    </span>
                </div>

                <div class="table-wrap">
                    <div class="table-scroll">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="c" style="width:5%">No</th>
                                    <th style="width:45%">Jenis sarana pemeriksaan</th>
                                    <th class="c" style="width:10%">Jumlah</th>
                                    <th style="width:25%">Gambar</th>
                                    <th class="c" style="width:15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataFilter as $item)
                                <tr class="data-row" data-tab="{{ $pos->id_pos }}">
                                    <td class="c">{{ $loop->iteration }}</td>
                                    <td class="data-name">
                                        <div class="cell-name">{{ $item->jenis_sarana }}</div>
                                    </td>
                                    <td class="c"><span class="chip chip-blue">{{ $item->jumlah }} Unit</span></td>
                                    <td>
                                        @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                            <div class="img-wrap">
                                                <a href="{{ asset($item->path_gambar) }}" target="_blank" rel="noopener">
                                                    <img src="{{ asset($item->path_gambar) }}" alt="{{ $item->jenis_sarana }}" class="img-sarana" onerror="this.onerror=null; this.src='https://via.placeholder.com/200x130?text=Gambar+Hilang';">
                                                </a>
                                            </div>
                                        @else
                                            <span class="img-empty"><i class="far fa-image"></i> Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="c">
                                        <div class="row-actions">
                                            <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id_sarana_pemeriksaan }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                            <form action="/sapra/sarana-pemeriksaan/delete/{{ $item->id_sarana_pemeriksaan }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus sarana pemeriksaan ini? Gambar akan ikut terhapus permanen.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Dialog edit -->
                                <dialog class="sheet" id="dlgEdit{{ $item->id_sarana_pemeriksaan }}">
                                    <div class="sheet-head">
                                        <h2>Edit Data Sarana Pemeriksaan</h2>
                                        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                    </div>
                                    <form action="/sapra/sarana-pemeriksaan/update/{{ $item->id_sarana_pemeriksaan }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="sheet-body">
                                            <div>
                                                <label class="f-label" for="id_pos{{ $item->id_sarana_pemeriksaan }}">Pilih lokasi / pos</label>
                                                <select class="f-input" id="id_pos{{ $item->id_sarana_pemeriksaan }}" name="id_pos" required>
                                                    <option value="">— Pilih lokasi —</option>
                                                    @foreach($posPemadam as $posOption)
                                                        <option value="{{ $posOption->id_pos }}" {{ $posOption->id_pos == $item->id_pos ? 'selected' : '' }}>{{ strtoupper($posOption->nama_pos) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="jenis{{ $item->id_sarana_pemeriksaan }}">Jenis alat pemeriksaan</label>
                                                    <input class="f-input" type="text" id="jenis{{ $item->id_sarana_pemeriksaan }}" name="jenis_sarana" value="{{ $item->jenis_sarana }}" required>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="jumlah{{ $item->id_sarana_pemeriksaan }}">Jumlah stok</label>
                                                    <input class="f-input" type="number" id="jumlah{{ $item->id_sarana_pemeriksaan }}" name="jumlah" value="{{ $item->jumlah }}" required>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="f-label" for="gambar{{ $item->id_sarana_pemeriksaan }}">Ganti gambar <span class="f-optional">(opsional)</span></label>
                                                <input class="f-input" type="file" id="gambar{{ $item->id_sarana_pemeriksaan }}" name="gambar" accept="image/*">
                                                <p class="f-hint">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                                            </div>
                                        </div>
                                        <div class="sheet-foot">
                                            <button type="button" class="btn-cancel" data-close>Batal</button>
                                            <button type="submit" class="btn-save">Simpan perubahan</button>
                                        </div>
                                    </form>
                                </dialog>
                                @empty
                                <tr>
                                    <td colspan="5" class="cell-empty">Belum ada data sarana pemeriksaan untuk {{ $pos->nama_pos }}.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

    </main>
</div>

<!-- ==================== DIALOG TAMBAH (GLOBAL) ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah data sarana pemeriksaan</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/sarana-pemeriksaan/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="sheet-body">
            <div>
                <label class="f-label" for="tambahIdPos">Pilih lokasi / pos</label>
                <select class="f-input" id="tambahIdPos" name="id_pos" required>
                    <option value="">— Pilih lokasi —</option>
                    @foreach($posPemadam as $pos)
                        <option value="{{ $pos->id_pos }}">{{ strtoupper($pos->nama_pos) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahJenis">Jenis alat pemeriksaan</label>
                    <input class="f-input" type="text" id="tambahJenis" name="jenis_sarana" placeholder="Contoh: Walkie Talkie" required>
                </div>
                <div>
                    <label class="f-label" for="tambahJumlah">Jumlah tersedia</label>
                    <input class="f-input" type="number" id="tambahJumlah" name="jumlah" value="1" min="1" required>
                </div>
            </div>
            <div>
                <label class="f-label" for="tambahGambar">Upload gambar <span class="f-optional">(opsional)</span></label>
                <input class="f-input" type="file" id="tambahGambar" name="gambar" accept="image/*">
                <p class="f-hint">Format: JPG, PNG. Maksimal 2MB.</p>
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
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);

    /* ---------- Accordion Sidebar ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    /* ---------- Tabs Navigation ---------- */
    var searchInput = document.getElementById('searchInput');
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) { t.setAttribute('aria-selected', 'false'); });
            tab.setAttribute('aria-selected', 'true');

            document.querySelectorAll('.panel').forEach(function (p) {
                var active = p.id === tab.dataset.tab;
                p.hidden = !active;
                if (active) { p.setAttribute('data-print-active', ''); } else { p.removeAttribute('data-print-active'); }
            });

            if (searchInput) {
                searchInput.value = '';
                document.querySelectorAll('.data-row').forEach(function (row) { row.style.display = ''; });
            }
        });
    });

    /* ---------- Modal / Dialog ---------- */
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

    /* ---------- Live Search Table ---------- */
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = searchInput.value.trim().toLowerCase();
            var activePanel = document.querySelector('.panel:not([hidden])');
            if (!activePanel) return;

            activePanel.querySelectorAll('.data-row').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    }
})();
</script>
</body>
</html>