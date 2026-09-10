<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelatihan - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Script HTML2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 0.5px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 4px 8px; border-radius: 6px; font-weight: 700; margin-left: 10px; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 12px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #f8fafc; font-size: 14px; font-weight: 600; }
        .user-profile i { font-size: 22px; color: #94a3b8; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; gap: 5px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 10px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f1f5f9; color: #0f172a; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; border-left: 4px solid #2563eb; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 20px 0 10px 10px; letter-spacing: 1px; }
        .main-content { flex: 1; padding: 40px; }
        
        .pdf-container { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; padding: 40px; margin-top: 20px; }
        .detail-row { display: flex; padding: 12px 0; border-bottom: 1px dashed #e2e8f0; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { width: 35%; font-weight: 700; color: #64748b; font-size: 14px; display: flex; align-items: center; gap: 8px; }
        .detail-value { width: 65%; font-weight: 600; color: #1e293b; font-size: 15px; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">
            <span class="title">SIMERAH KOJA</span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}</span>
                <span>{{ Auth::user()->nama_lengkap ?? 'Rekan Kerja' }}</span>
                <i class="fas fa-user-circle"></i>
            </div>
            <a href="/internal/pencegahan/pelatihan" class="btn btn-outline-light btn-sm" style="border-radius: 8px; font-weight: 600;">Kembali</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>

            <div class="sidebar-title">Bagian Pencegahan</div>
            <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            <a href="/internal/pencegahan/pelatihan" class="sidebar-item active"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan & Pengembangan</a>
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="main-content">
            <div class="page-header">
                <a href="/internal/pencegahan/pelatihan" class="text-decoration-none" style="color: #64748b; font-size: 14px; font-weight: 600;"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Pelatihan</a>
                <h1 class="mt-2" style="font-weight: 800; color: #0f172a;">Rincian Data Pelatihan</h1>
            </div>

            <!-- AREA CETAK PDF -->
            <div class="pdf-container" id="area-cetak-pdf">
                <h4 class="mb-4" style="font-weight: 800; color: #0f172a; border-left: 4px solid #3b82f6; padding-left: 12px;">Informasi Pelatihan</h4>
                
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-chalkboard-teacher text-primary"></i> Nama Pelatihan</div>
                    <div class="detail-value">: {{ $data->nama_pelatihan ?? '-' }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-calendar-alt text-primary"></i> Tanggal Pelaksanaan</div>
                    <div class="detail-value">: {{ $data->tanggal_pelaksanaan ?? '-' }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-clock text-primary"></i> Waktu Pelaksanaan</div>
                    <div class="detail-value">: {{ $data->waktu_mulai ?? '-' }} s/d {{ $data->waktu_selesai ?? '-' }} WIB</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-map-marker-alt text-primary"></i> Lokasi</div>
                    <div class="detail-value">: {{ $data->lokasi ?? '-' }}</div>
                </div>

                <!-- Variabel sudah disesuaikan ke kategori_peserta -->
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-users text-primary"></i> Kategori Peserta</div>
                    <div class="detail-value">: {{ $data->kategori_peserta ?? '-' }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-user-plus text-primary"></i> Jumlah Peserta</div>
                    <div class="detail-value">: {{ $data->jumlah_peserta ?? '0' }} Orang</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-sticky-note text-warning"></i> Catatan</div>
                    <div class="detail-value">: {{ $data->catatan ?? 'Tidak ada catatan' }}</div>
                </div>

                <!-- Variabel sudah disesuaikan ke modul_pelatihan -->
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-file-archive text-danger"></i> Modul / Dokumen</div>
                    <div class="detail-value">
                        : 
                        @if(isset($data->modul_pelatihan) && $data->modul_pelatihan)
                            <span class="badge bg-success text-white px-2 py-1 rounded">File Tersedia</span>
                            <a href="{{ asset('uploads/pelatihan/' . $data->modul_pelatihan) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 ms-2" data-html2canvas-ignore="true" style="font-weight: 600;">
                                <i class="fas fa-download me-1"></i> Buka File
                            </a>
                        @else
                            <span class="text-muted fst-italic">Tidak ada dokumen dilampirkan.</span>
                        @endif
                    </div>
                </div>

                <!-- FOTO LAMPIRAN -->
                @if(isset($data->modul_pelatihan) && $data->modul_pelatihan)
                    @php
                        $ext = strtolower(pathinfo($data->modul_pelatihan, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
                    @endphp

                    @if($isImage)
                        <div class="mt-5 pt-4" style="border-top: 2px dashed #cbd5e1; page-break-inside: avoid;">
                            <h5 class="mb-4" style="font-weight: 800; color: #1e293b;">
                                <i class="fas fa-camera text-primary me-2"></i> Preview Lampiran
                            </h5>
                            <div class="text-center p-3" style="background-color: #f1f5f9; border-radius: 12px;">
                                <img src="{{ asset('uploads/pelatihan/' . $data->modul_pelatihan) }}" crossorigin="anonymous" alt="Dokumentasi" style="max-height: 450px; width: auto; max-width: 100%; object-fit: contain; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            
            <div class="d-flex justify-content-end gap-3 mt-4">
                <!-- Tombol Download PDF -->
                <button onclick="downloadLaporanPDF()" class="btn btn-danger px-4 py-2" style="border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-file-pdf me-2"></i> Download PDF
                </button>
                <a href="/internal/pencegahan/pelatihan/edit/{{ $data->id }}" class="btn btn-warning px-4 py-2 text-white" style="border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-edit me-2"></i> Edit Data
                </a>
            </div>
        </main>
    </div>

    <!-- Script PDF -->
    <script>
        function downloadLaporanPDF() {
            window.scrollTo(0, 0);
            const btn = document.querySelector('button[onclick="downloadLaporanPDF()"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses PDF...';

            const element = document.getElementById('area-cetak-pdf');
            const opt = {
                margin:       [0.5, 0.5, 0.5, 0.5],
                filename:     'Data_Pelatihan_{{ str_replace(" ", "_", $data->nama_pelatihan ?? "Laporan") }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, allowTaint: true, scrollY: 0 }, 
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            setTimeout(() => {
                html2pdf().set(opt).from(element).save().then(() => {
                    btn.innerHTML = originalText;
                });
            }, 600); 
        }
    </script>
</body>
</html>