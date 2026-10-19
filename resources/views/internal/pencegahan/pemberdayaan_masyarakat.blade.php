@extends('layouts.dashboard')

@section('title', 'Pemberdayaan Masyarakat')

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
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 8px; }
    .page-toolbar .page-head { margin-bottom: 0; }
    .toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
    .search-box { position: relative; width: 320px; max-width: 100%; }
    .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .search-box input {
        width: 100%; height: 42px; padding: 0 14px 0 38px;
        border: 1px solid var(--line-dark); border-radius: var(--r-sm);
        background: #fff; font-size: .88rem; font-family: var(--font-body); color: var(--ink);
        transition: border-color .2s, box-shadow .2s;
    }
    .search-box input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-tool {
        display: inline-flex; align-items: center; gap: 8px;
        height: 42px; padding: 0 16px; border-radius: var(--r-sm);
        font-weight: 600; font-size: .85rem; color: #fff; border: none;
        transition: filter .2s, transform .1s, box-shadow .2s;
    }
    .btn-tool:hover { color: #fff; filter: brightness(1.08); box-shadow: var(--shadow-sm); }
    .btn-tool:active { transform: scale(.97); }
    .btn-tool.navy { background: var(--navy); }
    .btn-tool.green { background: var(--success); }
    .btn-tool.red { background: var(--signal); }
    .custom-nav-tabs {
        display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto;
        margin-top: 18px; padding-bottom: 0;
        border-bottom: 1px solid var(--line);
    }
    .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
    .custom-nav-tabs::-webkit-scrollbar-thumb { background: var(--steel-soft); border-radius: 10px; }
    .custom-nav-tabs .nav-link {
        border: none; border-bottom: 3px solid transparent; border-radius: 0;
        color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em;
        padding: 12px 18px; background: transparent; white-space: nowrap;
        transition: color .2s, border-color .2s, background .2s;
    }
    .custom-nav-tabs .nav-link:hover { color: var(--ink); background: var(--navy-soft); }
    .custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); }
    .table-scroll-wrapper {
        width: 100%; overflow-x: auto; background: #fff;
        border-radius: var(--r-md); border: 1px solid var(--line);
        box-shadow: var(--shadow-xs); margin-bottom: 40px;
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: var(--steel-soft); border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: var(--paper); }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 2500px; margin-bottom: 0; }
    .table-detailed thead { background: var(--ink); color: #fff; }
    .table-detailed th {
        font-size: .7rem; font-weight: 700; padding: 16px 15px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .05em; vertical-align: middle;
        border-right: 1px solid var(--ink-3);
    }
    .table-detailed td {
        font-size: .84rem; padding: 14px 15px; vertical-align: middle; white-space: nowrap;
        border-bottom: 1px solid var(--line); border-right: 1px solid var(--paper);
    }
    .table-detailed tbody tr { transition: background .15s; }
    .table-detailed tbody tr:hover { background: var(--paper); }
    .aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 6px; }
    .aksi-wrap form { margin: 0; display: inline-flex; }
    .btn-action {
        width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center;
        border-radius: 8px; font-size: .8rem; color: #fff; border: none; cursor: pointer;
        transition: transform .1s, filter .2s;
    }
    .btn-action:hover { transform: scale(1.06); color: #fff; filter: brightness(1.06); }
    .btn-edit { background: var(--amber); color: var(--ink); }
    .btn-edit:hover { color: var(--ink); }
    .btn-delete { background: var(--signal); }
    .empty-state { text-align: center; padding: 48px 12px !important; color: var(--steel); font-weight: 600; }
    .empty-state i { font-size: 28px; color: var(--steel-soft); margin-bottom: 8px; }
    .section-heading { display: flex; align-items: center; gap: 12px; margin: 30px 0 16px; flex-wrap: nowrap; }
    .section-heading-ico {
        flex: none; width: 32px; height: 32px; border-radius: 9px;
        background: var(--navy); color: #fff; display: grid; place-items: center;
        font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12);
    }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .table-detailed th.th-sub { background: rgba(255,255,255,.08); }
    .table-detailed th.th-group { border-bottom: 1px solid var(--ink-3); }
    .table-card {
        background: #fff; border-radius: var(--r-lg); overflow: hidden;
        border: 1px solid var(--line); box-shadow: var(--shadow-sm); margin-bottom: 40px;
    }
    .table-card .table-scroll-wrapper { border: 0; border-radius: 0; box-shadow: none; margin-bottom: 0; }
    .table-detailed.table-peserta { min-width: 1180px; table-layout: auto; }
    .table-peserta thead th { text-align: center; }
    .table-peserta thead th.th-left { text-align: left; }
    .table-peserta thead tr:first-child th { border-bottom: 1px solid var(--ink-3); }
    .table-peserta thead th.th-sub { background: var(--ink-2); font-size: .68rem; }
    .table-peserta thead th.th-sub i { margin-right: 6px; font-size: .78rem; }
    .table-peserta thead th.th-sub .fa-venus { color: #f9a8d4; }
    .table-peserta thead th.th-sub .fa-mars { color: #93c5fd; }
    .table-peserta tbody td { padding: 15px; }
    .table-peserta tbody tr:nth-child(even) { background: #fafbfd; }
    .table-peserta tbody tr:hover { background: var(--navy-light); }
    .table-peserta td.col-center { text-align: center; }
    .table-peserta td.col-rt { white-space: normal; min-width: 140px; max-width: 220px; text-align: center; }
    .cell-date strong { display: block; font-weight: 600; color: var(--ink); }
    .cell-date small { color: var(--steel); font-size: .74rem; }

    /* Styling Kolom Jumlah & Daftar Peserta seperti foto referensi */
    .peserta-single-count {
        font-weight: 600;
        font-size: .85rem;
        color: var(--ink);
    }
    .total-peserta-cell {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .total-peserta-angka {
        font-weight: 700;
        font-size: .86rem;
        color: var(--navy);
    }
    .btn-lihat-nama {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #dce4ee;
        color: var(--ink);
        font-weight: 600;
        font-size: .76rem;
        line-height: 1.25;
        cursor: pointer;
        transition: background .2s, border-color .2s, transform .1s, box-shadow .2s;
    }
    .btn-lihat-nama i {
        font-size: .82rem;
        color: var(--ink);
    }
    .btn-lihat-nama:hover {
        background: var(--navy-soft);
        border-color: var(--navy);
        color: var(--navy);
        box-shadow: var(--shadow-xs);
    }
    .btn-lihat-nama:hover i { color: var(--navy); }
    .btn-lihat-nama:active { transform: scale(.97); }

    /* Modal Daftar Peserta */
    .modal-peserta-backdrop {
        position: fixed;
        inset: 0;
        z-index: 1200;
        background: rgba(13, 27, 42, .55);
        backdrop-filter: blur(2px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-peserta-backdrop.show {
        display: flex;
    }
    .modal-peserta-dialog {
        width: 100%;
        max-width: 720px;
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(13, 27, 42, .28);
        animation: modalFadeIn .18s ease-out;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(8px) scale(.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .modal-peserta-header {
        background: var(--ink);
        color: #fff;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .modal-peserta-title {
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 700;
        margin: 0;
        color: #fff;
    }
    .modal-peserta-close {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, .8);
        font-size: 1.35rem;
        line-height: 1;
        cursor: pointer;
        padding: 4px;
        transition: color .15s;
    }
    .modal-peserta-close:hover { color: #fff; }
    .modal-peserta-body {
        padding: 24px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        max-height: 75vh;
        overflow-y: auto;
    }
    .peserta-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
    }
    .peserta-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 12px;
        margin-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
    }
    .peserta-card-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: .92rem;
        color: var(--ink);
    }
    .peserta-card-label .fa-mars { color: #0284c7; font-size: 1rem; }
    .peserta-card-label .fa-venus { color: #e11d48; font-size: 1rem; }
    .peserta-card-badge {
        background: #e2e8f0;
        color: var(--ink);
        font-weight: 700;
        font-size: .76rem;
        padding: 4px 10px;
        border-radius: 6px;
    }
    .peserta-name-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .peserta-name-list li {
        font-size: .88rem;
        color: #334155;
        padding: 2px 0;
        word-break: break-word;
    }
    .peserta-name-empty {
        font-size: .84rem;
        color: var(--steel);
        font-style: italic;
    }

    .table-peserta tfoot td {
        background: var(--paper); font-weight: 700; font-size: .84rem;
        padding: 14px 15px; border-top: 2px solid var(--line-dark); border-bottom: 0;
    }
    .table-peserta tfoot td.foot-label { text-align: right; text-transform: uppercase; letter-spacing: .05em; font-size: .72rem; color: var(--steel); }
    .media-links { display: flex; flex-wrap: wrap; gap: 6px; justify-content: center; }
    .btn-media {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--info); font-weight: 600; font-size: .82rem;
        padding: 5px 12px; border-radius: 8px; background: var(--info-soft);
        border: 0; transition: background .2s, color .2s;
    }
    .btn-media:hover { background: var(--info); color: #fff; }
    .media-empty { color: var(--steel-soft); }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
    .stat-card {
        display: flex; flex-direction: column; align-items: flex-start;
        padding: 22px; background: #ffffff; border-radius: var(--r-md);
        border: 1px solid var(--line); box-shadow: var(--shadow-xs);
        transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
        position: relative; overflow: hidden;
    }
    .stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
    .stat-card::after {
        content: "\f061"; font-family: "Font Awesome 6 Free"; font-weight: 900;
        position: absolute; top: 22px; right: 20px;
        color: var(--steel-soft); font-size: .8rem;
        opacity: 0; transform: translateX(-6px);
        transition: opacity .2s ease, transform .2s ease;
    }
    .stat-card:hover::after { opacity: 1; transform: translateX(0); }
    .stat-ico {
        width: 46px; height: 46px; border-radius: var(--r-sm);
        display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px;
        background: var(--navy-soft); color: var(--navy);
    }
    .stat-title { font-size: .74rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.9rem; line-height: 1; color: var(--ink); letter-spacing: -.01em; }
    @media (max-width: 1100px) {
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .topbar { padding: 0 20px; }
        .content { padding: 32px 26px 60px; }
    }
    @media (max-width: 700px) {
        .stats-grid { grid-template-columns: 1fr; gap: 12px; }
        .stat-card { padding: 19px; }
        .modal-peserta-body { grid-template-columns: 1fr; padding: 18px; }
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
        .search-box { width: 100%; }
        .toolbar-actions { width: 100%; }
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
        .sidebar, .btn-logout, .toolbar-actions, .toast-wrap, .btn-lihat-nama { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
    }
</style>
@endpush

@section('content')

        @php
            // Semua Data = halaman utama; selain itu = tabel Sosialisasi & Edukasi
            $aktif = Request::is('internal/pencegahan/pemberdayaan-masyarakat') ? 'semua' : 'sosialisasi';

            // Hak akses CRUD: hanya Pencegahan dan Super User
            $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);
        @endphp

        <!-- HEADER KONTEN & TOMBOL AKSI -->
        <div class="page-toolbar">
            <div class="page-head">
                <h1>Pemberdayaan Masyarakat</h1>
                <p>Kelola data sosialisasi, edukasi, dan pelatihan tanggap kebakaran.</p>
            </div>

            @if($aktif !== 'semua')
            <div class="toolbar-actions">
                <!-- PENCARIAN: TERBUKA UNTUK SEMUA ROLE -->
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari kelurahan, sekolah, atau nama peserta..." aria-label="Cari kelurahan, sekolah, atau nama peserta">
                </div>

                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/create" class="btn-tool navy">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <!-- EXCEL & PDF TERBUKA UNTUK SEMUA ROLE -->
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/cetak-excel" class="btn-tool green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/cetak" target="_blank" class="btn-tool red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
            @endif
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ $aktif === 'semua' ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat">Semua Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aktif === 'sosialisasi' ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi">SOSIALISASI DAN EDUKASI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga">PELATIHAN KELUARGA TANGGAP KEBAKARAN</a>
            </li>
        </ul>

        @if($aktif === 'semua')

            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-handshake-angle"></i></span>
                <h3>Ringkasan Pemberdayaan</h3>
                <span class="line"></span>
            </div>

            <div class="stats-grid">
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="stat-card">
                    <div class="stat-ico"><i class="fas fa-house-chimney"></i></div>
                    <div>
                        <div class="stat-title">Pelatihan Keluarga</div>
                        <div class="stat-value">{{ $total_pelatihan ?? count($data_pelatihan ?? []) }}</div>
                    </div>
                </a>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="stat-card">
                    <div class="stat-ico"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-title">Sosialisasi &amp; Edukasi</div>
                        <div class="stat-value">{{ $total_sosialisasi ?? count($data_sosialisasi ?? []) }}</div>
                    </div>
                </a>
            </div>

        @else

            <div class="section-heading">
                <span class="section-heading-ico"><i class="fas fa-users"></i></span>
                <h3>Data Sosialisasi &amp; Edukasi</h3>
                <span class="line"></span>
            </div>

            @php
                $rows = collect($data_sosialisasi ?? []);
                $totalP = 0;
                $totalL = 0;
            @endphp

            <div class="table-card">
                <div class="table-scroll-wrapper">
                    <table class="table-detailed table-peserta" id="tabelSosialisasi">
                        <thead>
                            <tr>
                                <th rowspan="2" width="56">No</th>
                                <th rowspan="2" class="th-left">Hari / Tgl</th>
                                <th rowspan="2">RT</th>
                                <th rowspan="2" class="th-left">Kelurahan</th>
                                <th rowspan="2" class="th-left">Kecamatan</th>
                                <th rowspan="2" class="th-left">Posyandu / Nama Sekolah</th>
                                <th colspan="3" class="th-group">Jumlah &amp; Daftar Peserta</th>
                                <th rowspan="2">Foto dan Video</th>

                                <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                                @hasanyrole('Pencegahan|Super User')
                                <th rowspan="2" width="100">Aksi</th>
                                @endhasanyrole
                            </tr>
                            <tr>
                                <th class="th-sub">Laki-laki</th>
                                <th class="th-sub">Perempuan</th>
                                <th class="th-sub">Total Peserta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rows as $item)
                            @php
                                $tgl = $item->tanggal_pelaksanaan ?? null;
                                $tahun = $tgl ? \Carbon\Carbon::parse($tgl)->format('Y') : ($item->tahun ?? null);

                                // Mendukung berbagai kemungkinan nama kolom daftar peserta (teks per baris, koma, atau JSON/array)
                                $rawNamaL = $item->nama_peserta_laki_laki
                                    ?? $item->daftar_peserta_laki_laki
                                    ?? $item->peserta_laki_nama
                                    ?? $item->nama_laki_laki
                                    ?? '';

                                $rawNamaP = $item->nama_peserta_perempuan
                                    ?? $item->daftar_peserta_perempuan
                                    ?? $item->peserta_perempuan_nama
                                    ?? $item->nama_perempuan
                                    ?? '';

                                $parseNama = function ($raw) {
                                    if (is_array($raw)) {
                                        return collect($raw)->map(fn($n) => trim((string) $n))->filter()->values();
                                    }
                                    if (is_string($raw) && str_starts_with(trim($raw), '[')) {
                                        $decoded = json_decode($raw, true);
                                        if (is_array($decoded)) {
                                            return collect($decoded)->map(fn($n) => trim((string) $n))->filter()->values();
                                        }
                                    }
                                    return collect(preg_split('/[\r\n,;]+/', (string) $raw))
                                        ->map(fn($n) => trim($n))
                                        ->filter()
                                        ->values();
                                };

                                $listNamaL = $parseNama($rawNamaL);
                                $listNamaP = $parseNama($rawNamaP);

                                $l = (int) ($item->peserta_laki_laki ?? $listNamaL->count());
                                $p = (int) ($item->peserta_perempuan ?? $listNamaP->count());

                                $totalL += $l;
                                $totalP += $p;

                                $judulLokasi = $item->posyandu_sekolah ?? $item->nama_sekolah ?? $item->kelurahan ?? 'Daftar Peserta';
                                $judulModal = $tahun ? "{$judulLokasi} (Tahun {$tahun})" : $judulLokasi;

                                // Link dokumentasi: satu link per baris (atau dipisah koma / spasi)
                                $links = collect(preg_split('/[\r\n,\s]+/', (string) ($item->link_dokumentasi ?? '')))
                                    ->map(fn ($u) => trim($u))
                                    ->filter(fn ($u) => preg_match('#^https?://#i', $u))
                                    ->values();
                            @endphp
                            <tr>
                                <td class="col-center fw-bold">{{ $loop->iteration }}</td>
                                <td class="cell-date">
                                    @if($tgl)
                                        <strong>{{ \Carbon\Carbon::parse($tgl)->locale('id')->translatedFormat('d F Y') }}</strong>
                                        <small>{{ \Carbon\Carbon::parse($tgl)->locale('id')->translatedFormat('l') }}</small>
                                    @else
                                        <strong>{{ $item->hari_tgl ?? '-' }}</strong>
                                    @endif
                                </td>
                                <td class="col-rt">{{ $item->rt ?? '-' }}</td>
                                <td><strong>{{ $item->kelurahan ?? '-' }}</strong></td>
                                <td>{{ $item->kecamatan ?? '-' }}</td>
                                <td>
                                    {{ $item->posyandu_sekolah ?? $item->nama_sekolah ?? '-' }}
                                    <!-- Teks tersembunyi agar nama peserta ikut terfilter saat dicari di kotak pencarian -->
                                    <span style="display:none">{{ $listNamaL->join(' ') }} {{ $listNamaP->join(' ') }}</span>
                                </td>
                                <td class="col-center">
                                    <span class="peserta-single-count">{{ $l }} Orang</span>
                                </td>
                                <td class="col-center">
                                    <span class="peserta-single-count">{{ $p }} Orang</span>
                                </td>
                                <td class="col-center">
                                    <div class="total-peserta-cell">
                                        <span class="total-peserta-angka">{{ $l + $p }} Orang</span>
                                        <button
                                            type="button"
                                            class="btn-lihat-nama"
                                            data-title="{{ $judulModal }}"
                                            data-count-l="{{ $l }}"
                                            data-count-p="{{ $p }}"
                                            data-nama-l='@json($listNamaL)'
                                            data-nama-p='@json($listNamaP)'
                                            onclick="bukaModalPeserta(this)">
                                            <i class="fas fa-users"></i>
                                            <span>Lihat<br>Nama</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="col-center">
                                    @if($links->isNotEmpty())
                                        <div class="media-links">
                                            @foreach($links as $i => $u)
                                                <a href="{{ $u }}" target="_blank" rel="noopener noreferrer" class="btn-media">
                                                    <i class="fas fa-link"></i> {{ $links->count() > 1 ? 'Link ' . ($i + 1) : 'Lihat' }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="media-empty">-</span>
                                    @endif
                                </td>

                                <!-- TOMBOL EDIT & HAPUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                                @hasanyrole('Pencegahan|Super User')
                                <td>
                                    <div class="aksi-wrap">
                                        <a href="/internal/pencegahan/pemberdayaan-masyarakat/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/internal/pencegahan/pemberdayaan-masyarakat/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                            <tr>
                                <td colspan="{{ $canCrud ? 11 : 10 }}" class="empty-state">
                                    <i class="fas fa-folder-open"></i><br>
                                    Belum ada data sosialisasi dan edukasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($rows->isNotEmpty())
                        <tfoot>
                            <tr>
                                <td colspan="6" class="foot-label">Total seluruh peserta</td>
                                <td class="col-center"><span class="peserta-single-count">{{ $totalL }} Orang</span></td>
                                <td class="col-center"><span class="peserta-single-count">{{ $totalP }} Orang</span></td>
                                <td class="col-center"><span class="total-peserta-angka">{{ $totalL + $totalP }} Orang</span></td>
                                <td colspan="{{ $canCrud ? 2 : 1 }}"></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            <!-- MODAL POP-UP DAFTAR PESERTA -->
            <div class="modal-peserta-backdrop" id="modalDaftarPeserta" onclick="tutupModalBackdrop(event)">
                <div class="modal-peserta-dialog" role="dialog" aria-modal="true" aria-labelledby="modalPesertaTitle">
                    <div class="modal-peserta-header">
                        <h4 class="modal-peserta-title" id="modalPesertaTitle">Daftar Peserta</h4>
                        <button type="button" class="modal-peserta-close" onclick="tutupModalPeserta()" aria-label="Tutup">&times;</button>
                    </div>
                    <div class="modal-peserta-body">
                        <!-- Kolom Peserta Laki-laki -->
                        <div class="peserta-card">
                            <div class="peserta-card-head">
                                <span class="peserta-card-label">
                                    <i class="fas fa-mars"></i> Peserta Laki-laki
                                </span>
                                <span class="peserta-card-badge" id="modalCountL">0 Orang</span>
                            </div>
                            <ul class="peserta-name-list" id="modalListL"></ul>
                        </div>

                        <!-- Kolom Peserta Perempuan -->
                        <div class="peserta-card">
                            <div class="peserta-card-head">
                                <span class="peserta-card-label">
                                    <i class="fas fa-venus"></i> Peserta Perempuan
                                </span>
                                <span class="peserta-card-badge" id="modalCountP">0 Orang</span>
                            </div>
                            <ul class="peserta-name-list" id="modalListP"></ul>
                        </div>
                    </div>
                </div>
            </div>

        @endif
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Pencarian tabel (termasuk nama peserta) ---------- */
    var searchInput = document.querySelector('.search-box input');
    var tbody = document.querySelector('.table-peserta tbody');
    if (searchInput && tbody) {
        searchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            tbody.querySelectorAll('tr').forEach(function (tr) {
                if (tr.querySelector('.empty-state')) return;
                tr.style.display = tr.textContent.toLowerCase().indexOf(q) > -1 ? '' : 'none';
            });
        });
    }

    /* ---------- Modal Daftar Peserta ---------- */
    var modal = document.getElementById('modalDaftarPeserta');
    var titleEl = document.getElementById('modalPesertaTitle');
    var countLEl = document.getElementById('modalCountL');
    var countPEl = document.getElementById('modalCountP');
    var listLEl = document.getElementById('modalListL');
    var listPEl = document.getElementById('modalListP');

    function renderList(ulElement, items) {
        ulElement.innerHTML = '';
        if (!Array.isArray(items) || items.length === 0) {
            var emptyLi = document.createElement('li');
            emptyLi.className = 'peserta-name-empty';
            emptyLi.textContent = 'Belum ada daftar nama peserta.';
            ulElement.appendChild(emptyLi);
            return;
        }
        items.forEach(function (nama) {
            var li = document.createElement('li');
            li.textContent = nama;
            ulElement.appendChild(li);
        });
    }

    window.bukaModalPeserta = function (btn) {
        if (!modal) return;
        var title = btn.getAttribute('data-title') || 'Daftar Peserta';
        var countL = btn.getAttribute('data-count-l') || 0;
        var countP = btn.getAttribute('data-count-p') || 0;
        var namaL = [];
        var namaP = [];

        try { namaL = JSON.parse(btn.getAttribute('data-nama-l') || '[]'); } catch (e) {}
        try { namaP = JSON.parse(btn.getAttribute('data-nama-p') || '[]'); } catch (e) {}

        titleEl.textContent = title;
        countLEl.textContent = countL + ' Orang';
        countPEl.textContent = countP + ' Orang';

        renderList(listLEl, namaL);
        renderList(listPEl, namaP);

        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    };

    window.tutupModalPeserta = function () {
        if (!modal) return;
        modal.classList.remove('show');
        document.body.style.overflow = '';
    };

    window.tutupModalBackdrop = function (e) {
        if (e.target === modal) {
            window.tutupModalPeserta();
        }
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('show')) {
            window.tutupModalPeserta();
        }
    });
})();
</script>
@endpush