<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Inspeksi Bangunan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

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

        /* MAIN AREA & FORM WRAPPER */
        .main-content { flex: 1; padding: 40px 50px 100px; background-color: #f9fafb; overflow-x: hidden; }
        
        .form-wrapper { background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 30px; margin-top: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 15px; transition: color 0.2s; }
        .back-link:hover { color: #0f172a; }

        /* Form Customization */
        .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 8px; }
        .form-control, .form-select { border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 15px; font-size: 14px; color: #334155; }
        .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); outline: none; }
        .form-control[type="file"] { padding: 8px 15px; }

        /* Select2 Kustomisasi */
        .select2-container--bootstrap-5 .select2-selection { font-size: 14px; padding: 6px 15px; min-height: 44px; border: 1px solid #cbd5e1; border-radius: 6px; }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
        .select2-results__group { font-weight: 800; color: #0f172a; background-color: #f1f5f9; padding: 8px 12px; font-size: 13px; }
        .select2-results__option { font-size: 14px; font-weight: 500; }
        
        .section-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 15px; margin-top: 25px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 8px; }
        .section-title.first { margin-top: 0; }
        
        .upload-group { background-color: #f8fafc; border: 1px dashed #cbd5e1; padding: 20px; border-radius: 8px; margin-bottom: 15px; }
        
        .btn-save { background-color: #0d6efd; color: white; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; border: none; transition: background-color 0.2s; }
        .btn-save:hover { background-color: #0b5ed7; }
        .btn-cancel { background-color: white; color: #475569; border: 1px solid #cbd5e1; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; transition: all 0.2s; }
        .btn-cancel:hover { background-color: #f1f5f9; color: #0f172a; }
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
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>

            <!-- ACCORDION PENCEGAHAN -->
            <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                <span>Bagian Pencegahan</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </button>
            <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">PENINGKATAN KAPASITAS APARATUR</a>
                    <a href="/internal/pencegahan/inspeksi-kebakaran" class="sidebar-item active" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">PENCEGAHAN KEBAKARAN DAN INSPEKSI</a>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat" class="sidebar-item" style="white-space: normal; line-height: 1.4; padding: 10px 15px;">PEMBERDAYAAN MASYARAKAT DAN DUNIA USAHA</a>
                </div>
            </div>

            <!-- ACCORDION PEMADAMAN & LAINNYA -->
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePemadaman"><span>Bagian Pemadaman</span><i class="fas fa-chevron-down toggle-icon"></i></button>
            <div class="collapse" id="collapsePemadaman" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
                    <a href="/internal/damtan/data-laporan" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
                </div>
            </div>

            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSapra"><span>Bagian Sapra</span><i class="fas fa-chevron-down toggle-icon"></i></button>
            <div class="collapse" id="collapseSapra" data-bs-parent="#sidebarAccordion">
                <div class="sidebar-submenu">
                    <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Sumber Air</a>
                    <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                </div>
            </div>
            
            <button class="sidebar-collapse-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerita"><span>Manajemen Berita</span><i class="fas fa-chevron-down toggle-icon"></i></button>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            
            <a href="javascript:history.back()" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Data Inspeksi Bangunan
            </a>

            <h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Form Tambah Inspeksi Bangunan</h1>

            <div class="form-wrapper">
                <form action="{{ route('inspeksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="section-title text-primary first"><i class="fas fa-building"></i> Informasi Bangunan & Usaha</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Tempat / Bangunan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_tempat" placeholder="Contoh: Hotel Infinity" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Jenis Bangunan / Usaha <span class="text-danger">*</span></label>
                            <select name="jenis_usaha" class="form-select select2-searchable" required>
                                <option value="" disabled selected></option>
                                
                                <optgroup label="Sebagai Tempat Tinggal">
                                    <option value="Rumah Tinggal Deret">Rumah Tinggal Deret</option>
                                    <option value="Rumah Tinggal Deret (MBR)">Rumah Tinggal Deret (MBR)</option>
                                    <option value="Rumah Tinggal Tunggal">Rumah Tinggal Tunggal</option>
                                    <option value="Rumah Tinggal Tunggal (MBR)">Rumah Tinggal Tunggal (MBR)</option>
                                    <option value="Rumah Susun">Rumah Susun</option>
                                    <option value="Rumah Susun (MBR)">Rumah Susun (MBR)</option>
                                </optgroup>

                                <optgroup label="Sebagai Tempat Pendidikan, Kebudayaan, dan Kesehatan">
                                    <option value="Bangunan Gedung Pendidikan">Bangunan Gedung Pendidikan (SD, SMP, SMA, PT, Terpadu)</option>
                                    <option value="Bangunan Gedung Kebudayaan">Bangunan Gedung Kebudayaan (Museum, Pameran, Kesenian)</option>
                                    <option value="Bangunan Gedung Kesehatan">Bangunan Gedung Kesehatan (Puskesmas, Klinik, RS, Lab)</option>
                                    <option value="Bangunan Gedung Pelayanan Umum Lainnya">Bangunan Gedung Pelayanan Umum Lainnya</option>
                                </optgroup>

                                <optgroup label="Sebagai Tempat Usaha">
                                    <option value="Bangunan Gedung Perkantoran">Bangunan Gedung Perkantoran</option>
                                    <option value="Bangunan Gedung Perdagangan">Bangunan Gedung Perdagangan</option>
                                    <option value="Bangunan Gedung Perindustrian">Bangunan Gedung Perindustrian</option>
                                    <option value="Bangunan Gedung Perhotelan">Bangunan Gedung Perhotelan</option>
                                    <option value="Bangunan Wisata dan Rekreasi">Bangunan Wisata dan Rekreasi</option>
                                    <option value="Bangunan Gedung Terminal">Bangunan Gedung Terminal</option>
                                    <option value="Bangunan Gedung Tempat Penyimpanan">Bangunan Gedung Tempat Penyimpanan</option>
                                    <option value="Bangunan Gedung Peternakan">Bangunan Gedung Peternakan</option>
                                    <option value="Bangunan Gedung Laboratorium">Bangunan Gedung Laboratorium (Bukan Faskes/Pendidikan)</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Inspeksi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_inspeksi" required>
                        </div>
                    </div>

                    <div class="section-title text-success"><i class="fas fa-file-upload"></i> Upload Dokumen Inspeksi</div>
                    
                    <div class="upload-group">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">1. Surat Perintah Tugas</label>
                                <input class="form-control" type="file" name="surat_perintah_tugas" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">2. Berita Acara</label>
                                <input class="form-control" type="file" name="berita_acara" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">3. Hasil Penilaian</label>
                                <input class="form-control" type="file" name="hasil_penilaian" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">4. Rekomendasi</label>
                                <input class="form-control" type="file" name="rekomendasi" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">5. SKK (Sertifikat Keselamatan Kebakaran)</label>
                                <input class="form-control" type="file" name="skk" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted" style="font-size: 12px;">Format: PDF/JPG/PNG</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
                        <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Simpan Data Inspeksi</button>
                    </div>

                </form>
            </div>
        </main>
    </div>

    <!-- JQUERY & BOOTSTRAP JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Inisialisasi Select2
        $(document).ready(function() {
            $('.select2-searchable').select2({
                theme: 'bootstrap-5',
                placeholder: "-- Pilih Jenis Bangunan / Usaha --",
                allowClear: true,
                width: '100%',
                dropdownPosition: 'below'
            });
        });
    </script>
</body>
</html>