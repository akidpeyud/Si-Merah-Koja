<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diklat F2 - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* NAVBAR */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; } 
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }

        /* SIDEBAR */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item.active i { color: #0284c7; }

        .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .sidebar-collapse-btn:hover { color: #4b5563; }
        .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
        .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
        .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
        .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
        .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }

        /* MAIN AREA */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        
        /* Custom Tabs Menyamping */
        .custom-nav-tabs { border-bottom: 2px solid #e2e8f0; margin-top: 25px; gap: 10px; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 5px; }
        .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
        .custom-nav-tabs::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-nav-tabs .nav-link { border: none; color: #64748b; font-weight: 700; font-size: 13px; padding: 12px 18px; background: transparent; white-space: nowrap; cursor: pointer; }
        .custom-nav-tabs .nav-link:hover { color: #0f172a; }
        .custom-nav-tabs .nav-link.active { color: #10b981; border-bottom: 3px solid #10b981; }

        /* TABEL HEADER GELAP & LEBAR */
        .table-wrapper {
            background-color: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            margin-top: 20px;
            overflow: hidden; 
        }
        
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table-custom {
            margin-bottom: 0;
            width: 100%;
            min-width: 2800px; 
        }
        
        .table-custom thead th {
            background-color: #1e293b !important; 
            color: #ffffff !important;
            font-size: 12px;
            font-weight: 700;
            padding: 18px 15px;
            letter-spacing: 0.5px;
            border: none;
            border-right: 1px solid #334155 !important; 
            text-transform: uppercase;
            white-space: nowrap;
            vertical-align: middle;
        }
        
        .table-custom tbody td {
            padding: 15px;
            vertical-align: middle;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            border-right: 1px solid #f1f5f9;
            white-space: nowrap;
        }
        
        /* Badges & Buttons */
        .badge-soft-blue { background-color: #e0f2fe; color: #0284c7; padding: 6px 12px; font-weight: 700; border-radius: 6px; border: 1px solid #bae6fd; }
        .btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 6px; font-size: 13px; color: white; border: none; margin-right: 5px; }
        .btn-edit { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; }

        /* Sticky Action Column */
        .sticky-action {
            position: sticky;
            right: 0;
            background-color: white !important;
            z-index: 1;
            box-shadow: -2px 0 5px rgba(0,0,0,0.05);
        }
        .table-custom thead th.sticky-action {
            background-color: #1e293b !important;
            box-shadow: -2px 0 5px rgba(0,0,0,0.2);
            border-left: 2px solid #0f172a !important;
        }
        .table-custom tbody td.sticky-action {
            border-left: 2px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah" onerror="this.style.display='none'">
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

    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

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

            <!-- ACCORDION PEMADAMAN -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman">
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
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra">
                <span>Bagian Sapra</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                    <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Pos</a>
                    <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Pos</a>
                </div>
            </div>
            
            <!-- ACCORDION MANAJEMEN BERITA -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita">
                <span>Manajemen Berita</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse" id="collapseBerita" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/operator/kelola-berita" class="sidebar-item"><i class="fas fa-newspaper"></i> Input & Kelola Berita</a>
                    <a href="/internal/operator/infografis" class="sidebar-item"><i class="fas fa-image"></i> Kelola Info Grafis</a>
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
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama atau NIK...">
                    </div>
                    
                    <a href="#" class="btn text-white fw-bold d-flex align-items-center gap-2" style="background-color: #0284c7; padding: 9px 16px;">
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

        <!-- TABS MENYAMPING SAKTI UNTUK SEMUA HALAMAN -->
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

            <!-- TABEL 21 KOLOM -->
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="table table-hover table-custom">
                        <thead>
                            <tr>
                                <th class="text-center" width="50px">No</th>
                                <th>NAMA</th>
                                <th>Tempat Lahir</th>
                                <th>Tgl Lahir</th>
                                <th>NIK</th>
                                <th>Jabatan</th>
                                <th>Instansi/Perangkat Daerah</th>
                                <th>Ditanda Tangani Oleh</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th class="text-center">Jumlah Jam Pelajaran</th>
                                <th>Instansi Penyelenggara</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Nomor Sertifikat</th>
                                <th>Kode Verivikasi</th>
                                <th>Persentasi Penilaian</th>
                                <th>Jenis Diklat</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>TTL</th>
                                <th>Ket</th>
                                <th class="sticky-action text-center" width="100px">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DATA F2 -->
                            <tr>
                                <td class="text-center fw-bold">1</td>
                                <td><div class="fw-bold text-dark">AHMAD RIZAL, ST</div></td>
                                <td>Jambi</td>
                                <td>1985/04/12</td>
                                <td>1571023456780001</td>
                                <td>Komandan Pleton</td>
                                <td>Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</td>
                                <td>Kepala Dinas Pemadam Kebakaran Provinsi DKI Jakarta</td>
                                <td>10 s/d 25 Okt 2021</td>
                                <td class="text-center"><span class="badge-soft-blue">150</span></td>
                                <td>PUSDIKLAT DKI Jakarta</td>
                                <td>DKI Jakarta</td>
                                <td>Jakarta Timur</td>
                                <td>No. 334/2.110.12.</td>
                                <td>-</td>
                                <td>-</td>
                                <td><span class="badge bg-success">Diklat F2</span></td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="sticky-action text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="text-center fw-bold">2</td>
                                <td><div class="fw-bold text-dark">DEDI KURNIAWAN, S.Sos</div></td>
                                <td>Muaro Jambi</td>
                                <td>1982/11/05</td>
                                <td>1571076789010002</td>
                                <td>Analis Kebakaran</td>
                                <td>Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</td>
                                <td>Kepala Dinas Pemadam Kebakaran dan Penanggulangan Bencana Provinsi DKI Jakarta</td>
                                <td>12 s/d 28 Feb 2022</td>
                                <td class="text-center"><span class="badge-soft-blue">150</span></td>
                                <td>PUSDIKLAT DKI Jakarta</td>
                                <td>DKI Jakarta</td>
                                <td>Jakarta Timur</td>
                                <td>No. 00004567/DIKLAT TEKNIS/6000/083/LAN/2022</td>
                                <td>-</td>
                                <td>-</td>
                                <td><span class="badge bg-success">Diklat F2</span></td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="sticky-action text-center">
                                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>