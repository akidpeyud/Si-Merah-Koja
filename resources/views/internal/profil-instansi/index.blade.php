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

        @if($kategori === 'tupoksi')
            <!-- ==================== KARTU GAMBARAN BESAR TUPOKSI ==================== -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden; background: #ffffff;">
                <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-image text-danger"></i> Gambaran Besar Visual {{ $judulKategori }}
                        </h5>
                        <p class="text-muted small mb-0">Infografis / banner visual yang tampil secara besar di halaman publik sebelum daftar dokumen PDF.</p>
                    </div>
                    @hasanyrole('Super User|Operator')
                    <button type="button" class="btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#modalGantiGambaranBesar">
                        <i class="fas fa-camera"></i> Ganti Gambaran Besar
                    </button>
                    @endhasanyrole
                </div>
                <div class="card-body p-4 text-center bg-light">
                    @if($gambaranBesar)
                        <div class="mx-auto" style="max-width: 820px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); background: #ffffff;">
                            <img src="{{ $gambaranBesar['url'] }}?v={{ $gambaranBesar['updated_at'] }}" alt="Gambaran Besar {{ $judulKategori }}" class="img-fluid w-100" style="display: block; max-height: 460px; object-fit: contain;">
                        </div>
                        <div class="mt-3 text-muted small d-flex justify-content-center align-items-center gap-3 flex-wrap">
                            <span><i class="fas fa-check-circle text-success me-1"></i> Tampil Aktif di Halaman Publik</span>
                            <span>&bull;</span>
                            <span><i class="fas fa-clock text-secondary me-1"></i> Terakhir diperbarui: {{ date('d M Y H:i', $gambaranBesar['updated_at']) }} WIB</span>
                        </div>
                    @else
                        <div class="py-4 text-muted">
                            <i class="fas fa-image fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-2 fw-medium">Belum ada gambaran besar yang diunggah.</p>
                            @hasanyrole('Super User|Operator')
                            <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalGantiGambaranBesar">
                                <i class="fas fa-upload me-1"></i> Unggah Gambaran Besar Sekarang
                            </button>
                            @endhasanyrole
                        </div>
                    @endif
                </div>
            </div>
        @endif

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

@if($kategori === 'tupoksi')
@hasanyrole('Super User|Operator')
<!-- ==================== MODAL GANTI GAMBARAN BESAR TUPOKSI ==================== -->
<div class="modal fade" id="modalGantiGambaranBesar" tabindex="-1" aria-labelledby="modalGantiGambaranBesarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; overflow: hidden;">
            <form action="{{ route('internal.profil-instansi.update-gambaran-besar', $kategori) }}" method="POST" enctype="multipart/form-data" id="formGantiGambaranBesar">
                @csrf
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="modalGantiGambaranBesarLabel">
                        <i class="fas fa-image me-2 text-danger"></i>Ganti Gambaran Besar {{ $judulKategori }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="inputGambarTupoksi" class="form-label fw-semibold">Pilih File Gambar Baru (JPG, JPEG, PNG, WEBP) <span class="text-danger">*</span></label>
                        <input type="file" name="gambar" id="inputGambarTupoksi" class="form-control" accept="image/jpeg,image/png,image/webp,.jpg,.jpeg,.png,.webp" required>
                        <input type="hidden" name="gambar_base64" id="inputGambarTupoksiBase64">
                        <input type="hidden" name="gambar_name" id="inputGambarTupoksiName">
                        <small class="text-muted d-block mt-1">Format: <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.webp</b> (maksimal 10MB).</small>
                    </div>

                    <!-- Area Pratinjau Gambar Baru Sebelum Simpan -->
                    <div id="previewAreaGambaranBesar" class="p-3 bg-light border rounded-3 text-center" style="display: none;">
                        <p class="small fw-semibold text-muted mb-2">Pratinjau Gambar yang Dipilih:</p>
                        <img id="imgPreviewGambaranBesar" src="#" alt="Pratinjau" class="img-fluid rounded border" style="max-height: 320px; object-fit: contain;">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 fw-semibold" id="btnSubmitGambaranBesar" style="border-radius: 8px;">
                        <i class="fas fa-cloud-arrow-up me-1"></i> Simpan &amp; Terapkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endhasanyrole
@endif
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
                if (json.mime && json.mime.indexOf('image/') === 0) {
                    viewerContainer.innerHTML = '';
                    if (pdfPageInfo) pdfPageInfo.textContent = 'Format: Gambar (' + (json.ext || '').toUpperCase() + ')';
                    var img = document.createElement('img');
                    img.src = 'data:' + json.mime + ';base64,' + json.base64;
                    img.alt = json.judul || 'Pratinjau Gambar';
                    img.className = 'pdf-page-canvas';
                    viewerContainer.appendChild(img);
                    return null;
                }

                var binaryString = window.atob(json.base64);
                var len = binaryString.length;
                var bytes = new Uint8Array(len);
                for (var i = 0; i < len; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }
                return window.pdfjsLib.getDocument({ data: bytes }).promise;
            })
            .then(function (pdf) {
                if (!pdf) return;
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

    /* ---------- Pratinjau & Fallback Base64 Ganti Gambaran Besar ---------- */
    var inputGambar = document.getElementById('inputGambarTupoksi');
    var inputGambarBase64 = document.getElementById('inputGambarTupoksiBase64');
    var inputGambarName = document.getElementById('inputGambarTupoksiName');
    var previewArea = document.getElementById('previewAreaGambaranBesar');
    var imgPreview = document.getElementById('imgPreviewGambaranBesar');
    var formGambaran = document.getElementById('formGantiGambaranBesar');

    if (inputGambar && inputGambarBase64 && inputGambarName) {
        inputGambar.addEventListener('change', function () {
            var file = inputGambar.files && inputGambar.files[0];
            if (!file) {
                inputGambarBase64.value = '';
                inputGambarName.value = '';
                if (previewArea) previewArea.style.display = 'none';
                return;
            }

            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 10MB.');
                inputGambar.value = '';
                inputGambarBase64.value = '';
                inputGambarName.value = '';
                if (previewArea) previewArea.style.display = 'none';
                return;
            }

            inputGambarName.value = file.name;
            var reader = new FileReader();
            reader.onload = function (e) {
                inputGambarBase64.value = e.target.result;
                if (imgPreview && previewArea) {
                    imgPreview.src = e.target.result;
                    previewArea.style.display = 'block';
                }
            };
            reader.readAsDataURL(file);
        });

        if (formGambaran) {
            formGambaran.addEventListener('submit', function () {
                if (inputGambarBase64.value) {
                    inputGambar.removeAttribute('name');
                }
            });
        }
    }
})();
</script>
@endpush
