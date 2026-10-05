<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
    ------------------------------------------------------------ */
    $layanan = [
        'rpkbgl'    => ['url' => '/layanan-fasilitas/layanan_perizinan', 'label' => 'RPKBGL', 'ico' => 'fa-building', 'ket' => 'Layanan perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan'],
        'skk'       => ['url' => '/layanan-fasilitas/skk',                'label' => 'SKK (Baru & Perpanjangan)', 'ico' => 'fa-user-shield', 'ket' => 'Layanan perizinan penerbitan & perpanjangan Sertifikat Keamanan Kebakaran'],
        'keramaian' => ['url' => '/layanan-fasilitas/izin-keramaian',     'label' => 'Izin Keramaian', 'ico' => 'fa-users', 'ket' => 'Pengajuan Rekomendasi Izin Keramaian'],
    ];
    // Set tab aktif ke keramaian
    $tab_aktif = $tab_aktif ?? 'keramaian';

    $old            = session()->getOldInput() ?? []; 
    $pesan_sukses   = session('success') ?? '';       
    $galat          = $errors->all() ?? [];           
    
    // VARIABEL INI TETAP ADA TAPI UNTUK PENGECEKAN KONDISI SAJA
    $url_surat_permohonan = true;

    $to_arr = function ($d) { return (is_object($d) && method_exists($d, 'toArray')) ? $d->toArray() : (array) $d; };
    $val    = function ($k) use ($old, $h) { return $h($old[$k] ?? ''); };

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi...";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/...";
    $play_store_url = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Ajukan <?= $h($layanan[$tab_aktif]['ket']) ?> secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title><?= $h($layanan[$tab_aktif]['label']) ?> - Layanan perizinan | SIMERAH KOJA</title>

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
            --wrap: 1200px;
            --header-h: 64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.65; color: var(--ink); background: var(--white); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }

        /* HEADER */
        .site-header { position: sticky; top: 0; z-index: 60; background: rgba(13, 27, 42, .85); backdrop-filter: blur(14px) saturate(1.4); border-bottom: 1px solid rgba(255,255,255,.08); }
        .nav { max-width: var(--wrap); margin: 0 auto; height: var(--header-h); padding: 0 clamp(16px, 4vw, 32px); display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand img { height: 38px; width: auto; }

        .menu { display: flex; align-items: center; gap: 2px; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger { display: inline-flex; align-items: center; gap: 8px; padding: 9px 14px; border-radius: 999px; color: rgba(255,255,255,.88); font-size: .92rem; font-weight: 500; transition: background .2s, color .2s; }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu > li.current > .menu-trigger { background: rgba(255,255,255,.1); color: #fff; }
        .menu-trigger i { font-size: .65rem; transition: transform .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); }
        .menu .btn-login { background: var(--signal); color: #fff; margin-left: 10px; font-weight: 600; padding: 9px 22px; }
        .menu .btn-login:hover { background: var(--signal-d); }

        .dropdown { display: none; position: absolute; top: calc(100% + 10px); left: 0; min-width: 250px; background: var(--ink-2); border: 1px solid rgba(255,255,255,.1); border-radius: var(--r-md); padding: 6px; box-shadow: 0 24px 48px rgba(0,0,0,.45); }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -10px; height: 10px; }
        .dropdown a, .dropdown button { display: block; width: 100%; text-align: left; padding: 11px 14px; border-radius: var(--r-sm); font-size: .92rem; color: rgba(255,255,255,.85); }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.1); color: #fff; }
        .dropdown .btn-logout { color: #ff8b8b; display: flex; align-items: center; gap: 8px; transition: background .2s, color .2s; cursor: pointer; }
        .dropdown .btn-logout:hover { background: rgba(255, 255, 255, .1); color: #ffb8b8; }
        .has-drop.open .dropdown { display: block; }
        @media (hover: hover) and (min-width: 992px) { .has-drop:hover .dropdown { display: block; } }

        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; }
        .nav-toggle:hover { background: rgba(255,255,255,.1); }

        @media (max-width: 991px) {
            .nav-toggle { display: inline-flex; align-items: center; justify-content: center; }
            .menu { display: none; position: fixed; top: var(--header-h); left: 0; right: 0; max-height: calc(100dvh - var(--header-h)); overflow-y: auto; flex-direction: column; align-items: stretch; gap: 4px; padding: 16px clamp(16px, 4vw, 32px) 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1); }
            .nav-open .menu { display: flex; }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 14px 16px; border-radius: 14px; font-size: 1rem; }
            .dropdown { position: static; margin: 2px 0 8px 12px; box-shadow: none; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.12); border-radius: 0; }
            .dropdown::before { display: none; }
            .menu .btn-login { margin: 8px 0 0; justify-content: center; padding: 14px; }
        }

        /* HERO HALAMAN */
        .page-hero { position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden; padding: clamp(36px, 6vw, 72px) 0 clamp(72px, 10vw, 112px); }
        .page-hero::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%), linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%), url('/images/background1.png') center / cover no-repeat; }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 28px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 600; }
        .page-hero h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2.8rem, 8vw, 5.5rem); line-height: .95; letter-spacing: -0.035em; }
        .page-hero p { margin-top: 18px; max-width: 56ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }
        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; } .rise.d3 { animation-delay: .3s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* TAB LAYANAN */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .tabs-wrap { position: relative; z-index: 2; margin-top: -30px; }
        .tabs { display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: 0 18px 36px -20px rgba(13,27,42,.45); overflow-x: auto; scrollbar-width: none; }
        .tabs::-webkit-scrollbar { display: none; }
        .tab { display: inline-flex; align-items: center; gap: 10px; white-space: nowrap; padding: 11px 20px; border-radius: 999px; font-weight: 600; font-size: .92rem; color: var(--steel); transition: background .2s, color .2s; }
        .tab i { font-size: .95rem; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-current="page"] { background: var(--ink); color: #fff; }
        .tab[aria-current="page"] i { color: var(--amber); }

        /* RINGKASAN LAYANAN */
        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }
        .facts { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 28px; }
        .fact { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

        /* LAYOUT KONTEN */
        .perizinan-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 24px; margin-top: 24px; align-items: start; }
        @media (min-width: 992px) { .perizinan-layout { grid-template-columns: minmax(300px, 380px) minmax(0, 1fr); gap: 32px; } }
        .info-stack { display: grid; gap: 16px; }
        #formulir { scroll-margin-top: calc(var(--header-h) + 16px); }

        .jump { display: none; align-items: center; justify-content: center; gap: 10px; padding: 13px 20px; border-radius: 999px; background: var(--ink); color: #fff; font-weight: 600; font-size: .92rem; }
        .jump i { color: var(--amber); }
        .jump:hover { background: var(--ink-3); }
        @media (max-width: 991px) { .jump { display: inline-flex; } }

        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(20px, 3vw, 28px); }
        .card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
        .card-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.25rem; line-height: 1.15; letter-spacing: -0.015em; }

        .checklist { display: grid; gap: 18px; }
        .checklist li { display: grid; grid-template-columns: 36px minmax(0, 1fr); gap: 14px; align-items: start; font-size: .93rem; line-height: 1.5; }
        .ck-ico { width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .9rem; }
        .checklist a.inline { font-weight: 600; color: var(--signal-d); text-decoration: underline; text-underline-offset: 3px; }
        .checklist .muted { color: var(--steel); }

        /* Mekanisme (details) */
        .disclose summary { list-style: none; cursor: pointer; display: inline-flex; align-items: center; gap: 10px; min-height: 40px; padding: 0 18px; border-radius: 999px; background: var(--paper); font-size: .9rem; font-weight: 600; transition: background .2s, color .2s; }
        .disclose summary::-webkit-details-marker { display: none; }
        .disclose summary:hover { background: var(--ink); color: #fff; }
        .disclose summary i { font-size: .7rem; transition: transform .2s; }
        .disclose[open] summary i { transform: rotate(180deg); }
        .disclose .when-open, .disclose[open] .when-closed { display: none; }
        .disclose[open] .when-open { display: inline; }
        .steps { margin-top: 22px; counter-reset: step; }
        .steps li { position: relative; padding: 2px 0 20px 46px; font-size: .93rem; line-height: 1.55; counter-increment: step; }
        .steps li::before { content: counter(step); position: absolute; left: 0; top: 0; width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; background: var(--ink); color: #fff; font-family: var(--font-display); font-weight: 700; font-size: .85rem; }
        .steps li::after { content: ""; position: absolute; left: 15px; top: 36px; bottom: 4px; width: 2px; background: var(--line); }
        .steps li:last-child { padding-bottom: 0; }
        .steps li:last-child::after { display: none; }
        .steps li:last-child::before { background: var(--signal); }

        /* FORMULIR */
        .form-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 18px clamp(18px, 3vw, 32px); border-bottom: 1px solid var(--line); }
        .form-title { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .form-title > i { flex: none; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; }
        .form-title h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; }
        .form-title p { font-size: .85rem; color: var(--steel); line-height: 1.4; margin-top: 2px; }
        .form-note { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }

        .form-body { padding: clamp(18px, 3vw, 32px); display: grid; gap: 36px; }
        .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .92rem; line-height: 1.5; }
        .alert i { margin-top: 3px; }
        .alert.ok { background: #e8f7ee; color: #14532d; border: 1px solid #bce5cb; }
        .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
        .alert ul { display: grid; gap: 2px; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
        .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
        .field { min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        @media (max-width: 640px) { .fields { grid-template-columns: minmax(0, 1fr); } }

        .label { display: block; margin-bottom: 8px; font-size: .9rem; font-weight: 600; line-height: 1.35; }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }

        .input { display: block; width: 100%; height: 48px; padding: 0 16px; border: 1px solid var(--line); border-radius: 14px; background: #fff; font: inherit; font-size: .95rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .input::placeholder { color: #93a1b1; }
        .input:hover { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        .unit { position: relative; }
        .unit .input { padding-right: 54px; }
        .unit span { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: .88rem; font-weight: 600; color: var(--steel); pointer-events: none; }

        .dropzone { position: relative; display: grid; justify-items: center; gap: 8px; text-align: center; padding: 26px 20px; border: 2px dashed #b8c3d0; border-radius: var(--r-md); background: var(--paper); color: var(--steel); font-size: .92rem; line-height: 1.45; cursor: pointer; transition: border-color .2s, background .2s; }
        .dropzone:hover, .dropzone.is-over { border-color: var(--signal); background: #fdeceb; }
        .dropzone.has-files { border-style: solid; border-color: var(--ink); background: #fff; }
        .dropzone input { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }
        .dz-files { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; }
        .dz-files:empty { display: none; }
        .dz-files li { display: inline-flex; align-items: center; gap: 8px; padding: 5px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .82rem; font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }

        .form-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 20px; padding-top: 4px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s; cursor: pointer; }
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover { background: var(--signal-d); }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--ink-3); }
        .form-actions p { font-size: .88rem; color: var(--steel); }
        @media (max-width: 640px) { .form-actions .btn { width: 100%; } }

        /* FOOTER & LAINNYA */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        .footer-about p { max-width: 42ch; font-size: .95rem; }
        .footer-links li + li { margin-top: 8px; }
        .footer-links a { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .95rem; transition: color .2s, gap .2s; }
        .footer-links a i { font-size: .7rem; color: var(--signal); }
        .footer-links a:hover { color: #fff; gap: 14px; }
        .footer-bar { margin-top: clamp(40px, 6vw, 72px); padding-top: 28px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between; align-items: center; font-size: .88rem; }
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: rgba(255,255,255,.08); color: #fff; transition: background .2s, transform .2s; }
        .social a:hover { background: var(--signal); transform: translateY(-3px); }
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
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK & Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/izin-keramaian" aria-current="page">Izin Keramaian</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan Edukasi & Sosialisasi</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<main>
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                <li><span aria-current="page"><?= $h($layanan[$tab_aktif]['label']) ?></span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Layanan perizinan</h1>
        <p class="rise d2">Ajukan rekomendasi proteksi kebakaran, sertifikat keamanan kebakaran, dan izin keramaian secara daring ke Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
</section>

<div class="page-body">
    <div class="wrap tabs-wrap">
        <nav class="tabs" aria-label="Jenis layanan perizinan">
            <?php foreach ($layanan as $key => $l): ?>
                <a class="tab" href="<?= $h($l['url']) ?>" title="<?= $h($l['ket']) ?>" <?php if ($key === $tab_aktif): ?> aria-current="page" <?php endif; ?>>
                    <i class="fas <?= $h($l['ico']) ?>"></i> <?= $h($l['label']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="wrap">
        <div class="facts">
            <div class="fact">
                <span class="c-ico"><i class="fas fa-clock"></i></span>
                <div>
                    <small>Batas pengajuan</small>
                    <strong>Min 7 Hari Sebelum Acara</strong>
                </div>
            </div>
            <div class="fact">
                <span class="c-ico"><i class="fas fa-file-circle-check"></i></span>
                <div>
                    <small>Produk layanan</small>
                    <strong>Rekomendasi Izin Keramaian</strong>
                </div>
            </div>
        </div>

        <div class="perizinan-layout">
            <aside class="info-stack" aria-label="Informasi layanan">
                <a class="jump" href="#formulir"><i class="fas fa-arrow-down"></i> Langsung ke formulir</a>
                
                <section class="side-card">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-clipboard-check"></i></span>
                        <h2>Persyaratan Pengajuan</h2>
                    </div>
                    <ol class="checklist">
                        <li>
                            <span class="ck-ico"><i class="fas fa-pen-to-square"></i></span>
                            <div>Isi formulir pengajuan izin keramaian secara elektronik melalui <strong>simerah.jambikota.go.id</strong></div>
                        </li>
                        <li>
                            <span class="ck-ico"><i class="fas fa-image"></i></span>
                            <div>Unggah foto denah jalur evakuasi lokasi acara.</div>
                        </li>
                        <li>
                            <span class="ck-ico"><i class="fas fa-file-signature"></i></span>
                            <div>
                                Unggah surat pernyataan yang telah ditandatangani di atas <strong>materai Rp 10.000</strong>.
                                <?php if ($url_surat_permohonan): ?>
                                    <br>
                                    <a class="inline" href="/dokumen/format_surat_izin_keramaian.pdf" download style="display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; font-size: 0.85rem; background: var(--paper); padding: 6px 12px; border-radius: 6px; border: 1px solid var(--line);">
                                        <i class="fas fa-download"></i> Unduh Surat Kosong
                                    </a>
                                <?php else: ?>
                                    <br><span class="muted" style="font-size: 0.85rem;"><i class="fas fa-info-circle"></i> Templat surat belum tersedia</span>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ol>
                </section>

                <section class="side-card">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-route"></i></span>
                        <h2>Mekanisme & Prosedur</h2>
                    </div>
                    <details class="disclose">
                        <summary>
                            <span class="when-closed">Tampilkan detail</span><span class="when-open">Sembunyikan detail</span>
                            <i class="fas fa-chevron-down"></i>
                        </summary>
                        <ol class="steps">
                            <li>Pemohon mendaftar secara daring, lalu mengunggah kelengkapan berkas yang dipersyaratkan (Minimal 7 hari sebelum acara)</li>
                            <li>Tim Inspeksi memeriksa kelengkapan fasilitas proteksi kebakaran (Minimal 8 APAR & 4 Staff terlatih)</li>
                            <li>Dinas Pemadam Kebakaran mengeluarkan hasil rekomendasi izin keramaian.</li>
                        </ol>
                    </details>
                </section>
            </aside>

            <!-- Formulir -->
            <section class="form-panel" id="formulir" aria-label="Formulir permohonan">
                <div class="form-bar">
                    <div class="form-title">
                        <i class="fas fa-file-pen"></i>
                        <div>
                            <h2>Formulir Rekomendasi Izin Keramaian</h2>
                            <p>Pengajuan Rekomendasi Izin Keramaian</p>
                        </div>
                    </div>
                    <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
                </div>

                <form class="form-body" action="{{ route('izin-keramaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <?php if ($pesan_sukses): ?>
                        <div class="alert ok" role="status"><i class="fas fa-circle-check"></i><div><?= $h($pesan_sukses) ?></div></div>
                    <?php endif; ?>
                    <?php if ($galat): ?>
                        <div class="alert err" role="alert">
                            <i class="fas fa-circle-exclamation"></i>
                            <div>
                                Permohonan belum terkirim. Periksa isian berikut:
                                <ul>
                                    <?php foreach ((array) $galat as $g): ?><li><?= $h($g) ?></li><?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="alert" style="background: #eef2f6; color: var(--ink-3); border: 1px solid var(--line);" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <div><strong>Perhatian:</strong> Pengajuan rekomendasi Izin Keramaian dilakukan <strong>7 Hari sebelum kegiatan</strong> dilaksanakan.</div>
                    </div>

                    <fieldset class="fs">
                        <legend><i class="fas fa-user"></i> 1. Data Pemohon</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama">Nama <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nama" name="nama" value="<?= $val('nama') ?>" autocomplete="name" required>
                            </div>
                            <div class="field">
                                <label class="label" for="nik">NIK <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nik" name="nik" value="<?= $val('nik') ?>" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit NIK" required>
                            </div>
                            <div class="field">
                                <label class="label" for="no_hp">No HP/WA <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="tel" id="no_hp" name="no_hp" value="<?= $val('no_hp') ?>" inputmode="tel" autocomplete="tel" placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div class="field full">
                                <label class="label" for="alamat">Alamat <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="alamat" name="alamat" value="<?= $val('alamat') ?>" autocomplete="street-address" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-briefcase"></i> 2. Data Usaha</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_direktur">Nama Direktur <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nama_direktur" name="nama_direktur" value="<?= $val('nama_direktur') ?>" required>
                            </div>
                            <div class="field">
                                <label class="label" for="nama_usaha">Nama Usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nama_usaha" name="nama_usaha" value="<?= $val('nama_usaha') ?>" required>
                            </div>
                            <div class="field">
                                <label class="label" for="no_izin_usaha">No. Izin Usaha <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="no_izin_usaha" name="no_izin_usaha" value="<?= $val('no_izin_usaha') ?>" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-map-marker-alt"></i> 3. Data Lokasi Acara</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_acara">Nama Acara <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="nama_acara" name="nama_acara" value="<?= $val('nama_acara') ?>" required>
                            </div>
                            <div class="field full">
                                <label class="label" for="lokasi_acara">Lokasi Acara <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="text" id="lokasi_acara" name="lokasi_acara" value="<?= $val('lokasi_acara') ?>" required>
                            </div>
                            <div class="field">
                                <label class="label" for="tgl_pelaksanaan">Tgl. Pelaksanaan <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="date" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="<?= $val('tgl_pelaksanaan') ?>" required>
                            </div>
                            <div class="field">
                                <label class="label">Waktu Pelaksana <span class="req" aria-hidden="true">*</span></label>
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <input class="input" type="time" id="waktu_mulai" name="waktu_mulai" value="<?= $val('waktu_mulai') ?>" required style="flex:1;">
                                    <span style="font-size: .9rem; color: var(--steel); font-weight: 600;">s/d</span>
                                    <input class="input" type="time" id="waktu_selesai" name="waktu_selesai" value="<?= $val('waktu_selesai') ?>" required style="flex:1;">
                                    <span style="font-size: .9rem; color: var(--steel); font-weight: 600;">WIB</span>
                                </div>
                            </div>
                            <div class="field full">
                                <label class="label" for="jumlah_penonton">Jumlah Penonton <span class="req" aria-hidden="true">*</span></label>
                                <input class="input" type="number" id="jumlah_penonton" name="jumlah_penonton" value="<?= $val('jumlah_penonton') ?>" min="1" required>
                            </div>
                            
                            <div class="field full">
                                <span class="label" id="lbl-jalur">Jalur Evakuasi (Upload Photo) <span class="req" aria-hidden="true">*</span></span>
                                <label class="dropzone" data-dropzone>
                                    <input type="file" name="foto_jalur_evakuasi" accept=".jpg,.jpeg,.png" required aria-labelledby="lbl-jalur">
                                    <span class="dz-ico"><i class="fas fa-image"></i></span>
                                    <span class="dz-text"><strong>Tarik foto ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-fire-extinguisher"></i> 4. Data Peralatan Pemadam Kebakaran yg Dimiliki</legend>
                        <div class="fields">
                            <div class="field">
                                <label class="label" for="jumlah_apar">APAR <span class="req" aria-hidden="true">*</span></label>
                                <div class="unit">
                                    <input class="input" type="number" id="jumlah_apar" name="jumlah_apar" value="<?= $val('jumlah_apar') ?>" min="8" required aria-describedby="hint-apar">
                                    <span aria-hidden="true">Buah</span>
                                </div>
                                <p class="hint" id="hint-apar"><i class="fas fa-arrow-right"></i> Minimal 8 buah</p>
                            </div>
                            <div class="field">
                                <label class="label" for="jumlah_staff">Staff (Bisa menggunakan APAR) <span class="req" aria-hidden="true">*</span></label>
                                <div class="unit">
                                    <input class="input" type="number" id="jumlah_staff" name="jumlah_staff" value="<?= $val('jumlah_staff') ?>" min="4" required aria-describedby="hint-staff">
                                    <span aria-hidden="true">Orang</span>
                                </div>
                                <p class="hint" id="hint-staff"><i class="fas fa-arrow-right"></i> Minimal 4 orang</p>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs">
                        <legend><i class="fas fa-file-signature"></i> 5. Berkas Persyaratan</legend>
                        
                        <!-- Kotak Pemberitahuan Wajib -->
                        <div class="alert" style="background: #fff8e6; color: #9c6500; border: 1px solid #ffe58f; margin-bottom: 24px;" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Perhatian:</strong> Surat pernyataan wajib diunduh, diisi lengkap, diberi materai Rp 10.000, dan ditandatangani sebelum diunggah kembali ke dalam form ini.
                                <?php if ($url_surat_permohonan): ?>
                                <br>
                                <a href="/dokumen/format_surat_izin_keramaian.pdf" download style="margin-top: 8px; display: inline-flex; align-items: center; gap: 6px; font-weight: 700; color: #b77900; text-decoration: underline;">
                                    <i class="fas fa-download"></i> Klik di sini untuk mengunduh format surat
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="field full">
                                <span class="label" id="lbl-pernyataan">Unggah Surat Pernyataan (Sudah diisi & Bermaterai) <span class="req" aria-hidden="true">*</span></span>
                                <label class="dropzone" data-dropzone>
                                    <input type="file" name="surat_pernyataan" accept=".pdf,.jpg,.jpeg,.png" required aria-labelledby="lbl-pernyataan">
                                    <span class="dz-ico"><i class="fas fa-file-pdf"></i></span>
                                    <span class="dz-text"><strong>Tarik berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    <ul class="dz-files" aria-live="polite"></ul>
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim permohonan</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</main>

<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>
        </div>
        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; <?= $h(date('Y')) ?>. Hak cipta dilindungi.</div>
        </div>
    </div>
</footer>

<script>
(function () {
    'use strict';
    /* Navigasi */
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

    /* Upload Berkas */
    function fmtSize(b) {
        return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(1) + ' MB';
    }

    document.querySelectorAll('[data-dropzone]').forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');

        ['dragenter', 'dragover'].forEach(function (t) {
            dz.addEventListener(t, function () { dz.classList.add('is-over'); });
        });
        ['dragleave', 'drop'].forEach(function (t) {
            dz.addEventListener(t, function () { dz.classList.remove('is-over'); });
        });

        input.addEventListener('change', function () {
            list.textContent = '';
            Array.prototype.forEach.call(input.files, function (f) {
                var li = document.createElement('li');
                li.textContent = f.name + ' (' + fmtSize(f.size) + ')';
                list.appendChild(li);
            });
            dz.classList.toggle('has-files', input.files.length > 0);
        });
    });
})();
</script>
</body>
</html>