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
            --purple: #7c3aed;
            --purple-soft: #f5f3ff;
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

        /* NAVBAR */
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

        /* DASHBOARD */
        .dashboard-wrapper {
            padding: 35px 0 55px;
            flex: 1;
        }

        .dashboard-container {
            max-width: 1100px;
        }

        /* WELCOME BANNER */
        .welcome-banner {
            position: relative;
            overflow: hidden;
            background: linear-gradient(120deg, #111827 0%, #1f2937 55%, #7f1d1d 150%);
            border-radius: 24px;
            padding: 42px 44px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 32px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.13);
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

        .pending-note {
            margin-top: 15px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: rgba(253, 230, 138, 0.1);
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

        /* SECTION HEADING */
        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 20px;
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

        /* ACTION CARD */
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
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            box-shadow: 0 5px 15px rgba(15, 23, 42, 0.035);
        }

        .action-card:hover {
            transform: translateY(-5px);
            border-color: #fecaca;
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
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

        .icon-red {
            background: var(--red-soft);
            color: var(--red);
            border: 1px solid var(--red-border);
        }

        .icon-purple {
            background: var(--purple-soft);
            color: var(--purple);
            border: 1px solid #ede9fe;
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
            margin-bottom: 25px;
            flex-grow: 1;
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
            cursor: pointer;
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

        /* FOOTER */
        .footer {
            padding: 22px 0;
            border-top: 1px solid var(--border);
            background: #ffffff;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .welcome-banner {
                padding: 30px 24px;
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 22px;
            }
            .welcome-status {
                width: 100%;
                align-items: center;
            }
            .pending-note {
                text-align: center;
                max-width: 100%;
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar-custom">
        <div class="container nav-inner d-flex justify-content-between align-items-center">
            <a href="/" class="nav-logos">
                <img src="/images/logo-redkar.png" alt="Logo Redkar" onerror="this.src='https://via.placeholder.com/42x42?text=RK'">
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
                        <span class="d-none d-md-inline">KELUAR</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
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
                        Halo, {{ Auth::guard('redkar')->user()->nama_lengkap ?? 'Anggota Redkar' }}!
                    </h2>
                    <p>
                        Selamat datang di portal informasi dan layanan Relawan Pemadam Kebakaran Kota Jambi.
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
                    <p>Akses informasi, dokumen keanggotaan, dan data diri Anda.</p>
                </div>
            </div>

            <!-- MENU CARDS ROW (4 Kontainer Seimbang) -->
            <div class="row g-4 justify-content-center">

                <!-- Card 1: Profil -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="action-card">
                        <div class="card-icon icon-blue">
                            <i class="fas fa-id-card-clip"></i>
                        </div>
                        <h4>Profil & Biodata Saya</h4>
                        <p>Lihat dan periksa kembali informasi data diri, wilayah tugas, serta dokumen pendaftaran Anda.</p>
                        <a href="{{ route('redkar.profil') }}" class="btn-card">
                            LIHAT PROFIL <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Panca Dharma Modal -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="action-card">
                        <div class="card-icon icon-red">
                            <i class="fas fa-file-lines"></i>
                        </div>
                        <h4>Panca Dharma REDKAR</h4>
                        <p>Baca pedoman sumpah janji, keterteladanan, serta landasan moral Relawan Pemadam Kebakaran.</p>
                        <button type="button" class="btn-card" data-bs-toggle="modal" data-bs-target="#pancaDharmaModal">
                            BACA JANJI <i class="fas fa-book-open ms-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Card 3: Pedoman Pembinaan (Kepmendagri 364.1-306) -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="action-card">
                        <div class="card-icon icon-purple">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <h4>Pedoman REDKAR (Permendagri)</h4>
                        <p>Ringkasan ketentuan pembinaan, tugas, serta struktur organisasi REDKAR berdasarkan Kepmendagri[cite: 8].</p>
                        <button type="button" class="btn-card" data-bs-toggle="modal" data-bs-target="#kepmendagriModal">
                            LIHAT PEDOMAN <i class="fas fa-eye ms-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Card 4: Regu & Tugas REDKAR (Pengganti Kontainer Kosong) -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="action-card">
                        <div class="card-icon" style="background: #fdf4ff; color: #c084fc; border: 1px solid #f3e8ff;">
                            <i class="fas fa-users-gear"></i>
                        </div>
                        <h4>Regu & Tugas REDKAR</h4>
                        <p>Kenali pembagian regu tugas operasional mulai dari pencegahan hingga pemadaman dini di lapangan[cite: 8].</p>
                        <button type="button" class="btn-card" data-bs-toggle="modal" data-bs-target="#reguTugasModal">
                            LIHAT REGU <i class="fas fa-arrow-right ms-1"></i>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- MODAL POPUP PANCA DHARMA -->
    <div class="modal fade" id="pancaDharmaModal" tabindex="-1" aria-labelledby="pancaDharmaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.25);">
                <div class="modal-header bg-dark text-white px-4 py-3">
                    <h5 class="modal-title fw-bold fs-6" id="pancaDharmaModalLabel">
                        <i class="fas fa-fire-flame-curved text-danger me-2"></i> YUDHA BRAMA JAYA - PANCA DHARMA REDKAR
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light text-dark">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-danger">YUDHA BRAMA JAYA</h4>
                        <h5 class="fw-bold text-dark">PANCA DHARMA RELAWAN PEMADAM KEBAKARAN</h5>
                        <p class="text-muted small mb-0">Berdasarkan Keputusan Menteri Dalam Negeri Nomor 364.1-306 Tahun 2020[cite: 8]</p>
                    </div>
                    <div class="p-3 bg-white rounded border shadow-sm mb-3">
                        <p class="fst-italic text-muted mb-2">"Kami Relawan Pemadam Kebakaran Indonesia adalah insan yang beriman dan bertakwa kepada Tuhan Yang Maha Esa, berjanji:"[cite: 8]</p>
                        <ol class="ps-3 mb-0" style="line-height: 1.8;">
                            <li class="mb-2"><strong>Setia</strong> kepada Negara Kesatuan Republik Indonesia serta mengamalkan Pancasila dan Undang-Undang Dasar 1945[cite: 8].</li>
                            <li class="mb-2"><strong>Siap-sedia</strong> membantu pelaksanaan pencegahan dan penanggulangan kebakaran[cite: 8].</li>
                            <li class="mb-2"><strong>Siap sedia</strong> melaksanakan pemadaman dan penyelamatan[cite: 8].</li>
                            <li class="mb-2"><strong>Berperan aktif</strong> mewujudkan ketahanan lingkungan dari ancaman bahaya kebakaran[cite: 8].</li>
                            <li><strong>Senantiasa</strong> meningkatkan keterampilan, kesetiakawanan, dan kerja sama dalam pelaksanaan tugas[cite: 8].</li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer bg-light justify-content-between py-3 px-4">
                    <a href="{{ asset('storage/pdf/panca-dharma-redkar.pdf') }}" download class="btn btn-danger btn-sm px-3 fw-bold rounded-pill">
                        <i class="fas fa-download me-1"></i> Download PDF Panca Dharma
                    </a>
                    <button type="button" class="btn btn-dark btn-sm px-4 fw-bold rounded-pill" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL POPUP: KEPUTUSAN MENTERI DALAM NEGERI NO 364.1-306 TAHUN 2020 -->
    <div class="modal fade" id="kepmendagriModal" tabindex="-1" aria-labelledby="kepmendagriModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.25);">
                <div class="modal-header bg-dark text-white px-4 py-3">
                    <h5 class="modal-title fw-bold fs-6" id="kepmendagriModalLabel">
                        <i class="fas fa-landmark text-warning me-2"></i> KEPUTUSAN MENTERI DALAM NEGERI NOMOR 364.1-306 TAHUN 2020
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light text-dark">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-primary">PEDOMAN PEMBINAAN RELAWAN PEMADAM KEBAKARAN (REDKAR)</h4>
                        <p class="text-muted small">Ringkasan Ketentuan Resmi Berdasarkan Dokumen Kepmendagri</p>
                    </div>

                    <!-- Bagian 1: Pengertian -->
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-dark border-bottom pb-2"><i class="fas fa-info-circle text-danger me-2"></i> 1. Pengertian Umum & Tujuan</h6>
                            <p class="small text-muted mb-2"><strong>REDKAR</strong> adalah organisasi sosial berbasis masyarakat yang secara sukarela berpartisipasi mewujudkan ketahanan lingkungan dari bahaya kebakaran, dibentuk dari, oleh, dan untuk warga di lingkungan Desa/Kelurahan[cite: 8].</p>
                            <p class="small text-muted mb-0"><strong>Tujuan:</strong> Meningkatkan peran serta masyarakat dalam pencegahan/penanggulangan kebakaran, membantu pencapaian Standar Pelayanan Minimal (SPM), dan menciptakan sinergi dengan Dinas Pemadam Kebakaran[cite: 8].</p>
                        </div>
                    </div>

                    <!-- Bagian 2: Syarat & Keanggotaan -->
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-dark border-bottom pb-2"><i class="fas fa-users text-primary me-2"></i> 2. Syarat & Keanggotaan REDKAR</h6>
                            <ul class="small text-muted ps-3 mb-0" style="line-height: 1.6;">
                                <li>Penduduk berdomisili di desa/kelurahan, berusia minimal 19 tahun[cite: 8].</li>
                                <li>Sehat jasmani dan rohani serta memiliki jiwa penolong dan dedikasi tinggi[cite: 8].</li>
                                <li>Terdaftar dan mendapatkan nomor register resmi dari Dinas Pemadam Kebakaran dan Penyelamatan Kabupaten/Kota[cite: 8].</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bagian 3: Tugas Utama -->
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-dark border-bottom pb-2"><i class="fas fa-tasks text-success me-2"></i> 3. Tugas Utama REDKAR</h6>
                            <div class="row small text-muted">
                                <div class="col-md-6 mb-2">
                                    <strong>Pratugas / Pencegahan:</strong> Memantau lingkungan, identifikasi potensi bahaya, penyuluhan, dan edukasi warga[cite: 8].
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Saat Terjadi Kebakaran:</strong> Melaporkan kejadian, pemadaman dini sebelum petugas tiba, evakuasi dini korban, dan mengamankan lokasi[cite: 8].
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 4: Struktur Organisasi -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-dark border-bottom pb-2"><i class="fas fa-sitemap text-warning me-2"></i> 4. Struktur Organisasi Desa/Kelurahan</h6>
                            <p class="small text-muted mb-2">Di tingkat Desa/Kelurahan, REDKAR dibagi menjadi 3 regu utama di bawah Ketua REDKAR[cite: 8]:</p>
                            <ul class="small text-muted ps-3 mb-0" style="line-height: 1.6;">
                                <li><strong>Regu Pemadaman dan Penyelamatan:</strong> Melaksanakan pemadaman dini dan evakuasi korban[cite: 8].</li>
                                <li><strong>Regu Penyuluh:</strong> Memberikan penyuluhan dan pelatihan penanganan kebakaran sederhana bagi warga[cite: 8].</li>
                                <li><strong>Regu Komunikasi dan Informasi:</strong> Menyebarluaskan informasi pencegahan serta menyusun laporan kejadian[cite: 8].</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light justify-content-between py-3 px-4">
                    <button type="button" class="btn btn-dark btn-sm px-4 fw-bold rounded-pill" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL POPUP BARU: REGU & TUGAS OPERASIONAL REDKAR -->
    <div class="modal fade" id="reguTugasModal" tabindex="-1" aria-labelledby="reguTugasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.25);">
                <div class="modal-header bg-dark text-white px-4 py-3">
                    <h5 class="modal-title fw-bold fs-6" id="reguTugasModalLabel">
                        <i class="fas fa-users-gear text-purple me-2"></i> STRUKTUR REGU & TUGAS OPERASIONAL REDKAR
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light text-dark">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-purple" style="color: #7c3aed;">PEMBAGIAN REGU & TUGAS LAPANGAN</h4>
                        <p class="text-muted small">Berdasarkan Lampiran Keputusan Menteri Dalam Negeri</p>
                    </div>

                    <!-- Regu 1 -->
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-danger"><i class="fas fa-fire-extinguisher me-2"></i> 1. Regu Pemadaman dan Penyelamatan</h6>
                            <p class="small text-muted mb-0">Memiliki tugas utama melaksanakan pemadaman dini menggunakan alat pemadam api sederhana (APAS) atau ringan (APAR) sebelum petugas tiba, serta membantu proses evakuasi korban dan pengamanan lokasi kejadian[cite: 8].</p>
                        </div>
                    </div>

                    <!-- Regu 2 -->
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary"><i class="fas fa-bullhorn me-2"></i> 2. Regu Penyuluh</h6>
                            <p class="small text-muted mb-0">Bertugas memberikan penyuluhan, sosialisasi, dan edukasi pencegahan bahaya kebakaran serta pelatihan penanganan darurat sederhana bagi warga di lingkungan desa/kelurahan[cite: 8].</p>
                        </div>
                    </div>

                    <!-- Regu 3 -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-success"><i class="fas fa-walkie-talkie me-2"></i> 3. Regu Komunikasi dan Informasi</h6>
                            <p class="small text-muted mb-0">Bertugas menyebarluaskan informasi pencegahan, melakukan komunikasi cepat darurat dengan pos damkar terdekat, serta menyusun laporan ringkas kejadian kebakaran dan penyelamatan[cite: 8].</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light justify-content-end py-3 px-4">
                    <button type="button" class="btn btn-dark btn-sm px-4 fw-bold rounded-pill" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} SIMERAH KOJA - Relawan Pemadam Kebakaran Kota Jambi.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>