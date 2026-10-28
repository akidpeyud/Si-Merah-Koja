@extends('layouts.dashboard')

@section('title', 'Tambah Data Pegawai')

@push('styles')
<style>
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 90; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg); }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
    }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 25px;}
    .form-container { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 35px; box-shadow: var(--shadow-xs); }
    .section-title { 
                display: flex; align-items: center; gap: 10px;
                font-size: 1.05rem; font-weight: 700; font-family: var(--font-display); color: var(--ink); 
                border-bottom: 1px solid var(--line); padding-bottom: 14px; margin-bottom: 20px; margin-top: 35px; 
            }
    .section-title::before {
                content: ""; width: 4px; height: 18px;
                background: var(--navy); border-radius: 4px;
            }
    .section-title:first-child { margin-top: 0; }
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select { 
                min-height: 44px; font-size: .92rem; border: 1px solid var(--line-dark); border-radius: 8px; color: var(--ink); box-shadow: none; transition: all .2s ease; 
            }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::placeholder { color: var(--steel-soft); }
    .input-group-text { background: var(--paper); border-color: var(--line-dark); color: var(--steel); font-size: .92rem; font-weight: 600;}
    .btn-primary-custom { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s ease; }
    .btn-primary-custom:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-secondary-custom { display: inline-flex; align-items: center; justify-content: center; min-height: 44px; padding: 0 24px; background: var(--paper); color: var(--ink); border: 1px solid var(--line); border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s ease; }
    .btn-secondary-custom:hover { background: #e2e8f0; }
</style>
@endpush

@section('content')

        <a href="{{ route('kepegawaian.duk.index') }}" class="btn btn-sm btn-outline-secondary mb-3 px-3" style="border-radius: 8px; font-weight: 600;">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke DUK
        </a>

        <div class="page-head">
            <h1>Tambah Data Pegawai Baru</h1>
            <p>Silakan lengkapi form Daftar Urut Kepangkatan (DUK) di bawah ini.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4" style="border-radius: 12px; border: 1px solid rgba(220, 53, 69, .2); background: var(--signal-soft); color: var(--signal-dark);">
                <div class="fw-bold mb-2"><i class="fas fa-exclamation-circle me-2"></i> Terdapat kesalahan pada input Anda:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('kepegawaian.duk.store') }}" method="POST">
                @csrf
                
                <!-- 1. DATA PRIBADI -->
                <div class="section-title">
                    <i class="fas fa-id-card text-muted"></i> Data Pribadi
                </div>
                <div class="row g-4">
                    <div class="col-md-2">
                        <label class="form-label">No. Urut DUK <span class="text-danger">*</span></label>
                        <input type="number" name="no_urut" class="form-control @error('no_urut') is-invalid @enderror" value="{{ old('no_urut') }}" required placeholder="Cth: 1">
                        @error('no_urut')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" required maxlength="20" placeholder="18-20 Digit NIP">
                        @error('nip')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="text-muted" style="font-size: .75rem;">Maksimal 20 digit angka.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap (Beserta Gelar) <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required placeholder="Cth: Ir. Soekarno, M.Sc.">
                        @error('nama')
                            <div class="invalid-feedback fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <!-- DIPISAH MENJADI TEMPAT LAHIR & TANGGAL LAHIR -->
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" placeholder="Cth: Jambi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status Pegawai</label>
                        <select name="status_pegawai" class="form-select">
                            <option value="Aktif" {{ old('status_pegawai') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Cuti" {{ old('status_pegawai') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="Pensiun" {{ old('status_pegawai') == 'Pensiun' ? 'selected' : '' }}>Pensiun</option>
                            <option value="Pindah" {{ old('status_pegawai') == 'Pindah' ? 'selected' : '' }}>Pindah Instansi</option>
                        </select>
                    </div>
                </div>

                <!-- 2. KEPANGKATAN & JABATAN -->
                <div class="section-title">
                    <i class="fas fa-medal text-muted"></i> Kepangkatan & Jabatan
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Pangkat / Golongan Ruang</label>
                        <input type="text" name="pangkat_gol_ruang" class="form-control" value="{{ old('pangkat_gol_ruang') }}" placeholder="Cth: Penata Tk. I / III/d">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">TMT Pangkat</label>
                        <input type="date" name="pangkat_tmt" class="form-control" value="{{ old('pangkat_tmt') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Jabatan</label>
                        <input type="text" name="jabatan_nama" class="form-control" value="{{ old('jabatan_nama') }}" placeholder="Cth: Kepala Bidang Pencegahan">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">TMT Jabatan</label>
                        <input type="date" name="jabatan_tmt" class="form-control" value="{{ old('jabatan_tmt') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Masa Kerja (Tahun)</label>
                        <div class="input-group">
                            <input type="number" name="masa_kerja_th" class="form-control" value="{{ old('masa_kerja_th') }}"  min="0" placeholder="0">
                            <span class="input-group-text border-start-0">Thn</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Masa Kerja (Bulan)</label>
                        <div class="input-group">
                            <input type="number" name="masa_kerja_bln" class="form-control" value="{{ old('masa_kerja_bln') }}"  min="0" placeholder="0">
                            <span class="input-group-text border-start-0">Bln</span>
                        </div>
                    </div>
                </div>

                <!-- 3. PENDIDIKAN -->
                <div class="section-title">
                    <i class="fas fa-graduation-cap text-muted"></i> Pendidikan Formal
                </div>
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label">Tingkat Ijazah</label>
                        <select name="pendidikan_tingkat_ijazah" class="form-select">
                            <option value="">Pilih...</option>
                            <option value="SMA/SMK" {{ old('pendidikan_tingkat_ijazah') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ old('pendidikan_tingkat_ijazah') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4/S1" {{ old('pendidikan_tingkat_ijazah') == 'D4/S1' ? 'selected' : '' }}>D4 / S1</option>
                            <option value="S2" {{ old('pendidikan_tingkat_ijazah') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan_tingkat_ijazah') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Jurusan / Pendidikan</label>
                        <input type="text" name="pendidikan_nama" class="form-control" value="{{ old('pendidikan_nama') }}" placeholder="Cth: Ilmu Pemerintahan">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="text" name="pendidikan_tahun_lulus" class="form-control" value="{{ old('pendidikan_tahun_lulus') }}" placeholder="Cth: 2012">
                    </div>
                </div>

                <!-- 4. DIKLAT / LATIHAN JABATAN -->
                <div class="section-title">
                    <i class="fas fa-chalkboard-user text-muted"></i> Diklat / Latihan Jabatan
                </div>
                <div class="row g-4">
                    <div class="col-md-5">
                        <label class="form-label">Nama Latihan Jabatan</label>
                        <input type="text" name="latihan_jabatan_nama" class="form-control" value="{{ old('latihan_jabatan_nama') }}" placeholder="Cth: Diklat PIM III">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="text" name="latihan_jabatan_tahun_lulus" class="form-control" value="{{ old('latihan_jabatan_tahun_lulus') }}" placeholder="Cth: 2015">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Tempat Latihan</label>
                        <input type="text" name="latihan_jabatan_tempat" class="form-control" value="{{ old('latihan_jabatan_tempat') }}" placeholder="Cth: BPSDM Provinsi Jambi">
                    </div>
                </div>

                <!-- 5. CATATAN TAMBAHAN -->
                <div class="section-title">
                    <i class="fas fa-clipboard-list text-muted"></i> Lain-lain
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <label class="form-label">Catatan Mutasi Pegawai</label>
                        <textarea name="catatan_mutasi_pegawai" class="form-control" rows="4" placeholder="Tuliskan riwayat mutasi atau catatan tambahan di sini...">{{ old('catatan_mutasi_pegawai') }}</textarea>
                    </div>
                </div>

                <hr class="my-4" style="border-color: var(--line);">
                
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('kepegawaian.duk.index') }}" class="btn-secondary-custom">Batal</a>
                    
                    <!-- TOMBOL SUBMIT HANYA UNTUK SEKRETARIAT DAN SUPER USER -->
                    @hasanyrole('Sekretariat|Super User')
                    <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Simpan Data</button>
                    @endhasanyrole

                </div>
            </form>
        </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Validasi Input NIP Hanya Angka & Maks 18 Digit ---------- */
    const nipInput = document.querySelector('input[name="nip"]');
    if (nipInput) {
        nipInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 18) {
                this.value = this.value.slice(0, 18);
            }
        });
    }

    
})();
</script>
@endpush
