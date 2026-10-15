@extends('layouts.dashboard')

@section('title', 'Sumber Air')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
                --paper: #f5f7fa; --white: #ffffff;
    
                --navy: #163a63; --navy-dark: #0d2947; --navy-d: #0d2947;
                --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08); --navy-tint: rgba(22, 58, 99, .08);
    
                --signal: #dc3545; --signal-d: #b42332; --signal-tint: rgba(220, 53, 69, .09);
                --amber: #f4b740; --green: #198754; --success: #198754;
                --blue: #2563eb; --blue-d: #1d4fd6; --info: #2563eb; --info-tint: rgba(37, 99, 235, .09);
                --orange: #f97316; --orange-d: #c2410c;
    
                --steel: #64748b; --steel-soft: #94a3b8;
                --line: #e2e8f0; --line-dark: #d5dce6;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
                --r-lg: 22px; --r-md: 16px; --r-sm: 10px;
                --sidebar-w: 272px; --topbar-h: 70px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); -webkit-font-smoothing: antialiased; overflow: hidden; }
    body:has(dialog[open]) { overflow: hidden; }
    a { color: inherit; text-decoration: none; transition: color .2s, background .2s, border-color .2s; }
    button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; transition: background .2s, color .2s; }
    table { border-collapse: collapse; width: 100%; }
    ::-webkit-scrollbar { width: 8px; height: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d5dce6; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; }
    .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; background: var(--green); }
    .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; transition: background .2s; }
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); transition: background .2s; }
    .user-chip:hover { background: rgba(255,255,255,.12); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, box-shadow .2s; }
    .btn-logout:hover { background: #e8eef5; box-shadow: 0 4px 10px rgba(0,0,0,.12); }
    .shell { display: flex; align-items: flex-start; height: calc(100vh - var(--topbar-h)); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; display: flex; flex-direction: column; gap: 4px; }
    .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
    .side-link.active { background: var(--navy); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
    .side-link.active i { color: #fff; }
    .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
    .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
    .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
    .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
    .side-sub-kicker { display: block; padding: 12px 12px 4px 0; font-size: .65rem; font-weight: 800; color: var(--steel-soft); text-transform: uppercase; letter-spacing: .05em; }
    .side-divider { height: 1px; background: var(--line); margin: 6px 14px; flex: none; }
    @media (max-width: 900px) {
        .topbar { padding: 0 16px; }
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .content { flex: 1; min-width: 0; height: 100%; overflow-y: auto; padding: clamp(20px, 3vw, 36px) clamp(18px, 3vw, 40px) 60px; }
    .page-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
    .page-toolbar h1 { font-family: var(--font-display); font-weight: 800; font-stretch: 88%; font-size: clamp(1.5rem, 3vw, 1.9rem); line-height: 1.15; letter-spacing: -0.02em; color: var(--ink); }
    .page-toolbar p { margin-top: 4px; color: var(--steel); font-size: .92rem; }
    .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
    .mode-badge { display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; padding: 6px 14px; border-radius: 999px; background: var(--info-tint); color: var(--info); border: 1px solid rgba(37, 99, 235, .2); font-size: .78rem; font-weight: 700; }
    .search { position: relative; width: 260px; max-width: 100%; }
    .search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
    .search input { width: 100%; height: 42px; padding: 0 14px 0 40px; border-radius: 999px; border: 1.5px solid var(--line); background: #fff; font: inherit; font-size: .88rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }
    .btn { display: inline-flex; align-items: center; gap: 8px; height: 42px; padding: 0 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; transition: background .2s, transform .2s, box-shadow .2s; white-space: nowrap; }
    .btn:active { transform: scale(.98); }
    .btn-primary { background: var(--navy); color: #fff; box-shadow: 0 4px 6px -1px rgba(22,58,99,.12); }
    .btn-primary:hover { background: var(--navy-dark); box-shadow: 0 6px 8px -1px rgba(22,58,99,.22); }
    .btn-outline { background: #fff; border: 1.5px solid var(--line); color: var(--ink); }
    .btn-outline:hover { border-color: var(--ink); background: var(--paper); }
    .btn-outline.green i { color: var(--green); }
    .btn-outline.red i { color: var(--signal); }
    .tabs { display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: var(--shadow-xs); overflow-x: auto; scrollbar-width: none; margin-bottom: 20px; }
    .tabs::-webkit-scrollbar { display: none; }
    .tab { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 10px 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; color: var(--steel); transition: background .2s, color .2s; }
    .tab:hover { background: var(--paper); color: var(--ink); }
    .tab[aria-selected="true"] { background: var(--navy); color: #fff; }
    .panel[hidden] { display: none; }
    .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; box-shadow: var(--shadow-xs); }
    .table-scroll { overflow-x: auto; }
    .data-table { font-size: .85rem; min-width: 720px; }
    .data-table thead th { background: var(--paper); color: var(--steel); padding: 14px 16px; font-weight: 800; font-size: .7rem; letter-spacing: .05em; text-transform: uppercase; text-align: left; white-space: nowrap; border-bottom: 2px solid var(--line); position: sticky; top: 0; z-index: 10; }
    .data-table thead th.c { text-align: center; }
    .data-table tbody td { padding: 13px 16px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
    .data-table tbody td.c { text-align: center; }
    .data-table tbody tr:hover { background: var(--paper); }
    .data-table tbody tr:last-child td { border-bottom: 0; }
    .cell-name { font-weight: 700; color: var(--ink); }
    .cell-empty { text-align: center; padding: 48px 16px; color: var(--steel-soft); font-weight: 600; }
    .row-total td { background: var(--paper); font-weight: 800; border-top: 2px solid var(--line); }
    .row-total td:first-child { text-align: right; }
    .chip { display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: .8rem; border: 1px solid transparent; }
    .chip-blue { background: var(--info-tint); color: var(--info); border-color: rgba(37, 99, 235, 0.2); }
    .chip-green { background: rgba(25, 135, 84, 0.1); color: var(--success); border-color: rgba(25, 135, 84, 0.2); }
    .chip-total { background: var(--navy); color: #fff; border-color: transparent; }
    .chip-muted { color: var(--steel-soft); }
    .maps-chip { display: inline-flex; align-items: center; gap: 7px; padding: 6px 12px; border-radius: 999px; background: var(--navy-light); border: 1px solid var(--navy-soft); font-size: .78rem; font-weight: 600; color: var(--navy); transition: background .2s, color .2s; }
    .maps-chip:hover { background: var(--navy); color: #fff; }
    .maps-chip i { color: var(--signal); }
    .maps-chip:hover i { color: #fff; }
    .row-actions { display: inline-flex; gap: 6px; }
    .icon-btn { width: 32px; height: 32px; border-radius: 9px; display: inline-grid; place-items: center; font-size: .82rem; color: #fff; transition: filter .2s, transform .2s; }
    .icon-btn:hover { filter: brightness(.92); transform: translateY(-1px); }
    .icon-btn.edit { background: var(--amber); color: var(--ink); }
    .icon-btn.delete { background: var(--signal); }
    dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-lg); width: min(480px, calc(100vw - 24px)); max-height: min(90vh, 720px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: var(--shadow-lg); }
    dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
    dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
    @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 18px 24px; border-bottom: 1px solid var(--line); }
    .sheet-head h2 { font-family: var(--font-display); font-weight: 800; font-stretch: 90%; font-size: 1.15rem; letter-spacing: -0.01em; color: var(--ink); }
    .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; color: var(--steel); }
    .sheet-x:hover { background: var(--signal-tint); color: var(--signal-d); }
    .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
    .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: var(--paper); display: flex; justify-content: flex-end; gap: 10px; }
    .f-label { display: block; margin-bottom: 6px; font-size: .8rem; font-weight: 800; color: var(--ink); text-transform: uppercase; letter-spacing: .04em; }
    .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid var(--line); border-radius: 12px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    textarea.f-input { height: auto; padding: 12px 14px; resize: vertical; min-height: 80px; }
    .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); }
    .f-input:disabled, .f-input[readonly] { background: var(--paper); color: var(--steel); cursor: not-allowed; }
    select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
    .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .f-hint { margin-top: 6px; font-size: .75rem; color: var(--steel-soft); font-weight: 500; }
    .btn-cancel { height: 42px; padding: 0 18px; border-radius: 999px; background: var(--paper); color: var(--ink); font-weight: 700; font-size: .86rem; transition: background .2s; }
    .btn-cancel:hover { background: var(--line); }
    .btn-save { height: 42px; padding: 0 22px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 700; font-size: .86rem; transition: background .2s; }
    .btn-save:hover { background: var(--navy-dark); }
    @media print {
        .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .tabs, .row-actions, dialog, .toast-wrap, .mode-badge { display: none !important; }
        body { background: #fff !important; overflow: visible !important; }
        .shell { display: block !important; height: auto !important; }
        .content { padding: 0 !important; overflow: visible !important; height: auto !important; }
        .table-wrap { border: none !important; box-shadow: none !important; }
        .panel { display: none !important; }
        .panel[data-print-active] { display: block !important; }
        .col-aksi { display: none !important; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
@php
    /* ------------------------------------------------------------
       LOGIKA AKUN (Spatie Permission)
       Role: Super User, Sapra, Sekretariat, Damtan, Pencegahan, Operator
       Aturan: HANYA role "Sapra" yang boleh CRUD. Role lain: lihat & cetak saja.
       Mau tambah role lain yang boleh CRUD? Ubah satu baris $bisaCrud di bawah.
       ------------------------------------------------------------ */
   $user       = Auth::user();
    $namaRole   = $user->getRoleNames()->first() ?? '';
    $bisaCrud = $user->hasRole('Sapra') || $user->hasRole('Super User');
    $isSuper    = $user->hasRole('Super User');
    $bisaKonten = $user->hasAnyRole(['Operator', 'Super User']);

    /* ------------------------------------------------------------
       Konfigurasi tab. Satu definisi dipakai untuk merender tombol
       tab, tabel, dan modal edit per baris — supaya ke-4 kategori
       tidak perlu ditulis berulang empat kali.
       ------------------------------------------------------------ */
    $tabsData = [
        [
            'key' => 'pilar', 'label' => 'Hidrant pilar', 'kategori' => 'Hidrant Pilar',
            'data' => $hidranPilar ?? collect(), 'name_label' => 'Nama gedung / lokasi',
            'qty_label' => 'Jumlah', 'qty_field' => 'jumlah', 'qty_unit' => 'unit',
            'qty_kind' => 'jumlah', 'badge' => 'chip-blue', 'total' => true,
        ],
        [
            'key' => 'gedung', 'label' => 'Hidrant gedung', 'kategori' => 'Hidrant Gedung',
            'data' => $hidranGedung ?? collect(), 'name_label' => 'Nama gedung',
            'qty_label' => 'Jumlah', 'qty_field' => 'jumlah', 'qty_unit' => 'unit',
            'qty_kind' => 'jumlah', 'badge' => 'chip-blue', 'total' => true,
        ],
        [
            'key' => 'embung', 'label' => 'Embung / kolam', 'kategori' => 'Embung',
            'data' => $embung ?? collect(), 'name_label' => 'Nama lokasi',
            'qty_label' => 'Kapasitas air', 'qty_field' => 'luas', 'qty_unit' => '',
            'qty_kind' => 'luas', 'badge' => 'chip-green', 'total' => false,
        ],
        [
            'key' => 'danau', 'label' => 'Danau', 'kategori' => 'Danau',
            'data' => $danau ?? collect(), 'name_label' => 'Nama danau',
            'qty_label' => 'Kapasitas air', 'qty_field' => 'luas', 'qty_unit' => '',
            'qty_kind' => 'luas', 'badge' => 'chip-green', 'total' => false,
        ],
    ];
@endphp

@section('content')

        <div class="page-toolbar">
            <div>
                <h1>Sumber air</h1>
                <p>{{ $bisaCrud ? 'Kelola data ketersediaan hidrant pilar, gedung, embung, dan danau.' : 'Lihat dan cetak data ketersediaan hidrant pilar, gedung, embung, dan danau.' }}</p>
                @unless($bisaCrud)
                    <span class="mode-badge"><i class="fas fa-eye"></i> Mode lihat &amp; cetak</span>
                @endunless
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari lokasi atau alamat</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari lokasi atau alamat" autocomplete="off">
                </label>
                @if($bisaCrud)
                    <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah data</button>
                @endif
                <button type="button" class="btn btn-outline" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
                <a href="/sapra/hidran/cetak-excel" class="btn btn-outline green"><i class="fas fa-file-excel"></i> Excel</a>
                <a href="/sapra/hidran/cetak-pdf" class="btn btn-outline red"><i class="fas fa-file-pdf"></i> PDF</a>
            </div>
        </div>

        <!-- Tab Kategori -->
        <nav class="tabs" role="tablist" aria-label="Kategori sumber air">
            @foreach($tabsData as $i => $t)
                <button type="button" class="tab" role="tab" data-tab="panel-{{ $t['key'] }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                    {{ $t['label'] }}
                </button>
            @endforeach
        </nav>

        @foreach($tabsData as $i => $t)
            <div class="panel" id="panel-{{ $t['key'] }}" role="tabpanel" @if($i !== 0) hidden @endif @if($i === 0) data-print-active @endif>
                <div class="table-wrap">
                    <div class="table-scroll">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="c" style="width:5%">No</th>
                                    <th style="width:{{ $bisaCrud ? '24%' : '28%' }}">{{ $t['name_label'] }}</th>
                                    <th style="width:{{ $bisaCrud ? '33%' : '37%' }}">Alamat</th>
                                    <th class="c" style="width:{{ $bisaCrud ? '15%' : '17%' }}">Kode maps</th>
                                    <th class="c" style="width:13%">{{ $t['qty_label'] }}</th>
                                    @if($bisaCrud)
                                        <th class="c col-aksi" style="width:10%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($t['data'] as $item)
                                <tr class="data-row" data-tab="{{ $t['key'] }}">
                                    <td class="c">{{ $item->no_urut }}</td>
                                    <td class="cell-name data-name">{{ $item->nama_gedung }}</td>
                                    <td class="data-address">{{ $item->alamat }}</td>
                                    <td class="c">
                                        @if($item->kode_maps)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_maps) }}" target="_blank" rel="noopener" class="maps-chip">
                                                <i class="fas fa-map-marker-alt"></i> {{ $item->kode_maps }}
                                            </a>
                                        @else
                                            <span class="chip-muted">&mdash;</span>
                                        @endif
                                    </td>
                                    <td class="c">
                                        @if($t['qty_kind'] === 'jumlah')
                                            <span class="chip {{ $t['badge'] }}">{{ $item->jumlah ?? '0' }} {{ $t['qty_unit'] }}</span>
                                        @else
                                            <span class="chip {{ $t['badge'] }}">{{ $item->luas ?? '—' }}</span>
                                        @endif
                                    </td>
                                    @if($bisaCrud)
                                    <td class="c col-aksi">
                                        <div class="row-actions">
                                            <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                            <form action="/sapra/hidran/delete/{{ $item->id }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin hapus data ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>

                                @if($bisaCrud)
                                <!-- Dialog edit (hanya Sapra) -->
                                <dialog class="sheet" id="dlgEdit{{ $item->id }}">
                                    <div class="sheet-head">
                                        <h2>Edit data {{ $t['label'] }}</h2>
                                        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                    </div>
                                    <form action="/sapra/hidran/update/{{ $item->id }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="sheet-body">
                                            <div>
                                                <label class="f-label" for="kategori{{ $item->id }}">Kategori (pindah tab)</label>
                                                <select class="f-input" id="kategori{{ $item->id }}" name="kategori" required>
                                                    @foreach(['Hidrant Pilar', 'Hidrant Gedung', 'Embung', 'Danau'] as $opt)
                                                        <option value="{{ $opt }}" {{ $item->kategori == $opt ? 'selected' : '' }}>{{ $opt === 'Embung' ? 'Embung / kolam' : $opt }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="f-label" for="no_urut{{ $item->id }}">No urut</label>
                                                <input class="f-input" type="number" id="no_urut{{ $item->id }}" name="no_urut" value="{{ $item->no_urut }}" readonly>
                                                <p class="f-hint">Diisi otomatis oleh sistem.</p>
                                            </div>
                                            <div>
                                                <label class="f-label" for="nama_gedung{{ $item->id }}">{{ $t['name_label'] }}</label>
                                                <input class="f-input" type="text" id="nama_gedung{{ $item->id }}" name="nama_gedung" value="{{ $item->nama_gedung }}" required>
                                            </div>
                                            <div>
                                                <label class="f-label" for="alamat{{ $item->id }}">Alamat lengkap</label>
                                                <textarea class="f-input" id="alamat{{ $item->id }}" name="alamat" required>{{ $item->alamat }}</textarea>
                                            </div>
                                            <div>
                                                <label class="f-label" for="kode_maps{{ $item->id }}">Kode maps</label>
                                                <input class="f-input" type="text" id="kode_maps{{ $item->id }}" name="kode_maps" value="{{ $item->kode_maps }}">
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="jumlah{{ $item->id }}">Jumlah (unit)</label>
                                                    <input class="f-input" type="number" id="jumlah{{ $item->id }}" name="jumlah" value="{{ $item->jumlah }}" {{ $t['qty_kind'] === 'luas' ? 'disabled placeholder=—' : '' }}>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="luas{{ $item->id }}">Kapasitas air (liter/m&sup3;)</label>
                                                    <input class="f-input" type="text" id="luas{{ $item->id }}" name="luas" value="{{ $item->luas }}" {{ $t['qty_kind'] === 'jumlah' ? 'disabled placeholder=—' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sheet-foot">
                                            <button type="button" class="btn-cancel" data-close>Batal</button>
                                            <button type="submit" class="btn-save">Simpan perubahan</button>
                                        </div>
                                    </form>
                                </dialog>
                                @endif
                                @empty
                                <tr><td colspan="{{ $bisaCrud ? 6 : 5 }}" class="cell-empty">Belum ada data {{ $t['label'] }} tersimpan.</td></tr>
                                @endforelse

                                @if($t['total'] && $t['data']->count() > 0)
                                <tr class="row-total">
                                    <td colspan="4">Total keseluruhan</td>
                                    <td class="c"><span class="chip chip-total">{{ $t['data']->sum('jumlah') }} {{ $t['qty_unit'] }}</span></td>
                                    @if($bisaCrud)
                                        <td class="col-aksi"></td>
                                    @endif
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

@if($bisaCrud)
<!-- ==================== DIALOG TAMBAH (hanya Sapra) ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah data baru</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/hidran/store" method="POST">
        @csrf
        <div class="sheet-body">
            <div>
                <label class="f-label" for="pilihKategoriTambah">Pilih kategori</label>
                <select class="f-input" id="pilihKategoriTambah" name="kategori" required>
                    <option value="">— Pilih kategori —</option>
                    <option value="Hidrant Pilar">Hidrant Pilar</option>
                    <option value="Hidrant Gedung">Hidrant Gedung</option>
                    <option value="Embung">Embung / kolam</option>
                    <option value="Danau">Danau</option>
                </select>
            </div>
            <div>
                <label class="f-label" for="tambahNama">Nama gedung / lokasi</label>
                <input class="f-input" type="text" id="tambahNama" name="nama_gedung" placeholder="Masukkan nama" required>
            </div>
            <div>
                <label class="f-label" for="tambahAlamat">Alamat lengkap</label>
                <textarea class="f-input" id="tambahAlamat" name="alamat" rows="2" placeholder="Masukkan alamat" required></textarea>
            </div>
            <div>
                <label class="f-label" for="tambahMaps">Kode maps</label>
                <input class="f-input" type="text" id="tambahMaps" name="kode_maps" placeholder="Contoh: 9HM5+6X">
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="inputTambahJumlah">Jumlah (hidrant)</label>
                    <input class="f-input" type="number" id="inputTambahJumlah" name="jumlah" placeholder="Contoh: 5">
                </div>
                <div>
                    <label class="f-label" for="inputTambahLuas">Kapasitas air (embung/danau)</label>
                    <input class="f-input" type="text" id="inputTambahLuas" name="luas" placeholder="Contoh: 50.000 liter">
                </div>
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save">Simpan data</button>
        </div>
    </form>
</dialog>
@endif
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Tab Navigation ---------- */
    var searchInput = document.getElementById('searchInput');
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) { t.setAttribute('aria-selected', 'false'); });
            tab.setAttribute('aria-selected', 'true');

            document.querySelectorAll('.panel').forEach(function (p) {
                var active = p.id === tab.dataset.tab;
                p.hidden = !active;
                if (active) { p.setAttribute('data-print-active', ''); } else { p.removeAttribute('data-print-active'); }
            });

            if (searchInput) {
                searchInput.value = '';
                document.querySelectorAll('.data-row').forEach(function (row) { row.style.display = ''; });
            }
        });
    });

    /* ---------- Dialog (tambah & edit; hanya ada untuk Sapra) ---------- */
    document.querySelectorAll('[data-open]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = document.getElementById(btn.dataset.open);
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });
    document.querySelectorAll('dialog').forEach(function (dlg) {
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg || e.target.closest('[data-close]')) dlg.close();
        });
    });

    /* ---------- Live Search Table ---------- */
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = searchInput.value.trim().toLowerCase();
            var activePanel = document.querySelector('.panel:not([hidden])');
            if (!activePanel) return;

            activePanel.querySelectorAll('.data-row').forEach(function (row) {
                var namaElem = row.querySelector('.data-name');
                var alamatElem = row.querySelector('.data-address');

                var nama = namaElem ? namaElem.textContent.toLowerCase() : '';
                var alamat = alamatElem ? alamatElem.textContent.toLowerCase() : '';

                row.style.display = (nama.indexOf(q) !== -1 || alamat.indexOf(q) !== -1) ? '' : 'none';
            });
        });
    }

    /* ---------- Toggle form input (hanya ada untuk Sapra) ---------- */
    var pilihKategori = document.getElementById('pilihKategoriTambah');
    var inputJumlah = document.getElementById('inputTambahJumlah');
    var inputLuas = document.getElementById('inputTambahLuas');

    if (pilihKategori && inputJumlah && inputLuas) {
        pilihKategori.addEventListener('change', function () {
            var kat = pilihKategori.value;
            if (kat === 'Hidrant Pilar' || kat === 'Hidrant Gedung') {
                inputJumlah.disabled = false;
                inputLuas.disabled = true; inputLuas.value = '';
            } else if (kat === 'Embung' || kat === 'Danau') {
                inputJumlah.disabled = true; inputJumlah.value = '';
                inputLuas.disabled = false;
            } else {
                inputJumlah.disabled = false;
                inputLuas.disabled = false;
            }
        });
    }
})();
</script>
@endpush
