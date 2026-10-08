<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Akun Pemohon | SIMERAH KOJA</title>
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

/* ==========================================================
   1. DESIGN TOKENS
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

    --sidebar-w: 288px; /* Menyamakan lebar sidebar */
    --topbar-h: 70px;

    --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
    --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
    --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
    --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
}

/* ==========================================================
   2. RESET
   ========================================================== */

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
    font-family: var(--font-body); font-size: 1rem; line-height: 1.6;
    color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased;
}
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* ==========================================================
   3. TOAST / NOTIFICATION
   ========================================================== */

.toast-wrap {
    position: fixed; z-index: 2000; top: 18px; left: 50%;
    transform: translateX(-50%); display: grid; gap: 10px;
    width: max-content; max-width: calc(100vw - 24px);
}
.toast-custom {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 12px 12px 16px; border-radius: 999px;
    background: #ffffff; border: 1px solid var(--line);
    box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem;
    animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
}
.toast-custom.leaving { animation: toastOut .3s ease forwards; }
.toast-ico {
    flex: none; width: 28px; height: 28px; border-radius: 50%;
    display: grid; place-items: center; color: #fff; font-size: .78rem;
}
.toast-custom.ok .toast-ico { background: var(--success); }
.toast-custom.err .toast-ico { background: var(--signal); }
.toast-x {
    flex: none; width: 30px; height: 30px; border-radius: 50%;
    display: grid; place-items: center; background: var(--paper);
    transition: background .2s, color .2s;
}
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* ==========================================================
   4. TOPBAR
   ========================================================== */

.topbar {
    position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
}
.topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
.side-toggle {
    display: none; width: 40px; height: 40px; border-radius: 10px;
    align-items: center; justify-content: center; font-size: 1.05rem;
    color: #fff; transition: background .2s, transform .2s;
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
    display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px;
    border-radius: 999px; background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.12); transition: background .2s, border-color .2s;
}
.user-chip:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.18); }
.user-avatar {
    width: 36px; height: 36px; border-radius: 50%; background: #ffffff;
    color: var(--ink); display: grid; place-items: center;
    font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
}
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff;
    color: var(--ink); font-weight: 600; font-size: .84rem; border: none;
    transition: background .2s, color .2s, transform .1s, box-shadow .2s;
}
.btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }
.btn-logout:active { transform: scale(.97); }

/* ==========================================================
   7. MAIN SHELL
   ========================================================== */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

/* ==========================================================
   8. SIDEBAR
   ========================================================== */
.sidebar {
    width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff;
    border-right: 1px solid var(--line); padding: 20px 14px 32px;
    scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
}
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

.side-link {
    display: flex; align-items: center; gap: 14px; padding: 11px 14px;
    border-radius: var(--r-sm); font-size: .89rem; font-weight: 600;
    color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px;
}
.side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #ffffff; }

.side-group + .side-group { margin-top: 6px; }
.side-group summary {
    list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px;
    padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700;
    letter-spacing: .04em; text-transform: uppercase; color: var(--navy);
    transition: background .2s, color .2s; user-select: none;
}
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }

.side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
.side-sub a {
    display: flex; align-items: center; gap: 12px; padding: 9px 12px;
    border-radius: var(--r-sm); font-size: .84rem; font-weight: 500;
    line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s;
}
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }

.side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }

.sidebar-backdrop { display: none; }
@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar {
        position: fixed; z-index: 1010; top: var(--topbar-h); left: 0;
        height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
        transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
    }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop {
        display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000;
        background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s;
    }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* ==========================================================
   MAIN CONTENT (PEMOHON MANAGEMENT SPECIFIC)
   ========================================================== */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

.page-head { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 26px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.5rem, 2.5vw, 1.8rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

.content-card {
    background: #ffffff;
    border: 1px solid var(--line);
    border-radius: var(--r-md);
    padding: 24px;
    box-shadow: var(--shadow-xs);
    overflow: hidden;
}

/* Add Button */
.btn-add {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-height: 42px; padding: 0 18px;
    background: var(--navy); color: #fff;
    border: none; border-radius: 8px;
    font-size: .9rem; font-weight: 600;
    transition: all .2s ease;
}
.btn-add:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
.btn-add:active { transform: translateY(0); }

/* Table */
.table-responsive { overflow-x: auto; }
.table { margin-bottom: 0; min-width: 850px; border-collapse: collapse; width: 100%;}
.table thead th {
    background: var(--paper); color: var(--steel);
    font-size: .75rem; font-weight: 700; text-align: left;
    text-transform: uppercase; letter-spacing: .04em;
    padding: 14px 16px; border-bottom: 1px solid var(--line);
    white-space: nowrap;
}
.table tbody td {
    padding: 14px 16px; vertical-align: middle;
    color: var(--ink); font-size: .9rem; font-weight: 500;
    border-bottom: 1px solid var(--line);
}
.table tbody tr { transition: background .15s ease; }
.table tbody tr:hover { background: var(--paper); }
.table tbody tr:last-child td { border-bottom: none; }
.table .fw-bold { font-weight: 700 !important; color: var(--ink); }

/* Role Badge */
.badge-role {
    display: inline-flex; align-items: center;
    padding: 5px 12px; border-radius: 6px;
    font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em;
}
.badge-role.pemohon { background: var(--info-soft); color: var(--info); border: 1px solid rgba(37, 99, 235, .15); }

/* Action Buttons */
.btn-action {
    width: 34px; height: 34px;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 8px; border: none; font-size: .9rem;
    transition: all .2s ease;
}
.btn-edit { background: var(--info-soft); color: var(--info); }
.btn-edit:hover { background: var(--info); color: white; }
.btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
.btn-delete:hover { background: var(--signal); color: white; }

/* Modals */
.modal-content {
    border: 1px solid var(--line) !important;
    border-radius: var(--r-md) !important;
    overflow: hidden;
    box-shadow: var(--shadow-lg) !important;
}
.modal-header {
    background: var(--ink) !important;
    border-bottom: none !important;
    padding: 18px 24px;
}
.modal-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: white; display: flex; align-items: center;}
.modal-body { padding: 24px !important; background: var(--paper); }
.modal-footer {
    background: #fff;
    border-top: 1px solid var(--line);
    padding: 16px 24px;
}

.card-inner { background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; }
.section-title { font-size: .85rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--navy); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }

.modal .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; display: block;}
.modal .form-control, .modal .form-select {
    min-height: 42px; font-size: .92rem;
    border: 1px solid var(--line-dark);
    border-radius: 8px; color: var(--ink);
    box-shadow: none; transition: all .2s ease; width: 100%;
}
.modal .form-control:focus, .modal .form-select:focus {
    border-color: var(--navy); outline: none;
    box-shadow: 0 0 0 3px var(--navy-soft);
}
.modal .form-text { font-size: .82rem; color: var(--steel); margin-top: 6px; }

.modal .btn { min-height: 40px; padding: 0 18px; border-radius: 8px; font-size: .88rem; font-weight: 600; }
.modal .btn-secondary { background: var(--line); color: var(--ink); border: none; transition: .2s;}
.modal .btn-secondary:hover { background: var(--line-dark); }
.modal .btn-primary { background: var(--navy); color: white; border: none; transition: .2s; }
.modal .btn-primary:hover { background: var(--navy-dark); }

.alert-error {
    background: var(--signal-soft); color: var(--signal-dark);
    border: 1px solid rgba(220, 53, 69, .2);
    border-radius: var(--r-sm);
    padding: 14px 16px; margin-bottom: 20px;
    font-size: .88rem; font-weight: 500;
}
.alert-error ul { margin-top: 6px; margin-bottom: 0; padding-left: 20px; line-height: 1.5; }

@media (max-width: 767px) {
    .content { padding: 20px 16px 60px; }
    .page-head h1 { font-size: 1.5rem; }
    .content-card { padding: 16px; }
    .page-head { flex-direction: column; align-items: flex-start !important; gap: 16px; }
    .btn-add { width: 100%; }
}

@media print {
    .topbar, .sidebar, .btn-add, .btn-action, .modal { display: none !important; }
    .content { padding: 0; background: white; }
    .content-card { box-shadow: none; border: 1px solid #ddd; padding: 0; }
}
    </style>
</head>
<body>

<!-- PEMBATASAN ROLE UNTUK SELURUH HALAMAN -->
@hasrole('Super User')

<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast-custom ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div class="toast-custom err" data-toast>
            <span class="toast-ico"><i class="fas fa-exclamation-triangle"></i></span>
            <span>{{ session('error') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if($errors->any())
        <div class="toast-custom err" data-toast>
            <span class="toast-ico"><i class="fas fa-exclamation-triangle"></i></span>
            <span>Gagal memproses data. Silakan periksa formulir Anda.</span>
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
                        <i class="fas fa-fire-extinguisher"></i><span class="lbl">Input data</span>
                    </a>
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i><span class="lbl">Input Rekap Layanan</span>
                    </a>
                    <a href="/internal/damtan/rekap-objek" class="{{ Request::is('internal/damtan/rekap-objek*') ? 'active' : '' }}">
                        <i class="fas fa-house-chimney-crack"></i><span class="lbl">Input Rekap Objek Kebakaran</span>
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban/create*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i><span class="lbl">Buat Surat Korban</span>
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') || Request::is('internal/damtan/lihat-data*') || Request::is('internal/damtan/edit-data*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span>
                    </a>
                    <a href="/internal/surat-korban/data" class="{{ Request::is('internal/surat-korban/data*') || Request::is('internal/surat-korban/edit*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i><span class="lbl">Kelola Surat Korban</span>
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

        <!-- MANAJEMEN INFORMASI: semua pegawai internal bisa melihat menu ini -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') || Request::is('internal/peta-sigap*') ? 'open' : '' }}>
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                        <i class="far fa-newspaper"></i><span class="lbl">Kelola Berita</span>
                    </a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                        <i class="far fa-image"></i><span class="lbl">Kelola Infografis</span>
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
                    
                    <!-- Khusus untuk Input Titik, dibatasi hanya untuk Super User & Operator -->
                    @hasanyrole('Super User|Operator')
                    <a href="/internal/peta-sigap/input" class="{{ Request::is('internal/peta-sigap/input*') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                    </a>
                    @endhasanyrole

                    <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
                        <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                    </a>
                </div>
            </details>
        @endhasanyrole="fas fa-plus"></i><span class="lbl">Input Titik Peta</span>
                    </a>
                    <a href="/internal/peta-sigap/data" class="{{ Request::is('internal/peta-sigap/data*') ? 'active' : '' }}">
                        <i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span>
                    </a>
                </div>
            </details>
        @endhasanyrole

        <!-- PENGATURAN AKUN -->
        <div class="side-kicker">Akun</div>
        <details class="side-group" open>
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

                <a href="{{ url('/internal/kelola-pemohon') }}" class="active">
                    <i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span>
                </a>
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <!-- HEADER -->
        <div class="page-head">
            <div>
                <h1>Kelola Akun Pemohon</h1>
                <p>Manajemen data akun masyarakat atau perusahaan yang terdaftar di sistem.</p>
            </div>
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addPemohonModal">
                <i class="fas fa-plus"></i> Tambah Akun Manual
            </button>
        </div>

        <!-- TABLE -->
        <div class="content-card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>NIK (16 Digit)</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. WhatsApp</th>
                            <th>Role</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $pemohons = $pemohons ?? (\Illuminate\Support\Facades\Schema::hasTable('pemohons') ? \Illuminate\Support\Facades\DB::table('pemohons')->get() : []);
                        @endphp
                        
                        @forelse($pemohons as $index => $pemohon)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $pemohon->nik }}</td>
                                <td class="fw-bold">{{ $pemohon->nama_lengkap }}</td>
                                <td>{{ $pemohon->email }}</td>
                                <td>{{ $pemohon->no_whatsapp }}</td>
                                <td>
                                    <span class="badge-role pemohon">
                                        {{ ucfirst($pemohon->role ?? 'Pemohon') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- EDIT BUTTON -->
                                        <button type="button" class="btn-action btn-edit" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editPemohonModal{{ $pemohon->id ?? $index }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- DELETE BUTTON -->
                                        <form action="/internal/kelola-pemohon/hapus/{{ $pemohon->id ?? '' }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pemohon ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Akun">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT PEMOHON (DALAM LOOP) -->
                            <div class="modal fade" id="editPemohonModal{{ $pemohon->id ?? $index }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-user-edit me-2"></i> Edit Akun Pemohon
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="/internal/kelola-pemohon/update/{{ $pemohon->id ?? '' }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="card-inner">
                                                    
                                                    <div class="section-title"><i class="fas fa-id-card"></i> Identitas Pemohon</div>
                                                    <div class="row g-3 mb-4">
                                                        <div class="col-md-6">
                                                            <label class="form-label">NIK (16 Digit) <span class="text-danger">*</span></label>
                                                            <input type="text" name="nik" class="form-control" value="{{ $pemohon->nik }}" required maxlength="16">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Nama Lengkap Pemohon <span class="text-danger">*</span></label>
                                                            <input type="text" name="nama_lengkap" class="form-control" value="{{ $pemohon->nama_lengkap }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="section-title"><i class="fas fa-address-book"></i> Informasi Kontak & Akses</div>
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                                            <input type="email" name="email" class="form-control" value="{{ $pemohon->email }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                                            <input type="text" name="no_whatsapp" class="form-control" value="{{ $pemohon->no_whatsapp }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Role Akun</label>
                                                            <select name="role" class="form-select">
                                                                <option value="pemohon" selected>Pemohon</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Password Akses Baru</label>
                                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                                                            <div class="form-text">Minimal 8 karakter.</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-users-slash mb-2" style="font-size: 1.5rem; opacity: 0.5;"></i><br>
                                    Belum ada data akun pemohon yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<!-- ==================== MODAL TAMBAH PEMOHON (DILUAR LOOP) ==================== -->
<div class="modal fade" id="addPemohonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i> Tambah Akun Pemohon
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/internal/kelola-pemohon/tambah" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-inner">
                        
                        <div class="section-title"><i class="fas fa-id-card"></i> Identitas Pemohon</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">NIK (16 Digit) <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control" required maxlength="16" placeholder="Contoh: 150xxxxxxxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap Pemohon <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control" required placeholder="Sesuai KTP">
                            </div>
                        </div>

                        <div class="section-title"><i class="fas fa-address-book"></i> Informasi Kontak & Akses</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required placeholder="contoh@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_whatsapp" class="form-control" required placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role Akun</label>
                                <select name="role" class="form-select">
                                    <option value="pemohon" selected>Pemohon</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password Akses <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    'use strict';

    /* ---------- Toast Notifikasi ---------- */
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

@else
<!-- TAMPILAN JIKA BUKAN SUPER USER -->
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="text-center p-5 bg-white shadow-sm rounded-4" style="max-width: 500px; border: 1px solid var(--line);">
        <i class="fas fa-lock text-danger mb-3" style="font-size: 3.5rem;"></i>
        <h2 class="fw-bold text-dark">Akses Ditolak</h2>
        <p class="text-muted mb-4">Maaf, halaman Kelola Akun Pemohon hanya dapat diakses oleh Administrator Sistem (Super User).</p>
        <a href="/internal/index" class="btn btn-primary px-4 py-2" style="border-radius: 999px; font-weight: 600;">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endhasrole

</body>
</html>