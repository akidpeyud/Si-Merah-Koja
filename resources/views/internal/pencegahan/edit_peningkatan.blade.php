@extends('layouts.dashboard')

@section('title', 'Edit Data Peningkatan Kapasitas - SIMERAH KOJA')

@push('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
    body { background-color: #f3f4f6; color: #1f2937; }
    .navbar-internal { background-color: #111827; padding: 15px 50px; border-bottom: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 9999; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    .nav-brand { display: flex; align-items: center; gap: 15px; color: white; text-decoration: none; }
    .nav-brand img { height: 40px; }
    .nav-brand .title { font-weight: 800; font-size: 18px; letter-spacing: 1px; }
    .user-menu { display: flex; align-items: center; gap: 20px; }
    .user-profile { display: flex; align-items: center; gap: 10px; color: #e5e7eb; font-size: 14px; font-weight: 600; }
    .user-profile i { font-size: 20px; color: #9ca3af; }
    .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
    .btn-logout:hover { background-color: #dc2626; }
    .dashboard-container { display: flex; min-height: calc(100vh - 74px); }
    .sidebar { width: 320px; background-color: #ffffff; border-right: 1px solid #e5e7eb; padding: 30px 20px; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; flex-shrink: 0; }
    .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 12px 15px; color: #4b5563; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
    .sidebar-item:hover { background-color: #f3f4f6; color: #111827; }
    .sidebar-item.active { background-color: #e0f2fe; color: #0284c7; }
    .sidebar-item.active i { color: #0284c7; }
    .sidebar-item i { font-size: 16px; width: 20px; text-align: center; color: #9ca3af; }
    .sidebar-collapse-btn { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 15px 15px 5px 15px; margin-top: 10px; background: transparent; border: none; border-top: 1px dashed #e5e7eb; text-align: left; font-size: 11px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
    .sidebar-submenu { display: flex; flex-direction: column; gap: 4px; padding-left: 10px; margin-top: 8px; }
    .main-content { flex: 1; padding: 40px 50px; background-color: #f9fafb; overflow-x: hidden; }
    .form-card { background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
    .form-section-title { font-size: 14px; font-weight: 800; color: #0284c7; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px dashed #e2e8f0; }
    .form-label { font-weight: 600; font-size: 13px; color: #4b5563; }
    .form-control, .form-select { font-size: 14px; padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; }
    .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); background-color: #ffffff; }
</style>
@endpush

@section('content')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="/internal/pencegahan/peningkatan-kapasitas" class="text-decoration-none text-muted fw-bold" style="font-size: 14px;">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Data Peningkatan
                    </a>
                    <h1 class="fw-bolder text-dark mt-2 mb-0" style="font-size: 24px;">Form Edit Peningkatan Kapasitas</h1>
                </div>
            </div>

            <div class="form-card">
                <!-- FORM ACTION MENGARAH KE RUTE EDIT -->
                @php
                    // <input type="date"> hanya menerima YYYY-MM-DD; teks bebas (data lama) ditampilkan sebagai petunjuk
                    $tglInput = fn ($nilai) => preg_match('/^\d{4}-\d{2}-\d{2}/', (string) $nilai) ? substr((string) $nilai, 0, 10) : '';
                    $tglLama = fn ($nilai) => (trim((string) $nilai) !== '' && $tglInput($nilai) === '') ? trim((string) $nilai) : null;
                @endphp
                <form action="/internal/pencegahan/peningkatan-kapasitas/edit/{{ $jenis }}/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $pesanError)
                                    <li>{{ $pesanError }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- SECTION 1: DATA PEGAWAI -->
                    <div class="form-section-title"><i class="fas fa-user me-2"></i> Data Pegawai / Aparatur</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $data->nama ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" value="{{ old('nip', $data->nip ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir', $tglInput($data->tgl_lahir ?? '')) }}">
                            @if ($tglLama($data->tgl_lahir ?? ''))
                                <small class="text-muted">Data lama: {{ $tglLama($data->tgl_lahir) }}</small>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pangkat / Golongan Ruang</label>
                            <input type="text" class="form-control" name="pangkat_golongan" value="{{ old('pangkat_golongan', $data->pangkat_golongan ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan', $data->jabatan ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kualifikasi</label>
                            <input type="text" class="form-control" name="kualifikasi" value="{{ old('kualifikasi', $data->kualifikasi ?? '') }}">
                        </div>
                    </div>

                    <!-- SECTION 2: PELAKSANAAN DIKLAT -->
                    <div class="form-section-title"><i class="fas fa-calendar-check me-2"></i> Pelaksanaan Diklat ({{ strtoupper(str_replace('-', ' ', $jenis)) }})</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Tempat Pelaksanaan</label>
                            <input type="text" class="form-control" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan', $data->tempat_pelaksanaan ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', $tglInput($data->tanggal_pelaksanaan ?? '')) }}">
                            @if ($tglLama($data->tanggal_pelaksanaan ?? ''))
                                <small class="text-muted">Data lama: {{ $tglLama($data->tanggal_pelaksanaan) }}</small>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Selesai Pelaksanaan</label>
                            <input type="date" class="form-control" name="tanggal_selesai_pelaksanaan" value="{{ old('tanggal_selesai_pelaksanaan', $tglInput($data->tanggal_selesai_pelaksanaan ?? '')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jumlah Jam Pelajaran</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" name="jumlah_jam_pelajaran" value="{{ old('jumlah_jam_pelajaran', $data->jumlah_jam_pelajaran ?? '') }}">
                                <span class="input-group-text bg-white">JP</span>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: STTP & SERTIFIKAT -->
                    <div class="form-section-title"><i class="fas fa-award me-2" style="color: #f59e0b;"></i> STTP &amp; Sertifikat</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">No STTP</label>
                            <input type="text" class="form-control" name="no_sttp" value="{{ old('no_sttp', $data->no_sttp ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal STTP</label>
                            <input type="date" class="form-control" name="tanggal_sttp" value="{{ old('tanggal_sttp', $tglInput($data->tanggal_sttp ?? '')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pejabat yang Menandatangani</label>
                            <input type="text" class="form-control" name="ditandatangani_oleh" value="{{ old('ditandatangani_oleh', $data->ditandatangani_oleh ?? '') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Upload Sertifikat</label>
                            @if (! empty($data->file_sertifikat))
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $data->file_sertifikat) }}" target="_blank" rel="noopener" class="text-decoration-none">
                                        <i class="fas fa-file-alt me-1"></i> Lihat sertifikat saat ini
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-control" name="file_sertifikat" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format PDF, JPG, atau PNG. Maksimal 5 MB. Kosongkan jika tidak ingin mengganti berkas.</small>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <a href="/internal/pencegahan/peningkatan-kapasitas" class="btn btn-light border px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn text-white px-5 fw-bold" style="background-color: #0284c7;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
@endsection