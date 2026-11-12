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

    /* ---------- Pagination Tabel (30 baris/halaman) ---------- */
    .rk-pagination { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-top: 18px; padding-top: 14px; border-top: 1px solid var(--line); }
    .rk-page-btn { display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; padding: 0 10px; border-radius: 6px; border: 1px solid #d2dae5; background: #fff; color: var(--ink); font-size: .84rem; font-weight: 600; cursor: pointer; transition: all .15s; user-select: none; }
    .rk-page-btn:hover:not([disabled]):not(.active) { background: #f1f5f9; border-color: #cbd5e1; color: var(--navy-dark); }
    .rk-page-btn.active { background: #163a63; color: #fff; border-color: #163a63; cursor: default; }
    .rk-page-btn[disabled] { opacity: .45; cursor: not-allowed; }
    .rk-page-dots { display: inline-flex; align-items: center; justify-content: center; min-width: 24px; height: 34px; color: var(--steel-soft); font-size: .84rem; user-select: none; }
</style>
@endpush

@section('content')
@php
    $offlineVals = ['offline_registered', 'Tidak dilampirkan (Offline)', '["Tidak dilampirkan (Offline)"]'];
    $berkasAda   = fn($v) => !empty($v) && !in_array($v, $offlineVals, true);

    $listRelawan     = collect($relawan);
    $totalRelawan    = $listRelawan->count();
    $daftarKecamatan = $listRelawan->pluck('kecamatan')->filter()->unique()->sort()->values();
    $formatTahun     = fn($d) => empty($d) || $d === '-' ? '' : (preg_match('/^\d{4}$/', trim((string)$d)) ? trim((string)$d) : (str_starts_with(trim((string)$d), '1970') ? '2022' : \Carbon\Carbon::parse($d)->format('Y')));
    $daftarTahunBentuk = $listRelawan->pluck('tanggal_pembentukan')->map($formatTahun)->filter()->unique()->sort()->values();
    $daftarTahunKukuh  = $listRelawan->pluck('tanggal_pengukuhan')->map($formatTahun)->filter()->unique()->sort()->values();

    $jmlDenganKtp = $listRelawan->filter(fn($r) => $berkasAda($r->file_ktp))->count();
    $jmlTanpaKtp  = $totalRelawan - $jmlDenganKtp;

    /* ---------- Data untuk Rekap Excel (.xlsx) ---------- */
    $barisExcel = $listRelawan->values()->map(function ($r, $i) use ($formatTahun) {
        $ttlParts = [];
        if ($r->tempat_lahir && $r->tempat_lahir !== '-') {
            $ttlParts[] = $r->tempat_lahir;
        }
        if ($r->tanggal_lahir) {
            $ttlParts[] = \Carbon\Carbon::parse($r->tanggal_lahir)->format('d/m/Y');
        }
        $ttl = !empty($ttlParts) ? implode(', ', $ttlParts) : '-';

        $tglBentuk = $r->tanggal_pembentukan && $r->tanggal_pembentukan !== '-' ? (preg_match('/^\d{4}$/', trim((string)$r->tanggal_pembentukan)) ? trim((string)$r->tanggal_pembentukan) : (str_starts_with(trim((string)$r->tanggal_pembentukan), '1970') ? '2022' : \Carbon\Carbon::parse($r->tanggal_pembentukan)->format('d/m/Y'))) : '-';
        $tglKukuh  = $r->tanggal_pengukuhan && $r->tanggal_pengukuhan !== '-' ? (preg_match('/^\d{4}$/', trim((string)$r->tanggal_pengukuhan)) ? trim((string)$r->tanggal_pengukuhan) : (str_starts_with(trim((string)$r->tanggal_pengukuhan), '1970') ? '2022' : \Carbon\Carbon::parse($r->tanggal_pengukuhan)->format('d/m/Y'))) : '-';
        $thnBentuk = $formatTahun($r->tanggal_pembentukan);
        $thnKukuh  = $formatTahun($r->tanggal_pengukuhan);

        return [
            'no'                  => $i + 1,
            'nama_lengkap'        => (string) $r->nama_lengkap,
            'nik'                 => (string) ($r->nik ?: '-'),
            'ttl'                 => $ttl,
            'jenis_kelamin'       => (string) ($r->jenis_kelamin ?: '-'),
            'agama'               => (string) ($r->agama ?: '-'),
            'pekerjaan'           => (string) ($r->pekerjaan ?: '-'),
            'pendidikan_terakhir' => (string) ($r->pendidikan_terakhir ?: '-'),
            'alamat_rt'           => (string) ($r->alamat ?: '-'),
            'kelurahan'           => (string) ($r->kelurahan ?: '-'),
            'kecamatan'           => (string) ($r->kecamatan ?: '-'),
            'nomor_telp'          => (string) ($r->nomor_telp ?: '-'),
            'golongan_darah'      => (string) ($r->golongan_darah ?: '-'),
            'buta_warna'          => (string) ($r->buta_warna ?: 'Tidak'),
            'sehat_jasmani'       => (string) ($r->sehat_jasmani ?: 'Sehat'),
            'tanggal_pembentukan' => $tglBentuk,
            'tanggal_pengukuhan'  => $tglKukuh,
            '_search'             => strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp . ' ' . $r->alamat . ' ' . $r->kelurahan . ' ' . $r->kecamatan . ' ' . $r->pekerjaan . ' ' . $r->pendidikan_terakhir),
            '_kec'                => strtolower((string) $r->kecamatan),
            '_thn_bentuk'         => $thnBentuk,
            '_thn_kukuh'          => $thnKukuh,
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
                <select id="rk-tahun-bentuk" class="filter-select" style="min-width: 170px;">
                    <option value="">Semua Thn Pembentukan</option>
                    @foreach($daftarTahunBentuk as $thn)
                        <option value="{{ $thn }}">Pembentukan: {{ $thn }}</option>
                    @endforeach
                </select>
                <select id="rk-tahun-kukuh" class="filter-select" style="min-width: 170px;">
                    <option value="">Semua Thn Pengukuhan</option>
                    @foreach($daftarTahunKukuh as $thn)
                        <option value="{{ $thn }}">Pengukuhan: {{ $thn }}</option>
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
                            <th rowspan="2" style="width: 50px;">No</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">NIK</th>
                            <th rowspan="2">Tmp / Tgl Lahir</th>
                            <th rowspan="2">Jenis Kelamin</th>
                            <th rowspan="2">Agama</th>
                            <th rowspan="2">Pekerjaan</th>
                            <th rowspan="2">Pendidikan</th>
                            <th colspan="3" class="text-center">Alamat</th>
                            <th rowspan="2">HP</th>
                            <th rowspan="2">Gol. Darah</th>
                            <th rowspan="2">Buta Warna</th>
                            <th rowspan="2">Sehat Jasmani / Rohani</th>
                            <th rowspan="2">Tanggal Pembentukan REDKAR</th>
                            <th rowspan="2">Tanggal Pengukuhan REDKAR</th>
                            <th rowspan="2" class="no-print-col" style="min-width: 110px;">Aksi</th>
                        </tr>
                        <tr>
                            <th>Rt</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody id="rk-body">
                        @forelse($relawan as $index => $r)
                        <tr class="rk-row"
                            data-search="{{ strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp . ' ' . $r->alamat . ' ' . $r->kelurahan . ' ' . $r->kecamatan . ' ' . $r->pekerjaan . ' ' . $r->pendidikan_terakhir) }}"
                            data-kecamatan="{{ strtolower($r->kecamatan) }}"
                            data-thn-bentuk="{{ $formatTahun($r->tanggal_pembentukan) }}"
                            data-thn-kukuh="{{ $formatTahun($r->tanggal_pengukuhan) }}">
                            {{-- 1. No --}}
                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>

                            {{-- 2. Nama --}}
                            <td class="fw-bold text-dark text-nowrap">{{ $r->nama_lengkap }}</td>

                            {{-- 3. NIK --}}
                            <td class="font-monospace fw-semibold text-nowrap">
                                {{ $r->nik ?: '-' }}
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
                                @if($r->tempat_lahir && $r->tempat_lahir !== '-' && $r->tanggal_lahir)
                                    {{ $r->tempat_lahir }}, {{ \Carbon\Carbon::parse($r->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y') }}
                                @elseif($r->tanggal_lahir)
                                    {{ \Carbon\Carbon::parse($r->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y') }}
                                @elseif($r->tempat_lahir && $r->tempat_lahir !== '-')
                                    {{ $r->tempat_lahir }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 5. Jenis Kelamin --}}
                            <td class="text-nowrap text-center">{{ $r->jenis_kelamin ?: '-' }}</td>

                            {{-- 6. Agama --}}
                            <td class="text-nowrap text-center">{{ $r->agama ?: '-' }}</td>

                            {{-- 7. Pekerjaan --}}
                            <td class="text-nowrap">{{ $r->pekerjaan ?: '-' }}</td>

                            {{-- 8. Pendidikan --}}
                            <td class="text-nowrap text-center">{{ $r->pendidikan_terakhir ?: '-' }}</td>

                            {{-- 9. Alamat: Rt --}}
                            <td style="min-width: 180px; max-width: 260px; white-space: normal;">
                                {{ $r->alamat ?: '-' }}
                            </td>

                            {{-- 10. Alamat: Kelurahan --}}
                            <td class="text-nowrap">{{ $r->kelurahan ?: '-' }}</td>

                            {{-- 11. Alamat: Kecamatan --}}
                            <td class="text-nowrap">{{ $r->kecamatan ?: '-' }}</td>

                            {{-- 12. HP --}}
                            <td class="text-nowrap">
                                @if($r->nomor_telp)
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $r->nomor_telp)) }}" target="_blank" class="text-success text-decoration-none fw-bold d-inline-flex align-items-center gap-1">
                                        <i class="fab fa-whatsapp fs-6"></i> {{ $r->nomor_telp }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 13. Gol. Darah --}}
                            <td class="text-center fw-bold text-danger text-nowrap">{{ $r->golongan_darah ?: '-' }}</td>

                            {{-- 14. Buta Warna --}}
                            <td class="text-center text-nowrap">
                                {{ $r->buta_warna ?: 'Tidak' }}
                            </td>

                            {{-- 15. Sehat Jasmani / Rohani --}}
                            <td class="text-center text-nowrap">
                                {{ $r->sehat_jasmani ?: 'Sehat' }}
                            </td>

                            {{-- 16. Tanggal Pembentukan REDKAR --}}
                            <td class="text-center text-nowrap">
                                @php $valBentuk = trim((string) $r->tanggal_pembentukan); @endphp
                                @if($valBentuk !== '' && $valBentuk !== '-')
                                    @if(preg_match('/^\d{4}$/', $valBentuk))
                                        <span class="fw-semibold text-dark">{{ $valBentuk }}</span>
                                    @elseif(str_starts_with($valBentuk, '1970'))
                                        <span class="fw-semibold text-dark">2022</span>
                                    @else
                                        <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($valBentuk)->locale('id')->isoFormat('D MMMM Y') }}</span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 17. Tanggal Pengukuhan REDKAR --}}
                            <td class="text-center text-nowrap">
                                @php $valKukuh = trim((string) $r->tanggal_pengukuhan); @endphp
                                @if($valKukuh !== '' && $valKukuh !== '-')
                                    @if(preg_match('/^\d{4}$/', $valKukuh))
                                        <span class="fw-semibold text-dark">{{ $valKukuh }}</span>
                                    @elseif(str_starts_with($valKukuh, '1970'))
                                        <span class="fw-semibold text-dark">2022</span>
                                    @else
                                        <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($valKukuh)->locale('id')->isoFormat('D MMMM Y') }}</span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- 19. Aksi (Edit, Hapus) --}}
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
                            <td colspan="19" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data relawan REDKAR terdaftar.
                            </td>
                        </tr>
                        @endforelse
                        <tr id="rk-no-result" style="display: none;">
                            <td colspan="19" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-search mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Relawan tidak ditemukan. Coba kata kunci lain atau pilih "Semua Kecamatan".
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="rk-pagination" id="rk-pagination-box">
                <div class="text-muted" style="font-size: .84rem;" id="rk-pagination-info">
                    Menampilkan 1 - 30 dari {{ $totalRelawan }} relawan
                </div>
                <div class="d-flex align-items-center gap-1 flex-wrap" id="rk-pagination-nav"></div>
            </div>
        </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
<script>
(function () {
    'use strict';

    var search       = document.getElementById('rk-search');
    var selectKec    = document.getElementById('rk-kecamatan');
    var selectBentuk = document.getElementById('rk-tahun-bentuk');
    var selectKukuh  = document.getElementById('rk-tahun-kukuh');
    var rows         = Array.prototype.slice.call(document.querySelectorAll('.rk-row'));
    var shown        = document.getElementById('rk-shown');
    var empty        = document.getElementById('rk-no-result');
    var pageInfo     = document.getElementById('rk-pagination-info');
    var pageNav      = document.getElementById('rk-pagination-nav');
    var pageBox      = document.getElementById('rk-pagination-box');

    var PAGE_SIZE    = 30;
    var currentPage  = 1;
    var matchedRows  = rows.slice();

    function renderPaginationNav(totalPages) {
        if (!pageNav) return;
        pageNav.innerHTML = '';

        if (totalPages <= 1) {
            if (pageBox) pageBox.style.display = matchedRows.length === 0 ? 'none' : 'flex';
            return;
        }
        if (pageBox) pageBox.style.display = 'flex';

        // Tombol Sebelumnya
        var prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = 'rk-page-btn';
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.title = 'Halaman Sebelumnya';
        if (currentPage <= 1) {
            prevBtn.disabled = true;
        } else {
            prevBtn.addEventListener('click', function () {
                currentPage--;
                renderPage(true);
            });
        }
        pageNav.appendChild(prevBtn);

        // Nomor Halaman (dengan ellipsis jika banyak halaman)
        var pages = [];
        if (totalPages <= 7) {
            for (var p = 1; p <= totalPages; p++) pages.push(p);
        } else {
            pages.push(1);
            if (currentPage > 3) pages.push('...');
            var startP = Math.max(2, currentPage - 1);
            var endP   = Math.min(totalPages - 1, currentPage + 1);
            for (var p = startP; p <= endP; p++) pages.push(p);
            if (currentPage < totalPages - 2) pages.push('...');
            pages.push(totalPages);
        }

        pages.forEach(function (p) {
            if (p === '...') {
                var dots = document.createElement('span');
                dots.className = 'rk-page-dots';
                dots.textContent = '…';
                pageNav.appendChild(dots);
            } else {
                var pBtn = document.createElement('button');
                pBtn.type = 'button';
                pBtn.className = 'rk-page-btn' + (p === currentPage ? ' active' : '');
                pBtn.textContent = p;
                if (p === currentPage) {
                    pBtn.disabled = true;
                } else {
                    pBtn.addEventListener('click', function () {
                        currentPage = p;
                        renderPage(true);
                    });
                }
                pageNav.appendChild(pBtn);
            }
        });

        // Tombol Selanjutnya
        var nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'rk-page-btn';
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.title = 'Halaman Selanjutnya';
        if (currentPage >= totalPages) {
            nextBtn.disabled = true;
        } else {
            nextBtn.addEventListener('click', function () {
                currentPage++;
                renderPage(true);
            });
        }
        pageNav.appendChild(nextBtn);
    }

    function renderPage(scroll) {
        var total = matchedRows.length;
        var totalPages = Math.ceil(total / PAGE_SIZE) || 1;
        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        var start = (currentPage - 1) * PAGE_SIZE;
        var end   = Math.min(start + PAGE_SIZE, total);

        rows.forEach(function (row) {
            row.style.display = 'none';
        });

        for (var i = start; i < end; i++) {
            matchedRows[i].style.display = '';
        }

        if (shown) shown.textContent = total;
        if (empty) empty.style.display = total === 0 ? '' : 'none';

        if (pageInfo) {
            if (total === 0) {
                pageInfo.textContent = 'Tidak ada relawan yang sesuai filter.';
            } else {
                pageInfo.textContent = 'Menampilkan ' + (start + 1) + ' - ' + end + ' dari ' + total + ' relawan (Halaman ' + currentPage + ' dari ' + totalPages + ')';
            }
        }

        renderPaginationNav(totalPages);

        if (scroll) {
            var card = document.querySelector('.content-card');
            if (card) {
                var topPos = card.getBoundingClientRect().top + window.pageYOffset - 80;
                if (window.pageYOffset > topPos) {
                    window.scrollTo({ top: topPos, behavior: 'smooth' });
                }
            }
        }
    }

    function applyFilter() {
        var q         = search ? search.value.trim().toLowerCase() : '';
        var kec       = selectKec ? selectKec.value : '';
        var thnBentuk = selectBentuk ? selectBentuk.value : '';
        var thnKukuh  = selectKukuh ? selectKukuh.value : '';

        matchedRows = [];
        rows.forEach(function (row) {
            var okSearch = !q || (row.dataset.search && row.dataset.search.indexOf(q) > -1);
            var okKec    = !kec || row.dataset.kecamatan === kec;
            var okBentuk = !thnBentuk || row.dataset.thnBentuk === thnBentuk;
            var okKukuh  = !thnKukuh || row.dataset.thnKukuh === thnKukuh;

            if (okSearch && okKec && okBentuk && okKukuh) {
                matchedRows.push(row);
            }
        });

        currentPage = 1;
        renderPage(false);
    }

    if (search) search.addEventListener('input', applyFilter);
    if (selectKec) selectKec.addEventListener('change', applyFilter);
    if (selectBentuk) selectBentuk.addEventListener('change', applyFilter);
    if (selectKukuh) selectKukuh.addEventListener('change', applyFilter);

    // Inisialisasi tampilan awal 30 data per halaman
    applyFilter();

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
        { k: 'ttl',                 t: 'Tmp / Tgl Lahir',            w: 24 },
        { k: 'jenis_kelamin',       t: 'Jenis Kelamin',              w: 15, a: 'center' },
        { k: 'agama',               t: 'Agama',                      w: 14, a: 'center' },
        { k: 'pekerjaan',           t: 'Pekerjaan',                  w: 22 },
        { k: 'pendidikan_terakhir', t: 'Pendidikan',                 w: 15, a: 'center' },
        { k: 'alamat_rt',           t: 'Alamat (Rt)',                w: 32 },
        { k: 'kelurahan',           t: 'Kelurahan',                  w: 20 },
        { k: 'kecamatan',           t: 'Kecamatan',                  w: 20 },
        { k: 'nomor_telp',          t: 'HP',                         w: 18, txt: true },
        { k: 'golongan_darah',      t: 'Gol. Darah',                 w: 12, a: 'center' },
        { k: 'buta_warna',          t: 'Buta Warna',                 w: 14, a: 'center' },
        { k: 'sehat_jasmani',       t: 'Sehat Jasmani / Rohani',     w: 22, a: 'center' },
        { k: 'tanggal_pembentukan', t: 'Tanggal Pembentukan REDKAR', w: 24, a: 'center' },
        { k: 'tanggal_pengukuhan',  t: 'Tanggal Pengukuhan REDKAR',  w: 24, a: 'center' }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }

    var searchEl       = document.getElementById('rk-search');
    var selectEl       = document.getElementById('rk-kecamatan');
    var selectBentukEl = document.getElementById('rk-tahun-bentuk');
    var selectKukuhEl  = document.getElementById('rk-tahun-kukuh');

    var q         = searchEl ? searchEl.value.trim().toLowerCase() : '';
    var kec       = selectEl ? selectEl.value : '';
    var thnBentuk = selectBentukEl ? selectBentukEl.value : '';
    var thnKukuh  = selectKukuhEl ? selectKukuhEl.value : '';

    var filteredRows = REKAP.rows.filter(function (r) {
        var mQ       = !q || (r._search && r._search.indexOf(q) > -1);
        var mKec     = !kec || r._kec === kec;
        var mBentuk  = !thnBentuk || r._thn_bentuk === thnBentuk;
        var mKukuh   = !thnKukuh || r._thn_kukuh === thnKukuh;
        return mQ && mKec && mBentuk && mKukuh;
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
