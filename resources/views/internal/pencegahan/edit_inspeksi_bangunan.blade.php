<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inspeksi Bangunan - SIMERAH KOJA</title>

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

        /* MAIN AREA & FORM WRAPPER */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; min-height: calc(100vh - 74px); }
        
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
        .form-control { border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 15px; font-size: 14px; color: #334155; }
        .form-control:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
        .form-control[type="file"] { padding: 8px 15px; }
        
        .section-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 15px; margin-top: 25px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 8px; }
        .section-title.first { margin-top: 0; }
        
        .upload-group { background-color: #f8fafc; border: 1px dashed #cbd5e1; padding: 20px; border-radius: 8px; margin-bottom: 15px; }
        
        .btn-save { background-color: #ffc107; color: #000; padding: 10px 24px; font-weight: 700; font-size: 14px; border-radius: 6px; border: none; transition: background-color 0.2s; }
        .btn-save:hover { background-color: #ffb300; }
        .btn-cancel { background-color: white; color: #475569; border: 1px solid #cbd5e1; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; text-decoration: none; transition: all 0.2s; }
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
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <main class="main-content">
                
                <a href="javascript:history.back()" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Data Inspeksi Bangunan
                </a>

                <h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Form Edit Inspeksi Bangunan</h1>

                <div class="form-wrapper">
                    <!-- Menggunakan Method PUT dan enctype untuk upload file -->
                    <form action="{{ route('inspeksi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- SECTION 1: DATA BANGUNAN -->
                        <div class="section-title text-primary first"><i class="fas fa-building"></i> Informasi Bangunan & Usaha</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Nama Tempat</label>
                                <input type="text" class="form-control" name="nama_tempat" value="{{ $item->nama_tempat }}" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Jenis Usaha</label>
                                <input type="text" class="form-control" name="jenis_usaha" value="{{ $item->jenis_usaha }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Tanggal Inspeksi</label>
                                <input type="date" class="form-control" name="tanggal_inspeksi" value="{{ $item->tanggal_inspeksi }}" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan alamat lengkap lokasi...">{{ $item->alamat ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- SECTION 2: DOKUMEN UPLOAD 1 SAMPAI 5 -->
                        <div class="section-title text-success"><i class="fas fa-file-upload"></i> Upload Dokumen Inspeksi</div>
                        
                        <div class="upload-group">
                            <div class="row g-4">
                                <!-- 1. Surat Perintah Tugas -->
                                <div class="col-md-6">
                                    <label class="form-label">1. Surat Perintah Tugas</label>
                                    <input class="form-control" type="file" name="surat_perintah_tugas" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                                </div>

                                <!-- 2. Berita Acara -->
                                <div class="col-md-6">
                                    <label class="form-label">2. Berita Acara</label>
                                    <input class="form-control" type="file" name="berita_acara" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                                </div>

                                <!-- 3. Hasil Penilaian -->
                                <div class="col-md-6">
                                    <label class="form-label">3. Hasil Penilaian</label>
                                    <input class="form-control" type="file" name="hasil_penilaian" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                                </div>

                                <!-- 4. Rekomendasi -->
                                <div class="col-md-6">
                                    <label class="form-label">4. Rekomendasi</label>
                                    <input class="form-control" type="file" name="rekomendasi" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                               - </div>

                                <!-- 5. SKK -->
                                <div class="col-md-12">
                                    <label class="form-label">5. SKK (Sertifikat Keselamatan Kebakaran)</label>
                                    <input class="form-control" type="file" name="skk" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL UPDATE -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
                            <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                            <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Update Perubahan</button>
                        </div>

                    </form>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>