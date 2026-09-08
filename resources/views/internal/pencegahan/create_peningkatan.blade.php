<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peningkatan Kapasitas - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 0.5px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 4px 8px; border-radius: 6px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 12px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #f8fafc; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 22px; color: #94a3b8; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; gap: 5px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 10px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f1f5f9; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; border-left: 4px solid #2563eb; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 20px 0 10px 10px; letter-spacing: 1px; }
        .main-content { flex: 1; padding: 40px; }
        .page-header h1 { font-size: 26px; font-weight: 800; color: #0f172a; }
        
        /* Form Card Styles */
        .form-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; padding: 35px; margin-top: 25px; }
        .form-label { font-weight: 700; color: #334155; font-size: 14px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #cbd5e1; padding: 12px 15px; font-size: 14px; background-color: #f8fafc; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: #3b82f6; background-color: white; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        
        /* File Input Customization */
        input[type=file]::file-selector-button { background-color: #e2e8f0; border: none; padding: 8px 15px; border-radius: 6px; font-weight: 600; color: #475569; cursor: pointer; margin-right: 15px; transition: all 0.2s; }
        input[type=file]::file-selector-button:hover { background-color: #cbd5e1; color: #0f172a; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}</span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="btn btn-outline-light btn-sm" style="border-radius: 8px; font-weight: 600;">Kembali</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>

            <div class="sidebar-title">Bagian Pencegahan</div>
            <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
            
            <!-- ACTIVE DI PENINGKATAN KAPASITAS -->
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item active"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="text-decoration-none" style="color: #64748b; font-size: 14px; font-weight: 600;"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Peningkatan</a>
                <h1 class="mt-2">Form Tambah Peningkatan Kapasitas</h1>
            </div>

            <div class="form-card">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-certificate text-primary"></i> Nama Kegiatan / Diklat</label>
                            <input type="text" class="form-control" name="nama_kegiatan" placeholder="Contoh: Diklat Inspektur Kebakaran Tingkat I" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-university text-primary"></i> Lembaga Penyelenggara / Lokasi</label>
                            <input type="text" class="form-control" name="penyelenggara" placeholder="Contoh: Pusdiklat Damkar Ciracas" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-calendar-alt text-primary"></i> Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-calendar-check text-primary"></i> Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-tags text-primary"></i> Jenis Kegiatan</label>
                            <select class="form-select" name="jenis_kegiatan" required>
                                <option value="" disabled selected>Pilih Jenis...</option>
                                <option value="Diklat Teknis">Diklat Teknis</option>
                                <option value="Bimbingan Teknis (Bimtek)">Bimbingan Teknis (Bimtek)</option>
                                <option value="Sertifikasi Profesi">Sertifikasi Profesi</option>
                                <option value="Seminar / Workshop">Seminar / Workshop</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label"><i class="fas fa-user-tie text-primary"></i> Jumlah Pegawai / Anggota yang Diutus</label>
                            <div class="input-group" style="width: 250px;">
                                <input type="number" class="form-control" name="jumlah_pegawai" min="1" placeholder="Misal: 5" required>
                                <span class="input-group-text" style="background-color: #e2e8f0; border: none; font-weight: 600; color: #475569;">Orang</span>
                            </div>
                        </div>
                    </div>

                    <!-- KOTAK UPLOAD DOKUMEN -->
                    <div class="mb-4 p-4" style="background-color: #f1f5f9; border-radius: 12px; border: 1px dashed #94a3b8;">
                        <label class="form-label mb-2"><i class="fas fa-file-signature text-danger"></i> Surat Tugas / Undangan Diklat (Opsional)</label>
                        <input class="form-control" type="file" name="dokumen_terkait" accept=".pdf, .jpg, .png">
                        <small class="text-muted" style="font-size: 13px; margin-top: 8px; display: block;">
                            <i class="fas fa-info-circle me-1"></i> Upload file Surat Perintah Tugas (SPT) atau Sertifikat kelulusan. Format: PDF, JPG, PNG (Maks. 5MB).
                        </small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-edit text-primary"></i> Catatan Tambahan (Opsional)</label>
                        <textarea class="form-control" name="catatan" rows="3" placeholder="Misal: Biaya ditanggung oleh APBD perubahan tahun 2026..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="btn btn-light px-4 py-2" style="border-radius: 8px; font-weight: 600; border: 1px solid #cbd5e1;">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                            <i class="fas fa-save me-2"></i> Simpan Data Peningkatan
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</body>
</html>