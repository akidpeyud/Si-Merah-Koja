@extends('layouts.dashboard')

@section('title', 'Input Rekap Layanan & Penyelamatan')

@push('styles')
<style>
    :root {
        --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
        --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
        --paper: #f5f7fa; --white: #ffffff;
        --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
        --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
        --steel: #64748b; --steel-soft: #94a3b8;
        --line: #e2e8f0; --line-dark: #cbd5e1;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
        --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
        --sidebar-w: 272px; --topbar-h: 70px;
        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
        --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);

        /* Warna tabel riwayat (sama dengan halaman Kelola lainnya) */
        --rekap-row-a: #eaf2fc;
        --rekap-row-b: #f8fbff;
        --rekap-line: #d3deee;
    }
    .toast-wrap { position: fixed; z-index: 9999; top: 20px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); pointer-events: none; }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-lg); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; pointer-events: auto; }
    @keyframes toastIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: none; } }
    @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-20px); } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }

    /* ==========================================================
       JUDUL HALAMAN & FILTER
       ========================================================== */
    .page-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 32px; padding-bottom: 20px; border-bottom: 1px solid var(--line); }
    .page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 6px; color: var(--ink); }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; max-width: 650px; }

    .filter-year-group {
        display: inline-flex;
        align-items: center;
        background: var(--white);
        padding: 5px 6px;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        box-shadow: var(--shadow-xs);
        gap: 8px;
    }
    .filter-year-group .label-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 0 8px 0 10px;
        font-size: .8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: var(--steel);
        white-space: nowrap;
    }
    .filter-year-group .label-wrap i { color: var(--navy); }
    .filter-year-select {
        height: 38px;
        padding: 0 32px 0 12px;
        font-family: var(--font-body);
        font-size: .88rem;
        font-weight: 600;
        color: var(--ink);
        background-color: #f8fafc;
        border: 1px solid var(--line);
        border-radius: 8px;
        cursor: pointer;
        transition: all .2s ease;
    }
    .filter-year-select:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
    }
    .filter-year-select:focus {
        background-color: #fff;
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(22, 58, 99, .12);
        outline: none;
    }
    .btn-filter-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        height: 38px;
        padding: 0 14px;
        font-size: .84rem;
        font-weight: 600;
        color: var(--signal-dark);
        background: #fff;
        border: 1px solid #fecaca;
        border-radius: 8px;
        text-decoration: none;
        white-space: nowrap;
        transition: all .2s ease;
    }
    .btn-filter-reset:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #991b1b;
    }
    .btn-filter-reset:active {
        transform: scale(.97);
    }

    /* ==========================================================
       JUDUL SEKSI
       ========================================================== */
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
    .section-heading-ico { flex: none; width: 30px; height: 30px; border-radius: 8px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .75rem; }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: .98rem; letter-spacing: -.005em; white-space: nowrap; margin: 0; color: var(--ink); }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: var(--line); }

    /* ==========================================================
       KARTU TOTAL
       ========================================================== */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; margin-bottom: 40px; }
    .stat-card { position: relative; display: flex; flex-direction: column; align-items: flex-start; padding: 20px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); text-align: left; width: 100%; overflow: hidden; transition: box-shadow .2s, border-color .2s, transform .2s; }
    .stat-card::before { content: ''; position: absolute; left: 0; right: 0; top: 0; height: 3px; background: var(--navy); opacity: 0; transition: opacity .2s; }
    .stat-card:hover { box-shadow: var(--shadow-md); border-color: #c9d3e0; transform: translateY(-3px); }
    .stat-card:hover::before { opacity: 1; }
    .stat-card.picked { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .stat-card.picked::before { opacity: 1; }
    /* Kartu read-only (role selain Damtan & Super User): tidak bisa diklik, tanpa efek hover */
    .stat-card-readonly { cursor: default; }
    .stat-card-readonly:hover { transform: none; box-shadow: var(--shadow-xs); border-color: var(--line); }
    .stat-card-readonly:hover::before { opacity: 0; }
    .stat-ico { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; font-size: 1rem; margin-bottom: 16px; }
    .stat-title { font-size: .72rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--steel); margin-bottom: 8px; line-height: 1.4; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.9rem; line-height: 1; letter-spacing: -.02em; color: var(--ink); }
    .ic-red { background: var(--signal-soft); color: var(--signal-dark); }
    .ic-amber { background: rgba(244,183,64,.16); color: #a8700b; }
    .ic-blue { background: var(--info-soft); color: var(--info); }
    .ic-teal { background: rgba(13,148,136,.10); color: #0d9488; }
    .ic-purple { background: rgba(124,58,237,.10); color: #7c3aed; }
    .ic-pink { background: rgba(219,39,119,.10); color: #db2777; }
    .ic-steel { background: #f1f5f9; color: var(--steel); }

    /* ==========================================================
       PANEL & FORMULIR
       ========================================================== */
    .panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; margin-bottom: 40px; }
    .panel-head { position: relative; padding: 20px 24px 20px 28px; border-bottom: 1px solid var(--line); background: #fff; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .panel-head::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--navy); }
    .panel-head h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; display: flex; align-items: center; gap: 10px; margin: 0; color: var(--ink); }
    .panel-head h4 i { color: var(--navy); }
    .panel-sub { margin: 4px 0 0; font-size: .82rem; color: var(--steel); }
    .panel-legend { font-size: .78rem; color: var(--steel); }
    .panel-legend .req { color: var(--signal); font-weight: 700; }
    .panel-body { padding: 26px 24px; }

    .f-label { display: block; font-size: .8rem; font-weight: 700; margin-bottom: 7px; color: var(--ink-2); }
    .f-label .req { color: var(--signal); }
    .f-control { width: 100%; height: 44px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .9rem; color: var(--ink); transition: border-color .2s, box-shadow .2s, background .2s; }
    textarea.f-control { height: auto; padding: 12px 14px; resize: vertical; min-height: 96px; }
    .f-control::placeholder { color: var(--steel-soft); }
    .f-control:hover { border-color: var(--steel-soft); }
    .f-control:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .f-hint { font-size: .76rem; color: var(--steel); margin-top: 5px; }
    .f-error { font-size: .78rem; color: var(--signal-dark); margin-top: 5px; font-weight: 600; }
    .f-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 20px 18px; }
    .c-3 { grid-column: span 3; }
    .c-4 { grid-column: span 4; }
    .c-6 { grid-column: span 6; }
    .c-8 { grid-column: span 8; }
    .c-12 { grid-column: span 12; }
    @media (max-width: 900px) {
        .c-3, .c-4, .c-6, .c-8 { grid-column: span 12; }
    }
    .form-foot { display: flex; justify-content: flex-end; gap: 10px; padding: 16px 24px; border-top: 1px solid var(--line); background: #f8fafc; flex-wrap: wrap; }
    .btn-main, .btn-ghost { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; border-radius: 8px; font-weight: 600; font-size: .92rem; transition: all .2s ease; cursor: pointer; }
    .btn-main { background: var(--navy); color: #fff; border: 0; box-shadow: 0 1px 2px rgba(13,27,42,.12); }
    .btn-main:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13,27,42,.18); color: #fff; }
    .btn-ghost { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
    .btn-ghost:hover { background: #f1f5f9; border-color: var(--steel-soft); }
    .btn-main:active, .btn-ghost:active { transform: scale(.97); }

    /* ==========================================================
       TABEL RIWAYAT (gaya navy, sama persis dengan Kelola Data Laporan)
       ========================================================== */
    .tbl-scroll { overflow-x: auto; padding: 20px; background: #fff; }
    .tbl-frame { min-width: 860px; border: 2px solid var(--navy); border-radius: 16px; overflow: hidden; background: #fff; box-shadow: var(--shadow-sm); }
    .tbl { width: 100%; border-collapse: collapse; margin: 0; }
    .tbl thead th {
        background: linear-gradient(180deg, var(--navy) 0%, var(--navy-dark) 100%);
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .88rem;
        letter-spacing: .02em;
        text-align: center;
        vertical-align: middle;
        padding: 14px 12px;
        border: 0;
        border-right: 1px solid rgba(255,255,255,.22);
        white-space: nowrap;
    }
    .tbl thead th:last-child { border-right: 0; }
    .tbl tbody td {
        background: var(--rekap-row-b);
        text-align: center;
        vertical-align: middle;
        padding: 12px 10px;
        font-size: .85rem;
        line-height: 1.4;
        color: var(--ink-2);
        border-bottom: 1px solid var(--rekap-line);
        border-right: 1px solid var(--rekap-line);
    }
    .tbl tbody td:last-child { border-right: 0; }
    .tbl tbody tr:last-child td { border-bottom: 0; }
    .tbl tbody tr:nth-child(even) td { background: var(--rekap-row-a); }
    .tbl tbody tr:hover td { background: #dce9fa; }
    .tbl tbody td.no-cell {
        background: linear-gradient(180deg, var(--navy) 0%, var(--navy-dark) 100%) !important;
        color: #fff;
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.3rem;
        border-right: 1px solid rgba(255,255,255,.22);
    }
    .col-no { width: 64px; }
    .col-aksi { width: 110px; }
    .cell-strong { font-weight: 600; color: var(--ink); }
    .cell-ket { max-width: 240px; }
    .tag { display: inline-flex; align-items: center; gap: 7px; padding: 4px 12px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: #fff; color: var(--navy); border: 1px solid #c3d3e6; }
    .num { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); }

    .aksi { display: flex; align-items: center; justify-content: center; gap: 6px; }
    .aksi form { margin: 0; display: flex; }
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; cursor: pointer; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.18); color: #d97706; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.3); }
    .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); }
    .action-btn.delete:hover { background-color: #fecaca; }

    .tbl tbody tr.empty-row td { padding: 0; background: #fff !important; border-right: 0; }
    .empty { padding: 52px 20px; text-align: center; color: var(--steel); }
    .empty i { font-size: 1.7rem; color: var(--steel-soft); margin-bottom: 10px; display: block; }

    /* ==========================================================
       MODAL EDIT
       ========================================================== */
    .edit-modal { position: fixed; inset: 0; z-index: 3000; display: none; align-items: center; justify-content: center; padding: 18px; background: rgba(13,27,42,.55); backdrop-filter: blur(2px); }
    .edit-modal.open { display: flex; }
    .edit-modal-box { background: #fff; width: 100%; max-width: 640px; max-height: calc(100vh - 36px); overflow-y: auto; border-radius: var(--r-md); box-shadow: var(--shadow-lg); animation: editPop .25s ease; }
    @keyframes editPop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    .edit-modal-head { position: relative; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 18px 22px 18px 26px; background: #fff; border-bottom: 1px solid var(--line); }
    .edit-modal-head::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--navy); }
    .edit-modal-head h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; display: flex; align-items: center; gap: 10px; margin: 0; color: var(--ink); }
    .edit-modal-head h4 i { color: var(--navy); }
    .edit-modal-x { background: transparent; border: 0; font-size: 1.1rem; color: var(--steel); cursor: pointer; width: 34px; height: 34px; border-radius: 8px; }
    .edit-modal-x:hover { background: rgba(13,27,42,.06); color: var(--ink); }
    .edit-modal-body { padding: 24px 22px; }

    @media (max-width: 700px) {
        .stats-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
        .panel-body { padding: 18px; }
        .tbl-scroll { padding: 12px; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
@php
    /* HAK AKSES INPUT/EDIT/HAPUS REKAP: hanya Damtan & Super User.
       Role lain tetap bisa membuka halaman ini, tetapi HANYA melihat kartu total
       (tanpa form, tanpa riwayat, tanpa edit/hapus, kartu tidak bisa diklik). */
    $bisaInput = Auth::user()->hasAnyRole(['Damtan', 'Super User']);
@endphp

        <div class="page-head">
            <div class="page-head-title">
                <h1>Input Rekap Layanan &amp; Penyelamatan</h1>
                <p>Data rekapitulasi penanganan kejadian kebakaran dan evakuasi/penyelamatan masyarakat.</p>
            </div>
            <div>
                <form method="GET" action="{{ url()->current() }}" id="filterTahunForm" class="filter-year-group m-0">
                    <span class="label-wrap">
                        <i class="fas fa-calendar-days"></i>
                        <span>Tahun</span>
                    </span>
                    <select name="tahun" id="filterTahun" class="filter-year-select" onchange="this.form.submit()" aria-label="Filter berdasarkan tahun">
                        <option value="">Semua Tahun</option>
                        @php
                            $opsiTahun = collect($tahunList ?? [])
                                ->push((int) date('Y'))
                                ->when($tahunTerpilih, fn($c) => $c->push($tahunTerpilih))
                                ->map(fn($t) => (int)$t)
                                ->unique()
                                ->sortDesc()
                                ->values();
                        @endphp
                        @foreach($opsiTahun as $thn)
                            <option value="{{ $thn }}" {{ (string) request('tahun') === (string) $thn ? 'selected' : '' }}>
                                {{ $thn }}
                            </option>
                        @endforeach
                    </select>
                    @if(request('tahun'))
                        <a href="{{ url()->current() }}" class="btn-filter-reset" title="Kembalikan ke semua tahun">
                            <i class="fas fa-rotate-left"></i>
                            <span>Reset</span>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- TOTAL PER KATEGORI -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-chart-simple"></i></span>
            <h3>Total saat ini</h3>
            <span class="line"></span>
        </div>
        <div class="stats-grid">
            @foreach($kategori as $key => [$nama, $ikon, $warna])
                @if($bisaInput)
                    <button type="button" class="stat-card" data-pick="{{ $key }}" aria-label="Isi form untuk {{ $nama }}">
                @else
                    <div class="stat-card stat-card-readonly">
                @endif
                        <div class="stat-ico {{ $warna }}"><i class="fas {{ $ikon }}"></i></div>
                        <div class="stat-title">{{ $nama }}</div>
                        <div class="stat-value">{{ number_format($totals[$key] ?? 0, 0, ',', '.') }}</div>
                @if($bisaInput)
                    </button>
                @else
                    </div>
                @endif
            @endforeach
        </div>

@if($bisaInput)
        <!-- FORM INPUT -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-pen-to-square"></i></span>
            <h3>Tambah data layanan</h3>
            <span class="line"></span>
        </div>

        <form action="/internal/damtan/rekap-layanan" method="POST" class="panel" id="rekapForm">
            @csrf
            <div class="panel-head">
                <div>
                    <h4><i class="fas fa-truck-medical"></i> Detail Layanan &amp; Penyelamatan</h4>
                    <p class="panel-sub">Isi data kejadian lalu simpan. Angka total di atas akan diperbarui otomatis.</p>
                </div>
                <span class="panel-legend"><span class="req">*</span> wajib diisi</span>
            </div>
            <div class="panel-body">
                <div class="f-grid">
                    <div class="c-4">
                        <label class="f-label" for="tanggal">Tanggal <span class="req">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="f-control" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                        @error('tanggal')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-4">
                        <label class="f-label" for="kategori">Jenis Layanan <span class="req">*</span></label>
                        <select id="kategori" name="kategori" class="f-control" required>
                            <option value="">-- Pilih jenis layanan --</option>
                            @foreach($kategori as $key => [$nama])
                                <option value="{{ $key }}" {{ old('kategori') === $key ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-4">
                        <label class="f-label" for="jumlah">Jumlah Kejadian <span class="req">*</span></label>
                        <input type="number" min="1" id="jumlah" name="jumlah" class="f-control" value="{{ old('jumlah', 1) }}" required>
                        <div class="f-hint">Jumlah kejadian pada tanggal ini.</div>
                        @error('jumlah')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-6">
                        <label class="f-label" for="kecamatan">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="f-control" placeholder="Cth: Kota Baru" value="{{ old('kecamatan') }}">
                    </div>

                    <div class="c-6">
                        <label class="f-label" for="lokasi">Lokasi / Alamat</label>
                        <input type="text" id="lokasi" name="lokasi" class="f-control" placeholder="Cth: Jl. Sultan Thaha, RT 05" value="{{ old('lokasi') }}">
                    </div>

                    <div class="c-12">
                        <label class="f-label" for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="f-control" rows="2" placeholder="Catatan singkat penanganan (opsional)">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-foot">
                <button type="reset" class="btn-ghost"><i class="fas fa-rotate-left"></i> Kosongkan</button>
                <button type="submit" class="btn-main"><i class="fas fa-floppy-disk"></i> Simpan Rekap</button>
            </div>
        </form>

        <!-- RIWAYAT -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-clock-rotate-left"></i></span>
            <h3>Riwayat input layanan terbaru</h3>
            <span class="line"></span>
        </div>

        <div class="panel">
            <div class="tbl-scroll">
                <div class="tbl-frame">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th>Tanggal</th>
                                <th>Jenis Layanan</th>
                                <th>Jumlah</th>
                                <th>Kecamatan</th>
                                <th>Keterangan</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $r)
                                <tr>
                                    <td class="no-cell">{{ $riwayat->firstItem() + $loop->index }}</td>
                                    <td class="cell-strong">{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</td>
                                    <td><span class="tag">{{ $kategori[$r->kategori][0] ?? $r->kategori }}</span></td>
                                    <td><span class="num">{{ $r->jumlah }}</span></td>
                                    <td>{{ $r->kecamatan ?: '-' }}</td>
                                    <td class="cell-ket">{{ \Illuminate\Support\Str::limit($r->keterangan ?: '-', 60) }}</td>
                                    <td>
                                        <div class="aksi">
                                            <button type="button" class="action-btn edit" aria-label="Edit" title="Edit Data"
                                                data-edit
                                                data-id="{{ $r->id }}"
                                                data-tanggal="{{ \Carbon\Carbon::parse($r->tanggal)->format('Y-m-d') }}"
                                                data-kategori="{{ $r->kategori }}"
                                                data-jumlah="{{ $r->jumlah }}"
                                                data-kecamatan="{{ $r->kecamatan }}"
                                                data-lokasi="{{ $r->lokasi }}"
                                                data-keterangan="{{ $r->keterangan }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="/internal/damtan/rekap-layanan/{{ $r->id }}" method="POST" onsubmit="return confirm('Hapus data rekap ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="action-btn delete" aria-label="Hapus" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row"><td colspan="7">
                                    <div class="empty"><i class="fas fa-inbox"></i>Belum ada data input. Pilih jenis layanan di atas lalu simpan rekap pertama.</div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FOOTER PAGINATION -->
            <div class="d-flex flex-wrap justify-content-between align-items-center p-3 border-top bg-white">
                <span class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $riwayat->firstItem() ?? 0 }} - {{ $riwayat->lastItem() ?? 0 }} dari total {{ $riwayat->total() }} data layanan
                </span>
                <div class="pagination-container mb-0">
                    {{ $riwayat->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <!-- MODAL EDIT -->
        <div class="edit-modal" id="editModal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
            <div class="edit-modal-box">
                <div class="edit-modal-head">
                    <h4 id="editModalTitle"><i class="fas fa-pen-to-square"></i> Edit Data Layanan</h4>
                    <button type="button" class="edit-modal-x" id="editClose" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
                </div>
                <form method="POST" id="editForm" action="">
                    @csrf
                    @method('PUT')
                    <div class="edit-modal-body">
                        <div class="f-grid">
                            <div class="c-6">
                                <label class="f-label" for="edit_tanggal">Tanggal <span class="req">*</span></label>
                                <input type="date" id="edit_tanggal" name="tanggal" class="f-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="c-6">
                                <label class="f-label" for="edit_jumlah">Jumlah Kejadian <span class="req">*</span></label>
                                <input type="number" min="1" id="edit_jumlah" name="jumlah" class="f-control" required>
                            </div>
                            <div class="c-12">
                                <label class="f-label" for="edit_kategori">Jenis Layanan <span class="req">*</span></label>
                                <select id="edit_kategori" name="kategori" class="f-control" required>
                                    <option value="">-- Pilih jenis layanan --</option>
                                    @foreach($kategori as $key => [$nama])
                                        <option value="{{ $key }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="c-6">
                                <label class="f-label" for="edit_kecamatan">Kecamatan</label>
                                <input type="text" id="edit_kecamatan" name="kecamatan" class="f-control" placeholder="Cth: Kota Baru">
                            </div>
                            <div class="c-6">
                                <label class="f-label" for="edit_lokasi">Lokasi / Alamat</label>
                                <input type="text" id="edit_lokasi" name="lokasi" class="f-control" placeholder="Cth: Jl. Sultan Thaha, RT 05">
                            </div>
                            <div class="c-12">
                                <label class="f-label" for="edit_keterangan">Keterangan</label>
                                <textarea id="edit_keterangan" name="keterangan" class="f-control" rows="3" placeholder="Catatan singkat penanganan (opsional)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-foot">
                        <button type="button" class="btn-ghost" id="editCancel">Batal</button>
                        <button type="submit" class="btn-main"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
@endif
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* Sidebar mobile */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    function closeSide() { document.body.classList.remove('side-open'); if (toggle) toggle.setAttribute('aria-expanded', 'false'); }
    if (toggle) toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('side-open');
        toggle.setAttribute('aria-expanded', open);
    });
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* Grup sidebar: hanya satu terbuka */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    /* Form hanya ada untuk Damtan & Super User; role lain berhenti di sini */
    var select = document.getElementById('kategori');
    var form = document.getElementById('rekapForm');
    if (!select || !form) return;

    /* Klik kartu total = pilih jenis layanan di form */
    var cards = document.querySelectorAll('[data-pick]');
    cards.forEach(function (c) {
        c.addEventListener('click', function () {
            select.value = c.dataset.pick;
            cards.forEach(function (o) { o.classList.toggle('picked', o === c); });
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(function () { document.getElementById('jumlah').focus(); }, 350);
        });
    });
    select.addEventListener('change', function () {
        cards.forEach(function (o) { o.classList.toggle('picked', o.dataset.pick === select.value); });
    });

    /* Validasi ringan sebelum kirim */
    form.addEventListener('submit', function (e) {
        if (!select.value) { e.preventDefault(); select.focus(); alert('Pilih jenis layanan dulu.'); }
    });

    /* ===== Modal edit ===== */
    var modal = document.getElementById('editModal');
    var editForm = document.getElementById('editForm');
    if (!modal || !editForm) return;

    function openEdit(btn) {
        var d = btn.dataset;
        editForm.action = '/internal/damtan/rekap-layanan/' + d.id;
        document.getElementById('edit_tanggal').value = d.tanggal || '';
        document.getElementById('edit_kategori').value = d.kategori || '';
        document.getElementById('edit_jumlah').value = d.jumlah || 1;
        document.getElementById('edit_kecamatan').value = d.kecamatan || '';
        document.getElementById('edit_lokasi').value = d.lokasi || '';
        document.getElementById('edit_keterangan').value = d.keterangan || '';
        modal.classList.add('open');
        setTimeout(function () { document.getElementById('edit_jumlah').focus(); }, 100);
    }
    function closeEdit() { modal.classList.remove('open'); }

    document.querySelectorAll('[data-edit]').forEach(function (b) {
        b.addEventListener('click', function () { openEdit(b); });
    });
    document.getElementById('editClose').addEventListener('click', closeEdit);
    document.getElementById('editCancel').addEventListener('click', closeEdit);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeEdit(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeEdit(); });

    editForm.addEventListener('submit', function (e) {
        if (!document.getElementById('edit_kategori').value) {
            e.preventDefault();
            document.getElementById('edit_kategori').focus();
            alert('Pilih jenis layanan dulu.');
        }
    });
})();
</script>
@endpush