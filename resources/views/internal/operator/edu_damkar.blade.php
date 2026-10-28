@extends('layouts.dashboard')

@section('title', 'Kelola Edu Damkar')

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
    .section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }
    .btn-simerah-danger { background: var(--signal); color: #ffffff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220, 53, 69, .22); transition: background .2s, transform .15s, box-shadow .2s; }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #ffffff; transform: translateY(-1px); }
    .btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); transition: background .2s; }
    .btn-simerah-secondary:hover { background: var(--line); }
    .card-box { background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }
    .table-simerah { margin-bottom: 0; }
    .table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
    .table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-simerah tbody tr:last-child td { border-bottom: none; }
    .table-simerah tbody tr:hover { background-color: #f9fbfd; }
    .row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }
    .yt-thumb-link { position: relative; display: block; width: 148px; aspect-ratio: 16 / 9; border-radius: var(--r-sm); overflow: hidden; border: 1px solid var(--line); background: var(--ink); box-shadow: var(--shadow-xs); }
    .yt-thumb-link img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease, opacity .3s ease; }
    .yt-thumb-play { position: absolute; inset: 0; display: grid; place-items: center; background: rgba(13, 27, 42, .35); color: #ffffff; font-size: 1.35rem; opacity: 0; transition: opacity .25s ease; }
    .yt-thumb-link:hover img { transform: scale(1.05); opacity: .88; }
    .yt-thumb-link:hover .yt-thumb-play { opacity: 1; }
    .video-title { font-family: var(--font-display); font-weight: 700; font-size: .98rem; color: var(--ink); margin-bottom: 6px; line-height: 1.35; }
    .video-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
    .yt-watch-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; font-weight: 600; color: var(--signal); padding: 4px 10px; border-radius: 6px; background: var(--signal-soft); transition: background .2s, color .2s; }
    .yt-watch-link:hover { background: var(--signal); color: #ffffff; }
    .yt-id-code { font-size: .76rem; font-weight: 600; color: var(--steel); background: var(--paper); border: 1px solid var(--line); padding: 3px 8px; border-radius: 6px; }
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
    .yt-preview-card { background: var(--paper); border: 1px dashed var(--line-dark); border-radius: var(--r-md); padding: 14px; text-align: center; }
    .yt-preview-card img { width: 100%; max-width: 280px; aspect-ratio: 16 / 9; object-fit: cover; border-radius: var(--r-sm); margin: 0 auto; border: 1px solid var(--line); }
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
                <h1>Kelola Edu Damkar</h1>
                <p>Unggah dan kelola tautan video edukasi pencegahan serta penanganan kebakaran di halaman utama.</p>
            </div>
            
            @hasanyrole('Operator|Super User')
            <button type="button" class="btn-simerah-danger w-mobile-100" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Video Edukasi
            </button>
            @endhasanyrole
        </div>

        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas fa-graduation-cap"></i></span>
            <h3>Daftar Video Edukasi Tayang</h3>
            <span class="line"></span>
            <span class="count-pill">
                <i class="fas fa-film"></i> {{ isset($videos) ? count($videos) : 0 }} Video
            </span>
        </div>

        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-simerah align-middle">
                    <thead>
                        <tr>
                            <th style="width: 6%;">No</th>
                            <th style="width: 22%;">Thumbnail</th>
                            <th style="width: 48%;">Judul Materi Edukasi &amp; Tautan</th>
                            
                            @hasanyrole('Operator|Super User')
                            <th style="width: 24%;" class="text-center">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos ?? [] as $index => $item)
                        <tr>
                            <td><span class="row-num">{{ $index + 1 }}</span></td>
                            <td>
                                <a href="{{ $item->link_asli }}" target="_blank" rel="noopener noreferrer" class="yt-thumb-link" title="Tonton: {{ $item->judul }}">
                                    <img src="https://i.ytimg.com/vi/{{ $item->youtube_id }}/hqdefault.jpg" alt="Thumbnail {{ $item->judul }}" loading="lazy">
                                    <span class="yt-thumb-play"><i class="fas fa-circle-play"></i></span>
                                </a>
                            </td>
                            <td>
                                <div class="video-title">{{ $item->judul }}</div>
                                <div class="video-meta">
                                    <a href="{{ $item->link_asli }}" target="_blank" rel="noopener noreferrer" class="yt-watch-link">
                                        <i class="fab fa-youtube"></i> Tonton di YouTube
                                    </a>
                                    @if(!empty($item->youtube_id))
                                        <span class="yt-id-code"><i class="fas fa-hashtag me-1"></i>{{ $item->youtube_id }}</span>
                                    @endif
                                </div>
                            </td>
                            
                            @hasanyrole('Operator|Super User')
                            <td class="text-center">
                                <div class="action-group">
                                    <button type="button" class="btn-edit-item"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                        <i class="fas fa-pen-to-square"></i> Edit
                                    </button>
                                    <form action="/internal/operator/edu-damkar/hapus/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus video edukasi ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-item">
                                            <i class="fas fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <!-- Modal Edit per Item (Hanya dirender untuk Operator & Super User) -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="/internal/operator/edu-damkar/update/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title"><i class="fas fa-pen-to-square text-warning"></i> Edit Video Edu Damkar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div class="mb-3">
                                                    <label class="form-label">Link Video YouTube <span class="text-danger">*</span></label>
                                                    <input type="url" class="form-control" name="link" value="{{ $item->link_asli }}" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label">Judul Materi Edukasi <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
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
                                    <div class="empty-ico"><i class="fas fa-graduation-cap"></i></div>
                                    <h4>Belum Ada Video Edu Damkar</h4>
                                    <p>Tambahkan tautan video edukasi dari YouTube (seperti cara penggunaan APAR, langkah evakuasi, dll) agar tampil di halaman utama.</p>
                                    
                                    @hasanyrole('Operator|Super User')
                                    <button type="button" class="btn-simerah-danger" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                        <i class="fas fa-plus"></i> Tambah Video Edukasi Pertama
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

<!-- MODAL TAMBAH VIDEO EDUKASI (Hanya Dirender untuk Operator & Super User) -->
@hasanyrole('Operator|Super User')
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/internal/operator/edu-damkar/store" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">
                        <i class="fas fa-graduation-cap text-warning"></i> Tambah Video Edu Damkar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="ytLinkInput" class="form-label">Link Video YouTube <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="link" id="ytLinkInput" placeholder="https://www.youtube.com/watch?v=..." required>
                        <span class="form-hint">Mendukung tautan YouTube standar, tautan bagikan (`youtu.be`), maupun YouTube Shorts.</span>
                    </div>

                    <div class="mb-3 d-none yt-preview-card" id="ytPreviewBox">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1" style="font-size: .74rem;">
                                <i class="fas fa-circle-check me-1"></i>ID Video Terdeteksi: <strong id="ytDetectedId">-</strong>
                            </span>
                        </div>
                        <img src="" id="ytPreviewImg" alt="Preview Thumbnail YouTube">
                    </div>

                    <div class="mb-1">
                        <label for="judulVideoInput" class="form-label">Judul Materi Edukasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul" id="judulVideoInput" placeholder="Contoh: Cara Memakai APAR dengan Benar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-simerah-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger">
                        <i class="fas fa-floppy-disk"></i> Simpan Video
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

    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 4500);
    });

    var ytInput      = document.getElementById('ytLinkInput');
    var ytBox        = document.getElementById('ytPreviewBox');
    var ytImg        = document.getElementById('ytPreviewImg');
    var ytDetectedId = document.getElementById('ytDetectedId');

    if (ytInput) {
        ytInput.addEventListener('input', function () {
            var val = ytInput.value.trim();
            var match = val.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
            if (match && match[1]) {
                ytImg.src = 'https://i.ytimg.com/vi/' + match[1] + '/hqdefault.jpg';
                if (ytDetectedId) ytDetectedId.textContent = match[1];
                ytBox.classList.remove('d-none');
            } else {
                ytBox.classList.add('d-none');
                ytImg.src = '';
            }
        });
    }
})();
</script>
@endpush