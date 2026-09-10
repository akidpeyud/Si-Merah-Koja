<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Perizinan RPKBGL - SIMERAH KOJA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- NAVBAR TEMA GELAP (STICKY DI ATAS) --- */
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 50px; background-color: #0f172a; 
            border-bottom: 4px solid #ef4444; 
            position: sticky; top: 0; z-index: 9999; 
        }
        .nav-logos { display: flex; gap: 15px; align-items: center; }
        .nav-logos img { height: 40px; transition: transform 0.3s; }
        .nav-logos img:hover { transform: scale(1.05); }
        .nav-links { list-style: none; display: flex; gap: 30px; align-items: center; }
        .nav-links li { position: relative; padding-bottom: 15px; margin-bottom: -15px; }
        .nav-links a { color: #f8fafc; text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease; }
        .nav-links a:hover { color: #ef4444; }
        .nav-links .btn-login { background-color: #ef4444; color: #ffffff; padding: 8px 24px; border-radius: 50px; margin-left: 10px; }
        .nav-links .btn-login:hover { background-color: #dc2626; color: #ffffff; }

        .dropdown-menu {
            display: none; position: absolute; top: 100%; left: 0; background-color: #0f172a; 
            min-width: 220px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border-radius: 0 0 8px 8px; 
            overflow: hidden; z-index: 10; margin-top: 0; border: 1px solid #1e293b; border-top: none; 
        }
        .dropdown:hover .dropdown-menu { display: block; animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu li { list-style: none; padding-bottom: 0; margin-bottom: 0; }
        .dropdown-menu li a { color: #cbd5e1; padding: 14px 20px; display: block; font-size: 13px; border-bottom: 1px solid #1e293b; font-weight: 600; }
        .dropdown-menu li:last-child a { border-bottom: none; }
        .dropdown-menu li a:hover { background-color: #1e293b; color: #ef4444; padding-left: 26px; }

        /* --- HERO SECTION --- */
        .page-hero {
            background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('/images/background1.jpg');
            background-size: cover; background-position: center; padding: 80px 20px;
            text-align: center; color: white; border-bottom: 4px solid #ef4444;
        }
        .page-hero h1 { font-size: 3rem; font-weight: 800; margin-bottom: 15px; letter-spacing: 1px; }
        
        .breadcrumb { font-size: 14px; font-weight: 600; color: #cbd5e1; }
        .breadcrumb a { color: #38bdf8; text-decoration: none; transition: 0.3s; }
        .breadcrumb a:hover { color: #bae6fd; text-decoration: underline; }
        .breadcrumb span { color: #ef4444; margin: 0 5px;}
        .breadcrumb .active { color: #ef4444; }

        /* --- IKON LAYANAN KLIKABEL --- */
        .service-icons-container {
            max-width: 1100px; margin: -40px auto 50px; display: grid; 
            grid-template-columns: repeat(3, 1fr); /* Diubah menjadi 3 kolom agar rapi karena Izin Penjualan dihapus */
            gap: 20px; background: white; padding: 30px; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); position: relative; z-index: 5;
        }
        .service-icon-link { text-decoration: none; display: block; }
        .service-icon-box {
            display: flex; flex-direction: column; align-items: center; text-align: center;
            padding: 10px; transition: transform 0.3s ease;
        }
        .service-icon-box:hover { transform: translateY(-5px); }
        .icon-top-box {
            width: 70px; height: 70px; border-radius: 16px; display: flex; 
            align-items: center; justify-content: center; font-size: 35px; 
            color: white; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .bg-gray { background-color: #9ca3af; }
        .bg-pink { background-color: #ec4899; }
        .bg-orange { background-color: #f97316; }
        
        .service-icon-box h3 { font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 8px; transition: color 0.3s; }
        .service-icon-box p { font-size: 11px; color: #64748b; line-height: 1.5; }
        .service-icon-link.active .service-icon-box h3 { color: #ef4444; }

        /* --- LAYOUT FORM & SIDEBAR --- */
        .content-wrapper { max-width: 1200px; margin: 0 auto 80px; display: flex; gap: 40px; padding: 0 20px; }

        /* Sidebar */
        .sidebar { width: 300px; flex-shrink: 0; }
        .sidebar-title { font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 5px; }
        .decor-line { display: flex; align-items: center; margin-bottom: 25px; }
        .decor-line::before { content: ""; height: 2px; width: 30px; background: #ef4444; }
        .decor-line i { color: #ef4444; font-size: 6px; margin: 0 5px; }
        .decor-line::after { content: ""; height: 2px; width: 10px; background: #ef4444; }

        .info-list { list-style: none; }
        .info-item { margin-bottom: 25px; }
        .info-header { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 10px; }
        .info-header .icon-red { background: #ef4444; color: white; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border-radius: 4px; font-size: 12px; flex-shrink: 0; margin-top: 2px; }
        .info-header h4 { font-size: 15px; font-weight: 700; color: #1e293b; line-height: 1.4;}
        .info-body { padding-left: 39px; font-size: 12px; color: #64748b; line-height: 1.6; }
        .info-body ul { padding-left: 15px; margin-bottom: 10px; }
        .info-body a { color: #ef4444; text-decoration: none; font-weight: 600; }
        
        .btn-detail { background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 11px; font-weight: 600; cursor: pointer; margin-top: 5px; transition: 0.3s;}
        .btn-detail:hover { background: #dc2626; }

        /* CSS untuk Kotak Dropdown Tampilkan Detail (Mekanisme) */
        .detail-content {
            display: none; 
            margin-top: 10px;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background-color: #f8fafc;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .detail-content ul { padding-left: 20px; margin: 0; }
        .detail-content li { font-size: 12px; color: #64748b; line-height: 1.6; margin-bottom: 8px; list-style-type: circle; }
        .detail-content li:last-child { margin-bottom: 0; }

        /* --- CSS UNTUK MODAL POP-UP (LIAT DETAIL PERSYARATAN) --- */
        .modal-overlay {
            display: none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%;
            overflow: auto; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(3px); animation: fadeIn 0.3s;
        }
        .modal-box {
            background-color: #ffffff; margin: 5vh auto; padding: 0;
            border-radius: 8px; width: 85%; max-width: 800px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative;
        }
        .modal-header {
            padding: 20px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;
        }
        .modal-header h2 { font-size: 22px; font-weight: 800; color: #1f2937; }
        .modal-close-icon { color: #9ca3af; font-size: 28px; font-weight: bold; cursor: pointer; background: none; border: none; line-height: 1; }
        .modal-close-icon:hover { color: #111827; }
        .modal-body { padding: 25px 20px; font-size: 13px; color: #4b5563; line-height: 1.8; max-height: 60vh; overflow-y: auto; }
        .modal-body ol { padding-left: 20px; }
        .modal-body li { margin-bottom: 15px; }
        .modal-footer { padding: 15px 20px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-start; }
        .btn-modal-tutup { background: #ef4444; color: white; border: none; padding: 10px 24px; border-radius: 6px; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.3s;}
        .btn-modal-tutup:hover { background: #dc2626; }
        
        .link-detail { color: #ef4444; font-weight: 600; cursor: pointer; text-decoration: none; }
        .link-detail:hover { text-decoration: underline; }

        .sidebar-social { padding-left: 39px; display: flex; gap: 8px; margin-top: 20px; }
        .sidebar-social a { background: #94a3b8; color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-size: 13px; transition: 0.3s; }
        .sidebar-social a:hover { background: #ef4444; }

        /* Form */
        .form-container { flex-grow: 1; background: #ffffff; }
        .form-title { font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.3; margin-bottom: 5px;}
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; color: #334155; outline: none; transition: border-color 0.3s; background-color: #f8fafc; }
        .form-control:focus { border-color: #ef4444; background-color: #ffffff; }
        select.form-control { appearance: auto; }

        .file-drop-area { border: 2px dashed #cbd5e1; background-color: #f8fafc; border-radius: 8px; padding: 30px; text-align: center; color: #64748b; font-size: 13px; font-weight: 600; transition: 0.3s; cursor: pointer; }
        .file-drop-area:hover { border-color: #ef4444; background-color: #fef2f2; }
        .file-drop-area a { color: #ef4444; text-decoration: underline; }
        .powered-by { text-align: right; font-size: 10px; color: #94a3b8; margin-top: 5px; }

        .btn-submit { background-color: #ef4444; color: white; border: none; padding: 12px 35px; font-size: 14px; font-weight: 800; border-radius: 6px; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-submit:hover { background-color: #dc2626; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

        /* --- FOOTER --- */
        .footer-bottom { background-color: #1a1a1a; color: #9ca3af; padding: 50px 5%; font-size: 13px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 40px; max-width: 1100px; margin: 0 auto 40px; }
        .footer-logo { text-align: center; }
        .footer-logo img { height: 120px; margin-bottom: 15px; }
        .footer-about h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-about p { line-height: 1.8; font-size: 12px; margin-bottom: 20px;}
        .footer-map-container { position: relative; width: 100%; height: 120px; background: #333; border-radius: 8px; overflow: hidden; margin-bottom: 15px;}
        .footer-map-container iframe { width: 100%; height: 100%; border: none;}
        .footer-find { font-weight: 700; color: white; margin-bottom: 20px; }
        .footer-find i { color: #ef4444; margin-right: 5px;}
        .footer-download p { font-size: 12px; color: #ef4444; margin-bottom: 10px; }
        .footer-download img { height: 40px; cursor: pointer;}
        .footer-links h3 { color: white; font-size: 18px; margin-bottom: 20px; font-weight: 700;}
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #9ca3af; text-decoration: none; transition: color 0.3s; display: flex; align-items: center; gap: 10px;}
        .footer-links a:hover { color: white; }
        .footer-copyright { display: flex; justify-content: space-between; align-items: center; max-width: 1100px; margin: 0 auto; padding-top: 20px; border-top: 1px solid #333; }
        
        .footer-social { display: flex; gap: 5px; }
        .footer-social a { width: 35px; height: 35px; background: #333; color: white; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-size: 13px; transition: 0.3s; }
        .footer-social a:hover { background: #ef4444; }
    </style>
</head>
<body>

    <?php
        $no_whatsapp = "628117113113"; 
        $no_telepon  = "074141171";
        $pesan_wa = "Terimakasih%20telah%20menghubungi%20SIMERAH%20KOJA...";
    ?>

    <!-- NAVBAR TEMA GELAP -->
    <nav class="navbar">
       <div class="nav-logos">
            <a href="/"><img src="/images/jambi.png" alt="Logo Pemkot"></a>
            <a href="/"><img src="/images/logo.png" alt="Logo Damkar"></a>
            <a href="/"><img src="/images/logo-redkar.png" alt="Logo Redkar"></a>
        </div> <ul class="nav-links">
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
                </ul>
            </li>
            <li><a href="/redkar">Redkar</a></li>
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- HERO SECTION -->
    <div class="page-hero">
        <h1>LAYANAN PERIZINAN</h1>
        <div class="breadcrumb">
            <a href="/">Home</a> <span>&raquo;</span> PERIZINAN <span>&raquo;</span> <span class="active">RPKBGL</span>
        </div>
    </div>

    <!-- DERETAN IKON KLIKABEL -->
    <div class="service-icons-container">
        <!-- RPKBGL (Tab Aktif di halaman ini) -->
        <a href="/layanan-fasilitas/layanan_perizinan" class="service-icon-link active">
            <div class="service-icon-box">
                <div class="icon-top-box bg-gray"><i class="fas fa-building"></i></div>
                <h3>RPKBGL</h3>
                <p>Layanan Perizinan Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan</p>
            </div>
        </a>
        
        <!-- SKK -->
        <a href="/layanan-fasilitas/skk" class="service-icon-link">
            <div class="service-icon-box">
                <div class="icon-top-box bg-pink"><i class="fas fa-user-shield"></i></div>
                <h3>SKK</h3>
                <p>Layanan Perizinan Penerbitan Sertifikat Keamanan Kebakaran</p>
            </div>
        </a>

        <!-- Perpanjang SKK -->
        <a href="/layanan-fasilitas/perpanjang_skk" class="service-icon-link">
            <div class="service-icon-box">
                <div class="icon-top-box bg-orange"><i class="fas fa-shield-alt"></i></div>
                <h3>Perpanjang SKK</h3>
                <p>Layanan Perizinan Perpanjangan Sertifikat Keamanan Kebakaran</p>
            </div>
        </a>
    </div>

    <!-- LAYOUT FORM & SIDEBAR -->
    <div class="content-wrapper">
        
        <!-- KIRI: INFORMASI SIDEBAR -->
        <div class="sidebar">
            <h3 class="sidebar-title">Informasi</h3>
            <div class="decor-line"><i class="fas fa-circle"></i></div>

            <ul class="info-list">
                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-envelope"></i></div>
                        <h4>Dasar Hukum</h4>
                    </div>
                    <div class="info-body">
                        - UU No 28 Thn 2002<br>
                        - Permen Tenaga Kerja dan Transmigrasi No Per.04/MEN/1980<br>
                        - Permen PU No 26/PRT/M/2007<br>
                        - Permen PU No 20/PRT/M/2009<br>
                        - Permendagri No 114 Thn 2018
                    </div>
                </li>
                
                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-envelope"></i></div>
                        <h4>Persyaratan</h4>
                    </div>
                    <div class="info-body">
                        <ul>
                            <li>Menginput Formulir Rekomendasi Proteksi Kebakaran secara elektronik melalui simerah.jambikota.go.id</li>
                            <li>Upload Surat Permohonan Bermaterai (<a href="#">Download Surat Permohonan</a>)</li>
                            <!-- TEKS POPUP SESUAI GAMBAR 3 -->
                            <li>Upload Detail Persyaratan RPKBGL Lainnya<br>
                                <a class="link-detail" onclick="bukaModal()">(Liat Detail)</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-envelope"></i></div>
                        <h4>Sistem, Mekanisme dan Prosedur</h4>
                    </div>
                    <div class="info-body">
                        <button type="button" class="btn-detail" onclick="toggleDetail()">Tampilkan Detail</button>
                        
                        <div id="detailProsedur" class="detail-content">
                            <ul>
                                <li>Pemohon mendaftar secara online, setelah itu mengupload kelengkapan berkas yang dipersyaratkan;</li>
                                <li>Tim Inspeksi melakukan pemeriksaan proteksi aktif kebakaran gedung pemohon;</li>
                                <li>Tim inspeksi merekomendasikan kepada kepala dinas pemadam kebakaran dan penyelamatan kota jambi untuk menerima dan menolak kunjungan pemohon berdasarkan hasil inspeksi lapangan (memenuhi syarat/ tidak memenuhi syarat);</li>
                                <li>Kepala dinas pemadam kebakaran dan penyelamatan kota jambi memberikan jawaban berdasarkan hasil rekomendasi tim inspeks;</li>
                                <li>Sistem akan memberikan notifkasi via Whatsapp di Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi;</li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-envelope"></i></div>
                        <h4>Waktu Penyelesaian</h4>
                    </div>
                    <div class="info-body">
                        14 Hari Kerja
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-envelope"></i></div>
                        <h4>Produk Layanan</h4>
                    </div>
                    <div class="info-body">
                        Rekomendasi Kebakaran Bangunan Gedung dan Lingkungan
                    </div>
                </li>

                <li class="info-item">
                    <div class="info-header">
                        <div class="icon-red"><i class="fas fa-envelope"></i></div>
                        <h4>Pengaduan Layanan</h4>
                    </div>
                    <div class="info-body">
                        Whatsapp - +62 8117113113
                    </div>
                </li>
            </ul>

            <div class="sidebar-social">
               
                <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            
            </div>
        </div>

        <!-- KANAN: FORMULIR -->

        <div class="form-container">
            <h2 class="form-title">Rekomendasi Proteksi<br>Kebakaran Bangunan Gedung & Lingkungan</h2>
            <div class="decor-line"><i class="fas fa-circle"></i></div>

            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Pemohon</label>
                    <input type="text" class="form-control" name="nama_pemohon">
                </div>
                
                <div class="form-group">
                    <label>Email Pemohon</label>
                    <input type="email" class="form-control" name="email_pemohon">
                </div>

                <div class="form-group">
                    <label>No Whatsapp</label>
                    <input type="text" class="form-control" name="no_wa">
                </div>

                <div class="form-group">
                    <label>Nama Usaha (PT/CV/UD/Lembaga/Toko/Instansi dan lainnya)</label>
                    <input type="text" class="form-control" name="nama_usaha">
                </div>

                <div class="form-group">
                    <label>NIK Pemilik Usaha</label>
                    <input type="text" class="form-control" name="nik">
                </div>

                <div class="form-group">
                    <label>Alamat Pemilik Usaha</label>
                    <input type="text" class="form-control" name="alamat_pemilik">
                </div>

                <div class="form-group">
                    <label>Kategori Bangunan</label>
                    <select class="form-control" name="kategori">
                        <option value="">Pilih Kategori Bangunan</option>
                        <option value="1">Rumah Tinggal</option>
                        <option value="2">Komersial</option>
                        <option value="3">Industri</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat Bangunan</label>
                    <input type="text" class="form-control" name="alamat_bangunan">
                </div>

                <div class="form-group">
                    <label>Kecamatan</label>
                    <select class="form-control" name="kecamatan">
                        <option value="">Pilih kecamatan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kelurahan</label>
                    <select class="form-control" name="kelurahan">
                        <option value="">Pilih kelurahan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Luas Lahan</label>
                    <input type="text" class="form-control" name="luas_lahan">
                </div>

                <div class="form-group">
                    <label>Luas Bangunan</label>
                    <input type="text" class="form-control" name="luas_bangunan">
                </div>

                <div class="form-group">
                    <label>Tinggi Bangunan</label>
                    <input type="text" class="form-control" name="tinggi_bangunan">
                </div>

                <div class="form-group">
                    <label>Upload Surat Permohonan...</label>
                    <div class="file-drop-area">
                        Drag & Drop your files or <a href="#">Browse</a>
                    </div>
                    <div class="powered-by">Powered by FilePond</div>
                </div>

                <div class="form-group">
                    <label>Upload Persyaratan Lainnya...</label>
                    <div class="file-drop-area">
                        Drag & Drop your files or <a href="#">Browse</a>
                    </div>
                    <div class="powered-by">Powered by FilePond</div>
                </div>

                <button type="submit" class="btn-submit">KIRIM</button>
            </form>
        </div>

    </div>

    <!-- FOOTER (TANPA KOTAK INPUT EMAIL SESUAI PERMINTAAN) -->
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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

    <!-- STRUKTUR MODAL POP-UP (DETAIL PERSYARATAN) -->
    <div id="modalPersyaratan" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h2>Detail Persyaratan RPKBGL Lainnya</h2>
                <button class="modal-close-icon" onclick="tutupModal()">&times;</button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Menginput Formulir Rekomendasi Proteksi Kebakaran Bangunan Gedung dan Lingkungan RPKBGL secara elektronik melalui simerah.jambikota.go.id</li>
                    <li>Identitas Pemohon/Penangung Jawab &bull; WNI : Scan Asli Kartu Tanda Penduduk (KTP-el) &bull; WNA : Scan Asli Kartu Izin Tinggal Terbatas (KITAS) atau VISA / Paspor</li>
                    <li>Jika dikuasakan Scan Asli Surat kuasa di atas kertas bermaterai sesuai peraturan yang berlaku dan KTP-el orang yang diberi kuasa</li>
                    <li>Jika Usaha Perorangan (Scan Asli) &bull; NPWP Perorangan Jika Badan Usaha (Scan Asli) &bull; Akta pendirian dan perubahan (Kantor Pusat dan Kantor Cabang, jika ada) &bull; SK pengesahan pendirian dan perubahan yang dikeluarkan oleh Kemenkumham &bull; NPWP Badan Usaha</li>
                    <li>Scan Asli Izin Mendirikan Bangunan (IMB)</li>
                    <li>Tanda Daftar Keahlian Keselamatan Kebakaran</li>
                    <li>Proposal teknis yang dilengkapi dengan (Scan Asli): &bull; Gambar teknis yang ditandangani oleh Izin Pelaku Teknis Bangunan (IPTB): &bull; As built drawing site plan &bull; As built drawing denah setiap lantai sarana proteksi kebakaran dalam gedung yang meliputi titik fire alarm, titik sprinkler, titik hidran gedung, dan titik APAR &bull; Gambar skematik instalasi proteksi kebakaran (single line diagram) ; &bull; Spesifikasi teknis: &bull; Spesifikasi peralatan dan instalasi sistem proteksi kebakaran &cir; Sistem alarm dan komunikasi darurat &cir; Sistem hidran dan pipa kebakaran &cir; Sistem pompa kebakaran &cir; Sistem sprinkler otomatis &cir; Alat Pemadam Api Ringan (APAR) &cir; Spesifikasi fasilitas sarana jalan keluar atau jalur penyelamatan &bull; Spesifikasi akses penanggulangan kebakaran dan penyelamatan ; &bull; Dokumen penyelenggaraan sistem Manajemen Keselamatan Kebakaran Gedung (MKKG) / SOP ; &bull; Data inventaris pengelolaan dan pemeliharaan Alat Pemadam Api Ringan (APAR) ; &bull; Dokumen pemeliharaan dan laporan pemeriksaan internal sistem proteksi kebakaran oleh pemilik dan pengelola gedung yang memiliki tanda daftar keahlian keselamatan kebakaran</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-tutup" onclick="tutupModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT UNTUK MENGATUR TOMBOL TAMPILKAN DETAIL & POPUP MODAL -->
    <script>
        function toggleDetail() {
            var detailDiv = document.getElementById("detailProsedur");
            if (detailDiv.style.display === "none" || detailDiv.style.display === "") {
                detailDiv.style.display = "block";
            } else {
                detailDiv.style.display = "none";
            }
        }

        var modal = document.getElementById("modalPersyaratan");
        function bukaModal() {
            modal.style.display = "block";
        }
        function tutupModal() {
            modal.style.display = "none";
        }
        // Menutup modal jika klik di luar kotak putih
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>