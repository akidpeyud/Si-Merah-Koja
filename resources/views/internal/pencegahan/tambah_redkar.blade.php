<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Relawan Offline - SIMERAH KOJA</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }
        
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
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* Sidebar Seragam & Sticky */
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

        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; display: flex; flex-direction: column; align-items: center; }
        .page-header { width: 100%; max-width: 950px; margin-bottom: 25px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .content-card { background: white; border-radius: 14px; border: 1px solid #e5e7eb; padding: 35px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04); width: 100%; max-width: 950px; }
        .form-label { font-size: 12px; font-weight: 700; color: #374151; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-control, .form-select { font-size: 13.5px; padding: 11px 15px; border-radius: 8px; border: 1px solid #d1d5db; }
        .form-control:focus, .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
        
        .section-title { font-size: 14px; font-weight: 800; color: #0284c7; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 25px; margin-bottom: 15px; padding-bottom: 8px; border-bottom: 2px solid #e0f2fe; }

        .btn-submit { background-color: #10b981; color: white; font-weight: 700; font-size: 14px; padding: 12px 24px; border: none; border-radius: 8px; width: 100%; transition: 0.2s; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); }
        .btn-submit:hover { background-color: #059669; color: white; }
        .btn-back { background-color: #6b7280; color: white; font-weight: 700; font-size: 14px; padding: 12px 24px; border: none; border-radius: 8px; width: 100%; text-decoration: none; display: inline-block; text-align: center; transition: 0.2s; }
        .btn-back:hover { background-color: #4b5563; color: white; }

        .alert-centered-container { width: 100%; max-width: 950px; display: flex; justify-content: center; margin-bottom: 20px; }
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
        <!-- SIDEBAR SERAGAM DENGAN DASHBOARD UTAMA -->
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
                <h1>Tambah Data Relawan Offline</h1>
                <p>Input data relawan baru yang mendaftar secara langsung melalui kantor.</p>
            </div>

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
                        <h4 class="fw-bold text-dark m-0"><i class="fas fa-user-plus me-2 text-success"></i> Form Input Relawan Offline</h4>
                        <small class="text-muted">Data akan langsung terdaftar di sistem.</small>
                    </div>
                </div>

                <form action="/internal/pencegahan/simpan-redkar-offline" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- AKUN LOGIN -->
                        <div class="col-12"><div class="section-title mt-0">1. Akun Login Relawan</div></div>

                        <div class="col-md-6">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Buat username unik" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password Awal <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" required>
                        </div>

                        <!-- IDENTITAS UTAMA -->
                        <div class="col-12"><div class="section-title">2. Identitas Pribadi</div></div>

                        <div class="col-md-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">NIK (Nomor KTP - 16 Digit) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nik" value="{{ old('nik') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nomor_telp" value="{{ old('nomor_telp') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Agama <span class="text-danger">*</span></label>
                            <select class="form-select" name="agama" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_perkawinan" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>

                        <!-- ALAMAT & WILAYAH -->
                        <div class="col-12"><div class="section-title">3. Alamat & Wilayah Domisili</div></div>

                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">RT / RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="rt_rw" value="{{ old('rt_rw') }}" placeholder="00/00" required>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kode_pos" value="{{ old('kode_pos') }}" required>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select class="form-select" name="kecamatan" id="kecamatan" required>
                                <option value="" disabled selected>Pilih Kecamatan</option>
                                <option value="Alam Barajo">Alam Barajo</option>
                                <option value="Danau Sipin">Danau Sipin</option>
                                <option value="Danau Teluk">Danau Teluk</option>
                                <option value="Jambi Selatan">Jambi Selatan</option>
                                <option value="Jambi Timur">Jambi Timur</option>
                                <option value="Jelutung">Jelutung</option>
                                <option value="Kota Baru">Kota Baru</option>
                                <option value="Paal Merah">Paal Merah</option>
                                <option value="Pasar Jambi">Pasar Jambi</option>
                                <option value="Pelayangan">Pelayangan</option>
                                <option value="Telanaipura">Telanaipura</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <select class="form-select" name="kelurahan" id="kelurahan" required>
                                <option value="" disabled selected>Pilih Kecamatan Dulu</option>
                            </select>
                        </div>

                        <!-- PENDIDIKAN & PEKERJAAN -->
                        <div class="col-12"><div class="section-title">4. Pendidikan & Pekerjaan</div></div>

                        <div class="col-md-6">
                            <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                            <select class="form-select" name="pendidikan_terakhir" required>
                                <option value="" disabled selected>Pilih Pendidikan</option>
                                <option value="SD">SD Sederajat</option>
                                <option value="SMP">SMP Sederajat</option>
                                <option value="SMA">SMA Sederajat</option>
                                <option value="D3">Diploma 3 (D3)</option>
                                <option value="S1">Sarjana (S1)</option>
                                <option value="S2">Magister (S2)</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Latar Belakang Pendidikan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="latar_belakang_pendidikan" value="{{ old('latar_belakang_pendidikan') }}" placeholder="Contoh: Teknik Informatika / Tata Boga" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Pekerjaan <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis_pekerjaan" id="jenis_pekerjaan" required>
                                <option value="" disabled selected>Pilih Pekerjaan</option>
                                <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
                                <option value="PNS / ASN">PNS / ASN</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="Wiraswasta / Pedagang">Wiraswasta / Pedagang</option>
                                <option value="Buruh / Pekerja Lepas">Buruh / Pekerja Lepas</option>
                                <option value="TNI / POLRI">TNI / POLRI</option>
                                <option value="Petani / Nelayan">Petani / Nelayan</option>
                                <option value="Lainnya">Lainnya (Sebutkan)</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="wrapper_pekerjaan_lainnya" style="display: none;">
                            <label class="form-label">Sebutkan Pekerjaan Lainnya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pekerjaan_lainnya" id="pekerjaan_lainnya" placeholder="Tuliskan pekerjaan...">
                        </div>

                        <!-- KESEHATAN & STATUS -->
                        <div class="col-12"><div class="section-title">5. Kesehatan & Status Keanggotaan</div></div>

                        <div class="col-md-6">
                            <label class="form-label">Sehat Jasmani <span class="text-danger">*</span></label>
                            <select class="form-select" name="sehat_jasmani" required>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Golongan Darah <span class="text-danger">*</span></label>
                            <select class="form-select" name="golongan_darah" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                                <option value="Tidak Tahu" selected>Tidak Tahu</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label text-primary">1. Status Akun (Hak Akses Login) <span class="text-danger">*</span></label>
                            <select class="form-select border-primary" name="status_akun" required>
                                <option value="Aktif" selected>Aktif (Diizinkan Login)</option>
                                <option value="Nonaktif">Nonaktif (Diblokir)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label text-success">2. Status Pendaftaran (Seleksi Berkas) <span class="text-danger">*</span></label>
                            <select class="form-select border-success" name="status_pendaftaran" required>
                                <option value="Diterima" selected>Diterima</option>
                                <option value="Pending">Pending (Menunggu)</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="col-12 mt-5">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn-submit"><i class="fas fa-user-plus me-2"></i> Simpan & Daftarkan Relawan</button>
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

        kecamatanSelect.addEventListener('change', function() {
            const kecamatan = this.value;
            kelurahanSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan</option>';
            if (kecamatan && dataWilayah[kecamatan]) {
                dataWilayah[kecamatan].forEach(function(kel) {
                    const option = document.createElement('option');
                    option.value = kel;
                    option.textContent = kel;
                    kelurahanSelect.appendChild(option);
                });
            }
        });

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