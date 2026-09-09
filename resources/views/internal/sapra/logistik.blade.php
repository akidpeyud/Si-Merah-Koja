<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistik & Gudang - SIMERAH KOJA</title>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* NAVBAR (Singkat) */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }

        /* SIDEBAR & MAIN */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; padding-left: 15px; letter-spacing: 1px; }
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-y: auto; }
        
        .page-header { margin-bottom: 25px; }
        .page-header h1 { font-size: 24px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }

        /* STYLE TABEL */
        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 14px; }
        .table-custom thead th { background-color: #0f172a; color: white; font-weight: 600; padding: 15px; font-size: 13px; letter-spacing: 0.5px; border-bottom: none; }
        .table-custom tbody td { padding: 15px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f3f4f6; }
        .table-custom tbody tr:hover { background-color: #f8fafc; }
        .badge-kuning { background-color: #fef08a; color: #854d0e; padding: 4px 10px; border-radius: 50px; font-weight: 700; font-size: 12px; }
        .badge-hijau { background-color: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 50px; font-weight: 700; font-size: 12px; }
        .badge-merah { background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 50px; font-weight: 700; font-size: 12px; }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}</span>
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

    <!-- 1. BAGIAN PENCEGAHAN -->
    @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
        <div class="sidebar-title" style="border-top: none;">Bagian Pencegahan</div>
        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
    @endif

    <!-- 2. BAGIAN PEMADAMAN & PENYELAMATAN -->
    @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
        <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data & Laporan</a>
        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
        <a href="#" class="sidebar-item"><i class="fas fa-users-cog"></i> Jadwal Piket Regu</a>
        <a href="#" class="sidebar-item"><i class="fas fa-running"></i> Data Relawan Redkar</a>
    @endif

    <!-- 3. BAGIAN SAPRA -->
    @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
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
    
    <!-- MODUL OPERATOR BERITA -->
    @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
        <div class="sidebar-title">Manajemen Berita</div>
        <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
        <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
    @endif

    <!-- PENGATURAN UMUM -->
    <div class="sidebar-title">Pengaturan Akun</div>
    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
    
    @if(Auth::user()->role === 'super_user')
        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
    @endif
</aside>

        <!-- MAIN AREA (MENAMPILKAN TABEL DATABASE) -->
        <main class="main-content">
            <div class="page-header d-flex justify-content-between align-items-end">
                <div>
                    <h1>Data Kebutuhan Sarpras</h1>
                    <p>Daftar rincian kebutuhan sarana dan prasarana dari database.</p>
                </div>
                <!-- Opsional: Tombol untuk tambah data/print/export -->
                <button class="btn btn-primary" style="font-weight: 600; font-size: 14px; border-radius: 8px;">
                    <i class="fas fa-print me-1"></i> Cetak Laporan
                </button>
            </div>

            <!-- KOTAK TABEL DATABSE -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">NO</th>
                                <th width="35%">URAIAN SARPRAS</th>
                                <th width="20%" class="text-center">JML DIBUTUHKAN</th>
                                <th width="20%" class="text-center">JML TERSEDIA</th>
                                <th width="20%" class="text-center">BELUM TERSEDIA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- MELAKUKAN LOOPING DATA DARI DATABASE -->
                            @forelse($dataSarpras as $index => $item)
                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $item->uraian }}</td>
                                <td class="text-center">
                                    <span class="badge-kuning">{{ $item->jumlah_dibutuhkan }} Unit</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge-hijau">{{ $item->jumlah_tersedia }} Unit</span>
                                </td>
                                <td class="text-center">
                                    @if($item->jumlah_belum_tersedia > 0)
                                        <span class="badge-merah">{{ $item->jumlah_belum_tersedia }} Unit</span>
                                    @else
                                        <span class="badge-hijau">Terpenuhi</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <!-- JIKA DATABASE KOSONG -->
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 40px;"></i>
                                    <p class="text-muted fw-bold mb-0">Belum ada data kebutuhan sarpras.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
