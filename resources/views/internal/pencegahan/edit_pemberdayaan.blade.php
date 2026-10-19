@extends('layouts.dashboard')

@section('title', 'Edit Data Pemberdayaan')

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
        color: var(--ink); letter-spacing: -.01em;
        margin: 30px 0 16px;
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

    /* Kartu Input Peserta Laki-laki & Perempuan */
    .peserta-form-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        height: 100%;
    }
    .peserta-form-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 12px;
        margin-bottom: 14px;
        border-bottom: 1px solid #e2e8f0;
    }
    .gender-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: .92rem;
        color: var(--ink);
        margin: 0;
    }
    .gender-label i { font-size: 1rem; }
    .gender-label .fa-mars { color: #0284c7; }
    .gender-label .fa-venus { color: #e11d48; }
    .peserta-count-badge {
        background: #e2e8f0;
        color: var(--ink);
        font-weight: 700;
        font-size: .76rem;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .total-box {
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
        margin-top: 16px; padding: 12px 16px; border-radius: var(--r-sm);
        background: var(--navy-light); color: var(--navy); font-size: .88rem; font-weight: 600;
    }
    .total-box strong { font-family: var(--font-display); font-size: 1.25rem; }
    .form-actions {
        display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px;
        margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line);
    }
    .btn-save, .btn-cancel {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 44px; padding: 0 22px; border-radius: var(--r-sm);
        font-weight: 700; font-size: .87rem; transition: filter .2s, background .2s, transform .1s, box-shadow .2s;
    }
    .btn-save { background: var(--navy); color: #fff; border: none; }
    .btn-save:hover { filter: brightness(1.1); box-shadow: var(--shadow-sm); color: #fff; }
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
    @media print {
        .topbar { position: static; background: #fff !important; color: #000 !important; box-shadow: none; border-bottom: 1px solid #ddd; }
        .brand span { color: #000 !important; }
        .sidebar, .btn-logout, .toast-wrap { display: none !important; }
        .shell { display: block; }
        .content { padding: 20px; }
    }
</style>
@endpush

@section('content')

        @php
            // Format data daftar nama lama agar rapi satu nama per baris di dalam textarea
            $formatNamaTextarea = function ($raw) {
                if (is_array($raw)) {
                    return implode("\n", array_filter(array_map('trim', $raw)));
                }
                if (is_string($raw) && str_starts_with(trim($raw), '[')) {
                    $decoded = json_decode($raw, true);
                    if (is_array($decoded)) {
                        return implode("\n", array_filter(array_map('trim', $decoded)));
                    }
                }
                return (string) $raw;
            };

            $existingNamaL = $formatNamaTextarea(
                $data->nama_peserta_laki_laki
                ?? $data->daftar_peserta_laki_laki
                ?? $data->peserta_laki_nama
                ?? $data->nama_laki_laki
                ?? ''
            );

            $existingNamaP = $formatNamaTextarea(
                $data->nama_peserta_perempuan
                ?? $data->daftar_peserta_perempuan
                ?? $data->peserta_perempuan_nama
                ?? $data->nama_perempuan
                ?? ''
            );
        @endphp

        <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Sosialisasi
        </a>

        <div class="page-head">
            <h1>Edit Sosialisasi</h1>
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
            {{-- Tanpa enctype: tidak ada upload file, hanya kirim teks (link) --}}
            <form id="formSosialisasi" action="/internal/pencegahan/pemberdayaan-masyarakat/update/{{ $data->id }}" method="POST">
                @csrf
                @method('PUT')

                <!-- INFORMASI PELAKSANAAN -->
                <div class="section-title first">
                    <span class="ico"><i class="fas fa-bullhorn"></i></span>
                    <span>Informasi Pelaksanaan Sosialisasi</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="tanggal_pelaksanaan">Tanggal Pelaksanaan <span class="req">*</span></label>
                        <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', $data->tanggal_pelaksanaan ? \Carbon\Carbon::parse($data->tanggal_pelaksanaan)->format('Y-m-d') : '') }}" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" required>
                        @error('tanggal_pelaksanaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="kecamatan">Kecamatan <span class="req">*</span></label>
                        <select id="kecamatan" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" data-old="{{ old('kecamatan', $data->kecamatan) }}" required>
                            <option value="" selected disabled>Pilih kecamatan</option>
                        </select>
                        @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="kelurahan">Kelurahan <span class="req">*</span></label>
                        <select id="kelurahan" name="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" data-old="{{ old('kelurahan', $data->kelurahan) }}" required disabled>
                            <option value="" selected disabled>Pilih kecamatan dulu</option>
                        </select>
                        @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" for="rt">RT <span class="req">*</span></label>
                        <input type="text" id="rt" name="rt" value="{{ old('rt', $data->rt) }}" class="form-control @error('rt') is-invalid @enderror" placeholder="Contoh: 03, 12, 14 dan 19" required>
                        @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-7">
                        <label class="form-label" for="posyandu_sekolah">Posyandu / Nama Sekolah <span class="req">*</span></label>
                        <input type="text" id="posyandu_sekolah" name="posyandu_sekolah" value="{{ old('posyandu_sekolah', $data->posyandu_sekolah) }}" class="form-control @error('posyandu_sekolah') is-invalid @enderror" placeholder="Contoh: Posyandu Melati / SDN 12 Kota Jambi" maxlength="150" required>
                        @error('posyandu_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- JUMLAH & DAFTAR PESERTA -->
                <div class="section-title">
                    <span class="ico"><i class="fas fa-users"></i></span>
                    <span>Jumlah &amp; Daftar Peserta</span>
                    <span class="line"></span>
                </div>

                <div class="row g-3">
                    <!-- PESERTA LAKI-LAKI -->
                    <div class="col-md-6">
                        <div class="peserta-form-card">
                            <div class="peserta-form-head">
                                <span class="gender-label">
                                    <i class="fas fa-mars"></i> Peserta Laki-laki
                                </span>
                                <span class="peserta-count-badge" id="badgeLaki">{{ old('peserta_laki_laki', $data->peserta_laki_laki ?? 0) }} Orang</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="peserta_laki_laki">Jumlah Laki-laki <span class="req">*</span></label>
                                <input type="number" id="peserta_laki_laki" name="peserta_laki_laki" value="{{ old('peserta_laki_laki', $data->peserta_laki_laki ?? 0) }}" class="form-control js-peserta @error('peserta_laki_laki') is-invalid @enderror" min="0" inputmode="numeric" required>
                                @error('peserta_laki_laki')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="form-label" for="nama_peserta_laki_laki">Daftar Nama Peserta Laki-laki</label>
                                <textarea id="nama_peserta_laki_laki" name="nama_peserta_laki_laki" rows="5"
                                          class="form-control @error('nama_peserta_laki_laki') is-invalid @enderror"
                                          placeholder="Ketik satu nama per baris, contoh:&#10;Budi&#10;Andi&#10;Joko">{{ old('nama_peserta_laki_laki', $existingNamaL) }}</textarea>
                                @error('nama_peserta_laki_laki')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="form-hint">Tulis <strong>satu nama per baris</strong> (tekan Enter untuk baris baru). Jumlah peserta akan otomatis menyesuaikan.</span>
                            </div>
                        </div>
                    </div>

                    <!-- PESERTA PEREMPUAN -->
                    <div class="col-md-6">
                        <div class="peserta-form-card">
                            <div class="peserta-form-head">
                                <span class="gender-label">
                                    <i class="fas fa-venus"></i> Peserta Perempuan
                                </span>
                                <span class="peserta-count-badge" id="badgePerempuan">{{ old('peserta_perempuan', $data->peserta_perempuan ?? 0) }} Orang</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="peserta_perempuan">Jumlah Perempuan <span class="req">*</span></label>
                                <input type="number" id="peserta_perempuan" name="peserta_perempuan" value="{{ old('peserta_perempuan', $data->peserta_perempuan ?? 0) }}" class="form-control js-peserta @error('peserta_perempuan') is-invalid @enderror" min="0" inputmode="numeric" required>
                                @error('peserta_perempuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="form-label" for="nama_peserta_perempuan">Daftar Nama Peserta Perempuan</label>
                                <textarea id="nama_peserta_perempuan" name="nama_peserta_perempuan" rows="5"
                                          class="form-control @error('nama_peserta_perempuan') is-invalid @enderror"
                                          placeholder="Ketik satu nama per baris, contoh:&#10;Mega&#10;Wati&#10;Siti">{{ old('nama_peserta_perempuan', $existingNamaP) }}</textarea>
                                @error('nama_peserta_perempuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="form-hint">Tulis <strong>satu nama per baris</strong> (tekan Enter untuk baris baru). Jumlah peserta akan otomatis menyesuaikan.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="total-box">
                    <span>Total Seluruh Peserta</span>
                    <strong id="totalPeserta">0 Orang</strong>
                </div>

                <!-- DOKUMENTASI -->
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
                                  placeholder="https://drive.google.com/drive/folders/...">{{ old('link_dokumentasi', $data->link_dokumentasi ?? '') }}</textarea>
                        @error('link_dokumentasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <span class="form-hint">Tempel link Google Drive. Kalau lebih dari satu, tulis <strong>satu link per baris</strong>. Pastikan akses link diatur "Siapa saja yang memiliki link".</span>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="/internal/pencegahan/pemberdayaan-masyarakat/sosialisasi" class="btn-cancel">Batal</a>
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
        if (!kec) {
            addOption(selKel, '', 'Pilih kecamatan dulu', true);
            selKel.options[0].disabled = true;
            selKel.disabled = true;
            return;
        }
        var list = (WILAYAH[kec] || []).slice();
        // Jaga data lama: kalau kelurahan tersimpan tidak ada di daftar, tetap tampilkan
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
        // Jaga data lama: kalau kecamatan tersimpan tidak ada di daftar, tetap tampilkan
        if (oldKec && kecList.indexOf(oldKec) === -1) kecList.push(oldKec);

        kecList.forEach(function (k) { addOption(selKec, k, k, k === oldKec); });
        selKec.options[0].selected = !oldKec;

        fillKelurahan(oldKec, oldKel);
        selKec.addEventListener('change', function () { fillKelurahan(selKec.value, ''); });
    }

    /* ---------- Hitung Jumlah & Daftar Peserta Otomatis ---------- */
    var inputL = document.getElementById('peserta_laki_laki');
    var inputP = document.getElementById('peserta_perempuan');
    var textareaL = document.getElementById('nama_peserta_laki_laki');
    var textareaP = document.getElementById('nama_peserta_perempuan');
    var badgeL = document.getElementById('badgeLaki');
    var badgeP = document.getElementById('badgePerempuan');
    var totalEl = document.getElementById('totalPeserta');

    function hitungBarisNama(teks) {
        if (!teks) return 0;
        return teks
            .split(/[\r\n,;]+/)
            .map(function (s) { return s.trim(); })
            .filter(function (s) { return s.length > 0; })
            .length;
    }

    function hitungTotal() {
        var l = Math.max(0, parseInt(inputL ? inputL.value : 0, 10) || 0);
        var p = Math.max(0, parseInt(inputP ? inputP.value : 0, 10) || 0);

        if (badgeL) badgeL.textContent = l + ' Orang';
        if (badgeP) badgeP.textContent = p + ' Orang';
        if (totalEl) totalEl.textContent = (l + p) + ' Orang';
    }

    if (textareaL && inputL) {
        textareaL.addEventListener('input', function () {
            inputL.value = hitungBarisNama(this.value);
            hitungTotal();
        });
    }

    if (textareaP && inputP) {
        textareaP.addEventListener('input', function () {
            inputP.value = hitungBarisNama(this.value);
            hitungTotal();
        });
    }

    if (inputL) inputL.addEventListener('input', hitungTotal);
    if (inputP) inputP.addEventListener('input', hitungTotal);

    hitungTotal();

    /* ---------- Cegah submit ganda ---------- */
    var form = document.getElementById('formSosialisasi');
    var btnSave = document.getElementById('btnSave');
    if (form && btnSave) {
        form.addEventListener('submit', function () {
            btnSave.disabled = true;
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    }
})();
</script>
@endpush