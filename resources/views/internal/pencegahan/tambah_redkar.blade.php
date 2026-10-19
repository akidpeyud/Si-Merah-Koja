@extends('layouts.dashboard')

@section('title', 'Tambah Data Relawan REDKAR')

@push('styles')
<style>
    /* =========================================================
       FORM REDKAR — Rata Kiri, Responsif & Animasi Masuk
       ========================================================= */
    .rkf {
        --rk-ink: var(--ink, #0d1b2a);
        --rk-navy: var(--navy, #1b365d);
        --rk-steel: var(--steel, #4a5a6e);
        --rk-muted: var(--steel-soft, #7b8a9c);
        --rk-line: var(--line, #e4e9f0);
        --rk-paper: var(--paper, #f6f8fb);
        --rk-red: var(--signal, #e5383b);
        --rk-red-soft: var(--signal-soft, #fdeaea);
        --rk-green: var(--success, #10b981);
        --rk-green-soft: #e3f7ef;
        --rk-blue-soft: var(--info-soft, #e6eefd);
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding-bottom: 40px;
    }

    /* ---------- Animasi Muncul dari Bawah ---------- */
    @keyframes rkfSlideUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .rkf-hero {
        animation: rkfSlideUp .5s cubic-bezier(.16, 1, .3, 1) both;
    }

    .rkf-sec {
        animation: rkfSlideUp .6s cubic-bezier(.16, 1, .3, 1) both;
        background: #fff; border: 1px solid var(--rk-line);
        border-radius: 20px; padding: 24px 26px 26px; margin-bottom: 16px;
    }

    /* Efek jeda (stagger) agar seksi form muncul berurutan dari atas ke bawah secara elegan */
    .rkf-sec:nth-of-type(1) { animation-delay: .1s; }
    .rkf-sec:nth-of-type(2) { animation-delay: .15s; }
    .rkf-sec:nth-of-type(3) { animation-delay: .2s; }
    .rkf-sec:nth-of-type(4) { animation-delay: .25s; }
    .rkf-sec:nth-of-type(5) { animation-delay: .3s; }

    .rkf-bar {
        animation: rkfSlideUp .6s cubic-bezier(.16, 1, .3, 1) .35s both;
        position: sticky; bottom: 14px; z-index: 5;
        display: flex; justify-content: flex-end; gap: 10px; flex-wrap: wrap;
        padding: 12px; margin-top: 4px;
        background: rgba(255, 255, 255, .92); backdrop-filter: blur(8px);
        border: 1px solid var(--rk-line); border-radius: 18px;
        box-shadow: 0 10px 30px rgba(13, 27, 42, .12);
    }

    /* ---------- Header ---------- */
    .rkf-hero {
        position: relative; overflow: hidden;
        display: flex; align-items: flex-end; justify-content: space-between;
        gap: 16px; flex-wrap: wrap;
        padding: 26px 30px; margin-bottom: 20px;
        border-radius: 20px; color: #fff;
        background:
            radial-gradient(480px 200px at 100% 0%, rgba(229, 56, 59, .36), transparent 70%),
            linear-gradient(120deg, var(--rk-ink) 0%, var(--rk-navy) 100%);
    }
    .rkf-hero::after {
        content: ""; position: absolute; right: -40px; bottom: -70px;
        width: 200px; height: 200px; border-radius: 50%;
        border: 26px solid rgba(255, 255, 255, .05); pointer-events: none;
    }
    .rkf-hero > * { position: relative; z-index: 1; }
    .rkf-back {
        display: inline-flex; align-items: center; gap: 8px;
        margin-bottom: 12px; padding: 5px 12px; border-radius: 999px;
        background: rgba(255, 255, 255, .12); color: #fff;
        font-size: .8rem; font-weight: 600; text-decoration: none;
        transition: background .2s;
    }
    .rkf-back:hover { background: rgba(255, 255, 255, .22); color: #fff; }
    .rkf-back:focus-visible { outline: 3px solid rgba(255, 255, 255, .6); outline-offset: 2px; }
    .rkf-hero h1 {
        font-family: var(--font-display, inherit); font-weight: 700;
        letter-spacing: -.02em; line-height: 1.2;
        font-size: clamp(1.4rem, 2.6vw, 1.85rem); margin: 0 0 6px;
    }
    .rkf-hero p { margin: 0; color: rgba(255, 255, 255, .72); font-size: .93rem; max-width: 52ch; }

    /* ---------- Alert error ---------- */
    .rkf-alert {
        display: flex; gap: 14px; align-items: flex-start;
        padding: 16px 18px; margin-bottom: 20px;
        background: var(--rk-red-soft); border: 1px solid #f6c4c5;
        border-left: 4px solid var(--rk-red); border-radius: 14px; color: #7a1d1f;
    }
    .rkf-alert > i { margin-top: 3px; color: var(--rk-red); }
    .rkf-alert strong { display: block; margin-bottom: 4px; }
    .rkf-alert ul { margin: 0; padding-left: 18px; font-size: .9rem; }
    .rkf-alert .btn-close { margin-left: auto; }

    /* ---------- Seksi Head ---------- */
    .rkf-sec-head { display: flex; align-items: center; gap: 14px; margin-bottom: 20px; }
    .rkf-sec-num {
        flex: none; width: 40px; height: 40px; border-radius: 12px;
        display: grid; place-items: center;
        background: var(--rk-blue-soft); color: var(--rk-navy); font-size: .95rem;
    }
    .rkf-sec-head h2 {
        font-family: var(--font-display, inherit); font-size: 1.08rem; font-weight: 700;
        color: var(--rk-ink); margin: 0; line-height: 1.25;
    }
    .rkf-sec-head p { margin: 2px 0 0; font-size: .82rem; color: var(--rk-muted); }

    /* ---------- Input ---------- */
    .rkf .form-label { font-size: .84rem; font-weight: 600; color: var(--rk-ink); margin-bottom: 6px; }
    .rkf .form-control, .rkf .form-select {
        font-size: .94rem; padding: 11px 14px; border-radius: 12px;
        border: 1px solid var(--rk-line); background-color: var(--rk-paper); color: var(--rk-ink);
        transition: border-color .2s, box-shadow .2s, background-color .2s;
    }
    .rkf .form-select { padding-right: 38px; }
    .rkf .form-control::placeholder { color: #9aa7b6; }
    .rkf .form-control:hover, .rkf .form-select:hover { border-color: #cdd6e2; }
    .rkf .form-control:focus, .rkf .form-select:focus {
        background-color: #fff; border-color: var(--rk-navy);
        box-shadow: 0 0 0 4px rgba(27, 54, 93, .12);
    }
    .rkf-hint { margin-top: 6px; font-size: .78rem; color: var(--rk-muted); }
    .rkf-hint.ok { color: #0b7a56; font-weight: 600; }
    .rkf-field-error { margin-top: 8px; font-size: .82rem; font-weight: 600; color: var(--rk-red); }

    /* ---------- Upload KTP ---------- */
    .rkf-drop {
        position: relative; display: flex; align-items: center; gap: 16px;
        padding: 18px 20px; cursor: pointer;
        border: 2px dashed #cdd6e2; border-radius: 16px; background: var(--rk-paper);
        transition: border-color .2s, background .2s;
    }
    .rkf-drop:hover, .rkf-drop.has-file { border-color: var(--rk-navy); background: #f1f5fb; }
    .rkf-drop:focus-within { border-color: var(--rk-navy); box-shadow: 0 0 0 4px rgba(27, 54, 93, .12); }
    .rkf-drop input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .rkf-drop-ico {
        flex: none; width: 48px; height: 48px; border-radius: 14px;
        display: grid; place-items: center; font-size: 1.15rem;
        background: #fff; color: var(--rk-navy); border: 1px solid var(--rk-line);
    }
    .rkf-drop-text { flex: 1 1 auto; min-width: 0; }
    .rkf-drop-text strong { display: block; font-size: .92rem; color: var(--rk-ink); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .rkf-drop-text small { display: block; margin-top: 2px; font-size: .8rem; color: var(--rk-muted); }
    .rkf-drop img { flex: none; width: 64px; height: 44px; object-fit: cover; border-radius: 8px; border: 1px solid var(--rk-line); }

    /* ---------- Tombol Aksi ---------- */
    .rkf-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 9px;
        height: 46px; padding: 0 24px; border-radius: 12px;
        font-size: .92rem; font-weight: 600; text-decoration: none; cursor: pointer;
        border: 1px solid transparent;
        transition: transform .15s, box-shadow .2s, background .2s, color .2s;
    }
    .rkf-btn:active { transform: translateY(1px); }
    .rkf-btn:focus-visible { outline: 3px solid rgba(27, 54, 93, .35); outline-offset: 2px; }
    .rkf-btn-ghost { background: #fff; color: var(--rk-steel); border-color: var(--rk-line); }
    .rkf-btn-ghost:hover { background: var(--rk-paper); color: var(--rk-ink); }
    .rkf-btn-save { color: #fff; }
    .rkf-btn-save.green { background: var(--rk-green); box-shadow: 0 6px 16px rgba(16, 185, 129, .3); }
    .rkf-btn-save.green:hover { background: #0e9f6e; transform: translateY(-1px); color: #fff; }
    .rkf-btn-save[disabled] { opacity: .7; cursor: progress; transform: none; }

    @media (max-width: 768px) {
        .rkf-hero { padding: 22px 20px; border-radius: 18px; }
        .rkf-sec { padding: 20px 18px 22px; border-radius: 18px; }
        .rkf-bar { bottom: 8px; }
        .rkf-bar .rkf-btn { flex: 1 1 100%; }
        .rkf-bar .rkf-btn-save { order: -1; }
        .rkf-drop { flex-wrap: wrap; }
    }
    @media (prefers-reduced-motion: reduce) {
        .rkf *, .rkf-hero, .rkf-sec, .rkf-bar { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
@php
    $kecamatanList  = ['Alam Barajo', 'Danau Sipin', 'Danau Teluk', 'Jambi Selatan', 'Jambi Timur', 'Jelutung', 'Kota Baru', 'Paal Merah', 'Pasar Jambi', 'Pelayangan', 'Telanaipura'];
    $agamaList      = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
    $statusList     = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
    $pendidikanList = ['SD' => 'SD sederajat', 'SMP' => 'SMP sederajat', 'SMA' => 'SMA sederajat', 'D3' => 'Diploma 3 (D3)', 'S1' => 'Sarjana (S1)', 'S2' => 'Magister (S2)'];
    $pekerjaanList  = ['ASN', 'TNI', 'POLRI', 'WIRASWASTA', 'KARYAWAN SWASTA', 'KARYAWAN BUMN/BUMD', 'PEKERJA HARIAN LEPAS', 'MAHASISWA/PELAJAR', 'PENGURUS RUMAH TANGGA'];
    $darahList      = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];

    $val          = fn ($k) => old($k);
    $pekerjaanSel = old('pekerjaan');
    $lainnyaVal   = old('pekerjaan_lainnya');
    $kelSel       = old('kelurahan');
    $tglLahir = $val('tanggal_lahir');
    $tglLahir = $tglLahir ? \Carbon\Carbon::parse($tglLahir)->format('Y-m-d') : '';
@endphp

<div class="rkf">

    {{-- ===== Header ===== --}}
    <div class="rkf-hero">
        <div>
            <a href="/internal/pencegahan/kelola-redkar" class="rkf-back"><i class="fas fa-arrow-left"></i> Data relawan</a>
            <h1>Tambah data relawan REDKAR</h1>
        </div>
    </div>

    {{-- ===== Error validasi ===== --}}
    @if($errors->any())
        <div class="rkf-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Ada isian yang perlu diperbaiki</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <form id="rkf-form" action="{{ url('/internal/pencegahan/simpan-redkar-offline') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ===== 1. Identitas ===== --}}
        <section class="rkf-sec">
            <div class="rkf-sec-head">
                <div class="rkf-sec-num"><i class="fas fa-user"></i></div>
                <div><h2>1. Identitas pribadi</h2><p>Sesuai dengan data pada KTP.</p></div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="nama_lengkap">Nama lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $val('nama_lengkap') }}" placeholder="Masukkan nama lengkap sesuai KTP" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="nik">NIK (16 digit) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $val('nik') }}" maxlength="16" inputmode="numeric" autocomplete="off" placeholder="16 digit angka NIK" required>
                    <div class="rkf-hint" id="nik-count" aria-live="polite">0 dari 16 digit</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="nomor_telp">No. telepon / WhatsApp <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="nomor_telp" name="nomor_telp" value="{{ $val('nomor_telp') }}" inputmode="tel" placeholder="Contoh: 081234567890" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="tempat_lahir">Tempat lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $val('tempat_lahir') }}" placeholder="Kota atau kabupaten tempat lahir" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="tanggal_lahir">Tanggal lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $tglLahir }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="jenis_kelamin">Jenis kelamin <span class="text-danger">*</span></label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" disabled {{ $val('jenis_kelamin') ? '' : 'selected' }}>Pilih jenis kelamin</option>
                        @foreach(['Laki-Laki', 'Perempuan'] as $jk)
                            <option value="{{ $jk }}" {{ $val('jenis_kelamin') == $jk ? 'selected' : '' }}>{{ $jk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="agama">Agama <span class="text-danger">*</span></label>
                    <select class="form-select" id="agama" name="agama" required>
                        <option value="" disabled {{ $val('agama') ? '' : 'selected' }}>Pilih agama</option>
                        @foreach($agamaList as $a)
                            <option value="{{ $a }}" {{ $val('agama') == $a ? 'selected' : '' }}>{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="status_perkawinan">Status perkawinan <span class="text-danger">*</span></label>
                    <select class="form-select" id="status_perkawinan" name="status_perkawinan" required>
                        <option value="" disabled {{ $val('status_perkawinan') ? '' : 'selected' }}>Pilih status</option>
                        @foreach($statusList as $s)
                            <option value="{{ $s }}" {{ $val('status_perkawinan') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        {{-- ===== 2. Alamat ===== --}}
        <section class="rkf-sec">
            <div class="rkf-sec-head">
                <div class="rkf-sec-num"><i class="fas fa-map-marker-alt"></i></div>
                <div><h2>2. Alamat dan wilayah domisili</h2><p>Pilih kecamatan terlebih dahulu agar daftar kelurahan muncul.</p></div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="alamat">Alamat lengkap <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Nama jalan, gang, atau nomor rumah" required>{{ $val('alamat') }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="rt_rw">RT / RW <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="rt_rw" name="rt_rw" value="{{ $val('rt_rw') }}" placeholder="00/00" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                    <select class="form-select" id="kecamatan" name="kecamatan" required>
                        <option value="" disabled {{ $val('kecamatan') ? '' : 'selected' }}>Pilih kecamatan</option>
                        @foreach($kecamatanList as $kec)
                            <option value="{{ $kec }}" {{ $val('kecamatan') == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="kelurahan">Kelurahan <span class="text-danger">*</span></label>
                    <select class="form-select" id="kelurahan" name="kelurahan" data-selected="{{ $kelSel }}" required>
                        @if($kelSel)
                            <option value="{{ $kelSel }}" selected>{{ $kelSel }}</option>
                        @else
                            <option value="" disabled selected>Pilih kecamatan dulu</option>
                        @endif
                    </select>
                </div>
            </div>
        </section>

        {{-- ===== 3. Pendidikan & pekerjaan ===== --}}
        <section class="rkf-sec">
            <div class="rkf-sec-head">
                <div class="rkf-sec-num"><i class="fas fa-graduation-cap"></i></div>
                <div><h2>3. Pendidikan dan pekerjaan</h2><p>Pendidikan terakhir dan pekerjaan saat ini.</p></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="pendidikan_terakhir">Pendidikan terakhir <span class="text-danger">*</span></label>
                    <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                        <option value="" disabled {{ $val('pendidikan_terakhir') ? '' : 'selected' }}>Pilih pendidikan</option>
                        @foreach($pendidikanList as $kode => $label)
                            <option value="{{ $kode }}" {{ $val('pendidikan_terakhir') == $kode ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="latar_belakang_pendidikan">Latar belakang pendidikan / jurusan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="latar_belakang_pendidikan" name="latar_belakang_pendidikan" value="{{ $val('latar_belakang_pendidikan') }}" placeholder="Contoh: Teknik Informatika, IPA, atau IPS" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                    <select class="form-select" id="pekerjaan" name="pekerjaan" required>
                        <option value="" disabled {{ $pekerjaanSel ? '' : 'selected' }}>Pilih pekerjaan</option>
                        @foreach($pekerjaanList as $job)
                            <option value="{{ $job }}" {{ $pekerjaanSel == $job ? 'selected' : '' }}>{{ $job }}</option>
                        @endforeach
                        <option value="LAINNYA" {{ $pekerjaanSel == 'LAINNYA' ? 'selected' : '' }}>LAINNYA</option>
                    </select>
                </div>

                <div class="col-md-6" id="wrapper_pekerjaan_lainnya" style="display: none;">
                    <label class="form-label" for="pekerjaan_lainnya">Sebutkan pekerjaan lainnya <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="pekerjaan_lainnya" name="pekerjaan_lainnya" value="{{ $lainnyaVal }}" placeholder="Tuliskan pekerjaan">
                </div>
            </div>
        </section>

        {{-- ===== 4. Kesehatan ===== --}}
        <section class="rkf-sec">
            <div class="rkf-sec-head">
                <div class="rkf-sec-num"><i class="fas fa-heartbeat"></i></div>
                <div><h2>4. Keterangan kesehatan</h2><p>Informasi ini membantu penugasan di lapangan.</p></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="sehat_jasmani">Sehat jasmani dan rohani <span class="text-danger">*</span></label>
                    <select class="form-select" id="sehat_jasmani" name="sehat_jasmani" required>
                        @foreach(['Ya', 'Tidak'] as $sj)
                            <option value="{{ $sj }}" {{ ($val('sehat_jasmani') ?: 'Ya') == $sj ? 'selected' : '' }}>{{ $sj }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="golongan_darah">Golongan darah <span class="text-danger">*</span></label>
                    <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                        @foreach($darahList as $gd)
                            <option value="{{ $gd }}" {{ ($val('golongan_darah') ?: 'Tidak Tahu') == $gd ? 'selected' : '' }}>{{ $gd }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        {{-- ===== 5. Dokumen ===== --}}
        <section class="rkf-sec">
            <div class="rkf-sec-head">
                <div class="rkf-sec-num"><i class="fas fa-id-card"></i></div>
                <div><h2>5. Dokumen pendukung</h2><p>Opsional. Unggah foto atau hasil scan KTP.</p></div>
            </div>

            <label class="rkf-drop" id="rkf-drop" for="foto_ktp">
                <input type="file" id="foto_ktp" name="foto_ktp" accept=".jpg,.jpeg,.png">
                <span class="rkf-drop-ico"><i class="fas fa-cloud-upload-alt"></i></span>
                <span class="rkf-drop-text">
                    <strong id="rkf-file-name">Pilih foto atau scan KTP</strong>
                    <small id="rkf-file-hint">JPG, JPEG, atau PNG, maksimal 2 MB.</small>
                </span>
                <img id="rkf-preview" alt="Pratinjau KTP" hidden>
            </label>
            <div id="rkf-file-error" class="rkf-field-error" role="alert" hidden></div>
        </section>

        {{-- ===== Aksi ===== --}}
        <div class="rkf-bar">
            <a href="/internal/pencegahan/kelola-redkar" class="rkf-btn rkf-btn-ghost">Batal</a>
            <button type="submit" id="rkf-save" class="rkf-btn rkf-btn-save green"><i class="fas fa-save"></i> Simpan data relawan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Dropdown kelurahan mengikuti kecamatan ---------- */
    const dataWilayah = {
        "Alam Barajo": ["Bagan Pete", "Beliung", "Kenali Besar", "Mayang Mangurai", "Pinang Merah", "Rawa Sari", "Simpang Rimbo"],
        "Danau Sipin": ["Legok", "Murni", "Selamat", "Solok Sipin", "Sungai Putri"],
        "Danau Teluk": ["Olak Kemang", "Pasir Panjang", "Tanjung Pasir", "Tanjung Raden", "Ulu Gedong"],
        "Jambi Selatan": ["Pakuan Baru", "Pasir Putih", "Tambak Sari", "The Hok", "Wijaya Pura"],
        "Jambi Timur": ["Budiman", "Kasang", "Kasang Jaya", "Rajawali", "Sejinjang", "Sulanjana", "Talang Banjar", "Tanjung Pinang", "Tanjung Sari"],
        "Jelutung": ["Cempaka Putih", "Handil Jaya", "Jelutung", "Kebun Handil", "Lebak Bandung", "Payo Lebar", "Talang Jauh"],
        "Kota Baru": ["Kenali Asam", "Kenali Asam Atas", "Kenali Asam Bawah", "Paal Lima", "Simpang Tiga Sipin", "Sukakarya", "Talang Gulo"],
        "Paal Merah": ["Bakung Jaya", "Eka Jaya", "Lingkar Selatan", "Paal Merah", "Payo Selincah", "Talang Bakung"],
        "Pasar Jambi": ["Beringin", "Orang Kayo Hitam", "Pasar Jambi", "Sungai Asam"],
        "Pelayangan": ["Arab Melayu", "Jelmu", "Mudung Laut", "Tahtul Yaman", "Tanjung Johor", "Tengah"],
        "Telanaipura": ["Aur Kenali", "Buluran Kenali", "Pematang Sulur", "Penyengat Rendah", "Simpang Empat Sipin", "Telanaipura", "Teluk Kenali"]
    };

    const kecamatanSelect = document.getElementById('kecamatan');
    const kelurahanSelect = document.getElementById('kelurahan');

    function updateKelurahan(kecamatan, selected) {
        kelurahanSelect.innerHTML = '<option value="" disabled' + (selected ? '' : ' selected') + '>Pilih kelurahan</option>';
        (dataWilayah[kecamatan] || []).forEach(function (kel) {
            const option = document.createElement('option');
            option.value = kel;
            option.textContent = kel;
            if (kel === selected) option.selected = true;
            kelurahanSelect.appendChild(option);
        });
    }

    if (kecamatanSelect.value) {
        updateKelurahan(kecamatanSelect.value, kelurahanSelect.dataset.selected || '');
    }
    kecamatanSelect.addEventListener('change', function () {
        updateKelurahan(this.value, '');
    });

    /* ---------- Pekerjaan lainnya ---------- */
    const selectPekerjaan = document.getElementById('pekerjaan');
    const wrapperLainnya = document.getElementById('wrapper_pekerjaan_lainnya');
    const inputLainnya = document.getElementById('pekerjaan_lainnya');

    function togglePekerjaan() {
        const lain = selectPekerjaan.value === 'LAINNYA';
        wrapperLainnya.style.display = lain ? 'block' : 'none';
        if (lain) {
            inputLainnya.setAttribute('required', 'required');
        } else {
            inputLainnya.removeAttribute('required');
            inputLainnya.value = '';
        }
    }
    togglePekerjaan();
    selectPekerjaan.addEventListener('change', togglePekerjaan);

    /* ---------- NIK: hanya angka + penghitung ---------- */
    const nik = document.getElementById('nik');
    const nikCount = document.getElementById('nik-count');

    function updateNik() {
        nik.value = nik.value.replace(/\D/g, '').slice(0, 16);
        const n = nik.value.length;
        nikCount.textContent = n + ' dari 16 digit';
        nikCount.classList.toggle('ok', n === 16);
    }
    updateNik();
    nik.addEventListener('input', updateNik);

    /* ---------- Upload KTP: nama file, pratinjau, batas 2 MB ---------- */
    const fileInput = document.getElementById('foto_ktp');
    const drop = document.getElementById('rkf-drop');
    const fileName = document.getElementById('rkf-file-name');
    const fileHint = document.getElementById('rkf-file-hint');
    const preview = document.getElementById('rkf-preview');
    const fileError = document.getElementById('rkf-file-error');
    const defaultName = fileName.textContent;
    const defaultHint = fileHint.textContent;

    function resetFile() {
        fileInput.value = '';
        drop.classList.remove('has-file');
        fileName.textContent = defaultName;
        fileHint.textContent = defaultHint;
        preview.hidden = true;
        preview.removeAttribute('src');
    }

    fileInput.addEventListener('change', function () {
        fileError.hidden = true;
        const f = this.files && this.files[0];
        if (!f) { resetFile(); return; }

        if (f.size > 2 * 1024 * 1024) {
            resetFile();
            fileError.textContent = 'Ukuran file melebihi 2 MB. Pilih file yang lebih kecil.';
            fileError.hidden = false;
            return;
        }
        if (!/^image\/(jpe?g|png)$/i.test(f.type)) {
            resetFile();
            fileError.textContent = 'Format file harus JPG, JPEG, atau PNG.';
            fileError.hidden = false;
            return;
        }

        drop.classList.add('has-file');
        fileName.textContent = f.name;
        fileHint.textContent = (f.size / 1024 < 1024
            ? Math.round(f.size / 1024) + ' KB'
            : (f.size / 1048576).toFixed(1) + ' MB') + ' · klik untuk mengganti';
        preview.src = URL.createObjectURL(f);
        preview.hidden = false;
    });

    /* ---------- Cegah kirim ganda ---------- */
    const form = document.getElementById('rkf-form');
    const saveBtn = document.getElementById('rkf-save');
    form.addEventListener('submit', function () {
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Menyimpan…';
    });
})();
</script>
@endpush