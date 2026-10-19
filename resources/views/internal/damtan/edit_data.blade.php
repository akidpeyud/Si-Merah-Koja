@extends('layouts.dashboard')

@section('title', 'Edit Data Penyelamatan')

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
    .brand span { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .topbar-right { display: flex; align-items: center; gap: 14px; }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-head { margin-bottom: 26px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); transition: box-shadow .2s ease, border-color .2s ease; }
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
    .form-check-inline { background-color: var(--white); border: 1px solid var(--line-dark); padding: 8px 16px 8px 36px; border-radius: 50px; margin-right: 6px; margin-bottom: 8px; transition: all 0.2s; position: relative; display: inline-flex; align-items: center; }
    .form-check-inline:hover { border-color: var(--navy); background-color: var(--navy-light); }
    .form-check-inline .form-check-input { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); margin: 0 !important; cursor: pointer; }
    .form-check-inline .form-check-label { cursor: pointer; font-size: .88rem; font-weight: 600; color: var(--ink-2); width: 100%; margin-bottom: 0; transition: color 0.2s; }
    .form-check-input.prio-rendah:checked ~ label { color: var(--steel); font-weight: 700; }
    .form-check-input.prio-sedang:checked ~ label { color: var(--info); font-weight: 700; }
    .form-check-input.prio-tinggi:checked ~ label { color: var(--amber); font-weight: 700; }
    .form-check-input.prio-darurat:checked ~ label { color: var(--signal); font-weight: 700; }
    .btn-custom-primary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff;}
    .btn-custom-primary:active { transform: translateY(0); }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; text-decoration: none; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .btn-outline-primary { color: var(--navy); border-color: var(--navy); font-weight: 600; border-radius: 8px; background: transparent; min-height: 42px; font-size: 0.9rem; }
    .btn-outline-primary:hover { background-color: var(--navy); color: #fff; border-color: var(--navy);}
    .highlight-area { background-color: #f8fafc; border: 1px solid var(--line); border-radius: 12px; padding: 24px 20px; margin-bottom: 24px; }
    .is-invalid { border-color: var(--signal) !important; box-shadow: 0 0 0 3px var(--signal-soft) !important; }
</style>
@endpush

@section('content')
@php
    /* HAK AKSES EDIT: hanya Damtan & Super User. Role lain hanya boleh lihat & cetak. */
    if (!Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
        abort(403, 'Anda tidak memiliki hak akses untuk mengubah data laporan. Role Anda hanya dapat melihat dan mencetak.');
    }

    /* Decode kolom JSON dengan aman (kolom bisa berupa string JSON atau sudah array) */
    $dec = fn ($v) => is_array($v) ? $v : (json_decode($v ?? '[]', true) ?? []);

    $evakuasi    = $dec($teknis->metode_evakuasi ?? null);
    $penyelamatan = $dec($teknis->metode_penyelamatan ?? null);
    $alat        = $dec($teknis->peralatan ?? null);
    $armada      = $dec($teknis->armada ?? null);
    $instansi    = $dec($dokumentasi->instansi_pendukung ?? null);
@endphp

        <div class="page-head">
            <h1>Edit Data Penyelamatan</h1>
            <p>Ubah data laporan penyelamatan yang sudah ada.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Data gagal disimpan.</strong> Ada isian wajib yang terlewat atau tidak sesuai:
                <ul class="mb-0 mt-2 ps-3" style="list-style: disc;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-custom">
            <!-- BOOTSTRAP TABS -->
            <div class="card-header-tabs">
                <ul class="nav nav-tabs-custom" id="formTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">1. Informasi Dasar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="teknis-tab" data-bs-toggle="tab" data-bs-target="#teknis" type="button" role="tab">2. Teknis & Logistik</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dokumentasi-tab" data-bs-toggle="tab" data-bs-target="#dokumentasi" type="button" role="tab">3. Dokumentasi & Validasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="khusus-tab" data-bs-toggle="tab" data-bs-target="#khusus" type="button" role="tab">4. Kategori Khusus</button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4 p-md-5 pt-4">
                <form id="formEditPenyelamatan" action="{{ route('damtan.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- HANYA ADA 1 BLOK TAB-CONTENT DI SINI -->
                    <div class="tab-content" id="formTabsContent">
                        
                        <!-- TAB 1: INFORMASI DASAR -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="section-title-block">
                                <i class="fas fa-info-circle"></i> Informasi Dasar Kejadian
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan</label>
                                    <input type="text" class="form-control" name="nomor_laporan" value="{{ $laporan->nomor_laporan }}" readonly style="background-color: #f1f5f9;">
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan</label>
                                    <input type="text" class="form-control" name="id_laporan" value="{{ $laporan->id_laporan }}" readonly style="background-color: #f1f5f9;">
                                </div>
                            </div>

                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-user"></i> Nama Pelapor <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $laporan->nama_pelapor ?? '') }}" placeholder="Cth: Bapak Iskandar" required="required">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-headset"></i> Layanan Pelaporan</label>
                                        <select class="form-select" name="media_pelaporan">
                                            <option value="">-- Pilih Layanan --</option>
                                            <option value="whatsapp" {{ ($laporan->media_pelaporan ?? '') == 'whatsapp' ? 'selected' : '' }}>Layanan WA Damkar</option>
                                            <option value="telepon" {{ ($laporan->media_pelaporan ?? '') == 'telepon' ? 'selected' : '' }}>Telepon Call Center</option>
                                            <option value="langsung" {{ ($laporan->media_pelaporan ?? '') == 'langsung' ? 'selected' : '' }}>Datang Langsung ke Mako/Pos</option>
                                            <option value="instansi_lain" {{ ($laporan->media_pelaporan ?? '') == 'instansi_lain' ? 'selected' : '' }}>Laporan Instansi Lain</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-route"></i> Jarak Tempuh</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" name="jarak_tempuh" class="form-control" value="{{ $laporan->jarak_tempuh ?? '' }}">
                                            <span class="input-group-text">Km</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label text-danger"><i class="fas fa-fire" style="color: var(--signal);"></i> Kategori Laporan (Kebakaran)</label>
                                    <select class="form-select" name="kategori_kebakaran">
                                        <option value="">-- Pilih Jenis Kebakaran --</option>
                                        <option value="rumah_tinggal" {{ $laporan->kategori_kebakaran == 'rumah_tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                                        <option value="lahan" {{ $laporan->kategori_kebakaran == 'lahan' ? 'selected' : '' }}>Lahan</option>
                                        <option value="bangunan_publik" {{ $laporan->kategori_kebakaran == 'bangunan_publik' ? 'selected' : '' }}>Bangunan Publik</option>
                                        <option value="kendaraan" {{ $laporan->kategori_kebakaran == 'kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select w-50" name="kategori_non_kebakaran" id="kategori_non_kebakaran">
                                            <option value="">-- Pilih Jenis Evakuasi --</option>
                                            <option value="fire_rescue" {{ $laporan->kategori_non_kebakaran == 'fire_rescue' ? 'selected' : '' }}>Fire Rescue</option>
                                            <option value="water_rescue" {{ $laporan->kategori_non_kebakaran == 'water_rescue' ? 'selected' : '' }}>Water Rescue</option>
                                            <option value="land_rescue" {{ $laporan->kategori_non_kebakaran == 'land_rescue' ? 'selected' : '' }}>Land Rescue</option>
                                            <option value="evakuasi_liar" {{ $laporan->kategori_non_kebakaran == 'evakuasi_liar' ? 'selected' : '' }}>Evakuasi Hewan Liar</option>
                                            <option value="evakuasi_ternak" {{ $laporan->kategori_non_kebakaran == 'evakuasi_ternak' ? 'selected' : '' }}>Evakuasi Ternak</option>
                                            <option value="evakuasi_piaraan" {{ $laporan->kategori_non_kebakaran == 'evakuasi_piaraan' ? 'selected' : '' }}>Evakuasi Hewan Peliharaan</option>
                                            <option value="evakuasi_cincin" {{ $laporan->kategori_non_kebakaran == 'evakuasi_cincin' ? 'selected' : '' }}>Evakuasi Cincin / Anting</option>
                                            <option value="evakuasi_kendaraan" {{ $laporan->kategori_non_kebakaran == 'evakuasi_kendaraan' ? 'selected' : '' }}>Evakuasi Kendaraan Bermotor</option>
                                            <option value="lainnya" {{ $laporan->kategori_non_kebakaran == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        <!-- Disabled default via Blade jika bukan "lainnya" -->
                                        <input type="text" class="form-control w-50" name="rincian_kategori_non_kebakaran" id="rincian_kategori_non_kebakaran" value="{{ $laporan->rincian_kategori_non_kebakaran }}" {{ ($laporan->kategori_non_kebakaran == 'lainnya') ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                    <select class="form-select" name="kategori_kejadian">
                                        <option value="">-- Pilih Kategori Kejadian --</option>
                                        <option value="kebakaran" {{ $laporan->kategori_kejadian == 'kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                        <option value="penyelamatan_hewan" {{ $laporan->kategori_kejadian == 'penyelamatan_hewan' ? 'selected' : '' }}>Penyelamatan Hewan</option>
                                        <option value="bencana_alam" {{ $laporan->kategori_kejadian == 'bencana_alam' ? 'selected' : '' }}>Bencana Alam</option>
                                        <option value="kecelakaan_lalu_lintas" {{ $laporan->kategori_kejadian == 'kecelakaan_lalu_lintas' ? 'selected' : '' }}>Kecelakaan Lalu Lintas</option>
                                        <option value="evakuasi_medis" {{ $laporan->kategori_kejadian == 'evakuasi_medis' ? 'selected' : '' }}>Evakuasi Medis</option>
                                    </select>
                                </div>
                            </div>

                            <div class="highlight-area pb-3">
                                <label class="field-label w-100 mb-2"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                <div class="priority-options">
                                    <div class="form-check-inline prio-rendah">
                                        <input class="form-check-input prio-rendah" type="radio" name="prioritas" id="prio1" value="rendah" {{ $laporan->prioritas == 'rendah' ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary" for="prio1">Rendah</label>
                                    </div>
                                    <div class="form-check-inline prio-sedang">
                                        <input class="form-check-input prio-sedang" type="radio" name="prioritas" id="prio2" value="sedang" {{ $laporan->prioritas == 'sedang' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prio2" style="color: var(--info) !important;">Sedang</label>
                                    </div>
                                    <div class="form-check-inline prio-tinggi">
                                        <input class="form-check-input prio-tinggi" type="radio" name="prioritas" id="prio3" value="tinggi" {{ $laporan->prioritas == 'tinggi' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prio3" style="color: var(--amber) !important;">Tinggi</label>
                                    </div>
                                    <div class="form-check-inline prio-darurat">
                                        <input class="form-check-input prio-darurat" type="radio" name="prioritas" id="prio4" value="darurat" {{ $laporan->prioritas == 'darurat' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prio4" style="color: var(--signal) !important;">Darurat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                    <input type="datetime-local" name="waktu_kejadian" class="form-control" value="{{ $laporan->waktu_kejadian ? date('Y-m-d\TH:i', strtotime($laporan->waktu_kejadian)) : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                    <input type="datetime-local" name="waktu_terima" class="form-control" value="{{ $laporan->waktu_terima ? date('Y-m-d\TH:i', strtotime($laporan->waktu_terima)) : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                    <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ $laporan->waktu_berangkat ? date('Y-m-d\TH:i', strtotime($laporan->waktu_berangkat)) : '' }}">
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                    <input type="datetime-local" name="waktu_tiba" class="form-control" value="{{ $laporan->waktu_tiba ? date('Y-m-d\TH:i', strtotime($laporan->waktu_tiba)) : '' }}">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                    <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ $laporan->waktu_selesai ? date('Y-m-d\TH:i', strtotime($laporan->waktu_selesai)) : '' }}">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="field-label"><i class="fas fa-building"></i> Waktu Kembali ke Mako</label>
                                    <input type="datetime-local" name="waktu_kembali" class="form-control" value="{{ $laporan->waktu_kembali ? date('Y-m-d\TH:i', strtotime($laporan->waktu_kembali)) : '' }}">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="2">{{ $laporan->alamat }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="inputKoordinat" name="koordinat" value="{{ $laporan->koordinat }}">
                                    </div>
                                    <button type="button" class="btn-outline-primary w-100" id="btnGoogleMaps">
                                        <i class="fab fa-google me-1"></i> Buka Google Maps
                                    </button>
                                    <small class="text-muted d-block mt-1" style="font-size:.75rem; line-height:1.35;">
                                        Klik kanan titik di Google Maps, klik angka koordinat untuk menyalin, lalu tempel di kolom di atas.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: TEKNIS & LOGISTIK -->
                        <div class="tab-pane fade" id="teknis" role="tabpanel">
                            <div class="section-title-block">
                                <i class="fas fa-tools"></i> Teknis Penyelamatan & Logistik
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-shield"></i> Pimpinan Operasi</label>
                                    <input type="text" name="pimpinan_operasi" class="form-control" value="{{ $teknis->pimpinan_operasi ?? '' }}" placeholder="Cth: Danru 4 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-friends"></i> Pendamping Operasi</label>
                                    <input type="text" name="pendamping_operasi" class="form-control" value="{{ $teknis->pendamping_operasi ?? '' }}" placeholder="Opsional...">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-users-cog"></i> Satuan Tugas / Regu</label>
                                    <input type="text" name="satuan_tugas" class="form-control" value="{{ $teknis->satuan_tugas ?? '' }}" placeholder="Cth: Pleton 1 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-stopwatch"></i> Tim Respon Time</label>
                                    <input type="text" name="tim_respontime" class="form-control" value="{{ $teknis->tim_respontime ?? '' }}" placeholder="Cth: 15 Menit">
                                </div>
                            </div>

                            <div class="highlight-area">
                                <h6 class="fw-bold mb-3" style="color: var(--steel);">Status Korban Manusia & Aset</h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-check" style="color: var(--success);"></i> Selamat</label>
                                        <input type="number" min="0" name="korban_selamat" class="form-control" value="{{ $teknis->korban_selamat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-injured" style="color: var(--amber);"></i> Luka Ringan</label>
                                        <input type="number" min="0" name="korban_ringan" class="form-control" value="{{ $teknis->korban_ringan ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-procedures" style="color: var(--amber);"></i> Luka Berat</label>
                                        <input type="number" min="0" name="korban_berat" class="form-control" value="{{ $teknis->korban_berat ?? 0 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-times" style="color: var(--signal);"></i> Meninggal Dunia</label>
                                        <input type="number" min="0" name="korban_meninggal" class="form-control" value="{{ $teknis->korban_meninggal ?? 0 }}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset (Jika relevan)</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" value="{{ $teknis->korban_hewan_aset ?? '' }}" placeholder="Contoh: 1 ekor ular piton dievakuasi...">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                    <select class="form-select" name="status_evakuasi">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="selesai" {{ ($teknis->status_evakuasi ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dalam_proses" {{ ($teknis->status_evakuasi ?? '') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                        <option value="dirujuk_ke_rs" {{ ($teknis->status_evakuasi ?? '') == 'dirujuk_ke_rs' ? 'selected' : '' }}>Dirujuk ke RS</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                    <input type="text" name="objek_terdampak" class="form-control" value="{{ $teknis->objek_terdampak ?? '' }}">
                                </div>
                            </div>

                            <div class="highlight-area pb-3">
                                <div class="row g-3">
                                    <div class="col-md-12 mb-2">
                                        <label class="field-label w-100 mb-2"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                        <div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue" {{ in_array('vertical_rescue', $evakuasi) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue" {{ in_array('water_rescue', $evakuasi) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="me_wr">Water Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat" {{ in_array('tangga_darurat', $evakuasi) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label class="field-label w-100 mb-2"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                        <div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue" {{ in_array('vertical_rescue', $penyelamatan) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue" {{ in_array('water_rescue', $penyelamatan) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis" {{ in_array('pemadaman_statis', $penyelamatan) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis" {{ in_array('pemadaman_dinamis', $penyelamatan) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar" {{ in_array('evakuasi_medis_dasar', $penyelamatan) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                    <textarea class="form-control" name="hambatan_lapangan" rows="2">{{ $teknis->hambatan_lapangan ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Langkah Penanganan</label>
                                    <textarea class="form-control" name="langkah_penanganan" rows="2">{{ $teknis->langkah_penanganan ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-check-double"></i> Hasil Tindakan</label>
                                    <input type="text" name="hasil_tindakan" class="form-control" value="{{ $teknis->hasil_tindakan ?? '' }}">
                                </div>
                            </div>

                            <div class="section-title-block mt-5">
                                <i class="fas fa-boxes"></i> Alat, Logistik & Personel
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100 mb-2"><i class="fas fa-toolbox"></i> Peralatan Khusus yang Digunakan</label>
                                    <div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_scba" name="peralatan[]" value="SCBA" {{ in_array('SCBA', $alat) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="alat_scba">SCBA</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_thermal" name="peralatan[]" value="Thermal Camera" {{ in_array('Thermal Camera', $alat) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="alat_thermal">Thermal Camera</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_chainsaw" name="peralatan[]" value="Chainsaw" {{ in_array('Chainsaw', $alat) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="alat_chainsaw">Chainsaw</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_selam" name="peralatan[]" value="Alat Selam" {{ in_array('Alat Selam', $alat) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="alat_selam">Alat Selam</label>
                                        </div>
                                    </div>
                                    <input type="text" name="peralatan_lain" class="form-control mt-2" placeholder="Alat khusus lainnya..." value="{{ $teknis->peralatan_lain ?? '' }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                    <input type="text" name="konsumsi_alat" class="form-control" value="{{ $teknis->konsumsi_alat ?? '' }}">
                                </div>
                            </div>

                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_air" class="form-control" value="{{ $teknis->liter_air ?? 0 }}">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_foam" class="form-control" value="{{ $teknis->liter_foam ?? 0 }}">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_bbm" class="form-control" value="{{ $teknis->liter_bbm ?? 0 }}">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label w-100 mb-2"><i class="fas fa-truck"></i> Unit Armada Terlibat</label>
                                    <div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa" {{ in_array('pompa', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue" {{ in_array('rescue', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki" {{ in_array('tangki', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans" {{ in_array('ambulans', $armada) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                    <input type="number" min="0" name="jumlah_personel" class="form-control" value="{{ $teknis->jumlah_personel ?? 0 }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                    <textarea class="form-control" name="daftar_personel" rows="2">{{ $teknis->daftar_personel ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: DOKUMENTASI, EVALUASI & VALIDASI -->
                        <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                            <div class="section-title-block">
                                <i class="fas fa-clipboard-list"></i> Analisis & Evaluasi Kejadian
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-bolt"></i> Dugaan Penyebab</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select w-50" name="dugaan_penyebab" id="dugaan_penyebab">
                                            <option value="">-- Pilih Penyebab --</option>
                                            <option value="arus_pendek" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'arus_pendek' ? 'selected' : '' }}>Arus pendek listrik</option>
                                            <option value="kebocoran_gas" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'kebocoran_gas' ? 'selected' : '' }}>Kebocoran gas</option>
                                            <option value="sambaran_petir" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'sambaran_petir' ? 'selected' : '' }}>Sambaran petir</option>
                                            <option value="kelalaian_manusia" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'kelalaian_manusia' ? 'selected' : '' }}>Kelalaian manusia</option>
                                            <option value="faktor_alam" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'faktor_alam' ? 'selected' : '' }}>Faktor alam</option>
                                            <option value="lainnya" {{ ($dokumentasi->dugaan_penyebab ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        <input type="text" class="form-control w-50" name="dugaan_penyebab_lainnya" id="dugaan_penyebab_lainnya" value="{{ $dokumentasi->dugaan_penyebab_lainnya ?? '' }}" {{ (($dokumentasi->dugaan_penyebab ?? '') == 'lainnya') ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                    <input type="text" name="sumber_api" class="form-control" value="{{ $dokumentasi->sumber_api ?? '' }}">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                    <div class="input-group" style="width: 50%;">
                                        <input type="number" min="0" step="0.1" name="luas_area" class="form-control" value="{{ $dokumentasi->luas_area ?? '' }}">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Kerjasama Lintas Sektoral & Evaluasi</h6>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln" {{ in_array('pln', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_pln">PLN</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi" {{ in_array('polisi', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_polisi">Polisi</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni" {{ in_array('tni', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_tni">TNI</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi" {{ in_array('pmi', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_pmi">BPBD</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" {{ in_array('relawan_lokal', $instansi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                    <textarea class="form-control" name="tindakan_instansi" rows="2">{{ $dokumentasi->tindakan_instansi ?? '' }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                    <input type="text" name="kontak_saksi" id="kontak_saksi" class="form-control"
                                           value="{{ preg_replace('/\D/', '', $dokumentasi->kontak_saksi ?? '') }}"
                                           placeholder="08xxxxxxxxxx" inputmode="numeric" pattern="[0-9]*" maxlength="15"
                                           title="Hanya boleh angka" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                        <textarea class="form-control" name="kebutuhan_tambahan" rows="2">{{ $dokumentasi->kebutuhan_tambahan ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                        <textarea class="form-control" name="saran_mitigasi" rows="2">{{ $dokumentasi->saran_mitigasi ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-hands-helping"></i> Cara Bertindak</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select w-50" name="cara_bertindak" id="cara_bertindak">
                                            <option value="5T" {{ ($dokumentasi->cara_bertindak ?? '') == '5T' ? 'selected' : '' }}>5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)</option>
                                            <option value="lainnya" {{ ($dokumentasi->cara_bertindak ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya...</option>
                                        </select>
                                        <input type="text" class="form-control w-50" name="cara_bertindak_lainnya" id="cara_bertindak_lainnya" value="{{ $dokumentasi->cara_bertindak_lainnya ?? '' }}" {{ (($dokumentasi->cara_bertindak ?? '') == 'lainnya') ? '' : 'disabled' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="section-title-block mt-5">
                                <i class="fas fa-camera"></i> Dokumentasi Akhir
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                    <textarea class="form-control" name="kronologi_lengkap" rows="5">{{ $dokumentasi->kronologi_lengkap ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="field-label"><i class="fas fa-images"></i> Upload Foto Baru (.jpg/.png)</label>
                                        <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                        <small class="text-muted d-block mt-1">*Abaikan jika tidak ingin mengubah foto</small>
                                    </div>
                                    <div>
                                        <label class="field-label"><i class="fas fa-video"></i> Upload Video Baru (.mp4)</label>
                                        <input class="form-control" type="file" name="video" accept="video/mp4">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: KATEGORI KHUSUS -->
                        <div class="tab-pane fade" id="khusus" role="tabpanel">
                            <div class="section-title-block">
                                <i class="fas fa-star"></i> Modul Kategori Khusus
                            </div>
                            
                            <!-- Animal Rescue -->
                            <div class="highlight-area pb-4">
                                <h6 class="fw-bold mb-3" style="color: var(--navy); font-family: var(--font-display);"><i class="fas fa-paw me-2"></i>Animal Rescue</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Jenis Hewan</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select w-50" name="jenis_hewan" id="jenis_hewan">
                                                <option value="">-- Pilih --</option>
                                                <option value="ular" {{ ($khusus->jenis_hewan ?? '') == 'ular' ? 'selected' : '' }}>Ular</option>
                                                <option value="tawon" {{ ($khusus->jenis_hewan ?? '') == 'tawon' ? 'selected' : '' }}>Tawon/Vespa</option>
                                                <option value="kera" {{ ($khusus->jenis_hewan ?? '') == 'kera' ? 'selected' : '' }}>Kera</option>
                                                <option value="biawak" {{ ($khusus->jenis_hewan ?? '') == 'biawak' ? 'selected' : '' }}>Biawak</option>
                                                <option value="lainnya" {{ ($khusus->jenis_hewan ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control w-50" name="jenis_hewan_lainnya" id="jenis_hewan_lainnya" value="{{ $khusus->jenis_hewan_lainnya ?? '' }}" {{ (($khusus->jenis_hewan ?? '') == 'lainnya') ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" value="{{ $khusus->spesies_hewan ?? '' }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" value="{{ $khusus->dimensi_hewan ?? '' }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-balance-scale"></i> Berat Hewan</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" name="berat_hewan" class="form-control" value="{{ $khusus->berat_hewan ?? '' }}">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option value="">-- Pilih --</option>
                                            <option value="dilepasliarkan" {{ ($khusus->status_hewan_pasca ?? '') == 'dilepasliarkan' ? 'selected' : '' }}>Dilepasliarkan</option>
                                            <option value="diserahkan_bksda" {{ ($khusus->status_hewan_pasca ?? '') == 'diserahkan_bksda' ? 'selected' : '' }}>Diserahkan BKSDA</option>
                                            <option value="mati" {{ ($khusus->status_hewan_pasca ?? '') == 'mati' ? 'selected' : '' }}>Mati</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" value="{{ $khusus->lokasi_pelepasan ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Pohon Tumbang -->
                            <div class="highlight-area pb-4">
                                <h6 class="fw-bold mb-3" style="color: var(--navy); font-family: var(--font-display);"><i class="fas fa-tree me-2"></i>Pohon Tumbang / Bangunan</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-car-crash"></i> Jenis Objek</label>
                                        <select class="form-select" name="jenis_objek_tumbang">
                                            <option value="">-- Pilih --</option>
                                            <option value="pohon" {{ ($khusus->jenis_objek_tumbang ?? '') == 'pohon' ? 'selected' : '' }}>Pohon</option>
                                            <option value="baliho" {{ ($khusus->jenis_objek_tumbang ?? '') == 'baliho' ? 'selected' : '' }}>Baliho</option>
                                            <option value="tiang_listrik" {{ ($khusus->jenis_objek_tumbang ?? '') == 'tiang_listrik' ? 'selected' : '' }}>Tiang Listrik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                        <div class="input-group">
                                            <input type="number" min="0" step="0.1" name="dimensi_objek" class="form-control" value="{{ $khusus->dimensi_objek ?? '' }}">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                        <select class="form-select" name="status_utilitas">
                                            <option value="">-- Tidak Ada --</option>
                                            <option value="kabel_pln" {{ ($khusus->status_utilitas ?? '') == 'kabel_pln' ? 'selected' : '' }}>Kabel PLN putus</option>
                                            <option value="pipa_pdam" {{ ($khusus->status_utilitas ?? '') == 'pipa_pdam' ? 'selected' : '' }}>Pipa PDAM bocor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                        <textarea class="form-control" name="dampak_properti" rows="2">{{ $khusus->dampak_properti ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Water Rescue -->
                            <div class="highlight-area pb-4">
                                <h6 class="fw-bold mb-3" style="color: var(--navy); font-family: var(--font-display);"><i class="fas fa-life-ring me-2"></i>Water Rescue</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-water"></i> Kondisi Perairan</label>
                                        <select class="form-select" name="kondisi_perairan">
                                            <option value="">-- Pilih --</option>
                                            <option value="arus_deras" {{ ($khusus->kondisi_perairan ?? '') == 'arus_deras' ? 'selected' : '' }}>Arus Deras</option>
                                            <option value="arus_tenang" {{ ($khusus->kondisi_perairan ?? '') == 'arus_tenang' ? 'selected' : '' }}>Arus Tenang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-search-location"></i> Radius Pencarian</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="radius_pencarian" class="form-control" value="{{ $khusus->radius_pencarian ?? '' }}">
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                        <select class="form-select" name="metode_pencarian_air">
                                            <option value="">-- Pilih --</option>
                                            <option value="penyelaman" {{ ($khusus->metode_pencarian_air ?? '') == 'penyelaman' ? 'selected' : '' }}>Penyelaman</option>
                                            <option value="penyisiran" {{ ($khusus->metode_pencarian_air ?? '') == 'penyisiran' ? 'selected' : '' }}>Penyisiran Perahu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                        <input type="text" name="daftar_penyelam" class="form-control" value="{{ $khusus->daftar_penyelam ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ring/Object Removal & Geografis -->
                            <div class="highlight-area pb-4 mb-0">
                                <h6 class="fw-bold mb-3" style="color: var(--navy); font-family: var(--font-display);"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                        <input type="text" name="jenis_benda_bahaya" class="form-control" value="{{ $khusus->jenis_benda_bahaya ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                        <select class="form-select" name="kondisi_anggota_tubuh">
                                            <option value="">-- Pilih --</option>
                                            <option value="bengkak" {{ ($khusus->kondisi_anggota_tubuh ?? '') == 'bengkak' ? 'selected' : '' }}>Bengkak</option>
                                            <option value="luka_terbuka" {{ ($khusus->kondisi_anggota_tubuh ?? '') == 'luka_terbuka' ? 'selected' : '' }}>Luka Terbuka</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                        <select class="form-select" name="alat_potong_cincin">
                                            <option value="">-- Pilih --</option>
                                            <option value="gerinda_mini" {{ ($khusus->alat_potong_cincin ?? '') == 'gerinda_mini' ? 'selected' : '' }}>Gerinda Mini</option>
                                            <option value="tang_baja" {{ ($khusus->alat_potong_cincin ?? '') == 'tang_baja' ? 'selected' : '' }}>Tang Baja</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                        <select class="form-select" name="cuaca_operasi">
                                            <option value="">-- Pilih --</option>
                                            <option value="cerah" {{ ($khusus->cuaca_operasi ?? '') == 'cerah' ? 'selected' : '' }}>Cerah</option>
                                            <option value="hujan_lebat" {{ ($khusus->cuaca_operasi ?? '') == 'hujan_lebat' ? 'selected' : '' }}>Hujan Lebat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                        <select class="form-select" name="jenis_medan">
                                            <option value="">-- Pilih --</option>
                                            <option value="pemukiman_padat" {{ ($khusus->jenis_medan ?? '') == 'pemukiman_padat' ? 'selected' : '' }}>Pemukiman Padat</option>
                                            <option value="perkebunan" {{ ($khusus->jenis_medan ?? '') == 'perkebunan' ? 'selected' : '' }}>Perkebunan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-road"></i> Akses Lokasi</label>
                                        <select class="form-select" name="akses_lokasi">
                                            <option value="">-- Pilih --</option>
                                            <option value="kendaraan_berat" {{ ($khusus->akses_lokasi ?? '') == 'kendaraan_berat' ? 'selected' : '' }}>Bisa dilalui Roda 4+</option>
                                            <option value="roda_dua" {{ ($khusus->akses_lokasi ?? '') == 'roda_dua' ? 'selected' : '' }}>Hanya Roda 2</option>
                                            <option value="jalan_kaki" {{ ($khusus->akses_lokasi ?? '') == 'jalan_kaki' ? 'selected' : '' }}>Hanya Jalan Kaki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                        <a href="/internal/damtan/data-laporan" class="btn-custom-light me-3">Batal</a>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Perbarui Data Penyelamatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    function mulai() {

        /* ---------- Sidebar (Mobile Toggle) ---------- */
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

        /* ---------- Eksklusivitas Accordion Sidebar ---------- */
        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });

        /* ==========================================================
           GOOGLE MAPS (buka di tab baru)
           ========================================================== */
        var DEFAULT_LATLNG = [-1.6180524600704744, 103.60062412413868];   // Titik awal Google Maps
        var inputKoordinat = document.getElementById('inputKoordinat');
        var btnGoogleMaps = document.getElementById('btnGoogleMaps');

        // Baca "lat, lng" dari input; kembalikan null jika tidak valid
        function parseKoordinat(str) {
            if (!str) return null;
            var m = str.trim().match(/^(-?\d+(?:\.\d+)?)\s*,\s*(-?\d+(?:\.\d+)?)$/);
            if (!m) return null;
            var lat = parseFloat(m[1]), lng = parseFloat(m[2]);
            if (lat < -90 || lat > 90 || lng < -180 || lng > 180) return null;
            return [lat, lng];
        }

        // Buka Google Maps di tab baru (pakai koordinat di kolom jika ada, jika tidak Kota Jambi)
        if (btnGoogleMaps) {
            btnGoogleMaps.addEventListener('click', function () {
                var ll = parseKoordinat(inputKoordinat.value) || DEFAULT_LATLNG;
                window.open('https://www.google.com/maps/search/?api=1&query=' + ll[0] + ',' + ll[1], '_blank', 'noopener');
            });
        }

        // Rapikan hasil tempel (dari "lat, lng" atau link Google Maps) ke format 5 desimal
        if (inputKoordinat) {
            inputKoordinat.addEventListener('change', function () {
                var m = this.value.match(/(-?\d+\.\d+)\s*,\s*(-?\d+\.\d+)/);
                if (m) this.value = parseFloat(m[1]).toFixed(5) + ', ' + parseFloat(m[2]).toFixed(5);
            });
        }

        /* ---------- LOGIKA KOLOM "LAINNYA" (Otomatis Enable/Disable) ---------- */
        function setupLainnyaLogic(selectId, inputId) {
            var selectEl = document.getElementById(selectId);
            var inputEl = document.getElementById(inputId);

            if (selectEl && inputEl) {
                // Cek status saat halaman edit baru dimuat
                inputEl.disabled = selectEl.value !== 'lainnya';
                inputEl.required = selectEl.value === 'lainnya';

                // Listener ketika opsi berubah
                selectEl.addEventListener('change', function () {
                    if (this.value === 'lainnya') {
                        inputEl.disabled = false;
                        inputEl.required = true;
                        inputEl.focus();
                    } else {
                        inputEl.disabled = true;
                        inputEl.value = '';
                        inputEl.required = false;
                    }
                });
            }
        }

        setupLainnyaLogic('kategori_non_kebakaran', 'rincian_kategori_non_kebakaran');
        setupLainnyaLogic('dugaan_penyebab', 'dugaan_penyebab_lainnya');
        setupLainnyaLogic('cara_bertindak', 'cara_bertindak_lainnya');
        setupLainnyaLogic('jenis_hewan', 'jenis_hewan_lainnya');

        /* ---------- No. Kontak Saksi: hanya angka ---------- */
        var kontakSaksi = document.getElementById('kontak_saksi');
        if (kontakSaksi) {
            // Hapus semua karakter non-angka saat mengetik atau menempel (paste)
            kontakSaksi.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });
        }

        /* ---------- ARAHKAN KE TAB & KOLOM YANG KOSONG SAAT ERROR ---------- */
        var melapor = false;          // true saat kita sendiri memanggil reportValidity()
        var sedangDitangani = false;  // hanya tangani isian tidak valid yang pertama
        var namaPelapor = document.getElementById('nama_pelapor');

        function tampilkanTab(selector) {
            var btn = document.querySelector(selector);
            if (btn) new bootstrap.Tab(btn).show();
        }

        // Pengaman ganda: nama pelapor berisi spasi saja
        document.getElementById('formEditPenyelamatan').addEventListener('submit', function (e) {
            if (!namaPelapor.value.trim()) {
                e.preventDefault();
                tampilkanTab('#info-tab');

                setTimeout(function () {
                    namaPelapor.focus();
                    namaPelapor.classList.add('is-invalid');
                    namaPelapor.setCustomValidity('Nama pelapor wajib diisi.');
                    melapor = true;
                    namaPelapor.reportValidity();
                    melapor = false;
                }, 300);
            }
        });

        // Isian wajib kosong di tab lain: pindah ke tab-nya lalu tampilkan pesan sekali saja
        document.addEventListener('invalid', function (e) {
            if (melapor) return;   // event dari reportValidity() kita sendiri: biarkan browser menampilkan pesan

            var f = e.target;
            if (!/^(INPUT|SELECT|TEXTAREA)$/.test(f.tagName)) return;

            e.preventDefault();
            if (sedangDitangani) return;
            sedangDitangani = true;

            var pane = f.closest('.tab-pane');
            if (pane && !pane.classList.contains('active')) {
                tampilkanTab('[data-bs-target="#' + pane.id + '"]');
            }

            setTimeout(function () {
                f.focus();
                melapor = true;
                f.reportValidity();
                melapor = false;
                sedangDitangani = false;
            }, 250);
        }, true);

        // Hilangkan efek merah kalau user mulai mengetik
        namaPelapor.addEventListener('input', function () {
            this.classList.remove('is-invalid');
            this.setCustomValidity('');
        });
    }

    // Bootstrap biasanya sudah dimuat oleh layout; jika belum, muat di sini.
    document.addEventListener('DOMContentLoaded', function () {
        if (window.bootstrap) { mulai(); return; }
        var s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js';
        s.onload = mulai;
        document.head.appendChild(s);
    });
})();
</script>
@endpush