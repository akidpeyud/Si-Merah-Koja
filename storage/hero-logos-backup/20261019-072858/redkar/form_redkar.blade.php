@php
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
        'Pelayangan'    => ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura'   => ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali'],
    ];

    $oldKec = old('kecamatan');
    $oldKel = old('kelurahan');

    // Penanda kolom galat
    $inv = function ($n) use ($errors) { return $errors->has($n) ? ' is-invalid' : ''; };
    $fe  = function ($n) use ($errors) {
        return $errors->has($n)
            ? '<p class="field-err"><i class="fas fa-circle-exclamation"></i> ' . e($errors->first($n)) . '</p>'
            : '';
    };

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Pendaftaran REDKAR | SIMERAH KOJA</title>
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
        body {
            font-family: var(--font-body); font-size: 1rem; line-height: 1.65;
            color: var(--ink); background: var(--white); -webkit-font-smoothing: antialiased; overflow-x: hidden;
        }
        img { max-width: 100%; height: auto; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        /* UTILITY CLASSES */
        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }
        .text-center { text-align: center; }
        .d-flex { display: flex; }
        .justify-content-center { justify-content: center; }
        .fw-bold { font-weight: 700 !important; }
        .text-muted { color: var(--steel); }
        .w-100 { width: 100%; }
        .m-0 { margin: 0 !important; }
        .mt-4 { margin-top: 1.5rem; }
        .pt-4 { padding-top: 1.5rem; }
        .border-top { border-top: 1px solid var(--line); }
        .gap-3 { gap: 1rem; }

        /* SPLASH SCREEN */
        #splash-screen {
            position: fixed; inset: 0; background-color: var(--ink); 
            display: flex; flex-direction: column; align-items: center; justify-content: center; 
            z-index: 999999; transition: opacity 0.5s ease, visibility 0.5s ease; padding: 20px;
        }
        .splash-logo-container { text-align: center; animation: pulseLogo 1.5s infinite alternate; }
        .splash-logo-container img { height: clamp(80px, 18vw, 110px); width: auto; margin: 0 auto 15px auto; display: block; filter: drop-shadow(0 0 15px rgba(229, 57, 45, 0.4)); }
        .splash-title { color: #ffffff; font-family: var(--font-display); font-weight: 800; font-size: clamp(18px, 4vw, 22px); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 0; }
        .splash-spinner { width: 42px; height: 42px; border: 4px solid rgba(255, 255, 255, 0.1); border-top: 4px solid var(--signal); border-radius: 50%; animation: spinLoader 0.8s linear infinite; margin-top: 25px; }
        @keyframes spinLoader { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes pulseLogo { 0% { transform: scale(0.95); opacity: 0.8; } 100% { transform: scale(1.05); opacity: 1; } }
        .splash-hidden { opacity: 0; visibility: hidden; pointer-events: none; }

        /* ==========================================================
           HEADER & NAVBAR MULTI-DROPDOWN
           ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 1000;
            background: rgba(13, 27, 42, .92);
            -webkit-backdrop-filter: blur(14px) saturate(1.4);
            backdrop-filter: blur(14px) saturate(1.4);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            max-width: 1440px; margin: 0 auto; min-height: var(--header-h);
            padding: 0 clamp(14px, 3vw, 32px);
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }

        .brand { display: flex; align-items: center; flex: none; }
        .brand a { display: flex; align-items: center; }
        .brand a + a { margin-left: clamp(8px, 1.5vw, 14px); padding-left: clamp(8px, 1.5vw, 14px); border-left: 1px solid rgba(255,255,255,.16); }
        .brand img { height: clamp(26px, 4vw, 36px); width: auto; object-fit: contain; }

        .nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 16px; }

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

        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; align-items: center; justify-content: center; flex: none; }
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
            .nav-toggle { display: inline-flex; margin-left: auto; }

            .nav-panel {
                display: none; position: fixed; top: var(--header-h); left: 0; right: 0;
                max-height: calc(100dvh - var(--header-h)); overflow-y: auto; overscroll-behavior: contain;
                flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 20px;
                padding: 12px clamp(16px, 4vw, 32px) 32px;
                background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1);
                box-shadow: 0 30px 40px rgba(0,0,0,.45);
            }
            .nav-open .nav-panel { display: flex; }

            .menu { flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 0; flex: none; }
            .menu > li { border-bottom: 1px solid rgba(255,255,255,.08); }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 15px 4px; font-size: 1rem; white-space: normal; color: rgba(255,255,255,.9); }
            .menu-link::after, .menu-trigger::after { display: none; }
            .menu-link.is-active { color: var(--amber); }
            .menu-trigger i { font-size: .75rem; }

            .nav-actions { flex-direction: column; align-items: stretch; gap: 10px; width: 100%; }
            .btn-nav { height: 48px; font-size: .95rem; width: 100%; }
            .nav-actions .has-drop > .btn-nav { width: 100%; }

            .dropdown, .nav-actions .dropdown {
                display: none; position: static; min-width: 0; width: 100%; max-width: none; margin: 0 0 12px 0; padding: 4px 0 4px 14px;
                background: rgba(255,255,255,.03); border: 0; border-left: 2px solid var(--amber); border-radius: 0 8px 8px 0; box-shadow: none;
                visibility: visible; opacity: 1; pointer-events: auto; transform: none; transition: none;
            }
            .dropdown::before, .dropdown::after { display: none; }
            .has-drop.open > .dropdown, .nav-actions .has-drop.open > .dropdown { display: block; transform: none; }
            .dropdown a, .dropdown .btn-logout { padding: 12px; font-size: .92rem; }

            .has-sub > .sub-trigger { padding: 12px; font-size: .92rem; }
            .has-sub.open > .sub-trigger i { transform: rotate(90deg); }
            .dropdown-sub { position: static; margin: 4px 0 6px 12px; padding: 0 0 0 12px; min-width: 0; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.18); border-radius: 0; box-shadow: none; }
            .dropdown-sub::before { display: none; }
        }

        body.nav-lock { overflow: hidden; }

        /* ==========================================================
           HERO HALAMAN
           ========================================================== */
        .page-hero {
            position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden;
            padding: clamp(32px, 6vw, 68px) 0 clamp(48px, 8vw, 96px);
        }
        .page-hero::before {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background:
                radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%),
                linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%),
                url('/images/background1.png') center / cover no-repeat;
        }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 8px 10px; font-size: clamp(.82rem, 2vw, .9rem); color: rgba(255,255,255,.7); margin-bottom: clamp(14px, 2.5vw, 24px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current="page"] { color: #fff; font-weight: 600; }
        .page-hero h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2rem, 6.5vw, 4.8rem); line-height: 1.02; letter-spacing: -0.03em; text-transform: uppercase; max-width: 18ch; margin: 0 auto; }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           LAYOUT KONTEN DAN STICKY SIDEBAR
           ========================================================== */
        .page-body { background: var(--paper); padding-top: clamp(24px, 5vw, 48px); padding-bottom: clamp(64px, 9vw, 112px); }
        .perizinan-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: clamp(20px, 3vw, 32px); align-items: start; }
        
        .info-stack { display: grid; grid-template-columns: minmax(0, 1fr); gap: 16px; align-self: start; }

        @media (min-width: 640px) and (max-width: 991px) {
            .info-stack { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        
        @media (min-width: 992px) { 
            .perizinan-layout { grid-template-columns: minmax(290px, 360px) minmax(0, 1fr); } 
            .info-stack { position: sticky; top: calc(var(--header-h) + 24px); }
        }

        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(18px, 3vw, 26px); height: 100%; }
        .card-head { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .c-ico { flex: none; width: 38px; height: 38px; border-radius: 11px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: .95rem; }
        .card-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: clamp(1.1rem, 2vw, 1.25rem); line-height: 1.2; letter-spacing: -0.015em; }

        .checklist { display: grid; gap: 14px; }
        .checklist li { display: grid; grid-template-columns: 32px minmax(0, 1fr); gap: 12px; align-items: start; font-size: .9rem; line-height: 1.5; overflow-wrap: anywhere; }
        .ck-ico { width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; flex: none; margin-top: 2px; }

        /* ==========================================================
           FORMULIR PENDAFTARAN
           ========================================================== */
        .form-panel { background: #fff; border: 1px solid var(--line); border-radius: clamp(18px, 3vw, var(--r-lg)); overflow: hidden; box-shadow: 0 10px 30px rgba(13, 27, 42, 0.03); }
        .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 16px; padding: clamp(16px, 3vw, 24px) clamp(16px, 3.5vw, 32px); border-bottom: 1px solid var(--line); }
        .form-title { display: flex; align-items: flex-start; gap: 14px; min-width: 0; flex: 1 1 240px; }
        .form-title > i { flex: none; width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; margin-top: 2px; }
        .form-title h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: clamp(1.15rem, 2.5vw, 1.35rem); line-height: 1.2; letter-spacing: -0.015em; }
        .form-title p { font-size: .88rem; color: var(--steel); margin-top: 3px; line-height: 1.4; }
        .form-note { padding: 5px 12px; border-radius: 999px; background: var(--paper); font-size: .8rem; font-weight: 600; color: var(--steel); white-space: nowrap; }

        .form-body { padding: clamp(18px, 3.5vw, 32px); display: grid; gap: clamp(28px, 4vw, 36px); }
        .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .9rem; line-height: 1.5; }
        .alert i { margin-top: 4px; flex: none; }
        .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
        .alert ul { display: grid; gap: 4px; margin-top: 6px; padding-left: 18px; list-style: disc; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 10px; margin-bottom: clamp(16px, 2.5vw, 22px); padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: clamp(1.05rem, 2vw, 1.15rem); letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); min-width: 20px; }
        .fs legend i { width: 32px; height: 32px; border-radius: 9px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; flex: none; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px 18px; }
        .fields-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px 18px; }
        .field { min-width: 0; display: flex; flex-direction: column; }
        .field.full { grid-column: 1 / -1; }

        @media (max-width: 820px) {
            .fields-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .fields-3 > .field:last-child:nth-child(odd) { grid-column: 1 / -1; }
        }

        @media (max-width: 580px) {
            .fields, .fields-3 { grid-template-columns: minmax(0, 1fr); gap: 14px; }
            .fields-3 > .field:last-child:nth-child(odd) { grid-column: auto; }
        }

        .label { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 7px; font-size: .88rem; font-weight: 600; line-height: 1.35; color: var(--ink); }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }
        .field-err { margin-top: 6px; display: flex; gap: 7px; align-items: flex-start; font-size: .82rem; font-weight: 500; line-height: 1.4; color: var(--signal-d); }
        .field-err i { margin-top: 3px; flex: none; }
        .field-err:empty { display: none; }
        
        .input {
            display: block; width: 100%; height: 48px; padding: 0 15px;
            border: 1px solid var(--line); border-radius: 12px; background: #fff;
            font: inherit; font-size: .95rem; color: var(--ink);
            transition: border-color .2s, box-shadow .2s;
        }
        textarea.input { height: auto; min-height: 84px; padding: 12px 15px; resize: vertical; line-height: 1.5; }
        .input::placeholder { color: #93a1b1; }
        .input:hover:not(:disabled):not(.readonly-input) { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.45); }
        .input:user-invalid, .input.is-invalid { border-color: var(--signal); }
        .input.is-valid { border-color: var(--ok); }
        .input.is-valid:focus { border-color: var(--ok); box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.25); }
        
        select.input {
            appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 15px center;
            text-overflow: ellipsis; white-space: nowrap; overflow: hidden;
        }
        .readonly-input { background-color: var(--paper); color: var(--steel); cursor: not-allowed; }

        /* PASSWORD SHOW/HIDE, STRENGTH METER & BADGES */
        .pw-wrap { position: relative; display: flex; align-items: center; width: 100%; }
        .pw-wrap .input { padding-right: 48px; }
        .pw-toggle {
            position: absolute; right: 6px; top: 50%; transform: translateY(-50%);
            width: 36px; height: 36px; border-radius: 9px;
            display: grid; place-items: center; color: var(--steel);
            font-size: .95rem; transition: background .15s, color .15s; z-index: 2;
        }
        .pw-toggle:hover { background: var(--paper); color: var(--ink); }
        .pw-toggle.is-showing { color: var(--signal-d); background: #fdeceb; }

        .pw-badge {
            display: none; align-items: center; gap: 4px; padding: 2px 8px; border-radius: 999px;
            font-size: .72rem; font-weight: 700; letter-spacing: .01em;
        }
        .pw-badge.show { display: inline-flex; }
        .pw-badge.match { background: var(--ok-bg); color: var(--ok); }
        .pw-badge.warn { background: var(--warn-bg); color: var(--warn); }
        .pw-badge.mismatch { background: #fdeceb; color: var(--signal-d); }

        .pw-meter {
            display: none; grid-template-columns: repeat(4, 1fr); gap: 5px;
            margin-top: 8px; width: 100%;
        }
        .pw-meter.show { display: grid; }
        .pw-bar {
            height: 4px; border-radius: 999px; background: var(--line);
            transition: background-color .25s ease;
        }
        .pw-meter[data-score="1"] .pw-bar:nth-child(-n+1) { background: var(--signal); }
        .pw-meter[data-score="2"] .pw-bar:nth-child(-n+2) { background: #f59e0b; }
        .pw-meter[data-score="3"] .pw-bar:nth-child(-n+3) { background: #10b981; }
        .pw-meter[data-score="4"] .pw-bar:nth-child(-n+4) { background: var(--ok); }

        .pw-status {
            margin-top: 6px; display: none; align-items: center; gap: 6px;
            font-size: .8rem; font-weight: 600; line-height: 1.35;
        }
        .pw-status.show { display: inline-flex; }
        .pw-status.match { color: var(--ok); }
        .pw-status.warn { color: var(--warn); }
        .pw-status.mismatch { color: var(--signal-d); }

        @media (max-width: 640px) {
            .input, select.input, textarea.input { font-size: 16px; }
        }

        /* DROPZONE & IMAGE PREVIEW KTP */
        .dropzone {
            position: relative; display: grid; justify-items: center; gap: 10px; text-align: center;
            padding: clamp(20px, 4vw, 28px) 16px; border: 2px dashed #b8c3d0; border-radius: var(--r-md);
            background: var(--paper); color: var(--steel); font-size: .9rem; line-height: 1.45;
            cursor: pointer; transition: border-color .2s, background .2s, box-shadow .2s;
        }
        .dropzone:hover, .dropzone.is-over { border-color: var(--signal); background: #fdeceb; }
        .dropzone.has-files { border-style: solid; border-color: var(--ink); background: #fff; cursor: default; }
        .dropzone.is-invalid { border-color: var(--signal); background: #fff5f5; }
        .dropzone input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 1; }
        .dropzone.has-files input[type="file"] { pointer-events: none; }

        .dz-prompt { display: grid; justify-items: center; gap: 8px; transition: opacity .2s; }
        .dropzone.has-files .dz-prompt { display: none; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; box-shadow: 0 4px 10px rgba(0,0,0,.04); }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }

        .dz-preview {
            display: none; width: 100%; max-width: 400px; flex-direction: column; align-items: center; gap: 12px;
            z-index: 2; position: relative; animation: fadeInPreview .25s ease;
        }
        .dropzone.has-files .dz-preview { display: flex; }
        @keyframes fadeInPreview { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }

        .dz-img-wrap {
            position: relative; width: 100%; aspect-ratio: 16 / 10; max-height: 230px;
            border-radius: 14px; overflow: hidden; border: 1px solid var(--line);
            background: var(--ink); box-shadow: 0 8px 24px rgba(13, 27, 42, 0.12);
            display: flex; align-items: center; justify-content: center;
        }
        .dz-img-wrap img { width: 100%; height: 100%; object-fit: contain; background: #0d1b2a; }
        .dz-badge-ok {
            position: absolute; top: 10px; left: 10px; display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 10px; border-radius: 999px; background: rgba(13, 27, 42, 0.82); backdrop-filter: blur(6px);
            color: #4ade80; font-size: .75rem; font-weight: 700; letter-spacing: .02em;
        }

        .dz-meta {
            display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;
            width: 100%; padding: 8px 12px; border-radius: 12px; background: var(--paper); border: 1px solid var(--line);
        }
        .dz-files { display: flex; flex-wrap: wrap; align-items: center; gap: 6px; min-width: 0; flex: 1; }
        .dz-files:empty { display: none; }
        .dz-files li {
            display: inline-flex; align-items: center; gap: 7px; font-size: .82rem; font-weight: 600; color: var(--ink);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;
        }
        .dz-files li i { color: var(--signal-d); flex: none; }
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
        
        .form-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 12px 16px; padding-top: 20px; border-top: 1px solid var(--line); margin-top: 4px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 50px; padding: 12px 28px; border-radius: 999px; font-weight: 700; font-size: .95rem; text-align: center; transition: background .2s, box-shadow .2s, transform .15s; cursor: pointer; border: none; text-decoration: none; }
        .btn:active:not(:disabled) { transform: scale(.98); }
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 12px 26px -8px rgba(229,57,45,.6); }
        .btn-primary:hover:not(:disabled) { background: var(--signal-d); color: #fff; }
        .btn-primary:disabled { background: #fca5a5; cursor: not-allowed; box-shadow: none; }
        
        .btn-outline { background: transparent; border: 1.5px solid var(--line); color: var(--ink); }
        .btn-outline:hover { background: var(--paper); border-color: var(--steel); color: var(--ink); }

        @media (max-width: 580px) {
            .form-actions { flex-direction: column; align-items: stretch; }
            .form-actions .btn { width: 100%; }
        }

        /* FOOTER */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(48px, 7vw, 88px) 0 clamp(88px, 10vw, 48px); }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(28px, 4vw, 56px); align-items: start; }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 14px; }
        .footer-about img { height: clamp(72px, 10vw, 92px); width: auto; margin-bottom: 16px; }
        .footer-about p { max-width: 44ch; font-size: .92rem; line-height: 1.6; }
        .map { position: relative; height: 195px; border-radius: var(--r-md); overflow: hidden; background: var(--ink-2); border: 1px solid rgba(255,255,255,.08); }
        .map iframe { width: 100%; height: 100%; border: 0; pointer-events: none; filter: grayscale(.3) contrast(1.05); transition: filter .3s; }
        .map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px; border-radius: var(--r-md); }
        .map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .82rem; font-weight: 700; box-shadow: 0 8px 20px rgba(0,0,0,.35); transition: background .2s, transform .2s; }
        .map-link:hover span { background: var(--signal-d); transform: translateY(-2px); }
        .map:hover iframe { filter: none; }
        .footer-links li + li { margin-top: 6px; }
        .footer-links a { display: inline-flex; align-items: center; gap: 10px; padding: 6px 0; font-size: .92rem; transition: color .2s, gap .2s; }
        .footer-links a i { font-size: .7rem; color: var(--signal); }
        .footer-links a:hover { color: #fff; gap: 14px; }
        .footer-bar { margin-top: clamp(36px, 5vw, 64px); padding-top: 24px; border-top: 1px solid rgba(255,255,255,.1); display: flex; flex-wrap: wrap; gap: 16px 24px; justify-content: space-between; align-items: center; font-size: .85rem; }
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 40px; height: 40px; border-radius: 11px; display: grid; place-items: center; background: rgba(255,255,255,.08); color: #fff; transition: background .2s, transform .2s; }
        .social a:hover { background: var(--signal); transform: translateY(-3px); }

        @media (max-width: 960px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .footer-about { grid-column: 1 / -1; }
        }
        @media (max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bar { flex-direction: column; align-items: flex-start; }
        }
        
        /* TOMBOL LAPOR MENGAMBANG (SOS FAB) */
        .beacon { position: relative; width: 10px; height: 10px; border-radius: 50%; background: #fff; flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: #fff; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
        
        .sos-fab { position: fixed; right: clamp(12px, 3vw, 26px); bottom: clamp(12px, 3vw, 26px); z-index: 900; display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
        .sos-fab-btn { display: inline-flex; align-items: center; gap: 10px; padding: 13px 20px; border-radius: 999px; background: var(--signal); color: #fff; font-size: .92rem; font-weight: 700; box-shadow: 0 14px 30px -6px rgba(229,57,45,.65); border: none; cursor: pointer; transition: background .2s, transform .2s; }
        .sos-fab-btn:hover { background: var(--signal-d); }
        .sos-sheet { display: none; width: min(300px, calc(100vw - 24px)); padding: 8px; border-radius: 18px; background: var(--ink); border: 1px solid rgba(255,255,255,.14); box-shadow: 0 24px 48px rgba(0,0,0,.5); }
        .sos-fab.open .sos-sheet { display: grid; gap: 4px; }
        .sos-sheet a { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 12px; color: #fff; font-size: .9rem; font-weight: 600; transition: background .15s; }
        .sos-sheet a:hover { background: rgba(255,255,255,.1); }
        .sos-sheet a i { width: 20px; text-align: center; font-size: 1.1rem; flex: none; }
        .sos-sheet .wa i { color: #25d366; } .sos-sheet .tel i { color: #38bdf8; } .sos-sheet .n112 i { color: #f87171; }

        /* POPUP SUCCESS */
        #success-popup-overlay {
            position: fixed; inset: 0; padding: 16px; background-color: rgba(13, 27, 42, 0.85); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center; z-index: 999999;
            animation: fadeInOverlay 0.3s ease forwards;
        }
        .success-popup-box {
            background: #fff; border-radius: var(--r-md); padding: clamp(28px, 5vw, 40px) clamp(20px, 4vw, 30px); text-align: center;
            max-width: 420px; width: 100%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: popInBox 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; position: relative; overflow: hidden;
        }
        .success-popup-box::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background-color: var(--signal); }
        .success-popup-icon { width: 72px; height: 72px; background-color: #fdeceb; color: var(--signal); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 34px; margin: 0 auto 18px; box-shadow: 0 0 20px rgba(229, 57, 45, 0.15); }
        .success-popup-title { color: var(--ink); font-family: var(--font-display); font-size: 22px; font-weight: 800; margin-bottom: 8px; }
        .success-popup-message { color: var(--steel); font-size: 14px; line-height: 1.6; margin-bottom: 24px; }
        @keyframes fadeInOverlay { from { opacity: 0; } to { opacity: 1; } }
        @keyframes popInBox { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    </style>
</head>
<body>

<!-- SPLASH SCREEN LOADING -->
<div id="splash-screen">
    <div class="splash-logo-container">
        <img src="/images/logo-redkar.png" alt="Logo Redkar">
        <div class="splash-title">REDKAR KOTA JAMBI</div>
    </div>
    <div class="splash-spinner"></div>
</div>

<!-- ALERT SUKSES POPUP -->
@if(session('success'))
    <div id="success-popup-overlay">
        <div class="success-popup-box" id="success-popup-box">
            <div class="success-popup-icon"><i class="fas fa-check"></i></div>
            <div class="success-popup-title">BERHASIL!</div>
            <div class="success-popup-message">{{ session('success') }}</div>
            <button class="btn btn-primary w-100" type="button" onclick="document.getElementById('success-popup-overlay').remove()">OKE, TERIMA KASIH</button>
        </div>
    </div>
@endif

<!-- HEADER NAVBAR -->
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
            <ul class="menu">
                <li><a class="menu-link" href="/public-sigap">Sigapkar</a></li>
                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="#">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
                        <li><a href="/layanan-fasilitas/skk">Permohonan Sertifikat Keselamatan Kebakaran</a></li>
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
                            <button class="sub-trigger" type="button" aria-expanded="false">Berita <i class="fas fa-chevron-right"></i></button>
                            <ul class="dropdown-sub">
                                <li><a href="/edu-damkar">Edu Damkar</a></li>
                                <li><a href="{{ route('publik.infografis') }}">Infografis</a></li>
                                <li><a href="/media-informasi">Media Informasi</a></li>
                                <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="menu-link is-active" href="/redkar" aria-current="page">Redkar</a></li>
            </ul>

            <ul class="nav-actions">
                @auth('redkar')
                    <li class="has-drop">
                        <button class="btn-nav btn-nav--ghost menu-trigger-cta" type="button" aria-expanded="false" style="border-color: var(--amber); color: var(--amber);">
                            <i class="fas fa-user-shield"></i> {{ Auth::guard('redkar')->user()->nama_lengkap ?? 'Redkar' }} <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown">
                            <li><a href="{{ route('redkar.dashboard') }}"><i class="fas fa-gauge-high"></i> Dashboard</a></li>
                            <li><a href="{{ route('redkar.profil') }}"><i class="fas fa-user-pen"></i> Profil Saya</a></li>
                            <li>
                                <form action="{{ route('logout.redkar') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-logout"><i class="fas fa-right-from-bracket"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a class="btn-nav btn-nav--ghost" href="/login-redkar" style="border-color: var(--amber); color: var(--amber);">Masuk Redkar</a></li>
                @endauth

                @if(session()->has('pemohon_id'))
                    <li class="has-drop">
                        <button class="btn-nav btn-nav--ghost menu-trigger-cta" type="button" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ strtok(session('pemohon_nama'), " ") }} <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown">
                            <li>
                                <form action="{{ route('pemohon.logout') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Keluar</button>
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

<!-- HERO HALAMAN -->
<section class="page-hero">
    <div class="wrap text-center">
        <nav aria-label="Breadcrumb" class="rise d-flex justify-content-center">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><span aria-current="page">Pendaftaran Redkar</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Relawan Pemadam Kebakaran</h1>
    </div>
</section>

<!-- LAYOUT KONTEN -->
<div class="page-body">
    <div class="wrap perizinan-layout">

        <!-- Informasi Syarat -->
        <aside class="info-stack" aria-label="Informasi layanan">
            <section class="side-card">
                <div class="card-head">
                    <span class="c-ico"><i class="fas fa-check-square"></i></span>
                    <h2>Syarat Keanggotaan</h2>
                </div>
                <ol class="checklist">
                    <li><span class="ck-ico"><i class="fas fa-id-card"></i></span><div>Penduduk yang berdomisili di wilayah Daerah Kota Jambi dan berusia minimal 19 tahun.</div></li>
                    <li><span class="ck-ico"><i class="fas fa-heartbeat"></i></span><div>Sehat jasmani dan rohani.</div></li>
                    <li><span class="ck-ico"><i class="fas fa-hands-helping"></i></span><div>Memiliki jiwa penolong, semangat pengabdian dan dedikasi tinggi.</div></li>
                    <li><span class="ck-ico"><i class="fas fa-users"></i></span><div>Mampu bekerja secara mandiri dan dapat bekerja sama dengan pihak lain.</div></li>
                </ol>
            </section>
            <section class="side-card">
                <div class="card-head">
                    <span class="c-ico"><i class="fas fa-map-marker-alt"></i></span>
                    <h2>Kontak & Alamat</h2>
                </div>
                <ol class="checklist">
                    <li><span class="ck-ico"><i class="fas fa-envelope"></i></span><div>damkar.jbi@gmail.com</div></li>
                    <li><span class="ck-ico"><i class="fas fa-building"></i></span><div>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi</div></li>
                </ol>
            </section>
        </aside>

        <!-- Formulir Pendaftaran -->
        <section class="form-panel" id="formulir">
            <div class="form-bar">
                <div class="form-title">
                    <i class="fas fa-id-badge"></i>
                    <div>
                        <h2>Biodata REDKAR</h2>
                        <p>Lengkapi form di bawah ini untuk bergabung menjadi relawan.</p>
                    </div>
                </div>
                <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
            </div>

            <form class="form-body" action="/redkar" method="POST" enctype="multipart/form-data" id="form_redkar">
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

                <!-- Akun Login -->
                <fieldset class="fs">
                    <legend><i class="fas fa-lock"></i> Akun Login</legend>
                    <div class="fields">
                        <div class="field full">
                            <label class="label" for="username"><span>Username <span class="req">*</span></span></label>
                            <input class="input{{ $inv('username') }}" type="text" id="username" name="username" value="{{ old('username') }}" autocomplete="username" placeholder="Buat username unik" required>
                            {!! $fe('username') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="password">
                                <span>Password <span class="req">*</span></span>
                                <span class="pw-badge" id="pw_strength_badge"></span>
                            </label>
                            <div class="pw-wrap">
                                <input class="input{{ $inv('password') }}" type="password" id="password" name="password" minlength="6" autocomplete="new-password" placeholder="Minimal 6 karakter" required>
                                <button type="button" class="pw-toggle" data-toggle-pw="password" aria-label="Tampilkan password" aria-pressed="false" title="Tampilkan/Sembunyikan Password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="pw-meter" id="pw_meter" aria-hidden="true">
                                <span class="pw-bar"></span>
                                <span class="pw-bar"></span>
                                <span class="pw-bar"></span>
                                <span class="pw-bar"></span>
                            </div>
                            <p class="pw-status" id="pw_length_msg" aria-live="polite"></p>
                            {!! $fe('password') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="password_confirmation">
                                <span>Konfirmasi Password <span class="req">*</span></span>
                                <span class="pw-badge" id="pw_match_badge"></span>
                            </label>
                            <div class="pw-wrap">
                                <input class="input" type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="Ulangi password" required>
                                <button type="button" class="pw-toggle" data-toggle-pw="password_confirmation" aria-label="Tampilkan konfirmasi password" aria-pressed="false" title="Tampilkan/Sembunyikan Password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <p class="pw-status" id="pw_match_msg" aria-live="polite"></p>
                        </div>
                    </div>
                </fieldset>

                <!-- Data Diri -->
                <fieldset class="fs">
                    <legend><i class="fas fa-user"></i> Data Diri</legend>
                    <div class="fields">
                        <div class="field full">
                            <label class="label" for="nama_lengkap"><span>Nama Lengkap <span class="req">*</span></span></label>
                            <input class="input{{ $inv('nama_lengkap') }}" type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                            {!! $fe('nama_lengkap') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="nik">
                                <span>NIK <span class="req">*</span></span>
                                <span class="pw-badge" id="nik_badge">0/16</span>
                            </label>
                            <input class="input{{ $inv('nik') }}" type="text" id="nik" name="nik" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit NIK" required>
                            <p class="pw-status" id="nik_msg" aria-live="polite"></p>
                            {!! $fe('nik') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="nomor_telp">
                                <span>No WhatsApp / Telepon <span class="req">*</span></span>
                                <span class="pw-badge" id="wa_badge"></span>
                            </label>
                            <input class="input{{ $inv('nomor_telp') }}" type="tel" id="nomor_telp" name="nomor_telp" value="{{ old('nomor_telp') }}" inputmode="tel" maxlength="14" placeholder="Contoh: 081234567890" required>
                            <p class="pw-status" id="wa_msg" aria-live="polite"></p>
                            {!! $fe('nomor_telp') !!}
                        </div>

                        <!-- TTL -->
                        <div class="field full">
                            <div class="fields-3">
                                <div class="field">
                                    <label class="label" for="tempat_lahir"><span>Tempat Lahir <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('tempat_lahir') }}" type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                    {!! $fe('tempat_lahir') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="tanggal_lahir"><span>Tanggal Lahir <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('tanggal_lahir') }}" type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                    {!! $fe('tanggal_lahir') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="umur_display"><span>Umur <span class="req">*</span></span></label>
                                    <input class="input readonly-input fw-bold" type="text" name="umur_display" id="umur_display" placeholder="Terisi Otomatis" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Umur invalid -->
                        <div class="field full" id="alert_umur" style="display: none;">
                            <div class="alert err m-0" role="alert">
                                <i class="fas fa-times-circle"></i>
                                <div>
                                    <strong>Mohon Maaf!</strong> Usia Anda saat ini adalah <span id="text_umur_invalid" class="fw-bold"></span> tahun. Syarat pendaftaran REDKAR adalah minimal berusia 19 tahun dan maksimal 56 tahun.
                                </div>
                            </div>
                        </div>

                        <div class="field full">
                            <div class="fields-3">
                                <div class="field">
                                    <label class="label" for="jenis_kelamin"><span>Jenis Kelamin <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('jenis_kelamin') }}" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled {{ !old('jenis_kelamin') ? 'selected' : '' }}>Pilih</option>
                                        <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    {!! $fe('jenis_kelamin') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="agama"><span>Agama <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('agama') }}" id="agama" name="agama" required>
                                        <option value="" disabled {{ !old('agama') ? 'selected' : '' }}>Pilih Agama</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                    {!! $fe('agama') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="status_perkawinan"><span>Status Perkawinan <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('status_perkawinan') }}" id="status_perkawinan" name="status_perkawinan" required>
                                        <option value="" disabled {{ !old('status_perkawinan') ? 'selected' : '' }}>Pilih Status</option>
                                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                    </select>
                                    {!! $fe('status_perkawinan') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </fieldset>

                <!-- Alamat -->
                <fieldset class="fs">
                    <legend><i class="fas fa-map-marker-alt"></i> Alamat & Wilayah Tugas</legend>
                    <div class="fields">
                        <div class="field full">
                            <label class="label" for="alamat"><span>Alamat Lengkap <span class="req">*</span></span></label>
                            <textarea class="input{{ $inv('alamat') }}" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                            {!! $fe('alamat') !!}
                        </div>
                        <div class="field full">
                            <div class="fields-3">
                                <div class="field">
                                    <label class="label" for="rt_rw"><span>RT/RW <span class="req">*</span></span></label>
                                    <input class="input{{ $inv('rt_rw') }}" type="text" id="rt_rw" name="rt_rw" value="{{ old('rt_rw') }}" placeholder="Cth: 05 / 02" required>
                                    {!! $fe('rt_rw') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="kecamatan"><span>Kecamatan <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('kecamatan') }}" name="kecamatan" id="kecamatan" required>
                                        <option value="" disabled @if(!$oldKec) selected @endif>Pilih Kecamatan</option>
                                        @foreach(array_keys($dataWilayah) as $kc)
                                            <option value="{{ $kc }}" @if($oldKec === $kc) selected @endif>{{ $kc }}</option>
                                        @endforeach
                                    </select>
                                    {!! $fe('kecamatan') !!}
                                </div>
                                <div class="field">
                                    <label class="label" for="kelurahan"><span>Kelurahan <span class="req">*</span></span></label>
                                    <select class="input{{ $inv('kelurahan') }}" name="kelurahan" id="kelurahan" required>
                                        @if($oldKec && isset($dataWilayah[$oldKec]))
                                            <option value="" disabled @if(!$oldKel) selected @endif>Pilih kelurahan</option>
                                            @foreach($dataWilayah[$oldKec] as $kl)
                                                <option value="{{ $kl }}" @if($oldKel === $kl) selected @endif>{{ $kl }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                                        @endif
                                    </select>
                                    {!! $fe('kelurahan') !!}
                                </div>
                            </div>
                        </div>
                        <div class="field full">
                            <label class="label" for="kabupaten_kota"><span>Kabupaten/Kota <span class="req">*</span></span></label>
                            <input class="input readonly-input" type="text" id="kabupaten_kota" name="kabupaten_kota" value="KOTA JAMBI" readonly>
                        </div>
                    </div>
                </fieldset>

                <!-- Pendidikan & Pekerjaan -->
                <fieldset class="fs">
                    <legend><i class="fas fa-graduation-cap"></i> Profil Lainnya</legend>
                    <div class="fields">
                        <div class="field">
                            <label class="label" for="pendidikan_terakhir"><span>Pendidikan Terakhir <span class="req">*</span></span></label>
                            <select class="input{{ $inv('pendidikan_terakhir') }}" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                <option value="" disabled {{ !old('pendidikan_terakhir') ? 'selected' : '' }}>Pilih Pendidikan</option>
                                <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD Sederajat</option>
                                <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP Sederajat</option>
                                <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA Sederajat</option>
                                <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                            </select>
                            {!! $fe('pendidikan_terakhir') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="latar_belakang_pendidikan"><span>Latar Belakang <span class="req">*</span></span></label>
                            <input class="input{{ $inv('latar_belakang_pendidikan') }}" type="text" id="latar_belakang_pendidikan" name="latar_belakang_pendidikan" value="{{ old('latar_belakang_pendidikan') }}" placeholder="Cth: IPS, Teknik Informatika" required>
                            {!! $fe('latar_belakang_pendidikan') !!}
                        </div>
                        <div class="field full">
                            <label class="label" for="jenis_pekerjaan"><span>Jenis Pekerjaan <span class="req">*</span></span></label>
                            <select class="input{{ $inv('jenis_pekerjaan') }}" name="jenis_pekerjaan" id="jenis_pekerjaan" required>
                                <option value="" disabled {{ !old('jenis_pekerjaan') ? 'selected' : '' }}>Pilih Pekerjaan</option>
                                <option value="ASN" {{ old('jenis_pekerjaan') == 'ASN' ? 'selected' : '' }}>ASN</option>
                                <option value="TNI" {{ old('jenis_pekerjaan') == 'TNI' ? 'selected' : '' }}>TNI</option>
                                <option value="POLRI" {{ old('jenis_pekerjaan') == 'POLRI' ? 'selected' : '' }}>POLRI</option>
                                <option value="WIRASWASTA" {{ old('jenis_pekerjaan') == 'WIRASWASTA' ? 'selected' : '' }}>WIRASWASTA</option>
                                <option value="KARYAWAN SWASTA" {{ old('jenis_pekerjaan') == 'KARYAWAN SWASTA' ? 'selected' : '' }}>KARYAWAN SWASTA</option>
                                <option value="KARYAWAN BUMN/BUMD" {{ old('jenis_pekerjaan') == 'KARYAWAN BUMN/BUMD' ? 'selected' : '' }}>KARYAWAN BUMN/BUMD</option>
                                <option value="PEKERJA HARIAN LEPAS" {{ old('jenis_pekerjaan') == 'PEKERJA HARIAN LEPAS' ? 'selected' : '' }}>PEKERJA HARIAN LEPAS</option>
                                <option value="MAHASISWA/PELAJAR" {{ old('jenis_pekerjaan') == 'MAHASISWA/PELAJAR' ? 'selected' : '' }}>MAHASISWA/PELAJAR</option>
                                <option value="PENGURUS RUMAH TANGGA" {{ old('jenis_pekerjaan') == 'PENGURUS RUMAH TANGGA' ? 'selected' : '' }}>PENGURUS RUMAH TANGGA</option>
                                <option value="LAINNYA..." {{ old('jenis_pekerjaan') == 'LAINNYA...' ? 'selected' : '' }}>LAINNYA...</option>
                            </select>
                            {!! $fe('jenis_pekerjaan') !!}
                        </div>
                        <div class="field full" id="pekerjaan_lainnya_container" style="display: none;">
                            <label class="label text-muted" for="pekerjaan_lainnya_input"><span>Sebutkan Pekerjaan Anda <span class="req">*</span></span></label>
                            <input class="input" type="text" name="pekerjaan_lainnya" id="pekerjaan_lainnya_input" value="{{ old('pekerjaan_lainnya') }}" placeholder="Jelaskan profesi/pekerjaan Anda">
                        </div>
                        <div class="field">
                            <label class="label" for="sehat_jasmani"><span>Sehat Jasmani <span class="req">*</span></span></label>
                            <select class="input{{ $inv('sehat_jasmani') }}" id="sehat_jasmani" name="sehat_jasmani" required>
                                <option value="" disabled {{ !old('sehat_jasmani') ? 'selected' : '' }}>Pilih</option>
                                <option value="Ya" {{ old('sehat_jasmani') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('sehat_jasmani') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            {!! $fe('sehat_jasmani') !!}
                        </div>
                        <div class="field">
                            <label class="label" for="golongan_darah"><span>Golongan Darah <span class="req">*</span></span></label>
                            <select class="input{{ $inv('golongan_darah') }}" id="golongan_darah" name="golongan_darah" required>
                                <option value="" disabled {{ !old('golongan_darah') ? 'selected' : '' }}>Pilih</option>
                                <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                                <option value="Tidak Tahu" {{ old('golongan_darah') == 'Tidak Tahu' ? 'selected' : '' }}>Tidak Tahu</option>
                            </select>
                            {!! $fe('golongan_darah') !!}
                        </div>
                    </div>
                </fieldset>

                <!-- Berkas -->
                <fieldset class="fs">
                    <legend><i class="fas fa-paperclip"></i> Berkas Identitas</legend>
                    <div class="fields">
                        <div class="field full">
                            <span class="label"><span>Foto KTP / Identitas Diri <span class="req">*</span></span></span>
                            
                            <div class="dropzone{{ $inv('foto_ktp') }}" data-dropzone data-max="2">
                                <input type="file" id="ktp_upload" name="foto_ktp" accept="image/jpeg,image/png,.jpg,.jpeg,.png" required aria-label="Unggah Foto KTP">
                                
                                <div class="dz-prompt">
                                    <span class="dz-ico"><i class="fas fa-cloud-arrow-up"></i></span>
                                    <span class="dz-text"><strong>Tarik gambar KTP ke sini</strong> atau <u>pilih file</u></span>
                                </div>

                                <div class="dz-preview">
                                    <div class="dz-img-wrap">
                                        <span class="dz-badge-ok"><i class="fas fa-circle-check"></i> Siap Diunggah</span>
                                        <img src="" alt="Pratinjau KTP" data-dz-img>
                                    </div>
                                    <div class="dz-meta">
                                        <ul class="dz-files" aria-live="polite"></ul>
                                        <div class="dz-actions">
                                            <button type="button" class="btn-dz btn-dz--change" data-dz-change><i class="fas fa-arrows-rotate"></i> Ganti</button>
                                            <button type="button" class="btn-dz btn-dz--remove" data-dz-remove><i class="fas fa-trash-can"></i> Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="hint">Format JPG atau PNG. Maksimal 2 MB. Pastikan teks pada KTP terlihat jelas.</p>
                            <p class="field-err dz-msg" role="alert"></p>
                            {!! $fe('foto_ktp') !!}
                        </div>
                    </div>
                </fieldset>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="btn_submit_redkar"><i class="fas fa-paper-plane"></i> Kirim Pendaftaran</button>
                    <a href="/login-redkar" class="btn btn-outline"><i class="fas fa-sign-in-alt"></i> Sudah punya akun? Masuk</a>
                </div>
            </form>
        </section>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>
            <div>
                <div class="map">
                    <iframe title="Lokasi Dinas Pemadam" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="{{ $maps_link }}" target="_blank" rel="noopener"><span><i class="fas fa-location-arrow"></i> Buka Peta</span></a>
                </div>
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
                <a href="mailto:damkar.jbi@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- TOMBOL LAPOR MENGAMBANG (SOS FAB) -->
<div class="sos-fab" id="sosFab">
    <div class="sos-sheet" id="sosSheet">
        <a class="wa" href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Lapor lewat WhatsApp</a>
        <a class="tel" href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon {{ $telepon_tampil }}</a>
        <a class="n112" href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a>
    </div>
    <button class="sos-fab-btn" type="button" aria-expanded="false" aria-controls="sosSheet">
        <span class="beacon" aria-hidden="true"></span> Lapor darurat <i class="fas fa-chevron-down" style="font-size: 0.65rem; opacity: 0.85; transition: transform .2s;"></i>
    </button>
</div>

<!-- SCRIPT INTERACTIVITY -->
<script>
(function () {
    'use strict';

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

    /* ---------- Tombol lapor mengambang ---------- */
    var fab = document.getElementById('sosFab');
    var fabBtn = fab.querySelector('.sos-fab-btn');
    var fabIcon = fabBtn.querySelector('i.fa-chevron-down');

    fabBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        var open = fab.classList.toggle('open');
        fabBtn.setAttribute('aria-expanded', open);
        fabIcon.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#sosFab')) {
            fab.classList.remove('open');
            fabBtn.setAttribute('aria-expanded', 'false');
            fabIcon.style.transform = 'rotate(0deg)';
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fab.classList.remove('open');
            fabBtn.setAttribute('aria-expanded', 'false');
            fabIcon.style.transform = 'rotate(0deg)';
        }
    });

    /* ---------- Area unggah berkas & Pratinjau Gambar (Dropzone KTP) ---------- */
    function fmtSize(b) {
        return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(2) + ' MB';
    }

    document.querySelectorAll('[data-dropzone]').forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');
        var imgPreview = dz.querySelector('[data-dz-img]');
        var btnRemove = dz.querySelector('[data-dz-remove]');
        var btnChange = dz.querySelector('[data-dz-change]');
        var maxMb = parseFloat(dz.getAttribute('data-max')) || 2;
        var msg = dz.parentNode.querySelector('.dz-msg');

        function resetDropzone() {
            input.value = '';
            list.innerHTML = '';
            if (imgPreview) imgPreview.removeAttribute('src');
            dz.classList.remove('has-files', 'is-over');
        }

        function handleFiles(files) {
            list.innerHTML = '';
            if (msg) msg.innerHTML = '';
            dz.classList.remove('is-invalid');

            if (!files || !files.length) {
                resetDropzone();
                return;
            }

            var file = files[0];
            var validTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (validTypes.indexOf(file.type) === -1) {
                resetDropzone();
                dz.classList.add('is-invalid');
                if (msg) msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Format berkas tidak didukung. Gunakan format JPG atau PNG.';
                return;
            }

            if (maxMb && file.size > maxMb * 1048576) {
                resetDropzone();
                dz.classList.add('is-invalid');
                if (msg) msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Ukuran berkas (' + fmtSize(file.size) + ') melebihi batas maksimal ' + maxMb + ' MB.';
                return;
            }

            var li = document.createElement('li');
            li.innerHTML = '<i class="fas fa-id-card"></i> <span>' + file.name + '</span> <span class="f-size">(' + fmtSize(file.size) + ')</span>';
            list.appendChild(li);

            if (imgPreview && window.FileReader) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                    dz.classList.add('has-files');
                };
                reader.readAsDataURL(file);
            } else {
                dz.classList.add('has-files');
            }
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
            });
        }
    });

    /* ---------- Form Validation State (Umur, Password, NIK, WhatsApp) ---------- */
    const inputTglLahir = document.getElementById('tanggal_lahir');
    const inputUmur = document.getElementById('umur_display');
    const alertUmur = document.getElementById('alert_umur');
    const textUmurInvalid = document.getElementById('text_umur_invalid');
    const btnSubmit = document.getElementById('btn_submit_redkar');

    const pwInput = document.getElementById('password');
    const pwConfirm = document.getElementById('password_confirmation');
    const pwMeter = document.getElementById('pw_meter');
    const pwLengthMsg = document.getElementById('pw_length_msg');
    const pwStrengthBadge = document.getElementById('pw_strength_badge');
    const pwMatchMsg = document.getElementById('pw_match_msg');
    const pwMatchBadge = document.getElementById('pw_match_badge');

    const nikInput = document.getElementById('nik');
    const nikBadge = document.getElementById('nik_badge');
    const nikMsg = document.getElementById('nik_msg');

    const waInput = document.getElementById('nomor_telp');
    const waBadge = document.getElementById('wa_badge');
    const waMsg = document.getElementById('wa_msg');

    let isAgeValid = true;
    let isPasswordValid = true;
    let isNikValid = true;
    let isWaValid = true;

    function syncSubmitButton() {
        btnSubmit.disabled = !(isAgeValid && isPasswordValid && isNikValid && isWaValid);
    }

    /* ---------- Show / Hide Password Toggle ---------- */
    document.querySelectorAll('[data-toggle-pw]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var targetId = btn.getAttribute('data-toggle-pw');
            var input = document.getElementById(targetId);
            var icon = btn.querySelector('i');
            if (!input) return;

            var isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
            btn.classList.toggle('is-showing', isHidden);
            btn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
            btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            input.focus();
        });
    });

    /* ---------- Evaluasi Password Real-Time ---------- */
    function getPasswordScore(pw) {
        if (!pw || pw.length < 6) return 1;
        var score = 1;
        if (pw.length >= 8) score++;
        if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
        if (/[0-9]/.test(pw) || /[^A-Za-z0-9]/.test(pw)) score++;
        return Math.min(4, score);
    }

    function validatePasswords() {
        const val = pwInput.value;
        const conf = pwConfirm.value;

        if (!val) {
            pwMeter.classList.remove('show');
            pwMeter.removeAttribute('data-score');
            pwLengthMsg.className = 'pw-status';
            pwLengthMsg.innerHTML = '';
            pwStrengthBadge.className = 'pw-badge';
            pwStrengthBadge.innerHTML = '';
            pwInput.classList.remove('is-valid', 'is-invalid');
        } else if (val.length < 6) {
            pwMeter.classList.add('show');
            pwMeter.setAttribute('data-score', '1');
            pwLengthMsg.className = 'pw-status show mismatch';
            pwLengthMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Minimal 6 karakter (' + val.length + '/6)';
            pwStrengthBadge.className = 'pw-badge show mismatch';
            pwStrengthBadge.innerHTML = 'Lemah';
            pwInput.classList.add('is-invalid');
            pwInput.classList.remove('is-valid');
        } else {
            var score = getPasswordScore(val);
            var labels = { 2: 'Cukup', 3: 'Kuat', 4: 'Sangat Kuat' };
            var badgeCls = score === 2 ? 'warn' : 'match';
            pwMeter.classList.add('show');
            pwMeter.setAttribute('data-score', String(score));
            pwLengthMsg.className = 'pw-status show ' + badgeCls;
            pwLengthMsg.innerHTML = '<i class="fas fa-shield-halved"></i> Panjang memenuhi syarat (' + val.length + ' karakter)';
            pwStrengthBadge.className = 'pw-badge show ' + badgeCls;
            pwStrengthBadge.innerHTML = labels[score] || 'Cukup';
            pwInput.classList.add('is-valid');
            pwInput.classList.remove('is-invalid');
        }

        if (!conf) {
            pwMatchMsg.className = 'pw-status';
            pwMatchMsg.innerHTML = '';
            pwMatchBadge.className = 'pw-badge';
            pwMatchBadge.innerHTML = '';
            pwConfirm.classList.remove('is-valid', 'is-invalid');
            isPasswordValid = val.length === 0 || val.length >= 6;
        } else if (val === conf && val.length >= 6) {
            pwMatchMsg.className = 'pw-status show match';
            pwMatchMsg.innerHTML = '<i class="fas fa-circle-check"></i> Password dan konfirmasi cocok';
            pwMatchBadge.className = 'pw-badge show match';
            pwMatchBadge.innerHTML = '<i class="fas fa-check"></i> Cocok';
            pwConfirm.classList.add('is-valid');
            pwConfirm.classList.remove('is-invalid');
            isPasswordValid = true;
        } else if (val === conf && val.length < 6) {
            pwMatchMsg.className = 'pw-status show mismatch';
            pwMatchMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Cocok, namun password kurang dari 6 karakter';
            pwMatchBadge.className = 'pw-badge show mismatch';
            pwMatchBadge.innerHTML = '<i class="fas fa-exclamation"></i> Kurang Panjang';
            pwConfirm.classList.add('is-invalid');
            pwConfirm.classList.remove('is-valid');
            isPasswordValid = false;
        } else {
            pwMatchMsg.className = 'pw-status show mismatch';
            pwMatchMsg.innerHTML = '<i class="fas fa-circle-xmark"></i> Konfirmasi password belum sesuai';
            pwMatchBadge.className = 'pw-badge show mismatch';
            pwMatchBadge.innerHTML = '<i class="fas fa-xmark"></i> Tidak Cocok';
            pwConfirm.classList.add('is-invalid');
            pwConfirm.classList.remove('is-valid');
            isPasswordValid = false;
        }

        syncSubmitButton();
    }

    pwInput.addEventListener('input', validatePasswords);
    pwConfirm.addEventListener('input', validatePasswords);

    /* ---------- Validasi NIK Real-Time ---------- */
    function validateNik() {
        let val = nikInput.value.replace(/\D/g, '').slice(0, 16);
        if (nikInput.value !== val) nikInput.value = val;

        if (!val) {
            nikBadge.className = 'pw-badge';
            nikMsg.className = 'pw-status';
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

    /* ---------- Validasi WhatsApp Real-Time ---------- */
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

    /* ---------- Kalkulasi & Validasi Umur ---------- */
    function hitungUmur() {
        if (!inputTglLahir.value) {
            inputUmur.value = '';
            alertUmur.style.display = 'none';
            isAgeValid = true;
            syncSubmitButton();
            return;
        }
        const birthDate = new Date(inputTglLahir.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }
        inputUmur.value = age + ' Tahun';

        if (age < 19 || age > 56) {
            textUmurInvalid.textContent = age;
            alertUmur.style.display = 'block';
            isAgeValid = false;
        } else {
            alertUmur.style.display = 'none';
            isAgeValid = true;
        }
        syncSubmitButton();
    }

    inputTglLahir.addEventListener('change', hitungUmur);
    if (inputTglLahir.value) hitungUmur();

    /* ---------- Pekerjaan Lainnya ---------- */
    const selectPekerjaan = document.getElementById('jenis_pekerjaan');
    const containerLainnya = document.getElementById('pekerjaan_lainnya_container');
    const inputLainnya = document.getElementById('pekerjaan_lainnya_input');

    function cekPekerjaanLainnya() {
        if (selectPekerjaan.value === 'LAINNYA...') {
            containerLainnya.style.display = 'block';
            inputLainnya.setAttribute('required', 'required');
        } else {
            containerLainnya.style.display = 'none';
            inputLainnya.removeAttribute('required');
            inputLainnya.value = '';
        }
    }

    selectPekerjaan.addEventListener('change', cekPekerjaanLainnya);
    if (selectPekerjaan.value === 'LAINNYA...') cekPekerjaanLainnya();

    /* ---------- Dropdown Wilayah Dinamis ---------- */
    const dataWilayah = @json($dataWilayah);
    const kec = document.getElementById('kecamatan');
    const kel = document.getElementById('kelurahan');

    kec.addEventListener('change', function() {
        kel.innerHTML = '';
        var ph = new Option('Pilih kelurahan', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        (dataWilayah[kec.value] || []).forEach(function(nama) {
            kel.add(new Option(nama, nama));
        });
    });

    /* ---------- Splash Screen ---------- */
    window.addEventListener('load', function() {
        const splash = document.getElementById('splash-screen');
        if (splash) {
            splash.classList.add('splash-hidden');
            setTimeout(function() { splash.remove(); }, 500);
        }
    });

})();
</script>
</body>
</html>