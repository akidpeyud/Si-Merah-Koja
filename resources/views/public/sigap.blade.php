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
    grid-template-columns: 300px 1fr 280px;
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

/* ===== PANEL KANAN: kecamatan ===== */
.map-list { border-left: 1px solid var(--line); display: flex; flex-direction: column; background: #fff; min-height: 0; overflow: hidden; }
.map-list-header { padding: 18px 16px 12px; border-bottom: 1px solid rgba(226,232,240,.6); }
.list-scroll { flex: 1; overflow-y: auto; min-height: 0; }
/* Saklar filter kecamatan (panel kanan) */
.kec-toggle { position: relative; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 10px 12px; margin-bottom: 12px; border: 1px solid var(--line); border-radius: 10px; background: var(--soft); cursor: pointer; }
.kec-toggle-text { display: flex; flex-direction: column; min-width: 0; }
.kec-toggle-text b { font-size: .82rem; color: var(--ink); }
.kec-toggle-text small { font-size: .7rem; color: var(--muted); line-height: 1.35; }
.kec-toggle input { position: absolute; opacity: 0; width: 1px; height: 1px; }
.kec-switch { position: relative; flex: none; width: 40px; height: 22px; border-radius: 999px; background: #cbd5e1; transition: background .2s; }
.kec-switch::after { content: ""; position: absolute; top: 3px; left: 3px; width: 16px; height: 16px; border-radius: 50%; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,.25); transition: transform .2s; }
.kec-toggle input:checked + .kec-switch { background: var(--blue); }
.kec-toggle input:checked + .kec-switch::after { transform: translateX(18px); }
.kec-toggle input:focus-visible + .kec-switch { outline: 3px solid rgba(37, 99, 235, 0.5); outline-offset: 2px; }

#daftar-kecamatan { list-style: none; margin: 0; padding: 10px 14px; }

/* Item daftar */
.item {
    width: 100%; min-height: 44px; cursor: pointer; display: flex; align-items: center; gap: 10px;
    padding: 8px 12px; margin-bottom: 3px; border-radius: 10px; border: 1px solid transparent;
    font-weight: 600; font-size: .85rem; color: var(--ink-2); background: transparent; text-align: left; transition: all .2s;
}
.item:hover { background: var(--soft); }
.item.aktif { background: var(--blue-soft); color: var(--blue); border-color: #bfdbfe; }
.item small { display: block; color: var(--muted); font-weight: 500; font-size: .75rem; margin-top: 1px; }
.item .meta { margin-left: auto; font-size: .7rem; color: var(--muted); background: var(--paper); padding: 3px 8px; border-radius: 6px; white-space: nowrap; }
.item.aktif .meta { background: rgba(37,99,235,.1); color: var(--blue); }
.item:focus-visible, .chip:focus-visible { outline-offset: -2px; }
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
.stats { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); gap: 24px; margin-top: 24px; }
.stats[hidden] { display: none; }

.stat-card {
    background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg);
    padding: 24px; box-shadow: var(--shadow-sm); transition: box-shadow .2s;
}
.stat-card:hover { box-shadow: var(--shadow); }
.stat-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 20px; }
.stat-head h3 { font-family: var(--display); font-size: 1.05rem; font-weight: 700; color: var(--ink); line-height: 1.3; }
.stat-head p { margin-top: 2px; font-size: .8rem; color: var(--muted); }
.stat-total {
    flex: none; padding: 4px 12px; border-radius: 999px;
    background: var(--soft); color: var(--ink-3); font-size: .75rem; font-weight: 700; white-space: nowrap;
}
.chart-box { position: relative; height: 340px; }
.stat-hint { margin-top: 14px; font-size: .75rem; color: var(--muted); }
.stat-hint i { margin-right: 6px; }

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

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; }
}

/* ==========================================================
   RESPONSIVE
   ========================================================== */

/* Laptop kecil */
@media (max-width: 1200px) {
    .map-wrap { grid-template-columns: 260px 1fr 230px; }
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

    .stats { grid-template-columns: 1fr; }
    .chart-box { height: 300px; }
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
    .stat-card { padding: 16px; }
    .stat-head { flex-direction: column; gap: 8px; }
    .chart-box { height: 280px; }
    .footer { padding: 56px 0 24px; }
    .sos-fab { right: 16px; bottom: 16px; }
    .sos-fab-btn { padding: 14px 18px; }
}
@media (max-width: 380px) {
    .chips { grid-template-columns: 1fr; }
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
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian">Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan">Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="/layanan-fasilitas/penggunaan-sarana">Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
                        <li><a href="/layanan-fasilitas/skk">Permohonan Sertifikat Keselamatan Kebakaran</a></li>
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
                        <label class="kec-toggle" for="toggle-kec">
                            <span class="kec-toggle-text">
                                <b>Filter kecamatan</b>
                                <small id="toggle-kec-ket">Klik kecamatan untuk menyaring titik</small>
                            </span>
                            <input id="toggle-kec" type="checkbox" role="switch" checked>
                            <span class="kec-switch" aria-hidden="true"></span>
                        </label>
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

            <!-- ==================== GRAFIK ==================== -->
            <section class="stats" id="stats" aria-label="Statistik titik operasional" hidden>
                <article class="stat-card">
                    <div class="stat-head">
                        <div>
                            <h3>Titik per kategori</h3>
                            <p>Jumlah titik tersimpan menurut jenisnya</p>
                        </div>
                        <span class="stat-total" id="total-kat"></span>
                    </div>
                    <div class="chart-box"><canvas id="grafik-kategori" role="img" aria-label="Grafik batang jumlah titik per kategori"></canvas></div>
                    <p class="stat-hint"><i class="fas fa-hand-pointer"></i>Klik batang untuk memfilter peta.</p>
                </article>

                <article class="stat-card">
                    <div class="stat-head">
                        <div>
                            <h3>Sebaran per kecamatan</h3>
                            <p id="sub-kec">Semua kategori</p>
                        </div>
                        <span class="stat-total" id="total-kec"></span>
                    </div>
                    <div class="chart-box"><canvas id="grafik-kecamatan" role="img" aria-label="Grafik batang jumlah titik per kecamatan"></canvas></div>
                    <p class="stat-hint"><i class="fas fa-hand-pointer"></i>Klik batang untuk menyorot kecamatan di peta.</p>
                </article>
            </section>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
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
       Hydrant: Kota = merah, Pilar = biru | Water Truck = kuning | Zona Rawan = oranye
       ========================================================= */
    const KOLOM_NAMA = ['kecamatan', 'KECAMATAN', 'Kecamatan', 'WADMKC', 'NAMOBJ', 'nama', 'NAME_3'];
    const PALET = ['#2563eb', '#dc2626', '#f59e0b', '#10b981', '#8b5cf6', '#ea580c', '#0f172a', '#334155', '#64748b', '#f43f5e', '#14b8a6'];

    // Font Awesome gratis tidak punya ikon hydrant, jadi dibuat sendiri (SVG)
    const SVG_HYDRANT = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 3h6v2h1.5v2h-9V5H9V3zm-1 5h8v2h2v2h-2v6h2v2H6v-2h2v-6H6v-2h2V8zM4 11h2v4H4v-4zm16 0h-2v4h2v-4z"/></svg>';

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

    const state = { kategori: null, kecamatan: '', qKec: '', qTitik: '', filterKec: true };

    const data = { fitur: [], kecamatan: [], titik: [] };
    const layersKec = {};   // nama kecamatan -> [layer poligon]
    const warnaKec  = {};   // nama kecamatan -> warna
    const chips     = {};   // kategori -> elemen chip
    const markers   = new Map(); // titik -> L.marker (dibuat sekali)
    let geojson;

    const el = {
        ringkas: $('ringkas'), kategori: $('kategori'), select:$('filter-kecamatan'),
        cariKec: $('cari'), countKec: $('list-count'), daftarKec:$('daftar-kecamatan'),
        toggleKec: $('toggle-kec'), ketKec: $('toggle-kec-ket'),
        cariTitik: $('cari-titik'), judulTitik:$('judul-titik'), countTitik: $('count-titik'), daftarTitik:$('daftar-titik')
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
        el.cariTitik.disabled = !aktif;
        el.select.disabled = !aktif || !state.filterKec;
        el.cariTitik.value = state.qTitik;

        if (!aktif) {
            el.select.innerHTML = '<option value="">Pilih kategori terlebih dahulu...</option>';
            return;
        }
        if (!state.filterKec) {
            el.select.innerHTML = '<option value="">Filter kecamatan dimatikan</option>';
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

    function renderMarker() {
        grupTitik.clearLayers();
        titikTampil().forEach(p => {
            if (!markers.has(p)) markers.set(p, buatMarker(p));
            grupTitik.addLayer(markers.get(p));
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
            ctx.font = '700 12px ' + Chart.defaults.font.family;
            ctx.fillStyle = '#0f172a';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';
            c.getDatasetMeta(0).data.forEach((bar, i) => ctx.fillText(c.data.datasets[0].data[i], bar.x, bar.y - 4));
            ctx.restore();
        }
    };

    // Buat grafik sekali, lalu cukup perbarui data & legenda
    function aturGrafik(nama, canvasId, config) {
        if (charts[nama]) {
            charts[nama].data = config.data;
            charts[nama].options.plugins.legend.display = config.options.plugins.legend.display;
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
        Chart.defaults.color = '#64748b';

        const keys = Object.keys(KATEGORI);
        const aktifKat = state.kategori;
        const warnaBatang = (warna, aktif) => aktif ? warna : warna + PUDAR;
        const kursor = (e, els) => { e.native.target.style.cursor = els.length ? 'pointer' : 'default'; };
        const grid = { color: '#e2e8f0', drawTicks: false };
        const tooltip = {
            backgroundColor: '#0f172a', padding: 10, cornerRadius: 8, boxPadding: 4,
            titleFont: { weight: '700' }
        };

        /* ---------- Grafik 1: titik per kategori ---------- */
        const totalKat = keys.map(k => data.titik.filter(p => p.kategori === k).length);
        $('total-kat').textContent = data.titik.length + ' titik';

        aturGrafik('kat', 'grafik-kategori', {
            type: 'bar',
            plugins: [labelAngka],
            data: {
                labels: keys.map(k => KATEGORI[k].label),
                datasets: [{
                    data: totalKat,
                    backgroundColor: keys.map(k => warnaBatang(KATEGORI[k].warna, !aktifKat || aktifKat === k)),
                    borderRadius: 8, borderSkipped: false, maxBarThickness: 48
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                animation: { duration: reduceMotion ? 0 : 500 },
                layout: { padding: { top: 22 } },
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
                    x: { grid: { display: false }, border: { display: false }, ticks: { maxRotation: 45, autoSkip: false, font: { size: 11 } } },
                    y: { beginAtZero: true, ticks: { precision: 0, padding: 8 }, grid, border: { display: false } }
                }
            }
        });

        /* ---------- Grafik 2: sebaran per kecamatan ---------- */
        const per = {};
        data.kecamatan.forEach(n => { per[n] = {}; });
        data.titik.forEach(p => {
            if (per[p.kecamatan]) per[p.kecamatan][p.kategori] = (per[p.kecamatan][p.kategori] || 0) + 1;
        });

        const katTampil = aktifKat ? [aktifKat] : keys;
        const jumlah = n => katTampil.reduce((s, k) => s + (per[n][k] || 0), 0);
        const labels = [...data.kecamatan].sort((a, b) => jumlah(b) - jumlah(a) || a.localeCompare(b));

        $('sub-kec').textContent = aktifKat ? KATEGORI[aktifKat].label : 'Semua kategori';
        $('total-kec').textContent = labels.reduce((s, n) => s + jumlah(n), 0) + ' titik';

        aturGrafik('kec', 'grafik-kecamatan', {
            type: 'bar',
            data: {
                labels,
                datasets: katTampil.map(k => ({
                    label: KATEGORI[k].label,
                    data: labels.map(n => per[n][k] || 0),
                    backgroundColor: labels.map(n => warnaBatang(KATEGORI[k].warna, !state.kecamatan || state.kecamatan === n)),
                    borderRadius: 4, borderSkipped: false, maxBarThickness: 22
                }))
            },
            options: {
                indexAxis: 'y',
                responsive: true, maintainAspectRatio: false,
                animation: { duration: reduceMotion ? 0 : 500 },
                onClick: (e, els, chart) => {
                    if (!els.length) return;
                    const n = chart.data.labels[els[0].index];
                    if (n === state.kecamatan) setKecamatan('');
                    else fokusKecamatan(n);
                    $('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                },
                onHover: kursor,
                plugins: {
                    legend: {
                        display: !aktifKat, position: 'top', align: 'start',
                        labels: { usePointStyle: true, pointStyle: 'rectRounded', boxWidth: 10, boxHeight: 10, padding: 14 }
                    },
                    tooltip: { ...tooltip, mode: 'index', intersect: false, callbacks: { label: c => ` ${c.dataset.label}: ${c.parsed.x}` } }
                },
                scales: {
                    x: { stacked: true, beginAtZero: true, ticks: { precision: 0 }, grid, border: { display: false } },
                    y: { stacked: true, grid: { display: false }, border: { display: false } }
                }
            }
        });
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

    function render() {
        renderToggle();
        renderChips();
        renderFilter();
        renderDaftarKecamatan();
        renderDaftarTitik();
        renderMarker();
        try { renderGrafik(); } catch (e) { console.error('Grafik gagal dimuat:', e); }
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
        if (state.kategori && state.filterKec) return setKecamatan(nama);
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
        b.setAttribute('aria-pressed', 'false');
        b.innerHTML = `<span class="dot" style="background:${v.warna}">${ikon(v)}</span><span>${v.label}</span><b>0</b>`;
        b.addEventListener('click', () => setKategori(k));
        chips[k] = b;
        el.kategori.appendChild(b);
    });

    function buatMarker(p) {
        const v = KATEGORI[p.kategori];
        const icon = L.divIcon({
            className: '', iconSize: [36, 36], iconAnchor: [18, 18], popupAnchor: [0, -18],
            html: `<div class="pin" style="background:${v.warna}">${ikon(v)}</div>`
        });
        // Urutan baris: Kategori, Kecamatan, Lokasi, Keterangan
        const baris = [
            ['Kategori', v.label],
            ['Kecamatan', p.kecamatan],
            ['Lokasi', p.lokasi],
            ['Keterangan', p.keterangan]
        ].filter(([, x]) => x).map(([a, b]) => `<tr><td>${esc(a)}</td><td>${esc(b)}</td></tr>`).join('');
        const popup = `<div class="popup"><h3>${esc(p.nama)}</h3><table>${baris}</table>
            <a href="https://www.google.com/maps/dir/?api=1&destination=${p.lat},${p.lng}" target="_blank" rel="noopener"><i class="fas fa-directions"></i> Rute ke lokasi</a></div>`;
        return L.marker([p.lat, p.lng], { icon, title: p.nama, alt: p.nama }).bindPopup(popup, { maxWidth: 320, autoPanPadding: [20, 20] });
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
    el.toggleKec.addEventListener('change', () => {
        state.filterKec = el.toggleKec.checked;
        if (!state.filterKec) {
            state.kecamatan = '';
            if (geojson) map.fitBounds(geojson.getBounds());
        }
        render();
    });
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
        el.daftarKec.innerHTML = '<li class="kosong">File GeoJSON tidak ditemukan.</li>';
    });
})();
</script>
</body>
</html>