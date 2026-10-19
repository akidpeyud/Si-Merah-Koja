@extends('layouts.dashboard')

@section('title', 'Kelola IKM')

@push('styles')
<style>
    .page-head-bar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 28px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
    .section-heading-ico { flex: none; width: 34px; height: 34px; border-radius: 10px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .82rem; }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }
    .dash-section { margin-bottom: 36px; }

    .btn-simerah-danger { background: var(--signal); color: #fff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220,53,69,.22); transition: background .2s, transform .15s; }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #fff; transform: translateY(-1px); }
    .btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); transition: background .2s; }
    .btn-simerah-secondary:hover { background: var(--line); }

    .card-box { background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }

    /* Ringkasan */
    .ikm-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; }
    .ikm-stat { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 20px 22px; box-shadow: var(--shadow-xs); }
    .ikm-stat small { display: block; font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--steel); margin-bottom: 8px; }
    .ikm-stat strong { font-family: var(--font-display); font-size: 2rem; font-weight: 700; color: var(--ink); line-height: 1; }
    .ikm-stat span { display: block; margin-top: 8px; font-size: .84rem; color: var(--steel); }
    .mutu-badge { display: inline-grid; place-items: center; width: 38px; height: 38px; border-radius: 10px; font-family: var(--font-display); font-weight: 700; font-size: 1.1rem; color: #fff; margin-right: 10px; vertical-align: middle; }
    .mutu-A { background: #198754; } .mutu-B { background: #0d6efd; } .mutu-C { background: #f59e0b; } .mutu-D { background: #dc3545; }

    /* NRR per unsur */
    .nrr-row { display: grid; grid-template-columns: 34px minmax(0, 1.4fr) minmax(0, 2fr) 56px; align-items: center; gap: 14px; padding: 14px 22px; border-bottom: 1px solid var(--line); }
    .nrr-row:last-child { border-bottom: none; }
    .nrr-bar { height: 8px; border-radius: 999px; background: var(--paper); overflow: hidden; }
    .nrr-bar > i { display: block; height: 100%; border-radius: 999px; background: var(--navy); }
    .nrr-val { font-family: var(--font-display); font-weight: 700; color: var(--ink); text-align: right; }
    .nrr-name { font-size: .9rem; font-weight: 600; color: var(--ink); }

    /* Filter */
    .filter-bar { display: flex; flex-wrap: wrap; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--line); background: #f8fafc; }
    .filter-bar .form-control, .filter-bar .form-select { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 9px 13px; font-size: .88rem; }
    .filter-bar .grow { flex: 1 1 220px; }

    /* Tabel */
    .table-simerah { margin-bottom: 0; width: 100%; border-collapse: collapse; }
    .table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
    .table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-simerah tbody tr:last-child td { border-bottom: none; }
    .table-simerah tbody tr:hover { background-color: #f9fbfd; }
    .row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }
    .resp-title { font-weight: 700; font-size: .92rem; color: var(--ink); margin-bottom: 4px; }
    .resp-meta { font-size: .8rem; color: var(--steel); }
    .resp-saran { font-size: .88rem; color: var(--steel); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width: 46ch; }
    .score-pill { display: inline-block; padding: 4px 11px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-weight: 700; font-size: .82rem; }

    .action-group { display: inline-flex; align-items: center; gap: 8px; }
    .btn-edit-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--navy); background: var(--navy-soft); border: none; transition: background .2s, color .2s; }
    .btn-edit-item:hover { background: var(--navy); color: #fff; }
    .btn-delete-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--signal-dark); background: var(--signal-soft); border: none; transition: background .2s, color .2s; }
    .btn-delete-item:hover { background: var(--signal); color: #fff; }

    .empty-state { padding: 48px 24px; text-align: center; }
    .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--navy-soft); color: var(--navy); display: grid; place-items: center; font-size: 1.5rem; margin: 0 auto 14px; }
    .empty-state h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); margin-bottom: 6px; }
    .empty-state p { color: var(--steel); font-size: .88rem; max-width: 42ch; margin: 0 auto; }

    /* Modal */
    .modal-content { border-radius: var(--r-lg); border: 1px solid var(--line); box-shadow: var(--shadow-lg); overflow: hidden; }
    .modal-header { background: var(--ink); color: #fff; border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: #fff; display: flex; align-items: center; gap: 10px; }
    .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); opacity: .75; }
    .modal-body { padding: 24px; }
    .modal-footer { background: #f8fafc; border-top: 1px solid var(--line); padding: 14px 24px; }
    .detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px 24px; margin-bottom: 20px; }
    .detail-grid dt { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--steel); }
    .detail-grid dd { margin: 2px 0 0; font-weight: 600; color: var(--ink); }
    .detail-sub { font-family: var(--font-display); font-weight: 700; font-size: .9rem; color: var(--ink); margin: 18px 0 10px; }
    .score-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px 24px; }
    .score-item { display: flex; justify-content: space-between; gap: 12px; padding: 8px 0; border-bottom: 1px dashed var(--line); font-size: .86rem; }
    .score-item b { color: var(--navy); }
    .saran-box { background: var(--paper); border-radius: var(--r-sm); padding: 14px 16px; font-size: .9rem; color: var(--ink); white-space: pre-line; }

    @media (max-width: 900px) {
        .ikm-stats { grid-template-columns: 1fr; }
        .nrr-row { grid-template-columns: 30px minmax(0, 1fr) 50px; }
        .nrr-row .nrr-bar { grid-column: 1 / -1; order: 5; }
    }
    @media (max-width: 700px) {
        .detail-grid, .score-grid { grid-template-columns: 1fr; }
        .btn-simerah-danger.w-mobile-100 { width: 100%; }
    }
</style>
@endpush

@section('content')
@php
    // Label 11 pernyataan + 5 aspek integritas untuk modal detail
    $labelNilai = [
        'u1_a' => 'U1a – Kesesuaian persyaratan',   'u1_b' => 'U1b – Kemudahan persyaratan',
        'u2_a' => 'U2a – Kemudahan prosedur',       'u2_b' => 'U2b – Kejelasan prosedur',
        'u3'   => 'U3 – Waktu penyelesaian',        'u4'   => 'U4 – Biaya/tarif',
        'u5'   => 'U5 – Produk layanan',            'u6'   => 'U6 – Kompetensi pelaksana',
        'u7'   => 'U7 – Perilaku pelaksana',        'u8'   => 'U8 – Penanganan pengaduan',
        'u9'   => 'U9 – Sarana dan prasarana',
    ];
    $labelIntegritas = [
        'diskriminasi' => 'Diskriminasi', 'kecurangan' => 'Kecurangan', 'gratifikasi' => 'Gratifikasi',
        'pungli' => 'Pungli', 'percaloan' => 'Percaloan',
    ];
    $kolomUnsur = array_keys($labelNilai);
    $isOperator = auth()->check() && auth()->user()->hasAnyRole(['Operator', 'Super User']);
@endphp

{{-- ========== HEADER ========== --}}
<div class="page-head-bar">
    <div class="page-head">
        <h1>Kelola IKM</h1>
        <p>Pantau Indeks Kepuasan Masyarakat (IKM) beserta kritik dan saran dari responden survei layanan.</p>
    </div>

    <form method="GET" action="{{ url('/internal/operator/ikm') }}" class="d-flex align-items-center gap-2">
        <label for="tahun" class="form-label mb-0 fw-bold" style="font-size:.84rem;">Tahun</label>
        <select name="tahun" id="tahun" class="form-select" style="width:auto; border-radius:var(--r-sm);" onchange="this.form.submit()">
            @foreach($daftar_tahun as $th)
                <option value="{{ $th }}" {{ (int) $tahun === (int) $th ? 'selected' : '' }}>{{ $th }}</option>
            @endforeach
        </select>
    </form>
</div>

{{-- ========== RINGKASAN ========== --}}
<div class="dash-section">
    <div class="section-heading">
        <span class="section-heading-ico"><i class="fas fa-chart-pie"></i></span>
        <h3>Ringkasan IKM {{ $tahun }}</h3>
        <span class="line"></span>
    </div>

    <div class="ikm-stats">
        <div class="ikm-stat">
            <small>Jumlah Responden</small>
            <strong>{{ number_format($jumlah, 0, ',', '.') }}</strong>
            <span>Survei masuk tahun {{ $tahun }}</span>
        </div>
        <div class="ikm-stat">
            <small>Nilai IKM (skala 25–100)</small>
            <strong>{{ $jumlah > 0 ? number_format($ikm, 2, ',', '.') : '–' }}</strong>
            <span>Rata-rata 9 unsur × 25</span>
        </div>
        <div class="ikm-stat">
            <small>Mutu Pelayanan</small>
            @if($jumlah > 0)
                <div class="d-flex align-items-center">
                    <span class="mutu-badge mutu-{{ $mutu['kode'] }}" style="margin-top:0;">{{ $mutu['kode'] }}</span>
                    <strong style="font-size:1.35rem;">{{ $mutu['nama'] }}</strong>
                </div>
            @else
                <strong>–</strong>
            @endif
            <span>Konversi sesuai Permenpan RB No. 14/2017</span>
        </div>
    </div>
</div>

{{-- ========== NRR PER UNSUR ========== --}}
<div class="dash-section">
    <div class="section-heading">
        <span class="section-heading-ico"><i class="fas fa-list-check"></i></span>
        <h3>Nilai Rata-rata per Unsur</h3>
        <span class="line"></span>
        <span class="count-pill">Skala 1–4</span>
    </div>

    <div class="card-box">
        @foreach($unsur as $no => $nama)
            @php $nilai = $nrr[$no] ?? 0; @endphp
            <div class="nrr-row">
                <span class="row-num">{{ $no }}</span>
                <span class="nrr-name">{{ $nama }}</span>
                <div class="nrr-bar"><i style="width: {{ min(100, ($nilai / 4) * 100) }}%;"></i></div>
                <span class="nrr-val">{{ $jumlah > 0 ? number_format($nilai, 2, ',', '.') : '–' }}</span>
            </div>
        @endforeach
    </div>
</div>

{{-- ========== DAFTAR RESPONDEN ========== --}}
<div class="dash-section">
    <div class="section-heading">
        <span class="section-heading-ico"><i class="fas fa-comments"></i></span>
        <h3>Data Responden &amp; Saran</h3>
        <span class="line"></span>
        <span class="count-pill"><i class="fas fa-list"></i> {{ $responden->total() }} Data</span>
    </div>

    <div class="card-box">
        <form method="GET" action="{{ url('/internal/operator/ikm') }}" class="filter-bar">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="text" name="q" value="{{ $cari }}" class="form-control grow" placeholder="Cari kritik/saran, pekerjaan, pendidikan...">
            <select name="pekerjaan" class="form-select" style="width:auto; min-width:180px;">
                <option value="">Semua Pekerjaan</option>
                @foreach(\App\Models\IkmResponse::PEKERJAAN as $p)
                    <option value="{{ $p }}" {{ $pekerjaan === $p ? 'selected' : '' }}>{{ $p }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-simerah-danger" style="padding:9px 18px;"><i class="fas fa-magnifying-glass"></i> Cari</button>
            @if($cari !== '' || $pekerjaan !== '')
                <a href="{{ url('/internal/operator/ikm') }}?tahun={{ $tahun }}" class="btn-simerah-secondary">Reset</a>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-simerah align-middle">
                <thead>
                    <tr>
                        <th style="width:5%;">No</th>
                        <th style="width:15%;">Tanggal Layanan</th>
                        <th style="width:22%;">Responden</th>
                        <th style="width:33%;">Kritik &amp; Saran</th>
                        <th style="width:10%;" class="text-center">Rata-rata</th>
                        <th style="width:15%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($responden as $i => $r)
                        @php
                            $rata = collect($kolomUnsur)->avg(fn ($k) => $r->{$k});
                        @endphp
                        <tr>
                            <td><span class="row-num">{{ $responden->firstItem() + $i }}</span></td>
                            <td><span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($r->tanggal_layanan)->format('d M Y') }}</span></td>
                            <td>
                                <div class="resp-title">{{ $r->pekerjaan }}</div>
                                <div class="resp-meta">
                                    {{ $r->pendidikan }} · {{ $r->usia }} th
                                    @if($r->disabilitas) · <span class="badge bg-info">Disabilitas</span> @endif
                                </div>
                            </td>
                            <td><div class="resp-saran">{{ $r->kritik_saran }}</div></td>
                            <td class="text-center"><span class="score-pill">{{ number_format($rata, 2, ',', '.') }}</span></td>
                            <td class="text-center">
                                <div class="action-group">
                                    <button type="button" class="btn-edit-item" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $r->id }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    @if($isOperator)
                                        <form action="{{ url('/internal/operator/ikm/hapus/' . $r->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data survei ini?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-item"><i class="fas fa-trash-can"></i> Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-ico"><i class="fas fa-comments"></i></div>
                                    <h4>Belum Ada Data Responden</h4>
                                    <p>Belum ada survei yang masuk untuk filter yang dipilih.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($responden->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $responden->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ========== MODAL DETAIL (di luar tabel agar HTML valid) ========== --}}
@foreach($responden as $r)
<div class="modal fade" id="modalDetail{{ $r->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-clipboard-list text-warning"></i> Detail Survei #{{ $r->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-start">
                <dl class="detail-grid">
                    <div><dt>Tanggal Layanan</dt><dd>{{ \Carbon\Carbon::parse($r->tanggal_layanan)->format('d M Y') }}</dd></div>
                    <div><dt>Pendidikan</dt><dd>{{ $r->pendidikan }}</dd></div>
                    <div><dt>Usia</dt><dd>{{ $r->usia }} tahun</dd></div>
                    <div><dt>Pekerjaan</dt><dd>{{ $r->pekerjaan }}</dd></div>
                    <div><dt>Disabilitas</dt><dd>{{ $r->disabilitas ? 'Ya' : 'Tidak' }}</dd></div>
                    <div><dt>IP Address</dt><dd>{{ $r->ip_address ?? '-' }}</dd></div>
                </dl>

                <div class="detail-sub">Penilaian Unsur Pelayanan (1–4)</div>
                <div class="score-grid">
                    @foreach($labelNilai as $k => $label)
                        <div class="score-item"><span>{{ $label }}</span><b>{{ $r->{$k} }}</b></div>
                    @endforeach
                </div>

                <div class="detail-sub">Aspek Integritas (1–4)</div>
                <div class="score-grid">
                    @foreach($labelIntegritas as $k => $label)
                        <div class="score-item"><span>{{ $label }}</span><b>{{ $r->{$k} }}</b></div>
                    @endforeach
                </div>

                <div class="detail-sub">Tingkat Kepercayaan (1–10)</div>
                <div class="score-grid">
                    <div class="score-item"><span>Pemerintah Pusat</span><b>{{ $r->kepercayaan_pusat }}</b></div>
                    <div class="score-item"><span>Pemerintah Daerah</span><b>{{ $r->kepercayaan_daerah }}</b></div>
                </div>

                <div class="detail-sub">Kritik &amp; Saran</div>
                <div class="saran-box">{{ $r->kritik_saran }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection