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

    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       Dari controller kirim:
         $posPemadam  : koleksi/array pos, tiap item punya id_pos, nama_pos, alamat, kode_map
         $dataSarana  : koleksi/array sarana, tiap item punya id_pos, jenis_sarana, path_gambar, tahun (opsional), plat_nomor (opsional)
       ------------------------------------------------------------ */
    $posPemadam      = $posPemadam ?? [];
    $dataSarana = $dataSarana ?? [];

    // Sidebar kategori publikasi. Kategori & item aktif untuk halaman ini: Sapra > Sarana pemeriksaan
    $kategori = [
        'pencegahan' => ['label' => 'Bagian pencegahan', 'items' => []],
        'pemadaman'  => ['label' => 'Bagian pemadaman',  'items' => []],
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
    $kategori_aktif = 'sapra';
    $halaman_aktif  = '/informasi-sarana';

    // Menu Program kerja (dipakai oleh dropdown di header)
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
    <meta name="description" content="Galeri publik armada dan kelengkapan sarana pemadam kebakaran di setiap pos Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>Sarana pemadam | SIMERAH KOJA</title>
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
            --blue: #2563eb;

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
           LAYOUT UTAMA
           ========================================================== */
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
        .page-body { background: var(--paper); padding-bottom: clamp(64px, 9vw, 112px); }
        .info-layout { display: grid; grid-template-columns: 300px minmax(0, 1fr); gap: 24px; align-items: start; margin-top: 40px; }
        @media (max-width: 900px) { .info-layout { grid-template-columns: 1fr; } }
        .cat-panel { position: sticky; top: calc(var(--header-h) + 16px); background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: 20px 16px; }
        @media (max-width: 900px) { .cat-panel { position: static; } }
        .cat-panel h2 { padding: 4px 10px 16px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; letter-spacing: -0.01em; }

        /* --- Sidebar kategori --- */
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
           PANEL DATA
           ========================================================== */
        .data-col { display: grid; gap: 24px; min-width: 0; }

        .data-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 18px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: clamp(20px, 3vw, 28px); }
        .data-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.35rem, 2.6vw, 1.75rem); line-height: 1.2; letter-spacing: -0.015em; color: var(--signal-d); }
        .data-head p { margin-top: 6px; color: var(--steel); max-width: 56ch; font-size: .95rem; }
        .search { position: relative; width: min(300px, 100%); flex: none; }
        .search i { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .9rem; pointer-events: none; }
        .search input { width: 100%; height: 46px; padding: 0 18px 0 44px; border-radius: 999px; border: 1.5px solid var(--line); background: var(--paper); font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, background .2s; }
        .search input::placeholder { color: #9aa8b8; }
        .search input:focus { outline: none; border-color: var(--ink); background: #fff; box-shadow: 0 0 0 4px rgba(255,182,39,.4); }

        .pos-tabs { display: flex; flex-wrap: wrap; gap: 8px; }
        .pos-tab { padding: 10px 22px; border-radius: 999px; background: #fff; border: 1.5px solid var(--line); font-weight: 700; font-size: .85rem; letter-spacing: .01em; color: var(--steel); transition: background .2s, color .2s, border-color .2s; }
        .pos-tab:hover { border-color: #b8c3d0; color: var(--ink); }
        .pos-tab[aria-selected="true"] { background: var(--signal); border-color: var(--signal); color: #fff; box-shadow: 0 10px 20px -10px rgba(229,57,45,.7); }

        .pos-panel[hidden] { display: none; }
        .pos-panel { display: grid; gap: 20px; }

        .pos-info { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 20px 24px; }
        .pos-info h3 { display: flex; align-items: center; gap: 12px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.1rem; letter-spacing: -0.01em; }
        .pos-info h3 i { color: var(--signal-d); }
        .pos-info p { margin-top: 6px; display: flex; align-items: center; gap: 8px; color: var(--steel); font-size: .9rem; }
        .pos-info p i { color: var(--steel); font-size: .8rem; }
        .btn-maps { flex: none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 10px; background: #fdeceb; color: var(--signal-d); font-weight: 700; font-size: .85rem; border: 1px solid #f5c2be; transition: background .2s, color .2s; }
        .btn-maps:hover { background: var(--signal); color: #fff; border-color: var(--signal); }

        .gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
        .g-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; transition: transform .25s, box-shadow .25s; }
        .g-card:hover { transform: translateY(-5px); box-shadow: 0 20px 34px -20px rgba(13,27,42,.4); }
        .g-card[hidden] { display: none; }
        .g-thumb { position: relative; height: 180px; background: var(--paper); overflow: hidden; display: grid; place-items: center; }
        .g-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
        .g-card:hover .g-thumb img { transform: scale(1.06); }
        .g-thumb i { font-size: 2.1rem; color: #b8c3d0; }
        .g-body { padding: 16px 18px 18px; }
        .g-title { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: .96rem; line-height: 1.35; letter-spacing: -0.005em; }
        
        .badge-group { margin-top: 12px; display: flex; flex-wrap: wrap; gap: 6px; }
        .g-badge { display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 8px; background: var(--paper); border: 1px solid var(--line); font-size: .78rem; font-weight: 700; color: var(--steel); }
        .g-badge i { color: #2f9e5c; }
        .g-badge.plat i { color: var(--blue); }

        .gallery-empty { grid-column: 1 / -1; text-align: center; padding: 56px 24px; border: 1.5px dashed var(--line); border-radius: var(--r-md); background: #fff; color: var(--steel); }
        .gallery-empty i { font-size: 2rem; color: #b8c3d0; margin-bottom: 12px; }
        .gallery-empty h3 { font-family: var(--font-display); font-size: 1.15rem; color: var(--ink); }
        .gallery-empty p { margin-top: 4px; font-size: .92rem; }

        .search-empty { display: none; grid-column: 1 / -1; text-align: center; padding: 40px 24px; color: var(--steel); }

        @media (max-width: 640px) {
            .pos-info { flex-direction: column; align-items: flex-start; }
            .btn-maps { width: 100%; justify-content: center; }
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
            
            <!-- UPDATE MENU SAPRA (HEADER) -->
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan &amp; fasilitas <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
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
                <li><span aria-current="page">Sarana pemadam</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Informasi layanan</h1>
        <p class="rise d2">Galeri publik transparansi armada dan kelengkapan pemadam di tiap pos.</p>
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
                                    <!-- URL SIDEBAR SUDAH DIPERBAIKI -->
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

            <!-- Data pemeriksaan -->
            <section class="data-col" aria-label="Galeri sarana pemeriksaan">

                <div class="data-head">
                    <div>
                        <h2>Sarana pemadam kebakaran</h2>
                        <p>Galeri publik transparansi armada dan kelengkapan pemadam di tiap pos.</p>
                    </div>
                    <label class="search">
                        <span class="sr-only">Cari nama armada / sarana</span>
                        <i class="fas fa-search"></i>
                        <input type="search" id="searchInput" placeholder="Cari nama armada / sarana" autocomplete="off">
                    </label>
                </div>

                <?php if (count($posPemadam)): ?>
                <div class="pos-tabs" role="tablist" aria-label="Pos pemadam">
                    <?php foreach ($posPemadam as $i => $pos): $pos = $arr($pos); ?>
                        <button type="button" class="pos-tab" role="tab" data-pos="pos-<?= $h($pos['id_pos'] ?? $i) ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
                            <?= $h(mb_strtoupper($pos['nama_pos'] ?? '')) ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($posPemadam as $i => $pos): $pos = $arr($pos); $posId = 'pos-' . $h($pos['id_pos'] ?? $i);
                    $itemsPos = [];
                    foreach ($dataSarana as $item) {
                        $item = $arr($item);
                        if ((string) ($item['id_pos'] ?? '') === (string) ($pos['id_pos'] ?? '')) { $itemsPos[] = $item; }
                    }
                ?>
                <div class="pos-panel" id="<?= $posId ?>" role="tabpanel" <?php if ($i !== 0): ?> hidden <?php endif; ?>>

                    <div class="pos-info">
                        <div>
                            <h3><i class="fas fa-warehouse"></i> <?= $h($pos['nama_pos'] ?? '') ?></h3>
                            <p><i class="fas fa-map-marker-alt"></i> <?= $h($pos['alamat'] ?? 'Alamat belum tersedia') ?></p>
                        </div>
                        <?php if (!empty($pos['kode_map'])): ?>
                            <a class="btn-maps" href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($pos['kode_map']) ?>" target="_blank" rel="noopener">
                                <i class="fas fa-location-arrow"></i> Lihat di Google Maps
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="gallery">
                        <?php if ($itemsPos): ?>
                            <?php foreach ($itemsPos as $item):
                                $gambarAda = !empty($item['path_gambar']) && $fileExists($item['path_gambar']);
                            ?>
                            <div class="g-card" data-name="<?= $h(mb_strtolower($item['jenis_sarana'] ?? '')) ?>">
                                <div class="g-thumb">
                                    <?php if ($gambarAda): ?>
                                        <a href="<?= $h($assetUrl($item['path_gambar'])) ?>" target="_blank" rel="noopener">
                                            <img src="<?= $h($assetUrl($item['path_gambar'])) ?>" alt="<?= $h($item['jenis_sarana'] ?? '') ?>" loading="lazy">
                                        </a>
                                    <?php else: ?>
                                        <i class="far fa-image"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="g-body">
                                    <p class="g-title"><?= $h(mb_strtoupper($item['jenis_sarana'] ?? '')) ?></p>
                                    
                                    <!-- BADGE TAHUN & PLAT NOMOR -->
                                    <div class="badge-group">
                                        <?php if (!empty($item['tahun'])): ?>
                                            <span class="g-badge"><i class="fas fa-calendar-check"></i> Tahun <?= $h($item['tahun']) ?></span>
                                        <?php else: ?>
                                            <span class="g-badge"><i class="fas fa-circle-check"></i> Tersedia</span>
                                        <?php endif; ?>

                                        <?php if (!empty($item['plat_nomor'])): ?>
                                            <span class="g-badge plat"><i class="fas fa-car"></i> <?= $h(mb_strtoupper($item['plat_nomor'])) ?></span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="gallery-empty">
                                <i class="fas fa-box-open"></i>
                                <h3>Data kosong</h3>
                                <p>Belum ada galeri sarana untuk pos ini.</p>
                            </div>
                        <?php endif; ?>
                        <p class="search-empty">Tidak ada alat yang cocok dengan pencarian.</p>
                    </div>

                </div>
                <?php endforeach; ?>

                <?php else: ?>
                <div class="gallery-empty">
                    <i class="fas fa-warehouse"></i>
                    <h3>Belum ada data pos</h3>
                    <p>Data pos pemadam akan tampil di sini setelah ditambahkan.</p>
                </div>
                <?php endif; ?>

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

    /* ---------- Tab pos ---------- */
    var tabs = document.querySelectorAll('.pos-tab');
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) { t.setAttribute('aria-selected', 'false'); });
            document.querySelectorAll('.pos-panel').forEach(function (p) { p.hidden = true; });
            tab.setAttribute('aria-selected', 'true');
            var panel = document.getElementById(tab.dataset.pos);
            if (panel) { panel.hidden = false; }
            var search = document.getElementById('searchInput');
            if (search) { search.value = ''; }
            filterCards('');
        });
    });

    /* ---------- Pencarian galeri ---------- */
    function filterCards(q) {
        q = q.trim().toLowerCase();
        var panel = document.querySelector('.pos-panel:not([hidden])');
        if (!panel) return;
        var cards = panel.querySelectorAll('.g-card');
        var visible = 0;
        cards.forEach(function (c) {
            var hit = c.dataset.name.indexOf(q) !== -1;
            c.hidden = !hit;
            if (hit) visible++;
        });
        var empty = panel.querySelector('.search-empty');
        if (empty) { empty.style.display = (cards.length && !visible) ? 'block' : 'none'; }
    }
    var searchInput = document.getElementById('searchInput');
    if (searchInput) { searchInput.addEventListener('input', function () { filterCards(searchInput.value); }); }
})();
</script>
</body>
</html>