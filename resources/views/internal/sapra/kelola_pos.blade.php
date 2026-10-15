@extends('layouts.dashboard')

@section('title', 'Kelola Data Pos')

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
    .cell-name { font-weight: 700; font-size: .95rem; text-transform: uppercase; color: var(--ink); }
    .cell-address { font-size: .88rem; color: var(--steel); line-height: 1.5; margin-top: 4px; }
    .cell-empty { text-align: center; padding: 60px 16px; color: var(--steel-soft); font-weight: 600; font-size: 1rem; }
    .maps-chip { display: inline-flex; align-items: center; gap: 7px; padding: 6px 14px; border-radius: 999px; background: var(--navy-light); border: 1px solid var(--navy-soft); font-size: .8rem; font-weight: 600; color: var(--navy); transition: background .2s, color .2s; }
    .maps-chip:hover { background: var(--navy); color: #fff; }
    .row-actions { display: inline-flex; gap: 8px; justify-content: center;}
    .icon-btn { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; font-size: .85rem; color: #fff; transition: background .2s, transform .1s; }
    .icon-btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-xs); }
    .icon-btn.edit { background: var(--amber); color: var(--ink); }
    .icon-btn.edit:hover { background: #e0a32e; }
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
    textarea.f-input { padding-top: 12px; padding-bottom: 12px; height: auto; min-height: 90px; resize: vertical; }
    .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-cancel { height: 42px; padding: 0 20px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); font-weight: 600; font-size: .88rem; transition: background .2s, border-color .2s; }
    .btn-cancel:hover { background: var(--paper); border-color: var(--steel); }
    .btn-save { height: 42px; padding: 0 24px; border-radius: 8px; background: var(--navy); color: #fff; border: none; font-weight: 600; font-size: .88rem; transition: background .2s; }
    .btn-save:hover { background: var(--navy-dark); }
    @media print {
        .topbar, .sidebar, .sidebar-backdrop, .page-toolbar .toolbar-actions, .row-actions, dialog, .toast-wrap, .mode-badge { display: none !important; }
        body { background: #fff !important; overflow: visible !important; }
        .shell { display: block !important; height: auto !important; }
        .content { padding: 0 !important; overflow: visible !important; height: auto !important; }
        .table-wrap { border: none !important; box-shadow: none !important; }
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
                <h1>Kelola Data Pos &amp; Mako</h1>
                <p>{{ $bisaCrud ? 'Tambah, edit, atau hapus stasiun Pos Pemadam. Data pos ini akan menjadi Tab di menu lainnya.' : 'Lihat dan cetak data stasiun Pos Pemadam.' }}</p>
                @unless($bisaCrud)
                    <span class="mode-badge"><i class="fas fa-eye"></i> Mode lihat &amp; cetak</span>
                @endunless
            </div>
            <div class="toolbar-actions">
                <label class="search">
                    <span class="sr-only" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);">Cari nama pos atau alamat</span>
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama pos atau alamat..." autocomplete="off">
                </label>
                @if($bisaCrud)
                    <button type="button" class="btn btn-primary" data-open="dlgTambah"><i class="fas fa-plus"></i> Tambah pos baru</button>
                @endif
                <button type="button" class="btn btn-outline" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>

        <div class="table-wrap">
            <div class="table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="c" style="width:5%">No</th>
                            <th style="width:{{ $bisaCrud ? '25%' : '30%' }}">Nama Pos</th>
                            <th style="width:{{ $bisaCrud ? '40%' : '45%' }}">Alamat Lengkap</th>
                            <th class="c" style="width:{{ $bisaCrud ? '15%' : '20%' }}">Kode Map</th>
                            @if($bisaCrud)
                                <th class="c col-aksi" style="width:15%">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataPos as $index => $item)
                        <tr class="data-row">
                            <td class="c">{{ $loop->iteration }}</td>
                            <td>
                                <div class="cell-name data-name">{{ $item->nama_pos }}</div>
                            </td>
                            <td>
                                <div class="cell-address data-address">{{ $item->alamat ?? '-' }}</div>
                            </td>
                            <td class="c">
                                @if($item->kode_map)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->kode_map) }}" target="_blank" rel="noopener" class="maps-chip">
                                        <i class="fas fa-location-arrow"></i> {{ $item->kode_map }}
                                    </a>
                                @else
                                    <span style="color: var(--steel-soft); font-weight: 500;">-</span>
                                @endif
                            </td>
                            @if($bisaCrud)
                            <td class="c col-aksi">
                                <div class="row-actions">
                                    <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id_pos }}" aria-label="Edit"><i class="fas fa-pen"></i></button>

                                    <form action="/sapra/kelola-pos/delete/{{ $item->id_pos }}" method="POST" style="margin:0;" onsubmit="return confirm('HATI-HATI! Menghapus pos ini mungkin akan menyebabkan error pada data Prasarana/Sarana yang terkait dengan pos ini. Lanjutkan?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn delete" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>

                        @if($bisaCrud)
                        <!-- Dialog Edit (hanya Sapra) -->
                        <dialog class="sheet" id="dlgEdit{{ $item->id_pos }}">
                            <div class="sheet-head">
                                <h2>Edit Data Pos</h2>
                                <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
                            </div>
                            <form action="/sapra/kelola-pos/update/{{ $item->id_pos }}" method="POST">
                                @csrf @method('PUT')
                                <div class="sheet-body">
                                    <div>
                                        <label class="f-label" for="nama_pos{{ $item->id_pos }}">Nama Pos</label>
                                        <input class="f-input" type="text" id="nama_pos{{ $item->id_pos }}" name="nama_pos" value="{{ $item->nama_pos }}" required>
                                    </div>
                                    <div>
                                        <label class="f-label" for="alamat{{ $item->id_pos }}">Alamat Lengkap</label>
                                        <textarea class="f-input" id="alamat{{ $item->id_pos }}" name="alamat" required>{{ $item->alamat }}</textarea>
                                    </div>
                                    <div>
                                        <label class="f-label" for="kode_map{{ $item->id_pos }}">Kode Map <span class="f-optional">(opsional)</span></label>
                                        <input class="f-input" type="text" id="kode_map{{ $item->id_pos }}" name="kode_map" value="{{ $item->kode_map }}">
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
                            <td colspan="{{ $bisaCrud ? 5 : 4 }}" class="cell-empty">Belum ada data pos tersimpan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

@if($bisaCrud)
<!-- ==================== DIALOG TAMBAH (hanya Sapra) ==================== -->
<dialog class="sheet" id="dlgTambah">
    <div class="sheet-head">
        <h2>Tambah Pos Baru</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <form action="/sapra/kelola-pos/store" method="POST">
        @csrf
        <div class="sheet-body">
            <div>
                <label class="f-label" for="tambahNamaPos">Nama Pos</label>
                <input class="f-input" type="text" id="tambahNamaPos" name="nama_pos" placeholder="Contoh: POS ALAM BARAJO" required>
            </div>
            <div>
                <label class="f-label" for="tambahAlamat">Alamat Lengkap</label>
                <textarea class="f-input" id="tambahAlamat" name="alamat" placeholder="Masukkan alamat lengkap..." required></textarea>
            </div>
            <div>
                <label class="f-label" for="tambahKodeMap">Kode Map <span class="f-optional">(opsional)</span></label>
                <input class="f-input" type="text" id="tambahKodeMap" name="kode_map" placeholder="Contoh: 9HGG+H2M">
            </div>
        </div>
        <div class="sheet-foot">
            <button type="button" class="btn-cancel" data-close>Batal</button>
            <button type="submit" class="btn-save">Tambah Pos</button>
        </div>
    </form>
</dialog>
@endif
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

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
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = searchInput.value.trim().toLowerCase();
            document.querySelectorAll('.data-row').forEach(function (row) {
                var nama = row.querySelector('.data-name').textContent.toLowerCase();
                var alamat = row.querySelector('.data-address').textContent.toLowerCase();
                row.style.display = (nama.includes(q) || alamat.includes(q)) ? '' : 'none';
            });
        });
    }
})();
</script>
@endpush
