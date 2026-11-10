@extends('layouts.dashboard')

@section('title', 'Edit Data Perjanjian Kerjasama (PKS) - SIMERAH KOJA')

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
    .icon-primary { background: #ecfdf5; color: #059669; }
    .icon-success { background: #dcfce7; color: #16a34a; }

    .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 6px; }
    .form-control { border: 1px solid #cbd5e1; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #334155; background-color: #fff; transition: all 0.2s; }
    .form-control:hover { border-color: #94a3b8; }
    .form-control:focus { border-color: #059669; box-shadow: 0 0 0 4px rgba(5,150,105,0.12); outline: none; }
    .form-control[type="file"] { padding: 9px 14px; background: #fff; }

    .upload-card { background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; transition: all 0.2s; }
    .upload-card:hover { border-color: #059669; background: #f0fdf4; }
    .upload-card .form-label { display: flex; align-items: center; gap: 8px; }
    .upload-num { width: 24px; height: 24px; border-radius: 50%; background: #065f46; color: #fff; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .file-saved { display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; padding: 4px 10px; background: #dcfce7; color: #15803d; border-radius: 20px; font-size: 12px; font-weight: 600; word-break: break-all; text-decoration: none; }
    .file-saved:hover { color: #166534; text-decoration: underline; }

    .form-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; }
    .btn-save { background: linear-gradient(135deg, #10b981, #059669); color: #fff; padding: 11px 26px; font-weight: 700; font-size: 14px; border-radius: 10px; border: none; box-shadow: 0 4px 10px rgba(5,150,105,0.3); transition: all 0.2s; }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(5,150,105,0.4); color: #fff; }
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

    <a href="{{ url('/internal/pencegahan/inspeksi-kebakaran/pks') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data PKS
    </a>

    <div class="page-head">
        <h1 class="page-title">Form Edit Data Perjanjian Kerjasama (PKS)</h1>
        <p class="page-sub">Perbarui informasi perjanjian kerjasama perusahaan dengan Dinas Damkartan Kota Jambi.</p>
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
        <form action="{{ route('pks.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">

                <!-- BAGIAN 1: INFORMASI KERJASAMA -->
                <div class="form-section" style="margin-top: 20px;">
                    <div class="section-title">
                        <span class="icon-box icon-primary"><i class="fas fa-handshake"></i></span>
                        <span>Informasi Perjanjian Kerjasama</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_perusahaan" value="{{ old('nama_perusahaan', $item->nama_perusahaan) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nomor PKS <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nomor_pks" value="{{ old('nomor_pks', $item->nomor_pks) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Perjanjian</label>
                            <input type="date" class="form-control" name="tanggal_perjanjian" value="{{ old('tanggal_perjanjian', optional($item->tanggal_perjanjian)->format('Y-m-d')) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lama Kerjasama</label>
                            <input type="text" class="form-control" name="lama_kerjasama" value="{{ old('lama_kerjasama', $item->lama_kerjasama) }}" placeholder="Contoh: 1 Tahun, 2 Tahun">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pihak Pertama</label>
                            <input type="text" class="form-control" name="pihak_pertama" value="{{ old('pihak_pertama', $item->pihak_pertama) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pihak Kedua</label>
                            <input type="text" class="form-control" name="pihak_kedua" value="{{ old('pihak_kedua', $item->pihak_kedua) }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Keterangan / Catatan Tambahan</label>
                            <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $item->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: UPLOAD DOKUMEN PKS -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="icon-box icon-success"><i class="fas fa-file-upload"></i></span>
                        <span>Upload Dokumen PKS</span>
                    </div>

                    <div class="upload-card">
                        <label class="form-label"><span class="upload-num">1</span> Ganti Dokumen PKS (Opsional)</label>
                        <input class="form-control" type="file" name="file_dokumen" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted d-block mt-1" style="font-size: 12px;">Kosongkan jika tidak ingin mengubah file dokumen (Maks. 10 MB)</small>
                        @if (!empty($item->file_dokumen))
                            <a href="/uploads/pks/{{ $item->file_dokumen }}" target="_blank" class="file-saved">
                                <i class="fas fa-file-pdf"></i> Dokumen tersimpan: {{ $item->file_dokumen }}
                            </a>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form-footer">
                <a href="{{ url('/internal/pencegahan/inspeksi-kebakaran/pks') }}" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i> Perbarui Data PKS
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
