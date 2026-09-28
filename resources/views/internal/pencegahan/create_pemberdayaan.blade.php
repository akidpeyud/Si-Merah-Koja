<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pemberdayaan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1f2937; }

        /* NAVBAR */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; } 
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        /* MAIN AREA (Tanpa Sidebar seperti di foto) */
        .main-content { padding: 40px 50px; max-width: 1400px; margin: 0 auto; }
        
        /* FORM STYLING KHUSUS */
        .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; transition: color 0.2s; display: inline-flex; align-items: center; gap: 8px; }
        .back-link:hover { color: #0f172a; }
        
        .page-title { font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 15px; margin-bottom: 25px; }
        
        .custom-card { background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 35px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        
        .section-header { font-size: 15px; font-weight: 700; display: flex; align-items: center; gap: 10px; padding-bottom: 12px; border-bottom: 1px dashed #cbd5e1; margin-bottom: 20px; margin-top: 10px; }
        .section-header.blue { color: #2563eb; }
        .section-header.green { color: #10b981; }
        .section-header.gray { color: #64748b; }

        .form-label { font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px; }
        .form-control { font-size: 14px; padding: 12px 15px; border-radius: 6px; border: 1px solid #cbd5e1; color: #334155; }
        .form-control::placeholder { color: #94a3b8; }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        
        .btn-cancel { background-color: #ffffff; color: #475569; border: 1px solid #cbd5e1; font-weight: 600; font-size: 14px; padding: 10px 24px; border-radius: 6px; }
        .btn-cancel:hover { background-color: #f8fafc; color: #0f172a; }
        .btn-submit { background-color: #2563eb; color: #ffffff; border: none; font-weight: 600; font-size: 14px; padding: 10px 24px; border-radius: 6px; display: inline-flex; align-items: center; gap: 8px; }
        .btn-submit:hover { background-color: #1d4ed8; color: white; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
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

    <!-- MAIN CONTENT (Sesuai Foto Pertama, Tanpa Sidebar) -->
    <main class="main-content">
        
        <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Sosialisasi
        </a>
        
        <h1 class="page-title">Form Tambah Data Sosialisasi & Edukasi</h1>

        <div class="custom-card">
            <form action="/internal/pencegahan/pemberdayaan-masyarakat/store" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- SECTION 1: INFORMASI PELAKSANAAN -->
                <div class="section-header blue">
                    <i class="fas fa-bullhorn"></i> Informasi Pelaksanaan Sosialisasi
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Posyandu</label>
                        <input type="text" name="posyandu" class="form-control" placeholder="Contoh: Posyandu Beringin (Boleh dikosongkan)">
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label">RT</label>
                        <input type="text" name="rt" class="form-control" placeholder="Contoh: 03, 12, 14" required>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control" placeholder="Contoh: Rawasari" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" placeholder="Contoh: Alam Barajo" required>
                    </div>
                </div>

                <!-- SECTION 2: JUMLAH PESERTA -->
                <div class="section-header green">
                    <i class="fas fa-users"></i> Jumlah Peserta
                </div>

                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label">Peserta Laki-laki</label>
                        <input type="number" name="jumlah_peserta_laki_laki" class="form-control" value="0" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Peserta Perempuan</label>
                        <input type="number" name="jumlah_peserta_perempuan" class="form-control" value="0" min="0" required>
                    </div>
                </div>

                <!-- SECTION 3: DOKUMENTASI -->
                <div class="section-header gray">
                    <i class="fas fa-camera"></i> Dokumentasi
                </div>

                <div class="row mb-5">
                    <div class="col-md-12">
                        <label class="form-label">Foto / Video Dokumentasi (Opsional)</label>
                        <input type="file" name="file_dokumentasi" class="form-control" accept="image/*,video/*,.pdf,.zip">
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="d-flex justify-content-end gap-3 mt-2">
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> Simpan Data Sosialisasi
                    </button>
                </div>
            </form>
        </div>

    </main>

</body>
</html>