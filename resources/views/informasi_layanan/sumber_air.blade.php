<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };
    $arr = function ($x) { return (is_object($x) && method_exists($x, 'toArray')) ? $x->toArray() : (array) $x; };
    $fileExists = function ($path) {
        if (!$path) { return false; }
        if (function_exists('public_path')) { return file_exists(public_path($path)); }
        return file_exists(rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/') . '/' . ltrim($path, '/'));
    };
    $assetUrl = function ($path) {
        return function_exists('asset') ? asset($path) : '/' . ltrim($path, '/');
    };
    // Link peta: terima URL langsung atau teks/koordinat (dicari di Google Maps)
    $mapHref = function ($v) {
        if (empty($v)) { return null; }
        return str_starts_with($v, 'http') ? $v : 'https://www.google.com/maps/search/?api=1&query=' . urlencode($v);
    };

    $kategori = [
        'pencegahan' => [
            'label' => 'Bagian pencegahan',
            'items' => [],
        ],
        'pemadaman' => [
            'label' => 'Bagian pemadaman',
            'items' => [],
        ],
        'sapra' => [
            'label' => 'Bagian sapra',
            'items' => [
                ['url' => '/informasi-sarana',       'label' => 'Sarana pemadam',      'ico' => 'fa-fire-extinguisher'],
                ['url' => '/informasi-prasarana',    'label' => 'Prasarana pemadam',   'ico' => 'fa-building'],
                ['url' => '/informasi-penyelamatan', 'label' => 'Sarana penyelamatan', 'ico' => 'fa-life-ring'],
                ['url' => '/informasi-pemeriksaan',  'label' => 'Sarana pemeriksaan',  'ico' => 'fa-magnifying-glass'],
                ['url' => '/sumber-air',             'label' => 'Sumber Air',          'ico' => 'fa-droplet'],
                ['url' => '/hidrant-kota',           'label' => 'Data Hidrant Kota Jambi', 'ico' => 'fa-map-location-dot'],
            ],
        ],
    ];

    // Kunci agar sidebar Sapra otomatis terbuka dan menu Sumber Air tersorot
    $kategori_aktif = 'sapra';
    $halaman_aktif  = '/sumber-air';

    $tabs = [
        'sotk'        => ['url' => '/sotk',        'label' => 'SOTK'],
        'sop'         => ['url' => '/sop',         'label' => 'SOP'],
        'perencanaan' => ['url' => '/perencanaan', 'label' => 'Perencanaan'],
        'pelaporan'   => ['url' => '/pelaporan',   'label' => 'Pelaporan'],
        'produkhukum' => ['url' => '/produkhukum', 'label' => 'Produk hukum'],
    ];
    $tab_aktif = null;

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20Sistem%20Informasi%20Simerah%20Koja...";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76";
    $play_store_url = "";

    // Definisi kategori sumber air (dipakai untuk kartu kategori + panel data)
    $groups = [
        ['id' => 'pilar',  'label' => 'Hidrant Pilar',  'ico' => 'fa-faucet-drip', 'tone' => 'red',   'data' => $hidranPilar,  'field' => null,     'fieldLabel' => null,             'nameLabel' => 'Lokasi / Area', 'desc' => 'Hidrant di tepi jalan'],
        ['id' => 'gedung', 'label' => 'Hidrant Gedung', 'ico' => 'fa-building',    'tone' => 'blue',  'data' => $hidranGedung, 'field' => 'jumlah', 'fieldLabel' => 'Jumlah (Unit)',  'nameLabel' => 'Nama Gedung',   'desc' => 'Hidrant di dalam gedung'],
        ['id' => 'embung', 'label' => 'Embung',         'ico' => 'fa-water',       'tone' => 'teal',  'data' => $embung,       'field' => 'luas',   'fieldLabel' => 'Kapasitas Air', 'nameLabel' => 'Nama Lokasi',   'desc' => 'Tampungan air buatan'],
        ['id' => 'danau',  'label' => 'Danau',          'ico' => 'fa-droplet',     'tone' => 'amber', 'data' => $danau,        'field' => 'luas',   'fieldLabel' => 'Kapasitas Air', 'nameLabel' => 'Nama Danau',    'desc' => 'Sumber air alami'],
    ];
    $totalSemua = 0;
    foreach ($groups as $g) { $totalSemua += count($g['data']); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Data pemetaan sumber air pemadam kebakaran di Kota Jambi.">
    <title>Data Sumber Air | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & BASE MASTER DESIGN LU
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
            --steel: #5b6c7f;
            --line: #dbe2ea;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 28px;
            --r-md: 18px;
            --r-sm: 10px;
            --wrap: 1200px;
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
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }

        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* ==========================================================
           HEADER (ASLI LU)
           ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 60;
            background: rgba(13, 27, 42, .85);
            -webkit-backdrop-filter: blur(14px) saturate(1.4);
            backdrop-filter: blur(14px) saturate(1.4);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            max-width: var(--wrap); margin: 0 auto; height: var(--header-h);
            padding: 0 clamp(16px, 4vw, 32px);
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
        }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand img { height: 38px; width: auto; }

        .menu { display: flex; align-items: center; gap: 2px; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 14px; border-radius: 999px;
            color: rgba(255,255,255,.88); font-size: .92rem; font-weight: 500;
            transition: background .2s, color .2s;
        }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu > li.current > .menu-trigger { background: rgba(255,255,255,.1); color: #fff; }
        .menu-trigger i { font-size: .65rem; transition: transform .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); }
        .menu .btn-login { background: var(--signal); color: #fff; margin-left: 10px; font-weight: 600; padding: 9px 22px; }
        .menu .btn-login:hover { background: var(--signal-d); }

        .dropdown {
            display: none; position: absolute; top: calc(100% + 10px); left: 0; min-width: 250px;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: var(--r-md); padding: 6px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
        }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -10px; height: 10px; }
        .dropdown a { display: block; padding: 11px 14px; border-radius: var(--r-sm); font-size: .92rem; color: rgba(255,255,255,.85); }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.1); color: #fff; }
        .has-drop.open .dropdown { display: block; }
        @media (hover: hover) and (min-width: 992px) {
            .has-drop:hover .dropdown { display: block; }
        }

        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; }
        .nav-toggle:hover { background: rgba(255,255,255,.1); }

        @media (max-width: 991px) {
            .nav-toggle { display: inline-flex; align-items: center; justify-content: center; }
            .menu {
                display: none; position: fixed; top: var(--header-h); left: 0; right: 0;
                max-height: calc(100dvh - var(--header-h)); overflow-y: auto;
                flex-direction: column; align-items: stretch; gap: 4px;
                padding: 16px clamp(16px, 4vw, 32px) 28px; background: var(--ink);
                border-bottom: 1px solid rgba(255,255,255,.1);
            }
            .nav-open .menu { display: flex; }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 14px 16px; border-radius: 14px; font-size: 1rem; }
            .dropdown { position: static; margin: 2px 0 8px 12px; box-shadow: none; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.12); border-radius: 0; }
            .dropdown::before { display: none; }
            .menu .btn-login { margin: 8px 0 0; justify-content: center; padding: 14px; }
        }

        /* ==========================================================
           HERO HALAMAN (ASLI LU)
           ========================================================== */
        .page-hero {
            position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden;
            padding: clamp(36px, 6vw, 72px) 0 clamp(72px, 10vw, 112px);
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
            font-size: clamp(2.8rem, 8vw, 5.5rem); line-height: .95; letter-spacing: -0.035em;
        }
        .page-hero p { margin-top: 18px; max-width: 56ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; } .rise.d3 { animation-delay: .3s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           LAYOUT UTAMA & SIDEBAR (ASLI LU)
           ========================================================== */
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .info-layout { display: grid; grid-template-columns: 300px minmax(0, 1fr); gap: 24px; align-items: start; margin-top: 40px; }
        @media (max-width: 900px) { .info-layout { grid-template-columns: 1fr; } }

        .cat-panel { position: sticky; top: calc(var(--header-h) + 16px); background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: 20px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);}
        @media (max-width: 900px) { .cat-panel { position: static; } }
        .cat-panel h2 { padding: 4px 10px 16px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; letter-spacing: -0.01em; }
        .cat { border-top: 1px solid var(--line); }
        .cat:first-of-type { border-top: 0; }
        .cat-btn { display: flex; align-items: center; gap: 12px; width: 100%; padding: 14px 10px; text-align: left; border-radius: 12px; font-weight: 700; font-size: .9rem; color: var(--ink); transition: background .2s; }
        .cat-btn:hover { background: var(--paper); }
        .cat-btn i.chev { margin-left: auto; font-size: .7rem; color: var(--steel); transition: transform .2s; }
        .cat[data-open] .cat-btn i.chev { transform: rotate(180deg); }
        .cat[data-open] .cat-btn { color: var(--signal-d); }
        .cat-btn .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--line); flex: none; }
        .cat-btn.has-items .dot { background: var(--signal); }
        .cat-btn:disabled { cursor: default; color: var(--steel); }
        .cat-btn:disabled:hover { background: transparent; }
        .cat-soon { margin-left: auto; font-size: .72rem; font-weight: 600; color: var(--steel); background: var(--paper); padding: 3px 10px; border-radius: 999px; }

        .cat-sub { list-style: none; overflow: hidden; max-height: 0; transition: max-height .3s ease; }
        .cat[data-open] .cat-sub { max-height: 400px; }
        .cat-sub li { padding: 2px 4px 8px; }
        .cat-sub a { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 12px; font-size: .9rem; font-weight: 600; color: var(--steel); transition: background .2s, color .2s; }
        .cat-sub a:hover { background: var(--paper); color: var(--ink); }
        .cat-sub a i { width: 20px; text-align: center; color: #b8c3d0; font-size: .95rem; }
        .cat-sub a[aria-current="page"] { background: var(--signal); color: #fff; box-shadow: 0 10px 20px -8px rgba(229,57,45,.6); }
        .cat-sub a[aria-current="page"] i { color: #fff; }

        /* ==========================================================
           FOOTER (ASLI LU)
           ========================================================== */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; margin-top: 40px;}
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        .footer-about p { max-width: 42ch; font-size: .95rem; }
        .map { position: relative; height: 190px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); }
        .map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; filter: grayscale(.3) contrast(1.05); transition: filter .3s; }
        .map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; border-radius: var(--r-md); }
        .map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .85rem; font-weight: 700; box-shadow: 0 8px 20px rgba(0,0,0,.35); transition: background .2s, transform .2s; }
        .map-link:hover span, .map-link:focus-visible span { background: var(--signal-d); transform: translateY(-2px); }
        .map:hover iframe { filter: none; }
        .find { margin-top: 14px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; color: #fff; transition: color .2s, gap .2s; }
        .find i { color: var(--signal); }
        .find:hover { color: var(--amber); gap: 14px; }
        .app-dl { margin-top: 22px; }
        .app-dl p { font-size: .88rem; margin-bottom: 10px; }
        .app-dl img { height: 44px; width: auto; }
        .footer-links li + li { margin-top: 8px; }
        .footer-links a { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .95rem; transition: color .2s, gap .2s; }
        .footer-links a i { font-size: .7rem; color: var(--signal); }
        .footer-links a:hover { color: #fff; gap: 14px; }
        .footer-bar { margin-top: clamp(40px, 6vw, 72px); padding-top: 28px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; font-size: .88rem; }
        .footer .social a { background: rgba(255,255,255,.08); color: #fff; padding: 8px; border-radius: 6px; transition: background .2s; display: inline-flex;}
        .footer .social a:hover { background: var(--signal); }
        @media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }

        /* ==========================================================
           TOMBOL LAPOR MENGAMBANG (ASLI LU)
           ========================================================== */
        .beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; background: #fff; flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: #fff; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
        .sos-fab { position: fixed; right: clamp(14px, 3vw, 28px); bottom: clamp(14px, 3vw, 28px); z-index: 70; display: flex; flex-direction: column; align-items: flex-end; gap: 12px; opacity: 0; visibility: hidden; transform: translateY(16px); transition: opacity .3s, transform .3s, visibility .3s; }
        .sos-fab.show { opacity: 1; visibility: visible; transform: none; }
        .sos-fab-btn { display: inline-flex; align-items: center; gap: 10px; padding: 14px 22px; border-radius: 999px; background: var(--signal); color: #fff; font-weight: 700; box-shadow: 0 14px 30px -6px rgba(229,57,45,.6); }
        .sos-fab-btn:hover { background: var(--signal-d); }
        .sos-sheet { display: none; width: min(320px, calc(100vw - 28px)); padding: 8px; border-radius: 20px; background: var(--ink); border: 1px solid rgba(255,255,255,.12); box-shadow: 0 24px 48px rgba(0,0,0,.45); }
        .sos-fab.open .sos-sheet { display: grid; gap: 6px; }
        .sos-sheet a { display: flex; align-items: center; gap: 14px; padding: 13px 14px; border-radius: 14px; color: #fff; font-weight: 600; }
        .sos-sheet a:hover { background: rgba(255,255,255,.1); }
        .sos-sheet a i { width: 22px; text-align: center; font-size: 1.15rem; }
        .sos-sheet .wa i { color: #25d366; } .sos-sheet .tel i { color: #38bdf8; } .sos-sheet .n112 i { color: #f87171; }

        /* ==========================================================
           KONTEN SUMBER AIR (VERSI PUBLIK)
           ========================================================== */
        .data-col { display: grid; gap: 22px; min-width: 0; }
        [hidden] { display: none !important; }

        .data-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: clamp(20px, 3vw, 28px); box-shadow: 0 4px 20px rgba(0,0,0,0.03);}
        .data-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.35rem, 2.6vw, 1.75rem); line-height: 1.2; letter-spacing: -0.015em; color: var(--ink); margin-bottom: 6px; }
        .data-head p { color: var(--steel); font-size: .95rem; max-width: 52ch; }
        .total-pill { display: inline-flex; align-items: center; gap: 12px; padding: 10px 20px 10px 12px; border-radius: 999px; background: var(--ink); color: #fff; }
        .total-pill i { width: 40px; height: 40px; border-radius: 50%; display: grid; place-items: center; background: rgba(255,255,255,.12); color: #7dd3fc; }
        .total-pill b { display: block; font-family: var(--font-display); font-weight: 800; font-size: 1.5rem; line-height: 1; }
        .total-pill span { font-size: .75rem; color: rgba(255,255,255,.7); font-weight: 600; }

        /* --- Kartu kategori (berfungsi sebagai tab) --- */
        .tabs { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        @media (max-width: 1100px) { .tabs { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 420px) { .tabs { grid-template-columns: 1fr; } }
        .tab-card { position: relative; display: flex; align-items: center; gap: 14px; text-align: left; background: #fff; border: 1.5px solid var(--line); border-radius: var(--r-md); padding: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); transition: border-color .2s, transform .2s, box-shadow .2s, background .2s; }
        .tab-card:hover { transform: translateY(-2px); border-color: #b8c5d3; box-shadow: 0 14px 26px -14px rgba(13,27,42,.25); }
        .tab-ico { flex: none; width: 46px; height: 46px; border-radius: 14px; display: grid; place-items: center; font-size: 1.1rem; }
        .tone-red .tab-ico   { background: #fef2f2; color: #dc2626; }
        .tone-blue .tab-ico  { background: #eff6ff; color: #2563eb; }
        .tone-teal .tab-ico  { background: #ecfeff; color: #0891b2; }
        .tone-amber .tab-ico { background: #fff7e6; color: #b7791f; }
        .tab-txt { min-width: 0; }
        .tab-num { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.6rem; line-height: 1; letter-spacing: -0.02em; }
        .tab-lbl { margin-top: 4px; font-size: .82rem; font-weight: 700; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .tab-desc { font-size: .74rem; color: var(--steel); font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .tab-card[aria-selected="true"] { background: var(--ink-2); border-color: var(--ink-2); box-shadow: 0 18px 30px -14px rgba(13,27,42,.5); }
        .tab-card[aria-selected="true"] .tab-num, .tab-card[aria-selected="true"] .tab-lbl { color: #fff; }
        .tab-card[aria-selected="true"] .tab-desc { color: rgba(255,255,255,.65); }
        .tab-card[aria-selected="true"] .tab-ico { background: rgba(255,255,255,.14); color: #fff; }

        /* --- Toolbar --- */
        .toolbar { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px; display: grid; gap: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
        .toolbar-row { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
        .search { position: relative; flex: 1 1 260px; min-width: 0; }
        .search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .9rem; pointer-events: none; }
        .search input { width: 100%; height: 46px; padding: 0 44px 0 44px; border-radius: 999px; border: 1.5px solid var(--line); background: var(--paper); font: inherit; font-size: .95rem; color: var(--ink); transition: border-color .2s, box-shadow .2s, background .2s; }
        .search input:focus { outline: none; border-color: var(--ink-2); background: #fff; box-shadow: 0 0 0 4px rgba(19,42,67,.08); }
        .search .clear { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 30px; height: 30px; border-radius: 50%; display: none; place-items: center; background: #e2e8f0; color: var(--steel); font-size: .75rem; }
        .search .clear.show { display: grid; }
        .search .clear:hover { background: var(--ink); color: #fff; }

        .seg { display: inline-flex; padding: 4px; border-radius: 999px; background: var(--paper); border: 1.5px solid var(--line); }
        .seg button { display: inline-flex; align-items: center; gap: 8px; height: 36px; padding: 0 16px; border-radius: 999px; font-size: .85rem; font-weight: 700; color: var(--steel); transition: background .2s, color .2s; white-space: nowrap; }
        .seg button:hover { color: var(--ink); }
        .seg button[aria-pressed="true"] { background: var(--ink-2); color: #fff; }

        .result-line { font-size: .88rem; color: var(--steel); font-weight: 500; }
        .result-line b { color: var(--ink); }

        /* --- Kartu data --- */
        .panel { display: grid; gap: 18px; animation: fadeIn .3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: none; } }
        .cards { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        @media (max-width: 700px) { .cards { grid-template-columns: 1fr; } }
        .w-card { position: relative; display: flex; flex-direction: column; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 20px 20px 18px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); overflow: hidden; transition: transform .25s, box-shadow .25s, border-color .25s; }
        .w-card::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 5px; background: #dc2626; }
        .tone-blue.w-card::before { background: #2563eb; }
        .tone-teal.w-card::before { background: #0891b2; }
        .tone-amber.w-card::before { background: #d99a2b; }
        .w-card:hover { transform: translateY(-3px); box-shadow: 0 18px 32px -14px rgba(13,27,42,.2); border-color: #c9d4e0; }
        .w-top { display: flex; align-items: flex-start; gap: 14px; }
        .w-num { flex: none; width: 38px; height: 38px; border-radius: 12px; display: grid; place-items: center; font-family: var(--font-display); font-weight: 800; font-size: .95rem; background: #eff6ff; color: #2563eb; }
        .w-title { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; line-height: 1.25; letter-spacing: -0.01em; }
        .w-kind { font-size: .72rem; font-weight: 800; letter-spacing: .06em; color: var(--steel); text-transform: uppercase; margin-bottom: 2px; }
        .w-addr { display: flex; gap: 10px; align-items: flex-start; padding: 12px 14px; border-radius: 12px; background: var(--paper); font-size: .88rem; color: var(--steel); }
        .w-addr i { margin-top: 4px; color: var(--signal); font-size: .8rem; }
        .w-fact { display: inline-flex; align-items: center; gap: 8px; align-self: flex-start; padding: 6px 12px; border-radius: 8px; background: #f1f5f9; border: 1px solid #e2e8f0; color: #475569; font-weight: 700; font-size: .82rem; }
        .w-fact i { color: #0891b2; }
        .w-foot { margin-top: auto; display: flex; }

        .btn-maps { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 18px; background: var(--ink-2); color: #fff; border-radius: 999px; font-weight: 700; font-size: 0.86rem; transition: background .2s, transform .2s; white-space: nowrap; }
        .btn-maps:hover { background: var(--signal); transform: translateY(-1px); }
        .w-foot .btn-maps { flex: 1; }
        .btn-maps.disabled { background: #f1f5f9; color: #94a3b8; border: 1px solid var(--line); cursor: not-allowed; }
        .btn-maps.disabled:hover { background: #f1f5f9; transform: none; }
        .btn-maps.sm { padding: 8px 16px; font-size: .82rem; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-weight: 600; }
        .btn-maps.sm:hover { background: #d1fae5; transform: translateY(-1px); }
        .btn-maps.sm.disabled { background: #f1f5f9; color: #94a3b8; border-color: var(--line); }

        /* --- Tabel --- */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: 0 4px 20px rgba(0,0,0,0.02); overflow: hidden; }
        .table-scroll { overflow-x: auto; width: 100%; }
        .data-table { width: 100%; min-width: 800px; border-collapse: collapse; text-align: left; }
        .data-table thead th { background: #f1f5f9; color: #475569; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; padding: 16px 24px; border-bottom: 1px solid var(--line); border-top: 1px solid var(--line); }
        .data-table tbody td { padding: 20px 24px; border-bottom: 1px solid var(--line); color: var(--ink); font-size: 0.95rem; vertical-align: middle; }
        .data-table tbody tr { transition: background .2s; }
        .data-table tbody tr:hover { background: #f8fafc; }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .text-center { text-align: center !important; }
        .text-bold { font-weight: 700; color: #0f172a; font-size: 0.98rem;}
        .badge-urut { display: inline-flex; justify-content: center; align-items: center; width: 28px; height: 28px; background: #eff6ff; color: #2563eb; border-radius: 6px; font-weight: 700; font-size: 0.85rem; }
        .badge-luas { background: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; border: 1px solid #e2e8f0;}

        /* --- Muat lebih banyak & kosong --- */
        .more { display: flex; justify-content: center; }
        .btn-more { display: inline-flex; align-items: center; gap: 10px; height: 48px; padding: 0 28px; border-radius: 999px; background: #fff; border: 1.5px solid var(--line); font-weight: 700; font-size: .92rem; transition: all .2s; }
        .btn-more:hover { border-color: var(--ink-2); background: var(--ink-2); color: #fff; }

        .empty-state { text-align: center; padding: 56px 20px; color: var(--steel); background: #fff; border: 1px dashed #cbd5e1; border-radius: var(--r-md); }
        .empty-state i.big { font-size: 3rem; color: #cbd5e1; margin-bottom: 16px; }
        .empty-state h3 { font-family: var(--font-display); font-size: 1.15rem; color: var(--ink); margin-bottom: 4px;}
        .empty-actions { margin-top: 16px; display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }
        .empty-actions button { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 999px; background: var(--ink-2); color: #fff; font-weight: 700; font-size: .85rem; }
        .empty-actions button:hover { background: var(--signal); }
        .empty-actions button.ghost { background: #fff; color: var(--ink); border: 1.5px solid var(--line); }
        .empty-actions button.ghost:hover { background: var(--paper); border-color: var(--ink-2); }

        /* --- Banner laporan --- */
        .report { position: relative; overflow: hidden; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px; padding: clamp(22px, 3vw, 32px); border-radius: var(--r-lg); color: #fff; background: linear-gradient(120deg, var(--ink) 0%, var(--ink-3) 100%); }
        .report::after { content: ""; position: absolute; right: -60px; top: -60px; width: 220px; height: 220px; border-radius: 50%; background: radial-gradient(circle, rgba(56,189,248,.45), transparent 70%); pointer-events: none; }
        .report-txt { position: relative; z-index: 1; max-width: 56ch; }
        .report-txt h3 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.3rem; line-height: 1.2; margin-bottom: 6px; }
        .report-txt p { font-size: .93rem; color: rgba(255,255,255,.75); }
        .report-act { position: relative; z-index: 1; display: flex; flex-wrap: wrap; gap: 10px; }
        .report-act a { display: inline-flex; align-items: center; gap: 10px; padding: 12px 22px; border-radius: 999px; font-weight: 700; font-size: .9rem; transition: transform .2s, background .2s; }
        .report-act a:hover { transform: translateY(-2px); }
        .report-act .wa { background: #25d366; color: #052e16; }
        .report-act .tel { background: rgba(255,255,255,.12); color: #fff; border: 1px solid rgba(255,255,255,.2); }
        .report-act .tel:hover { background: rgba(255,255,255,.2); }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

<!-- ==================== HEADER ==================== -->
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <a href="/" class="brand" aria-label="SIMERAH KOJA, beranda">
            <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>

        <!-- TOMBOL TOGGLE MOBILE -->
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
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Program kerja <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <?php foreach (['sotk', 'perencanaan', 'pelaporan', 'sop', 'produkhukum'] as $k): ?>
                        <li><a href="<?= $h($tabs[$k]['url']) ?>" <?php if ($k === $tab_aktif): ?> aria-current="page" <?php endif; ?>><?= $h($tabs[$k]['label']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan &amp; fasilitas <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan Edukasi & Sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                    <li><a href="/sumber-air">Sumber Air</a></li>
                    <li><a href="/hidrant-kota">Data Hidrant Kota Jambi</a></li>
                </ul>
            </li>

            <li><a class="menu-link" href="/redkar">Redkar</a></li>
            <li><a class="menu-link btn-login" href="/login">Masuk</a></li>
        </ul>
    </nav>
</header>

<main>

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/informasi-layanan">Informasi layanan</a></li>
                <li><span aria-current="page">Sumber air</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Data Sumber Air</h1>
        <p class="rise d2">Pemetaan lokasi sumber air untuk keperluan pemadaman di Kota Jambi.</p>
    </div>
</section>

<div class="page-body">
    <div class="wrap">
        <div class="info-layout">

            <!-- Sidebar kategori -->
            <nav class="cat-panel" aria-label="Kategori publikasi">
                <h2>Kategori publikasi</h2>
                <?php foreach ($kategori as $slug => $kat):
                    $ada_isi = !empty($kat['items']);
                    $terbuka = $ada_isi && $kategori_aktif === $slug;
                ?>
                <div class="cat" <?php if ($terbuka): ?> data-open <?php endif; ?>>
                    <?php if ($ada_isi): ?>
                        <button type="button" class="cat-btn has-items" aria-expanded="<?= $terbuka ? 'true' : 'false' ?>">
                            <span class="dot"></span> <?= $h($kat['label']) ?>
                            <i class="fas fa-chevron-down chev"></i>
                        </button>
                        <ul class="cat-sub">
                            <?php foreach ($kat['items'] as $item): ?>
                                <li>
                                    <a href="<?= $h($item['url']) ?>" <?php if ($halaman_aktif === $item['url']): ?> aria-current="page" <?php endif; ?>>
                                        <i class="fas <?= $h($item['ico']) ?>"></i> <?= $h($item['label']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <button type="button" class="cat-btn" disabled>
                            <span class="dot"></span> <?= $h($kat['label']) ?>
                            <span class="cat-soon">Segera hadir</span>
                        </button>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </nav>

            <!-- KONTEN -->
            <section class="data-col">

                <div class="data-head">
                    <div>
                        <h2>Distribusi Sumber Air</h2>
                        <p>Pilih jenis sumber air, cari lokasi terdekat, lalu buka petanya langsung di Google Maps.</p>
                    </div>
                    <div class="total-pill">
                        <i class="fas fa-droplet"></i>
                        <div><b data-count="<?= $totalSemua ?>"><?= $totalSemua ?></b><span>Total titik sumber air</span></div>
                    </div>
                </div>

                <!-- Kartu kategori (sekaligus tab) -->
                <div class="tabs" role="tablist" aria-label="Jenis sumber air">
                    @foreach($groups as $g)
                        <button type="button" role="tab" class="tab-card tone-{{ $g['tone'] }}" data-tab="{{ $g['id'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" aria-controls="panel-{{ $g['id'] }}">
                            <span class="tab-ico"><i class="fas {{ $g['ico'] }}"></i></span>
                            <span class="tab-txt">
                                <div class="tab-num" data-total="{{ count($g['data']) }}">{{ count($g['data']) }}</div>
                                <div class="tab-lbl">{{ $g['label'] }}</div>
                                <div class="tab-desc">{{ $g['desc'] }}</div>
                            </span>
                        </button>
                    @endforeach
                </div>

                <!-- Toolbar pencarian -->
                <div class="toolbar">
                    <div class="toolbar-row">
                        <label class="search">
                            <span class="sr-only">Cari nama lokasi atau alamat</span>
                            <i class="fas fa-search"></i>
                            <input type="text" id="qInput" placeholder="Cari nama lokasi atau alamat..." autocomplete="off">
                            <button type="button" class="clear" id="qClear" aria-label="Hapus pencarian"><i class="fas fa-times"></i></button>
                        </label>
                        <div class="seg" role="group" aria-label="Tampilan data">
                            <button type="button" data-view="card" aria-pressed="true"><i class="fas fa-table-cells-large"></i> Kartu</button>
                            <button type="button" data-view="table" aria-pressed="false"><i class="fas fa-list"></i> Tabel</button>
                        </div>
                    </div>
                    <div class="result-line" id="resultText" aria-live="polite"></div>
                </div>

                <!-- PANEL PER KATEGORI -->
                @foreach($groups as $g)
                    @php $cnt = count($g['data']); @endphp
                    <div class="panel" id="panel-{{ $g['id'] }}" role="tabpanel" data-panel="{{ $g['id'] }}" data-total="{{ $cnt }}" @if(!$loop->first) hidden @endif>

                        @if($cnt > 0)
                            <!-- Kartu -->
                            <div class="cards" data-cards>
                                @foreach($g['data'] as $item)
                                    @php
                                        $href = $mapHref($item->kode_maps ?? null);
                                        $num  = $g['id'] === 'pilar' ? ($item->no_urut ?? $loop->iteration) : $loop->iteration;
                                        $fact = $g['field'] ? ($item->{$g['field']} ?? null) : null;
                                        $hay  = strtolower(trim(($item->nama_gedung ?? '') . ' ' . ($item->alamat ?? '')));
                                    @endphp
                                    <article class="w-card tone-{{ $g['tone'] }} h-item" data-search="{{ $hay }}">
                                        <div class="w-top">
                                            <span class="w-num">{{ $num }}</span>
                                            <div>
                                                <div class="w-kind">{{ $g['label'] }}</div>
                                                <h3 class="w-title">{{ $item->nama_gedung }}</h3>
                                            </div>
                                        </div>
                                        <div class="w-addr"><i class="fas fa-location-dot"></i><span>{{ $item->alamat ?: '-' }}</span></div>
                                        @if($g['field'] && $fact !== null && $fact !== '')
                                            <span class="w-fact"><i class="fas {{ $g['field'] === 'jumlah' ? 'fa-hashtag' : 'fa-water' }}"></i> {{ $g['fieldLabel'] }}: {{ $fact }}</span>
                                        @endif
                                        <div class="w-foot">
                                            @if($href)
                                                <a href="{{ $href }}" target="_blank" rel="noopener" class="btn-maps"><i class="fas fa-location-arrow"></i> Buka di Google Maps</a>
                                            @else
                                                <span class="btn-maps disabled"><i class="fas fa-ban"></i> Peta belum tersedia</span>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            <!-- Tabel -->
                            <div class="table-wrap" data-table hidden>
                                <div class="table-scroll">
                                    <table class="data-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="5%">NO</th>
                                                <th width="{{ $g['field'] ? '25%' : '30%' }}">{{ strtoupper($g['nameLabel']) }}</th>
                                                <th width="{{ $g['field'] ? '35%' : '45%' }}">ALAMAT</th>
                                                @if($g['field'])<th class="text-center" width="15%">{{ strtoupper($g['fieldLabel']) }}</th>@endif
                                                <th class="text-center" width="{{ $g['field'] ? '20%' : '20%' }}">MAPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($g['data'] as $item)
                                                @php
                                                    $href = $mapHref($item->kode_maps ?? null);
                                                    $num  = $g['id'] === 'pilar' ? ($item->no_urut ?? $loop->iteration) : $loop->iteration;
                                                    $fact = $g['field'] ? ($item->{$g['field']} ?? null) : null;
                                                    $hay  = strtolower(trim(($item->nama_gedung ?? '') . ' ' . ($item->alamat ?? '')));
                                                @endphp
                                                <tr class="h-item" data-search="{{ $hay }}">
                                                    <td class="text-center">
                                                        @if($g['id'] === 'pilar')<span class="badge-urut">{{ $num }}</span>@else<span style="color: var(--steel);">{{ $num }}</span>@endif
                                                    </td>
                                                    <td class="text-bold">{{ $item->nama_gedung }}</td>
                                                    <td style="color: #475569;">{{ $item->alamat }}</td>
                                                    @if($g['field'])<td class="text-center"><span class="badge-luas">{{ ($fact !== null && $fact !== '') ? $fact : '-' }}</span></td>@endif
                                                    <td class="text-center">
                                                        @if($href)
                                                            <a href="{{ $href }}" target="_blank" rel="noopener" class="btn-maps sm"><i class="fas fa-location-dot"></i> Buka Map</a>
                                                        @else
                                                            <span class="btn-maps sm disabled"><i class="fas fa-ban"></i> Kosong</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tidak ada hasil pencarian -->
                            <div class="empty-state" data-nohit hidden>
                                <i class="fas fa-magnifying-glass-location big"></i>
                                <h3>Lokasi tidak ditemukan</h3>
                                <p>Tidak ada hasil untuk pencarian ini di kategori <b>{{ $g['label'] }}</b>.</p>
                                <div class="empty-actions" data-others></div>
                            </div>

                            <div class="more"><button type="button" class="btn-more" data-more hidden><i class="fas fa-angles-down"></i> <span>Tampilkan lebih banyak</span></button></div>
                        @else
                            <div class="empty-state">
                                <i class="fas {{ $g['ico'] }} big"></i>
                                <h3>Data kosong</h3>
                                <p>Belum ada data {{ $g['label'] }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach

                <!-- Ajakan lapor -->
                <aside class="report">
                    <div class="report-txt">
                        <h3>Tahu lokasi sumber air yang belum terdata?</h3>
                        <p>Kabari kami lokasi hidrant, embung, atau sumber air lain yang bisa dipakai untuk pemadaman, agar bisa kami verifikasi dan tambahkan ke peta.</p>
                    </div>
                    <div class="report-act">
                        <a class="wa" href="<?= $h($wa_link) ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Kabari via WhatsApp</a>
                        <a class="tel" href="tel:<?= $h($no_telepon) ?>"><i class="fas fa-phone-alt"></i> <?= $h($telepon_tampil) ?></a>
                    </div>
                </aside>

            </section>

        </div>
    </div>
</div>

</main>

<!-- ==================== FOOTER ==================== -->
<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>

            <div>
                <div class="map">
                    <iframe
                        title="Lokasi Dinas Pemadam Kebakaran Kota Jambi"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener" aria-label="Buka lokasi Dinas Pemadam Kebakaran Kota Jambi di Google Maps">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>

                <?php if ($play_store_url): ?>
                <div class="app-dl">
                    <p>Unduh aplikasi SIMERAH KOJA</p>
                    <a href="<?= $h($play_store_url) ?>" target="_blank" rel="noopener">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Dapatkan di Google Play">
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <div class="footer-links">
                <h3>Link terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; <?= $h(date('Y')) ?>. Hak cipta dilindungi.</div>
            <div class="social">
                <a href="mailto:damkar.jbi@gmail.com" title="Email" aria-label="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" title="Twitter / X" aria-label="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- ==================== TOMBOL LAPOR MENGAMBANG ==================== -->
<div class="sos-fab" id="sosFab">
    <div class="sos-sheet" id="sosSheet">
        <a class="wa" href="<?= $h($wa_link) ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Lapor lewat WhatsApp</a>
        <a class="tel" href="tel:<?= $h($no_telepon) ?>"><i class="fas fa-phone-alt"></i> Telepon <?= $h($telepon_tampil) ?></a>
        <a class="n112" href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a>
    </div>
    <button class="sos-fab-btn" type="button" aria-expanded="false" aria-controls="sosSheet">
        <span class="beacon" aria-hidden="true"></span> Lapor darurat
    </button>
</div>

<script>
(function () {
    'use strict';

    /* ---------- Navigasi ---------- */
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');

    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                li.querySelector('.menu-trigger').setAttribute('aria-expanded', 'false');
            }
        });
    }

    toggle.addEventListener('click', function () {
        var open = header.classList.toggle('nav-open');
        toggle.setAttribute('aria-expanded', open);
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        toggle.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-bars';
    });

    drops.forEach(function (li) {
        var btn = li.querySelector('.menu-trigger');
        btn.addEventListener('click', function () {
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
            closeDrops(li);
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDrops(null);
    });

    /* ---------- Accordion Sidebar ---------- */
    document.querySelectorAll('.cat-btn.has-items').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var cat = btn.closest('.cat');
            var nowOpen = !cat.hasAttribute('data-open');
            document.querySelectorAll('.cat[data-open]').forEach(function (c) {
                c.removeAttribute('data-open');
                c.querySelector('.cat-btn').setAttribute('aria-expanded', 'false');
            });
            if (nowOpen) {
                cat.setAttribute('data-open', '');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    /* ---------- Tombol lapor mengambang ---------- */
    var fab = document.getElementById('sosFab');
    var fabBtn = fab.querySelector('.sos-fab-btn');

    function updateFab() {
        var show = window.scrollY > 320;
        fab.classList.toggle('show', show);
        if (!show) { fab.classList.remove('open'); fabBtn.setAttribute('aria-expanded', 'false'); }
    }
    window.addEventListener('scroll', updateFab, { passive: true });
    updateFab();

    fabBtn.addEventListener('click', function () {
        var open = fab.classList.toggle('open');
        fabBtn.setAttribute('aria-expanded', open);
    });

    /* ---------- Animasi angka ---------- */
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    document.querySelectorAll('[data-count]').forEach(function (el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        if (reduce || target === 0) return;
        var start = null, dur = 900;
        el.textContent = '0';
        function step(ts) {
            if (start === null) start = ts;
            var p = Math.min((ts - start) / dur, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    });

    /* ---------- Tab kategori, pencarian, tampilan & muat lebih banyak ---------- */
    var PAGE = 12;
    var tabs   = Array.prototype.slice.call(document.querySelectorAll('.tab-card'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('.panel'));
    var qInput = document.getElementById('qInput');
    var qClear = document.getElementById('qClear');
    var viewBtns = document.querySelectorAll('.seg button');
    var resultText = document.getElementById('resultText');

    var state = { q: '', view: 'card', tab: tabs.length ? tabs[0].getAttribute('data-tab') : '', shown: {} };
    panels.forEach(function (p) { state.shown[p.getAttribute('data-panel')] = PAGE; });

    function tabLabel(id) {
        var t = tabs.filter(function (x) { return x.getAttribute('data-tab') === id; })[0];
        return t ? t.querySelector('.tab-lbl').textContent : id;
    }

    function panelInfo(p) {
        var id = p.getAttribute('data-panel');
        var items = Array.prototype.slice.call(p.querySelectorAll('.h-item'));
        var cards = items.filter(function (el) { return el.closest('[data-cards]'); });
        var rows  = items.filter(function (el) { return el.closest('[data-table]'); });
        var hits = cards.filter(function (el) { return !state.q || el.getAttribute('data-search').indexOf(state.q) !== -1; }).length;
        return { id: id, cards: cards, rows: rows, hits: hits, total: parseInt(p.getAttribute('data-total'), 10) || 0 };
    }

    function paint(list) {
        var n = 0;
        list.forEach(function (el) {
            var ok = !state.q || el.getAttribute('data-search').indexOf(state.q) !== -1;
            if (ok) n++;
            el.hidden = !(ok && n <= state.shown[el.closest('.panel').getAttribute('data-panel')]);
        });
    }

    function apply() {
        var infos = panels.map(panelInfo);
        var byId = {};
        infos.forEach(function (i) { byId[i.id] = i; });

        // Angka pada kartu kategori: tampilkan jumlah hasil saat mencari
        tabs.forEach(function (t) {
            var i = byId[t.getAttribute('data-tab')];
            t.querySelector('.tab-num').textContent = state.q ? i.hits : i.total;
            t.setAttribute('aria-selected', t.getAttribute('data-tab') === state.tab ? 'true' : 'false');
        });

        panels.forEach(function (p) {
            var i = byId[p.getAttribute('data-panel')];
            p.hidden = i.id !== state.tab;
            if (i.total === 0) return;

            paint(i.cards);
            paint(i.rows);

            var cardsEl = p.querySelector('[data-cards]');
            var tableEl = p.querySelector('[data-table]');
            var nohit   = p.querySelector('[data-nohit]');
            var more    = p.querySelector('[data-more]');
            var none    = i.hits === 0;

            cardsEl.hidden = none || state.view !== 'card';
            tableEl.hidden = none || state.view !== 'table';
            nohit.hidden   = !none;

            var remaining = i.hits - state.shown[i.id];
            more.hidden = !(remaining > 0);
            if (remaining > 0) more.querySelector('span').textContent = 'Tampilkan lebih banyak (' + remaining + ' lagi)';

            if (none) {
                var box = nohit.querySelector('[data-others]');
                box.innerHTML = '';
                infos.forEach(function (o) {
                    if (o.id !== i.id && o.hits > 0) {
                        var b = document.createElement('button');
                        b.type = 'button';
                        b.textContent = o.hits + ' hasil di ' + tabLabel(o.id);
                        b.addEventListener('click', function () { state.tab = o.id; apply(); });
                        box.appendChild(b);
                    }
                });
                var r = document.createElement('button');
                r.type = 'button'; r.className = 'ghost';
                r.innerHTML = '<i class="fas fa-rotate-left"></i> Hapus pencarian';
                r.addEventListener('click', function () { qInput.value = ''; qInput.dispatchEvent(new Event('input')); });
                box.appendChild(r);
            }
        });

        var cur = byId[state.tab];
        if (cur) {
            if (cur.total === 0) {
                resultText.innerHTML = 'Belum ada data untuk <b>' + tabLabel(state.tab) + '</b>';
            } else if (state.q) {
                var all = infos.reduce(function (a, x) { return a + x.hits; }, 0);
                resultText.innerHTML = 'Ditemukan <b>' + cur.hits + '</b> di ' + tabLabel(state.tab) + ' &middot; <b>' + all + '</b> hasil di semua kategori';
            } else {
                resultText.innerHTML = 'Menampilkan <b>' + Math.min(cur.total, state.shown[state.tab]) + '</b> dari ' + cur.total + ' titik <b>' + tabLabel(state.tab) + '</b>';
            }
        }
        qClear.classList.toggle('show', !!qInput.value);
    }

    tabs.forEach(function (t) {
        t.addEventListener('click', function () { state.tab = t.getAttribute('data-tab'); apply(); });
    });

    qInput.addEventListener('input', function () {
        state.q = qInput.value.trim().toLowerCase();
        Object.keys(state.shown).forEach(function (k) { state.shown[k] = PAGE; });
        apply();
    });
    qClear.addEventListener('click', function () { qInput.value = ''; qInput.dispatchEvent(new Event('input')); qInput.focus(); });

    viewBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            state.view = btn.getAttribute('data-view');
            viewBtns.forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
            apply();
        });
    });

    panels.forEach(function (p) {
        var more = p.querySelector('[data-more]');
        if (more) more.addEventListener('click', function () { state.shown[p.getAttribute('data-panel')] += PAGE; apply(); });
    });

    apply();
})();
</script>

</body>
</html>