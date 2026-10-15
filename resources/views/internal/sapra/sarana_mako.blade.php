@extends('layouts.dashboard')

@section('title', 'Sarana pemadam kebakaran')

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
    
                --sidebar-w: 272px;
                --topbar-h: 70px;
    
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
    .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: .78rem; background: var(--success); }
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); transition: background .2s; }
    .user-chip:hover { background: rgba(255,255,255,.12); }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, box-shadow .2s; }
    .btn-logout:hover { background: #e8eef5; box-shadow: 0 4px 10px rgba(0,0,0,.12); }
    @media (max-width: 900px) {
        .topbar { padding: 0 16px; }
    }
    .shell { display: flex; align-items: flex-start; height: calc(100vh - var(--topbar-h)); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; display: flex; flex-direction: column; gap: 4px;}
    .side-link { display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .89rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s, transform .2s; margin-bottom: 4px; }
    .side-link.active { background: var(--navy-soft); color: var(--navy); font-weight: 700; }
    .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
    .side-link:hover i, .side-link.active i { color: var(--navy); }
    .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; user-select: none; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
    .side-group summary .chev { margin-left: auto; font-size: 0.65rem; transition: transform .25s ease; }
    .side-group[open] > summary .chev { transform: rotate(180deg); }
    .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
    .side-sub a { display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; line-height: 1.4; color: var(--steel); transition: background .2s, color .2s, transform .2s; }
    .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; }
    .side-kicker { padding: 18px 14px 6px; font-size: 0.68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel-soft); margin-top: 8px; }
    .side-sub-kicker { display: block; padding: 12px 12px 4px 0; font-size: 0.65rem; font-weight: 800; color: var(--steel-soft); text-transform: uppercase; letter-spacing: 0.05em; }
    .side-divider { height: 1px; background: var(--line); margin: 6px 14px; flex: none; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .content { flex: 1; min-width: 0; height: 100%; overflow-y: auto; padding: clamp(24px, 4vw, 44px) clamp(20px, 4vw, 44px) 80px; }
    .page-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 26px; }
    .page-toolbar h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; color: var(--ink); margin-bottom: 5px;}
    .page-toolbar p { color: var(--steel); font-size: .95rem; }
    .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
    .mode-badge { display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; padding: 6px 14px; border-radius: 999px; background: var(--info-soft); color: var(--info); border: 1px solid rgba(37, 99, 235, .2); font-size: .78rem; font-weight: 700; }
    .search { position: relative; width: 280px; max-width: 100%; }
    .search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
    .search input { width: 100%; height: 44px; padding: 0 16px 0 42px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font: inherit; font-size: .9rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-weight: 600; font-size: .88rem; transition: background .2s, transform .1s, box-shadow .2s; white-space: nowrap; border: none;}
    .btn:active { transform: translateY(0); }
    .btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-sm); }
    .btn-primary { background: var(--navy); color: #fff; }
    .btn-primary:hover { background: var(--navy-dark); }
    .btn-outline { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
    .btn-outline:hover { border-color: var(--navy); background: var(--paper); }
    .btn-outline.red { color: var(--signal); border-color: var(--signal); }
    .btn-outline.red:hover { background: var(--signal); color: #fff; }
    .tabs { display: flex; gap: 6px; padding: 7px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: var(--shadow-xs); overflow-x: auto; scrollbar-width: none; margin-bottom: 24px; }
    .tabs::-webkit-scrollbar { display: none; }
    .tab { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 10px 18px; border-radius: 999px; font-weight: 700; font-size: .86rem; color: var(--steel); transition: background .2s, color .2s; }
    .tab:hover { background: var(--paper); color: var(--ink); }
    .tab[aria-selected="true"] { background: var(--navy); color: #fff; box-shadow: var(--shadow-sm); }
    .panel[hidden] { display: none; }
    .info-card { display: flex; flex-wrap: wrap; align-items: center; gap: 10px 26px; background: #fff; border: 1px solid var(--line); border-left: 4px solid var(--info); border-radius: var(--r-md); padding: 18px 22px; margin-bottom: 18px; box-shadow: var(--shadow-xs); }
    .info-card h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; letter-spacing: -0.01em; text-transform: uppercase; flex-basis: 100%; color: var(--ink); margin-bottom: 4px;}
    .info-row { display: flex; align-items: center; gap: 9px; font-size: .88rem; color: var(--steel); font-weight: 500; }
    .info-row i { color: var(--info); width: 16px; text-align: center; }
    .maps-chip { display: inline-flex; align-items: center; gap: 7px; padding: 6px 14px; border-radius: 999px; background: var(--navy-light); border: 1px solid var(--navy-soft); font-size: .8rem; font-weight: 600; color: var(--navy); transition: background .2s, color .2s; }
    .maps-chip:hover { background: var(--navy); color: #fff; }
    .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; box-shadow: var(--shadow-xs); transition: box-shadow .2s, border-color .2s;}
    .table-wrap:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table-scroll { overflow-x: auto; }
    .data-table { font-size: .88rem; min-width: 800px; width: 100%; text-align: left; }
    .data-table thead th { background: var(--paper); color: var(--steel); padding: 16px 14px; font-weight: 700; font-size: .75rem; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap; border-bottom: 1px solid var(--line); border-top: 1px solid var(--line); position: sticky; top: 0; z-index: 10;}
    .data-table thead th.c { text-align: center; }
    .data-table tbody td { padding: 16px 14px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
    .data-table tbody td.c { text-align: center; }
    .data-table tbody tr { transition: background .2s; }
    .data-table tbody tr:hover { background: #f8fafc; }
    .data-table tbody tr:last-child td { border-bottom: 0; }
    .cell-name { font-weight: 700; font-size: .95rem; text-transform: uppercase; margin-bottom: 8px; color: var(--ink); }
    .cell-empty { text-align: center; padding: 60px 16px; color: var(--steel-soft); font-weight: 600; font-size: 1rem; }
    .tag-row { display: flex; flex-wrap: wrap; gap: 6px; }
    .tag { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border-radius: 8px; font-size: .75rem; font-weight: 600; background: var(--paper); border: 1px solid var(--line); color: var(--steel); white-space: nowrap; }
    .tag i { font-size: .78rem; }
    .tag .val { color: var(--ink); font-weight: 700;}
    .tag.tahun i { color: var(--info); }
    .tag.plat i { color: var(--success); }
    .tag.stnk i { color: var(--signal); }
    .chip { display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: .8rem; border: 1px solid transparent; }
    .chip-blue { background: var(--info-soft); color: var(--info); border-color: rgba(37, 99, 235, 0.2); }
    .chip-muted { color: var(--steel-soft); }
    .img-wrap { display: inline-block; padding: 4px; border: 1px solid var(--line); border-radius: 8px; background: var(--paper); }
    .img-sarana { width: 150px; height: 100px; object-fit: cover; border-radius: 6px; transition: transform .2s; }
    .img-wrap:hover .img-sarana { transform: scale(1.03); }
    .img-empty { display: inline-flex; align-items: center; gap: 7px; padding: 8px 14px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .8rem; font-weight: 600; color: var(--steel); }
    .row-actions { display: inline-flex; gap: 8px; }
    .icon-btn { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; font-size: .85rem; color: #fff; transition: background .2s, transform .1s; }
    .icon-btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-xs); }
    .icon-btn.edit { background: var(--navy); }
    .icon-btn.edit:hover { background: var(--navy-dark); }
    .icon-btn.delete { background: var(--signal); }
    .icon-btn.delete:hover { background: var(--signal-dark); }
    dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-md); width: min(560px, calc(100vw - 24px)); max-height: min(90vh, 780px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: var(--shadow-lg); }
    dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
    dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
    @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 20px 24px; border-bottom: 1px solid var(--line); background: #fafafa; }
    .sheet-head h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--ink); margin:0; }
    .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); transition: background .2s, color .2s; color: var(--steel); }
    .sheet-x:hover { background: var(--signal-soft); color: var(--signal-dark); }
    .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
    .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: #fafafa; display: flex; justify-content: flex-end; gap: 12px; }
    .f-label { display: block; margin-bottom: 6px; font-size: .84rem; font-weight: 600; color: var(--ink); }
    .f-hint { margin-top: 6px; font-size: .75rem; color: var(--steel-soft); font-weight: 500; }
    .f-optional { font-weight: 500; color: var(--steel); text-transform: none; }
    .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    input[type="file"].f-input { padding: 9px 14px; font-size: .85rem; }
    .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
    .f-input::placeholder { color: var(--steel-soft); }
    .f-row { display: grid; grid-template-columns: 3fr 1fr; gap: 16px; }
    .f-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
    @media (max-width: 480px) {
        .f-row, .f-row-3 { grid-template-columns: 1fr; }
    }
    .btn-cancel { height: 42px; padding: 0 20px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); font-weight: 600; font-size: .88rem; transition: background .2s, border-color .2s; }
    .btn-cancel:hover { background: var(--paper); border-color: var(--steel); }
    .btn-save { height: 42px; padding: 0 24px; border-radius: 8px; background: var(--navy); color: #fff; border: none; font-weight: 600; font-size: .88rem; transition: background .2s; }
    .btn-save:hover { background: var(--navy-dark); }
    @media print {
        .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .tabs, .row-actions, dialog, .toast-wrap, .mode-badge { display: none !important; }
        body { background: #fff !important; overflow: visible !important; }
        .shell { display: block !important; height: auto !important; }
        .content { padding: 0 !important; height: auto !important; overflow: visible !important; }
        .table-wrap { border: none !important; box-shadow: none !important; }
        .panel { display: none !important; }
        .panel[data-print-active] { display: block !important; }
        .col-aksi { display: none !important; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
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
@endphp

@section('content')

        <div class="page-toolbar">
            <div>
                <h1>Sarana pemadam kebakaran</h1>
                <p>{{ $bisaCrud ? 'Manajemen dokumentasi visual sarana pemadam kebakaran di Pos Pemadam.' : 'Lihat dan cetak dokumentasi visual sarana pemadam kebakaran di Pos Pemadam.' }}</p>
                @unless($bisaCrud)
                    <span class="mode-badge"><i class="fas fa-eye"></i> Mode lihat &amp; cetak</span>
                @endunless
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari sarana</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari sarana..." autocomplete="off">
                </label>
                @if($bisaCrud)
                    <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah data</button>
                @endif
                <button type="button" class="btn btn-outline" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
                <a href="/sapra/sarana-mako/cetak-pdf" class="btn btn-outline red"><i class="fas fa-file-pdf"></i> PDF</a>
            </div>
        </div>

        @php $activeTab = session('active_tab'); @endphp

        <!-- Tab per pos -->
        <nav class="tabs" role="tablist" aria-label="Pilih pos">
            @foreach($posPemadam as $pos)
                @php $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first; @endphp
                <button type="button" class="tab" role="tab" data-tab="panel-{{ $pos->id_pos }}" aria-selected="{{ $isActive ? 'true' : 'false' }}">{{ strtoupper($pos->nama_pos) }}</button>
            @endforeach
        </nav>

        @foreach($posPemadam as $pos)
            @php
                $isActive = $activeTab ? ($pos->id_pos == $activeTab) : $loop->first;
                $dataFilter = $dataSarana->where('id_pos', $pos->id_pos);
            @endphp
            <div class="panel" id="panel-{{ $pos->id_pos }}" role="tabpanel" @if(!$isActive) hidden @endif @if($isActive) data-print-active @endif>

                <!-- Kartu info pos -->
                <div class="info-card">
                    <h2>{{ $pos->nama_pos }}</h2>
                    <span class="info-row"><i class="fas fa-map-marker-alt"></i> {{ $pos->alamat ?? 'Alamat belum diatur' }}</span>
                    <span class="info-row">
                        <i class="fas fa-map"></i> Kode map:
                        @if($pos->kode_map)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($pos->kode_map) }}" target="_blank" rel="noopener" class="maps-chip">
                                <i class="fas fa-location-arrow"></i> {{ $pos->kode_map }}
                            </a>
                        @else
                            <span class="chip-muted" style="padding:4px 8px;border-radius:6px;">&mdash;</span>
                        @endif
                    </span>
                </div>

                <div class="table-wrap">
                    <div class="table-scroll">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="c" style="width:5%">No</th>
                                    <th style="width:{{ $bisaCrud ? '33%' : '40%' }}">Jenis sarana kebakaran</th>
                                    <th class="c" style="width:8%">Jumlah</th>
                                    <th style="width:{{ $bisaCrud ? '27%' : '47%' }}">Gambar</th>
                                    @if($bisaCrud)
                                        <th class="c col-aksi" style="width:12%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataFilter as $item)
                                <tr class="data-row" data-tab="{{ $pos->id_pos }}">
                                    <td class="c">{{ $loop->iteration }}</td>
                                    <td class="data-name">
                                        <div class="cell-name">{{ $item->jenis_sarana }}</div>
                                        @if($item->tahun || $item->plat_nomor || $item->no_stnk)
                                            <div class="tag-row">
                                                @if($item->tahun)
                                                    <span class="tag tahun"><i class="fas fa-calendar-alt"></i> Thn: <span class="val">{{ $item->tahun }}</span></span>
                                                @endif
                                                @if($item->plat_nomor)
                                                    <span class="tag plat"><i class="fas fa-car"></i> Plat: <span class="val">{{ strtoupper($item->plat_nomor) }}</span></span>
                                                @endif
                                                @if($item->no_stnk)
                                                    <span class="tag stnk"><i class="fas fa-id-card"></i> STNK: <span class="val">{{ strtoupper($item->no_stnk) }}</span></span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="c"><span class="chip chip-blue">{{ $item->jumlah }}</span></td>
                                    <td>
                                        @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                            <div class="img-wrap">
                                                <a href="{{ asset($item->path_gambar) }}" target="_blank" rel="noopener">
                                                    <img src="{{ asset($item->path_gambar) }}" alt="{{ $item->jenis_sarana }}" class="img-sarana" onerror="this.onerror=null; this.src='https://via.placeholder.com/200x130?text=Gambar+Hilang';">
                                                </a>
                                            </div>
                                        @else
                                            <span class="img-empty"><i class="far fa-image"></i> Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    @if($bisaCrud)
                                    <td class="c col-aksi">
                                        <div class="row-actions">
                                            <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id_sarana }}" aria-label="Edit"><i class="fas fa-pen"></i></button>
                                            
                                            <form action="/sapra/sarana-mako/delete/{{ $item->id_sarana }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus sarana ini? Gambar akan ikut terhapus permanen.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>

                                @if($bisaCrud)
                                <!-- Dialog Edit (hanya Sapra) -->
                                <dialog class="sheet" id="dlgEdit{{ $item->id_sarana }}">
                                    <div class="sheet-head">
                                        <h2>Edit Data Sarana</h2>
                                        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                                    </div>
                                    <form action="/sapra/sarana-mako/update/{{ $item->id_sarana }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="sheet-body">
                                            <div>
                                                <label class="f-label" for="id_pos{{ $item->id_sarana }}">Pilih lokasi / pos</label>
                                                <select class="f-input" id="id_pos{{ $item->id_sarana }}" name="id_pos" required>
                                                    <option value="">— Pilih lokasi —</option>
                                                    @foreach($posPemadam as $posOption)
                                                        <option value="{{ $posOption->id_pos }}" {{ $posOption->id_pos == $item->id_pos ? 'selected' : '' }}>{{ strtoupper($posOption->nama_pos) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="f-row">
                                                <div>
                                                    <label class="f-label" for="jenis{{ $item->id_sarana }}">Jenis sarana</label>
                                                    <input class="f-input" type="text" id="jenis{{ $item->id_sarana }}" name="jenis_sarana" value="{{ $item->jenis_sarana }}" required>
                                                </div>
                                                <div>
                                                    <label class="f-label" for="jumlah{{ $item->id_sarana }}">Jumlah</label>
                                                    <input class="f-input" type="number" id="jumlah{{ $item->id_sarana }}" name="jumlah" value="{{ $item->jumlah }}" required>
                                                </div>
                                            </div>
                                            <div class="f-row-3">
                                                <div>
                                                    <label class="f-label" for="tahun{{ $item->id_sarana }}">Tahun <span class="f-optional">(ops)</span></label>
                                                    <input class="f-input" type="text" id="tahun{{ $item->id_sarana }}" name="tahun" value="{{ $item->tahun }}" placeholder="Cth: 2022">
                                                </div>
                                                <div>
                                                    <label class="f-label" for="plat{{ $item->id_sarana }}">Plat nomor <span class="f-optional">(ops)</span></label>
                                                    <input class="f-input" type="text" id="plat{{ $item->id_sarana }}" name="plat_nomor" value="{{ $item->plat_nomor }}" placeholder="Cth: BH 1234 XX">
                                                </div>
                                                <div>
                                                    <label class="f-label" for="stnk{{ $item->id_sarana }}">No. STNK <span class="f-optional">(ops)</span></label>
                                                    <input class="f-input" type="text" id="stnk{{ $item->id_sarana }}" name="no_stnk" value="{{ $item->no_stnk }}" placeholder="Cth: 12345678">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="f-label" for="gambar{{ $item->id_sarana }}">Ganti gambar <span class="f-optional">(opsional)</span></label>
                                                <input class="f-input" type="file" id="gambar{{ $item->id_sarana }}" name="gambar" accept="image/*">
                                                <p class="f-hint">Biarkan kosong jika tidak ingin mengganti gambar.</p>
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
                                <tr>
                                    <td colspan="{{ $bisaCrud ? 5 : 4 }}" class="cell-empty">Belum ada data sarana untuk {{ $pos->nama_pos }}.</td>
                                </tr>
                                @endforelse
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
        <h2>Tambah data sarana</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/sarana-mako/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="sheet-body">
            <div>
                <label class="f-label" for="tambahIdPos">Pilih lokasi / pos</label>
                <select class="f-input" id="tambahIdPos" name="id_pos" required>
                    <option value="">— Pilih lokasi —</option>
                    @foreach($posPemadam as $pos)
                        <option value="{{ $pos->id_pos }}">{{ strtoupper($pos->nama_pos) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="f-row">
                <div>
                    <label class="f-label" for="tambahJenis">Jenis sarana</label>
                    <input class="f-input" type="text" id="tambahJenis" name="jenis_sarana" placeholder="Contoh: Alat pelindung diri" required>
                </div>
                <div>
                    <label class="f-label" for="tambahJumlah">Jumlah</label>
                    <input class="f-input" type="number" id="tambahJumlah" name="jumlah" value="1" required>
                </div>
            </div>
            <div class="f-row-3">
                <div>
                    <label class="f-label" for="tambahTahun">Tahun <span class="f-optional">(ops)</span></label>
                    <input class="f-input" type="text" id="tambahTahun" name="tahun" placeholder="Cth: 2022">
                </div>
                <div>
                    <label class="f-label" for="tambahPlat">Plat nomor <span class="f-optional">(ops)</span></label>
                    <input class="f-input" type="text" id="tambahPlat" name="plat_nomor" placeholder="Cth: BH 1234 XX">
                </div>
                <div>
                    <label class="f-label" for="tambahStnk">No. STNK <span class="f-optional">(ops)</span></label>
                    <input class="f-input" type="text" id="tambahStnk" name="no_stnk" placeholder="Cth: 12345678">
                </div>
            </div>
            <div>
                <label class="f-label" for="tambahGambar">Upload gambar</label>
                <input class="f-input" type="file" id="tambahGambar" name="gambar" accept="image/*" required>
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

    /* ---------- Tabs Navigation ---------- */
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

    /* ---------- Modal / Dialog (hanya ada untuk Sapra) ---------- */
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
                row.style.display = row.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    }
})();
</script>
@endpush
