<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Data - SIMERAH KOJA</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f3f4f6; color: #1f2937; }

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
        
        .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; }
        .back-link { color: #6b7280; font-size: 14px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; margin-bottom: 10px; }
        .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 30px; }

        .detail-card { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 40px 50px; margin-bottom: 30px; }
        
        .section-header { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; margin-top: 25px; padding-bottom: 5px; border-bottom: 1px solid #e5e7eb; }
        .section-header::before { content: ''; width: 4px; height: 18px; background-color: #3b82f6; border-radius: 4px; }
        .section-header h3 { font-size: 16px; font-weight: 800; margin: 0; color: #111827; text-transform: uppercase; }

        /* SISTEM GRID DINAMIS (ANTI-BOLONG) */
        .pdf-grid { display: block; width: 100%; font-size: 0; margin-bottom: 10px; } 
        .pdf-item { display: inline-block; width: 49%; vertical-align: top; margin-bottom: 4px; font-size: 12px; page-break-inside: avoid; }
        .pdf-item-full { display: inline-block; width: 100%; vertical-align: top; margin-bottom: 4px; font-size: 12px; page-break-inside: avoid; }
        
        .pdf-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .pdf-table td { padding: 4px 2px; vertical-align: top; line-height: 1.4; word-wrap: break-word; }
        .td-icon { width: 25px; color: #0284c7; text-align: left; }
        .td-label { width: 140px; font-weight: 700; color: #4b5563; }
        .td-colon { width: 10px; font-weight: 700; color: #4b5563; }
        .td-value { font-weight: 600; color: #1f2937; }
        
        .sub-header { font-size: 13px; font-weight: 700; color: #0284c7; margin-top: 15px; margin-bottom: 10px; }
        .text-capitalize { text-transform: capitalize; }

        .btn-action-bottom { border-radius: 6px; font-weight: 700; font-size: 14px; padding: 10px 24px; border: none; }
        .btn-edit { background-color: #fbbf24; color: #92400e; text-decoration: none; }

        @media print {
            .navbar-internal, .sidebar, .btn-action-bottom, .back-link, .d-print-none { display: none !important; }
            .main-content { padding: 0; background-color: white; }
            .detail-card { box-shadow: none; border: 1px solid #e5e7eb; padding: 15px; margin: 0; }
        }
    </style>
</head>
<body>

    <nav class="navbar-internal d-print-none">
        <a href="#" class="nav-brand">
            <img src="/images/simerahkoja.png" alt="Logo Simerah">
            <span class="title">SIMERAH KOJA <span class="badge-internal">INTERNAL APP</span></span>
        </a>
        <div class="user-menu">
            <div class="user-profile">
                <span class="badge-role {{ Auth::user()->role ?? '' }}">{{ str_replace('_', ' ', Auth::user()->role ?? 'PEGAWAI') }}</span>
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
        <aside class="sidebar d-print-none">
            <a href="/internal/index" class="sidebar-item"><i class="fas fa-home"></i> Dashboard Utama</a>
            <a href="/internal/damtan/input-data" class="sidebar-item"><i class="fas fa-fire-extinguisher"></i> Input Data</a>
            <a href="/internal/damtan/data-laporan" class="sidebar-item active"><i class="fas fa-clipboard-list"></i> Data Laporan</a>
        </aside>

        <main class="main-content">
            <a href="/internal/damtan/data-laporan" class="back-link d-print-none"><i class="fas fa-arrow-left me-2"></i> Kembali ke Data Laporan</a>
            <h1 class="page-title d-print-none">Rincian Laporan Tervalidasi</h1>

            <div class="detail-card" id="report-content">
                
                <div id="pdf-header" style="display: none; text-align: center; margin-bottom: 25px; border-bottom: 3px double #111827; padding-bottom: 15px;">
                    <h2 style="margin: 0; font-weight: 800; color: #111827; font-size: 22px;">LAPORAN DATA PENYELAMATAN & KEBAKARAN</h2>
                    <p style="margin: 5px 0 0 0; font-size: 13px; font-weight: 600; color: #4b5563;">Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
                </div>

                <!-- TAB 1: INFORMASI DASAR -->
                <div class="section-header" style="margin-top: 0;"><h3>I. Informasi Dasar & Lokasi</h3></div>
                
                <div class="pdf-grid">
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-hashtag"></i></td><td class="td-label">Nomor Laporan</td><td class="td-colon">:</td><td class="td-value">{{ $laporan->nomor_laporan }}</td></tr></table>
                    </div>

                    @if(!empty($laporan->kategori_kejadian))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-layer-group"></i></td><td class="td-label">Kategori Umum</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $laporan->kategori_kejadian) }}</td></tr></table>
                    </div>
                    @endif

                    @php $kategori_sub = $laporan->kategori_kebakaran ?? $laporan->kategori_non_kebakaran; @endphp
                    @if(!empty($kategori_sub))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-fire"></i></td><td class="td-label">Sub-Kategori</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $kategori_sub) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->rincian_kategori_non_kebakaran))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-info-circle"></i></td><td class="td-label">Rincian Kategori</td><td class="td-colon">:</td><td class="td-value">{{ $laporan->rincian_kategori_non_kebakaran }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->prioritas))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-exclamation-circle"></i></td><td class="td-label">Tingkat Prioritas</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ $laporan->prioritas }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->nama_pelapor))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-user"></i></td><td class="td-label">Nama Pelapor</td><td class="td-colon">:</td><td class="td-value">{{ $laporan->nama_pelapor }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->media_pelaporan))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-headset"></i></td><td class="td-label">Media Pelaporan</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $laporan->media_pelaporan) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->alamat))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-map-signs"></i></td><td class="td-label">Alamat Kejadian</td><td class="td-colon">:</td><td class="td-value">{{ $laporan->alamat }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->koordinat))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-location-arrow"></i></td><td class="td-label">Titik Koordinat</td><td class="td-colon">:</td><td class="td-value">{{ $laporan->koordinat }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->jarak_tempuh) && $laporan->jarak_tempuh > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-route"></i></td><td class="td-label">Jarak Tempuh</td><td class="td-colon">:</td><td class="td-value">{{ $laporan->jarak_tempuh }} Km</td></tr></table>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Data Waktu Operasional</div>
                <div class="pdf-grid">
                    @if(!empty($laporan->waktu_kejadian))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-calendar-alt"></i></td><td class="td-label">Waktu Kejadian</td><td class="td-colon">:</td><td class="td-value">{{ \Carbon\Carbon::parse($laporan->waktu_kejadian)->format('d M Y, H:i') }} WIB</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_terima))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-clock"></i></td><td class="td-label">Terima Laporan</td><td class="td-colon">:</td><td class="td-value">{{ \Carbon\Carbon::parse($laporan->waktu_terima)->format('d M Y, H:i') }} WIB</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_berangkat))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-truck-moving"></i></td><td class="td-label">Berangkat Unit</td><td class="td-colon">:</td><td class="td-value">{{ \Carbon\Carbon::parse($laporan->waktu_berangkat)->format('d M Y, H:i') }} WIB</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_tiba))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-map-marker-alt"></i></td><td class="td-label">Tiba di Lokasi</td><td class="td-colon">:</td><td class="td-value">{{ \Carbon\Carbon::parse($laporan->waktu_tiba)->format('d M Y, H:i') }} WIB</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_selesai))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-flag-checkered"></i></td><td class="td-label">Operasi Selesai</td><td class="td-colon">:</td><td class="td-value">{{ \Carbon\Carbon::parse($laporan->waktu_selesai)->format('d M Y, H:i') }} WIB</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($laporan->waktu_kembali))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-building"></i></td><td class="td-label">Kembali ke Mako</td><td class="td-colon">:</td><td class="td-value">{{ \Carbon\Carbon::parse($laporan->waktu_kembali)->format('d M Y, H:i') }} WIB</td></tr></table>
                    </div>
                    @endif
                </div>

                <!-- TAB 2: TEKNIS & LOGISTIK -->
                <div class="section-header"><h3>II. Teknis Penyelamatan & Logistik Operasi</h3></div>

                <div class="pdf-grid">
                    @if(!empty($teknis->pimpinan_operasi))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-user-shield"></i></td><td class="td-label">Pimpinan Operasi</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->pimpinan_operasi }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->satuan_tugas))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-users-cog"></i></td><td class="td-label">Satuan Tugas / Regu</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->satuan_tugas }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->status_evakuasi))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-info-circle"></i></td><td class="td-label">Status Evakuasi</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $teknis->status_evakuasi) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty(json_decode($teknis->metode_evakuasi)))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-route"></i></td><td class="td-label">Metode Evakuasi</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $teknis->metode_evakuasi) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty(json_decode($teknis->metode_penyelamatan)))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-hands-helping"></i></td><td class="td-label">Met. Penyelamatan</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $teknis->metode_penyelamatan) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->objek_terdampak))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-house-damage"></i></td><td class="td-label">Objek Terdampak</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->objek_terdampak }}</td></tr></table>
                    </div>
                    @endif
                    
                    @if(!empty($teknis->jumlah_personel) && $teknis->jumlah_personel > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-users"></i></td><td class="td-label">Jumlah Anggota</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->jumlah_personel }} Personel</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->daftar_personel))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-user-tag"></i></td><td class="td-label">Anggota Terlibat</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->daftar_personel }}</td></tr></table>
                    </div>
                    @endif
                </div>

                @if(
                    (!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0) ||
                    (!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0) ||
                    (!empty($teknis->korban_berat) && $teknis->korban_berat > 0) ||
                    (!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0) ||
                    !empty($teknis->korban_hewan_aset)
                )
                <div class="sub-header">Data Korban & Aset</div>
                <div class="pdf-grid">
                    @if(!empty($teknis->korban_selamat) && $teknis->korban_selamat > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-user-check"></i></td><td class="td-label">Korban Selamat</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->korban_selamat }} Jiwa</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_ringan) && $teknis->korban_ringan > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-user-injured"></i></td><td class="td-label">Korban Luka Ringan</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->korban_ringan }} Jiwa</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_berat) && $teknis->korban_berat > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-procedures"></i></td><td class="td-label">Korban Luka Berat</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->korban_berat }} Jiwa</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_meninggal) && $teknis->korban_meninggal > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-user-times"></i></td><td class="td-label">Korban Meninggal</td><td class="td-colon">:</td><td class="td-value text-danger">{{ $teknis->korban_meninggal }} Jiwa</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->korban_hewan_aset))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-cat"></i></td><td class="td-label">Korban Hewan/Aset</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->korban_hewan_aset }}</td></tr></table>
                    </div>
                    @endif
                </div>
                @endif

                <div class="sub-header">Alat & Logistik Terpakai</div>
                <div class="pdf-grid">
                    @if(!empty(json_decode($teknis->armada)))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-truck"></i></td><td class="td-label">Armada Diturunkan</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace(['"', '[', ']'], '', $teknis->armada) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty(json_decode($teknis->peralatan)))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-toolbox"></i></td><td class="td-label">Peralatan Khusus</td><td class="td-colon">:</td><td class="td-value">{{ str_replace(['"', '[', ']'], '', $teknis->peralatan) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->peralatan_lain))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-tools"></i></td><td class="td-label">Peralatan Lainnya</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->peralatan_lain }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_air) && $teknis->liter_air > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-tint"></i></td><td class="td-label">Konsumsi Air</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->liter_air }} Liter</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_foam) && $teknis->liter_foam > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-soap"></i></td><td class="td-label">Konsumsi Foam</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->liter_foam }} Liter</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->liter_bbm) && $teknis->liter_bbm > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-gas-pump"></i></td><td class="td-label">Konsumsi BBM</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->liter_bbm }} Liter</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->konsumsi_alat))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-spray-can"></i></td><td class="td-label">Konsumsi Alat Umum</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->konsumsi_alat }}</td></tr></table>
                    </div>
                    @endif
                </div>

                <!-- FORCE PAGE BREAK FOR PDF -->
                <div class="html2pdf__page-break"></div>

                <!-- TAB 3: DOKUMENTASI & EVALUASI -->
                <div class="section-header" style="margin-top: 20px;"><h3>III. Analisis, Evaluasi & Dokumentasi Kejadian</h3></div>

                <div class="pdf-grid">
                    @if(!empty($teknis->langkah_penanganan))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-tasks"></i></td><td class="td-label">Langkah Penanganan</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->langkah_penanganan }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->hambatan_lapangan))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-exclamation-triangle"></i></td><td class="td-label">Hambatan Lapangan</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->hambatan_lapangan }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($teknis->hasil_tindakan))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-check-double"></i></td><td class="td-label">Hasil Tindakan</td><td class="td-colon">:</td><td class="td-value">{{ $teknis->hasil_tindakan }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->kronologi_lengkap))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-align-left"></i></td><td class="td-label">Kronologi Lengkap</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->kronologi_lengkap }}</td></tr></table>
                    </div>
                    @endif
                </div>

                <div class="sub-header">Investigasi Lapangan</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->dugaan_penyebab))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-bolt"></i></td><td class="td-label">Dugaan Penyebab</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $dokumentasi->dugaan_penyebab) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->dugaan_penyebab_lainnya))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-search"></i></td><td class="td-label">Penyebab Lainnya</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->dugaan_penyebab_lainnya }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->sumber_api))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-fire-alt"></i></td><td class="td-label">Sumber Api / Awal</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->sumber_api }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->luas_area) && $dokumentasi->luas_area > 0)
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-ruler-combined"></i></td><td class="td-label">Luas Area Terdampak</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->luas_area }} m²</td></tr></table>
                    </div>
                    @endif

                    @if(!empty(json_decode($dokumentasi->instansi_pendukung)))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-building"></i></td><td class="td-label">Instansi Pendukung</td><td class="td-colon">:</td><td class="td-value text-uppercase">{{ str_replace(['"', '[', ']', '_'], ['','','',' '], $dokumentasi->instansi_pendukung) }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->tindakan_instansi))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-hands-helping"></i></td><td class="td-label">Tindakan Instansi Lain</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->tindakan_instansi }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->kontak_saksi))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-phone-alt"></i></td><td class="td-label">Kontak Saksi/Warga</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->kontak_saksi }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->cara_bertindak))
                    <div class="pdf-item">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-clipboard-check"></i></td><td class="td-label">Cara Bertindak</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->cara_bertindak }}</td></tr></table>
                    </div>
                    @endif
                </div>

                @if(!empty($dokumentasi->kebutuhan_tambahan) || !empty($dokumentasi->saran_mitigasi))
                <div class="sub-header">Evaluasi Pasca Operasi</div>
                <div class="pdf-grid">
                    @if(!empty($dokumentasi->kebutuhan_tambahan))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-plus-circle"></i></td><td class="td-label">Kebutuhan Tambahan</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->kebutuhan_tambahan }}</td></tr></table>
                    </div>
                    @endif

                    @if(!empty($dokumentasi->saran_mitigasi))
                    <div class="pdf-item-full">
                        <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-lightbulb"></i></td><td class="td-label">Saran Mitigasi Warga</td><td class="td-colon">:</td><td class="td-value">{{ $dokumentasi->saran_mitigasi }}</td></tr></table>
                    </div>
                    @endif
                </div>
                @endif

                <!-- TAB 4: KATEGORI KHUSUS -->
                @if(!empty($khusus->jenis_hewan) || !empty($khusus->jenis_objek_tumbang) || !empty($khusus->kondisi_perairan) || !empty($khusus->jenis_benda_bahaya))
                <div class="section-header"><h3>IV. Rincian Modul Kategori Khusus</h3></div>

                    @if(!empty($khusus->jenis_hewan))
                    <div class="sub-header"><i class="fas fa-paw me-2"></i>Data Animal Rescue</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-paw"></i></td><td class="td-label">Jenis Hewan</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ $khusus->jenis_hewan }}</td></tr></table>
                        </div>
                        
                        @if(!empty($khusus->spesies_hewan))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-tag"></i></td><td class="td-label">Spesies / Lokal</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->spesies_hewan }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->dimensi_hewan))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-ruler"></i></td><td class="td-label">Dimensi / Panjang</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->dimensi_hewan }}</td></tr></table>
                        </div>
                        @endif
                        
                        @if(!empty($khusus->berat_hewan))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-balance-scale"></i></td><td class="td-label">Berat Hewan</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->berat_hewan }} Kg</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->status_hewan_pasca))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-share-square"></i></td><td class="td-label">Status Evakuasi</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_hewan_pasca) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->lokasi_pelepasan))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-map-marker-alt"></i></td><td class="td-label">Lokasi Pelepasan</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->lokasi_pelepasan }}</td></tr></table>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($khusus->jenis_objek_tumbang))
                    <div class="sub-header"><i class="fas fa-tree me-2"></i>Data Objek Tumbang/Bangunan</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-cube"></i></td><td class="td-label">Jenis Objek</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_objek_tumbang) }}</td></tr></table>
                        </div>

                        @if(!empty($khusus->dimensi_objek))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-expand-arrows-alt"></i></td><td class="td-label">Dimensi Objek</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->dimensi_objek }} cm</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->status_utilitas))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-plug"></i></td><td class="td-label">Utilitas Terkait</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->status_utilitas) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->dampak_properti))
                        <div class="pdf-item-full">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-house-damage"></i></td><td class="td-label">Dampak Properti</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->dampak_properti }}</td></tr></table>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($khusus->kondisi_perairan))
                    <div class="sub-header"><i class="fas fa-water me-2"></i>Data Water Rescue</div>
                    <div class="pdf-grid">
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-water"></i></td><td class="td-label">Kondisi Perairan</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_perairan) }}</td></tr></table>
                        </div>

                        @if(!empty($khusus->radius_pencarian))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-search-location"></i></td><td class="td-label">Radius Pencarian</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->radius_pencarian }} meter</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->metode_pencarian_air))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-binoculars"></i></td><td class="td-label">Metode Pencarian</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->metode_pencarian_air) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->daftar_penyelam))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-swimmer"></i></td><td class="td-label">Daftar Penyelam</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->daftar_penyelam }}</td></tr></table>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($khusus->jenis_benda_bahaya) || !empty($khusus->jenis_medan))
                    <div class="sub-header"><i class="fas fa-ring me-2"></i>Data Pelepasan Cincin & Geografis Lapangan</div>
                    <div class="pdf-grid">
                        @if(!empty($khusus->jenis_benda_bahaya))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-ring"></i></td><td class="td-label">Jenis Benda</td><td class="td-colon">:</td><td class="td-value">{{ $khusus->jenis_benda_bahaya }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->kondisi_anggota_tubuh))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-hand-paper"></i></td><td class="td-label">Kondisi Tubuh</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->kondisi_anggota_tubuh) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->alat_potong_cincin))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-cut"></i></td><td class="td-label">Alat Potong</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->alat_potong_cincin) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->cuaca_operasi))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-cloud-sun"></i></td><td class="td-label">Cuaca Operasi</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->cuaca_operasi) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->jenis_medan))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-mountain"></i></td><td class="td-label">Jenis Medan</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->jenis_medan) }}</td></tr></table>
                        </div>
                        @endif

                        @if(!empty($khusus->akses_lokasi))
                        <div class="pdf-item">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-road"></i></td><td class="td-label">Akses Lokasi</td><td class="td-colon">:</td><td class="td-value text-capitalize">{{ str_replace('_', ' ', $khusus->akses_lokasi) }}</td></tr></table>
                        </div>
                        @endif
                    </div>
                    @endif
                @endif

                <!-- TAB 5: DOKUMENTASI FOTO & VIDEO -->
                @if((!empty($dokumentasi->foto) && $dokumentasi->foto !== 'null' && $dokumentasi->foto !== '[]') || !empty($dokumentasi->video))
                <!-- PEMOTONG HALAMAN KHUSUS FOTO AGAR TIDAK TERPOTONG -->
                <div class="html2pdf__page-break"></div>
                <div class="section-header"><h3>V. Dokumentasi Lapangan</h3></div>
                
                @if(!empty($dokumentasi->foto) && $dokumentasi->foto !== 'null' && $dokumentasi->foto !== '[]')
                    @php $fotos = json_decode($dokumentasi->foto, true); @endphp
                    @if(is_array($fotos) && count($fotos) > 0)
                    <div class="sub-header"><i class="fas fa-camera me-2"></i>Lampiran Foto</div>
                    <div style="display: block; width: 100%; margin-bottom: 20px;">
                        @foreach($fotos as $foto)
                            <img src="{{ asset('uploads/damtan/foto/' . $foto) }}" style="display: inline-block; width: 48%; height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; margin-right: 1%; margin-bottom: 10px;">
                        @endforeach
                    </div>
                    @endif
                @endif

                @if(!empty($dokumentasi->video))
                    <div class="sub-header"><i class="fas fa-video me-2"></i>Lampiran Video</div>
                    <div class="pdf-grid">
                        <div class="pdf-item-full">
                            <table class="pdf-table"><tr><td class="td-icon"><i class="fas fa-file-video"></i></td><td class="td-label">File Terlampir</td><td class="td-colon">:</td><td class="td-value"><a href="{{ asset('uploads/damtan/video/' . $dokumentasi->video) }}" target="_blank" style="color: #0284c7; text-decoration: none;">{{ $dokumentasi->video }} <small>(Klik untuk memutar di browser)</small></a></td></tr></table>
                        </div>
                    </div>
                @endif
                @endif

                <!-- KESIMPULAN -->
                <div class="section-header"><h3>Kesimpulan & Dasar Pelaksanaan</h3></div>
                <div style="font-weight: 600; font-style: italic; color: #4b5563; font-size: 12px; line-height: 1.5; margin-left: 20px;">
                    Seluruh kegiatan Pelayanan Penyelamatan dan Pemadaman ini berpedoman pada Peraturan Menteri Dalam Negeri (Permendagri) Nomor 114 Tahun 2018 tentang Standar Teknis Pelayanan Dasar Pada Standar Pelayanan Minimal (SPM) Sub Urusan Kebakaran Daerah Kabupaten/Kota.
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top d-print-none" id="action-buttons-container" data-html2canvas-ignore="true">
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
                    <a href="/internal/damtan/edit-data/{{ $laporan->id }}" class="btn btn-action-bottom btn-edit shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Data Ini
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function downloadDetailPDF() {
            // 1. Scroll layar paling atas untuk mencegah offset bug
            window.scrollTo(0, 0);

            const element = document.getElementById('report-content');
            const pdfHeader = document.getElementById('pdf-header');
            const btnContainer = document.getElementById('action-buttons-container');
            const nav = document.querySelector('.navbar-internal');
            const sidebar = document.querySelector('.sidebar');

            // 2. Modifikasi DOM Langsung (Tanpa Clone yang bikin Blank)
            pdfHeader.style.display = 'block'; 
            btnContainer.style.display = 'none';
            if(nav) nav.style.display = 'none';
            if(sidebar) sidebar.style.display = 'none';

            // Bersihkan margin & bayangan elemen utama agar rapi saat difoto
            const originalPadding = element.style.padding;
            const originalMargin = element.style.margin;
            const originalShadow = element.style.boxShadow;
            element.style.padding = '10px 15px';
            element.style.margin = '0px';
            element.style.boxShadow = 'none';

            let nomorLaporan = "{{ $laporan->nomor_laporan }}";
            let filename = "Laporan_Penyelamatan_Lengkap_" + nomorLaporan + ".pdf";

            const opt = {
                margin:       [10, 10, 15, 10], 
                filename:     filename,
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 2, useCORS: true, scrollY: 0 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['css', 'legacy'] } 
            };

            // 3. JEDA WAKTU (500ms) WAJIB agar gambar termuat penuh sebelum diproses
            setTimeout(() => {
                html2pdf().set(opt).from(element).save().then(() => {
                    // 4. Kembalikan semua UI Web seperti semula
                    pdfHeader.style.display = 'none';
                    btnContainer.style.display = 'flex';
                    if(nav) nav.style.display = 'flex';
                    if(sidebar) sidebar.style.display = 'flex';
                    element.style.padding = originalPadding;
                    element.style.margin = originalMargin;
                    element.style.boxShadow = originalShadow;
                });
            }, 500); 
        }

function downloadDetailExcel() {
            // Membuat struktur tabel HTML untuk di-convert ke Excel (agar bentuknya rapi dan kotak-kotak)
            let tableHTML = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            tableHTML += '<head><meta charset="utf-8"></head><body>';
            tableHTML += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-family: Arial, sans-serif;">';
            
            // Header Judul Laporan
            tableHTML += '<tr><th colspan="2" style="background-color: #111827; color: #ffffff; font-size: 16px; height: 30px; text-align: center;">LAPORAN DATA PENYELAMATAN & KEBAKARAN</th></tr>';
            tableHTML += '<tr><th colspan="2" style="background-color: #10b981; color: #ffffff; height: 25px; text-align: center;">Nomor Laporan: {{ $laporan->nomor_laporan }}</th></tr>';
            
            // Header Nama Kolom
            tableHTML += '<tr>';
            tableHTML += '<th style="background-color: #f3f4f6; width: 200px; text-align: left;">Atribut Informasi</th>';
            tableHTML += '<th style="background-color: #f3f4f6; width: 400px; text-align: left;">Nilai / Data Laporan</th>';
            tableHTML += '</tr>';
            
            // Mengambil semua data informasi dari tampilan layar web
            let rows = document.querySelectorAll('.pdf-item table tr, .pdf-item-full table tr');
            
            rows.forEach(row => {
                let cells = row.querySelectorAll('td');
                // Mengambil nilai label (kiri) dan data (kanan)
                if(cells.length === 4) {
                    let label = cells[1].innerText.trim();
                    let value = cells[3].innerText.trim();
                    
                    if(label && value) {
                        // Memasukkan data ke dalam baris dan kolom Excel
                        tableHTML += `<tr><td style="font-weight: bold;">${label}</td><td>${value}</td></tr>`;
                    }
                }
            });

            tableHTML += '</table></body></html>';

            // Eksekusi Download sebagai file Excel Asli (.xls)
            let filename = "Laporan_Penyelamatan_Lengkap_{{ $laporan->nomor_laporan }}.xls";
            let blob = new Blob([tableHTML], { type: "application/vnd.ms-excel" });
            
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

function downloadDetailWord() {
            // Header dasar untuk MS Word
            let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Rincian Laporan</title></head><body style='font-family: Arial, sans-serif;'>";
            let footer = "</body></html>";
            
            // Membuat Kop Laporan
            let content = "<div style='text-align:center; margin-bottom: 20px;'>";
            content += "<h2 style='margin:0; padding:0; font-family: Arial, sans-serif;'>LAPORAN DATA PENYELAMATAN & KEBAKARAN</h2>";
            content += "<p style='margin:5px 0 0 0; font-size: 14px; font-family: Arial, sans-serif; color: #4b5563;'>Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>";
            content += "</div>";
            content += "<hr style='border: 1px solid black; margin-bottom: 20px;'>";
            
            // Membuat kerangka Tabel untuk Teks
            content += "<table border='1' cellpadding='6' cellspacing='0' style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 13px;'>";
            
            // Mengambil semua teks data (Bab I - IV)
            let rows = document.querySelectorAll('.pdf-item table tr, .pdf-item-full table tr');
            rows.forEach(row => {
                let cells = row.querySelectorAll('td');
                if(cells.length === 4) {
                    let label = cells[1].innerText.trim();
                    let value = cells[3].innerText.trim();
                    
                    if(label && value) {
                        content += `<tr>
                            <td style='width: 35%; font-weight: bold; background-color: #f3f4f6; vertical-align: top; padding: 8px;'>${label}</td>
                            <td style='width: 65%; vertical-align: top; padding: 8px;'>${value}</td>
                        </tr>`;
                    }
                }
            });
            content += "</table>";

            // --- PROSES FOTO & VIDEO DENGAN URL ASLI (ABSOLUT) ---
            let photos = document.querySelectorAll('img[src*="/uploads/damtan/foto/"]');
            let video = document.querySelector('a[href*="/uploads/damtan/video/"]');

            if(photos.length > 0 || video) {
                content += "<h3 style='margin-top: 30px; font-family: Arial, sans-serif; border-bottom: 1px solid #ccc; padding-bottom: 5px;'>V. Dokumentasi Lapangan</h3>";
                
                // Proses Foto dengan URL Asli Web
                if(photos.length > 0) {
                    content += "<div style='text-align: center; margin-bottom: 20px;'>";
                    
                    photos.forEach(img => {
                        // Mengambil URL asli gambar dari tag src (Contoh: http://127.0.0.1:8000/uploads/...)
                        let imageUrl = img.src; 
                        
                        // Memasukkan gambar ke dalam Word menggunakan URL Asli
                        content += `<img src="${imageUrl}" style="width: 300px; height: auto; margin: 10px; border: 2px solid #ccc;" />`;
                    });
                    
                    content += "</div>";
                }

                // Proses Video (Tautan Saja)
                if(video) {
                    content += `<p style='font-family: Arial, sans-serif; font-size: 13px;'><strong>Tautan Video Terlampir:</strong> <br> <a href="${video.href}" style="color: #0284c7;">${video.href}</a></p>`;
                }
            }
            
            // Eksekusi Download sebagai file .doc
            let blob = new Blob(['\ufeff', header + content + footer], { type: 'application/msword' });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "Laporan_Penyelamatan_Lengkap_{{ $laporan->nomor_laporan }}.doc";
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>