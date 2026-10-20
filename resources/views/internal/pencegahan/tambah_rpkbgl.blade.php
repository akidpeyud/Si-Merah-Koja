@extends('layouts.dashboard')

@section('title', 'Tambah Permohonan RPKBGL')

@push('styles')
<style>
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: #fff; color: var(--ink); border: 1px solid var(--line); border-radius: 8px; font-size: .9rem; font-weight: 600; text-decoration: none; transition: all .2s; }
    .btn-back:hover { background: var(--paper); border-color: var(--line-dark); color: var(--ink); }
    .btn-save { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 24px; background: var(--success); color: #fff; border: none; border-radius: 8px; font-size: .9rem; font-weight: 600; cursor: pointer; transition: all .2s; }
    .btn-save:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); }
    .btn-save:disabled { opacity: .7; cursor: not-allowed; transform: none; box-shadow: none; }

    .content-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 32px; box-shadow: var(--shadow-xs); }
    .form-section-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--ink); border-bottom: 2px solid var(--line); padding-bottom: 12px; margin: 36px 0 22px; display: flex; align-items: center; gap: 10px; }
    .form-section-title:first-child { margin-top: 0; }
    .form-label { font-size: .8rem; font-weight: 700; color: var(--steel-soft); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 6px; }
    .form-label .req { color: var(--signal); }
    .form-control, .form-select { border-radius: 8px; border-color: var(--line-dark); font-size: .95rem; padding: 10px 14px; color: var(--ink); }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px rgba(22, 58, 99, .12); }
    .form-hint { font-size: .78rem; color: var(--steel); margin-top: 4px; }

    .file-box { height: 100%; border: 1px solid var(--line); border-radius: 10px; background: var(--paper); padding: 16px; }
    .file-box-title { font-size: .9rem; font-weight: 700; color: var(--ink); margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between; gap: 8px; }
    .file-box-title .badge-wajib { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em; padding: 3px 8px; border-radius: 4px; background: var(--signal-soft); color: var(--signal-dark); }
    .file-box-title .badge-opsional { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em; padding: 3px 8px; border-radius: 4px; background: var(--navy-soft); color: var(--navy); }

    .form-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 36px; padding-top: 24px; border-top: 1px solid var(--line); flex-wrap: wrap; }

    @media (max-width: 700px) {
        .content-card { padding: 20px 16px; }
        .form-actions > * { flex: 1; justify-content: center; }
    }
</style>
@endpush

@section('content')
@php
    /* Nama input di sini HARUS sama dengan yang divalidasi di PermohonanRpkbglController@store */
    $minTanggal    = now()->addDays(14)->toDateString();
    $kecNow        = old('kecamatan');
    $opsiKecamatan = collect(array_keys($dataWilayah))->mapWithKeys(fn ($k) => [$k => $k])->all();
    $opsiKelurahan = collect($dataWilayah[$kecNow] ?? [])->mapWithKeys(fn ($k) => [$k => $k])->all();

    $sections = [
        [
            'title' => 'Informasi Pemohon', 'icon' => 'fa-user-circle text-primary',
            'fields' => [
                ['name' => 'nama_pemohon',  'label' => 'Nama Pemohon',   'col' => 'col-md-12', 'attr' => 'maxlength="150"'],
                ['name' => 'email_pemohon', 'label' => 'Alamat Email',   'col' => 'col-md-6',  'type' => 'email', 'attr' => 'maxlength="100"'],
                ['name' => 'no_wa',         'label' => 'Nomor WhatsApp', 'col' => 'col-md-6',  'type' => 'tel',   'attr' => 'maxlength="13" inputmode="numeric" pattern="[0-9]+" placeholder="08xxxxxxxxxx"', 'hint' => 'Hanya angka, maksimal 13 digit.'],
            ],
        ],
        [
            'title' => 'Informasi Usaha', 'icon' => 'fa-store text-warning',
            'fields' => [
                ['name' => 'nama_usaha',     'label' => 'Nama Usaha / Instansi', 'col' => 'col-md-6',  'attr' => 'maxlength="150"'],
                ['name' => 'nik',            'label' => 'NIK Pemilik Usaha',     'col' => 'col-md-6',  'attr' => 'maxlength="16" minlength="16" inputmode="numeric" pattern="[0-9]{16}"', 'hint' => '16 digit angka.'],
                ['name' => 'alamat_pemilik', 'label' => 'Alamat Pemilik Usaha',  'col' => 'col-md-12', 'type' => 'textarea'],
            ],
        ],
        [
            'title' => 'Rincian Bangunan', 'icon' => 'fa-building text-success',
            'fields' => [
                ['name' => 'kategori',        'label' => 'Kategori Bangunan',   'col' => 'col-md-6', 'attr' => 'maxlength="100"'],
                ['name' => 'tinggi_bangunan', 'label' => 'Tinggi Bangunan (m)', 'col' => 'col-md-6', 'type' => 'number', 'attr' => 'min="0" max="999999.99" step="0.01"'],
                ['name' => 'luas_lahan',      'label' => 'Luas Lahan (m²)',     'col' => 'col-md-6', 'type' => 'number', 'attr' => 'min="0" max="99999999.99" step="0.01"'],
                ['name' => 'luas_bangunan',   'label' => 'Luas Bangunan (m²)',  'col' => 'col-md-6', 'type' => 'number', 'attr' => 'min="0" max="99999999.99" step="0.01"'],
                ['name' => 'alamat_bangunan', 'label' => 'Alamat Lengkap Bangunan', 'col' => 'col-md-12', 'type' => 'textarea'],
                ['name' => 'kecamatan', 'label' => 'Kecamatan', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['' => '— Pilih kecamatan —'] + $opsiKecamatan],
                ['name' => 'kelurahan', 'label' => 'Kelurahan', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['' => '— Pilih kelurahan —'] + $opsiKelurahan],
                ['name' => 'ada_lift', 'label' => 'Ketersediaan Lift', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['' => '— Pilih —', 'ya' => 'Ya, ada lift', 'tidak' => 'Tidak ada lift']],
                ['name' => 'tgl_pemeriksaan', 'label' => 'Tanggal Pemeriksaan', 'col' => 'col-md-6', 'type' => 'date',
                    'attr' => 'min="' . $minTanggal . '"', 'hint' => 'Minimal 14 hari dari hari ini (surat permohonan selambat-lambatnya H-14).'],
            ],
        ],
    ];

    /* Berkas tunggal (maks. 5 MB) */
    $berkasTunggal = [
        'surat_permohonan' => ['label' => 'Surat Permohonan'],
        'fotokopi_ktp'     => ['label' => 'Fotokopi KTP Penanggung Jawab Gedung'],
        'nib'              => ['label' => 'NIB'],
        'pbg_imb'          => ['label' => 'PBG / IMB'],
        'slo_listrik'      => ['label' => 'SLO Listrik'],
        'slf_bangunan'     => ['label' => 'SLF Bangunan'],
        'denah_bangunan'   => ['label' => 'Denah Bangunan'],
        'pjk3_lift'        => ['label' => 'PJK3 (khusus bangunan berlift)', 'lift' => true],
    ];
@endphp

<div class="page-head">
    <div>
        <h1>Tambah Permohonan RPKBGL</h1>
        <p>Input data permohonan Rekomendasi Proteksi Kebakaran Bangunan Gedung &amp; Lingkungan.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="/internal/pencegahan/kelola-rpkbgl" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="border-radius: 10px;">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" style="border-radius: 10px;">
        <strong><i class="fas fa-exclamation-triangle me-1"></i> Data belum bisa disimpan:</strong>
        <ul class="mb-0 mt-2" style="font-size: .9rem;">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="formTambah" method="POST" action="/internal/pencegahan/kelola-rpkbgl" enctype="multipart/form-data">
    @csrf

    <div class="content-card">

        {{-- ================= DATA ================= --}}
        @foreach($sections as $sec)
            <h3 class="form-section-title"><i class="fas {{ $sec['icon'] }}"></i> {{ $sec['title'] }}</h3>
            <div class="row g-3">
                @foreach($sec['fields'] as $f)
                    @php
                        $name  = $f['name'];
                        $type  = $f['type'] ?? 'text';
                        $value = old($name);
                        $cls   = 'form-control' . ($errors->has($name) ? ' is-invalid' : '');
                    @endphp
                    <div class="{{ $f['col'] }}">
                        <label for="{{ $name }}" class="form-label">{{ $f['label'] }} <span class="req">*</span></label>

                        @if($type === 'textarea')
                            <textarea id="{{ $name }}" name="{{ $name }}" rows="3" class="{{ $cls }}" required>{{ $value }}</textarea>
                        @elseif($type === 'select')
                            <select id="{{ $name }}" name="{{ $name }}" class="form-select {{ $errors->has($name) ? 'is-invalid' : '' }}" required>
                                @foreach($f['options'] as $optVal => $optLabel)
                                    <option value="{{ $optVal }}" @selected((string) $value === (string) $optVal)>{{ $optLabel }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" class="{{ $cls }}" {!! $f['attr'] ?? '' !!} required>
                        @endif

                        @if(!empty($f['hint'])) <div class="form-hint">{{ $f['hint'] }}</div> @endif
                        @error($name)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
        @endforeach

        {{-- ================= BERKAS ================= --}}
        <h3 class="form-section-title"><i class="fas fa-folder-open text-info"></i> Berkas Persyaratan</h3>
        <p class="form-hint mb-3" style="font-size: .85rem;">
            Berkas persyaratan: PDF/JPG/PNG maks. 5 MB. Data teknis proteksi &amp; dokumen pendukung: PDF/JPG/PNG/ZIP/RAR maks. 10 MB per berkas (maks. 10 berkas).
        </p>

        <div class="row g-3">
            @foreach($berkasTunggal as $field => $m)
                <div class="col-md-6" @if(!empty($m['lift'])) id="boxPjk3" @endif>
                    <div class="file-box">
                        <div class="file-box-title">
                            <span>{{ $m['label'] }}</span>
                            <span class="badge-wajib">{{ empty($m['lift']) ? 'Wajib' : 'Wajib jika ada lift' }}</span>
                        </div>
                        <input type="file" name="{{ $field }}" id="{{ $field }}"
                               class="form-control @error($field) is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png"
                               @if(empty($m['lift'])) required @endif>
                        @error($field)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach

            <div class="col-md-6">
                <div class="file-box">
                    <div class="file-box-title">
                        <span>Data Teknis Sistem Proteksi Kebakaran</span>
                        <span class="badge-wajib">Wajib (min. 1)</span>
                    </div>
                    <input type="file" name="data_teknis_proteksi[]" multiple required
                           class="form-control @error('data_teknis_proteksi') is-invalid @enderror @error('data_teknis_proteksi.*') is-invalid @enderror"
                           accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                    <div class="form-hint">Sistem proteksi aktif, pasif, sarana penyelamatan, dan utilitas. Boleh pilih lebih dari satu berkas.</div>
                    @error('data_teknis_proteksi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('data_teknis_proteksi.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="file-box">
                    <div class="file-box-title">
                        <span>Dokumen Pendukung Lainnya</span>
                        <span class="badge-opsional">Opsional</span>
                    </div>
                    <input type="file" name="persyaratan_lainnya[]" multiple
                           class="form-control @error('persyaratan_lainnya') is-invalid @enderror @error('persyaratan_lainnya.*') is-invalid @enderror"
                           accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                    <div class="form-hint">Boleh pilih lebih dari satu berkas.</div>
                    @error('persyaratan_lainnya')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('persyaratan_lainnya.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ================= AKSI ================= --}}
        <div class="form-actions">
            <a href="/internal/pencegahan/kelola-rpkbgl" class="btn-back">Batal</a>
            <button type="submit" id="btnSimpan" class="btn-save">
                <i class="fas fa-save"></i> Simpan Permohonan
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var wilayah    = @json($dataWilayah);
    var kec        = document.getElementById('kecamatan');
    var kel        = document.getElementById('kelurahan');
    var selectLift = document.getElementById('ada_lift');
    var boxPjk3    = document.getElementById('boxPjk3');
    var inputPjk3  = document.getElementById('pjk3_lift');

    /* Kelurahan mengikuti kecamatan */
    if (kec && kel) {
        kec.addEventListener('change', function () {
            kel.innerHTML = '<option value="">— Pilih kelurahan —</option>';
            (wilayah[kec.value] || []).forEach(function (nama) {
                var o = document.createElement('option');
                o.value = nama; o.textContent = nama;
                kel.appendChild(o);
            });
        });
    }

    /* PJK3 hanya wajib & tampil jika bangunan memiliki lift */
    function togglePjk3() {
        if (!selectLift || !boxPjk3) return;
        var ya = selectLift.value === 'ya';
        boxPjk3.style.display = ya ? '' : 'none';
        if (inputPjk3) {
            inputPjk3.required = ya;
            if (!ya) inputPjk3.value = '';
        }
    }
    if (selectLift) selectLift.addEventListener('change', togglePjk3);
    togglePjk3();

    /* Cegah submit ganda */
    var form = document.getElementById('formTambah');
    var btn  = document.getElementById('btnSimpan');
    if (form && btn) {
        form.addEventListener('submit', function () {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    }
})();
</script>
@endpush