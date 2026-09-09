<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMERAH KOJA - Kota Jambi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- STYLES DARI HEADER --- */
        .hero-section {
            position: relative;
            min-height: 100vh;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            z-index: 1; 
        }
        
        /* Layer Background 1 */
        .hero-section::before,
        .hero-section::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-size: cover;
            background-position: center;
            z-index: -1; 
        }
        
        .hero-section::before {
            background-image: linear-gradient(rgba(11, 15, 25, 0.75), rgba(11, 15, 25, 0.9)), url('/images/background1.jpg');
        }

        /* Layer Background 2 (Animasi Ketukar) */
        .hero-section::after {
            background-image: linear-gradient(rgba(11, 15, 25, 0.75), rgba(11, 15, 25, 0.9)), url('/images/background2.jpeg');
            animation: gantiBackground 9s infinite; 
        }

        @keyframes gantiBackground {
            0%, 40% { opacity: 0; }     
            50%, 90% { opacity: 1; }    
            100% { opacity: 0; }        
        }

        /* --- NAVBAR STICKY --- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #111827; 
            border-bottom: 4px solid #ef4444;
            position: sticky; 
            top: 0;
            z-index: 9999; 
        }
        .nav-logos { display: flex; gap: 15px; align-items: center; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; }
        .nav-links li { position: relative; padding-bottom: 15px; margin-bottom: -15px; }
        .nav-links a {
            color: #f8fafc; text-decoration: none; font-weight: 700; font-size: 13px;
            text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;
        }
        .nav-links a:hover { color: #ef4444; }
        .nav-links .btn-login {
            background-color: #ef4444; color: #ffffff; padding: 8px 24px; border-radius: 50px; margin-left: 10px;
        }
        .nav-links .btn-login:hover { background-color: #dc2626; color: #ffffff; }
        
        /* Dropdown Menu */
        .dropdown-menu {
            display: none; position: absolute; top: 100%; left: 0; 
            background-color: #111827; 
            min-width: 220px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); 
            border-radius: 0 0 8px 8px; 
            overflow: hidden; z-index: 10; margin-top: 0; 
            border: 1px solid #1f293b;
            border-top: none; 
        }
        .dropdown:hover .dropdown-menu { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu li { list-style: none; padding-bottom: 0; margin-bottom: 0; }
        .dropdown-menu li a {
            color: #e5e7eb; padding: 14px 20px; display: block; font-size: 13px;
            border-bottom: 1px solid #1f293b; font-weight: 600;
        }
        .dropdown-menu li:last-child a { border-bottom: none; }
        .dropdown-menu li a:hover { background-color: #1f293b; color: #ef4444; padding-left: 26px; }
        
        .main-content {
            flex-grow: 1; display: flex; flex-direction: column; align-items: center;
            justify-content: center; text-align: center; padding: 20px; margin-top: -20px;
        }
        .center-logos { display: flex; gap: 25px; margin-bottom: 25px; }
        .center-logos img { height: 90px; filter: drop-shadow(0px 8px 12px rgba(0,0,0,0.3)); transition: transform 0.4s; }
        .center-logos img:hover { transform: translateY(-5px); }
        .title-simerah {
            font-size: 5rem; font-weight: 800; background: linear-gradient(135deg, #ffffff, #d1d5db);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin: 0 0 15px 0;
            letter-spacing: 2px; filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.4));
        }
        .subtitle {
            font-size: 1.15rem; font-weight: 500; color: #cbd5e1; max-width: 700px;
            margin-bottom: 50px; line-height: 1.7;
        }
        
        /* --- TOMBOL DARURAT INTERAKTIF --- */
        .emergency-btn-container { position: relative; display: inline-block; z-index: 10; }
        
        .btn-darurat {
            display: flex; flex-direction: column; align-items: center; justify-content: center; 
            width: 150px; height: 150px;
            background: radial-gradient(circle, #ff5f5f, #dc2626); 
            color: white; border: 6px solid #111827; border-radius: 50%;
            text-decoration: none; font-weight: 800; font-size: 14px; text-align: center;
            line-height: 1.3; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.6);
            cursor: pointer; transition: all 0.3s ease;
            position: relative;
        }

        /* Efek Gelombang Sinyal (Sonar) */
        .btn-darurat::before, .btn-darurat::after {
            content: ''; position: absolute;
            top: -6px; left: -6px; right: -6px; bottom: -6px;
            border-radius: 50%; border: 3px solid #ef4444;
            animation: sinyalDarurat 2s linear infinite;
            pointer-events: none; 
        }
        .btn-darurat::after { animation-delay: 1s; }

        @keyframes sinyalDarurat {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.6); opacity: 0; }
        }

        /* Bergetar Cepat saat di-hover */
        .btn-darurat:hover {
            background: radial-gradient(circle, #ef4444, #991b1b);
            animation: getarDarurat 0.3s cubic-bezier(.36,.07,.19,.97) both infinite;
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.8);
        }

        @keyframes getarDarurat {
            0%, 100% { transform: rotate(0) scale(1.05); }
            25% { transform: rotate(3deg) scale(1.05); }
            50% { transform: rotate(-3deg) scale(1.05); }
            75% { transform: rotate(3deg) scale(1.05); }
        }
        
        /* Ikon berkedip di dalam tombol */
        .icon-darurat {
            font-size: 26px; margin-bottom: 5px;
            animation: kedipIkon 1s infinite alternate;
        }
        @keyframes kedipIkon {
            0% { opacity: 0.7; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1.1); text-shadow: 0 0 10px white; }
        }

        /* --- POPUP MENU (Animasi Memantul/Bounce) --- */
        .emergency-popup {
            visibility: hidden; opacity: 0; position: absolute; bottom: 140%; left: 50%;
            transform: translateX(-50%) scale(0.7); transform-origin: bottom center;
            background-color: #1f2937; min-width: 220px; border-radius: 12px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.6); z-index: 100; text-align: left; 
            border: 1px solid #374151; padding: 10px;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); 
        }
        
        .emergency-btn-container:hover .emergency-popup {
            visibility: visible; opacity: 1; 
            transform: translateX(-50%) scale(1); bottom: 115%;
        }
        
        .emergency-popup a {
            display: flex; align-items: center; padding: 12px 16px; text-decoration: none;
            font-weight: 700; font-size: 13px; border-radius: 8px; color: #e5e7eb;
            margin-bottom: 5px; transition: all 0.2s ease; position: relative; overflow: hidden;
        }
        .emergency-popup a:last-child { margin-bottom: 0; }
        .emergency-popup a i { margin-right: 12px; font-size: 18px; z-index: 2;}
        .emergency-popup a span { z-index: 2; }
        
        .text-wa:hover { background-color: #064e3b; color: #34d399; transform: translateX(5px); }
        .text-telp:hover { background-color: #0c4a6e; color: #38bdf8; transform: translateX(5px); }
        .text-112:hover { background-color: #7f1d1d; color: #f87171; transform: translateX(5px); }
        
        .text-wa i { color: #22c55e; }
        .text-telp i { color: #0ea5e9; }
        .text-112 i { color: #ef4444; }
        
        .emergency-popup::after {
            content: ""; position: absolute; top: 100%; left: 50%; margin-left: -8px;
            border-width: 8px; border-style: solid; border-color: #1f2937 transparent transparent transparent;
        }

        /* --- STYLES UNTUK KONTEN DI BAWAH --- */
        .section-container {
            padding: 80px 5%;
            background-color: #ffffff;
            color: #1f2937;
        }
        .section-title-wrap {
            text-align: center;
            margin-bottom: 60px;
        }
        .section-subtitle {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .section-title {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
        }
        .section-title span { color: #ef4444; }
        .section-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
        .section-divider::before, .section-divider::after {
            content: ""; height: 1px; width: 40px; background-color: #d1d5db;
        }
        .section-divider i {
            color: #ef4444; font-size: 8px; margin: 0 10px;
        }

        /* Section 1: Tentang */
        .about-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1100px;
            margin: 0 auto;
            gap: 50px;
        }
        .about-text {
            flex: 1;
            text-align: left;
        }
        .about-text .section-title-wrap { text-align: left; margin-bottom: 30px; }
        .about-text .section-divider { justify-content: flex-start; }
        .about-text p {
            color: #4b5563;
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 20px;
        }
        .about-quote {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #ef4444;
            position: relative;
        }
        .about-quote h3 {
            font-size: 24px;
            font-style: italic;
            color: #9ca3af;
            font-weight: 700;
            line-height: 1.4;
        }
        .about-quote p {
            font-size: 14px;
            color: #1f2937;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
            font-weight: 600;
        }
        .about-quote .quote-icon {
            position: absolute;
            bottom: -20px;
            right: 20px;
            color: #ef4444;
            font-size: 40px;
            background: #ffffff;
            padding: 0 10px;
        }
        .about-image {
            flex: 1;
            text-align: center;
        }
        .about-image img { width: 100%; max-width: 400px; }

        /* Section 2: Layanan & Fasilitas */
        .layanan-section {
            background-color: #f8fafc; 
        }
        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .layanan-card {
            display: block; 
            text-decoration: none; 
            color: inherit;
            background: #ffffff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .layanan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }
        .layanan-icon {
            width: 60px; height: 60px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 30px; color: white;
            margin-bottom: 20px;
        }
        
        .icon-gray { background: #9ca3af; }
        .icon-pink { background: #ec4899; }
        .icon-orange { background: #f97316; }
        .icon-purple { background: #8b5cf6; }
        .icon-red { background: #ef4444; }
        .icon-yellow { background: #eab308; }
        .icon-blue { background: #3b82f6; }
        
        .layanan-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 10px; }
        .layanan-card p { font-size: 13px; color: #6b7280; line-height: 1.6; }

        /* =======================================================================
           SECTION 3: KEJADIAN & EVAKUASI (DI-UPDATE DENGAN DESAIN KARTU MODERN) 
           ======================================================================= */
        .kejadian-section {
            max-width: 1200px; margin: 0 auto;
        }
        .kejadian-header-img {
            text-align: center; margin-bottom: 30px;
        }
        .kejadian-header-img img { max-width: 300px; }
        
        .kejadian-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .kejadian-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .kejadian-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .kejadian-thumb {
            position: relative;
            width: 100%;
            height: 220px;
            background-color: #e2e8f0;
        }
        .kejadian-thumb img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .kejadian-placeholder {
            width: 100%; height: 100%; display: flex; flex-direction: column;
            align-items: center; justify-content: center; background: #f8fafc; color: #94a3b8;
        }
        .kejadian-placeholder i { font-size: 45px; margin-bottom: 10px; color: #cbd5e1; }
        
        .kejadian-date-badge {
            position: absolute;
            top: 15px; left: 15px;
            color: white;
            padding: 8px 15px; border-radius: 10px;
            text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            line-height: 1;
        }
        .kejadian-date-badge span:first-child { font-size: 22px; font-weight: 800; display: block; margin-bottom: 2px;}
        .kejadian-date-badge span:last-child { font-size: 11px; text-transform: uppercase; font-weight: 700;}
        
        .kejadian-content {
            padding: 25px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .kejadian-content h3 { 
            font-size: 18px; font-weight: 800; color: #111827; margin-bottom: 15px; line-height: 1.4; 
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .kejadian-content .meta { font-size: 13px; color: #6b7280; margin-bottom: 15px; display: flex; flex-direction: column; gap: 8px; }
        .kejadian-content .meta div { display: flex; align-items: flex-start; gap: 8px; }
        .kejadian-content .meta i { color: #ef4444; margin-top: 3px; }
        .kejadian-content p { font-size: 14px; color: #4b5563; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;}
        .kejadian-content a { 
            font-size: 14px; color: #ef4444; text-decoration: none; font-weight: 700; 
            display: inline-flex; align-items: center; gap: 5px; transition: gap 0.3s;
        }
        .kejadian-content a:hover { gap: 10px; color: #dc2626; }

        /* Section 4: Video Edukasi */
        .video-section {
            background-color: #7f1d1d; 
            color: white;
        }
        .video-section .section-title, .video-section .section-subtitle { color: white; }
        .video-section .section-divider::before, .video-section .section-divider::after { background-color: rgba(255,255,255,0.3); }
        .video-section .section-divider i { color: white; }
        
        .video-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .video-card {
            position: relative;
            background: #000;
            border: 4px solid #ffffff;
            aspect-ratio: 16/9;
            overflow: hidden;
            border-radius: 4px;
        }
        .video-card img {
            width: 100%; height: 100%; object-fit: cover; opacity: 0.7; transition: opacity 0.3s;
        }
        .video-card:hover img { opacity: 0.4; }
        .video-play-btn {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            color: white; font-size: 40px;
            cursor: pointer; transition: transform 0.3s;
        }
        .video-card:hover .video-play-btn { transform: translate(-50%, -50%) scale(1.1); }

        /* Section 5: Info Grafis & Berita Medsos */
        .grafis-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .grafis-card {
            border-radius: 8px; overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .grafis-card img { width: 100%; display: block; }
        
        .berita-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1100px;
            margin: 80px auto 0;
        }
        .berita-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        .berita-card img { width: 100%; aspect-ratio: 4/3; object-fit: cover; }
        .berita-content { padding: 20px; }
        .berita-content h3 { font-size: 15px; font-weight: 700; margin-bottom: 10px; line-height: 1.4; color: #1f2937; }
        .berita-meta { font-size: 11px; color: #9ca3af; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .berita-meta i { color: #6b7280; }
        .berita-footer {
            border-top: 1px solid #f3f4f6;
            padding-top: 15px; text-align: right;
        }
        .berita-footer a { font-size: 12px; color: #9ca3af; text-decoration: none; font-weight: 600; }
        .berita-footer a:hover { color: #ef4444; }

        /* Section 6: Giat Disdamkartan */
        .giat-section {
            background-color: #0b0f19;
            color: white;
            padding: 80px 5%;
        }
        .giat-container {
            display: flex;
            max-width: 1000px;
            margin: 0 auto;
            align-items: center;
            gap: 60px;
        }
        .giat-image { flex: 1; text-align: center; }
        .giat-image img { max-width: 300px; }
        .giat-content { flex: 1; }
        .giat-content h2 { font-size: 32px; font-weight: 800; margin-bottom: 10px; line-height: 1.2; }
        .giat-content .section-divider { justify-content: flex-start; margin-bottom: 40px; }
        
        .giat-list { display: flex; flex-direction: column; gap: 30px; }
        .giat-item { display: flex; gap: 20px; border-bottom: 1px solid #1f2937; padding-bottom: 30px; }
        .giat-item:last-child { border-bottom: none; padding-bottom: 0; }
        .giat-date {
            background: #ef4444; color: white;
            min-width: 70px; height: 70px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            border-radius: 8px; font-weight: 800;
        }
        .giat-date span:first-child { font-size: 24px; line-height: 1; }
        .giat-date span:last-child { font-size: 12px; text-transform: uppercase; }
        .giat-text h3 { font-size: 16px; font-weight: 700; margin-bottom: 10px; line-height: 1.4;}
        .giat-text p { font-size: 12px; color: #9ca3af; line-height: 1.6; margin-bottom: 15px;}
        .giat-text a { font-size: 11px; color: #6b7280; text-decoration: none; font-weight: 600; }
        .giat-text a:hover { color: #ffffff; }

        /* Footer Bawah */
        .footer-bottom {
            background-color: #1a1a1a;
            color: #9ca3af;
            padding: 50px 5%;
            font-size: 13px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr 1fr;
            gap: 40px;
            max-width: 1100px;
            margin: 0 auto 40px;
        }
        .footer-logo { text-align: center; }
        .footer-logo img { height: 120px; margin-bottom: 15px; }
        .footer-about h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-about p { line-height: 1.8; font-size: 12px; margin-bottom: 20px;}
        
        .footer-map-container { position: relative; width: 100%; height: 120px; background: #333; border-radius: 8px; overflow: hidden; margin-bottom: 15px;}
        .footer-map-container iframe { width: 100%; height: 100%; border: none;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        
        .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #9ca3af; text-decoration: none; transition: color 0.3s; display: flex; align-items: center; gap: 10px;}
        .footer-links a i { font-size: 10px; color: #4b5563;}
        .footer-links a:hover { color: white; }

        .footer-copyright {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
            padding-top: 20px;
            border-top: 1px solid #333;
        }
        .footer-social { display: flex; gap: 5px; }
        .footer-social a {
            width: 35px; height: 35px; background: #333; color: white; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; transition: background 0.3s;
        }
        .footer-social a:hover { background: #ef4444; }

    </style>
</head>
<body>

    <?php
        $no_whatsapp = "628117113113"; 
        $no_telepon  = "074141171";
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    ?>

    <!-- NAVBAR TEMA GELAP -->
    <nav class="navbar">
        <div class="nav-logos">
            <img src="/images/jambi.png" alt="Logo Pemkot">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </div>
        <ul class="nav-links">
            <li class="dropdown">
                <a href="#">Layanan Kedaruratan <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="https://wa.me/<?php echo $no_whatsapp; ?>?text=<?php echo $pesan_wa; ?>" target="_blank">WHATSAPP</a></li>
                    <li><a href="tel:<?php echo $no_telepon; ?>">TELEPHONE</a></li>
                    <li><a href="tel:112">CALL CENTER 112</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Program Kerja <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="/sotk">SOTK</a></li>
                    <li><a href="/perencanaan">PERENCANAAN</a></li>
                    <li><a href="/pelaporan">PELAPORAN</a></li>
                    <li><a href="/sop">SOP</a></li>
                    <li><a href="/produkhukum">PRODUK HUKUM</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Layanan & Fasilitas <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
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

    <!-- ==========================================
         SECTION 3: KEJADIAN & EVAKUASI (UPDATED)
         ========================================== -->
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
                <div class="kejadian-card">
                    <!-- Thumbnail Gambar -->
                    <div class="kejadian-thumb">
                        <!-- Kotak Tanggal Merah -->
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

                    <!-- Detail Berita -->
                    <div class="kejadian-content">
                        <h3>{{ $berita->judul }}</h3>
                        
                        <div class="meta">
                            <div title="Lokasi">
                                <i class="fas fa-map-marker-alt"></i> 
                                <span>{{ Str::limit($berita->lokasi, 40) }}</span>
                            </div>
                            <div title="Waktu Laporan">
                                <i class="far fa-clock"></i> 
                                <span>{{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }} WIB - Pelapor: {{ $berita->pelapor }}</span>
                            </div>
                        </div>
                        
                        <p>{{ Str::limit($berita->keterangan_singkat ?? $berita->detail_lengkap, 90) }}</p>
                        
                        <a href="/berita/{{ $berita->id }}">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <!-- Fallback Jika Kosong -->
                <div class="text-muted w-100" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 40px;"></i>
                    <h5 class="fw-bold">Belum ada informasi kejadian terbaru</h5>
                </div>
            @endforelse
        </div>
    </div>
    <!-- ========================================== -->

    <!-- SECTION 4: VIDEO EDUKASI -->
    <div class="section-container video-section">
        <div class="section-title-wrap">
            <div class="section-subtitle">Kami memberi Anda tindakan praktis, saran, dan sumber daya.</div>
            <h2 class="section-title">Video Edukasi</h2>
            <div class="section-divider"><i class="fas fa-circle"></i></div>
        </div>

        <div class="video-grid">
            <div class="video-card">
                <img src="https://via.placeholder.com/300x170/333333/ffffff?text=Thumbnail+Video+1" alt="Video Edukasi">
                <i class="far fa-play-circle video-play-btn"></i>
            </div>
            <div class="video-card">
                <img src="https://via.placeholder.com/300x170/333333/ffffff?text=Thumbnail+Video+2" alt="Video Edukasi">
                <i class="far fa-play-circle video-play-btn"></i>
            </div>
            <div class="video-card">
                <img src="https://via.placeholder.com/300x170/333333/ffffff?text=Thumbnail+Video+3" alt="Video Edukasi">
                <i class="far fa-play-circle video-play-btn"></i>
            </div>
            <div class="video-card">
                <img src="https://via.placeholder.com/300x170/333333/ffffff?text=Thumbnail+Video+4" alt="Video Edukasi">
                <i class="far fa-play-circle video-play-btn"></i>
            </div>
        </div>
    </div>

    <!-- SECTION 5: INFO GRAFIS & BERITA MEDIA SOSIAL -->
    <div class="section-container">
        <!-- Info Grafis -->
        <div class="section-title-wrap">
            <h2 class="section-title">Info <span>Grafis</span></h2>
            <div class="section-divider"><i class="fas fa-circle"></i></div>
        </div>
             
        <div class="grafis-grid">
            @forelse($daftar_infografis ?? [] as $info)
                <div class="grafis-card">
                    <img src="{{ asset('storage/' . $info->gambar) }}" alt="{{ $info->judul ?? 'Infografis' }}">
                </div>
            @empty
                <div class="text-muted text-center w-100" style="grid-column: 1/-1;">Belum ada infografis yang diunggah.</div>
            @endforelse
        </div>
                <!-- Berita Media Sosial -->
        <div class="section-title-wrap" style="margin-top: 100px;">
            <h2 class="section-title">BERITA <span>MEDIA SOSIAL</span></h2>
            <div class="section-divider"><i class="fas fa-circle"></i></div>
        </div>
        
        <div class="berita-grid">
            @forelse($daftar_medsos ?? [] as $medsos)
                <div class="berita-card">
                    <img src="{{ asset('storage/' . $medsos->gambar) }}" alt="{{ $medsos->judul }}">
                    <div class="berita-content">
                        <h3>{{ $medsos->judul }}</h3>
                        <div class="berita-meta">
                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($medsos->tanggal)->format('d M Y H:i') }}
                            <span>|</span>
                            <i class="fab fa-instagram"></i> Sumber: {{ $medsos->sumber }}
                        </div>
                        <div class="berita-footer">
                            <a href="{{ $medsos->link ?? '#' }}" target="_blank">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-muted text-center w-100" style="grid-column: 1/-1;">Belum ada berita media sosial yang diunggah.</div>
            @endforelse
        </div>
    </div>

    <!-- SECTION 6: GIAT DISDAMKARTAN -->
    <div class="giat-section">
        <div class="giat-container">
            <div class="giat-image">
                <img src="/images/damkar.png" alt="damkar">
            </div> 
            
            <div class="giat-content">
                <h2>GIAT DISDAMKARTAN<br>KOTA JAMBI</h2>
                <div class="section-divider"><i class="fas fa-circle"></i></div>
                
                <div class="giat-list">
                    <div class="giat-item">
                        <div class="giat-date">
                            <span>13</span>
                            <span>Jul</span>
                        </div>
                        <div class="giat-text">
                            <h3>Bapak Walikota Jambi memberikan Bantuan Kepada Korban Kebakaran & Bencana Alam</h3>
                            <p>Pada hari Kamis Tanggal 07 Juli 2022 Pukul 15.30 WIB sampai dengan selesai di Dinas Pemadam Kebakaran Kota Jambi. Bapak Walikota Jambi di dampingi Kepala Disdamkar.</p>
                            <a href="#">Selengkapnya</a>
                        </div>
                    </div>
                    
                    <div class="giat-item">
                        <div class="giat-date">
                            <span>9</span>
                            <span>Nov</span>
                        </div>
                        <div class="giat-text">
                            <h3>Kegiatan Peningkatan Kapasitas Aparatur Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</h3>
                            <p>Kegiatan Peningkatan Kapasitas Aparatur Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi dengan Materi Tentang Penyelamatan Beda Ketinggian/Evakuasi Korban.</p>
                            <a href="#">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 7: FOOTER -->
    <div class="footer-bottom">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
                </div>
                <h3>Tentang Kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
            </div>
            
            <div class="footer-contact">
                <div class="footer-map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
                <div class="footer-find">
                    <i class="fas fa-map-marker-alt"></i> Find us on Map
                </div>
            </div>
            
            <div class="footer-links">
                <h3>Link Terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-copyright">
            <div>SIMERAHKOJA © 2026 / ALL RIGHTS RESERVED</div>
            <div class="footer-social">
                <a href="mailto:damkar.jbi@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div> 

</body>
</html>