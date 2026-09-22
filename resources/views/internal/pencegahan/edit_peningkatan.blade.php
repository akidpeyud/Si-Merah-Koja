<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Peningkatan Kapasitas - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }
        
        /* Navbar & Sidebar (Sama persis dengan halaman index) */
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
        .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }
        
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        
        /* Form Styles */
        .form-card { background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        .form-section-title { font-size: 14px; font-weight: 800; color: #0284c7; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px dashed #e2e8f0; }
        .form-label { font-weight: 600; font-size: 13px; color: #4b5563; }
        .form-control, .form-select { font-size: 14px; padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; }
        .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); background-color: #ffffff; }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span>{{ Auth::user()?->nama_lengkap ?? 'M Ariffan Hidayah' }}</span>
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
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>
            
            <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                <span>Bagian Pencegahan</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item active" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                        PENINGKATAN KAPASITAS APARATUR
                    </a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                        PENCEGAHAN KEBAKARAN DAN INSPEKSI
                    </a>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="text-decoration-none text-muted fw-bold" style="font-size: 14px;">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Data Peningkatan
                    </a>
                    <h1 class="fw-bolder text-dark mt-2 mb-0" style="font-size: 24px;">Form Edit Peningkatan Kapasitas</h1>
                </div>
            </div>

            <div class="form-card">
                <!-- FORM ACTION MENGARAH KE RUTE EDIT -->
                <form action="/internal/pencegahan/peningkatan-kapasitas/edit/{{ $jenis }}/{{ $data->id }}" method="POST">
                    @csrf
                    
                    <!-- SECTION 1: DATA PEGAWAI -->
                    <div class="form-section-title"><i class="fas fa-user me-2"></i> Data Pegawai / Aparatur</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="{{ $data->nama ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" name="nik" value="{{ $data->nik ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" value="{{ $data->tgl_lahir ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="{{ $data->jabatan ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instansi / Perangkat Daerah</label>
                            <input type="text" class="form-control" name="instansi" value="{{ $data->instansi ?? '' }}">
                        </div>
                    </div>

                    <!-- SECTION 2: DETAIL DIKLAT -->
                    <div class="form-section-title"><i class="fas fa-certificate me-2"></i> Detail Diklat & Penyelenggara</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Diklat</label>
                            <!-- Dropdown ini diset nilainya sesuai data lama -->
                            <select class="form-select" name="jenis_diklat" required>
                                @php $jd = strtoupper($data->jenis_diklat ?? ''); @endphp
                                <option value="DIKSAR" {{ $jd == 'DIKSAR' ? 'selected' : '' }}>DIKSAR</option>
                                <option value="DIKLAT F1" {{ $jd == 'DIKLAT F1' ? 'selected' : '' }}>DIKLAT F1</option>
                                <option value="DIKLAT F2" {{ $jd == 'DIKLAT F2' ? 'selected' : '' }}>DIKLAT F2</option>
                                <option value="DIKLAT RESCUE" {{ $jd == 'DIKLAT RESCUE' ? 'selected' : '' }}>DIKLAT RESCUE</option>
                                <option value="DIKLAT MFR" {{ $jd == 'DIKLAT MFR' ? 'selected' : '' }}>DIKLAT MFR</option>
                                <option value="DIKLAT OPERATOR" {{ $jd == 'DIKLAT OPERATOR' ? 'selected' : '' }}>DIKLAT OPERATOR</option>
                                <option value="DIKLAT INSPEKTUR" {{ $jd == 'DIKLAT INSPEKTUR' ? 'selected' : '' }}>DIKLAT INSPEKTUR</option>
                                <option value="DIKLAT PPL" {{ $jd == 'DIKLAT PPL' ? 'selected' : '' }}>DIKLAT PPL</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instansi Penyelenggara</label>
                            <input type="text" class="form-control" name="instansi_penyelenggara" value="{{ $data->instansi_penyelenggara ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" value="{{ $data->provinsi ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota / Kabupaten</label>
                            <input type="text" class="form-control" name="kota" value="{{ $data->kota ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" name="tanggal_pelaksanaan" value="{{ $data->tanggal_pelaksanaan ?? '' }}">
                        </div>
                    </div>

                    <!-- SECTION 3: SERTIFIKASI & PENILAIAN -->
                    <div class="form-section-title"><i class="fas fa-award me-2" style="color: #f59e0b;"></i> Sertifikasi & Penilaian</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Nomor Sertifikat</label>
                            <input type="text" class="form-control" name="nomor_sertifikat" value="{{ $data->nomor_sertifikat ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ditanda Tangani Oleh</label>
                            <input type="text" class="form-control" name="ditandatangani_oleh" value="{{ $data->ditandatangani_oleh ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jumlah Jam Pelajaran (JP)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="jumlah_jam_pelajaran" value="{{ $data->jumlah_jam_pelajaran ?? '' }}">
                                <span class="input-group-text bg-white">JP</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kode Verifikasi</label>
                            <input type="text" class="form-control" name="kode_verifikasi" value="{{ $data->kode_verifikasi ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Persentasi Penilaian</label>
                            <input type="text" class="form-control" name="persentasi_penilaian" value="{{ $data->persentasi_penilaian ?? '' }}">
                        </div>
                    </div>

                    <!-- SECTION 4: INFORMASI TAMBAHAN -->
                    <div class="form-section-title"><i class="fas fa-info-circle me-2" style="color: #64748b;"></i> Informasi Tambahan</div>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label">Catatan Tambahan (Ket)</label>
                            <textarea class="form-control" name="ket" rows="3">{{ $data->ket ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="btn btn-light border px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn text-white px-5 fw-bold" style="background-color: #0284c7;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>