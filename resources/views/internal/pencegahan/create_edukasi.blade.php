@extends('layouts.dashboard')

@section('title', 'Tambah Data Edukasi Offline')

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
        font-size: 0.9rem;
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

    /* Peserta Box Grid */
    .peserta-box {
        background: #f8fafc;
        border: 1px solid var(--line-dark);
        border-radius: 8px;
        padding: 12px;
        text-align: center;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .peserta-box:focus-within {
        border-color: var(--navy);
        background: #ffffff;
        box-shadow: 0 0 0 3px var(--navy-soft);
    }
    .peserta-label {
        font-size: 0.76rem;
        font-weight: 700;
        color: var(--steel);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 6px;
        display: block;
    }
    .peserta-sub {
        font-size: 0.72rem;
        color: var(--steel-soft);
        margin-top: 4px;
        display: block;
    }
    .peserta-box input {
        text-align: center;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--ink);
        height: 38px;
        min-height: 38px;
    }

    /* Upload Box */
    .file-input-wrapper {
        background: #f8fafc;
        border: 1.5px dashed var(--line-dark);
        border-radius: 8px;
        padding: 16px;
        transition: all 0.2s ease;
    }
    .file-input-wrapper:hover {
        border-color: var(--navy);
        background: #f1f5f9;
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
</style>
@endpush

@section('content')

    <!-- Header Section -->
    <div class="page-header-box mx-auto" style="max-width: 920px;">
        <div>
            <h1>Tambah Data Kunjungan Edukasi</h1>
            <p>Input pengajuan layanan edukasi & sosialisasi secara offline dari masyarakat atau instansi.</p>
        </div>
        <div>
            <a href="{{ url('/internal/pencegahan/kelola-edukasi') }}" class="btn-cancel-main">
                <i class="fas fa-arrow-left"></i> Kembali ke Kelola Edukasi
            </a>
        </div>
    </div>

    <div class="form-panel mx-auto" style="max-width: 920px;">
        <div class="panel-header">
            <div class="panel-title">
                <span class="panel-title-icon"><i class="fas fa-school"></i></span>
                Formulir Pendaftaran Edukasi Offline
            </div>
            <span class="badge bg-light text-secondary border">Input Baru</span>
        </div>

        <div class="panel-body">

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-4 rounded-3 shadow-xs">
                    <i class="fas fa-circle-exclamation flex-shrink-0"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

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

            <form action="{{ route('edukasi.offline.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- BAGIAN 1: DATA INSTITUSI -->
                <div class="form-section-title">
                    <i class="fas fa-building-columns me-1"></i> Data Institusi & Wilayah
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="institusiInput">
                            <span>Nama Institusi (Sekolah / Lembaga / Instansi)</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <input type="text" id="institusiInput" name="institusi" class="form-control" placeholder="Contoh: TK Dharma Wanita Kota Jambi" value="{{ old('institusi') }}" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="alamatInstitusiInput">
                            <span>Alamat Lengkap Institusi</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <textarea id="alamatInstitusiInput" name="alamat_institusi" class="form-control" rows="2" placeholder="Masukkan alamat lengkap, nama jalan, nomor, atau RT/RW..." required>{{ old('alamat_institusi') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="kecamatan">
                            <span>Kecamatan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-location-dot"></i></span>
                            <select name="kecamatan" id="kecamatan" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                <option value="Alam Barajo" {{ old('kecamatan') == 'Alam Barajo' ? 'selected' : '' }}>Alam Barajo</option>
                                <option value="Danau Sipin" {{ old('kecamatan') == 'Danau Sipin' ? 'selected' : '' }}>Danau Sipin</option>
                                <option value="Danau Teluk" {{ old('kecamatan') == 'Danau Teluk' ? 'selected' : '' }}>Danau Teluk</option>
                                <option value="Jambi Selatan" {{ old('kecamatan') == 'Jambi Selatan' ? 'selected' : '' }}>Jambi Selatan</option>
                                <option value="Jambi Timur" {{ old('kecamatan') == 'Jambi Timur' ? 'selected' : '' }}>Jambi Timur</option>
                                <option value="Jelutung" {{ old('kecamatan') == 'Jelutung' ? 'selected' : '' }}>Jelutung</option>
                                <option value="Kota Baru" {{ old('kecamatan') == 'Kota Baru' ? 'selected' : '' }}>Kota Baru</option>
                                <option value="Paal Merah" {{ old('kecamatan') == 'Paal Merah' ? 'selected' : '' }}>Paal Merah</option>
                                <option value="Pasar Jambi" {{ old('kecamatan') == 'Pasar Jambi' ? 'selected' : '' }}>Pasar Jambi</option>
                                <option value="Pelayangan" {{ old('kecamatan') == 'Pelayangan' ? 'selected' : '' }}>Pelayangan</option>
                                <option value="Telanaipura" {{ old('kecamatan') == 'Telanaipura' ? 'selected' : '' }}>Telanaipura</option>
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
                                <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: DATA PENANGGUNG JAWAB -->
                <div class="form-section-title">
                    <i class="fas fa-user-shield me-1"></i> Data Penanggung Jawab
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="namaPemohonInput">
                            <span>Nama Lengkap Penanggung Jawab</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="namaPemohonInput" name="nama_pemohon" class="form-control" placeholder="Contoh: Budi Santoso, S.Pd" value="{{ old('nama_pemohon') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="jabatanPemohonInput">
                            <span>Jabatan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                            <input type="text" id="jabatanPemohonInput" name="jabatan_pemohon" class="form-control" placeholder="Contoh: Kepala Sekolah / Guru / Panitia" value="{{ old('jabatan_pemohon') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="nikInput">
                            <span>NIK KTP (16 Digit)</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" id="nikInput" name="nik" class="form-control" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="150xxxxxxxxxxxxx" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="noKontakInput">
                            <span>No. Telepon / WhatsApp (Maks 13 Digit)</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                            <input type="tel" id="noKontakInput" name="no_kontak" class="form-control" placeholder="08xxxxxxxxxx" maxlength="13" value="{{ old('no_kontak') }}" required>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 3: RINCIAN KEGIATAN & ESTIMASI PESERTA -->
                <div class="form-section-title">
                    <i class="fas fa-calendar-check me-1"></i> Rincian Kegiatan & Peserta
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="tglKegiatanInput">
                            <span>Rencana Tanggal Pelaksanaan</span>
                            <span class="label-badge badge-req">Wajib</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-days"></i></span>
                            <input type="date" id="tglKegiatanInput" name="tgl_kegiatan" class="form-control" value="{{ old('tgl_kegiatan') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        <div class="p-2 px-3 bg-light border rounded-3 w-100 d-flex align-items-center justify-content-between">
                            <span class="small text-muted"><i class="fas fa-users text-primary me-1"></i> Total Estimasi:</span>
                            <strong class="fs-6 text-dark" id="totalPesertaDisplay">0 Peserta</strong>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <label class="form-label mb-2">
                            <span>Jumlah Peserta Berdasarkan Kelompok Usia:</span>
                        </label>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="peserta-box">
                                    <span class="peserta-label">Usia 3 - 6 Thn</span>
                                    <input type="number" name="usia_3_6" class="form-control input-peserta" min="0" value="{{ old('usia_3_6', 0) }}">
                                    <span class="peserta-sub">PAUD / TK</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="peserta-box">
                                    <span class="peserta-label">Usia 7 - 12 Thn</span>
                                    <input type="number" name="usia_7_12" class="form-control input-peserta" min="0" value="{{ old('usia_7_12', 0) }}">
                                    <span class="peserta-sub">SD / Sederajat</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="peserta-box">
                                    <span class="peserta-label">Usia 13 - 18 Thn</span>
                                    <input type="number" name="usia_13_18" class="form-control input-peserta" min="0" value="{{ old('usia_13_18', 0) }}">
                                    <span class="peserta-sub">SMP / SMA</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="peserta-box">
                                    <span class="peserta-label">> 18 Tahun</span>
                                    <input type="number" name="usia_18_keatas" class="form-control input-peserta" min="0" value="{{ old('usia_18_keatas', 0) }}">
                                    <span class="peserta-sub">Dewasa / Umum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 4: UNGGAH BERKAS -->
                <div class="form-section-title">
                    <i class="fas fa-paperclip me-1"></i> Unggah Berkas Dokumen (Opsional)
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="file-input-wrapper h-100">
                            <label class="form-label" for="suratPermohonanInput">
                                <span><i class="fas fa-file-pdf text-danger me-1"></i> Surat Permohonan</span>
                                <span class="label-badge badge-opt">Opsional</span>
                            </label>
                            <input type="file" id="suratPermohonanInput" name="surat_permohonan" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted d-block mt-2" style="font-size: 0.76rem;">Format: PDF, JPG, atau PNG (Maks 5 MB)</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="file-input-wrapper h-100">
                            <label class="form-label" for="syaratLainnyaInput">
                                <span><i class="fas fa-folder-open text-primary me-1"></i> Persyaratan Lainnya</span>
                                <span class="label-badge badge-opt">Opsional</span>
                            </label>
                            <input type="file" id="syaratLainnyaInput" name="syarat_lainnya[]" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar" multiple>
                            <small class="text-muted d-block mt-2" style="font-size: 0.76rem;">Bisa pilih beberapa file sekaligus atau arsip ZIP/RAR (Maks 10 MB)</small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-4 border-top">
                    <a href="{{ url('/internal/pencegahan/kelola-edukasi') }}" class="btn-cancel-main">
                        Batal
                    </a>
                    <button type="submit" class="btn-submit-main" id="btnSubmitEdukasi">
                        <i class="fas fa-floppy-disk"></i> Simpan Data Offline
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Loading State Submit ---------- */
    var form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function () {
            var btn = document.getElementById('btnSubmitEdukasi');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan Data...';
                btn.disabled = true;
            }
        });
    }

    /* ---------- Kelurahan mengikuti Kecamatan ---------- */
    var dataWilayah = {
        'Alam Barajo': ['Bagan Pete', 'Beliung', 'Kenali Besar', 'Mayang Mangurai', 'Pinang Merah', 'Rawa Sari', 'Simpang Rimbo'],
        'Danau Sipin': ['Legok', 'Murni', 'Selamat', 'Solok Sipin', 'Sungai Putri'],
        'Danau Teluk': ['Olak Kemang', 'Pasir Panjang', 'Tanjung Pasir', 'Tanjung Raden', 'Ulu Gedong'],
        'Jambi Selatan': ['Pakuan Baru', 'Pasir Putih', 'Tambak Sari', 'The Hok', 'Wijaya Pura'],
        'Jambi Timur': ['Budiman', 'Kasang', 'Kasang Jaya', 'Rajawali', 'Sejinjang', 'Sulanjana', 'Talang Banjar', 'Tanjung Pinang', 'Tanjung Sari'],
        'Jelutung': ['Cempaka Putih', 'Handil Jaya', 'Jelutung', 'Kebun Handil', 'Lebak Bandung', 'Payo Lebar', 'Talang Jauh'],
        'Kota Baru': ['Kenali Asam', 'Kenali Asam Atas', 'Kenali Asam Bawah', 'Paal Lima', 'Simpang Tiga Sipin', 'Sukakarya', 'Talang Gulo'],
        'Paal Merah': ['Bakung Jaya', 'Eka Jaya', 'Lingkar Selatan', 'Paal Merah', 'Payo Selincah', 'Talang Bakung'],
        'Pasar Jambi': ['Beringin', 'Orang Kayo Hitam', 'Pasar Jambi', 'Sungai Asam'],
        'Pelayangan': ['Arab Melayu', 'Jelmu', 'Mudung Laut', 'Tahtul Yaman', 'Tanjung Johor', 'Tengah'],
        'Telanaipura': ['Aur Kenali', 'Buluran Kenali', 'Pematang Sulur', 'Penyengat Rendah', 'Simpang Empat Sipin', 'Telanaipura', 'Teluk Kenali']
    };

    var kec = document.getElementById('kecamatan');
    var kel = document.getElementById('kelurahan');
    var oldKel = "{{ old('kelurahan') }}";

    function updateKelurahan() {
        kel.innerHTML = '';
        var ph = new Option('-- Pilih Kelurahan --', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        if (kec.value && dataWilayah[kec.value]) {
            dataWilayah[kec.value].forEach(function (nama) {
                var opt = new Option(nama, nama);
                if (nama === oldKel) opt.selected = true;
                kel.add(opt);
            });
        }
    }

    if (kec) {
        kec.addEventListener('change', updateKelurahan);
        if (kec.value) {
            updateKelurahan();
        }
    }

    /* ---------- Hitung Total Peserta Otomatis ---------- */
    var pesertaInputs = document.querySelectorAll('.input-peserta');
    var totalDisplay = document.getElementById('totalPesertaDisplay');

    function calculateTotalPeserta() {
        var total = 0;
        pesertaInputs.forEach(function (inp) {
            var val = parseInt(inp.value, 10);
            if (!isNaN(val) && val > 0) {
                total += val;
            }
        });
        if (totalDisplay) {
            totalDisplay.textContent = total.toLocaleString('id-ID') + ' Peserta';
        }
    }

    pesertaInputs.forEach(function (inp) {
        inp.addEventListener('input', calculateTotalPeserta);
    });
    calculateTotalPeserta();

})();
</script>
@endpush
