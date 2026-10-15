@extends('layouts.dashboard')

@section('title', 'DIKSAR')

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
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .page-toolbar { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 8px; }
    .page-toolbar .page-head { margin-bottom: 0; }
    .toolbar-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
    .search-box { position: relative; width: 260px; max-width: 100%; }
    .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .search-box input {
        width: 100%; height: 42px; padding: 0 14px 0 38px;
        border: 1px solid var(--line-dark); border-radius: var(--r-sm);
        background: #fff; font-size: .88rem; font-family: var(--font-body); color: var(--ink);
        transition: border-color .2s, box-shadow .2s;
    }
    .search-box input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-tool {
        display: inline-flex; align-items: center; gap: 8px;
        height: 42px; padding: 0 16px; border-radius: var(--r-sm);
        font-weight: 600; font-size: .85rem; color: #fff; border: none;
        transition: filter .2s, transform .1s, box-shadow .2s;
    }
    .btn-tool:hover { color: #fff; filter: brightness(1.08); box-shadow: var(--shadow-sm); }
    .btn-tool:active { transform: scale(.97); }
    .btn-tool.navy { background: var(--navy); }
    .btn-tool.green { background: var(--success); }
    .btn-tool.red { background: var(--signal); }
    .custom-nav-tabs {
        display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto;
        margin-top: 18px; padding-bottom: 0;
        border-bottom: 1px solid var(--line);
    }
    .custom-nav-tabs::-webkit-scrollbar { height: 4px; }
    .custom-nav-tabs::-webkit-scrollbar-thumb { background: var(--steel-soft); border-radius: 10px; }
    .custom-nav-tabs .nav-link {
        border: none; border-bottom: 3px solid transparent; border-radius: 0;
        color: var(--steel); font-weight: 700; font-size: .8rem; letter-spacing: .02em;
        padding: 12px 18px; background: transparent; white-space: nowrap;
        transition: color .2s, border-color .2s, background .2s;
    }
    .custom-nav-tabs .nav-link:hover { color: var(--ink); background: var(--navy-soft); }
    .custom-nav-tabs .nav-link.active { color: var(--navy); border-bottom-color: var(--navy); }
    .table-title {
        display: flex; align-items: center; gap: 12px;
        font-family: var(--font-display); font-weight: 700; font-size: 1rem;
        color: var(--ink); letter-spacing: -.01em; margin: 26px 0 14px;
    }
    .table-title .ico {
        width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff;
        display: grid; place-items: center; font-size: .78rem;
        box-shadow: 0 4px 8px rgba(22,58,99,.12);
    }
    .table-scroll-wrapper {
        width: 100%; overflow-x: auto; background: #fff;
        border-radius: var(--r-md); border: 1px solid var(--line);
        box-shadow: var(--shadow-xs); margin-bottom: 40px;
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 8px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: var(--steel-soft); border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: var(--paper); }
    .table-detailed { width: 100%; border-collapse: collapse; min-width: 2500px; margin-bottom: 0; }
    .table-detailed thead { background: var(--ink); color: #fff; }
    .table-detailed th {
        font-size: .7rem; font-weight: 700; padding: 16px 15px; white-space: nowrap;
        text-transform: uppercase; letter-spacing: .05em; vertical-align: middle;
        border-right: 1px solid var(--ink-3);
    }
    .table-detailed td {
        font-size: .84rem; padding: 14px 15px; vertical-align: middle; white-space: nowrap;
        border-bottom: 1px solid var(--line); border-right: 1px solid var(--paper);
    }
    .table-detailed tbody tr { transition: background .15s; }
    .table-detailed tbody tr:hover { background: var(--paper); }
    .badge-soft-blue {
        display: inline-block; background: var(--info-soft); color: var(--info);
        padding: 5px 12px; font-weight: 700; font-size: .78rem; border-radius: 6px;
        border: 1px solid rgba(37, 99, 235, .15);
    }
    .badge-diklat {
        display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .03em;
        padding: 5px 10px; border-radius: 6px; background: var(--navy-soft); color: var(--navy);
    }
    .aksi-wrap { display: flex; justify-content: center; align-items: center; gap: 6px; }
    .aksi-wrap form { margin: 0; display: inline-flex; }
    .btn-action {
        width: 32px; height: 32px; display: inline-flex; justify-content: center; align-items: center;
        border-radius: 8px; font-size: .8rem; color: #fff; border: none; cursor: pointer;
        transition: transform .1s, filter .2s;
    }
    .btn-action:hover { transform: scale(1.06); color: #fff; filter: brightness(1.06); }
    .btn-edit { background: var(--amber); color: var(--ink); }
    .btn-edit:hover { color: var(--ink); }
    .btn-delete { background: var(--signal); }
    .empty-state { text-align: center; padding: 48px 12px !important; color: var(--steel); font-weight: 600; }
    .empty-state i { font-size: 28px; color: var(--steel-soft); margin-bottom: 8px; }
    @media (max-width: 1100px) {
        .topbar { padding: 0 20px; }
        .content { padding: 32px 26px 60px; }
    }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .brand { gap: 9px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .topbar-right { gap: 7px; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .user-avatar { width: 34px; height: 34px; }
        .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 16px 50px; }
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .search-box { width: 100%; }
        .toolbar-actions { width: 100%; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
    @media print {
        .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
        .brand span { color: #000 !important; }
        .sidebar, .btn-logout, .toolbar-actions, .toast-wrap { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
    }
</style>
@endpush

@section('content')
@section('content')

        <!-- HEADER KONTEN & TOMBOL AKSI -->
        <div class="page-toolbar">
            <div class="page-head">
                <h1>Peningkatan Kapasitas Aparatur</h1>
                <p>Kelola data diklat dan peningkatan kapasitas aparatur pemadam kebakaran.</p>
            </div>

            <div class="toolbar-actions">
                <!-- PENCARIAN: TERBUKA UNTUK SEMUA ROLE -->
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari nama atau NIK..." aria-label="Cari nama atau NIK">
                </div>

                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/peningkatan-kapasitas/tambah?jenis=DIKSAR" class="btn-tool navy">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <!-- EXCEL & PDF TERBUKA UNTUK SEMUA ROLE -->
                <a href="/internal/pencegahan/peningkatan-kapasitas/cetak-excel/diksar" class="btn-tool green">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="/internal/pencegahan/peningkatan-kapasitas/cetak-pdf/diksar" target="_blank" class="btn-tool red">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>

        <!-- TABS -->
        <ul class="nav custom-nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas">Semua Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diksar*') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diksar">DIKSAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f1') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f1">DIKLAT F1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-f2') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-f2">DIKLAT F2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-rescue') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-rescue">DIKLAT RESCUE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-mfr') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-mfr">DIKLAT MFR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-operator') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-operator">DIKLAT OPERATOR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-inspektur') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-inspektur">DIKLAT INSPEKTUR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('internal/pencegahan/peningkatan-kapasitas/diklat-ppl') ? 'active' : '' }}" href="/internal/pencegahan/peningkatan-kapasitas/diklat-ppl">DIKLAT PPL</a>
            </li>
        </ul>

        <!-- ================= AREA TABEL DATA ================= -->
        <div class="table-title">
            <span class="ico"><i class="fas fa-list-check"></i></span>
            <span>Data DIKSAR</span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="table-detailed table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="50px">No</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Instansi/Perangkat Daerah</th>
                        <th>Ditanda Tangani Oleh</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th class="text-center">Jumlah Jam Pelajaran</th>
                        <th>Instansi Penyelenggara</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>Nomor Sertifikat</th>
                        <th>Kode Verivikasi</th>
                        <th>Persentasi Penilaian</th>
                        <th>Jenis Diklat</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>TTL</th>
                        <th>Ket</th>

                        <!-- KOLOM AKSI (EDIT/HAPUS) HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <th class="text-center" width="100px">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data_diklat as $index => $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td><div class="fw-bold">{{ $item->nama }}</div></td>
                        <td>{{ $item->tempat_lahir }}</td>
                        <td>{{ $item->tgl_lahir }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ $item->ditandatangani_oleh }}</td>
                        <td>{{ $item->tanggal_pelaksanaan }}</td>
                        <td class="text-center"><span class="badge-soft-blue">{{ $item->jumlah_jam_pelajaran }}</span></td>
                        <td>{{ $item->instansi_penyelenggara }}</td>
                        <td>{{ $item->provinsi }}</td>
                        <td>{{ $item->kota }}</td>
                        <td style="color: var(--ink); font-weight: 600;">{{ $item->nomor_sertifikat }}</td>
                        <td>{{ $item->kode_verifikasi }}</td>
                        <td>{{ $item->persentasi_penilaian }}</td>
                        <td><span class="badge-diklat">{{ $item->jenis_diklat ?? 'DIKSAR' }}</span></td>
                        <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $item->ttl }}</td>
                        <td>{{ $item->ket }}</td>

                        <!-- TOMBOL EDIT & HAPUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                        @hasanyrole('Pencegahan|Super User')
                        <td>
                            <div class="aksi-wrap">
                                <a href="/internal/pencegahan/peningkatan-kapasitas/edit/diksar/{{ $item->id }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/internal/pencegahan/peningkatan-kapasitas/hapus/diksar/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endhasanyrole
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->hasAnyRole(['Pencegahan', 'Super User']) ? 22 : 21 }}" class="empty-state">
                            <i class="fas fa-folder-open"></i><br>
                            Belum ada data untuk DIKSAR.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
@endsection
