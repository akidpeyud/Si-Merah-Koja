<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan - Program Kerja | SIMERAH KOJA</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f3f4f6;
            color: #1f2937;
        }

        /* --- NAVBAR STYLES --- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #111827;
            border-bottom: 4px solid #ef4444;
            position: relative;
            z-index: 999;
        }
        .nav-logos { display: flex; gap: 15px; align-items: center; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; margin-bottom: 0; padding-left: 0; }
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
        
        /* DROPDOWN CUSTOM TEMA GELAP */
        .dropdown-menu-custom {
            display: none; position: absolute; top: 100%; left: 0; background-color: #1f2937;
            min-width: 220px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border-radius: 8px;
            overflow: hidden; z-index: 10; margin-top: 0; border: 1px solid #374151; padding: 0;
        }
        .dropdown-custom:hover .dropdown-menu-custom { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu-custom li { list-style: none; padding-bottom: 0; margin-bottom: 0; }
        .dropdown-menu-custom li a {
            color: #e5e7eb; padding: 14px 20px; display: block; font-size: 13px;
            border-bottom: 1px solid #374151; font-weight: 600;
        }
        .dropdown-menu-custom li a:hover { background-color: #374151; color: #ef4444; padding-left: 26px; }

        /* --- PAGE HEADER --- */
        .page-header {
            position: relative;
            background-image: linear-gradient(rgba(11, 15, 25, 0.8), rgba(11, 15, 25, 0.95)), url('/images/background1.jpg');
            background-size: cover;
            background-position: center;
            padding: 50px 0;
            text-align: center;
            color: white;
            border-bottom: 4px solid #ef4444;
        }
        .page-header h1 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .breadcrumb-custom {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            font-weight: 600;
        }
        .breadcrumb-custom span {
            color: #ef4444;
        }
        .breadcrumb-custom a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s;
        }
        .breadcrumb-custom a:hover { color: #ffffff; }

        /* --- MAIN CONTENT --- */
        .main-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            padding: 30px; 
            margin-top: 40px; 
            margin-bottom: 60px;
        }

        /* --- HORIZONTAL TABS --- */
        .custom-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px; 
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 20px;
        }
        .custom-tabs .nav-link {
            color: #6b7280;
            font-weight: 700;
            font-size: 13px;
            padding: 10px 24px;
            border-radius: 50px;
            background-color: #f3f4f6;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .custom-tabs .nav-link:hover {
            color: #111827;
            background-color: #e5e7eb;
        }
        .custom-tabs .nav-link.active {
            color: #ffffff !important;
            background-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        .custom-tabs .nav-link i {
            margin-right: 6px;
            font-size: 14px;
        }

        /* --- CONTACT WIDGET --- */
        .contact-widget {
            background-color: #f8fafc; 
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e5e7eb;
            height: 100%; 
        }
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .contact-item i {
            color: #ef4444;
            font-size: 18px;
            margin-top: 2px;
            width: 30px;
        }
        .contact-item h6 {
            margin: 0 0 5px 0;
            font-weight: 700;
            color: #111827;
            font-size: 14px;
        }
        .contact-item p {
            margin: 0;
            font-size: 13px;
            color: #4b5563; 
            line-height: 1.5;
        }
        
        /* Updated Social Links (1 Baris) */
        .social-links {
            display: flex;
            flex-wrap: nowrap;
            gap: 6px; 
            margin-top: 25px;
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; 
            height: 32px;
            font-size: 13px;
            background-color: #ffffff;
            color: #6b7280;
            border-radius: 50%;
            border: 1px solid #e5e7eb;
            text-decoration: none;
            transition: all 0.3s;
        }
        .social-links a:hover {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
            transform: translateY(-3px);
        }

        /* --- PDF CARD STYLING --- */
        .pdf-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            text-decoration: none;
            text-align: center;
            padding: 30px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            width: 100%;
            max-width: 400px;
        }

        .pdf-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: #cbd5e1;
        }

        .pdf-card img {
            width: 80px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.05));
            transition: transform 0.3s ease;
        }

        .pdf-card:hover img {
            transform: scale(1.08);
        }

        .pdf-card h3 {
            font-size: 15px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.5;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: color 0.3s ease;
        }

        .pdf-card:hover h3 {
            color: #ef4444;
        }

        /* --- FOOTER STYLES --- */
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
        .footer-map-container img { width: 100%; height: 100%; object-fit: cover;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        .footer-download p { font-size: 12px; color: #ef4444; margin-bottom: 10px; }
        .footer-download img { height: 40px; cursor: pointer;}
        
        .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-links ul { list-style: none; padding-left: 0;}
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
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    ?>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="nav-logos" style="text-decoration: none;">
            <img src="/images/jambi.png" alt="Logo Pemkot">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>
        
        <ul class="nav-links">
            <!-- Dropdown Kedaruratan -->
            <li class="dropdown-custom">
                <a href="#">Layanan Kedaruratan <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu-custom">
                    <li><a href="https://wa.me/<?php echo $no_whatsapp; ?>?text=<?php echo $pesan_wa; ?>" target="_blank">WHATSAPP</a></li>
                    <li><a href="tel:<?php echo $no_telepon; ?>">TELEPHONE</a></li>
                    <li><a href="tel:112">CALL CENTER 112</a></li>
                </ul>
            </li>

            <!-- Dropdown Program Kerja -->
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

            <!-- Dropdown Layanan & Fasilitas -->
            <li class="dropdown-custom">
                <a href="#">Layanan & Fasilitas <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu-custom">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">LAYANAN PERIZINAN</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">EDUKASI DAN SOSIALISASI</a></li>
                    <li><a href="/layanan-fasilitas/pks">PKS</a></li>
                    <li><a href="/layanan-fasilitas/skk">SKK</a></li>
                    <li><a href="/layanan-fasilitas/perpanjang_skk">PERPANJANG SKK</a></li>
                    <li><a href="/layanan-fasilitas/izin_penjualan">IZIN PENJUALAN</a></li>
                </ul>
            </li>

            <!-- Tombol Redkar -->
            <li><a href="/redkar">Redkar</a></li>

            <!-- Tombol Login -->
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>PROGRAM KERJA</h1>
            <div class="breadcrumb-custom mt-2">
                <a href="/">Home</a> 
                <i class="fas fa-angle-double-right mx-2" style="font-size: 10px; color: #9ca3af;"></i> 
                <span>PROGRAM KERJA</span>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="container">
        <div class="main-container">
            
            <!-- Horizontal Tabs Navigation -->
            <ul class="nav custom-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="/sotk">
                        <i class="fas fa-folder"></i> SOTK
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sop">
                        <i class="fas fa-folder"></i> SOP
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/perencanaan">
                        <i class="fas fa-folder"></i> PERENCANAAN
                    </a>
                </li>
                <!-- TAB PELAPORAN ACTIVE -->
                <li class="nav-item">
                    <a class="nav-link active" href="/pelaporan">
                        <i class="fas fa-folder-open"></i> PELAPORAN
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/produkhukum">
                        <i class="fas fa-folder"></i> PRODUK HUKUM
                    </a>
                </li>
            </ul>

            <!-- Grid Layout (Contact Info + PDF List) -->
            <div class="row g-4 align-items-stretch">
                
                <!-- Kiri: Widget Kontak -->
                <div class="col-lg-4 col-xl-3">
                    <div class="contact-widget position-sticky" style="top: 100px;">
                        <!-- EMAIL RESMI -->
                        <div class="contact-item">
                            <i class="fas fa-envelope-open-text"></i>
                            <div>
                                <h6>Email Resmi</h6>
                                <p><a href="mailto:damkar.jbi@gmail.com" style="color: #4b5563; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#4b5563'">damkar.jbi@gmail.com</a></p>
                            </div>
                        </div>
                        <!-- ALAMAT -->
                        <div class="contact-item mb-0">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h6>Alamat Kantor</h6>
                                <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru</p>
                            </div>
                        </div>
                        
                        <!-- SOSIAL MEDIA LINKS -->
                        <div class="social-links">
                            <a href="mailto:damkar.jbi@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
                            <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                            <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Daftar PDF Centered -->
                <div class="col-lg-8 col-xl-9 d-flex justify-content-center align-items-start pt-3">
                    
                    <!-- File PDF Laporan Kinerja -->
                    <a href="#" target="_blank" class="pdf-card">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF Icon">
                        <h3>Laporan Kinerja Instansi Pemerintah (LKjIP) 2022</h3>
                    </a>

                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
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
                <div class="footer-download">
                    <p>Download Aplikasi SIMERAH KOJA :</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play">
                </div>
            </div>
            
            <div class="footer-links">
                <h3>Link Terkait</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-angle-double-right"></i> Official Damkar</a></li>
                    <li><a href="#"><i class="fas fa-angle-double-right"></i> Website Jambikota</a></li>
                    <li><a href="#"><i class="fas fa-angle-double-right"></i> SIKOJA</a></li>
                    <li><a href="#"><i class="fas fa-angle-double-right"></i> 112 Kota Jambi</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-copyright">
            <div>SIMERAHKOJA © 2026 / ALL RIGHTS RESERVED</div>
            <!-- FOOTER SOCIAL LINKS -->
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

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>