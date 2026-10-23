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
    .rekap-wrap { min-width: 760px; border: 2px solid var(--rekap-red); border-radius: 16px; overflow: hidden; background: #fff; box-shadow: var(--shadow-sm); }

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

    .col-no    { width: 64px; }
    .col-nomor { width: 280px; }
    .col-tgl   { width: 190px; }
    .col-aksi  { width: 130px; }

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

    @page { margin: 0; }
    @media print {
        .topbar, .sidebar, .sidebar-backdrop, .page-header, .card-header, .card-footer,
        .btn, .dropdown, form, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert, .d-print-none { display: none !important; }
        body { background-color: white !important; font-size: 12px; margin: 1.5cm !important; -webkit-print-color-adjust: exact; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; }
        .card-custom { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
        .card-body { padding: 0 !important; }

        .rekap-scroll { padding: 0 !important; overflow: visible !important; }
        .rekap-wrap { min-width: 0 !important; border: none !important; border-radius: 0 !important; box-shadow: none !important; }
        .table-rekap { width: 100% !important; margin-bottom: 20px; }
        .table-rekap thead th { background: #f2f2f2 !important; color: #000 !important; border: 1px solid #000 !important; font-size: 11px; padding: 6px !important; }
        .table-rekap tbody td, .table-rekap tbody tr.alt td { background: #fff !important; color: #000 !important; border: 1px solid #000 !important; padding: 6px !important; font-size: 11px; }
        .table-rekap tbody td.no-cell { background: #fff !important; color: #000 !important; font-size: 12px; }
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

            <div class="rekap-scroll">
                <div class="rekap-wrap">
                    <table class="table-rekap">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-nomor">Nomor Surat</th>
                                <th class="col-nama">Nama Korban / Instansi</th>
                                <th class="col-tgl">Tanggal Diterbitkan</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($surat as $index => $row)
                            <tr data-row data-tahun="{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->year : '' }}">
                                <td class="no-cell">{{ $surat->firstItem() + $index }}</td>

                                <td class="cell-strong">{{ $row->nomor_surat }}</td>

                                <td class="cell-nama">{{ $row->nama_korban }}</td>

                                <td class="cell-strong">
                                    {{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y') : '-' }}
                                </td>

                                <td>
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
                                <td colspan="5">
                                    <i class="fas fa-envelope-open-text d-block"></i>
                                    Belum ada surat keterangan korban yang diterbitkan.
                                </td>
                            </tr>
                            @endforelse

                            {{-- Muncul otomatis jika pencarian/filter tidak menemukan hasil --}}
                            <tr class="empty-state" id="noResult" hidden>
                                <td colspan="5">
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

@endsection

@push('scripts')
<script>
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

        // Cetak PDF: baris yang tampil di halaman ini, dan hanya pada tahun terpilih
        window.cetakPdf = function () {
            var tahun = selTahun ? selTahun.value : '';
            var rows  = document.querySelectorAll('#tableBody tr[data-row]');
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
                alert(tahun ? 'Tidak ada surat pada tahun ' + tahun + ' di halaman ini.' : 'Tidak ada data untuk dicetak.');
                return;
            }

            if (spanTahun) spanTahun.textContent = tahun ? ' TAHUN ' + tahun : '';
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

        filterTable(); // terapkan warna selang-seling saat halaman dimuat
    });
</script>
@endpush