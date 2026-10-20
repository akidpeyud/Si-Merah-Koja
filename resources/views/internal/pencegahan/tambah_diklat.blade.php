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
    .form-wrapper {
                background-color: #ffffff;
                border-radius: 12px;
                border: 1px solid #e2e8f0;
                padding: 30px;
                margin-top: 20px;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            }
    .back-link { color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 15px; transition: color 0.2s; }
    .back-link:hover { color: #0f172a; }
    .form-label { font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 8px; }
    .form-control, .form-select { border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 15px; font-size: 14px; color: #334155; }
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
    .section-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 15px; margin-top: 20px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 8px; }
    .section-title.first { margin-top: 0; }
    .btn-save { background-color: #0d6efd; color: white; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; border: none; transition: background-color 0.2s; }
    .btn-save:hover { background-color: #0b5ed7; }
    .btn-cancel { background-color: white; color: #475569; border: 1px solid #cbd5e1; padding: 10px 24px; font-weight: 600; font-size: 14px; border-radius: 6px; transition: all 0.2s; }
    .btn-cancel:hover { background-color: #f1f5f9; color: #0f172a; }
</style>
@endpush

@section('content')
@section('content')

            <a href="javascript:history.back()" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Data Peningkatan
            </a>

            <h1 class="fw-bolder text-dark mb-0" style="font-size: 24px;">Form Tambah Peningkatan Kapasitas</h1>

            <div class="form-wrapper">
                <form action="/internal/pencegahan/peningkatan-kapasitas/tambah" method="POST">
                  @csrf
                    <!-- SECTION 1: DATA PEGAWAI -->
                    <div class="section-title text-primary first"><i class="fas fa-user-tie"></i> Data Pegawai / Aparatur</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIP (Opsional)</label>
                            <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" name="nik" placeholder="Masukkan 16 digit NIK" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh: Jambi">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" placeholder="Contoh: Danru / Anggota">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Instansi / Perangkat Daerah</label>
                            <input type="text" class="form-control" name="instansi_daerah" placeholder="Contoh: Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi">
                        </div>
                    </div>

                    <!-- SECTION 2: DETAIL DIKLAT -->
                    <div class="section-title text-success"><i class="fas fa-certificate"></i> Detail Diklat & Penyelenggara</div>
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

                    <!-- SECTION 3: SERTIFIKASI & PENILAIAN -->
                    <div class="section-title text-warning"><i class="fas fa-award"></i> Sertifikasi & Penilaian</div>
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
                            <label class="form-label">Persentasi Penilaian</label>
                            <input type="text" class="form-control" name="persentase_penilaian" placeholder="-">
                        </div>
                    </div>

                    <!-- SECTION 4: KETERANGAN TAMBAHAN -->
                    <div class="section-title text-secondary"><i class="fas fa-list-alt"></i> Informasi Tambahan</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Catatan Tambahan (Ket)</label>
                            <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan catatan tambahan jika ada..."></textarea>
                        </div>
                    </div>

                    <!-- TOMBOL SIMPAN -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
                        <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i> Simpan Data Peningkatan</button>
                    </div>

                </form>
            </div>
@endsection
