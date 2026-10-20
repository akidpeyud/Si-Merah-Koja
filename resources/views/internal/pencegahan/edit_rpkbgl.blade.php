@extends('layouts.dashboard')

@section('title', 'Edit Permohonan RPKBGL')

@push('styles')
<style>
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; background: #fff; color: var(--ink); border: 1px solid var(--line); border-radius: 8px; font-size: .9rem; font-weight: 600; text-decoration: none; transition: all .2s; }
    .btn-back:hover { background: var(--paper); border-color: var(--line-dark); color: var(--ink); }
    .btn-save { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 24px; background: var(--navy); color: #fff; border: none; border-radius: 8px; font-size: .9rem; font-weight: 600; cursor: pointer; transition: all .2s; }
    .btn-save:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
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
    .file-current { display: flex; align-items: center; gap: 8px; font-size: .84rem; margin-bottom: 10px; padding: 8px 12px; background: #fff; border: 1px dashed var(--line-dark); border-radius: 8px; word-break: break-all; }
    .file-current a { color: var(--info); font-weight: 600; text-decoration: none; }
    .file-current a:hover { text-decoration: underline; }
    .file-current.is-empty { color: var(--steel-soft); }
    .file-remove { display: flex; align-items: center; gap: 8px; font-size: .8rem; color: var(--signal-dark); font-weight: 600; margin-bottom: 10px; cursor: pointer; }
    .file-remove input { accent-color: var(--signal); }

    .form-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 36px; padding-top: 24px; border-top: 1px solid var(--line); flex-wrap: wrap; }

    @media (max-width: 700px) {
        .content-card { padding: 20px 16px; }
        .form-actions { justify-content: stretch; }
        .form-actions > * { flex: 1; justify-content: center; }
    }
</style>
@endpush

@section('content')
@php
    $offline = 'Tidak dilampirkan (Offline)';
    $toList  = fn($v) => is_array($v) ? array_values(array_filter($v)) : (array) (json_decode($v ?? '[]', true) ?: []);

    $tglPemeriksaan = $permohonan->tgl_pemeriksaan
        ? \Carbon\Carbon::parse($permohonan->tgl_pemeriksaan)->format('Y-m-d')
        : '';

    /* ===== Dropdown wilayah (dari controller: $dataWilayah) ===== */
    $kecNow = old('kecamatan', $permohonan->kecamatan);
    $opsiKecamatan = collect(array_keys($dataWilayah))->mapWithKeys(fn ($k) => [$k => $k])->all();
    $opsiKelurahan = collect($dataWilayah[$kecNow] ?? [])->mapWithKeys(fn ($k) => [$k => $k])->all();

    /* ===== Kolom data (sesuai migration permohonan_rpkbgl) ===== */
    $sections = [
        [
            'title' => 'Informasi Pemohon', 'icon' => 'fa-user-circle text-primary',
            'fields' => [
                ['name' => 'nama_pemohon',  'label' => 'Nama Pemohon',  'col' => 'col-md-12', 'attr' => 'maxlength="150"'],
                ['name' => 'email_pemohon', 'label' => 'Alamat Email',  'col' => 'col-md-6',  'type' => 'email', 'attr' => 'maxlength="100"'],
                ['name' => 'no_whatsapp',   'label' => 'Nomor WhatsApp','col' => 'col-md-6',  'type' => 'tel',   'attr' => 'maxlength="13" inputmode="numeric" pattern="[0-9]+"'],
            ],
        ],
        [
            'title' => 'Informasi Usaha', 'icon' => 'fa-store text-warning',
            'fields' => [
                ['name' => 'nama_usaha',           'label' => 'Nama Usaha / Instansi', 'col' => 'col-md-6', 'attr' => 'maxlength="150"'],
                ['name' => 'nik_pemilik_usaha',    'label' => 'NIK Pemilik Usaha',     'col' => 'col-md-6', 'attr' => 'maxlength="16" minlength="16" inputmode="numeric" pattern="[0-9]{16}"'],
                ['name' => 'alamat_pemilik_usaha', 'label' => 'Alamat Pemilik Usaha',  'col' => 'col-md-12', 'type' => 'textarea'],
            ],
        ],
        [
            'title' => 'Rincian Bangunan', 'icon' => 'fa-building text-success',
            'fields' => [
                ['name' => 'kategori_bangunan', 'label' => 'Kategori Bangunan', 'col' => 'col-md-6', 'attr' => 'maxlength="100"'],
                ['name' => 'tinggi_bangunan',   'label' => 'Tinggi Bangunan (m)', 'col' => 'col-md-6', 'type' => 'number', 'attr' => 'min="0" max="999999.99" step="0.01"'],
                ['name' => 'luas_lahan',        'label' => 'Luas Lahan (m²)',     'col' => 'col-md-6', 'type' => 'number', 'attr' => 'min="0" max="99999999.99" step="0.01"'],
                ['name' => 'luas_bangunan',     'label' => 'Luas Bangunan (m²)',  'col' => 'col-md-6', 'type' => 'number', 'attr' => 'min="0" max="99999999.99" step="0.01"'],
                ['name' => 'alamat_bangunan',   'label' => 'Alamat Lengkap Bangunan', 'col' => 'col-md-12', 'type' => 'textarea'],
                ['name' => 'kecamatan', 'label' => 'Kecamatan', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['' => '— Pilih kecamatan —'] + $opsiKecamatan],
                ['name' => 'kelurahan', 'label' => 'Kelurahan', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['' => '— Pilih kelurahan —'] + $opsiKelurahan],
                ['name' => 'ada_lift', 'label' => 'Ketersediaan Lift', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['' => '— Pilih —', 'ya' => 'Ya, ada lift', 'tidak' => 'Tidak ada lift']],
                ['name' => 'tgl_pemeriksaan', 'label' => 'Tanggal Pemeriksaan', 'col' => 'col-md-6', 'type' => 'date', 'value' => $tglPemeriksaan],
            ],
        ],
        [
            'title' => 'Status Permohonan', 'icon' => 'fa-info-circle text-danger',
            'fields' => [
                ['name' => 'status_permohonan', 'label' => 'Status', 'col' => 'col-md-6', 'type' => 'select',
                    'options' => ['Pending' => 'Pending', 'Diproses' => 'Diproses Tim', 'Memenuhi Syarat' => 'Memenuhi Syarat', 'Tidak Memenuhi Syarat' => 'Tidak Memenuhi Syarat'],
                    'value' => $permohonan->status_permohonan ?: 'Pending'],
            ],
        ],
    ];

    /* ===== Berkas tunggal ===== */
    $berkasTunggal = [
        'file_surat_permohonan' => ['label' => 'Surat Permohonan', 'dir' => 'surat',  'wajib' => true],
        'file_fotokopi_ktp'     => ['label' => 'Fotokopi KTP',     'dir' => 'berkas', 'wajib' => true],
        'file_nib'              => ['label' => 'NIB',              'dir' => 'berkas', 'wajib' => true],
        'file_pbg_imb'          => ['label' => 'PBG / IMB',        'dir' => 'berkas', 'wajib' => true],
        'file_slo_listrik'      => ['label' => 'SLO Listrik',      'dir' => 'berkas', 'wajib' => true],
        'file_slf_bangunan'     => ['label' => 'SLF Bangunan',     'dir' => 'berkas', 'wajib' => true],
        'file_denah_bangunan'   => ['label' => 'Denah Bangunan',   'dir' => 'berkas', 'wajib' => true],
        'file_pjk3'             => ['label' => 'PJK3 (khusus bangunan berlift)', 'dir' => 'berkas', 'lift' => true],
    ];

    /* ===== Berkas jamak (JSON) ===== */
    $berkasJamak = [
        'file_data_teknis_proteksi' => ['label' => 'Data Teknis Proteksi',        'dir' => 'berkas',    'hapus' => 'hapus_proteksi', 'wajib' => true],
        'file_persyaratan_lainnya'  => ['label' => 'Persyaratan Lainnya (opsional)', 'dir' => 'persyaratan', 'hapus' => 'hapus_lainnya'],
    ];

@endphp

<div class="page-head">
    <div>
        <h1>Edit Permohonan RPKBGL</h1>
        <p>Ubah data permohonan atas nama <strong>{{ $permohonan->nama_pemohon }}</strong></p>
    </div>
    <div class="d-flex gap-2">
        <a href="/internal/pencegahan/kelola-rpkbgl/{{ $permohonan->id }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Detail
        </a>
    </div>
</div>

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

<form id="formEdit" method="POST" action="/internal/pencegahan/kelola-rpkbgl/{{ $permohonan->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="content-card">

        {{-- ================= DATA ================= --}}
        @foreach($sections as $sec)
            <h3 class="form-section-title"><i class="fas {{ $sec['icon'] }}"></i> {{ $sec['title'] }}</h3>
            <div class="row g-3">
                @foreach($sec['fields'] as $f)
                    @php
                        $name     = $f['name'];
                        $type     = $f['type'] ?? 'text';
                        $required = $f['required'] ?? true;
                        $value    = old($name, $f['value'] ?? $permohonan->$name);
                        $cls      = 'form-control' . ($errors->has($name) ? ' is-invalid' : '');
                    @endphp
                    <div class="{{ $f['col'] }}">
                        <label for="{{ $name }}" class="form-label">
                            {{ $f['label'] }} @if($required)<span class="req">*</span>@endif
                        </label>

                        @if($type === 'textarea')
                            <textarea id="{{ $name }}" name="{{ $name }}" rows="3" class="{{ $cls }}" @if($required) required @endif>{{ $value }}</textarea>
                        @elseif($type === 'select')
                            <select id="{{ $name }}" name="{{ $name }}" class="form-select {{ $errors->has($name) ? 'is-invalid' : '' }}" @if($required) required @endif>
                                @foreach($f['options'] as $optVal => $optLabel)
                                    <option value="{{ $optVal }}" @selected((string) $value === (string) $optVal)>{{ $optLabel }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" class="{{ $cls }}" {!! $f['attr'] ?? '' !!} @if($required) required @endif>
                        @endif

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
            Biarkan kolom upload kosong jika berkas tidak diganti. Berkas persyaratan: PDF/JPG/PNG maks. 5 MB. Data teknis proteksi &amp; dokumen pendukung: PDF/JPG/PNG/ZIP/RAR maks. 10 MB per berkas.
        </p>

        <div class="row g-3">
            {{-- Berkas tunggal --}}
            @foreach($berkasTunggal as $field => $m)
                @php $cur = $permohonan->$field; @endphp
                <div class="col-md-6" @if(!empty($m['lift'])) id="boxPjk3" @endif>
                    <div class="file-box">
                        <div class="file-box-title">
                            <span>{{ $m['label'] }}</span>
                            @if(!empty($m['wajib'])) <span class="badge-wajib">Wajib</span> @endif
                        </div>

                        @if($cur === $offline)
                            <div class="file-current is-empty"><i class="fas fa-ban"></i> Tidak dilampirkan (data offline)</div>
                        @elseif($cur)
                            <div class="file-current">
                                <i class="fas fa-file-alt text-secondary"></i>
                                <a href="{{ asset('uploads/rpkbgl/' . $m['dir'] . '/' . $cur) }}" target="_blank">{{ $cur }}</a>
                            </div>
                        @else
                            <div class="file-current is-empty"><i class="fas fa-minus-circle"></i> Belum ada berkas</div>
                        @endif

                        @if($cur && empty($m['wajib']))
                            <label class="file-remove">
                                <input type="checkbox" name="hapus_berkas[]" value="{{ $field }}"> Hapus berkas ini
                            </label>
                        @endif

                        <input type="file" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                        @error($field)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach

            {{-- Berkas jamak --}}
            @foreach($berkasJamak as $field => $m)
                @php $list = $toList($permohonan->$field); @endphp
                <div class="col-md-6">
                    <div class="file-box">
                        <div class="file-box-title">
                            <span>{{ $m['label'] }}</span>
                            @if(!empty($m['wajib'])) <span class="badge-wajib">Wajib (min. 1)</span> @endif
                        </div>

                        @forelse($list as $i => $namaFile)
                            <div class="file-current">
                                @if($namaFile === $offline)
                                    <i class="fas fa-ban"></i> <span class="text-muted">Tidak dilampirkan (data offline)</span>
                                @else
                                    <i class="fas fa-paperclip text-secondary"></i>
                                    <a href="{{ asset('uploads/rpkbgl/' . $m['dir'] . '/' . $namaFile) }}" target="_blank">{{ $namaFile }}</a>
                                @endif
                            </div>
                            <label class="file-remove" style="margin-top: -4px;">
                                <input type="checkbox" name="{{ $m['hapus'] }}[]" value="{{ $namaFile }}"> Hapus berkas ini
                            </label>
                        @empty
                            <div class="file-current is-empty"><i class="fas fa-minus-circle"></i> Belum ada berkas</div>
                        @endforelse

                        <label class="form-hint d-block mb-1">Tambah berkas baru (boleh lebih dari satu)</label>
                        <input type="file" name="{{ $field }}[]" multiple class="form-control @error($field . '.*') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                        @error($field)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error($field . '.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================= AKSI ================= --}}
        <div class="form-actions">
            <a href="/internal/pencegahan/kelola-rpkbgl" class="btn-back">Batal</a>
            <button type="submit" id="btnSimpan" class="btn-save">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* PJK3 hanya relevan jika bangunan memiliki lift */
    var selectLift = document.getElementById('ada_lift');
    var boxPjk3    = document.getElementById('boxPjk3');
    function togglePjk3() {
        if (!selectLift || !boxPjk3) return;
        boxPjk3.style.display = (selectLift.value === 'ya') ? '' : 'none';
    }
    if (selectLift) selectLift.addEventListener('change', togglePjk3);
    togglePjk3();

    /* Kelurahan mengikuti kecamatan */
    var wilayah = @json($dataWilayah);
    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');
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

    /* Cegah submit ganda */
    var form = document.getElementById('formEdit');
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