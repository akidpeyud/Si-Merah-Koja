<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peningkatan - SIMERAH KOJA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        .navbar-internal { background-color: #0f172a; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
        .nav-brand { color: white; text-decoration: none; font-weight: 800; font-size: 18px; }
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; gap: 5px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 10px; }
        .sidebar-item.active { background-color: #eff6ff; color: #2563eb; border-left: 4px solid #2563eb; }
        .sidebar-title { font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin: 20px 0 10px 10px; }
        .main-content { flex: 1; padding: 40px; }
        .pdf-container { background: white; border-radius: 16px; border: 1px solid #e2e8f0; padding: 40px; margin-top: 20px; }
        .detail-row { display: flex; padding: 12px 0; border-bottom: 1px dashed #e2e8f0; }
        .detail-label { width: 35%; font-weight: 700; color: #64748b; font-size: 14px; }
        .detail-value { width: 65%; font-weight: 600; color: #1e293b; font-size: 15px; }
    </style>
</head>
<body>
    <nav class="navbar-internal">
        <a href="#" class="nav-brand">SIMERAH KOJA</a>
        <a href="/internal/pencegahan/peningkatan-kapasitas" class="btn btn-outline-light btn-sm fw-bold">Kembali</a>
    </nav>
    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <div class="sidebar-title">Bagian Pencegahan</div>
            <a href="/internal/pencegahan/layanan-inspeksi" class="sidebar-item"><i class="fas fa-clipboard-check"></i> Layanan Inspeksi</a>
            <a href="/internal/pencegahan/layanan-sosialisasi" class="sidebar-item"><i class="fas fa-bullhorn"></i> Layanan Sosialisasi</a>
            <a href="/internal/pencegahan/pelatihan" class="sidebar-item"><i class="fas fa-chalkboard-teacher"></i> Pelatihan</a>
            <a href="/internal/pencegahan/pembinaan-pengembangan" class="sidebar-item"><i class="fas fa-chart-line"></i> Pembinaan</a>
            <a href="/internal/pencegahan/peningkatan-kapasitas" class="sidebar-item active"><i class="fas fa-level-up-alt"></i> Peningkatan Kapasitas</a>
            <a href="/internal/pencegahan/kelola-redkar" class="sidebar-item"><i class="fas fa-users"></i> Kelola Redkar</a>
            
            <div class="sidebar-title">Bagian Pemadaman & Penyelamatan</div>
            <a href="#" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
            <a href="#" class="sidebar-item"><i class="fas fa-file-alt"></i> Data Laporan</a>
            
            <div class="sidebar-title">Bagian Sapra</div>
            <a href="/sapra/sarana-mako" class="sidebar-item"><i class="fas fa-truck"></i> Kelola Armada Mobil</a>
            <a href="/sapra/prasarana-mako" class="sidebar-item"><i class="fas fa-tools"></i> Maintenance Peralatan</a>
            <a href="/sapra/logistik" class="sidebar-item"><i class="fas fa-boxes"></i> Logistik & Gudang</a>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <h2 class="fw-bold text-dark">Rincian Data Peningkatan Kapasitas</h2>
            </div>
            <div class="pdf-container" id="area-cetak-pdf">
                <h4 class="mb-4 fw-bold text-dark" style="border-left: 4px solid #3b82f6; padding-left: 12px;">Informasi Diklat / Bimtek</h4>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-award text-primary me-2"></i> Nama Kegiatan</div>
                    <div class="detail-value">: {{ $data->nama_kegiatan ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-building text-primary me-2"></i> Penyelenggara</div>
                    <div class="detail-value">: {{ $data->penyelenggara ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-calendar-alt text-primary me-2"></i> Waktu Pelaksanaan</div>
                    <div class="detail-value">: {{ $data->tanggal_mulai ?? '-' }} s/d {{ $data->tanggal_selesai ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-tags text-primary me-2"></i> Jenis Kegiatan</div>
                    <div class="detail-value">: {{ $data->jenis_kegiatan ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-users text-primary me-2"></i> Pegawai Diutus</div>
                    <div class="detail-value">: {{ $data->jumlah_pegawai ?? '0' }} Orang</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-sticky-note text-warning me-2"></i> Catatan</div>
                    <div class="detail-value">: {{ $data->catatan ?? 'Tidak ada catatan' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-file-archive text-danger me-2"></i> Dokumen Terkait</div>
                    <div class="detail-value">: 
                        @if(isset($data->dokumen_terkait) && $data->dokumen_terkait)
                            <a href="{{ asset('uploads/peningkatan/' . $data->dokumen_terkait) }}" target="_blank" class="badge bg-primary text-decoration-none" data-html2canvas-ignore="true"><i class="fas fa-download me-1"></i> Buka File</a>
                        @else
                            <span class="text-muted fst-italic">Tidak ada</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button onclick="downloadPDF()" class="btn btn-danger fw-bold px-4 py-2"><i class="fas fa-file-pdf me-2"></i> Download PDF</button>
                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/{{ $data->id }}" class="btn btn-warning text-white fw-bold px-4 py-2"><i class="fas fa-edit me-2"></i> Edit Data</a>
            </div>
        </main>
    </div>

    <script>
        function downloadPDF() {
            const btn = document.querySelector('button[onclick="downloadPDF()"]');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
            const element = document.getElementById('area-cetak-pdf');
            const opt = { margin: 0.5, filename: 'Data_Kapasitas.pdf', image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale: 2 }, jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' } };
            html2pdf().set(opt).from(element).save().then(() => { btn.innerHTML = '<i class="fas fa-file-pdf me-2"></i> Download PDF'; });
        }
    </script>
</body>
</html>