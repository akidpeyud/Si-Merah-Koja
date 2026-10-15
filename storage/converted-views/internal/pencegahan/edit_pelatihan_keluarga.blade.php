@extends('layouts.dashboard')

@section('title', 'Edit Pelatihan Keluarga Tanggap Kebakaran')

@push('styles')
<style>
    .toast-wrap {
        position: fixed; z-index: 1100; top: 18px; left: 50%;
        transform: translateX(-50%);
        display: grid; gap: 10px;
        width: max-content; max-width: calc(100vw - 24px);
    }
    .topbar {
        position: sticky; top: 0; z-index: 1020;
        height: var(--topbar-h);
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 0 28px;
        background: var(--ink);
        border-bottom: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
    }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-head { margin-bottom: 26px; }
    .page-head p { color: var(--steel); font-size: .95rem; }
    .back-link {
        display: inline-flex; align-items: center; gap: 8px;
        color: var(--steel); font-size: .85rem; font-weight: 600;
        margin-bottom: 14px; transition: color .2s, transform .2s;
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
    .form-hint { display: block; margin-top: 6px; font-size: .75rem; color: var(--steel); }
    .gender-label { display: flex; align-items: center; gap: 8px; }
    .gender-label i { font-size: .85rem; }
    .gender-label .fa-venus { color: #db2777; }
    .gender-label .fa-mars { color: var(--info); }
    .total-box {
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
        margin-top: 16px; padding: 12px 16px; border-radius: var(--r-sm);
        background: var(--navy-light); color: var(--navy); font-size: .88rem; font-weight: 600;
    }
    .total-box strong { font-family: var(--font-display); font-size: 1.3rem; }
    .form-actions {
        display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px;
        margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line);
    }
    .btn-save, .btn-cancel {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 44px; padding: 0 22px; border-radius: var(--r-sm);
        font-weight: 700; font-size: .87rem; transition: filter .2s, background .2s, transform .1s, box-shadow .2s;
    }
    .btn-save { background: var(--amber); color: #000; border: none; }
    .btn-save:hover { filter: brightness(1.05); box-shadow: var(--shadow-sm); color: #000; }
    .btn-save:disabled { opacity: .7; cursor: wait; }
    .btn-cancel { background: #fff; color: var(--steel); border: 1px solid var(--line-dark); }
    .btn-cancel:hover { background: var(--paper); color: var(--ink); }
    .btn-save:active, .btn-cancel:active { transform: scale(.97); }
    @media (max-width: 1100px) {
        .topbar { padding: 0 20px; }
        .content { padding: 32px 26px 60px; }
    }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .brand { gap: 9px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .topbar-right { gap: 7px; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .user-avatar { width: 34px; height: 34px; }
        .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 16px 50px; }
        .page-head { margin-bottom: 22px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
@section('content')

        <a href="/internal/pencegahan/pemberdayaan-masyarakat/pelatihan-keluarga" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Pelatihan Keluarga
        </a>

        <div class="page-head">
            <h1>Edit Pelatihan Keluarga Tanggap Kebakaran</h1>
            <p>Ubah informasi pelaksanaan, jumlah peserta, dan link dokumentasi kegiatan.</p>
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
            {{-- Tanpa enctype: tidak ada upload file, hanya kirim teks (link) --}}
            <form action="{{ route('pelatihan_keluarga.update', $item->id) }}" method="POST" id="formPelatihan">
                @csrf
                @method('PUT')

                <!-- INFORMASI PELAKSANAAN -->
                <div class="section-title first">
                    <span class="ico"><i class="fas fa-house-chimney"></i></span>
                    <span>Informasi Pelaksanaan Pelatihan</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="tanggal_pelaksanaan">Tanggal Pelaksanaan <span class="req">*</span></label>
                        <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan"
                               value="{{ old('tanggal_pelaksanaan', \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('Y-m-d')) }}"
                               class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" required>
                        @error('tanggal_pelaksanaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="kecamatan">Kecamatan <span class="req">*</span></label>
                        <select id="kecamatan" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" data-old="{{ old('kecamatan', $item->kecamatan) }}" required>
                            <option value="" selected disabled>Pilih kecamatan</option>
                        </select>
                        @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="kelurahan">Kelurahan <span class="req">*</span></label>
                        <select id="kelurahan" name="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" data-old="{{ old('kelurahan', $item->kelurahan) }}" required disabled>
                            <option value="" selected disabled>Pilih kecamatan dulu</option>
                        </select>
                        @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="rt">RT <span class="req">*</span></label>
                        <input type="text" id="rt" name="rt" value="{{ old('rt', $item->rt) }}" class="form-control @error('rt') is-invalid @enderror" placeholder="Contoh: 03, 12, 14 dan 19" required>
                        @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- JUMLAH PESERTA -->
                <div class="section-title">
                    <span class="ico"><i class="fas fa-users"></i></span>
                    <span>Jumlah Peserta</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label gender-label" for="peserta_perempuan"><i class="fas fa-venus"></i> Peserta Perempuan <span class="req">*</span></label>
                        <input type="number" id="peserta_perempuan" name="peserta_perempuan" value="{{ old('peserta_perempuan', $item->peserta_perempuan ?? 0) }}" class="form-control js-peserta @error('peserta_perempuan') is-invalid @enderror" min="0" inputmode="numeric" required>
                        @error('peserta_perempuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label gender-label" for="peserta_laki_laki"><i class="fas fa-mars"></i> Peserta Laki-laki <span class="req">*</span></label>
                        <input type="number" id="peserta_laki_laki" name="peserta_laki_laki" value="{{ old('peserta_laki_laki', $item->peserta_laki_laki ?? 0) }}" class="form-control js-peserta @error('peserta_laki_laki') is-invalid @enderror" min="0" inputmode="numeric" required>
                        @error('peserta_laki_laki')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="total-box">
                    <span>Total peserta</span>
                    <strong id="totalPeserta">0</strong>
                </div>

                <!-- DOKUMENTASI (LINK) -->
                <div class="section-title">
                    <span class="ico"><i class="fas fa-link"></i></span>
                    <span>Dokumentasi</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="link_dokumentasi">Link Dokumentasi Foto / Video (Opsional)</label>
                        <textarea id="link_dokumentasi" name="link_dokumentasi" rows="3"
                                  class="form-control @error('link_dokumentasi') is-invalid @enderror"
                                  placeholder="https://drive.google.com/drive/folders/...">{{ old('link_dokumentasi', $item->link_dokumentasi) }}</textarea>
                        @error('link_dokumentasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <span class="form-hint">Tempel link Google Drive. Kalau lebih dari satu, tulis <strong>satu link per baris</strong>. Kosongkan untuk menghapus link. Pastikan akses link diatur "Siapa saja yang memiliki link".</span>
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

    /* ---------- Data Kecamatan -> Kelurahan (Kota Jambi) ---------- */
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
        if (!kec || !WILAYAH[kec]) {
            addOption(selKel, '', 'Pilih kecamatan dulu', true);
            selKel.options[0].disabled = true;
            selKel.disabled = true;
            return;
        }
        addOption(selKel, '', 'Pilih kelurahan', !oldKel);
        selKel.options[0].disabled = true;
        WILAYAH[kec].forEach(function (k) { addOption(selKel, k, k, k === oldKel); });
        selKel.disabled = false;
    }
    if (selKec && selKel) {
        var oldKec = selKec.getAttribute('data-old') || '';
        var oldKel = selKel.getAttribute('data-old') || '';
        Object.keys(WILAYAH).forEach(function (k) { addOption(selKec, k, k, k === oldKec); });
        selKec.options[0].selected = !oldKec;
        fillKelurahan(oldKec, oldKel);
        selKec.addEventListener('change', function () { fillKelurahan(selKec.value, ''); });
    }

    /* ---------- Total peserta otomatis ---------- */
    var pesertaInputs = document.querySelectorAll('.js-peserta');
    var totalEl = document.getElementById('totalPeserta');
    function hitungTotal() {
        var t = 0;
        pesertaInputs.forEach(function (i) { t += Math.max(0, parseInt(i.value, 10) || 0); });
        if (totalEl) totalEl.textContent = t;
    }
    pesertaInputs.forEach(function (i) { i.addEventListener('input', hitungTotal); });
    hitungTotal();

    /* ---------- Cegah submit ganda ---------- */
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
