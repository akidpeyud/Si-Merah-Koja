@extends('layouts.dashboard')

@section('title', 'Data Laporan Penyelamatan')

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

    .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
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
        transition: all .2s ease; text-decoration: none;
    }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }

    /* ==========================================================
       TAB KATEGORI (pill): Kebakaran / Non-Kebakaran
       ========================================================== */
    .tab-kategori {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 6px; margin-bottom: 20px;
        background: #fff; border: 1px solid var(--line);
        border-radius: 999px; box-shadow: var(--shadow-sm);
        max-width: 100%; overflow-x: auto;
    }
    .tab-kategori a {
        padding: 10px 28px; border-radius: 999px;
        font-size: .92rem; font-weight: 700;
        color: var(--steel); text-decoration: none;
        transition: all .2s ease; white-space: nowrap;
    }
    .tab-kategori a:hover { color: var(--ink); }
    .tab-kategori a.active {
        background: var(--navy); color: #fff;
        box-shadow: 0 4px 10px rgba(22, 58, 99, .25);
    }

    /* ==========================================================
       BAR FILTER (cari, tanggal, tahun, reset)
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
        min-width: 290px;
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
    .export-item .ico.fire  { background: var(--excel-soft); color: var(--excel); }
    .export-item .ico.non   { background: var(--excel-soft); color: var(--excel); }
    .export-item .txt { display: flex; flex-direction: column; line-height: 1.3; }
    .export-item .txt strong { font-size: .88rem; color: var(--ink); }
    .export-item .txt small { font-size: .76rem; color: var(--steel); }

    /* Pilihan tahun di dalam menu ekspor */
    .export-year { padding: 4px 10px 10px; border-bottom: 1px solid var(--line); margin-bottom: 8px; }
    .export-year label { display: block; margin-bottom: 6px; font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel); }
    .export-year .form-select { min-height: 38px; font-size: .88rem; font-weight: 600; }

    /* ==========================================================
       TABEL REKAP (gaya header navy)
       ========================================================== */
    .rekap-scroll { overflow-x: auto; padding: 20px; background: #fff; }
    .rekap-wrap { border: 2px solid var(--rekap-red); border-radius: 16px; overflow: hidden; background: #fff; box-shadow: var(--shadow-sm); }

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

    .col-no     { width: 64px; }
    .col-tgl    { width: 150px; }
    .col-jam    { width: 80px; }
    .col-jenis  { width: 150px; }
    .col-sebab  { width: 150px; }
    .col-lokasi { width: 240px; }
    .col-armada { width: 170px; }
    .col-air    { width: 120px; }
    .col-respon { width: 100px; }
    .col-luas   { width: 110px; }
    .col-aksi   { width: 130px; }

    .cell-lokasi { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-align: center; }
    .cell-muted  { color: var(--steel-soft); }
    .cell-strong { font-weight: 600; color: var(--ink); }

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
        .topbar, .sidebar, .sidebar-backdrop, .page-header, .card-header, .card-footer, .tab-kategori,
        .btn, .dropdown, form, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert, .d-print-none { display: none !important; }
        html { background: #fff !important; margin: 0 !important; padding: 0 !important; }
        body { background-color: white !important; font-size: 9.5pt !important; margin: 0 !important; padding: 1cm !important; box-sizing: border-box !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }
        .card-custom { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
        .card-body { padding: 0 !important; }

        .rekap-scroll { padding: 0 !important; overflow: visible !important; }
        .rekap-wrap { min-width: 0 !important; border: none !important; border-radius: 0 !important; box-shadow: none !important; }
        .table-rekap { width: 100% !important; margin-bottom: 20px; table-layout: auto !important; border-collapse: collapse !important; }
        .table-rekap thead th { background: #f2f2f2 !important; color: #000 !important; border: 1px solid #000 !important; font-size: 9pt !important; padding: 6px 4px !important; }
        .table-rekap tbody td, .table-rekap tbody tr.alt td { background: #fff !important; color: #000 !important; border: 1px solid #000 !important; padding: 5px 4px !important; font-size: 8.5pt !important; line-height: 1.35 !important; }
        .table-rekap tbody td.no-cell { background: #fff !important; color: #000 !important; font-size: 9.5pt !important; font-weight: bold !important; border: 1px solid #000 !important; }
        th:last-child, td:last-child { display: none !important; }
    }
</style>
@endpush

@section('content')

@php
    use Carbon\Carbon;

    // Tab aktif (dikirim dari controller, default kebakaran)
    $tab = $tab ?? request('tab', 'kebakaran');
    if (!in_array($tab, ['kebakaran', 'non-kebakaran'])) {
        $tab = 'kebakaran';
    }
    $isTabFire = $tab === 'kebakaran';
    $jmlKolom  = $isTabFire ? 11 : 8;

    $mapPenyebab = [
        'arus_pendek'       => 'Arus pendek listrik',
        'kebocoran_gas'     => 'Kebocoran gas',
        'sambaran_petir'    => 'Sambaran petir',
        'kelalaian_manusia' => 'Kelalaian manusia',
        'faktor_alam'       => 'Faktor alam',
    ];

    // Daftar tahun dari SEMUA data (dikirim controller sebagai $tahunList),
    // ditambah tahun berjalan dan tahun yang sedang difilter, terbaru di atas.
    $daftarTahun = collect($tahunList ?? [])
        ->filter()
        ->push((int) date('Y'))
        ->when(request('tahun'), fn ($c) => $c->push((int) request('tahun')))
        ->map(fn ($t) => (int) $t)
        ->unique()
        ->sortDesc()
        ->values();

    // Apakah ada filter yang sedang aktif?
    $adaFilter = request()->filled('q') || request()->filled('tanggal') || request()->filled('tahun');
@endphp

    <div class="page-header">
        <div class="page-header-text">
            <h1>Data Laporan Penyelamatan</h1>
            <p>Daftar seluruh laporan kejadian yang telah diinput ke dalam sistem.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap align-items-center">
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
                                <option value="{{ $thn }}" {{ $thn == date('Y') ? 'selected' : '' }}>{{ $thn }}</option>
                            @endforeach
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
                        <a class="dropdown-item export-item" href="#" data-kategori="kebakaran">
                            <span class="ico fire"><i class="fas fa-file-excel"></i></span>
                            <span class="txt">
                                <strong>Cetak Excel Kebakaran</strong>
                                <small>Unduh rekap kejadian kebakaran (.xlsx)</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item export-item" href="#" data-kategori="non-kebakaran">
                            <span class="ico non"><i class="fas fa-file-excel"></i></span>
                            <span class="txt">
                                <strong>Cetak Excel Non-Kebakaran</strong>
                                <small>Unduh rekap penyelamatan &amp; non-kebakaran (.xlsx)</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CREATE: HANYA DAMTAN DAN SUPER USER -->
            @hasanyrole('Damtan|Super User')
            <a href="/internal/damtan/input-data?kategori={{ $tab }}" class="btn-custom-primary shadow-sm">
                <i class="fas fa-plus me-2"></i> Buat Laporan Baru
            </a>
            @endhasanyrole
        </div>
    </div>

    <!-- TAB KATEGORI (filter yang aktif ikut terbawa, halaman kembali ke 1) -->
    <div class="tab-kategori d-print-none">
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'kebakaran', 'page' => null]) }}"
           class="{{ $isTabFire ? 'active' : '' }}">Kebakaran</a>
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'non-kebakaran', 'page' => null]) }}"
           class="{{ !$isTabFire ? 'active' : '' }}">Non-Kebakaran</a>
    </div>

    <div class="card-custom">
        <!-- Filter & Search Bar: FORM GET, filter diproses di server -->
        <div class="card-header bg-white p-4 border-bottom border-light">
            <form method="GET" action="{{ url()->current() }}" id="formFilter" class="row g-3 filter-bar align-items-center">
                <input type="hidden" name="tab" value="{{ $tab }}">

                <div class="col-12 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="q" id="searchInput" value="{{ request('q') }}"
                               class="form-control border-start-0 ps-0"
                               placeholder="Cari nomor laporan, lokasi, penyebab, dsb...">
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal') }}"
                           class="form-control" title="Filter tanggal kejadian">
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <select name="tahun" id="filterTahun" class="form-select" title="Filter tahun kejadian">
                        <option value="">Semua Tahun</option>
                        @foreach($daftarTahun as $thn)
                            <option value="{{ $thn }}" {{ (string) request('tahun') === (string) $thn ? 'selected' : '' }}>{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 ms-lg-auto">
                    <a href="{{ url()->current() }}?tab={{ $tab }}" class="btn-custom-light btn-reset">
                        <i class="fas fa-sync-alt"></i> Reset
                    </a>
                </div>
            </form>
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
                <h3 style="text-align: center !important; font-weight: bold; margin-bottom: 5px; font-size: 16px; color: black; font-family: 'Times New Roman', Times, serif;">REKAPITULASI DATA LAPORAN {{ $isTabFire ? 'KEBAKARAN' : 'NON-KEBAKARAN' }}<span id="printTahun"></span></h3>
                <p style="text-align: center !important; font-size: 12px; margin-bottom: 15px; color: black; font-family: 'Times New Roman', Times, serif;">Dicetak pada: {{ date('d F Y') }}</p>
            </div>

            <div class="rekap-scroll">
                <div class="rekap-wrap" style="min-width: {{ $isTabFire ? '1180px' : '900px' }};">
                    <table class="table-rekap" id="tableRekap">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-tgl">Tanggal Kejadian</th>
                                <th class="col-jam">Jam</th>
                                @if($isTabFire)
                                    <th class="col-jenis">Jenis Yang Terbakar</th>
                                    <th class="col-sebab">Penyebab</th>
                                @else
                                    <th class="col-jenis">Jenis Kegiatan</th>
                                @endif
                                <th class="col-lokasi">Lokasi Kejadian</th>
                                <th class="col-armada">Armada</th>
                                @if($isTabFire)
                                    <th class="col-air">Jumlah Air</th>
                                @endif
                                <th class="col-respon">Respon Time</th>
                                @if($isTabFire)
                                    <th class="col-luas">Luas Lahan</th>
                                @endif
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($data_laporan as $index => $row)
                            @php
                                // Ambil atribut mentah agar aman walau ada kolom yang belum dibuat
                                $a = $row->getAttributes();

                                $isFire = strtolower($a['kategori_kejadian'] ?? '') === 'kebakaran';

                                // Tanggal & jam
                                // Fallback tanggal = created_at (BUKAN waktu_kejadian, karena isinya hanya jam
                                // sehingga Carbon::parse akan menghasilkan tanggal hari ini).
                                $tglRaw = $a['tanggal_kejadian'] ?? $a['created_at'] ?? null;
                                $jamRaw = $a['waktu_kejadian'] ?? $a['waktu_terima'] ?? null;
                                $tglTampil = $tglRaw ? Carbon::parse($tglRaw)->locale('id')->translatedFormat('d F Y') : '-';
                                $tglFilter = $tglRaw ? Carbon::parse($tglRaw)->format('Y-m-d') : '';
                                $jamTampil = $jamRaw ? Carbon::parse($jamRaw)->format('H.i') : '-';

                                // Jenis yang terbakar / jenis kegiatan non-kebakaran
                                $jenisFire = !empty($a['kategori_kebakaran']) ? ucwords(str_replace('_', ' ', $a['kategori_kebakaran'])) : '-';
                                $jenisNon  = !empty($a['kategori_non_kebakaran'])
                                    ? str_replace('_', ' ', $a['kategori_non_kebakaran'])
                                    : str_replace('_', ' ', $a['kategori_kejadian'] ?? '-');

                                // Penyebab
                                $p = $a['dugaan_penyebab'] ?? null;
                                if ($p === 'lainnya') {
                                    $penyebab = $a['dugaan_penyebab_lainnya'] ?? '-';
                                } elseif ($p) {
                                    $penyebab = $mapPenyebab[$p] ?? ucwords(str_replace('_', ' ', $p));
                                } else {
                                    $penyebab = '-';
                                }

                                // Armada
                                // Kolom bisa tersimpan sebagai JSON biasa atau ter-encode dua kali,
                                // jadi di-decode berulang (maks. 2x) sampai menjadi array.
                                $jmlArmada = $a['jumlah_armada'] ?? null;
                                $armadaTxt = '-';
                                if ($jmlArmada !== null && $jmlArmada !== '') {
                                    $armadaTxt = $jmlArmada . ' Unit Armada';
                                } elseif (!empty($a['armada'])) {
                                    $arm = $a['armada'];
                                    for ($i = 0; $i < 2 && is_string($arm); $i++) {
                                        $d = json_decode($arm, true);
                                        if ($d === null) break;
                                        $arm = $d;
                                    }
                                    $armadaTxt = is_array($arm)
                                        ? (count($arm) ? implode(', ', array_map('ucfirst', $arm)) : '-')
                                        : $arm;
                                }

                                // Jumlah air
                                $air = $a['liter_air'] ?? null;
                                $airTxt = (is_numeric($air) && $air > 0) ? number_format($air, 0, ',', '.') . ' Liter' : '-';

                                // Respon time: dihitung otomatis (Waktu Terima -> Waktu Tiba), lihat accessor di model
                                $rt = $row->respon_time;
                                $responTxt = (!is_null($rt) && $rt >= 0) ? $rt . ' mnt' : '-';

                                // Luas
                                $luas = $a['luas_area'] ?? null;
                                $luasTxt = (is_numeric($luas) && $luas > 0)
                                    ? number_format((float) $luas, fmod((float) $luas, 1) == 0 ? 0 : 1, ',', '.') . ' m²'
                                    : '-';

                                $lokasi = !empty($a['alamat']) ? $a['alamat'] : '-';
                            @endphp
                            <tr class="{{ $loop->odd ? 'alt' : '' }}" data-kategori="{{ $isFire ? 'kebakaran' : 'non-kebakaran' }}" data-tanggal="{{ $tglFilter }}" data-tahun="{{ $tglRaw ? Carbon::parse($tglRaw)->year : '' }}">
                                <td class="no-cell">{{ $data_laporan->firstItem() + $index }}</td>

                                <td class="cell-strong">{{ $tglTampil }}</td>

                                <td>{{ $jamTampil }}</td>

                                @if($isTabFire)
                                    <td><span class="cell-strong">{{ $jenisFire }}</span></td>
                                    <td>{{ $penyebab }}</td>
                                @else
                                    <td><span class="cell-strong text-capitalize">{{ $jenisNon }}</span></td>
                                @endif

                                <td><div class="cell-lokasi" title="{{ $lokasi }}">{{ $lokasi }}</div></td>

                                <td>{{ $armadaTxt }}</td>

                                @if($isTabFire)
                                    <td>{!! $airTxt === '-' ? '<span class="cell-muted">-</span>' : e($airTxt) !!}</td>
                                @endif

                                <td>{!! $responTxt === '-' ? '<span class="cell-muted">-</span>' : e($responTxt) !!}</td>

                                @if($isTabFire)
                                    <td>{!! $luasTxt === '-' ? '<span class="cell-muted">-</span>' : e($luasTxt) !!}</td>
                                @endif

                                <td>
                                    <div class="aksi-group">
                                        <!-- LIHAT: SEMUA ROLE -->
                                        <a href="/internal/damtan/lihat-data/{{ $row->id }}" class="action-btn view" title="Lihat Detail"><i class="fas fa-eye"></i></a>

                                        <!-- UPDATE & DELETE: HANYA DAMTAN DAN SUPER USER -->
                                        @hasanyrole('Damtan|Super User')
                                        <a href="/internal/damtan/edit-data/{{ $row->id }}" class="action-btn edit" title="Edit Laporan"><i class="fas fa-edit"></i></a>
                                        <form action="/internal/damtan/hapus-data/{{ $row->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan {{ $row->nomor_laporan }} secara permanen?')">
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
                                <td colspan="{{ $jmlKolom }}">
                                    @if($adaFilter)
                                        <i class="fas fa-search d-block"></i>
                                        Tidak ada laporan yang cocok dengan pencarian atau filter.
                                    @else
                                        <i class="fas fa-folder-open d-block"></i>
                                        Belum ada data laporan {{ $isTabFire ? 'kebakaran' : 'non-kebakaran' }}.
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white p-4 d-flex justify-content-between align-items-center border-top">
            <span class="text-muted" style="font-size: 13px;" id="dataCount">
                Menampilkan {{ $data_laporan->firstItem() ?? 0 }} - {{ $data_laporan->lastItem() ?? 0 }} dari total {{ $data_laporan->total() }} laporan {{ $isTabFire ? 'kebakaran' : 'non-kebakaran' }}
            </span>
            <div class="pagination-container mb-0">
                {{ $data_laporan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows        = document.querySelectorAll('#tableBody tr[data-kategori]');
        const form        = document.getElementById('formFilter');
        const searchInput = document.getElementById('searchInput');

        /* ==========================================================
           FILTER (dijalankan di SERVER lewat form GET)
           ========================================================== */
        // Tanggal & tahun: kirim otomatis saat berubah
        document.getElementById('filterTanggal').addEventListener('change', function () { form.submit(); });
        document.getElementById('filterTahun').addEventListener('change', function () { form.submit(); });

        // Pencarian: kirim 500ms setelah berhenti mengetik
        let timer;
        searchInput.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { form.submit(); }, 500);
        });

        // Kembalikan fokus ke kolom pencarian setelah halaman dimuat ulang
        if (searchInput.value !== '') {
            searchInput.focus();
            const n = searchInput.value.length;
            searchInput.setSelectionRange(n, n);
        }

        /* ==========================================================
           EKSPOR (Cetak PDF & Cetak Excel) per tahun
           ========================================================== */
        const selTahun  = document.getElementById('tahunEkspor');
        const spanTahun = document.getElementById('printTahun');
        let tersimpan   = null;

        // Excel: /internal/damtan/export-excel?tahun=YYYY&kategori=...
        document.querySelectorAll('.export-item[data-kategori]').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                let url = '/internal/damtan/export-excel?kategori=' + encodeURIComponent(item.dataset.kategori);
                if (selTahun && selTahun.value) url += '&tahun=' + encodeURIComponent(selTahun.value);
                window.location.href = url;
            });
        });

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

        // Cetak PDF: baris yang sedang tampil, hanya pada tahun terpilih
        window.cetakPdf = function () {
            const tahun = selTahun ? selTahun.value : '';
            let nomor = 0;
            tersimpan = [];

            rows.forEach(function (row) {
                const noCell = row.querySelector('.no-cell');
                tersimpan.push({ row: row, display: row.style.display, noCell: noCell, no: noCell ? noCell.textContent : '' });

                const tampil = row.style.display !== 'none' && (!tahun || row.dataset.tahun === tahun);
                if (tampil) {
                    nomor++;
                    if (noCell) noCell.textContent = nomor;
                } else {
                    row.style.display = 'none';
                }
            });

            if (nomor === 0) {
                pulihkan();
                alert(tahun ? 'Tidak ada laporan pada tahun ' + tahun + ' di halaman ini.' : 'Tidak ada data untuk dicetak.');
                return;
            }

            if (spanTahun) spanTahun.textContent = tahun ? ' TAHUN ' + tahun : '';
            window.print();
        };

        window.addEventListener('afterprint', pulihkan);
    });
</script>
@endpush