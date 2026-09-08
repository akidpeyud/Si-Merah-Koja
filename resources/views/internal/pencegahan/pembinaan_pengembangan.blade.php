<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembinaan & Pengembangan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 0.5px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 4px 8px; border-radius: 6px; font-weight: 700; margin-left: 10px; }
        
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 12px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }
        .badge-role.operator { background: #8b5cf6; }
        .badge-role.user { background: #10b981; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #f8fafc; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 22px; color: #94a3b8; }
        .btn-logout { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 8px 20px; border-radius: 8px; font-size: 13px; font-weight: 700; transition: all 0.2s; cursor: pointer; }
        .btn-logout:hover { background-color: #ef4444; color: white; }
        
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; gap: 5px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 10px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f1f5f9; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; border-left: 4px solid #2563eb; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 20px 0 10px 10px; letter-spacing: 1px; }
        
        .main-content { flex: 1; padding: 40px; }
        .page-header h1 { font-size: 26px; font-weight: 800; color: #0f172a; }
        .page-header p { color: #64748b; font-size: 15px; margin-top: 5px; }
        
        .content-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; overflow: hidden; margin-top: 25px; }
        .card-toolbar { padding: 20px 25px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #ffffff; }
        .search-box { position: relative; width: 300px; }
        .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        .search-box input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 14px; outline: none; transition: border 0.2s; background: #f8fafc; }
        .search-box input:focus { border-color: #3b82f6; background: white; }
        
        .table-custom { margin-bottom: 0; }
        .table-custom th { background-color: #f8fafc; color: #475569; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 16px 25px; border-bottom: 1px solid #e2e8f0; border-top: none; }
        .table-custom td { padding: 18px 25px; vertical-align: middle; font-size: 14px; border-bottom: 1px solid #f1f5f9; color: #334155; }
        .table-custom tbody tr { transition: all 0.2s ease; }
        .table-custom tbody tr:hover { background-color: #f8fafc; }
        
        .title-text { font-weight: 700; color: #0f172a; font-size: 15px; display: block; margin-bottom: 3px; }
        .sub-text { color: #64748b; font-size: 13px; }
        
        .badge-soft-warning { background-color: #fef3c7; color: #d97706; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; }
        .badge-soft-success { background-color: #dcfce7; color: #15803d; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; }
        .badge-soft-primary { background-color: #dbeafe; color: #1d4ed8; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; }
        
        .btn-action { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: none; transition: all 0.2s; margin: 0 3px; cursor: pointer; }
        .btn-action-view { background-color: #eff6ff; color: #3b82f6; }
        .btn-action-view:hover { background-color: #3b82f6; color: white; }
        .btn-action-edit { background-color: #f0fdf4; color: #22c55e; }
        .btn-action-edit:hover { background-color: #22c55e; color: white; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah" onerror="this.style.display='none'">
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

            <!-- MODUL OPERASIONAL -->
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                
                <!-- ACTIVE DI PEMBINAAN & PENGEMBANGAN -->
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item active"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>

                <div class="sidebar-title">Bagian Sapra</div>
                <a href="#" class="sidebar-item"><i class="fas fa-truck-monster"></i> Kelola Armada Mobil</a>
                <a href="#" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
                <a href="#" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            <!-- MODUL OPERATOR BERITA -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita</div>
                <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item">
                <i class="fas fa-user-edit"></i> Profil Saya
            </a>
            
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item">
                    <i class="fas fa-users"></i> Kelola Semua Pengguna
                </a>
            @endif
        </aside>

        <main class="main-content">
            <div class="page-header d-flex justify-content-between align-items-end">
                <div>
                    <h1>Data Pembinaan & Pengembangan</h1>
                    <p>Kelola program pembinaan kelompok masyarakat, instansi, atau relawan.</p>
                </div>
                <button class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                    <i class="fas fa-plus me-2"></i> Tambah Pembinaan Baru
                </button>
            </div>

            <div class="content-card">
                <div class="card-toolbar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Cari objek pembinaan...">
                    </div>
                    <button class="btn btn-light" style="border-radius: 10px; font-weight: 600; border: 1px solid #e2e8f0;">
                        <i class="fas fa-filter me-2 text-muted"></i> Filter Data
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-custom w-100">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Tanggal Mulai</th>
                                <th width="35%">Objek Pembinaan</th>
                                <th width="20%">Fokus Kegiatan</th>
                                <th width="15%">Status</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span class="title-text">25 Sep 2026</span></td>
                                <td>
                                    <span class="title-text">Relawan REDKAR Kec. Alam Barajo</span>
                                    <span class="sub-text">Ketua: Bpk. Suryadi</span>
                                </td>
                                <td><span class="title-text">Kesiagaan Lingkungan</span></td>
                                <td><span class="badge-soft-primary"><i class="fas fa-sync-alt me-1"></i> Dalam Proses</span></td>
                                <td class="text-center">
                                    <button class="btn-action btn-action-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-action-edit" title="Edit Data"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="title-text">05 Sep 2026</span></td>
                                <td>
                                    <span class="title-text">Tim K3 RSUD Abdul Manap</span>
                                    <span class="sub-text">Rumah Sakit Daerah</span>
                                </td>
                                <td><span class="title-text">Evaluasi Proteksi Gedung</span></td>
                                <td><span class="badge-soft-success"><i class="fas fa-check-circle me-1"></i> Selesai</span></td>
                                <td class="text-center">
                                    <button class="btn-action btn-action-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-action-edit" title="Edit Data"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>