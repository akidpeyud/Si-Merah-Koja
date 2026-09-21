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
        
        /* --- NAVBAR & SIDEBAR --- */
        .navbar-internal { 
            background-color: #111827; 
            padding: 15px 40px; 
            border-bottom: 4px solid #10b981; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: sticky; 
            top: 0; 
            z-index: 9999; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
        }
        
        .nav-brand { 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            color: white; 
            text-decoration: none; 
        }
        
        .nav-brand img { 
            height: 40px; 
        }
        
        .nav-brand .title { 
            font-weight: 800; 
            font-size: 18px; 
            letter-spacing: 1px; 
        }

        .user-menu { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
        }
        
        .user-profile { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            color: #e5e7eb; 
            font-size: 14px; 
            font-weight: 600; 
        }
        
        .user-profile i { 
            font-size: 20px; 
            color: #9ca3af; 
        }
        
        .btn-logout { 
            background-color: #ef4444; 
            color: white; 
            border: none; 
            padding: 8px 16px; 
            border-radius: 6px; 
            font-size: 13px; 
            font-weight: 700; 
            cursor: pointer; 
            transition: all 0.2s; 
        }
        
        .btn-logout:hover { 
            background-color: #dc2626; 
        }

        .dashboard-container { 
            display: flex; 
            min-height: calc(100vh - 74px); 
            position: relative; 
        }
        
        .sidebar {
            width: 280px; 
            background-color: #ffffff; 
            border-right: 1px solid #e5e7eb;
            padding: 25px 15px; 
            display: flex; 
            flex-direction: column; 
            gap: 6px; 
            overflow-y: auto; 
            flex-shrink: 0;
            position: sticky; 
            top: 74px; 
            height: calc(100vh - 74px);
        }
        
        .sidebar-item {
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 10px 14px;
            color: #4b5563; 
            text-decoration: none; 
            font-size: 13px; 
            font-weight: 600;
            border-radius: 8px; 
            transition: all 0.2s;
        }
        
        .sidebar-item:hover { 
            background-color: #f3f4f6; 
            color: #111827; 
        }
        
        .sidebar-item.active { 
            background-color: #e0f2fe; 
            color: #0284c7; 
        }
        
        .sidebar-item.active i { 
            color: #0284c7; 
        }
        
        .sidebar-item i { 
            font-size: 15px; 
            width: 20px; 
            text-align: center; 
            color: #9ca3af; 
        }
        
        .sidebar-collapse-btn {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            width: 100%; 
            padding: 12px 14px 4px 14px; 
            margin-top: 8px;
            background: transparent; 
            border: none; 
            border-top: 1px dashed #e5e7eb;
            text-align: left; 
            font-size: 11px; 
            font-weight: 800; 
            color: #9ca3af;
            text-transform: uppercase; 
            letter-spacing: 1px; 
            cursor: pointer; 
            transition: all 0.2s;
        }
        
        .sidebar-collapse-btn:hover { 
            color: #4b5563; 
        }
        
        .toggle-icon { 
            transition: transform 0.3s ease; 
            font-size: 11px; 
        }
        
        .sidebar-collapse-btn.collapsed .toggle-icon { 
            transform: rotate(0deg); 
        }
        
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { 
            transform: rotate(180deg); 
            color: #0284c7; 
        }
        
        .sidebar-collapse-btn:not(.collapsed) { 
            color: #0284c7; 
        }

        .sidebar-submenu {
            display: flex; 
            flex-direction: column; 
            gap: 4px; 
            padding-left: 8px; 
            margin-top: 6px;
        }

        /* --- CONTENT --- */
        .main-content { 
            flex: 1; 
            padding: 35px 40px; 
            background-color: #f9fafb; 
        }
        
        .page-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-end; 
            margin-bottom: 25px; 
        }
        
        .page-header h1 { 
            font-size: 26px; 
            font-weight: 800; 
            color: #111827; 
            margin-bottom: 4px; 
        }
        
        .page-header p { 
            color: #6b7280; 
            font-size: 13px; 
            margin-bottom: 0; 
        }

        .content-card { 
            background: white; 
            border-radius: 12px; 
            border: 1px solid #e5e7eb; 
            padding: 20px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); 
        }
        
        .table th { 
            background-color: #f8fafc; 
            color: #4b5563; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
            font-weight: 700; 
            padding: 12px 14px; 
            border-bottom: 2px solid #e5e7eb; 
        }
        
        .table td { 
            padding: 12px 14px; 
            vertical-align: middle; 
            font-size: 13px; 
            color: #1f2937; 
            border-bottom: 1px solid #f1f5f9; 
        }

        /* --- STATUS BADGES COMPONENT (CLEAN LOOK) --- */
        .status-badge-container {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .status-row {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
        }
        .status-label {
            color: #6b7280;
            font-weight: 600;
            width: 45px;
        }
        
        /* --- TOMBOL AKSI GROUP --- */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5px;
            min-width: 150px;
        }

        .btn-action {
            font-weight: 600; 
            font-size: 11px; 
            padding: 6px 8px; 
            border-radius: 6px; 
            border: none; 
            text-decoration: none; 
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            transition: 0.2s; 
            text-align: center; 
            cursor: pointer;
            width: 100%;
        }

        .btn-verify { background-color: #10b981; color: white; }
        .btn-verify:hover { background-color: #059669; color: white; }

        .btn-edit { background-color: #3b82f6; color: white; }
        .btn-edit:hover { background-color: #2563eb; color: white; }

        .btn-pdf { background-color: #f59e0b; color: white; }
        .btn-pdf:hover { background-color: #d97706; color: white; }

        .btn-delete { background-color: #ef4444; color: white; }
        .btn-delete:hover { background-color: #dc2626; color: white; }
        
        .btn-print-rekap { 
            background-color: #3b82f6; 
            color: white; 
            font-weight: 700; 
            font-size: 13px; 
            padding: 8px 16px; 
            border-radius: 8px; 
            border: none; 
            transition: 0.2s; 
            cursor: pointer; 
        }
        .btn-print-rekap:hover { background-color: #2563eb; color: white; }

        .btn-tambah { 
            background-color: #10b981; 
            color: white; 
            font-weight: 700; 
            font-size: 13px; 
            padding: 8px 16px; 
            border-radius: 8px; 
            border: none; 
            text-decoration: none; 
            transition: 0.2s; 
            display: inline-flex;
            align-items: center;
        }
        .btn-tambah:hover { background-color: #059669; color: white; }

        /* --- PRINT KOP & HEADER LAPORAN --- */
        .print-header { display: none; }

        @media print {
            @page { size: A4 landscape; margin: 15mm; }
            body { background-color: white !important; color: black !important; margin: 0; padding: 0; }
            .navbar-internal, .sidebar, .page-header, .btn-logout, .no-print-col { display: none !important; }
            .dashboard-container { display: block !important; }
            .main-content { padding: 0 !important; margin: 0 !important; background-color: white !important; width: 100% !important; }
            .content-card { border: none !important; box-shadow: none !important; padding: 0 !important; }
            
            .print-header {
                display: block !important;
                text-align: center;
                border-bottom: 3px double #000;
                padding-bottom: 12px;
                margin-bottom: 20px;
            }
            .print-header h3 { font-size: 15px; font-weight: bold; text-transform: uppercase; margin-bottom: 2px; }
            .print-header h2 { font-size: 17px; font-weight: 800; text-transform: uppercase; margin-bottom: 4px; }
            .print-header p { font-size: 10px; margin-bottom: 0; color: #333; }

            table { width: 100% !important; border-collapse: collapse !important; margin-top: 10px; }
            table th { background-color: #f1f1f1 !important; color: #000 !important; border: 1px solid #000 !important; font-size: 10px !important; padding: 6px !important; text-align: center; }
            table td { border: 1px solid #000 !important; font-size: 10px !important; padding: 5px 6px !important; color: #000 !important; }
            .badge { border: 1px solid #000 !important; color: #000 !important; background: transparent !important; font-weight: bold; }
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
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-1"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <button class="sidebar-collapse-btn {{ Request::is('internal/pencegahan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="{{ Request::is('internal/pencegahan*') ? 'true' : 'false' }}">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/pencegahan*') ? 'show' : '' }}" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/kelola-rpkbgl" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-rpkbgl*') ? 'active' : '' }}"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                        <a href="/internal/pencegahan/kelola-skk" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-skk*') ? 'active' : '' }}"><i class="fas fa-shield-alt"></i> Kelola SKK</a> 
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item {{ Request::is('internal/pencegahan/layanan-inspeksi*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/kelola-edukasi" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-edukasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item {{ Request::is('internal/pencegahan/pelatihan*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item {{ Request::is('internal/pencegahan/pembinaan-pengembangan*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item {{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item {{ Request::is('internal/damtan/data-laporan*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <button class="sidebar-collapse-btn {{ Request::is('sapra*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="{{ Request::is('sapra*') ? 'true' : 'false' }}">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('sapra*') ? 'show' : '' }}" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 12px; margin-top: 4px; margin-bottom: 2px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 12px; margin-top: 12px; margin-bottom: 2px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 12px; margin-top: 12px; margin-bottom: 2px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    </div>
                </div>
            @endif

            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false">
                <span>Pengaturan Akun</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="print-header">
                <h3>PEMERINTAH KOTA JAMBI</h3>
                <h2>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</h2>
                <p>Jl. Jend. A. Thalib No. 33, Telanaipura, Kota Jambi, Jambi</p>
                <h4 style="font-size: 13px; font-weight: bold; margin-top: 8px; text-transform: uppercase;">REKAPITULASI DATA RELAWAN PEMADAM KEBAKARAN (REDKAR)</h4>
            </div>

            <div class="page-header">
                <div>
                    <h1>Daftar Calon Relawan (REDKAR)</h1>
                    <p>Kelola data, verifikasi akun, dan cetak dokumen relawan.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/internal/pencegahan/tambah-redkar" class="btn-tambah"><i class="fas fa-user-plus me-2"></i> Tambah Data Relawan</a>
                    <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print me-2"></i> Cetak Rekap</button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="content-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Tanggal Daftar</th>
                                <th>Akun & Status</th>
                                <th>NIK & Nama Lengkap</th>
                                <th>Kecamatan</th>
                                <th>No. Telp (WA)</th>
                                <th class="no-print-col text-center">KTP</th>
                                <th class="text-center no-print-col">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($relawan as $index => $r)
                            <tr>
                                <td class="text-center fw-semibold text-muted">{{ $index + 1 }}</td>
                                <td style="font-size: 12px; white-space: nowrap;">{{ $r->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <div class="fw-bold text-dark mb-1.5" style="font-size: 13px;">{{ $r->username }}</div>
                                    <div class="status-badge-container">
                                        <!-- Status Akun (Tanpa Titik Bulat) -->
                                        <div class="status-row">
                                            <span class="status-label">Akun</span>
                                            @if(($r->status_akun ?? 'Aktif') === 'Aktif')
                                                <span class="badge bg-light text-success border border-success px-2 py-1 fw-bold" style="font-size: 10px;">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-light text-secondary border border-secondary px-2 py-1 fw-bold" style="font-size: 10px;">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Status Pendaftaran -->
                                        <div class="status-row">
                                            <span class="status-label">Seleksi</span>
                                            @if($r->status_pendaftaran === 'Diterima')
                                                <span class="badge bg-success text-white px-2 py-1 fw-bold" style="font-size: 10px;">Diterima</span>
                                            @elseif($r->status_pendaftaran === 'Ditolak')
                                                <span class="badge bg-danger text-white px-2 py-1 fw-bold" style="font-size: 10px;">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning text-dark px-2 py-1 fw-bold" style="font-size: 10px;">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 13px;">{{ $r->nama_lengkap }}</div>
                                    <small class="text-muted" style="font-size: 11px;">NIK: {{ $r->nik }}</small>
                                </td>
                                <td style="font-size: 13px;">{{ $r->kecamatan }}</td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->nomor_telp) }}" target="_blank" class="text-success text-decoration-none fw-bold" style="font-size: 13px;">
                                        <i class="fab fa-whatsapp me-1"></i> {{ $r->nomor_telp }}
                                    </a>
                                </td>
                                <td class="no-print-col text-center">
                                    @if($r->file_ktp && $r->file_ktp !== 'offline_registered')
                                        <a href="/storage/{{ $r->file_ktp }}" target="_blank" class="badge bg-info text-decoration-none py-2 px-2.5">
                                            <i class="fas fa-eye me-1"></i> Lihat KTP
                                        </a>
                                    @else
                                        <span class="badge bg-secondary py-2 px-2.5">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="text-center no-print-col">
                                    <div class="action-buttons">
                                        <button type="button" class="btn-action btn-verify" data-bs-toggle="modal" data-bs-target="#verifikasiModal{{ $r->id }}" title="Verifikasi">
                                            <i class="fas fa-user-shield"></i> Verif
                                        </button>

                                        <a href="/internal/pencegahan/edit-redkar/{{ $r->id }}" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <a href="/internal/pencegahan/cetak-redkar/{{ $r->id }}" target="_blank" class="btn-action btn-pdf" title="Cetak">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>

                                        <form action="/internal/pencegahan/hapus-redkar/{{ $r->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data relawan ini?')" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL VERIFIKASI -->
                            <div class="modal fade" id="verifikasiModal{{ $r->id }}" tabindex="-1" aria-labelledby="verifikasiModalLabel{{ $r->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="/internal/pencegahan/verifikasi-redkar/{{ $r->id }}" method="POST">
                                            @csrf
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title fs-6 fw-bold" id="verifikasiModalLabel{{ $r->id }}">
                                                    <i class="fas fa-user-shield me-2 text-success"></i> Verifikasi Ganda: {{ $r->nama_lengkap }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-primary" style="font-size: 13px;">1. Status Akun (Hak Akses Login)</label>
                                                    <select class="form-select" name="status_akun" required>
                                                        <option value="Aktif" {{ ($r->status_akun ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif (Diizinkan Login)</option>
                                                        <option value="Nonaktif" {{ ($r->status_akun ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Diblokir / Belum Boleh Login)</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-success" style="font-size: 13px;">2. Status Pendaftaran (Seleksi Berkas)</label>
                                                    <select class="form-select" name="status_pendaftaran" required>
                                                        <option value="Diterima" {{ $r->status_pendaftaran == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                                        <option value="Pending" {{ $r->status_pendaftaran == 'Pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                                        <option value="Ditolak" {{ $r->status_pendaftaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light py-2">
                                                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success btn-sm px-4 fw-bold"><i class="fas fa-save me-1"></i> Simpan Verifikasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada data relawan yang mendaftar.</td>
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