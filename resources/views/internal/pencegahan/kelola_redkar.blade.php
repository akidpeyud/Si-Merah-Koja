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
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0;}
    .btn-add { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: var(--success); color: #fff; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; }
    .btn-add:hover { background: #148f65; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, .25); color: #fff; }
    .btn-print-rekap { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: var(--navy); color: #fff; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; }
    .btn-print-rekap:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease;}
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }
    .badge-status { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .badge-akun { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; margin-top: 4px;}
    .status-pending { background: rgba(244, 183, 64, .15); color: #d97706; }
    .status-memenuhi { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-tidak { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-action-group { display: flex; flex-wrap: wrap; justify-content: center; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; cursor: pointer; }
    .btn-lihat { background: var(--info-soft); color: var(--info); }
    .btn-lihat:hover { background: var(--info); color: #ffffff; }
    .btn-update { background: var(--navy-soft); color: var(--navy); }
    .btn-update:hover { background: var(--navy); color: #ffffff; }
    .btn-warning-soft { background: rgba(244, 183, 64, .15); color: #d97706; }
    .btn-warning-soft:hover { background: #d97706; color: #ffffff; }
    .btn-danger-soft { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-danger-soft:hover { background: var(--signal-dark); color: #ffffff; }
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
    @media print {
        .topbar, .sidebar, .btn-print-rekap, .btn-add, .btn-logout, .no-print-col, .page-head-title p { display: none !important; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; background: white; }
        .content-card { padding: 0; border: none; box-shadow: none; }
        body { background-color: white; margin: 0; padding: 0; }
        .page-head-title h1 { font-size: 1.5rem; text-align: center; width: 100%; margin-bottom: 20px; }
        .table thead th { background: transparent; color: #000; border-bottom: 2px solid #000; }
        .table td, .table th { border-color: #ddd; color: #000; font-size: .8rem; }
        .badge-status, .badge-akun { border: 1px solid #000; background: transparent !important; color: #000 !important; }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head">
            <div class="page-head-title">
                <h1>Daftar Calon Relawan (REDKAR)</h1>
                <p>Kelola data pendaftaran relawan masyarakat dan pendaftaran langsung kantor.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <!-- TOMBOL TAMBAH HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                @hasanyrole('Pencegahan|Super User')
                <a href="/internal/pencegahan/tambah-redkar" class="btn-add"><i class="fas fa-user-plus"></i> Tambah Relawan</a>
                @endhasanyrole

                <!-- TOMBOL CETAK REKAP TERBUKA UNTUK SEMUA ROLE -->
                <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print"></i> Cetak Rekap</button>
            </div>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Kecamatan</th>
                            <th>No. Telp (WA)</th>
                            <th>Status Akun</th>
                            <th class="no-print-col text-center">Berkas KTP</th>
                            <th class="text-center no-print-col" width="300px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($relawan as $r)
                        <tr>
                            <td>
                                <strong>{{ $r->created_at->format('d M Y') }}</strong>
                                <div style="font-size: .8rem; color: var(--steel-soft);">{{ $r->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="fw-bold">{{ $r->nik }}</td>
                            <td>
                                <strong style="display: block; margin-bottom: 2px;">{{ $r->nama_lengkap }}</strong>
                                
                                @if($r->status_akun == 'Aktif')
                                    <span class="badge-akun status-memenuhi"><i class="fas fa-user-check me-1"></i> Akun Aktif</span>
                                @else
                                    <span class="badge-akun status-tidak"><i class="fas fa-user-lock me-1"></i> Akun Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $r->kecamatan }}</td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->nomor_telp) }}" target="_blank" style="font-size: .85rem; color: var(--success); text-decoration: none;">
                                    <i class="fab fa-whatsapp"></i> {{ $r->nomor_telp }}
                                </a>
                            </td>
                            <td>
                                @if($r->status_pendaftaran == 'Diterima')
                                    <span class="badge-status status-memenuhi">Diterima</span>
                                @elseif($r->status_pendaftaran == 'Ditolak')
                                    <span class="badge-status status-tidak">Ditolak</span>
                                @else
                                    <span class="badge-status status-pending">Pending</span>
                                @endif
                            </td>
                            <td class="no-print-col text-center">
                                @if($r->file_ktp && $r->file_ktp !== 'offline_registered')
                                    <a href="/storage/{{ $r->file_ktp }}" target="_blank" class="btn-action btn-lihat py-1" style="font-size: 0.75rem;">
                                        <i class="fas fa-id-card me-1"></i> KTP
                                    </a>
                                @else
                                    <span style="font-size: .75rem; color: var(--steel-soft);">- Offline -</span>
                                @endif
                            </td>
                            <td class="text-center no-print-col">
                                <div class="btn-action-group">
                                    
                                    <!-- TOMBOL STATUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                                    @hasanyrole('Pencegahan|Super User')
                                    <button type="button" class="btn-action btn-update" data-bs-toggle="modal" data-bs-target="#modalStatusRedkar{{ $r->id }}" title="Verifikasi Pendaftaran">
                                        <i class="fas fa-user-check"></i> Status
                                    </button>
                                    @endhasanyrole

                                    <!-- TOMBOL EDIT HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                                    @hasanyrole('Pencegahan|Super User')
                                    <a href="/internal/pencegahan/edit-redkar/{{ $r->id }}" class="btn-action btn-warning-soft" title="Edit Data">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @endhasanyrole

                                    <!-- TOMBOL CETAK PDF PER ORANG TERBUKA UNTUK SEMUA ROLE -->
                                    <a href="/internal/pencegahan/cetak-redkar/{{ $r->id }}" target="_blank" class="btn-action btn-lihat" title="Cetak PDF">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                    
                                    <!-- TOMBOL HAPUS HANYA UNTUK PENCEGAHAN DAN SUPER USER -->
                                    @hasanyrole('Pencegahan|Super User')
                                    <form action="/internal/pencegahan/hapus-redkar/{{ $r->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus relawan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-danger-soft" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endhasanyrole

                                </div>
                            </td>
                        </tr>

                        <!-- MODAL VERIFIKASI STATUS (DIBATASI HANYA UNTUK PENCEGAHAN DAN SUPER USER) -->
                        @hasanyrole('Pencegahan|Super User')
                        <div class="modal fade" id="modalStatusRedkar{{ $r->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="border: none; border-radius: var(--r-md); box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                                    <form action="/internal/pencegahan/update-status-redkar/{{ $r->id }}" method="POST">
                                        @csrf
                                        <div class="modal-header" style="background: var(--paper); border-bottom: 1px solid var(--line);">
                                            <h5 class="modal-title" style="font-family: var(--font-display); font-weight: 700; color: var(--ink);">
                                                <i class="fas fa-user-check text-primary me-2"></i> Verifikasi Akun
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start">
                                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                                Ubah status pendaftaran atas nama <strong class="text-dark">{{ $r->nama_lengkap }}</strong>.<br>
                                                <em style="font-size: 0.8rem;">Relawan bisa login jika pendaftaran "Diterima" dan Akun "Aktif".</em>
                                            </p>
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-bold" style="font-size: 0.9rem; color: var(--ink);">Status Pendaftaran</label>
                                                <select name="status_pendaftaran" class="form-select shadow-sm" required style="border-radius: 8px;">
                                                    <option value="Pending" {{ $r->status_pendaftaran == 'Pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                                    <option value="Diterima" {{ $r->status_pendaftaran == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                                    <option value="Ditolak" {{ $r->status_pendaftaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold" style="font-size: 0.9rem; color: var(--ink);">Status Akses Login</label>
                                                <select name="status_akun" class="form-select shadow-sm" required style="border-radius: 8px;">
                                                    <option value="Aktif" {{ $r->status_akun == 'Aktif' ? 'selected' : '' }}>Aktif (Bisa Login)</option>
                                                    <option value="Nonaktif" {{ $r->status_akun == 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Akses Ditutup)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background: var(--paper); border-top: 1px solid var(--line);">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
                                            <button type="submit" class="btn btn-primary" style="background: var(--navy); border-color: var(--navy); border-radius: 8px; font-weight: 600;">
                                                <i class="fas fa-save me-1"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole

                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted" style="font-size: .95rem;">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data relawan REDKAR yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

<!-- Script Bootstrap -->
@endsection
