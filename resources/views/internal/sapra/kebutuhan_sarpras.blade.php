<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutu Baku Kebutuhan - SIMERAH KOJA</title>

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
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        /* SIDEBAR STYLES */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f8fafc; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; transition: color 0.2s; }
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        
        .nav-tabs { border-bottom: 2px solid #e2e8f0; margin-bottom: 20px; }
        .nav-tabs .nav-link { font-weight: 700; color: #64748b; border: none; padding: 12px 24px; transition: all 0.3s; margin-bottom: -2px; }
        .nav-tabs .nav-link:hover { color: #0284c7; }
        .nav-tabs .nav-link.active { color: #0284c7; border-bottom: 3px solid #0284c7; background-color: transparent; }

        .table-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom { margin-bottom: 0; font-size: 13.5px; }
        .table-custom thead th { background-color: #111827; color: #f8fafc; font-weight: 600; padding: 16px 12px; text-align: center; font-size: 11.5px; letter-spacing: 0.5px; text-transform: uppercase; border-bottom: none; }
        .table-custom tbody td { padding: 14px 12px; color: #4b5563; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        
        .badge-qty { display: inline-block; padding: 6px 12px; border-radius: 6px; font-weight: 800; font-size: 14px; min-width: 50px; text-align: center; }
        .bg-butuh { background-color: #f1f5f9; border: 1px solid #cbd5e1; color: #334155; }
        .bg-sedia { background-color: #dcfce7; border: 1px solid #bbf7d0; color: #166534; }
        .bg-kurang { background-color: #fee2e2; border: 1px solid #fecaca; color: #991b1b; }
        .bg-aman { background-color: #f0f9ff; border: 1px solid #bae6fd; color: #0284c7; }

        .btn-action { padding: 8px 12px; font-size: 12.5px; border-radius: 6px; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-edit { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-edit:hover { background-color: #e2e8f0; color: #0f172a; }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .btn-delete:hover { background-color: #fecaca; color: #991b1b; }

        #searchInput:focus { box-shadow: none; border-color: #cbd5e1; }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
        <script>setTimeout(() => document.getElementById('globalSuccessAlert')?.remove(), 4000);</script>
    @endif

    <nav class="navbar-internal">
        <a href="/" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
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
        
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(in_array(Auth::user()->role, ['sapra', 'user', 'super_user']))
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="true">
                    <span>BAGIAN SAPRA</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu" style="padding-left:0;">
                        <!-- GRUP MANAJEMEN AIR -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota</a>

                        <!-- GRUP FASILITAS & POS -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <!-- GRUP PERENCANAAN / MUTU BAKU -->
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item active"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    </div>
                </div>
            @endif
        </aside>

        <main class="main-content">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Mutu Baku & Pengadaan</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">Rekapitulasi analisis kebutuhan sarana prasarana dan riwayat pengadaan tahunan.</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div class="input-group shadow-sm me-2 search-container" style="width: 250px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #cbd5e1;"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari uraian barang..." style="border-color: #cbd5e1; font-size: 14px;">
                    </div>
                    <button class="btn btn-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #0284c7; border: none; padding: 10px 16px; border-radius: 8px;">
                        <i class="fas fa-plus me-1"></i> Tambah Kebutuhan
                    </button>
                </div>
            </div>

            @php $activeTab = session('active_tab', 'mutubaku'); @endphp

            <!-- TABS UNTUK 2 TABEL DATABASE -->
            <ul class="nav nav-tabs" id="perencanaanTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'mutubaku' ? 'active' : '' }}" id="tab-mutubaku" data-bs-toggle="tab" data-bs-target="#content-mutubaku" type="button" role="tab">
                        <i class="fas fa-clipboard-list me-1"></i> Mutu Baku Kebutuhan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'pengadaan' ? 'active' : '' }}" id="tab-pengadaan" data-bs-toggle="tab" data-bs-target="#content-pengadaan" type="button" role="tab">
                        <i class="fas fa-truck-loading me-1"></i> Riwayat Pengadaan
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="perencanaanTabsContent">
                
                <!-- TAB 1: KEBUTUHAN SARPRAS (MUTU BAKU) -->
                <div class="tab-pane fade {{ $activeTab == 'mutubaku' ? 'show active' : '' }}" id="content-mutubaku" role="tabpanel">
                    <div class="table-card mt-2">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="40%" style="text-align: left; padding-left: 20px;">URAIAN BARANG / JASA</th>
                                        <th width="15%">JUMLAH DIBUTUHKAN</th>
                                        <th width="15%">JUMLAH TERSEDIA</th>
                                        <th width="15%">BELUM TERSEDIA</th>
                                        <th width="10%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataKebutuhan as $index => $item)
                                        <tr class="data-row">
                                            <td class="text-center fw-bold text-dark">{{ $loop->iteration }}</td>
                                            <td class="fw-bold text-dark data-name" style="padding-left: 20px;">{{ $item->uraian }}</td>
                                            <td class="text-center"><span class="badge-qty bg-butuh">{{ $item->jumlah_dibutuhkan }}</span></td>
                                            <td class="text-center"><span class="badge-qty bg-sedia">{{ $item->jumlah_tersedia }}</span></td>
                                            
                                            <td class="text-center">
                                                @if($item->jumlah_belum_tersedia > 0)
                                                    <span class="badge-qty bg-kurang">{{ $item->jumlah_belum_tersedia }}</span>
                                                @else
                                                    <span class="badge-qty bg-aman"><i class="fas fa-check"></i> Lengkap</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="/sapra/kebutuhan-sarpras/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kebutuhan ini? Semua riwayat pengadaannya juga akan ikut terhapus lho!');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODAL EDIT DATA MUTU BAKU -->
                                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-light pb-3">
                                                        <h5 class="modal-title fw-bold text-dark">Edit Data Kebutuhan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="/sapra/kebutuhan-sarpras/update/{{ $item->id }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <div class="modal-body text-start p-4">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold small text-secondary">Uraian Barang / Jasa</label>
                                                                <input type="text" class="form-control border-light-subtle shadow-sm" name="uraian" value="{{ $item->uraian }}" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label fw-bold small text-secondary">Target Dibutuhkan</label>
                                                                    <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah_dibutuhkan" value="{{ $item->jumlah_dibutuhkan }}" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label fw-bold small text-secondary">Stok Saat Ini (Tersedia)</label>
                                                                    <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah_tersedia" value="{{ $item->jumlah_tersedia }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="alert alert-warning mt-2" style="font-size:12px; background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e;">
                                                                <i class="fas fa-exclamation-triangle me-1"></i> <b>Catatan:</b> Sebaiknya update Stok (Tersedia) melalui menu <b>Riwayat Pengadaan</b> agar tercatat historinya. Ubah angka di sini hanya untuk penyesuaian stok awal.
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
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="p-5 text-center text-muted">
                                                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                                        <i class="fas fa-clipboard-check" style="font-size: 32px; color: #cbd5e1;"></i>
                                                    </div>
                                                    <p class="mb-0 fw-bold text-dark">Belum ada data mutu baku.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    <!-- INI BARIS TOTAL KESELURUHAN OTOMATIS -->
                                    @if($dataKebutuhan->count() > 0)
                                        <tr style="background-color: #f8fafc; border-top: 3px solid #cbd5e1;">
                                            <td colspan="2" class="text-end fw-bolder text-dark pe-4" style="font-size: 14px; letter-spacing: 0.5px;">TOTAL KESELURUHAN :</td>
                                            <td class="text-center"><span class="badge-qty bg-butuh" style="font-size: 15px;">{{ $dataKebutuhan->sum('jumlah_dibutuhkan') }}</span></td>
                                            <td class="text-center"><span class="badge-qty bg-sedia" style="font-size: 15px;">{{ $dataKebutuhan->sum('jumlah_tersedia') }}</span></td>
                                            <td class="text-center"><span class="badge-qty bg-kurang" style="font-size: 15px;">{{ $dataKebutuhan->sum('jumlah_belum_tersedia') }}</span></td>
                                            <td></td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

              <!-- TAB 2: PENGADAAN SARPRAS (PERSIS EXCEL) -->
                <div class="tab-pane fade {{ $activeTab == 'pengadaan' ? 'show active' : '' }}" id="content-pengadaan" role="tabpanel">
                    
                    <!-- TOMBOL TAMBAH PENGADAAN (YANG KETINGGALAN) -->
                    <div class="d-flex justify-content-end mb-3 mt-3">
                        <button class="btn fw-bold shadow-sm text-white" data-bs-toggle="modal" data-bs-target="#modalTambahPengadaan" style="background-color: #10b981; border: none; padding: 10px 16px; border-radius: 8px;">
                            <i class="fas fa-truck-loading me-1"></i> Input Riwayat Pengadaan
                        </button>
                    </div>

                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-custom table-bordered" style="border: 1px solid #cbd5e1;">
                                <thead>
                                    <!-- HEADER BARIS 1 -->
                                    <tr>
                                        <th rowspan="2" width="5%" style="vertical-align: middle; border: 1px solid #cbd5e1;">NO</th>
                                        <th rowspan="2" width="25%" style="text-align: left; padding-left: 20px; vertical-align: middle; border: 1px solid #cbd5e1;">NAMA BARANG</th>
                                        <th colspan="{{ count($listTahun) }}" class="text-center" style="border: 1px solid #cbd5e1; background-color: #1e293b;">TAHUN PENGADAAN</th>
                                        <th rowspan="2" width="10%" style="vertical-align: middle; border: 1px solid #cbd5e1; background-color: #3b82f6; color: white;">STOK</th>
                                    </tr>
                                    <!-- HEADER BARIS 2 (TAHUN DINAMIS) -->
                                    <tr>
                                        @foreach($listTahun as $tahun)
                                            <th class="text-center" style="border: 1px solid #cbd5e1; background-color: #f1f5f9; color: #1e293b;">{{ $tahun }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataKebutuhan as $item)
                                        <tr class="data-row">
                                            <td class="text-center fw-bold text-dark" style="border: 1px solid #cbd5e1;">{{ $loop->iteration }}</td>
                                            <td class="fw-bold text-dark data-name" style="padding-left: 20px; border: 1px solid #cbd5e1;">{{ $item->uraian }}</td>
                                            
                                            <!-- LOOPING TAHUN OTOMATIS -->
@foreach($listTahun as $tahun)
    <td class="text-center" style="border: 1px solid #cbd5e1; vertical-align: middle;">
        @if(isset($pengadaanMapped[$item->id][$tahun]))
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span class="fw-bold text-dark">{{ $pengadaanMapped[$item->id][$tahun] }}</span>
                
                <!-- Tombol Hapus (Hanya muncul kalau ada angkanya) -->
                <form action="/sapra/pengadaan-sarpras/delete/{{ $item->id }}/{{ $tahun }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pengadaan tahun {{ $tahun }} ini? Stok Mutu Baku akan otomatis dikurangi kembali.');">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-danger" style="background: none; border: none; padding: 0; font-size: 13px;" title="Batalkan Pengadaan">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </form>
            </div>
        @else
            <span class="text-secondary">-</span>
        @endif
    </td>
@endforeach
                                            <!-- KOLOM STOK -->
                                            <td class="text-center fw-bold text-primary bg-light" style="border: 1px solid #cbd5e1; font-size: 14px;">
                                                {{ $item->jumlah_tersedia }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($listTahun) + 3 }}">
                                                <div class="p-5 text-center text-muted">
                                                    <p class="mb-0 fw-bold text-dark">Belum ada data barang.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH DATA (MUTU BAKU) -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light pb-3">
                    <h5 class="modal-title fw-bold text-dark">Tambah Kebutuhan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/sapra/kebutuhan-sarpras/store" method="POST">
                    @csrf
                    <div class="modal-body text-start p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Uraian Barang / Jasa</label>
                            <input type="text" class="form-control border-light-subtle shadow-sm" name="uraian" placeholder="Contoh: MOBIL KOMANDO" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jumlah Dibutuhkan</label>
                                <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah_dibutuhkan" value="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jumlah Tersedia (Stok Awal)</label>
                                <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah_tersedia" value="0" required>
                            </div>
                        </div>
                        <div class="alert alert-primary mt-2" style="font-size:12px;">
                            <i class="fas fa-info-circle me-1"></i> Kolom "Belum Tersedia" akan dihitung otomatis oleh sistem.
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

    <!-- MODAL TAMBAH RIWAYAT PENGADAAN (YANG BARU DITAMBAH) -->
    <div class="modal fade" id="modalTambahPengadaan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light pb-3">
                    <h5 class="modal-title fw-bold text-dark">Input Riwayat Pengadaan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/sapra/pengadaan-sarpras/store" method="POST">
                    @csrf
                    <div class="modal-body text-start p-4">
                        <div class="alert alert-info mt-0 mb-3" style="font-size:12px; border: 1px solid #93c5fd; background-color: #eff6ff;">
                            <i class="fas fa-info-circle me-1"></i> Data yang diinput di sini akan otomatis <b>menambah STOK</b> di tabel Mutu Baku Kebutuhan.
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">Pilih Barang / Jasa</label>
                            <select class="form-select border-light-subtle shadow-sm" name="kebutuhan_id" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($dataKebutuhan as $item)
                                    <option value="{{ $item->id }}">{{ $item->uraian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">Tahun Pengadaan</label>
                               <!-- Otomatis ngunci tahun maksimal ke tahun saat ini -->
<input type="number" class="form-control border-light-subtle shadow-sm" name="tahun" value="{{ date('Y') }}" max="{{ date('Y') }}" required>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">Jumlah Masuk (Unit)</label>
                                <input type="number" class="form-control border-light-subtle shadow-sm" name="jumlah" min="1" placeholder="Cth: 5" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light pt-3">
                        <button type="button" class="btn btn-light fw-bold border shadow-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success fw-bold shadow-sm px-4" style="background-color: #10b981; border: none;">Simpan Pengadaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK SEARCH REAL-TIME -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let activeTab = document.querySelector('.tab-pane.active');
            if(!activeTab) return;

            let rows = activeTab.querySelectorAll('.data-row');
            rows.forEach(row => {
                let textContent = row.querySelector('.data-name').textContent.toLowerCase();
                if(textContent.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        let tabs = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (e) {
                document.getElementById('searchInput').value = '';
                let rows = document.querySelectorAll('.data-row');
                rows.forEach(row => row.style.display = '');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>