<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - SIMERAH KOJA</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* --- SPLASH SCREEN STYLES --- */
#splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #0b0f19; /* Latar belakang gelap */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}

.splash-logo-container {
    text-align: center;
    animation: pulseLogo 1.5s infinite alternate;
}

.splash-logo-container img {
    height: 100px;
    margin-bottom: 20px;
    filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.4));
}

.splash-title {
    color: #ffffff;
    font-weight: 800;
    font-size: 20px;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 25px;
}

.splash-spinner {
    width: 45px;
    height: 45px;
    border: 4px solid rgba(255, 255, 255, 0.1);
    border-top: 4px solid #ef4444; /* Warna merah loading */
    border-radius: 50%;
    animation: spinLoader 0.8s linear infinite;
}

@keyframes spinLoader {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulseLogo {
    0% { transform: scale(0.95); opacity: 0.8; }
    100% { transform: scale(1.05); opacity: 1; }
}

.splash-hidden {
    opacity: 0;
    visibility: hidden;
}
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }

        /* --- NAVBAR STYLES --- */
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 50px; background-color: #111827; border-bottom: 4px solid #ef4444;
            position: sticky; top: 0; z-index: 9999;
        }
        .nav-logos { display: flex; gap: 15px; align-items: center; text-decoration: none; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; margin-bottom: 0; padding-left: 0; }
        .nav-links li { position: relative; padding-bottom: 15px; margin-bottom: -15px; }
        .nav-links a {
            color: #f8fafc; text-decoration: none; font-weight: 700; font-size: 13px;
            text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;
        }
        .nav-links a:hover { color: #ef4444; }
        .nav-links .btn-login { background-color: #ef4444; color: #ffffff; padding: 8px 24px; border-radius: 50px; margin-left: 10px; }
        .nav-links .btn-login:hover { background-color: #dc2626; color: #ffffff; }
        
        /* DROPDOWN CUSTOM */
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

        /* --- PAGE HEADER (BANNER) --- */
        .page-header {
            position: relative;
            background-image: linear-gradient(rgba(11, 15, 25, 0.8), rgba(11, 15, 25, 0.95)), url('/images/background1.jpg');
            background-size: cover; background-position: center; padding: 40px 0;
            text-align: center; color: white; border-bottom: 4px solid #ef4444;
        }
        .page-header h1 { font-size: 28px; font-weight: 800; letter-spacing: 1px; margin-bottom: 8px; text-transform: uppercase; }
        .breadcrumb-custom { display: inline-flex; align-items: center; font-size: 12px; font-weight: 600; }
        .breadcrumb-custom span { color: #ef4444; }
        .breadcrumb-custom a { color: #cbd5e1; text-decoration: none; transition: color 0.3s; }
        .breadcrumb-custom a:hover { color: #ffffff; }

        /* --- LAYOUT ARTIKEL (CLEAN) --- */
        .article-container {
            max-width: 850px; 
            margin: 40px auto 80px; 
            background: #ffffff;
            border-radius: 16px; 
            padding: 50px 60px; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); /* Bayangan sangat halus */
        }

        .btn-back {
            display: inline-flex; align-items: center; gap: 8px; 
            color: #64748b; text-decoration: none; font-weight: 600; font-size: 14px; 
            transition: all 0.2s ease; margin-bottom: 30px; padding-bottom: 5px;
            border-bottom: 1px solid transparent;
        }
        .btn-back:hover { color: #ef4444; border-bottom: 1px solid #ef4444; }

        .article-title { 
            font-size: 34px; font-weight: 800; color: #0f172a; 
            line-height: 1.3; margin-bottom: 25px; 
        }

        /* Meta / Info Label (Minimalis) */
        .meta-tags {
            display: flex; flex-wrap: wrap; gap: 15px;
            padding-bottom: 30px; margin-bottom: 30px;
            border-bottom: 1px solid #f1f5f9;
        }
        .meta-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background-color: #f8fafc; color: #475569;
            padding: 8px 16px; border-radius: 50px;
            font-size: 13px; font-weight: 600; border: 1px solid #e2e8f0;
        }
        .meta-pill i { color: #ef4444; font-size: 14px; }

        /* Gambar Clean */
        .article-image-wrapper {
            width: 100%; border-radius: 12px; overflow: hidden; margin-bottom: 40px;
            background-color: #f8fafc;
        }
        .article-image { width: 100%; max-height: 500px; object-fit: cover; display: block; }
        .no-image-placeholder {
            height: 200px; display: flex; flex-direction: column; align-items: center;
            justify-content: center; color: #94a3b8; gap: 10px; font-size: 14px; font-weight: 600;
        }
        .no-image-placeholder i { font-size: 30px; color: #cbd5e1;}

        /* Tipografi Isi Berita (Fokus Keterbacaan) */
        .article-body { 
            font-size: 17px; /* Diperbesar sedikit */
            line-height: 2;  /* Baris lebih renggang */
            color: #334155; 
            text-align: justify; 
        }
        .article-body p { margin-bottom: 25px; } /* Jarak antar paragraf ditambah */


        /* --- FOOTER STYLES --- */
        .footer-bottom { background-color: #1a1a1a; color: #9ca3af; padding: 50px 5%; font-size: 13px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 40px; max-width: 1100px; margin: 0 auto 40px; }
        .footer-logo { text-align: center; }
        .footer-logo img { height: 120px; margin-bottom: 15px; }
        .footer-about h3, .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-about p { line-height: 1.8; font-size: 12px; margin-bottom: 20px;}
        .footer-map-container { position: relative; width: 100%; height: 120px; background: #333; border-radius: 8px; overflow: hidden; margin-bottom: 15px;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        .footer-download p { font-size: 12px; color: #ef4444; margin-bottom: 10px; }
        .footer-download img { height: 40px; cursor: pointer;}
        .footer-links ul { list-style: none; padding-left: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #9ca3af; text-decoration: none; transition: color 0.3s; display: flex; align-items: center; gap: 10px;}
        .footer-links a:hover { color: white; }
        .footer-copyright { display: flex; justify-content: space-between; align-items: center; max-width: 1100px; margin: 0 auto; padding-top: 20px; border-top: 1px solid #333; }
        .footer-social { display: flex; gap: 5px; }
        .footer-social a { width: 35px; height: 35px; background: #333; color: white; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; transition: background 0.3s; }
        .footer-social a:hover { background: #ef4444; }
    </style>
</head>
<body>
    <!-- SPLASH SCREEN LOADING -->
<div id="splash-screen">
    <div class="splash-logo-container">
        <!-- Pastikan path gambarnya benar -->
        <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
        <div class="splash-title">SIMERAH KOJA</div>
    </div>
    <div class="splash-spinner"></div>
</div>
    <?php
        $no_whatsapp = "628117113113"; 
        $no_telepon  = "074141171";
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    ?>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="nav-logos">
            <img src="/images/jambi.png" alt="Logo Pemkot">
            <img src="/images/logo.png" alt="Logo Damkar">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </a>
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
                    <li><a href="#">PKS</a></li>
                </ul>
            </li>
            <li><a href="/redkar">Redkar</a></li>
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- Page Header (Banner) -->
    <section class="page-header">
        <div class="container">
            <h1>DETAIL BERITA & KEJADIAN</h1>
            <div class="breadcrumb-custom mt-2">
                <a href="/">Home</a> 
                <i class="fas fa-angle-double-right mx-2" style="font-size: 10px; color: #9ca3af;"></i> 
                <span>BERITA</span>
                <i class="fas fa-angle-double-right mx-2" style="font-size: 10px; color: #9ca3af;"></i> 
                <span>{{ Str::limit($berita->judul, 30) }}</span>
            </div>
        </div>
    </section>

    <!-- Konten Utama Berita (Minimalist) -->
    <div class="container">
        <div class="article-container">
            
            <a href="/" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>

            <h1 class="article-title">{{ $berita->judul }}</h1>
            
            <div class="meta-tags">
                <div class="meta-pill" title="Waktu Kejadian">
                    <i class="far fa-calendar-check"></i> 
                    {{ \Carbon\Carbon::parse($berita->tanggal_kejadian)->translatedFormat('d F Y') }}
                </div>
                <div class="meta-pill" title="Jam Kejadian">
                    <i class="far fa-clock"></i> 
                    {{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }} WIB
                </div>
                <div class="meta-pill" title="Lokasi Kejadian">
                    <i class="fas fa-map-marker-alt"></i> 
                    {{ $berita->lokasi }}
                </div>
            </div>

            <div class="article-image-wrapper">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Foto Dokumentasi Kejadian" class="article-image">
                @else
                    <div class="no-image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>Belum Ada Foto Dokumentasi</span>
                    </div>
                @endif
            </div>

            <div class="article-body">
                {!! nl2br(e($berita->detail_lengkap)) !!}
            </div>

            <div class="mt-5 pt-4" style="border-top: 1px solid #f1f5f9;">
                <p class="text-muted small mb-1">Sumber Laporan: <strong>{{ $berita->sumber_informasi }}</strong></p>
                <p class="text-muted small">Dilaporkan Oleh: <strong>{{ $berita->pelapor }}</strong></p>
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
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
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

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    window.addEventListener('load', function() {
        const splash = document.getElementById('splash-screen');
        if (splash) {
            // Tambahkan kelas untuk memicu animasi transisi (fade out)
            splash.classList.add('splash-hidden');
            
            // Hapus elemen dari DOM setelah animasi selesai agar tidak menutupi klik
            setTimeout(() => {
                splash.remove();
            }, 500); 
        }
    });
</script>
</body>
</html>