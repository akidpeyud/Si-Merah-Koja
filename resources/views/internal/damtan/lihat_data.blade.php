<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Rincian Data Penyelamatan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    
    <!-- PRELOAD LOGO AGAR TIDAK TELAT LOADING SAAT DI-PRINT -->
    <link rel="preload" href="/images/logo.png" as="image">
    <link rel="preload" href="/images/jambi.png" as="image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome & HTML2PDF -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
            --amber: #f4b740;
            --success: #198754;
            --info: #2563eb;
            --steel: #64748b;
            --steel-soft: #94a3b8;
            --line: #e2e8f0;
            --line-dark: #cbd5e1;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --sidebar-w: 272px;
            --topbar-h: 70px;
            --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
            --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; margin: 0; padding: 0; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        /* TOPBAR */
        .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
        .topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s; }
        .side-toggle:hover { background: rgba(255,255,255,.10); }
        .brand { display: flex; align-items: center; gap: 12px; min-width: 0; color: #fff; }
        .brand img { height: 34px; width: auto; flex: none; }
        .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ffffff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
        .user-meta { display: grid; line-height: 1.25; }
        .user-meta strong { font-size: .84rem; font-weight: 700; color: #ffffff; }
        .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); text-transform: capitalize; }
        .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s; }
        .btn-logout:hover { background: #e8eef5; }

        @media (max-width: 900px) {
            .side-toggle { display: inline-flex; }
            .user-meta { display: none; }
        }

        /* SIDEBAR */
        .shell { display: flex; align-items: flex-start; min-height: calc(100vh - var(--topbar-h)); }
        .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; }
        .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; transition: background .2s; }
        .side-link:hover { background: #f3f6fa; }
        .side-link.active { background: var(--ink); color: #ffffff; }
        .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); }
        .side-link.active i { color: #ffffff; }

        .side-group + .side-group { margin-top: 6px; }
        .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); }
        .side-group summary::-webkit-details-marker { display: none; }
        .side-group summary:hover { background: #f3f6fa; }
        .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
        .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; }
        .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
        .side-group[open] summary .chev { transform: rotate(180deg); }

        .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
        .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); transition: background .2s; }
        .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
        .side-sub a.active { background: var(--navy-soft); color: var(--navy); font-weight: 600; }
        .side-sub a i { width: 18px; text-align: center; opacity: .75; }

        .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; }
            body.side-open .sidebar { transform: none; }
            .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; }
            body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
        }

        /* MAIN CONTENT STYLING */
        .content { flex: 1; min-width: 0; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; font-size: .88rem; font-weight: 700; color: var(--steel); margin-bottom: 16px; padding: 8px 16px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); transition: all .2s; }
        .back-link:hover { color: var(--navy); background: #f8fafc; }

        .page-head { margin-bottom: 26px; }
        .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }

        .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); padding: clamp(24px, 4vw, 40px); margin-bottom: 30px; }

        .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; cursor: pointer; text-decoration: none;}
        .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); }

        .btn-custom-edit { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: rgba(255, 182, 39, 0.15); color: #d97706; border: none; border-radius: 8px; font-size: .92rem; font-weight: 700; transition: all .2s ease; text-decoration: none; }
        .btn-custom-edit:hover { background: rgba(255, 182, 39, 0.3); color: #d97706; }

        /* PENGATURAN PDF LAMA & DATA ROWS */
        .tabel-kop { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
        .tabel-kop td { vertical-align: middle; }
        .tabel-kop img { width: 80px; height: auto; }
        .kop-text { text-align: center; }
        .kop-text h2 { margin: 0; font-size: 14pt; font-weight: normal; font-family: 'Times New Roman', Times, serif; color: #000; }
        .kop-text h1 { margin: 0; font-size: 16pt; font-weight: bold; line-height: 1.1; font-family: 'Times New Roman', Times, serif; color: #000; }
        .kop-text p { margin: 2px 0 0 0; font-size: 10pt; font-family: 'Times New Roman', Times, serif; color: #000; }
        .garis-kop { border-top: 3px solid black; border-bottom: 1px solid black; height: 2px; margin-top: 5px; margin-bottom: 20px; }
        .judul-laporan { text-align: center; margin-bottom: 25px; line-height: 1.2; font-family: 'Times New Roman', Times, serif; color: #000; }
        .judul-laporan h3 { margin: 0; font-size: 14pt; font-weight: bold; text-decoration: underline; }

        .section-header { clear: both; display: flex; align-items: center; gap: 10px; margin-bottom: 12px; margin-top: 24px; padding-bottom: 6px; border-bottom: 1px solid var(--line); page-break-after: avoid; page-break-inside: avoid; }
        .section-header h3 { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--navy-dark); text-transform: uppercase; letter-spacing: 0.02em;}
        .section-header::before { content: ''; width: 5px; height: 18px; background-color: var(--navy); border-radius: 4px; }
        
        .sub-header { clear: both; display: block; width: 100%; font-size: 1rem; font-family: var(--font-display); font-weight: 700; color: var(--navy); margin-top: 16px; margin-bottom: 10px; page-break-after: avoid; page-break-inside: avoid; }
        
        .pdf-grid { display: block; width: 100%; margin-bottom: 10px; } 
        .pdf-grid::after { content: ""; display: table; clear: both; }
        .pdf-item { float: left; width: 49%; padding-right: 15px; margin-bottom: 8px; box-sizing: border-box; page-break-inside: avoid; }
        .pdf-item-full { clear: both; display: block; width: 100%; margin-bottom: 8px; box-sizing: border-box; page-break-inside: avoid; }
        
        .data-row { display: flex; align-items: flex-start; page-break-inside: avoid; break-inside: avoid; width: 100%; }
        .data-icon { width: 24px; color: var(--navy); flex-shrink: 0; font-size: 12px; margin-top: 3px; }
        .data-label { width: 140px; font-weight: 600; color: var(--steel); flex-shrink: 0; font-size: 0.85rem; line-height: 1.4; }
        .data-colon { width: 10px; font-weight: 600; color: var(--steel); text-align: center; flex-shrink: 0; font-size: 0.85rem; line-height: 1.4; }
        .data-value { flex-grow: 1; font-weight: 600; color: var(--ink); font-size: 0.85rem; word-break: break-word; line-height: 1.4; }

        .text-capitalize { text-transform: capitalize; }
        .text-uppercase { text-transform: uppercase; }

        @media print {
            .topbar, .sidebar, .sidebar-backdrop, #action-buttons-container, .back-link, .d-print-none, .page-head { display: none !important; }
            body, .content { background-color: white !important; padding: 0 !important; margin: 0 !important;}
            .card-custom { box-shadow: none !important; border: none !important; padding: 0 !important; margin: 0 !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

    <!-- ==================== LOGIKA PARSING DAN PEMBAGIAN BAB ==================== -->
    @php
        if (!function_exists('parseJsonField')) {
            function parseJsonField($field) {
                if (empty($field) || $field === 'null' || $field === '[]') return [];
                return is_string($field) ? json_decode($field, true) ?? [] : (is_array($field) ? $field : []);
            }
        }
        
        // Parsing Array dari Tab
        $arr_evakuasi = parseJsonField($teknis->metode_evakuasi ?? null);
        $arr_penyelamatan = parseJsonField($teknis->metode_penyelamatan ?? null);
        $arr_armada = parseJsonField($teknis->armada ?? null);
        $arr_peralatan = parseJsonField($teknis->peralatan ?? null);
        $arr_instansi = parseJsonField($dokumentasi->instansi_pendukung ?? null);
        $arr_foto = parseJsonField($dokumentasi->foto ?? null);

        // ==========================================
        // CHECKER PENAMPILAN BAB II (TEKNIS & LOGISTIK)
        // ==========================================
        $has_teknis_dasar = !empty($teknis->pimpinan_operasi) || !empty($teknis->pendamping_operasi) || 
                            !empty($teknis->satuan_tugas) || !empty($teknis->tim_respontime) || 
                            !empty($teknis->status_evakuasi) || !empty($arr_evakuasi) || 
                            !empty($arr_penyelamatan) || !empty($teknis->objek_terdampak) || 
                            (!empty($teknis->jumlah_personel) && $teknis->jumlah_personel > 0) || 
                            !empty($teknis->daftar_personel);
        
        $has_detail_lapangan = !empty($teknis->langkah_penanganan) || !empty($teknis->hambatan_lapangan) || !empty($teknis->hasil_tindakan);
        
        $has_korban = (!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0) || 
                      (!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0) || 
                      (!empty($teknis->korban_berat) && $teknis->korban_berat > 0) || 
                      (!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0) || 
                      !empty($teknis->korban_hewan_aset);
        
        $has_logistik = !empty($arr_armada) || !empty($arr_peralatan) || !empty($teknis->peralatan_lain) || 
                        (!empty($teknis->liter_air) && $teknis->liter_air > 0) || 
                        (!empty($teknis->liter_foam) && $teknis->liter_foam > 0) || 
                        (!empty($teknis->liter_bbm) && $teknis->liter_bbm > 0) || 
                        !empty($teknis->konsumsi_alat);
        
        $show_section_ii = $has_teknis_dasar || $has_detail_lapangan || $has_korban || $has_logistik;

        // ==========================================
        // CHECKER PENAMPILAN BAB III (DOKUMENTASI & EVALUASI)
        // ==========================================
        $has_investigasi = !empty($dokumentasi->dugaan_penyebab) || !empty($dokumentasi->dugaan_penyebab_lainnya) || 
                           !empty($dokumentasi->sumber_api) || (!empty($dokumentasi->luas_area) && $dokumentasi->luas_area > 0);
        
        $has_lintas_sektoral = !empty($arr_instansi) || !empty($dokumentasi->tindakan_instansi) || 
                               !empty($dokumentasi->kontak_saksi) || !empty($dokumentasi->cara_bertindak);
        
        $has_evaluasi = !empty($dokumentasi->kebutuhan_tambahan) || !empty($dokumentasi->saran_mitigasi);
        
        $has_kronologi = !empty($dokumentasi->kronologi_lengkap);

        $show_section_iii = $has_investigasi || $has_lintas_sektoral || $has_evaluasi || $has_kronologi;

        // ==========================================
        // CHECKER PENAMPILAN BAB IV (KATEGORI KHUSUS)
        // ==========================================
        $has_animal = !empty($khusus->jenis_hewan) || !empty($khusus->spesies_hewan) || !empty($khusus->dimensi_hewan) || (!empty($khusus->berat_hewan) && $khusus->berat_hewan > 0) || !empty($khusus->status_hewan_pasca) || !empty($khusus->lokasi_pelepasan);
        $has_pohon = !empty($khusus->jenis_objek_tumbang) || (!empty($khusus->dimensi_objek) && $khusus->dimensi_objek > 0) || !empty($khusus->status_utilitas) || !empty($khusus->dampak_properti);
        $has_water = !empty($khusus->kondisi_perairan) || (!empty($khusus->radius_pencarian) && $khusus->radius_pencarian > 0) || !empty($khusus->metode_pencarian_air) || !empty($khusus->daftar_penyelam);
        $has_ring = !empty($khusus->jenis_benda_bahaya) || !empty($khusus->kondisi_anggota_tubuh) || !empty($khusus->alat_potong_cincin) || !empty($khusus->cuaca_operasi) || !empty($khusus->jenis_medan) || !empty($khusus->akses_lokasi);

        $show_section_iv = $has_animal || $has_pohon || $has_water || $has_ring;
    @endphp

    <!-- ==================== TOPBAR ==================== -->
    <header class="topbar d-print-none">
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
        <aside class="sidebar d-print-none" id="sidebar" aria-label="Navigasi internal">
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
                        <a href="/sapra/sarana-pemeriksaan" class="{{ Request::is('sapra/sarana-pemeriksaan*') ? 'active' : '' }}"><i class="fas fa-search-location"></i> Pemeriksaan Proteksi</a> 
                        <a href="/sapra/kelola-pos" class="{{ Request::is('sapra/kelola-pos*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <span class="side-kicker" style="padding-left:2px;">Manajemen Air</span>
                        <a href="/sapra/data_hidrant_gedung" class="{{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-droplet"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="{{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-location-dot"></i> Data Hidrant Kota</a>

                        <span class="side-kicker" style="padding-left:2px;">Logistik & Distribusi</span>
                        <a href="/sapra/kebutuhan-sarpras" class="{{ Request::is('sapra/kebutuhan-sarpras*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="{{ Request::is('sapra/distribusi-staff*') ? 'active' : '' }}"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                    </div>
                </details>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="side-kicker">Konten publik</div>
                <details class="side-group" {{ Request::is('internal/operator*') ? 'open' : '' }}>
                    <summary><i class="far fa-newspaper grp-ico"></i><span class="grp-label">Manajemen berita</span><i class="fas fa-chevron-down chev"></i></summary>
                    <div class="side-sub">
                        <a href="/internal/operator/kelola-berita" class="{{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="far fa-newspaper"></i> Input &amp; Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="{{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="far fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="{{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </details>
            @endif

            <div class="side-kicker">Akun</div>
            <details class="side-group" {{ Request::is('internal/profil*') || Request::is('internal/kelola-user*') || Request::is('internal/kelola-pemohon*') ? 'open' : '' }}>
                <summary><i class="fas fa-user-gear grp-ico"></i><span class="grp-label">Pengaturan akun</span><i class="fas fa-chevron-down chev"></i></summary>
                <div class="side-sub">
                    <a href="/internal/profil" class="{{ Request::is('internal/profil*') ? 'active' : '' }}"><i class="fas fa-user-pen"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="{{ Request::is('internal/kelola-user*') ? 'active' : '' }}"><i class="fas fa-users-gear"></i> Kelola Semua Pengguna</a>
                        <a href="/internal/kelola-pemohon" class="{{ Request::is('internal/kelola-pemohon*') ? 'active' : '' }}"><i class="fas fa-address-book"></i> Kelola Akun Pemohon</a>
                    @endif
                </div>
            </details>
        </aside>

        <!-- ==================== KONTEN UTAMA ==================== -->
        <main class="content">
            <a href="/internal/damtan/data-laporan" class="back-link d-print-none"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <div class="page-head d-print-none mt-2">
                <h1 class="page-title">Rincian Laporan Tervalidasi</h1>
            </div>

            <div class="card-custom" id="report-content">
                
                <!-- KOP SURAT PDF -->
                <div id="pdf-header" style="display: none;">
                    <table class="tabel-kop">
                        <tr>
                            <td style="width: 15%; text-align: left;">
                                <img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi">
                            </td>
                            <td style="width: 70%;" class="kop-text">
                                <h2>PEMERINTAH KOTA JAMBI</h2>
                                <h1>DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</h1>
                                <p>Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</p>
                            </td>
                            <td style="width: 15%; text-align: right;">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar">
                            </td>
                        </tr>
                    </table>
                    
                    <div class="garis-kop"></div>

                    <div class="judul-laporan">
                        <h3>LAPORAN DATA PENYELAMATAN & KEBAKARAN</h3>
                    </div>
                </div>

                <!-- TAB 1: INFORMASI DASAR -->
                <div class="section-header" style="margin-top: 0;"><h3>I. Informasi Dasar & Lokasi</h3></div>
                
                <div class="pdf-grid">
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hashtag"></i></div>
                            <div class="data-label">Nomor Laporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->nomor_laporan }}</div>
                        </div>
                    </div>

                    @if(!empty($laporan->kategori_kejadian))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-layer-group"></i></div>
                            <div class="data-label">Kategori Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->kategori_kejadian) }}</div>
                        </div>
                    </div>
                    @endif

                    @php $kategori_sub = $laporan->kategori_kebakaran ?? $laporan->kategori_non_kebakaran; @endphp
                    @if(!empty($kategori_sub))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire"></i></div>
                            <div class="data-label">Sub-Kategori</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $kategori_sub) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->rincian_kategori_non_kebakaran))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Rincian Kategori</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->rincian_kategori_non_kebakaran }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->prioritas))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-circle"></i></div>
                            <div class="data-label">Tingkat Prioritas</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ $laporan->prioritas }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->nama_pelapor))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user"></i></div>
                            <div class="data-label">Nama Pelapor</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->nama_pelapor }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->media_pelaporan))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-headset"></i></div>
                            <div class="data-label">Media Pelaporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $laporan->media_pelaporan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->alamat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-map-signs"></i></div>
                            <div class="data-label">Alamat Kejadian</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->alamat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->koordinat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-location-arrow"></i></div>
                            <div class="data-label">Titik Koordinat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->koordinat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->jarak_tempuh) && $laporan->jarak_tempuh > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Jarak Tempuh</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $laporan->jarak_tempuh }} Km</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Data Waktu Operasional</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->waktu_kejadian))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="data-label">Waktu Kejadian</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_terima))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clock"></i></div>
                            <div class="data-label">Terima Laporan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_terima)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_berangkat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck-moving"></i></div>
                            <div class="data-label">Berangkat Unit</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_berangkat)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_tiba))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="data-label">Tiba di Lokasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_tiba)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_selesai))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-flag-checkered"></i></div>
                            <div class="data-label">Operasi Selesai</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_selesai)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_kembali))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Kembali ke Mako</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ \Carbon\Carbon::parse($laporan->waktu_kembali)->format('d M Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- TAB 2: TEKNIS & LOGISTIK -->
                @if($show_section_ii)
                <div class="section-header"><h3>II. Teknis Penyelamatan & Logistik Operasi</h3></div>

                @if($has_teknis_dasar)
                <div class="pdf-grid">
                    @if(!empty($teknis->pimpinan_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="data-label">Pimpinan Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->pimpinan_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->pendamping_operasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-friends"></i></div>
                            <div class="data-label">Pendamping Operasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->pendamping_operasi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->satuan_tugas))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users-cog"></i></div>
                            <div class="data-label">Satuan Tugas / Regu</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->satuan_tugas }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->tim_respontime))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-stopwatch"></i></div>
                            <div class="data-label">Tim Respon Time</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->tim_respontime }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->status_evakuasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="data-label">Status Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $teknis->status_evakuasi) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($arr_evakuasi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-route"></i></div>
                            <div class="data-label">Metode Evakuasi</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', implode(', ', $arr_evakuasi)) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($arr_penyelamatan))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Met. Penyelamatan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', implode(', ', $arr_penyelamatan)) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->objek_terdampak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                            <div class="data-label">Objek Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->objek_terdampak }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($teknis->jumlah_personel) && $teknis->jumlah_personel > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-users"></i></div>
                            <div class="data-label">Jumlah Anggota</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->jumlah_personel }} Personel</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->daftar_personel))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-tag"></i></div>
                            <div class="data-label">Anggota Terlibat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->daftar_personel }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_detail_lapangan)
                <div class="pdf-grid">
                    @if(!empty($teknis->langkah_penanganan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tasks"></i></div>
                            <div class="data-label">Langkah Penanganan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->langkah_penanganan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->hambatan_lapangan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="data-label">Hambatan Lapangan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->hambatan_lapangan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->hasil_tindakan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-check-double"></i></div>
                            <div class="data-label">Hasil Tindakan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->hasil_tindakan }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_korban)
                <div class="sub-header">Data Korban & Aset</div>
                <div class="pdf-grid">
                    @if(!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-check"></i></div>
                            <div class="data-label">Korban Selamat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_selamat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-injured"></i></div>
                            <div class="data-label">Korban Luka Ringan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_ringan }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_berat) && $teknis->korban_berat > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-procedures"></i></div>
                            <div class="data-label">Korban Luka Berat</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_berat }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-user-times"></i></div>
                            <div class="data-label">Korban Meninggal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-danger">{{ $teknis->korban_meninggal }} Jiwa</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_hewan_aset))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-cat"></i></div>
                            <div class="data-label">Korban Hewan/Aset</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->korban_hewan_aset }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_logistik)
                <div class="sub-header">Alat & Logistik Terpakai</div>
                <div class="pdf-grid">
                    @if(!empty($arr_armada))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-truck"></i></div>
                            <div class="data-label">Armada Diturunkan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', implode(', ', $arr_armada)) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($arr_peralatan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-toolbox"></i></div>
                            <div class="data-label">Peralatan Khusus</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ implode(', ', $arr_peralatan) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->peralatan_lain))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tools"></i></div>
                            <div class="data-label">Peralatan Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->peralatan_lain }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_air) && $teknis->liter_air > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-tint"></i></div>
                            <div class="data-label">Konsumsi Air</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_air }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_foam) && $teknis->liter_foam > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-soap"></i></div>
                            <div class="data-label">Konsumsi Foam</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_foam }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_bbm) && $teknis->liter_bbm > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-gas-pump"></i></div>
                            <div class="data-label">Konsumsi BBM</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->liter_bbm }} Liter</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($teknis->konsumsi_alat))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-spray-can"></i></div>
                            <div class="data-label">Konsumsi Alat Umum</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $teknis->konsumsi_alat }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                @endif <!-- End Section II -->

                <!-- TAB 3: DOKUMENTASI & EVALUASI -->
                @if($show_section_iii)
                <div class="section-header" style="margin-top: 20px;"><h3>III. Analisis, Evaluasi & Dokumentasi Kejadian</h3></div>

                @if($has_investigasi)
                <div class="sub-header">Investigasi Lapangan</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->dugaan_penyebab))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-bolt"></i></div>
                            <div class="data-label">Dugaan Penyebab</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-capitalize">{{ str_replace('_', ' ', $dokumentasi->dugaan_penyebab) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->dugaan_penyebab_lainnya))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-search"></i></div>
                            <div class="data-label">Penyebab Lainnya</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->dugaan_penyebab_lainnya }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->sumber_api))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-fire-alt"></i></div>
                            <div class="data-label">Sumber Api / Awal</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->sumber_api }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->luas_area) && $dokumentasi->luas_area > 0)
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-ruler-combined"></i></div>
                            <div class="data-label">Luas Area Terdampak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->luas_area }} m²</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_lintas_sektoral)
                <div class="sub-header">Kerjasama Lintas Sektoral</div>
                <div class="pdf-grid">
                    @if(!empty($arr_instansi))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-building"></i></div>
                            <div class="data-label">Instansi Pendukung</div>
                            <div class="data-colon">:</div>
                            <div class="data-value text-uppercase">{{ strtoupper(str_replace('_', ' ', implode(', ', $arr_instansi))) }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->tindakan_instansi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="data-label">Tindakan Instansi Lain</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->tindakan_instansi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->kontak_saksi))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="data-label">Kontak Saksi/Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kontak_saksi }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->cara_bertindak))
                    <div class="pdf-item">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div class="data-label">Cara Bertindak</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->cara_bertindak }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_evaluasi)
                <div class="sub-header">Evaluasi Pasca Operasi</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->kebutuhan_tambahan))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-plus-circle"></i></div>
                            <div class="data-label">Kebutuhan Tambahan</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kebutuhan_tambahan }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->saran_mitigasi))
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-lightbulb"></i></div>
                            <div class="data-label">Saran Mitigasi Warga</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->saran_mitigasi }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($has_kronologi)
                <div class="pdf-grid">
                    <div class="pdf-item-full">
                        <div class="data-row">
                            <div class="data-icon"><i class="fas fa-align-left"></i></div>
                            <div class="data-label">Kronologi Lengkap</div>
                            <div class="data-colon">:</div>
                            <div class="data-value">{{ $dokumentasi->kronologi_lengkap }}</div>
                        </div>
                    </div>
                </div>
                @endif
                @endif <!-- End Section III -->

                <!-- TAB 4: KATEGORI KHUSUS -->
                @if($show_section_iv)
                <div class="section-header"><h3>IV. Rincian Modul Kategori Khusus</h3></div>

                    @if($has_animal)
                    <div class="sub-header"><i class="fas fa-paw me-2"></i>Data Animal Rescue</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-paw"></i></div>
                                <div class="data-label">Jenis Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ $khusus->jenis_hewan }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($khusus->spesies_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-tag"></i></div>
                                <div class="data-label">Spesies / Lokal</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->spesies_hewan }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dimensi_hewan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ruler"></i></div>
                                <div class="data-label">Dimensi / Panjang</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dimensi_hewan }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($khusus->berat_hewan) && $khusus->berat_hewan > 0)
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-balance-scale"></i></div>
                                <div class="data-label">Berat Hewan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->berat_hewan }} Kg</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->status_hewan_pasca))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-share-square"></i></div>
                                <div class="data-label">Status Evakuasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', 'hak', $khusus->status_hewan_pasca) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->lokasi_pelepasan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="data-label">Lokasi Pelepasan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->lokasi_pelepasan }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($has_pohon)
                    <div class="sub-header"><i class="fas fa-tree me-2"></i>Data Objek Tumbang/Bangunan</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_objek_tumbang))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cube"></i></div>
                                <div class="data-label">Jenis Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_objek_tumbang) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dimensi_objek) && $khusus->dimensi_objek > 0)
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                                <div class="data-label">Dimensi Objek</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dimensi_objek }} cm</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->status_utilitas))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-plug"></i></div>
                                <div class="data-label">Utilitas Terkait</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_utilitas) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->dampak_properti))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-house-damage"></i></div>
                                <div class="data-label">Dampak Properti</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->dampak_properti }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($has_water)
                    <div class="sub-header"><i class="fas fa-water me-2"></i>Data Water Rescue</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->kondisi_perairan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-water"></i></div>
                                <div class="data-label">Kondisi Perairan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_perairan) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->radius_pencarian) && $khusus->radius_pencarian > 0)
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-search-location"></i></div>
                                <div class="data-label">Radius Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->radius_pencarian }} meter</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->metode_pencarian_air))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-binoculars"></i></div>
                                <div class="data-label">Metode Pencarian</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->metode_pencarian_air) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->daftar_penyelam))
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-swimmer"></i></div>
                                <div class="data-label">Daftar Penyelam</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->daftar_penyelam }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($has_ring)
                    <div class="sub-header"><i class="fas fa-ring me-2"></i>Data Pelepasan Cincin & Geografis Lapangan</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_benda_bahaya))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-ring"></i></div>
                                <div class="data-label">Jenis Benda</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">{{ $khusus->jenis_benda_bahaya }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->kondisi_anggota_tubuh))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-hand-paper"></i></div>
                                <div class="data-label">Kondisi Tubuh</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_anggota_tubuh) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->alat_potong_cincin))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cut"></i></div>
                                <div class="data-label">Alat Potong</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->alat_potong_cincin) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->cuaca_operasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="data-label">Cuaca Operasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->cuaca_operasi) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->jenis_medan))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-mountain"></i></div>
                                <div class="data-label">Jenis Medan</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_medan) }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($khusus->akses_lokasi))
                        <div class="pdf-item">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-road"></i></div>
                                <div class="data-label">Akses Lokasi</div>
                                <div class="data-colon">:</div>
                                <div class="data-value text-capitalize">{{ str_replace('_', ' ', $khusus->akses_lokasi) }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                @endif

                <!-- TAB 5: DOKUMENTASI FOTO & VIDEO -->
                @if(!empty($arr_foto) || !empty($dokumentasi->video))
                <div class="section-header" style="page-break-before: always;"><h3>V. Dokumentasi Lapangan</h3></div>
                
                @if(!empty($arr_foto))
                    <div class="sub-header"><i class="fas fa-camera me-2"></i>Lampiran Foto</div>
                    <div style="display: flex; flex-wrap: wrap; gap: 15px; width: 100%; margin-bottom: 25px;">
                        @foreach($arr_foto as $foto)
                            <div style="width: 48%; border: 1px solid #cbd5e1; border-radius: 8px; overflow: hidden; padding: 4px; background: #fff; page-break-inside: avoid;">
                                <img src="{{ asset('storage/' . $foto) }}" style="width: 100%; height: 250px; object-fit: cover; border-radius: 4px;" alt="Foto Dokumentasi" onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Gambar+Tidak+Ditemukan';">
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(!empty($dokumentasi->video))
                    <div class="sub-header"><i class="fas fa-video me-2"></i>Lampiran Video</div>
                    <div class="pdf-grid">
                        <div class="pdf-item-full">
                            <div class="data-row">
                                <div class="data-icon"><i class="fas fa-file-video"></i></div>
                                <div class="data-label">File Terlampir</div>
                                <div class="data-colon">:</div>
                                <div class="data-value">
                                    <a href="{{ asset('storage/' . $dokumentasi->video) }}" target="_blank" style="color: var(--navy); text-decoration: underline; font-weight: 700;">
                                        <i class="fas fa-external-link-alt me-1"></i> Buka / Download Video
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endif

                <!-- KESIMPULAN -->
                <div class="section-header" style="page-break-before: auto;"><h3>Kesimpulan & Dasar Pelaksanaan</h3></div>
                <div style="font-weight: 600; font-style: italic; color: var(--steel); font-size: 13px; line-height: 1.5; margin-left: 20px; page-break-inside: avoid;">
                    Seluruh kegiatan Pelayanan Penyelamatan dan Pemadaman ini berpedoman pada Peraturan Menteri Dalam Negeri (Permendagri) Nomor 114 Tahun 2018 tentang Standar Teknis Pelayanan Dasar Pada Standar Pelayanan Minimal (SPM) Sub Urusan Kebakaran Daerah Kabupaten/Kota.
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top d-print-none" id="action-buttons-container" data-html2canvas-ignore="true">
                    <div class="dropdown">
                        <button class="btn btn-custom-light shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download me-2"></i> Download Laporan
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="#" onclick="downloadDetailPDF()"><i class="fas fa-file-pdf me-2"></i> Format PDF</a></li>
                            <li><a class="dropdown-item py-2 text-success fw-bold" href="#" onclick="downloadDetailExcel()"><i class="fas fa-file-excel me-2"></i> Format Excel</a></li>
                            <li><a class="dropdown-item py-2 text-primary fw-bold" href="#" onclick="downloadDetailWord()"><i class="fas fa-file-word me-2"></i> Format Word</a></li>
                        </ul>
                    </div>
                    <a href="/internal/damtan/edit-data/{{ $laporan->id }}" class="btn btn-custom-edit shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Data Ini
                    </a>
                </div>
            </div>
        </main>
    </div>

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

        function downloadDetailPDF() {
            window.scrollTo(0, 0);

            const element = document.getElementById('report-content');
            const pdfHeader = document.getElementById('pdf-header');
            const btnContainer = document.getElementById('action-buttons-container');
            const topbar = document.querySelector('.topbar');
            const sidebar = document.querySelector('.sidebar');
            const backLink = document.querySelector('.back-link');
            const pageHead = document.querySelector('.page-head');

            pdfHeader.style.display = 'block'; 
            btnContainer.style.display = 'none';
            if(topbar) topbar.style.display = 'none';
            if(sidebar) sidebar.style.display = 'none';
            if(backLink) backLink.style.display = 'none';
            if(pageHead) pageHead.style.display = 'none';

            const originalPadding = element.style.padding;
            const originalMargin = element.style.margin;
            const originalShadow = element.style.boxShadow;
            const originalBorder = element.style.border;
            element.style.padding = '10px 20px';
            element.style.margin = '0px';
            element.style.boxShadow = 'none';
            element.style.border = 'none';

            let nomorLaporan = "{{ $laporan->nomor_laporan }}";
            let filename = "Laporan_Penyelamatan_Lengkap_" + nomorLaporan + ".pdf";

            const opt = {
                margin:       [15, 10, 15, 10], 
                filename:     filename,
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true, scrollY: 0 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                /* Konfigurasi ketat agar blok div tidak dipotong paksa oleh page break */
                pagebreak:    { mode: ['css', 'legacy'], avoid: ['.pdf-item', '.pdf-item-full', '.section-header', '.sub-header', '.data-row'] } 
            };

            setTimeout(() => {
                html2pdf().set(opt).from(element).save().then(() => {
                    pdfHeader.style.display = 'none';
                    btnContainer.style.display = 'flex';
                    if(topbar) topbar.style.display = 'flex';
                    if(sidebar) sidebar.style.display = 'block';
                    if(backLink) backLink.style.display = 'inline-flex';
                    if(pageHead) pageHead.style.display = 'block';
                    
                    element.style.padding = originalPadding;
                    element.style.margin = originalMargin;
                    element.style.boxShadow = originalShadow;
                    element.style.border = originalBorder;
                });
            }, 500); 
        }

        function downloadDetailExcel() {
            let tableHTML = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            tableHTML += '<head><meta charset="utf-8"></head><body>';
            tableHTML += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-family: Arial, sans-serif;">';
            
            tableHTML += '<tr><th colspan="2" style="background-color: #111827; color: #ffffff; font-size: 16px; height: 30px; text-align: center;">LAPORAN DATA PENYELAMATAN & KEBAKARAN</th></tr>';
            tableHTML += '<tr><th colspan="2" style="background-color: #10b981; color: #ffffff; height: 25px; text-align: center;">Nomor Laporan: {{ $laporan->nomor_laporan }}</th></tr>';
            
            tableHTML += '<tr>';
            tableHTML += '<th style="background-color: #f3f4f6; width: 200px; text-align: left;">Atribut Informasi</th>';
            tableHTML += '<th style="background-color: #f3f4f6; width: 400px; text-align: left;">Nilai / Data Laporan</th>';
            tableHTML += '</tr>';
            
            let rows = document.querySelectorAll('.data-row');
            
            rows.forEach(row => {
                let labelEl = row.querySelector('.data-label');
                let valueEl = row.querySelector('.data-value');
                if(labelEl && valueEl) {
                    let label = labelEl.innerText.trim();
                    let value = valueEl.innerText.trim();
                    if(label && value) {
                        tableHTML += `<tr><td style="font-weight: bold;">${label}</td><td>${value}</td></tr>`;
                    }
                }
            });

            tableHTML += '</table></body></html>';

            let filename = "Laporan_Penyelamatan_Lengkap_{{ $laporan->nomor_laporan }}.xls";
            let blob = new Blob([tableHTML], { type: "application/vnd.ms-excel" });
            
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function downloadDetailWord() {
            let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Rincian Laporan</title></head><body style='font-family: Arial, sans-serif;'>";
            let footer = "</body></html>";
            
            let content = "<div style='text-align:center; margin-bottom: 20px;'>";
            content += "<h2 style='margin:0; padding:0; font-family: Arial, sans-serif;'>LAPORAN DATA PENYELAMATAN & KEBAKARAN</h2>";
            content += "<p style='margin:5px 0 0 0; font-size: 14px; font-family: Arial, sans-serif; color: #4b5563;'>Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>";
            content += "</div>";
            content += "<hr style='border: 1px solid black; margin-bottom: 20px;'>";
            
            content += "<table border='1' cellpadding='6' cellspacing='0' style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 13px;'>";
            
            let rows = document.querySelectorAll('.data-row');
            rows.forEach(row => {
                let labelEl = row.querySelector('.data-label');
                let valueEl = row.querySelector('.data-value');
                if(labelEl && valueEl) {
                    let label = labelEl.innerText.trim();
                    let value = valueEl.innerText.trim();
                    if(label && value) {
                        content += `<tr>
                            <td style='width: 35%; font-weight: bold; background-color: #f3f4f6; vertical-align: top; padding: 8px;'>${label}</td>
                            <td style='width: 65%; vertical-align: top; padding: 8px;'>${value}</td>
                        </tr>`;
                    }
                }
            });
            content += "</table>";

            let photos = document.querySelectorAll('img[src*="/storage/"]');
            let video = document.querySelector('a[href*="/storage/"]');

            if(photos.length > 0 || video) {
                content += "<h3 style='margin-top: 30px; font-family: Arial, sans-serif; border-bottom: 1px solid #ccc; padding-bottom: 5px;'>V. Dokumentasi Lapangan</h3>";
                
                if(photos.length > 0) {
                    content += "<div style='text-align: center; margin-bottom: 20px;'>";
                    photos.forEach(img => {
                        let imageUrl = img.src; 
                        content += `<img src="${imageUrl}" style="width: 300px; height: auto; margin: 10px; border: 2px solid #ccc;" />`;
                    });
                    content += "</div>";
                }

                if(video) {
                    content += `<p style='font-family: Arial, sans-serif; font-size: 13px;'><strong>Tautan Video Terlampir:</strong> <br> <a href="${video.href}" style="color: #0284c7;">${video.href}</a></p>`;
                }
            }
            
            let blob = new Blob(['\ufeff', header + content + footer], { type: 'application/msword' });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "Laporan_Penyelamatan_Lengkap_{{ $laporan->nomor_laporan }}.doc";
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>