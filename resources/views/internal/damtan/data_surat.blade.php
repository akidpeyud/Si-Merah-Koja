<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Surat Korban | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    
    <!-- PRELOAD LOGO AGAR TIDAK TELAT LOADING SAAT DI-PRINT -->
    <link rel="preload" href="/images/logo.png" as="image">
    <link rel="preload" href="/images/jambi.png" as="image">

    <!-- Fonts (Sesuai UI/UX Dashboard Utama) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & RESET
           ========================================================== */
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;
            --paper: #f3f5f8;
            --white: #ffffff;
            --signal: #e5392d;
            --signal-d: #c22b20;
            --amber: #ffb627;
            --green: #16a34a;
            --teal: #0d9488;
            --blue: #2563eb;
            --purple: #9333ea;
            --steel: #5b6c7f;
            --line: #dbe2ea;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 22px;
            --r-md: 16px;
            --r-sm: 10px;
            --sidebar-w: 272px;
            --topbar-h: 66px;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ink);
            background: var(--paper);
            -webkit-font-smoothing: antialiased;
            margin: 0; padding: 0;
        }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; padding: 0; margin: 0; }
        button { font: inherit; cursor: pointer; }
        
        /* ==========================================================
           GLOBAL ALERTS
           ========================================================== */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar {
            position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 0 20px 0 clamp(16px, 2vw, 24px); background: rgba(255,255,255,.85);
            -webkit-backdrop-filter: blur(14px); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; background: none; border: 0; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.05rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 14px 6px 6px; border-radius: 999px; background: var(--paper); }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .85rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .user-meta small { font-size: .72rem; color: var(--steel); text-transform: capitalize; }
        .btn-logout { background: none; border: 0; display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; font-size: .85rem; transition: background .2s; text-decoration: none;}
        .btn-logout:hover { background: var(--signal-d); color: #fff; }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        
        /* ==========================================================
           SHELL & SIDEBAR
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar {
            width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
            height: calc(100vh - var(--topbar-h)); overflow-y: auto;
            background: #fff; border-right: 1px solid var(--line);
            padding: 20px 14px 32px;
        }
        .side-link {
            display: flex; align-items: center; gap: 13px; padding: 12px 14px; border-radius: 13px;
            font-size: .87rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s;
        }
        .side-link:hover { background: var(--paper); color: var(--ink); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 18px; text-align: center; font-size: .95rem; color: var(--steel); }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary {
            list-style: none; cursor: pointer; display: flex; align-items: center; gap: 10px;
            padding: 12px 14px; border-radius: 13px; font-size: .78rem; font-weight: 800;
            letter-spacing: .04em; text-transform: uppercase; color: var(--steel); transition: background .2s, color .2s;
        }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); color: var(--ink); }
        .side-group[open] > summary { color: var(--blue); } 
        .side-group summary .chev { margin-left: auto; font-size: .68rem; transition: transform .2s; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 2px; padding: 4px 2px 8px 10px; border-left: 2px solid var(--line); margin: 2px 0 4px 22px; }
        .side-sub a { display: flex; align-items: flex-start; gap: 11px; padding: 9px 12px; border-radius: 11px; font-size: .82rem; font-weight: 600; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s; }
        .side-sub a:hover { background: var(--paper); color: var(--ink); }
        .side-sub a.active { background: #eff6ff; color: var(--blue); }
        .side-sub a i { width: 16px; text-align: center; font-size: .85rem; margin-top: 2px; color: inherit; opacity: .75; }
        .side-kicker { padding: 14px 12px 4px; font-size: .68rem; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; color: #a9b6c4; }

        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; z-index: 1010; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s ease; box-shadow: 24px 0 48px -24px rgba(13,27,42,.4);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           MAIN CONTENT & TABLE STYLING
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(20px, 3vw, 40px) clamp(18px, 3vw, 44px) 60px; }
        
        .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 15px; }
        .page-header h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.15; letter-spacing: -0.02em; color: var(--ink); margin-bottom: 6px;}
        .page-header p { color: var(--steel); font-size: .95rem; margin: 0; }

        .card-custom {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(13,27,42,.05);
        }

        /* Form Filter Styles */
        .form-control, .form-select {
            font-family: var(--font-body);
            font-size: .95rem;
            color: var(--ink);
            background-color: var(--paper);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 10px 16px;
            transition: all 0.2s ease-in-out;
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .input-group-text { background-color: var(--paper); border: 1px solid var(--line); color: var(--steel); }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }

        /* Buttons */
        .btn-custom-primary {
            background-color: var(--blue); color: #fff; font-family: var(--font-body); font-weight: 700;
            border: none; padding: 10px 24px; border-radius: 10px; transition: background 0.2s; text-decoration: none;
        }
        .btn-custom-primary:hover { background-color: #1d4ed8; color: #fff; }
        
        .btn-custom-light {
            background-color: var(--paper); color: var(--ink); font-family: var(--font-body); font-weight: 700;
            border: 1px solid var(--line); padding: 10px 24px; border-radius: 10px; transition: background 0.2s;
        }
        .btn-custom-light:hover { background-color: #e2e8f0; color: var(--ink); }

        /* Table Custom Styles */
        .table { margin-bottom: 0; }
        .table th { background-color: rgba(243, 245, 248, 0.6); color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); }
        .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
        .table tbody tr:hover { background-color: rgba(243, 245, 248, 0.3); }
        .action-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none;}
        .action-btn.view { background-color: #eff6ff; color: var(--blue); }
        .action-btn.view:hover { background-color: #dbeafe; }
        .action-btn.edit { background-color: #fefce8; color: var(--amber); margin: 0 5px; }
        .action-btn.edit:hover { background-color: #fef08a; }
        .action-btn.delete { background-color: #fef2f2; color: var(--signal); }
        .action-btn.delete:hover { background-color: #fecaca; }

        /* Pagination */
        .pagination-container nav ul.pagination { margin-bottom: 0 !important; }
        .pagination-container nav p { display: none; }

        /* --- STYLES KHUSUS UNTUK CETAK PDF --- */
        @page { margin: 0; }
        @media print {
            .topbar, .sidebar, .sidebar-backdrop, .page-header, .card-header, .card-footer,
            .btn, .dropdown, form, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert {
                display: none !important;
            }

            body { background-color: white !important; font-size: 12px; margin: 1.5cm !important; -webkit-print-color-adjust: exact; }
            .shell { display: block; }
            .content { padding: 0 !important; margin: 0 !important; }
            .card-custom { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
            .card-body { padding: 0 !important; }

            /* Format tabel cetak */
            .table { width: 100% !important; border-collapse: collapse; margin-bottom: 20px; }
            .table th, .table td { border: 1px solid black !important; padding: 8px !important; text-align: left; }
            .table th { background-color: #f2f2f2 !important; font-weight: bold; color: black !important; text-align: left !important; }
            th:last-child, td:last-child { display: none !important; }
        }
    </style>
</head>
<body>

<!-- ALERT SUCCESS GLOBAL -->
@if(session('success'))
    <div id="globalSuccessAlert">
        <i class="fas fa-check-circle alert-icon"></i>
        <span>{{ session('success') }}</span>
        <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
    </div>
@endif

<!-- ALERT ERROR GLOBAL -->
@if(session('error'))
    <div id="globalErrorAlert">
        <i class="fas fa-exclamation-triangle alert-icon"></i>
        <span>{{ session('error') }}</span>
        <button class="btn-close-alert" onclick="closeAlert('globalErrorAlert')"><i class="fas fa-times"></i></button>
    </div>
@endif

<script>
    function closeAlert(id) {
        let alertBox = document.getElementById(id);
        if(alertBox) {
            alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
            setTimeout(() => alertBox.remove(), 400); 
        }
    }
    setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
    setTimeout(() => closeAlert('globalErrorAlert'), 4000);
</script>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu" aria-expanded="false">
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

    <!-- ==================== SIDEBAR TERINTEGRASI ==================== -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">
        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Modul operasional</div>

            <details class="side-group" {{ Request::is('internal/pencegahan*') ? 'open' : '' }}>
                <summary>Bagian pencegahan <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="{{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}">
                        <i class="fas fa-level-up-alt"></i> Peningkatan kapasitas aparatur
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="{{ Request::is('internal/pencegahan/inspeksi-kebakaran*') ? 'active' : '' }}">
                        <i class="fas fa-magnifying-glass"></i> Pencegahan kebakaran & inspeksi
                    </a>
                    <a href="#">
                        <i class="fas fa-people-group"></i> Pemberdayaan masyarakat
                    </a>
                </div>
            </details>

 <!-- ACCORDION PEMADAMAN (DAMTAN) -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
                <summary>Bagian pemadaman <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/damtan/input-data" class="{{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}">
                        <i class="fas fa-fire-extinguisher"></i> Input data
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
                </div>
            </details>

            <details class="side-group" {{ Request::is('sapra*') ? 'open' : '' }}>
                <summary>Bagian sapra <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako" class="{{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam</a>
                    <a href="/sapra/prasarana-mako" class="{{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Pemadam</a>
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan</a> 
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola data pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber air</a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Hidrant Kota Jambi</a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                </div>
            </details>
        @endif

        @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Konten publik</div>
            <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                <summary>Manajemen berita <i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input &amp; kelola berita</a>
                    <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola info grafis</a>
                    <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola berita medsos</a>
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') ? 'open' : '' }}>
            <summary>Pengaturan akun <i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola semua pengguna</a>
                @endif
            </div>
        </details>
    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">
        <div class="page-header">
            <div>
                <h1>Kelola Surat Korban</h1>
                <p>Daftar seluruh Surat Keterangan Kejadian yang telah diterbitkan.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn-custom-light shadow-sm" type="button" onclick="window.print()">
                    <i class="fas fa-download me-2"></i> Ekspor Semua
                </button>
                <a href="/internal/surat-korban/create" class="btn-custom-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Buat Surat Baru
                </a>
            </div>
        </div>

        <div class="card-custom">
            <!-- Filter & Search Bar -->
            <div class="card-header bg-white p-4 border-bottom border-light">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nomor surat, nama korban...">
                        </div>
                    </div>
                    <div class="col-md-4 text-end ms-auto">
                        <button class="btn-custom-light w-100 py-2 border-light fw-bold" onclick="resetFilter()"><i class="fas fa-sync-alt me-2"></i>Reset Filter</button>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    
                    <!-- HEADER KHUSUS CETAK PDF MENGGUNAKAN FLEXBOX ANTI-ERROR BOOTSTRAP -->
                    <div id="print-header" class="d-none d-print-block" style="width: 100%; margin-bottom: 20px;">
                        <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; width: 100% !important; margin-bottom: 15px;">
                            
                            <!-- Logo Kiri -->
                            <div style="width: 15% !important; text-align: left !important;">
                                <img src="/images/jambi.png" style="width: 80px; height: auto;">
                            </div>
                            
                            <!-- Teks Tengah Dipaksa Center -->
                            <div style="width: 70% !important; text-align: center !important;">
                                <div style="font-size: 14pt; color: #000; margin-bottom: 2px; font-family: 'Times New Roman', Times, serif;">PEMERINTAH KOTA JAMBI</div>
                                <div style="font-size: 16pt; font-weight: bold; color: #000; line-height: 1.1; margin-bottom: 5px; font-family: 'Times New Roman', Times, serif;">DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</div>
                                <div style="font-size: 10pt; color: #000; font-family: 'Times New Roman', Times, serif;">Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</div>
                            </div>
                            
                            <!-- Logo Kanan -->
                            <div style="width: 15% !important; text-align: right !important;">
                                <img src="/images/logo.png" style="width: 100px; height: auto;">
                            </div>
                        </div>
                        
                        <!-- Garis Ganda -->
                        <div style="border-top: 3px solid black !important; border-bottom: 1px solid black !important; height: 2px !important; width: 100% !important; margin-bottom: 15px !important;"></div>
                        
                        <h3 style="text-align: center !important; font-weight: bold; margin-bottom: 5px; font-size: 16px; color: black; font-family: 'Times New Roman', Times, serif;">REKAPITULASI SURAT KETERANGAN KEJADIAN</h3>
                        <p style="text-align: center !important; font-size: 12px; margin-bottom: 15px; color: black; font-family: 'Times New Roman', Times, serif;">Dicetak pada: {{ date('d F Y') }}</p>
                    </div>
                    <!-- AKHIR HEADER CETAK -->

                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="25%">Nomor Surat</th>
                                <th width="35%">Nama Korban / Instansi</th>
                                <th width="20%">Tanggal Diterbitkan</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($surat as $index => $row)
                            <tr>
                                <td class="text-center text-muted">{{ $surat->firstItem() + $index }}</td>
                                <td><strong>{{ $row->nomor_surat }}</strong></td>
                                <td class="text-capitalize">{{ $row->nama_korban }}</td>
                                <td>
                                    <div class="text-dark fw-bold">
                                        {{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <!-- Tombol Cetak PDF -->
                                    <a href="/internal/surat-korban/cetak/{{ $row->id }}" class="action-btn view" target="_blank" title="Cetak Surat"><i class="fas fa-print"></i></a>
                                    <!-- Tombol Edit -->
                                    <a href="/internal/surat-korban/edit/{{ $row->id }}" class="action-btn edit" title="Edit Surat"><i class="fas fa-edit"></i></a>
                                    <!-- Tombol Hapus -->
                                    <form action="/internal/surat-korban/delete/{{ $row->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat nomor {{ $row->nomor_surat }} secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-envelope-open-text mb-3" style="font-size: 24px;"></i><br>
                                    Belum ada surat keterangan korban yang diterbitkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white p-4 d-flex justify-content-between align-items-center border-top">
                <span class="text-muted" style="font-size: 13px;" id="dataCount">
                    Menampilkan {{ $surat->firstItem() ?? 0 }} - {{ $surat->lastItem() ?? 0 }} dari total {{ $surat->total() }} surat
                </span>
                <div class="pagination-container mb-0">
                    {{ $surat->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script Bootstrap & Fungsi Search/Filter JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
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
    })();

    /* ---------- FUNGSI SEARCH FRONTEND ---------- */
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) {
                // Abaikan baris "Belum ada data"
                if (rows[i].getElementsByTagName('td').length === 1) continue; 
                
                const rowText = rows[i].textContent.toLowerCase();
                const matchesSearch = rowText.includes(searchTerm);

                rows[i].style.display = matchesSearch ? '' : 'none';
            }
        }

        searchInput.addEventListener('keyup', filterTable);
    });

    function resetFilter() {
        document.getElementById('searchInput').value = "";
        document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
    }
</script>
</body>
</html>