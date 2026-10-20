@php
    // Data bawaan untuk footer dan tombol darurat
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
    $play_store_url = "";

    // Seluruh pertanyaan survei didefinisikan di App\Models\IkmResponse (dipakai form, validasi, dan hitung IKM)
    $aspek_unsur      = \App\Models\IkmResponse::unsur();
    $aspek_integritas = \App\Models\IkmResponse::integritas();
    $skala_jawaban    = \App\Models\IkmResponse::SKALA;       // [1 => 'Sangat tidak setuju', ... 4 => 'Sangat setuju']
    $opsi_pendidikan  = \App\Models\IkmResponse::PENDIDIKAN;
    $opsi_pekerjaan   = \App\Models\IkmResponse::PEKERJAAN;
    $kepercayaan      = \App\Models\IkmResponse::KEPERCAYAAN;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Indeks Kepuasan Masyarakat (IKM) Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi. Lihat hasil survei dan sampaikan penilaian Anda.">
    <title>Indeks Kepuasan Masyarakat - Galeri | SIMERAH KOJA</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{
            --ink:#0b1826;
            --ink-2:#10283e;
            --ink-3:#183b5a;
            --paper:#f4f6f9;
            --white:#fff;
            --signal:#e5392d;
            --signal-dark:#bd241c;
            --amber:#ffb627;
            --steel:#657487;
            --line:#e0e6ed;
            --soft:#eef2f6;
            --display:'Bricolage Grotesque',system-ui,sans-serif;
            --body:'Instrument Sans',system-ui,sans-serif;
            --wrap:1180px;
            --header-h:64px;
            --nav-wrap:1300px;
            --signal-d:#c22b20;
            --font-display:var(--display);
            --font-body:var(--body);
            --r-lg:28px;
            --r-md:18px;
            --r-sm:10px;
            --shadow:0 18px 45px rgba(13,27,42,.09);
        }

        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{
            font-family:var(--body);
            color:var(--ink);
            background:var(--paper);
            line-height:1.6;
            -webkit-font-smoothing:antialiased;
            overflow-x:hidden;
        }
        body:has(dialog[open]){overflow:hidden}
        img{max-width:100%;display:block}
        a{color:inherit;text-decoration:none}
        ul,ol{list-style:none}
        button{font:inherit;color:inherit;background:none;border:0;cursor:pointer;text-align:left}
        :focus-visible{outline:3px solid var(--amber);outline-offset:3px;border-radius:7px}
        .wrap{width:min(var(--wrap),calc(100% - 40px));margin:auto}

/* ==========================================================
           HEADER & NAVBAR
           Susunan: [Logo] ····· [Menu] ····· [Lapor darurat] [Masuk]
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

        /* ---------- Logo ---------- */
        .brand { display: flex; align-items: center; flex: none; }
        .brand a { display: flex; align-items: center; }
        .brand a + a { margin-left: 14px; padding-left: 14px; border-left: 1px solid rgba(255,255,255,.16); }
        .brand img { height: 36px; width: auto; }

        /* ---------- Panel (desktop: sebaris | mobile: laci) ---------- */
        .nav-panel { flex: 1; min-width: 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; }

        /* ---------- Menu utama ---------- */
        .menu { display: flex; align-items: center; justify-content: center; gap: 2px; flex: 1; min-width: 0; }
        .menu > li { position: relative; }

        .menu-link, .menu-trigger {
            position: relative; display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 11px; color: rgba(255,255,255,.78);
            font-size: .875rem; font-weight: 500; letter-spacing: .005em; white-space: nowrap;
            transition: color .2s;
        }
        /* garis penanda: hover, dropdown terbuka, halaman aktif */
        .menu-link::after, .menu-trigger::after {
            content: ""; position: absolute; left: 11px; right: 11px; bottom: 2px; height: 2px;
            border-radius: 2px; background: var(--amber);
            transform: scaleX(0); transform-origin: left; transition: transform .25s ease;
        }
        .menu-link:hover, .menu-trigger:hover, .has-drop.open > .menu-trigger, .menu-link.is-active { color: #fff; }
        .menu-link:hover::after, .menu-trigger:hover::after, .has-drop.open > .menu-trigger::after, .menu-link.is-active::after { transform: scaleX(1); }

        .menu-trigger i { font-size: .6rem; opacity: .6; transition: transform .2s, opacity .2s; }
        .has-drop.open > .menu-trigger i { transform: rotate(180deg); opacity: 1; }

        /* ---------- Tombol kanan (CTA) ---------- */
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

        /* ---------- Dropdown ---------- */
        .dropdown {
            position: absolute; top: calc(100% + 14px); left: 50%; min-width: 250px; width: max-content; max-width: 320px;
            background: var(--ink-2); border: 1px solid rgba(255,255,255,.1);
            border-radius: 16px; padding: 8px; box-shadow: 0 24px 48px rgba(0,0,0,.45);
            visibility: hidden; opacity: 0; pointer-events: none;
            transform: translate(-50%, 6px);
            transition: opacity .18s ease, transform .18s ease, visibility 0s linear .18s;
        }
        /* dropdown tombol kanan rata ke tepi kanan */
        .nav-actions .dropdown { left: auto; right: 0; transform: translate(0, 6px); }
        /* jembatan hover supaya dropdown tidak menutup saat kursor turun */
        .dropdown::before { content: ""; position: absolute; left: 0; right: 0; top: -14px; height: 14px; }
        /* segitiga kecil penunjuk */
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

        /* ---------- Sub-menu (Galeri > Berita) ---------- */
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

        /* ---------- Desktop dengan mouse: buka saat hover ---------- */
        @media (hover: hover) and (min-width: 1201px) {
            .has-drop:hover > .dropdown { visibility: visible; opacity: 1; pointer-events: auto; transform: translate(-50%, 0); transition-delay: 0s; }
            .nav-actions .has-drop:hover > .dropdown { transform: translate(0, 0); }
            .has-drop:hover > .menu-trigger { color: #fff; }
            .has-drop:hover > .menu-trigger::after { transform: scaleX(1); }
            .has-sub:hover > .dropdown-sub { display: block; }
            .has-sub:hover > .sub-trigger { background: rgba(255,255,255,.08); color: #fff; }

            /* Galeri ada di kanan, jadi sub-menu dibuka ke kiri */
            .dropdown-sub { left: auto; right: 100%; margin-left: 0; margin-right: 6px; }
            .dropdown-sub::before { left: auto; right: -12px; }
            .has-sub > .sub-trigger i { transform: rotate(180deg); }
        }

        /* ---------- Tablet & HP: menu jadi laci ---------- */
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

        body.nav-lock { overflow: hidden; }

        /* Penanda halaman aktif */
        .menu > li.current > .menu-trigger { color: #fff; }
        .menu > li.current > .menu-trigger::after { transform: scaleX(1); }
        .dropdown a[aria-current="page"] { background: rgba(255,255,255,.09); color: #fff; font-weight: 600; }


        /* ================= HERO ================= */
        .page-hero{
            position:relative;isolation:isolate;overflow:hidden;color:#fff;
            padding:54px 0 88px;
            background:#0b1826;
        }
        .page-hero::before{
            content:"";position:absolute;inset:0;z-index:-2;
            background:
                linear-gradient(105deg,rgba(7,20,33,.97) 0%,rgba(8,24,39,.88) 45%,rgba(8,24,39,.62) 100%),
                url('/images/background1.png') center/cover no-repeat;
        }
        .page-hero::after{
            content:"";position:absolute;z-index:-1;inset:auto -10% -50% -10%;height:280px;
            background:radial-gradient(ellipse at center,rgba(229,57,45,.38),transparent 66%);
            pointer-events:none;
        }
        .crumbs{
            display:flex;flex-wrap:wrap;align-items:center;gap:9px;
            color:rgba(255,255,255,.66);font-size:.83rem;margin-bottom:24px
        }
        .crumbs li{display:inline-flex;align-items:center;gap:9px}
        .crumbs li+li::before{content:"/";opacity:.38}
        .crumbs a:hover{color:#fff}
        .crumbs [aria-current=page]{color:#fff;font-weight:700}

        .hero-kicker{
            display:inline-flex;align-items:center;gap:9px;
            padding:7px 11px;border:1px solid rgba(255,255,255,.14);
            border-radius:999px;background:rgba(255,255,255,.07);
            color:rgba(255,255,255,.82);font-size:.74rem;font-weight:700;
            text-transform:uppercase;letter-spacing:.08em;margin-bottom:16px
        }
        .hero-kicker i{color:#ff5a4d}
        .page-hero h1{
            font-family:var(--display);font-weight:800;
            font-size:clamp(3rem,7vw,5.8rem);line-height:.91;
            letter-spacing:-.055em;max-width:760px
        }
        .page-hero p{
            margin-top:18px;max-width:570px;
            color:rgba(255,255,255,.72);
            font-size:clamp(.98rem,1.4vw,1.1rem)
        }
        .hero-line{
            width:70px;height:4px;border-radius:99px;
            margin-top:25px;background:var(--signal)
        }

        .rise{animation:rise .75s cubic-bezier(.16,.84,.3,1) both}
        .rise.d1{animation-delay:.08s}.rise.d2{animation-delay:.16s}.rise.d3{animation-delay:.24s}
        @keyframes rise{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}

        /* ================= SUB NAVIGATION (PILL MENU) ================= */
        .page-nav-wrap {
            display: flex;
            justify-content: center;
            margin-top: -30px;
            position: relative;
            z-index: 10;
            padding: 0 20px;
        }
        .page-nav {
            display: inline-flex;
            align-items: center;
            background: #fff;
            padding: 6px;
            border-radius: 999px;
            box-shadow: 0 12px 35px rgba(13,27,42,0.1);
            gap: 4px;
            overflow-x: auto;
            max-width: 100%;
            border: 1px solid rgba(0,0,0,0.04);
        }
        .page-nav::-webkit-scrollbar { display: none; }
        .page-nav { -ms-overflow-style: none; scrollbar-width: none; }

        .page-nav a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--steel);
            white-space: nowrap;
            transition: 0.3s ease;
        }
        .page-nav a i { font-size: 1.05rem; }
        .page-nav a:hover { color: var(--ink-2); background: var(--soft); }
        .page-nav a.active { background: var(--ink); color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .page-nav a.active i { color: var(--amber); }

        /* ================= CONTENT ================= */
        .page-body{background:var(--paper);min-height:50vh;padding-bottom:95px}

        .content-head{
            display:flex;align-items:end;justify-content:space-between;gap:20px;
            margin:48px 0 22px
        }
        .content-head h2{
            font-family:var(--display);font-size:clamp(1.65rem,3vw,2.2rem);
            line-height:1.05;letter-spacing:-.035em
        }
        .content-head p{margin-top:6px;color:var(--steel);font-size:.9rem}

        /* ================= 4-COLUMN VIDEO GRID ================= */
        .media-grid{
            display:grid;
            grid-template-columns:repeat(4,minmax(0,1fr));
            gap:22px;
        }
        .media-card{
            position:relative;display:flex;flex-direction:column;
            width:100%;min-width:0;background:#fff;border:1px solid var(--line);
            border-radius:22px;overflow:hidden;
            box-shadow:0 7px 24px rgba(13,27,42,.055);
            transition:transform .35s cubic-bezier(.2,.75,.25,1),box-shadow .35s,border-color .35s
        }
        .media-card:hover{
            transform:translateY(-8px);
            box-shadow:0 24px 55px rgba(13,27,42,.14);
            border-color:rgba(229,57,45,.25)
        }
        .media-thumb{
            position:relative;aspect-ratio:16/10;
            overflow:hidden;background:#dfe5eb;width:100%
        }
        .media-thumb::after{
            content:"";position:absolute;inset:0;
            background:linear-gradient(180deg,rgba(0,0,0,.02) 40%,rgba(0,0,0,.56) 100%);
            pointer-events:none;transition:opacity .3s
        }
        .media-card:hover .media-thumb::after{opacity:.75}
        .media-thumb img{
            width:100%;height:100%;object-fit:cover;
            transition:transform .65s cubic-bezier(.2,.7,.2,1),filter .35s
        }
        .media-card:hover .media-thumb img{transform:scale(1.065);filter:saturate(1.06)}

        .media-tag{
            position:absolute;z-index:3;top:12px;left:12px;
            max-width:calc(100% - 24px);
            padding:5px 10px;border-radius:8px;
            background:rgba(255,255,255,.95);color:var(--signal-dark);
            font-size:.63rem;font-weight:800;letter-spacing:.045em;
            text-transform:uppercase;box-shadow:0 5px 14px rgba(0,0,0,.13);
            backdrop-filter:blur(6px)
        }
        .media-source{
            position:absolute;z-index:3;right:12px;top:12px;
            width:32px;height:32px;border-radius:50%;
            display:grid;place-items:center;
            color:#fff;background:rgba(7,20,33,.68);
            border:1px solid rgba(255,255,255,.2);
            backdrop-filter:blur(8px);font-size:.8rem
        }
        .media-source .fa-youtube{color:#ff3838}

        .photo-play{
            position:absolute;z-index:3;left:50%;top:50%;
            transform:translate(-50%,-45%) scale(.94);
            width:50px;height:50px;border-radius:50%;
            display:grid;place-items:center;
            color:#fff;background:rgba(229,57,45,.94);
            box-shadow:0 10px 25px rgba(0,0,0,.32);
            opacity:.92;transition:.3s ease
        }
        .photo-play i{margin-left:2px}
        .media-card:hover .photo-play{
            opacity:1;transform:translate(-50%,-50%) scale(1.08);
            background:var(--signal)
        }

        .media-body{padding:16px 17px 16px;display:flex;flex-direction:column;flex:1;width:100%}
        .media-body h3{
            font-family:var(--display);font-weight:750;font-size:1rem;
            line-height:1.32;letter-spacing:-.018em;
            display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
            overflow:hidden;min-height:2.64em;margin-bottom:10px;
            transition:color .2s
        }
        .media-card:hover h3{color:var(--signal-dark)}
        .media-meta{
            display:flex;align-items:center;flex-wrap:wrap;gap:6px 12px;
            color:var(--steel);font-size:.74rem;font-weight:600;margin-bottom:14px
        }
        .media-meta span{display:inline-flex;align-items:center;gap:5px}
        .media-meta i{font-size:.7rem}
        .media-meta .fa-youtube{color:#f00}

        .media-link{
            margin-top:auto;display:flex;align-items:center;justify-content:space-between;
            padding-top:12px;border-top:1px solid var(--soft);
            color:var(--ink);font-size:.8rem;font-weight:800;width:100%
        }
        .media-link i{
            width:28px;height:28px;border-radius:50%;
            display:grid;place-items:center;
            background:var(--soft);color:var(--ink);transition:.25s;font-size:.75rem
        }
        .media-card:hover .media-link{color:var(--signal-dark)}
        .media-card:hover .media-link i{background:var(--signal);color:#fff;transform:translateX(3px)}

        .empty-filter{
            grid-column:1/-1;text-align:center;padding:72px 24px;
            border:1.5px dashed var(--line);background:#fff;border-radius:22px;color:var(--steel)
        }
        .empty-filter i{font-size:2.8rem;color:#c8d1db;margin-bottom:12px}
        .empty-filter h2{font-family:var(--display);color:var(--ink);margin-bottom:5px}

        /* ================= IKM ================= */
        .ikm-page .content-head{margin-top:48px}
        .ikm-page .content-head:first-child{margin-top:48px}
        .year-pills{display:inline-flex;gap:4px;padding:5px;background:#fff;border:1px solid var(--line);border-radius:999px}
        .year-pills a{padding:7px 16px;border-radius:999px;font-size:.84rem;font-weight:700;color:var(--steel);transition:.2s}
        .year-pills a:hover{background:var(--soft);color:var(--ink)}
        .year-pills a[aria-current=page]{background:var(--ink);color:#fff}

        .ikm-summary{display:grid;grid-template-columns:minmax(0,.8fr) minmax(0,1.2fr);gap:22px;align-items:stretch}
        .ikm-score,.ikm-bars{background:#fff;border:1px solid var(--line);border-radius:22px;box-shadow:0 7px 24px rgba(13,27,42,.055)}
        .ikm-score{display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;gap:6px;padding:34px 24px}
        .ikm-label{font-size:.8rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--steel)}
        .ikm-num{font-family:var(--display);font-weight:800;font-size:clamp(3.4rem,8vw,5rem);line-height:1;letter-spacing:-.04em}
        .ikm-none{font-family:var(--display);font-size:1.5rem}
        .ikm-empty-ico{font-size:2.6rem;color:#c8d1db;margin-bottom:6px}
       .ikm-resp{
    display:inline-flex;
    align-items:center;
    gap:10px;
    margin-top:8px;
    color:#000;
    font-size:1.3rem;
    font-weight:800;
    text-shadow:0 2px 6px rgba(0,0,0,0.22);
}
.ikm-resp i{
    font-size:1.35rem;
    color:#000;
}
        .ikm-mutu{margin-top:6px;padding:7px 16px;border-radius:999px;font-size:.84rem;font-weight:800;color:#fff}
        .mutu-a{background:#1f9d5c}.mutu-b{background:#2f7fd1}.mutu-c{background:#e59a12}.mutu-d{background:var(--signal)}
        .mutu-legend{margin-top:20px;padding-top:18px;border-top:1px solid var(--soft);width:100%;display:grid;gap:7px;text-align:left;font-size:.8rem;color:var(--steel)}
        .mutu-legend li{display:flex;align-items:center;gap:10px}
        .mutu-legend b{display:grid;place-items:center;width:22px;height:22px;border-radius:7px;color:#fff;font-size:.75rem}

        .ikm-bars{padding:28px}
        .ikm-bars h3{font-family:var(--display);font-size:1.15rem;letter-spacing:-.02em;margin-bottom:18px}
        .ikm-bars h3 small{font-family:var(--body);font-weight:600;font-size:.76rem;color:var(--steel);margin-left:6px}
        .bar-row+.bar-row{margin-top:14px}
        .bar-top{display:flex;justify-content:space-between;gap:14px;font-size:.88rem;margin-bottom:6px}
        .bar-top span{color:var(--ink-2);font-weight:600}
        .bar-top b{font-variant-numeric:tabular-nums}
        .bar-track{height:9px;border-radius:99px;background:var(--soft);overflow:hidden}
        .bar-track i{display:block;height:100%;border-radius:99px;background:linear-gradient(90deg,var(--amber),var(--signal));transition:width .8s cubic-bezier(.2,.75,.25,1)}

        /* Kartu ajakan isi survei (tautan resmi SKM) */
        .survey-cta{
            display:grid;grid-template-columns:auto minmax(0,1fr) auto;align-items:center;gap:clamp(18px,3vw,32px);
            padding:clamp(22px,4vw,38px);border-radius:22px;color:#fff;position:relative;overflow:hidden;
            background:radial-gradient(70% 140% at 100% 0%,rgba(229,57,45,.35),transparent 60%),linear-gradient(120deg,var(--ink),var(--ink-3));
            box-shadow:0 18px 45px rgba(13,27,42,.18)
        }
        .survey-cta-ico{width:68px;height:68px;border-radius:20px;display:grid;place-items:center;font-size:1.7rem;color:var(--amber);background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.14)}
        .survey-cta h3{font-family:var(--display);font-size:clamp(1.3rem,2.6vw,1.8rem);line-height:1.15;letter-spacing:-.03em}
        .survey-cta p{margin-top:8px;max-width:58ch;color:rgba(255,255,255,.74);font-size:.96rem}
        .survey-cta-points{margin-top:14px;display:flex;flex-wrap:wrap;gap:8px 20px;font-size:.86rem;color:rgba(255,255,255,.86)}
        .survey-cta-points li{display:inline-flex;align-items:center;gap:8px}
        .survey-cta-points i{color:var(--amber);font-size:.75rem}
        .btn-send{
            display:inline-flex;align-items:center;justify-content:center;gap:10px;white-space:nowrap;
            padding:15px 28px;border-radius:999px;background:var(--signal);color:#fff;
            font-weight:800;font-size:.95rem;box-shadow:0 12px 26px -8px rgba(229,57,45,.6);transition:.2s
        }
        .btn-send:hover{background:var(--signal-d);transform:translateY(-2px)}
        .hero-actions{margin-top:26px}

        @media (max-width:820px){
            .survey-cta{grid-template-columns:1fr;text-align:left}
            .survey-cta .btn-send{justify-self:stretch}
        }
        /* Aspek yang dinilai (sesuai form SKM) */
        .aspek-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
        .aspek-card{display:flex;gap:14px;padding:20px;background:#fff;border:1px solid var(--line);border-radius:20px;box-shadow:0 7px 24px rgba(13,27,42,.055);transition:transform .3s,border-color .3s,box-shadow .3s}
        .aspek-card:hover{transform:translateY(-4px);border-color:rgba(229,57,45,.25);box-shadow:0 18px 40px rgba(13,27,42,.1)}
        .aspek-no{flex:none;width:38px;height:38px;border-radius:12px;display:grid;place-items:center;background:var(--ink);color:#fff;font-family:var(--display);font-weight:800;font-size:.95rem}
        .aspek-no.int{background:rgba(229,57,45,.1);color:var(--signal-d);font-size:1rem}
        .aspek-card h3{font-family:var(--display);font-size:1.02rem;line-height:1.25;letter-spacing:-.02em;margin-bottom:8px}
        .aspek-card ul{display:grid;gap:6px}
        .aspek-card li{position:relative;padding-left:14px;font-size:.86rem;line-height:1.5;color:var(--steel)}
        .aspek-card li::before{content:"";position:absolute;left:0;top:.62em;width:6px;height:6px;border-radius:50%;background:var(--amber)}
        .aspek-card p{font-size:.86rem;line-height:1.5;color:var(--steel)}
        .skala{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-top:26px;padding:16px 20px;background:#fff;border:1px solid var(--line);border-radius:18px}
        .skala>span{font-size:.84rem;font-weight:800;margin-right:4px}
        .skala b{display:inline-flex;align-items:center;gap:8px;padding:7px 14px;border-radius:999px;background:var(--paper);font-size:.82rem;font-weight:700;color:var(--ink-2)}
        .skala b i{font-style:normal;display:grid;place-items:center;width:20px;height:20px;border-radius:50%;background:var(--ink);color:#fff;font-size:.7rem}
        .survey-cta-title{display:block;margin-bottom:8px;font-size:.72rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--amber)}
        @media (max-width:991px){.aspek-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media (max-width:600px){.aspek-grid{grid-template-columns:1fr}}

        @media (max-width:900px){.ikm-summary{grid-template-columns:1fr}}

        /* ================= MODAL DIALOG (YOUTUBE) ================= */
        dialog{
            border:0;padding:0;background:transparent;
            width:min(960px,94vw);margin:auto;overflow:visible
        }
        dialog::backdrop{
            background:rgba(7,14,24,.86);
            backdrop-filter:blur(6px);
            -webkit-backdrop-filter:blur(6px)
        }
        .dlg-close{
            position:absolute;top:-52px;right:0;
            width:42px;height:42px;border-radius:50%;
            background:#fff;color:var(--ink);font-size:1.05rem;
            display:grid;place-items:center;
            box-shadow:0 8px 22px rgba(0,0,0,.3);transition:.2s
        }
        .dlg-close:hover{background:var(--signal);color:#fff;transform:scale(1.06)}
        .video-frame{
            aspect-ratio:16/9;border-radius:20px;
            overflow:hidden;background:#000;
            box-shadow:0 25px 60px rgba(0,0,0,.5);
            display:grid;place-items:center
        }
        .video-frame iframe{width:100%;height:100%;border:0}

/* ==========================================================
           FOOTER
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

        /* ================= SOS ================= */
        .beacon{position:relative;width:10px;height:10px;border-radius:50%;background:#fff;flex:none}
        .beacon::after{content:"";position:absolute;inset:0;border-radius:50%;background:#fff;animation:ping 1.8s cubic-bezier(0,0,.2,1) infinite}
        @keyframes ping{0%{transform:scale(1);opacity:.7}100%{transform:scale(3.2);opacity:0}}
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

        /* ================= RESPONSIVE ================= */
        @media (max-width:1100px){
            .media-grid{grid-template-columns:repeat(3,minmax(0,1fr))}
        }
        @media (max-width:991px){
            .page-hero{padding:43px 0 78px}
            .media-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
        }
        @media (max-width:768px){
            .page-nav { justify-content: flex-start; padding: 6px 12px; }
            .page-nav a { padding: 8px 16px; font-size: 0.85rem; }
        }
        @media (max-width:700px){
            .wrap{width:min(calc(100% - 28px),1180px)}
            .page-hero h1{font-size:clamp(2.8rem,15vw,4.5rem)}
        }
        @media (max-width:520px){
            .media-grid{grid-template-columns:1fr}
        }
        @media (max-width:390px){
            .media-body{padding:16px}
            .media-thumb{aspect-ratio:16/10}
        }

        /* ================= FORM SURVEI (DALAM HALAMAN) ================= */
        .ikm-form{scroll-margin-top:90px;background:#fff;border:1px solid var(--line);border-radius:22px;box-shadow:0 7px 24px rgba(13,27,42,.055);overflow:hidden}
        .ikm-form[hidden], .survey-done[hidden]{display:none !important}
        .hp{position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden}
        .form-progress{padding:20px 28px 18px;border-bottom:1px solid var(--soft);background:var(--paper)}
        .form-progress-top{display:flex;justify-content:space-between;align-items:baseline;gap:12px;flex-wrap:wrap;font-size:.82rem;font-weight:700;color:var(--steel)}
        .form-progress-top strong{color:var(--ink);font-family:var(--display);font-size:1.1rem;letter-spacing:-.02em}
        .form-bar{height:6px;border-radius:99px;background:var(--line);margin-top:12px;overflow:hidden}
        .form-bar i{display:block;height:100%;width:0;border-radius:99px;background:linear-gradient(90deg,var(--amber),var(--signal));transition:width .4s cubic-bezier(.2,.75,.25,1)}
        .form-alert{margin:20px 28px 0;padding:12px 16px;border-radius:12px;background:#fdecea;color:var(--signal-dark);font-size:.88rem;font-weight:600;display:flex;gap:10px;align-items:center}
        .step{border:0;min-width:0;padding:10px 28px 6px}
        .step[hidden]{display:none}
        .q{padding:18px 0;border-bottom:1px solid var(--soft)}
        .q:last-child{border-bottom:0}
        .lbl{display:block;font-weight:700;font-size:.95rem;line-height:1.45;margin-bottom:12px;color:var(--ink)}
        .req{color:var(--signal)}
        .field{width:100%;padding:12px 14px;border:1.5px solid var(--line);border-radius:12px;background:#fff;font:inherit;font-size:.95rem;color:var(--ink);transition:border-color .2s,box-shadow .2s}
        .field:focus{outline:none;border-color:var(--ink-3);box-shadow:0 0 0 4px rgba(24,59,90,.1)}
        textarea.field{resize:vertical;min-height:110px}
        .opts{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px}
        .opt{position:relative;cursor:pointer}
        .opt input,.num input{position:absolute;opacity:0;inset:0;width:100%;height:100%;cursor:pointer;margin:0}
        .opt span{display:flex;align-items:center;justify-content:center;text-align:center;min-height:52px;padding:10px 12px;border:1.5px solid var(--line);border-radius:14px;background:var(--paper);font-size:.88rem;font-weight:700;color:var(--ink-2);transition:.2s}
        .opt:hover span{border-color:var(--ink-3);background:#fff}
        .opt input:checked + span{background:var(--ink);border-color:var(--ink);color:#fff;box-shadow:0 8px 18px -8px rgba(13,27,42,.55)}
        .opt input:focus-visible + span,.num input:focus-visible + span{outline:3px solid var(--amber);outline-offset:2px}
        .opts-num{display:grid;grid-template-columns:repeat(10,minmax(0,1fr));gap:6px}
        .num{position:relative;cursor:pointer}
        .num span{display:grid;place-items:center;height:44px;border:1.5px solid var(--line);border-radius:12px;background:var(--paper);font-weight:800;font-size:.9rem;transition:.2s}
        .num:hover span{border-color:var(--ink-3);background:#fff}
        .num input:checked + span{background:var(--signal);border-color:var(--signal);color:#fff}
        .switch{display:flex;align-items:center;gap:12px;cursor:pointer;font-size:.92rem;font-weight:600}
        .switch input{position:absolute;opacity:0}
        .switch i{position:relative;flex:none;width:44px;height:26px;border-radius:99px;background:var(--line);transition:.2s}
        .switch i::after{content:"";position:absolute;top:3px;left:3px;width:20px;height:20px;border-radius:50%;background:#fff;box-shadow:0 2px 5px rgba(0,0,0,.2);transition:.2s}
        .switch input:checked + i{background:var(--ink)}
        .switch input:checked + i::after{transform:translateX(18px)}
        .switch input:focus-visible + i{outline:3px solid var(--amber);outline-offset:2px}
        .err{display:none;margin-top:8px;color:var(--signal-dark);font-size:.8rem;font-weight:700}
        .q-err .err{display:block}
        .q-err .field{border-color:var(--signal)}
        .q-err .opt span,.q-err .num span{border-color:rgba(229,57,45,.5)}
        .form-nav{display:flex;justify-content:center;gap:12px;flex-wrap:wrap;padding:22px 28px 28px;border-top:1px solid var(--soft);background:var(--paper)}
        .form-nav [hidden]{display:none}
        .btn-ghost{display:inline-flex;align-items:center;gap:10px;padding:15px 24px;border-radius:999px;background:#fff;border:1px solid var(--line);font-weight:800;font-size:.95rem;color:var(--ink);transition:.2s}
        .btn-ghost:hover{background:var(--soft)}
        .survey-done{text-align:center;padding:clamp(34px,6vw,60px) 24px;background:#fff;border:1px solid var(--line);border-radius:22px;box-shadow:0 7px 24px rgba(13,27,42,.055)}
        .survey-done-ico{font-size:3.2rem;color:#1f9d5c}
        .survey-done h3{font-family:var(--display);font-size:clamp(1.3rem,2.6vw,1.8rem);letter-spacing:-.03em;margin:10px 0 8px}
        .survey-done p{max-width:52ch;margin:0 auto 22px;color:var(--steel)}
        @media (max-width:760px){
            .opts{grid-template-columns:repeat(2,minmax(0,1fr))}
            .opts-num{grid-template-columns:repeat(5,minmax(0,1fr))}
            .step,.form-progress,.form-nav{padding-left:18px;padding-right:18px}
            .form-alert{margin-left:18px;margin-right:18px}
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
            <a href="/login" title="Login Internal Pegawai">
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

                <li class="has-drop">
                    <button class="menu-trigger" type="button" aria-expanded="false">Sarpras <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="{{ route('sarpras.sarana') }}">Sarana</a></li>
                        <li><a href="{{ route('sarpras.prasarana') }}">Prasarana</a></li>
                    </ul>
                </li>

                <li class="has-drop current">
                    <button class="menu-trigger" type="button" aria-expanded="false">Galeri <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/ikm" aria-current="page">IKM (Indeks Kepuasan Masyarakat)</a></li>
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
                <li><a href="#">Galeri</a></li>
                <li><span aria-current="page">Indeks Kepuasan Masyarakat</span></li>
            </ol>
        </nav>
        <div class="hero-kicker rise"><i class="fas fa-face-smile"></i> Survei Pelayanan Publik</div>
        <h1 class="rise d1">Indeks Kepuasan Masyarakat</h1>
        <p class="rise d2">Penilaian Anda terhadap pelayanan Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi membantu kami terus berbenah.</p>
        <div class="hero-line rise d3"></div>
        <div class="hero-actions rise d3">
            <a class="btn-send" href="#survei" id="btnHeroSurvei"><i class="fas fa-pen-to-square"></i> Isi survei sekarang</a>
        </div>
    </div>
</section>

<!-- ==================== BODY & KONTEN ==================== -->
<div class="page-body ikm-page">
    <div class="wrap">

        <!-- ===== HASIL SURVEI ===== -->
        <div class="content-head" id="hasil">
            <div>
                <h2>Hasil survei kepuasan</h2>
                <p>Periode tahun {{ $tahun }}. Nilai dihitung dari 9 unsur pelayanan menurut Permenpan RB No. 14 Tahun 2017.</p>
            </div>
            @if(count($daftar_tahun) > 1)
                <nav class="year-pills" aria-label="Pilih tahun">
                    @foreach($daftar_tahun as $th)
                        <a href="{{ route('ikm.index', ['tahun' => $th]) }}" @if($th == $tahun) aria-current="page" @endif>{{ $th }}</a>
                    @endforeach
                </nav>
            @endif
        </div>

        <section class="ikm-summary">
            <div class="ikm-score">
                @if($jumlah > 0)
                    <span class="ikm-label">Nilai IKM</span>
                    <strong class="ikm-num">{{ number_format($ikm, 2, ',', '.') }}</strong>
                    <span class="ikm-mutu mutu-{{ strtolower($mutu['kode']) }}">Mutu {{ $mutu['kode'] }} &middot; {{ $mutu['nama'] }}</span>
                    <span class="ikm-resp"><i class="fas fa-users"></i> {{ number_format($jumlah, 0, ',', '.') }} responden</span>
                @else
                    <i class="fas fa-chart-simple ikm-empty-ico"></i>
                    <strong class="ikm-none">Belum ada data</strong>
                    <span class="ikm-resp">Hasil akan tampil setelah ada responden pada tahun {{ $tahun }}.</span>
                @endif

                <ul class="mutu-legend" aria-label="Keterangan mutu">
                    <li><b class="mutu-a">A</b> 88,31 &ndash; 100 &middot; Sangat baik</li>
                    <li><b class="mutu-b">B</b> 76,61 &ndash; 88,30 &middot; Baik</li>
                    <li><b class="mutu-c">C</b> 65,00 &ndash; 76,60 &middot; Kurang baik</li>
                    <li><b class="mutu-d">D</b> 25,00 &ndash; 64,99 &middot; Tidak baik</li>
                </ul>
            </div>

            <div class="ikm-bars">
                <h3>Nilai per unsur pelayanan <small>skala 1 &ndash; 4</small></h3>
                @foreach($aspek_unsur as $i => $a)
                    @php
                        $nilai = $nrr[$i] ?? null;
                        $pct = $nilai ? ($nilai / 4) * 100 : 0;
                    @endphp
                    <div class="bar-row">
                        <div class="bar-top">
                            <span>{{ $a['nama'] }}</span>
                            <b>{{ $nilai !== null ? number_format($nilai, 2, ',', '.') : '-' }}</b>
                        </div>
                        <div class="bar-track"><i style="width: {{ $pct }}%"></i></div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ===== ISI SURVEI (FORM LANGSUNG DI HALAMAN) ===== -->
        <div class="content-head" id="survei">
            <div>
                <h2>Isi survei kepuasan</h2>
                <p>Survei Kepuasan Masyarakat &middot; Pemadaman dan Pengendalian Kejadian Kebakaran. Seluruh pertanyaan berupa pilihan, tanpa nama dan tanpa login.</p>
            </div>
        </div>

        @if(session('ikm_sukses'))
            <section class="survey-done" id="surveyDoneBox" role="status">
                <span class="survey-done-ico"><i class="fas fa-circle-check"></i></span>
                <h3>{{ session('ikm_sukses') }}</h3>
                <p>Masukan Anda menjadi bahan kami untuk terus memperbaiki pelayanan Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
                <a class="btn-send" id="btnRepeatSurvey" href="{{ route('ikm.index', ['ulang' => 1]) }}#survei">
                    <i class="fas fa-rotate-right"></i> Isi survei lagi
                </a>
            </section>
        @endif

        @php
            $langkah = [];
            foreach ($aspek_unsur as $a) {
                $langkah[] = ['judul' => $a['nama'], 'pertanyaan' => $a['pernyataan']];
            }
            foreach ($aspek_integritas as $ig) {
                $langkah[] = ['judul' => $ig['nama'], 'pertanyaan' => [$ig['field'] => $ig['pernyataan']]];
            }
        @endphp

        <form id="ikmForm" class="ikm-form" method="POST" action="{{ route('ikm.store') }}" novalidate @if($errors->any()) data-has-errors="1" @endif @if(session('ikm_sukses')) hidden @endif>
            @csrf
            <div class="hp" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

            <div class="form-progress">
                <div class="form-progress-top">
                    <strong id="stepTitle">Identitas Responden</strong>
                    <span id="stepLabel"></span>
                </div>
                <div class="form-bar"><i id="stepBar"></i></div>
            </div>

            @if($errors->any())
                <div class="form-alert" role="alert"><i class="fas fa-triangle-exclamation"></i> Masih ada isian yang belum lengkap atau belum sesuai. Silakan periksa bagian yang ditandai.</div>
            @endif

            {{-- Bagian 1: Identitas --}}
            <fieldset class="step" data-title="Identitas Responden">
                <div class="q {{ $errors->has('tanggal_layanan') ? 'q-err' : '' }}">
                    <label class="lbl" for="f-tanggal">Tanggal menerima layanan <span class="req">*</span></label>
                    <input class="field" type="date" id="f-tanggal" name="tanggal_layanan" value="{{ old('tanggal_layanan') }}" max="{{ date('Y-m-d') }}" required>
                    <small class="err">{{ $errors->first('tanggal_layanan') ?: 'Pilih tanggal yang valid.' }}</small>
                </div>

                <div class="q {{ $errors->has('pendidikan') ? 'q-err' : '' }}">
                    <label class="lbl" for="f-pendidikan">Pendidikan <span class="req">*</span></label>
                    <select class="field" id="f-pendidikan" name="pendidikan" required>
                        <option value="">Pilih Pendidikan</option>
                        @foreach($opsi_pendidikan as $o)
                            <option value="{{ $o }}" {{ old('pendidikan') === $o ? 'selected' : '' }}>{{ $o }}</option>
                        @endforeach
                    </select>
                    <small class="err">{{ $errors->first('pendidikan') ?: 'Pilih pendidikan Anda.' }}</small>
                </div>

                <div class="q {{ $errors->has('usia') ? 'q-err' : '' }}">
                    <label class="lbl" for="f-usia">Usia (minimal 18 tahun) <span class="req">*</span></label>
                    <input class="field" type="number" id="f-usia" name="usia" value="{{ old('usia') }}" min="18" max="100" inputmode="numeric" placeholder="Minimal 18 tahun" required>
                    <small class="err">{{ $errors->first('usia') ?: 'Usia responden minimal 18 tahun (antara 18 dan 100 tahun).' }}</small>
                </div>

                <div class="q {{ $errors->has('pekerjaan') ? 'q-err' : '' }}">
                    <label class="lbl" for="f-pekerjaan">Pekerjaan <span class="req">*</span></label>
                    <select class="field" id="f-pekerjaan" name="pekerjaan" required>
                        <option value="">Pilih Pekerjaan</option>
                        @foreach($opsi_pekerjaan as $o)
                            <option value="{{ $o }}" {{ old('pekerjaan') === $o ? 'selected' : '' }}>{{ $o }}</option>
                        @endforeach
                    </select>
                    <small class="err">{{ $errors->first('pekerjaan') ?: 'Pilih pekerjaan Anda.' }}</small>
                </div>

                <div class="q">
                    <label class="switch">
                        <input type="checkbox" name="disabilitas" value="1" {{ old('disabilitas') ? 'checked' : '' }}>
                        <i></i>
                        <span>Saya penyandang disabilitas / pendamping penyandang disabilitas</span>
                    </label>
                </div>
            </fieldset>

            {{-- Bagian 2-15: 9 unsur + 5 integritas --}}
            @foreach($langkah as $l)
                <fieldset class="step" data-title="{{ $l['judul'] }}" hidden>
                    @foreach($l['pertanyaan'] as $field => $teks)
                        <div class="q {{ $errors->has($field) ? 'q-err' : '' }}">
                            <p class="lbl" id="q-{{ $field }}">{{ $teks }} <span class="req">*</span></p>
                            <div class="opts" role="radiogroup" aria-labelledby="q-{{ $field }}">
                                @foreach($skala_jawaban as $nilai => $label)
                                    <label class="opt">
                                        <input type="radio" name="{{ $field }}" value="{{ $nilai }}" {{ (string) old($field) === (string) $nilai ? 'checked' : '' }} required>
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <small class="err">{{ $errors->first($field) ?: 'Pilih salah satu jawaban.' }}</small>
                        </div>
                    @endforeach
                </fieldset>
            @endforeach

            {{-- Bagian terakhir: kritik, saran, kepercayaan --}}
            <fieldset class="step" data-title="Kritik, Saran dan Penutup" hidden>
                <div class="q {{ $errors->has('kritik_saran') ? 'q-err' : '' }}">
                    <label class="lbl" for="f-kritik">Kritik dan saran <span class="req">*</span></label>
                    <textarea class="field" id="f-kritik" name="kritik_saran" rows="4" maxlength="1000" placeholder="Tulis kritik dan saran Anda" required>{{ old('kritik_saran') }}</textarea>
                    <small class="err">{{ $errors->first('kritik_saran') ?: 'Kritik dan saran wajib diisi.' }}</small>
                </div>

                @foreach($kepercayaan as $field => $teks)
                    <div class="q {{ $errors->has($field) ? 'q-err' : '' }}">
                        <p class="lbl" id="q-{{ $field }}">{{ $teks }} <span class="req">*</span></p>
                        <div class="opts-num" role="radiogroup" aria-labelledby="q-{{ $field }}">
                            @for($n = 1; $n <= 10; $n++)
                                <label class="num">
                                    <input type="radio" name="{{ $field }}" value="{{ $n }}" {{ (string) old($field) === (string) $n ? 'checked' : '' }} required>
                                    <span>{{ $n }}</span>
                                </label>
                            @endfor
                        </div>
                        <small class="err">{{ $errors->first($field) ?: 'Pilih satu angka.' }}</small>
                    </div>
                @endforeach
            </fieldset>

            <div class="form-nav">
                <button type="button" class="btn-ghost" id="btnPrev" hidden><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                <button type="button" class="btn-send" id="btnNext">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                <button type="submit" class="btn-send" id="btnSend" hidden><i class="fas fa-paper-plane"></i> Kirim survei</button>
            </div>
        </form>


        <!-- ===== ASPEK YANG DINILAI (SESUAI FORM SKM) ===== -->
        <div class="content-head" id="aspek">
            <div>
                <h2>Apa saja yang dinilai</h2>
                <p>Pertanyaan pada survei mencakup 9 unsur pelayanan dan 5 aspek integritas, ditambah kritik dan saran.</p>
            </div>
        </div>

        <div class="aspek-grid">
            @foreach($aspek_unsur as $no => $a)
                <article class="aspek-card">
                    <span class="aspek-no">{{ $no }}</span>
                    <div>
                        <h3>{{ $a['nama'] }}</h3>
                        <ul>
                            @foreach($a['pernyataan'] as $p)
                                <li>{{ $p }}</li>
                            @endforeach
                        </ul>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="content-head">
            <div>
                <h2>Penilaian integritas pelayanan</h2>
                <p>Lima pernyataan tambahan untuk memastikan pelayanan bersih dan adil.</p>
            </div>
        </div>

        <div class="aspek-grid">
            @foreach($aspek_integritas as $ig)
                <article class="aspek-card">
                    <span class="aspek-no int"><i class="fas {{ $ig['ikon'] }}"></i></span>
                    <div>
                        <h3>{{ $ig['nama'] }}</h3>
                        <p>{{ $ig['pernyataan'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="skala" aria-label="Pilihan jawaban">
            <span>Pilihan jawaban:</span>
            @foreach($skala_jawaban as $n => $s)
                <b><i>{{ $n }}</i> {{ $s }}</b>
            @endforeach
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

                <div class="footer-contact">
                    <a href="{{ $wa_link }}" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> {{ $no_whatsapp }} (WhatsApp)
                    </a>
                    <a href="tel:{{ $no_telepon }}">
                        <i class="fas fa-phone-alt"></i> {{ $telepon_tampil }} (Call Center Damkar)
                    </a>
                </div>
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
        // Desktop: dropdown tertutup rapi saat kursor meninggalkan menu
        li.addEventListener('mouseleave', function () {
            if (!desktop.matches) return;
            li.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            closeSubs();
        });
    });

    // MULTILEVEL DROPDOWN (Galeri > Berita)
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

    // Kembali ke desktop: pastikan laci mobile tertutup
    window.matchMedia('(min-width: 1201px)').addEventListener('change', function (e) {
        if (e.matches) setMobileMenu(false);
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

})();
</script>
<script>
(function () {
    'use strict';
    var form = document.getElementById('ikmForm');
    if (!form) { return; }

    var doneBox       = document.getElementById('surveyDoneBox');
    var btnRepeat     = document.getElementById('btnRepeatSurvey');
    var btnHeroSurvei = document.getElementById('btnHeroSurvei');
    var steps         = [].slice.call(form.querySelectorAll('.step'));
    var btnPrev       = document.getElementById('btnPrev');
    var btnNext       = document.getElementById('btnNext');
    var btnSend       = document.getElementById('btnSend');
    var elTitle       = document.getElementById('stepTitle');
    var elLabel       = document.getElementById('stepLabel');
    var elBar         = document.getElementById('stepBar');
    var cur           = 0;

    function show(i, scroll) {
        cur = i;
        steps.forEach(function (s, k) { s.hidden = (k !== i); });
        elTitle.textContent = steps[i].getAttribute('data-title');
        elLabel.textContent = 'Bagian ' + (i + 1) + ' dari ' + steps.length;
        elBar.style.width = ((i + 1) / steps.length * 100) + '%';
        btnPrev.hidden = (i === 0);
        btnNext.hidden = (i === steps.length - 1);
        btnSend.hidden = (i !== steps.length - 1);
        if (scroll) { form.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    }

    function openFreshForm(e) {
        if (doneBox && !doneBox.hidden) {
            if (e) { e.preventDefault(); }
            doneBox.hidden = true;
            form.hidden = false;
            form.reset();
            form.querySelectorAll('.q-err').forEach(function (q) { q.classList.remove('q-err'); });
            show(0, true);
        }
    }

    if (btnRepeat) {
        btnRepeat.addEventListener('click', openFreshForm);
    }
    if (btnHeroSurvei) {
        btnHeroSurvei.addEventListener('click', function (e) {
            if (doneBox && !doneBox.hidden) {
                openFreshForm(e);
            }
        });
    }

    function qOk(q) {
        var radios = q.querySelectorAll('input[type=radio]');
        if (radios.length) {
            return [].some.call(radios, function (r) { return r.checked; });
        }
        var c = q.querySelector('input:not([type=checkbox]),select,textarea');
        return !c || !c.required || (c.value.trim() !== '' && c.checkValidity());
    }

    function stepOk(step) {
        var ok = true;
        step.querySelectorAll('.q').forEach(function (q) {
            var good = qOk(q);
            q.classList.toggle('q-err', !good);
            if (!good) { ok = false; }
        });
        return ok;
    }

    form.addEventListener('change', function (e) {
        var q = e.target.closest('.q');
        if (q && qOk(q)) { q.classList.remove('q-err'); }
    });

    form.addEventListener('input', function (e) {
        var q = e.target.closest('.q');
        if (q && qOk(q)) { q.classList.remove('q-err'); }
    });

    btnPrev.addEventListener('click', function () { if (cur > 0) { show(cur - 1, true); } });
    btnNext.addEventListener('click', function () {
        if (stepOk(steps[cur]) && cur < steps.length - 1) { show(cur + 1, true); }
    });

    form.addEventListener('submit', function (e) {
        for (var i = 0; i < steps.length; i++) {
            if (!stepOk(steps[i])) {
                e.preventDefault();
                show(i, true);
                return;
            }
        }
    });

    /* Kalau server menolak (validasi), buka bagian pertama yang bermasalah */
    var first = 0;
    if (form.getAttribute('data-has-errors')) {
        for (var k = 0; k < steps.length; k++) {
            if (steps[k].querySelector('.q-err')) { first = k; break; }
        }
    }
    show(first, !!form.getAttribute('data-has-errors'));
})();
</script>
</body>
</html>