@extends('layouts.dashboard')

@section('title', 'Pelatihan Keluarga Tanggap Kebakaran')

@push('styles')
<style>
    .toast-wrap {
        position: fixed; z-index: 1100; top: 18px; left: 50%;
        transform: translateX(-50%);
        display: grid; gap: 10px;
        width: max-content; max-width: calc(100vw - 24px);
    }
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-weight: 800; letter-spacing: -0.02em; color: var(--ink, #0f172a); margin-bottom: 6px; }
    .page-head p { color: var(--steel, #64748b); font-size: .92rem; margin-bottom: 0; }
    .page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 10px; }
    .page-toolbar .page-head { margin-bottom: 0; }
    .toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }

    /* Tombol Aksi Atas */
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

    /* Dropdown Tombol Excel & PDF */
    .export-dropdown { position: relative; display: inline-block; }
    .export-menu {
        position: absolute; right: 0; top: calc(100% + 6px); z-index: 1050;
        background: #ffffff; min-width: 220px; border-radius: 12px;
        border: 1px solid #e2e8f0; padding: 6px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, .14);
        display: none;
    }
    .export-dropdown.open .export-menu { display: block; animation: fadeInMenu .15s ease-out; }
    @keyframes fadeInMenu {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .export-menu-label {
        font-size: .68rem; font-weight: 700; text-transform: uppercase;
        color: #94a3b8; padding: 6px 12px 4px; letter-spacing: .05em;
    }
    .export-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 8px 12px; border-radius: 8px; font-size: .83rem; font-weight: 600;
        color: #1e293b; text-decoration: none; transition: background .15s;
    }
    .export-item:hover { background: #f1f5f9; color: #0f172a; }
    .export-divider { height: 1px; background: #f1f5f9; margin: 4px 0; }

    /* Navigasi Tab */
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

    /* Filter Bar Modern */
    .filter-bar {
        display: flex; flex-wrap: wrap; gap: 12px; align-items: center;
        background: #ffffff; padding: 14px 18px; border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .03);
        margin: 22px 0 18px;
    }
    .search-box { position: relative; flex: 1 1 280px; }
    .search-box i {
        position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
        color: #94a3b8; font-size: .88rem; pointer-events: none;
    }
    .search-box input {
        width: 100%; height: 42px; padding: 0 16px 0 40px;
        border: 1px solid #cbd5e1; border-radius: 10px;
        background: #f8fafc; font-size: .86rem; color: #0f172a;
        transition: all .2s ease;
    }
    .search-box input:focus {
        outline: none; background: #fff; border-color: var(--navy, #163a63);
        box-shadow: 0 0 0 3px rgba(22, 58, 99, .12);
    }
    .filter-select {
        height: 42px; padding: 0 36px 0 14px;
        border: 1px solid #cbd5e1; border-radius: 10px;
        background-color: #f8fafc; font-size: .85rem; font-weight: 600; color: #1e293b;
        min-width: 165px; cursor: pointer; transition: all .2s ease;
    }
    .filter-select:focus {
        outline: none; background-color: #fff; border-color: var(--navy, #163a63);
        box-shadow: 0 0 0 3px rgba(22, 58, 99, .12);
    }
    .btn-reset-filter {
        height: 42px; padding: 0 16px; border-radius: 10px;
        border: 1px solid #cbd5e1; background: #ffffff;
        color: #475569; font-size: .84rem; font-weight: 600;
        display: inline-flex; align-items: center; gap: 6px;
        cursor: pointer; transition: all .2s ease; white-space: nowrap;
    }
    .btn-reset-filter:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }

    /* Ringkasan Grand Total Lintas Tahun */
    .summary-strip {
        display: flex; flex-wrap: wrap; gap: 14px; align-items: center; justify-content: space-between;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        color: #fff; padding: 16px 22px; border-radius: 14px;
        margin-bottom: 24px; box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .summary-strip-title { display: flex; align-items: center; gap: 12px; }
    .summary-strip-title i {
        width: 42px; height: 42px; border-radius: 10px;
        background: rgba(255,255,255,.12); color: #38bdf8;
        display: grid; place-items: center; font-size: 1.1rem;
    }
    .summary-strip-title h4 { margin: 0; font-size: .96rem; font-weight: 800; letter-spacing: .01em; }
    .summary-strip-title p { margin: 2px 0 0; font-size: .78rem; color: rgba(255,255,255,.75); }
    .summary-metrics { display: flex; flex-wrap: wrap; gap: 12px; }
    .summary-metric-box {
        background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
        padding: 8px 16px; border-radius: 10px; text-align: center; min-width: 125px;
    }
    .summary-metric-box span { display: block; font-size: .68rem; text-transform: uppercase; letter-spacing: .05em; color: rgba(255,255,255,.75); font-weight: 600; }
    .summary-metric-box strong { font-size: 1.1rem; font-weight: 800; color: #fff; }
    .summary-metric-box.highlight { background: #f59e0b; border-color: #fbbf24; }
    .summary-metric-box.highlight span { color: #451a03; font-weight: 700; }
    .summary-metric-box.highlight strong { color: #0f172a; }

    /* Header Pemisah Per Tahun */
    .year-block { margin-bottom: 34px; }
    .year-block-header {
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        margin-bottom: 12px; padding: 0 4px;
    }
    .year-block-title { display: flex; align-items: center; gap: 10px; }
    .year-badge-icon {
        width: 34px; height: 34px; border-radius: 9px;
        background: #163a63; color: #fff; display: grid; place-items: center;
        font-size: .85rem; box-shadow: 0 4px 10px rgba(22, 58, 99, .18);
    }
    .year-block-title h3 { margin: 0; font-size: 1.08rem; font-weight: 800; color: #0f172a; letter-spacing: -.01em; }
    .year-block-pills { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
    .year-stat-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 12px; border-radius: 999px; font-size: .78rem; font-weight: 700;
        background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;
    }
    .year-stat-pill.total { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }

    /* Tabel Utama */
    .table-scroll-wrapper {
        width: 100%; overflow-x: auto; background: #fff;
        border-radius: 14px; border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04);
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: #f8fafc; }

    .table-detailed { width: 100%; border-collapse: collapse; min-width: 1120px; margin-bottom: 0; }
    .table-detailed thead { background: #0f172a; color: #fff; }
    .table-detailed th {
        font-size: .72rem; font-weight: 700; padding: 15px 14px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .05em; vertical-align: middle;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }
    .table-detailed th:last-child { border-right: none; }

    .table-detailed td {
        font-size: .86rem; padding: 14px; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f8fafc;
        color: #334155;
    }
    .table-detailed tbody tr { transition: background .15s ease; }
    .table-detailed tbody tr:hover { background: #f8fafc; }

    /* Baris JUMLAH TOTAL di Bawah Tabel Setiap Tahun */
    .table-detailed tfoot tr.row-jumlah-total td {
        background: #f1f5f9; border-top: 2px solid #cbd5e1; border-bottom: none;
        padding: 14px 16px; font-weight: 800; font-size: .86rem; color: #0f172a;
    }
    .total-label-cell { text-align: right; letter-spacing: .04em; text-transform: uppercase; color: #0f172a; padding-right: 16px !important; }
    .total-val-badge {
        display: inline-block; padding: 5px 14px; border-radius: 8px;
        background: #0f172a; color: #ffffff; font-weight: 800; font-size: .85rem;
    }

    /* Badge Jenis Kelamin */
    .badge-jk {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px; border-radius: 999px; font-size: .78rem; font-weight: 700;
        white-space: nowrap;
    }
    .badge-jk.laki { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-jk.perempuan { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }

    .cell-nama { font-weight: 700; color: #0f172a; font-size: .9rem; }
    .cell-tanggal { font-weight: 700; color: #0f172a; font-size: .83rem; white-space: nowrap; }

    /* Tombol Edit & Hapus */
    .aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 8px; }
    .aksi-wrap form { margin: 0; display: inline-flex; }
    .btn-action {
        width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center;
        border-radius: 9px; font-size: .82rem; color: #fff; border: none; cursor: pointer;
        transition: transform .15s ease, filter .2s ease, box-shadow .2s ease; text-decoration: none;
    }
    .btn-action:hover { transform: translateY(-1px); filter: brightness(1.06); box-shadow: 0 3px 8px rgba(0,0,0,.12); }
    .btn-edit { background: #f59e0b; color: #0f172a; }
    .btn-edit:hover { color: #0f172a; }
    .btn-delete { background: #ef4444; color: #fff; }
    .empty-state {
        text-align: center; padding: 54px 16px !important; color: #64748b; font-weight: 600;
        background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
    }

    @media (max-width: 700px) {
        .search-box { width: 100%; }
        .filter-select { flex: 1 1 auto; }
        .toolbar-actions { width: 100%; }
        .summary-metrics { width: 100%; }
        .summary-metric-box { flex: 1 1 auto; }
    }
</style>
@endpush

@section('content')
    @php
        $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);

        $koleksiData = collect($data_pelatihan ?? [])->map(function ($item) {
            $tgl = $item->tanggal_pelaksanaan ?? null;
            $item->tahun_parsed = $tgl ? \Carbon\Carbon::parse($tgl)->format('Y') : date('Y');
            $item->hari_tanggal_label = $tgl
                ? mb_strtoupper(\Carbon\Carbon::parse($tgl)->locale('id')->translatedFormat('l, d F Y'))
                : '-';

            $jkRaw = trim((string) ($item->jenis_kelamin ?? ''));
            $item->jk_norm = mb_strtolower($jkRaw);
            $item->is_laki = $item->jk_norm === 'laki-laki';
            $item->is_perempuan = $item->jk_norm === 'perempuan';

            return $item;
        });

        $groupedByYear = $koleksiData->groupBy('tahun_parsed')->sortKeysDesc();
        $listTahunCetak = $groupedByYear->keys()->values();
        $daftar_kecamatan = $koleksiData->pluck('kecamatan')->filter()->unique()->sort()->values();

        $grandTotalPeserta   = $koleksiData->count();
        $grandTotalLaki      = $koleksiData->where('is_laki', true)->count();
        $grandTotalPerempuan = $koleksiData->where('is_perempuan', true)->count();
    @endphp

    <!-- HEADER KONTEN & TOMBOL AKSI -->
    <div class="page-toolbar">
        <div class="page-head">
            <h1>Pemberdayaan Masyarakat</h1>
            <p>Kelola data sosialisasi, edukasi, dan pelatihan keluarga tanggap kebakaran.</p>
        </div>

        <div class="toolbar-actions">
            @hasanyrole('Pencegahan|Super User')
            <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/create" class="btn-tool navy">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            @endhasanyrole

            <!-- DROPDOWN CETAK EXCEL -->
            <div class="export-dropdown">
                <button type="button" class="btn-tool green" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-excel"></i> Excel <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format Excel</div>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/cetak-excel" class="export-item">
                        <span>Semua Data (Rekap)</span>
                        <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                    </a>
                    @if($listTahunCetak->isNotEmpty())
                        <div class="export-divider"></div>
                        <div class="export-menu-label">Cetak Per Tahun</div>
                        @foreach($listTahunCetak as $thn)
                            <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/cetak-excel?tahun={{ $thn }}" class="export-item">
                                <span>Tahun {{ $thn }}</span>
                                <i class="fas fa-download text-muted" style="font-size:.72rem;"></i>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- DROPDOWN CETAK PDF -->
            <div class="export-dropdown">
                <button type="button" class="btn-tool red" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-pdf"></i> PDF <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format PDF</div>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/cetak" target="_blank" class="export-item">
                        <span>Semua Data (Rekap)</span>
                        <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                    </a>
                    @if($listTahunCetak->isNotEmpty())
                        <div class="export-divider"></div>
                        <div class="export-menu-label">Cetak Per Tahun</div>
                        @foreach($listTahunCetak as $thn)
                            <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/cetak?tahun={{ $thn }}" target="_blank" class="export-item">
                                <span>Tahun {{ $thn }}</span>
                                <i class="fas fa-print text-muted" style="font-size:.72rem;"></i>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <ul class="nav custom-nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat">Semua Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/sosialisasi*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi">SOSIALISASI DAN EDUKASI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga">PELATIHAN KELUARGA TANGGAP KEBAKARAN</a>
        </li>
    </ul>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchPelatihan" placeholder="Cari nama peserta, kelurahan, kecamatan, tempat, atau alamat..." aria-label="Cari data pelatihan">
        </div>

        <select id="filterKecamatan" class="filter-select" aria-label="Filter Kecamatan">
            <option value="">Semua Kecamatan</option>
            @foreach($daftar_kecamatan as $kecamatan)
                <option value="{{ mb_strtolower($kecamatan) }}">{{ $kecamatan }}</option>
            @endforeach
        </select>

        <select id="filterGender" class="filter-select" aria-label="Filter Jenis Kelamin">
            <option value="">Semua Jenis Kelamin</option>
            <option value="laki-laki">Laki-Laki</option>
            <option value="perempuan">Perempuan</option>
        </select>

        <select id="filterTahun" class="filter-select" aria-label="Filter Tahun">
            <option value="">Semua Tahun</option>
            @foreach($listTahunCetak as $thn)
                <option value="{{ $thn }}">Tahun {{ $thn }}</option>
            @endforeach
        </select>

        <button type="button" id="btnResetFilter" class="btn-reset-filter">
            <i class="fas fa-rotate-left"></i> Reset
        </button>
    </div>

    <!-- BANNER RINGKASAN GRAND TOTAL -->
    @if($koleksiData->isNotEmpty())
    <div class="summary-strip" id="summaryStrip">
        <div class="summary-strip-title">
            <i class="fas fa-house-chimney"></i>
            <div>
                <h4 id="judulSummary">REKAPITULASI PELATIHAN KELUARGA (SEMUA TAHUN)</h4>
                <p id="subJudulSummary">Akumulasi jumlah peserta pelatihan keluarga tanggap kebakaran yang ditampilkan</p>
            </div>
        </div>
        <div class="summary-metrics">
            <div class="summary-metric-box">
                <span>Peserta Laki-Laki</span>
                <strong id="grandLaki">{{ number_format($grandTotalLaki, 0, ',', '.') }}</strong>
            </div>
            <div class="summary-metric-box">
                <span>Peserta Perempuan</span>
                <strong id="grandPerempuan">{{ number_format($grandTotalPerempuan, 0, ',', '.') }}</strong>
            </div>
            <div class="summary-metric-box highlight">
                <span>Jumlah Total Peserta</span>
                <strong id="grandTotal">{{ number_format($grandTotalPeserta, 0, ',', '.') }} Orang</strong>
            </div>
        </div>
    </div>
    @endif

    <!-- DAFTAR TABEL YANG DIPISAHKAN PER TAHUN -->
    <div id="wadahSemuaTahun">
        @forelse($groupedByYear as $tahun => $items)
            @php
                $sumLakiTahun      = $items->where('is_laki', true)->count();
                $sumPerempuanTahun = $items->where('is_perempuan', true)->count();
                $sumTotalTahun     = $items->count();
            @endphp

            <div class="year-block" data-year-block="{{ $tahun }}">
                <div class="year-block-header">
                    <div class="year-block-title">
                        <span class="year-badge-icon"><i class="fas fa-calendar-alt"></i></span>
                        <h3>DATA PELATIHAN KELUARGA TAHUN {{ $tahun }}</h3>
                    </div>
                    <div class="year-block-pills">
                        <span class="year-stat-pill">
                            <i class="fas fa-mars text-primary"></i>
                            Laki-Laki: <strong class="pill-laki-tahun">{{ number_format($sumLakiTahun, 0, ',', '.') }}</strong>
                        </span>
                        <span class="year-stat-pill">
                            <i class="fas fa-venus text-danger"></i>
                            Perempuan: <strong class="pill-perempuan-tahun">{{ number_format($sumPerempuanTahun, 0, ',', '.') }}</strong>
                        </span>
                        <span class="year-stat-pill total">
                            <i class="fas fa-users"></i>
                            Total Tahun {{ $tahun }}: <strong class="pill-total-tahun">{{ number_format($sumTotalTahun, 0, ',', '.') }} Orang</strong>
                        </span>
                    </div>
                </div>

                <div class="table-scroll-wrapper">
                    <table class="table-detailed">
                        <thead>
                            <tr>
                                <th class="text-center" width="55px">NO</th>
                                <th width="18%">NAMA PESERTA</th>
                                <th class="text-center" width="13%">JENIS KELAMIN</th>
                                <th class="text-center" width="13%">KELURAHAN</th>
                                <th class="text-center" width="13%">KECAMATAN</th>
                                <th class="text-center" width="17%">HARI/TANGGAL PELAKSANAAN</th>
                                <th class="text-center" width="12%">TEMPAT PELAKSANAAN</th>
                                <th width="18%">ALAMAT PELAKSANAAN</th>
                                @hasanyrole('Pencegahan|Super User')
                                <th class="text-center" width="95px">AKSI</th>
                                @endhasanyrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items->values() as $index => $item)
                            @php
                                $gabunganPencarian = mb_strtolower(
                                    ($item->nama_peserta ?? '') . ' ' .
                                    ($item->jenis_kelamin ?? '') . ' ' .
                                    ($item->kelurahan ?? '') . ' ' .
                                    ($item->kecamatan ?? '') . ' ' .
                                    ($item->hari_tanggal_label ?? '') . ' ' .
                                    ($item->tempat_pelaksanaan ?? '') . ' ' .
                                    ($item->alamat_pelaksanaan ?? '')
                                );
                            @endphp
                            <tr class="baris-data"
                                data-tahun="{{ $tahun }}"
                                data-kecamatan="{{ mb_strtolower($item->kecamatan ?? '') }}"
                                data-gender="{{ $item->jk_norm }}"
                                data-pencarian="{{ $gabunganPencarian }}">

                                <td class="text-center fw-bold nomor-urut">{{ $index + 1 }}</td>
                                <td><span class="cell-nama">{{ $item->nama_peserta ?? '-' }}</span></td>
                                <td class="text-center">
                                    @if($item->is_laki)
                                        <span class="badge-jk laki"><i class="fas fa-mars"></i> Laki-Laki</span>
                                    @elseif($item->is_perempuan)
                                        <span class="badge-jk perempuan"><i class="fas fa-venus"></i> Perempuan</span>
                                    @else
                                        <span>{{ $item->jenis_kelamin ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->kelurahan ?? '-' }}</td>
                                <td class="text-center"><span class="fw-semibold">{{ $item->kecamatan ?? '-' }}</span></td>
                                <td class="text-center"><span class="cell-tanggal">{{ $item->hari_tanggal_label }}</span></td>
                                <td class="text-center">{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                                <td>{{ $item->alamat_pelaksanaan ?? '-' }}</td>

                                @hasanyrole('Pencegahan|Super User')
                                <td>
                                    <div class="aksi-wrap">
                                        <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data peserta ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endhasanyrole
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="row-jumlah-total">
                                <td colspan="5" class="total-label-cell">
                                    JUMLAH PESERTA TAHUN {{ $tahun }}
                                </td>
                                <td colspan="2" class="text-center foot-rincian-gender">
                                    Laki-Laki: {{ number_format($sumLakiTahun, 0, ',', '.') }} | Perempuan: {{ number_format($sumPerempuanTahun, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="total-val-badge foot-total-peserta">{{ number_format($sumTotalTahun, 0, ',', '.') }} Orang</span>
                                </td>
                                @if($canCrud)
                                <td></td>
                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-folder-open" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
                Belum ada data Pelatihan Keluarga Tanggap Kebakaran.
            </div>
        @endforelse

        <div id="emptyFilterState" class="empty-state" style="display: none;">
            <i class="fas fa-magnifying-glass" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
            Data Pelatihan Keluarga yang Anda cari tidak ditemukan.
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleExportMenu(btn, event) {
        event.stopPropagation();
        var parent = btn.closest('.export-dropdown');
        var isOpen = parent.classList.contains('open');
        document.querySelectorAll('.export-dropdown.open').forEach(function (el) {
            el.classList.remove('open');
        });
        if (!isOpen) {
            parent.classList.add('open');
        }
    }

    document.addEventListener('click', function () {
        document.querySelectorAll('.export-dropdown.open').forEach(function (el) {
            el.classList.remove('open');
        });
    });

    (function () {
        'use strict';
        var searchInput   = document.getElementById('searchPelatihan');
        var filterKec     = document.getElementById('filterKecamatan');
        var filterGender  = document.getElementById('filterGender');
        var filterTahun   = document.getElementById('filterTahun');
        var btnReset      = document.getElementById('btnResetFilter');
        var yearBlocks    = document.querySelectorAll('.year-block');
        var emptyState    = document.getElementById('emptyFilterState');

        var elJudulSummary   = document.getElementById('judulSummary');
        var elGrandLaki      = document.getElementById('grandLaki');
        var elGrandPerempuan = document.getElementById('grandPerempuan');
        var elGrandTotal     = document.getElementById('grandTotal');

        function formatRibuan(angka) {
            return (Number(angka) || 0).toLocaleString('id-ID');
        }

        function jalankanFilter() {
            var q   = searchInput ? searchInput.value.trim().toLowerCase() : '';
            var kec = filterKec ? filterKec.value : '';
            var jk  = filterGender ? filterGender.value : '';
            var thn = filterTahun ? filterTahun.value : '';

            var grandLaki      = 0;
            var grandPerempuan = 0;
            var grandTotal     = 0;
            var adaBlokTampil  = false;

            yearBlocks.forEach(function (block) {
                var tahunBlok = block.getAttribute('data-year-block');

                if (thn && tahunBlok !== thn) {
                    block.style.display = 'none';
                    return;
                }

                var rows = block.querySelectorAll('tbody tr.baris-data');
                var nomor = 1;
                var subLaki = 0;
                var subPerempuan = 0;
                var jmlBarisCocok = 0;

                rows.forEach(function (tr) {
                    var cocokCari   = !q || tr.getAttribute('data-pencarian').indexOf(q) > -1;
                    var cocokKec    = !kec || tr.getAttribute('data-kecamatan') === kec;
                    var cocokGender = !jk || tr.getAttribute('data-gender') === jk;

                    if (cocokCari && cocokKec && cocokGender) {
                        tr.style.display = '';
                        var selNomor = tr.querySelector('.nomor-urut');
                        if (selNomor) {
                            selNomor.textContent = nomor++;
                        }

                        var g = tr.getAttribute('data-gender');
                        if (g === 'laki-laki') {
                            subLaki++;
                        } else if (g === 'perempuan') {
                            subPerempuan++;
                        }
                        jmlBarisCocok++;
                    } else {
                        tr.style.display = 'none';
                    }
                });

                if (jmlBarisCocok > 0) {
                    block.style.display = '';
                    adaBlokTampil = true;

                    var footGender    = block.querySelector('.foot-rincian-gender');
                    var footTotal     = block.querySelector('.foot-total-peserta');
                    var pillLaki      = block.querySelector('.pill-laki-tahun');
                    var pillPerempuan = block.querySelector('.pill-perempuan-tahun');
                    var pillTotal     = block.querySelector('.pill-total-tahun');

                    if (footGender) {
                        footGender.textContent = 'Laki-Laki: ' + formatRibuan(subLaki) + ' | Perempuan: ' + formatRibuan(subPerempuan);
                    }
                    if (footTotal) {
                        footTotal.textContent = formatRibuan(jmlBarisCocok) + ' Orang';
                    }
                    if (pillLaki) {
                        pillLaki.textContent = formatRibuan(subLaki);
                    }
                    if (pillPerempuan) {
                        pillPerempuan.textContent = formatRibuan(subPerempuan);
                    }
                    if (pillTotal) {
                        pillTotal.textContent = formatRibuan(jmlBarisCocok) + ' Orang';
                    }

                    grandLaki      += subLaki;
                    grandPerempuan += subPerempuan;
                    grandTotal     += jmlBarisCocok;
                } else {
                    block.style.display = 'none';
                }
            });

            if (elJudulSummary) {
                elJudulSummary.textContent = thn
                    ? 'REKAPITULASI PELATIHAN KELUARGA (TAHUN ' + thn + ')'
                    : 'REKAPITULASI PELATIHAN KELUARGA (SEMUA TAHUN)';
            }
            if (elGrandLaki)      { elGrandLaki.textContent      = formatRibuan(grandLaki); }
            if (elGrandPerempuan) { elGrandPerempuan.textContent = formatRibuan(grandPerempuan); }
            if (elGrandTotal)     { elGrandTotal.textContent     = formatRibuan(grandTotal) + ' Orang'; }

            if (emptyState && yearBlocks.length > 0) {
                emptyState.style.display = adaBlokTampil ? 'none' : 'block';
            }
        }

        if (searchInput)  { searchInput.addEventListener('input', jalankanFilter); }
        if (filterKec)    { filterKec.addEventListener('change', jalankanFilter); }
        if (filterGender) { filterGender.addEventListener('change', jalankanFilter); }
        if (filterTahun)  { filterTahun.addEventListener('change', jalankanFilter); }
        if (btnReset) {
            btnReset.addEventListener('click', function () {
                if (searchInput)  { searchInput.value = ''; }
                if (filterKec)    { filterKec.value = ''; }
                if (filterGender) { filterGender.value = ''; }
                if (filterTahun)  { filterTahun.value = ''; }
                jalankanFilter();
            });
        }
    })();
</script>
@endpush
