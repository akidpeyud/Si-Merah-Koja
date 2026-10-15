@extends('layouts.dashboard')

@section('title', 'Input Rekap Objek Kebakaran')

@push('styles')
<style>
    :root {
        --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
        --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22,58,99,.08);
        --paper: #f5f7fa; --white: #ffffff;
        --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220,53,69,.09);
        --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37,99,235,.09);
        --steel: #64748b; --steel-soft: #94a3b8;
        --line: #e2e8f0; --line-dark: #cbd5e1;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
        --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
        --sidebar-w: 272px; --topbar-h: 70px;
        --shadow-xs: 0 1px 2px rgba(13,27,42,.04);
        --shadow-sm: 0 4px 12px rgba(13,27,42,.06);
        --shadow-md: 0 10px 25px rgba(13,27,42,.08);
        --shadow-lg: 0 20px 45px rgba(13,27,42,.14);
    }
    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13,27,42,.16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
    .section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; letter-spacing: -.01em; white-space: nowrap; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; margin-bottom: 38px; }
    .stat-card { display: flex; flex-direction: column; align-items: flex-start; padding: 18px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); text-align: left; width: 100%; transition: box-shadow .2s, border-color .2s, transform .2s; }
    .stat-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; transform: translateY(-3px); }
    .stat-card.picked { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .stat-ico { width: 40px; height: 40px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1rem; margin-bottom: 14px; }
    .stat-title { font-size: .74rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; line-height: 1.4; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; letter-spacing: -.01em; }
    .ic-red { background: var(--signal-soft); color: var(--signal-dark); }
    .ic-amber { background: rgba(244,183,64,.16); color: #a8700b; }
    .ic-blue { background: var(--info-soft); color: var(--info); }
    .ic-teal { background: rgba(13,148,136,.10); color: #0d9488; }
    .ic-purple { background: rgba(124,58,237,.10); color: #7c3aed; }
    .ic-pink { background: rgba(219,39,119,.10); color: #db2777; }
    .ic-steel { background: rgba(100,116,139,.10); color: #64748b; }
    .panel { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; margin-bottom: 38px; }
    .panel-head { padding: 18px 24px; border-bottom: 1px solid var(--line); background: var(--navy-light); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .panel-head h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; display: flex; align-items: center; gap: 10px; }
    .panel-head h4 i { color: var(--navy); }
    .panel-body { padding: 24px; }
    .f-label { display: block; font-size: .8rem; font-weight: 700; margin-bottom: 6px; }
    .f-label .req { color: var(--signal); }
    .f-control { width: 100%; height: 46px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    textarea.f-control { height: auto; padding: 12px 14px; resize: vertical; min-height: 92px; }
    .f-control:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .f-hint { font-size: .76rem; color: var(--steel); margin-top: 5px; }
    .f-error { font-size: .78rem; color: var(--signal-dark); margin-top: 5px; font-weight: 600; }
    .f-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px; }
    .c-3 { grid-column: span 3; }
    .c-4 { grid-column: span 4; }
    .c-6 { grid-column: span 6; }
    .c-8 { grid-column: span 8; }
    .c-12 { grid-column: span 12; }
    @media (max-width: 900px) {
        .c-3, .c-4, .c-6, .c-8 { grid-column: span 12; }
    }
    .form-foot { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 24px; border-top: 1px solid var(--line); background: #fbfcfd; flex-wrap: wrap; }
    .btn-main, .btn-ghost { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; border-radius: 8px; font-weight: 600; font-size: .92rem; transition: all .2s ease; }
    .btn-main { background: var(--navy); color: #fff; }
    .btn-main:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13,27,42,.15); }
    .btn-ghost { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
    .btn-ghost:hover { background: #f8fafc; border-color: var(--steel-soft); }
    .btn-main:active, .btn-ghost:active { transform: scale(.97); }
    .tbl-wrap { overflow-x: auto; }
    .tbl { width: 100%; border-collapse: collapse; font-size: .88rem; min-width: 680px; }
    .tbl th { text-align: left; padding: 16px; font-family: var(--font-display); font-size: 13px; font-weight: 700; letter-spacing: .02em; color: var(--ink-3); background: #f8fafc; border-bottom: 1px solid var(--line); white-space: nowrap; }
    .tbl td { padding: 16px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .tbl tr:last-child td { border-bottom: 0; }
    .tbl tbody tr:hover { background: var(--paper); }
    .tag { display: inline-flex; align-items: center; gap: 7px; padding: 4px 11px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: var(--navy-soft); color: var(--navy); }
    .num { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; }
    .btn-icon { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; background: var(--signal-soft); color: var(--signal); transition: background .2s; }
    .btn-icon:hover { background: #fecaca; }
    .empty { padding: 44px 20px; text-align: center; color: var(--steel); }
    .empty i { font-size: 1.6rem; color: var(--steel-soft); margin-bottom: 10px; display: block; }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { padding: 0 14px; gap: 10px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 14px 50px; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
        .panel-body { padding: 18px; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
@php
    /* HAK AKSES INPUT/HAPUS REKAP: hanya Damtan & Super User. Role lain hanya boleh lihat & cetak. */
    if (!Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
        abort(403, 'Anda tidak memiliki hak akses untuk menginput atau menghapus rekap objek kebakaran. Role Anda hanya dapat melihat dan mencetak.');
    }
@endphp

@section('content')

        <div class="page-head">
            <h1>Input Rekap Objek Kebakaran</h1>
            <p>Bagian Pemadaman &amp; Penyelamatan - Disdamkartan Kota Jambi. Data yang disimpan di sini tampil sebagai angka di halaman publik.</p>
        </div>

        <!-- TOTAL PER KATEGORI -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-chart-simple"></i></span>
            <h3>Total saat ini</h3>
            <span class="line"></span>
        </div>
        <div class="stats-grid">
            @foreach($kategori as $key => [$nama, $ikon, $warna])
                <button type="button" class="stat-card" data-pick="{{ $key }}" aria-label="Isi form untuk {{ $nama }}">
                    <div class="stat-ico {{ $warna }}"><i class="fas {{ $ikon }}"></i></div>
                    <div class="stat-title">{{ $nama }}</div>
                    <div class="stat-value">{{ number_format($totals[$key] ?? 0, 0, ',', '.') }}</div>
                </button>
            @endforeach
        </div>

        <!-- FORM INPUT -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-pen-to-square"></i></span>
            <h3>Tambah data objek</h3>
            <span class="line"></span>
        </div>

        <form action="/internal/damtan/rekap-objek" method="POST" class="panel" id="rekapForm" novalidate>
            @csrf
            <div class="panel-head">
                <h4><i class="fas fa-house-chimney-crack"></i> Data Objek Terbakar</h4>
            </div>
            <div class="panel-body">
                <div class="f-grid">
                    <div class="c-4">
                        <label class="f-label" for="tanggal">Tanggal <span class="req">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="f-control" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                        @error('tanggal')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-4">
                        <label class="f-label" for="kategori">Objek Terbakar <span class="req">*</span></label>
                        <select id="kategori" name="kategori" class="f-control" required>
                            <option value="">-- Pilih objek terbakar --</option>
                            @foreach($kategori as $key => [$nama])
                                <option value="{{ $key }}" {{ old('kategori') === $key ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-4">
                        <label class="f-label" for="jumlah">Jumlah <span class="req">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" class="f-control" min="1" max="9999" value="{{ old('jumlah', 1) }}" required>
                        <div class="f-hint">Jumlah kejadian pada tanggal ini.</div>
                        @error('jumlah')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-6">
                        <label class="f-label" for="kecamatan">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="f-control" placeholder="Cth: Kota Baru" value="{{ old('kecamatan') }}">
                        @error('kecamatan')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-6">
                        <label class="f-label" for="lokasi">Lokasi / alamat</label>
                        <input type="text" id="lokasi" name="lokasi" class="f-control" placeholder="Cth: Jl. Sultan Thaha, RT 05" value="{{ old('lokasi') }}">
                        @error('lokasi')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="c-12">
                        <label class="f-label" for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="f-control" placeholder="Catatan singkat penanganan (opsional)">{{ old('keterangan') }}</textarea>
                        @error('keterangan')<div class="f-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="form-foot">
                <button type="reset" class="btn-ghost"><i class="fas fa-rotate-left"></i> Kosongkan</button>
                <button type="submit" class="btn-main"><i class="fas fa-floppy-disk"></i> Simpan rekap</button>
            </div>
        </form>

        <!-- RIWAYAT -->
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-clock-rotate-left"></i></span>
            <h3>Riwayat input objek terbaru</h3>
            <span class="line"></span>
        </div>

        <div class="panel">
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Objek Terbakar</th>
                            <th>Jumlah</th>
                            <th>Kecamatan</th>
                            <th>Keterangan</th>
                            <th style="width:60px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $r)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</td>
                                <td><span class="tag">{{ $kategori[$r->kategori][0] ?? $r->kategori }}</span></td>
                                <td><span class="num">{{ $r->jumlah }}</span></td>
                                <td>{{ $r->kecamatan ?: '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($r->keterangan ?: '-', 60) }}</td>
                                <td>
                                    <!-- HAK AKSES DELETE HANYA UNTUK DAMTAN DAN SUPER USER -->
                                    @hasanyrole('Damtan|Super User')
                                    <form action="/internal/damtan/rekap-objek/{{ $r->id }}" method="POST" onsubmit="return confirm('Hapus data rekap ini?')" style="margin:0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon" aria-label="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endhasanyrole
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6">
                                <div class="empty"><i class="fas fa-inbox"></i>Belum ada data. Pilih objek terbakar di atas lalu simpan rekap pertama.</div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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

    /* Klik kartu total = pilih objek di form */
    var select = document.getElementById('kategori');
    var cards = document.querySelectorAll('[data-pick]');
    cards.forEach(function (c) {
        c.addEventListener('click', function () {
            select.value = c.dataset.pick;
            cards.forEach(function (o) { o.classList.toggle('picked', o === c); });
            document.getElementById('rekapForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(function () { document.getElementById('jumlah').focus(); }, 350);
        });
    });
    select.addEventListener('change', function () {
        cards.forEach(function (o) { o.classList.toggle('picked', o.dataset.pick === select.value); });
    });

    /* Validasi ringan sebelum kirim */
    document.getElementById('rekapForm').addEventListener('submit', function (e) {
        if (!select.value) { e.preventDefault(); select.focus(); alert('Pilih objek terbakar dulu.'); }
    });
})();
</script>
@endpush
