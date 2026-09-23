<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Pos - SIMERAH KOJA</title>
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
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 25px 20px; display: flex; flex-direction: column; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f8fafc; color: #0f172a; }
        .sidebar-item.active { background-color: #f0f9ff; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; transition: color 0.2s; }
        
        /* CSS KHUSUS SESUAI FOTO SIDEBAR */
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 18px 15px; margin-top: 5px; background: transparent; border: none; border-top: 1px dashed #cbd5e1; text-align: left; font-size: 11.5px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 0; margin-top: 0; margin-bottom: 10px; }
        
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13.5px; }
        .table-custom thead th { background-color: #111827; color: #f8fafc; font-weight: 600; padding: 16px 12px; text-align: center; font-size: 11.5px; letter-spacing: 0.5px; text-transform: uppercase; border-bottom: none; }
        .table-custom tbody td { padding: 18px 12px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .btn-action { padding: 8px 12px; font-size: 12.5px; border-radius: 6px; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-edit { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-edit:hover { background-color: #e2e8f0; color: #0f172a; }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .btn-delete:hover { background-color: #fecaca; color: #991b1b; }
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
                <i class="fas fa-user-circle"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item" style="margin-bottom: 10px;">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(in_array(Auth::user()->role, ['pencegahan', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="false">
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
            @endif

            @if(in_array(Auth::user()->role, ['pemadaman', 'user', 'super_user']))
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>BAGIAN PEMADAMAN</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data & Laporan</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
                        <a href="#" class="sidebar-item"><i class="fas fa-users-cog"></i> Jadwal Piket Regu</a>
                        <a href="#" class="sidebar-item"><i class="fas fa-running"></i> Data Relawan Redkar</a>
                    </div>
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>BAGIAN SAPRA</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <!-- GRUP MANAJEMEN AIR -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
<a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
<a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota jambi</a>

<!-- GRUP FASILITAS & POS -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
<a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
<a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
<a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
<a href="/sapra/kelola-pos" class="sidebar-item active"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

<!-- GRUP PERENCANAAN / MUTU BAKU -->
<span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
<a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>                 </div>
                </div>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="false">
                    <span>MANAJEMEN BERITA</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>
            @endif

            <!-- Border dashed bawah biar persis sama foto -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false" style="border-bottom: 1px dashed #cbd5e1; padding-bottom: 18px;">
                <span>PENGATURAN AKUN</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu" style="margin-top: 10px;">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>
        </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Kelola Data Pos & Mako</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">Tambah, edit, atau hapus stasiun Pos Pemadam. Data yang ditambahkan akan otomatis menjadi Tab di menu lainnya.</p>
                </div>
                <button class="btn btn-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none; padding: 10px 16px; border-radius: 8px;">
                    <i class="fas fa-plus me-1"></i> Tambah Pos Baru
                </button>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="20%" style="text-align: left; padding-left: 20px;">NAMA POS</th>
                                <th width="40%" style="text-align: left;">ALAMAT LENGKAP</th>
                                <th width="15%">KODE MAP</th>
                                <th width="20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPos as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold text-dark">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark" style="padding-left: 20px; font-size: 14px;">{{ $item->nama_pos }}</td>
                                    <td>{{ $item->alamat ?? '-' }}</td>
                                    <td class="text-center"><span class="badge bg-light text-dark border">{{ $item->kode_map ?? '-' }}</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id_pos }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="/sapra/kelola-pos/delete/{{ $item->id_pos }}" method="POST" onsubmit="return confirm('HATI-HATI! Menghapus pos ini mungkin akan menyebabkan error pada data Prasarana/Sarana yang terkait dengan pos ini. Lanjutkan?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash-alt"></i> Hapus</button>
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
                                                        <label class="form-label fw-bold small text-secondary">Kode Map</label>
                                                        <input type="text" class="form-control border-light-subtle shadow-sm" name="kode_map" value="{{ $item->kode_map }}">
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
                            
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="p-5 text-center text-muted">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                                <i class="fas fa-warehouse" style="font-size: 32px; color: #cbd5e1;"></i>
                                            </div>
                                            <p class="mb-0 fw-bold text-dark">Belum ada data pos.</p>
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
                        <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4" style="background-color: #0284c7; border: none;">Tambah Pos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>