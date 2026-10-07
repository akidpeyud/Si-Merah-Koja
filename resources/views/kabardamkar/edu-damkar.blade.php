@php
    // Data bawaan untuk footer dan tombol darurat
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
    $play_store_url = "";

    // Ambil data Edu Damkar (hanya yang memiliki youtube_id)
    $listEduDamkar = isset($daftar_edu_damkar) && count($daftar_edu_damkar)
        ? collect($daftar_edu_damkar)->filter(fn($item) => !empty($item->youtube_id))
        : (\Illuminate\Support\Facades\Schema::hasTable('edu_damkar')
            ? \App\Models\EduDamkar::whereNotNull('youtube_id')->where('youtube_id', '!=', '')->latest()->get()
            : collect());
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="Kumpulan video edukasi, tindakan praktis, dan saran dari petugas Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.">
    <title>Edu Damkar - Kabar Damkar | SIMERAH KOJA</title>

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
            --header:68px;
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

        /* ================= HEADER ================= */
        .site-header{
            position:sticky;top:0;z-index:60;
            background:rgba(8,22,35,.88);
            backdrop-filter:blur(18px) saturate(1.35);
            -webkit-backdrop-filter:blur(18px) saturate(1.35);
            border-bottom:1px solid rgba(255,255,255,.08);
        }
        .nav{
            width:min(1240px,calc(100% - 32px));
            height:var(--header);
            margin:auto;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
        }
        .brand{display:flex;align-items:center;gap:9px;flex:none}
        .brand img{height:37px;width:auto;object-fit:contain}
        .brand img+img{padding-left:9px;border-left:1px solid rgba(255,255,255,.16)}

        .menu{display:flex;align-items:center;gap:2px}
        .menu>li{position:relative}
        .menu-link,.menu-trigger{
            display:inline-flex;align-items:center;gap:8px;
            padding:9px 13px;border-radius:999px;
            color:rgba(255,255,255,.88);
            font-size:.88rem;font-weight:600;
            transition:.2s ease;
        }
        .menu-link:hover,.menu-trigger:hover,.has-drop.open>.menu-trigger,.menu>li.current>.menu-trigger{
            color:#fff;background:rgba(255,255,255,.10)
        }
        .menu-trigger i{font-size:.62rem;transition:transform .2s}
        .has-drop.open>.menu-trigger i{transform:rotate(180deg)}
        .menu .btn-login{margin-left:8px;padding:10px 20px;background:var(--signal);color:#fff}
        .menu .btn-login:hover{background:var(--signal-dark);transform:translateY(-1px)}

        .dropdown{
            display:none;position:absolute;top:calc(100% + 10px);left:0;
            min-width:245px;padding:7px;
            background:#10283e;border:1px solid rgba(255,255,255,.1);
            border-radius:16px;box-shadow:0 24px 55px rgba(0,0,0,.35)
        }
        .dropdown::before{content:"";position:absolute;left:0;right:0;top:-10px;height:10px}
        .dropdown a{display:block;padding:10px 13px;border-radius:10px;color:rgba(255,255,255,.84);font-size:.9rem}
        .dropdown a:hover,.dropdown a[aria-current=page]{background:rgba(255,255,255,.09);color:#fff}
        .has-drop.open .dropdown{display:block}

        .nav-toggle{display:none;width:44px;height:44px;border-radius:12px;color:#fff;font-size:1.1rem}
        .nav-toggle:hover{background:rgba(255,255,255,.1)}

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

        /* ================= FOOTER ================= */
        .footer{background:var(--ink);color:rgba(255,255,255,.69);padding:80px 0 30px}
        .footer-grid{display:grid;grid-template-columns:1.05fr 1.2fr .75fr;gap:54px}
        .footer h3{font-family:var(--display);color:#fff;font-size:1.1rem;margin-bottom:15px}
        .footer-about img{height:88px;width:auto;margin-bottom:17px}
        .footer-about p{max-width:44ch;font-size:.91rem}
        .map{position:relative;height:195px;border-radius:18px;overflow:hidden;background:var(--ink-2);border:1px solid rgba(255,255,255,.08)}
        .map iframe{width:100%;height:100%;border:0;filter:grayscale(.25) contrast(1.04);transition:.3s}
        .map-link{position:absolute;inset:0;z-index:2;display:flex;align-items:flex-end;justify-content:flex-end;padding:12px}
        .map-link span{display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border-radius:999px;background:var(--signal);color:#fff;font-size:.78rem;font-weight:800;box-shadow:0 9px 20px rgba(0,0,0,.28);transition:.2s}
        .map-link:hover span{background:var(--signal-dark);transform:translateY(-2px)}
        .map:hover iframe{filter:none}
        .find{display:inline-flex;align-items:center;gap:9px;margin-top:13px;color:#fff;font-size:.86rem;font-weight:700;transition:.2s}
        .find i{color:var(--signal)}
        .find:hover{color:var(--amber);gap:13px}
        .app-dl{margin-top:20px}.app-dl p{font-size:.82rem;margin-bottom:9px}.app-dl img{height:42px;width:auto}
        .footer-links li+li{margin-top:7px}
        .footer-links a{display:flex;align-items:center;gap:9px;padding:5px 0;font-size:.88rem;transition:.2s}
        .footer-links a i{font-size:.65rem;color:var(--signal)}
        .footer-links a:hover{color:#fff;gap:13px}
        .footer-bar{margin-top:58px;padding-top:25px;border-top:1px solid rgba(255,255,255,.1);display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap;font-size:.8rem}
        .social{display:flex;gap:7px;flex-wrap:wrap}
        .social a{width:39px;height:39px;border-radius:11px;display:grid;place-items:center;background:rgba(255,255,255,.075);color:#fff;transition:.2s}
        .social a:hover{background:var(--signal);transform:translateY(-3px)}

        /* ================= SOS ================= */
        .beacon{position:relative;width:10px;height:10px;border-radius:50%;background:#fff;flex:none}
        .beacon::after{content:"";position:absolute;inset:0;border-radius:50%;background:#fff;animation:ping 1.8s cubic-bezier(0,0,.2,1) infinite}
        @keyframes ping{0%{transform:scale(1);opacity:.7}100%{transform:scale(3.2);opacity:0}}
        .sos-fab{
            position:fixed;right:22px;bottom:22px;z-index:70;
            display:flex;flex-direction:column;align-items:flex-end;gap:10px;
            opacity:0;visibility:hidden;transform:translateY(16px);transition:.3s
        }
        .sos-fab.show{opacity:1;visibility:visible;transform:none}
        .sos-fab-btn{
            display:inline-flex;align-items:center;gap:9px;padding:13px 19px;
            border-radius:999px;background:var(--signal);color:#fff;font-weight:800;
            box-shadow:0 15px 30px -7px rgba(229,57,45,.55);transition:.2s
        }
        .sos-fab-btn:hover{background:var(--signal-dark);transform:translateY(-2px)}
        .sos-sheet{display:none;width:min(320px,calc(100vw - 28px));padding:7px;border-radius:18px;background:var(--ink);border:1px solid rgba(255,255,255,.1);box-shadow:0 24px 48px rgba(0,0,0,.4)}
        .sos-fab.open .sos-sheet{display:grid;gap:5px}
        .sos-sheet a{display:flex;align-items:center;gap:13px;padding:12px 13px;border-radius:12px;color:#fff;font-weight:700;font-size:.9rem}
        .sos-sheet a:hover{background:rgba(255,255,255,.09)}
        .sos-sheet a i{width:21px;text-align:center;font-size:1.05rem}
        .sos-sheet .wa i{color:#25d366}.sos-sheet .tel i{color:#38bdf8}.sos-sheet .n112 i{color:#f87171}

        /* ================= RESPONSIVE ================= */
        @media (hover:hover) and (min-width:992px){.has-drop:hover .dropdown{display:block}}
        @media (max-width:1100px){
            .menu-link,.menu-trigger{padding-left:10px;padding-right:10px;font-size:.82rem}
            .media-grid{grid-template-columns:repeat(3,minmax(0,1fr))}
            .footer-grid{grid-template-columns:1fr 1fr}
            .footer-links{grid-column:span 2}
        }
        @media (max-width:991px){
            .nav-toggle{display:inline-flex;align-items:center;justify-content:center}
            .menu{
                display:none;position:fixed;top:var(--header);left:0;right:0;
                max-height:calc(100dvh - var(--header));overflow-y:auto;
                flex-direction:column;align-items:stretch;gap:4px;
                padding:14px 16px 25px;background:var(--ink);
                border-bottom:1px solid rgba(255,255,255,.1)
            }
            .nav-open .menu{display:flex}
            .menu-link,.menu-trigger{width:100%;justify-content:space-between;padding:13px 14px;border-radius:13px;font-size:.95rem}
            .dropdown{position:static;margin:1px 0 7px 10px;box-shadow:none;background:transparent;border:0;border-left:2px solid rgba(255,255,255,.12);border-radius:0}
            .dropdown::before{display:none}
            .menu .btn-login{margin:7px 0 0;justify-content:center;padding:13px}
            .page-hero{padding:43px 0 78px}
            .media-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
        }
        @media (max-width:768px){
            .page-nav { justify-content: flex-start; padding: 6px 12px; }
            .page-nav a { padding: 8px 16px; font-size: 0.85rem; }
        }
        @media (max-width:700px){
            .wrap{width:min(calc(100% - 28px),1180px)}
            .brand img{height:32px}
            .brand img+img{padding-left:7px}
            .page-hero h1{font-size:clamp(2.8rem,15vw,4.5rem)}
            .footer{padding-top:60px}
            .footer-grid{grid-template-columns:1fr;gap:38px}
            .footer-links{grid-column:auto}
            .footer-bar{margin-top:42px;align-items:flex-start}
            .sos-fab{right:14px;bottom:14px}
        }
        @media (max-width:520px){
            .media-grid{grid-template-columns:1fr}
        }
        @media (max-width:390px){
            .brand img{height:28px}
            .brand img+img{padding-left:5px}
            .media-body{padding:16px}
            .media-thumb{aspect-ratio:16/10}
        }
    </style>
</head>
<body>

<!-- ==================== HEADER ==================== -->
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
             <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">RPKBGL</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK &amp; Perpanjang SKK</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">Edukasi dan sosialisasi</a></li>
                    <li><a href="/public-sigap">SIGAP</a></li>
                    <li><a href="/informasi-layanan">Informasi layanan</a></li>
                </ul>
            </li>
            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Kabar Damkar <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                   <li><a href="/edu-damkar" aria-current="page">Edu Damkar</a></li>
                   <li><a href="/infografis">Info Grafis</a></li>
                    <li><a href="/media-informasi">Media Informasi</a></li>
                    <li><a href="/ujung-ujung-damkar">Ujung-ujung Damkar</a></li>
                </ul>
            </li>
            <li><a class="menu-link" href="/redkar">Redkar</a></li>
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
                <li><a href="#">Kabar Damkar</a></li>
                <li><span aria-current="page">Edu Damkar</span></li>
            </ol>
        </nav>
        <div class="hero-kicker rise"><i class="fas fa-fire-extinguisher"></i> Edukasi &amp; Pencegahan</div>
        <h1 class="rise d1">Edu Damkar</h1>
        <p class="rise d2">Kumpulan video edukasi, tindakan praktis, dan saran dari petugas untuk mencegah serta menghadapi keadaan darurat kebakaran.</p>
        <div class="hero-line rise d3"></div>
    </div>
</section>

<!-- ==================== SUB NAVIGATION (PILL MENU) ==================== -->
<div class="page-nav-wrap rise d3">
    <nav class="page-nav" aria-label="Sub menu Kabar Damkar">
        <a href="/edu-damkar" class="active"><i class="fas fa-video"></i> Edu Damkar</a>
        <a href="/infografis"><i class="fas fa-image"></i> Info Grafis</a>
        <a href="/media-informasi"><i class="fas fa-newspaper"></i> Media Informasi</a>
        <a href="/ujung-ujung-damkar"><i class="fas fa-fire-extinguisher"></i> Ujung-ujung Damkar</a>
    </nav>
</div>

<!-- ==================== BODY & KONTEN ==================== -->
<div class="page-body">
    <div class="wrap media-layout">
        <div class="content-head">
            <div>
                <h2>Video edukasi terbaru</h2>
                <p>Klik pada video untuk menonton panduan keselamatan secara langsung.</p>
            </div>
        </div>

        <div class="media-grid" id="eduGrid">
            @forelse($listEduDamkar as $v)
                @php
                    $ytId = $v->youtube_id;
                    $thumbUrl = "https://i.ytimg.com/vi/{$ytId}/hqdefault.jpg";
                @endphp

                <button type="button"
                        class="media-card"
                        data-yt="{{ $ytId }}"
                        data-title="{{ $v->judul }}">
                    <div class="media-thumb">
                        <span class="media-tag">Video Edukasi</span>
                        <span class="media-source" aria-hidden="true">
                            <i class="fab fa-youtube"></i>
                        </span>
                        <img src="{{ $thumbUrl }}"
                             alt="{{ $v->judul }}"
                             loading="lazy"
                             onerror="this.src='/images/placeholder.jpg'">
                        <span class="photo-play" aria-hidden="true">
                            <i class="fas fa-play"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <h3>{{ $v->judul }}</h3>
                        <div class="media-meta">
                            @if(!empty($v->created_at) || !empty($v->tanggal))
                                <span>
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($v->tanggal ?? $v->created_at)->locale('id')->translatedFormat('d M Y') }}
                                </span>
                            @endif
                            <span>
                                <i class="fab fa-youtube"></i>
                                YouTube Damkar
                            </span>
                        </div>
                        <span class="media-link">
                            Tonton video
                            <i class="fas fa-play"></i>
                        </span>
                    </div>
                </button>
            @empty
                <div class="empty-filter">
                    <i class="fas fa-video-slash"></i>
                    <h2>Belum ada video edukasi</h2>
                    <p>Video edukasi akan tampil di sini setelah diunggah oleh petugas.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

</main>

<!-- ==================== MODAL DIALOG (YOUTUBE) ==================== -->
<dialog id="mediaDialog" aria-label="Pemutar video edukasi">
    <button type="button" class="dlg-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
    <div class="video-frame" id="dialogContent"></div>
</dialog>

<!-- ==================== FOOTER ==================== -->
<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
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

                @if ($play_store_url)
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

    header.querySelectorAll('.dropdown a, .menu-link').forEach(function (a) {
        a.addEventListener('click', function () {
            header.classList.remove('nav-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.querySelector('i').className = 'fas fa-bars';
            closeDrops(null);
        });
    });

    /* ---------- Modal Dialog (Video YouTube) ---------- */
    var mDialog = document.getElementById('mediaDialog');
    var dContent = document.getElementById('dialogContent');
    var cards = document.querySelectorAll('#eduGrid .media-card');

    cards.forEach(function (card) {
        card.addEventListener('click', function () {
            var ytId = card.getAttribute('data-yt');
            var title = card.getAttribute('data-title') || 'Video Edukasi';

            if (ytId) {
                dContent.innerHTML = '<iframe src="https://www.youtube-nocookie.com/embed/' + ytId + '?autoplay=1" title="' + title.replace(/"/g, '&quot;') + '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                mDialog.showModal();
            }
        });
    });

    function closeDialog() {
        dContent.innerHTML = '';
        mDialog.close();
    }

    mDialog.querySelector('.dlg-close').addEventListener('click', closeDialog);
    mDialog.addEventListener('click', function (e) {
        if (e.target === mDialog) closeDialog();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDrops(null);
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
</body>
</html>