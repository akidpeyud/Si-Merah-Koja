@extends('layouts.dashboard')

@section('title', 'Input Data Penyelamatan')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
    #map { height: 400px; width: 100%; border-radius: 8px; border: 1px solid var(--line-dark); z-index: 1;}
    .modal-content { border-radius: var(--r-md); border: none; box-shadow: var(--shadow-lg); }
    .modal-header { border-bottom: 1px solid var(--line); }
    .modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h1>Form Penginputan Data Penyelamatan</h1>
                <p>Bagian Pemadaman & Penyelamatan - Disdamkartan Kota Jambi.</p>
            </div>
            <a href="/internal/damtan/data-laporan" class="btn-custom-light">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-custom">
            <!-- BOOTSTRAP TABS (Design Baru Terintegrasi ke Card Body) -->
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
                <form action="{{ route('damtan.laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content" id="formTabsContent">
                        
                        <!-- TAB 1: INFORMASI DASAR -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            
                            <div class="section-title-block">
                                <i class="fas fa-info-circle"></i> Informasi Dasar Kejadian
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-hashtag"></i> Nomor Laporan (Auto)</label>
                                    <input type="text" class="form-control" name="nomor_laporan" value="REG-{{ date('Ymd') }}-XXXX" readonly style="background-color: #f1f5f9;">
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fingerprint"></i> ID Laporan (Auto)</label>
                                    <input type="text" class="form-control" name="id_laporan" value="UUID-XXXXXX" readonly style="background-color: #f1f5f9;">
                                </div>
                            </div>

                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-user"></i> Nama Pelapor <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_pelapor" placeholder="Cth: Bapak Iskandar" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-headset"></i> Layanan Pelaporan</label>
                                        <select class="form-select" name="media_pelaporan">
                                            <option selected value="">-- Pilih Layanan --</option>
                                            <option value="whatsapp">Layanan WA Damkar</option>
                                            <option value="telepon">Telepon Call Center</option>
                                            <option value="langsung">Datang Langsung ke Mako/Pos</option>
                                            <option value="instansi_lain">Laporan Instansi Lain</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-route"></i> Jarak Tempuh</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" name="jarak_tempuh" class="form-control" placeholder="Cth: 4.1">
                                            <span class="input-group-text">Km</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label text-danger"><i class="fas fa-fire" style="color: var(--signal);"></i> Kategori Laporan (Kebakaran)</label>
                                    <select class="form-select" name="kategori_kebakaran">
                                        <option selected value="">-- Pilih Jenis Kebakaran --</option>
                                        <option value="rumah_tinggal">Rumah Tinggal</option>
                                        <option value="lahan">Lahan</option>
                                        <option value="bangunan_publik">Bangunan Publik</option>
                                        <option value="kendaraan">Kendaraan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-life-ring"></i> Kategori Laporan (Non-Kebakaran)</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select w-50" name="kategori_non_kebakaran" id="kategori_non_kebakaran">
                                            <option selected value="">-- Pilih Jenis Evakuasi --</option>
                                            <option value="fire_rescue">Fire Rescue</option>
                                            <option value="water_rescue">Water Rescue</option>
                                            <option value="land_rescue">Land Rescue</option>
                                            <option value="evakuasi_liar">Evakuasi Hewan Liar</option>
                                            <option value="evakuasi_ternak">Evakuasi Ternak</option>
                                            <option value="evakuasi_piaraan">Evakuasi Hewan Peliharaan</option>
                                            <option value="evakuasi_cincin">Evakuasi Cincin / Anting</option>
                                            <option value="evakuasi_kendaraan">Evakuasi Kendaraan Bermotor</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                        <input type="text" class="form-control w-50" name="rincian_kategori_non_kebakaran" id="rincian_kategori_non_kebakaran" placeholder="Ketik jika 'Lainnya'..." disabled>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-layer-group"></i> Kategori Kejadian Umum</label>
                                    <select class="form-select" name="kategori_kejadian">
                                        <option selected value="">-- Pilih Kategori Kejadian --</option>
                                        <option value="kebakaran">Kebakaran</option>
                                        <option value="penyelamatan_hewan">Penyelamatan Hewan</option>
                                        <option value="bencana_alam">Bencana Alam</option>
                                        <option value="kecelakaan_lalu_lintas">Kecelakaan Lalu Lintas</option>
                                        <option value="evakuasi_medis">Evakuasi Medis</option>
                                    </select>
                                </div>
                            </div>

                            <div class="highlight-area pb-3">
                                <label class="field-label w-100 mb-2"><i class="fas fa-exclamation-circle"></i> Tingkat Prioritas</label>
                                <div class="priority-options">
                                    <div class="form-check-inline prio-rendah">
                                        <input class="form-check-input prio-rendah" type="radio" name="prioritas" id="prio1" value="rendah" checked>
                                        <label class="form-check-label text-secondary" for="prio1">Rendah</label>
                                    </div>
                                    <div class="form-check-inline prio-sedang">
                                        <input class="form-check-input prio-sedang" type="radio" name="prioritas" id="prio2" value="sedang">
                                        <label class="form-check-label" for="prio2">Sedang</label>
                                    </div>
                                    <div class="form-check-inline prio-tinggi">
                                        <input class="form-check-input prio-tinggi" type="radio" name="prioritas" id="prio3" value="tinggi">
                                        <label class="form-check-label" for="prio3">Tinggi</label>
                                    </div>
                                    <div class="form-check-inline prio-darurat">
                                        <input class="form-check-input prio-darurat" type="radio" name="prioritas" id="prio4" value="darurat">
                                        <label class="form-check-label" for="prio4">Darurat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-calendar-alt"></i> Waktu Kejadian</label>
                                    <input type="datetime-local" name="waktu_kejadian" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-clock"></i> Waktu Terima Laporan</label>
                                    <input type="datetime-local" name="waktu_terima" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-truck-moving"></i> Waktu Berangkat Unit</label>
                                    <input type="datetime-local" name="waktu_berangkat" class="form-control">
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label class="field-label"><i class="fas fa-map-marker-alt"></i> Waktu Tiba di Lokasi</label>
                                    <input type="datetime-local" name="waktu_tiba" class="form-control">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="field-label"><i class="fas fa-flag-checkered"></i> Waktu Operasi Selesai</label>
                                    <input type="datetime-local" name="waktu_selesai" class="form-control">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="field-label"><i class="fas fa-building"></i> Waktu Kembali ke Mako</label>
                                    <input type="datetime-local" name="waktu_kembali" class="form-control">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="2" placeholder="Nama jalan, RT/RW, Kecamatan..."></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-location-arrow"></i> Titik Koordinat</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="inputKoordinat" name="koordinat" placeholder="-1.61157, 103.57860">
                                    </div>
                                    <button type="button" class="btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#mapModal">
                                        <i class="fas fa-map-marked-alt me-1"></i> Buka Peta Interaktif
                                    </button>
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
                                    <input type="text" name="pimpinan_operasi" class="form-control" placeholder="Cth: Danru 4 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-user-friends"></i> Pendamping Operasi</label>
                                    <input type="text" name="pendamping_operasi" class="form-control" placeholder="Opsional...">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-users-cog"></i> Satuan Tugas / Regu</label>
                                    <input type="text" name="satuan_tugas" class="form-control" placeholder="Cth: Pleton 1 Mako">
                                </div>
                                <div class="col-md-3">
                                    <label class="field-label"><i class="fas fa-stopwatch"></i> Tim Respon Time</label>
                                    <input type="text" name="tim_respontime" class="form-control" placeholder="Cth: 15 Menit">
                                </div>
                            </div>

                            <div class="highlight-area">
                                <h6 class="fw-bold mb-3" style="color: var(--steel);">Status Korban Manusia & Aset</h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-check" style="color: var(--success);"></i> Selamat</label>
                                        <input type="number" min="0" name="korban_selamat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-injured" style="color: var(--amber);"></i> Luka Ringan</label>
                                        <input type="number" min="0" name="korban_ringan" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-procedures" style="color: var(--amber);"></i> Luka Berat</label>
                                        <input type="number" min="0" name="korban_berat" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="field-label"><i class="fas fa-user-times" style="color: var(--signal);"></i> Meninggal Dunia</label>
                                        <input type="number" min="0" name="korban_meninggal" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-cat"></i> Hewan / Aset (Jika relevan)</label>
                                        <input type="text" name="korban_hewan_aset" class="form-control" placeholder="Contoh: 1 ekor ular piton dievakuasi, 2 unit motor terbakar...">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-info-circle"></i> Status Evakuasi</label>
                                    <select class="form-select" name="status_evakuasi">
                                        <option selected value="">-- Pilih Status --</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="dalam_proses">Dalam Proses</option>
                                        <option value="dirujuk_ke_rs">Dirujuk ke RS</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-house-damage"></i> Objek Terdampak</label>
                                    <input type="text" name="objek_terdampak" class="form-control" placeholder="Contoh: Atap rumah warga, sumur tua, dsb.">
                                </div>
                            </div>

                            <div class="highlight-area pb-3">
                                <div class="row g-3">
                                    <div class="col-md-12 mb-2">
                                        <label class="field-label w-100 mb-2"><i class="fas fa-route"></i> Metode Evakuasi</label>
                                        <div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue">
                                                <label class="form-check-label" for="me_vr">Vertical Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue">
                                                <label class="form-check-label" for="me_wr">Water Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat">
                                                <label class="form-check-label" for="me_td">Penggunaan Tangga Darurat</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="field-label w-100 mb-2"><i class="fas fa-hands-helping"></i> Metode Penyelamatan</label>
                                        <div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue">
                                                <label class="form-check-label" for="mp_vr">Vertical Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue">
                                                <label class="form-check-label" for="mp_wr">Water Rescue</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis">
                                                <label class="form-check-label" for="mp_ps">Pemadam Statis</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis">
                                                <label class="form-check-label" for="mp_pd">Pemadam Dinamis</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar">
                                                <label class="form-check-label" for="mp_emd">Evakuasi Medis Dasar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-exclamation-triangle"></i> Hambatan Lapangan</label>
                                    <textarea class="form-control" name="hambatan_lapangan" rows="2" placeholder="Tuliskan hambatan spesifik saat operasi di lapangan..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Langkah Penanganan</label>
                                    <textarea class="form-control" name="langkah_penanganan" rows="2" placeholder="Cth: Ular Sanca Berhasil Di Evakuasi Dengan Menggunakan Stik Hook..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-check-double"></i> Hasil Tindakan</label>
                                    <input type="text" name="hasil_tindakan" class="form-control" placeholder="Cth: Evakuasi berhasil dengan aman dan lancar">
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
                                            <input type="checkbox" class="form-check-input" id="alat_scba" name="peralatan[]" value="SCBA">
                                            <label class="form-check-label" for="alat_scba">SCBA</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_thermal" name="peralatan[]" value="Thermal Camera">
                                            <label class="form-check-label" for="alat_thermal">Thermal Camera</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_chainsaw" name="peralatan[]" value="Chainsaw">
                                            <label class="form-check-label" for="alat_chainsaw">Chainsaw</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="alat_selam" name="peralatan[]" value="Alat Selam">
                                            <label class="form-check-label" for="alat_selam">Alat Selam</label>
                                        </div>
                                    </div>
                                    <input type="text" name="peralatan_lain" class="form-control mt-2" placeholder="Alat khusus lainnya (pisahkan dengan koma)...">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-spray-can"></i> Konsumsi Alat Umum</label>
                                    <input type="text" name="konsumsi_alat" class="form-control" placeholder="Contoh: penggunaan foam, jumlah liter air, atau combi tool...">
                                </div>
                            </div>

                            <div class="highlight-area">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-tint"></i> Liter Air Digunakan</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_air" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-soap"></i> Liter Foam</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_foam" class="form-control" placeholder="0">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-gas-pump"></i> Liter BBM Unit</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="liter_bbm" class="form-control" placeholder="0">
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
                                            <input class="form-check-input" type="checkbox" id="arm_pompa" name="armada[]" value="pompa">
                                            <label class="form-check-label" for="arm_pompa">Unit Pompa</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_rescue" name="armada[]" value="rescue">
                                            <label class="form-check-label" for="arm_rescue">Unit Rescue</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_tangki" name="armada[]" value="tangki">
                                            <label class="form-check-label" for="arm_tangki">Unit Tangki</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans">
                                            <label class="form-check-label" for="arm_ambulans">Ambulans</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-users"></i> Jumlah Personel</label>
                                    <input type="number" min="0" name="jumlah_personel" class="form-control" placeholder="0">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="field-label"><i class="fas fa-user-tag"></i> Personel yang Terlibat</label>
                                    <textarea class="form-control" name="daftar_personel" rows="2" placeholder="Contoh: Budi, Andi, Joko..."></textarea>
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
                                            <option selected value="">-- Pilih Penyebab --</option>
                                            <option value="arus_pendek">Arus pendek listrik</option>
                                            <option value="kebocoran_gas">Kebocoran gas</option>
                                            <option value="sambaran_petir">Sambaran petir</option>
                                            <option value="kelalaian_manusia">Kelalaian manusia</option>
                                            <option value="faktor_alam">Faktor alam</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                        <input type="text" class="form-control w-50" name="dugaan_penyebab_lainnya" id="dugaan_penyebab_lainnya" placeholder="Ketik jika 'Lainnya'..." disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-fire-alt"></i> Sumber Api / Titik Awal</label>
                                    <input type="text" name="sumber_api" class="form-control" placeholder="Contoh: Dapur, Panel Listrik utama...">
                                </div>
                            </div>

                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-ruler-combined"></i> Luas Area Terdampak</label>
                                    <div class="input-group" style="width: 50%;">
                                        <input type="number" min="0" step="0.1" name="luas_area" class="form-control" placeholder="0">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 mt-5 border-bottom pb-2" style="color: var(--steel);">Kerjasama Lintas Sektoral & Evaluasi</h6>
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label w-100"><i class="fas fa-building"></i> Instansi Pendukung di Lokasi</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln">
                                        <label class="form-check-label" for="inst_pln">PLN</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi">
                                        <label class="form-check-label" for="inst_polisi">Polisi</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni">
                                        <label class="form-check-label" for="inst_tni">TNI</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi">
                                        <label class="form-check-label" for="inst_pmi">BPBD</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal">
                                        <label class="form-check-label" for="inst_relawan">Relawan Lokal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-md-8">
                                    <label class="field-label"><i class="fas fa-tasks"></i> Tindakan Instansi Samping</label>
                                    <textarea class="form-control" name="tindakan_instansi" rows="2" placeholder="Contoh: PLN melakukan pemutusan arus..."></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="field-label"><i class="fas fa-phone-alt"></i> No. Kontak Saksi/Warga</label>
                                    <input type="text" name="kontak_saksi" id="kontak_saksi" class="form-control"
                                           placeholder="08xxxxxxxxxx" inputmode="numeric" pattern="[0-9]*" maxlength="15"
                                           title="Hanya boleh angka" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4 border-bottom pb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-plus-circle"></i> Kebutuhan Tambahan</label>
                                    <textarea class="form-control" name="kebutuhan_tambahan" rows="2" placeholder="Dibutuhkan drone thermal..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-lightbulb"></i> Saran Mitigasi Warga</label>
                                    <textarea class="form-control" name="saran_mitigasi" rows="2" placeholder="Sosialisasi APAR..."></textarea>
                                </div>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-12">
                                    <label class="field-label"><i class="fas fa-hands-helping"></i> Cara Bertindak</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select w-50" name="cara_bertindak" id="cara_bertindak">
                                            <option selected value="5T">5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)</option>
                                            <option value="lainnya">Lainnya...</option>
                                        </select>
                                        <input type="text" class="form-control w-50" name="cara_bertindak_lainnya" id="cara_bertindak_lainnya" placeholder="Ketik jika 'Lainnya'..." disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="section-title-block mt-5">
                                <i class="fas fa-camera"></i> Dokumentasi Akhir
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="field-label"><i class="fas fa-align-left"></i> Kronologi Terperinci</label>
                                    <textarea class="form-control" name="kronologi_lengkap" rows="5" placeholder="Uraian singkat operasi..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="field-label"><i class="fas fa-images"></i> Upload Foto (.jpg/.png)</label>
                                        <input class="form-control" type="file" name="foto[]" multiple accept="image/png, image/jpeg">
                                    </div>
                                    <div>
                                        <label class="field-label"><i class="fas fa-video"></i> Upload Video (.mp4)</label>
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
                                                <option selected value="">-- Pilih --</option>
                                                <option value="ular">Ular</option>
                                                <option value="tawon">Tawon/Vespa</option>
                                                <option value="kera">Kera</option>
                                                <option value="biawak">Biawak</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <input type="text" class="form-control w-50" name="jenis_hewan_lainnya" id="jenis_hewan_lainnya" placeholder="Ketik jika 'Lainnya'..." disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label"><i class="fas fa-tag"></i> Spesies/Lokal</label>
                                        <input type="text" name="spesies_hewan" class="form-control" placeholder="Cth: King Cobra">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-ruler"></i> Dimensi</label>
                                        <input type="text" name="dimensi_hewan" class="form-control" placeholder="Panjang ±3 meter">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-balance-scale"></i> Berat Hewan</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" name="berat_hewan" class="form-control" placeholder="Cth: 5">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-share-square"></i> Status Pasca Evakuasi</label>
                                        <select class="form-select" name="status_hewan_pasca">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="dilepasliarkan">Dilepasliarkan</option>
                                            <option value="diserahkan_bksda">Diserahkan BKSDA</option>
                                            <option value="mati">Mati</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="field-label"><i class="fas fa-tree"></i> Lokasi Pelepasan</label>
                                        <input type="text" name="lokasi_pelepasan" class="form-control" placeholder="Habitat...">
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
                                            <option selected value="">-- Pilih --</option>
                                            <option value="pohon">Pohon</option>
                                            <option value="baliho">Baliho</option>
                                            <option value="tiang_listrik">Tiang Listrik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-expand-arrows-alt"></i> Dimensi Objek</label>
                                        <div class="input-group">
                                            <input type="number" min="0" step="0.1" name="dimensi_objek" class="form-control" placeholder="0">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-plug"></i> Utilitas Terkait</label>
                                        <select class="form-select" name="status_utilitas">
                                            <option selected value="">-- Tidak Ada --</option>
                                            <option value="kabel_pln">Kabel PLN putus</option>
                                            <option value="pipa_pdam">Pipa PDAM bocor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-house-damage"></i> Dampak Properti</label>
                                        <textarea class="form-control" name="dampak_properti" rows="2" placeholder="Menutup jalan, menimpa pagar..."></textarea>
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
                                            <option selected value="">-- Pilih --</option>
                                            <option value="arus_deras">Arus Deras</option>
                                            <option value="arus_tenang">Arus Tenang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-search-location"></i> Radius Pencarian</label>
                                        <div class="input-group">
                                            <input type="number" min="0" name="radius_pencarian" class="form-control" placeholder="0">
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-binoculars"></i> Metode Pencarian</label>
                                        <select class="form-select" name="metode_pencarian_air">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="penyelaman">Penyelaman</option>
                                            <option value="penyisiran">Penyisiran Perahu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="field-label"><i class="fas fa-swimmer"></i> Daftar Penyelam</label>
                                        <input type="text" name="daftar_penyelam" class="form-control" placeholder="Nama bersertifikasi...">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ring/Object Removal & Geografis -->
                            <div class="highlight-area pb-4 mb-0">
                                <h6 class="fw-bold mb-3" style="color: var(--navy); font-family: var(--font-display);"><i class="fas fa-ring me-2"></i>Ring/Object Removal & Geografis</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-ring"></i> Jenis Benda</label>
                                        <input type="text" name="jenis_benda_bahaya" class="form-control" placeholder="Cincin, kaleng...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-hand-paper"></i> Kondisi Anggota Tubuh</label>
                                        <select class="form-select" name="kondisi_anggota_tubuh">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="bengkak">Bengkak</option>
                                            <option value="luka_terbuka">Luka Terbuka</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label"><i class="fas fa-cut"></i> Alat Potong</label>
                                        <select class="form-select" name="alat_potong_cincin">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="gerinda_mini">Gerinda Mini</option>
                                            <option value="tang_baja">Tang Baja</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-cloud-sun"></i> Cuaca Operasi</label>
                                        <select class="form-select" name="cuaca_operasi">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="cerah">Cerah</option>
                                            <option value="hujan_lebat">Hujan Lebat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-mountain"></i> Jenis Medan</label>
                                        <select class="form-select" name="jenis_medan">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="pemukiman_padat">Pemukiman Padat</option>
                                            <option value="perkebunan">Perkebunan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label class="field-label"><i class="fas fa-road"></i> Akses Lokasi</label>
                                        <select class="form-select" name="akses_lokasi">
                                            <option selected value="">-- Pilih --</option>
                                            <option value="kendaraan_berat">Bisa dilalui Roda 4+</option>
                                            <option value="roda_dua">Hanya Roda 2</option>
                                            <option value="jalan_kaki">Hanya Jalan Kaki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                        <button type="reset" class="btn-custom-light me-3">Batal</button>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Data Penyelamatan
                        </button>
                    </div>
                </form>
            </div>
        </div>

<!-- ==================== PETA MODAL ==================== -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fs-5" id="mapModalLabel"><i class="fas fa-map-marked-alt text-primary me-2"></i>Pilih Titik Lokasi Kejadian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
      <div class="modal-footer border-0 pt-0 d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size: 13px; line-height: 1.4;">
            Geser pin merah atau klik peta untuk menentukan koordinat.<br>
            Koordinat saat ini: <strong id="latlngDisplay" class="text-dark">-1.61157, 103.57860</strong>
        </span>
        <div class="d-flex gap-2">
            <button type="button" class="btn-custom-light" style="padding: 8px 16px; min-height: unset;" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn-custom-primary" style="padding: 8px 16px; min-height: unset;" onclick="simpanKoordinat()">Gunakan Koordinat</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==================== SCRIPTS ==================== -->
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function () {
    'use strict';

    /* ---------- Leaflet Map Logic ---------- */
    let map;
    let marker;
    const myModalEl = document.getElementById('mapModal');

    if (myModalEl) {
        myModalEl.addEventListener('shown.bs.modal', event => {
            if(!map) {
                map = L.map('map').setView([-1.61157, 103.57860], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([-1.61157, 103.57860], {draggable: true}).addTo(map);

                marker.on('dragend', function (e) {
                    document.getElementById('latlngDisplay').innerText = marker.getLatLng().lat.toFixed(5) + ', ' + marker.getLatLng().lng.toFixed(5);
                });

                map.on('click', function(e){
                    marker.setLatLng(e.latlng);
                    document.getElementById('latlngDisplay').innerText = e.latlng.lat.toFixed(5) + ', ' + e.latlng.lng.toFixed(5);
                });
            }
            setTimeout(function() { map.invalidateSize(); }, 10);
        });
    }

    /* ---------- Simpan Koordinat ke Input ---------- */
    window.simpanKoordinat = function() {
        if(marker) {
            const lat = marker.getLatLng().lat.toFixed(5);
            const lng = marker.getLatLng().lng.toFixed(5);
            document.getElementById('inputKoordinat').value = lat + ', ' + lng;
        }
        let modalInstance = bootstrap.Modal.getInstance(myModalEl);
        if(modalInstance) modalInstance.hide();
    }

    /* ---------- LOGIKA INPUT LAINNYA ---------- */
    function setupLainnyaLogic(selectId, inputId) {
        const selectEl = document.getElementById(selectId);
        const inputEl = document.getElementById(inputId);
        
        if(selectEl && inputEl) {
            // Cek status saat pertama kali load
            inputEl.disabled = selectEl.value !== 'lainnya';
            
            // Cek saat dropdown berubah
            selectEl.addEventListener('change', function() {
                if(this.value === 'lainnya') {
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

    /* ---------- AUTO-ARAHKAN KE TAB & KOLOM YANG KOSONG ---------- */
    document.addEventListener('invalid', function (e) {
        let invalidField = e.target;
        
        // Pastikan yang error adalah input di dalam form
        if(invalidField.tagName === 'INPUT' || invalidField.tagName === 'SELECT' || invalidField.tagName === 'TEXTAREA') {
            e.preventDefault(); // Cegah error diam-diam dari browser
            
            let tabPane = invalidField.closest('.tab-pane');
            if (tabPane && !tabPane.classList.contains('active')) {
                let tabId = tabPane.getAttribute('id');
                let tabButton = document.querySelector('[data-bs-target="#' + tabId + '"]');
                if (tabButton) {
                    let tab = new bootstrap.Tab(tabButton);
                    tab.show(); // Pindah otomatis ke tab yang ada errornya
                }
            }
            
            // Tunggu animasi tab selesai, lalu sorot inputnya
            setTimeout(function() {
                invalidField.focus();
                invalidField.reportValidity(); // Munculkan pesan peringatan
            }, 250);
        }
    }, true); // parameter `true` penting untuk menangkap event `invalid`

})();
</script>
@endpush
