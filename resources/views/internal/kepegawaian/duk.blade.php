@extends('layouts.dashboard')

@section('title', 'Data Urut Kepegawaian (DUK)')

@push('styles')
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
    
    .btn-print-rekap, .btn-tambah, .btn-excel { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
    .btn-print-rekap { background: var(--navy); color: #fff; }
    .btn-print-rekap:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }
    .btn-tambah { background: var(--success); color: #fff; }
    .btn-tambah:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }
    .btn-excel { background: #fff; color: #1d6f42; border: 1.5px solid #1d6f42; }
    .btn-excel:hover { background: #1d6f42; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(29, 111, 66, .18); }
    .btn-excel[disabled] { opacity: .6; cursor: wait; transform: none; box-shadow: none; }

    /* ---------- Penghitung Statistik DUK ---------- */
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-ok      { border-left-color: var(--success); }
    .rekap-ok      .rekap-ico { background: rgba(25, 135, 84, .15); color: var(--success); }
    .rekap-pending { border-left-color: #d97706; }
    .rekap-pending .rekap-ico { background: rgba(244, 183, 64, .15); color: #d97706; }
    .rekap-no      { border-left-color: var(--steel); }
    .rekap-no      .rekap-ico { background: rgba(74, 90, 110, .15); color: var(--steel); }

    .card-container { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .card-container:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    
    .table > :not(caption) > * > * { padding: 9px 11px; border-color: var(--line); color: var(--ink); font-size: .84rem; vertical-align: middle; }
    .table thead th { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em; color: var(--navy); background: #f1f5f9; border: 1px solid #cbd5e1; vertical-align: middle; }
    .table tbody td { border: 1px solid var(--line); vertical-align: top; }
    .cell-multiline { white-space: nowrap; line-height: 1.6; vertical-align: top !important; }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }
    .table-duk-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }

    /* ---------- Pagination DUK ---------- */
    .duk-pagination .pagination { margin-bottom: 0; gap: 4px; flex-wrap: wrap; }
    .duk-pagination .page-link { color: var(--navy); border: 1px solid var(--line); border-radius: 6px !important; padding: 6px 12px; font-size: .84rem; font-weight: 600; background: #fff; }
    .duk-pagination .page-item.active .page-link { background-color: var(--navy); border-color: var(--navy); color: #fff; }
    .duk-pagination .page-item.disabled .page-link { color: var(--steel-soft); background-color: #f8fafc; border-color: var(--line); }
    .duk-pagination .page-link:hover { background-color: #f1f5f9; color: var(--navy-dark); }
    .duk-pagination .page-item.active .page-link:hover { background-color: var(--navy); color: #fff; }

    .badge-status { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-aktif   { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-cuti    { background: rgba(244, 183, 64, .15); color: #d97706; }
    .status-pensiun { background: var(--paper); color: var(--steel); }

    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }

    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .content { padding: 26px 16px 50px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .card-container { padding: 14px; }
    }
</style>
@endpush

@section('content')
@php
    $listPegawai = collect($allPegawais ?? $pegawais ?? []);
    $totalPeg    = $totalPeg ?? $listPegawai->count();
    $jmlPns      = $jmlPns ?? $listPegawai->filter(fn($p) => str_contains($p->pangkat_gol_ruang ?? '', '/'))->count();
    $jmlPppk     = $jmlPppk ?? ($totalPeg - $jmlPns);
    $jmlAktif    = $jmlAktif ?? $listPegawai->where('status_pegawai', 'Aktif')->count();
    $jmlCuti     = $jmlCuti ?? $listPegawai->where('status_pegawai', 'Cuti')->count();
    $jmlPensiun  = $jmlPensiun ?? $listPegawai->where('status_pegawai', 'Pensiun')->count();

    /* Data siap rekap Excel (seluruh pegawai) */
    $barisExcel = $listPegawai->values()->map(function ($p, $i) {
        $isPns = str_contains($p->pangkat_gol_ruang ?? '', '/');
        $formatMulti = fn($v) => str_replace("\n", "\r\n", (string)($v ?? '-'));
        return [
            'no_urut'                     => $p->no_urut ?? ($i + 1),
            'nama'                        => (string) $p->nama,
            'nip'                         => (string) $p->nip,
            'pangkat_gol_ruang'           => (string) ($p->pangkat_gol_ruang ?? '-'),
            'pangkat_tmt'                 => $p->pangkat_tmt ? \Carbon\Carbon::parse($p->pangkat_tmt)->format('d-m-Y') : '-',
            'jabatan_nama'                => (string) ($p->jabatan_nama ?? '-'),
            'jabatan_tmt'                 => $p->jabatan_tmt ? \Carbon\Carbon::parse($p->jabatan_tmt)->format('d-m-Y') : '-',
            'masa_kerja_th'               => (int) ($p->masa_kerja_th ?? 0),
            'masa_kerja_bln'              => (int) ($p->masa_kerja_bln ?? 0),
            'latihan_jabatan_nama'        => $formatMulti($p->latihan_jabatan_nama),
            'latihan_jabatan_tahun_lulus' => $formatMulti($p->latihan_jabatan_tahun_lulus),
            'latihan_jabatan_tempat'      => $formatMulti($p->latihan_jabatan_tempat),
            'pendidikan_nama'             => $formatMulti($p->pendidikan_nama),
            'pendidikan_tahun_lulus'      => $formatMulti($p->pendidikan_tahun_lulus),
            'pendidikan_tingkat_ijazah'   => $formatMulti($p->pendidikan_tingkat_ijazah),
            'tempat_tanggal_lahir'        => (string) ($p->tempat_tanggal_lahir ?? '-'),
            'jenis_kelamin'               => (string) ($p->jenis_kelamin ?? '-'),
            'catatan_mutasi_pegawai'      => (string) ($p->catatan_mutasi_pegawai ?? '-'),
            'status_kepegawaian'          => $isPns ? 'PNS' : 'PPPK',
        ];
    })->all();

    $rekapData = [
        'rows' => $barisExcel,
        'sum'  => [
            'total'   => $totalPeg,
            'pns'     => $jmlPns,
            'pppk'    => $jmlPppk,
            'aktif'   => $jmlAktif,
            'cuti'    => $jmlCuti,
            'pensiun' => $jmlPensiun,
        ]
    ];
@endphp

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-head">
            <div>
                <h1>Daftar Urut Kepangkatan (DUK)</h1>
                <p>Manajemen data pegawai, kepangkatan, jabatan, dan pendidikan lengkap.</p>
            </div>
            
            <div class="d-flex gap-2 flex-wrap">
                <!-- Pembatasan akses CRUD Create -->
                @hasanyrole('Super User|Sekretariat')
                <a href="{{ route('kepegawaian.duk.create') }}" class="btn-tambah text-decoration-none">
                    <i class="fas fa-plus me-1"></i> Tambah Data Pegawai
                </a>
                @endhasanyrole

                <button type="button" id="btnExportExcel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>
            </div>
        </div>

        <!-- REKAP GRID STATISTIK -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-users"></i></div>
                <div>
                    <div class="rekap-num">{{ $totalPeg }}</div>
                    <div class="rekap-label">Total Pegawai</div>
                    <div class="rekap-sub">Terdaftar dalam DUK</div>
                </div>
            </div>
            <div class="rekap-item" style="border-left-color: #0d6efd;">
                <div class="rekap-ico" style="background: rgba(13, 110, 253, .12); color: #0d6efd;"><i class="fas fa-id-badge"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlPns }}</div>
                    <div class="rekap-label">PNS</div>
                    <div class="rekap-sub">Pegawai Negeri Sipil</div>
                </div>
            </div>
            <div class="rekap-item" style="border-left-color: #198754;">
                <div class="rekap-ico" style="background: rgba(25, 135, 84, .12); color: #198754;"><i class="fas fa-user-check"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlPppk }}</div>
                    <div class="rekap-label">PPPK</div>
                    <div class="rekap-sub">Perjanjian Kerja</div>
                </div>
            </div>
            <div class="rekap-item rekap-ok">
                <div class="rekap-ico"><i class="fas fa-check-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlAktif }}</div>
                    <div class="rekap-label">Pegawai Aktif</div>
                    <div class="rekap-sub">Menjalankan tugas</div>
                </div>
            </div>
            <div class="rekap-item rekap-pending">
                <div class="rekap-ico"><i class="fas fa-user-clock"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlCuti + $jmlPensiun }}</div>
                    <div class="rekap-label">Cuti / Pensiun</div>
                    <div class="rekap-sub">Non-aktif bertugas</div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <!-- Baris Pencarian & Info Total -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <form action="{{ route('kepegawaian.duk.index') }}" method="GET" class="search-wrap d-flex gap-2">
                    <div class="position-relative flex-grow-1">
                        <i class="fas fa-magnifying-glass"></i>
                        <input type="text" id="searchDukInput" name="search" class="form-control" placeholder="Cari nama pegawai atau NIP..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-outline-primary d-flex align-items-center gap-1" style="height: 40px; border-radius: 8px; font-size: .84rem; font-weight: 600; flex: none;">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    @if(request('search'))
                    <a href="{{ route('kepegawaian.duk.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" title="Reset Pencarian" style="height: 40px; width: 40px; border-radius: 8px; flex: none;">
                        <i class="fas fa-times"></i>
                    </a>
                    @endif
                </form>

                <div class="text-muted small fw-medium">
                    Total: <strong class="text-dark" id="countDukPegawai">{{ $totalPeg }}</strong> pegawai
                    @if(request('search'))
                        ditemukan
                    @else
                        terdaftar
                    @endif
                </div>
            </div>

            <!-- Tabel Responsif Mengikuti Struktur Excel DUK -->
            <div class="table-responsive table-duk-scroll">
                <table class="table align-middle border-0 mb-0" id="tableDuk">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle" style="width: 45px;">No.</th>
                            <th rowspan="2" class="align-middle" style="min-width: 200px;">Nama Pegawai</th>
                            <th rowspan="2" class="align-middle" style="min-width: 175px;">NIP</th>
                            <th colspan="2" class="text-center">Pangkat</th>
                            <th colspan="2" class="text-center">Jabatan</th>
                            <th colspan="2" class="text-center">Masa Kerja</th>
                            <th colspan="3" class="text-center">Latihan Jabatan (Diklat)</th>
                            <th colspan="3" class="text-center">Pendidikan Formal</th>
                            <th rowspan="2" class="align-middle" style="min-width: 180px;">Tempat, Tanggal Lahir</th>
                            <th rowspan="2" class="text-center align-middle" style="width: 50px;">L/P</th>
                            <th rowspan="2" class="align-middle" style="min-width: 160px;">Catatan Mutasi</th>
                            <th rowspan="2" class="text-center align-middle" style="min-width: 90px;">Status</th>
                            @hasanyrole('Sekretariat|Super User')
                            <th rowspan="2" class="text-center align-middle" style="width: 105px;">Aksi</th>
                            @endhasanyrole
                        </tr>
                        <tr>
                            <th class="text-center" style="min-width: 85px;">Gol. Ruang</th>
                            <th class="text-center" style="min-width: 95px;">TMT</th>
                            <th style="min-width: 190px;">Nama</th>
                            <th class="text-center" style="min-width: 95px;">TMT</th>
                            <th class="text-center" style="width: 45px;">Th</th>
                            <th class="text-center" style="width: 45px;">Bln</th>
                            <th style="min-width: 170px;">Nama</th>
                            <th class="text-center" style="min-width: 65px;">Tahun</th>
                            <th style="min-width: 120px;">Tempat</th>
                            <th style="min-width: 110px;">Nama</th>
                            <th class="text-center" style="min-width: 65px;">Tahun</th>
                            <th class="text-center" style="min-width: 80px;">Tingkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawais as $pegawai)
                        @php
                            $isPns = str_contains($pegawai->pangkat_gol_ruang ?? '', '/');
                        @endphp
                        <tr data-pegawai-row data-nama="{{ strtolower($pegawai->nama) }}" data-nip="{{ $pegawai->nip }}">
                            {{-- 1. No --}}
                            <td class="text-center fw-bold text-secondary">{{ $pegawai->no_urut }}</td>
                            
                            {{-- 2. Nama --}}
                            <td class="fw-semibold text-dark" style="white-space: nowrap;">{{ $pegawai->nama }}</td>
                            
                            {{-- 3. NIP --}}
                            <td class="fw-bold" style="font-variant-numeric: tabular-nums; white-space: nowrap;">{{ $pegawai->nip }}</td>
                            
                            {{-- 4-5. Pangkat Gol Ruang & TMT --}}
                            <td class="text-center fw-bold text-primary">{{ $pegawai->pangkat_gol_ruang ?: '-' }}</td>
                            <td class="text-center text-muted" style="white-space: nowrap; font-size: .8rem;">
                                {{ $pegawai->pangkat_tmt ? \Carbon\Carbon::parse($pegawai->pangkat_tmt)->format('d-m-Y') : '-' }}
                            </td>
                            
                            {{-- 6-7. Jabatan Nama & TMT --}}
                            <td>{{ $pegawai->jabatan_nama ?: '-' }}</td>
                            <td class="text-center text-muted" style="white-space: nowrap; font-size: .8rem;">
                                {{ $pegawai->jabatan_tmt ? \Carbon\Carbon::parse($pegawai->jabatan_tmt)->format('d-m-Y') : '-' }}
                            </td>
                            
                            {{-- 8-9. Masa Kerja Th & Bln --}}
                            <td class="text-center">{{ $pegawai->masa_kerja_th ?? 0 }}</td>
                            <td class="text-center">{{ $pegawai->masa_kerja_bln ?? 0 }}</td>
                            
                            {{-- 10-12. Latihan Jabatan (Diklat) Nama, Tahun, Tempat --}}
                            <td class="cell-multiline">{!! nl2br(e($pegawai->latihan_jabatan_nama ?: '-')) !!}</td>
                            <td class="cell-multiline text-center text-muted" style="font-size: .8rem;">{!! nl2br(e($pegawai->latihan_jabatan_tahun_lulus ?: '-')) !!}</td>
                            <td class="cell-multiline">{!! nl2br(e($pegawai->latihan_jabatan_tempat ?: '-')) !!}</td>
                            
                            {{-- 13-15. Pendidikan Nama, Tahun, Tingkat --}}
                            <td class="cell-multiline">{!! nl2br(e($pegawai->pendidikan_nama ?: '-')) !!}</td>
                            <td class="cell-multiline text-center text-muted" style="font-size: .8rem;">{!! nl2br(e($pegawai->pendidikan_tahun_lulus ?: '-')) !!}</td>
                            <td class="cell-multiline text-center fw-semibold">{!! nl2br(e($pegawai->pendidikan_tingkat_ijazah ?: '-')) !!}</td>
                            
                            {{-- 16. Tempat Tanggal Lahir --}}
                            <td style="white-space: nowrap;">{{ $pegawai->tempat_tanggal_lahir ?: '-' }}</td>
                            
                            {{-- 17. Jenis Kelamin (L/P) --}}
                            <td class="text-center">
                                @if($pegawai->jenis_kelamin == 'Perempuan')
                                    <span class="badge" style="background: rgba(220,53,69,.12); color: #dc3545; font-size: .75rem;" title="Perempuan">P</span>
                                @elseif($pegawai->jenis_kelamin == 'Laki-laki')
                                    <span class="badge" style="background: rgba(13,110,253,.12); color: #0d6efd; font-size: .75rem;" title="Laki-laki">L</span>
                                @else
                                    -
                                @endif
                            </td>
                            
                            {{-- 18. Catatan Mutasi Pegawai --}}
                            <td>{{ $pegawai->catatan_mutasi_pegawai ?: '-' }}</td>
                            
                            {{-- 19. Status CPNS/PNS/PPPK & Keaktifan --}}
                            <td class="text-center" style="white-space: nowrap;">
                                <span class="badge {{ $isPns ? 'bg-primary' : 'bg-success' }}" style="font-size: .72rem; padding: 3px 7px;">
                                    {{ $isPns ? 'PNS' : 'PPPK' }}
                                </span>
                                @if($pegawai->status_pegawai && $pegawai->status_pegawai !== 'Aktif')
                                    <div class="mt-1">
                                        <span class="badge-status {{ $pegawai->status_pegawai == 'Cuti' ? 'status-cuti' : 'status-pensiun' }}" style="font-size: .65rem; padding: 2px 5px;">
                                            {{ $pegawai->status_pegawai }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            
                            @hasanyrole('Sekretariat|Super User')
                            <td>
                                <div class="btn-action-group">
                                    <a href="{{ route('kepegawaian.duk.edit', $pegawai->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('kepegawaian.duk.destroy', $pegawai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pegawai ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete w-100">
                                            <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@hasanyrole('Sekretariat|Super User') 20 @else 19 @endhasanyrole" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-search mb-3" style="font-size: 2.5rem; color: var(--steel-soft); opacity: 0.7;"></i><br>
                                    @if(request('search'))
                                        Tidak ditemukan pegawai dengan kata kunci "<strong>{{ request('search') }}</strong>".
                                        <div class="mt-2">
                                            <a href="{{ route('kepegawaian.duk.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">Reset Pencarian</a>
                                        </div>
                                    @else
                                        Belum ada data pegawai. Silakan tambah data baru.
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-muted small">
                    Menampilkan <strong class="text-dark">{{ $pegawais->firstItem() ?? 0 }}</strong> sampai <strong class="text-dark">{{ $pegawais->lastItem() ?? 0 }}</strong> dari <strong class="text-dark">{{ $pegawais->total() }}</strong> pegawai
                </div>
                @if($pegawais->hasPages())
                    <div class="duk-pagination">
                        {{ $pegawais->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
<script>
var REKAP = @json($rekapData);

function rekapKolomDUK() {
    return [
        { k: 'no_urut',                     t: 'NO',                     w: 8,  a: 'center', int: true },
        { k: 'nama',                        t: 'NAMA',                   w: 28 },
        { k: 'nip',                         t: 'NIP',                    w: 22, txt: true },
        { k: 'pangkat_gol_ruang',           t: 'PANGKAT GOL RUANG',      w: 14, a: 'center' },
        { k: 'pangkat_tmt',                 t: 'PANGKAT TMT',            w: 14, a: 'center' },
        { k: 'jabatan_nama',                t: 'JABATAN NAMA',           w: 28 },
        { k: 'jabatan_tmt',                 t: 'JABATAN TMT',            w: 14, a: 'center' },
        { k: 'masa_kerja_th',               t: 'MASA KERJA TH',          w: 12, a: 'center', int: true },
        { k: 'masa_kerja_bln',              t: 'MASA KERJA BLN',         w: 12, a: 'center', int: true },
        { k: 'latihan_jabatan_nama',        t: 'LATIHAN JABATAN NAMA',   w: 24 },
        { k: 'latihan_jabatan_tahun_lulus', t: 'TAHUN LULUS',            w: 14, a: 'center' },
        { k: 'latihan_jabatan_tempat',      t: 'TEMPAT LATIHAN',         w: 18 },
        { k: 'pendidikan_nama',             t: 'PENDIDIKAN NAMA',        w: 18 },
        { k: 'pendidikan_tahun_lulus',      t: 'TAHUN LULUS',            w: 14, a: 'center' },
        { k: 'pendidikan_tingkat_ijazah',   t: 'TINGKAT IJAZAH',         w: 14, a: 'center' },
        { k: 'tempat_tanggal_lahir',        t: 'TEMPAT TANGGAL LAHIR',   w: 26 },
        { k: 'jenis_kelamin',               t: 'JENIS KELAMIN',          w: 16, a: 'center' },
        { k: 'catatan_mutasi_pegawai',      t: 'CATATAN MUTASI PEGAWAI', w: 24 },
        { k: 'status_kepegawaian',          t: 'STATUS CPNS/PNS/PPPK',   w: 16, a: 'center' }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }
    if (!REKAP.rows.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Belum ada data pegawai untuk direkap.', confirmButtonColor: '#163a63' });
        return;
    }

    var oldHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';

    try {
        var NAVY = 'FF163A63';
        var thin = { style: 'thin', color: { argb: 'FFBFC8D4' } };
        var border = { top: thin, left: thin, bottom: thin, right: thin };
        var statusStyle = {
            'PNS':  { bg: 'FFD1E7DD', fg: 'FF146C43' },
            'PPPK': { bg: 'FFCFE2FF', fg: 'FF084298' }
        };
        var fillOf = function (argb) { return { type: 'pattern', pattern: 'solid', fgColor: { argb: argb } }; };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        /* ===== Sheet 1: Data Urut Kepangkatan (DUK) ===== */
        var rows  = REKAP.rows;
        var sum   = REKAP.sum;
        var HEAD  = 5;
        var FIRST = HEAD + 1;
        var cols  = rekapKolomDUK();
        var NCOL  = cols.length;
        var LAST  = HEAD + Math.max(rows.length, 1);
        var stIdx = cols.map(function (c) { return c.k; }).indexOf('status_kepegawaian') + 1;

        var ws = wb.addWorksheet('Data DUK', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 3 }],
            pageSetup: { paperSize: 9, orientation: 'landscape', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
        });
        cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c.w; });

        ws.mergeCells(1, 1, 1, NCOL);
        ws.getCell('A1').value = 'DAFTAR URUT KEPANGKATAN (DUK) PEGAWAI';
        ws.getCell('A1').font = { name: 'Calibri', size: 15, bold: true, color: { argb: NAVY } };
        ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
        ws.getRow(1).height = 26;

        ws.mergeCells(2, 1, 2, NCOL);
        ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        ws.getCell('A2').font = { size: 11, bold: true };

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak +
            '   |   Total: ' + sum.total +
            '   |   PNS: ' + sum.pns +
            '   |   PPPK: ' + sum.pppk +
            '   |   Aktif: ' + sum.aktif;
        ws.getCell('A3').font = { size: 10, italic: true, color: { argb: 'FF64748B' } };

        var hr = ws.getRow(HEAD);
        cols.forEach(function (c, i) { hr.getCell(i + 1).value = c.t; });
        hr.height = 32;
        hr.eachCell(function (cell) {
            cell.font = { bold: true, color: { argb: 'FFFFFFFF' }, size: 10.5 };
            cell.fill = fillOf(NAVY);
            cell.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            cell.border = border;
        });

        rows.forEach(function (r, idx) {
            var row = ws.getRow(FIRST + idx);
            row.values = cols.map(function (c) { return r[c.k]; });
            row.eachCell({ includeEmpty: true }, function (cell, n) {
                var c = cols[n - 1];
                cell.border = border;
                cell.alignment = { vertical: 'top', wrapText: true, horizontal: c.a || 'left' };
                if (c.int) cell.numFmt = '#,##0';
                if (c.txt) cell.numFmt = '@'; // NIP aman sebagai teks
            });
            var st = statusStyle[r.status_kepegawaian];
            if (st) {
                var sc = row.getCell(stIdx);
                sc.fill = fillOf(st.bg);
                sc.font = { bold: true, color: { argb: st.fg } };
            }
        });

        ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

        /* ===== Sheet 2: Ringkasan Status Pegawai ===== */
        var stLetter = ws.getColumn(stIdx).letter;
        var rngStatus = "'Data DUK'!$" + stLetter + '$' + FIRST + ':$' + stLetter + '$' + LAST;

        var sm = wb.addWorksheet('Ringkasan Status');
        sm.getColumn(1).width = 24;
        sm.getColumn(2).width = 18;

        sm.mergeCells('A1:B1');
        sm.getCell('A1').value = 'RINGKASAN STATUS KEPEGAWAIAN (DUK)';
        sm.getCell('A1').font = { size: 14, bold: true, color: { argb: NAVY } };
        sm.getCell('A2').value = 'Per ' + tglCetak;
        sm.getCell('A2').font = { italic: true, color: { argb: 'FF64748B' } };

        var headRow = sm.getRow(4);
        ['Status Kepegawaian', 'Jumlah Pegawai'].forEach(function (t, i) { headRow.getCell(i + 1).value = t; });
        headRow.eachCell(function (c) {
            c.font = { bold: true, color: { argb: 'FFFFFFFF' } };
            c.fill = fillOf(NAVY);
            c.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            c.border = border;
        });
        headRow.height = 26;

        var statusRows = [
            ['PNS',   'pns'],
            ['PPPK',  'pppk']
        ];

        statusRows.forEach(function (d, i) {
            var r = 5 + i;
            var rw = sm.getRow(r);
            rw.getCell(1).value = d[0];
            rw.getCell(2).value = { formula: 'COUNTIF(' + rngStatus + ',"' + d[0] + '")', result: sum[d[1]] };

            for (var n = 1; n <= 2; n++) {
                var c = rw.getCell(n);
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 1 ? 'left' : 'center' };
                if (n === 2) c.numFmt = '#,##0';
            }
            if (statusStyle[d[0]]) {
                rw.getCell(1).fill = fillOf(statusStyle[d[0]].bg);
                rw.getCell(1).font = { bold: true, color: { argb: statusStyle[d[0]].fg } };
            }
        });

        var totalRow = sm.getRow(7);
        totalRow.getCell(1).value = 'TOTAL KESELURUHAN';
        totalRow.getCell(2).value = { formula: 'SUM(B5:B6)', result: sum.total };

        for (var n = 1; n <= 2; n++) {
            var tc = totalRow.getCell(n);
            tc.font = { bold: true };
            tc.border = border;
            tc.alignment = { vertical: 'middle', horizontal: n === 1 ? 'left' : 'center' };
            if (n === 2) tc.numFmt = '#,##0';
        }

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_DUK_Pegawai_' + tglFile + '.xlsx';
        document.body.appendChild(a);
        a.click();
        a.remove();
        setTimeout(function () { URL.revokeObjectURL(url); }, 1500);
    } catch (err) {
        console.error(err);
        Swal.fire({ icon: 'error', title: 'Gagal membuat Excel', text: 'Terjadi kesalahan saat menyusun file. Silakan coba lagi.', confirmButtonColor: '#163a63' });
    } finally {
        btn.disabled = false;
        btn.innerHTML = oldHtml;
    }
}
document.getElementById('btnExportExcel').addEventListener('click', exportRekapExcel);

/* ---------- Filter Pencarian Real-Time (Live Search) ---------- */
(function () {
    var searchInput = document.getElementById('searchDukInput');
    var tableBody = document.querySelector('#tableDuk tbody');
    var countDisplay = document.getElementById('countDukPegawai');

    if (searchInput && tableBody) {
        var rows = tableBody.querySelectorAll('tr[data-pegawai-row]');

        searchInput.addEventListener('input', function () {
            var query = this.value.toLowerCase().trim();
            var cleanQueryNip = query.replace(/[^0-9]/g, '');
            var visibleCount = 0;

            rows.forEach(function (row) {
                var nama = row.getAttribute('data-nama') || '';
                var nip = row.getAttribute('data-nip') || '';

                var matchNama = nama.indexOf(query) !== -1;
                var matchNip = nip.indexOf(query) !== -1 || (cleanQueryNip.length > 0 && nip.indexOf(cleanQueryNip) !== -1);

                if (!query || matchNama || matchNip) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (countDisplay) {
                countDisplay.textContent = visibleCount;
            }

            var emptySearchRow = document.getElementById('emptySearchRow');
            if (visibleCount === 0 && rows.length > 0) {
                if (!emptySearchRow) {
                    emptySearchRow = document.createElement('tr');
                    emptySearchRow.id = 'emptySearchRow';
                    emptySearchRow.innerHTML = '<td colspan="@hasanyrole("Sekretariat|Super User") 20 @else 19 @endhasanyrole" class="text-center py-4">' +
                        '<div class="text-muted">' +
                        '<i class="fas fa-search mb-2" style="font-size: 2rem; color: var(--steel-soft); opacity: 0.7;"></i><br>' +
                        'Tidak ditemukan di halaman ini. Tekan <strong>Enter</strong> atau klik tombol <strong>Cari</strong> untuk mencari di seluruh data.' +
                        '</div></td>';
                    tableBody.appendChild(emptySearchRow);
                }
                emptySearchRow.style.display = '';
            } else if (emptySearchRow) {
                emptySearchRow.style.display = 'none';
            }
        });
    }
})();
</script>
@endpush