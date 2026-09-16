<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Redkar - SIMERAH KOJA</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }
        
        /* --- NAVBAR & SIDEBAR --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin: 20px 0 10px 10px; letter-spacing: 1px; border-top: 1px dashed #e5e7eb; padding-top: 15px; }

        /* --- CONTENT --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .content-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .table th { background-color: #f8fafc; color: #4b5563; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; padding: 15px; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: 15px; vertical-align: middle; font-size: 14px; color: #1f2937; border-bottom: 1px solid #e5e7eb; }
        
        /* Tombol Aksi */
        .btn-pdf { background-color: #ef4444; color: white; font-weight: 600; font-size: 12px; padding: 6px 12px; border-radius: 6px; border: none; text-decoration: none; display: inline-block; transition: 0.2s; width: 100%; margin-bottom: 5px; }
        .btn-pdf:hover { background-color: #dc2626; color: white; }
        
        .btn-print-rekap { background-color: #3b82f6; color: white; font-weight: 700; font-size: 13px; padding: 10px 20px; border-radius: 8px; border: none; transition: 0.2s; cursor: pointer; }
        .btn-print-rekap:hover { background-color: #2563eb; color: white; }

        /* CSS Print untuk tabel rekap */
        @media print {
            .navbar-internal, .sidebar, .btn-print-rekap, .btn-logout, .page-header p { display: none !important; }
            .no-print-col { display: none !important; } /* Menyembunyikan kolom KTP dan Aksi Dokumen */
            .dashboard-container { display: block; }
            .main-content { padding: 0 !important; margin: 0 !important; background-color: white; }
            .content-card { border: none; box-shadow: none; padding: 0; }
            body { background-color: white; margin: 0; padding: 0; }
            .page-header h1 { font-size: 20px; text-align: center; margin-bottom: 20px; }
            table { width: 100% !important; border-collapse: collapse; }
            table th, table td { border: 1px solid #000 !important; padding: 8px !important; font-size: 11px !important; }
        }
    </style>
</head>
<body>

    <nav class="navbar-internal">
        <a href="/internal/index" class="nav-brand">
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
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                
                <!-- MENU KELOLA REDKAR -->
                <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item active"><i class="fas fa-users-cog"></i> Kelola Redkar</a>

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
            @endif

            <!-- PENGATURAN UMUM -->
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

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Daftar Calon Relawan (REDKAR)</h1>
                    <p>Data masyarakat yang mendaftar melalui formulir publik website.</p>
                </div>
                <!-- Tombol Print Rekap -->
                <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print me-2"></i>Cetak Rekap</button>
            </div>

            <div class="content-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal Daftar</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Kecamatan</th>
                                <th>No. Telp (WA)</th>
                                <!-- Tambahkan class no-print-col agar hilang saat di-print -->
                                <th class="no-print-col">KTP</th>
                                <th class="text-center no-print-col" width="180px">Aksi Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($relawan as $r)
                            <tr>
                                <td style="font-size: 13px;">{{ $r->created_at->format('d M Y, H:i') }}</td>
                                <td class="fw-bold">{{ $r->nik }}</td>
                                <td>{{ $r->nama_lengkap }}</td>
                                <td>{{ $r->kecamatan }}</td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->nomor_telp) }}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fab fa-whatsapp me-1"></i> {{ $r->nomor_telp }}</a>
                                </td>
                                <td class="no-print-col">
                                    @if($r->ktp)
                                        <a href="/storage/{{ $r->ktp }}" target="_blank" class="badge bg-info text-decoration-none"><i class="fas fa-eye me-1"></i> Lihat Dokumen</a>
                                    @else
                                        <span class="badge bg-secondary">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="text-center no-print-col">
                                    <!-- Tombol Buka Halaman Cetak Biodata -->
                                    <a href="/internal/pencegahan/cetak-redkar/{{ $r->id }}" target="_blank" class="btn-pdf">
                                        <i class="fas fa-print me-1"></i> Cetak Biodata
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data relawan yang mendaftar.</td>
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