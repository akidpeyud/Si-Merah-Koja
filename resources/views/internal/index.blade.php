<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Internal - SIMERAH KOJA</title>

    <!-- Google Fonts -->
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

        /* --- GLOBAL ALERT STYLES (DI TENGAH ATAS) --- */
        #globalSuccessAlert {
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #10b981;
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4), 0 8px 10px -6px rgba(16, 185, 129, 0.1);
            z-index: 99999;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        #globalSuccessAlert .alert-icon { font-size: 22px; }
        #globalSuccessAlert .btn-close-alert {
            background: transparent; border: none; color: white; opacity: 0.7;
            font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s;
        }
        #globalSuccessAlert .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter {
            from { transform: translate(-50%, -50px); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }
        @keyframes fadeOutUpCenter {
            from { transform: translate(-50%, 0); opacity: 1; }
            to { transform: translate(-50%, -50px); opacity: 0; }
        }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal {
            background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        
        .btn-logout {
            background-color: #ef4444; color: white; border: none; padding: 8px 20px;
            border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s;
        }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar {
            width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px;
        }
        .sidebar-item {
            display: flex; align-items: center; gap: 15px; padding: 12px 15px;
            color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600;
            border-radius: 8px; transition: all 0.2s;
        }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title {
            font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase;
            margin-top: 15px; margin-bottom: 5px; padding-left: 15px; letter-spacing: 1px;
            border-top: 1px dashed #e5e7eb; padding-top: 15px;
        }

        /* --- MAIN AREA --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }

        .welcome-panel {
            background: linear-gradient(135deg, #1e3a8a, #111827); border-radius: 16px;
            padding: 40px; color: white; position: relative; overflow: hidden;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3); margin-bottom: 30px;
        }
        .welcome-panel h2 { font-size: 24px; font-weight: 800; margin-bottom: 10px; }
        .welcome-panel p { font-size: 14px; color: #cbd5e1; line-height: 1.6; max-width: 600px; margin-bottom: 0; }
        .welcome-icon-bg { position: absolute; right: 30px; top: -20px; font-size: 180px; opacity: 0.1; color: white; }

        /* GRID STATISTIK FLEKSIBEL */
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 20px; 
            margin-bottom: 30px; 
        }
        
        .stat-card {
            background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            border: 1px solid #e5e7eb; display: flex; flex-direction: column; position: relative; overflow: hidden;
        }
        .stat-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px; }
        .border-blue::after { background-color: #3b82f6; }
        .border-red::after { background-color: #ef4444; }
        .border-orange::after { background-color: #f59e0b; }
        .border-green::after { background-color: #10b981; }
        .border-purple::after { background-color: #8b5cf6; }
        
        .stat-title { font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 10px; text-transform: uppercase; }
        .stat-value { font-size: 28px; font-weight: 800; color: #111827; }
        .stat-icon { position: absolute; top: 25px; right: 25px; font-size: 35px; opacity: 0.1; }
    </style>
</head>
<body>

    <!-- ALERT SUCCESS GLOBAL -->
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
            setTimeout(closeAlert, 4000);
        </script>
    @endif

    <!-- ALERT ERROR GLOBAL -->
    @if(session('error'))
        <div id="globalErrorAlert" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #ef4444; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <i class="fas fa-exclamation-triangle alert-icon" style="font-size: 22px;"></i>
            <span>{{ session('error') }}</span>
            <button class="btn-close-alert" onclick="closeErrorAlert()" style="background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; cursor: pointer;"><i class="fas fa-times"></i></button>
        </div>
        
        <script>
            function closeErrorAlert() {
                let errorBox = document.getElementById('globalErrorAlert');
                if(errorBox) {
                    errorBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                    setTimeout(() => errorBox.remove(), 400); 
                }
            }
            setTimeout(closeErrorAlert, 4000);
        </script>
    @endif

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            
            <!-- FORM LOGOUT -->
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item active">
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
                
                <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item">
                    <i class="fas fa-users-cog"></i> Kelola Redkar
                </a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>

               <div class="sidebar-title" style="border-top: none;">Bagian Sapra</div>

<a href="/sapra/data_hidrant_gedung" class="sidebar-item">
    <i class="fas fa-clipboard-list"></i> Data Hidrant
</a>

<a href="/sapra/data-hidrant-kota" class="sidebar-item">
    <i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi
</a>



<!-- Ganti Maintenance jadi Prasarana Mako & Pos -->
<a href="/sapra/prasarana-mako" class="sidebar-item">
    <i class="fas fa-building"></i> Prasarana Mako & Pos
</a>

<a href="/sapra/logistik" class="sidebar-item">
    <i class="fas fa-box-open"></i> Logistik & Gudang
</a>
            @endif

            <!-- MODUL OPERATOR BERITA (Bisa diakses oleh Operator & Super User) -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita</div>
                <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
            @endif
            <!-- MODUL OPERATOR BERITA & KONTEN PUBLIK -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita & Konten</div>
                
                <a href="/internal/operator/kelola-berita" class="sidebar-item {{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> Input & Kelola Berita
                </a>
                
                <a href="/internal/operator/infografis" class="sidebar-item {{ Request::is('internal/operator/infografis*') ? 'active' : '' }}">
                    <i class="fas fa-image"></i> Kelola Info Grafis
                </a>
                
                <a href="/internal/operator/berita-medsos" class="sidebar-item {{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}">
                    <i class="fab fa-instagram"></i> Kelola Berita Medsos
                </a>
            @endif

            <!-- PENGATURAN UMUM -->
            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
            
            <!-- Pengaturan Super User Khusus -->
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
            @endif
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="page-header">
                <h1>Ruang Kerja - Terintegrasi</h1>
                <p>Ringkasan sistem informasi internal Disdamkartan Kota Jambi.</p>
            </div>

            <!-- Panel Selamat Datang -->
            <div class="welcome-panel">
                <i class="fas fa-shield-alt welcome-icon-bg"></i>
                <h2>Selamat Bekerja, {{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}!</h2>
                
                @if(Auth::user()->role === 'super_user')
                    <p>Anda login sebagai <strong>Super User</strong>. Anda memiliki kendali penuh untuk memantau dan mengelola seluruh modul operasional maupun sistem.</p>
                @else
                    <p>Anda login sebagai <strong>Pegawai Internal</strong>. Anda dapat saling berkolaborasi dalam mengelola laporan dari seluruh modul layanan Disdamkartan.</p>
                @endif
            </div>

            <br>

            <!-- Grid Statistik -->
            <div class="stats-grid">
                
                <!-- STATISTIK KHUSUS PENCEGAHAN -->
                @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="stat-card border-blue">
                    <i class="fas fa-clipboard-check stat-icon text-primary"></i>
                    <div class="stat-title">Layanan Inspeksi</div>
                    <div class="stat-value">24</div>
                </div>
                
                <div class="stat-card border-green">
                    <i class="fas fa-bullhorn stat-icon text-success"></i>
                    <div class="stat-title">Layanan Sosialisasi</div>
                    <div class="stat-value">12</div>
                </div>

                <div class="stat-card border-purple">
                    <i class="fas fa-chalkboard-teacher stat-icon" style="color: #8b5cf6;"></i>
                    <div class="stat-title">Pelatihan Aktif</div>
                    <div class="stat-value">5</div>
                </div>

                <div class="stat-card border-orange">
                    <i class="fas fa-chart-line stat-icon text-warning"></i>
                    <div class="stat-title">Pembinaan & Pengembangan</div>
                    <div class="stat-value">8</div>
                </div>

                <div class="stat-card border-red">
                    <i class="fas fa-level-up-alt stat-icon text-danger"></i>
                    <div class="stat-title">Peningkatan Kapasitas</div>
                    <div class="stat-value">3</div>
                </div>
                @endif

                <!-- STATISTIK KHUSUS PEMADAMAN -->
                @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="stat-card border-red">
                    <i class="fas fa-fire stat-icon text-danger"></i>
                    <div class="stat-title">Siaga Darurat (Pemadaman)</div>
                    <div class="stat-value">3</div>
                </div>
                @endif
<!-- STATISTIK KHUSUS SAPRA -->
@if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
    
    <!-- Card 1: Total Hidrant Kota -->
    <div class="stat-card border-primary" style="border-bottom: 4px solid #3b82f6;">
        <i class="fas fa-map-marker-alt stat-icon" style="color: #3b82f6; font-size: 24px; position: absolute; right: 20px; opacity: 0.2;"></i>
        <div class="stat-title" style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Hidrant Kota</div>
        <div class="stat-value" style="font-size: 24px; font-weight: 800; color: #0f172a;">
            {{ \Illuminate\Support\Facades\DB::table('hidran_kota')->count() }}
        </div>
    </div>

    <!-- Card 2: Prasarana Mako & Pos -->
    <div class="stat-card border-orange" style="border-bottom: 4px solid #f59e0b;">
        <i class="fas fa-building stat-icon text-warning" style="color: #f59e0b; font-size: 24px; position: absolute; right: 20px; opacity: 0.2;"></i>
        <div class="stat-title" style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Prasarana Mako & Pos</div>
        <div class="stat-value" style="font-size: 24px; font-weight: 800; color: #0f172a;">
            {{ \Illuminate\Support\Facades\DB::table('prasarana')->count() }}
        </div>
    </div>

@endif

            </div>

        </main>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>