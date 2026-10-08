<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Tambah Pelatihan Keluarga Tanggap Kebakaran | SIMERAH KOJA</title>
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
    position: fixed; z-index: 1100; top: 18px; left: 50%;
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
    position: sticky; top: 0; z-index: 1020;
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
    overflow-y: auto; overflow-x: hidden; background: #ffffff;
    border-right: 1px solid var(--line);
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
.side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #ffffff; }

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
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
.side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }

/* 11. SIDEBAR SUB MENU */
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
        position: fixed; z-index: 1010; top: var(--topbar-h); left: 0;
        height: calc(100dvh - var(--topbar-h));
        transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        box-shadow: var(--shadow-lg);
    }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop {
        display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000;
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
   HALAMAN FORM TAMBAH DATA
   ========================================================== */
.back-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--steel); font-size: .85rem; font-weight: 600;
    margin-bottom: 14px; transition: color .2s, transform .2s;
}
.back-link:hover { color: var(--navy); transform: translateX(-2px); }

.form-wrapper {
    background: #fff; border: 1px solid var(--line);
    border-radius: var(--r-md); box-shadow: var(--shadow-xs);
    padding: clamp(20px, 3vw, 32px);
}
.form-alert {
    display: flex; gap: 12px; align-items: flex-start;
    background: var(--signal-soft); border: 1px solid rgba(220,53,69,.25);
    color: var(--signal-dark); border-radius: var(--r-sm);
    padding: 14px 16px; margin-bottom: 20px; font-size: .88rem;
}
.form-alert i { margin-top: 3px; }
.form-alert ul { list-style: disc; padding-left: 18px; margin-top: 4px; }

.section-title {
    display: flex; align-items: center; gap: 12px;
    font-family: var(--font-display); font-weight: 700; font-size: 1rem;
    color: var(--ink); letter-spacing: -.01em; margin: 30px 0 16px;
}
.section-title.first { margin-top: 0; }
.section-title .ico {
    flex: none; width: 32px; height: 32px; border-radius: 9px;
    display: grid; place-items: center; font-size: .78rem; color: #fff;
    background: var(--navy); box-shadow: 0 4px 8px rgba(22,58,99,.12);
}
.section-title .line { flex: 1 1 auto; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

.form-label { font-weight: 600; font-size: .8rem; color: var(--steel); margin-bottom: 6px; letter-spacing: .01em; }
.form-label .req { color: var(--signal); margin-left: 2px; }
.form-control, .form-select {
    height: 44px; border: 1px solid var(--line-dark); border-radius: var(--r-sm);
    padding: 0 14px; font-size: .9rem; color: var(--ink); background-color: #fff;
    transition: border-color .2s, box-shadow .2s;
}
.form-select { padding-right: 38px; }
.form-select:disabled { background-color: var(--paper); color: var(--steel-soft); cursor: not-allowed; }
textarea.form-control { height: auto; padding: 10px 14px; line-height: 1.5; resize: vertical; }
.form-control::placeholder { color: var(--steel-soft); }
.form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
.form-control.is-invalid, .form-select.is-invalid { border-color: var(--signal); }
.form-hint { display: block; margin-top: 6px; font-size: .75rem; color: var(--steel); }

.gender-label { display: flex; align-items: center; gap: 8px; }
.gender-label i { font-size: .85rem; }
.gender-label .fa-venus { color: #db2777; }
.gender-label .fa-mars { color: var(--info); }

.total-box {
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
    margin-top: 16px; padding: 12px 16px; border-radius: var(--r-sm);
    background: var(--navy-light); color: var(--navy); font-size: .88rem; font-weight: 600;
}
.total-box strong { font-family: var(--font-display); font-size: 1.3rem; }

.form-actions {
    display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px;
    margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line);
}
.btn-save, .btn-cancel {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    height: 44px; padding: 0 22px; border-radius: var(--r-sm);
    font-weight: 700; font-size: .87rem; transition: filter .2s, background .2s, transform .1s, box-shadow .2s;
}
.btn-save { background: var(--navy); color: #fff; border: none; }
.btn-save:hover { filter: brightness(1.1); box-shadow: var(--shadow-sm); color: #fff; }
.btn-save:disabled { opacity: .7; cursor: wait; }
.btn-cancel { background: #fff; color: var(--steel); border: 1px solid var(--line-dark); }
.btn-cancel:hover { background: var(--paper); color: var(--ink); }
.btn-save:active, .btn-cancel:active { transform: scale(.97); }

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
    .sidebar, .btn-logout, .toast-wrap { display: none !important; }
    .shell { display: block; }
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

        <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Pelatihan Keluarga
        </a>

        <div class="page-head">
            <h1>Form Pelatihan Keluarga Tanggap Kebakaran</h1>
            <p>Isi informasi pelaksanaan, jumlah peserta, dan link dokumentasi kegiatan.</p>
        </div>

        @if($errors->any())
            <div class="form-alert" role="alert">
                <i class="fas fa-triangle-exclamation"></i>
                <div>
                    <strong>Data belum bisa disimpan. Periksa kembali:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="form-wrapper">
            {{-- Tanpa enctype: tidak ada upload file, hanya kirim teks (link) --}}
            <form id="formPelatihan" action="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/store" method="POST">
                @csrf

                <!-- INFORMASI PELAKSANAAN -->
                <div class="section-title first">
                    <span class="ico"><i class="fas fa-house-chimney"></i></span>
                    <span>Informasi Pelaksanaan Pelatihan</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="tanggal_pelaksanaan">Tanggal Pelaksanaan <span class="req">*</span></label>
                        <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" required>
                        @error('tanggal_pelaksanaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="kecamatan">Kecamatan <span class="req">*</span></label>
                        <select id="kecamatan" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" data-old="{{ old('kecamatan') }}" required>
                            <option value="" selected disabled>Pilih kecamatan</option>
                        </select>
                        @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="kelurahan">Kelurahan <span class="req">*</span></label>
                        <select id="kelurahan" name="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" data-old="{{ old('kelurahan') }}" required disabled>
                            <option value="" selected disabled>Pilih kecamatan dulu</option>
                        </select>
                        @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="rt">RT <span class="req">*</span></label>
                        <input type="text" id="rt" name="rt" value="{{ old('rt') }}" class="form-control @error('rt') is-invalid @enderror" placeholder="Contoh: 03, 12, 14 dan 19" required>
                        @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- JUMLAH PESERTA -->
                <div class="section-title">
                    <span class="ico"><i class="fas fa-users"></i></span>
                    <span>Jumlah Peserta</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label gender-label" for="peserta_perempuan"><i class="fas fa-venus"></i> Peserta Perempuan <span class="req">*</span></label>
                        <input type="number" id="peserta_perempuan" name="peserta_perempuan" value="{{ old('peserta_perempuan', 0) }}" class="form-control js-peserta @error('peserta_perempuan') is-invalid @enderror" min="0" inputmode="numeric" required>
                        @error('peserta_perempuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label gender-label" for="peserta_laki_laki"><i class="fas fa-mars"></i> Peserta Laki-laki <span class="req">*</span></label>
                        <input type="number" id="peserta_laki_laki" name="peserta_laki_laki" value="{{ old('peserta_laki_laki', 0) }}" class="form-control js-peserta @error('peserta_laki_laki') is-invalid @enderror" min="0" inputmode="numeric" required>
                        @error('peserta_laki_laki')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="total-box">
                    <span>Total peserta</span>
                    <strong id="totalPeserta">0</strong>
                </div>

                <!-- DOKUMENTASI (LINK) -->
                <div class="section-title">
                    <span class="ico"><i class="fas fa-link"></i></span>
                    <span>Dokumentasi</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="link_dokumentasi">Link Dokumentasi Foto / Video (Opsional)</label>
                        <textarea id="link_dokumentasi" name="link_dokumentasi" rows="3"
                                  class="form-control @error('link_dokumentasi') is-invalid @enderror"
                                  placeholder="https://drive.google.com/drive/folders/...">{{ old('link_dokumentasi') }}</textarea>
                        @error('link_dokumentasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <span class="form-hint">Tempel link Google Drive. Kalau lebih dari satu, tulis <strong>satu link per baris</strong>. Pastikan akses link diatur "Siapa saja yang memiliki link".</span>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-save" id="btnSave"><i class="fas fa-save"></i> Simpan Data Pelatihan</button>
                </div>
            </form>
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

    /* ---------- Data Kecamatan -> Kelurahan (Kota Jambi) ---------- */
    var WILAYAH = {
        'Alam Barajo': ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawasari', 'Simpang Rimbo'],
        'Danau Sipin': ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk': ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan': ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur': ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sijenjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung': ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru': ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang III Sipin', 'Suka Karya', 'Talang Gulo'],
        'Paal Merah': ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi': ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan': ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura': ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang IV Sipin', 'Telanaipura', 'Teluk Kenali']
    };

    var selKec = document.getElementById('kecamatan');
    var selKel = document.getElementById('kelurahan');

    function addOption(select, value, text, selected) {
        var o = document.createElement('option');
        o.value = value; o.textContent = text;
        if (selected) o.selected = true;
        select.appendChild(o);
    }
    function fillKelurahan(kec, oldKel) {
        selKel.innerHTML = '';
        if (!kec || !WILAYAH[kec]) {
            addOption(selKel, '', 'Pilih kecamatan dulu', true);
            selKel.options[0].disabled = true;
            selKel.disabled = true;
            return;
        }
        addOption(selKel, '', 'Pilih kelurahan', !oldKel);
        selKel.options[0].disabled = true;
        WILAYAH[kec].forEach(function (k) { addOption(selKel, k, k, k === oldKel); });
        selKel.disabled = false;
    }
    if (selKec && selKel) {
        var oldKec = selKec.getAttribute('data-old') || '';
        var oldKel = selKel.getAttribute('data-old') || '';
        Object.keys(WILAYAH).forEach(function (k) { addOption(selKec, k, k, k === oldKec); });
        selKec.options[0].selected = !oldKec;
        fillKelurahan(oldKec, oldKel);
        selKec.addEventListener('change', function () { fillKelurahan(selKec.value, ''); });
    }

    /* ---------- Total peserta otomatis ---------- */
    var pesertaInputs = document.querySelectorAll('.js-peserta');
    var totalEl = document.getElementById('totalPeserta');
    function hitungTotal() {
        var t = 0;
        pesertaInputs.forEach(function (i) { t += Math.max(0, parseInt(i.value, 10) || 0); });
        if (totalEl) totalEl.textContent = t;
    }
    pesertaInputs.forEach(function (i) { i.addEventListener('input', hitungTotal); });
    hitungTotal();

    /* ---------- Cegah submit ganda ---------- */
    var form = document.getElementById('formPelatihan');
    var btnSave = document.getElementById('btnSave');
    if (form && btnSave) {
        form.addEventListener('submit', function () {
            btnSave.disabled = true;
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    }

    /* ---------- Hanya satu grup sidebar terbuka pada satu waktu ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>