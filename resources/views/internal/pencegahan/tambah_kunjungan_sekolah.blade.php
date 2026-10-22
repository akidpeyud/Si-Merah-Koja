@extends('layouts.dashboard')
@section('title', 'Tambah Kunjungan Sekolah')

@push('styles')
<style>
    .form-wrapper { background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 30px; margin-top: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 15px; }
    .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 8px; }
    .form-control { border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 15px; font-size: 14px; }
    .section-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 15px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 8px; }
    .btn-save { background-color: #0d6efd; color: white; padding: 10px 24px; font-weight: 600; border-radius: 6px; border: none; }
    .btn-cancel { background-color: white; color: #475569; border: 1px solid #cbd5e1; padding: 10px 24px; font-weight: 600; border-radius: 6px; text-decoration: none; }
</style>
@endpush

@section('content')
<a href="{{ route('kunjungan_sekolah.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
<h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Tambah Kunjungan Sekolah</h1>

<div class="form-wrapper">
    <form action="{{ route('kunjungan_sekolah.store') }}" method="POST">
        @csrf
        <div class="section-title text-primary"><i class="fas fa-school"></i> Informasi Kunjungan</div>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_sekolah" placeholder="Contoh: TK ISLAM MUSLIMAT" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tanggal_kunjungan" placeholder="Contoh: 14 dan 15 Januari 2026" required>
            </div>
        </div>

        <div class="section-title text-success"><i class="fas fa-users"></i> Banyak Kunjungan (Peserta)</div>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Siswa Perempuan</label>
                <input type="number" class="form-control" name="siswa_perempuan" value="0" min="0" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Siswa Laki-laki</label>
                <input type="number" class="form-control" name="siswa_laki_laki" value="0" min="0" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Guru Pendamping</label>
                <input type="number" class="form-control" name="guru" value="0" min="0" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Orang Tua / Wali</label>
                <input type="number" class="form-control" name="orang_tua" value="0" min="0" required>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <a href="{{ route('kunjungan_sekolah.index') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Simpan Data</button>
        </div>
    </form>
</div>
@endsection