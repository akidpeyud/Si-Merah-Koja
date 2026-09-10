<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sarana Mako & Pos - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        #globalSuccessAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s; }
        #globalSuccessAlert .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }

        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1030; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 5px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f8fafc; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item i { font-size: 15px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-item.active i { color: #0284c7; }
        
        .sidebar-divider { border-top: 1px dashed #cbd5e1; margin: 15px 0; }
        .sidebar-title { font-size: 10.5px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px; padding-left: 15px; letter-spacing: 1px; }

        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }

        .nav-tabs { border-bottom: 2px solid #e2e8f0; margin-bottom: 25px; flex-wrap: nowrap; overflow-x: auto; white-space: nowrap; gap: 10px; }
        .nav-tabs .nav-link { color: #64748b; font-weight: 700; font-size: 12.5px; text-transform: uppercase; border: none; padding: 12px 24px; transition: all 0.2s; position: relative; background: transparent; }
        .nav-tabs .nav-link:hover { color: #0f172a; }
        .nav-tabs .nav-link.active { color: #0284c7; background: transparent; }
        .nav-tabs .nav-link.active::after { content: ''; position: absolute; bottom: -2px; left: 0; right: 0; height: 3px; background-color: #0284c7; border-radius: 3px 3px 0 0; }

        .info-card { background: linear-gradient(to right, #ffffff, #f8fafc); border-left: 4px solid #0284c7; border-radius: 8px; padding: 20px; margin-bottom: 25px; box-shadow: 0 2px 4px -1px rgba(0,0,0,0.05); }
        .info-card h5 { font-size: 17px; font-weight: 800; color: #0f172a; margin-bottom: 10px; text-transform: uppercase; }
        .info-card p { font-size: 13.5px; color: #475569; margin: 0 0 6px 0; display: flex; align-items: center; gap: 10px; font-weight: 500; }
        .info-card p:last-child { margin-bottom: 0; }

        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13.5px; }
        .table-custom thead th { background-color: #111827; color: #f8fafc; font-weight: 600; padding: 16px 12px; text-align: center; font-size: 11.5px; letter-spacing: 0.5px; text-transform: uppercase; border-bottom: none; }
        .table-custom tbody td { padding: 18px 12px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        
        .img-sarana { width: 180px; height: 120px; object-fit: cover; border-radius: 6px; transition: transform 0.2s; }
        .img-wrapper { display: inline-block; padding: 4px; border: 1px solid #e2e8f0; border-radius: 8px; background-color: #f8fafc; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .img-wrapper:hover .img-sarana { transform: scale(1.03); }

        .btn-action { padding: 8px 12px; font-size: 12.5px; border-radius: 6px; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-edit { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-edit:hover { background-color: #e2e8f0; color: #0f172a; }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .btn-delete:hover { background-color: #fecaca; color: #991b1b; }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'SAPRA') }}</span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Dhimas Zaky Abiyyu' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i> KELUAR</button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>

            <div class="sidebar-divider"></div>
            <div class="sidebar-title">Bagian Pencegahan</div>
            <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
            <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users"></i> Kelola Redkar</a>

            <div class="sidebar-divider"></div>
            <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
            <a href="#" class="sidebar-item"><i class="fas fa-file-signature"></i> Input Data</a>
            <a href="#" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>

            <div class="sidebar-divider"></div>
            <div class="sidebar-title">Bagian Sapra</div>
            <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Hidrant</a>
            <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
            <a href="#" class="sidebar-item"><i class="fas fa-truck-monster"></i> Kelola Armada Mobil</a>
            <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Mako & Pos</a>
            <a href="/sapra/sarana-mako" class="sidebar-item active"><i class="fas fa-fire-extinguisher"></i> Sarana Mako & Pos</a>
            <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
            
            <div class="sidebar-divider"></div>
            <div class="sidebar-title">Pengaturan Akun</div>
            <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
        </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Sarana Mako & Pos</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">Manajemen dokumentasi sarana kebakaran di Markas Komando dan Pos Pemadam.</p>
                </div>
                <div>
                    <a href="/sapra/sarana-mako/cetak-pdf" class="btn btn-danger fw-bold shadow-sm me-2" style="background-color: #dc2626; border: none; padding: 12px 20px; border-radius: 8px; color: white; text-decoration: none;">
                        <i class="fas fa-file-pdf me-2"></i> Download PDF
                    </a>
                    <button class="btn btn-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none; padding: 12px 20px; border-radius: 8px;">
                        <i class="fas fa-plus me-2"></i> Tambah Sarana
                    </button>
                </div>
            </div>

            @php $activeTab = session('active_tab'); @endphp

            <ul class="nav nav-tabs" id="posTabs" role="tablist">
                @foreach($posPemadam as $pos)
                    @php $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first; @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $isActive ? 'active' : '' }}" id="tab-{{ $pos->id_pos }}" data-bs-toggle="tab" data-bs-target="#content-{{ $pos->id_pos }}" type="button" role="tab">
                            {{ $pos->nama_pos }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="posTabsContent">
                @foreach($posPemadam as $pos)
                    @php $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first; @endphp
                    <div class="tab-pane fade {{ $isActive ? 'show active' : '' }}" id="content-{{ $pos->id_pos }}" role="tabpanel">
                        
                        <div class="info-card">
                            <h5>{{ $pos->nama_pos }}</h5>
                            <p><i class="fas fa-map-marker-alt text-danger" style="width: 20px;"></i> {{ $pos->alamat ?? 'Alamat belum diatur' }}</p>
                            <p><i class="fas fa-map text-success" style="width: 20px;"></i> Kode Map: <span class="badge bg-light text-dark border ms-1">{{ $pos->kode_map ?? '-' }}</span></p>
                        </div>

                        <div class="table-card">
                            <div class="table-responsive">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th width="5%">NO</th>
                                            <th width="35%" style="text-align: left; padding-left: 20px;">JENIS SARANA KEBAKARAN</th>
                                            <th width="10%">JUMLAH</th>
                                            <th width="30%">GAMBAR</th>
                                            <th width="20%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $dataFilter = $dataSarana->where('id_pos', $pos->id_pos); @endphp
                                        
                                        @forelse($dataFilter as $index => $item)
                                            <tr>
                                                <td class="text-center fw-bold text-dark">{{ $loop->iteration }}</td>
                                                <td class="fw-bold text-dark" style="padding-left: 20px;">{{ $item->jenis_sarana }}</td>
                                                <td class="text-center fw-bold text-primary" style="font-size: 15px;">{{ $item->jumlah }}</td>
                                                <td class="text-center">
                                                    @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                                        <div class="img-wrapper">
                                                            <a href="{{ asset($item->path_gambar) }}" target="_blank">
                                                                <img src="{{ asset($item->path_gambar) }}" alt="{{ $item->jenis_sarana }}" class="img-sarana" onerror="this.onerror=null; this.src='https://via.placeholder.com/200x130?text=Gambar+Hilang';">
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="badge bg-light text-secondary border py-2 px-3"><i class="fas fa-image me-1"></i> Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id_sarana }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="/sapra/sarana-mako/delete/{{ $item->id_sarana }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sarana ini?');">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="p-5 text-center text-muted">
                                                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                                            <i class="fas fa-folder-open" style="font-size: 32px; color: #cbd5e1;"></i>
                                                        </div>
                                                        <p class="mb-0 fw-bold text-dark">Belum ada data sarana.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- MODAL EDIT DATA -->
                        @foreach($dataFilter as $item)
                            <div class="modal fade" id="modalEdit{{ $item->id_sarana }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-light pb-3">
                                            <h5 class="modal-title fw-bold text-dark">Edit Data Sarana</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="/sapra/sarana-mako/update/{{ $item->id_sarana }}" method="POST" enctype="multipart/form-data">
                                            @csrf @method('PUT')
                                            <div class="modal-body text-start p-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold small text-secondary">Pilih Lokasi / Pos</label>
                                                    <select class="form-select border-light-subtle shadow-sm" name="id_pos" required>
                                                        <option value="">-- Pilih Lokasi --</option>
                                                        @foreach($posPemadam as $posOption)
                                                            <option value="{{ $posOption->id_pos }}" {{ $posOption->id_pos == $item->id_pos ? 'selected' : '' }}>
                                                                {{ $posOption->nama_pos }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-9 mb-3">
                                                        <label class="form-label fw-bold small text-secondary">Jenis Sarana</label>
                                                        <input type="text" class="form-control border-light-subtle shadow-sm" name="jenis_sarana" value="{{ $item->jenis_sarana }}" required>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label fw-bold small text-secondary">Jumlah</label>
                                                        <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah" value="{{ $item->jumlah }}" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold small text-secondary">Ganti Gambar (Opsional)</label>
                                                    <input type="file" class="form-control border-light-subtle shadow-sm" name="gambar" accept="image/*">
                                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light pt-3">
                                                <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4" style="background-color: #0284c7; border: none;">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH DATA -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light pb-3">
                    <h5 class="modal-title fw-bold text-dark">Tambah Data Sarana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/sapra/sarana-mako/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Pilih Lokasi / Pos</label>
                            <select class="form-select border-light-subtle shadow-sm" name="id_pos" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach($posPemadam as $pos)
                                    <option value="{{ $pos->id_pos }}">{{ $pos->nama_pos }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jenis Sarana</label>
                                <input type="text" class="form-control border-light-subtle shadow-sm" name="jenis_sarana" placeholder="Contoh: ALAT PELINDUNG DIRI" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jumlah</label>
                                <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah" value="1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Upload Gambar</label>
                            <input type="file" class="form-control border-light-subtle shadow-sm" name="gambar" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light pt-3">
                        <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4" style="background-color: #0284c7; border: none;">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>