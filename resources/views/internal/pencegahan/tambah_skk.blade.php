@extends('layouts.dashboard')

@section('title', 'Tambah Permohonan SKK')

@push('styles')
<style>
    /* Page & Header Styling */
    .page-header-box {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
    }
    .page-header-box h1 {
        font-family: var(--font-display);
        font-size: clamp(1.4rem, 2.5vw, 1.85rem);
        font-weight: 700;
        color: var(--ink);
        letter-spacing: -0.02em;
        margin-bottom: 4px;
    }
    .page-header-box p {
        color: var(--steel);
        font-size: 0.92rem;
        margin-bottom: 0;
    }

    /* Wrap Form Container */
    .wrap-form {
        max-width: 960px;
        margin: 0 auto;
    }

    /* Modern Panel Card */
    .form-panel {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        box-shadow: var(--shadow-xs);
        transition: box-shadow .2s ease, border-color .2s ease;
        overflow: hidden;
    }
    .form-panel:hover {
        border-color: #cbd5e1;
        box-shadow: var(--shadow-sm);
    }
    .panel-header {
        padding: 18px 24px;
        background: #ffffff;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .panel-title {
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    .panel-title-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--navy-soft);
        color: var(--navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
    .panel-body {
        padding: 28px;
    }

    /* Pilihan Jenis Permohonan Cards */
    .type-picker {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }
    .type-input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .type-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        background: #ffffff;
        border: 2px solid var(--line);
        border-radius: var(--r-md);
        cursor: pointer;
        transition: all 0.2s ease;
        height: 100%;
        position: relative;
    }
    .type-card:hover {
        border-color: #cbd5e1;
        box-shadow: var(--shadow-sm);
    }
    .type-card .ico {
        flex: none;
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 1.15rem;
        background: #f1f5f9;
        color: var(--navy);
        transition: all 0.2s ease;
    }
    .type-card strong {
        display: block;
        font-family: var(--font-display);
        font-size: 1rem;
        color: var(--ink);
    }
    .type-card span.desc {
        display: block;
        font-size: 0.8rem;
        color: var(--steel);
        margin-top: 2px;
        line-height: 1.35;
    }
    .type-card .tick {
        margin-left: auto;
        flex: none;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 2px solid var(--line-dark);
        display: grid;
        place-items: center;
        font-size: 0.65rem;
        color: transparent;
        transition: all 0.2s ease;
    }
    .type-input:checked + .type-card {
        border-color: var(--navy);
        background: #f8fafc;
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .type-input:checked + .type-card .ico {
        background: var(--navy);
        color: #ffffff;
    }
    .type-input:checked + .type-card .tick {
        background: var(--navy);
        border-color: var(--navy);
        color: #ffffff;
    }

    /* Section Titles */
    .form-section-title {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--steel-soft);
        margin: 28px 0 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--line);
    }
    .form-section-title:first-of-type {
        margin-top: 0;
    }

    /* Perpanjang Section Highlight */
    .renew-highlight-box {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-left: 4px solid #f59e0b;
        border-radius: 8px;
        padding: 18px 20px;
        margin-bottom: 24px;
        transition: all 0.25s ease;
    }

    /* Form Fields */
    .form-label {
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--ink-2);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .label-badge {
        font-size: 0.7rem;
        font-weight: 500;
        padding: 2px 7px;
        border-radius: 4px;
    }
    .badge-req { background: #fee2e2; color: #b91c1c; }
    .badge-opt { background: #f1f5f9; color: #64748b; }

    .input-group-text {
        background: #f8fafc;
        border-color: var(--line-dark);
        color: var(--steel);
        font-size: 0.88rem;
        padding: 0 14px;
        border-radius: 8px 0 0 8px;
    }
    .form-control, .form-select {
        min-height: 44px;
        font-size: 0.92rem;
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        color: var(--ink);
        background-color: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .input-group .form-control, .input-group .form-select {
        border-radius: 0 8px 8px 0;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3.5px var(--navy-soft);
    }
    .form-control::placeholder {
        color: #94a3b8;
        font-size: 0.88rem;
    }
    .hint {
        font-size: 0.76rem;
        color: var(--steel);
        margin-top: 4px;
    }

    /* Action Buttons */
    .btn-submit-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 44px;
        padding: 0 24px;
        background: var(--navy);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 0.92rem;
        font-weight: 600;
        transition: all .2s ease;
    }
    .btn-submit-main:hover {
        background: var(--navy-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 58, 99, 0.25);
        color: #ffffff;
    }
    .btn-cancel-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 44px;
        padding: 0 20px;
        background: #ffffff;
        color: var(--steel);
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        font-size: 0.92rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .15s ease;
    }
    .btn-cancel-main:hover {
        background: #f8fafc;
        color: var(--ink);
        border-color: #cbd5e1;
    }

    @media (max-width: 640px) {
        .type-picker { grid-template-columns: 1fr; }
        .panel-body { padding: 18px; }
    }
</style>
@endpush

@section('content')
@php
    $tipe = old('tipe_permohonan', request('tipe') === 'perpanjang' ? 'perpanjang' : 'baru');
    $kategoriList = ['Rumah Tinggal', 'Komersial (Mall/Toko)', 'Fasilitas Layanan Kesehatan', 'Perkantoran', 'Hotel / Penginapan', 'Pabrik / Gudang', 'Pendidikan'];
    $statusList = ['Pending', 'Diproses', 'Memenuhi Syarat', 'Tidak Memenuhi Syarat'];

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

    <!-- Header Section -->
    <div class="page-header-box">
        <div>
            <h1>Tambah Permohonan SKK</h1>
            <p>Input data pengajuan Sertifikat Keamanan Kebakaran (baru maupun perpanjangan) secara manual oleh petugas.</p>
        </div>
        <div>
            <a href="{{ url('/internal/pencegahan/kelola-skk') }}" class="btn-cancel-main">
                <i class="fas fa-arrow-left"></i> Kembali ke Kelola SKK
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger d-flex align-items-start gap-3 mb-4 rounded-3 shadow-xs">
            <i class="fas fa-circle-exclamation fs-5 mt-1 flex-shrink-0 text-danger"></i>
            <div class="flex-grow-1">
                <strong class="d-block mb-1">Data belum lengkap / tidak valid:</strong>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @hasanyrole('Pencegahan|Super User')
    <form action="{{ route('skk.store') }}" method="POST" enctype="multipart/form-data" id="formSkk">
        @csrf

        {{-- ============ PILIHAN JENIS PERMOHONAN ============ --}}
        <div class="type-picker" role="radiogroup" aria-label="Jenis permohonan">
            <div>
                <input type="radio" class="type-input" name="tipe_permohonan" id="tipeBaru" value="baru" {{ $tipe === 'baru' ? 'checked' : '' }}>
                <label for="tipeBaru" class="type-card">
                    <span class="ico"><i class="fas fa-file-circle-plus"></i></span>
                    <div>
                        <strong>SKK Baru</strong>
                        <span class="desc">Pengajuan pertama kali untuk bangunan atau tempat usaha baru.</span>
                    </div>
                    <span class="tick"><i class="fas fa-check"></i></span>
                </label>
            </div>
            <div>
                <input type="radio" class="type-input" name="tipe_permohonan" id="tipePerpanjang" value="perpanjang" {{ $tipe === 'perpanjang' ? 'checked' : '' }}>
                <label for="tipePerpanjang" class="type-card">
                    <span class="ico"><i class="fas fa-rotate"></i></span>
                    <div>
                        <strong>Perpanjangan SKK</strong>
                        <span class="desc">Memperpanjang SKK sebelumnya yang hampir atau sudah habis masa berlakunya.</span>
                    </div>
                    <span class="tick"><i class="fas fa-check"></i></span>
                </label>
            </div>
        </div>

        <div class="form-panel">
            <div class="panel-header">
                <div class="panel-title">
                    <span class="panel-title-icon"><i class="fas fa-certificate"></i></span>
                    Formulir Permohonan SKK
                </div>
                <span class="badge bg-light text-secondary border" id="modeBadge">Input Baru</span>
            </div>

            <div class="panel-body">

                {{-- ============ 1. DATA PEMOHON ============ --}}
                <div class="form-section-title">
                    <i class="fas fa-user-tie me-1"></i> 1. Data Pemohon
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="namaPemohonInput">
                            <span>Nama Lengkap Pemohon</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="namaPemohonInput" class="form-control @error('nama_pemohon') is-invalid @enderror" name="nama_pemohon" placeholder="Masukkan nama pemohon" value="{{ old('nama_pemohon') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="emailPemohonInput">
                            <span>Email Pemohon</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="emailPemohonInput" class="form-control @error('email_pemohon') is-invalid @enderror" name="email_pemohon" value="{{ old('email_pemohon') }}" placeholder="contoh@email.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="noWhatsappInput">
                            <span>No. WhatsApp / Telepon</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                            <input type="tel" id="noWhatsappInput" class="form-control @error('no_whatsapp') is-invalid @enderror" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="08xxxxxxxxxx" inputmode="tel" required>
                        </div>
                    </div>
                </div>

                {{-- ============ 2. DATA USAHA & PEMILIK ============ --}}
                <div class="form-section-title">
                    <i class="fas fa-briefcase me-1"></i> 2. Data Usaha & Pemilik
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="namaUsahaInput">
                            <span>Nama Usaha / Perusahaan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-store"></i></span>
                            <input type="text" id="namaUsahaInput" class="form-control @error('nama_usaha') is-invalid @enderror" name="nama_usaha" placeholder="Contoh: PT Sumber Rezeki / Toko Damai" value="{{ old('nama_usaha') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nikPemilikInput">
                            <span>NIK Pemilik Usaha (Maks 30 Karakter)</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" id="nikPemilikInput" class="form-control @error('nik_pemilik_usaha') is-invalid @enderror" name="nik_pemilik_usaha" value="{{ old('nik_pemilik_usaha') }}" maxlength="30" placeholder="150xxxxxxxxxxxxx" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="alamatPemilikInput">
                            <span>Alamat Pemilik Usaha (KTP)</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <input type="text" id="alamatPemilikInput" class="form-control @error('alamat_pemilik_usaha') is-invalid @enderror" name="alamat_pemilik_usaha" placeholder="Alamat sesuai KTP pemilik" value="{{ old('alamat_pemilik_usaha') }}" required>
                        </div>
                    </div>
                </div>

                {{-- ============ 3. DATA BANGUNAN GEDUNG ============ --}}
                <div class="form-section-title">
                    <i class="fas fa-building me-1"></i> 3. Data Bangunan Gedung
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="kategoriBangunanSelect">
                            <span>Kategori Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select class="form-select @error('kategori_bangunan') is-invalid @enderror" id="kategoriBangunanSelect" name="kategori_bangunan" required>
                                <option value="" disabled {{ old('kategori_bangunan') ? '' : 'selected' }}>-- Pilih Kategori Bangunan --</option>
                                @foreach($kategoriList as $k)
                                    <option value="{{ $k }}" {{ old('kategori_bangunan') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="alamatBangunanInput">
                            <span>Alamat Lengkap Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <textarea id="alamatBangunanInput" class="form-control @error('alamat_bangunan') is-invalid @enderror" name="alamat_bangunan" rows="2" placeholder="Masukkan alamat lengkap lokasi bangunan/objek..." required>{{ old('alamat_bangunan') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="kecamatan">
                            <span>Kecamatan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-location-dot"></i></span>
                            <select class="form-select @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required>
                                <option value="" disabled @if(!$oldKec) selected @endif>-- Pilih Kecamatan --</option>
                                @foreach(array_keys($dataWilayah) as $kc)
                                    <option value="{{ $kc }}" @if($oldKec === $kc) selected @endif>{{ $kc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="kelurahan">
                            <span>Kelurahan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            <select class="form-select @error('kelurahan') is-invalid @enderror" name="kelurahan" id="kelurahan" required>
                                @if($oldKec && isset($dataWilayah[$oldKec]))
                                    <option value="" disabled @if(!$oldKel) selected @endif>-- Pilih Kelurahan --</option>
                                    @foreach($dataWilayah[$oldKec] as $kl)
                                        <option value="{{ $kl }}" @if($oldKel === $kl) selected @endif>{{ $kl }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="luasLahanInput">
                            <span>Luas Lahan / Tanah</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" id="luasLahanInput" class="form-control @error('luas_lahan') is-invalid @enderror" name="luas_lahan" placeholder="0" value="{{ old('luas_lahan') }}" required>
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="luasBangunanInput">
                            <span>Luas Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" id="luasBangunanInput" class="form-control @error('luas_bangunan') is-invalid @enderror" name="luas_bangunan" placeholder="0" value="{{ old('luas_bangunan') }}" required>
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="tinggiBangunanInput">
                            <span>Tinggi Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" id="tinggiBangunanInput" class="form-control @error('tinggi_bangunan') is-invalid @enderror" name="tinggi_bangunan" placeholder="0" value="{{ old('tinggi_bangunan') }}" required>
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </div>

                {{-- ============ 4. DATA SKK LAMA (Hanya untuk Perpanjangan) ============ --}}
                <div id="sectionPerpanjang" hidden>
                    <div class="form-section-title">
                        <i class="fas fa-rotate me-1 text-warning"></i> 4. Data SKK Sebelumnya
                    </div>

                    <div class="renew-highlight-box">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fas fa-triangle-exclamation text-warning fs-5"></i>
                            <div>
                                <strong class="d-block text-dark">Informasi Sertifikat Sebelumnya</strong>
                                <small class="text-muted">Wajib dilengkapi untuk proses verifikasi perpanjangan SKK.</small>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nomorSkkLamaInput">
                                    <span>Nomor SKK Lama</span>
                                    <span class="label-badge badge-req">Wajib</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    <input type="text" id="nomorSkkLamaInput" class="form-control @error('nomor_skk_lama') is-invalid @enderror js-renew" name="nomor_skk_lama" value="{{ old('nomor_skk_lama') }}" data-required="1" placeholder="Nomor sertifikat SKK sebelumnya">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="tglTerbitSkkInput">
                                    <span>Tanggal Terbit</span>
                                    <span class="label-badge badge-req">Wajib</span>
                                </label>
                                <input type="date" id="tglTerbitSkkInput" class="form-control @error('tanggal_terbit_skk_lama') is-invalid @enderror js-renew" name="tanggal_terbit_skk_lama" value="{{ old('tanggal_terbit_skk_lama') }}" data-required="1">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="masaBerlakuSkkInput">
                                    <span>Berlaku Sampai</span>
                                    <span class="label-badge badge-req">Wajib</span>
                                </label>
                                <input type="date" id="masaBerlakuSkkInput" class="form-control @error('masa_berlaku_skk_lama') is-invalid @enderror js-renew" name="masa_berlaku_skk_lama" value="{{ old('masa_berlaku_skk_lama') }}" data-required="1">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="fileSkkLamaInput">
                                    <span>Upload Salinan SKK Lama</span>
                                    <span class="label-badge badge-opt">Opsional</span>
                                </label>
                                <input type="file" id="fileSkkLamaInput" class="form-control @error('file_skk_lama') is-invalid @enderror js-renew" name="file_skk_lama" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="hint">Format PDF, JPG, atau PNG (Maks 2 MB).</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============ STATUS & DOKUMEN ============ --}}
                <div class="form-section-title">
                    <i class="fas fa-file-signature me-1"></i> <span id="secNoStatusTitle">4. Status & Dokumen</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="statusPermohonanSelect">
                            <span>Status Awal Permohonan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clipboard-check"></i></span>
                            <select id="statusPermohonanSelect" class="form-select @error('status_permohonan') is-invalid @enderror" name="status_permohonan" required>
                                @foreach($statusList as $s)
                                    <option value="{{ $s }}" {{ old('status_permohonan', 'Pending') == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="fileSuratInput">
                            <span>Upload Surat Permohonan</span>
                            <span class="label-badge badge-opt">Opsional</span>
                        </label>
                        <input type="file" id="fileSuratInput" class="form-control @error('file_surat_permohonan') is-invalid @enderror" name="file_surat_permohonan" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="hint">Format PDF, JPG, atau PNG (Maks 2 MB).</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-4 border-top">
                    <a href="{{ url('/internal/pencegahan/kelola-skk') }}" class="btn-cancel-main">
                        Batal
                    </a>
                    <button type="submit" class="btn-submit-main" id="btnSubmitSkk">
                        <i class="fas fa-floppy-disk"></i> <span id="submitLabel">Simpan Data SKK</span>
                    </button>
                </div>

            </div>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center p-4 rounded-3">
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
        var ph = new Option('-- Pilih Kelurahan --', '', true, true);
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
    var secTitle = document.getElementById('secNoStatusTitle');
    var label    = document.getElementById('submitLabel');
    var modeBadge = document.getElementById('modeBadge');
    var form     = document.getElementById('formSkk');

    function apply() {
        var isPerpanjang = document.getElementById('tipePerpanjang').checked;

        if (section) section.hidden = !isPerpanjang;
        if (secTitle) secTitle.textContent = isPerpanjang ? '5. Status & Dokumen' : '4. Status & Dokumen';
        if (label) label.textContent = isPerpanjang ? 'Simpan Perpanjangan SKK' : 'Simpan Data SKK';
        if (modeBadge) {
            modeBadge.textContent = isPerpanjang ? 'Mode Perpanjangan' : 'SKK Baru';
            modeBadge.className = isPerpanjang 
                ? 'badge bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25' 
                : 'badge bg-light text-secondary border';
        }

        fields.forEach(function (el) {
            el.disabled = !isPerpanjang;
            if (el.dataset.required) el.required = isPerpanjang;
        });
    }

    radios.forEach(function (r) { r.addEventListener('change', apply); });
    apply();

    if (form) {
        form.addEventListener('submit', function () {
            var btn = document.getElementById('btnSubmitSkk');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                btn.disabled = true;
            }
        });
    }
})();
</script>
@endpush
