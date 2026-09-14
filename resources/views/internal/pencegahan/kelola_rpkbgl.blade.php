<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola RPKBGL - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- GLOBAL ALERT STYLES --- */
        #globalSuccessAlert {
            position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
            background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); z-index: 99999;
            display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
            animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #globalSuccessAlert .alert-icon { font-size: 22px; }
        .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; margin-left: 10px; cursor: pointer; }
        @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

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

        /* --- MAIN AREA & TABLE --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }

        .content-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .table th { background-color: #f8fafc; color: #4b5563; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; padding: 15px 10px; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: 15px 10px; vertical-align: middle; font-size: 13px; color: #1f2937; border-bottom: 1px solid #e5e7eb; }
        
        .badge-status { padding: 6px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; display: inline-block;}
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-diproses { background-color: #dbeafe; color: #2563eb; }
        .status-memenuhi { background-color: #d1fae5; color: #059669; }
        .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }
        
        .btn-print-rekap { background-color: #3b82f6; color: white; font-weight: 700; font-size: 13px; padding: 10px 20px; border-radius: 8px; border: none; transition: 0.2s; cursor: pointer; }
        .btn-print-rekap:hover { background-color: #2563eb; color: white; }

        /* --- STYLING TOMBOL AKSI BARU --- */
        .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
        .btn-action { 
            display: inline-flex; align-items: center; justify-content: center; 
            width: 100%; padding: 7px 10px; border-radius: 6px; 
            font-weight: 700; font-size: 11px; border: none; text-decoration: none; 
            transition: all 0.2s; cursor: pointer; color: white;
        }
        .btn-action i { font-size: 12px; }
        .btn-action:hover { opacity: 0.9; color: white; transform: translateY(-1px); }
        .bg-detail { background-color: #3b82f6; }
        .bg-status { background-color: #10b981; }
        .bg-cetak { background-color: #64748b; }

        @media print {
            .navbar-internal, .sidebar, .btn-print-rekap, .btn-logout, .page-header p { display: none !important; }
            .no-print-col { display: none !important; } 
            .dashboard-container { display: block; }
            .main-content { padding: 0 !important; margin: 0 !important; background-color: white; }
            .content-card { border: none; box-shadow: none; padding: 0; }
            body { background-color: white; margin: 0; padding: 0; }
            .page-header h1 { font-size: 20px; text-align: center; margin-bottom: 20px; }
            table { width: 100% !important; border-collapse: collapse; }
            table th, table td { border: 1px solid #000 !important; padding: 8px !important; font-size: 11px !important; }
        }
    </style>
</head>
<body>

    <!-- ALERT SUCCESS GLOBAL -->
    @if(session('success'))
        <div id="globalSuccessAlert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button class="btn-close-alert" onclick="closeAlert('globalSuccessAlert')"><i class="fas fa-times"></i></button>
        </div>
        <script>
            function closeAlert(id) {
                let alertBox = document.getElementById(id);
                if(alertBox) {
                    alertBox.style.animation = 'fadeOutUpCenter 0.4s ease forwards';
                    setTimeout(() => alertBox.remove(), 400); 
                }
            }
            setTimeout(() => closeAlert('globalSuccessAlert'), 4000);
        </script>
    @endif

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

        <!-- MAIN AREA (TABEL RPKBGL) -->
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1>Daftar Permohonan RPKBGL</h1>
                    <p>Data pengajuan Rekomendasi Proteksi Kebakaran Bangunan Gedung & Lingkungan dari masyarakat.</p>
                </div>
                <div>
                    <button onclick="window.print()" class="btn-print-rekap shadow-sm"><i class="fas fa-print me-2"></i>Cetak Rekap</button>
                </div>
            </div>

            <div class="content-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Pemohon</th>
                                <th>Nama Usaha & Lokasi</th>
                                <th>Kategori Bangunan</th>
                                <th>Status Berkas</th>
                                <th class="no-print-col text-center">Lampiran PDF</th>
                                <th class="text-center no-print-col" width="140px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permohonan as $p)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary">{{ $p->nama_pemohon }}</div>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:600;">
                                        <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                    </a><br>
                                    <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                    <div class="text-muted" style="font-size: 11px;">
                                        Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $p->kategori_bangunan }}</div>
                                    <div class="text-muted" style="font-size: 11px;">
                                        Lahan: {{ $p->luas_lahan }}m² | L.Bangunan: {{ $p->luas_bangunan }}m²
                                    </div>
                                </td>
                                <td>
                                    @if($p->status_permohonan == 'Pending')
                                        <span class="badge-status status-pending">Pending</span>
                                    @elseif($p->status_permohonan == 'Diproses')
                                        <span class="badge-status status-diproses">Diproses Tim</span>
                                    @elseif($p->status_permohonan == 'Memenuhi Syarat')
                                        <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                                    @else
                                        <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi</span>
                                    @endif
                                </td>
                                <td class="no-print-col text-center">
                                    @if($p->file_surat_permohonan)
                                        <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="badge bg-danger text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat Permohonan</a>
                                    @endif
                                    
                                    @if($p->file_persyaratan_lainnya)
                                        <br>
                                        <a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="badge bg-secondary text-decoration-none"><i class="fas fa-paperclip"></i> Syarat Lainnya</a>
                                    @else
                                        <br>
                                        <span class="text-muted" style="font-size: 10px;">(Tanpa lampiran lain)</span>
                                    @endif
                                </td>
                                <td class="no-print-col">
                                    
                                    <!-- TOMBOL AKSI BARU (SUDAH DIRAPIKAN) -->
                                    <div class="btn-action-group">
                                        <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}" class="btn-action bg-detail">
                                            <i class="fas fa-search me-1"></i> Detail Data
                                        </a>
                                        <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalUpdateStatus{{ $p->id }}">
                                            <i class="fas fa-edit me-1"></i> Ubah Status
                                        </button>
                                        <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}?auto_print=true" target="_blank" class="btn-action bg-cetak">
                                            <i class="fas fa-print me-1"></i> Cetak Form
                                        </a>
                                    </div>
                                    <!-- END TOMBOL AKSI BARU -->

                                </td>
                            </tr>

                            <!-- MODAL UPDATE STATUS -->
                            <div class="modal fade" id="modalUpdateStatus{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold" style="font-size: 16px;">Update Status RPKBGL</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/internal/pencegahan/kelola-rpkbgl/update-status/{{ $p->id }}" method="POST">
                                            @csrf
                                            <div class="modal-body text-start">
                                                <p class="mb-3 text-muted" style="font-size: 13px;">Ubah status berkas pengajuan untuk instansi/usaha <strong>{{ $p->nama_usaha }}</strong> milik Saudara/i <strong>{{ $p->nama_pemohon }}</strong>.</p>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold" style="font-size: 13px;">Pilih Status Baru</label>
                                                    <select name="status_permohonan" class="form-select" required>
                                                        <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                        <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                        <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL -->

                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open mb-2" style="font-size: 30px; color:#cbd5e1;"></i><br>
                                    Belum ada data permohonan RPKBGL yang masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>