<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Edit Surat Korban | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

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
           DESIGN TOKENS (Konsisten dengan UI Utama)
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
           GLOBAL ALERTS
           ========================================================== */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
        
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
           SHELL & SIDEBAR
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
                position: fixed; z-index: 1010; top: var(--topbar-h); left: 0;
                height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
            }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop {
                display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000;
                background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
            }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* ==========================================================
           MAIN CONTENT & FORM STYLING
           ========================================================== */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        
        .page-head { margin-bottom: 28px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
        .page-head p { color: var(--steel); font-size: .98rem; margin: 0; }

        /* Custom Card Form */
        .card-custom {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--r-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        /* Form Elements */
        .field-label { font-size: .85rem; font-weight: 700; color: var(--ink-3); margin-bottom: 8px; display: inline-flex; align-items: center; }
        .field-label i { margin-right: 8px; font-size: .9rem; color: var(--steel); }

        .form-control, .form-select {
            font-family: var(--font-body);
            font-size: .95rem;
            color: var(--ink);
            background-color: var(--paper);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.2s ease-in-out;
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--navy);
            box-shadow: 0 0 0 4px var(--navy-tint);
        }
        .form-control::placeholder { color: var(--steel-soft); }
        
        .section-title {
            font-family: var(--font-display);
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px dashed var(--line);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.25rem;
        }
        .section-title i {
            color: var(--navy);
            background: var(--navy-tint);
            padding: 10px;
            border-radius: 10px;
            font-size: 1.05rem;
        }

        /* Buttons */
        .btn-custom-primary {
            background-color: var(--navy);
            color: #fff;
            font-family: var(--font-body);
            font-weight: 700;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            transition: background 0.2s;
            text-decoration: none;
        }
        .btn-custom-primary:hover { background-color: var(--navy-d); color: #fff; }
        
        .btn-custom-light {
            background-color: var(--paper);
            color: var(--ink);
            font-family: var(--font-body);
            font-weight: 700;
            border: 1px solid var(--line);
            padding: 12px 28px;
            border-radius: 12px;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-custom-light:hover { background-color: var(--line); color: var(--ink); }
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
            <details class="side-group" open>
                <summary><i class="fas fa-fire-extinguisher grp-ico"></i><span class="grp-label">Bagian pemadaman</span><i class="fas fa-chevron-down chev"></i></summary>
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
                    <a href="/sapra/sarana-penyelamatan" class="{{ Request::is('sapra/sarana-penyelamatan*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                    <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search"></i> Sarana Pemeriksaan</a> 
                    <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                    <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                    <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air
                    </a>
                    <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-location-dot"></i> Data Hidrant Kota Jambi
                    </a>

                    <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                    <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-boxes-stacked"></i> Mutu Baku Kebutuhan
                    </a>
                    <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-people-carry-box"></i> Distribusi Barang Staff
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

    <!-- ==================== KONTEN UTAMA & FORM ==================== -->
    <main class="content">

        <div class="page-head">
            <h1>Edit Surat Keterangan</h1>
            <p>Perbarui informasi Surat Keterangan Korban Kebakaran Nomor: <strong>{{ $surat->nomor_surat }}</strong></p>
        </div>

        <div class="card-custom">
            <div class="card-body p-4 p-md-5">
                <form action="/internal/surat-korban/update/{{ $surat->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- BAGIAN A: DATA DIRI -->
                    <h5 class="section-title"><i class="fas fa-user"></i> Data Diri Korban</h5>
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="nama_korban" class="form-control" value="{{ $surat->nama_korban }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-home"></i> Status Kepemilikan</label>
                            <input type="text" name="status_kepemilikan" class="form-control" value="{{ $surat->status_kepemilikan }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-id-card"></i> NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" name="nik" class="form-control" value="{{ $surat->nik }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" value="{{ $surat->pekerjaan }}" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-calendar-alt"></i> Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $surat->tanggal_lahir }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-ring"></i> Status Perkawinan</label>
                            <select class="form-select" name="status_perkawinan" required>
                                <option value="" disabled>-- Pilih --</option>
                                <option value="Kawin Tercatat" {{ $surat->status_perkawinan == 'Kawin Tercatat' ? 'selected' : '' }}>Kawin Tercatat</option>
                                <option value="Belum Kawin" {{ $surat->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Cerai Hidup" {{ $surat->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ $surat->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ $surat->alamat }}</textarea>
                        </div>
                    </div>

                    <!-- BAGIAN B: DETAIL KEJADIAN -->
                    <h5 class="section-title"><i class="fas fa-file-signature"></i> Detail Kejadian & Surat</h5>
                    <div class="row g-4 mb-4 p-4 rounded border" style="background: var(--paper);">
                        <div class="col-md-12">
                            <label class="field-label"><i class="fas fa-fire"></i> Objek Terbakar</label>
                            <input type="text" name="objek_terbakar" class="form-control" value="{{ $surat->objek_terbakar }}" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-calendar-day"></i> Hari Kejadian</label>
                            <select class="form-select" name="hari_kejadian" required>
                                <option value="" disabled>-- Pilih Hari --</option>
                                <option value="Senin" {{ $surat->hari_kejadian == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ $surat->hari_kejadian == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ $surat->hari_kejadian == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $surat->hari_kejadian == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ $surat->hari_kejadian == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ $surat->hari_kejadian == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                <option value="Minggu" {{ $surat->hari_kejadian == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-calendar"></i> Tanggal Kejadian</label>
                            <input type="date" name="tanggal_kejadian" class="form-control" value="{{ $surat->tanggal_kejadian }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-clock"></i> Waktu Kejadian (WIB)</label>
                            <input type="time" name="waktu_kejadian" class="form-control" value="{{ $surat->waktu_kejadian }}" required>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Camat</label>
                            <input type="text" name="tembusan_camat" class="form-control" value="{{ $surat->tembusan_camat }}">
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Lurah</label>
                            <input type="text" name="tembusan_lurah" class="form-control" value="{{ $surat->tembusan_lurah }}">
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                        <a href="/internal/surat-korban/data" class="btn-custom-light me-3">Batal</a>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<!-- ==================== SCRIPTS ==================== -->
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
</script>
</body>
</html>