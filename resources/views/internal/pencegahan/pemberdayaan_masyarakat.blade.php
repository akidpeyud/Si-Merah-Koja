<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Pemberdayaan Masyarakat | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD
   (template navbar, sidebar & font dari dashboard utama)
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
    border-radius: 999px;
    background: #ffffff;
    border: 1px solid var(--line);
    box-shadow: var(--shadow-md);
    font-weight: 600; font-size: .92rem;
    animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
}
.toast.leaving { animation: toastOut .3s ease forwards; }
.toast-ico {
    flex: none; width: 28px; height: 28px; border-radius: 50%;
    display: grid; place-items: center; color: #fff; font-size: .78rem;
}
.toast.ok .toast-ico { background: var(--success); }
.toast.err .toast-ico { background: var(--signal); }
.toast-x {
    flex: none; width: 30px; height: 30px; border-radius: 50%;
    display: grid; place-items: center; background: var(--paper);
    transition: background .2s, color .2s;
}
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* 4. TOPBAR */
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
.user-meta strong {
    font-size: .84rem; font-weight: 700; max-width: 160px;
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff;
}
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

/* 5. SHELL & SIDEBAR */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

.sidebar {
    width: var(--sidebar-w); flex: none;
    position: sticky; top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h));
    overflow-y: auto;
    background: #ffffff;
    border-right: 1px solid var(--line);
    padding: 20px 14px 32px;
    scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
}
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

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

.side-kicker {
    padding: 18px 14px 6px; font-size: .68rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft);
}

/* Mobile sidebar */
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

/* 6. KONTEN UTAMA */
.content {
    flex: 1; min-width: 0;
    padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px;
}
.page-head h1 {
    font-family: var(--font-display); font-weight: 700;
    font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2;
    letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink);
}
.page-head p { color: var(--steel); font-size: .95rem; }

/* Toolbar (cari + tombol aksi) */
.toolbar { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.toolbar .input-group { width: 260px; }
.toolbar .input-group-text,
.toolbar .form-control { border-color: var(--line-dark); font-size: .88rem; }
.toolbar .form-control:focus { box-shadow: none; border-color: var(--navy); }
.btn-solid {
    display: inline-flex; align-items: center; gap: 8px;
    height: 40px; padding: 0 16px; border-radius: var(--r-sm);
    font-weight: 600; font-size: .86rem; color: #fff !important;
    transition: filter .2s, transform .1s, box-shadow .2s;
}
.btn-solid:hover { filter: brightness(1.1); box-shadow: 0 4px 10px rgba(13,27,42,.14); }
.btn-solid:active { transform: scale(.97); }
.btn-navy { background: var(--navy); }
.btn-green { background: var(--success); }
.btn-red { background: var(--signal); }

/* Tabs */
.custom-nav-tabs {
    border-bottom: 2px solid var(--line);
    margin-top: 15px; gap: 10px;
    flex-wrap: nowrap; overflow-x: auto; display: flex; margin-bottom: 24px;
}
.custom-nav-tabs .nav-link {
    border: none; color: var(--steel); font-weight: 700; font-size: .8rem;
    padding: 12px 18px; background: transparent; white-space: nowrap;
    transition: color .2s;
}
.custom-nav-tabs .nav-link:hover { color: var(--ink); }
.custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom: 3px solid var(--navy); }

/* Section heading */
.section-heading { display: flex; align-items: center; gap: 12px; margin: 24px 0 18px; flex-wrap: nowrap; }
.section-heading-ico {
    flex: none; width: 32px; height: 32px; border-radius: 9px;
    background: var(--navy); color: #fff; display: grid; place-items: center;
    font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12);
}
.section-heading h3 {
    flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem;
    color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0;
}
.section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

/* Stat cards */
.stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
.stat-card {
    display: flex; flex-direction: column; align-items: flex-start;
    padding: 22px; background: #ffffff; border-radius: var(--r-md);
    border: 1px solid var(--line); box-shadow: var(--shadow-xs);
    transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
    position: relative; overflow: hidden;
}
.stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
.stat-card::after {
    content: "\f061"; font-family: "Font Awesome 6 Free"; font-weight: 900;
    position: absolute; top: 22px; right: 20px;
    color: var(--steel-soft); font-size: .8rem;
    opacity: 0; transform: translateX(-6px);
    transition: opacity .2s ease, transform .2s ease;
}
.stat-card:hover::after { opacity: 1; transform: translateX(0); }
.stat-ico {
    width: 46px; height: 46px; border-radius: var(--r-sm);
    display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px;
    background: var(--navy-soft); color: var(--navy);
}
.stat-title {
    font-size: .74rem; font-weight: 700; letter-spacing: .04em;
    text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4;
}
.stat-value {
    font-family: var(--font-display); font-weight: 700; font-size: 1.9rem;
    line-height: 1; color: var(--ink); letter-spacing: -.01em;
}

/* Tabel */
.table-scroll-wrapper {
    width: 100%; overflow-x: auto; border-radius: var(--r-md);
    border: 1px solid var(--line); background: #fff;
    margin-bottom: 40px; box-shadow: var(--shadow-sm);
}
.table-detailed { width: 100%; border-collapse: collapse; min-width: 1200px; margin-bottom: 0; }
.table-detailed thead { background-color: var(--ink); color: #fff; }
.table-detailed th {
    font-size: .72rem; font-weight: 700; padding: 16px 15px; white-space: nowrap;
    text-transform: uppercase; letter-spacing: .03em;
    border-right: 1px solid var(--ink-3); border-bottom: 1px solid var(--ink-3); vertical-align: middle;
}
.table-detailed .th-group { text-align: center; }
.table-detailed td {
    font-size: .84rem; padding: 14px 15px; vertical-align: middle; white-space: nowrap;
    border-bottom: 1px solid var(--line); border-right: 1px solid var(--paper);
}
.table-detailed tbody tr:hover { background-color: var(--paper); }

.btn-action {
    width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center;
    border-radius: 8px; font-size: .8rem; color: #fff; border: none;
    transition: transform .1s, filter .2s; margin-right: 2px;
}
.btn-action:hover { transform: scale(1.06); filter: brightness(1.08); }
.btn-edit { background-color: var(--amber); }
.btn-delete { background-color: var(--signal); }

/* Responsive */
@media (max-width: 1100px) {
    .topbar { padding: 0 20px; }
    .content { padding: 32px 26px 60px; }
    .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
    .page-head h1 { font-size: 1.55rem; }
    .page-head p { font-size: .88rem; }
    .toolbar .input-group { width: 100%; }
    .stats-grid { grid-template-columns: 1fr; gap: 12px; }
    .stat-card { padding: 19px; }
    .stat-ico { width: 42px; height: 42px; margin-bottom: 14px; }
    .stat-value { font-size: 1.7rem; }
}
@media (max-width: 420px) {
    .brand span { display: none; }
    .content { padding-left: 13px; padding-right: 13px; }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation: none !important; transition: none !important; }
}

@media print {
    .topbar { position: static; background: #ffffff !important; color: #000000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
    .brand span { color: #000000 !important; }
    .sidebar, .btn-logout, .toolbar { display: none; }
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
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div class="page-head mb-0">
                <h1>Pemberdayaan masyarakat</h1>
                <p>Kelola data sosialisasi, edukasi, dan pelatihan tanggap kebakaran.</p>
            </div>

            <div class="toolbar">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari kelurahan atau posyandu...">
                </div>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/create" class="btn-solid btn-navy">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="#" class="btn-solid btn-green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="#" class="btn-solid btn-red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat') && !Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan*') && !Request::is('internal/pencegahan/pemberdayaan-masyarakat/sosialisasi*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat">
                    Semua Data
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga">
                    SOSIALISASI DAN EDUKASI
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/sosialisasi*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi">
                    PELATIHAN KELUARGA TANGGAP KEBAKARAN
                </a>
            </li>
        </ul>

        <!-- ================= TAB "SEMUA DATA" ================= -->
        @if(Request::is('internal/pencegahan/pemberdayaan-masyarakat') && !Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan*') && !Request::is('internal/pencegahan/pemberdayaan-masyarakat/sosialisasi*'))
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-handshake-angle"></i></span>
                <h3>Ringkasan Pemberdayaan</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="stat-card">
                    <div class="stat-ico"><i class="fas fa-home"></i></div>
                    <div>
                        <div class="stat-title">Pelatihan Keluarga</div>
                        <div class="stat-value">{{ $total_pelatihan ?? count($data_pelatihan ?? []) }}</div>
                    </div>
                </a>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="stat-card">
                    <div class="stat-ico"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-title">Sosialisasi &amp; Edukasi</div>
                        <div class="stat-value">{{ $total_sosialisasi ?? count($data_sosialisasi ?? []) }}</div>
                    </div>
                </a>
            </div>

        <!-- ================= TAB LAINNYA (TABEL) ================= -->
        @else
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-users"></i></span>
                <h3>Data Sosialisasi &amp; Edukasi</h3>
                <span class="line"></span>
            </div>

            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" width="60px">NO</th>
                            <th rowspan="2">HARI/TGL</th>
                            <th rowspan="2">POSYANDU</th>
                            <th rowspan="2" class="text-center">RT</th>
                            <th rowspan="2">KELURAHAN</th>
                            <th rowspan="2">NAMA SEKOLAH</th>
                            <th colspan="2" class="th-group">JUMLAH PESERTA</th>
                            <th rowspan="2" class="text-center">FOTO DAN VIDEO</th>
                            <th rowspan="2" class="text-center" width="120px">AKSI</th>
                        </tr>
                        <tr>
                            <th class="text-center" width="120px" style="border-left: 1px solid var(--ink-3);">PEREMPUAN</th>
                            <th class="text-center" width="120px">LAKI-LAKI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_sosialisasi ?? [] as $index => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->translatedFormat('d F Y') }}</td>
                            <td>{{ $item->posyandu ? $item->posyandu : '-' }}</td>
                            <td class="text-center">{{ $item->rt }}</td>
                            <td class="fw-bold">{{ $item->kelurahan }}</td>
                            <td>{{ $item->kecamatan }}</td>
                            <td class="text-center fw-bold">{{ $item->peserta_perempuan }}</td>
                            <td class="text-center fw-bold">{{ $item->peserta_laki_laki }}</td>
                            <td class="text-center">
                                @if($item->foto_video)
                                    <a href="/uploads/pemberdayaan/{{ $item->foto_video }}" target="_blank" style="color: var(--info); font-weight: 600;">
                                        <i class="fas fa-camera me-1"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/pemberdayaan-masyarakat/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/pemberdayaan-masyarakat/hapus/{{ $item->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted fw-bold">
                                <i class="fas fa-folder-open mb-2" style="font-size: 28px; color: var(--steel-soft);"></i><br>
                                Belum ada data sosialisasi dan edukasi.
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