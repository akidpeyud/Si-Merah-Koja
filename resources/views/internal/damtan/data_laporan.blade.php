<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR & ACCORDION STYLES --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar {
            width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto;
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
        
        .sidebar-collapse-btn {
            display: flex; justify-content: space-between; align-items: center;
            width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px;
            background: transparent; border: none; border-top: 1px dashed #e5e7eb;
            text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af;
            text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s;
        }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }

        .sidebar-submenu {
            display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px;
        }

        /* --- MAIN AREA --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        /* Table Custom Styles */
        .table th { background-color: #f9fafb; color: #4b5563; font-weight: 700; font-size: 13px; padding: 15px; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: 15px; font-size: 14px; color: #1f2937; vertical-align: middle; border-bottom: 1px solid #f3f4f6; }
        .table tbody tr:hover { background-color: #f8fafc; }
        .action-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none;}
        .action-btn.view { background-color: #e0f2fe; color: #0284c7; }
        .action-btn.view:hover { background-color: #bae6fd; }
        .action-btn.edit { background-color: #fef3c7; color: #d97706; margin: 0 5px; }
        .action-btn.edit:hover { background-color: #fde68a; }
        .action-btn.delete { background-color: #fee2e2; color: #ef4444; }
        .action-btn.delete:hover { background-color: #fecaca; }
        
        .badge-custom { padding: 6px 10px; font-weight: 600; font-size: 11px; border-radius: 6px; }

        /* --- DROPDOWN HOVER KUSTOM --- */
        .dropdown-menu { padding: 8px; border-radius: 10px; }
        .dropdown-item { border-radius: 6px; transition: all 0.2s ease-in-out; }
        .dropdown-item:hover, .dropdown-item:focus { background-color: #e0f2fe !important; }
    </style>
</head>
<body>

    <!-- ALERT SUCCESS GLOBAL -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- ALERT ERROR GLOBAL -->
    @if(session('error'))
        <div id="globalErrorAlert">
            <i class="fas fa-exclamation-triangle alert-icon"></i>
            <span>{{ session('error') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalErrorAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <script>
        function closeAlert(id) {
            let alertBox = document.getElementById(id);
            if(alertBox) {
                alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                setTimeout(() => alertBox.remove(), 400); 
            }
        }
        setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
        setTimeout(() => closeAlert('globalErrorAlert'), 4000);
    </script>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
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

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- BAGIAN KHUSUS USER & SUPER USER -->
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                
                <!-- ACCORDION PENCEGAHAN -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/pencegahan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="{{ Request::is('internal/pencegahan*') ? 'true' : 'false' }}">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/pencegahan*') ? 'show' : '' }}" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item {{ Request::is('internal/pencegahan/layanan-inspeksi*') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item {{ Request::is('internal/pencegahan/layanan-sosialisasi*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item {{ Request::is('internal/pencegahan/pelatihan*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item {{ Request::is('internal/pencegahan/pembinaan-pengembangan*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item {{ Request::is('internal/pencegahan/peningkatan-kapasitas*') ? 'active' : '' }}"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item {{ Request::is('internal/pencegahan/kelola-redkar*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="{{ Request::is('internal/damtan*') ? 'true' : 'false' }}">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/damtan*') ? 'show' : '' }}" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item {{ Request::is('internal/damtan/input-data*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <!-- Menu Data Laporan di-set Active di halaman ini -->
                        <a href="/internal/damtan/data-laporan" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn {{ Request::is('sapra*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="{{ Request::is('sapra*') ? 'true' : 'false' }}">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('sapra*') ? 'show' : '' }}" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item {{ Request::is('sapra/data_hidrant_gedung*') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Data Hidrant</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item {{ Request::is('sapra/data-hidrant-kota*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item {{ Request::is('sapra/prasarana-mako*') ? 'active' : '' }}"><i class="fas fa-building"></i> Prasarana Mako & Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item {{ Request::is('sapra/sarana-mako*') ? 'active' : '' }}"><i class="fas fa-fire-extinguisher"></i> Sarana Mako & Pos</a>
                        <a href="/sapra/logistik" class="sidebar-item {{ Request::is('sapra/logistik*') ? 'active' : '' }}"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
                    </div>
                </div>
            @endif

            <!-- BAGIAN KHUSUS OPERATOR & SUPER USER -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <!-- ACCORDION MANAJEMEN BERITA -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/operator*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="{{ Request::is('internal/operator*') ? 'true' : 'false' }}">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('internal/operator*') ? 'show' : '' }}" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item {{ Request::is('internal/operator/kelola-berita*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item {{ Request::is('internal/operator/infografis*') ? 'active' : '' }}"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item {{ Request::is('internal/operator/berita-medsos*') ? 'active' : '' }}"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </div>
            @endif

            <!-- ACCORDION PENGATURAN -->
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

        <!-- MAIN AREA (DATA LAPORAN) -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Data Laporan Penyelamatan</h1>
                    <p>Daftar seluruh laporan kejadian yang telah diinput ke dalam sistem.</p>
                </div>
                <div>
                    <!-- Tombol Ekspor Dropdown -->
                    <div class="dropdown d-inline-block me-2">
                        <button class="btn btn-outline-secondary fw-bold shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download me-2"></i> Ekspor Semua
                        </button>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="#" onclick="window.print()"><i class="fas fa-file-pdf me-2"></i> Format PDF</a></li>
                            <li><a class="dropdown-item py-2 text-success fw-bold" href="#" onclick="window.print()"><i class="fas fa-file-excel me-2"></i> Format Excel</a></li>
                            <li><a class="dropdown-item py-2 text-primary fw-bold" href="#" onclick="window.print()"><i class="fas fa-file-word me-2"></i> Format Word</a></li>
                        </ul>
                    </div>

                    <a href="/internal/damtan/input-data" class="btn btn-primary fw-bold shadow-sm" style="background-color: #10b981; border: none;">
                        <i class="fas fa-plus me-2"></i> Buat Laporan Baru
                    </a>
                </div>
            </div>

            <!-- Tabel Data Container -->
            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <!-- Filter & Search Bar -->
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted border-end-0"><i class="fas fa-search"></i></span>
                                <!-- ID searchInput ditambahkan untuk fungsi JS -->
                                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nomor laporan, lokasi, dsb...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- ID filterKategori ditambahkan untuk fungsi JS -->
                            <select id="filterKategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="Kebakaran">Kebakaran</option>
                                <option value="Non-Kebakaran">Non-Kebakaran</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-2 text-end">
                            <button class="btn btn-outline-secondary w-100" onclick="resetFilter()"><i class="fas fa-sync-alt me-2"></i>Reset</button>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="15%">No. Laporan</th>
                                    <th width="20%">Waktu Kejadian</th>
                                    <th width="20%">Kategori Kejadian</th>
                                    <th width="10%">Prioritas</th>
                                    <th width="15%">Status Evakuasi</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <!-- ID tableBody ditambahkan untuk fungsi JS -->
                            <tbody id="tableBody">
                                <!-- Data Dummy 1 -->
                                <tr>
                                    <td class="text-center text-muted">1</td>
                                    <td><strong>REG-20240101-001</strong></td>
                                    <td>
                                        <div class="text-dark fw-bold">12 Jan 2024</div>
                                        <div class="text-muted" style="font-size: 12px;"><i class="far fa-clock me-1"></i> 14:30 WIB</div>
                                    </td>
                                    <td class="kategori-cell">
                                        <div class="fw-bold text-danger">Kebakaran</div>
                                        <div class="text-muted" style="font-size: 12px;">Rumah Tinggal</div>
                                    </td>
                                    <td><span class="badge badge-custom bg-danger text-white">Darurat</span></td>
                                    <td><span class="badge badge-custom bg-success bg-opacity-10 text-success border border-success"><i class="fas fa-check-circle me-1"></i>Selesai</span></td>
                                    <td class="text-center">
                                        <!-- Tombol Lihat merender Modal -->
                                        <button class="action-btn view" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fas fa-eye"></i></button>
                                        <a href="/internal/damtan/edit-data/1" class="action-btn edit" title="Edit Laporan"><i class="fas fa-edit"></i></a>
                                        <!-- Tombol Hapus memicu fungsi JS konfirmasi -->
                                        <button class="action-btn delete" title="Hapus" onclick="hapusBaris(this)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Data Dummy 2 -->
                                <tr>
                                    <td class="text-center text-muted">2</td>
                                    <td><strong>REG-20240101-002</strong></td>
                                    <td>
                                        <div class="text-dark fw-bold">11 Jan 2024</div>
                                        <div class="text-muted" style="font-size: 12px;"><i class="far fa-clock me-1"></i> 09:15 WIB</div>
                                    </td>
                                    <td class="kategori-cell">
                                        <div class="fw-bold text-primary">Non-Kebakaran</div>
                                        <div class="text-muted" style="font-size: 12px;">Pohon Tumbang</div>
                                    </td>
                                    <td><span class="badge badge-custom bg-warning text-dark">Tinggi</span></td>
                                    <td><span class="badge badge-custom bg-warning bg-opacity-10 text-warning border border-warning"><i class="fas fa-spinner fa-spin me-1"></i>Dalam Proses</span></td>
                                    <td class="text-center">
                                        <button class="action-btn view" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fas fa-eye"></i></button>
                                        <a href="/internal/damtan/edit-data/2" class="action-btn edit" title="Edit Laporan"><i class="fas fa-edit"></i></a>
                                        <button class="action-btn delete" title="Hapus" onclick="hapusBaris(this)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Data Dummy 3 -->
                                <tr>
                                    <td class="text-center text-muted">3</td>
                                    <td><strong>REG-20240101-003</strong></td>
                                    <td>
                                        <div class="text-dark fw-bold">10 Jan 2024</div>
                                        <div class="text-muted" style="font-size: 12px;"><i class="far fa-clock me-1"></i> 16:45 WIB</div>
                                    </td>
                                    <td class="kategori-cell">
                                        <div class="fw-bold text-primary">Non-Kebakaran</div>
                                        <div class="text-muted" style="font-size: 12px;">Penyelamatan Hewan (Ular)</div>
                                    </td>
                                    <td><span class="badge badge-custom bg-primary text-white">Sedang</span></td>
                                    <td><span class="badge badge-custom bg-success bg-opacity-10 text-success border border-success"><i class="fas fa-check-circle me-1"></i>Selesai</span></td>
                                    <td class="text-center">
                                        <button class="action-btn view" title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fas fa-eye"></i></button>
                                        <a href="/internal/damtan/edit-data/3" class="action-btn edit" title="Edit Laporan"><i class="fas fa-edit"></i></a>
                                        <button class="action-btn delete" title="Hapus" onclick="hapusBaris(this)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="card-footer bg-white p-3 d-flex justify-content-between align-items-center border-top">
                    <span class="text-muted" style="font-size: 13px;" id="dataCount">Menampilkan 3 laporan</span>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background-color: #10b981; border-color: #10b981;">1</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">Selanjutnya</a></li>
                    </ul>
                </div>
            </div>

        </main>
    </div>

    <!-- ================= MODAL LIHAT DETAIL ================= -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background-color: #111827; color: white;">
                    <h5 class="modal-title fw-bold" id="detailModalLabel"><i class="fas fa-file-alt me-2 text-success"></i> Detail Laporan Penyelamatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <!-- Simulasi Data Detail Laporan -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1" style="font-size: 12px;">Nomor Laporan</p>
                            <h6 class="fw-bold">REG-20240101-001</h6>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="text-muted mb-1" style="font-size: 12px;">Status Evakuasi</p>
                            <span class="badge bg-success">Selesai</span>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">1. Informasi Dasar</h6>
                            <table class="table table-borderless table-sm mb-0" style="font-size: 14px;">
                                <tr><td width="35%" class="text-muted">Kategori</td><td>: <strong>Kebakaran (Rumah Tinggal)</strong></td></tr>
                                <tr><td class="text-muted">Waktu Kejadian</td><td>: 12 Januari 2024 - 14:30 WIB</td></tr>
                                <tr><td class="text-muted">Alamat Lokasi</td><td>: Jl. Pangeran Diponegoro, RT 05, Kec. Pasar Jambi</td></tr>
                                <tr><td class="text-muted">Prioritas</td><td>: <span class="text-danger fw-bold">Darurat</span></td></tr>
                            </table>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">2. Dampak & Logistik</h6>
                            <table class="table table-borderless table-sm mb-0" style="font-size: 14px;">
                                <tr><td width="35%" class="text-muted">Korban Jiwa/Luka</td><td>: Tidak Ada</td></tr>
                                <tr><td class="text-muted">Armada Turun</td><td>: Unit Pompa, Unit Tangki</td></tr>
                                <tr><td class="text-muted">Jumlah Personel</td><td>: 8 Orang</td></tr>
                            </table>
                        </div>
                    </div>

                    <p class="text-muted text-center mt-4" style="font-size: 12px;">
                        <em>*Ini adalah pratinjau antarmuka. Data akan disesuaikan dengan database nanti.</em>
                    </p>
                </div>
                
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-light fw-bold px-4" data-bs-dismiss="modal">Tutup</button>
                    
                    <!-- Tombol Cetak Dropdown Baru -->
                    <div class="dropdown">
                        <button class="btn btn-primary fw-bold px-4 dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #0284c7; border: none;">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="#"><i class="fas fa-file-pdf me-2"></i> Cetak PDF</a></li>
                            <li><a class="dropdown-item py-2 text-success fw-bold" href="#"><i class="fas fa-file-excel me-2"></i> Ekspor Excel</a></li>
                            <li><a class="dropdown-item py-2 text-primary fw-bold" href="#"><i class="fas fa-file-word me-2"></i> Ekspor Word</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ================= END MODAL ================= -->

    <!-- Script Bootstrap & Fungsi Search/Filter JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // FUNGSI 1: SEARCH & FILTER FRONTEND
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterKategori = document.getElementById('filterKategori');
            const tableBody = document.getElementById('tableBody');
            const rows = tableBody.getElementsByTagName('tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const categoryTerm = filterKategori.value.toLowerCase();
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const rowText = rows[i].textContent.toLowerCase();
                    // Mengambil teks dari kolom Kategori (kolom ke-4, index 3)
                    const categoryCellText = rows[i].getElementsByTagName('td')[3].textContent.toLowerCase(); 

                    const matchesSearch = rowText.includes(searchTerm);
                    const matchesCategory = categoryTerm === "" || categoryCellText.includes(categoryTerm);

                    if (matchesSearch && matchesCategory) {
                        rows[i].style.display = '';
                        visibleCount++;
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
                
                // Update teks jumlah data di footer
                document.getElementById('dataCount').innerText = "Menampilkan " + visibleCount + " laporan";
            }

            // Jalankan fungsi filterTable setiap kali user mengetik atau mengganti dropdown
            searchInput.addEventListener('keyup', filterTable);
            filterKategori.addEventListener('change', filterTable);
        });

        // FUNGSI 2: RESET FILTER
        function resetFilter() {
            document.getElementById('searchInput').value = "";
            document.getElementById('filterKategori').value = "";
            // Trigger event keyup untuk mengembalikan tabel seperti semula
            document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
        }

        // FUNGSI 3: KONFIRMASI HAPUS DATA
        function hapusBaris(button) {
            // Memunculkan pop-up konfirmasi standar browser
            if (confirm("AWAS! Apakah Anda yakin ingin menghapus data laporan ini? Tindakan ini tidak dapat dibatalkan.")) {
                // Jika ditekan 'OK', hapus baris tabel (TR) secara visual
                const row = button.closest('tr');
                row.remove();
                
                // Update ulang jumlah data
                document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
                
                // (Nantinya kode penghapusan ke database diletakkan di sini)
            }
        }
    </script>
</body>
</html>