@extends('layouts.dashboard')

@section('title', 'Edit Data Event Keramaian')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
                --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
                --paper: #f5f7fa; --white: #ffffff;
                --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
                --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
                --steel: #64748b; --steel-soft: #94a3b8;
                --line: #e2e8f0; --line-dark: #cbd5e1;
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
                --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
                --sidebar-w: 272px; --topbar-h: 70px;
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; }
    .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::placeholder { color: var(--steel-soft); }
    .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .form-label { font-size: .85rem; font-weight: 600; color: var(--ink-3); margin-bottom: 6px; }
    .form-section-title { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 1px solid var(--line); }
</style>
@endpush

@section('content')
@section('content')

<div class="page-header">
    <div class="page-header-text">
        <h1>Edit Data Event Keramaian</h1>
        <p>Ubah data permohonan atas nama <strong>{{ $permohonan->nama }}</strong>.</p>
    </div>
    <a href="{{ route('internal.izin-keramaian.index') }}" class="btn-custom-light"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali isian Anda:</strong>
        <ul class="mb-0 mt-2 ps-3" style="list-style: disc;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('internal.izin-keramaian.update', $permohonan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- 1. DATA PEMOHON -->
        <div class="col-lg-6">
            <div class="card-custom p-4 h-100">
                <div class="form-section-title"><i class="fas fa-user me-2"></i>Data Pemohon</div>

                <div class="mb-3">
                    <label class="form-label">Nama Pemohon</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $permohonan->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" maxlength="16" value="{{ old('nik', $permohonan->nik) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP/WA</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $permohonan->no_hp) }}" required>
                </div>
                <div class="mb-0">
                    <label class="form-label">Alamat Lengkap</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $permohonan->alamat) }}" required>
                </div>
            </div>
        </div>

        <!-- 2. DATA USAHA -->
        <div class="col-lg-6">
            <div class="card-custom p-4 h-100">
                <div class="form-section-title"><i class="fas fa-building me-2"></i>Data Usaha</div>

                <div class="mb-3">
                    <label class="form-label">Nama Direktur</label>
                    <input type="text" name="nama_direktur" class="form-control" value="{{ old('nama_direktur', $permohonan->nama_direktur) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Usaha</label>
                    <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $permohonan->nama_usaha) }}" required>
                </div>
                <div class="mb-0">
                    <label class="form-label">No Izin Usaha</label>
                    <input type="text" name="no_izin_usaha" class="form-control" value="{{ old('no_izin_usaha', $permohonan->no_izin_usaha) }}" required>
                </div>
            </div>
        </div>

        <!-- 3. DATA ACARA & PERALATAN -->
        <div class="col-12">
            <div class="card-custom p-4">
                <div class="form-section-title"><i class="fas fa-users-rectangle me-2"></i>Data Acara & Peralatan</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Acara</label>
                        <input type="text" name="nama_acara" class="form-control" value="{{ old('nama_acara', $permohonan->nama_acara) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lokasi Acara</label>
                        <input type="text" name="lokasi_acara" class="form-control" value="{{ old('lokasi_acara', $permohonan->lokasi_acara) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tgl Pelaksanaan</label>
                        <input type="date" name="tgl_pelaksanaan" class="form-control" value="{{ old('tgl_pelaksanaan', \Carbon\Carbon::parse($permohonan->tgl_pelaksanaan)->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', substr($permohonan->waktu_mulai, 0, 5)) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', substr($permohonan->waktu_selesai, 0, 5)) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Penonton</label>
                        <input type="number" name="jumlah_penonton" class="form-control" value="{{ old('jumlah_penonton', $permohonan->jumlah_penonton) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah APAR</label>
                        <input type="number" name="jumlah_apar" class="form-control" value="{{ old('jumlah_apar', $permohonan->jumlah_apar) }}" min="8" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Staff</label>
                        <input type="number" name="jumlah_staff" class="form-control" value="{{ old('jumlah_staff', $permohonan->jumlah_staff) }}" min="4" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. LAMPIRAN -->
        <div class="col-12">
            <div class="card-custom p-4">
                <div class="form-section-title"><i class="fas fa-paperclip me-2"></i>Lampiran <small class="text-muted fw-normal">(kosongkan jika tidak ingin mengganti)</small></div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Foto Lokasi Acara (JPG/PNG, maks 5 MB)</label>
                        <input type="file" name="foto_lokasi" class="form-control" accept=".jpg,.jpeg,.png">
                        @if(!empty($permohonan->foto_lokasi))
                            <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $permohonan->foto_lokasi) }}" target="_blank">lihat foto</a></small>
                        @else
                            <small class="text-muted">Belum ada file yang diunggah.</small>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Surat Permohonan (PDF/JPG/PNG, maks 5 MB)</label>
                        <input type="file" name="surat_permohonan" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        @if(!empty($permohonan->surat_permohonan))
                            <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $permohonan->surat_permohonan) }}" target="_blank">lihat surat</a></small>
                        @else
                            <small class="text-muted">Belum ada file yang diunggah.</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn-custom-light" style="background: var(--ink); color: #fff; border-color: var(--ink);">
            <i class="fas fa-save"></i> Simpan Perubahan Data
        </button>
        <a href="{{ route('internal.izin-keramaian.index') }}" class="btn-custom-light">Batal</a>
    </div>
</form>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';
        /* Sidebar Toggle */
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

        /* Accordion Sidebar */
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
