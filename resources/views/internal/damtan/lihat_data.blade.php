<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Data - SIMERAH KOJA</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Library html2pdf.js untuk langsung Download PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

        /* --- NAVBAR & SIDEBAR (Bawaan) --- */
        .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
        .nav-brand img { height: 40px; }
        .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
        .badge-internal { background: #10b981; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: 700; margin-left: 10px; vertical-align: middle; }
        .badge-role { background: #3b82f6; color: white; font-size: 11px; padding: 4px 10px; border-radius: 50px; font-weight: 700; text-transform: uppercase; }
        .user-menu { display: flex; align-items: center; gap: 20px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        
        .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
        .sidebar { width: 280px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; }
        .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
        .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
        .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
        .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }

        /* --- STYLING HALAMAN DETAIL --- */
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .back-link { color: #6b7280; font-size: 14px; text-decoration: none; font-weight: 600; transition: color 0.2s; display: inline-flex; align-items: center; margin-bottom: 10px; }
        .back-link:hover { color: #111827; }
        .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 30px; }

        .detail-card { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 30px 40px; margin-bottom: 30px; }
        
        .section-header { display: flex; align-items: center; gap: 12px; margin-bottom: 25px; }
        .section-header::before { content: ''; width: 4px; height: 22px; background-color: #3b82f6; border-radius: 4px; }
        .section-header h3 { font-size: 18px; font-weight: 800; margin: 0; color: #111827; }

        .info-row { display: flex; margin-bottom: 16px; align-items: flex-start; }
        .info-label { width: 250px; color: #4b5563; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 12px; }
        .info-label i { color: #3b82f6; font-size: 16px; width: 20px; text-align: center; }
        .info-value { flex: 1; color: #1f2937; font-weight: 500; font-size: 14px; }
        
        .btn-action-bottom { border-radius: 6px; font-weight: 700; font-size: 14px; padding: 10px 24px; transition: all 0.2s; border: none; }
        .btn-edit { background-color: #fbbf24; color: #92400e; }
        .btn-edit:hover { background-color: #f59e0b; color: white; }

        /* --- DROPDOWN HOVER KUSTOM --- */
        .dropdown-menu { padding: 8px; border-radius: 10px; }
        .dropdown-item { border-radius: 6px; transition: all 0.2s ease-in-out; }
        .dropdown-item:hover, .dropdown-item:focus { background-color: #e0f2fe !important; }

        /* Sembunyikan elemen ini saat nge-print agar rapi */
        @media print {
            .navbar-internal, .sidebar, .btn-action-bottom, .back-link, .d-print-none { display: none !important; }
            .main-content { padding: 0; background-color: white; }
            .detail-card { box-shadow: none; border: 1px solid #e5e7eb; padding: 20px; }
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

    <div class="dashboard-container">
        <!-- SIDEBAR (Dipersingkat untuk contoh) -->
        <aside class="sidebar">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
            <a href="/internal/damtan/data-laporan" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="main-content">
            <a href="/internal/damtan/data-laporan" class="back-link"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <h1 class="page-title">Rincian Data Penyelamatan</h1>

            <!-- ID report-content digunakan untuk sasaran HTML2PDF -->
            <div class="detail-card" id="report-content">
                
                <!-- Kop laporan (hanya muncul saat di-download jadi PDF) -->
                <div id="pdf-header" style="display: none; text-align: center; margin-bottom: 30px; border-bottom: 2px solid #111827; padding-bottom: 10px;">
                    <h2 style="margin: 0; font-weight: bold; color: #111827;">RINCIAN DATA PENYELAMATAN</h2>
                    <p style="margin: 0; font-size: 14px; color: #4b5563;">Sistem Informasi Manajemen Pemadam Kebakaran & Penyelamatan (SIMERAH KOJA)</p>
                </div>

                <!-- Section 1 -->
                <div class="section-header"><h3>Informasi Objek Laporan</h3></div>
                
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-hashtag"></i> Nomor Laporan</div>
                    <div class="info-value">: {{ $laporan->nomor_laporan }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="far fa-calendar-alt"></i> Tanggal Kejadian</div>
                    <div class="info-value">: {{ $laporan->waktu_kejadian ? \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('d F Y') : '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="far fa-clock"></i> Waktu / Jam</div>
                    <div class="info-value">: {{ $laporan->waktu_kejadian ? \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('H:i') : '-' }} WIB</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-exclamation-triangle"></i> Kategori Kejadian</div>
                    <div class="info-value" style="text-transform: capitalize;">: {{ str_replace('_', ' ', $laporan->kategori_kejadian ?? '-') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap</div>
                    <div class="info-value">: {{ $laporan->alamat ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-thumbtack"></i> Koordinat Lokasi</div>
                    <div class="info-value">: {{ $laporan->koordinat ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-layer-group"></i> Tingkat Prioritas</div>
                    <div class="info-value" style="text-transform: capitalize;">: {{ $laporan->prioritas ?? 'Biasa' }}</div>
                </div>

                <!-- Section 2 -->
                <div class="section-header mt-5"><h3>Detail Teknis & Evakuasi</h3></div>

                <div class="info-row">
                    <div class="info-label"><i class="fas fa-shield-alt"></i> Status Evakuasi</div>
                    <div class="info-value" style="text-transform: capitalize;">: {{ $teknis->status_evakuasi ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-users"></i> Jumlah Personel Terlibat</div>
                    <div class="info-value">: {{ $teknis->jumlah_personel ?? '0' }} Orang</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-clipboard-list"></i> Hambatan Lapangan</div>
                    <div class="info-value">: {{ $teknis->hambatan_lapangan ?? 'Tidak ada hambatan.' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-paw"></i> Objek Hewan / Aset</div>
                    <div class="info-value">: {{ $teknis->korban_hewan_aset ?? '-' }}</div>
                </div>

                <!-- Action Buttons (Sejajar di Kanan Bawah) -->
                <!-- PERBAIKAN: data-html2canvas-ignore="true" ditambahkan di sini agar tombol 100% dihilangkan dari PDF -->
                <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top d-print-none" id="action-buttons-container" data-html2canvas-ignore="true">
                    
                    <!-- Tombol Dropdown Download -->
                    <div class="dropdown">
                        <button class="btn btn-action-bottom shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #0284c7; color: white; border: none;">
                            <i class="fas fa-download me-2"></i> Download Laporan
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="#" onclick="downloadDetailPDF()"><i class="fas fa-file-pdf me-2"></i> Format PDF</a></li>
                            <li><a class="dropdown-item py-2 text-success fw-bold" href="#" onclick="downloadDetailExcel()"><i class="fas fa-file-excel me-2"></i> Format Excel</a></li>
                            <li><a class="dropdown-item py-2 text-primary fw-bold" href="#" onclick="downloadDetailWord()"><i class="fas fa-file-word me-2"></i> Format Word</a></li>
                        </ul>
                    </div>

                    <!-- Tombol Edit -->
                    <a href="/internal/damtan/edit-data/{{ $laporan->id }}" class="btn btn-action-bottom btn-edit shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Data Ini
                    </a>
                </div>
            </div>

        </main>
    </div>

    <!-- Script Bootstrap & Download File Explorer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        // --- 1. FUNGSI DOWNLOAD PDF (Langsung via html2pdf) ---
        function downloadDetailPDF() {
            // Targetkan kotak detail card
            const element = document.getElementById('report-content');
            const pdfHeader = document.getElementById('pdf-header');
            
            // Tampilkan judul kop laporan khusus PDF
            pdfHeader.style.display = 'block'; 

            // Pengaturan PDF
            let nomorLaporan = "{{ $laporan->nomor_laporan }}";
            let filename = "Detail_Laporan_" + nomorLaporan + ".pdf";

            const opt = {
                margin:       15,
                filename:     filename,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Proses pemuatan PDF
            html2pdf().set(opt).from(element).save().then(() => {
                // Sembunyikan kop surat lagi setelah PDF berhasil didownload
                pdfHeader.style.display = 'none';
            });
        }


        // --- 2. FUNGSI DOWNLOAD EXCEL (CSV) ---
        function downloadDetailExcel() {
            let csvContent = "Atribut Informasi;Nilai / Data\n"; 
            let rows = document.querySelectorAll('.info-row');
            
            rows.forEach(row => {
                let label = row.querySelector('.info-label').innerText.trim();
                let value = row.querySelector('.info-value').innerText.trim();
                if(value.startsWith(':')) value = value.substring(1).trim();
                csvContent += '"' + label + '";"' + value + '"\n';
            });

            let filename = "Detail_Laporan_{{ $laporan->nomor_laporan }}.csv";
            let blob = new Blob(["\uFEFF" + csvContent], { type: "text/csv;charset=utf-8;" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }


        // --- 3. FUNGSI DOWNLOAD WORD (.DOC) ---
        function downloadDetailWord() {
            let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
                         "xmlns:w='urn:schemas-microsoft-com:office:word' " +
                         "xmlns='http://www.w3.org/TR/REC-html40'>" +
                         "<head><meta charset='utf-8'><title>Rincian Laporan</title></head><body style='font-family: Arial, sans-serif;'>";
            
            let footer = "</body></html>";
            let content = "<h2 style='text-align:center;'>Rincian Data Penyelamatan</h2>";
            content += "<h4 style='text-align:center;'>Nomor Laporan: {{ $laporan->nomor_laporan }}</h4><hr><ul style='list-style-type: none; padding: 0;'>";
            
            let rows = document.querySelectorAll('.info-row');
            rows.forEach(row => {
                let label = row.querySelector('.info-label').innerText.trim();
                let value = row.querySelector('.info-value').innerText.trim();
                if(value.startsWith(':')) value = value.substring(1).trim();
                
                content += "<li style='margin-bottom: 10px;'><strong>" + label + " :</strong> " + value + "</li>";
            });
            content += "</ul>";
            
            let html = header + content + footer;
            let filename = "Detail_Laporan_{{ $laporan->nomor_laporan }}.doc";
            
            let blob = new Blob(['\ufeff', html], { type: 'application/msword' });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>