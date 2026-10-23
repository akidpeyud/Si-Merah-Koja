@extends('layouts.dashboard')

@section('title', 'Edit Inspeksi Bangunan - SIMERAH KOJA')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    * { font-family: 'Plus Jakarta Sans', sans-serif; }

    .page-wrap { max-width: 1100px; margin: 0 auto; }

    .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 16px; padding: 6px 12px; border-radius: 8px; background: #fff; border: 1px solid #e2e8f0; transition: all 0.2s; }
    .back-link:hover { color: #0f172a; background: #f1f5f9; }

    .page-head { margin-bottom: 20px; }
    .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin: 0; }
    .page-sub { font-size: 14px; color: #64748b; margin: 4px 0 0; }

    .form-wrapper { background: #fff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(15,23,42,0.06); overflow: hidden; }
    .form-body { padding: 10px 32px 32px; }
    .form-section { margin-top: 24px; }

    .section-title { display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid #eef2f7; }
    .section-title .icon-box { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; }
    .icon-primary { background: #e0efff; color: #0d6efd; }
    .icon-success { background: #dcfce7; color: #16a34a; }

    .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 6px; }
    .form-control, .form-select { border: 1px solid #cbd5e1; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #334155; background-color: #fff; transition: all 0.2s; }
    .form-control:hover, .form-select:hover { border-color: #94a3b8; }
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2,132,199,0.12); outline: none; }
    .form-control[type="file"] { padding: 9px 14px; background: #fff; }

    /* Select2 */
    .select2-container--bootstrap-5 .select2-selection { font-size: 14px; padding: 6px 14px; min-height: 46px; border: 1px solid #cbd5e1; border-radius: 10px; }
    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2,132,199,0.12); }
    .select2-results__group { font-weight: 800; color: #0f172a; background-color: #f1f5f9; padding: 8px 12px; font-size: 13px; }
    .select2-results__option { font-size: 14px; font-weight: 500; }

    /* Info box */
    .info-box { display: flex; align-items: flex-start; gap: 12px; background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; padding: 12px 16px; border-radius: 10px; font-size: 13px; margin-bottom: 18px; }
    .info-box i { margin-top: 2px; }

    /* Kartu upload */
    .upload-card { height: 100%; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; transition: all 0.2s; }
    .upload-card:hover { border-color: #0284c7; background: #f0f9ff; }
    .upload-card .form-label { display: flex; align-items: center; gap: 8px; }
    .upload-num { width: 24px; height: 24px; border-radius: 50%; background: #0f172a; color: #fff; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .file-saved { display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; padding: 4px 10px; background: #dcfce7; color: #15803d; border-radius: 20px; font-size: 12px; font-weight: 600; word-break: break-all; }

    /* Footer tombol */
    .form-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; }
    .btn-save { background: linear-gradient(135deg, #ffb627, #f59e0b); color: #000; padding: 11px 26px; font-weight: 700; font-size: 14px; border-radius: 10px; border: none; box-shadow: 0 4px 10px rgba(245,158,11,0.3); transition: all 0.2s; }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(245,158,11,0.4); color: #000; }
    .btn-cancel { background: #fff; color: #475569; border: 1px solid #cbd5e1; padding: 11px 26px; font-weight: 600; font-size: 14px; border-radius: 10px; text-decoration: none; transition: all 0.2s; }
    .btn-cancel:hover { background: #f1f5f9; color: #0f172a; }

    @media (max-width: 768px) {
        .form-body { padding: 10px 18px 24px; }
        .form-footer { padding: 16px 18px; }
    }
</style>
@endpush

@section('content')
<div class="page-wrap">

    <a href="javascript:history.back()" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Inspeksi Bangunan
    </a>

    <div class="page-head">
        <h1 class="page-title">Form Edit Inspeksi Bangunan</h1>
        <p class="page-sub">Perbarui informasi bangunan dan dokumen inspeksi di bawah ini.</p>
    </div>

    <div class="form-wrapper">
        <form action="{{ route('inspeksi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">

                <!-- SECTION 1: DATA BANGUNAN -->
                <div class="form-section" style="margin-top: 20px;">
                    <div class="section-title">
                        <span class="icon-box icon-primary"><i class="fas fa-building"></i></span>
                        <span>Informasi Bangunan & Usaha</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Tempat / Bangunan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_tempat" value="{{ $item->nama_tempat ?? '' }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Bangunan / Usaha <span class="text-danger">*</span></label>
                            <select name="jenis_usaha" class="form-select select2-searchable" required>
                                <option value="" disabled>-- Pilih Jenis Bangunan / Usaha --</option>

                                <optgroup label="Sebagai Tempat Tinggal">
                                    <option value="Rumah Tinggal Deret" {{ ($item->jenis_usaha ?? '') == 'Rumah Tinggal Deret' ? 'selected' : '' }}>Rumah Tinggal Deret</option>
                                    <option value="Rumah Tinggal Deret (MBR)" {{ ($item->jenis_usaha ?? '') == 'Rumah Tinggal Deret (MBR)' ? 'selected' : '' }}>Rumah Tinggal Deret (MBR)</option>
                                    <option value="Rumah Tinggal Tunggal" {{ ($item->jenis_usaha ?? '') == 'Rumah Tinggal Tunggal' ? 'selected' : '' }}>Rumah Tinggal Tunggal</option>
                                    <option value="Rumah Tinggal Tunggal (MBR)" {{ ($item->jenis_usaha ?? '') == 'Rumah Tinggal Tunggal (MBR)' ? 'selected' : '' }}>Rumah Tinggal Tunggal (MBR)</option>
                                    <option value="Rumah Susun" {{ ($item->jenis_usaha ?? '') == 'Rumah Susun' ? 'selected' : '' }}>Rumah Susun</option>
                                    <option value="Rumah Susun (MBR)" {{ ($item->jenis_usaha ?? '') == 'Rumah Susun (MBR)' ? 'selected' : '' }}>Rumah Susun (MBR)</option>
                                </optgroup>

                                <optgroup label="Sebagai Tempat Pendidikan, Kebudayaan, dan Kesehatan">
                                    <option value="Bangunan Gedung Pendidikan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Pendidikan' ? 'selected' : '' }}>Bangunan Gedung Pendidikan (SD, SMP, SMA, PT, Terpadu)</option>
                                    <option value="Bangunan Gedung Kebudayaan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Kebudayaan' ? 'selected' : '' }}>Bangunan Gedung Kebudayaan (Museum, Pameran, Kesenian)</option>
                                    <option value="Bangunan Gedung Kesehatan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Kesehatan' ? 'selected' : '' }}>Bangunan Gedung Kesehatan (Puskesmas, Klinik, RS, Lab)</option>
                                    <option value="Bangunan Gedung Pelayanan Umum Lainnya" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Pelayanan Umum Lainnya' ? 'selected' : '' }}>Bangunan Gedung Pelayanan Umum Lainnya</option>
                                </optgroup>

                                <optgroup label="Sebagai Tempat Usaha">
                                    <option value="Bangunan Gedung Perkantoran" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Perkantoran' ? 'selected' : '' }}>Bangunan Gedung Perkantoran</option>
                                    <option value="Bangunan Gedung Perdagangan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Perdagangan' ? 'selected' : '' }}>Bangunan Gedung Perdagangan</option>
                                    <option value="Bangunan Gedung Perindustrian" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Perindustrian' ? 'selected' : '' }}>Bangunan Gedung Perindustrian</option>
                                    <option value="Bangunan Gedung Perhotelan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Perhotelan' ? 'selected' : '' }}>Bangunan Gedung Perhotelan</option>
                                    <option value="Bangunan Wisata dan Rekreasi" {{ ($item->jenis_usaha ?? '') == 'Bangunan Wisata dan Rekreasi' ? 'selected' : '' }}>Bangunan Wisata dan Rekreasi</option>
                                    <option value="Bangunan Gedung Terminal" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Terminal' ? 'selected' : '' }}>Bangunan Gedung Terminal</option>
                                    <option value="Bangunan Gedung Tempat Penyimpanan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Tempat Penyimpanan' ? 'selected' : '' }}>Bangunan Gedung Tempat Penyimpanan</option>
                                    <option value="Bangunan Gedung Peternakan" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Peternakan' ? 'selected' : '' }}>Bangunan Gedung Peternakan</option>
                                    <option value="Bangunan Gedung Laboratorium" {{ ($item->jenis_usaha ?? '') == 'Bangunan Gedung Laboratorium' ? 'selected' : '' }}>Bangunan Gedung Laboratorium (Bukan Faskes/Pendidikan)</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Inspeksi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_inspeksi" value="{{ $item->tanggal_inspeksi ?? '' }}" required>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: DOKUMEN UPLOAD -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="icon-box icon-success"><i class="fas fa-file-upload"></i></span>
                        <span>Upload Ulang Dokumen (Opsional)</span>
                    </div>

                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <span>Biarkan kosong jika tidak ingin mengubah dokumen yang sudah di-upload sebelumnya.</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="upload-card">
                                <label class="form-label"><span class="upload-num">1</span> Surat Perintah Tugas</label>
                                <input class="form-control" type="file" name="surat_perintah_tugas" accept=".pdf,.jpg,.jpeg,.png">
                                @if(!empty($item->surat_perintah_tugas))
                                    <span class="file-saved"><i class="fas fa-check-circle"></i> File tersimpan: {{ $item->surat_perintah_tugas }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="upload-card">
                                <label class="form-label"><span class="upload-num">2</span> Berita Acara</label>
                                <input class="form-control" type="file" name="berita_acara" accept=".pdf,.jpg,.jpeg,.png">
                                @if(!empty($item->berita_acara))
                                    <span class="file-saved"><i class="fas fa-check-circle"></i> File tersimpan: {{ $item->berita_acara }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="upload-card">
                                <label class="form-label"><span class="upload-num">3</span> Hasil Penilaian</label>
                                <input class="form-control" type="file" name="hasil_penilaian" accept=".pdf,.jpg,.jpeg,.png">
                                @if(!empty($item->hasil_penilaian))
                                    <span class="file-saved"><i class="fas fa-check-circle"></i> File tersimpan: {{ $item->hasil_penilaian }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="upload-card">
                                <label class="form-label"><span class="upload-num">4</span> Rekomendasi</label>
                                <input class="form-control" type="file" name="rekomendasi" accept=".pdf,.jpg,.jpeg,.png">
                                @if(!empty($item->rekomendasi))
                                    <span class="file-saved"><i class="fas fa-check-circle"></i> File tersimpan: {{ $item->rekomendasi }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="upload-card">
                                <label class="form-label"><span class="upload-num">5</span> SKK (Sertifikat Keselamatan Kebakaran)</label>
                                <input class="form-control" type="file" name="skk" accept=".pdf,.jpg,.jpeg,.png">
                                @if(!empty($item->skk))
                                    <span class="file-saved"><i class="fas fa-check-circle"></i> File tersimpan: {{ $item->skk }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL UPDATE -->
            <div class="form-footer">
                <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Update Perubahan</button>
            </div>

        </form>
    </div>

</div>

<!-- JQUERY & SELECT2 JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-searchable').select2({
            theme: 'bootstrap-5',
            placeholder: "-- Pilih Jenis Bangunan / Usaha --",
            allowClear: true,
            width: '100%',
            dropdownPosition: 'below'
        });
    });
</script>
@endsection