<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Edit Data Edukasi Offline | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & FontAwesome -->
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

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
    font-family: var(--font-body); font-size: 1rem; line-height: 1.6;
    color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased;
}
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; margin: 0; padding: 0; }
button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }

/* TOPBAR */
.topbar {
    position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
    display: flex; align-items: center; justify-content: space-between;
    gap: 16px; padding: 0 28px; background: var(--ink);
    border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
}
.topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
.side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s, transform .2s; }
.side-toggle:hover { background: rgba(255,255,255,.10); }
.brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
.brand img { height: 34px; width: auto; flex: none; }
.brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; color: #fff; }

/* TOPBAR RIGHT */
.topbar-right { display: flex; align-items: center; gap: 12px; }
.user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
.user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
.user-meta { display: grid; line-height: 1.25; }
.user-meta strong { font-size: .84rem; font-weight: 700; color: #fff; }
.user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
.btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
.btn-logout:hover { background: #e8eef5; color: var(--ink); box-shadow: 0 4px 10px rgba(0,0,0,.12); }

/* SHELL & SIDEBAR */
.shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
.sidebar {
    width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
    height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden;
    background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px;
}
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }

.side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
.side-link:hover { background: #f3f6fa; color: var(--ink); transform: translateX(1px); }
.side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
.side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
.side-link:hover i { color: var(--ink); }
.side-link.active i { color: #fff; }

.lbl { flex: 1 1 auto; min-width: 0; overflow-wrap: break-word; line-height: 1.4; }

.side-group + .side-group { margin-top: 6px; }
.side-group summary { list-style: none; cursor: pointer; display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); user-select: none; }
.side-group summary::-webkit-details-marker { display: none; }
.side-group summary:hover { background: #f3f6fa; }
.side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
.side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
.side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
.side-group[open] summary .chev { transform: rotate(180deg); }

.side-sub { display: grid; gap: 3px; padding: 6px 0 10px 8px; border-left: 2px solid var(--line); margin: 2px 0 8px 18px; }
.side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
.side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); transform: translateX(2px); }
.side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
.side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; flex: none; margin-top: 3px; }
.side-sub a:hover i, .side-sub a.active i { opacity: 1; }

.side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; box-shadow: var(--shadow-lg); }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* MAIN CONTENT */
.content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
.page-head { margin-bottom: 26px; }
.page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
.page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

/* STYLE KHUSUS FORM TAMBAH EDUKASI */
.content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 32px; box-shadow: var(--shadow-xs); }
.form-label { font-weight: 600; color: var(--ink-2); font-size: .88rem; margin-bottom: 8px; }
.form-control, .form-select { border-radius: 8px; border-color: var(--line-dark); min-height: 44px; font-size: .9rem; color: var(--ink); }
.form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
.section-header { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; border-bottom: 2px solid var(--line); padding-bottom: 8px; margin-bottom: 20px; margin-top: 30px; }

.btn-primary-custom { display: inline-flex; align-items: center; gap: 8px; background: var(--navy); color: #fff; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; transition: 0.2s; }
.btn-primary-custom:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
.btn-outline-custom { display: inline-flex; align-items: center; justify-content: center; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; transition: 0.2s; text-decoration: none; }
.btn-outline-custom:hover { background: var(--paper); color: var(--ink); }

@media (max-width: 700px) {
    :root { --topbar-h: 64px; }
    .topbar { padding: 0 14px; gap: 10px; }
    .brand { gap: 9px; }
    .brand img { height: 30px; }
    .brand span { font-size: .95rem; }
    .topbar-right { gap: 7px; }
    .user-chip { padding: 3px; border: none; background: transparent; }
    .user-avatar { width: 34px; height: 34px; }
    .btn-logout { width: 38px; height: 38px; padding: 0; font-size: 0; }
    .btn-logout i { font-size: .9rem; }
    .content { padding: 26px 16px 50px; }
    .page-head-title h1 { font-size: 1.55rem; }
}
    </style>
</head>
<body>

<!-- ==================== TOPBAR ==================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle">
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
                <small>{{ Auth::user()->role ?? '' }}</small>
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
                        <i class="fas fa-fire-extinguisher"></i> Input data
                    </a>
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
        <details class="side-group" {{ request()->is('internal/profil*') || request()->is('internal/kelola-user*') || request()->is('internal/kelola-pemohon*') ? 'open' : '' }}>
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

                <a href="{{ url('/internal/kelola-pemohon') }}" class="{{ request()->is('internal/kelola-pemohon*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i><span class="lbl">Kelola Akun Pemohon</span>
                </a>
            </div>
        </details>

    </aside>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <main class="content">

        <!-- Kontainer pembungkus utama agar semuanya sejajar dan rapi -->
        <div class="mx-auto" style="max-width: 900px;">
            
            <!-- TOMBOL KEMBALI -->
            <div class="mb-4">
                <a href="/internal/pencegahan/kelola-edukasi" class="btn-outline-custom" style="padding: 8px 18px; font-size: 0.88rem;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Kelola Edukasi
                </a>
            </div>

            <div class="page-head">
                <div class="page-head-title">
                    <h1>Edit Data Kunjungan Edukasi</h1>
                    <p>Perbarui informasi pengajuan layanan edukasi secara offline dari masyarakat atau instansi.</p>
                </div>
            </div>

            <div class="content-card">
                
                @if(session('error'))
                    <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem;">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('edukasi.offline.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="section-header mt-0">Data Institusi</div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Institusi (Sekolah/Kampus/Instansi) <span class="text-danger">*</span></label>
                            <input type="text" name="institusi" class="form-control" placeholder="Contoh: TK Dharma Wanita" value="{{ old('institusi', $edukasi->institusi) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat Lengkap Institusi <span class="text-danger">*</span></label>
                            <textarea name="alamat_institusi" class="form-control" rows="3" required>{{ old('alamat_institusi', $edukasi->alamat_institusi) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select name="kecamatan" id="kecamatan" class="form-select" required>
                                <option value="" disabled>Pilih kecamatan</option>
                                <option value="Alam Barajo" {{ old('kecamatan', $edukasi->kecamatan) == 'Alam Barajo' ? 'selected' : '' }}>Alam Barajo</option>
                                <option value="Danau Sipin" {{ old('kecamatan', $edukasi->kecamatan) == 'Danau Sipin' ? 'selected' : '' }}>Danau Sipin</option>
                                <option value="Danau Teluk" {{ old('kecamatan', $edukasi->kecamatan) == 'Danau Teluk' ? 'selected' : '' }}>Danau Teluk</option>
                                <option value="Jambi Selatan" {{ old('kecamatan', $edukasi->kecamatan) == 'Jambi Selatan' ? 'selected' : '' }}>Jambi Selatan</option>
                                <option value="Jambi Timur" {{ old('kecamatan', $edukasi->kecamatan) == 'Jambi Timur' ? 'selected' : '' }}>Jambi Timur</option>
                                <option value="Jelutung" {{ old('kecamatan', $edukasi->kecamatan) == 'Jelutung' ? 'selected' : '' }}>Jelutung</option>
                                <option value="Kota Baru" {{ old('kecamatan', $edukasi->kecamatan) == 'Kota Baru' ? 'selected' : '' }}>Kota Baru</option>
                                <option value="Paal Merah" {{ old('kecamatan', $edukasi->kecamatan) == 'Paal Merah' ? 'selected' : '' }}>Paal Merah</option>
                                <option value="Pasar Jambi" {{ old('kecamatan', $edukasi->kecamatan) == 'Pasar Jambi' ? 'selected' : '' }}>Pasar Jambi</option>
                                <option value="Pelayangan" {{ old('kecamatan', $edukasi->kecamatan) == 'Pelayangan' ? 'selected' : '' }}>Pelayangan</option>
                                <option value="Telanaipura" {{ old('kecamatan', $edukasi->kecamatan) == 'Telanaipura' ? 'selected' : '' }}>Telanaipura</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <select name="kelurahan" id="kelurahan" class="form-select" required>
                                <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-header">Data Penanggung Jawab</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pemohon" class="form-control" placeholder="Contoh: Budi Santoso" value="{{ old('nama_pemohon', $edukasi->nama_pemohon) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan_pemohon" class="form-control" placeholder="Kepala Sekolah / Panitia" value="{{ old('jabatan_pemohon', $edukasi->jabatan_pemohon) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK KTP <span class="text-danger">*</span></label>
                            <input type="text" name="nik" class="form-control" value="{{ old('nik', $edukasi->nik) }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 Digit" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="no_kontak" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_kontak', $edukasi->no_kontak) }}" required>
                        </div>
                    </div>

                    <div class="section-header">Rincian Kegiatan</div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Rencana Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kegiatan" class="form-control" style="max-width: 250px;" value="{{ old('tgl_kegiatan', $edukasi->tgl_kegiatan) }}" required>
                        </div>
                        <div class="col-12"><label class="form-label mb-0">Jumlah & Perkiraan Usia Peserta</label></div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Usia 3 - 6 Tahun</small>
                            <input type="number" name="usia_3_6" class="form-control text-center" min="0" value="{{ old('usia_3_6', $edukasi->usia_3_6) }}">
                        </div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Usia 7 - 12 Tahun</small>
                            <input type="number" name="usia_7_12" class="form-control text-center" min="0" value="{{ old('usia_7_12', $edukasi->usia_7_12) }}">
                        </div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Usia 13 - 18 Tahun</small>
                            <input type="number" name="usia_13_18" class="form-control text-center" min="0" value="{{ old('usia_13_18', $edukasi->usia_13_18) }}">
                        </div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Diatas 18 Tahun</small>
                            <input type="number" name="usia_18_keatas" class="form-control text-center" min="0" value="{{ old('usia_18_keatas', $edukasi->usia_18_keatas) }}">
                        </div>
                    </div>

                    <!-- ==============================================
                         PERBAIKAN LOGIKA TOMBOL LAMPIRAN DENGAN ALERT 
                         ============================================== -->
                    <div class="section-header">Unggah Berkas (Biarkan kosong jika tidak diubah)</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Surat Permohonan Bermaterai (PDF/JPG/PNG)</label>
                            @if($edukasi->surat_permohonan)
                                <div class="mb-2">
                                    @if($edukasi->surat_permohonan == 'Tidak dilampirkan (Offline)')
                                        <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Surat Permohonan.');" class="badge bg-primary text-decoration-none py-2 px-3">
                                            <i class="fas fa-file-alt"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $edukasi->surat_permohonan) }}" target="_blank" class="badge bg-primary text-decoration-none py-2 px-3">
                                            <i class="fas fa-file-alt"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <input type="file" name="surat_permohonan" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Persyaratan Lainnya</label>
                            @if($edukasi->syarat_lainnya && $edukasi->syarat_lainnya != 'null' && $edukasi->syarat_lainnya != '[]')
                                <div class="mb-2">
                                    @php
                                        // Cek apakah data string array (JSON) atau path biasa
                                        $syaratLain = is_string($edukasi->syarat_lainnya) && str_starts_with($edukasi->syarat_lainnya, '[') 
                                            ? json_decode($edukasi->syarat_lainnya, true) 
                                            : $edukasi->syarat_lainnya;
                                            
                                        $linkSyarat = is_array($syaratLain) && isset($syaratLain[0]) ? $syaratLain[0] : (is_string($syaratLain) ? $syaratLain : null);
                                    @endphp
                                    
                                    @if(!$linkSyarat || $linkSyarat == 'Tidak dilampirkan (Offline)')
                                        <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Persyaratan Lainnya.');" class="badge bg-secondary text-decoration-none py-2 px-3">
                                            <i class="fas fa-folder-open"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $linkSyarat) }}" target="_blank" class="badge bg-secondary text-decoration-none py-2 px-3">
                                            <i class="fas fa-folder-open"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <input type="file" name="syarat_lainnya[]" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar" multiple>
                            <small class="text-muted">Gunakan ZIP/RAR jika lebih dari 1 file tambahan</small>
                        </div>
                    </div>

                    <hr style="margin-top: 40px; border-color: var(--line-dark);">
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Loading State Submit ---------- */
    document.querySelector('form').addEventListener('submit', function(e) {
        var btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui...';
        btn.classList.add('disabled');
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

    /* ---------- Kelurahan mengikuti Kecamatan ---------- */
    var dataWilayah = {
        'Alam Barajo': ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawa Sari', 'Simpang Rimbo'],
        'Danau Sipin': ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk': ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan': ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur': ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sejinjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung': ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru': ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya', 'Talang Gulo'],
        'Paal Merah': ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi': ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan': ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura': ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali']
    };

    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');
    
    // Inject old value atau value dari database saat ini
    var oldKel = "{{ old('kelurahan', $edukasi->kelurahan) }}";

    function updateKelurahan() {
        kel.innerHTML = '';
        var ph = new Option('Pilih kelurahan', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        if(kec.value && dataWilayah[kec.value]) {
            dataWilayah[kec.value].forEach(function (nama) {
                var opt = new Option(nama, nama);
                if (nama === oldKel) opt.selected = true;
                kel.add(opt);
            });
        }
    }

    kec.addEventListener('change', updateKelurahan);
    
    // Inisialisasi awal saat halaman di-load
    if (kec.value) {
        updateKelurahan();
    }
})();
</script>
</body>
</html>