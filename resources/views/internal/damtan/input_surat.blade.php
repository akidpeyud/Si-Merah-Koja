<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Surat Keterangan Korban - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- NAVBAR INTERNAL --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR & ACCORDION STYLES --- */
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        
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

        /* --- MAIN AREA & TABS --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin: 0; }

        /* --- STYLING FORM MODERN --- */
        .field-label { font-size: 13px; font-weight: 700; color: #0284c7; margin-bottom: 8px; display: inline-flex; align-items: center; }
        .field-label i { margin-right: 8px; font-size: 14px; }
        
        .form-control, .form-select { border-radius: 8px; background-color: #f4f9ff; border: 1px solid #bfdbfe; padding: 10px 15px; font-size: 14px; color: #1e293b; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s ease-in-out; }
        .form-control:focus, .form-select:focus { background-color: #ffffff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
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
        
        <!-- SIDEBAR TERINTEGRASI -->
        <aside class="sidebar" id="sidebarAccordion">
            <a href="/internal/index" class="sidebar-item {{ Request::is('internal/index') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            <!-- BAGIAN KHUSUS USER & SUPER USER -->
            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <!-- ACCORDION PENCEGAHAN -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="false">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN (DAMTAN) -->
                <button class="sidebar-collapse-btn {{ Request::is('internal/damtan*') || Request::is('internal/surat*') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman" aria-expanded="true">
                    <span>Bagian Pemadaman</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                        <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                        <!-- Menu Baru Untuk Surat -->
                        <a href="/internal/surat-korban/create" class="sidebar-item active"><i class="fas fa-file-signature"></i> Buat Surat Korban</a>
                    </div>
                </div>

                <!-- ACCORDION SAPRA -->
                <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra" aria-expanded="false">
                    <span>Bagian Sapra</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Mako & Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Mako & Pos</a>
                        <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
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
                    @if(Auth::user()->role === 'super_user')
                        <a href="/internal/kelola-user" class="sidebar-item"><i class="fas fa-users"></i> Kelola Semua Pengguna</a>
                    @endif
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="page-header">
                <h1>Pembuatan Surat Keterangan</h1>
                <p>Formulir penerbitan Surat Keterangan Korban Kebakaran resmi Disdamkartan.</p>
            </div>

            <!-- Bagian Form Input Keterangan Korban -->
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white pt-4 pb-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-primary" style="font-size: 18px;"><i class="fas fa-file-signature me-2"></i> Buat Surat Keterangan Korban</h5>
                </div>
                <div class="card-body p-4">
                    <form action="/internal/surat-korban/store" method="POST">
                        @csrf
                        
                        <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">A. Data Diri Korban</h6>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="field-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                                <input type="text" name="nama_korban" class="form-control" placeholder="Cth: MAHILLI" required>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label"><i class="fas fa-home"></i> Status Kepemilikan</label>
                                <input type="text" name="status_kepemilikan" class="form-control" placeholder="Cth: Pemilik Bangunan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label"><i class="fas fa-id-card"></i> NIK (Nomor Induk Kependudukan)</label>
                                <input type="number" name="nik" class="form-control" placeholder="Cth: 1571023112590461" required>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" placeholder="Cth: Pensiunan" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Cth: Lubuk Resam" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar-alt"></i> Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-ring"></i> Status Perkawinan</label>
                                <select class="form-select" name="status_perkawinan" required>
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <option value="Kawin Tercatat">Kawin Tercatat</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="2" required placeholder="Jl. HM. Yusuf Nasri RT. 07 Kel. Wijaya Pura Kec. Jambi Selatan..."></textarea>
                            </div>
                        </div>

                        <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3 mt-5">B. Detail Kejadian & Surat</h6>
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-fire"></i> Objek Terbakar</label>
                                <input type="text" name="objek_terbakar" class="form-control" placeholder="Cth: Bangunan / Rumah Tinggal" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar-day"></i> Hari Kejadian</label>
                                <select class="form-select" name="hari_kejadian" required>
                                    <option value="" disabled selected>-- Pilih Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar"></i> Tanggal Kejadian</label>
                                <input type="date" name="tanggal_kejadian" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-clock"></i> Waktu Kejadian (WIB)</label>
                                <input type="time" name="waktu_kejadian" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Camat</label>
                                <input type="text" name="tembusan_camat" class="form-control" placeholder="Cth: Jambi Selatan">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Lurah</label>
                                <input type="text" name="tembusan_lurah" class="form-control" placeholder="Cth: Wijaya Pura">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5 pt-3 border-top">
                            <button type="reset" class="btn btn-light me-3 fw-bold text-secondary px-4 py-2" style="border-radius: 8px;">Reset Form</button>
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2 shadow-sm" style="background-color: #0284c7; border: none; border-radius: 8px;">
                                <i class="fas fa-file-pdf me-2"></i> Simpan & Buat Surat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>