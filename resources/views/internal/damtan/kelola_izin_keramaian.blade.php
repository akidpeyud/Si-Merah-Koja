@extends('layouts.dashboard')

@section('title', 'Kelola Izin Keramaian')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
                --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
                --paper: #f5f7fa; --white: #ffffff;
                --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
                --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
                --steel: #64748b; --steel-soft: #94a3b8;
                --line: #e2e8f0; --line-dark: #cbd5e1;
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
                --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
                --sidebar-w: 272px; --topbar-h: 70px;
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; }
    .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::placeholder { color: var(--steel-soft); }
    .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .table th { background-color: #f8fafc; color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); letter-spacing: 0.02em; }
    .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
    .table tbody tr:hover { background-color: var(--paper); }
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
    .action-btn.view { background-color: var(--info-soft); color: var(--info); }
    .action-btn.view:hover { background-color: #dbeafe; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.25); }
    .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); }
    .action-btn.delete:hover { background-color: #fecaca; }
    .action-wrap { display: inline-flex; align-items: center; justify-content: center; gap: 8px; white-space: nowrap; }
    .action-wrap form { margin: 0; display: inline-flex; }
    .badge-status { display: inline-block; padding: 6px 12px; font-weight: 600; font-size: 0.8rem; border-radius: 6px; }
    .badge-pending { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-proses { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .status-select { min-height: 34px; padding: 4px 28px 4px 10px; font-size: .8rem; font-weight: 600; border-radius: 6px; width: auto; min-width: 120px; cursor: pointer; }
    .status-select.s-Pending   { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
    .status-select.s-Proses    { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .status-select.s-Disetujui { background-color: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
    .status-select.s-Ditolak   { background-color: #fef2f2; color: #b91c1c; border-color: #fecaca; }
    /* Jenis event: hiburan | non_hiburan (sesuai pilihan di formulir) */
    .badge-jenis { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; font-weight: 600; font-size: .78rem; border-radius: 999px; white-space: nowrap; }
    .badge-jenis.hiburan     { background-color: #fdf2f8; color: #be185d; border: 1px solid #fbcfe8; }
    .badge-jenis.non_hiburan { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
</style>
@endpush

@section('content')

@php
    // Label jenis event (nilai di formulir: hiburan | non_hiburan)
    $jenisEventLabel = [
        'hiburan'     => 'Hiburan',
        'non_hiburan' => 'Non-Hiburan',
    ];
    // Status permohonan yang tersedia di dropdown admin
    $daftarStatus = ['Pending', 'Proses', 'Disetujui', 'Ditolak'];
@endphp

        <div class="page-header">
            <div class="page-header-text">
                <h1>Kelola Event Keramaian</h1>
                <p>Daftar seluruh pengajuan rekomendasi pengamanan event pemerintah dan swasta.</p>
            </div>
        </div>

        <div class="card-custom">
            <!-- Filter & Search Bar -->
            <div class="card-header bg-white p-4 border-bottom border-light">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nama pemohon, usaha/instansi, acara, lokasi, jenis event...">
                        </div>
                    </div>
                    <div class="col-md-4 text-end ms-auto">
                        <button class="btn-custom-light w-100 py-2 border-light fw-bold" onclick="resetFilter()"><i class="fas fa-sync-alt me-2"></i>Reset Filter</button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="17%">Nama Pemohon</th>
                                <th width="12%">Kontak</th>
                                <th width="20%">Nama Acara</th>
                                <th width="10%">Jenis Event</th>
                                <th width="12%">Tgl Acara</th>
                                <th width="12%">Status</th>
                                <th class="text-center" width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($permohonan as $row)
                            @php
                                $jenisLabel = $jenisEventLabel[$row->jenis_event] ?? ucfirst(str_replace('_', ' ', (string) $row->jenis_event));
                            @endphp
                            <tr data-search="{{ strtolower($row->nama . ' ' . $row->no_hp . ' ' . $row->nama_usaha . ' ' . $row->nama_acara . ' ' . $row->lokasi_acara . ' ' . $jenisLabel . ' ' . $row->status_permohonan) }}">
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $row->nama }}</strong><br>
                                    <small class="text-muted">{{ $row->nama_usaha }}</small>
                                </td>
                                <td>{{ $row->no_hp }}</td>
                                <td class="text-capitalize">{{ $row->nama_acara }}<br><small class="text-muted">{{ $row->lokasi_acara }}</small></td>
                                <td>
                                    @if($row->jenis_event)
                                        <span class="badge-jenis {{ $row->jenis_event }}">{{ $jenisLabel }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-dark fw-bold">
                                        {{ \Carbon\Carbon::parse($row->tgl_pelaksanaan)->translatedFormat('d M Y') }}
                                    </div>
                                    <small class="text-muted">{{ substr($row->waktu_mulai, 0, 5) }} - {{ substr($row->waktu_selesai, 0, 5) }}</small>
                                </td>
                                <td>
                                    {{-- UBAH STATUS: HANYA DAMTAN DAN SUPER USER --}}
                                    @hasanyrole('Damtan|Super User')
                                        <form action="{{ route('internal.izin-keramaian.update_status', $row->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <select name="status_permohonan"
                                                    class="form-select status-select s-{{ $row->status_permohonan }}"
                                                    data-old="{{ $row->status_permohonan }}"
                                                    onchange="konfirmasiStatus(this)">
                                                @foreach($daftarStatus as $st)
                                                    <option value="{{ $st }}" {{ $row->status_permohonan == $st ? 'selected' : '' }}>{{ $st }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        {{-- ROLE LAIN: HANYA MELIHAT STATUS --}}
                                        @if($row->status_permohonan == 'Pending')
                                            <span class="badge-status badge-pending">{{ $row->status_permohonan }}</span>
                                        @elseif($row->status_permohonan == 'Proses')
                                            <span class="badge-status badge-proses">{{ $row->status_permohonan }}</span>
                                        @elseif($row->status_permohonan == 'Disetujui')
                                            <span class="badge-status badge-disetujui">{{ $row->status_permohonan }}</span>
                                        @elseif($row->status_permohonan == 'Ditolak')
                                            <span class="badge-status badge-ditolak">{{ $row->status_permohonan }}</span>
                                        @else
                                            <span class="badge-status" style="background:#e2e8f0; color:#475569; border:1px solid #cbd5e1;">{{ $row->status_permohonan }}</span>
                                        @endif
                                    @endhasanyrole
                                </td>
                                <td class="text-center">
                                    <div class="action-wrap">
                                        <!-- Detail: semua role -->
                                        <a href="{{ route('internal.izin-keramaian.show', $row->id) }}" class="action-btn view" title="Lihat Detail"><i class="fas fa-eye"></i></a>

                                        <!-- EDIT & HAPUS: HANYA DAMTAN DAN SUPER USER -->
                                        @hasanyrole('Damtan|Super User')
                                        <a href="{{ route('internal.izin-keramaian.edit', $row->id) }}" class="action-btn edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('internal.izin-keramaian.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan ini secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endhasanyrole
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash mb-3" style="font-size: 24px;"></i><br>
                                    Belum ada data pengajuan Izin Keramaian.
                                </td>
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
    (function () {
        'use strict';
        /* Sidebar Toggle */
        var toggle = document.getElementById('sideToggle');
        var backdrop = document.getElementById('sideBackdrop');
        function closeSide() {
            document.body.classList.remove('side-open');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
        }
        if (toggle) {
            toggle.addEventListener('click', function () {
                var open = document.body.classList.toggle('side-open');
                toggle.setAttribute('aria-expanded', open);
            });
        }
        if (backdrop) backdrop.addEventListener('click', closeSide);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

        /* Accordion Sidebar */
        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });
    })();

    /* Konfirmasi ubah status */
    function konfirmasiStatus(select) {
        var lama = select.dataset.old;
        var baru = select.value;
        if (confirm('Ubah status permohonan dari "' + lama + '" menjadi "' + baru + '"?')) {
            select.form.submit();
        } else {
            select.value = lama;
        }
    }

    /* Search (memakai data-search agar teks opsi dropdown tidak ikut terbaca) */
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#tableBody tr[data-search]');

        function filterTable() {
            const term = searchInput.value.toLowerCase();
            rows.forEach(function (row) {
                row.style.display = row.dataset.search.includes(term) ? '' : 'none';
            });
        }
        searchInput.addEventListener('keyup', filterTable);
    });

    function resetFilter() {
        document.getElementById('searchInput').value = "";
        document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
    }
</script>
@endpush