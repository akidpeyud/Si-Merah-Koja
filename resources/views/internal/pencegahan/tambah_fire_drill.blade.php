@extends('layouts.dashboard')

@section('title', 'Tambah Data Fire Drill - SIMERAH KOJA')

@push('styles')
<style>
    .form-wrapper {
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 30px;
        margin-top: 20px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    .back-link {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
        transition: color .2s;
    }
    .back-link:hover { color: #0f172a; }
    .form-label {
        font-weight: 600;
        font-size: 13px;
        color: #475569;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 14px;
        color: #334155;
    }
    .form-control:focus {
        border-color: #163a63;
        box-shadow: 0 0 0 3px rgba(22, 58, 99, 0.12);
    }
    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 15px;
        margin-top: 28px;
        padding-bottom: 8px;
        border-bottom: 1px dashed #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-title.first { margin-top: 0; }
    .hint-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #0d6efd;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 13px;
        color: #475569;
        margin-bottom: 16px;
    }
    .badge-counter {
        background: #e0f2fe;
        color: #0369a1;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
    }
    .btn-save {
        background-color: #0d6efd;
        color: white;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        border: none;
        transition: filter .2s;
    }
    .btn-save:hover { filter: brightness(1.08); color: #fff; }
    .btn-cancel {
        background-color: white;
        color: #475569;
        border: 1px solid #cbd5e1;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        text-decoration: none;
    }
    .btn-cancel:hover { background-color: #f1f5f9; color: #0f172a; }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">
    <a href="{{ url('/internal/pencegahan/inspeksi-kebakaran/fire-drill') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Fire Drill
    </a>

    <h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Form Tambah Data Fire Drill</h1>

    <div class="form-wrapper">
        <form action="{{ route('fire_drill.store') }}" method="POST">
            @csrf

            <!-- BAGIAN 1: INFORMASI INSTANSI & PELAKSANAAN -->
            <div class="section-title text-primary first">
                <i class="fas fa-fire-extinguisher"></i> Informasi Pelaksanaan Fire Drill
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Instansi</label>
                    <input type="text" class="form-control" name="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Contoh: PT. PLN UPT Jambi" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" class="form-control" name="tahun" value="{{ old('tahun', date('Y')) }}" min="2000" max="2099" placeholder="Contoh: 2026" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tanggal Pelaksanaan</label>
                    <input type="text" class="form-control" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" placeholder="Contoh: 3 & 4 Februari 2026" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Tempat Pelaksanaan</label>
                    <input type="text" class="form-control" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan') }}" placeholder="Contoh: Aula PLN UPT Jambi" required>
                </div>
            </div>

            <!-- BAGIAN 2: DAFTAR NAMA & JUMLAH PESERTA -->
            <div class="section-title text-success">
                <i class="fas fa-users"></i> Daftar Nama &amp; Jumlah Peserta
            </div>

            <div class="hint-box">
                <i class="fas fa-circle-info text-primary me-1"></i>
                <strong>Tips Input Rapi:</strong> Ketik <strong>1 nama peserta per baris (tekan Enter)</strong> pada kotak di bawah. Jumlah peserta Laki-laki, Perempuan, dan Total akan <strong>terhitung otomatis</strong>. Jika data arsip lama (seperti 2023/2024) tidak memiliki daftar nama, kosongkan saja kotak nama dan isi angkanya secara manual.
            </div>

            <!-- Input Daftar Nama Laki-laki -->
<div class="col-md-6">
    <label class="form-label">
        <span><i class="fas fa-mars text-primary me-1"></i> Daftar Nama Peserta Laki-laki <small class="text-muted fw-normal">(Opsional)</small></span>
        <span class="badge-counter" id="badgeLaki">0 Nama</span>
    </label>
    <textarea class="form-control" name="nama_peserta_laki_laki" id="inputNamaLaki" rows="6" placeholder="Ketik satu nama peserta per baris (tekan Enter untuk baris baru)...">{{ old('nama_peserta_laki_laki') }}</textarea>
</div>

<!-- Input Daftar Nama Perempuan -->
<div class="col-md-6">
    <label class="form-label">
        <span><i class="fas fa-venus text-danger me-1"></i> Daftar Nama Peserta Perempuan <small class="text-muted fw-normal">(Opsional)</small></span>
        <span class="badge-counter" id="badgePerempuan">0 Nama</span>
    </label>
    <textarea class="form-control" name="nama_peserta_perempuan" id="inputNamaPerempuan" rows="6" placeholder="Ketik satu nama peserta per baris (tekan Enter untuk baris baru)...">{{ old('nama_peserta_perempuan') }}</textarea>
</div>

<!-- Angka Jumlah Laki-laki, Perempuan, dan Total -->
                <div class="col-md-4">
                    <label class="form-label">Jumlah Peserta Laki-laki</label>
                    <input type="number" class="form-control" name="peserta_laki_laki" id="jmlLaki" value="{{ old('peserta_laki_laki', 0) }}" min="0">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jumlah Peserta Perempuan</label>
                    <input type="number" class="form-control" name="peserta_perempuan" id="jmlPerempuan" value="{{ old('peserta_perempuan', 0) }}" min="0">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Total Peserta <small class="text-muted fw-normal">(Otomatis / Arsip)</small></label>
                    <input type="number" class="form-control fw-bold" name="total_peserta" id="jmlTotal" value="{{ old('total_peserta', 0) }}" min="0" required>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
                <a href="{{ url('/internal/pencegahan/inspeksi-kebakaran/fire-drill') }}" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i> Simpan Data Fire Drill
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var txtLaki = document.getElementById('inputNamaLaki');
    var txtPerempuan = document.getElementById('inputNamaPerempuan');
    var jmlLaki = document.getElementById('jmlLaki');
    var jmlPerempuan = document.getElementById('jmlPerempuan');
    var jmlTotal = document.getElementById('jmlTotal');
    var badgeLaki = document.getElementById('badgeLaki');
    var badgePerempuan = document.getElementById('badgePerempuan');

    function hitungBarisNama(teks) {
        if (!teks || !teks.trim()) return 0;
        return teks.split(/\r\n|\r|\n/).filter(function (baris) {
            return baris.trim().length > 0;
        }).length;
    }

    function sinkronkanDariTextarea() {
        var cLaki = hitungBarisNama(txtLaki.value);
        var cPerempuan = hitungBarisNama(txtPerempuan.value);

        badgeLaki.textContent = cLaki + ' Nama';
        badgePerempuan.textContent = cPerempuan + ' Nama';

        if (cLaki > 0) jmlLaki.value = cLaki;
        if (cPerempuan > 0) jmlPerempuan.value = cPerempuan;

        hitungTotal();
    }

    function hitungTotal() {
        var l = parseInt(jmlLaki.value, 10) || 0;
        var p = parseInt(jmlPerempuan.value, 10) || 0;
        if (l > 0 || p > 0) {
            jmlTotal.value = l + p;
        }
    }

    if (txtLaki) txtLaki.addEventListener('input', sinkronkanDariTextarea);
    if (txtPerempuan) txtPerempuan.addEventListener('input', sinkronkanDariTextarea);
    if (jmlLaki) jmlLaki.addEventListener('input', hitungTotal);
    if (jmlPerempuan) jmlPerempuan.addEventListener('input', hitungTotal);
})();
</script>
@endpush