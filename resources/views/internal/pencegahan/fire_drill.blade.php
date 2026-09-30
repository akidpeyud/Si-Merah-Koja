<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Fire Drill | SIMERAH KOJA</title>
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

/* 2. RESET */
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

/* 3. TOAST */
.toast-wrap {
    position: fixed; z-index: 200; top: 18px; left: 50%;
    transform: translateX(-50%);
    display: grid; gap: 10px;
    width: max-content; max-width: calc(100vw - 24px);
}
.toast {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 12px 12px 16px;
    border-radius: 999px; background: #ffffff;
    border: 1px solid var(--line);
    box-shadow: var(--shadow-md);
    font-weight: 600; font-size: .92rem;
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

/* 4. TOPBAR (NAVY) */
.topbar {
    position: sticky; top: 0; z-index: 60;
    height: var(--topbar-h);
    display: flex; align-items: center; justify-content: space-between;
    gap: 16px; padding: 0 28px;
    background: var(--ink);
    border-bottom: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
}
.topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
.side-toggle {
    display: none; width: 40px; height: 40px; border-radius: 10px;
    align-items: center; justify-content: center;
    font-size: 1.05rem; color: #fff;
    transition: background .2s, transform .2s;
}
.side-toggle:hover { background: rgba(255,255,255,.10); }
.side-toggle:active { transform: scale(.95); }

.brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
.brand img { height: 34px; width: auto; flex: none; }
.brand span {
    font-family: var(--font-display); font-weight: 700; font-size: 1.08rem;
    letter-spacing: -.01em; white-space: nowrap; overflow: hidden;
    text-overflow: ellipsis; color: #fff;
}

.topbar-right { display: flex; align-items: center; gap: 12px; }
.user-chip {
    display: flex; align-items: center; gap: 10px;
    padding: 5px 14px 5px 5px; border-radius: 999px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.12);
    transition: background .2s, border-color .2s;
}
.user-chip:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.18); }
.user-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: #ffffff; color: var(--ink);
    display: grid; place-items: center;
    font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
}
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }

.btn-logout {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    height: 40px; padding: 0 17px; border-radius: 999px;
    background: #ffffff; color: var(--ink);
    font-weight: 600; font-size: .84rem; border: none;
    transition: background .2s, color .2s, transform .1s, box-shadow .2s;
}
.btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }
.btn-logout:active { transform: scale(.97); }

/* 7. SHELL */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

/* 8. SIDEBAR */
.sidebar {
    width: var(--sidebar-w); flex: none;
    position: sticky; top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h));
    overflow-y: auto; background: #ffffff;
    border-right: 1px solid var(--line);
    padding: 20px 14px 32px;
    scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
}
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

/* 9. SIDEBAR MENU */
.side-link {
    display: flex; align-items: center; gap: 14px;
    padding: 11px 14px; border-radius: var(--r-sm);
    font-size: .89rem; font-weight: 600; color: var(--ink);
    transition: background .2s, color .2s, transform .2s;
    margin-bottom: 4px;
}
.side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #ffffff; }

/* 10. SIDEBAR GROUP */
.side-group + .side-group { margin-top: 6px; }
.side-group summary {
    list-style: none; cursor: pointer;
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px; border-radius: var(--r-sm);
    font-size: .78rem; font-weight: 700; letter-spacing: .04em;
    text-transform: uppercase; color: var(--navy);
    transition: background .2s, color .2s; user-select: none;
}
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }

/* 11. SIDEBAR SUB MENU */
.side-sub {
    display: grid; gap: 3px;
    padding: 6px 4px 10px 12px;
    border-left: 2px solid var(--line);
    margin: 2px 0 8px 22px;
}
.side-sub a {
    display: flex; align-items: center; gap: 12px;
    padding: 9px 12px; border-radius: var(--r-sm);
    font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel);
    transition: background .2s, color .2s, transform .2s;
}
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }

/* 12. SIDEBAR SECTION LABEL */
.side-kicker {
    padding: 18px 14px 6px; font-size: .68rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft);
}

/* 13. MOBILE SIDEBAR */
.sidebar-backdrop { display: none; }
@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar {
        position: fixed; z-index: 90; top: var(--topbar-h); left: 0;
        height: calc(100dvh - var(--topbar-h));
        transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        box-shadow: var(--shadow-lg);
    }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop {
        display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80;
        background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s;
    }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* 14. MAIN CONTENT */
.content {
    flex: 1; min-width: 0;
    padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px;
}

/* 15. PAGE HEADER */
.page-head { margin-bottom: 26px; }
.page-head h1 {
    font-family: var(--font-display); font-weight: 700;
    font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2;
    letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink);
}
.page-head p { color: var(--steel); font-size: .95rem; }

/* ==========================================================
   HALAMAN FIRE DRILL (tabs, toolbar, tabel) - disesuaikan ke template
   ========================================================== */
.page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 8px; }
.page-toolbar .page-head { margin-bottom: 0; }
.toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }

.search-box { position: relative; width: 260px; max-width: 100%; }
.search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
.search-box input {
    width: 100%; height: 42px; padding: 0 14px 0 38px;
    border: 1px solid var(--line-dark); border-radius: var(--r-sm);
    background: #fff; font-size: .88rem; font-family: var(--font-body); color: var(--ink);
    transition: border-color .2s, box-shadow .2s;
}
.search-box input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

.btn-tool {
    display: inline-flex; align-items: center; gap: 8px;
    height: 42px; padding: 0 16px; border-radius: var(--r-sm);
    font-weight: 600; font-size: .85rem; color: #fff; border: none;
    transition: filter .2s, transform .1s, box-shadow .2s;
}
.btn-tool:hover { color: #fff; filter: brightness(1.08); box-shadow: var(--shadow-sm); }
.btn-tool:active { transform: scale(.97); }
.btn-tool.navy { background: var(--navy); }
.btn-tool.green { background: var(--success); }
.btn-tool.red { background: var(--signal); }

.custom-nav-tabs {
    display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto;
    margin-top: 18px; padding-bottom: 0;
    border-bottom: 1px solid var(--line);
}
.custom-nav-tabs::-webkit-scrollbar { height: 4px; }
.custom-nav-tabs::-webkit-scrollbar-thumb { background: var(--steel-soft); border-radius: 10px; }
.custom-nav-tabs .nav-link {
    border: none; border-bottom: 3px solid transparent; border-radius: 0;
    color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em;
    padding: 12px 18px; background: transparent; white-space: nowrap;
    transition: color .2s, border-color .2s, background .2s;
}
.custom-nav-tabs .nav-link:hover { color: var(--ink); background: var(--navy-soft); }
.custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); }

.table-title {
    display: flex; align-items: center; gap: 12px;
    font-family: var(--font-display); font-weight: 700; font-size: 1rem;
    color: var(--ink); letter-spacing: -.01em; margin: 26px 0 14px;
}
.table-title .ico {
    width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff;
    display: grid; place-items: center; font-size: .78rem;
    box-shadow: 0 4px 8px rgba(22,58,99,.12);
}

.table-scroll-wrapper {
    width: 100%; overflow-x: auto; background: #fff;
    border-radius: var(--r-md); border: 1px solid var(--line);
    box-shadow: var(--shadow-xs); margin-bottom: 40px;
}
.table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
.table-scroll-wrapper::-webkit-scrollbar-thumb { background: var(--steel-soft); border-radius: 10px; }
.table-scroll-wrapper::-webkit-scrollbar-track { background: var(--paper); }

.table-detailed { width: 100%; border-collapse: collapse; min-width: 2500px; margin-bottom: 0; }
.table-detailed thead { background: var(--ink); color: #fff; }
.table-detailed th {
    font-size: .7rem; font-weight: 700; padding: 16px 15px; white-space: nowrap;
    text-transform: uppercase; letter-spacing: .05em; vertical-align: middle;
    border-right: 1px solid var(--ink-3);
}
.table-detailed td {
    font-size: .84rem; padding: 14px 15px; vertical-align: middle; white-space: nowrap;
    border-bottom: 1px solid var(--line); border-right: 1px solid var(--paper);
}
.table-detailed tbody tr { transition: background .15s; }
.table-detailed tbody tr:hover { background: var(--paper); }

.badge-soft-blue {
    display: inline-block; background: var(--info-soft); color: var(--info);
    padding: 5px 12px; font-weight: 700; font-size: .78rem; border-radius: 6px;
    border: 1px solid rgba(37, 99, 235, .15);
}
.badge-diklat {
    display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .03em;
    padding: 5px 10px; border-radius: 6px; background: var(--navy-soft); color: var(--navy);
}

.aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 6px; }
.aksi-wrap form { margin: 0; display: inline-flex; }
.btn-action {
    width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center;
    border-radius: 8px; font-size: .8rem; color: #fff; border: none; cursor: pointer;
    transition: transform .1s, filter .2s;
}
.btn-action:hover { transform: scale(1.06); color: #fff; filter: brightness(1.06); }
.btn-edit { background: var(--amber); color: var(--ink); }
.btn-edit:hover { color: var(--ink); }
.btn-delete { background: var(--signal); }

.empty-state { text-align: center; padding: 48px 12px !important; color: var(--steel); font-weight: 600; }
.empty-state i { font-size: 28px; color: var(--steel-soft); margin-bottom: 8px; }

.section-heading { display: flex; align-items: center; gap: 12px; margin: 30px 0 16px; flex-wrap: nowrap; }
.section-heading-ico {
    flex: none; width: 32px; height: 32px; border-radius: 9px;
    background: var(--navy); color: #fff; display: grid; place-items: center;
    font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12);
}
.section-heading-ico.amber { background: var(--amber); color: var(--ink); box-shadow: 0 4px 8px rgba(244,183,64,.25); }
.section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
.section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

.table-detailed.table-compact { min-width: 1000px; }
.table-detailed th.th-sub { background: rgba(255,255,255,.08); }
.table-detailed th.th-group { border-bottom: 1px solid var(--ink-3); }
.badge-tahun {
    display: inline-block; margin-top: 4px; padding: 3px 8px; border-radius: 6px;
    background: var(--navy-soft); color: var(--navy); font-weight: 700; font-size: .68rem; letter-spacing: .03em;
}
.total-cell { text-align: center; font-weight: 700; color: var(--navy); }

/* RESPONSIVE TABLET */
@media (max-width: 1100px) {
    .topbar { padding: 0 20px; }
    .content { padding: 32px 26px 60px; }
}

/* RESPONSIVE MOBILE */
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
    .search-box { width: 100%; }
    .toolbar-actions { width: 100%; }
}

@media (max-width: 420px) {
    .brand span { display: none; }
    .content { padding-left: 13px; padding-right: 13px; }
}

/* ACCESSIBILITY */
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation: none !important; transition: none !important; }
}

/* PRINT */
@media print {
    .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
    .brand span { color: #000 !important; }
    .sidebar, .btn-logout, .toolbar-actions { display: none; }
    .content { padding: 20px; }
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

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group" {{ Request::is('internal/kepegawaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
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

            <!-- BAGIAN SAPRA -->
            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam kebakaran</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana pemadam kebakaran</a>
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
                        <i class="fas fa-people-carry-box"></i> Serah terima Barang
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

        <!-- HEADER KONTEN & TOMBOL AKSI -->
        <div class="page-toolbar">
            <div class="page-head">
                <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
                <p>Kelola data instansi pemerintah / swasta yang melaksanakan pelatihan pemadam kebakaran.</p>
            </div>

            <div class="toolbar-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari instansi..." aria-label="Cari instansi">
                </div>
                <a href="{{ route('fire_drill.create') }}" class="btn-tool navy">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="#" class="btn-tool green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="#" class="btn-tool red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran">Semua Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/bangunan">INSPEKSI BANGUNAN GEDUNG DAN LINGKUNGAN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/fire-drill*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/fire-drill">FIRE DRILL</a>
            </li>
        </ul>

        <!-- ================= TABEL 1: 2025 - 2026 ================= -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-calendar-check"></i></span>
            <h3>Data Fire Drill Tahun 2025 &amp; 2026</h3>
            <span class="line"></span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-compact table-hover">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" width="60px">No</th>
                        <th rowspan="2">Nama Instansi</th>
                        <th rowspan="2">Tanggal Pelaksanaan</th>
                        <th rowspan="2">Tempat Pelaksanaan</th>
                        <th colspan="3" class="text-center th-group">Jumlah Peserta</th>
                        <th rowspan="2" class="text-center" width="100px">Aksi</th>
                    </tr>
                    <tr>
                        <th class="text-center" width="90px">Laki-laki</th>
                        <th class="text-center" width="90px">Perempuan</th>
                        <th class="text-center th-sub" width="90px">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($data_fire_drill ?? []) as $index => $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->nama_instansi }}</strong><br>
                            <span class="badge-tahun">{{ $item->tahun }}</span>
                        </td>
                        <td>{{ $item->tanggal_pelaksanaan }}</td>
                        <td>{{ $item->tempat_pelaksanaan }}</td>
                        <td class="text-center">{{ $item->peserta_laki_laki }}</td>
                        <td class="text-center">{{ $item->peserta_perempuan }}</td>
                        <td class="total-cell">{{ $item->total_peserta }}</td>
                        <td>
                            <div class="aksi-wrap">
                                <a href="{{ route('fire_drill.edit', $item->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('fire_drill.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="fas fa-folder-open"></i><br>
                            Belum ada data Fire Drill.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ================= TABEL 2: 2023 - 2024 ================= -->
        <div class="section-heading">
            <span class="section-heading-ico amber"><i class="fas fa-clock-rotate-left"></i></span>
            <h3>Data Fire Drill Tahun 2023 &amp; 2024</h3>
            <span class="line"></span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-compact table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="60px">No</th>
                        <th>Nama Instansi</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Tempat Pelaksanaan</th>
                        <th class="text-center" width="160px">Total Peserta</th>
                        <th class="text-center" width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($data_fire_drill ?? []) as $index => $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->nama_instansi }}</strong><br>
                            <span class="badge-tahun">{{ $item->tahun }}</span>
                        </td>
                        <td>{{ $item->tanggal_pelaksanaan }}</td>
                        <td>{{ $item->tempat_pelaksanaan }}</td>
                        <td class="total-cell">{{ $item->total_peserta }} Orang</td>
                        <td>
                            <div class="aksi-wrap">
                                <a href="{{ route('fire_drill.edit', $item->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('fire_drill.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-folder-open"></i><br>
                            Belum ada data riwayat Fire Drill.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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