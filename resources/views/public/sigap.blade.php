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
    --ink: #0d1b2a;
    --ink-2: #334155;
    --ink-3: #475569;
    --muted: #64748b;
    --paper: #f3f5f8;
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
.wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }

/* ==========================================================
   HEADER & NAVBAR
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
   HERO SIGAPKAR (Disamakan dengan halaman Visi Misi)
   ========================================================== */
.page-hero {
    position: relative;
    isolation: isolate;
    color: #fff;
    background: var(--ink);
    overflow: hidden;
    padding: clamp(36px, 6vw, 72px) 0 clamp(72px, 10vw, 112px);
}
.page-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    background:
        radial-gradient(55% 90% at 0% 100%, rgba(229,57,45,.4), transparent 70%),
        linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.86) 55%, rgba(13,27,42,.7) 100%),
        url('/images/background1.png') center / cover no-repeat;
}
.crumbs {
    display: flex; flex-wrap: wrap; align-items: center; gap: 10px;
    font-size: .9rem; color: rgba(255,255,255,.7);
    margin-bottom: clamp(18px, 3vw, 28px);
}
.crumbs li { display: inline-flex; align-items: center; gap: 10px; }
.crumbs li + li::before { content: "\203A"; opacity: .5; font-size: 1.1rem; }
.crumbs a:hover { color: #fff; }
.crumbs [aria-current="page"] { color: #fff; font-weight: 600; }

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
    font-family: var(--display); font-weight: 800; font-stretch: 82%;
    font-size: clamp(2.4rem, 6vw, 4.5rem);
    line-height: .98; letter-spacing: -0.035em; max-width: 800px;
}
.page-hero p, .page-hero h2 {
    font-family: var(--body); font-weight: 400;
    margin-top: 18px; max-width: 56ch;
    color: rgba(255,255,255,.75);
    font-size: clamp(1rem, 1.5vw, 1.15rem);
}

/* ==========================================================
   MAP SECTION
   ========================================================== */
.page-body { background: var(--paper); padding-top: 28px; padding-bottom: 100px; }
.page-body .wrap { max-width: 1400px; width: calc(100% - 40px); padding-left: 0; padding-right: 0; }

.map-wrap {
    margin: 0 auto 40px;
    background: #fff;
    border-radius: clamp(16px, 2vw, var(--r-lg));
    overflow: hidden;
    box-shadow: 0 30px 60px -15px rgba(0,0,0,.08), 0 0 0 1px rgba(226,232,240,.8);
    position: relative; z-index: 10;
    display: grid;
    grid-template-columns: 280px 1fr 440px;
    height: calc(100vh - var(--header-h) - 60px);
    height: calc(100dvh - var(--header-h) - 60px);
    min-height: 640px; max-height: 820px;
}

/* ===== SIDEBAR KIRI ===== */
.map-sidebar {
    border-right: 1px solid var(--line);
    background: #fff;
    display: flex; flex-direction: column;
    overflow: hidden;
    min-height: 0;
}
.map-sidebar-header {
    flex: 1; min-height: 0;
    padding: 16px 20px 14px;
    display: flex; flex-direction: column;
}
.map-sidebar-header h2 { font-family: var(--display); font-size: 1.15rem; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
.map-sidebar-header p { color: var(--muted); font-size: .8rem; line-height: 1.45; }

.filter-section { margin-top: 12px; }
.lbl { display: block; font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); margin-bottom: 6px; }

.filter-list { flex: 1; min-height: 0; display: flex; flex-direction: column; }
#daftar-titik { list-style: none; flex: 1; min-height: 0; overflow-y: auto; margin: 10px 0 0; padding-right: 4px; }

/* Chip kategori */
.chips { display: grid; gap: 4px; flex: none; }
.chip {
    width: 100%; min-height: 36px; display: flex; align-items: center; gap: 10px;
    padding: 5px 10px; border: 1px solid var(--line); border-radius: 10px;
    background: #fff; box-shadow: var(--shadow-sm);
    font-size: .82rem; font-weight: 600; color: var(--ink-2);
    transition: all .2s ease; text-align: left;
}
.chip:hover { border-color: #cbd5e1; box-shadow: var(--shadow); }
.chip .dot { width: 24px; height: 24px; border-radius: 7px; display: grid; place-items: center; color: #fff; font-size: .72rem; flex: none; }
.chip span:nth-child(2) { flex: 1; }
.chip b { min-width: 26px; text-align: center; font-size: .7rem; font-weight: 700; color: var(--ink-3); background: #e2e8f0; padding: 2px 8px; border-radius: 6px; }
.chip.off { opacity: .6; background: var(--soft); border-color: transparent; box-shadow: none; }
.chip.off:hover { opacity: .9; background: #fff; border-color: var(--line); }
.chip.off .dot { filter: grayscale(.6); }

/* Ikon SVG (hydrant) mengikuti ukuran font */
.dot svg, .pin svg, .dot-mini svg { width: 1em; height: 1em; display: block; }
.dot-mini {
    width: 30px; height: 30px; border-radius: 9px; display: grid; place-items: center;
    color: #fff; font-size: .8rem; flex: none;
}

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
.list-scroll::-webkit-scrollbar, #daftar-titik::-webkit-scrollbar, .chips::-webkit-scrollbar { width: 4px; }
.list-scroll::-webkit-scrollbar-thumb, #daftar-titik::-webkit-scrollbar-thumb, .chips::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

/* ===== PANEL KANAN: navigasi & kecamatan ===== */
.map-list { border-left: 1px solid var(--line); display: flex; flex-direction: column; background: #fff; min-height: 0; overflow-y: auto; }
.map-list-header { padding: 14px 14px 12px; }

/* Grid 2 Card Berdampingan */
.side-features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
@media (max-width: 768px) {
    .side-features-grid {
        grid-template-columns: 1fr;
    }
}
.side-feature-card {
    background: #f8fafc;
    border: 1px solid var(--line);
    border-radius: 12px;
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    transition: border-color .2s, box-shadow .2s;
}
.side-feature-card:hover {
    border-color: #cbd5e1;
    background: #ffffff;
    box-shadow: 0 4px 12px -2px rgba(15, 23, 42, 0.05);
}
.side-card-header-flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 22px;
}
.side-card-title {
    font-size: 0.73rem;
    font-weight: 700;
    color: var(--ink);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    gap: 5px;
}
.side-card-title i {
    color: var(--blue);
}
.side-card-section {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.side-field-label {
    font-size: 0.67rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 2px;
}

/* Saklar filter kecamatan (dalam card) */
.side-feature-card .kec-toggle {
    position: relative; display: flex; align-items: center; justify-content: space-between;
    gap: 8px; padding: 7px 8px; margin-bottom: 0;
    border: 1px solid rgba(226, 232, 240, 0.9); border-radius: 8px;
    background: #ffffff; cursor: pointer;
}
.kec-toggle-text { display: flex; flex-direction: column; min-width: 0; }
.kec-toggle-text b { font-size: 0.77rem; color: var(--ink); line-height: 1.2; }
.kec-toggle-text small { font-size: 0.65rem; color: var(--muted); line-height: 1.2; margin-top: 2px; }
.kec-toggle input { position: absolute; opacity: 0; width: 1px; height: 1px; }
.kec-switch { position: relative; flex: none; width: 34px; height: 18px; border-radius: 999px; background: #cbd5e1; transition: background .2s; }
.kec-switch::after { content: ""; position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; border-radius: 50%; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,.25); transition: transform .2s; }
.kec-toggle input:checked + .kec-switch { background: var(--blue); }
.kec-toggle input:checked + .kec-switch::after { transform: translateX(16px); }
.kec-toggle input:focus-visible + .kec-switch { outline: 2px solid rgba(37, 99, 235, 0.5); outline-offset: 1px; }

/* Dropdown Kecamatan */
.form-select-side {
    width: 100%;
    background-color: #ffffff;
    border: 1px solid var(--line);
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
    padding: 7px 8px;
    transition: all .15s;
    cursor: pointer;
}
.form-select-side:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 2.5px var(--blue-soft);
}
.form-select-side:disabled {
    opacity: .6;
    cursor: not-allowed;
    background-color: #f1f5f9;
}
.badge-kecamatan-info {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 8px;
    border-radius: 6px;
    background: var(--blue-soft);
    color: var(--blue);
    font-size: 0.72rem;
    font-weight: 600;
    margin-top: 2px;
}
.dot-kec {
    width: 8px; height: 8px; border-radius: 50%; flex: none;
}

/* Navigasi Titik & Koordinat */
.btn-gps-ping {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 7px 9px;
    background: var(--blue-soft);
    color: var(--blue);
    border: 1px solid #bfdbfe;
    border-radius: 8px;
    font-size: 0.76rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
}
.btn-gps-ping:hover:not(:disabled) {
    background: #dbeafe;
    border-color: #93c5fd;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(37, 99, 235, 0.15);
}
.btn-gps-ping:active {
    transform: translateY(0);
}
.btn-gps-ping:disabled {
    opacity: 0.65;
    cursor: not-allowed;
}
.btn-clear-location {
    background: transparent;
    border: none;
    color: #ef4444;
    font-size: 0.7rem;
    font-weight: 600;
    cursor: pointer;
    padding: 2px 4px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 3px;
    transition: background .15s;
}
.btn-clear-location:hover {
    background: #fee2e2;
}

.coord-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px;
}
.coord-input-group {
    position: relative;
    display: flex;
    align-items: center;
}
.coord-label {
    position: absolute;
    left: 7px;
    font-size: 0.63rem;
    font-weight: 700;
    color: var(--muted);
    pointer-events: none;
    text-transform: uppercase;
}
.form-control-side {
    width: 100%;
    padding: 6px 5px 6px 26px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid var(--line);
    border-radius: 7px;
    background: #ffffff;
    color: var(--ink);
    transition: all .15s;
}
.form-control-side:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 2px var(--blue-soft);
}
.btn-apply-location {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 6px 8px;
    background: #0d1b2a;
    color: #ffffff;
    border: 1px solid #0d1b2a;
    border-radius: 7px;
    font-size: 0.74rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
    margin-top: 2px;
}
.btn-apply-location:hover {
    background: #1e293b;
    border-color: #1e293b;
    box-shadow: 0 2px 5px rgba(13, 27, 42, 0.2);
}
.nav-feedback {
    font-size: 0.68rem;
    padding: 4px 6px;
    border-radius: 6px;
    line-height: 1.3;
    margin-top: 3px;
}
.nav-feedback.is-success {
    background: #f0fdf4;
    color: #15803d;
    border: 1px solid #bbf7d0;
}
.nav-feedback.is-error {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
}

/* User Location Marker Animation */
.user-pulse-marker {
    width: 20px;
    height: 20px;
    background: #2563eb;
    border: 3px solid #ffffff;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.35);
    position: relative;
    cursor: pointer;
}
.user-pulse-marker::after {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px solid #2563eb;
    animation: userPinPulse 2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
}
@keyframes userPinPulse {
    0% { transform: scale(0.6); opacity: 1; }
    70% { transform: scale(1.6); opacity: 0; }
    100% { transform: scale(1.8); opacity: 0; }
}

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
.leaflet-popup-content { margin: 24px 24px 20px !important; min-width: min(280px, 68vw) !important; }

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
   GRAFIK STATISTIK
   ========================================================== */
.stats { display: flex; flex-direction: column; gap: 28px; margin-top: 28px; }
.stats[hidden] { display: none; }

.stat-card {
    background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg);
    padding: 26px 28px; box-shadow: var(--shadow-sm); transition: box-shadow .2s;
    display: flex; flex-direction: column;
}
.stat-card:hover { box-shadow: var(--shadow); }
.stat-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; flex-wrap: wrap; }
.stat-head-info { display: flex; align-items: center; gap: 14px; }
.stat-head-icon {
    width: 44px; height: 44px; border-radius: 12px; background: var(--soft);
    display: grid; place-items: center; color: var(--blue); font-size: 1.15rem; flex: none;
}
.stat-head h3 { font-family: var(--display); font-size: 1.15rem; font-weight: 700; color: var(--ink); line-height: 1.3; }
.stat-head p { margin-top: 2px; font-size: .82rem; color: var(--muted); }
.stat-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.stat-select {
    padding: 7px 14px; border-radius: 999px; border: 1.5px solid var(--line);
    background: #fff; font-size: .82rem; font-weight: 600; color: var(--ink-2);
    cursor: pointer; transition: all .2s; outline: none; box-shadow: var(--shadow-sm);
}
.stat-select:hover { border-color: #cbd5e1; }
.stat-select:focus { border-color: var(--blue); box-shadow: 0 0 0 3px var(--blue-soft); }
.stat-total {
    flex: none; padding: 6px 14px; border-radius: 999px;
    background: var(--soft); color: var(--ink-2); font-size: .78rem; font-weight: 700; white-space: nowrap;
    border: 1px solid rgba(226, 232, 240, 0.8);
}
.chart-box { position: relative; height: 380px; width: 100%; min-height: 0; }
.chart-box--kec { height: 380px; }
.stat-hint-wrap { margin-top: 18px; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
.stat-hint {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 7px 14px; border-radius: 8px; background: var(--soft);
    font-size: .78rem; font-weight: 500; color: var(--ink-3); border: 1px solid var(--line);
}
.stat-hint i { color: var(--blue); font-size: .82rem; }

/* ==========================================================
   FOOTER
   ========================================================== */
.footer { background: var(--ink); color: rgba(255,255,255,0.7); padding: 80px 0 30px; }
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
.social { display: flex; flex-wrap: wrap; gap: 10px; }
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

/* ===== KARTU BUFFER TITIK RAWAN DI DALAM SIDEBAR (MAP-LIST) ===== */
.sidebar-buffer-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px 12px;
    margin-bottom: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    transition: all 0.2s ease;
}
.sidebar-buffer-card:hover {
    border-color: #cbd5e1;
}
.sbc-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    user-select: none;
    padding-bottom: 6px;
    border-bottom: 1px solid #e2e8f0;
}
.sidebar-buffer-card.is-collapsed .sbc-header {
    padding-bottom: 0;
    border-bottom: none;
}
.sbc-title {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
}
.badge-rtrw {
    font-size: 0.65rem;
    font-weight: 700;
    background: #fee2e2;
    color: #dc2626;
    padding: 2px 6px;
    border-radius: 4px;
    text-transform: uppercase;
}
.sbc-collapse-btn {
    background: none;
    border: none;
    padding: 2px 4px;
    color: var(--muted);
    font-size: 0.72rem;
    cursor: pointer;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sbc-collapse-btn:hover {
    color: var(--ink);
}
.sbc-icon-chevron {
    transition: transform 0.25s ease;
}
.sidebar-buffer-card.is-collapsed .sbc-icon-chevron {
    transform: rotate(180deg);
}
.sbc-body {
    padding-top: 8px;
    display: block;
}
.sidebar-buffer-card.is-collapsed .sbc-body {
    display: none;
}
.sbc-legend-list {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 8px;
}
.sbc-item {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    padding: 4px 6px;
    border-radius: 6px;
    transition: background 0.15s, opacity 0.15s;
}
.sbc-item.is-dimmed {
    opacity: 0.38;
}
.sbc-item.is-highlighted {
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.sbc-indicator {
    width: 12px;
    height: 12px;
    border-radius: 3px;
    flex-shrink: 0;
    margin-top: 3px;
}
.sbc-indicator.bg-danger { background-color: #ef4444; }
.sbc-indicator.bg-warning { background-color: #f59e0b; }
.sbc-item-info strong {
    display: block;
    font-size: 0.76rem;
    color: var(--ink);
    line-height: 1.25;
}
.sbc-item-info small {
    display: block;
    font-size: 0.68rem;
    color: var(--muted);
    line-height: 1.25;
    margin-top: 1px;
}
.sbc-slider-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 6px 8px;
    margin-bottom: 8px;
}
.sbc-slider-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--ink-2);
    margin-bottom: 2px;
}
.sbc-slider {
    width: 100%;
    height: 4px;
    cursor: pointer;
    accent-color: #ef4444;
}
.sbc-check-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--ink-2);
    margin-bottom: 8px;
    cursor: pointer;
    user-select: none;
}
.sbc-check-label input {
    cursor: pointer;
    accent-color: #ef4444;
}
.btn-sbc-modal {
    width: 100%;
    padding: 7px 10px;
    border-radius: 8px;
    background: var(--ink);
    color: #fff;
    font-size: 0.73rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 2px 4px rgba(15, 23, 42, 0.12);
}
.btn-sbc-modal:hover {
    background: #1e293b;
    transform: translateY(-1px);
}

/* Styling Khusus Layer Zonasi Risiko Vektor & Popup */
.popup-risiko {
    min-width: 260px;
    max-width: 310px;
}
.popup-risiko-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 8px;
    padding-bottom: 6px;
    border-bottom: 1px solid #e2e8f0;
}
.popup-risiko-header h3 {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--ink);
}
.badge-status-risiko {
    font-size: 0.68rem;
    font-weight: 700;
    color: #fff;
    padding: 2px 8px;
    border-radius: 9999px;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    white-space: nowrap;
}
.badge-kel-rawan {
    display: inline-block;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
    font-size: 0.68rem;
    font-weight: 600;
    padding: 1px 6px;
    border-radius: 6px;
    margin: 1px;
}
.kel-chips-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 3px;
    max-height: 80px;
    overflow-y: auto;
    margin-top: 2px;
}
.toggle-pin-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.73rem;
    font-weight: 600;
    color: var(--ink-2);
    margin: 8px 0;
    cursor: pointer;
}
.toggle-pin-label input {
    cursor: pointer;
    accent-color: var(--red);
}

/* Modal Dokumen Peta Asli */
.custom-modal-backdrop {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(13, 27, 42, 0.75);
    backdrop-filter: blur(6px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.custom-modal-dialog {
    background: #fff;
    border-radius: 18px;
    width: 100%;
    max-width: 900px;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    overflow: hidden;
}
.custom-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 22px;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}
.custom-modal-header h4 {
    margin: 0;
    font-size: 1rem;
    color: var(--ink);
    font-weight: 700;
}
.btn-external-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid #cbd5e1;
    color: var(--ink-2);
    font-size: 0.85rem;
    transition: all 0.2s;
}
.btn-external-link:hover {
    background: var(--blue-soft);
    color: var(--blue);
    border-color: var(--blue);
}
.btn-close-modal {
    background: none;
    border: none;
    font-size: 1.6rem;
    line-height: 1;
    color: var(--muted);
    cursor: pointer;
}
.btn-close-modal:hover { color: var(--ink); }
.custom-modal-body {
    padding: 18px 22px;
    overflow-y: auto;
}
.modal-zoom-toolbar {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 3px 6px;
}
.btn-zoom-action {
    background: #fff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    width: 28px;
    height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--ink);
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.15s;
}
.btn-zoom-action:hover {
    background: var(--blue-soft);
    color: var(--blue);
    border-color: var(--blue);
}
.zoom-level-badge {
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--ink-2);
    min-width: 40px;
    text-align: center;
}
.img-preview-scroll {
    text-align: center;
    background: #f1f5f9;
    border-radius: 12px;
    padding: 16px;
    border: 1px solid #e2e8f0;
    overflow: auto;
    max-height: calc(85vh - 140px);
}
#modal-zoomable-img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    transition: transform 0.2s cubic-bezier(0.2, 0, 0, 1);
    display: inline-block;
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; }
}

/* ==========================================================
   RESPONSIVE
   ========================================================== */

/* Laptop kecil */
@media (max-width: 1200px) {
    .map-wrap { grid-template-columns: 260px 1fr 390px; }
}

/* Tablet: peta penuh di atas, filter & kecamatan berdampingan */
@media (max-width: 991px) {
    .footer-grid { grid-template-columns: 1fr; gap: 40px; }

    .map-wrap {
        grid-template-columns: 1fr 1fr; height: auto; max-height: none; min-height: 0;
        margin-top: 0;
    }
    #map { grid-column: 1 / -1; order: -1; height: 56vh; min-height: 380px; }
    .map-sidebar { border-right: 1px solid var(--line); border-top: 1px solid var(--line); overflow: visible; }
    .filter-list { flex: none; }
    .chips { max-height: none; }
    #daftar-titik { max-height: 240px; }
    .map-list { border-left: none; border-top: 1px solid var(--line); max-height: none; }
    .map-list .list-scroll { max-height: 420px; }

    .stats { gap: 24px; }
    .chart-box { height: 340px; }
    .chart-box--kec { height: 340px; }
}

/* Mobile: satu kolom */
@media (max-width: 640px) {
    .page-body .wrap { width: calc(100% - 28px); }
    .map-wrap { grid-template-columns: 1fr; margin-top: 0; }
    .map-sidebar { border-right: none; }
    #map { height: 52vh; min-height: 320px; }
    .chips { grid-template-columns: 1fr 1fr; }
    .chip { padding: 6px 8px; font-size: .78rem; gap: 8px; }
    .chip b { min-width: 22px; padding: 2px 6px; }
    #daftar-titik { max-height: 260px; }
    .stat-card { padding: 18px 16px; }
    .stat-head { flex-direction: column; align-items: flex-start; gap: 14px; }
    .stat-actions { width: 100%; justify-content: space-between; }
    .stat-select { flex: 1; min-width: 0; }
    .chart-box { height: 300px; }
    .chart-box--kec { height: 300px; }
    .footer { padding: 56px 0 24px; }
    .sos-fab { right: 16px; bottom: 16px; }
    .sos-fab-btn { padding: 14px 18px; }
}
@media (max-width: 380px) {
    .chips { grid-template-columns: 1fr; }
}

/* ==========================================================
   PENYEMPURNAAN UI/UX (override — letakkan paling akhir)
   Sistem: radius 12 (kontrol) / 16 (kartu) / 20 (panel),
   border 1px #e2e8f0, satu level bayangan, satu aksen biru
   untuk interaksi dan merah hanya untuk darurat.
   ========================================================== */
:root {
    --r-ctl: 12px; --r-card: 16px; --r-panel: 20px;
    --ring: 0 0 0 3px rgba(37,99,235,.18);
    --panel-left: 300px; --panel-right: 380px;
}
body { font-size: 15px; background: #f4f6f9; }
::selection { background: #fde68a; color: var(--ink); }

/* ---------- Hero: lebih ringkas, peta cepat terlihat ---------- */
.page-hero { padding: clamp(24px, 4vw, 44px) 0 clamp(64px, 8vw, 88px); }
.crumbs { margin-bottom: 16px; font-size: .85rem; }
.hero-kicker { text-transform: none; letter-spacing: 0; font-size: .82rem; font-weight: 600; padding: 6px 14px; margin-bottom: 14px; }
.page-hero h1 { font-size: clamp(2rem, 4.6vw, 3.4rem); max-width: 18ch; }
.page-hero p { margin-top: 12px; font-size: clamp(.95rem, 1.3vw, 1.05rem); max-width: 52ch; }

/* ---------- Kontainer peta: naik menimpa hero ---------- */
.page-body { padding-top: 0; padding-bottom: 72px; }
.page-body .wrap { max-width: 1480px; width: calc(100% - 32px); }
.map-wrap {
    margin-top: -48px; margin-bottom: 28px;
    grid-template-columns: var(--panel-left) minmax(0,1fr) var(--panel-right);
    height: min(calc(100dvh - var(--header-h) - 32px), 860px);
    min-height: 620px; max-height: none;
    border-radius: var(--r-panel);
    box-shadow: 0 24px 48px -16px rgba(13,27,42,.22), 0 0 0 1px var(--line);
}

/* ---------- Panel kiri ---------- */
.map-sidebar-header { padding: 20px 18px 14px; gap: 0; }
.map-sidebar-header h2 { font-size: 1.1rem; letter-spacing: -.01em; }
#ringkas { margin-top: 2px; padding: 8px 10px; border-radius: 10px; background: var(--soft); color: var(--ink-3); font-size: .78rem; }
.filter-section { margin-top: 16px; }
.lbl { text-transform: none; letter-spacing: 0; font-size: .78rem; font-weight: 600; color: var(--ink-2); margin-bottom: 8px; }

.chips { gap: 6px; }
.chip { min-height: 40px; border-radius: var(--r-ctl); box-shadow: none; padding: 5px 10px 5px 6px; }
.chip:hover { background: var(--soft); border-color: #cbd5e1; box-shadow: none; }
.chip:not(.off) { border-color: var(--ink); background: #fff; box-shadow: inset 0 0 0 1px var(--ink); }
.chip .dot { width: 28px; height: 28px; border-radius: 8px; }
.chip b { background: var(--soft); color: var(--ink-2); border-radius: 999px; }
.chip.off { opacity: 1; background: #fff; border-color: var(--line); color: var(--muted); }
.chip.off .dot { filter: grayscale(.7); opacity: .75; }

.form-control, .form-select, .form-select-side {
    min-height: 42px; border: 1px solid var(--line); background: #fff; border-radius: var(--r-ctl);
}
.form-select, .form-select-side { cursor: pointer; }
.form-control:hover:not(:disabled), .form-select:hover:not(:disabled), .form-select-side:hover:not(:disabled) { border-color: #cbd5e1; }
.form-control:focus, .form-select:focus, .form-select-side:focus, .form-control-side:focus { border-color: var(--blue); box-shadow: var(--ring); }
.form-control:disabled, .form-select:disabled { background: var(--soft); }
.search-wrap i { top: 14px; }

.list-heading { font-size: .78rem; font-weight: 600; color: var(--ink-2); text-transform: none; letter-spacing: 0; margin-bottom: 8px; }
.count-badge { background: var(--ink); color: #fff; }
#daftar-titik { margin-top: 10px; display: flex; flex-direction: column; gap: 4px; padding-right: 6px; }
#daftar-titik > li { border-radius: 12px; transition: background .15s; }
#daftar-titik > li:hover { background: var(--soft); }
#daftar-titik .kosong, .kosong { padding: 18px 12px; text-align: center; color: var(--muted); font-size: .85rem; border: 1px dashed var(--line); border-radius: 12px; }

/* ---------- Panel kanan ---------- */
.map-list { background: #f8fafc; overflow-y: auto; min-height: 0; border-left: 1px solid var(--line); }
.map-list-header { padding: 16px; display: flex; flex-direction: column; gap: 12px; }
.side-features-grid { display: flex; flex-direction: column; gap: 12px; }
.side-feature-card, .sidebar-buffer-card {
    background: #fff; border: 1px solid var(--line); border-radius: var(--r-card);
    box-shadow: none; padding: 16px; transform: none;
}
.side-feature-card:hover, .sidebar-buffer-card:hover { box-shadow: none; transform: none; border-color: #cbd5e1; }
.side-card-title { font-size: .92rem; font-weight: 700; color: var(--ink); gap: 10px; }
.side-card-title i { width: 30px; height: 30px; display: inline-grid; place-items: center; border-radius: 9px; background: var(--blue-soft); color: var(--blue); font-size: .8rem; }
.side-field-label { text-transform: none; letter-spacing: 0; font-size: .78rem; font-weight: 600; color: var(--ink-2); }
.side-card-section { margin-top: 14px; }

.side-feature-card .kec-toggle { padding: 10px 12px; border-radius: var(--r-ctl); background: var(--soft); border: 1px solid transparent; margin-top: 12px; cursor: pointer; }
.kec-toggle-text b { font-size: .84rem; }
.kec-toggle-text small { font-size: .72rem; }
.kec-switch { width: 40px; height: 22px; background: #cbd5e1; }
.kec-switch::after { width: 18px; height: 18px; }
.kec-toggle input:checked + .kec-switch::after { transform: translateX(18px); }

.btn-gps-ping, .btn-apply-location, .btn-sbc-modal { min-height: 42px; border-radius: var(--r-ctl); font-size: .85rem; font-weight: 600; padding: 9px 12px; margin-top: 12px; }
.btn-gps-ping { background: var(--blue); border-color: var(--blue); color: #fff; }
.btn-gps-ping:hover:not(:disabled) { background: #1d4ed8; border-color: #1d4ed8; transform: none; box-shadow: none; }
.btn-apply-location { margin-top: 10px; }
.btn-apply-location:hover { background: #1e293b; box-shadow: none; }
.coord-grid { gap: 8px; margin-top: 2px; }
.coord-label { left: 10px; font-size: .68rem; }
.form-control-side { min-height: 42px; padding: 8px 8px 8px 34px; font-size: .85rem; border-radius: var(--r-ctl); }
.nav-feedback { font-size: .78rem; padding: 8px 10px; border-radius: 10px; margin-top: 10px; }
.btn-clear-location { min-height: 32px; padding: 4px 8px; font-size: .75rem; border-radius: 8px; }
.badge-kecamatan-info { border-radius: 8px; padding: 6px 10px; margin-top: 8px; }

/* Kartu buffer */
.sbc-header { cursor: pointer; border-radius: var(--r-ctl); }
.sbc-title { font-weight: 700; font-size: .92rem; }
.sbc-item { border-radius: 12px; }
.sbc-item-info strong { font-size: .84rem; }
.sbc-item-info small { font-size: .75rem; line-height: 1.45; }
.sbc-slider { accent-color: var(--blue); }
.btn-sbc-modal { background: #fff; border: 1px solid var(--line); color: var(--ink); }
.btn-sbc-modal:hover { background: var(--soft); border-color: #cbd5e1; }

/* ---------- Peta ---------- */
#map { background: #e8edf3; }
.leaflet-control-layers, .leaflet-control-zoom { border: 1px solid var(--line) !important; box-shadow: 0 4px 12px rgba(13,27,42,.12) !important; border-radius: var(--r-ctl) !important; }
.leaflet-control-layers-expanded { padding: 10px 12px !important; font-family: var(--body); font-size: .85rem; }
.pin { border-radius: 12px; border-width: 2.5px; box-shadow: 0 4px 10px rgba(13,27,42,.28); }
.leaflet-tooltip { border: 0; border-radius: 10px; padding: 7px 11px; font-family: var(--body); font-weight: 600; color: var(--ink); box-shadow: 0 6px 16px rgba(13,27,42,.2); }
.leaflet-popup-content-wrapper { border-radius: var(--r-panel) !important; padding: 0 !important; }
.leaflet-popup-content { margin: 20px 20px 18px !important; font-family: var(--body); }
.popup h3 { font-size: 1.05rem; padding-bottom: 12px; margin-bottom: 8px; }
.popup td { padding: 9px 10px 9px 0; }

/* ---------- Statistik ---------- */
.stats { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 20px; margin-top: 0; }
.stat-card { border: 1px solid var(--line); border-radius: var(--r-panel); box-shadow: none; padding: 24px; background: #fff; }
.stat-card:hover { box-shadow: none; }
.stat-head { margin-bottom: 18px; }
.stat-head h3 { font-size: 1.05rem; }
.stat-select { min-height: 40px; border-radius: var(--r-ctl); }
.stat-hint { color: var(--muted); }
.chart-box, .chart-box--kec { height: 340px; }

/* ---------- Modal dokumen ---------- */
.custom-modal-backdrop { backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); background: rgba(13,27,42,.7); }
.custom-modal-dialog { border-radius: var(--r-panel); overflow: hidden; }
.btn-close-modal, .btn-external-link, .btn-zoom-action { min-width: 40px; min-height: 40px; border-radius: 10px; }

/* ---------- FAB darurat ---------- */
.sos-fab-btn { border-radius: 999px; padding: 14px 22px; font-weight: 700; box-shadow: 0 10px 24px rgba(220,38,38,.35); }
.sos-sheet { border-radius: var(--r-card); }

/* ---------- Fokus & aksesibilitas ---------- */
.chip:focus-visible, .btn-gps-ping:focus-visible, .btn-apply-location:focus-visible, .btn-sbc-modal:focus-visible, .sbc-header:focus-visible {
    outline: 3px solid rgba(37,99,235,.55); outline-offset: 2px;
}
.chip, .btn-gps-ping, .btn-apply-location, .btn-sbc-modal, .stat-select { touch-action: manipulation; }

/* ---------- Responsif ---------- */
@media (max-width: 1280px) {
    :root { --panel-left: 270px; --panel-right: 340px; }
}
@media (max-width: 1100px) {
    .map-wrap { grid-template-columns: 1fr 1fr; height: auto; min-height: 0; margin-top: -40px; }
    #map { grid-column: 1 / -1; order: -1; height: 58vh; min-height: 400px; }
    .map-sidebar { border-top: 1px solid var(--line); border-right: 1px solid var(--line); overflow: visible; }
    .map-sidebar-header { flex: none; }
    .filter-list { flex: none; }
    #daftar-titik { max-height: 280px; }
    .map-list { border-left: 0; border-top: 1px solid var(--line); overflow: visible; }
    .stats { grid-template-columns: 1fr; }
}
@media (max-width: 720px) {
    .page-body .wrap { width: calc(100% - 20px); }
    .map-wrap { grid-template-columns: 1fr; margin-top: -32px; border-radius: var(--r-card); }
    .map-sidebar { border-right: 0; }
    #map { height: 56vh; min-height: 340px; }
    .chips { grid-template-columns: 1fr 1fr; }
    .stat-card { padding: 18px 16px; }
    .chart-box, .chart-box--kec { height: 300px; }
    .sos-fab { right: 14px; bottom: 14px; }
    .sos-fab-btn span:not(.beacon) { font-size: .9rem; }
}
@media (max-width: 380px) { .chips { grid-template-columns: 1fr; } }
</style>

</head>
<body>

@include('layouts.partials.public-header')

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
            <p>Sistem Informasi Geografis Antisipasi dan Penanggulangan Kebakaran Kota Jambi.</p>
        </div>

        {{-- Logo mengambang (float) persis seperti di halaman Visi Misi --}}
        @include('layouts.partials.hero-logos', ['float' => true])
    </section>

    <!-- ==================== PETA ==================== -->
    <div class="page-body">
        <div class="wrap">
            <div class="map-wrap">

                <aside class="map-sidebar">
                    <div class="map-sidebar-header">
                        <h2>Filter Data Peta</h2>
                        <p id="ringkas">Pilih kategori titik untuk mulai menyaring data.</p>

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
                                <input id="cari-titik" class="form-control" type="search" placeholder="Cari nama titik" aria-label="Cari titik" disabled>
                            </div>
                            <ul id="daftar-titik"></ul>
                        </div>
                    </div>
                </aside>

                <div id="map"></div>

                <aside class="map-list" aria-label="Navigasi dan Filter Kecamatan">
                    <div class="map-list-header">
                        <div class="side-features-grid">
                            <!-- Card 1: Filter Kecamatan -->
                            <div class="side-feature-card">
                                <div class="side-card-title">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Filter Wilayah</span>
                                </div>

                                <label class="kec-toggle" for="toggle-kec">
                                    <span class="kec-toggle-text">
                                        <b>Filter kecamatan</b>
                                        <small id="toggle-kec-ket">Klik untuk menyaring titik</small>
                                    </span>
                                    <input id="toggle-kec" type="checkbox" role="switch" checked>
                                    <span class="kec-switch" aria-hidden="true"></span>
                                </label>

                                <div class="side-card-section">
                                    <label for="select-kecamatan-kanan" class="side-field-label">Pilihan Kecamatan</label>
                                    <select id="select-kecamatan-kanan" class="form-select-side" aria-label="Pilih Kecamatan">
                                        <option value="">Semua Kecamatan</option>
                                    </select>
                                    <div id="badge-kecamatan-aktif" class="badge-kecamatan-info" style="display: none;">
                                        <span id="badge-kecamatan-dot" class="dot-kec"></span>
                                        <span id="badge-kecamatan-nama"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Navigasi Titik & Koordinat -->
                            <div class="side-feature-card">
                                <div class="side-card-header-flex">
                                    <div class="side-card-title">
                                        <i class="fas fa-location-crosshairs"></i>
                                        <span>Navigasi Titik</span>
                                    </div>
                                    <button type="button" id="btn-reset-lokasi" class="btn-clear-location" title="Hapus titik saya dari peta" style="display: none;">
                                        <i class="fas fa-trash-can"></i> Hapus
                                    </button>
                                </div>

                                <button type="button" id="btn-cek-lokasi" class="btn-gps-ping">
                                    <i class="fas fa-crosshairs"></i>
                                    <span>Cek Titik Sekarang</span>
                                </button>

                                <div class="side-card-section">
                                    <label class="side-field-label">Input Koordinat</label>
                                    <div class="coord-grid">
                                        <div class="coord-input-group">
                                            <span class="coord-label">Lat</span>
                                            <input id="input-lat" type="number" step="any" class="form-control-side" placeholder="-1.6101" aria-label="Latitude">
                                        </div>
                                        <div class="coord-input-group">
                                            <span class="coord-label">Lng</span>
                                            <input id="input-lng" type="number" step="any" class="form-control-side" placeholder="103.6131" aria-label="Longitude">
                                        </div>
                                    </div>
                                    <button type="button" id="btn-terapkan-koordinat" class="btn-apply-location">
                                        <i class="fas fa-location-arrow"></i>
                                        <span>Arahkan ke Titik</span>
                                    </button>
                                    <div id="nav-feedback-alert" class="nav-feedback" style="display: none;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- KARTU BUFFER TITIK RAWAN (FOTO 1 DIMASUKKAN KE DALAM KONTAINER SIDEBAR) -->
                        <div id="legend-risiko-box" class="sidebar-buffer-card mt-3" style="display: none;">
                            <div class="sbc-header" id="btn-toggle-buffer-card" role="button" tabindex="0" title="Klik untuk melipat / membuka rincian">
                                <div class="sbc-title">
                                    <i class="fas fa-bullseye text-danger me-1"></i>
                                    <span>Buffer Titik Rawan</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge-rtrw">RTRW & BPBD</span>
                                    <button type="button" class="sbc-collapse-btn" aria-label="Lipat / Buka">
                                        <i class="fas fa-chevron-up sbc-icon-chevron"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="sbc-body" id="sbc-content-body">
                                <div class="sbc-legend-list">
                                    <div class="sbc-item" id="sbc-item-tinggi">
                                        <span class="sbc-indicator bg-danger"></span>
                                        <div class="sbc-item-info">
                                            <strong>Buffer Risiko Tinggi (1.2 km)</strong>
                                            <small>Pelayangan, Danau Teluk, Alam Barajo, Kota Baru, Paal Merah</small>
                                        </div>
                                    </div>
                                    <div class="sbc-item" id="sbc-item-sedang">
                                        <span class="sbc-indicator bg-warning"></span>
                                        <div class="sbc-item-info">
                                            <strong>Buffer Risiko Sedang (800 m)</strong>
                                            <small>Kasang & Sijenjang (Jambi Timur), Telanaipura, Danau Sipin</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="sbc-slider-box">
                                    <div class="sbc-slider-label">
                                        <span>Transparansi Buffer</span>
                                        <b id="val-opacity-risiko">50%</b>
                                    </div>
                                    <input type="range" id="slider-opacity-risiko" min="10" max="90" value="50" class="sbc-slider" aria-label="Transparansi Buffer">
                                </div>

                                <label class="sbc-check-label" for="chk-toggle-pin">
                                    <input type="checkbox" id="chk-toggle-pin" checked>
                                    <span>Tampilkan Pin Titik Kelurahan</span>
                                </label>

                                <button type="button" id="btn-lihat-peta-asli" class="btn-sbc-modal">
                                    <i class="fas fa-file-image"></i>
                                    <span>Buka Dokumen Peta Asli (Gambar 3.22)</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>

            <!-- ==================== GRAFIK ==================== -->
            <section class="stats" id="stats" aria-label="Statistik titik operasional" hidden>
                <article class="stat-card">
                    <div class="stat-head">
                        <div class="stat-head-info">
                            <div class="stat-head-icon"><i class="fas fa-layer-group"></i></div>
                            <div>
                                <h3>Titik per Kategori</h3>
                                <p>Jumlah titik tersimpan menurut jenisnya di Kota Jambi</p>
                            </div>
                        </div>
                        <div class="stat-actions">
                            <span class="stat-total" id="total-kat"></span>
                        </div>
                    </div>
                    <div class="chart-box"><canvas id="grafik-kategori" role="img" aria-label="Grafik batang jumlah titik per kategori"></canvas></div>
                    <div class="stat-hint-wrap">
                        <span class="stat-hint"><i class="fas fa-hand-pointer"></i>Klik batang untuk memfilter peta</span>
                    </div>
                </article>

                <article class="stat-card">
                    <div class="stat-head">
                        <div class="stat-head-info">
                            <div class="stat-head-icon"><i class="fas fa-map-marked-alt"></i></div>
                            <div>
                                <h3 id="judul-grafik-kec">Sebaran per Kecamatan</h3>
                                <p id="sub-kec">Semua kategori</p>
                            </div>
                        </div>
                        <div class="stat-actions">
                            <select id="grafik-pilih-kec" class="stat-select" aria-label="Pilih Kecamatan untuk Grafik">
                                <option value="">Semua Kecamatan (Perbandingan)</option>
                            </select>
                            <span class="stat-total" id="total-kec"></span>
                        </div>
                    </div>
                    <div class="chart-box chart-box--kec"><canvas id="grafik-kecamatan" role="img" aria-label="Grafik batang sebaran titik per kecamatan"></canvas></div>
                    <div class="stat-hint-wrap">
                        <span class="stat-hint" id="hint-grafik-kec"><i class="fas fa-hand-pointer"></i>Klik batang untuk menyorot kecamatan di peta</span>
                    </div>
                </article>
            </section>

        </div>
    </div>

    <!-- Modal Pratinjau Dokumen Peta Asli (Opsi B) -->
    <div id="modalPetaAsli" class="custom-modal-backdrop" style="display:none;" role="dialog" aria-modal="true" aria-labelledby="modalPetaTitle">
        <div class="custom-modal-dialog">
            <div class="custom-modal-header">
                <h4 id="modalPetaTitle"><i class="fas fa-map-marked-alt text-danger me-2"></i> Peta Risiko Bencana Kebakaran Hutan & Lahan Kota Jambi (Gambar 3.22)</h4>
                <div class="d-flex align-items-center gap-2">
                    <a href="/images/peta_risiko_kebakaran_full.png" target="_blank" class="btn-external-link" title="Buka Gambar Penuh di Tab Baru">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <button type="button" class="btn-close-modal" id="btn-close-peta-asli" aria-label="Tutup Modal">&times;</button>
                </div>
            </div>
            <div class="custom-modal-body">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span style="font-size:0.75rem;font-weight:700;padding:4px 8px;border-radius:6px;background:#fee2e2;color:#dc2626;"><i class="fas fa-shield-alt me-1"></i> Dokumen Resmi BPBD & Damkar</span>
                        <span style="font-size:0.75rem;font-weight:600;padding:4px 8px;border-radius:6px;background:#f1f5f9;color:#475569;">RTRW Kota Jambi 2024–2044 (Lampiran VI.3)</span>
                    </div>
                    <!-- Toolbar Zoom Gambar Modal -->
                    <div class="modal-zoom-toolbar">
                        <button type="button" id="btn-zoom-in" class="btn-zoom-action" title="Perbesar"><i class="fas fa-magnifying-glass-plus"></i></button>
                        <button type="button" id="btn-zoom-out" class="btn-zoom-action" title="Perkecil"><i class="fas fa-magnifying-glass-minus"></i></button>
                        <button type="button" id="btn-zoom-reset" class="btn-zoom-action" title="Reset Ukuran"><i class="fas fa-rotate-left"></i></button>
                        <span id="zoom-level-text" class="zoom-level-badge">100%</span>
                    </div>
                </div>
                <div class="img-preview-scroll" id="modal-img-container">
                    <img id="modal-zoomable-img" src="/images/peta_risiko_kebakaran_full.png" alt="Peta Risiko Bencana Kebakaran Hutan dan Lahan Kota Jambi">
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.partials.public-footer')

<!-- ==================== SCRIPTS ==================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
@include('layouts.partials.public-scripts')
<script>
(function () {
    'use strict';

    const $ = id => document.getElementById(id);
    const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

    /* =========================================================
       2. KONFIGURASI & STATE PETA
       Hydrant: Kota = merah, Pilar = biru | Water Truck = kuning | Zona Rawan = oranye
       ========================================================= */
    const KOLOM_NAMA = ['kecamatan', 'KECAMATAN', 'Kecamatan', 'WADMKC', 'NAMOBJ', 'nama', 'NAME_3'];
    const PALET = ['#2563eb', '#dc2626', '#f59e0b', '#10b981', '#8b5cf6', '#ea580c', '#0f172a', '#334155', '#64748b', '#f43f5e', '#14b8a6'];

    // Font Awesome gratis tidak punya ikon hydrant, jadi dibuat sendiri (SVG)
    const SVG_HYDRANT = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 3h6v2h1.5v2h-9V5H9V3zm-1 5h8v2h2v2h-2v6h2v2H6v-2h2v-6H6v-2h2V8zM4 11h2v4H4v-4zm16 0h-2v4h2v-4z"/></svg>';

    const isZonaRawanKat = k => k === 'zona_rawan' || k === 'zona_rawan_tinggi' || k === 'zona_rawan_sedang';

    const KATEGORI = {
        sumber_air:    { label: 'Sumber Air',    warna: '#0891b2', ikon: 'fa-droplet' },
        hydrant:       { label: 'Hydrant Kota',  warna: '#dc2626', svg: SVG_HYDRANT },
        hydrant_pilar: { label: 'Hydrant Pilar', warna: '#2563eb', svg: SVG_HYDRANT },
        water_truck:   { label: 'Water Truck',   warna: '#eab308', ikon: 'fa-truck-droplet' },
        pos:           { label: 'Pos Damkar',    warna: '#0f172a', ikon: 'fa-building-flag' },
        zona_rawan:    { label: 'Zona Rawan Kebakaran', warna: '#f97316', ikon: 'fa-triangle-exclamation' }
    };
    const ikon = v => v.svg || `<i class="fas ${v.ikon}"></i>`;

    // Deteksi otomatis sub-kategori dari nama / keterangan
    function klasifikasiKategori(p) {
        if (p.kategori === 'zona_rawan_tinggi' || p.kategori === 'zona_rawan_sedang') return 'zona_rawan';
        if (p.kategori === 'water_truck') return 'water_truck';
        if (p.kategori === 'hydrant') {
            const teks = `${p.nama || ''} ${p.keterangan || ''}`.toLowerCase();
            if (/(hidran|hydran)t?\s*(pilar|pillar)/.test(teks)) return 'hydrant_pilar';
            // Data lama "hydrant gedung" kini dikelompokkan sebagai Water Truck
            if (/(hidran|hydran)t?\s*gedung|water\s*-?\s*truck|watertruck/.test(teks)) return 'water_truck';
            return 'hydrant'; // Default: Hydrant Kota
        }
        return p.kategori;
    }

    // Data Klasifikasi Risiko Bencana Karhutla (Gambar 3.22 BPBD/Damkar & Dokumen RTRW 2024-2044)
    const DATA_RISIKO_KECAMATAN = {
        'Pelayangan': {
            tingkat: 'Tinggi',
            indeks: '> 0.66',
            warna: '#ef4444',
            stroke: '#b91c1c',
            faktor: 'Kawasan lahan terbuka, vegetasi semak, dan hembusan angin terbuka di utara Sungai Batanghari.',
            kelurahan: ['Tahtul Yaman', 'Tanjung Johor', 'Tanjung Pasir', 'Tanjung Raden', 'Mudung Laut', 'Arab Melayu']
        },
        'Danau Teluk': {
            tingkat: 'Tinggi',
            indeks: '> 0.66',
            warna: '#ef4444',
            stroke: '#b91c1c',
            faktor: 'Permukiman panggung kayu padat dan kawasan rawa gambut pesisir utara.',
            kelurahan: ['Pasir Panjang', 'Olak Kemang', 'Ulu Gedong']
        },
        'Alam Barajo': {
            tingkat: 'Tinggi',
            indeks: '> 0.66',
            warna: '#ef4444',
            stroke: '#b91c1c',
            faktor: 'Kawasan ekspansi permukiman baru berbatasan dengan semak belukar dan lahan gambut.',
            kelurahan: ['Bagan Pete', 'Kenali Besar', 'Mayang Mangurai', 'Beliung', 'Rawasari']
        },
        'Kota Baru': {
            tingkat: 'Tinggi',
            indeks: '> 0.66',
            warna: '#ef4444',
            stroke: '#b91c1c',
            faktor: 'Topografi perbukitan landai dengan vegetasi semak dan riwayat pembersihan lahan.',
            kelurahan: ['Kenali Asam Bawah', 'Kenali Asam Atas', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya']
        },
        'Paal Merah': {
            tingkat: 'Tinggi',
            indeks: '> 0.66',
            warna: '#ef4444',
            stroke: '#b91c1c',
            faktor: 'Kawasan pergudangan/industri, kantong-kantong lahan gambut dan semak belukar luas.',
            kelurahan: ['Paal Merah', 'Talang Bakung', 'Lingkar Selatan', 'Payo Selincah', 'Eka Jaya']
        },
        'Telanaipura': {
            tingkat: 'Sedang',
            indeks: '0.33 - 0.66',
            warna: '#f59e0b',
            stroke: '#d97706',
            faktor: 'Kawasan perkantoran dan bantaran sungai Batanghari dengan vegetasi riparian.',
            kelurahan: ['Teluk Kenali', 'Pematang Sulur', 'Buluran Kenali', 'Penyengat Rendah', 'Aur Kenali']
        },
        'Danau Sipin': {
            tingkat: 'Sedang',
            indeks: '0.33 - 0.66',
            warna: '#f59e0b',
            stroke: '#d97706',
            faktor: 'Kawasan permukiman padat tepi danau dengan akses lorong sempit.',
            kelurahan: ['Legok']
        },
        'Jambi Timur': {
            tingkat: 'Sedang',
            indeks: '0.33 - 0.66',
            warna: '#f59e0b',
            stroke: '#d97706',
            faktor: 'Kawasan industri, pelabuhan sungai, dan pergudangan Kasang.',
            kelurahan: ['Kasang']
        },
        'Pasar Jambi': {
            tingkat: 'Rendah',
            indeks: '< 0.33',
            warna: '#10b981',
            stroke: '#059669',
            faktor: 'Pusat kawasan komersial/pertokoan dengan instalasi hidran kota aktif.',
            kelurahan: []
        },
        'Jelutung': {
            tingkat: 'Rendah',
            indeks: '< 0.33',
            warna: '#10b981',
            stroke: '#059669',
            faktor: 'Kawasan permukiman perkotaan padat dengan aksesibilitas pos damkar dekat.',
            kelurahan: []
        },
        'Jambi Selatan': {
            tingkat: 'Rendah',
            indeks: '< 0.33',
            warna: '#10b981',
            stroke: '#059669',
            faktor: 'Kawasan permukiman teratur dan area sekitar bandara Sultan Thaha.',
            kelurahan: []
        }
    };

    const state = {
        kategori: null,
        kecamatan: '',
        qKec: '',
        qTitik: '',
        filterKec: true,
        tampilkanPinRisiko: true,
        tampilkanZonasiRisiko: false,
        opasitasRisiko: 50
    };

    const data = { fitur: [], kecamatan: [], titik: [] };
    const layersKec = {};   // nama kecamatan -> [layer poligon]
    const warnaKec  = {};   // nama kecamatan -> warna
    const chips     = {};   // kategori -> elemen chip
    const markers   = new Map(); // titik -> L.marker (dibuat sekali)
    let geojson;

    const el = {
        ringkas: $('ringkas'), kategori: $('kategori'), select:$('filter-kecamatan'),
        selectKecRight: $('select-kecamatan-kanan'),
        badgeKec: $('badge-kecamatan-aktif'), badgeKecNama: $('badge-kecamatan-nama'), badgeKecDot: $('badge-kecamatan-dot'),
        btnCekLokasi: $('btn-cek-lokasi'), btnTerapkanCoord: $('btn-terapkan-koordinat'), btnResetLokasi: $('btn-reset-lokasi'),
        inputLat: $('input-lat'), inputLng: $('input-lng'), navFeedback: $('nav-feedback-alert'),
        cariKec: $('cari'), countKec: $('list-count'), daftarKec:$('daftar-kecamatan'),
        toggleKec: $('toggle-kec'), ketKec: $('toggle-kec-ket'),
        cariTitik: $('cari-titik'), judulTitik:$('judul-titik'), countTitik: $('count-titik'), daftarTitik:$('daftar-titik')
    };

    /* =========================================================
       TITIK NAVIGASI & KOORDINAT
       ========================================================= */
    let markerUserLocation = null;
    let circleUserAccuracy = null;

    function showNavFeedback(pesan, tipe = 'success') {
        if (!el.navFeedback) return;
        el.navFeedback.className = 'nav-feedback ' + (tipe === 'error' ? 'is-error' : 'is-success');
        el.navFeedback.textContent = pesan;
        el.navFeedback.style.display = 'block';
        clearTimeout(el.navFeedback._timer);
        el.navFeedback._timer = setTimeout(() => {
            if (el.navFeedback) el.navFeedback.style.display = 'none';
        }, 5000);
    }

    function hapusTitikLokasi() {
        if (markerUserLocation) {
            map.removeLayer(markerUserLocation);
            markerUserLocation = null;
        }
        if (circleUserAccuracy) {
            map.removeLayer(circleUserAccuracy);
            circleUserAccuracy = null;
        }
        if (el.inputLat) el.inputLat.value = '';
        if (el.inputLng) el.inputLng.value = '';
        if (el.btnResetLokasi) el.btnResetLokasi.style.display = 'none';
        showNavFeedback('Titik lokasi telah dihapus dari peta.', 'success');
    }

    function setTitikLokasi(lat, lng, akurasi = null, label = 'Titik Kamu Sekarang') {
        if (markerUserLocation) {
            map.removeLayer(markerUserLocation);
            markerUserLocation = null;
        }
        if (circleUserAccuracy) {
            map.removeLayer(circleUserAccuracy);
            circleUserAccuracy = null;
        }

        const iconUser = L.divIcon({
            className: '',
            iconSize: [20, 20],
            iconAnchor: [10, 10],
            popupAnchor: [0, -12],
            html: '<div class="user-pulse-marker" title="Titik Kamu Sekarang"></div>'
        });

        markerUserLocation = L.marker([lat, lng], {
            icon: iconUser,
            zIndexOffset: 2000,
            draggable: true
        }).addTo(map);

        if (akurasi && akurasi > 0) {
            circleUserAccuracy = L.circle([lat, lng], {
                radius: akurasi,
                color: '#2563eb',
                fillColor: '#3b82f6',
                fillOpacity: 0.12,
                weight: 1.5,
                dashArray: '4, 4'
            }).addTo(map);
        }

        const updatePopupText = (latitude, longitude) => {
            const popupHtml = `
                <div style="font-family: inherit; font-size: 0.82rem; min-width: 170px;">
                    <div style="font-weight: 700; color: #0d1b2a; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                        <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#2563eb;"></span>
                        ${esc(label)}
                    </div>
                    <div style="color: #64748b; font-size: 0.75rem; line-height: 1.45;">
                        <div>Lat: <b>${latitude.toFixed(6)}</b></div>
                        <div>Lng: <b>${longitude.toFixed(6)}</b></div>
                        ${akurasi ? `<div style="font-size:0.7rem; color:#94a3b8; margin-top:2px;">Akurasi: ±${Math.round(akurasi)}m</div>` : ''}
                    </div>
                </div>
            `;
            markerUserLocation.bindPopup(popupHtml);
        };

        updatePopupText(lat, lng);
        markerUserLocation.openPopup();

        markerUserLocation.on('dragend', function (e) {
            const pos = e.target.getLatLng();
            if (el.inputLat) el.inputLat.value = pos.lat.toFixed(6);
            if (el.inputLng) el.inputLng.value = pos.lng.toFixed(6);
            if (circleUserAccuracy) map.removeLayer(circleUserAccuracy);
            updatePopupText(pos.lat, pos.lng);
            markerUserLocation.openPopup();
            showNavFeedback('Posisi titik diperbarui: ' + pos.lat.toFixed(4) + ', ' + pos.lng.toFixed(4));
        });

        if (el.inputLat) el.inputLat.value = lat.toFixed(6);
        if (el.inputLng) el.inputLng.value = lng.toFixed(6);
        if (el.btnResetLokasi) el.btnResetLokasi.style.display = 'inline-flex';

        map.setView([lat, lng], Math.max(map.getZoom(), 15), { animate: true });
    }

    const getNama = p => { for (const k of KOLOM_NAMA) if (p[k]) return p[k]; return 'Tanpa nama'; };

    /* =========================================================
       3. PETA DASAR
       ========================================================= */
    const isMobile = L.Browser.mobile || window.innerWidth < 768;
    const map = L.map('map', {
        scrollWheelZoom: true,
        touchZoom: true,
        doubleClickZoom: true,
        boxZoom: true,
        dragging: true,
        tap: !isMobile,
        minZoom: 10,
        maxZoom: 19
    }).setView([-1.6101, 103.6131], 12);
    const jalan = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);
    const citra = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19, attribution: 'Esri' });

    function getZonaRisikoTitik(p) {
        const teks = `${p.tingkat_risiko || ''} ${p.nama || ''} ${p.keterangan || ''} ${p.kategori || ''}`.toLowerCase();
        if (teks.includes('tinggi') || p.kategori === 'zona_rawan_tinggi') {
            return {
                tingkat: 'Tinggi',
                indeks: '> 0.66',
                radius: 1200, // 1.2 km radius buffer bahaya karhutla
                warna: '#ef4444',
                stroke: '#dc2626'
            };
        }
        if (teks.includes('sedang') || p.kategori === 'zona_rawan_sedang') {
            return {
                tingkat: 'Sedang',
                indeks: '0.33 - 0.66',
                radius: 800, // 800 m radius buffer bahaya karhutla
                warna: '#f59e0b',
                stroke: '#d97706'
            };
        }

        const kec = p.kecamatan || cariKecamatan(p.lat, p.lng);
        const info = DATA_RISIKO_KECAMATAN[kec];
        if (info && info.tingkat === 'Tinggi') {
            return {
                tingkat: 'Tinggi',
                indeks: '> 0.66',
                radius: 1200, // 1.2 km radius buffer bahaya karhutla
                warna: '#ef4444',
                stroke: '#dc2626'
            };
        }
        return {
            tingkat: 'Sedang',
            indeks: '0.33 - 0.66',
            radius: 800, // 800 m radius buffer bahaya karhutla
            warna: '#f59e0b',
            stroke: '#d97706'
        };
    }

    function getStyleKecamatan(f) {
        const nama = getNama(f.properties);
        const isRisikoMode = isZonaRawanKat(state.kategori) || state.tampilkanZonasiRisiko;

        if (isRisikoMode) {
            // Garis batas kecamatan dibuat bersih dan halus agar fokus pada buffer titik kerawanan
            return {
                color: '#64748b',
                weight: 1.5,
                dashArray: '4, 4',
                fillColor: '#94a3b8',
                fillOpacity: 0.04
            };
        }

        return {
            color: '#ffffff',
            weight: 1.5,
            fillColor: warnaKec[nama] || '#2563eb',
            fillOpacity: 0.4
        };
    }

    // Layer Vektor Buffer Titik Rawan Karhutla (Gambar 3.22)
    const layerZonasiRisiko = L.layerGroup();

    const layerControl = L.control.layers(
        { 'Peta Jalan': jalan, 'Citra Satelit': citra },
        { 'Layer Buffer Titik Rawan (Gambar 3.22)': layerZonasiRisiko }
    ).addTo(map);

    // Deteksi pergantian base layer untuk menyesuaikan blending mode
    map.on('baselayerchange', (e) => {
        const mapEl = $('map');
        if (mapEl) {
            if (e.name === 'Citra Satelit') {
                mapEl.classList.add('map-dark-base');
            } else {
                mapEl.classList.remove('map-dark-base');
            }
        }
    });

    const grupTitik = L.layerGroup().addTo(map);

    // Pastikan peta menyesuaikan ukuran saat layar diputar / diubah
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => map.invalidateSize(), 150);
    });

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
            b.setAttribute('aria-pressed', state.kategori === k);
            b.querySelector('b').textContent = hitung[k] || 0;
        });
    }

    function renderFilter() {
        const aktif = !!state.kategori;
        if (el.cariTitik) {
            el.cariTitik.disabled = !aktif;
            el.cariTitik.value = state.qTitik;
        }
        el.select.disabled = !aktif || !state.filterKec;

        if (!aktif) {
            el.select.innerHTML = '<option value="">Pilih kategori terlebih dahulu...</option>';
        } else if (!state.filterKec) {
            el.select.innerHTML = '<option value="">Filter kecamatan dimatikan</option>';
        } else {
            el.select.innerHTML = '<option value="">Semua Kecamatan</option>' +
                data.kecamatan.map(n => `<option value="${esc(n)}">${esc(n)}</option>`).join('');
            el.select.value = state.kecamatan;
        }

        // Sinkronisasi dropdown kecamatan di panel kanan
        if (el.selectKecRight) {
            el.selectKecRight.disabled = !state.filterKec;
            el.selectKecRight.value = state.kecamatan || '';

            if (el.badgeKec && el.badgeKecNama && el.badgeKecDot) {
                if (state.kecamatan && warnaKec[state.kecamatan]) {
                    el.badgeKec.style.display = 'inline-flex';
                    el.badgeKecDot.style.background = warnaKec[state.kecamatan];
                    el.badgeKecNama.textContent = state.kecamatan;
                } else {
                    el.badgeKec.style.display = 'none';
                }
            }
        }
    }

    function renderDaftarKecamatan() {
        if (!el.daftarKec) return;
        const q = state.qKec ? state.qKec.toLowerCase() : '';
        const list = data.kecamatan.filter(n => n.toLowerCase().includes(q));
        if (el.countKec) el.countKec.textContent = list.length;
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
            const v = KATEGORI[p.kategori];
            const li = document.createElement('li');
            li.innerHTML = `<button class="item"><span class="dot-mini" style="background:${v.warna}">${ikon(v)}</span>
                <div style="flex:1;overflow:hidden"><div style="font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${esc(p.nama)}</div>
                <small>${esc(p.lokasi || '')}</small></div></button>`;
            li.firstElementChild.addEventListener('click', () => {
                map.setView([p.lat, p.lng], 16);
                markers.get(p)?.openPopup();
                // Di layar kecil, bawa pengguna ke peta agar popup terlihat
                if (window.matchMedia('(max-width: 991px)').matches) {
                    $('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
            el.daftarTitik.appendChild(li);
        });
    }

    const bufferCircles = [];
    function renderMarker() {
        grupTitik.clearLayers();
        bufferCircles.forEach(item => map.removeLayer(item.circle));
        bufferCircles.length = 0;

        const isZonaRawan = isZonaRawanKat(state.kategori);
        const tampilkanPin = state.tampilkanPinRisiko;

        titikTampil().forEach(p => {
            if (!markers.has(p)) markers.set(p, buatMarker(p));

            if (!isZonaRawan || (isZonaRawan && tampilkanPin !== false)) {
                grupTitik.addLayer(markers.get(p));
            }

            if (isZonaRawan) {
                const zona = getZonaRisikoTitik(p);
                const op = ((state.opasitasRisiko || 50) / 100) * 0.35;
                const circle = L.circle([p.lat, p.lng], {
                    radius: zona.radius,
                    color: zona.stroke,
                    fillColor: zona.warna,
                    fillOpacity: op,
                    weight: 2,
                    dashArray: '5, 5'
                });

                circle.bindTooltip(`
                    <div style="font-size:0.8rem;line-height:1.35">
                        <strong>${esc(p.nama)}</strong><br>
                        <span style="color:${zona.warna};font-weight:700">● Buffer Risiko ${zona.tingkat} (Radius ${(zona.radius/1000).toFixed(1)} km)</span><br>
                        <small class="text-muted">Kecamatan ${esc(p.kecamatan)}</small>
                    </div>
                `, { sticky: true });

                circle.on('click', () => {
                    map.setView([p.lat, p.lng], 15);
                    markers.get(p)?.openPopup();
                });

                circle.addTo(map);
                bufferCircles.push({ circle, zona });
            }
        });
    }

    /* =========================================================
       6b. GRAFIK BATANG (Chart.js)
       ========================================================= */
    const charts = {};
    const PUDAR = '40'; // alpha hex untuk batang yang tidak dipilih
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Angka di atas batang (khusus grafik kategori)
    const labelAngka = {
        id: 'labelAngka',
        afterDatasetsDraw(c) {
            const ctx = c.ctx;
            ctx.save();
            ctx.font = '600 12px ' + Chart.defaults.font.family;
            ctx.fillStyle = '#1e293b';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';
            c.getDatasetMeta(0).data.forEach((bar, i) => {
                const val = c.data.datasets[0].data[i];
                if (val > 0) {
                    ctx.fillText(val, bar.x, bar.y - 6);
                }
            });
            ctx.restore();
        }
    };

    // Buat grafik sekali, lalu perbarui data & konfigurasi
    function aturGrafik(nama, canvasId, config) {
        if (charts[nama]) {
            if (charts[nama].config.options.indexAxis !== config.options.indexAxis) {
                charts[nama].destroy();
                charts[nama] = new Chart($(canvasId), config);
                return;
            }
            charts[nama].data = config.data;
            charts[nama].options = config.options;
            charts[nama].update();
            return;
        }
        charts[nama] = new Chart($(canvasId), config);
    }

    function renderGrafik() {
        const ada = data.titik.length > 0;
        $('stats').hidden = !ada;
        if (!ada || typeof Chart === 'undefined') return;

        Chart.defaults.font.family = "'Instrument Sans', system-ui, sans-serif";
        Chart.defaults.font.size = 12;
        Chart.defaults.color = '#64748b';

        const keys = Object.keys(KATEGORI);
        const aktifKat = state.kategori;
        const warnaBatang = (warna, aktif) => aktif ? warna : warna + PUDAR;
        const kursor = (e, els) => { e.native.target.style.cursor = els.length ? 'pointer' : 'default'; };
        const grid = { color: 'rgba(226, 232, 240, 0.7)', drawTicks: false };
        const tooltip = {
            backgroundColor: '#0f172a',
            titleColor: '#ffffff',
            bodyColor: '#e2e8f0',
            padding: { top: 8, bottom: 8, left: 12, right: 12 },
            cornerRadius: 8,
            boxPadding: 6,
            usePointStyle: true,
            titleFont: { weight: '700', size: 12 },
            bodyFont: { weight: '500', size: 12 },
            borderColor: 'rgba(255, 255, 255, 0.1)',
            borderWidth: 1
        };

        /* Update Dropdown Filter Kecamatan di Grafik */
        const selKec = $('grafik-pilih-kec');
        if (selKec) {
            if (selKec.options.length <= 1 && data.kecamatan.length) {
                selKec.innerHTML = '<option value="">Semua Kecamatan (Perbandingan)</option>' +
                    data.kecamatan.map(n => `<option value="${esc(n)}">${esc(n)}</option>`).join('');
            }
            selKec.value = state.kecamatan || '';
        }

        /* ---------- Grafik 1: titik per kategori ---------- */
        const totalKat = keys.map(k => data.titik.filter(p => p.kategori === k).length);
        $('total-kat').textContent = data.titik.length + ' titik';

        const labelKategori = keys.map(k => {
            const l = KATEGORI[k].label;
            return l === 'Zona Rawan Kebakaran' ? ['Zona Rawan', 'Kebakaran'] : l;
        });

        aturGrafik('kat', 'grafik-kategori', {
            type: 'bar',
            plugins: [labelAngka],
            data: {
                labels: labelKategori,
                datasets: [{
                    data: totalKat,
                    backgroundColor: keys.map(k => warnaBatang(KATEGORI[k].warna, !aktifKat || aktifKat === k)),
                    borderRadius: { topLeft: 8, topRight: 8, bottomLeft: 0, bottomRight: 0 },
                    borderSkipped: false,
                    maxBarThickness: 52
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                animation: { duration: reduceMotion ? 0 : 500 },
                layout: { padding: { top: 26, bottom: 4, left: 4, right: 4 } },
                onClick: (e, els) => {
                    if (!els.length) return;
                    setKategori(keys[els[0].index]);
                    $('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                },
                onHover: kursor,
                plugins: {
                    legend: { display: false },
                    tooltip: { ...tooltip, callbacks: { label: c => ` ${c.parsed.y} titik` } }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { maxRotation: 0, minRotation: 0, autoSkip: false, font: { size: 11.5, weight: '600' }, color: '#334155' }
                    },
                    y: {
                        beginAtZero: true,
                        grace: '12%',
                        ticks: { precision: 0, padding: 8, font: { size: 11 }, color: '#64748b' },
                        grid,
                        border: { display: false }
                    }
                }
            }
        });

        /* ---------- Grafik 2: sebaran per kecamatan / detail kecamatan ---------- */
        const per = {};
        data.kecamatan.forEach(n => { per[n] = {}; });
        data.titik.forEach(p => {
            if (per[p.kecamatan]) per[p.kecamatan][p.kategori] = (per[p.kecamatan][p.kategori] || 0) + 1;
        });

        const judulGrafikKec = $('judul-grafik-kec');
        const hintGrafikKec = $('hint-grafik-kec');

        if (state.kecamatan) {
            // Mode Detail Kecamatan Tertentu
            const namaKec = state.kecamatan;
            if (judulGrafikKec) judulGrafikKec.textContent = `Rincian Titik di Kecamatan ${namaKec}`;
            $('sub-kec').textContent = `Sebaran titik menurut jenis kategori`;

            const dataPerKatKec = keys.map(k => (per[namaKec] && per[namaKec][k]) || 0);
            const totalKecTerpilih = dataPerKatKec.reduce((a, b) => a + b, 0);
            $('total-kec').textContent = `${totalKecTerpilih} titik di ${namaKec}`;

            if (hintGrafikKec) {
                hintGrafikKec.innerHTML = '<i class="fas fa-hand-pointer"></i>Klik batang untuk memfilter peta, atau pilih "Semua Kecamatan" pada dropdown untuk kembali';
            }

            aturGrafik('kec', 'grafik-kecamatan', {
                type: 'bar',
                plugins: [labelAngka],
                data: {
                    labels: labelKategori,
                    datasets: [{
                        label: 'Jumlah Titik',
                        data: dataPerKatKec,
                        backgroundColor: keys.map(k => warnaBatang(KATEGORI[k].warna, !aktifKat || aktifKat === k)),
                        borderRadius: { topLeft: 8, topRight: 8, bottomLeft: 0, bottomRight: 0 },
                        borderSkipped: false,
                        maxBarThickness: 54
                    }]
                },
                options: {
                    indexAxis: 'x',
                    responsive: true, maintainAspectRatio: false,
                    animation: { duration: reduceMotion ? 0 : 500 },
                    layout: { padding: { top: 26, bottom: 4, left: 4, right: 4 } },
                    interaction: { mode: 'nearest', intersect: true },
                    onClick: (e, els) => {
                        if (!els.length) return;
                        setKategori(keys[els[0].index]);
                        $('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    },
                    onHover: kursor,
                    plugins: {
                        legend: { display: false },
                        tooltip: { ...tooltip, callbacks: { label: c => ` ${c.parsed.y} titik` } }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { maxRotation: 0, minRotation: 0, autoSkip: false, font: { size: 11.5, weight: '600' }, color: '#334155' }
                        },
                        y: {
                            beginAtZero: true,
                            grace: '15%',
                            ticks: { precision: 0, padding: 8, font: { size: 11 }, color: '#64748b' },
                            grid,
                            border: { display: false }
                        }
                    }
                }
            });
        } else {
            // Mode Perbandingan Seluruh Kecamatan (Format Batang Vertikal seragam)
            const katTampil = aktifKat ? [aktifKat] : keys;
            const jumlah = n => katTampil.reduce((s, k) => s + (per[n][k] || 0), 0);
            const rawLabels = [...data.kecamatan].sort((a, b) => jumlah(b) - jumlah(a) || a.localeCompare(b));

            if (judulGrafikKec) judulGrafikKec.textContent = 'Sebaran per Kecamatan';
            $('sub-kec').textContent = aktifKat ? KATEGORI[aktifKat].label : 'Semua jenis titik';
            $('total-kec').textContent = rawLabels.reduce((s, n) => s + jumlah(n), 0) + ' titik';

            if (hintGrafikKec) {
                hintGrafikKec.innerHTML = '<i class="fas fa-hand-pointer"></i>Klik batang kecamatan atau gunakan dropdown untuk melihat rincian jenis titiknya';
            }

            const labelKecFormatted = rawLabels.map(n => n.includes(' ') ? n.split(' ') : n);
            const dataJumlahKec = rawLabels.map(n => jumlah(n));
            const warnaBatangKec = rawLabels.map(n => aktifKat ? KATEGORI[aktifKat].warna : (warnaKec[n] || '#2563eb'));

            aturGrafik('kec', 'grafik-kecamatan', {
                type: 'bar',
                plugins: [labelAngka],
                data: {
                    labels: labelKecFormatted,
                    datasets: [{
                        label: aktifKat ? KATEGORI[aktifKat].label : 'Jumlah Titik',
                        data: dataJumlahKec,
                        backgroundColor: warnaBatangKec,
                        borderRadius: { topLeft: 8, topRight: 8, bottomLeft: 0, bottomRight: 0 },
                        borderSkipped: false,
                        maxBarThickness: 48
                    }]
                },
                options: {
                    indexAxis: 'x',
                    responsive: true, maintainAspectRatio: false,
                    animation: { duration: reduceMotion ? 0 : 500 },
                    layout: { padding: { top: 26, bottom: 4, left: 4, right: 4 } },
                    interaction: { mode: 'nearest', intersect: true },
                    onClick: (e, els) => {
                        if (!els.length) return;
                        const n = rawLabels[els[0].index];
                        setKecamatan(n);
                    },
                    onHover: kursor,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            ...tooltip,
                            callbacks: {
                                title: items => rawLabels[items[0].dataIndex],
                                label: c => ` ${c.parsed.y} titik`
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { maxRotation: 45, autoSkip: false, font: { size: 11, weight: '600' }, color: '#334155' }
                        },
                        y: {
                            beginAtZero: true,
                            grace: '15%',
                            ticks: { precision: 0, padding: 8, font: { size: 11 }, color: '#64748b' },
                            grid,
                            border: { display: false }
                        }
                    }
                }
            });
        }
    }

    function renderToggle() {
        el.toggleKec.checked = state.filterKec;
        el.ketKec.textContent = state.filterKec
            ? 'Klik kecamatan untuk menyaring titik'
            : 'Dimatikan: warna kecamatan disembunyikan dan semua titik tampil';

        // Tampilkan / sembunyikan warna poligon kecamatan di peta
        if (geojson) {
            const tampil = map.hasLayer(geojson);
            if (state.filterKec && !tampil) geojson.addTo(map);
            else if (!state.filterKec && tampil) map.removeLayer(geojson);
        }
    }

    function updateSbcHighlight() {
        const itemTinggi = $('sbc-item-tinggi');
        const itemSedang = $('sbc-item-sedang');
        if (!itemTinggi || !itemSedang) return;

        if (!state.kecamatan) {
            itemTinggi.classList.remove('is-dimmed', 'is-highlighted');
            itemSedang.classList.remove('is-dimmed', 'is-highlighted');
            return;
        }

        const info = DATA_RISIKO_KECAMATAN[state.kecamatan];
        if (info && info.tingkat === 'Tinggi') {
            itemTinggi.classList.add('is-highlighted');
            itemTinggi.classList.remove('is-dimmed');
            itemSedang.classList.add('is-dimmed');
            itemSedang.classList.remove('is-highlighted');
        } else if (info && info.tingkat === 'Sedang') {
            itemSedang.classList.add('is-highlighted');
            itemSedang.classList.remove('is-dimmed');
            itemTinggi.classList.add('is-dimmed');
            itemTinggi.classList.remove('is-highlighted');
        } else {
            itemTinggi.classList.add('is-dimmed');
            itemSedang.classList.add('is-dimmed');
        }
    }

    function renderRisikoOverlay() {
        const isZonaRawan = isZonaRawanKat(state.kategori);
        const box = $('legend-risiko-box');
        if (isZonaRawan) {
            state.tampilkanZonasiRisiko = true;
            if (!map.hasLayer(layerZonasiRisiko)) map.addLayer(layerZonasiRisiko);
            if (geojson) geojson.setStyle(getStyleKecamatan);
            if (box) box.style.display = 'block';
        } else {
            if (state.kategori !== null && map.hasLayer(layerZonasiRisiko)) {
                state.tampilkanZonasiRisiko = false;
                map.removeLayer(layerZonasiRisiko);
            }
            if (geojson) geojson.setStyle(getStyleKecamatan);
            if (!map.hasLayer(layerZonasiRisiko) && box) {
                box.style.display = 'none';
            }
        }
        updateSbcHighlight();
    }

    function render() {
        renderToggle();
        renderChips();
        renderFilter();
        renderDaftarKecamatan();
        renderDaftarTitik();
        renderMarker();
        renderRisikoOverlay();
        try { renderGrafik(); } catch (e) { console.error('Grafik gagal dimuat:', e); }
    }

    /* =========================================================
       7. AKSI (satu-satunya tempat state berubah)
       ========================================================= */
    function setKategori(k) {
        state.kategori = state.kategori === k ? null : k;
        state.kecamatan = '';
        state.qTitik = '';
        if (geojson) {
            geojson.setStyle(getStyleKecamatan);
            map.fitBounds(geojson.getBounds());
        }
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
        if (state.kategori && state.filterKec) return setKecamatan(nama);
        map.fitBounds(L.featureGroup(layersKec[nama]).getBounds(), { padding: [30, 30] });
    }

    function sorot(nama, aktif) {
        (layersKec[nama] || []).forEach(l => {
            if (aktif) {
                l.setStyle({ weight: 3, color: '#0f172a', fillOpacity: 0.25 });
            } else {
                l.setStyle(getStyleKecamatan(l.feature));
            }
        });
    }

    /* =========================================================
       8. FACTORY: chip, marker, popup
       ========================================================= */
    Object.entries(KATEGORI).forEach(([k, v]) => {
        const b = document.createElement('button');
        b.type = 'button';
        b.className = 'chip off';
        b.setAttribute('aria-pressed', 'false');
        b.innerHTML = `<span class="dot" style="background:${v.warna}">${ikon(v)}</span><span>${v.label}</span><b>0</b>`;
        b.addEventListener('click', () => setKategori(k));
        chips[k] = b;
        el.kategori.appendChild(b);
    });

    function buatMarker(p) {
        const v = KATEGORI[p.kategori];
        const isRawan = isZonaRawanKat(p.kategori);
        const zona = isRawan ? getZonaRisikoTitik(p) : null;
        const icon = L.divIcon({
            className: '', iconSize: [36, 36], iconAnchor: [18, 18], popupAnchor: [0, -18],
            html: isRawan
                ? `<div class="pin" style="background:${zona.warna};box-shadow:0 0 0 3px ${zona.warna}4d,0 6px 14px rgba(0,0,0,0.35)"><i class="fas fa-fire-flame-curved"></i></div>`
                : `<div class="pin" style="background:${v.warna}">${ikon(v)}</div>`
        });
        // Urutan baris: Kategori, Zona Kerawanan, Kecamatan, Lokasi, Keterangan
        const baris = [
            ['Kategori', v.label],
            isRawan && zona ? ['Zona Kerawanan', `Risiko ${zona.tingkat} (Radius ${(zona.radius/1000).toFixed(1)} km)`] : null,
            ['Kecamatan', p.kecamatan],
            ['Lokasi', p.lokasi],
            ['Keterangan', p.keterangan]
        ].filter(Boolean).map(([a, b]) => `<tr><td>${esc(a)}</td><td>${esc(b)}</td></tr>`).join('');
        const popup = `<div class="popup"><h3>${esc(p.nama)}</h3><table>${baris}</table>
            <a href="https://www.google.com/maps/dir/?api=1&destination=${p.lat},${p.lng}" target="_blank" rel="noopener"><i class="fas fa-directions"></i> Rute ke lokasi</a></div>`;
        return L.marker([p.lat, p.lng], { icon, title: p.nama, alt: p.nama }).bindPopup(popup, { maxWidth: 320, autoPanPadding: [20, 20] });
    }

    const popupWilayah = (props, nama) => {
        const isRisikoMode = isZonaRawanKat(state.kategori) || state.tampilkanZonasiRisiko;
        const info = DATA_RISIKO_KECAMATAN[nama];

        if (isRisikoMode && info) {
            const badgeColor = info.tingkat === 'Tinggi' ? '#ef4444' : info.tingkat === 'Sedang' ? '#f59e0b' : '#10b981';
            const kelList = info.kelurahan && info.kelurahan.length
                ? info.kelurahan.map(k => `<span class="badge-kel-rawan">${esc(k)}</span>`).join(' ')
                : '<span class="text-muted fst-italic">Kawasan pusat kota terbangun</span>';

            return `<div class="popup popup-risiko">
                <div class="popup-risiko-header">
                    <h3>Kecamatan ${esc(nama)}</h3>
                    <span class="badge-status-risiko" style="background:${badgeColor}">Risiko ${esc(info.tingkat)}</span>
                </div>
                <table class="w-100">
                    <tr><td>Indeks Risiko</td><td><strong>${esc(info.indeks)}</strong></td></tr>
                    <tr><td>Faktor Karhutla</td><td>${esc(info.faktor)}</td></tr>
                    <tr><td>Kelurahan Rawan</td><td><div class="kel-chips-wrap">${kelList}</div></td></tr>
                    <tr><td>Sumber Data</td><td><small class="text-muted">Gambar 3.22 BPBD & RTRW Kota Jambi</small></td></tr>
                </table>
            </div>`;
        }

        return `<div class="popup"><h3>${esc(nama)}</h3><table>${
            Object.entries(props).filter(([, v]) => v !== null && v !== '')
                .map(([k, v]) => `<tr><td>${esc(k)}</td><td>${esc(v)}</td></tr>`).join('')
        }</table></div>`;
    };

    /* =========================================================
       9. EVENT FILTER & NAVIGASI
       ========================================================= */
    el.select.addEventListener('change', () => setKecamatan(el.select.value));
    if (el.selectKecRight) {
        el.selectKecRight.addEventListener('change', () => setKecamatan(el.selectKecRight.value));
    }
    const selGrafikKec = $('grafik-pilih-kec');
    if (selGrafikKec) {
        selGrafikKec.addEventListener('change', () => setKecamatan(selGrafikKec.value));
    }
    el.toggleKec.addEventListener('change', () => {
        state.filterKec = el.toggleKec.checked;
        if (!state.filterKec) {
            state.kecamatan = '';
            if (geojson) map.fitBounds(geojson.getBounds());
        }
        render();
    });
    if (el.cariKec) {
        el.cariKec.addEventListener('input', e => {
            state.qKec = e.target.value;
            renderDaftarKecamatan();
        });
    }
    el.cariTitik.addEventListener('input', e => {
        state.qTitik = e.target.value;
        renderDaftarTitik();
        renderMarker();
    });

    /* EVENT NAVIGASI LOKASI SAYA & INPUT KOORDINAT */
    if (el.btnCekLokasi) {
        el.btnCekLokasi.addEventListener('click', function () {
            if (!navigator.geolocation) {
                showNavFeedback('Browser tidak mendukung deteksi lokasi Geolocation.', 'error');
                return;
            }
            el.btnCekLokasi.disabled = true;
            el.btnCekLokasi.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Mendeteksi...</span>';

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    el.btnCekLokasi.disabled = false;
                    el.btnCekLokasi.innerHTML = '<i class="fas fa-crosshairs"></i> <span>Cek Titik Sekarang</span>';
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const accuracy = position.coords.accuracy;
                    setTitikLokasi(lat, lng, accuracy, 'Titik Kamu Sekarang (GPS)');
                    showNavFeedback('Lokasi kamu berhasil ditemukan!', 'success');
                },
                function (err) {
                    el.btnCekLokasi.disabled = false;
                    el.btnCekLokasi.innerHTML = '<i class="fas fa-crosshairs"></i> <span>Cek Titik Sekarang</span>';
                    let pesan = 'Gagal mendeteksi lokasi saat ini.';
                    if (err.code === err.PERMISSION_DENIED) {
                        pesan = 'Izin akses lokasi ditolak oleh browser/perangkat.';
                    } else if (err.code === err.POSITION_UNAVAILABLE) {
                        pesan = 'Informasi lokasi perangkat tidak tersedia.';
                    } else if (err.code === err.TIMEOUT) {
                        pesan = 'Waktu permintaan lokasi habis.';
                    }
                    showNavFeedback(pesan, 'error');
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        });
    }

    function prosesInputKoordinat() {
        if (!el.inputLat || !el.inputLng) return;
        let rawLat = el.inputLat.value.trim();
        let rawLng = el.inputLng.value.trim();

        if (rawLat.includes(',') || rawLat.includes(' ')) {
            const parts = rawLat.split(/[, ]+/).filter(Boolean);
            if (parts.length >= 2) {
                rawLat = parts[0];
                rawLng = parts[1];
                el.inputLat.value = rawLat;
                el.inputLng.value = rawLng;
            }
        } else if (rawLng.includes(',') || rawLng.includes(' ')) {
            const parts = rawLng.split(/[, ]+/).filter(Boolean);
            if (parts.length >= 2) {
                rawLat = parts[0];
                rawLng = parts[1];
                el.inputLat.value = rawLat;
                el.inputLng.value = rawLng;
            }
        }

        const lat = parseFloat(rawLat);
        const lng = parseFloat(rawLng);

        if (isNaN(lat) || isNaN(lng) || lat < -90 || lat > 90 || lng < -180 || lng > 180) {
            showNavFeedback('Koordinat tidak valid! Masukkan angka Lat (-90 s/d 90) & Lng (-180 s/d 180).', 'error');
            return;
        }

        setTitikLokasi(lat, lng, null, 'Titik Input Koordinat');
        showNavFeedback('Berhasil mengarahkan ke koordinat input!', 'success');
    }

    if (el.btnTerapkanCoord) {
        el.btnTerapkanCoord.addEventListener('click', prosesInputKoordinat);
    }
    if (el.btnResetLokasi) {
        el.btnResetLokasi.addEventListener('click', hapusTitikLokasi);
    }

    [el.inputLat, el.inputLng].forEach(input => {
        if (input) {
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    prosesInputKoordinat();
                }
            });
            input.addEventListener('paste', () => {
                setTimeout(prosesInputKoordinat, 50);
            });
        }
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

        if (el.selectKecRight) {
            el.selectKecRight.innerHTML = '<option value="">Semua Kecamatan (' + data.kecamatan.length + ')</option>' +
                data.kecamatan.map(n => `<option value="${esc(n)}">${esc(n)}</option>`).join('');
            el.selectKecRight.value = state.kecamatan || '';
        }

        geojson = L.geoJSON(wilayah, {
            style: getStyleKecamatan,
            onEachFeature: (f, layer) => {
                const n = getNama(f.properties);
                (layersKec[n] ||= []).push(layer);
                layer.bindTooltip(() => {
                    const isRisikoMode = isZonaRawanKat(state.kategori) || state.tampilkanZonasiRisiko;
                    const info = DATA_RISIKO_KECAMATAN[n];
                    if (isRisikoMode && info) {
                        return `<strong>${esc(n)}</strong><br><span style="color:${info.warna}">● Risiko ${esc(info.tingkat)} (Indeks ${esc(info.indeks)})</span>`;
                    }
                    return esc(n);
                }, { sticky: true });
                layer.bindPopup(() => popupWilayah(f.properties, n));
                layer.on({ mouseover: () => sorot(n, true), mouseout: () => sorot(n, false), click: () => fokusKecamatan(n) });
            }
        }).addTo(map);
        map.fitBounds(geojson.getBounds());

        if (titik) {
            // Kategori yang tidak ada di KATEGORI (mis. kebakaran, penyelamatan) otomatis disaring
            data.titik = titik.map(p => {
                const kat = klasifikasiKategori(p);
                return { ...p, kategori: kat, lat: +p.lat, lng: +p.lng };
            }).filter(p => KATEGORI[p.kategori] && isFinite(p.lat) && isFinite(p.lng));

            data.titik.forEach(p => { p.kecamatan = p.kecamatan || cariKecamatan(p.lat, p.lng); });
            el.ringkas.textContent = `Total ${data.titik.length} titik tersimpan. Silakan pilih kategori titik.`;
        } else {
            el.ringkas.textContent = 'Gagal memuat data titik. Batas wilayah tetap ditampilkan.';
        }
        render();
    }).catch(() => {
        el.ringkas.textContent = 'Data wilayah belum tersedia';
        if (el.daftarKec) el.daftarKec.innerHTML = '<li class="kosong">File GeoJSON tidak ditemukan.</li>';
    });

    /* =========================================================
       10. EVENT HANDLER OVERLAY & MODAL PETA ASLI (OPSI B)
       ========================================================= */
    map.on('overlayadd', (e) => {
        if (e.layer === layerZonasiRisiko) {
            state.tampilkanZonasiRisiko = true;
            if (geojson) geojson.setStyle(getStyleKecamatan);
            const box = $('legend-risiko-box');
            if (box) box.style.display = 'block';
            renderMarker();
        }
    });

    map.on('overlayremove', (e) => {
        if (e.layer === layerZonasiRisiko) {
            state.tampilkanZonasiRisiko = false;
            if (geojson) geojson.setStyle(getStyleKecamatan);
            if (!isZonaRawanKat(state.kategori)) {
                const box = $('legend-risiko-box');
                if (box) box.style.display = 'none';
            }
            renderMarker();
        }
    });

    document.addEventListener('input', (e) => {
        if (e.target && e.target.id === 'slider-opacity-risiko') {
            const val = parseInt(e.target.value, 10);
            state.opasitasRisiko = val;
            const lbl = $('val-opacity-risiko');
            if (lbl) lbl.textContent = `${val}%`;
            bufferCircles.forEach(item => {
                item.circle.setStyle({ fillOpacity: (val / 100) * 0.35 });
            });
        }
    });

    document.addEventListener('change', (e) => {
        if (e.target && e.target.id === 'chk-toggle-pin') {
            state.tampilkanPinRisiko = e.target.checked;
            renderMarker();
        }
    });

    // Kontrol Zoom Gambar Dokumen Modal
    let modalZoom = 1;
    function setModalZoom(z) {
        modalZoom = Math.min(Math.max(0.6, z), 3.5);
        const img = $('modal-zoomable-img');
        const txt = $('zoom-level-text');
        if (img) {
            img.style.transform = `scale(${modalZoom})`;
            img.style.transformOrigin = 'top center';
        }
        if (txt) txt.textContent = `${Math.round(modalZoom * 100)}%`;
    }

    document.addEventListener('click', (e) => {
        const btnToggleCard = e.target.closest('#btn-toggle-buffer-card');
        if (btnToggleCard) {
            const card = $('legend-risiko-box');
            if (card) card.classList.toggle('is-collapsed');
            return;
        }

        if (e.target.closest('#btn-zoom-in')) {
            setModalZoom(modalZoom + 0.25);
            return;
        }
        if (e.target.closest('#btn-zoom-out')) {
            setModalZoom(modalZoom - 0.25);
            return;
        }
        if (e.target.closest('#btn-zoom-reset')) {
            setModalZoom(1);
            return;
        }

        const btnOpen = e.target.closest('#btn-lihat-peta-asli');
        if (btnOpen) {
            const m = $('modalPetaAsli');
            if (m) m.style.display = 'flex';
            setModalZoom(1);
            document.body.classList.add('nav-lock');
        }
        const btnClose = e.target.closest('#btn-close-peta-asli');
        if (btnClose) {
            const m = $('modalPetaAsli');
            if (m) m.style.display = 'none';
            document.body.classList.remove('nav-lock');
        }
        if (e.target && e.target.id === 'modalPetaAsli') {
            e.target.style.display = 'none';
            document.body.classList.remove('nav-lock');
        }
    });
})();
</script>

<script>
document.addEventListener('keydown', function (e) {
    var modal = document.getElementById('modalPetaAsli');
    if (e.key === 'Escape' && modal && modal.style.display !== 'none') {
        modal.style.display = 'none';
        document.body.classList.remove('nav-lock');
    }
    var h = e.target && e.target.closest ? e.target.closest('#btn-toggle-buffer-card') : null;
    if (h && (e.key === 'Enter' || e.key === ' ')) { e.preventDefault(); h.click(); }
});
</script>
</body>
</html>