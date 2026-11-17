@extends('layouts.dashboard')

@section('title', 'Riwayat Aktivitas')

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

    /* Statistik ringkas */
    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
        font-size: 1.5rem;
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

    .content-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 24px;
        box-shadow: var(--shadow-xs);
    }

    /* Filter area */
    .filter-card {
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: var(--r-sm);
        padding: 16px;
        margin-bottom: 20px;
    }
    .filter-card .form-control, .filter-card .form-select {
        min-height: 40px;
        font-size: .88rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px;
    }
    .filter-card .form-control:focus, .filter-card .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }

    .table-responsive { overflow-x: auto; }
    .table { margin-bottom: 0; min-width: 950px; }
    .table thead th {
        background: var(--paper);
        color: var(--steel);
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        white-space: nowrap;
    }
    .table tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        color: var(--ink);
        font-size: .88rem;
        font-weight: 500;
        border-bottom: 1px solid var(--line);
    }
    .table tbody tr:hover { background: rgba(22, 58, 99, .02); }
    .table tbody tr:last-child td { border-bottom: none; }

    /* Badge aksi */
    .badge-act {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: .74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .02em;
    }
    .badge-act-tambah { background: rgba(25, 135, 84, .12); color: var(--success); }
    .badge-act-ubah   { background: rgba(37, 99, 235, .12); color: var(--info); }
    .badge-act-hapus  { background: rgba(220, 53, 69, .12); color: var(--signal); }
    .badge-act-proses { background: rgba(100, 116, 139, .14); color: var(--steel); }

    .badge-role-pill {
        display: inline-block;
        font-size: .72rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
        background: var(--navy-soft);
        color: var(--navy);
    }

    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: var(--steel);
    }
    .empty-state i {
        font-size: 3rem;
        color: var(--steel-soft);
        margin-bottom: 12px;
    }
</style>
@endpush

@section('content')
<div class="page-head d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1>Riwayat Aktivitas Internal</h1>
        <p>Catatan rekam jejak aktivitas operasional (tambah, ubah, dan hapus data) oleh pegawai internal sistem.</p>
        <div class="mt-2 d-flex flex-wrap align-items-center gap-2">
            <span class="badge rounded-pill text-bg-light border text-secondary px-3 py-2 fw-semibold">
                <i class="fa-regular fa-calendar me-1 text-primary"></i> Periode: {{ $period['period_label'] }}
            </span>
            <span class="small text-muted">
                Log detail otomatis diringkas ke <a href="{{ route('internal.riwayat-aktivitas-rekap') }}" class="text-decoration-underline fw-semibold text-secondary">Rekap Bulanan</a> setelah {{ $retentionMonths }} bulan.
            </span>
        </div>
    </div>
    <div class="btn-group p-1 bg-white border rounded-3 shadow-xs">
        <a href="{{ route('internal.riwayat-aktivitas') }}" class="btn btn-sm btn-primary fw-bold px-3 py-2" style="background: var(--navy); border-color: var(--navy);">
            <i class="fa-solid fa-user-tie me-1"></i> Aktivitas Internal
        </a>
        <a href="{{ route('internal.riwayat-aktivitas-pemohon') }}" class="btn btn-sm btn-light text-secondary fw-semibold px-3 py-2">
            <i class="fa-solid fa-file-signature me-1"></i> Permohonan Surat
        </a>
        <a href="{{ route('internal.riwayat-aktivitas-rekap') }}" class="btn btn-sm btn-light text-secondary fw-semibold px-3 py-2">
            <i class="fa-solid fa-chart-column me-1"></i> Rekap Bulanan
        </a>
    </div>
</div>

<!-- Ringkasan Statistik -->
<div class="stat-cards-grid">
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: var(--navy-soft); color: var(--navy);">
            <i class="fa-solid fa-list-check"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['total']) }}</div>
            <div class="mini-stat-label">Total Aktivitas</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(37, 99, 235, .12); color: var(--info);">
            <i class="fa-solid fa-calendar-day"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['today']) }}</div>
            <div class="mini-stat-label">Hari Ini</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(25, 135, 84, .12); color: var(--success);">
            <i class="fa-solid fa-square-plus"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['tambah']) }}</div>
            <div class="mini-stat-label">Tambah Data</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(244, 183, 64, .18); color: #b7791f;">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['ubah']) }}</div>
            <div class="mini-stat-label">Ubah Data</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(220, 53, 69, .12); color: var(--signal);">
            <i class="fa-solid fa-trash-can"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['hapus']) }}</div>
            <div class="mini-stat-label">Hapus Data</div>
        </div>
    </div>
</div>

<div class="content-card">
    <!-- Filter Pencarian -->
    <form action="{{ route('internal.riwayat-aktivitas') }}" method="GET" class="filter-card" id="filterLogForm">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label small fw-semibold text-muted mb-1">Cari Keterangan / Pengguna</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: var(--line-dark);">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Ketik kata kunci..." value="{{ request('q') }}">
                </div>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Bulan</label>
                <select name="month" class="form-select period-select">
                    <option value="all" {{ $period['selected_month'] === 'all' ? 'selected' : '' }}>Semua Bulan</option>
                    @foreach($monthOptions as $num => $name)
                        <option value="{{ $num }}" {{ (string) $period['selected_month'] === (string) $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Tahun</label>
                <select name="year" class="form-select period-select">
                    <option value="all" {{ $period['selected_year'] === 'all' ? 'selected' : '' }}>Semua Tahun</option>
                    @foreach($availableYears as $yr)
                        <option value="{{ $yr }}" {{ (string) $period['selected_year'] === (string) $yr ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Jenis Aksi</label>
                <select name="action" class="form-select">
                    <option value="">Semua Aksi</option>
                    <option value="Tambah" {{ request('action') === 'Tambah' ? 'selected' : '' }}>Tambah</option>
                    <option value="Ubah" {{ request('action') === 'Ubah' ? 'selected' : '' }}>Ubah</option>
                    <option value="Hapus" {{ request('action') === 'Hapus' ? 'selected' : '' }}>Hapus</option>
                </select>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Modul / Menu</label>
                <select name="module" class="form-select">
                    <option value="">Semua Modul</option>
                    @foreach($modules as $mod)
                        <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>{{ $mod }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Dari Tanggal (Opsional)</label>
                <input type="date" name="date_start" class="form-control date-range-input" value="{{ request('date_start') }}">
            </div>

            <div class="col-6 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Sampai Tanggal (Opsional)</label>
                <input type="date" name="date_end" class="form-control date-range-input" value="{{ request('date_end') }}">
            </div>

            <div class="col-12 col-md-6 d-flex justify-content-end gap-2 mt-2 mt-md-0">
                <button type="submit" class="btn btn-sm btn-primary px-3 py-2" style="background: var(--navy); border-color: var(--navy);">
                    <i class="fa-solid fa-filter me-1"></i> Terapkan Filter
                </button>
                @if(! $period['is_default_current_month'] || request()->anyFilled(['q', 'action', 'module', 'date_start', 'date_end']))
                    <a href="{{ route('internal.riwayat-aktivitas') }}" class="btn btn-sm btn-light border px-3 py-2">
                        <i class="fa-solid fa-rotate-left me-1"></i> Bulan Ini
                    </a>
                @endif
            </div>
        </div>
    </form>

    <!-- Tabel Riwayat -->
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">No</th>
                    <th style="width: 170px;">Waktu</th>
                    <th style="width: 200px;">Petugas Internal</th>
                    <th style="width: 110px;" class="text-center">Aksi</th>
                    <th style="width: 180px;">Modul</th>
                    <th>Deskripsi Aktivitas</th>
                    <th style="width: 130px;">IP Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $index => $log)
                    <tr>
                        <td class="text-center text-muted">{{ $logs->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $log->created_at->translatedFormat('d M Y') }}</div>
                            <small class="text-muted">{{ $log->created_at->format('H:i:s') }} WIB ({{ $log->created_at->diffForHumans() }})</small>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $log->user_name ?: ($log->user?->nama_lengkap ?? 'Anonim') }}</div>
                            @if($log->user_role === 'Pemohon')
                                <span class="badge-role-pill mt-1" style="background: rgba(13, 148, 136, .12); color: #0f766e; border: 1px solid rgba(13, 148, 136, .25);">
                                    <i class="fa-solid fa-user-check me-1"></i> Pemohon Surat
                                </span>
                            @elseif($log->user_role)
                                <span class="badge-role-pill mt-1">{{ $log->user_role }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @php
                                $act = strtolower($log->action);
                                $badgeClass = match($act) {
                                    'tambah' => 'badge-act-tambah',
                                    'ubah' => 'badge-act-ubah',
                                    'hapus' => 'badge-act-hapus',
                                    default => 'badge-act-proses',
                                };
                                $icon = match($act) {
                                    'tambah' => 'fa-plus',
                                    'ubah' => 'fa-pen',
                                    'hapus' => 'fa-trash',
                                    default => 'fa-bolt',
                                };
                            @endphp
                            <span class="badge-act {{ $badgeClass }}">
                                <i class="fa-solid {{ $icon }}"></i> {{ $log->action }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-semibold text-secondary">{{ $log->module }}</span>
                        </td>
                        <td>
                            <div class="text-break">{{ $log->description ?: '-' }}</div>
                        </td>
                        <td>
                            <code class="small text-muted">{{ $log->ip_address ?: '-' }}</code>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <h5>Belum ada riwayat aktivitas</h5>
                                <p class="text-muted small mb-0">Aktivitas penambahan, pembaruan, dan penghapusan data akan tercatat secara otomatis di sini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($logs->hasPages())
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3 border-top mt-3">
            <small class="text-muted">
                Menampilkan {{ $logs->firstItem() ?? 0 }} sampai {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} riwayat
            </small>
            <div>
                {{ $logs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const periodSelects = document.querySelectorAll('#filterLogForm .period-select');
    const dateInputs = document.querySelectorAll('#filterLogForm .date-range-input');

    dateInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            if (input.value) {
                periodSelects.forEach(function (sel) { sel.value = 'all'; });
            }
        });
    });

    periodSelects.forEach(function (sel) {
        sel.addEventListener('change', function () {
            if (sel.value !== 'all') {
                dateInputs.forEach(function (input) { input.value = ''; });
            }
        });
    });
});
</script>
@endpush
