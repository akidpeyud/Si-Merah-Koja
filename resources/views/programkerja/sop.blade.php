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
           HEADER & NAVBAR (Standar SIMERAH KOJA)
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
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active, .menu-trigger.is-active { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after, .menu-trigger.is-active::after { transform: scaleX(1); }
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
        .btn-nav--alert .beacon { width: 8px; height: 8px; background: #fff; border-radius: 50%; }
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
        .dropdown a:hover, .dropdown a:focus-visible { background: rgba(255,255,255,.08); color: #fff; }
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
            .menu-link.is-active, .menu-trigger.is-active { color: var(--amber); }
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
            .page-hero { padding: 26px 0 46px; }
            .crumbs { gap: 6px; margin-bottom: 12px; font-size: .75rem; }
            .page-hero h1 { font-size: clamp(1.55rem, 6.5vw, 2.2rem); line-height: 1.05; }
            .page-hero p { margin-top: 10px; font-size: .86rem; }
            .tabs-wrap { margin-top: -20px; }
            .tab { padding: 7px 12px; font-size: .76rem; }
            .doc-row { grid-template-columns: 40px minmax(0, 1fr); gap: 10px 12px; padding: 12px 14px; align-items: start; }
            .doc-ico { width: 40px; height: 40px; border-radius: 10px; font-size: 1.1rem; }
            .doc-name { font-size: .9rem; }
            .doc-actions { grid-column: 1 / -1; width: 100%; }
            .doc-actions .tool { flex: 1; height: 34px; font-size: .78rem; }
            .sop-cat-btn { flex: 1 1 calc(50% - 6px); justify-content: center; padding: 8px 10px; font-size: .78rem; }
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

<!-- ==================== HEADER ==================== -->
@include('layouts.partials.public-header')

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

        </div>
    </div>
</div>

</main>

@include('layouts.partials.public-footer')

@include('layouts.partials.public-scripts')

<script>
(function () {
    'use strict';

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
