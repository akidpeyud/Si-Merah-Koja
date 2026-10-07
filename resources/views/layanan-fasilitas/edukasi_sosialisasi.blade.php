<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    // Tangkap data lama
    $old = session()->getOldInput() ?: [];
    
    // Data wilayah Kota Jambi
    $dataWilayah = [
        'Alam Barajo'   => ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawa Sari', 'Simpang Rimbo'],
        'Danau Sipin'   => ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk'   => ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan' => ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur'   => ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sejinjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung'      => ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru'     => ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya', 'Talang Gulo'],
        'Paal Merah'    => ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi'   => ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan'    => ['Arab Melayu', 'Jelmu', 'Mudung Laut', "Tahtul Yaman", 'Tanjung Johor', 'Tengah'],
        'Telanaipura'   => ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali'],
    ];
    
    $oldKec = $old['kecamatan'] ?? '';
    $oldKel = $old['kelurahan'] ?? '';

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $wa_link        = "https://wa.me/" . $no_whatsapp;
    $maps_link      = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Ajukan Kunjungan Edukasi & Sosialisasi secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>Edukasi & Sosialisasi - Layanan | SIMERAH KOJA</title>
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

        /* HEADER */
        .site-header { position: sticky; top: 0; z-index: 60; background: rgba(13, 27, 42, .85); -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4); border-bottom: 1px solid rgba(255,255,255,.08); }
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
        
        /* Tombol Keluar di Dropdown */
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
        .page-hero { position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden; padding: clamp(36px, 6vw, 72px) 0 clamp(50px, 8vw, 90px); }
        .page-hero::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%), linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%), url('/images/background1.png') center / cover no-repeat; }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 28px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 600; }
        .page-hero h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2.5rem, 6vw, 4.5rem); line-height: 1; letter-spacing: -0.035em; }
        .page-hero p { margin-top: 18px; max-width: 60ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* BODY LAYOUT */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        
        /* RINGKASAN LAYANAN */
        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }
        .facts { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: -30px; position: relative; z-index: 2; margin-bottom: 24px;}
        .fact { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: 0 10px 25px -10px rgba(13,27,42,.15); }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

        /* KONTEN GRID */
        .perizinan-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 24px; align-items: start; }
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
        .checklist > li { display: grid; grid-template-columns: 36px minmax(0, 1fr); gap: 14px; align-items: start; font-size: .93rem; line-height: 1.5; }
        .checklist ul li { display: list-item; grid-template-columns: none; margin-bottom: 6px; }
        .ck-ico { width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .9rem; }
        .checklist a.inline { font-weight: 600; color: var(--signal-d); text-decoration: underline; text-underline-offset: 3px; }
        .checklist .muted { color: var(--steel); }
        
        /* Mekanisme Details */
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
        .input.textarea { height: auto; padding: 12px 16px; resize: vertical; }
        .input::placeholder { color: #93a1b1; }
        .input:hover { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        select.input { appearance: none; -webkit-appearance: none; padding-right: 42px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 16px center; }
        
        .grid-age { display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 14px; }
        .grid-age .input { text-align: center; }

        /* Area unggah berkas */
        .dropzone { position: relative; display: grid; justify-items: center; gap: 8px; text-align: center; padding: 26px 20px; border: 2px dashed #b8c3d0; border-radius: var(--r-md); background: var(--paper); color: var(--steel); font-size: .92rem; line-height: 1.45; cursor: pointer; transition: border-color .2s, background .2s; }
        .dropzone:hover, .dropzone.is-over { border-color: var(--signal); background: #fdeceb; }
        .dropzone:focus-within { outline: 3px solid var(--amber); outline-offset: 3px; }
        .dropzone.has-files { border-style: solid; border-color: var(--ink); background: #fff; }
        .dropzone input { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }
        .dz-files { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; }
        .dz-files:empty { display: none; }
        .dz-files li { display: inline-flex; align-items: center; gap: 8px; padding: 5px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .82rem; font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }

        .form-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 20px; padding-top: 4px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s; border: none;}
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover { background: var(--signal-d); }
        .form-actions p { font-size: .88rem; color: var(--steel); margin: 0;}
        @media (max-width: 640px) { .form-actions .btn { width: 100%; } }

        /* FOOTER */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
        .footer-about p { max-width: 42ch; font-size: .95rem; }
        .map { position: relative; height: 190px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); }
        .map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; filter: grayscale(.3) contrast(1.05); transition: filter .3s; }
        .map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; border-radius: var(--r-md); }
        .map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .85rem; font-weight: 700; box-shadow: 0 8px 20px rgba(0,0,0,.35); transition: background .2s, transform .2s; }
        .map-link:hover span { background: var(--signal-d); transform: translateY(-2px); }
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

        <button class="nav-toggle" type="button" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="menu" id="menu">
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan kedaruratan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="<?= $h($wa_link) ?>" target="_blank">WhatsApp</a></li>
                    <li><a href="tel:<?= $h($no_telepon) ?>">Telepon</a></li>
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
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan<i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK & Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi" aria-current="page">Kunjungan Edukasi & Sosialisasi</a></li>
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
    <!-- HERO HALAMAN -->
    <section class="page-hero">
        <div class="wrap">
            <nav aria-label="Breadcrumb" class="rise">
                <ol class="crumbs">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/informasi-layanan">Layanan</a></li>
                    <li><span aria-current="page">Kunjungan Edukasi</span></li>
                </ol>
            </nav>
            <h1 class="rise d1">Kunjungan Edukasi <br>&amp; Sosialisasi</h1>
            <p class="rise d2">Ajukan permohonan kunjungan edukasi dan pelatihan penanggulangan kebakaran untuk sekolah, kampus, institusi, maupun masyarakat umum Kota Jambi secara daring.</p>
        </div>
    </section>

    <div class="page-body">
        <div class="wrap">

            <!-- RINGKASAN FAKTA LAYANAN -->
            <div class="facts">
                <div class="fact">
                    <span class="c-ico"><i class="fas fa-money-bill-wave"></i></span>
                    <div>
                        <small>Biaya Layanan</small>
                        <strong>Gratis (Tidak Dipungut Biaya)</strong>
                    </div>
                </div>
                <div class="fact">
                    <span class="c-ico"><i class="fas fa-calendar-check"></i></span>
                    <div>
                        <small>Produk Layanan</small>
                        <strong>Persetujuan Jadwal Kunjungan Edukasi</strong>
                    </div>
                </div>
                <div class="fact">
                    <span class="c-ico"><i class="fab fa-whatsapp"></i></span>
                    <div>
                        <small>Pengaduan Layanan</small>
                        <a href="<?= $wa_link ?>" target="_blank">WhatsApp +62 8117113113</a>
                    </div>
                </div>
            </div>

            <div class="perizinan-layout">

                <!-- INFORMASI SIDEBAR -->
                <aside class="info-stack" aria-label="Informasi layanan">
                    <a class="jump" href="#formulir"><i class="fas fa-arrow-down"></i> Langsung ke formulir</a>

                    <section class="side-card">
                        <div class="card-head">
                            <span class="c-ico"><i class="fas fa-clipboard-check"></i></span>
                            <h2>Persyaratan</h2>
                        </div>
                        <ol class="checklist">
                            <li>
                                <span class="ck-ico"><i class="fas fa-file-signature"></i></span>
                                <div>
                                    Unggah <strong>Surat Permohonan Bermaterai</strong>.
                                    <br><a href="#" class="inline">Unduh templat surat (jika ada)</a>
                                </div>
                            </li>
                            <li>
                                <span class="ck-ico"><i class="fas fa-folder-open"></i></span>
                                <div>
                                    Unggah detail persyaratan lainnya (opsional/bisa dalam format ZIP):
                                    <ul class="muted mt-2" style="font-size: .85rem; padding-left:14px; list-style:circle;">
                                        <li>Foto copy KTP Penanggung Jawab</li>
                                        <li>Data Peserta Edukasi & Jadwal</li>
                                        <li>Surat Kesediaan Membawa Peralatan</li>
                                        <li>Pernyataan Kesediaan Sarpras Proteksi Gedung</li>
                                    </ul>
                                </div>
                            </li>
                        </ol>
                    </section>

                </aside>

                <!-- FORMULIR PENGAJUAN -->
                <section class="form-panel" id="formulir">
                    <div class="form-bar">
                        <div class="form-title">
                            <i class="fas fa-bullhorn"></i>
                            <div>
                                <h2>Formulir Edukasi & Sosialisasi</h2>
                                <p>Lengkapi data institusi dan detail kegiatan Anda.</p>
                            </div>
                        </div>
                        <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
                    </div>

                    <form class="form-body" action="{{ route('permohonan.edukasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <fieldset class="fs">
                            <legend><i class="fas fa-building"></i> Data Institusi</legend>
                            <div class="fields">
                                <div class="field full">
                                    <label class="label" for="institusi">Institusi (Sekolah/Kampus/Instansi) <span class="req">*</span></label>
                                    <input class="input" type="text" id="institusi" name="institusi" value="{{ old('institusi') }}" required>
                                </div>
                                
                                <div class="field full">
                                    <label class="label" for="alamat_institusi">Alamat Lengkap Institusi <span class="req">*</span></label>
                                    <textarea class="input textarea" id="alamat_institusi" name="alamat_institusi" rows="3" required>{{ old('alamat_institusi') }}</textarea>
                                </div>

                                <div class="field">
                                    <label class="label" for="kecamatan">Kecamatan <span class="req">*</span></label>
                                    <select class="input" id="kecamatan" name="kecamatan" required>
                                        <option value="" disabled <?= !$oldKec ? 'selected' : '' ?>>Pilih kecamatan</option>
                                        <?php foreach (array_keys($dataWilayah) as $kc): ?>
                                            <option value="<?= $h($kc) ?>" <?= ($oldKec === $kc) ? 'selected' : '' ?>><?= $h($kc) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="field">
                                    <label class="label" for="kelurahan">Kelurahan <span class="req">*</span></label>
                                    <select class="input" id="kelurahan" name="kelurahan" required>
                                        <?php if ($oldKec && isset($dataWilayah[$oldKec])): ?>
                                            <option value="" disabled <?= !$oldKel ? 'selected' : '' ?>>Pilih kelurahan</option>
                                            <?php foreach ($dataWilayah[$oldKec] as $kl): ?>
                                                <option value="<?= $h($kl) ?>" <?= ($oldKel === $kl) ? 'selected' : '' ?>><?= $h($kl) ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="fs">
                            <legend><i class="fas fa-user-tie"></i> Data Penanggung Jawab</legend>
                            <div class="fields">
                                <div class="field">
                                    <label class="label" for="nama_pemohon">Nama Lengkap <span class="req">*</span></label>
                                    <input class="input" type="text" id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required>
                                </div>
                                <div class="field">
                                    <label class="label" for="jabatan_pemohon">Jabatan <span class="req">*</span></label>
                                    <input class="input" type="text" id="jabatan_pemohon" name="jabatan_pemohon" value="{{ old('jabatan_pemohon') }}" required>
                                </div>
                                <div class="field">
                                    <label class="label" for="nik">NIK KTP <span class="req">*</span></label>
                                    <input class="input" type="text" id="nik" name="nik" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 Digit" required>
                                </div>
                                <div class="field">
                                    <label class="label" for="no_kontak">No Kontak / WhatsApp <span class="req">*</span></label>
                                    <input class="input" type="tel" id="no_kontak" name="no_kontak" value="{{ old('no_kontak') }}" placeholder="08xxxxxxxxxx" required>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="fs">
                            <legend><i class="fas fa-calendar-day"></i> Rincian Kegiatan</legend>
                            <div class="fields">
                                <div class="field full">
                                    <label class="label" for="tgl_kegiatan">Rencana Tanggal Pelaksanaan <span class="req">*</span></label>
                                    <input class="input" type="date" id="tgl_kegiatan" name="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}" required style="max-width: 250px;">
                                </div>
                                <div class="field full">
                                    <label class="label" style="margin-bottom: 12px;">Jumlah & Perkiraan Usia Peserta</label>
                                    <div class="grid-age">
                                        <div>
                                            <span class="hint d-block mb-1 text-center">Usia 3 - 6 Tahun</span>
                                            <input type="number" class="input" name="usia_3_6" value="{{ old('usia_3_6', 0) }}" min="0">
                                        </div>
                                        <div>
                                            <span class="hint d-block mb-1 text-center">Usia 7 - 12 Tahun</span>
                                            <input type="number" class="input" name="usia_7_12" value="{{ old('usia_7_12', 0) }}" min="0">
                                        </div>
                                        <div>
                                            <span class="hint d-block mb-1 text-center">Usia 13 - 18 Tahun</span>
                                            <input type="number" class="input" name="usia_13_18" value="{{ old('usia_13_18', 0) }}" min="0">
                                        </div>
                                        <div>
                                            <span class="hint d-block mb-1 text-center">Usia > 18 Tahun</span>
                                            <input type="number" class="input" name="usia_18_keatas" value="{{ old('usia_18_keatas', 0) }}" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="fs">
                            <legend><i class="fas fa-paperclip"></i> Unggah Berkas</legend>
                            <div class="fields">
                                <div class="field full">
                                    <span class="label">Surat Permohonan Bermaterai <span class="req">*</span></span>
                                    <label class="dropzone" data-dropzone>
                                        <input type="file" name="surat_permohonan" accept=".pdf,.jpg,.jpeg,.png" required>
                                        <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                        <span class="dz-text"><strong>Tarik berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                        <span class="hint">(Maksimal 5MB, format PDF/JPG/PNG)</span>
                                        <ul class="dz-files"></ul>
                                    </label>
                                </div>
                                <div class="field full">
                                    <span class="label">Persyaratan Lainnya (Opsional)</span>
                                    <label class="dropzone" data-dropzone>
                                        <!-- Multi-upload support untuk form ini -->
                                        <input type="file" name="syarat_lainnya[]" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar" multiple>
                                        <span class="dz-ico" style="background:#eaf1f8; color:#2f6fed;"><i class="fas fa-folder-open"></i></span>
                                        <span class="dz-text"><strong>Tarik berkas tambahan ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                        <span class="hint">Jadikan 1 file ZIP/RAR jika lebih dari 1 dokumen (Maks 10MB)</span>
                                        <ul class="dz-files"></ul>
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-actions border-top pt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim Pengajuan Edukasi</button>
                            <p>Notifikasi jadwal akan dikirimkan ke WhatsApp pemohon.</p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER IDENTIK RPKBGL -->
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
                    <iframe title="Lokasi Dinas Pemadam Kebakaran Kota Jambi" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="<?= $h($maps_link) ?>" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>

                <div class="app-dl">
                    <p>Unduh aplikasi SIMERAH KOJA</p>
                    <a href="#" target="_blank" rel="noopener">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Dapatkan di Google Play">
                    </a>
                </div>
            </div>

            <div class="footer-links">
                <h3>Link terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> SIKOJA</a></li>
                    <li><a href="tel:112"><i class="fas fa-angle-right"></i> 112 Call Center</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; <?= date('Y') ?>. Hak cipta dilindungi.</div>
            <div class="social">
                <a href="mailto:damkar.jbi@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- Pustaka JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
(function () {
    'use strict';

    /* ---------- SweetAlert Notifikasi ---------- */
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#e5392d',
            confirmButtonText: 'Tutup'
        });
    @endif

    @if($errors->any())
        let errorMsg = '<ul style="text-align:left; margin-top:10px; font-size:14px;">';
        @foreach($errors->all() as $error)
            errorMsg += '<li>- {{ $error }}</li>';
        @endforeach
        errorMsg += '</ul>';

        Swal.fire({
            icon: 'error',
            title: 'Mohon Periksa Kembali!',
            html: errorMsg,
            confirmButtonColor: '#e5392d',
            confirmButtonText: 'Perbaiki'
        });
    @endif

    /* ---------- Navigasi Menu ---------- */
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

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    /* ---------- Kelurahan mengikuti Kecamatan ---------- */
    var dataWilayah = <?= json_encode($dataWilayah) ?>;
    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');

    kec.addEventListener('change', function () {
        kel.innerHTML = '';
        var ph = new Option('Pilih kelurahan', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        (dataWilayah[kec.value] || []).forEach(function (nama) {
            kel.add(new Option(nama, nama));
        });
    });

    /* ---------- Area Unggah Berkas (Dropzone) ---------- */
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
                li.innerHTML = '<i class="fas fa-check-circle" style="color:#10b981"></i> ' + f.name + ' (' + fmtSize(f.size) + ')';
                list.appendChild(li);
            });
            dz.classList.toggle('has-files', input.files.length > 0);
        });
    });

})();
</script>
</body>
</html>