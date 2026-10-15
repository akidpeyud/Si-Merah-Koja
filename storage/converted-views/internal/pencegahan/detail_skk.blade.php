@extends('layouts.dashboard')

@section('title')Detail {{ $jenis_layanan }}@endsection

@push('styles')
<style>
    :root {
                --ink: #0d1b2a;
                --ink-2: #132a43;
                --ink-3: #1d3856;
                --paper: #f7f9fc;
                --white: #ffffff;
    
                --navy: #1e3a5f;
                --navy-d: #14283f;
                --navy-tint: rgba(30, 58, 95, .09);
    
                --signal: #e5392d;
                --signal-d: #c22b20;
                --signal-tint: rgba(229, 57, 45, .09);
    
                --amber: #ffb627;
                --success: #10b981;
                --info: #2f6fed;
                --info-tint: rgba(47, 111, 237, .09);
                --ink-tint: rgba(13, 27, 42, .055);
    
                --steel: #64748b;
                --steel-soft: #94a3b8;
                --line: #e6eaf1;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 20px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 288px; 
                --topbar-h: 70px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .05);
                --shadow-sm: 0 2px 8px -2px rgba(13, 27, 42, .08);
                --shadow-md: 0 12px 24px -8px rgba(13, 27, 42, .12);
                --shadow-lg: 0 24px 48px -16px rgba(13, 27, 42, .18);
            }
    .topbar {
                position: sticky; top: 0; z-index: 1020; height: var(--topbar-h);
                display: flex; align-items: center; justify-content: space-between; gap: 16px;
                padding: 0 28px; background: var(--ink);
                border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
            }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none; }
    .user-meta strong { font-size: .84rem; font-weight: 700; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff; }
    .btn-logout { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px; background: #fff; color: var(--ink); font-weight: 600; font-size: .84rem; border: none; transition: background .2s, color .2s, transform .1s, box-shadow .2s; }
    .sidebar {
                width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h);
                height: calc(100vh - var(--topbar-h)); overflow-y: auto; overflow-x: hidden;
                background: #fff; border-right: 1px solid var(--line);
                padding: 20px 14px 32px;
                scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
            }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-top: 4px; }
    .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
    .page-header h1 { font-family: var(--font-display); font-weight: 700; font-stretch: 90%; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 4px; color: var(--ink); }
    .page-header p { color: var(--steel); font-size: .98rem; }
    .detail-card { 
                background: #fff; border-radius: var(--r-lg); border: 1px solid var(--line); 
                padding: clamp(24px, 4vw, 36px); box-shadow: var(--shadow-sm); width: 100%; margin-bottom: 20px; 
            }
    .detail-section-title { 
                font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--navy); 
                border-bottom: 2px solid var(--navy-tint); padding-bottom: 8px; margin-bottom: 20px; margin-top: 32px; 
            }
    .detail-section-title:first-child { margin-top: 0; }
    .detail-label { font-size: 0.78rem; font-weight: 700; color: var(--steel); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
    .detail-value { font-size: 0.98rem; font-weight: 600; color: var(--ink); margin-bottom: 20px; }
    .badge-status { padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 700; display: inline-block; }
    .status-pending { background-color: #fef3c7; color: #d97706; }
    .status-diproses { background-color: #dbeafe; color: #2563eb; }
    .status-memenuhi { background-color: #d1fae5; color: #059669; }
    .status-tidak-memenuhi { background-color: #fee2e2; color: #dc2626; }
    .btn-download-doc { 
                background-color: var(--paper); border: 1px solid var(--line); padding: 12px 16px; 
                border-radius: var(--r-sm); display: inline-flex; align-items: center; gap: 12px; 
                color: var(--ink); text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: background .2s, border-color .2s; 
            }
    .btn-download-doc:hover { background-color: var(--line); border-color: var(--steel-soft); color: var(--ink); }
    .btn-download-doc i { color: var(--signal); font-size: 1.25rem; }
    @media print {
        .topbar, .sidebar, .btn-logout, .no-print { display: none !important; }
        .shell { display: block; width: 100%; }
        .content { padding: 0 !important; margin: 0 !important; background-color: white; width: 100%; }
        .detail-card { border: none !important; box-shadow: none !important; padding: 0 !important; width: 100%; }
        body { background-color: white; margin: 0; padding: 0; color: black; }
        .d-print-block { display: block !important; }
        .row { display: flex !important; flex-wrap: wrap !important; }
        .col-md-6 { width: 50% !important; flex: 0 0 auto !important; }
        .col-md-3 { width: 25% !important; flex: 0 0 auto !important; }
        .col-md-12 { width: 100% !important; flex: 0 0 auto !important; }
        .detail-section-title { color: black !important; border-bottom: 2px solid #000 !important; margin-top: 20px; }
        .detail-label { color: #444 !important; font-size: 11px !important; }
        .detail-value { color: black !important; font-size: 14px !important; margin-bottom: 15px !important; }
        .detail-section-title i { display: none !important; }
        .badge-status { border: 1px solid #000; background: transparent !important; color: black !important; padding: 4px 8px; border-radius: 4px; }
    }
</style>
@endpush

@section('content')
@section('content')

        <!-- HEADER HALAMAN WEB -->
        <div class="page-header no-print">
            <div>
                <h1>Detail {{ $jenis_layanan }}</h1>
                <p>Menampilkan rincian data permohonan dari <strong>{{ $permohonan->nama_pemohon }}</strong></p>
            </div>
            <div class="d-flex gap-2">
                <a href="/internal/pencegahan/kelola-skk" class="btn btn-outline-secondary fw-bold shadow-sm no-print" style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-primary fw-bold shadow-sm no-print" style="border-radius: 8px; padding: 10px 20px; background: var(--navy); border:none;">
                    <i class="fas fa-print me-2"></i> Cetak Form
                </button>
            </div>
        </div>

        <!-- HEADER KHUSUS PRINT -->
        <div class="d-none d-print-block text-center mb-4 pb-3" style="border-bottom: 3px solid #000;">
            <h3 class="fw-bold mb-1" style="font-size: 22px; text-transform: uppercase;">Data Permohonan {{ $jenis_layanan }}</h3>
            <p class="mb-0" style="font-size: 14px;">Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
        </div>

        <!-- ==================== TAMPILAN KARTU WEB ==================== -->
        <div class="detail-card no-print">
            
            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-user-circle text-primary me-2"></i>Informasi Pemohon</h3>
                    
                    <div class="detail-label">Nama Pemohon</div>
                    <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>

                    <div class="detail-label">Alamat Email</div>
                    <div class="detail-value">{{ $permohonan->email_pemohon }}</div>

                    <div class="detail-label">Nomor WhatsApp</div>
                    <div class="detail-value">
                        {{ $permohonan->no_whatsapp }}
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $permohonan->no_whatsapp) }}" target="_blank" class="ms-2 badge bg-success text-decoration-none no-print">Hubungi <i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-store text-warning me-2"></i>Informasi Usaha</h3>

                    <div class="detail-label">Nama Usaha / Instansi</div>
                    <div class="detail-value">{{ $permohonan->nama_usaha }}</div>

                    <div class="detail-label">NIK Pemilik Usaha</div>
                    <div class="detail-value">{{ $permohonan->nik_pemilik_usaha }}</div>

                    <div class="detail-label">Alamat Pemilik Usaha</div>
                    <div class="detail-value">{{ $permohonan->alamat_pemilik_usaha }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3 class="detail-section-title"><i class="fas fa-building text-success me-2"></i>Rincian Bangunan</h3>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Kategori Bangunan</div>
                    <div class="detail-value">{{ $permohonan->kategori_bangunan }}</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Lahan (m²)</div>
                    <div class="detail-value">{{ $permohonan->luas_lahan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Luas Bangunan (m²)</div>
                    <div class="detail-value">{{ $permohonan->luas_bangunan }} m²</div>
                </div>
                <div class="col-md-3">
                    <div class="detail-label">Tinggi Bangunan (m)</div>
                    <div class="detail-value">{{ $permohonan->tinggi_bangunan }} m</div>
                </div>
                <div class="col-md-12">
                    <div class="detail-label">Alamat Lengkap Bangunan</div>
                    <div class="detail-value">
                        {{ $permohonan->alamat_bangunan }}<br>
                        Kecamatan {{ $permohonan->kecamatan }}, Kelurahan {{ $permohonan->kelurahan }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3 class="detail-section-title"><i class="fas fa-info-circle text-danger me-2"></i>Status Permohonan</h3>
                    <div class="detail-label">Status Saat Ini</div>
                    <div class="detail-value">
                        @if($permohonan->status_permohonan == 'Pending')
                            <span class="badge-status status-pending">Pending</span>
                        @elseif($permohonan->status_permohonan == 'Diproses')
                            <span class="badge-status status-diproses">Diproses Tim</span>
                        @elseif($permohonan->status_permohonan == 'Memenuhi Syarat')
                            <span class="badge-status status-memenuhi">Memenuhi Syarat</span>
                        @else
                            <span class="badge-status status-tidak-memenuhi">Tidak Memenuhi Syarat</span>
                        @endif
                    </div>
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                <div class="col-md-6 no-print">
                    <h3 class="detail-section-title"><i class="fas fa-folder-open text-info me-2"></i>Berkas Lampiran</h3>
                    <div class="d-flex flex-column gap-2">
                        
                        <!-- Peringatan Alert Jika File Offline (SKK) -->
                        @if($permohonan->file_surat_permohonan)
                            @if($permohonan->file_surat_permohonan == 'Tidak dilampirkan (Offline)')
                                <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Surat Permohonan (Data dimasukkan secara Offline).');" class="btn-download-doc bg-light text-secondary">
                                    <i class="fas fa-file-pdf text-secondary"></i>
                                    <div>
                                        <div style="line-height: 1;">Surat Permohonan</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Tidak dilampirkan</small>
                                    </div>
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $permohonan->file_surat_permohonan) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-pdf"></i>
                                    <div>
                                        <div style="line-height: 1;">Lihat Surat Permohonan</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Berkas Wajib</small>
                                    </div>
                                </a>
                            @endif
                        @endif

                        @if($permohonan->file_persyaratan_lainnya)
                            @if($permohonan->file_persyaratan_lainnya == '["Tidak dilampirkan (Offline)"]')
                                <a href="javascript:void(0)" onclick="alert('Tidak ada data lampiran Persyaratan Lainnya (Data dimasukkan secara Offline).');" class="btn-download-doc bg-light text-secondary">
                                    <i class="fas fa-file-archive text-secondary"></i>
                                    <div>
                                        <div style="line-height: 1;">Persyaratan Lainnya</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Tidak dilampirkan</small>
                                    </div>
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $permohonan->file_persyaratan_lainnya) }}" target="_blank" class="btn-download-doc">
                                    <i class="fas fa-file-archive" style="color: #8b5cf6;"></i>
                                    <div>
                                        <div style="line-height: 1;">Lihat Persyaratan Lainnya</div>
                                        <small class="text-muted fw-normal" style="font-size: 11px;">Lampiran Opsional</small>
                                    </div>
                                </a>
                            @endif
                        @else
                            <div class="text-muted" style="font-size: 13px; font-weight: 500;">
                                <i class="fas fa-minus-circle me-1"></i> Tidak ada berkas lampiran tambahan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

<!-- Script Bootstrap & Auto Print -->
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';
        var toggle = document.getElementById('sideToggle');
        var backdrop = document.getElementById('sideBackdrop');

        function closeSide() {
            document.body.classList.remove('side-open');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
        }
        if (toggle) {
            toggle.addEventListener('click', function () {
                var open = document.body.classList.toggle('side-open');
                toggle.setAttribute('aria-expanded', open);
            });
        }
        if (backdrop) backdrop.addEventListener('click', closeSide);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeSide(); });

        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('auto_print')) {
                setTimeout(function() { window.print(); }, 500);
            }
        }
    })();
</script>
@endpush
