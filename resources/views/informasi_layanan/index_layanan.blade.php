<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Layanan & Fasilitas - SIMERAH KOJA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f1f5f9; color: #1e293b; }

        /* --- NAVBAR TEMA GELAP --- */
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 50px; background-color: #0f172a; 
            border-bottom: 4px solid #ef4444; position: sticky; top: 0; z-index: 9999; 
        }
        .nav-logos { display: flex; gap: 15px; align-items: center; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; margin: 0;}
        .nav-links li { position: relative; padding-bottom: 15px; margin-bottom: -15px; }
        .nav-links a { color: #f8fafc; text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; }
        .nav-links a:hover, .nav-links a.active { color: #ef4444; }
        .nav-links .btn-login { background-color: #ef4444; color: #ffffff; padding: 8px 24px; border-radius: 50px; margin-left: 10px; }
        .nav-links .btn-login:hover { background-color: #dc2626; color: #ffffff; }

        .dropdown-menu {
            display: none; position: absolute; top: 100%; left: 0; background-color: #0f172a; 
            min-width: 220px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border-radius: 0 0 8px 8px; 
            overflow: hidden; z-index: 10; margin-top: 0; border: 1px solid #1e293b; border-top: none; padding: 0;
        }
        .dropdown:hover .dropdown-menu { display: block; animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu li { list-style: none; padding-bottom: 0; margin-bottom: 0; }
        .dropdown-menu li a { color: #cbd5e1; padding: 14px 20px; display: block; font-size: 13px; border-bottom: 1px solid #1e293b; font-weight: 600; margin: 0;}
        .dropdown-menu li:last-child a { border-bottom: none; }
        .dropdown-menu li a:hover { background-color: #1e293b; color: #ef4444; padding-left: 26px; }

        /* --- HERO SECTION --- */
        .page-hero {
            background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('/images/background1.jpg');
            background-size: cover; background-position: center; padding: 80px 20px;
            text-align: center; color: white; border-bottom: 4px solid #ef4444;
        }
        .page-hero h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 15px; letter-spacing: 1px; text-transform: uppercase; }
        .breadcrumb { font-size: 13px; font-weight: 600; color: #cbd5e1; justify-content: center; margin-bottom: 0;}
        .breadcrumb a { color: #38bdf8; text-decoration: none; transition: 0.3s; }
        .breadcrumb a:hover { color: #bae6fd; text-decoration: underline; }
        .breadcrumb span { color: #ef4444; margin: 0 5px;}
        .breadcrumb .active { color: #ef4444; }

        /* --- LAYOUT UTAMA --- */
        .content-wrapper { max-width: 1400px; margin: 50px auto 80px; display: flex; gap: 30px; padding: 0 20px; min-height: 50vh; }

        /* --- SIDEBAR KIRI --- */
        .sidebar { width: 300px; flex-shrink: 0; }
        .sidebar-title { font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 5px; text-transform: uppercase; }
        .decor-line { display: flex; align-items: center; margin-bottom: 25px; }
        .decor-line::before { content: ""; height: 3px; width: 40px; background: #ef4444; border-radius: 5px;}
        .decor-line i { color: #ef4444; font-size: 6px; margin: 0 8px; }
        .decor-line::after { content: ""; height: 3px; width: 15px; background: #ef4444; border-radius: 5px;}

        .public-accordion { width: 100%; background: white; border-radius: 12px; padding: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        .public-accordion-item { border-bottom: 1px dashed #cbd5e1; margin-bottom: 8px; padding-bottom: 5px; }
        .public-accordion-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        
        .public-accordion-btn { 
            background: none; border: none; width: 100%; text-align: left; font-size: 13px; 
            font-weight: 800; color: #475569; letter-spacing: 0.5px; cursor: pointer; 
            display: flex; justify-content: space-between; align-items: center; padding: 12px 10px; transition: 0.3s; border-radius: 8px;
        }
        .public-accordion-btn:hover { color: #0f172a; background-color: #f8fafc; }
        .public-accordion-btn.active { color: #ef4444; background-color: #fef2f2;}
        
        .public-submenu { list-style: none; padding-left: 5px; margin-top: 5px; margin-bottom: 10px; display: none; }
        .public-submenu.show { display: block; animation: fadeIn 0.3s ease; }
        .public-submenu li a { 
            color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 12px; padding: 10px 15px; 
            transition: all 0.2s; border-radius: 8px; margin-bottom: 4px;
        }
        .public-submenu li a i { font-size: 16px; color: #cbd5e1; width: 20px; text-align: center; transition: 0.2s;}
        .public-submenu li a:hover { background-color: #f1f5f9; color: #0f172a; }
        .public-submenu li a:hover i { color: #ef4444; }
        .public-submenu li a.active { background-color: #ef4444; color: white; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2); }
        .public-submenu li a.active i { color: white; }

        /* --- KONTEN KANAN (AREA LANDING) --- */
        .data-container { flex-grow: 1; display: flex; flex-direction: column; }
        
        .welcome-card {
            background: white; 
            padding: 80px 40px; 
            text-align: center; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
            border: 1px solid #e2e8f0; 
            height: 100%; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
        }

        /* --- FOOTER --- */
        .footer-bottom { background-color: #1a1a1a; color: #9ca3af; padding: 50px 5%; font-size: 13px; margin-top: auto;}
        .footer-grid { display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 40px; max-width: 1200px; margin: 0 auto 40px; }
        .footer-logo { text-align: center; }
        .footer-logo img { height: 120px; margin-bottom: 15px; }
        .footer-about h3, .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-about p { line-height: 1.8; font-size: 12px; margin-bottom: 20px;}
        .footer-map-container { position: relative; width: 100%; height: 120px; background: #333; border-radius: 8px; overflow: hidden; margin-bottom: 15px;}
        .footer-map-container iframe { width: 100%; height: 100%; border: none;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        .footer-download p { font-size: 12px; color: #ef4444; margin-bottom: 10px; }
        .footer-download img { height: 40px; cursor: pointer;}
        .footer-links ul { list-style: none; padding:0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #9ca3af; text-decoration: none; transition: color 0.3s; display: flex; align-items: center; gap: 10px;}
        .footer-links a:hover { color: white; }
        .footer-copyright { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding-top: 20px; border-top: 1px solid #333; }
        .footer-social { display: flex; gap: 5px; }
        .footer-social a { width: 35px; height: 35px; background: #333; color: white; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-size: 13px; transition: 0.3s; }
        .footer-social a:hover { background: #ef4444; }
    </style>
</head>
<body>

    <!-- NAVBAR TEMA GELAP -->
    <nav class="navbar">
       <div class="nav-logos">
            <a href="/"><img src="/images/jambi.png" alt="Logo Pemkot"></a>
            <a href="/"><img src="/images/logo.png" alt="Logo Damkar"></a>
            <a href="/"><img src="/images/logo-redkar.png" alt="Logo Redkar"></a>
        </div> 
        <ul class="nav-links">
            <li class="dropdown">
                <a href="#">Layanan Kedaruratan <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#" target="_blank">WHATSAPP</a></li>
                    <li><a href="#">TELEPHONE</a></li>
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
                <a href="#" class="active">Layanan & Fasilitas <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="/layanan-fasilitas/layanan_perizinan">LAYANAN PERIZINAN</a></li>
                    <li><a href="/layanan-fasilitas/edukasi_sosialisasi">EDUKASI DAN SOSIALISASI</a></li>
                    <li><a href="/informasi-layanan">INFORMASI LAYANAN</a></li>
                </ul>
            </li>
            <li><a href="/redkar">Redkar</a></li>
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- HERO SECTION -->
    <div class="page-hero">
        <h1>INFORMASI LAYANAN & FASILITAS</h1>
        <div class="breadcrumb d-flex">
            <a href="/">Home</a> <span>&raquo;</span> LAYANAN & FASILITAS <span>&raquo;</span> <span class="active">INFORMASI LAYANAN</span>
        </div>
    </div>

    <!-- LAYOUT FORM & SIDEBAR -->
    <div class="content-wrapper">
        
        <!-- KIRI: SIDEBAR AKORDION IDENTIK -->
        <div class="sidebar">
            <h3 class="sidebar-title">Kategori Publikasi</h3>
            <div class="decor-line"><i class="fas fa-circle"></i></div>

            <div class="public-accordion">
                <!-- PENCEGAHAN -->
                <div class="public-accordion-item">
                    <button class="public-accordion-btn">BAGIAN PENCEGAHAN <i class="fas fa-chevron-down"></i></button>
                </div>
                
                <!-- PEMADAMAN -->
                <div class="public-accordion-item">
                    <button class="public-accordion-btn">BAGIAN PEMADAMAN <i class="fas fa-chevron-down"></i></button>
                </div>
           <!-- SAPRA (Tertutup Default) -->
                <div class="public-accordion-item">
                    <button class="public-accordion-btn" onclick="document.getElementById('menuSapra').classList.toggle('show')">
                        BAGIAN SAPRA <i class="fas fa-chevron-down"></i>
                    </button>
                    <!-- Sub-menu Sapra -->
                    <ul class="public-submenu" id="menuSapra">
                        <li>
                            <a href="/informasi-sarana" class="{{ request()->is('informasi-sarana') ? 'active' : '' }}">
                                <i class="fas fa-fire-extinguisher"></i> Sarana Pemadam
                            </a>
                        </li>
                        <li>
                            <a href="/informasi-prasarana" class="{{ request()->is('informasi-prasarana') ? 'active' : '' }}">
                                <i class="fas fa-building"></i> Prasarana Pemadam
                            </a>
                        </li>
                        <li>
                            <a href="/informasi-penyelamatan" class="{{ request()->is('informasi-penyelamatan') ? 'active' : '' }}">
                                <i class="fas fa-life-ring"></i> Sarana Penyelamatan
                            </a>
                        </li>
                        <li>
                            <a href="/informasi-pemeriksaan" class="{{ request()->is('informasi-pemeriksaan') ? 'active' : '' }}">
                                <i class="fas fa-search"></i> Sarana Pemeriksaan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- KANAN: AREA LANDING SESUAI REFERENSI DESAIN -->
        <div class="data-container">
            <div class="welcome-card">
                <img src="/images/logo.png" alt="Logo Damkar" style="height: 100px; margin-bottom: 25px;">
                
                <!-- Judul Diperbarui (General) -->
                <h2 style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 15px;">
                    Selamat Datang di Informasi Layanan Publik
                </h2>
                
                <!-- Paragraf 1 -->
                <p style="color: #64748b; font-size: 16px; font-weight: 500; margin-bottom: 30px;">
                    Portal transparansi informasi fasilitas dan aset pada Dinas Pemadam Kebakaran dan<br>Penyelamatan Kota Jambi.
                </p>

                <!-- Paragraf 2 (Instruksi Merah) -->
                <p style="color: #ef4444; font-size: 18px; font-weight: 700; margin-bottom: 10px;">
                    Silakan pilih menu kategori di sebelah kiri
                </p>

                <!-- Paragraf 3 -->
                <p style="color: #64748b; font-size: 16px; font-weight: 500;">
                    untuk melihat detail galeri armada, prasarana pos, sarana penyelamatan, dan lainnya<br>
                </p>
            </div>
        </div>

    </div>

    <!-- FOOTER IDENTIK -->
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
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
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank"><i class="fas fa-angle-double-right"></i> SIKOJA</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-copyright">
            <div>SIMERAHKOJA © 2026 / ALL RIGHTS RESERVED</div>
            <div class="footer-social">
                <a href="mailto:damkar.jbi@gmail.com" target="_blank"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mengatur agar accordian bagian yang aktif (berdasarkan URL) tetap terbuka saat di-refresh
        document.addEventListener("DOMContentLoaded", function() {
            let activeLink = document.querySelector('.public-submenu a.active');
            if(activeLink) {
                let submenu = activeLink.closest('.public-submenu');
                let btn = submenu.previousElementSibling;
                submenu.classList.add('show');
                btn.classList.add('active');
                btn.innerHTML = btn.innerHTML.replace('fa-chevron-down', 'fa-chevron-up');
            }
        });
    </script>
</body>
</html>