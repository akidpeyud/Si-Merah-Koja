@extends('layouts.dashboard')

@section('title', 'Kunjungan Sekolah ke Dinas Pemadam Kebakaran')

@push('styles')
<style>
    /* CSS Persis Fire Drill */
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-weight: 800; letter-spacing: -0.02em; color: #0f172a; margin-bottom: 6px; }
    .page-head p { color: #64748b; font-size: .92rem; margin-bottom: 0; }
    .page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 10px; }
    .toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }
    .btn-tool {
        display: inline-flex; align-items: center; gap: 8px; height: 42px; padding: 0 18px; 
        border-radius: 10px; font-weight: 700; font-size: .84rem; color: #fff; border: none;
        transition: all .2s ease; text-decoration: none; cursor: pointer; box-shadow: 0 2px 6px rgba(15, 23, 42, .08);
    }
    .btn-tool:hover { transform: translateY(-1px); filter: brightness(1.06); box-shadow: 0 4px 12px rgba(15, 23, 42, .14); color: #fff; }
    .btn-tool.navy { background: #163a63; }
    .btn-tool.green { background: #15803d; }
    .btn-tool.red { background: #dc2626; }

    .export-dropdown { position: relative; display: inline-block; }
    .export-menu {
        position: absolute; right: 0; top: calc(100% + 6px); z-index: 1050;
        background: #ffffff; min-width: 220px; border-radius: 12px;
        border: 1px solid #e2e8f0; padding: 6px; box-shadow: 0 10px 25px rgba(15, 23, 42, .14); display: none;
    }
    .export-dropdown.open .export-menu { display: block; }
    .export-menu-label { font-size: .68rem; font-weight: 700; text-transform: uppercase; color: #94a3b8; padding: 6px 12px 4px; }
    .export-item { display: flex; align-items: center; justify-content: space-between; padding: 8px 12px; border-radius: 8px; font-size: .83rem; font-weight: 600; color: #1e293b; text-decoration: none; }
    .export-item:hover { background: #f1f5f9; color: #0f172a; }
    .export-divider { height: 1px; background: #f1f5f9; margin: 4px 0; }

    .custom-nav-tabs { display: flex; gap: 8px; overflow-x: auto; margin-top: 18px; border-bottom: 1px solid #e2e8f0; padding-bottom: 0; }
    .custom-nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; color: #64748b; font-weight: 700; font-size: .8rem; padding: 12px 18px; background: transparent; white-space: nowrap; }
    .custom-nav-tabs .nav-link:hover { color: #0f172a; background: rgba(22, 58, 99, .04); }
    .custom-nav-tabs .nav-link.active { color: #163a63; border-bottom-color: #163a63; }

    .filter-bar { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; background: #ffffff; padding: 14px 18px; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(15, 23, 42, .03); margin: 22px 0 18px; }
    .search-box { position: relative; flex: 1 1 300px; }
    .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    .search-box input { width: 100%; height: 42px; padding: 0 16px 0 40px; border: 1px solid #cbd5e1; border-radius: 10px; background: #f8fafc; font-size: .86rem; }
    .filter-select { height: 42px; padding: 0 36px 0 14px; border: 1px solid #cbd5e1; border-radius: 10px; background-color: #f8fafc; font-size: .85rem; font-weight: 600; min-width: 175px; cursor: pointer; }

    .summary-strip { display: flex; flex-wrap: wrap; gap: 14px; align-items: center; justify-content: space-between; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: #fff; padding: 16px 22px; border-radius: 14px; margin-bottom: 24px; }
    .summary-strip-title { display: flex; align-items: center; gap: 12px; }
    .summary-strip-title i { width: 42px; height: 42px; border-radius: 10px; background: rgba(255,255,255,.12); color: #38bdf8; display: grid; place-items: center; font-size: 1.1rem; }
    .summary-strip-title h4 { margin: 0; font-size: .96rem; font-weight: 800; }
    .summary-strip-title p { margin: 2px 0 0; font-size: .78rem; color: rgba(255,255,255,.75); }
    .summary-metrics { display: flex; flex-wrap: wrap; gap: 12px; }
    .summary-metric-box { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15); padding: 8px 16px; border-radius: 10px; text-align: center; }
    .summary-metric-box span { display: block; font-size: .68rem; text-transform: uppercase; font-weight: 600; color: rgba(255,255,255,.75); }
    .summary-metric-box strong { font-size: 1.1rem; font-weight: 800; }
    .summary-metric-box.highlight { background: #f59e0b; border-color: #fbbf24; }
    .summary-metric-box.highlight span { color: #451a03; }
    .summary-metric-box.highlight strong { color: #0f172a; }

    .year-block { margin-bottom: 34px; }
    .year-block-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
    .year-block-title { display: flex; align-items: center; gap: 10px; }
    .year-badge-icon { width: 34px; height: 34px; border-radius: 9px; background: #163a63; color: #fff; display: grid; place-items: center; }
    .year-block-title h3 { margin: 0; font-size: 1.08rem; font-weight: 800; color: #0f172a; }

    .table-scroll-wrapper { width: 100%; overflow-x: auto; background: #fff; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(15, 23, 42, .04); }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 950px; }
    .table-detailed thead { background: #0f172a; color: #fff; }
    .table-detailed th { font-size: .72rem; font-weight: 700; padding: 15px 16px; white-space: nowrap; text-transform: uppercase; letter-spacing: .06em; border-right: 1px solid rgba(255, 255, 255, .08); vertical-align: middle; }
    .table-detailed td { font-size: .86rem; padding: 16px; border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f8fafc; }
    .table-detailed th.th-group { border-bottom: 1px solid rgba(255, 255, 255, .12); }
    .table-detailed th.th-sub { background: rgba(255, 255, 255, .06); }
    .table-detailed tfoot tr td { background: #f1f5f9; border-top: 2px solid #cbd5e1; padding: 14px 16px; font-weight: 800; font-size: .88rem; color: #0f172a; }
    
    .aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 8px; }
    .aksi-wrap form { margin: 0; display: inline-flex; }
    .btn-action { width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center; border-radius: 8px; font-size: .8rem; color: #fff; border: none; cursor: pointer; transition: transform .1s; text-decoration: none; }
    .btn-action:hover { transform: scale(1.06); filter: brightness(1.06); color: #fff; }
    .btn-edit { background: #f59e0b; color: #0f172a; }
    .btn-delete { background: #ef4444; }
</style>
@endpush

@section('content')
    @php
        $grandSekolah = $koleksiData->count();
        $grandTotal = $koleksiData->sum('total_kunjungan');
    @endphp

    <div class="page-toolbar">
        <div class="page-head">
            <h1>Pemberdayaan Masyarakat</h1>
            <p>Kelola data kunjungan sekolah ke Dinas Pemadam Kebakaran.</p>
        </div>
        <div class="toolbar-actions">
            @hasanyrole('Pencegahan|Super User')
            <a href="{{ route('kunjungan_sekolah.create') }}" class="btn-tool navy"><i class="fas fa-plus"></i> Tambah Data</a>
            @endhasanyrole

            <div class="export-dropdown">
                <button type="button" class="btn-tool green" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-excel"></i> Excel <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format Excel</div>
                    <a href="{{ route('kunjungan_sekolah.excel') }}" class="export-item"><span>Semua Data</span></a>
                    <div class="export-divider"></div>
                    <div class="export-menu-label">Cetak Per Tahun</div>
                    @foreach($daftar_tahun as $thn)
                        <a href="{{ route('kunjungan_sekolah.excel', ['tahun' => $thn]) }}" class="export-item"><span>Tahun {{ $thn }}</span></a>
                    @endforeach
                </div>
            </div>

            <div class="export-dropdown">
                <button type="button" class="btn-tool red" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-pdf"></i> PDF <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format PDF</div>
                    <a href="{{ route('kunjungan_sekolah.cetak') }}" target="_blank" class="export-item"><span>Semua Data</span></a>
                    <div class="export-divider"></div>
                    <div class="export-menu-label">Cetak Per Tahun</div>
                    @foreach($daftar_tahun as $thn)
                        <a href="{{ route('kunjungan_sekolah.cetak', ['tahun' => $thn]) }}" target="_blank" class="export-item"><span>Tahun {{ $thn }}</span></a>
                    @endforeach
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
        <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/pemberdayaan-masyarakat/kunjungan-sekolah*') ? 'active' : '' }}" href="/internal/pencegahan/pemberdayaan-masyarakat/kunjungan-sekolah">KUNJUNGAN SEKOLAH</a>
            </li>
    </ul>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama sekolah atau tanggal...">
        </div>
        <select id="filterTahun" class="filter-select">
            <option value="">Semua Tahun</option>
            @foreach($daftar_tahun as $thn)
                <option value="{{ $thn }}">Tahun {{ $thn }}</option>
            @endforeach
        </select>
    </div>

    @if($koleksiData->isNotEmpty())
    <div class="summary-strip">
        <div class="summary-strip-title">
            <i class="fas fa-school"></i>
            <div>
                <h4>REKAPITULASI KUNJUNGAN SEKOLAH</h4>
                <p>Akumulasi jumlah sekolah dan peserta</p>
            </div>
        </div>
        <div class="summary-metrics">
            <div class="summary-metric-box">
                <span>Total Sekolah</span>
                <strong>{{ $grandSekolah }}</strong>
            </div>
            <div class="summary-metric-box highlight">
                <span>Jumlah Total Peserta</span>
                <strong>{{ number_format($grandTotal, 0, ',', '.') }} Orang</strong>
            </div>
        </div>
    </div>
    @endif

    <div id="wadahSemuaTahun">
        @forelse($groupedByYear as $tahun => $items)
            @php $sumTotalTahun = $items->sum('total_kunjungan'); @endphp

            <div class="year-block" data-year-block="{{ $tahun }}">
                <div class="year-block-header">
                    <div class="year-block-title">
                        <span class="year-badge-icon"><i class="fas fa-calendar-alt"></i></span>
                        <h3>DATA KUNJUNGAN TAHUN {{ $tahun }}</h3>
                    </div>
                </div>

                <div class="table-scroll-wrapper">
                    <table class="table-detailed">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center" width="5%">No</th>
                                <th rowspan="2" width="25%">Nama Sekolah</th>
                                <th rowspan="2" width="15%">Tanggal</th>
                                <th colspan="4" class="th-group text-center">Banyak Kunjungan</th>
                                <th rowspan="2" class="text-center" width="10%">Total</th>
                                @hasanyrole('Pencegahan|Super User')
                                <th rowspan="2" class="text-center" width="10%">Aksi</th>
                                @endhasanyrole
                            </tr>
                            <tr>
                                <th class="th-sub text-center" width="9%">Siswa Pr</th>
                                <th class="th-sub text-center" width="9%">Siswa Lk</th>
                                <th class="th-sub text-center" width="9%">Guru</th>
                                <th class="th-sub text-center" width="9%">Ortu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $item)
                            <tr class="baris-data" data-pencarian="{{ strtolower($item->nama_sekolah . ' ' . $item->tanggal_kunjungan) }}">
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $item->nama_sekolah }}</td>
                                <td>{{ $item->tanggal_kunjungan }}</td>
                                <td class="text-center">{{ $item->siswa_perempuan }}</td>
                                <td class="text-center">{{ $item->siswa_laki_laki }}</td>
                                <td class="text-center">{{ $item->guru }}</td>
                                <td class="text-center">{{ $item->orang_tua }}</td>
                                <td class="text-center fw-bold text-primary">{{ $item->total_kunjungan }}</td>
                                @hasanyrole('Pencegahan|Super User')
                                <td class="text-center">
                                    <div class="aksi-wrap">
                                        <a href="{{ route('kunjungan_sekolah.edit', $item->id) }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('kunjungan_sekolah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                                @endhasanyrole
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-end text-uppercase pe-4">Jumlah Total Tahun {{ $tahun }}</td>
                                <td class="text-center fw-bold">{{ number_format($sumTotalTahun, 0, ',', '.') }}</td>
                                @hasanyrole('Pencegahan|Super User')<td></td>@endhasanyrole
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted bg-white rounded border">
                <i class="fas fa-folder-open mb-2" style="font-size: 28px;"></i><br>Belum ada data kunjungan sekolah.
            </div>
        @endforelse
    </div>

<script>
    function toggleExportMenu(btn, event) {
        event.stopPropagation();
        var parent = btn.closest('.export-dropdown');
        var isOpen = parent.classList.contains('open');
        document.querySelectorAll('.export-dropdown.open').forEach(el => el.classList.remove('open'));
        if (!isOpen) parent.classList.add('open');
    }
    document.addEventListener('click', () => document.querySelectorAll('.export-dropdown.open').forEach(el => el.classList.remove('open')));

    // Pencarian Filter
    document.getElementById('searchInput').addEventListener('input', filterData);
    document.getElementById('filterTahun').addEventListener('change', filterData);

    function filterData() {
        let q = document.getElementById('searchInput').value.toLowerCase();
        let thn = document.getElementById('filterTahun').value;

        document.querySelectorAll('.year-block').forEach(block => {
            let tahunBlok = block.getAttribute('data-year-block');
            if (thn && tahunBlok !== thn) { block.style.display = 'none'; return; }

            let barisTampil = 0;
            block.querySelectorAll('tbody tr.baris-data').forEach(tr => {
                let text = tr.getAttribute('data-pencarian');
                if (text.includes(q)) { tr.style.display = ''; barisTampil++; } 
                else { tr.style.display = 'none'; }
            });
            block.style.display = barisTampil > 0 ? '' : 'none';
        });
    }
</script>
@endsection