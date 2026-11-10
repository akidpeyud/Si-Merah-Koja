@extends('layouts.dashboard')

@section('title'){{ $judul_diklat ?? 'Diklat F1' }}@endsection

@push('styles')
<style>
    .toast-wrap {
        position: fixed; z-index: 1100; top: 18px; left: 50%;
        transform: translateX(-50%);
        display: grid; gap: 10px;
        width: max-content; max-width: calc(100vw - 24px);
    }
    .topbar {
        position: sticky; top: 0; z-index: 1020;
        height: var(--topbar-h);
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 0 28px;
        background: var(--ink);
        border-bottom: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
    }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }

    /* ===== HEADER ===== */
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-weight: 800; letter-spacing: -0.02em; color: var(--ink, #0f172a); margin-bottom: 6px; }
    .page-head p { color: var(--steel, #64748b); font-size: .92rem; margin-bottom: 0; }
    .page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 10px; }
    .page-toolbar .page-head { margin-bottom: 0; }
    .toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }

    .btn-tool {
        display: inline-flex; align-items: center; gap: 8px;
        height: 42px; padding: 0 18px; border-radius: 10px;
        font-weight: 700; font-size: .84rem; color: #fff; border: none;
        transition: all .2s ease; text-decoration: none; cursor: pointer;
        box-shadow: 0 2px 6px rgba(15, 23, 42, .08);
    }
    .btn-tool:hover { color: #fff; transform: translateY(-1px); filter: brightness(1.06); box-shadow: 0 4px 12px rgba(15, 23, 42, .14); }
    .btn-tool:active { transform: translateY(0); }
    .btn-tool.navy { background: var(--navy, #163a63); }
    .btn-tool.green { background: var(--success, #15803d); }
    .btn-tool.red { background: var(--signal, #dc2626); }

    /* ===== TABS ===== */
    .custom-nav-tabs {
        display: flex; flex-wrap: nowrap; gap: 8px; overflow-x: auto;
        margin-top: 18px; padding-bottom: 0;
        border-bottom: 1px solid var(--line, #e2e8f0);
    }
    .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
    .custom-nav-tabs::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-nav-tabs .nav-link {
        border: none; border-bottom: 3px solid transparent; border-radius: 0;
        color: var(--steel, #64748b); font-weight: 700; font-size: .8rem; letter-spacing: .03em;
        padding: 12px 18px; background: transparent; white-space: nowrap;
        transition: color .2s, border-color .2s, background .2s;
    }
    .custom-nav-tabs .nav-link:hover { color: var(--ink, #0f172a); background: rgba(22, 58, 99, .04); }
    .custom-nav-tabs .nav-link.active { color: var(--navy, #163a63); border-bottom-color: var(--navy, #163a63); }

    /* ===== FILTER BAR ===== */
    .filter-bar {
        display: flex; flex-wrap: wrap; gap: 12px; align-items: center;
        background: #ffffff; padding: 14px 18px; border-radius: 14px;
        border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(15, 23, 42, .03);
        margin: 22px 0 18px;
    }
    .search-box { position: relative; flex: 1 1 300px; }
    .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: .88rem; pointer-events: none; }
    .search-box input {
        width: 100%; height: 42px; padding: 0 16px 0 40px;
        border: 1px solid #cbd5e1; border-radius: 10px;
        background: #f8fafc; font-size: .86rem; color: #0f172a; transition: all .2s ease;
    }
    .search-box input:focus { outline: none; background: #fff; border-color: var(--navy, #163a63); box-shadow: 0 0 0 3px rgba(22, 58, 99, .12); }
    .filter-select {
        height: 42px; padding: 0 36px 0 14px; border: 1px solid #cbd5e1; border-radius: 10px;
        background-color: #f8fafc; font-size: .85rem; font-weight: 600; color: #1e293b;
        min-width: 175px; max-width: 260px; cursor: pointer; transition: all .2s ease;
    }
    .filter-select:focus { outline: none; background-color: #fff; border-color: var(--navy, #163a63); box-shadow: 0 0 0 3px rgba(22, 58, 99, .12); }
    .btn-reset-filter {
        height: 42px; padding: 0 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #ffffff;
        color: #475569; font-size: .84rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;
        cursor: pointer; transition: all .2s ease; white-space: nowrap;
    }
    .btn-reset-filter:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }

    /* ===== BANNER REKAPITULASI ===== */
    .summary-strip {
        display: flex; flex-wrap: wrap; gap: 14px; align-items: center; justify-content: space-between;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: #fff;
        padding: 16px 22px; border-radius: 14px; margin-bottom: 24px; box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .summary-strip-title { display: flex; align-items: center; gap: 12px; }
    .summary-strip-title i {
        width: 42px; height: 42px; border-radius: 10px; background: rgba(255,255,255,.12); color: #38bdf8;
        display: grid; place-items: center; font-size: 1.1rem;
    }
    .summary-strip-title h4 { margin: 0; font-size: .96rem; font-weight: 800; letter-spacing: .01em; text-transform: uppercase; }
    .summary-strip-title p { margin: 2px 0 0; font-size: .78rem; color: rgba(255,255,255,.75); }
    .summary-metrics { display: flex; flex-wrap: wrap; gap: 12px; }
    .summary-metric-box { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15); padding: 8px 16px; border-radius: 10px; text-align: center; min-width: 120px; }
    .summary-metric-box span { display: block; font-size: .68rem; text-transform: uppercase; letter-spacing: .05em; color: rgba(255,255,255,.75); font-weight: 600; }
    .summary-metric-box strong { font-size: 1.1rem; font-weight: 800; color: #fff; }
    .summary-metric-box.highlight { background: #f59e0b; border-color: #fbbf24; }
    .summary-metric-box.highlight span { color: #451a03; font-weight: 700; }
    .summary-metric-box.highlight strong { color: #0f172a; }

    /* ===== JUDUL TABEL ===== */
    .table-title-row { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin: 26px 0 14px; padding: 0 4px; }
    .table-title {
        display: flex; align-items: center; gap: 12px;
        font-family: var(--font-display); font-weight: 800; font-size: 1.08rem;
        color: var(--ink); letter-spacing: -.01em; text-transform: uppercase; margin: 0;
    }
    .table-title .ico {
        width: 34px; height: 34px; border-radius: 9px; background: #163a63; color: #fff;
        display: grid; place-items: center; font-size: .85rem;
        box-shadow: 0 4px 10px rgba(22, 58, 99, .18);
    }
    .year-block-pills { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
    .year-stat-pill { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }
    .year-stat-pill.total { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }

    /* ===== TABEL ===== */
    .table-scroll-wrapper {
        width: 100%; overflow-x: auto; background: #fff;
        border-radius: 14px; border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04); margin-bottom: 40px;
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: #f8fafc; }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 2500px; margin-bottom: 0; }
    .table-detailed thead { background: #0f172a; color: #fff; }
    .table-detailed th {
        font-size: .72rem; font-weight: 700; padding: 16px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .06em; vertical-align: middle;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }
    .table-detailed th:last-child { border-right: none; }
    .table-detailed td {
        font-size: .86rem; padding: 16px; vertical-align: middle; white-space: nowrap;
        border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f8fafc; color: #334155;
    }
    .table-detailed tbody tr { transition: background .15s ease; }
    .table-detailed tbody tr:hover { background: #f8fafc; }

    .cell-nama { font-weight: 700; color: #0f172a; font-size: .92rem; }
    .badge-soft-blue {
        display: inline-block; background: #eff6ff; color: #1d4ed8;
        padding: 5px 12px; font-weight: 700; font-size: .78rem; border-radius: 6px;
        border: 1px solid #dbeafe;
    }
    .badge-diklat {
        display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .03em;
        padding: 5px 10px; border-radius: 6px; background: rgba(22, 58, 99, .08); color: #163a63;
    }

    .aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 8px; }
    .aksi-wrap form { margin: 0; display: inline-flex; }
    .btn-action {
        width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center;
        border-radius: 9px; font-size: .82rem; color: #fff; border: none; cursor: pointer;
        transition: transform .15s ease, filter .2s ease, box-shadow .2s ease; text-decoration: none;
    }
    .btn-action:hover { transform: translateY(-1px); color: #fff; filter: brightness(1.06); box-shadow: 0 3px 8px rgba(0,0,0,.12); }
    .btn-edit { background: #f59e0b; color: #0f172a; }
    .btn-edit:hover { color: #0f172a; }
    .btn-delete { background: #ef4444; }
    .empty-state { text-align: center; padding: 54px 12px !important; color: #64748b; font-weight: 600; }
    .empty-state i { font-size: 28px; color: #cbd5e1; margin-bottom: 8px; }

    @media (max-width: 1100px) {
        .topbar { padding: 0 20px; }
        .content { padding: 32px 26px 60px; }
    }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .brand { gap: 9px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .topbar-right { gap: 7px; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .user-avatar { width: 34px; height: 34px; }
        .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 16px 50px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .toolbar-actions { width: 100%; }
        .filter-select { flex: 1 1 auto; max-width: none; }
        .summary-metrics { width: 100%; }
        .summary-metric-box { flex: 1 1 auto; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
    @media print {
        .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
        .brand span { color: #000 !important; }
        .sidebar, .btn-logout, .toolbar-actions, .filter-bar, .toast-wrap { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
        .summary-strip { background: #fff !important; color: #000 !important; border: 1px solid #ddd; box-shadow: none; }
        .summary-strip * { color: #000 !important; }
    }
</style>
@endpush

@section('content')
        @php
            $judul = $judul_diklat ?? 'DIKLAT PEMADAM I';
            $jenis_url = $jenis_slug ?? (Request::is('*diklat-f2*') ? 'diklat-f2' : (Request::is('*diklat-f1*') ? 'diklat-f1' : strtolower(str_replace(' ', '-', $judul))));
            $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);

            $koleksiData = collect($data_diklat ?? []);

            // Opsi filter diambil dari data yang ada
            $daftar_kualifikasi = $koleksiData->pluck('kualifikasi')->filter()->unique()->sort()->values();
            $daftar_tempat      = $koleksiData->pluck('tempat_pelaksanaan')->filter()->unique()->sort()->values();

            // Tanggal berformat YYYY-MM-DD ditampilkan d-m-Y, teks bebas (data lama) apa adanya
            $tampilTanggal = function ($nilai) {
                $nilai = trim((string) $nilai);
                if ($nilai === '') {
                    return '-';
                }

                return preg_match('/^\d{4}-\d{2}-\d{2}/', $nilai)
                    ? \Carbon\Carbon::parse($nilai)->format('d-m-Y')
                    : $nilai;
            };

            // Tahun diambil dari tahun rekap (created_at seeder) atau dari 4 digit di "Tanggal Pelaksanaan"
            $ambilTahun = function ($item) {
                if (!empty($item->created_at) && preg_match('/^(19|20)\d{2}/', (string) $item->created_at, $mCreated)) {
                    if ((int) $mCreated[0] <= 2025) {
                        return $mCreated[0];
                    }
                }
                if (preg_match('/(19|20)\d{2}/', (string) ($item->tanggal_pelaksanaan ?? ''), $m)) return $m[0];
                return null;
            };
            $daftar_tahun = $koleksiData->map($ambilTahun)->filter()->unique()->sortDesc()->values();

            // Ringkasan awal
            $totalPeserta       = $koleksiData->count();
            $totalTempat        = $daftar_tempat->count();
            $totalKualifikasi   = $daftar_kualifikasi->count();
        @endphp

        <!-- HEADER KONTEN & TOMBOL AKSI -->
        <div class="page-toolbar">
            <div class="page-head">
                <h1>Peningkatan Kapasitas Aparatur</h1>
                <p>Kelola data diklat dan peningkatan kapasitas aparatur pemadam kebakaran.</p>
            </div>

            <div class="toolbar-actions">
                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/peningkatan-kapasitas/tambah?jenis={{ $judul }}" class="btn-tool navy">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <!-- EXCEL & PDF TERBUKA UNTUK SEMUA ROLE -->
                <a href="/internal/pencegahan/peningkatan-kapasitas/cetak-excel/{{ $jenis_url }}" class="btn-tool green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="/internal/pencegahan/peningkatan-kapasitas/cetak-pdf/{{ $jenis_url }}" target="_blank" class="btn-tool red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas">Semua Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diksar') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diksar">DIKSAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f1*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f1">DIKLAT F1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f2') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f2">DIKLAT F2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-rescue') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-rescue">DIKLAT RESCUE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-mfr') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-mfr">DIKLAT MFR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-operator') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-operator">DIKLAT OPERATOR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-inspektur') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur">DIKLAT INSPEKTUR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-ppl') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-ppl">DIKLAT PPL</a>
            </li>
        </ul>

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchDiklat" placeholder="Cari nama, NIP, jabatan, kualifikasi, tempat pelaksanaan, atau no STTP..." aria-label="Cari data diklat">
            </div>

            <select id="filterKualifikasi" class="filter-select" aria-label="Filter Kualifikasi">
                <option value="">Semua Kualifikasi</option>
                @foreach($daftar_kualifikasi as $kual)
                    <option value="{{ strtolower($kual) }}">{{ $kual }}</option>
                @endforeach
            </select>

            <select id="filterTempat" class="filter-select" aria-label="Filter Tempat Pelaksanaan">
                <option value="">Semua Tempat Pelaksanaan</option>
                @foreach($daftar_tempat as $tmp)
                    <option value="{{ strtolower($tmp) }}">{{ $tmp }}</option>
                @endforeach
            </select>

            <select id="filterTahun" class="filter-select" aria-label="Filter Tahun">
                <option value="">Semua Tahun</option>
                @foreach($daftar_tahun as $thn)
                    <option value="{{ $thn }}">Tahun {{ $thn }}</option>
                @endforeach
            </select>

            <button type="button" id="btnResetFilter" class="btn-reset-filter">
                <i class="fas fa-rotate-left"></i> Reset
            </button>
        </div>

        <!-- BANNER REKAPITULASI -->
        @if($koleksiData->isNotEmpty())
        <div class="summary-strip" id="summaryStrip">
            <div class="summary-strip-title">
                <i class="fas fa-user-graduate"></i>
                <div>
                    <h4 id="judulSummary">REKAPITULASI {{ $judul_diklat ?? 'DIKLAT' }} (SEMUA DATA)</h4>
                    <p>Akumulasi jumlah peserta diklat yang ditampilkan</p>
                </div>
            </div>
            <div class="summary-metrics">
                <div class="summary-metric-box">
                    <span>Tempat Pelaksanaan</span>
                    <strong id="grandTempat">{{ number_format($totalTempat, 0, ',', '.') }}</strong>
                </div>
                <div class="summary-metric-box">
                    <span>Kualifikasi</span>
                    <strong id="grandKualifikasi">{{ number_format($totalKualifikasi, 0, ',', '.') }}</strong>
                </div>
                <div class="summary-metric-box highlight">
                    <span>Jumlah Total Peserta</span>
                    <strong id="grandPeserta">{{ number_format($totalPeserta, 0, ',', '.') }} Orang</strong>
                </div>
            </div>
        </div>
        @endif

        <!-- ================= AREA TABEL DATA ================= -->
        <div class="table-title-row">
            <div class="table-title">
                <span class="ico"><i class="fas fa-list-check"></i></span>
                <span>DATA {{ strtoupper($judul_diklat ?? 'DIKLAT') }}</span>
            </div>
            <div class="year-block-pills">
                <span class="year-stat-pill">
                    <i class="fas fa-user-group text-secondary"></i>
                    <span id="pillJmlPeserta">{{ $totalPeserta }}</span> Peserta
                </span>
            </div>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="50px">Nomor</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Pangkat/Golongan Ruang</th>
                        <th>Jabatan</th>
                        <th>Kualifikasi</th>
                        <th>Tempat Pelaksanaan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Tanggal Selesai Pelaksanaan</th>
                        <th class="text-center">Jumlah Jam Pelajaran</th>
                        <th>No STTP</th>
                        <th>Tanggal STTP</th>
                        <th>Pejabat yang Menandatangani</th>
                        <th class="text-center">Sertifikat</th>

                        <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <th class="text-center" width="100px">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>

                <tbody id="tableBody">
                    @forelse (($data_diklat ?? []) as $index => $item)
                    <tr class="baris-data"
                        data-kualifikasi="{{ strtolower($item->kualifikasi ?? '') }}"
                        data-tempat="{{ strtolower($item->tempat_pelaksanaan ?? '') }}"
                        data-tahun="{{ $ambilTahun($item) }}"
                        data-jp="{{ (int) ($item->jumlah_jam_pelajaran ?? 0) }}"
                        data-pencarian="{{ strtolower(($item->nama ?? '') . ' ' . ($item->nip ?? '') . ' ' . ($item->jabatan ?? '') . ' ' . ($item->pangkat_golongan ?? '') . ' ' . ($item->kualifikasi ?? '') . ' ' . ($item->tempat_pelaksanaan ?? '') . ' ' . ($item->no_sttp ?? '') . ' ' . ($item->ditandatangani_oleh ?? '')) }}">
                        <td class="text-center fw-bold nomor-urut">{{ $index + 1 }}</td>
                        <td><div class="cell-nama">{{ $item->nama ?? '-' }}</div></td>
                        <td>{{ $item->nip ?? '-' }}</td>
                        <td>{{ $item->tempat_lahir ?? '-' }}</td>
                        <td>{{ $tampilTanggal($item->tgl_lahir ?? null) }}</td>
                        <td>{{ $item->pangkat_golongan ?? '-' }}</td>
                        <td>{{ $item->jabatan ?? '-' }}</td>
                        <td>{{ $item->kualifikasi ?? '-' }}</td>
                        <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                        <td>{{ $tampilTanggal($item->tanggal_pelaksanaan ?? null) }}</td>
                        <td>{{ $tampilTanggal($item->tanggal_selesai_pelaksanaan ?? null) }}</td>
                        <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran ?? '-' }}</span></td>
                        <td style="color: var(--ink); font-weight: 600;">{{ $item->no_sttp ?? '-' }}</td>
                        <td>{{ $tampilTanggal($item->tanggal_sttp ?? null) }}</td>
                        <td>{{ $item->ditandatangani_oleh ?? '-' }}</td>
                        <td class="text-center">
                            @if (! empty($item->file_sertifikat))
                                <a href="{{ asset('storage/' . $item->file_sertifikat) }}" target="_blank" rel="noopener" class="btn-action btn-edit" title="Lihat sertifikat">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <!-- TOMBOL EDIT & HAPUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <td>
                            <div class="aksi-wrap">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/{{ $jenis_url }}/{{ $item->id }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/{{ $jenis_url }}/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endhasanyrole
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="{{ $canCrud ? 17 : 16 }}" class="empty-state">
                            <i class="fas fa-folder-open"></i><br>
                            Belum ada data untuk {{ $judul_diklat ?? 'Diklat F1' }}.
                        </td>
                    </tr>
                    @endforelse

                    <!-- Pesan jika hasil filter tidak ditemukan -->
                    <tr id="emptyFilterState" style="display: none;">
                        <td colspan="{{ $canCrud ? 17 : 16 }}" class="empty-state">
                            <i class="fas fa-magnifying-glass"></i><br>
                            Data yang Anda cari tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';

        var searchInput        = document.getElementById('searchDiklat');
        var filterKualifikasi     = document.getElementById('filterKualifikasi');
        var filterTempat = document.getElementById('filterTempat');
        var filterTahun        = document.getElementById('filterTahun');
        var btnReset           = document.getElementById('btnResetFilter');
        var rows               = document.querySelectorAll('#tableBody tr.baris-data');
        var emptyState         = document.getElementById('emptyFilterState');

        var elTempat = document.getElementById('grandTempat');
        var elKualifikasi      = document.getElementById('grandKualifikasi');
        var elPeserta       = document.getElementById('grandPeserta');
        var pillPeserta     = document.getElementById('pillJmlPeserta');

        function formatRibuan(angka) {
            return (Number(angka) || 0).toLocaleString('id-ID');
        }

        function jalankanFilter() {
            var q    = searchInput ? searchInput.value.trim().toLowerCase() : '';
            var ins  = filterKualifikasi ? filterKualifikasi.value : '';
            var pen  = filterTempat ? filterTempat.value : '';
            var thn  = filterTahun ? filterTahun.value : '';

            var nomor = 1, totalPeserta = 0;
            var setKualifikasi = {}, setTempat = {};

            rows.forEach(function (tr) {
                var cocok =
                    (!q   || tr.getAttribute('data-pencarian').indexOf(q) > -1) &&
                    (!ins || tr.getAttribute('data-kualifikasi') === ins) &&
                    (!pen || tr.getAttribute('data-tempat') === pen) &&
                    (!thn || tr.getAttribute('data-tahun') === thn);

                if (cocok) {
                    tr.style.display = '';
                    var sel = tr.querySelector('.nomor-urut');
                    if (sel) sel.textContent = nomor++;

                    totalPeserta++;
                    if (tr.getAttribute('data-kualifikasi')) setKualifikasi[tr.getAttribute('data-kualifikasi')] = true;
                    if (tr.getAttribute('data-tempat')) setTempat[tr.getAttribute('data-tempat')] = true;
                } else {
                    tr.style.display = 'none';
                }
            });

            if (elTempat) elTempat.textContent = formatRibuan(Object.keys(setTempat).length);
            if (elKualifikasi)      elKualifikasi.textContent      = formatRibuan(Object.keys(setKualifikasi).length);
            if (elPeserta)       elPeserta.textContent       = formatRibuan(totalPeserta) + ' Orang';
            if (pillPeserta)     pillPeserta.textContent     = formatRibuan(totalPeserta);

            if (emptyState && rows.length > 0) {
                emptyState.style.display = totalPeserta === 0 ? '' : 'none';
            }
        }

        if (searchInput)         searchInput.addEventListener('input', jalankanFilter);
        if (filterKualifikasi)      filterKualifikasi.addEventListener('change', jalankanFilter);
        if (filterTempat) filterTempat.addEventListener('change', jalankanFilter);
        if (filterTahun)         filterTahun.addEventListener('change', jalankanFilter);
        if (btnReset) {
            btnReset.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (filterKualifikasi) filterKualifikasi.value = '';
                if (filterTempat) filterTempat.value = '';
                if (filterTahun) filterTahun.value = '';
                jalankanFilter();
            });
        }
    })();
</script>
@endpush