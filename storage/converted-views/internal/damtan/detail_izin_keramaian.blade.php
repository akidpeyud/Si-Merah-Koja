@extends('layouts.dashboard')

@section('title', 'Detail Izin Keramaian')

@push('styles')
<style>
    :root {
                --ink: #0d1b2a; --ink-2: #132a43; --ink-3: #1d3856;
                --navy: #163a63; --navy-dark: #0d2947; --navy-light: #eaf1f8; --navy-soft: rgba(22, 58, 99, .08);
                --paper: #f5f7fa; --white: #ffffff;
                --signal: #dc3545; --signal-dark: #b42332; --signal-soft: rgba(220, 53, 69, .09);
                --amber: #f4b740; --success: #198754; --info: #2563eb; --info-soft: rgba(37, 99, 235, .09);
                --steel: #64748b; --steel-soft: #94a3b8;
                --line: #e2e8f0; --line-dark: #cbd5e1;
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
                --r-lg: 18px; --r-md: 14px; --r-sm: 10px;
                --sidebar-w: 272px; --topbar-h: 70px;
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalErrorAlert { background-color: var(--signal); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0;}
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; height: 100%;}
    .card-custom .card-header { background: #f8fafc; border-bottom: 1px solid var(--line); padding: 16px 20px; font-weight: 700; color: var(--navy-dark); font-family: var(--font-display);}
    .detail-table th { color: var(--steel); font-weight: 600; font-size: 0.9rem; padding: 12px 0;}
    .detail-table td { color: var(--ink); font-weight: 500; font-size: 0.95rem; padding: 12px 0;}
    .detail-table hr { margin: 8px 0; border-color: var(--line); opacity: 1;}
    .btn-custom-outline { display: block; width: 100%; text-align: center; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; margin-bottom: 15px;}
    .btn-custom-outline.primary { border: 1px solid var(--info); color: var(--info); }
    .btn-custom-outline.primary:hover { background: var(--info-soft); }
    .btn-custom-outline.danger { border: 1px solid var(--signal); color: var(--signal); }
    .btn-custom-outline.danger:hover { background: var(--signal-soft); }
    .btn-custom-fill { display: block; width: 100%; text-align: center; padding: 12px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; border: none;}
    .btn-custom-fill.primary { background: var(--navy); color: #fff; }
    .btn-custom-fill.primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); }
    .btn-custom-fill.secondary { background: var(--line); color: var(--ink-3); margin-top: 10px;}
    .btn-custom-fill.secondary:hover { background: var(--line-dark); }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-header">
            <div class="page-header-text">
                <h1>Detail Pemohon</h1>
                <p>Informasi lengkap pengajuan rekomendasi izin keramaian masyarakat.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Kolom Detail Teks -->
            <div class="col-lg-8">
                <div class="card-custom h-100">
                    <div class="card-header"><i class="fas fa-list-alt me-2"></i> Data Lengkap Pemohon & Acara</div>
                    <div class="card-body p-4">
                        <table class="detail-table w-100">
                            <tr><th width="35%">Nama Pemohon</th><td>: {{ $permohonan->nama }}</td></tr>
                            <tr><th>NIK</th><td>: {{ $permohonan->nik }}</td></tr>
                            <tr><th>No HP/WA</th><td>: {{ $permohonan->no_hp }}</td></tr>
                            <tr><th>Alamat</th><td>: {{ $permohonan->alamat }}</td></tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr><th>Nama Usaha/Instansi</th><td>: {{ $permohonan->nama_usaha }}</td></tr>
                            <tr><th>Nama Direktur/Penanggungjawab</th><td>: {{ $permohonan->nama_direktur }}</td></tr>
                            <tr><th>No Izin Usaha</th><td>: {{ $permohonan->no_izin_usaha }}</td></tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr><th>Nama Acara</th><td>: {{ $permohonan->nama_acara }}</td></tr>
                            <tr><th>Lokasi Acara</th><td>: {{ $permohonan->lokasi_acara }}</td></tr>
                            <tr><th>Waktu Pelaksanaan</th><td>: {{ \Carbon\Carbon::parse($permohonan->tgl_pelaksanaan)->format('d F Y') }} <br>&nbsp; Pukul {{ $permohonan->waktu_mulai }} s/d {{ $permohonan->waktu_selesai }} WIB</td></tr>
                            <tr><th>Estimasi Penonton</th><td>: {{ $permohonan->jumlah_penonton }} Orang</td></tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr><th>Ketersediaan APAR</th><td>: {{ $permohonan->jumlah_apar }} Buah</td></tr>
                            <tr><th>Staff Terlatih APAR</th><td>: {{ $permohonan->jumlah_staff }} Orang</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kolom File & Status -->
            <div class="col-lg-4">
                <!-- Box File Lampiran -->
                <div class="card-custom">
                    <div class="card-header"><i class="fas fa-paperclip me-2"></i> Dokumen Lampiran</div>
                    <div class="card-body p-4">
                        <p class="mb-2 text-muted fw-bold" style="font-size: 0.85rem;">FOTO JALUR EVAKUASI</p>
                        <a href="{{ asset('storage/' . $permohonan->foto_jalur_evakuasi) }}" target="_blank" class="btn-custom-outline primary">
                            <i class="fas fa-image me-2"></i> Buka Foto Jalur
                        </a>

                        <p class="mb-2 text-muted fw-bold mt-4" style="font-size: 0.85rem;">SURAT PERNYATAAN (MATERAI)</p>
                        <a href="{{ asset('storage/' . $permohonan->surat_pernyataan) }}" target="_blank" class="btn-custom-outline danger">
                            <i class="fas fa-file-pdf me-2"></i> Buka Surat PDF
                        </a>
                    </div>
                </div>

                <a href="{{ route('internal.izin-keramaian.index') }}" class="btn-custom-fill secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';
        /* Sidebar Toggle */
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

        /* Accordion Sidebar */
        var groups = document.querySelectorAll('.side-group');
        groups.forEach(function (g) {
            g.addEventListener('toggle', function () {
                if (g.open) {
                    groups.forEach(function (o) { if (o !== g) o.open = false; });
                }
            });
        });
    })();
</script>
@endpush
