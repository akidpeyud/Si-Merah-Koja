<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Diklat - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* NAVBAR */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; } 
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        /* SIDEBAR */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }

        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        /* MAIN AREA & FORM WRAPPER */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        
        .form-wrapper {
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 15px; transition: color 0.2s; }
        .back-link:hover { color: #0f172a; }

        /* Form Customization */
        .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 8px; }
        .form-control, .form-select { border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 15px; font-size: 14px; color: #334155; }
        .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
        .section-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 15px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 8px; }
        
        .btn-save { background-color: #0d6efd; color: white; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; border: none; transition: background-color 0.2s; }
        .btn-save:hover { background-color: #0b5ed7; }
        .btn-cancel { background-color: white; color: #475569; border: 1px solid #cbd5e1; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; transition: all 0.2s; }
        .btn-cancel:hover { background-color: #f1f5f9; color: #0f172a; }
    </style>
</head>
<body>

    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah" onerror="this.style.display='none'">
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
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>

            <!-- ACCORDION PENCEGAHAN -->
            <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                <span>Bagian Pencegahan</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item active" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">PENINGKATAN KAPASITAS APARATUR</a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">PENCEGAHAN KEBAKARAN DAN INSPEKSI</a>
                    <a href="#" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">PEMBERDAYAAN MASYARAKAT DAN DUNIA USAHA</a>
                </div>
            </div>

            <!-- ACCORDION PEMADAMAN & LAINNYA -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman"><span>Bagian Pemadaman</span><i class="fas fa-chevron-down toggle-icon"></i></button>
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra"><span>Bagian Sapra</span><i class="fas fa-chevron-down toggle-icon"></i></button>
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita"><span>Manajemen Berita</span><i class="fas fa-chevron-down toggle-icon"></i></button>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            
            <a href="javascript:history.back()" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Data Diklat
            </a>

            <h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Form Data Diklat Baru</h1>

            <div class="form-wrapper">
                <form action="#" method="POST">
                    @csrf
                    
                    <!-- SECTION 1: DATA PEGAWAI -->
                    <div class="section-title text-primary"><i class="fas fa-user-tie"></i> Data Pegawai / Aparatur</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" name="nik" placeholder="Masukkan 16 digit NIK" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh: Jambi">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" placeholder="Contoh: Danru / Anggota">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Instansi / Perangkat Daerah</label>
                            <input type="text" class="form-control" name="instansi_daerah" placeholder="Contoh: Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi">
                        </div>
                    </div>

                    <!-- SECTION 2: DETAIL DIKLAT -->
                    <div class="section-title text-success"><i class="fas fa-certificate"></i> Detail Sertifikasi & Pelaksanaan</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Jenis Diklat</label>
                            <select class="form-select" name="jenis_diklat" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                <option value="DIKSAR">DIKSAR</option>
                                <option value="DIKLAT F1">DIKLAT F1</option>
                                <option value="DIKLAT F2">DIKLAT F2</option>
                                <option value="DIKLAT RESCUE">DIKLAT RESCUE</option>
                                <option value="DIKLAT MFR">DIKLAT MFR</option>
                                <option value="DIKLAT OPERATOR">DIKLAT OPERATOR</option>
                                <option value="DIKLAT INSPEKTUR">DIKLAT INSPEKTUR</option>
                                <option value="DIKLAT PPL">DIKLAT PPL</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Nomor Sertifikat</label>
                            <input type="text" class="form-control" name="nomor_sertifikat" placeholder="No. 112/DIKLAT-F1/2026">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jumlah Jam (JP)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="jumlah_jp" placeholder="0">
                                <span class="input-group-text bg-light">JP</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Instansi Penyelenggara</label>
                            <input type="text" class="form-control" name="penyelenggara" placeholder="Contoh: PUSDIKLAT DKI Jakarta">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" placeholder="Contoh: DKI Jakarta">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kota / Kabupaten</label>
                            <input type="text" class="form-control" name="kota" placeholder="Contoh: Jakarta Timur">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="text" class="form-control" name="tgl_pelaksanaan" placeholder="Contoh: 12 s/d 28 Agustus 2026">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ditanda Tangani Oleh</label>
                            <input type="text" class="form-control" name="ditanda_tangani" placeholder="Contoh: Kepala Dinas Pemadam Kebakaran">
                        </div>
                    </div>

                    <!-- SECTION 3: INFO TAMBAHAN -->
                    <div class="section-title text-secondary"><i class="fas fa-list-alt"></i> Informasi Tambahan</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Kode Verifikasi (Opsional)</label>
                            <input type="text" class="form-control" name="kode_verifikasi" placeholder="-">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Persentase Penilaian (Opsional)</label>
                            <input type="text" class="form-control" name="persentase_penilaian" placeholder="-">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Keterangan / Catatan Tambahan</label>
                            <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan catatan tambahan jika ada..."></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2 pt-3" style="border-top: 1px dashed #e2e8f0;">
                        <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Simpan Data Diklat</button>
                    </div>

                </form>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>