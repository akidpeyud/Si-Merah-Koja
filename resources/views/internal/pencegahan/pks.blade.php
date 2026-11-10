@extends('layouts.dashboard')

@section('title', 'Perjanjian Kerjasama (PKS)')

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
        box-shadow: 0 2px 8px rgba(15, 23, 42, .08);
    }
    .btn-tool:hover { transform: translateY(-1px); filter: brightness(1.08); color: #fff; }
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
        background: linear-gradient(135deg, #0f172a 0%, #065f46 100%);
        color: #fff; padding: 16px 22px; border-radius: 14px;
        margin-bottom: 24px; box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .summary-strip-title { display: flex; align-items: center; gap: 12px; }
    .summary-strip-title i {
        width: 42px; height: 42px; border-radius: 10px;
        background: rgba(255,255,255,.12); color: #34d399;
        display: grid; place-items: center; font-size: 1.1rem;
    }
    .summary-strip-title h4 { font-size: .96rem; font-weight: 800; margin: 0 0 2px; letter-spacing: .02em; }
    .summary-strip-title p { font-size: .78rem; opacity: .82; margin: 0; }
    .summary-metrics { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .summary-metric-box {
        background: rgba(255, 255, 255, .08); border: 1px solid rgba(255, 255, 255, .14);
        padding: 10px 18px; border-radius: 10px; text-align: right;
    }
    .summary-metric-box span { display: block; font-size: .72rem; text-transform: uppercase; letter-spacing: .04em; opacity: .85; }
    .summary-metric-box strong { font-size: 1.15rem; font-weight: 800; }
    .summary-metric-box.highlight { background: rgba(52, 211, 153, .18); border-color: rgba(52, 211, 153, .4); }

    /* Judul Bagian */
    .section-heading {
        display: flex; align-items: center; gap: 12px;
        margin-top: 10px; margin-bottom: 14px;
    }
    .section-heading-ico {
        width: 32px; height: 32px; border-radius: 8px;
        background: #ecfdf5; color: #059669;
        display: grid; place-items: center; font-size: .88rem;
    }
    .section-heading h3 { font-size: .98rem; font-weight: 800; color: #0f172a; margin: 0; }
    .section-heading .line { flex: 1; height: 1px; background: #e2e8f0; }
    .count-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 10px; border-radius: 20px;
        background: #f1f5f9; color: #475569; font-size: .75rem; font-weight: 700;
    }

    /* Tabel Data */
    .table-scroll-wrapper {
        background: #ffffff; border-radius: 14px; border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04); overflow-x: auto;
    }
    .table-detailed { width: 100%; border-collapse: separate; border-spacing: 0; min-width: 950px; }
    .table-detailed th {
        background: #0f172a; color: #ffffff;
        font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
        padding: 13px 14px; border: none; border-right: 1px solid rgba(255,255,255,.08);
        white-space: nowrap; vertical-align: middle;
    }
    .table-detailed th:last-child { border-right: none; }

    .table-detailed td {
        font-size: .86rem; padding: 14px; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    .table-detailed tbody tr { transition: background .15s ease; }
    .table-detailed tbody tr:hover { background: #f8fafc; }

    .no-badge { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 50%; background: #ecfdf5; color: #065f46; font-weight: 700; font-size: .8rem; }
    .perusahaan-title { font-weight: 700; color: #0f172a; font-size: .9rem; line-height: 1.35; }
    .chip-lama {
        display: inline-block; padding: 4px 10px; border-radius: 7px;
        font-weight: 700; font-size: .78rem; background: #ecfdf5; color: #047857;
        white-space: nowrap;
    }
    .doc-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 11px; font-size: .7rem; font-weight: 700; letter-spacing: .03em;
        border-radius: 7px; background-color: #059669; color: #fff !important;
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
        $koleksiData = collect($data_pks ?? []);
        $listTahunCetak = ($daftar_tahun ?? $koleksiData->pluck('tahun')->filter()->unique()->sortDesc()->values());
        $grandTotalPks = $koleksiData->count();
    @endphp

    <!-- HEADER KONTEN & TOMBOL AKSI -->
    <div class="page-toolbar">
        <div class="page-head">
            <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
            <p>Kelola data Perjanjian Kerjasama (PKS) perusahaan dengan Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>
        </div>

        <div class="toolbar-actions">
            @hasanyrole('Pencegahan|Super User')
            <a href="{{ route('pks.create') }}" class="btn-tool navy">
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
                    <a href="{{ route('pks.excel') }}" class="export-item">
                        <span>Semua Data (Rekap)</span>
                        <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                    </a>
                    @if($listTahunCetak->isNotEmpty())
                        <div class="export-divider"></div>
                        <div class="export-menu-label">Cetak Per Tahun</div>
                        @foreach($listTahunCetak as $thn)
                            <a href="{{ route('pks.excel', ['tahun' => $thn]) }}" class="export-item">
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
                    <a href="{{ route('pks.cetak') }}" target="_blank" class="export-item">
                        <span>Semua Data (Rekap)</span>
                        <i class="fas fa-layer-group text-muted" style="font-size:.75rem;"></i>
                    </a>
                    @if($listTahunCetak->isNotEmpty())
                        <div class="export-divider"></div>
                        <div class="export-menu-label">Cetak Per Tahun</div>
                        @foreach($listTahunCetak as $thn)
                            <a href="{{ route('pks.cetak', ['tahun' => $thn]) }}" target="_blank" class="export-item">
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
            <input type="text" id="searchPks" placeholder="Cari nama perusahaan, nomor PKS, pihak pertama / kedua..." aria-label="Cari data PKS">
        </div>

        <select id="filterPerusahaan" class="filter-select" aria-label="Filter Perusahaan">
            <option value="">Semua Perusahaan</option>
            @foreach(($daftar_perusahaan ?? $koleksiData->pluck('nama_perusahaan')->filter()->unique()->sort()) as $perusahaan)
                <option value="{{ strtolower($perusahaan) }}">{{ $perusahaan }}</option>
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
            <i class="fas fa-handshake"></i>
            <div>
                <h4 id="judulSummary">PERJANJIAN KERJASAMA PERUSAHAAN DENGAN DINAS DAMKARTAN KOTA JAMBI</h4>
                <p id="subJudulSummary">Akumulasi dokumen perjanjian kerjasama (PKS) yang terdaftar</p>
            </div>
        </div>
        <div class="summary-metrics">
            <div class="summary-metric-box highlight">
                <span>Total Perusahaan Kerjasama</span>
                <strong id="grandTotalPks">{{ number_format($grandTotalPks, 0, ',', '.') }} Perusahaan</strong>
            </div>
        </div>
    </div>

    <!-- JUDUL SECTION -->
    <div class="section-heading">
        <span class="section-heading-ico"><i class="fas fa-file-contract"></i></span>
        <h3>Data Perjanjian Kerjasama (PKS)</h3>
        <span class="line"></span>
        <span class="count-pill"><i class="fas fa-building"></i> <span id="pillCountPks">{{ $grandTotalPks }}</span> Dokumen</span>
    </div>

    <!-- TABEL DATA 8 KOLOM SESUAI FORMAT FOTO -->
    <div class="table-scroll-wrapper">
        <table class="table-detailed">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">No.</th>
                    <th>Nama Perusahaan</th>
                    <th>Nomor PKS</th>
                    <th class="text-center">Tanggal Perjanjian</th>
                    <th class="text-center">Lama Kerjasama</th>
                    <th>Pihak Pertama</th>
                    <th>Pihak Kedua</th>
                    <th class="text-center">Dokumen PKS</th>
                    @hasanyrole('Pencegahan|Super User')
                    <th class="text-center" style="width: 90px;">Aksi</th>
                    @endhasanyrole
                </tr>
            </thead>
            <tbody id="tableBodyPks">
                @forelse($koleksiData as $index => $item)
                <tr class="baris-data"
                    data-tahun="{{ $item->tahun ?? '' }}"
                    data-perusahaan="{{ strtolower($item->nama_perusahaan ?? '') }}"
                    data-pencarian="{{ strtolower(($item->nama_perusahaan ?? '') . ' ' . ($item->nomor_pks ?? '') . ' ' . ($item->pihak_pertama ?? '') . ' ' . ($item->pihak_kedua ?? '') . ' ' . ($item->lama_kerjasama ?? '')) }}">

                    <td class="text-center"><span class="no-badge nomor-urut">{{ $index + 1 }}</span></td>
                    <td><div class="perusahaan-title">{{ $item->nama_perusahaan ?? '-' }}</div></td>
                    <td><code>{{ $item->nomor_pks ?? '-' }}</code></td>
                    <td class="text-center">
                        {{ !empty($item->tanggal_perjanjian) ? \Carbon\Carbon::parse($item->tanggal_perjanjian)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td class="text-center">
                        @if(!empty($item->lama_kerjasama))
                            <span class="chip-lama">{{ $item->lama_kerjasama }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->pihak_pertama ?? '-' }}</td>
                    <td>{{ $item->pihak_kedua ?? '-' }}</td>
                    <td class="text-center">
                        @if(!empty($item->file_dokumen))
                            <a href="/uploads/pks/{{ $item->file_dokumen }}" class="doc-badge" target="_blank" title="Lihat Dokumen PKS">
                                <i class="fas fa-file-pdf"></i> Dokumen
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    @hasanyrole('Pencegahan|Super User')
                    <td>
                        <div class="aksi-wrap">
                            <a href="{{ route('pks.edit', $item->id) }}" class="btn-action btn-edit" title="Edit Data PKS">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pks.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data PKS ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Data PKS">
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
                        Belum ada data Perjanjian Kerjasama (PKS).
                    </td>
                </tr>
                @endforelse

                <tr id="emptyFilterRow" style="display: none;">
                    <td colspan="{{ $canCrud ? 9 : 8 }}" class="empty-state">
                        <i class="fas fa-magnifying-glass" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
                        Data PKS yang Anda cari tidak ditemukan.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script>
    function toggleExportMenu(btn, e) {
        e.stopPropagation();
        const parent = btn.closest('.export-dropdown');
        document.querySelectorAll('.export-dropdown.open').forEach(d => {
            if (d !== parent) d.classList.remove('open');
        });
        parent.classList.toggle('open');
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.export-dropdown')) {
            document.querySelectorAll('.export-dropdown.open').forEach(d => d.classList.remove('open'));
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const inputSearch = document.getElementById('searchPks');
        const filterPerusahaan = document.getElementById('filterPerusahaan');
        const filterTahun = document.getElementById('filterTahun');
        const btnReset = document.getElementById('btnResetFilter');
        const rows = document.querySelectorAll('.table-detailed tbody tr.baris-data');
        const emptyRow = document.getElementById('emptyFilterRow');
        const pillCount = document.getElementById('pillCountPks');
        const grandTotalBox = document.getElementById('grandTotalPks');
        const judulSummary = document.getElementById('judulSummary');

        function filterData() {
            const keyword = (inputSearch?.value || '').toLowerCase().trim();
            const selectedPerusahaan = (filterPerusahaan?.value || '').toLowerCase().trim();
            const selectedTahun = (filterTahun?.value || '').trim();

            let visibleCount = 0;

            rows.forEach(row => {
                const rowTahun = (row.getAttribute('data-tahun') || '').trim();
                const rowPerusahaan = (row.getAttribute('data-perusahaan') || '').trim();
                const rowSearch = (row.getAttribute('data-pencarian') || '').trim();

                const matchKeyword = !keyword || rowSearch.includes(keyword);
                const matchPerusahaan = !selectedPerusahaan || rowPerusahaan === selectedPerusahaan;
                const matchTahun = !selectedTahun || rowTahun === selectedTahun;

                if (matchKeyword && matchPerusahaan && matchTahun) {
                    row.style.display = '';
                    visibleCount++;
                    const nomorEl = row.querySelector('.nomor-urut');
                    if (nomorEl) nomorEl.textContent = visibleCount;
                } else {
                    row.style.display = 'none';
                }
            });

            if (emptyRow) {
                emptyRow.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
            }

            if (pillCount) pillCount.textContent = visibleCount;
            if (grandTotalBox) grandTotalBox.textContent = visibleCount.toLocaleString('id-ID') + ' Perusahaan';

            if (judulSummary) {
                judulSummary.textContent = selectedTahun
                    ? 'PERJANJIAN KERJASAMA (TAHUN ' + selectedTahun + ')'
                    : 'PERJANJIAN KERJASAMA PERUSAHAAN DENGAN DINAS DAMKARTAN KOTA JAMBI';
            }
        }

        if (inputSearch) inputSearch.addEventListener('input', filterData);
        if (filterPerusahaan) filterPerusahaan.addEventListener('change', filterData);
        if (filterTahun) filterTahun.addEventListener('change', filterData);

        if (btnReset) {
            btnReset.addEventListener('click', function() {
                if (inputSearch) inputSearch.value = '';
                if (filterPerusahaan) filterPerusahaan.value = '';
                if (filterTahun) filterTahun.value = '';
                filterData();
            });
        }
    });
</script>
@endpush
