<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relawan Pemadam Kebakaran | SIMERAH KOJA</title>

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

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; cursor: pointer; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* --- NAVBAR STYLES --- */
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
        .breadcrumb-custom span { color: #ef4444; }
        .breadcrumb-custom a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s;
        }
        .breadcrumb-custom a:hover { color: #ffffff; }

        /* --- REDKAR CONTENT STYLES --- */
        .info-sidebar h3 {
            font-weight: 800;
            color: #111827;
            margin-bottom: 30px;
            font-size: 24px;
        }
        .info-block { margin-bottom: 25px; }
        .info-block h5 {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .info-block h5 i {
            color: #ef4444;
            font-size: 18px;
            width: 25px;
        }
        .info-block ul {
            padding-left: 35px;
            font-size: 13px;
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 0;
        }
        .info-block p {
            padding-left: 25px;
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 0;
        }
        
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

        /* Form Card */
        .form-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #e5e7eb;
            padding: 40px;
        }
        .form-card .form-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-card .form-title img {
            height: 45px;
            margin: 0 5px;
        }
        .form-card .form-title h2 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-top: 15px;
        }
        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            text-transform: capitalize;
        }
        .form-control, .form-select {
            font-size: 13px;
            padding: 10px 15px;
            border-color: #d1d5db;
            color: #4b5563;
        }
        .form-control:focus, .form-select:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.1);
        }
        .file-upload-wrapper {
            border: 2px dashed #d1d5db;
            border-radius: 6px;
            padding: 30px 20px;
            text-align: center;
            background-color: #f8fafc;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .file-upload-wrapper:hover {
            border-color: #ef4444;
            background-color: #fef2f2;
        }
        .file-upload-wrapper p {
            margin: 0;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
        }
        .file-upload-wrapper p span {
            text-decoration: underline;
            color: #111827;
        }
        .btn-submit {
            background-color: #ef4444;
            color: white;
            font-weight: 700;
            font-size: 13px;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .btn-submit:hover { background-color: #dc2626; }
        .readonly-input {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }

        /* --- FOOTER STYLES --- */
        .footer-bottom {
            background-color: #1a1a1a;
            color: #9ca3af;
            padding: 50px 5%;
            font-size: 13px;
            margin-top: 60px;
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
        .footer-links ul { list-style: none; padding-left: 0; }
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

    <!-- ALERT SUKSES FLOATING -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert()"><i class="fas fa-times"></i></button>
        </div>
        <script>
            function closeAlert() {
                let alertBox = document.getElementById('globalSuccessAlert');
                if(alertBox) { 
                    alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards'; 
                    setTimeout(() => alertBox.remove(), 400); 
                }
            }
            setTimeout(closeAlert, 5000);
        </script>
    @endif

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
                    <li><a href="#">PKS</a></li>
                </ul>
            </li>

            <li><a href="/redkar" style="color: #ef4444;">Redkar</a></li>
            <li><a href="/login" class="btn-login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>RELAWAN PEMADAM KEBAKARAN</h1>
            <div class="breadcrumb-custom mt-2">
                <a href="/">Home</a> 
                <i class="fas fa-angle-double-right mx-2" style="font-size: 10px; color: #9ca3af;"></i> 
                <span>RELAWAN PEMADAM KEBAKARAN (REDKAR)</span>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="container mt-5">
        <div class="row g-5">

            <!-- Kiri: Informasi Syarat & Kontak -->
            <div class="col-lg-4">
                <div class="info-sidebar position-sticky" style="top: 100px;">
                    <h3>Informasi</h3>

                    <div class="info-block">
                        <h5><i class="fas fa-check-square"></i> Syarat Keanggotaan</h5>
                        <ul>
                            <li>penduduk yang berdomisili di wilayah kekuasaan Daerah Kota Jambi dan berusia minimal 18 tahun;</li>
                            <li>sehat jasmani dan rohani;</li>
                            <li>memiliki jiwa penolong, semangat pengabdian dan dedikasi tinggi;</li>
                            <li>mampu bekerja secara mandiri dan dapat bekerja sama dengan pihak lain; dan</li>
                            <li>terdaftar dan mendapatkan nomor register REDKAR dari Dinas.</li>
                        </ul>
                    </div>

                    <div class="info-block">
                        <h5><i class="fas fa-envelope"></i> Email</h5>
                        <p><a href="mailto:damkar.jbi@gmail.com" style="color: #6b7280; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#6b7280'">damkar.jbi@gmail.com</a></p>
                    </div>

                    <div class="info-block">
                        <h5><i class="fas fa-map-marker-alt"></i> Address</h5>
                        <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru</p>
                    </div>

                    <div class="social-links" style="margin-top: 30px;">
                        <a href="mailto:damkar.jbi@gmail.com" target="_blank" title="Email"><i class="fas fa-envelope"></i></a>
                        <a href="https://twitter.com/damkarkotajambi" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <!-- Kanan: Form Pendaftaran -->
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-title">
                        <img src="/images/logo.png" alt="Logo Damkar">
                        <img src="/images/logo-redkar.png" alt="Logo Redkar">
                        <h2>Daftar Sebagai Relawan</h2>
                    </div>

                    <!-- ALERT JIKA TERDAPAT ERROR VALIDASI -->
                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3 mb-4" style="font-size: 13px; border-radius: 8px;">
                            <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Formulir gagal dikirim:</div>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- IMPLEMENTASI LANGKAH 5: FORM ACTION & CSRF -->
                    <form action="/redkar/daftar" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK sesuai KTP" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status Perkawinan</label>
                                <select class="form-select" name="status_perkawinan" required>
                                    <option value="" selected disabled>Pilih Status Perkawinan</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Agama</label>
                                <select class="form-select" name="agama" required>
                                    <option value="" selected disabled>Pilih Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Nomor Telpon (WhatsApp Aktif)</label>
                                <input type="text" class="form-control" name="nomor_telp" value="{{ old('nomor_telp') }}" placeholder="Contoh: 081234567890" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Kartu Tanda Penduduk (KTP)</label>
                                <div class="file-upload-wrapper" onclick="document.getElementById('ktp_upload').click()">
                                    <p id="ktp_file_label"><i class="fas fa-cloud-upload-alt me-1"></i> Klik untuk unggah file KTP atau <span>Browse</span> (.jpg, .png, .pdf max 2MB)</p>
                                    <input type="file" id="ktp_upload" name="ktp" class="d-none" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">RT/RW</label>
                                <input type="text" class="form-control" name="rt_rw" value="{{ old('rt_rw') }}" placeholder="Contoh: RT 05 / RW 02" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" name="kode_pos" value="{{ old('kode_pos') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Provinsi</label>
                                <input type="text" class="form-control readonly-input" name="provinsi" value="JAMBI" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input type="text" class="form-control readonly-input" name="kabupaten_kota" value="KOTA JAMBI" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select class="form-select" name="kecamatan" id="kecamatan" required>
                                    <option value="" selected disabled>Pilih Kecamatan</option>
                                    <option value="Alam Barajo">Alam Barajo</option>
                                    <option value="Danau Sipin">Danau Sipin</option>
                                    <option value="Danau Teluk">Danau Teluk</option>
                                    <option value="Jambi Selatan">Jambi Selatan</option>
                                    <option value="Jambi Timur">Jambi Timur</option>
                                    <option value="Jelutung">Jelutung</option>
                                    <option value="Kota Baru">Kota Baru</option>
                                    <option value="Paal Merah">Paal Merah</option>
                                    <option value="Pasar Jambi">Pasar Jambi</option>
                                    <option value="Pelayangan">Pelayangan</option>
                                    <option value="Telanaipura">Telanaipura</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kelurahan</label>
                                <select class="form-select" name="kelurahan" id="kelurahan" required>
                                    <option value="" selected disabled>Pilih Kelurahan</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <select class="form-select" name="pendidikan_terakhir" required>
                                    <option value="" selected disabled>Pilih Pendidikan Terakhir</option>
                                    <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sehat Jasmani</label>
                                <select class="form-select" name="sehat_jasmani" required>
                                    <option value="" selected disabled>Pilih Kondisi</option>
                                    <option value="Ya" {{ old('sehat_jasmani') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('sehat_jasmani') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Buta Warna</label>
                                <select class="form-select" name="buta_warna" required>
                                    <option value="" selected disabled>Pilih Kondisi</option>
                                    <option value="Tidak" {{ old('buta_warna') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    <option value="Ya" {{ old('buta_warna') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Golongan Darah</label>
                                <select class="form-select" name="golongan_darah" required>
                                    <option value="" selected disabled>Pilih Golongan Darah</option>
                                    <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                                </select>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane me-2"></i>KIRIM PENDAFTARAN</button>
                            </div>
                        </div>
                    </form>
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

    <!-- Script Dynamic Dropdown Kecamatan ke Kelurahan & File Upload Preview -->
    <script>
        const dataWilayah = {
            "Alam Barajo": ["Bagan Pete", "Beliung", "Kenali Besar", "Mayang Mangurai", "Pinang Merah", "Rawa Sari", "Simpang Rimbo"],
            "Danau Sipin": ["Legok", "Murni", "Selamat", "Solok Sipin", "Sungai Putri"],
            "Danau Teluk": ["Olak Kemang", "Pasir Panjang", "Tanjung Pasir", "Tanjung Raden", "Ulu Gedong"],
            "Jambi Selatan": ["Pakuan Baru", "Pasir Putih", "Tambak Sari", "The Hok", "Wijaya Pura"],
            "Jambi Timur": ["Budiman", "Kasang", "Kasang Jaya", "Rajawali", "Sejinjang", "Sulanjana", "Talang Banjar", "Tanjung Pinang", "Tanjung Sari"],
            "Jelutung": ["Cempaka Putih", "Handil Jaya", "Jelutung", "Kebun Handil", "Lebak Bandung", "Payo Lebar", "Talang Jauh"],
            "Kota Baru": ["Kenali Asam", "Kenali Asam Atas", "Kenali Asam Bawah", "Paal Lima", "Simpang Tiga Sipin", "Sukakarya", "Talang Gulo"],
            "Paal Merah": ["Bakung Jaya", "Eka Jaya", "Lingkar Selatan", "Paal Merah", "Payo Selincah", "Talang Bakung"],
            "Pasar Jambi": ["Beringin", "Orang Kayo Hitam", "Pasar Jambi", "Sungai Asam"],
            "Pelayangan": ["Arab Melayu", "Jelmu", "Mudung Laut", "Tahtul Yaman", "Tanjung Johor", "Tengah"],
            "Telanaipura": ["Aur Kenali", "Buluran Kenali", "Pematang Sulur", "Penyengat Rendah", "Simpang Empat Sipin", "Telanaipura", "Teluk Kenali"]
        };

        document.getElementById('kecamatan').addEventListener('change', function() {
            const kecamatan = this.value;
            const kelurahanSelect = document.getElementById('kelurahan');

            kelurahanSelect.innerHTML = '<option value="" selected disabled>Pilih Kelurahan</option>';

            if (kecamatan && dataWilayah[kecamatan]) {
                dataWilayah[kecamatan].forEach(function(kelurahan) {
                    const option = document.createElement('option');
                    option.value = kelurahan;
                    option.textContent = kelurahan;
                    kelurahanSelect.appendChild(option);
                });
            }
        });

        // Menampilkan nama file KTP saat file dipilih
        document.getElementById('ktp_upload').addEventListener('change', function() {
            const fileLabel = document.getElementById('ktp_file_label');
            if (this.files && this.files[0]) {
                fileLabel.innerHTML = `<span class="text-success"><i class="fas fa-check-circle me-1"></i> File dipilih: <strong>${this.files[0].name}</strong></span>`;
            }
        });
    </script>
</body>
</html>