<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribusi Barang Staff - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s; }
        #globalSuccessAlert .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }

        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1030; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f8fafc; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; transition: color 0.2s; }
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        
        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13.5px; }
        .table-custom thead th { color: #f8fafc; font-weight: 600; padding: 16px 12px; text-align: center; font-size: 11.5px; letter-spacing: 0.5px; text-transform: uppercase; border-bottom: none; }
        .table-custom tbody td { padding: 14px 12px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

        .btn-action { padding: 8px 12px; font-size: 12.5px; border-radius: 6px; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-edit { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-edit:hover { background-color: #e2e8f0; color: #0f172a; }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .btn-delete:hover { background-color: #fecaca; color: #991b1b; }
        
        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
        
        .badge-barang { background-color: #e0f2fe; color: #0284c7; padding: 6px 12px; border-radius: 6px; font-weight: 800; border: 1px solid #bae6fd; font-size: 12.5px; }
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
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'SAPRA') }}</span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <!-- FULL SIDEBAR TERINTEGRASI -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="false">
                    <span>BAGIAN PENCEGAHAN</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu" style="padding-left:0;">
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>BAGIAN PEMADAMAN</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu" style="padding-left:0;">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>BAGIAN SAPRA</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu" style="padding-left:0;">
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <!-- GRUP LOGISTIK & DISTRIBUSI -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">LOGISTIK & DISTRIBUSI</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                        <a href="/sapra/distribusi-staff" class="sidebar-item active"><i class="fas fa-user-check"></i> Distribusi Barang Staff</a> </div>
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['operator', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="false">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu" style="padding-left:0;">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </div>
            @endif

            <!-- ACCORDION PENGATURAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false">
                <span>Pengaturan Akun</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu" style="padding-left:0;">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>        
        </aside>

        <!-- MAIN AREA DISTRIBUSI -->
        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Bukti Distribusi Barang</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">Catat dan pantau waktu pembagian inventaris ke masing-masing anggota/staff.</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div class="input-group shadow-sm me-2 search-container" style="width: 300px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #cbd5e1;"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nama staff atau barang..." style="border-color: #cbd5e1; font-size: 14px;">
                    </div>
                    <!-- TOMBOL CETAK PDF SIMPLE -->
                    <a href="/sapra/distribusi-staff/cetak" target="_blank" class="btn fw-bold shadow-sm text-white d-flex align-items-center me-2" style="background-color: #ef4444; border: none; padding: 10px 16px; border-radius: 8px; transition: 0.2s;">
                        <i class="fas fa-file-pdf me-2 fs-5"></i> PDF
                    </a>
                    
                    <!-- TOMBOL INPUT UTAMA (data-nama KOSONG) -->
                    <button class="btn btn-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" data-nama="" style="background-color: #0284c7; border: none; padding: 10px 16px; border-radius: 8px;">
                        <i class="fas fa-user-plus me-1"></i> Input Distribusi Baru
                    </button>
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table table-custom" style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background-color: #111827;">
                            <tr>
                                <th width="5%" style="border-top-left-radius: 10px;">NO</th>
                                <th width="25%" style="text-align: left; padding-left: 20px;">NAMA PENERIMA</th>
                                <th width="25%">BARANG / INVENTARIS</th>
                                <th width="20%">WAKTU TERIMA</th>
                                <th width="15%" style="text-align: left;">KETERANGAN</th>
                                <th width="10%" style="border-top-right-radius: 10px;">AKSI</th>
                            </tr>
                        </thead>
                        
                        @forelse($dataDistribusi as $nama => $items)
                            <tbody class="staff-group" style="border-bottom: 4px solid #f1f5f9;">
                                <!-- HEADER KELOMPOK (NAMA STAFF) -->
                                <tr class="staff-header" style="background-color: #f8fafc;">
                                    <td class="text-center fw-bolder text-primary align-middle" style="font-size: 15px; border-bottom: 2px solid #e2e8f0;">{{ $loop->iteration }}</td>
                                    <td colspan="5" class="staff-name-search align-middle" style="padding: 12px 20px; border-bottom: 2px solid #e2e8f0;">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user" style="font-size: 14px;"></i>
                                            </div>
                                            <span class="fw-bolder text-dark" style="font-size: 15px; letter-spacing: 0.5px; text-transform: uppercase;">{{ $nama }}</span>
                                            <span class="badge bg-primary ms-3 rounded-pill px-3 py-2 shadow-sm" style="font-size: 11px;"><i class="fas fa-box-open me-1"></i> {{ count($items) }} Total Barang</span>
                                            
                                            <!-- TOMBOL TAMBAH BARANG INLINE (data-nama NYA TERISI) -->
                                            <button class="btn btn-sm btn-outline-primary ms-auto fw-bold rounded-pill px-3 shadow-sm" style="font-size: 11px; border-width: 2px;" data-bs-toggle="modal" data-bs-target="#modalTambah" data-nama="{{ $nama }}">
                                                <i class="fas fa-plus me-1"></i> TAMBAH BARANG
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- LIST BARANG (TREE-VIEW) -->
                                @foreach($items as $item)
                                    <tr class="data-row" style="background-color: #ffffff; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='#ffffff'">
                                        <!-- Kolom NO kosong tapi punya background nyambung sama header -->
                                        <td style="background-color: #f8fafc; border-right: 2px solid #e2e8f0;"></td>
                                        
                                        <!-- Ikon panah cabang (Tree Node) -->
                                        <td class="text-end align-middle pe-4" style="color: #cbd5e1;">
                                            <i class="fas fa-level-up-alt fa-rotate-90 fs-4"></i>
                                        </td>
                                        
                                        <!-- Info Barang -->
                                        <td class="data-barang py-3">
                                            <span class="badge-barang shadow-sm">{{ $item->nama_barang }}</span>
                                            @if($item->detail_barang)
                                                <div class="text-muted mt-2 fw-medium" style="font-size: 12px; margin-left: 5px;">
                                                    <i class="fas fa-caret-right text-secondary me-1"></i> {{ $item->detail_barang }}
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <!-- Waktu -->
                                        <td class="text-center align-middle">
                                            <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($item->waktu_terima)->format('d M Y') }}</div>
                                            <div class="text-muted mt-1" style="font-size: 11px;">
                                                <i class="far fa-clock text-secondary me-1"></i> {{ \Carbon\Carbon::parse($item->waktu_terima)->format('H:i') }} WIB
                                            </div>
                                        </td>
                                        
                                        <!-- Keterangan -->
                                        <td class="align-middle" style="text-align: left; font-size: 12px; color: #64748b; font-weight: 500;">
                                            {{ $item->keterangan ?? '-' }}
                                        </td>
                                        
                                        <!-- Aksi -->
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn-action btn-edit shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="/sapra/distribusi-staff/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data penerimaan ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete shadow-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL EDIT DATA -->
                                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-light pb-3">
                                                    <h5 class="modal-title fw-bold text-dark">Edit Data Distribusi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/sapra/distribusi-staff/update/{{ $item->id }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body text-start p-4">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small text-secondary">Nama Staff Penerima</label>
                                                            <input type="text" class="form-control border-light-subtle shadow-sm" name="nama_penerima" value="{{ $item->nama_penerima }}" required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold small text-secondary">Jenis Barang</label>
                                                                <input type="text" class="form-control border-light-subtle shadow-sm" name="nama_barang" value="{{ $item->nama_barang }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold small text-secondary">Detail (Warna/Ukuran)</label>
                                                                <input type="text" class="form-control border-light-subtle shadow-sm" name="detail_barang" value="{{ $item->detail_barang }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small text-secondary">Waktu Serah Terima</label>
                                                            <input type="datetime-local" class="form-control border-light-subtle shadow-sm" name="waktu_terima" value="{{ \Carbon\Carbon::parse($item->waktu_terima)->format('Y-m-d\TH:i') }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small text-secondary">Keterangan Tambahan</label>
                                                            <textarea class="form-control border-light-subtle shadow-sm" name="keterangan" rows="2">{{ $item->keterangan }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light pt-3">
                                                        <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4" style="background-color: #0284c7; border: none;">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        @empty
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="p-5 text-center text-muted">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                                <i class="fas fa-box-open" style="font-size: 32px; color: #cbd5e1;"></i>
                                            </div>
                                            <p class="mb-0 fw-bold text-dark">Belum ada data distribusi barang ke staff.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH DISTRIBUSI BARU -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light pb-3">
                    <h5 class="modal-title fw-bold text-dark">Input Distribusi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <form action="/sapra/distribusi-staff/store" method="POST">
                    @csrf
                    <div class="modal-body text-start p-4">
                        <div class="alert alert-info mt-0 mb-3" style="font-size:12px;">
                            <i class="fas fa-info-circle me-1"></i> Waktu serah terima otomatis mendeteksi jam saat ini, tapi bisa Anda ubah sesuai kejadian nyata.
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Nama Staff Penerima</label>
                            <!-- TAMBAHAN ID DISINI BIAR BISA DITANGKAP SAMA JAVASCRIPT -->
                            <input type="text" class="form-control border-light-subtle shadow-sm" name="nama_penerima" id="inputNamaPenerima" placeholder="Contoh: Agus Wiyoto" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jenis Barang</label>
                                <input type="text" class="form-control border-light-subtle shadow-sm" name="nama_barang" placeholder="Contoh: Baju Tahan Panas" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">Detail (Warna/Ukuran)</label>
                                <input type="text" class="form-control border-light-subtle shadow-sm" name="detail_barang" placeholder="Contoh: Coklat / Uk. 42">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Waktu Serah Terima</label>
                            <input type="datetime-local" class="form-control border-light-subtle shadow-sm" name="waktu_terima" value="{{ date('Y-m-d\TH:i') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Keterangan Tambahan</label>
                            <textarea class="form-control border-light-subtle shadow-sm" name="keterangan" rows="2" placeholder="Kosongkan jika tidak ada..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light pt-3">
                        <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4" style="background-color: #0284c7; border: none;">Simpan Bukti Terima</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // FUNGSI JAVASCRIPT BUAT BIKIN MODAL TAMBAH JADI PINTER
        let modalTambah = document.getElementById('modalTambah')
        modalTambah.addEventListener('show.bs.modal', function (event) {
            // Tangkap tombol mana yang nge-klik modal ini
            let button = event.relatedTarget
            // Ambil data-nama dari tombol itu (Bisa nama staff, bisa kosong)
            let nama = button.getAttribute('data-nama')
            // Ambil input form namanya
            let inputNama = document.getElementById('inputNamaPenerima')
            
            // Masukin namanya ke form
            inputNama.value = nama;

            if(nama !== '') {
                // Kalo dipencet dari baris nama orang, field namanya di-lock (readonly)
                inputNama.setAttribute('readonly', 'true');
                inputNama.style.backgroundColor = '#f1f5f9'; // Warna abu-abu soft
            } else {
                // Kalo dipencet dari tombol atas, field namanya bebas diisi
                inputNama.removeAttribute('readonly');
                inputNama.style.backgroundColor = '#ffffff'; // Balik putih
            }
        });

        // SCRIPT SEARCH CANGGIH
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let groups = document.querySelectorAll('.staff-group');
            
            groups.forEach(group => {
                let matchInGroup = false;
                
                // Cek nama header staf-nya
                let headerText = group.querySelector('.staff-name-search').textContent.toLowerCase();
                if(headerText.includes(filter)) matchInGroup = true;
                
                // Cek isi barangnya
                let rows = group.querySelectorAll('.data-row');
                rows.forEach(row => {
                    let textBarang = row.querySelector('.data-barang').textContent.toLowerCase();
                    // Munculin baris kalau nama barangnya cocok, ATAU kalau nama staf-nya yang dicari
                    if(textBarang.includes(filter) || headerText.includes(filter)) {
                        row.style.display = '';
                        matchInGroup = true; // Ketemu di dalam grup ini
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Kalau ada yang cocok di grup ini, tampilkan grupnya (termasuk headernya)
                if(matchInGroup) {
                    group.style.display = '';
                    group.querySelector('.staff-header').style.display = '';
                } else {
                    group.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>