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
           SIMERAH KOJA - CLEAN NAVY DASHBOARD TOKENS
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
            --signal-tint: #fdeceb;

            --amber: #f4b740;
            --green: #16a34a;
            --success: #198754;
            --blue: #2563eb;
            --blue-d: #1d4fd6;

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
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; overflow: hidden; }
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; transition: color .2s, background .2s, border-color .2s; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; transition: background .2s, color .2s, transform .2s, box-shadow .2s; }
        table { border-collapse: collapse; width: 100%; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

        /* ==========================================================
           MODERN SCROLLBAR
           ========================================================== */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d5dce6; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ==========================================================
           TOAST
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; background: var(--success); }
        .toast.err .toast-ico { background: var(--signal); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* ==========================================================
           TOPBAR (CLEAN NAVY)
           ========================================================== */
        .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s, transform .2s; }
        .side-toggle:hover { background: rgba(255,255,255,.10); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }

        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); transition: background .2s; }
        .user-chip:hover { background: rgba(255,255,255,.12); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
        .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, box-shadow .2s; }
        .btn-logout:hover { background: #e8eef5; box-shadow: 0 4px 10px rgba(0,0,0,.12); }

        @media (max-width: 900px) { .side-toggle { display: inline-flex; } .user-meta { display: none; } .topbar { padding: 0 16px; } }

        /* ==========================================================
           SHELL & SIDEBAR (CLEAN NAVY)
           ========================================================== */
        .shell { display: flex; align-items: flex-start; height: calc(100vh - var(--topbar-h)); }

        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; display: flex; flex-direction: column; gap: 4px; }

        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
        .side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
        .side-link.active { background: var(--navy-soft); color: var(--navy); font-weight: 700; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link:hover i, .side-link.active i { color: var(--navy); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .chev { margin-left: auto; font-size: 0.65rem; transition: transform .25s ease; }
        .side-group[open] > summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }

        .side-kicker { padding: 18px 14px 6px; font-size: 0.68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); margin-top: 8px; }
        .side-sub-kicker { display: block; padding: 12px 12px 4px 0; font-size: 0.65rem; font-weight: 800; color: var(--steel-soft); text-transform: uppercase; letter-spacing: 0.05em; }
        .side-divider { height: 1px; background: var(--line); margin: 6px 14px; flex: none; }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: var(--shadow-lg); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           KONTEN HALAMAN
           ========================================================== */
        .content { flex: 1; min-width: 0; height: 100%; overflow-y: auto; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

        .page-toolbar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 26px; }
        .page-toolbar h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; color: var(--ink); margin-bottom: 5px; text-transform: uppercase; }
        .page-toolbar p { color: var(--steel); font-size: .95rem; }
        .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }

        .search { position: relative; width: 280px; max-width: 100%; }
        .search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .search input { width: 100%; height: 44px; padding: 0 16px 0 42px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font: inherit; font-size: .9rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

        .btn { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-weight: 600; font-size: .88rem; transition: background .2s, transform .1s, box-shadow .2s; white-space: nowrap; border: none; }
        .btn:active { transform: translateY(0); }
        .btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-sm); }
        .btn-primary { background: var(--navy); color: #fff; }
        .btn-primary:hover { background: var(--navy-dark); }
        .btn-outline { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
        .btn-outline:hover { border-color: var(--navy); background: var(--paper); }
        .btn-outline.red { color: var(--signal); border-color: var(--signal); }
        .btn-outline.red:hover { background: var(--signal); color: #fff; border-color: var(--signal); }
        .btn-xs { height: 34px; padding: 0 14px; font-size: .78rem; }

        /* ==========================================================
           TABEL GROUPED (TREE-VIEW)
           ========================================================== */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; margin-top: 10px; box-shadow: var(--shadow-xs); transition: box-shadow .2s, border-color .2s; }
        .table-wrap:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
        .table-scroll { overflow-x: auto; }
        .data-table { font-size: .88rem; min-width: 800px; width: 100%; text-align: left; }
        .data-table thead th { background: var(--paper); color: var(--steel); padding: 16px 14px; font-weight: 700; font-size: .75rem; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap; border-bottom: 1px solid var(--line); position: sticky; top: 0; z-index: 10; text-align: left; }
        .data-table thead th.c { text-align: center; }

        /* Baris Kelompok (Nama Staff) */
        .staff-group { border-bottom: 4px solid var(--paper); }
        .staff-header td { background: #f8fafc; border-bottom: 1px solid var(--line); border-top: 1px solid var(--line); padding: 14px 16px; vertical-align: middle; }
        .staff-header .c { text-align: center; }
        .staff-info { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; }
        .staff-info-left { display: flex; align-items: center; gap: 12px; }
        .staff-icon { width: 34px; height: 34px; border-radius: 50%; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .85rem; }
        .staff-name { font-weight: 700; font-size: .98rem; color: var(--ink); text-transform: uppercase; letter-spacing: .3px; }
        .staff-count { background: var(--navy-light); color: var(--navy); padding: 4px 10px; border-radius: 999px; font-size: .75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; }
        .staff-num { font-weight: 800; font-size: 1.05rem; color: var(--navy); }

        /* Baris Detail (Barang) */
        .data-table tbody.staff-group tr.data-row td { padding: 14px 16px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); transition: background .2s; }
        .data-table tbody.staff-group tr.data-row:hover td { background: #f8fafc; }
        .data-table tbody.staff-group tr.data-row:last-child td { border-bottom: none; }
        .data-table tr.data-row td.c { text-align: center; }
        .tree-line { border-right: 2px solid var(--line); background: #f8fafc !important; }

        .chip-barang { display: inline-block; background: var(--navy-light); color: var(--navy); padding: 6px 12px; border-radius: 6px; font-weight: 700; border: 1px solid #cfdcec; font-size: .8rem; }
        .chip-qty { background: #fff; color: var(--navy-dark); padding: 2px 6px; border-radius: 4px; font-size: .75rem; margin-left: 6px; border: 1px solid #cfdcec; }
        .detail-txt { font-size: .75rem; color: var(--steel); font-weight: 600; margin-top: 6px; }
        .time-date { font-weight: 700; color: var(--ink); }
        .time-clock { font-size: .75rem; color: var(--steel); font-weight: 600; margin-top: 4px; }
        .ket-txt { font-size: .8rem; color: var(--steel); font-weight: 500; }

        .cell-empty { text-align: center; padding: 60px 16px; color: var(--steel-soft); font-weight: 600; font-size: 1rem; }

        .row-actions { display: inline-flex; gap: 8px; justify-content: center; }
        .icon-btn { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; font-size: .85rem; color: #fff; transition: background .2s, transform .1s; border: none; cursor: pointer; }
        .icon-btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-xs); }
        .icon-btn.edit { background: var(--navy); }
        .icon-btn.edit:hover { background: var(--navy-dark); }
        .icon-btn.delete { background: var(--signal); }
        .icon-btn.delete:hover { background: var(--signal-dark); }

        /* ==========================================================
           DIALOG (TAMBAH / EDIT)
           ========================================================== */
        dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-md); width: min(560px, calc(100vw - 24px)); max-height: min(90vh, 780px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: var(--shadow-lg); }
        dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
        dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
        @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }

        .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 20px 24px; border-bottom: 1px solid var(--line); background: #fafafa; }
        .sheet-head h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--ink); margin: 0; }
        .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; color: var(--steel); border: none; cursor: pointer; }
        .sheet-x:hover { background: var(--signal-tint); color: var(--signal-dark); }

        .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
        .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: #fafafa; display: flex; justify-content: flex-end; gap: 12px; }

        .f-label { display: block; margin-bottom: 6px; font-size: .84rem; font-weight: 600; color: var(--ink); }
        .f-optional { font-weight: 500; color: var(--steel); }
        .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        .f-input::placeholder { color: var(--steel-soft); }
        .f-input[readonly] { cursor: not-allowed; }
        select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
        textarea.f-input { padding-top: 12px; padding-bottom: 12px; height: auto; min-height: 80px; resize: vertical; }
        .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 480px) { .f-row { grid-template-columns: 1fr; } }

        .f-alert { display: flex; align-items: flex-start; gap: 10px; padding: 12px 16px; border-radius: 8px; font-size: .85rem; line-height: 1.5; }
        .f-alert.info { background: #eff6ff; color: #1e3a8a; border: 1px solid #bfdbfe; }

        .btn-cancel { height: 42px; padding: 0 20px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); font-weight: 600; font-size: .88rem; transition: background .2s, border-color .2s; cursor: pointer; }
        .btn-cancel:hover { background: var(--paper); border-color: var(--steel); }
        .btn-save { height: 42px; padding: 0 24px; border-radius: 8px; background: var(--navy); color: #fff; border: none; font-weight: 600; font-size: .88rem; transition: background .2s; cursor: pointer; }
        .btn-save:hover { background: var(--navy-dark); }

        /* ==========================================================
           SEARCHABLE SELECT (Jenis Barang)
           ========================================================== */
        .ss { position: relative; }
        .ss-btn { display: flex; align-items: center; justify-content: space-between; gap: 8px; width: 100%; height: 44px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); text-align: left; cursor: pointer; transition: border-color .2s, box-shadow .2s; }
        .ss-btn span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .ss-btn.placeholder span { color: var(--steel-soft); }
        .ss-btn i { font-size: .7rem; color: var(--steel); transition: transform .2s; flex: none; }
        .ss.open .ss-btn { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        .ss.open .ss-btn i { transform: rotate(180deg); }
        .ss-panel { display: none; margin-top: 6px; background: #fff; border: 1px solid var(--line-dark); border-radius: 8px; box-shadow: var(--shadow-sm); overflow: hidden; }
        .ss.open .ss-panel { display: block; }
        .ss-search { position: relative; padding: 8px; border-bottom: 1px solid var(--line); background: var(--paper); }
        .ss-search i { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .8rem; pointer-events: none; }
        .ss-search input { width: 100%; height: 38px; padding: 0 12px 0 34px; border: 1px solid var(--line-dark); border-radius: 6px; font: inherit; font-size: .88rem; background: #fff; color: var(--ink); }
        .ss-search input:focus { outline: none; border-color: var(--navy); }
        .ss-list { max-height: 200px; overflow-y: auto; padding: 4px; }
        .ss-opt { padding: 9px 12px; border-radius: 6px; font-size: .88rem; cursor: pointer; color: var(--ink); }
        .ss-opt:hover, .ss-opt.hl { background: var(--paper); color: var(--blue-d); }
        .ss-opt.sel { background: var(--navy-light); color: var(--navy-dark); font-weight: 700; }
        .ss-opt mark { background: #fff3c4; color: inherit; border-radius: 3px; padding: 0 1px; }
        .ss-empty { padding: 16px; text-align: center; color: var(--steel-soft); font-size: .85rem; font-weight: 600; }
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
            <button type="submit" class="btn-logout"><i class="fas fa-arrow-right-from-bracket"></i> <span>Keluar</span></button>
        </form>
    </div>
</header>

<div class="shell">
    <div class="sidebar-backdrop" id="sideBackdrop"></div>

    <!-- ==================== SIDEBAR MASTER ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">

        <a href="/internal/index" class="side-link {{ Request::is('internal/index') || Request::is('/') ? 'active' : '' }}">
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
        @endif

        @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary>
                    <i class="fas fa-fire-extinguisher grp-ico"></i>
                    <span class="grp-label">BAGIAN PEMADAMAN</span>
                    <i class="fas fa-chevron-down chev"></i>
                </summary>
                <div class="side-sub">
                   <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Kelola Data Laporan
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') ? 'active' : '' }}">
                        <i class="fas fa-folder"></i> Kelola Surat Korban
                    </a>
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
                <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i> Data Urut Kepegawaian
        </a>
        
        <!-- Tambahan Tombol Program Kerja -->
        <a href="/internal/program-kerja" class="{{ Request::is('internal/program-kerja*') ? 'active' : '' }}">
            <i class="fas fa-file-contract"></i> Program Kerja
        </a> 
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
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan &amp; Evakuasi</a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi kebakaran</a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                    <span class="side-sub-kicker">MANAJEMEN AIR</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                    <span class="side-sub-kicker">LOGISTIK &amp; DISTRIBUSI</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    <!-- AKTIF DISINI SESUAI KONTEN -->
                    <a href="/sapra/distribusi-staff" class="active"><i class="fas fa-people-carry-box"></i> Serah Terima Barang</a>
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
                  <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i> Input &amp; Kelola Berita
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i> Kelola Info Grafis
                    </a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                        <i class="fab fa-instagram"></i> Kelola Berita Medsos
                    </a>
                    <a href="/internal/operator/ujung-damkar" class="{{ Request::is('internal/operator/ujung-damkar*') ? 'active' : '' }}">
                        <i class="fab fa-youtube"></i> Ujung-Ujung Damkar
                    </a>
                    <a href="/internal/operator/edu-damkar" class="{{ Request::is('internal/operator/edu-damkar*') ? 'active' : '' }}">
                                            <i class="fas fa-graduation-cap"></i> Edu Damkar
                    </a>
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
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola pengguna</a>
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
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari nama staff atau barang</span>
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
                            <th class="c" style="width:5%">NO</th>
                            <th style="width:25%">NAMA PENERIMA</th>
                            <th class="c" style="width:25%">BARANG / INVENTARIS</th>
                            <th class="c" style="width:15%">WAKTU TERIMA</th>
                            <th style="width:20%">KETERANGAN</th>
                            <th class="c" style="width:10%">AKSI</th>
                        </tr>
                    </thead>

                    @forelse($dataDistribusi as $nama => $items)
                        <tbody class="staff-group">
                            <!-- HEADER NAMA STAFF -->
                            <tr class="staff-header">
                                <td class="c staff-num">{{ $loop->iteration }}</td>
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
                                        <span class="chip-barang">{{ $item->nama_barang }} <span class="chip-qty">{{ $item->jumlah ?? 1 }} Unit</span></span>
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
                                            <form action="/sapra/distribusi-staff/delete/{{ $item->id }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus data penerimaan ini? Stok Mutu Baku akan dikembalikan otomatis.');">
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
                                                    <label class="f-label">Jenis Barang (Dari Mutu Baku)</label>
                                                    <select class="f-input" id="editBarang{{ $item->id }}" name="kebutuhan_id" required>
                                                        <option value="">— Pilih Barang —</option>
                                                        @foreach($dataBarang as $barang)
                                                            <option value="{{ $barang->id }}" {{ $item->kebutuhan_id == $barang->id ? 'selected' : '' }}>{{ $barang->uraian }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="editJumlah{{ $item->id }}">Jumlah Diberikan</label>
                                                    <input class="f-input" type="number" id="editJumlah{{ $item->id }}" name="jumlah" value="{{ $item->jumlah ?? 1 }}" min="1" required>
                                                </div>
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="editDetail{{ $item->id }}">Detail <span class="f-optional">(Warna/Ukuran)</span></label>
                                                    <input class="f-input" type="text" id="editDetail{{ $item->id }}" name="detail_barang" value="{{ $item->detail_barang }}">
                                                </div>
                                                <div>
                                                    <label class="f-label" for="editWaktu{{ $item->id }}">Waktu Serah Terima</label>
                                                    <input class="f-input" type="datetime-local" id="editWaktu{{ $item->id }}" name="waktu_terima" value="{{ \Carbon\Carbon::parse($item->waktu_terima)->format('Y-m-d\TH:i') }}" required>
                                                </div>
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
            <div class="f-alert info">
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
                    <label class="f-label">Jenis Barang (Dari Mutu Baku)</label>
                    <select class="f-input" id="tambahJenis" name="kebutuhan_id" required>
                        <option value="">— Pilih Barang —</option>
                        @foreach($dataBarang as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->uraian }}</option>
                        @endforeach
                    </select>
                    <p class="f-hint" style="font-size: 0.75rem; color: var(--signal); margin-top: 4px;">*Akan memotong stok secara otomatis.</p>
                </div>
                <div>
                    <label class="f-label" for="tambahJumlah">Jumlah Diberikan</label>
                    <input class="f-input" type="number" id="tambahJumlah" name="jumlah" value="1" min="1" required>
                </div>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahDetail">Detail <span class="f-optional">(Warna/Ukuran)</span></label>
                    <input class="f-input" type="text" id="tambahDetail" name="detail_barang" placeholder="Contoh: Coklat / Uk. 42">
                </div>
                <div>
                    <label class="f-label" for="tambahWaktu">Waktu Serah Terima</label>
                    <input class="f-input" type="datetime-local" id="tambahWaktu" name="waktu_terima" value="{{ date('Y-m-d\TH:i') }}" required>
                </div>
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

    /* ---------- Modal / Dialog ---------- */
    // Logika Pintar untuk tombol "Tambah Barang" (Global vs Inline)
    document.querySelectorAll('[data-open="dlgTambah"]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var nama = btn.getAttribute('data-nama') || '';
            var inputNama = document.getElementById('inputNamaPenerima');

            inputNama.value = nama;
            if (nama !== '') {
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
            var staffGroups = document.querySelectorAll('.staff-group');

            staffGroups.forEach(function (group) {
                var matchInGroup = false;

                // Cek nama header staf-nya
                var headerText = group.querySelector('.staff-name-search').textContent.toLowerCase();
                if (headerText.indexOf(filter) !== -1) matchInGroup = true;

                // Cek isi barangnya
                var rows = group.querySelectorAll('.data-row');
                rows.forEach(function (row) {
                    var textBarang = row.querySelector('.data-barang').textContent.toLowerCase();
                    // Munculin baris kalau nama barangnya cocok, ATAU kalau nama staf-nya yang dicari
                    if (textBarang.indexOf(filter) !== -1 || headerText.indexOf(filter) !== -1) {
                        row.style.display = '';
                        matchInGroup = true; // Ketemu di dalam grup ini
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Kalau ada yang cocok di grup ini, tampilkan grupnya (termasuk headernya)
                if (matchInGroup) {
                    group.style.display = '';
                    group.querySelector('.staff-header').style.display = '';
                } else {
                    group.style.display = 'none';
                }
            });
        });
    }

    /* ---------- Searchable Select (realtime) untuk Jenis Barang ---------- */
    function makeSearchable(select) {
        var wrap = document.createElement('div');
        wrap.className = 'ss';
        wrap.innerHTML =
            '<button type="button" class="ss-btn placeholder" aria-haspopup="listbox" aria-expanded="false"><span></span><i class="fas fa-chevron-down"></i></button>' +
            '<div class="ss-panel">' +
                '<div class="ss-search"><i class="fas fa-search"></i><input type="text" placeholder="Ketik untuk mencari barang..." autocomplete="off"></div>' +
                '<div class="ss-list" role="listbox"></div>' +
            '</div>';

        select.parentNode.insertBefore(wrap, select);
        select.style.display = 'none';
        select.removeAttribute('required'); // validasi manual di bawah (select hidden nggak bisa difokus browser)
        wrap.appendChild(select);

        var btn = wrap.querySelector('.ss-btn');
        var label = btn.querySelector('span');
        var input = wrap.querySelector('.ss-search input');
        var list = wrap.querySelector('.ss-list');
        var options = Array.prototype.slice.call(select.options).filter(function (o) { return o.value !== ''; });
        var placeholderText = select.options[0] ? select.options[0].textContent : '— Pilih Barang —';
        var hlIndex = -1;

        function esc(s) {
            return s.replace(/[&<>"]/g, function (c) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
            });
        }

        function syncLabel() {
            var cur = options.find(function (o) { return o.value === select.value; });
            label.textContent = cur ? cur.textContent : placeholderText;
            btn.classList.toggle('placeholder', !cur);
        }

        function setHl() {
            var items = list.querySelectorAll('.ss-opt');
            items.forEach(function (el, i) { el.classList.toggle('hl', i === hlIndex); });
            if (items[hlIndex]) items[hlIndex].scrollIntoView({ block: 'nearest' });
        }

        function render(q) {
            q = (q || '').toLowerCase().trim();
            list.innerHTML = '';
            var shown = options.filter(function (o) { return o.textContent.toLowerCase().indexOf(q) !== -1; });
            if (!shown.length) {
                list.innerHTML = '<div class="ss-empty">Barang tidak ditemukan</div>';
                hlIndex = -1;
                return;
            }
            shown.forEach(function (o) {
                var d = document.createElement('div');
                d.className = 'ss-opt' + (o.value === select.value ? ' sel' : '');
                d.setAttribute('role', 'option');
                d.dataset.value = o.value;
                var text = o.textContent;
                if (q) {
                    var i = text.toLowerCase().indexOf(q);
                    d.innerHTML = esc(text.slice(0, i)) + '<mark>' + esc(text.slice(i, i + q.length)) + '</mark>' + esc(text.slice(i + q.length));
                } else {
                    d.textContent = text;
                }
                list.appendChild(d);
            });
            hlIndex = 0;
            setHl();
        }

        function open() {
            wrap.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
            input.value = '';
            render('');
            setTimeout(function () { input.focus(); }, 0);
        }
        function close() {
            wrap.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
        }
        function choose(val) {
            select.value = val;
            select.dispatchEvent(new Event('change', { bubbles: true }));
            syncLabel();
            close();
            btn.focus();
        }

        btn.addEventListener('click', function () { wrap.classList.contains('open') ? close() : open(); });
        input.addEventListener('input', function () { render(input.value); });
        input.addEventListener('keydown', function (e) {
            var items = list.querySelectorAll('.ss-opt');
            if (e.key === 'ArrowDown') { e.preventDefault(); hlIndex = Math.min(hlIndex + 1, items.length - 1); setHl(); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); hlIndex = Math.max(hlIndex - 1, 0); setHl(); }
            else if (e.key === 'Enter') { e.preventDefault(); if (items[hlIndex]) choose(items[hlIndex].dataset.value); }
            else if (e.key === 'Escape') { e.preventDefault(); e.stopPropagation(); close(); btn.focus(); }
        });
        list.addEventListener('mousedown', function (e) {
            var opt = e.target.closest('.ss-opt');
            if (opt) { e.preventDefault(); choose(opt.dataset.value); }
        });
        document.addEventListener('click', function (e) { if (!wrap.contains(e.target)) close(); });

        // Validasi: wajib pilih barang
        var form = select.closest('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!select.value) {
                    e.preventDefault();
                    btn.style.borderColor = 'var(--signal)';
                    open();
                }
            });
        }
        select.addEventListener('change', function () { btn.style.borderColor = ''; syncLabel(); });

        syncLabel();
    }

    document.querySelectorAll('select[name="kebutuhan_id"]').forEach(makeSearchable);
})();
</script>
</body>
</html>