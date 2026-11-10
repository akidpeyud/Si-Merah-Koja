@extends('layouts.dashboard')

@section('title', 'Fire Drill')

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

    /* Filter Bar */
    .filter-bar {
        display: flex; flex-wrap: wrap; gap: 12px; align-items: center;
        background: #ffffff; padding: 14px 18px; border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(15, 23, 42, .03);
        margin: 22px 0 18px;
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
    .search-box input:focus {
        outline: none; background: #fff; border-color: var(--navy, #163a63);
        box-shadow: 0 0 0 3px rgba(22, 58, 99, .12);
    }
    .filter-select {
        height: 42px; padding: 0 36px 0 14px;
        border: 1px solid #cbd5e1; border-radius: 10px;
        background-color: #f8fafc; font-size: .85rem; font-weight: 600; color: #1e293b;
        min-width: 175px; cursor: pointer; transition: all .2s ease;
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

    /* Ringkasan Grand Total */
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
        padding: 8px 16px; border-radius: 10px; text-align: center; min-width: 135px;
    }
    .summary-metric-box span { display: block; font-size: .68rem; text-transform: uppercase; letter-spacing: .05em; color: rgba(255,255,255,.75); font-weight: 600; }
    .summary-metric-box strong { font-size: 1.1rem; font-weight: 800; color: #fff; }
    .summary-metric-box.highlight { background: #f59e0b; border-color: #fbbf24; }
    .summary-metric-box.highlight span { color: #451a03; font-weight: 700; }
    .summary-metric-box.highlight strong { color: #0f172a; }

    /* Judul Section */
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; flex-wrap: wrap; }
    .section-heading-ico { flex: none; width: 36px; height: 36px; border-radius: 10px; background: #163a63; color: #fff; display: grid; place-items: center; font-size: .85rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-weight: 800; font-size: 1.05rem; color: #0f172a; letter-spacing: -.01em; margin: 0; text-transform: uppercase; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, #e2e8f0, transparent 90%); }
    .count-pill { display: inline-flex; align-items: center; gap: 7px; padding: 6px 14px; border-radius: 999px; background: #eff6ff; border: 1px solid #bfdbfe; font-size: .76rem; font-weight: 700; color: #1e40af; }

    /* Tabel Utama */
    .table-scroll-wrapper {
        width: 100%; overflow-x: auto; background: #fff;
        border-radius: 14px; border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04);
        margin-bottom: 34px;
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: #f8fafc; }

    .table-detailed { width: 100%; border-collapse: collapse; min-width: 1150px; margin-bottom: 0; }
    .table-detailed thead { background: #0f172a; color: #fff; }
    .table-detailed th {
        font-size: .71rem; font-weight: 700; padding: 15px 14px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .05em; vertical-align: middle;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }
    .table-detailed th:last-child { border-right: none; }

    .table-detailed td {
        font-size: .86rem; padding: 14px; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    .table-detailed tbody tr { transition: background .15s ease; }
    .table-detailed tbody tr:hover { background: #f8fafc; }

    .no-badge { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 50%; background: #eff6ff; color: #163a63; font-weight: 700; font-size: .8rem; }
    .instansi-title { font-weight: 700; color: #0f172a; font-size: .9rem; line-height: 1.35; }
    .chip-peserta {
        display: inline-block; padding: 5px 12px; border-radius: 8px;
        font-weight: 700; font-size: .82rem; background: #eff6ff; color: #1e40af;
        white-space: nowrap;
    }
    .doc-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 11px; font-size: .7rem; font-weight: 700; letter-spacing: .03em;
        border-radius: 7px; background-color: #3b82f6; color: #fff !important;
        text-decoration: none; transition: opacity .2s, transform .1s; white-space: nowrap;
    }
    .doc-badge:hover { opacity: .88; transform: translateY(-1px); }

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
    }

    @media (max-width: 700px) {
        .search-box { width: 100%; }
        .filter-select { flex: 1 1 auto; }
        .toolbar-actions { width: 100%; }
        .summary-metrics { width: 100%; }
        .summary-metric-box { flex: 1 1 auto; }
        .section-heading .line { display: none; }
    }
</style>
@endpush

@section('content')
    @php
        $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);
        $koleksiData = collect($data_fire_drill ?? []);
        $listTahunCetak = ($daftar_tahun ?? $koleksiData->pluck('tahun')->filter()->unique()->sortDesc()->values());

        $grandTotalInstansi = $koleksiData->count();
        $grandTotalPeserta  = $koleksiData->sum(fn ($i) => (int) ($i->total_peserta ?? 0));
    @endphp

    <!-- HEADER KONTEN & TOMBOL AKSI -->
    <div class="page-toolbar">
        <div class="page-head">
            <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
            <p>Kelola data instansi/lembaga yang melaksanakan pelatihan pemadam kebakaran (Fire Drill).</p>
        </div>

        <div class="toolbar-actions">
            @hasanyrole('Pencegahan|Super User')
            <a href="{{ route('fire_drill.create') }}" class="btn-tool navy">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            @endhasanyrole

            <!-- DROPDOWN CETAK EXCEL (SEMUA DATA & PER TAHUN) -->
            <div class="export-dropdown">
                <button type="button" class="btn-tool green" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-excel"></i> Excel <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format Excel</div>
                    <a href="{{ route('fire_drill.excel') }}" class="export-item">
                        <span>Semua Data (Rekap)</span>
                        <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                    </a>
                    @if($listTahunCetak->isNotEmpty())
                        <div class="export-divider"></div>
                        <div class="export-menu-label">Cetak Per Tahun</div>
                        @foreach($listTahunCetak as $thn)
                            <a href="{{ route('fire_drill.excel', ['tahun' => $thn]) }}" class="export-item">
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
                    <a href="{{ route('fire_drill.cetak') }}" target="_blank" class="export-item">
                        <span>Semua Data (Rekap)</span>
                        <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                    </a>
                    @if($listTahunCetak->isNotEmpty())
                        <div class="export-divider"></div>
                        <div class="export-menu-label">Cetak Per Tahun</div>
                        @foreach($listTahunCetak as $thn)
                            <a href="{{ route('fire_drill.cetak', ['tahun' => $thn]) }}" target="_blank" class="export-item">
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
            <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran">Semua Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/bangunan*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/bangunan">INSPEKSI BANGUNAN GEDUNG DAN LINGKUNGAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/fire-drill*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/fire-drill">FIRE DRILL</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('internal/pencegahan/inspeksi-kebakaran/pks*') ? 'active' : '' }}" href="/internal/pencegahan/inspeksi-kebakaran/pks">PKS (PERJANJIAN KERJASAMA)</a>
        </li>
    </ul>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchFireDrill" placeholder="Cari instansi/lembaga, tempat, atau penanggung jawab..." aria-label="Cari data fire drill">
        </div>

        <select id="filterInstansi" class="filter-select" aria-label="Filter Instansi">
            <option value="">Semua Instansi</option>
            @foreach(($daftar_instansi ?? $koleksiData->pluck('nama_instansi')->filter()->unique()->sort()) as $instansi)
                <option value="{{ strtolower($instansi) }}">{{ $instansi }}</option>
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

    <!-- BANNER RINGKASAN -->
    <div class="summary-strip" id="summaryStrip">
        <div class="summary-strip-title">
            <i class="fas fa-fire"></i>
            <div>
                <h4 id="judulSummary">REKAPITULASI DATA FIRE DRILL</h4>
                <p id="subJudulSummary">Akumulasi instansi/lembaga dan peserta pelatihan Fire Drill yang ditampilkan</p>
            </div>
        </div>
        <div class="summary-metrics">
            <div class="summary-metric-box">
                <span>Total Instansi/Lembaga</span>
                <strong id="grandInstansi">{{ number_format($grandTotalInstansi, 0, ',', '.') }}</strong>
            </div>
            <div class="summary-metric-box highlight">
                <span>Jumlah Total Peserta</span>
                <strong id="grandTotal">{{ number_format($grandTotalPeserta, 0, ',', '.') }} Orang</strong>
            </div>
        </div>
    </div>

    <!-- JUDUL SECTION -->
    <div class="section-heading">
        <span class="section-heading-ico"><i class="fas fa-fire-extinguisher"></i></span>
        <h3>Data Pelaksanaan Fire Drill</h3>
        <span class="line"></span>
        <span class="count-pill"><i class="fas fa-building"></i> <span id="pillCountInstansi">{{ $grandTotalInstansi }}</span> Instansi</span>
    </div>

    <!-- TABEL DATA 8 KOLOM -->
    <div class="table-scroll-wrapper">
        <table class="table-detailed">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama Instansi/Lembaga</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Tempat Pelaksanaan</th>
                    <th class="text-center">Jumlah Peserta</th>
                    <th>Nama Penanggung Jawab</th>
                    <th class="text-center">No Telfon/WA Penanggung Jawab</th>
                    <th class="text-center">Upload SPT</th>
                    @hasanyrole('Pencegahan|Super User')
                    <th class="text-center">Aksi</th>
                    @endhasanyrole
                </tr>
            </thead>
            <tbody id="tableBodyFireDrill">
                @forelse($koleksiData as $index => $item)
                <tr class="baris-data"
                    data-tahun="{{ $item->tahun ?? '' }}"
                    data-instansi="{{ strtolower($item->nama_instansi ?? '') }}"
                    data-total="{{ (int) ($item->total_peserta ?? 0) }}"
                    data-pencarian="{{ strtolower(($item->nama_instansi ?? '') . ' ' . ($item->tanggal_pelaksanaan ?? '') . ' ' . ($item->tempat_pelaksanaan ?? '') . ' ' . ($item->nama_penanggung_jawab ?? '') . ' ' . ($item->no_telepon ?? '')) }}">

                    <td class="text-center"><span class="no-badge nomor-urut">{{ $index + 1 }}</span></td>
                    <td><div class="instansi-title">{{ $item->nama_instansi ?? '-' }}</div></td>
                    <td>{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
                    <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                    <td class="text-center">
                        <span class="chip-peserta">{{ number_format((int) ($item->total_peserta ?? 0), 0, ',', '.') }} Orang</span>
                    </td>
                    <td>{{ $item->nama_penanggung_jawab ?? '-' }}</td>
                    <td class="text-center" style="white-space: nowrap;">{{ $item->no_telepon ?? '-' }}</td>
                    <td class="text-center">
                        @if(!empty($item->surat_perintah_tugas))
                            <a href="/uploads/fire_drill/{{ $item->surat_perintah_tugas }}" class="doc-badge" target="_blank" title="Lihat Surat Perintah Tugas">
                                <i class="fas fa-file-lines"></i> SPT
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    @hasanyrole('Pencegahan|Super User')
                    <td>
                        <div class="aksi-wrap">
                            <a href="{{ route('fire_drill.edit', $item->id) }}" class="btn-action btn-edit" title="Edit Data">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('fire_drill.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                @empty
                <tr class="empty-row">
                    <td colspan="{{ $canCrud ? 9 : 8 }}" class="empty-state">
                        <i class="fas fa-folder-open" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
                        Belum ada data Fire Drill.
                    </td>
                </tr>
                @endforelse

                <tr id="emptyFilterRow" style="display: none;">
                    <td colspan="{{ $canCrud ? 9 : 8 }}" class="empty-state">
                        <i class="fas fa-magnifying-glass" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
                        Data Fire Drill yang Anda cari tidak ditemukan.
                    </td>
                </tr>
            </tbody>
        </table>
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

        var searchInput = document.getElementById('searchFireDrill');
        var filterInstansi = document.getElementById('filterInstansi');
        var filterTahun = document.getElementById('filterTahun');
        var btnReset = document.getElementById('btnResetFilter');
        var rows = Array.prototype.slice.call(document.querySelectorAll('#tableBodyFireDrill tr.baris-data'));
        var emptyFilterRow = document.getElementById('emptyFilterRow');

        var elGrandInstansi = document.getElementById('grandInstansi');
        var elGrandTotal = document.getElementById('grandTotal');
        var elJudulSummary = document.getElementById('judulSummary');
        var elPillCount = document.getElementById('pillCountInstansi');

        function formatRibuan(angka) {
            return Number(angka || 0).toLocaleString('id-ID');
        }

        function terapkanFilter() {
            if (rows.length === 0) {
                return;
            }

            var q = (searchInput.value || '').toLowerCase().trim();
            var inst = (filterInstansi.value || '').toLowerCase().trim();
            var thn = (filterTahun.value || '').trim();

            var urut = 0;
            var totalPeserta = 0;

            rows.forEach(function (row) {
                var cocokCari = !q || (row.getAttribute('data-pencarian') || '').indexOf(q) !== -1;
                var cocokInst = !inst || (row.getAttribute('data-instansi') || '') === inst;
                var cocokThn = !thn || (row.getAttribute('data-tahun') || '') === thn;

                if (cocokCari && cocokInst && cocokThn) {
                    row.style.display = '';
                    urut++;
                    var noEl = row.querySelector('.nomor-urut');
                    if (noEl) {
                        noEl.textContent = urut;
                    }
                    totalPeserta += parseInt(row.getAttribute('data-total') || '0', 10);
                } else {
                    row.style.display = 'none';
                }
            });

            if (emptyFilterRow) {
                emptyFilterRow.style.display = urut === 0 ? '' : 'none';
            }
            if (elGrandInstansi) {
                elGrandInstansi.textContent = formatRibuan(urut);
            }
            if (elGrandTotal) {
                elGrandTotal.textContent = formatRibuan(totalPeserta) + ' Orang';
            }
            if (elPillCount) {
                elPillCount.textContent = formatRibuan(urut);
            }
            if (elJudulSummary) {
                elJudulSummary.textContent = thn
                    ? 'REKAPITULASI DATA FIRE DRILL (TAHUN ' + thn + ')'
                    : 'REKAPITULASI DATA FIRE DRILL';
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', terapkanFilter);
        }
        if (filterInstansi) {
            filterInstansi.addEventListener('change', terapkanFilter);
        }
        if (filterTahun) {
            filterTahun.addEventListener('change', terapkanFilter);
        }
        if (btnReset) {
            btnReset.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (filterInstansi) filterInstansi.value = '';
                if (filterTahun) filterTahun.value = '';
                terapkanFilter();
            });
        }
    })();
</script>
@endpush
