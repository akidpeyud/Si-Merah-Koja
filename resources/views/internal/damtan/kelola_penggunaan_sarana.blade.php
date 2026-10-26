@extends('layouts.dashboard')

@section('title', 'Kelola Penggunaan Sarana')

@push('styles')
<style>
    :root {
        --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
        --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
        --paper: #f5f7fa; --white: #ffffff;
        --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
        --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
        --steel: #64748b; --steel-soft: #94a3b8;
        --line: #e2e8f0; --line-dark: #cbd5e1;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
        --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
        --sidebar-w: 272px; --topbar-h: 70px;
        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
        --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);

        --rekap-red: #163a63;        /* navy */
        --rekap-red-light: #163a63;  /* navy */
        --rekap-row-a: #eaf2fc;
        --rekap-row-b: #f8fbff;
        --rekap-line: #d3deee;

        --excel: #107c41;
        --excel-soft: rgba(16, 124, 65, .10);
    }

    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }

    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }

    .page-header {
        position: relative;
        z-index: 30;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; }

    .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::placeholder { color: var(--steel-soft); }
    .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }

    /* Tombol utama (Buat Laporan Baru) - biru */
    .btn-custom-primary {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 44px; padding: 0 24px;
        background: var(--navy); color: #fff;
        border: none; border-radius: 8px;
        font-size: .92rem; font-weight: 600;
        transition: all .2s ease; text-decoration: none;
    }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }

    /* ==========================================================
       MENU EKSPOR (Cetak PDF / Cetak Excel)
       ========================================================== */
    .btn-custom-light.show { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .btn-custom-light.dropdown-toggle::after { margin-left: 2px; }
    .export-menu {
        position: absolute;
        z-index: 1050 !important;
        min-width: 270px;
        margin-top: 8px !important;
        padding: 8px;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
    }
    .export-menu .dropdown-header {
        padding: 6px 10px 8px;
        font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
        color: var(--steel);
    }
    .export-item {
        display: flex; align-items: center; gap: 12px;
        width: 100%;
        padding: 10px;
        border: 0; background: transparent;
        border-radius: 8px;
        text-align: left;
        white-space: normal;
        transition: background .15s ease;
    }
    .export-item:hover, .export-item:focus { background: #f1f5f9; }
    .export-item .ico {
        flex: none; width: 38px; height: 38px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 10px; font-size: 1rem;
    }
    .export-item .ico.pdf   { background: var(--signal-soft); color: var(--signal); }
    .export-item .ico.excel { background: var(--excel-soft); color: var(--excel); }
    .export-item .txt { display: flex; flex-direction: column; line-height: 1.3; }
    .export-item .txt strong { font-size: .88rem; color: var(--ink); }
    .export-item .txt small { font-size: .76rem; color: var(--steel); }

    /* Pilihan tahun di dalam menu ekspor */
    .export-year { padding: 4px 10px 10px; border-bottom: 1px solid var(--line); margin-bottom: 8px; }
    .export-year label { display: block; margin-bottom: 6px; font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel); }
    .export-year .form-select { min-height: 38px; font-size: .88rem; font-weight: 600; }

    /* ==========================================================
       TABEL REKAP (gaya header navy, sama dengan Data Laporan)
       ========================================================== */
    .rekap-scroll { overflow-x: auto; padding: 20px; background: #fff; }
    .rekap-wrap { min-width: 1120px; border: 2px solid var(--rekap-red); border-radius: 16px; overflow: hidden; background: #fff; box-shadow: var(--shadow-sm); }

    .table-rekap { width: 100%; border-collapse: collapse; margin: 0; }

    .table-rekap thead th {
        background: linear-gradient(180deg, var(--rekap-red-light) 0%, #0d2947 100%);
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .92rem;
        text-align: center;
        vertical-align: middle;
        padding: 14px 10px;
        border: 0;
        border-right: 1px solid rgba(255,255,255,.25);
        white-space: nowrap;
    }
    .table-rekap thead th:last-child { border-right: 0; }

    .table-rekap tbody td {
        background: var(--rekap-row-b);
        text-align: center;
        vertical-align: middle;
        padding: 12px 10px;
        font-size: .85rem;
        line-height: 1.4;
        color: var(--ink-2);
        border-bottom: 1px solid var(--rekap-line);
        border-right: 1px solid var(--rekap-line);
    }
    .table-rekap tbody td:last-child { border-right: 0; }
    .table-rekap tbody tr:last-child td { border-bottom: 0; }

    .table-rekap tbody tr.alt td { background: var(--rekap-row-a); }
    .table-rekap tbody tr:hover td { background: #dce9fa; }

    .table-rekap tbody td.no-cell {
        background: linear-gradient(180deg, #163a63 0%, #0d2947 100%) !important;
        color: #fff;
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.35rem;
        border-right: 1px solid rgba(255,255,255,.25);
    }

    .col-no      { width: 64px; }
    .col-pemohon { width: 200px; }
    .col-kontak  { width: 130px; }
    .col-giat    { width: 220px; }
    .col-sarana  { width: 130px; }
    .col-tgl     { width: 130px; }
    .col-status  { width: 150px; }
    .col-aksi    { width: 130px; }

    .cell-strong { font-weight: 600; color: var(--ink); }
    .cell-sub    { display: block; font-size: .78rem; color: var(--steel); margin-top: 2px; }
    .cell-cap    { text-transform: capitalize; }

    /* Status */
    .badge-status { display: inline-block; padding: 6px 12px; font-weight: 600; font-size: 0.8rem; border-radius: 6px; }
    .badge-menunggu { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-proses { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .status-select { min-height: 34px; padding: 4px 28px 4px 10px; font-size: .8rem; font-weight: 600; border-radius: 6px; width: auto; min-width: 120px; cursor: pointer; margin: 0 auto; }
    .status-select.s-Menunggu  { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
    .status-select.s-Proses    { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .status-select.s-Disetujui { background-color: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
    .status-select.s-Ditolak   { background-color: #fef2f2; color: #b91c1c; border-color: #fecaca; }

    /* Tombol aksi */
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
    .action-btn.view { background-color: var(--info-soft); color: var(--info); }
    .action-btn.view:hover { background-color: #dbeafe; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.18); color: #d97706; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.3); }
    .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); }
    .action-btn.delete:hover { background-color: #fecaca; }

    .aksi-group { display: flex; flex-direction: row; flex-wrap: nowrap; align-items: center; justify-content: center; gap: 5px; }
    .aksi-group form { margin: 0; display: flex; }
    .aksi-group .action-btn { width: 30px; height: 30px; font-size: 12px; flex: none; }

    .empty-state td { padding: 56px 10px !important; color: var(--steel); background: #fff !important; }
    .empty-state i { font-size: 26px; margin-bottom: 10px; color: var(--steel-soft); }

    /* ==========================================================
       CETAK / EKSPOR PDF (A4 Landscape)
       ========================================================== */
    @page {
        size: landscape;
        margin: 0;
    }
    @media print {
        @page {
            size: landscape;
            margin: 0;
        }
        .topbar, .sidebar, .sidebar-backdrop, .page-header, .card-header, .card-footer,
        .btn, .dropdown, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert, .d-print-none { display: none !important; }

        html { background: #fff !important; margin: 0 !important; padding: 0 !important; }
        body { background-color: white !important; font-size: 10pt !important; margin: 0 !important; padding: 1cm !important; box-sizing: border-box !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }
        .card-custom { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
        .card-body { padding: 0 !important; }

        .rekap-scroll { padding: 0 !important; overflow: visible !important; }
        .rekap-wrap { min-width: 0 !important; border: none !important; border-radius: 0 !important; box-shadow: none !important; }
        .table-rekap { width: 100% !important; margin-bottom: 20px; table-layout: auto !important; border-collapse: collapse !important; }
        .table-rekap thead th { background: #f2f2f2 !important; color: #000 !important; border: 1px solid #000 !important; font-size: 10pt !important; padding: 6px !important; }
        .table-rekap tbody td, .table-rekap tbody tr.alt td { background: #fff !important; color: #000 !important; border: 1px solid #000 !important; padding: 6px !important; font-size: 9.5pt !important; line-height: 1.35 !important; }
        .table-rekap tbody td.no-cell { background: #fff !important; color: #000 !important; font-size: 10pt !important; font-weight: bold !important; border: 1px solid #000 !important; }
        .cell-sub { color: #000 !important; }

        /* Dropdown status tampil sebagai teks biasa saat dicetak */
        .status-select { appearance: none; -webkit-appearance: none; background-image: none !important; border: none !important; padding: 0 !important; min-height: 0; min-width: 0; text-align: center; color: #000 !important; background-color: transparent !important; }

        /* Badge status tampil sederhana saat dicetak */
        .badge-status { background: transparent !important; border: none !important; color: #000 !important; padding: 0 !important; }

        /* Sembunyikan kolom Aksi */
        th:last-child, td:last-child { display: none !important; }
    }
</style>
@endpush

@section('content')

@php
    // Daftar tahun untuk pilihan ekspor (diambil dari Tgl Kegiatan + tahun berjalan), terbaru di atas
    // Mau menambah tahun tertentu? Tambahkan ->push(2027) atau ganti dengan ->merge(range(2022, (int) date('Y') + 1))
    $daftarTahun = collect($permohonan)
        ->map(function ($r) {
            return $r->tgl_pelaksanaan ? \Carbon\Carbon::parse($r->tgl_pelaksanaan)->year : null;
        })
        ->filter()
        ->push((int) date('Y'))
        ->unique()
        ->sortDesc()
        ->values();
@endphp

    <div class="page-header">
        <div class="page-header-text">
            <h1>Kelola Penggunaan Sarana</h1>
            <p>Daftar seluruh pengajuan permohonan penggunaan sarana pemadam kebakaran.</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <!-- EKSPOR (PDF & EXCEL): SEMUA ROLE -->
            <div class="dropdown">
                <button class="btn-custom-light shadow-sm dropdown-toggle" type="button" id="btnEkspor" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download me-2"></i> Ekspor Semua
                </button>
                <ul class="dropdown-menu dropdown-menu-end export-menu" aria-labelledby="btnEkspor">
                    <li><h6 class="dropdown-header">Pilih format ekspor</h6></li>

                    <!-- PILIH TAHUN: berlaku untuk Cetak PDF & Cetak Excel -->
                    <li class="export-year" onclick="event.stopPropagation()">
                        <label for="tahunEkspor">Tahun</label>
                        <select id="tahunEkspor" class="form-select">
                            <option value="">Semua Tahun</option>
                            @foreach($daftarTahun as $thn)
                                <option value="{{ $thn }}">{{ $thn }}</option>
                            @endforeach
                        </select>
                    </li>

                    <li>
                        <button type="button" class="dropdown-item export-item" onclick="cetakPdf()">
                            <span class="ico pdf"><i class="fas fa-file-pdf"></i></span>
                            <span class="txt">
                                <strong>Cetak PDF</strong>
                                <small>Cetak tabel sesuai tahun yang dipilih</small>
                            </span>
                        </button>
                    </li>
                    <li>
                        <a class="dropdown-item export-item" id="linkExcel" data-base="{{ route('internal.penggunaan-sarana.export-excel') }}" href="{{ route('internal.penggunaan-sarana.export-excel') }}">
                            <span class="ico excel"><i class="fas fa-file-excel"></i></span>
                            <span class="txt">
                                <strong>Cetak Excel</strong>
                                <small>Unduh rekap sesuai tahun yang dipilih (.xlsx)</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- TOMBOL BUAT LAPORAN BARU: HANYA DAMTAN DAN SUPER USER --}}
            @hasanyrole('Damtan|Super User')
            <a href="{{ route('internal.penggunaan-sarana.create') }}" class="btn-custom-primary shadow-sm">
                <i class="fas fa-plus me-2"></i> Buat Laporan Baru
            </a>
            @endhasanyrole
        </div>
    </div>

    <div class="card-custom">
        <!-- Filter & Search Bar -->
        <div class="card-header bg-white p-4 border-bottom border-light">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nama pemohon, kegiatan, lokasi, sarana...">
                    </div>
                </div>
                <div class="col-md-4 text-end ms-auto">
                    <button type="button" class="btn-custom-light w-100 py-2 border-light fw-bold" onclick="resetFilter()">
                        <i class="fas fa-sync-alt me-2"></i>Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card-body p-0">

            <!-- HEADER KHUSUS CETAK PDF -->
            <div id="print-header" class="d-none d-print-block" style="width: 100%; margin-bottom: 20px;">
                <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; width: 100% !important; margin-bottom: 15px;">
                    <div style="width: 15% !important; text-align: left !important;">
                        <img src="/images/jambi.png" style="width: 80px; height: auto;">
                    </div>
                    <div style="width: 70% !important; text-align: center !important;">
                        <div style="font-size: 14pt; color: #000; margin-bottom: 2px; font-family: 'Times New Roman', Times, serif;">PEMERINTAH KOTA JAMBI</div>
                        <div style="font-size: 16pt; font-weight: bold; color: #000; line-height: 1.1; margin-bottom: 5px; font-family: 'Times New Roman', Times, serif;">DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</div>
                        <div style="font-size: 10pt; color: #000; font-family: 'Times New Roman', Times, serif;">Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</div>
                    </div>
                    <div style="width: 15% !important; text-align: right !important;">
                        <img src="/images/logo.png" style="width: 100px; height: auto; margin-left: auto;">
                    </div>
                </div>
                <div style="border-top: 3px solid black !important; border-bottom: 1px solid black !important; height: 2px !important; width: 100% !important; margin-bottom: 15px !important;"></div>
                <h3 style="text-align: center !important; font-weight: bold; margin-bottom: 5px; font-size: 16px; color: black; font-family: 'Times New Roman', Times, serif;">REKAPITULASI PERMOHONAN PENGGUNAAN SARANA<span id="printTahun"></span></h3>
                <p style="text-align: center !important; font-size: 12px; margin-bottom: 15px; color: black; font-family: 'Times New Roman', Times, serif;">Dicetak pada: {{ date('d F Y') }}</p>
            </div>

            <div class="rekap-scroll">
                <div class="rekap-wrap">
                    <table class="table-rekap">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-pemohon">Nama Pemohon</th>
                                <th class="col-kontak">Kontak</th>
                                <th class="col-giat">Kegiatan</th>
                                <th class="col-sarana">Sarana</th>
                                <th class="col-tgl">Tgl Kegiatan</th>
                                <th class="col-status">Status</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($permohonan as $row)
                            <tr data-tahun="{{ $row->tgl_pelaksanaan ? \Carbon\Carbon::parse($row->tgl_pelaksanaan)->year : '' }}" data-search="{{ strtolower($row->nama . ' ' . $row->no_hp . ' ' . $row->nama_instansi . ' ' . $row->nama_kegiatan . ' ' . $row->lokasi_kegiatan . ' ' . $row->sarana . ' ' . $row->status) }}">
                                <td class="no-cell">{{ $loop->iteration }}</td>

                                <td>
                                    <span class="cell-strong">{{ $row->nama }}</span>
                                    <span class="cell-sub cell-cap">{{ $row->jenis_pemohon }} &middot; {{ $row->nama_instansi }}</span>
                                </td>

                                <td>{{ $row->no_hp }}</td>

                                <td class="cell-cap">
                                    <span class="cell-strong">{{ $row->nama_kegiatan }}</span>
                                    <span class="cell-sub">{{ $row->lokasi_kegiatan }}</span>
                                </td>

                                <td>{{ $row->sarana }}</td>

                                <td>
                                    <span class="cell-strong">{{ \Carbon\Carbon::parse($row->tgl_pelaksanaan)->translatedFormat('d M Y') }}</span>
                                    <span class="cell-sub">{{ substr($row->waktu_mulai, 0, 5) }} - {{ substr($row->waktu_selesai, 0, 5) }}</span>
                                </td>

                                <td>
                                    {{-- UBAH STATUS: HANYA DAMTAN DAN SUPER USER --}}
                                    @hasanyrole('Damtan|Super User')
                                        <form action="{{ route('internal.penggunaan-sarana.update_status', $row->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <select name="status"
                                                    class="form-select status-select s-{{ $row->status }}"
                                                    data-old="{{ $row->status }}"
                                                    onchange="konfirmasiStatus(this)">
                                                @foreach(['Menunggu', 'Proses', 'Disetujui', 'Ditolak'] as $st)
                                                    <option value="{{ $st }}" {{ $row->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        {{-- ROLE LAIN: HANYA MELIHAT STATUS --}}
                                        @if($row->status == 'Menunggu')
                                            <span class="badge-status badge-menunggu">{{ $row->status }}</span>
                                        @elseif($row->status == 'Proses')
                                            <span class="badge-status badge-proses">{{ $row->status }}</span>
                                        @elseif($row->status == 'Disetujui')
                                            <span class="badge-status badge-disetujui">{{ $row->status }}</span>
                                        @elseif($row->status == 'Ditolak')
                                            <span class="badge-status badge-ditolak">{{ $row->status }}</span>
                                        @else
                                            <span class="badge-status" style="background:#e2e8f0; color:#475569; border:1px solid #cbd5e1;">{{ $row->status }}</span>
                                        @endif
                                    @endhasanyrole
                                </td>

                                <td>
                                    <div class="aksi-group">
                                        <!-- DETAIL: SEMUA ROLE -->
                                        <a href="{{ route('internal.penggunaan-sarana.show', $row->id) }}" class="action-btn view" title="Lihat Detail"><i class="fas fa-eye"></i></a>

                                        <!-- EDIT & HAPUS: HANYA DAMTAN DAN SUPER USER -->
                                        @hasanyrole('Damtan|Super User')
                                        <a href="{{ route('internal.penggunaan-sarana.edit', $row->id) }}" class="action-btn edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('internal.penggunaan-sarana.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan ini secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endhasanyrole
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="empty-state">
                                <td colspan="8">
                                    <i class="fas fa-truck-droplet d-block"></i>
                                    Belum ada data pengajuan Penggunaan Sarana.
                                </td>
                            </tr>
                            @endforelse

                            {{-- Muncul otomatis jika pencarian tidak menemukan hasil --}}
                            <tr class="empty-state" id="noResult" hidden>
                                <td colspan="8">
                                    <i class="fas fa-search d-block"></i>
                                    Tidak ada pengajuan yang cocok dengan pencarian.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';
        /* Sidebar Toggle */
        var toggle = document.getElementById('sideToggle');
        var backdrop = document.getElementById('sideBackdrop');
        function closeSide() {
            document.body.classList.remove('side-open');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
        }
        if (toggle) {
            toggle.addEventListener('click', function () {
                var open = document.body.classList.toggle('side-open');
                toggle.setAttribute('aria-expanded', open);
            });
        }
        if (backdrop) backdrop.addEventListener('click', closeSide);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

        /* Accordion Sidebar */
        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });
    })();
</script>
<script>
    /* Konfirmasi ubah status */
    function konfirmasiStatus(select) {
        var lama = select.dataset.old;
        var baru = select.value;
        if (confirm('Ubah status permohonan dari "' + lama + '" menjadi "' + baru + '"?')) {
            select.form.submit();
        } else {
            select.value = lama;
        }
    }

    /* ==========================================================
       EKSPOR PER TAHUN (Cetak PDF & Cetak Excel)
       ========================================================== */
    (function () {
        'use strict';
        var selTahun  = document.getElementById('tahunEkspor');
        var linkExcel = document.getElementById('linkExcel');
        var spanTahun = document.getElementById('printTahun');
        var tersimpan = null;

        // Link Excel ikut tahun yang dipilih (?tahun=XXXX)
        function urlExcel() {
            var base = linkExcel.dataset.base;
            return selTahun.value ? base + '?tahun=' + encodeURIComponent(selTahun.value) : base;
        }
        if (selTahun && linkExcel) {
            linkExcel.href = urlExcel();
            selTahun.addEventListener('change', function () { linkExcel.href = urlExcel(); });
        }

        // Kembalikan tampilan tabel setelah cetak selesai
        function pulihkan() {
            if (!tersimpan) return;
            tersimpan.forEach(function (s) {
                s.row.style.display = s.display;
                if (s.noCell) s.noCell.textContent = s.no;
            });
            tersimpan = null;
            if (spanTahun) spanTahun.textContent = '';
        }

        // Cetak PDF: hanya baris pada tahun terpilih, nomor diurut ulang dari 1
        window.cetakPdf = function () {
            var tahun = selTahun ? selTahun.value : '';
            var rows  = document.querySelectorAll('#tableBody tr[data-search]');
            var nomor = 0;
            tersimpan = [];

            rows.forEach(function (row) {
                var noCell = row.querySelector('.no-cell');
                tersimpan.push({ row: row, display: row.style.display, noCell: noCell, no: noCell ? noCell.textContent : '' });

                var tampil = row.style.display !== 'none' && (!tahun || row.dataset.tahun === tahun);
                if (tampil) {
                    nomor++;
                    if (noCell) noCell.textContent = nomor;
                } else {
                    row.style.display = 'none';
                }
            });

            if (nomor === 0) {
                pulihkan();
                alert(tahun ? 'Tidak ada data pengajuan pada tahun ' + tahun + '.' : 'Tidak ada data untuk dicetak.');
                return;
            }

            if (spanTahun) spanTahun.textContent = tahun ? ' TAHUN ' + tahun : '';
            window.print();
        };

        window.addEventListener('afterprint', pulihkan);
    })();

    /* Search (memakai data-search agar teks opsi dropdown tidak ikut terbaca) */
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const rows        = document.querySelectorAll('#tableBody tr[data-search]');
        const noResult    = document.getElementById('noResult');

        function filterTable() {
            const term = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach(function (row) {
                const show = row.dataset.search.includes(term);
                row.style.display = show ? '' : 'none';

                // Warna baris selang-seling hanya untuk baris yang tampil
                row.classList.remove('alt');
                if (show) {
                    if (visible % 2 === 0) row.classList.add('alt');
                    visible++;
                }
            });

            if (noResult) noResult.hidden = !(rows.length > 0 && visible === 0);
        }

        searchInput.addEventListener('input', filterTable);

        // dibuat global agar bisa dipanggil dari onclick="resetFilter()"
        window.resetFilter = function () {
            searchInput.value = '';
            filterTable();
        };

        filterTable(); // terapkan warna selang-seling saat halaman dimuat
    });
</script>
@endpush