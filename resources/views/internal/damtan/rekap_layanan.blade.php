@extends('layouts.dashboard')

@section('title', 'Input Rekap Layanan & Penyelamatan')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --ink-2: #132a43;
                --ink-3: #1d3856;
    
                --navy: #163a63;
                --navy-dark: #0d2947;
                --navy-light: #eaf1f8;
                --navy-soft: rgba(22, 58, 99, .08);
    
                --paper: #f5f7fa;
                --white: #ffffff;
    
                --signal: #dc3545;
                --signal-dark: #b42332;
                --signal-soft: rgba(220, 53, 69, .09);
    
                --amber: #f4b740;
                --success: #198754;
                --info: #2563eb;
                --info-soft: rgba(37, 99, 235, .09);
    
                --steel: #64748b;
                --steel-soft: #94a3b8;
    
                --line: #e2e8f0;
                --line-dark: #cbd5e1;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 18px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 272px;
                --topbar-h: 70px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    .toast-wrap { position: fixed; z-index: 9999; top: 20px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); pointer-events: none; }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-lg); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; pointer-events: auto; }
    @keyframes toastIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: none; } }
    @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-20px); } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-head { margin-bottom: 26px; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 14px; margin-bottom: 38px; }
    .stat-card { display: flex; flex-direction: column; padding: 18px; background: #fff; border-radius: var(--r-md); border: 1px solid var(--line); text-align: left; transition: box-shadow .2s, border-color .2s, transform .2s; }
    .stat-card:hover { border-color: var(--navy); transform: translateY(-3px); box-shadow: var(--shadow-sm); }
    .stat-card.picked { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    /* Kartu read-only (role selain Damtan & Super User): tidak bisa diklik, tanpa efek hover */
    .stat-card-readonly { cursor: default; }
    .stat-card-readonly:hover { transform: none; box-shadow: none; border-color: var(--line); }
    .stat-ico { width: 40px; height: 40px; border-radius: var(--r-sm); display: grid; place-items: center; font-size: 1rem; margin-bottom: 14px; }
    .stat-title { font-size: .74rem; font-weight: 700; text-transform: uppercase; color: var(--steel); margin-bottom: 6px; }
    .stat-value { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; }
    .ic-red { background: var(--signal-soft); color: var(--signal-dark); }
    .ic-amber { background: rgba(244,183,64,.16); color: #a8700b; }
    .ic-blue { background: var(--info-soft); color: var(--info); }
    .ic-teal { background: rgba(13,148,136,.10); color: #0d9488; }
    .ic-purple { background: rgba(124,58,237,.10); color: #7c3aed; }
    .ic-pink { background: rgba(219,39,119,.10); color: #db2777; }
    .ic-steel { background: #f1f5f9; color: var(--steel); }
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease; margin-bottom: 38px;}
    .card-custom:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .card-header-tabs { background-color: #f8fafc; border-bottom: 1px solid var(--line); padding: 16px 24px 0 24px; border-radius: var(--r-md) var(--r-md) 0 0; }
    .nav-tabs-custom { border-bottom: none; display: flex; gap: 4px; overflow-x: auto; white-space: nowrap; scrollbar-width: none; }
    .nav-tabs-custom::-webkit-scrollbar { display: none; }
    .nav-tabs-custom .nav-item { margin-bottom: -1px; }
    .nav-tabs-custom .nav-link { font-family: var(--font-display); font-weight: 600; font-size: 0.95rem; color: var(--steel); background: transparent; border: 1px solid transparent; border-radius: 8px 8px 0 0; padding: 12px 20px; transition: all 0.2s ease; }
    .nav-tabs-custom .nav-link:hover { color: var(--navy); border-color: transparent transparent var(--line) transparent; }
    .nav-tabs-custom .nav-link.active { color: var(--navy); background: #ffffff; border-color: var(--line) var(--line) #ffffff var(--line); }
    .section-title-block { display: flex; align-items: center; gap: 12px; background: var(--navy-soft); padding: 14px 20px; border-radius: 8px; border-left: 4px solid var(--navy); font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--navy-dark); margin-bottom: 24px; }
    .section-title-block i { font-size: 1.1rem; color: var(--navy); }
    .field-label { font-size: .84rem; font-weight: 700; color: var(--ink-2); margin-bottom: 6px; display: inline-flex; align-items: center; }
    .field-label i { margin-right: 8px; font-size: .85rem; color: var(--steel-soft); }
    .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control:disabled, .form-select:disabled { background-color: #f1f5f9; cursor: not-allowed; opacity: 1; border-color: var(--line); color: var(--steel);}
    .form-control::placeholder { color: var(--steel-soft); }
    .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .btn-custom-primary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff;}
    .btn-custom-primary:active { transform: translateY(0); }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; text-decoration: none; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .highlight-area { background-color: #f8fafc; border: 1px solid var(--line); border-radius: 12px; padding: 24px 20px; margin-bottom: 24px; }
    .tbl { width: 100%; border-collapse: collapse; font-size: .88rem; }
    .tbl th { text-align: left; padding: 12px 18px; color: var(--steel); background: #fbfcfd; border-bottom: 1px solid var(--line); font-weight: 700; text-transform: uppercase; letter-spacing: .04em; font-size: .72rem;}
    .tbl td { padding: 14px 18px; border-bottom: 1px solid var(--line); }
    .tag { display: inline-block; padding: 4px 11px; border-radius: 999px; font-size: .78rem; font-weight: 700; background: var(--navy-soft); color: var(--navy); }
    .aksi { display: flex; align-items: center; gap: 6px; }
    .btn-icon { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; background: var(--signal-soft); color: var(--signal); border: 0; cursor: pointer; transition: background .2s; }
    .btn-icon:hover { background: #fecaca; }
    .btn-icon.edit { background: var(--info-soft); color: var(--info); }
    .btn-icon.edit:hover { background: #bfdbfe; }

    /* Modal edit */
    .edit-modal { position: fixed; inset: 0; z-index: 3000; display: none; align-items: center; justify-content: center; padding: 18px; background: rgba(13,27,42,.55); }
    .edit-modal.open { display: flex; }
    .edit-modal-box { background: #fff; width: 100%; max-width: 640px; max-height: calc(100vh - 36px); overflow-y: auto; border-radius: var(--r-md); box-shadow: var(--shadow-lg); animation: editPop .25s ease; }
    @keyframes editPop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    .edit-modal-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 16px 22px; background: var(--navy-light); border-bottom: 1px solid var(--line); }
    .edit-modal-head h4 { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; display: flex; align-items: center; gap: 10px; margin: 0; }
    .edit-modal-head h4 i { color: var(--navy); }
    .edit-modal-x { background: transparent; border: 0; font-size: 1.1rem; color: var(--steel); cursor: pointer; width: 34px; height: 34px; border-radius: 8px; }
    .edit-modal-x:hover { background: rgba(13,27,42,.06); color: var(--ink); }
    .edit-modal-body { padding: 22px; }
    .edit-modal-foot { display: flex; justify-content: flex-end; gap: 10px; padding: 16px 22px; border-top: 1px solid var(--line); background: #fbfcfd; flex-wrap: wrap; }
</style>
@endpush

@section('content')
@php
    /* HAK AKSES INPUT/EDIT/HAPUS REKAP: hanya Damtan & Super User.
       Role lain tetap bisa membuka halaman ini, tetapi HANYA melihat kartu total
       (tanpa form, tanpa riwayat, tanpa edit/hapus, kartu tidak bisa diklik). */
    $bisaInput = Auth::user()->hasAnyRole(['Damtan', 'Super User']);
@endphp

        <div class="page-head">
            <h1>Input Rekap Layanan &amp; Penyelamatan</h1>
            <p>Data rekapitulasi penanganan kejadian kebakaran dan evakuasi/penyelamatan masyarakat.</p>
        </div>
        
        <div class="stats-grid">
            @foreach($kategori as $key => [$nama, $ikon, $warna])
                @if($bisaInput)
                    <button type="button" class="stat-card" data-pick="{{ $key }}">
                @else
                    <div class="stat-card stat-card-readonly">
                @endif
                        <div class="stat-ico {{ $warna }}"><i class="fas {{ $ikon }}"></i></div>
                        <div class="stat-title">{{ $nama }}</div>
                        <div class="stat-value">{{ number_format($totals[$key] ?? 0, 0, ',', '.') }}</div>
                @if($bisaInput)
                    </button>
                @else
                    </div>
                @endif
            @endforeach
        </div>

@if($bisaInput)
        <div class="card-custom">
            <!-- BOOTSTRAP TABS (Design Baru Terintegrasi ke Card Body) -->
            <div class="card-header-tabs">
                <ul class="nav nav-tabs-custom" id="formTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Tambah Data Layanan</button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4 p-md-5 pt-4">
                <form action="/internal/damtan/rekap-layanan" method="POST" id="rekapForm">
                    @csrf
                    <div class="tab-content" id="formTabsContent">
                        
                        <!-- TAB 1: INFORMASI DASAR -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            
                            <div class="section-title-block">
                                <i class="fas fa-truck-medical"></i> Detail Layanan & Penyelamatan
                            </div>

                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-calendar-alt"></i> Tanggal <span class="text-danger">*</span></label>
                                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                                        @error('tanggal')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tags"></i> Jenis Layanan <span class="text-danger">*</span></label>
                                        <select class="form-select" id="kategori" name="kategori" required>
                                            <option value="">-- Pilih jenis layanan --</option>
                                            @foreach($kategori as $key => [$nama])
                                                <option value="{{ $key }}" {{ old('kategori') === $key ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hashtag"></i> Jumlah Kejadian <span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="jumlah" name="jumlah" class="form-control" value="{{ old('jumlah', 1) }}" required>
                                        @error('jumlah')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-map"></i> Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="Cth: Kota Baru" value="{{ old('kecamatan') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-map-marker-alt"></i> Lokasi / Alamat</label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Cth: Jl. Sultan Thaha, RT 05" value="{{ old('lokasi') }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-align-left"></i> Keterangan Opsional</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Catatan singkat penanganan (opsional)">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                        <button type="reset" class="btn-custom-light me-3">Kosongkan</button>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Rekap
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card-custom">
            <!-- BOOTSTRAP TABS (Design Baru Terintegrasi ke Card Body) -->
            <div class="card-header-tabs">
                <ul class="nav nav-tabs-custom" id="historyTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab"><i class="fas fa-history me-1"></i> Riwayat Input Layanan</button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-0">
                <table class="tbl mb-0">
                    <thead><tr><th>Tanggal</th><th>Jenis Layanan</th><th>Jumlah</th><th>Kecamatan</th><th>Keterangan</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse($riwayat as $r)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                <td><span class="tag">{{ $kategori[$r->kategori][0] ?? $r->kategori }}</span></td>
                                <td><strong>{{ $r->jumlah }}</strong></td>
                                <td>{{ $r->kecamatan ?: '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($r->keterangan ?: '-', 60) }}</td>
                                <td>
                                    <div class="aksi">
                                        <button type="button" class="btn-icon edit" aria-label="Edit" title="Edit"
                                            data-edit
                                            data-id="{{ $r->id }}"
                                            data-tanggal="{{ \Carbon\Carbon::parse($r->tanggal)->format('Y-m-d') }}"
                                            data-kategori="{{ $r->kategori }}"
                                            data-jumlah="{{ $r->jumlah }}"
                                            data-kecamatan="{{ $r->kecamatan }}"
                                            data-lokasi="{{ $r->lokasi }}"
                                            data-keterangan="{{ $r->keterangan }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <form action="/internal/damtan/rekap-layanan/{{ $r->id }}" method="POST" onsubmit="return confirm('Hapus data rekap ini?')" style="margin:0;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-icon" aria-label="Hapus" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-inbox d-block fs-3 mb-2"></i>Belum ada data input. Pilih jenis layanan di atas lalu simpan rekap pertama.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL EDIT -->
        <div class="edit-modal" id="editModal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
            <div class="edit-modal-box">
                <div class="edit-modal-head">
                    <h4 id="editModalTitle"><i class="fas fa-pen-to-square"></i> Edit Data Layanan</h4>
                    <button type="button" class="edit-modal-x" id="editClose" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
                </div>
                <form method="POST" id="editForm" action="">
                    @csrf
                    @method('PUT')
                    <div class="edit-modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label" for="edit_tanggal"><i class="fas fa-calendar-alt"></i> Tanggal <span class="text-danger">*</span></label>
                                <input type="date" id="edit_tanggal" name="tanggal" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label" for="edit_jumlah"><i class="fas fa-hashtag"></i> Jumlah Kejadian <span class="text-danger">*</span></label>
                                <input type="number" min="1" id="edit_jumlah" name="jumlah" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="field-label" for="edit_kategori"><i class="fas fa-tags"></i> Jenis Layanan <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_kategori" name="kategori" required>
                                    <option value="">-- Pilih jenis layanan --</option>
                                    @foreach($kategori as $key => [$nama])
                                        <option value="{{ $key }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label" for="edit_kecamatan"><i class="fas fa-map"></i> Kecamatan</label>
                                <input type="text" id="edit_kecamatan" name="kecamatan" class="form-control" placeholder="Cth: Kota Baru">
                            </div>
                            <div class="col-md-6">
                                <label class="field-label" for="edit_lokasi"><i class="fas fa-map-marker-alt"></i> Lokasi / Alamat</label>
                                <input type="text" id="edit_lokasi" name="lokasi" class="form-control" placeholder="Cth: Jl. Sultan Thaha, RT 05">
                            </div>
                            <div class="col-md-12">
                                <label class="field-label" for="edit_keterangan"><i class="fas fa-align-left"></i> Keterangan Opsional</label>
                                <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="3" placeholder="Catatan singkat penanganan (opsional)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="edit-modal-foot">
                        <button type="button" class="btn-custom-light" id="editCancel">Batal</button>
                        <button type="submit" class="btn-custom-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
@endif
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* Sidebar mobile */
    var toggle = document.getElementById('sideToggle');
    var backdrop = document.getElementById('sideBackdrop');
    function closeSide() { document.body.classList.remove('side-open'); if (toggle) toggle.setAttribute('aria-expanded', 'false'); }
    if (toggle) toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('side-open');
        toggle.setAttribute('aria-expanded', open);
    });
    if (backdrop) backdrop.addEventListener('click', closeSide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

    /* Grup sidebar: hanya satu terbuka */
    var groups = document.querySelectorAll('.side-group');
    groups.forEach(function (g) {
        g.addEventListener('toggle', function () {
            if (g.open) groups.forEach(function (o) { if (o !== g) o.open = false; });
        });
    });

    /* Form hanya ada untuk Damtan & Super User; role lain berhenti di sini */
    var select = document.getElementById('kategori');
    var form = document.getElementById('rekapForm');
    if (!select || !form) return;

    /* Klik kartu total = pilih jenis layanan di form */
    var cards = document.querySelectorAll('[data-pick]');
    cards.forEach(function (c) {
        c.addEventListener('click', function () {
            select.value = c.dataset.pick;
            cards.forEach(function (o) { o.classList.toggle('picked', o === c); });
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(function () { document.getElementById('jumlah').focus(); }, 350);
        });
    });
    select.addEventListener('change', function () {
        cards.forEach(function (o) { o.classList.toggle('picked', o.dataset.pick === select.value); });
    });

    /* Validasi ringan sebelum kirim */
    form.addEventListener('submit', function (e) {
        if (!select.value) { e.preventDefault(); select.focus(); alert('Pilih jenis layanan dulu.'); }
    });

    /* ===== Modal edit ===== */
    var modal = document.getElementById('editModal');
    var editForm = document.getElementById('editForm');
    if (!modal || !editForm) return;

    function openEdit(btn) {
        var d = btn.dataset;
        editForm.action = '/internal/damtan/rekap-layanan/' + d.id;
        document.getElementById('edit_tanggal').value = d.tanggal || '';
        document.getElementById('edit_kategori').value = d.kategori || '';
        document.getElementById('edit_jumlah').value = d.jumlah || 1;
        document.getElementById('edit_kecamatan').value = d.kecamatan || '';
        document.getElementById('edit_lokasi').value = d.lokasi || '';
        document.getElementById('edit_keterangan').value = d.keterangan || '';
        modal.classList.add('open');
        setTimeout(function () { document.getElementById('edit_jumlah').focus(); }, 100);
    }
    function closeEdit() { modal.classList.remove('open'); }

    document.querySelectorAll('[data-edit]').forEach(function (b) {
        b.addEventListener('click', function () { openEdit(b); });
    });
    document.getElementById('editClose').addEventListener('click', closeEdit);
    document.getElementById('editCancel').addEventListener('click', closeEdit);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeEdit(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeEdit(); });

    editForm.addEventListener('submit', function (e) {
        if (!document.getElementById('edit_kategori').value) {
            e.preventDefault();
            document.getElementById('edit_kategori').focus();
            alert('Pilih jenis layanan dulu.');
        }
    });
})();
</script>
@endpush