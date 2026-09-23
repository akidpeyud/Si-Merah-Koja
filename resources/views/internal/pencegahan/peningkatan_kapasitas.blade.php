<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peningkatan Kapasitas Aparatur - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }
        #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: 8px; z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        #globalSuccessAlert { background-color: #10b981; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        #globalErrorAlert { background-color: #ef4444; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
        .btn-close-alert:hover { opacity: 1; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        .custom-nav-tabs { border-bottom: 2px solid #e2e8f0; margin-top: 25px; gap: 10px; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 5px; }
        .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
        .custom-nav-tabs::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-nav-tabs .nav-link { border: none; color: #64748b; font-weight: 700; font-size: 13px; padding: 12px 18px; background: transparent; white-space: nowrap; }
        .custom-nav-tabs .nav-link:hover { color: #0f172a; }
        .custom-nav-tabs .nav-link.active { color: #10b981; border-bottom: 3px solid #10b981; }
        .table-scroll-wrapper { width: 100%; overflow-x: auto; border-radius: 8px; border: 1px solid #e2e8f0; background: white; margin-bottom: 40px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .table-scroll-wrapper::-webkit-scrollbar { height: 10px; }
        .table-scroll-wrapper::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
        .table-scroll-wrapper::-webkit-scrollbar-track { background: #f1f5f9; }
        .table-detailed { width: 100%; border-collapse: collapse; min-width: 2500px; }
        .table-detailed thead { background-color: #111827; color: white; }
        .table-detailed th { font-size: 11px; font-weight: 700; padding: 16px 15px; white-space: nowrap; text-transform: uppercase; border-right: 1px solid #374151; letter-spacing: 0.5px; vertical-align: middle; }
        .table-detailed td { font-size: 13px; padding: 12px 15px; vertical-align: middle; white-space: nowrap; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #f1f5f9; }
        .table-detailed tbody tr:hover { background-color: #f8fafc; }
        .badge-soft-blue { background-color: #e0f2fe; color: #0284c7; padding: 6px 12px; font-weight: 700; border-radius: 6px; border: 1px solid #bae6fd; }
        .btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 6px; font-size: 13px; color: white; border: none; }
        .btn-edit { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div id="globalErrorAlert">
            <i class="fas fa-exclamation-triangle alert-icon"></i>
            <span>{{ session('error') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalErrorAlert')"><i class="fas fa-times"></i></button>
        </div>
    @endif
    <script>
        function closeAlert(id) {
            let alertBox = document.getElementById(id);
            if(alertBox) {
                alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                setTimeout(() => alertBox.remove(), 400); 
            }
        }
        setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
        setTimeout(() => closeAlert('globalErrorAlert'), 4000);
    </script>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
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

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()?->role === 'user' || Auth::user()?->role === 'super_user' || true)
                <!-- ACCORDION PENCEGAHAN -->
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item active" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                            PENINGKATAN KAPASITAS APARATUR
                        </a>
                        <a href="/internal/pencegahan/inspeksi-kebakaran" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                            PENCEGAHAN KEBAKARAN DAN INSPEKSI
                        </a>
                        <a href="#" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">
                            PEMBERDAYAAN MASYARAKAT DAN DUNIA USAHA
                        </a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="false">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="false">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 5px; margin-bottom: 3px; letter-spacing: 0.5px;">MANAJEMEN AIR</span>
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">FASILITAS & POS MAKO</span>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                        <a href="/sapra/sarana-penyelamatan" class="sidebar-item"><i class="fas fa-life-ring"></i> Sarana Penyelamatan</a>
                        <a href="/sapra/kelola-pos" class="sidebar-item"><i class="fas fa-warehouse"></i> Kelola Data Pos</a>

                        <span style="font-size: 10px; font-weight: 800; color: #94a3b8; padding-left: 15px; margin-top: 15px; margin-bottom: 3px; letter-spacing: 0.5px;">PERENCANAAN PENGADAAN</span>
                        <a href="/sapra/kebutuhan-sarpras" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Mutu Baku Kebutuhan</a>
                    </div>
                </div>
            @endif

            @if(Auth::user()?->role === 'operator' || Auth::user()?->role === 'super_user' || true)
                <!-- ACCORDION MANAJEMEN BERITA -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita" aria-expanded="false">
                    <span>Manajemen Berita</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                        <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
                        <a href="/internal/operator/berita-medsos" class="sidebar-item"><i class="fab fa-instagram"></i> Kelola Berita Medsos</a>
                    </div>
                </div>
            @endif

            <!-- ACCORDION PENGATURAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengaturan" aria-expanded="false">
                <span>Pengaturan Akun</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/profil" class="sidebar-item"><i class="fas fa-user-edit"></i> Profil Saya</a>
                    <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            
            <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-3">
                <div>
                    <h1 class="fw-bolder text-dark mb-2" style="font-size: 28px;">Peningkatan Kapasitas Aparatur</h1>
                    <p class="text-muted mb-0" style="font-size: 15px;">Kelola data diklat dan peningkatan kapasitas aparatur pemadam kebakaran.</p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group" style="width: 260px;">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama atau sertifikat...">
                    </div>
                    
                    <a href="/internal/pencegahan/peningkatan-kapasitas/tambah" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #0284c7; padding: 9px 16px;">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #10b981; padding: 9px 16px;">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                    <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #ef4444; padding: 9px 16px;">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                </div>
            </div>

            <!-- TABS MENYAMPING -->
            <ul class="nav custom-nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas">Semua Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diksar') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diksar">DIKSAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f1') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f1">DIKLAT F1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f2') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f2">DIKLAT F2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-rescue') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-rescue">DIKLAT RESCUE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-mfr') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-mfr">DIKLAT MFR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-operator') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-operator">DIKLAT OPERATOR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-inspektur') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur">DIKLAT INSPEKTUR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-ppl') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-ppl">DIKLAT PPL</a>
                </li>
            </ul>

            <!-- ================= MULAI AREA TABEL DATA ================= -->

            <!-- 1. TABEL DIKSAR -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #0284c7;"><i class="fas fa-check-circle me-2"></i> Data DIKSAR</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataDiksar ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center" style="white-space: nowrap;">
    <!-- Tombol Edit -->
    <a href="/internal/pencegahan/peningkatan-kapasitas/edit/{{ str_replace('_', '-', str_replace('tbl_', '', $item->jenis_diklat ?? 'diklat-f1')) }}/{{ $item->id }}" class="btn-action btn-edit" title="Edit Data" style="position: relative; z-index: 10;">
        <i class="fas fa-edit"></i>
    </a>
    
    <!-- Tombol Hapus -->
    <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/{{ str_replace('_', '-', str_replace('tbl_', '', $item->jenis_diklat ?? 'diklat-f1')) }}/{{ $item->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
        @csrf 
        @method('DELETE')
        <button type="submit" class="btn-action btn-delete" title="Hapus Data" style="position: relative; z-index: 10;">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKSAR</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 2. TABEL DIKLAT F1 -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #10b981;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT F1</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataF1 ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ (!empty($item->created_at) && trim($item->created_at) !== '-' && trim($item->created_at) !== '') ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ (!empty($item->updated_at) && trim($item->updated_at) !== '-' && trim($item->updated_at) !== '') ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-f1/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-f1/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT F1</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 3. TABEL DIKLAT F2 -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #f59e0b;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT F2</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataF2 ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ (!empty($item->created_at) && trim($item->created_at) !== '-' && trim($item->created_at) !== '') ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ (!empty($item->updated_at) && trim($item->updated_at) !== '-' && trim($item->updated_at) !== '') ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-f2/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-f2/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT F2</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 4. TABEL DIKLAT RESCUE -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #ef4444;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT RESCUE</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataRescue ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ (!empty($item->created_at) && trim($item->created_at) !== '-' && trim($item->created_at) !== '') ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
<<<<<<< HEAD
                            <td>{{ (!empty($item->updated_at) && trim($item->updated_at) !== '-' && trim($item->updated_at) !== '') ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
=======
<td>{{ (!empty($item->updated_at) && trim($item->updated_at) !== '-' && trim($item->updated_at) !== '') ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-rescue/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-rescue/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT RESCUE</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 5. TABEL DIKLAT MFR -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #8b5cf6;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT MFR</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataMfr ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-mfr/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-mfr/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT MFR</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 6. TABEL DIKLAT OPERATOR -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #06b6d4;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT OPERATOR</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataOperator ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-operator/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-operator/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT OPERATOR</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 7. TABEL DIKLAT INSPEKTUR -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #14b8a6;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT INSPEKTUR</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataInspektur ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-inspektur/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-inspektur/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT INSPEKTUR</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 8. TABEL DIKLAT PPL -->
            <h5 class="fw-bold mt-4 mb-3" style="color: #ec4899;"><i class="fas fa-check-circle me-2"></i> Data DIKLAT PPL</h5>
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">NO</th>
                            <th>NAMA</th><th>TEMPAT LAHIR</th><th>TGL LAHIR</th><th>NIK</th><th>JABATAN</th>
                            <th>INSTANSI/PERANGKAT DAERAH</th><th>DITANDA TANGANI OLEH</th><th>TANGGAL PELAKSANAAN</th>
                            <th>JUMLAH JAM PELAJARAN</th><th>INSTANSI PENYELENGGARA</th><th>PROVINSI</th><th>KOTA</th>
                            <th>NOMOR SERTIFIKAT</th><th>KODE VERIFIKASI</th><th>PERSENTASI PENILAIAN</th><th>JENIS DIKLAT</th>
                            <th>CREATED AT</th><th>UPDATED AT</th><th>TTL</th><th>KET</th>
                            <th class="text-center" width="100px">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataPpl ?? [] as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $item->nama ?? $item->nama_aparatur ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td><td>{{ $item->tgl_lahir ?? '-' }}</td>
                            <td>{{ $item->nik ?? '-' }}</td><td>{{ $item->jabatan ?? '-' }}</td>
                            <td>{{ $item->instansi ?? '-' }}</td><td>{{ $item->ditandatangani_oleh ?? $item->pejabat ?? '-' }}</td>
                            <td>{{ $item->tanggal_pelaksanaan ?? $item->tanggal ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? $item->jumlah_jp ?? '-' }} JP</span></td>
                            <td>{{ $item->instansi_penyelenggara ?? $item->penyelenggara ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td><td>{{ $item->kota ?? '-' }}</td>
                            <td style="color: #334155; font-weight: 600;">{{ $item->nomor_sertifikat ?? '-' }}</td>
                            <td>{{ $item->kode_verifikasi ?? $item->kode_verivikasi ?? '-' }}</td>
                            <td>{{ $item->persentasi_penilaian ?? $item->persentase_penilaian ?? '-' }}</td>
                            <td>{{ $item->jenis_diklat ?? '-' }}</td>
                            <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->ttl ?? '-' }}</td><td>{{ $item->ket ?? $item->keterangan ?? '-' }}</td>
                            <td class="text-center d-flex justify-content-center gap-1">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diklat-ppl/{{ $item->id }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-ppl/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="22" class="text-center py-4 text-muted">Belum ada data DIKLAT PPL</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>