<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }} - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .main-container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .card-box { background: white; border-radius: 12px; padding: 35px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="card-box">
            <h3 class="mb-4 fw-bold text-danger"><i class="fas fa-newspaper me-2"></i> {{ isset($berita) ? 'Edit Berita / Kejadian' : 'Tambah Berita / Kejadian Baru' }}</h3>

            <form action="{{ isset($berita) ? '/internal/operator/kelola-berita/update/' . $berita->id : '/internal/operator/kelola-berita/store' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($berita))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Kejadian</label>
                    <input type="text" class="form-control" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required placeholder="Cth: Evakuasi Pemotongan Cincin">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Kejadian</label>
                        <input type="date" class="form-control" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', $berita->tanggal_kejadian ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Waktu Kejadian</label>
                        <input type="time" class="form-control" name="waktu_kejadian" value="{{ old('waktu_kejadian', $berita->waktu_kejadian ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Lokasi Kejadian</label>
                    <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $berita->lokasi ?? '') }}" required placeholder="Cth: Jl. AR. SALEH lorong. ABDI UTAMA">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Pelapor</label>
                        <input type="text" class="form-control" name="pelapor" value="{{ old('pelapor', $berita->pelapor ?? '') }}" required placeholder="Cth: Warga RT. 07">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sumber Informasi</label>
                        <input type="text" class="form-control" name="sumber_informasi" value="{{ old('sumber_informasi', $berita->sumber_informasi ?? '') }}" required placeholder="Cth: Lainnya (Ke Kantor Mako)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan Singkat (Ringkasan)</label>
                    <textarea class="form-control" name="keterangan_singkat" rows="2" required placeholder="Ringkasan singkat untuk halaman utama...">{{ old('keterangan_singkat', $berita->keterangan_singkat ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Detail Lengkap Berita</label>
                    <textarea class="form-control" name="detail_lengkap" rows="6" required placeholder="Tuliskan kronologi lengkap kejadian di sini...">{{ old('detail_lengkap', $berita->detail_lengkap ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Foto Dokumentasi (Opsional)</label>
                    @if(isset($berita) && $berita->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Preview" style="height: 80px; border-radius: 6px;">
                            <span class="d-block text-muted small">Foto saat ini</span>
                        </div>
                    @endif
                    <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/internal/operator/kelola-berita" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-danger px-4 fw-bold"><i class="fas fa-save me-1"></i> Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>