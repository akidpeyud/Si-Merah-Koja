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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>Edukasi dan Sosialisasi | SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
        TOKENS
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
            font-family: var(--font-body); font-size: 1rem; line-height: 1.65;
            color: var(--ink); background: var(--white); -webkit-font-smoothing: antialiased; overflow-x: hidden;
        }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* ==========================================================
        HEADER NAVBAR
        ========================================================== */
        .site-header {
            position: sticky; top: 0; z-index: 60;
            background: rgba(13, 27, 42, .85); -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav { max-width: var(--wrap); margin: 0 auto; height: var(--header-h); padding: 0 clamp(16px, 4vw, 32px); display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand img { height: 38px; width: auto; }
        .menu { display: flex; align-items: center; gap: 2px; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger {
            display: inline-flex; align-items: center; gap: 8px; padding: 9px 14px; border-radius: 999px;
            color: rgba(255,255,255,.88); font-size: .92rem; font-weight: 500; transition: background .2s, color .2s;
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

        /* Tombol Logout Dropdown */
        .dropdown .btn-logout {
            width: 100%; text-align: left; padding: 11px 14px; border-radius: var(--r-sm); 
            font-size: .92rem; color: #ff8b8b; display: flex; align-items: center; gap: 8px; 
            transition: background .2s, color .2s; cursor: pointer;
        }
        .dropdown .btn-logout:hover { background: rgba(255, 255, 255, .1); color: #ffb8b8; }

        .has-drop.open .dropdown { display: block; }
        @media (hover: hover) and (min-width: 992px) { .has-drop:hover .dropdown { display: block; } }

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
        HERO HALAMAN
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
        .page-hero h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2.8rem, 8vw, 5.5rem); line-height: .95; letter-spacing: -0.035em; text-transform: uppercase;}
        .page-hero p { margin-top: 18px; max-width: 56ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
        LAYOUT KONTEN
        ========================================================== */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); padding-top: 40px;}
        .perizinan-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 24px; align-items: start; }
        @media (min-width: 992px) { .perizinan-layout { grid-template-columns: minmax(300px, 380px) minmax(0, 1fr); gap: 32px; } }
        .info-stack { display: grid; gap: 16px; }

        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(20px, 3vw, 28px); }
        .card-head { display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }
        .card-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.25rem; line-height: 1.15; letter-spacing: -0.015em; }

        .checklist { display: grid; gap: 18px; }
        .checklist li { display: grid; grid-template-columns: 32px minmax(0, 1fr); gap: 14px; align-items: start; font-size: .93rem; line-height: 1.5; }
        .ck-ico { width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .9rem; }
        .checklist ul { margin-top: 8px; display: grid; gap: 6px; }
        .checklist ul li { display: flex; gap: 8px; font-size: .88rem; color: var(--steel); align-items: center;}
        .checklist ul li::before { content: ""; display: block; width: 6px; height: 6px; border-radius: 50%; background: var(--steel); }

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

        /* ==========================================================
        FORMULIR
        ========================================================== */
        .form-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 18px clamp(18px, 3vw, 32px); border-bottom: 1px solid var(--line); }
        .form-title { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .form-title > i { flex: none; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; }
        .form-title h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; }
        .form-note { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }

        .form-body { padding: clamp(18px, 3vw, 32px); display: grid; gap: 36px; }
        .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .92rem; line-height: 1.5; }
        .alert i { margin-top: 3px; }
        .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
        .alert ul { display: grid; gap: 2px; margin-top: 4px; padding-left: 18px; list-style: disc; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
        .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
        .fields-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px 20px; }
        .field { min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        @media (max-width: 640px) { .fields, .fields-4 { grid-template-columns: minmax(0, 1fr); } }

        .label { display: block; margin-bottom: 8px; font-size: .9rem; font-weight: 600; line-height: 1.35; }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }
        .field-err { margin-top: 6px; display: flex; gap: 8px; align-items: flex-start; font-size: .82rem; font-weight: 500; line-height: 1.4; color: var(--signal-d); }
        .field-err:empty { display: none; }
        
        .input {
            display: block; width: 100%; height: 48px; padding: 0 16px;
            border: 1px solid var(--line); border-radius: 14px; background: #fff;
            font: inherit; font-size: .95rem; color: var(--ink);
            transition: border-color .2s, box-shadow .2s;
        }
        textarea.input { height: auto; padding-top: 12px; resize: vertical; }
        .input::placeholder { color: #93a1b1; }
        .input:hover { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        .input:user-invalid, .input.is-invalid { border-color: var(--signal); }
        select.input {
            appearance: none; -webkit-appearance: none; padding-right: 42px; cursor: pointer;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 16px center;
        }

        /* Dropzone File Upload */
        .dropzone {
            position: relative; display: grid; justify-items: center; gap: 8px; text-align: center;
            padding: 26px 20px; border: 2px dashed #b8c3d0; border-radius: var(--r-md);
            background: var(--paper); color: var(--steel); font-size: .92rem; line-height: 1.45;
            cursor: pointer; transition: border-color .2s, background .2s;
        }
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
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s; cursor: pointer;}
        .btn-primary { background: var(--signal); color: #fff; border: none; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover:not(:disabled) { background: var(--signal-d); }
        .btn-primary:disabled { background: #fca5a5; cursor: not-allowed; box-shadow: none; }

        /* ==========================================================
        FOOTER
        ========================================================== */
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
        TOMBOL LAPOR MENGAMBANG
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

        /* POPUP SUCCESS */
        #success-popup-overlay {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background-color: rgba(13, 27, 42, 0.85); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center; z-index: 999999;
            animation: fadeInOverlay 0.3s ease forwards;
        }
        .success-popup-box {
            background: #fff; border-radius: var(--r-md); padding: 40px 30px; text-align: center;
            max-width: 420px; width: 90%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: popInBox 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; position: relative; overflow: hidden;
        }
        .success-popup-box::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background-color: var(--signal); }
        .success-popup-icon { width: 80px; height: 80px; background-color: #fdeceb; color: var(--signal); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 20px; box-shadow: 0 0 20px rgba(229, 57, 45, 0.15); }
        .success-popup-title { color: var(--ink); font-family: var(--font-display); font-size: 22px; font-weight: 800; margin-bottom: 10px; }
        .success-popup-message { color: var(--steel); font-size: 14px; line-height: 1.6; margin-bottom: 30px; }
        @keyframes fadeInOverlay { from { opacity: 0; } to { opacity: 1; } }
        @keyframes popInBox { from { transform: scale(0.7); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    </style>
</head>
<body>

<!-- ALERT SUKSES POPUP -->
@if(session('success'))
    <div id="success-popup-overlay">
        <div class="success-popup-box" id="success-popup-box">
            <div class="success-popup-icon"><i class="fas fa-check"></i></div>
            <div class="success-popup-title">BERHASIL!</div>
            <div class="success-popup-message">{{ session('success') }}</div>
            <button class="btn btn-primary w-100" onclick="document.getElementById('success-popup-overlay').remove()">OKE, TERIMA KASIH</button>
        </div>
    </div>
@endif

<!-- ==================== HEADER ==================== -->
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
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan &amp; fasilitas <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi" aria-current="page">Edukasi dan sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>
            
            <!-- LOGIKA TOMBOL MASUK DAN KELUAR UNTUK PEMOHON -->
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

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap text-center">
        <nav aria-label="Breadcrumb" class="rise d-flex justify-content-center">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Layanan & fasilitas</a></li>
                <li><span aria-current="page">Edukasi & Sosialisasi</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Edukasi & Sosialisasi</h1>
        <p class="rise d2 mx-auto">Ajukan layanan edukasi dan sosialisasi bahaya kebakaran untuk sekolah, instansi, maupun kelompok masyarakat secara gratis.</p>
    </div>
</section>

<!-- ==================== LAYOUT KONTEN ==================== -->
<div class="page-body">
    <div class="wrap perizinan-layout">

        <!-- Informasi Syarat -->
        <aside class="info-stack" aria-label="Informasi layanan">
            <section class="side-card">
                <div class="card-head">
                    <span class="c-ico"><i class="fas fa-envelope"></i></span>
                    <h2>Persyaratan Dokumen</h2>
                </div>
                <ol class="checklist">
                    <li><span class="ck-ico"><i class="fas fa-file-signature"></i></span><div>Unggah surat permohonan bermaterai. <br> <span class="muted">(Tidak ada template khusus, silakan buat sendiri)</span></div></li>
                    <li>
                        <span class="ck-ico"><i class="fas fa-folder-open"></i></span>
                        <div>
                            Persyaratan Tambahan (Opsional):
                            <ul>
                                <li>Fotocopy identitas penanggung jawab</li>
                                <li>Data peserta & rencana jadwal kunjungan</li>
                                <li>Surat pernyataan kesediaan menyediakan alat peraga (jika diperlukan)</li>
                            </ul>
                        </div>
                    </li>
                </ol>
            </section>

            <section class="side-card">
                <div class="card-head">
                    <span class="c-ico"><i class="fas fa-cogs"></i></span>
                    <h2>Sistem & Mekanisme</h2>
                </div>
                <details class="disclose">
                    <summary>
                        <span class="when-closed">Tampilkan detail</span><span class="when-open">Sembunyikan detail</span>
                        <i class="fas fa-chevron-down"></i>
                    </summary>
                    <ol class="steps">
                        <li>Pemohon mendaftar secara online dan mengupload persyaratan yang dibutuhkan</li>
                        <li>Admin memverifikasi permohonan dan ketersediaan jadwal petugas</li>
                        <li>Pemohon akan mendapatkan notifikasi persetujuan jadwal via pesan WhatsApp</li>
                        <li>Pelaksanaan kegiatan edukasi sesuai jadwal dan tempat yang telah disetujui</li>
                    </ol>
                </details>
            </section>
            
            <section class="side-card">
                <div class="card-head">
                    <span class="c-ico"><i class="fas fa-hand-holding-usd"></i></span>
                    <h2>Biaya & Tarif</h2>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem; color: #16a34a;"><i class="fas fa-tags"></i></div>
                    <div style="font-weight: 700; font-size: 1.1rem; color: var(--ink);">GRATIS</div>
                </div>
                <p class="mt-2 text-muted" style="font-size: .9rem;">Layanan edukasi dan sosialisasi pemadam kebakaran tidak dipungut biaya apa pun.</p>
            </section>
        </aside>

        <!-- Formulir Pendaftaran -->
        <section class="form-panel" id="formulir">
            <div class="form-bar">
                <div class="form-title">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <div>
                        <h2>Form Pengajuan</h2>
                        <p>Isi data institusi dan rincian peserta dengan lengkap.</p>
                    </div>
                </div>
                <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
            </div>

            <form class="form-body" action="{{ route('permohonan.edukasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    <div class="alert err" role="alert">
                        <i class="fas fa-triangle-exclamation"></i>
                        <div>
                            Mohon periksa kembali form Anda:
                            <ul>
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Data Institusi -->
                <fieldset class="fs">
                    <legend><i class="fas fa-school"></i> Profil Institusi / Pemohon</legend>
                    <div class="fields">
                        <div class="field full">
                            <label class="label">Nama Institusi (Sekolah/Kampus/RT/Instansi) <span class="req">*</span></label>
                            <input class="input{{ $inv('institusi') }}" type="text" name="institusi" value="{{ old('institusi') }}" required>
                            {!! $fe('institusi') !!}
                        </div>
                        <div class="field full">
                            <label class="label">Nama Penanggung Jawab <span class="req">*</span></label>
                            <input class="input{{ $inv('nama_pemohon') }}" type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required>
                            {!! $fe('nama_pemohon') !!}
                        </div>
                        <div class="field">
                            <label class="label">Jabatan <span class="req">*</span></label>
                            <input class="input{{ $inv('jabatan_pemohon') }}" type="text" name="jabatan_pemohon" value="{{ old('jabatan_pemohon') }}" placeholder="Cth: Kepala Sekolah, Ketua RT" required>
                            {!! $fe('jabatan_pemohon') !!}
                        </div>
                        <div class="field">
                            <label class="label">NIK Penanggung Jawab <span class="req">*</span></label>
                            <input class="input{{ $inv('nik') }}" type="text" name="nik" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit NIK" required>
                            {!! $fe('nik') !!}
                        </div>
                        <div class="field">
                            <label class="label">No WhatsApp Aktif <span class="req">*</span></label>
                            <input class="input{{ $inv('no_kontak') }}" type="tel" name="no_kontak" value="{{ old('no_kontak') }}" placeholder="Cth: 081234567890" required>
                            <p class="hint">Notifikasi persetujuan jadwal akan dikirim ke nomor ini.</p>
                            {!! $fe('no_kontak') !!}
                        </div>
                    </div>
                </fieldset>

                <!-- Lokasi Kegiatan -->
                <fieldset class="fs">
                    <legend><i class="fas fa-map-marked-alt"></i> Lokasi Edukasi</legend>
                    <div class="fields">
                        <div class="field full">
                            <label class="label">Alamat Lengkap Kegiatan <span class="req">*</span></label>
                            <textarea class="input" name="alamat_institusi" rows="2" style="height:auto; padding-top:12px;" required>{{ old('alamat_institusi') }}</textarea>
                        </div>
                        <div class="field">
                            <label class="label">Kecamatan <span class="req">*</span></label>
                            <select class="input" name="kecamatan" id="kecamatan" required>
                                <option value="" disabled @if(!$oldKec) selected @endif>Pilih Kecamatan</option>
                                @foreach(array_keys($dataWilayah) as $kc)
                                    <option value="{{ $kc }}" @if($oldKec === $kc) selected @endif>{{ $kc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label class="label">Kelurahan <span class="req">*</span></label>
                            <select class="input" name="kelurahan" id="kelurahan" required>
                                @if($oldKec && isset($dataWilayah[$oldKec]))
                                    <option value="" disabled @if(!$oldKel) selected @endif>Pilih kelurahan</option>
                                    @foreach($dataWilayah[$oldKec] as $kl)
                                        <option value="{{ $kl }}" @if($oldKel === $kl) selected @endif>{{ $kl }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </fieldset>
                
                <!-- Rincian Acara -->
                <fieldset class="fs">
                    <legend><i class="fas fa-calendar-alt"></i> Rincian Jadwal & Peserta</legend>
                    <div class="fields">
                        <div class="field full">
                            <label class="label">Tanggal Rencana Kegiatan <span class="req">*</span></label>
                            <input class="input" type="date" name="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}" required>
                            <p class="hint">Jadwal ini bersifat pengajuan dan masih dapat disesuaikan ulang oleh admin Damkar.</p>
                        </div>
                        
                        <div class="field full mt-3">
                            <label class="label mb-3">Estimasi Jumlah Peserta Berdasarkan Usia</label>
                            <div class="fields-4">
                                <div class="field">
                                    <label class="label text-muted" style="font-size: 11px;">Usia 3 - 6 Tahun</label>
                                    <input class="input" type="number" name="usia_3_6" value="{{ old('usia_3_6', 0) }}" min="0">
                                </div>
                                <div class="field">
                                    <label class="label text-muted" style="font-size: 11px;">Usia 7 - 12 Tahun</label>
                                    <input class="input" type="number" name="usia_7_12" value="{{ old('usia_7_12', 0) }}" min="0">
                                </div>
                                <div class="field">
                                    <label class="label text-muted" style="font-size: 11px;">Usia 13 - 18 Tahun</label>
                                    <input class="input" type="number" name="usia_13_18" value="{{ old('usia_13_18', 0) }}" min="0">
                                </div>
                                <div class="field">
                                    <label class="label text-muted" style="font-size: 11px;">Usia > 18 Tahun</label>
                                    <input class="input" type="number" name="usia_18_keatas" value="{{ old('usia_18_keatas', 0) }}" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- Berkas -->
                <fieldset class="fs">
                    <legend><i class="fas fa-paperclip"></i> Dokumen Pendukung</legend>
                    <div class="fields">
                        <div class="field full">
                            <span class="label">Surat Permohonan <span class="req">*</span></span>
                            <label class="dropzone{{ $inv('surat_permohonan') }}" data-dropzone data-max="5">
                                <input type="file" name="surat_permohonan" accept=".pdf,.jpg,.jpeg,.png" required>
                                <span class="dz-ico"><i class="fas fa-file-invoice"></i></span>
                                <span class="dz-text"><strong>Tarik surat ke sini</strong> atau <u>pilih file</u></span>
                                <ul class="dz-files" aria-live="polite"></ul>
                            </label>
                            <p class="hint">Format PDF, JPG, atau PNG. Maksimal 5 MB.</p>
                            <p class="field-err dz-msg" role="alert"></p>
                            {!! $fe('surat_permohonan') !!}
                        </div>
                        
                        <div class="field full">
                            <span class="label">Syarat Tambahan <span class="text-muted">(Opsional)</span></span>
                            <label class="dropzone{{ $inv('syarat_lainnya') }}" data-dropzone data-max="10">
                                <input type="file" name="syarat_lainnya" accept=".pdf,.zip,.rar">
                                <span class="dz-ico"><i class="fas fa-file-archive"></i></span>
                                <span class="dz-text"><strong>Tarik file tambahan</strong> atau <u>pilih file</u></span>
                                <ul class="dz-files" aria-live="polite"></ul>
                            </label>
                            <p class="hint">Bila ada lampiran KTP penanggung jawab atau daftar peserta, jadikan satu file PDF/ZIP. Maksimal 10 MB.</p>
                            <p class="field-err dz-msg" role="alert"></p>
                            {!! $fe('syarat_lainnya') !!}
                        </div>
                    </div>
                </fieldset>

                <div class="form-actions mt-4 border-top pt-4">
                    <button type="submit" class="btn btn-primary w-100 py-3"><i class="fas fa-paper-plane"></i> Kirim Pengajuan Edukasi</button>
                </div>
            </form>
        </section>
    </div>
</div>

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
                    <iframe title="Lokasi Dinas Pemadam" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="{{ $maps_link }}" target="_blank" rel="noopener"><span><i class="fas fa-location-arrow"></i> Buka Peta</span></a>
                </div>
            </div>

            <div class="footer-links">
                <h3>Link terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank"><i class="fas fa-angle-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank"><i class="fas fa-angle-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank"><i class="fas fa-angle-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; {{ date('Y') }}. Hak cipta dilindungi.</div>
            <div class="social">
                <a href="mailto:damkar.jbi@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
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

<!-- Script Interactivity -->
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

    /* ---------- Area unggah berkas ---------- */
    function fmtSize(b) { return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(1) + ' MB'; }
    document.querySelectorAll('[data-dropzone]').forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');
        var maxMb = parseFloat(dz.getAttribute('data-max')) || 0;
        var msg = dz.parentNode.querySelector('.dz-msg');

        ['dragenter', 'dragover'].forEach(function (t) { dz.addEventListener(t, function () { dz.classList.add('is-over'); }); });
        ['dragleave', 'drop'].forEach(function (t) { dz.addEventListener(t, function () { dz.classList.remove('is-over'); }); });

        input.addEventListener('change', function () {
            list.textContent = ''; if (msg) msg.textContent = ''; dz.classList.remove('is-invalid');
            var files = Array.prototype.slice.call(input.files);
            var terlalubesar = files.some(function (f) { return maxMb && f.size > maxMb * 1048576; });
            if (terlalubesar) {
                input.value = ''; dz.classList.remove('has-files'); dz.classList.add('is-invalid');
                if (msg) msg.textContent = 'Ukuran berkas melebihi ' + maxMb + ' MB.';
                return;
            }
            files.forEach(function (f) {
                var li = document.createElement('li');
                li.textContent = f.name + ' (' + fmtSize(f.size) + ')';
                list.appendChild(li);
            });
            dz.classList.toggle('has-files', files.length > 0);
        });
    });

    /* ---------- Dropdown Kecamatan Kelurahan ---------- */
    const dataWilayah = @json($dataWilayah);
    const kec = document.getElementById('kecamatan');
    const kel = document.getElementById('kelurahan');

    kec.addEventListener('change', function() {
        kel.innerHTML = '';
        var ph = new Option('Pilih kelurahan', '', true, true); ph.disabled = true; kel.add(ph);
        (dataWilayah[kec.value] || []).forEach(function(nama) {
            kel.add(new Option(nama, nama));
        });
    });

})();
</script>
</body>
</html>