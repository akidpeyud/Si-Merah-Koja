<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Perizinan RPKBGL - SIMERAH KOJA</title>
    
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
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .content-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .table th { background-color: #f8fafc; color: #4b5563; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; padding: 15px 10px; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: 15px 10px; vertical-align: middle; font-size: 13px; color: #1f2937; border-bottom: 1px solid #e5e7eb; }
        
        /* Badge Status */
        .badge-status { padding: 6px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; display: inline-block;}
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-diproses { background-color: #dbeafe; color: #2563eb; }
        .status-memenuhi { background-color: #d1fae5; color: #059669; }
        .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }
        
        /* Tombol Aksi */
        .btn-pdf { background-color: #10b981; color: white; font-weight: 600; font-size: 11px; padding: 6px 10px; border-radius: 6px; border: none; text-decoration: none; display: inline-block; transition: 0.2s; width: 100%; margin-bottom: 5px; text-align: center;}
        .btn-pdf:hover { background-color: #059669; color: white; }
        
        .btn-lihat { background-color: #3b82f6; color: white; font-weight: 600; font-size: 11px; padding: 6px 10px; border-radius: 6px; border: none; text-decoration: none; display: inline-block; transition: 0.2s; width: 100%; text-align: center;}
        .btn-lihat:hover { background-color: #2563eb; color: white; }
        
        .btn-print-rekap { background-color: #3b82f6; color: white; font-weight: 700; font-size: 13px; padding: 10px 20px; border-radius: 8px; border: none; transition: 0.2s; cursor: pointer; }
        .btn-print-rekap:hover { background-color: #2563eb; color: white; }

        /* CSS Print untuk tabel rekap */
        @media print {
            .navbar-internal, .sidebar, .btn-print-rekap, .btn-logout, .page-header p { display: none !important; }
            .no-print-col { display: none !important; } 
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
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- MODUL OPERASIONAL -->
            @if(Auth::user()->role ?? 'user' === 'user' || Auth::user()->role ?? 'super_user' === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                
                <!-- MENU KELOLA RPKBGL -->
                <a href="/internal/pencegahan/kelola-rpkbgl" class="sidebar-item active"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item">
                <i class="fas fa-user-edit"></i> Profil Saya
            </a>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Daftar Permohonan RPKBGL</h1>
                    <p>Data pengajuan Rekomendasi Proteksi Kebakaran Bangunan Gedung & Lingkungan.</p>
                </div>
                <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print me-2"></i>Cetak Rekap</button>
            </div>

            <div class="content-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Pemohon</th>
                                <th>Nama Usaha</th>
                                <th>Kategori</th>
                                <th>Lokasi Bangunan</th>
                                <th>Status</th>
                                <th class="no-print-col text-center">Berkas Lampiran</th>
                                <th class="text-center no-print-col" width="130px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permohonan as $p)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $p->nama_pemohon }}</div>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px;">
                                        <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                    </a>
                                </td>
                                <td>{{ $p->nama_usaha }}</td>
                                <td>{{ $p->kategori_bangunan }}</td>
                                <td>
                                    {{ $p->kecamatan }}<br>
                                    <span class="text-muted" style="font-size: 11px;">Kel. {{ $p->kelurahan }}</span>
                                </td>
                                <td>
                                    @if($p->status_permohonan == 'Pending')
                                        <span class="badge-status status-pending">Pending</span>
                                    @elseif($p->status_permohonan == 'Diproses')
                                        <span class="badge-status status-diproses">Diproses Tim</span>
                                    @elseif($p->status_permohonan == 'Memenuhi Syarat')
                                        <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                                    @else
                                        <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi</span>
                                    @endif
                                </td>
                                <td class="no-print-col">
                                    @if($p->file_surat_permohonan)
                                        <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="d-block mb-1 text-decoration-none" style="font-size: 11px; color:#2563eb;"><i class="fas fa-file-pdf"></i> Surat Permohonan</a>
                                    @endif
                                    
                                    @if($p->file_persyaratan_lainnya)
                                        <a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="d-block text-decoration-none" style="font-size: 11px; color:#2563eb;"><i class="fas fa-paperclip"></i> Syarat Lainnya</a>
                                    @else
                                        <span class="text-muted" style="font-size: 10px;">- Tidak ada lampiran tambahan</span>
                                    @endif
                                </td>
                                <td class="text-center no-print-col">
                                    <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}" class="btn-lihat"><i class="fas fa-search me-1"></i> Detail</a>
                                    
                                    <!-- Tombol update status sementara (bisa Anda kembangkan menggunakan form/modal) -->
                                    <a href="#" class="btn-pdf"><i class="fas fa-edit me-1"></i> Update</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">Belum ada data permohonan RPKBGL yang masuk.</td>
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