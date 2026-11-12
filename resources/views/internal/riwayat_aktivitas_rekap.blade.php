@extends('layouts.dashboard')

@section('title', 'Rekap Bulanan Riwayat Aktivitas')

@push('styles')
<style>
    .page-head { margin-bottom: 24px; }
    .page-head h1 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: clamp(1.5rem, 2.5vw, 1.8rem);
        line-height: 1.2;
        letter-spacing: -.02em;
        margin-bottom: 5px;
        color: var(--ink);
    }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }

    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }
    .mini-stat {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: var(--shadow-xs);
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .mini-stat:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }
    .mini-stat-ico {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 1.15rem;
        flex: none;
    }
    .mini-stat-val {
        font-family: var(--font-display);
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.1;
    }
    .mini-stat-label {
        font-size: .8rem;
        color: var(--steel);
        font-weight: 600;
        margin-top: 2px;
    }
    .mini-stat-sub {
        font-size: .74rem;
        color: var(--steel-soft);
        margin-top: 3px;
    }

    .content-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 24px;
        box-shadow: var(--shadow-xs);
        margin-bottom: 22px;
    }
    .filter-card {
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: var(--r-sm);
        padding: 16px;
        margin-bottom: 18px;
    }
    .filter-card .form-control,
    .filter-card .form-select {
        min-height: 40px;
        font-size: .88rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px;
    }
    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }

    .section-title {
        font-family: var(--font-display);
        font-size: 1.08rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-subtitle {
        font-size: .85rem;
        color: var(--steel);
        margin-bottom: 16px;
    }

    .table-responsive { overflow-x: auto; }
    .table { margin-bottom: 0; min-width: 820px; }
    .table thead th {
        background: var(--paper);
        color: var(--steel);
        font-size: .74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 13px 14px;
        border-bottom: 1px solid var(--line-dark);
        white-space: nowrap;
    }
    .table tbody td {
        padding: 13px 14px;
        vertical-align: middle;
        border-bottom: 1px solid var(--line);
        font-size: .88rem;
        color: var(--ink);
    }
    .table tbody tr:hover { background: #f8fafc; }
    .table tfoot td {
        background: #f8fafc;
        font-weight: 700;
        padding: 12px 14px;
        border-top: 2px solid var(--line-dark);
        font-size: .88rem;
    }

    .badge-source {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 9px;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-source-live { background: rgba(37, 99, 235, .1); color: #1d4ed8; }
    .badge-source-archive { background: rgba(25, 135, 84, .12); color: #15803d; }
    .badge-source-mix { background: rgba(244, 183, 64, .18); color: #92400e; }

    .badge-mod-chip {
        display: inline-block;
        background: var(--paper);
        border: 1px solid var(--line);
        color: var(--ink-2);
        border-radius: 6px;
        padding: 2px 8px;
        font-size: .74rem;
        font-weight: 600;
        margin: 2px 3px 2px 0;
    }

    .retention-banner {
        background: #f8fafc;
        border: 1px solid var(--line-dark);
        border-left: 4px solid var(--navy);
        border-radius: var(--r-sm);
        padding: 14px 16px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="page-head d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1>Rekap Bulanan Riwayat Aktivitas</h1>
        <p>Arsip permanen ringkasan bulanan aktivitas pegawai internal dan permohonan surat pemohon.</p>
    </div>
    <div class="btn-group p-1 bg-white border rounded-3 shadow-xs">
        <a href="{{ route('internal.riwayat-aktivitas') }}" class="btn btn-sm btn-light text-secondary fw-semibold px-3 py-2">
            <i class="fa-solid fa-user-tie me-1"></i> Aktivitas Internal
        </a>
        <a href="{{ route('internal.riwayat-aktivitas-pemohon') }}" class="btn btn-sm btn-light text-secondary fw-semibold px-3 py-2">
            <i class="fa-solid fa-file-signature me-1"></i> Permohonan Surat
        </a>
        <a href="{{ route('internal.riwayat-aktivitas-rekap') }}" class="btn btn-sm btn-primary fw-bold px-3 py-2" style="background: var(--navy); border-color: var(--navy);">
            <i class="fa-solid fa-chart-column me-1"></i> Rekap Bulanan
        </a>
    </div>
</div>

<!-- Ringkasan Global Rekap -->
<div class="stat-cards-grid">
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: var(--navy-soft); color: var(--navy);">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($recap['summary']['total_all']) }}</div>
            <div class="mini-stat-label">Total Aktivitas Terealisasi</div>
            <div class="mini-stat-sub">{{ $recap['summary']['months_count'] }} bulan tercatat</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(37, 99, 235, .12); color: var(--info);">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($recap['summary']['total_internal']) }}</div>
            <div class="mini-stat-label">Aktivitas Internal</div>
            <div class="mini-stat-sub">
                +{{ number_format($recap['summary']['internal_tambah']) }} Tambah &bull;
                {{ number_format($recap['summary']['internal_ubah']) }} Ubah &bull;
                {{ number_format($recap['summary']['internal_hapus']) }} Hapus
            </div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(13, 148, 136, .14); color: #0f766e;">
            <i class="fa-solid fa-file-signature"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($recap['summary']['total_pemohon']) }}</div>
            <div class="mini-stat-label">Permohonan Surat Pemohon</div>
            <div class="mini-stat-sub">Terpisah dari log internal</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(25, 135, 84, .12); color: var(--success);">
            <i class="fa-solid fa-box-archive"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($recap['summary']['archived_count']) }}</div>
            <div class="mini-stat-label">Sudah Diarsipkan Permanen</div>
            <div class="mini-stat-sub">Live: {{ number_format($recap['summary']['live_count']) }} &bull; Retensi {{ $retentionInternal }}/{{ $retentionPemohon }} Bln</div>
        </div>
    </div>
</div>

<!-- Filter, Ekspor & Manajemen Retensi -->
<div class="content-card">
    <form action="{{ route('internal.riwayat-aktivitas-rekap') }}" method="GET" class="filter-card">
        <div class="row g-2 align-items-end">
            <div class="col-6 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Tahun</label>
                <select name="year" class="form-select">
                    <option value="all" {{ $selectedYear === 'all' ? 'selected' : '' }}>Semua Tahun</option>
                    @foreach($recap['available_years'] as $yr)
                        <option value="{{ $yr }}" {{ (string) $selectedYear === (string) $yr ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Kategori Aktivitas</label>
                <select name="category" class="form-select">
                    <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>Semua (Internal &amp; Pemohon)</option>
                    <option value="internal" {{ $selectedCategory === 'internal' ? 'selected' : '' }}>Aktivitas Internal Pegawai</option>
                    <option value="pemohon" {{ $selectedCategory === 'pemohon' ? 'selected' : '' }}>Permohonan Surat Pemohon</option>
                </select>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end flex-wrap gap-2 mt-2 mt-md-0">
                <button type="submit" class="btn btn-sm btn-primary px-3 py-2" style="background: var(--navy); border-color: var(--navy);">
                    <i class="fa-solid fa-filter me-1"></i> Terapkan
                </button>
                @if($selectedYear !== 'all' || $selectedCategory !== 'all')
                    <a href="{{ route('internal.riwayat-aktivitas-rekap') }}" class="btn btn-sm btn-light border px-3 py-2">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </a>
                @endif
                <a href="{{ route('internal.riwayat-aktivitas-rekap.excel', ['year' => $selectedYear, 'category' => $selectedCategory]) }}" class="btn btn-sm btn-success px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-file-excel me-1"></i> Export Excel
                </a>
                <a href="{{ route('internal.riwayat-aktivitas-rekap.pdf', ['year' => $selectedYear, 'category' => $selectedCategory]) }}" class="btn btn-sm btn-danger px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-file-pdf me-1"></i> Export PDF
                </a>
            </div>
        </div>
    </form>

    <div class="retention-banner d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="small text-secondary">
            <div class="fw-bold text-dark mb-1">
                <i class="fa-solid fa-shield-halved me-1 text-primary"></i>
                Kebijakan Retensi Log Detail ({{ $retentionInternal }} Bulan Internal &bull; {{ $retentionPemohon }} Bulan Pemohon)
            </div>
            <div>
                Log detail di atas {{ $retentionInternal }} bulan (sebelum {{ $prunable['internal_cutoff']->translatedFormat('d M Y') }}) akan diringkas ke tabel arsip bulanan lalu dibersihkan otomatis tiap hari.
                Saat ini terdapat <strong>{{ number_format($prunable['internal']) }}</strong> log internal &amp; <strong>{{ number_format($prunable['pemohon']) }}</strong> log pemohon yang siap diringkas.
            </div>
        </div>
        @if(Auth::user()?->hasRole('Super User'))
            <form action="{{ route('internal.riwayat-aktivitas-rekap.prune') }}" method="POST" id="manualPruneForm" class="m-0">
                @csrf
                <button type="button" class="btn btn-sm btn-outline-dark fw-semibold px-3 py-2" id="btnManualPrune" data-total="{{ $prunable['total'] }}">
                    <i class="fa-solid fa-broom me-1"></i> Ringkas &amp; Arsipkan Log Lama ({{ number_format($prunable['total']) }})
                </button>
            </form>
        @endif
    </div>

    <!-- Tabel 1: Rekap Bulanan Aktivitas Internal -->
    @if($selectedCategory !== 'pemohon')
        <div class="mb-4">
            <div class="section-title">
                <i class="fa-solid fa-user-tie text-primary"></i>
                <span>Rekap Bulanan Aktivitas Internal Pegawai</span>
            </div>
            <p class="section-subtitle">Ringkasan operasi tambah, ubah, dan hapus data oleh pegawai internal per bulan.</p>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;" class="text-center">No</th>
                            <th style="width: 170px;">Periode</th>
                            <th style="width: 90px;" class="text-end">Tambah</th>
                            <th style="width: 90px;" class="text-end">Ubah</th>
                            <th style="width: 90px;" class="text-end">Hapus</th>
                            <th style="width: 90px;" class="text-end">Lainnya</th>
                            <th style="width: 110px;" class="text-end">Total</th>
                            <th>Modul Terbanyak</th>
                            <th style="width: 130px;" class="text-center">Status Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recap['monthly_internal'] as $index => $row)
                            <tr>
                                <td class="text-center text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $row['period_label'] }}</td>
                                <td class="text-end text-success fw-semibold">{{ number_format($row['tambah']) }}</td>
                                <td class="text-end text-warning fw-semibold" style="color: #b7791f !important;">{{ number_format($row['ubah']) }}</td>
                                <td class="text-end text-danger fw-semibold">{{ number_format($row['hapus']) }}</td>
                                <td class="text-end text-muted">{{ number_format($row['lainnya']) }}</td>
                                <td class="text-end fw-bold">{{ number_format($row['total']) }}</td>
                                <td>
                                    @forelse($row['top_modules'] as $mod)
                                        <span class="badge-mod-chip">{{ $mod['module'] }} ({{ number_format($mod['total']) }})</span>
                                    @empty
                                        <span class="text-muted">-</span>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    @php
                                        $srcClass = match($row['source']) {
                                            'Arsip Permanen' => 'badge-source-archive',
                                            'Arsip + Live' => 'badge-source-mix',
                                            default => 'badge-source-live',
                                        };
                                    @endphp
                                    <span class="badge-source {{ $srcClass }}">{{ $row['source'] }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Belum ada data rekap aktivitas internal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($recap['monthly_internal']->isNotEmpty())
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end">TOTAL INTERNAL</td>
                                <td class="text-end">{{ number_format($recap['monthly_internal']->sum('tambah')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_internal']->sum('ubah')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_internal']->sum('hapus')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_internal']->sum('lainnya')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_internal']->sum('total')) }}</td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    @endif

    <!-- Tabel 2: Rekap Bulanan Permohonan Surat Pemohon -->
    @if($selectedCategory !== 'internal')
        <div class="mb-4">
            <div class="section-title">
                <i class="fa-solid fa-file-signature text-success"></i>
                <span>Rekap Bulanan Permohonan Surat (Pemohon)</span>
            </div>
            <p class="section-subtitle">Ringkasan jumlah permohonan layanan publik yang diajukan masyarakat per bulan.</p>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;" class="text-center">No</th>
                            <th style="width: 170px;">Periode</th>
                            <th class="text-end">RPKBGL</th>
                            <th class="text-end">SKK</th>
                            <th class="text-end">Izin Keramaian</th>
                            <th class="text-end">Sarana Damkar</th>
                            <th class="text-end">Edukasi</th>
                            <th class="text-end">Lainnya</th>
                            <th style="width: 110px;" class="text-end">Total</th>
                            <th style="width: 130px;" class="text-center">Status Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recap['monthly_pemohon'] as $index => $row)
                            <tr>
                                <td class="text-center text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $row['period_label'] }}</td>
                                <td class="text-end">{{ number_format($row['rpkbgl']) }}</td>
                                <td class="text-end">{{ number_format($row['skk']) }}</td>
                                <td class="text-end">{{ number_format($row['izin']) }}</td>
                                <td class="text-end">{{ number_format($row['sarana']) }}</td>
                                <td class="text-end">{{ number_format($row['edukasi']) }}</td>
                                <td class="text-end text-muted">{{ number_format($row['lainnya']) }}</td>
                                <td class="text-end fw-bold">{{ number_format($row['total']) }}</td>
                                <td class="text-center">
                                    @php
                                        $srcClass = match($row['source']) {
                                            'Arsip Permanen' => 'badge-source-archive',
                                            'Arsip + Live' => 'badge-source-mix',
                                            default => 'badge-source-live',
                                        };
                                    @endphp
                                    <span class="badge-source {{ $srcClass }}">{{ $row['source'] }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">Belum ada data rekap permohonan surat pemohon.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($recap['monthly_pemohon']->isNotEmpty())
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end">TOTAL PEMOHON</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('rpkbgl')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('skk')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('izin')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('sarana')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('edukasi')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('lainnya')) }}</td>
                                <td class="text-end">{{ number_format($recap['monthly_pemohon']->sum('total')) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    @endif

    <!-- Tabel 3: Rincian Per Modul & Aksi -->
    <div>
        <div class="section-title">
            <i class="fa-solid fa-table-list text-secondary"></i>
            <span>Rincian Aktivitas Per Modul &amp; Layanan</span>
        </div>
        <p class="section-subtitle">Rincian terkelompok per periode, kategori (Internal / Pemohon), modul, dan jenis aksi.</p>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th style="width: 150px;">Periode</th>
                        <th style="width: 190px;">Kategori</th>
                        <th>Modul / Layanan</th>
                        <th style="width: 100px;" class="text-center">Aksi</th>
                        <th style="width: 90px;" class="text-end">Arsip</th>
                        <th style="width: 90px;" class="text-end">Live</th>
                        <th style="width: 90px;" class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recap['module_details'] as $index => $detail)
                        <tr>
                            <td class="text-center text-muted">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $detail['period_label'] }}</td>
                            <td>
                                @if($detail['category'] === 'pemohon')
                                    <span class="badge-source badge-source-archive">Pemohon Surat</span>
                                @else
                                    <span class="badge-source badge-source-live">Pegawai Internal</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $detail['module'] }}</td>
                            <td class="text-center">{{ $detail['action'] }}</td>
                            <td class="text-end text-muted">{{ number_format($detail['archived_total']) }}</td>
                            <td class="text-end text-muted">{{ number_format($detail['live_total']) }}</td>
                            <td class="text-end fw-bold">{{ number_format($detail['total']) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada rincian aktivitas untuk filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pruneBtn = document.getElementById('btnManualPrune');
    const pruneForm = document.getElementById('manualPruneForm');

    if (pruneBtn && pruneForm) {
        pruneBtn.addEventListener('click', function () {
            const total = parseInt(pruneBtn.dataset.total || '0', 10);
            const message = total > 0
                ? 'Sebanyak ' + total.toLocaleString('id-ID') + ' log detail lama (> batas retensi) akan diringkas ke Rekap Bulanan lalu detail mentahnya dihapus. Lanjutkan?'
                : 'Jalankan pemeriksaan & pengarsipan log lama sekarang?';

            Swal.fire({
                title: 'Ringkas & Arsipkan Log Lama?',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#163a63',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Arsipkan',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    pruneForm.submit();
                }
            });
        });
    }
});
</script>
@endpush
