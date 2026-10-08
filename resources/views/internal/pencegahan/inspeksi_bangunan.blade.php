<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Pencegahan Kebakaran &amp; Inspeksi | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD (TEMPLATE)
   ========================================================== */

/* 1. DESIGN TOKENS */
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
    --success-dark: #146c43;
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

/* 2. RESET */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* 3. TOAST */
.toast-wrap { position: fixed; z-index: 1100; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
.toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
.toast.leaving { animation: toastOut .3s ease forwards; }
.toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
.toast.ok .toast-ico { background: var(--success); }
.toast.err .toast-ico { background: var(--signal); }
.toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* 4. TOPBAR */
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
.user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
.btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }
.btn-logout:active { transform: scale(.97); }

/* 5. SHELL & SIDEBAR */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

.side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #fff; }

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

/* 6. MOBILE SIDEBAR */
.sidebar-backdrop { display: none; }
@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* 7. MAIN CONTENT */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

.page-head { margin-bottom: 26px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head p { color: var(--steel); font-size: .95rem; }

/* Toolbar: pencarian + tombol aksi */
.toolbar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.search-box { position: relative; width: 260px; }
.search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
.search-box input { width: 100%; height: 40px; padding: 0 16px 0 38px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font-size: .86rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
.search-box input::placeholder { color: var(--steel-soft); }
.search-box input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

.btn-solid { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; color: #fff; font-weight: 600; font-size: .84rem; border: none; transition: background .2s, transform .1s, box-shadow .2s; }
.btn-solid:hover { color: #fff; box-shadow: 0 4px 12px rgba(13,27,42,.18); }
.btn-solid:active { transform: scale(.97); }
.btn-solid.navy { background: var(--navy); }
.btn-solid.navy:hover { background: var(--navy-dark); }
.btn-solid.green { background: var(--success); }
.btn-solid.green:hover { background: var(--success-dark); }
.btn-solid.red { background: var(--signal); }
.btn-solid.red:hover { background: var(--signal-dark); }

/* Tabs */
.custom-nav-tabs { display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto; margin: 6px 0 30px; border-bottom: 1px solid var(--line); scrollbar-width: thin; }
.custom-nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; border-radius: 0; color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em; padding: 12px 16px; background: transparent; white-space: nowrap; text-transform: uppercase; transition: color .2s, border-color .2s, background .2s; }
.custom-nav-tabs .nav-link:hover { color: var(--ink); background: #f3f6fa; }
.custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); background: transparent; }

/* Stat cards */
.stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; margin-bottom: 44px; }
.stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 22px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease; position: relative; overflow: hidden; }
.stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
.stat-card::after { content: "\f061"; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; top: 22px; right: 20px; color: var(--steel-soft); font-size: .8rem; opacity: 0; transform: translateX(-6px); transition: opacity .2s ease, transform .2s ease; }
.stat-card:hover::after { opacity: 1; transform: translateX(0); }
.stat-ico { width: 46px; height: 46px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px; }
.ic-primary { background: var(--navy-soft); color: var(--navy); }
.ic-danger { background: var(--signal-soft); color: var(--signal-dark); }
.stat-title { font-size: .74rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
.stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.9rem; line-height: 1; color: var(--ink); letter-spacing: -.01em; }

/* Judul seksi */
.section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
.section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
.section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; }
.section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

/* Tabel */
.table-scroll-wrapper { width: 100%; overflow-x: auto; border-radius: var(--r-md); border: 1px solid var(--line); background: #fff; margin-bottom: 40px; box-shadow: var(--shadow-xs); scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
.table-detailed { width: 100%; border-collapse: collapse; min-width: 900px; margin-bottom: 0; }
.table-detailed thead { background-color: var(--ink); color: #fff; }
.table-detailed th { font-size: .7rem; font-weight: 700; padding: 16px 15px; white-space: nowrap; text-transform: uppercase; border-right: 1px solid var(--ink-3); letter-spacing: .05em; vertical-align: middle; }
.table-detailed th:last-child { border-right: none; }
.table-detailed td { font-size: .84rem; padding: 14px 15px; vertical-align: middle; border-bottom: 1px solid var(--line); border-right: 1px solid var(--paper); }
.table-detailed td:last-child { border-right: none; }
.table-detailed tbody tr:last-child td { border-bottom: none; }
.table-detailed tbody tr:hover { background-color: #f8fafc; }

.btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 8px; font-size: .8rem; color: #fff; border: none; cursor: pointer; transition: transform .1s, box-shadow .2s; }
.btn-action:hover { transform: scale(1.06); color: #fff; box-shadow: 0 3px 8px rgba(13,27,42,.18); }
.btn-edit { background-color: var(--amber); }
.btn-delete { background-color: var(--signal); }
.action-cell { display: flex; justify-content: center; align-items: center; gap: 6px; }

.doc-badge { display: inline-block; padding: 4px 9px; font-size: .64rem; font-weight: 700; letter-spacing: .03em; border-radius: 6px; margin: 0 3px 3px 0; color: #fff !important; transition: opacity .2s; }
.doc-badge:hover { opacity: .8; }

/* 8. RESPONSIVE */
@media (max-width: 1100px) {
    .topbar { padding: 0 20px; }
    .content { padding: 32px 26px 60px; }
}
@media (max-width: 700px) {
    :root { --topbar-h: 64px; }
    .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
    .brand { gap: 9px; }
    .brand img { height: 30px; }
    .brand span { font-size: .95rem; }
    .topbar-right { gap: 7px; }
    .user-chip { padding: 3px; border: none; background: transparent; }
    .user-avatar { width: 34px; height: 34px; }
    .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
    .btn-logout i { font-size: .9rem; }
    .content { padding: 26px 16px 50px; }
    .page-head { margin-bottom: 22px; }
    .page-head h1 { font-size: 1.55rem; }
    .page-head p { font-size: .88rem; }
    .toolbar { width: 100%; }
    .search-box { width: 100%; }
    .stats-grid { grid-template-columns: 1fr; gap: 12px; margin-bottom: 34px; }
    .stat-card { padding: 19px; }
    .stat-ico { width: 42px; height: 42px; margin-bottom: 14px; }
    .stat-value { font-size: 1.7rem; }
}
@media (max-width: 420px) {
    .brand span { display: none; }
    .content { padding-left: 13px; padding-right: 13px; }
}

/* 9. ACCESSIBILITY */
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation: none !important; transition: none !important; }
}

/* 10. PRINT */
@media print {
    .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
    .brand span { color: #000 !important; }
    .sidebar, .btn-logout, .toolbar, .btn-action, .toast-wrap { display: none !important; }
    .shell { display: block; }
    .content { padding: 20px; }
    .stat-card { box-shadow: none; break-inside: avoid; }
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
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') || Request::is('internal/damtan/kelola-izin-keramaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
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
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Kelola Data Laporan
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i> Kelola Surat Korban
                    </a>
                    <a href="{{ route('internal.izin-keramaian.index') }}" class="{{ Request::is('internal/damtan/kelola-izin-keramaian*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span>
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
            <details class="side-group" {{ Request::is('internal/kepegawaian*') || Request::is('internal/program-kerja*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk" class="{{ Request::is('internal/kepegawaian/duk*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i><span class="lbl">Data Urut Kepegawaian</span>
                    </a>
                    <a href="/internal/program-kerja" class="{{ Request::is('internal/program-kerja*') ? 'active' : '' }}">
                        <i class="fas fa-file-contract"></i><span class="lbl">Program Kerja</span>
                    </a>
                </div>
            </details>
        @endhasanyrole

        <!-- MANAJEMEN INFORMASI -->
        @hasanyrole('Super User|Operator')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('internal/peta-sigap*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i><span class="lbl">Input &amp; Kelola Berita</span>
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i><span class="lbl">Kelola Info Grafis</span>
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

                    <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PEMETAAN SIGAP</div>
                    <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                    </a>
                    <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
                        <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                    </a>
                </div>
            </details>
        @endhasanyrole

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ request()->is('internal/profil*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}" class="{{ request()->is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i><span class="lbl">Profil Saya</span>
                </a>

                @hasrole('Super User')
                    <a href="{{ url('/internal/kelola-user') }}" class="{{ request()->is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i><span class="lbl">Kelola Pengguna</span>
                    </a>
                @endhasrole

                <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span>
                </a>
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-2">
            <div class="page-head mb-0">
                <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
                <p>Kelola data inspeksi bangunan gedung, lingkungan, dan pelaksanaan fire drill.</p>
            </div>

            {{-- Toolbar disembunyikan di tab Semua Data --}}
            @unless(Request::is('internal/pencegahan/inspeksi-kebakaran'))
            <div class="toolbar">
                <!-- PENCARIAN: TERBUKA UNTUK SEMUA ROLE -->
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari nama tempat...">
                </div>

                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                    @if(Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*'))
                    <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah" class="btn-solid navy">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    @endif
                @endhasanyrole

                <!-- EXCEL & PDF TERBUKA UNTUK SEMUA ROLE -->
                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-excel" class="btn-solid green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-pdf" target="_blank" class="btn-solid red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
            @endunless
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran">Semua Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/bangunan">Inspeksi Bangunan Gedung dan Lingkungan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/fire-drill*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/fire-drill">Fire Drill</a>
            </li>
        </ul>

        <!-- ================= TAB "SEMUA DATA" ================= -->
        @if(Request::is('internal/pencegahan/inspeksi-kebakaran'))
        <div class="stats-grid">
            <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-building"></i></div>
                <div>
                    <div class="stat-title">Inspeksi Bangunan Gedung</div>
                    <div class="stat-value">{{ $total_inspeksi ?? 0 }}</div>
                </div>
            </a>

            <a href="/internal/pencegahan/inspeksi-kebakaran/fire-drill" class="stat-card">
                <div class="stat-ico ic-danger"><i class="fas fa-fire"></i></div>
                <div>
                    <div class="stat-title">Fire Drill</div>
                    <div class="stat-value">{{ $total_fire_drill ?? 0 }}</div>
                </div>
            </a>
        </div>
        @endif

        <!-- ================= TAB "INSPEKSI BANGUNAN" ================= -->
        @if(Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*'))
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-building-circle-check"></i></span>
            <h3>Data Inspeksi Bangunan &amp; Lingkungan</h3>
            <span class="line"></span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="20%">Nama Tempat</th>
                        <th width="15%">Bulan / Tanggal Inspeksi</th>
                        <th width="25%">Jenis Usaha</th>
                        <th width="20%">Dokumen Terlampir</th>

                        <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <th class="text-center" width="15%">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_inspeksi as $index => $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $item->nama_tempat }}</td>
                        <td>{{ $item->tanggal_inspeksi }}</td>
                        <td style="white-space: normal;">{{ $item->jenis_usaha }}</td>

                        <td style="white-space: normal;">
                            @if($item->surat_perintah_tugas)
                                <a href="/uploads/inspeksi/{{ $item->surat_perintah_tugas }}" class="doc-badge" style="background-color: #3b82f6;" target="_blank" title="Surat Perintah Tugas">SPT</a>
                            @endif
                            @if($item->berita_acara)
                                <a href="/uploads/inspeksi/{{ $item->berita_acara }}" class="doc-badge" style="background-color: #10b981;" target="_blank" title="Berita Acara">BA</a>
                            @endif
                            @if($item->hasil_penilaian)
                                <a href="/uploads/inspeksi/{{ $item->hasil_penilaian }}" class="doc-badge" style="background-color: #06b6d4;" target="_blank" title="Hasil Penilaian">NILAI</a>
                            @endif
                            @if($item->rekomendasi)
                                <a href="/uploads/inspeksi/{{ $item->rekomendasi }}" class="doc-badge" style="background-color: #8b5cf6;" target="_blank" title="Rekomendasi">REKOM</a>
                            @endif
                            @if($item->skk)
                                <a href="/uploads/inspeksi/{{ $item->skk }}" class="doc-badge" style="background-color: #ef4444;" target="_blank" title="Sertifikat Keselamatan">SKK</a>
                            @endif

                            @if(!$item->surat_perintah_tugas && !$item->berita_acara && !$item->hasil_penilaian && !$item->rekomendasi && !$item->skk)
                                <span class="text-muted" style="font-size: .72rem; font-style: italic;">Tidak ada dokumen</span>
                            @endif
                        </td>

                        <!-- TOMBOL EDIT & HAPUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('inspeksi.edit', $item->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('inspeksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display:inline-block; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endhasanyrole
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->hasAnyRole(['Pencegahan', 'Super User']) ? 6 : 5 }}" class="text-center py-5 text-muted fw-bold">
                            <i class="fas fa-folder-open mb-2" style="font-size: 28px; color: var(--steel-soft);"></i><br>
                            Belum ada data inspeksi bangunan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif

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