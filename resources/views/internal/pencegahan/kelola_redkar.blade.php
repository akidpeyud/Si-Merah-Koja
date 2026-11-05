@extends('layouts.dashboard')

@section('title', 'Kelola Redkar')

@push('styles')
<style>
    /* ---------- Header Halaman ---------- */
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .btn-add, .btn-excel { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
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
    .table-redkar > :not(caption) > * > * { padding: 12px 14px; border-color: #e2e8f0; color: var(--ink); font-size: .88rem; vertical-align: middle; }
    .table-redkar thead th { background: #163a63; color: #ffffff; border-color: #244b7a; font-size: .80rem; font-weight: 700; letter-spacing: .02em; text-align: center; white-space: nowrap; }
    .table-redkar tbody tr { transition: background .15s; }
    .table-redkar tbody tr:hover { background: #f8fafc; }

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

    /* ---------- Badges & Buttons ---------- */
    .badge-status { display: inline-flex; align-items: center; gap: 4px; padding: 4px 9px; border-radius: 6px; font-size: .75rem; font-weight: 700; white-space: nowrap; }
    .badge-ya { background: #fde8e8; color: #9b1c1c; border: 1px solid #f8b4b4; }
    .badge-tidak { background: #def7ec; color: #03543f; border: 1px solid #bcf0da; }
    .badge-sehat { background: #def7ec; color: #03543f; border: 1px solid #bcf0da; }
    .badge-tidaksehat { background: #fde8e8; color: #9b1c1c; border: 1px solid #f8b4b4; }

    .btn-action-group { display: inline-flex; flex-direction: row; align-items: center; gap: 6px; flex-wrap: nowrap; white-space: nowrap; }
    .btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 5px; height: 32px; padding: 0 10px; border-radius: 6px; font-size: .78rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; cursor: pointer; white-space: nowrap; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }

    .attachment-link { display: inline-flex; align-items: center; gap: 4px; font-size: .75rem; color: var(--info); font-weight: 500; text-decoration: none; margin-top: 3px; white-space: nowrap; }
    .attachment-link:hover { color: var(--navy-dark); text-decoration: underline; }
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
    $barisExcel = $listRelawan->values()->map(function ($r, $i) {
        $ttl    = trim(($r->tempat_lahir ?: '-') . ($r->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($r->tanggal_lahir)->format('d/m/Y') : ''));
        $alamat = trim(($r->alamat ?: '-') . ($r->rt_rw ? ', RT/RW ' . $r->rt_rw : '') . ($r->kelurahan ? ', Kel. ' . $r->kelurahan : '') . ($r->kecamatan ? ', Kec. ' . $r->kecamatan : ''));
        $tglBentuk = $r->tanggal_pembentukan ? \Carbon\Carbon::parse($r->tanggal_pembentukan)->format('d/m/Y') : '-';
        $tglKukuh  = $r->tanggal_pengukuhan ? \Carbon\Carbon::parse($r->tanggal_pengukuhan)->format('d/m/Y') : '-';

        return [
            'no'                  => $i + 1,
            'nama_lengkap'        => (string) $r->nama_lengkap,
            'nik'                 => (string) $r->nik,
            'ttl'                 => $ttl,
            'jenis_kelamin'       => (string) ($r->jenis_kelamin ?: '-'),
            'alamat_lengkap'      => $alamat,
            'agama'               => (string) ($r->agama ?: '-'),
            'pekerjaan'           => (string) ($r->pekerjaan ?: '-'),
            'golongan_darah'      => (string) ($r->golongan_darah ?: '-'),
            'buta_warna'          => (string) ($r->buta_warna ?: 'Tidak'),
            'sehat_jasmani'       => (string) ($r->sehat_jasmani ?: 'Sehat'),
            'nomor_telp'          => (string) $r->nomor_telp,
            'tanggal_pembentukan' => $tglBentuk,
            'tanggal_pengukuhan'  => $tglKukuh,
            '_search'             => strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp . ' ' . $r->alamat . ' ' . $r->pekerjaan),
            '_kec'                => strtolower((string) $r->kecamatan),
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
    ];
@endphp

        <div class="page-head">
            <div class="page-head-title">
                <h1>Data Relawan Pemadam Kebakaran (REDKAR)</h1>
                <p>Kelola data anggota Relawan Pemadam Kebakaran Kota Jambi.</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
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
                    <input type="search" id="rk-search" class="filter-input" placeholder="Cari nama, NIK, pekerjaan, alamat..." autocomplete="off">
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
                <table class="table table-bordered table-redkar align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Tempat Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Gol. Darah</th>
                            <th>Buta Warna</th>
                            <th>Sehat Jasmani Rohani</th>
                            <th>No Telfon / WA</th>
                            <th>Tanggal Pembentukan REDKAR</th>
                            <th>Tanggal Pengukuhan REDKAR</th>
                            <th class="no-print-col" style="min-width: 110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rk-body">
                        @forelse($relawan as $index => $r)
                        <tr class="rk-row"
                            data-search="{{ strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp . ' ' . $r->alamat . ' ' . $r->pekerjaan) }}"
                            data-kecamatan="{{ strtolower($r->kecamatan) }}">
                            {{-- 1. No --}}
                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>

                            {{-- 2. Nama --}}
                            <td class="fw-bold text-dark text-nowrap">{{ $r->nama_lengkap }}</td>

                            {{-- 3. NIK --}}
                            <td class="font-monospace fw-semibold text-nowrap">
                                {{ $r->nik }}
                                @if($berkasAda($r->file_ktp))
                                    <div>
                                        <a href="{{ asset('storage/' . $r->file_ktp) }}" target="_blank" class="attachment-link" title="Lihat foto KTP">
                                            <i class="fas fa-file-image"></i> Berkas KTP
                                        </a>
                                    </div>
                                @endif
                            </td>

                            {{-- 4. TTL --}}
                            <td class="text-nowrap">
                                {{ $r->tempat_lahir ?: '-' }}{{ $r->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($r->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y') : '' }}
                            </td>

                            {{-- 5. Jenis Kelamin --}}
                            <td class="text-nowrap text-center">{{ $r->jenis_kelamin ?: '-' }}</td>

                            {{-- 6. Alamat --}}
                            <td style="min-width: 220px; max-width: 320px; white-space: normal;">
                                {{ $r->alamat ?: '-' }}
                                @if($r->rt_rw && $r->rt_rw !== '00/00')
                                    , RT/RW {{ $r->rt_rw }}
                                @endif
                                @if($r->kelurahan)
                                    , Kel. {{ $r->kelurahan }}
                                @endif
                                @if($r->kecamatan)
                                    , Kec. {{ $r->kecamatan }}
                                @endif
                            </td>

                            {{-- 7. Agama --}}
                            <td class="text-nowrap text-center">{{ $r->agama ?: '-' }}</td>

                            {{-- 8. Pekerjaan --}}
                            <td class="text-nowrap">{{ $r->pekerjaan ?: '-' }}</td>

                            {{-- 9. Gol. Darah --}}
                            <td class="text-center fw-bold text-danger text-nowrap">{{ $r->golongan_darah ?: '-' }}</td>

                            {{-- 10. Buta Warna --}}
                            <td class="text-center text-nowrap">
                                {{ $r->buta_warna ?: 'Tidak' }}
                            </td>

                            {{-- 11. Sehat Jasmani Rohani --}}
                            <td class="text-center text-nowrap">
                                {{ $r->sehat_jasmani ?: 'Sehat' }}
                            </td>

                            {{-- 12. No Telfon / WA --}}
                            <td class="text-nowrap">
                                @if($r->nomor_telp)
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $r->nomor_telp)) }}" target="_blank" class="text-success text-decoration-none fw-bold d-inline-flex align-items-center gap-1">
                                        <i class="fab fa-whatsapp fs-6"></i> {{ $r->nomor_telp }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 13. Tanggal Pembentukan REDKAR --}}
                            <td class="text-center text-nowrap">
                                @if($r->tanggal_pembentukan)
                                    <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($r->tanggal_pembentukan)->locale('id')->isoFormat('D MMMM Y') }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 14. Tanggal Pengukuhan REDKAR --}}
                            <td class="text-center text-nowrap">
                                @if($r->tanggal_pengukuhan)
                                    <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($r->tanggal_pengukuhan)->locale('id')->isoFormat('D MMMM Y') }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 15. Aksi (Edit, Hapus) --}}
                            <td class="no-print-col text-center text-nowrap">
                                <div class="btn-action-group justify-content-center">
                                    @hasanyrole('Pencegahan|Super User')
                                    <a href="/internal/pencegahan/edit-redkar/{{ $r->id }}" class="btn-action btn-edit" title="Edit Data">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>
                                    <button type="button" class="btn-action btn-delete"
                                        data-delete-url="/internal/pencegahan/hapus-redkar/{{ $r->id }}"
                                        data-nama="{{ $r->nama_lengkap }}"
                                        title="Hapus Data">
                                        <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                    </button>
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="15" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data relawan REDKAR terdaftar.
                            </td>
                        </tr>
                        @endforelse
                        <tr id="rk-no-result" style="display: none;">
                            <td colspan="15" class="text-center py-5 text-muted" style="font-size: .95rem;">
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

var REKAP = @json($rekapData);

function rekapKolomRedkar() {
    return [
        { k: 'no',                  t: 'No',                         w: 6,  a: 'center' },
        { k: 'nama_lengkap',        t: 'Nama',                       w: 26 },
        { k: 'nik',                 t: 'NIK',                        w: 20, txt: true },
        { k: 'ttl',                 t: 'Tempat Tanggal Lahir',       w: 26 },
        { k: 'jenis_kelamin',       t: 'Jenis Kelamin',              w: 15, a: 'center' },
        { k: 'alamat_lengkap',      t: 'Alamat',                     w: 40 },
        { k: 'agama',               t: 'Agama',                      w: 14, a: 'center' },
        { k: 'pekerjaan',           t: 'Pekerjaan',                  w: 22 },
        { k: 'golongan_darah',      t: 'Gol. Darah',                 w: 12, a: 'center' },
        { k: 'buta_warna',          t: 'Buta Warna',                 w: 15, a: 'center' },
        { k: 'sehat_jasmani',       t: 'Sehat Jasmani Rohani',       w: 20, a: 'center' },
        { k: 'nomor_telp',          t: 'No Telfon / WA',             w: 18, txt: true },
        { k: 'tanggal_pembentukan', t: 'Tanggal Pembentukan REDKAR', w: 22, a: 'center' },
        { k: 'tanggal_pengukuhan',  t: 'Tanggal Pengukuhan REDKAR',  w: 22, a: 'center' }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }

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
        var fillOf = function (argb) { return { type: 'pattern', pattern: 'solid', fgColor: { argb: argb } }; };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        var HEAD  = 5;
        var FIRST = HEAD + 1;
        var cols  = rekapKolomRedkar();
        var NCOL  = cols.length;
        var LAST  = HEAD + Math.max(filteredRows.length, 1);

        var ws = wb.addWorksheet('Data Relawan REDKAR', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 2 }],
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

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak + '   |   Total relawan: ' + filteredRows.length;
        ws.getCell('A3').font = { size: 10, italic: true, color: { argb: 'FF64748B' } };

        var hr = ws.getRow(HEAD);
        cols.forEach(function (c, i) { hr.getCell(i + 1).value = c.t; });
        hr.height = 30;
        hr.eachCell(function (cell) {
            cell.font = { bold: true, color: { argb: 'FFFFFFFF' }, size: 10 };
            cell.fill = fillOf(NAVY);
            cell.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            cell.border = border;
        });

        filteredRows.forEach(function (row, rIdx) {
            var r = ws.getRow(FIRST + rIdx);
            r.height = 22;
            cols.forEach(function (c, cIdx) {
                var cell = r.getCell(cIdx + 1);
                var val  = row[c.k];

                if (c.txt && val !== null && val !== undefined && val !== '-') {
                    cell.value = String(val);
                    cell.numFmt = '@';
                } else {
                    cell.value = (val === null || val === undefined || val === '') ? '-' : val;
                }

                cell.alignment = {
                    vertical: 'middle',
                    horizontal: c.a || 'left',
                    wrapText: true
                };
                cell.border = border;
                cell.font = { size: 10 };
            });
        });

        var buf = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a    = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_REDKAR_' + tglFile + '.xlsx';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    } catch (err) {
        console.error(err);
        Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: 'Gagal mengekspor data ke Excel.', confirmButtonColor: '#163a63' });
    } finally {
        btn.disabled = false;
        btn.innerHTML = oldHtml;
    }
}

document.getElementById('btnExportExcel').addEventListener('click', exportRekapExcel);
</script>
@endpush
