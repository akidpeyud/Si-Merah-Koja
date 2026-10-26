@extends('layouts.dashboard')

@section('title', 'Edit Data Pemberdayaan')

@push('styles')
<style>
    .toast-wrap { position: fixed; z-index: 1100; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--steel); font-size: .85rem; font-weight: 600; margin-bottom: 14px; transition: color .2s, transform .2s; text-decoration: none; }
    .back-link:hover { color: var(--navy); transform: translateX(-2px); }
    .form-wrapper { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); padding: clamp(20px, 3vw, 32px); }
    .form-alert { display: flex; gap: 12px; align-items: flex-start; background: var(--signal-soft); border: 1px solid rgba(220,53,69,.25); color: var(--signal-dark); border-radius: var(--r-sm); padding: 14px 16px; margin-bottom: 20px; font-size: .88rem; }
    .form-alert ul { list-style: disc; padding-left: 18px; margin-top: 4px; }
    .section-title { display: flex; align-items: center; gap: 12px; font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--ink); letter-spacing: -.01em; margin: 30px 0 16px; }
    .section-title.first { margin-top: 0; }
    .section-title .ico { flex: none; width: 32px; height: 32px; border-radius: 9px; display: grid; place-items: center; font-size: .78rem; color: #fff; background: var(--navy); box-shadow: 0 4px 8px rgba(22,58,99,.12); }
    .section-title .line { flex: 1 1 auto; height: 1px; background: linear-gradient(to right, var(--line), transparent 90%); }
    .form-label { font-weight: 600; font-size: .8rem; color: var(--steel); margin-bottom: 6px; letter-spacing: .01em; }
    .form-label .req { color: var(--signal); margin-left: 2px; }
    .form-control, .form-select { height: 44px; border: 1px solid var(--line-dark); border-radius: var(--r-sm); padding: 0 14px; font-size: .9rem; color: var(--ink); background-color: #fff; transition: border-color .2s, box-shadow .2s; }
    .form-select:disabled { background-color: var(--paper); color: var(--steel-soft); cursor: not-allowed; }
    textarea.form-control { height: auto; padding: 10px 14px; line-height: 1.5; resize: vertical; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); outline: none;}
    .form-hint { display: block; margin-top: 6px; font-size: .75rem; color: var(--steel); }
    .peserta-form-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; height: 100%; }
    .peserta-form-head { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding-bottom: 12px; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; }
    .gender-label { display: inline-flex; align-items: center; gap: 8px; font-weight: 700; font-size: .92rem; color: var(--ink); margin: 0; }
    .peserta-count-badge { background: #e2e8f0; color: var(--ink); font-weight: 700; font-size: .76rem; padding: 4px 10px; border-radius: 6px; }
    .total-box { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-top: 16px; padding: 12px 16px; border-radius: var(--r-sm); background: var(--navy-light); color: var(--navy); font-size: .88rem; font-weight: 600; }
    .total-box strong { font-family: var(--font-display); font-size: 1.25rem; }
    .form-actions { display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px; margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line); }
    .btn-save, .btn-cancel { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 44px; padding: 0 22px; border-radius: var(--r-sm); font-weight: 700; font-size: .87rem; transition: filter .2s, background .2s, transform .1s, box-shadow .2s; text-decoration: none;}
    .btn-save { background: var(--navy); color: #fff; border: none; }
    .btn-cancel { background: #fff; color: var(--steel); border: 1px solid var(--line-dark); }
</style>
@endpush

@section('content')
    @php
        $formatNamaTextarea = function ($raw) {
            if (is_array($raw)) return implode("\n", array_filter(array_map('trim', $raw)));
            if (is_string($raw) && str_starts_with(trim($raw), '[')) {
                $decoded = json_decode($raw, true);
                if (is_array($decoded)) return implode("\n", array_filter(array_map('trim', $decoded)));
            }
            return (string) $raw;
        };
        $existingNamaL = $formatNamaTextarea($data->nama_peserta_laki_laki ?? $data->daftar_peserta_laki_laki ?? $data->peserta_laki_nama ?? $data->nama_laki_laki ?? '');
        $existingNamaP = $formatNamaTextarea($data->nama_peserta_perempuan ?? $data->daftar_peserta_perempuan ?? $data->peserta_perempuan_nama ?? $data->nama_perempuan ?? '');
        
        $isMako = ($data->kecamatan === 'Mako Damkar');
    @endphp

    <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Sosialisasi
    </a>

    <div class="page-head">
        <h1>Edit Sosialisasi & Edukasi</h1>
        <p>Perbarui informasi pelaksanaan, jumlah &amp; daftar nama peserta, serta dokumentasi kegiatan.</p>
    </div>

    @if($errors->any())
        <div class="form-alert" role="alert">
            <i class="fas fa-triangle-exclamation"></i>
            <div>
                <strong>Data belum bisa disimpan. Periksa kembali:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="form-wrapper">
        <form id="formSosialisasi" action="/internal/pencegahan/pemberdayaan-masyarakat/update/{{ $data->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="section-title first">
                <span class="ico"><i class="fas fa-bullhorn"></i></span>
                <span>Informasi Pelaksanaan</span>
                <span class="line"></span>
            </div>

            <!-- JENIS KEGIATAN -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label d-block">Pilih Jenis Kunjungan <span class="req">*</span></label>
                    <div class="d-flex flex-wrap gap-4 p-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <label class="form-check-label d-flex align-items-center gap-2" style="cursor: pointer;">
                            <input type="radio" name="jenis_kegiatan" id="jenisLuar" value="Luar" class="form-check-input" {{ !$isMako ? 'checked' : '' }} style="width:18px;height:18px;cursor:pointer;">
                            <span style="font-size: .95rem;"><strong>Kunjungan ke Luar</strong> (Penyuluhan ke Lokasi)</span>
                        </label>
                        <label class="form-check-label d-flex align-items-center gap-2" style="cursor: pointer;">
                            <input type="radio" name="jenis_kegiatan" id="jenisDalam" value="Dalam" class="form-check-input" {{ $isMako ? 'checked' : '' }} style="width:18px;height:18px;cursor:pointer;">
                            <span style="font-size: .95rem;"><strong>Kunjungan ke Dalam</strong> (Wisata Edukasi ke Mako)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- TANGGAL & INSTANSI (Selalu Tampil) -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label" for="tanggal_pelaksanaan">Tanggal Pelaksanaan <span class="req">*</span></label>
                    <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', $data->tanggal_pelaksanaan ? \Carbon\Carbon::parse($data->tanggal_pelaksanaan)->format('Y-m-d') : '') }}" class="form-control" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label" id="labelInstansi" for="posyandu_sekolah">Posyandu / Nama Sekolah / Lokasi <span class="req">*</span></label>
                    <input type="text" id="posyandu_sekolah" name="posyandu_sekolah" value="{{ old('posyandu_sekolah', $data->posyandu_sekolah) }}" class="form-control" placeholder="Contoh: Posyandu Melati / SDN 12 Kota Jambi" maxlength="150" required>
                </div>
            </div>

            <!-- ALAMAT (Disembunyikan jika ke Mako) -->
            <div class="row g-3" id="lokasiLuarWrap">
                <div class="col-md-4">
                    <label class="form-label" for="kecamatan">Kecamatan <span class="req">*</span></label>
                    <select id="kecamatan" name="kecamatan" class="form-select" data-old="{{ old('kecamatan', $data->kecamatan) }}" required>
                        <option value="" selected disabled>Pilih kecamatan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="kelurahan">Kelurahan <span class="req">*</span></label>
                    <select id="kelurahan" name="kelurahan" class="form-select" data-old="{{ old('kelurahan', $data->kelurahan) }}" required disabled>
                        <option value="" selected disabled>Pilih kecamatan dulu</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="rt">RT <span class="req">*</span></label>
                    <input type="text" id="rt" name="rt" value="{{ old('rt', $data->rt) }}" class="form-control" placeholder="Contoh: 03, 12, 14" required>
                </div>
            </div>

            <div class="section-title">
                <span class="ico"><i class="fas fa-users"></i></span>
                <span>Jumlah &amp; Daftar Peserta</span>
                <span class="line"></span>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="peserta-form-card">
                        <div class="peserta-form-head">
                            <span class="gender-label"><i class="fas fa-mars" style="color:#0284c7"></i> Laki-laki</span>
                            <span class="peserta-count-badge" id="badgeLaki">{{ old('peserta_laki_laki', $data->peserta_laki_laki ?? 0) }} Orang</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="peserta_laki_laki">Jumlah Laki-laki <span class="req">*</span></label>
                            <input type="number" id="peserta_laki_laki" name="peserta_laki_laki" value="{{ old('peserta_laki_laki', $data->peserta_laki_laki ?? 0) }}" class="form-control" min="0" required>
                        </div>
                        <div>
                            <label class="form-label" for="nama_peserta_laki_laki">Daftar Nama Laki-laki</label>
                            <textarea id="nama_peserta_laki_laki" name="nama_peserta_laki_laki" rows="4" class="form-control" placeholder="Ketik satu nama per baris">{{ old('nama_peserta_laki_laki', $existingNamaL) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="peserta-form-card">
                        <div class="peserta-form-head">
                            <span class="gender-label"><i class="fas fa-venus" style="color:#e11d48"></i> Perempuan</span>
                            <span class="peserta-count-badge" id="badgePerempuan">{{ old('peserta_perempuan', $data->peserta_perempuan ?? 0) }} Orang</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="peserta_perempuan">Jumlah Perempuan <span class="req">*</span></label>
                            <input type="number" id="peserta_perempuan" name="peserta_perempuan" value="{{ old('peserta_perempuan', $data->peserta_perempuan ?? 0) }}" class="form-control" min="0" required>
                        </div>
                        <div>
                            <label class="form-label" for="nama_peserta_perempuan">Daftar Nama Perempuan</label>
                            <textarea id="nama_peserta_perempuan" name="nama_peserta_perempuan" rows="4" class="form-control" placeholder="Ketik satu nama per baris">{{ old('nama_peserta_perempuan', $existingNamaP) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <label class="form-label" for="guru">Jumlah Guru Pendamping <span class="req">*</span></label>
                    <input type="number" id="guru" name="guru" value="{{ old('guru', $data->guru ?? 0) }}" class="form-control" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="orang_tua">Jumlah Orang Tua / Wali <span class="req">*</span></label>
                    <input type="number" id="orang_tua" name="orang_tua" value="{{ old('orang_tua', $data->orang_tua ?? 0) }}" class="form-control" min="0" required>
                </div>
            </div>

            <div class="total-box">
                <span>Total Seluruh Peserta</span>
                <strong id="totalPeserta">0 Orang</strong>
            </div>

            <div class="section-title">
                <span class="ico"><i class="fas fa-link"></i></span>
                <span>Dokumentasi</span>
                <span class="line"></span>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="link_dokumentasi">Link Dokumentasi Foto / Video (Opsional)</label>
                    <textarea id="link_dokumentasi" name="link_dokumentasi" rows="3" class="form-control" placeholder="https://drive.google.com/drive/folders/...">{{ old('link_dokumentasi', $data->link_dokumentasi ?? '') }}</textarea>
                    <span class="form-hint">Satu link per baris. Pastikan link diatur "Siapa saja yang memiliki link".</span>
                </div>
            </div>

            <div class="form-actions">
                <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save" id="btnSave"><i class="fas fa-save"></i> Update Data</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    
    // Toggle Luar / Dalam
    var rLuar = document.getElementById('jenisLuar');
    var rDalam = document.getElementById('jenisDalam');
    var lokWrap = document.getElementById('lokasiLuarWrap');
    var labelInstansi = document.getElementById('labelInstansi');
    var inputKec = document.getElementById('kecamatan');
    var inputKel = document.getElementById('kelurahan');
    var inputRT = document.getElementById('rt');
    var inputInstansi = document.getElementById('posyandu_sekolah');

    function toggleJenis() {
        if(rDalam.checked) {
            lokWrap.style.display = 'none';
            inputKec.required = false;
            inputKel.required = false;
            inputRT.required = false;
            labelInstansi.innerHTML = 'Nama Rombongan / Instansi <span class="req">*</span>';
            inputInstansi.placeholder = 'Contoh: TK Pertiwi / Rombongan Warga RT 12';
        } else {
            lokWrap.style.display = 'flex';
            inputKec.required = true;
            inputKel.required = true;
            inputRT.required = true;
            labelInstansi.innerHTML = 'Posyandu / Nama Sekolah / Lokasi <span class="req">*</span>';
            inputInstansi.placeholder = 'Contoh: Posyandu Melati / SDN 12 Kota Jambi';
        }
    }
    rLuar.addEventListener('change', toggleJenis);
    rDalam.addEventListener('change', toggleJenis);
    toggleJenis(); // Inisialisasi

    // Wilayah Jambi
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
        o.value = value; o.textContent = text;
        if (selected) o.selected = true;
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
        if (oldKel && list.indexOf(oldKel) === -1) list.push(oldKel);

        addOption(selKel, '', 'Pilih kelurahan', !oldKel);
        selKel.options[0].disabled = true;
        list.forEach(function (k) { addOption(selKel, k, k, k === oldKel); });
        selKel.disabled = false;
    }
    if (selKec && selKel) {
        var oldKec = selKec.getAttribute('data-old') || '';
        var oldKel = selKel.getAttribute('data-old') || '';
        var kecList = Object.keys(WILAYAH);
        if (oldKec && kecList.indexOf(oldKec) === -1) kecList.push(oldKec);
        kecList.forEach(function (k) { addOption(selKec, k, k, k === oldKec); });
        selKec.options[0].selected = !oldKec;
        fillKelurahan(oldKec, oldKel);
        selKec.addEventListener('change', function () { fillKelurahan(selKec.value, ''); });
    }

    // Hitung Otomatis Peserta
    var inputL = document.getElementById('peserta_laki_laki'), inputP = document.getElementById('peserta_perempuan');
    var inputG = document.getElementById('guru'), inputO = document.getElementById('orang_tua');
    var textareaL = document.getElementById('nama_peserta_laki_laki'), textareaP = document.getElementById('nama_peserta_perempuan');
    var badgeL = document.getElementById('badgeLaki'), badgeP = document.getElementById('badgePerempuan');
    var totalEl = document.getElementById('totalPeserta');

    function hitungBarisNama(teks) {
        if (!teks) return 0;
        return teks.split(/[\r\n,;]+/).map(function (s) { return s.trim(); }).filter(function (s) { return s.length > 0; }).length;
    }

    function hitungTotal() {
        var l = Math.max(0, parseInt(inputL ? inputL.value : 0, 10) || 0);
        var p = Math.max(0, parseInt(inputP ? inputP.value : 0, 10) || 0);
        var g = Math.max(0, parseInt(inputG ? inputG.value : 0, 10) || 0);
        var o = Math.max(0, parseInt(inputO ? inputO.value : 0, 10) || 0);

        if (badgeL) badgeL.textContent = l + ' Orang';
        if (badgeP) badgeP.textContent = p + ' Orang';
        if (totalEl) totalEl.textContent = (l + p + g + o) + ' Orang';
    }

    if (textareaL && inputL) textareaL.addEventListener('input', function () { inputL.value = hitungBarisNama(this.value); hitungTotal(); });
    if (textareaP && inputP) textareaP.addEventListener('input', function () { inputP.value = hitungBarisNama(this.value); hitungTotal(); });
    if (inputL) inputL.addEventListener('input', hitungTotal);
    if (inputP) inputP.addEventListener('input', hitungTotal);
    if (inputG) inputG.addEventListener('input', hitungTotal);
    if (inputO) inputO.addEventListener('input', hitungTotal);
    
    hitungTotal();

    // Loading State Submit
    var form = document.getElementById('formSosialisasi'), btnSave = document.getElementById('btnSave');
    if (form && btnSave) {
        form.addEventListener('submit', function () {
            btnSave.disabled = true;
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    }
})();
</script>
@endpush