@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@push('styles')
<style>
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-top: 4px;}
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .profile-card, .password-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 26px;
        box-shadow: var(--shadow-xs);
        height: 100%;
        transition: box-shadow .2s ease, border-color .2s ease;
    }
    .profile-card:hover, .password-card:hover {
        box-shadow: var(--shadow-sm);
        border-color: #d2dae5;
    }
    .card-title-custom {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 22px; padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
        font-family: var(--font-display);
        font-size: 1.05rem; font-weight: 700; color: var(--ink);
    }
    .card-title-custom::before {
        content: ""; width: 4px; height: 18px;
        background: var(--navy); border-radius: 4px;
    }
    .profile-avatar-large {
        width: 68px; height: 68px;
        border-radius: 50%;
        background: var(--navy-soft);
        color: var(--navy);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 22px;
    }
    .info-group { margin-bottom: 16px; }
    .info-group:last-child { margin-bottom: 0; }
    .info-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-bottom: 3px; }
    .info-value { font-size: .95rem; font-weight: 600; color: var(--ink); word-break: break-word; }
    .badge-role {
        display: inline-flex; align-items: center;
        padding: 5px 12px; border-radius: 6px;
        font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em;
    }
    .badge-role.super_user { background: var(--ink); color: #fff; }
    .badge-role.operator { background: var(--info-soft); color: var(--info); }
    .badge-role.damtan { background: rgba(220, 53, 69, .15); color: #b42332; }
    .badge-role.sapra { background: rgba(25, 135, 84, .15); color: #198754; }
    .badge-role.pencegahan { background: rgba(244, 183, 64, .15); color: #d97706; }
    .badge-role.sekretariat { background: var(--navy-soft); color: var(--navy); }
    .badge-role.user { background: var(--navy-soft); color: var(--navy); }
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .input-group-text { background: var(--paper); border-color: var(--line-dark); color: var(--steel); border-radius: 8px 0 0 8px; }
    .form-control {
        min-height: 44px; font-size: .92rem;
        border: 1px solid var(--line-dark);
        border-radius: 0 8px 8px 0; color: var(--ink);
        box-shadow: none; transition: all .2s ease;
    }
    .form-control:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .form-control::placeholder { color: var(--steel-soft); }
    .btn-update {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        min-height: 44px; padding: 0 20px;
        background: var(--navy); color: #fff;
        border: none; border-radius: 8px;
        font-size: .9rem; font-weight: 600;
        transition: all .2s ease; width: 100%;
    }
    .btn-update:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-update:active { transform: translateY(0); }
    .alert-error {
        background: var(--signal-soft); color: var(--signal-dark);
        border: 1px solid rgba(220, 53, 69, .2);
        border-radius: var(--r-sm);
        padding: 14px 16px; margin-bottom: 20px;
        font-size: .88rem; font-weight: 500;
    }
    .alert-error ul { margin-top: 6px; margin-bottom: 0; padding-left: 20px; line-height: 1.5; }
    @media (max-width: 700px) {
        .profile-card, .password-card { padding: 20px; }
        .card-title-custom { font-size: 1rem; }
    }
    @media print {
        .topbar, .sidebar { display: none !important; }
        .content { padding: 0; background: white; }
        .profile-card, .password-card { box-shadow: none; border: 1px solid #ddd; }
    }
</style>
@endpush

@section('content')

        <div class="page-head">
            <h1>Profil Pengguna</h1>
            <p>Kelola informasi akun dan kata sandi Anda di sini.</p>
        </div>

        <div class="row g-4">
            <!-- INFORMASI AKUN -->
            <div class="col-md-5">
                <div class="profile-card">
                    <div class="card-title-custom">
                        Informasi Akun
                    </div>

                    <div class="profile-avatar-large">
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">{{ Auth::user()->nama_lengkap }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">NIP / Nomor Pegawai</div>
                        <div class="info-value">{{ Auth::user()->nomor_pegawai }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Email Terdaftar</div>
                        <div class="info-value">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Hak Akses Sistem</div>
                        <div class="info-value">
                            @php
                                $roleName = Auth::user()->role ?? (Auth::user()->getRoleNames()->first() ?? 'user');
                                $roleClass = strtolower(str_replace(' ', '_', $roleName));
                            @endphp
                            <span class="badge-role {{ $roleClass }}">
                                {{ $roleName === 'user' 
                                    ? 'Pegawai Internal' 
                                    : ucwords(str_replace('_', ' ', $roleName)) 
                                }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- UBAH KATA SANDI -->
            <div class="col-md-7">
                <div class="password-card">
                    <div class="card-title-custom">
                        Ubah Kata Sandi
                    </div>

                    @if($errors->any())
                        <div class="alert-error">
                            <div>
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Terdapat kesalahan:</strong>
                            </div>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/internal/profil/update-password" method="POST">
                        @csrf
                        <!-- Password Lama -->
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                <input type="password" name="password_lama" class="form-control" placeholder="Masukkan password lama Anda" required>
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password_baru" class="form-control" placeholder="Minimal 6 karakter" required>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                <input type="password" name="password_baru_confirmation" class="form-control" placeholder="Ketik ulang password baru" required>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i> Simpan Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
@endsection
