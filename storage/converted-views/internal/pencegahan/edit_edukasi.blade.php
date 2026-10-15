@extends('layouts.dashboard')

@section('title', 'Edit Data Edukasi Offline')

@push('styles')
<style>
    .topbar {
        position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 0 28px; background: var(--ink);
        border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
    }
    .brand span { font-family: var(--font-display); font-weight: 700; font-size: 1.08rem; letter-spacing: -.01em; white-space: nowrap; color: #fff; }
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .84rem; font-weight: 700; color: #fff; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
    .sidebar {
        width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
        height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden;
        background: #fff; border-right: 1px solid var(--line); padding: 20px 14px 32px;
    }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary { list-style: none; cursor: pointer; display: flex; align-items: flex-start; gap: 12px; padding: 11px 14px; border-radius: var(--r-sm); font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--navy); user-select: none; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    @media (max-width: 900px) {
        .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s; box-shadow: var(--shadow-lg); }
    }
    .page-head { margin-bottom: 26px; }
    .page-head-title h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-title p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 32px; box-shadow: var(--shadow-xs); }
    .form-label { font-weight: 600; color: var(--ink-2); font-size: .88rem; margin-bottom: 8px; }
    .form-control, .form-select { border-radius: 8px; border-color: var(--line-dark); min-height: 44px; font-size: .9rem; color: var(--ink); }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .section-header { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; border-bottom: 2px solid var(--line); padding-bottom: 8px; margin-bottom: 20px; margin-top: 30px; }
    .btn-primary-custom { display: inline-flex; align-items: center; gap: 8px; background: var(--navy); color: #fff; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; transition: 0.2s; }
    .btn-primary-custom:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-outline-custom { display: inline-flex; align-items: center; justify-content: center; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: .95rem; transition: 0.2s; text-decoration: none; }
    .btn-outline-custom:hover { background: var(--paper); color: var(--ink); }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { padding: 0 14px; gap: 10px; }
        .brand { gap: 9px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .topbar-right { gap: 7px; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .user-avatar { width: 34px; height: 34px; }
        .btn-logout { width: 38px; height: 38px; padding: 0; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 16px 50px; }
        .page-head-title h1 { font-size: 1.55rem; }
    }
</style>
@endpush

@section('content')
@section('content')

        <!-- Kontainer pembungkus utama agar semuanya sejajar dan rapi -->
        <div class="mx-auto" style="max-width: 900px;">
            
            <!-- TOMBOL KEMBALI -->
            <div class="mb-4">
                <a href="/internal/pencegahan/kelola-edukasi" class="btn-outline-custom" style="padding: 8px 18px; font-size: 0.88rem;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Kelola Edukasi
                </a>
            </div>

            <div class="page-head">
                <div class="page-head-title">
                    <h1>Edit Data Kunjungan Edukasi</h1>
                    <p>Perbarui informasi pengajuan layanan edukasi secara offline dari masyarakat atau instansi.</p>
                </div>
            </div>

            <div class="content-card">
                
                @if(session('error'))
                    <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem;">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('edukasi.offline.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="section-header mt-0">Data Institusi</div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Institusi (Sekolah/Kampus/Instansi) <span class="text-danger">*</span></label>
                            <input type="text" name="institusi" class="form-control" placeholder="Contoh: TK Dharma Wanita" value="{{ old('institusi', $edukasi->institusi) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat Lengkap Institusi <span class="text-danger">*</span></label>
                            <textarea name="alamat_institusi" class="form-control" rows="3" required>{{ old('alamat_institusi', $edukasi->alamat_institusi) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select name="kecamatan" id="kecamatan" class="form-select" required>
                                <option value="" disabled>Pilih kecamatan</option>
                                <option value="Alam Barajo" {{ old('kecamatan', $edukasi->kecamatan) == 'Alam Barajo' ? 'selected' : '' }}>Alam Barajo</option>
                                <option value="Danau Sipin" {{ old('kecamatan', $edukasi->kecamatan) == 'Danau Sipin' ? 'selected' : '' }}>Danau Sipin</option>
                                <option value="Danau Teluk" {{ old('kecamatan', $edukasi->kecamatan) == 'Danau Teluk' ? 'selected' : '' }}>Danau Teluk</option>
                                <option value="Jambi Selatan" {{ old('kecamatan', $edukasi->kecamatan) == 'Jambi Selatan' ? 'selected' : '' }}>Jambi Selatan</option>
                                <option value="Jambi Timur" {{ old('kecamatan', $edukasi->kecamatan) == 'Jambi Timur' ? 'selected' : '' }}>Jambi Timur</option>
                                <option value="Jelutung" {{ old('kecamatan', $edukasi->kecamatan) == 'Jelutung' ? 'selected' : '' }}>Jelutung</option>
                                <option value="Kota Baru" {{ old('kecamatan', $edukasi->kecamatan) == 'Kota Baru' ? 'selected' : '' }}>Kota Baru</option>
                                <option value="Paal Merah" {{ old('kecamatan', $edukasi->kecamatan) == 'Paal Merah' ? 'selected' : '' }}>Paal Merah</option>
                                <option value="Pasar Jambi" {{ old('kecamatan', $edukasi->kecamatan) == 'Pasar Jambi' ? 'selected' : '' }}>Pasar Jambi</option>
                                <option value="Pelayangan" {{ old('kecamatan', $edukasi->kecamatan) == 'Pelayangan' ? 'selected' : '' }}>Pelayangan</option>
                                <option value="Telanaipura" {{ old('kecamatan', $edukasi->kecamatan) == 'Telanaipura' ? 'selected' : '' }}>Telanaipura</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <select name="kelurahan" id="kelurahan" class="form-select" required>
                                <option value="" disabled selected>Pilih kecamatan terlebih dahulu</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-header">Data Penanggung Jawab</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pemohon" class="form-control" placeholder="Contoh: Budi Santoso" value="{{ old('nama_pemohon', $edukasi->nama_pemohon) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan_pemohon" class="form-control" placeholder="Kepala Sekolah / Panitia" value="{{ old('jabatan_pemohon', $edukasi->jabatan_pemohon) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK KTP <span class="text-danger">*</span></label>
                            <input type="text" name="nik" class="form-control" value="{{ old('nik', $edukasi->nik) }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="16 Digit" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="no_kontak" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_kontak', $edukasi->no_kontak) }}" required>
                        </div>
                    </div>

                    <div class="section-header">Rincian Kegiatan</div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Rencana Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kegiatan" class="form-control" style="max-width: 250px;" value="{{ old('tgl_kegiatan', $edukasi->tgl_kegiatan) }}" required>
                        </div>
                        <div class="col-12"><label class="form-label mb-0">Jumlah & Perkiraan Usia Peserta</label></div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Usia 3 - 6 Tahun</small>
                            <input type="number" name="usia_3_6" class="form-control text-center" min="0" value="{{ old('usia_3_6', $edukasi->usia_3_6) }}">
                        </div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Usia 7 - 12 Tahun</small>
                            <input type="number" name="usia_7_12" class="form-control text-center" min="0" value="{{ old('usia_7_12', $edukasi->usia_7_12) }}">
                        </div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Usia 13 - 18 Tahun</small>
                            <input type="number" name="usia_13_18" class="form-control text-center" min="0" value="{{ old('usia_13_18', $edukasi->usia_13_18) }}">
                        </div>
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block mb-1 text-center">Diatas 18 Tahun</small>
                            <input type="number" name="usia_18_keatas" class="form-control text-center" min="0" value="{{ old('usia_18_keatas', $edukasi->usia_18_keatas) }}">
                        </div>
                    </div>

                    <!-- ==============================================
                         PERBAIKAN LOGIKA TOMBOL LAMPIRAN DENGAN ALERT 
                         ============================================== -->
                    <div class="section-header">Unggah Berkas (Biarkan kosong jika tidak diubah)</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Surat Permohonan Bermaterai (PDF/JPG/PNG)</label>
                            @if($edukasi->surat_permohonan)
                                <div class="mb-2">
                                    @if($edukasi->surat_permohonan == 'Tidak dilampirkan (Offline)')
                                        <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Surat Permohonan.');" class="badge bg-primary text-decoration-none py-2 px-3">
                                            <i class="fas fa-file-alt"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $edukasi->surat_permohonan) }}" target="_blank" class="badge bg-primary text-decoration-none py-2 px-3">
                                            <i class="fas fa-file-alt"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <input type="file" name="surat_permohonan" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Persyaratan Lainnya</label>
                            @if($edukasi->syarat_lainnya && $edukasi->syarat_lainnya != 'null' && $edukasi->syarat_lainnya != '[]')
                                <div class="mb-2">
                                    @php
                                        // Cek apakah data string array (JSON) atau path biasa
                                        $syaratLain = is_string($edukasi->syarat_lainnya) && str_starts_with($edukasi->syarat_lainnya, '[') 
                                            ? json_decode($edukasi->syarat_lainnya, true) 
                                            : $edukasi->syarat_lainnya;
                                            
                                        $linkSyarat = is_array($syaratLain) && isset($syaratLain[0]) ? $syaratLain[0] : (is_string($syaratLain) ? $syaratLain : null);
                                    @endphp
                                    
                                    @if(!$linkSyarat || $linkSyarat == 'Tidak dilampirkan (Offline)')
                                        <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Persyaratan Lainnya.');" class="badge bg-secondary text-decoration-none py-2 px-3">
                                            <i class="fas fa-folder-open"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $linkSyarat) }}" target="_blank" class="badge bg-secondary text-decoration-none py-2 px-3">
                                            <i class="fas fa-folder-open"></i> Lihat Dokumen Saat Ini
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <input type="file" name="syarat_lainnya[]" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar" multiple>
                            <small class="text-muted">Gunakan ZIP/RAR jika lebih dari 1 file tambahan</small>
                        </div>
                    </div>

                    <hr style="margin-top: 40px; border-color: var(--line-dark);">
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Perbarui Data</button>
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
    document.querySelector('form').addEventListener('submit', function(e) {
        var btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui...';
        btn.classList.add('disabled');
    });

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
    
    // Inject old value atau value dari database saat ini
    var oldKel = "{{ old('kelurahan', $edukasi->kelurahan) }}";

    function updateKelurahan() {
        kel.innerHTML = '';
        var ph = new Option('Pilih kelurahan', '', true, true);
        ph.disabled = true;
        kel.add(ph);
        if(kec.value && dataWilayah[kec.value]) {
            dataWilayah[kec.value].forEach(function (nama) {
                var opt = new Option(nama, nama);
                if (nama === oldKel) opt.selected = true;
                kel.add(opt);
            });
        }
    }

    kec.addEventListener('change', updateKelurahan);
    
    // Inisialisasi awal saat halaman di-load
    if (kec.value) {
        updateKelurahan();
    }
})();
</script>
@endpush
