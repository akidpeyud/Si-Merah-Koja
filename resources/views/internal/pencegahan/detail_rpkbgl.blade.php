<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail RPKBGL - SIMERAH KOJA</title>

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
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .badge-role.super_user { background: #ef4444; }

        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 20px; color: #9ca3af; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* --- SIDEBAR --- */
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

        /* --- MAIN AREA & CONTENT --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .detail-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 20px;}
        .detail-section-title { font-size: 15px; font-weight: 800; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 10px; margin-bottom: 20px; margin-top: 30px;}
        .detail-section-title:first-child { margin-top: 0; }
        
        .detail-label { font-size: 12px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .detail-value { font-size: 15px; font-weight: 600; color: #1f2937; margin-bottom: 20px; }
        
        .badge-status { padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 700; display: inline-block;}
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-diproses { background-color: #dbeafe; color: #2563eb; }
        .status-memenuhi { background-color: #d1fae5; color: #059669; }
        .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }
        
        .btn-download-doc { background-color: #f8fafc; border: 1px solid #cbd5e1; padding: 10px 15px; border-radius: 8px; display: inline-flex; align-items: center; gap: 10px; color: #334155; text-decoration: none; font-weight: 600; font-size: 13px; transition: 0.2s;}
        .btn-download-doc:hover { background-color: #f1f5f9; border-color: #94a3b8; color: #0f172a;}
        .btn-download-doc i { color: #ef4444; font-size: 18px;}

        /* --- CSS PRINT RULES --- */
        @media print {
            /* Sembunyikan elemen UI website */
            .navbar-internal, .sidebar, .btn-logout, .no-print { display: none !important; }
            
            /* Reset layout untuk kertas */
            .dashboard-container { display: block; width: 100%; }
            .main-content { padding: 0 !important; margin: 0 !important; background-color: white; width: 100%; }
            .detail-card { border: none !important; box-shadow: none !important; padding: 0 !important; width: 100%; }
            body { background-color: white; margin: 0; padding: 0; color: black; }
            
            /* Tampilkan header cetak */
            .d-print-block { display: block !important; }

            /* Paksa kolom tetap sejajar (karena bootstrap col-md kadang turun di PDF) */
            .row { display: flex !important; flex-wrap: wrap !important; }
            .col-md-6 { width: 50% !important; flex: 0 0 auto !important; }
            .col-md-3 { width: 25% !important; flex: 0 0 auto !important; }
            .col-md-12 { width: 100% !important; flex: 0 0 auto !important; }

            /* Hitam-putihkan teks agar jelas di cetak */
            .detail-section-title { color: black !important; border-bottom: 2px solid #000 !important; margin-top: 20px; }
            .detail-label { color: #444 !important; font-size: 11px !important; }
            .detail-value { color: black !important; font-size: 14px !important; margin-bottom: 15px !important; }
            
            /* Sembunyikan ikon FontAwesome yang tidak perlu di form cetak */
            .detail-section-title i { display: none !important; }
            
            /* Tampilkan status sebagai teks biasa saja */
            .badge-status { border: 1px solid #000; background: transparent !important; color: black !important; padding: 4px 8px; border-radius: 4px;}
        }
    </style>
</head>
<body>

    <!-- NAVBAR INTERNAL -->
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>

        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">
                    {{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}
                </span>
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
            <a href="/internal/index" class="sidebar-item">
                <i class="fas fa-home"></i> Dashboard Utama
            </a>

            @if(Auth::user()->role === 'user' || Auth::user()->role === 'super_user')
                <!-- ACCORDION PENCEGAHAN (Sedang Aktif) -->
                <button class="sidebar-collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePencegahan" aria-expanded="true">
                    <span>Bagian Pencegahan</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </button>
                <div class="collapse show" id="collapsePencegahan" data-bs-parent="#sidebarAccordion">
                    <div class="sidebar-submenu">
                        <a href="/internal/pencegahan/kelola-rpkbgl" class="sidebar-item active"><i class="fas fa-building"></i> Kelola RPKBGL</a>
                        <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
                        <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
                        <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
                        <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
                        <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users-cog"></i> Kelola Redkar</a>
                    </div>
                </div>

                <!-- ACCORDION PEMADAMAN -->
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
                        <a href="/sapra/data_hidrant_gedung" class="sidebar-item"><i class="fas fa-clipboard-list"></i> Data Hidrant</a>
                        <a href="/sapra/data-hidrant-kota" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Data Hidrant Kota Jambi</a>
                        <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-building"></i> Prasarana Mako & Pos</a>
                        <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Sarana Mako & Pos</a>
                        <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-box-open"></i> Logistik & Gudang</a>
                    </div>
                </div>
            @endif

            @if(Auth::user()->role === 'operator' || Auth::user()->role === 'super_user')
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
            <div class="page-header no-print">
                <div>
                    <h1>Detail Permohonan RPKBGL</h1>
                    <p>Menampilkan rincian data permohonan dari <strong>{{ $permohonan->nama_pemohon }}</strong></p>
                </div>
                <div class="d-flex gap-2">
                    <!-- TOMBOL CETAK FORM -->
                    <button onclick="window.print()" class="btn btn-primary fw-bold shadow-sm no-print">
                        <i class="fas fa-print me-2"></i> Cetak Form
                    </button>
                    <!-- TOMBOL KEMBALI -->
                    <a href="/internal/pencegahan/kelola-rpkbgl" class="btn btn-outline-secondary fw-bold shadow-sm no-print">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- HEADER KHUSUS PRINT (Tersembunyi di Web, Muncul di Kertas) -->
            <div class="d-none d-print-block text-center mb-4 pb-3" style="border-bottom: 3px solid #000;">
                <h3 class="fw-bold mb-1" style="font-size: 22px; text-transform: uppercase;">Data Permohonan RPKBGL</h3>
                <p class="mb-0" style="font-size: 14px;">Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
            </div>

            <div class="detail-card">
                
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="detail-section-title"><i class="fas fa-user-circle text-primary me-2"></i>Informasi Pemohon</h3>
                        
                        <div class="detail-label">Nama Pemohon</div>
                        <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>

                        <div class="detail-label">Alamat Email</div>
                        <div class="detail-value">{{ $permohonan->email_pemohon }}</div>

                        <div class="detail-label">Nomor WhatsApp</div>
                        <div class="detail-value">
                            {{ $permohonan->no_whatsapp }}
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $permohonan->no_whatsapp) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none no-print">Hubungi <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h3 class="detail-section-title"><i class="fas fa-store text-warning me-2"></i>Informasi Usaha</h3>

                        <div class="detail-label">Nama Usaha / Instansi</div>
                        <div class="detail-value">{{ $permohonan->nama_usaha }}</div>

                        <div class="detail-label">NIK Pemilik Usaha</div>
                        <div class="detail-value">{{ $permohonan->nik_pemilik_usaha }}</div>

                        <div class="detail-label">Alamat Pemilik Usaha</div>
                        <div class="detail-value">{{ $permohonan->alamat_pemilik_usaha }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="detail-section-title"><i class="fas fa-building text-success me-2"></i>Rincian Bangunan</h3>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Kategori Bangunan</div>
                        <div class="detail-value">{{ $permohonan->kategori_bangunan }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Luas Lahan (m²)</div>
                        <div class="detail-value">{{ $permohonan->luas_lahan }} m²</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Luas Bangunan (m²)</div>
                        <div class="detail-value">{{ $permohonan->luas_bangunan }} m²</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Tinggi Bangunan (m)</div>
                        <div class="detail-value">{{ $permohonan->tinggi_bangunan }} m</div>
                    </div>
                    <div class="col-md-12">
                        <div class="detail-label">Alamat Lengkap Bangunan</div>
                        <div class="detail-value">
                            {{ $permohonan->alamat_bangunan }}<br>
                            Kecamatan {{ $permohonan->kecamatan }}, Kelurahan {{ $permohonan->kelurahan }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h3 class="detail-section-title"><i class="fas fa-info-circle text-danger me-2"></i>Status Permohonan</h3>
                        <div class="detail-label">Status Saat Ini</div>
                        <div class="detail-value">
                            @if($permohonan->status_permohonan == 'Pending')
                                <span class="badge-status status-pending">Pending</span>
                            @elseif($permohonan->status_permohonan == 'Diproses')
                                <span class="badge-status status-diproses">Diproses Tim</span>
                            @elseif($permohonan->status_permohonan == 'Memenuhi Syarat')
                                <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                            @else
                                <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi Syarat</span>
                            @endif
                        </div>
                        <div class="detail-label">Tanggal Pengajuan</div>
                        <div class="detail-value">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>

                    <!-- Kolom Lampiran ini dihilangkan saat proses print kertas -->
                    <div class="col-md-6 no-print">
                        <h3 class="detail-section-title"><i class="fas fa-folder-open text-info me-2"></i>Berkas Lampiran</h3>
                        <div class="d-flex flex-column gap-2">
                            @if($permohonan->file_surat_permohonan)
                                <a href="{{ asset('storage/' . $permohonan->file_surat_permohonan) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-pdf"></i>
                                    <div>
                                        <div style="line-height: 1;">Lihat Surat Permohonan</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Berkas Wajib</small>
                                    </div>
                                </a>
                            @endif

                            @if($permohonan->file_persyaratan_lainnya)
                                <a href="{{ asset('storage/' . $permohonan->file_persyaratan_lainnya) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-archive" style="color: #8b5cf6;"></i>
                                    <div>
                                        <div style="line-height: 1;">Lihat Persyaratan Lainnya</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Lampiran Opsional</small>
                                    </div>
                                </a>
                            @else
                                <div class="text-muted" style="font-size: 13px; font-weight: 500;">
                                    <i class="fas fa-minus-circle me-1"></i> Tidak ada berkas lampiran tambahan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Fitur Auto Print jika tombol "Cetak Form" dari tabel luar ditekan
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('auto_print')) {
            setTimeout(function() { window.print(); }, 500);
        }
    }
</script>
</body>
</html>