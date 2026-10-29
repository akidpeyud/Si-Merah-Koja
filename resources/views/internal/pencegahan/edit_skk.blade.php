@extends('layouts.dashboard')

@section('title', 'Edit Permohonan SKK')

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
        background: rgba(244, 183, 64, 0.18);
        color: #b45309;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
    .panel-body {
        padding: 28px;
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

    /* Current File Badge */
    .current-file-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .current-file-badge:hover {
        background: #0284c7;
        color: #ffffff;
        border-color: #0284c7;
    }
    .empty-file-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    /* Action Buttons */
    .btn-submit-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 44px;
        padding: 0 24px;
        background: var(--amber);
        color: var(--ink);
        border: none;
        border-radius: 8px;
        font-size: 0.92rem;
        font-weight: 700;
        transition: all .2s ease;
    }
    .btn-submit-main:hover {
        background: #e5a730;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(244, 183, 64, 0.35);
        color: var(--ink);
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
</style>
@endpush

@section('content')
@php
    $tipe = $tipe ?? 'baru';
    $isPerpanjang = ($tipe === 'perpanjang');
    $kategoriList = ['Rumah Tinggal', 'Komersial (Mall/Toko)', 'Fasilitas Layanan Kesehatan', 'Perkantoran', 'Hotel / Penginapan', 'Pabrik / Gudang', 'Pendidikan'];

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
    $selectedKec = old('kecamatan', $p->kecamatan);
    $selectedKel = old('kelurahan', $p->kelurahan);
@endphp

<div class="wrap-form">

    <!-- Header Section -->
    <div class="page-header-box">
        <div>
            <h1>Edit Permohonan SKK</h1>
            <p>Perbarui informasi dan spesifikasi berkas Sertifikat Keamanan Kebakaran (SKK).</p>
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
                <strong class="d-block mb-1">Terdapat kesalahan pada isian:</strong>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @hasanyrole('Pencegahan|Super User')
    <div class="form-panel">
        <div class="panel-header">
            <div class="panel-title">
                <span class="panel-title-icon"><i class="fas fa-pen-to-square"></i></span>
                Perbarui Data SKK #{{ $p->id }}
            </div>
            <span class="badge {{ $isPerpanjang ? 'bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25' : 'bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25' }}">
                {{ $isPerpanjang ? 'Mode Perpanjangan' : 'Mode SKK Baru' }}
            </span>
        </div>

        <div class="panel-body">
            <form action="{{ route('skk.update', $p->id) }}{{ $isPerpanjang ? '?tipe=perpanjang' : '' }}" method="POST" enctype="multipart/form-data" id="formEditSkk">
                @csrf
                @method('PUT')
                <input type="hidden" name="tipe" value="{{ $tipe }}">

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
                            <input type="text" id="namaPemohonInput" name="nama_pemohon" class="form-control" value="{{ old('nama_pemohon', $p->nama_pemohon) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nikPemilikInput">
                            <span>NIK Pemilik Usaha / Pemohon</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" id="nikPemilikInput" name="nik_pemilik_usaha" class="form-control" value="{{ old('nik_pemilik_usaha', $p->nik_pemilik_usaha) }}" maxlength="30" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="emailPemohonInput">
                            <span>Email Pemohon</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="emailPemohonInput" name="email_pemohon" class="form-control" value="{{ old('email_pemohon', $p->email_pemohon) }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="noWhatsappInput">
                            <span>No. WhatsApp / Telepon</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                            <input type="tel" id="noWhatsappInput" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', $p->no_whatsapp) }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="alamatPemilikInput">
                            <span>Alamat Pemilik Usaha (Sesuai KTP)</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <textarea id="alamatPemilikInput" name="alamat_pemilik_usaha" class="form-control" rows="2" required>{{ old('alamat_pemilik_usaha', $p->alamat_pemilik_usaha) }}</textarea>
                    </div>
                </div>

                {{-- ============ 2. DATA USAHA & BANGUNAN ============ --}}
                <div class="form-section-title">
                    <i class="fas fa-building me-1"></i> 2. Data Usaha & Bangunan Gedung
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="namaUsahaInput">
                            <span>Nama Usaha / Perusahaan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-store"></i></span>
                            <input type="text" id="namaUsahaInput" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $p->nama_usaha) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="kategoriBangunanSelect">
                            <span>Kategori Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select id="kategoriBangunanSelect" name="kategori_bangunan" class="form-select" required>
                                @foreach($kategoriList as $k)
                                    <option value="{{ $k }}" {{ old('kategori_bangunan', $p->kategori_bangunan) == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="alamatBangunanInput">
                            <span>Alamat Lengkap Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <textarea id="alamatBangunanInput" name="alamat_bangunan" class="form-control" rows="2" required>{{ old('alamat_bangunan', $p->alamat_bangunan) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="kecamatan">
                            <span>Kecamatan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-location-dot"></i></span>
                            <select name="kecamatan" id="kecamatan" class="form-select" required>
                                <option value="" disabled>-- Pilih Kecamatan --</option>
                                @foreach(array_keys($dataWilayah) as $kc)
                                    <option value="{{ $kc }}" {{ $selectedKec === $kc ? 'selected' : '' }}>{{ $kc }}</option>
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
                            <select name="kelurahan" id="kelurahan" class="form-select" required>
                                @if($selectedKec && isset($dataWilayah[$selectedKec]))
                                    @foreach($dataWilayah[$selectedKec] as $kl)
                                        <option value="{{ $kl }}" {{ $selectedKel === $kl ? 'selected' : '' }}>{{ $kl }}</option>
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
                            <input type="number" step="0.01" min="0" id="luasLahanInput" name="luas_lahan" class="form-control" value="{{ old('luas_lahan', $p->luas_lahan) }}" required>
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="luasBangunanInput">
                            <span>Luas Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" id="luasBangunanInput" name="luas_bangunan" class="form-control" value="{{ old('luas_bangunan', $p->luas_bangunan) }}" required>
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="tinggiBangunanInput">
                            <span>Tinggi Bangunan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" id="tinggiBangunanInput" name="tinggi_bangunan" class="form-control" value="{{ old('tinggi_bangunan', $p->tinggi_bangunan) }}" required>
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </div>

                {{-- ============ 3. DATA SKK LAMA (Hanya jika Perpanjangan) ============ --}}
                @if($isPerpanjang)
                <div class="form-section-title">
                    <i class="fas fa-rotate me-1 text-warning"></i> 3. Data SKK Sebelumnya
                </div>

                <div class="renew-highlight-box">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="nomorSkkLamaInput">
                                <span>Nomor SKK Lama</span>
                                <span class="label-badge badge-req">Wajib</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" id="nomorSkkLamaInput" name="nomor_skk_lama" class="form-control" value="{{ old('nomor_skk_lama', $p->nomor_skk_lama) }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="tglTerbitInput">
                                <span>Tanggal Terbit</span>
                                <span class="label-badge badge-req">Wajib</span>
                            </label>
                            <input type="date" id="tglTerbitInput" name="tanggal_terbit_skk_lama" class="form-control" value="{{ old('tanggal_terbit_skk_lama', $p->tanggal_terbit_skk_lama ? \Carbon\Carbon::parse($p->tanggal_terbit_skk_lama)->format('Y-m-d') : '') }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="masaBerlakuInput">
                                <span>Berlaku Sampai</span>
                                <span class="label-badge badge-req">Wajib</span>
                            </label>
                            <input type="date" id="masaBerlakuInput" name="masa_berlaku_skk_lama" class="form-control" value="{{ old('masa_berlaku_skk_lama', $p->masa_berlaku_skk_lama ? \Carbon\Carbon::parse($p->masa_berlaku_skk_lama)->format('Y-m-d') : '') }}" required>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="form-label" for="fileSkkLamaInput">
                                <span>Ganti Salinan SKK Lama</span>
                                <span class="label-badge badge-opt">Opsional</span>
                            </label>

                            <div class="mb-2">
                                @if($p->file_skk_lama && $p->file_skk_lama !== 'offline_registered' && $p->file_skk_lama !== 'Tidak dilampirkan (Offline)')
                                    <a href="{{ asset('storage/' . $p->file_skk_lama) }}" target="_blank" class="current-file-badge">
                                        <i class="fas fa-certificate text-warning"></i> Lihat Salinan SKK Lama Saat Ini
                                    </a>
                                @else
                                    <span class="empty-file-badge">
                                        <i class="fas fa-circle-info"></i> Belum ada salinan SKK lama terunggah
                                    </span>
                                @endif
                            </div>

                            <input type="file" id="fileSkkLamaInput" name="file_skk_lama" class="form-control" accept=".pdf,.png,.jpg,.jpeg">
                            <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah salinan SKK lama (Maks 2 MB).</small>
                        </div>
                    </div>
                </div>
                @endif

                {{-- ============ 4. STATUS & LAMPIRAN ============ --}}
                <div class="form-section-title">
                    <i class="fas fa-file-signature me-1"></i> {{ $isPerpanjang ? '4. Status & Dokumen Permohonan' : '3. Status & Dokumen Permohonan' }}
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="statusPermohonanSelect">
                            <span>Status Permohonan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clipboard-check"></i></span>
                            <select id="statusPermohonanSelect" name="status_permohonan" class="form-select" required>
                                <option value="Pending" {{ old('status_permohonan', $p->status_permohonan) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Diproses" {{ old('status_permohonan', $p->status_permohonan) == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                <option value="Memenuhi Syarat" {{ old('status_permohonan', $p->status_permohonan) == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                <option value="Tidak Memenuhi Syarat" {{ old('status_permohonan', $p->status_permohonan) == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="fileSuratInput">
                            <span>Ganti Surat Permohonan</span>
                            <span class="label-badge badge-opt">Opsional</span>
                        </label>

                        <div class="mb-2">
                            @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && $p->file_surat_permohonan !== 'Tidak dilampirkan (Offline)')
                                <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="current-file-badge">
                                    <i class="fas fa-file-lines text-primary"></i> Lihat Surat Permohonan Saat Ini
                                </a>
                            @else
                                <span class="empty-file-badge">
                                    <i class="fas fa-circle-info"></i> Tidak ada surat permohonan terlampir
                                </span>
                            @endif
                        </div>

                        <input type="file" id="fileSuratInput" name="file_surat_permohonan" class="form-control" accept=".pdf,.png,.jpg,.jpeg">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah surat (Maks 2 MB).</small>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-4 border-top">
                    <a href="{{ url('/internal/pencegahan/kelola-skk') }}" class="btn-cancel-main">
                        Batal
                    </a>
                    <button type="submit" class="btn-submit-main" id="btnSubmitEditSkk">
                        <i class="fas fa-check-circle"></i> Simpan Perubahan SKK
                    </button>
                </div>

            </form>
        </div>
    </div>
    @else
        <div class="alert alert-warning text-center p-4 rounded-3">
            <i class="fas fa-lock mb-2" style="font-size: 2rem;"></i><br>
            <strong>Akses Ditolak!</strong> Anda tidak memiliki izin untuk mengedit data SKK.
        </div>
    @endhasanyrole

</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var dataWilayah = @json($dataWilayah);
    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');
    var currentKel = "{{ $selectedKel }}";

    if (kec && kel) {
        kec.addEventListener('change', function () {
            kel.innerHTML = '';
            var ph = new Option('-- Pilih Kelurahan --', '', true, true);
            ph.disabled = true;
            kel.add(ph);
            (dataWilayah[kec.value] || []).forEach(function (nama) {
                var opt = new Option(nama, nama);
                if (nama === currentKel) opt.selected = true;
                kel.add(opt);
            });
        });
    }

    var form = document.getElementById('formEditSkk');
    if (form) {
        form.addEventListener('submit', function () {
            var btn = document.getElementById('btnSubmitEditSkk');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui...';
                btn.disabled = true;
            }
        });
    }
})();
</script>
@endpush
