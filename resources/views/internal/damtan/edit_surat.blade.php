@extends('layouts.dashboard')

@section('title', 'Edit Surat Korban')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --ink-2: #132a43;
                --ink-3: #1d3856;
    
                --navy: #163a63;
                --navy-dark: #0d2947;
                --navy-light: #eaf1f8;
                --navy-soft: rgba(22, 58, 99, .08);
    
                --paper: #f5f7fa;
                --white: #ffffff;
    
                --signal: #dc3545;
                --signal-dark: #b42332;
                --signal-soft: rgba(220, 53, 69, .09);
    
                --amber: #f4b740;
                --success: #198754;
                --info: #2563eb;
                --info-soft: rgba(37, 99, 235, .09);
    
                --steel: #64748b;
                --steel-soft: #94a3b8;
    
                --line: #e2e8f0;
                --line-dark: #cbd5e1;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 20px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 272px;
                --topbar-h: 70px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    #globalSuccessAlert, #globalErrorAlert {
                position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
                color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999;
                display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px;
                animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }

    @media (max-width: 900px) {
        .topbar { padding: 0 16px; }
        .sidebar { position: fixed; z-index: 1010; top: var(--topbar-h); left: 0; height: calc(100dvh - var(--topbar-h)); transform: translateX(-100%); transition: transform .3s ease; box-shadow: var(--shadow-lg); }
        body.side-open .sidebar { transform: none; }
        .sidebar-backdrop { display: block; position: fixed; inset: var(--topbar-h) 0 0 0; z-index: 1000; background: rgba(13,27,42,.45); opacity: 0; pointer-events: none; transition: opacity .3s; }
        body.side-open .sidebar-backdrop { opacity: 1; pointer-events: auto; }
    }
    .page-head { margin-bottom: 26px; }
    .card-custom {
                background: #ffffff;
                border: 1px solid var(--line);
                border-radius: var(--r-md);
                box-shadow: var(--shadow-xs);
                transition: box-shadow .2s ease, border-color .2s ease;
            }
    .card-custom:hover {
                box-shadow: var(--shadow-sm);
                border-color: #d2dae5;
            }
    .section-title-block {
                display: flex; align-items: center; gap: 12px;
                background: var(--navy-soft);
                padding: 14px 20px;
                border-radius: 8px;
                border-left: 4px solid var(--navy);
                font-family: var(--font-display);
                font-size: 1.05rem; font-weight: 700; color: var(--navy-dark);
                margin-bottom: 24px;
            }
    .section-title-block i { font-size: 1.1rem; color: var(--navy); }
    .field-label { font-size: .84rem; font-weight: 700; color: var(--ink-2); margin-bottom: 6px; display: inline-flex; align-items: center; }
    .field-label i { margin-right: 8px; font-size: .85rem; color: var(--steel-soft); }
    .form-control, .form-select {
                font-family: var(--font-body);
                min-height: 42px;
                font-size: .9rem;
                color: var(--ink);
                background-color: var(--white);
                border: 1px solid var(--line-dark);
                border-radius: 8px;
                padding: 8px 14px;
                transition: all 0.2s ease;
                box-shadow: none;
            }
    .form-control:focus, .form-select:focus {
                border-color: var(--navy);
                box-shadow: 0 0 0 3px var(--navy-soft);
            }
    .form-control::placeholder { color: var(--steel-soft); }
    .highlight-area {
                background-color: #f8fafc;
                border: 1px solid var(--line);
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 24px;
            }
    .btn-custom-primary {
                display: inline-flex; align-items: center; justify-content: center; gap: 8px;
                min-height: 44px; padding: 0 24px;
                background: var(--navy); color: #fff;
                border: none; border-radius: 8px;
                font-size: .92rem; font-weight: 600;
                transition: all .2s ease;
            }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff;}
    .btn-custom-primary:active { transform: translateY(0); }
    .btn-custom-light {
                display: inline-flex; align-items: center; justify-content: center; gap: 8px;
                min-height: 44px; padding: 0 24px;
                background: var(--white); color: var(--ink);
                border: 1px solid var(--line-dark); border-radius: 8px;
                font-size: .92rem; font-weight: 600;
                transition: all .2s ease; text-decoration: none;
            }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head">
            <h1>Edit Surat Keterangan</h1>
            <p>Perbarui informasi Surat Keterangan Korban Kebakaran Nomor: <strong>{{ $surat->nomor_surat }}</strong></p>
        </div>

        <div class="card-custom">
            <div class="card-body p-4 p-md-5 pt-4">
                <form action="/internal/surat-korban/update/{{ $surat->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- BAGIAN A: DATA DIRI -->
                    <div class="section-title-block">
                        <i class="fas fa-user"></i> Data Diri Korban
                    </div>
                    
                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="nama_korban" class="form-control" value="{{ $surat->nama_korban }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-home"></i> Status Kepemilikan</label>
                            <input type="text" name="status_kepemilikan" class="form-control" value="{{ $surat->status_kepemilikan }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-id-card"></i> NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" name="nik" class="form-control" value="{{ $surat->nik }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" value="{{ $surat->pekerjaan }}" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-calendar-alt"></i> Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $surat->tanggal_lahir }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-ring"></i> Status Perkawinan</label>
                            <select class="form-select" name="status_perkawinan" required>
                                <option value="" disabled>-- Pilih --</option>
                                <option value="Kawin Tercatat" {{ $surat->status_perkawinan == 'Kawin Tercatat' ? 'selected' : '' }}>Kawin Tercatat</option>
                                <option value="Belum Kawin" {{ $surat->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Cerai Hidup" {{ $surat->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ $surat->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ $surat->alamat }}</textarea>
                        </div>
                    </div>

                    <!-- BAGIAN B: DETAIL KEJADIAN -->
                    <div class="section-title-block">
                        <i class="fas fa-file-signature"></i> Detail Kejadian & Surat
                    </div>
                    
                    <div class="highlight-area">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="field-label"><i class="fas fa-fire"></i> Objek Terbakar</label>
                                <input type="text" name="objek_terbakar" class="form-control" value="{{ $surat->objek_terbakar }}" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar-day"></i> Hari Kejadian</label>
                                <select class="form-select" name="hari_kejadian" required>
                                    <option value="" disabled>-- Pilih Hari --</option>
                                    <option value="Senin" {{ $surat->hari_kejadian == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $surat->hari_kejadian == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ $surat->hari_kejadian == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $surat->hari_kejadian == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $surat->hari_kejadian == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ $surat->hari_kejadian == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ $surat->hari_kejadian == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar"></i> Tanggal Kejadian</label>
                                <input type="date" name="tanggal_kejadian" class="form-control" value="{{ $surat->tanggal_kejadian }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-clock"></i> Waktu Kejadian (WIB)</label>
                                <input type="time" name="waktu_kejadian" class="form-control" value="{{ $surat->waktu_kejadian }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Camat</label>
                            <input type="text" name="tembusan_camat" class="form-control" value="{{ $surat->tembusan_camat }}">
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Lurah</label>
                            <input type="text" name="tembusan_lurah" class="form-control" value="{{ $surat->tembusan_lurah }}">
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                        <a href="/internal/surat-korban/data" class="btn-custom-light me-3">Batal</a>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

<!-- ==================== SCRIPTS ==================== -->
@endsection
