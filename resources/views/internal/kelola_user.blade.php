<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - SIMERAH KOJA</title>

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
        #globalSuccessAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

        /* --- NAVBAR & SIDEBAR --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }
        .badge-role.pencegahan { background: #3b82f6; }
        .badge-role.pemadaman { background: #ef4444; }
        .badge-role.sapra { background: #f59e0b; }
        .badge-role.operator { background: #8b5cf6; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; }

        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; padding-left: 15px; border-top: 1px dashed #e5e7eb; padding-top: 15px; }

        /* --- HALAMAN KELOLA USER --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 30px; }

        .content-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .table th { background-color: #f8fafc; color: #4b5563; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; padding: 15px; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: 15px; vertical-align: middle; font-size: 14px; color: #1f2937; border-bottom: 1px solid #e5e7eb; }
        
        .btn-add { background-color: #10b981; color: white; font-weight: 700; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; transition: 0.2s; }
        .btn-add:hover { background-color: #059669; color: white; }

        .alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 12px 15px; border-radius: 8px; font-size: 13px; font-weight: 500; margin-bottom: 20px; }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert()"><i class="fas fa-times"></i></button>
        </div>
        <script>
            function closeAlert() {
                let alertBox = document.getElementById('globalSuccessAlert');
                if(alertBox) { alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards'; setTimeout(() => alertBox.remove(), 400); }
            }
            setTimeout(closeAlert, 4000);
        </script>
    @endif
    <!-- ALERT ERROR GLOBAL -->
    @if(session('error'))
        <div id="globalErrorAlert" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #ef4444; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <i class="fas fa-exclamation-triangle alert-icon" style="font-size: 22px;"></i>
            <span>{{ session('error') }}</span>
            <button class="btn-close-alert" onclick="closeErrorAlert()" style="background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; cursor: pointer;"><i class="fas fa-times"></i></button>
        </div>
        
        <script>
            function closeErrorAlert() {
                let errorBox = document.getElementById('globalErrorAlert');
                if(errorBox) {
                    errorBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                    setTimeout(() => errorBox.remove(), 400); 
                }
            }
            setTimeout(closeErrorAlert, 4000);
        </script>
    @endif

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="/internal/index" class="nav-brand">
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

    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'pencegahan' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
            @endif

            @if(Auth::user()->role === 'pemadaman' || Auth::user()->role === 'super_user')
                <div class="sidebar-title" style="{{ Auth::user()->role === 'super_user' ? '' : 'border-top: none;' }}">Bagian Pemadaman & Penyelamatan</div>
                <a href="#" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Laporan Darurat Masuk</a>
                <a href="#" class="sidebar-item"><i class="fas fa-users-cog"></i> Jadwal Piket Regu</a>
                <a href="#" class="sidebar-item"><i class="fas fa-running"></i> Data Relawan Redkar</a>
            @endif

            @if(Auth::user()->role === 'sapra' || Auth::user()->role === 'super_user')
                <div class="sidebar-title" style="{{ Auth::user()->role === 'super_user' ? '' : 'border-top: none;' }}">Bagian Sapra</div>
                <a href="#" class="sidebar-item"><i class="fas fa-truck-monster"></i> Kelola Armada Mobil</a>
                <a href="#" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
                <a href="#" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item">
                <i class="fas fa-user-edit"></i> Profil Saya
            </a>
            
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item active">
                    <i class="fas fa-users"></i> Kelola Semua Pengguna
                </a>
            @endif
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="page-header mb-0">
                    <h1>Kelola Pengguna</h1>
                    <p class="mb-0">Manajemen akses dan daftar anggota internal SIMERAH KOJA.</p>
                </div>
                <!-- Tombol Buka Modal Tambah User -->
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus me-2"></i>Tambah User Baru
                </button>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle me-2"></i> <strong>Gagal menambahkan user:</strong>
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
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIP / No Pegawai</th>
                                <th>Email</th>
                                <th>Divisi / Role</th>
                                <th class="text-center">Aksi</th>
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
                                        {{ ucwords(str_replace('_', ' ', $u->role)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <!-- Tombol Edit dengan memanggil data user terkait -->
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit Data" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editUserModal{{ $u->id }}" data-id="{{ $u->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus Akun"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL TAMBAH USER -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header bg-dark text-white" style="border-radius: 12px 12px 0 0; border-bottom: 4px solid #10b981;">
                    <h5 class="modal-title fw-bold" id="addUserModalLabel"><i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="/internal/kelola-user/tambah" method="POST">
                    @csrf
                    <div class="modal-body p-4">
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
                            <label class="form-label fw-semibold" style="font-size: 13px;">Pilih Divisi / Role</label>
                            <select name="role" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Hak Akses --</option>
                                <option value="pencegahan">Bagian Pencegahan</option>
                                <option value="pemadaman">Bagian Pemadaman & Penyelamatan (Damtan)</option>
                                <option value="sapra">Bagian Sapra</option>
                                <option value="operator">Operator (Input Berita)</option>
                                <option value="super_user">Super User (Admin Penuh)</option>
                            </select>
                        </div>
                        <div class="alert alert-info py-2" style="font-size: 13px;">
                            <i class="fas fa-info-circle me-1"></i> Password default akun baru adalah: <strong>Damkar123</strong>
                        </div>
                    </div>
                    <div class="modal-footer bg-light" style="border-radius: 0 0 12px 12px;">
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn" style="background-color: #10b981; color: white; font-weight: 700;">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL EDIT USER (Diloop berdasarkan data user) -->
    @foreach($users as $u)
    <div class="modal fade" id="editUserModal{{ $u->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $u->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header bg-primary text-white" style="border-radius: 12px 12px 0 0; border-bottom: 4px solid #3b82f6;">
                    <h5 class="modal-title fw-bold" id="editUserModalLabel{{ $u->id }}"><i class="fas fa-user-edit me-2"></i> Edit Pengguna: {{ $u->nama_lengkap }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="/internal/kelola-user/update/{{ $u->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
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
                            <label class="form-label fw-semibold" style="font-size: 13px;">Pilih Divisi / Role</label>
                            <select name="role" class="form-select" required>
                                <option value="pencegahan" {{ $u->role == 'pencegahan' ? 'selected' : '' }}>Bagian Pencegahan</option>
                                <option value="pemadaman" {{ $u->role == 'pemadaman' ? 'selected' : '' }}>Bagian Pemadaman & Penyelamatan (Damtan)</option>
                                <option value="sapra" {{ $u->role == 'sapra' ? 'selected' : '' }}>Bagian Sapra</option>
                                <option value="super_user" {{ $u->role == 'operator' ? 'selected' : '' }}>Operator Berita</option>
                                <option value="super_user" {{ $u->role == 'super_user' ? 'selected' : '' }}>Super User (Admin Penuh)</option>
                            </select>
                        </div>
                        <div class="mb-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>