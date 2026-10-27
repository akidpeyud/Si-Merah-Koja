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
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-weight: 800; letter-spacing: -0.02em; color: var(--ink, #0f172a); margin-bottom: 6px; }
    .page-head p { color: var(--steel, #64748b); font-size: .92rem; margin-bottom: 0; }
    .page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 10px; }
    .page-toolbar .page-head { margin-bottom: 0; }
    .toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }

    /* Tombol Aksi */
    .btn-tool {
        display: inline-flex; align-items: center; gap: 8px;
        height: 42px; padding: 0 18px; border-radius: 10px;
        font-weight: 700; font-size: .84rem; color: #fff; border: none;
        transition: all .2s ease; text-decoration: none; cursor: pointer;
        box-shadow: 0 2px 6px rgba(15, 23, 42, .08);
    }
    .btn-tool:hover { color: #fff; transform: translateY(-1px); filter: brightness(1.06); box-shadow: 0 4px 12px rgba(15, 23, 42, .14); }
    .btn-tool.navy { background: var(--navy, #163a63); }
    .btn-tool.green { background: var(--success, #15803d); }
    .btn-tool.red { background: var(--signal, #dc2626); }

    /* Dropdown Export */
    .export-dropdown { position: relative; display: inline-block; }
    .export-menu {
        position: absolute; right: 0; top: calc(100% + 6px); z-index: 1050;
        background: #ffffff; min-width: 220px; border-radius: 12px;
        border: 1px solid #e2e8f0; padding: 6px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, .14);
        display: none;
    }
    .export-dropdown.open .export-menu { display: block; animation: fadeInMenu .15s ease-out; }
    @keyframes fadeInMenu { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }
    .export-menu-label { font-size: .68rem; font-weight: 700; text-transform: uppercase; color: #94a3b8; padding: 6px 12px 4px; letter-spacing: .05em; }
    .export-item { display: flex; align-items: center; justify-content: space-between; padding: 8px 12px; border-radius: 8px; font-size: .83rem; font-weight: 600; color: #1e293b; text-decoration: none; transition: background .15s; }
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
        background-color: #f8fafc; font-size: .85rem; font-weight: 600; color: #1e293b; min-width: 175px; cursor: pointer;
    }
    .filter-select:focus { outline: none; background-color: #fff; border-color: var(--navy, #163a63); box-shadow: 0 0 0 3px rgba(22, 58, 99, .12); }
    .btn-reset-filter {
        height: 42px; padding: 0 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #ffffff;
        color: #475569; font-size: .84rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;
        cursor: pointer; transition: all .2s ease; white-space: nowrap;
    }
    .btn-reset-filter:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }

    /* Sub Tab Switcher (Luar / Dalam) */
    .sub-tab-container { display: flex; gap: 12px; margin-bottom: 24px; }
    .sub-tab-btn {
        flex: 1; text-align: center; padding: 14px; border-radius: 12px;
        background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569;
        font-size: .9rem; font-weight: 700; cursor: pointer; transition: all .2s ease;
    }
    .sub-tab-btn i { font-size: 1.1rem; margin-right: 6px; }
    .sub-tab-btn:hover { background: #e2e8f0; color: #1e293b; }
    .sub-tab-btn.active { background: #0f172a; color: #fff; border-color: #0f172a; box-shadow: 0 6px 16px rgba(15,23,42,.15); }

    /* Summary Strip */
    .summary-strip {
        display: flex; flex-wrap: wrap; gap: 14px; align-items: center; justify-content: space-between;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: #fff;
        padding: 16px 22px; border-radius: 14px; margin-bottom: 24px; box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .summary-strip.mako-mode { background: linear-gradient(135deg, #164e63 0%, #0369a1 100%); }
    .summary-strip-title { display: flex; align-items: center; gap: 12px; }
    .summary-strip-title i {
        width: 42px; height: 42px; border-radius: 10px; background: rgba(255,255,255,.12); color: #38bdf8;
        display: grid; place-items: center; font-size: 1.1rem;
    }
    .summary-strip.mako-mode .summary-strip-title i { color: #38bdf8; }
    .summary-strip-title h4 { margin: 0; font-size: .96rem; font-weight: 800; letter-spacing: .01em; }
    .summary-strip-title p { margin: 2px 0 0; font-size: .78rem; color: rgba(255,255,255,.75); }
    .summary-metrics { display: flex; flex-wrap: wrap; gap: 8px; }
    .summary-metric-box { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15); padding: 8px 14px; border-radius: 10px; text-align: center; }
    .summary-metric-box span { display: block; font-size: .65rem; text-transform: uppercase; letter-spacing: .05em; color: rgba(255,255,255,.75); font-weight: 600; }
    .summary-metric-box strong { font-size: 1.05rem; font-weight: 800; color: #fff; }
    .summary-metric-box.highlight { background: #f59e0b; border-color: #fbbf24; }
    .summary-metric-box.highlight span { color: #451a03; font-weight: 700; }
    .summary-metric-box.highlight strong { color: #0f172a; }

    /* Year Blocks & Table */
    .year-block { margin-bottom: 34px; }
    .year-block-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 12px; padding: 0 4px; }
    .year-block-title { display: flex; align-items: center; gap: 10px; }
    .year-badge-icon { width: 34px; height: 34px; border-radius: 9px; background: #0f172a; color: #fff; display: grid; place-items: center; font-size: .85rem; box-shadow: 0 4px 10px rgba(15, 23, 42, .18); }
    .mako-mode .year-badge-icon { background: #164e63; }
    .year-block-title h3 { margin: 0; font-size: 1.08rem; font-weight: 800; color: #0f172a; letter-spacing: -.01em; }
    .year-block-pills { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
    .year-stat-pill { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }
    .year-stat-pill.total { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }

    .table-scroll-wrapper { width: 100%; overflow-x: auto; background: #fff; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(15, 23, 42, .04); }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 1250px; margin-bottom: 0; }
    .table-detailed thead { background: #0f172a; color: #fff; }
    .mako-mode .table-detailed thead { background: #164e63; }
    .table-detailed th {
        font-size: .72rem; font-weight: 700; padding: 15px 16px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .06em; vertical-align: middle;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }
    .table-detailed th:last-child { border-right: none; }
    .table-detailed th.th-group { border-bottom: 1px solid rgba(255, 255, 255, .12); }
    .table-detailed th.th-sub { background: rgba(255, 255, 255, .06); }
    .table-detailed td { font-size: .86rem; padding: 16px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f8fafc; color: #334155; }
    .table-detailed tbody tr:hover { background: #f8fafc; }
    .table-detailed tfoot tr.row-jumlah-total td { background: #f1f5f9; border-top: 2px solid #cbd5e1; border-bottom: none; padding: 14px 16px; font-weight: 800; font-size: .88rem; color: #0f172a; }
    .total-label-cell { text-align: right; letter-spacing: .05em; text-transform: uppercase; color: #0f172a; padding-right: 20px !important; }
    .total-val-badge { display: inline-block; padding: 5px 14px; border-radius: 8px; background: #0f172a; color: #ffffff; font-weight: 800; font-size: .88rem; }
    .mako-mode .total-val-badge { background: #164e63; }

    /* Komponen Data */
    .cell-title { font-weight: 700; color: #0f172a; font-size: .92rem; display: block; }
    .cell-subtitle { color: #64748b; font-size: .78rem; display: block; margin-top: 2px; }
    .badge-tahun { display: inline-flex; align-items: center; gap: 5px; margin-top: 6px; padding: 3px 10px; border-radius: 6px; background: #eff6ff; color: #1d4ed8; font-weight: 700; font-size: .7rem; border: 1px solid #dbeafe; }
    .chip-peserta { display: inline-block; padding: 4px 10px; border-radius: 8px; font-weight: 600; font-size: .8rem; background: #f1f5f9; color: #334155; white-space: nowrap; border: 1px solid #e2e8f0; }
    .total-wrap { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px; }
    .total-number { font-weight: 800; font-size: .92rem; color: #0f172a; white-space: nowrap; }
    .btn-peserta { display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: .74rem; font-weight: 700; border: 1px solid #bfdbfe; background: #eff6ff; color: #1e40af; cursor: pointer; transition: all .2s ease; white-space: nowrap; }
    .btn-peserta:hover { background: #1e40af; color: #ffffff; border-color: #1e40af; box-shadow: 0 3px 8px rgba(30, 64, 175, .2); }
    .media-links { display: flex; flex-wrap: wrap; gap: 6px; justify-content: center; }
    .btn-media { display: inline-flex; align-items: center; gap: 6px; color: var(--info, #0ea5e9); font-weight: 600; font-size: .78rem; padding: 5px 10px; border-radius: 8px; background: #f0f9ff; border: 1px solid #bae6fd; transition: all .2s; text-decoration: none; }
    .btn-media:hover { background: #0ea5e9; color: #fff; border-color: #0ea5e9; }
    
    .aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 8px; flex-wrap: wrap; }
    .btn-action { width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center; border-radius: 9px; font-size: .82rem; color: #fff; border: none; cursor: pointer; transition: transform .15s ease, filter .2s ease; text-decoration: none; }
    .btn-action:hover { transform: translateY(-1px); filter: brightness(1.06); box-shadow: 0 3px 8px rgba(0,0,0,.12); }
    .btn-edit { background: #f59e0b; color: #0f172a; }
    .btn-delete { background: #ef4444; color: #fff; }
    
    .empty-state { text-align: center; padding: 54px 16px !important; color: #64748b; font-weight: 600; background: #fff; border-radius: 14px; border: 1px solid #e2e8f0; }

    /* Modal Peserta */
    .modal-peserta-backdrop { position: fixed; inset: 0; background: rgba(15, 23, 42, .6); backdrop-filter: blur(3px); z-index: 2000; display: none; place-items: center; padding: 16px; }
    .modal-peserta-backdrop.show { display: grid; }
    .modal-peserta-card { background: #fff; width: 100%; max-width: 720px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25); overflow: hidden; animation: modalFadeIn .2s ease-out; }
    @keyframes modalFadeIn { from { opacity: 0; transform: translateY(10px) scale(.98); } to { opacity: 1; transform: translateY(0) scale(1); } }
    .modal-peserta-header { background: #0f172a; color: #fff; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center; }
    .modal-peserta-header h4 { margin: 0; font-size: 1.02rem; font-weight: 700; }
    .btn-close-modal { width: 32px; height: 32px; border-radius: 8px; border: none; background: rgba(255,255,255,.1); color: #fff; font-size: 1.1rem; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    .btn-close-modal:hover { background: rgba(255,255,255,.2); }
    .modal-peserta-body { padding: 22px 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 18px; max-height: 70vh; overflow-y: auto; background: #f8fafc; }
    .peserta-col { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; }
    .peserta-col h5 { font-size: .86rem; font-weight: 700; margin: 0 0 12px; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .peserta-list { margin: 0; padding-left: 20px; font-size: .85rem; line-height: 1.8; color: #1e293b; }
    .peserta-list li { padding-left: 4px; border-bottom: 1px dashed #f1f5f9; }
    
    .section-heading { display: flex; align-items: center; gap: 12px; margin: 30px 0 16px; flex-wrap: nowrap; }
    .section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
    .stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 22px; background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, transform .2s ease; position: relative; overflow: hidden; text-decoration: none; }
    .stat-card:hover { box-shadow: var(--shadow-sm); transform: translateY(-3px); }
    .stat-ico { width: 46px; height: 46px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1.05rem; margin-bottom: 18px; background: var(--navy-soft); color: var(--navy); }
    .stat-title { font-size: .74rem; font-weight: 700; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.9rem; color: var(--ink); }

    @media (max-width: 700px) {
        .sub-tab-container { flex-direction: column; }
        .modal-peserta-body { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    @php
        // Cek tab aktif
        $aktif = Request::is('internal/pencegahan/pemberdayaan-masyarakat') ? 'semua' : 'sosialisasi';
        $canCrud = auth()->user()->hasAnyRole(['Pencegahan', 'Super User']);
        
        // Data Sosialisasi
        if ($aktif !== 'semua') {
            $koleksiData = collect($data_sosialisasi ?? [])->map(function($item) {
                $tgl = $item->tanggal_pelaksanaan ?? null;
                $item->tahun_parsed = $tgl ? \Carbon\Carbon::parse($tgl)->format('Y') : ($item->tahun ?? date('Y'));
                
                $parseNama = function ($raw) {
                    if (is_array($raw)) return collect($raw)->map(fn($n) => trim((string) $n))->filter()->values();
                    if (is_string($raw) && str_starts_with(trim($raw), '[')) {
                        $decoded = json_decode($raw, true);
                        if (is_array($decoded)) return collect($decoded)->map(fn($n) => trim((string) $n))->filter()->values();
                    }
                    return collect(preg_split('/[\r\n,;]+/', (string) $raw))->map(fn($n) => trim($n))->filter()->values();
                };

                $item->listNamaL = $parseNama($item->nama_peserta_laki_laki ?? $item->daftar_peserta_laki_laki ?? $item->peserta_laki_nama ?? $item->nama_laki_laki ?? '');
                $item->listNamaP = $parseNama($item->nama_peserta_perempuan ?? $item->daftar_peserta_perempuan ?? $item->peserta_perempuan_nama ?? $item->nama_perempuan ?? '');
                
                $item->jml_l = (int) ($item->peserta_laki_laki ?? $item->listNamaL->count());
                $item->jml_p = (int) ($item->peserta_perempuan ?? $item->listNamaP->count());
                $item->jml_g = (int) ($item->guru ?? 0);
                $item->jml_o = (int) ($item->orang_tua ?? 0);
                $item->jml_total = $item->jml_l + $item->jml_p + $item->jml_g + $item->jml_o;

                $item->links_parsed = collect(preg_split('/[\r\n,\s]+/', (string) ($item->link_dokumentasi ?? '')))
                    ->map(fn ($u) => trim($u))->filter(fn ($u) => preg_match('#^https?://#i', $u))->values();

                return $item;
            });

            // PISAHKAN DATA LUAR DAN DALAM
            $koleksiLuar = $koleksiData->filter(fn($i) => strtolower(trim($i->kecamatan)) !== 'mako damkar');
            $koleksiDalam = $koleksiData->filter(fn($i) => strtolower(trim($i->kecamatan)) === 'mako damkar');

            $groupedLuar = $koleksiLuar->sortByDesc('tanggal_pelaksanaan')->groupBy('tahun_parsed');
            $groupedDalam = $koleksiDalam->sortByDesc('tanggal_pelaksanaan')->groupBy('tahun_parsed');
            
            // Daftar kecamatan unik untuk filter (hanya dari koleksi luar)
            $daftar_kecamatan = $koleksiLuar->pluck('kecamatan')->filter()->unique()->sort()->values();
            $listTahunCetak = $koleksiData->pluck('tahun_parsed')->unique()->sortDesc()->values();
        }
    @endphp

    <!-- HEADER & TOOLBAR -->
    <div class="page-toolbar">
        <div class="page-head">
            <h1>Pemberdayaan Masyarakat</h1>
            <p>Kelola data sosialisasi, edukasi, dan pelatihan tanggap kebakaran.</p>
        </div>
        @if($aktif !== 'semua')
        <div class="toolbar-actions">
            @hasanyrole('Pencegahan|Super User')
            <a href="/internal/pencegahan/pemberdayaan-masyarakat/create" class="btn-tool navy"><i class="fas fa-plus"></i> Tambah Data</a>
            @endhasanyrole

            <div class="export-dropdown">
                <button type="button" class="btn-tool green" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-excel"></i> Excel <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format Excel</div>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/cetak-excel" class="export-item"><span>Semua Data (Rekap)</span></a>
                    <div class="export-divider"></div>
                    <div class="export-menu-label">Cetak Per Tahun</div>
                    @foreach($listTahunCetak as $thn)
                        <a href="/internal/pencegahan/pemberdayaan-masyarakat/cetak-excel?tahun={{ $thn }}" class="export-item"><span>Tahun {{ $thn }}</span></a>
                    @endforeach
                </div>
            </div>

            <div class="export-dropdown">
                <button type="button" class="btn-tool red" onclick="toggleExportMenu(this, event)">
                    <i class="fas fa-file-pdf"></i> PDF <i class="fas fa-chevron-down" style="font-size:.7rem;"></i>
                </button>
                <div class="export-menu">
                    <div class="export-menu-label">Pilih Format PDF</div>
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/cetak" target="_blank" class="export-item"><span>Semua Data (Rekap)</span></a>
                    <div class="export-divider"></div>
                    <div class="export-menu-label">Cetak Per Tahun</div>
                    @foreach($listTahunCetak as $thn)
                        <a href="/internal/pencegahan/pemberdayaan-masyarakat/cetak?tahun={{ $thn }}" target="_blank" class="export-item"><span>Tahun {{ $thn }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
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
                <div><div class="stat-title">Pelatihan Keluarga</div><div class="stat-value">{{ $total_pelatihan ?? count($data_pelatihan ?? []) }}</div></div>
            </a>
            <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="stat-card">
                <div class="stat-ico"><i class="fas fa-users"></i></div>
                <div><div class="stat-title">Sosialisasi &amp; Edukasi</div><div class="stat-value">{{ $total_sosialisasi ?? count($data_sosialisasi ?? []) }}</div></div>
            </a>
            
        </div>
    @else

        <!-- SUB TABS: KUNJUNGAN LUAR VS DALAM -->
        <div class="sub-tab-container">
            <div class="sub-tab-btn active" id="btnTabLuar" onclick="switchTab('luar')">
                <i class="fas fa-truck-fast"></i> Kunjungan ke Luar (Penyuluhan ke Lokasi)
            </div>
            <div class="sub-tab-btn" id="btnTabDalam" onclick="switchTab('dalam')">
                <i class="fas fa-building"></i> Wisata Edukasi (Mako Damkar)
            </div>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchSosialisasi" placeholder="Cari kelurahan, instansi, lokasi..." autocomplete="off">
            </div>
            <select id="filterKecamatan" class="filter-select">
                <option value="">Semua Kecamatan</option>
                @foreach($daftar_kecamatan as $kecamatan)
                    <option value="{{ strtolower($kecamatan) }}">{{ $kecamatan }}</option>
                @endforeach
            </select>
            <select id="filterTahun" class="filter-select">
                <option value="">Semua Tahun</option>
                @foreach($listTahunCetak as $thn)
                    <option value="{{ $thn }}">Tahun {{ $thn }}</option>
                @endforeach
            </select>
            <button type="button" id="btnResetFilter" class="btn-reset-filter" onclick="resetFilter()">
                <i class="fas fa-rotate-left"></i> Reset
            </button>
        </div>

        <!-- ============================================== -->
        <!-- WRAPPER 1: KUNJUNGAN LUAR -->
        <!-- ============================================== -->
        <div id="wrapperLuar">
            @if($koleksiLuar->isNotEmpty())
            <div class="summary-strip">
                <div class="summary-strip-title">
                    <i class="fas fa-truck-fast"></i>
                    <div>
                        <h4 id="judulSummaryLuar">REKAP KUNJUNGAN KE LUAR (SEMUA TAHUN)</h4>
                        <p>Akumulasi jumlah kegiatan dan peserta yang ditampilkan</p>
                    </div>
                </div>
                <div class="summary-metrics">
                    <div class="summary-metric-box"><span>Kegiatan</span><strong class="sum-kegiatan">0</strong></div>
                    <div class="summary-metric-box"><span>Laki-laki</span><strong class="sum-laki">0</strong></div>
                    <div class="summary-metric-box"><span>Perempuan</span><strong class="sum-pr">0</strong></div>
                    <div class="summary-metric-box"><span>Guru</span><strong class="sum-guru">0</strong></div>
                    <div class="summary-metric-box"><span>Ortu</span><strong class="sum-ortu">0</strong></div>
                    <div class="summary-metric-box highlight"><span>Total Peserta</span><strong class="sum-total">0 Orang</strong></div>
                </div>
            </div>
            @endif

            <div class="wadah-tahun">
                @forelse($groupedLuar as $tahun => $items)
                    <div class="year-block" data-year-block="{{ $tahun }}">
                        <div class="year-block-header">
                            <div class="year-block-title">
                                <span class="year-badge-icon"><i class="fas fa-calendar-alt"></i></span>
                                <h3>DATA PENYULUHAN TAHUN {{ $tahun }}</h3>
                            </div>
                            <div class="year-block-pills">
                                <span class="year-stat-pill"><i class="fas fa-map-location-dot text-secondary"></i><span class="pill-jml-kegiatan">0</span> Lokasi</span>
                                <span class="year-stat-pill total"><i class="fas fa-users"></i> Total Peserta: <strong class="pill-total-tahun">0 Orang</strong></span>
                            </div>
                        </div>

                        <div class="table-scroll-wrapper">
                            <table class="table-detailed">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" width="5%">NO</th>
                                        <th rowspan="2" width="22%">LOKASI KELURAHAN / RT</th>
                                        <th rowspan="2" width="16%">KECAMATAN</th>
                                        <th rowspan="2" width="16%">POSYANDU / SEKOLAH</th>
                                        <th rowspan="2" width="15%">TANGGAL PELAKSANAAN</th>
                                        <th colspan="5" class="text-center th-group">JUMLAH &amp; DAFTAR PESERTA</th>
                                        <th rowspan="2" class="text-center" width="10%">DOKUMENTASI</th>
                                        @hasanyrole('Pencegahan|Super User')
                                        <th rowspan="2" class="text-center" width="8%">AKSI</th>
                                        @endhasanyrole
                                    </tr>
                                    <tr>
                                        <th class="text-center th-sub" width="9%">LAKI-LAKI</th>
                                        <th class="text-center th-sub" width="9%">PEREMPUAN</th>
                                        <th class="text-center th-sub" width="9%">GURU</th>
                                        <th class="text-center th-sub" width="9%">ORTU</th>
                                        <th class="text-center th-sub" width="11%">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items->values() as $index => $item)
                                    @php
                                        $gabunganPencarian = strtolower(($item->kelurahan ?? '') . ' ' . ($item->kecamatan ?? '') . ' rt ' . ($item->rt ?? '') . ' ' . ($item->posyandu_sekolah ?? '') . ' ' . $item->listNamaL->join(' ') . ' ' . $item->listNamaP->join(' '));
                                        $judulModal = ($item->posyandu_sekolah ?? $item->kelurahan ?? "Daftar Peserta") . " - Tahun {$tahun}";
                                    @endphp
                                    <tr class="baris-data" data-tahun="{{ $tahun }}" data-kecamatan="{{ strtolower($item->kecamatan ?? '') }}" data-laki="{{ $item->jml_l }}" data-perempuan="{{ $item->jml_p }}" data-guru="{{ $item->jml_g }}" data-ortu="{{ $item->jml_o }}" data-total="{{ $item->jml_total }}" data-pencarian="{{ $gabunganPencarian }}">
                                        <td class="text-center fw-bold nomor-urut">{{ $index + 1 }}</td>
                                        <td>
                                            <span class="cell-title">{{ $item->kelurahan ? 'Kelurahan ' . $item->kelurahan : '-' }}</span>
                                            <span class="cell-subtitle"><i class="fas fa-map-pin me-1"></i> {{ $item->rt && $item->rt !== '-' ? 'RT ' . $item->rt : 'RT Tidak diisi' }}</span>
                                            <span class="badge-tahun"><i class="far fa-calendar-alt"></i> Tahun {{ $tahun }}</span>
                                        </td>
                                        <td><span class="fw-bold">{{ $item->kecamatan ?? '-' }}</span></td>
                                        <td><span class="fw-bold text-dark">{{ $item->posyandu_sekolah ?? '-' }}</span></td>
                                        <td>
                                            @if($item->tanggal_pelaksanaan)
                                                <span class="cell-title">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') }}</span>
                                                <span class="cell-subtitle">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l') }}</span>
                                            @else
                                                <span class="fw-bold">{{ $item->hari_tgl ?? '-' }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_l }} Orang</span></td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_p }} Orang</span></td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_g }} Orang</span></td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_o }} Orang</span></td>
                                        <td class="text-center">
                                            <div class="total-wrap">
                                                <span class="total-number">{{ number_format($item->jml_total, 0, ',', '.') }} Orang</span>
                                                @if($item->listNamaL->isNotEmpty() || $item->listNamaP->isNotEmpty())
                                                    <button type="button" class="btn-peserta" onclick='bukaModalPeserta(@json($judulModal), @json($item->listNamaL), @json($item->listNamaP))'>
                                                        <i class="fas fa-users"></i> Lihat Peserta
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($item->links_parsed->isNotEmpty())
                                                <div class="media-links">
                                                    @foreach($item->links_parsed as $i => $u)
                                                        <a href="{{ $u }}" target="_blank" rel="noopener noreferrer" class="btn-media" title="Buka Link Dokumentasi"><i class="fas fa-link"></i> {{ $item->links_parsed->count() > 1 ? 'Link ' . ($i + 1) : 'Lihat' }}</a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="media-empty">-</span>
                                            @endif
                                        </td>
                                        @hasanyrole('Pencegahan|Super User')
                                        <td class="text-center">
                                            <div class="aksi-wrap">
                                                <a href="/internal/pencegahan/pemberdayaan-masyarakat/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <form action="/internal/pencegahan/pemberdayaan-masyarakat/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        @endhasanyrole
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="row-jumlah-total">
                                        <td colspan="5" class="total-label-cell">JUMLAH TOTAL TAHUN {{ $tahun }}</td>
                                        <td class="text-center foot-total-laki">0 Orang</td>
                                        <td class="text-center foot-total-perempuan">0 Orang</td>
                                        <td class="text-center foot-total-guru">0 Orang</td>
                                        <td class="text-center foot-total-ortu">0 Orang</td>
                                        <td class="text-center"><span class="total-val-badge foot-total-peserta">0 Orang</span></td>
                                        <td colspan="{{ $canCrud ? 2 : 1 }}"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="empty-state"><i class="fas fa-folder-open mb-2" style="font-size: 28px; color: #cbd5e1;"></i><br>Belum ada data kunjungan ke luar lokasi.</div>
                @endforelse
            </div>
        </div>

        <!-- ============================================== -->
        <!-- WRAPPER 2: KUNJUNGAN DALAM (MAKO) -->
        <!-- ============================================== -->
        <div id="wrapperDalam" style="display:none;">
            @if($koleksiDalam->isNotEmpty())
            <div class="summary-strip mako-mode">
                <div class="summary-strip-title">
                    <i class="fas fa-building"></i>
                    <div>
                        <h4 id="judulSummaryDalam">REKAP WISATA EDUKASI (SEMUA TAHUN)</h4>
                        <p>Akumulasi rombongan yang berkunjung ke Mako Damkar</p>
                    </div>
                </div>
                <div class="summary-metrics">
                    <div class="summary-metric-box"><span>Rombongan</span><strong class="sum-kegiatan">0</strong></div>
                    <div class="summary-metric-box"><span>Laki-laki</span><strong class="sum-laki">0</strong></div>
                    <div class="summary-metric-box"><span>Perempuan</span><strong class="sum-pr">0</strong></div>
                    <div class="summary-metric-box"><span>Guru</span><strong class="sum-guru">0</strong></div>
                    <div class="summary-metric-box"><span>Ortu</span><strong class="sum-ortu">0</strong></div>
                    <div class="summary-metric-box highlight"><span>Total Peserta</span><strong class="sum-total">0 Orang</strong></div>
                </div>
            </div>
            @endif

            <div class="wadah-tahun">
                @forelse($groupedDalam as $tahun => $items)
                    <div class="year-block mako-mode" data-year-block="{{ $tahun }}">
                        <div class="year-block-header">
                            <div class="year-block-title">
                                <span class="year-badge-icon"><i class="fas fa-calendar-alt"></i></span>
                                <h3>DATA WISATA EDUKASI TAHUN {{ $tahun }}</h3>
                            </div>
                            <div class="year-block-pills">
                                <span class="year-stat-pill"><i class="fas fa-building text-secondary"></i><span class="pill-jml-kegiatan">0</span> Rombongan</span>
                                <span class="year-stat-pill total"><i class="fas fa-users"></i> Total Peserta: <strong class="pill-total-tahun">0 Orang</strong></span>
                            </div>
                        </div>

                        <div class="table-scroll-wrapper mako-mode">
                            <table class="table-detailed">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" width="5%">NO</th>
                                        <th rowspan="2" width="25%">NAMA ROMBONGAN / INSTANSI</th>
                                        <th rowspan="2" width="15%">TANGGAL KUNJUNGAN</th>
                                        <th colspan="5" class="text-center th-group">JUMLAH &amp; DAFTAR PESERTA</th>
                                        <th rowspan="2" class="text-center" width="10%">DOKUMENTASI</th>
                                        @hasanyrole('Pencegahan|Super User')
                                        <th rowspan="2" class="text-center" width="8%">AKSI</th>
                                        @endhasanyrole
                                    </tr>
                                    <tr>
                                        <th class="text-center th-sub" width="9%">LAKI-LAKI</th>
                                        <th class="text-center th-sub" width="9%">PEREMPUAN</th>
                                        <th class="text-center th-sub" width="9%">GURU</th>
                                        <th class="text-center th-sub" width="9%">ORTU</th>
                                        <th class="text-center th-sub" width="11%">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items->values() as $index => $item)
                                    @php
                                        $gabunganPencarian = strtolower(($item->posyandu_sekolah ?? '') . ' ' . $item->listNamaL->join(' ') . ' ' . $item->listNamaP->join(' '));
                                        $judulModal = ($item->posyandu_sekolah ?? "Daftar Peserta") . " - Tahun {$tahun}";
                                    @endphp
                                    <tr class="baris-data" data-tahun="{{ $tahun }}" data-kecamatan="" data-laki="{{ $item->jml_l }}" data-perempuan="{{ $item->jml_p }}" data-guru="{{ $item->jml_g }}" data-ortu="{{ $item->jml_o }}" data-total="{{ $item->jml_total }}" data-pencarian="{{ $gabunganPencarian }}">
                                        <td class="text-center fw-bold nomor-urut">{{ $index + 1 }}</td>
                                        <td>
                                            <span class="cell-title" style="font-size: 1rem;">{{ $item->posyandu_sekolah ?? '-' }}</span>
                                            <span class="badge-tahun mt-2"><i class="far fa-calendar-alt"></i> Tahun {{ $tahun }}</span>
                                        </td>
                                        <td>
                                            @if($item->tanggal_pelaksanaan)
                                                <span class="cell-title">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') }}</span>
                                                <span class="cell-subtitle">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l') }}</span>
                                            @else
                                                <span class="fw-bold">{{ $item->hari_tgl ?? '-' }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_l }} Orang</span></td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_p }} Orang</span></td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_g }} Orang</span></td>
                                        <td class="text-center"><span class="chip-peserta">{{ $item->jml_o }} Orang</span></td>
                                        <td class="text-center">
                                            <div class="total-wrap">
                                                <span class="total-number">{{ number_format($item->jml_total, 0, ',', '.') }} Orang</span>
                                                @if($item->listNamaL->isNotEmpty() || $item->listNamaP->isNotEmpty())
                                                    <button type="button" class="btn-peserta" onclick='bukaModalPeserta(@json($judulModal), @json($item->listNamaL), @json($item->listNamaP))'>
                                                        <i class="fas fa-users"></i> Lihat Peserta
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($item->links_parsed->isNotEmpty())
                                                <div class="media-links">
                                                    @foreach($item->links_parsed as $i => $u)
                                                        <a href="{{ $u }}" target="_blank" rel="noopener noreferrer" class="btn-media" title="Buka Link Dokumentasi"><i class="fas fa-link"></i> {{ $item->links_parsed->count() > 1 ? 'Link ' . ($i + 1) : 'Lihat' }}</a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="media-empty">-</span>
                                            @endif
                                        </td>
                                        @hasanyrole('Pencegahan|Super User')
                                        <td class="text-center">
                                            <div class="aksi-wrap">
                                                <a href="/internal/pencegahan/pemberdayaan-masyarakat/edit/{{ $item->id }}" class="btn-action btn-edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <form action="/internal/pencegahan/pemberdayaan-masyarakat/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        @endhasanyrole
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="row-jumlah-total">
                                        <td colspan="3" class="total-label-cell">JUMLAH TOTAL TAHUN {{ $tahun }}</td>
                                        <td class="text-center foot-total-laki">0 Orang</td>
                                        <td class="text-center foot-total-perempuan">0 Orang</td>
                                        <td class="text-center foot-total-guru">0 Orang</td>
                                        <td class="text-center foot-total-ortu">0 Orang</td>
                                        <td class="text-center"><span class="total-val-badge foot-total-peserta">0 Orang</span></td>
                                        <td colspan="{{ $canCrud ? 2 : 1 }}"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="empty-state"><i class="fas fa-folder-open mb-2" style="font-size: 28px; color: #cbd5e1;"></i><br>Belum ada data wisata edukasi (rombongan ke Mako).</div>
                @endforelse
            </div>
        </div>

        <div id="emptyFilterState" class="empty-state" style="display: none;">
            <i class="fas fa-magnifying-glass" style="font-size: 28px; color: #cbd5e1; margin-bottom: 8px;"></i><br>
            Data yang Anda cari tidak ditemukan.
        </div>

        <!-- MODAL POP-UP DAFTAR PESERTA -->
        <div class="modal-peserta-backdrop" id="modalPeserta" onclick="if(event.target === this) tutupModalPeserta()">
            <div class="modal-peserta-card">
                <div class="modal-peserta-header">
                    <h4 id="judulModalPeserta">Daftar Peserta</h4>
                    <button type="button" class="btn-close-modal" onclick="tutupModalPeserta()">&times;</button>
                </div>
                <div class="modal-peserta-body">
                    <div class="peserta-col">
                        <h5><span><i class="fas fa-mars text-primary me-1"></i> Laki-laki</span><span id="jmlModalLaki" class="badge-tahun" style="margin-top:0;">0 Orang</span></h5>
                        <ol class="peserta-list" id="listModalLaki"></ol>
                    </div>
                    <div class="peserta-col">
                        <h5><span><i class="fas fa-venus text-danger me-1"></i> Perempuan</span><span id="jmlModalPerempuan" class="badge-tahun" style="margin-top:0;">0 Orang</span></h5>
                        <ol class="peserta-list" id="listModalPerempuan"></ol>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
@if($aktif !== 'semua')
<script>
    // Tab Switcher Logika
    var currentTab = 'luar';
    function switchTab(tab) {
        currentTab = tab;
        document.getElementById('btnTabLuar').classList.toggle('active', tab === 'luar');
        document.getElementById('btnTabDalam').classList.toggle('active', tab === 'dalam');
        document.getElementById('wrapperLuar').style.display = tab === 'luar' ? 'block' : 'none';
        document.getElementById('wrapperDalam').style.display = tab === 'dalam' ? 'block' : 'none';
        
        // Sembunyikan filter kecamatan saat di tab Mako (karena Mako ngga butuh filter ini)
        document.getElementById('filterKecamatan').style.display = tab === 'luar' ? 'inline-block' : 'none';
        if(tab === 'dalam') document.getElementById('filterKecamatan').value = ''; 
        
        filterData(); // Jalankan filter ulang buat ngitung total di tab yang aktif
    }

    // Toggle Dropdown Export
    function toggleExportMenu(btn, event) {
        event.stopPropagation();
        var parent = btn.closest('.export-dropdown');
        var isOpen = parent.classList.contains('open');
        document.querySelectorAll('.export-dropdown.open').forEach(function(el) { el.classList.remove('open'); });
        if (!isOpen) parent.classList.add('open');
    }
    document.addEventListener('click', function() {
        document.querySelectorAll('.export-dropdown.open').forEach(function(el) { el.classList.remove('open'); });
    });

    // Fungsi Modal Daftar Peserta
    function bukaModalPeserta(judul, listLaki, listPerempuan) {
        document.getElementById('judulModalPeserta').textContent = judul;
        document.getElementById('jmlModalLaki').textContent = listLaki.length + ' Orang';
        document.getElementById('jmlModalPerempuan').textContent = listPerempuan.length + ' Orang';

        var ulLaki = document.getElementById('listModalLaki');
        var ulPerempuan = document.getElementById('listModalPerempuan');
        ulLaki.innerHTML = ''; ulPerempuan.innerHTML = '';

        if (listLaki.length === 0) ulLaki.innerHTML = '<li style="list-style:none;color:#94a3b8;margin-left:-20px;">Tidak ada daftar.</li>';
        else listLaki.forEach(function(nama) { var li = document.createElement('li'); li.textContent = nama; ulLaki.appendChild(li); });

        if (listPerempuan.length === 0) ulPerempuan.innerHTML = '<li style="list-style:none;color:#94a3b8;margin-left:-20px;">Tidak ada daftar.</li>';
        else listPerempuan.forEach(function(nama) { var li = document.createElement('li'); li.textContent = nama; ulPerempuan.appendChild(li); });

        document.getElementById('modalPeserta').classList.add('show');
    }
    function tutupModalPeserta() { document.getElementById('modalPeserta').classList.remove('show'); }

    // Fungsi Filter Data
    function formatRibuan(angka) { return (Number(angka) || 0).toLocaleString('id-ID'); }

    function filterData() {
        var searchInput = document.getElementById('searchSosialisasi');
        var filterKec   = document.getElementById('filterKecamatan');
        var filterTahun = document.getElementById('filterTahun');
        
        var q   = (searchInput ? searchInput.value.trim().toLowerCase() : '');
        var kec = (filterKec ? filterKec.value : '');
        var thn = (filterTahun ? filterTahun.value : '');

        var activeWrapper = document.getElementById(currentTab === 'luar' ? 'wrapperLuar' : 'wrapperDalam');
        var yearBlocks = activeWrapper.querySelectorAll('.year-block');

        var grandKeg = 0, grandLaki = 0, grandPr = 0, grandGuru = 0, grandOrtu = 0, grandTotal = 0;
        var adaBlokTampil = false;

        yearBlocks.forEach(function (block) {
            var tahunBlok = block.getAttribute('data-year-block');
            if (thn && tahunBlok !== thn) { block.style.display = 'none'; return; }

            var rows = block.querySelectorAll('tbody tr.baris-data');
            var nomor = 1, subLaki = 0, subPr = 0, subGuru = 0, subOrtu = 0, subTotal = 0, jmlBaris = 0;

            rows.forEach(function (tr) {
                var textSearch = tr.getAttribute('data-pencarian') || '';
                var cocokCari = !q || textSearch.indexOf(q) > -1;
                var cocokKec  = !kec || tr.getAttribute('data-kecamatan') === kec;

                if (cocokCari && cocokKec) {
                    tr.style.display = '';
                    var selNomor = tr.querySelector('.nomor-urut');
                    if (selNomor) selNomor.textContent = nomor++;

                    var l = parseInt(tr.getAttribute('data-laki'), 10) || 0;
                    var p = parseInt(tr.getAttribute('data-perempuan'), 10) || 0;
                    var g = parseInt(tr.getAttribute('data-guru'), 10) || 0;
                    var o = parseInt(tr.getAttribute('data-ortu'), 10) || 0;
                    var t = parseInt(tr.getAttribute('data-total'), 10) || 0;

                    subLaki += l; subPr += p; subGuru += g; subOrtu += o; subTotal += t;
                    jmlBaris++;
                } else {
                    tr.style.display = 'none';
                }
            });

            if (jmlBaris > 0) {
                block.style.display = '';
                adaBlokTampil = true;

                var fLaki = block.querySelector('.foot-total-laki'), fPr = block.querySelector('.foot-total-perempuan');
                var fGuru = block.querySelector('.foot-total-guru'), fOrtu = block.querySelector('.foot-total-ortu');
                var fTot = block.querySelector('.foot-total-peserta');
                var pKeg = block.querySelector('.pill-jml-kegiatan'), pTot = block.querySelector('.pill-total-tahun');

                if (fLaki) fLaki.textContent = formatRibuan(subLaki) + ' Orang';
                if (fPr) fPr.textContent = formatRibuan(subPr) + ' Orang';
                if (fGuru) fGuru.textContent = formatRibuan(subGuru) + ' Orang';
                if (fOrtu) fOrtu.textContent = formatRibuan(subOrtu) + ' Orang';
                if (fTot) fTot.textContent = formatRibuan(subTotal) + ' Orang';
                if (pKeg) pKeg.textContent = formatRibuan(jmlBaris);
                if (pTot) pTot.textContent = formatRibuan(subTotal) + ' Orang';

                grandKeg += jmlBaris; grandLaki += subLaki; grandPr += subPr; 
                grandGuru += subGuru; grandOrtu += subOrtu; grandTotal += subTotal;
            } else {
                block.style.display = 'none';
            }
        });

        // Update Summary Strip yg aktif
        var sumStrip = activeWrapper.querySelector('.summary-strip');
        if(sumStrip) {
            sumStrip.querySelector('.sum-kegiatan').textContent = formatRibuan(grandKeg);
            sumStrip.querySelector('.sum-laki').textContent = formatRibuan(grandLaki);
            sumStrip.querySelector('.sum-pr').textContent = formatRibuan(grandPr);
            sumStrip.querySelector('.sum-guru').textContent = formatRibuan(grandGuru);
            sumStrip.querySelector('.sum-ortu').textContent = formatRibuan(grandOrtu);
            sumStrip.querySelector('.sum-total').textContent = formatRibuan(grandTotal) + ' Orang';
            
            var judul = sumStrip.querySelector('h4');
            if(judul) {
                var baseTeks = currentTab === 'luar' ? 'REKAP KUNJUNGAN KE LUAR' : 'REKAP WISATA EDUKASI MAKO';
                judul.textContent = thn ? baseTeks + ' (TAHUN ' + thn + ')' : baseTeks + ' (SEMUA TAHUN)';
            }
        }

        var emptyState = document.getElementById('emptyFilterState');
        if (emptyState) emptyState.style.display = adaBlokTampil ? 'none' : 'block';
    }

    function resetFilter() {
        if(document.getElementById('searchSosialisasi')) document.getElementById('searchSosialisasi').value = '';
        if(document.getElementById('filterKecamatan')) document.getElementById('filterKecamatan').value = '';
        if(document.getElementById('filterTahun')) document.getElementById('filterTahun').value = '';
        filterData();
    }

    var si = document.getElementById('searchSosialisasi');
    if (si) si.addEventListener('input', filterData);
    
    var fk = document.getElementById('filterKecamatan');
    if (fk) fk.addEventListener('change', filterData);
    
    var ft = document.getElementById('filterTahun');
    if (ft) ft.addEventListener('change', filterData);

    // Initial load
    switchTab('luar');
</script>
@endif
@endpush