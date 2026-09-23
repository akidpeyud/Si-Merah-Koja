<?php
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    // Isi dengan link Google Play jika aplikasi sudah tersedia. Kosong = badge disembunyikan.
    $play_store_url = "";

    // Data Video Edukasi
    $video_edukasi = [
        ['yt' => '', 'judul' => 'Cara memakai APAR dengan benar'],
        ['yt' => '', 'judul' => 'Langkah evakuasi saat terjadi kebakaran'],
        ['yt' => '', 'judul' => 'Mencegah kebakaran akibat korsleting listrik'],
        ['yt' => '', 'judul' => 'Pertolongan pertama pada luka bakar'],
    ];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="SIMERAH KOJA, Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi. Lapor kebakaran, ajukan perizinan proteksi kebakaran, dan ikuti kejadian terbaru.">
    <title>SIMERAH KOJA - Damkar Kota Jambi</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================
           TOKENS
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
        ul { list-style: none; }
        button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
        section[id], div[id] { scroll-margin-top: calc(var(--header-h) + 16px); }

        :focus-visible { outline: 3px solid var(--amber); outline-offset: 3px; border-radius: 6px; }

        .wrap { max-width: var(--wrap); margin: 0 auto; padding-left: clamp(16px, 4vw, 32px); padding-right: clamp(16px, 4vw, 32px); }
        .section { padding-top: clamp(64px, 9vw, 120px); padding-bottom: clamp(64px, 9vw, 120px); }
        .bg-paper { background: var(--paper); }
        .bg-ink { background: var(--ink); color: #fff; }

        .sec-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 32px; margin-bottom: clamp(32px, 5vw, 56px); }
        .sec-head h2 {
            font-family: var(--font-display);
            font-weight: 700;
            font-stretch: 90%;
            font-size: clamp(2rem, 4.4vw, 3.25rem);
            line-height: 1.05;
            letter-spacing: -0.025em;
        }
        .sec-head p { margin-top: 12px; max-width: 52ch; color: var(--steel); font-size: 1.05rem; }
        .bg-ink .sec-head p { color: rgba(255,255,255,.7); }
        .sec-head img { width: clamp(140px, 20vw, 240px); flex: none; }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 10px;
            padding: 14px 24px; border-radius: 999px; font-weight: 600; font-size: .95rem;
            transition: background .2s, transform .2s, border-color .2s;
        }
        .btn:active { transform: scale(.97); }
        .btn-light { background: #fff; color: var(--ink); }
        .btn-light:hover { background: var(--amber); }
        .btn-ghost { border: 1.5px solid rgba(255,255,255,.35); color: #fff; }
        .btn-ghost:hover { border-color: #fff; background: rgba(255,255,255,.08); }

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
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger { background: rgba(255,255,255,.1); color: #fff; }
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
        .dropdown a:hover { background: rgba(255,255,255,.08); color: #fff; }
        
        /* Tombol Logout Dropdown */
        .dropdown .btn-logout {
            width: 100%; text-align: left; padding: 11px 14px; border-radius: var(--r-sm); 
            font-size: .92rem; color: #ff8b8b; display: flex; align-items: center; gap: 8px; 
            transition: background .2s, color .2s; cursor: pointer;
        }
        .dropdown .btn-logout:hover { background: rgba(255, 255, 255, .1); color: #ffb8b8; }

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
           HERO
           ========================================================== */
        .hero {
            position: relative; isolation: isolate; color: #fff; background: var(--ink); overflow: hidden;
            min-height: calc(100svh - var(--header-h));
            display: flex; flex-direction: column;
        }
        .hero-bg { position: absolute; inset: 0; z-index: -2; background-size: cover; background-position: center; }
        .hero-bg.b1 { background-image: url('/images/background1.png'); }
        .hero-bg.b2 { background-image: url('/images/background2.jpeg'); animation: crossfade 14s infinite ease-in-out; }
        @keyframes crossfade { 0%, 40% { opacity: 0; } 50%, 90% { opacity: 1; } 100% { opacity: 0; } }
        .hero::before {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background:
                radial-gradient(60% 55% at 8% 100%, rgba(229,57,45,.38), transparent 70%),
                linear-gradient(100deg, rgba(13,27,42,.97) 0%, rgba(13,27,42,.84) 48%, rgba(13,27,42,.62) 100%);
        }

        .hero-inner {
            flex: 1; width: 100%; max-width: var(--wrap); margin: 0 auto;
            padding: clamp(40px, 7vw, 88px) clamp(16px, 4vw, 32px) clamp(40px, 6vw, 72px);
            display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr);
            gap: clamp(32px, 5vw, 80px); align-items: center;
        }
        .hero-logos { display: flex; align-items: center; gap: 18px; margin-bottom: clamp(24px, 4vw, 40px); }
        .hero-logos img { height: clamp(44px, 6vw, 60px); width: auto; filter: drop-shadow(0 6px 14px rgba(0,0,0,.35)); }
        
        .hero h1 {
            font-family: var(--font-display); font-weight: 800; font-stretch: 82%;
            font-size: clamp(3.4rem, 10.5vw, 8rem); line-height: .9; letter-spacing: -0.035em;
            text-wrap: balance;
        }
        .hero-full { margin-top: 20px; font-weight: 600; font-size: clamp(.95rem, 1.6vw, 1.1rem); color: rgba(255,255,255,.85); letter-spacing: .01em; }
        .hero-lead { margin-top: 14px; max-width: 46ch; color: rgba(255,255,255,.7); font-size: clamp(1rem, 1.5vw, 1.15rem); }
        .hero-cta { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 32px; }

        .rise { animation: rise .8s cubic-bezier(.16,.84,.3,1) both; }
        .rise.d1 { animation-delay: .08s; } .rise.d2 { animation-delay: .18s; }
        .rise.d3 { animation-delay: .28s; } .rise.d4 { animation-delay: .4s; }
        @keyframes rise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

        /* Panel lapor darurat */
        .sos {
            background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.16);
            -webkit-backdrop-filter: blur(18px); backdrop-filter: blur(18px);
            border-radius: var(--r-lg); padding: clamp(20px, 3vw, 30px);
            box-shadow: 0 30px 60px -20px rgba(0,0,0,.5);
        }
        .sos-head { display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: .95rem; color: rgba(255,255,255,.85); }
        .beacon { position: relative; width: 12px; height: 12px; border-radius: 50%; background: var(--signal); flex: none; }
        .beacon::after { content: ""; position: absolute; inset: 0; border-radius: 50%; background: var(--signal); animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
        @keyframes ping { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(3.2); opacity: 0; } }
        .sos h2 {
            font-family: var(--font-display); font-weight: 700; font-stretch: 90%;
            font-size: clamp(1.5rem, 2.6vw, 2rem); line-height: 1.1; letter-spacing: -0.02em;
            margin: 14px 0 22px;
        }
        .sos-list { display: grid; gap: 10px; }
        .sos-link {
            display: grid; grid-template-columns: 48px 1fr auto; align-items: center; gap: 14px;
            padding: 12px 16px 12px 12px; border-radius: 16px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1);
            transition: background .2s, transform .2s, border-color .2s;
        }
        .sos-link:hover { background: rgba(255,255,255,.15); transform: translateX(4px); }
        .sos-ico { width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center; font-size: 1.3rem; background: rgba(255,255,255,.1); }
        .sos-txt strong { display: block; font-size: 1rem; line-height: 1.3; }
        .sos-txt span { display: block; font-size: .85rem; color: rgba(255,255,255,.65); line-height: 1.4; }
        .sos-link > i { font-size: .8rem; opacity: .6; }
        .sos-link.primary { background: var(--signal); border-color: transparent; }
        .sos-link.primary:hover { background: var(--signal-d); }
        .sos-link.primary .sos-ico { background: rgba(255,255,255,.2); }
        .sos-link.primary .sos-txt span { color: rgba(255,255,255,.85); }
        .sos-prep { margin-top: 20px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,.12); }
        .sos-prep p { font-size: .85rem; color: rgba(255,255,255,.65); margin-bottom: 10px; }
        .sos-prep ul { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 16px; font-size: .88rem; }
        .sos-prep li { display: flex; align-items: center; gap: 8px; }
        .sos-prep i { color: var(--amber); font-size: .75rem; }

        /* Ticker kejadian terbaru */
        .ticker { display: flex; border-top: 1px solid rgba(255,255,255,.12); background: rgba(13,27,42,.72); -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px); }
        .ticker-label { flex: none; display: flex; align-items: center; gap: 10px; padding: 14px clamp(14px, 3vw, 28px); background: var(--signal); font-weight: 600; font-size: .88rem; }
        .ticker-label .beacon { background: #fff; width: 8px; height: 8px; }
        .ticker-label .beacon::after { background: #fff; }
        .ticker-track { flex: 1; overflow: hidden; display: flex; align-items: center; -webkit-mask-image: linear-gradient(90deg, transparent, #000 40px, #000 calc(100% - 40px), transparent); mask-image: linear-gradient(90deg, transparent, #000 40px, #000 calc(100% - 40px), transparent); }
        .ticker-run { display: flex; width: max-content; animation: tick 60s linear infinite; }
        .ticker-track:hover .ticker-run { animation-play-state: paused; }
        .ticker-group { display: flex; gap: 48px; padding-right: 48px; }
        .tick { display: inline-flex; align-items: center; gap: 10px; font-size: .9rem; color: rgba(255,255,255,.88); white-space: nowrap; }
        .tick:hover { color: var(--amber); }
        .tick b { font-weight: 600; font-size: .78rem; padding: 2px 8px; border-radius: 6px; background: rgba(255,255,255,.14); }
        @keyframes tick { to { transform: translateX(-50%); } }

        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; }
            .sos-prep ul { grid-template-columns: 1fr; }
        }

        /* ==========================================================
           TENTANG
           ========================================================== */
        .about { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr); gap: clamp(32px, 6vw, 88px); align-items: center; }
        .about-art {
            position: relative; aspect-ratio: 1 / 1; border-radius: var(--r-lg); overflow: hidden;
            background: radial-gradient(70% 70% at 50% 40%, var(--ink-3), var(--ink));
            display: grid; place-items: center; padding: 12%;
        }
        .about-art::after { content: ""; position: absolute; inset: auto -20% -40% -20%; height: 70%; background: radial-gradient(closest-side, rgba(229,57,45,.45), transparent); }
        .about-art img { position: relative; z-index: 1; width: 100%; filter: drop-shadow(0 20px 30px rgba(0,0,0,.4)); }
        .about-copy p { color: #3b4b5e; font-size: 1.06rem; max-width: 60ch; }
        .about-copy p + p { margin-top: 18px; }
        .about-copy .sec-head { margin-bottom: 28px; }

        .quote { margin-top: clamp(48px, 7vw, 88px); padding: clamp(28px, 5vw, 56px); border-radius: var(--r-lg); background: var(--ink); color: #fff; position: relative; overflow: hidden; }
        .quote::before { content: "\201C"; position: absolute; top: -.15em; right: .1em; font-family: var(--font-display); font-weight: 800; font-size: clamp(9rem, 22vw, 18rem); line-height: 1; color: var(--signal); opacity: .9; }
        .quote blockquote { position: relative; max-width: 30ch; font-family: var(--font-display); font-weight: 600; font-stretch: 88%; font-size: clamp(1.4rem, 3.2vw, 2.4rem); line-height: 1.2; letter-spacing: -0.015em; text-wrap: balance; }
        .quote figcaption { position: relative; margin-top: 24px; display: flex; align-items: center; gap: 14px; font-weight: 600; color: rgba(255,255,255,.8); }
        .quote figcaption::before { content: ""; width: 36px; height: 2px; background: var(--amber); }
        @media (max-width: 860px) { .about { grid-template-columns: 1fr; } .about-art { max-width: 380px; } }

        /* ==========================================================
           KEJADIAN & EVAKUASI
           ========================================================== */
        .kj-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; }
        .kj-card { display: flex; flex-direction: column; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; transition: transform .25s, box-shadow .25s; }
        .kj-card:hover { transform: translateY(-4px); box-shadow: 0 22px 40px -22px rgba(13,27,42,.4); }
        .kj-card.is-featured { grid-column: span 2; }
        .kj-thumb { position: relative; height: 210px; background: var(--paper); overflow: hidden; }
        .kj-card.is-featured .kj-thumb { height: 320px; }
        .kj-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s; }
        .kj-card:hover .kj-thumb img { transform: scale(1.04); }
        .kj-ph { width: 100%; height: 100%; display: grid; place-content: center; justify-items: center; gap: 8px; color: #94a3b8; font-weight: 600; font-size: .9rem; background: repeating-linear-gradient(135deg, var(--paper) 0 14px, #eaeef3 14px 28px); }
        .kj-ph i { font-size: 2.2rem; color: #b8c3d0; }
        .kj-date { position: absolute; top: 14px; left: 14px; padding: 8px 12px; border-radius: 12px; text-align: center; line-height: 1; color: #fff; background: rgba(13,27,42,.9); -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); }
        .kj-date.baru { background: rgba(229,57,45,.94); }
        .kj-date b { display: block; font-family: var(--font-display); font-size: 1.5rem; font-weight: 800; }
        .kj-date span { display: block; margin-top: 3px; font-size: .72rem; font-weight: 600; text-transform: capitalize; opacity: .9; }
        .kj-flag { position: absolute; top: 14px; right: 14px; padding: 5px 11px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: var(--amber); color: var(--ink); }
        .kj-body { display: flex; flex-direction: column; flex: 1; padding: 22px 24px 24px; }
        .kj-body h3 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.2rem; line-height: 1.25; letter-spacing: -0.01em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .kj-card.is-featured h3 { font-size: 1.6rem; }
        .kj-meta { display: grid; gap: 6px; margin: 14px 0; padding-bottom: 14px; border-bottom: 1px solid var(--line); font-size: .86rem; color: var(--steel); }
        .kj-meta div { display: flex; gap: 10px; align-items: flex-start; }
        .kj-meta i { color: var(--signal-d); margin-top: 4px; width: 14px; text-align: center; }
        .kj-body p { color: #3b4b5e; font-size: .94rem; flex: 1; }
        .kj-more { margin-top: 16px; display: inline-flex; align-items: center; gap: 8px; font-weight: 700; font-size: .9rem; color: var(--signal-d); transition: gap .25s; }
        .kj-card:hover .kj-more { gap: 14px; }

        .empty { grid-column: 1 / -1; text-align: center; padding: 56px 24px; border: 1.5px dashed var(--line); border-radius: var(--r-md); color: var(--steel); }
        .empty i { font-size: 2rem; color: #b8c3d0; margin-bottom: 12px; }
        .empty h3 { font-family: var(--font-display); font-size: 1.2rem; color: var(--ink); }
        .empty p { margin-top: 4px; font-size: .95rem; }

        @media (max-width: 960px) { .kj-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 620px) { .kj-grid { grid-template-columns: 1fr; } .kj-card.is-featured { grid-column: auto; } .kj-card.is-featured .kj-thumb { height: 230px; } }

        /* ==========================================================
           VIDEO EDUKASI
           ========================================================== */
        .vid-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; }
        .vid { text-align: left; display: block; width: 100%; }
        .vid-thumb { position: relative; aspect-ratio: 16 / 10; border-radius: var(--r-md); overflow: hidden; background: repeating-linear-gradient(135deg, var(--ink-2) 0 16px, var(--ink-3) 16px 32px); border: 1px solid rgba(255,255,255,.1); transition: border-color .25s, transform .25s; }
        .vid-thumb img { width: 100%; height: 100%; object-fit: cover; opacity: .85; transition: opacity .25s, transform .5s; }
        .vid:not([disabled]):hover .vid-thumb { border-color: var(--signal); transform: translateY(-4px); }
        .vid:not([disabled]):hover img { opacity: 1; transform: scale(1.04); }
        .vid-play { position: absolute; inset: 0; display: grid; place-items: center; }
        .vid-play span { width: 60px; height: 60px; border-radius: 50%; display: grid; place-items: center; background: var(--signal); font-size: 1.15rem; padding-left: 3px; box-shadow: 0 10px 24px rgba(0,0,0,.4); transition: transform .25s; }
        .vid:not([disabled]):hover .vid-play span { transform: scale(1.1); }
        .vid[disabled] { cursor: default; }
        .vid[disabled] .vid-play span { background: rgba(255,255,255,.14); box-shadow: none; }
        .vid-soon { position: absolute; left: 12px; bottom: 12px; padding: 4px 10px; border-radius: 999px; font-size: .75rem; font-weight: 600; background: rgba(13,27,42,.8); }
        .vid h3 { margin-top: 14px; font-size: 1rem; font-weight: 600; line-height: 1.35; color: rgba(255,255,255,.92); }
        @media (max-width: 960px) { .vid-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 480px) { .vid-grid { grid-template-columns: 1fr; } }

        /* ==========================================================
           INFO GRAFIS & MEDIA INFORMASI
           ========================================================== */
        .grafis { columns: 3 260px; column-gap: 20px; }
        .grafis-item { display: block; width: 100%; break-inside: avoid; margin-bottom: 20px; position: relative; border-radius: var(--r-md); overflow: hidden; background: #fff; box-shadow: 0 1px 0 var(--line), 0 12px 28px -18px rgba(13,27,42,.35); }
        .grafis-item img { width: 100%; height: auto; transition: transform .5s; }
        .grafis-item:hover img { transform: scale(1.03); }
        .grafis-item .zoom { position: absolute; right: 12px; bottom: 12px; width: 42px; height: 42px; border-radius: 50%; display: grid; place-items: center; background: var(--ink); color: #fff; opacity: 0; transform: translateY(6px); transition: opacity .25s, transform .25s; }
        .grafis-item:hover .zoom, .grafis-item:focus-visible .zoom { opacity: 1; transform: none; }
        @media (hover: none) { .grafis-item .zoom { opacity: 1; transform: none; } }

        .sub-head { margin: clamp(64px, 9vw, 112px) 0 clamp(28px, 4vw, 48px); }

        /* Media Filter (Clean Pill tanpa #) */
        .media-filter { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: clamp(20px, 3vw, 28px); }
        .pill { padding: 9px 18px; border-radius: 999px; background: #fff; border: 1px solid var(--line); font-weight: 600; font-size: .87rem; color: var(--steel); transition: background .2s, color .2s, border-color .2s; }
        .pill:hover { border-color: #b8c3d0; color: var(--ink); }
        .pill.is-active { background: var(--ink); border-color: var(--ink); color: #fff; }

        /* Media Card (Lebih kecil = 250px) */
        .media-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .media-card { display: flex; flex-direction: column; background: #fff; border-radius: var(--r-md); overflow: hidden; border: 1px solid var(--line); transition: transform .3s, box-shadow .3s; }
        .media-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -15px rgba(13,27,42,.15); border-color: transparent;}
        
        .media-thumb { position: relative; background: var(--paper); aspect-ratio: 4 / 3; overflow: hidden; }
        .media-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s;}
        .media-card:hover .media-thumb img { transform: scale(1.05); }
        
        /* Floating Badge Modern */
        .media-tag { 
            position: absolute; top: 12px; left: 12px; padding: 4px 12px; border-radius: 6px; 
            font-size: .7rem; font-weight: 700; letter-spacing: .03em; text-transform: uppercase; 
            background: rgba(255, 255, 255, 0.95); color: var(--signal-d); z-index: 2;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08); backdrop-filter: blur(4px);
        }
        
        .media-body { display: flex; flex-direction: column; flex: 1; padding: 18px 20px 20px; }
        .media-body h3 { font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 12px; transition: color 0.2s;}
        .media-card:hover .media-body h3 { color: var(--signal); }
        
        .media-meta { margin-bottom: 16px; display: flex; flex-wrap: wrap; gap: 6px 14px; font-size: .8rem; color: var(--steel); font-weight: 500;}
        .media-meta span { display: flex; align-items: center; gap: 6px; }
        .media-meta .fa-instagram { color: #d6249f; }
        .media-meta .fa-youtube { color: #ff0000; }
        .media-meta .fa-tiktok { color: #111; }
        
        .media-body a { margin-top: auto; font-weight: 700; font-size: .88rem; color: var(--signal-d); display: inline-flex; gap: 6px; align-items: center; transition: gap 0.2s; }
        .media-card:hover .media-body a { gap: 10px; }
        
        .media-empty-filter { grid-column: 1 / -1; text-align: center; padding: 48px 24px; border: 1.5px dashed var(--line); border-radius: var(--r-md); color: var(--steel); }

        /* ==========================================================
           GIAT
           ========================================================== */
        .giat { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr); gap: clamp(32px, 6vw, 88px); align-items: start; }
        .giat-art { position: sticky; top: calc(var(--header-h) + 32px); border-radius: var(--r-lg); background: var(--paper); padding: clamp(24px, 5vw, 48px); }
        .giat-art img { width: 100%; max-width: 380px; margin: 0 auto; filter: drop-shadow(0 20px 28px rgba(13,27,42,.2)); }
        .timeline { margin-top: 8px; border-left: 2px solid var(--line); margin-left: 8px; }
        .tl-item { position: relative; padding: 0 0 44px 36px; }
        .tl-item:last-child { padding-bottom: 0; }
        .tl-item::before { content: ""; position: absolute; left: -9px; top: 6px; width: 16px; height: 16px; border-radius: 50%; background: #fff; border: 4px solid var(--signal); }
        .tl-item time { display: inline-flex; align-items: baseline; gap: 6px; padding: 5px 12px; border-radius: 999px; background: var(--ink); color: #fff; font-weight: 600; font-size: .85rem; }
        .tl-item h3 { margin: 14px 0 8px; font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.35rem; line-height: 1.25; letter-spacing: -0.01em; }
        .tl-item p { color: #3b4b5e; max-width: 60ch; }
        .tl-item a { display: inline-flex; gap: 8px; align-items: center; margin-top: 12px; font-weight: 700; font-size: .92rem; color: var(--signal-d); }
        .tl-item a:hover { text-decoration: underline; text-underline-offset: 4px; }
        @media (max-width: 860px) { .giat { grid-template-columns: 1fr; } .giat-art { position: static; max-width: 420px; } }

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
           DIALOG (infografis & video)
           ========================================================== */
        dialog { border: 0; padding: 0; background: transparent; color: #fff; max-width: min(1000px, 94vw); max-height: 94dvh; margin: auto; overflow: visible; }
        dialog::backdrop { background: rgba(7,14,24,.86); -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); }
        .dlg-close { position: absolute; top: -52px; right: 0; width: 44px; height: 44px; border-radius: 50%; background: #fff; color: var(--ink); font-size: 1.1rem; display: grid; place-items: center; }
        .dlg-close:hover { background: var(--amber); }
        #lightbox img { max-height: 80dvh; width: auto; margin: 0 auto; border-radius: var(--r-md); box-shadow: 0 30px 60px rgba(0,0,0,.5); }
        #lightbox p { margin-top: 14px; text-align: center; font-weight: 600; }
        #videoDialog { width: min(960px, 94vw); }
        .video-frame { aspect-ratio: 16 / 9; border-radius: var(--r-md); overflow: hidden; background: #000; }
        .video-frame iframe { width: 100%; height: 100%; border: 0; }

        /* ==========================================================
           REDUCED MOTION
           ========================================================== */
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation: none !important; transition: none !important; }
            .hero-bg.b2 { opacity: 0; }
            .ticker-track { overflow-x: auto; }
        }
    </style>
</head>
<body>

<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
    <!-- SPLASH SCREEN LOADING -->
    <div id="splash-screen">
        <div class="splash-logo-container">
            <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
            <div class="splash-title">SIMERAH KOJA</div>
        </div>
        <div class="splash-spinner"></div>
    </div>

    <?php
        $no_whatsapp = "628117113113"; 
        $no_telepon  = "074141171";
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    ?>

    <!-- NAVBAR TEMA GELAP -->
    <nav class="navbar-custom">
        <div class="nav-logos">
            <img src="/images/jambi.png" alt="Logo Pemkot">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </div>
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
                    <li><a href="/layanan-fasilitas/perjanjian_kerjasama">PKS</a></li>
                </ul>
            </li>
            <li><a href="/redkar">Redkar</a></li>
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- HERO SECTION (HOME) -->
    <div class="hero-section">
        <div class="main-content">
            <div class="center-logos">
                <img src="/images/jambi.png" alt="Logo Pemkot">
                <img src="/images/logo.png" alt="Logo Damkar">
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </div>
            
            <h1 class="title-simerah">SIMERAH KOJA</h1>
            
            <p class="subtitle">
                SISTEM INFORMASI PENANGGULANGAN KEBAKARAN<br>
                DAN PENYELAMATAN DAERAH KOTA JAMBI
            </p>

            <div class="emergency-btn-container">
                <div class="btn-darurat">
                    <i class="fas fa-bullhorn icon-darurat"></i>
                    <span>TOMBOL<br>DARURAT<br>LAPOR</span>
                </div>
                
                <div class="emergency-popup">
                    <a href="https://wa.me/<?php echo $no_whatsapp; ?>?text=<?php echo $pesan_wa; ?>" target="_blank" class="text-wa">
                        <i class="fab fa-whatsapp"></i> <span>WHATSAPP</span>
                    </a>
                    <a href="tel:<?php echo $no_telepon; ?>" class="text-telp">
                        <i class="fas fa-phone-alt"></i> <span>TELEPHONE</span>
                    </a>
                    <a href="tel:112" class="text-112">
                        <i class="fas fa-headset"></i> <span>CALL CENTER 112</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 1: TENTANG SIMERAH KOJA -->
    <div class="section-container">
        <div class="about-section">
            <div class="about-text">
                <div class="section-title-wrap">
                    <div class="section-subtitle">Sistem Informasi Pemadam Kebakaran & Penyelamatan</div>
                    <h2 class="section-title">Tentang <span>SIMERAH</span> KOJA</h2>
                    <div class="section-divider"><i class="fas fa-circle"></i></div>
                </div>
                
                <p>SIMERAH KOJA adalah Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi yang berbasis digitalisasi dalam rangka memberikan kemudahan pelayanan publik kepada masyarakat antara lain pelayanan pemadaman, penyelamatan, perizinan, edukasi dan pemeriksaan proteksi kebakaran.</p>
                
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi untuk mendukung program Smart City Kota Jambi.</p>

                <div class="about-quote">
                    <h3>Pantang Pulang Sebelum Padam, Walaupun Nyawa Taruhannya... Pulang Dengan Selamat, Pulang Dengan Cidera, Pulang Tinggal Nama</h3>
                    <p>— Satria Biru Yudha Brama Jaya</p>
                    <i class="fas fa-quote-right quote-icon"></i>
                </div>
            </div>
            
            <div class="about-image">
                <img src="/images/simerahkoja.png" alt="Logo Besar Simerah Koja">
            </div>
        </div>
    </div>

    <!-- SECTION 2: LAYANAN & FASILITAS -->
    <div class="section-container layanan-section">
        <div class="section-title-wrap">
            <div class="section-subtitle">Sistem Layanan Kebakaran Dan Penyelamatan Utama</div>
            <h2 class="section-title">LAYANAN & <span>FASILITAS</span></h2>
            <div class="section-divider"><i class="fas fa-circle"></i></div>
        </div>

        <div class="layanan-grid">
            <a href="/layanan-fasilitas/layanan_perizinan" class="layanan-card">
                <div class="layanan-icon icon-gray"><i class="far fa-building"></i></div>
                <h3>RPKBGL</h3>
                <p>Layanan Perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan.</p>
            </a>
            
            <a href="/layanan-fasilitas/skk" class="layanan-card">
                <div class="layanan-icon icon-pink"><i class="fas fa-user-shield"></i></div>
                <h3>SKK</h3>
                <p>Layanan Perizinan Penerbitan Sertifikat Keamanan Kebakaran.</p>
            </a>
            
            <a href="/layanan-fasilitas/perpanjang_skk" class="layanan-card">
                <div class="layanan-icon icon-orange"><i class="fas fa-fire-extinguisher"></i></div>
                <h3>Perpanjang SKK</h3>
                <p>Layanan Perizinan Perpanjangan Sertifikat Keamanan Kebakaran.</p>
            </a>
            
            <a href="/layanan-fasilitas/izin_penjualan" class="layanan-card">
                <div class="layanan-icon icon-purple"><i class="fas fa-file-invoice"></i></div>
                <h3>Izin Penjualan</h3>
                <p>Layanan Perizinan Penjualan Alat-alat Pencegahan, Pemadaman Kebakaran dan Penyelamatan.</p>
            </a>
            
            <a href="/redkar" class="layanan-card">
                <div class="layanan-icon icon-red"><i class="fas fa-running"></i></div>
                <h3>REDKAR</h3>
                <p>Kumpulan Relawan Pemadam Kebakaran Kota Jambi.</p>
            </a>
            
            <a href="/layanan-fasilitas/perjanjian_kerjasama" class="layanan-card">
                <div class="layanan-icon icon-yellow"><i class="fas fa-handshake"></i></div>
                <h3>PKS</h3>
                <p>Daftar Perjanjian Kerjasama dengan Instansi Terkait.</p>
            </a>
            
            <a href="/layanan-fasilitas/edukasi_sosialisasi" class="layanan-card">
                <div class="layanan-icon icon-blue"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>Edukasi Sosialisasi</h3>
                <p>Edukasi dan Sosialisasi untuk masyarakat baik instansi maupun pendidikan.</p>
            </a>
            
            <a href="#" class="layanan-card">
                <div class="layanan-icon icon-orange"><i class="fas fa-mobile-alt"></i></div>
                <h3>Media Edukasi</h3>
                <p>Media Edukasi berupa info grafis, modul pembelajaran, dan video edukasi lainnya.</p>
            </a>
        </div>
    </div>

    <!-- SECTION 3: KEJADIAN & EVAKUASI -->
    <div class="section-container kejadian-section">
        <div class="kejadian-header-img">
           <img src="/images/mobil.png" alt="Logo mobil damkar">
        </div>
        
        <div class="section-title-wrap">
            <div class="section-subtitle">Dapatkan Informasi Terbaru tentang Kejadian di Kota Jambi</div>
            <h2 class="section-title">Kejadian & <span>Evakuasi</span></h2>
            <div class="section-divider"><i class="fas fa-circle"></i></div>
        </div>

        <div class="kejadian-grid">
            @forelse($daftar_berita ?? [] as $berita)
                <a href="/berita/{{ $berita->id }}" class="kejadian-card">
                    <div class="kejadian-thumb">
                        <div class="kejadian-date-badge" style="{{ \Carbon\Carbon::parse($berita->tanggal_kejadian)->diffInDays(now()) <= 3 ? 'background-color: #ef4444;' : 'background-color: #111827;' }}">
                            <span>{{ \Carbon\Carbon::parse($berita->tanggal_kejadian)->format('d') }}</span>
                            <span>{{ \Carbon\Carbon::parse($berita->tanggal_kejadian)->format('M') }}</span>
                        </div>
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                        @else
                            <div class="kejadian-placeholder">
                                <i class="fas fa-fire-extinguisher"></i>
                                <span class="small fw-bold">Damkar Kota Jambi</span>
                            </div>
                        @endif
                    </div>
                    <div class="kejadian-content">
                        <h3>{{ $berita->judul }}</h3>
                        <div class="meta">
                            <div title="Lokasi"><i class="fas fa-map-marker-alt"></i> <span>{{ Str::limit($berita->lokasi, 40) }}</span></div>
                            <div title="Waktu Laporan"><i class="far fa-clock"></i> <span>{{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }} WIB - Pelapor: {{ $berita->pelapor }}</span></div>
                        </div>
                        <p>{{ Str::limit($berita->keterangan_singkat ?? $berita->detail_lengkap, 90) }}</p>
                        <span class="baca">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            @empty
                <div class="text-muted w-100" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 40px;"></i>
                    <h5 class="fw-bold">Belum ada informasi kejadian terbaru</h5>
=======
<?php
    $no_whatsapp = "628117113113";
    $no_telepon  = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    /*
      Video edukasi: isi 'yt' dengan ID video YouTube (bagian setelah "v=" pada URL).
      Selama 'yt' kosong, kartu tampil sebagai "Segera hadir". Judul di bawah hanya contoh.
    */
    $video_edukasi = [
        ['yt' => '', 'judul' => 'Cara memakai APAR dengan benar'],
        ['yt' => '', 'judul' => 'Langkah evakuasi saat terjadi kebakaran'],
        ['yt' => '', 'judul' => 'Mencegah kebakaran akibat korsleting listrik'],
        ['yt' => '', 'judul' => 'Pertolongan pertama pada luka bakar'],
    ];
?>

>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
=======
>>>>>>> 9d64ab909d89535ce270e48403a9dcabc77c2bff
<!-- ==================== HEADER ==================== -->
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <div class="brand">
            <a href="/" aria-label="SIMERAH KOJA, beranda">
                <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            </a>
            <!-- KLIK LOGO DAMKAR KE LOGIN INTERNAL -->
             <a href="/login" title="Login Internal Pegawai">
                <img src="/images/logo.png" alt="Logo Damkar">
            </a>
            <a href="/redkar" aria-label="Redkar">
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </a>
        </div>

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
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan<i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">Layanan perizinan</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Kabar Damkar <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/video-edukasi">Video Edukasi</a></li>
                    <li><a href="/info-grafis">Info Grafis</a></li>
                    <li><a href="/media-informasi">Media Informasi</a></li>
                    <li><a href="/giat-disdamkartan">Giat Disdamkartan</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>

            <!-- TOMBOL LOGIN / LOGOUT PEMOHON -->
            @if(session()->has('pemohon_id'))
                <li class="has-drop">
                    <button class="menu-trigger btn-login" type="button" aria-expanded="false">
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
             <a href="{{ route('login') }}" class="btn text-white" style="background-color: #ef4444;">Masuk</a>
            @endif

        </ul>
    </nav>
</header>

<main>

<!-- ==================== HERO ==================== -->
<section class="hero" aria-labelledby="judul-hero">
    <div class="hero-bg b1"></div>
    <div class="hero-bg b2"></div>

    <div class="hero-inner">
        <div>
            <div class="hero-logos rise">
                <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
                <a href="/login" title="Login Internal Pegawai">
                    <img src="/images/logo.png" alt="Logo Damkar">
                </a>
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </div>
            
            <div class="hero-title-wrapper rise d1" style="display: flex; align-items: center; gap: clamp(16px, 3vw, 28px); margin-bottom: 8px;">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" style="height: clamp(80px, 12vw, 140px); width: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5)); flex: none;">
                <h1 id="judul-hero" style="margin: 0;">
                    <span style="color: var(--signal);">SIMERAH</span><br>KOJA
                </h1>
            </div>

            <p class="hero-full rise d2">
                <span style="color: var(--signal);">S</span>istem 
                <span style="color: var(--signal);">I</span>nfor<span style="color: var(--signal);">m</span>asi 
                P<span style="color: var(--signal);">e</span>nanggulangan 
                Kebaka<span style="color: var(--signal);">r</span>an 
                dan Penyelam<span style="color: var(--signal);">a</span>tan 
                Daera<span style="color: var(--signal);">h</span> 
                <span style="color: var(--signal);">Ko</span>ta 
                <span style="color: var(--signal);">Ja</span>mbi
            </p>
            <p class="hero-lead rise d2">Lapor kebakaran dan penyelamatan langsung ke petugas, atau urus perizinan proteksi kebakaran secara digital.</p>
            <div class="hero-cta rise d3">
                <a class="btn btn-light" href="#kejadian">Lihat kejadian <i class="fas fa-arrow-down"></i></a>
                <a class="btn btn-ghost" href="#kejadian">Kejadian terbaru</a>
            </div>
        </div>

        <aside class="sos rise d3" id="lapor" aria-labelledby="judul-lapor">
            <div class="sos-head"><span class="beacon" aria-hidden="true"></span> Lapor darurat</div>
            <h2 id="judul-lapor">Kebakaran atau butuh penyelamatan?</h2>

            <div class="sos-list">
                <a class="sos-link primary" href="{{ $wa_link }}" target="_blank" rel="noopener">
                    <span class="sos-ico"><i class="fab fa-whatsapp"></i></span>
                    <span class="sos-txt"><strong>Lapor lewat WhatsApp</strong><span>Kirim alamat, lokasi, dan foto kejadian</span></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a class="sos-link" href="tel:{{ $no_telepon }}">
                    <span class="sos-ico"><i class="fas fa-phone-alt"></i></span>
                    <span class="sos-txt"><strong>Telepon Damkar</strong><span>{{ $telepon_tampil }}</span></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a class="sos-link" href="tel:112">
                    <span class="sos-ico"><i class="fas fa-headset"></i></span>
                    <span class="sos-txt"><strong>Call Center 112</strong><span>Layanan darurat terpadu</span></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="sos-prep">
                <p>Siapkan sebelum melapor:</p>
                <ul>
                    <li><i class="fas fa-check"></i> Nama dan nomor HP</li>
                    <li><i class="fas fa-check"></i> Alamat kejadian</li>
                    <li><i class="fas fa-check"></i> Lokasi Google Maps</li>
                    <li><i class="fas fa-check"></i> Foto atau video</li>
                </ul>
            </div>
        </aside>
    </div>

    @if(!empty($daftar_berita) && count($daftar_berita))
    <div class="ticker">
        <div class="ticker-label"><span class="beacon" aria-hidden="true"></span> Kejadian terbaru</div>
        <div class="ticker-track">
            <div class="ticker-run">
                @foreach([false, true] as $duplikat)
                <div class="ticker-group" @if($duplikat) aria-hidden="true" @endif>
                    @foreach($daftar_berita as $berita)
                        <a class="tick" href="/berita/{{ $berita->id }}" @if($duplikat) tabindex="-1" @endif>
                            <b>{{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }}</b>
                            {{ $berita->judul }}
                        </a>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</section>

<!-- ==================== TENTANG ==================== -->
<section class="section" id="tentang">
    <div class="wrap">
        <div class="about">
            <div class="about-art">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA">
            </div>
            <div class="about-copy">
                <div class="sec-head">
                    <div>
                        <h2>Tentang SIMERAH KOJA</h2>
                    </div>
                </div>
                <p>SIMERAH KOJA adalah Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi yang berbasis digitalisasi dalam rangka memberikan kemudahan pelayanan publik kepada masyarakat antara lain pelayanan pemadaman, penyelamatan, perizinan, edukasi dan pemeriksaan proteksi kebakaran.</p>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi untuk mendukung program Smart City Kota Jambi.</p>
            </div>
        </div>

        <figure class="quote">
            <blockquote>Pantang pulang sebelum padam, walaupun nyawa taruhannya... Pulang dengan selamat, pulang dengan cidera, pulang tinggal nama.</blockquote>
            <figcaption>Satria Biru Yudha Brama Jaya</figcaption>
        </figure>
    </div>
</section>

<!-- ==================== KEJADIAN & EVAKUASI ==================== -->
<section class="section bg-paper" id="kejadian">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Kejadian &amp; evakuasi</h2>
                <p>Informasi terbaru tentang kejadian di Kota Jambi.</p>
            </div>
            <img src="/images/mobil.png" alt="Mobil pemadam kebakaran" loading="lazy">
        </div>

        <div class="kj-grid">
            @forelse($daftar_berita ?? [] as $berita)
                @php
                    $tgl  = \Carbon\Carbon::parse($berita->tanggal_kejadian)->locale('id');
                    $baru = $tgl->diffInDays(now(), true) <= 3;
                @endphp
                <a href="/berita/{{ $berita->id }}" class="kj-card {{ $loop->first ? 'is-featured' : '' }}">
                    <div class="kj-thumb">
                        <div class="kj-date {{ $baru ? 'baru' : '' }}">
                            <b>{{ $tgl->format('d') }}</b>
                            <span>{{ $tgl->translatedFormat('M') }}</span>
                        </div>
                        @if($baru)<div class="kj-flag">Baru</div>@endif

                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" loading="lazy">
                        @else
                            <div class="kj-ph">
                                <i class="fas fa-fire-extinguisher"></i>
                                <span>Damkar Kota Jambi</span>
                            </div>
                        @endif
                    </div>
                    <div class="kj-body">
                        <h3>{{ $berita->judul }}</h3>
                        <div class="kj-meta">
                            <div title="Lokasi"><i class="fas fa-map-marker-alt"></i> <span>{{ Str::limit($berita->lokasi, 60) }}</span></div>
                            <div title="Waktu laporan"><i class="far fa-clock"></i> <span>{{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }} WIB, pelapor: {{ $berita->pelapor }}</span></div>
                        </div>
                        <p>{{ Str::limit($berita->keterangan_singkat ?? $berita->detail_lengkap, $loop->first ? 160 : 90) }}</p>
                        <span class="kj-more">Baca selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            @empty
                <div class="empty">
                    <i class="fas fa-folder-open"></i>
                    <h3>Belum ada informasi kejadian terbaru</h3>
                    <p>Laporan kejadian akan tampil di sini setelah petugas mengunggahnya.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ==================== VIDEO EDUKASI ==================== -->
<section class="section bg-ink" id="video">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Video edukasi</h2>
                <p>Tindakan praktis dan saran dari petugas untuk mencegah dan menghadapi kebakaran.</p>
            </div>
        </div>

        <div class="vid-grid">
            @foreach($video_edukasi as $v)
                <button class="vid" type="button" data-yt="{{ $v['yt'] }}" data-title="{{ $v['judul'] }}" @if(!$v['yt']) disabled @endif>
                    <div class="vid-thumb">
                        @if($v['yt'])
                            <img src="https://i.ytimg.com/vi/{{ $v['yt'] }}/hqdefault.jpg" alt="" loading="lazy">
                        @else
                            <span class="vid-soon">Segera hadir</span>
                        @endif
                        <div class="vid-play"><span><i class="fas fa-play"></i></span></div>
                    </div>
                    <h3 class="mt-2">{{ $v['judul'] }}</h3>
                </button>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== INFO GRAFIS & MEDIA INFORMASI ==================== -->
<section class="section" id="infografis">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Info grafis</h2>
                <p>Panduan singkat bergambar. Ketuk gambar untuk memperbesar.</p>
            </div>
        </div>

        <div class="grafis">
            @forelse($daftar_infografis ?? [] as $info)
                <button type="button" class="grafis-item"
                        data-lightbox
                        data-src="{{ asset('storage/' . $info->gambar) }}"
                        data-title="{{ $info->judul ?? 'Infografis' }}"
                        aria-label="Perbesar: {{ $info->judul ?? 'Infografis' }}">
                    <img src="{{ asset('storage/' . $info->gambar) }}" alt="{{ $info->judul ?? 'Infografis' }}" loading="lazy">
                    <span class="zoom"><i class="fas fa-search-plus"></i></span>
                </button>
            @empty
                <div class="empty" style="column-span: all;">
                    <i class="far fa-images"></i>
                    <h3>Belum ada infografis</h3>
                    <p>Infografis akan tampil di sini setelah diunggah.</p>
                </div>
            @endforelse
        </div>

        <!-- HEADER MEDIA INFORMASI + TOMBOL LIHAT LAINNYA -->
        <div class="sec-head sub-head" style="flex-wrap: wrap;">
            <div>
                <h2>Media informasi</h2>
                <p>Kabar terbaru dari media sosial Damkar Kota Jambi.</p>
            </div>
            <a href="/media-informasi" class="btn btn-outline">
                Lihat lainnya <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        @php
            $daftarMedsos    = collect($daftar_medsos ?? []);
        @endphp

        <!-- GRID BERITA (LEBIH KECIL, 4 KOLOM, BADGE MELAYANG DI ATAS FOTO) -->
        <div class="media-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            @forelse($daftarMedsos as $medsos)
                @php 
                    $namaKatCard = str_replace('Lainya', 'Lainnya', $medsos->kategori->nama_kategori ?? 'Informasi'); 
                    
                    $s = strtolower($medsos->sumber ?? '');
                    $ikonSumber = 'fas fa-share-nodes';
                    if (str_contains($s, 'instagram')) $ikonSumber = 'fab fa-instagram';
                    if (str_contains($s, 'youtube'))   $ikonSumber = 'fab fa-youtube';
                    if (str_contains($s, 'tiktok'))    $ikonSumber = 'fab fa-tiktok';
                    if (str_contains($s, 'facebook'))  $ikonSumber = 'fab fa-facebook-f';
                    if (str_contains($s, 'twitter'))   $ikonSumber = 'fab fa-twitter';
                @endphp
                
                <article class="media-card" style="display: flex; flex-direction: column; background: #fff; border-radius: var(--r-md); overflow: hidden; border: 1px solid var(--line); transition: transform .3s, box-shadow .3s;">
                    <div style="position: relative; background: var(--paper); aspect-ratio: 4 / 3; overflow: hidden;">
                        @if($medsos->kategori)
                            <span style="position: absolute; top: 12px; left: 12px; padding: 4px 12px; border-radius: 6px; font-size: .7rem; font-weight: 700; letter-spacing: .03em; text-transform: uppercase; background: rgba(255, 255, 255, 0.95); color: var(--signal-d); z-index: 2; box-shadow: 0 4px 10px rgba(0,0,0,0.08); backdrop-filter: blur(4px);">{{ $namaKatCard }}</span>
                        @endif
                        <img src="{{ asset('storage/' . $medsos->gambar) }}" alt="{{ $medsos->judul }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s;">
                    </div>
                    <div style="display: flex; flex-direction: column; flex: 1; padding: 18px 20px 20px;">
                        <h3 style="font-family: var(--font-display); font-weight: 700; font-stretch: 92%; font-size: 1.05rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 12px; transition: color 0.2s;">{{ $medsos->judul }}</h3>
                        <div style="margin-bottom: 16px; display: flex; flex-wrap: wrap; gap: 6px 14px; font-size: .8rem; color: var(--steel); font-weight: 500;">
                            <span style="display: flex; align-items: center; gap: 6px;"><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($medsos->tanggal)->locale('id')->translatedFormat('d M Y, H:i') }}</span>
                            <span style="display: flex; align-items: center; gap: 6px;"><i class="{{ $ikonSumber }}" style="color: {{ str_contains($s, 'youtube') ? '#ff0000' : (str_contains($s, 'instagram') ? '#d6249f' : 'inherit') }}"></i>{{ $medsos->sumber }}</span>
                        </div>
                        <a href="{{ $medsos->link ?? '#' }}" target="_blank" rel="noopener" style="margin-top: auto; font-weight: 700; font-size: .88rem; color: var(--signal-d); display: inline-flex; gap: 6px; align-items: center; transition: gap 0.2s;">Selengkapnya <i class="fas fa-angle-right"></i></a>
                    </div>
                </article>
            @empty
                <div class="empty" style="grid-column: 1 / -1; text-align: center; padding: 64px 24px; border: 1.5px dashed var(--line); border-radius: var(--r-md); color: var(--steel); background: #fff;">
                    <i class="far fa-newspaper" style="font-size: 3rem; color: var(--line); margin-bottom: 12px;"></i>
                    <h3>Belum ada berita media sosial</h3>
                    <p>Unggahan terbaru akan tampil di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ==================== GIAT DISDAMKARTAN ==================== -->
<section class="section bg-paper" id="giat">
    <div class="wrap">
        <div class="giat">
            <div class="giat-art">
                <img src="/images/damkar.png" alt="Petugas damkar" loading="lazy">
            </div>

            <div>
                <div class="sec-head">
                    <div>
                        <h2>Giat Disdamkartan Kota Jambi</h2>
                    </div>
                </div>

                <div class="timeline">
                    <article class="tl-item">
                        <time>13 Jul</time>
                        <h3>Bapak Walikota Jambi memberikan bantuan kepada korban kebakaran dan bencana alam</h3>
                        <p>Pada hari Kamis tanggal 07 Juli 2022 pukul 15.30 WIB sampai dengan selesai di Dinas Pemadam Kebakaran Kota Jambi. Bapak Walikota Jambi didampingi Kepala Disdamkar.</p>
                        <a href="#">Selengkapnya <i class="fas fa-angle-right"></i></a>
                    </article>

                    <article class="tl-item">
                        <time>9 Nov</time>
                        <h3>Peningkatan kapasitas aparatur Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</h3>
                        <p>Kegiatan peningkatan kapasitas aparatur dengan materi penyelamatan beda ketinggian dan evakuasi korban.</p>
                        <a href="#">Selengkapnya <i class="fas fa-angle-right"></i></a>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

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

<!-- ==================== DIALOG ==================== -->
<dialog id="lightbox">
    <button type="button" class="dlg-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
    <img src="" alt="">
    <p></p>
</dialog>

<dialog id="videoDialog">
    <button type="button" class="dlg-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
    <div class="video-frame">
        <iframe src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</dialog>

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

    /* ---------- Dialog Lightbox Infografis ---------- */
    var lightbox = document.getElementById('lightbox');
    var lbImg = lightbox.querySelector('img');
    var lbTxt = lightbox.querySelector('p');

    document.querySelectorAll('[data-lightbox]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            lbImg.src = btn.getAttribute('data-src');
            lbImg.alt = btn.getAttribute('data-title');
            lbTxt.textContent = btn.getAttribute('data-title');
            lightbox.showModal();
        });
    });

    lightbox.querySelector('.dlg-close').addEventListener('click', function () { lightbox.close(); });
    lightbox.addEventListener('click', function (e) { if (e.target === lightbox) lightbox.close(); });

    /* ---------- Dialog Video Edukasi ---------- */
    var vDialog = document.getElementById('videoDialog');
    var vFrame = vDialog.querySelector('iframe');

    document.querySelectorAll('.vid:not([disabled])').forEach(function (v) {
        v.addEventListener('click', function () {
            var yt = v.getAttribute('data-yt');
            vFrame.src = 'https://www.youtube-nocookie.com/embed/' + yt + '?autoplay=1';
            vDialog.showModal();
        });
    });

    /* ---------- Filter kategori media informasi ---------- */
    var mediaFilter = document.querySelector('.media-filter');
    if (mediaFilter) {
        var mediaCards = document.querySelectorAll('[data-media-grid] .media-card');
        var mediaEmpty = document.querySelector('[data-media-empty]');

        mediaFilter.addEventListener('click', function (e) {
            var btn = e.target.closest('.pill');
            if (!btn) return;

            mediaFilter.querySelectorAll('.pill').forEach(function (p) {
                p.classList.remove('is-active');
                p.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('is-active');
            btn.setAttribute('aria-selected', 'true');

            var filter = btn.dataset.filter;
            var visible = 0;
            mediaCards.forEach(function (c) {
                var show = filter === 'all' || c.dataset.kategori === filter;
                c.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            if (mediaEmpty) mediaEmpty.hidden = visible !== 0;
        });
    }
})();
</script>
</body>
</html>