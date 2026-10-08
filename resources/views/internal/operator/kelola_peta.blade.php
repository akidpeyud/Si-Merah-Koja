<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Data Peta SIGAP | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome & Leaflet (untuk preview peta) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">

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

    --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
    --sidebar-w: 272px; --topbar-h: 70px;

    --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
    --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
    --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
    --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* ==================== TOAST / ALERT (Bawaan) ==================== */
.toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
.toast { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
.toast.leaving { animation: toastOut .3s ease forwards; }
.toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; }
.toast.ok .toast-ico { background: var(--success); }
.toast.err .toast-ico { background: var(--signal); }
.toast-x { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; }
.toast-x:hover { background: var(--ink); color: #fff; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
@keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

/* ==================== TOPBAR ==================== */
.topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
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

/* ==================== SHELL & SIDEBAR ==================== */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
.sidebar::-webkit-scrollbar { width: 6px; }
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
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* ==================== CONTENT & CARDS ==================== */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.page-head { margin-bottom: 26px; }
.page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head p { color: var(--steel); font-size: .95rem; }
.card-box { background: #ffffff; border-radius: var(--r-md); padding: 24px; border: 1px solid var(--line); box-shadow: var(--shadow-xs); margin-bottom: 24px;}
.card-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--ink); border-bottom: 1px solid var(--line); padding-bottom: 15px; margin-bottom: 20px;}

/* Tombol Brand Simerah */
.btn-simerah-primary { background: var(--info); color: #ffffff; font-weight: 600; border-radius: var(--r-sm); padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px; border: none; transition: background .2s, transform .1s, box-shadow .2s; }
.btn-simerah-primary:hover { background: #1d4ed8; color: #ffffff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37, 99, 235, .2); }

/* Form Custom */
.form-label { font-size: 0.88rem; font-weight: 600; color: var(--ink-2); margin-bottom: 6px;}
.form-control, .form-select { border-color: var(--line-dark); border-radius: 8px; font-size: 0.95rem; padding: 10px 14px;}
.form-control:focus, .form-select:focus { border-color: var(--info); box-shadow: var(--info-soft); }

/* Map Input & Koordinat */
#mapPreview { height: 350px; border-radius: var(--r-sm); border: 1px solid var(--line-dark); z-index: 1;}
.coordinate-box { background: var(--paper); border: 1px solid var(--line); padding: 12px 16px; border-radius: var(--r-sm); font-family: monospace; font-size: 0.9rem; color: var(--steel); margin-top: 10px;}

/* Tabel Custom */
.table { font-size: .92rem; margin-bottom: 0; }
.table thead th { font-family: var(--font-display); font-size: .8rem; text-transform: uppercase; letter-spacing: .04em; font-weight: 700; color: var(--steel); background-color: var(--paper); border-bottom: 1px solid var(--line); padding: 14px 16px; }
.table tbody td { padding: 16px; border-bottom: 1px solid var(--line); vertical-align: middle; }
.table-hover tbody tr:hover { background-color: #fafbfc; }

.title-text { font-family: var(--font-display); font-weight: 700; color: var(--ink); font-size: .98rem; display: block; margin-bottom: 3px; }
.location-text { font-size: .82rem; color: var(--steel); }

.badge-kategori { font-size: 0.75rem; font-weight: 600; padding: 5px 10px; border-radius: 50px; display: inline-flex; align-items: center; gap: 5px;}

/* Action Buttons */
.action-btn { width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center; border-radius: 8px; border: none; color: #ffffff; font-size: .84rem; transition: transform .15s, filter .15s; }
.action-btn:hover { transform: translateY(-1px); color: #ffffff; filter: brightness(.92); }
.btn-view { background-color: var(--info); }
.btn-edit { background-color: var(--amber); }
.btn-delete { background-color: var(--signal); }
.empty-state { text-align: center; padding: 48px 20px; color: var(--steel); }
.empty-state i { font-size: 2.8rem; color: var(--steel-soft); margin-bottom: 12px; opacity: .6; }
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
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'A', 0, 1)) }}</span>
            <div class="user-meta">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Admin Peta' }}</strong>
                <small>{{ str_replace('_', ' ', Auth::user()->role ?? 'Super User') }}</small>
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
        <a href="/internal/index" class="side-link">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        <div class="side-kicker">Modul Peta GIS</div>
        <details class="side-group" open>
            <summary><i class="fas fa-map-location-dot grp-ico"></i><span class="grp-label">Pemetaan SIGAP</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/peta-sigap/input" class="active">
                    <i class="fas fa-plus"></i> Input Titik Peta
                </a>
                <a href="/internal/peta-sigap/data">
                    <i class="fas fa-table-list"></i> Kelola Data Titik
                </a>
            </div>
        </details>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="content">

        <div class="page-head m-0 mb-4">
            <h1>Input Titik Peta SIGAP</h1>
            <p>Kelola dan tambahkan titik koordinat operasional pemadam kebakaran Kota Jambi.</p>
        </div>

        <div class="row">
            <!-- Kolom Form Input: Hanya bisa diakses/disimpan oleh Operator -->
            @role('Operator')
            <div class="col-lg-5">
                <div class="card-box">
                    <h2 class="card-title">Detail Informasi Titik</h2>
                    
                    <form action="/internal/peta-sigap/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kategori Titik *</label>
                            <select class="form-select" name="kategori" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="kebakaran">Titik Kebakaran</option>
                                <option value="sumber_air">Titik Sumber Air</option>
                                <option value="hydrant">Titik Hydrant</option>
                                <option value="penyelamatan">Riwayat Penyelamatan</option>
                                <option value="pos">Pos / Mako Damkar</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama/Judul Titik *</label>
                            <input type="text" class="form-control" name="nama" placeholder="Contoh: Hydrant Simpang Pulai" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Kejadian/Pembangunan</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi / Alamat Lengkap *</label>
                            <textarea class="form-control" name="lokasi" rows="3" placeholder="Alamat lengkap lokasi..." required></textarea>
                        </div>

                        <!-- Input Hidden untuk menampung koordinat dari Peta -->
                        <input type="hidden" name="latitude" id="latInput" required>
                        <input type="hidden" name="longitude" id="lngInput" required>

                        <button type="submit" class="btn-simerah-primary w-100 justify-content-center mt-3">
                            <i class="fas fa-save"></i> Simpan Titik Peta
                        </button>
                    </form>
                </div>
            </div>
            @endrole

            <!-- Kolom Map Interaktif (Lebar menyesuaikan apakah form input muncul atau tidak) -->
            <div class="{{ Auth::user()->hasRole('Operator') ? 'col-lg-7' : 'col-lg-12' }}">
                <div class="card-box h-100">
                    <h2 class="card-title">Penentuan Titik Koordinat (Klik pada Peta)</h2>
                    <p class="text-muted small mb-3">Silakan klik atau geser peta untuk menentukan titik koordinat lokasi yang tepat[cite: 9].</p>
                    
                    <div id="mapPreview"></div>
                    
                    <div class="coordinate-box d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Latitude: </strong> <span id="textLat">-1.610100</span>
                        </div>
                        <div>
                            <strong>Longitude: </strong> <span id="textLng">103.613100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Data Baru -->
        <div class="card-box mt-4">
            <h2 class="card-title">Data Titik Peta Terbaru</h2>
            <div class="table-responsive">
                <table class="table table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Kategori</th>
                            <th style="width: 35%;">Nama Titik</th>
                            <th style="width: 25%;">Koordinat</th>
                            
                            <!-- Header Aksi hanya muncul untuk Operator -->
                            @role('Operator')
                            <th style="width: 15%;" class="text-center">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Dummy Data (Nanti diganti Foreach) -->
                        <tr>
                            <td>
                                <span class="badge-kategori text-light" style="background-color: #dc3545;">
                                    <i class="fas fa-fire"></i> Kebakaran
                                </span>
                            </td>
                            <td>
                                <span class="title-text">Kebakaran Ruko Pasar</span>
                                <span class="location-text">Pasar Jambi</span>
                            </td>
                            <td class="font-monospace text-muted small">
                                Lat: -1.5931<br>Lng: 103.6210
                            </td>
                            
                            <!-- Tombol Aksi (Edit & Hapus) hanya untuk Operator -->
                            @role('Operator')
                            <td class="text-center">
                                <a href="#" class="action-btn btn-edit mx-1" title="Edit">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <button class="action-btn btn-delete" title="Hapus">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </td>
                            @endrole
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

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

    /* ---------- Leaflet Map Input Interaktif ---------- */
    var initialLat = -1.6101; 
    var initialLng = 103.6131;

    var map = L.map('mapPreview').setView([initialLat, initialLng], 12);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([initialLat, initialLng], {
        draggable: true
    }).addTo(map);

    var latInput = document.getElementById('latInput');
    var lngInput = document.getElementById('lngInput');
    var textLat = document.getElementById('textLat');
    var textLng = document.getElementById('textLng');

    if (latInput && lngInput) {
        latInput.value = initialLat;
        lngInput.value = initialLng;
    }

    function updateCoordinate(lat, lng) {
        if (latInput) latInput.value = lat.toFixed(6);
        if (lngInput) lngInput.value = lng.toFixed(6);
        if (textLat) textLat.textContent = lat.toFixed(6);
        if (textLng) textLng.textContent = lng.toFixed(6);
    }

    marker.on('dragend', function (e) {
        var position = marker.getLatLng();
        updateCoordinate(position.lat, position.lng);
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateCoordinate(e.latlng.lat, e.latlng.lng);
    });

})();
</script>
</body>
</html>