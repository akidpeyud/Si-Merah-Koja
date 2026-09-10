<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - SIMERAH KOJA</title>

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
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            background-color: #10b981; color: white; padding: 16px 24px;
            border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
            z-index: 99999; display: flex; align-items: center; gap: 12px;
            font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert .btn-close-alert {
            background: transparent; border: none; color: white; opacity: 0.7;
            font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: 0.2s;
        }
        #globalSuccessAlert .btn-close-alert:hover { opacity: 1; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

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
            border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.2s;
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

        /* --- MAIN AREA & TABLE --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-y: auto; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }

        .card-box { 
            background: white; border-radius: 12px; border: 1px solid #e2e8f0; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;
            border-top: 4px solid #ef4444; /* Aksen merah untuk fitur Berita */
        }

        .btn-custom-primary { background-color: #ef4444; color: white; border: none; font-weight: 600; transition: all 0.2s; box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2); }
        .btn-custom-primary:hover { background-color: #dc2626; color: white; transform: translateY(-2px); }

        /* Styling Tabel */
        .table-custom { margin-bottom: 0; }
        .table-custom thead th { background-color: #111827; color: #f8fafc; font-weight: 600; font-size: 13px; letter-spacing: 0.5px; text-transform: uppercase; padding: 15px 20px; border: none; }
        .table-custom tbody td { padding: 15px 20px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 14px; }
        .table-custom tbody tr:hover td { background-color: #f8fafc; }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        
        .title-text { font-weight: 700; color: #1e293b; font-size: 15px; display: block; margin-bottom: 2px;}
        .location-text { font-size: 12px; color: #94a3b8; }
        
        .action-btn { 
            width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; 
            border-radius: 6px; border: none; color: white; font-size: 13px; transition: 0.2s;
        }
        .btn-view { background-color: #3b82f6; } .btn-view:hover { background-color: #2563eb; }
        .btn-edit { background-color: #f59e0b; } .btn-edit:hover { background-color: #d97706; }
        .btn-delete { background-color: #ef4444; } .btn-delete:hover { background-color: #dc2626; }
        
        .empty-state { text-align: center; padding: 40px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; color: #e2e8f0; margin-bottom: 15px; }
    </style>
</head>
<body>

    <!-- NOTIFIKASI SUCCESS -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon text-white fs-4"></i>
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
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>

               <div class="sidebar-title">Bagian Sapra</div>
                <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-tint"></i> Data Hidrant</a>
                <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-tools"></i> Data Hidrant Kota Jambi</a>
                <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita</div>
                <!-- ITEM INI DIBERIKAN CLASS ACTIVE -->
                <a href="/internal/operator/kelola-berita" class="sidebar-item active"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
            
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
            @endif
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            
            <!-- Header Aksi -->
            <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                <div class="page-header m-0">
                    <h1><i class="fas fa-newspaper text-danger me-2"></i> Kelola Berita</h1>
                    <p>Manajemen data informasi kejadian, evakuasi, dan berita daerah.</p>
                </div>
                <div>
                    <a href="/internal/operator/kelola-berita/tambah" class="btn btn-custom-primary px-4 py-2 rounded-3"><i class="fas fa-plus me-2"></i> Tambah Berita Baru</a>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-custom w-100">
                        <thead>
                            <tr>
                                <th width="15%">Tanggal</th>
                                <th width="35%">Judul Kejadian</th>
                                <th width="20%">Pelapor</th>
                                <th width="15%">Sumber</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($berita as $b)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($b->tanggal_kejadian)->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size: 12px;"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($b->waktu_kejadian)->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <span class="title-text">{{ $b->judul }}</span>
                                    <span class="location-text"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ Str::limit($b->lokasi, 45) }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark"><i class="fas fa-user-circle text-muted me-1"></i> {{ $b->pelapor }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><i class="fas fa-info-circle me-1"></i> {{ Str::limit($b->sumber_informasi, 15) }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="/berita/{{ $b->id }}" target="_blank" class="action-btn btn-view" title="Lihat Publik"><i class="fas fa-external-link-alt"></i></a>
                                    <a href="/internal/operator/kelola-berita/edit/{{ $b->id }}" class="action-btn btn-edit mx-1" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="/internal/operator/kelola-berita/hapus/{{ $b->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kejadian ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-folder-open"></i>
                                        <h5 class="fw-bold text-dark mt-2">Belum Ada Data</h5>
                                        <p class="mb-0">Belum ada data kejadian atau berita yang diinput ke dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>