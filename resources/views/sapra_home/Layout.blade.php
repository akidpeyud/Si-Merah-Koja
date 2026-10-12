@php
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    $path_sarana = request()->routeIs('sarpras.sarana');
    $infoPos = $infoPos ?? [];
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

            --r-lg: 28px; --r-md: 18px; --r-sm: 10px;
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
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }
        .sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

        /* ==========================================================
           HEADER (sama dengan beranda)
           ========================================================== */
        .site-header { position: sticky; top: 0; z-index: 60; background: rgba(13,27,42,.85); -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4); border-bottom: 1px solid rgba(255,255,255,.08); }
        .nav { max-width: var(--wrap); margin: 0 auto; min-height: var(--header-h); padding: 0 clamp(16px, 4vw, 32px); display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .brand { display: flex; align-items: center; gap: 12px; flex: none; }
        .brand img { height: 38px; width: auto; }
        .menu { display: flex; align-items: center; gap: 2px; flex-wrap: wrap; }
        .menu > li { position: relative; }
        .menu-link, .menu-trigger { display: inline-flex; align-items: center; gap: 6px; padding: 8px 10px; border-radius: 999px; color: rgba(255,255,255,.88); font-size: .85rem; font-weight: 500; transition: background .2s, color .2s; white-space: nowrap; }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu > li.current > .menu-trigger { background: rgba(255,255,255,.1); color: #fff; }
        .menu-trigger i { font-size: .6rem; transition: transform .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); }
        .menu .btn-login { background: var(--signal); color: #fff; margin-left: 6px; font-weight: 600; padding: 8px 18px; }
        .menu .btn-login:hover { background: var(--signal-d); }
        .dropdown { display: none; position: absolute; top: calc(100% + 10px); left: 0; min-width: 260px; background: var(--ink-2); border: 1px solid rgba(255,255,255,.1); border-radius: var(--r-md); padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45); }
        .menu > li:nth-last-child(-n+4) .dropdown { left: auto; right: 0; }
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -10px; height: 10px; }
        .dropdown a { display: block; padding: 10px 14px; border-radius: var(--r-sm); font-size: .9rem; color: rgba(255,255,255,.85); line-height: 1.4; white-space: normal; }
        .dropdown a:hover, .dropdown a[aria-current="page"] { background: rgba(255,255,255,.1); color: #fff; }
        .dropdown .btn-logout { width: 100%; text-align: left; padding: 11px 14px; border-radius: var(--r-sm); font-size: .92rem; color: #ff8b8b; display: flex; align-items: center; gap: 8px; transition: background .2s, color .2s; cursor: pointer; }
        .dropdown .btn-logout:hover { background: rgba(255,255,255,.1); color: #ffb8b8; }
        .has-drop.open .dropdown { display: block; }
        @media (hover: hover) and (min-width: 1251px) { .has-drop:hover .dropdown { display: block; } }
        .nav-toggle { display: none; width: 44px; height: 44px; border-radius: 12px; color: #fff; font-size: 1.15rem; }
        .nav-toggle:hover { background: rgba(255,255,255,.1); }
        @media (max-width: 1250px) {
            .nav-toggle { display: inline-flex; align-items: center; justify-content: center; }
            .menu { display: none; position: fixed; top: var(--header-h); left: 0; right: 0; max-height: calc(100dvh - var(--header-h)); overflow-y: auto; flex-direction: column; align-items: stretch; gap: 4px; flex-wrap: nowrap; padding: 16px clamp(16px, 4vw, 32px) 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.1); }
            .nav-open .menu { display: flex; }
            .menu-link, .menu-trigger { width: 100%; justify-content: space-between; padding: 14px 16px; border-radius: 14px; font-size: 1rem; white-space: normal; }
            .dropdown { position: static; margin: 2px 0 8px 12px; box-shadow: none; background: transparent; border: 0; border-left: 2px solid rgba(255,255,255,.12); border-radius: 0; min-width: 100%; }
            .dropdown::before { display: none; }
            .menu .btn-login { margin: 8px 0 0; justify-content: center; padding: 14px; }
        }

        /* ==========================================================
           HERO HALAMAN
           ========================================================== */
        .page-hero { position: relative; isolation: isolate; overflow: hidden; color: #fff; background: var(--ink); padding: clamp(36px, 6vw, 64px) 0 clamp(72px, 10vw, 100px); }
        .page-hero::before { content: ""; position: absolute; inset: 0; z-index: -1; background: radial-gradient(60% 55% at 8% 100%, rgba(229,57,45,.38), transparent 70%), linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.84) 48%, rgba(13,27,42,.62) 100%), url('/images/background1.png') center / cover no-repeat; }
        .crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.7); margin-bottom: clamp(18px, 3vw, 26px); }
        .crumbs li { display: inline-flex; align-items: center; gap: 10px; }
        .crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; line-height: 1; }
        .crumbs a:hover { color: #fff; text-decoration: underline; text-underline-offset: 4px; }
        .crumbs [aria-current] { color: #fff; font-weight: 600; }
        .page-hero h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 82%; font-size: clamp(2.8rem, 8vw, 5.5rem); line-height: .95; letter-spacing: -0.035em; }
        .page-hero p { margin-top: 18px; max-width: 56ch; color: rgba(255,255,255,.75); font-size: clamp(1rem, 1.5vw, 1.15rem); }
        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* ==========================================================
           PILL TAB
           ========================================================== */
        .page-nav-wrap { display: flex; justify-content: center; margin-top: -30px; position: relative; z-index: 10; padding: 0 20px; }
        .page-nav { display: inline-flex; background: #fff; padding: 6px; border-radius: 999px; box-shadow: 0 12px 35px rgba(13,27,42,.1); gap: 4px; overflow-x: auto; max-width: 100%; border: 1px solid rgba(0,0,0,.04); scrollbar-width: none; }
        .page-nav::-webkit-scrollbar { display: none; }
        .page-nav button { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 999px; font-size: .9rem; font-weight: 700; color: var(--steel); white-space: nowrap; transition: .3s; }
        .page-nav button:hover { color: var(--ink-2); background: var(--soft); }
        .page-nav button.active { background: var(--ink); color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,.15); }
        .page-nav button.active i { color: var(--amber); }
        @media (max-width: 768px) { .page-nav { justify-content: flex-start; } .page-nav button { padding: 8px 16px; font-size: .85rem; } }

        /* ==========================================================
           KONTEN UMUM
           ========================================================== */
        .page-body { padding: 40px 0 clamp(64px, 9vw, 112px); min-height: 50vh; }
        .panel { display: none; animation: rise .5s both; }
        .panel.show { display: block; }
        .panel-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .panel-flat { }
        .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding: 22px 28px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.5rem; letter-spacing: -0.02em; }
        .panel-head .count { font-size: .85rem; font-weight: 700; color: var(--signal-d); background: #fdeceb; padding: 4px 14px; border-radius: 999px; }
        .empty { text-align: center; padding: 56px 24px; color: var(--steel); }
        .empty i { font-size: 2.4rem; color: #c8d1db; margin-bottom: 10px; }

        /* chip pos (tab Pemadam) */
        .chips { display: flex; gap: 8px; padding: 18px 28px 0; overflow-x: auto; scrollbar-width: thin; }
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

        .search { margin: 16px 28px 0; display: flex; align-items: center; gap: 10px; padding: 10px 18px; border: 1.5px solid var(--line); border-radius: 999px; background: var(--paper); max-width: 380px; transition: .2s; }
        .search:focus-within { border-color: var(--ink); background: #fff; box-shadow: 0 0 0 4px rgba(255,182,39,.4); }
        .search i { color: var(--steel); font-size: .9rem; }
        .search input { border: 0; background: none; outline: 0; width: 100%; font: inherit; font-size: .92rem; }

        .tbl-wrap { overflow-x: auto; padding: 16px 28px 28px; }
        table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: .92rem; }
        thead th { text-align: left; font-size: .72rem; text-transform: uppercase; letter-spacing: .07em; color: var(--steel); background: var(--paper); padding: 11px 14px; white-space: nowrap; }
        thead th:first-child { border-radius: 12px 0 0 12px; }
        thead th:last-child { border-radius: 0 12px 12px 0; }
        td { padding: 10px 14px; border-bottom: 1px solid var(--line); vertical-align: middle; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fafc; }
        tbody tr:last-child td { border-bottom: 0; }
        td.c-no, th.c-no { width: 52px; color: var(--steel); font-weight: 600; }
        td.c-img, th.c-img { width: 110px; }
        td.c-jml, th.c-jml { width: 90px; text-align: center; }
        td.c-nama { min-width: 220px; }
        td .nama { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: .98rem; line-height: 1.3; letter-spacing: -0.005em; color: var(--ink); }
        .jml { display: inline-block; min-width: 38px; padding: 3px 12px; border-radius: 8px; background: #eaf0ff; border: 1px solid #c9d8fb; color: var(--blue); font-weight: 700; font-size: .85rem; text-align: center; }
        td img { width: 88px; height: 62px; object-fit: cover; border-radius: 10px; border: 1px solid var(--line); }
        td .noimg { width: 88px; height: 62px; border-radius: 10px; border: 1px dashed var(--line); display: grid; place-items: center; color: #c0cad6; }
        td a.zoom { position: relative; display: inline-block; cursor: zoom-in; border-radius: 10px; }
        td a.zoom img { transition: transform .2s, box-shadow .2s; }
        td a.zoom:hover img { transform: scale(1.05); box-shadow: 0 10px 20px -8px rgba(13,27,42,.45); }
        td a.zoom::after { content: "\f00e"; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; right: 6px; bottom: 6px; width: 22px; height: 22px; border-radius: 50%; background: rgba(13,27,42,.7); color: #fff; font-size: .65rem; display: grid; place-items: center; opacity: 0; transition: opacity .2s; }
        td a.zoom:hover::after { opacity: 1; }
        .no-result { text-align: center; padding: 36px 16px; color: var(--steel); }

        /* ==========================================================
           PANEL RICH (Sumber Air & Hidrant Kota)
           ========================================================== */
        .rich { display: grid; gap: 20px; min-width: 0; }
        .rich-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); padding: clamp(20px, 3vw, 28px); }
        .rich-head h2 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.35rem, 2.6vw, 1.75rem); line-height: 1.2; letter-spacing: -0.015em; margin-bottom: 6px; }
        .rich-head p { color: var(--steel); font-size: .95rem; max-width: 56ch; }
        .total-pill { display: inline-flex; align-items: center; gap: 12px; padding: 10px 20px 10px 12px; border-radius: 999px; background: var(--ink); color: #fff; }
        .total-pill i { width: 40px; height: 40px; border-radius: 50%; display: grid; place-items: center; background: rgba(255,255,255,.12); color: #7dd3fc; }
        .total-pill b { display: block; font-family: var(--font-display); font-weight: 800; font-size: 1.5rem; line-height: 1; }
        .total-pill span { font-size: .75rem; color: rgba(255,255,255,.7); font-weight: 600; }

        /* kartu kategori (sumber air) */
        .cat-tabs { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        @media (max-width: 1100px) { .cat-tabs { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 420px) { .cat-tabs { grid-template-columns: 1fr; } }
        .tab-card { display: flex; align-items: center; gap: 14px; text-align: left; background: #fff; border: 1.5px solid var(--line); border-radius: var(--r-md); padding: 16px; transition: border-color .2s, transform .2s, box-shadow .2s, background .2s; }
        .tab-card:hover { transform: translateY(-2px); border-color: #b8c5d3; box-shadow: 0 14px 26px -14px rgba(13,27,42,.25); }
        .tab-ico { flex: none; width: 46px; height: 46px; border-radius: 14px; display: grid; place-items: center; font-size: 1.1rem; }
        .tone-red .tab-ico { background: #fef2f2; color: #dc2626; }
        .tone-blue .tab-ico { background: #eff6ff; color: #2563eb; }
        .tone-teal .tab-ico { background: #ecfeff; color: #0891b2; }
        .tone-amber .tab-ico { background: #fff7e6; color: #b7791f; }
        .tab-txt { min-width: 0; }
        .tab-num { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.6rem; line-height: 1; letter-spacing: -0.02em; }
        .tab-lbl { margin-top: 4px; font-size: .82rem; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .tab-desc { font-size: .74rem; color: var(--steel); font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .tab-card[aria-selected="true"] { background: var(--ink-2); border-color: var(--ink-2); box-shadow: 0 18px 30px -14px rgba(13,27,42,.5); }
        .tab-card[aria-selected="true"] .tab-num, .tab-card[aria-selected="true"] .tab-lbl { color: #fff; }
        .tab-card[aria-selected="true"] .tab-desc { color: rgba(255,255,255,.65); }
        .tab-card[aria-selected="true"] .tab-ico { background: rgba(255,255,255,.14); color: #fff; }

        /* statistik & kesiapan (hidrant) */
        .stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        @media (max-width: 1100px) { .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 480px) { .stats { grid-template-columns: 1fr; } }
        .stat { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 18px; }
        .stat-ico { flex: none; width: 46px; height: 46px; border-radius: 14px; display: grid; place-items: center; font-size: 1.1rem; background: #eef2ff; color: #1d4fd6; }
        .stat.ok .stat-ico { background: var(--ok-tint); color: var(--ok); }
        .stat.bad .stat-ico { background: var(--bad-tint); color: var(--bad); }
        .stat.geo .stat-ico { background: #fff7e6; color: #b7791f; }
        .stat-num { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.85rem; line-height: 1; letter-spacing: -0.02em; }
        .stat-lbl { margin-top: 4px; font-size: .8rem; font-weight: 600; color: var(--steel); }
        .ready { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 20px 22px; }
        .ready-top { display: flex; flex-wrap: wrap; align-items: baseline; justify-content: space-between; gap: 8px; margin-bottom: 12px; }
        .ready-top strong { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; }
        .ready-top span { font-size: .85rem; color: var(--steel); font-weight: 500; }
        .ready-pct { font-family: var(--font-display); font-weight: 800; font-size: 1.5rem; color: var(--ok); }
        .bar { height: 12px; border-radius: 999px; background: var(--bad-tint); overflow: hidden; border: 1px solid var(--bad-line); }
        .bar > i { display: block; height: 100%; border-radius: 999px; background: linear-gradient(90deg, #10b981, #059669); }
        .bar-legend { display: flex; flex-wrap: wrap; gap: 18px; margin-top: 12px; font-size: .82rem; font-weight: 600; color: var(--steel); }
        .bar-legend span { display: inline-flex; align-items: center; gap: 8px; }
        .bar-legend .sw { width: 10px; height: 10px; border-radius: 50%; }
        .bar-legend .sw.ok { background: #059669; } .bar-legend .sw.bad { background: #f87171; }

        /* toolbar */
        .toolbar { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px; display: grid; gap: 14px; }
        .toolbar-row { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
        .rsearch { position: relative; flex: 1 1 260px; min-width: 0; }
        .rsearch i.mag { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .9rem; pointer-events: none; }
        .rsearch input { width: 100%; height: 46px; padding: 0 44px; border-radius: 999px; border: 1.5px solid var(--line); background: var(--paper); font: inherit; font-size: .95rem; color: var(--ink); transition: border-color .2s, box-shadow .2s, background .2s; }
        .rsearch input:focus { outline: none; border-color: var(--ink-2); background: #fff; box-shadow: 0 0 0 4px rgba(19,42,67,.08); }
        .rsearch .clear { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 30px; height: 30px; border-radius: 50%; display: none; place-items: center; background: #e2e8f0; color: var(--steel); font-size: .75rem; }
        .rsearch .clear.show { display: grid; }
        .rsearch .clear:hover { background: var(--ink); color: #fff; }
        .select { position: relative; flex: 0 1 240px; min-width: 180px; }
        .select select { width: 100%; height: 46px; padding: 0 40px 0 18px; border-radius: 999px; border: 1.5px solid var(--line); background: var(--paper) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 16px center; appearance: none; -webkit-appearance: none; font: inherit; font-size: .92rem; font-weight: 600; color: var(--ink); cursor: pointer; }
        .select select:focus { outline: none; border-color: var(--ink-2); box-shadow: 0 0 0 4px rgba(19,42,67,.08); background-color: #fff; }
        .seg { display: inline-flex; padding: 4px; border-radius: 999px; background: var(--paper); border: 1.5px solid var(--line); }
        .seg button { display: inline-flex; align-items: center; gap: 8px; height: 36px; padding: 0 16px; border-radius: 999px; font-size: .85rem; font-weight: 700; color: var(--steel); transition: background .2s, color .2s; white-space: nowrap; }
        .seg button:hover { color: var(--ink); }
        .seg button[aria-pressed="true"] { background: var(--ink-2); color: #fff; }
        .kchips { display: flex; flex-wrap: wrap; gap: 8px; }
        .kchip { display: inline-flex; align-items: center; gap: 8px; height: 38px; padding: 0 16px; border-radius: 999px; border: 1.5px solid var(--line); background: #fff; font-size: .85rem; font-weight: 700; color: var(--steel); transition: all .2s; }
        .kchip:hover { border-color: var(--ink-2); color: var(--ink); }
        .kchip .cnt { font-size: .75rem; padding: 1px 8px; border-radius: 999px; background: var(--paper); color: var(--steel); }
        .kchip[aria-pressed="true"] { background: var(--ink-2); border-color: var(--ink-2); color: #fff; }
        .kchip[aria-pressed="true"] .cnt { background: rgba(255,255,255,.18); color: #fff; }
        .kchip.ok[aria-pressed="true"] { background: var(--ok); border-color: var(--ok); }
        .kchip.bad[aria-pressed="true"] { background: var(--bad); border-color: var(--bad); }
        .result-line { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; font-size: .88rem; color: var(--steel); font-weight: 500; }
        .result-line b { color: var(--ink); }
        .btn-reset { display: none; align-items: center; gap: 8px; font-weight: 700; font-size: .85rem; color: var(--signal-d); }
        .btn-reset.show { display: inline-flex; }
        .btn-reset:hover { text-decoration: underline; text-underline-offset: 3px; }

        /* kartu data */
        .sub-panel { display: grid; gap: 18px; animation: rise .3s ease; }
        .cards { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        @media (max-width: 700px) { .cards { grid-template-columns: 1fr; } }
        .w-card, .h-card { position: relative; display: flex; flex-direction: column; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 20px 20px 18px; overflow: hidden; transition: transform .25s, box-shadow .25s, border-color .25s; }
        .w-card::before, .h-card::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 5px; background: #dc2626; }
        .w-card.tone-blue::before { background: #2563eb; }
        .w-card.tone-teal::before { background: #0891b2; }
        .w-card.tone-amber::before { background: #d99a2b; }
        .h-card::before { background: var(--ok); }
        .h-card[data-kondisi="rusak"]::before { background: var(--bad); }
        .w-card:hover, .h-card:hover { transform: translateY(-3px); box-shadow: 0 18px 32px -14px rgba(13,27,42,.2); border-color: #c9d4e0; }
        .w-top { display: flex; align-items: flex-start; gap: 14px; }
        .w-num { flex: none; width: 38px; height: 38px; border-radius: 12px; display: grid; place-items: center; font-family: var(--font-display); font-weight: 800; font-size: .95rem; background: #eff6ff; color: #2563eb; }
        .w-title, .h-title { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.15rem; line-height: 1.25; letter-spacing: -0.01em; }
        .w-kind, .h-num { font-size: .72rem; font-weight: 800; letter-spacing: .06em; color: var(--steel); text-transform: uppercase; margin-bottom: 2px; }
        .w-addr { display: flex; gap: 10px; align-items: flex-start; padding: 12px 14px; border-radius: 12px; background: var(--paper); font-size: .88rem; color: var(--steel); }
        .w-addr i { margin-top: 4px; color: var(--signal); font-size: .8rem; }
        .w-fact { display: inline-flex; align-items: center; gap: 8px; align-self: flex-start; padding: 6px 12px; border-radius: 8px; background: #f1f5f9; border: 1px solid #e2e8f0; color: #475569; font-weight: 700; font-size: .82rem; }
        .w-fact i { color: #0891b2; }
        .h-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; }
        .h-near { margin-top: 4px; font-size: .86rem; color: var(--steel); display: flex; gap: 8px; align-items: flex-start; }
        .h-near i { margin-top: 4px; color: var(--signal); font-size: .75rem; }
        .h-meta { display: grid; gap: 8px; padding: 12px 14px; border-radius: 12px; background: var(--paper); font-size: .86rem; }
        .h-meta div { display: flex; gap: 10px; align-items: flex-start; }
        .h-meta i { width: 16px; text-align: center; margin-top: 4px; color: var(--steel); font-size: .8rem; }
        .h-meta span { color: var(--steel); }
        .h-meta b { color: var(--ink); font-weight: 600; }
        .h-tags { display: flex; flex-wrap: wrap; gap: 6px; }
        .h-tag { display: inline-flex; align-items: center; gap: 7px; padding: 4px 10px; border-radius: 8px; background: #f1f5f9; border: 1px solid #e2e8f0; font-size: .76rem; font-weight: 600; color: var(--steel); }
        .h-tag b { color: var(--ink); font-weight: 700; }
        .h-tag i { color: #0891b2; }
        .h-note { font-size: .86rem; color: var(--steel); }
        .h-note b { color: var(--ink); font-weight: 700; }
        .w-foot, .h-foot { margin-top: auto; display: flex; gap: 10px; }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: .8rem; border: 1px solid transparent; white-space: nowrap; flex: none; }
        .badge.baik { background: var(--ok-tint); color: var(--ok); border-color: var(--ok-line); }
        .badge.rusak { background: var(--bad-tint); color: var(--bad); border-color: var(--bad-line); }

        .btn-map { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 18px; background: var(--ink-2); color: #fff; border-radius: 999px; font-weight: 700; font-size: .86rem; transition: background .2s, transform .2s; white-space: nowrap; }
        .btn-map:hover { background: var(--signal); transform: translateY(-1px); }
        .w-foot .btn-map, .h-foot .btn-map { flex: 1; }
        .btn-map.disabled { background: #f1f5f9; color: #94a3b8; border: 1px solid var(--line); cursor: not-allowed; }
        .btn-map.disabled:hover { background: #f1f5f9; transform: none; }
        .btn-map.sm { padding: 8px 16px; font-size: .82rem; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-weight: 600; }
        .btn-map.sm:hover { background: #d1fae5; transform: translateY(-1px); }
        .btn-map.sm.disabled { background: #f1f5f9; color: #94a3b8; border-color: var(--line); }

        /* tabel rich */
        .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; }
        .table-scroll { overflow-x: auto; width: 100%; }
        .data-table { width: 100%; min-width: 820px; border-collapse: collapse; text-align: left; }
        .data-table thead th { background: #f1f5f9; color: #475569; font-weight: 700; font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; padding: 16px 20px; border-radius: 0; }
        .data-table tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); font-size: .93rem; }
        .data-table tbody tr:last-child td { border-bottom: 0; }
        .text-center { text-align: center !important; }
        .text-bold { font-weight: 700; color: #0f172a; }
        .sub { font-weight: 400; font-size: .85rem; color: var(--steel); }
        .badge-urut { display: inline-flex; justify-content: center; align-items: center; width: 28px; height: 28px; background: #eff6ff; color: #2563eb; border-radius: 6px; font-weight: 700; font-size: .85rem; }
        .badge-luas { background: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: .85rem; border: 1px solid #e2e8f0; }

        .more { display: flex; justify-content: center; }
        .btn-more { display: inline-flex; align-items: center; gap: 10px; height: 48px; padding: 0 28px; border-radius: 999px; background: #fff; border: 1.5px solid var(--line); font-weight: 700; font-size: .92rem; transition: all .2s; }
        .btn-more:hover { border-color: var(--ink-2); background: var(--ink-2); color: #fff; }
        .empty-state { text-align: center; padding: 56px 20px; color: var(--steel); background: #fff; border: 1px dashed #cbd5e1; border-radius: var(--r-md); }
        .empty-state i.big { font-size: 3rem; color: #cbd5e1; margin-bottom: 16px; }
        .empty-state h3 { font-family: var(--font-display); font-size: 1.15rem; color: var(--ink); margin-bottom: 4px; }
        .empty-actions { margin-top: 16px; display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }
        .empty-actions button { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 999px; background: var(--ink-2); color: #fff; font-weight: 700; font-size: .85rem; }
        .empty-actions button:hover { background: var(--signal); }
        .empty-actions button.ghost { background: #fff; color: var(--ink); border: 1.5px solid var(--line); }
        .empty-actions button.ghost:hover { background: var(--paper); border-color: var(--ink-2); }

        .report { position: relative; overflow: hidden; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px; padding: clamp(22px, 3vw, 32px); border-radius: var(--r-lg); color: #fff; background: linear-gradient(120deg, var(--ink) 0%, var(--ink-3) 100%); }
        .report::after { content: ""; position: absolute; right: -60px; top: -60px; width: 220px; height: 220px; border-radius: 50%; background: radial-gradient(circle, rgba(229,57,45,.5), transparent 70%); pointer-events: none; }
        .report-txt { position: relative; z-index: 1; max-width: 56ch; }
        .report-txt h3 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.3rem; line-height: 1.2; margin-bottom: 6px; }
        .report-txt p { font-size: .93rem; color: rgba(255,255,255,.75); }
        .report-act { position: relative; z-index: 1; display: flex; flex-wrap: wrap; gap: 10px; }
        .report-act a { display: inline-flex; align-items: center; gap: 10px; padding: 12px 22px; border-radius: 999px; font-weight: 700; font-size: .9rem; transition: transform .2s, background .2s; }
        .report-act a:hover { transform: translateY(-2px); }
        .report-act .wa { background: #25d366; color: #052e16; }
        .report-act .tel { background: rgba(255,255,255,.12); color: #fff; border: 1px solid rgba(255,255,255,.2); }
        .report-act .tel:hover { background: rgba(255,255,255,.2); }

        @media (max-width: 700px) {
            .panel-head, .chips { padding-left: 18px; padding-right: 18px; }
            .pos-info, .search { margin-left: 18px; margin-right: 18px; }
            .tbl-wrap { padding: 8px 18px 20px; overflow-x: visible; }
            .panel-card thead { display: none; }
            .panel-card table, .panel-card tbody { display: block; }
            .panel-card tbody tr { display: grid; grid-template-columns: 76px 1fr auto; gap: 4px 14px; align-items: center; padding: 14px 0; border-bottom: 1px solid var(--line); }
            .panel-card tbody tr:last-child { border-bottom: 0; }
            .panel-card td { display: block; border: 0; padding: 0; }
            td.c-no { display: none; }
            td.c-img { grid-column: 1; grid-row: 1 / span 3; width: auto; }
            td.c-nama { grid-column: 2; min-width: 0; }
            td.c-jml { grid-column: 3; grid-row: 1; width: auto; }
            td.c-etc { grid-column: 2 / -1; font-size: .85rem; color: var(--steel); }
            td img, td .noimg { width: 76px; height: 58px; }
            .pi-map { height: 220px; }
        }

        /* lightbox gambar */
        .lightbox { position: fixed; inset: 0; z-index: 100; display: none; align-items: center; justify-content: center; padding: 24px; background: rgba(7,14,24,.86); -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); }
        .lightbox.show { display: flex; }
        .lightbox img { max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; border-radius: var(--r-md); box-shadow: 0 30px 60px rgba(0,0,0,.5); }
        .lightbox .lb-close { position: absolute; top: 18px; right: 18px; width: 44px; height: 44px; border-radius: 50%; background: #fff; color: var(--ink); font-size: 1.1rem; display: grid; place-items: center; transition: background .2s; }
        .lightbox .lb-close:hover { background: var(--amber); }

        /* ==========================================================
           FOOTER (sama dengan beranda)
           ========================================================== */
        .footer { background: var(--ink); color: rgba(255,255,255,.7); padding: clamp(56px, 8vw, 96px) 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 1.2fr .8fr; gap: clamp(32px, 5vw, 64px); }
        .footer h3 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: #fff; margin-bottom: 16px; }
        .footer-about img { height: 96px; width: auto; margin-bottom: 20px; }
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
           TOMBOL LAPOR MENGAMBANG (sama dengan beranda)
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

        @media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } *, *::before, *::after { animation: none !important; transition: none !important; } }

        /* ==========================================================
           SIMERAH KOJA — VISUAL REFINEMENT (CSS ONLY)
           Tidak mengubah PHP, route, struktur data, atau JavaScript.
           ========================================================== */
        :root {
            --signal: #b91c1c;
            --signal-d: #991b1b;
            --paper: #f5f7fb;
            --line: #e2e8f0;
            --r-lg: 24px;
            --r-md: 17px;
            --r-sm: 11px;
        }
        body { background: #f4f6fa; color: #172338; }
        ::selection { background: rgba(185,28,28,.16); color: #7f1d1d; }
        .site-header {
            background: rgba(10, 22, 38, .94);
            border-bottom: 1px solid rgba(255,255,255,.09);
            box-shadow: 0 8px 28px rgba(7,18,32,.12);
        }
        .nav { min-height: 70px; }
        .brand { gap: 10px; }
        .brand img { height: 40px; object-fit: contain; transition: transform .2s ease; }
        .brand a:hover img { transform: translateY(-1px) scale(1.035); }
        .menu { gap: 3px; }
        .menu-link, .menu-trigger { padding: 9px 11px; font-size: .83rem; }
        .menu .btn-login { background: #b91c1c; box-shadow: 0 5px 14px rgba(185,28,28,.22); }
        .menu .btn-login:hover { background: #991b1b; }
        .dropdown { background: #10233a; border-color: rgba(255,255,255,.12); }
        .page-hero {
            padding: clamp(38px, 6vw, 76px) 0 clamp(68px, 9vw, 100px);
            background: #0d1b2a;
        }
        .page-hero::before {
            background:
                radial-gradient(ellipse at 8% 100%, rgba(185,28,28,.42), transparent 46%),
                radial-gradient(ellipse at 90% 5%, rgba(56,89,126,.24), transparent 38%),
                linear-gradient(100deg, rgba(9,21,36,.98), rgba(13,27,42,.82)),
                url('/images/background1.png') center / cover no-repeat;
        }
        .crumbs { font-size: .86rem; }
        .page-hero h1 {
            max-width: 1000px;
            font-size: clamp(2.55rem, 6.6vw, 5.1rem);
            line-height: .98;
            letter-spacing: -.045em;
            text-wrap: balance;
        }
        .page-hero p { max-width: 62ch; line-height: 1.75; }
        .page-nav-wrap { margin-top: -28px; padding: 0 18px; }
        .page-nav {
            padding: 7px; gap: 5px;
            border: 1px solid rgba(226,232,240,.9);
            box-shadow: 0 16px 38px rgba(15,23,42,.13);
        }
        .page-nav button { padding: 11px 20px; font-size: .88rem; }
        .page-nav button.active { background: #142a43; box-shadow: 0 5px 14px rgba(13,27,42,.2); }
        .page-nav button.active i { color: #fecaca; }
        .page-body { padding-top: 38px; }
        .panel-card, .rich-head, .tab-card, .stat, .ready, .toolbar,
        .table-wrap, .w-card, .h-card, .empty-state {
            box-shadow: 0 4px 16px rgba(15,23,42,.035);
        }
        .panel-card { border-color: #e3e8ef; box-shadow: 0 12px 32px rgba(15,23,42,.045); }
        .panel-head { padding: 24px 28px; }
        .panel-head h2, .rich-head h2 { color: #12243a; }
        .panel-head .count { color: #991b1b; background: #fef2f2; }
        .chips { padding-top: 20px; }
        .chip { background: #fff; }
        .chip.active { background: #b91c1c; border-color: #b91c1c; box-shadow: 0 8px 18px rgba(185,28,28,.2); }
        .pos-info { background: linear-gradient(135deg,#fff,#f8fafc); }
        .btn-maps { background: #fff1f2; color: #991b1b; border-color: #fecaca; }
        .btn-maps:hover { background: #b91c1c; border-color: #b91c1c; }
        .search { background: #f8fafc; }
        .search:focus-within { border-color: #b91c1c; box-shadow: 0 0 0 4px rgba(185,28,28,.09); }
        thead th { background: #f3f6fa; color: #526176; }
        tbody tr:hover { background: #f8fafc; }
        .jml { background: #eff6ff; border-color: #dbeafe; color: #1d4ed8; }
        .rich { gap: 22px; }
        .rich-head {
            border-radius: 22px; padding: clamp(22px,3vw,32px);
            background: linear-gradient(135deg,#fff 0%,#fbfcfe 100%);
        }
        .total-pill { background: linear-gradient(135deg,#10243b,#1d3b5d); box-shadow: 0 8px 18px rgba(13,27,42,.12); }
        .cat-tabs { gap: 16px; }
        .tab-card { padding: 18px; border-color: #e1e7ef; }
        .tab-card[aria-selected="true"] {
            background: linear-gradient(135deg,#132a43,#1e3c5d);
            border-color: #132a43;
            box-shadow: 0 14px 26px rgba(13,27,42,.17);
        }
        .stats { gap: 16px; }
        .stat { padding: 20px; border-radius: 17px; }
        .stat-num { letter-spacing: -.04em; }
        .ready { padding: 22px 24px; }
        .bar { height: 13px; }
        .toolbar { padding: 18px; border-radius: 18px; }
        .rsearch input, .select select { background-color: #f8fafc; }
        .rsearch input:focus { border-color: #1d3b5d; box-shadow: 0 0 0 4px rgba(29,59,93,.09); }
        .seg button[aria-pressed="true"], .kchip[aria-pressed="true"] { background: #183451; border-color: #183451; }
        .kchip.ok[aria-pressed="true"] { background: #047857; border-color: #047857; }
        .kchip.bad[aria-pressed="true"] { background: #b91c1c; border-color: #b91c1c; }
        .w-card, .h-card { padding: 22px; border-radius: 18px; }
        .w-card::before, .h-card::before { width: 4px; }
        .w-num { border-radius: 12px; }
        .w-addr, .h-meta { background: #f6f8fb; }
        .badge.baik { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }
        .badge.rusak { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        .btn-map { background: #173653; box-shadow: 0 4px 10px rgba(13,27,42,.08); }
        .btn-map:hover { background: #b91c1c; }
        .btn-map.sm { box-shadow: none; }
        .data-table thead th { background: #f4f6fa; }
        .data-table tbody tr { transition: background .18s ease; }
        .data-table tbody tr:hover { background: #fafbfe; }
        .btn-more { box-shadow: 0 4px 14px rgba(15,23,42,.04); }
        .btn-more:hover { background: #173653; border-color: #173653; }
        .report {
            background: radial-gradient(circle at 90% 10%,rgba(185,28,28,.24),transparent 35%),linear-gradient(120deg,#0b1929,#193653);
            box-shadow: 0 16px 34px rgba(13,27,42,.13);
        }
        .report-act .wa { background: #22c55e; color: #052e16; }
        .report-act .tel { background: rgba(255,255,255,.1); }
        .footer { background: #091522; }
        .footer-about img { object-fit: contain; }
        .map { border: 1px solid rgba(255,255,255,.1); }
        .sos-fab-btn {
            background: #b91c1c;
            box-shadow: 0 12px 28px rgba(185,28,28,.32);
        }
        .sos-fab-btn:hover { background: #991b1b; }
        .sos-sheet { background: #0d1b2a; }
        .lightbox { cursor: zoom-out; }
        .lightbox img { cursor: default; }
        button, a, input, select { -webkit-tap-highlight-color: transparent; }
        @media (min-width: 1251px) {
            .nav { gap: 18px; }
            .menu { flex-wrap: nowrap; }
        }
        @media (max-width: 1250px) {
            .menu { top: 70px; max-height: calc(100dvh - 70px); }
            .menu-link, .menu-trigger { padding: 13px 15px; }
            .dropdown { margin-left: 8px; }
        }
        @media (max-width: 700px) {
            .nav { min-height: 64px; }
            .brand { gap: 7px; }
            .brand img { height: 33px; max-width: 68px; }
            .nav-toggle { width: 42px; height: 42px; }
            .menu { top: 64px; max-height: calc(100dvh - 64px); }
            .page-hero { padding: 32px 0 66px; }
            .crumbs { gap: 7px; margin-bottom: 18px; font-size: .78rem; }
            .crumbs li { gap: 7px; }
            .page-hero h1 { font-size: clamp(2.35rem, 11vw, 3.65rem); line-height: 1; }
            .page-hero p { margin-top: 14px; font-size: .96rem; }
            .page-nav-wrap { margin-top: -25px; padding: 0 12px; justify-content: stretch; }
            .page-nav { display: flex; width: 100%; border-radius: 17px; padding: 6px; }
            .page-nav button { flex: 0 0 auto; padding: 10px 14px; font-size: .82rem; }
            .page-body { padding-top: 28px; padding-bottom: 64px; }
            .panel-card { border-radius: 18px; }
            .panel-head { padding: 20px 18px; align-items: flex-start; }
            .panel-head h2 { font-size: 1.28rem; }
            .rich { gap: 15px; }
            .rich-head { border-radius: 18px; padding: 20px; align-items: flex-start; }
            .rich-head p { font-size: .9rem; }
            .total-pill { padding: 9px 15px 9px 10px; }
            .total-pill i { width: 35px; height: 35px; }
            .cat-tabs, .stats { gap: 10px; }
            .tab-card { padding: 13px; gap: 11px; border-radius: 15px; }
            .tab-ico, .stat-ico { width: 41px; height: 41px; border-radius: 12px; }
            .tab-num { font-size: 1.42rem; }
            .tab-lbl { white-space: normal; line-height: 1.25; }
            .tab-desc { white-space: normal; line-height: 1.35; }
            .stat { padding: 15px; gap: 11px; }
            .stat-num { font-size: 1.6rem; }
            .stat-lbl { line-height: 1.35; }
            .ready { padding: 18px; }
            .toolbar { padding: 13px; gap: 12px; }
            .toolbar-row { gap: 9px; }
            .rsearch { flex-basis: 100%; }
            .select { flex: 1 1 100%; min-width: 0; }
            .seg { width: 100%; }
            .seg button { flex: 1; justify-content: center; padding: 0 10px; }
            .kchips { gap: 7px; }
            .kchip { height: 35px; padding: 0 12px; font-size: .8rem; }
            .cards { gap: 12px; }
            .w-card, .h-card { padding: 18px 16px 16px; gap: 12px; border-radius: 16px; }
            .w-title, .h-title { font-size: 1.06rem; }
            .w-foot, .h-foot { flex-wrap: wrap; }
            .w-foot .btn-map, .h-foot .btn-map { flex-basis: 100%; }
            .table-scroll { -webkit-overflow-scrolling: touch; }
            .data-table thead th, .data-table tbody td { padding: 13px 14px; }
            .report { border-radius: 19px; padding: 22px 19px; gap: 18px; }
            .report-txt h3 { font-size: 1.2rem; }
            .report-act { width: 100%; }
            .report-act a { flex: 1 1 100%; justify-content: center; }
            .footer { padding-top: 48px; }
            .footer-about img { height: 78px; }
            .footer-bar { align-items: flex-start; flex-direction: column; }
            .sos-fab-btn { padding: 13px 17px; font-size: .9rem; }
        }
        @media (max-width: 380px) {
            .wrap { padding-left: 13px; padding-right: 13px; }
            .brand img { height: 29px; max-width: 57px; }
            .page-hero h1 { font-size: 2.2rem; }
            .tab-card { gap: 9px; padding: 11px; }
            .tab-ico { width: 36px; height: 36px; }
            .tab-num { font-size: 1.3rem; }
            .total-pill b { font-size: 1.3rem; }
        }

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

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="menu" id="menu">
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan Kedaruratan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="tel:112">Call Center 112</a></li>
                    <li><a href="tel:{{ $no_telepon }}">Telp</a></li>
                    <li><a href="{{ $wa_link }}" target="_blank" rel="noopener">WA</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/public-sigap">Sigapkar</a></li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                    <li><a href="#">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                    <li><a href="#">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
                    <li><a href="/layanan-fasilitas/skk">Permohonan Sertifikat Keselamatan Kebakaran</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Produk Hukum <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/produkhukum">Undang-Undang</a></li>
                    <li><a href="/produkhukum">Peraturan Pemerintah</a></li>
                    <li><a href="/produkhukum">Peraturan Menteri</a></li>
                    <li><a href="/produkhukum">Peraturan Daerah</a></li>
                    <li><a href="/produkhukum">Peraturan Kepala Daerah</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Profil <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="#">Visi Misi</a></li>
                    <li><a href="/sotk">SOTK</a></li>
                    <li><a href="#">Tupoksi</a></li>
                    <li><a href="#">Kepegawaian</a></li>
                    <li><a href="#">Program Kegiatan</a></li>
                    <li><a href="#">Cascading</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">SOP <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/sop">Pencegahan</a></li>
                    <li><a href="/sop">Pemadaman Kebakaran</a></li>
                    <li><a href="/sop">Penyelamatan dan Evakuasi</a></li>
                    <li><a href="/sop">Sarana dan Prasarana</a></li>
                    <li><a href="/sop">Kepegawaian</a></li>
                    <li><a href="/sop">Keuangan</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Dokumen <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/perencanaan">Renstra</a></li>
                    <li><a href="/perencanaan">Renja</a></li>
                    <li><a href="#">SPM</a></li>
                    <li><a href="#">SAKIP</a></li>
                    <li><a href="/pelaporan">LPPD</a></li>
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
                    <li><a href="#">IKM</a></li>
                    <li><a href="#">Pengumuman</a></li>
                    <li><a href="{{ route('publik.infografis') ?? '#' }}">Berita</a></li>
                </ul>
            </li>

            @if(session()->has('pemohon_id'))
                <li class="has-drop">
                    <button class="menu-trigger btn-login" type="button" aria-expanded="false">
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
                <li><a class="menu-link btn-login" href="{{ route('pemohon.login') }}">Masuk</a></li>
            @endif
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
                    <li>Sarpras</li>
                    <li aria-current="page">@yield('judul')</li>
                </ol>
            </nav>
            <h1 class="rise d1">@yield('judul')</h1>
            <p class="rise d2">@yield('deskripsi')</p>
        </div>
    </section>

    {{-- PILL NAV --}}
    <div class="page-nav-wrap">
        <nav class="page-nav" aria-label="Sub menu @yield('judul')">
            @foreach($tabs as $key => $t)
                <button type="button" data-tab="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}">
                    <i class="fas {{ $t['ico'] }}"></i> {{ $t['label'] }}
                </button>
            @endforeach
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

            {{-- ============================================================
                 TAB: SUMBER AIR
                 ============================================================ --}}
            @if($key === 'sumber-air')
                @php
                    $rows = collect($t['data']);
                    $defs = [
                        ['id' => 'pilar',  'kat' => 'Hidrant Pilar',  'ico' => 'fa-faucet-drip', 'tone' => 'red',   'field' => null,     'fieldLabel' => null,            'nameLabel' => 'Lokasi / Area', 'desc' => 'Hidrant di tepi jalan'],
                        ['id' => 'gedung', 'kat' => 'Hidrant Gedung', 'ico' => 'fa-building',    'tone' => 'blue',  'field' => 'jumlah', 'fieldLabel' => 'Jumlah (Unit)', 'nameLabel' => 'Nama Gedung',   'desc' => 'Hidrant di dalam gedung'],
                        ['id' => 'embung', 'kat' => 'Embung',         'ico' => 'fa-water',       'tone' => 'teal',  'field' => 'luas',   'fieldLabel' => 'Kapasitas Air', 'nameLabel' => 'Nama Lokasi',   'desc' => 'Tampungan air buatan'],
                        ['id' => 'danau',  'kat' => 'Danau',          'ico' => 'fa-droplet',     'tone' => 'amber', 'field' => 'luas',   'fieldLabel' => 'Kapasitas Air', 'nameLabel' => 'Nama Danau',    'desc' => 'Sumber air alami'],
                    ];
                    $groups = collect($defs)->map(function ($g) use ($rows) {
                        $g['data'] = $rows->filter(function ($r) use ($g) {
                            return strcasecmp(trim((string) ($r->kategori ?? '')), $g['kat']) === 0;
                        })->values();
                        return $g;
                    })->all();
                    $totalSemua = $rows->count();
                @endphp
                <section class="panel {{ $loop->first ? 'show' : '' }}" id="panel-{{ $key }}" data-panel="{{ $key }}" data-type="sumber">
                    <div class="rich">
                        <div class="rich-head">
                            <div>
                                <h2>{{ $t['label'] }}</h2>
                                <p>Pilih jenis sumber air, cari lokasi terdekat, lalu buka petanya langsung di Google Maps.</p>
                            </div>
                            <div class="total-pill">
                                <i class="fas fa-droplet"></i>
                                <div><b>{{ $totalSemua }}</b><span>Total titik sumber air</span></div>
                            </div>
                        </div>

                        <div class="cat-tabs" role="tablist" aria-label="Jenis sumber air">
                            @foreach($groups as $g)
                                <button type="button" role="tab" class="tab-card tone-{{ $g['tone'] }}" data-sub="{{ $g['id'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    <span class="tab-ico"><i class="fas {{ $g['ico'] }}"></i></span>
                                    <span class="tab-txt">
                                        <div class="tab-num" data-total="{{ $g['data']->count() }}">{{ $g['data']->count() }}</div>
                                        <div class="tab-lbl">{{ $g['kat'] }}</div>
                                        <div class="tab-desc">{{ $g['desc'] }}</div>
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        <div class="toolbar">
                            <div class="toolbar-row">
                                <label class="rsearch">
                                    <span class="sr-only">Cari nama lokasi atau alamat</span>
                                    <i class="fas fa-search mag"></i>
                                    <input type="text" data-q placeholder="Cari nama lokasi atau alamat..." autocomplete="off">
                                    <button type="button" class="clear" data-clear aria-label="Hapus pencarian"><i class="fas fa-times"></i></button>
                                </label>
                                <div class="seg" role="group" aria-label="Tampilan data">
                                    <button type="button" data-view="card" aria-pressed="true"><i class="fas fa-table-cells-large"></i> Kartu</button>
                                    <button type="button" data-view="table" aria-pressed="false"><i class="fas fa-list"></i> Tabel</button>
                                </div>
                            </div>
                            <div class="result-line" data-result aria-live="polite"></div>
                        </div>

                        @foreach($groups as $g)
                            @php $cnt = $g['data']->count(); @endphp
                            <div class="sub-panel" data-sub-panel="{{ $g['id'] }}" data-total="{{ $cnt }}" @if(!$loop->first) hidden @endif>
                                @if($cnt > 0)
                                    <div class="cards" data-cards>
                                        @foreach($g['data'] as $item)
                                            @php
                                                $href = $mapHref($item->kode_maps ?? null);
                                                $num  = $g['id'] === 'pilar' ? ($item->no_urut ?? $loop->iteration) : $loop->iteration;
                                                $fact = $g['field'] ? ($item->{$g['field']} ?? null) : null;
                                                $hay  = strtolower(trim(($item->nama_gedung ?? '') . ' ' . ($item->alamat ?? '')));
                                            @endphp
                                            <article class="w-card tone-{{ $g['tone'] }} h-item" data-search="{{ $hay }}">
                                                <div class="w-top">
                                                    <span class="w-num">{{ $num }}</span>
                                                    <div>
                                                        <div class="w-kind">{{ $g['kat'] }}</div>
                                                        <h3 class="w-title">{{ $item->nama_gedung }}</h3>
                                                    </div>
                                                </div>
                                                <div class="w-addr"><i class="fas fa-location-dot"></i><span>{{ ($item->alamat ?? '') !== '' ? $item->alamat : '-' }}</span></div>
                                                @if($g['field'] && $fact !== null && $fact !== '' && $fact !== '-')
                                                    <span class="w-fact"><i class="fas {{ $g['field'] === 'jumlah' ? 'fa-hashtag' : 'fa-water' }}"></i> {{ $g['fieldLabel'] }}: {{ $fact }}</span>
                                                @endif
                                                <div class="w-foot">
                                                    @if($href)
                                                        <a href="{{ $href }}" target="_blank" rel="noopener" class="btn-map"><i class="fas fa-location-arrow"></i> Buka di Google Maps</a>
                                                    @else
                                                        <span class="btn-map disabled"><i class="fas fa-ban"></i> Peta belum tersedia</span>
                                                    @endif
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>

                                    <div class="table-wrap" data-table hidden>
                                        <div class="table-scroll">
                                            <table class="data-table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="6%">NO</th>
                                                        <th>{{ strtoupper($g['nameLabel']) }}</th>
                                                        <th>ALAMAT</th>
                                                        @if($g['field'])<th class="text-center">{{ strtoupper($g['fieldLabel']) }}</th>@endif
                                                        <th class="text-center">MAPS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($g['data'] as $item)
                                                        @php
                                                            $href = $mapHref($item->kode_maps ?? null);
                                                            $num  = $g['id'] === 'pilar' ? ($item->no_urut ?? $loop->iteration) : $loop->iteration;
                                                            $fact = $g['field'] ? ($item->{$g['field']} ?? null) : null;
                                                            $hay  = strtolower(trim(($item->nama_gedung ?? '') . ' ' . ($item->alamat ?? '')));
                                                        @endphp
                                                        <tr class="h-item" data-search="{{ $hay }}">
                                                            <td class="text-center">
                                                                @if($g['id'] === 'pilar')<span class="badge-urut">{{ $num }}</span>@else<span style="color:var(--steel)">{{ $num }}</span>@endif
                                                            </td>
                                                            <td class="text-bold">{{ $item->nama_gedung }}</td>
                                                            <td style="color:#475569">{{ $item->alamat ?? '-' }}</td>
                                                            @if($g['field'])<td class="text-center"><span class="badge-luas">{{ ($fact !== null && $fact !== '' && $fact !== '-') ? $fact : '-' }}</span></td>@endif
                                                            <td class="text-center">
                                                                @if($href)
                                                                    <a href="{{ $href }}" target="_blank" rel="noopener" class="btn-map sm"><i class="fas fa-location-dot"></i> Buka Map</a>
                                                                @else
                                                                    <span class="btn-map sm disabled"><i class="fas fa-ban"></i> Kosong</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="empty-state" data-nohit hidden>
                                        <i class="fas fa-magnifying-glass-location big"></i>
                                        <h3>Lokasi tidak ditemukan</h3>
                                        <p>Tidak ada hasil untuk pencarian ini di kategori <b>{{ $g['kat'] }}</b>.</p>
                                        <div class="empty-actions" data-others></div>
                                    </div>

                                    <div class="more"><button type="button" class="btn-more" data-more hidden><i class="fas fa-angles-down"></i> <span>Tampilkan lebih banyak</span></button></div>
                                @else
                                    <div class="empty-state">
                                        <i class="fas {{ $g['ico'] }} big"></i>
                                        <h3>Data kosong</h3>
                                        <p>Belum ada data {{ $g['kat'] }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <aside class="report">
                            <div class="report-txt">
                                <h3>Tahu lokasi sumber air yang belum terdata?</h3>
                                <p>Kabari kami lokasi hidrant, embung, atau sumber air lain yang bisa dipakai untuk pemadaman, agar bisa kami verifikasi dan tambahkan ke peta.</p>
                            </div>
                            <div class="report-act">
                                <a class="wa" href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Kabari via WhatsApp</a>
                                <a class="tel" href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> {{ $telepon_tampil }}</a>
                            </div>
                        </aside>
                    </div>
                </section>

            {{-- ============================================================
                 TAB: DATA HIDRANT KOTA
                 ============================================================ --}}
            @elseif($key === 'hidrant')
                @php
        $semua    = collect($t['data']);
        $total    = $semua->count();
        $isBaikFn = function ($i) { return strtolower(trim((string) ($i->kondisi_hidran ?? ''))) === 'baik'; };
        $jmlBaik  = $semua->filter($isBaikFn)->count();
        $jmlRusak = $total - $jmlBaik;
        $persen   = $total > 0 ? round(($jmlBaik / $total) * 100) : 0;
        
        // PERBAIKAN: Ubah semua jadi huruf kecil dulu, lalu jadikan Kapital di Awal Kata (Title Case), baru disaring unique()
        $listKec  = $semua->pluck('kecamatan')
                          ->filter()
                          ->map(fn ($k) => ucwords(strtolower(trim($k))))
                          ->unique()
                          ->sort()
                          ->values();
    @endphp
    <section class="panel {{ $loop->first ? 'show' : '' }}" id="panel-{{ $key }}" data-panel="{{ $key }}" data-type="hidrant" data-total="{{ $total }}">
                    <div class="rich">
                        <div class="rich-head">
                            <div>
                                <h2>{{ $t['label'] }}</h2>
                                <p>Cari hidrant terdekat dari lokasi Anda, lihat kondisinya, lalu buka petanya langsung di Google Maps.</p>
                            </div>
                        </div>

                        <div class="stats" aria-label="Ringkasan data hidrant">
                            <div class="stat"><div class="stat-ico"><i class="fas fa-faucet-drip"></i></div><div><div class="stat-num">{{ $total }}</div><div class="stat-lbl">Total titik hidrant</div></div></div>
                            <div class="stat ok"><div class="stat-ico"><i class="fas fa-circle-check"></i></div><div><div class="stat-num">{{ $jmlBaik }}</div><div class="stat-lbl">Kondisi baik</div></div></div>
                            <div class="stat bad"><div class="stat-ico"><i class="fas fa-triangle-exclamation"></i></div><div><div class="stat-num">{{ $jmlRusak }}</div><div class="stat-lbl">Perlu perbaikan</div></div></div>
                            <div class="stat geo"><div class="stat-ico"><i class="fas fa-map-location-dot"></i></div><div><div class="stat-num">{{ $listKec->count() }}</div><div class="stat-lbl">Kecamatan terjangkau</div></div></div>
                        </div>

                        @if($total > 0)
                            <div class="ready">
                                <div class="ready-top">
                                    <div>
                                        <strong>Tingkat kesiapan hidrant</strong><br>
                                        <span>{{ $jmlBaik }} dari {{ $total }} titik siap digunakan untuk pemadaman</span>
                                    </div>
                                    <div class="ready-pct">{{ $persen }}%</div>
                                </div>
                                <div class="bar" role="progressbar" aria-valuenow="{{ $persen }}" aria-valuemin="0" aria-valuemax="100" aria-label="Persentase hidrant kondisi baik"><i style="width: {{ $persen }}%"></i></div>
                                <div class="bar-legend">
                                    <span><i class="sw ok"></i> Baik ({{ $jmlBaik }})</span>
                                    <span><i class="sw bad"></i> Rusak ({{ $jmlRusak }})</span>
                                </div>
                            </div>

                            <div class="toolbar">
                                <div class="toolbar-row">
                                    <label class="rsearch">
                                        <span class="sr-only">Cari nama jalan, kelurahan, atau kecamatan</span>
                                        <i class="fas fa-search mag"></i>
                                        <input type="text" data-q placeholder="Cari jalan, kelurahan, atau kecamatan..." autocomplete="off">
                                        <button type="button" class="clear" data-clear aria-label="Hapus pencarian"><i class="fas fa-times"></i></button>
                                    </label>
                                    <label class="select">
                                        <span class="sr-only">Filter kecamatan</span>
                                        <select data-kec>
                                            <option value="">Semua kecamatan</option>
                                            @foreach($listKec as $kec)
                                                <option value="{{ strtolower($kec) }}">{{ $kec }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <div class="seg" role="group" aria-label="Tampilan data">
                                        <button type="button" data-view="card" aria-pressed="true"><i class="fas fa-table-cells-large"></i> Kartu</button>
                                        <button type="button" data-view="table" aria-pressed="false"><i class="fas fa-list"></i> Tabel</button>
                                    </div>
                                </div>
                                <div class="kchips" role="group" aria-label="Filter kondisi">
                                    <button type="button" class="kchip" data-kondisi="" aria-pressed="true">Semua <span class="cnt">{{ $total }}</span></button>
                                    <button type="button" class="kchip ok" data-kondisi="baik" aria-pressed="false"><i class="fas fa-circle-check"></i> Baik <span class="cnt">{{ $jmlBaik }}</span></button>
                                    <button type="button" class="kchip bad" data-kondisi="rusak" aria-pressed="false"><i class="fas fa-circle-xmark"></i> Rusak <span class="cnt">{{ $jmlRusak }}</span></button>
                                </div>
                                <div class="result-line">
                                    <span data-result>Menampilkan <b>{{ $total }}</b> hidrant</span>
                                    <button type="button" class="btn-reset" data-reset><i class="fas fa-rotate-left"></i> Atur ulang filter</button>
                                </div>
                            </div>

                            <div class="cards" data-cards>
                                @foreach($semua as $item)
                                    @php
                                        $isBaik = $isBaikFn($item);
                                        $href   = $mapHref($item->kode_map ?? null);
                                        $hay    = strtolower(trim(($item->jalan ?? '') . ' ' . ($item->lokasi_terdekat ?? '') . ' ' . ($item->kecamatan ?? '') . ' ' . ($item->kelurahan ?? '') . ' ' . ($item->keterangan ?? '')));
                                    @endphp
                                    <article class="h-card h-item" data-kondisi="{{ $isBaik ? 'baik' : 'rusak' }}" data-kec="{{ strtolower(trim((string) ($item->kecamatan ?? ''))) }}" data-search="{{ $hay }}">
                                        <div class="h-card-top">
                                            <div>
                                                <div class="h-num">Hidrant #{{ $loop->iteration }}</div>
                                                <h3 class="h-title">{{ $item->jalan ?? '-' }}</h3>
                                                <div class="h-near"><i class="fas fa-location-crosshairs"></i><span>Terdekat: {{ $item->lokasi_terdekat ?? '-' }}</span></div>
                                            </div>
                                            @if($isBaik)
                                                <span class="badge baik"><i class="fas fa-check-circle"></i> Baik</span>
                                            @else
                                                <span class="badge rusak"><i class="fas fa-times-circle"></i> Rusak</span>
                                            @endif
                                        </div>
                                        <div class="h-meta">
                                            <div><i class="fas fa-city"></i><span>Kecamatan <b>{{ $item->kecamatan ?? '-' }}</b></span></div>
                                            <div><i class="fas fa-location-dot"></i><span>Kelurahan <b>{{ $item->kelurahan ?? '-' }}</b> &middot; RT <b>{{ $item->rt ?? '-' }}</b></span></div>
                                        </div>
                                        @if(!empty($item->tekanan) || !empty($item->machino))
                                            <div class="h-tags">
                                                @if(!empty($item->tekanan))<span class="h-tag"><i class="fas fa-gauge-high"></i> Tekanan: <b>{{ $item->tekanan }}</b></span>@endif
                                                @if(!empty($item->machino))<span class="h-tag"><i class="fas fa-gears"></i> Machino: <b>{{ $item->machino }}</b></span>@endif
                                            </div>
                                        @endif
                                        @if(!empty($item->keterangan))
                                            <p class="h-note"><b>Catatan:</b> {{ $item->keterangan }}</p>
                                        @endif
                                        <div class="h-foot">
                                            @if($href)
                                                <a href="{{ $href }}" target="_blank" rel="noopener" class="btn-map"><i class="fas fa-location-arrow"></i> Buka di Google Maps</a>
                                            @else
                                                <span class="btn-map disabled"><i class="fas fa-ban"></i> Peta belum tersedia</span>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            <div class="table-wrap" data-table hidden>
                                <div class="table-scroll">
                                    <table class="data-table" style="min-width: 980px;">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="5%">NO</th>
                                                <th width="24%">JALAN / LOKASI TERDEKAT</th>
                                                <th width="18%">KEC / KELURAHAN</th>
                                                <th class="text-center" width="10%">KONDISI</th>
                                                <th width="14%">TEKANAN &amp; MACHINO</th>
                                                <th width="17%">KETERANGAN</th>
                                                <th class="text-center" width="12%">MAPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($semua as $item)
                                                @php
                                                    $isBaik = $isBaikFn($item);
                                                    $href   = $mapHref($item->kode_map ?? null);
                                                    $hay    = strtolower(trim(($item->jalan ?? '') . ' ' . ($item->lokasi_terdekat ?? '') . ' ' . ($item->kecamatan ?? '') . ' ' . ($item->kelurahan ?? '') . ' ' . ($item->keterangan ?? '')));
                                                @endphp
                                                <tr class="h-item" data-kondisi="{{ $isBaik ? 'baik' : 'rusak' }}" data-kec="{{ strtolower(trim((string) ($item->kecamatan ?? ''))) }}" data-search="{{ $hay }}">
                                                    <td class="text-center" style="color:var(--steel)">{{ $loop->iteration }}</td>
                                                    <td class="text-bold">{{ $item->jalan ?? '-' }}<br><span class="sub">Terdekat: {{ $item->lokasi_terdekat ?? '-' }}</span></td>
                                                    <td>{{ $item->kecamatan ?? '-' }}<br><span class="sub">Kel. {{ $item->kelurahan ?? '-' }} (RT {{ $item->rt ?? '-' }})</span></td>
                                                    <td class="text-center">
                                                        @if($isBaik)<span class="badge baik"><i class="fas fa-check-circle"></i> Baik</span>@else<span class="badge rusak"><i class="fas fa-times-circle"></i> Rusak</span>@endif
                                                    </td>
                                                    <td><span class="sub">Tekanan:</span> {{ $item->tekanan ?? '-' }}<br><span class="sub">Machino:</span> {{ $item->machino ?? '-' }}</td>
                                                    <td style="font-size:.9rem;color:var(--steel)">{{ $item->keterangan ?? '-' }}</td>
                                                    <td class="text-center">
                                                        @if($href)
                                                            <a href="{{ $href }}" target="_blank" rel="noopener" class="btn-map sm"><i class="fas fa-location-dot"></i> Buka Map</a>
                                                        @else
                                                            <span class="btn-map sm disabled"><i class="fas fa-ban"></i> Kosong</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="empty-state" data-nohit hidden>
                                <i class="fas fa-map-location-dot big"></i>
                                <h3>Hidrant tidak ditemukan</h3>
                                <p>Coba kata kunci lain atau ubah filter kecamatan dan kondisi.</p>
                                <div class="empty-actions"><button type="button" data-reset><i class="fas fa-rotate-left"></i> Atur ulang filter</button></div>
                            </div>

                            <div class="more"><button type="button" class="btn-more" data-more hidden><i class="fas fa-angles-down"></i> <span>Tampilkan lebih banyak</span></button></div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-map-location-dot big"></i>
                                <h3>Data kosong</h3>
                                <p>Belum ada data Hidrant Kota</p>
                            </div>
                        @endif

                        <aside class="report">
                            <div class="report-txt">
                                <h3>Menemukan hidrant rusak atau tersumbat?</h3>
                                <p>Laporkan kepada kami lengkap dengan nama jalan dan foto bila ada, agar segera ditindaklanjuti tim Sarana dan Prasarana.</p>
                            </div>
                            <div class="report-act">
                                <a class="wa" href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Lapor via WhatsApp</a>
                                <a class="tel" href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> {{ $telepon_tampil }}</a>
                            </div>
                        </aside>
                    </div>
                </section>

            {{-- ============================================================
                 TAB LAIN (mis. Prasarana Pemadam): tabel per pos
                 ============================================================ --}}
            @else
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
                    $daftarPos = $adaPos
                        ? $rows->pluck('pos')->filter()->unique()->sortBy(function ($n) use ($urutPos) {
                            $i = array_search($n, $urutPos, true);
                            return $i === false ? 9999 : $i;
                        })->values()
                        : collect();
                    $posAwal = $daftarPos->first();

                    $kolDasar  = array_values(array_diff($kolom, ['pos']));
                    $kolBadge  = array_values(array_intersect($kolDasar, ['tahun', 'plat_nomor', 'plat', 'no_plat']));
                    $kolTampil = array_values(array_diff($kolDasar, $kolBadge));
                    $kolNama   = collect($kolTampil)->first(fn ($c) => preg_match('/jenis|nama/i', $c));
                    if (!$kolNama) { $kolBadge = []; $kolTampil = $kolDasar; }
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

                        <label class="search"><i class="fas fa-search"></i>
                            <input type="search" placeholder="Cari nama prasarana..." data-search="{{ $key }}" autocomplete="off">
                        </label>

                        <div class="tbl-wrap">
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
                                            <td class="{{ $cls }}">
                                                @if($cls === 'c-img')
                                                    @php $src = !empty($r[$c]) ? $gambar($r[$c]) : null; @endphp
                                                    @if($src)
                                                        <a href="{{ $src }}" class="zoom" data-full="{{ $src }}" aria-label="Lihat gambar"><img src="{{ $src }}" alt="" loading="lazy"></a>
                                                    @else
                                                        <span class="noimg"><i class="far fa-image"></i></span>
                                                    @endif
                                                @elseif($cls === 'c-nama')
                                                    <p class="nama">{{ mb_strtoupper((string) ($r[$c] ?? '-')) }}</p>
                                                @elseif($cls === 'c-jml')
                                                    <span class="jml">{{ $r[$c] ?? '-' }}</span>
                                                @else
                                                    {{ $r[$c] ?? '-' }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <p class="no-result" hidden><i class="far fa-face-frown"></i> Tidak ada data yang cocok.</p>
                        </div>
                    @endif
                  </div>
                </section>
            @endif

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
    var PAGE = 12;

    /* ---------- Navigasi ---------- */
    var header = document.getElementById('siteHeader');
    var toggle = header.querySelector('.nav-toggle');
    var drops = header.querySelectorAll('.has-drop');
    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) { li.classList.remove('open'); li.querySelector('.menu-trigger').setAttribute('aria-expanded', 'false'); }
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
    document.addEventListener('click', function (e) { if (!e.target.closest('.has-drop')) closeDrops(null); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeDrops(null); });

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
       PANEL GENERIC: filter pos + cari, nomor dihitung ulang
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
    document.querySelectorAll('[data-type="generic"]').forEach(function (p) { terapkan(p.dataset.panel); });

    /* ==========================================================
       PANEL SUMBER AIR: tab kategori, cari, kartu/tabel, muat lebih
       ========================================================== */
    document.querySelectorAll('[data-type="sumber"]').forEach(function (root) {
        var tabs = Array.prototype.slice.call(root.querySelectorAll('.tab-card'));
        var subs = Array.prototype.slice.call(root.querySelectorAll('.sub-panel'));
        var qInput = root.querySelector('[data-q]');
        var qClear = root.querySelector('[data-clear]');
        var viewBtns = root.querySelectorAll('.seg button');
        var resultText = root.querySelector('[data-result]');
        var state = { q: '', view: 'card', tab: tabs.length ? tabs[0].dataset.sub : '', shown: {} };
        subs.forEach(function (p) { state.shown[p.dataset.subPanel] = PAGE; });

        function tabLabel(id) {
            var t = tabs.filter(function (x) { return x.dataset.sub === id; })[0];
            return t ? t.querySelector('.tab-lbl').textContent : id;
        }
        function info(p) {
            var items = Array.prototype.slice.call(p.querySelectorAll('.h-item'));
            var cards = items.filter(function (el) { return el.closest('[data-cards]'); });
            var rows  = items.filter(function (el) { return el.closest('[data-table]'); });
            var hits = cards.filter(function (el) { return !state.q || el.dataset.search.indexOf(state.q) !== -1; }).length;
            return { id: p.dataset.subPanel, cards: cards, rows: rows, hits: hits, total: parseInt(p.dataset.total, 10) || 0 };
        }
        function paint(list, id) {
            var n = 0;
            list.forEach(function (el) {
                var ok = !state.q || el.dataset.search.indexOf(state.q) !== -1;
                if (ok) n++;
                el.hidden = !(ok && n <= state.shown[id]);
            });
        }
        function apply() {
            var infos = subs.map(info), byId = {};
            infos.forEach(function (i) { byId[i.id] = i; });

            tabs.forEach(function (t) {
                var i = byId[t.dataset.sub];
                t.querySelector('.tab-num').textContent = state.q ? i.hits : i.total;
                t.setAttribute('aria-selected', t.dataset.sub === state.tab ? 'true' : 'false');
            });

            subs.forEach(function (p) {
                var i = byId[p.dataset.subPanel];
                p.hidden = i.id !== state.tab;
                if (i.total === 0) return;
                paint(i.cards, i.id); paint(i.rows, i.id);
                var none = i.hits === 0;
                p.querySelector('[data-cards]').hidden = none || state.view !== 'card';
                p.querySelector('[data-table]').hidden = none || state.view !== 'table';
                var nohit = p.querySelector('[data-nohit]');
                nohit.hidden = !none;
                var more = p.querySelector('[data-more]');
                var remaining = i.hits - state.shown[i.id];
                more.hidden = !(remaining > 0);
                if (remaining > 0) more.querySelector('span').textContent = 'Tampilkan lebih banyak (' + remaining + ' lagi)';
                if (none) {
                    var box = nohit.querySelector('[data-others]');
                    box.innerHTML = '';
                    infos.forEach(function (o) {
                        if (o.id !== i.id && o.hits > 0) {
                            var b = document.createElement('button');
                            b.type = 'button';
                            b.textContent = o.hits + ' hasil di ' + tabLabel(o.id);
                            b.addEventListener('click', function () { state.tab = o.id; apply(); });
                            box.appendChild(b);
                        }
                    });
                    var r = document.createElement('button');
                    r.type = 'button'; r.className = 'ghost';
                    r.innerHTML = '<i class="fas fa-rotate-left"></i> Hapus pencarian';
                    r.addEventListener('click', function () { qInput.value = ''; qInput.dispatchEvent(new Event('input')); });
                    box.appendChild(r);
                }
            });

            var cur = byId[state.tab];
            if (cur) {
                if (cur.total === 0) {
                    resultText.innerHTML = 'Belum ada data untuk <b>' + tabLabel(state.tab) + '</b>';
                } else if (state.q) {
                    var all = infos.reduce(function (a, x) { return a + x.hits; }, 0);
                    resultText.innerHTML = 'Ditemukan <b>' + cur.hits + '</b> di ' + tabLabel(state.tab) + ' &middot; <b>' + all + '</b> hasil di semua kategori';
                } else {
                    resultText.innerHTML = 'Menampilkan <b>' + Math.min(cur.total, state.shown[state.tab]) + '</b> dari ' + cur.total + ' titik <b>' + tabLabel(state.tab) + '</b>';
                }
            }
            qClear.classList.toggle('show', !!qInput.value);
        }

        tabs.forEach(function (t) { t.addEventListener('click', function () { state.tab = t.dataset.sub; apply(); }); });
        qInput.addEventListener('input', function () {
            state.q = qInput.value.trim().toLowerCase();
            Object.keys(state.shown).forEach(function (k) { state.shown[k] = PAGE; });
            apply();
        });
        qClear.addEventListener('click', function () { qInput.value = ''; qInput.dispatchEvent(new Event('input')); qInput.focus(); });
        viewBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                state.view = btn.dataset.view;
                viewBtns.forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
                apply();
            });
        });
        subs.forEach(function (p) {
            var more = p.querySelector('[data-more]');
            if (more) more.addEventListener('click', function () { state.shown[p.dataset.subPanel] += PAGE; apply(); });
        });
        apply();
    });

    /* ==========================================================
       PANEL HIDRANT: cari, kecamatan, kondisi, kartu/tabel
       ========================================================== */
    document.querySelectorAll('[data-type="hidrant"]').forEach(function (root) {
        var cardsEl = root.querySelector('[data-cards]');
        if (!cardsEl) return;
        var tableEl = root.querySelector('[data-table]');
        var qInput = root.querySelector('[data-q]');
        var qClear = root.querySelector('[data-clear]');
        var kecSel = root.querySelector('[data-kec]');
        var chips = root.querySelectorAll('.kchip');
        var viewBtns = root.querySelectorAll('.seg button');
        var emptyEl = root.querySelector('[data-nohit]');
        var btnMore = root.querySelector('[data-more]');
        var btnReset = root.querySelector('.btn-reset');
        var resultText = root.querySelector('[data-result]');
        var state = { q: '', kec: '', kondisi: '', view: 'card', shown: PAGE };
        var cardItems = Array.prototype.slice.call(cardsEl.querySelectorAll('.h-item'));
        var tableItems = Array.prototype.slice.call(tableEl.querySelectorAll('.h-item'));
        var totalAll = cardItems.length;

        function matches(el) {
            if (state.kondisi && el.dataset.kondisi !== state.kondisi) return false;
            if (state.kec && el.dataset.kec !== state.kec) return false;
            if (state.q && el.dataset.search.indexOf(state.q) === -1) return false;
            return true;
        }
        function paint(list) {
            var n = 0;
            list.forEach(function (el) { var ok = matches(el); if (ok) n++; el.hidden = !(ok && n <= state.shown); });
            return n;
        }
        function apply() {
            var count = paint(cardItems); paint(tableItems);
            var filtered = !!(state.q || state.kec || state.kondisi);
            resultText.innerHTML = filtered
                ? 'Ditemukan <b>' + count + '</b> dari ' + totalAll + ' hidrant'
                : 'Menampilkan <b>' + Math.min(count, state.shown) + '</b> dari ' + totalAll + ' hidrant';
            btnReset.classList.toggle('show', filtered);
            qClear.classList.toggle('show', !!qInput.value);
            var empty = count === 0;
            emptyEl.hidden = !empty;
            cardsEl.hidden = empty || state.view !== 'card';
            tableEl.hidden = empty || state.view !== 'table';
            var remaining = count - state.shown;
            btnMore.hidden = !(remaining > 0);
            if (remaining > 0) btnMore.querySelector('span').textContent = 'Tampilkan lebih banyak (' + remaining + ' lagi)';
        }
        function resetAll() {
            state.q = ''; state.kec = ''; state.kondisi = ''; state.shown = PAGE;
            qInput.value = ''; kecSel.value = '';
            chips.forEach(function (c) { c.setAttribute('aria-pressed', c.dataset.kondisi === '' ? 'true' : 'false'); });
            apply();
        }
        qInput.addEventListener('input', function () { state.q = qInput.value.trim().toLowerCase(); state.shown = PAGE; apply(); });
        qClear.addEventListener('click', function () { qInput.value = ''; qInput.dispatchEvent(new Event('input')); qInput.focus(); });
        kecSel.addEventListener('change', function () { state.kec = kecSel.value; state.shown = PAGE; apply(); });
        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                state.kondisi = chip.dataset.kondisi; state.shown = PAGE;
                chips.forEach(function (c) { c.setAttribute('aria-pressed', c === chip ? 'true' : 'false'); });
                apply();
            });
        });
        viewBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                state.view = btn.dataset.view;
                viewBtns.forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
                apply();
            });
        });
        btnMore.addEventListener('click', function () { state.shown += PAGE; apply(); });
        root.querySelectorAll('[data-reset]').forEach(function (b) { b.addEventListener('click', resetAll); });
        apply();
    });

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