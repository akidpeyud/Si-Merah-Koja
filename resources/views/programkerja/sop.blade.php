<?php
    use App\Models\Dokumen;

    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN PROGRAM KERJA
       ------------------------------------------------------------ */
    $tabs = [
        'sotk'        => ['url' => '/sotk',        'label' => 'SOTK',         'ico' => 'fa-sitemap',        'judul' => 'Struktur Organisasi dan Tata Kerja (SOTK)'],
        'sop'         => ['url' => '/sop',         'label' => 'SOP',          'ico' => 'fa-list-check',     'judul' => 'Standar Operasional Prosedur (SOP)'],
        'perencanaan' => ['url' => '/perencanaan', 'label' => 'Perencanaan',  'ico' => 'fa-bullseye',       'judul' => 'Dokumen perencanaan'],
        'pelaporan'   => ['url' => '/pelaporan',   'label' => 'Pelaporan',    'ico' => 'fa-file-lines',     'judul' => 'Dokumen pelaporan'],
        'produkhukum' => ['url' => '/produkhukum', 'label' => 'Produk hukum', 'ico' => 'fa-scale-balanced', 'judul' => 'Produk hukum'],
    ];
    $tab_aktif = 'sop';

    // ============================================================
    // AMBIL DATA DARI DATABASE DOKUMEN SOP
    // ============================================================
    $dokumenDB = Dokumen::whereIn('kategori', ['Pemadaman Kebakaran', 'Penyelamatan & Evakuasi', 'Penyelamatan dan Evakuasi', 'SOP'])
                        ->latest()
                        ->get();

    $dokumen_list = [];
    foreach ($dokumenDB as $doc) {
        $kat = $doc->kategori;
        $sub = $doc->sub_kategori;

        // Tentukan grup kategori: 'pemadaman' atau 'penyelamatan'
        $grup = 'pemadaman';
        if (
            str_contains(strtolower($kat), 'penyelamatan') ||
            str_contains(strtolower($kat), 'evakuasi') ||
            str_contains(strtolower((string)$sub), 'penyelamatan') ||
            str_contains(strtolower((string)$sub), 'evakuasi')
        ) {
            $grup = 'penyelamatan';
        }

        $dokumen_list[] = [
            'id'           => $doc->id,
            'judul'        => $doc->judul_dokumen,
            'kategori'     => $kat,
            'grup'         => $grup,
            'url'          => url('/dokumen/view/' . $doc->id), 
            'url_download' => url('/dokumen/download/' . $doc->id),
            'ext'          => pathinfo($doc->nama_file, PATHINFO_EXTENSION) ?: 'PDF'
        ];
    }

    $totalPemadaman = count(array_filter($dokumen_list, fn($d) => $d['grup'] === 'pemadaman'));
    $totalPenyelamatan = count(array_filter($dokumen_list, fn($d) => $d['grup'] === 'penyelamatan'));
    $jumlah = count($dokumen_list);

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
    $play_store_url = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Standar Operasional Prosedur (SOP) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>SOP - Program Kerja | SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ink: #0d1b2a;
            --ink-2: #132a43;
            --ink-3: #1d3856;
            --paper: #f3f5f8;
            --white: #ffffff;
            --signal: #e5392d;
            --signal-d: #c22b20;
            --amber: #ffb627;
            --steel: #5b6c7f;
            --line: #dbe2ea;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 28px;
            --r-md: 18px;
            --r-sm: 10px;
            --wrap: 1300px;
            --header-h: 64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.65;
            color: var(--ink);
            background: var(--white);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* ==========================================================
           HEADER & NAVBAR
           ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 1000;
            background: rgba(13, 27, 42, .88);
            -webkit-backdrop-filter: blur(14px) saturate(1.4);
            backdrop-filter: blur(14px) saturate(1.4);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            max-width: 1440px; margin: 0 auto; min-height: var(--header-h);
            padding: 0 clamp(16px, 3vw, 32px);
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
        }
        .brand { display: flex; align-items: center; flex: none; gap: 12px; }
        .brand img { height: 36px; width: auto; }
        .menu { display: flex; align-items: center; justify-content: center; gap: 4px; flex: 1; min-width: 0; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 14px; border-radius: 999px; font-weight: 600; font-size: .92rem;
            color: rgba(255,255,255,.82); transition: background .2s, color .2s;
        }
        .menu-link:hover, .menu-trigger:hover, .menu > li.current > .menu-trigger, .menu > li.current > .menu-link {
            background: rgba(255,255,255,.1); color: #fff;
        }
        .menu-trigger i { font-size: .75rem; transition: transform .25s ease; opacity: .7; }
        .menu > li.open > .menu-trigger i { transform: rotate(180deg); }
        .dropdown {
            position: absolute; top: calc(100% + 8px); left: 0; min-width: 220px;
            padding: 8px; border-radius: 16px; background: var(--ink);
            border: 1px solid rgba(255,255,255,.12); box-shadow: 0 16px 36px rgba(0,0,0,.35);
            opacity: 0; visibility: hidden; transform: translateY(8px);
            transition: opacity .2s, transform .2s, visibility .2s;
            display: flex; flex-direction: column; gap: 2px; z-index: 100;
        }
        .menu > li.open .dropdown { opacity: 1; visibility: visible; transform: none; }
        .dropdown a {
            display: block; padding: 9px 14px; border-radius: 10px;
            font-size: .88rem; font-weight: 500; color: rgba(255,255,255,.78);
            transition: background .2s, color .2s;
        }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.1); color: #fff; }
        .dropdown a[aria-current="page"] { font-weight: 700; color: var(--amber); }

        .btn-login {
            background: rgba(255,255,255,.12); color: #fff; border: 1px solid rgba(255,255,255,.2);
            padding: 7px 16px; font-weight: 600; font-size: .88rem;
        }
        .btn-login:hover { background: #fff; color: var(--ink); border-color: #fff; }

        .nav-toggle {
            display: none; width: 42px; height: 42px; border-radius: 10px;
            color: #fff; font-size: 1.25rem; place-items: center;
        }

        @media (max-width: 991px) {
            .nav-toggle { display: grid; }
            .menu {
                position: fixed; inset: var(--header-h) 0 0; background: var(--ink);
                flex-direction: column; align-items: stretch; justify-content: flex-start;
                padding: 20px; overflow-y: auto; gap: 6px;
                opacity: 0; visibility: hidden; transition: opacity .25s, visibility .25s;
            }
            .site-header.nav-open .menu { opacity: 1; visibility: visible; }
            .dropdown { position: static; opacity: 1; visibility: visible; transform: none; box-shadow: none; border: 0; padding-left: 14px; display: none; }
            .menu > li.open .dropdown { display: flex; }
        }

        /* ==========================================================
           HERO SECTION
           ========================================================== */
        .page-hero {
            position: relative; background: var(--ink); color: #fff;
            padding: clamp(48px, 8vw, 84px) 0 clamp(64px, 10vw, 108px);
            overflow: hidden;
        }
        .page-hero::before {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background:
                radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%),
                linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%),
                url('/images/background1.png') center / cover no-repeat;
        }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 28px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 600; }
        .page-hero h1 {
            font-family: var(--font-display); font-weight: 800; font-stretch: 82%;
            font-size: clamp(2.5rem, 7vw, 5rem); line-height: .98; letter-spacing: -0.035em;
        }
        .page-hero p { margin-top: 18px; max-width: 58ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           TAB NAVIGASI PROGRAM KERJA (ATAS)
           ========================================================== */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .tabs-wrap { position: relative; z-index: 2; margin-top: -30px; text-align: center; }
        .tabs {
            display: inline-flex; flex-wrap: nowrap; gap: 4px; padding: 6px;
            max-width: 100%; background: #fff; border: 1px solid var(--line);
            border-radius: 999px; box-shadow: 0 18px 36px -20px rgba(13,27,42,.45);
            overflow-x: auto; scrollbar-width: none; text-align: left;
        }
        .tabs::-webkit-scrollbar { display: none; }
        .tab {
            flex: 0 0 auto; display: inline-flex; align-items: center; gap: 8px; white-space: nowrap;
            padding: 10px 18px; border-radius: 999px; font-weight: 600; font-size: .88rem; color: var(--steel);
            transition: background .2s, color .2s;
        }
        .tab i { font-size: .9rem; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-current="page"] { background: var(--ink); color: #fff; }
        .tab[aria-current="page"] i { color: var(--amber); }

        @media (max-width: 991px) {
            .tabs-wrap { text-align: left; }
            .tabs { width: 100%; }
        }

        /* ==========================================================
           PANEL DOKUMEN & DUA TAB SUB-KATEGORI SOP
           ========================================================== */
        .doc-layout { display: grid; gap: 24px; margin-top: 28px; }

        .doc-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: 0 4px 18px rgba(13,27,42,.04); }
        .doc-bar {
            display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;
            gap: 16px 20px; padding: 18px clamp(16px, 2.5vw, 28px); border-bottom: 1px solid var(--line);
        }
        .doc-title { display: flex; align-items: center; gap: 12px; font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; }
        .doc-title i {
            width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center;
            background: var(--ink); color: var(--amber); font-size: 1rem;
        }

        /* DUA TAB KATEGORI SOP (UI INTERAKTIF) */
        .sop-categories-nav {
            padding: 14px clamp(16px, 2.5vw, 28px);
            background: #f8fafc;
            border-bottom: 1px solid var(--line);
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }
        .sop-cat-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 14px;
            background: #fff;
            color: var(--steel);
            border: 1.5px solid var(--line);
            font-family: var(--font-body);
            font-weight: 700;
            font-size: .93rem;
            cursor: pointer;
            transition: all .2s ease;
        }
        .sop-cat-btn i { font-size: 1rem; }
        .sop-cat-btn .badge-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 24px;
            padding: 0 8px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            background: #e2e8f0;
            color: var(--ink);
            transition: all .2s ease;
        }
        .sop-cat-btn:hover {
            border-color: #cbd5e1;
            color: var(--ink);
            background: #f1f5f9;
        }
        .sop-cat-btn.active {
            background: var(--ink);
            color: #fff;
            border-color: var(--ink);
            box-shadow: 0 6px 16px rgba(13,27,42,.22);
        }
        .sop-cat-btn.active[data-target="pemadaman"] i { color: #f87171; }
        .sop-cat-btn.active[data-target="penyelamatan"] i { color: #38bdf8; }
        .sop-cat-btn.active .badge-pill {
            background: rgba(255,255,255,.2);
            color: #fff;
        }

        .doc-filter { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
        .doc-count { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }
        .doc-search { position: relative; display: block; }
        .doc-search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .doc-search input {
            width: min(300px, 100%); height: 40px; padding: 0 16px 0 40px;
            border: 1px solid var(--line); border-radius: 999px; background: #fff;
            font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s;
        }
        .doc-search input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.4); }

        .doc-row {
            position: relative; display: grid; grid-template-columns: 52px minmax(0, 1fr) auto;
            gap: 18px; align-items: center; padding: 18px clamp(16px, 2.5vw, 26px);
            border-bottom: 1px solid var(--line); transition: background .2s;
        }
        .doc-row:last-child { border-bottom: 0; }
        .doc-row[hidden] { display: none !important; }
        .doc-row:hover { background: var(--paper); }
        .doc-ico {
            width: 52px; height: 52px; border-radius: 14px; display: grid; place-items: center;
            background: #fdeceb; color: var(--signal-d); font-size: 1.4rem;
        }
        .doc-ico.ico-rescue {
            background: #e0f2fe; color: #0284c7;
        }
        .doc-name { font-family: var(--font-display); font-weight: 600; font-size: 1.05rem; line-height: 1.4; color: var(--ink); }
        .doc-name a:hover { color: var(--signal-d); text-decoration: underline; }
        .doc-meta { margin-top: 3px; font-size: .82rem; color: var(--steel); display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .doc-meta .tag-cat {
            display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: .75rem; font-weight: 700;
            background: #f1f5f9; color: var(--steel);
        }
        .doc-meta .tag-cat.pemadaman { background: #fee2e2; color: #991b1b; }
        .doc-meta .tag-cat.penyelamatan { background: #e0f2fe; color: #0369a1; }

        .doc-actions { position: relative; z-index: 1; display: flex; gap: 8px; }
        .tool {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            min-width: 40px; height: 40px; padding: 0 16px; border-radius: 999px;
            background: var(--paper); font-size: .88rem; font-weight: 600; transition: all .2s;
        }
        .tool:hover { background: var(--ink); color: #fff; }
        .tool.download { background: #163a63; color: #fff; }
        .tool.download:hover { background: #0d1b2a; }

        .doc-none, .doc-empty { text-align: center; color: var(--steel); padding: 48px 24px; }
        .doc-empty i { font-size: 2.4rem; color: #cbd5e1; margin-bottom: 12px; display: block; }
        .doc-empty h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.25rem; color: var(--ink); margin-bottom: 6px; }

        @media (max-width: 640px) {
            .doc-row { grid-template-columns: 52px minmax(0, 1fr); align-items: start; }
            .doc-actions { grid-column: 1 / -1; width: 100%; }
            .doc-actions .tool { flex: 1; }
            .sop-cat-btn { flex: 1 1 calc(50% - 6px); justify-content: center; padding: 10px 12px; font-size: .85rem; }
        }

        /* Kontak & Footer */
        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(20px, 3vw, 28px); }
        .side-card h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.35rem; margin-bottom: 20px; }
        .contact-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px 32px; }
        .contact-list li { display: grid; grid-template-columns: 40px 1fr; gap: 14px; align-items: start; }
        .c-ico { width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }
        .contact-list small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; }
        .contact-list span, .contact-list a { font-weight: 600; font-size: .95rem; }

        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        @media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <a href="/" class="brand" aria-label="SIMERAH KOJA, beranda">
            <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="menu" id="menu">
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan kedaruratan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="<?= $h($wa_link) ?>" target="_blank" rel="noopener">WhatsApp</a></li>
                    <li><a href="tel:<?= $h($no_telepon) ?>">Telepon</a></li>
                    <li><a href="tel:112">Call Center 112</a></li>
                </ul>
            </li>
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Program kerja <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <?php foreach (['sotk', 'perencanaan', 'pelaporan', 'sop', 'produkhukum'] as $k): ?>
                        <li><a href="<?= $h($tabs[$k]['url']) ?>" <?php if ($k === $tab_aktif): ?> aria-current="page" <?php endif; ?>><?= $h($tabs[$k]['label']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan<i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK &amp; Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/public-sigap">SIGAP</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Kabar Damkar <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/edu-damkar">Edu Damkar</a></li>
                    <li><a href="/infografis">Infografis</a></li>
                    <li><a href="/media-informasi">Media Informasi</a></li>
                    <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>
            @if(session()->has('pemohon_id'))
                <li class="has-drop">
                    <button class="menu-trigger btn-login" type="button" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ strtok(session('pemohon_nama'), " ") }} <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown">
                        <li>
                            <form action="{{ route('pemohon.logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-logout" style="background:transparent; border:none; color:#fff; cursor:pointer; padding:9px 14px;">
                                    <i class="fas fa-sign-out-alt"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li><a class="menu-link btn-login" href="{{ route('pemohon.login') }}">Masuk</a></li>
            @endif
        </ul>
    </nav>
</header>

<main>

<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/sotk">Program kerja</a></li>
                <li><span aria-current="page">Standar Operasional Prosedur (SOP)</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">SOP Dinas</h1>
        <p class="rise d2">Standar Operasional Prosedur pelaksanaan tugas pemadaman kebakaran, penyelamatan, dan penanggulangan kedaruratan Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
    @include('layouts.partials.hero-logos', ['float' => true])
</section>

<div class="page-body">
    <!-- TAB NAVIGASI PROGRAM KERJA -->
    <div class="wrap tabs-wrap">
        <nav class="tabs" aria-label="Kategori program kerja">
            <?php foreach ($tabs as $key => $tab): ?>
                <a class="tab" href="<?= $h($tab['url']) ?>" <?php if ($key === $tab_aktif): ?> aria-current="page" <?php endif; ?>>
                    <i class="fas <?= $h($tab['ico']) ?>"></i> <?= $h($tab['label']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="wrap">
        <div class="doc-layout">

            <!-- DAFTAR DOKUMEN SOP -->
            <section class="doc-panel" aria-label="Daftar Dokumen SOP">
                <div class="doc-bar">
                    <div class="doc-title">
                        <i class="fas fa-file-shield"></i>
                        <span>Standar Operasional Prosedur</span>
                    </div>
                    <div class="doc-filter">
                        <span class="doc-count" id="docCount" aria-live="polite"><?= (int) $jumlah ?> dokumen</span>
                        <label class="doc-search">
                            <span class="sr-only">Cari dokumen</span>
                            <i class="fas fa-search"></i>
                            <input type="search" id="docSearch" placeholder="Cari dokumen SOP..." autocomplete="off">
                        </label>
                    </div>
                </div>

                <!-- DUA MENU TAB UI KATEGORI SOP -->
                <div class="sop-categories-nav" role="tablist">
                    <button type="button" class="sop-cat-btn active" role="tab" aria-selected="true" data-target="pemadaman">
                        <i class="fas fa-fire-extinguisher"></i>
                        <span>Pemadaman Kebakaran</span>
                        <span class="badge-pill" id="badgePemadaman"><?= $totalPemadaman ?></span>
                    </button>
                    <button type="button" class="sop-cat-btn" role="tab" aria-selected="false" data-target="penyelamatan">
                        <i class="fas fa-life-ring"></i>
                        <span>Penyelamatan &amp; Evakuasi</span>
                        <span class="badge-pill" id="badgePenyelamatan"><?= $totalPenyelamatan ?></span>
                    </button>
                </div>

                <!-- LIST DOKUMEN -->
                <?php if ($jumlah): ?>
                <ul class="doc-list" id="docList">
                    <?php foreach ($dokumen_list as $d):
                        $judul        = (string) $d['judul'];
                        $url          = (string) $d['url'];
                        $url_download = (string) $d['url_download'];
                        $grup         = (string) $d['grup'];
                        $isRescue     = $grup === 'penyelamatan';
                        $labelKat     = $isRescue ? 'Penyelamatan & Evakuasi' : 'Pemadaman Kebakaran';
                    ?>
                    <li class="doc-row" data-category="<?= $grup ?>" data-name="<?= $h(mb_strtolower($judul)) ?>">
                        <span class="doc-ico <?= $isRescue ? 'ico-rescue' : '' ?>">
                            <i class="fas <?= $isRescue ? 'fa-life-ring' : 'fa-file-pdf' ?>"></i>
                        </span>
                        <div>
                            <p class="doc-name">
                                <a href="<?= $h($url) ?>" target="_blank" rel="noopener"><?= $h($judul) ?></a>
                            </p>
                            <div class="doc-meta">
                                <span class="tag-cat <?= $grup ?>"><?= $h($labelKat) ?></span>
                                <span><i class="fas fa-file-pdf"></i> Dokumen PDF</span>
                            </div>
                        </div>
                        <div class="doc-actions">
                            <a class="tool" href="<?= $h($url) ?>" target="_blank" rel="noopener" aria-label="Buka <?= $h($judul) ?>" title="Lihat Dokumen">
                                <i class="fas fa-arrow-up-right-from-square"></i> Buka
                            </a>
                            <a class="tool download" href="<?= $h($url_download) ?>" aria-label="Unduh <?= $h($judul) ?>" title="Unduh File">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <p class="doc-none" id="docNone" hidden>Tidak ada dokumen yang cocok pada kategori ini.</p>
                <?php else: ?>
                <div class="doc-empty">
                    <i class="far fa-folder-open"></i>
                    <h3>Belum ada dokumen</h3>
                    <p>Dokumen SOP akan tampil di sini setelah data diinput.</p>
                </div>
                <?php endif; ?>
            </section>

            <!-- KONTAK DINAS -->
            <aside aria-label="Kontak dinas">
                <div class="side-card">
                    <h2>Kontak dinas</h2>
                    <ul class="contact-list">
                        <li>
                            <span class="c-ico"><i class="fas fa-envelope-open-text"></i></span>
                            <div>
                                <small>Email resmi</small>
                                <a href="mailto:damkar.jbi@gmail.com">damkar.jbi@gmail.com</a>
                            </div>
                        </li>
                        <li>
                            <span class="c-ico"><i class="fas fa-phone-alt"></i></span>
                            <div>
                                <small>Telepon</small>
                                <a href="tel:<?= $h($no_telepon) ?>"><?= $h($telepon_tampil) ?></a>
                            </div>
                        </li>
                        <li>
                            <span class="c-ico"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <small>Alamat kantor</small>
                                <a href="<?= $h($maps_link) ?>" target="_blank" rel="noopener">Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</div>

</main>

<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
                <p>Sistem Informasi Manajemen Kebakaran dan Penyelamatan Kota Jambi. Berkomitmen memberikan pelayanan proteksi dan keselamatan masyarakat Kota Jambi secara profesional.</p>
            </div>
            <div>
                <h3>Informasi &amp; Layanan</h3>
                <p style="font-size: .95rem; line-height: 1.8;">
                    Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi<br>
                    Siap melayani penanganan bahaya kebakaran dan operasi evakuasi / penyelamatan 24 jam sehari.
                </p>
            </div>
            <div>
                <h3>Pengaduan Darurat</h3>
                <p style="font-size: 1.15rem; font-weight: 700; color: #fff; margin-bottom: 6px;">Call Center: 112</p>
                <p style="font-size: 1.05rem; font-weight: 700; color: #ffb627; margin-bottom: 12px;">Telepon: (0741) 41171</p>
                <p style="font-size: .88rem; color: rgba(255,255,255,.6);">Operasi 24 Jam Bebas Pulsa</p>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,.1); margin-top: 48px; padding-top: 24px; text-align: center; font-size: .85rem; color: rgba(255,255,255,.5);">
            &copy; {{ date('Y') }} Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi (SIMERAH KOJA). Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>

<script>
(function () {
    'use strict';

    /* Header Nav dropdown mobile */
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');

    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = header.classList.toggle('nav-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }

    drops.forEach(function (li) {
        var btn = li.querySelector('.menu-trigger');
        if (btn) {
            btn.addEventListener('click', function () {
                var open = li.classList.toggle('open');
                btn.setAttribute('aria-expanded', open);
                drops.forEach(function (o) {
                    if (o !== li) {
                        o.classList.remove('open');
                        var b = o.querySelector('.menu-trigger');
                        if (b) b.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        }
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) {
            drops.forEach(function (o) {
                o.classList.remove('open');
                var b = o.querySelector('.menu-trigger');
                if (b) b.setAttribute('aria-expanded', 'false');
            });
        }
    });

    /* ==========================================================
       TAB FILTER KATEGORI SOP (PEMADAMAN vs PENYELAMATAN)
       ========================================================== */
    var tabBtns = document.querySelectorAll('.sop-cat-btn');
    var rows = document.querySelectorAll('.doc-row');
    var searchInput = document.getElementById('docSearch');
    var countLabel = document.getElementById('docCount');
    var noneNotice = document.getElementById('docNone');
    var currentCategory = 'pemadaman';

    function filterDocuments() {
        var q = searchInput ? searchInput.value.trim().toLowerCase() : '';
        var visibleCount = 0;

        rows.forEach(function (r) {
            var cat = r.dataset.category;
            var name = r.dataset.name || '';
            var matchCategory = (cat === currentCategory);
            var matchQuery = !q || name.indexOf(q) !== -1;

            if (matchCategory && matchQuery) {
                r.hidden = false;
                visibleCount++;
            } else {
                r.hidden = true;
            }
        });

        if (countLabel) {
            countLabel.textContent = visibleCount + ' dokumen';
        }
        if (noneNotice) {
            noneNotice.hidden = (visibleCount > 0);
        }
    }

    tabBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabBtns.forEach(function (b) {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');
            currentCategory = btn.dataset.target;
            filterDocuments();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            filterDocuments();
        });
    }

    // Jalankan filter awal (default: Pemadaman Kebakaran)
    filterDocuments();
})();
</script>
</body>
</html>
