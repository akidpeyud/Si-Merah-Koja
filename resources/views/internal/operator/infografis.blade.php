<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Info Grafis - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
        body { background-color: #f3f4f6; color: #1f2937; }
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; font-weight: 800; font-size: 18px; }
        .nav-brand img { height: 40px; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; padding-left: 15px; border-top: 1px dashed #e5e7eb; padding-top: 15px; }
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-y: auto; }
        .card-box { background: white; border-radius: 12px; padding: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
    </style>
</head>
<body>

    <nav class="navbar-internal">
        <a href="/internal/index" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo">
            <span>SIMERAH KOJA</span>
        </a>
        <form action="/logout" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm px-3 fw-bold"><i class="fas fa-sign-out-alt me-1"></i> KELUAR</button>
        </form>
    </nav>

    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <div class="sidebar-title">Manajemen Berita & Konten</div>
            <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Kelola Berita Utama</a>
            <a href="/internal/operator/infografis" class="sidebar-item active"><i class="fas fa-image"></i> Kelola Info Grafis</a>
            <a href="/internal/operator/berita-medsos" class="sidebar-item"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
        </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold fs-3 text-dark mb-1"><i class="fas fa-image text-danger me-2"></i> Kelola Info Grafis</h1>
                    <p class="text-muted small m-0">Unggah dan atur gambar info grafis yang tampil di halaman utama.</p>
                </div>
                <button class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus me-1"></i> Tambah Infografis</button>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Preview Gambar</th>
                                <th style="width: 45%;">Judul / Keterangan</th>
                                <th style="width: 25%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infografis as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Infografis" style="height: 70px; width: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                                </td>
                                <td><span class="fw-bold">{{ $item->judul ?? 'Tanpa Judul' }}</span></td>
                                <td class="text-center">
                                    <form action="/internal/operator/infografis/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus infografis ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm fw-bold"><i class="fas fa-trash-alt me-1"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data info grafis yang diunggah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Infografis -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/internal/operator/infografis/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle me-1 text-danger"></i> Tambah Infografis Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul / Keterangan (Opsional)</label>
                            <input type="text" class="form-control" name="judul" placeholder="Cth: Panduan Mencegah Kebakaran Rumah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">File Gambar Infografis <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png" required>
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-sm fw-bold">Unggah Infografis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>