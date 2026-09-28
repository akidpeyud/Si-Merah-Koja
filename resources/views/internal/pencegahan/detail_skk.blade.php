<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Detail {{ $jenis_layanan }} | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;
            --paper: #f7f9fc;
            --white: #ffffff;

            --navy: #1e3a5f;
            --navy-d: #14283f;
            --navy-tint: rgba(30, 58, 95, .09);

            --signal: #e5392d;
            --signal-d: #c22b20;
            --signal-tint: rgba(229, 57, 45, .09);

            --amber: #ffb627;
            --success: #10b981;
            --info: #2f6fed;
            --info-tint: rgba(47, 111, 237, .09);
            --ink-tint: rgba(13, 27, 42, .055);

            --steel: #64748b;
            --steel-soft: #94a3b8;
            --line: #e6eaf1;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 20px;
            --r-md: 14px;
            --r-sm: 10px;

            --sidebar-w: 272px;
            --topbar-h: 72px;

            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
            --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
            --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
            --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
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
           TOPBAR
           ========================================================== */
        .topbar {
            position: sticky; top: 0; z-index: 60; height: var(--topbar-h);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 0 28px; background: rgba(255,255,255,.86);
            -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; transition: background .2s; }
        .side-toggle:hover { background: var(--paper); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 16px 6px 6px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--ink); }
        .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; font-weight: 500; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; transition: background .2s, transform .1s; border: none; }
        .btn-logout:hover { background: var(--navy-d); }
        .btn-logout:active { transform: scale(.98); }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        /* ==========================================================
           SHELL: SIDEBAR + KONTEN
           ========================================================== */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

        .sidebar {
            width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
            height: calc(100vh - var(--topbar-h)); overflow-y: auto;
            background: #fff; border-right: 1px solid var(--line);
            padding: 20px 14px 32px;
            scrollbar-width: thin;
            scrollbar-color: var(--line) transparent;
        }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: var(--line); border-radius: 20px; }

        .side-link {
            display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm);
            font-size: .9rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s;
            margin-bottom: 4px;
        }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary {
            list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: var(--r-sm); font-size: .8rem; font-weight: 700;
            letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s;
            user-select: none;
        }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: var(--paper); }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a {
            display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm);
            font-size: .85rem; font-weight: 500; line-height: 1.4; color: var(--steel);
            transition: background .2s, color .2s, transform .2s;
        }
        .side-sub a:hover { background: var(--paper); color: var(--ink); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .9rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }

        .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel-soft); }

        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; z-index: 90; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           KONTEN UTAMA & DETAIL CARD STYLES
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
        .page-header h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-header p { color: var(--steel); font-size: .98rem; }

        .detail-card { 
            background: #fff; border-radius: var(--r-lg); border: 1px solid var(--line); 
            padding: clamp(24px, 4vw, 36px); box-shadow: var(--shadow-sm); width: 100%; margin-bottom: 20px; 
        }
        .detail-section-title { 
            font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--navy); 
            border-bottom: 2px solid var(--navy-tint); padding-bottom: 8px; margin-bottom: 20px; margin-top: 32px; 
        }
        .detail-section-title:first-child { margin-top: 0; }
        
        .detail-label { font-size: 0.78rem; font-weight: 700; color: var(--steel); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .detail-value { font-size: 0.98rem; font-weight: 600; color: var(--ink); margin-bottom: 20px; }
        
        .badge-status { padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 700; display: inline-block; }
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-diproses { background-color: #dbeafe; color: #2563eb; }
        .status-memenuhi { background-color: #d1fae5; color: #059669; }
        .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }
        
        .btn-download-doc { 
            background-color: var(--paper); border: 1px solid var(--line); padding: 12px 16px; 
            border-radius: var(--r-sm); display: inline-flex; align-items: center; gap: 12px; 
            color: var(--ink); text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: background .2s, border-color .2s; 
        }
        .btn-download-doc:hover { background-color: var(--line); border-color: var(--steel-soft); color: var(--ink); }
        .btn-download-doc i { color: var(--signal); font-size: 1.25rem; }

        /* --- CSS PRINT RULES --- */
        @media print {
            .topbar, .sidebar, .btn-logout, .no-print { display: none !important; }
            .shell { display: block; width: 100%; }
            .content { padding: 0 !important; margin: 0 !important; background-color: white; width: 100%; }
            .detail-card { border: none !important; box-shadow: none !important; padding: 0 !important; width: 100%; }
            body { background-color: white; margin: 0; padding: 0; color: black; }
            .d-print-block { display: block !important; }
            .row { display: flex !important; flex-wrap: wrap !important; }
            .col-md-6 { width: 50% !important; flex: 0 0 auto !important; }
            .col-md-3 { width: 25% !important; flex: 0 0 auto !important; }
            .col-md-12 { width: 100% !important; flex: 0 0 auto !important; }
            .detail-section-title { color: black !important; border-bottom: 2px solid #000 !important; margin-top: 20px; }
            .detail-label { color: #444 !important; font-size: 11px !important; }
            .detail-value { color: black !important; font-size: 14px !important; margin-bottom: 15px !important; }
            .detail-section-title i { display: none !important; }
            .badge-status { border: 1px solid #000; background: transparent !important; color: black !important; padding: 4px 8px; border-radius: 4px; }
        }
    </style>
</head>
<body>

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
                        <i class="fas fa-fire-extinguisher"></i> Input Data
                    </a>
                    <a href="/internal/damtan/data-laporan" class="{{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Data Laporan
                    </a>
                    <a href="/internal/surat-korban/create" class="{{ Request::is('internal/surat-korban*') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Buat Surat Korban
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
                        <i class="fas fa-people-carry-box"></i> Distribusi Barang Staff
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

        <div class="side-kicker">Akun</div>
        <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
            <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
            <div class="side-sub">
                <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Profil Saya
                </a>
                @if(Auth::user()->role === 'super_user')
                    <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}">
                        <i class="fas fa-users-gear"></i> Kelola Semua Pengguna
                    </a>
                    <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i> Kelola Akun Pemohon
                    </a>
                @endif
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">
        <div class="page-header no-print">
            <div>
                <h1>Detail {{ $jenis_layanan }}</h1>
                <p>Menampilkan rincian data permohonan dari <strong>{{ $permohonan->nama_pemohon }}</strong></p>
            </div>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-primary fw-bold shadow-sm no-print" style="border-radius: 999px; padding: 10px 20px;">
                    <i class="fas fa-print me-2"></i> Cetak Form
                </button>
                <a href="/internal/pencegahan/kelola-skk" class="btn btn-outline-secondary fw-bold shadow-sm no-print" style="border-radius: 999px; padding: 10px 20px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- HEADER KHUSUS PRINT -->
        <div class="d-none d-print-block text-center mb-4 pb-3" style="border-bottom: 3px solid #000;">
            <h3 class="fw-bold mb-1" style="font-size: 22px; text-transform: uppercase;">Data Permohonan {{ $jenis_layanan }}</h3>
            <p class="mb-0" style="font-size: 14px;">Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
        </div>

        <div class="detail-card">
            
            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-user-circle text-primary me-2"></i>Informasi Pemohon</h3>
                    
                    <div class="detail-label">Nama Pemohon</div>
                    <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>

                    <div class="detail-label">Alamat Email</div>
                    <div class="detail-value">{{ $permohonan->email_pemohon }}</div>

                    <div class="detail-label">Nomor WhatsApp</div>
                    <div class="detail-value">
                        {{ $permohonan->no_whatsapp }}
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $permohonan->no_whatsapp) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none no-print">Hubungi <i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-store text-warning me-2"></i>Informasi Usaha</h3>

                    <div class="detail-label">Nama Usaha / Instansi</div>
                    <div class="detail-value">{{ $permohonan->nama_usaha }}</div>

                    <div class="detail-label">NIK Pemilik Usaha</div>
                    <div class="detail-value">{{ $permohonan->nik_pemilik_usaha }}</div>

                    <div class="detail-label">Alamat Pemilik Usaha</div>
                    <div class="detail-value">{{ $permohonan->alamat_pemilik_usaha }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="detail-section-title"><i class="fas fa-building text-success me-2"></i>Rincian Bangunan</h3>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Kategori Bangunan</div>
                    <div class="detail-value">{{ $permohonan->kategori_bangunan }}</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Lahan (m²)</div>
                    <div class="detail-value">{{ $permohonan->luas_lahan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Bangunan (m²)</div>
                    <div class="detail-value">{{ $permohonan->luas_bangunan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Tinggi Bangunan (m)</div>
                    <div class="detail-value">{{ $permohonan->tinggi_bangunan }} m</div>
                </div>
                <div class="col-md-12">
                    <div class="detail-label">Alamat Lengkap Bangunan</div>
                    <div class="detail-value">
                        {{ $permohonan->alamat_bangunan }}<br>
                        Kecamatan {{ $permohonan->kecamatan }}, Kelurahan {{ $permohonan->kelurahan }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-info-circle text-danger me-2"></i>Status Permohonan</h3>
                    <div class="detail-label">Status Saat Ini</div>
                    <div class="detail-value">
                        @if($permohonan->status_permohonan == 'Pending')
                            <span class="badge-status status-pending">Pending</span>
                        @elseif($permohonan->status_permohonan == 'Diproses')
                            <span class="badge-status status-diproses">Diproses Tim</span>
                        @elseif($permohonan->status_permohonan == 'Memenuhi Syarat')
                            <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                        @else
                            <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi Syarat</span>
                        @endif
                    </div>
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                <div class="col-md-6 no-print">
                    <h3 class="detail-section-title"><i class="fas fa-folder-open text-info me-2"></i>Berkas Lampiran</h3>
                    <div class="d-flex flex-column gap-2">
                        @if($permohonan->file_surat_permohonan && $permohonan->file_surat_permohonan !== 'offline_registered')
                            <a href="{{ asset('storage/' . $permohonan->file_surat_permohonan) }}" target="_blank" class="btn-download-doc">
                                <i class="fas fa-file-pdf"></i>
                                <div>
                                    <div style="line-height: 1;">Lihat Surat Permohonan</div>
                                    <small class="text-muted fw-normal" style="font-size: 11px;">Berkas Wajib</small>
                                </div>
                            </a>
                        @endif

                        @if($permohonan->file_persyaratan_lainnya)
                            <a href="{{ asset('storage/' . $permohonan->file_persyaratan_lainnya) }}" target="_blank" class="btn-download-doc">
                                <i class="fas fa-file-archive" style="color: #8b5cf6;"></i>
                                <div>
                                    <div style="line-height: 1;">Lihat Persyaratan Lainnya</div>
                                    <small class="text-muted fw-normal" style="font-size: 11px;">Lampiran Opsional</small>
                                </div>
                            </a>
                        @else
                            <div class="text-muted" style="font-size: 13px; font-weight: 500;">
                                <i class="fas fa-minus-circle me-1"></i> Tidak ada berkas lampiran tambahan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<!-- Script Bootstrap & Auto Print -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
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

        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('auto_print')) {
                setTimeout(function() { window.print(); }, 500);
            }
        }
    })();
</script>
</body>
</html>