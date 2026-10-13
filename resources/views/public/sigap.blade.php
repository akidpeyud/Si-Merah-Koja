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
    <title>Peta Operasional SIGAPKAR - SIMERAH KOJA</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --ink: #0f172a;
    --ink-2: #334155;
    --ink-3: #475569;
    --muted: #64748b;
    --paper: #f8fafc;
    --white: #ffffff;
    --red: #dc2626;
    --red-dark: #b91c1c;
    --blue: #2563eb;
    --blue-soft: #eff6ff;
    --line: #e2e8f0;
    --soft: #f1f5f9;
    --signal: #e5392d;
    --signal-d: #c22b20;
    --amber: #ffb627;

    --r-lg: 24px;
    --r-md: 16px;
    --r-sm: 10px;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
    --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.05), 0 8px 10px -6px rgb(0 0 0 / 0.05);

    --display: 'Bricolage Grotesque', system-ui, sans-serif;
    --body: 'Instrument Sans', system-ui, sans-serif;

    --wrap: 1300px;
    --header-h: 64px;
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
body:has(dialog[open]), body.nav-lock { overflow: hidden; }
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; transition: .2s ease; }
ul, ol { list-style: none; }
button, input, select { font: inherit; }
button { color: inherit; background: none; border: 0; cursor: pointer; }
:focus-visible { outline: 3px solid rgba(37, 99, 235, 0.5); outline-offset: 2px; border-radius: 8px; }
.wrap { width: min(var(--wrap), calc(100% - 48px)); margin: auto; }

/* ==========================================================
   HEADER & NAVBAR (Sesuai Index)
   ========================================================== */
.site-header {
    position: sticky; top: 0; z-index: 1000;
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

/* ==========================================================
   HERO SIGAPKAR (lebih ringkas)
   ========================================================== */
.page-hero {
    position: relative; overflow: hidden; color: #fff;
    padding: 44px 0 110px; background: #0b1d2e;
}
.page-hero::before {
    content: ""; position: absolute; inset: 0; z-index: 0;
    background: linear-gradient(135deg, rgba(15,23,42,0.95), rgba(15,23,42,0.75)), url('/images/background1.png') center/cover;
}
.page-hero .wrap { position: relative; z-index: 1; }
.crumbs { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 18px; font-weight: 500; }
.crumbs li { display: inline-flex; align-items: center; gap: 10px; }
.crumbs li+li::before { content: "/"; opacity: 0.4; }
.crumbs a:hover { color: #fff; }
.crumbs [aria-current=page] { color: #fff; font-weight: 600; }
.hero-kicker {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 8px 16px; border: 1px solid rgba(255,255,255,0.15);
    border-radius: 999px; background: rgba(255,255,255,0.05);
    -webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px);
    color: rgba(255,255,255,0.95); font-size: 0.8rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px;
}
.hero-kicker i { color: #f87171; }
.page-hero h1 {
    font-family: var(--display); font-weight: 800;
    font-size: clamp(2rem, 4vw, 3rem);
    line-height: 1.1; letter-spacing: -0.02em; max-width: 800px;
}
.page-hero h2 {
    font-family: var(--body); font-weight: 500;
    font-size: clamp(.95rem, 1.6vw, 1.1rem);
    color: rgba(255,255,255,.75); margin-top: 10px; max-width: 640px;
}
.hero-line { width: 64px; height: 5px; border-radius: 6px; margin-top: 22px; background: var(--red); }

/* ==========================================================
   MAP SECTION
   ========================================================== */
.page-body { background: var(--paper); padding-bottom: 100px; }
.page-body .wrap { width: min(1400px, calc(100% - 40px)); }

.map-wrap {
    margin: -80px auto 40px;
    background: #fff;
    border-radius: var(--r-lg);
    overflow: hidden;
    box-shadow: 0 30px 60px -15px rgba(0,0,0,.08), 0 0 0 1px rgba(226,232,240,.8);
    position: relative; z-index: 10;
    display: grid;
    grid-template-columns: 300px 1fr 280px;
    height: calc(100vh - var(--header-h) - 60px);
    min-height: 640px; max-height: 820px;
}

/* ===== SIDEBAR KIRI: tanpa scroll ===== */
.map-sidebar {
    border-right: 1px solid var(--line);
    background: #fff;
    display: flex; flex-direction: column;
    overflow: hidden;
    min-height: 0;
}
.map-sidebar-header {
    flex: 1; min-height: 0;
    padding: 22px 20px 18px;
    display: flex; flex-direction: column;
}
.map-sidebar-header h2 { font-family: var(--display); font-size: 1.15rem; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
.map-sidebar-header p { color: var(--muted); font-size: .8rem; line-height: 1.45; }

.filter-section { margin-top: 16px; }
.lbl { display: block; font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); margin-bottom: 8px; }

/* Daftar titik mengisi sisa ruang, hanya bagian ini yang scroll */
.filter-list { flex: 1; min-height: 0; display: flex; flex-direction: column; }
#daftar-titik { list-style: none; flex: 1; min-height: 0; overflow-y: auto; margin: 10px 0 0; padding-right: 4px; }

/* Chip kategori ringkas */
.chips { display: grid; gap: 6px; }
.chip {
    width: 100%; display: flex; align-items: center; gap: 10px;
    padding: 6px 10px; border: 1px solid transparent; border-radius: 10px;
    background: var(--soft); font-size: .85rem; font-weight: 600; color: var(--ink-2);
    transition: all .2s ease; text-align: left;
}
.chip:hover { background: #fff; border-color: var(--line); box-shadow: var(--shadow-sm); }
.chip .dot { width: 26px; height: 26px; border-radius: 7px; display: grid; place-items: center; color: #fff; font-size: .75rem; flex: none; }
.chip span:nth-child(2) { flex: 1; }
.chip b { min-width: 26px; text-align: center; font-size: .7rem; font-weight: 700; color: var(--ink-3); background: #e2e8f0; padding: 2px 8px; border-radius: 6px; }
.chip.off { opacity: .55; background: #fafafa; }
.chip.off .dot { filter: grayscale(.8); }

/* Input ringkas */
.form-control, .form-select {
    width: 100%; padding: 9px 12px; font-size: .88rem;
    border: 1px solid transparent; border-radius: 10px;
    background: var(--soft); color: var(--ink); margin-bottom: 0; font-weight: 500; transition: all .2s;
}
.form-control:disabled, .form-select:disabled { opacity: .5; cursor: not-allowed; }
.form-control:focus, .form-select:focus { outline: none; background: #fff; border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-soft); }
.search-wrap { position: relative; }
.search-wrap i { position: absolute; left: 13px; top: 12px; color: var(--muted); font-size: .8rem; pointer-events: none; }
.search-wrap .form-control { padding-left: 36px; }

.list-heading { display: flex; align-items: center; justify-content: space-between; color: var(--muted); font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 8px; }
.count-badge { min-width: 24px; text-align: center; padding: 2px 8px; border-radius: 999px; background: var(--soft); color: var(--ink-3); font-size: .7rem; font-weight: 700; }
.count-badge:empty { display: none; }

/* Scrollbar tipis */
.list-scroll::-webkit-scrollbar, #daftar-titik::-webkit-scrollbar { width: 4px; }
.list-scroll::-webkit-scrollbar-thumb, #daftar-titik::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

/* ===== PANEL KANAN: kecamatan ringkas ===== */
.map-list { border-left: 1px solid var(--line); display: flex; flex-direction: column; background: #fff; min-height: 0; overflow: hidden; }
.map-list-header { padding: 22px 20px 14px; border-bottom: 1px solid rgba(226,232,240,.6); }
.list-scroll { flex: 1; overflow-y: auto; min-height: 0; }
#daftar-kecamatan { list-style: none; margin: 0; padding: 10px 14px; }

/* Item daftar */
.item {
    width: 100%; cursor: pointer; display: flex; align-items: center; gap: 10px;
    padding: 8px 12px; margin-bottom: 3px; border-radius: 10px; border: 1px solid transparent;
    font-weight: 600; font-size: .85rem; color: var(--ink-2); background: transparent; text-align: left; transition: all .2s;
}
.item:hover { background: var(--soft); }
.item.aktif { background: var(--blue-soft); color: var(--blue); border-color: #bfdbfe; }
.item small { display: block; color: var(--muted); font-weight: 500; font-size: .75rem; margin-top: 1px; }
.item .meta { margin-left: auto; font-size: .7rem; color: var(--muted); background: var(--paper); padding: 3px 8px; border-radius: 6px; white-space: nowrap; }
.item.aktif .meta { background: rgba(37,99,235,.1); color: var(--blue); }
.warna { width: 12px; height: 12px; border-radius: 4px; flex: none; }
.kosong { padding: 18px 14px; color: var(--muted); font-size: .82rem; text-align: center; background: var(--paper); border-radius: 10px; border: 1px dashed var(--line); }

/* Map Area */
#map { height: 100%; width: 100%; z-index: 1; background: #e2e8f0; }
.leaflet-control-layers, .leaflet-control-zoom { border: none !important; border-radius: 12px !important; box-shadow: var(--shadow) !important; }
.leaflet-control-zoom { overflow: hidden; }
.leaflet-control-zoom a { color: var(--ink) !important; width: 36px !important; height: 36px !important; line-height: 36px !important; font-size: 1.1rem !important; }

/* ==========================================================
   PIN & POP-UP (LEAFLET)
   ========================================================== */
.pin {
    width: 36px; height: 36px; border-radius: 10px;
    display: grid; place-items: center; color: #fff; font-size: 0.95rem;
    border: 3px solid #fff; box-shadow: var(--shadow);
    transform: translateY(0); transition: all .2s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.leaflet-marker-icon:hover .pin { transform: translateY(-5px) scale(1.1); box-shadow: var(--shadow-lg); }

.leaflet-popup-content-wrapper {
    border-radius: 20px !important;
    box-shadow: 0 24px 48px -12px rgba(0,0,0,0.18), 0 0 0 1px rgba(0,0,0,0.05) !important;
    padding: 4px !important;
}
.leaflet-popup-content { margin: 24px 24px 20px !important; min-width: 280px !important; }

.leaflet-container a.leaflet-popup-close-button {
    top: 14px !important; right: 14px !important;
    color: var(--muted) !important; font-size: 18px !important;
    width: 28px !important; height: 28px !important; line-height: 28px !important;
    border-radius: 8px; transition: all 0.2s ease;
}
.leaflet-container a.leaflet-popup-close-button:hover { color: var(--red) !important; background: var(--soft); }

.popup h3 { margin: 0 0 16px; font-size: 1.2rem; font-family: var(--display); border-bottom: 1px solid var(--line); padding-bottom: 14px; color: var(--ink); padding-right: 16px; }
.popup table { border-collapse: collapse; font-size: 0.9rem; color: var(--ink-2); width: 100%; }
.popup td { padding: 10px 10px 10px 0; vertical-align: top; border-bottom: 1px dashed var(--line); }
.popup tr:last-child td { border-bottom: none; }
.popup td:first-child { color: var(--muted); font-weight: 600; width: 35%; white-space: nowrap; }
.popup td:nth-child(2) { white-space: pre-line; overflow-wrap: break-word; word-break: break-word; width: 65%; font-weight: 500; }
.popup a {
    display: inline-flex; align-items: center; gap: 8px; width: 100%; justify-content: center;
    color: #fff; background: var(--blue); padding: 12px 16px; border-radius: 10px;
    font-weight: 600; font-size: 0.9rem; margin-top: 20px; transition: .2s;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}
.popup a:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3); }

/* ==========================================================
   FOOTER
   ========================================================== */
.footer { background: #0f172a; color: rgba(255,255,255,0.7); padding: 80px 0 30px; }
.footer-grid { display: grid; grid-template-columns: 1fr 1.2fr 0.8fr; gap: 50px; }
.footer h3 { font-family: var(--display); color: #fff; font-size: 1.2rem; margin-bottom: 20px; }
.footer-about img { height: 60px; width: auto; margin-bottom: 20px; }
.footer-about p { font-size: 0.95rem; line-height: 1.7; }
.footer .map { position: relative; height: 180px; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); }
.footer .map iframe { width: 100%; height: 100%; border: 0; filter: grayscale(0.5); transition: .3s; }
.footer .map:hover iframe { filter: none; }
.map-link { position: absolute; inset: 0; z-index: 2; display: flex; align-items: flex-end; justify-content: flex-end; padding: 14px; }
.map-link span { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 8px; background: var(--red); color: #fff; font-size: 0.8rem; font-weight: 700; box-shadow: var(--shadow); transition: .2s; }
.map-link:hover span { background: var(--red-dark); transform: translateY(-2px); }
.find { display: inline-flex; align-items: center; gap: 10px; margin-top: 20px; color: #fff; font-size: 0.9rem; font-weight: 600; }
.find i { color: #f87171; }
.footer-links li+li { margin-top: 12px; }
.footer-links a { display: flex; align-items: center; gap: 12px; font-size: 0.95rem; }
.footer-links a i { font-size: 0.7rem; color: #f87171; transition: .2s; }
.footer-links a:hover { color: #fff; gap: 16px; }
.footer-bar { margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; font-size: 0.9rem; }
.social { display: flex; gap: 10px; }
.social a { width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; background: rgba(255,255,255,0.05); color: #fff; transition: .2s; font-size: 1.1rem; }
.social a:hover { background: var(--red); transform: translateY(-2px); }

/* ==========================================================
   SOS FAB
   ========================================================== */
.beacon{position:relative;width:10px;height:10px;border-radius:50%;background:#fff;flex:none}
.beacon::after{content:"";position:absolute;inset:0;border-radius:50%;background:#fff;animation:ping 1.8s cubic-bezier(0,0,.2,1) infinite}
@keyframes ping{0%{transform:scale(1);opacity:.7}100%{transform:scale(3.2);opacity:0}}
.sos-fab{position:fixed;right:32px;bottom:32px;z-index:1001;display:flex;flex-direction:column;align-items:flex-end;gap:16px;opacity:0;visibility:hidden;transform:translateY(20px);transition:.3s cubic-bezier(0.4, 0, 0.2, 1)}
.sos-fab.show{opacity:1;visibility:visible;transform:none}
.sos-fab-btn{display:inline-flex;align-items:center;gap:12px;padding:16px 24px;border-radius:16px;background:var(--red);color:#fff;font-weight:700;font-size:0.95rem;box-shadow: 0 8px 16px rgba(220, 38, 38, 0.3); transition:all .2s}
.sos-fab-btn:hover{background:var(--red-dark);transform:translateY(-3px);box-shadow: 0 12px 20px rgba(220, 38, 38, 0.4);}
.sos-sheet{display:none;width:min(320px,calc(100vw - 48px));padding:10px;border-radius:16px;background:#0f172a;border:1px solid rgba(255,255,255,.1);box-shadow:0 25px 50px -12px rgba(0,0,0,0.5)}
.sos-fab.open .sos-sheet{display:grid;gap:6px;animation:slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1)}
@keyframes slideUp { from { opacity: 0; transform: translateY(10px) scale(0.98); } to { opacity: 1; transform: translateY(0) scale(1); } }
.sos-sheet a{display:flex;align-items:center;gap:14px;padding:14px 16px;border-radius:10px;color:#fff;font-weight:600;font-size:0.95rem;transition:.2s;}
.sos-sheet a:hover{background:rgba(255,255,255,.1);transform:translateX(4px);}
.sos-sheet a i{width:24px;text-align:center;font-size:1.1rem}
.sos-sheet .wa i{color:#22c55e}.sos-sheet .tel i{color:#38bdf8}.sos-sheet .n112 i{color:#ef4444}

/* ==========================================================
   RESPONSIVE
   ========================================================== */
@media (max-width: 1200px) {
    .map-wrap { grid-template-columns: 270px 1fr 250px; }
}
@media (max-width: 991px) {
    .footer-grid { grid-template-columns: 1fr; gap: 40px; }
    .map-wrap { grid-template-columns: 1fr; height: auto; max-height: none; min-height: 0; margin-top: -40px; border-radius: 20px; }
    #map { order: -1; height: 60vh; min-height: 400px; }
    .map-sidebar { border-right: none; border-top: 1px solid var(--line); overflow: visible; }
    .filter-list { flex: none; }
    #daftar-titik { max-height: 240px; }
    .map-list { border-left: none; border-top: 1px solid var(--line); max-height: 380px; }
}
@media (max-width: 768px) {
    .chips { grid-template-columns: 1fr 1fr; }
    .page-hero { padding: 36px 0 100px; }
    .page-hero h1 { font-size: clamp(1.9rem, 8vw, 2.6rem); }
}
@media (max-width: 480px) {
    .chips { grid-template-columns: 1fr; }
    .brand span { display: none; }
    .sos-fab { right: 20px; bottom: 20px; }
}
</style>

</head>
<body>

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

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="/layanan-fasilitas/penggunaan-sarana">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
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
    <!-- ==================== HERO ==================== -->
    <section class="page-hero">
        <div class="wrap">
            <nav aria-label="Breadcrumb">
                <ol class="crumbs">
                    <li><a href="/">Beranda</a></li>
                    <li><span aria-current="page">Peta Operasional</span></li>
                </ol>
            </nav>
            <div class="hero-kicker"><i class="fas fa-map-marked-alt"></i> SIGAPKAR SIMERAH KOJA</div>
            <h1>SIGAPKAR Kota Jambi</h1>
            <h2>Sistem Informasi Geografis Antisipasi dan Penanggulangan Kebakaran Kota Jambi</h2>
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

                        <div class="filter-section filter-list">
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
       1. NAVIGASI MENU MULTI-DROPDOWN
       ========================================================= */
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
                var t = triggerOf(li);
                if (t) t.setAttribute('aria-expanded', 'false');
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
        if(!btn) return;
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

    /* Tombol Lapor Darurat (SOS FAB) */
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
       2. KONFIGURASI & STATE PETA
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
       6. RENDER PETA
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
            className: '', iconSize: [36, 36], iconAnchor: [18, 18], popupAnchor: [0, -18],
            html: `<div class="pin" style="background:${v.warna}"><i class="fas ${v.ikon}"></i></div>`
        });
        // Urutan baris: Kategori, Kecamatan, Lokasi, Keterangan, Tanggal
        const baris = [
            ['Kategori', v.label],
            ['Kecamatan', p.kecamatan],
            ['Lokasi', p.lokasi],
            ['Keterangan', p.keterangan],
            ['Tanggal', p.tanggal]
        ].filter(([, x]) => x).map(([a, b]) => `<tr><td>${esc(a)}</td><td>${esc(b)}</td></tr>`).join('');
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