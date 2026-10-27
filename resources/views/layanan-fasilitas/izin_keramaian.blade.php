@php
    /* ------------------------------------------------------------
       PENGATURAN HALAMAN
       ------------------------------------------------------------ */
    $layanan = config('layanan'); // urutan, label & ikon diatur di config/layanan.php
    $tab_aktif = 'keramaian';

    // URL Template Surat Pernyataan Pertanggungjawaban Mutlak / Permohonan
    $url_surat_permohonan = asset('dokumen/FORMULIR-4.pdf');

    // Endpoint cek status permohonan (sesuaikan dengan route di controller Anda)
    $url_cek_status = route('izin-keramaian.cek-status');

    $inv = function ($n) use ($errors) { return (isset($errors) && $errors->has($n)) ? ' is-invalid' : ''; };
    $fe  = function ($n) use ($errors) {
        return (isset($errors) && $errors->has($n))
            ? '<p class="field-err"><i class="fas fa-circle-exclamation"></i> ' . e($errors->first($n)) . '</p>'
            : '';
    };

    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    $play_store_url = "";
    // Diperbarui menjadi selambat-lambatnya 14 hari sebelum kegiatan
    $min_date_keramaian = date('Y-m-d', strtotime('+14 days'));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Ajukan Rekomendasi Pengamanan Event Pemerintah dan Swasta secara daring di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>Izin Keramaian - Layanan | SIMERAH KOJA</title>
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
           HEADER & NAVBAR (Sesuai Index)
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
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active, .menu > li.current > .menu-trigger { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after, .menu > li.current > .menu-trigger::after { transform: scaleX(1); }

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
            .menu > li.current > .menu-trigger { color: var(--amber); }
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
            font-size: clamp(2.4rem, 7vw, 5rem); line-height: .98; letter-spacing: -0.035em;
        }
        .page-hero p { margin-top: 18px; max-width: 60ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }

        /* ==========================================================
           ANIMASI IN & KOLOM RESPONSIF
           ========================================================== */
        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        @keyframes animInUp {
            from { opacity: 0; transform: translateY(32px) scale(0.985); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes animInLeft {
            from { opacity: 0; transform: translateX(-28px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes animSubIn {
            from { opacity: 0; transform: translateX(-14px); }
            to { opacity: 1; transform: translateX(0); }
        }

        [data-anim] {
            opacity: 0;
            will-change: transform, opacity;
        }
        [data-anim="up"].is-inview {
            animation: animInUp .75s cubic-bezier(.16, 1, .3, 1) forwards;
            animation-delay: var(--d, 0s);
        }
        [data-anim="left"].is-inview {
            animation: animInLeft .7s cubic-bezier(.16, 1, .3, 1) forwards;
            animation-delay: var(--d, 0s);
        }
        [data-anim="sub"].is-inview {
            animation: animSubIn .55s cubic-bezier(.16, 1, .3, 1) forwards;
            animation-delay: var(--d, 0s);
        }

        /* BODY LAYOUT */
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

        .c-ico { flex: none; width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: var(--paper); color: var(--signal-d); font-size: 1rem; }

        /* Grid Responsif untuk Facts */
        .facts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
            margin-top: 28px;
        }
        .fact {
            display: flex; align-items: center; gap: 14px; padding: 18px 20px;
            background: #fff; border: 1px solid var(--line); border-radius: var(--r-md);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }
        .fact:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(13, 27, 42, 0.12);
            border-color: #cbd5e1;
        }
        .fact .c-ico { width: 46px; height: 46px; background: #fdeceb; font-size: 1.1rem; }
        .fact small { display: block; font-size: .8rem; color: var(--steel); line-height: 1.3; margin-bottom: 2px; }
        .fact strong, .fact a { display: block; font-weight: 600; font-size: .95rem; line-height: 1.4; }
        .fact a:hover { color: var(--signal-d); text-decoration: underline; text-underline-offset: 4px; }

        /* Grid Responsif 2 Kolom Utama */
        .perizinan-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 24px;
            margin-top: 24px;
            align-items: start;
        }
        @media (min-width: 992px) {
            .perizinan-layout {
                grid-template-columns: minmax(340px, 420px) minmax(0, 1fr);
                gap: 32px;
            }
            /* Kolom kiri sticky, seluruh isi tampil tanpa scroll internal (posisi top diatur JS) */
            .info-stack {
                position: sticky; align-self: start; max-height: none; overflow: visible;
                top: var(--stick-top, calc(var(--header-h) + 16px));
            }
        }
        .info-stack { display: grid; gap: 18px; }
        #formulir { scroll-margin-top: calc(var(--header-h) + 16px); }

        .jump { display: none; align-items: center; justify-content: center; gap: 10px; padding: 13px 20px; border-radius: 999px; background: var(--ink); color: #fff; font-weight: 600; font-size: .92rem; }
        .jump i { color: var(--amber); }
        .jump:hover { background: var(--ink-3); }
        @media (max-width: 991px) { .jump { display: inline-flex; } }

        .side-card {
            background: #fff; border: 1px solid var(--line); border-radius: var(--r-md);
            padding: clamp(20px, 3vw, 28px);
            box-shadow: 0 8px 24px rgba(13, 27, 42, 0.03);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .side-card:hover {
            box-shadow: 0 14px 30px rgba(13, 27, 42, 0.06);
        }
        .card-head { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 18px; }
        .card-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.2rem; line-height: 1.25; letter-spacing: -0.015em; }
        .card-sub { display: block; font-family: var(--font-body); font-size: .78rem; font-weight: 600; color: var(--signal-d); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 3px; }

        /* Styling Persyaratan & Sub-List Administrasi */
        .checklist { display: grid; gap: 18px; }
        .checklist > li {
            display: grid; grid-template-columns: 36px minmax(0, 1fr); gap: 14px; align-items: start;
            font-size: .93rem; line-height: 1.5;
            padding: 14px; border-radius: 14px; background: var(--paper); border: 1px solid var(--line);
        }
        .ck-num {
            width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center;
            background: var(--ink); color: var(--amber); font-family: var(--font-display); font-weight: 800; font-size: .95rem;
        }
        .ck-title { font-weight: 700; color: var(--ink); margin-bottom: 4px; display: block; }
        .ck-highlight {
            display: inline-flex; align-items: center; gap: 6px; margin-top: 6px;
            padding: 4px 10px; border-radius: 8px; background: var(--warn-bg); color: #92400e;
            font-size: .82rem; font-weight: 700;
        }

        .admin-sublist {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 8px;
            margin-top: 10px;
        }
        @media (min-width: 520px) and (max-width: 991px) {
            /* Pada layar tablet, sub-item otomatis menjadi 2 kolom agar responsif dan rapi */
            .admin-sublist { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        .admin-sublist li {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 10px 12px; border-radius: 10px; background: #fff;
            border: 1px solid var(--line); font-size: .875rem; line-height: 1.4;
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        }
        .admin-sublist li:hover {
            transform: translateX(4px);
            border-color: var(--signal);
            box-shadow: 0 4px 12px rgba(229, 57, 45, 0.08);
        }
        .admin-sublist li i {
            color: var(--signal-d); font-size: .9rem; margin-top: 3px; flex: none;
            width: 18px; text-align: center;
        }
        .badge-khusus {
            display: inline-block; margin-top: 3px; padding: 2px 7px; border-radius: 6px;
            background: #fdeceb; color: var(--signal-d); font-size: .72rem; font-weight: 700;
        }

        .checklist .muted { color: var(--steel); }
        .checklist a.inline {
            font-weight: 600; color: var(--signal-d);
            transition: background .2s, color .2s;
        }
        .checklist a.inline:hover {
            background: var(--ink) !important; color: #fff !important; border-color: var(--ink) !important;
        }

        /* FORMULIR & VALIDASI REAL-TIME */
        .form-panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: 0 10px 30px rgba(13, 27, 42, 0.03); }
        .form-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; padding: 18px clamp(18px, 3vw, 32px); border-bottom: 1px solid var(--line); }
        .form-title { display: flex; align-items: center; gap: 14px; min-width: 0; }
        .form-title > i { flex: none; width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: var(--ink); color: var(--amber); font-size: 1.05rem; }
        .form-title h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.3rem; line-height: 1.2; letter-spacing: -0.015em; }
        .form-title p { font-size: .85rem; color: var(--steel); line-height: 1.4; margin-top: 2px; }
        .form-note { padding: 6px 14px; border-radius: 999px; background: var(--paper); font-size: .85rem; font-weight: 600; color: var(--steel); }

        .form-body { padding: clamp(18px, 3vw, 32px); display: grid; gap: 36px; }
        .alert { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; border-radius: 14px; font-size: .92rem; line-height: 1.5; }
        .alert i { margin-top: 3px; flex: none; }
        .alert.err { background: #fdeceb; color: #8f1d15; border: 1px solid #f5c3bf; }
        .alert.ok { background: #e8f7ee; color: #14532d; border: 1px solid #bce5cb; }
        .alert ul { display: grid; gap: 2px; margin-top: 4px; padding-left: 18px; list-style: disc; }

        .fs { border: 0; min-width: 0; }
        .fs legend { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding: 0; width: 100%; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; letter-spacing: -0.01em; }
        .fs legend::after { content: ""; flex: 1; height: 1px; background: var(--line); }
        .fs legend i { width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: #fdeceb; color: var(--signal-d); font-size: .85rem; }

        .fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 20px; }
        .field { min-width: 0; display: flex; flex-direction: column; }
        .field.full { grid-column: 1 / -1; }
        @media (max-width: 768px) { .fields { grid-template-columns: minmax(0, 1fr); } }

        .label { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px; font-size: .9rem; font-weight: 600; line-height: 1.35; color: var(--ink); }
        .req { color: var(--signal-d); margin-left: 2px; }
        .hint { margin-top: 6px; font-size: .8rem; color: var(--steel); line-height: 1.4; }
        .field-err { margin-top: 6px; display: flex; gap: 8px; align-items: flex-start; font-size: .82rem; font-weight: 500; line-height: 1.4; color: var(--signal-d); }
        .field-err i { margin-top: 2px; flex: none; }
        .field-err:empty { display: none; }

        .input {
            display: block; width: 100%; height: 48px; padding: 0 16px;
            border: 1px solid var(--line); border-radius: 14px; background: #fff;
            font: inherit; font-size: .95rem; color: var(--ink);
            transition: border-color .2s, box-shadow .2s;
        }
        .input::placeholder { color: #93a1b1; }
        .input:hover:not(:disabled) { border-color: #b8c3d0; }
        .input:focus { outline: none; border-color: var(--ink); box-shadow: 0 0 0 3px rgba(255,182,39,.5); }
        .input:user-invalid, .input.is-invalid { border-color: var(--signal); }
        .input.is-valid { border-color: var(--ok); }
        .input.is-valid:focus { border-color: var(--ok); box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.25); }
        .input.is-low, .input.is-low:hover, .input.is-low:focus { border-color: var(--signal); box-shadow: 0 0 0 3px rgba(229,57,45,.18); }
        .hint.is-low { color: var(--signal-d); font-weight: 600; }

        /* BADGE & STATUS VALIDASI REAL-TIME */
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
            .input { font-size: 16px; }
        }

        .unit { position: relative; }
        .unit .input { padding-right: 54px; }
        .unit span { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: .88rem; font-weight: 600; color: var(--steel); pointer-events: none; }

        /* DROPZONE & PRATINJAU GAMBAR */
        .dropzone {
            position: relative; display: grid; justify-items: center; gap: 10px; text-align: center;
            padding: 26px 20px; border: 2px dashed #b8c3d0; border-radius: var(--r-md);
            background: var(--paper); color: var(--steel); font-size: .92rem; line-height: 1.45;
            cursor: pointer; transition: border-color .2s, background .2s, box-shadow .2s;
        }
        .dropzone:hover, .dropzone.is-over { border-color: var(--signal); background: #fdeceb; }
        .dropzone:focus-within { outline: 3px solid var(--amber); outline-offset: 3px; }
        .dropzone.has-files { border-style: solid; border-color: var(--ink); background: #fff; cursor: default; }
        .dropzone.is-invalid, .dropzone[data-srv="1"] { border-color: var(--signal); background: #fff5f5; }
        .dropzone input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 1; }
        .dropzone.has-files input[type="file"] { pointer-events: none; }

        .dz-prompt { display: grid; justify-items: center; gap: 8px; transition: opacity .2s; }
        .dropzone.has-files .dz-prompt { display: none; }
        .dz-ico { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line); color: var(--signal-d); font-size: 1.2rem; box-shadow: 0 4px 10px rgba(0,0,0,.04); }
        .dz-text strong { color: var(--ink); }
        .dz-text u { text-underline-offset: 3px; color: var(--signal-d); font-weight: 600; }

        .dz-preview {
            display: none; width: 100%; flex-direction: column; align-items: center; gap: 12px;
            z-index: 2; position: relative; animation: fadeInPreview .25s ease;
        }
        .dropzone.has-files .dz-preview { display: flex; }
        @keyframes fadeInPreview { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }

        .dz-img-wrap {
            position: relative; width: 100%; max-width: 420px; aspect-ratio: 16 / 10; max-height: 240px;
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
            width: 100%; padding: 10px 14px; border-radius: 12px; background: var(--paper); border: 1px solid var(--line);
        }
        .dz-files { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; min-width: 0; flex: 1; }
        .dz-files:empty { display: none; }
        .dz-files li {
            display: inline-flex; align-items: center; gap: 7px; padding: 4px 10px; border-radius: 999px;
            background: #fff; border: 1px solid var(--line); font-size: .82rem; font-weight: 600; color: var(--ink);
            overflow-wrap: anywhere;
        }
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
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 30px; border-radius: 999px; font-weight: 700; font-size: 1rem; transition: background .2s, box-shadow .2s, transform .15s; cursor: pointer; border: none; }
        .btn:active:not(:disabled) { transform: scale(.98); }
        .btn-primary { background: var(--signal); color: #fff; box-shadow: 0 14px 30px -10px rgba(229,57,45,.6); }
        .btn-primary:hover:not(:disabled) { background: var(--signal-d); }
        .btn-primary:disabled { background: #fca5a5; cursor: not-allowed; box-shadow: none; }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--ink-3); }
        .form-actions p { font-size: .88rem; color: var(--steel); }
        @media (max-width: 640px) { .form-actions .btn { width: 100%; } }

        .toast {
            position: fixed; z-index: 80; left: 50%; top: calc(var(--header-h) + 16px);
            transform: translateX(-50%); width: max-content; max-width: calc(100vw - 28px);
            display: flex; align-items: center; gap: 14px; padding: 12px 12px 12px 14px;
            background: #fff; border: 1px solid var(--line); border-radius: 999px;
            box-shadow: 0 18px 36px -12px rgba(13,27,42,.45); font-weight: 600; font-size: .93rem; line-height: 1.4;
            animation: toastIn .5s cubic-bezier(.16,.84,.3,1) both;
        }
        .toast.leaving { animation: toastOut .35s ease forwards; }
        .toast-ico { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: #16a34a; color: #fff; font-size: .8rem; }
        .toast-x { flex: none; width: 32px; height: 32px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); font-size: .8rem; transition: background .2s, color .2s; }
        .toast-x:hover { background: var(--ink); color: #fff; }
        @keyframes toastIn { from { opacity: 0; transform: translate(-50%, -16px); } to { opacity: 1; transform: translate(-50%, 0); } }
        @keyframes toastOut { from { opacity: 1; transform: translate(-50%, 0); } to { opacity: 0; transform: translate(-50%, -16px); } }

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
        .social { display: flex; flex-wrap: wrap; gap: 8px; }
        .social a { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: rgba(255,255,255,.08); color: #fff; transition: background .2s, transform .2s; }
        .social a:hover { background: var(--signal); transform: translateY(-3px); }
        @media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr; } }

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

        /* ---------- Cek status permohonan ---------- */
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
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



        /* Kolom kiri lebih ringkas agar seluruh isi terbaca tanpa scroll */
        .info-stack { gap: 16px; }
        .info-stack .side-card { padding: clamp(16px, 2.4vw, 22px); }
        .info-stack .card-head { margin-bottom: 14px; }
        .info-stack .card-head h2 { font-size: 1.08rem; }
        .info-stack .checklist { gap: 12px; }
        .info-stack .checklist > li { grid-template-columns: 32px minmax(0, 1fr); gap: 12px; padding: 12px; font-size: .9rem; }
        .info-stack .ck-num { width: 32px; height: 32px; font-size: .88rem; }
        .info-stack .admin-sublist { gap: 6px; margin-top: 8px; }
        .info-stack .admin-sublist li { padding: 8px 10px; font-size: .84rem; }

        /* ==========================================================
           TAMBAHAN: KOLOM RESPONSIF, ANIMASI MASUK PER KOLOM, UNGGAH BERKAS
           ========================================================== */
        .time-range { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
        .time-range .input { flex: 1 1 120px; min-width: 0; }
        .time-range > span { font-size: .9rem; color: var(--steel); font-weight: 600; }

        .input-select {
            appearance: none; -webkit-appearance: none; cursor: pointer; padding-right: 44px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235b6c7f' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 16px center;
            text-overflow: ellipsis;
        }

        /* Judul bagian & setiap kolom muncul bergantian saat bagian terlihat di layar */
        .fs[data-anim] { opacity: 1; will-change: auto; }
        .fs[data-anim].is-inview { animation: none; }
        .fs[data-anim] > legend, .fs[data-anim] .field { opacity: 0; }
        .fs.is-inview > legend { animation: animInLeft .55s cubic-bezier(.16, 1, .3, 1) both; }
        .fs.is-inview .field {
            animation: animInUp .65s cubic-bezier(.16, 1, .3, 1) both;
            animation-delay: calc(.1s + var(--i, 0) * .07s);
        }

        .alert-warn { background: #fff8e6; color: #9c6500; border: 1px solid #ffe58f; margin-bottom: 20px; }
        .alert-link { display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; font-weight: 700; color: #b77900; text-decoration: underline; text-underline-offset: 3px; }
        .alert-link:hover { color: #7a5200; }

        .upl-summary { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 16px; margin-bottom: 18px; font-size: .88rem; font-weight: 600; color: var(--steel); }
        .upl-bar { flex: 1 1 140px; height: 8px; border-radius: 999px; background: var(--line); overflow: hidden; }
        .upl-bar i { display: block; height: 100%; width: 0; border-radius: inherit; background: linear-gradient(90deg, var(--amber), var(--ok)); transition: width .5s cubic-bezier(.16, 1, .3, 1); }

        /* Kolom unggah berkas: otomatis 1 / 2 kolom sesuai lebar panel */
        .upload-grid { display: grid; grid-template-columns: minmax(0, 1fr); gap: 18px; }
        .upload-card { min-width: 0; display: flex; flex-direction: column; }
        .upload-card .label { align-items: flex-start; flex-wrap: wrap; }
        .upload-card { padding: 16px clamp(14px, 2.5vw, 20px) 14px; border: 1px solid var(--line); border-radius: var(--r-md); background: #fff; }
        .upload-card .dropzone { align-content: center; padding: 20px 16px; }
        .upload-card .dz-img-wrap { aspect-ratio: 16 / 9; max-height: 200px; }
        @media (min-width: 640px) {
            .upload-card .dropzone:not(.has-files) { grid-auto-flow: column; justify-content: center; align-items: center; gap: 16px; }
            .upload-card .dz-prompt { grid-auto-flow: column; justify-items: start; align-items: center; gap: 14px; text-align: left; }
        }
        .dz-img-wrap[hidden] { display: none; }
        .upload-card .badge-khusus { margin-top: 0; }
        .upload-card.is-off .dropzone, .upload-card.is-off .hint { opacity: .5; }
        .upload-card.is-off .dropzone { pointer-events: none; background: #eef1f5; border-style: dotted; }
        .upload-card .dropzone.has-files { border-color: var(--ok); animation: dzOk .45s ease; }
        @keyframes dzOk { 0% { box-shadow: 0 0 0 0 rgba(22,163,74,.45); } 100% { box-shadow: 0 0 0 14px rgba(22,163,74,0); } }

        .dz-files li { animation: fadeInPreview .3s ease both; }
        .cs-item { animation: animInUp .5s cubic-bezier(.16, 1, .3, 1) both; animation-delay: calc(var(--i, 0) * .08s); }
        .btn .spin { animation: spin .8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 520px) {
            .form-body { gap: 28px; }
            .fs legend { font-size: 1.05rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
            [data-anim], .fs[data-anim] > legend, .fs[data-anim] .field { opacity: 1 !important; transform: none !important; }
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="toast" id="toast" role="status">
        <span class="toast-ico"><i class="fas fa-check"></i></span>
        <span>{{ session('success') }}</span>
        <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
    </div>
@endif

<!-- ==================== HEADER ==================== -->
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <div class="brand">
            <a href="/" aria-label="SIMERAH KOJA, beranda">
                <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            </a>
            <a href="/" title="Beranda">
                <img src="/images/logo.png" alt="Logo Damkar">
            </a>
            <a href="javascript:void(0)" aria-label="Logo Redkar" style="pointer-events: none; cursor: default;">
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </a>
        </div>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navPanel">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-panel" id="navPanel">
            <!-- ===== Menu utama ===== -->
            <ul class="menu">
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

                <li class="has-drop current">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        @include('layouts.partials.layanan-dropdown')
                    </ul>
                </li>

                <li><a class="menu-link {{ request()->is('public-sigap*') ? 'is-active' : '' }}" href="/public-sigap">Sigapkar</a></li>

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

<!-- ==================== HERO HALAMAN ==================== -->
<section class="page-hero">
    <div class="wrap">
        <nav aria-label="Breadcrumb" class="rise">
            <ol class="crumbs">
                <li><a href="/">Beranda</a></li>
                <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan</a></li>
                <li><span aria-current="page">{{ $layanan[$tab_aktif]['label'] }}</span></li>
            </ol>
        </nav>
        <h1 class="rise d1">Rekomendasi Pengamanan Event</h1>
        <p class="rise d2">Ajukan Rekomendasi Pengamanan Event Pemerintah dan Swasta secara daring ke Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
    </div>
    @include('layouts.partials.hero-logos', ['float' => true])
</section>

<div class="page-body">
    <div class="wrap tabs-wrap">
        @include('layouts.partials.layanan-tabs')
    </div>

    <div class="wrap">

        <!-- Baris Info Singkat dengan Animasi Masuk -->
        <div class="facts">
            <div class="fact" data-anim="up" style="--d: .05s">
                <span class="c-ico"><i class="fas fa-clock"></i></span>
                <div>
                    <small>Batas Pengajuan</small>
                    <strong>Selambat-lambatnya 14 Hari (H-14) Sebelum Kegiatan</strong>
                </div>
            </div>
            <div class="fact" data-anim="up" style="--d: .15s">
                <span class="c-ico"><i class="fas fa-file-circle-check"></i></span>
                <div>
                    <small>Produk layanan</small>
                    <strong>Rekomendasi Pengamanan Event Pemerintah &amp; Swasta</strong>
                </div>
            </div>
            <div class="fact" data-anim="up" style="--d: .25s">
                <span class="c-ico"><i class="fab fa-whatsapp"></i></span>
                <div>
                    <small>Pengaduan layanan</small>
                    <a href="https://wa.me/{{ $no_whatsapp }}" target="_blank" rel="noopener">WhatsApp +62 8117113113</a>
                </div>
            </div>
        </div>

        <div class="perizinan-layout">

            <!-- Kolom Kiri: Persyaratan & Cek Status -->
            <aside class="info-stack" aria-label="Informasi layanan">
                <a class="jump" href="#formulir" data-anim="up" style="--d: .1s"><i class="fas fa-arrow-down"></i> Langsung ke formulir</a>

                <section class="side-card" data-anim="left" style="--d: .15s">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-clipboard-check"></i></span>
                        <div>
                            <span class="card-sub">Ketentuan Layanan</span>
                            <h2>Persyaratan Rekomendasi Pengamanan Event Pemerintah dan Swasta</h2>
                        </div>
                    </div>

                    <ol class="checklist">
                        <!-- Poin 1 -->
                        <li data-anim="up" style="--d: .22s">
                            <span class="ck-num">1</span>
                            <div>
                                <span class="ck-title">Batas Waktu Permohonan</span>
                                Menyampaikan surat permohonan selambat-lambatnya <strong>14 hari sebelum kegiatan</strong> dilaksanakan.
                                <span class="ck-highlight"><i class="fas fa-calendar-day"></i> Wajib H-14 Sebelum Acara</span>
                            </div>
                        </li>

                        <!-- Poin 2 beserta rincian administrasi -->
                        <li data-anim="up" style="--d: .32s">
                            <span class="ck-num">2</span>
                            <div>
                                <span class="ck-title">Persyaratan Administrasi</span>
                                Melampirkan kelengkapan persyaratan administrasi berikut:

                                <ul class="admin-sublist">
                                    <li data-anim="sub" style="--d: .38s">
                                        <i class="fas fa-envelope-open-text"></i>
                                        <span>Surat permohonan</span>
                                    </li>
                                    <li data-anim="sub" style="--d: .44s">
                                        <i class="fas fa-id-card"></i>
                                        <span>Fotokopi KTP penanggung jawab kegiatan</span>
                                    </li>
                                    <li data-anim="sub" style="--d: .50s">
                                        <i class="fas fa-map-location-dot"></i>
                                        <span>Sket denah lokasi (beserta posisi <strong>genset</strong>)</span>
                                    </li>
                                    <li data-anim="sub" style="--d: .56s">
                                        <i class="fas fa-receipt"></i>
                                        <div>
                                            <span>Bukti pembayaran pajak dari BPPRD</span>
                                            <br><span class="badge-khusus">Khusus Event Hiburan</span>
                                        </div>
                                    </li>
                                    <li data-anim="sub" style="--d: .62s">
                                        <i class="fas fa-file-signature"></i>
                                        <div>
                                            <span>Surat pernyataan pertanggungjawaban mutlak</span>
                                            <br>
                                            <a class="inline" href="{{ $url_surat_permohonan }}" download style="display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; font-size: 0.8rem; background: var(--paper); padding: 5px 10px; border-radius: 6px; border: 1px solid var(--line);">
                                                <i class="fas fa-download"></i> Unduh Format Surat
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ol>
                </section>

                <!-- Cek status permohonan -->
                <section class="side-card" id="cek-status" aria-label="Cek status permohonan" data-anim="left" style="--d: .3s">
                    <div class="card-head">
                        <span class="c-ico"><i class="fas fa-magnifying-glass"></i></span>
                        <h2>Cek Status Permohonan</h2>
                    </div>
                    <p class="cs-desc">Masukkan NIK atau No HP/WA yang Anda gunakan saat mengajukan permohonan.</p>

                    <form class="cs-form" id="csForm" data-no-loader="true" novalidate>
                        <label class="sr-only" for="csKontak">NIK atau No Kontak / WhatsApp</label>
                        <input class="input" type="text" id="csKontak" name="kontak" inputmode="numeric" maxlength="16" autocomplete="off" placeholder="NIK atau Nomor WA" required>
                        <button type="submit" class="btn btn-dark cs-btn" id="csBtn"><i class="fas fa-search"></i> Cek</button>
                    </form>

                    <p class="field-err" id="csErr" role="alert"></p>
                    <ul class="cs-list" id="csList" aria-live="polite"></ul>
                </section>

            </aside>

            <!-- Kolom Kanan: Formulir -->
            <section class="form-panel" id="formulir" aria-label="Formulir permohonan" data-anim="up" style="--d: .2s">
                <div class="form-bar">
                    <div class="form-title">
                        <i class="fas fa-file-pen"></i>
                        <div>
                            <h2>Formulir Rekomendasi Pengamanan Event</h2>
                            <p>Pengajuan Rekomendasi Pengamanan Event Pemerintah dan Swasta</p>
                        </div>
                    </div>
                    <span class="form-note"><span class="req" aria-hidden="true">*</span> wajib diisi</span>
                </div>

                <form class="form-body" action="{{ route('izin-keramaian.store') }}" method="POST" enctype="multipart/form-data" id="form_keramaian">
                    @csrf

                    @if($errors->any())
                        <div class="alert err" role="alert">
                            <i class="fas fa-triangle-exclamation"></i>
                            <div>
                                Permohonan belum terkirim. Mohon periksa kembali form Anda:
                                <ul>
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="alert" style="background: #eef2f6; color: var(--ink-3); border: 1px solid var(--line); --d: .25s;" role="alert" data-anim="up">
                        <i class="fas fa-info-circle"></i>
                        <div><strong>Perhatian:</strong> Penyampaian surat permohonan rekomendasi pengamanan event dilakukan <strong>selambat-lambatnya 14 hari sebelum kegiatan</strong> dilaksanakan.</div>
                    </div>

                    <fieldset class="fs" data-anim="up" style="--d: .3s">
                        <legend><i class="fas fa-user"></i> 1. Data Pemohon</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama"><span>Nama <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('nama') }}" type="text" id="nama" name="nama" value="{{ old('nama') }}" autocomplete="name" required>
                                {!! $fe('nama') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="nik">
                                    <span>NIK <span class="req" aria-hidden="true">*</span></span>
                                    <span class="pw-badge" id="nik_badge">0/16</span>
                                </label>
                                <input class="input{{ $inv('nik') }}" type="text" id="nik" name="nik" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 digit NIK" required>
                                <p class="pw-status" id="nik_msg" aria-live="polite"></p>
                                {!! $fe('nik') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="no_hp">
                                    <span>No HP/WA <span class="req" aria-hidden="true">*</span></span>
                                    <span class="pw-badge" id="wa_badge"></span>
                                </label>
                                <input class="input{{ $inv('no_hp') }}" type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" inputmode="tel" maxlength="14" autocomplete="tel" placeholder="Contoh: 081234567890" required>
                                <p class="pw-status" id="wa_msg" aria-live="polite"></p>
                                {!! $fe('no_hp') !!}
                            </div>
                            <div class="field full">
                                <label class="label" for="alamat"><span>Alamat Lengkap <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('alamat') }}" type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" autocomplete="street-address" required>
                                {!! $fe('alamat') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs" data-anim="up" style="--d: .35s">
                        <legend><i class="fas fa-briefcase"></i> 2. Data Usaha / Instansi</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_direktur"><span>Nama Penanggung Jawab / Direktur <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('nama_direktur') }}" type="text" id="nama_direktur" name="nama_direktur" value="{{ old('nama_direktur') }}" required>
                                {!! $fe('nama_direktur') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="nama_usaha"><span>Nama Usaha / Instansi (Pemerintah/Swasta) <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('nama_usaha') }}" type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" required>
                                {!! $fe('nama_usaha') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="no_izin_usaha"><span>No. Izin Usaha / Surat Tugas <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('no_izin_usaha') }}" type="text" id="no_izin_usaha" name="no_izin_usaha" value="{{ old('no_izin_usaha') }}" required>
                                {!! $fe('no_izin_usaha') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs" data-anim="up" style="--d: .4s">
                        <legend><i class="fas fa-map-marker-alt"></i> 3. Data Lokasi Acara</legend>
                        <div class="fields">
                            <div class="field full">
                                <label class="label" for="nama_acara"><span>Nama Acara <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('nama_acara') }}" type="text" id="nama_acara" name="nama_acara" value="{{ old('nama_acara') }}" required>
                                {!! $fe('nama_acara') !!}
                            </div>
                            <div class="field full">
                                <label class="label" for="jenis_event"><span>Jenis Event <span class="req" aria-hidden="true">*</span></span></label>
                                <select class="input input-select{{ $inv('jenis_event') }}" id="jenis_event" name="jenis_event" required aria-describedby="hint-jenis">
                                    <option value="" disabled {{ old('jenis_event') ? '' : 'selected' }}>Pilih jenis event</option>
                                    <option value="hiburan" {{ old('jenis_event') === 'hiburan' ? 'selected' : '' }}>Event Hiburan (konser, pentas seni, dsb.)</option>
                                    <option value="non_hiburan" {{ old('jenis_event') === 'non_hiburan' ? 'selected' : '' }}>Non-Hiburan (rapat akbar, bazar, olahraga, keagamaan, dsb.)</option>
                                </select>
                                <p class="hint" id="hint-jenis"><i class="fas fa-circle-info"></i> Event hiburan wajib melampirkan bukti pembayaran pajak dari BPPRD.</p>
                                {!! $fe('jenis_event') !!}
                            </div>
                            <div class="field full">
                                <label class="label" for="lokasi_acara"><span>Lokasi Acara <span class="req" aria-hidden="true">*</span></span></label>
                                <input class="input{{ $inv('lokasi_acara') }}" type="text" id="lokasi_acara" name="lokasi_acara" value="{{ old('lokasi_acara') }}" required>
                                {!! $fe('lokasi_acara') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="tgl_pelaksanaan">
                                    <span>Tgl. Pelaksanaan <span class="req" aria-hidden="true">*</span></span>
                                    <span class="pw-badge" id="tgl_badge"></span>
                                </label>
                                <input class="input{{ $inv('tgl_pelaksanaan') }}" type="date" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{ old('tgl_pelaksanaan') }}" min="{{ $min_date_keramaian }}" required>
                                <p class="pw-status" id="tgl_msg" aria-live="polite"></p>
                                {!! $fe('tgl_pelaksanaan') !!}
                            </div>
                            <div class="field">
                                <label class="label"><span>Waktu Pelaksanaan <span class="req" aria-hidden="true">*</span></span></label>
                                <div class="time-range">
                                    <input class="input{{ $inv('waktu_mulai') }}" type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required style="flex:1;">
                                    <span style="font-size: .9rem; color: var(--steel); font-weight: 600;">s/d</span>
                                    <input class="input{{ $inv('waktu_selesai') }}" type="time" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required style="flex:1;">
                                </div>
                                {!! $fe('waktu_mulai') !!}
                                {!! $fe('waktu_selesai') !!}
                            </div>
                            <div class="field full">
                                <label class="label" for="jumlah_penonton"><span>Jumlah Estimasi Penonton <span class="req" aria-hidden="true">*</span></span></label>
                                <div class="unit">
                                    <input class="input{{ $inv('jumlah_penonton') }}" type="number" id="jumlah_penonton" name="jumlah_penonton" value="{{ old('jumlah_penonton') }}" min="1" required>
                                    <span aria-hidden="true">Orang</span>
                                </div>
                                {!! $fe('jumlah_penonton') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs" data-anim="up" style="--d: .45s">
                        <legend><i class="fas fa-fire-extinguisher"></i> 4. Data Peralatan Pemadam Kebakaran yang Dimiliki</legend>
                        <div class="fields">
                            <div class="field">
                                <label class="label" for="jumlah_apar">
                                    <span>APAR <span class="req" aria-hidden="true">*</span></span>
                                    <span class="pw-badge" id="apar_badge"></span>
                                </label>
                                <div class="unit">
                                    <input class="input{{ $inv('jumlah_apar') }}" type="number" id="jumlah_apar" name="jumlah_apar"
                                           value="{{ old('jumlah_apar', 0) }}" min="0" step="1" inputmode="numeric" required
                                           data-min="8" data-pesan="Jumlah APAR minimal 8 buah"
                                           aria-describedby="hint-apar">
                                    <span aria-hidden="true">Buah</span>
                                </div>
                                <p class="pw-status" id="apar_msg" aria-live="polite"></p>
                                <p class="hint" id="hint-apar"><i class="fas fa-circle-info"></i> Jumlah APAR minimal <strong>8 buah</strong></p>
                                {!! $fe('jumlah_apar') !!}
                            </div>
                            <div class="field">
                                <label class="label" for="jumlah_staff">
                                    <span>Staff Terlatih (Bisa menggunakan APAR) <span class="req" aria-hidden="true">*</span></span>
                                    <span class="pw-badge" id="staff_badge"></span>
                                </label>
                                <div class="unit">
                                    <input class="input{{ $inv('jumlah_staff') }}" type="number" id="jumlah_staff" name="jumlah_staff"
                                           value="{{ old('jumlah_staff', 0) }}" min="0" step="1" inputmode="numeric" required
                                           data-min="4" data-pesan="Staff terlatih minimal 4 orang"
                                           aria-describedby="hint-staff">
                                    <span aria-hidden="true">Orang</span>
                                </div>
                                <p class="pw-status" id="staff_msg" aria-live="polite"></p>
                                <p class="hint" id="hint-staff"><i class="fas fa-circle-info"></i> Staff terlatih minimal <strong>4 orang</strong></p>
                                {!! $fe('jumlah_staff') !!}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fs" data-anim="up" style="--d: .5s">
                        <legend><i class="fas fa-file-signature"></i> 5. Berkas Persyaratan Administrasi</legend>

                        <div class="alert alert-warn" role="note">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Lampirkan seluruh persyaratan administrasi</strong> berikut: surat permohonan, fotokopi KTP penanggung jawab kegiatan, sket denah lokasi (genset), bukti pembayaran pajak dari BPPRD (khusus event hiburan), dan surat pernyataan pertanggungjawaban mutlak.
                                <br>
                                <a class="alert-link" href="{{ $url_surat_permohonan }}" download>
                                    <i class="fas fa-download"></i> Unduh format Surat Pernyataan Pertanggungjawaban Mutlak
                                </a>
                            </div>
                        </div>

                        <div class="upl-summary" aria-live="polite">
                            <span id="uplCount">0 dari 4 berkas terunggah</span>
                            <span class="upl-bar" aria-hidden="true"><i id="uplBar"></i></span>
                        </div>

                        <div class="upload-grid">
                            <div class="upload-card" data-anim="up" style="--d: .05s">
                                <span class="label" id="lbl-surat_permohonan"><span>Surat Permohonan <span class="req" aria-hidden="true">*</span></span></span>
                                <div class="dropzone{{ $inv('surat_permohonan') }}" data-dropzone data-max="5" data-ext="pdf,jpg,jpeg,png">
                                    <input type="file" id="surat_permohonan" name="surat_permohonan" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required aria-labelledby="lbl-surat_permohonan">

                                    <div class="dz-prompt">
                                        <span class="dz-ico"><i class="fas fa-envelope-open-text"></i></span>
                                        <span class="dz-text"><strong>Tarik surat permohonan ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    </div>

                                    <div class="dz-preview">
                                        <div class="dz-img-wrap" hidden>
                                            <span class="dz-badge-ok"><i class="fas fa-circle-check"></i> Siap Diunggah</span>
                                            <img alt="Pratinjau Surat Permohonan" data-dz-img>
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
                                <p class="hint">Surat permohonan resmi yang ditujukan kepada Kepala Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi. PDF, JPG, atau PNG (maks. 5 MB).</p>
                                
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('surat_permohonan') !!}
                            </div>
                            <div class="upload-card" data-anim="up" style="--d: .12s">
                                <span class="label" id="lbl-fotokopi_ktp"><span>Fotokopi KTP Penanggung Jawab Kegiatan <span class="req" aria-hidden="true">*</span></span></span>
                                <div class="dropzone{{ $inv('fotokopi_ktp') }}" data-dropzone data-max="5" data-ext="pdf,jpg,jpeg,png">
                                    <input type="file" id="fotokopi_ktp" name="fotokopi_ktp" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required aria-labelledby="lbl-fotokopi_ktp">

                                    <div class="dz-prompt">
                                        <span class="dz-ico"><i class="fas fa-id-card"></i></span>
                                        <span class="dz-text"><strong>Tarik fotokopi KTP ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    </div>

                                    <div class="dz-preview">
                                        <div class="dz-img-wrap" hidden>
                                            <span class="dz-badge-ok"><i class="fas fa-circle-check"></i> Siap Diunggah</span>
                                            <img alt="Pratinjau Fotokopi KTP Penanggung Jawab Kegiatan" data-dz-img>
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
                                <p class="hint">KTP penanggung jawab harus terbaca jelas dan masih berlaku. PDF, JPG, atau PNG (maks. 5 MB).</p>
                                
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('fotokopi_ktp') !!}
                            </div>
                            <div class="upload-card" data-anim="up" style="--d: .19s">
                                <span class="label" id="lbl-foto_jalur_evakuasi"><span>Sket Denah Lokasi (Posisi Genset) <span class="req" aria-hidden="true">*</span></span></span>
                                <div class="dropzone{{ $inv('foto_jalur_evakuasi') }}" data-dropzone data-max="5" data-ext="jpg,jpeg,png,pdf">
                                    <input type="file" id="foto_jalur_evakuasi" name="foto_jalur_evakuasi" accept="image/jpeg,image/png,application/pdf,.jpg,.jpeg,.png,.pdf" required aria-labelledby="lbl-foto_jalur_evakuasi">

                                    <div class="dz-prompt">
                                        <span class="dz-ico"><i class="fas fa-map-location-dot"></i></span>
                                        <span class="dz-text"><strong>Tarik sket denah lokasi ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    </div>

                                    <div class="dz-preview">
                                        <div class="dz-img-wrap" hidden>
                                            <span class="dz-badge-ok"><i class="fas fa-circle-check"></i> Siap Diunggah</span>
                                            <img alt="Pratinjau Sket Denah Lokasi (Posisi Genset)" data-dz-img>
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
                                <p class="hint">Denah memuat titik penempatan genset dan jalur evakuasi. PDF, JPG, atau PNG (maks. 5 MB).</p>
                                
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('foto_jalur_evakuasi') !!}
                            </div>
                            <div class="upload-card is-off" id="card_pajak" data-anim="up" style="--d: .26s">
                                <span class="label" id="lbl-bukti_pajak_bpprd"><span>Bukti Pembayaran Pajak dari BPPRD</span><span class="badge-khusus">Khusus Event Hiburan</span></span>
                                <div class="dropzone{{ $inv('bukti_pajak_bpprd') }}" data-dropzone data-max="5" data-ext="pdf,jpg,jpeg,png">
                                    <input type="file" id="bukti_pajak_bpprd" name="bukti_pajak_bpprd" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" aria-labelledby="lbl-bukti_pajak_bpprd">

                                    <div class="dz-prompt">
                                        <span class="dz-ico"><i class="fas fa-receipt"></i></span>
                                        <span class="dz-text"><strong>Tarik bukti pembayaran pajak ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    </div>

                                    <div class="dz-preview">
                                        <div class="dz-img-wrap" hidden>
                                            <span class="dz-badge-ok"><i class="fas fa-circle-check"></i> Siap Diunggah</span>
                                            <img alt="Pratinjau Bukti Pembayaran Pajak dari BPPRD" data-dz-img>
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
                                <p class="hint">Bukti pembayaran pajak hiburan dari BPPRD Kota Jambi. PDF, JPG, atau PNG (maks. 5 MB).</p>
                                <p class="pw-status show warn" id="pajak_state" aria-live="polite"><i class="fas fa-circle-info"></i> Pilih jenis event terlebih dahulu.</p>
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('bukti_pajak_bpprd') !!}
                            </div>
                            <div class="upload-card" data-anim="up" style="--d: .33s">
                                <span class="label" id="lbl-surat_pernyataan"><span>Surat Pernyataan Pertanggungjawaban Mutlak <span class="req" aria-hidden="true">*</span></span></span>
                                <div class="dropzone{{ $inv('surat_pernyataan') }}" data-dropzone data-max="5" data-ext="pdf,jpg,jpeg,png">
                                    <input type="file" id="surat_pernyataan" name="surat_pernyataan" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required aria-labelledby="lbl-surat_pernyataan">

                                    <div class="dz-prompt">
                                        <span class="dz-ico"><i class="fas fa-file-signature"></i></span>
                                        <span class="dz-text"><strong>Tarik surat pernyataan ke sini</strong> atau <u>pilih dari perangkat</u></span>
                                    </div>

                                    <div class="dz-preview">
                                        <div class="dz-img-wrap" hidden>
                                            <span class="dz-badge-ok"><i class="fas fa-circle-check"></i> Siap Diunggah</span>
                                            <img alt="Pratinjau Surat Pernyataan Pertanggungjawaban Mutlak" data-dz-img>
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
                                <p class="field-err dz-msg" role="alert"></p>
                                {!! $fe('surat_pernyataan') !!}
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="btn_submit_keramaian"><i class="fas fa-paper-plane"></i> Kirim permohonan</button>
                    </div>
                </form>
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
                    <a class="map-link" href="{{ $maps_link }}" target="_blank" rel="noopener" aria-label="Buka lokasi Dinas Pemadam Kebakaran Kota Jambi di Google Maps">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="{{ $maps_link }}" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>

                @if($play_store_url)
                <div class="app-dl">
                    <p>Unduh aplikasi SIMERAH KOJA</p>
                    <a href="{{ $play_store_url }}" target="_blank" rel="noopener">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Dapatkan di Google Play">
                    </a>
                </div>
                @endif
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
        <a class="tel" href="{{ 'tel:' . $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon {{ $telepon_tampil }}</a>
        <a class="n112" href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a>
    </div>
    <button class="sos-fab-btn" type="button" aria-expanded="false" aria-controls="sosSheet">
        <span class="beacon" style="background:#fff" aria-hidden="true"></span> Lapor darurat
    </button>
</div>

<script>
(function () {
    'use strict';

    /* ---------- Animasi In Saat Elemen Masuk Layar (IntersectionObserver) ---------- */
    var animItems = document.querySelectorAll('[data-anim]');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-inview');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -24px 0px' });

        animItems.forEach(function (el) { io.observe(el); });
    } else {
        animItems.forEach(function (el) { el.classList.add('is-inview'); });
    }

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

    /* ---------- Tombol Lapor Mengambang & Toast ---------- */
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

    var toast = document.getElementById('toast');
    if (toast) {
        var hideToast = function () {
            toast.classList.add('leaving');
            setTimeout(function () { toast.remove(); }, 400);
        };
        toast.querySelector('[data-toast-close]').addEventListener('click', hideToast);
        setTimeout(hideToast, 5000);
    }

    /* ---------- State Validasi Form Real-Time ---------- */
    const btnSubmit = document.getElementById('btn_submit_keramaian');

    const nikInput = document.getElementById('nik');
    const nikBadge = document.getElementById('nik_badge');
    const nikMsg   = document.getElementById('nik_msg');

    const waInput = document.getElementById('no_hp');
    const waBadge = document.getElementById('wa_badge');
    const waMsg   = document.getElementById('wa_msg');

    const tglInput = document.getElementById('tgl_pelaksanaan');
    const tglBadge = document.getElementById('tgl_badge');
    const tglMsg   = document.getElementById('tgl_msg');

    const aparInput = document.getElementById('jumlah_apar');
    const aparBadge = document.getElementById('apar_badge');
    const aparMsg   = document.getElementById('apar_msg');
    const hintApar  = document.getElementById('hint-apar');

    const staffInput = document.getElementById('jumlah_staff');
    const staffBadge = document.getElementById('staff_badge');
    const staffMsg   = document.getElementById('staff_msg');
    const hintStaff  = document.getElementById('hint-staff');

    let isNikValid   = true;
    let isWaValid    = true;
    let isDateValid  = true;
    let isAparValid  = true;
    let isStaffValid = true;
    let isFileValid  = true;

    function syncSubmitButton() {
        if (btnSubmit) {
            btnSubmit.disabled = !(isNikValid && isWaValid && isDateValid && isAparValid && isStaffValid && isFileValid);
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
    if (waInput.value) validateWa();

    /* ---------- Validasi Tanggal Pelaksanaan (Selambat-lambatnya H-14 Sebelum Kegiatan) ---------- */
    function validateDate() {
        if (!tglInput.value) {
            tglBadge.className = 'pw-badge';
            tglBadge.innerHTML = '';
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

        const minDate = new Date(today);
        minDate.setDate(today.getDate() + 14);

        if (selected < minDate) {
            tglBadge.className = 'pw-badge show mismatch';
            tglBadge.innerHTML = '<i class="fas fa-xmark"></i> Kurang dari H-14';
            tglMsg.className = 'pw-status show mismatch';
            tglMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Permohonan disampaikan selambat-lambatnya 14 hari sebelum kegiatan';
            tglInput.classList.add('is-invalid');
            tglInput.classList.remove('is-valid');
            isDateValid = false;
        } else {
            tglBadge.className = 'pw-badge show match';
            tglBadge.innerHTML = '<i class="fas fa-check"></i> Sesuai';
            tglMsg.className = 'pw-status show match';
            tglMsg.innerHTML = '<i class="fas fa-calendar-check"></i> Tanggal memenuhi syarat pengajuan (Min H-14)';
            tglInput.classList.add('is-valid');
            tglInput.classList.remove('is-invalid');
            isDateValid = true;
        }
        syncSubmitButton();
    }
    tglInput.addEventListener('change', validateDate);
    if (tglInput.value) validateDate();

    /* ---------- Validasi Jumlah APAR (Min 8) & Staff Terlatih (Min 4) ---------- */
    function validateApar(tampil) {
        const min = 8;
        const val = parseInt(aparInput.value, 10);
        const rendah = isNaN(val) || val < min;
        aparInput.setCustomValidity(rendah ? aparInput.getAttribute('data-pesan') : '');

        if (!tampil && val === 0) {
            isAparValid = false;
            syncSubmitButton();
            return;
        }

        if (rendah) {
            aparInput.classList.add('is-low', 'is-invalid');
            aparInput.classList.remove('is-valid');
            if (hintApar) hintApar.classList.add('is-low');
            aparBadge.className = 'pw-badge show mismatch';
            aparBadge.innerHTML = (isNaN(val) ? 0 : val) + '/8 Buah';
            aparMsg.className = 'pw-status show mismatch';
            aparMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Jumlah APAR belum memenuhi syarat minimal (8 buah)';
            isAparValid = false;
        } else {
            aparInput.classList.remove('is-low', 'is-invalid');
            aparInput.classList.add('is-valid');
            if (hintApar) hintApar.classList.remove('is-low');
            aparBadge.className = 'pw-badge show match';
            aparBadge.innerHTML = '<i class="fas fa-check"></i> Memenuhi';
            aparMsg.className = 'pw-status show match';
            aparMsg.innerHTML = '<i class="fas fa-circle-check"></i> Jumlah APAR memenuhi syarat (' + val + ' buah)';
            isAparValid = true;
        }
        syncSubmitButton();
    }

    function validateStaff(tampil) {
        const min = 4;
        const val = parseInt(staffInput.value, 10);
        const rendah = isNaN(val) || val < min;
        staffInput.setCustomValidity(rendah ? staffInput.getAttribute('data-pesan') : '');

        if (!tampil && val === 0) {
            isStaffValid = false;
            syncSubmitButton();
            return;
        }

        if (rendah) {
            staffInput.classList.add('is-low', 'is-invalid');
            staffInput.classList.remove('is-valid');
            if (hintStaff) hintStaff.classList.add('is-low');
            staffBadge.className = 'pw-badge show mismatch';
            staffBadge.innerHTML = (isNaN(val) ? 0 : val) + '/4 Orang';
            staffMsg.className = 'pw-status show mismatch';
            staffMsg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Staff terlatih belum memenuhi syarat minimal (4 orang)';
            isStaffValid = false;
        } else {
            staffInput.classList.remove('is-low', 'is-invalid');
            staffInput.classList.add('is-valid');
            if (hintStaff) hintStaff.classList.remove('is-low');
            staffBadge.className = 'pw-badge show match';
            staffBadge.innerHTML = '<i class="fas fa-check"></i> Memenuhi';
            staffMsg.className = 'pw-status show match';
            staffMsg.innerHTML = '<i class="fas fa-circle-check"></i> Jumlah staff terlatih memenuhi syarat (' + val + ' orang)';
            isStaffValid = true;
        }
        syncSubmitButton();
    }

    aparInput.addEventListener('input', function () { validateApar(true); });
    aparInput.addEventListener('blur', function () { validateApar(true); });
    staffInput.addEventListener('input', function () { validateStaff(true); });
    staffInput.addEventListener('blur', function () { validateStaff(true); });

    validateApar(aparInput.classList.contains('is-invalid') || parseInt(aparInput.value, 10) > 0);
    validateStaff(staffInput.classList.contains('is-invalid') || parseInt(staffInput.value, 10) > 0);

    /* ---------- Area Unggah Berkas & Pratinjau Gambar (Dropzone) ---------- */
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
        if (typeof updateUploadCount === 'function') updateUploadCount();
    }

    dropzones.forEach(function (dz) {
        var input = dz.querySelector('input[type="file"]');
        var list = dz.querySelector('.dz-files');
        var imgPreview = dz.querySelector('[data-dz-img]');
        var btnRemove = dz.querySelector('[data-dz-remove]');
        var btnChange = dz.querySelector('[data-dz-change]');
        var maxMb = parseFloat(dz.getAttribute('data-max')) || 5;
        var allowedExt = (dz.getAttribute('data-ext') || 'pdf,jpg,jpeg,png').split(',');
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
                checkAllDropzonesValid();
                return;
            }

            var file = files[0];
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
                if (msg) msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> Ukuran berkas "' + file.name + '" (' + fmtSize(file.size) + ') melebihi batas ' + maxMb + ' MB.';
                checkAllDropzonesValid();
                return;
            }

            /* Pratinjau: gambar tampil sebagai thumbnail, PDF hanya tampil sebagai nama berkas */
            var isImg = ['jpg', 'jpeg', 'png'].indexOf(ext) > -1;
            if (imgPreview) {
                var wrap = imgPreview.closest('.dz-img-wrap');
                if (imgPreview._url) { URL.revokeObjectURL(imgPreview._url); imgPreview._url = null; }
                if (isImg) {
                    imgPreview._url = URL.createObjectURL(file);
                    imgPreview.src = imgPreview._url;
                    if (wrap) wrap.hidden = false;
                } else {
                    imgPreview.removeAttribute('src');
                    if (wrap) wrap.hidden = true;
                }
            }

            var li = document.createElement('li');
            var ico = document.createElement('i');
            ico.className = 'fas ' + (isImg ? 'fa-file-image' : 'fa-file-pdf');
            var nm = document.createElement('span');
            nm.textContent = file.name;
            var sz = document.createElement('span');
            sz.className = 'f-size';
            sz.textContent = fmtSize(file.size);
            li.appendChild(ico); li.appendChild(nm); li.appendChild(sz);
            list.appendChild(li);

            dz.classList.add('has-files');
            checkAllDropzonesValid();
        }

        input.addEventListener('change', function () { handleFiles(input.files); });

        ['dragenter', 'dragover'].forEach(function (ev) {
            dz.addEventListener(ev, function (e) { e.preventDefault(); dz.classList.add('is-over'); });
        });
        ['dragleave', 'dragend'].forEach(function (ev) {
            dz.addEventListener(ev, function () { dz.classList.remove('is-over'); });
        });
        dz.addEventListener('drop', function (e) {
            e.preventDefault();
            dz.classList.remove('is-over');
            if (input.disabled) return;
            var f = e.dataTransfer && e.dataTransfer.files;
            if (!f || !f.length) return;
            try {
                var dt = new DataTransfer();
                dt.items.add(f[0]);
                input.files = dt.files;
            } catch (err) {
                input.files = f;
            }
            handleFiles(input.files);
        });

        if (btnChange) btnChange.addEventListener('click', function (e) { e.preventDefault(); input.click(); });
        if (btnRemove) btnRemove.addEventListener('click', function (e) {
            e.preventDefault();
            var wrap = imgPreview && imgPreview.closest('.dz-img-wrap');
            if (imgPreview && imgPreview._url) { URL.revokeObjectURL(imgPreview._url); imgPreview._url = null; }
            if (wrap) wrap.hidden = true;
            resetDropzone();
            if (msg) msg.innerHTML = '';
            dz.classList.remove('is-invalid');
            checkAllDropzonesValid();
        });
    });

    /* ---------- Jenis Event -> Bukti Pajak BPPRD wajib hanya untuk event hiburan ---------- */
    var jenisEvent = document.getElementById('jenis_event');
    var cardPajak  = document.getElementById('card_pajak');
    var pajakState = document.getElementById('pajak_state');

    function togglePajak() {
        if (!jenisEvent || !cardPajak) return;
        var inp = cardPajak.querySelector('input[type="file"]');
        var star = cardPajak.querySelector('.label > span:first-child');
        var hiburan = jenisEvent.value === 'hiburan';

        cardPajak.classList.toggle('is-off', !hiburan);
        inp.disabled = !hiburan;
        inp.required = hiburan;

        if (!hiburan) {
            var rm = cardPajak.querySelector('[data-dz-remove]');
            if (rm && cardPajak.querySelector('.dropzone').classList.contains('has-files')) rm.click();
        }

        if (pajakState) {
            if (hiburan) {
                pajakState.className = 'pw-status show mismatch';
                pajakState.innerHTML = '<i class="fas fa-circle-exclamation"></i> Wajib dilampirkan untuk event hiburan.';
            } else if (jenisEvent.value === 'non_hiburan') {
                pajakState.className = 'pw-status show match';
                pajakState.innerHTML = '<i class="fas fa-circle-check"></i> Tidak diperlukan untuk event non-hiburan.';
            } else {
                pajakState.className = 'pw-status show warn';
                pajakState.innerHTML = '<i class="fas fa-circle-info"></i> Pilih jenis event terlebih dahulu.';
            }
        }

        var existingStar = cardPajak.querySelector('.label .req');
        if (hiburan && !existingStar && star) {
            var r = document.createElement('span');
            r.className = 'req'; r.setAttribute('aria-hidden', 'true'); r.textContent = ' *';
            star.appendChild(r);
        } else if (!hiburan && existingStar) {
            existingStar.remove();
        }
        updateUploadCount();
        checkAllDropzonesValid();
    }

    /* ---------- Ringkasan kemajuan unggah berkas ---------- */
    function updateUploadCount() {
        var cards = document.querySelectorAll('.upload-grid .upload-card:not(.is-off)');
        var done = 0;
        cards.forEach(function (c) {
            if (c.querySelector('.dropzone').classList.contains('has-files')) done++;
        });
        var label = document.getElementById('uplCount');
        var bar = document.getElementById('uplBar');
        if (label) label.textContent = done + ' dari ' + cards.length + ' berkas terunggah';
        if (bar) bar.style.width = (cards.length ? Math.round(done / cards.length * 100) : 0) + '%';
    }

    /* Error dari server pada dropzone ditandai data-srv agar tidak mengunci tombol kirim */
    dropzones.forEach(function (d) {
        if (d.classList.contains('is-invalid')) { d.dataset.srv = '1'; d.classList.remove('is-invalid'); }
        d.querySelector('input[type="file"]').addEventListener('change', function () { delete d.dataset.srv; });
    });

    if (jenisEvent) {
        jenisEvent.addEventListener('change', togglePajak);
        togglePajak();
    }
    updateUploadCount();

    /* ---------- Animasi masuk bergantian untuk setiap kolom isian ---------- */
    document.querySelectorAll('.fs').forEach(function (fs) {
        fs.querySelectorAll('.field').forEach(function (f, i) { f.style.setProperty('--i', i); });
    });

    /* ---------- Cek Status Permohonan ---------- */
    var csForm = document.getElementById('csForm');
    if (csForm) {
        var csInput = document.getElementById('csKontak');
        var csBtn = document.getElementById('csBtn');
        var csErr = document.getElementById('csErr');
        var csList = document.getElementById('csList');
        var CEK_URL = @json($url_cek_status);
        var CSRF = '{{ csrf_token() }}';

        csInput.addEventListener('input', function () {
            var val = csInput.value.replace(/\D/g, '');
            if (val.startsWith('628')) {
                val = '08' + val.slice(3);
            }
            csInput.value = val.slice(0, 16);
        });

        var STATUS_INFO = {
            'Menunggu':  { cls: 'cs-menunggu',  txt: 'Permohonan diterima dan menunggu verifikasi petugas.' },
            'Proses':    { cls: 'cs-proses',    txt: 'Permohonan sedang diproses oleh petugas.' },
            'Disetujui': { cls: 'cs-disetujui', txt: 'Permohonan disetujui. Silakan hubungi petugas untuk tindak lanjut.' },
            'Ditolak':   { cls: 'cs-ditolak',   txt: 'Permohonan ditolak. Hubungi petugas untuk informasi lebih lanjut.' }
        };

        function statusClass(st) {
            st = String(st || '').toLowerCase();
            if (st.indexOf('setuju') > -1 || st.indexOf('terima') > -1 || st.indexOf('selesai') > -1) return 'cs-disetujui';
            if (st.indexOf('tolak') > -1) return 'cs-ditolak';
            if (st.indexOf('proses') > -1 || st.indexOf('verifikasi') > -1) return 'cs-proses';
            return 'cs-menunggu';
        }

        function el(tag, cls, text) {
            var n = document.createElement(tag);
            if (cls) n.className = cls;
            if (text !== undefined) n.textContent = text;
            return n;
        }

        csForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var v = csInput.value.trim();
            csErr.innerHTML = '';
            csList.innerHTML = '';

            var isNik = v.length === 16;
            var isWa  = v.startsWith('08') && v.length >= 10 && v.length <= 14;

            if (!isNik && !isWa) {
                csErr.innerHTML = '<i class="fas fa-circle-exclamation"></i> Masukkan 16 digit NIK atau Nomor WhatsApp (diawali 08, 10-14 digit) yang valid.';
                csInput.focus();
                return;
            }

            csBtn.disabled = true;
            csBtn.innerHTML = '<i class="fas fa-circle-notch spin"></i> Mencari';

            fetch(CEK_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ kontak: v })
            })
            .then(function (r) {
                return r.json().catch(function () { return {}; }).then(function (body) {
                    return { status: r.status, ok: r.ok, body: body };
                });
            })
            .then(function (res) {
                if (!res.ok) {
                    if (res.status === 429) { csErr.innerHTML = '<i class="fas fa-circle-exclamation"></i> Terlalu banyak percobaan. Coba lagi sebentar lagi.'; return; }
                    if (res.status === 419) { csErr.innerHTML = '<i class="fas fa-circle-exclamation"></i> Sesi berakhir. Muat ulang halaman lalu coba lagi.'; return; }
                    csErr.innerHTML = '<i class="fas fa-circle-exclamation"></i> ' + ((res.body && res.body.message) || 'Gagal memeriksa status. Silakan coba lagi.');
                    return;
                }
                var rows = Array.isArray(res.body) ? res.body : (res.body.data || res.body.permohonan || []);
                if (!rows.length) {
                    csList.appendChild(el('li', 'cs-empty', 'Belum ada permohonan dengan data tersebut.'));
                    return;
                }
                rows.forEach(function (it, i) {
                    var stLabel = it.status_label || it.status || 'Menunggu';
                    var stInfo = STATUS_INFO[stLabel] || { cls: statusClass(stLabel), txt: '' };
                    var li = el('li', 'cs-item');
                    li.style.setProperty('--i', i);
                    var top = el('div', 'cs-top');
                    top.appendChild(el('span', 'cs-kegiatan', it.nama_acara || it.kegiatan || 'Permohonan'));
                    top.appendChild(el('span', 'cs-badge ' + stInfo.cls, stLabel));
                    li.appendChild(top);

                    var meta = el('div', 'cs-meta');
                    meta.appendChild(document.createTextNode('Pemohon: ' + (it.nama || '-')));
                    if (it.lokasi_acara || it.lokasi) {
                        meta.appendChild(document.createElement('br'));
                        meta.appendChild(document.createTextNode('Lokasi: ' + (it.lokasi_acara || it.lokasi)));
                    }
                    if (it.tgl_pelaksanaan || it.tanggal) {
                        meta.appendChild(document.createElement('br'));
                        meta.appendChild(document.createTextNode('Pelaksanaan: ' + (it.tgl_pelaksanaan || it.tanggal)));
                    }
                    if (it.created_at || it.diajukan) {
                        meta.appendChild(document.createElement('br'));
                        meta.appendChild(document.createTextNode('Diajukan: ' + (it.created_at || it.diajukan)));
                    }
                    li.appendChild(meta);

                    var noteTxt = it.catatan || stInfo.txt;
                    if (noteTxt) {
                        li.appendChild(el('div', 'cs-note ' + stInfo.cls, noteTxt));
                    }
                    csList.appendChild(li);
                });
            })
            .catch(function () {
                csErr.innerHTML = '<i class="fas fa-circle-exclamation"></i> Gagal memeriksa status. Silakan coba lagi.';
            })
            .finally(function () {
                csBtn.disabled = false;
                csBtn.innerHTML = '<i class="fas fa-search"></i> Cek';
            });
        });
    }

    /* ---------- Kolom kiri sticky tanpa scroll internal ----------
       Jika tinggi kolom lebih kecil dari layar: menempel di bawah header.
       Jika lebih tinggi: menempel dengan bagian bawahnya rata dengan dasar layar,
       sehingga seluruh isi tetap terlihat setelah halaman digulir. */
    var stack = document.querySelector('.info-stack');
    var wide = window.matchMedia('(min-width: 992px)');
    function updateStick() {
        if (!stack) return;
        if (!wide.matches) { stack.style.removeProperty('--stick-top'); return; }
        var hh = header ? header.offsetHeight : 64;
        var top = hh + 16;
        var fit = window.innerHeight - stack.offsetHeight - 16;
        stack.style.setProperty('--stick-top', Math.min(top, fit) + 'px');
    }
    if (stack) {
        updateStick();
        window.addEventListener('resize', updateStick);
        window.addEventListener('load', updateStick);
        if ('ResizeObserver' in window) new ResizeObserver(updateStick).observe(stack);
        if (wide.addEventListener) wide.addEventListener('change', updateStick);
    }

    /* ---------- Cegah kirim ganda & fokus ke kolom yang bermasalah ---------- */
    var formKeramaian = document.getElementById('form_keramaian');
    if (formKeramaian) {
        formKeramaian.addEventListener('submit', function () {
            setTimeout(function () {
                if (btnSubmit) {
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = '<i class="fas fa-circle-notch spin"></i> Mengirim...';
                }
            }, 0);
        });
        formKeramaian.addEventListener('invalid', function (e) {
            e.target.classList.add('is-invalid');
        }, true);
    }
})();
</script>
</body>
</html>