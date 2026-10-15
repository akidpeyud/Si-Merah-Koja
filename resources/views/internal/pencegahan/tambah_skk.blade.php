@extends('layouts.dashboard')

@section('title', 'Tambah Permohonan SKK')

@push('styles')
<style>
    :root {
        --ink: #0d1b2a;
        --paper: #f7f9fc;
        --navy: #163a63;
        --navy-dark: #0d2947;
        --navy-light: #eaf1f8;
        --navy-soft: rgba(22, 58, 99, .10);
        --signal: #dc3545;
        --success: #198754;
        --amber: #f4b740;
        --steel: #64748b;
        --line: #e6eaf1;
        --line-dark: #d5dce6;
        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --r-md: 14px;
        --r-sm: 10px;
        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
    }

    /* ---------- Header halaman ---------- */
    .page-head { margin-bottom: 24px; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.5rem, 3vw, 2rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 6px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .96rem; margin: 0; }
    .wrap-form { max-width: 1000px; margin: 0 auto; }

    /* ---------- Tombol ---------- */
    .btn-back { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #fff; color: var(--ink); border: 1px solid var(--line-dark); padding: 11px 22px; border-radius: 8px; font-weight: 600; font-size: .92rem; transition: .2s; text-decoration: none; }
    .btn-back:hover { background: var(--paper); color: var(--ink); }
    .btn-back.sm { padding: 8px 16px; font-size: .86rem; }
    .btn-submit { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: var(--navy); color: #fff; padding: 11px 24px; border-radius: 8px; font-weight: 600; font-size: .92rem; border: none; transition: .2s; }
    .btn-submit:hover { background: var(--navy-dark); transform: translateY(-1px); }

    /* ---------- Pilihan jenis permohonan ---------- */
    .type-picker { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px; }
    .type-input { position: absolute; opacity: 0; pointer-events: none; }
    .type-card { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: #fff; border: 2px solid var(--line); border-radius: var(--r-md); cursor: pointer; transition: border-color .2s, box-shadow .2s, background .2s; height: 100%; }
    .type-card:hover { border-color: var(--line-dark); box-shadow: var(--shadow-sm); }
    .type-card .ico { flex: none; width: 46px; height: 46px; border-radius: 12px; display: grid; place-items: center; font-size: 1.15rem; background: var(--paper); color: var(--steel); transition: .2s; }
    .type-card strong { display: block; font-family: var(--font-display); font-size: 1.02rem; color: var(--ink); }
    .type-card span.desc { display: block; font-size: .82rem; color: var(--steel); margin-top: 2px; line-height: 1.4; }
    .type-card .tick { margin-left: auto; flex: none; width: 22px; height: 22px; border-radius: 50%; border: 2px solid var(--line-dark); display: grid; place-items: center; font-size: .65rem; color: transparent; transition: .2s; }
    .type-input:checked + .type-card { border-color: var(--navy); background: var(--navy-light); box-shadow: 0 0 0 3px var(--navy-soft); }
    .type-input:checked + .type-card .ico { background: var(--navy); color: #fff; }
    .type-input:checked + .type-card .tick { background: var(--navy); border-color: var(--navy); color: #fff; }
    .type-input:focus-visible + .type-card { outline: 2px solid var(--navy); outline-offset: 2px; }

    /* ---------- Kartu seksi ---------- */
    .form-section { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); margin-bottom: 18px; overflow: hidden; }
    .form-section .sec-head { display: flex; align-items: center; gap: 12px; padding: 16px 24px; background: var(--paper); border-bottom: 1px solid var(--line); }
    .form-section .sec-no { flex: none; width: 28px; height: 28px; border-radius: 50%; background: var(--navy); color: #fff; display: grid; place-items: center; font-size: .8rem; font-weight: 700; font-family: var(--font-display); }
    .form-section .sec-title { font-family: var(--font-display); font-weight: 700; font-size: 1.02rem; color: var(--navy); margin: 0; }
    .form-section .sec-sub { font-size: .8rem; color: var(--steel); margin: 0; }
    .form-section .sec-body { padding: 24px; }
    .form-section.renew { border-color: rgba(244, 183, 64, .6); }
    .form-section.renew .sec-head { background: #fffaf0; border-bottom-color: rgba(244, 183, 64, .4); }
    .form-section.renew .sec-no { background: #c98a0a; }
    .form-section.renew .sec-title { color: #8a5d05; }

    /* ---------- Input ---------- */
    .form-label { font-size: .86rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-label .req { color: var(--signal); margin-left: 2px; }
    .form-control, .form-select { font-size: .92rem; padding: 10px 14px; border-radius: 8px; border: 1px solid var(--line-dark); background-color: #fff; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::placeholder { color: #aab4c3; }
    .input-group-text { background: var(--paper); border: 1px solid var(--line-dark); color: var(--steel); font-size: .85rem; font-weight: 600; }
    .input-group > .form-control:not(:last-child) { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .hint { font-size: .78rem; color: var(--steel); margin-top: 5px; }

    /* ---------- Footer aksi ---------- */
    .form-actions { display: flex; justify-content: flex-end; gap: 12px; padding: 18px 24px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); }

    @media (max-width: 640px) {
        .type-picker { grid-template-columns: 1fr; }
        .form-section .sec-body { padding: 18px; }
        .form-actions { flex-direction: column-reverse; }
        .form-actions > * { width: 100%; }
    }
</style>
@endpush

@section('content')
@php
    $tipe = old('tipe_permohonan', request('tipe') === 'perpanjang' ? 'perpanjang' : 'baru');
    $kategoriList = ['Rumah Tinggal', 'Komersial (Mall/Toko)', 'Fasilitas Layanan Kesehatan', 'Perkantoran', 'Hotel / Penginapan', 'Pabrik / Gudang', 'Pendidikan'];
    $statusList = ['Pending', 'Diproses', 'Memenuhi Syarat', 'Tidak Memenuhi Syarat'];

    // Data wilayah Kota Jambi (kecamatan => daftar kelurahan)
    $dataWilayah = [
        'Alam Barajo'   => ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawa Sari', 'Simpang Rimbo'],
        'Danau Sipin'   => ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk'   => ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan' => ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur'   => ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sejinjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung'      => ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru'     => ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya', 'Talang Gulo'],
        'Paal Merah'    => ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi'   => ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan'    => ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura'   => ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali'],
    ];
    $oldKec = old('kecamatan');
    $oldKel = old('kelurahan');
@endphp

<div class="wrap-form">

    <div class="mb-3">
        <a href="/internal/pencegahan/kelola-skk" class="btn-back sm"><i class="fas fa-arrow-left"></i> Kembali ke Kelola SKK</a>
    </div>

    <div class="page-head">
        <h1>Tambah Permohonan SKK</h1>
        <p>Input data pengajuan Sertifikat Keamanan Kebakaran (baru maupun perpanjangan) secara manual oleh petugas.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4" style="border-radius: 8px;">
            <strong><i class="fas fa-exclamation-circle me-1"></i> Data belum lengkap / tidak valid:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    @hasanyrole('Pencegahan|Super User')
    <form action="{{ route('skk.store') }}" method="POST" enctype="multipart/form-data" id="formSkk">
        @csrf

        {{-- ============ JENIS PERMOHONAN ============ --}}
        <div class="type-picker" role="radiogroup" aria-label="Jenis permohonan">
            <div>
                <input type="radio" class="type-input" name="tipe_permohonan" id="tipeBaru" value="baru" {{ $tipe === 'baru' ? 'checked' : '' }}>
                <label for="tipeBaru" class="type-card">
                    <span class="ico"><i class="fas fa-file-circle-plus"></i></span>
                    <span><strong>SKK Baru</strong><span class="desc">Pengajuan pertama kali untuk bangunan / usaha.</span></span>
                    <span class="tick"><i class="fas fa-check"></i></span>
                </label>
            </div>
            <div>
                <input type="radio" class="type-input" name="tipe_permohonan" id="tipePerpanjang" value="perpanjang" {{ $tipe === 'perpanjang' ? 'checked' : '' }}>
                <label for="tipePerpanjang" class="type-card">
                    <span class="ico"><i class="fas fa-sync-alt"></i></span>
                    <span><strong>Perpanjangan SKK</strong><span class="desc">Memperpanjang SKK yang sudah ada / hampir habis masa berlaku.</span></span>
                    <span class="tick"><i class="fas fa-check"></i></span>
                </label>
            </div>
        </div>

        {{-- ============ 1. DATA PEMOHON ============ --}}
        <section class="form-section">
            <div class="sec-head">
                <span class="sec-no">1</span>
                <div><h2 class="sec-title">Data Pemohon</h2><p class="sec-sub">Kontak yang dapat dihubungi terkait permohonan.</p></div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Pemohon <span class="req">*</span></label>
                        <input type="text" class="form-control @error('nama_pemohon') is-invalid @enderror" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="req">*</span></label>
                        <input type="email" class="form-control @error('email_pemohon') is-invalid @enderror" name="email_pemohon" value="{{ old('email_pemohon') }}" placeholder="nama@email.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. WhatsApp <span class="req">*</span></label>
                        <input type="text" class="form-control @error('no_whatsapp') is-invalid @enderror" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="08xxxxxxxxxx" inputmode="tel" required>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============ 2. DATA USAHA & PEMILIK ============ --}}
        <section class="form-section">
            <div class="sec-head">
                <span class="sec-no">2</span>
                <div><h2 class="sec-title">Data Usaha &amp; Pemilik</h2><p class="sec-sub">Identitas usaha dan pemilik bangunan.</p></div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Usaha / Perusahaan <span class="req">*</span></label>
                        <input type="text" class="form-control @error('nama_usaha') is-invalid @enderror" name="nama_usaha" value="{{ old('nama_usaha') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK Pemilik Usaha <span class="req">*</span></label>
                        <input type="text" class="form-control @error('nik_pemilik_usaha') is-invalid @enderror" name="nik_pemilik_usaha" value="{{ old('nik_pemilik_usaha') }}" maxlength="30" inputmode="numeric" required>
                        <div class="hint">Maksimal 30 karakter.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat Pemilik Usaha <span class="req">*</span></label>
                        <input type="text" class="form-control @error('alamat_pemilik_usaha') is-invalid @enderror" name="alamat_pemilik_usaha" value="{{ old('alamat_pemilik_usaha') }}" required>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============ 3. DATA BANGUNAN ============ --}}
        <section class="form-section">
            <div class="sec-head">
                <span class="sec-no">3</span>
                <div><h2 class="sec-title">Data Bangunan Gedung</h2><p class="sec-sub">Lokasi dan spesifikasi bangunan.</p></div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Kategori Bangunan <span class="req">*</span></label>
                        <select class="form-select @error('kategori_bangunan') is-invalid @enderror" name="kategori_bangunan" required>
                            <option value="" disabled {{ old('kategori_bangunan') ? '' : 'selected' }}>Pilih Kategori Bangunan</option>
                            @foreach($kategoriList as $k)
                                <option value="{{ $k }}" {{ old('kategori_bangunan') == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap Bangunan <span class="req">*</span></label>
                        <textarea class="form-control @error('alamat_bangunan') is-invalid @enderror" name="alamat_bangunan" rows="2" required>{{ old('alamat_bangunan') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan <span class="req">*</span></label>
                        <select class="form-select @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required>
                            <option value="" disabled @if(!$oldKec) selected @endif>Pilih Kecamatan</option>
                            @foreach(array_keys($dataWilayah) as $kc)
                                <option value="{{ $kc }}" @if($oldKec === $kc) selected @endif>{{ $kc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan <span class="req">*</span></label>
                        <select class="form-select @error('kelurahan') is-invalid @enderror" name="kelurahan" id="kelurahan" required>
                            @if($oldKec && isset($dataWilayah[$oldKec]))
                                <option value="" disabled @if(!$oldKel) selected @endif>Pilih Kelurahan</option>
                                @foreach($dataWilayah[$oldKec] as $kl)
                                    <option value="{{ $kl }}" @if($oldKel === $kl) selected @endif>{{ $kl }}</option>
                                @endforeach
                            @else
                                <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Tanah <span class="req">*</span></label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" class="form-control @error('luas_lahan') is-invalid @enderror" name="luas_lahan" value="{{ old('luas_lahan') }}" required>
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Luas Bangunan <span class="req">*</span></label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" class="form-control @error('luas_bangunan') is-invalid @enderror" name="luas_bangunan" value="{{ old('luas_bangunan') }}" required>
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tinggi Bangunan <span class="req">*</span></label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" class="form-control @error('tinggi_bangunan') is-invalid @enderror" name="tinggi_bangunan" value="{{ old('tinggi_bangunan') }}" required>
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============ DATA SKK LAMA (hanya untuk perpanjangan) ============ --}}
        <section class="form-section renew" id="sectionPerpanjang" hidden>
            <div class="sec-head">
                <span class="sec-no"><i class="fas fa-sync-alt" style="font-size:.7rem;"></i></span>
                <div><h2 class="sec-title">Data SKK Sebelumnya</h2><p class="sec-sub">Wajib diisi untuk perpanjangan: informasi sertifikat yang akan diperpanjang.</p></div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nomor SKK Lama <span class="req">*</span></label>
                        <input type="text" class="form-control @error('nomor_skk_lama') is-invalid @enderror js-renew" name="nomor_skk_lama" value="{{ old('nomor_skk_lama') }}" data-required="1" placeholder="Nomor sertifikat sebelumnya">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Terbit <span class="req">*</span></label>
                        <input type="date" class="form-control @error('tanggal_terbit_skk_lama') is-invalid @enderror js-renew" name="tanggal_terbit_skk_lama" value="{{ old('tanggal_terbit_skk_lama') }}" data-required="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Masa Berlaku Sampai <span class="req">*</span></label>
                        <input type="date" class="form-control @error('masa_berlaku_skk_lama') is-invalid @enderror js-renew" name="masa_berlaku_skk_lama" value="{{ old('masa_berlaku_skk_lama') }}" data-required="1">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Upload Salinan SKK Lama <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="file" class="form-control @error('file_skk_lama') is-invalid @enderror js-renew" name="file_skk_lama" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="hint">Format PDF / JPG / PNG.</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============ STATUS & DOKUMEN ============ --}}
        <section class="form-section">
            <div class="sec-head">
                <span class="sec-no" id="secNoStatus">4</span>
                <div><h2 class="sec-title">Status &amp; Dokumen</h2><p class="sec-sub">Status awal permohonan dan lampiran surat.</p></div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Status Permohonan <span class="req">*</span></label>
                        <select class="form-select @error('status_permohonan') is-invalid @enderror" name="status_permohonan" required>
                            @foreach($statusList as $s)
                                <option value="{{ $s }}" {{ old('status_permohonan', 'Pending') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Upload Surat Permohonan <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="file" class="form-control @error('file_surat_permohonan') is-invalid @enderror" name="file_surat_permohonan" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="hint">Format PDF / JPG / PNG.</div>
                    </div>
                </div>
            </div>
        </section>

        <div class="form-actions">
            <a href="/internal/pencegahan/kelola-skk" class="btn-back">Batal</a>
            <button type="submit" class="btn-submit"><i class="fas fa-save"></i> <span id="submitLabel">Simpan Data SKK</span></button>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center" style="border-radius: 8px;">
            <i class="fas fa-lock mb-2" style="font-size: 2rem;"></i><br>
            <strong>Akses Ditolak!</strong> Anda tidak memiliki izin untuk menambah data SKK.
        </div>
    @endhasanyrole

</div>
@endsection

@push('scripts')
<script>
// Dropdown bertingkat: kecamatan -> kelurahan
(function () {
    'use strict';
    var dataWilayah = @json($dataWilayah);
    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');
    if (!kec || !kel) return;

    kec.addEventListener('change', function () {
        kel.innerHTML = '';
        var ph = new Option('Pilih Kelurahan', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        (dataWilayah[kec.value] || []).forEach(function (nama) {
            kel.add(new Option(nama, nama));
        });
    });
})();
</script>
<script>
(function () {
    'use strict';

    var radios   = document.querySelectorAll('input[name="tipe_permohonan"]');
    var section  = document.getElementById('sectionPerpanjang');
    var fields   = document.querySelectorAll('.js-renew');
    var secNo    = document.getElementById('secNoStatus');
    var label    = document.getElementById('submitLabel');
    if (!radios.length || !section) return;

    function apply() {
        var perpanjang = document.getElementById('tipePerpanjang').checked;

        section.hidden = !perpanjang;
        secNo.textContent = perpanjang ? '5' : '4';
        label.textContent = perpanjang ? 'Simpan Perpanjangan SKK' : 'Simpan Data SKK';

        // Field SKK lama hanya dikirim & divalidasi saat perpanjangan.
        fields.forEach(function (el) {
            el.disabled = !perpanjang;
            if (el.dataset.required) el.required = perpanjang;
        });
    }

    radios.forEach(function (r) { r.addEventListener('change', apply); });
    apply();
})();
</script>
@endpush