<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- GLOBAL ALERT STYLES (DI TENGAH ATAS) --- */
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

        /* --- NAVBAR & SIDEBAR --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }
        .badge-role.operator { background: #8b5cf6; }
        .badge-role.user { background: #10b981; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; transition: 0.2s; cursor: pointer; }
        .btn-logout:hover { background-color: #dc2626; }

        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; padding-left: 15px; border-top: 1px dashed #e5e7eb; padding-top: 15px; }

        /* --- HALAMAN PROFIL KHUSUS --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 30px; }

        .profile-card, .password-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); height: 100%; }
        .card-title { font-size: 16px; font-weight: 800; color: #111827; margin-bottom: 25px; border-bottom: 2px solid #f3f4f6; padding-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* Info User Kiri */
        .user-avatar { width: 80px; height: 80px; background-color: #e0f2fe; color: #0284c7; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 35px; margin-bottom: 20px; }
        .info-group { margin-bottom: 15px; }
        .info-label { font-size: 11px; color: #6b7280; font-weight: 700; text-transform: uppercase; margin-bottom: 3px; }
        .info-value { font-size: 15px; font-weight: 600; color: #1f2937; }

        /* Form Kanan */
        .form-label { font-size: 13px; font-weight: 600; color: #374151; }
        .form-control { font-size: 14px; padding: 10px 15px; border-color: #d1d5db; }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25); }
        .btn-update { background-color: #10b981; color: white; font-weight: 700; padding: 10px 20px; border-radius: 6px; border: none; transition: 0.2s; }
        .btn-update:hover { background-color: #059669; }

        .alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 12px 15px; border-radius: 8px; font-size: 13px; font-weight: 500; margin-bottom: 20px; }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert()"><i class="fas fa-times"></i></button>
        </div>
        <script>
            function closeAlert() {
                let alertBox = document.getElementById('globalSuccessAlert');
                if(alertBox) { alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards'; setTimeout(() => alertBox.remove(), 400); }
            }
            setTimeout(closeAlert, 4000);
        </script>
    @endif

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="/internal/index" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    @if(Auth::user()->role === 'user')
                        PEGAWAI
                    @else
                        {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
                    @endif
                </span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- MODUL OPERASIONAL (Bisa diakses oleh User & Super User) -->
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>

                <div class="sidebar-title">Bagian Sapra</div>
                <a href="#" class="sidebar-item"><i class="fas fa-truck-monster"></i> Kelola Armada Mobil</a>
                <a href="#" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
                <a href="#" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            <!-- MODUL OPERATOR BERITA (Bisa diakses oleh Operator & Super User) -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita</div>
                <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
            @endif

            <!-- PENGATURAN UMUM -->
            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item active">
                <i class="fas fa-user-edit"></i> Profil Saya
            </a>
            
            <!-- Pengaturan Super User Khusus -->
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item">
                    <i class="fas fa-users"></i> Kelola Semua Pengguna
                </a>
            @endif
        </aside>

        <!-- MAIN AREA PROFIL -->
        <main class="main-content">
            <div class="page-header">
                <h1>Profil Pengguna</h1>
                <p>Kelola informasi akun dan kata sandi Anda di sini.</p>
            </div>

            <div class="row">
                <!-- KOLOM KIRI: INFO USER -->
                <div class="col-md-5 mb-4">
                    <div class="profile-card">
                        <div class="card-title">Informasi Akun</div>
                        
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value">{{ Auth::user()->nama_lengkap }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">NIP / Nomor Pegawai</div>
                            <div class="info-value">{{ Auth::user()->nomor_pegawai }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Email Terdaftar</div>
                            <div class="info-value">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Hak Akses Sistem</div>
                            <div class="info-value">
                                <span class="badge-role {{ Auth::user()->role }} d-inline-block mt-1">
                                    {{ Auth::user()->role === 'user' ? 'Pegawai Internal' : ucwords(str_replace('_', ' ', Auth::user()->role)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: UBAH PASSWORD -->
                <div class="col-md-7 mb-4">
                    <div class="password-card">
                        <div class="card-title">Ubah Kata Sandi</div>

                        @if($errors->any())
                            <div class="alert-error">
                                <i class="fas fa-exclamation-circle me-2"></i> Terdapat kesalahan:
                                <ul class="mt-1 mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/internal/profil/update-password" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Password Saat Ini</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-unlock"></i></span>
                                    <input type="password" name="password_lama" class="form-control" placeholder="Masukkan password lama Anda" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password_baru" class="form-control" placeholder="Minimal 6 karakter" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-check-circle"></i></span>
                                    <input type="password" name="password_baru_confirmation" class="form-control" placeholder="Ketik ulang password baru" required>
                                </div>
                            </div>

                            <button type="submit" class="btn-update">
                                <i class="fas fa-save me-1"></i> Simpan Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>