@extends('layouts.dashboard')

@section('title', 'Pencegahan Kebakaran & Inspeksi')

@push('styles')
<style>
    .toast-wrap { position: fixed; z-index: 1100; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }

    /* ===== HEADER HALAMAN ===== */
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-family: var(--font-display, inherit); font-weight: 800; font-size: clamp(1.5rem, 3.5vw, 2.1rem); color: var(--ink); letter-spacing: -.02em; margin: 0 0 4px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

    .toolbar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

    /* Tombol Aksi Atas & Dropdown Export (selaras dengan Fire Drill) */
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

    /* Filter Bar */
    .filter-bar {
        display: flex; flex-wrap: wrap; gap: 12px; align-items: center;
        background: #ffffff; padding: 14px 18px; border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .03);
        margin: 0 0 18px;
    }
    .search-box { position: relative; flex: 1 1 300px; }
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
    .search-box input::placeholder { color: #94a3b8; }
    .search-box input:focus {
        outline: none; background: #fff; border-color: var(--navy, #163a63);
        box-shadow: 0 0 0 3px rgba(22, 58, 99, .12);
    }
    .filter-select {
        height: 42px; padding: 0 36px 0 14px;
        border: 1px solid #cbd5e1; border-radius: 10px;
        background-color: #f8fafc; font-size: .85rem; font-weight: 600; color: #1e293b;
        min-width: 185px; cursor: pointer; transition: all .2s ease;
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

    /* ===== TABS ===== */
    .custom-nav-tabs { display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto; margin: 6px 0 30px; border-bottom: 1px solid var(--line); scrollbar-width: thin; -webkit-overflow-scrolling: touch; }
    .custom-nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; border-radius: 0; color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em; padding: 12px 16px; background: transparent; white-space: nowrap; text-transform: uppercase; transition: color .2s, border-color .2s, background .2s; }
    .custom-nav-tabs .nav-link:hover { color: var(--ink); background: #f3f6fa; }
    .custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); background: transparent; }

    /* ===== KARTU STATISTIK (TAB SEMUA DATA) ===== */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; margin-bottom: 44px; }
    .stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 22px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease; position: relative; overflow: hidden; text-decoration: none; width: 100%; }
    .stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
    .stat-card::after { content: "\f061"; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; top: 22px; right: 20px; color: var(--steel-soft); font-size: .8rem; opacity: 0; transform: translateX(-6px); transition: opacity .2s ease, transform .2s ease; }
    .stat-card:hover::after { opacity: 1; transform: translateX(0); }
    .stat-ico { width: 46px; height: 46px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px; }
    .ic-primary { background: var(--navy-soft); color: var(--navy); }
    .ic-danger { background: var(--signal-soft); color: var(--signal-dark); }
    .stat-title { font-size: .74rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.9rem; line-height: 1; color: var(--ink); letter-spacing: -.01em; }

    /* ===== BANNER REKAPITULASI ===== */
    .recap-banner { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; padding: 18px 22px; border-radius: var(--r-md); background: linear-gradient(120deg, var(--ink) 0%, var(--navy-dark) 55%, var(--navy) 100%); box-shadow: var(--shadow-md); margin-bottom: 30px; position: relative; overflow: hidden; }
    .recap-banner::after { content: ""; position: absolute; right: -40px; top: -60px; width: 220px; height: 220px; border-radius: 50%; background: rgba(255,255,255,.04); pointer-events: none; }
    .recap-left { display: flex; align-items: center; gap: 16px; position: relative; z-index: 1; min-width: 0; }
    .recap-ico { flex: none; width: 52px; height: 52px; border-radius: 14px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); display: grid; place-items: center; color: #5db4ff; font-size: 1.35rem; }
    .recap-title { font-family: var(--font-display); font-weight: 700; font-size: 1rem; letter-spacing: .01em; text-transform: uppercase; color: #fff; margin: 0 0 3px; }
    .recap-sub { font-size: .8rem; color: rgba(255,255,255,.7); margin: 0; }
    .recap-right { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 1; }
    .recap-box { min-width: 150px; padding: 12px 20px; border-radius: 12px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); text-align: center; }
    .recap-box .lbl { display: block; font-size: .64rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: rgba(255,255,255,.75); margin-bottom: 4px; }
    .recap-box .val { font-family: var(--font-display); font-weight: 700; font-size: 1.5rem; line-height: 1.1; color: #fff; }
    .recap-box.highlight { background: var(--amber); border-color: var(--amber); }
    .recap-box.highlight .lbl { color: rgba(13,27,42,.75); }
    .recap-box.highlight .val { color: var(--ink); }

    /* ===== JUDUL SECTION ===== */
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
    .section-heading-ico { flex: none; width: 36px; height: 36px; border-radius: 10px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .85rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); letter-spacing: -.01em; margin: 0; text-transform: uppercase; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { display: inline-flex; align-items: center; gap: 7px; padding: 6px 14px; border-radius: 999px; background: #fff; border: 1px solid var(--line); font-size: .76rem; font-weight: 700; color: var(--steel); }
    .count-pill.blue { background: var(--info-soft); border-color: rgba(37,99,235,.2); color: var(--navy); }

    /* ===== TABEL ===== */
    .table-scroll-wrapper { width: 100%; overflow-x: auto; border-radius: var(--r-md); border: 1px solid var(--line); background: #fff; margin-bottom: 40px; box-shadow: var(--shadow-sm); scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; -webkit-overflow-scrolling: touch; }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 1550px; margin-bottom: 0; }
    .table-detailed thead { background-color: var(--ink); color: #fff; }
    .table-detailed th { font-size: .7rem; font-weight: 700; padding: 16px 14px; white-space: nowrap; text-transform: uppercase; border-right: 1px solid var(--ink-3); letter-spacing: .05em; vertical-align: middle; }
    .table-detailed th:last-child { border-right: none; }
    .table-detailed td { font-size: .85rem; padding: 14px; vertical-align: middle; border-bottom: 1px solid var(--line); border-right: none; color: var(--ink); }
    .table-detailed tbody tr:last-child td { border-bottom: none; }
    .table-detailed tbody tr { transition: background .15s; }
    .table-detailed tbody tr:hover { background-color: #f8fafc; }

    .no-badge { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 50%; background: var(--navy-soft); color: var(--navy); font-weight: 700; font-size: .8rem; }
    .place-name { font-weight: 700; color: var(--ink); font-size: .9rem; line-height: 1.35; }
    .date-pill { display: inline-flex; align-items: center; gap: 7px; padding: 5px 12px; border-radius: 8px; background: #f1f5f9; color: var(--ink-3); font-size: .8rem; font-weight: 600; white-space: nowrap; }
    .date-pill i { color: var(--navy); font-size: .75rem; }
    .type-pill { display: inline-block; padding: 5px 12px; border-radius: 8px; background: var(--navy-light); color: var(--navy); font-size: .78rem; font-weight: 600; line-height: 1.4; }
    .level-pill { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: .74rem; font-weight: 700; white-space: nowrap; }
    .level-rendah { background: #dcfce7; color: #166534; }
    .level-sedang { background: #fef3c7; color: #92400e; }
    .level-tinggi { background: #fee2e2; color: #991b1b; }
    .proteksi-ok { background: #dcfce7; color: #166534; }
    .proteksi-catatan { background: #fef3c7; color: #92400e; }
    .proteksi-tidak { background: #fee2e2; color: #991b1b; }

    .btn-action { width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center; border-radius: 9px; font-size: .8rem; color: #fff; border: none; cursor: pointer; transition: transform .1s, box-shadow .2s; }
    .btn-action:hover { transform: scale(1.08); color: #fff; box-shadow: 0 3px 8px rgba(13,27,42,.18); }
    .btn-edit { background-color: var(--amber); color: var(--ink); }
    .btn-edit:hover { color: var(--ink); }
    .btn-delete { background-color: var(--signal); }
    .action-cell { display: flex; justify-content: center; align-items: center; gap: 6px; }

    .doc-badge { display: inline-block; padding: 5px 10px; font-size: .66rem; font-weight: 700; letter-spacing: .04em; border-radius: 7px; margin: 0 4px 4px 0; color: #fff !important; transition: opacity .2s, transform .1s; text-decoration: none; }
    .doc-badge:hover { opacity: .85; transform: translateY(-1px); }

    .empty-state { padding: 56px 16px !important; }

    @media (max-width: 700px) {
        .page-head { margin-bottom: 20px; }
        .toolbar { width: 100%; }
        .search-box { width: 100%; }
        .filter-select { flex: 1 1 auto; }
        .stats-grid { grid-template-columns: 1fr; gap: 12px; margin-bottom: 34px; }
        .stat-card { padding: 19px; width: 100%; }
        .stat-ico { width: 42px; height: 42px; margin-bottom: 14px; }
        .stat-value { font-size: 1.7rem; }
        .recap-banner { padding: 16px; }
        .recap-right { width: 100%; }
        .recap-box { flex: 1; min-width: 0; }
        .section-heading .line { display: none; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
    @media print {
        .toolbar, .filter-bar, .btn-action, .toast-wrap { display: none !important; }
        .stat-card { box-shadow: none; break-inside: avoid; }
        .recap-banner { background: #fff !important; border: 1px solid #ddd; box-shadow: none; }
        .recap-title, .recap-sub, .recap-box .lbl, .recap-box .val { color: #000 !important; }
    }
</style>
@endpush

@section('content')
    @php
        $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);
        $koleksiData = collect($data_inspeksi ?? []);
        $listTahunCetak = ($daftar_tahun ?? $koleksiData->map(fn ($i) => !empty($i->tahun) ? (int) $i->tahun : (!empty($i->tanggal_inspeksi) ? (int) \Carbon\Carbon::parse($i->tanggal_inspeksi)->format('Y') : null))->filter()->unique()->sortDesc()->values());
        $listJenisBangunan = ($daftar_jenis ?? $koleksiData->map(fn ($i) => trim((string) ($i->jenis_usaha ?? '')))->filter()->unique(fn ($j) => strtolower($j))->map(fn ($j) => strtoupper($j))->sort()->values());
        $grandTotalInspeksi = $koleksiData->count();
    @endphp

        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-2">
            <div class="page-head mb-0">
                <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
                <p>Kelola data inspeksi bangunan gedung, lingkungan, dan pelaksanaan fire drill.</p>
            </div>

            {{-- Toolbar disembunyikan di tab Semua Data --}}
            @unless(Request::is('internal/pencegahan/inspeksi-kebakaran'))
            <div class="toolbar">
                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                    @if(Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*'))
                    <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah" class="btn-tool navy">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    @endif
                @endhasanyrole

                <!-- DROPDOWN CETAK EXCEL (SEMUA DATA & PER TAHUN) -->
                <div class="export-dropdown">
                    <button type="button" class="btn-tool green" onclick="toggleExportMenu(this, event)">
                        <i class="fas fa-file-excel"></i> Excel <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                    </button>
                    <div class="export-menu">
                        <div class="export-menu-label">Pilih Format Excel</div>
                        <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-excel" class="export-item">
                            <span>Semua Data (Rekap)</span>
                            <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                        </a>
                        @if($listTahunCetak->isNotEmpty())
                            <div class="export-divider"></div>
                            <div class="export-menu-label">Cetak Per Tahun</div>
                            @foreach($listTahunCetak as $thn)
                                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-excel?tahun={{ $thn }}" class="export-item">
                                    <span>Tahun {{ $thn }}</span>
                                    <i class="fas fa-download text-muted" style="font-size:.72rem;"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- DROPDOWN CETAK PDF (SEMUA DATA & PER TAHUN) -->
                <div class="export-dropdown">
                    <button type="button" class="btn-tool red" onclick="toggleExportMenu(this, event)">
                        <i class="fas fa-file-pdf"></i> PDF <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                    </button>
                    <div class="export-menu">
                        <div class="export-menu-label">Pilih Format PDF</div>
                        <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-pdf" target="_blank" class="export-item">
                            <span>Semua Data (Rekap)</span>
                            <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                        </a>
                        @if($listTahunCetak->isNotEmpty())
                            <div class="export-divider"></div>
                            <div class="export-menu-label">Cetak Per Tahun</div>
                            @foreach($listTahunCetak as $thn)
                                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-pdf?tahun={{ $thn }}" target="_blank" class="export-item">
                                    <span>Tahun {{ $thn }}</span>
                                    <i class="fas fa-print text-muted" style="font-size:.72rem;"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endunless
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran">Semua Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/bangunan">Inspeksi Bangunan Gedung dan Lingkungan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/fire-drill*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/fire-drill">Fire Drill</a>
            </li>
        </ul>

        <!-- ================= TAB "SEMUA DATA" ================= -->
        @if(Request::is('internal/pencegahan/inspeksi-kebakaran'))
        <div class="stats-grid">
            <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan" class="stat-card">
                <div class="stat-ico ic-primary"><i class="fas fa-building"></i></div>
                <div>
                    <div class="stat-title">Inspeksi Bangunan Gedung</div>
                    <div class="stat-value">{{ $total_inspeksi ?? 0 }}</div>
                </div>
            </a>

            <a href="/internal/pencegahan/inspeksi-kebakaran/fire-drill" class="stat-card">
                <div class="stat-ico ic-danger"><i class="fas fa-fire"></i></div>
                <div>
                    <div class="stat-title">Fire Drill</div>
                    <div class="stat-value">{{ $total_fire_drill ?? 0 }}</div>
                </div>
            </a>
        </div>
        @endif

        <!-- ================= TAB "INSPEKSI BANGUNAN" ================= -->
        @if(Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*'))

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama bangunan, alamat, atau penanggung jawab..." aria-label="Cari data inspeksi bangunan">
            </div>

            <select id="filterJenis" class="filter-select" aria-label="Filter Jenis Bangunan">
                <option value="">Semua Jenis Bangunan</option>
                @foreach($listJenisBangunan as $jenis)
                    <option value="{{ strtolower($jenis) }}">{{ $jenis }}</option>
                @endforeach
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

        <!-- BANNER REKAPITULASI -->
        <div class="recap-banner">
            <div class="recap-left">
                <div class="recap-ico"><i class="fas fa-clipboard-check"></i></div>
                <div>
                    <h2 class="recap-title" id="judulSummary">Rekapitulasi Inspeksi Bangunan</h2>
                    <p class="recap-sub">Akumulasi data inspeksi bangunan gedung dan lingkungan yang ditampilkan</p>
                </div>
            </div>
            <div class="recap-right">
                <div class="recap-box highlight">
                    <span class="lbl">Total Inspeksi</span>
                    <span class="val" id="grandTotalInspeksi">{{ number_format($grandTotalInspeksi, 0, ',', '.') }} Tempat</span>
                </div>
            </div>
        </div>

        <!-- JUDUL SECTION -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-building-circle-check"></i></span>
            <h3>Data Inspeksi Bangunan &amp; Lingkungan</h3>
            <span class="line"></span>
            <span class="count-pill blue"><i class="fas fa-building"></i> <span id="pillCountInspeksi">{{ number_format($grandTotalInspeksi, 0, ',', '.') }}</span> Tempat</span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Bangunan</th>
                        <th>Jenis Bangunan</th>
                        <th class="text-center">Kualifikasi Bangunan</th>
                        <th class="text-center">Resiko Kebakaran</th>
                        <th class="text-center">Luas Bangunan</th>
                        <th>Alamat</th>
                        <th>Nama Penanggung Jawab</th>
                        <th class="text-center">No Telfon</th>
                        <th class="text-center">Sistem Proteksi Kebakaran</th>
                        <th class="text-center">Tanggal Pemeriksaan</th>
                        <th class="text-center">Upload SPT</th>
                        <th class="text-center">Upload Rekomendasi</th>

                        <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <th class="text-center">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>
                <!-- TBODY DITAMBAHKAN ID "tableBody" -->
                <tbody id="tableBody">
                    @forelse($data_inspeksi as $index => $item)
                    @php
                        $kualifikasi = $item->kualifikasi_bangunan ?? '-';
                        $kelasKualifikasi = match ($kualifikasi) {
                            'Rendah' => 'level-rendah',
                            'Sedang' => 'level-sedang',
                            'Tinggi' => 'level-tinggi',
                            default => '',
                        };

                        $resiko = $item->resiko_kebakaran ?? '-';
                        $kelasResiko = match ($resiko) {
                            'Rendah' => 'level-rendah',
                            'Sedang' => 'level-sedang',
                            'Tinggi' => 'level-tinggi',
                            default => '',
                        };

                        $proteksi = $item->sistem_proteksi_kebakaran ?? '-';
                        $kelasProteksi = match ($proteksi) {
                            'Memenuhi Syarat' => 'proteksi-ok',
                            'Memenuhi Syarat dengan Catatan' => 'proteksi-catatan',
                            'Tidak Memenuhi Syarat' => 'proteksi-tidak',
                            default => '',
                        };

                        $parsedTanggal = !empty($item->tanggal_inspeksi)
                            ? \Carbon\Carbon::parse($item->tanggal_inspeksi)
                            : null;
                        $tglPemeriksaan = $parsedTanggal ? $parsedTanggal->format('d-m-Y') : '-';
                        $tahunPemeriksaan = !empty($item->tahun)
                            ? (string) $item->tahun
                            : ($parsedTanggal ? $parsedTanggal->format('Y') : '');
                    @endphp
                    <tr class="data-row"
                        data-tahun="{{ $tahunPemeriksaan }}"
                        data-jenis="{{ strtolower(trim($item->jenis_usaha ?? '')) }}"
                        data-pencarian="{{ strtolower(($item->nama_tempat ?? '') . ' ' . ($item->jenis_usaha ?? '') . ' ' . $kualifikasi . ' ' . $resiko . ' ' . ($item->luas_bangunan ?? '') . ' ' . ($item->alamat ?? '') . ' ' . ($item->nama_penanggung_jawab ?? '') . ' ' . ($item->no_telepon ?? '') . ' ' . $proteksi . ' ' . $tglPemeriksaan) }}">
                        <td class="text-center"><span class="no-badge nomor-urut">{{ $index + 1 }}</span></td>
                        <td><div class="place-name">{{ $item->nama_tempat ?? '-' }}</div></td>
                        <td style="white-space: normal;"><span class="type-pill">{{ $item->jenis_usaha ?? '-' }}</span></td>
                        <td class="text-center">
                            @if($kelasKualifikasi)
                                <span class="level-pill {{ $kelasKualifikasi }}">{{ $kualifikasi }}</span>
                            @else
                                {{ $kualifikasi }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($kelasResiko)
                                <span class="level-pill {{ $kelasResiko }}">{{ $resiko }}</span>
                            @else
                                {{ $resiko }}
                            @endif
                        </td>
                        <td class="text-center" style="white-space: nowrap;">{{ $item->luas_bangunan ?? '-' }}</td>
                        <td style="white-space: normal; min-width: 160px;">{{ $item->alamat ?? '-' }}</td>
                        <td>{{ $item->nama_penanggung_jawab ?? '-' }}</td>
                        <td class="text-center" style="white-space: nowrap;">{{ $item->no_telepon ?? '-' }}</td>
                        <td class="text-center">
                            @if($kelasProteksi)
                                <span class="level-pill {{ $kelasProteksi }}">{{ $proteksi }}</span>
                            @else
                                {{ $proteksi }}
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="date-pill"><i class="fas fa-calendar-days"></i> {{ $tglPemeriksaan }}</span>
                        </td>
                        <td class="text-center">
                            @if(!empty($item->surat_perintah_tugas))
                                <a href="/uploads/inspeksi/{{ $item->surat_perintah_tugas }}" class="doc-badge" style="background-color: #3b82f6; margin: 0;" target="_blank" title="Lihat Surat Perintah Tugas">
                                    <i class="fas fa-file-lines me-1"></i> SPT
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!empty($item->rekomendasi))
                                <a href="/uploads/inspeksi/{{ $item->rekomendasi }}" class="doc-badge" style="background-color: #8b5cf6; margin: 0;" target="_blank" title="Lihat Rekomendasi">
                                    <i class="fas fa-file-circle-check me-1"></i> Rekomendasi
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- TOMBOL EDIT & HAPUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('inspeksi.edit', $item->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('inspeksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display:inline-block; margin:0;">
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
                        <td colspan="{{ $canCrud ? 14 : 13 }}" class="text-center text-muted fw-bold empty-state">
                            <i class="fas fa-folder-open mb-2" style="font-size: 28px; color: var(--steel-soft);"></i><br>
                            Belum ada data inspeksi bangunan.
                        </td>
                    </tr>
                    @endforelse

                    <tr id="emptyFilterRow" style="display: none;">
                        <td colspan="{{ $canCrud ? 14 : 13 }}" class="text-center text-muted fw-bold empty-state">
                            <i class="fas fa-magnifying-glass mb-2" style="font-size: 28px; color: var(--steel-soft);"></i><br>
                            Data Inspeksi Bangunan yang Anda cari tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
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

    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('searchInput');
        var filterJenis = document.getElementById('filterJenis');
        var filterTahun = document.getElementById('filterTahun');
        var btnReset = document.getElementById('btnResetFilter');
        var rows = Array.prototype.slice.call(document.querySelectorAll('#tableBody tr.data-row'));
        var emptyFilterRow = document.getElementById('emptyFilterRow');

        var elGrandTotal = document.getElementById('grandTotalInspeksi');
        var elPillCount = document.getElementById('pillCountInspeksi');
        var elJudulSummary = document.getElementById('judulSummary');

        function formatRibuan(angka) {
            return Number(angka || 0).toLocaleString('id-ID');
        }

        function terapkanFilter() {
            if (rows.length === 0) {
                return;
            }

            var q = (searchInput ? searchInput.value : '').toLowerCase().trim();
            var jns = (filterJenis ? filterJenis.value : '').toLowerCase().trim();
            var thn = (filterTahun ? filterTahun.value : '').trim();

            var urut = 0;

            rows.forEach(function (row) {
                var cocokCari = !q || (row.getAttribute('data-pencarian') || '').indexOf(q) !== -1;
                var cocokJenis = !jns || (row.getAttribute('data-jenis') || '') === jns;
                var cocokTahun = !thn || (row.getAttribute('data-tahun') || '') === thn;

                if (cocokCari && cocokJenis && cocokTahun) {
                    row.style.display = '';
                    urut++;
                    var noEl = row.querySelector('.nomor-urut');
                    if (noEl) {
                        noEl.textContent = urut;
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            if (emptyFilterRow) {
                emptyFilterRow.style.display = urut === 0 ? '' : 'none';
            }
            if (elGrandTotal) {
                elGrandTotal.textContent = formatRibuan(urut) + ' Tempat';
            }
            if (elPillCount) {
                elPillCount.textContent = formatRibuan(urut);
            }
            if (elJudulSummary) {
                elJudulSummary.textContent = thn
                    ? 'Rekapitulasi Inspeksi Bangunan (Tahun ' + thn + ')'
                    : 'Rekapitulasi Inspeksi Bangunan';
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', terapkanFilter);
        }
        if (filterJenis) {
            filterJenis.addEventListener('change', terapkanFilter);
        }
        if (filterTahun) {
            filterTahun.addEventListener('change', terapkanFilter);
        }
        if (btnReset) {
            btnReset.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (filterJenis) filterJenis.value = '';
                if (filterTahun) filterTahun.value = '';
                terapkanFilter();
            });
        }
    });
</script>
@endpush