<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Dashboard internal | SIMERAH KOJA</title>
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
    background: #fff; border: 1px solid var(--line);
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

/* 6. TOPBAR RIGHT */
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
    background: #fff; color: var(--ink);
    display: grid; place-items: center;
    font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
}
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong {
    font-size: .84rem; font-weight: 700; max-width: 160px;
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff;
}
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }

.btn-logout {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px;
    background: #fff; color: var(--ink);
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
    overflow-y: auto; overflow-x: hidden;
    background: #fff; border-right: 1px solid var(--line);
    padding: 20px 14px 32px;
    scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
}
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

/* 9. SIDEBAR MENU */
.side-link {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 11px 14px; border-radius: var(--r-sm);
    font-size: .89rem; font-weight: 600; color: var(--ink);
    transition: background .2s, color .2s, transform .2s;
    margin-bottom: 4px;
}
.side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #fff; }

.lbl { flex: 1 1 auto; min-width: 0; overflow-wrap: break-word; line-height: 1.4; }

/* 10. SIDEBAR GROUP */
.side-group + .side-group { margin-top: 6px; }
.side-group summary {
    list-style: none; cursor: pointer;
    display: flex; align-items: flex-start; gap: 12px;
    padding: 11px 14px; border-radius: var(--r-sm);
    font-size: .78rem; font-weight: 700; letter-spacing: .04em;
    text-transform: uppercase; color: var(--navy);
    transition: background .2s, color .2s; user-select: none;
}
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
.side-group summary .grp-label {
    flex: 1 1 auto; min-width: 0;
    white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4;
}
.side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }

/* 11. SUB MENU */
.side-sub {
    display: grid; gap: 3px;
    padding: 6px 0 10px 8px;
    border-left: 2px solid var(--line);
    margin: 2px 0 8px 18px;
}
.side-sub a {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 9px 10px; border-radius: var(--r-sm);
    font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel);
    transition: background .2s, color .2s, transform .2s;
}
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; flex: none; margin-top: 3px; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }

/* 12. SECTION LABEL */
.side-kicker {
    padding: 18px 14px 6px;
    font-size: .68rem; font-weight: 700; letter-spacing: .06em;
    text-transform: uppercase; color: var(--steel-soft);
}

/* 13. MOBILE SIDEBAR */
.sidebar-backdrop { display: none; }

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }

    .sidebar {
        position: fixed; z-index: 90;
        top: var(--topbar-h); left: 0;
        height: calc(100dvh - var(--topbar-h));
        transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        box-shadow: var(--shadow-lg);
    }
    body.side-open .sidebar { transform: none; }

    .sidebar-backdrop {
        display: block; position: fixed;
        inset: var(--topbar-h) 0 0 0; z-index: 80;
        background: rgba(13,27,42,.45);
        opacity: 0; pointer-events: none; transition: opacity .3s;
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
    font-size: clamp(1.6rem, 3vw, 2.1rem);
    line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink);
}
.page-head p { color: var(--steel); font-size: .95rem; }

/* 16. WELCOME */
.welcome {
    position: relative; overflow: hidden;
    border-radius: var(--r-lg);
    background: linear-gradient(135deg, var(--ink) 0%, var(--ink-2) 100%);
    padding: clamp(28px, 4.5vw, 40px);
    color: #fff; margin-bottom: 38px; box-shadow: var(--shadow-md);
}
.welcome::after {
    content: ""; position: absolute; right: -10%; top: -60%;
    width: 55%; aspect-ratio: 1;
    background: radial-gradient(closest-side, rgba(55,105,160,.30), transparent 70%);
    pointer-events: none;
}
.welcome-badge {
    position: relative; display: inline-flex; align-items: center; gap: 8px;
    padding: 7px 14px; border-radius: 999px;
    background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.12);
    font-size: .78rem; font-weight: 700; letter-spacing: .03em;
    text-transform: uppercase; margin-bottom: 16px;
}
.welcome-badge i { color: var(--amber); }
.welcome h2 {
    position: relative; font-family: var(--font-display); font-weight: 700;
    font-size: clamp(1.35rem, 2.6vw, 1.75rem);
    line-height: 1.3; letter-spacing: -.015em; max-width: 42ch; margin-bottom: 8px;
}
.welcome p { position: relative; max-width: 58ch; color: rgba(255,255,255,.72); font-size: .95rem; line-height: 1.6; }

/* 17. SECTION HEADING */
.section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
.section-heading-ico {
    flex: none; width: 32px; height: 32px; border-radius: 9px;
    background: var(--navy); color: #fff;
    display: grid; place-items: center; font-size: .78rem;
    box-shadow: 0 4px 8px rgba(22,58,99,.12);
}
.section-heading h3 {
    flex: none; font-family: var(--font-display); font-weight: 700;
    font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap;
}
.section-heading .line {
    flex: 1 1 auto; min-width: 24px; height: 1px;
    background: linear-gradient(to right, var(--line), transparent 90%);
}

/* 18. STAT GRID */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 16px; margin-bottom: 44px;
}

/* 19. STAT CARD */
.stat-card {
    display: flex; flex-direction: column; align-items: flex-start;
    padding: 22px; background: #fff;
    border-radius: var(--r-md); border: 1px solid var(--line);
    box-shadow: var(--shadow-xs);
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

/* 20. STAT ICON */
.stat-ico {
    width: 46px; height: 46px; border-radius: var(--r-sm);
    display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px;
}
.ic-primary { background: var(--navy-soft); color: var(--navy); }
.ic-danger { background: var(--signal-soft); color: var(--signal-dark); }
.ic-info { background: var(--info-soft); color: var(--info); }

/* 21. STAT TEXT */
.stat-title {
    font-size: .74rem; font-weight: 700; letter-spacing: .04em;
    text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4;
}
.stat-value {
    font-family: var(--font-display); font-weight: 700;
    font-size: 1.9rem; line-height: 1; color: var(--ink); letter-spacing: -.01em;
}

/* 22. TABLET */
@media (max-width: 1100px) {
    .topbar { padding: 0 20px; }
    .content { padding: 32px 26px 60px; }
    .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

/* 23. MOBILE */
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
    .welcome { padding: 25px 22px; margin-bottom: 30px; border-radius: 15px; }
    .welcome h2 { font-size: 1.3rem; }
    .welcome p { font-size: .88rem; }
    .section-heading { gap: 9px; }
    .section-heading-ico { width: 30px; height: 30px; }
    .section-heading h3 { font-size: .92rem; }
    .stats-grid { grid-template-columns: 1fr; gap: 12px; margin-bottom: 34px; }
    .stat-card { padding: 19px; }
    .stat-ico { width: 42px; height: 42px; margin-bottom: 14px; }
    .stat-value { font-size: 1.7rem; }
}

/* 24. VERY SMALL */
@media (max-width: 420px) {
    .brand span { display: none; }
    .content { padding-left: 13px; padding-right: 13px; }
    .welcome { padding: 22px 18px; }
    .welcome h2 { font-size: 1.18rem; }
    .welcome p { font-size: .84rem; }
    .section-heading h3 { font-size: .86rem; }
}

/* 25. REDUCED MOTION */
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation: none !important; transition: none !important; }
}

/* 26. PRINT */
@media print {
    .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
    .brand span { color: #000 !important; }
    .sidebar { display: none; }
    .content { padding: 20px; }
    .welcome { box-shadow: none; border: 1px solid #ddd; }
    .stat-card { box-shadow: none; break-inside: avoid; }
    .btn-logout { display: none; }
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

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')

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
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i><span class="lbl">Input data</span>
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i><span class="lbl">Buat Surat Korban</span>
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span>
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') ? 'active' : '' }}">
                        <i class="fas fa-folder"></i><span class="lbl">Kelola Surat Korban</span>
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
        @endif

        <!-- MANAJEMEN INFORMASI (sudah termasuk Pemetaan SIGAP) -->
        @if(in_array(Auth::user()->role, ['operator', 'user', 'super_user']))
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('internal/peta-sigap*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">

                    @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
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
                    @endif

                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                        <div class="side-kicker" style="padding: 12px 10px 4px; margin-left: 0; font-size: 0.65rem;">PEMETAAN SIGAP</div>
                        <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                        </a>
                        <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
                            <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                        </a>
                    @endif

                </div>
            </details>
        @endif

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ request()->is('internal/profil*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}" class="{{ request()->is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i><span class="lbl">Profil Saya</span>
                </a>

                @if(auth()->user()->role === 'super_user')
                    <a href="{{ url('/internal/kelola-user') }}" class="{{ request()->is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i><span class="lbl">Kelola Pengguna</span>
                    </a>
                @endif

                <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span>
                </a>
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        <div class="page-head">
            <h1>Ruang kerja terintegrasi</h1>
            <p>Ringkasan sistem informasi internal Disdamkartan Kota Jambi.</p>
        </div>

        <section class="welcome">
            <span class="welcome-badge"><i class="fas fa-shield-halved"></i> {{ Auth::user()->role === 'super_user' ? 'Super user' : 'Pegawai internal' }}</span>
            <h2>Selamat bekerja, {{ Auth::user()->nama_lengkap ?? 'Rekan kerja' }}.</h2>
            @if(Auth::user()->role === 'super_user')
                <p>Anda memiliki kendali penuh untuk memantau dan mengelola seluruh modul operasional maupun sistem.</p>
            @else
                <p>Anda dapat berkolaborasi mengelola laporan dari seluruh modul layanan Disdamkartan.</p>
            @endif
        </section>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')

        <!-- 1. BAGIAN PENCEGAHAN -->
        <div class="mb-5">
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-shield-halved"></i></span>
                <h3>Bagian Pencegahan</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/internal/pencegahan/kelola-rpkbgl" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-building"></i></div>
                    <div>
                        <div class="stat-title">Permohonan RPKBGL</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('permohonan_rpkbgl') ? \Illuminate\Support\Facades\DB::table('permohonan_rpkbgl')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/internal/pencegahan/kelola-skk" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-shield-halved"></i></div>
                    <div>
                        <div class="stat-title">Permohonan SKK (Total)</div>
                        <div class="stat-value">
                            @php
                                $skkBaru = \Illuminate\Support\Facades\Schema::hasTable('permohonan_skk') ? \Illuminate\Support\Facades\DB::table('permohonan_skk')->count() : 0;
                                $skkPerpanjang = \Illuminate\Support\Facades\Schema::hasTable('permohonan_perpanjang_skk') ? \Illuminate\Support\Facades\DB::table('permohonan_perpanjang_skk')->count() : 0;
                            @endphp
                            {{ $skkBaru + $skkPerpanjang }}
                        </div>
                    </div>
                </a>

                <a href="/internal/pencegahan/kelola-edukasi" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-bullhorn"></i></div>
                    <div>
                        <div class="stat-title">Permohonan Edukasi</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('permohonan_edukasi') ? \Illuminate\Support\Facades\DB::table('permohonan_edukasi')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/internal/pencegahan/kelola-redkar" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-title">Kelola Redkar</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('redkar') ? \Illuminate\Support\Facades\DB::table('redkar')->count() : 0 }}
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- 2. BAGIAN PEMADAMAN -->
        <div class="mb-5">
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-fire-extinguisher"></i></span>
                <h3>Bagian Pemadaman</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/internal/damtan/input-data" class="stat-card">
                    <div class="stat-ico ic-danger"><i class="fas fa-fire-extinguisher"></i></div>
                    <div>
                        <div class="stat-title">Input Data Baru</div>
                        <div class="stat-value"><i class="fas fa-plus" style="font-size: 1.25rem;"></i></div>
                    </div>
                </a>

                <a href="/internal/surat-korban/create" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-file-signature"></i></div>
                    <div>
                        <div class="stat-title">Buat Surat Korban</div>
                        <div class="stat-value"><i class="fas fa-plus" style="font-size: 1.25rem;"></i></div>
                    </div>
                </a>

                <a href="/internal/damtan/data-laporan" class="stat-card">
                    <div class="stat-ico ic-danger"><i class="fas fa-clipboard-list"></i></div>
                    <div>
                        <div class="stat-title">Siaga Darurat (Pemadaman)</div>
                        <div class="stat-value">0</div>
                    </div>
                </a>

                <a href="/internal/surat-korban/data" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-folder"></i></div>
                    <div>
                        <div class="stat-title">Surat Korban Terbit</div>
                        <div class="stat-value">0</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- 3. BAGIAN SAPRA -->
        <div class="mb-4">
            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-warehouse"></i></span>
                <h3>Bagian Sarana &amp; Prasarana</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/sapra/data-hidrant-kota" class="stat-card">
                    <div class="stat-ico ic-info"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="stat-title">Total Hidrant Kota</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('hidran_kota') ? \Illuminate\Support\Facades\DB::table('hidran_kota')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/sapra/kelola-pos" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-warehouse"></i></div>
                    <div>
                        <div class="stat-title">Data Pos</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('pos_pemadam') ? \Illuminate\Support\Facades\DB::table('pos_pemadam')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/sapra/kebutuhan-sarpras" class="stat-card">
                    <div class="stat-ico ic-info"><i class="fas fa-boxes-stacked"></i></div>
                    <div>
                        <div class="stat-title">Mutu Baku Kebutuhan</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('kebutuhan_sarpras') ? \Illuminate\Support\Facades\DB::table('kebutuhan_sarpras')->count() : 0 }}
                        </div>
                    </div>
                </a>

                <a href="/sapra/distribusi-staff" class="stat-card">
                    <div class="stat-ico ic-primary"><i class="fas fa-people-carry-box"></i></div>
                    <div>
                        <div class="stat-title">Serah Terima Barang</div>
                        <div class="stat-value">
                            {{ \Illuminate\Support\Facades\Schema::hasTable('distribusi_barang_staff') ? \Illuminate\Support\Facades\DB::table('distribusi_barang_staff')->count() : 0 }}
                        </div>
                    </div>
                </a>
            </div>
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

    /* ---------- Grup sidebar: hanya satu terbuka ---------- */
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
</body>
</html>