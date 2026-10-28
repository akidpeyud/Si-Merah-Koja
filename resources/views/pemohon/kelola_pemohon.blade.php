@extends('layouts.dashboard')

@section('title', 'Kelola Akun Pemohon')

@push('styles')
<style>
    .toast-wrap {
        position: fixed; z-index: 2000; top: 18px; left: 50%;
        transform: translateX(-50%); display: grid; gap: 10px;
        width: max-content; max-width: calc(100vw - 24px);
    }
    .toast-custom {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 12px 12px 16px; border-radius: 999px;
        background: #ffffff; border: 1px solid var(--line);
        box-shadow: var(--shadow-md); font-weight: 600; font-size: .92rem;
        animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
    }
    .toast-custom.leaving { animation: toastOut .3s ease forwards; }
    .toast-custom.ok .toast-ico { background: var(--success); }
    .toast-custom.err .toast-ico { background: var(--signal); }
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 26px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.5rem, 2.5vw, 1.8rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .content-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 24px;
        box-shadow: var(--shadow-xs);
        overflow: hidden;
    }
    .btn-add {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 42px; padding: 0 18px;
        background: var(--navy); color: #fff;
        border: none; border-radius: 8px;
        font-size: .9rem; font-weight: 600;
        transition: all .2s ease;
    }
    .btn-add:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-add:active { transform: translateY(0); }
    .table-responsive { overflow-x: auto; }
    .table { margin-bottom: 0; min-width: 850px; border-collapse: collapse; width: 100%;}
    .table thead th {
        background: var(--paper); color: var(--steel);
        font-size: .75rem; font-weight: 700; text-align: left;
        text-transform: uppercase; letter-spacing: .04em;
        padding: 14px 16px; border-bottom: 1px solid var(--line);
        white-space: nowrap;
    }
    .table tbody td {
        padding: 14px 16px; vertical-align: middle;
        color: var(--ink); font-size: .9rem; font-weight: 500;
        border-bottom: 1px solid var(--line);
    }
    .table tbody tr { transition: background .15s ease; }
    .table tbody tr:hover { background: var(--paper); }
    .table tbody tr:last-child td { border-bottom: none; }
    .table .fw-bold { font-weight: 700 !important; color: var(--ink); }
    .badge-role {
        display: inline-flex; align-items: center;
        padding: 5px 12px; border-radius: 6px;
        font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em;
    }
    .badge-role.pemohon { background: var(--info-soft); color: var(--info); border: 1px solid rgba(37, 99, 235, .15); }
    .btn-action {
        width: 34px; height: 34px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; font-size: .9rem;
        transition: all .2s ease;
    }
    .btn-edit { background: var(--info-soft); color: var(--info); }
    .btn-edit:hover { background: var(--info); color: white; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: white; }
    .modal-content {
        border: 1px solid var(--line) !important;
        border-radius: var(--r-md) !important;
        overflow: hidden;
        box-shadow: var(--shadow-lg) !important;
    }
    .modal-header {
        background: var(--ink) !important;
        border-bottom: none !important;
        padding: 18px 24px;
    }
    .modal-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: white; display: flex; align-items: center;}
    .modal-body { padding: 24px !important; background: var(--paper); }
    .modal-footer {
        background: #fff;
        border-top: 1px solid var(--line);
        padding: 16px 24px;
    }
    .card-inner { background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; }
    .section-title { font-size: .85rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--navy); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .modal .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; display: block;}
    .modal .form-control, .modal .form-select {
        min-height: 42px; font-size: .92rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px; color: var(--ink);
        box-shadow: none; transition: all .2s ease; width: 100%;
    }
    .modal .form-control:focus, .modal .form-select:focus {
        border-color: var(--navy); outline: none;
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .modal .form-text { font-size: .82rem; color: var(--steel); margin-top: 6px; }
    .modal .btn { min-height: 40px; padding: 0 18px; border-radius: 8px; font-size: .88rem; font-weight: 600; }
    .modal .btn-secondary { background: var(--line); color: var(--ink); border: none; transition: .2s;}
    .modal .btn-secondary:hover { background: var(--line-dark); }
    .modal .btn-primary { background: var(--navy); color: white; border: none; transition: .2s; }
    .modal .btn-primary:hover { background: var(--navy-dark); }
    .alert-error {
        background: var(--signal-soft); color: var(--signal-dark);
        border: 1px solid rgba(220, 53, 69, .2);
        border-radius: var(--r-sm);
        padding: 14px 16px; margin-bottom: 20px;
        font-size: .88rem; font-weight: 500;
    }
    .alert-error ul { margin-top: 6px; margin-bottom: 0; padding-left: 20px; line-height: 1.5; }
    @media (max-width: 767px) {
        .content { padding: 20px 16px 60px; }
        .page-head h1 { font-size: 1.5rem; }
        .content-card { padding: 16px; }
        .page-head { flex-direction: column; align-items: flex-start !important; gap: 16px; }
        .btn-add { width: 100%; }
    }
    @media print {
        .topbar, .sidebar, .btn-add, .btn-action, .modal { display: none !important; }
        .content { padding: 0; background: white; }
        .content-card { box-shadow: none; border: 1px solid #ddd; padding: 0; }
    }
</style>
@endpush

@section('content')
        <!-- HEADER -->
        <div class="page-head">
            <div>
                <h1>Kelola Akun Pemohon</h1>
                <p>Manajemen data akun masyarakat atau perusahaan yang terdaftar di sistem.</p>
            </div>
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addPemohonModal">
                <i class="fas fa-plus"></i> Tambah Akun Manual
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 8px;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 8px;">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <div>
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Gagal memproses data:</strong>
                </div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- TABLE -->
        <div class="content-card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>NIK (16 Digit)</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. WhatsApp</th>
                            <th>Role</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $pemohons = $pemohons ?? [];
                        @endphp
                        
                        @forelse($pemohons as $index => $pemohon)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $pemohon->nik }}</td>
                                <td class="fw-bold">{{ $pemohon->nama_lengkap }}</td>
                                <td>{{ $pemohon->email }}</td>
                                <td>{{ $pemohon->no_whatsapp }}</td>
                                <td>
                                    <span class="badge-role pemohon">
                                        {{ ucfirst($pemohon->role ?? 'Pemohon') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- EDIT BUTTON -->
                                        <button type="button" class="btn-action btn-edit" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editPemohonModal{{ $pemohon->id ?? $index }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- DELETE BUTTON -->
                                        <form action="/internal/kelola-pemohon/hapus/{{ $pemohon->id ?? '' }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pemohon ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Akun">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-users-slash mb-2" style="font-size: 1.5rem; opacity: 0.5;"></i><br>
                                    Belum ada data akun pemohon yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==================== MODAL EDIT PEMOHON (DILUAR TABEL) ==================== -->
        @foreach($pemohons as $index => $pemohon)
            <div class="modal fade" id="editPemohonModal{{ $pemohon->id ?? $index }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-user-edit me-2"></i> Edit Akun Pemohon
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="/internal/kelola-pemohon/update/{{ $pemohon->id ?? '' }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-inner">
                                    
                                    <div class="section-title"><i class="fas fa-id-card"></i> Identitas Pemohon</div>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">NIK (16 Digit) <span class="text-danger">*</span></label>
                                            <input type="text" name="nik" class="form-control" value="{{ $pemohon->nik }}" required maxlength="16">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Lengkap Pemohon <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_lengkap" class="form-control" value="{{ $pemohon->nama_lengkap }}" required>
                                        </div>
                                    </div>

                                    <div class="section-title"><i class="fas fa-address-book"></i> Informasi Kontak & Akses</div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" value="{{ $pemohon->email }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" name="no_whatsapp" class="form-control" value="{{ $pemohon->no_whatsapp }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Role Akun</label>
                                            <select name="role" class="form-select">
                                                <option value="pemohon" selected>Pemohon</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Password Akses Baru</label>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                                            <div class="form-text">Minimal 8 karakter.</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

<!-- ==================== MODAL TAMBAH PEMOHON (DILUAR LOOP) ==================== -->
<div class="modal fade" id="addPemohonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i> Tambah Akun Pemohon
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/internal/kelola-pemohon/tambah" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-inner">
                        
                        <div class="section-title"><i class="fas fa-id-card"></i> Identitas Pemohon</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">NIK (16 Digit) <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control" required maxlength="16" placeholder="Contoh: 150xxxxxxxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap Pemohon <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control" required placeholder="Sesuai KTP">
                            </div>
                        </div>

                        <div class="section-title"><i class="fas fa-address-book"></i> Informasi Kontak & Akses</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required placeholder="contoh@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_whatsapp" class="form-control" required placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role Akun</label>
                                <select name="role" class="form-select">
                                    <option value="pemohon" selected>Pemohon</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password Akses <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
@endsection
