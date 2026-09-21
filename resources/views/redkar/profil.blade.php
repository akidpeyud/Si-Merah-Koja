<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Saya | REDKAR SIMERAH KOJA</title>
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --dark: #111827;
            --dark-soft: #1f2937;

            --red: #dc2626;
            --red-dark: #b91c1c;
            --red-soft: #fef2f2;
            --red-border: #fecaca;

            --green: #16a34a;
            --green-soft: #f0fdf4;

            --yellow: #d97706;
            --yellow-soft: #fffbeb;

            --blue: #2563eb;
            --blue-soft: #eff6ff;

            --body: #f5f7fa;
            --white: #ffffff;

            --text: #111827;
            --muted: #64748b;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--body);
            color: var(--text);

            min-height: 100vh;

            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
        }

        /* =========================================
           NAVBAR
        ========================================== */

        .navbar-custom {
            background: rgba(255, 255, 255, 0.96);

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            border-bottom: 1px solid var(--border);

            position: sticky;
            top: 0;

            z-index: 1020;

            padding: 14px 0;

            box-shadow:
                0 4px 20px rgba(15, 23, 42, 0.04);
        }

        .nav-inner {
            min-height: 42px;
        }

        .nav-logos {
            display: flex;
            align-items: center;
            gap: 12px;

            color: var(--dark);
        }

        .nav-logos:hover {
            color: var(--dark);
        }

        .nav-logos img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .nav-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .nav-brand-text .main {
            font-size: 15px;
            font-weight: 800;

            letter-spacing: 0.3px;

            color: var(--dark);
        }

        .nav-brand-text .sub {
            font-size: 10px;
            font-weight: 600;

            color: var(--muted);

            margin-top: 3px;

            letter-spacing: 0.4px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 9px;

            padding: 7px 11px;

            border-radius: 10px;

            color: #475569;

            font-size: 13px;
            font-weight: 700;

            background: #f8fafc;

            border: 1px solid #edf0f3;
        }

        .user-profile i {
            font-size: 22px;
            color: #94a3b8;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            background: var(--red-soft);
            color: var(--red);

            border: 1px solid var(--red-border);

            padding: 9px 14px;

            border-radius: 10px;

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition: all 0.25s ease;
        }

        .btn-logout:hover {
            background: var(--red);
            color: white;
            border-color: var(--red);

            transform: translateY(-1px);

            box-shadow:
                0 6px 15px rgba(220, 38, 38, 0.18);
        }

        /* =========================================
           PAGE
        ========================================== */

        .page-wrapper {
            padding: 38px 0 55px;
            flex: 1;
        }

        .profile-container {
            max-width: 960px;
        }

        /* =========================================
           PAGE HEADER
        ========================================== */

        .page-header {
            display: flex;
            align-items: center;
            gap: 14px;

            margin-bottom: 20px;
        }

        .btn-back {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: white;

            color: var(--dark);

            border: 1px solid var(--border);

            border-radius: 11px;

            transition: all 0.25s ease;

            box-shadow:
                0 3px 8px rgba(15, 23, 42, 0.03);
        }

        .btn-back:hover {
            background: var(--dark);
            border-color: var(--dark);
            color: white;

            transform: translateX(-2px);
        }

        .page-header-text h1 {
            font-size: 23px;
            font-weight: 800;

            color: var(--dark);

            margin: 0;
        }

        .page-header-text p {
            font-size: 12px;

            color: var(--muted);

            margin: 4px 0 0;
        }

        /* =========================================
           PROFILE CARD
        ========================================== */

        .profile-card {
            background: white;

            border-radius: 24px;

            border: 1px solid var(--border);

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, 0.055);
        }

        /* =========================================
           PROFILE HEADER
        ========================================== */

        .profile-header {
            position: relative;

            overflow: hidden;

            background:
                linear-gradient(
                    120deg,
                    #111827 0%,
                    #1f2937 55%,
                    #7f1d1d 150%
                );

            padding: 36px 38px;

            color: white;

            display: flex;
            align-items: center;

            gap: 23px;
        }

        .profile-header::before {
            content: "";

            position: absolute;

            width: 260px;
            height: 260px;

            border-radius: 50%;

            right: -110px;
            top: -160px;

            background: rgba(220, 38, 38, 0.18);
        }

        .profile-header::after {
            content: "\f06d";

            font-family: "Font Awesome 6 Free";
            font-weight: 900;

            position: absolute;

            right: 35px;
            bottom: -48px;

            font-size: 170px;

            color: rgba(255,255,255,0.035);

            transform: rotate(-12deg);

            pointer-events: none;
        }

        .profile-avatar {
            position: relative;
            z-index: 2;

            width: 88px;
            height: 88px;

            flex-shrink: 0;

            background:
                linear-gradient(
                    145deg,
                    #374151,
                    #1f2937
                );

            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 36px;

            color: #cbd5e1;

            border: 1px solid rgba(255,255,255,0.12);

            box-shadow:
                0 10px 25px rgba(0,0,0,0.25);
        }

        .profile-header-info {
            position: relative;
            z-index: 2;
        }

        .profile-header-info h3 {
            font-size: 22px;
            font-weight: 800;

            margin-bottom: 7px;

            letter-spacing: -0.4px;
        }

        .profile-id {
            color: #cbd5e1;

            font-size: 12px;

            margin-bottom: 13px;
        }

        .profile-id i {
            color: #fca5a5;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 11px;

            border-radius: 8px;

            font-size: 10px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* =========================================
           PROFILE BODY
        ========================================== */

        .profile-body {
            padding: 34px 38px;
        }

        /* =========================================
           SECTION TITLE
        ========================================== */

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;

            font-size: 12px;

            font-weight: 800;

            color: #475569;

            text-transform: uppercase;

            letter-spacing: 1px;

            margin-bottom: 22px;

            padding-bottom: 13px;

            border-bottom: 1px solid var(--border);
        }

        .section-title i {
            color: var(--red);
            font-size: 13px;
        }

        /* =========================================
           INFO ITEM
        ========================================== */

        .info-group {
            margin-bottom: 22px;
        }

        .info-group:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-size: 10px;

            color: #94a3b8;

            font-weight: 800;

            margin-bottom: 6px;

            text-transform: uppercase;

            letter-spacing: 0.7px;
        }

        .info-value {
            color: var(--dark);

            font-size: 13px;

            font-weight: 700;

            line-height: 1.6;

            word-break: break-word;
        }

        .info-value .wa-icon {
            color: #16a34a;
        }

        .blood-value {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: var(--red);

            font-size: 17px;

            font-weight: 800;
        }

        .blood-value i {
            font-size: 15px;
        }

        /* =========================================
           COLUMN DIVIDER
        ========================================== */

        .profile-column-right {
            border-left: 1px solid var(--border);
        }

        /* =========================================
           DOCUMENT SECTION
        ========================================== */

        .document-section {
            margin-top: 30px;

            padding-top: 28px;

            border-top: 1px solid var(--border);
        }

        .document-box {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 17px 18px;

            border-radius: 14px;

            background: #f8fafc;

            border: 1px solid var(--border);
        }

        .document-info {
            display: flex;
            align-items: center;

            gap: 13px;
        }

        .document-icon {
            width: 43px;
            height: 43px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: var(--blue-soft);

            color: var(--blue);

            font-size: 17px;
        }

        .document-info h5 {
            font-size: 13px;

            font-weight: 800;

            color: var(--dark);

            margin: 0 0 3px;
        }

        .document-info p {
            font-size: 10px;

            color: var(--muted);

            margin: 0;
        }

        .btn-view-ktp {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            flex-shrink: 0;

            background: var(--blue-soft);

            color: var(--blue);

            border: 1px solid #bfdbfe;

            padding: 10px 15px;

            border-radius: 9px;

            font-size: 11px;

            font-weight: 800;

            transition: all 0.25s ease;
        }

        .btn-view-ktp:hover {
            background: var(--blue);

            border-color: var(--blue);

            color: white;

            transform: translateY(-1px);
        }

        .document-unavailable {
            display: flex;
            align-items: center;
            gap: 9px;

            color: #64748b;

            font-size: 12px;

            font-weight: 700;
        }

        .document-unavailable i {
            color: #f59e0b;
        }

        /* =========================================
           SECURITY ALERT
        ========================================== */

        .alert-info-custom {
            display: flex;
            align-items: flex-start;
            gap: 13px;

            margin-top: 20px;

            padding: 16px 18px;

            background: var(--yellow-soft);

            border: 1px solid #fde68a;

            border-radius: 13px;

            color: #92400e;

            font-size: 11px;

            line-height: 1.65;
        }

        .alert-info-custom > i {
            flex-shrink: 0;

            font-size: 18px;

            color: #f59e0b;

            margin-top: 1px;
        }

        .alert-info-custom strong {
            font-size: 11px;

            color: #78350f;
        }

        /* =========================================
           FOOTER
        ========================================== */

        .footer {
            padding: 22px 0;

            border-top: 1px solid var(--border);

            background: white;

            color: #94a3b8;

            font-size: 11px;

            font-weight: 600;

            text-align: center;
        }

        /* =========================================
           RESPONSIVE
        ========================================== */

        @media (max-width: 768px) {

            .navbar-custom {
                padding: 11px 0;
            }

            .nav-brand-text .main {
                font-size: 13px;
            }

            .nav-brand-text .sub {
                font-size: 9px;
            }

            .nav-logos img {
                width: 38px;
                height: 38px;
            }

            .user-menu {
                gap: 7px;
            }

            .user-profile {
                padding: 6px;

                border: none;

                background: transparent;
            }

            .user-profile i {
                font-size: 24px;
            }

            .btn-logout {
                width: 38px;
                height: 38px;

                padding: 0;

                border-radius: 10px;
            }

            .page-wrapper {
                padding: 25px 0 40px;
            }

            .page-header {
                margin-bottom: 16px;
            }

            .page-header-text h1 {
                font-size: 20px;
            }

            .page-header-text p {
                font-size: 11px;
            }

            .profile-header {
                padding: 28px 22px;

                flex-direction: column;

                text-align: center;

                gap: 16px;
            }

            .profile-avatar {
                width: 76px;
                height: 76px;

                border-radius: 19px;

                font-size: 31px;
            }

            .profile-header-info h3 {
                font-size: 19px;
            }

            .profile-body {
                padding: 28px 22px;
            }

            .profile-column-right {
                border-left: none;

                border-top: 1px solid var(--border);

                margin-top: 27px;

                padding-top: 27px;
            }

            .document-box {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-view-ktp {
                width: 100%;
            }
        }

        @media (max-width: 480px) {

            .nav-brand-text .sub {
                display: none;
            }

            .profile-card {
                border-radius: 19px;
            }

            .profile-header {
                border-radius: 19px 19px 0 0;
            }

            .profile-header::after {
                right: -20px;
                font-size: 130px;
            }

            .footer {
                font-size: 10px;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================================
         NAVBAR
    ========================================== -->

    <nav class="navbar-custom">

        <div class="container nav-inner d-flex justify-content-between align-items-center">

            <a href="/redkar/dashboard" class="nav-logos">

                <img
                    src="/images/logo-redkar.png"
                    alt="Logo Redkar"
                >

                <div class="nav-brand-text">

                    <span class="main">
                        REDKAR KOTA JAMBI
                    </span>

                    <span class="sub">
                        SIMERAH KOJA • PORTAL RELAWAN
                    </span>

                </div>

            </a>


            <div class="user-menu">

                <div class="user-profile">

                    <span class="d-none d-md-inline">
                        {{ $user->nama_lengkap }}
                    </span>

                    <i class="fas fa-circle-user"></i>

                </div>


                <form
                    action="/logout-redkar"
                    method="POST"
                    class="m-0"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn-logout"
                    >

                        <i class="fas fa-right-from-bracket"></i>

                        <span class="d-none d-md-inline">
                            KELUAR
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </nav>


    <!-- =========================================
         MAIN CONTENT
    ========================================== -->

    <main class="page-wrapper">

        <div class="container profile-container">


            <!-- PAGE HEADER -->

            <div class="page-header">

                <a
                    href="/redkar/dashboard"
                    class="btn-back"
                    title="Kembali ke Dashboard"
                >
                    <i class="fas fa-arrow-left"></i>
                </a>

                <div class="page-header-text">

                    <h1>
                        Profil Saya
                    </h1>

                    <p>
                        Informasi data dan keanggotaan relawan REDKAR.
                    </p>

                </div>

            </div>


            <!-- PROFILE CARD -->

            <div class="profile-card">


                <!-- =================================
                     PROFILE HEADER
                ================================== -->

                <div class="profile-header">

                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>


                    <div class="profile-header-info">

                        <h3>
                            {{ $user->nama_lengkap }}
                        </h3>

                        <div class="profile-id">

                        </div>


                        @if($user->status_pendaftaran == 'Pending')

                            <span class="badge-status bg-warning text-dark">

                                <i class="fas fa-clock"></i>

                                Menunggu Seleksi

                            </span>

                        @elseif($user->status_pendaftaran == 'Diterima')

                            <span class="badge-status bg-success text-white">

                                <i class="fas fa-circle-check"></i>

                                Anggota Aktif

                            </span>

                        @else

                            <span class="badge-status bg-danger text-white">

                                <i class="fas fa-circle-xmark"></i>

                                Berkas Ditolak

                            </span>

                        @endif

                    </div>

                </div>


                <!-- =================================
                     PROFILE BODY
                ================================== -->

                <div class="profile-body">


                    <div class="row">


                        <!-- =================================
                             INFORMASI PRIBADI
                        ================================== -->

                        <div class="col-md-6 pe-md-4">

                            <h4 class="section-title">

                                <i class="fas fa-user"></i>

                                Informasi Pribadi

                            </h4>


                            <div class="info-group">

                                <div class="info-label">
                                    Nama Lengkap
                                </div>

                                <div class="info-value">
                                    {{ $user->nama_lengkap }}
                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Nomor Induk Kependudukan (NIK)
                                </div>

                                <div class="info-value">
                                    {{ $user->nik }}
                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Tempat, Tanggal Lahir
                                </div>

                                <div class="info-value">

                                    {{ $user->tempat_lahir }},

                                    {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') }}

                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Jenis Kelamin & Agama
                                </div>

                                <div class="info-value">

                                    {{ $user->jenis_kelamin }}

                                    <span class="text-muted mx-1">•</span>

                                    {{ $user->agama }}

                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Nomor Telepon / WhatsApp
                                </div>

                                <div class="info-value">

                                    <i class="fab fa-whatsapp wa-icon me-1"></i>

                                    {{ $user->nomor_telp }}

                                </div>

                            </div>

                        </div>


                        <!-- =================================
                             WILAYAH & PEKERJAAN
                        ================================== -->

                        <div class="col-md-6 ps-md-4 profile-column-right">

                            <h4 class="section-title">

                                <i class="fas fa-location-dot"></i>

                                Wilayah & Pekerjaan

                            </h4>


                            <div class="info-group">

                                <div class="info-label">
                                    Alamat Lengkap
                                </div>

                                <div class="info-value">
                                    {{ $user->alamat }},
                                    RT/RW {{ $user->rt_rw }}
                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Kecamatan & Kelurahan
                                </div>

                                <div class="info-value">

                                    {{ $user->kecamatan }}

                                    <span class="text-muted mx-1">•</span>

                                    {{ $user->kelurahan }}

                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Pendidikan & Pekerjaan
                                </div>

                                <div class="info-value">

                                    {{ $user->pendidikan_terakhir }}

                                    <span class="text-muted mx-1">•</span>

                                    {{ $user->pekerjaan }}

                                </div>

                            </div>


                            <div class="info-group">

                                <div class="info-label">
                                    Golongan Darah
                                </div>

                                <div class="blood-value">

                                    <i class="fas fa-droplet"></i>

                                    {{ $user->golongan_darah }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================
                         DOKUMEN PENDUKUNG
                    ================================== -->

                    <div class="document-section">

                        <h4 class="section-title">

                            <i class="fas fa-folder-open"></i>

                            Dokumen Pendukung

                        </h4>


                        @if($user->file_ktp && $user->file_ktp !== 'offline_registered')

                            <div class="document-box">

                                <div class="document-info">

                                    <div class="document-icon">

                                        <i class="fas fa-id-card"></i>

                                    </div>

                                    <div>

                                        <h5>
                                            Kartu Tanda Penduduk
                                        </h5>

                                        <p>
                                            Dokumen KTP yang terdaftar pada sistem.
                                        </p>

                                    </div>

                                </div>


                                <a
                                    href="{{ asset('storage/' . $user->file_ktp) }}"
                                    target="_blank"
                                    class="btn-view-ktp"
                                >

                                    <i class="fas fa-eye"></i>

                                    Lihat Dokumen

                                </a>

                            </div>

                        @else

                            <div class="document-box">

                                <div class="document-unavailable">

                                    <i class="fas fa-circle-exclamation"></i>

                                    File KTP tidak tersedia.

                                </div>

                            </div>

                        @endif

                    </div>


                    <!-- =================================
                         INFORMATION ALERT
                    ================================== -->

                    <div class="alert-info-custom">

                        <i class="fas fa-shield-halved"></i>

                        <div>

                            <strong>
                                Informasi Data Terkunci
                            </strong>

                            <br>

                            Untuk menjaga validitas keanggotaan,
                            data profil tidak dapat diubah secara mandiri.
                            Jika terdapat kesalahan data, silakan hubungi
                            Admin Disdamkartan Kota Jambi.

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </main>


    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer class="footer">

        <div class="container">

            <p class="mb-0">

                &copy; {{ date('Y') }}

                SIMERAH KOJA -

                Relawan Pemadam Kebakaran Kota Jambi.

            </p>

        </div>

    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>