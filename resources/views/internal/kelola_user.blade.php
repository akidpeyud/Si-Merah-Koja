<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - SIMERAH KOJA</title>
<<<<<<< HEAD

=======
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
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
            color: white; padding: 16px 24px; border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2); z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; }
        #globalErrorAlert { background-color: #ef4444; }
        .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; cursor: pointer; transition: 0.2s; }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* --- NAVBAR --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }
        .badge-role.operator { background: #8b5cf6; }
        .badge-role.user { background: #10b981; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.2s;}
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto;}
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        /* --- HALAMAN KELOLA USER --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .content-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .table th { background-color: #f8fafc; color: #4b5563; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; padding: 15px; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: 15px; vertical-align: middle; font-size: 14px; color: #1f2937; border-bottom: 1px solid #e5e7eb; }
        
        .btn-add { background-color: #10b981; color: white; font-weight: 700; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; transition: 0.2s; }
        .btn-add:hover { background-color: #059669; color: white; }

        .alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 12px 15px; border-radius: 8px; font-size: 13px; font-weight: 500; margin-bottom: 20px; }
    </style>
</head>
<body>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- ALERT ERROR -->
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
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="false">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/kelola-rpkbgl" class="sidebar-item"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                        <a href="/internal/pencegahan/kelola-skk" class="sidebar-item"><i class="fas fa-shield-alt"></i> Kelola SKK</a> 
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/kelola-edukasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="false">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>
                        
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    </div>
                </div>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
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
            @endif

            <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="true">
                <span>Pengaturan Akun</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse show" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item active"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="page-header mb-0">
                    <h1 style="margin-bottom: 5px;">Kelola Pengguna</h1>
                    <p class="mb-0">Manajemen akses dan daftar anggota internal SIMERAH KOJA.</p>
                </div>
                <button type="button" class="btn btn-add shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus me-2"></i>Tambah User Baru
                </button>
            </div>

            @if($errors->any())
                <div class="alert-error shadow-sm">
                    <i class="fas fa-exclamation-circle me-2"></i> <strong>Gagal memproses data:</strong>
                    <ul class="mt-1 mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIP / No Pegawai</th>
                                <th>Email</th>
                                <th>Hak Akses (Role)</th>
                                <th class="text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $u)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $u->nama_lengkap }}</td>
                                <td>{{ $u->nomor_pegawai }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    <span class="badge-role {{ $u->role }}">
                                        {{ $u->role === 'user' ? 'Pegawai Internal' : ucwords(str_replace('_', ' ', $u->role)) }}
                                    </span>
                                </td>
                                <td class="text-center d-flex justify-content-center gap-1">
                                    <button class="btn btn-sm btn-primary" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $u->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Form Tombol Hapus -->
                                    <form action="/internal/kelola-user/hapus/{{ $u->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $u->nama_lengkap }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Akun">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MODAL EDIT USER -->
                            <div class="modal fade" id="editUserModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                                        <div class="modal-header bg-primary text-white" style="border-radius: 12px 12px 0 0; border-bottom: 4px solid #2563eb;">
                                            <h5 class="modal-title fw-bold"><i class="fas fa-user-edit me-2"></i> Edit Pengguna</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <form action="/internal/kelola-user/update/{{ $u->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body p-4 text-start">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" style="font-size: 13px;">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $u->nama_lengkap }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" style="font-size: 13px;">NIP / Nomor Kepegawaian</label>
                                                    <input type="text" name="nomor_pegawai" class="form-control" value="{{ $u->nomor_pegawai }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" style="font-size: 13px;">Alamat Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $u->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" style="font-size: 13px;">Pilih Hak Akses (Role)</label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="user" {{ $u->role == 'user' ? 'selected' : '' }}>User (Pegawai Internal Terintegrasi)</option>
                                                        <option value="operator" {{ $u->role == 'operator' ? 'selected' : '' }}>Operator (Manajemen Berita & Redkar)</option>
                                                        <option value="super_user" {{ $u->role == 'super_user' ? 'selected' : '' }}>Super User (Admin Penuh)</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label fw-semibold" style="font-size: 13px;">Password Baru (Opsional)</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                                    <div class="form-text" style="font-size: 11px;">Isi hanya jika ingin mereset password pengguna ini secara paksa.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light" style="border-radius: 0 0 12px 12px;">
                                                <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary fw-bold">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL TAMBAH USER -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header bg-dark text-white" style="border-radius: 12px 12px 0 0; border-bottom: 4px solid #10b981;">
                    <h5 class="modal-title fw-bold"><i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="/internal/kelola-user/tambah" method="POST">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px;">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px;">NIP / Nomor Kepegawaian</label>
                            <input type="text" name="nomor_pegawai" class="form-control" required placeholder="Masukkan NIP">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 13px;">Alamat Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="email@contoh.com">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="font-size: 13px;">Pilih Hak Akses (Role)</label>
                            <select name="role" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Hak Akses --</option>
                                <option value="user">User (Pegawai Internal Terintegrasi)</option>
                                <option value="operator">Operator (Manajemen Berita & Redkar)</option>
                                <option value="super_user">Super User (Admin Penuh)</option>
                            </select>
                        </div>
                        <div class="alert alert-info py-2 mb-0" style="font-size: 13px;">
                            <i class="fas fa-info-circle me-1"></i> Password default akun baru adalah: <strong>Damkar123</strong>
                        </div>
                    </div>
                    <div class="modal-footer bg-light" style="border-radius: 0 0 12px 12px;">
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn fw-bold text-white" style="background-color: #10b981;">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>