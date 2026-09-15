<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembinaan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
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
        
        .form-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; padding: 35px; margin-top: 25px; }
        .form-label { font-weight: 700; color: #334155; font-size: 14px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #cbd5e1; padding: 12px 15px; font-size: 14px; background-color: #f8fafc; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: #3b82f6; background-color: white; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        
        input[type=file]::file-selector-button { background-color: #e2e8f0; border: none; padding: 8px 15px; border-radius: 6px; font-weight: 600; color: #475569; cursor: pointer; margin-right: 15px; transition: all 0.2s; }
        input[type=file]::file-selector-button:hover { background-color: #cbd5e1; color: #0f172a; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <span class="title">SIMERAH KOJA </span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}</span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="btn btn-outline-light btn-sm" style="border-radius: 8px; font-weight: 600;">Kembali</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>

            <div class="sidebar-title">Bagian Pencegahan</div>
            <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
            
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item active"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
            
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
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
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="text-decoration-none" style="color: #64748b; font-size: 14px; font-weight: 600;"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Pembinaan</a>
                <h1 class="mt-2">Edit Data Pembinaan & Pengembangan</h1>
            </div>

            <div class="form-card">
                <form action="/internal/pencegahan/pembinaan-pengembangan/edit/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-chart-line me-2"></i>Nama Kegiatan</label>
                            <input type="text" class="form-control p-2" name="nama_program" value="{{ $data->nama_program }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-map-marker-alt me-2"></i>Lokasi Pelaksanaan</label>
                            <input type="text" class="form-control p-2" name="lokasi" value="{{ $data->lokasi }}" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-calendar-alt me-2"></i>Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control p-2" name="tanggal_pelaksanaan" value="{{ $data->tanggal_pelaksanaan }}" required>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-clock me-2"></i>Waktu Mulai</label>
                            <input type="time" class="form-control p-2" name="waktu_mulai" value="{{ $data->waktu_mulai }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-hourglass-end me-2"></i>Waktu Selesai</label>
                            <input type="time" class="form-control p-2" name="waktu_selesai" value="{{ $data->waktu_selesai }}" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                           <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-users me-2"></i>Sasaran / Kategori Peserta</label>
                           <input type="text" class="form-control p-2" name="sasaran_pembinaan" value="{{ $data->sasaran_pembinaan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-user-friends me-2"></i>Jumlah Peserta</label>
                            <div class="input-group">
                                <input type="number" class="form-control p-2" name="target_peserta" value="{{ $data->target_peserta }}" required>
                                <span class="input-group-text bg-light">Orang</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 p-4" style="border: 2px dashed #cbd5e1; border-radius: 12px; background-color: #f8fafc;">
                        <label class="form-label" style="font-weight: 700; color: #dc2626;"><i class="fas fa-file-pdf me-2"></i>Dokumen Pendukung (Opsional)</label>
                        <input class="form-control bg-white" type="file" name="dokumen_pendukung">
                        
                        @if(isset($data->dokumen_pendukung) && $data->dokumen_pendukung)
                            <div class="mt-3 p-2 bg-white rounded border border-success d-inline-block">
                                <small class="text-success" style="font-weight: 600;"><i class="fas fa-check-circle me-1"></i> File tersimpan: {{ $data->dokumen_pendukung }}</small>
                            </div>
                        @endif
                        <small class="text-muted d-block mt-2"><i class="fas fa-info-circle me-1"></i> Upload file foto kegiatan atau laporan. Format: PDF, JPG, PNG (Maks. 5MB).</small>
                    </div>

                    <div class="mb-5">
                        <label class="form-label" style="font-weight: 700; color: #2563eb;"><i class="fas fa-sticky-note me-2"></i>Catatan Tambahan (Opsional)</label>
                        <textarea class="form-control p-3" name="catatan" rows="3">{{ $data->catatan }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 pt-3" style="border-top: 1px solid #e2e8f0;">
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="btn btn-light px-4 py-2" style="border-radius: 8px; font-weight: 600; border: 1px solid #cbd5e1;">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 600; background-color: #2563eb;">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>