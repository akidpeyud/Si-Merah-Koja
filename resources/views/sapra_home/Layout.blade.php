@php
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    $path_sarana = request()->routeIs('sarpras.sarana');
    $infoPos = $infoPos ?? [];

    // Hilangkan tab 'sumber-air' dan 'hidrant' secara otomatis walaupun masih dikirim dari Controller
    $tabs = collect($tabs ?? [])->except(['sumber-air', 'hidrant'])->all();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <title>@yield('judul') | SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS (sama dengan beranda)
           ========================================================== */
        :root {
            --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
            --paper: #f3f5f8; --white: #ffffff;
            --signal: #e5392d; --signal-d: #c22b20; --amber: #ffb627;
            --steel: #5b6c7f; --line: #dbe2ea; --soft: #eef2f6; --blue: #2563eb;
            --ok: #059669; --ok-tint: #ecfdf5; --ok-line: #a7f3d0;
            --bad: #dc2626; --bad-tint: #fef2f2; --bad-line: #fecaca;

            --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
            --font-body: 'Instrument Sans', system-ui, sans-serif;

            --r-lg: 24px; --r-md: 17px; --r-sm: 11px;
            --wrap: 1300px; --header-h: 64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        [hidden] { display: none !important; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); font-size: 1rem; line-height: 1.65; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        button, a, input, select { -webkit-tap-highlight-color: transparent; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* ==========================================================
           HEADER & NAVBAR (sama dengan homepage)
           ========================================================== */
        .site-header { position: sticky; top: 0; z-index: 60; background: rgba(13,27,42,.88); -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4); border-bottom: 1px solid rgba(255,255,255,.08); }
        .nav { max-width: 1440px; margin: 0 auto; min-height: var(--header-h); padding: 0 clamp(16px, 3vw, 32px); display: flex; align-items: center; justify-content: space-between; gap: 24px; }

        .brand { display: flex; align-items: center; flex: none; }
        .brand a { display: flex; align-items: center; }
        .brand a + a { margin-left: 14px; padding-left: 14px; border-left: 1px solid rgba(255,255,255,.16); }
        .brand img { height: 36px; width: auto; }

        .nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
        .menu { display: flex; align-items: center; justify-content: center; gap: 2px; flex: 1; min-width: 0; }
        .menu > li { position: relative; }

        .menu-link, .menu-trigger { position: relative; display: inline-flex; align-items: center; gap: 6px; padding: 10px 11px; color: rgba(255,255,255,.78); font-size: .875rem; font-weight: 500; letter-spacing: .005em; white-space: nowrap; transition: color .2s; }
        .menu-link::after, .menu-trigger::after { content: ""; position: absolute; left: 11px; right: 11px; bottom: 2px; height: 2px; border-radius: 2px; background: var(--amber); transform: scaleX(0); transform-origin: left; transition: transform .25s ease; }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active, .menu > li.current > .menu-trigger { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after, .menu > li.current > .menu-trigger::after { transform: scaleX(1); }
        .menu-trigger i { font-size: .6rem; opacity: .6; transition: transform .2s, opacity .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); opacity: 1; }

        .nav-actions { display: flex; align-items: center; gap: 10px; flex: none; }
        .nav-actions > li { position: relative; }
        .btn-nav { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 16px; border-radius: 999px; font-size: .875rem; font-weight: 600; white-space: nowrap; transition: background .2s, border-color .2s, color .2s, transform .2s; }
        .btn-nav:active { transform: scale(.97); }
        .btn-nav i.fa-chevron-down { font-size: .6rem; opacity: .8; transition: transform .2s; }
        .has-drop.open > .btn-nav i.fa-chevron-down { transform: rotate(180deg); }
        .btn-nav--alert { background: #e5392d; color: #fff; }
        .btn-nav--alert:hover, .has-drop.open > .btn-nav--alert { background: #c22b20; }
        .btn-nav--alert .beacon { width: 8px; height: 8px; background: #fff; }
        .btn-nav--alert .beacon::after { background: #fff; }
        .btn-nav--ghost { border: 1.5px solid rgba(255,255,255,.3); color: #fff; }
        .btn-nav--ghost:hover, .has-drop.open > .btn-nav--ghost { border-color: #fff; background: rgba(255,255,255,.08); }

        .dropdown { position: absolute; top: calc(100% + 14px); left: 50%; min-width: 250px; width: max-content; max-width: 320px; background: var(--ink-2); border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45); visibility: hidden; opacity: 0; pointer-events: none; transform: translate(-50%, 6px); transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s; }
        .nav-actions .dropdown { left: auto; right: 0; transform: translate(0, 6px); }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -14px; height: 14px; }
        .dropdown::after { content: ""; position: absolute; top: -6px; left: 50%; width: 10px; height: 10px; margin-left: -5px; background: var(--ink-2); border-top: 1px solid rgba(255,255,255,.1); border-left: 1px solid rgba(255,255,255,.1); transform: rotate(45deg); }
        .nav-actions .dropdown::after { left: auto; right: 24px; margin-left: 0; }
        .has-drop.open > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
        .nav-actions .has-drop.open > .dropdown { transform: translate(0, 0); }

        .dropdown a, .dropdown .btn-logout { display: flex; align-items: center; gap: 12px; width: 100%; padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; line-height: 1.4; color: rgba(255,255,255,.85); text-align: left; white-space: normal; transition: background .15s, color .15s; }
        .dropdown a:hover, .dropdown a:focus-visible, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.08); color: #fff; }
        .dropdown a i { width: 18px; text-align: center; font-size: 1rem; flex: none; }
        .dropdown a .fa-phone-alt { color: #38bdf8; }
        .dropdown a .fa-whatsapp { color: #25d366; }
        .dropdown a .fa-headset { color: #f87171; }
        .dropdown .btn-logout { color: #ff8b8b; cursor: pointer; }
        .dropdown .btn-logout:hover { background: rgba(255,255,255,.08); color: #ffb8b8; }

        .has-sub { position: relative; }
        .has-sub > .sub-trigger { width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; line-height: 1.4; text-align: left; color: rgba(255,255,255,.85); transition: background .15s, color .15s; }
        .has-sub > .sub-trigger i { font-size: .65rem; opacity: .7; transition: transform .2s; }
        .has-sub > .sub-trigger:hover, .has-sub.open > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }
        .dropdown-sub { display: none; position: absolute; top: -8px; left: 100%; min-width: 230px; margin-left: 6px; z-index: 10; background: var(--ink-2); border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45); }
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
            .nav-panel { display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: calc(100dvh - var(--header-h)); overflow-y: auto; overscroll-behavior: contain; flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 20px; padding: 8px clamp(16px, 4vw, 32px) 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1); box-shadow: 0 30px 40px rgba(0,0,0,.35); }
            .nav-open .nav-panel { display: flex; }
            .menu { flex-direction: column; align-items: stretch; justify-content: flex-start; gap: 0; flex: none; }
            .menu > li { border-bottom: 1px solid rgba(255,255,255,.08); }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 16px 4px; font-size: 1rem; white-space: normal; color: rgba(255,255,255,.9); }
            .menu-link::after, .menu-trigger::after { display: none; }
            .menu-link.is-active, .menu > li.current > .menu-trigger { color: var(--amber); }
            .menu-trigger i { font-size: .7rem; }
            .nav-actions { flex-direction: column; align-items: stretch; gap: 10px; }
            .btn-nav { height: 48px; font-size: 1rem; }
            .nav-actions .has-drop > .btn-nav { width: 100%; }
            .dropdown, .nav-actions .dropdown { display: none; position: static; min-width: 0; width: auto; max-width: none; margin: 0 0 12px 4px; padding: 0 0 0 12px; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.14); border-radius: 0; box-shadow: none; visibility: visible; opacity: 1; pointer-events: auto; transform: none; transition: none; }
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
        .page-hero { position: relative; isolation: isolate; overflow: hidden; color: #fff; background: var(--ink); padding: clamp(38px, 6vw, 76px) 0 clamp(68px, 9vw, 100px); }
        .page-hero::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(60% 55% at 8% 100%, rgba(229,57,45,.38), transparent 70%), linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.84) 48%, rgba(13,27,42,.62) 100%), url('/images/background1.png') center / cover no-repeat; }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .86rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 26px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current] { color: #fff; font-weight: 600; }
        .page-hero h1 { max-width: 1000px; font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2.55rem, 6.6vw, 5.1rem); line-height: .98; letter-spacing: -.045em; text-wrap: balance; }
        .page-hero p { margin-top: 18px; max-width: 62ch; line-height: 1.75; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }
        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           PILL TAB & TOMBOL PINDAH SARANA/PRASARANA
           ========================================================== */
        .page-nav-wrap { display: flex; justify-content: center; margin-top: -28px; position: relative; z-index: 10; padding: 0 18px; }
        .page-nav { display: inline-flex; align-items: center; background: #fff; padding: 7px; border-radius: 999px; box-shadow: 0 12px 35px rgba(13,27,42,.1); gap: 5px; overflow-x: auto; max-width: 100%; border: 1px solid rgba(0,0,0,.04); scrollbar-width: none; }
        .page-nav::-webkit-scrollbar { display: none; }
        .page-nav button { display: inline-flex; align-items: center; gap: 8px; padding: 11px 20px; border-radius: 999px; font-size: .88rem; font-weight: 700; color: var(--steel); white-space: nowrap; transition: .3s; }
        .page-nav button:hover { color: var(--ink-2); background: var(--soft); }
        .page-nav button.active { background: var(--ink); color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,.15); }
        .page-nav button.active i { color: var(--amber); }

        .page-nav .nav-sep { width: 1.5px; align-self: stretch; margin: 6px 4px; background: var(--line); flex: none; }
        .page-nav a.nav-switch { display: inline-flex; align-items: center; gap: 8px; padding: 11px 20px; border-radius: 999px; font-size: .88rem; font-weight: 700; color: var(--signal-d); background: #fdeceb; border: 1px solid #f5c2be; white-space: nowrap; transition: .25s; flex: none; }
        .page-nav a.nav-switch:hover { background: var(--signal); color: #fff; border-color: var(--signal); box-shadow: 0 6px 16px -4px rgba(229,57,45,.55); transform: translateY(-1px); }
        .page-nav a.nav-switch i.arr { font-size: .78rem; transition: transform .2s; }
        .page-nav a.nav-switch:hover i.arr { transform: translateX(3px); }

        @media (max-width: 768px) { .page-nav { justify-content: flex-start; } }

        /* ==========================================================
           KONTEN UMUM
           ========================================================== */
        .page-body { padding: 38px 0 clamp(64px, 9vw, 112px); min-height: 50vh; }
        .panel { display: none; animation: rise .5s both; }
        .panel.show { display: block; }
        .panel-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding: 24px 28px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.5rem; letter-spacing: -0.02em; }
        .panel-head .count { font-size: .85rem; font-weight: 700; color: var(--signal-d); background: #fdeceb; padding: 4px 14px; border-radius: 999px; }
        .empty { text-align: center; padding: 56px 24px; color: var(--steel); }
        .empty i { font-size: 2.4rem; color: #c8d1db; margin-bottom: 10px; }

        /* chip pos */
        .chips { display: flex; gap: 8px; padding: 20px 28px 0; overflow-x: auto; scrollbar-width: thin; }
        .chip { flex: none; display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid var(--line); border-radius: 999px; background: #fff; font-size: .8rem; font-weight: 700; color: var(--steel); text-transform: uppercase; white-space: nowrap; transition: .2s; }
        .chip em { font-style: normal; font-size: .72rem; padding: 1px 8px; border-radius: 999px; background: var(--soft); color: var(--steel); }
        .chip:hover { border-color: var(--signal); color: var(--signal-d); }
        .chip.active { background: var(--signal); border-color: var(--signal); color: #fff; box-shadow: 0 10px 20px -10px rgba(229,57,45,.7); }
        .chip.active em { background: rgba(255,255,255,.25); color: #fff; }

        .pos-info { margin: 16px 28px 0; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 16px; padding: 16px 20px; border: 1px solid var(--line); border-radius: var(--r-md); background: linear-gradient(135deg, #fff, var(--paper)); }
        .pi-text h3 { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; letter-spacing: -0.01em; }
        .pi-text h3 i { color: var(--signal-d); }
        .pi-text p { margin-top: 4px; display: flex; align-items: flex-start; gap: 8px; color: var(--steel); font-size: .88rem; }
        .pi-text p i { margin-top: 5px; font-size: .78rem; }
        .pi-actions { display: flex; flex-wrap: wrap; gap: 8px; }
        .btn-soft, .btn-maps { display: inline-flex; align-items: center; gap: 8px; padding: 9px 16px; border-radius: 10px; font-weight: 700; font-size: .84rem; transition: .2s; }
        .btn-soft { background: #fff; border: 1px solid var(--line); color: var(--ink-2); }
        .btn-soft:hover { border-color: var(--ink-2); }
        .btn-maps { background: #fdeceb; color: var(--signal-d); border: 1px solid #f5c2be; }
        .btn-maps:hover { background: var(--signal); border-color: var(--signal); color: #fff; }
        .pi-map { flex-basis: 100%; height: 260px; border-radius: 14px; overflow: hidden; border: 1px solid var(--line); background: var(--soft); }
        .pi-map iframe { width: 100%; height: 100%; border: 0; }

        /* Bar Pencarian + Saklar Tampilan Galeri/Tabel */
        .gen-bar { margin: 18px 28px 0; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; }
        .search { display: flex; align-items: center; gap: 10px; padding: 10px 18px; border: 1.5px solid var(--line); border-radius: 999px; background: var(--paper); flex: 1 1 280px; max-width: 420px; transition: .2s; }
        .search:focus-within { border-color: var(--ink); background: #fff; box-shadow: 0 0 0 4px rgba(255,182,39,.4); }
        .search i { color: var(--steel); font-size: .9rem; }
        .search input { border: 0; background: none; outline: 0; width: 100%; font: inherit; font-size: .92rem; }

        .seg { display: inline-flex; padding: 4px; border-radius: 999px; background: var(--paper); border: 1.5px solid var(--line); }
        .seg button { display: inline-flex; align-items: center; gap: 8px; height: 36px; padding: 0 16px; border-radius: 999px; font-size: .85rem; font-weight: 700; color: var(--steel); transition: background .2s, color .2s; white-space: nowrap; }
        .seg button:hover { color: var(--ink); }
        .seg button[aria-pressed="true"] { background: var(--ink-2); color: #fff; }

        .tbl-wrap { overflow-x: auto; padding: 20px 28px 30px; }
        .no-result { text-align: center; padding: 36px 16px; color: var(--steel); }

        /* ==========================================================
           MODE 1 (DEFAULT): GALERI KARTU BESAR
           ========================================================== */
        .tbl-wrap.mode-gallery { overflow-x: visible; }
        .tbl-wrap.mode-gallery table,
        .tbl-wrap.mode-gallery tbody { display: block; width: 100%; }
        .tbl-wrap.mode-gallery thead { display: none; }
        .tbl-wrap.mode-gallery tbody {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 22px;
        }
        .tbl-wrap.mode-gallery tbody tr {
            position: relative;
            display: flex;
            flex-direction: column;
            background: #fff;
            border: 1.5px solid var(--line);
            border-radius: var(--r-md);
            overflow: hidden;
            box-shadow: 0 8px 24px -12px rgba(13,27,42,.1);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }
        .tbl-wrap.mode-gallery tbody tr:hover {
            transform: translateY(-5px);
            border-color: #c3cfde;
            box-shadow: 0 20px 36px -16px rgba(13,27,42,.22);
        }
        .tbl-wrap.mode-gallery td {
            display: block;
            width: 100%;
            padding: 0;
            border: 0;
        }

        .tbl-wrap.mode-gallery td.c-no {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 3;
            width: auto;
            pointer-events: none;
        }
        .tbl-wrap.mode-gallery td.c-no .no {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 30px;
            padding: 0 10px;
            border-radius: 999px;
            background: rgba(13, 27, 42, .82);
            -webkit-backdrop-filter: blur(6px);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,.18);
            color: #fff;
            font-family: var(--font-display);
            font-size: .82rem;
            font-weight: 800;
            box-shadow: 0 4px 12px rgba(0,0,0,.25);
        }
        .tbl-wrap.mode-gallery td.c-no .no::before { content: "#"; opacity: .65; margin-right: 1px; }

        .tbl-wrap.mode-gallery td.c-img {
            order: 1;
            width: 100%;
            height: 230px;
            background: var(--paper);
            border-bottom: 1px solid var(--line);
            overflow: hidden;
        }
        .tbl-wrap.mode-gallery td.c-img a.zoom {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 0;
            position: relative;
        }
        .tbl-wrap.mode-gallery td.c-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border: 0;
            border-radius: 0;
            transition: transform .45s ease;
        }
        .tbl-wrap.mode-gallery tbody tr:hover td.c-img img {
            transform: scale(1.05);
        }
        .tbl-wrap.mode-gallery td.c-img a.zoom::after {
            content: "\f065  Layar penuh";
            font-family: "Font Awesome 6 Free", var(--font-body);
            font-weight: 700;
            position: absolute;
            right: 12px;
            bottom: 12px;
            width: auto;
            height: auto;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(13, 27, 42, .82);
            color: #fff;
            font-size: .74rem;
            letter-spacing: .01em;
            display: inline-flex;
            align-items: center;
            opacity: 0;
            transform: translateY(4px);
            transition: opacity .2s, transform .2s;
        }
        .tbl-wrap.mode-gallery td.c-img a.zoom:hover::after {
            opacity: 1;
            transform: none;
        }
        .tbl-wrap.mode-gallery td.c-img .noimg {
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 0;
            background: repeating-linear-gradient(135deg, var(--paper) 0 14px, var(--soft) 14px 28px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #94a3b8;
            font-size: .84rem;
            font-weight: 600;
        }
        .tbl-wrap.mode-gallery td.c-img .noimg i { font-size: 2.2rem; color: #cbd5e1; }

        .tbl-wrap.mode-gallery td.c-nama {
            order: 2;
            min-width: 0;
            padding: 18px 20px 10px;
        }
        .tbl-wrap.mode-gallery td.c-nama .nama {
            font-family: var(--font-display);
            font-weight: 700;
            font-stretch: 92%;
            font-size: 1.08rem;
            line-height: 1.35;
            color: var(--ink);
        }
        .item-badges {
            margin-top: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .ibadge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 8px;
            background: var(--paper);
            border: 1px solid var(--line);
            font-size: .76rem;
            font-weight: 700;
            color: var(--steel);
        }
        .ibadge i { color: var(--signal-d); }
        .ibadge.plat i { color: var(--blue); }

        .tbl-wrap.mode-gallery td.c-jml,
        .tbl-wrap.mode-gallery td.c-etc {
            order: 3;
            width: 100%;
            padding: 9px 20px;
            border-top: 1px dashed var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: .88rem;
            text-align: right;
            color: var(--ink-2);
            font-weight: 600;
        }
        .tbl-wrap.mode-gallery td.c-jml::before,
        .tbl-wrap.mode-gallery td.c-etc::before {
            content: attr(data-label);
            font-size: .76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--steel);
            text-align: left;
            flex: none;
        }
        .tbl-wrap.mode-gallery tbody tr > td:last-child {
            padding-bottom: 16px;
        }

        /* ==========================================================
           MODE 2: TABEL LEBAR
           ========================================================== */
        .tbl-wrap.mode-table table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: .92rem; }
        .tbl-wrap.mode-table thead th { text-align: left; font-size: .72rem; text-transform: uppercase; letter-spacing: .07em; color: var(--steel); background: var(--paper); padding: 12px 14px; white-space: nowrap; }
        .tbl-wrap.mode-table thead th:first-child { border-radius: 12px 0 0 12px; }
        .tbl-wrap.mode-table thead th:last-child { border-radius: 0 12px 12px 0; }
        .tbl-wrap.mode-table td { padding: 12px 14px; border-bottom: 1px solid var(--line); vertical-align: middle; }
        .tbl-wrap.mode-table tbody tr { transition: background .15s; }
        .tbl-wrap.mode-table tbody tr:hover { background: #f8fafc; }
        .tbl-wrap.mode-table tbody tr:last-child td { border-bottom: 0; }
        .tbl-wrap.mode-table td.c-no, .tbl-wrap.mode-table th.c-no { width: 52px; color: var(--steel); font-weight: 600; }
        .tbl-wrap.mode-table td.c-img, .tbl-wrap.mode-table th.c-img { width: 170px; }
        .tbl-wrap.mode-table td.c-jml, .tbl-wrap.mode-table th.c-jml { width: 100px; text-align: center; }
        .tbl-wrap.mode-table td.c-nama { min-width: 220px; }
        .tbl-wrap.mode-table td .nama { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1rem; line-height: 1.35; letter-spacing: -0.005em; color: var(--ink); }
        .jml { display: inline-block; min-width: 38px; padding: 4px 12px; border-radius: 8px; background: #eaf0ff; border: 1px solid #c9d8fb; color: var(--blue); font-weight: 700; font-size: .85rem; text-align: center; }
        .tbl-wrap.mode-table td img { width: 150px; height: 104px; object-fit: cover; border-radius: 12px; border: 1px solid var(--line); }
        .tbl-wrap.mode-table td .noimg { width: 150px; height: 104px; border-radius: 12px; border: 1px dashed var(--line); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; color: #94a3b8; font-size: .75rem; }
        .tbl-wrap.mode-table td .noimg i { font-size: 1.4rem; color: #c0cad6; }
        .tbl-wrap.mode-table td a.zoom { position: relative; display: inline-block; cursor: zoom-in; border-radius: 12px; }
        .tbl-wrap.mode-table td a.zoom img { transition: transform .2s, box-shadow .2s; }
        .tbl-wrap.mode-table td a.zoom:hover img { transform: scale(1.04); box-shadow: 0 10px 20px -8px rgba(13,27,42,.45); }
        .tbl-wrap.mode-table td a.zoom::after { content: "\f00e"; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; right: 8px; bottom: 8px; width: 26px; height: 26px; border-radius: 50%; background: rgba(13,27,42,.75); color: #fff; font-size: .7rem; display: grid; place-items: center; opacity: 0; transition: opacity .2s; }
        .tbl-wrap.mode-table td a.zoom:hover::after { opacity: 1; }

        @media (max-width: 700px) {
            .page-hero { padding: 32px 0 66px; }
            .crumbs { gap: 7px; margin-bottom: 18px; font-size: .78rem; }
            .crumbs li { gap: 7px; }
            .page-hero h1 { font-size: clamp(2.35rem, 11vw, 3.65rem); line-height: 1; }
            .page-hero p { margin-top: 14px; font-size: .96rem; }
            .page-nav-wrap { margin-top: -25px; padding: 0 12px; justify-content: stretch; }
            .page-nav { display: flex; width: 100%; border-radius: 17px; padding: 6px; }
            .page-nav button, .page-nav a.nav-switch { flex: 0 0 auto; padding: 10px 14px; font-size: .82rem; }
            .page-body { padding-top: 28px; padding-bottom: 64px; }
            .panel-card { border-radius: 18px; }
            .panel-head { padding: 20px 18px; align-items: flex-start; }
            .panel-head h2 { font-size: 1.28rem; }
            .chips { padding-left: 18px; padding-right: 18px; }
            .pos-info, .gen-bar { margin-left: 18px; margin-right: 18px; }
            .search { max-width: 100%; }
            .seg { width: 100%; }
            .seg button { flex: 1; justify-content: center; padding: 0 10px; }
            .tbl-wrap { padding: 14px 18px 24px; overflow-x: visible; }
            .tbl-wrap.mode-gallery tbody { grid-template-columns: 1fr; gap: 16px; }
            .tbl-wrap.mode-gallery td.c-img { height: 210px; }
            .tbl-wrap.mode-table thead { display: none; }
            .tbl-wrap.mode-table table, .tbl-wrap.mode-table tbody { display: block; }
            .tbl-wrap.mode-table tbody tr { display: grid; grid-template-columns: 110px 1fr auto; gap: 6px 14px; align-items: center; padding: 14px 0; border-bottom: 1px solid var(--line); }
            .tbl-wrap.mode-table tbody tr:last-child { border-bottom: 0; }
            .tbl-wrap.mode-table td { display: block; border: 0; padding: 0; }
            .tbl-wrap.mode-table td.c-no { display: none; }
            .tbl-wrap.mode-table td.c-img { grid-column: 1; grid-row: 1 / span 3; width: auto; }
            .tbl-wrap.mode-table td.c-nama { grid-column: 2; min-width: 0; }
            .tbl-wrap.mode-table td.c-jml { grid-column: 3; grid-row: 1; width: auto; }
            .tbl-wrap.mode-table td.c-etc { grid-column: 2 / -1; font-size: .85rem; color: var(--steel); }
            .tbl-wrap.mode-table td img, .tbl-wrap.mode-table td .noimg { width: 110px; height: 80px; }
            .pi-map { height: 220px; }
        }

        /* lightbox gambar */
        .lightbox { position: fixed; inset: 0; z-index: 100; display: none; align-items: center; justify-content: center; padding: 24px; background: rgba(7,14,24,.86); -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); cursor: zoom-out; }
        .lightbox.show { display: flex; }
        .lightbox img { max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; border-radius: var(--r-md); box-shadow: 0 30px 60px rgba(0,0,0,.5); cursor: default; }
        .lightbox .lb-close { position: absolute; top: 18px; right: 18px; width: 44px; height: 44px; border-radius: 50%; background: #fff; color: var(--ink); font-size: 1.1rem; display: grid; place-items: center; transition: background .2s; }
        .lightbox .lb-close:hover { background: var(--amber); }

        /* ==========================================================
           FOOTER (sama dengan beranda)
           ========================================================== */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; object-fit: contain; }
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
           TOMBOL LAPOR MENGAMBANG
           ========================================================== */
        .beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; background: var(--signal); flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: inherit; animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
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

        @media (max-width: 700px) {
            .footer { padding-top: 48px; }
            .footer-about img { height: 78px; }
            .footer-bar { align-items: flex-start; flex-direction: column; }
            .sos-fab-btn { padding: 13px 17px; font-size: .9rem; }
        }
        @media (max-width: 380px) {
            .wrap { padding-left: 13px; padding-right: 13px; }
            .page-hero h1 { font-size: 2.2rem; }
        }
        @media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } *, *::before, *::after { animation: none !important; transition: none !important; } }
    </style>
</head>
<body>

<!-- ==================== HEADER ==================== -->
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <div class="brand">
            <a href="/" aria-label="SIMERAH KOJA, beranda"><img src="/images/jambi.png" alt="Logo Pemkot Jambi"></a>
            <a href="/login" title="Login Internal Pegawai"><img src="/images/logo.png" alt="Logo Damkar"></a>
            <a href="/redkar" aria-label="Redkar"><img src="/images/logo-redkar.png" alt="Logo Redkar"></a>
        </div>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navPanel">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-panel" id="navPanel">
            <ul class="menu">
                <li><a class="menu-link {{ request()->is('public-sigap*') ? 'is-active' : '' }}" href="/public-sigap">Sigapkar</a></li>

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="/layanan-fasilitas/penggunaan-sarana">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
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

                <li class="has-drop current">
                    <button class="menu-trigger" type="button" aria-expanded="false">Sarpras <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="{{ route('sarpras.sarana') }}" @if($path_sarana) aria-current="page" @endif>Sarana</a></li>
                        <li><a href="{{ route('sarpras.prasarana') }}" @if(!$path_sarana) aria-current="page" @endif>Prasarana</a></li>
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

 
            </ul>

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

<main>
    <!-- ==================== HERO HALAMAN ==================== -->
    <section class="page-hero">
        <div class="wrap">
            <nav aria-label="Breadcrumb" class="rise">
                <ol class="crumbs">
                    <li><a href="/">Beranda</a></li>
                    <li>Sarpras</li>
                    <li aria-current="page">@yield('judul')</li>
                </ol>
            </nav>
            <h1 class="rise d1">@yield('judul')</h1>
            <p class="rise d2">@yield('deskripsi')</p>
        </div>
        @include('layouts.partials.hero-logos', ['float' => true])
    </section>

    {{-- PILL NAV --}}
    <div class="page-nav-wrap">
        <nav class="page-nav" aria-label="Sub menu @yield('judul')">
            @foreach($tabs as $key => $t)
                <button type="button" data-tab="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}">
                    <i class="fas {{ $t['ico'] }}"></i> {{ $t['label'] }}
                </button>
            @endforeach

            @if(!empty($tabs))
                <span class="nav-sep" aria-hidden="true"></span>
            @endif

            @if($path_sarana)
                <a href="{{ route('sarpras.prasarana') }}" class="nav-switch">
                    <i class="fas fa-building"></i> Halaman Prasarana <i class="fas fa-arrow-right arr"></i>
                </a>
            @else
                <a href="{{ route('sarpras.sarana') }}" class="nav-switch">
                    <i class="fas fa-fire-extinguisher"></i> Halaman Sarana <i class="fas fa-arrow-right arr"></i>
                </a>
            @endif
        </nav>
    </div>

    <div class="page-body">
        <div class="wrap">
            @php
                // Link Google Maps dari kode (URL / koordinat / plus code); null kalau kosong
                $mapHref = function ($v) {
                    $v = trim((string) $v);
                    if ($v === '' || $v === '-') return null;
                    return preg_match('~^https?://~i', $v) ? $v : 'https://www.google.com/maps/search/?api=1&query=' . urlencode($v);
                };
                $mapsInfo = function ($nama) use ($infoPos, $mapHref) {
                    $i = $infoPos[$nama] ?? [];
                    $kode = trim((string) ($i['kode_map'] ?? ''));
                    $embed = ($kode !== '' && !preg_match('~^https?://~i', $kode)) ? 'https://www.google.com/maps?q=' . urlencode($kode) . '&output=embed' : null;
                    return ['alamat' => $i['alamat'] ?? null, 'maps' => $mapHref($kode), 'embed' => $embed];
                };
                $urutPos = array_keys($infoPos);

                $gambar = function ($v) {
                    $v = ltrim((string) $v, '/');
                    foreach ([$v, 'storage/' . $v, 'uploads/' . $v, 'storage/uploads/' . $v] as $p) {
                        if (is_file(public_path($p))) return asset($p);
                    }
                    if (is_file(storage_path('app/public/' . $v))) return asset('storage/' . $v);
                    return null;
                };
                $labelKol = fn ($c) => preg_match('/foto|gambar/i', $c) ? 'Gambar' : ucwords(str_replace('_', ' ', $c));
            @endphp

            @foreach($tabs as $key => $t)
                @php
                    $rows = collect($t['data']);
                    $kolom = [];
                    if ($rows->isNotEmpty()) {
                        $kolom = array_values(array_filter(array_keys((array) $rows->first()), function ($c) {
                            return !in_array($c, ['id', 'created_at', 'updated_at'])
                                && !str_starts_with($c, 'id_')
                                && !preg_match('/stnk|luas/i', $c); // STNK & luas bangunan tidak ditampilkan ke publik
                        }));
                    }

                    $adaPos = in_array('pos', $kolom);

                    // PERBAIKAN: chip dibuat dari SEMUA pos di tabel pos_pemadam (urut id_pos),
                    // lalu ditambah pos lain yang muncul di data (mis. '-') agar baris tetap bisa difilter.
                    $daftarPos = $adaPos
                        ? collect($urutPos)
                            ->merge($rows->pluck('pos')->filter())
                            ->unique()
                            ->values()
                        : collect();
                    $posAwal = $daftarPos->first();

                    $kolDasar  = array_values(array_diff($kolom, ['pos']));
                    $kolBadge  = array_values(array_intersect($kolDasar, ['tahun', 'plat_nomor', 'plat', 'no_plat']));
                    $kolTampil = array_values(array_diff($kolDasar, $kolBadge));
                    $kolNama   = collect($kolTampil)->first(fn ($c) => preg_match('/jenis|nama/i', $c));
                    if (!$kolNama) { $kolBadge = []; $kolTampil = $kolDasar; }
                    $adaGambar = collect($kolTampil)->contains(fn ($c) => preg_match('/foto|gambar/i', $c));
                @endphp
                <section class="panel {{ $loop->first ? 'show' : '' }}" id="panel-{{ $key }}" data-panel="{{ $key }}" data-type="generic">
                  <div class="panel-card">
                    <div class="panel-head">
                        <h2>{{ $t['label'] }}</h2>
                        <span class="count" data-count>{{ number_format($adaPos && $posAwal ? $rows->where('pos', $posAwal)->count() : $rows->count(), 0, ',', '.') }} data</span>
                    </div>

                    @if($rows->isEmpty())
                        <div class="empty"><i class="far fa-folder-open"></i><p>Belum ada data untuk ditampilkan.</p></div>
                    @else
                        @if($daftarPos->isNotEmpty())
                            <div class="chips" data-chips="{{ $key }}" role="tablist" aria-label="Pilih pos">
                                @foreach($daftarPos as $p)
                                    @php $m = $mapsInfo($p); @endphp
                                    <button type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                        class="chip {{ $loop->first ? 'active' : '' }}"
                                        data-pos="{{ $p }}" data-alamat="{{ $m['alamat'] }}" data-maps="{{ $m['maps'] }}" data-embed="{{ $m['embed'] }}">
                                        {{ $p }} <em>{{ $rows->where('pos', $p)->count() }}</em>
                                    </button>
                                @endforeach
                            </div>

                            @php $m0 = $mapsInfo($posAwal); @endphp
                            <div class="pos-info" data-info="{{ $key }}">
                                <div class="pi-text">
                                    <h3><i class="fas fa-warehouse"></i> <span class="pi-nama">{{ $posAwal }}</span></h3>
                                    <p><i class="fas fa-map-marker-alt"></i> <span class="pi-alamat">{{ $m0['alamat'] ?: 'Alamat belum tersedia' }}</span></p>
                                </div>
                                <div class="pi-actions">
                                    <button type="button" class="btn-soft pi-toggle" aria-expanded="false" @if(!$m0['embed']) hidden @endif>
                                        <i class="fas fa-map"></i> <span>Lihat peta</span>
                                    </button>
                                    <a class="btn-maps pi-link" href="{{ $m0['maps'] ?: '#' }}" target="_blank" rel="noopener" @if(!$m0['maps']) hidden @endif>
                                        <i class="fas fa-location-arrow"></i> Buka Google Maps
                                    </a>
                                </div>
                                <div class="pi-map" hidden><iframe title="Peta lokasi pos" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                            </div>
                        @endif

                        <div class="gen-bar">
                            <label class="search"><i class="fas fa-search"></i>
                                <input type="search" placeholder="Cari nama {{ $path_sarana ? 'sarana' : 'prasarana' }}..." data-search="{{ $key }}" autocomplete="off">
                            </label>

                            @if($adaGambar)
                                <div class="seg" data-gen-view="{{ $key }}" role="group" aria-label="Mode tampilan">
                                    <button type="button" data-gmode="gallery" aria-pressed="true"><i class="fas fa-table-cells-large"></i> Galeri</button>
                                    <button type="button" data-gmode="table" aria-pressed="false"><i class="fas fa-list"></i> Tabel</button>
                                </div>
                            @endif
                        </div>

                        <div class="tbl-wrap {{ $adaGambar ? 'mode-gallery' : 'mode-table' }}" data-wrap="{{ $key }}">
                            <table id="tbl-{{ $key }}">
                                <thead><tr>
                                    <th class="c-no">No</th>
                                    @foreach($kolTampil as $c)
                                        <th class="{{ preg_match('/foto|gambar/i', $c) ? 'c-img' : (preg_match('/^jumlah$/i', $c) ? 'c-jml' : '') }}">{{ $labelKol($c) }}</th>
                                    @endforeach
                                </tr></thead>
                                <tbody>
                                @foreach($rows as $r)
                                    @php $r = (array) $r; @endphp
                                    <tr data-pos="{{ $r['pos'] ?? '' }}" @if($adaPos && $posAwal && ($r['pos'] ?? '') !== $posAwal) style="display:none" @endif>
                                        <td class="c-no"><span class="no">{{ $loop->iteration }}</span></td>
                                        @foreach($kolTampil as $c)
                                            @php
                                                $cls = preg_match('/foto|gambar/i', $c) ? 'c-img'
                                                    : ($c === $kolNama ? 'c-nama'
                                                    : (preg_match('/^jumlah$/i', $c) ? 'c-jml' : 'c-etc'));
                                            @endphp
                                            <td class="{{ $cls }}" data-label="{{ $labelKol($c) }}">
                                                @if($cls === 'c-img')
                                                    @php $src = !empty($r[$c]) ? $gambar($r[$c]) : null; @endphp
                                                    @if($src)
                                                        <a href="{{ $src }}" class="zoom" data-full="{{ $src }}" aria-label="Lihat gambar">
                                                            <img src="{{ $src }}" alt="{{ $kolNama ? ($r[$kolNama] ?? '') : '' }}" loading="lazy">
                                                        </a>
                                                    @else
                                                        <span class="noimg"><i class="far fa-image"></i><span>Belum ada foto</span></span>
                                                    @endif
                                                @elseif($cls === 'c-nama')
                                                    <p class="nama">{{ mb_strtoupper((string) ($r[$c] ?? '-')) }}</p>
                                                    @if(!empty($kolBadge))
                                                        <div class="item-badges">
                                                            @foreach($kolBadge as $b)
                                                                @if(!empty($r[$b]) && $r[$b] !== '-')
                                                                    <span class="ibadge {{ preg_match('/plat/i', $b) ? 'plat' : '' }}">
                                                                        <i class="fas {{ preg_match('/tahun/i', $b) ? 'fa-calendar-check' : 'fa-car' }}"></i>
                                                                        {{ preg_match('/tahun/i', $b) ? 'Tahun ' . $r[$b] : mb_strtoupper((string) $r[$b]) }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @elseif($cls === 'c-jml')
                                                    <span class="jml">{{ $r[$c] ?? '-' }}</span>
                                                @else
                                                    {{ ($r[$c] ?? '') !== '' ? $r[$c] : '-' }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <p class="no-result" hidden><i class="far fa-face-frown"></i> Belum ada data di pos ini.</p>
                        </div>
                    @endif
                  </div>
                </section>
            @endforeach
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
                <div class="footer-contact">
                    <a href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> {{ $no_whatsapp }} (WhatsApp)</a>
                    <a href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> {{ $telepon_tampil }} (Call Center Damkar)</a>
                </div>
            </div>

            <div>
                <div class="map">
                    <iframe title="Lokasi Dinas Pemadam Kebakaran Kota Jambi"
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
        <span class="beacon" style="background:#fff" aria-hidden="true"></span> Lapor darurat
    </button>
</div>

{{-- LIGHTBOX GAMBAR --}}
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <button type="button" class="lb-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
    <img src="" alt="">
</div>

<script>
(function () {
    'use strict';

    /* ---------- Navigasi (sama dengan homepage) ---------- */
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
            s.querySelector('.sub-trigger').setAttribute('aria-expanded', 'false');
        });
    }
    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                triggerOf(li).setAttribute('aria-expanded', 'false');
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

    /* ---------- Pill tab ---------- */
    var btns = document.querySelectorAll('.page-nav button');
    var panels = document.querySelectorAll('.panel');
    function openTab(key) {
        var ada = false;
        btns.forEach(function (b) { var on = b.dataset.tab === key; b.classList.toggle('active', on); if (on) ada = true; });
        if (!ada) return;
        panels.forEach(function (p) { p.classList.toggle('show', p.id === 'panel-' + key); });
    }
    btns.forEach(function (b) {
        b.addEventListener('click', function () { openTab(b.dataset.tab); history.replaceState(null, '', '#' + b.dataset.tab); });
    });
    if (location.hash) openTab(location.hash.slice(1));

    /* ==========================================================
       PANEL SARANA / PRASARANA: filter pos + cari + mode galeri/tabel
       ========================================================== */
    function terapkan(key) {
        var panel = document.getElementById('panel-' + key);
        if (!panel) return;
        var inp = panel.querySelector('[data-search]');
        var chip = panel.querySelector('.chip.active');
        var q = inp ? inp.value.toLowerCase().trim() : '';
        var pos = chip ? chip.dataset.pos : '';
        var n = 0;
        panel.querySelectorAll('tbody tr').forEach(function (tr) {
            var cocokPos = !pos || tr.dataset.pos === pos;
            var cocokCari = !q || tr.textContent.toLowerCase().indexOf(q) > -1;
            var tampil = cocokPos && cocokCari;
            tr.style.display = tampil ? '' : 'none';
            if (tampil) { n++; var no = tr.querySelector('.no'); if (no) no.textContent = n; }
        });
        var cnt = panel.querySelector('[data-count]');
        if (cnt) cnt.textContent = n.toLocaleString('id-ID') + ' data';
        var kosong = panel.querySelector('.no-result');
        if (kosong) kosong.hidden = n > 0;
    }
    function isiInfo(panel, chip) {
        var box = panel.querySelector('.pos-info');
        if (!box) return;
        box.querySelector('.pi-nama').textContent = chip.dataset.pos;
        box.querySelector('.pi-alamat').textContent = chip.dataset.alamat || 'Alamat belum tersedia';
        var link = box.querySelector('.pi-link');
        link.hidden = !chip.dataset.maps;
        link.href = chip.dataset.maps || '#';
        var tog = box.querySelector('.pi-toggle');
        var peta = box.querySelector('.pi-map');
        tog.hidden = !chip.dataset.embed;
        tog.dataset.embed = chip.dataset.embed || '';
        peta.hidden = true;
        peta.querySelector('iframe').removeAttribute('src');
        tog.setAttribute('aria-expanded', 'false');
        tog.querySelector('span').textContent = 'Lihat peta';
    }
    document.querySelectorAll('[data-type="generic"] .pos-info').forEach(function (box) {
        var chip = box.closest('.panel').querySelector('.chip.active');
        box.querySelector('.pi-toggle').dataset.embed = chip ? chip.dataset.embed : '';
    });
    document.addEventListener('click', function (e) {
        var tog = e.target.closest('.pi-toggle');
        if (!tog) return;
        var peta = tog.closest('.pos-info').querySelector('.pi-map');
        var buka = peta.hidden;
        if (buka) peta.querySelector('iframe').src = tog.dataset.embed;
        peta.hidden = !buka;
        tog.setAttribute('aria-expanded', buka ? 'true' : 'false');
        tog.querySelector('span').textContent = buka ? 'Tutup peta' : 'Lihat peta';
    });
    document.querySelectorAll('[data-type="generic"] [data-search]').forEach(function (inp) {
        inp.addEventListener('input', function () { terapkan(inp.dataset.search); });
    });
    document.querySelectorAll('[data-type="generic"] [data-chips]').forEach(function (box) {
        box.addEventListener('click', function (e) {
            var c = e.target.closest('.chip');
            if (!c) return;
            box.querySelectorAll('.chip').forEach(function (x) {
                x.classList.toggle('active', x === c);
                x.setAttribute('aria-selected', x === c ? 'true' : 'false');
            });
            isiInfo(box.closest('.panel'), c);
            terapkan(box.dataset.chips);
        });
    });
    document.querySelectorAll('[data-gen-view]').forEach(function (seg) {
        var key = seg.dataset.genView;
        var wrap = document.querySelector('[data-wrap="' + key + '"]');
        var vbtns = seg.querySelectorAll('button');
        vbtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var mode = btn.dataset.gmode;
                vbtns.forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
                if (wrap) {
                    wrap.classList.toggle('mode-gallery', mode === 'gallery');
                    wrap.classList.toggle('mode-table', mode === 'table');
                }
            });
        });
    });
    document.querySelectorAll('[data-type="generic"]').forEach(function (p) { terapkan(p.dataset.panel); });

    /* ---------- Lightbox gambar ---------- */
    var lb = document.getElementById('lightbox');
    var lbImg = lb.querySelector('img');
    function tutupLb() { lb.classList.remove('show'); lbImg.src = ''; }
    document.addEventListener('click', function (e) {
        var a = e.target.closest('a.zoom');
        if (a) { e.preventDefault(); lbImg.src = a.dataset.full; lb.classList.add('show'); return; }
        if (e.target === lb || e.target.closest('.lb-close')) tutupLb();
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') tutupLb(); });
})();
</script>
</body>
</html>