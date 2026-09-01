<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMERAH KOJA - Kota Jambi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Reset Dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Latar Belakang Utama */
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://via.placeholder.com/1920x1080/ff4500/000000?text=Background+Api+Damkar');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1a1a1a;
            padding: 8px 50px;
            font-size: 13px;
        }
        .top-bar .social-icons a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }
        .top-bar .contact-info span {
            margin-left: 20px;
        }
        .top-bar .contact-info i {
            color: red;
            margin-right: 5px;
        }

        /* Navigasi Utama */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: rgba(0, 0, 0, 0.2);
        }
        .nav-logos {
            display: flex;
            gap: 10px;
        }
        .nav-logos img {
            height: 45px;
        }
        
        /* Menu Navigasi */
        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }
        .nav-links li {
            position: relative;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
        }
        .nav-links a:hover {
            color: #ffcccc;
        }
        
        /* Dropdown Menu Styling */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            min-width: 230px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 10;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu li {
            list-style: none;
        }
        .dropdown-menu li a {
            color: #666666;
            padding: 15px 20px;
            display: block;
            font-size: 13px;
            border-bottom: 1px solid #eeeeee;
            font-weight: 500;
        }
        .dropdown-menu li:last-child a {
            border-bottom: none;
        }
        .dropdown-menu li a:hover {
            background-color: #f9f9f9;
            color: #d32f2f;
        }

        /* Konten Tengah (SIMERAH KOJA) */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }
        
        .center-logos {
            display: flex;
            gap: 20px;
            margin-bottom: 10px;
        }
        .center-logos img {
            height: 100px;
        }

        /* Efek Teks SIMERAH KOJA */
        .title-simerah {
            font-size: 4.5rem;
            font-weight: 900;
            color: #0a3d91;
            -webkit-text-stroke: 2px #e31818;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.8);
            margin: 10px 0;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 1.2rem;
            font-weight: 600;
            max-width: 800px;
            margin-bottom: 40px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
            line-height: 1.4;
        }

        /* -------------------------------------
           Tombol Darurat Lapor & Popup Menu 
           ------------------------------------- */
        .emergency-btn-container {
            margin-top: 20px;
            position: relative;
            display: inline-block;
        }
        
        .btn-darurat {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 130px;
            height: 130px;
            background-color: #d32f2f;
            color: white;
            border: 4px dashed #4caf50;
            border-radius: 50%;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            line-height: 1.2;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            transition: transform 0.3s, background-color 0.3s;
            cursor: pointer;
        }
        
        .btn-darurat:hover {
            transform: scale(1.05);
            background-color: #b71c1c;
        }

        /* Styling Popup Menu Darurat */
        .emergency-popup {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            bottom: 115%; /* Muncul di atas tombol */
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            min-width: 180px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            z-index: 100;
            text-align: left;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        /* Menampilkan Popup saat Container di-hover */
        .emergency-btn-container:hover .emergency-popup {
            visibility: visible;
            opacity: 1;
            bottom: 125%; /* Efek animasi naik sedikit */
        }

        /* Styling Item di Dalam Popup */
        .emergency-popup a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }

        .emergency-popup a:last-child {
            border-bottom: none;
        }

        .emergency-popup a:hover {
            background-color: #f9f9f9;
        }

        /* Warna Teks Sesuai Gambar yang Diunggah */
        .text-wa { color: #d32f2f; } /* Merah */
        .text-telp { color: #455a64; } /* Abu-abu kebiruan */
        .text-112 { color: #455a64; } /* Abu-abu kebiruan */

        /* Segitiga panah ke bawah (opsional, agar terlihat seperti chat bubble) */
        .emergency-popup::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -8px;
            border-width: 8px;
            border-style: solid;
            border-color: #ffffff transparent transparent transparent;
        }

    </style>
</head>
<body>

    <?php
        $email_kontak = "damkar.jbi@gmail.com";
        $telp_kontak = "+(0741) 41171";
        
        // Nomor Tujuan Darurat (Ganti dengan nomor asli)
        $no_whatsapp = "6281234567890"; 
        $no_telepon  = "074141171";
    ?>

    <div class="hero-section">
        
        <div class="top-bar">
            <div class="social-icons">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="contact-info">
                <span><i class="fas fa-envelope"></i> <?php echo $email_kontak; ?></span>
                <span><i class="fas fa-phone-alt"></i> <?php echo $telp_kontak; ?></span>
            </div>
        </div>

        <nav class="navbar">
            <div class="nav-logos">
                <img src="https://via.placeholder.com/50" alt="Logo 1">
                <img src="https://via.placeholder.com/50" alt="Logo 2">
                <img src="https://via.placeholder.com/50" alt="Logo 3">
            </div>
            <ul class="nav-links">
                <li class="dropdown">
                    <a href="#">Layanan Kedaruratan <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://api.whatsapp.com/send?phone=%2B628117113113&text=Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0A%20Mohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%2526%20Video%20Kejadian%20%3A%0A%0A%20Laporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0A%20Salam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%2526%20Penyelamatan%20Kota%20Jambi.">WHATSAPP</a></li>
                        <li><a href="#">TELEPHONE</a></li>
                        <li><a href="#">CALL CENTER 112</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#">Program Kerja <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/sotk">SOTK</a></li>
                        <li><a href="#">PERENCANAAN</a></li>
                        <li><a href="#">PELAPORAN</a></li>
                        <li><a href="#">SOP</a></li>
                        <li><a href="#">PRODUK HUKUM</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#">Layanan & Fasilitas <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">LAYANAN PERIZINAN</a></li>
                        <li><a href="#">EDUKASI DAN SOSIALISASI</a></li>
                        <li><a href="#">PKS</a></li>
                        <li><a href="#">LAYANAN LAINNYA</a></li>
                    </ul>
                </li>
                
                <li><a href="#">Redkar</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="center-logos">
                <img src="https://via.placeholder.com/100" alt="Logo Pemkot">
                <img src="https://via.placeholder.com/100" alt="Logo Damkar">
                <img src="https://via.placeholder.com/100" alt="Logo Yuda Brama Jaya">
            </div>
            
            <h1 class="title-simerah">SIMERAH KOJA</h1>
            
            <p class="subtitle">
                SISTEM INFORMASI PENANGGULANGAN KEBAKARAN<br>
                DAN PENYELAMATAN DAERAH KOTA JAMBI
            </p>

            <!-- STRUKTUR TOMBOL DARURAT BARU -->
            <div class="emergency-btn-container">
                <div class="btn-darurat">
                    TOMBOL<br>DARURAT<br>LAPOR
                </div>
                
                <!-- Popup Menu yang muncul saat di-hover -->
                <div class="emergency-popup">
                    <!-- Format https://wa.me/ langsung mengarahkan ke WhatsApp -->
                    <a href="https://wa.me/<?php echo $no_whatsapp; ?>" target="_blank" class="text-wa">WHATSAPP</a>
                    
                    <!-- Format tel: langsung memanggil nomor di HP/Desktop -->
                    <a href="tel:<?php echo $no_telepon; ?>" class="text-telp">TELEPHONE</a>
                    
                    <a href="tel:112" class="text-112">CALL CENTER 112</a>
                </div>
            </div>
            <!-- SELESAI -->

        </div>

    </div>

</body>
</html>