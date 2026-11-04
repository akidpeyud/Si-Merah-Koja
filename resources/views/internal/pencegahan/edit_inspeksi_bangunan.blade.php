@extends('layouts.dashboard')

@section('title', 'Edit Inspeksi Bangunan - SIMERAH KOJA')

@push('styles')
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

    /* Info box */
    .info-box { display: flex; align-items: flex-start; gap: 12px; background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; padding: 12px 16px; border-radius: 10px; font-size: 13px; margin-bottom: 18px; }
    .info-box i { margin-top: 2px; }

    /* Kartu upload */
    .upload-card { height: 100%; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; transition: all 0.2s; }
    .upload-card:hover { border-color: #0284c7; background: #f0f9ff; }
    .upload-card .form-label { display: flex; align-items: center; gap: 8px; }
    .upload-num { width: 24px; height: 24px; border-radius: 50%; background: #0f172a; color: #fff; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .file-saved { display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; padding: 4px 10px; background: #dcfce7; color: #15803d; border-radius: 20px; font-size: 12px; font-weight: 600; word-break: break-all; text-decoration: none; }
    .file-saved:hover { color: #166534; text-decoration: underline; }

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

    <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Inspeksi Bangunan
    </a>

    <div class="page-head">
        <h1 class="page-title">Form Edit Inspeksi Bangunan</h1>
        <p class="page-sub">Perbarui informasi pemeriksaan bangunan dan dokumen inspeksi di bawah ini.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-3">
            <strong>Periksa kembali isian form:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-wrapper">
        <form action="{{ route('inspeksi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">

                <!-- SECTION 1: DATA BANGUNAN & PEMERIKSAAN -->
                <div class="form-section" style="margin-top: 20px;">
                    <div class="section-title">
                        <span class="icon-box icon-primary"><i class="fas fa-building"></i></span>
                        <span>Informasi Bangunan &amp; Pemeriksaan</span>
                    </div>

                    @php
                        $valKualifikasi = old('kualifikasi_bangunan', $item->kualifikasi_bangunan ?? '');
                        $valResiko = old('resiko_kebakaran', $item->resiko_kebakaran ?? '');
                        $valProteksi = old('sistem_proteksi_kebakaran', $item->sistem_proteksi_kebakaran ?? '');
                    @endphp

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Bangunan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_tempat" value="{{ old('nama_tempat', $item->nama_tempat ?? '') }}" placeholder="Contoh: Mall WTC" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Bangunan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="jenis_usaha" value="{{ old('jenis_usaha', $item->jenis_usaha ?? '') }}" placeholder="Contoh: Mall" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kualifikasi Bangunan <span class="text-danger">*</span></label>
                            <select name="kualifikasi_bangunan" class="form-select" required>
                                <option value="" disabled {{ $valKualifikasi ? '' : 'selected' }}>-- Pilih Kualifikasi --</option>
                                <option value="Rendah" {{ $valKualifikasi === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ $valKualifikasi === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ $valKualifikasi === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Resiko Kebakaran <span class="text-danger">*</span></label>
                            <select name="resiko_kebakaran" class="form-select" required>
                                <option value="" disabled {{ $valResiko ? '' : 'selected' }}>-- Pilih Resiko --</option>
                                <option value="Rendah" {{ $valResiko === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ $valResiko === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ $valResiko === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Luas Bangunan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="luas_bangunan" value="{{ old('luas_bangunan', $item->luas_bangunan ?? '') }}" placeholder="Contoh: 1.700 m2" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $item->alamat ?? '') }}" placeholder="Contoh: Kec Pasar" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_penanggung_jawab" value="{{ old('nama_penanggung_jawab', $item->nama_penanggung_jawab ?? '') }}" placeholder="Contoh: Dian" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No Telfon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon', $item->no_telepon ?? '') }}" placeholder="Contoh: 08xxxxxxxxxx" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sistem Proteksi Kebakaran <span class="text-danger">*</span></label>
                            <select name="sistem_proteksi_kebakaran" class="form-select" required>
                                <option value="" disabled {{ $valProteksi ? '' : 'selected' }}>-- Pilih Status Sistem Proteksi --</option>
                                <option value="Memenuhi Syarat" {{ $valProteksi === 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat</option>
                                <option value="Memenuhi Syarat dengan Catatan" {{ $valProteksi === 'Memenuhi Syarat dengan Catatan' ? 'selected' : '' }}>Memenuhi Syarat dengan Catatan</option>
                                <option value="Tidak Memenuhi Syarat" {{ $valProteksi === 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_inspeksi" value="{{ old('tanggal_inspeksi', $item->tanggal_inspeksi ?? '') }}" required>
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
                                <label class="form-label"><span class="upload-num">1</span> Upload SPT (Surat Perintah Tugas)</label>
                                <input class="form-control" type="file" name="surat_perintah_tugas" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted d-block mt-1" style="font-size: 12px;">Format: PDF / JPG / PNG (Maks. 5 MB)</small>
                                @if(!empty($item->surat_perintah_tugas))
                                    <a href="/uploads/inspeksi/{{ $item->surat_perintah_tugas }}" target="_blank" class="file-saved">
                                        <i class="fas fa-check-circle"></i> File tersimpan: {{ $item->surat_perintah_tugas }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="upload-card">
                                <label class="form-label"><span class="upload-num">2</span> Upload Rekomendasi</label>
                                <input class="form-control" type="file" name="rekomendasi" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted d-block mt-1" style="font-size: 12px;">Format: PDF / JPG / PNG (Maks. 5 MB)</small>
                                @if(!empty($item->rekomendasi))
                                    <a href="/uploads/inspeksi/{{ $item->rekomendasi }}" target="_blank" class="file-saved">
                                        <i class="fas fa-check-circle"></i> File tersimpan: {{ $item->rekomendasi }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL UPDATE -->
            <div class="form-footer">
                <a href="/internal/pencegahan/inspeksi-kebakaran/bangunan" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Update Perubahan</button>
            </div>

        </form>
    </div>

</div>
@endsection
