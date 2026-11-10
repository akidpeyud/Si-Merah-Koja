@extends('layouts.dashboard')

@section('title', 'Kelola Surat Korban')

@push('styles')
<style>
    :root {
        --ink: #0d1b2a;
        --ink-2: #132a43;
        --ink-3: #1d3856;

        --navy: #163a63;
        --navy-dark: #0d2947;
        --navy-light: #eaf1f8;
        --navy-soft: rgba(22, 58, 99, .08);

        --paper: #f5f7fa;
        --white: #ffffff;

        --signal: #dc3545;
        --signal-dark: #b42332;
        --signal-soft: rgba(220, 53, 69, .09);

        --amber: #f4b740;
        --success: #198754;
        --info: #2563eb;
        --info-soft: rgba(37, 99, 235, .09);

        --steel: #64748b;
        --steel-soft: #94a3b8;

        --line: #e2e8f0;
        --line-dark: #cbd5e1;

        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;

        --r-lg: 18px;
        --r-md: 14px;
        --r-sm: 10px;

        --sidebar-w: 272px;
        --topbar-h: 70px;

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
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
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

    .card-custom {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        box-shadow: var(--shadow-xs);
        overflow: hidden;
    }

    .form-control, .form-select {
        font-family: var(--font-body);
        min-height: 42px;
        font-size: .9rem;
        color: var(--ink);
        background-color: var(--white);
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        padding: 8px 14px;
        transition: all 0.2s ease;
        box-shadow: none;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .form-control::placeholder { color: var(--steel-soft); }

    .input-group-text {
        background-color: #f8fafc;
        border: 1px solid var(--line-dark);
        color: var(--steel);
        font-weight: 600;
        border-radius: 8px;
        font-size: 0.9rem;
    }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }

    .btn-custom-primary {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 44px; padding: 0 24px;
        background: var(--navy); color: #fff;
        border: none; border-radius: 8px;
        font-size: .92rem; font-weight: 600;
        transition: all .2s ease; text-decoration: none;
    }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }

    .btn-custom-light {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 44px; padding: 0 24px;
        background: var(--white); color: var(--ink);
        border: 1px solid var(--line-dark); border-radius: 8px;
        font-size: .92rem; font-weight: 600;
        transition: all .2s ease;
    }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }

    /* ==========================================================
       BAR FILTER (cari, tahun, reset)
       ========================================================== */
    .filter-bar .form-select,
    .filter-bar .form-control { height: 44px; }
    .filter-bar .btn-reset {
        width: 100%;
        height: 44px;
        min-height: 44px;
        padding: 0 18px;
        background: var(--white);
        color: var(--ink);
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        font-size: .9rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .filter-bar .btn-reset:hover { background: #f1f5f9; border-color: var(--steel-soft); color: var(--ink); }
    .filter-bar .btn-reset:active { transform: scale(.98); }

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

    /* Pilihan tahun & bulan di dalam menu ekspor */
    .export-year { padding: 4px 10px 6px; }
    .export-month { padding: 0 10px 10px; border-bottom: 1px solid var(--line); margin-bottom: 8px; }
    .export-year label, .export-month label { display: block; margin-bottom: 6px; font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel); }
    .export-year .form-select, .export-month .form-select { min-height: 38px; font-size: .88rem; font-weight: 600; }

    /* ==========================================================
       TABEL REKAP (gaya header navy, sama dengan Data Laporan)
       ========================================================== */
    .rekap-scroll {
        overflow-x: auto;
        padding: 20px;
        background: #fff;
        scrollbar-width: auto;
        -webkit-overflow-scrolling: touch;
    }
    .rekap-wrap {
        display: inline-block;
        min-width: 100%;
        border: 2px solid var(--rekap-red);
        border-radius: 16px;
        background: #fff;
        box-shadow: var(--shadow-sm);
        vertical-align: top;
    }

    .table-rekap {
        width: max-content;
        min-width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }

    .table-rekap thead th {
        background: linear-gradient(180deg, var(--rekap-red-light) 0%, #0d2947 100%);
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .92rem;
        text-align: center;
        vertical-align: middle;
        padding: 14px 18px;
        border: 0;
        border-right: 1px solid rgba(255,255,255,.25);
        white-space: nowrap;
    }
    .table-rekap thead th:first-child { border-top-left-radius: 14px; }
    .table-rekap thead th:last-child  { border-top-right-radius: 14px; border-right: 0; }

    .table-rekap tbody td {
        background: var(--rekap-row-b);
        text-align: center;
        vertical-align: middle;
        padding: 12px 16px;
        font-size: .85rem;
        line-height: 1.4;
        color: var(--ink-2);
        border-bottom: 1px solid var(--rekap-line);
        border-right: 1px solid var(--rekap-line);
        white-space: nowrap;
    }
    .table-rekap tbody td:last-child { border-right: 0; }
    .table-rekap tbody tr:last-child td { border-bottom: 0; }
    .table-rekap tbody tr:last-child td:first-child { border-bottom-left-radius: 14px; }
    .table-rekap tbody tr:last-child td:last-child  { border-bottom-right-radius: 14px; }

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

    .col-no    { width: 64px; min-width: 64px; }
    .col-aksi  { width: 140px; min-width: 140px; }

    .table-scroll-nav {
        background: #f8fafc;
        border-bottom: 1px solid var(--line);
        padding: 8px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .table-scroll-nav .nav-hint {
        font-size: 0.82rem;
        color: var(--steel);
        font-weight: 500;
    }
    .table-scroll-nav .btn {
        font-size: 0.78rem;
        padding: 4px 12px;
        border-radius: 6px;
    }

    .cell-strong { font-weight: 600; color: var(--ink); }
    .cell-nama   { text-transform: capitalize; }

    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
    .action-btn.view { background-color: var(--info-soft); color: var(--info); }
    .action-btn.view:hover { background-color: #dbeafe; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.18); color: #d97706; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.3); }
    .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); }
    .action-btn.delete:hover { background-color: #fecaca; }

    /* Tombol aksi sejajar satu baris */
    .aksi-group { display: flex; flex-direction: row; flex-wrap: nowrap; align-items: center; justify-content: center; gap: 5px; }
    .aksi-group form { margin: 0; display: flex; }
    .aksi-group .action-btn { width: 30px; height: 30px; font-size: 12px; flex: none; }

    .empty-state td { padding: 56px 10px !important; color: var(--steel); background: #fff !important; }
    .empty-state i { font-size: 26px; margin-bottom: 10px; color: var(--steel-soft); }

    .pagination-container nav ul.pagination { margin-bottom: 0 !important; }
    .pagination-container nav p { display: none; }

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
        .btn, .dropdown, form, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert, .d-print-none { display: none !important; }
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
        th:last-child, td:last-child { display: none !important; }
    }
</style>
@endpush

@section('content')

@php
    // Daftar tahun untuk pilihan ekspor & filter (dari data halaman ini + rentang 2023 s/d tahun berjalan), terbaru di atas.
    // Mau mengubah rentang? Ganti angka 2023 di bawah, atau tambahkan ->push(2027).
    $daftarTahun = collect($surat->items())
        ->map(function ($r) {
            return $r->created_at ? \Carbon\Carbon::parse($r->created_at)->year : null;
        })
        ->filter()
        ->merge(range(2023, (int) date('Y')))
        ->push((int) date('Y'))
        ->unique()
        ->sortDesc()
        ->values();
@endphp

    <div class="page-header">
        <div class="page-header-text">
            <h1>Kelola Surat Korban</h1>
            <p>Daftar seluruh Surat Keterangan Kejadian yang telah diterbitkan.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <!-- EKSPOR (PDF & EXCEL): SEMUA ROLE -->
            <div class="dropdown">
                <button class="btn-custom-light shadow-sm dropdown-toggle" type="button" id="btnEkspor" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download me-2"></i> Ekspor Semua
                </button>
                <ul class="dropdown-menu dropdown-menu-end export-menu" aria-labelledby="btnEkspor">
                    <li><h6 class="dropdown-header">Pilih format ekspor</h6></li>

                    <!-- PILIH TAHUN & BULAN: berlaku untuk Cetak PDF & Cetak Excel -->
                    <li class="export-year" onclick="event.stopPropagation()">
                        <label for="tahunEkspor">Tahun</label>
                        <select id="tahunEkspor" class="form-select">
                            <option value="">Semua Tahun</option>
                            @foreach($daftarTahun as $thn)
                                <option value="{{ $thn }}">{{ $thn }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="export-month" onclick="event.stopPropagation()">
                        <label for="bulanEkspor">Bulan</label>
                        <select id="bulanEkspor" class="form-select">
                            <option value="">Semua Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </li>

                    <li>
                        <button type="button" class="dropdown-item export-item" onclick="cetakPdf()">
                            <span class="ico pdf"><i class="fas fa-file-pdf"></i></span>
                            <span class="txt">
                                <strong>Cetak PDF</strong>
                                <small>Cetak tabel yang tampil di halaman ini</small>
                            </span>
                        </button>
                    </li>
                    <li>
                        <a class="dropdown-item export-item" id="linkExcel" data-base="{{ route('surat-korban.export-excel') }}" href="{{ route('surat-korban.export-excel') }}">
                            <span class="ico excel"><i class="fas fa-file-excel"></i></span>
                            <span class="txt">
                                <strong>Cetak Excel</strong>
                                <small>Unduh rekap seluruh surat sesuai tahun (.xlsx)</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CREATE: HANYA DAMTAN DAN SUPER USER -->
            @hasanyrole('Damtan|Super User')
            <a href="/internal/surat-korban/create" class="btn-custom-primary shadow-sm">
                <i class="fas fa-plus me-2"></i> Buat Surat Baru
            </a>
            @endhasanyrole
        </div>
    </div>

    <div class="card-custom">
        <!-- Filter & Search Bar -->
        <div class="card-header bg-white p-4 border-bottom border-light">
            <div class="row g-3 filter-bar align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nomor surat, nama korban...">
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <select id="filterTahun" class="form-select" title="Filter tahun diterbitkan">
                        <option value="">Semua Tahun</option>
                        @foreach($daftarTahun as $thn)
                            <option value="{{ $thn }}">{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-lg-3">
                    <button type="button" class="btn-custom-light btn-reset" onclick="resetFilter()">
                        <i class="fas fa-sync-alt"></i> Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Content -->
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
                <h3 style="text-align: center !important; font-weight: bold; margin-bottom: 5px; font-size: 16px; color: black; font-family: 'Times New Roman', Times, serif;">REKAPITULASI SURAT KETERANGAN KEJADIAN<span id="printTahun"></span></h3>
                <p style="text-align: center !important; font-size: 12px; margin-bottom: 15px; color: black; font-family: 'Times New Roman', Times, serif;">Dicetak pada: {{ date('d F Y') }}</p>
            </div>

            <!-- NAVIGASI SCROLL TABEL -->
            <div class="table-scroll-nav d-print-none">
                <span class="nav-hint"><i class="fas fa-arrows-alt-h me-1 text-primary"></i> Geser tabel ke kanan/kiri untuk melihat seluruh 14 kolom data</span>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary" onclick="scrollTable(-350)" title="Geser ke kiri"><i class="fas fa-chevron-left me-1"></i> Geser Kiri</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="scrollTable(350)" title="Geser ke kanan">Geser Kanan <i class="fas fa-chevron-right ms-1"></i></button>
                </div>
            </div>

            <div class="rekap-scroll">
                <div class="rekap-wrap">
                    <table class="table-rekap">
                        <thead>
                            <tr>
                                <th class="col-no">NO</th>
                                <th style="min-width: 170px;">No Surat</th>
                                <th style="min-width: 150px;">TGL. SURAT</th>
                                <th style="min-width: 160px;">Nama</th>
                                <th style="min-width: 200px;">Tempat Tgl Lahir</th>
                                <th style="min-width: 160px;">NIK</th>
                                <th style="min-width: 250px;">ALAMAT</th>
                                <th style="min-width: 180px;">STATUS KEPEMILIKAN</th>
                                <th style="min-width: 140px;">Status</th>
                                <th style="min-width: 150px;">Pekerjaan</th>
                                <th style="min-width: 200px;">Tgl Kejadian</th>
                                <th style="min-width: 220px;">Lokasi Kejadian</th>
                                <th style="min-width: 200px;">Satuan Tugas Operasi</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($surat as $index => $row)
                            @php
                                $tglSuratRaw = !empty($row->tanggal_surat) ? $row->tanggal_surat : $row->created_at;
                                $tglSuratObj = $tglSuratRaw ? \Carbon\Carbon::parse($tglSuratRaw) : null;
                            @endphp
                            <tr data-row data-tahun="{{ $tglSuratObj ? $tglSuratObj->year : '' }}" data-bulan="{{ $tglSuratObj ? $tglSuratObj->format('n') : '' }}">
                                <td class="no-cell">{{ $surat->firstItem() + $index }}</td>

                                <td class="cell-strong">{{ $row->nomor_surat ?? '-' }}</td>

                                <td>
                                    {{ !empty($row->tanggal_surat) ? \Carbon\Carbon::parse($row->tanggal_surat)->locale('id')->translatedFormat('d F Y') : (!empty($row->created_at) ? \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y') : '-') }}
                                </td>

                                <td class="cell-strong cell-nama">{{ $row->nama_korban ?? '-' }}</td>

                                <td>
                                    {{ trim(($row->tempat_lahir ?? '') . (!empty($row->tanggal_lahir) ? ', ' . \Carbon\Carbon::parse($row->tanggal_lahir)->locale('id')->translatedFormat('d F Y') : '')) ?: '-' }}
                                </td>

                                <td>{{ $row->nik ?? '-' }}</td>

                                <td style="text-align: left; min-width: 250px; max-width: 320px; white-space: normal;">{{ $row->alamat ?? '-' }}</td>

                                <td>{{ ucwords(strtolower($row->status_kepemilikan ?? '-')) }}</td>

                                <td>{{ ucwords(strtolower($row->status_perkawinan ?? '-')) }}</td>

                                <td>{{ ucwords(strtolower($row->pekerjaan ?? '-')) }}</td>

                                <td>
                                    {{ trim((!empty($row->hari_kejadian) ? $row->hari_kejadian . ', ' : '') . (!empty($row->tanggal_kejadian) ? \Carbon\Carbon::parse($row->tanggal_kejadian)->locale('id')->translatedFormat('d F Y') : '')) ?: '-' }}
                                </td>

                                <td style="text-align: left; min-width: 220px; max-width: 280px; white-space: normal;">{{ $row->alamat ?? ($row->objek_terbakar ?? '-') }}</td>

                                <td style="min-width: 200px;">{{ $row->satuan_tugas_operasi ?? ($row->satuan_tugas ?? '-') }}</td>

                                <td class="col-aksi">
                                    <div class="aksi-group">
                                        <!-- CETAK SURAT: SEMUA ROLE -->
                                        <a href="/internal/surat-korban/cetak/{{ $row->id }}" class="action-btn view" target="_blank" title="Cetak Surat"><i class="fas fa-print"></i></a>

                                        <!-- UPDATE & DELETE: HANYA DAMTAN DAN SUPER USER -->
                                        @hasanyrole('Damtan|Super User')
                                        <a href="/internal/surat-korban/edit/{{ $row->id }}" class="action-btn edit" title="Edit Surat"><i class="fas fa-edit"></i></a>
                                        <form action="/internal/surat-korban/delete/{{ $row->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat nomor {{ $row->nomor_surat }} secara permanen?')">
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
                                <td colspan="14">
                                    <i class="fas fa-envelope-open-text d-block"></i>
                                    Belum ada surat keterangan korban yang diterbitkan.
                                </td>
                            </tr>
                            @endforelse

                            {{-- Muncul otomatis jika pencarian/filter tidak menemukan hasil --}}
                            <tr class="empty-state" id="noResult" hidden>
                                <td colspan="14">
                                    <i class="fas fa-search d-block"></i>
                                    Tidak ada surat yang cocok dengan pencarian atau filter.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white p-4 d-flex justify-content-between align-items-center border-top">
            <span class="text-muted" style="font-size: 13px;" id="dataCount">
                Menampilkan {{ $surat->firstItem() ?? 0 }} - {{ $surat->lastItem() ?? 0 }} dari total {{ $surat->total() }} surat
            </span>
            <div class="pagination-container mb-0">
                {{ $surat->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    @if(isset($hasDokumenTable) && ! $hasDokumenTable)
    <div class="card-custom mt-4 p-4 border border-warning bg-light d-print-none">
        <div class="d-flex align-items-center gap-3">
            <i class="fas fa-triangle-exclamation text-warning" style="font-size: 1.5rem;"></i>
            <div>
                <h6 class="mb-1 fw-bold text-dark">Informasi Migrasi Database</h6>
                <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                    File migrasi tabel <code class="text-primary">dokumen_surat_korbans</code> telah disiapkan. Jalankan perintah <code class="bg-white px-2 py-0.5 border rounded">php artisan migrate</code> untuk mengaktifkan penyimpanan data dokumen.
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- ========================================================
         AREA FORM UPLOAD DOKUMEN SURAT KORBAN
         ======================================================== --}}
    @hasanyrole('Damtan|Super User')
    <div class="card-custom mt-4 d-print-none">
        <div class="card-header bg-white p-4 border-bottom">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(22, 58, 99, 0.08); display: flex; align-items: center; justify-content: center; color: var(--navy); font-size: 1.1rem;">
                    <i class="fas fa-cloud-arrow-up"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold" style="font-family: var(--font-display); color: var(--ink);">Form Upload Dokumen Surat Korban</h5>
                    <p class="text-muted mb-0" style="font-size: 0.85rem;">Isi identitas surat korban dan unggah file SKK serta Dokumentasi.</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('surat-korban.upload-dokumen') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 mb-4">
                    {{-- NO SURAT --}}
                    <div class="col-12 col-md-4">
                        <label for="input_nomor_surat" class="form-label fw-bold" style="font-size: 0.85rem; color: var(--ink-2);">
                            No Surat
                        </label>
                        <input type="text" list="listNomorSurat" name="nomor_surat" id="input_nomor_surat" class="form-control" placeholder="Contoh: 001/SKK/DAMKAR/2026" onchange="autoFillSurat(this.value)">
                        <datalist id="listNomorSurat">
                            @foreach($daftarSuratList ?? [] as $ds)
                                <option value="{{ $ds->nomor_surat }}">{{ $ds->nama_korban }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    {{-- NAMA --}}
                    <div class="col-12 col-md-4">
                        <label for="input_nama" class="form-label fw-bold" style="font-size: 0.85rem; color: var(--ink-2);">
                            Nama
                        </label>
                        <input type="text" name="nama" id="input_nama" class="form-control" placeholder="Nama korban / pemilik">
                    </div>

                    {{-- NIK --}}
                    <div class="col-12 col-md-4">
                        <label for="input_nik" class="form-label fw-bold" style="font-size: 0.85rem; color: var(--ink-2);">
                            NIK
                        </label>
                        <input type="text" name="nik" id="input_nik" class="form-control" placeholder="16 digit NIK">
                    </div>

                    {{-- TEMPAT TANGGAL LAHIR --}}
                    <div class="col-12 col-md-6">
                        <label for="input_ttl" class="form-label fw-bold" style="font-size: 0.85rem; color: var(--ink-2);">
                            Tempat Tanggal Lahir
                        </label>
                        <input type="text" name="tempat_tanggal_lahir" id="input_ttl" class="form-control" placeholder="Contoh: Jambi, 12 Agustus 1985">
                    </div>

                    {{-- ALAMAT --}}
                    <div class="col-12 col-md-6">
                        <label for="input_alamat" class="form-label fw-bold" style="font-size: 0.85rem; color: var(--ink-2);">
                            Alamat
                        </label>
                        <input type="text" name="alamat" id="input_alamat" class="form-control" placeholder="Alamat tempat kejadian / tempat tinggal">
                    </div>
                </div>

                <div class="row g-4">
                    {{-- FILE INPUT 1: SKK (Surat Keterangan Kejadian) --}}
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100 position-relative">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-primary px-2.5 py-1.5" style="font-size: 0.75rem;"><i class="fas fa-file-pdf me-1"></i> SKK</span>
                                <span class="fw-bold" style="font-size: 0.9rem; color: var(--ink);">Surat Keterangan Kejadian</span>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem;">Unggah file fisik/scan surat keterangan kejadian resmi (PDF, JPG, PNG &middot; maks 5MB).</p>
                            
                            <input type="file" name="file_skk" id="file_skk" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                    </div>

                    {{-- FILE INPUT 2: Dokumentasi (Foto Surat/Peristiwa) --}}
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100 position-relative">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-info text-white px-2.5 py-1.5" style="font-size: 0.75rem;"><i class="fas fa-image me-1"></i> Dokumentasi</span>
                                <span class="fw-bold" style="font-size: 0.9rem; color: var(--ink);">Foto Surat / Peristiwa</span>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem;">Unggah foto dokumentasi penyerahan surat, berkas fisik, atau foto peristiwa (PDF, JPG, PNG &middot; maks 5MB).</p>
                            
                            <input type="file" name="file_dokumentasi" id="file_dokumentasi" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn-custom-primary shadow-sm">
                        <i class="fas fa-cloud-arrow-up me-2"></i> Unggah Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endhasanyrole

    {{-- ========================================================
         TABEL HASIL UPLOAD DOKUMEN
         ======================================================== --}}
    <div class="card-custom mt-4 d-print-none">
        <div class="card-header bg-white p-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(37, 99, 235, 0.08); display: flex; align-items: center; justify-content: center; color: var(--info); font-size: 1.1rem;">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold" style="font-family: var(--font-display); color: var(--ink);">Tabel Hasil Upload Dokumen</h5>
                    <p class="text-muted mb-0" style="font-size: 0.85rem;">Daftar berkas SKK dan Dokumentasi yang telah berhasil diunggah.</p>
                </div>
            </div>
            <span class="badge bg-secondary px-3 py-2" style="font-size: 0.82rem;">
                Total: {{ count($dokumenSurat ?? []) }} Dokumen
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                    <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <tr>
                            <th class="text-center py-3" style="width: 50px;">No</th>
                            <th class="py-3" style="min-width: 170px;">No Surat</th>
                            <th class="py-3" style="min-width: 150px;">Nama</th>
                            <th class="py-3" style="min-width: 140px;">NIK</th>
                            <th class="py-3" style="min-width: 170px;">Tempat Tanggal Lahir</th>
                            <th class="py-3" style="min-width: 200px;">Alamat</th>
                            <th class="text-center py-3" style="min-width: 150px;">SKK</th>
                            <th class="text-center py-3" style="min-width: 150px;">Dokumentasi</th>
                            @hasanyrole('Damtan|Super User')
                            <th class="text-center py-3" style="width: 80px;">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokumenSurat ?? [] as $dok)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold text-dark">{{ $dok->nomor_surat ?? '-' }}</span>
                            </td>
                            <td class="fw-semibold">{{ $dok->nama ?? '-' }}</td>
                            <td>{{ $dok->nik ?? '-' }}</td>
                            <td>{{ $dok->tempat_tanggal_lahir ?? '-' }}</td>
                            <td style="max-width: 250px; white-space: normal;">{{ $dok->alamat ?? '-' }}</td>
                            <td class="text-center">
                                @if(!empty($dok->file_skk))
                                    <a href="{{ route('surat-korban.lihat-dokumen', ['id' => $dok->id, 'jenis' => 'skk']) }}" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-2.5 py-1" style="font-size: 0.78rem;">
                                        <i class="fas fa-file-pdf"></i> Lihat SKK
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1">Tidak ada file</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($dok->file_dokumentasi))
                                    <a href="{{ route('surat-korban.lihat-dokumen', ['id' => $dok->id, 'jenis' => 'dokumentasi']) }}" target="_blank" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1 px-2.5 py-1" style="font-size: 0.78rem;">
                                        <i class="fas fa-image"></i> Lihat Foto
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1">Tidak ada file</span>
                                @endif
                            </td>
                            @hasanyrole('Damtan|Super User')
                            <td class="text-center">
                                <form action="{{ route('surat-korban.hapus-dokumen', $dok->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="Hapus Data Dokumen">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ auth()->check() ? 9 : 8 }}" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open d-block mb-2" style="font-size: 2rem; color: #cbd5e1;"></i>
                                Belum ada berkas SKK atau Dokumentasi yang diunggah.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    /* ==========================================================
       EKSPOR PER TAHUN & BULAN (Cetak PDF & Cetak Excel)
       ========================================================== */
    (function () {
        'use strict';
        var selTahun  = document.getElementById('tahunEkspor');
        var selBulan  = document.getElementById('bulanEkspor');
        var linkExcel = document.getElementById('linkExcel');
        var spanTahun = document.getElementById('printTahun');
        var namaBulanIndo = ['', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
        var tersimpan = null;

        // Link Excel ikut tahun & bulan yang dipilih (?tahun=XXXX&bulan=M)
        function urlExcel() {
            var base = linkExcel.dataset.base;
            var params = [];
            if (selTahun && selTahun.value) params.push('tahun=' + encodeURIComponent(selTahun.value));
            if (selBulan && selBulan.value) params.push('bulan=' + encodeURIComponent(selBulan.value));
            return params.length ? base + '?' + params.join('&') : base;
        }
        function updateLinkExcel() {
            if (linkExcel) linkExcel.href = urlExcel();
        }
        if (linkExcel) {
            updateLinkExcel();
            if (selTahun) selTahun.addEventListener('change', updateLinkExcel);
            if (selBulan) selBulan.addEventListener('change', updateLinkExcel);
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

        // Cetak PDF: baris yang tampil di halaman ini, difilter tahun & bulan terpilih
        window.cetakPdf = function () {
            var tahun = selTahun ? selTahun.value : '';
            var bulan = selBulan ? selBulan.value : '';
            var rows  = document.querySelectorAll('#tableBody tr[data-row]');
            var nomor = 0;
            tersimpan = [];

            rows.forEach(function (row) {
                var noCell = row.querySelector('.no-cell');
                tersimpan.push({ row: row, display: row.style.display, noCell: noCell, no: noCell ? noCell.textContent : '' });

                var matchTahun = !tahun || row.dataset.tahun === tahun;
                var matchBulan = !bulan || (row.dataset.bulan && String(parseInt(row.dataset.bulan, 10)) === String(parseInt(bulan, 10)));
                var tampil = row.style.display !== 'none' && matchTahun && matchBulan;
                if (tampil) {
                    nomor++;
                    if (noCell) noCell.textContent = nomor;
                } else {
                    row.style.display = 'none';
                }
            });

            if (nomor === 0) {
                pulihkan();
                var pesan = 'Tidak ada surat';
                if (bulan && tahun) pesan += ' pada ' + namaBulanIndo[parseInt(bulan, 10)] + ' ' + tahun;
                else if (tahun) pesan += ' pada tahun ' + tahun;
                else if (bulan) pesan += ' pada bulan ' + namaBulanIndo[parseInt(bulan, 10)];
                alert(pesan + ' di halaman ini.');
                return;
            }

            if (spanTahun) {
                var teksPeriode = '';
                if (bulan && tahun) teksPeriode = ' BULAN ' + namaBulanIndo[parseInt(bulan, 10)] + ' ' + tahun;
                else if (tahun) teksPeriode = ' TAHUN ' + tahun;
                else if (bulan) teksPeriode = ' BULAN ' + namaBulanIndo[parseInt(bulan, 10)];
                spanTahun.textContent = teksPeriode ? ' ' + teksPeriode : '';
            }
            window.print();
        };

        window.addEventListener('afterprint', pulihkan);
    })();

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const filterTahun = document.getElementById('filterTahun');
        const rows        = document.querySelectorAll('#tableBody tr[data-row]');
        const noResult    = document.getElementById('noResult');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const yearTerm   = filterTahun.value;
            let visible = 0;

            rows.forEach(function (row) {
                const matchesSearch = row.textContent.toLowerCase().includes(searchTerm);
                const matchesYear   = yearTerm === '' || row.dataset.tahun === yearTerm;
                const show = matchesSearch && matchesYear;
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
        filterTahun.addEventListener('change', filterTable);

        // dibuat global agar bisa dipanggil dari onclick="resetFilter()"
        window.resetFilter = function () {
            searchInput.value = '';
            filterTahun.value = '';
            filterTable();
        };

        window.scrollTable = function (distance) {
            const el = document.querySelector('.rekap-scroll');
            if (el) {
                el.scrollBy({ left: distance, behavior: 'smooth' });
            }
        };

        const daftarSuratRef = @json($daftarSuratList ?? []);
        window.autoFillSurat = function (val) {
            if (!val) return;
            const s = daftarSuratRef.find(item => (item.nomor_surat || '').toLowerCase() === val.toLowerCase().trim());
            if (s) {
                const elNama = document.getElementById('input_nama');
                const elNik = document.getElementById('input_nik');
                const elTtl = document.getElementById('input_ttl');
                const elAlamat = document.getElementById('input_alamat');

                if (elNama && s.nama_korban) elNama.value = s.nama_korban;
                if (elNik && s.nik) elNik.value = s.nik;
                if (elTtl) {
                    let ttl = (s.tempat_lahir || '') + (s.tanggal_lahir ? ', ' + s.tanggal_lahir : '');
                    elTtl.value = ttl.trim().replace(/^,|,$/g, '');
                }
                if (elAlamat && s.alamat) elAlamat.value = s.alamat;
            }
        };

        filterTable(); // terapkan warna selang-seling saat halaman dimuat
    });
</script>
@endpush