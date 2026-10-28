@extends('layouts.public')

@section('title', 'Dashboard Pemohon - SIMERAH KOJA')
@section('meta_description', 'Pantau status dan perkembangan berkas permohonan layanan serta kelola profil pemohon SIMERAH KOJA Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.')

@push('styles')
<style>
    /* ==========================================================
       DASHBOARD PEMOHON STYLES
       ========================================================== */
    .dash-hero {
        position: relative;
        isolation: isolate;
        background: linear-gradient(135deg, var(--ink) 0%, var(--ink-2) 60%, var(--ink-3) 100%);
        color: #fff;
        padding: clamp(36px, 5vw, 56px) 0 clamp(40px, 6vw, 64px);
        border-bottom: 1px solid rgba(255,255,255,.08);
        overflow: hidden;
    }
    .dash-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            radial-gradient(40% 40% at 85% 20%, rgba(229,57,45,.25), transparent 70%),
            radial-gradient(35% 35% at 10% 85%, rgba(255,182,39,.18), transparent 70%);
        pointer-events: none;
    }
    .dash-hero-grid {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }
    .dash-user-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.15);
        font-size: .85rem;
        font-weight: 600;
        color: var(--amber);
        margin-bottom: 12px;
    }
    .dash-hero h1 {
        font-family: var(--font-display);
        font-size: clamp(1.8rem, 3.5vw, 2.6rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.02em;
        margin-bottom: 8px;
    }
    .dash-hero p {
        color: rgba(255,255,255,.8);
        font-size: 1rem;
        max-width: 600px;
    }
    .dash-meta-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 14px;
        font-size: .88rem;
    }
    .dash-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        background: rgba(0,0,0,.25);
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,.08);
        color: #e2e8f0;
    }
    .dash-chip i { color: var(--amber); }

    .dash-hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn-action-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--signal);
        color: #fff;
        padding: 12px 22px;
        border-radius: var(--r-sm);
        font-weight: 600;
        font-size: .95rem;
        box-shadow: 0 4px 14px rgba(229,57,45,.4);
        transition: transform .2s, background .2s;
    }
    .btn-action-primary:hover {
        background: var(--signal-d);
        transform: translateY(-2px);
    }
    .btn-action-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.2);
        color: #fff;
        padding: 12px 20px;
        border-radius: var(--r-sm);
        font-weight: 600;
        font-size: .95rem;
        transition: background .2s, border-color .2s;
    }
    .btn-action-secondary:hover {
        background: rgba(255,255,255,.2);
        border-color: rgba(255,255,255,.4);
    }

    /* STATS ROW */
    .dash-stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-top: -30px;
        position: relative;
        z-index: 10;
        margin-bottom: 32px;
    }
    .stat-card {
        background: #fff;
        border-radius: var(--r-md);
        padding: 20px 22px;
        box-shadow: 0 6px 20px rgba(13,27,42,.06);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform .2s, box-shadow .2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(13,27,42,.1);
    }
    .stat-info .stat-num {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        color: var(--ink);
    }
    .stat-info .stat-lbl {
        font-size: .88rem;
        color: var(--steel);
        margin-top: 4px;
        font-weight: 500;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }
    .stat-icon--total { background: #e0f2fe; color: #0284c7; }
    .stat-icon--menunggu { background: #fef3c7; color: #d97706; }
    .stat-icon--proses { background: #ede9fe; color: #7c3aed; }
    .stat-icon--disetujui { background: #dcfce7; color: #16a34a; }

    /* TAB NAV */
    .dash-tabs-bar {
        display: flex;
        gap: 8px;
        border-bottom: 2px solid var(--line);
        margin-bottom: 28px;
        overflow-x: auto;
        padding-bottom: 2px;
    }
    .tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 22px;
        border-radius: 10px 10px 0 0;
        font-weight: 600;
        font-size: 1rem;
        color: var(--steel);
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all .2s;
        position: relative;
        white-space: nowrap;
    }
    .tab-btn:hover {
        color: var(--ink);
        background: rgba(0,0,0,.03);
    }
    .tab-btn.active {
        color: var(--signal);
        font-weight: 700;
    }
    .tab-btn.active::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--signal);
        border-radius: 3px 3px 0 0;
    }
    .tab-badge {
        padding: 2px 8px;
        border-radius: 999px;
        font-size: .75rem;
        background: #e2e8f0;
        color: var(--ink);
    }
    .tab-btn.active .tab-badge {
        background: #fee2e2;
        color: var(--signal);
    }

    /* TAB PANELS */
    .tab-panel {
        display: none;
    }
    .tab-panel.active {
        display: block;
        animation: fadeIn .3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* TOOLBAR */
    .filter-toolbar {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        align-items: center;
        justify-content: space-between;
    }
    .filter-left {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        flex: 1;
        min-width: 280px;
    }
    .search-box {
        position: relative;
        flex: 1;
        min-width: 200px;
    }
    .search-box input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1px solid var(--line);
        border-radius: var(--r-sm);
        font-size: .92rem;
        outline: none;
        transition: border-color .2s;
    }
    .search-box input:focus {
        border-color: var(--signal);
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--steel);
    }
    .select-filter {
        padding: 10px 14px;
        border: 1px solid var(--line);
        border-radius: var(--r-sm);
        font-size: .92rem;
        background: #fff;
        color: var(--ink);
        outline: none;
        cursor: pointer;
    }
    .select-filter:focus {
        border-color: var(--signal);
    }

    /* PERMOHONAN CARD LIST */
    .berkas-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .berkas-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 20px 24px;
        box-shadow: 0 3px 12px rgba(13,27,42,.04);
        transition: box-shadow .2s, border-color .2s;
    }
    .berkas-card:hover {
        box-shadow: 0 8px 24px rgba(13,27,42,.08);
        border-color: #cbd5e1;
    }
    .berkas-header {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 12px;
    }
    .berkas-title-group h3 {
        font-family: var(--font-display);
        font-size: 1.18rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.3;
    }
    .berkas-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 6px;
        align-items: center;
    }
    .tag-layanan {
        font-size: .78rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 6px;
        background: #f1f5f9;
        color: var(--ink-2);
        letter-spacing: .02em;
    }
    .tag-kode {
        font-family: monospace;
        font-size: .82rem;
        color: var(--steel);
        font-weight: 600;
    }
    .tag-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: .82rem;
        font-weight: 700;
        text-transform: capitalize;
    }
    .status-menunggu { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .status-diproses { background: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe; }
    .status-disetujui { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .status-ditolak { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    .berkas-body {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px 20px;
        padding: 12px 0;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        font-size: .9rem;
    }
    .berkas-item-field {
        display: flex;
        flex-direction: column;
    }
    .berkas-field-lbl {
        color: var(--steel);
        font-size: .78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .berkas-field-val {
        color: var(--ink);
        font-weight: 500;
        margin-top: 2px;
    }

    .berkas-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 14px;
        font-size: .85rem;
        color: var(--steel);
    }
    .btn-toggle-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .88rem;
        font-weight: 600;
        color: var(--signal);
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 6px;
        transition: background .2s;
    }
    .btn-toggle-detail:hover {
        background: #fee2e2;
    }

    .berkas-detail-box {
        display: none;
        margin-top: 14px;
        padding: 16px;
        background: #f8fafc;
        border-radius: var(--r-sm);
        border: 1px dashed #cbd5e1;
    }
    .berkas-detail-box.show {
        display: block;
        animation: fadeIn .2s ease;
    }
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 12px 16px;
        font-size: .88rem;
    }

    /* EMPTY STATE */
    .empty-state {
        background: #fff;
        border: 2px dashed var(--line);
        border-radius: var(--r-md);
        padding: 56px 24px;
        text-align: center;
        color: var(--steel);
    }
    .empty-state i.empty-icon {
        font-size: 3.5rem;
        color: #cbd5e1;
        margin-bottom: 16px;
    }
    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 6px;
    }
    .empty-state p {
        font-size: .95rem;
        max-width: 440px;
        margin: 0 auto 20px;
    }

    /* PROFILE TAB FORMS */
    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
    }
    .profile-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 28px;
        box-shadow: 0 4px 16px rgba(13,27,42,.04);
    }
    .profile-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
    }
    .profile-card-header i {
        font-size: 1.4rem;
        color: var(--signal);
    }
    .profile-card-header h2 {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--ink);
    }
    .form-group {
        margin-bottom: 18px;
    }
    .form-label {
        display: block;
        font-size: .88rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 6px;
    }
    .form-control-custom {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--line);
        border-radius: var(--r-sm);
        font-size: .95rem;
        color: var(--ink);
        background: #fff;
        outline: none;
        transition: border-color .2s;
    }
    .form-control-custom:focus {
        border-color: var(--signal);
    }
    .form-control-custom[readonly] {
        background: #f8fafc;
        color: var(--steel);
        cursor: not-allowed;
    }
    .form-hint {
        font-size: .78rem;
        color: var(--steel);
        margin-top: 4px;
    }
    .form-error {
        font-size: .8rem;
        color: var(--signal);
        margin-top: 4px;
        font-weight: 500;
    }
    .btn-submit-form {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--ink);
        color: #fff;
        padding: 12px 24px;
        border-radius: var(--r-sm);
        font-weight: 600;
        font-size: .95rem;
        transition: background .2s, transform .2s;
    }
    .btn-submit-form:hover {
        background: var(--ink-2);
        transform: translateY(-2px);
    }

    /* ALERTS */
    .alert-banner {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: var(--r-sm);
        margin-bottom: 24px;
        font-size: .92rem;
        font-weight: 500;
    }
    .alert-banner--success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }
    .alert-banner--error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }
</style>
@endpush

@section('content')
<!-- HERO SECTION -->
<section class="dash-hero">
    <div class="wrap">
        <div class="dash-hero-grid">
            <div>
                <span class="dash-user-badge">
                    <i class="fas fa-id-card"></i> Akun Pemohon Terdaftar
                </span>
                <h1>Halo, {{ $pemohon->nama_lengkap }}!</h1>
                <p>Selamat datang di Dasbor SIMERAH KOJA. Pantau progres berkas permohonan Anda dan kelola informasi akun Anda di satu tempat.</p>
                <div class="dash-meta-chips">
                    <span class="dash-chip"><i class="fas fa-fingerprint"></i> NIK: {{ $pemohon->nik }}</span>
                    <span class="dash-chip"><i class="fab fa-whatsapp"></i> {{ $pemohon->no_whatsapp }}</span>
                    <span class="dash-chip"><i class="fas fa-envelope"></i> {{ $pemohon->email }}</span>
                    <span class="dash-chip"><i class="fas fa-calendar-alt"></i> Bergabung: {{ \Carbon\Carbon::parse($pemohon->created_at)->format('d M Y') }}</span>
                </div>
            </div>
            <div class="dash-hero-actions">
                <a href="/layanan-fasilitas/layanan_perizinan" class="btn-action-primary">
                    <i class="fas fa-plus-circle"></i> Ajukan Permohonan
                </a>
                <button type="button" class="btn-action-secondary" onclick="switchTab('profil')">
                    <i class="fas fa-user-cog"></i> Edit Profil
                </button>
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT WRAPPER -->
<div class="wrap" style="padding-top: 10px; padding-bottom: 60px;">

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="alert-banner alert-banner--success" role="alert">
            <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-banner alert-banner--error" role="alert">
            <i class="fas fa-exclamation-circle" style="font-size: 1.2rem;"></i>
            <div>
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin-left: 20px; list-style: disc; margin-top: 4px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- STATS ROW -->
    <div class="dash-stats-row">
        <div class="stat-card">
            <div class="stat-info">
                <div class="stat-num">{{ $stats['total'] }}</div>
                <div class="stat-lbl">Total Berkas Diajukan</div>
            </div>
            <div class="stat-icon stat-icon--total">
                <i class="fas fa-folder-open"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <div class="stat-num">{{ $stats['menunggu'] }}</div>
                <div class="stat-lbl">Menunggu Verifikasi</div>
            </div>
            <div class="stat-icon stat-icon--menunggu">
                <i class="fas fa-clock"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <div class="stat-num">{{ $stats['proses'] }}</div>
                <div class="stat-lbl">Sedang Diproses</div>
            </div>
            <div class="stat-icon stat-icon--proses">
                <i class="fas fa-spinner"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <div class="stat-num">{{ $stats['disetujui'] }}</div>
                <div class="stat-lbl">Selesai / Disetujui</div>
            </div>
            <div class="stat-icon stat-icon--disetujui">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <!-- TABS NAVIGATION -->
    <div class="dash-tabs-bar" role="tablist">
        <button type="button" class="tab-btn {{ $tabAktif !== 'profil' ? 'active' : '' }}" id="tabBtnMonitoring" onclick="switchTab('monitoring')" role="tab">
            <i class="fas fa-list-check"></i> Monitoring Berkas Permohonan
            <span class="tab-badge">{{ $stats['total'] }}</span>
        </button>
        <button type="button" class="tab-btn {{ $tabAktif === 'profil' ? 'active' : '' }}" id="tabBtnProfil" onclick="switchTab('profil')" role="tab">
            <i class="fas fa-user-shield"></i> Profil & Keamanan Akun
        </button>
    </div>

    <!-- TAB 1: MONITORING BERKAS -->
    <div class="tab-panel {{ $tabAktif !== 'profil' ? 'active' : '' }}" id="panelMonitoring" role="tabpanel">
        <!-- FILTER TOOLBAR -->
        <div class="filter-toolbar">
            <div class="filter-left">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="filterKeyword" placeholder="Cari nomor berkas, nama usaha, atau lokasi..." onkeyup="filterBerkas()">
                </div>

                <select id="filterLayanan" class="select-filter" onchange="filterBerkas()">
                    <option value="">Semua Layanan</option>
                    <option value="skk">SKK Baru & Perpanjangan</option>
                    <option value="rpkbgl">RPKBGL</option>
                    <option value="keramaian">Izin Keramaian</option>
                    <option value="sarana">Penggunaan Sarana Damkar</option>
                    <option value="edukasi">Edukasi & Sosialisasi</option>
                </select>

                <select id="filterStatus" class="select-filter" onchange="filterBerkas()">
                    <option value="">Semua Status</option>
                    <option value="Menunggu">Menunggu Verifikasi</option>
                    <option value="Diproses">Sedang Diproses</option>
                    <option value="Disetujui">Selesai / Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>

            <div>
                <a href="/layanan-fasilitas/layanan_perizinan" class="btn-action-primary" style="padding: 9px 18px; font-size: .9rem;">
                    <i class="fas fa-plus"></i> Ajukan Berkas Baru
                </a>
            </div>
        </div>

        <!-- LIST DAFTAR PERMOHONAN -->
        <div class="berkas-list" id="berkasContainer">
            @forelse($semuaPermohonan as $item)
                @php
                    $statusClass = match($item['status']) {
                        'Disetujui' => 'status-disetujui',
                        'Diproses' => 'status-diproses',
                        'Ditolak' => 'status-ditolak',
                        default => 'status-menunggu',
                    };
                    $statusIcon = match($item['status']) {
                        'Disetujui' => 'fa-check-circle',
                        'Diproses' => 'fa-spinner fa-spin',
                        'Ditolak' => 'fa-times-circle',
                        default => 'fa-clock',
                    };
                @endphp

                <div class="berkas-card"
                     data-layanan="{{ $item['kategori_layanan'] }}"
                     data-status="{{ $item['status'] }}"
                     data-search="{{ strtolower($item['kode'] . ' ' . $item['judul'] . ' ' . $item['subjudul'] . ' ' . $item['lokasi'] . ' ' . $item['layanan']) }}">

                    <div class="berkas-header">
                        <div class="berkas-title-group">
                            <div class="berkas-tags">
                                <span class="tag-layanan">{{ $item['layanan_singkat'] }}</span>
                                <span class="tag-kode">{{ $item['kode'] }}</span>
                            </div>
                            <h3 style="margin-top: 6px;">{{ $item['judul'] }}</h3>
                            <p style="color: var(--steel); font-size: .88rem; margin-top: 2px;">{{ $item['subjudul'] }}</p>
                        </div>
                        <div>
                            <span class="tag-status {{ $statusClass }}">
                                <i class="fas {{ $statusIcon }}"></i> {{ $item['status'] }}
                            </span>
                        </div>
                    </div>

                    <div class="berkas-body">
                        <div class="berkas-item-field">
                            <span class="berkas-field-lbl">Jenis Layanan</span>
                            <span class="berkas-field-val">{{ $item['layanan'] }}</span>
                        </div>
                        <div class="berkas-item-field">
                            <span class="berkas-field-lbl">Lokasi / Alamat</span>
                            <span class="berkas-field-val">{{ $item['lokasi'] }}</span>
                        </div>
                        <div class="berkas-item-field">
                            <span class="berkas-field-lbl">Waktu Pengajuan</span>
                            <span class="berkas-field-val">
                                <i class="far fa-calendar-alt"></i>
                                {{ $item['tanggal'] ? $item['tanggal']->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </span>
                        </div>
                    </div>

                    <div class="berkas-footer">
                        <span>
                            <i class="fas fa-info-circle"></i> Status resmi di sistem: <strong>{{ $item['status_raw'] }}</strong>
                        </span>
                        <button type="button" class="btn-toggle-detail" onclick="toggleDetail('detail-{{ $item['kode'] }}', this)">
                            <span>Lihat Rincian</span> <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>

                    <div class="berkas-detail-box" id="detail-{{ $item['kode'] }}">
                        <h4 style="font-size: .92rem; font-weight: 700; color: var(--ink); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-file-invoice"></i> Informasi Pengajuan
                        </h4>
                        <div class="detail-grid">
                            @foreach($item['detail'] as $key => $val)
                                <div>
                                    <span style="display: block; color: var(--steel); font-size: .78rem; font-weight: 600;">{{ $key }}</span>
                                    <span style="display: block; color: var(--ink); font-weight: 500;">{{ $val ?: '-' }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-folder-open empty-icon"></i>
                    <h3>Belum Ada Berkas Permohonan</h3>
                    <p>Anda belum pernah mengajukan permohonan layanan. Silakan pilih layanan fasilitas atau perizinan yang Anda butuhkan.</p>
                    <a href="/layanan-fasilitas/layanan_perizinan" class="btn-action-primary">
                        <i class="fas fa-file-circle-plus"></i> Ajukan Berkas Sekarang
                    </a>
                </div>
            @endforelse

            <div id="noMatchMessage" class="empty-state" style="display: none;">
                <i class="fas fa-search empty-icon"></i>
                <h3>Tidak Ada Berkas yang Cocok</h3>
                <p>Tidak ditemukan permohonan yang sesuai dengan filter atau kata kunci pencarian Anda.</p>
                <button type="button" class="btn-action-secondary" style="background: var(--ink); border-color: var(--ink);" onclick="resetFilter()">
                    <i class="fas fa-undo"></i> Reset Filter
                </button>
            </div>
        </div>
    </div>

    <!-- TAB 2: PROFIL & KEAMANAN AKUN -->
    <div class="tab-panel {{ $tabAktif === 'profil' ? 'active' : '' }}" id="panelProfil" role="tabpanel">
        <div class="profile-grid">
            <!-- KARTU 1: DATA PROFIL PEMOHON -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <i class="fas fa-user-circle"></i>
                    <div>
                        <h2>Informasi Akun Pemohon</h2>
                        <p style="font-size: .85rem; color: var(--steel);">Perbarui identitas kontak Anda agar notifikasi permohonan sampai tepat waktu.</p>
                    </div>
                </div>

                <form action="{{ route('pemohon.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" id="nik" class="form-control-custom" value="{{ $pemohon->nik }}" readonly>
                        <span class="form-hint"><i class="fas fa-lock"></i> NIK KTP bersifat permanen dan tidak dapat diubah sendiri.</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="nama_lengkap">Nama Lengkap Sesuai KTP <span style="color: var(--signal);">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control-custom" value="{{ old('nama_lengkap', $pemohon->nama_lengkap) }}" required>
                        @error('nama_lengkap')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Alamat Email <span style="color: var(--signal);">*</span></label>
                        <input type="email" id="email" name="email" class="form-control-custom" value="{{ old('email', $pemohon->email) }}" required>
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="no_whatsapp">Nomor WhatsApp Aktif <span style="color: var(--signal);">*</span></label>
                        <input type="tel" id="no_whatsapp" name="no_whatsapp" class="form-control-custom" value="{{ old('no_whatsapp', $pemohon->no_whatsapp) }}" required>
                        <span class="form-hint">Digunakan petugas untuk konfirmasi dan update perkembangan berkas.</span>
                        @error('no_whatsapp')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit-form">
                        <i class="fas fa-save"></i> Simpan Perubahan Profil
                    </button>
                </form>
            </div>

            <!-- KARTU 2: GANTI KATA SANDI -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <i class="fas fa-key"></i>
                    <div>
                        <h2>Keamanan & Kata Sandi</h2>
                        <p style="font-size: .85rem; color: var(--steel);">Amankan akun Anda dengan mengganti kata sandi secara berkala.</p>
                    </div>
                </div>

                <form action="{{ route('pemohon.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Kata Sandi Saat Ini <span style="color: var(--signal);">*</span></label>
                        <input type="password" id="current_password" name="current_password" class="form-control-custom" placeholder="Masukkan kata sandi lama Anda" required>
                        @error('current_password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Kata Sandi Baru <span style="color: var(--signal);">*</span></label>
                        <input type="password" id="password" name="password" class="form-control-custom" placeholder="Minimal 8 karakter" required>
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru <span style="color: var(--signal);">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-custom" placeholder="Ketik ulang kata sandi baru" required>
                    </div>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px; margin-bottom: 20px; font-size: .82rem; color: var(--steel);">
                        <strong style="color: var(--ink); display: block; margin-bottom: 4px;"><i class="fas fa-shield-alt"></i> Tips Keamanan:</strong>
                        Pastikan kata sandi minimal 8 karakter dengan kombinasi huruf dan angka untuk mencegah akses yang tidak sah.
                    </div>

                    <button type="submit" class="btn-submit-form" style="background: #0284c7;">
                        <i class="fas fa-lock"></i> Perbarui Kata Sandi
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function switchTab(tabName) {
        var tabMonitoring = document.getElementById('tabBtnMonitoring');
        var tabProfil = document.getElementById('tabBtnProfil');
        var panelMonitoring = document.getElementById('panelMonitoring');
        var panelProfil = document.getElementById('panelProfil');

        if (tabName === 'profil') {
            tabMonitoring.classList.remove('active');
            tabProfil.classList.add('active');
            panelMonitoring.classList.remove('active');
            panelProfil.classList.add('active');
            history.replaceState(null, '', '?tab=profil');
        } else {
            tabProfil.classList.remove('active');
            tabMonitoring.classList.add('active');
            panelProfil.classList.remove('active');
            panelMonitoring.classList.add('active');
            history.replaceState(null, '', '?tab=monitoring');
        }
    }

    function toggleDetail(id, btn) {
        var box = document.getElementById(id);
        if (!box) return;

        var isShown = box.classList.contains('show');
        if (isShown) {
            box.classList.remove('show');
            btn.innerHTML = '<span>Lihat Rincian</span> <i class="fas fa-chevron-down"></i>';
        } else {
            box.classList.add('show');
            btn.innerHTML = '<span>Tutup Rincian</span> <i class="fas fa-chevron-up"></i>';
        }
    }

    function filterBerkas() {
        var keyword = (document.getElementById('filterKeyword').value || '').toLowerCase().trim();
        var layanan = document.getElementById('filterLayanan').value;
        var status = document.getElementById('filterStatus').value;

        var cards = document.querySelectorAll('.berkas-card');
        var visibleCount = 0;

        cards.forEach(function (card) {
            var cardSearch = card.getAttribute('data-search') || '';
            var cardLayanan = card.getAttribute('data-layanan') || '';
            var cardStatus = card.getAttribute('data-status') || '';

            var matchKeyword = !keyword || cardSearch.indexOf(keyword) !== -1;
            var matchLayanan = !layanan || cardLayanan === layanan;
            var matchStatus = !status || cardStatus === status;

            if (matchKeyword && matchLayanan && matchStatus) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        var noMatch = document.getElementById('noMatchMessage');
        if (noMatch) {
            noMatch.style.display = (visibleCount === 0 && cards.length > 0) ? 'block' : 'none';
        }
    }

    function resetFilter() {
        document.getElementById('filterKeyword').value = '';
        document.getElementById('filterLayanan').value = '';
        document.getElementById('filterStatus').value = '';
        filterBerkas();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var urlParams = new URLSearchParams(window.location.search);
        var tab = urlParams.get('tab') || window.location.hash.replace('#', '');
        if (tab === 'profil') {
            switchTab('profil');
        }
    });
</script>
@endpush
