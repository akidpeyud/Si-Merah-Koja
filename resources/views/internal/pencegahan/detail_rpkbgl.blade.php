<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Detail RPKBGL | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
/* ==========================================================
   SIMERAH KOJA - CLEAN NAVY DASHBOARD (WEB)
   ========================================================== */
:root {
    --ink: #0d1b2a;
    --navy: #163a63;
    --navy-dark: #0d2947;
    --navy-light: #eaf1f8;
    --navy-soft: rgba(22, 58, 99, .08);
    --paper: #f5f7fa;
    --signal: #dc3545;
    --signal-dark: #b42332;
    --signal-soft: rgba(220, 53, 69, .09);
    --success: #198754;
    --info: #2563eb;
    --info-soft: rgba(37, 99, 235, .09);
    --steel: #64748b;
    --steel-soft: #94a3b8;
    --line: #e2e8f0;
    --line-dark: #d5dce6;
    
    --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
    --font-body: 'Instrument Sans', system-ui, sans-serif;

    --sidebar-w: 288px;
    --topbar-h: 70px;
    --r-md: 14px;
    --r-sm: 10px;
    --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
}

@media screen {
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
    img { max-width: 100%; display: block; }
    a { color: inherit; text-decoration: none; }
    ul, ol { list-style: none; margin: 0; padding: 0; }
    button { font: inherit; background: none; border: 0; cursor: pointer; }

    /* Topbar & Sidebar */
    .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .topbar-left { display: flex; align-items: center; gap: 14px; }
    .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s; }
    .brand { display: flex; align-items: center; gap: 12px; color: #fff; }
    .brand img { height: 34px; width: auto; }
    .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; color: #fff; }
    .topbar-right { display: flex; align-items: center; gap: 12px; }
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; }
    .user-meta { display: grid; line-height: 1.25; }
    .user-meta strong { font-size: .84rem; font-weight: 700; color: #ffffff; }
    .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; font-weight: 500; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s; }
    .btn-logout:hover { background: #e8eef5; }

    .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;}
    .sidebar::-webkit-scrollbar { width: 6px; }
    .sidebar::-webkit-scrollbar-track { background: transparent; }
    .sidebar::-webkit-scrollbar-thumb { background-color: #d8dee8; border-radius: 20px; }
    .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s; margin-bottom: 4px; }
    .side-link:hover { background: #f3f6fa; }
    .side-link.active { background: var(--ink); color: #ffffff; }
    .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
    .side-link.active i { color: #ffffff; }
    .side-group + .side-group { margin-top: 6px; }
    .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); }
    .side-group summary::-webkit-details-marker { display: none; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
    .side-group[open] summary .chev { transform: rotate(180deg); }
    .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
    .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); transition: background .2s, color .2s; }
    .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
    .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
    .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
    .side-sub a:hover i, .side-sub a.active i { opacity: 1; }
    .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }

    /* Konten Main Area */
    .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

    .btn-back { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: #ffffff; color: var(--ink); border: 1px solid var(--line); border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; }
    .btn-back:hover { background: var(--paper); border-color: var(--line-dark); }
    .btn-print { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: var(--navy); color: #fff; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; }
    .btn-print:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }

    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 32px; box-shadow: var(--shadow-xs); }
    .detail-section-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--ink); border-bottom: 2px solid var(--line); padding-bottom: 12px; margin: 32px 0 20px; display: flex; align-items: center; gap: 10px; }
    .detail-section-title:first-child { margin-top: 0; }
    .detail-label { font-size: .8rem; font-weight: 700; color: var(--steel-soft); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
    .detail-value { font-size: .98rem; font-weight: 600; color: var(--ink); margin-bottom: 20px; line-height: 1.5; }

    /* Status Badges */
    .badge-status { display: inline-flex; align-items: center; padding: 6px 14px; border-radius: 6px; font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-pending { background: rgba(244, 183, 64, .15); color: #d97706; }
    .status-diproses { background: var(--info-soft); color: var(--info); }
    .status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-tidak { background: var(--signal-soft); color: var(--signal-dark); }

    /* Download Links */
    .btn-download-doc { display: inline-flex; align-items: center; gap: 12px; padding: 12px 18px; border-radius: 8px; background: var(--paper); border: 1px solid var(--line); color: var(--ink); font-weight: 600; font-size: .88rem; transition: all .2s; text-decoration: none; width: 100%; max-width: 350px; margin-bottom: 10px; }
    .btn-download-doc:hover { background: #ffffff; border-color: var(--line-dark); box-shadow: var(--shadow-xs); }
    .btn-download-doc i { font-size: 1.2rem; color: var(--signal); }
    .btn-download-doc .doc-info { display: flex; flex-direction: column; line-height: 1.3; }
    .btn-download-doc .doc-info small { font-size: .75rem; color: var(--steel); font-weight: 500; }
}

@media (max-width: 900px) {
    .side-toggle { display: inline-flex; }
    .user-meta { display: none; }
    .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
    body.side-open .sidebar { transform: none; }
    .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
}

/* ==========================================================
   DOKUMEN PRINT (Tampilan Surat Resmi Kertas A4)
   ========================================================== */
.document-page-print { display: none; } /* Sembunyikan default di web */

@media print {
    @page {
        size: A4 portrait;
        margin: 0; 
    }

    body {
        background-color: white !important;
        padding: 0 !important;
        margin: 0 !important;
        display: block;
        font-family: 'Times New Roman', Times, serif; 
        color: #000;
    }

    /* Sembunyikan semua elemen web */
    .topbar, .sidebar, .shell > .sidebar-backdrop, .page-head, .content-card, .no-print { 
        display: none !important; 
    }

    .shell { display: block !important; }
    .content { padding: 0 !important; margin: 0 !important; background: transparent !important; }

    /* Tampilkan elemen surat khusus print */
    .document-page-print {
        display: block !important;
        width: 100%;
        height: 100vh;
        padding: 15mm 20mm;
        margin: 0;
        box-sizing: border-box;
        position: relative;
    }

    /* Kop Surat Resmi */
    .kop-surat { 
        display: flex; 
        align-items: center; 
        border-bottom: 3px double #000; 
        padding-bottom: 8px; 
        margin-bottom: 15px; 
    }
    .kop-surat img { width: 70px; height: auto; }
    .kop-teks { flex: 1; text-align: center; padding: 0 10px; }
    .kop-teks h2 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; color: #000; }
    .kop-teks h1 { margin: 3px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; color: #000; }
    .kop-teks p { margin: 1px 0 0 0; font-size: 9pt; font-family: 'Arial', sans-serif; color: #000; }

    .doc-title { 
        text-align: center; 
        font-size: 13pt; 
        font-weight: bold; 
        margin-bottom: 25px; 
        text-decoration: underline; 
        letter-spacing: 0.5px; 
        color: #000;
    }

    /* Tabel Formulir Print */
    .print-table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-bottom: 15px; 
        font-size: 11.5pt; 
        line-height: 1.4; 
        color: #000;
    }
    .print-table td { padding: 5px 3px; vertical-align: top; border: none; }
    .print-table .label-col { width: 35%; }
    .print-table .separator { width: 3%; text-align: center; }
    .print-table .value-col { width: 62%; font-weight: bold; text-transform: capitalize; }
    .print-table .section-title { font-weight: bold; font-size: 12pt; margin-top: 15px; text-decoration: underline; padding-top: 10px; padding-bottom: 5px; }

    /* Area Tanda Tangan */
    .signature-section {
        margin-top: 35px; 
        text-align: right; 
        padding-right: 30px; 
        font-size: 11.5pt;
        color: #000;
    }
    .signature-space {
        height: 65px;
    }
}
    </style>
</head>
<body>

<!-- ==================== TOPBAR (WEB) ==================== -->
<header class="topbar no-print">
    <div class="topbar-left">
        <button class="side-toggle" type="button" id="sideToggle" aria-label="Buka menu">
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
    <div class="sidebar-backdrop no-print" id="sideBackdrop"></div>

    <!-- ==================== SIDEBAR (WEB) ==================== -->
    <aside class="sidebar no-print" id="sidebar" aria-label="Navigasi internal">

        <a href="/internal/index" class="side-link {{ Request::is('internal/index') ? 'active' : '' }}">
            <i class="fas fa-house"></i><span class="lbl">Dashboard utama</span>
        </a>

        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')

            <div class="side-kicker">Modul operasional</div>

            <!-- BAGIAN PENCEGAHAN -->
            <details class="side-group" open>
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
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="active">
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
        
        <!-- HEADER HALAMAN WEB -->
        <div class="page-head no-print">
            <div>
                <h1>Detail Permohonan RPKBGL</h1>
                <p>Menampilkan rincian data permohonan dari <strong>{{ $permohonan->nama_pemohon }}</strong></p>
            </div>
            <div class="d-flex gap-2">
                <a href="/internal/pencegahan/kelola-rpkbgl" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn-print">
                    <i class="fas fa-print"></i> Cetak Dokumen
                </button>
            </div>
        </div>

        <!-- ==================== TAMPILAN KARTU WEB ==================== -->
        <div class="content-card no-print">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-user-circle text-primary"></i> Informasi Pemohon</h3>
                    
                    <div class="detail-label">Nama Pemohon</div>
                    <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>

                    <div class="detail-label">Alamat Email</div>
                    <div class="detail-value">{{ $permohonan->email_pemohon }}</div>

                    <div class="detail-label">Nomor WhatsApp</div>
                    <div class="detail-value">
                        {{ $permohonan->no_whatsapp }}
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $permohonan->no_whatsapp) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none">
                            Hubungi <i class="fab fa-whatsapp ms-1"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-store text-warning"></i> Informasi Usaha</h3>

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
                    <h3 class="detail-section-title"><i class="fas fa-building text-success"></i> Rincian Bangunan</h3>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Kategori Bangunan</div>
                    <div class="detail-value">{{ $permohonan->kategori_bangunan }}</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Lahan</div>
                    <div class="detail-value">{{ $permohonan->luas_lahan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Bangunan</div>
                    <div class="detail-value">{{ $permohonan->luas_bangunan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Tinggi Bangunan</div>
                    <div class="detail-value">{{ $permohonan->tinggi_bangunan }} m</div>
                </div>
                <div class="col-md-12">
                    <div class="detail-label">Alamat Lengkap Bangunan</div>
                    <div class="detail-value">
                        {{ $permohonan->alamat_bangunan }}<br>
                        <span style="font-size: .85rem; color: var(--steel);">Kec. {{ $permohonan->kecamatan }}, Kel. {{ $permohonan->kelurahan }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-info-circle text-danger"></i> Status & Pengajuan</h3>
                    <div class="detail-label">Status Saat Ini</div>
                    <div class="detail-value">
                        @if($permohonan->status_permohonan == 'Pending')
                            <span class="badge-status status-pending">Pending</span>
                        @elseif($permohonan->status_permohonan == 'Diproses')
                            <span class="badge-status status-diproses">Diproses Tim</span>
                        @elseif($permohonan->status_permohonan == 'Memenuhi Syarat')
                            <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                        @else
                            <span class="badge-status status-tidak">Tidak Memenuhi Syarat</span>
                        @endif
                    </div>
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-folder-open text-info"></i> Berkas Lampiran</h3>
                    <div class="d-flex flex-column gap-2">
                        
                        <!-- Peringatan Alert Jika File Offline -->
                        @if($permohonan->file_surat_permohonan)
                            @if($permohonan->file_surat_permohonan == 'Tidak dilampirkan (Offline)')
                                <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Surat Permohonan (Data dimasukkan secara Offline).');" class="btn-download-doc bg-light text-secondary">
                                    <i class="fas fa-file-pdf text-secondary"></i>
                                    <div class="doc-info">
                                        <span>Surat Permohonan</span>
                                        <small>Tidak dilampirkan</small>
                                    </div>
                                </a>
                            @else
                                <a href="{{ asset('uploads/rpkbgl/surat/' . $permohonan->file_surat_permohonan) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-pdf"></i>
                                    <div class="doc-info">
                                        <span>Surat Permohonan</span>
                                        <small>Berkas Wajib</small>
                                    </div>
                                </a>
                            @endif
                        @endif

                        @if(!empty($permohonan->file_persyaratan_lainnya) && is_array($permohonan->file_persyaratan_lainnya))
                            @foreach($permohonan->file_persyaratan_lainnya as $index => $fileLain)
                                @if($fileLain == 'Tidak dilampirkan (Offline)')
                                    <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Syarat Lainnya (Data dimasukkan secara Offline).');" class="btn-download-doc bg-light text-secondary">
                                        <i class="fas fa-paperclip text-secondary"></i>
                                        <div class="doc-info">
                                            <span>Syarat Lainnya</span>
                                            <small>Tidak dilampirkan</small>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ asset('uploads/rpkbgl/persyaratan/' . $fileLain) }}" target="_blank" class="btn-download-doc">
                                        <i class="fas fa-paperclip" style="color: #8b5cf6;"></i>
                                        <div class="doc-info">
                                            <span>Syarat Lainnya {{ $index + 1 }}</span>
                                            <small>Lampiran Tambahan</small>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <div class="text-muted mt-2" style="font-size: 13px; font-weight: 500;">
                                <i class="fas fa-minus-circle me-1"></i> Tidak ada berkas tambahan.
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== TAMPILAN KERTAS PRINT ==================== -->
        <!-- Bagian ini disembunyikan di layar, dan HANYA MUNCUL DI KERTAS -->
        <div class="document-page-print">
            
            <!-- KOP SURAT -->
            <div class="kop-surat">
                <img src="/images/jambi.png" alt="Logo Jambi">
                <div class="kop-teks">
                    <h2>Pemerintah Kota Jambi</h2>
                    <h1>Dinas Pemadam Kebakaran dan Penyelamatan</h1>
                    <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi 36125</p>
                    <p>Email: damkar.jbi@gmail.com | Website: damkar.jambikota.go.id</p>
                </div>
                <img src="/images/logo.png" alt="Logo Damkar">
            </div>

            <div class="doc-title">
                DATA PERMOHONAN REKOMENDASI PROTEKSI KEBAKARAN (RPKBGL)
            </div>

            <table class="print-table">
                <tr>
                    <td colspan="3" class="section-title" style="margin-top: 0;">A. Data Pemohon</td>
                </tr>
                <tr>
                    <td class="label-col">1. Nama Pemohon</td>
                    <td class="separator">:</td>
                    <td class="value-col">{{ $permohonan->nama_pemohon }}</td>
                </tr>
                <tr>
                    <td class="label-col">2. Alamat Email</td>
                    <td class="separator">:</td>
                    <td class="value-col" style="text-transform: none;">{{ $permohonan->email_pemohon }}</td>
                </tr>
                <tr>
                    <td class="label-col">3. Nomor WhatsApp</td>
                    <td class="separator">:</td>
                    <td class="value-col">{{ $permohonan->no_whatsapp }}</td>
                </tr>
                <tr>
                    <td class="label-col">4. Tanggal Pengajuan</td>
                    <td class="separator">:</td>
                    <td class="value-col">{{ \Carbon\Carbon::parse($permohonan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
                </tr>

                <tr>
                    <td colspan="3" class="section-title">B. Data Usaha / Instansi</td>
                </tr>
                <tr>
                    <td class="label-col">5. Nama Usaha</td>
                    <td class="separator">:</td>
                    <td class="value-col">{{ $permohonan->nama_usaha }}</td>
                </tr>
                <tr>
                    <td class="label-col">6. NIK Pemilik Usaha</td>
                    <td class="separator">:</td>
                    <td class="value-col">{{ $permohonan->nik_pemilik_usaha }}</td>
                </tr>
                <tr>
                    <td class="label-col">7. Alamat Pemilik</td>
                    <td class="separator">:</td>
                    <td class="value-col" style="line-height: 1.4;">{{ $permohonan->alamat_pemilik_usaha }}</td>
                </tr>

                <tr>
                    <td colspan="3" class="section-title">C. Spesifikasi Bangunan</td>
                </tr>
                <tr>
                    <td class="label-col">8. Kategori Bangunan</td>
                    <td class="separator">:</td>
                    <td class="value-col">{{ $permohonan->kategori_bangunan }}</td>
                </tr>
                <tr>
                    <td class="label-col">9. Luas Lahan</td>
                    <td class="separator">:</td>
                    <td class="value-col" style="text-transform: none;">{{ $permohonan->luas_lahan }} m&sup2;</td>
                </tr>
                <tr>
                    <td class="label-col">10. Luas Bangunan</td>
                    <td class="separator">:</td>
                    <td class="value-col" style="text-transform: none;">{{ $permohonan->luas_bangunan }} m&sup2;</td>
                </tr>
                <tr>
                    <td class="label-col">11. Tinggi Bangunan</td>
                    <td class="separator">:</td>
                    <td class="value-col" style="text-transform: none;">{{ $permohonan->tinggi_bangunan }} m</td>
                </tr>
                <tr>
                    <td class="label-col">12. Alamat Bangunan</td>
                    <td class="separator">:</td>
                    <td class="value-col" style="line-height: 1.4;">
                        {{ $permohonan->alamat_bangunan }},<br>
                        Kec. {{ $permohonan->kecamatan }}, Kel. {{ $permohonan->kelurahan }}
                    </td>
                </tr>
            </table>

            <div class="signature-section">
                <p>Jambi, {{ \Carbon\Carbon::parse($permohonan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
                <p style="margin-bottom: 0;">Pemohon RPKBGL,</p>
                <div class="signature-space"></div>
                <p style="font-weight: bold; text-decoration: underline; text-transform: uppercase; margin: 0;">{{ $permohonan->nama_pemohon }}</p>
            </div>

        </div>

    </main>
</div>

<script>
(function () {
    'use strict';
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() { document.body.classList.remove('side-open'); }
    if (toggle) toggle.addEventListener('click', function () { document.body.classList.toggle('side-open'); });
    if (backdrop) backdrop.addEventListener('click', closeSide);
    
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('auto_print')) setTimeout(function() { window.print(); }, 500);
})();
</script>
</body>
</html>