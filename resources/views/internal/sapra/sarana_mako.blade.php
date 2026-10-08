@php
    /* ------------------------------------------------------------
       LOGIKA AKUN (Spatie Permission)
       Role: Super User, Sapra, Sekretariat, Damtan, Pencegahan, Operator
       Aturan: HANYA role "Sapra" yang boleh CRUD. Role lain: lihat & cetak saja.
       Mau tambah role lain yang boleh CRUD? Ubah satu baris $bisaCrud di bawah.
       ------------------------------------------------------------ */
   $user       = Auth::user();
    $namaRole   = $user->getRoleNames()->first() ?? '';
    $bisaCrud = $user->hasRole('Sapra') || $user->hasRole('Super User');
    $isSuper    = $user->hasRole('Super User');
    $bisaKonten = $user->hasAnyRole(['Operator', 'Super User']);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Sarana pemadam kebakaran | SIMERAH KOJA</title>
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
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; transition: background .2s, color .2s; }
        table { border-collapse: collapse; width: 100%; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

        /* SCROLLBAR */
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
        
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; display: flex; flex-direction: column; gap: 4px;}
        
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

        .page-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 26px; }
        .page-toolbar h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; color: var(--ink); margin-bottom: 5px;}
        .page-toolbar p { color: var(--steel); font-size: .95rem; }
        .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }

        /* Badge mode hanya-lihat (untuk role selain Sapra) */
        .mode-badge { display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; padding: 6px 14px; border-radius: 999px; background: var(--info-soft); color: var(--info); border: 1px solid rgba(37, 99, 235, .2); font-size: .78rem; font-weight: 700; }

        /* Pencarian & Tombol */
        .search { position: relative; width: 280px; max-width: 100%; }
        .search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .search input { width: 100%; height: 44px; padding: 0 16px 0 42px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font: inherit; font-size: .9rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

        .btn { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-weight: 600; font-size: .88rem; transition: background .2s, transform .1s, box-shadow .2s; white-space: nowrap; border: none;}
        .btn:active { transform: translateY(0); }
        .btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-sm); }
        .btn-primary { background: var(--navy); color: #fff; }
        .btn-primary:hover { background: var(--navy-dark); }
        .btn-outline { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
        .btn-outline:hover { border-color: var(--navy); background: var(--paper); }
        .btn-outline.red { color: var(--signal); border-color: var(--signal); }
        .btn-outline.red:hover { background: var(--signal); color: #fff; }

        /* ==========================================================
           TAB POS & INFO CARD
           ========================================================== */
        .tabs { display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: var(--shadow-xs); overflow-x: auto; scrollbar-width: none; margin-bottom: 24px; }
        .tabs::-webkit-scrollbar { display: none; }
        .tab { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 10px 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; color: var(--steel); transition: background .2s, color .2s; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-selected="true"] { background: var(--navy); color: #fff; box-shadow: var(--shadow-sm); }

        .panel[hidden] { display: none; }
        .info-card { display: flex; flex-wrap: wrap; align-items: center; gap: 10px 26px; background: #fff; border: 1px solid var(--line); border-left: 4px solid var(--info); border-radius: var(--r-md); padding: 18px 22px; margin-bottom: 18px; box-shadow: var(--shadow-xs); }
        .info-card h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; letter-spacing: -0.01em; text-transform: uppercase; flex-basis: 100%; color: var(--ink); margin-bottom: 4px;}
        .info-row { display: flex; align-items: center; gap: 9px; font-size: .88rem; color: var(--steel); font-weight: 500; }
        .info-row i { color: var(--info); width: 16px; text-align: center; }

        .maps-chip { display: inline-flex; align-items: center; gap: 7px; padding: 6px 14px; border-radius: 999px; background: var(--navy-light); border: 1px solid var(--navy-soft); font-size: .8rem; font-weight: 600; color: var(--navy); transition: background .2s, color .2s; }
        .maps-chip:hover { background: var(--navy); color: #fff; }

        /* ==========================================================
           TABEL SARANA
           ========================================================== */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; box-shadow: var(--shadow-xs); transition: box-shadow .2s, border-color .2s;}
        .table-wrap:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
        .table-scroll { overflow-x: auto; }
        .data-table { font-size: .88rem; min-width: 800px; width: 100%; text-align: left; }
        .data-table thead th { background: var(--paper); color: var(--steel); padding: 16px 14px; font-weight: 700; font-size: .75rem; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap; border-bottom: 1px solid var(--line); border-top: 1px solid var(--line); position: sticky; top: 0; z-index: 10;}
        .data-table thead th.c { text-align: center; }
        .data-table tbody td { padding: 16px 14px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
        .data-table tbody td.c { text-align: center; }
        .data-table tbody tr { transition: background .2s; }
        .data-table tbody tr:hover { background: #f8fafc; }
        .data-table tbody tr:last-child td { border-bottom: 0; }
        
        .cell-name { font-weight: 700; font-size: .95rem; text-transform: uppercase; margin-bottom: 8px; color: var(--ink); }
        .cell-empty { text-align: center; padding: 60px 16px; color: var(--steel-soft); font-weight: 600; font-size: 1rem; }

        /* Spesifik Elemen Tabel Sarana */
        .tag-row { display: flex; flex-wrap: wrap; gap: 6px; }
        .tag { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border-radius: 8px; font-size: .75rem; font-weight: 600; background: var(--paper); border: 1px solid var(--line); color: var(--steel); white-space: nowrap; }
        .tag i { font-size: .78rem; }
        .tag .val { color: var(--ink); font-weight: 700;}
        .tag.tahun i { color: var(--info); }
        .tag.plat i { color: var(--success); }
        .tag.stnk i { color: var(--signal); }

        .chip { display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: .8rem; border: 1px solid transparent; }
        .chip-blue { background: var(--info-soft); color: var(--info); border-color: rgba(37, 99, 235, 0.2); }
        .chip-muted { color: var(--steel-soft); }

        .img-wrap { display: inline-block; padding: 4px; border: 1px solid var(--line); border-radius: 8px; background: var(--paper); }
        .img-sarana { width: 150px; height: 100px; object-fit: cover; border-radius: 6px; transition: transform .2s; }
        .img-wrap:hover .img-sarana { transform: scale(1.03); }
        .img-empty { display: inline-flex; align-items: center; gap: 7px; padding: 8px 14px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .8rem; font-weight: 600; color: var(--steel); }

        .row-actions { display: inline-flex; gap: 8px; }
        .icon-btn { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; font-size: .85rem; color: #fff; transition: background .2s, transform .1s; }
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
        .sheet-head h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--ink); margin:0; }
        .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; color: var(--steel); }
        .sheet-x:hover { background: var(--signal-soft); color: var(--signal-dark); }
        
        .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
        .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: #fafafa; display: flex; justify-content: flex-end; gap: 12px; }

        .f-label { display: block; margin-bottom: 6px; font-size: .84rem; font-weight: 600; color: var(--ink); }
        .f-hint { margin-top: 6px; font-size: .75rem; color: var(--steel-soft); font-weight: 500; }
        .f-optional { font-weight: 500; color: var(--steel); text-transform: none; }
        .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        input[type="file"].f-input { padding: 9px 14px; font-size: .85rem; }
        .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
        .f-input::placeholder { color: var(--steel-soft); }
        
        .f-row { display: grid; grid-template-columns: 3fr 1fr; gap: 16px; }
        .f-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
        @media (max-width: 480px) { .f-row, .f-row-3 { grid-template-columns: 1fr; } }

        .btn-cancel { height: 42px; padding: 0 20px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); font-weight: 600; font-size: .88rem; transition: background .2s, border-color .2s; }
        .btn-cancel:hover { background: var(--paper); border-color: var(--steel); }
        .btn-save { height: 42px; padding: 0 24px; border-radius: 8px; background: var(--navy); color: #fff; border: none; font-weight: 600; font-size: .88rem; transition: background .2s; }
        .btn-save:hover { background: var(--navy-dark); }

        /* ==========================================================
           PRINT
           ========================================================== */
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .tabs, .row-actions, dialog, .toast-wrap, .mode-badge { display: none !important; }
            body { background: #fff !important; overflow: visible !important; }
            .shell { display: block !important; height: auto !important; }
            .content { padding: 0 !important; height: auto !important; overflow: visible !important; }
            .table-wrap { border: none !important; box-shadow: none !important; }
            .panel { display: none !important; }
            .panel[data-print-active] { display: block !important; }
            .col-aksi { display: none !important; }
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
            <span class="user-avatar">{{ strtoupper(substr($user->nama_lengkap ?? 'R', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ $user->nama_lengkap ?? 'Rekan kerja' }}</strong>
                <small>{{ $namaRole }}</small>
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

        <!-- BAGIAN PENCEGAHAN (semua role bisa lihat) -->
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

        <!-- BAGIAN PEMADAMAN (menu input/buat hanya untuk Sapra) -->
        <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-fire-extinguisher grp-ico"></i>
                <span class="grp-label">BAGIAN PEMADAMAN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                @if($bisaCrud)
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i> Input Rekap Layanan
                    </a>
                    <a href="/internal/damtan/rekap-objek" class="{{ Request::is('internal/damtan/rekap-objek*') ? 'active' : '' }}">
                        <i class="fas fa-house-chimney-crack"></i> Input Rekap Objek Kebakaran
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
                    </a>
                @endif
                <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> Kelola Data Laporan
                </a>
                <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> Kelola Surat Korban
                </a>
                <a href="{{ route('internal.izin-keramaian.index') }}" class="{{ Request::is('internal/damtan/kelola-izin-keramaian*') ? 'active' : '' }}">
                    <i class="fas fa-users-rectangle"></i> Kelola Surat Keramaian
                </a>
            </div>
        </details>

       
        <!-- BAGIAN SAPRA -->
        <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-warehouse grp-ico"></i>
                <span class="grp-label">BAGIAN SAPRA</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <span class="side-sub-kicker">SARANA & PRASARANA</span>
                <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
                <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi kebakaran</a>
                <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                <span class="side-sub-kicker">MANAJEMEN AIR</span>
                <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air</a>
                <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                <span class="side-sub-kicker">LOGISTIK & DISTRIBUSI</span>
                <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i> Serah Terima Barang</a>
            </div>
        </details>

         <!-- KEPEGAWAIAN -->
        <details class="side-group" {{ Request::is('internal/kepegawaian*') || Request::is('internal/program-kerja*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-user-tie grp-ico"></i>
                <span class="grp-label">KEPEGAWAIAN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> Data Urut Kepegawaian
                </a>
                <a href="/internal/program-kerja" class="{{ Request::is('internal/program-kerja*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i> Program Kerja
                </a>
            </div>
        </details>


        @if($bisaKonten)
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
                        <i class="far fa-image"></i> Kelola Infografis
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

        <!-- KICKER AKUN -->
        <div class="side-kicker">AKUN</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') ? 'open' : '' }}>
            <summary>
                <i class="fas fa-user-gear grp-ico"></i>
                <span class="grp-label">PENGATURAN AKUN</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if($isSuper)
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola pengguna</a>
                @endif
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        <div class="page-toolbar">
            <div>
                <h1>Sarana pemadam kebakaran</h1>
                <p>{{ $bisaCrud ? 'Manajemen dokumentasi visual sarana pemadam kebakaran di Pos Pemadam.' : 'Lihat dan cetak dokumentasi visual sarana pemadam kebakaran di Pos Pemadam.' }}</p>
                @unless($bisaCrud)
                    <span class="mode-badge"><i class="fas fa-eye"></i> Mode lihat &amp; cetak</span>
                @endunless
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari sarana</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari sarana..." autocomplete="off">
                </label>
                @if($bisaCrud)
                    <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah data</button>
                @endif
                <button type="button" class="btn btn-outline" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
                <a href="/sapra/sarana-mako/cetak-pdf" class="btn btn-outline red"><i class="fas fa-file-pdf"></i> PDF</a>
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
                $dataFilter = $dataSarana->where('id_pos', $pos->id_pos);
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
                                    <th style="width:{{ $bisaCrud ? '33%' : '40%' }}">Jenis sarana kebakaran</th>
                                    <th class="c" style="width:8%">Jumlah</th>
                                    <th style="width:{{ $bisaCrud ? '27%' : '47%' }}">Gambar</th>
                                    @if($bisaCrud)
                                        <th class="c col-aksi" style="width:12%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataFilter as $item)
                                <tr class="data-row" data-tab="{{ $pos->id_pos }}">
                                    <td class="c">{{ $loop->iteration }}</td>
                                    <td class="data-name">
                                        <div class="cell-name">{{ $item->jenis_sarana }}</div>
                                        @if($item->tahun || $item->plat_nomor || $item->no_stnk)
                                            <div class="tag-row">
                                                @if($item->tahun)
                                                    <span class="tag tahun"><i class="fas fa-calendar-alt"></i> Thn: <span class="val">{{ $item->tahun }}</span></span>
                                                @endif
                                                @if($item->plat_nomor)
                                                    <span class="tag plat"><i class="fas fa-car"></i> Plat: <span class="val">{{ strtoupper($item->plat_nomor) }}</span></span>
                                                @endif
                                                @if($item->no_stnk)
                                                    <span class="tag stnk"><i class="fas fa-id-card"></i> STNK: <span class="val">{{ strtoupper($item->no_stnk) }}</span></span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="c"><span class="chip chip-blue">{{ $item->jumlah }}</span></td>
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
                                    @if($bisaCrud)
                                    <td class="c col-aksi">
                                        <div class="row-actions">
                                            <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id_sarana }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                            
                                            <form action="/sapra/sarana-mako/delete/{{ $item->id_sarana }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus sarana ini? Gambar akan ikut terhapus permanen.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>

                                @if($bisaCrud)
                                <!-- Dialog Edit (hanya Sapra) -->
                                <dialog class="sheet" id="dlgEdit{{ $item->id_sarana }}">
                                    <div class="sheet-head">
                                        <h2>Edit Data Sarana</h2>
                                        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                    </div>
                                    <form action="/sapra/sarana-mako/update/{{ $item->id_sarana }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="sheet-body">
                                            <div>
                                                <label class="f-label" for="id_pos{{ $item->id_sarana }}">Pilih lokasi / pos</label>
                                                <select class="f-input" id="id_pos{{ $item->id_sarana }}" name="id_pos" required>
                                                    <option value="">— Pilih lokasi —</option>
                                                    @foreach($posPemadam as $posOption)
                                                        <option value="{{ $posOption->id_pos }}" {{ $posOption->id_pos == $item->id_pos ? 'selected' : '' }}>{{ strtoupper($posOption->nama_pos) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="jenis{{ $item->id_sarana }}">Jenis sarana</label>
                                                    <input class="f-input" type="text" id="jenis{{ $item->id_sarana }}" name="jenis_sarana" value="{{ $item->jenis_sarana }}" required>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="jumlah{{ $item->id_sarana }}">Jumlah</label>
                                                    <input class="f-input" type="number" id="jumlah{{ $item->id_sarana }}" name="jumlah" value="{{ $item->jumlah }}" required>
                                                </div>
                                            </div>
                                            <div class="f-row-3">
                                                <div>
                                                    <label class="f-label" for="tahun{{ $item->id_sarana }}">Tahun <span class="f-optional">(ops)</span></label>
                                                    <input class="f-input" type="text" id="tahun{{ $item->id_sarana }}" name="tahun" value="{{ $item->tahun }}" placeholder="Cth: 2022">
                                                </div>
                                                <div>
                                                    <label class="f-label" for="plat{{ $item->id_sarana }}">Plat nomor <span class="f-optional">(ops)</span></label>
                                                    <input class="f-input" type="text" id="plat{{ $item->id_sarana }}" name="plat_nomor" value="{{ $item->plat_nomor }}" placeholder="Cth: BH 1234 XX">
                                                </div>
                                                <div>
                                                    <label class="f-label" for="stnk{{ $item->id_sarana }}">No. STNK <span class="f-optional">(ops)</span></label>
                                                    <input class="f-input" type="text" id="stnk{{ $item->id_sarana }}" name="no_stnk" value="{{ $item->no_stnk }}" placeholder="Cth: 12345678">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="f-label" for="gambar{{ $item->id_sarana }}">Ganti gambar <span class="f-optional">(opsional)</span></label>
                                                <input class="f-input" type="file" id="gambar{{ $item->id_sarana }}" name="gambar" accept="image/*">
                                                <p class="f-hint">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                                            </div>
                                        </div>
                                        <div class="sheet-foot">
                                            <button type="button" class="btn-cancel" data-close>Batal</button>
                                            <button type="submit" class="btn-save">Simpan perubahan</button>
                                        </div>
                                    </form>
                                </dialog>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="{{ $bisaCrud ? 5 : 4 }}" class="cell-empty">Belum ada data sarana untuk {{ $pos->nama_pos }}.</td>
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

@if($bisaCrud)
<!-- ==================== DIALOG TAMBAH (hanya Sapra) ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah data sarana</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/sarana-mako/store" method="POST" enctype="multipart/form-data">
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
                    <label class="f-label" for="tambahJenis">Jenis sarana</label>
                    <input class="f-input" type="text" id="tambahJenis" name="jenis_sarana" placeholder="Contoh: Alat pelindung diri" required>
                </div>
                <div>
                    <label class="f-label" for="tambahJumlah">Jumlah</label>
                    <input class="f-input" type="number" id="tambahJumlah" name="jumlah" value="1" required>
                </div>
            </div>
            <div class="f-row-3">
                <div>
                    <label class="f-label" for="tambahTahun">Tahun <span class="f-optional">(ops)</span></label>
                    <input class="f-input" type="text" id="tambahTahun" name="tahun" placeholder="Cth: 2022">
                </div>
                <div>
                    <label class="f-label" for="tambahPlat">Plat nomor <span class="f-optional">(ops)</span></label>
                    <input class="f-input" type="text" id="tambahPlat" name="plat_nomor" placeholder="Cth: BH 1234 XX">
                </div>
                <div>
                    <label class="f-label" for="tambahStnk">No. STNK <span class="f-optional">(ops)</span></label>
                    <input class="f-input" type="text" id="tambahStnk" name="no_stnk" placeholder="Cth: 12345678">
                </div>
            </div>
            <div>
                <label class="f-label" for="tambahGambar">Upload gambar</label>
                <input class="f-input" type="file" id="tambahGambar" name="gambar" accept="image/*" required>
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save">Simpan data</button>
        </div>
    </form>
</dialog>
@endif

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

    /* ---------- Modal / Dialog (hanya ada untuk Sapra) ---------- */
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