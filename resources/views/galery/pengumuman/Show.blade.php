@php
    // Data bawaan untuk footer dan tombol darurat
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
    $maps_link = "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";

    $lainnya = $lainnya ?? collect();
    
    // Fallback tanggal jika field tanggal kustom (seperti event date) tidak diisi, gunakan created_at
    $tanggal_render = $pengumuman->tanggal ?? $pengumuman->created_at;
    $tgl_detail = \Carbon\Carbon::parse($tanggal_render)->locale('id')->translatedFormat('d F Y');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags((string) $pengumuman->isi), 150) }}">
    <title>{{ $pengumuman->judul }} - Pengumuman | SIMERAH KOJA</title>

    <meta name="theme-color" content="#0d1b2a">
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{
            --ink:#0b1826; --ink-2:#10283e; --ink-3:#183b5a;
            --paper:#f4f6f9; --white:#fff;
            --signal:#e5392d; --signal-dark:#bd241c; --signal-d:#c22b20;
            --amber:#ffb627; --steel:#657487; --line:#e0e6ed; --soft:#eef2f6;
            --display:'Bricolage Grotesque',system-ui,sans-serif;
            --body:'Instrument Sans',system-ui,sans-serif;
            --font-display:var(--display); --font-body:var(--body);
            --wrap:1180px; --header-h:64px; --nav-wrap:1300px;
            --r-lg:28px; --r-md:18px; --r-sm:10px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{font-family:var(--body);color:var(--ink);background:var(--paper);line-height:1.6;-webkit-font-smoothing:antialiased;overflow-x:hidden}
        img{max-width:100%;display:block}
        a{color:inherit;text-decoration:none}
        ul,ol{list-style:none}
        button{font:inherit;color:inherit;background:none;border:0;cursor:pointer;text-align:left}
        :focus-visible{outline:3px solid var(--amber);outline-offset:3px;border-radius:7px}
        .wrap{width:min(var(--wrap),calc(100% - 40px));margin:auto}

        /* ================= HEADER & NAVBAR ================= */
        .site-header{position:sticky;top:0;z-index:60;background:rgba(13,27,42,.85);-webkit-backdrop-filter:blur(14px) saturate(1.4);backdrop-filter:blur(14px) saturate(1.4);border-bottom:1px solid rgba(255,255,255,.08)}
        .nav{max-width:var(--nav-wrap);margin:0 auto;min-height:var(--header-h);padding:0 clamp(16px,4vw,32px);display:flex;align-items:center;justify-content:space-between;gap:12px}
        .brand{display:flex;align-items:center;gap:12px;flex:none}
        .brand img{height:38px;width:auto}
        .menu{display:flex;align-items:center;gap:2px;flex-wrap:wrap}
        .menu>li{position:relative}
        .menu-link,.menu-trigger{display:inline-flex;align-items:center;gap:6px;padding:8px 10px;border-radius:999px;color:rgba(255,255,255,.88);font-size:.85rem;font-weight:500;transition:background .2s,color .2s;white-space:nowrap}
        .menu-link:hover,.menu-trigger:hover,.has-drop.open>.menu-trigger{background:rgba(255,255,255,.1);color:#fff}
        .menu-trigger i{font-size:.6rem;transition:transform .2s}
        .has-drop.open>.menu-trigger i{transform:rotate(180deg)}
        .menu .btn-login{background:var(--signal);color:#fff;margin-left:6px;font-weight:600;padding:8px 18px}
        .menu .btn-login:hover{background:var(--signal-d)}
        .dropdown{display:none;position:absolute;top:calc(100% + 10px);left:0;min-width:260px;background:var(--ink-2);border:1px solid rgba(255,255,255,.1);border-radius:var(--r-md);padding:8px;box-shadow:0 24px 48px rgba(0,0,0,.45)}
        .menu>li:nth-last-child(-n+4) .dropdown{left:auto;right:0}
        .dropdown::before{content:"";position:absolute;left:0;right:0;top:-10px;height:10px}
        .dropdown a{display:block;padding:10px 14px;border-radius:var(--r-sm);font-size:.9rem;color:rgba(255,255,255,.85);line-height:1.4;white-space:normal}
        .dropdown a:hover{background:rgba(255,255,255,.08);color:#fff}
        .dropdown .btn-logout{width:100%;text-align:left;padding:11px 14px;border-radius:var(--r-sm);font-size:.92rem;color:#ff8b8b;display:flex;align-items:center;gap:8px;transition:background .2s,color .2s;cursor:pointer}
        .dropdown .btn-logout:hover{background:rgba(255,255,255,.1);color:#ffb8b8}
        .has-drop.open>.dropdown{display:block}

        /* Multilevel dropdown */
        .has-sub{position:relative}
        .has-sub>.sub-trigger{width:100%;text-align:left;display:flex;align-items:center;justify-content:space-between;gap:10px;padding:10px 14px;border-radius:var(--r-sm);font-size:.9rem;line-height:1.4;color:rgba(255,255,255,.85);background:transparent;border:none;cursor:pointer;font-family:inherit;transition:background .2s,color .2s}
        .has-sub>.sub-trigger i{font-size:.7rem;transition:transform .2s}
        .has-sub.open>.sub-trigger i{transform:rotate(90deg)}
        .has-sub>.sub-trigger:hover,.has-sub.open>.sub-trigger{background:rgba(255,255,255,.1);color:#fff}
        .dropdown-sub{display:none;position:absolute;top:-8px;left:100%;min-width:230px;background:var(--ink-2);border:1px solid rgba(255,255,255,.1);border-radius:var(--r-md);padding:8px;box-shadow:0 24px 48px rgba(0,0,0,.45);margin-left:4px;z-index:10}
        .dropdown-sub::before{content:"";position:absolute;top:0;bottom:0;left:-10px;width:10px}
        .has-sub.open>.dropdown-sub{display:block}
        @media (hover:hover) and (min-width:1251px){
            .has-drop:hover>.dropdown{display:block}
            .has-sub:hover>.dropdown-sub{display:block}
            .has-sub:hover>.sub-trigger{background:rgba(255,255,255,.1);color:#fff}
            .dropdown-sub{left:auto;right:100%;margin-left:0;margin-right:4px}
            .dropdown-sub::before{left:auto;right:-10px}
            .has-sub>.sub-trigger i,.has-sub.open>.sub-trigger i{transform:rotate(180deg)}
        }
        .nav-toggle{display:none;width:44px;height:44px;border-radius:12px;color:#fff;font-size:1.15rem}
        .nav-toggle:hover{background:rgba(255,255,255,.1)}
        @media (max-width:1250px){
            .nav-toggle{display:inline-flex;align-items:center;justify-content:center}
            .menu{display:none;position:fixed;top:var(--header-h);left:0;right:0;max-height:calc(100dvh - var(--header-h));overflow-y:auto;flex-direction:column;align-items:stretch;gap:4px;flex-wrap:nowrap;padding:16px clamp(16px,4vw,32px) 28px;background:var(--ink);border-bottom:1px solid rgba(255,255,255,.1)}
            .nav-open .menu{display:flex}
            .menu-link,.menu-trigger{width:100%;justify-content:space-between;padding:14px 16px;border-radius:14px;font-size:1rem;white-space:normal}
            .dropdown{position:static;margin:2px 0 8px 12px;box-shadow:none;background:transparent;border:0;border-left:2px solid rgba(255,255,255,.12);border-radius:0;min-width:100%}
            .dropdown::before{display:none}
            .menu .btn-login{margin:8px 0 0;justify-content:center;padding:14px}
            .has-sub>.sub-trigger{padding:14px 16px;border-radius:14px;font-size:1rem}
            .dropdown-sub{position:static;margin:4px 0 4px 12px;box-shadow:none;background:transparent;border:0;border-left:2px solid rgba(255,255,255,.12);border-radius:0;padding:0;min-width:100%}
            .dropdown-sub::before{display:none}
        }
        .menu>li.current>.menu-trigger{background:rgba(255,255,255,.1);color:#fff}
        .dropdown a[aria-current="page"]{background:rgba(255,255,255,.09);color:#fff;font-weight:600}

        /* ================= HERO ================= */
        .page-hero{position:relative;isolation:isolate;overflow:hidden;color:#fff;padding:54px 0 88px;background:#0b1826}
        .page-hero::before{content:"";position:absolute;inset:0;z-index:-2;background:linear-gradient(105deg,rgba(7,20,33,.97) 0%,rgba(8,24,39,.88) 45%,rgba(8,24,39,.62) 100%),url('/images/background1.png') center/cover no-repeat}
        .page-hero::after{content:"";position:absolute;z-index:-1;inset:auto -10% -50% -10%;height:280px;background:radial-gradient(ellipse at center,rgba(229,57,45,.38),transparent 66%);pointer-events:none}
        .crumbs{display:flex;flex-wrap:wrap;align-items:center;gap:9px;color:rgba(255,255,255,.66);font-size:.83rem;margin-bottom:24px}
        .crumbs li{display:inline-flex;align-items:center;gap:9px}
        .crumbs li+li::before{content:"/";opacity:.38}
        .crumbs a:hover{color:#fff}
        .crumbs [aria-current=page]{color:#fff;font-weight:700}
        .hero-kicker{display:inline-flex;align-items:center;gap:9px;padding:7px 11px;border:1px solid rgba(255,255,255,.14);border-radius:999px;background:rgba(255,255,255,.07);color:rgba(255,255,255,.82);font-size:.74rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:16px}
        .hero-kicker i{color:#ff5a4d}
        .page-hero h1{font-family:var(--display);font-weight:800;font-size:clamp(3rem,7vw,5.8rem);line-height:.91;letter-spacing:-.055em;max-width:760px}
        .page-hero h1.h1-judul{font-size:clamp(1.9rem,4.4vw,3.3rem);line-height:1.1;letter-spacing:-.035em;max-width:900px}
        .page-hero p{margin-top:18px;max-width:570px;color:rgba(255,255,255,.72);font-size:clamp(.98rem,1.4vw,1.1rem)}
        .hero-line{width:70px;height:4px;border-radius:99px;margin-top:25px;background:var(--signal)}
        .rise{animation:rise .75s cubic-bezier(.16,.84,.3,1) both}
        .rise.d1{animation-delay:.08s}.rise.d2{animation-delay:.16s}.rise.d3{animation-delay:.24s}
        @keyframes rise{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}

        /* ================= KONTEN ================= */
        .page-body{background:var(--paper);min-height:50vh;padding-bottom:95px}
        .pg-page .wrap{padding-top:44px}
        .pg-detail{display:grid;grid-template-columns:minmax(0,1fr) 300px;gap:26px;align-items:start}
        .pg-detail:not(:has(.pg-side)){grid-template-columns:minmax(0,1fr)}
        .pg-article{padding:clamp(22px,4vw,40px);background:#fff;border:1px solid var(--line);border-radius:22px;box-shadow:0 7px 24px rgba(13,27,42,.055)}
        .pg-article-meta{display:flex;flex-wrap:wrap;align-items:center;gap:7px}
        .tag{display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border-radius:8px;background:var(--soft);color:var(--ink-2);font-size:.68rem;font-weight:800;letter-spacing:.04em;text-transform:uppercase}
        .tag-penting{background:rgba(229,57,45,.12);color:var(--signal-dark)}
        .pg-time{display:inline-flex;align-items:center;gap:7px;color:var(--steel);font-size:.82rem;font-weight:600}
        .pg-body{margin-top:22px;font-size:1.02rem;line-height:1.8;color:#27384a;overflow-wrap:anywhere}
        
        /* GAYA LAMPIRAN PENGUMUMAN */
        .pg-attachment-box { margin-top: 32px; border-top: 1px dashed var(--line); padding-top: 24px; }
        .pg-attachment-label { font-size: .88rem; font-weight: 700; color: var(--steel); margin-bottom: 12px; display: block; text-transform: uppercase; letter-spacing: .05em; }
        .pg-img-wrap { border-radius: var(--r-md); overflow: hidden; border: 1px solid var(--line); background: var(--soft); max-width: max-content; }
        .pg-img-wrap img { max-width: 100%; max-height: 700px; object-fit: contain; }
        
        .pg-attach{display:inline-flex;align-items:center;gap:14px;padding:14px 20px;border-radius:16px;background:var(--paper);border:1px solid var(--line);transition:.2s}
        .pg-attach:hover{border-color:var(--signal);transform:translateY(-2px); box-shadow:0 8px 20px rgba(0,0,0,.04)}
        .pg-attach-ico{display:grid;place-items:center;width:44px;height:44px;border-radius:12px;background:var(--signal);color:#fff;font-size:1.1rem}
        .pg-attach b{display:block;font-size:.95rem; color:var(--ink)}
        .pg-attach small{display:block;color:var(--steel);font-size:.78rem;max-width:30ch;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
        
        .pg-back{display:flex;align-items:center;gap:9px;margin-top:30px;font-size:.88rem;font-weight:800;color:var(--steel);transition:.2s}
        .pg-back:hover{color:var(--signal-dark);gap:13px}
        
        .pg-side{padding:22px;background:#fff;border:1px solid var(--line);border-radius:22px;box-shadow:0 7px 24px rgba(13,27,42,.055);position:sticky;top:calc(var(--header-h) + 20px)}
        .pg-side h3{font-family:var(--display);font-size:1.05rem;margin-bottom:12px}
        .pg-side a{display:block;padding:12px 0;border-top:1px solid var(--soft)}
        .pg-side a small{display:block;color:var(--steel);font-size:.74rem;font-weight:600}
        .pg-side a span{display:block;margin-top:2px;font-weight:700;font-size:.92rem;line-height:1.35;transition:color .2s}
        .pg-side a:hover span{color:var(--signal-dark)}

        @media (max-width:991px){.pg-detail{grid-template-columns:1fr}.pg-side{position:static}}

        /* ================= FOOTER ================= */
        .footer{background:var(--ink);color:rgba(255,255,255,.7);padding:clamp(56px,8vw,96px) 0 32px}
        .footer-grid{display:grid;grid-template-columns:1.1fr 1.2fr .8fr;gap:clamp(32px,5vw,64px)}
        .footer h3{font-family:var(--font-display);font-weight:700;font-size:1.15rem;color:#fff;margin-bottom:16px}
        .footer-about img{height:96px;width:auto;margin-bottom:20px}
        .footer-about p{max-width:42ch;font-size:.95rem}
        .footer-contact{margin-top:24px;display:grid;gap:12px}
        .footer-contact a{display:inline-flex;align-items:center;gap:12px;color:rgba(255,255,255,.9);font-size:.95rem;font-weight:500;transition:color .2s}
        .footer-contact a i{color:var(--signal);font-size:1.2rem;width:20px;text-align:center}
        .footer-contact a:hover{color:var(--amber)}
        .map{position:relative;height:190px;border-radius:var(--r-md);overflow:hidden;background:var(--ink-2)}
        .map iframe{width:100%;height:100%;border:0;pointer-events:none;filter:grayscale(.3) contrast(1.05);transition:filter .3s}
        .map-link{position:absolute;inset:0;z-index:2;display:flex;align-items:flex-end;justify-content:flex-end;padding:12px;border-radius:var(--r-md)}
        .map-link span{display:inline-flex;align-items:center;gap:8px;padding:8px 14px;border-radius:999px;background:var(--signal);color:#fff;font-size:.85rem;font-weight:700;box-shadow:0 8px 20px rgba(0,0,0,.35);transition:background .2s,transform .2s}
        .map-link:hover span,.map-link:focus-visible span{background:var(--signal-d);transform:translateY(-2px)}
        .map:hover iframe{filter:none}
        .find{margin-top:14px;display:inline-flex;align-items:center;gap:10px;font-weight:600;color:#fff;transition:color .2s,gap .2s}
        .find i{color:var(--signal)}
        .find:hover{color:var(--amber);gap:14px}
        .footer-links li+li{margin-top:8px}
        .footer-links a{display:flex;align-items:center;gap:10px;padding:6px 0;font-size:.95rem;transition:color .2s,gap .2s}
        .footer-links a i{font-size:.7rem;color:var(--signal)}
        .footer-links a:hover{color:#fff;gap:14px}
        .footer-bar{margin-top:clamp(40px,6vw,72px);padding-top:28px;border-top:1px solid rgba(255,255,255,.1);display:flex;flex-wrap:wrap;gap:20px;justify-content:space-between;align-items:center;font-size:.88rem}
        .social{display:flex;flex-wrap:wrap;gap:8px}
        .social a{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;background:rgba(255,255,255,.08);color:#fff;transition:background .2s,transform .2s}
        .social a:hover{background:var(--signal);transform:translateY(-3px)}
        @media (max-width:900px){.footer-grid{grid-template-columns:1fr}}

        /* ================= SOS ================= */
        .beacon{position:relative;width:10px;height:10px;border-radius:50%;background:#fff;flex:none}
        .beacon::after{content:"";position:absolute;inset:0;border-radius:50%;background:#fff;animation:ping 1.8s cubic-bezier(0,0,.2,1) infinite}
        @keyframes ping{0%{transform:scale(1);opacity:.7}100%{transform:scale(3.2);opacity:0}}
        .sos-fab{position:fixed;right:clamp(14px,3vw,28px);bottom:clamp(14px,3vw,28px);z-index:70;display:flex;flex-direction:column;align-items:flex-end;gap:12px;opacity:0;visibility:hidden;transform:translateY(16px);transition:opacity .3s,transform .3s,visibility .3s}
        .sos-fab.show{opacity:1;visibility:visible;transform:none}
        .sos-fab-btn{display:inline-flex;align-items:center;gap:10px;padding:14px 22px;border-radius:999px;background:var(--signal);color:#fff;font-weight:700;box-shadow:0 14px 30px -6px rgba(229,57,45,.6)}
        .sos-fab-btn:hover{background:var(--signal-d)}
        .sos-sheet{display:none;width:min(320px,calc(100vw - 28px));padding:8px;border-radius:20px;background:var(--ink);border:1px solid rgba(255,255,255,.12);box-shadow:0 24px 48px rgba(0,0,0,.45)}
        .sos-fab.open .sos-sheet{display:grid;gap:6px}
        .sos-sheet a{display:flex;align-items:center;gap:14px;padding:13px 14px;border-radius:14px;color:#fff;font-weight:600}
        .sos-sheet a:hover{background:rgba(255,255,255,.1)}
        .sos-sheet a i{width:22px;text-align:center;font-size:1.15rem}
        .sos-sheet .wa i{color:#25d366}.sos-sheet .tel i{color:#38bdf8}.sos-sheet .n112 i{color:#f87171}
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
<a href="/dashboard" title="Kembali ke Dashboard">
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

            <li class="has-drop">
                <button class="menu-trigger" type="button" aria-expanded="false">Sarpras <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="#">Sarana</a></li>
                    <li><a href="#">Prasarana</a></li>
                </ul>
            </li>

            <li class="has-drop current">
                <button class="menu-trigger" type="button" aria-expanded="false">Galeri <i class="fas fa-chevron-down"></i></button>
                <ul class="dropdown">
                    <li><a href="/ikm">IKM (Indeks Kepuasan Masyarakat)</a></li>
                    <li><a href="{{ route('pengumuman.index') }}" aria-current="page">Pengumuman</a></li>
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
                <li><a href="#">Galeri</a></li>
                <li><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                <li><span aria-current="page">Detail</span></li>
            </ol>
        </nav>
        <div class="hero-kicker rise"><i class="fas fa-bullhorn"></i> Pengumuman</div>
        <h1 class="h1-judul rise d1">{{ $pengumuman->judul }}</h1>
        <div class="hero-line rise d3"></div>
    </div>
</section>

<!-- ==================== BODY & KONTEN ==================== -->
<div class="page-body pg-page">
    <div class="wrap pg-detail">

        <article class="pg-article">
            <div class="pg-article-meta">
                @if($pengumuman->penting)<span class="tag tag-penting"><i class="fas fa-bullhorn"></i> Penting</span>@endif
                <span class="tag">{{ $pengumuman->kategori ?? 'UMUM' }}</span>
                <span class="pg-time"><i class="far fa-calendar-alt"></i> {{ $tgl_detail }}</span>
            </div>

            <!-- Bagian Teks Pengumuman -->
            <div class="pg-body">{!! nl2br(e($pengumuman->isi)) !!}</div>

            <!-- Bagian File Lampiran (Gambar atau Dokumen) -->
            @if(!empty($pengumuman->lampiran))
                <div class="pg-attachment-box">
                    <span class="pg-attachment-label"><i class="fas fa-paperclip"></i> Lampiran</span>
                    
                    @if(Str::endsWith(strtolower($pengumuman->lampiran), ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                        <!-- Tampilkan Gambar Langsung -->
                        <div class="pg-img-wrap">
                            <img src="{{ asset('storage/' . $pengumuman->lampiran) }}" alt="Lampiran {{ $pengumuman->judul }}" loading="lazy">
                        </div>
                    @else
                        <!-- Tampilkan Tombol Download Dokumen -->
                        <a class="pg-attach" href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank" rel="noopener">
                            <span class="pg-attach-ico"><i class="fas fa-file-arrow-down"></i></span>
                            <span>
                                <b>Unduh dokumen lampiran</b>
                                <small>Klik untuk melihat atau mengunduh berkas pengumuman</small>
                            </span>
                        </a>
                    @endif
                </div>
            @endif

            <a class="pg-back" href="{{ route('pengumuman.index') }}"><i class="fas fa-arrow-left"></i> Kembali ke daftar pengumuman</a>
        </article>

        @if($lainnya->count())
            <aside class="pg-side" aria-label="Pengumuman lainnya">
                <h3>Pengumuman lainnya</h3>
                @foreach($lainnya as $l)
                    <a href="{{ route('pengumuman.show', $l->id) }}">
                        <small>{{ \Carbon\Carbon::parse($l->tanggal ?? $l->created_at)->locale('id')->translatedFormat('d M Y') }} &middot; {{ $l->kategori ?? 'UMUM' }}</small>
                        <span>{{ $l->judul }}</span>
                    </a>
                @endforeach
            </aside>
        @endif
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

    function closeSubs(except) {
        subs.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                li.querySelector('.sub-trigger').setAttribute('aria-expanded', 'false');
            }
        });
    }

    function closeDrops(except) {
        drops.forEach(function (li) {
            if (li !== except) {
                li.classList.remove('open');
                li.querySelector('.menu-trigger').setAttribute('aria-expanded', 'false');
            }
        });
        if (!except) closeSubs(null);
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

    subs.forEach(function (li) {
        var btn = li.querySelector('.sub-trigger');
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            var open = li.classList.toggle('open');
            btn.setAttribute('aria-expanded', open);
            closeSubs(li);
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-drop')) closeDrops(null);
    });

    header.querySelectorAll('.dropdown a, .dropdown-sub a, .menu-link').forEach(function (a) {
        a.addEventListener('click', function () {
            header.classList.remove('nav-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.querySelector('i').className = 'fas fa-bars';
            closeDrops(null);
        });
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