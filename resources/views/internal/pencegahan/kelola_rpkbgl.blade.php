@extends('layouts.dashboard')

@section('title', 'Kelola Perizinan RPPKBGL')

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
    .page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .btn-print-rekap, .btn-add, .btn-excel { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
    .btn-print-rekap { background: var(--navy); color: #fff; }
    .btn-print-rekap:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff; }
    .btn-add { background: var(--success); color: #fff; }
    .btn-add:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }
    .btn-excel { background: #fff; color: #1d6f42; border: 1.5px solid #1d6f42; }
    .btn-excel:hover { background: #1d6f42; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(29, 111, 66, .18); }
    .btn-excel[disabled] { opacity: .6; cursor: wait; transform: none; box-shadow: none; }

    /* ---------- Penghitung berkas & status ---------- */
    .print-only { display: none; }
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-diurus  { border-left-color: #d97706; background: rgba(244, 183, 64, .07); }
    .rekap-diurus  .rekap-ico { background: rgba(244, 183, 64, .2); color: #d97706; }
    .rekap-pending { border-left-color: #d97706; }
    .rekap-pending .rekap-ico { background: rgba(244, 183, 64, .15); color: #d97706; }
    .rekap-proses  { border-left-color: var(--info); }
    .rekap-proses  .rekap-ico { background: var(--info-soft); color: var(--info); }
    .rekap-ok      { border-left-color: var(--success); }
    .rekap-ok      .rekap-ico { background: rgba(25, 135, 84, .15); color: var(--success); }
    .rekap-no      { border-left-color: var(--signal); }
    .rekap-no      .rekap-ico { background: var(--signal-soft); color: var(--signal-dark); }

    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }
    .badge-status { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-pending { background: rgba(244, 183, 64, .15); color: #d97706; }
    .status-diproses { background: var(--info-soft); color: var(--info); }
    .status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-tidak { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-lihat { background: var(--info-soft); color: var(--info); }
    .btn-lihat:hover { background: var(--info); color: #ffffff; }
    .btn-update { background: var(--navy-soft); color: var(--navy); }
    .btn-update:hover { background: var(--navy); color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }
    .attachment-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; color: var(--info); font-weight: 500; text-decoration: none; margin-bottom: 4px; transition: color .2s; }
    .attachment-link:hover { color: var(--navy-dark); text-decoration: underline; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }

    /* ---------- Toolbar Pencarian & Filter ---------- */
    .filter-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; margin-bottom: 18px; padding-bottom: 16px; border-bottom: 1px solid var(--line); }
    .filter-search { position: relative; flex: 1 1 280px; min-width: 220px; }
    .filter-search i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .filter-search .form-control { height: 42px; padding-left: 38px; border-radius: 8px; font-size: .9rem; border: 1.5px solid var(--line-dark); }
    .filter-search .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .filter-select { flex: 0 0 200px; }
    .filter-select .form-select { height: 42px; border-radius: 8px; font-size: .9rem; border: 1.5px solid var(--line-dark); cursor: pointer; }
    .filter-select .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .btn-reset-filter { height: 42px; padding: 0 16px; border-radius: 8px; border: 1.5px solid var(--line-dark); background: #fff; color: var(--steel); font-size: .85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all .2s; }
    .btn-reset-filter:hover { background: var(--paper); color: var(--ink); }
    .filter-count { margin-left: auto; font-size: .82rem; color: var(--steel); white-space: nowrap; }
    .filter-count strong { color: var(--ink); }
    @media (max-width: 700px) {
        .filter-select { flex: 1 1 100%; }
        .filter-count { margin-left: 0; width: 100%; }
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
        .page-head-title h1 { font-size: 1.55rem; }
        .page-head-title p { font-size: .88rem; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    @media print {
        @page { size: A4 landscape; margin: 10mm; }
        .topbar, .sidebar, .btn-print-rekap, .btn-add, .btn-excel, .no-print-col, .page-head-title p, .filter-bar { display: none !important; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; background: white; }
        .content-card { padding: 0; border: none; box-shadow: none; overflow: visible; }
        .table-responsive { overflow: visible !important; }
        body { background-color: white; margin: 0; padding: 0; }
        .page-head { margin-bottom: 6px; }
        .page-head-title h1 { font-size: 1.3rem; text-align: center; width: 100%; margin-bottom: 4px; }
        .print-only { display: block; text-align: center; font-size: .78rem; color: #000; margin-bottom: 10px; }

        .rekap-grid { grid-template-columns: repeat(6, 1fr); gap: 6px; margin-bottom: 10px; }
        .rekap-item { padding: 6px 8px; gap: 8px; box-shadow: none; border: 1px solid #999; border-left-width: 3px; background: #fff !important; break-inside: avoid; }
        .rekap-ico { display: none; }
        .rekap-num { font-size: 1.1rem; }
        .rekap-label { font-size: .62rem; margin-top: 2px; color: #000; }
        .rekap-sub { font-size: .6rem; color: #000; }

        .table thead { display: table-header-group; }
        .table thead th { background: transparent; color: #000; border-bottom: 2px solid #000; }
        .table tr { page-break-inside: avoid; break-inside: avoid; }
        .table > :not(caption) > * > * { padding: 5px 6px; }
        .table td, .table th { border-color: #ddd; color: #000; font-size: .72rem; }
        .badge-status { background: none !important; color: #000 !important; padding: 0; font-size: .7rem; }
    }
</style>
@endpush

@section('content')
@php
    $offline = 'Tidak dilampirkan (Offline)';
    $toList  = fn($v) => is_array($v) ? array_values(array_filter($v)) : (array) (json_decode($v ?? '[]', true) ?: []);

    $berkasTunggal = [
        'file_surat_permohonan' => ['label' => 'Surat Permohonan', 'dir' => 'surat',  'icon' => 'fa-file-pdf'],
        'file_fotokopi_ktp'     => ['label' => 'Fotokopi KTP',     'dir' => 'berkas',    'icon' => 'fa-id-card'],
        'file_nib'              => ['label' => 'NIB',              'dir' => 'berkas',    'icon' => 'fa-file-alt'],
        'file_pbg_imb'          => ['label' => 'PBG / IMB',        'dir' => 'berkas',    'icon' => 'fa-file-alt'],
        'file_slo_listrik'      => ['label' => 'SLO Listrik',      'dir' => 'berkas',    'icon' => 'fa-bolt'],
        'file_slf_bangunan'     => ['label' => 'SLF Bangunan',     'dir' => 'berkas',    'icon' => 'fa-file-alt'],
        'file_denah_bangunan'   => ['label' => 'Denah Bangunan',   'dir' => 'berkas',  'icon' => 'fa-drafting-compass'],
        'file_pjk3'             => ['label' => 'PJK3 (Lift)',      'dir' => 'berkas',   'icon' => 'fa-file-alt'],
    ];
    $berkasJamak = [
        'file_data_teknis_proteksi' => ['label' => 'Data Teknis Proteksi', 'dir' => 'berkas',    'icon' => 'fa-fire-extinguisher'],
        'file_persyaratan_lainnya'  => ['label' => 'Syarat Lainnya',       'dir' => 'persyaratan', 'icon' => 'fa-paperclip'],
    ];

    /* ---------- Penghitung status ---------- */
    $rows = ($permohonan instanceof \Illuminate\Pagination\AbstractPaginator)
        ? collect($permohonan->items())
        : collect($permohonan);

    // Pemetaan status sama persis dengan badge pada tabel (selain 3 status pertama => Tidak Memenuhi)
    $statusLabelMap = [
        'Pending'         => 'Pending',
        'Diproses'        => 'Diproses Tim',
        'Memenuhi Syarat' => 'Memenuhi Syarat',
    ];
    $statusLabel = fn($s) => $statusLabelMap[$s] ?? 'Tidak Memenuhi Syarat';

    $cnt = ['Pending' => 0, 'Diproses Tim' => 0, 'Memenuhi Syarat' => 0, 'Tidak Memenuhi Syarat' => 0];
    foreach ($rows as $r) { $cnt[$statusLabel($r->status_permohonan)]++; }

    $totalBerkas  = $rows->count();
    $sedangDiurus = $cnt['Pending'] + $cnt['Diproses Tim'];   // belum ada keputusan akhir

    // Daftar kecamatan unik untuk dropdown filter
    $daftarKecamatan = $rows->pluck('kecamatan')->filter()->unique()->sort()->values();

    /* ---------- Data untuk rekap Excel ---------- */
    $excelRows = $rows->values()->map(function ($p, $i) use ($statusLabel, $toList, $offline, $berkasTunggal, $berkasJamak) {
        $jmlBerkas = 0;
        foreach ($berkasTunggal as $f => $m) { if (!empty($p->$f) && $p->$f !== $offline) $jmlBerkas++; }
        foreach ($berkasJamak  as $f => $m) { $jmlBerkas += count(array_diff($toList($p->$f), [$offline])); }

        return [
            'no'               => $i + 1,
            'tgl_pengajuan'    => $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-',
            'nama_pemohon'     => (string) $p->nama_pemohon,
            'no_whatsapp'      => (string) $p->no_whatsapp,
            'email'            => (string) $p->email_pemohon,
            'nama_usaha'       => (string) $p->nama_usaha,
            'nik'              => (string) $p->nik_pemilik_usaha,
            'alamat_pemilik'   => (string) $p->alamat_pemilik_usaha,
            'kategori'         => (string) $p->kategori_bangunan,
            'alamat_bangunan'  => (string) $p->alamat_bangunan,
            'kecamatan'        => (string) $p->kecamatan,
            'kelurahan'        => (string) $p->kelurahan,
            'luas_lahan'       => is_numeric($p->luas_lahan) ? (float) $p->luas_lahan : null,
            'luas_bangunan'    => is_numeric($p->luas_bangunan) ? (float) $p->luas_bangunan : null,
            'tinggi_bangunan'  => is_numeric($p->tinggi_bangunan) ? (float) $p->tinggi_bangunan : null,
            'lift'             => $p->ada_lift === 'ya' ? 'Ada' : ($p->ada_lift === 'tidak' ? 'Tidak ada' : '-'),
            'tgl_pemeriksaan'  => $p->tgl_pemeriksaan ? \Carbon\Carbon::parse($p->tgl_pemeriksaan)->format('d/m/Y') : 'Belum dijadwalkan',
            'status'           => $statusLabel($p->status_permohonan),
            'jml_berkas'       => $jmlBerkas,
            // Kunci internal untuk pencarian/filter (tidak ditulis ke Excel)
            '_search'          => mb_strtolower($p->nama_pemohon . ' ' . $p->nama_usaha . ' ' . $p->no_whatsapp . ' ' . $p->kategori_bangunan . ' ' . $p->kecamatan . ' ' . $p->kelurahan . ' ' . $p->alamat_bangunan),
            '_kec'             => mb_strtolower((string) $p->kecamatan),
        ];
    })->all();
@endphp

        <div class="page-head">
            <div class="page-head-title">
                <h1>Daftar Permohonan RPPKBGL</h1>
                <p>Data pengajuan Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung dan Lingkungan.</p>
            </div>
            
            <div class="d-flex gap-2 flex-wrap">
                <!-- ==============================================
                     TOMBOL TAMBAH DIBUNGKUS HAK AKSES PENCEGAHAN
                     ============================================== -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/kelola-rpkbgl/create" class="btn-add no-print-col">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endhasanyrole

                <button type="button" id="btnExportExcel" class="btn-excel no-print-col">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>

                <button onclick="window.print()" class="btn-print-rekap no-print-col">
                    <i class="fas fa-print"></i> Cetak Rekap
                </button>
            </div>
        </div>

        <div class="print-only">Dicetak pada {{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB</div>

        <!-- ==============================================
             PENGHITUNG BERKAS YANG SEDANG DIURUS + STATUS
             ============================================== -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-folder-open"></i></div>
                <div>
                    <div class="rekap-num">{{ $totalBerkas }}</div>
                    <div class="rekap-label">Total Berkas</div>
                </div>
            </div>
            <div class="rekap-item rekap-diurus">
                <div class="rekap-ico"><i class="fas fa-hourglass-half"></i></div>
                <div>
                    <div class="rekap-num">{{ $sedangDiurus }}</div>
                    <div class="rekap-label">Sedang Diurus</div>
                    <div class="rekap-sub">Pending + Diproses Tim</div>
                </div>
            </div>
            <div class="rekap-item rekap-pending">
                <div class="rekap-ico"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="rekap-num">{{ $cnt['Pending'] }}</div>
                    <div class="rekap-label">Pending</div>
                </div>
            </div>
            <div class="rekap-item rekap-proses">
                <div class="rekap-ico"><i class="fas fa-spinner"></i></div>
                <div>
                    <div class="rekap-num">{{ $cnt['Diproses Tim'] }}</div>
                    <div class="rekap-label">Diproses Tim</div>
                </div>
            </div>
            <div class="rekap-item rekap-ok">
                <div class="rekap-ico"><i class="fas fa-check-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $cnt['Memenuhi Syarat'] }}</div>
                    <div class="rekap-label">Memenuhi Syarat</div>
                </div>
            </div>
            <div class="rekap-item rekap-no">
                <div class="rekap-ico"><i class="fas fa-times-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $cnt['Tidak Memenuhi Syarat'] }}</div>
                    <div class="rekap-label">Tidak Memenuhi</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <!-- ==============================================
                 PENCARIAN & FILTER (STATUS + KECAMATAN)
                 ============================================== -->
            @if($totalBerkas > 0)
            <div class="filter-bar">
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="search" id="searchRpkbgl" class="form-control"
                           placeholder="Cari pemohon, usaha, kategori, lokasi, atau no. WhatsApp..."
                           autocomplete="off">
                </div>

                <div class="filter-select">
                    <select id="filterStatus" class="form-select" aria-label="Filter status">
                        <option value="">Semua Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Diproses Tim">Diproses Tim</option>
                        <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                        <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                    </select>
                </div>

                <div class="filter-select">
                    <select id="filterKecamatan" class="form-select" aria-label="Filter kecamatan">
                        <option value="">Semua Kecamatan</option>
                        @foreach($daftarKecamatan as $kec)
                            <option value="{{ mb_strtolower($kec) }}">{{ $kec }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="button" id="btnResetFilter" class="btn-reset-filter">
                    <i class="fas fa-rotate-left"></i> Reset
                </button>

                <div class="filter-count" id="filterCount">
                    Menampilkan <strong>{{ $totalBerkas }}</strong> dari <strong>{{ $totalBerkas }}</strong> berkas
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>Nama Usaha</th>
                            <th>Kategori</th>
                            <th>Lokasi Bangunan</th>
                            <th>Pemeriksaan</th>
                            <th>Status</th>
                            <th class="no-print-col">Berkas Lampiran</th>
                            <th class="no-print-col" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        <tr class="row-rpkbgl"
                            data-status="{{ $statusLabel($p->status_permohonan) }}"
                            data-kecamatan="{{ mb_strtolower((string) $p->kecamatan) }}"
                            data-search="{{ mb_strtolower($p->nama_pemohon . ' ' . $p->nama_usaha . ' ' . $p->no_whatsapp . ' ' . $p->kategori_bangunan . ' ' . $p->kecamatan . ' ' . $p->kelurahan . ' ' . $p->alamat_bangunan) }}">
                            <td>
                                <strong>{{ $p->created_at->format('d M Y') }}</strong>
                                <div style="font-size: .8rem; color: var(--steel-soft);">{{ $p->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <strong style="display: block; margin-bottom: 2px;">{{ $p->nama_pemohon }}</strong>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" style="font-size: .8rem; color: var(--success); text-decoration: none;">
                                    <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                </a>
                            </td>
                            <td><strong>{{ $p->nama_usaha }}</strong></td>
                            <td>{{ $p->kategori_bangunan }}</td>
                            <td>
                                {{ $p->kecamatan }}<br>
                                <span style="font-size: .8rem; color: var(--steel);">Kel. {{ $p->kelurahan }}</span>
                            </td>
                            <td>
                                @if($p->tgl_pemeriksaan)
                                    <strong>{{ \Carbon\Carbon::parse($p->tgl_pemeriksaan)->format('d M Y') }}</strong>
                                @else
                                    <span style="font-size: .8rem; color: var(--steel-soft);">Belum dijadwalkan</span>
                                @endif
                                <div style="font-size: .78rem; color: var(--steel); margin-top: 2px;">
                                    <i class="fas fa-elevator" style="width: 14px;"></i>
                                    Lift: {{ $p->ada_lift === 'ya' ? 'Ada' : ($p->ada_lift === 'tidak' ? 'Tidak ada' : '-') }}
                                </div>
                            </td>
                            <td>
                                @if($p->status_permohonan == 'Pending')
                                    <span class="badge-status status-pending">Pending</span>
                                @elseif($p->status_permohonan == 'Diproses')
                                    <span class="badge-status status-diproses">Diproses Tim</span>
                                @elseif($p->status_permohonan == 'Memenuhi Syarat')
                                    <span class="badge-status status-memenuhi">Memenuhi</span>
                                @else
                                    <span class="badge-status status-tidak">Tidak Memenuhi</span>
                                @endif
                            </td>
                            
                            <!-- Kolom Lampiran (semua berkas pada migration) -->
                            <td class="no-print-col">
                                @php $adaBerkas = false; @endphp

                                @foreach($berkasTunggal as $field => $m)
                                    @if(!empty($p->$field))
                                        @php $adaBerkas = true; @endphp
                                        @if($p->$field === $offline)
                                            <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                                <i class="fas {{ $m['icon'] }}"></i> {{ $m['label'] }} (Offline)
                                            </span>
                                        @else
                                            <a href="{{ asset('uploads/rpkbgl/' . $m['dir'] . '/' . $p->$field) }}" target="_blank" class="attachment-link d-block">
                                                <i class="fas {{ $m['icon'] }}"></i> {{ $m['label'] }}
                                            </a>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach($berkasJamak as $field => $m)
                                    @foreach($toList($p->$field) as $index => $namaFile)
                                        @php $adaBerkas = true; @endphp
                                        @if($namaFile === $offline)
                                            <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                                <i class="fas {{ $m['icon'] }}"></i> {{ $m['label'] }} (Offline)
                                            </span>
                                        @else
                                            <a href="{{ asset('uploads/rpkbgl/' . $m['dir'] . '/' . $namaFile) }}" target="_blank" class="attachment-link d-block">
                                                <i class="fas {{ $m['icon'] }}"></i> {{ $m['label'] }} {{ $index + 1 }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endforeach

                                @unless($adaBerkas)
                                    <span style="font-size: .75rem; color: var(--steel-soft);">- Tidak ada berkas</span>
                                @endunless
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="no-print-col">
                                <div class="btn-action-group">
                                    <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}" class="btn-action btn-lihat">
                                        <i class="fas fa-search" style="width: 14px;"></i> Detail
                                    </a>
                                    
                                    <!-- ==============================================
                                         TOMBOL UPDATE & HAPUS DIBUNGKUS HAK AKSES
                                         ============================================== -->
                                    @hasanyrole('Pencegahan|Super User')
                                    <a href="/internal/pencegahan/kelola-rpkbgl/{{ $p->id }}/edit" class="btn-action btn-edit">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>

                                    <button type="button" class="btn-action btn-update" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalUpdateStatus" 
                                        data-id="{{ $p->id }}" 
                                        data-nama="{{ $p->nama_pemohon }}" 
                                        data-status="{{ $p->status_permohonan }}">
                                        <i class="fas fa-edit" style="width: 14px;"></i> Update
                                    </button>
                                    
                                    <button type="button" class="btn-action btn-delete" onclick="confirmDelete({{ $p->id }}, '{{ addslashes($p->nama_pemohon) }}')">
                                        <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                    </button>
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data permohonan RPKBGL yang masuk.
                            </td>
                        </tr>
                        @endforelse

                        <!-- Pesan jika hasil pencarian/filter kosong -->
                        <tr id="rowNoResult" class="d-none">
                            <td colspan="9" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-search mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Tidak ada permohonan yang cocok dengan pencarian atau filter.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==============================================
             MODAL UPDATE STATUS DIBUNGKUS HAK AKSES
             ============================================== -->
        @hasanyrole('Pencegahan|Super User')
        <div class="modal fade" id="modalUpdateStatus" tabindex="-1" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: none; border-radius: var(--r-md); box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                    <form id="formUpdateStatus" method="POST" action="">
                        @csrf
                        <div class="modal-header" style="background: var(--paper); border-bottom: 1px solid var(--line);">
                            <h5 class="modal-title" id="modalUpdateStatusLabel" style="font-family: var(--font-display); font-weight: 700; color: var(--ink);">
                                <i class="fas fa-edit text-primary me-2"></i> Update Status
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                Ubah status permohonan RPKBGL atas nama <strong id="modalPemohonName" class="text-dark"></strong>.
                            </p>
                            
                            <div class="mb-2">
                                <label for="selectStatus" class="form-label fw-bold" style="font-size: 0.9rem; color: var(--ink);">Status Baru</label>
                                <select class="form-select shadow-sm" id="selectStatus" name="status_permohonan" required style="border-radius: 8px; cursor: pointer;">
                                    <option value="Pending">Pending</option>
                                    <option value="Diproses">Diproses Tim</option>
                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer" style="background: var(--paper); border-top: 1px solid var(--line);">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
                            <button type="submit" class="btn btn-primary" style="background: var(--navy); border-color: var(--navy); border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-save me-1"></i> Simpan Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endhasanyrole

<!-- Script Bootstrap & SweetAlert -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
<script>
(function () {
    'use strict';
    /* ---------- Modal Update Status Logic ---------- */
    var modalUpdateStatus = document.getElementById('modalUpdateStatus');
    if (modalUpdateStatus) {
        modalUpdateStatus.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var status = button.getAttribute('data-status');

            var form = document.getElementById('formUpdateStatus');
            form.action = '/internal/pencegahan/kelola-rpkbgl/update-status/' + id;

            document.getElementById('modalPemohonName').textContent = nama;
            
            var select = document.getElementById('selectStatus');
            if(!status || status == '') status = 'Pending';
            select.value = status;
        });
    }

    /* ---------- SweetAlert Success Notif ---------- */
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{!! session('success') !!}",
            confirmButtonColor: '#163a63',
            confirmButtonText: 'Tutup'
        });
    @endif
})();

/* ---------- Pencarian & Filter (Status + Kecamatan) ---------- */
var elSearch = document.getElementById('searchRpkbgl');
var elStatus = document.getElementById('filterStatus');
var elKec    = document.getElementById('filterKecamatan');

function filterAktif() {
    return {
        q:   elSearch ? elSearch.value.trim().toLowerCase() : '',
        st:  elStatus ? elStatus.value : '',
        kec: elKec    ? elKec.value    : ''
    };
}

function cocokFilter(search, status, kec, f) {
    return (!f.q   || (search || '').indexOf(f.q) !== -1) &&
           (!f.st  || status === f.st) &&
           (!f.kec || kec === f.kec);
}

function terapkanFilter() {
    var f = filterAktif();
    var rows = document.querySelectorAll('tr.row-rpkbgl');
    var shown = 0;

    rows.forEach(function (tr) {
        var ok = cocokFilter(tr.dataset.search, tr.dataset.status, tr.dataset.kecamatan, f);
        tr.classList.toggle('d-none', !ok);
        if (ok) shown++;
    });

    var cnt = document.getElementById('filterCount');
    if (cnt) cnt.innerHTML = 'Menampilkan <strong>' + shown + '</strong> dari <strong>' + rows.length + '</strong> berkas';

    // Pesan "tidak ada hasil" hanya muncul jika ada data tetapi semuanya tersaring
    var empty = document.getElementById('rowNoResult');
    if (empty) empty.classList.toggle('d-none', !(rows.length > 0 && shown === 0));
}

if (elSearch && elStatus && elKec) {
    elSearch.addEventListener('input', terapkanFilter);
    elStatus.addEventListener('change', terapkanFilter);
    elKec.addEventListener('change', terapkanFilter);

    document.getElementById('btnResetFilter').addEventListener('click', function () {
        elSearch.value = '';
        elStatus.value = '';
        elKec.value = '';
        terapkanFilter();
    });
}

// Hitung ulang ringkasan dari baris yang lolos filter (dipakai oleh Rekap Excel)
function hitungSumRekap(rows) {
    var s = { total: rows.length, pending: 0, diproses: 0, memenuhi: 0, tidak: 0 };
    rows.forEach(function (r) {
        if (r.status === 'Pending') s.pending++;
        else if (r.status === 'Diproses Tim') s.diproses++;
        else if (r.status === 'Memenuhi Syarat') s.memenuhi++;
        else s.tidak++;
    });
    s.diurus = s.pending + s.diproses;
    return s;
}

/* ---------- Rekap Excel (.xlsx) ---------- */
var REKAP_ALL = @json($excelRows);

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }

    // Ikuti filter yang sedang aktif di layar (nomor urut dihitung ulang)
    var f = filterAktif();
    var REKAP_ROWS = REKAP_ALL.filter(function (r) {
        return cocokFilter(r._search, r.status, r._kec, f);
    }).map(function (r, i) {
        return Object.assign({}, r, { no: i + 1 });
    });
    var REKAP_SUM = hitungSumRekap(REKAP_ROWS);

    if (!REKAP_ROWS.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Tidak ada data permohonan yang sesuai untuk direkap.', confirmButtonColor: '#163a63' });
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
            'Pending':               { bg: 'FFFDF0D5', fg: 'FFB45309' },
            'Diproses Tim':          { bg: 'FFDBEAFE', fg: 'FF1D4ED8' },
            'Memenuhi Syarat':       { bg: 'FFD1E7DD', fg: 'FF146C43' },
            'Tidak Memenuhi Syarat': { bg: 'FFF8D7DA', fg: 'FFB42332' }
        };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        /* ===== Sheet 1: Rekap Permohonan ===== */
        var HEAD = 5;                       // baris header tabel
        var FIRST = HEAD + 1;               // baris data pertama
        var LAST = HEAD + REKAP_ROWS.length;
        var NCOL = 19;

        var ws = wb.addWorksheet('Rekap Permohonan', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 3 }],
            pageSetup: { paperSize: 9, orientation: 'landscape', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
        });

        var cols = [
            ['No', 6], ['Tgl. Pengajuan', 17], ['Nama Pemohon', 24], ['No. WhatsApp', 16], ['Email', 28],
            ['Nama Usaha / Instansi', 28], ['NIK Pemilik Usaha', 20], ['Alamat Pemilik Usaha', 34],
            ['Kategori Bangunan', 20], ['Alamat Bangunan', 38], ['Kecamatan', 18], ['Kelurahan', 18],
            ['Luas Lahan (m²)', 14], ['Luas Bangunan (m²)', 16], ['Tinggi (m)', 11], ['Lift', 11],
            ['Tgl. Pemeriksaan', 18], ['Status', 22], ['Berkas Terlampir', 15]
        ];
        cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c[1]; });

        ws.mergeCells(1, 1, 1, NCOL);
        ws.getCell('A1').value = 'REKAP PERMOHONAN REKOMENDASI PROTEKSI KEBAKARAN (RPKBGL)';
        ws.getCell('A1').font = { name: 'Calibri', size: 15, bold: true, color: { argb: NAVY } };
        ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
        ws.getRow(1).height = 26;

        ws.mergeCells(2, 1, 2, NCOL);
        ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        ws.getCell('A2').font = { size: 11, bold: true };

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak +
            '   |   Total berkas: ' + REKAP_SUM.total +
            '   |   Sedang diurus: ' + REKAP_SUM.diurus +
            ' (Pending ' + REKAP_SUM.pending + ', Diproses ' + REKAP_SUM.diproses + ')' +
            '   |   Memenuhi: ' + REKAP_SUM.memenuhi +
            '   |   Tidak memenuhi: ' + REKAP_SUM.tidak;
        ws.getCell('A3').font = { size: 10, italic: true, color: { argb: 'FF64748B' } };

        // header tabel
        var hr = ws.getRow(HEAD);
        cols.forEach(function (c, i) { hr.getCell(i + 1).value = c[0]; });
        hr.height = 32;
        hr.eachCell(function (cell) {
            cell.font = { bold: true, color: { argb: 'FFFFFFFF' }, size: 10.5 };
            cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: NAVY } };
            cell.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            cell.border = border;
        });

        // isi tabel
        REKAP_ROWS.forEach(function (r, idx) {
            var row = ws.getRow(FIRST + idx);
            row.values = [
                r.no, r.tgl_pengajuan, r.nama_pemohon, r.no_whatsapp, r.email,
                r.nama_usaha, r.nik, r.alamat_pemilik, r.kategori, r.alamat_bangunan,
                r.kecamatan, r.kelurahan, r.luas_lahan, r.luas_bangunan, r.tinggi_bangunan,
                r.lift, r.tgl_pemeriksaan, r.status, r.jml_berkas
            ];
            row.eachCell({ includeEmpty: true }, function (cell, n) {
                cell.border = border;
                cell.alignment = { vertical: 'top', wrapText: true, horizontal: ([1, 2, 16, 17, 18, 19].indexOf(n) > -1) ? 'center' : 'left' };
                if ([13, 14, 15].indexOf(n) > -1) {
                    cell.numFmt = '#,##0.00';
                    cell.alignment = { vertical: 'top', horizontal: 'right' };
                }
                if (n === 4 || n === 7) cell.numFmt = '@';   // WhatsApp & NIK tetap teks (nol di depan aman)
            });
            var st = statusStyle[r.status];
            if (st) {
                var sc = row.getCell(18);
                sc.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: st.bg } };
                sc.font = { bold: true, color: { argb: st.fg } };
            }
        });

        ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

        /* ===== Sheet 2: Ringkasan Status ===== */
        var sm = wb.addWorksheet('Ringkasan Status');
        sm.getColumn(1).width = 34;
        sm.getColumn(2).width = 14;
        sm.mergeCells('A1:B1');
        sm.getCell('A1').value = 'RINGKASAN BERKAS RPKBGL';
        sm.getCell('A1').font = { size: 14, bold: true, color: { argb: NAVY } };
        sm.getCell('A2').value = 'Per ' + tglCetak;
        sm.getCell('A2').font = { italic: true, color: { argb: 'FF64748B' } };

        var rng = function (col) { return "'Rekap Permohonan'!$" + col + '$' + FIRST + ':$' + col + '$' + LAST; };
        var sumRows = [
            ['Status', 'Jumlah', null],
            ['Pending',               { formula: 'COUNTIF(' + rng('R') + ',"Pending")',               result: REKAP_SUM.pending },  'Pending'],
            ['Diproses Tim',          { formula: 'COUNTIF(' + rng('R') + ',"Diproses Tim")',          result: REKAP_SUM.diproses }, 'Diproses Tim'],
            ['Memenuhi Syarat',       { formula: 'COUNTIF(' + rng('R') + ',"Memenuhi Syarat")',       result: REKAP_SUM.memenuhi }, 'Memenuhi Syarat'],
            ['Tidak Memenuhi Syarat', { formula: 'COUNTIF(' + rng('R') + ',"Tidak Memenuhi Syarat")', result: REKAP_SUM.tidak },    'Tidak Memenuhi Syarat'],
            ['TOTAL BERKAS',          { formula: 'SUM(B5:B8)', result: REKAP_SUM.total }, null],
            ['Sedang Diurus (Pending + Diproses Tim)', { formula: 'B5+B6', result: REKAP_SUM.diurus }, null]
        ];
        sumRows.forEach(function (d, i) {
            var rw = sm.getRow(4 + i);
            rw.getCell(1).value = d[0];
            rw.getCell(2).value = d[1];
            [1, 2].forEach(function (n) {
                var c = rw.getCell(n);
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 2 ? 'center' : 'left' };
            });
            if (i === 0) {
                [1, 2].forEach(function (n) {
                    var c = rw.getCell(n);
                    c.font = { bold: true, color: { argb: 'FFFFFFFF' } };
                    c.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: NAVY } };
                });
            } else if (d[2] && statusStyle[d[2]]) {
                rw.getCell(1).fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: statusStyle[d[2]].bg } };
                rw.getCell(1).font = { bold: true, color: { argb: statusStyle[d[2]].fg } };
            } else {
                [1, 2].forEach(function (n) { rw.getCell(n).font = { bold: true }; });
            }
        });
        // header ringkasan ada di baris 4, data baris 5-8, total baris 9, sedang diurus baris 10

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_RPKBGL_' + tglFile + '.xlsx';
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

/* ---------- Fungsi Konfirmasi Hapus dengan SweetAlert2 ---------- */
function confirmDelete(id, namaPemohon) {
    Swal.fire({
        title: 'Hapus Data?',
        html: `Anda yakin ingin menghapus data permohonan atas nama <strong>${namaPemohon}</strong>?<br>Data tidak dapat dikembalikan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Membuat form virtual (dinamis) untuk mengirim request DELETE ke Laravel
            const form = document.createElement('form');
            form.method = 'POST';
            
            // Sesuaikan Route ini ke endpoint Delete controller Anda
            form.action = `/internal/pencegahan/kelola-rpkbgl/${id}`; 

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            
            form.submit();
        }
    });
}
</script>
@endpush