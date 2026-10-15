@extends('layouts.dashboard')

@section('title', 'Buat Surat Keterangan Korban')

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
    
                --r-lg: 18px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 272px;
                --topbar-h: 70px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    .toast-wrap { position: fixed; z-index: 9999; top: 20px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); pointer-events: none; }
    .toast { display: flex; align-items: center; gap: 12px; padding: 12px 12px 12px 16px; border-radius: 999px; background: #ffffff; border: 1px solid var(--line); box-shadow: var(--shadow-lg); font-weight: 600; font-size: .92rem; animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both; pointer-events: auto; }
    @keyframes toastIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: none; } }
    @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-20px); } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
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
    .input-group-text {
                background-color: #f8fafc;
                border: 1px solid var(--line-dark);
                color: var(--steel);
                font-weight: 600;
                border-radius: 8px;
                font-size: 0.9rem;
            }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
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
                transition: all .2s ease;
                text-decoration: none;
            }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .highlight-area {
                background-color: #f8fafc;
                border: 1px solid var(--line);
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 24px;
            }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-head d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h1>Pembuatan Surat Keterangan</h1>
                <p>Formulir penerbitan Surat Keterangan Korban Kebakaran resmi Disdamkartan.</p>
            </div>
            <a href="/internal/surat-korban/data" class="btn-custom-light">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-custom">
            <div class="card-body p-4 p-md-5 pt-4">
                <form action="/internal/surat-korban/store" method="POST">
                    @csrf
                    
                    <!-- BAGIAN A: DATA DIRI -->
                    <div class="section-title-block">
                        <i class="fas fa-user"></i> Data Diri Korban
                    </div>
                    
                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="nama_korban" class="form-control" placeholder="Cth: MAHILLI" required>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-home"></i> Status Kepemilikan</label>
                            <input type="text" name="status_kepemilikan" class="form-control" placeholder="Cth: Pemilik Bangunan" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-id-card"></i> NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" name="nik" class="form-control" placeholder="Cth: 1571023112590461" required>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" placeholder="Cth: Pensiunan" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Cth: Lubuk Resam" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-calendar-alt"></i> Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="field-label"><i class="fas fa-ring"></i> Status Perkawinan</label>
                            <select class="form-select" name="status_perkawinan" required>
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="Kawin Tercatat">Kawin Tercatat</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="field-label"><i class="fas fa-map-signs"></i> Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required placeholder="Jl. HM. Yusuf Nasri RT. 07 Kel. Wijaya Pura Kec. Jambi Selatan..."></textarea>
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
                                <input type="text" name="objek_terbakar" class="form-control" placeholder="Cth: Bangunan / Rumah Tinggal" required>
                            </div>
                            
                            <!-- HARI OTOMATIS BERDASARKAN TANGGAL -->
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar-day"></i> Hari Kejadian</label>
                                <input type="text" class="form-control" id="hari_kejadian" name="hari_kejadian" placeholder="Otomatis terisi..." readonly style="background-color: #e2e8f0; font-weight: 600; cursor: not-allowed;" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-calendar"></i> Tanggal Kejadian</label>
                                <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="field-label"><i class="fas fa-clock"></i> Waktu Kejadian (WIB)</label>
                                <input type="time" name="waktu_kejadian" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Camat</label>
                            <input type="text" name="tembusan_camat" class="form-control" placeholder="Cth: Jambi Selatan">
                        </div>
                        <div class="col-md-6">
                            <label class="field-label"><i class="fas fa-user-tie"></i> Tembusan Lurah</label>
                            <input type="text" name="tembusan_lurah" class="form-control" placeholder="Cth: Wijaya Pura">
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                        <button type="reset" class="btn-custom-light me-3">Reset Form</button>
                        <button type="submit" class="btn-custom-primary shadow-sm">
                            <i class="fas fa-file-pdf me-2"></i> Simpan & Buat Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>

<!-- ==================== SCRIPTS ==================== -->
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- FUNGSI AUTO HARI KEJADIAN ---------- */
    const inputTanggal = document.getElementById('tanggal_kejadian');
    const inputHari = document.getElementById('hari_kejadian');

    if(inputTanggal && inputHari) {
        inputTanggal.addEventListener('change', function() {
            if(this.value) {
                const date = new Date(this.value);
                const namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const hari = namaHari[date.getDay()];
                inputHari.value = hari;
            } else {
                inputHari.value = '';
            }
        });
    }
})();
</script>
@endpush
