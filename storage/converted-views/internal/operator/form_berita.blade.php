@extends('layouts.dashboard')

@section('title'){{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }}@endsection

@push('styles')
<style>
    .toast {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 12px 12px 16px;
        border-radius: 999px;
        background: #fff; border: 1px solid var(--line);
        box-shadow: var(--shadow-md);
        font-weight: 600; font-size: .92rem;
        animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
    }
    .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: #fff; color: var(--ink);
        display: grid; place-items: center;
        font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
    }
    .user-meta strong {
        font-size: .84rem; font-weight: 700; max-width: 160px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff;
    }
    .btn-logout {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px;
        background: #fff; color: var(--ink);
        font-weight: 600; font-size: .84rem; border: none;
        transition: background .2s, color .2s, transform .1s, box-shadow .2s;
    }
    .sidebar {
        width: var(--sidebar-w); flex: none;
        position: sticky; top: var(--topbar-h);
        height: calc(100vh - var(--topbar-h));
        overflow-y: auto; overflow-x: hidden;
        background: #fff; border-right: 1px solid var(--line);
        padding: 20px 14px 32px;
        scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
    }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label {
        flex: 1 1 auto; min-width: 0;
        white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4;
    }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 1100px) {
        .content { padding: 32px 26px 60px; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .overview { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .ov-item:nth-child(3n) { border-right: 0; }
        .ov-item:nth-child(n+4) { border-top: 1px solid rgba(255,255,255,.10); }
    }
    @media (max-width: 700px) {
        .content { padding: 26px 16px 50px; }
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .welcome { padding: 25px 22px; margin-bottom: 30px; border-radius: 15px; }
        .welcome h2 { font-size: 1.3rem; }
        .welcome-sub { font-size: .88rem; }
        .overview { grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 24px; }
        .ov-item { padding: 15px 16px; gap: 10px; }
        .ov-item:nth-child(3n) { border-right: 1px solid rgba(255,255,255,.10); }
        .ov-item:nth-child(2n) { border-right: 0; }
        .ov-item:nth-child(n+3) { border-top: 1px solid rgba(255,255,255,.10); }
        .ov-item strong { font-size: 1.6rem; }
        .section-heading { gap: 9px; }
        .section-heading-ico { width: 30px; height: 30px; }
        .section-heading h3 { font-size: .92rem; }
        .dash-section { margin-bottom: 32px; }
        .section-meta { margin-left: 0; }
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .stat-card { padding: 15px; gap: 12px; }
        .stat-title { font-size: .84rem; }
        .stat-value { font-size: 1.6rem; }
    }
    @media (max-width: 420px) {
        .content { padding-left: 13px; padding-right: 13px; }
        .welcome { padding: 22px 18px; }
        .stats-grid { grid-template-columns: 1fr; }
        .welcome h2 { font-size: 1.18rem; }
        .welcome-sub { font-size: .84rem; }
        .section-heading h3 { font-size: .86rem; }
    }
    @media print {
        .content { padding: 20px; }
        .welcome { box-shadow: none; border: 1px solid #ddd; }
        .stat-card { box-shadow: none; break-inside: avoid; }
    }
    .page-head-bar { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 28px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: nowrap; }
    .section-heading-ico { flex: none; width: 32px; height: 32px; border-radius: 9px; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .78rem; box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-heading h3 { flex: none; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; white-space: nowrap; margin: 0; }
    .section-heading .line { flex: 1 1 auto; min-width: 24px; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .count-pill { flex: none; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: var(--navy-soft); color: var(--navy); font-size: .78rem; font-weight: 700; }
    .btn-simerah-danger { background: var(--signal); color: #ffffff; font-weight: 600; font-size: .9rem; border-radius: var(--r-sm); padding: 11px 20px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none; box-shadow: 0 4px 12px rgba(220, 53, 69, .22); transition: background .2s, transform .15s, box-shadow .2s; }
    .btn-simerah-danger:hover { background: var(--signal-dark); color: #ffffff; transform: translateY(-1px); }
    .btn-simerah-secondary { background: var(--paper); color: var(--ink); font-weight: 600; font-size: .88rem; border-radius: var(--r-sm); padding: 10px 18px; border: 1px solid var(--line-dark); transition: background .2s; }
    .btn-simerah-secondary:hover { background: var(--line); }
    .card-box { background: #ffffff; border-radius: var(--r-md); border: 1px solid var(--line); box-shadow: var(--shadow-xs); overflow: hidden; }
    .table-simerah { margin-bottom: 0; }
    .table-simerah thead th { font-family: var(--font-display); font-size: .76rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 700; color: var(--steel); background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 15px 20px; white-space: nowrap; }
    .table-simerah tbody td { padding: 16px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .table-simerah tbody tr:last-child td { border-bottom: none; }
    .table-simerah tbody tr:hover { background-color: #f9fbfd; }
    .row-num { display: inline-grid; place-items: center; width: 30px; height: 30px; border-radius: 8px; background: var(--paper); color: var(--steel); font-family: var(--font-display); font-weight: 700; font-size: .84rem; }
    .yt-thumb-link { position: relative; display: block; width: 148px; aspect-ratio: 16 / 9; border-radius: var(--r-sm); overflow: hidden; border: 1px solid var(--line); background: var(--ink); box-shadow: var(--shadow-xs); }
    .yt-thumb-link img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease, opacity .3s ease; }
    .yt-thumb-play { position: absolute; inset: 0; display: grid; place-items: center; background: rgba(13, 27, 42, .35); color: #ffffff; font-size: 1.35rem; opacity: 0; transition: opacity .25s ease; }
    .yt-thumb-link:hover img { transform: scale(1.05); opacity: .88; }
    .yt-thumb-link:hover .yt-thumb-play { opacity: 1; }
    .video-title { font-family: var(--font-display); font-weight: 700; font-size: .98rem; color: var(--ink); margin-bottom: 6px; line-height: 1.35; }
    .video-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; }
    .yt-watch-link { display: inline-flex; align-items: center; gap: 6px; font-size: .82rem; font-weight: 600; color: var(--signal); padding: 4px 10px; border-radius: 6px; background: var(--signal-soft); transition: background .2s, color .2s; }
    .yt-watch-link:hover { background: var(--signal); color: #ffffff; }
    .yt-id-code { font-size: .76rem; font-weight: 600; color: var(--steel); background: var(--paper); border: 1px solid var(--line); padding: 3px 8px; border-radius: 6px; }
    .action-group { display: inline-flex; align-items: center; gap: 8px; }
    .btn-edit-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--navy); background: var(--navy-soft); transition: background .2s, color .2s; }
    .btn-edit-item:hover { background: var(--navy); color: #ffffff; }
    .btn-delete-item { display: inline-flex; align-items: center; gap: 6px; padding: 8px 13px; border-radius: var(--r-sm); font-size: .82rem; font-weight: 600; color: var(--signal-dark); background: var(--signal-soft); transition: background .2s, color .2s; }
    .btn-delete-item:hover { background: var(--signal); color: #ffffff; }
    .empty-state { padding: 48px 24px; text-align: center; }
    .empty-ico { width: 56px; height: 56px; border-radius: 16px; background: var(--navy-soft); color: var(--navy); display: grid; place-items: center; font-size: 1.5rem; margin: 0 auto 14px; }
    .empty-state h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--ink); margin-bottom: 6px; }
    .empty-state p { color: var(--steel); font-size: .88rem; max-width: 42ch; margin: 0 auto 18px; }
    .modal-content { border-radius: var(--r-lg); border: 1px solid var(--line); box-shadow: var(--shadow-lg); overflow: hidden; }
    .modal-header { background: var(--ink); color: #ffffff; border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: #ffffff; display: flex; align-items: center; gap: 10px; }
    .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); opacity: .75; }
    .modal-body { padding: 24px; }
    .modal-footer { background: #f8fafc; border-top: 1px solid var(--line); padding: 14px 24px; }
    .form-label { font-size: .84rem; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
    .form-control { border-radius: var(--r-sm); border: 1px solid var(--line-dark); padding: 10px 14px; font-size: .92rem; color: var(--ink); }
    .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-hint { display: block; font-size: .78rem; color: var(--steel); margin-top: 6px; }
    .yt-preview-card { background: var(--paper); border: 1px dashed var(--line-dark); border-radius: var(--r-md); padding: 14px; text-align: center; }
    .yt-preview-card img { width: 100%; max-width: 280px; aspect-ratio: 16 / 9; object-fit: cover; border-radius: var(--r-sm); margin: 0 auto; border: 1px solid var(--line); }
    @media (max-width: 700px) {
        .content { padding: 26px 16px 50px; }
        .btn-simerah-danger.w-mobile-100 { width: 100%; }
    }
    .form-wrapper { max-width: 900px; margin: 0 auto; }
    .card-box { padding: clamp(22px, 3.5vw, 34px); }
    .form-control { transition: border-color .2s, box-shadow .2s; }
    .form-control::placeholder { color: var(--steel-soft); }
    .upload-box { background: var(--paper); border: 1.5px dashed var(--line-dark); border-radius: var(--r-md); padding: 20px; }
    .btn-simerah-danger:hover { box-shadow: 0 4px 12px rgba(220, 53, 69, .2); }
    .btn-simerah-outline { background: #ffffff; color: var(--ink); font-weight: 600; border-radius: var(--r-sm); padding: 9px 18px; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--line-dark); font-size: .88rem; transition: background .2s, border-color .2s; }
    .btn-simerah-outline:hover { background: var(--paper); border-color: var(--steel-soft); color: var(--ink); }
</style>
@endpush

@section('content')
@section('content')

        <div class="form-wrapper">

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <div class="page-head">
                    <h1>{{ isset($berita) ? 'Edit Data Kejadian' : 'Tambah Berita Baru' }}</h1>
                    <p>Lengkapi formulir di bawah ini dengan informasi kejadian yang valid.</p>
                </div>
                <a href="/internal/operator/kelola-berita" class="btn-simerah-outline">
                    <i class="fas fa-arrow-left"></i> Kembali ke Tabel
                </a>
            </div>

            <!-- Alert Validasi Error -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
                    <div class="fw-bold mb-1"><i class="fas fa-triangle-exclamation me-2"></i> Terdapat kesalahan pengisian form:</div>
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-box">
                <form action="{{ isset($berita) ? '/internal/operator/kelola-berita/update/' . $berita->id : '/internal/operator/kelola-berita/store' }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($berita))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Judul Kejadian <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required placeholder="Contoh: Evakuasi Pemotongan Cincin">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Kejadian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', $berita->tanggal_kejadian ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waktu Kejadian <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="waktu_kejadian" value="{{ old('waktu_kejadian', $berita->waktu_kejadian ?? '') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi Kejadian <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $berita->lokasi ?? '') }}" required placeholder="Contoh: Jl. AR. Saleh Lorong Abdi Utama">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pelapor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pelapor" value="{{ old('pelapor', $berita->pelapor ?? '') }}" required placeholder="Contoh: Warga RT. 07">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sumber Informasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sumber_informasi" value="{{ old('sumber_informasi', $berita->sumber_informasi ?? '') }}" required placeholder="Contoh: Melalui Telepon / Aplikasi">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan Singkat (Ringkasan) <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan_singkat" rows="2" required placeholder="Ringkasan singkat untuk tampilan kartu di halaman utama...">{{ old('keterangan_singkat', $berita->keterangan_singkat ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Detail Lengkap Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="detail_lengkap" rows="6" required placeholder="Tuliskan kronologi lengkap kejadian di sini...">{{ old('detail_lengkap', $berita->detail_lengkap ?? '') }}</textarea>
                    </div>

                    <div class="mb-4 upload-box">
                        <label class="form-label mb-2">Foto Dokumentasi (Opsional)</label>
                        @if(isset($berita) && $berita->gambar)
                            <div class="mb-3 d-flex align-items-center gap-3 flex-wrap">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Preview" style="height: 90px; width: 130px; border-radius: var(--r-sm); object-fit: cover; border: 1px solid var(--line-dark);">
                                <span class="text-muted small"><i class="fas fa-circle-info me-1"></i> Foto saat ini. Biarkan kosong jika tidak ingin mengubah foto.</span>
                            </div>
                        @endif
                        <input type="file" class="form-control bg-white" name="gambar" accept=".jpg,.jpeg,.png">
                        <small class="text-muted d-block mt-2"><i class="fas fa-file-image me-1"></i>Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>

                    <hr class="my-4" style="border-color: var(--line);">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/internal/operator/kelola-berita" class="btn-simerah-outline">Batal</a>
                        
                        <!-- TOMBOL SUBMIT HANYA UNTUK OPERATOR DAN SUPER USER -->
                        @hasanyrole('Operator|Super User')
                        <button type="submit" class="btn-simerah-danger">
                            <i class="fas fa-floppy-disk"></i> Simpan Data
                        </button>
                        @endhasanyrole

                    </div>
                </form>
            </div>

        </div>
@endsection
