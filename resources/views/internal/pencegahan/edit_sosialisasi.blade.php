<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sosialisasi Baru - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; padding-left: 15px; border-top: 1px dashed #e5e7eb; padding-top: 15px; }
        
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header h1 { font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 10px; }
        
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
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    @if(Auth::user()->role === 'user')
                        PEGAWAI
                    @else
                        {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
                    @endif
                </span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="btn btn-outline-light btn-sm" style="border-radius: 8px; font-weight: 600;"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- MODUL OPERASIONAL -->
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item active"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>

                <div class="sidebar-title">Bagian Sapra</div>
                <a href="#" class="sidebar-item"><i class="fas fa-truck-monster"></i> Kelola Armada Mobil</a>
                <a href="#" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
                <a href="#" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            <!-- MODUL OPERATOR BERITA -->
            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita</div>
                <a href="#" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                <a href="/internal/operator/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item">
                <i class="fas fa-user-edit"></i> Profil Saya
            </a>
            
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item">
                    <i class="fas fa-users"></i> Kelola Semua Pengguna
                </a>
            @endif
        </aside>

        <main class="main-content">
            <div class="page-header">
                <a href="/internal/pencegahan/layanan-sosialisasi" class="text-decoration-none" style="color: #64748b; font-size: 14px; font-weight: 600;"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Sosialisasi</a>
                <h1>Edit Jadwal Sosialisasi</h1>
            </div>

            <div class="form-card">
                <form action="/internal/pencegahan/layanan-sosialisasi/tambah" method="POST" enctype="multipart/form-data">
                    
                    <!-- Form Edit Data Sosialisasi -->
            <div class="form-card">
                <form action="/internal/pencegahan/layanan-sosialisasi/edit/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Kegiatan / Judul</label>
                            <input type="text" class="form-control" name="nama_kegiatan" value="{{ $data->nama_kegiatan }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" name="tanggal_pelaksanaan" value="{{ $data->tanggal_pelaksanaan }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jumlah Peserta</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="jumlah_peserta" value="{{ $data->jumlah_peserta }}" required>
                                <span class="input-group-text">Orang</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Lokasi Sosialisasi</label>
                            <!-- Textarea value-nya ditaruh di tengah -->
                            <textarea class="form-control" name="lokasi" rows="2" required>{{ $data->lokasi }}</textarea>
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Sasaran / Kategori Peserta</label>
                           <!-- Ganti name dan value-nya jadi sasaran_peserta -->
                          <input type="text" class="form-control" name="sasaran_peserta" value="{{ $data->sasaran_peserta }}" required>
                         </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Dokumen / Surat Permohonan (Opsional)</label>
                        <input class="form-control" type="file" name="surat_permohonan">
                        
                        <!-- Notif File Lama -->
                        @if(isset($data->surat_permohonan) && $data->surat_permohonan)
                            <small class="text-success mt-2 d-block"><i class="fas fa-check-circle me-1"></i> File saat ini: {{ $data->surat_permohonan }}</small>
                        @endif
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file/foto lama.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan Tambahan (Opsional)</label>
                        <textarea class="form-control" name="catatan" rows="3">{{ $data->catatan }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="btn btn-light px-4 py-2" style="border-radius: 8px; font-weight: 600;">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-save me-2"></i> Update Data Sosialisasi
                        </button>
                    </div>
                </form>
            </div>

                </form>
            </div>
        </main>
    </div>
</body>
</html>