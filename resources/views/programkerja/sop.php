<<<<<<< HEAD
=======
<?php
    $h = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       Halaman ini dipakai bersama untuk 5 tab Program Kerja.
       Dari controller bisa dikirim: $tab_aktif dan $dokumen_list (lihat di bawah)
       ------------------------------------------------------------ */
    $tabs = [
        'sotk'        => ['url' => '/sotk',        'label' => 'SOTK',         'ico' => 'fa-sitemap',       'judul' => 'Struktur Organisasi dan Tata Kerja (SOTK)'],
        'sop'         => ['url' => '/sop',         'label' => 'SOP',          'ico' => 'fa-list-check',    'judul' => 'Standar Operasional Prosedur (SOP)'],
        'perencanaan' => ['url' => '/perencanaan', 'label' => 'Perencanaan',  'ico' => 'fa-bullseye',      'judul' => 'Dokumen perencanaan'],
        'pelaporan'   => ['url' => '/pelaporan',   'label' => 'Pelaporan',    'ico' => 'fa-file-lines',    'judul' => 'Dokumen pelaporan'],
        'produkhukum' => ['url' => '/produkhukum', 'label' => 'Produk hukum', 'ico' => 'fa-scale-balanced','judul' => 'Produk hukum'],
    ];
    $tab_aktif = $tab_aktif ?? 'sop';

    /*
      Daftar dokumen SOP. Setiap item: ['judul' => '...', 'url' => 'link berkas PDF'].
      Selama 'url' kosong, baris tampil sebagai "Berkas belum diunggah".
      Dari controller boleh kirim array atau koleksi model yang punya kolom judul dan url.
    */
    $dokumen_list = $dokumen_list ?? [
        ['judul' => 'SOP Bidang Pencegahan Kasi Peningkatan Kapasitas Aparatur', 'url' => ''],
        ['judul' => 'SOP Bidang Pencegahan Sub Koordinator Pemberdayaan Masyarakat dan Dunia Usaha', 'url' => ''],
        ['judul' => 'SOP Bidang Pencegahan Kasi Pencegahan dan Inspeksi', 'url' => ''],
    ];
    $jumlah = count($dokumen_list);

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    // Isi dengan link Google Play jika aplikasi sudah tersedia. Kosong = badge disembunyikan.
    $play_store_url = "";
?>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>SOP - Program Kerja | SIMERAH KOJA</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS (Hanya untuk Grid System) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f3f4f6;
            color: #1f2937;
        }

/* --- NAVBAR STYLES --- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #111827;
            border-bottom: 4px solid #ef4444;
            
            /* INI KUNCI UTAMANYA AGAR TETAP MENEMPEL DI ATAS SAAT DI-SCROLL */
            position: sticky;
            top: 0; 
            z-index: 9999; /* Pastikan z-index sangat tinggi agar menimpa konten lain */
        }
        .nav-logos { display: flex; gap: 15px; align-items: center; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; margin-bottom: 0; padding-left: 0; }
        .nav-links li { position: relative; padding-bottom: 15px; margin-bottom: -15px; }
        .nav-links a {
            color: #f8fafc; text-decoration: none; font-weight: 700; font-size: 13px;
            text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;
        }
        .nav-links a:hover { color: #ef4444; }
        .nav-links .btn-login {
            background-color: #ef4444; color: #ffffff; padding: 8px 24px; border-radius: 50px; margin-left: 10px;
        }
        .nav-links .btn-login:hover { background-color: #dc2626; color: #ffffff; }
        
        /* DROPDOWN CUSTOM TEMA GELAP */
        .dropdown-menu-custom {
            display: none; position: absolute; top: 100%; left: 0; background-color: #1f2937;
            min-width: 220px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border-radius: 8px;
            overflow: hidden; z-index: 10; margin-top: 0; border: 1px solid #374151; padding: 0;
        }
        .dropdown-custom:hover .dropdown-menu-custom { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu-custom li { list-style: none; padding-bottom: 0; margin-bottom: 0; }
        .dropdown-menu-custom li a {
            color: #e5e7eb; padding: 14px 20px; display: block; font-size: 13px;
            border-bottom: 1px solid #374151; font-weight: 600;
        }
        .dropdown-menu-custom li a:hover { background-color: #374151; color: #ef4444; padding-left: 26px; }

        /* --- PAGE HEADER --- */
        .page-header {
            position: relative;
            background-image: linear-gradient(rgba(11, 15, 25, 0.8), rgba(11, 15, 25, 0.95)), url('/images/background1.jpg');
            background-size: cover;
            background-position: center;
            padding: 50px 0;
            text-align: center;
            color: white;
            border-bottom: 4px solid #ef4444;
        }
        .page-header h1 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .breadcrumb-custom {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            font-weight: 600;
        }
        .breadcrumb-custom span {
            color: #ef4444;
        }
        .breadcrumb-custom a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s;
        }
        .breadcrumb-custom a:hover { color: #ffffff; }

        /* --- MAIN CONTENT --- */
        .main-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            padding: 30px; 
            margin-top: 40px; 
            margin-bottom: 60px;
        }

        /* --- HORIZONTAL TABS --- */
        .custom-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px; 
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 20px;
        }
        .custom-tabs .nav-link {
            color: #6b7280;
            font-weight: 700;
            font-size: 13px;
            padding: 10px 24px;
            border-radius: 50px;
            background-color: #f3f4f6;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .custom-tabs .nav-link:hover {
            color: #111827;
            background-color: #e5e7eb;
        }
        .custom-tabs .nav-link.active {
            color: #ffffff !important;
            background-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        .custom-tabs .nav-link i {
            margin-right: 6px;
            font-size: 14px;
        }

        /* --- CONTACT WIDGET --- */
        .contact-widget {
            background-color: #f8fafc; 
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e5e7eb;
            height: 100%; 
        }
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .contact-item i {
            color: #ef4444;
            font-size: 18px;
            margin-top: 2px;
            width: 30px;
        }
        .contact-item h6 {
            margin: 0 0 5px 0;
            font-weight: 700;
            color: #111827;
            font-size: 14px;
        }
        .contact-item p {
            margin: 0;
            font-size: 13px;
            color: #4b5563; 
            line-height: 1.5;
        }
        
        /* Updated Social Links (1 Baris) */
        .social-links {
            display: flex;
            flex-wrap: nowrap;
            gap: 6px; 
            margin-top: 25px;
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; 
            height: 32px;
            font-size: 13px;
            background-color: #ffffff;
            color: #6b7280;
            border-radius: 50%;
            border: 1px solid #e5e7eb;
            text-decoration: none;
            transition: all 0.3s;
        }
        .social-links a:hover {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
            transform: translateY(-3px);
        }

        /* --- PDF CARD STYLING --- */
        .pdf-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            text-decoration: none;
            text-align: center;
            padding: 30px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            height: 100%;
        }

        .pdf-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: #cbd5e1;
        }

        .pdf-card img {
            width: 65px;
            height: auto;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.05));
            transition: transform 0.3s ease;
        }

        .pdf-card:hover img {
            transform: scale(1.08);
        }

        .pdf-card h3 {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.5;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: color 0.3s ease;
        }

        .pdf-card:hover h3 {
            color: #ef4444;
        }

        /* --- FOOTER STYLES --- */
        .footer-bottom {
            background-color: #1a1a1a;
            color: #9ca3af;
            padding: 50px 5%;
            font-size: 13px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr 1fr;
            gap: 40px;
            max-width: 1100px;
            margin: 0 auto 40px;
        }
        .footer-logo { text-align: center; }
        .footer-logo img { height: 120px; margin-bottom: 15px; }
        .footer-about h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-about p { line-height: 1.8; font-size: 12px; margin-bottom: 20px;}
        
        .footer-map-container { position: relative; width: 100%; height: 120px; background: #333; border-radius: 8px; overflow: hidden; margin-bottom: 15px;}
        .footer-map-container img { width: 100%; height: 100%; object-fit: cover;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        .footer-download p { font-size: 12px; color: #ef4444; margin-bottom: 10px; }
        .footer-download img { height: 40px; cursor: pointer;}
        
        .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-links ul { list-style: none; padding-left: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #9ca3af; text-decoration: none; transition: color 0.3s; display: flex; align-items: center; gap: 10px;}
        .footer-links a i { font-size: 10px; color: #4b5563;}
        .footer-links a:hover { color: white; }

        .footer-copyright {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
            padding-top: 20px;
            border-top: 1px solid #333;
        }
        
        .footer-social { display: flex; gap: 5px; }
        .footer-social a {
            width: 35px; height: 35px; background: #333; color: white; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; transition: background 0.3s;
        }
        .footer-social a:hover { background: #ef4444; }

=======
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="<?= $h($tabs[$tab_aktif]['judul']) ?> Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title><?= $h($tabs[$tab_aktif]['label']) ?> - Program kerja | SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS (sama dengan halaman utama)
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
                url('/images/background1.jpg') center / cover no-repeat;
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
           TAB PROGRAM KERJA (menempel di tepi hero)
           ========================================================== */
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .tabs-wrap { position: relative; z-index: 2; margin-top: -30px; }
        .tabs {
            display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%;
            background: #fff; border: 1px solid var(--line); border-radius: 999px;
            box-shadow: 0 18px 36px -20px rgba(13,27,42,.45);
            overflow-x: auto; scrollbar-width: none;
        }
        .tabs::-webkit-scrollbar { display: none; }
        .tab {
            display: inline-flex; align-items: center; gap: 10px; white-space: nowrap;
            padding: 11px 20px; border-radius: 999px; font-weight: 600; font-size: .92rem; color: var(--steel);
            transition: background .2s, color .2s;
        }
        .tab i { font-size: .95rem; }
        .tab:hover { background: var(--paper); color: var(--ink); }
        .tab[aria-current="page"] { background: var(--ink); color: #fff; }
        .tab[aria-current="page"] i { color: var(--amber); }

        /* ==========================================================
           LAYOUT KONTEN
           ========================================================== */
        .doc-layout { display: grid; gap: 24px; margin-top: 28px; }

        .side-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: clamp(20px, 3vw, 28px); }
        .side-card h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.35rem; line-height: 1.15; letter-spacing: -0.015em; margin-bottom: 20px; }
        .contact-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px 32px; }
        .contact-list li { display: grid; grid-template-columns: 40px 1fr; gap: 14px; align-items: start; }
        .c-ico { width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }
        .contact-list small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .contact-list span, .contact-list a { font-weight: 600; font-size: .95rem; line-height: 1.45; word-break: break-word; }
        .contact-list a { transition: color .2s; }
        .contact-list a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }
        .social-title { margin: 24px 0 12px; padding-top: 20px; border-top: 1px solid var(--line); font-size: .85rem; color: var(--steel); }
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--ink); transition: background .2s, color .2s, transform .2s; }
        .social a:hover { background: var(--signal); color: #fff; transform: translateY(-3px); }

        /* ==========================================================
           DAFTAR DOKUMEN
           ========================================================== */
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
        .doc-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .doc-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 16px clamp(16px, 2.5vw, 26px); border-bottom: 1px solid var(--line); }
        .doc-title { display: flex; align-items: center; gap: 12px; min-width: 0; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.1rem; line-height: 1.25; }
        .doc-title i { flex: none; width: 38px; height: 38px; border-radius: 12px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: .95rem; }
        .doc-filter { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
        .doc-count { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); font-variant-numeric: tabular-nums; }
        .doc-search { position: relative; display: block; }
        .doc-search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
        .doc-search input { width: min(280px, 100%); height: 40px; padding: 0 16px 0 40px; border: 1px solid var(--line); border-radius: 999px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s; }
        .doc-search input:hover { border-color: #b8c3d0; }
        .doc-search input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }

        .doc-row { position: relative; display: grid; grid-template-columns: 52px minmax(0, 1fr) auto; gap: 18px; align-items: center; padding: 18px clamp(16px, 2.5vw, 26px); border-bottom: 1px solid var(--line); transition: background .2s; }
        .doc-row:last-child { border-bottom: 0; }
        .doc-row[hidden] { display: none; }
        .doc-row:not(.is-empty):hover { background: var(--paper); }
        .doc-ico { width: 52px; height: 52px; border-radius: 14px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: 1.4rem; }
        .doc-row.is-empty .doc-ico { background: var(--paper); color: #b8c3d0; }
        .doc-name { font-family: var(--font-display); font-weight: 600; font-stretch: 92%; font-size: 1.1rem; line-height: 1.35; letter-spacing: -0.005em; }
        .doc-name a::after { content: ""; position: absolute; inset: 0; }
        .doc-row:not(.is-empty):hover .doc-name a { color: var(--signal-d); }
        .doc-row.is-empty .doc-name { color: var(--steel); }
        .doc-meta { margin-top: 2px; font-size: .85rem; color: var(--steel); }
        .doc-actions { position: relative; z-index: 1; display: flex; gap: 8px; }
        .tool { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-width: 40px; height: 40px; padding: 0 16px; border-radius: 999px; background: var(--paper); font-size: .88rem; font-weight: 600; transition: background .2s, color .2s; }
        .tool:hover { background: var(--ink); color: #fff; }
        .doc-row:hover .tool { background: #fff; }
        .doc-row:hover .tool:hover { background: var(--ink); }

        .doc-none, .doc-empty { text-align: center; color: var(--steel); }
        .doc-none[hidden] { display: none; }
        .doc-none { padding: 40px 24px; }
        .doc-empty { min-height: 420px; display: grid; place-content: center; justify-items: center; gap: 6px; padding: 40px 24px; background: repeating-linear-gradient(135deg, var(--paper) 0 14px, #eaeef3 14px 28px); }
        .doc-empty i { font-size: 2.2rem; color: #b8c3d0; margin-bottom: 8px; }
        .doc-empty h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.25rem; color: var(--ink); }
        .doc-empty p { max-width: 40ch; font-size: .95rem; }

        @media (max-width: 640px) {
            .doc-row { grid-template-columns: 52px minmax(0, 1fr); align-items: start; }
            .doc-actions { grid-column: 1 / -1; }
            .doc-actions .tool { flex: 1; }
            .doc-search, .doc-search input { width: 100%; }
            .doc-filter { width: 100%; }
        }

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
        .footer .social a { background: rgba(255,255,255,.08); color: #fff; }
        .footer .social a:hover { background: var(--signal); }
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

        /* ==========================================================
           REDUCED MOTION
           ========================================================== */
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    </style>
</head>
<body>

<<<<<<< HEAD
    <?php
        $no_whatsapp = "628117113113"; 
        $no_telepon  = "074141171";
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    ?>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="nav-logos" style="text-decoration: none;">
            <img src="/images/jambi.png" alt="Logo Pemkot">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>
        <ul class="nav-links">
            <li class="dropdown-custom">
                <a href="#">Layanan Kedaruratan <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu-custom">
                    <li><a href="https://wa.me/<?php echo $no_whatsapp; ?>?text=<?php echo $pesan_wa; ?>" target="_blank">WHATSAPP</a></li>
                    <li><a href="tel:<?php echo $no_telepon; ?>">TELEPHONE</a></li>
                    <li><a href="tel:112">CALL CENTER 112</a></li>
                </ul>
            </li>
            
            <li class="dropdown-custom">
                <a href="#">Program Kerja <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu-custom">
                    <li><a href="/sotk">SOTK</a></li>
                    <li><a href="/perencanaan">PERENCANAAN</a></li>
                    <li><a href="/pelaporan">PELAPORAN</a></li>
                    <li><a href="/sop">SOP</a></li>
                    <li><a href="/produkhukum">PRODUK HUKUM</a></li>
                </ul>
            </li>

            <li class="dropdown-custom">
                <a href="#">Layanan & Fasilitas <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu-custom">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">LAYANAN PERIZINAN</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">EDUKASI DAN SOSIALISASI</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK</a></li>
                </ul>
            </li>  
            
            <li><a href="/redkar">Redkar</a></li>
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>PROGRAM KERJA</h1>
            <div class="breadcrumb-custom mt-2">
                <a href="/">Home</a> 
                <i class="fas fa-angle-double-right mx-2" style="font-size: 10px; color: #9ca3af;"></i> 
                <span>PROGRAM KERJA</span>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="container">
        <div class="main-container">
            
            <!-- Horizontal Tabs Navigation -->
            <ul class="nav custom-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="/sotk">
                        <i class="fas fa-folder"></i> SOTK
                    </a>
                </li>
                <!-- TAB SOP ACTIVE -->
                <li class="nav-item">
                    <a class="nav-link active" href="/sop">
                        <i class="fas fa-folder-open"></i> SOP
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/perencanaan">
                        <i class="fas fa-folder"></i> PERENCANAAN
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pelaporan">
                        <i class="fas fa-folder"></i> PELAPORAN
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/produkhukum">
                        <i class="fas fa-folder"></i> PRODUK HUKUM
                    </a>
                </li>
            </ul>

            <!-- Grid Layout (Contact Info + PDF List) -->
            <div class="row g-4 align-items-stretch">
                
                <!-- Kiri: Widget Kontak -->
                <div class="col-lg-4 col-xl-3">
                    <div class="contact-widget position-sticky" style="top: 100px;">
                        <div class="contact-item">
                            <i class="fas fa-envelope-open-text"></i>
                            <div>
                                <h6>Email Resmi</h6>
                                <p><a href="mailto:damkar.jbi@gmail.com" style="color: #4b5563; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#4b5563'">damkar.jbi@gmail.com</a></p>
                            </div>
                        </div>
                        <div class="contact-item mb-0">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h6>Alamat Kantor</h6>
                                <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru</p>
                            </div>
                        </div>
                        
                        <div class="social-links">
                            <a href="mailto:damkar.jbi@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
                            <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                            <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Daftar PDF Grid -->
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        
                        <!-- File PDF 1 -->
                        <div class="col-md-6">
                            <a href="#" target="_blank" class="pdf-card">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF Icon">
                                <h3>SOP Bidang Pencegahan Kasi Peningkatan Kapasitas Aparatur</h3>
                            </a>
                        </div>
                        
                        <!-- File PDF 2 -->
                        <div class="col-md-6">
                            <a href="#" target="_blank" class="pdf-card">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF Icon">
                                <h3>SOP Bidang Pencegahan Sub Koordinator Pemberdayaan Masyarakat dan Dunia Usaha</h3>
                            </a>
                        </div>
                        
                        <!-- File PDF 3 -->
                        <div class="col-md-6">
                            <a href="#" target="_blank" class="pdf-card">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF Icon">
                                <h3>SOP Bidang Pencegahan Kasi Pencegahan dan Inspeksi</h3>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="footer-bottom">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
                </div>
                <h3>Tentang Kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>
            
            <div class="footer-contact">
                <div class="footer-map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
                <div class="footer-find">
                    <i class="fas fa-map-marker-alt"></i> Find us on Map
                </div>
                <div class="footer-download">
                    <p>Download Aplikasi SIMERAH KOJA :</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play">
                </div>
            </div>
            
            <div class="footer-links">
                <h3>Link Terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-copyright">
            <div>SIMERAHKOJA © 2026 / ALL RIGHTS RESERVED</div>
            <!-- Footer Social Links -->
            <div class="footer-social">
                <a href="mailto:damkar.jbi@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
=======
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
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan &amp; fasilitas <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
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
                <li><a href="/sotk">Program kerja</a></li>
                <li><span aria-current="page"><?= $h($tabs[$tab_aktif]['label']) ?></span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Program kerja</h1>
        <p class="rise d2">Struktur organisasi, prosedur, perencanaan, pelaporan, dan produk hukum Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
</section>

<div class="page-body">
    <!-- Tab -->
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

            <!-- Daftar dokumen -->
            <section class="doc-panel" aria-label="Daftar dokumen">
                <div class="doc-bar">
                    <div class="doc-title">
                        <i class="fas <?= $h($tabs[$tab_aktif]['ico']) ?>"></i>
                        <span><?= $h($tabs[$tab_aktif]['judul']) ?></span>
                    </div>
                    <div class="doc-filter">
                        <span class="doc-count" id="docCount" aria-live="polite"><?= (int) $jumlah ?> dokumen</span>
                        <?php if ($jumlah > 5): ?>
                        <label class="doc-search">
                            <span class="sr-only">Cari dokumen</span>
                            <i class="fas fa-search"></i>
                            <input type="search" id="docSearch" placeholder="Cari dokumen" autocomplete="off">
                        </label>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($jumlah): ?>
                <ul class="doc-list">
                    <?php foreach ($dokumen_list as $d):
                        $d     = (is_object($d) && method_exists($d, 'toArray')) ? $d->toArray() : (array) $d;
                        $judul = (string) ($d['judul'] ?? '');
                        $url   = (string) ($d['url'] ?? '');
                        $ada   = $url !== '';
                        $ext   = $ada ? strtoupper(pathinfo((string) parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION)) : '';
                        $ext   = $ext ?: 'PDF';
                        $ico   = ['PDF' => 'fa-file-pdf', 'DOC' => 'fa-file-word', 'DOCX' => 'fa-file-word', 'XLS' => 'fa-file-excel', 'XLSX' => 'fa-file-excel'][$ext] ?? 'fa-file-lines';
                    ?>
                    <li class="doc-row <?= $ada ? '' : 'is-empty' ?>" data-name="<?= $h(mb_strtolower($judul)) ?>">
                        <span class="doc-ico"><i class="fas <?= $h($ada ? $ico : 'fa-file-circle-question') ?>"></i></span>
                        <div>
                            <p class="doc-name">
                                <?php if ($ada): ?>
                                    <a href="<?= $h($url) ?>" target="_blank" rel="noopener"><?= $h($judul) ?></a>
                                <?php else: ?>
                                    <?= $h($judul) ?>
                                <?php endif; ?>
                            </p>
                            <p class="doc-meta"><?= $ada ? 'Dokumen ' . $h($ext) : 'Berkas belum diunggah' ?></p>
                        </div>
                        <?php if ($ada): ?>
                        <div class="doc-actions">
                            <a class="tool" href="<?= $h($url) ?>" target="_blank" rel="noopener" aria-label="Buka <?= $h($judul) ?>"><i class="fas fa-arrow-up-right-from-square"></i> Buka</a>
                            <a class="tool" href="<?= $h($url) ?>" download aria-label="Unduh <?= $h($judul) ?>"><i class="fas fa-download"></i> Unduh</a>
                        </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <p class="doc-none" id="docNone" hidden>Tidak ada dokumen yang cocok. Coba kata kunci lain.</p>
                <?php else: ?>
                <div class="doc-empty">
                    <i class="far fa-folder-open"></i>
                    <h3>Belum ada dokumen</h3>
                    <p><?= $h($tabs[$tab_aktif]['judul']) ?> akan tampil di sini setelah petugas mengunggahnya.</p>
                </div>
                <?php endif; ?>
            </section>

            <!-- Kontak -->
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
                                <a href="<?= $h($maps_link) ?>" target="_blank" rel="noopener">Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru</a>
                            </div>
                        </li>
                    </ul>

                    <p class="social-title">Ikuti kami</p>
                    <div class="social">
                        <a href="mailto:damkar.jbi@gmail.com" title="Email" aria-label="Email"><i class="fas fa-envelope"></i></a>
                        <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" title="Twitter / X" aria-label="Twitter / X"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </aside>

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

    /* ---------- Tombol lapor mengambang (muncul setelah scroll) ---------- */
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

    /* ---------- Pencarian dokumen ---------- */
    var search = document.getElementById('docSearch');
    if (search) {
        var rows = document.querySelectorAll('.doc-row');
        var count = document.getElementById('docCount');
        var none = document.getElementById('docNone');
        search.addEventListener('input', function () {
            var q = search.value.trim().toLowerCase();
            var n = 0;
            rows.forEach(function (r) {
                var hit = r.dataset.name.indexOf(q) !== -1;
                r.hidden = !hit;
                if (hit) n++;
            });
            count.textContent = n + ' dokumen';
            none.hidden = n !== 0;
        });
    }
})();
</script>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
</body>
</html>