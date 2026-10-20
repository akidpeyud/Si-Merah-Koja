@extends('layouts.dashboard')

@section('title', 'Kelola Redkar')

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

    /* ---------- Penghitung data & status ---------- */
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-proses  { border-left-color: var(--info); }
    .rekap-proses  .rekap-ico { background: var(--info-soft); color: var(--info); }
    .rekap-ok      { border-left-color: var(--success); }
    .rekap-ok      .rekap-ico { background: rgba(25, 135, 84, .15); color: var(--success); }
    .rekap-pending { border-left-color: #d97706; }
    .rekap-pending .rekap-ico { background: rgba(244, 183, 64, .15); color: #d97706; }

    /* ---------- Card & Tabel ---------- */
    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }

    /* ---------- Toolbar Filter & Pencarian ---------- */
    .filter-toolbar { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 18px; padding-bottom: 16px; border-bottom: 1px solid var(--line); }
    .search-box { position: relative; flex: 1 1 260px; max-width: 380px; }
    .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--steel-soft); font-size: .85rem; pointer-events: none; }
    .filter-input, .filter-select { height: 40px; border-radius: 8px; border: 1px solid var(--line); background: var(--paper); font-size: .88rem; color: var(--ink); transition: border-color .2s, box-shadow .2s, background .2s; }
    .filter-input { width: 100%; padding: 0 14px 0 36px; }
    .filter-select { padding: 0 32px 0 14px; min-width: 190px; cursor: pointer; }
    .filter-input:focus, .filter-select:focus { outline: none; background: #fff; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .filter-count { margin-left: auto; font-size: .84rem; color: var(--steel); }
    .filter-count b { color: var(--ink); }

    /* ---------- Badge & Tombol Aksi ---------- */
    .badge-status { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-diproses { background: var(--info-soft); color: var(--info); }
    .status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-pending  { background: rgba(244, 183, 64, .15); color: #d97706; }

    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }
    .btn-cetak { background: var(--paper); color: var(--steel); border: 1px solid var(--line); }
    .btn-cetak:hover { background: var(--steel-soft); color: #ffffff; border-color: var(--steel-soft); }

    .attachment-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; color: var(--info); font-weight: 500; text-decoration: none; margin-bottom: 4px; transition: color .2s; }
    .attachment-link:hover { color: var(--navy-dark); text-decoration: underline; }

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
        .filter-count { margin-left: 0; width: 100%; }
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

    $listRelawan     = collect($relawan);
    $totalRelawan    = $listRelawan->count();
    $daftarKecamatan = $listRelawan->pluck('kecamatan')->filter()->unique()->sort()->values();

    $jmlDenganKtp = $listRelawan->filter(fn($r) => $berkasAda($r->file_ktp))->count();
    $jmlTanpaKtp  = $totalRelawan - $jmlDenganKtp;

    /* ---------- Data untuk Rekap Excel (.xlsx) ---------- */
    $barisExcel = $listRelawan->values()->map(function ($r, $i) use ($berkasAda) {
        $adaKtp = $berkasAda($r->file_ktp);
        $ttl    = trim(($r->tempat_lahir ?: '-') . ($r->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($r->tanggal_lahir)->format('d/m/Y') : ''));
        $alamat = trim(($r->alamat ?: '-') . ($r->rt_rw ? ', RT/RW ' . $r->rt_rw : ''));
        $pend   = trim(($r->pendidikan_terakhir ?: '-') . ($r->latar_belakang_pendidikan ? ' (' . $r->latar_belakang_pendidikan . ')' : ''));

        return [
            'no'                => $i + 1,
            'id_reg'            => (string) $r->id,
            'tgl_input'         => $r->created_at ? $r->created_at->format('d/m/Y H:i') : '-',
            'nik'               => (string) $r->nik,
            'nama_lengkap'      => (string) $r->nama_lengkap,
            'jenis_kelamin'     => (string) ($r->jenis_kelamin ?: '-'),
            'ttl'               => $ttl,
            'agama'             => (string) ($r->agama ?: '-'),
            'status_perkawinan' => (string) ($r->status_perkawinan ?: '-'),
            'nomor_telp'        => (string) $r->nomor_telp,
            'alamat_lengkap'    => $alamat,
            'kecamatan'         => (string) ($r->kecamatan ?: '-'),
            'kelurahan'         => (string) ($r->kelurahan ?: '-'),
            'pendidikan'        => $pend,
            'pekerjaan'         => (string) ($r->pekerjaan ?: '-'),
            'status_ktp'        => $adaKtp ? 'Terlampir' : 'Belum Ada (Offline)',
            '_search'           => strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp),
            '_kec'              => strtolower((string) $r->kecamatan),
        ];
    })->all();

    $rekapData = [
        'rows' => $barisExcel,
        'sum'  => [
            'total'      => $totalRelawan,
            'kecamatan'  => $daftarKecamatan->count(),
            'dengan_ktp' => $jmlDenganKtp,
            'tanpa_ktp'  => $jmlTanpaKtp,
        ],
        'per_kecamatan' => $daftarKecamatan->map(fn($k) => [
            'nama'   => $k,
            'jumlah' => $listRelawan->where('kecamatan', $k)->count(),
        ])->values()->all(),
    ];
@endphp

        <div class="page-head">
            <div class="page-head-title">
                <h1>Data Relawan Pemadam Kebakaran (REDKAR)</h1>
                <p>Kelola data anggota Relawan Pemadam Kebakaran Kota Jambi.</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <!-- ==============================================
                     TOMBOL TAMBAH DIBUNGKUS HAK AKSES
                     ============================================== -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/tambah-redkar" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Relawan
                </a>
                @endhasanyrole

                <button type="button" id="btnExportExcel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>
            </div>
        </div>

        <!-- ==============================================
             PENGHITUNG RELAWAN & KELENGKAPAN BERKAS
             ============================================== -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-users"></i></div>
                <div>
                    <div class="rekap-num">{{ $totalRelawan }}</div>
                    <div class="rekap-label">Total Relawan</div>
                    <div class="rekap-sub">Terdaftar di sistem</div>
                </div>
            </div>
            <div class="rekap-item rekap-proses">
                <div class="rekap-ico"><i class="fas fa-map-marked-alt"></i></div>
                <div>
                    <div class="rekap-num">{{ $daftarKecamatan->count() }}</div>
                    <div class="rekap-label">Kecamatan</div>
                    <div class="rekap-sub">Wilayah cakupan</div>
                </div>
            </div>
            <div class="rekap-item rekap-ok">
                <div class="rekap-ico"><i class="fas fa-id-card"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlDenganKtp }}</div>
                    <div class="rekap-label">KTP Terlampir</div>
                    <div class="rekap-sub">Berkas digital tersedia</div>
                </div>
            </div>
            <div class="rekap-item rekap-pending">
                <div class="rekap-ico"><i class="fas fa-file-excel"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlTanpaKtp }}</div>
                    <div class="rekap-label">Tanpa KTP / Offline</div>
                    <div class="rekap-sub">Tidak dilampirkan</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            @if($totalRelawan > 0)
            <div class="filter-toolbar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" id="rk-search" class="filter-input" placeholder="Cari nama, NIK, atau nomor telepon..." autocomplete="off">
                </div>
                <select id="rk-kecamatan" class="filter-select">
                    <option value="">Semua Kecamatan</option>
                    @foreach($daftarKecamatan as $kec)
                        <option value="{{ strtolower($kec) }}">{{ $kec }}</option>
                    @endforeach
                </select>
                <div class="filter-count">
                    Menampilkan <b id="rk-shown">{{ $totalRelawan }}</b> dari {{ $totalRelawan }} relawan
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal Input</th>
                            <th>Relawan &amp; Kontak</th>
                            <th>Data Diri</th>
                            <th>Alamat &amp; Wilayah</th>
                            <th>Berkas Lampiran</th>
                            <th style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rk-body">
                        @forelse($relawan as $r)
                        <tr class="rk-row"
                            data-search="{{ strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp) }}"
                            data-kecamatan="{{ strtolower($r->kecamatan) }}">
                            <td>
                                <strong>{{ $r->created_at ? $r->created_at->format('d M Y') : '-' }}</strong>
                                <div style="font-size: .8rem; color: var(--steel-soft);">{{ $r->created_at ? $r->created_at->format('H:i') . ' WIB' : '' }}</div>
                            </td>
                            <td>
                                <strong style="display: block; margin-bottom: 2px;">{{ $r->nama_lengkap }}</strong>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->nomor_telp) }}" target="_blank" style="font-size: .8rem; color: var(--success); text-decoration: none;">
                                    <i class="fab fa-whatsapp"></i> {{ $r->nomor_telp }}
                                </a>
                                <div style="font-size: .78rem; color: var(--steel); margin-top: 2px;">NIK: {{ $r->nik }}</div>
                            </td>
                            <td>
                                <strong>{{ $r->jenis_kelamin ?: '-' }}</strong>
                                <div style="font-size: .8rem; color: var(--steel);">
                                    {{ $r->tempat_lahir ?: '-' }}{{ $r->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($r->tanggal_lahir)->format('d M Y') : '' }}
                                </div>
                                <div style="font-size: .78rem; color: var(--steel-soft); margin-top: 2px;">
                                    {{ $r->pekerjaan ?: '-' }} &bull; {{ $r->pendidikan_terakhir ?: '-' }}
                                </div>
                            </td>
                            <td>
                                <span class="badge-status status-diproses mb-1">
                                    <i class="fas fa-map-marker-alt"></i> Kec. {{ $r->kecamatan ?: '-' }}
                                </span>
                                <div style="font-size: .8rem; color: var(--steel);">Kel. {{ $r->kelurahan ?: '-' }}</div>
                                <div style="font-size: .78rem; color: var(--steel-soft);">{{ $r->alamat }}{{ $r->rt_rw ? ' (RT/RW ' . $r->rt_rw . ')' : '' }}</div>
                            </td>

                            <!-- Kolom Lampiran (dengan cek data offline seperti SKK) -->
                            <td>
                                @if($berkasAda($r->file_ktp))
                                    <a href="{{ asset('storage/' . $r->file_ktp) }}" target="_blank" class="attachment-link d-block">
                                        <i class="fas fa-id-card"></i> File KTP
                                    </a>
                                @else
                                    <span class="attachment-link d-block text-secondary" title="Tidak dilampirkan (data offline)">
                                        <i class="fas fa-id-card"></i> KTP (Offline)
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Aksi (seragam dengan Kelola SKK) -->
                            <td>
                                <div class="btn-action-group">
                                    @hasanyrole('Pencegahan|Super User')
                                    <a href="/internal/pencegahan/edit-redkar/{{ $r->id }}" class="btn-action btn-edit">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>

                                    <button type="button" class="btn-action btn-delete"
                                        data-delete-url="/internal/pencegahan/hapus-redkar/{{ $r->id }}"
                                        data-nama="{{ $r->nama_lengkap }}">
                                        <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                    </button>
                                    @endhasanyrole

                                    <a href="/internal/pencegahan/cetak-redkar/{{ $r->id }}" target="_blank" class="btn-action btn-cetak">
                                        <i class="fas fa-print" style="width: 14px;"></i> Cetak
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data relawan REDKAR terdaftar.
                            </td>
                        </tr>
                        @endforelse
                        <tr id="rk-no-result" style="display: none;">
                            <td colspan="6" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-search mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Relawan tidak ditemukan. Coba kata kunci lain atau pilih "Semua Kecamatan".
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if(method_exists($relawan, 'links'))
                <div class="mt-3">{{ $relawan->links() }}</div>
            @endif
        </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Filter Pencarian & Kecamatan ---------- */
    var search = document.getElementById('rk-search');
    var select = document.getElementById('rk-kecamatan');
    if (search && select) {
        var rows  = Array.prototype.slice.call(document.querySelectorAll('.rk-row'));
        var shown = document.getElementById('rk-shown');
        var empty = document.getElementById('rk-no-result');

        function applyFilter() {
            var q   = search.value.trim().toLowerCase();
            var kec = select.value;
            var n   = 0;

            rows.forEach(function (row) {
                var ok = (!q || row.dataset.search.indexOf(q) > -1) &&
                         (!kec || row.dataset.kecamatan === kec);
                row.style.display = ok ? '' : 'none';
                if (ok) n++;
            });

            if (shown) shown.textContent = n;
            if (empty) empty.style.display = n === 0 ? '' : 'none';
        }

        search.addEventListener('input', applyFilter);
        select.addEventListener('change', applyFilter);
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

    /* ---------- Konfirmasi Hapus dengan SweetAlert2 (Sama seperti SKK) ---------- */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-delete-url]');
        if (!btn) return;

        var url  = btn.getAttribute('data-delete-url');
        var nama = btn.getAttribute('data-nama') || '';

        var info = document.createElement('div');
        var strong = document.createElement('strong');
        strong.textContent = nama;
        info.appendChild(document.createTextNode('Anda yakin ingin menghapus data relawan REDKAR '));
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

function rekapKolomRedkar() {
    return [
        { k: 'no',                t: 'No',                     w: 6,  a: 'center' },
        { k: 'id_reg',            t: 'No. Register',           w: 14, a: 'center' },
        { k: 'tgl_input',         t: 'Tgl. Input',             w: 17, a: 'center' },
        { k: 'nik',               t: 'NIK',                    w: 20, txt: true },
        { k: 'nama_lengkap',      t: 'Nama Lengkap',           w: 26 },
        { k: 'jenis_kelamin',     t: 'Jenis Kelamin',          w: 15, a: 'center' },
        { k: 'ttl',               t: 'Tempat, Tanggal Lahir',  w: 26 },
        { k: 'agama',             t: 'Agama',                  w: 14, a: 'center' },
        { k: 'status_perkawinan', t: 'Status Perkawinan',      w: 18, a: 'center' },
        { k: 'nomor_telp',        t: 'No. Telepon / WA',       w: 18, txt: true },
        { k: 'alamat_lengkap',    t: 'Alamat Lengkap',         w: 36 },
        { k: 'kecamatan',         t: 'Kecamatan',              w: 20 },
        { k: 'kelurahan',         t: 'Kelurahan',              w: 20 },
        { k: 'pendidikan',        t: 'Pendidikan Terakhir',    w: 24 },
        { k: 'pekerjaan',         t: 'Pekerjaan',              w: 22 },
        { k: 'status_ktp',        t: 'Berkas KTP',             w: 20, a: 'center' }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }

    // Ikuti filter pencarian/kecamatan yang sedang aktif di layar
    var searchEl = document.getElementById('rk-search');
    var selectEl = document.getElementById('rk-kecamatan');
    var q   = searchEl ? searchEl.value.trim().toLowerCase() : '';
    var kec = selectEl ? selectEl.value : '';

    var filteredRows = REKAP.rows.filter(function (r) {
        return (!q || r._search.indexOf(q) > -1) && (!kec || r._kec === kec);
    }).map(function (r, i) {
        return Object.assign({}, r, { no: i + 1 });
    });

    if (!filteredRows.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Belum ada data relawan REDKAR yang sesuai untuk direkap.', confirmButtonColor: '#163a63' });
        return;
    }

    var oldHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';

    try {
        var NAVY = 'FF163A63';
        var thin = { style: 'thin', color: { argb: 'FFBFC8D4' } };
        var border = { top: thin, left: thin, bottom: thin, right: thin };
        var ktpStyle = {
            'Terlampir':           { bg: 'FFD1E7DD', fg: 'FF146C43' },
            'Belum Ada (Offline)': { bg: 'FFFDF0D5', fg: 'FFB45309' }
        };
        var fillOf = function (argb) { return { type: 'pattern', pattern: 'solid', fgColor: { argb: argb } }; };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        /* ===== Sheet 1: Data Relawan REDKAR ===== */
        var HEAD  = 5;
        var FIRST = HEAD + 1;
        var cols  = rekapKolomRedkar();
        var NCOL  = cols.length;
        var LAST  = HEAD + Math.max(filteredRows.length, 1);
        var ktpIdx = cols.map(function (c) { return c.k; }).indexOf('status_ktp') + 1;
        var kecIdx = cols.map(function (c) { return c.k; }).indexOf('kecamatan') + 1;

        var ws = wb.addWorksheet('Data Relawan REDKAR', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 5 }],
            pageSetup: { paperSize: 9, orientation: 'landscape', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
        });
        cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c.w; });

        ws.mergeCells(1, 1, 1, NCOL);
        ws.getCell('A1').value = 'REKAPITULASI DATA RELAWAN PEMADAM KEBAKARAN (REDKAR) KOTA JAMBI';
        ws.getCell('A1').font = { name: 'Calibri', size: 15, bold: true, color: { argb: NAVY } };
        ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
        ws.getRow(1).height = 26;

        ws.mergeCells(2, 1, 2, NCOL);
        ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        ws.getCell('A2').font = { size: 11, bold: true };

        var jmlKtpFilter = filteredRows.filter(function (r) { return r.status_ktp === 'Terlampir'; }).length;
        var jmlOffFilter = filteredRows.length - jmlKtpFilter;

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak +
            '   |   Total relawan: ' + filteredRows.length +
            '   |   KTP Terlampir: ' + jmlKtpFilter +
            '   |   Tanpa KTP (Offline): ' + jmlOffFilter;
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

        filteredRows.forEach(function (r, idx) {
            var row = ws.getRow(FIRST + idx);
            row.values = cols.map(function (c) { return r[c.k]; });
            row.eachCell({ includeEmpty: true }, function (cell, n) {
                var c = cols[n - 1];
                cell.border = border;
                cell.alignment = { vertical: 'top', wrapText: true, horizontal: c.a || 'left' };
                if (c.txt) cell.numFmt = '@'; // NIK & No. Telepon tetap teks
            });
            var st = ktpStyle[r.status_ktp];
            if (st) {
                var sc = row.getCell(ktpIdx);
                sc.fill = fillOf(st.bg);
                sc.font = { bold: true, color: { argb: st.fg } };
            }
        });

        ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

        /* ===== Sheet 2: Ringkasan per Kecamatan ===== */
        var kecLetter = ws.getColumn(kecIdx).letter;
        var rngKec = "'Data Relawan REDKAR'!$" + kecLetter + '$' + FIRST + ':$' + kecLetter + '$' + LAST;

        var sm = wb.addWorksheet('Ringkasan Kecamatan');
        sm.getColumn(1).width = 8;
        sm.getColumn(2).width = 34;
        sm.getColumn(3).width = 20;

        sm.mergeCells('A1:C1');
        sm.getCell('A1').value = 'RINGKASAN RELAWAN REDKAR PER KECAMATAN';
        sm.getCell('A1').font = { size: 14, bold: true, color: { argb: NAVY } };
        sm.getCell('A2').value = 'Per ' + tglCetak;
        sm.getCell('A2').font = { italic: true, color: { argb: 'FF64748B' } };

        var headSm = sm.getRow(4);
        ['No', 'Kecamatan', 'Jumlah Relawan'].forEach(function (t, i) { headSm.getCell(i + 1).value = t; });
        headSm.eachCell(function (c) {
            c.font = { bold: true, color: { argb: 'FFFFFFFF' } };
            c.fill = fillOf(NAVY);
            c.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            c.border = border;
        });
        headSm.height = 26;

        REKAP.per_kecamatan.forEach(function (item, i) {
            var r = 5 + i;
            var rw = sm.getRow(r);
            rw.getCell(1).value = i + 1;
            rw.getCell(2).value = item.nama;
            rw.getCell(3).value = { formula: 'COUNTIF(' + rngKec + ',"' + item.nama + '")', result: item.jumlah };
            for (var n = 1; n <= 3; n++) {
                var c = rw.getCell(n);
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 2 ? 'left' : 'center' };
            }
        });

        var endKecRow = 4 + REKAP.per_kecamatan.length;
        var totalRow = sm.getRow(endKecRow + 1);
        totalRow.getCell(1).value = '';
        totalRow.getCell(2).value = 'TOTAL RELAWAN';
        totalRow.getCell(3).value = {
            formula: endKecRow >= 5 ? 'SUM(C5:C' + endKecRow + ')' : '0',
            result: filteredRows.length
        };
        for (var n = 1; n <= 3; n++) {
            var tc = totalRow.getCell(n);
            tc.font = { bold: true };
            tc.border = border;
            tc.alignment = { vertical: 'middle', horizontal: n === 2 ? 'left' : 'center' };
        }

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_REDKAR_' + tglFile + '.xlsx';
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