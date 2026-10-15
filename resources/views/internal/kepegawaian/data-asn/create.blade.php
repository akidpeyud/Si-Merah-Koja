@extends('layouts.dashboard')

@section('title', 'Tambah Data ASN')

@push('styles')
<style>
    :root { --ink: #0d1b2a; --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --paper: #f5f7fa; --line: #e2e8f0; --line-dark: #d5dce6; --font-display: 'Bricolage Grotesque', system-ui, sans-serif; --font-body: 'Instrument Sans', system-ui, sans-serif; --topbar-h: 70px; --sidebar-w: 288px; }
    body { font-family: var(--font-body); font-size: 1rem; line-height: 1.6; color: var(--ink); background: var(--paper); }
    .toast-wrap { position: fixed; z-index: 200; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #fff; border: 1px solid var(--line); box-shadow: 0 10px 25px rgba(13, 27, 42, .08); font-weight: 600; font-size: .92rem; }
    .toast.ok .toast-ico { background: #198754; }
    .toast.err .toast-ico { background: #dc3545; }
    .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); border: none; cursor: pointer; }
    .topbar { position: sticky; top: 0; z-index: 60; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); }
    .side-toggle { display: none; width: 40px; height: 40px; border-radius: 10px; align-items: center; justify-content: center; font-size: 1.05rem; color: #fff; }
    .brand { display: flex; align-items: center; gap: 12px; color: #fff; }
    .brand img { height: 34px; }
    .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; }
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); color: #fff; }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-weight: 700; }
    .user-meta strong { display: block; font-size: .84rem; font-weight: 700; }
    .user-meta small { font-size: .72rem; color: rgba(255,255,255,.62); }
    .btn-logout { display: flex; align-items: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; border: none; cursor: pointer; }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-link { display: flex; align-items: flex-start; gap: 14px; padding: 11px 14px; border-radius: 10px; font-size: .89rem; font-weight: 600; color: var(--ink); margin-bottom: 4px; transition: background .2s, color .2s; }
    .side-link:hover { background: #f3f6fa; }
    .side-link.active { background: var(--ink); color: #fff; }
    .side-link i { width: 20px; text-align: center; font-size: 1rem; color: #64748b; margin-top: 3px; }
    .side-link.active i { color: #fff; }
    .side-group summary { display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: .78rem; font-weight: 700; text-transform: uppercase; color: var(--navy); cursor: pointer; list-style: none; transition: background .2s; }
    .side-group summary .grp-ico { width: 20px; text-align: center; font-size: .95rem; margin-top: 3px; }
    .side-group summary .chev { margin-left: auto; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .side-sub a { display: flex; align-items: flex-start; gap: 12px; padding: 9px 10px; border-radius: 10px; font-size: .84rem; font-weight: 500; color: #64748b; transition: background .2s, color .2s; }
    .side-sub a:hover { background: var(--navy-light); color: var(--navy-dark); }
    .side-sub a.active { background: rgba(22, 58, 99, .08); color: var(--navy); font-weight: 600; }
    .side-sub a i { width: 18px; text-align: center; font-size: .88rem; opacity: .75; margin-top: 3px; }
    .side-kicker { padding: 18px 14px 6px; font-size: .68rem; font-weight: 700; text-transform: uppercase; color: #94a3b8; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: 2.1rem; color: var(--ink); }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head mb-4">
            <h1 class="mb-1">Tambah Data ASN</h1>
            <p class="text-muted">Tambahkan rekapitulasi jumlah pegawai PNS dan PPPK berdasarkan jabatan.</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('data-asn.store') }}" method="POST">
                    @csrf

                    <!-- BLOK NAMA JABATAN -->
                    @php
                        $default_jabatan = [
                            'STRUKTURAL',
                            'ANALIS KEBAKARAN AHLI MUDA',
                            'ARSIPARIS AHLI PERTAMA',
                            'ANALIS KEBAKARAN AHLI PERTAMA',
                            'PEMADAM KEBAKARAN MAHIR',
                            'PEMADAM KEBAKARAN TERAMPIL',
                            'PEMADAM KEBAKARAN PEMULA',
                            'PENELAAH TEKNIS KEBIJAKAN',
                            'PENATA LAYANAN OPERASIONAL',
                            'PENGADMINISTRASI PERKANTORAN'
                        ];
                        
                        $db_jabatan = \App\Models\DataAsn::select('nama_jabatan')->distinct()->pluck('nama_jabatan')->toArray();
                        $jabatan_list = array_unique(array_merge($default_jabatan, $db_jabatan));
                        
                        $old_jabatan = old('nama_jabatan');
                        if ($old_jabatan && !in_array($old_jabatan, $jabatan_list)) {
                            $jabatan_list[] = $old_jabatan;
                        }
                        
                        sort($jabatan_list);
                    @endphp

                    <!-- MODE DROPDOWN -->
                    <div class="mb-4" id="dropdown_mode">
                        <label for="select_nama_jabatan" class="form-label fw-bold" style="color: var(--ink);">
                            Nama Jabatan <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-control-lg @error('nama_jabatan') is-invalid @enderror" 
                                id="select_nama_jabatan" 
                                name="nama_jabatan" 
                                style="font-size: 0.95rem; border-radius: 8px;"
                                required autofocus
                                onchange="toggleJabatanMode(this)">
                            <option value="" disabled {{ $old_jabatan ? '' : 'selected' }}>-- Pilih Nama Jabatan --</option>
                            @foreach($jabatan_list as $jabatan)
                                <option value="{{ $jabatan }}" {{ $old_jabatan == $jabatan ? 'selected' : '' }}>
                                    {{ $jabatan }}
                                </option>
                            @endforeach
                            <!-- Opsi Pemicu Tambah Baru -->
                            <option value="LAINNYA" class="fw-bold text-primary">&#43; Tambah Jabatan Baru...</option>
                        </select>
                        @error('nama_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- MODE TEXT INPUT -->
                    <div class="mb-4" id="text_mode" style="display: none;">
                        <label for="input_nama_jabatan" class="form-label fw-bold" style="color: var(--ink);">
                            Ketik Nama Jabatan Baru <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" id="input_nama_jabatan" style="font-size: 0.95rem; text-transform: uppercase;">
                            <button class="btn btn-outline-secondary" type="button" onclick="cancelJabatanMode()" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                <i class="fas fa-times"></i> Batal
                            </button>
                        </div>
                        <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Jabatan ini akan otomatis tersimpan di pilihan dropdown untuk input selanjutnya.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="pns" class="form-label fw-bold" style="color: var(--ink);">Jumlah PNS <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg @error('pns') is-invalid @enderror" id="pns" name="pns" value="{{ old('pns', 0) }}" min="0" style="font-size: 0.95rem; border-radius: 8px;" required>
                            @error('pns') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="pppk" class="form-label fw-bold" style="color: var(--ink);">Jumlah PPPK <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg @error('pppk') is-invalid @enderror" id="pppk" name="pppk" value="{{ old('pppk', 0) }}" min="0" style="font-size: 0.95rem; border-radius: 8px;" required>
                            @error('pppk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: var(--line);">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn px-4 py-2 fw-semibold text-white" style="background-color: var(--navy); border-radius: 8px;">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                        <a href="{{ route('data-asn.index') }}" class="btn btn-light px-4 py-2 fw-semibold border" style="border-radius: 8px; color: #64748b;">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('scripts')
<script>
    // JS Handle Dropdown ke Text Input
    function toggleJabatanMode(selectObj) {
        if(selectObj.value === 'LAINNYA') {
            document.getElementById('dropdown_mode').style.display = 'none';
            selectObj.removeAttribute('name'); 
            
            document.getElementById('text_mode').style.display = 'block';
            let input = document.getElementById('input_nama_jabatan');
            input.setAttribute('name', 'nama_jabatan'); 
            input.focus();
        }
    }

    function cancelJabatanMode() {
        document.getElementById('text_mode').style.display = 'none';
        let input = document.getElementById('input_nama_jabatan');
        input.removeAttribute('name');
        input.value = '';

        document.getElementById('dropdown_mode').style.display = 'block';
        let select = document.getElementById('select_nama_jabatan');
        select.setAttribute('name', 'nama_jabatan');
        select.value = ''; 
    }

    // JS Sidebar & Toast
    (function () {
        'use strict';
        document.querySelectorAll('[data-toast]').forEach(function (t) {
            var hide = function () { t.classList.add('leaving'); setTimeout(function () { t.remove(); }, 350); };
            var x = t.querySelector('[data-toast-close]');
            if (x) x.addEventListener('click', hide);
            setTimeout(hide, 4500);
        });

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
