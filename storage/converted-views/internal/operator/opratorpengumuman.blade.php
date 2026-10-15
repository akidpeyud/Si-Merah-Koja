@extends('layouts.dashboard')

@section('title', 'Kelola Pengumuman')

@push('styles')
<style>
    .toast {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 12px 12px 16px;
        border-radius: 999px;
        background: #fff; border: 1px solid var(--line);
        box-shadow: var(--shadow-md);
        font-weight: 600; font-size: .92rem;
        animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
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
    @media (max-width: 1100px) {
        .content { padding: 32px 26px 60px; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .overview { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .ov-item:nth-child(3n) { border-right: 0; }
        .ov-item:nth-child(n+4) { border-top: 1px solid rgba(255,255,255,.10); }
    }
    @media (max-width: 700px) {
        .content { padding: 26px 16px 50px; }
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .welcome { padding: 25px 22px; margin-bottom: 30px; border-radius: 15px; }
        .welcome h2 { font-size: 1.3rem; }
        .welcome-sub { font-size: .88rem; }
        .overview { grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 24px; }
        .ov-item { padding: 15px 16px; gap: 10px; }
        .ov-item:nth-child(3n) { border-right: 1px solid rgba(255,255,255,.10); }
        .ov-item:nth-child(2n) { border-right: 0; }
        .ov-item:nth-child(n+3) { border-top: 1px solid rgba(255,255,255,.10); }
        .ov-item strong { font-size: 1.6rem; }
        .section-heading { gap: 9px; }
        .section-heading-ico { width: 30px; height: 30px; }
        .section-heading h3 { font-size: .92rem; }
        .dash-section { margin-bottom: 32px; }
        .section-meta { margin-left: 0; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .stat-card { padding: 15px; gap: 12px; }
        .stat-title { font-size: .84rem; }
        .stat-value { font-size: 1.6rem; }
    }
    @media (max-width: 420px) {
        .content { padding-left: 13px; padding-right: 13px; }
        .welcome { padding: 22px 18px; }
        .stats-grid { grid-template-columns: 1fr; }
        .welcome h2 { font-size: 1.18rem; }
        .welcome-sub { font-size: .84rem; }
        .section-heading h3 { font-size: .86rem; }
    }
    @media print {
        .content { padding: 20px; }
        .welcome { box-shadow: none; border: 1px solid #ddd; }
        .stat-card { box-shadow: none; break-inside: avoid; }
    }
    .page-head-bar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 28px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
    .section-heading-ico { flex: none; width: 34px; height: 34px; border-radius: 10px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .82rem; }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }
    .btn-simerah-danger { background: var(--signal); color: #ffffff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220, 53, 69, .22); transition: background .2s, transform .15s, box-shadow .2s; }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #ffffff; transform: translateY(-1px); }
    .btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); transition: background .2s; }
    .btn-simerah-secondary:hover { background: var(--line); }
    .card-box { background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }
    .table-simerah { margin-bottom: 0; width: 100%; border-collapse: collapse; }
    .table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
    .table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-simerah tbody tr:last-child td { border-bottom: none; }
    .table-simerah tbody tr:hover { background-color: #f9fbfd; }
    .row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }
    .pengumuman-title { font-family: var(--font-display); font-weight: 700; font-size: .98rem; color: var(--ink); margin-bottom: 6px; line-height: 1.35; }
    .pengumuman-desc { font-size: .88rem; color: var(--steel); margin-bottom: 8px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .badge-attachment { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 6px; background: var(--info-soft); color: var(--info); font-size: .78rem; font-weight: 600; transition: background .2s, color .2s; text-decoration: none; }
    .badge-attachment:hover { background: var(--info); color: #fff; }
    .action-group { display: inline-flex; align-items: center; gap: 8px; }
    .btn-edit-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--navy); background: var(--navy-soft); transition: background .2s, color .2s; }
    .btn-edit-item:hover { background: var(--navy); color: #ffffff; }
    .btn-delete-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--signal-dark); background: var(--signal-soft); transition: background .2s, color .2s; }
    .btn-delete-item:hover { background: var(--signal); color: #ffffff; }
    .empty-state { padding: 48px 24px; text-align: center; }
    .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--navy-soft); color: var(--navy); display: grid; place-items: center; font-size: 1.5rem; margin: 0 auto 14px; }
    .empty-state h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); margin-bottom: 6px; }
    .empty-state p { color: var(--steel); font-size: .88rem; max-width: 42ch; margin: 0 auto 18px; }
    .modal-content { border-radius: var(--r-lg); border: 1px solid var(--line); box-shadow: var(--shadow-lg); overflow: hidden; }
    .modal-header { background: var(--ink); color: #ffffff; border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: #ffffff; display: flex; align-items: center; gap: 10px; }
    .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); opacity: .75; }
    .modal-body { padding: 24px; }
    .modal-footer { background: #f8fafc; border-top: 1px solid var(--line); padding: 14px 24px; }
    .form-label { font-size: .84rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
    .form-control { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 10px 14px; font-size: .92rem; color: var(--ink); }
    .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-hint { display: block; font-size: .78rem; color: var(--steel); margin-top: 6px; }
    @media (max-width: 700px) {
        .content { padding: 26px 16px 50px; }
        .btn-simerah-danger.w-mobile-100 { width: 100%; }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head-bar">
            <div class="page-head">
                <h1>Kelola Pengumuman</h1>
                <p>Unggah dan kelola informasi pengumuman penting untuk ditayangkan di portal publik atau internal.</p>
            </div>
            
            @hasanyrole('Operator|Super User')
            <button type="button" class="btn-simerah-danger w-mobile-100" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Pengumuman
            </button>
            @endhasanyrole
        </div>

        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-bullhorn"></i></span>
            <h3>Daftar Pengumuman Aktif</h3>
            <span class="line"></span>
            <span class="count-pill">
                <i class="fas fa-list"></i> {{ isset($pengumuman) ? count($pengumuman) : 0 }} Data
            </span>
        </div>

        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-simerah align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 55%;">Detail Pengumuman</th>
                            <th style="width: 20%;">Tanggal Posting</th>
                            
                            @hasanyrole('Operator|Super User')
                            <th style="width: 20%;" class="text-center">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumuman ?? [] as $index => $item)
                        <tr>
                            <td><span class="row-num">{{ $index + 1 }}</span></td>
                            <td>
                                <div class="pengumuman-title">
                                    @if($item->penting) <span class="badge bg-danger me-1">Penting</span> @endif
                                    {{ $item->judul }}
                                </div>
                                <div class="pengumuman-desc">{{ Str::limit($item->isi, 100) }}</div>
                                
                                @if(!empty($item->lampiran))
                                    <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank" class="badge-attachment">
                                        <i class="fas fa-paperclip"></i> Lihat Lampiran
                                    </a>
                                @endif
                                
                                <span class="badge bg-secondary mt-1">{{ $item->kategori }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                            </td>
                            
                            @hasanyrole('Operator|Super User')
                            <td class="text-center">
                                <div class="action-group">
                                    <button type="button" class="btn-edit-item"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                        <i class="fas fa-pen-to-square"></i> Edit
                                    </button>
                                    <form action="{{ route('operator.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-item">
                                            <i class="fas fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <!-- Modal Edit per Item -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('operator.pengumuman.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title"><i class="fas fa-pen-to-square text-warning"></i> Edit Pengumuman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Kategori</label>
                                                        <select class="form-control" name="kategori">
                                                            <option value="Umum" {{ $item->kategori == 'Umum' ? 'selected' : '' }}>Umum</option>
                                                            <option value="Layanan" {{ $item->kategori == 'Layanan' ? 'selected' : '' }}>Layanan</option>
                                                            <option value="Kepegawaian" {{ $item->kategori == 'Kepegawaian' ? 'selected' : '' }}>Kepegawaian</option>
                                                            <option value="Penting" {{ $item->kategori == 'Penting' ? 'selected' : '' }}>Penting</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="tanggal" value="{{ $item->tanggal }}" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="isi_pengumuman" rows="5" required>{{ $item->isi }}</textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Update Dokumen Lampiran</label>
                                                        <input type="file" class="form-control" name="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                                        <span class="form-hint">Biarkan kosong jika tidak ingin mengubah lampiran. (Maks 2MB)</span>
                                                    </div>
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="penting" id="editPenting{{ $item->id }}" {{ $item->penting ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bold text-danger" for="editPenting{{ $item->id }}">
                                                                Tandai sebagai Pengumuman Penting (Tampil paling atas)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn-simerah-danger"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@hasanyrole('Operator|Super User') 4 @else 3 @endhasanyrole">
                                <div class="empty-state">
                                    <div class="empty-ico"><i class="fas fa-bullhorn"></i></div>
                                    <h4>Belum Ada Pengumuman</h4>
                                    <p>Tambahkan data pengumuman untuk menampilkan informasi terbaru.</p>
                                    
                                    @hasanyrole('Operator|Super User')
                                    <button type="button" class="btn-simerah-danger" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                        <i class="fas fa-plus"></i> Buat Pengumuman Baru
                                    </button>
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

<!-- MODAL TAMBAH PENGUMUMAN -->
@hasanyrole('Operator|Super User')
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('operator.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">
                        <i class="fas fa-bullhorn text-warning"></i> Tambah Pengumuman Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" placeholder="Contoh: Pemadaman Listrik Area Kantor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" name="kategori">
                                <option value="Umum">Umum</option>
                                <option value="Layanan">Layanan</option>
                                <option value="Kepegawaian">Kepegawaian</option>
                                <option value="Penting">Penting</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="isi_pengumuman" rows="5" placeholder="Ketikkan detail pengumuman di sini..." required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Dokumen Lampiran (Opsional)</label>
                            <input type="file" class="form-control" name="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <span class="form-hint">Format yang diizinkan: PDF, Word, JPG, atau PNG (Maks 2MB).</span>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="penting" id="tambahPenting">
                                <label class="form-check-label fw-bold text-danger" for="tambahPenting">
                                    Tandai sebagai Pengumuman Penting (Tampil paling atas)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger">
                        <i class="fas fa-paper-plane"></i> Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endhasanyrole
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // Handler untuk Toast Notifikasi
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    // Handler untuk Sidebar Mobile
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
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSide();
    });

    // Handler Sidebar Dropdown
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) {
                    if (o !== g) o.open = false;
                });
            }
        });
    });
})();
</script>
@endpush
