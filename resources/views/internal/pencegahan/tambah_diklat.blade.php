@extends('layouts.dashboard')

@section('title', 'Tambah Data Diklat - SIMERAH KOJA')

@push('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
    body { background-color: #f3f4f6; color: #1f2937; }
    .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; }
    .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
    .nav-brand img { height: 40px; }
    .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
    .user-menu { display: flex; align-items: center; gap: 20px; }
    .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
    .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; }
    .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
    .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
    .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
    .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
    .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
    .sidebar-item.active i { color: #0284c7; }
    .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
    .sidebar-collapse-btn:hover { color: #4b5563; }
    .toggle-icon { transition: transform 0.3s ease; font-size: 12px; }
    .sidebar-collapse-btn.collapsed .toggle-icon { transform: rotate(0deg); }
    .sidebar-collapse-btn:not(.collapsed) .toggle-icon { transform: rotate(180deg); color: #0284c7; }
    .sidebar-collapse-btn:not(.collapsed) { color: #0284c7; }
    .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }
    .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }

    /* ====== TAMPILAN FORM ====== */
    .page-head { margin-bottom: 20px; }
    .page-head h1 { font-size: 26px; font-weight: 800; color: #0f172a; margin: 0; }
    .page-head p { font-size: 14px; color: #64748b; margin: 4px 0 0; }

    .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 16px; padding: 6px 12px; border-radius: 8px; background: #fff; border: 1px solid #e2e8f0; transition: all 0.2s; }
    .back-link:hover { color: #0f172a; background: #f1f5f9; }

    .form-wrapper { background: #fff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 0; box-shadow: 0 10px 25px -5px rgba(15,23,42,0.06); overflow: hidden; }
    .form-body { padding: 10px 32px 32px; }

    .form-section { margin-top: 28px; }
    .section-title { display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid #eef2f7; }
    .section-title .icon-box { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; }
    .section-title.text-primary .icon-box { background: #e0efff; color: #0d6efd; }
    .section-title.text-success .icon-box { background: #dcfce7; color: #16a34a; }
    .section-title.text-warning .icon-box { background: #fef3c7; color: #d97706; }
    .section-title.text-secondary .icon-box { background: #e2e8f0; color: #475569; }
    .section-title span.label-text { color: #0f172a !important; }

    .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 6px; }
    .form-control, .form-select { border: 1px solid #cbd5e1; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #334155; background-color: #fff; transition: all 0.2s; }
    .form-control::placeholder { color: #a0aec0; }
    .form-control:hover, .form-select:hover { border-color: #94a3b8; }
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2,132,199,0.12); outline: none; }
    .input-group-text { border-radius: 0 10px 10px 0; border: 1px solid #cbd5e1; font-size: 13px; font-weight: 700; color: #475569; }
    .input-group .form-control { border-radius: 10px 0 0 10px; }

    .form-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; }
    .btn-save { background: linear-gradient(135deg, #0d6efd, #0b5ed7); color: white; padding: 11px 26px; font-weight: 700; font-size: 14px; border-radius: 10px; border: none; box-shadow: 0 4px 10px rgba(13,110,253,0.25); transition: all 0.2s; }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(13,110,253,0.35); color: #fff; }
    .btn-cancel { background: white; color: #475569; border: 1px solid #cbd5e1; padding: 11px 26px; font-weight: 600; font-size: 14px; border-radius: 10px; transition: all 0.2s; text-decoration: none; }
    .btn-cancel:hover { background: #f1f5f9; color: #0f172a; }

    @media (max-width: 768px) {
        .main-content { padding: 20px; }
        .form-body { padding: 10px 18px 24px; }
        .form-footer { padding: 16px 18px; }
    }
</style>
@endpush

@section('content')

    <a href="javascript:history.back()" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Data Peningkatan
    </a>

    <div class="page-head">
        <h1>Form Tambah Peningkatan Kapasitas</h1>
        <p>Lengkapi data pegawai dan diklat yang diikuti di bawah ini.</p>
    </div>

    <div class="form-wrapper">
        <form action="/internal/pencegahan/peningkatan-kapasitas/tambah" method="POST">
            @csrf

            <div class="form-body">

                <!-- SECTION 1: DATA PEGAWAI -->
                <div class="form-section" style="margin-top: 20px;">
                    <div class="section-title text-primary">
                        <span class="icon-box"><i class="fas fa-user-tie"></i></span>
                        <span class="label-text">Data Pegawai / Aparatur</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIP (Opsional)</label>
                            <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh: Jambi">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" placeholder="Contoh: Danru / Anggota">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Instansi / Perangkat Daerah</label>
                            <input type="text" class="form-control" name="instansi_daerah" placeholder="Contoh: Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi">
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: DETAIL DIKLAT -->
                <div class="form-section">
                    <div class="section-title text-success">
                        <span class="icon-box"><i class="fas fa-certificate"></i></span>
                        <span class="label-text">Detail Diklat & Penyelenggara</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Jenis Diklat</label>
                            <select class="form-select" name="jenis_diklat" required>
                                <option value="" selected disabled>Pilih Jenis...</option>
                                <option value="DIKSAR">DIKSAR</option>
                                <option value="DIKLAT F1">DIKLAT F1</option>
                                <option value="DIKLAT F2">DIKLAT F2</option>
                                <option value="DIKLAT RESCUE">DIKLAT RESCUE</option>
                                <option value="DIKLAT MFR">DIKLAT MFR</option>
                                <option value="DIKLAT OPERATOR">DIKLAT OPERATOR</option>
                                <option value="DIKLAT INSPEKTUR">DIKLAT INSPEKTUR</option>
                                <option value="DIKLAT PPL">DIKLAT PPL</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Instansi Penyelenggara</label>
                            <input type="text" class="form-control" name="penyelenggara" placeholder="Contoh: PUSDIKLAT DKI Jakarta">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" placeholder="Contoh: DKI Jakarta">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota / Kabupaten</label>
                            <input type="text" class="form-control" name="kota" placeholder="Contoh: Jakarta Timur">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="text" class="form-control" name="tgl_pelaksanaan" placeholder="Contoh: 12 s/d 28 Agustus 2026">
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: SERTIFIKASI & PENILAIAN -->
                <div class="form-section">
                    <div class="section-title text-warning">
                        <span class="icon-box"><i class="fas fa-award"></i></span>
                        <span class="label-text">Sertifikasi & Penilaian</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nomor Sertifikat</label>
                            <input type="text" class="form-control" name="nomor_sertifikat" placeholder="No. 112/DIKLAT-F1/2026">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ditanda Tangani Oleh</label>
                            <input type="text" class="form-control" name="ditanda_tangani" placeholder="Contoh: Kepala Dinas / Gubernur">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jumlah Jam Pelajaran (JP)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="jumlah_jp" placeholder="0">
                                <span class="input-group-text bg-light">JP</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kode Verifikasi</label>
                            <input type="text" class="form-control" name="kode_verifikasi" placeholder="-">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Persentase Penilaian</label>
                            <input type="text" class="form-control" name="persentase_penilaian" placeholder="-">
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: KETERANGAN TAMBAHAN -->
                <div class="form-section">
                    <div class="section-title text-secondary">
                        <span class="icon-box"><i class="fas fa-list-alt"></i></span>
                        <span class="label-text">Informasi Tambahan</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Catatan Tambahan (Ket)</label>
                            <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan catatan tambahan jika ada..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL SIMPAN -->
            <div class="form-footer">
                <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Simpan Data Peningkatan</button>
            </div>

        </form>
    </div>
@endsection