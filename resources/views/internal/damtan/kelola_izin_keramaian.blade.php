<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Izin Keramaian | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    
    <!-- PRELOAD LOGO -->
    <link rel="preload" href="/images/logo.png" as="image">
    <link rel="preload" href="/images/jambi.png" as="image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }
        
        /* GLOBAL ALERTS */
        #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* TOPBAR */
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

        /* SIDEBAR */
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

        /* MAIN CONTENT & TABLE STYLING */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        
        .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
        .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
        .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0;}

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            box-shadow: var(--shadow-xs);
            overflow: hidden;
        }

        /* Form Filter Styles */
        .form-control, .form-select {
            font-family: var(--font-body);
            min-height: 42px;
            font-size: .9rem;
            color: var(--ink);
            background-color: var(--white);
            border: 1px solid var(--line-dark);
            border-radius: 8px;
            padding: 8px 14px;
            transition: all 0.2s ease;
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px var(--navy-soft);
        }
        .form-control::placeholder { color: var(--steel-soft); }

        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid var(--line-dark);
            color: var(--steel);
            font-weight: 600;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }

        /* Buttons */
        .btn-custom-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            min-height: 44px; padding: 0 24px;
            background: var(--navy); color: #fff;
            border: none; border-radius: 8px;
            font-size: .92rem; font-weight: 600;
            transition: all .2s ease; text-decoration: none;
        }
        .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff;}
        
        .btn-custom-light {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            min-height: 44px; padding: 0 24px;
            background: var(--white); color: var(--ink);
            border: 1px solid var(--line-dark); border-radius: 8px;
            font-size: .92rem; font-weight: 600;
            transition: all .2s ease;
        }
        .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }

        /* Table Custom Styles */
        .table { margin-bottom: 0; }
        .table th { background-color: #f8fafc; color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); letter-spacing: 0.02em;}
        .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
        .table tbody tr:hover { background-color: var(--paper); }
        
        /* Action Buttons */
        .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
        .action-btn.view { background-color: var(--info-tint); color: var(--info); }
        .action-btn.view:hover { background-color: #dbeafe; }
        .action-btn.delete { background-color: var(--signal-tint); color: var(--signal); margin-left: 5px;}
        .action-btn.delete:hover { background-color: #fecaca; }

        .badge-status { padding: 6px 12px; font-weight: 600; font-size: 0.8rem; border-radius: 6px; }
        .badge-pending { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .badge-proses { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    </style>
</head>
<body>

@if(session('success'))
    <div id="globalSuccessAlert">
        <i class="fas fa-check-circle alert-icon"></i>
        <span>{{ session('success') }}</span>
        <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
    </div>
@endif

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

<!-- TOPBAR -->
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
                <strong>{{ Auth::user()->nama_lengkap ?? 'Admin Damkar' }}</strong>
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

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar" aria-label="Navigasi internal">
        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i> Dashboard utama
        </a>

        @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
            <div class="side-kicker">Modul operasional</div>

            <!-- BAGIAN PENCEGAHAN -->
            <details class="side-group">
                <summary><i class="fas fa-shield-halved grp-ico"></i><span class="grp-label">Bagian pencegahan</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/pencegahan/peningkatan-kapasitas"><i class="fas fa-arrow-trend-up"></i> Peningkatan Kapasitas</a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran"><i class="fas fa-magnifying-glass-chart"></i> Pencegahan & Inspeksi</a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat"><i class="fas fa-handshake-angle"></i> Pemberdayaan Masyarakat</a>
                    <a href="/internal/pencegahan/kelola-edukasi"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                    <a href="/internal/pencegahan/kelola-redkar"><i class="fas fa-users-rectangle"></i> Kelola Redkar</a>
                    <a href="/internal/pencegahan/kelola-rpkbgl"><i class="fas fa-building-circle-check"></i> Kelola RPKBGL</a>
                    <a href="/internal/pencegahan/kelola-skk"><i class="fas fa-file-shield"></i> Kelola SKK</a>
                </div>
            </details>

            <!-- BAGIAN PEMADAMAN -->
            <details class="side-group" {{ Request::is('internal/damtan*') || Request::is('internal/surat-korban*') ? 'open' : '' }}>
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
                        <i class="fas fa-users-rectangle"></i> Kelola Surat Keramaian
                    </a>
                </div>
            </details>

            <!-- BAGIAN KEPEGAWAIAN -->
            <details class="side-group">
                <summary><i class="fas fa-user-tie grp-ico"></i><span class="grp-label">Kepegawaian</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/kepegawaian/duk"><i class="fas fa-user-tie"></i> Data Urut Kepegawaian</a>
                </div>
            </details>

            <!-- BAGIAN SAPRA -->
            <details class="side-group">
                <summary><i class="fas fa-warehouse grp-ico"></i><span class="grp-label">Bagian sapra</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <span class="side-kicker" style="padding-left:2px;">Sarana &amp; Prasarana</span>
                    <a href="/sapra/sarana-mako"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam</a>
                    <a href="/sapra/prasarana-mako"><i class="fas fa-building"></i> Prasarana Pemadam</a>
                    <a href="/sapra/sarana-penyelamatan"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                    <a href="/sapra/sarana-pemeriksaan"><i class="fas fa-search-location"></i> Pemeriksaan Proteksi</a> 
                    <a href="/sapra/kelola-pos"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung"><i class="fas fa-droplet"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota"><i class="fas fa-map-location-dot"></i> Data Hidrant Kota</a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras"><i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan</a>
                    <a href="/sapra/distribusi-staff"><i class="fas fa-people-carry-box"></i> Distribusi Barang Staff</a>
                </div>
            </details>
        @endif

        <div class="side-kicker">Akun</div>
        <details class="side-group">
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil"><i class="fas fa-user-pen"></i> Profil Saya</a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user"><i class="fas fa-users-gear"></i> Kelola Pengguna</a>
                    <a href="/internal/kelola-pemohon"><i class="fas fa-address-book"></i> Kelola Akun Pemohon</a>
                @endif
            </div>
        </details>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="content">
        <div class="page-header">
            <div class="page-header-text">
                <h1>Kelola Izin Keramaian</h1>
                <p>Daftar seluruh pengajuan rekomendasi izin keramaian masyarakat.</p>
            </div>
            <div class="d-flex gap-2">
                <!-- Tombol aksi jika ada -->
            </div>
        </div>

        <div class="card-custom">
            <!-- Filter & Search Bar -->
            <div class="card-header bg-white p-4 border-bottom border-light">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nama pemohon, acara, lokasi...">
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
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="20%">Nama Pemohon</th>
                                <th width="15%">Kontak</th>
                                <th width="25%">Nama Acara</th>
                                <th width="15%">Tgl Acara</th>
                                <th width="10%">Status</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($permohonan as $index => $row)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td><strong>{{ $row->nama }}</strong></td>
                                <td>{{ $row->no_hp }}</td>
                                <td class="text-capitalize">{{ $row->nama_acara }}<br><small class="text-muted">{{ $row->lokasi_acara }}</small></td>
                                <td>
                                    <div class="text-dark fw-bold">
                                        {{ \Carbon\Carbon::parse($row->tgl_pelaksanaan)->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    @if($row->status_permohonan == 'Pending')
                                        <span class="badge-status badge-pending">{{ $row->status_permohonan }}</span>
                                    @elseif($row->status_permohonan == 'Proses')
                                        <span class="badge-status badge-proses">{{ $row->status_permohonan }}</span>
                                    @elseif($row->status_permohonan == 'Disetujui')
                                        <span class="badge-status badge-disetujui">{{ $row->status_permohonan }}</span>
                                    @elseif($row->status_permohonan == 'Ditolak')
                                        <span class="badge-status badge-ditolak">{{ $row->status_permohonan }}</span>
                                    @else
                                        <span class="badge-status" style="background:#e2e8f0; color:#475569; border:1px solid #cbd5e1;">{{ $row->status_permohonan }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                <!-- Tombol Detail -->
                                    <a href="{{ route('internal.izin-keramaian.show', $row->id) }}" class="action-btn view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
    
                                <!-- Tombol Edit (BARU DI SINI) -->
                                    <a href="{{ route('internal.izin-keramaian.edit', $row->id) }}" class="action-btn edit" title="Edit Data"><i class="fas fa-edit"></i></a>
    
                                 <!-- Tombol Hapus -->
                                    <form action="{{ route('internal.izin-keramaian.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash mb-3" style="font-size: 24px;"></i><br>
                                    Belum ada data pengajuan Izin Keramaian.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </main>
</div>

<!-- Script Bootstrap & Fungsi Search -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
        /* Sidebar Toggle */
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

        /* Accordion Sidebar */
        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });
    })();

    /* Search Script */
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            for (let i = 0; i < rows.length; i++) {
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