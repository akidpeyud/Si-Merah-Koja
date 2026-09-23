<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Fire Drill - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; } 
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; min-height: calc(100vh - 74px); }
        .form-wrapper { background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 30px; margin-top: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 15px; }
        .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 8px; }
        .form-control { border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 15px; font-size: 14px; color: #334155; }
        .section-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 15px; margin-top: 25px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 8px; }
        .section-title.first { margin-top: 0; }
        .btn-save { background-color: #0d6efd; color: white; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; border: none; }
        .btn-cancel { background-color: white; color: #475569; border: 1px solid #cbd5e1; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>

    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah" onerror="this.style.display='none'">
            <span class="title">SIMERAH KOJA</span>
        </a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <main class="main-content">
                <a href="javascript:history.back()" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Data Fire Drill
                </a>

                <h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Form Tambah Data Fire Drill</h1>

                <div class="form-wrapper">
                    <form action="{{ route('fire_drill.store') }}" method="POST">
                        @csrf
                        
                        <div class="section-title text-primary first"><i class="fas fa-fire-extinguisher"></i> Informasi Pelaksanaan Fire Drill</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Instansi</label>
                                <input type="text" class="form-control" name="nama_instansi" placeholder="Contoh: PT. PLN UPT Jambi" required>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Tahun</label>
                                <input type="number" class="form-control" name="tahun" placeholder="Contoh: 2026" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Tanggal Pelaksanaan</label>
                                <input type="text" class="form-control" name="tanggal_pelaksanaan" placeholder="Contoh: 3 & 4 Februari 2026" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Tempat Pelaksanaan</label>
                                <input type="text" class="form-control" name="tempat_pelaksanaan" placeholder="Contoh: Aula PLN UPT Jambi" required>
                            </div>
                        </div>

                        <div class="section-title text-success"><i class="fas fa-users"></i> Jumlah Peserta</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Peserta Laki-laki</label>
                                <input type="number" class="form-control" name="peserta_laki_laki" value="0" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Peserta Perempuan</label>
                                <input type="number" class="form-control" name="peserta_perempuan" value="0" min="0" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
                            <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                            <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Simpan Data Fire Drill</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>