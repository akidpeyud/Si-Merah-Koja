<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0d1b2a">
    <title>Input Rekap Objek Kebakaran | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY (shell sama dengan dashboard)
   ========================================================== */
:root {
    --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
    --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22,58,99,.08);
    --paper: #f5f7fa; --white: #fff;
    --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220,53,69,.09);
    --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37,99,235,.09);
    --steel: #64748b; --steel-soft: #94a3b8;
    --line: #e2e8f0; --line-dark: #d5dce6;
    --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
    --font-body: 'Instrument Sans', system-ui, sans-serif;
    --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
    --sidebar-w: 288px; --topbar-h: 70px;
    --shadow-xs: 0 1px 2px rgba(13,27,42,.04);
    --shadow-sm: 0 4px 12px rgba(13,27,42,.06);
    --shadow-md: 0 10px 25px rgba(13,27,42,.08);
    --shadow-lg: 0 20px 45px rgba(13,27,42,.14);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* TOAST */
.toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
.toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
.toast.leaving { animation: toastOut .3s ease forwards; }
.toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
.toast.ok .toast-ico { background: var(--success); }
.toast.err .toast-ico { background: var(--signal); }
.toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* TOPBAR */
.topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13,27,42,.16); }
.topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
.side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s, transform .2s; }
.side-toggle:hover { background: rgba(255,255,255,.10); }
.brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
.brand img { height: 34px; width: auto; flex: none; }
.brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
.user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, transform .1s, box-shadow .2s; }
.btn-logout:hover { background: #e8eef5; box-shadow: 0 4px 10px rgba(0,0,0,.12); }
.btn-logout:active { transform: scale(.97); }

/* SHELL + SIDEBAR */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
.side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; }
.side-link.active { background: var(--ink); color: #fff; }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); flex: none; margin-top: 3px; }
.side-link.active i { color: #fff; }
.lbl { flex: 1 1 auto; min-width: 0; overflow-wrap: break-word; line-height: 1.4; }
.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s; user-select: none; }
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; line-height: 1.4; }
.side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }
.side-sub { display: grid; gap: 3px; padding: 6px 0 10px 8px; border-left: 2px solid var(--line); margin: 2px 0 8px 18px; }
.side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; flex: none; margin-top: 3px; }
.side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
.sidebar-backdrop { display: none; }
@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* CONTENT */
.content { flex: 1; min-width: 0; padding: clamp(24px,4vw,44px) clamp(20px,4vw,44px) 80px; }
.page-head { margin-bottom: 26px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem,3vw,2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; }
.page-head p { color: var(--steel); font-size: .95rem; }

.section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
.section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
.section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; letter-spacing: -.01em; white-space: nowrap; }
.section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }

/* TOTAL PER KATEGORI (klik = isi form otomatis) */
.stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; margin-bottom: 38px; }
.stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 18px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); text-align: left; width: 100%; transition: box-shadow .2s, border-color .2s, transform .2s; }
.stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
.stat-card.picked { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
.stat-ico { width: 40px; height: 40px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1rem; margin-bottom: 14px; }
.stat-title { font-size: .74rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
.stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; letter-spacing: -.01em; }
.ic-red { background: var(--signal-soft); color: var(--signal-dark); }
.ic-amber { background: rgba(244,183,64,.16); color: #a8700b; }
.ic-blue { background: var(--info-soft); color: var(--info); }
.ic-teal { background: rgba(13,148,136,.10); color: #0d9488; }
.ic-purple { background: rgba(124,58,237,.10); color: #7c3aed; }
.ic-pink { background: rgba(219,39,119,.10); color: #db2777; }
.ic-steel { background: rgba(100,116,139,.10); color: #64748b; }

/* FORM */
.panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); box-shadow: var(--shadow-xs); overflow: hidden; margin-bottom: 38px; }
.panel-head { padding: 18px 24px; border-bottom: 1px solid var(--line); background: var(--navy-light); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
.panel-head h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; display: flex; align-items: center; gap: 10px; }
.panel-head h4 i { color: var(--navy); }
.panel-body { padding: 24px; }
.f-label { display: block; font-size: .8rem; font-weight: 700; margin-bottom: 6px; }
.f-label .req { color: var(--signal); }
.f-control { width: 100%; height: 46px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: var(--r-sm); background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
textarea.f-control { height: auto; padding: 12px 14px; resize: vertical; min-height: 92px; }
.f-control:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
.f-hint { font-size: .76rem; color: var(--steel); margin-top: 5px; }
.f-error { font-size: .78rem; color: var(--signal-dark); margin-top: 5px; font-weight: 600; }
.f-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px; }
.c-3 { grid-column: span 3; } .c-4 { grid-column: span 4; } .c-6 { grid-column: span 6; } .c-8 { grid-column: span 8; } .c-12 { grid-column: span 12; }
@media (max-width: 900px) { .c-3, .c-4, .c-6, .c-8 { grid-column: span 12; } }
.form-foot { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 24px; border-top: 1px solid var(--line); background: #fbfcfd; flex-wrap: wrap; }
.btn-main, .btn-ghost { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 44px; padding: 0 22px; border-radius: 999px; font-weight: 600; font-size: .88rem; transition: background .2s, transform .1s, box-shadow .2s; }
.btn-main { background: var(--ink); color: #fff; }
.btn-main:hover { background: var(--ink-3); box-shadow: 0 6px 14px rgba(13,27,42,.18); }
.btn-ghost { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
.btn-ghost:hover { background: #f3f6fa; }
.btn-main:active, .btn-ghost:active { transform: scale(.97); }

/* TABEL RIWAYAT */
.tbl-wrap { overflow-x: auto; }
.tbl { width: 100%; border-collapse: collapse; font-size: .88rem; min-width: 680px; }
.tbl th { text-align: left; padding: 12px 18px; font-size: .72rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); background: #fbfcfd; border-bottom: 1px solid var(--line); white-space: nowrap; }
.tbl td { padding: 14px 18px; border-bottom: 1px solid var(--line); vertical-align: middle; }
.tbl tr:last-child td { border-bottom: 0; }
.tbl tbody tr:hover { background: #fafbfd; }
.tag { display: inline-flex; align-items: center; gap: 7px; padding: 4px 11px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: var(--navy-soft); color: var(--navy); }
.num { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; }
.btn-icon { width: 34px; height: 34px; border-radius: 9px; display: inline-grid; place-items: center; color: var(--steel); transition: background .2s, color .2s; }
.btn-icon:hover { background: var(--signal-soft); color: var(--signal-dark); }
.empty { padding: 44px 20px; text-align: center; color: var(--steel); }
.empty i { font-size: 1.6rem; color: var(--steel-soft); margin-bottom: 10px; display: block; }

@media (max-width: 700px) {
    :root { --topbar-h: 64px; }
    .topbar { padding: 0 14px; gap: 10px; }
    .brand img { height: 30px; }
    .brand span { font-size: .95rem; }
    .user-chip { padding: 3px; border: none; background: transparent; }
    .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
    .btn-logout i { font-size: .9rem; }
    .content { padding: 26px 14px 50px; }
    .stats-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .panel-body { padding: 18px; }
}
@media (max-width: 420px) { .brand span { display: none; } }
@media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } *, *::before, *::after { animation: none !important; transition: none !important; } }
    </style>
</head>
<body>

@php
    // Daftar kategori untuk Objek Kebakaran
    $kategori = [
        'objek_rumah'     => ['Rumah',                'fa-house-chimney', 'ic-red'],
        'objek_kantor'    => ['Kantor / Sekolah',     'fa-school',        'ic-blue'],
        'objek_ruko'      => ['Ruko / Toko / Kios',   'fa-store',         'ic-amber'],
        'objek_gudang'    => ['Gudang',               'fa-warehouse',     'ic-steel'],
        'objek_bengkel'   => ['Bengkel',              'fa-wrench',        'ic-steel'],
        'objek_mall'      => ['Mall / Swalayan',      'fa-cart-shopping', 'ic-teal'],
        'objek_restoran'  => ['Restoran / Foodcourt', 'fa-utensils',      'ic-teal'],
        'objek_toko'      => ['Toko / Kios',          'fa-shop',          'ic-amber'],
        'objek_kandang'   => ['Kandang Ternak',       'fa-paw',           'ic-red'],
        'objek_kendaraan' => ['Kendaraan Bermotor',   'fa-car',           'ic-purple'],
        'objek_hotel'     => ['Hotel / Penginapan',   'fa-hotel',         'ic-teal'],
        'objek_hiburan'   => ['Tempat Hiburan',       'fa-masks-theater', 'ic-pink'],
        'objek_vital'     => ['Objek Vital',          'fa-bolt',          'ic-red'],
    ];
    $totals = $totals ?? [];
    $riwayat = $riwayat ?? collect();
@endphp

<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') ?? 'Data belum tersimpan. Periksa isian yang bertanda merah.' }}</span>
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

        <a href="/internal/index" class="side-link"><i class="fas fa-house"></i><span class="lbl">Dashboard utama</span></a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Modul operasional</div>

            <details class="side-group">
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-arrow-trend-up"></i><span class="lbl">Peningkatan Kapasitas Aparatur</span></a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran"><i class="fas fa-magnifying-glass-chart"></i><span class="lbl">Pencegahan Kebakaran dan Inspeksi</span></a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat"><i class="fas fa-handshake-angle"></i><span class="lbl">Pemberdayaan Masyarakat dan Dunia Usaha</span></a>
                    <a href="/internal/pencegahan/kelola-edukasi"><i class="fas fa-bullhorn"></i><span class="lbl">Kelola Edukasi</span></a>
                    <a href="/internal/pencegahan/kelola-redkar"><i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Redkar</span></a>
                    <a href="/internal/pencegahan/kelola-rpkbgl"><i class="fas fa-building-circle-check"></i><span class="lbl">Kelola RPKBGL</span></a>
                    <a href="/internal/pencegahan/kelola-skk"><i class="fas fa-file-shield"></i><span class="lbl">Kelola SKK</span></a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" open>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data"><i class="fas fa-fire-extinguisher"></i><span class="lbl">Input data</span></a>
                    <a href="/internal/damtan/rekap-layanan"><i class="fas fa-truck-medical"></i><span class="lbl">Input Rekap Layanan &amp; Penyelamatan</span></a>
                    <!-- Menu Objek diaktifkan class active nya -->
                    <a href="/internal/damtan/rekap-objek" class="active"><i class="fas fa-house-chimney-crack"></i><span class="lbl">Input Rekap Objek Kebakaran</span></a>
                    <a href="/internal/surat-korban/create"><i class="fas fa-file-signature"></i><span class="lbl">Buat Surat Korban</span></a>
                    <a href="/internal/damtan/data-laporan"><i class="fas fa-clipboard-list"></i><span class="lbl">Kelola Data Laporan</span></a>
                    <a href="/internal/surat-korban/data"><i class="fas fa-folder"></i><span class="lbl">Kelola Surat Korban</span></a>
                    <a href="{{ route('internal.izin-keramaian.index') }}"><i class="fas fa-users-rectangle"></i><span class="lbl">Kelola Surat Keramaian</span></a>
                </div>
            </details>

            <details class="side-group">
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk"><i class="fas fa-user-tie"></i><span class="lbl">Data Urut Kepegawaian</span></a>
                    <a href="/internal/program-kerja"><i class="fas fa-file-contract"></i><span class="lbl">Program Kerja</span></a>
                </div>
            </details>

            <details class="side-group">
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako"><i class="fas fa-fire-extinguisher"></i><span class="lbl">Sarana pemadam kebakaran</span></a>
                    <a href="/sapra/prasarana-mako"><i class="fas fa-building"></i><span class="lbl">Prasarana pemadam kebakaran</span></a>
                    <a href="/sapra/sarana-penyelamatan"><i class="fas fa-life-ring"></i><span class="lbl">Sarana Penyelamatan &amp; Evakuasi</span></a>
                    <a href="/sapra/sarana-pemeriksaan"><i class="fas fa-search-location"></i><span class="lbl">Sarana Pemeriksaan Proteksi Kebakaran</span></a>
                    <a href="/sapra/kelola-pos"><i class="fas fa-warehouse"></i><span class="lbl">Kelola Data Pos</span></a>
                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung"><i class="fas fa-droplet"></i><span class="lbl">Sumber Air</span></a>
                    <a href="/sapra/data-hidrant-kota"><i class="fas fa-map-location-dot"></i><span class="lbl">Data Hidrant Kota Jambi</span></a>
                    <span class="side-kicker" style="padding-left:2px;">Logistik &amp; Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras"><i class="fas fa-boxes-stacked"></i><span class="lbl">Mutu Baku Kebutuhan</span></a>
                    <a href="/sapra/distribusi-staff"><i class="fas fa-people-carry-box"></i><span class="lbl">Serah terima Barang</span></a>
                </div>
            </details>
        @endif

        @if(in_array(Auth::user()->role, ['operator', 'user', 'super_user']))
            <div class="side-kicker">Konten publik</div>
            <details class="side-group">
                <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen Informasi</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                        <a href="/internal/operator/kelola-berita"><i class="far fa-newspaper"></i><span class="lbl">Input &amp; Kelola Berita</span></a>
                        <a href="/internal/operator/infografis"><i class="far fa-image"></i><span class="lbl">Kelola Info Grafis</span></a>
                        <a href="/internal/operator/berita-medsos"><i class="fab fa-instagram"></i><span class="lbl">Kelola Berita Medsos</span></a>
                        <a href="/internal/operator/ujung-damkar"><i class="fab fa-youtube"></i><span class="lbl">Ujung-Ujung Damkar</span></a>
                        <a href="/internal/operator/edu-damkar"><i class="fas fa-graduation-cap"></i><span class="lbl">Edu Damkar</span></a>
                    @endif
                    @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                        <div class="side-kicker" style="padding: 12px 10px 4px; font-size: .65rem;">PEMETAAN SIGAP</div>
                        <a href="/internal/peta-sigap/input"><i class="fas fa-plus"></i><span class="lbl">Input Titik Peta</span></a>
                        <a href="/internal/peta-sigap/data"><i class="fas fa-table-list"></i><span class="lbl">Kelola Data Titik</span></a>
                    @endif
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group">
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="{{ url('/internal/profil') }}"><i class="fas fa-user-pen"></i><span class="lbl">Profil Saya</span></a>
                @if(auth()->user()->role === 'super_user')
                    <a href="{{ url('/internal/kelola-user') }}"><i class="fas fa-users-gear"></i><span class="lbl">Kelola Pengguna</span></a>
                @endif
                <a href="{{ url('/internal/kelola-pemohon') }}"><i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span></a>
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN ==================== -->
    <main class="content">

        <div class="page-head">
            <h1>Input Rekap Objek Kebakaran</h1>
            <p>Bagian Pemadaman &amp; Penyelamatan - Disdamkartan Kota Jambi. Data yang disimpan di sini tampil sebagai angka di halaman publik.</p>
        </div>

        <!-- TOTAL PER KATEGORI -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-chart-simple"></i></span>
            <h3>Total saat ini</h3>
            <span class="line"></span>
        </div>
        <div class="stats-grid">
            @foreach($kategori as $key => [$nama, $ikon, $warna])
                <button type="button" class="stat-card" data-pick="{{ $key }}" aria-label="Isi form untuk {{ $nama }}">
                    <div class="stat-ico {{ $warna }}"><i class="fas {{ $ikon }}"></i></div>
                    <div class="stat-title">{{ $nama }}</div>
                    <div class="stat-value">{{ number_format($totals[$key] ?? 0, 0, ',', '.') }}</div>
                </button>
            @endforeach
        </div>

        <!-- FORM INPUT -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-pen-to-square"></i></span>
            <h3>Tambah data objek</h3>
            <span class="line"></span>
        </div>

        <form action="/internal/damtan/rekap-objek" method="POST" class="panel" id="rekapForm" novalidate>
            @csrf
            <div class="panel-head">
                <h4><i class="fas fa-house-chimney-crack"></i> Data Objek Terbakar</h4>
            </div>
            <div class="panel-body">
                <div class="f-grid">
                    <div class="c-4">
                        <label class="f-label" for="tanggal">Tanggal <span class="req">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="f-control" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                        @error('tanggal')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-4">
                        <label class="f-label" for="kategori">Objek Terbakar <span class="req">*</span></label>
                        <select id="kategori" name="kategori" class="f-control" required>
                            <option value="">-- Pilih objek terbakar --</option>
                            @foreach($kategori as $key => [$nama])
                                <option value="{{ $key }}" {{ old('kategori') === $key ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-4">
                        <label class="f-label" for="jumlah">Jumlah <span class="req">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" class="f-control" min="1" max="9999" value="{{ old('jumlah', 1) }}" required>
                        <div class="f-hint">Jumlah kejadian pada tanggal ini.</div>
                        @error('jumlah')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-6">
                        <label class="f-label" for="kecamatan">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="f-control" placeholder="Cth: Kota Baru" value="{{ old('kecamatan') }}">
                        @error('kecamatan')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-6">
                        <label class="f-label" for="lokasi">Lokasi / alamat</label>
                        <input type="text" id="lokasi" name="lokasi" class="f-control" placeholder="Cth: Jl. Sultan Thaha, RT 05" value="{{ old('lokasi') }}">
                        @error('lokasi')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-12">
                        <label class="f-label" for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="f-control" placeholder="Catatan singkat penanganan (opsional)">{{ old('keterangan') }}</textarea>
                        @error('keterangan')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="form-foot">
                <button type="reset" class="btn-ghost"><i class="fas fa-rotate-left"></i> Kosongkan</button>
                <button type="submit" class="btn-main"><i class="fas fa-floppy-disk"></i> Simpan rekap</button>
            </div>
        </form>

        <!-- RIWAYAT -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-clock-rotate-left"></i></span>
            <h3>Riwayat input objek terbaru</h3>
            <span class="line"></span>
        </div>

        <div class="panel">
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Objek Terbakar</th>
                            <th>Jumlah</th>
                            <th>Kecamatan</th>
                            <th>Keterangan</th>
                            <th style="width:60px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $r)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</td>
                                <td><span class="tag">{{ $kategori[$r->kategori][0] ?? $r->kategori }}</span></td>
                                <td><span class="num">{{ $r->jumlah }}</span></td>
                                <td>{{ $r->kecamatan ?: '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($r->keterangan ?: '-', 60) }}</td>
                                <td>
                                    <form action="/internal/damtan/rekap-objek/{{ $r->id }}" method="POST" onsubmit="return confirm('Hapus data rekap ini?')" style="margin:0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6">
                                <div class="empty"><i class="fas fa-inbox"></i>Belum ada data. Pilih objek terbakar di atas lalu simpan rekap pertama.</div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<script>
(function () {
    'use strict';

    /* Notifikasi */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () { t.classList.add('leaving'); setTimeout(function () { t.remove(); }, 350); };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    /* Sidebar mobile */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    function closeSide() { document.body.classList.remove('side-open'); if (toggle) toggle.setAttribute('aria-expanded', 'false'); }
    if (toggle) toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('side-open');
        toggle.setAttribute('aria-expanded', open);
    });
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* Grup sidebar: hanya satu terbuka */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    /* Klik kartu total = pilih objek di form */
    var select = document.getElementById('kategori');
    var cards = document.querySelectorAll('[data-pick]');
    cards.forEach(function (c) {
        c.addEventListener('click', function () {
            select.value = c.dataset.pick;
            cards.forEach(function (o) { o.classList.toggle('picked', o === c); });
            document.getElementById('rekapForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(function () { document.getElementById('jumlah').focus(); }, 350);
        });
    });
    select.addEventListener('change', function () {
        cards.forEach(function (o) { o.classList.toggle('picked', o.dataset.pick === select.value); });
    });

    /* Validasi ringan sebelum kirim */
    document.getElementById('rekapForm').addEventListener('submit', function (e) {
        if (!select.value) { e.preventDefault(); select.focus(); alert('Pilih objek terbakar dulu.'); }
    });
})();
</script>
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0d1b2a">
    <title>Input Rekap Objek Kebakaran | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================================
           SIMERAH KOJA - CLEAN NAVY DASHBOARD
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
            --line-dark: #cbd5e1;

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

        /* ==========================================================
           TOAST / NOTIFICATION (SISTEM POPUP MODERN)
           ========================================================== */
        .toast-wrap { position: fixed; z-index: 9999; top: 20px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); pointer-events: none; }
        .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-lg); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; pointer-events: auto; }
        .toast.leaving { animation: toastOut .3s ease forwards; }
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
        .toast.ok .toast-ico { background: var(--success); }
        .toast.err .toast-ico { background: var(--signal); }
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-20px); } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
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
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #ffffff; }
        .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
        .btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }
        .btn-logout:active { transform: scale(.97); }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        /* ==========================================================
           SHELL & SIDEBAR
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
        .side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
        .side-link.active { background: var(--ink); color: #ffffff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: #ffffff; }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }

        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           MAIN CONTENT & FORM STYLING
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        
        .page-head { margin-bottom: 26px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0;}

        /* STATS GRID */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 14px; margin-bottom: 38px; }
        .stat-card { display: flex; flex-direction: column; padding: 18px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); text-align: left; }
        .stat-card:hover { border-color: var(--navy); transform: translateY(-3px); box-shadow: var(--shadow-sm); }
        .stat-card.picked { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        .stat-ico { width: 40px; height: 40px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1rem; margin-bottom: 14px; }
        .stat-title { font-size: .74rem; font-weight: 700; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; }
        .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; }
        
        .ic-red { background: var(--signal-soft); color: var(--signal-dark); }
        .ic-amber { background: rgba(244,183,64,.16); color: #a8700b; }
        .ic-blue { background: var(--info-soft); color: var(--info); }
        .ic-teal { background: rgba(13,148,136,.10); color: #0d9488; }
        .ic-purple { background: rgba(124,58,237,.10); color: #7c3aed; }
        .ic-pink { background: rgba(219,39,119,.10); color: #db2777; }
        .ic-steel { background: #f1f5f9; color: var(--steel); }

        /* Custom Card Form */
        .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease; margin-bottom: 38px;}
        .card-custom:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }

        /* Custom Tabs */
        .card-header-tabs { background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 16px 24px 0 24px; border-radius: var(--r-md) var(--r-md) 0 0; }
        .nav-tabs-custom { border-bottom: none; display: flex; gap: 4px; overflow-x: auto; white-space: nowrap; scrollbar-width: none; }
        .nav-tabs-custom::-webkit-scrollbar { display: none; } 
        
        .nav-tabs-custom .nav-item { margin-bottom: -1px; }
        .nav-tabs-custom .nav-link { font-family: var(--font-display); font-weight: 600; font-size: 0.95rem; color: var(--steel); background: transparent; border: 1px solid transparent; border-radius: 8px 8px 0 0; padding: 12px 20px; transition: all 0.2s ease; }
        .nav-tabs-custom .nav-link:hover { color: var(--navy); border-color: transparent transparent var(--line) transparent; }
        .nav-tabs-custom .nav-link.active { color: var(--navy); background: #ffffff; border-color: var(--line) var(--line) #ffffff var(--line); }

        /* Section Title Block */
        .section-title-block { display: flex; align-items: center; gap: 12px; background: var(--navy-soft); padding: 14px 20px; border-radius: 8px; border-left: 4px solid var(--navy); font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--navy-dark); margin-bottom: 24px; }
        .section-title-block i { font-size: 1.1rem; color: var(--navy); }

        /* Form Elements */
        .field-label { font-size: .84rem; font-weight: 700; color: var(--ink-2); margin-bottom: 6px; display: inline-flex; align-items: center; }
        .field-label i { margin-right: 8px; font-size: .85rem; color: var(--steel-soft); }

        .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
        .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
        .form-control:disabled, .form-select:disabled { background-color: #f1f5f9; cursor: not-allowed; opacity: 1; border-color: var(--line); color: var(--steel);}
        .form-control::placeholder { color: var(--steel-soft); }

        .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
        

        /* Buttons */
        .btn-custom-primary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
        .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff;}
        .btn-custom-primary:active { transform: translateY(0); }
        
        .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; text-decoration: none; }
        .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }

        /* Area Highlight abu-abu */
        .highlight-area { background-color: #f8fafc; border: 1px solid var(--line); border-radius: 12px; padding: 24px 20px; margin-bottom: 24px; }

        /* TABLE */
        .tbl { width: 100%; border-collapse: collapse; font-size: .88rem; }
        .tbl th { text-align: left; padding: 12px 18px; color: var(--steel); background: #fbfcfd; border-bottom: 1px solid var(--line); font-weight: 700; text-transform: uppercase; letter-spacing: .04em; font-size: .72rem;}
        .tbl td { padding: 14px 18px; border-bottom: 1px solid var(--line); }
        .tag { display: inline-block; padding: 4px 11px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: var(--navy-soft); color: var(--navy); }
        .btn-icon { color: var(--signal); }
    </style>
</head>
<body>

@php
    $kategori = [
        'objek_rumah'     => ['Rumah',                'fa-house-chimney', 'ic-red'],
        'objek_kantor'    => ['Kantor / Sekolah',     'fa-school',        'ic-blue'],
        'objek_ruko'      => ['Ruko / Toko / Kios',   'fa-store',         'ic-amber'],
        'objek_gudang'    => ['Gudang',               'fa-warehouse',     'ic-steel'],
        'objek_bengkel'   => ['Bengkel',              'fa-wrench',        'ic-steel'],
        'objek_mall'      => ['Mall / Swalayan',      'fa-cart-shopping', 'ic-teal'],
        'objek_restoran'  => ['Restoran / Foodcourt', 'fa-utensils',      'ic-teal'],
        'objek_toko'      => ['Toko / Kios',          'fa-shop',          'ic-amber'],
        'objek_kandang'   => ['Kandang Ternak',       'fa-paw',           'ic-red'],
        'objek_kendaraan' => ['Kendaraan Bermotor',   'fa-car',           'ic-purple'],
        'objek_hotel'     => ['Hotel / Penginapan',   'fa-hotel',         'ic-teal'],
        'objek_hiburan'   => ['Tempat Hiburan',       'fa-masks-theater', 'ic-pink'],
        'objek_vital'     => ['Objek Vital',          'fa-bolt',          'ic-red'],
    ];
    $totals = $totals ?? [];
    $riwayat = $riwayat ?? collect();
@endphp

<!-- ==================== SISTEM NOTIFIKASI POPUP (TOAST) ==================== -->
<div class="toast-wrap" id="toastWrap" aria-live="polite">
    @if(session('success'))
        <div class="toast ok" data-toast>
            <span class="toast-ico"><i class="fas fa-check"></i></span>
            <span>{{ session('success') }}</span>
            <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="toast err" data-toast>
            <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
            <span>{{ session('error') ?? 'Data belum tersimpan. Periksa isian yang wajib diisi.' }}</span>
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
                        <i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass-chart"></i> Pencegahan & Inspeksi
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
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>

                    <!-- MENU REKAP LAYANAN & OBJEK -->
                    <a href="/internal/damtan/rekap-layanan" class="{{ Request::is('internal/damtan/rekap-layanan*') ? 'active' : '' }}">
                        <i class="fas fa-truck-medical"></i> Input Rekap Layanan & Penyelamatan
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
                        <i class="fas fa-users-rectangle"></i> Kelola Surat Keramaian
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
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Pemadam</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}">
                        <i class="fas fa-life-ring"></i> Sarana Penyelamatan
                    </a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}">
                        <i class="fas fa-search-location"></i> Pemeriksaan Proteksi
                    </a>
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i> Kelola Data Pos
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}">
                        <i class="fas fa-droplet"></i> Sumber Air
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}">
                        <i class="fas fa-map-location-dot"></i> Data Hidrant Kota
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box"></i> Distribusi Barang Staff
                    </a>
                </div>
            </details>
        @endif

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
        
        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Profil Saya
                </a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i> Kelola Pengguna
                    </a>
                    <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                    </a>
                @endif
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA & FORM ==================== -->
    <main class="content">

        <div class="page-head">
            <h1>Input Rekap Objek Kebakaran</h1>
            <p>Data jumlah kejadian kebakaran berdasarkan objek atau jenis bangunan yang terbakar.</p>
        </div>
        
        <div class="stats-grid">
            @foreach($kategori as $key => [$nama, $ikon, $warna])
                <button type="button" class="stat-card" data-pick="{{ $key }}">
                    <div class="stat-ico {{ $warna }}"><i class="fas {{ $ikon }}"></i></div>
                    <div class="stat-title">{{ $nama }}</div>
                    <div class="stat-value">{{ number_format($totals[$key] ?? 0, 0, ',', '.') }}</div>
                </button>
            @endforeach
        </div>

        <div class="card-custom">
            <!-- BOOTSTRAP TABS (Design Baru Terintegrasi ke Card Body) -->
            <div class="card-header-tabs">
                <ul class="nav nav-tabs-custom" id="formTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Tambah Data Objek</button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4 p-md-5 pt-4">
                <form action="/internal/damtan/rekap-objek" method="POST" id="rekapForm">
                    @csrf
                    <div class="tab-content" id="formTabsContent">
                        
                        <!-- TAB 1: INFORMASI DASAR -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            
                            <div class="section-title-block">
                                <i class="fas fa-house-chimney-crack"></i> Detail Kejadian Objek Terbakar
                            </div>

                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-calendar-alt"></i> Tanggal <span class="text-danger">*</span></label>
                                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tags"></i> Objek Terbakar <span class="text-danger">*</span></label>
                                        <select class="form-select" id="kategori" name="kategori" required>
                                            <option selected value="">-- Pilih objek terbakar --</option>
                                            @foreach($kategori as $key => [$nama])
                                                <option value="{{ $key }}">{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hashtag"></i> Jumlah Kejadian <span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="jumlah" name="jumlah" class="form-control" value="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-map"></i> Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="Cth: Kota Baru">
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-map-marker-alt"></i> Lokasi / Alamat</label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Cth: Jl. Sultan Thaha">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-align-left"></i> Keterangan Opsional</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Catatan singkat penanganan..."></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                        <button type="reset" class="btn-custom-light me-3">Kosongkan</button>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Rekap
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card-custom">
            <!-- BOOTSTRAP TABS (Design Baru Terintegrasi ke Card Body) -->
            <div class="card-header-tabs">
                <ul class="nav nav-tabs-custom" id="historyTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab"><i class="fas fa-history me-1"></i> Riwayat Input Objek</button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-0">
                <table class="tbl mb-0">
                    <thead><tr><th>Tanggal</th><th>Objek Terbakar</th><th>Jumlah</th><th>Kecamatan</th><th>Keterangan</th><th></th></tr></thead>
                    <tbody>
                        @forelse($riwayat as $r)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                <td><span class="tag">{{ $kategori[$r->kategori][0] ?? $r->kategori }}</span></td>
                                <td><strong>{{ $r->jumlah }}</strong></td>
                                <td>{{ $r->kecamatan ?: '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($r->keterangan ?: '-', 60) }}</td>
                                <td>
                                    <form action="/internal/damtan/rekap-objek/{{ $r->id }}" method="POST" onsubmit="return confirm('Hapus data rekap ini?')" style="margin:0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon" aria-label="Hapus" style="background: none; border: none;"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-inbox d-block fs-3 mb-2"></i>Belum ada data input.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </main>
</div>

<!-- ==================== SCRIPTS ==================== -->
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

    /* ---------- Sidebar (Mobile Toggle) ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if(toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* ---------- Eksklusivitas Accordion Sidebar ---------- */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });

    /* Klik kartu total = pilih objek di form */
    var select = document.getElementById('kategori');
    var cards = document.querySelectorAll('.stat-card');
    cards.forEach(function (c) {
        c.addEventListener('click', function () {
            select.value = c.dataset.pick;
            cards.forEach(function (o) { o.classList.remove('picked'); });
            c.classList.add('picked');
            document.getElementById('rekapForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(function () { document.getElementById('jumlah').focus(); }, 350);
        });
    });
    select.addEventListener('change', function () {
        cards.forEach(function (c) { 
            if(c.dataset.pick === select.value) {
                c.classList.add('picked');
            } else {
                c.classList.remove('picked');
            }
        });
    });

})();
</script>
</body>
</html>