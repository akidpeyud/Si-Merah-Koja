<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Berita | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD STYLING
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

*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: var(--font-body);
    font-size: 1rem;
    line-height: 1.6;
    color: var(--ink);
    background: var(--paper);
    -webkit-font-smoothing: antialiased;
}

img {
    max-width: 100%;
    display: block;
}

a {
    color: inherit;
    text-decoration: none;
}

button {
    font: inherit;
    color: inherit;
    background: none;
    border: 0;
    cursor: pointer;
}

:focus-visible {
    outline: 3px solid var(--amber);
    outline-offset: 2px;
    border-radius: 6px;
}

/* ==================== TOAST / ALERT ==================== */
.toast-wrap {
    position: fixed;
    z-index: 200;
    top: 18px;
    left: 50%;
    transform: translateX(-50%);
    display: grid;
    gap: 10px;
    width: max-content;
    max-width: calc(100vw - 24px);
}

.toast {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 999px;
    background: #ffffff;
    border: 1px solid var(--line);
    box-shadow: var(--shadow-md);
    font-weight: 600;
    font-size: .92rem;
    animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
}

.toast.leaving {
    animation: toastOut .3s ease forwards;
}

.toast-ico {
    flex: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    color: #fff;
    font-size: .78rem;
}

.toast.ok .toast-ico { background: var(--success); }
.toast.err .toast-ico { background: var(--signal); }

.toast-x {
    flex: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: var(--paper);
    transition: background .2s, color .2s;
}

.toast-x:hover {
    background: var(--ink);
    color: #fff;
}

@keyframes toastIn {
    from { opacity: 0; transform: translateY(-14px); }
    to { opacity: 1; transform: none; }
}

@keyframes toastOut {
    from { opacity: 1; transform: none; }
    to { opacity: 0; transform: translateY(-14px); }
}

/* ==================== TOPBAR ==================== */
.topbar {
    position: sticky;
    top: 0;
    z-index: 60;
    height: var(--topbar-h);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 0 28px;
    background: var(--ink);
    border-bottom: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.side-toggle {
    display: none;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
    font-size: 1.05rem;
    color: #fff;
    transition: background .2s, transform .2s;
}

.side-toggle:hover { background: rgba(255,255,255,.10); }
.side-toggle:active { transform: scale(.95); }

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    color: #fff;
}

.brand img {
    height: 34px;
    width: auto;
    flex: none;
}

.brand span {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.08rem;
    letter-spacing: -.01em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #fff;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-chip {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px 14px 5px 5px;
    border-radius: 999px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.12);
    transition: background .2s, border-color .2s;
}

.user-chip:hover {
    background: rgba(255,255,255,.12);
    border-color: rgba(255,255,255,.18);
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #ffffff;
    color: var(--ink);
    display: grid;
    place-items: center;
    font-family: var(--font-display);
    font-weight: 700;
    font-size: .9rem;
    flex: none;
}

.user-meta {
    display: grid;
    line-height: 1.25;
}

.user-meta strong {
    font-size: .84rem;
    font-weight: 700;
    max-width: 160px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #ffffff;
}

.user-meta small {
    font-size: .72rem;
    color: rgba(255,255,255,.62);
    text-transform: capitalize;
    font-weight: 500;
}

.btn-logout {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 40px;
    padding: 0 17px;
    border-radius: 999px;
    background: #ffffff;
    color: var(--ink);
    font-weight: 600;
    font-size: .84rem;
    border: none;
    transition: background .2s, color .2s, transform .1s, box-shadow .2s;
}

.btn-logout:hover {
    background: #e8eef5;
    color: var(--ink);
    box-shadow: 0 4px 10px rgba(0,0,0,.12);
}

.btn-logout:active { transform: scale(.97); }

/* ==================== SHELL & SIDEBAR ==================== */
.shell {
    display: flex;
    align-items: flex-start;
    min-height: calc(100vh - var(--topbar-h));
}

.sidebar {
    width: var(--sidebar-w);
    flex: none;
    position: sticky;
    top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h));
    overflow-y: auto;
    background: #ffffff;
    border-right: 1px solid var(--line);
    padding: 20px 14px 32px;
    scrollbar-width: thin;
    scrollbar-color: #d8dee8 transparent;
}

.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

.side-link {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 11px 14px;
    border-radius: var(--r-sm);
    font-size: .89rem;
    font-weight: 600;
    color: var(--ink);
    transition: background .2s, color .2s, transform .2s;
    margin-bottom: 4px;
}

.side-link:hover {
    background: #f3f6fa;
    color: var(--ink);
    transform: translateX(1px);
}

.side-link.active {
    background: var(--ink);
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(13,27,42,.10);
}

.side-link i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
    color: var(--steel);
    transition: color .2s;
}

.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #ffffff; }

.side-group + .side-group { margin-top: 6px; }

.side-group summary {
    list-style: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: var(--r-sm);
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--navy);
    transition: background .2s, color .2s;
    user-select: none;
}

.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }

.side-group summary .grp-ico {
    flex: none;
    width: 20px;
    text-align: center;
    font-size: .95rem;
    color: var(--navy);
}

.side-group summary .grp-label {
    flex: 1 1 auto;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.side-group summary .chev {
    flex: none;
    font-size: .7rem;
    transition: transform .25s ease;
}

.side-group[open] summary .chev { transform: rotate(180deg); }

.side-sub {
    display: grid;
    gap: 3px;
    padding: 6px 4px 10px 12px;
    border-left: 2px solid var(--line);
    margin: 2px 0 8px 22px;
}

.side-sub a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 12px;
    border-radius: var(--r-sm);
    font-size: .84rem;
    font-weight: 500;
    line-height: 1.4;
    color: var(--steel);
    transition: background .2s, color .2s, transform .2s;
}

.side-sub a:hover {
    background: var(--navy-light);
    color: var(--navy-dark);
    transform: translateX(2px);
}

.side-sub a.active {
    background: var(--navy-soft);
    color: var(--navy);
    font-weight: 600;
}

.side-sub a i {
    width: 18px;
    text-align: center;
    font-size: .88rem;
    opacity: .75;
}

.side-sub a:hover i, .side-sub a.active i { opacity: 1; }

.side-kicker {
    padding: 18px 14px 6px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--steel-soft);
}

.sidebar-backdrop { display: none; }

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar {
        position: fixed;
        z-index: 90;
        top: var(--topbar-h);
        left: 0;
        height: calc(100dvh - var(--topbar-h));
        transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        box-shadow: var(--shadow-lg);
    }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop {
        display: block;
        position: fixed;
        inset: var(--topbar-h) 0 0 0;
        z-index: 80;
        background: rgba(13,27,42,.45);
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s;
    }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* ==================== CONTENT & CARDS ==================== */
.content {
    flex: 1;
    min-width: 0;
    padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px;
}

.page-head {
    margin-bottom: 26px;
}

.page-head h1 {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: clamp(1.6rem, 3vw, 2.1rem);
    line-height: 1.2;
    letter-spacing: -.02em;
    margin-bottom: 5px;
    color: var(--ink);
}

.page-head p {
    color: var(--steel);
    font-size: .95rem;
}

.card-box {
    background: #ffffff;
    border-radius: var(--r-md);
    padding: 24px;
    border: 1px solid var(--line);
    box-shadow: var(--shadow-xs);
}

/* Tombol Brand Simerah */
.btn-simerah-danger {
    background: var(--signal);
    color: #ffffff;
    font-weight: 600;
    border-radius: var(--r-sm);
    padding: 10px 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    transition: background .2s, transform .1s, box-shadow .2s;
}

.btn-simerah-danger:hover {
    background: var(--signal-dark);
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, .2);
}

/* Tabel Custom */
.table {
    font-size: .92rem;
    margin-bottom: 0;
}

.table thead th {
    font-family: var(--font-display);
    font-size: .8rem;
    text-transform: uppercase;
    letter-spacing: .04em;
    font-weight: 700;
    color: var(--steel);
    background-color: var(--paper);
    border-bottom: 1px solid var(--line);
    padding: 14px 16px;
}

.table tbody td {
    padding: 16px;
    border-bottom: 1px solid var(--line);
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background-color: #fafbfc;
}

.title-text {
    font-family: var(--font-display);
    font-weight: 700;
    color: var(--ink);
    font-size: .98rem;
    display: block;
    margin-bottom: 3px;
}

.location-text {
    font-size: .82rem;
    color: var(--steel);
}

/* Action Buttons */
.action-btn {
    width: 34px;
    height: 34px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px;
    border: none;
    color: #ffffff;
    font-size: .84rem;
    transition: transform .15s, filter .15s;
}

.action-btn:hover {
    transform: translateY(-1px);
    color: #ffffff;
    filter: brightness(.92);
}

.btn-view { background-color: var(--info); }
.btn-edit { background-color: var(--amber); }
.btn-delete { background-color: var(--signal); }

.empty-state {
    text-align: center;
    padding: 48px 20px;
    color: var(--steel);
}

.empty-state i {
    font-size: 2.8rem;
    color: var(--steel-soft);
    margin-bottom: 12px;
    opacity: .6;
}
</style>
</head>
<body>

<!-- Toast Notification -->
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
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'O', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</strong>
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
                        <i class="fas fa-magnifying-glass-chart"></i> Pencegahan Kebakaran & Inspeksi
                    </a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="{{ Request::is('internal/pencegahan/pemberdayaan-masyarakat*') ? 'active' : '' }}">
                        <i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat
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
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') || Request::is('internal/damtan/kelola-izin-keramaian*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>

                    <!-- MENU BARU: REKAP LAYANAN & OBJEK -->
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
                    
                    <!-- MENU KELOLA SURAT KERAMAIAN -->
                    <a href="{{ route('internal.izin-keramaian.index') }}" class="{{ Request::is('internal/damtan/kelola-izin-keramaian*') ? 'active' : '' }}">
                        <i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span>
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
                    <a href="/sapra/sarana-mako"><i class="fas fa-fire-extinguisher"></i> Sarana pemadam</a>
                    <a href="/sapra/prasarana-mako"><i class="fas fa-building"></i> Prasarana pemadam</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i> Sarana Penyelamatan
                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i> Sarana Pemeriksaan
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
                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
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

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="content">

        <!-- Header Aksi -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div class="page-head m-0">
                <h1>Kelola Berita Utama</h1>
                <p>Manajemen data informasi kejadian, evakuasi, dan berita daerah.</p>
            </div>
            <div>
                <!-- Tombol Tambah Hanya untuk Operator -->
                @role('Operator')
                <a href="/internal/operator/kelola-berita/tambah" class="btn-simerah-danger">
                    <i class="fas fa-plus"></i> Tambah Berita Baru
                </a>
                @endrole
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 35%;">Judul Kejadian</th>
                            <th style="width: 20%;">Pelapor</th>
                            <th style="width: 15%;">Sumber</th>
                            <th style="width: 15%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita ?? [] as $b)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($b->tanggal_kejadian)->format('d M Y') }}</div>
                                <div class="text-muted small"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($b->waktu_kejadian)->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <span class="title-text">{{ $b->judul }}</span>
                                <span class="location-text"><i class="fas fa-location-dot text-danger me-1"></i> {{ Str::limit($b->lokasi, 45) }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark"><i class="fas fa-user-circle text-muted me-1"></i> {{ $b->pelapor }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border">
                                    <i class="fas fa-circle-info me-1"></i> {{ Str::limit($b->sumber_informasi, 18) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <!-- Tombol Lihat (View) bisa diakses semua user -->
                                <a href="/berita/{{ $b->id }}" target="_blank" class="action-btn btn-view" title="Lihat Publik">
                                    <i class="fas fa-arrow-up-right-from-square"></i>
                                </a>

                                <!-- Aksi Edit dan Hapus Hanya untuk Operator -->
                                @role('Operator')
                                <a href="/internal/operator/kelola-berita/edit/{{ $b->id }}" class="action-btn btn-edit mx-1" title="Edit">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <form action="/internal/operator/kelola-berita/hapus/{{ $b->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kejadian ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Hapus">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </form>
                                @endrole

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <h6 class="fw-bold text-dark mt-2 mb-1">Belum Ada Data</h6>
                                    <p class="small mb-0">Belum ada data kejadian atau berita yang diinput ke dalam sistem.</p>
                                </div>
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

    /* ---------- Toast Auto-Hide ---------- */
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

    /* ---------- Single Open Accordion Sidebar ---------- */
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