@extends('layouts.dashboard')

@section('title', 'Tambah Data Sosialisasi & Edukasi')

@push('styles')
<style>
    .toast-wrap { position: fixed; z-index: 1100; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--steel); font-size: .85rem; font-weight: 600; margin-bottom: 14px; transition: color .2s, transform .2s; text-decoration: none; }
    .back-link:hover { color: var(--navy); transform: translateX(-2px); }
    .form-wrapper { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); padding: clamp(20px, 3vw, 32px); }
    .form-alert { display: flex; gap: 12px; align-items: flex-start; background: var(--signal-soft); border: 1px solid rgba(220,53,69,.25); color: var(--signal-dark); border-radius: var(--r-sm); padding: 14px 16px; margin-bottom: 20px; font-size: .88rem; }
    .form-alert ul { list-style: disc; padding-left: 18px; margin-top: 4px; }
    .section-title { display: flex; align-items: center; gap: 12px; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; margin: 30px 0 16px; }
    .section-title.first { margin-top: 0; }
    .section-title .ico { flex: none; width: 32px; height: 32px; border-radius: 9px; display: grid; place-items: center; font-size: .78rem; color: #fff; background: var(--navy); box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-title .line { flex: 1 1 auto; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .form-label { font-weight: 600; font-size: .8rem; color: var(--steel); margin-bottom: 6px; letter-spacing: .01em; }
    .form-label .req { color: var(--signal); margin-left: 2px; }
    .form-control, .form-select { height: 44px; border: 1px solid var(--line-dark); border-radius: var(--r-sm); padding: 0 14px; font-size: .9rem; color: var(--ink); background-color: #fff; transition: border-color .2s, box-shadow .2s; }
    .form-control[type="file"] { height: auto; padding: 9px 14px; }
    textarea.form-control { height: auto; padding: 10px 14px; line-height: 1.5; resize: vertical; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); outline: none; }
    .form-hint { display: block; margin-top: 6px; font-size: .75rem; color: var(--steel); }
    .upload-card { background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 18px 20px; }
    .form-actions { display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px; margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line); }
    .btn-save, .btn-cancel { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 44px; padding: 0 22px; border-radius: var(--r-sm); font-weight: 700; font-size: .87rem; transition: filter .2s, background .2s, transform .1s, box-shadow .2s; text-decoration: none; }
    .btn-save { background: var(--navy); color: #fff; border: none; }
    .btn-cancel { background: #fff; color: var(--steel); border: 1px solid var(--line-dark); }
</style>
@endpush

@section('content')
    @php
        $defaultJenis = old('jenis_kegiatan', request('jenis') === 'Dalam' ? 'Dalam' : 'Luar');
    @endphp

    <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Sosialisasi &amp; Edukasi
    </a>

    <div class="page-head">
        <h1>Form Sosialisasi &amp; Edukasi</h1>
        <p>Isi data Sosialisasi dan Penyuluhan (ke luar Damkar) atau Kunjungan dan Edukasi (ke Mako Damkar).</p>
    </div>

    @if($errors->any())
        <div class="form-alert" role="alert">
            <i class="fas fa-triangle-exclamation"></i>
            <div>
                <strong>Data belum bisa disimpan. Periksa kembali:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="form-wrapper">
        <form id="formSosialisasi" action="/internal/pencegahan/pemberdayaan-masyarakat/store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-title first">
                <span class="ico"><i class="fas fa-bullhorn"></i></span>
                <span>Informasi Kegiatan</span>
                <span class="line"></span>
            </div>

            <!-- JENIS KEGIATAN -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label d-block">Pilih Kategori Kegiatan <span class="req">*</span></label>
                    <div class="d-flex flex-wrap gap-4 p-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <label class="form-check-label d-flex align-items-center gap-2" style="cursor: pointer;">
                            <input type="radio" name="jenis_kegiatan" id="jenisLuar" value="Luar" class="form-check-input" {{ $defaultJenis !== 'Dalam' ? 'checked' : '' }} style="width:18px;height:18px;cursor:pointer;">
                            <span style="font-size: .95rem;"><strong>Sosialisasi dan Penyuluhan</strong> (Ke Luar Damkar)</span>
                        </label>
                        <label class="form-check-label d-flex align-items-center gap-2" style="cursor: pointer;">
                            <input type="radio" name="jenis_kegiatan" id="jenisDalam" value="Dalam" class="form-check-input" {{ $defaultJenis === 'Dalam' ? 'checked' : '' }} style="width:18px;height:18px;cursor:pointer;">
                            <span style="font-size: .95rem;"><strong>Kunjungan dan Edukasi</strong> (Ke Mako Damkar)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- NO DAN TANGGAL SURAT PERMOHONAN (Khusus Kunjungan dan Edukasi) -->
            <div class="row g-3 mb-3" id="suratPermohonanWrap" style="display: none;">
                <div class="col-12">
                    <label class="form-label" for="no_tanggal_surat_permohonan">No dan Tanggal Surat Permohonan <span class="req">*</span></label>
                    <input type="text" id="no_tanggal_surat_permohonan" name="no_tanggal_surat_permohonan" value="{{ old('no_tanggal_surat_permohonan') }}" class="form-control" placeholder="Contoh: 421.2/015/SDN-12/2026 - 10 Mei 2026" maxlength="255">
                </div>
            </div>

            <!-- NAMA INSTANSI & TEMPAT PELAKSANAAN -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label" id="labelInstansi" for="nama_instansi">Nama Instansi/Lembaga <span class="req">*</span></label>
                    <input type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}" class="form-control" placeholder="Contoh: SMAN 1 Kota Jambi / Kelurahan Pasar" maxlength="255" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="tempat_pelaksanaan">Tempat Pelaksanaan <span class="req">*</span></label>
                    <input type="text" id="tempat_pelaksanaan" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan') }}" class="form-control" placeholder="Contoh: Aula Sekolah / Mako Damkar Kota Jambi" maxlength="255" required>
                </div>
            </div>

            <!-- ALAMAT -->
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label class="form-label" for="alamat">Alamat <span class="req">*</span></label>
                    <textarea id="alamat" name="alamat" rows="2" class="form-control" placeholder="Contoh: Jl. HOS Cokroaminoto No. 113, Kota Jambi" maxlength="500" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- TANGGAL PELAKSANAAN & JUMLAH PESERTA -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="tanggal_pelaksanaan">Tanggal Pelaksanaan <span class="req">*</span></label>
                    <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="jumlah_peserta">Jumlah Peserta <span class="req">*</span></label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" class="form-control" min="0" placeholder="Contoh: 50" required>
                </div>
            </div>

            <!-- PENANGGUNG JAWAB & NO TELFON/WA -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="nama_penanggung_jawab">Nama Penanggung Jawab <span class="req">*</span></label>
                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" value="{{ old('nama_penanggung_jawab') }}" class="form-control" placeholder="Contoh: Budi Santoso" maxlength="255" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="no_telepon">No Telfon/WA Penanggung Jawab <span class="req">*</span></label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" class="form-control" placeholder="Contoh: 08xxxxxxxxxx" maxlength="50" required>
                </div>
            </div>

            <div class="section-title">
                <span class="ico"><i class="fas fa-file-upload"></i></span>
                <span>Dokumen Surat Perintah Tugas (SPT)</span>
                <span class="line"></span>
            </div>

            <div class="upload-card">
                <label class="form-label" for="surat_perintah_tugas">Upload SPT</label>
                <input type="file" id="surat_perintah_tugas" name="surat_perintah_tugas" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                <span class="form-hint">Format: PDF / JPG / PNG (Maks. 5 MB).</span>
            </div>

            <div class="form-actions">
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save" id="btnSave"><i class="fas fa-save"></i> Simpan Data</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var rLuar = document.getElementById('jenisLuar');
    var rDalam = document.getElementById('jenisDalam');
    var suratWrap = document.getElementById('suratPermohonanWrap');
    var inputSurat = document.getElementById('no_tanggal_surat_permohonan');
    var labelInstansi = document.getElementById('labelInstansi');
    var inputInstansi = document.getElementById('nama_instansi');
    var inputTempat = document.getElementById('tempat_pelaksanaan');

    function toggleJenis() {
        if (rDalam && rDalam.checked) {
            suratWrap.style.display = 'flex';
            inputSurat.required = true;
            labelInstansi.innerHTML = 'Nama Instansi/Lembaga (TK/SD/SLTP/SLTA/Perguruan Tinggi) <span class="req">*</span>';
            inputInstansi.placeholder = 'Contoh: TK Pertiwi / SDN 12 Kota Jambi / Universitas Jambi';
            inputTempat.placeholder = 'Contoh: Mako Damkar Kota Jambi';
        } else {
            suratWrap.style.display = 'none';
            inputSurat.required = false;
            labelInstansi.innerHTML = 'Nama Instansi/Lembaga <span class="req">*</span>';
            inputInstansi.placeholder = 'Contoh: SMAN 1 Kota Jambi / Kelurahan Pasar';
            inputTempat.placeholder = 'Contoh: Aula Sekolah / Halaman Kantor';
        }
    }

    if (rLuar) rLuar.addEventListener('change', toggleJenis);
    if (rDalam) rDalam.addEventListener('change', toggleJenis);
    toggleJenis();

    var form = document.getElementById('formSosialisasi');
    var btnSave = document.getElementById('btnSave');
    if (form && btnSave) {
        form.addEventListener('submit', function () {
            btnSave.disabled = true;
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    }
})();
</script>
@endpush
