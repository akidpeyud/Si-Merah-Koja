<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Izin Keramaian | SIMERAH KOJA</title>
    <!-- Gunakan link CSS Bootstrap dan FontAwesome bawaan template-mu di sini -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #f5f7fa; font-family: 'Instrument Sans', sans-serif; color: #0d1b2a; }
        .card-custom { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; box-shadow: 0 4px 12px rgba(13, 27, 42, .06); overflow: hidden; }
        .card-header { background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 16px 20px; font-weight: 700; color: #0d2947; }
        .btn-navy { background: #163a63; color: white; border-radius: 8px; font-weight: 600; padding: 10px 20px; border: none; }
        .btn-navy:hover { background: #0d2947; color: white; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-edit text-warning me-2"></i> Edit Data Izin Keramaian</h3>
        <a href="{{ route('internal.izin-keramaian.index') }}" class="btn btn-outline-secondary rounded-pill"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-custom">
        <div class="card-header">Formulir Perbaikan Data</div>
        <div class="card-body p-4">
            <form action="{{ route('internal.izin-keramaian.update', $permohonan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="text-muted fw-bold mb-3">1. Data Pemohon</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Pemohon</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $permohonan->nama) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ old('nik', $permohonan->nik) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">No HP/WA</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $permohonan->no_hp) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $permohonan->alamat) }}" required>
                    </div>
                </div>

                <h6 class="text-muted fw-bold mb-3">2. Data Usaha</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Direktur</label>
                        <input type="text" name="nama_direktur" class="form-control" value="{{ old('nama_direktur', $permohonan->nama_direktur) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $permohonan->nama_usaha) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">No Izin Usaha</label>
                        <input type="text" name="no_izin_usaha" class="form-control" value="{{ old('no_izin_usaha', $permohonan->no_izin_usaha) }}" required>
                    </div>
                </div>

                <h6 class="text-muted fw-bold mb-3">3. Data Acara & Peralatan</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Acara</label>
                        <input type="text" name="nama_acara" class="form-control" value="{{ old('nama_acara', $permohonan->nama_acara) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Acara</label>
                        <input type="text" name="lokasi_acara" class="form-control" value="{{ old('lokasi_acara', $permohonan->lokasi_acara) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tgl Pelaksanaan</label>
                        <input type="date" name="tgl_pelaksanaan" class="form-control" value="{{ old('tgl_pelaksanaan', $permohonan->tgl_pelaksanaan) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', $permohonan->waktu_mulai) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', $permohonan->waktu_selesai) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah Penonton</label>
                        <input type="number" name="jumlah_penonton" class="form-control" value="{{ old('jumlah_penonton', $permohonan->jumlah_penonton) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah APAR</label>
                        <input type="number" name="jumlah_apar" class="form-control" value="{{ old('jumlah_apar', $permohonan->jumlah_apar) }}" min="8" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah Staff</label>
                        <input type="number" name="jumlah_staff" class="form-control" value="{{ old('jumlah_staff', $permohonan->jumlah_staff) }}" min="4" required>
                    </div>
                </div>

                <hr class="mb-4">
                <button type="submit" class="btn-navy w-100"><i class="fas fa-save me-2"></i> Simpan Perubahan Data</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>