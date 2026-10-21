@extends('layouts.dashboard')

@section('title', 'Kelola SKK')

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

    /* ---------- Khusus SKK: tab Baru / Perpanjangan ---------- */
    .content-card.has-tabs { padding: 0; }
    .nav-tabs { background-color: var(--paper); border-bottom: 1px solid var(--line); padding: 12px 20px 0 20px; border-radius: var(--r-md) var(--r-md) 0 0; }
    .nav-tabs .nav-link { color: var(--steel); font-weight: 600; font-size: .92rem; border: none; padding: 12px 24px; margin-bottom: -1px; border-bottom: 3px solid transparent; transition: all .25s; background: transparent; }
    .nav-tabs .nav-link:hover { color: var(--ink); }
    .nav-tabs .nav-link.active { color: var(--navy); background: transparent; border-bottom: 3px solid var(--navy); font-weight: 700; }
    .tab-count { display: inline-block; min-width: 22px; margin-left: 6px; padding: 1px 7px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .72rem; font-weight: 700; text-align: center; }
    .tab-content { padding: 24px; }
    .btn-cetak { background: var(--paper); color: var(--steel); border: 1px solid var(--line); }
    .btn-cetak:hover { background: var(--steel-soft); color: #ffffff; border-color: var(--steel-soft); }
    .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    @media (max-width: 700px) { .tab-content { padding: 14px; } .nav-tabs { padding: 10px 10px 0; } .nav-tabs .nav-link { padding: 10px 14px; } }

    /* ---------- Toolbar Pencarian & Filter (berlaku untuk kedua tab) ---------- */
    .filter-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; padding: 18px 24px; border-bottom: 1px solid var(--line); background: #fff; }
    .filter-search { position: relative; flex: 1 1 280px; min-width: 220px; }
    .filter-search i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .filter-search .form-control { height: 42px; padding-left: 38px; border-radius: 8px; font-size: .9rem; border: 1.5px solid var(--line-dark); }
    .filter-search .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .filter-select { flex: 0 0 200px; }
    .filter-select .form-select { height: 42px; border-radius: 8px; font-size: .9rem; border: 1.5px solid var(--line-dark); cursor: pointer; }
    .btn-reset-filter { height: 42px; padding: 0 16px; border-radius: 8px; border: 1.5px solid var(--line-dark); background: #fff; color: var(--steel); font-size: .85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all .2s; }
    .btn-reset-filter:hover { background: var(--paper); color: var(--ink); }
    .filter-count { margin-left: auto; font-size: .82rem; color: var(--steel); white-space: nowrap; }
    .filter-count strong { color: var(--ink); }
    @media (max-width: 700px) {
        .filter-bar { padding: 14px; }
        .filter-select { flex: 1 1 100%; }
        .filter-count { margin-left: 0; width: 100%; }
    }
</style>
@endpush

@section('content')
@php
    $offlineVals = ['offline_registered', 'Tidak dilampirkan (Offline)', '["Tidak dilampirkan (Offline)"]'];
    $berkasAda   = fn($v) => !empty($v) && !in_array($v, $offlineVals, true);

    /* ---------- Pemetaan status (sama dengan badge pada tabel; selain 3 status pertama => Tidak Memenuhi) ---------- */
    $statusLabelMap = [
        'Pending'         => 'Pending',
        'Diproses'        => 'Diproses Tim',
        'Memenuhi Syarat' => 'Memenuhi Syarat',
    ];
    $statusLabel = fn($s) => $statusLabelMap[$s] ?? 'Tidak Memenuhi Syarat';

    $listBaru = collect($skk_baru);
    $listPerp = collect($skk_perpanjang);

    /* ---------- Penghitung status ---------- */
    $hitung = function ($list) use ($statusLabel) {
        $c = ['Pending' => 0, 'Diproses Tim' => 0, 'Memenuhi Syarat' => 0, 'Tidak Memenuhi Syarat' => 0];
        foreach ($list as $r) { $c[$statusLabel($r->status_permohonan)]++; }
        return [
            'total'    => $list->count(),
            'diurus'   => $c['Pending'] + $c['Diproses Tim'],
            'pending'  => $c['Pending'],
            'diproses' => $c['Diproses Tim'],
            'memenuhi' => $c['Memenuhi Syarat'],
            'tidak'    => $c['Tidak Memenuhi Syarat'],
        ];
    };
    $sumBaru = $hitung($listBaru);
    $sumPerp = $hitung($listPerp);
    $sumAll  = [];
    foreach ($sumBaru as $k => $v) { $sumAll[$k] = $v + $sumPerp[$k]; }

    // Daftar kecamatan unik (gabungan SKK Baru + Perpanjangan) untuk dropdown filter
    $daftarKecamatan = $listBaru->concat($listPerp)->pluck('kecamatan')->filter()->unique()->sort()->values();

    /* ---------- Data untuk rekap Excel ---------- */
    $buatBaris = function ($list, $perpanjang) use ($statusLabel, $berkasAda) {
        return $list->values()->map(function ($p, $i) use ($statusLabel, $berkasAda, $perpanjang) {
            $jml = ($berkasAda($p->file_surat_permohonan) ? 1 : 0) + ($berkasAda($p->file_persyaratan_lainnya) ? 1 : 0);
            $row = [
                'no'              => $i + 1,
                'tgl_pengajuan'   => $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-',
                'nama_pemohon'    => (string) $p->nama_pemohon,
                'no_whatsapp'     => (string) $p->no_whatsapp,
                'email'           => (string) $p->email_pemohon,
                'nama_usaha'      => (string) $p->nama_usaha,
                'nik'             => (string) $p->nik_pemilik_usaha,
                'alamat_pemilik'  => (string) $p->alamat_pemilik_usaha,
                'nama_bangunan'   => (string) $p->nama_bangunan,
                'kategori'        => (string) $p->kategori_bangunan,
                'konstruksi'      => (string) $p->konstruksi_bangunan,
                'nomor_imb'       => (string) $p->nomor_imb,
                'alamat_bangunan' => (string) $p->alamat_bangunan,
                'kecamatan'       => (string) $p->kecamatan,
                'kelurahan'       => (string) $p->kelurahan,
                'luas_lahan'      => is_numeric($p->luas_lahan) ? (float) $p->luas_lahan : null,
                'luas_bangunan'   => is_numeric($p->luas_bangunan) ? (float) $p->luas_bangunan : null,
                'jumlah_lantai'   => is_numeric($p->jumlah_lantai) ? (int) $p->jumlah_lantai : null,
                'tinggi_bangunan' => is_numeric($p->tinggi_bangunan) ? (float) $p->tinggi_bangunan : null,
            ];
            if ($perpanjang) {
                $row['nomor_skk_lama']         = $p->nomor_skk_lama ?: '-';
                $row['masa_berlaku_skk_lama']  = $p->masa_berlaku_skk_lama ? \Carbon\Carbon::parse($p->masa_berlaku_skk_lama)->format('d/m/Y') : '-';
            }
            $row['status']     = $statusLabel($p->status_permohonan);
            $row['jml_berkas'] = $jml;

            // Kunci internal untuk pencarian/filter (tidak ditulis ke Excel)
            $row['_search'] = mb_strtolower(
                $p->nama_pemohon . ' ' . $p->nama_usaha . ' ' . $p->nik_pemilik_usaha . ' ' . $p->no_whatsapp . ' ' .
                $p->nama_bangunan . ' ' . $p->kategori_bangunan . ' ' . $p->kecamatan . ' ' . $p->kelurahan . ' ' .
                ($perpanjang ? $p->nomor_skk_lama : '')
            );
            $row['_kec'] = mb_strtolower((string) $p->kecamatan);
            return $row;
        })->all();
    };

    // Disiapkan di sini karena direktif json di Blade memecah argumen berdasarkan koma
    $rekapData = [
        'baru'       => $buatBaris($listBaru, false),
        'perpanjang' => $buatBaris($listPerp, true),
    ];

    $tabs = ['baru' => $listBaru, 'perpanjang' => $listPerp];
@endphp

        <div class="page-head">
            <div class="page-head-title">
                <h1>Daftar Permohonan SKK</h1>
                <p>Kelola pengajuan Sertifikat Keamanan Kebakaran (Baru &amp; Perpanjangan).</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <!-- ==============================================
                     TOMBOL TAMBAH DIBUNGKUS HAK AKSES
                     ============================================== -->
                @hasanyrole('Pencegahan|Super User')
                <a href="{{ route('skk.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah SKK
                </a>
                @endhasanyrole

                <button type="button" id="btnExportExcel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>
            </div>
        </div>

        <!-- ==============================================
             PENGHITUNG BERKAS YANG SEDANG DIURUS + STATUS
             ============================================== -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-folder-open"></i></div>
                <div>
                    <div class="rekap-num">{{ $sumAll['total'] }}</div>
                    <div class="rekap-label">Total Berkas</div>
                    <div class="rekap-sub">Baru {{ $sumBaru['total'] }} &bull; Perpanjangan {{ $sumPerp['total'] }}</div>
                </div>
            </div>
            <div class="rekap-item rekap-diurus">
                <div class="rekap-ico"><i class="fas fa-hourglass-half"></i></div>
                <div>
                    <div class="rekap-num">{{ $sumAll['diurus'] }}</div>
                    <div class="rekap-label">Sedang Diurus</div>
                    <div class="rekap-sub">Pending + Diproses Tim</div>
                </div>
            </div>
            <div class="rekap-item rekap-pending">
                <div class="rekap-ico"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="rekap-num">{{ $sumAll['pending'] }}</div>
                    <div class="rekap-label">Pending</div>
                </div>
            </div>
            <div class="rekap-item rekap-proses">
                <div class="rekap-ico"><i class="fas fa-spinner"></i></div>
                <div>
                    <div class="rekap-num">{{ $sumAll['diproses'] }}</div>
                    <div class="rekap-label">Diproses Tim</div>
                </div>
            </div>
            <div class="rekap-item rekap-ok">
                <div class="rekap-ico"><i class="fas fa-check-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $sumAll['memenuhi'] }}</div>
                    <div class="rekap-label">Memenuhi Syarat</div>
                </div>
            </div>
            <div class="rekap-item rekap-no">
                <div class="rekap-ico"><i class="fas fa-times-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $sumAll['tidak'] }}</div>
                    <div class="rekap-label">Tidak Memenuhi</div>
                </div>
            </div>
        </div>

        <div class="content-card has-tabs">
            <!-- ==============================================
                 PENCARIAN & FILTER (STATUS + KECAMATAN) — BERLAKU UNTUK KEDUA TAB
                 ============================================== -->
            @if($sumAll['total'] > 0)
            <div class="filter-bar">
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="search" id="searchSkk" class="form-control"
                           placeholder="Cari pemohon, usaha, NIK, bangunan, lokasi, atau no. WhatsApp..."
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
                    Menampilkan <strong>{{ $sumAll['total'] }}</strong> dari <strong>{{ $sumAll['total'] }}</strong> berkas
                </div>
            </div>
            @endif

            <!-- NAV TABS -->
            <ul class="nav nav-tabs" id="skkTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="baru-tab" data-bs-toggle="tab" data-bs-target="#baru" type="button" role="tab"><i class="fas fa-certificate me-2"></i> SKK Baru <span class="tab-count">{{ $sumBaru['total'] }}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="perpanjang-tab" data-bs-toggle="tab" data-bs-target="#perpanjang" type="button" role="tab"><i class="fas fa-sync-alt me-2"></i> Perpanjangan SKK <span class="tab-count">{{ $sumPerp['total'] }}</span></button>
                </li>
            </ul>

            <div class="tab-content" id="skkTabContent">
                @foreach($tabs as $tipe => $list)
                @php $perp = $tipe === 'perpanjang'; @endphp

                <!-- ================= TAB: {{ $perp ? 'PERPANJANGAN SKK' : 'SKK BARU' }} ================= -->
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $tipe }}" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pemohon</th>
                                    <th>Usaha &amp; Lokasi</th>
                                    <th>Kategori</th>
                                    @if($perp)<th>SKK Lama</th>@endif
                                    <th>Status</th>
                                    <th>Berkas Lampiran</th>
                                    <th style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($list as $p)
                                <tr class="row-skk"
                                    data-status="{{ $statusLabel($p->status_permohonan) }}"
                                    data-kecamatan="{{ mb_strtolower((string) $p->kecamatan) }}"
                                    data-search="{{ mb_strtolower($p->nama_pemohon . ' ' . $p->nama_usaha . ' ' . $p->nik_pemilik_usaha . ' ' . $p->no_whatsapp . ' ' . $p->nama_bangunan . ' ' . $p->kategori_bangunan . ' ' . $p->kecamatan . ' ' . $p->kelurahan . ' ' . ($perp ? $p->nomor_skk_lama : '')) }}">
                                    <td>
                                        <strong>{{ $p->created_at->format('d M Y') }}</strong>
                                        <div style="font-size: .8rem; color: var(--steel-soft);">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <strong style="display: block; margin-bottom: 2px;">{{ $p->nama_pemohon }}</strong>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" style="font-size: .8rem; color: var(--success); text-decoration: none;">
                                            <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                        </a>
                                        <div style="font-size: .78rem; color: var(--steel); margin-top: 2px;">NIK: {{ $p->nik_pemilik_usaha }}</div>
                                    </td>
                                    <td>
                                        <strong>{{ $p->nama_usaha }}</strong>
                                        <div style="font-size: .8rem; color: var(--steel);">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>{{ $p->kategori_bangunan }}</td>
                                    @if($perp)
                                    <td>
                                        <strong>{{ $p->nomor_skk_lama ?: '-' }}</strong>
                                        <div style="font-size: .8rem; color: var(--steel);">Berlaku s/d {{ $p->masa_berlaku_skk_lama ? \Carbon\Carbon::parse($p->masa_berlaku_skk_lama)->format('d M Y') : '-' }}</div>
                                    </td>
                                    @endif
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

                                    <!-- Kolom Lampiran (dengan cek data offline) -->
                                    <td>
                                        @if($berkasAda($p->file_surat_permohonan))
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="attachment-link d-block">
                                                <i class="fas fa-file-pdf"></i> Surat Permohonan
                                            </a>
                                        @else
                                            <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                                <i class="fas fa-file-pdf"></i> Surat Permohonan (Offline)
                                            </span>
                                        @endif

                                        @if($berkasAda($p->file_persyaratan_lainnya))
                                            <a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="attachment-link d-block">
                                                <i class="fas fa-paperclip"></i> Syarat Lainnya
                                            </a>
                                        @else
                                            <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                                <i class="fas fa-paperclip"></i> Syarat Lainnya (Offline)
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Kolom Aksi -->
                                    <td>
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe={{ $tipe }}" class="btn-action btn-lihat">
                                                <i class="fas fa-search" style="width: 14px;"></i> Detail
                                            </a>

                                            <!-- ==============================================
                                                 TOMBOL UPDATE/CRUD DIBUNGKUS HAK AKSES
                                                 ============================================== -->
                                            @hasanyrole('Pencegahan|Super User')
                                            <a href="{{ route('skk.edit', $p->id) }}{{ $perp ? '?tipe=perpanjang' : '' }}" class="btn-action btn-edit">
                                                <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                            </a>

                                            <button type="button" class="btn-action btn-update"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalUpdateStatus"
                                                data-action="{{ $perp ? '/internal/pencegahan/kelola-perpanjang-skk/update-status/' . $p->id : '/internal/pencegahan/kelola-skk/update-status/' . $p->id }}"
                                                data-nama="{{ $p->nama_usaha }}"
                                                data-jenis="{{ $perp ? 'perpanjangan' : 'baru' }}"
                                                data-status="{{ $p->status_permohonan }}">
                                                <i class="fas fa-edit" style="width: 14px;"></i> Status
                                            </button>

                                            <button type="button" class="btn-action btn-delete"
                                                data-delete-url="{{ route('skk.destroy', $p->id) }}{{ $perp ? '?tipe=perpanjang' : '' }}"
                                                data-nama="{{ $p->nama_usaha }}">
                                                <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                            </button>
                                            @endhasanyrole

                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe={{ $tipe }}&auto_print=true" target="_blank" class="btn-action btn-cetak">
                                                <i class="fas fa-print" style="width: 14px;"></i> Cetak
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ $perp ? 8 : 7 }}" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                        <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                        {{ $perp ? 'Belum ada pengajuan Perpanjangan SKK.' : 'Belum ada pengajuan SKK Baru.' }}
                                    </td>
                                </tr>
                                @endforelse

                                <!-- Pesan jika hasil pencarian/filter kosong pada tab ini -->
                                <tr class="row-noresult d-none">
                                    <td colspan="{{ $perp ? 8 : 7 }}" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                        <i class="fas fa-search mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                        Tidak ada permohonan yang cocok dengan pencarian atau filter.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ==============================================
             MODAL UPDATE STATUS (SATU MODAL UNTUK SEMUA BARIS) DIBUNGKUS HAK AKSES
             ============================================== -->
        @hasanyrole('Pencegahan|Super User')
        <div class="modal fade" id="modalUpdateStatus" tabindex="-1" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: none; border-radius: var(--r-md); box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                    <form id="formUpdateStatus" method="POST" action="">
                        @csrf
                        <div class="modal-header" style="background: var(--paper); border-bottom: 1px solid var(--line);">
                            <h5 class="modal-title" id="modalUpdateStatusLabel" style="font-family: var(--font-display); font-weight: 700; color: var(--ink);">
                                <i class="fas fa-edit text-primary me-2"></i> Update Status <span id="modalJenisLabel"></span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                Ubah status berkas pengajuan <strong id="modalPemohonName" class="text-dark"></strong>.
                            </p>

                            <div class="mb-2">
                                <label for="selectStatus" class="form-label fw-bold" style="font-size: 0.9rem; color: var(--ink);">Status Baru</label>
                                <select class="form-select shadow-sm" id="selectStatus" name="status_permohonan" required style="border-radius: 8px; cursor: pointer;">
                                    <option value="Pending">Pending</option>
                                    <option value="Diproses">Diproses Tim Inspeksi</option>
                                    <option value="Memenuhi Syarat">Memenuhi Syarat / Diterima</option>
                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat / Ditolak</option>
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
            if (!button) return;

            var form = document.getElementById('formUpdateStatus');
            form.action = button.getAttribute('data-action');

            document.getElementById('modalPemohonName').textContent = button.getAttribute('data-nama');
            document.getElementById('modalJenisLabel').textContent = button.getAttribute('data-jenis') === 'perpanjangan' ? 'Perpanjangan SKK' : 'SKK Baru';

            var select = document.getElementById('selectStatus');
            var status = button.getAttribute('data-status');
            if (!status) status = 'Pending';
            select.value = status;
            if (select.value !== status) select.value = 'Tidak Memenuhi Syarat';
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

    /* ---------- Konfirmasi Hapus dengan SweetAlert2 ---------- */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-delete-url]');
        if (!btn) return;

        var url  = btn.getAttribute('data-delete-url');
        var nama = btn.getAttribute('data-nama') || '';

        var info = document.createElement('div');
        var strong = document.createElement('strong');
        strong.textContent = nama;
        info.appendChild(document.createTextNode('Anda yakin ingin menghapus data permohonan SKK '));
        info.appendChild(strong);
        info.appendChild(document.createTextNode('? Data tidak dapat dikembalikan.'));

        Swal.fire({
            title: 'Hapus Data?',
            html: info,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then(function (result) {
            if (!result.isConfirmed) return;

            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrf = document.createElement('input');
            csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';

            var method = document.createElement('input');
            method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';

            form.appendChild(csrf);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        });
    });
})();

/* ---------- Pencarian & Filter (Status + Kecamatan, berlaku untuk kedua tab) ---------- */
var elSearch = document.getElementById('searchSkk');
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
    var sedangFilter = !!(f.q || f.st || f.kec);
    var totalShown = 0, totalAll = 0;

    ['baru', 'perpanjang'].forEach(function (tipe) {
        var pane = document.getElementById(tipe);
        if (!pane) return;

        var rows = pane.querySelectorAll('tr.row-skk');
        var shown = 0;

        rows.forEach(function (tr) {
            var ok = cocokFilter(tr.dataset.search, tr.dataset.status, tr.dataset.kecamatan, f);
            tr.classList.toggle('d-none', !ok);
            if (ok) shown++;
        });

        totalShown += shown;
        totalAll   += rows.length;

        // Badge jumlah pada tab: "hasil/total" saat difilter
        var badge = document.querySelector('#' + tipe + '-tab .tab-count');
        if (badge) badge.textContent = (sedangFilter && shown !== rows.length) ? (shown + '/' + rows.length) : rows.length;

        // Pesan "tidak ada hasil" per tab (hanya jika tab ini punya data tetapi semuanya tersaring)
        var empty = pane.querySelector('tr.row-noresult');
        if (empty) empty.classList.toggle('d-none', !(rows.length > 0 && shown === 0));
    });

    var cnt = document.getElementById('filterCount');
    if (cnt) cnt.innerHTML = 'Menampilkan <strong>' + totalShown + '</strong> dari <strong>' + totalAll + '</strong> berkas';
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
    var s = { total: rows.length, diurus: 0, pending: 0, diproses: 0, memenuhi: 0, tidak: 0 };
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
var REKAP_ALL = @json($rekapData);

function rekapKolom(perpanjang) {
    var c = [
        { k: 'no',              t: 'No',                     w: 6,  a: 'center' },
        { k: 'tgl_pengajuan',   t: 'Tgl. Pengajuan',         w: 17, a: 'center' },
        { k: 'nama_pemohon',    t: 'Nama Pemohon',           w: 24 },
        { k: 'no_whatsapp',     t: 'No. WhatsApp',           w: 16, txt: true },
        { k: 'email',           t: 'Email',                  w: 28 },
        { k: 'nama_usaha',      t: 'Nama Usaha / Instansi',  w: 28 },
        { k: 'nik',             t: 'NIK Pemilik Usaha',      w: 20, txt: true },
        { k: 'alamat_pemilik',  t: 'Alamat Pemilik Usaha',   w: 34 },
        { k: 'nama_bangunan',   t: 'Nama Bangunan',          w: 28 },
        { k: 'kategori',        t: 'Fungsi Bangunan',        w: 24 },
        { k: 'konstruksi',      t: 'Konstruksi',             w: 20 },
        { k: 'nomor_imb',       t: 'No. IMB / PBG',          w: 20 },
        { k: 'alamat_bangunan', t: 'Alamat Bangunan',        w: 38 },
        { k: 'kecamatan',       t: 'Kecamatan',              w: 18 },
        { k: 'kelurahan',       t: 'Kelurahan',              w: 18 },
        { k: 'luas_lahan',      t: 'Luas Tanah (m²)',        w: 14, num: true },
        { k: 'luas_bangunan',   t: 'Luas Bangunan (m²)',     w: 16, num: true },
        { k: 'jumlah_lantai',   t: 'Lantai',                 w: 9,  a: 'center' },
        { k: 'tinggi_bangunan', t: 'Tinggi (m)',             w: 11, num: true }
    ];
    if (perpanjang) {
        c.push({ k: 'nomor_skk_lama',        t: 'No. SKK Lama',          w: 22 });
        c.push({ k: 'masa_berlaku_skk_lama', t: 'Masa Berlaku SKK Lama', w: 20, a: 'center' });
    }
    c.push({ k: 'status',     t: 'Status',           w: 22, a: 'center' });
    c.push({ k: 'jml_berkas', t: 'Berkas Terlampir', w: 15, a: 'center' });
    return c;
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }

    // Ikuti filter yang sedang aktif di layar (nomor urut & ringkasan dihitung ulang)
    var f = filterAktif();
    var ambil = function (list) {
        return list.filter(function (r) {
            return cocokFilter(r._search, r.status, r._kec, f);
        }).map(function (r, i) {
            return Object.assign({}, r, { no: i + 1 });
        });
    };
    var fBaru = ambil(REKAP_ALL.baru);
    var fPerp = ambil(REKAP_ALL.perpanjang);
    var sBaru = hitungSumRekap(fBaru);
    var sPerp = hitungSumRekap(fPerp);
    var sSemua = {};
    Object.keys(sBaru).forEach(function (k) { sSemua[k] = sBaru[k] + sPerp[k]; });

    var REKAP = {
        baru: fBaru,
        perpanjang: fPerp,
        sum: { baru: sBaru, perpanjang: sPerp, semua: sSemua }
    };

    if (!REKAP.baru.length && !REKAP.perpanjang.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Tidak ada data permohonan SKK yang sesuai untuk direkap.', confirmButtonColor: '#163a63' });
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
        var fillOf = function (argb) { return { type: 'pattern', pattern: 'solid', fgColor: { argb: argb } }; };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        /* ===== Sheet data (dipakai untuk SKK Baru & Perpanjangan) ===== */
        function buatSheet(nama, judul, rows, perpanjang, sum) {
            var HEAD = 5;
            var FIRST = HEAD + 1;
            var cols = rekapKolom(perpanjang);
            var NCOL = cols.length;
            var LAST = HEAD + Math.max(rows.length, 1);
            var stIdx = cols.map(function (c) { return c.k; }).indexOf('status') + 1;

            var ws = wb.addWorksheet(nama, {
                views: [{ state: 'frozen', ySplit: HEAD, xSplit: 3 }],
                pageSetup: { paperSize: 9, orientation: 'landscape', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
            });
            cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c.w; });

            ws.mergeCells(1, 1, 1, NCOL);
            ws.getCell('A1').value = judul;
            ws.getCell('A1').font = { name: 'Calibri', size: 15, bold: true, color: { argb: NAVY } };
            ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
            ws.getRow(1).height = 26;

            ws.mergeCells(2, 1, 2, NCOL);
            ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
            ws.getCell('A2').font = { size: 11, bold: true };

            ws.mergeCells(3, 1, 3, NCOL);
            ws.getCell('A3').value = 'Dicetak: ' + tglCetak +
                '   |   Total berkas: ' + sum.total +
                '   |   Sedang diurus: ' + sum.diurus + ' (Pending ' + sum.pending + ', Diproses ' + sum.diproses + ')' +
                '   |   Memenuhi: ' + sum.memenuhi +
                '   |   Tidak memenuhi: ' + sum.tidak;
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

            if (!rows.length) {
                ws.mergeCells(FIRST, 1, FIRST, NCOL);
                var e = ws.getCell(FIRST, 1);
                e.value = 'Belum ada data permohonan.';
                e.font = { italic: true, color: { argb: 'FF64748B' } };
                e.alignment = { vertical: 'middle', horizontal: 'center' };
                e.border = border;
                ws.getRow(FIRST).height = 24;
            }

            rows.forEach(function (r, idx) {
                var row = ws.getRow(FIRST + idx);
                row.values = cols.map(function (c) { return r[c.k]; });
                row.eachCell({ includeEmpty: true }, function (cell, n) {
                    var c = cols[n - 1];
                    cell.border = border;
                    cell.alignment = { vertical: 'top', wrapText: true, horizontal: c.a || 'left' };
                    if (c.num) {
                        cell.numFmt = '#,##0.00';
                        cell.alignment = { vertical: 'top', horizontal: 'right' };
                    }
                    if (c.txt) cell.numFmt = '@';   // WhatsApp & NIK tetap teks (nol di depan aman)
                });
                var st = statusStyle[r.status];
                if (st) {
                    var sc = row.getCell(stIdx);
                    sc.fill = fillOf(st.bg);
                    sc.font = { bold: true, color: { argb: st.fg } };
                }
            });

            ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

            var L = ws.getColumn(stIdx).letter;
            return "'" + nama + "'!$" + L + '$' + FIRST + ':$' + L + '$' + LAST;
        }

        var rngBaru = buatSheet('SKK Baru', 'REKAP PERMOHONAN SERTIFIKAT KEAMANAN KEBAKARAN (SKK) - BARU', REKAP.baru, false, REKAP.sum.baru);
        var rngPerp = buatSheet('Perpanjangan SKK', 'REKAP PERMOHONAN PERPANJANGAN SERTIFIKAT KEAMANAN KEBAKARAN (SKK)', REKAP.perpanjang, true, REKAP.sum.perpanjang);

        /* ===== Sheet Ringkasan Status ===== */
        var sm = wb.addWorksheet('Ringkasan Status');
        sm.getColumn(1).width = 38;
        sm.getColumn(2).width = 14;
        sm.getColumn(3).width = 18;
        sm.getColumn(4).width = 14;
        sm.mergeCells('A1:D1');
        sm.getCell('A1').value = 'RINGKASAN BERKAS SKK';
        sm.getCell('A1').font = { size: 14, bold: true, color: { argb: NAVY } };
        sm.getCell('A2').value = 'Per ' + tglCetak;
        sm.getCell('A2').font = { italic: true, color: { argb: 'FF64748B' } };

        var S = REKAP.sum;
        var statusRows = [
            ['Pending',               'pending'],
            ['Diproses Tim',          'diproses'],
            ['Memenuhi Syarat',       'memenuhi'],
            ['Tidak Memenuhi Syarat', 'tidak']
        ];

        var headRow = sm.getRow(4);
        ['Status', 'SKK Baru', 'Perpanjangan SKK', 'Total'].forEach(function (t, i) { headRow.getCell(i + 1).value = t; });
        headRow.eachCell(function (c) {
            c.font = { bold: true, color: { argb: 'FFFFFFFF' } };
            c.fill = fillOf(NAVY);
            c.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            c.border = border;
        });
        headRow.height = 26;

        statusRows.forEach(function (d, i) {
            var r = 5 + i;
            var rw = sm.getRow(r);
            rw.getCell(1).value = d[0];
            rw.getCell(2).value = { formula: 'COUNTIF(' + rngBaru + ',"' + d[0] + '")', result: S.baru[d[1]] };
            rw.getCell(3).value = { formula: 'COUNTIF(' + rngPerp + ',"' + d[0] + '")', result: S.perpanjang[d[1]] };
            rw.getCell(4).value = { formula: 'B' + r + '+C' + r, result: S.semua[d[1]] };
            for (var n = 1; n <= 4; n++) {
                var c = rw.getCell(n);
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 1 ? 'left' : 'center' };
            }
            rw.getCell(1).fill = fillOf(statusStyle[d[0]].bg);
            rw.getCell(1).font = { bold: true, color: { argb: statusStyle[d[0]].fg } };
        });

        var totalRow = sm.getRow(9);
        totalRow.getCell(1).value = 'TOTAL BERKAS';
        totalRow.getCell(2).value = { formula: 'SUM(B5:B8)', result: S.baru.total };
        totalRow.getCell(3).value = { formula: 'SUM(C5:C8)', result: S.perpanjang.total };
        totalRow.getCell(4).value = { formula: 'SUM(D5:D8)', result: S.semua.total };

        var diurusRow = sm.getRow(10);
        diurusRow.getCell(1).value = 'Sedang Diurus (Pending + Diproses Tim)';
        diurusRow.getCell(2).value = { formula: 'B5+B6', result: S.baru.diurus };
        diurusRow.getCell(3).value = { formula: 'C5+C6', result: S.perpanjang.diurus };
        diurusRow.getCell(4).value = { formula: 'D5+D6', result: S.semua.diurus };

        [totalRow, diurusRow].forEach(function (rw) {
            for (var n = 1; n <= 4; n++) {
                var c = rw.getCell(n);
                c.font = { bold: true };
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 1 ? 'left' : 'center' };
            }
        });

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_SKK_' + tglFile + '.xlsx';
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
</script>
@endpush