@extends('layouts.dashboard')

@section('title'){{ $judulKategori ?? 'Produk Hukum' }}@endsection

@push('styles')
<style>
    /* ---------- Topbar, Sidebar & User (selaras DUK) ---------- */
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

    /* ---------- Page head & tombol ---------- */
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

    .btn-tambah { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; background: var(--success); color: #fff; }
    .btn-tambah:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }

    /* ---------- Rekap statistik ---------- */
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-ok      { border-left-color: var(--success); }
    .rekap-ok      .rekap-ico { background: rgba(25, 135, 84, .15); color: var(--success); }
    .rekap-no      { border-left-color: var(--steel); }
    .rekap-no      .rekap-ico { background: rgba(74, 90, 110, .15); color: var(--steel); }

    /* ---------- Card & tabel ---------- */
    .card-container { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .card-container:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }

    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }

    .badge-status { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em; }
    .status-aktif { background: rgba(25, 135, 84, .15); color: var(--success); }
    .status-none  { background: var(--paper); color: var(--steel); }

    /* ---------- Tombol aksi ---------- */
    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }
    .btn-view { background: rgba(25, 135, 84, .15); color: var(--success); }
    .btn-view:hover { background: var(--success); color: #ffffff; }
    .btn-dl { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .btn-dl:hover { background: var(--ink); color: #ffffff; }
    .doc-btns { display: inline-flex; gap: 6px; }
    .doc-btns .btn-action { width: auto; }

    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .content { padding: 26px 16px 50px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .card-container { padding: 14px; }
    }
</style>
@endpush

@section('content')
@php
    $itemsHalaman  = collect($data->items());
    $jmlAdaFile    = $itemsHalaman->filter(function ($i) { return !empty($i->file_dokumen); })->count();
    $jmlTanpaFile  = $itemsHalaman->count() - $jmlAdaFile;
@endphp

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-head">
            <div>
                <h1>{{ $judulKategori }}</h1>
                <p>Manajemen dokumen dan arsip publik {{ strtolower($judulKategori) }} Disdamkartan Kota Jambi.</p>
            </div>

            <!-- Pembatasan akses CRUD Create: Hanya Super User & Operator -->
            <div class="d-flex gap-2 flex-wrap">
                @hasanyrole('Super User|Operator')
                <a href="{{ route('internal.produk-hukum.create', $kategori) }}" class="btn-tambah text-decoration-none">
                    <i class="fas fa-plus me-1"></i> Tambah {{ $judulKategori }}
                </a>
                @endhasanyrole
            </div>
        </div>

        <!-- REKAP GRID STATISTIK -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-scale-balanced"></i></div>
                <div>
                    <div class="rekap-num">{{ $data->total() }}</div>
                    <div class="rekap-label">Total Dokumen</div>
                    <div class="rekap-sub">{{ $judulKategori }}</div>
                </div>
            </div>
            <div class="rekap-item rekap-ok">
                <div class="rekap-ico"><i class="fas fa-file-circle-check"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlAdaFile }}</div>
                    <div class="rekap-label">Berkas Tersedia</div>
                    <div class="rekap-sub">Pada halaman ini</div>
                </div>
            </div>
            <div class="rekap-item rekap-no">
                <div class="rekap-ico"><i class="fas fa-file-circle-xmark"></i></div>
                <div>
                    <div class="rekap-num">{{ $jmlTanpaFile }}</div>
                    <div class="rekap-label">Tanpa Berkas</div>
                    <div class="rekap-sub">Pada halaman ini</div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <!-- Baris Pencarian & Info -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <form action="{{ route('internal.produk-hukum.index', $kategori) }}" method="GET" class="search-wrap">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nomor, tahun, atau judul..." value="{{ request('search') }}">
                </form>

                <div class="text-muted small fw-medium">
                    Total: <strong class="text-dark">{{ $data->total() }}</strong> dokumen
                </div>
            </div>

            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table class="table align-middle border-0 mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="18%">Nomor Peraturan</th>
                            <th class="text-center" width="10%">Tahun</th>
                            <th>Judul / Tentang</th>
                            <th width="20%">Keterangan</th>
                            <th class="text-center" width="18%">Dokumen</th>
                            @hasanyrole('Super User|Operator')
                            <th class="text-center" width="120px">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="text-center fw-bold text-secondary">{{ $data->firstItem() + $index }}</td>
                            <td class="fw-bold">{{ $item->nomor ?: '-' }}</td>
                            <td class="text-center">
                                @if($item->tahun)
                                    <span class="badge badge-navy">{{ $item->tahun }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="fw-semibold" style="min-width: 240px; white-space: normal;">{{ $item->judul }}</td>
                            <td class="text-muted" style="min-width: 180px; white-space: normal;">{{ $item->keterangan ?: '-' }}</td>

                            <!-- Kolom Dokumen: Lihat & Unduh (semua role) -->
                            <td class="text-center" style="white-space: nowrap;">
                                @if($item->file_dokumen)
                                    <div class="doc-btns">
                                        <button type="button"
                                                class="btn-action btn-view btn-preview-pdf"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalPreviewPdf"
                                                data-judul="{{ $item->judul }}"
                                                data-url="{{ route('internal.produk-hukum.view-file', [$kategori, $item->id]) }}?raw=1"
                                                data-download="{{ route('internal.produk-hukum.download-file', [$kategori, $item->id]) }}"
                                                title="Lihat Pratinjau PDF">
                                            <i class="fas fa-eye" style="width: 14px;"></i> Lihat
                                        </button>

                                        <a href="{{ route('internal.produk-hukum.download-file', [$kategori, $item->id]) }}"
                                           class="btn-action btn-dl"
                                           title="Unduh PDF">
                                            <i class="fas fa-download" style="width: 14px;"></i> Unduh
                                        </a>
                                    </div>
                                @else
                                    <span class="badge-status status-none">Tidak ada file</span>
                                @endif
                            </td>

                            <!-- Aksi Edit & Hapus: Hanya Super User & Operator -->
                            @hasanyrole('Super User|Operator')
                            <td>
                                <div class="btn-action-group">
                                    <a href="{{ route('internal.produk-hukum.edit', [$kategori, $item->id]) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>

                                    <form action="{{ route('internal.produk-hukum.destroy', [$kategori, $item->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete w-100" title="Hapus">
                                            <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@hasanyrole('Super User|Operator') 7 @else 6 @endhasanyrole" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open mb-3" style="font-size: 2.5rem; color: var(--steel-soft); opacity: 0.7;"></i><br>
                                    Belum ada data dokumen {{ strtolower($judulKategori) }}.
                                    @hasanyrole('Super User|Operator')
                                    Silakan tambah data baru.
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($data->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

<!-- ==================== MODAL PREVIEW PDF ==================== -->
<div class="modal fade" id="modalPreviewPdf" tabindex="-1" aria-labelledby="modalPreviewPdfLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-truncate pe-3" id="modalPreviewPdfLabel">
                    <i class="fas fa-file-pdf me-2 text-danger"></i><span id="previewJudul">Pratinjau Dokumen</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0">
                <div id="pdfViewerContainer" class="pdf-viewer-body">
                    <div id="pdfLoadingState" class="text-white my-auto text-center py-5">
                        <div class="spinner-border text-light mb-3" role="status"></div>
                        <div>Memuat pratinjau dokumen PDF...</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 d-flex justify-content-between align-items-center">
                <span class="text-muted small" id="pdfPageInfo"></span>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Tutup</button>
                    <a href="#" id="previewDownloadBtn" class="btn-tambah text-decoration-none">
                        <i class="fas fa-download me-1"></i> Unduh PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
(function () {
    'use strict';

    if (window.pdfjsLib) {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

    /* ---------- Render PDF via PDF.js (JSON Base64 Anti-IDM) ---------- */
    var modalPreview = document.getElementById('modalPreviewPdf');
    var viewerContainer = document.getElementById('pdfViewerContainer');
    var previewJudul = document.getElementById('previewJudul');
    var previewDownloadBtn = document.getElementById('previewDownloadBtn');
    var pdfPageInfo = document.getElementById('pdfPageInfo');

    function renderPdfToContainer(url) {
        if (!viewerContainer) return;
        viewerContainer.innerHTML = '<div class="text-white my-auto text-center py-5"><div class="spinner-border text-light mb-3" role="status"></div><div>Memuat pratinjau dokumen PDF...</div></div>';
        if (pdfPageInfo) pdfPageInfo.textContent = '';

        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
            .then(function (res) {
                if (!res.ok) throw new Error('Gagal mengambil dokumen');
                return res.json();
            })
            .then(function (json) {
                var binaryString = window.atob(json.base64);
                var len = binaryString.length;
                var bytes = new Uint8Array(len);
                for (var i = 0; i < len; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }
                return window.pdfjsLib.getDocument({ data: bytes }).promise;
            })
            .then(function (pdf) {
                viewerContainer.innerHTML = '';
                if (pdfPageInfo) pdfPageInfo.textContent = 'Total: ' + pdf.numPages + ' halaman';

                for (var pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    (function (num) {
                        var canvas = document.createElement('canvas');
                        canvas.className = 'pdf-page-canvas';
                        viewerContainer.appendChild(canvas);

                        pdf.getPage(num).then(function (page) {
                            var viewport = page.getViewport({ scale: 1.4 });
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            page.render({
                                canvasContext: context,
                                viewport: viewport
                            });
                        });
                    })(pageNum);
                }
            })
            .catch(function () {
                viewerContainer.innerHTML = '<div class="text-white my-auto text-center py-5"><i class="fas fa-triangle-exclamation fs-2 text-warning mb-2"></i><div>Gagal memuat pratinjau PDF. Silakan gunakan tombol Unduh PDF di bawah.</div></div>';
            });
    }

    document.querySelectorAll('.btn-preview-pdf').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var url = btn.getAttribute('data-url');
            var downloadUrl = btn.getAttribute('data-download');
            var judul = btn.getAttribute('data-judul');

            if (previewJudul) previewJudul.textContent = judul || 'Pratinjau Dokumen';
            if (previewDownloadBtn) previewDownloadBtn.href = downloadUrl;

            renderPdfToContainer(url);
        });
    });

    if (modalPreview) {
        modalPreview.addEventListener('hidden.bs.modal', function () {
            if (viewerContainer) viewerContainer.innerHTML = '';
            if (pdfPageInfo) pdfPageInfo.textContent = '';
        });
    }
})();
</script>
@endpush