@extends('layouts.dashboard')

@section('title', 'Pencegahan Kebakaran & Inspeksi')

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
        --success-dark: #146c43;
        --info: #2563eb;
        --info-soft: rgba(37, 99, 235, .09);
    
        --steel: #64748b;
        --steel-soft: #94a3b8;
    
        --line: #e2e8f0;
        --line-dark: #d5dce6;
    
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
    
        --r-lg: 18px;
        --r-md: 14px;
        --r-sm: 10px;
    
        --sidebar-w: 288px;
        --topbar-h: 70px;
    
        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
        --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
    }
    .toast-wrap { position: fixed; z-index: 1100; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }

    @media (max-width: 900px) {
        .topbar { padding: 0 16px; }
        .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: var(--shadow-lg); }
        body.side-open .sidebar { transform: none; }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
        body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
    }

    /* ===== HEADER HALAMAN ===== */
    .page-head { margin-bottom: 26px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 800; font-size: 2rem; color: var(--ink); letter-spacing: -.02em; margin: 0 0 4px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

    .toolbar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .search-box { position: relative; width: 260px; }
    .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .search-box input { width: 100%; height: 40px; padding: 0 16px 0 38px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font-size: .86rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .search-box input::placeholder { color: var(--steel-soft); }
    .search-box input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-solid { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; color: #fff; font-weight: 600; font-size: .84rem; border: none; transition: background .2s, transform .1s, box-shadow .2s; text-decoration: none;}
    .btn-solid:hover { color: #fff; box-shadow: 0 4px 12px rgba(13,27,42,.18); }
    .btn-solid:active { transform: scale(.97); }
    .btn-solid.navy { background: var(--navy); }
    .btn-solid.navy:hover { background: var(--navy-dark); }
    .btn-solid.green { background: var(--success); }
    .btn-solid.green:hover { background: var(--success-dark); }
    .btn-solid.red { background: var(--signal); }
    .btn-solid.red:hover { background: var(--signal-dark); }

    /* ===== TABS ===== */
    .custom-nav-tabs { display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto; margin: 6px 0 30px; border-bottom: 1px solid var(--line); scrollbar-width: thin; }
    .custom-nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; border-radius: 0; color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em; padding: 12px 16px; background: transparent; white-space: nowrap; text-transform: uppercase; transition: color .2s, border-color .2s, background .2s; }
    .custom-nav-tabs .nav-link:hover { color: var(--ink); background: #f3f6fa; }
    .custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); background: transparent; }

    /* ===== KARTU STATISTIK (TAB SEMUA DATA) ===== */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; margin-bottom: 44px; }
    .stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 22px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease; position: relative; overflow: hidden; text-decoration: none;}
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
    .table-scroll-wrapper { width: 100%; overflow-x: auto; border-radius: var(--r-md); border: 1px solid var(--line); background: #fff; margin-bottom: 40px; box-shadow: var(--shadow-sm); scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 900px; margin-bottom: 0; }
    .table-detailed thead { background-color: var(--ink); color: #fff; }
    .table-detailed th { font-size: .7rem; font-weight: 700; padding: 18px 16px; white-space: nowrap; text-transform: uppercase; border-right: 1px solid var(--ink-3); letter-spacing: .05em; vertical-align: middle; }
    .table-detailed th:last-child { border-right: none; }
    .table-detailed td { font-size: .86rem; padding: 16px; vertical-align: middle; border-bottom: 1px solid var(--line); border-right: none; color: var(--ink); }
    .table-detailed tbody tr:last-child td { border-bottom: none; }
    .table-detailed tbody tr { transition: background .15s; }
    .table-detailed tbody tr:hover { background-color: #f8fafc; }

    .no-badge { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 50%; background: var(--navy-soft); color: var(--navy); font-weight: 700; font-size: .8rem; }
    .place-name { font-weight: 700; color: var(--ink); font-size: .92rem; line-height: 1.35; }
    .date-pill { display: inline-flex; align-items: center; gap: 7px; padding: 5px 12px; border-radius: 8px; background: #f1f5f9; color: var(--ink-3); font-size: .8rem; font-weight: 600; white-space: nowrap; }
    .date-pill i { color: var(--navy); font-size: .75rem; }
    .type-pill { display: inline-block; padding: 5px 12px; border-radius: 8px; background: var(--navy-light); color: var(--navy); font-size: .78rem; font-weight: 600; line-height: 1.4; }

    .btn-action { width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center; border-radius: 9px; font-size: .8rem; color: #fff; border: none; cursor: pointer; transition: transform .1s, box-shadow .2s; }
    .btn-action:hover { transform: scale(1.08); color: #fff; box-shadow: 0 3px 8px rgba(13,27,42,.18); }
    .btn-edit { background-color: var(--amber); color: var(--ink); }
    .btn-edit:hover { color: var(--ink); }
    .btn-delete { background-color: var(--signal); }
    .action-cell { display: flex; justify-content: center; align-items: center; gap: 6px; }

    .doc-badge { display: inline-block; padding: 5px 10px; font-size: .66rem; font-weight: 700; letter-spacing: .04em; border-radius: 7px; margin: 0 4px 4px 0; color: #fff !important; transition: opacity .2s, transform .1s; text-decoration: none; }
    .doc-badge:hover { opacity: .85; transform: translateY(-1px); }

    .empty-state { padding: 56px 16px !important; }

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
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .toolbar { width: 100%; display: flex; flex-wrap: wrap; gap: 8px; }
        .search-box { width: 100%; }
        .toolbar .btn-solid { flex: 1 1 auto; justify-content: center; padding: 0 14px; font-size: .82rem; }
        .custom-nav-tabs { -webkit-overflow-scrolling: touch; margin-bottom: 20px; }
        .custom-nav-tabs .nav-link { padding: 10px 12px; font-size: .78rem; }
        .stats-grid { grid-template-columns: 1fr; gap: 12px; margin-bottom: 34px; }
        .stat-card { padding: 19px; }
        .stat-ico { width: 42px; height: 42px; margin-bottom: 14px; }
        .stat-value { font-size: 1.7rem; }
        .recap-banner { padding: 16px; }
        .recap-right { width: 100%; }
        .recap-box { flex: 1; min-width: 0; }
        .section-heading .line { display: none; }
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
        .sidebar, .btn-logout, .toolbar, .btn-action, .toast-wrap { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
        .stat-card { box-shadow: none; break-inside: avoid; }
        .recap-banner { background: #fff !important; border: 1px solid #ddd; box-shadow: none; }
        .recap-title, .recap-sub, .recap-box .lbl, .recap-box .val { color: #000 !important; }
    }
</style>
@endpush

@section('content')
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-2">
            <div class="page-head mb-0">
                <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
                <p>Kelola data inspeksi bangunan gedung, lingkungan, dan pelaksanaan fire drill.</p>
            </div>

            {{-- Toolbar disembunyikan di tab Semua Data --}}
            @unless(Request::is('internal/pencegahan/inspeksi-kebakaran'))
            <div class="toolbar">
                <!-- PENCARIAN DITAMBAHKAN ID "searchInput" -->
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama tempat...">
                </div>

                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                    @if(Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*'))
                    <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/tambah" class="btn-solid navy">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    @endif
                @endhasanyrole

                <!-- EXCEL & PDF TERBUKA UNTUK SEMUA ROLE -->
                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-excel" class="btn-solid green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan/cetak-pdf" target="_blank" class="btn-solid red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
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

        <!-- BANNER REKAPITULASI -->
        <div class="recap-banner">
            <div class="recap-left">
                <div class="recap-ico"><i class="fas fa-clipboard-check"></i></div>
                <div>
                    <h2 class="recap-title">Rekapitulasi Inspeksi Bangunan</h2>
                    <p class="recap-sub">Akumulasi data inspeksi bangunan gedung dan lingkungan yang ditampilkan</p>
                </div>
            </div>
            <div class="recap-right">
                <div class="recap-box highlight">
                    <span class="lbl">Total Inspeksi</span>
                    <span class="val">{{ count($data_inspeksi) }} Tempat</span>
                </div>
            </div>
        </div>

        <!-- JUDUL SECTION -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-building-circle-check"></i></span>
            <h3>Data Inspeksi Bangunan &amp; Lingkungan</h3>
            <span class="line"></span>
            <span class="count-pill blue"><i class="fas fa-building"></i> {{ count($data_inspeksi) }} Tempat</span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="20%">Nama Tempat</th>
                        <th width="15%">Bulan / Tanggal Inspeksi</th>
                        <th width="25%">Jenis Usaha</th>
                        <th width="20%">Dokumen Terlampir</th>

                        <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <th class="text-center" width="15%">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>
                <!-- TBODY DITAMBAHKAN ID "tableBody" -->
                <tbody id="tableBody">
                    @forelse($data_inspeksi as $index => $item)
                    <tr class="data-row">
                        <td class="text-center"><span class="no-badge">{{ $index + 1 }}</span></td>
                        <td><div class="place-name">{{ $item->nama_tempat }}</div></td>
                        <td><span class="date-pill"><i class="fas fa-calendar-days"></i> {{ $item->tanggal_inspeksi }}</span></td>
                        <td style="white-space: normal;"><span class="type-pill">{{ $item->jenis_usaha }}</span></td>

                        <td style="white-space: normal;">
                            @if($item->surat_perintah_tugas)
                                <a href="/uploads/inspeksi/{{ $item->surat_perintah_tugas }}" class="doc-badge" style="background-color: #3b82f6;" target="_blank" title="Surat Perintah Tugas">SPT</a>
                            @endif
                            @if($item->berita_acara)
                                <a href="/uploads/inspeksi/{{ $item->berita_acara }}" class="doc-badge" style="background-color: #10b981;" target="_blank" title="Berita Acara">BA</a>
                            @endif
                            @if($item->hasil_penilaian)
                                <a href="/uploads/inspeksi/{{ $item->hasil_penilaian }}" class="doc-badge" style="background-color: #06b6d4;" target="_blank" title="Hasil Penilaian">NILAI</a>
                            @endif
                            @if($item->rekomendasi)
                                <a href="/uploads/inspeksi/{{ $item->rekomendasi }}" class="doc-badge" style="background-color: #8b5cf6;" target="_blank" title="Rekomendasi">REKOM</a>
                            @endif
                            @if($item->skk)
                                <a href="/uploads/inspeksi/{{ $item->skk }}" class="doc-badge" style="background-color: #ef4444;" target="_blank" title="Sertifikat Keselamatan">SKK</a>
                            @endif

                            @if(!$item->surat_perintah_tugas && !$item->berita_acara && !$item->hasil_penilaian && !$item->rekomendasi && !$item->skk)
                                <span class="text-muted" style="font-size: .72rem; font-style: italic;">Tidak ada dokumen</span>
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
                        <td colspan="{{ auth()->user()->hasAnyRole(['Pencegahan', 'Super User']) ? 6 : 5 }}" class="text-center text-muted fw-bold empty-state">
                            <i class="fas fa-folder-open mb-2" style="font-size: 28px; color: var(--steel-soft);"></i><br>
                            Belum ada data inspeksi bangunan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif
@endsection

<!-- SCRIPT PENCARIAN DITAMBAHKAN DI SINI -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        if (searchInput && tableBody) {
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = tableBody.getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    // Abaikan baris "Belum ada data" agar tidak ikut terfilter salah
                    if (rows[i].classList.contains('empty-row')) continue;

                    const text = rows[i].textContent || rows[i].innerText;
                    
                    if (text.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            });
        }
    });
</script>
@endpush