@php
    // Data bawaan untuk footer dan tombol darurat
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
    $play_store_url = "";
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Peta Kecamatan dan Titik Operasional - SIMERAH KOJA Dinas Pemadam Kebakaran Kota Jambi.">
    <title>Peta Operasional SIGAP - SIMERAH KOJA</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    /* Warna Dasar Peta & Halaman SIGAP */
    --ink: #0d1b2a;
    --ink-2: #1e293b;
    --ink-3: #334155;
    --muted: #64748b;
    --paper: #f8fafc;
    --white: #ffffff;
    --red: #dc2626;
    --red-dark: #b91c1c;
    --blue: #2563eb;
    --blue-soft: #eff6ff;
    --line: #e2e8f0;
    --soft: #f1f5f9;

    /* Warna & Variabel khusus dari Navbar Baru */
    --signal: #e5392d;
    --signal-d: #c22b20;
    --amber: #ffb627;
    --steel: #5b6c7f;
    --r-lg: 28px;
    --r-md: 18px;
    --r-sm: 10px;

    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    
    --display: 'Bricolage Grotesque', system-ui, sans-serif;
    --body: 'Instrument Sans', system-ui, sans-serif;
    --font-display: var(--display);
    --font-body: var(--body);
    
    --wrap: 1200px;
    --header-h: 64px;
    --header: var(--header-h);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
    font-family: var(--body);
    color: var(--ink);
    background: var(--paper);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
}
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; transition: .2s ease; }
ul, ol { list-style: none; }
button, input, select { font: inherit; }
button { color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid rgba(37, 99, 235, 0.5); outline-offset: 2px; border-radius: 6px; }
.wrap { width: min(var(--wrap), calc(100% - 40px)); margin: auto; }

/* ==========================================================
   HEADER NAVBAR (STYLE BARU)
   ========================================================== */
.site-header {
    position: sticky; top: 0; z-index: 1000;
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

/* HERO SIGAP */
.page-hero {
    position: relative; overflow: hidden; color: #fff;
    padding: 60px 0 100px; background: #0b1d2e;
}
.page-hero::before {
    content: ""; position: absolute; inset: 0; z-index: 0;
    background: linear-gradient(135deg, rgba(13,27,42,0.95), rgba(15,23,42,0.85)), url('/images/background1.jpg') center/cover;
}
.page-hero .wrap { position: relative; z-index: 1; }
.crumbs {
    display: flex; flex-wrap: wrap; align-items: center; gap: 8px;
    color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 24px;
}
.crumbs li { display: inline-flex; align-items: center; gap: 8px; }
.crumbs li+li::before { content: "/"; opacity: 0.4; }
.crumbs a:hover { color: #fff; }
.crumbs [aria-current=page] { color: #fff; font-weight: 600; }
.hero-kicker {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 12px; border: 1px solid rgba(255,255,255,0.2);
    border-radius: 6px; background: rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.9); font-size: 0.75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px;
}
.hero-kicker i { color: #f87171; }
.page-hero h1 {
    font-family: var(--display); font-weight: 800;
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    line-height: 1.1; letter-spacing: -0.02em; max-width: 800px;
}
.hero-line { width: 60px; height: 4px; border-radius: 4px; margin-top: 24px; background: var(--red); }

/* MAP SECTION */
.page-body { background: var(--paper); padding-bottom: 80px; }
.page-body .wrap { width: min(1360px, calc(100% - 40px)); }
.map-wrap {
    margin: -60px auto 0;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    position: relative; z-index: 10;
    border: 1px solid var(--line);
    display: grid;
    grid-template-columns: 300px 1fr 300px;
    height: 75vh; min-height: 650px;
}
.map-sidebar {
    border-right: 1px solid var(--line);
    display: flex; flex-direction: column;
    background: #fff;
    overflow-y: auto;
}
.map-sidebar::-webkit-scrollbar { width: 6px; }
.map-sidebar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

.map-sidebar-header { padding: 24px; background: #f8fafc; flex: 1; }
.map-sidebar-header h2 {
    font-family: var(--display); font-size: 1.3rem; font-weight: 700;
    color: var(--ink); margin-bottom: 4px;
}
.map-sidebar-header p { color: var(--muted); font-size: 0.85rem; }

/* Filter Styles */
.filter-section { margin-top: 20px; }
.lbl {
    display: block; font-size: 0.75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em;
    color: var(--muted); margin-bottom: 10px;
}
.chips { display: grid; gap: 8px; }
.chip {
    width: 100%; display: flex; align-items: center; gap: 12px;
    padding: 8px 12px; border: 1px solid var(--line);
    border-radius: 8px; background: #fff;
    font-size: 0.85rem; font-weight: 600; color: var(--ink-2);
    transition: all .2s ease; cursor: pointer; text-align: left;
}
.chip:hover { border-color: #cbd5e1; background: #f1f5f9; }
.chip .dot {
    width: 28px; height: 28px; border-radius: 6px;
    display: grid; place-items: center; color: #fff; font-size: 0.75rem; flex: none;
}
.chip span:nth-child(2) { flex: 1; }
.chip b {
    min-width: 28px; text-align: center;
    font-size: 0.7rem; font-weight: 700; color: var(--ink-3);
    background: var(--soft); padding: 4px 8px; border-radius: 6px;
}
.chip.off { opacity: 0.5; background: #fafafa; border-color: #f1f5f9; }
.chip.off .dot { filter: grayscale(1); }

.form-control, .form-select {
    width: 100%; padding: 10px 14px;
    font-size: 0.85rem; border: 1px solid var(--line);
    border-radius: 8px; background: #fff; color: var(--ink);
    margin-bottom: 10px; transition: border-color .2s;
}
.form-control:disabled, .form-select:disabled {
    background-color: #f1f5f9; opacity: 0.6; cursor: not-allowed;
}
.form-control:focus, .form-select:focus {
    outline: none; border-color: var(--blue);
    box-shadow: 0 0 0 3px var(--blue-soft);
}
.search-wrap { position: relative; }
.search-wrap i {
    position: absolute; left: 14px; top: 12px;
    color: var(--muted); font-size: 0.85rem; pointer-events: none;
}
.search-wrap .form-control { padding-left: 38px; margin-bottom: 0; }

/* Panel kanan: daftar kecamatan / titik */
.map-list {
    border-left: 1px solid var(--line);
    display: flex; flex-direction: column;
    background: #fff; min-height: 0;
}
.map-list-header { padding: 20px 20px 12px; border-bottom: 1px solid var(--line); background: #f8fafc; }
.list-scroll { flex: 1; overflow-y: auto; min-height: 0; }
.list-scroll::-webkit-scrollbar { width: 6px; }
.list-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

/* District List */
.list-heading {
    padding: 0 0 12px;
    display: flex; align-items: center; justify-content: space-between;
    color: var(--muted); font-size: 0.75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em;
}
.count-badge {
    min-width: 24px; text-align: center; padding: 2px 8px; border-radius: 999px;
    background: var(--soft); color: var(--ink-3); font-size: .7rem; font-weight: 700;
}
#daftar-kecamatan { list-style: none; margin: 0; padding: 0 16px 16px; }
#daftar-titik { list-style: none; margin: 12px 0 0; max-height: 300px; overflow-y: auto; }
#daftar-titik::-webkit-scrollbar { width: 6px; }
#daftar-titik::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
.filter-section .list-heading { padding: 0 0 10px; }
.filter-section .search-wrap { margin-top: 0; }
.item {
    width: 100%; cursor: pointer; display: flex; align-items: center; gap: 12px;
    padding: 10px 12px; border-radius: 8px; border: 1px solid transparent;
    font-weight: 600; font-size: 0.85rem; color: var(--ink-2);
    transition: all .2s; background: transparent; text-align: left;
}
.item:hover { background: #f8fafc; border-color: var(--line); }
.item.aktif { background: var(--blue-soft); color: var(--blue); border-color: #bfdbfe; }
.item small { display: block; color: var(--muted); font-weight: 500; }
.item .meta { margin-left: auto; font-size: .7rem; color: var(--muted); }
.warna { width: 12px; height: 12px; border-radius: 4px; flex: none; }
.kosong { padding: 20px; color: var(--muted); font-size: 0.85rem; text-align: center; }

/* Map Area */
#map { height: 100%; width: 100%; z-index: 1; background: #e2e8f0; }
.leaflet-control-layers { border: none !important; border-radius: 8px !important; box-shadow: var(--shadow) !important; }
.leaflet-control-zoom { border: none !important; box-shadow: var(--shadow) !important; border-radius: 8px !important; overflow: hidden; }
.leaflet-control-zoom a { color: var(--ink) !important; width: 34px !important; height: 34px !important; line-height: 34px !important; }

/* Map Pins & Popups */
.pin {
    width: 32px; height: 32px; border-radius: 8px;
    display: grid; place-items: center; color: #fff; font-size: 0.85rem;
    border: 2px solid #fff; box-shadow: var(--shadow);
    transform: translateY(0); transition: transform .2s ease;
}
.leaflet-marker-icon:hover .pin { transform: translateY(-3px) scale(1.05); box-shadow: var(--shadow-lg); }
.popup h3 {
    margin: 0 0 10px; font-size: 1.05rem; font-family: var(--display);
    border-bottom: 1px solid var(--line); padding-bottom: 8px; color: var(--ink);
}
.popup table { border-collapse: collapse; font-size: 0.85rem; color: var(--ink-2); width: 100%; }
.popup td { padding: 6px 8px 6px 0; vertical-align: top; border-bottom: 1px solid var(--soft); }
.popup tr:last-child td { border-bottom: none; }
.popup td:first-child { color: var(--muted); font-weight: 600; width: 35%; }
.popup a {
    display: inline-flex; align-items: center; gap: 8px; width: 100%; justify-content: center;
    color: #fff; background: var(--blue);
    padding: 8px 12px; border-radius: 6px; font-weight: 600;
    font-size: 0.8rem; margin-top: 12px; transition: .2s;
}
.popup a:hover { background: #1d4ed8; }

/* FOOTER */
.footer { background: #0f172a; color: rgba(255,255,255,0.7); padding: 60px 0 30px; }
.footer-grid { display: grid; grid-template-columns: 1fr 1.2fr 0.8fr; gap: 40px; }
.footer h3 { font-family: var(--display); color: #fff; font-size: 1.1rem; margin-bottom: 16px; }
.footer-about img { height: 60px; width: auto; margin-bottom: 16px; }
.footer-about p { font-size: 0.85rem; line-height: 1.7; }
.footer .map {
    position: relative; height: 180px; border-radius: 12px;
    overflow: hidden; border: 1px solid rgba(255,255,255,0.1);
}
.footer .map iframe { width: 100%; height: 100%; border: 0; filter: grayscale(0.3); transition: .3s; }
.footer .map:hover iframe { filter: none; }
.map-link {
    position: absolute; inset: 0; z-index: 2;
    display: flex; align-items: flex-end; justify-content: flex-end; padding: 12px;
}
.map-link span {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 8px 14px; border-radius: 6px;
    background: var(--red); color: #fff; font-size: 0.75rem; font-weight: 700;
    box-shadow: var(--shadow); transition: .2s;
}
.map-link:hover span { background: var(--red-dark); transform: translateY(-2px); }
.find { display: inline-flex; align-items: center; gap: 8px; margin-top: 16px; color: #fff; font-size: 0.85rem; font-weight: 600; }
.find i { color: #f87171; }
.footer-links li+li { margin-top: 8px; }
.footer-links a { display: flex; align-items: center; gap: 10px; font-size: 0.85rem; }
.footer-links a i { font-size: 0.65rem; color: #f87171; }
.footer-links a:hover { color: #fff; gap: 14px; }
.footer-bar {
    margin-top: 50px; padding-top: 24px;
    border-top: 1px solid rgba(255,255,255,0.1);
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 16px; font-size: 0.8rem;
}
.social { display: flex; gap: 8px; }
.social a {
    width: 36px; height: 36px; border-radius: 8px;
    display: grid; place-items: center;
    background: rgba(255,255,255,0.05); color: #fff; transition: .2s;
}
.social a:hover { background: var(--red); transform: translateY(-2px); }

/* SOS FAB */
.beacon{position:relative;width:8px;height:8px;border-radius:50%;background:#fff;flex:none}
.beacon::after{content:"";position:absolute;inset:0;border-radius:50%;background:#fff;animation:ping 1.8s cubic-bezier(0,0,.2,1) infinite}
@keyframes ping{0%{transform:scale(1);opacity:.7}100%{transform:scale(3.2);opacity:0}}
.sos-fab{position:fixed;right:24px;bottom:24px;z-index:1001;display:flex;flex-direction:column;align-items:flex-end;gap:12px;opacity:0;visibility:hidden;transform:translateY(20px);transition:.3s}
.sos-fab.show{opacity:1;visibility:visible;transform:none}
.sos-fab-btn{display:inline-flex;align-items:center;gap:10px;padding:14px 20px;border-radius:12px;background:var(--red);color:#fff;font-weight:700;font-size:0.9rem;box-shadow:var(--shadow-lg);transition:.2s}
.sos-fab-btn:hover{background:var(--red-dark);transform:translateY(-2px)}
.sos-sheet{display:none;width:min(300px,calc(100vw - 32px));padding:8px;border-radius:12px;background:#0f172a;border:1px solid rgba(255,255,255,.1);box-shadow:var(--shadow-lg)}
.sos-fab.open .sos-sheet{display:grid;gap:4px}
.sos-sheet a{display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:8px;color:#fff;font-weight:600;font-size:0.85rem}
.sos-sheet a:hover{background:rgba(255,255,255,.1)}
.sos-sheet a i{width:20px;text-align:center;font-size:1rem}
.sos-sheet .wa i{color:#22c55e}.sos-sheet .tel i{color:#38bdf8}.sos-sheet .n112 i{color:#ef4444}

/* RESPONSIVE */
@media (max-width: 991px) {
    .footer-grid { grid-template-columns: 1fr; gap: 40px; }
    .map-wrap { grid-template-columns: 1fr; height: auto; margin-top: -40px; }
    #map { order: -1; height: 60vh; min-height: 420px; }
    .map-sidebar { border-right: none; border-top: 1px solid var(--line); }
    .map-list { border-left: none; border-top: 1px solid var(--line); max-height: 420px; }
}
@media (max-width: 768px) {
    .chips { grid-template-columns: 1fr 1fr; }
    .page-hero { padding: 40px 0 80px; }
    .page-hero h1 { font-size: clamp(2rem, 8vw, 2.8rem); }
}
@media (max-width: 480px) {
    .chips { grid-template-columns: 1fr; }
    .brand span { display: none; }
}
</style>

</head>
<body>

<!-- ==================== HEADER (STYLE BARU) ==================== -->
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
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan<i class="fas fa-chevron-down"></i></button>
               <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK &amp; Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan Edukasi &amp; Sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                    <li><a href="/public-sigap" aria-current="page">Peta SIGAP</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Kabar Damkar <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/edu-damkar">Edu Damkar</a></li>
                    <li><a href="/infografis">Info Grafis</a></li>
                    <li><a href="/media-informasi">Media Informasi</a></li>
                    <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>
            <li><a class="menu-link btn-login" href="/login">Masuk</a></li>
        </ul>
    </nav>
</header>

<main>
    <!-- ==================== HERO ==================== -->
    <section class="page-hero">
        <div class="wrap">
            <nav aria-label="Breadcrumb">
                <ol class="crumbs">
                    <li><a href="/">Beranda</a></li>
                    <li><span aria-current="page">Peta Operasional</span></li>
                </ol>
            </nav>
            <div class="hero-kicker"><i class="fas fa-map-marked-alt"></i> SIGAP SIMERAH</div>
            <h1>SIGAP Kota Jambi</h1>
            <h2>Sistem Informasi Geografis Antisipasi dan Penanggulangan</h2>
            <div class="hero-line"></div>
        </div>
    </section>

    <!-- ==================== PETA ==================== -->
    <div class="page-body">
        <div class="wrap">
            <div class="map-wrap">

                <aside class="map-sidebar">
                    <div class="map-sidebar-header">
                        <h2>Filter Data Peta</h2>
                        <p id="ringkas">Pilih kategori titik terlebih dahulu untuk mengaktifkan filter kecamatan.</p>

                        <div class="filter-section">
                            <span class="lbl">Kategori Titik</span>
                            <div id="kategori" class="chips" aria-label="Filter kategori titik"></div>
                        </div>

                        <div class="filter-section">
                            <span class="lbl">Pilih Kecamatan</span>
                            <select id="filter-kecamatan" class="form-select" aria-label="Filter Kecamatan" disabled>
                                <option value="">Pilih kategori terlebih dahulu...</option>
                            </select>
                        </div>

                        <div class="filter-section">
                            <div class="list-heading">
                                <span id="judul-titik">Daftar Titik</span>
                                <span id="count-titik" class="count-badge"></span>
                            </div>
                            <div class="search-wrap">
                                <i class="fas fa-search"></i>
                                <input id="cari-titik" class="form-control" type="search" placeholder="Cari titik..." aria-label="Cari titik" disabled>
                            </div>
                            <ul id="daftar-titik"></ul>
                        </div>
                    </div>
                </aside>

                <div id="map"></div>

                <aside class="map-list" aria-label="Daftar kecamatan">
                    <div class="map-list-header">
                        <div class="list-heading">
                            <span>Daftar Kecamatan</span>
                            <span id="list-count" class="count-badge"></span>
                        </div>
                        <div class="search-wrap">
                            <i class="fas fa-search"></i>
                            <input id="cari" class="form-control" type="search" placeholder="Cari kecamatan..." aria-label="Cari kecamatan">
                        </div>
                    </div>
                    <div class="list-scroll">
                        <ul id="daftar-kecamatan"></ul>
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
                    <iframe title="Lokasi Dinas Pemadam Kebakaran Kota Jambi" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="{{ $maps_link }}" target="_blank" rel="noopener" aria-label="Buka lokasi di Google Maps">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="{{ $maps_link }}" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>
                @if ($play_store_url)
                <div class="app-dl">
                    <p style="margin-top: 15px; font-size: 0.85rem;">Unduh aplikasi SIMERAH KOJA</p>
                    <a href="{{ $play_store_url }}" target="_blank" rel="noopener">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Dapatkan di Google Play" style="height: 40px; margin-top: 8px;">
                    </a>
                </div>
                @endif
            </div>
            <div class="footer-links">
                <h3>Link terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-chevron-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-chevron-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-chevron-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; {{ date('Y') }}. Hak cipta dilindungi.</div>
            <div class="social">
                <a href="mailto:damkar.jbi@gmail.com" title="Email" aria-label="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
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
        <span class="beacon" aria-hidden="true"></span> Lapor Darurat
    </button>
</div>

<!-- ==================== SCRIPTS ==================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
(function () {
    'use strict';

    const $ = id => document.getElementById(id);
    const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

    /* =========================================================
       1. NAVIGASI & TOMBOL DARURAT
       ========================================================= */
    const header = $('siteHeader');
    const toggle = header.querySelector('.nav-toggle');
    const drops  = header.querySelectorAll('.has-drop');

    const closeDrops = except => drops.forEach(li => {
        if (li === except) return;
        li.classList.remove('open');
        li.querySelector('.menu-trigger').setAttribute('aria-expanded', 'false');
    });

    toggle.addEventListener('click', () => {
        const open = header.classList.toggle('nav-open');
        toggle.setAttribute('aria-expanded', open);
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        toggle.querySelector('i').className = open ? 'fas fa-times' : 'fas fa-bars';
    });

    drops.forEach(li => {
        const btn = li.querySelector('.menu-trigger');
        btn.addEventListener('click', () => {
            btn.setAttribute('aria-expanded', li.classList.toggle('open'));
            closeDrops(li);
        });
    });
    document.addEventListener('click', e => { if (!e.target.closest('.has-drop')) closeDrops(null); });

    const fab = $('sosFab'), fabBtn = fab.querySelector('.sos-fab-btn');
    const setFab = open => { fab.classList.toggle('open', open); fabBtn.setAttribute('aria-expanded', open); };
    fabBtn.addEventListener('click', () => setFab(!fab.classList.contains('open')));
    const updateFab = () => {
        const show = window.scrollY > 300;
        fab.classList.toggle('show', show);
        if (!show) setFab(false);
    };
    window.addEventListener('scroll', updateFab, { passive: true });
    updateFab();

    /* =========================================================
       2. KONFIGURASI & STATE
       ========================================================= */
    const KOLOM_NAMA = ['kecamatan', 'KECAMATAN', 'Kecamatan', 'WADMKC', 'NAMOBJ', 'nama', 'NAME_3'];
    const PALET = ['#2563eb', '#dc2626', '#f59e0b', '#10b981', '#8b5cf6', '#ea580c', '#0f172a', '#334155', '#64748b', '#f43f5e', '#14b8a6'];
    const KATEGORI = {
        kebakaran:    { label: 'Kebakaran',    warna: '#dc2626', ikon: 'fa-fire' },
        sumber_air:   { label: 'Sumber Air',   warna: '#2563eb', ikon: 'fa-water' },
        hydrant:      { label: 'Hydrant',      warna: '#f59e0b', ikon: 'fa-fire-extinguisher' },
        penyelamatan: { label: 'Penyelamatan', warna: '#10b981', ikon: 'fa-life-ring' },
        pos:          { label: 'Pos Damkar',   warna: '#0f172a', ikon: 'fa-building' }
    };

    const state = { kategori: null, kecamatan: '', qKec: '', qTitik: '' };

    const data = { fitur: [], kecamatan: [], titik: [] };
    const layersKec = {};   // nama kecamatan -> [layer poligon]
    const warnaKec  = {};   // nama kecamatan -> warna
    const chips     = {};   // kategori -> elemen chip
    const markers   = new Map(); // titik -> L.marker (dibuat sekali)
    let geojson;

    const el = {
        ringkas: $('ringkas'), kategori: $('kategori'), select: $('filter-kecamatan'),
        cariKec: $('cari'), countKec: $('list-count'), daftarKec: $('daftar-kecamatan'),
        cariTitik: $('cari-titik'), judulTitik: $('judul-titik'), countTitik: $('count-titik'), daftarTitik: $('daftar-titik')
    };

    const getNama = p => { for (const k of KOLOM_NAMA) if (p[k]) return p[k]; return 'Tanpa nama'; };

    /* =========================================================
       3. PETA DASAR
       ========================================================= */
    const map = L.map('map').setView([-1.6101, 103.6131], 12);
    const jalan = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);
    const citra = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19, attribution: 'Esri' });
    L.control.layers({ 'Peta Jalan': jalan, 'Citra Satelit': citra }).addTo(map);
    const grupTitik = L.layerGroup().addTo(map);

    /* =========================================================
       4. GEOMETRI: tentukan kecamatan dari koordinat titik
       ========================================================= */
    function inRing(lng, lat, ring) {
        let inside = false;
        for (let i = 0, j = ring.length - 1; i < ring.length; j = i++) {
            const [xi, yi] = ring[i], [xj, yj] = ring[j];
            if ((yi > lat) !== (yj > lat) && lng < (xj - xi) * (lat - yi) / (yj - yi) + xi) inside = !inside;
        }
        return inside;
    }
    const inPolygon = (lng, lat, rings) => inRing(lng, lat, rings[0]) && !rings.slice(1).some(r => inRing(lng, lat, r));

    function cariKecamatan(lat, lng) {
        for (const f of data.fitur) {
            const g = f.geometry;
            const polys = g.type === 'Polygon' ? [g.coordinates] : g.type === 'MultiPolygon' ? g.coordinates : [];
            if (polys.some(rings => inPolygon(lng, lat, rings))) return getNama(f.properties);
        }
        return '';
    }

    /* =========================================================
       5. DATA TURUNAN (dihitung dari state)
       ========================================================= */
    const titikKategori = () => state.kategori ? data.titik.filter(p => p.kategori === state.kategori) : [];
    const titikTerpilih = () => titikKategori().filter(p => !state.kecamatan || p.kecamatan === state.kecamatan);
    const titikTampil = () => {
        const q = state.qTitik.toLowerCase();
        return titikTerpilih().filter(p => `${p.nama} ${p.lokasi || ''}`.toLowerCase().includes(q));
    };

    /* =========================================================
       6. RENDER
       ========================================================= */
    function renderChips() {
        const hitung = {};
        data.titik.forEach(p => { hitung[p.kategori] = (hitung[p.kategori] || 0) + 1; });
        Object.entries(chips).forEach(([k, b]) => {
            b.classList.toggle('off', state.kategori !== k);
            b.querySelector('b').textContent = hitung[k] || 0;
        });
    }

    function renderFilter() {
        const aktif = !!state.kategori;
        el.select.disabled = el.cariTitik.disabled = !aktif;
        el.cariTitik.value = state.qTitik;

        if (!aktif) {
            el.select.innerHTML = '<option value="">Pilih kategori terlebih dahulu...</option>';
            return;
        }
        el.select.innerHTML = '<option value="">Semua Kecamatan</option>' +
            data.kecamatan.map(n => `<option value="${esc(n)}">${esc(n)}</option>`).join('');
        el.select.value = state.kecamatan;
    }

    function renderDaftarKecamatan() {
        const q = state.qKec.toLowerCase();
        const list = data.kecamatan.filter(n => n.toLowerCase().includes(q));
        el.countKec.textContent = list.length;
        el.daftarKec.innerHTML = '';
        if (!list.length) { el.daftarKec.innerHTML = '<li class="kosong">Kecamatan tidak ditemukan.</li>'; return; }

        const jumlah = {};
        titikKategori().forEach(p => { jumlah[p.kecamatan] = (jumlah[p.kecamatan] || 0) + 1; });

        list.forEach(n => {
            const li = document.createElement('li');
            li.innerHTML = `<button class="item${n === state.kecamatan ? ' aktif' : ''}"><span class="warna" style="background:${warnaKec[n]}"></span>${esc(n)}${
                state.kategori ? `<span class="meta">${jumlah[n] || 0} titik</span>` : ''}</button>`;
            const b = li.firstElementChild;
            b.addEventListener('click', () => n === state.kecamatan ? setKecamatan('') : fokusKecamatan(n));
            b.addEventListener('mouseenter', () => sorot(n, true));
            b.addEventListener('mouseleave', () => sorot(n, false));
            el.daftarKec.appendChild(li);
        });
    }

    function renderDaftarTitik() {
        el.daftarTitik.innerHTML = '';
        const kosong = teks => { el.daftarTitik.innerHTML = `<li class="kosong">${teks}</li>`; };

        el.judulTitik.textContent = state.kecamatan ? `Titik di ${state.kecamatan}` : 'Daftar Titik';
        if (!state.kategori) { el.countTitik.textContent = ''; return kosong('Pilih kategori titik terlebih dahulu.'); }

        const list = titikTampil();
        el.countTitik.textContent = list.length;
        if (!list.length) return kosong('Tidak ada titik untuk filter ini.');

        list.forEach(p => {
            const li = document.createElement('li');
            li.innerHTML = `<button class="item"><span class="warna" style="background:${KATEGORI[p.kategori].warna}"></span>
                <div style="flex:1;overflow:hidden"><div style="font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${esc(p.nama)}</div>
                <small>${esc(p.lokasi || '')}</small></div></button>`;
            li.firstElementChild.addEventListener('click', () => { map.setView([p.lat, p.lng], 16); markers.get(p)?.openPopup(); });
            el.daftarTitik.appendChild(li);
        });
    }

    function renderMarker() {
        grupTitik.clearLayers();
        titikTampil().forEach(p => {
            if (!markers.has(p)) markers.set(p, buatMarker(p));
            grupTitik.addLayer(markers.get(p));
        });
    }

    function render() {
        renderChips();
        renderFilter();
        renderDaftarKecamatan();
        renderDaftarTitik();
        renderMarker();
    }

    /* =========================================================
       7. AKSI (satu-satunya tempat state berubah)
       ========================================================= */
    function setKategori(k) {
        state.kategori = state.kategori === k ? null : k;
        state.kecamatan = '';
        state.qTitik = '';
        if (geojson) map.fitBounds(geojson.getBounds());
        map.closePopup();
        render();
    }

    function setKecamatan(nama) {
        state.kecamatan = nama;
        state.qTitik = '';
        const target = nama && layersKec[nama] ? L.featureGroup(layersKec[nama]).getBounds() : geojson.getBounds();
        map.fitBounds(target, { padding: [30, 30] });
        render();
    }

    function fokusKecamatan(nama) {
        if (state.kategori) return setKecamatan(nama);
        map.fitBounds(L.featureGroup(layersKec[nama]).getBounds(), { padding: [30, 30] });
    }

    function sorot(nama, aktif) {
        (layersKec[nama] || []).forEach(l => aktif
            ? l.setStyle({ weight: 3, color: '#0f172a', fillOpacity: 0.7 })
            : geojson.resetStyle(l));
    }

    /* =========================================================
       8. FACTORY: chip, marker, popup
       ========================================================= */
    Object.entries(KATEGORI).forEach(([k, v]) => {
        const b = document.createElement('button');
        b.type = 'button';
        b.className = 'chip off';
        b.innerHTML = `<span class="dot" style="background:${v.warna}"><i class="fas ${v.ikon}"></i></span><span>${v.label}</span><b>0</b>`;
        b.addEventListener('click', () => setKategori(k));
        chips[k] = b;
        el.kategori.appendChild(b);
    });

    function buatMarker(p) {
        const v = KATEGORI[p.kategori];
        const icon = L.divIcon({
            className: '', iconSize: [32, 32], iconAnchor: [16, 16], popupAnchor: [0, -16],
            html: `<div class="pin" style="background:${v.warna}"><i class="fas ${v.ikon}"></i></div>`
        });
        const baris = [['Kategori', v.label], ['Kecamatan', p.kecamatan], ['Lokasi', p.lokasi], ['Tanggal', p.tanggal]]
            .filter(([, x]) => x).map(([a, b]) => `<tr><td>${esc(a)}</td><td>${esc(b)}</td></tr>`).join('');
        const popup = `<div class="popup"><h3>${esc(p.nama)}</h3><table>${baris}</table>
            <a href="https://www.google.com/maps/dir/?api=1&destination=${p.lat},${p.lng}" target="_blank" rel="noopener"><i class="fas fa-directions"></i> Rute ke lokasi</a></div>`;
        return L.marker([p.lat, p.lng], { icon, title: p.nama, alt: p.nama }).bindPopup(popup);
    }

    const popupWilayah = (props, nama) =>
        `<div class="popup"><h3>${esc(nama)}</h3><table>${
            Object.entries(props).filter(([, v]) => v !== null && v !== '')
                .map(([k, v]) => `<tr><td>${esc(k)}</td><td>${esc(v)}</td></tr>`).join('')
        }</table></div>`;

    /* =========================================================
       9. EVENT FILTER
       ========================================================= */
    el.select.addEventListener('change', () => setKecamatan(el.select.value));
    el.cariKec.addEventListener('input', e => {
        state.qKec = e.target.value;
        renderDaftarKecamatan();
    });
    el.cariTitik.addEventListener('input', e => {
        state.qTitik = e.target.value;
        renderDaftarTitik();
        renderMarker();
    });

    /* =========================================================
       10. MUAT DATA (paralel), lalu inisialisasi sekali
       ========================================================= */
    const getJson = url => fetch(url).then(r => { if (!r.ok) throw new Error(url + ' ' + r.status); return r.json(); });

    Promise.all([
        getJson("{{ asset('geojson/kecamatan_kota_jambi.geojson') }}"),
        getJson("{{ url('/api/titik') }}").catch(() => null)
    ]).then(([wilayah, titik]) => {
        data.fitur = wilayah.features;
        data.kecamatan = [...new Set(data.fitur.map(f => getNama(f.properties)))].sort();
        data.kecamatan.forEach((n, i) => { warnaKec[n] = PALET[i % PALET.length]; });

        geojson = L.geoJSON(wilayah, {
            style: f => ({ color: '#fff', weight: 1.5, fillColor: warnaKec[getNama(f.properties)], fillOpacity: 0.4 }),
            onEachFeature: (f, layer) => {
                const n = getNama(f.properties);
                (layersKec[n] ||= []).push(layer);
                layer.bindTooltip(n, { sticky: true });
                layer.bindPopup(popupWilayah(f.properties, n));
                layer.on({ mouseover: () => sorot(n, true), mouseout: () => sorot(n, false), click: () => fokusKecamatan(n) });
            }
        }).addTo(map);
        map.fitBounds(geojson.getBounds());

        if (titik) {
            data.titik = titik.filter(p => KATEGORI[p.kategori] && isFinite(p.lat) && isFinite(p.lng));
            data.titik.forEach(p => { p.kecamatan = p.kecamatan || cariKecamatan(+p.lat, +p.lng); });
            el.ringkas.textContent = `Total ${data.titik.length} titik tersimpan. Silakan pilih kategori titik.`;
        } else {
            el.ringkas.textContent = 'Gagal memuat data titik. Batas wilayah tetap ditampilkan.';
        }
        render();
    }).catch(() => {
        el.ringkas.textContent = 'Data wilayah belum tersedia';
        el.daftarKec.innerHTML = '<li class="kosong">File GeoJSON tidak ditemukan.</li>';
    });
})();
</script>
</body>
</html>