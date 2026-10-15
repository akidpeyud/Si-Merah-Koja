@extends('layouts.dashboard')

@section('title'){{ $judulKategori ?? 'Profil Instansi' }}@endsection

@push('styles')
<style>
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
</style>
@endpush

@section('content')
@section('content')

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

        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div class="page-head mb-0">
                <h1>{{ $judulKategori }}</h1>
                <p>Manajemen dokumen dan informasi publik {{ strtolower($judulKategori) }} Disdamkartan Kota Jambi.</p>
            </div>
            
            <!-- Pembatasan akses CRUD Create: Hanya Super User & Operator -->
            @hasanyrole('Super User|Operator')
            <a href="{{ route('internal.profil-instansi.create', $kategori) }}" class="btn-tambah text-decoration-none">
                <i class="fas fa-plus me-1"></i> Tambah {{ $judulKategori }}
            </a>
            @endhasanyrole
        </div>

        <div class="card-container">
            <!-- Baris Pencarian & Info -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <form action="{{ route('internal.profil-instansi.index', $kategori) }}" method="GET" class="search-wrap">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul, tahun, atau keterangan..." value="{{ request('search') }}">
                </form>

                <div class="text-muted small fw-medium">
                    Total: <strong class="text-dark">{{ $data->total() }}</strong> dokumen
                </div>
            </div>

            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Judul / Nama Dokumen</th>
                            <th class="text-center" width="12%">Tahun</th>
                            <th width="28%">Keterangan / Ringkasan</th>
                            <th class="text-center" width="18%">Dokumen</th>
                            @hasanyrole('Super User|Operator')
                            <th class="text-center" width="10%">Aksi</th>
                            @endhasanyrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="text-center fw-bold text-secondary">{{ $data->firstItem() + $index }}</td>
                            <td class="fw-semibold" style="min-width: 240px; white-space: normal;">{{ $item->judul }}</td>
                            <td class="text-center">
                                @if($item->tahun)
                                    <span class="badge badge-navy">{{ $item->tahun }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-muted" style="min-width: 200px; white-space: normal;">{{ $item->keterangan ?: '-' }}</td>
                            
                            <!-- Kolom Dokumen: Tombol Lihat & Unduh Seragam (Semua Role Bisa Mengakses) -->
                            <td class="text-center" style="white-space: nowrap;">
                                @if($item->file_dokumen)
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <!-- Tombol Lihat (Buka Modal Pratinjau PDF tanpa terdownload) -->
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-success btn-preview-pdf d-inline-flex align-items-center gap-1" 
                                                style="border-radius: 6px; font-weight: 600;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalPreviewPdf"
                                                data-judul="{{ $item->judul }}"
                                                data-url="{{ route('internal.profil-instansi.view-file', [$kategori, $item->id]) }}?raw=1"
                                                data-download="{{ route('internal.profil-instansi.download-file', [$kategori, $item->id]) }}"
                                                title="Lihat Pratinjau PDF">
                                            <i class="fas fa-eye"></i> <span>Lihat</span>
                                        </button>

                                        <!-- Tombol Unduh PDF -->
                                        <a href="{{ route('internal.profil-instansi.download-file', [$kategori, $item->id]) }}" 
                                           class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1" 
                                           style="border-radius: 6px; font-weight: 600;"
                                           title="Unduh PDF">
                                            <i class="fas fa-download"></i> <span>Unduh</span>
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted small">Tidak ada file</span>
                                @endif
                            </td>
                            
                            <!-- Pembatasan Aksi Edit & Hapus: Hanya Super User & Operator -->
                            @hasanyrole('Super User|Operator')
                            <td class="text-center" style="white-space: nowrap;">
                                <a href="{{ route('internal.profil-instansi.edit', [$kategori, $item->id]) }}" 
                                   class="btn btn-sm btn-outline-primary" 
                                   style="border-radius: 6px;" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('internal.profil-instansi.destroy', [$kategori, $item->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;" title="Hapus" onclick="return confirm('Yakin ingin menghapus data {{ addslashes($item->judul) }}?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            @endhasanyrole
                        </tr>
                        @empty
                        <tr>
                            <td colspan="@hasanyrole('Super User|Operator') 6 @else 5 @endhasanyrole" class="text-center py-5">
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

<!-- ==================== MODAL PREVIEW PDF (RENDER CANVAS ANTI AUTO-DOWNLOAD) ==================== -->
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
