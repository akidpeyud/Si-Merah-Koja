<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita Medsos - SIMERAH KOJA</title>
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
            <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
            <a href="/internal/operator/berita-medsos" class="sidebar-item active"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
        </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold fs-3 text-dark mb-1"><i class="fab fa-instagram text-danger me-2"></i> Kelola Berita Media Sosial</h1>
                    <p class="text-muted small m-0">Tambah dan perbarui arsip kiriman media sosial instansi.</p>
                </div>
                <button class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus me-1"></i> Tambah Berita Medsos</button>
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

            @php
                // Deklarasikan variabel yang sudah dibersihkan agar Blade compiler tidak error
                $medsosData = $medsos ?? [];
                $kategoriData = $kategori ?? [];
            @endphp

            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 15%;">Foto</th>
<<<<<<< HEAD
                                <th style="width: 35%;">Judul Berita</th>
=======
                                <th style="width: 35%;">Judul Berita & Kategori</th>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                <th style="width: 25%;">Tanggal & Sumber</th>
                                <th style="width: 20%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
<<<<<<< HEAD
                            @forelse($medsosData as $index => $item)
=======
<<<<<<< HEAD
                            @forelse($medsos as $index => $item)
=======
                            @forelse($medsos ?? [] as $index => $item)
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Medsos" style="height: 60px; width: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                                </td>
                                <td>
                                    <span class="fw-bold d-block">{{ $item->judul }}</span>
<<<<<<< HEAD
=======
                                    <span class="badge bg-secondary mb-1">
                                        <i class="fas fa-tag me-1"></i> {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </span>
                                    <br>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                    @if($item->link)
                                        <a href="{{ $item->link }}" target="_blank" class="small text-primary text-decoration-none"><i class="fas fa-external-link-alt me-1"></i> Lihat Tautan</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="small text-secondary"><i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y H:i') }}</div>
                                    <div class="small text-muted"><i class="fab fa-instagram me-1"></i> {{ $item->sumber }}</div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm text-white fw-bold px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}"><i class="fas fa-edit"></i></button>

                                    <form action="/internal/operator/berita-medsos/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-2 fw-bold"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/internal/operator/berita-medsos/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Edit Berita Media Sosial</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Judul Berita</label>
                                                    <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                                                </div>
<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
                                                
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Kategori Berita <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="kategori_id" required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach($kategoriData as $kat)
                                                            <option value="{{ $kat->id }}" {{ $item->kategori_id == $kat->id ? 'selected' : '' }}>
                                                                {{ $kat->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Tanggal & Waktu</label>
                                                    <input type="datetime-local" class="form-control" name="tanggal" value="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d\TH:i') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Sumber Akun</label>
                                                    <input type="text" class="form-control" name="sumber" value="{{ $item->sumber }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Link Postingan (Opsional)</label>
                                                    <input type="url" class="form-control" name="link" value="{{ $item->link }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                                                    <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger btn-sm fw-bold">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data berita media sosial.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

<<<<<<< HEAD
    <!-- Modal Tambah Berita Medsos -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/internal/operator/berita-medsos/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle me-1 text-danger"></i> Tambah Berita Medsos Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" placeholder="Cth: Evakuasi Ular Sanca di Pall Merah" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal & Waktu <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sumber Akun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sumber" value="instagram @damkarkotajambi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Tautan Postingan (Opsional)</label>
                            <input type="url" class="form-control" name="link" placeholder="https://instagram.com/p/...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Dokumentasi <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
=======
    <!-- Modal Tambah Berita Medsos (Sistem Hybrid) -->
    <div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/internal/operator/berita-medsos/store" method="POST" id="formTambahOtomatis" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fas fa-share-alt me-1 text-danger"></i> Tambah Medsos (Hybrid)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- BAGIAN INPUT LINK -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Link Tautan Postingan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="url" class="form-control" id="inputLink" name="link" placeholder="Paste link YouTube/Instagram/Berita di sini..." required>
                                <button class="btn btn-primary fw-bold" type="button" id="btnTarikData">Tarik Data</button>
                            </div>
                            <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Klik "Tarik Data" untuk ekstrak gambar otomatis.</small>
                        </div>

                        <!-- HIDDEN INPUT URL GAMBAR -->
                        <input type="hidden" name="gambar_url" id="inputGambarUrl">

                        <!-- KOTAK PREVIEW GAMBAR -->
                        <div class="mb-4 d-none text-center p-3 border rounded bg-light" id="previewArea">
                            <h6 class="text-muted fw-bold mb-2"><i class="fas fa-image me-2"></i>Gambar Otomatis Ditemukan:</h6>
                            <img src="" id="imgPreview" alt="Preview Gambar" style="max-height: 150px; border-radius: 8px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputJudul" name="judul" placeholder="Isi judul manual jika Tarik Data gagal..." required>
                        </div>

                        <!-- KOLOM UPLOAD MANUAL -->
                        <div class="mb-3 p-3 bg-light border border-dashed rounded" id="uploadManualArea">
                            <label class="form-label fw-bold">Upload Foto Manual</label>
                            <input type="file" class="form-control" id="inputGambarManual" name="gambar_manual" accept=".jpg,.jpeg,.png">
                            <small class="text-danger fw-bold d-block mt-1">Wajib diisi jika Tarik Data dari link di atas gagal!</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Berita <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoriData as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal & Waktu <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="tanggal" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
<<<<<<< HEAD
=======
                        <!-- Tombol tidak pernah didisable agar tidak merepotkan operator -->
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
                        <button type="submit" class="btn btn-danger btn-sm fw-bold">Simpan Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD

    <!-- SCRIPT TARIK DATA LINK (SUPPORT YOUTUBE) -->
=======
<<<<<<< HEAD
=======
    
    <!-- SCRIPT TARIK DATA LINK -->
>>>>>>> 54d349b2f34ba1d90fd3fbf4f615f46b7fe9ffd6
    <script>
        document.getElementById('btnTarikData').addEventListener('click', function() {
            let urlInput = document.getElementById('inputLink').value.trim();
            let btn = this;

            if(!urlInput) {
                alert("Mohon paste link postingan terlebih dahulu!");
                return;
            }

            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;

            // CEK JIKA ITU LINK YOUTUBE
            let isYouTube = false;
            let videoId = '';

            let ytRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i;
            let match = urlInput.match(ytRegex);

            if (match && match[1].length === 11) {
                isYouTube = true;
                videoId = match[1];
            }

            // JIKA YOUTUBE, LAKUKAN PENARIKAN LOKAL
            if (isYouTube) {
                let thumbUrl = `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;

                document.getElementById('imgPreview').src = thumbUrl;
                document.getElementById('inputGambarUrl').value = thumbUrl;
                document.getElementById('previewArea').classList.remove('d-none');

                if(document.getElementById('inputJudul').value === '') {
                    document.getElementById('inputJudul').value = "Video YouTube";
                }

                document.getElementById('inputGambarManual').value = '';
                document.getElementById('uploadManualArea').style.opacity = '0.5';

                btn.innerHTML = 'Tarik Data';
                btn.disabled = false;
                return;
            }

            // JIKA BUKAN YOUTUBE, FETCH SERVER
            fetch('/internal/fetch-link-preview', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ url: urlInput })
            })
            .then(async response => {
                const isJson = response.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await response.json() : null;

                if (!response.ok) {
                    throw new Error((data && data.error) ? data.error : 'Server website tujuan menolak permintaan (403/Blocked).');
                }
                return data;
            })
            .then(data => {
                btn.innerHTML = 'Tarik Data';
                btn.disabled = false;

                if(data && data.title) {
                    document.getElementById('inputJudul').value = data.title;
                }

                if(data && data.image) {
                    document.getElementById('imgPreview').src = data.image;
                    document.getElementById('inputGambarUrl').value = data.image;
                    document.getElementById('previewArea').classList.remove('d-none');
                    document.getElementById('inputGambarManual').value = '';
                    document.getElementById('uploadManualArea').style.opacity = '0.5';
                } else {
                    alert("Informasi: Gambar tidak bisa dideteksi secara otomatis dari situs ini. Silakan upload gambar secara manual.");
                }
            })
            .catch(error => {
                btn.innerHTML = 'Tarik Data';
                btn.disabled = false;
                alert('TARIK DATA OTOMATIS GAGAL (' + error.message + ')\n\nSilakan ketik Judul dan Upload Foto secara MANUAL di form.');
            });
        });
    </script>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
</body>
</html>