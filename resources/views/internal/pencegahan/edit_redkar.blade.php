<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Relawan - SIMERAH KOJA</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }
        
        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert, #globalErrorAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            color: white; padding: 16px 24px; border-radius: 8px; 
            z-index: 99999; display: flex; align-items: center; gap: 12px; 
            font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        
        .btn-close-alert {
            background: transparent; border: none; color: white; opacity: 0.7; 
            font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s;
        }
        .btn-close-alert:hover { opacity: 1; }

        @keyframes slideDownCenter {
            from { transform: translate(-50%, -50px); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }
        @keyframes fadeOutUpCenter {
            from { transform: translate(-50%, 0); opacity: 1; }
            to { transform: translate(-50%, -50px); opacity: 0; }
        }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal {
            background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        
        .btn-logout {
            background-color: #ef4444; color: white; border: none; padding: 8px 20px;
            border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s;
        }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR & ACCORDION STYLES --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); position: relative; }
        .sidebar {
            width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0;
            position: sticky; top: 74px; height: calc(100vh - 74px);
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

        /* --- CONTENT AREA & FORM STYLES --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; display: flex; flex-direction: column; align-items: center; }
        .page-header { width: 100%; max-width: 950px; margin-bottom: 25px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .content-card { background: white; border-radius: 14px; border: 1px solid #e5e7eb; padding: 35px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); width: 100%; max-width: 950px; }
        .form-label { font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control, .form-select { font-size: 14px; padding: 12px 15px; border-radius: 8px; border: 1px solid #d1d5db; background-color: #fdfdfd; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); background-color: #ffffff; }
        
        /* Pemisah Seksi yang Lebih Elegan */
        .section-title { font-size: 15px; font-weight: 800; color: #0369a1; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 35px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e0f2fe; }

        .btn-update { background-color: #3b82f6; color: white; font-weight: 700; font-size: 14px; padding: 14px 24px; border: none; border-radius: 8px; width: 100%; transition: 0.2s; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2); }
        .btn-update:hover { background-color: #2563eb; color: white; transform: translateY(-1px); }
        .btn-back { background-color: #f3f4f6; color: #4b5563; font-weight: 700; font-size: 14px; padding: 14px 24px; border: 1px solid #d1d5db; border-radius: 8px; width: 100%; text-decoration: none; display: inline-block; text-align: center; transition: 0.2s; }
        .btn-back:hover { background-color: #e5e7eb; color: #1f2937; }

        .alert-centered-container { width: 100%; max-width: 950px; display: flex; justify-content: center; margin-bottom: 20px; }
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
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                
                <!-- ACCORDION PENCEGAHAN -->
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

                <!-- ACCORDION PEMADAMAN -->
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

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn {{ Request::is('sapra*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="{{ Request::is('sapra*') ? 'true' : 'false' }}">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse {{ Request::is('sapra*') ? 'show' : '' }}" id="collapseSapra" data-bs-parent="#sidebarAccordion">
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

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="page-header">
                <h1>Edit Data Relawan</h1>
                <p>Perbarui seluruh informasi biodata, wilayah, dan status keanggotaan relawan REDKAR.</p>
            </div>

            <!-- Error Validation Alert -->
            @if($errors->any())
                <div class="alert-centered-container">
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> Periksa kembali isian form Anda:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="content-card">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <div>
                        <h4 class="fw-bold text-dark m-0"><i class="fas fa-user-edit me-2 text-primary"></i> Formulir Perubahan Data</h4>
                        <small class="text-muted">Register ID: {{ $relawan->id }}</small>
                    </div>
                    <span class="badge bg-primary px-3 py-2 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Akun: {{ $relawan->username }}</span>
                </div>

                <form action="/internal/pencegahan/update-redkar/{{ $relawan->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- IDENTITAS UTAMA -->
                        <div class="col-12"><div class="section-title mt-0">1. Identitas Pribadi</div></div>

                        <div class="col-md-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $relawan->nama_lengkap) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">NIK (Nomor KTP - 16 Digit) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nik" value="{{ old('nik', $relawan->nik) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nomor_telp" value="{{ old('nomor_telp', $relawan->nomor_telp) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $relawan->tempat_lahir) }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $relawan->tanggal_lahir) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="Laki-Laki" {{ old('jenis_kelamin', $relawan->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $relawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Agama <span class="text-danger">*</span></label>
                            <select class="form-select" name="agama" required>
                                <option value="Islam" {{ old('agama', $relawan->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $relawan->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $relawan->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $relawan->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $relawan->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $relawan->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_perkawinan" required>
                                <option value="Belum Kawin" {{ old('status_perkawinan', $relawan->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan', $relawan->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan', $relawan->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan', $relawan->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>

                        <!-- ALAMAT & WILAYAH -->
                        <div class="col-12"><div class="section-title">2. Alamat & Wilayah Domisili</div></div>

                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $relawan->alamat) }}</textarea>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">RT / RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="rt_rw" value="{{ old('rt_rw', $relawan->rt_rw) }}" required>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kode_pos" value="{{ old('kode_pos', $relawan->kode_pos) }}" required>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select class="form-select" name="kecamatan" id="kecamatan" required>
                                <option value="" disabled>Pilih Kecamatan</option>
                                <option value="Alam Barajo" {{ old('kecamatan', $relawan->kecamatan) == 'Alam Barajo' ? 'selected' : '' }}>Alam Barajo</option>
                                <option value="Danau Sipin" {{ old('kecamatan', $relawan->kecamatan) == 'Danau Sipin' ? 'selected' : '' }}>Danau Sipin</option>
                                <option value="Danau Teluk" {{ old('kecamatan', $relawan->kecamatan) == 'Danau Teluk' ? 'selected' : '' }}>Danau Teluk</option>
                                <option value="Jambi Selatan" {{ old('kecamatan', $relawan->kecamatan) == 'Jambi Selatan' ? 'selected' : '' }}>Jambi Selatan</option>
                                <option value="Jambi Timur" {{ old('kecamatan', $relawan->kecamatan) == 'Jambi Timur' ? 'selected' : '' }}>Jambi Timur</option>
                                <option value="Jelutung" {{ old('kecamatan', $relawan->kecamatan) == 'Jelutung' ? 'selected' : '' }}>Jelutung</option>
                                <option value="Kota Baru" {{ old('kecamatan', $relawan->kecamatan) == 'Kota Baru' ? 'selected' : '' }}>Kota Baru</option>
                                <option value="Paal Merah" {{ old('kecamatan', $relawan->kecamatan) == 'Paal Merah' ? 'selected' : '' }}>Paal Merah</option>
                                <option value="Pasar Jambi" {{ old('kecamatan', $relawan->kecamatan) == 'Pasar Jambi' ? 'selected' : '' }}>Pasar Jambi</option>
                                <option value="Pelayangan" {{ old('kecamatan', $relawan->kecamatan) == 'Pelayangan' ? 'selected' : '' }}>Pelayangan</option>
                                <option value="Telanaipura" {{ old('kecamatan', $relawan->kecamatan) == 'Telanaipura' ? 'selected' : '' }}>Telanaipura</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <select class="form-select" name="kelurahan" id="kelurahan" required>
                                <option value="{{ $relawan->kelurahan }}" selected>{{ $relawan->kelurahan }} (Tersimpan)</option>
                            </select>
                        </div>

                        <!-- PENDIDIKAN & PEKERJAAN -->
                        <div class="col-12"><div class="section-title">3. Pendidikan & Pekerjaan</div></div>

                        <div class="col-md-6">
                            <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                            <select class="form-select" name="pendidikan_terakhir" required>
                                <option value="SD" {{ old('pendidikan_terakhir', $relawan->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD Sederajat</option>
                                <option value="SMP" {{ old('pendidikan_terakhir', $relawan->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP Sederajat</option>
                                <option value="SMA" {{ old('pendidikan_terakhir', $relawan->pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}>SMA Sederajat</option>
                                <option value="D3" {{ old('pendidikan_terakhir', $relawan->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                <option value="S1" {{ old('pendidikan_terakhir', $relawan->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                <option value="S2" {{ old('pendidikan_terakhir', $relawan->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Latar Belakang Pendidikan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="latar_belakang_pendidikan" value="{{ old('latar_belakang_pendidikan', $relawan->latar_belakang_pendidikan) }}" placeholder="Contoh: Teknik Informatika" required>
                        </div>

                        @php
                            $pekerjaanList = ['Pelajar / Mahasiswa', 'PNS / ASN', 'Karyawan Swasta', 'Wiraswasta / Pedagang', 'Buruh / Pekerja Lepas', 'TNI / POLRI', 'Petani / Nelayan'];
                            $isPekerjaanLain = !in_array($relawan->pekerjaan, $pekerjaanList);
                        @endphp

                        <div class="col-md-6">
                            <label class="form-label">Jenis Pekerjaan <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis_pekerjaan" id="jenis_pekerjaan" required>
                                <option value="" disabled>Pilih Pekerjaan</option>
                                @foreach($pekerjaanList as $job)
                                    <option value="{{ $job }}" {{ (!old('jenis_pekerjaan') && $relawan->pekerjaan == $job) || old('jenis_pekerjaan') == $job ? 'selected' : '' }}>{{ $job }}</option>
                                @endforeach
                                <option value="Lainnya" {{ $isPekerjaanLain || old('jenis_pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya (Sebutkan)</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="wrapper_pekerjaan_lainnya" style="display: {{ $isPekerjaanLain ? 'block' : 'none' }};">
                            <label class="form-label">Sebutkan Pekerjaan Lainnya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pekerjaan_lainnya" id="pekerjaan_lainnya" value="{{ old('pekerjaan_lainnya', $isPekerjaanLain ? $relawan->pekerjaan : '') }}" placeholder="Tuliskan pekerjaan...">
                        </div>

                        <!-- KESEHATAN & VERIFIKASI GANDA (STATUS AKUN & PENDAFTARAN) -->
                        <div class="col-12"><div class="section-title">4. Kesehatan & Verifikasi Status</div></div>

                        <div class="col-md-6">
                            <label class="form-label">Sehat Jasmani <span class="text-danger">*</span></label>
                            <select class="form-select" name="sehat_jasmani" required>
                                <option value="Ya" {{ old('sehat_jasmani', $relawan->sehat_jasmani) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('sehat_jasmani', $relawan->sehat_jasmani) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Golongan Darah <span class="text-danger">*</span></label>
                            <select class="form-select" name="golongan_darah" required>
                                <option value="A" {{ old('golongan_darah', $relawan->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah', $relawan->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah', $relawan->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah', $relawan->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                                <option value="Tidak Tahu" {{ old('golongan_darah', $relawan->golongan_darah) == 'Tidak Tahu' ? 'selected' : '' }}>Tidak Tahu</option>
                            </select>
                        </div>

                        <!-- Status Akun (Hak Akses Login) -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label text-primary">1. Status Akun (Hak Akses Login) <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_akun" style="border-color: #3b82f6; background-color: #f0f9ff;" required>
                                <option value="Aktif" {{ old('status_akun', $relawan->status_akun ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif (Diizinkan Login)</option>
                                <option value="Nonaktif" {{ old('status_akun', $relawan->status_akun ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Diblokir / Belum Boleh Login)</option>
                            </select>
                        </div>

                        <!-- Status Pendaftaran (Seleksi Berkas) -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label text-success">2. Status Pendaftaran (Seleksi Berkas) <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_pendaftaran" style="border-color: #10b981; background-color: #ecfdf5;" required>
                                <option value="Pending" {{ old('status_pendaftaran', $relawan->status_pendaftaran) == 'Pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="Diterima" {{ old('status_pendaftaran', $relawan->status_pendaftaran) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ old('status_pendaftaran', $relawan->status_pendaftaran) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <!-- DOKUMEN PENDUKUNG (FOTO KTP DIPINDAHKAN KE BAWAH) -->
                        <div class="col-12"><div class="section-title">5. Dokumen Pendukung</div></div>

                        <div class="col-12">
                            <label class="form-label">Update Foto / Scan KTP (Opsional)</label>
                            <div class="d-flex align-items-center gap-3 p-3 border rounded bg-light" style="border-style: dashed !important; border-color: #cbd5e1 !important;">
                                <input type="file" class="form-control w-auto flex-grow-1" name="foto_ktp" accept=".jpg, .jpeg, .png">
                                
                                @if($relawan->file_ktp && $relawan->file_ktp !== 'offline_registered')
                                    <div class="d-flex flex-column align-items-center bg-white p-2 rounded border" style="min-width: 120px;">
                                        <span style="font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 4px;">KTP SAAT INI</span>
                                        <a href="/storage/{{ $relawan->file_ktp }}" target="_blank" class="badge bg-info text-decoration-none px-3 py-2 w-100 text-center">
                                            <i class="fas fa-eye me-1"></i> Lihat File
                                        </a>
                                    </div>
                                @else
                                    <div class="d-flex flex-column align-items-center bg-white p-2 rounded border" style="min-width: 120px;">
                                        <span style="font-size: 10px; font-weight: 700; color: #64748b; margin-bottom: 4px;">KTP SAAT INI</span>
                                        <span class="badge bg-secondary px-3 py-2 w-100 text-center">Tidak Ada</span>
                                    </div>
                                @endif
                            </div>
                            <small class="text-muted d-block mt-2"><i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG (Maks. 2MB). <strong>Biarkan kosong jika tidak ingin mengubah KTP saat ini.</strong></small>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="col-12 mt-5">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn-update"><i class="fas fa-save me-2"></i> Simpan Perubahan Data</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="/internal/pencegahan/kelola-redkar" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Batal / Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Interaktif Dropdown Wilayah & Pekerjaan Lainnya -->
    <script>
        const dataWilayah = {
            "Alam Barajo": ["Bagan Pete", "Beliung", "Kenali Besar", "Mayang Mangurai", "Pinang Merah", "Rawa Sari", "Simpang Rimbo"],
            "Danau Sipin": ["Legok", "Murni", "Selamat", "Solok Sipin", "Sungai Putri"],
            "Danau Teluk": ["Olak Kemang", "Pasir Panjang", "Tanjung Pasir", "Tanjung Raden", "Ulu Gedong"],
            "Jambi Selatan": ["Pakuan Baru", "Pasir Putih", "Tambak Sari", "The Hok", "Wijaya Pura"],
            "Jambi Timur": ["Budiman", "Kasang", "Kasang Jaya", "Rajawali", "Sejinjang", "Sulanjana", "Talang Banjar", "Tanjung Pinang", "Tanjung Sari"],
            "Jelutung": ["Cempaka Putih", "Handil Jaya", "Jelutung", "Kebun Handil", "Lebak Bandung", "Payo Lebar", "Talang Jauh"],
            "Kota Baru": ["Kenali Asam", "Kenali Asam Atas", "Kenali Asam Bawah", "Paal Lima", "Simpang Tiga Sipin", "Sukakarya", "Talang Gulo"],
            "Paal Merah": ["Bakung Jaya", "Eka Jaya", "Lingkar Selatan", "Paal Merah", "Payo Selincah", "Talang Bakung"],
            "Pasar Jambi": ["Beringin", "Orang Kayo Hitam", "Pasar Jambi", "Sungai Asam"],
            "Pelayangan": ["Arab Melayu", "Jelmu", "Mudung Laut", "Tahtul Yaman", "Tanjung Johor", "Tengah"],
            "Telanaipura": ["Aur Kenali", "Buluran Kenali", "Pematang Sulur", "Penyengat Rendah", "Simpang Empat Sipin", "Telanaipura", "Teluk Kenali"]
        };

        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');
        const kelurahanTersimpan = "{{ $relawan->kelurahan }}";

        function updateKelurahan(kecamatan, selectedKelurahan = '') {
            kelurahanSelect.innerHTML = '<option value="" disabled>Pilih Kelurahan</option>';
            if (kecamatan && dataWilayah[kecamatan]) {
                dataWilayah[kecamatan].forEach(function(kel) {
                    const option = document.createElement('option');
                    option.value = kel;
                    option.textContent = kel;
                    if (kel === selectedKelurahan) {
                        option.selected = true;
                    }
                    kelurahanSelect.appendChild(option);
                });
            }
        }

        if (kecamatanSelect.value) {
            updateKelurahan(kecamatanSelect.value, kelurahanTersimpan);
        }

        kecamatanSelect.addEventListener('change', function() {
            updateKelurahan(this.value);
        });

        // Logika Dropdown Pekerjaan Lainnya
        const selectPekerjaan = document.getElementById('jenis_pekerjaan');
        const wrapperLainnya = document.getElementById('wrapper_pekerjaan_lainnya');
        const inputLainnya = document.getElementById('pekerjaan_lainnya');

        selectPekerjaan.addEventListener('change', function() {
            if (this.value === 'Lainnya') {
                wrapperLainnya.style.display = 'block';
                inputLainnya.setAttribute('required', 'required');
            } else {
                wrapperLainnya.style.display = 'none';
                inputLainnya.removeAttribute('required');
                inputLainnya.value = '';
            }
        });
    </script>
</body>
</html>