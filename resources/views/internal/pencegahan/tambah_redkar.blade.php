@extends('layouts.dashboard')

@section('title', 'Tambah Data Relawan Offline')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --ink-2: #132a43;
                --ink-3: #1d3856;
                --paper: #f7f9fc;
                --white: #ffffff;
    
                --navy: #1e3a5f;
                --navy-d: #14283f;
                --navy-tint: rgba(30, 58, 95, .09);
    
                --signal: #e5392d;
                --signal-d: #c22b20;
                --signal-tint: rgba(229, 57, 45, .09);
    
                --amber: #ffb627;
                --success: #10b981;
                --info: #2f6fed;
                --info-tint: rgba(47, 111, 237, .09);
                --ink-tint: rgba(13, 27, 42, .055);
    
                --steel: #64748b;
                --steel-soft: #94a3b8;
                --line: #e6eaf1;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 20px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 272px;
                --topbar-h: 72px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
                --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
                --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
                --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
            }
    .topbar {
                position: sticky; top: 0; z-index: 60; height: var(--topbar-h);
                display: flex; align-items: center; justify-content: space-between; gap: 16px;
                padding: 0 28px; background: rgba(255,255,255,.86);
                -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px);
                border-bottom: 1px solid var(--line);
            }
    .side-toggle { display: none; width: 40px; height: 40px; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.05rem; transition: background .2s; }
    .side-toggle:hover { background: var(--paper); }
    .brand { display: flex; align-items: center; gap: 12px; min-width: 0; }
    .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -0.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .topbar-right { display: flex; align-items: center; gap: 14px; }
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 6px 16px 6px 6px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--ink); color: #fff; display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .85rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--ink); }
    .user-meta small { font-size: .74rem; color: var(--steel); text-transform: capitalize; font-weight: 500; }
    .btn-logout { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 18px; border-radius: 999px; background: var(--navy); color: #fff; font-weight: 600; font-size: .85rem; transition: background .2s, transform .1s; border: none; }
    .btn-logout:hover { background: var(--navy-d); }
    .btn-logout:active { transform: scale(.98); }
    .sidebar {
                width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
                height: calc(100vh - var(--topbar-h)); overflow-y: auto;
                background: #fff; border-right: 1px solid var(--line);
                padding: 20px 14px 32px;
                scrollbar-width: thin;
                scrollbar-color: var(--line) transparent;
            }
    .sidebar::-webkit-scrollbar-thumb { background-color: var(--line); border-radius: 20px; }
    .side-link {
                display: flex; align-items: center; gap: 14px; padding: 11px 14px; border-radius: var(--r-sm);
                font-size: .9rem; font-weight: 600; color: var(--ink); transition: background .2s, color .2s;
                margin-bottom: 4px;
            }
    .side-link:hover { background: var(--paper); }
    .side-link.active { background: var(--ink); color: #fff; }
    .side-link i { width: 20px; text-align: center; font-size: 1rem; color: var(--steel); transition: color .2s; }
    .side-link.active i { color: var(--amber); }
    .side-group summary {
                list-style: none; cursor: pointer; display: flex; align-items: center; gap: 12px;
                padding: 11px 14px; border-radius: var(--r-sm); font-size: .8rem; font-weight: 700;
                letter-spacing: .04em; text-transform: uppercase; color: var(--navy); transition: background .2s;
                user-select: none;
            }
    .side-group summary:hover { background: var(--paper); }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; }
    .side-sub { display: grid; gap: 3px; padding: 6px 4px 10px 12px; border-left: 2px solid var(--line); margin: 2px 0 8px 22px; }
    .side-sub a {
                display: flex; align-items: center; gap: 12px; padding: 9px 12px; border-radius: var(--r-sm);
                font-size: .85rem; font-weight: 500; line-height: 1.4; color: var(--steel);
                transition: background .2s, color .2s, transform .2s;
            }
    .side-sub a:hover { background: var(--paper); color: var(--ink); transform: translateX(2px); }
    .side-sub a.active { background: var(--navy-tint); color: var(--navy-d); font-weight: 600; }
    .side-sub a i { width: 18px; text-align: center; font-size: .9rem; opacity: .75; }
    .side-kicker { padding: 18px 14px 6px; font-size: .7rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: var(--steel-soft); }
    @media (max-width: 900px) {
        .sidebar {
                    position: fixed; z-index: 90; top: var(--topbar-h); left: 0;
                    height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%);
                    transition: transform .3s cubic-bezier(.4,0,.2,1); box-shadow: var(--shadow-lg);
                }
        .sidebar-backdrop {
                    display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 80;
                    background: rgba(13,27,42,.4); opacity: 0; pointer-events: none; transition: opacity .3s;
                }
    }
    .page-head { margin-bottom: 32px; text-align: center; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 6px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .98rem; }
    .content-card {
                background: #fff; border-radius: var(--r-lg); border: 1px solid var(--line);
                padding: clamp(28px, 4vw, 40px); box-shadow: var(--shadow-sm); width: 100%; max-width: 1000px; margin: 0 auto;
            }
    .section-title {
                font-family: var(--font-display); font-weight: 700; font-size: 1.05rem;
                color: var(--navy); text-transform: uppercase; letter-spacing: 0.04em;
                margin-top: 36px; margin-bottom: 20px; padding-bottom: 8px; border-bottom: 2px solid var(--navy-tint);
            }
    .section-title:first-of-type { margin-top: 0; }
    .form-label { font-size: 0.85rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.03em; }
    .form-control, .form-select {
                font-size: 0.95rem; padding: 12px 16px; border-radius: var(--r-sm); border: 1px solid var(--line);
                background-color: #fff; color: var(--ink); transition: border-color .2s, box-shadow .2s;
            }
    .form-control:focus, .form-select:focus {
                border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-tint); background-color: #fff;
            }
    .btn-submit {
                display: inline-flex; align-items: center; justify-content: center; gap: 10px;
                background-color: var(--success); color: white; font-weight: 700; font-size: 0.95rem;
                padding: 14px 28px; border: none; border-radius: 999px; width: 100%; transition: background .2s, transform .1s;
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            }
    .btn-submit:hover { background-color: #059669; }
    .btn-submit:active { transform: scale(0.98); }
    .btn-back {
                display: inline-flex; align-items: center; justify-content: center; gap: 10px;
                background-color: var(--paper); color: var(--steel); font-weight: 600; font-size: 0.95rem;
                padding: 14px 28px; border: 1px solid var(--line); border-radius: 999px; width: 100%;
                text-decoration: none; text-align: center; transition: background .2s, color .2s;
            }
    .btn-back:hover { background-color: var(--line); color: var(--ink); }
</style>
@endpush

@section('content')
@section('content')

        <!-- Header halaman diletakkan di tengah (Centered) agar terlihat lebih clean -->
        <div class="page-head">
            <h1>Tambah Data Relawan Offline</h1>
            <p>Input data relawan baru yang mendaftar secara langsung melalui kantor.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4 mx-auto" style="max-width: 1000px;" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> Periksa kembali isian form Anda:
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="content-card">
            <form action="/internal/pencegahan/simpan-redkar-offline" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- AKUN LOGIN -->
                    <div class="col-12"><div class="section-title mt-0">1. Akun Login Relawan</div></div>

                    <div class="col-md-6">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Buat username unik" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password Awal <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" required>
                    </div>

                    <!-- IDENTITAS UTAMA -->
                    <div class="col-12"><div class="section-title">2. Identitas Pribadi</div></div>

                    <div class="col-md-12">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NIK (Nomor KTP - 16 Digit) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nik" value="{{ old('nik') }}" maxlength="16" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nomor_telp" value="{{ old('nomor_telp') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                        <select class="form-select" name="agama" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                        <select class="form-select" name="status_perkawinan" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                            <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                    </div>

                    <!-- ALAMAT & WILAYAH -->
                    <div class="col-12"><div class="section-title">3. Alamat &amp; Wilayah Domisili</div></div>

                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">RT / RW <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="rt_rw" value="{{ old('rt_rw') }}" placeholder="00/00" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="kode_pos" value="{{ old('kode_pos') }}" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select class="form-select" name="kecamatan" id="kecamatan" required>
                            <option value="" disabled selected>Pilih Kecamatan</option>
                            <option value="Alam Barajo" {{ old('kecamatan') == 'Alam Barajo' ? 'selected' : '' }}>Alam Barajo</option>
                            <option value="Danau Sipin" {{ old('kecamatan') == 'Danau Sipin' ? 'selected' : '' }}>Danau Sipin</option>
                            <option value="Danau Teluk" {{ old('kecamatan') == 'Danau Teluk' ? 'selected' : '' }}>Danau Teluk</option>
                            <option value="Jambi Selatan" {{ old('kecamatan') == 'Jambi Selatan' ? 'selected' : '' }}>Jambi Selatan</option>
                            <option value="Jambi Timur" {{ old('kecamatan') == 'Jambi Timur' ? 'selected' : '' }}>Jambi Timur</option>
                            <option value="Jelutung" {{ old('kecamatan') == 'Jelutung' ? 'selected' : '' }}>Jelutung</option>
                            <option value="Kota Baru" {{ old('kecamatan') == 'Kota Baru' ? 'selected' : '' }}>Kota Baru</option>
                            <option value="Paal Merah" {{ old('kecamatan') == 'Paal Merah' ? 'selected' : '' }}>Paal Merah</option>
                            <option value="Pasar Jambi" {{ old('kecamatan') == 'Pasar Jambi' ? 'selected' : '' }}>Pasar Jambi</option>
                            <option value="Pelayangan" {{ old('kecamatan') == 'Pelayangan' ? 'selected' : '' }}>Pelayangan</option>
                            <option value="Telanaipura" {{ old('kecamatan') == 'Telanaipura' ? 'selected' : '' }}>Telanaipura</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                        <select class="form-select" name="kelurahan" id="kelurahan" required>
                            <option value="" disabled selected>Pilih Kecamatan Dulu</option>
                        </select>
                    </div>

                    <!-- PENDIDIKAN & PEKERJAAN -->
                    <div class="col-12"><div class="section-title">4. Pendidikan &amp; Pekerjaan</div></div>

                    <div class="col-md-6">
                        <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                        <select class="form-select" name="pendidikan_terakhir" required>
                            <option value="" disabled selected>Pilih Pendidikan</option>
                            <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD Sederajat</option>
                            <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP Sederajat</option>
                            <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA Sederajat</option>
                            <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                            <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                            <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Latar Belakang Pendidikan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="latar_belakang_pendidikan" value="{{ old('latar_belakang_pendidikan') }}" placeholder="Contoh: Teknik Informatika" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Pekerjaan <span class="text-danger">*</span></label>
                        <select class="form-select" name="jenis_pekerjaan" id="jenis_pekerjaan" required>
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <option value="Pelajar / Mahasiswa" {{ old('jenis_pekerjaan') == 'Pelajar / Mahasiswa' ? 'selected' : '' }}>Pelajar / Mahasiswa</option>
                            <option value="PNS / ASN" {{ old('jenis_pekerjaan') == 'PNS / ASN' ? 'selected' : '' }}>PNS / ASN</option>
                            <option value="Karyawan Swasta" {{ old('jenis_pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                            <option value="Wiraswasta / Pedagang" {{ old('jenis_pekerjaan') == 'Wiraswasta / Pedagang' ? 'selected' : '' }}>Wiraswasta / Pedagang</option>
                            <option value="Buruh / Pekerja Lepas" {{ old('jenis_pekerjaan') == 'Buruh / Pekerja Lepas' ? 'selected' : '' }}>Buruh / Pekerja Lepas</option>
                            <option value="TNI / POLRI" {{ old('jenis_pekerjaan') == 'TNI / POLRI' ? 'selected' : '' }}>TNI / POLRI</option>
                            <option value="Petani / Nelayan" {{ old('jenis_pekerjaan') == 'Petani / Nelayan' ? 'selected' : '' }}>Petani / Nelayan</option>
                            <option value="Lainnya" {{ old('jenis_pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya (Sebutkan)</option>
                        </select>
                    </div>

                    <div class="col-md-6" id="wrapper_pekerjaan_lainnya" style="display: none;">
                        <label class="form-label">Sebutkan Pekerjaan Lainnya <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pekerjaan_lainnya" id="pekerjaan_lainnya" value="{{ old('pekerjaan_lainnya') }}" placeholder="Tuliskan pekerjaan...">
                    </div>

                    <!-- KESEHATAN & STATUS -->
                    <div class="col-12"><div class="section-title">5. Kesehatan &amp; Status Keanggotaan</div></div>

                    <div class="col-md-6">
                        <label class="form-label">Sehat Jasmani <span class="text-danger">*</span></label>
                        <select class="form-select" name="sehat_jasmani" required>
                            <option value="Ya" {{ old('sehat_jasmani') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('sehat_jasmani') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Golongan Darah <span class="text-danger">*</span></label>
                        <select class="form-select" name="golongan_darah" required>
                            <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                            <option value="Tidak Tahu" {{ old('golongan_darah') == 'Tidak Tahu' || old('golongan_darah') == '' ? 'selected' : '' }}>Tidak Tahu</option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="form-label" style="color: var(--navy);">1. Status Akun (Hak Akses Login) <span class="text-danger">*</span></label>
                        <select class="form-select" name="status_akun" required>
                            <option value="Aktif" {{ old('status_akun') == 'Aktif' || old('status_akun') == '' ? 'selected' : '' }}>Aktif (Diizinkan Login)</option>
                            <option value="Nonaktif" {{ old('status_akun') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Diblokir)</option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="form-label" style="color: var(--success);">2. Status Pendaftaran (Seleksi Berkas) <span class="text-danger">*</span></label>
                        <select class="form-select" name="status_pendaftaran" required>
                            <option value="Diterima" {{ old('status_pendaftaran') == 'Diterima' || old('status_pendaftaran') == '' ? 'selected' : '' }}>Diterima</option>
                            <option value="Pending" {{ old('status_pendaftaran') == 'Pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="Ditolak" {{ old('status_pendaftaran') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <!-- FOTO KTP OPSIONAL -->
                    <div class="col-12"><div class="section-title">6. Dokumen Pendukung</div></div>
                    <div class="col-12">
                        <label class="form-label">Upload Foto / Scan KTP (Opsional)</label>
                        <input type="file" class="form-control" name="foto_ktp" accept=".jpg,.jpeg,.png">
                        <small class="text-muted d-block mt-1">Format JPG, JPEG, atau PNG (Maks. 2MB).</small>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="col-12 mt-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <button type="submit" class="btn-submit"><i class="fas fa-user-plus me-2"></i> Simpan &amp; Daftarkan Relawan</button>
                            </div>
                            <div class="col-md-6">
                                <a href="/internal/pencegahan/kelola-redkar" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Batal / Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Dropdown Kelurahan Berdasarkan Kecamatan ---------- */
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
    const oldKecamatan = "{{ old('kecamatan') }}";
    const oldKelurahan = "{{ old('kelurahan') }}";

    function updateKelurahan(kecamatan, selectedKelurahan = '') {
        kelurahanSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan</option>';
        if (kecamatan && dataWilayah[kecamatan]) {
            dataWilayah[kecamatan].forEach(function(kel) {
                const option = document.createElement('option');
                option.value = kel;
                option.textContent = kel;
                if (kel === selectedKelurahan) {
                    option.selected = true;
                }
                kelurahanSelect.appendChild(option);
            });
        }
    }

    if (oldKecamatan) {
        updateKelurahan(oldKecamatan, oldKelurahan);
    }

    kecamatanSelect.addEventListener('change', function() {
        updateKelurahan(this.value);
    });

    /* ---------- Logika Pekerjaan Lainnya ---------- */
    const selectPekerjaan = document.getElementById('jenis_pekerjaan');
    const wrapperLainnya = document.getElementById('wrapper_pekerjaan_lainnya');
    const inputLainnya = document.getElementById('pekerjaan_lainnya');

    if (selectPekerjaan.value === 'Lainnya') {
        wrapperLainnya.style.display = 'block';
        inputLainnya.setAttribute('required', 'required');
    }

    selectPekerjaan.addEventListener('change', function() {
        if (this.value === 'Lainnya') {
            wrapperLainnya.style.display = 'block';
            inputLainnya.setAttribute('required', 'required');
        } else {
            wrapperLainnya.style.display = 'none';
            inputLainnya.removeAttribute('required');
            inputLainnya.value = '';
        }
    });

})();
</script>
@endpush
