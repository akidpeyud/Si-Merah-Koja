<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Kunjungan Edukasi & Sosialisasi | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD (Dari Style Index)
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
    position: fixed; z-index: 2000; top: 18px; left: 50%;
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
        position: fixed; z-index: 1010;
        top: var(--topbar-h); left: 0;
        height: calc(100dvh - var(--topbar-h));
        transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        box-shadow: var(--shadow-lg);
    }
    body.side-open .sidebar { transform: none; }

    .sidebar-backdrop {
        display: block; position: fixed;
        inset: var(--topbar-h) 0 0 0; z-index: 1000;
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

/* 15. PAGE HEADER (Kelola Khusus) */
.page-head { margin-bottom: 26px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
.page-head-title h1 {
    font-family: var(--font-display); font-weight: 700;
    font-size: clamp(1.6rem, 3vw, 2.1rem);
    line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink);
}
.page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

/* ==========================================================
   STYLE SPESIFIK KELOLA EDUKASI
   ========================================================== */
.content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 26px; box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease; overflow: hidden;}
.content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }

/* Table Styles */
.table-custom { margin-bottom: 0; }
.table-custom th { background-color: var(--paper); color: var(--steel); font-size: .75rem; text-transform: uppercase; letter-spacing: .04em; font-weight: 700; padding: 14px 12px; border-bottom: 2px solid var(--line-dark) !important; border-top: none; }
.table-custom td { padding: 16px 12px; vertical-align: middle; font-size: .88rem; color: var(--ink); border-bottom: 1px solid var(--line); }

/* Badges */
.badge-status { padding: 6px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; }
.status-pending { background-color: #fef3c7; color: #d97706; }
.status-disetujui { background-color: #d1fae5; color: #059669; }
.status-ditolak { background-color: #fee2e2; color: #dc2626; }

/* Buttons */
.btn-print-rekap { display: inline-flex; align-items: center; gap: 8px; background-color: var(--navy); color: white; font-weight: 600; font-size: .9rem; padding: 10px 20px; border-radius: 8px; border: none; transition: 0.2s; cursor: pointer; }
.btn-print-rekap:hover { background-color: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }

.btn-action-group { display: flex; flex-direction: column; gap: 6px; }
.btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 7px 10px; border-radius: 6px; font-weight: 700; font-size: .75rem; border: none; text-decoration: none; transition: all 0.2s; cursor: pointer; color: white; }
.btn-action:hover { opacity: 0.9; color: white; transform: translateY(-1px); }
.bg-detail { background-color: var(--info); }
.bg-status { background-color: var(--success); }
.bg-cetak { background-color: var(--steel); }

/* Modal Styles */
.modal-content { font-family: var(--font-body); border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); }
.modal-header { border-bottom: 1px solid var(--line); padding: 18px 24px; }
.modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); }
.modal-body { padding: 24px; }
.modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; }
.form-label { font-weight: 600; color: var(--ink-2); font-size: .88rem; margin-bottom: 8px; }
.form-select { border-radius: 8px; border-color: var(--line-dark); min-height: 42px; font-size: .9rem; color: var(--ink); box-shadow: none; }
.form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

/* Responsive Adjustments */
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
    .page-head-title h1 { font-size: 1.55rem; }
    .page-head-title p { font-size: .88rem; }
}

@media (max-width: 420px) {
    .brand span { display: none; }
    .content { padding-left: 13px; padding-right: 13px; }
}

/* Print CSS */
@media print {
    .topbar, .sidebar, .btn-print-rekap, .page-head-title p { display: none !important; }
    .no-print-col { display: none !important; } 
    .shell { display: block; }
    .content { padding: 0 !important; margin: 0 !important; background-color: white; }
    .content-card { border: none; box-shadow: none; padding: 0; }
    body { background-color: white; margin: 0; padding: 0; }
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
            <details class="side-group" open>
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
                    <a href="/internal/pencegahan/kelola-edukasi" class="active">
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

            <!-- BAGIAN KEPEGAWAIAN (DIPINDAHKAN KE BAWAH SAPRA) -->
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
        @endif

        <!-- MANAJEMEN INFORMASI -->
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

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <div class="page-head">
            <div class="page-head-title">
                <h1>Daftar Kunjungan Edukasi & Sosialisasi</h1>
                <p>Kelola pengajuan layanan edukasi dan sosialisasi ke masyarakat dan instansi.</p>
            </div>
            <div>
                <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print"></i> Cetak Rekap</button>
            </div>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Diajukan Pada</th>
                            <th>Institusi</th>
                            <th>Pemohon</th>
                            <th>Jadwal Kegiatan</th>
                            <th>Status</th>
                            <th class="no-print-col text-center">Lampiran</th>
                            <th class="text-center no-print-col" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                                <div style="font-size: .75rem; color: var(--steel);">{{ $p->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $p->institusi }}</div>
                                <div style="font-size: .75rem; color: var(--steel);">Kec. {{ $p->kecamatan }}</div>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: var(--info);">{{ $p->nama_pemohon }}</div>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_kontak) }}" target="_blank" class="text-decoration-none" style="font-size: .75rem; font-weight:600; color: var(--success);"><i class="fab fa-whatsapp"></i> {{ $p->no_kontak }}</a>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: var(--amber);">{{ \Carbon\Carbon::parse($p->tgl_kegiatan)->format('d F Y') }}</div>
                                <div style="font-size: .75rem; color: var(--steel);">
                                    Total: {{ $p->usia_3_6 + $p->usia_7_12 + $p->usia_13_18 + $p->usia_18_keatas }} Peserta
                                </div>
                            </td>
                            <td>
                                @if($p->status_permohonan == 'Pending') 
                                    <span class="badge-status status-pending">Pending</span>
                                @elseif($p->status_permohonan == 'Disetujui') 
                                    <span class="badge-status status-disetujui">Disetujui</span>
                                @else 
                                    <span class="badge-status status-ditolak">Ditolak</span>
                                @endif
                            </td>
                            <td class="no-print-col text-center">
                                @if($p->surat_permohonan) 
                                    <a href="{{ asset('storage/' . $p->surat_permohonan) }}" target="_blank" class="badge bg-danger text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a> 
                                @endif
                                @if($p->syarat_lainnya) 
                                    <br><a href="{{ asset('storage/' . $p->syarat_lainnya) }}" target="_blank" class="badge bg-secondary text-decoration-none"><i class="fas fa-paperclip"></i> Syarat</a> 
                                @endif
                            </td>
                            <td class="no-print-col">
                                <div class="btn-action-group">
                                    <a href="/internal/pencegahan/kelola-edukasi/{{ $p->id }}" class="btn-action bg-detail"><i class="fas fa-search"></i> Detail</a>
                                    <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $p->id }}"><i class="fas fa-edit"></i> Status</button>
                                    <a href="/internal/pencegahan/kelola-edukasi/{{ $p->id }}?auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print"></i> Cetak</a>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL UPDATE STATUS -->
                        <div class="modal fade" id="modalStatus{{ $p->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Status Edukasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/internal/pencegahan/kelola-edukasi/update-status/{{ $p->id }}" method="POST">
                                        @csrf
                                        <div class="modal-body text-start">
                                            <p class="mb-4" style="font-size: .9rem; color: var(--steel);">Ubah status pengajuan jadwal dari <strong style="color: var(--ink);">{{ $p->institusi }}</strong>.</p>
                                            <div class="mb-2">
                                                <label class="form-label">Pilih Status Baru</label>
                                                <select name="status_permohonan" class="form-select" required>
                                                    <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Disetujui" {{ $p->status_permohonan == 'Disetujui' ? 'selected' : '' }}>Disetujui / Diterima</option>
                                                    <option value="Ditolak" {{ $p->status_permohonan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" style="font-weight:600; border-radius: 8px;" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary" style="font-weight:600; border-radius: 8px; background: var(--navy); border:none;"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-folder-open mb-3" style="font-size: 32px; color: var(--line-dark);"></i><br>
                                <span style="color: var(--steel); font-weight: 500;">Belum ada pengajuan Kunjungan Edukasi & Sosialisasi.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Notifikasi (Toast) ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* ---------- Sidebar Mobile Toggle ---------- */
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

    /* ---------- Accordion Sidebar Logic ---------- */
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