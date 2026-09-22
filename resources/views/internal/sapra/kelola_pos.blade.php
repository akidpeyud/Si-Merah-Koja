<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Pos - SIMERAH KOJA</title>
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* 1. KUNCI BODY BIAR GAK BISA DI-SCROLL KESELURUHAN */
        body { background-color: #f8fafc; color: #1e293b; overflow: hidden; }

        /* ALERT STYLES */
        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s; }
        #globalSuccessAlert .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }

        /* 2. TINGGI TETAP UNTUK NAVBAR */
        .navbar-internal { background-color: #0f172a; padding: 0 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1030; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); height: 74px; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- LAYOUT UTAMA (INDEPENDENT SCROLLING) --- */
        /* 3. TINGGI SISA DARI LAYAR - NAVBAR */
        .dashboard-container { display: flex; height: calc(100vh - 74px); }
        
        /* 4. SCROLL MANDIRI UNTUK SIDEBAR */
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 30px 15px; display: flex; flex-direction: column; gap: 4px; height: 100%; overflow-y: auto; flex-shrink: 0; }
        
        /* 5. SCROLL MANDIRI UNTUK KONTEN UTAMA */
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; height: 100%; }

        /* SIDEBAR STYLES */
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #475569; text-decoration: none; font-size: 13.5px; font-weight: 600; border-radius: 8px; transition: all 0.2s; margin-bottom: 2px; }
        .sidebar-item:hover { background-color: #f1f5f9; color: #0f172a; }
        
        /* State Active untuk Menu Terpilih */
        .sidebar-item.active { background-color: #eff6ff; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #94a3b8; transition: color 0.2s; }

        /* Tombol Accordion */
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 12px 15px; background: transparent; border: none; text-align: left; font-size: 11.5px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; transition: all 0.2s; border-radius: 8px; }
        .sidebar-collapse-btn:hover { color: #475569; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }

        /* Garis Putus-putus antar bidang */
        .sidebar-separator { border-top: 1.5px dashed #e2e8f0; margin: 10px 15px; }
        
        /* Label Judul Kecil */
        .sidebar-heading { display: block; font-size: 11px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 12px; margin-bottom: 6px; letter-spacing: 0.5px; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 2px; padding-left: 5px; margin-top: 4px; }

        /* TABEL & STYLES MODERN */
        .table-card { background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13px; }
        
        /* 6. HEADER TABEL DIBIKIN STICKY BIAR ENAK PAS SCROLL BAWAH */
        .table-custom thead th { background-color: #0f172a; color: #f8fafc; font-weight: 600; padding: 16px; border-bottom: none; text-align: center; font-size: 12px; letter-spacing: 0.5px; text-transform: uppercase; position: sticky; top: 0; z-index: 10; }
        .table-custom tbody td { padding: 14px 16px; color: #475569; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .table-custom tbody tr:hover { background-color: #f8fafc; }

        .btn-action { padding: 6px 12px; font-size: 13px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-edit { background-color: #f59e0b; color: white; }
        .btn-delete { background-color: #ef4444; color: white; }
        
        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
        
        /* ==================================================
           CSS KHUSUS UNTUK PRINT / CETAK PDF
           ================================================== */
        @media print {
            .navbar-internal, .sidebar, .btn, .modal, .search-container {
                display: none !important;
            }
            body, .main-content {
                background-color: white !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                overflow: visible !important;
                height: auto !important;
            }
            .dashboard-container { display: block !important; height: auto !important; }
            .table-card { box-shadow: none !important; border: none !important; }
            table th:last-child, table td:last-child { display: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
        <script>setTimeout(() => document.getElementById('globalSuccessAlert')?.remove(), 4000);</script>
    @endif

    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</span>
                <i class="fas fa-user-circle" style="font-size: 20px; color: #9ca3af;"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <!-- SIDEBAR FULL PERSIS DESAIN TERBARU -->
        <aside class="sidebar" id="sidebarAccordion">
            
            <!-- Dashboard Utama -->
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <div class="sidebar-separator"></div>

            <!-- BAGIAN PENCEGAHAN -->
            @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan">
                    <span>BAGIAN PENCEGAHAN</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>
                <div class="sidebar-separator"></div>
            @endif

            <!-- BAGIAN PEMADAMAN -->
            @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman">
                    <span>BAGIAN PEMADAMAN</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data & Laporan</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
                     <!-- Menu Baru Untuk Surat -->
                        <a href="/internal/surat-korban/create" class="sidebar-item {{ Request::is('internal/surat*') ? 'active' : '' }}"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
                    </div>
                </div>
                <div class="sidebar-separator"></div>
            @endif

            <!-- BAGIAN SAPRA -->
            @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>BAGIAN SAPRA</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        
                        <!-- MANAJEMEN SARANA DAN PRASARANA -->
                       <span class="sidebar-heading" style="text-transform: uppercase;">SARANA DAN PRASARANA</span>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pemadam Kebakaran</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pemadam Kebakaran</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan & Evakuasi</a>
                        <a href="/sapra/sarana-pemeriksaan" class="sidebar-item"><i class="fas fa-search"></i> Sarana Pemeriksaan Proteksi Kebakaran</a>    
                        
                        <!-- ACTIVE ADA DI SINI KARENA INI HALAMAN KELOLA POS -->
                        <a href="/sapra/kelola-pos" class="sidebar-item active"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>
                        
                        <!-- MANAJEMEN AIR -->
                        <span class="sidebar-heading" style="text-transform: uppercase;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota jambi</a>

                        <!-- LOGISTIK & DISTRIBUSI -->
                        <span class="sidebar-heading" style="text-transform: uppercase;">LOGISTIK & DISTRIBUSI</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="sidebar-item"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a>
                    </div>
                </div>
                <div class="sidebar-separator"></div>
            @endif

            <!-- MANAJEMEN BERITA -->
            @if(in_array(Auth::user()->role, ['operator', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="false">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </div>
                <div class="sidebar-separator"></div>
            @endif

            <!-- PENGATURAN AKUN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan">
                <span>PENGATURAN AKUN</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/profile" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>

        </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">Kelola Data Pos & Mako</h1>
                    <p style="color: #64748b; font-size: 14px; margin: 0;">Tambah, edit, atau hapus stasiun Pos Pemadam. Data yang ditambahkan akan otomatis menjadi Tab di menu lainnya.</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <!-- FITUR SEARCH BAR -->
                    <div class="input-group shadow-sm me-2 search-container" style="width: 280px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #cbd5e1;"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nama pos atau alamat..." style="border-color: #cbd5e1; font-size: 14px;">
                    </div>
                    
                    <button class="btn btn-primary fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none;">
                        <i class="fas fa-plus me-1"></i> Tambah Pos Baru
                    </button>
                </div>
            </div>

            <div class="table-card mt-4">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="25%" style="text-align: left; padding-left: 20px;">NAMA POS</th>
                                <th width="40%" style="text-align: left;">ALAMAT LENGKAP</th>
                                <th width="15%">KODE MAP</th>
                                <th width="15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPos as $index => $item)
                                <tr class="data-row">
                                    <td class="text-center fw-bold text-dark">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark data-name" style="padding-left: 20px; font-size: 14px;">{{ $item->nama_pos }}</td>
                                    <td class="data-address">{{ $item->alamat ?? '-' }}</td>
                                    
                                    <!-- KODE MAPS CLICKABLE -->
                                    <td class="text-center align-middle">
                                        @if($item->kode_map)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_map) }}" target="_blank" class="badge bg-light btn-hover text-primary border shadow-sm text-decoration-none px-3 py-2" style="font-size: 12px; transition: 0.2s;">
                                                <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $item->kode_map }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id_pos }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="/sapra/kelola-pos/delete/{{ $item->id_pos }}" method="POST" onsubmit="return confirm('HATI-HATI! Menghapus pos ini mungkin akan menyebabkan error pada data Prasarana/Sarana yang terkait dengan pos ini. Lanjutkan?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT DATA -->
                                <div class="modal fade" id="modalEdit{{ $item->id_pos }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-light pb-3">
                                                <h5 class="modal-title fw-bold text-dark">Edit Data Pos</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="/sapra/kelola-pos/update/{{ $item->id_pos }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-body text-start p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small text-secondary">Nama Pos</label>
                                                        <input type="text" class="form-control border-light-subtle shadow-sm" name="nama_pos" value="{{ $item->nama_pos }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small text-secondary">Alamat Lengkap</label>
                                                        <textarea class="form-control border-light-subtle shadow-sm" name="alamat" rows="2" required>{{ $item->alamat }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small text-secondary">Kode Map (Opsional)</label>
                                                        <input type="text" class="form-control border-light-subtle shadow-sm" name="kode_map" value="{{ $item->kode_map }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light pt-3">
                                                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #0284c7; border: none;">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="p-5 text-center text-muted">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                                <i class="fas fa-warehouse" style="font-size: 32px; color: #cbd5e1;"></i>
                                            </div>
                                            <p class="mb-0 fw-bold text-dark">Belum ada data pos tersimpan.</p>
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

    <!-- MODAL TAMBAH POS BARU -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light pb-3">
                    <h5 class="modal-title fw-bold text-dark">Tambah Pos Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/sapra/kelola-pos/store" method="POST">
                    @csrf
                    <div class="modal-body text-start p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Nama Pos</label>
                            <input type="text" class="form-control border-light-subtle shadow-sm" name="nama_pos" placeholder="Contoh: POS ALAM BARAJO" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Alamat Lengkap</label>
                            <textarea class="form-control border-light-subtle shadow-sm" name="alamat" rows="2" placeholder="Masukkan alamat lengkap..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Kode Map (Opsional)</label>
                            <input type="text" class="form-control border-light-subtle shadow-sm" name="kode_map" placeholder="Contoh: 9HGG+H2M">
                        </div>
                    </div>
                    <div class="modal-footer bg-light pt-3">
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #0284c7; border: none;">Tambah Pos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK SEARCH BAR -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.data-row');
            
            rows.forEach(row => {
                let nama = row.querySelector('.data-name').textContent.toLowerCase();
                let alamat = row.querySelector('.data-address').textContent.toLowerCase();
                
                if(nama.includes(filter) || alamat.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>