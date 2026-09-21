<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dasbor Relawan REDKAR | SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
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
        ========================================= */

        .navbar-custom {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            border-bottom: 1px solid var(--border);

            position: sticky;
            top: 0;
            z-index: 1020;

            padding: 14px 0;

            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
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
            color: var(--muted);
            font-weight: 600;
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
            box-shadow: 0 6px 15px rgba(220, 38, 38, 0.18);
        }

        /* =========================================
           DASHBOARD
        ========================================= */

        .dashboard-wrapper {
            padding: 42px 0 55px;
            flex: 1;
        }

        .dashboard-container {
            max-width: 1100px;
        }

        /* =========================================
           WELCOME BANNER
        ========================================= */

        .welcome-banner {
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    120deg,
                    #111827 0%,
                    #1f2937 55%,
                    #7f1d1d 150%
                );

            border-radius: 24px;

            padding: 42px 44px;

            color: white;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;

            margin-bottom: 32px;

            box-shadow:
                0 15px 35px rgba(15, 23, 42, 0.13);
        }

        .welcome-banner::before {
            content: "";
            position: absolute;

            width: 280px;
            height: 280px;

            border-radius: 50%;

            right: -100px;
            top: -150px;

            background: rgba(220, 38, 38, 0.20);
        }

        .welcome-banner::after {
            content: "\f06d";

            font-family: "Font Awesome 6 Free";
            font-weight: 900;

            position: absolute;

            right: 50px;
            bottom: -35px;

            font-size: 180px;

            color: rgba(255,255,255,0.035);

            transform: rotate(-12deg);

            pointer-events: none;
        }

        .welcome-text {
            position: relative;
            z-index: 2;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            font-size: 11px;
            font-weight: 800;

            color: #fca5a5;

            text-transform: uppercase;
            letter-spacing: 1.2px;

            margin-bottom: 12px;
        }

        .welcome-label i {
            font-size: 10px;
        }

        .welcome-text h2 {
            font-size: 29px;
            font-weight: 800;

            margin-bottom: 10px;

            letter-spacing: -0.7px;
        }

        .welcome-text p {
            color: #cbd5e1;

            font-size: 14px;
            line-height: 1.7;

            max-width: 620px;

            margin: 0;
        }

        .welcome-status {
            position: relative;
            z-index: 3;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 11px 17px;

            border-radius: 12px;

            font-size: 11px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: 0.5px;

            box-shadow: 0 7px 18px rgba(0,0,0,0.10);
        }

        /* Pesan Tunggu Konfirmasi */
        .pending-note {
            margin-top: 15px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            
            background: rgba(253, 230, 138, 0.1); /* Yellow transparent */
            border: 1px solid rgba(253, 230, 138, 0.2);
            padding: 12px 16px;
            border-radius: 12px;
            
            color: #fde68a;
            font-size: 11.5px;
            line-height: 1.6;
            max-width: 300px;
            text-align: right;
            backdrop-filter: blur(4px);
        }

        .pending-note i {
            font-size: 16px;
            margin-top: 2px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .status-diterima {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-ditolak {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* =========================================
           SECTION HEADING
        ========================================= */

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;

            margin-bottom: 17px;
        }

        .section-heading h3 {
            font-size: 17px;
            font-weight: 800;

            color: var(--dark);

            margin: 0;
        }

        .section-heading p {
            font-size: 12px;
            color: var(--muted);

            margin: 4px 0 0;
        }

        /* =========================================
           ACTION CARD
        ========================================= */

        .action-card {
            position: relative;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 20px;

            padding: 32px;

            height: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;

            box-shadow:
                0 5px 15px rgba(15, 23, 42, 0.035);
        }

        .action-card:hover {
            transform: translateY(-5px);

            border-color: #fecaca;

            box-shadow:
                0 18px 35px rgba(15, 23, 42, 0.08);
        }

        .card-icon {
            width: 68px;
            height: 68px;

            border-radius: 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 27px;

            margin-bottom: 20px;

            transition: transform 0.25s ease;
        }

        .action-card:hover .card-icon {
            transform: scale(1.06);
        }

        .icon-blue {
            background: var(--blue-soft);
            color: var(--blue);
            border: 1px solid #dbeafe;
        }

        .action-card h4 {
            font-size: 18px;
            font-weight: 800;

            color: var(--dark);

            margin-bottom: 10px;
        }

        .action-card p {
            font-size: 13px;
            color: var(--muted);

            line-height: 1.7;

            max-width: 600px;

            margin-bottom: 25px;
        }

        .btn-card {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            width: 100%;

            background: var(--dark);
            color: white;

            border: 1px solid var(--dark);

            padding: 12px 18px;

            border-radius: 11px;

            font-size: 12px;
            font-weight: 800;

            transition: all 0.25s ease;
        }

        .btn-card:hover {
            background: var(--red);
            border-color: var(--red);
            color: white;

            box-shadow: 0 8px 18px rgba(220, 38, 38, 0.18);
        }

        .btn-card i {
            font-size: 11px;
            transition: transform 0.2s ease;
        }

        .btn-card:hover i {
            transform: translateX(3px);
        }

        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            padding: 22px 0;

            border-top: 1px solid var(--border);

            background: #ffffff;

            color: #94a3b8;

            font-size: 11px;
            font-weight: 600;

            text-align: center;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

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

            .dashboard-wrapper {
                padding: 25px 0 40px;
            }

            .welcome-banner {
                padding: 30px 24px;

                border-radius: 20px;

                flex-direction: column;
                align-items: center;
                text-align: center;

                gap: 22px;
            }

            .welcome-text h2 {
                font-size: 24px;
            }

            .welcome-text p {
                font-size: 13px;
            }

            .welcome-status {
                width: 100%;
                align-items: center; /* Ubah ke tengah di HP */
            }

            .pending-note {
                text-align: center;
                max-width: 100%;
                flex-direction: column;
                align-items: center;
                gap: 5px;
            }

            .badge-status {
                justify-content: center;
            }

            .section-heading {
                margin-bottom: 14px;
            }

            .action-card {
                padding: 27px 22px;
            }
        }

        @media (max-width: 480px) {

            .nav-brand-text .sub {
                display: none;
            }

            .welcome-banner::after {
                right: -15px;
                font-size: 130px;
            }

            .welcome-text h2 {
                font-size: 22px;
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

            <a href="/" class="nav-logos">

                <img
                    src="/images/logo-redkar.png"
                    alt="Logo Redkar"
                    onerror="this.src='https://via.placeholder.com/42x42?text=RK'"
                >

                <div class="nav-brand-text">
                    <span class="main">REDKAR KOTA JAMBI</span>
                    <span class="sub">SIMERAH KOJA • PORTAL RELAWAN</span>
                </div>

            </a>

            <div class="user-menu">

                <div class="user-profile">

                    <span class="d-none d-md-inline">
                        {{ Auth::guard('redkar')->user()->nama_lengkap ?? 'Relawan' }}
                    </span>

                    <i class="fas fa-circle-user"></i>

                </div>

                <form action="/logout-redkar" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn-logout">

                        <i class="fas fa-right-from-bracket"></i>

                        <span class="d-none d-md-inline">
                            KELUAR
                        </span>

                    </button>
                </form>

            </div>

        </div>
    </nav>
<div class="welcome-label">
                        <i class="fas fa-fire-flame-curved"></i>
                        CEK REVISI DI GRUP!!!!!!!!!!!!!!!!!!!!
                    </div>

    <!-- =========================================
         MAIN CONTENT
    ========================================== -->

    <main class="dashboard-wrapper">

        <div class="container dashboard-container">

            <!-- WELCOME -->

            <div class="welcome-banner">

                <div class="welcome-text">

                    <div class="welcome-label">
                        <i class="fas fa-fire-flame-curved"></i>
                        Portal Relawan Pemadam Kebakaran
                    </div>

                    <h2>
                        Halo,
                        {{ Auth::guard('redkar')->user()->nama_lengkap ?? 'Anggota Redkar' }}!
                    </h2>

                    <p>
                        Selamat datang di portal informasi dan layanan
                        Relawan Pemadam Kebakaran Kota Jambi.
                    </p>

                </div>

                @php
                    $status = Auth::guard('redkar')->user()->status_pendaftaran ?? 'Pending';
                @endphp

                <div class="welcome-status">

                    @if($status == 'Pending')

                        <div class="badge-status status-pending">
                            <i class="fas fa-clock"></i>
                            Menunggu Seleksi
                        </div>
                        
                        <!-- PESAN INFORMASI MENUNGGU KONFIRMASI -->
                        <div class="pending-note">
                            <i class="fas fa-info-circle"></i>
                            <span>Data pendaftaran Anda sedang dalam tahap verifikasi. Mohon menunggu, tim Admin kami akan menghubungi Anda lebih lanjut.</span>
                        </div>

                    @elseif($status == 'Diterima')

                        <div class="badge-status status-diterima">
                            <i class="fas fa-circle-check"></i>
                            Anggota Aktif
                        </div>

                    @else

                        <div class="badge-status status-ditolak">
                            <i class="fas fa-circle-xmark"></i>
                            Berkas Ditolak
                        </div>

                    @endif

                </div>

            </div>


            <!-- MENU SECTION -->

            <div class="section-heading">

                <div>
                    <h3>Layanan Relawan</h3>

                    <p>
                        Akses informasi dan data keanggotaan Anda.
                    </p>
                </div>

            </div>


            <!-- MENU CARD -->

            <div class="row justify-content-center">

                <div class="col-12 col-md-8 col-lg-6">

                    <div class="action-card">

                        <div class="card-icon icon-blue">
                            <i class="fas fa-id-card-clip"></i>
                        </div>

                        <h4>
                            Profil & Biodata Saya
                        </h4>

                        <p>
                            Lihat dan periksa kembali informasi data diri,
                            wilayah tugas, serta kelengkapan dokumen
                            pendaftaran Anda.
                        </p>

                        <a
                            href="{{ route('redkar.profil') }}"
                            class="btn-card"
                        >
                            LIHAT PROFIL SAYA
                            <i class="fas fa-arrow-right"></i>
                        </a>

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