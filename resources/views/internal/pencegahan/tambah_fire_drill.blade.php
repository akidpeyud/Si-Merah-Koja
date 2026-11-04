@extends('layouts.dashboard')

@section('title', 'Tambah Data Fire Drill - SIMERAH KOJA')

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
    .form-control { border: 1px solid #cbd5e1; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #334155; background-color: #fff; transition: all 0.2s; }
    .form-control:hover { border-color: #94a3b8; }
    .form-control:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2,132,199,0.12); outline: none; }
    .form-control[type="file"] { padding: 9px 14px; background: #fff; }

    .upload-card { background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 16px; transition: all 0.2s; }
    .upload-card:hover { border-color: #0284c7; background: #f0f9ff; }
    .upload-card .form-label { display: flex; align-items: center; gap: 8px; }
    .upload-num { width: 24px; height: 24px; border-radius: 50%; background: #0f172a; color: #fff; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }

    .form-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; }
    .btn-save { background-color: #0d6efd; color: #fff; padding: 11px 26px; font-weight: 700; font-size: 14px; border-radius: 10px; border: none; transition: all 0.2s; }
    .btn-save:hover { background-color: #0b5ed7; color: #fff; }
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

    <a href="{{ url('/internal/pencegahan/inspeksi-kebakaran/fire-drill') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Fire Drill
    </a>

    <div class="page-head">
        <h1 class="page-title">Form Tambah Data Fire Drill</h1>
        <p class="page-sub">Lengkapi data pelaksanaan pelatihan pemadam kebakaran (Fire Drill) di bawah ini.</p>
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
        <form action="{{ route('fire_drill.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-body">

                <!-- BAGIAN 1: INFORMASI PELAKSANAAN FIRE DRILL -->
                <div class="form-section" style="margin-top: 20px;">
                    <div class="section-title">
                        <span class="icon-box icon-primary"><i class="fas fa-fire-extinguisher"></i></span>
                        <span>Informasi Pelaksanaan Fire Drill</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Instansi/Lembaga <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Contoh: PT. PLN UPT Jambi" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" placeholder="Contoh: 3 &amp; 4 Februari 2026" required>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Tempat Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan') }}" placeholder="Contoh: Aula PLN UPT Jambi" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Jumlah Peserta <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="total_peserta" value="{{ old('total_peserta') }}" min="0" placeholder="Contoh: 35" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_penanggung_jawab" value="{{ old('nama_penanggung_jawab') }}" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No Telfon/WA Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Contoh: 08xxxxxxxxxx" required>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: UPLOAD SPT -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="icon-box icon-success"><i class="fas fa-file-upload"></i></span>
                        <span>Upload Dokumen SPT</span>
                    </div>

                    <div class="upload-card">
                        <label class="form-label"><span class="upload-num">1</span> Upload SPT (Surat Perintah Tugas)</label>
                        <input class="form-control" type="file" name="surat_perintah_tugas" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted d-block mt-1" style="font-size: 12px;">Format: PDF / JPG / PNG (Maks. 5 MB)</small>
                    </div>
                </div>

            </div>

            <div class="form-footer">
                <a href="{{ url('/internal/pencegahan/inspeksi-kebakaran/fire-drill') }}" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i> Simpan Data Fire Drill
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
