@extends('layouts.dashboard')

@section('title', 'Kelola Data Peta SIGAP')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    :root {
        --ink: #0d1b2a;
        --navy: #163a63;
        --navy-dark: #0d2947;
        --navy-light: #eaf1f8;
        --navy-soft: rgba(22, 58, 99, .08);
    
        --paper: #f5f7fa;
        --white: #ffffff;
    
        --signal: #dc3545;
        --success: #198754;
        --amber: #f4b740;
    
        --steel: #64748b;
        --steel-soft: #94a3b8;
        --line: #e2e8f0;
    
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;
    
        --r-md: 14px;
        --r-sm: 10px;
    
        --sidebar-w: 288px;
        --topbar-h: 70px;
    
        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
    }
    .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; color: #fff; }
    .user-meta strong { font-size: .84rem; font-weight: 700; color: #ffffff; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}
    .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #ffffff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s;}
    .side-link:hover { background: #f3f6fa; transform: translateX(1px); }
    .side-link i { width: 20px; text-align: center; color: var(--steel); transition: color .2s; flex: none; margin-top: 3px; }
    .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; text-transform: uppercase; color: var(--navy); transition: background .2s, color .2s; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: var(--r-sm); font-size: .84rem; font-weight: 500; color: var(--steel); transition: background .2s, color .2s, transform .2s;}
    .side-sub a i { width: 18px; text-align: center; opacity: .75; flex: none; margin-top: 3px; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .table-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 26px;
        box-shadow: var(--shadow-sm);
    }
    .table-responsive {
        margin-top: 15px;
    }
    .badge-custom {
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .bg-kebakaran { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .bg-sumber_air { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    .bg-hydrant { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
    .bg-penyelamatan { background-color: rgba(244, 183, 64, 0.1); color: #d39e00; }
    .bg-pos { background-color: rgba(100, 116, 139, 0.1); color: #475569; }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        transition: all 0.2s;
    }
    .btn-edit { background: var(--navy-light); color: var(--navy); }
    .btn-edit:hover { background: var(--navy); color: #fff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal); }
    .btn-delete:hover { background: var(--signal); color: #fff; }
    .btn-export-pdf { background: #dc3545; color: white; border: none; }
    .btn-export-pdf:hover { background: #b42332; color: white; }
    .btn-export-excel { background: #198754; color: white; border: none; }
    .btn-export-excel:hover { background: #146c43; color: white; }
    div.dataTables_wrapper div.dataTables_filter input {
        border-radius: 8px;
        border: 1px solid var(--line-dark);
        padding: 6px 12px;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus {
        outline: none;
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    table.dataTable > thead > tr > th {
        border-bottom: 2px solid var(--line-dark);
        color: var(--steel);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    table.dataTable > tbody > tr > td {
        vertical-align: middle;
        font-size: 0.9rem;
        color: var(--ink);
        border-bottom: 1px solid var(--line);
    }
    .page-item.active .page-link {
        background-color: var(--navy);
        border-color: var(--navy);
    }
</style>
@endpush

@section('content')
@section('content')

        <!-- Semua pegawai yang tergabung bisa membuka dan melihat halaman ini -->
        @hasanyrole('Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator')
        <div class="d-flex justify-content-between align-items-end page-head flex-wrap gap-3">
            <div>
                <h1>Kelola Data Titik Peta SIGAP</h1>
                <p class="mb-0">Manajemen data lokasi operasional seperti riwayat kebakaran, hydrant, dan pos pemadam.</p>
            </div>
            
            <!-- Tombol Tambah, PDF, dan Excel dibungkus dalam flexbox agar sejajar rapi -->
            <div class="d-flex gap-2">
                <!-- Tombol Export PDF -->
                <a href="{{ url('/internal/peta-sigap/export-pdf') }}" class="btn btn-export-pdf" style="border-radius: 8px;">
                    <i class="fas fa-file-pdf me-1"></i> Cetak PDF
                </a>
                
                <!-- Tombol Export Excel -->
                <a href="{{ url('/internal/peta-sigap/export-excel') }}" class="btn btn-export-excel" style="border-radius: 8px;">
                    <i class="fas fa-file-excel me-1"></i> Cetak Excel
                </a>

                <!-- Tombol Tambah Titik Baru HANYA untuk Super User & Operator -->
                @hasanyrole('Super User|Operator')
                <a href="/internal/peta-sigap/input" class="btn btn-primary" style="background-color: var(--navy); border: none; border-radius: 8px;">
                    <i class="fas fa-plus me-1"></i> Tambah Titik Baru
                </a>
                @endhasanyrole
            </div>
        </div>

        <div class="table-card mt-2">
            <div class="table-responsive">
                <table id="tabelTitik" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
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
                                <td>{{ $index + 1 }}</td>
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
                                    <div class="d-flex justify-content-center gap-2">
                                        @hasanyrole('Super User|Operator')
                                        <!-- Tombol Edit -->
                                        <a href="{{ url('/internal/peta-sigap/edit/' . $titik->id) }}" class="btn-action btn-edit" title="Edit Data">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ url('/internal/peta-sigap/hapus/' . $titik->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus titik ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Data">
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

<!-- ==================== SCRIPTS ==================== -->
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

    /* ---------- UI Behaviors ---------- */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    function closeSide() {
        document.body.classList.remove('side-open');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });

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
