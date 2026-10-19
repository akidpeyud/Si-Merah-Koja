<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    // Tangkap data lama
    $old = session()->getOldInput() ?: [];
    
    // Penanda kolom galat (Disesuaikan dengan standar REDKAR)
    $inv = function ($n) use ($errors) { return (isset($errors) && $errors->has($n)) ? ' is-invalid' : ''; };
    $fe  = function ($n) use ($errors) {
        return (isset($errors) && $errors->has($n))
            ? '<p class="field-err"><i class="fas fa-circle-exclamation"></i> ' . e($errors->first($n)) . '</p>'
            : '';
    };

    // TAB LAYANAN UNTUK NAVIGASI TENGAH
    $layanan = config('layanan'); // urutan, label & ikon diatur di config/layanan.php
    $tab_aktif = 'edukasi';
    
    // URL Surat Permohonan Edukasi & Sosialisasi
    $url_surat_permohonan = asset('dokumen/FORMULIR-3.docx');

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
    $pesan_wa       = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    $wa_link        = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link      = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Ajukan Kunjungan Edukasi & Sosialisasi secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>Kunjungan Edukasi & Sosialisasi - Layanan | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS & BASE
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
            --ok: #16a34a;
            --ok-bg: #dcfce7;
            --warn: #d97706;
            --warn-bg: #fef3c7;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 28px;
            --r-md: 18px;
            --r-sm: 10px;
            --wrap: 1300px;
            --header-h: 64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.65; color: var(--ink); background: var(--white); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        body:has(dialog[open]) { overflow: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
        .d-block { display: block; }
        .mb-1 { margin-bottom: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .pt-4 { padding-top: 1.5rem; }
        .border-top { border-top: 1px solid var(--line); }
        .text-center { text-align: center; }

        /* ==========================================================
           HEADER & NAVBAR
           ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 60;
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

        .brand { display: flex; align-items: center; flex: none; }
        .brand a { display: flex; align-items: center; }
        .brand a + a { margin-left: 14px; padding-left: 14px; border-left: 1px solid rgba(255,255,255,.16); }
        .brand img { height: 36px; width: auto; }

        .nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; }

        .menu { display: flex; align-items: center; justify-content: center; gap: 2px; flex: 1; min-width: 0; }
        .menu > li { position: relative; }

        .menu-link, .menu-trigger {
            position: relative; display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 11px; color: rgba(255,255,255,.78);
            font-size: .875rem; font-weight: 500; letter-spacing: .005em; white-space: nowrap;
            transition: color .2s;
        }
        .menu-link::after, .menu-trigger::after {
            content: ""; position: absolute; left: 11px; right: 11px; bottom: 2px; height: 2px;
            border-radius: 2px; background: var(--amber);
            transform: scaleX(0); transform-origin: left; transition: transform .25s ease;
        }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after { transform: scaleX(1); }

        .menu-trigger i { font-size: .6rem; opacity: .6; transition: transform .2s, opacity .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); opacity: 1; }

        .nav-actions { display: flex; align-items: center; gap: 10px; flex: none; }
        .nav-actions > li { position: relative; }

        .btn-nav {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            height: 40px; padding: 0 16px; border-radius: 999px;
            font-size: .875rem; font-weight: 600; white-space: nowrap;
            transition: background .2s, border-color .2s, color .2s, transform .2s;
        }
        .btn-nav:active { transform: scale(.97); }
        .btn-nav i.fa-chevron-down { font-size: .6rem; opacity: .8; transition: transform .2s; }
        .has-drop.open > .btn-nav i.fa-chevron-down { transform: rotate(180deg); }

        .btn-nav--alert { background: var(--signal); color: #fff; }
        .btn-nav--alert:hover, .has-drop.open > .btn-nav--alert { background: var(--signal-d); }
        .btn-nav--alert .beacon { width: 8px; height: 8px; background: #fff; }
        .btn-nav--alert .beacon::after { background: #fff; }

        .btn-nav--ghost { border: 1.5px solid rgba(255,255,255,.3); color: #fff; }
        .btn-nav--ghost:hover, .has-drop.open > .btn-nav--ghost { border-color: #fff; background: rgba(255,255,255,.08); }

        .dropdown {
            position: absolute; top: calc(100% + 14px); left: 50%; min-width: 250px; width: max-content; max-width: 320px;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
            visibility: hidden; opacity: 0; pointer-events: none;
            transform: translate(-50%, 6px);
            transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s;
        }
        .nav-actions .dropdown { left: auto; right: 0; transform: translate(0, 6px); }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -14px; height: 14px; }
        .dropdown::after {
            content: ""; position: absolute; top: -6px; left: 50%; width: 10px; height: 10px; margin-left: -5px;
            background: var(--ink-2); border-top: 1px solid rgba(255,255,255,.1); border-left: 1px solid rgba(255,255,255,.1);
            transform: rotate(45deg);
        }
        .nav-actions .dropdown::after { left: auto; right: 24px; margin-left: 0; }

        .has-drop.open > .dropdown {
            visibility: visible; opacity: 1; pointer-events: auto;
            transform: translate(-50%, 0); transition-delay: 0s;
        }
        .nav-actions .has-drop.open > .dropdown { transform: translate(0, 0); }

        .dropdown a, .dropdown .btn-logout {
            display: flex; align-items: center; gap: 12px; width: 100%;
            padding: 10px 14px; border-radius: var(--r-sm);
            font-size: .9rem; line-height: 1.4; color: rgba(255,255,255,.85); text-align: left; white-space: normal;
            transition: background .15s, color .15s;
        }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.08); color: #fff; }
        .dropdown a i { width: 18px; text-align: center; font-size: 1rem; flex: none; }
        .dropdown a .fa-phone-alt { color: #38bdf8; }
        .dropdown a .fa-whatsapp  { color: #25d366; }
        .dropdown a .fa-headset   { color: #f87171; }
        .dropdown .btn-logout { color: #ff8b8b; cursor: pointer; }
        .dropdown .btn-logout:hover { background: rgba(255,255,255,.08); color: #ffb8b8; }

        .has-sub { position: relative; }
        .has-sub > .sub-trigger {
            width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 10px;
            padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; line-height: 1.4; text-align: left;
            color: rgba(255,255,255,.85); transition: background .15s, color .15s;
        }
        .has-sub > .sub-trigger i { font-size: .65rem; opacity: .7; transition: transform .2s; }
        .has-sub > .sub-trigger:hover, .has-sub.open > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }

        .dropdown-sub {
            display: none; position: absolute; top: -8px; left: 100%; min-width: 230px; margin-left: 6px; z-index: 10;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
        }
        .dropdown-sub::before { content: ""; position: absolute; top: 0; bottom: 0; left: -12px; width: 12px; }
        .has-sub.open > .dropdown-sub { display: block; }

        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; align-items: center; justify-content: center; }
        .nav-toggle:hover { background: rgba(255,255,255,.1); }

        @media (hover: hover) and (min-width: 1201px) {
            .has-drop:hover > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
            .nav-actions .has-drop:hover > .dropdown { transform: translate(0, 0); }
            .has-drop:hover > .menu-trigger { color: #fff; }
            .has-drop:hover > .menu-trigger::after { transform: scaleX(1); }
            .has-sub:hover > .dropdown-sub { display: block; }
            .has-sub:hover > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }

            .dropdown-sub { left: auto; right: 100%; margin-left: 0; margin-right: 6px; }
            .dropdown-sub::before { left: auto; right: -12px; }
            .has-sub > .sub-trigger i { transform: rotate(180deg); }
        }

        @media (max-width: 1200px) {
            .nav { gap: 12px; }
            .nav-toggle { display: inline-flex; margin-left: auto; }

            .nav-panel {
                display: none; position: absolute; top: 100%; left: 0; right: 0;
                max-height: calc(100dvh - var(--header-h)); overflow-y: auto; overscroll-behavior: contain;
                flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 20px;
                padding: 8px clamp(16px, 4vw, 32px) 28px;
                background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1);
                box-shadow: 0 30px 40px rgba(0,0,0,.35);
            }
            .nav-open .nav-panel { display: flex; }

            .menu { flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 0; flex: none; }
            .menu > li { border-bottom: 1px solid rgba(255,255,255,.08); }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 16px 4px; font-size: 1rem; white-space: normal; color: rgba(255,255,255,.9); }
            .menu-link::after, .menu-trigger::after { display: none; }
            .menu-link.is-active { color: var(--amber); }
            .menu-trigger i { font-size: .7rem; }

            .nav-actions { flex-direction: column; align-items: stretch; gap: 10px; }
            .btn-nav { height: 48px; font-size: 1rem; }
            .nav-actions .has-drop > .btn-nav { width: 100%; }

            .dropdown, .nav-actions .dropdown {
                display: none; position: static; min-width: 0; width: auto; max-width: none; margin: 0 0 12px 4px; padding: 0 0 0 12px;
                background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none;
                visibility: visible; opacity: 1; pointer-events: auto; transform: none; transition: none;
            }
            .dropdown::before, .dropdown::after { display: none; }
            .has-drop.open > .dropdown, .nav-actions .has-drop.open > .dropdown { display: block; transform: none; }
            .dropdown a, .dropdown .btn-logout { padding: 13px 12px; font-size: .95rem; }

            .has-sub > .sub-trigger { padding: 13px 12px; font-size: .95rem; }
            .has-sub.open > .sub-trigger i { transform: rotate(90deg); }
            .dropdown-sub { position: static; margin: 2px 0 6px 8px; padding: 0 0 0 10px; min-width: 0; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none; }
            .dropdown-sub::before { display: none; }
        }

        @media (max-width: 480px) {
            .brand img { height: 30px; }
            .brand a + a { margin-left: 10px; padding-left: 10px; }
        }
        body.nav-lock { overflow: hidden; }

        /* ==========================================================
           HERO HALAMAN
           ========================================================== */
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
        
        /* TAB BAR LAYANAN TENGAH */
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
        .facts { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-top: 28px; position: relative; z-index: 2; margin-bottom: 24px;}
        .fact { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: 0 10px 25px -10px rgba(13,27,42,.15); }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

        /* KONTEN GRID */
        .perizinan-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 24px; align-items: start; }
        @media (min-width: 992px) { 
            .perizinan-layout { grid-template-columns: minmax(300px, 380px) minmax(0, 1fr); gap: 32px; } 
            .info-stack { position: sticky; top: calc(var(--header-h) + 24px); }
        }
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

        /* FORMULIR & VALIDASI REAL-TIME */
        .form-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: 0 10px 30px rgba(13, 27, 42, 0.03); }
        .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 18px clamp(18px, 3vw, 32px); border-bottom: 1px solid var(--line); }
        .form-title { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .form-title > i { flex: none; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; }
        .form-title h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; }
        .form-title p { font-size: .85rem; color: var(--steel); line-height: 1.4; margin-top: 2px; }
        .form-note { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }

        .form-body { padding: clamp(18px, 3vw, 32px); display: grid; gap: 36px; }
        .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .9rem; line-height: 1.5; }
        .alert i { margin-top: 4px; flex: none; }
        .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
        .alert ul { display: grid; gap: 4px; margin-top: 6px; padding-left: 18px; list-style: disc; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
        .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
        .field { min-width: 0; display: flex; flex-direction: column; }
        .field.full { grid-column: 1 / -1; }
        @media (max-width: 640px) { .fields { grid-template-columns: minmax(0, 1fr); } }

        .label { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px; font-size: .9rem; font-weight: 600; line-height: 1.35; color: var(--ink); }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }
        .field-err { margin-top: 6px; display: flex; gap: 8px; align-items: flex-start; font-size: .82rem; font-weight: 500; line-height: 1.4; color: var(--signal-d); }
        .field-err i { margin-top: 2px; flex: none; }
        .field-err:empty { display: none; }

        .input { display: block; width: 100%; height: 48px; padding: 0 16px; border: 1px solid var(--line); border-radius: 14px; background: #fff; font: inherit; font-size: .95rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
        .input.textarea { height: auto; min-height: 84px; padding: 12px 16px; resize: vertical; line-height: 1.5; }
        .input::placeholder { color: #93a1b1; }
        .input:hover:not(:disabled) { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        .input:user-invalid, .input.is-invalid { border-color: var(--signal); }
        .input.is-valid { border-color: var(--ok); }
        .input.is-valid:focus { border-color: var(--ok); box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.25); }
        select.input { appearance: none; -webkit-appearance: none; padding-right: 42px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 16px center; }
        
        /* BADGE & STATUS VALIDASI REAL-TIME (Sesuai REDKAR) */
        .pw-badge {
            display: none; align-items: center; gap: 4px; padding: 2px 8px; border-radius: 999px;
            font-size: .72rem; font-weight: 700; letter-spacing: .01em;
        }
        .pw-badge.show { display: inline-flex; }
        .pw-badge.match { background: var(--ok-bg); color: var(--ok); }
        .pw-badge.warn { background: var(--warn-bg); color: var(--warn); }
        .pw-badge.mismatch { background: #fdeceb; color: var(--signal-d); }

        .pw-status {
            margin-top: 6px; display: none; align-items: center; gap: 6px;
            font-size: .8rem; font-weight: 600; line-height: 1.35;
        }
        .pw-status.show { display: inline-flex; }
        .pw-status.match { color: var(--ok); }
        .pw-status.warn { color: var(--warn); }
        .pw-status.mismatch { color: var(--signal-d); }

        @media (max-width: 640px) {
            .input, select.input, .input.textarea { font-size: 16px; }
        }

        .grid-age { display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 14px; }
        .grid-age .input { text-align: center; }

        /* AREA UNGGAH BERKAS (DROPZONE SESUAI REDKAR) */
        .dropzone {
            position: relative; display: grid; justify-items: center; gap: 8px; text-align: center;
            padding: 26px 20px; border: 2px dashed #b8c3d0; border-radius: var(--r-md);
            background: var(--paper); color: var(--steel); font-size: .92rem; line-height: 1.45;
            cursor: pointer; transition: border-color .2s, background .2s;
        }
        .dropzone:hover, .dropzone.is-over { border-color: var(--signal); background: #fdeceb; }
        .dropzone:focus-within { outline: 3px solid var(--amber); outline-offset: 3px; }
        .dropzone.has-files { border-style: solid; border-color: var(--ink); background: #fff; cursor: default; }
        .dropzone.is-invalid { border-color: var(--signal); background: #fff5f5; }
        .dropzone input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 1; }
        .dropzone.has-files input[type="file"] { pointer-events: none; }

        .dz-prompt { display: grid; justify-items: center; gap: 8px; }
        .dropzone.has-files .dz-prompt { display: none; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; box-shadow: 0 4px 10px rgba(0,0,0,.04); }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }

        .dz-preview { display: none; width: 100%; flex-direction: column; gap: 10px; z-index: 2; position: relative; }
        .dropzone.has-files .dz-preview { display: flex; }
        .dz-meta {
            display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;
            width: 100%; padding: 10px 14px; border-radius: 12px; background: var(--paper); border: 1px solid var(--line);
        }
        .dz-files { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; min-width: 0; flex: 1; }
        .dz-files:empty { display: none; }
        .dz-files li { display: inline-flex; align-items: center; gap: 7px; padding: 4px 10px; border-radius: 999px; background: #fff; border: 1px solid var(--line); font-size: .82rem; font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }
        .dz-files li i { color: var(--ok); flex: none; }
        .dz-files li span.f-size { color: var(--steel); font-weight: 500; font-size: .78rem; }

        .dz-actions { display: flex; align-items: center; gap: 6px; flex: none; }
        .btn-dz {
            display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px;
            font-size: .78rem; font-weight: 700; transition: background .15s, color .15s, transform .15s;
        }
        .btn-dz:active { transform: scale(.96); }
        .btn-dz--change { background: #fff; border: 1px solid var(--line); color: var(--ink); }
        .btn-dz--change:hover { background: var(--ink); color: #fff; border-color: var(--ink); }
        .btn-dz--remove { background: #fdeceb; color: var(--signal-d); }
        .btn-dz--remove:hover { background: var(--signal); color: #fff; }

        @media (max-width: 480px) {
            .dz-meta { flex-direction: column; align-items: stretch; text-align: left; }
            .dz-actions { width: 100%; justify-content: stretch; }
            .btn-dz { flex: 1; justify-content: center; padding: 8px 10px; }
        }

        .form-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 20px; padding-top: 4px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s, transform .15s; border: none; cursor: pointer;}
        .btn:active:not(:disabled) { transform: scale(.98); }
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover:not(:disabled) { background: var(--signal-d); }
        .btn-primary:disabled { background: #fca5a5; cursor: not-allowed; box-shadow: none; }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--ink-3); }
        .form-actions p { font-size: .88rem; color: var(--steel); margin: 0;}
        @media (max-width: 640px) { .form-actions .btn { width: 100%; } }

        /* ---------- Cek status permohonan ---------- */
        .cs-desc { font-size: .9rem; color: var(--steel); line-height: 1.5; margin-bottom: 14px; }
        .cs-form { display: flex; gap: 10px; }
        .cs-form .input { flex: 1; min-width: 0; }
        .cs-btn { flex: none; height: 48px; padding: 0 20px; font-size: .92rem; }
        .cs-btn[disabled] { opacity: .6; cursor: progress; }
        .cs-list { display: grid; gap: 12px; margin-top: 16px; }
        .cs-list:empty { display: none; }
        .cs-item { border: 1px solid var(--line); border-radius: 14px; padding: 14px 16px; background: #fff; }
        .cs-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
        .cs-kegiatan { font-weight: 700; font-size: .95rem; line-height: 1.35; overflow-wrap: anywhere; }
        .cs-meta { margin-top: 6px; font-size: .82rem; color: var(--steel); line-height: 1.55; overflow-wrap: anywhere; }
        .cs-note { margin-top: 10px; padding: 8px 10px; border-radius: 10px; font-size: .84rem; line-height: 1.45; }
        .cs-badge { flex: none; padding: 4px 10px; border-radius: 999px; font-size: .78rem; font-weight: 700; border: 1px solid; white-space: nowrap; }
        .cs-menunggu  { background: #fffbeb; color: #b45309; border-color: #fde68a; }
        .cs-proses    { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .cs-disetujui { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .cs-ditolak   { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        .cs-empty { padding: 14px 16px; border: 1px dashed var(--line); border-radius: 14px; font-size: .9rem; color: var(--steel); text-align: center; }

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
        
        .beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
    </style>
</head>
<body>

<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <div class="brand">
            <a href="/" aria-label="SIMERAH KOJA, beranda">
                <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            </a>
            <a href="/" title="Beranda">
                <img src="/images/logo.png" alt="Logo Damkar">
            </a>
            <a href="/redkar" aria-label="Redkar">
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </a>
        </div>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navPanel">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-panel" id="navPanel">
            <!-- ===== Menu utama ===== -->
            <ul class="menu">
                <li><a class="menu-link {{ request()->is('public-sigap*') ? 'is-active' : '' }}" href="/public-sigap">Sigapkar</a></li>

                <li class="has-drop current">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        @include('layouts.partials.layanan-dropdown')
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Produk Hukum <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/produk-hukum/undang-undang">Undang-Undang</a></li>
                        <li><a href="/produk-hukum/peraturan-pemerintah">Peraturan Pemerintah</a></li>
                        <li><a href="/produk-hukum/peraturan-menteri">Peraturan Menteri</a></li>
                        <li><a href="/produk-hukum/peraturan-daerah">Peraturan Daerah</a></li>
                        <li><a href="/produk-hukum/peraturan-kepala-daerah">Peraturan Kepala Daerah</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Profil <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/profil/visi-misi">Visi Misi</a></li>
                        <li><a href="/profil/sotk">SOTK</a></li>
                        <li><a href="/profil/tupoksi">Tupoksi</a></li>
                        <li><a href="/profil/kepegawaian">Kepegawaian</a></li>
                        <li><a href="/profil/program-kegiatan">Program Kegiatan</a></li>
                        <li><a href="/profil/cascading">Cascading</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">SOP <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/sop/pencegahan">Pencegahan</a></li>
                        <li><a href="/sop/pemadaman">Pemadaman Kebakaran</a></li>
                        <li><a href="/sop/penyelamatan">Penyelamatan dan Evakuasi</a></li>
                        <li><a href="/sop/sarpras">Sarana dan Prasarana</a></li>
                        <li><a href="/sop/kepegawaian">Kepegawaian</a></li>
                        <li><a href="/sop/keuangan">Keuangan</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Dokumen <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/dokumen/renstra">Renstra</a></li>
                        <li><a href="/dokumen/renja">Renja</a></li>
                        <li><a href="/dokumen/spm">SPM</a></li>
                        <li><a href="/dokumen/sakip">SAKIP</a></li>
                        <li><a href="/dokumen/lppd">LPPD</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Sarpras <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="{{ route('sarpras.sarana') }}">Sarana</a></li>
                        <li><a href="{{ route('sarpras.prasarana') }}">Prasarana</a></li>
                    </ul>
                </li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Galeri <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/ikm">IKM (Indeks Kepuasan Masyarakat)</a></li>
                        <li><a href="/pengumuman">Pengumuman</a></li>
                        <li class="has-sub">
                            <button class="sub-trigger" type="button" aria-expanded="false">
                                Berita <i class="fas fa-chevron-right"></i>
                            </button>
                            <ul class="dropdown-sub">
                                <li><a href="/edu-damkar">Edu Damkar</a></li>
                                <li><a href="{{ route('publik.infografis') }}">Infografis</a></li>
                                <li><a href="/media-informasi">Media Informasi</a></li>
                                <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a class="menu-link {{ request()->is('redkar*') ? 'is-active' : '' }}" href="/redkar">Redkar</a></li>
            </ul>

            <!-- ===== Tombol kanan: Lapor darurat + Masuk ===== -->
            <ul class="nav-actions">
                <li class="has-drop">
                    <button class="btn-nav btn-nav--alert menu-trigger-cta" type="button" aria-expanded="false">
                        <span class="beacon" aria-hidden="true"></span> Lapor darurat <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown">
                        <li><a href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a></li>
                        <li><a href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon {{ $telepon_tampil }}</a></li>
                        <li><a href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                    </ul>
                </li>

                @if(session()->has('pemohon_id'))
                    <li class="has-drop">
                        <button class="btn-nav btn-nav--ghost menu-trigger-cta" type="button" aria-expanded="false">
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
                    <li><a class="btn-nav btn-nav--ghost" href="{{ route('pemohon.login') }}">Masuk</a></li>
                @endif
            </ul>
        </div>
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
            <p class="rise d2">Ajukan Permohonan Kunjungan Edukasi dan Sosialisasi ke Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
        </div>
    </section>

    <div class="page-body">
        
        <!-- Tab layanan -->
        <div class="wrap tabs-wrap">
            @include('layouts.partials.layanan-tabs')
        </div>

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
                        <a href="<?= $wa_link ?>" target="_blank" rel="noopener">WhatsApp +62 8117113113</a>
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
                                    @if($url_surat_permohonan)
                                        <br><a href="{{ $url_surat_permohonan }}" class="inline" download><i class="fas fa-download"></i> Unduh surat permohonan</a>
                                    @else
                                        <br><span class="muted">Templat surat permohonan belum tersedia</span>
                                    @endif
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

                    <!-- Cek status permohonan -->
                    <section class="side-card" id="cek-status" aria-label="Cek status permohonan">
                        <div class="card-head">
                            <span class="c-ico"><i class="fas fa-magnifying-glass"></i></span>
                            <h2>Cek Status Permohonan</h2>
                        </div>
                        <p class="cs-desc">Masukkan NIK atau No Kontak / WhatsApp yang Anda gunakan saat mengajukan permohonan.</p>

                        <form class="cs-form" id="csForm" data-no-loader="true" novalidate>
                            <label class="sr-only" for="csKontak">NIK atau No Kontak / WhatsApp</label>
                            <input class="input" type="text" id="csKontak" name="kontak" inputmode="numeric" maxlength="16" autocomplete="off" placeholder="NIK atau Nomor WA" required>
                            <button type="submit" class="btn btn-dark cs-btn" id="csBtn"><i class="fas fa-search"></i> Cek</button>
                        </form>

                        <p class="field-err" id="csErr" role="alert"></p>
                        <ul class="cs-list" id="csList" aria-live="polite"></ul>
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

                    <form class="form-body" action="{{ route('permohonan.edukasi.store') }}" method="POST" enctype="multipart/form-data" id="form_edukasi">
                        @csrf

                        @if($errors->any())
                            <div class="alert err" role="alert">
                                <i class="fas fa-triangle-exclamation"></i>
                                <div>
                                    <strong>Mohon periksa kembali form Anda:</strong>
                                    <ul>
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <fieldset class="fs">
                            <legend><i class="fas fa-building"></i> Data Institusi</legend>
                            <div class="fields">
                                <div class="field full">
                                    <label class="label" for="institusi"><span>Institusi (Sekolah/Lembaga/Instansi) <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('institusi') }}" type="text" id="institusi" name="institusi" value="{{ old('institusi') }}" required>
                                    {!! $fe('institusi') !!}
                                </div>
                                
                                <div class="field full">
                                    <label class="label" for="alamat_institusi"><span>Alamat Lengkap Institusi <span class="req">*</span></span></label>
                                    <textarea class="input textarea{{ $inv('alamat_institusi') }}" id="alamat_institusi" name="alamat_institusi" rows="3" required>{{ old('alamat_institusi') }}</textarea>
                                    {!! $fe('alamat_institusi') !!}
                                </div>

                                <div class="field">
                                    <label class="label" for="kecamatan"><span>Kecamatan <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('kecamatan') }}" id="kecamatan" name="kecamatan" required>
                                        <option value="" disabled <?= !$oldKec ? 'selected' : '' ?>>Pilih kecamatan</option>
                                        <?php foreach (array_keys($dataWilayah) as $kc): ?>
                                            <option value="<?= $h($kc) ?>" <?= ($oldKec === $kc) ? 'selected' : '' ?>><?= $h($kc) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    {!! $fe('kecamatan') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="kelurahan"><span>Kelurahan <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('kelurahan') }}" id="kelurahan" name="kelurahan" required>
                                        <?php if ($oldKec && isset($dataWilayah[$oldKec])): ?>
                                            <option value="" disabled <?= !$oldKel ? 'selected' : '' ?>>Pilih kelurahan</option>
                                            <?php foreach ($dataWilayah[$oldKec] as $kl): ?>
                                                <option value="<?= $h($kl) ?>" <?= ($oldKel === $kl) ? 'selected' : '' ?>><?= $h($kl) ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                                        <?php endif; ?>
                                    </select>
                                    {!! $fe('kelurahan') !!}
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="fs">
                            <legend><i class="fas fa-user-tie"></i> Data Penanggung Jawab</legend>
                            <div class="fields">
                                <div class="field">
                                    <label class="label" for="nama_pemohon"><span>Nama Lengkap <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('nama_pemohon') }}" type="text" id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required>
                                    {!! $fe('nama_pemohon') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="jabatan_pemohon"><span>Jabatan <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('jabatan_pemohon') }}" type="text" id="jabatan_pemohon" name="jabatan_pemohon" value="{{ old('jabatan_pemohon') }}" required>
                                    {!! $fe('jabatan_pemohon') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="nik">
                                        <span>NIK KTP <span class="req">*</span></span>
                                        <span class="pw-badge" id="nik_badge">0/16</span>
                                    </label>
                                    <input class="input{{ $inv('nik') }}" type="text" id="nik" name="nik" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit NIK" required>
                                    <p class="pw-status" id="nik_msg" aria-live="polite"></p>
                                    {!! $fe('nik') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="no_kontak">
                                        <span>No Kontak / WhatsApp <span class="req">*</span></span>
                                        <span class="pw-badge" id="wa_badge"></span>
                                    </label>
                                    <input class="input{{ $inv('no_kontak') }}" type="tel" id="no_kontak" name="no_kontak" value="{{ old('no_kontak') }}" inputmode="tel" maxlength="14" placeholder="Contoh: 081234567890" required>
                                    <p class="pw-status" id="wa_msg" aria-live="polite"></p>
                                    {!! $fe('no_kontak') !!}
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="fs">
                            <legend><i class="fas fa-calendar-day"></i> Rincian Kegiatan</legend>
                            <div class="fields">
                                <div class="field full">
                                    <label class="label" for="tgl_kegiatan"><span>Rencana Tanggal Pelaksanaan <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('tgl_kegiatan') }}" type="date" id="tgl_kegiatan" name="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}" min="{{ date('Y-m-d') }}" required style="max-width: 280px;">
                                    <p class="pw-status" id="tgl_msg" aria-live="polite"></p>
                                    {!! $fe('tgl_kegiatan') !!}
                                </div>
                                <div class="field full">
                                    <label class="label" style="margin-bottom: 12px;"><span>Jumlah & Perkiraan Usia Peserta</span></label>
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
                                    <span class="label"><span>Surat Permohonan Bermaterai <span class="req">*</span></span></span>
                                    <div class="dropzone{{ $inv('surat_permohonan') }}" data-dropzone data-max="5" data-ext="pdf,jpg,jpeg,png">
                                        <input type="file" id="surat_permohonan" name="surat_permohonan" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required aria-label="Unggah Surat Permohonan Bermaterai">
                                        
                                        <div class="dz-prompt">
                                            <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                            <span class="dz-text"><strong>Tarik berkas ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                            <span class="hint">(Maksimal 5 MB, format PDF/JPG/PNG)</span>
                                        </div>

                                        <div class="dz-preview">
                                            <div class="dz-meta">
                                                <ul class="dz-files" aria-live="polite"></ul>
                                                <div class="dz-actions">
                                                    <button type="button" class="btn-dz btn-dz--change" data-dz-change><i class="fas fa-arrows-rotate"></i> Ganti</button>
                                                    <button type="button" class="btn-dz btn-dz--remove" data-dz-remove><i class="fas fa-trash-can"></i> Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="field-err dz-msg" role="alert"></p>
                                    {!! $fe('surat_permohonan') !!}
                                </div>

                                <div class="field full">
                                    <span class="label"><span>Persyaratan Lainnya (Opsional)</span></span>
                                    <div class="dropzone{{ $inv('syarat_lainnya') }}" data-dropzone data-max="10" data-ext="pdf,jpg,jpeg,png,zip,rar">
                                        <input type="file" id="syarat_lainnya" name="syarat_lainnya[]" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar" multiple aria-label="Unggah Persyaratan Lainnya">
                                        
                                        <div class="dz-prompt">
                                            <span class="dz-ico" style="background:#eaf1f8; color:#2f6fed;"><i class="fas fa-folder-open"></i></span>
                                            <span class="dz-text"><strong>Tarik berkas tambahan ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                            <span class="hint">Jadikan 1 file ZIP/RAR jika lebih dari 1 dokumen (Maks 10 MB per berkas)</span>
                                        </div>

                                        <div class="dz-preview">
                                            <div class="dz-meta">
                                                <ul class="dz-files" aria-live="polite"></ul>
                                                <div class="dz-actions">
                                                    <button type="button" class="btn-dz btn-dz--change" data-dz-change><i class="fas fa-arrows-rotate"></i> Ganti</button>
                                                    <button type="button" class="btn-dz btn-dz--remove" data-dz-remove><i class="fas fa-trash-can"></i> Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="field-err dz-msg" role="alert"></p>
                                    {!! $fe('syarat_lainnya') !!}
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-actions border-top pt-4">
                            <button type="submit" class="btn btn-primary" id="btn_submit_edukasi"><i class="fas fa-paper-plane"></i> Kirim Pengajuan Edukasi</button>
                            <p>Notifikasi jadwal akan dikirimkan ke WhatsApp pemohon.</p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER -->
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
                <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
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

    /* ---------- Navigasi Menu Multi-Dropdown ---------- */
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');
    var subs = header.querySelectorAll('.has-sub');
    var desktop = window.matchMedia('(hover: hover) and (min-width: 1201px)');

    function triggerOf(li) {
        return li.querySelector(':scope > .menu-trigger, :scope > .menu-trigger-cta');
    }

    function closeSubs() {
        subs.forEach(function (s) {
            s.classList.remove('open');
            var st = s.querySelector('.sub-trigger');
            if (st) st.setAttribute('aria-expanded', 'false');
        });
    }

    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                var tr = triggerOf(li);
                if (tr) tr.setAttribute('aria-expanded', 'false');
            }
        });
        if (!except) closeSubs();
    }

    function setMobileMenu(open) {
        header.classList.toggle('nav-open', open);
        document.body.classList.toggle('nav-lock', open);
        toggle.setAttribute('aria-expanded', open);
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        toggle.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-bars';
        if (!open) closeDrops(null);
    }

    toggle.addEventListener('click', function () {
        setMobileMenu(!header.classList.contains('nav-open'));
    });

    drops.forEach(function (li) {
        var btn = triggerOf(li);
        if (!btn) return;
        btn.addEventListener('click', function () {
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
            closeDrops(li);
        });
        
        li.addEventListener('mouseleave', function () {
            if (!desktop.matches) return;
            li.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            closeSubs();
        });
    });

    subs.forEach(function (li) {
        var btn = li.querySelector('.sub-trigger');
        if (!btn) return;
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeDrops(null);
            if (header.classList.contains('nav-open')) setMobileMenu(false);
        }
    });

    window.matchMedia('(min-width: 1201px)').addEventListener('change', function (e) {
        if (e.matches) setMobileMenu(false);
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

    /* ---------- State Validasi Form Real-Time (Standar REDKAR) ---------- */
    const btnSubmit = document.getElementById('btn_submit_edukasi');

    const nikInput = document.getElementById('nik');
    const nikBadge = document.getElementById('nik_badge');
    const nikMsg   = document.getElementById('nik_msg');

    const waInput = document.getElementById('no_kontak');
    const waBadge = document.getElementById('wa_badge');
    const waMsg   = document.getElementById('wa_msg');

    const tglInput = document.getElementById('tgl_kegiatan');
    const tglMsg   = document.getElementById('tgl_msg');

    let isNikValid  = true;
    let isWaValid   = true;
    let isDateValid = true;
    let isFileValid = true;

    function syncSubmitButton() {
        if (btnSubmit) {
            btnSubmit.disabled = !(isNikValid && isWaValid && isDateValid && isFileValid);
        }
    }

    /* ---------- Validasi NIK Real-Time ---------- */
    function validateNik() {
        let val = nikInput.value.replace(/\D/g, '').slice(0, 16);
        if (nikInput.value !== val) nikInput.value = val;

        if (!val) {
            nikBadge.className = 'pw-badge';
            nikBadge.innerHTML = '';
            nikMsg.className = 'pw-status';
            nikMsg.innerHTML = '';
            nikInput.classList.remove('is-valid', 'is-invalid');
            isNikValid = true;
        } else if (val.length < 16) {
            let kurang = 16 - val.length;
            nikBadge.className = 'pw-badge show mismatch';
            nikBadge.innerHTML = val.length + '/16';
            nikMsg.className = 'pw-status show mismatch';
            nikMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Kurang ' + kurang + ' digit angka lagi';
            nikInput.classList.add('is-invalid');
            nikInput.classList.remove('is-valid');
            isNikValid = false;
        } else {
            nikBadge.className = 'pw-badge show match';
            nikBadge.innerHTML = '<i class="fas fa-check"></i> 16/16';
            nikMsg.className = 'pw-status show match';
            nikMsg.innerHTML = '<i class="fas fa-circle-check"></i> Format 16 digit NIK sesuai';
            nikInput.classList.add('is-valid');
            nikInput.classList.remove('is-invalid');
            isNikValid = true;
        }
        syncSubmitButton();
    }
    nikInput.addEventListener('input', validateNik);
    if (nikInput.value) validateNik();

    /* ---------- Validasi WhatsApp Real-Time (Tanpa Badge "Aktif") ---------- */
    function validateWa() {
        let val = waInput.value.replace(/\D/g, '');
        if (val.startsWith('628')) {
            val = '08' + val.slice(3);
        } else if (val.startsWith('8')) {
            val = '08' + val.slice(1);
        }
        val = val.slice(0, 14);
        if (waInput.value !== val) waInput.value = val;

        if (!val) {
            waBadge.className = 'pw-badge';
            waBadge.innerHTML = '';
            waMsg.className = 'pw-status';
            waMsg.innerHTML = '';
            waInput.classList.remove('is-valid', 'is-invalid');
            isWaValid = true;
        } else if (!val.startsWith('08')) {
            waBadge.className = 'pw-badge show mismatch';
            waBadge.innerHTML = 'Format Salah';
            waMsg.className = 'pw-status show mismatch';
            waMsg.innerHTML = '<i class="fas fa-circle-xmark"></i> Nomor harus diawali dengan 08';
            waInput.classList.add('is-invalid');
            waInput.classList.remove('is-valid');
            isWaValid = false;
        } else if (val.length < 10) {
            waBadge.className = 'pw-badge show mismatch';
            waBadge.innerHTML = val.length + ' Digit';
            waMsg.className = 'pw-status show mismatch';
            waMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Nomor terlalu pendek (minimal 10 digit)';
            waInput.classList.add('is-invalid');
            waInput.classList.remove('is-valid');
            isWaValid = false;
        } else {
            waBadge.className = 'pw-badge';
            waBadge.innerHTML = '';
            waMsg.className = 'pw-status show match';
            waMsg.innerHTML = '<i class="fas fa-circle-check"></i> Format nomor WhatsApp valid (' + val.length + ' digit)';
            waInput.classList.add('is-valid');
            waInput.classList.remove('is-invalid');
            isWaValid = true;
        }
        syncSubmitButton();
    }
    waInput.addEventListener('input', validateWa);
    if (waInput.value) validateWa();

    /* ---------- Validasi Tanggal Pelaksanaan ---------- */
    function validateDate() {
        if (!tglInput.value) {
            tglMsg.className = 'pw-status';
            tglMsg.innerHTML = '';
            tglInput.classList.remove('is-valid', 'is-invalid');
            isDateValid = true;
            syncSubmitButton();
            return;
        }

        const selected = new Date(tglInput.value + 'T00:00:00');
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selected < today) {
            tglMsg.className = 'pw-status show mismatch';
            tglMsg.innerHTML = '<i class="fas fa-circle-xmark"></i> Tanggal pelaksanaan tidak boleh di masa lalu';
            tglInput.classList.add('is-invalid');
            tglInput.classList.remove('is-valid');
            isDateValid = false;
        } else {
            tglMsg.className = 'pw-status show match';
            tglMsg.innerHTML = '<i class="fas fa-calendar-check"></i> Tanggal pelaksanaan memenuhi syarat';
            tglInput.classList.add('is-valid');
            tglInput.classList.remove('is-invalid');
            isDateValid = true;
        }
        syncSubmitButton();
    }
    tglInput.addEventListener('change', validateDate);
    if (tglInput.value) validateDate();

    /* ---------- Area Unggah Berkas & Validasi Ukuran/Format (Dropzone) ---------- */
    function fmtSize(b) {
        return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(2) + ' MB';
    }

    var dropzones = document.querySelectorAll('[data-dropzone]');

    function checkAllDropzonesValid() {
        var allOk = true;
        dropzones.forEach(function (d) {
            if (d.classList.contains('is-invalid')) allOk = false;
        });
        isFileValid = allOk;
        syncSubmitButton();
    }

    dropzones.forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');
        var btnRemove = dz.querySelector('[data-dz-remove]');
        var btnChange = dz.querySelector('[data-dz-change]');
        var maxMb = parseFloat(dz.getAttribute('data-max')) || 5;
        var allowedExt = (dz.getAttribute('data-ext') || 'pdf,jpg,jpeg,png').split(',');
        var msg = dz.parentNode.querySelector('.dz-msg');

        function resetDropzone() {
            input.value = '';
            list.innerHTML = '';
            dz.classList.remove('has-files', 'is-over');
        }

        function handleFiles(files) {
            list.innerHTML = '';
            if (msg) msg.innerHTML = '';
            dz.classList.remove('is-invalid');

            if (!files || !files.length) {
                resetDropzone();
                checkAllDropzonesValid();
                return;
            }

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var ext = (file.name.split('.').pop() || '').toLowerCase();

                if (allowedExt.indexOf(ext) === -1) {
                    resetDropzone();
                    dz.classList.add('is-invalid');
                    if (msg) msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Format berkas "' + file.name + '" tidak didukung. Gunakan: ' + allowedExt.join(', ').toUpperCase() + '.';
                    checkAllDropzonesValid();
                    return;
                }

                if (maxMb && file.size > maxMb * 1048576) {
                    resetDropzone();
                    dz.classList.add('is-invalid');
                    if (msg) msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Ukuran berkas "' + file.name + '" (' + fmtSize(file.size) + ') melebihi batas maksimal ' + maxMb + ' MB.';
                    checkAllDropzonesValid();
                    return;
                }

                var li = document.createElement('li');
                li.innerHTML = '<i class="fas fa-circle-check"></i> <span>' + file.name + '</span> <span class="f-size">(' + fmtSize(file.size) + ')</span>';
                list.appendChild(li);
            }

            dz.classList.add('has-files');
            checkAllDropzonesValid();
        }

        ['dragenter', 'dragover'].forEach(function (t) {
            dz.addEventListener(t, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dz.classList.add('is-over');
            });
        });

        ['dragleave', 'drop'].forEach(function (t) {
            dz.addEventListener(t, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dz.classList.remove('is-over');
            });
        });

        dz.addEventListener('drop', function (e) {
            var dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length) {
                input.files = dt.files;
                handleFiles(dt.files);
            }
        });

        input.addEventListener('change', function () {
            handleFiles(input.files);
        });

        if (btnChange) {
            btnChange.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                input.click();
            });
        }

        if (btnRemove) {
            btnRemove.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (msg) msg.innerHTML = '';
                dz.classList.remove('is-invalid');
                resetDropzone();
                checkAllDropzonesValid();
            });
        }
    });

})();
</script>

<!-- ==================== CEK STATUS PERMOHONAN ==================== -->
<script>
(function () {
    'use strict';

    var form = document.getElementById('csForm');
    if (!form) return;

    // Tambahkan atribut agar diabaikan oleh loader global
    form.setAttribute('data-no-loader', 'true');

    var input = document.getElementById('csKontak');
    var btn   = document.getElementById('csBtn');
    var err   = document.getElementById('csErr');
    var list  = document.getElementById('csList');

    var STATUS = {
        'Menunggu':  { cls: 'cs-menunggu',  txt: 'Permohonan diterima dan menunggu verifikasi petugas.' },
        'Proses':    { cls: 'cs-proses',    txt: 'Permohonan sedang diproses oleh petugas.' },
        'Disetujui': { cls: 'cs-disetujui', txt: 'Permohonan disetujui. Silakan hubungi petugas untuk tindak lanjut.' },
        'Ditolak':   { cls: 'cs-ditolak',   txt: 'Permohonan ditolak. Hubungi petugas untuk informasi lebih lanjut.' }
    };

    input.addEventListener('input', function () {
        let val = input.value.replace(/\D/g, '');
        if (val.startsWith('628')) {
            val = '08' + val.slice(3);
        }
        input.value = val.slice(0, 16);
    });

    function el(tag, cls, text) {
        var e = document.createElement(tag);
        if (cls) e.className = cls;
        if (text !== undefined) e.textContent = text;
        return e;
    }

    function render(items) {
        list.textContent = '';

        if (!items.length) {
            list.appendChild(el('li', 'cs-empty', 'Tidak ditemukan permohonan dengan NIK / Nomor WA tersebut.'));
            return;
        }

        items.forEach(function (it) {
            var st = STATUS[it.status] || { cls: 'cs-menunggu', txt: '' };

            var li  = el('li', 'cs-item');
            var top = el('div', 'cs-top');
            top.appendChild(el('div', 'cs-kegiatan', it.institusi || it.kegiatan || 'Kunjungan Edukasi'));
            top.appendChild(el('span', 'cs-badge ' + st.cls, it.status));
            li.appendChild(top);

            var meta = el('div', 'cs-meta');
            meta.appendChild(document.createTextNode('Penanggung Jawab: ' + (it.nama_pemohon || it.nama || '-')));
            meta.appendChild(document.createElement('br'));
            meta.appendChild(document.createTextNode('Lokasi: ' + (it.alamat_institusi || it.lokasi || '-')));
            if (it.tgl_kegiatan || it.tanggal) {
                meta.appendChild(document.createElement('br'));
                meta.appendChild(document.createTextNode('Rencana Kunjungan: ' + (it.tgl_kegiatan || it.tanggal)));
            }
            if (it.diajukan) {
                meta.appendChild(document.createElement('br'));
                meta.appendChild(document.createTextNode('Diajukan: ' + it.diajukan));
            }
            li.appendChild(meta);

            if (st.txt) {
                li.appendChild(el('div', 'cs-note ' + st.cls, st.txt));
            }
            list.appendChild(li);
        });
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        err.innerHTML = '';
        list.textContent = '';

        var val = input.value.trim();
        var isNik = val.length === 16;
        var isWa  = val.startsWith('08') && val.length >= 10 && val.length <= 14;

        if (!isNik && !isWa) {
            err.innerHTML = '<i class="fas fa-circle-exclamation"></i> Masukkan 16 digit NIK atau Nomor WhatsApp (diawali 08, 10-14 digit) yang valid.';
            input.focus();
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari';

        fetch('{{ route('permohonan.edukasi.cek-status') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ kontak: val })
        })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (body) {
                return { status: res.status, ok: res.ok, body: body };
            });
        })
        .then(function (r) {
            if (r.ok) { render(r.body.data || []); return; }
            if (r.status === 429) { err.innerHTML = '<i class="fas fa-circle-exclamation"></i> Terlalu banyak percobaan. Coba lagi sebentar lagi.'; return; }
            if (r.status === 419) { err.innerHTML = '<i class="fas fa-circle-exclamation"></i> Sesi berakhir. Muat ulang halaman lalu coba lagi.'; return; }
            err.innerHTML = '<i class="fas fa-circle-exclamation"></i> ' + ((r.body && r.body.message) || 'Terjadi kesalahan. Coba lagi.');
        })
        .catch(function () {
            err.innerHTML = '<i class="fas fa-circle-exclamation"></i> Gagal terhubung ke server. Periksa koneksi Anda.';
        })
        .finally(function () {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-search"></i> Cek';
        });
    });
})();
</script>
</body>
</html>