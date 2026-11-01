@extends('layouts.dashboard')

@section('title', 'Riwayat Permohonan Surat')

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
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
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

    .badge-service-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .76rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
        background: rgba(13, 148, 136, .12);
        color: #0f766e;
        border: 1px solid rgba(13, 148, 136, .25);
    }

    .badge-pemohon-tag {
        display: inline-block;
        font-size: .72rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
        background: rgba(37, 99, 235, .1);
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
        <h1>Riwayat Permohonan Surat</h1>
        <p>Catatan rekam jejak aktivitas penginputan permohonan surat layanan publik oleh masyarakat/pemohon.</p>
    </div>
    <div class="btn-group p-1 bg-white border rounded-3 shadow-xs">
        <a href="{{ route('internal.riwayat-aktivitas') }}" class="btn btn-sm btn-light text-secondary fw-semibold px-3 py-2">
            <i class="fa-solid fa-user-tie me-1"></i> Aktivitas Internal
        </a>
        <a href="{{ route('internal.riwayat-aktivitas-pemohon') }}" class="btn btn-sm btn-primary fw-bold px-3 py-2" style="background: var(--navy); border-color: var(--navy);">
            <i class="fa-solid fa-file-signature me-1"></i> Permohonan Surat
        </a>
    </div>
</div>

<!-- Ringkasan Statistik -->
<div class="stat-cards-grid">
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(13, 148, 136, .14); color: #0f766e;">
            <i class="fa-solid fa-file-signature"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['total']) }}</div>
            <div class="mini-stat-label">Total Permohonan</div>
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
        <div class="mini-stat-ico" style="background: var(--navy-soft); color: var(--navy);">
            <i class="fa-solid fa-building-shield"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['rpkbgl']) }}</div>
            <div class="mini-stat-label">RPKBGL</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(25, 135, 84, .12); color: var(--success);">
            <i class="fa-solid fa-certificate"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['skk']) }}</div>
            <div class="mini-stat-label">SKK</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(244, 183, 64, .18); color: #b7791f;">
            <i class="fa-solid fa-users-viewfinder"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['izin']) }}</div>
            <div class="mini-stat-label">Izin Keramaian</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(220, 53, 69, .12); color: var(--signal);">
            <i class="fa-solid fa-truck-droplet"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['sarana']) }}</div>
            <div class="mini-stat-label">Sarana Damkar</div>
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat-ico" style="background: rgba(147, 51, 234, .12); color: #7e22ce;">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <div class="mini-stat-val">{{ number_format($stats['edukasi']) }}</div>
            <div class="mini-stat-label">Edukasi</div>
        </div>
    </div>
</div>

<div class="content-card">
    <!-- Filter Pencarian -->
    <form action="{{ route('internal.riwayat-aktivitas-pemohon') }}" method="GET" class="filter-card">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label small fw-semibold text-muted mb-1">Cari Pemohon / Keterangan</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: var(--line-dark);">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Ketik nama pemohon, usaha, acara..." value="{{ request('q') }}">
                </div>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Layanan / Jenis Surat</label>
                <select name="module" class="form-select">
                    <option value="">Semua Layanan Surat</option>
                    @foreach($modules as $mod)
                        <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>{{ $mod }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Dari Tanggal</label>
                <input type="date" name="date_start" class="form-control" value="{{ request('date_start') }}">
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Sampai Tanggal</label>
                <input type="date" name="date_end" class="form-control" value="{{ request('date_end') }}">
            </div>

            <div class="col-12 col-md-1 d-flex justify-content-end gap-1">
                <button type="submit" class="btn btn-sm btn-primary w-100" style="background: var(--navy); border-color: var(--navy); min-height: 40px;" title="Terapkan Filter">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </div>

            @if(request()->anyFilled(['q', 'module', 'date_start', 'date_end']))
                <div class="col-12 text-end mt-2">
                    <a href="{{ route('internal.riwayat-aktivitas-pemohon') }}" class="btn btn-sm btn-light border px-3">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </form>

    <!-- Tabel Riwayat Permohonan Pemohon -->
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">No</th>
                    <th style="width: 170px;">Waktu Pengajuan</th>
                    <th style="width: 220px;">Pemohon</th>
                    <th style="width: 210px;">Layanan Surat</th>
                    <th>Keterangan Permohonan</th>
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
                            <div class="fw-bold">{{ $log->user_name ?: 'Pemohon Surat' }}</div>
                            <span class="badge-pemohon-tag mt-1">
                                <i class="fa-solid fa-user-check me-1"></i> Pemohon
                            </span>
                        </td>
                        <td>
                            <span class="badge-service-pill">
                                <i class="fa-solid fa-envelope-open-text"></i> {{ $log->module }}
                            </span>
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
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-file-circle-check"></i>
                                <h5>Belum ada log permohonan surat pemohon</h5>
                                <p class="text-muted small mb-0">Setiap ada masyarakat/pemohon yang menginputkan permohonan surat layanan, riwayatnya akan otomatis tercatat di sini.</p>
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
