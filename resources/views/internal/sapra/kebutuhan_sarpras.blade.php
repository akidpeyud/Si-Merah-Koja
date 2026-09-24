<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Mutu Baku Kebutuhan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & BASE (MASTER DESIGN — sama seperti halaman Sapra lain)
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

        .page-toolbar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .page-toolbar h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.4rem, 3vw, 1.8rem); line-height: 1.15; letter-spacing: -0.02em; text-transform: uppercase; color: var(--ink); }
        .page-toolbar p { margin-top: 6px; color: var(--steel); font-size: .92rem; }
        .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }

        .search { position: relative; width: 250px; max-width: 100%; }
        .search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .search input { width: 100%; height: 42px; padding: 0 14px 0 40px; border-radius: 999px; border: 1.5px solid var(--line); background: #fff; font: inherit; font-size: .88rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }

        .btn { display: inline-flex; align-items: center; gap: 8px; height: 42px; padding: 0 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; transition: background .2s, transform .2s, border-color .2s, color .2s, box-shadow .2s; white-space: nowrap; }
        .btn:active { transform: scale(.98); }
        .btn-primary { background: var(--navy); color: #fff; box-shadow: 0 4px 6px -1px rgba(37,99,235,0.1); }
        .btn-primary:hover { background: var(--navy-d); box-shadow: 0 6px 8px -1px rgba(37,99,235,0.2); }
        .btn-outline { background: #fff; border: 1.5px solid var(--line); color: var(--ink); }
        .btn-outline:hover { border-color: var(--ink); background: var(--paper); }
        .btn-success { background: var(--green); color: #fff; }
        .btn-success:hover { background: #15803d; }

        /* Dropdown Native */
        details.dropdown { position: relative; display: inline-block; }
        details.dropdown summary { list-style: none; cursor: pointer; background: var(--steel); color: #fff; }
        details.dropdown summary::-webkit-details-marker { display: none; }
        details.dropdown summary:hover { background: #475569; }
        details.dropdown[open] summary { background: var(--ink); }
        .dropdown-menu { position: absolute; top: calc(100% + 8px); right: 0; background: #fff; border: 1px solid var(--line); border-radius: 12px; box-shadow: var(--shadow-md); min-width: 220px; z-index: 100; padding: 8px; display: grid; gap: 4px; }
        .dropdown-menu a { padding: 10px 14px; font-size: .88rem; font-weight: 600; color: var(--ink); border-radius: 8px; display: flex; align-items: center; gap: 10px; transition: background .2s; }
        .dropdown-menu a:hover { background: var(--paper); }
        .dropdown-menu a i.fa-print { color: var(--blue); }
        .dropdown-menu a i.fa-file-excel { color: var(--green); }

        /* ==========================================================
           TAB PANEL
           ========================================================== */
        .tabs { display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: var(--shadow-xs); overflow-x: auto; scrollbar-width: none; margin-bottom: 20px; }
        .tabs::-webkit-scrollbar { display: none; }
        .tab { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 10px 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; color: var(--steel); transition: background .2s, color .2s; }
        .tab i { font-size: .9rem; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-selected="true"] { background: var(--navy); color: #fff; }

        .panel[hidden] { display: none; }

        /* ==========================================================
           TABEL & BADGES
           ========================================================== */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; margin-top: 10px; box-shadow: var(--shadow-xs); }
        .table-scroll { overflow-x: auto; }
        .data-table { font-size: .85rem; min-width: 780px; }

        .data-table thead th { position: sticky; top: 0; z-index: 5; background: var(--paper); color: var(--steel); padding: 14px 16px; font-weight: 800; font-size: .68rem; letter-spacing: .05em; text-transform: uppercase; text-align: left; border-bottom: 2px solid var(--line); }
        .data-table thead th.c { text-align: center; }

        /* Style Header khusus Tabel Pengadaan (Bordered) */
        .data-table.bordered th, .data-table.bordered td { border: 1px solid var(--line); }
        .data-table.bordered thead th { border-color: var(--line); background: var(--paper); color: var(--steel); }
        .data-table.bordered thead th.bg-blue { background: var(--navy); color: #fff; border-color: var(--navy-d); }
        .data-table.bordered thead th.bg-light-col { background: #eef2f7; color: var(--ink); border-color: var(--line); }

        .data-table tbody td { padding: 14px 16px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
        .data-table tbody td.c { text-align: center; }
        .data-table tbody tr:hover { background: var(--paper); }
        .data-table tbody tr:last-child td { border-bottom: 0; }

        /* Total Row */
        .row-total { background: var(--paper); border-top: 3px solid var(--line) !important; }
        .row-total td { font-weight: 800; font-size: .95rem; }

        .cell-name { font-weight: 700; font-size: .92rem; margin-bottom: 4px; color: var(--ink); }
        .cell-empty { text-align: center; padding: 48px 16px; color: var(--steel-soft); font-weight: 600; }

        /* Badges / Pills */
        .badge-qty { display: inline-flex; align-items: center; justify-content: center; padding: 5px 12px; border-radius: 8px; font-weight: 800; font-size: .85rem; min-width: 45px; border: 1px solid transparent; }
        .bg-butuh { background: #f1f5f9; color: #334155; border-color: #cbd5e1; }
        .bg-sedia { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
        .bg-kurang { background: var(--signal-tint); color: var(--signal-d); border-color: #f9c9c4; }
        .bg-aman { background: #f0f9ff; color: #0284c7; border-color: #bae6fd; }
        .bg-masuk { background: #eff6ff; color: var(--blue); border-color: #bfdbfe; }
        .bg-success-solid { background: var(--green); color: #fff; padding: 4px 10px; border-radius: 6px; font-size: .8rem; }
        .txt-mini { font-size: .7rem; color: var(--steel); font-weight: 700; margin-top: 4px; display: block; }

        .row-actions { display: inline-flex; gap: 6px; justify-content: center; }
        .icon-btn { width: 32px; height: 32px; border-radius: 9px; display: inline-grid; place-items: center; font-size: .82rem; color: #fff; transition: filter .2s, transform .2s; }
        .icon-btn:hover { filter: brightness(.92); transform: translateY(-1px); }
        .icon-btn.edit { background: var(--amber); color: var(--ink); }
        .icon-btn.delete { background: var(--signal); }
        .icon-btn.delete-sm { width: 24px; height: 24px; border-radius: 6px; font-size: .75rem; background: transparent; color: var(--signal); padding: 0; }
        .icon-btn.delete-sm:hover { color: var(--signal-d); background: var(--signal-tint); transform: none; }

        .f-alert { display: flex; align-items: flex-start; gap: 10px; padding: 12px 14px; border-radius: 12px; font-size: .82rem; line-height: 1.45; margin-bottom: 16px; }
        .f-alert.info { background: #eff6ff; color: #1e3a8a; border: 1px solid #bfdbfe; }
        .f-alert.warn { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }

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
        .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid var(--line); border-radius: 12px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }
        select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
        .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media (max-width: 480px) { .f-row { grid-template-columns: 1fr; } }

        .btn-cancel { height: 42px; padding: 0 18px; border-radius: 999px; background: var(--paper); color: var(--ink); font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-cancel:hover { background: var(--line); }
        .btn-save { height: 42px; padding: 0 22px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 700; font-size: .86rem; transition: background .2s; }
        .btn-save:hover { background: var(--navy-d); }
        .btn-save.success { background: var(--green); }
        .btn-save.success:hover { background: #15803d; }

        /* ==========================================================
           CETAK
           ========================================================== */
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .tabs, .row-actions, dialog, .toast-wrap { display: none !important; }
            body { background: #fff !important; }
            .shell { display: block !important; }
            .content { padding: 0 !important; overflow: visible !important; height: auto !important; }
            .table-wrap { border: none !important; box-shadow: none !important; }
            .panel { display: none !important; }
            .panel[data-print-active] { display: block !important; }
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
                    <a href="/sapra/sarana-pemeriksaan" class="side-a {{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana pemeriksaan proteksi kebakaran</a>
                    <a href="/sapra/kelola-pos" class="side-a {{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-sub-kicker">MANAJEMEN AIR</span>
                    <a href="/sapra/data_hidrant_gedung" class="side-a {{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="side-a {{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data hidrant Kota Jambi</a>

                    <span class="side-sub-kicker">LOGISTIK &amp; DISTRIBUSI</span>
                    <!-- ACTIVE karena ini halaman Mutu Baku Kebutuhan -->
                    <a href="/sapra/kebutuhan-sarpras" class="side-a active"><i class="fas fa-clipboard-check"></i> Mutu baku kebutuhan</a>
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
                <h1>MUTU BAKU {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h1>
                <p>Rekapitulasi analisis kebutuhan sarana prasarana dan riwayat pengadaan tahunan.</p>
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari uraian barang</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari uraian barang..." autocomplete="off">
                </label>

                <!-- DROPDOWN CETAK NATIVE CSS -->
                <details class="dropdown">
                    <summary class="btn btn-outline" aria-haspopup="menu"><i class="fas fa-print"></i> Cetak / Export</summary>
                    <div class="dropdown-menu" role="menu">
                        <a href="/sapra/kebutuhan-sarpras/cetak" target="_blank"><i class="fas fa-print"></i> Cetak Dokumen (Print)</a>
                        <a href="/sapra/kebutuhan-sarpras/cetak?export=excel"><i class="fas fa-file-excel"></i> Download Excel (.xls)</a>
                    </div>
                </details>

                <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah Kebutuhan</button>
            </div>
        </div>

        @php $activeTab = session('active_tab', 'mutubaku'); @endphp

        <!-- TABS (MUTU BAKU vs PENGADAAN) -->
        <nav class="tabs" role="tablist" aria-label="Pilih tabel">
            <button type="button" class="tab" role="tab" data-tab="panel-mutubaku" aria-selected="{{ $activeTab == 'mutubaku' ? 'true' : 'false' }}">
                <i class="fas fa-clipboard-list"></i> Mutu Baku Kebutuhan
            </button>
            <button type="button" class="tab" role="tab" data-tab="panel-pengadaan" aria-selected="{{ $activeTab == 'pengadaan' ? 'true' : 'false' }}">
                <i class="fas fa-truck-loading"></i> Riwayat Pengadaan
            </button>
        </nav>

        <!-- PANEL 1: MUTU BAKU -->
        <div class="panel" id="panel-mutubaku" role="tabpanel" @if($activeTab != 'mutubaku') hidden @endif @if($activeTab == 'mutubaku') data-print-active @endif>
            <div class="table-wrap">
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="c" style="width:5%">No</th>
                                <th style="width:35%">Uraian Barang / Jasa</th>
                                <th class="c" style="width:15%">Dibutuhkan</th>
                                <th class="c" style="width:10%">Tersedia</th>
                                <th class="c" style="width:15%; background-color: var(--navy); color: #fff;">Masuk Thn {{ date('Y') }}</th>
                                <th class="c" style="width:10%">Belum Tersedia</th>
                                <th class="c" style="width:10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataKebutuhan as $index => $item)
                            <tr class="data-row">
                                <td class="c">{{ $loop->iteration }}</td>
                                <td class="data-name">
                                    <div class="cell-name">{{ $item->uraian }}</div>
                                </td>
                                <td class="c"><span class="badge-qty bg-butuh">{{ $item->jumlah_dibutuhkan }}</span></td>
                                <td class="c"><span class="badge-qty bg-sedia">{{ $item->jumlah_tersedia }}</span></td>

                                <td class="c">
                                    @if(isset($realisasiTahunIni) && isset($realisasiTahunIni[$item->id]))
                                        <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                            <span class="bg-success-solid">+{{ $realisasiTahunIni[$item->id]->total_masuk }} Unit</span>
                                            <span class="txt-mini"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($realisasiTahunIni[$item->id]->tgl_masuk)->format('d M Y') }}</span>
                                        </div>
                                    @else
                                        <span style="color: var(--steel); font-size: 1.2rem;">-</span>
                                    @endif
                                </td>

                                <td class="c">
                                    @if($item->jumlah_belum_tersedia > 0)
                                        <span class="badge-qty bg-kurang">{{ $item->jumlah_belum_tersedia }}</span>
                                    @else
                                        <span class="badge-qty bg-aman"><i class="fas fa-check" style="margin-right:4px;"></i> Lengkap</span>
                                    @endif
                                </td>

                                <td class="c">
                                    <div class="row-actions">
                                        <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                        <form action="/sapra/kebutuhan-sarpras/delete/{{ $item->id }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus data kebutuhan ini? Semua riwayat pengadaannya juga akan ikut terhapus lho!');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dialog Edit Mutu Baku -->
                            <dialog class="sheet" id="dlgEdit{{ $item->id }}">
                                <div class="sheet-head">
                                    <h2>Edit Data Kebutuhan</h2>
                                    <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                </div>
                                <form action="/sapra/kebutuhan-sarpras/update/{{ $item->id }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="sheet-body">
                                        <div>
                                            <label class="f-label" for="uraian{{ $item->id }}">Uraian Barang / Jasa</label>
                                            <input class="f-input" type="text" id="uraian{{ $item->id }}" name="uraian" value="{{ $item->uraian }}" required>
                                        </div>
                                        <div class="f-row">
                                            <div>
                                                <label class="f-label" for="butuh{{ $item->id }}">Target Dibutuhkan</label>
                                                <input class="f-input" type="number" id="butuh{{ $item->id }}" name="jumlah_dibutuhkan" value="{{ $item->jumlah_dibutuhkan }}" required>
                                            </div>
                                            <div>
                                                <label class="f-label" for="sedia{{ $item->id }}">Stok Saat Ini (Tersedia)</label>
                                                <input class="f-input" type="number" id="sedia{{ $item->id }}" name="jumlah_tersedia" value="{{ $item->jumlah_tersedia }}" required>
                                            </div>
                                        </div>
                                        <div class="f-alert warn">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <div><b>Catatan:</b> Sebaiknya update Stok (Tersedia) melalui menu <b>Riwayat Pengadaan</b> agar tercatat historinya. Ubah angka di sini hanya untuk penyesuaian stok awal.</div>
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
                                <td colspan="7" class="cell-empty">Belum ada data mutu baku.</td>
                            </tr>
                            @endforelse

                            <!-- Baris Total -->
                            @if(isset($dataKebutuhan) && $dataKebutuhan->count() > 0)
                                <tr class="row-total">
                                    <td colspan="2" style="text-align: right; padding-right: 20px;">TOTAL KESELURUHAN :</td>
                                    <td class="c"><span class="badge-qty bg-butuh">{{ $dataKebutuhan->sum('jumlah_dibutuhkan') }}</span></td>
                                    <td class="c"><span class="badge-qty bg-sedia">{{ $dataKebutuhan->sum('jumlah_tersedia') }}</span></td>
                                    <td class="c"><span class="badge-qty bg-masuk">+{{ isset($realisasiTahunIni) ? $realisasiTahunIni->sum('total_masuk') : 0 }}</span></td>
                                    <td class="c"><span class="badge-qty bg-kurang">{{ $dataKebutuhan->sum('jumlah_belum_tersedia') }}</span></td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- PANEL 2: RIWAYAT PENGADAAN -->
        <div class="panel" id="panel-pengadaan" role="tabpanel" @if($activeTab != 'pengadaan') hidden @endif @if($activeTab == 'pengadaan') data-print-active @endif>

            <div style="display: flex; justify-content: flex-end; margin-bottom: 14px;">
                <button class="btn btn-success" data-open="dlgTambahPengadaan"><i class="fas fa-truck-loading"></i> Input Riwayat Pengadaan</button>
            </div>

            <div class="table-wrap">
                <div class="table-scroll">
                    <!-- Class bordered agar Header Excel-like rapi -->
                    <table class="data-table bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" class="c" style="width:5%; vertical-align: middle;">No</th>
                                <th rowspan="2" style="width:25%; vertical-align: middle;">Nama Barang</th>
                                <th colspan="{{ count($listTahun ?? []) }}" class="c" style="border-bottom: 1px solid var(--line);">Tahun Pengadaan</th>
                                <th rowspan="2" class="c bg-blue" style="width:10%; vertical-align: middle;">Stok</th>
                            </tr>
                            <tr>
                                @foreach($listTahun ?? [] as $tahun)
                                    <th class="c bg-light-col">{{ $tahun }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataKebutuhan as $item)
                                <tr class="data-row">
                                    <td class="c">{{ $loop->iteration }}</td>
                                    <td class="data-name">
                                        <div class="cell-name">{{ $item->uraian }}</div>
                                    </td>

                                    @foreach($listTahun as $tahun)
                                        <td class="c">
                                            @if(isset($pengadaanMapped[$item->id][$tahun]))
                                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                                    <span style="font-weight: 700; color: var(--ink);">{{ $pengadaanMapped[$item->id][$tahun] }}</span>
                                                    <form action="/sapra/pengadaan-sarpras/delete/{{ $item->id }}/{{ $tahun }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin membatalkan pengadaan tahun {{ $tahun }} ini? Stok Mutu Baku akan otomatis dikurangi kembali.');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="icon-btn delete-sm" title="Batalkan Pengadaan"><i class="fas fa-times"></i></button>
                                                    </form>
                                                </div>
                                            @else
                                                <span style="color: var(--steel);">-</span>
                                            @endif
                                        </td>
                                    @endforeach

                                    <td class="c" style="background: var(--paper); font-weight: 800; color: var(--navy);">
                                        {{ $item->jumlah_tersedia }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($listTahun ?? []) + 3 }}" class="cell-empty">Belum ada data barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- ==================== DIALOG TAMBAH KEBUTUHAN ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah Kebutuhan Baru</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/kebutuhan-sarpras/store" method="POST">
        @csrf
        <div class="sheet-body">
            <div>
                <label class="f-label" for="tambahUraian">Uraian Barang / Jasa</label>
                <input class="f-input" type="text" id="tambahUraian" name="uraian" placeholder="Contoh: MOBIL KOMANDO" required>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahButuh">Jumlah Dibutuhkan</label>
                    <input class="f-input" type="number" id="tambahButuh" name="jumlah_dibutuhkan" value="0" required>
                </div>
                <div>
                    <label class="f-label" for="tambahSedia">Jumlah Tersedia (Stok Awal)</label>
                    <input class="f-input" type="number" id="tambahSedia" name="jumlah_tersedia" value="0" required>
                </div>
            </div>
            <div class="f-alert info">
                <i class="fas fa-info-circle"></i>
                <div>Kolom "Belum Tersedia" akan dihitung otomatis oleh sistem berdasarkan input Anda.</div>
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save">Simpan data</button>
        </div>
    </form>
</dialog>

<!-- ==================== DIALOG TAMBAH PENGADAAN ==================== -->
<dialog class="sheet" id="dlgTambahPengadaan">
    <div class="sheet-head">
        <h2>Input Riwayat Pengadaan Baru</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/pengadaan-sarpras/store" method="POST">
        @csrf
        <div class="sheet-body">
            <div class="f-alert info" style="margin-bottom: 0;">
                <i class="fas fa-info-circle"></i>
                <div>Data yang diinput di sini akan otomatis <b>menambah STOK</b> di tabel Mutu Baku Kebutuhan.</div>
            </div>
            <div>
                <label class="f-label" for="kebutuhan_id">Pilih Barang / Jasa</label>
                <select class="f-input" id="kebutuhan_id" name="kebutuhan_id" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($dataKebutuhan as $item)
                        <option value="{{ $item->id }}">{{ $item->uraian }}</option>
                    @endforeach
                </select>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tahun">Tahun Pengadaan</label>
                    <input class="f-input" type="number" id="tahun" name="tahun" value="{{ date('Y') }}" max="{{ date('Y') }}" required>
                </div>
                <div>
                    <label class="f-label" for="jumlah">Jumlah Masuk (Unit)</label>
                    <input class="f-input" type="number" id="jumlah" name="jumlah" min="1" placeholder="Cth: 5" required>
                </div>
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save success">Simpan pengadaan</button>
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

    /* ---------- Native Dropdown Tutup Otomatis ---------- */
    document.addEventListener('click', function(e) {
        document.querySelectorAll('details.dropdown').forEach(function(d) {
            if (!d.contains(e.target)) d.removeAttribute('open');
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
                if (row.classList.contains('row-total')) return;

                var cell = row.querySelector('.data-name');
                if (cell) {
                    row.style.display = cell.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
                }
            });
        });
    }
})();
</script>
</body>
</html>