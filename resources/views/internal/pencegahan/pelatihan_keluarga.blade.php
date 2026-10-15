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
    .search-box { position: relative; width: 260px; max-width: 100%; }
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
    .count-pill {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        min-width: 58px; padding: 4px 12px; border-radius: 999px;
        font-weight: 700; font-size: .82rem;
    }
    .count-pill.female { background: rgba(219, 39, 119, .09); color: #be185d; }
    .count-pill.male   { background: var(--info-soft); color: var(--info); }
    .count-pill.total  { background: var(--navy-soft); color: var(--navy); }
    .count-pill i { font-size: .72rem; }
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
        .sidebar, .btn-logout, .toolbar-actions, .toast-wrap { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
    }
</style>
@endpush

@section('content')
@section('content')

        @php
            // Hak akses CRUD: hanya Pencegahan dan Super User
            $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);
        @endphp

        <!-- HEADER KONTEN & TOMBOL AKSI -->
        <div class="page-toolbar">
            <div class="page-head">
                <h1>Pemberdayaan Masyarakat</h1>
                <p>Kelola data sosialisasi, edukasi, dan pelatihan tanggap kebakaran.</p>
            </div>

            <div class="toolbar-actions">
                <!-- PENCARIAN: TERBUKA UNTUK SEMUA ROLE -->
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari kelurahan atau kecamatan..." aria-label="Cari kelurahan atau kecamatan">
                </div>

                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/create" class="btn-tool navy">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <!-- EXCEL & PDF TERBUKA UNTUK SEMUA ROLE -->
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/cetak-excel" class="btn-tool green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/cetak" target="_blank" class="btn-tool red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
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

        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-house-chimney"></i></span>
            <h3>Data Pelatihan Keluarga Tanggap Kebakaran</h3>
            <span class="line"></span>
        </div>

        @php
            $rows = collect($data_pelatihan ?? []);
            $totalP = $rows->sum(fn($r) => (int) ($r->peserta_perempuan ?? 0));
            $totalL = $rows->sum(fn($r) => (int) ($r->peserta_laki_laki ?? 0));
        @endphp

        <div class="table-card">
            <div class="table-scroll-wrapper">
                <table class="table-detailed table-peserta" id="tabelPelatihan">
                    <thead>
                        <tr>
                            <th rowspan="2" width="56">No</th>
                            <th rowspan="2" class="th-left">Hari / Tgl</th>
                            <th rowspan="2">RT</th>
                            <th rowspan="2" class="th-left">Kelurahan</th>
                            <th rowspan="2" class="th-left">Kecamatan</th>
                            <th colspan="3" class="th-group">Jumlah Peserta</th>
                            <th rowspan="2">Foto dan Video</th>

                            <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                            @hasanyrole('Pencegahan|Super User')
                            <th rowspan="2" width="100">Aksi</th>
                            @endhasanyrole
                        </tr>
                        <tr>
                            <th class="th-sub"><i class="fas fa-venus"></i>Perempuan</th>
                            <th class="th-sub"><i class="fas fa-mars"></i>Laki-laki</th>
                            <th class="th-sub">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $item)
                        @php
                            $tgl = $item->tanggal_pelaksanaan ?? null;
                            $p = (int) ($item->peserta_perempuan ?? 0);
                            $l = (int) ($item->peserta_laki_laki ?? 0);

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
                            <td class="col-center"><span class="count-pill female"><i class="fas fa-venus"></i>{{ $p }}</span></td>
                            <td class="col-center"><span class="count-pill male"><i class="fas fa-mars"></i>{{ $l }}</span></td>
                            <td class="col-center"><span class="count-pill total">{{ $p + $l }}</span></td>
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
                                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                            <td colspan="{{ $canCrud ? 10 : 9 }}" class="empty-state">
                                <i class="fas fa-folder-open"></i><br>
                                Belum ada data Pelatihan Keluarga Tanggap Kebakaran.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($rows->isNotEmpty())
                    <tfoot>
                        <tr>
                            <td colspan="5" class="foot-label">Total seluruh peserta</td>
                            <td class="col-center"><span class="count-pill female"><i class="fas fa-venus"></i>{{ $totalP }}</span></td>
                            <td class="col-center"><span class="count-pill male"><i class="fas fa-mars"></i>{{ $totalL }}</span></td>
                            <td class="col-center"><span class="count-pill total">{{ $totalP + $totalL }}</span></td>
                            <td colspan="{{ $canCrud ? 2 : 1 }}"></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Pencarian tabel ---------- */
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

    
})();
</script>
@endpush
