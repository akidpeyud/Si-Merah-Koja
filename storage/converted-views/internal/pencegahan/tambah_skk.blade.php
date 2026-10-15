@extends('layouts.dashboard')

@section('title', 'Tambah Permohonan SKK')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --ink-2: #132a43;
                --ink-3: #1d3856;
                --paper: #f7f9fc;
                --white: #ffffff;
    
                --navy: #163a63;
                --navy-dark: #0d2947;
                --navy-light: #eaf1f8;
                --navy-soft: rgba(22, 58, 99, .08);
    
                --signal: #dc3545;
                --signal-dark: #b42332;
                --signal-soft: rgba(220, 53, 69, .09);
    
                --amber: #f4b740;
                --success: #198754;
                --info: #2563eb;
    
                --steel: #64748b;
                --steel-soft: #94a3b8;
                --line: #e6eaf1;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 20px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 288px; 
                --topbar-h: 70px; 
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-top: 4px; }
    .page-head { margin-bottom: 26px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 6px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .98rem; }
    .content-card {
                background: #fff; border-radius: var(--r-md); border: 1px solid var(--line);
                padding: 30px; box-shadow: var(--shadow-xs); width: 100%; max-width: 1000px; margin: 0 auto;
            }
    .section-title {
                font-family: var(--font-display); font-weight: 700; font-size: 1.1rem; color: var(--navy); margin-bottom: 16px; padding-bottom: 10px; border-bottom: 2px solid var(--line); display: flex; align-items: center; gap: 8px; 
            }
    .form-label { font-size: 0.88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select {
                font-size: 0.92rem; padding: 10px 14px; border-radius: 8px; border: 1px solid var(--line-dark);
                background-color: #fff; color: var(--ink); transition: border-color .2s, box-shadow .2s;
            }
    .form-control:focus, .form-select:focus {
                border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); background-color: #fff;
            }
    .btn-submit {
                display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: var(--navy); color: #fff; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; border: none; transition: .2s; width: 100%;
            }
    .btn-submit:hover { background-color: var(--navy-dark); transform: translateY(-1px); }
    .btn-back {
                display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #fff; color: var(--ink); border: 1px solid var(--line-dark); padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; transition: .2s; text-decoration: none; width: 100%;
            }
    .btn-back:hover { background-color: var(--paper); color: var(--ink); }
</style>
@endpush

@section('content')
@section('content')

        <div class="mb-4">
            <a href="/internal/pencegahan/kelola-skk" class="btn-back" style="padding: 8px 18px; font-size: 0.88rem; width: auto;">
                <i class="fas fa-arrow-left"></i> Kembali ke Kelola SKK
            </a>
        </div>

        <div class="page-head text-start">
            <h1>Tambah Permohonan SKK Baru</h1>
            <p>Input data pengajuan Sertifikat Keamanan Kebakaran secara manual oleh petugas.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger mx-auto mb-4" style="max-width: 1000px; border-radius: 8px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="content-card">
            @hasanyrole('Pencegahan|Super User')
            <form action="{{ route('skk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12"><div class="section-title mt-0"><i class="fas fa-user-circle"></i> 1. Data Pemohon</div></div>
                    <div class="col-md-12"><label class="form-label">Nama Pemohon *</label><input type="text" class="form-control" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Email *</label><input type="email" class="form-control" name="email_pemohon" value="{{ old('email_pemohon') }}" required></div>
                    <div class="col-md-6"><label class="form-label">No. WhatsApp *</label><input type="text" class="form-control" name="no_whatsapp" value="{{ old('no_whatsapp') }}" required></div>

                    <div class="col-12"><div class="section-title"><i class="fas fa-store"></i> 2. Data Usaha &amp; Pemilik</div></div>
                    <div class="col-md-12"><label class="form-label">Nama Usaha / Perusahaan *</label><input type="text" class="form-control" name="nama_usaha" value="{{ old('nama_usaha') }}" required></div>
                    <div class="col-md-6"><label class="form-label">NIK Pemilik Usaha (Max 30 Karakter) *</label><input type="text" class="form-control" name="nik_pemilik_usaha" value="{{ old('nik_pemilik_usaha') }}" maxlength="30" required></div>
                    <div class="col-md-6"><label class="form-label">Alamat Pemilik Usaha *</label><input type="text" class="form-control" name="alamat_pemilik_usaha" value="{{ old('alamat_pemilik_usaha') }}" required></div>

                    <div class="col-12"><div class="section-title"><i class="fas fa-building"></i> 3. Data Bangunan Gedung</div></div>
                    <div class="col-md-12">
                        <label class="form-label">Kategori Bangunan *</label>
                        <select class="form-select" name="kategori_bangunan" required>
                            <option value="" disabled selected>Pilih Kategori Bangunan</option>
                            <option value="Rumah Tinggal" {{ old('kategori_bangunan') == 'Rumah Tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                            <option value="Komersial (Mall/Toko)" {{ old('kategori_bangunan') == 'Komersial (Mall/Toko)' ? 'selected' : '' }}>Komersial (Mall/Toko)</option>
                            <option value="Fasilitas Layanan Kesehatan" {{ old('kategori_bangunan') == 'Fasilitas Layanan Kesehatan' ? 'selected' : '' }}>Fasilitas Layanan Kesehatan</option>
                            <option value="Perkantoran" {{ old('kategori_bangunan') == 'Perkantoran' ? 'selected' : '' }}>Perkantoran</option>
                            <option value="Hotel / Penginapan" {{ old('kategori_bangunan') == 'Hotel / Penginapan' ? 'selected' : '' }}>Hotel / Penginapan</option>
                            <option value="Pabrik / Gudang" {{ old('kategori_bangunan') == 'Pabrik / Gudang' ? 'selected' : '' }}>Pabrik / Gudang</option>
                            <option value="Pendidikan" {{ old('kategori_bangunan') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                    </div>
                    <div class="col-12"><label class="form-label">Alamat Lengkap Bangunan *</label><textarea class="form-control" name="alamat_bangunan" rows="2" required>{{ old('alamat_bangunan') }}</textarea></div>
                    <div class="col-md-6"><label class="form-label">Kecamatan *</label><input type="text" class="form-control" name="kecamatan" value="{{ old('kecamatan') }}" required></div>
                    <div class="col-md-6"><label class="form-label">Kelurahan *</label><input type="text" class="form-control" name="kelurahan" value="{{ old('kelurahan') }}" required></div>
                    <div class="col-md-4"><label class="form-label">Luas Tanah (m²) *</label><input type="number" step="0.01" class="form-control" name="luas_lahan" value="{{ old('luas_lahan') }}" required></div>
                    <div class="col-md-4"><label class="form-label">Luas Bangunan (m²) *</label><input type="number" step="0.01" class="form-control" name="luas_bangunan" value="{{ old('luas_bangunan') }}" required></div>
                    <div class="col-md-4"><label class="form-label">Tinggi Bangunan (Meter) *</label><input type="number" step="0.01" class="form-control" name="tinggi_bangunan" value="{{ old('tinggi_bangunan') }}" required></div>

                    <div class="col-12"><div class="section-title"><i class="fas fa-file-signature"></i> 4. Status &amp; Dokumen</div></div>
                    <div class="col-md-6">
                        <label class="form-label">Status Permohonan *</label>
                        <select class="form-select" name="status_permohonan" required>
                            <option value="Pending" {{ old('status_permohonan') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diproses" {{ old('status_permohonan') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Memenuhi Syarat" {{ old('status_permohonan') == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat</option>
                            <option value="Tidak Memenuhi Syarat" {{ old('status_permohonan') == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat</option>
                        </select>
                    </div>
                    <div class="col-md-6"><label class="form-label">Upload Surat Permohonan (Opsional)</label><input type="file" class="form-control" name="file_surat_permohonan" accept=".pdf,.jpg,.png"></div>

                    <div class="col-12 mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-end gap-3">
                            <a href="/internal/pencegahan/kelola-skk" class="btn-back w-auto">Batal</a>
                            <button type="submit" class="btn-submit w-auto"><i class="fas fa-save me-2"></i> Simpan Data SKK</button>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <div class="alert alert-warning text-center mt-4" style="border-radius: 8px;">
                    <i class="fas fa-lock mb-2" style="font-size: 2rem;"></i><br>
                    <strong>Akses Ditolak!</strong> Anda tidak memiliki izin untuk menambah data SKK.
                </div>
            @endhasanyrole
        </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');

    function closeSide() {
        document.body.classList.remove('side-open');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }
    if (toggle) {
        toggle.addEventListener('click', function () {
            var open = document.body.classList.toggle('side-open');
            toggle.setAttribute('aria-expanded', open);
        });
    }
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) {
                groups.forEach(function (o) { if (o !== g) o.open = false; });
            }
        });
    });
})();
</script>
@endpush
