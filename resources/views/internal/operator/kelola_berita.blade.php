<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .main-container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .card-box { background: white; border-radius: 12px; padding: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Manajemen Berita & Kejadian</h2>
                <p class="text-muted mb-0">Kelola data informasi evakuasi dan kebakaran daerah.</p>
            </div>
            <div>
                <a href="/internal/index" class="btn btn-secondary btn-sm me-2"><i class="fas fa-arrow-left me-1"></i> Dashboard</a>
                <a href="/internal/operator/kelola-berita/tambah" class="btn btn-danger btn-sm"><i class="fas fa-plus me-1"></i> Tambah Berita</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul Kejadian</th>
                            <th>Lokasi</th>
                            <th>Pelapor</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita as $b)
                        <tr>
                            <td>{{ $b->tanggal_kejadian }}</td>
                            <td class="fw-bold">{{ $b->judul }}</td>
                            <td>{{ $b->lokasi }}</td>
                            <td>{{ $b->pelapor }}</td>
                            <td class="text-center">
                                <a href="/berita/{{ $b->id }}" target="_blank" class="btn btn-info btn-sm text-white" title="Lihat"><i class="fas fa-eye"></i></a>
                                <a href="/internal/operator/kelola-berita/edit/{{ $b->id }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/operator/kelola-berita/hapus/{{ $b->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data berita yang diinput.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>