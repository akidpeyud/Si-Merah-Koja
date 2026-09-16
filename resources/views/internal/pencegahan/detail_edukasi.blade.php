<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Edukasi - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; margin-left: 10px; }
        
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; }

        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #111827; margin-bottom: 5px; }

        .detail-card { background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .detail-section-title { font-size: 15px; font-weight: 800; color: #111827; border-bottom: 2px solid #f3f4f6; padding-bottom: 10px; margin-bottom: 20px; margin-top: 30px;}
        .detail-section-title:first-child { margin-top: 0; }
        
        .detail-label { font-size: 12px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .detail-value { font-size: 15px; font-weight: 600; color: #1f2937; margin-bottom: 20px; }
        
        .badge-status { padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 700; display: inline-block;}
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-disetujui { background-color: #d1fae5; color: #059669; }
        .status-ditolak { background-color: #fee2e2; color: #dc2626; }
        
        .btn-download-doc { background-color: #f8fafc; border: 1px solid #cbd5e1; padding: 10px 15px; border-radius: 8px; display: inline-flex; align-items: center; gap: 10px; color: #334155; text-decoration: none; font-weight: 600; font-size: 13px; transition: 0.2s;}
        .btn-download-doc:hover { background-color: #f1f5f9; border-color: #94a3b8; color: #0f172a;}
        .btn-download-doc i { font-size: 18px;}

        @media print {
            .navbar-internal, .sidebar, .no-print { display: none !important; }
            .dashboard-container { display: block; width: 100%; }
            .main-content { padding: 0 !important; margin: 0 !important; background-color: white; width: 100%; }
            .detail-card { border: none !important; box-shadow: none !important; padding: 0 !important; width: 100%; }
            body { background-color: white; margin: 0; padding: 0; color: black; }
            .d-print-block { display: block !important; }
            .row { display: flex !important; flex-wrap: wrap !important; }
            .col-md-6 { width: 50% !important; flex: 0 0 auto !important; }
            .col-md-3 { width: 25% !important; flex: 0 0 auto !important; }
            .col-md-12 { width: 100% !important; flex: 0 0 auto !important; }
            .detail-section-title { color: black !important; border-bottom: 2px solid #000 !important; margin-top: 20px; }
            .detail-label { color: #444 !important; font-size: 11px !important; }
            .detail-value { color: black !important; font-size: 14px !important; margin-bottom: 15px !important; }
            .detail-section-title i { display: none !important; }
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
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="dashboard-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <a href="/internal/pencegahan/kelola-edukasi" class="sidebar-item active"><i class="fas fa-bullhorn"></i> Kelola Edukasi</a>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <div class="page-header no-print">
                <div>
                    <h1>Detail Edukasi & Sosialisasi</h1>
                    <p>Menampilkan rincian data permohonan dari <strong>{{ $permohonan->institusi }}</strong></p>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-primary fw-bold shadow-sm no-print">
                        <i class="fas fa-print me-2"></i> Cetak Form
                    </button>
                    <a href="/internal/pencegahan/kelola-edukasi" class="btn btn-outline-secondary fw-bold shadow-sm no-print">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- HEADER KHUSUS PRINT -->
            <div class="d-none d-print-block text-center mb-4 pb-3" style="border-bottom: 3px solid #000;">
                <h3 class="fw-bold mb-1" style="font-size: 22px; text-transform: uppercase;">Form Permohonan Edukasi & Sosialisasi</h3>
                <p class="mb-0" style="font-size: 14px;">Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
            </div>

            <div class="detail-card">
                
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="detail-section-title"><i class="fas fa-building text-primary me-2"></i>Informasi Institusi</h3>
                        
                        <div class="detail-label">Nama Institusi / Sekolah</div>
                        <div class="detail-value">{{ $permohonan->institusi }}</div>

                        <div class="detail-label">Alamat Lengkap Institusi</div>
                        <div class="detail-value">
                            {{ $permohonan->alamat_institusi }}<br>
                            Kecamatan {{ $permohonan->kecamatan }}, Kelurahan {{ $permohonan->kelurahan }}
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h3 class="detail-section-title"><i class="fas fa-user-tie text-warning me-2"></i>Penanggung Jawab</h3>

                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $permohonan->nama_pemohon }} ({{ $permohonan->jabatan_pemohon }})</div>

                        <div class="detail-label">NIK Penanggung Jawab</div>
                        <div class="detail-value">{{ $permohonan->nik }}</div>

                        <div class="detail-label">Nomor Kontak / WhatsApp</div>
                        <div class="detail-value">
                            {{ $permohonan->no_kontak }}
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $permohonan->no_kontak) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none no-print">Hubungi <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="detail-section-title"><i class="fas fa-users text-success me-2"></i>Rencana Kegiatan & Peserta</h3>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="detail-label text-danger" style="font-size: 14px;">Jadwal Rencana Pelaksanaan</div>
                        <div class="detail-value fw-bold fs-4" style="color: #ec4899;">{{ \Carbon\Carbon::parse($permohonan->tgl_kegiatan)->format('d F Y') }}</div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="detail-label">Usia 3-6 Tahun</div>
                        <div class="detail-value">{{ $permohonan->usia_3_6 }} Orang</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Usia 7-12 Tahun</div>
                        <div class="detail-value">{{ $permohonan->usia_7_12 }} Orang</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Usia 13-18 Tahun</div>
                        <div class="detail-value">{{ $permohonan->usia_13_18 }} Orang</div>
                    </div>
                    <div class="col-md-3">
                        <div class="detail-label">Usia 18+ Tahun</div>
                        <div class="detail-value">{{ $permohonan->usia_18_keatas }} Orang</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h3 class="detail-section-title"><i class="fas fa-info-circle text-danger me-2"></i>Status Permohonan</h3>
                        <div class="detail-label">Status Saat Ini</div>
                        <div class="detail-value">
                            @if($permohonan->status_permohonan == 'Pending')
                                <span class="badge-status status-pending">Pending</span>
                            @elseif($permohonan->status_permohonan == 'Disetujui')
                                <span class="badge-status status-disetujui">Disetujui / Terjadwal</span>
                            @else
                                <span class="badge-status status-ditolak">Ditolak</span>
                            @endif
                        </div>
                        <div class="detail-label">Tanggal Pengajuan Masuk</div>
                        <div class="detail-value">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>

                    <div class="col-md-6 no-print">
                        <h3 class="detail-section-title"><i class="fas fa-folder-open text-info me-2"></i>Berkas Lampiran</h3>
                        <div class="d-flex flex-column gap-2">
                            @if($permohonan->surat_permohonan)
                                <a href="{{ asset('storage/' . $permohonan->surat_permohonan) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-pdf text-danger"></i>
                                    <div>
                                        <div style="line-height: 1;">Lihat Surat Permohonan</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Berkas Wajib</small>
                                    </div>
                                </a>
                            @endif

                            @if($permohonan->syarat_lainnya)
                                <a href="{{ asset('storage/' . $permohonan->syarat_lainnya) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-archive" style="color: #8b5cf6;"></i>
                                    <div>
                                        <div style="line-height: 1;">Lihat Persyaratan Lainnya</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">(Proposal/Data Tambahan)</small>
                                    </div>
                                </a>
                            @else
                                <div class="text-muted" style="font-size: 13px; font-weight: 500;">
                                    <i class="fas fa-minus-circle me-1"></i> Tidak ada file syarat tambahan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Script Auto Print -->
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('auto_print')) {
                setTimeout(function() { window.print(); }, 500);
            }
        }
    </script>
</body>
</html>