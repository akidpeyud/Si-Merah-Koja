@extends('layouts.dashboard')

@section('title', 'Kelola Background Beranda')

@push('styles')
<style>
    .page-head { margin-bottom: 24px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .btn-simerah-danger {
        background: var(--signal); color: #ffffff; font-weight: 600; font-size: .9rem;
        border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex;
        align-items: center; justify-content: center; gap: 9px; border: none;
        box-shadow: 0 4px 12px rgba(220, 53, 69, .22); transition: background .2s, transform .15s;
    }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #ffffff; transform: translateY(-1px); }
    .info-compress-banner {
        display: flex; align-items: center; gap: 14px;
        background: #f0f7ff; border: 1px solid #bfdbfe; color: #1e3a8a;
        border-radius: var(--r-md); padding: 14px 18px; margin-bottom: 22px; font-size: .88rem;
    }
    .info-compress-banner i { font-size: 1.25rem; color: #2563eb; flex: none; }
    .card-box {
        background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line);
        box-shadow: var(--shadow-xs); padding: 24px; overflow: hidden;
    }
    .table thead th {
        font-family: var(--font-display); font-size: .78rem; text-transform: uppercase;
        letter-spacing: .04em; font-weight: 700; color: var(--steel);
        background-color: var(--paper); border-bottom: 1px solid var(--line); padding: 14px 16px;
    }
    .table tbody td { padding: 14px 16px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .bg-thumb-wrap {
        position: relative; width: 170px; aspect-ratio: 16 / 9;
        border-radius: 10px; overflow: hidden; border: 1px solid var(--line);
        background: var(--ink); cursor: pointer; box-shadow: var(--shadow-xs);
    }
    .bg-thumb-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .25s ease; }
    .bg-thumb-wrap:hover img { transform: scale(1.05); }
    .bg-thumb-zoom {
        position: absolute; inset: 0; background: rgba(13, 27, 42, .42);
        color: #fff; display: grid; place-items: center; opacity: 0; transition: opacity .2s;
    }
    .bg-thumb-wrap:hover .bg-thumb-zoom { opacity: 1; }
    .slide-badge {
        display: inline-flex; align-items: center; gap: 6px; padding: 5px 11px;
        border-radius: 8px; background: var(--navy-light); color: var(--navy);
        font-weight: 700; font-size: .8rem;
    }
    .size-pill {
        display: inline-flex; align-items: center; gap: 5px; padding: 3px 9px;
        border-radius: 6px; background: var(--paper); border: 1px solid var(--line);
        color: var(--steel); font-size: .76rem; font-weight: 600;
    }
    .status-pill {
        display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px;
        border-radius: 999px; font-size: .76rem; font-weight: 700;
    }
    .status-pill.on { background: #dcfce7; color: #166534; }
    .status-pill.off { background: #f1f5f9; color: #64748b; }
    .modal-content { border-radius: var(--r-lg); border: 1px solid var(--line); box-shadow: var(--shadow-lg); overflow: hidden; }
    .modal-header { background: var(--ink); color: #ffffff; border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: #ffffff; }
    .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); opacity: .75; }
    .modal-body { padding: 24px; }
    .modal-footer { background: #f8fafc; border-top: 1px solid var(--line); padding: 14px 24px; }
    .form-label { font-size: .84rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
    @media (max-width: 700px) {
        .btn-simerah-danger.w-mobile-100 { width: 100%; }
        .bg-thumb-wrap { width: 120px; }
    }
</style>
@endpush

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
    <div class="page-head m-0">
        <h1>Kelola Background Beranda</h1>
        <p>Ganti atau tambahkan foto background utama (Hero) yang tampil pada halaman depan publik SIMERAH KOJA.</p>
    </div>

    @hasanyrole('Operator|Super User')
    <button class="btn-simerah-danger w-mobile-100" data-bs-toggle="modal" data-bs-target="#modalTambahBg">
        <i class="fas fa-plus"></i> Tambah Background Baru
    </button>
    @endhasanyrole
</div>

<div class="info-compress-banner">
    <i class="fas fa-bolt"></i>
    <div>
        <strong>Auto-Kompresi Aktif:</strong> Foto berukuran besar (hingga 8 MB) yang Anda unggah akan otomatis diperkecil ke resolusi ideal (maksimal lebar <code>1600px</code>) dan dikompres menjadi <strong>~150–250 KB</strong> agar beranda publik tetap ringan di semua perangkat.
    </div>
</div>

<div class="card-box">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 11%;">Urutan Slide</th>
                    <th style="width: 24%;">Preview Background</th>
                    <th style="width: 33%;">Judul / Informasi File</th>
                    <th style="width: 14%;" class="text-center">Status di Beranda</th>
                    @hasanyrole('Operator|Super User')
                    <th style="width: 18%;" class="text-center">Aksi</th>
                    @endhasanyrole
                </tr>
            </thead>
            <tbody>
                @forelse($backgrounds as $bg)
                    @php
                        $fullPath = public_path($bg->path_gambar);
                        $exists = file_exists($fullPath);
                        $sizeKb = $exists ? round(filesize($fullPath) / 1024, 1) : 0;
                        $dims = $exists ? @getimagesize($fullPath) : null;
                        $dimText = $dims ? ($dims[0] . '×' . $dims[1] . ' px') : '-';
                    @endphp
                    <tr>
                        <td>
                            <span class="slide-badge">
                                <i class="fas fa-images"></i> Slide #{{ $bg->urutan }}
                            </span>
                        </td>
                        <td>
                            @if($exists)
                                <div class="bg-thumb-wrap js-preview-bg"
                                     data-src="{{ asset($bg->path_gambar) }}"
                                     data-title="{{ $bg->judul ?? 'Background Beranda' }}">
                                    <img src="{{ asset($bg->path_gambar) }}" alt="{{ $bg->judul }}" loading="lazy" decoding="async">
                                    <div class="bg-thumb-zoom"><i class="fas fa-magnifying-glass-plus"></i></div>
                                </div>
                            @else
                                <span class="text-muted small"><i class="fas fa-triangle-exclamation text-warning"></i> File tidak ditemukan</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark mb-1">{{ $bg->judul ?: 'Tanpa Judul' }}</div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <span class="size-pill"><i class="fas fa-weight-hanging"></i> {{ $sizeKb }} KB</span>
                                <span class="size-pill"><i class="fas fa-expand"></i> {{ $dimText }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($bg->is_active)
                                <span class="status-pill on"><i class="fas fa-circle-check"></i> Aktif</span>
                            @else
                                <span class="status-pill off"><i class="fas fa-eye-slash"></i> Nonaktif</span>
                            @endif
                        </td>
                        @hasanyrole('Operator|Super User')
                        <td class="text-center">
                            <div class="d-inline-flex flex-wrap justify-content-center gap-1">
                                <button type="button"
                                        class="btn btn-outline-primary btn-sm fw-bold js-edit-bg"
                                        data-id="{{ $bg->id }}"
                                        data-judul="{{ $bg->judul }}"
                                        data-urutan="{{ $bg->urutan }}"
                                        data-active="{{ $bg->is_active ? '1' : '0' }}"
                                        data-src="{{ asset($bg->path_gambar) }}"
                                        title="Ganti Foto / Edit">
                                    <i class="fas fa-pen-to-square"></i> Ganti / Edit
                                </button>

                                <form action="/internal/operator/background-beranda/toggle/{{ $bg->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold" title="{{ $bg->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fas {{ $bg->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>

                                <form action="/internal/operator/background-beranda/hapus/{{ $bg->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus background ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm fw-bold" title="Hapus">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endhasanyrole
                    </tr>
                @empty
                    <tr>
                        <td colspan="@hasanyrole('Operator|Super User') 5 @else 4 @endhasanyrole" class="text-center text-muted py-4">
                            Belum ada data background beranda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Preview Gambar -->
<div class="modal fade" id="modalPreviewBg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-6" id="previewBgTitle">Preview Background</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-2 bg-dark text-center">
                <img id="previewBgImg" src="" alt="Preview" style="max-width: 100%; max-height: 72vh; border-radius: 8px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

@hasanyrole('Operator|Super User')
<!-- Modal Tambah Background -->
<div class="modal fade" id="modalTambahBg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/internal/operator/background-beranda/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fs-6"><i class="fas fa-circle-plus me-2 text-danger"></i>Tambah Background Beranda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul / Keterangan Background</label>
                        <input type="text" class="form-control" name="judul" placeholder="Contoh: Apel Pasukan Damkar Kota Jambi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil (Slide Ke-)</label>
                        <input type="number" class="form-control" name="urutan" value="{{ count($backgrounds) + 1 }}" min="1" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Pilih Foto Background <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png,.webp" required>
                        <small class="text-muted d-block mt-1">
                            <i class="fas fa-wand-magic-sparkles me-1 text-primary"></i>Format: JPG, PNG, WEBP (Maks 8 MB). Otomatis dikompres oleh sistem agar ringan.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger btn-sm">Unggah &amp; Kompres</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit / Ganti Foto Background (1 Modal Dinamis untuk Semua Baris) -->
<div class="modal fade" id="modalEditBg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditBg" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fs-6"><i class="fas fa-pen-to-square me-2 text-warning"></i>Ganti / Edit Background Beranda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <img id="editBgCurrentImg" src="" alt="Current Background" style="width: 100%; max-height: 160px; object-fit: cover; border-radius: 10px; border: 1px solid var(--line);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul / Keterangan Background</label>
                        <input type="text" class="form-control" name="judul" id="editBgJudul" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Urutan Slide</label>
                            <input type="number" class="form-control" name="urutan" id="editBgUrutan" min="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Status Tampil</label>
                            <select class="form-select form-control" name="is_active" id="editBgActive">
                                <option value="1">Aktif di Beranda</option>
                                <option value="0">Nonaktif (Sembunyikan)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Ganti File Foto Background <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted d-block mt-1">
                            Biarkan kosong jika hanya ingin mengubah judul, urutan, atau status. Jika memilih foto baru, foto otomatis dikompres.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simerah-danger btn-sm">Simpan Perubahan</button>
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

    // Preview Modal
    var previewModalEl = document.getElementById('modalPreviewBg');
    var previewImg = document.getElementById('previewBgImg');
    var previewTitle = document.getElementById('previewBgTitle');

    document.querySelectorAll('.js-preview-bg').forEach(function (el) {
        el.addEventListener('click', function () {
            if (!previewModalEl || !previewImg) return;
            previewImg.src = el.getAttribute('data-src') || '';
            if (previewTitle) previewTitle.textContent = el.getAttribute('data-title') || 'Preview Background';
            bootstrap.Modal.getOrCreateInstance(previewModalEl).show();
        });
    });

    // Reusable Edit Modal
    var editModalEl = document.getElementById('modalEditBg');
    var formEditBg = document.getElementById('formEditBg');
    var editBgCurrentImg = document.getElementById('editBgCurrentImg');
    var editBgJudul = document.getElementById('editBgJudul');
    var editBgUrutan = document.getElementById('editBgUrutan');
    var editBgActive = document.getElementById('editBgActive');

    document.querySelectorAll('.js-edit-bg').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (!editModalEl || !formEditBg) return;
            var id = btn.getAttribute('data-id');
            formEditBg.action = '/internal/operator/background-beranda/update/' + id;
            if (editBgCurrentImg) editBgCurrentImg.src = btn.getAttribute('data-src') || '';
            if (editBgJudul) editBgJudul.value = btn.getAttribute('data-judul') || '';
            if (editBgUrutan) editBgUrutan.value = btn.getAttribute('data-urutan') || '1';
            if (editBgActive) editBgActive.value = btn.getAttribute('data-active') || '1';
            bootstrap.Modal.getOrCreateInstance(editModalEl).show();
        });
    });
})();
</script>
@endpush
