@php
    /*
    |--------------------------------------------------------------------------
    | DATA UJUNG-UJUNG DAMKAR
    |--------------------------------------------------------------------------
    */
    $listUjungDamkar = isset($daftar_ujung_damkar) && count($daftar_ujung_damkar)
        ? $daftar_ujung_damkar
        : (\Illuminate\Support\Facades\Schema::hasTable('ujung_damkar')
            ? \App\Models\UjungDamkar::latest()->get()
            : collect());

    /*
    |--------------------------------------------------------------------------
    | KONTAK DARURAT
    |--------------------------------------------------------------------------
    */
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa       = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link        = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link      = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Dokumentasi video aksi penyelamatan dan layanan kemanusiaan non-kebakaran oleh petugas Damkar Kota Jambi.">
    <title>Ujung-ujung Damkar - SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            --steel: #5b6c7f;
            --line: #dbe2ea;
            --soft: #eef2f6;

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
            background: var(--paper);
            min-height: 100vh;
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
           HEADER
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
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .has-drop.current > .menu-trigger {
            background: rgba(255,255,255,.1); color: #fff;
        }
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
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.08); color: #fff; }

        .dropdown .btn-logout {
            width: 100%; text-align: left; padding: 11px 14px; border-radius: var(--r-sm);
            font-size: .92rem; color: #ff8b8b; display: flex; align-items: center; gap: 8px;
            transition: background .2s, color .2s; cursor: pointer;
        }
        .dropdown .btn-logout:hover { background: rgba(255, 255, 255, .1); color: #ffb8b8; }

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
           PAGE HERO & BREADCRUMB
           ========================================================== */
        .page-hero {
            position: relative; isolation: isolate; overflow: hidden;
            color: #fff; padding: clamp(44px, 6vw, 68px) 0 clamp(64px, 8vw, 92px);
            background: var(--ink);
        }
        .page-hero::before {
            content: ""; position: absolute; inset: 0; z-index: -2;
            background:
                linear-gradient(105deg, rgba(7,20,33,.97) 0%, rgba(8,24,39,.88) 45%, rgba(8,24,39,.62) 100%),
                url('/images/background1.png') center / cover no-repeat;
        }
        .page-hero::after {
            content: ""; position: absolute; z-index: -1; inset: auto -10% -50% -10%; height: 280px;
            background: radial-gradient(ellipse at center, rgba(229,57,45,.38), transparent 66%);
            pointer-events: none;
        }

        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 9px; color: rgba(255,255,255,.66); font-size: .85rem; margin-bottom: 24px; }
        .crumbs li { display: inline-flex; align-items: center; gap: 9px; }
        .crumbs li + li::before { content: "/"; opacity: .38; }
        .crumbs a:hover { color: #fff; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 700; }

        .hero-kicker {
            display: inline-flex; align-items: center; gap: 9px; padding: 7px 12px;
            border: 1px solid rgba(255,255,255,.14); border-radius: 999px;
            background: rgba(255,255,255,.07); color: rgba(255,255,255,.85);
            font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em;
            margin-bottom: 16px;
        }
        .hero-kicker i { color: var(--signal); }

        .page-hero h1 {
            font-family: var(--font-display); font-weight: 800; font-stretch: 85%;
            font-size: clamp(2.8rem, 7vw, 5.4rem); line-height: .95; letter-spacing: -0.04em;
            max-width: 850px;
        }
        .page-hero p { margin-top: 18px; max-width: 62ch; color: rgba(255,255,255,.74); font-size: clamp(1rem, 1.4vw, 1.12rem); }
        .hero-line { width: 70px; height: 4px; border-radius: 99px; margin-top: 24px; background: var(--signal); }

        .rise { animation: rise .75s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .16s; } .rise.d3 { animation-delay: .24s; }
        @keyframes rise { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           CONTENT & VIDEO GRID
           ========================================================== */
        .page-body { background: var(--paper); min-height: 50vh; padding: clamp(48px, 7vw, 80px) 0 clamp(64px, 9vw, 100px); }
        .content-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 28px; flex-wrap: wrap; }
        .content-head h2 {
            font-family: var(--font-display); font-weight: 700; font-stretch: 90%;
            font-size: clamp(1.75rem, 3.2vw, 2.4rem); line-height: 1.08; letter-spacing: -0.025em;
        }
        .content-head p { margin-top: 6px; color: var(--steel); font-size: .95rem; }

        .vid-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
        .vid {
            position: relative; display: flex; flex-direction: column; width: 100%; text-align: left;
            background: var(--white); border: 1px solid var(--line); border-radius: 22px; overflow: hidden;
            box-shadow: 0 7px 24px rgba(13,27,42,.055);
            transition: transform .35s cubic-bezier(.2,.75,.25,1), box-shadow .35s, border-color .35s;
        }
        .vid:not([disabled]):hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 55px rgba(13,27,42,.14);
            border-color: rgba(229,57,45,.25);
        }

        .vid-thumb { position: relative; aspect-ratio: 16 / 10; overflow: hidden; background: var(--ink-2); }
        .vid-thumb::after {
            content: ""; position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,.02) 40%, rgba(0,0,0,.56) 100%);
            pointer-events: none; transition: opacity .3s;
        }
        .vid:not([disabled]):hover .vid-thumb::after { opacity: .75; }
        .vid-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s cubic-bezier(.2,.7,.2,1), filter .35s; }
        .vid:not([disabled]):hover .vid-thumb img { transform: scale(1.06); filter: saturate(1.06); }

        .video-tag {
            position: absolute; z-index: 4; top: 12px; left: 12px; padding: 5px 10px; border-radius: 8px;
            background: rgba(255,255,255,.95); color: var(--signal-d); font-size: .65rem; font-weight: 800;
            letter-spacing: .04em; text-transform: uppercase; box-shadow: 0 5px 14px rgba(0,0,0,.13);
        }
        .video-source {
            position: absolute; z-index: 4; right: 12px; top: 12px; width: 34px; height: 34px; border-radius: 50%;
            display: grid; place-items: center; color: #fff; background: rgba(7,20,33,.68);
            border: 1px solid rgba(255,255,255,.2); backdrop-filter: blur(8px); font-size: .82rem;
        }
        .video-source i { color: #ff3838; }

        .vid-play { position: absolute; z-index: 5; inset: 0; display: grid; place-items: center; }
        .vid-play span {
            width: 58px; height: 58px; border-radius: 50%; display: grid; place-items: center;
            color: #fff; background: rgba(229,57,45,.94); box-shadow: 0 10px 25px rgba(0,0,0,.28);
            font-size: 1rem; padding-left: 3px; transition: transform .3s ease;
        }
        .vid:not([disabled]):hover .vid-play span { transform: scale(1.1); }

        .vid-content { padding: 18px 20px; display: flex; flex-direction: column; flex: 1; }
        .vid h3 {
            margin: 0; color: var(--ink); font-family: var(--font-display); font-size: 1.06rem; font-weight: 700;
            line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden; min-height: 2.7em; transition: color .2s;
        }
        .vid:not([disabled]):hover h3 { color: var(--signal-d); }

        .vid-meta {
            display: flex; align-items: center; flex-wrap: wrap; gap: 7px 14px;
            color: var(--steel); font-size: .78rem; font-weight: 600; margin: 12px 0 16px;
        }
        .vid-meta span { display: inline-flex; align-items: center; gap: 6px; }
        .vid-meta .youtube { color: #ff0000; }

        .vid-link {
            margin-top: auto; display: flex; align-items: center; justify-content: space-between;
            padding-top: 13px; border-top: 1px solid var(--soft); color: var(--ink);
            font-size: .84rem; font-weight: 700;
        }
        .vid-link i {
            width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center;
            background: var(--soft); color: var(--ink); transition: .25s; font-size: .75rem;
        }
        .vid:not([disabled]):hover .vid-link { color: var(--signal-d); }
        .vid:not([disabled]):hover .vid-link i { background: var(--signal); color: #fff; transform: translateX(3px); }

        .empty {
            grid-column: 1 / -1; text-align: center; padding: 64px 24px;
            border: 1.5px dashed var(--line); border-radius: 22px; background: var(--white); color: var(--steel);
        }
        .empty-icon {
            width: 68px; height: 68px; margin: 0 auto 16px; border-radius: 50%;
            display: grid; place-items: center; background: var(--soft); color: #b6c1cc; font-size: 1.75rem;
        }
        .empty h3 { font-family: var(--font-display); color: var(--ink); font-size: 1.3rem; margin-bottom: 6px; }
        .empty p { font-size: .92rem; }

        /* ==========================================================
           FOOTER & INFO KONTAK
           ========================================================== */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }

        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        .footer-about p { max-width: 42ch; font-size: .95rem; }

        .footer-contact { margin-top: 24px; display: grid; gap: 12px; }
        .footer-contact a { display: inline-flex; align-items: center; gap: 12px; color: rgba(255,255,255,.9); font-size: .95rem; font-weight: 500; transition: color .2s; }
        .footer-contact a i { color: var(--signal); font-size: 1.2rem; width: 20px; text-align: center; }
        .footer-contact a:hover { color: var(--amber); }

        .map { position: relative; height: 190px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); }
        .map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; filter: grayscale(.3) contrast(1.05); transition: filter .3s; }
        .map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; border-radius: var(--r-md); }
        .map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .85rem; font-weight: 700; box-shadow: 0 8px 20px rgba(0,0,0,.35); transition: background .2s, transform .2s; }
        .map-link:hover span, .map-link:focus-visible span { background: var(--signal-d); transform: translateY(-2px); }
        .map:hover iframe { filter: none; }
        .find { margin-top: 14px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; color: #fff; transition: color .2s, gap .2s; }
        .find i { color: var(--signal); }
        .find:hover { color: var(--amber); gap: 14px; }

        .footer-links li + li { margin-top: 8px; }
        .footer-links a { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .95rem; transition: color .2s, gap .2s; }
        .footer-links a i { font-size: .7rem; color: var(--signal); }
        .footer-links a:hover { color: #fff; gap: 14px; }

        .footer-bar { margin-top: clamp(40px, 6vw, 72px); padding-top: 28px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; font-size: .88rem; }
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: rgba(255,255,255,.08); color: #fff; transition: background .2s, transform .2s; }
        .social a:hover { background: var(--signal); transform: translateY(-3px); }
        @media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }

        /* ==========================================================
           TOMBOL LAPOR MENGAMBANG & DIALOG VIDEO
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

        dialog { border: 0; padding: 0; background: transparent; color: #fff; width: min(960px, 94vw); max-height: 94dvh; margin: auto; overflow: visible; }
        dialog::backdrop { background: rgba(7,14,24,.86); -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); }
        .dlg-close { position: absolute; top: -52px; right: 0; width: 44px; height: 44px; border-radius: 50%; background: #fff; color: var(--ink); font-size: 1.1rem; display: grid; place-items: center; transition: .2s; }
        .dlg-close:hover { background: var(--amber); }
        .video-frame { aspect-ratio: 16 / 9; border-radius: var(--r-md); overflow: hidden; background: #000; box-shadow: 0 30px 70px rgba(0,0,0,.45); }
        .video-frame iframe { width: 100%; height: 100%; border: 0; }

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
        <div class="brand">
            <a href="/" aria-label="SIMERAH KOJA, beranda">
                <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            </a>
            <a href="/login" title="Login Internal Pegawai">
                <img src="/images/logo.png" alt="Logo Damkar">
            </a>
            <a href="/redkar" aria-label="Redkar">
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </a>
        </div>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="menu" id="menu">
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan kedaruratan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="{{ $wa_link }}" target="_blank" rel="noopener">WhatsApp</a></li>
                    <li><a href="tel:{{ $no_telepon }}">Telepon</a></li>
                    <li><a href="tel:112">Call Center 112</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Program kerja <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/sotk">SOTK</a></li>
                    <li><a href="/perencanaan">Perencanaan</a></li>
                    <li><a href="/pelaporan">Pelaporan</a></li>
                    <li><a href="/sop">SOP</a></li>
                    <li><a href="/produkhukum">Produk hukum</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK &amp; Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/public-sigap">SIGAP</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Kabar Damkar <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                   <li><a href="/edu-damkar">Edu Damkar</a></li>
                    <li><a href="/infografis">Info Grafis</a></li>
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
                                <button type="submit" class="btn-logout">
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

    <!-- ==================== HERO ==================== -->
    <section class="page-hero">
        <div class="wrap">
            <nav aria-label="Breadcrumb" class="rise">
                <ol class="crumbs">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/#giat">Kabar Damkar</a></li>
                    <li><span aria-current="page">Ujung-ujung Damkar</span></li>
                </ol>
            </nav>

            <div class="hero-kicker rise">
                <i class="fas fa-life-ring"></i> Dokumentasi Damkar Kota Jambi
            </div>

            <h1 class="rise d1">Ujung-ujung Damkar</h1>

            <p class="rise d2">
                Dokumentasi video aksi penyelamatan dan layanan kemanusiaan non-kebakaran oleh petugas Damkar Kota Jambi.
            </p>

            <div class="hero-line rise d3"></div>
        </div>
    </section>

    <!-- ==================== CONTENT ==================== -->
    <section class="page-body">
        <div class="wrap">
            <div class="content-head">
                <div>
                    <h2>Dokumentasi kegiatan</h2>
                    <p>Saksikan berbagai aksi penyelamatan dan pelayanan kemanusiaan petugas Damkar Kota Jambi.</p>
                </div>
            </div>

            <div class="vid-grid">
                @forelse($listUjungDamkar as $vu)
                    @php
                        $youtubeId  = trim($vu->youtube_id ?? '');
                        $judulVideo = $vu->judul ?? 'Dokumentasi Ujung-ujung Damkar';
                    @endphp

                    <button class="vid" type="button"
                        @if($youtubeId)
                            data-yt="{{ $youtubeId }}"
                            data-title="{{ $judulVideo }}"
                        @else
                            disabled
                        @endif
                    >
                        <div class="vid-thumb">
                            @if($youtubeId)
                                <img src="https://i.ytimg.com/vi/{{ $youtubeId }}/hqdefault.jpg" alt="{{ $judulVideo }}" loading="lazy">
                            @endif

                            <span class="video-tag">Ujung-ujung Damkar</span>

                            <span class="video-source" aria-hidden="true">
                                <i class="fab fa-youtube"></i>
                            </span>

                            @if($youtubeId)
                                <div class="vid-play" aria-hidden="true">
                                    <span><i class="fas fa-play"></i></span>
                                </div>
                            @endif
                        </div>

                        <div class="vid-content">
                            <h3>{{ $judulVideo }}</h3>

                            <div class="vid-meta">
                                <span><i class="fab fa-youtube youtube"></i> YouTube</span>
                                @if($vu->created_at ?? false)
                                    <span>
                                        <i class="far fa-calendar-alt"></i>
                                        {{ \Carbon\Carbon::parse($vu->created_at)->locale('id')->translatedFormat('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <span class="vid-link">
                                Lihat dokumentasi <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </button>
                @empty
                    <div class="empty">
                        <div class="empty-icon">
                            <i class="far fa-play-circle"></i>
                        </div>
                        <h3>Belum ada video dokumentasi</h3>
                        <p>Dokumentasi video akan tampil di sini setelah diunggah oleh petugas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</main>

<!-- ==================== FOOTER ==================== -->
<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>

                <div class="footer-contact">
                    <a href="{{ $wa_link }}" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> {{ $no_whatsapp }} (WhatsApp)
                    </a>
                    <a href="tel:{{ $no_telepon }}">
                        <i class="fas fa-phone-alt"></i> {{ $telepon_tampil }} (Call Center Damkar)
                    </a>
                </div>
            </div>

            <div>
                <div class="map">
                    <iframe
                        title="Lokasi Dinas Pemadam Kebakaran Kota Jambi"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="{{ $maps_link }}" target="_blank" rel="noopener" aria-label="Buka lokasi Dinas Pemadam Kebakaran Kota Jambi di Google Maps">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="{{ $maps_link }}" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>
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
            <div>SIMERAH KOJA &copy; {{ date('Y') }}. Hak cipta dilindungi.</div>
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
        <a class="wa" href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Lapor lewat WhatsApp</a>
        <a class="tel" href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon {{ $telepon_tampil }}</a>
        <a class="n112" href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a>
    </div>
    <button class="sos-fab-btn" type="button" aria-expanded="false" aria-controls="sosSheet">
        <span class="beacon" aria-hidden="true"></span> Lapor darurat
    </button>
</div>

<!-- ==================== VIDEO MODAL ==================== -->
<dialog id="videoDialog">
    <button type="button" class="dlg-close" aria-label="Tutup video"><i class="fas fa-times"></i></button>
    <div class="video-frame">
        <iframe src="" title="Video Ujung-ujung Damkar" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</dialog>

<script>
(function () {
    'use strict';

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

    var vDialog = document.getElementById('videoDialog');
    var vFrame = vDialog.querySelector('iframe');
    var vClose = vDialog.querySelector('.dlg-close');

    document.querySelectorAll('.vid:not([disabled])').forEach(function (v) {
        v.addEventListener('click', function () {
            var youtubeId = v.getAttribute('data-yt');
            if (!youtubeId) return;
            vFrame.src = 'https://www.youtube-nocookie.com/embed/' + youtubeId + '?autoplay=1&rel=0';
            vDialog.showModal();
        });
    });

    function closeVideo() {
        vFrame.src = '';
        vDialog.close();
    }

    vClose.addEventListener('click', closeVideo);
    vDialog.addEventListener('click', function (e) {
        if (e.target === vDialog) closeVideo();
    });
})();
</script>
</body>
</html>