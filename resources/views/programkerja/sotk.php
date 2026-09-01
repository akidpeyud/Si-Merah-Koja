<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOTK - Program Kerja | SIMERAH KOJA</title>
    
    <!-- Google Fonts: Inter & Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --brand-navy: #0f172a;
            --brand-navy-light: #1e293b;
            --brand-red: #e11d48; 
            --brand-red-dark: #be123c;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        h1, h2, h3, h4, h5, h6, .nav-link {
            font-family: 'Poppins', sans-serif;
        }

        /* --- Top Bar --- */
        .top-bar {
            background-color: var(--brand-navy);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 0.8rem;
            padding: 6px 0; /* Diperkecil */
        }

        .top-bar a, .top-bar span {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .top-bar a:hover {
            color: var(--brand-red);
        }

        /* --- Navbar --- */
        .navbar-custom {
            background-color: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 8px 0; /* Diperkecil */
        }
        
        .navbar-custom .nav-link {
            color: #f1f5f9 !important;
            font-weight: 500;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(225, 29, 72, 0.15);
        }

        /* --- Page Header (Dirampingkan agar tidak makan tempat) --- */
        .page-header {
            position: relative;
            background: linear-gradient(to right, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.7)), url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=1920') center/cover;
            padding: 30px 0; /* Padding dikurangi drastis */
            text-align: center;
            color: white;
            border-bottom: 3px solid var(--brand-red);
        }

        .page-header h1 {
            font-size: 1.8rem; /* Font diperkecil sedikit */
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .breadcrumb-custom {
            display: inline-flex;
            align-items: center;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 4px 14px;
            border-radius: 50px;
            backdrop-filter: blur(5px);
        }
        
        .breadcrumb-custom span {
            color: #fca5a5;
            font-weight: 600;
        }

        /* --- Main Content Layout --- */
        .main-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            padding: 25px 35px; /* Padding dalam dikurangi */
            margin-top: 25px; /* Jarak atas diperkecil */
            margin-bottom: 40px;
        }

        /* --- Horizontal Tab Navigation --- */
        .custom-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px; /* Jarak bawah diperkecil */
            border-bottom: 2px solid var(--bg-light);
            padding-bottom: 15px;
        }

        .custom-tabs .nav-link {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 8px 20px;
            border-radius: 50px;
            background-color: var(--bg-light);
            border: 1px solid transparent;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .custom-tabs .nav-link:hover {
            color: var(--brand-navy);
            background-color: #e2e8f0;
            transform: translateY(-2px);
        }

        .custom-tabs .nav-link.active {
            color: #ffffff !important;
            background-color: var(--brand-red);
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.25);
        }

        .custom-tabs .nav-link i {
            margin-right: 6px;
            font-size: 1rem;
        }

        /* --- Contact Widget Style --- */
        .contact-widget {
            background-color: var(--bg-light); 
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(0,0,0,0.03);
            height: 100%; /* Agar sejajar dengan document viewer */
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .contact-item i {
            color: var(--brand-red);
            font-size: 1.15rem;
            margin-top: 2px;
            width: 25px;
        }

        .contact-item h6 {
            margin: 0 0 3px 0;
            font-weight: 700;
            color: var(--brand-navy);
            font-size: 0.9rem;
        }
        
        .contact-item p {
            margin: 0;
            font-size: 0.8rem;
            color: #475569; 
            line-height: 1.4;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            background-color: #ffffff;
            color: #64748b;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background-color: var(--brand-red);
            color: white;
            border-color: var(--brand-red);
            transform: translateY(-3px);
        }

        /* --- Document Viewer --- */
        .document-wrapper {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            height: 100%;
        }
        
        .viewer-toolbar {
            background-color: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-muted);
        }

        .viewer-toolbar .btn-tool {
            background: none;
            border: none;
            color: var(--text-muted);
            padding: 4px 10px;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        
        .viewer-toolbar .btn-tool:hover {
            background-color: #e2e8f0;
            color: var(--text-dark);
        }

        .viewer-content {
            background-color: #cbd5e1;
            padding: 20px;
            text-align: center;
            min-height: 400px; /* Tinggi dikurangi agar pas 1 layar */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .viewer-content img {
            max-width: 100%;
            max-height: 380px; /* Menjaga agar gambar tidak terlalu tinggi */
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 4px;
            object-fit: contain;
        }

        /* --- Footer --- */
        .site-footer {
            background-color: var(--brand-navy-light);
            color: #94a3b8;
            padding: 50px 0 20px;
            font-size: 0.85rem;
        }

        .footer-heading {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-list li { margin-bottom: 10px; }
        
        .footer-list a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .footer-list a::before {
            content: "\f105";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 0.8rem;
            margin-right: 8px;
            color: var(--brand-red);
            transition: transform 0.3s;
        }
        
        .footer-list a:hover {
            color: #ffffff;
            transform: translateX(4px);
        }

        .footer-bottom {
            background-color: var(--brand-navy);
            padding: 15px 0;
            border-top: 1px solid rgba(255,255,255,0.05);
            font-size: 0.8rem;
            color: #64748b;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="d-flex gap-4">
                <span><i class="fas fa-envelope text-danger me-2"></i> damkar.jbi@gmail.com</span>
                <span><i class="fas fa-phone-alt text-danger me-2"></i> +(0741) 41171</span>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex gap-2 align-items-center" href="#">
                <img src="https://via.placeholder.com/35" alt="Logo" class="rounded">
                <img src="https://via.placeholder.com/35" alt="Logo" class="rounded">
                <img src="https://via.placeholder.com/35" alt="Logo" class="rounded">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item"><a class="nav-link" href="#">Layanan Kedaruratan <i class="fas fa-angle-down ms-1"></i></a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Program Kerja <i class="fas fa-angle-down ms-1"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan & Fasilitas <i class="fas fa-angle-down ms-1"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Redkar</a></li>
                    <li class="nav-item"><a class="nav-link bg-danger text-white ms-lg-3 px-4 rounded-pill" href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>PROGRAM KERJA</h1>
            <div class="breadcrumb-custom mt-2">
                <a href="#" class="text-white text-decoration-none">Home</a> 
                <i class="fas fa-chevron-right mx-2" style="font-size: 0.6rem; color: #94a3b8;"></i> 
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
                    <a class="nav-link active" href="/sotk">
                        <i class="fas fa-folder-open"></i> SOTK
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
                <li class="nav-item">
                    <a class="nav-link" href="/pelaporan">
                        <i class="fas fa-folder"></i> PELAPORAN
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/produkhukum">
                        <i class="fas fa-folder"></i> PRODUK HUKUM
                    </a>
                </li>
            </ul>

            <!-- Grid Layout (Contact Info + PDF Viewer) -->
            <div class="row g-4 align-items-stretch">
                
                <!-- Kiri: Widget Kontak -->
                <div class="col-lg-4 col-xl-3">
                    <div class="contact-widget">
                        <div class="contact-item">
                            <i class="fas fa-envelope-open-text"></i>
                            <div>
                                <h6>Email Resmi</h6>
                                <p>damkar.jbi@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item mb-0">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h6>Alamat Kantor</h6>
                                <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru</p>
                            </div>
                        </div>
                        
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Document Viewer -->
                <div class="col-lg-8 col-xl-9">
                    <div class="document-wrapper">
                        <!-- Toolbar PDF -->
                        <div class="viewer-toolbar">
                            <div>
                                <button class="btn-tool" title="Menu Dokumen"><i class="fas fa-list-ul"></i></button>
                            </div>
                            <div class="d-flex align-items-center gap-2 font-monospace small fw-bold">
                                <button class="btn-tool" title="Zoom Out"><i class="fas fa-minus"></i></button>
                                <span class="px-2">100%</span>
                                <button class="btn-tool" title="Zoom In"><i class="fas fa-plus"></i></button>
                            </div>
                            <div>
                                <button class="btn-tool" title="Cetak Dokumen"><i class="fas fa-print"></i></button>
                                <button class="btn-tool" title="Unduh Dokumen"><i class="fas fa-download"></i></button>
                                <button class="btn-tool ms-2" title="Layar Penuh"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>

                        <!-- Area Dokumen -->
                        <div class="viewer-content">
                            <img src="https://via.placeholder.com/900x700/ffffff/0f172a?text=Struktur+Organisasi+SOTK" alt="Struktur Organisasi Dinas Pemadam Kebakaran">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 pe-lg-4">
                    <img src="https://via.placeholder.com/130x45?text=SIMERAH+KOJA" alt="Logo Simerah Koja" class="mb-3 bg-white p-2 rounded">
                    <p style="line-height: 1.6; font-size: 0.85rem;">
                        SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.
                    </p>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-heading">Lokasi Kantor</h5>
                    <div class="bg-dark rounded mb-3 overflow-hidden" style="height: 120px;">
                        <img src="https://via.placeholder.com/400x120?text=Peta+Google+Maps" alt="Map" class="w-100 h-100 object-fit-cover">
                    </div>
                    <p class="mt-3 mb-2 text-white fw-medium" style="font-size: 0.85rem;">Download Aplikasi Mobile :</p>
                    <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" height="35"></a>
                </div>
                <div class="col-lg-4 ps-lg-5">
                    <h5 class="footer-heading">Tautan Terkait</h5>
                    <ul class="footer-list">
                        <li><a href="#">Website Resmi Damkar</a></li>
                        <li><a href="#">Pemerintah Kota Jambi</a></li>
                        <li><a href="#">Aplikasi SIKOJA</a></li>
                        <li><a href="#">Call Center 112 Jambi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
        <div class="container text-center">
            <p class="mb-0">SIMERAH KOJA © 2024. All Rights Reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>