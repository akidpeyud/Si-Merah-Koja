<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Kelola Redkar - Internal SIMERAH KOJA</title>
    
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 (Untuk Utilities Grid) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           DESIGN TOKENS & BASE
           ========================================================== */
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
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--ink);
            background: var(--paper);
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; color: inherit; }
        button { font: inherit; }

        /* ==========================================================
           TOPBAR & SIDEBAR
           ========================================================== */
        .topbar {
            position: sticky; top: 0; z-index: 60; height: var(--topbar-h);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 0 28px; background: rgba(255,255,255,.86);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; border: none; background: transparent; align-items: center; justify-content: center; font-size: 1.05rem; transition: 0.2s; }
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
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; border: none; transition: 0.2s; }
        .btn-logout:hover { background: var(--navy-d); }

        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }

        .sidebar {
            width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
            height: calc(100vh - var(--topbar-h)); overflow-y: auto;
            background: #fff; border-right: 1px solid var(--line);
            padding: 20px 14px 32px;
            scrollbar-width: thin; scrollbar-color: var(--line) transparent;
        }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background-color: var(--line); border-radius: 20px; }

        .side-link {
            display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm);
            font-size: .9rem; font-weight: 600; color: var(--ink); transition: 0.2s;
            margin-bottom: 4px; text-decoration: none;
        }
        .side-link:hover { background: var(--paper); }
        .side-link.active { background: var(--ink); color: #fff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: 0.2s; }
        .side-link:hover i { color: var(--ink); }
        .side-link.active i { color: var(--amber); }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary {
            list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: var(--r-sm); font-size: .8rem; font-weight: 700;
            letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: 0.2s;
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
            font-size: .85rem; font-weight: 500; color: var(--steel); text-decoration: none;
            transition: 0.2s;
        }
        .side-sub a:hover { background: var(--paper); color: var(--ink); transform: translateX(2px); }
        .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; font-size: .9rem; opacity: .75; }
        .side-sub a:hover i, .side-sub a.active i { opacity: 1; }

        .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel-soft); }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
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
           MAIN CONTENT & TABLES
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }

        .page-head { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 28px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .98rem; margin: 0; }
        
        .btn-print { background: var(--white); color: var(--ink); border: 1px solid var(--line); box-shadow: var(--shadow-xs); padding: 10px 20px; border-radius: var(--r-sm); font-size: .85rem; font-weight: 700; transition: 0.2s; }
        .btn-print:hover { background: var(--paper); border-color: #d7dee9; transform: translateY(-2px); box-shadow: var(--shadow-sm); }

        .content-card { background: var(--white); border-radius: var(--r-md); border: 1px solid var(--line); padding: 0; box-shadow: var(--shadow-xs); overflow: hidden; }

        /* Table Custom Override */
        .table-custom { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }
        .table-custom thead th { background-color: var(--paper); color: var(--steel); font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; padding: 16px 20px; border-bottom: 1px solid var(--line); }
        .table-custom tbody td { padding: 16px 20px; font-size: .9rem; vertical-align: middle; border-bottom: 1px solid var(--line); color: var(--ink); }
        .table-custom tbody tr:hover td { background-color: var(--paper); }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        
        /* Badges & Actions */
        .st-badge { padding: 6px 12px; border-radius: 999px; font-size: .75rem; font-weight: 700; letter-spacing: 0.02em; text-transform: uppercase; display: inline-block; white-space: nowrap; }
        .badge-file { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; font-size: .75rem; font-weight: 600; border-radius: 6px; background: var(--paper); border: 1px solid var(--line); color: var(--steel); transition: 0.2s; text-decoration: none; }
        .badge-file:hover { background: var(--ink); color: #fff; border-color: var(--ink); }

        .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
        .btn-act { display: inline-flex; align-items: center; justify-content: center; width: 100%; padding: 8px 12px; border-radius: 6px; font-weight: 600; font-size: .8rem; border: none; text-decoration: none; transition: 0.2s; cursor: pointer; color: var(--white); }
        .btn-act:hover { opacity: 0.9; transform: translateY(-1px); color: var(--white); }
        .act-cetak { background-color: var(--signal); }
        
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 40px; color: var(--line); margin-bottom: 15px; display: block; }
        .empty-state span { color: var(--steel); font-weight: 500; font-size: .95rem; }

        /* Print Media Query */
        @media print {
            .topbar, .sidebar, .btn-print, .no-print-col { display: none !important; }
            .shell { display: block; }
            .content { padding: 0 !important; margin: 0 !important; background: white; }
            .content-card { border: none; box-shadow: none; padding: 0; }
            body { background: white; }
            .page-head { text-align: center; justify-content: center; margin-bottom: 20px; }
            .page-head p { display: none; }
            .table-custom th, .table-custom td { border: 1px solid #000 !important; padding: 8px !important; color: #000 !important; }
            .table-custom thead th { background: transparent !important; }
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

        <!-- BAGIAN PENCEGAHAN (Diseragamkan dengan Master Index) -->
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
                    <i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi
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
        <!-- ==================== MAIN CONTENT ==================== -->
        <main class="content">
            <div class="page-head">
                <div>
                    <h1>Daftar Calon Relawan (REDKAR)</h1>
                    <p>Data masyarakat yang mendaftar melalui formulir publik website.</p>
                </div>
                <div>
                    <button onclick="window.print()" class="btn-print"><i class="fas fa-print me-2"></i>Cetak Rekap</button>
                </div>
            </div>

            <div class="content-card">
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Tanggal Daftar</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Kecamatan</th>
                                <th>No. Telp (WA)</th>
                                <th class="no-print-col text-center">KTP</th>
                                <th class="text-center no-print-col" width="160px">Aksi Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($relawan as $r)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $r->created_at->format('d M Y') }}</div>
                                    <div style="font-size: .8rem; color: var(--steel);">{{ $r->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <span style="font-weight: 700; font-family: var(--font-display); font-size: .95rem;">{{ $r->nik }}</span>
                                </td>
                                <td style="font-weight: 600;">{{ $r->nama_lengkap }}</td>
                                <td>{{ $r->kecamatan }}</td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->nomor_telp) }}" target="_blank" style="color: var(--success); font-weight: 600; text-decoration: none;">
                                        <i class="fab fa-whatsapp me-1"></i> {{ $r->nomor_telp }}
                                    </a>
                                </td>
                                <td class="no-print-col text-center">
                                    @if($r->ktp)
                                        <a href="/storage/{{ $r->ktp }}" target="_blank" class="badge-file"><i class="fas fa-id-card" style="color: var(--info)"></i> Lihat KTP</a>
                                    @else
                                        <span class="st-badge" style="background: var(--line); color: var(--steel);">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="no-print-col text-center">
                                    <div class="btn-action-group">
                                        <a href="/internal/pencegahan/cetak-redkar/{{ $r->id }}" target="_blank" class="btn-act act-cetak">
                                            <i class="fas fa-print me-1"></i> Cetak Biodata
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-users-slash"></i>
                                    <span>Belum ada data relawan yang mendaftar.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- SCRIPT (Sidebar Mobile & Accordion Logic) -->
    <script>
        (function () {
            'use strict';

            /* ---------- Sidebar (Mobile) ---------- */
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

            /* ---------- Accordion Native (<details>) Logic ---------- */
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