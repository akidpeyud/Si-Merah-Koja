<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }} - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

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
            border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: 0.2s;
        }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar {
            width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb;
            padding: 30px 20px; display: flex; flex-direction: column; gap: 8px;
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
        .sidebar-title {
            font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase;
            margin-top: 15px; margin-bottom: 5px; padding-left: 15px; letter-spacing: 1px;
            border-top: 1px dashed #e5e7eb; padding-top: 15px;
        }

        /* --- MAIN AREA & FORM --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-y: auto; }
        
        .form-container { max-width: 900px; margin: 0 auto; }
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }
        
        .btn-custom-secondary { background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-weight: 600; transition: all 0.2s; }
        .btn-custom-secondary:hover { background-color: #e2e8f0; color: #0f172a; }

        .card-box { 
            background: white; border-radius: 12px; padding: 35px; border: 1px solid #e2e8f0; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            border-top: 4px solid #ef4444; 
        }

        .form-label { font-size: 14px; color: #334155; }
        .form-control { border-color: #cbd5e1; border-radius: 8px; padding: 10px 15px; font-size: 14px; }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.1); }
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
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Bagian Pencegahan</div>
                <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>

                <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
                <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-users-cog"></i> Data Laporan</a>

               <div class="sidebar-title">Bagian Sapra</div>
                <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-tint"></i> Data Hidrant</a>
                <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-tools"></i> Data Hidrant Kota Jambi</a>
                <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
                <div class="sidebar-title">Manajemen Berita</div>
                <a href="/internal/operator/kelola-berita" class="sidebar-item active"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
            @endif

            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
            
            @if(Auth::user()->role === 'super_user')
                <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
            @endif
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="form-container">
                
                <div class="page-header">
                    <div>
                        <h1><i class="fas fa-edit text-danger me-2"></i> {{ isset($berita) ? 'Edit Data Kejadian' : 'Tambah Berita Baru' }}</h1>
                        <p>Lengkapi formulir di bawah ini dengan informasi yang valid.</p>
                    </div>
                    <a href="/internal/operator/kelola-berita" class="btn btn-custom-secondary px-4 py-2 rounded-3"><i class="fas fa-arrow-left me-2"></i> Kembali ke Tabel</a>
                </div>

                <!-- Alert Validasi Error -->
                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                        <div class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i> Terdapat kesalahan pengisian form:</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-box">
                    <form action="{{ isset($berita) ? '/internal/operator/kelola-berita/update/' . $berita->id : '/internal/operator/kelola-berita/store' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($berita))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Kejadian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required placeholder="Contoh: Evakuasi Pemotongan Cincin">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Kejadian <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', $berita->tanggal_kejadian ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Waktu Kejadian <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="waktu_kejadian" value="{{ old('waktu_kejadian', $berita->waktu_kejadian ?? '') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi Kejadian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $berita->lokasi ?? '') }}" required placeholder="Contoh: Jl. AR. SALEH lorong. ABDI UTAMA">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Pelapor <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pelapor" value="{{ old('pelapor', $berita->pelapor ?? '') }}" required placeholder="Contoh: Warga RT. 07">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Sumber Informasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="sumber_informasi" value="{{ old('sumber_informasi', $berita->sumber_informasi ?? '') }}" required placeholder="Contoh : Melalui Telepon/ Aplikasi)">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan Singkat (Ringkasan) <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="keterangan_singkat" rows="2" required placeholder="Ringkasan singkat untuk tampilan kartu di halaman utama...">{{ old('keterangan_singkat', $berita->keterangan_singkat ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Detail Lengkap Berita <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="detail_lengkap" rows="6" required placeholder="Tuliskan kronologi lengkap kejadian di sini...">{{ old('detail_lengkap', $berita->detail_lengkap ?? '') }}</textarea>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded border border-dashed">
                            <label class="form-label fw-bold mb-3">Foto Dokumentasi (Opsional)</label>
                            @if(isset($berita) && $berita->gambar)
                                <div class="mb-3 d-flex align-items-center gap-3">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Preview" style="height: 100px; border-radius: 8px; object-fit: cover; border: 2px solid #e2e8f0;">
                                    <span class="text-muted small"><i class="fas fa-info-circle me-1"></i> Foto saat ini. Biarkan kosong jika tidak ingin mengubah foto.</span>
                                </div>
                            @endif
                            <input type="file" class="form-control bg-white" name="gambar" accept=".jpg,.jpeg,.png">
                            <small class="text-muted d-block mt-2">Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        </div>

                        <hr class="mb-4 text-muted">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="/internal/operator/kelola-berita" class="btn btn-light px-4 border fw-bold text-secondary">Batal</a>
                            <button type="submit" class="btn btn-danger px-4 fw-bold"><i class="fas fa-save me-2"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>