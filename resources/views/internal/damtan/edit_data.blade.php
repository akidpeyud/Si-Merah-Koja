@extends('layouts.dashboard')

@section('title', 'Edit Data Penyelamatan')

{{-- ==================== CSS KHUSUS HALAMAN INI (sama dengan halaman input) ==================== --}}
@push('styles')
<style>
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }

    /* ---------- Kartu utama + Tabs ---------- */
    .tabs-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); }
    .card-header-tabs { background: #fff; border-bottom: 1px solid var(--line); padding: 14px 20px 0; border-radius: var(--r-md) var(--r-md) 0 0; }
    .nav-tabs-custom { border-bottom: none; display: flex; gap: 4px; overflow-x: auto; white-space: nowrap; scrollbar-width: none; }
    .nav-tabs-custom::-webkit-scrollbar { display: none; }
    .nav-tabs-custom .nav-item { margin-bottom: -1px; }
    .nav-tabs-custom .nav-link { display: inline-flex; align-items: center; gap: 10px; font-family: var(--font-display); font-weight: 600; font-size: .93rem; color: var(--steel); background: transparent; border: 1px solid transparent; border-radius: 8px 8px 0 0; padding: 12px 18px; transition: all .2s ease; }
    .nav-tabs-custom .nav-link .no { width: 22px; height: 22px; border-radius: 50%; display: grid; place-items: center; background: var(--line); color: var(--steel); font-size: .75rem; font-weight: 700; transition: all .2s; }
    .nav-tabs-custom .nav-link:hover { color: var(--navy); }
    .nav-tabs-custom .nav-link.active { color: var(--navy); background: #f8fafc; border-color: var(--line) var(--line) #f8fafc var(--line); }
    .nav-tabs-custom .nav-link.active .no { background: var(--navy); color: #fff; }
    .tabs-card .tab-content { padding: 24px; background: #f8fafc; border-radius: 0 0 var(--r-md) var(--r-md); }

    /* ---------- Kartu bagian (section) ---------- */
    .form-section { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); margin-bottom: 18px; overflow: hidden; }
    .form-section:last-child { margin-bottom: 0; }
    .form-section__head { display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-bottom: 1px solid var(--line); }
    .form-section__head .ico { flex: none; width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center; background: var(--navy-soft); color: var(--navy); font-size: .9rem; }
    .form-section__head h3 { font-family: var(--font-display); font-size: 1rem; font-weight: 700; margin: 0; color: var(--ink); line-height: 1.2; }
    .form-section__head p { margin: 2px 0 0; font-size: .8rem; color: var(--steel); }
    .form-section__body { padding: 20px; }
    .form-section.is-danger .ico { background: var(--signal-soft); color: var(--signal); }

    .sub-title { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--steel); margin: 20px 0 12px; padding-bottom: 8px; border-bottom: 1px dashed var(--line); }
    .sub-title:first-child { margin-top: 0; }

    /* ---------- Elemen form ---------- */
    .field-label { display: block; font-size: .84rem; font-weight: 700; color: var(--ink-2); margin-bottom: 6px; }
    .req { color: var(--signal); margin-left: 2px; }
    .field-hint { display: block; margin-top: 5px; font-size: .76rem; color: var(--steel); line-height: 1.4; }
    .form-control:disabled, .form-select:disabled { background-color: #f1f5f9; cursor: not-allowed; opacity: 1; border-color: var(--line); color: var(--steel); }
    .form-control[readonly] { background-color: #f1f5f9; color: var(--steel); }
    .is-invalid { border-color: var(--signal) !important; box-shadow: 0 0 0 3px var(--signal-soft) !important; }
    .pair { display: flex; gap: 8px; }
    .pair > * { flex: 1 1 0; min-width: 0; }
    @media (max-width: 575.98px) { .pair { flex-direction: column; } }

    /* ---------- Rincian objek kebakaran (muncul sesuai pilihan) ---------- */
    .sub-objek { display: none; }
    .sub-objek.is-active { display: block; }

    /* ---------- Pilihan berbentuk pill (checkbox & radio) ---------- */
    .choice-group { display: flex; flex-wrap: wrap; gap: 8px; }
    .choice { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid var(--line-dark); border-radius: 999px; background: #fff; font-size: .87rem; font-weight: 600; color: var(--ink-2); cursor: pointer; transition: all .2s; user-select: none; margin: 0; }
    .choice:hover { border-color: var(--navy); background: var(--navy-light); }
    .choice input { accent-color: var(--navy); margin: 0; cursor: pointer; }
    .choice:has(input:checked) { border-color: var(--navy); background: var(--navy-light); color: var(--navy-dark); }
    .choice:has(input:focus-visible) { outline: 3px solid var(--amber); outline-offset: 2px; }
    .choice.prio-rendah:has(input:checked)  { border-color: var(--steel);  background: #eef1f5; color: var(--steel); }
    .choice.prio-sedang:has(input:checked)  { border-color: var(--info);   background: var(--info-soft); color: var(--info); }
    .choice.prio-tinggi:has(input:checked)  { border-color: var(--amber);  background: rgba(244,183,64,.15); color: #a16207; }
    .choice.prio-darurat:has(input:checked) { border-color: var(--signal); background: var(--signal-soft); color: var(--signal-dark); }

    /* ---------- Tombol ---------- */
    .btn-custom-primary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13,27,42,.15); color: #fff; }
    .btn-custom-primary:active { transform: translateY(0); }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 22px; background: #fff; color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; text-decoration: none; transition: all .2s ease; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .btn-outline-primary { color: var(--navy); border-color: var(--navy); font-weight: 600; border-radius: 8px; background: transparent; min-height: 42px; font-size: .9rem; }
    .btn-outline-primary:hover { background-color: var(--navy); color: #fff; border-color: var(--navy); }

    .tab-nav { display: flex; justify-content: space-between; gap: 12px; margin-top: 20px; }
    .tab-nav .spacer { flex: 1; }

    .action-bar { position: sticky; bottom: 0; z-index: 20; display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; padding: 14px 20px; margin-top: 18px; background: rgba(255,255,255,.94); -webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px); border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-md); }
    .action-bar small { color: var(--steel); font-size: .82rem; }
</style>
@endpush

{{-- ==================== ISI HALAMAN ==================== --}}
@section('content')
@php
    /* HAK AKSES EDIT: hanya Damtan & Super User. Role lain hanya boleh lihat & cetak. */
    if (!Auth::user()->hasAnyRole(['Damtan', 'Super User'])) {
        abort(403, 'Anda tidak memiliki hak akses untuk mengubah data laporan. Role Anda hanya dapat melihat dan mencetak.');
    }

    /* Decode kolom JSON dengan aman (kolom bisa berupa string JSON atau sudah array) */
    $dec = fn ($v) => is_array($v) ? $v : (json_decode($v ?? '[]', true) ?? []);

    /* Penanda "selected" untuk <option> */
    $sel = fn ($a, $b) => (string) ($a ?? '') === (string) $b ? 'selected' : '';

    /* Format datetime-local */
    $dt = fn ($v) => $v ? date('Y-m-d\TH:i', strtotime($v)) : '';

    $evakuasi     = $dec($teknis->metode_evakuasi ?? null);
    $penyelamatan = $dec($teknis->metode_penyelamatan ?? null);
    $alat         = $dec($teknis->peralatan ?? null);
    $armada       = $dec($teknis->armada ?? null);
    $instansi     = $dec($dokumentasi->instansi_pendukung ?? null);
    $rin          = $dec($laporan->rincian_objek ?? null);   // rincian objek kebakaran (JSON)

    /* Tanggal kejadian: dari waktu kejadian, jika kosong pakai waktu terima / tanggal dibuat */
    $tglKejadian = \Carbon\Carbon::parse($laporan->waktu_kejadian ?: ($laporan->waktu_terima ?: $laporan->created_at))->format('Y-m-d');

    $optMedia = [
        'whatsapp' => 'Layanan WA Damkar', 'telepon' => 'Telepon Call Center',
        'langsung' => 'Datang Langsung ke Mako/Pos', 'instansi_lain' => 'Laporan Instansi Lain',
    ];
    $optKategori = [
        'kebakaran' => 'Kebakaran', 'penyelamatan_hewan' => 'Penyelamatan Hewan', 'bencana_alam' => 'Bencana Alam',
        'kecelakaan_lalu_lintas' => 'Kecelakaan Lalu Lintas', 'evakuasi_medis' => 'Evakuasi Medis',
    ];
    $optObjek = [
        'rumah' => 'Rumah', 'gudang' => 'Gudang', 'ruko' => 'Ruko', 'kantor' => 'Kantor', 'sekolah' => 'Sekolah',
        'rumah_ibadah' => 'Rumah Ibadah', 'pasar_tempat_usaha' => 'Pasar / Tempat Usaha',
        'kendaraan_bermotor' => 'Kendaraan Bermotor', 'objek_vital' => 'Objek Vital',
        'sarana_kesehatan' => 'Sarana Kesehatan', 'lahan_pohon' => 'Lahan, Pohon',
        'gardu_listrik' => 'Gardu Listrik', 'tempat_sampah' => 'Tempat Pembuangan Sampah',
    ];
    $optNonKebakaran = [
        'fire_rescue' => 'Fire Rescue', 'water_rescue' => 'Water Rescue', 'land_rescue' => 'Land Rescue',
        'evakuasi_liar' => 'Evakuasi Hewan Liar', 'evakuasi_ternak' => 'Evakuasi Ternak',
        'evakuasi_piaraan' => 'Evakuasi Hewan Peliharaan', 'evakuasi_cincin' => 'Evakuasi Cincin / Anting',
        'evakuasi_kendaraan' => 'Evakuasi Kendaraan Bermotor', 'lainnya' => 'Lainnya',
    ];
    $optPenyebab = [
        'arus_pendek' => 'Arus pendek listrik', 'kebocoran_gas' => 'Kebocoran gas', 'sambaran_petir' => 'Sambaran petir',
        'kelalaian_manusia' => 'Kelalaian manusia', 'faktor_alam' => 'Faktor alam', 'lainnya' => 'Lainnya',
    ];
    $prio = $laporan->prioritas ?? 'rendah';
@endphp

<div class="page-head d-flex flex-wrap justify-content-between align-items-start gap-3">
    <div>
        <h1>Edit Data Penyelamatan</h1>
        <p>Ubah data laporan penyelamatan yang sudah ada.</p>
    </div>
    <a href="/internal/damtan/data-laporan" class="btn-custom-light">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
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

<form id="formEditPenyelamatan" action="{{ route('damtan.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="tabs-card">
        <!-- BOOTSTRAP TABS -->
        <div class="card-header-tabs">
            <ul class="nav nav-tabs-custom" id="formTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab"><span class="no">1</span> Informasi Dasar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="teknis-tab" data-bs-toggle="tab" data-bs-target="#teknis" type="button" role="tab"><span class="no">2</span> Teknis & Logistik</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dokumentasi-tab" data-bs-toggle="tab" data-bs-target="#dokumentasi" type="button" role="tab"><span class="no">3</span> Dokumentasi & Validasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="khusus-tab" data-bs-toggle="tab" data-bs-target="#khusus" type="button" role="tab"><span class="no">4</span> Kategori Khusus</button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="formTabsContent">

            {{-- ==========================================================
                 TAB 1: INFORMASI DASAR
                 ========================================================== --}}
            <div class="tab-pane fade show active" id="info" role="tabpanel">

                <!-- Identitas laporan -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-hashtag"></i></span>
                        <div><h3>Identitas Laporan</h3><p>Nomor dan ID laporan tidak dapat diubah.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label">Nomor Laporan</label>
                                <input type="text" class="form-control" name="nomor_laporan" value="{{ $laporan->nomor_laporan }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">ID Laporan</label>
                                <input type="text" class="form-control" name="id_laporan" value="{{ $laporan->id_laporan }}" readonly>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Hari & tanggal -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-calendar-day"></i></span>
                        <div><h3>Hari & Tanggal Kejadian</h3><p>Hari, bulan, dan tahun terisi otomatis dari tanggal.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="field-label">Tanggal Kejadian <span class="req">*</span></label>
                                <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" class="form-control" value="{{ $tglKejadian }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="field-label">Hari</label>
                                <input type="text" name="hari_kejadian" id="hari_kejadian" class="form-control" readonly placeholder="Otomatis">
                            </div>
                            <div class="col-md-3">
                                <label class="field-label">Bulan</label>
                                <input type="text" name="bulan_kejadian" id="bulan_kejadian" class="form-control" readonly placeholder="Otomatis">
                            </div>
                            <div class="col-md-3">
                                <label class="field-label">Tahun</label>
                                <input type="text" name="tahun_kejadian" id="tahun_kejadian" class="form-control" readonly placeholder="Otomatis">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Pelapor -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-user"></i></span>
                        <div><h3>Data Pelapor</h3><p>Siapa yang melapor dan melalui layanan apa.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">Nama Pelapor <span class="req">*</span></label>
                                <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $laporan->nama_pelapor ?? '') }}" placeholder="Cth: Bapak Iskandar" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Nomor Telepon / WA Pelapor</label>
                                <input type="text" name="telepon_pelapor" id="telepon_pelapor" class="form-control"
                                       value="{{ preg_replace('/\D/', '', $laporan->telepon_pelapor ?? '') }}"
                                       placeholder="08xxxxxxxxxx" inputmode="numeric" pattern="[0-9]*" maxlength="15"
                                       title="Hanya boleh angka" autocomplete="off">
                                <small class="field-hint">Hanya angka.</small>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Layanan Pelaporan</label>
                                <select class="form-select" name="media_pelaporan">
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach ($optMedia as $v => $l)
                                        <option value="{{ $v }}" {{ $sel($laporan->media_pelaporan, $v) }}>{{ $l }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Jarak Tempuh</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" min="0" name="jarak_tempuh" class="form-control" value="{{ $laporan->jarak_tempuh ?? '' }}" placeholder="Cth: 4.1">
                                    <span class="input-group-text">Km</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Klasifikasi -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-layer-group"></i></span>
                        <div><h3>Klasifikasi Kejadian</h3><p>Untuk kebakaran, pilih objek kebakaran beserta rinciannya.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="field-label">Kategori Kejadian Umum</label>
                                    <select class="form-select" name="kategori_kejadian" id="kategori_kejadian">
                                        <option value="">-- Pilih Kategori Kejadian --</option>
                                        @foreach ($optKategori as $v => $l)
                                            <option value="{{ $v }}" {{ $sel($laporan->kategori_kejadian, $v) }}>{{ $l }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Tingkat Prioritas (di bawah Kategori Kejadian Umum) --}}
                                <div>
                                    <label class="field-label">Tingkat Prioritas</label>
                                    <div class="choice-group">
                                        <label class="choice prio-rendah"><input type="radio" name="prioritas" id="prio1" value="rendah" {{ $prio == 'rendah' ? 'checked' : '' }}> Rendah</label>
                                        <label class="choice prio-sedang"><input type="radio" name="prioritas" id="prio2" value="sedang" {{ $prio == 'sedang' ? 'checked' : '' }}> Sedang</label>
                                        <label class="choice prio-tinggi"><input type="radio" name="prioritas" id="prio3" value="tinggi" {{ $prio == 'tinggi' ? 'checked' : '' }}> Tinggi</label>
                                        <label class="choice prio-darurat"><input type="radio" name="prioritas" id="prio4" value="darurat" {{ $prio == 'darurat' ? 'checked' : '' }}> Darurat</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Objek kebakaran (tampil jika kategori = Kebakaran) --}}
                            <div class="col-md-8" id="blokKebakaran">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Objek Kebakaran <span class="req">*</span></label>
                                        <select class="form-select" name="objek_kebakaran" id="objek_kebakaran" required>
                                            <option value="">-- Pilih Objek --</option>
                                            @foreach ($optObjek as $v => $l)
                                                <option value="{{ $v }}" {{ $sel($laporan->kategori_kebakaran, $v) }}>{{ $l }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="field-label">Keterangan Objek</label>
                                        <input type="text" class="form-control" name="keterangan_objek_kebakaran" id="keterangan_objek_kebakaran"
                                               value="{{ $laporan->keterangan_objek_kebakaran ?? '' }}"
                                               placeholder="Cth: Rumah milik Bpk. Iskandar, 2 lantai...">
                                    </div>

                                    {{-- Rincian objek (muncul sesuai pilihan objek) --}}
                                    <div class="col-12">
                                        {{-- Rumah: jenis bangunan + unit --}}
                                        <div class="sub-objek" data-objek="rumah">
                                            <label class="field-label">Rincian Rumah</label>
                                            <div class="pair">
                                                <select class="form-select" name="tipe_bangunan_rumah" disabled>
                                                    <option value="">-- Jenis Bangunan --</option>
                                                    <option value="permanen" {{ $sel($rin['tipe_bangunan_rumah'] ?? '', 'permanen') }}>Permanen</option>
                                                    <option value="semi_permanen" {{ $sel($rin['tipe_bangunan_rumah'] ?? '', 'semi_permanen') }}>Semi Permanen</option>
                                                    <option value="non_permanen" {{ $sel($rin['tipe_bangunan_rumah'] ?? '', 'non_permanen') }}>Non Permanen</option>
                                                </select>
                                                <select class="form-select" name="unit_rumah" disabled>
                                                    <option value="">-- Unit --</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}" {{ $sel($rin['unit_rumah'] ?? '', $i) }}>{{ $i }} Unit</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Gudang / Ruko / Kantor / Sekolah: unit --}}
                                        @foreach (['gudang' => 'Gudang', 'ruko' => 'Ruko', 'kantor' => 'Kantor', 'sekolah' => 'Sekolah'] as $key => $label)
                                        <div class="sub-objek" data-objek="{{ $key }}">
                                            <label class="field-label">Rincian {{ $label }}</label>
                                            <select class="form-select" name="unit_{{ $key }}" disabled>
                                                <option value="">-- Jumlah Unit --</option>
                                                @for ($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}" {{ $sel($rin['unit_' . $key] ?? '', $i) }}>{{ $i }} Unit</option>
                                                @endfor
                                            </select>
                                        </div>
                                        @endforeach

                                        {{-- Pasar / tempat usaha --}}
                                        <div class="sub-objek" data-objek="pasar_tempat_usaha">
                                            <label class="field-label">Rincian Pasar / Tempat Usaha</label>
                                            <input type="text" class="form-control" name="nama_pasar_tempat_usaha" value="{{ $rin['nama_pasar_tempat_usaha'] ?? '' }}" placeholder="Nama pasar / tempat usaha..." disabled>
                                        </div>

                                        {{-- Kendaraan bermotor --}}
                                        <div class="sub-objek" data-objek="kendaraan_bermotor">
                                            <label class="field-label">Rincian Kendaraan Bermotor</label>
                                            <select class="form-select" name="jenis_kendaraan" disabled>
                                                <option value="">-- Jenis Kendaraan --</option>
                                                <option value="r2" {{ $sel($rin['jenis_kendaraan'] ?? '', 'r2') }}>Roda 2 (R2)</option>
                                                <option value="r4" {{ $sel($rin['jenis_kendaraan'] ?? '', 'r4') }}>Roda 4 (R4)</option>
                                                <option value="r6" {{ $sel($rin['jenis_kendaraan'] ?? '', 'r6') }}>Roda 6 (R6)</option>
                                            </select>
                                        </div>

                                        {{-- Objek vital --}}
                                        <div class="sub-objek" data-objek="objek_vital">
                                            <label class="field-label">Rincian Objek Vital</label>
                                            <select class="form-select" name="jenis_objek_vital" disabled>
                                                <option value="">-- Pilih Objek Vital --</option>
                                                <option value="bandara" {{ $sel($rin['jenis_objek_vital'] ?? '', 'bandara') }}>Bandara</option>
                                                <option value="telkom" {{ $sel($rin['jenis_objek_vital'] ?? '', 'telkom') }}>Telkom</option>
                                                <option value="pertamina" {{ $sel($rin['jenis_objek_vital'] ?? '', 'pertamina') }}>Pertamina</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Kategori non-kebakaran (tampil jika kategori bukan Kebakaran) --}}
                            <div class="col-md-8" id="blokNonKebakaran" style="display:none;">
                                <label class="field-label">Kategori Laporan (Non-Kebakaran)</label>
                                <div class="pair">
                                    <select class="form-select" name="kategori_non_kebakaran" id="kategori_non_kebakaran" disabled>
                                        <option value="">-- Pilih Jenis Evakuasi --</option>
                                        @foreach ($optNonKebakaran as $v => $l)
                                            <option value="{{ $v }}" {{ $sel($laporan->kategori_non_kebakaran, $v) }}>{{ $l }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="rincian_kategori_non_kebakaran" id="rincian_kategori_non_kebakaran" value="{{ $laporan->rincian_kategori_non_kebakaran ?? '' }}" placeholder="Ketik jika 'Lainnya'..." disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Waktu penanganan -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-clock"></i></span>
                        <div><h3>Waktu Penanganan</h3><p>Diurutkan dari kejadian sampai unit kembali ke Mako. Respon time dihitung otomatis.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">1. Waktu Kejadian</label>
                                <input type="datetime-local" name="waktu_kejadian" class="form-control" value="{{ $dt($laporan->waktu_kejadian) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">2. Waktu Terima Laporan <span class="req">*</span></label>
                                <input type="datetime-local" name="waktu_terima" id="waktu_terima" class="form-control" value="{{ $dt($laporan->waktu_terima) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">3. Waktu Berangkat Unit</label>
                                <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ $dt($laporan->waktu_berangkat) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">4. Waktu Tiba di Lokasi <span class="req">*</span></label>
                                <input type="datetime-local" name="waktu_tiba" id="waktu_tiba" class="form-control" value="{{ $dt($laporan->waktu_tiba) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">5. Waktu Operasi Selesai</label>
                                <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $dt($laporan->waktu_selesai) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">6. Waktu Kembali ke Mako</label>
                                <input type="datetime-local" name="waktu_kembali" class="form-control" value="{{ $dt($laporan->waktu_kembali) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Respon Time (Terima → Tiba)</label>
                                <div class="input-group">
                                    <input type="text" name="respon_time" id="respon_time" class="form-control" readonly placeholder="Otomatis">
                                    <span class="input-group-text">Menit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Lokasi -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-map-marker-alt"></i></span>
                        <div><h3>Lokasi Kejadian</h3><p>Alamat lengkap dan titik koordinat dari Google Maps.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="field-label">Lokasi Kejadian / Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" rows="4" placeholder="Nama jalan, RT/RW, Kelurahan, Kecamatan...">{{ $laporan->alamat }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Titik Koordinat</label>
                                <input type="text" class="form-control mb-2" id="inputKoordinat" name="koordinat" value="{{ $laporan->koordinat }}" placeholder="-1.61157, 103.57860">
                                <button type="button" class="btn-outline-primary w-100" id="btnGoogleMaps">
                                    <i class="fab fa-google me-1"></i> Buka Google Maps
                                </button>
                                <small class="field-hint">Klik kanan titik di Google Maps, klik angka koordinat untuk menyalin, lalu tempel di kolom di atas.</small>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="tab-nav">
                    <span class="spacer"></span>
                    <button type="button" class="btn-custom-primary" data-go-tab="#teknis-tab">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            {{-- ==========================================================
                 TAB 2: TEKNIS & LOGISTIK
                 ========================================================== --}}
            <div class="tab-pane fade" id="teknis" role="tabpanel">

                <!-- Tim operasi -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-user-shield"></i></span>
                        <div><h3>Tim Operasi</h3><p>Pimpinan, pendamping, satgas, dan tim quick respon di lapangan.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">Pimpinan Operasi</label>
                                <input type="text" name="pimpinan_operasi" class="form-control" value="{{ $teknis->pimpinan_operasi ?? '' }}" placeholder="Cth: Danru 4 Mako">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Pendamping Operasi</label>
                                <input type="text" name="pendamping_operasi" class="form-control" value="{{ $teknis->pendamping_operasi ?? '' }}" placeholder="Opsional...">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Satgas Operasi</label>
                                <input type="text" name="satgas_operasi" class="form-control" value="{{ $teknis->satuan_tugas ?? '' }}" placeholder="Cth: Pleton 1 Mako">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Tim Quick Respon Damkar</label>
                                <input type="text" name="tim_quick_respon" class="form-control" value="{{ $teknis->tim_respontime ?? '' }}" placeholder="Cth: Tim QR 1">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Lama Operasi</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="lama_operasi" id="lama_operasi" class="form-control" value="{{ $teknis->lama_operasi ?? '' }}" placeholder="0">
                                    <span class="input-group-text">Menit</span>
                                </div>
                                <small class="field-hint">Terisi otomatis dari Waktu Tiba sampai Waktu Operasi Selesai (bisa diubah manual).</small>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Korban & dampak -->
                <section class="form-section is-danger">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-heart-pulse"></i></span>
                        <div><h3>Korban & Dampak</h3><p>Status korban manusia, jiwa terdampak, hewan, dan aset yang terdampak.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <label class="field-label">Selamat</label>
                                <input type="number" min="0" name="korban_selamat" class="form-control" value="{{ $teknis->korban_selamat ?? 0 }}">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="field-label">Luka Ringan</label>
                                <input type="number" min="0" name="korban_ringan" class="form-control" value="{{ $teknis->korban_ringan ?? 0 }}">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="field-label">Luka Berat</label>
                                <input type="number" min="0" name="korban_berat" class="form-control" value="{{ $teknis->korban_berat ?? 0 }}">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="field-label">Korban Jiwa (Meninggal Dunia)</label>
                                <input type="number" min="0" name="korban_meninggal" class="form-control" value="{{ $teknis->korban_meninggal ?? 0 }}">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Jumlah Jiwa yang Terdampak</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="jiwa_terdampak" class="form-control" value="{{ $teknis->jiwa_terdampak ?? 0 }}">
                                    <span class="input-group-text">Jiwa</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label class="field-label">Hewan / Aset (Jika relevan)</label>
                                <input type="text" name="korban_hewan_aset" class="form-control" value="{{ $teknis->korban_hewan_aset ?? '' }}" placeholder="Contoh: 1 ekor ular piton dievakuasi, 2 unit motor terbakar...">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Status Evakuasi</label>
                                <select class="form-select" name="status_evakuasi">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="selesai" {{ $sel($teknis->status_evakuasi ?? '', 'selesai') }}>Selesai</option>
                                    <option value="dalam_proses" {{ $sel($teknis->status_evakuasi ?? '', 'dalam_proses') }}>Dalam Proses</option>
                                    <option value="dirujuk_ke_rs" {{ $sel($teknis->status_evakuasi ?? '', 'dirujuk_ke_rs') }}>Dirujuk ke RS</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="field-label">Objek Terdampak</label>
                                <input type="text" name="objek_terdampak" class="form-control" value="{{ $teknis->objek_terdampak ?? '' }}" placeholder="Contoh: Atap rumah warga, sumur tua, dsb.">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Metode & penanganan -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-hands-helping"></i></span>
                        <div><h3>Metode & Penanganan</h3><p>Cara evakuasi, penyelamatan, hambatan, dan hasilnya.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="mb-4">
                            <label class="field-label">Metode Evakuasi</label>
                            <div class="choice-group">
                                <label class="choice"><input type="checkbox" id="me_vr" name="metode_evakuasi[]" value="vertical_rescue" {{ in_array('vertical_rescue', $evakuasi) ? 'checked' : '' }}> Vertical Rescue</label>
                                <label class="choice"><input type="checkbox" id="me_wr" name="metode_evakuasi[]" value="water_rescue" {{ in_array('water_rescue', $evakuasi) ? 'checked' : '' }}> Water Rescue</label>
                                <label class="choice"><input type="checkbox" id="me_td" name="metode_evakuasi[]" value="tangga_darurat" {{ in_array('tangga_darurat', $evakuasi) ? 'checked' : '' }}> Penggunaan Tangga Darurat</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="field-label">Metode Penyelamatan</label>
                            <div class="choice-group">
                                <label class="choice"><input type="checkbox" id="mp_vr" name="metode_penyelamatan[]" value="vertical_rescue" {{ in_array('vertical_rescue', $penyelamatan) ? 'checked' : '' }}> Vertical Rescue</label>
                                <label class="choice"><input type="checkbox" id="mp_wr" name="metode_penyelamatan[]" value="water_rescue" {{ in_array('water_rescue', $penyelamatan) ? 'checked' : '' }}> Water Rescue</label>
                                <label class="choice"><input type="checkbox" id="mp_ps" name="metode_penyelamatan[]" value="pemadaman_statis" {{ in_array('pemadaman_statis', $penyelamatan) ? 'checked' : '' }}> Pemadam Statis</label>
                                <label class="choice"><input type="checkbox" id="mp_pd" name="metode_penyelamatan[]" value="pemadaman_dinamis" {{ in_array('pemadaman_dinamis', $penyelamatan) ? 'checked' : '' }}> Pemadam Dinamis</label>
                                <label class="choice"><input type="checkbox" id="mp_emd" name="metode_penyelamatan[]" value="evakuasi_medis_dasar" {{ in_array('evakuasi_medis_dasar', $penyelamatan) ? 'checked' : '' }}> Evakuasi Medis Dasar</label>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label">Hambatan Lapangan</label>
                                <textarea class="form-control" name="hambatan_lapangan" rows="3" placeholder="Tuliskan hambatan spesifik saat operasi di lapangan...">{{ $teknis->hambatan_lapangan ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Langkah Penanganan</label>
                                <textarea class="form-control" name="langkah_penanganan" rows="3" placeholder="Cth: Ular Sanca Berhasil Di Evakuasi Dengan Menggunakan Stik Hook...">{{ $teknis->langkah_penanganan ?? '' }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="field-label">Hasil Tindakan</label>
                                <input type="text" name="hasil_tindakan" class="form-control" value="{{ $teknis->hasil_tindakan ?? '' }}" placeholder="Cth: Evakuasi berhasil dengan aman dan lancar">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Alat & logistik -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-toolbox"></i></span>
                        <div><h3>Peralatan & Logistik</h3><p>Alat khusus dan konsumsi bahan selama operasi.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="mb-3">
                            <label class="field-label">Peralatan Khusus yang Digunakan</label>
                            <div class="choice-group mb-2">
                                <label class="choice"><input type="checkbox" id="alat_scba" name="peralatan[]" value="SCBA" {{ in_array('SCBA', $alat) ? 'checked' : '' }}> SCBA</label>
                                <label class="choice"><input type="checkbox" id="alat_thermal" name="peralatan[]" value="Thermal Camera" {{ in_array('Thermal Camera', $alat) ? 'checked' : '' }}> Thermal Camera</label>
                                <label class="choice"><input type="checkbox" id="alat_chainsaw" name="peralatan[]" value="Chainsaw" {{ in_array('Chainsaw', $alat) ? 'checked' : '' }}> Chainsaw</label>
                                <label class="choice"><input type="checkbox" id="alat_selam" name="peralatan[]" value="Alat Selam" {{ in_array('Alat Selam', $alat) ? 'checked' : '' }}> Alat Selam</label>
                            </div>
                            <input type="text" name="peralatan_lain" class="form-control" value="{{ $teknis->peralatan_lain ?? '' }}" placeholder="Alat khusus lainnya (pisahkan dengan koma)...">
                        </div>

                        <div class="sub-title">Konsumsi</div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="field-label">Konsumsi Alat Umum</label>
                                <input type="text" name="konsumsi_alat" class="form-control" value="{{ $teknis->konsumsi_alat ?? '' }}" placeholder="Contoh: penggunaan foam, combi tool...">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Jumlah Air yang Digunakan</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="jumlah_air" class="form-control" value="{{ $teknis->liter_air ?? '' }}" placeholder="0">
                                    <span class="input-group-text">Liter</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Liter Foam</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="liter_foam" class="form-control" value="{{ $teknis->liter_foam ?? '' }}" placeholder="0">
                                    <span class="input-group-text">L</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Liter BBM Unit</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="liter_bbm" class="form-control" value="{{ $teknis->liter_bbm ?? '' }}" placeholder="0">
                                    <span class="input-group-text">L</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Armada & personel -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-truck"></i></span>
                        <div><h3>Armada & Personel</h3><p>Unit yang diterjunkan dan personel yang terlibat.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="field-label">Unit Armada Terlibat</label>
                                <div class="choice-group">
                                    <label class="choice"><input type="checkbox" id="arm_pompa" name="armada[]" value="pompa" {{ in_array('pompa', $armada) ? 'checked' : '' }}> Unit Pompa</label>
                                    <label class="choice"><input type="checkbox" id="arm_rescue" name="armada[]" value="rescue" {{ in_array('rescue', $armada) ? 'checked' : '' }}> Unit Rescue</label>
                                    <label class="choice"><input type="checkbox" id="arm_tangki" name="armada[]" value="tangki" {{ in_array('tangki', $armada) ? 'checked' : '' }}> Unit Tangki</label>
                                    <label class="choice"><input type="checkbox" id="arm_ambulans" name="armada[]" value="ambulans" {{ in_array('ambulans', $armada) ? 'checked' : '' }}> Ambulans</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Jumlah Armada yang Digunakan</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="jumlah_armada" class="form-control" value="{{ $teknis->jumlah_armada ?? '' }}" placeholder="0">
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Jumlah Personel</label>
                                <input type="number" min="0" name="jumlah_personel" class="form-control" value="{{ $teknis->jumlah_personel ?? '' }}" placeholder="0">
                            </div>
                            <div class="col-md-8">
                                <label class="field-label">Personel yang Terlibat</label>
                                <textarea class="form-control" name="daftar_personel" rows="2" placeholder="Contoh: Budi, Andi, Joko...">{{ $teknis->daftar_personel ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="tab-nav">
                    <button type="button" class="btn-custom-light" data-go-tab="#info-tab"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                    <button type="button" class="btn-custom-primary" data-go-tab="#dokumentasi-tab">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            {{-- ==========================================================
                 TAB 3: DOKUMENTASI, EVALUASI & VALIDASI
                 ========================================================== --}}
            <div class="tab-pane fade" id="dokumentasi" role="tabpanel">

                <!-- Analisis -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-magnifying-glass-chart"></i></span>
                        <div><h3>Analisis Kejadian</h3><p>Dugaan penyebab, sumber api, dan luas area terdampak.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="field-label">Penyebab Kebakaran (Diduga)</label>
                                <div class="pair">
                                    <select class="form-select" name="dugaan_penyebab" id="dugaan_penyebab">
                                        <option value="">-- Pilih Penyebab --</option>
                                        @foreach ($optPenyebab as $v => $l)
                                            <option value="{{ $v }}" {{ $sel($dokumentasi->dugaan_penyebab ?? '', $v) }}>{{ $l }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="dugaan_penyebab_lainnya" id="dugaan_penyebab_lainnya" value="{{ $dokumentasi->dugaan_penyebab_lainnya ?? '' }}" placeholder="Ketik jika 'Lainnya'..." disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Sumber Api / Titik Awal</label>
                                <input type="text" name="sumber_api" class="form-control" value="{{ $dokumentasi->sumber_api ?? '' }}" placeholder="Contoh: Dapur, Panel Listrik utama...">
                            </div>
                            <div class="col-md-3">
                                <label class="field-label">Luas Area Terdampak</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="0.1" name="luas_area" class="form-control" value="{{ $dokumentasi->luas_area ?? '' }}" placeholder="0">
                                    <span class="input-group-text">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Lintas sektoral -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-handshake"></i></span>
                        <div><h3>Kerjasama Lintas Sektoral</h3><p>Instansi yang membantu di lokasi dan saksi.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="mb-3">
                            <label class="field-label">Instansi Pendukung di Lokasi</label>
                            <div class="choice-group">
                                <label class="choice"><input type="checkbox" id="inst_pln" name="instansi_pendukung[]" value="pln" {{ in_array('pln', $instansi) ? 'checked' : '' }}> PLN</label>
                                <label class="choice"><input type="checkbox" id="inst_polisi" name="instansi_pendukung[]" value="polisi" {{ in_array('polisi', $instansi) ? 'checked' : '' }}> Polisi</label>
                                <label class="choice"><input type="checkbox" id="inst_tni" name="instansi_pendukung[]" value="tni" {{ in_array('tni', $instansi) ? 'checked' : '' }}> TNI</label>
                                <label class="choice"><input type="checkbox" id="inst_pmi" name="instansi_pendukung[]" value="pmi" {{ in_array('pmi', $instansi) ? 'checked' : '' }}> BPBD</label>
                                <label class="choice"><input type="checkbox" id="inst_relawan" name="instansi_pendukung[]" value="relawan_lokal" {{ in_array('relawan_lokal', $instansi) ? 'checked' : '' }}> Relawan Lokal</label>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="field-label">Tindakan Instansi Samping</label>
                                <textarea class="form-control" name="tindakan_instansi" rows="3" placeholder="Contoh: PLN melakukan pemutusan arus...">{{ $dokumentasi->tindakan_instansi ?? '' }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">No. Kontak Saksi/Warga</label>
                                <input type="text" name="kontak_saksi" id="kontak_saksi" class="form-control"
                                       value="{{ preg_replace('/\D/', '', $dokumentasi->kontak_saksi ?? '') }}"
                                       placeholder="08xxxxxxxxxx" inputmode="numeric" pattern="[0-9]*" maxlength="15"
                                       title="Hanya boleh angka" autocomplete="off">
                                <small class="field-hint">Hanya angka.</small>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Evaluasi -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-clipboard-check"></i></span>
                        <div><h3>Evaluasi & Rekomendasi</h3><p>Kebutuhan tambahan, saran, dan cara bertindak.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label">Kebutuhan Tambahan</label>
                                <textarea class="form-control" name="kebutuhan_tambahan" rows="3" placeholder="Dibutuhkan drone thermal...">{{ $dokumentasi->kebutuhan_tambahan ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Saran Mitigasi Warga</label>
                                <textarea class="form-control" name="saran_mitigasi" rows="3" placeholder="Sosialisasi APAR...">{{ $dokumentasi->saran_mitigasi ?? '' }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="field-label">Cara Bertindak</label>
                                <div class="pair">
                                    <select class="form-select" name="cara_bertindak" id="cara_bertindak">
                                        <option value="5T" {{ $sel($dokumentasi->cara_bertindak ?? '5T', '5T') }}>5 T (Terencana, Terukur, Terarah, Terlayani & Tuntas)</option>
                                        <option value="lainnya" {{ $sel($dokumentasi->cara_bertindak ?? '', 'lainnya') }}>Lainnya...</option>
                                    </select>
                                    <input type="text" class="form-control" name="cara_bertindak_lainnya" id="cara_bertindak_lainnya" value="{{ $dokumentasi->cara_bertindak_lainnya ?? '' }}" placeholder="Ketik jika 'Lainnya'..." disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Dokumentasi -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-camera"></i></span>
                        <div><h3>Dokumentasi Akhir</h3><p>Kronologi dan lampiran foto atau video.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label">Kronologi Terperinci</label>
                                <textarea class="form-control" name="kronologi_lengkap" rows="6" placeholder="Uraian singkat operasi...">{{ $dokumentasi->kronologi_lengkap ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="field-label">Upload Foto Baru (.jpg/.png)</label>
                                    <input class="form-control" type="file" name="foto[]" id="input_foto" multiple accept="image/png, image/jpeg" data-max-mb="10">
                                    <small class="field-hint"><i class="fas fa-info-circle me-1"></i>Format JPG/PNG. Maksimal <strong>10 MB per foto</strong>. Boleh memilih lebih dari satu foto.</small>
                                    <small class="field-hint">Abaikan jika tidak ingin mengubah foto. Jika diisi, foto lama akan diganti.</small>
                                </div>
                                <div>
                                    <label class="field-label">Upload Video Baru (.mp4)</label>
                                    <input class="form-control" type="file" name="video" id="input_video" accept="video/mp4" data-max-mb="10">
                                    <small class="field-hint"><i class="fas fa-info-circle me-1"></i>Format MP4. Maksimal <strong>10 MB</strong>.</small>
                                    <small class="field-hint">Abaikan jika tidak ingin mengubah video.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="tab-nav">
                    <button type="button" class="btn-custom-light" data-go-tab="#teknis-tab"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                    <button type="button" class="btn-custom-primary" data-go-tab="#khusus-tab">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            {{-- ==========================================================
                 TAB 4: KATEGORI KHUSUS
                 ========================================================== --}}
            <div class="tab-pane fade" id="khusus" role="tabpanel">

                <p class="field-hint mb-3" style="font-size:.85rem;">Isi hanya modul yang sesuai dengan kejadian. Modul lain boleh dikosongkan.</p>

                <!-- Animal Rescue -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-paw"></i></span>
                        <div><h3>Animal Rescue</h3><p>Evakuasi hewan liar atau peliharaan.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label">Jenis Hewan</label>
                                <div class="pair">
                                    <select class="form-select" name="jenis_hewan" id="jenis_hewan">
                                        <option value="">-- Pilih --</option>
                                        <option value="ular" {{ $sel($khusus->jenis_hewan ?? '', 'ular') }}>Ular</option>
                                        <option value="tawon" {{ $sel($khusus->jenis_hewan ?? '', 'tawon') }}>Tawon/Vespa</option>
                                        <option value="kera" {{ $sel($khusus->jenis_hewan ?? '', 'kera') }}>Kera</option>
                                        <option value="biawak" {{ $sel($khusus->jenis_hewan ?? '', 'biawak') }}>Biawak</option>
                                        <option value="lainnya" {{ $sel($khusus->jenis_hewan ?? '', 'lainnya') }}>Lainnya</option>
                                    </select>
                                    <input type="text" class="form-control" name="jenis_hewan_lainnya" id="jenis_hewan_lainnya" value="{{ $khusus->jenis_hewan_lainnya ?? '' }}" placeholder="Ketik jika 'Lainnya'..." disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Spesies/Lokal</label>
                                <input type="text" name="spesies_hewan" class="form-control" value="{{ $khusus->spesies_hewan ?? '' }}" placeholder="Cth: King Cobra">
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Dimensi</label>
                                <input type="text" name="dimensi_hewan" class="form-control" value="{{ $khusus->dimensi_hewan ?? '' }}" placeholder="Panjang ±3 meter">
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Berat Hewan</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" min="0" name="berat_hewan" class="form-control" value="{{ $khusus->berat_hewan ?? '' }}" placeholder="Cth: 5">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Status Pasca Evakuasi</label>
                                <select class="form-select" name="status_hewan_pasca">
                                    <option value="">-- Pilih --</option>
                                    <option value="dilepasliarkan" {{ $sel($khusus->status_hewan_pasca ?? '', 'dilepasliarkan') }}>Dilepasliarkan</option>
                                    <option value="diserahkan_bksda" {{ $sel($khusus->status_hewan_pasca ?? '', 'diserahkan_bksda') }}>Diserahkan BKSDA</option>
                                    <option value="mati" {{ $sel($khusus->status_hewan_pasca ?? '', 'mati') }}>Mati</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label">Lokasi Pelepasan</label>
                                <input type="text" name="lokasi_pelepasan" class="form-control" value="{{ $khusus->lokasi_pelepasan ?? '' }}" placeholder="Habitat...">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Pohon Tumbang -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-tree"></i></span>
                        <div><h3>Pohon Tumbang / Bangunan</h3><p>Penanganan objek roboh dan dampaknya.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">Jenis Objek</label>
                                <select class="form-select" name="jenis_objek_tumbang">
                                    <option value="">-- Pilih --</option>
                                    <option value="pohon" {{ $sel($khusus->jenis_objek_tumbang ?? '', 'pohon') }}>Pohon</option>
                                    <option value="baliho" {{ $sel($khusus->jenis_objek_tumbang ?? '', 'baliho') }}>Baliho</option>
                                    <option value="tiang_listrik" {{ $sel($khusus->jenis_objek_tumbang ?? '', 'tiang_listrik') }}>Tiang Listrik</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Dimensi Objek</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="0.1" name="dimensi_objek" class="form-control" value="{{ $khusus->dimensi_objek ?? '' }}" placeholder="0">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Utilitas Terkait</label>
                                <select class="form-select" name="status_utilitas">
                                    <option value="">-- Tidak Ada --</option>
                                    <option value="kabel_pln" {{ $sel($khusus->status_utilitas ?? '', 'kabel_pln') }}>Kabel PLN putus</option>
                                    <option value="pipa_pdam" {{ $sel($khusus->status_utilitas ?? '', 'pipa_pdam') }}>Pipa PDAM bocor</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="field-label">Dampak Properti</label>
                                <textarea class="form-control" name="dampak_properti" rows="2" placeholder="Menutup jalan, menimpa pagar...">{{ $khusus->dampak_properti ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Water Rescue -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-life-ring"></i></span>
                        <div><h3>Water Rescue</h3><p>Pencarian dan penyelamatan di perairan.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">Kondisi Perairan</label>
                                <select class="form-select" name="kondisi_perairan">
                                    <option value="">-- Pilih --</option>
                                    <option value="arus_deras" {{ $sel($khusus->kondisi_perairan ?? '', 'arus_deras') }}>Arus Deras</option>
                                    <option value="arus_tenang" {{ $sel($khusus->kondisi_perairan ?? '', 'arus_tenang') }}>Arus Tenang</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Radius Pencarian</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="radius_pencarian" class="form-control" value="{{ $khusus->radius_pencarian ?? '' }}" placeholder="0">
                                    <span class="input-group-text">m</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Metode Pencarian</label>
                                <select class="form-select" name="metode_pencarian_air">
                                    <option value="">-- Pilih --</option>
                                    <option value="penyelaman" {{ $sel($khusus->metode_pencarian_air ?? '', 'penyelaman') }}>Penyelaman</option>
                                    <option value="penyisiran" {{ $sel($khusus->metode_pencarian_air ?? '', 'penyisiran') }}>Penyisiran Perahu</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="field-label">Daftar Penyelam</label>
                                <input type="text" name="daftar_penyelam" class="form-control" value="{{ $khusus->daftar_penyelam ?? '' }}" placeholder="Nama bersertifikasi...">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Ring/Object Removal & Geografis -->
                <section class="form-section">
                    <header class="form-section__head">
                        <span class="ico"><i class="fas fa-ring"></i></span>
                        <div><h3>Ring/Object Removal & Geografis</h3><p>Pelepasan benda dan kondisi medan operasi.</p></div>
                    </header>
                    <div class="form-section__body">
                        <div class="sub-title">Pelepasan Benda</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">Jenis Benda</label>
                                <input type="text" name="jenis_benda_bahaya" class="form-control" value="{{ $khusus->jenis_benda_bahaya ?? '' }}" placeholder="Cincin, kaleng...">
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Kondisi Anggota Tubuh</label>
                                <select class="form-select" name="kondisi_anggota_tubuh">
                                    <option value="">-- Pilih --</option>
                                    <option value="bengkak" {{ $sel($khusus->kondisi_anggota_tubuh ?? '', 'bengkak') }}>Bengkak</option>
                                    <option value="luka_terbuka" {{ $sel($khusus->kondisi_anggota_tubuh ?? '', 'luka_terbuka') }}>Luka Terbuka</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Alat Potong</label>
                                <select class="form-select" name="alat_potong_cincin">
                                    <option value="">-- Pilih --</option>
                                    <option value="gerinda_mini" {{ $sel($khusus->alat_potong_cincin ?? '', 'gerinda_mini') }}>Gerinda Mini</option>
                                    <option value="tang_baja" {{ $sel($khusus->alat_potong_cincin ?? '', 'tang_baja') }}>Tang Baja</option>
                                </select>
                            </div>
                        </div>

                        <div class="sub-title">Kondisi Geografis</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="field-label">Cuaca Operasi</label>
                                <select class="form-select" name="cuaca_operasi">
                                    <option value="">-- Pilih --</option>
                                    <option value="cerah" {{ $sel($khusus->cuaca_operasi ?? '', 'cerah') }}>Cerah</option>
                                    <option value="hujan_lebat" {{ $sel($khusus->cuaca_operasi ?? '', 'hujan_lebat') }}>Hujan Lebat</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Jenis Medan</label>
                                <select class="form-select" name="jenis_medan">
                                    <option value="">-- Pilih --</option>
                                    <option value="pemukiman_padat" {{ $sel($khusus->jenis_medan ?? '', 'pemukiman_padat') }}>Pemukiman Padat</option>
                                    <option value="perkebunan" {{ $sel($khusus->jenis_medan ?? '', 'perkebunan') }}>Perkebunan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label">Akses Lokasi</label>
                                <select class="form-select" name="akses_lokasi">
                                    <option value="">-- Pilih --</option>
                                    <option value="kendaraan_berat" {{ $sel($khusus->akses_lokasi ?? '', 'kendaraan_berat') }}>Bisa dilalui Roda 4+</option>
                                    <option value="roda_dua" {{ $sel($khusus->akses_lokasi ?? '', 'roda_dua') }}>Hanya Roda 2</option>
                                    <option value="jalan_kaki" {{ $sel($khusus->akses_lokasi ?? '', 'jalan_kaki') }}>Hanya Jalan Kaki</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="tab-nav">
                    <button type="button" class="btn-custom-light" data-go-tab="#dokumentasi-tab"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                    <span class="spacer"></span>
                </div>
            </div>

        </div>
    </div>

    <!-- SUBMIT BUTTON -->
    <div class="action-bar">
        <small><span class="req">*</span> Kolom bertanda bintang wajib diisi.</small>
        <div class="d-flex gap-2">
            <a href="/internal/damtan/data-laporan" class="btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom-primary shadow-sm">
                <i class="fas fa-save"></i> Perbarui Data Penyelamatan
            </button>
        </div>
    </div>
</form>

@endsection

{{-- ==================== JAVASCRIPT KHUSUS HALAMAN INI ==================== --}}
@push('scripts')
<script>
(function () {
    'use strict';

    /* ==========================================================
       TANGGAL -> HARI, BULAN, TAHUN OTOMATIS
       ========================================================== */
    var HARI = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var BULAN = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var tgl = document.getElementById('tanggal_kejadian');

    function isiTanggal() {
        var hari = document.getElementById('hari_kejadian');
        var bulan = document.getElementById('bulan_kejadian');
        var tahun = document.getElementById('tahun_kejadian');
        var p = tgl.value.split('-');
        if (p.length !== 3) { hari.value = bulan.value = tahun.value = ''; return; }
        var d = new Date(+p[0], +p[1] - 1, +p[2]);
        hari.value = HARI[d.getDay()];
        bulan.value = BULAN[d.getMonth()];
        tahun.value = d.getFullYear();
    }
    if (tgl) {
        tgl.addEventListener('change', isiTanggal);
        isiTanggal();   // isi langsung saat halaman edit dibuka
    }

    /* ==========================================================
       KATEGORI KEJADIAN -> OBJEK KEBAKARAN / NON-KEBAKARAN
       ========================================================== */
    var kategori = document.getElementById('kategori_kejadian');
    var objek = document.getElementById('objek_kebakaran');
    var ketObjek = document.getElementById('keterangan_objek_kebakaran');
    var blokKebakaran = document.getElementById('blokKebakaran');
    var blokNon = document.getElementById('blokNonKebakaran');
    var nonSelect = document.getElementById('kategori_non_kebakaran');

    function tampilkanSubObjek() {
        var isFire = kategori.value === 'kebakaran';
        document.querySelectorAll('.sub-objek').forEach(function (box) {
            var aktif = isFire && box.getAttribute('data-objek') === objek.value;
            box.classList.toggle('is-active', aktif);
            // Field yang disembunyikan di-disable supaya tidak ikut terkirim
            box.querySelectorAll('input, select').forEach(function (el) {
                el.disabled = !aktif;
                if (!aktif) el.value = '';
            });
        });
    }

    function sinkronKategori() {
        var isFire = kategori.value === 'kebakaran';

        blokKebakaran.style.display = isFire ? '' : 'none';
        objek.disabled = !isFire;
        objek.required = isFire;
        if (!isFire) objek.value = '';

        if (ketObjek) {
            ketObjek.disabled = !isFire;
            if (!isFire) ketObjek.value = '';
        }

        blokNon.style.display = isFire ? 'none' : '';
        nonSelect.disabled = isFire;
        if (isFire) {
            nonSelect.value = '';
            nonSelect.dispatchEvent(new Event('change')); // reset kolom "Lainnya"
        }
        tampilkanSubObjek();
    }

    if (kategori && objek) {
        kategori.addEventListener('change', sinkronKategori);
        objek.addEventListener('change', tampilkanSubObjek);
        sinkronKategori();   // sesuaikan tampilan dengan data yang tersimpan
    }

    /* ==========================================================
       RESPON TIME & LAMA OPERASI OTOMATIS (menit)
       ========================================================== */
    var wTerima = document.getElementById('waktu_terima');
    var wTiba = document.getElementById('waktu_tiba');
    var wSelesai = document.getElementById('waktu_selesai');
    var respon = document.getElementById('respon_time');
    var lama = document.getElementById('lama_operasi');

    function selisihMenit(awal, akhir) {
        if (!awal.value || !akhir.value) return null;
        return Math.round((new Date(akhir.value) - new Date(awal.value)) / 60000);
    }

    // awal = true saat halaman baru dibuka: nilai Lama Operasi yang tersimpan tidak ditimpa
    function hitungWaktu(awal) {
        var r = selisihMenit(wTerima, wTiba);
        if (r === null) {
            respon.value = '';
            wTiba.setCustomValidity('');
        } else if (r < 0) {
            respon.value = '';
            wTiba.setCustomValidity('Waktu tiba tidak boleh lebih awal dari waktu terima laporan.');
        } else {
            respon.value = r;
            wTiba.setCustomValidity('');
        }

        var l = selisihMenit(wTiba, wSelesai);
        if (l === null) {
            wSelesai.setCustomValidity('');
        } else if (l < 0) {
            wSelesai.setCustomValidity('Waktu selesai tidak boleh lebih awal dari waktu tiba.');
        } else {
            if (!(awal === true && lama.value !== '')) lama.value = l;
            wSelesai.setCustomValidity('');
        }
    }
    [wTerima, wTiba, wSelesai].forEach(function (el) {
        if (el) el.addEventListener('change', function () { hitungWaktu(false); });
    });
    hitungWaktu(true);

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

    /* ---------- LOGIKA INPUT "LAINNYA" ---------- */
    function setupLainnyaLogic(selectId, inputId) {
        var selectEl = document.getElementById(selectId);
        var inputEl = document.getElementById(inputId);

        if (selectEl && inputEl) {
            // Status awal sesuai data yang tersimpan
            inputEl.disabled = selectEl.disabled || selectEl.value !== 'lainnya';
            inputEl.required = !inputEl.disabled;

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

    /* ---------- Nomor telepon: hanya angka ---------- */
    ['telepon_pelapor', 'kontak_saksi'].forEach(function (id) {
        var el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });
        }
    });

    /* ---------- Batas ukuran file upload (10 MB) ---------- */
    document.querySelectorAll('input[type="file"][data-max-mb]').forEach(function (input) {
        input.addEventListener('change', function () {
            var maxMb = parseFloat(input.getAttribute('data-max-mb'));
            var maxBytes = maxMb * 1024 * 1024;
            var terlaluBesar = Array.prototype.filter.call(input.files, function (f) {
                return f.size > maxBytes;
            });

            if (terlaluBesar.length) {
                var daftar = terlaluBesar.map(function (f) {
                    return '- ' + f.name + ' (' + (f.size / 1048576).toFixed(1) + ' MB)';
                }).join('\n');
                alert('Ukuran file maksimal ' + maxMb + ' MB.\nFile berikut terlalu besar:\n' + daftar);
                input.value = '';   // kosongkan pilihan agar tidak ikut terkirim
            }
        });
    });

    /* ---------- TOMBOL SEBELUMNYA / SELANJUTNYA ANTAR TAB ---------- */
    document.querySelectorAll('[data-go-tab]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var tabButton = document.querySelector(btn.getAttribute('data-go-tab'));
            if (tabButton && window.bootstrap) {
                bootstrap.Tab.getOrCreateInstance(tabButton).show();
                var card = document.querySelector('.tabs-card');
                if (card) card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* ---------- ARAHKAN KE TAB & KOLOM YANG KOSONG SAAT ERROR ---------- */
    var melapor = false;          // true saat kita sendiri memanggil reportValidity()
    var sedangDitangani = false;  // hanya tangani isian tidak valid yang pertama
    var namaPelapor = document.getElementById('nama_pelapor');

    function tampilkanTab(selector) {
        var btn = document.querySelector(selector);
        if (btn && window.bootstrap) bootstrap.Tab.getOrCreateInstance(btn).show();
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
    if (namaPelapor) {
        namaPelapor.addEventListener('input', function () {
            this.classList.remove('is-invalid');
            this.setCustomValidity('');
        });
    }

})();
</script>
@endpush