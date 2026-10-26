@extends('layouts.dashboard')

@section('title', 'Kelola Kunjungan Edukasi & Sosialisasi')

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

    /* ---------- Header Halaman ---------- */
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
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-pending { border-left-color: #d97706; }
    .rekap-pending .rekap-ico { background: rgba(244, 183, 64, .15); color: #d97706; }
    .rekap-proses  { border-left-color: var(--info); }
    .rekap-proses  .rekap-ico { background: var(--info-soft); color: var(--info); }
    .rekap-ok      { border-left-color: var(--success); }
    .rekap-ok      .rekap-ico { background: rgba(25, 135, 84, .15); color: var(--success); }
    .rekap-no      { border-left-color: var(--signal); }
    .rekap-no      .rekap-ico { background: var(--signal-soft); color: var(--signal-dark); }

    /* ---------- Card & Tabel ---------- */
    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }

    /* ---------- Badge & Tombol Aksi ---------- */
    .badge-status { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-pending  { background: rgba(244, 183, 64, .15); color: #d97706; }
    .status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-tidak    { background: var(--signal-soft); color: var(--signal-dark); }

    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-lihat { background: var(--info-soft); color: var(--info); }
    .btn-lihat:hover { background: var(--info); color: #ffffff; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-update { background: var(--navy-soft); color: var(--navy); }
    .btn-update:hover { background: var(--navy); color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }
    .btn-cetak { background: var(--paper); color: var(--steel); border: 1px solid var(--line); }
    .btn-cetak:hover { background: var(--steel-soft); color: #ffffff; border-color: var(--steel-soft); }

    .attachment-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; color: var(--info); font-weight: 500; text-decoration: none; margin-bottom: 4px; transition: color .2s; }
    .attachment-link:hover { color: var(--navy-dark); text-decoration: underline; }
    .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

    /* ---------- Toolbar Pencarian & Filter ---------- */
    .filter-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; margin-bottom: 18px; }
    .filter-search { position: relative; flex: 1 1 280px; min-width: 220px; }
    .filter-search > i.fa-search { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .filter-search .form-control { height: 42px; padding-left: 38px; padding-right: 36px; border-radius: 8px; font-size: .9rem; border: 1.5px solid var(--line-dark); }
    .filter-search .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .filter-clear { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 26px; height: 26px; border: none; border-radius: 50%; background: transparent; color: var(--steel-soft); display: none; place-items: center; cursor: pointer; }
    .filter-clear:hover { background: var(--paper); color: var(--ink); }
    .filter-search.has-value .filter-clear { display: grid; }
    .filter-status { flex: 0 0 200px; }
    .filter-status .form-select { height: 42px; border-radius: 8px; font-size: .9rem; border: 1.5px solid var(--line-dark); cursor: pointer; }
    .btn-reset-filter { height: 42px; padding: 0 16px; border-radius: 8px; border: 1.5px solid var(--line-dark); background: #fff; color: var(--steel); font-size: .85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all .2s; }
    .btn-reset-filter:hover { background: var(--paper); color: var(--ink); }
    .filter-count { margin-left: auto; font-size: .82rem; color: var(--steel); white-space: nowrap; }
    .filter-count strong { color: var(--ink); }
    @media (max-width: 700px) {
        .filter-status { flex: 1 1 100%; }
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
        .content-card { padding: 14px; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
</style>
@endpush

@section('content')
@php
    $offlineVals = ['offline_registered', 'Tidak dilampirkan (Offline)', '["Tidak dilampirkan (Offline)"]'];
    $berkasAda   = fn($v) => !empty($v) && !in_array($v, $offlineVals, true);

    $statusLabelMap = [
        'Pending'   => 'Pending',
        'Disetujui' => 'Disetujui',
    ];
    $statusLabel = fn($s) => $statusLabelMap[$s] ?? 'Ditolak';

    $listPermohonan = collect($permohonan);

    /* ---------- Penghitung status & peserta ---------- */
    $sum = ['total' => $listPermohonan->count(), 'pending' => 0, 'disetujui' => 0, 'ditolak' => 0, 'peserta' => 0];
    foreach ($listPermohonan as $p) {
        $st = $statusLabel($p->status_permohonan);
        if ($st === 'Pending') $sum['pending']++;
        elseif ($st === 'Disetujui') $sum['disetujui']++;
        else $sum['ditolak']++;

        $sum['peserta'] += (int) $p->usia_3_6 + (int) $p->usia_7_12 + (int) $p->usia_13_18 + (int) $p->usia_18_keatas;
    }

    /* ---------- Data untuk Rekap Excel (.xlsx) ---------- */
    $barisExcel = $listPermohonan->values()->map(function ($p, $i) use ($statusLabel, $berkasAda) {
        $kontak = is_array($p->no_kontak) ? ($p->no_kontak[0] ?? '') : (string) $p->no_kontak;

        $suratArr  = collect(\Illuminate\Support\Arr::wrap($p->surat_permohonan))->filter($berkasAda)->values();
        $syaratArr = collect(\Illuminate\Support\Arr::wrap($p->syarat_lainnya))->filter($berkasAda)->values();
        $jmlBerkas = $suratArr->count() + $syaratArr->count();

        $u3_6   = (int) $p->usia_3_6;
        $u7_12  = (int) $p->usia_7_12;
        $u13_18 = (int) $p->usia_13_18;
        $u18_up = (int) $p->usia_18_keatas;
        $totalP = $u3_6 + $u7_12 + $u13_18 + $u18_up;

        return [
            'no'            => $i + 1,
            'tgl_pengajuan' => $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-',
            'institusi'     => (string) $p->institusi,
            'kecamatan'     => (string) ($p->kecamatan ?: '-'),
            'kelurahan'     => (string) ($p->kelurahan ?? '-'),
            'alamat'        => (string) ($p->alamat_institusi ?? $p->alamat_lengkap ?? $p->alamat ?? '-'),
            'nama_pemohon'  => (string) $p->nama_pemohon,
            'no_kontak'     => (string) $kontak,
            'tgl_kegiatan'  => $p->tgl_kegiatan ? \Carbon\Carbon::parse($p->tgl_kegiatan)->format('d/m/Y') : '-',
            'usia_3_6'      => $u3_6,
            'usia_7_12'     => $u7_12,
            'usia_13_18'    => $u13_18,
            'usia_18_up'    => $u18_up,
            'total_peserta' => $totalP,
            'status'        => $statusLabel($p->status_permohonan),
            'jml_berkas'    => $jmlBerkas,
        ];
    })->all();

    $rekapData = [
        'rows' => $barisExcel,
        'sum'  => $sum,
    ];
@endphp

        <div class="page-head">
            <div class="page-head-title">
                <h1>Daftar Kunjungan Edukasi &amp; Sosialisasi</h1>
                <p>Kelola pengajuan layanan edukasi dan sosialisasi ke masyarakat dan instansi.</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <!-- ==============================================
                     TOMBOL TAMBAH DIBUNGKUS HAK AKSES
                     ============================================== -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/kelola-edukasi/tambah" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Data Offline
                </a>
                @endhasanyrole

                <button type="button" id="btnExportExcel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>
            </div>
        </div>

        <!-- ==============================================
             PENGHITUNG BERKAS & STATUS PENGAJUAN EDUKASI
             ============================================== -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-folder-open"></i></div>
                <div>
                    <div class="rekap-num">{{ $sum['total'] }}</div>
                    <div class="rekap-label">Total Pengajuan</div>
                    <div class="rekap-sub">Seluruh permohonan</div>
                </div>
            </div>
            <div class="rekap-item rekap-pending">
                <div class="rekap-ico"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="rekap-num">{{ $sum['pending'] }}</div>
                    <div class="rekap-label">Pending</div>
                    <div class="rekap-sub">Menunggu verifikasi</div>
                </div>
            </div>
            <div class="rekap-item rekap-ok">
                <div class="rekap-ico"><i class="fas fa-check-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $sum['disetujui'] }}</div>
                    <div class="rekap-label">Disetujui</div>
                    <div class="rekap-sub">Jadwal diterima</div>
                </div>
            </div>
            <div class="rekap-item rekap-no">
                <div class="rekap-ico"><i class="fas fa-times-circle"></i></div>
                <div>
                    <div class="rekap-num">{{ $sum['ditolak'] }}</div>
                    <div class="rekap-label">Ditolak</div>
                    <div class="rekap-sub">Tidak dapat diproses</div>
                </div>
            </div>
            <div class="rekap-item rekap-proses">
                <div class="rekap-ico"><i class="fas fa-users"></i></div>
                <div>
                    <div class="rekap-num">{{ number_format($sum['peserta'], 0, ',', '.') }}</div>
                    <div class="rekap-label">Total Peserta</div>
                    <div class="rekap-sub">Akumulasi seluruh usia</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <!-- ==============================================
                 PENCARIAN & FILTER STATUS
                 ============================================== -->
            <div class="filter-bar">
                <div class="filter-search" id="filterSearchWrap">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchEdukasi" class="form-control"
                           placeholder="Cari institusi, pemohon, kecamatan, atau no. kontak..."
                           autocomplete="off">
                    <button type="button" id="btnClearSearch" class="filter-clear" aria-label="Hapus pencarian">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="filter-status">
                    <select id="filterStatus" class="form-select" aria-label="Filter status">
                        <option value="">Semua Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>

                <button type="button" id="btnResetFilter" class="btn-reset-filter">
                    <i class="fas fa-rotate-left"></i> Reset
                </button>

                <div class="filter-count" id="filterCount">
                    Menampilkan <strong>{{ $sum['total'] }}</strong> dari <strong>{{ $sum['total'] }}</strong> pengajuan
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Institusi &amp; Lokasi</th>
                            <th>Pemohon</th>
                            <th>Jadwal Kegiatan</th>
                            <th>Status</th>
                            <th>Berkas Lampiran</th>
                            <th style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        @php
                            $kontak = is_array($p->no_kontak) ? ($p->no_kontak[0] ?? '') : (string) $p->no_kontak;
                            $totalPeserta = (int) $p->usia_3_6 + (int) $p->usia_7_12 + (int) $p->usia_13_18 + (int) $p->usia_18_keatas;

                            $suratList  = collect(\Illuminate\Support\Arr::wrap($p->surat_permohonan))->filter($berkasAda)->values();
                            $syaratList = collect(\Illuminate\Support\Arr::wrap($p->syarat_lainnya))->filter($berkasAda)->values();
                        @endphp
                        <tr class="row-edukasi"
                            data-status="{{ $statusLabel($p->status_permohonan) }}"
                            data-search="{{ mb_strtolower($p->institusi . ' ' . $p->nama_pemohon . ' ' . ($p->kecamatan ?? '') . ' ' . ($p->kelurahan ?? '') . ' ' . $kontak) }}">
                            <td>
                                <strong>{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</strong>
                                <div style="font-size: .8rem; color: var(--steel-soft);">{{ $p->created_at ? $p->created_at->format('H:i') . ' WIB' : '' }}</div>
                            </td>
                            <td>
                                <strong>{{ $p->institusi }}</strong>
                                <div style="font-size: .8rem; color: var(--steel);">Kec. {{ $p->kecamatan ?: '-' }}</div>
                            </td>
                            <td>
                                <strong style="display: block; margin-bottom: 2px;">{{ $p->nama_pemohon }}</strong>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $kontak) }}" target="_blank" style="font-size: .8rem; color: var(--success); text-decoration: none;">
                                    <i class="fab fa-whatsapp"></i> {{ $kontak }}
                                </a>
                            </td>
                            <td>
                                <strong>{{ $p->tgl_kegiatan ? \Carbon\Carbon::parse($p->tgl_kegiatan)->format('d M Y') : '-' }}</strong>
                                <div style="font-size: .8rem; color: var(--steel);">Total: {{ $totalPeserta }} Peserta</div>
                            </td>
                            <td>
                                @if($p->status_permohonan == 'Pending')
                                    <span class="badge-status status-pending">Pending</span>
                                @elseif($p->status_permohonan == 'Disetujui')
                                    <span class="badge-status status-memenuhi">Disetujui</span>
                                @else
                                    <span class="badge-status status-tidak">Ditolak</span>
                                @endif
                            </td>

                            <!-- Kolom Lampiran (dengan cek data offline seperti SKK) -->
                            <td>
                                @forelse($suratList as $idx => $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="attachment-link d-block">
                                        <i class="fas fa-file-pdf"></i> Surat Permohonan{{ $suratList->count() > 1 ? ' ' . ($idx + 1) : '' }}
                                    </a>
                                @empty
                                    <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                        <i class="fas fa-file-pdf"></i> Surat Permohonan (Offline)
                                    </span>
                                @endforelse

                                @forelse($syaratList as $idx => $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="attachment-link d-block">
                                        <i class="fas fa-paperclip"></i> Syarat Lainnya{{ $syaratList->count() > 1 ? ' ' . ($idx + 1) : '' }}
                                    </a>
                                @empty
                                    <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                        <i class="fas fa-paperclip"></i> Syarat Lainnya (Offline)
                                    </span>
                                @endforelse
                            </td>

                            <!-- Kolom Aksi (seragam dengan Kelola SKK) -->
                            <td>
                                <div class="btn-action-group">
                                    <a href="/internal/pencegahan/kelola-edukasi/{{ $p->id }}" class="btn-action btn-lihat">
                                        <i class="fas fa-search" style="width: 14px;"></i> Detail
                                    </a>

                                    @hasanyrole('Pencegahan|Super User')
                                    <a href="{{ route('edukasi.offline.edit', $p->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>

                                    <button type="button" class="btn-action btn-update"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalUpdateStatus"
                                        data-action="/internal/pencegahan/kelola-edukasi/update-status/{{ $p->id }}"
                                        data-nama="{{ $p->institusi }}"
                                        data-status="{{ $p->status_permohonan }}">
                                        <i class="fas fa-edit" style="width: 14px;"></i> Status
                                    </button>

                                    <button type="button" class="btn-action btn-delete"
                                        data-delete-url="{{ route('edukasi.offline.destroy', $p->id) }}"
                                        data-nama="{{ $p->institusi }}">
                                        <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                    </button>
                                    @endhasanyrole

                                    <a href="/internal/pencegahan/kelola-edukasi/{{ $p->id }}?auto_print=true" target="_blank" class="btn-action btn-cetak">
                                        <i class="fas fa-print" style="width: 14px;"></i> Cetak
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada pengajuan Kunjungan Edukasi &amp; Sosialisasi.
                            </td>
                        </tr>
                        @endforelse

                        <tr id="rowNoResult" class="d-none">
                            <td colspan="7" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-search mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Tidak ada pengajuan yang cocok dengan pencarian atau filter.
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                                <i class="fas fa-edit text-primary me-2"></i> Update Status Edukasi
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                Ubah status pengajuan jadwal dari <strong id="modalInstitusiName" class="text-dark"></strong>.
                            </p>

                            <div class="mb-2">
                                <label for="selectStatus" class="form-label fw-bold" style="font-size: 0.9rem; color: var(--ink);">Status Baru</label>
                                <select class="form-select shadow-sm" id="selectStatus" name="status_permohonan" required style="border-radius: 8px; cursor: pointer;">
                                    <option value="Pending">Pending</option>
                                    <option value="Disetujui">Disetujui / Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
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

            document.getElementById('modalInstitusiName').textContent = button.getAttribute('data-nama');

            var select = document.getElementById('selectStatus');
            var status = button.getAttribute('data-status') || 'Pending';
            select.value = status;
            if (select.value !== status) select.value = 'Ditolak';
        });
    }

    /* ---------- Pencarian & Filter Status ---------- */
    var searchInput  = document.getElementById('searchEdukasi');
    var statusSelect = document.getElementById('filterStatus');
    var searchWrap   = document.getElementById('filterSearchWrap');
    var btnClear     = document.getElementById('btnClearSearch');
    var btnReset     = document.getElementById('btnResetFilter');
    var countEl      = document.getElementById('filterCount');
    var noResultRow  = document.getElementById('rowNoResult');
    var dataRows     = Array.prototype.slice.call(document.querySelectorAll('tr.row-edukasi'));

    function applyFilter() {
        var q  = searchInput.value.trim().toLowerCase();
        var st = statusSelect.value;
        var shown = 0;

        dataRows.forEach(function (tr) {
            var okText   = !q  || (tr.getAttribute('data-search') || '').indexOf(q) !== -1;
            var okStatus = !st || tr.getAttribute('data-status') === st;
            var visible  = okText && okStatus;
            tr.classList.toggle('d-none', !visible);
            if (visible) shown++;
        });

        searchWrap.classList.toggle('has-value', q.length > 0);
        countEl.innerHTML = 'Menampilkan <strong>' + shown + '</strong> dari <strong>' + dataRows.length + '</strong> pengajuan';

        // Tampilkan pesan "tidak ada hasil" hanya jika ada data tetapi semuanya tersaring
        if (noResultRow) noResultRow.classList.toggle('d-none', !(dataRows.length > 0 && shown === 0));
    }

    if (searchInput && statusSelect) {
        searchInput.addEventListener('input', applyFilter);
        statusSelect.addEventListener('change', applyFilter);

        btnClear.addEventListener('click', function () {
            searchInput.value = '';
            searchInput.focus();
            applyFilter();
        });

        btnReset.addEventListener('click', function () {
            searchInput.value = '';
            statusSelect.value = '';
            applyFilter();
        });
    }

    /* ---------- SweetAlert Notifikasi Sukses & Error ---------- */
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{!! session('success') !!}",
            confirmButtonColor: '#163a63',
            confirmButtonText: 'Tutup'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{!! session('error') !!}",
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
        info.appendChild(document.createTextNode('Anda yakin ingin menghapus data kunjungan edukasi '));
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

/* ---------- Rekap Excel (.xlsx menggunakan ExcelJS seperti Kelola SKK) ---------- */
var REKAP = @json($rekapData);

function rekapKolomEdukasi() {
    return [
        { k: 'no',            t: 'No',                    w: 6,  a: 'center' },
        { k: 'tgl_pengajuan', t: 'Tgl. Pengajuan',        w: 17, a: 'center' },
        { k: 'institusi',     t: 'Nama Institusi',        w: 30 },
        { k: 'kecamatan',     t: 'Kecamatan',             w: 18 },
        { k: 'nama_pemohon',  t: 'Nama Pemohon',          w: 24 },
        { k: 'no_kontak',     t: 'No. WhatsApp / Kontak', w: 18, txt: true },
        { k: 'tgl_kegiatan',  t: 'Jadwal Kegiatan',       w: 16, a: 'center' },
        { k: 'usia_3_6',      t: 'Usia 3-6 Thn',          w: 13, a: 'center', int: true },
        { k: 'usia_7_12',     t: 'Usia 7-12 Thn',         w: 13, a: 'center', int: true },
        { k: 'usia_13_18',    t: 'Usia 13-18 Thn',        w: 14, a: 'center', int: true },
        { k: 'usia_18_up',    t: 'Usia >18 Thn',          w: 13, a: 'center', int: true },
        { k: 'total_peserta', t: 'Total Peserta',         w: 14, a: 'center', int: true },
        { k: 'status',        t: 'Status',                w: 16, a: 'center' },
        { k: 'jml_berkas',    t: 'Berkas Terlampir',      w: 16, a: 'center' }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }
    if (!REKAP.rows.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Belum ada data pengajuan Kunjungan Edukasi & Sosialisasi untuk direkap.', confirmButtonColor: '#163a63' });
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
            'Pending':   { bg: 'FFFDF0D5', fg: 'FFB45309' },
            'Disetujui': { bg: 'FFD1E7DD', fg: 'FF146C43' },
            'Ditolak':   { bg: 'FFF8D7DA', fg: 'FFB42332' }
        };
        var fillOf = function (argb) { return { type: 'pattern', pattern: 'solid', fgColor: { argb: argb } }; };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        /* ===== Sheet 1: Data Kunjungan Edukasi ===== */
        var rows  = REKAP.rows;
        var sum   = REKAP.sum;
        var HEAD  = 5;
        var FIRST = HEAD + 1;
        var cols  = rekapKolomEdukasi();
        var NCOL  = cols.length;
        var LAST  = HEAD + Math.max(rows.length, 1);
        var stIdx = cols.map(function (c) { return c.k; }).indexOf('status') + 1;
        var totPesertaIdx = cols.map(function (c) { return c.k; }).indexOf('total_peserta') + 1;

        var ws = wb.addWorksheet('Kunjungan Edukasi', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 3 }],
            pageSetup: { paperSize: 9, orientation: 'landscape', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
        });
        cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c.w; });

        ws.mergeCells(1, 1, 1, NCOL);
        ws.getCell('A1').value = 'REKAP PERMOHONAN KUNJUNGAN EDUKASI & SOSIALISASI';
        ws.getCell('A1').font = { name: 'Calibri', size: 15, bold: true, color: { argb: NAVY } };
        ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
        ws.getRow(1).height = 26;

        ws.mergeCells(2, 1, 2, NCOL);
        ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        ws.getCell('A2').font = { size: 11, bold: true };

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak +
            '   |   Total berkas: ' + sum.total +
            '   |   Pending: ' + sum.pending +
            '   |   Disetujui: ' + sum.disetujui +
            '   |   Ditolak: ' + sum.ditolak +
            '   |   Total Peserta: ' + sum.peserta;
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
                if (c.txt) cell.numFmt = '@'; // No. WhatsApp tetap teks (angka 0 di depan aman)
            });
            var st = statusStyle[r.status];
            if (st) {
                var sc = row.getCell(stIdx);
                sc.fill = fillOf(st.bg);
                sc.font = { bold: true, color: { argb: st.fg } };
            }
        });

        ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

        /* ===== Sheet 2: Ringkasan Status ===== */
        var stLetter = ws.getColumn(stIdx).letter;
        var psLetter = ws.getColumn(totPesertaIdx).letter;
        var rngStatus  = "'Kunjungan Edukasi'!$" + stLetter + '$' + FIRST + ':$' + stLetter + '$' + LAST;
        var rngPeserta = "'Kunjungan Edukasi'!$" + psLetter + '$' + FIRST + ':$' + psLetter + '$' + LAST;

        var sm = wb.addWorksheet('Ringkasan Status');
        sm.getColumn(1).width = 32;
        sm.getColumn(2).width = 18;
        sm.getColumn(3).width = 20;

        sm.mergeCells('A1:C1');
        sm.getCell('A1').value = 'RINGKASAN PENGAJUAN KUNJUNGAN EDUKASI & SOSIALISASI';
        sm.getCell('A1').font = { size: 14, bold: true, color: { argb: NAVY } };
        sm.getCell('A2').value = 'Per ' + tglCetak;
        sm.getCell('A2').font = { italic: true, color: { argb: 'FF64748B' } };

        var headRow = sm.getRow(4);
        ['Status Permohonan', 'Jumlah Berkas', 'Total Peserta'].forEach(function (t, i) { headRow.getCell(i + 1).value = t; });
        headRow.eachCell(function (c) {
            c.font = { bold: true, color: { argb: 'FFFFFFFF' } };
            c.fill = fillOf(NAVY);
            c.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            c.border = border;
        });
        headRow.height = 26;

        var statusRows = [
            ['Pending',   'pending'],
            ['Disetujui', 'disetujui'],
            ['Ditolak',   'ditolak']
        ];

        statusRows.forEach(function (d, i) {
            var r = 5 + i;
            var rw = sm.getRow(r);
            var jmlPesertaStatus = rows.filter(function (x) { return x.status === d[0]; })
                                       .reduce(function (acc, x) { return acc + x.total_peserta; }, 0);

            rw.getCell(1).value = d[0];
            rw.getCell(2).value = { formula: 'COUNTIF(' + rngStatus + ',"' + d[0] + '")', result: sum[d[1]] };
            rw.getCell(3).value = { formula: 'SUMIF(' + rngStatus + ',"' + d[0] + '",' + rngPeserta + ')', result: jmlPesertaStatus };

            for (var n = 1; n <= 3; n++) {
                var c = rw.getCell(n);
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 1 ? 'left' : 'center' };
                if (n === 3) c.numFmt = '#,##0';
            }
            rw.getCell(1).fill = fillOf(statusStyle[d[0]].bg);
            rw.getCell(1).font = { bold: true, color: { argb: statusStyle[d[0]].fg } };
        });

        var totalRow = sm.getRow(8);
        totalRow.getCell(1).value = 'TOTAL KESELURUHAN';
        totalRow.getCell(2).value = { formula: 'SUM(B5:B7)', result: sum.total };
        totalRow.getCell(3).value = { formula: 'SUM(C5:C7)', result: sum.peserta };

        for (var n = 1; n <= 3; n++) {
            var tc = totalRow.getCell(n);
            tc.font = { bold: true };
            tc.border = border;
            tc.alignment = { vertical: 'middle', horizontal: n === 1 ? 'left' : 'center' };
            if (n === 3) tc.numFmt = '#,##0';
        }

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_Edukasi_Sosialisasi_' + tglFile + '.xlsx';
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