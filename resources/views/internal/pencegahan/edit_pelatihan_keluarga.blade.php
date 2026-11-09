@extends('layouts.dashboard')

@section('title', 'Edit Pelatihan Keluarga Tanggap Kebakaran')

@push('styles')
<style>
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .back-link {
        display: inline-flex; align-items: center; gap: 8px;
        color: var(--steel); font-size: .85rem; font-weight: 600;
        margin-bottom: 14px; transition: color .2s, transform .2s; text-decoration: none;
    }
    .back-link:hover { color: var(--navy); transform: translateX(-2px); }
    .form-wrapper {
        background: #fff; border: 1px solid var(--line);
        border-radius: var(--r-md); box-shadow: var(--shadow-xs);
        padding: clamp(20px, 3vw, 32px);
    }
    .form-alert {
        display: flex; gap: 12px; align-items: flex-start;
        background: var(--signal-soft); border: 1px solid rgba(220,53,69,.25);
        color: var(--signal-dark); border-radius: var(--r-sm);
        padding: 14px 16px; margin-bottom: 20px; font-size: .88rem;
    }
    .form-alert i { margin-top: 3px; }
    .form-alert ul { list-style: disc; padding-left: 18px; margin-top: 4px; }
    .section-title {
        display: flex; align-items: center; gap: 12px;
        font-family: var(--font-display); font-weight: 700; font-size: 1rem;
        color: var(--ink); letter-spacing: -.01em; margin: 30px 0 16px;
    }
    .section-title.first { margin-top: 0; }
    .section-title .ico {
        flex: none; width: 32px; height: 32px; border-radius: 9px;
        display: grid; place-items: center; font-size: .78rem; color: #fff;
        background: var(--navy); box-shadow: 0 4px 8px rgba(22,58,99,.12);
    }
    .section-title .line { flex: 1 1 auto; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .form-label { font-weight: 600; font-size: .8rem; color: var(--steel); margin-bottom: 6px; letter-spacing: .01em; }
    .form-label .req { color: var(--signal); margin-left: 2px; }
    .form-control, .form-select {
        height: 44px; border: 1px solid var(--line-dark); border-radius: var(--r-sm);
        padding: 0 14px; font-size: .9rem; color: var(--ink); background-color: #fff;
        transition: border-color .2s, box-shadow .2s;
    }
    .form-select { padding-right: 38px; }
    .form-select:disabled { background-color: var(--paper); color: var(--steel-soft); cursor: not-allowed; }
    textarea.form-control { height: auto; padding: 10px 14px; line-height: 1.5; resize: vertical; }
    .form-control::placeholder { color: var(--steel-soft); }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control.is-invalid, .form-select.is-invalid { border-color: var(--signal); }
    .form-actions {
        display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px;
        margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line);
    }
    .btn-save, .btn-cancel {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 44px; padding: 0 22px; border-radius: var(--r-sm);
        font-weight: 700; font-size: .87rem; text-decoration: none;
        transition: filter .2s, background .2s, transform .1s, box-shadow .2s;
    }
    .btn-save { background: var(--amber); color: #000; border: none; cursor: pointer; }
    .btn-save:hover { filter: brightness(1.05); box-shadow: var(--shadow-sm); color: #000; }
    .btn-save:disabled { opacity: .7; cursor: wait; }
    .btn-cancel { background: #fff; color: var(--steel); border: 1px solid var(--line-dark); }
    .btn-cancel:hover { background: var(--paper); color: var(--ink); }
    .btn-save:active, .btn-cancel:active { transform: scale(.97); }
</style>
@endpush

@section('content')
    @php
        $jkExisting = mb_strtolower(trim((string) old('jenis_kelamin', $item->jenis_kelamin ?? '')));
    @endphp

    <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Pelatihan Keluarga
    </a>

    <div class="page-head">
        <h1>Edit Pelatihan Keluarga Tanggap Kebakaran</h1>
        <p>Ubah data peserta dan informasi pelaksanaan pelatihan keluarga tanggap kebakaran.</p>
    </div>

    @if($errors->any())
        <div class="form-alert" role="alert">
            <i class="fas fa-triangle-exclamation"></i>
            <div>
                <strong>Data belum bisa diperbarui. Periksa kembali:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="form-wrapper">
        <form action="{{ route('pelatihan_keluarga.update', $item->id) }}" method="POST" id="formPelatihan">
            @csrf
            @method('PUT')

            <!-- DATA PESERTA -->
            <div class="section-title first">
                <span class="ico"><i class="fas fa-user"></i></span>
                <span>Identitas Peserta</span>
                <span class="line"></span>
            </div>

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label" for="nama_peserta">Nama Peserta <span class="req">*</span></label>
                    <input type="text" id="nama_peserta" name="nama_peserta"
                           value="{{ old('nama_peserta', $item->nama_peserta) }}"
                           class="form-control @error('nama_peserta') is-invalid @enderror"
                           placeholder="Masukkan nama lengkap peserta" required>
                    @error('nama_peserta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin <span class="req">*</span></label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="" disabled {{ $jkExisting === '' ? 'selected' : '' }}>Pilih jenis kelamin</option>
                        <option value="Laki-Laki" {{ $jkExisting === 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ $jkExisting === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- INFORMASI PELAKSANAAN -->
            <div class="section-title">
                <span class="ico"><i class="fas fa-house-chimney"></i></span>
                <span>Informasi Pelaksanaan Pelatihan</span>
                <span class="line"></span>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="kecamatan">Kecamatan <span class="req">*</span></label>
                    <select id="kecamatan" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror"
                            data-old="{{ old('kecamatan', $item->kecamatan) }}" required>
                        <option value="" selected disabled>Pilih kecamatan</option>
                    </select>
                    @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="kelurahan">Kelurahan <span class="req">*</span></label>
                    <select id="kelurahan" name="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror"
                            data-old="{{ old('kelurahan', $item->kelurahan) }}" required disabled>
                        <option value="" selected disabled>Pilih kecamatan dulu</option>
                    </select>
                    @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="tanggal_pelaksanaan">Hari/Tanggal Pelaksanaan <span class="req">*</span></label>
                    <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan"
                           value="{{ old('tanggal_pelaksanaan', $item->tanggal_pelaksanaan ? \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('Y-m-d') : '') }}"
                           class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" required>
                    @error('tanggal_pelaksanaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-5">
                    <label class="form-label" for="tempat_pelaksanaan">Tempat Pelaksanaan <span class="req">*</span></label>
                    <input type="text" id="tempat_pelaksanaan" name="tempat_pelaksanaan"
                           value="{{ old('tempat_pelaksanaan', $item->tempat_pelaksanaan) }}"
                           class="form-control @error('tempat_pelaksanaan') is-invalid @enderror"
                           placeholder="Contoh: RT 05" required>
                    @error('tempat_pelaksanaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-7">
                    <label class="form-label" for="alamat_pelaksanaan">Alamat Pelaksanaan <span class="req">*</span></label>
                    <input type="text" id="alamat_pelaksanaan" name="alamat_pelaksanaan"
                           value="{{ old('alamat_pelaksanaan', $item->alamat_pelaksanaan) }}"
                           class="form-control @error('alamat_pelaksanaan') is-invalid @enderror"
                           placeholder="Contoh: RAWASARI ALAM BARAJO" required>
                    @error('alamat_pelaksanaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save" id="btnSave"><i class="fas fa-save"></i> Update Perubahan</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var WILAYAH = {
        'Alam Barajo': ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawasari', 'Simpang Rimbo'],
        'Danau Sipin': ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk': ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan': ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur': ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sijenjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung': ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru': ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang III Sipin', 'Suka Karya', 'Talang Gulo'],
        'Paal Merah': ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi': ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan': ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura': ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang IV Sipin', 'Telanaipura', 'Teluk Kenali']
    };

    var selKec = document.getElementById('kecamatan');
    var selKel = document.getElementById('kelurahan');

    function addOption(select, value, text, selected) {
        var o = document.createElement('option');
        o.value = value;
        o.textContent = text;
        if (selected) {
            o.selected = true;
        }
        select.appendChild(o);
    }

    function fillKelurahan(kec, oldKel) {
        selKel.innerHTML = '';
        if (!kec) {
            addOption(selKel, '', 'Pilih kecamatan dulu', true);
            selKel.options[0].disabled = true;
            selKel.disabled = true;
            return;
        }
        var list = (WILAYAH[kec] || []).slice();
        if (oldKel && list.indexOf(oldKel) === -1) {
            list.push(oldKel);
        }

        addOption(selKel, '', 'Pilih kelurahan', !oldKel);
        selKel.options[0].disabled = true;
        list.forEach(function (k) {
            addOption(selKel, k, k, k === oldKel);
        });
        selKel.disabled = false;
    }

    if (selKec && selKel) {
        var oldKec = selKec.getAttribute('data-old') || '';
        var oldKel = selKel.getAttribute('data-old') || '';

        var kecList = Object.keys(WILAYAH);
        if (oldKec && kecList.indexOf(oldKec) === -1) {
            kecList.push(oldKec);
        }

        kecList.forEach(function (k) {
            addOption(selKec, k, k, k === oldKec);
        });
        selKec.options[0].selected = !oldKec;

        fillKelurahan(oldKec, oldKel);
        selKec.addEventListener('change', function () {
            fillKelurahan(selKec.value, '');
        });
    }

    var form = document.getElementById('formPelatihan');
    var btnSave = document.getElementById('btnSave');
    if (form && btnSave) {
        form.addEventListener('submit', function () {
            btnSave.disabled = true;
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui...';
        });
    }
})();
</script>
@endpush
