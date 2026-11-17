@hasanyrole('Pencegahan|Super User')
@php
    $importModul = $modul ?? 'inspeksi-bangunan';
    $importJudul = $judul ?? 'Data Pencegahan';
    $isPilihDiklat = !empty($pilihDiklat);
    $defaultDiklat = $defaultDiklat ?? 'diksar';
    $templateModul = $isPilihDiklat ? $defaultDiklat : $importModul;
@endphp

<div class="modal fade" id="modalImportPencegahan" tabindex="-1" aria-labelledby="modalImportPencegahanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <form action="{{ route('pencegahan.import', ['modul' => $importModul]) }}" method="POST" enctype="multipart/form-data" id="formImportPencegahan">
                @csrf
                <div class="modal-header" style="background: #0f172a; color: #fff; padding: 16px 22px;">
                    <h5 class="modal-title fs-6 fw-bold mb-0 d-flex align-items-center gap-2" id="modalImportPencegahanLabel">
                        <i class="fas fa-file-import text-info"></i>
                        <span>Impor Excel — {{ $importJudul }}</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    @if($isPilihDiklat)
                    <div class="mb-3">
                        <label class="form-label fw-semibold small" for="selectJenisDiklatImport">Pilih Jenis Diklat Tujuan <span class="text-danger">*</span></label>
                        <select name="jenis_diklat" id="selectJenisDiklatImport" class="form-select" required>
                            <option value="diksar" {{ $defaultDiklat === 'diksar' ? 'selected' : '' }}>DIKSAR</option>
                            <option value="diklat-f1" {{ $defaultDiklat === 'diklat-f1' ? 'selected' : '' }}>DIKLAT F1 (Pemadam I)</option>
                            <option value="diklat-f2" {{ $defaultDiklat === 'diklat-f2' ? 'selected' : '' }}>DIKLAT F2 (Pemadam II)</option>
                            <option value="diklat-rescue" {{ $defaultDiklat === 'diklat-rescue' ? 'selected' : '' }}>DIKLAT RESCUE</option>
                            <option value="diklat-mfr" {{ $defaultDiklat === 'diklat-mfr' ? 'selected' : '' }}>DIKLAT MFR</option>
                            <option value="diklat-operator" {{ $defaultDiklat === 'diklat-operator' ? 'selected' : '' }}>DIKLAT OPERATOR</option>
                            <option value="diklat-inspektur" {{ $defaultDiklat === 'diklat-inspektur' ? 'selected' : '' }}>DIKLAT INSPEKTUR</option>
                            <option value="diklat-ppl" {{ $defaultDiklat === 'diklat-ppl' ? 'selected' : '' }}>DIKLAT PPL</option>
                        </select>
                    </div>
                    @endif

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 mb-3 rounded-3" style="background: #f0f9ff; border: 1px solid #bae6fd;">
                        <div class="small" style="color: #0369a1;">
                            <i class="fas fa-circle-info me-1"></i>
                            Belum punya format? Unduh template Excel khusus halaman ini:
                        </div>
                        <a href="{{ route('pencegahan.import.template', ['modul' => $templateModul]) }}"
                           id="btnDownloadTemplateImport"
                           class="btn btn-sm btn-outline-primary fw-bold"
                           style="border-radius: 8px; white-space: nowrap;">
                            <i class="fas fa-download me-1"></i> Unduh Template (.xlsx)
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small" for="inputFileExcelImport">Pilih File Excel / CSV <span class="text-danger">*</span></label>
                        <input type="file" name="file_excel" id="inputFileExcelImport" class="form-control" accept=".xlsx,.xls,.csv" required>
                        <div class="form-text small text-muted">Format yang didukung: <code>.xlsx</code>, <code>.xls</code>, <code>.csv</code> (Maks. 10 MB).</div>
                    </div>

                    <div class="alert alert-light border small py-2 px-3 mb-0 text-muted">
                        <i class="fas fa-wand-magic-sparkles text-primary me-1"></i>
                        Baris kosong otomatis dilewati, format tanggal Excel &amp; Indonesia dikenali otomatis, dan kolom turunan (seperti tahun / satuan <strong>m²</strong>) terisi otomatis.
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary px-4 fw-bold" id="btnSubmitImportPencegahan">
                        <i class="fas fa-upload me-1"></i> Mulai Impor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    var sel = document.getElementById('selectJenisDiklatImport');
    var btnTpl = document.getElementById('btnDownloadTemplateImport');
    var form = document.getElementById('formImportPencegahan');
    var btnSubmit = document.getElementById('btnSubmitImportPencegahan');

    if (sel && btnTpl) {
        var baseTpl = @json(url('/internal/pencegahan/import-template'));
        sel.addEventListener('change', function () {
            btnTpl.href = baseTpl + '/' + encodeURIComponent(sel.value);
        });
    }

    if (form && btnSubmit) {
        form.addEventListener('submit', function () {
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengimpor...';
        });
    }
})();
</script>
@endhasanyrole
