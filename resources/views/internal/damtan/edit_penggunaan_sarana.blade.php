@extends('layouts.dashboard')

@section('title', 'Edit Penggunaan Sarana')

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
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }

    @media (max-width: 900px) {
        .topbar { padding: 0 16px; }
        .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: var(--shadow-lg); }
        body.side-open .sidebar { transform: none; }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
        body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
    }
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
    .table th { background-color: #f8fafc; color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); letter-spacing: 0.02em; }
    .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
    .table tbody tr:hover { background-color: var(--paper); }
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
    .action-btn.view { background-color: var(--info-soft); color: var(--info); }
    .action-btn.view:hover { background-color: #dbeafe; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; margin: 0 5px; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.25); }
    .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); margin-left: 5px; }
    .action-btn.delete:hover { background-color: #fecaca; }
    .badge-status { display: inline-block; padding: 6px 12px; font-weight: 600; font-size: 0.8rem; border-radius: 6px; }
    .badge-menunggu { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-proses { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .status-select { min-height: 34px; padding: 4px 28px 4px 10px; font-size: .8rem; font-weight: 600; border-radius: 6px; width: auto; min-width: 120px; cursor: pointer; }
    .status-select.s-Menunggu  { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
    .status-select.s-Proses    { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .status-select.s-Disetujui { background-color: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
    .status-select.s-Ditolak   { background-color: #fef2f2; color: #b91c1c; border-color: #fecaca; }
    .form-label { font-size: .85rem; font-weight: 600; color: var(--ink-3); margin-bottom: 6px; }
    .form-section-title { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 1px solid var(--line); }
</style>
@endpush

@section('content')

@php
    // Lampiran: kolom di tabel => label, ikon, format yang diterima (samakan dengan controller & blade formulir)
    $lampiranEdit = [
        'surat_permohonan'  => ['label' => 'Surat Permohonan',              'ikon' => 'fa-envelope-open-text', 'accept' => '.pdf,.jpg,.jpeg,.png,.zip,.rar', 'info' => 'PDF/JPG/PNG/ZIP/RAR, maks 5 MB'],
        'fotokopi_ktp'      => ['label' => 'Fotokopi KTP Penanggung Jawab', 'ikon' => 'fa-id-card',            'accept' => '.pdf,.jpg,.jpeg,.png',          'info' => 'PDF/JPG/PNG, maks 5 MB'],
        'sket_denah_lokasi' => ['label' => 'Sket Denah Lokasi Kegiatan',    'ikon' => 'fa-map-location-dot',   'accept' => '.pdf,.jpg,.jpeg,.png',          'info' => 'PDF/JPG/PNG, maks 5 MB'],
    ];
@endphp

<div class="page-header">
    <div class="page-header-text">
        <h1>Edit Penggunaan Sarana</h1>
        <p>Ubah data permohonan atas nama <strong>{{ $row->nama }}</strong>.</p>
    </div>
    <a href="{{ route('internal.penggunaan-sarana.index') }}" class="btn-custom-light"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali isian Anda:</strong>
        <ul class="mb-0 mt-2 ps-3" style="list-style: disc;">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('internal.penggunaan-sarana.update', $row->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- DATA PEMOHON -->
        <div class="col-lg-6">
            <div class="card-custom p-4 h-100">
                <div class="form-section-title"><i class="fas fa-user me-2"></i>Data Pemohon</div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $row->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" maxlength="16" value="{{ old('nik', $row->nik) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP/WA</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $row->no_hp) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $row->alamat) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Pemohon</label>
                    <select name="jenis_pemohon" class="form-select" required>
                        @foreach(['perorangan' => 'Perorangan', 'fasum' => 'Fasilitas Umum', 'instansi' => 'Instansi'] as $val => $label)
                            <option value="{{ $val }}" {{ old('jenis_pemohon', $row->jenis_pemohon) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Penanggung Jawab</label>
                    <input type="text" name="nama_penanggung_jawab" class="form-control" value="{{ old('nama_penanggung_jawab', $row->nama_penanggung_jawab) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Instansi / Fasilitas Umum / Perorangan</label>
                    <input type="text" name="nama_instansi" class="form-control" value="{{ old('nama_instansi', $row->nama_instansi) }}" required>
                </div>
                <div class="mb-0">
                    <label class="form-label">Alamat Instansi</label>
                    <input type="text" name="alamat_instansi" class="form-control" value="{{ old('alamat_instansi', $row->alamat_instansi) }}" required>
                </div>
            </div>
        </div>

        <!-- DATA KEGIATAN -->
        <div class="col-lg-6">
            <div class="card-custom p-4 h-100">
                <div class="form-section-title"><i class="fas fa-truck-droplet me-2"></i>Data Kegiatan & Sarana</div>

                <div class="mb-3">
                    <label class="form-label">Sarana</label>
                    <select name="sarana" class="form-select" required>
                        @foreach($daftarSarana as $s)
                            <option value="{{ $s }}" {{ old('sarana', $row->sarana) == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kegunaan Sarana</label>
                    <textarea name="kegunaan" rows="3" maxlength="1000" class="form-control" required>{{ old('kegunaan', $row->kegunaan) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $row->nama_kegiatan) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi Kegiatan</label>
                    <input type="text" name="lokasi_kegiatan" class="form-control" value="{{ old('lokasi_kegiatan', $row->lokasi_kegiatan) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Pelaksanaan</label>
                    <input type="date" name="tgl_pelaksanaan" class="form-control" value="{{ old('tgl_pelaksanaan', \Carbon\Carbon::parse($row->tgl_pelaksanaan)->format('Y-m-d')) }}" required>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', substr($row->waktu_mulai, 0, 5)) }}" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', substr($row->waktu_selesai, 0, 5)) }}" required>
                    </div>
                </div>
                <div class="mb-0">
                    <label class="form-label">Status Permohonan</label>
                    <select name="status" class="form-select" required>
                        @foreach($daftarStatus as $st)
                            <option value="{{ $st }}" {{ old('status', $row->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- LAMPIRAN: surat_permohonan, fotokopi_ktp, sket_denah_lokasi -->
        <div class="col-12">
            <div class="card-custom p-4">
                <div class="form-section-title"><i class="fas fa-paperclip me-2"></i>Lampiran Persyaratan Administrasi <small class="text-muted fw-normal">(kosongkan jika tidak ingin mengganti)</small></div>
                <div class="row g-4">
                    @foreach($lampiranEdit as $kolom => $l)
                        <div class="col-md-4">
                            <label class="form-label" for="{{ $kolom }}"><i class="fas {{ $l['ikon'] }} me-1"></i> {{ $l['label'] }} <span class="text-muted fw-normal">({{ $l['info'] }})</span></label>
                            <input type="file" id="{{ $kolom }}" name="{{ $kolom }}" class="form-control @error($kolom) is-invalid @enderror" accept="{{ $l['accept'] }}">
                            @error($kolom)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">
                                @if($row->{$kolom})
                                    File saat ini: <a href="{{ asset('storage/' . $row->{$kolom}) }}" target="_blank" rel="noopener">lihat berkas</a>
                                @else
                                    Belum ada berkas diunggah.
                                @endif
                            </small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn-custom-light" style="background: var(--ink); color: #fff; border-color: var(--ink);">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('internal.penggunaan-sarana.index') }}" class="btn-custom-light">Batal</a>
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