@extends('layouts.dashboard')

@section('title', 'Detail Penggunaan Sarana')

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
    #globalSuccessAlert, #globalErrorAlert { position: fixed; top: 30px; left: 50%; transform: translateX(-50%); color: white; padding: 16px 24px; border-radius: var(--r-md); z-index: 99999; display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; animation: slideDownCenter 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    #globalSuccessAlert { background-color: var(--success); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
    #globalErrorAlert { background-color: var(--signal); box-shadow: 0 10px 25px -5px rgba(229, 57, 45, 0.4); }
    .alert-icon { font-size: 22px; }
    .btn-close-alert { background: transparent; border: none; color: white; opacity: 0.7; font-size: 18px; cursor: pointer; padding: 0; margin-left: 10px; transition: opacity 0.2s; }
    .btn-close-alert:hover { opacity: 1; }
    @keyframes slideDownCenter { from { transform: translate(-50%, -50px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
    @keyframes fadeOutUpCenter { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -50px); opacity: 0; } }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .sidebar { width: var(--sidebar-w); flex: none; position: sticky; top: var(--topbar-h); height: calc(100vh - var(--topbar-h)); overflow-y: auto; background: #ffffff; border-right: 1px solid var(--line); padding: 20px 14px 32px; scrollbar-width: thin; scrollbar-color: #d8dee8 transparent; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    .card-custom { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); box-shadow: var(--shadow-xs); overflow: hidden; }
    .form-control, .form-select { font-family: var(--font-body); min-height: 42px; font-size: .9rem; color: var(--ink); background-color: var(--white); border: 1px solid var(--line-dark); border-radius: 8px; padding: 8px 14px; transition: all 0.2s ease; box-shadow: none; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::placeholder { color: var(--steel-soft); }
    .input-group-text { background-color: #f8fafc; border: 1px solid var(--line-dark); color: var(--steel); font-weight: 600; border-radius: 8px; font-size: 0.9rem; }
    .input-group > .form-control { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .input-group > .input-group-text { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .btn-custom-light { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--white); color: var(--ink); border: 1px solid var(--line-dark); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: all .2s ease; }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .header-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .btn-print { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 44px; padding: 0 24px; background: var(--signal); color: #ffffff; border: 1px solid var(--signal); border-radius: 8px; font-size: .92rem; font-weight: 600; transition: background .2s, border-color .2s, transform .1s, box-shadow .2s; }
    .btn-print:hover { background: var(--signal-dark); border-color: var(--signal-dark); color: #ffffff; box-shadow: 0 6px 14px rgba(220, 53, 69, .25); }
    .btn-print:active { transform: scale(.97); }
    .table th { background-color: #f8fafc; color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); letter-spacing: 0.02em; }
    .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
    .table tbody tr:hover { background-color: var(--paper); }
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
    .action-btn.view { background-color: var(--info-soft); color: var(--info); }
    .action-btn.view:hover { background-color: #dbeafe; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; margin: 0 5px; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.25); }
    .action-btn.delete { background-color: var(--signal-soft); color: var(--signal); margin-left: 5px; }
    .action-btn.delete:hover { background-color: #fecaca; }
    .badge-status { display: inline-block; padding: 6px 12px; font-weight: 600; font-size: 0.8rem; border-radius: 6px; }
    .badge-menunggu { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-proses { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-disetujui { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .status-select { min-height: 34px; padding: 4px 28px 4px 10px; font-size: .8rem; font-weight: 600; border-radius: 6px; width: auto; min-width: 120px; cursor: pointer; }
    .status-select.s-Menunggu  { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
    .status-select.s-Proses    { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .status-select.s-Disetujui { background-color: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
    .status-select.s-Ditolak   { background-color: #fef2f2; color: #b91c1c; border-color: #fecaca; }
    .badge-menunggu { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .detail-label { font-size: .78rem; font-weight: 700; letter-spacing: .03em; text-transform: uppercase; color: var(--steel); margin-bottom: 2px; }
    .detail-value { font-size: .95rem; color: var(--ink); margin-bottom: 18px; word-break: break-word; }
    .detail-title { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 1px solid var(--line); }
    .foto-lokasi { max-width: 100%; max-height: 320px; border-radius: var(--r-sm); border: 1px solid var(--line); object-fit: cover; }
    .print-only { display: none; }
    .print-kop { align-items: center; gap: 16px; padding-bottom: 12px; margin-bottom: 18px; border-bottom: 3px double var(--ink); }
    .print-kop img { height: 64px; width: auto; flex: none; }
    .print-kop-text { flex: 1; text-align: center; line-height: 1.35; }
    .print-kop-text .kop-1 { font-size: 11pt; font-weight: 600; text-transform: uppercase; }
    .print-kop-text .kop-2 { font-size: 14pt; font-weight: 800; text-transform: uppercase; letter-spacing: .02em; }
    .print-kop-text .kop-3 { font-size: 9pt; color: #444; }
    .print-title { text-align: center; margin-bottom: 18px; }
    .print-title h2 { font-family: var(--font-display); font-size: 14pt; font-weight: 800; text-transform: uppercase; margin-bottom: 2px; }
    .print-title p { font-size: 10pt; color: #444; margin: 0; }
    .print-footer { margin-top: 24px; padding-top: 10px; border-top: 1px solid #999; font-size: 8.5pt; color: #555; justify-content: space-between; }
    @media print {
        @page { size: A4; margin: 0; }
        html, body { background: #ffffff !important; }
        body { padding: 14mm !important; font-size: 10.5pt; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .topbar, .sidebar, .sidebar-backdrop, .no-print,
                #globalSuccessAlert, #globalErrorAlert { display: none !important; }
        .shell { display: block; min-height: 0; }
        .content { padding: 0 !important; }
        .print-only { display: block; }
        .print-kop.print-only, .print-footer.print-only { display: flex; }
        .page-header { display: none !important; }
        .row > .col-lg-6 { flex: 0 0 auto; width: 50%; }
        .row > .col-md-6 { flex: 0 0 auto; width: 50%; }
        .row { --bs-gutter-x: 14px; --bs-gutter-y: 14px; }
        .card-custom { box-shadow: none !important; border: 1px solid #bbb; break-inside: avoid; page-break-inside: avoid; }
        .card-custom.p-4 { padding: 14px !important; }
        .detail-title { font-size: 11pt; margin-bottom: 12px; }
        .detail-label { font-size: 8pt; }
        .detail-value { font-size: 10pt; margin-bottom: 10px; }
        .foto-lokasi { max-height: 200px; }
        a[href]:after { content: none !important; }
    }
</style>
@endpush

@section('content')
@section('content')

@php
    $badge = match($row->status) {
        'Menunggu'  => 'badge-menunggu',
        'Proses'    => 'badge-proses',
        'Disetujui' => 'badge-disetujui',
        'Ditolak'   => 'badge-ditolak',
        default     => '',
    };
    $suratIsPdf = \Illuminate\Support\Str::endsWith(strtolower($row->surat_permohonan), '.pdf');
    $namaFilePdf = 'Permohonan-Penggunaan-Sarana-' . \Illuminate\Support\Str::slug($row->nama);
@endphp

<!-- ===== KOP CETAK (hanya tampil saat dicetak / disimpan PDF) ===== -->
<div class="print-kop print-only">
    <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
    <div class="print-kop-text">
        <div class="kop-1">Pemerintah Kota Jambi</div>
        <div class="kop-2">Dinas Pemadam Kebakaran dan Penyelamatan</div>
        <div class="kop-3">SIMERAH KOJA &middot; Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi</div>
    </div>
    <img src="/images/logo.png" alt="Logo Damkar">
</div>

<div class="print-title print-only">
    <h2>Detail Permohonan Penggunaan Sarana</h2>
    <p>Atas nama {{ $row->nama }} &middot; Status: <strong>{{ $row->status }}</strong></p>
</div>

<div class="page-header">
    <div class="page-header-text">
        <h1>Detail Penggunaan Sarana</h1>
        <p>Permohonan atas nama <strong>{{ $row->nama }}</strong> &middot; <span class="badge-status {{ $badge }}">{{ $row->status }}</span></p>
    </div>
    <div class="header-actions no-print">
        <a href="{{ route('internal.penggunaan-sarana.index') }}" class="btn-custom-light"><i class="fas fa-arrow-left"></i> Kembali</a>
        <button type="button" class="btn-print" onclick="cetakPdf()"><i class="fas fa-file-pdf"></i> Cetak PDF</button>
    </div>
</div>

<div class="row g-4">
    <!-- DATA PEMOHON -->
    <div class="col-lg-6">
        <div class="card-custom p-4 h-100">
            <div class="detail-title"><i class="fas fa-user me-2"></i>Data Pemohon</div>

            <div class="detail-label">Nama</div>
            <div class="detail-value">{{ $row->nama }}</div>

            <div class="detail-label">NIK</div>
            <div class="detail-value">{{ $row->nik }}</div>

            <div class="detail-label">No HP/WA</div>
            <div class="detail-value">{{ $row->no_hp }}</div>

            <div class="detail-label">Alamat</div>
            <div class="detail-value">{{ $row->alamat }}</div>

            <div class="detail-label">Jenis Pemohon</div>
            <div class="detail-value text-capitalize">{{ $row->jenis_pemohon }}</div>

            <div class="detail-label">Nama Penanggung Jawab</div>
            <div class="detail-value">{{ $row->nama_penanggung_jawab }}</div>

            <div class="detail-label">Nama Instansi / Fasilitas Umum / Perorangan</div>
            <div class="detail-value">{{ $row->nama_instansi }}</div>

            <div class="detail-label">Alamat Instansi</div>
            <div class="detail-value mb-0">{{ $row->alamat_instansi }}</div>
        </div>
    </div>

    <!-- DATA KEGIATAN -->
    <div class="col-lg-6">
        <div class="card-custom p-4 h-100">
            <div class="detail-title"><i class="fas fa-truck-droplet me-2"></i>Data Kegiatan & Sarana</div>

            <div class="detail-label">Sarana yang Dimohon</div>
            <div class="detail-value">{{ $row->sarana }}</div>

            <div class="detail-label">Kegunaan Sarana</div>
            <div class="detail-value">{{ $row->kegunaan }}</div>

            <div class="detail-label">Nama Kegiatan</div>
            <div class="detail-value">{{ $row->nama_kegiatan }}</div>

            <div class="detail-label">Lokasi Kegiatan</div>
            <div class="detail-value">{{ $row->lokasi_kegiatan }}</div>

            <div class="detail-label">Tanggal Pelaksanaan</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($row->tgl_pelaksanaan)->translatedFormat('l, d F Y') }}</div>

            <div class="detail-label">Waktu</div>
            <div class="detail-value">{{ substr($row->waktu_mulai, 0, 5) }} - {{ substr($row->waktu_selesai, 0, 5) }} WIB</div>

            <div class="detail-label">Diajukan Pada</div>
            <div class="detail-value mb-0">{{ $row->created_at?->translatedFormat('d F Y, H:i') }}</div>
        </div>
    </div>

    <!-- LAMPIRAN -->
    <div class="col-12">
        <div class="card-custom p-4">
            <div class="detail-title"><i class="fas fa-paperclip me-2"></i>Lampiran</div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="detail-label">Foto Lokasi Kegiatan</div>
                    <a href="{{ asset('storage/' . $row->foto_lokasi) }}" target="_blank">
                        <img src="{{ asset('storage/' . $row->foto_lokasi) }}" alt="Foto lokasi kegiatan" class="foto-lokasi">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Surat Permohonan</div>
                    @if($suratIsPdf)
                        <a href="{{ asset('storage/' . $row->surat_permohonan) }}" target="_blank" class="btn-custom-light no-print">
                            <i class="fas fa-file-pdf"></i> Buka Surat (PDF)
                        </a>
                        <div class="detail-value print-only">Surat permohonan terlampir dalam format PDF pada sistem.</div>
                    @else
                        <a href="{{ asset('storage/' . $row->surat_permohonan) }}" target="_blank">
                            <img src="{{ asset('storage/' . $row->surat_permohonan) }}" alt="Surat permohonan" class="foto-lokasi">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== FOOTER CETAK ===== -->
<div class="print-footer print-only">
    <span>Dicetak dari SIMERAH KOJA oleh {{ Auth::user()->nama_lengkap ?? 'Admin Damkar' }}</span>
    <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</span>
</div>

@hasanyrole('Damtan|Super User')
<div class="mt-4 no-print">
    <a href="{{ route('internal.penggunaan-sarana.edit', $row->id) }}" class="btn-custom-light"><i class="fas fa-edit"></i> Edit Data</a>
</div>
@endhasanyrole
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

    /* Cetak / simpan PDF: nama file mengikuti nama pemohon */
    var judulAsli = document.title;
    function cetakPdf() {
        document.title = @json($namaFilePdf);
        window.print();
    }
    window.addEventListener('afterprint', function () { document.title = judulAsli; });
</script>
@endpush
