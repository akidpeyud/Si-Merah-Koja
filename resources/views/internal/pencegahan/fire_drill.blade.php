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

    /* Filter Bar Modern */
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

    /* Tabel Utama */
    .table-scroll-wrapper {
        width: 100%; overflow-x: auto; background: #fff;
        border-radius: 14px; border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04); margin-bottom: 40px;
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: #f8fafc; }

    .table-detailed { width: 100%; border-collapse: collapse; min-width: 1020px; margin-bottom: 0; }
    .table-detailed thead { background: #0f172a; color: #fff; }
    .table-detailed th {
        font-size: .72rem; font-weight: 700; padding: 15px 16px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .06em; vertical-align: middle;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }
    .table-detailed th:last-child { border-right: none; }
    .table-detailed th.th-group { border-bottom: 1px solid rgba(255, 255, 255, .12); }
    .table-detailed th.th-sub { background: rgba(255, 255, 255, .06); }

    .table-detailed td {
        font-size: .86rem; padding: 16px; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f8fafc;
        color: #334155;
    }
    .table-detailed tbody tr { transition: background .15s ease; }
    .table-detailed tbody tr:hover { background: #f8fafc; }
    .table-detailed tbody tr:last-child td { border-bottom: none; }

    /* Komponen Sel Tabel */
    .instansi-title { font-weight: 700; color: #0f172a; font-size: .92rem; line-height: 1.35; }
    .badge-tahun {
        display: inline-flex; align-items: center; gap: 5px;
        margin-top: 6px; padding: 3px 10px; border-radius: 6px;
        background: #eff6ff; color: #1d4ed8; font-weight: 700; font-size: .7rem;
        border: 1px solid #dbeafe;
    }
    .chip-peserta {
        display: inline-block; padding: 4px 10px; border-radius: 8px;
        font-weight: 600; font-size: .8rem; background: #f1f5f9; color: #334155;
        white-space: nowrap;
    }
    .total-wrap {
        display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px;
    }
    .total-number {
        font-weight: 800; font-size: .92rem; color: #0f172a; white-space: nowrap;
    }

    /* Tombol Lihat Peserta (Satu Baris Rapi) */
    .btn-peserta {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 5px 12px; border-radius: 20px; font-size: .74rem; font-weight: 700;
        border: 1px solid #bfdbfe; background: #eff6ff; color: #1e40af;
        cursor: pointer; transition: all .2s ease; white-space: nowrap;
    }
    .btn-peserta:hover {
        background: #1e40af; color: #ffffff; border-color: #1e40af;
        box-shadow: 0 3px 8px rgba(30, 64, 175, .2);
    }

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
    .empty-state { text-align: center; padding: 54px 16px !important; color: #64748b; font-weight: 600; }

    /* Modal Daftar Peserta Modern */
    .modal-peserta-backdrop {
        position: fixed; inset: 0; background: rgba(15, 23, 42, .6);
        backdrop-filter: blur(3px);
        z-index: 2000; display: none; place-items: center; padding: 16px;
    }
    .modal-peserta-backdrop.show { display: grid; }
    .modal-peserta-card {
        background: #fff; width: 100%; max-width: 720px; border-radius: 16px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25); overflow: hidden;
        animation: modalFadeIn .2s ease-out;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(10px) scale(.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .modal-peserta-header {
        background: #0f172a; color: #fff; padding: 18px 24px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .modal-peserta-header h4 { margin: 0; font-size: 1.02rem; font-weight: 700; }
    .btn-close-modal {
        width: 32px; height: 32px; border-radius: 8px; border: none;
        background: rgba(255,255,255,.1); color: #fff; font-size: 1.1rem;
        display: inline-flex; align-items: center; justify-content: center; cursor: pointer;
        transition: background .2s;
    }
    .btn-close-modal:hover { background: rgba(255,255,255,.2); }
    .modal-peserta-body {
        padding: 22px 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 18px;
        max-height: 70vh; overflow-y: auto; background: #f8fafc;
    }
    .peserta-col {
        background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px;
    }
    .peserta-col h5 {
        font-size: .86rem; font-weight: 700; margin: 0 0 12px; padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;
    }
    .peserta-list {
        margin: 0; padding-left: 20px; font-size: .85rem; line-height: 1.8; color: #1e293b;
    }
    .peserta-list li { padding-left: 4px; border-bottom: 1px dashed #f1f5f9; }
    .peserta-list li:last-child { border-bottom: none; }

    @media (max-width: 700px) {
        .search-box { width: 100%; }
        .filter-select { flex: 1 1 auto; }
        .toolbar-actions { width: 100%; }
        .modal-peserta-body { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    @php
        $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);
        $listTahunCetak = ($daftar_tahun ?? collect($data_fire_drill ?? [])->pluck('tahun')->unique()->sortDesc());
    @endphp

    <!-- HEADER KONTEN & TOMBOL AKSI -->
    <div class="page-toolbar">
        <div class="page-head">
            <h1>Pencegahan Kebakaran &amp; Inspeksi</h1>
            <p>Kelola data instansi pemerintah / swasta yang melaksanakan pelatihan pemadam kebakaran (Fire Drill).</p>
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
                    <div class="export-divider"></div>
                    <div class="export-menu-label">Cetak Per Tahun</div>
                    @foreach($listTahunCetak as $thn)
                        <a href="{{ route('fire_drill.excel', ['tahun' => $thn]) }}" class="export-item">
                            <span>Tahun {{ $thn }}</span>
                            <i class="fas fa-download text-muted" style="font-size:.72rem;"></i>
                        </a>
                    @endforeach
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
                    <div class="export-divider"></div>
                    <div class="export-menu-label">Cetak Per Tahun</div>
                    @foreach($listTahunCetak as $thn)
                        <a href="{{ route('fire_drill.cetak', ['tahun' => $thn]) }}" target="_blank" class="export-item">
                            <span>Tahun {{ $thn }}</span>
                            <i class="fas fa-print text-muted" style="font-size:.72rem;"></i>
                        </a>
                    @endforeach
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
    </ul>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchFireDrill" placeholder="Cari nama instansi, tempat pelaksanaan, atau nama peserta..." aria-label="Cari data fire drill">
        </div>

        <select id="filterInstansi" class="filter-select" aria-label="Filter Instansi">
            <option value="">Semua Instansi</option>
            @foreach(($daftar_instansi ?? collect($data_fire_drill ?? [])->pluck('nama_instansi')->unique()->sort()) as $instansi)
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

    <!-- TABEL DATA FIRE DRILL -->
    <div class="table-scroll-wrapper">
        <table class="table-detailed" id="tabelFireDrill">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" width="60px">No</th>
                    <th rowspan="2" width="26%">Nama Instansi</th>
                    <th rowspan="2" width="18%">Tanggal Pelaksanaan</th>
                    <th rowspan="2" width="22%">Tempat Pelaksanaan</th>
                    <th colspan="3" class="text-center th-group">Jumlah &amp; Daftar Peserta</th>
                    @hasanyrole('Pencegahan|Super User')
                    <th rowspan="2" class="text-center" width="105px">Aksi</th>
                    @endhasanyrole
                </tr>
                <tr>
                    <th class="text-center" width="110px">Laki-laki</th>
                    <th class="text-center" width="110px">Perempuan</th>
                    <th class="text-center th-sub" width="145px">Total Peserta</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($data_fire_drill ?? []) as $index => $item)
                @php
                    $listLaki = !empty($item->nama_peserta_laki_laki) ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_laki_laki)))) : [];
                    $listPerempuan = !empty($item->nama_peserta_perempuan) ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_perempuan)))) : [];
                    $punyaDetailGender = ($item->peserta_laki_laki > 0 || $item->peserta_perempuan > 0 || count($listLaki) > 0 || count($listPerempuan) > 0);
                    $gabunganNamaPeserta = strtolower(($item->nama_peserta_laki_laki ?? '') . ' ' . ($item->nama_peserta_perempuan ?? ''));
                @endphp
                <tr class="baris-data"
                    data-tahun="{{ $item->tahun }}"
                    data-instansi="{{ strtolower($item->nama_instansi) }}"
                    data-pencarian="{{ strtolower($item->nama_instansi . ' ' . $item->tempat_pelaksanaan . ' ' . $item->tanggal_pelaksanaan . ' ' . $item->tahun . ' ' . $gabunganNamaPeserta) }}">
                    
                    <td class="text-center fw-bold nomor-urut">{{ $index + 1 }}</td>
                    <td>
                        <div class="instansi-title">{{ $item->nama_instansi }}</div>
                        <span class="badge-tahun"><i class="far fa-calendar-alt"></i> Tahun {{ $item->tahun }}</span>
                    </td>
                    <td>{{ $item->tanggal_pelaksanaan }}</td>
                    <td>{{ $item->tempat_pelaksanaan }}</td>

                    <td class="text-center">
                        @if($punyaDetailGender)
                            <span class="chip-peserta">{{ $item->peserta_laki_laki ?? 0 }} Orang</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($punyaDetailGender)
                            <span class="chip-peserta">{{ $item->peserta_perempuan ?? 0 }} Orang</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="total-wrap">
                            <span class="total-number">{{ $item->total_peserta }} Orang</span>
                            @if(count($listLaki) > 0 || count($listPerempuan) > 0)
                                <button type="button" class="btn-peserta"
                                    onclick='bukaModalPeserta(@json($item->nama_instansi), @json($item->tahun), @json($listLaki), @json($listPerempuan))'>
                                    <i class="fas fa-users"></i> Lihat Peserta
                                </button>
                            @endif
                        </div>
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
                <tr>
                    <td colspan="{{ $canCrud ? 8 : 7 }}" class="empty-state">
                        <i class="fas fa-folder-open" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
                        Belum ada data Fire Drill.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODAL POP-UP DAFTAR PESERTA -->
    <div class="modal-peserta-backdrop" id="modalPeserta" onclick="if(event.target === this) tutupModalPeserta()">
        <div class="modal-peserta-card">
            <div class="modal-peserta-header">
                <h4 id="judulModalPeserta">Daftar Peserta Fire Drill</h4>
                <button type="button" class="btn-close-modal" onclick="tutupModalPeserta()">&times;</button>
            </div>
            <div class="modal-peserta-body">
                <div class="peserta-col">
                    <h5>
                        <span><i class="fas fa-mars text-primary me-1"></i> Peserta Laki-laki</span>
                        <span id="jmlModalLaki" class="badge-tahun" style="margin-top:0;">0 Orang</span>
                    </h5>
                    <ol class="peserta-list" id="listModalLaki"></ol>
                </div>
                <div class="peserta-col">
                    <h5>
                        <span><i class="fas fa-venus text-danger me-1"></i> Peserta Perempuan</span>
                        <span id="jmlModalPerempuan" class="badge-tahun" style="margin-top:0;">0 Orang</span>
                    </h5>
                    <ol class="peserta-list" id="listModalPerempuan"></ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleExportMenu(btn, event) {
        event.stopPropagation();
        var parent = btn.closest('.export-dropdown');
        var isOpen = parent.classList.contains('open');
        document.querySelectorAll('.export-dropdown.open').forEach(function(el) {
            el.classList.remove('open');
        });
        if (!isOpen) parent.classList.add('open');
    }

    document.addEventListener('click', function() {
        document.querySelectorAll('.export-dropdown.open').forEach(function(el) {
            el.classList.remove('open');
        });
    });

    function bukaModalPeserta(instansi, tahun, listLaki, listPerempuan) {
        document.getElementById('judulModalPeserta').textContent = instansi + ' — Tahun ' + tahun;
        document.getElementById('jmlModalLaki').textContent = listLaki.length + ' Orang';
        document.getElementById('jmlModalPerempuan').textContent = listPerempuan.length + ' Orang';

        var ulLaki = document.getElementById('listModalLaki');
        var ulPerempuan = document.getElementById('listModalPerempuan');
        ulLaki.innerHTML = '';
        ulPerempuan.innerHTML = '';

        if (listLaki.length === 0) {
            ulLaki.innerHTML = '<li style="list-style:none;color:#94a3b8;margin-left:-20px;">Tidak ada daftar nama peserta laki-laki.</li>';
        } else {
            listLaki.forEach(function(nama) {
                var li = document.createElement('li');
                li.textContent = nama;
                ulLaki.appendChild(li);
            });
        }

        if (listPerempuan.length === 0) {
            ulPerempuan.innerHTML = '<li style="list-style:none;color:#94a3b8;margin-left:-20px;">Tidak ada daftar nama peserta perempuan.</li>';
        } else {
            listPerempuan.forEach(function(nama) {
                var li = document.createElement('li');
                li.textContent = nama;
                ulPerempuan.appendChild(li);
            });
        }

        document.getElementById('modalPeserta').classList.add('show');
    }

    function tutupModalPeserta() {
        document.getElementById('modalPeserta').classList.remove('show');
    }

    (function () {
        'use strict';

        var searchInput = document.getElementById('searchFireDrill');
        var filterInstansi = document.getElementById('filterInstansi');
        var filterTahun = document.getElementById('filterTahun');
        var btnReset = document.getElementById('btnResetFilter');
        var rows = document.querySelectorAll('#tabelFireDrill tbody tr.baris-data');

        function jalankanFilter() {
            var q = (searchInput ? searchInput.value.trim().toLowerCase() : '');
            var inst = (filterInstansi ? filterInstansi.value : '');
            var thn = (filterTahun ? filterTahun.value : '');
            var nomor = 1;

            rows.forEach(function (tr) {
                var cocokCari = !q || tr.getAttribute('data-pencarian').indexOf(q) > -1;
                var cocokInst = !inst || tr.getAttribute('data-instansi') === inst;
                var cocokThn = !thn || tr.getAttribute('data-tahun') === thn;

                if (cocokCari && cocokInst && cocokThn) {
                    tr.style.display = '';
                    var selNomor = tr.querySelector('.nomor-urut');
                    if (selNomor) selNomor.textContent = nomor++;
                } else {
                    tr.style.display = 'none';
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', jalankanFilter);
        if (filterInstansi) filterInstansi.addEventListener('change', jalankanFilter);
        if (filterTahun) filterTahun.addEventListener('change', jalankanFilter);
        if (btnReset) {
            btnReset.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (filterInstansi) filterInstansi.value = '';
                if (filterTahun) filterTahun.value = '';
                jalankanFilter();
            });
        }
    })();
</script>
@endpush