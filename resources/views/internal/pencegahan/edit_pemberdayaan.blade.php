<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelatihan Keluarga  - SIMERAH KOJA</title>
    
    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* Warna background abu-abu sangat muda */
            color: #334155;
            margin: 0;
            padding: 0;
        }

        /* =======================================
           TOPBAR (Gelap dengan garis hijau)
           ======================================= */
        .topbar {
            background-color: #0f172a;
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 4px solid #10b981; /* Garis hijau di bawah */
        }
        .topbar img {
            height: 32px;
            margin-right: 12px;
        }
        .topbar .brand-text {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: 0.5px;
        }

        /* =======================================
           MAIN CONTENT & TYPOGRAPHY
           ======================================= */
        .main-container {
            max-width: 1140px; /* Lebar container mirip di foto */
            margin: 0 auto;
            padding: 32px 24px 80px;
        }
        .btn-back {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            transition: color 0.2s;
        }
        .btn-back:hover {
            color: #0f172a;
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 24px;
        }

        /* =======================================
           FORM CARD & SECTIONS
           ======================================= */
        .form-card {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .section-heading {
            font-weight: 600;
            font-size: 1.05rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .text-blue { color: #2563eb; } /* Warna ikon biru */
        .text-green { color: #10b981; } /* Warna ikon hijau */
        
        .section-divider {
            border-bottom: 1px dashed #cbd5e1; /* Garis putus-putus */
            margin: 30px 0;
        }

        /* =======================================
           INPUT FIELDS
           ======================================= */
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .form-control {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px 14px;
            font-size: 0.95rem;
            color: #334155;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        /* =======================================
           BUTTONS
           ======================================= */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
        }
        .btn-batal {
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-batal:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }
        .btn-update {
            background-color: #ffb627; /* Warna kuning persis di foto */
            border: none;
            color: #000000;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-update:hover {
            background-color: #f59e0b;
        }
    </style>
</head>
<body>

    <!-- TOPBAR GELAP (Sesuai Foto) -->
    <header class="topbar">
        <img src="/images/simerahkoja.png" alt="Logo">
        <span class="brand-text">SIMERAH KOJA</span>
    </header>

    <!-- MAIN CONTENT -->
    <div class="main-container">
        
        <!-- TOMBOL KEMBALI -->
        <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Sosialisasi
        </a>

        <!-- JUDUL HALAMAN -->
        <h1 class="page-title">Form Edit Pelatihan Keluarga (Goes to RT)</h1>

        <!-- FORM CARD (Kotak Putih) -->
        <div class="form-card">
            <form action="/internal/pencegahan/pemberdayaan-masyarakat/update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- ================= INFORMASI PELAKSANAAN ================= -->
                <div class="section-heading text-blue">
                    <i class="fas fa-map-marker-alt"></i> Informasi Pelaksanaan
                </div>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" name="tanggal_pelaksanaan" value="{{ $data->tanggal_pelaksanaan ? \Carbon\Carbon::parse($data->tanggal_pelaksanaan)->format('Y-m-d') : '' }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" value="{{ $data->kecamatan }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" value="{{ $data->kelurahan }}" required>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">RT</label>
                        <input type="text" class="form-control" name="rt" value="{{ $data->rt }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Posyandu (Opsional)</label>
                        <input type="text" class="form-control" name="posyandu" value="{{ $data->posyandu }}">
                    </div>
                </div>

                <!-- GARIS PEMBATAS PUTUS-PUTUS -->
                <div class="section-divider"></div>

                <!-- ================= JUMLAH PESERTA ================= -->
                <div class="section-heading text-green">
                    <i class="fas fa-users"></i> Jumlah Peserta
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Peserta Perempuan</label>
                        <input type="number" class="form-control" name="peserta_perempuan" value="{{ $data->peserta_perempuan }}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Peserta Laki-laki</label>
                        <input type="number" class="form-control" name="peserta_laki_laki" value="{{ $data->peserta_laki_laki }}" min="0">
                    </div>
                </div>
                
                <div class="section-divider"></div>
                
                <!-- ================= DOKUMENTASI (Tambahan Wajib) ================= -->
                <div class="section-heading text-secondary" style="color: #64748b;">
                    <i class="fas fa-camera"></i> Bukti / Dokumentasi (Opsional)
                </div>
                <div class="row g-4">
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="foto_video" accept="image/*,video/*">
                        @if($data->foto_video)
                            <small class="text-muted mt-2 d-block">
                                File saat ini: <a href="/uploads/pemberdayaan/{{ $data->foto_video }}" target="_blank" class="text-primary">{{ $data->foto_video }}</a>
                            </small>
                        @endif
                    </div>
                </div>

                <!-- ================= TOMBOL ACTION ================= -->
                <div class="action-buttons">
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i> Update Perubahan
                    </button>
                </div>
                
            </form>
        </div>
    </div>

</body>
</html>