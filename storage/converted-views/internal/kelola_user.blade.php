@extends('layouts.dashboard')

@section('title', 'Kelola Pengguna')

@push('styles')
<style>
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-top: 4px; }
    .page-head { margin-bottom: 0; }
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
    .table { margin-bottom: 0; min-width: 850px; }
    .table thead th {
        background: var(--paper); color: var(--steel);
        font-size: .75rem; font-weight: 700;
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
    .super_user { background: var(--ink); color: #fff; }
    .operator { background: var(--info-soft); color: var(--info); }
    .damtan { background: rgba(220, 53, 69, .15); color: #b42332; }
    .sapra { background: rgba(25, 135, 84, .15); color: #198754; }
    .pencegahan { background: rgba(244, 183, 64, .15); color: #d97706; }
    .sekretariat { background: var(--navy-soft); color: var(--navy); }
    .btn-action {
        width: 34px; height: 34px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; font-size: .9rem;
        transition: all .2s ease;
    }
    .btn-edit { background: var(--info-soft); color: var(--info); }
    .btn-edit:hover { background: var(--info); color: white; }
    .btn-delete { background: var(--signal-soft); color: var(--signal); }
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
    .modal-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: white; }
    .modal-body { padding: 24px !important; }
    .modal-footer {
        background: var(--paper);
        border-top: 1px solid var(--line);
        padding: 16px 24px;
    }
    .modal .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .modal .form-control, .modal .form-select {
        min-height: 42px; font-size: .92rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px; color: var(--ink);
        box-shadow: none; transition: all .2s ease;
    }
    .modal .form-control:focus, .modal .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .modal .form-text { font-size: .82rem; color: var(--steel); margin-top: 6px; }
    .modal .btn { min-height: 40px; padding: 0 18px; border-radius: 8px; font-size: .88rem; font-weight: 600; }
    .modal .btn-secondary { background: var(--line); color: var(--ink); border: none; }
    .modal .btn-secondary:hover { background: var(--line-dark); }
    .modal .btn-primary { background: var(--navy); color: white; border: none; }
    .modal .btn-primary:hover { background: var(--navy-dark); }
    .alert-info {
        background: var(--info-soft) !important;
        color: var(--info) !important;
        border: 1px solid rgba(37, 99, 235, .2);
        border-radius: 8px; font-size: .88rem;
    }
    .alert-info strong { color: var(--ink); }
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
        .d-flex.justify-content-between.mb-4 { flex-direction: column; align-items: flex-start !important; gap: 16px; }
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
@section('content')

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="page-head">
                <h1>Kelola Pengguna</h1>
                <p>Manajemen akses dan daftar anggota internal SIMERAH KOJA.</p>
            </div>

            <!-- TOMBOL TAMBAH USER HANYA UNTUK SUPER USER -->
            @hasrole('Super User')
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus"></i> Tambah User Baru
            </button>
            @endhasrole
        </div>

        <!-- VALIDATION ERROR -->
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

        <!-- USER TABLE -->
        <div class="content-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Lengkap</th>
                            <th>NIP / No Pegawai</th>
                            <th>Email</th>
                            <th>Hak Akses (Role)</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $u)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $u->nama_lengkap }}</td>
                                <td>{{ $u->nomor_pegawai }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    <span class="badge-role {{ strtolower(str_replace(' ', '_', $u->role)) }}">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- TOMBOL EDIT & HAPUS HANYA UNTUK SUPER USER -->
                                        @hasrole('Super User')
                                        <button type="button" class="btn-action btn-edit" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $u->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="/internal/kelola-user/hapus/{{ $u->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $u->nama_lengkap }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Akun">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endhasrole
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT USER HANYA UNTUK SUPER USER -->
                            @hasrole('Super User')
                            <div class="modal fade" id="editUserModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-user-edit me-2"></i> Edit Pengguna
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="/internal/kelola-user/update/{{ $u->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <!-- Nama -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $u->nama_lengkap }}" required>
                                                </div>

                                                <!-- NIP -->
                                                <div class="mb-3">
                                                    <label class="form-label">NIP / Nomor Kepegawaian</label>
                                                    <input type="text" name="nomor_pegawai" class="form-control" value="{{ $u->nomor_pegawai }}" required>
                                                </div>

                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $u->email }}" required>
                                                </div>

                                                <!-- Role -->
                                                <div class="mb-3">
                                                    <label class="form-label">Pilih Hak Akses (Role)</label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="Super User" {{ $u->role == 'Super User' ? 'selected' : '' }}>Super User (Admin Penuh)</option>
                                                        <option value="Sapra" {{ $u->role == 'Sapra' ? 'selected' : '' }}>Sapra (Sarana Prasarana)</option>
                                                        <option value="Damtan" {{ $u->role == 'Damtan' ? 'selected' : '' }}>Damtan (Pemadaman & Penyelamatan)</option>
                                                        <option value="Pencegahan" {{ $u->role == 'Pencegahan' ? 'selected' : '' }}>Pencegahan (Inspeksi & Redkar)</option>
                                                        <option value="Sekretariat" {{ $u->role == 'Sekretariat' ? 'selected' : '' }}>Sekretariat (Kepegawaian)</option>
                                                        <option value="Operator" {{ $u->role == 'Operator' ? 'selected' : '' }}>Operator (Manajemen Informasi)</option>
                                                    </select>
                                                </div>

                                                <!-- Password -->
                                                <div class="mb-1">
                                                    <label class="form-label">Password Baru (Opsional)</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                                    <div class="form-text">Isi hanya jika ingin mereset password pengguna ini secara paksa.</div>
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
                            @endhasrole
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

<!-- MODAL TAMBAH USER HANYA UNTUK SUPER USER -->
@hasrole('Super User')
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/internal/kelola-user/tambah" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required placeholder="Contoh: Budi Santoso">
                    </div>

                    <!-- NIP -->
                    <div class="mb-3">
                        <label class="form-label">NIP / Nomor Kepegawaian</label>
                        <input type="text" name="nomor_pegawai" class="form-control" required placeholder="Masukkan NIP">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="email@contoh.com">
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label class="form-label">Pilih Hak Akses (Role)</label>
                        <select name="role" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Hak Akses --</option>
                            <option value="Super User">Super User (Admin Penuh)</option>
                            <option value="Sapra">Sapra (Sarana Prasarana)</option>
                            <option value="Damtan">Damtan (Pemadaman & Penyelamatan)</option>
                            <option value="Pencegahan">Pencegahan (Inspeksi & Redkar)</option>
                            <option value="Sekretariat">Sekretariat (Kepegawaian)</option>
                            <option value="Operator">Operator (Manajemen Informasi)</option>
                        </select>
                    </div>

                    <!-- Password Default Info -->
                    <div class="alert alert-info py-3 mb-0 border-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Password default akun baru adalah: <strong>Damkar123</strong>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endhasrole

<!-- Bootstrap JS -->
@endsection
