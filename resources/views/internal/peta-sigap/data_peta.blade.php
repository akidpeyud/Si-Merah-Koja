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
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    
    .rekap-total        { border-left-color: var(--ink); }
    .rekap-total        .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-kebakaran    { border-left-color: #dc3545; }
    .rekap-kebakaran    .rekap-ico { background: rgba(220, 53, 69, 0.12); color: #dc3545; }
    .rekap-sumber_air   { border-left-color: #0d6efd; }
    .rekap-sumber_air   .rekap-ico { background: rgba(13, 110, 253, 0.12); color: #0d6efd; }
    .rekap-hydrant      { border-left-color: #198754; }
    .rekap-hydrant      .rekap-ico { background: rgba(25, 135, 84, 0.12); color: #198754; }
    .rekap-penyelamatan { border-left-color: #d97706; }
    .rekap-penyelamatan .rekap-ico { background: rgba(244, 183, 64, 0.15); color: #d97706; }
    .rekap-pos          { border-left-color: #64748b; }
    .rekap-pos          .rekap-ico { background: rgba(100, 116, 139, 0.12); color: #64748b; }

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
    .bg-kebakaran { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .bg-sumber_air { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    .bg-hydrant { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
    .bg-penyelamatan { background-color: rgba(244, 183, 64, 0.15); color: #b7791f; }
    .bg-pos { background-color: rgba(100, 116, 139, 0.1); color: #475569; }

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
</style>
@endpush

@section('content')
@php
    $listTitik = collect($titikSigaps ?? []);
    $totalTitik = $listTitik->count();
    $jmlKebakaran    = $listTitik->where('kategori', 'kebakaran')->count();
    $jmlSumberAir    = $listTitik->where('kategori', 'sumber_air')->count();
    $jmlHydrant      = $listTitik->where('kategori', 'hydrant')->count();
    $jmlPenyelamatan = $listTitik->where('kategori', 'penyelamatan')->count();
    $jmlPos          = $listTitik->where('kategori', 'pos')->count();
@endphp

        <!-- Semua pegawai yang tergabung bisa membuka dan melihat halaman ini -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')
        <div class="page-head">
            <div>
                <h1>Kelola Data Titik Peta SIGAP</h1>
                <p>Manajemen data lokasi operasional seperti riwayat kebakaran, hydrant, dan pos pemadam.</p>
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
            <div class="rekap-item rekap-kebakaran">
                <div class="rekap-ico"><i class="fas fa-fire"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlKebakaran }}</div>
                    <div class="rekap-label">Kebakaran</div>
                    <div class="rekap-sub">Riwayat insiden</div>
                </div>
            </div>
            <div class="rekap-item rekap-sumber_air">
                <div class="rekap-ico"><i class="fas fa-water"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlSumberAir }}</div>
                    <div class="rekap-label">Sumber Air</div>
                    <div class="rekap-sub">Titik suplai air</div>
                </div>
            </div>
            <div class="rekap-item rekap-hydrant">
                <div class="rekap-ico"><i class="fas fa-faucet-drip"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlHydrant }}</div>
                    <div class="rekap-label">Hydrant</div>
                    <div class="rekap-sub">Fasilitas kota</div>
                </div>
            </div>
            <div class="rekap-item rekap-penyelamatan">
                <div class="rekap-ico"><i class="fas fa-life-ring"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlPenyelamatan }}</div>
                    <div class="rekap-label">Penyelamatan</div>
                    <div class="rekap-sub">Titik evakuasi/rescue</div>
                </div>
            </div>
            <div class="rekap-item rekap-pos">
                <div class="rekap-ico"><i class="fas fa-building-shield"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlPos }}</div>
                    <div class="rekap-label">Pos Damkar</div>
                    <div class="rekap-sub">Kantor & Sektor</div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <div class="table-responsive">
                <table id="tabelTitik" class="table align-middle border-0 mb-0 w-100">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="15%">Kategori</th>
                            <th width="25%">Nama / Judul</th>
                            <th width="25%">Lokasi</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($titikSigaps as $index => $titik)
                            <tr>
                                <td class="text-center fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    @if($titik->kategori == 'kebakaran')
                                        <span class="badge-custom bg-kebakaran"><i class="fas fa-fire me-1"></i> Kebakaran</span>
                                    @elseif($titik->kategori == 'sumber_air')
                                        <span class="badge-custom bg-sumber_air"><i class="fas fa-water me-1"></i> Sumber Air</span>
                                    @elseif($titik->kategori == 'hydrant')
                                        <span class="badge-custom bg-hydrant"><i class="fas fa-faucet-drip me-1"></i> Hydrant</span>
                                    @elseif($titik->kategori == 'penyelamatan')
                                        <span class="badge-custom bg-penyelamatan"><i class="fas fa-life-ring me-1"></i> Penyelamatan</span>
                                    @elseif($titik->kategori == 'pos')
                                        <span class="badge-custom bg-pos"><i class="fas fa-building-shield me-1"></i> Pos Damkar</span>
                                    @else
                                        <span class="badge-custom" style="background: #e2e8f0; color: #475569;">{{ ucfirst($titik->kategori) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $titik->nama }}</strong><br>
                                    <small class="text-muted"><i class="fas fa-location-dot"></i> {{ $titik->latitude }}, {{ $titik->longitude }}</small>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 250px;" title="{{ $titik->lokasi }}">
                                        {{ $titik->lokasi }}
                                    </span>
                                </td>
                                <td>
                                    {{ $titik->tanggal ? \Carbon\Carbon::parse($titik->tanggal)->format('d M Y') : '-' }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-action-group">
                                        @hasanyrole('Super User|Operator')
                                        <!-- Tombol Edit -->
                                        <a href="{{ url('/internal/peta-sigap/edit/' . $titik->id) }}" class="btn-action btn-edit" title="Edit Data">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ url('/internal/peta-sigap/hapus/' . $titik->id) }}" method="POST" class="d-inline w-100" onsubmit="return confirm('Apakah Anda yakin ingin menghapus titik ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete w-100" title="Hapus Data">
                                                <i class="fas fa-trash"></i> Hapus
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
                { orderable: false, targets: 5 } // Menonaktifkan sorting pada kolom aksi
            ],
            initComplete: function () {
                var api = this.api();
                
                // Mengganti input text pencarian bawaan dengan Dropdown Kategori
                $('.dataTables_filter').html(
                    '<label class="d-flex align-items-center gap-2 mb-0" style="font-weight: 600; color: var(--steel);">Filter: ' +
                    '<select id="filterKategori" class="form-select form-select-sm" style="border-radius: 8px; border: 1px solid var(--line-dark); min-width: 180px;">' +
                        '<option value="">Semua Kategori</option>' +
                        '<option value="Kebakaran">Kebakaran</option>' +
                        '<option value="Sumber Air">Sumber Air</option>' +
                        '<option value="Hydrant">Hydrant</option>' +
                        '<option value="Penyelamatan">Penyelamatan</option>' +
                        '<option value="Pos Damkar">Pos Damkar</option>' +
                    '</select></label>'
                );

                // Menerapkan pencarian/filter ketika dropdown dipilih
                $('#filterKategori').on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    
                    // Angka 1 di bawah ini mewakili Indeks Kolom "Kategori" (Kolom ke-2)
                    api.column(1).search(val ? val : '', true, false).draw();
                });
            }
        });
    });
})();
</script>
@endpush