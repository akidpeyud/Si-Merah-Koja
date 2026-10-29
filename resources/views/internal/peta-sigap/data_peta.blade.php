@extends('layouts.dashboard')

@section('title', 'Kelola Data Peta SIGAP')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    .topbar {
        position: sticky; top: 0; z-index: 1020;
        height: var(--topbar-h);
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 0 28px;
        background: var(--ink);
        border-bottom: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
    }
    .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: #fff; color: var(--ink);
        display: grid; place-items: center;
        font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
    }
    .user-meta strong {
        font-size: .84rem; font-weight: 700; max-width: 160px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff;
    }
    .btn-logout {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px;
        background: #fff; color: var(--ink);
        font-weight: 600; font-size: .84rem; border: none;
        transition: background .2s, color .2s, transform .1s, box-shadow .2s;
    }
    .sidebar {
        width: var(--sidebar-w); flex: none;
        position: sticky; top: var(--topbar-h);
        height: calc(100vh - var(--topbar-h));
        overflow-y: auto; overflow-x: hidden;
        background: #fff; border-right: 1px solid var(--line);
        padding: 20px 14px 32px;
        scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
    }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label {
        flex: 1 1 auto; min-width: 0;
        white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4;
    }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    
    .btn-tambah, .btn-export-pdf, .btn-export-excel { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
    .btn-tambah { background: var(--success); color: #fff; }
    .btn-tambah:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }
    
    .btn-export-pdf { background: var(--signal, #dc3545); color: white; }
    .btn-export-pdf:hover { background: #b42332; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(220, 53, 69, .15); color: white; }
    
    .btn-export-excel { background: #fff; color: #1d6f42; border: 1.5px solid #1d6f42; }
    .btn-export-excel:hover { background: #1d6f42; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(29, 111, 66, .18); }

    /* ---------- Penghitung Statistik Peta SIGAP ---------- */
        .rekap-grid { display: grid; grid-template-columns: minmax(210px, 1.2fr) repeat(3, minmax(0, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    
        .rekap-total { grid-row: span 2; flex-direction: column; align-items: flex-start; justify-content: center; gap: 18px; padding: 24px; background: var(--ink); border-color: var(--ink); }
    .rekap-total .rekap-ico { width: 48px; height: 48px; background: rgba(255,255,255,.12); color: #fff; font-size: 1.2rem; }
    .rekap-total .rekap-num { font-size: 2.8rem; color: #fff; }
    .rekap-total .rekap-label { color: rgba(255,255,255,.85); }
    .rekap-total .rekap-sub { color: rgba(255,255,255,.6); }
        .rekap-sumber_air    { border-left-color: #0891b2; }
    .rekap-sumber_air    .rekap-ico { background: rgba(8, 145, 178, 0.12); color: #0891b2; }
    .rekap-hydrant       { border-left-color: #dc2626; }
    .rekap-hydrant       .rekap-ico { background: rgba(220, 38, 38, 0.12); color: #dc2626; }
    .rekap-hydrant_pilar { border-left-color: #2563eb; }
    .rekap-hydrant_pilar .rekap-ico { background: rgba(37, 99, 235, 0.12); color: #2563eb; }
    .rekap-water_truck   { border-left-color: #eab308; }
    .rekap-water_truck   .rekap-ico { background: rgba(234, 179, 8, 0.18); color: #ca8a04; }
    .rekap-pos           { border-left-color: #64748b; }
    .rekap-pos           .rekap-ico { background: rgba(100, 116, 139, 0.12); color: #64748b; }
    .rekap-zona_rawan_tinggi { border-left-color: #dc2626; }
    .rekap-zona_rawan_tinggi .rekap-ico { background: rgba(220, 38, 38, 0.12); color: #dc2626; }
    .rekap-zona_rawan_sedang { border-left-color: #f59e0b; }
    .rekap-zona_rawan_sedang .rekap-ico { background: rgba(245, 158, 11, 0.15); color: #d97706; }
    .rekap-zona_rawan    { border-left-color: #f97316; }
    .rekap-zona_rawan    .rekap-ico { background: rgba(249, 115, 22, 0.12); color: #f97316; }

    .card-container { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .card-container:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }

    .badge-custom {
        padding: 5px 12px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        display: inline-flex;
        align-items: center;
    }
        .bg-sumber_air { background-color: rgba(8, 145, 178, 0.1); color: #0e7490; }
    .bg-hydrant { background-color: rgba(220, 38, 38, 0.1); color: #dc2626; }
    .bg-hydrant_pilar { background-color: rgba(37, 99, 235, 0.1); color: #2563eb; }
    .bg-water_truck { background-color: rgba(234, 179, 8, 0.18); color: #a16207; }
    .bg-pos { background-color: rgba(100, 116, 139, 0.1); color: #475569; }
    .bg-zona_rawan_tinggi { background-color: rgba(220, 38, 38, 0.12); color: #dc2626; }
    .bg-zona_rawan_sedang { background-color: rgba(245, 158, 11, 0.18); color: #b45309; }
    .bg-zona_rawan { background-color: rgba(249, 115, 22, 0.12); color: #c2410c; }

    .btn-action-group { display: flex; align-items: center; justify-content: center; gap: 6px; }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 6px;
        border: none;
        font-size: .9rem;
        transition: all 0.2s;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }

    div.dataTables_wrapper div.dataTables_filter input {
        border-radius: 8px;
        border: 1px solid var(--line-dark);
        padding: 6px 12px;
        min-height: 40px;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus {
        outline: none;
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .page-item.active .page-link {
        background-color: var(--navy);
        border-color: var(--navy);
    }

    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .card-container { padding: 14px; }
    }

    /* ---------- Kepala kartu & filter tabel ---------- */
    .card-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; padding-bottom: 16px; border-bottom: 1px solid var(--line); }
    .card-head h2 { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--ink); margin: 0; }
    .card-head p { margin: 2px 0 0; font-size: .82rem; color: var(--steel); }
    div.dataTables_wrapper > .row:first-child { margin-bottom: 14px; row-gap: 10px; align-items: center; }
    div.dataTables_wrapper div.dataTables_length label { display: inline-flex; align-items: center; gap: 8px; margin: 0; font-size: .85rem; color: var(--steel); font-weight: 600; }
    div.dataTables_wrapper div.dataTables_length select { min-height: 38px; border-radius: 8px; border: 1px solid var(--line-dark); }
    div.dataTables_wrapper div.dataTables_filter { display: flex; justify-content: flex-end; }
    .filter-bar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }
    .filter-search { position: relative; }
    .filter-search i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .8rem; pointer-events: none; }
    .filter-search input { padding-left: 34px; min-width: 240px; min-height: 40px; border-radius: 8px; border: 1px solid var(--line-dark); }
    .filter-bar select { min-height: 40px; min-width: 190px; border-radius: 8px; border: 1px solid var(--line-dark); }
    .coord { font-size: .76rem; color: var(--steel); }
    .table tbody td .nama-titik { font-weight: 700; line-height: 1.35; }
    .btn-action-group form { margin: 0; }
    div.dataTables_wrapper div.dataTables_info, div.dataTables_wrapper div.dataTables_paginate { font-size: .85rem; color: var(--steel); }
    div.dataTables_wrapper > .row:last-child { margin-top: 14px; row-gap: 10px; align-items: center; }

    @media (max-width: 1100px) {
        .rekap-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .rekap-total { grid-column: 1 / -1; grid-row: auto; flex-direction: row; align-items: center; gap: 16px; padding: 18px 20px; }
        .rekap-total .rekap-num { font-size: 2.2rem; }
    }
    @media (max-width: 700px) {
        .rekap-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .rekap-item { padding: 12px 14px; gap: 10px; }
        .rekap-ico { width: 36px; height: 36px; }
        .rekap-num { font-size: 1.4rem; }
        div.dataTables_wrapper div.dataTables_filter, .filter-bar { justify-content: flex-start; }
        .filter-search, .filter-search input, .filter-bar select { width: 100%; min-width: 0; }
        .filter-bar { width: 100%; }
    }
</style>
@endpush

@section('content')
@php
    // Ikon & keterangan singkat per kategori (label diambil dari TitikSigap::KATEGORI)
    $kategoriMeta = [
        'sumber_air'    => ['ikon' => 'fa-water',                'sub' => 'Titik suplai air'],
        'hydrant'       => ['ikon' => 'fa-faucet-drip',          'sub' => 'Hydrant kota'],
        'hydrant_pilar' => ['ikon' => 'fa-faucet-drip',          'sub' => 'Hydrant pilar'],
        'water_truck'   => ['ikon' => 'fa-truck-droplet',        'sub' => 'Suplai mobil tangki'],
        'pos'           => ['ikon' => 'fa-building-shield',      'sub' => 'Kantor & Sektor'],
        'zona_rawan'    => ['ikon' => 'fa-fire-flame-curved',    'sub' => 'Buffer 1.2 km / 800 m'],
    ];
    $listTitik  = collect($titikSigaps ?? []);
    $jumlah     = $listTitik->countBy('kategori');
    $totalTitik = collect(array_keys(\App\Models\TitikSigap::KATEGORI))->sum(fn ($k) => $jumlah[$k] ?? 0);
    $jmlLama    = $listTitik->count() - $totalTitik; // titik berkategori lama (kebakaran / penyelamatan)
@endphp

        <!-- Semua pegawai yang tergabung bisa membuka dan melihat halaman ini -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')
        <div class="page-head">
            <div>
                <h1>Kelola Data Titik Peta SIGAP</h1>
                <p>Manajemen data lokasi operasional seperti hydrant, water truck, sumber air, pos damkar, dan zona rawan kebakaran.</p>
            </div>
            
            <!-- Tombol Tambah, PDF, dan Excel dibungkus dalam flexbox agar sejajar rapi -->
            <div class="d-flex gap-2 flex-wrap">
                <!-- Tombol Export PDF -->
                <a href="{{ url('/internal/peta-sigap/export-pdf') }}" class="btn-export-pdf">
                    <i class="fas fa-file-pdf me-1"></i> Cetak PDF
                </a>
                
                <!-- Tombol Export Excel -->
                <a href="{{ url('/internal/peta-sigap/export-excel') }}" class="btn-export-excel">
                    <i class="fas fa-file-excel me-1"></i> Cetak Excel
                </a>

                <!-- Tombol Tambah Titik Baru HANYA untuk Super User & Operator -->
                @hasanyrole('Super User|Operator')
                <a href="/internal/peta-sigap/input" class="btn-tambah text-decoration-none">
                    <i class="fas fa-plus me-1"></i> Tambah Titik Baru
                </a>
                @endhasanyrole
            </div>
        </div>

        <!-- REKAP GRID STATISTIK -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-map-marked-alt"></i></div>
                <div>
                    <div class="rekap-num">{{ $totalTitik }}</div>
                    <div class="rekap-label">Total Titik</div>
                    <div class="rekap-sub">Terdaftar di peta</div>
                </div>
            </div>
            @foreach (\App\Models\TitikSigap::KATEGORI as $key => $label)
            <div class="rekap-item rekap-{{ $key }}">
                <div class="rekap-ico"><i class="fas {{ $kategoriMeta[$key]['ikon'] }}"></i></div>
                <div>
                    <div class="rekap-num">{{ $jumlah[$key] ?? 0 }}</div>
                    <div class="rekap-label">{{ $label }}</div>
                    <div class="rekap-sub">{{ $kategoriMeta[$key]['sub'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        @if ($jmlLama > 0)
            <div class="alert alert-warning" style="border-radius: 8px;">
                <i class="fas fa-exclamation-triangle me-1"></i>
                Ada <strong>{{ $jmlLama }}</strong> titik berkategori lama (Kebakaran / Penyelamatan) yang tidak tampil di peta publik.
                Ubah kategorinya lewat tombol Edit, atau hapus jika tidak diperlukan.
            </div>
        @endif

        <div class="card-container">
            <div class="card-head">
                <div>
                    <h2>Daftar Titik</h2>
                    <p>{{ $listTitik->count() }} data tersimpan</p>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tabelTitik" class="table align-middle border-0 mb-0 w-100">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="18%">Kategori</th>
                            <th width="27%">Nama / Judul</th>
                            <th width="30%">Lokasi</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($titikSigaps as $index => $titik)
                            <tr>
                                <td class="text-center fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td data-search="{{ $titik->kategori }} {{ $titik->tingkat_risiko }}">
                                    @if (isset($kategoriMeta[$titik->kategori]))
                                        <span class="badge-custom bg-{{ $titik->kategori }}"><i class="fas {{ $kategoriMeta[$titik->kategori]['ikon'] }} me-1"></i> {{ $titik->kategori_label }}</span>
                                        @if ($titik->kategori === 'zona_rawan' && $titik->tingkat_risiko)
                                            <div class="mt-1">
                                                <span class="badge-custom {{ $titik->tingkat_risiko === 'Tinggi' ? 'bg-danger text-white' : 'bg-warning text-dark' }}" style="font-size: 0.68rem; padding: 2px 7px;">
                                                    Risiko {{ $titik->tingkat_risiko }}
                                                </span>
                                            </div>
                                        @endif
                                    @else
                                        <span class="badge-custom" style="background: #e2e8f0; color: #475569;" title="Kategori lama, tidak tampil di peta publik">{{ $titik->kategori_label }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="nama-titik">{{ $titik->nama }}</div>
                                    <small class="coord"><i class="fas fa-location-dot"></i> {{ $titik->latitude }}, {{ $titik->longitude }}</small>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 250px;" title="{{ $titik->lokasi }}">
                                        {{ $titik->lokasi }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-action-group">
                                        @hasanyrole('Super User|Operator')
                                        <!-- Tombol Edit -->
                                        <a href="{{ url('/internal/peta-sigap/edit/' . $titik->id) }}" class="btn-action btn-edit" title="Edit Data" aria-label="Edit {{ $titik->nama }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ url('/internal/peta-sigap/hapus/' . $titik->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus titik ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Data" aria-label="Hapus {{ $titik->nama }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @else
                                            <span class="text-muted" style="font-size: 0.8rem;"><i>Hanya Lihat</i></span>
                                        @endhasanyrole
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-lock me-2"></i> Anda tidak memiliki akses untuk melihat halaman ini.
        </div>
        @endhasanyrole
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Opsi filter kategori (dari TitikSigap::KATEGORI) ---------- */
    var kategoriList = @json(\App\Models\TitikSigap::KATEGORI);
    var opsiKategori = Object.keys(kategoriList).map(function (k) {
        return '<option value="' + k + '">' + kategoriList[k] + '</option>';
    }).join('');

    /* ---------- Inisialisasi DataTables ---------- */
    $(document).ready(function() {
        $('#tabelTitik').DataTable({
            responsive: true,
            language: {
                lengthMenu: "Tampilkan _MENU_ entri per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total entri)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                { orderable: false, targets: 4 } // Menonaktifkan sorting pada kolom aksi
            ],
            initComplete: function () {
                var api = this.api();
                
                // Mengganti kotak pencarian bawaan dengan kolom cari + dropdown kategori
                $('.dataTables_filter').html(
                    '<div class="filter-bar">' +
                        '<div class="filter-search"><i class="fas fa-search"></i>' +
                            '<input id="cariTabel" type="search" class="form-control form-control-sm" placeholder="Cari nama atau lokasi..." aria-label="Cari titik">' +
                        '</div>' +
                        '<select id="filterKategori" class="form-select form-select-sm" aria-label="Filter kategori">' +
                            '<option value="">Semua Kategori</option>' +
                            opsiKategori +
                        '</select>' +
                    '</div>'
                );

                // Pencarian teks bebas
                $('#cariTabel').on('input', function () {
                    api.search(this.value).draw();
                });

                // Menerapkan pencarian/filter ketika dropdown dipilih
                $('#filterKategori').on('change', function () {
                    var val = $(this).val(); // nilai kategori, cocok persis dengan data-search di kolom
                    
                    // Angka 1 di bawah ini mewakili Indeks Kolom "Kategori" (Kolom ke-2)
                    api.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
                });
            }
        });
    });
})();
</script>
@endpush