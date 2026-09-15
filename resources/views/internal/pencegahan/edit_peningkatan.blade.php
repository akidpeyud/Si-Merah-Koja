<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peningkatan Kapasitas - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; font-weight: 800; font-size: 18px; }
        .user-menu { display: flex; align-items: center; gap: 20px; color: white; font-weight: 600; font-size: 14px;}
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; gap: 5px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 10px; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; border-left: 4px solid #2563eb; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 20px 0 10px 10px; }
        .main-content { flex: 1; padding: 40px; }
        .form-card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; padding: 35px; margin-top: 25px; }
        .form-label { font-weight: 700; color: #2563eb; font-size: 14px; margin-bottom: 8px; }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #cbd5e1; padding: 12px 15px; font-size: 14px; background-color: #f8fafc; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">SIMERAH KOJA</a>
        <div class="user-menu">
            <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }} <i class="fas fa-user-circle ms-2" style="font-size: 22px;"></i></span>
        </div>
    </nav>
    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <div class="sidebar-title">Bagian Pencegahan</div>
            <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan</a>
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item active"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
            <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users"></i> Kelola Redkar</a>
            
            <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
            <a href="#" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
            <a href="#" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
            
            <div class="sidebar-title">Bagian Sapra</div>
            <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-truck"></i> Kelola Armada Mobil</a>
            <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
            <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-boxes"></i> Logistik & Gudang</a>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="text-decoration-none text-muted fw-bold"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                <h2 class="mt-2 fw-bold text-dark">Edit Data Peningkatan Kapasitas</h2>
            </div>

            <div class="form-card">
                <form action="/internal/pencegahan/peningkatan-kapasitas/edit/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-award me-2"></i>Nama Kegiatan / Diklat</label>
                            <input type="text" class="form-control" name="nama_kegiatan" value="{{ $data->nama_kegiatan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-building me-2"></i>Lembaga Penyelenggara</label>
                            <input type="text" class="form-control" name="penyelenggara" value="{{ $data->penyelenggara }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-calendar-plus me-2"></i>Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai" value="{{ $data->tanggal_mulai }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-calendar-check me-2"></i>Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai" value="{{ $data->tanggal_selesai }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-tags me-2"></i>Jenis Kegiatan</label>
                            <select class="form-select" name="jenis_kegiatan" required>
                                <option value="Diklat Teknis" {{ $data->jenis_kegiatan == 'Diklat Teknis' ? 'selected' : '' }}>Diklat Teknis</option>
                                <option value="Bimbingan Teknis (Bimtek)" {{ $data->jenis_kegiatan == 'Bimbingan Teknis (Bimtek)' ? 'selected' : '' }}>Bimbingan Teknis (Bimtek)</option>
                                <option value="Sertifikasi" {{ $data->jenis_kegiatan == 'Sertifikasi' ? 'selected' : '' }}>Sertifikasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-users me-2"></i>Jumlah Pegawai yang Diutus</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="jumlah_pegawai" value="{{ $data->jumlah_pegawai }}" required>
                                <span class="input-group-text bg-light">Orang</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 p-4" style="border: 2px dashed #cbd5e1; border-radius: 12px; background-color: #f8fafc;">
                        <label class="form-label text-danger"><i class="fas fa-file-pdf me-2"></i>Surat Tugas / Dokumen (Opsional)</label>
                        <input class="form-control bg-white" type="file" name="dokumen_terkait">
                        @if(isset($data->dokumen_terkait) && $data->dokumen_terkait)
                            <small class="text-success fw-bold mt-2 d-block"><i class="fas fa-check-circle me-1"></i> File: {{ $data->dokumen_terkait }}</small>
                        @endif
                    </div>
                    <div class="mb-5">
                        <label class="form-label"><i class="fas fa-sticky-note me-2"></i>Catatan Tambahan</label>
                        <textarea class="form-control" name="catatan" rows="3">{{ $data->catatan }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-3 pt-3" style="border-top: 1px solid #e2e8f0;">
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="btn btn-light fw-bold px-4 py-2">Batal</a>
                        <button type="submit" class="btn btn-primary fw-bold px-4 py-2"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>