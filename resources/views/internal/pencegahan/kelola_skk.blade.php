@extends('layouts.dashboard')

@section('title', 'Kelola SKK')

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
                --amber-soft: #fef3c7;
                --amber-dark: #d97706;
    
                --success: #198754;
                --success-soft: #d1fae5;
    
                --info: #2563eb;
                --info-soft: rgba(37, 99, 235, .09);
    
                --steel: #64748b;
                --steel-soft: #94a3b8;
    
                --line: #e2e8f0;
                --line-dark: #d5dce6;
    
                --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
                --font-body: 'Instrument Sans', system-ui, sans-serif;
    
                --r-lg: 18px;
                --r-md: 14px;
                --r-sm: 10px;
    
                --sidebar-w: 288px;
                --topbar-h: 70px;
    
                --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
                --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
                --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
                --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
            }
    .toast-wrap { position: fixed; z-index: 2000; top: 18px; left: 50%; transform: translateX(-50%); display: grid; gap: 10px; width: max-content; max-width: calc(100vw - 24px); }
    .topbar { position: sticky; top: 0; z-index: 1020; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 2px 12px rgba(13, 27, 42, .16); }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; transition: transform .25s ease; margin-top: 4px; }
    .page-head { margin-bottom: 26px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-head p { color: var(--steel); font-size: .95rem; margin: 0; }
    .content-card {
                background: #ffffff;
                border-radius: var(--r-md);
                border: 1px solid var(--line);
                box-shadow: var(--shadow-xs);
                padding: 0; width: 100%; overflow: hidden;
                transition: box-shadow .2s ease, border-color .2s ease;
            }
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .nav-tabs { background-color: var(--paper); border-bottom: 1px solid var(--line); padding: 12px 20px 0 20px; border-radius: var(--r-md) var(--r-md) 0 0; }
    .nav-tabs .nav-link { 
                color: var(--steel); font-weight: 600; font-size: .92rem; border: none; 
                padding: 12px 24px; margin-bottom: -1px; border-bottom: 3px solid transparent; transition: all 0.25s; 
            }
    .nav-tabs .nav-link:hover { color: var(--ink); }
    .nav-tabs .nav-link.active { color: var(--navy); background: transparent; border-bottom: 3px solid var(--navy); font-weight: 700; }
    .tab-content { padding: 24px; }
    .table th { background-color: var(--paper); color: var(--steel); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; padding: 16px 14px; border-bottom: 1px solid var(--line-dark); border-top: none; }
    .table td { padding: 16px 14px; vertical-align: middle; font-size: 0.9rem; color: var(--ink); border-bottom: 1px solid var(--line); font-weight: 500; }
    .table tbody tr:hover { background-color: #f8fafc; }
    .badge-status { padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; letter-spacing: 0.3px; }
    .status-pending { background-color: var(--amber-soft); color: var(--amber-dark); }
    .status-diproses { background-color: var(--info-soft); color: var(--info); }
    .status-memenuhi { background-color: var(--success-soft); color: var(--success); }
    .status-tidak-memenuhi { background-color: var(--signal-soft); color: var(--signal); }
    .btn-add { background-color: var(--navy); color: white; font-weight: 600; font-size: 0.88rem; padding: 10px 22px; border-radius: var(--r-sm); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all .2s ease; border: 1px solid var(--navy); }
    .btn-add:hover { background-color: var(--navy-dark); color: white; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, 0.15); }
    .btn-print-rekap { background-color: white; color: var(--ink); font-weight: 600; font-size: 0.88rem; padding: 10px 22px; border-radius: var(--r-sm); border: 1px solid var(--line-dark); transition: all .2s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: var(--shadow-xs); }
    .btn-print-rekap:hover { background-color: var(--paper); color: var(--ink); transform: translateY(-1px); }
    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { 
                display: inline-flex; align-items: center; justify-content: center; 
                width: 100%; padding: 8px 12px; border-radius: 8px; 
                font-weight: 700; font-size: 0.75rem; border: none; text-decoration: none; 
                transition: all 0.2s ease; cursor: pointer;
            }
    .btn-action i { font-size: 0.8rem; }
    .btn-action:hover { filter: brightness(0.95); transform: translateY(-1px); color: white; }
    .bg-detail { background-color: var(--info-soft); color: var(--info); }
    .bg-detail:hover { background-color: var(--info); color: white; }
    .bg-status { background-color: var(--success-soft); color: var(--success); }
    .bg-status:hover { background-color: var(--success); color: white; }
    .bg-cetak { background-color: var(--paper); color: var(--steel); border: 1px solid var(--line); }
    .bg-cetak:hover { background-color: var(--steel-soft); color: white; border-color: var(--steel-soft);}
    .bg-edit { background-color: var(--amber-soft); color: var(--amber-dark); }
    .bg-edit:hover { background-color: var(--amber); color: var(--ink-3); }
    .bg-delete { background-color: var(--signal-soft); color: var(--signal); }
    .bg-delete:hover { background-color: var(--signal); color: white; }
    .lampiran-badge { font-size: 0.72rem; padding: 6px 10px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; color: #fff; transition: opacity 0.2s;}
    .lampiran-badge:hover { opacity: 0.9; color: #fff; }
    .lampiran-badge.pdf { background: var(--signal); }
    .lampiran-badge.syarat { background: var(--steel); }
    .lampiran-badge.kosong { background: var(--line-dark); color: var(--steel); opacity: 0.7; }
    .modal-content { border-radius: var(--r-lg); border: none; box-shadow: var(--shadow-md); font-family: var(--font-body);}
    .modal-header { border-bottom: 1px solid var(--line); padding: 20px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; color: var(--ink); font-size: 1.15rem; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; }
    .form-select { border-radius: 8px; border: 1px solid var(--line-dark); padding: 10px 14px; font-size: 0.92rem; font-weight: 500; color: var(--ink); transition: border-color 0.2s, box-shadow 0.2s; }
    .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .brand { gap: 9px; }
        .brand img { height: 30px; }
        .brand span { font-size: .95rem; }
        .topbar-right { gap: 7px; }
        .user-chip { padding: 3px; border: none; background: transparent; }
        .user-avatar { width: 34px; height: 34px; }
        .btn-logout { width: 38px; height: 38px; padding: 0; border-radius: 10px; font-size: 0; }
        .btn-logout i { font-size: .9rem; }
        .content { padding: 26px 16px 50px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
    }
    @media (max-width: 420px) {
        .brand span { display: none; }
        .content { padding-left: 13px; padding-right: 13px; }
    }
    /* ---- Elemen khusus cetak: disembunyikan di layar ---- */
    .print-only, .print-only-col { display: none; }

    @page { size: A4 landscape; margin: 12mm; }
    @media print {
        .topbar, .sidebar, .btn-print-rekap, .btn-add, .page-head, .nav-tabs,
        .alert, .toast-wrap, .modal, .no-print-col { display: none !important; }

        body, .content { background: #fff !important; margin: 0 !important; padding: 0 !important; }
        .shell { display: block; }
        .content-card { border: none; box-shadow: none; padding: 0; overflow: visible !important; }
        .tab-content { padding: 0; }
        .table-responsive { overflow: visible !important; }

        /* Header laporan */
        .print-only { display: block; }
        .print-header { text-align: center; margin-bottom: 14px; padding-bottom: 8px; border-bottom: 2px solid #000; }
        .print-header h1 { font-size: 16px; font-weight: 700; margin: 0 0 2px; text-transform: uppercase; color: #000; }
        .print-header p { font-size: 10px; margin: 0; color: #000; }
        .print-section-title { font-size: 12px; font-weight: 700; margin: 14px 0 6px; color: #000; }

        /* Kedua tab dicetak berurutan, tab Perpanjangan mulai di halaman baru */
        .tab-pane { display: block !important; opacity: 1 !important; visibility: visible !important; }
        #perpanjang { break-before: page; page-break-before: always; }

        .print-only-col { display: table-cell; }
        table { width: 100% !important; border-collapse: collapse; }
        thead { display: table-header-group; }
        tr { break-inside: avoid; page-break-inside: avoid; }
        table th, table td { border: 1px solid #000 !important; padding: 5px 6px !important; font-size: 9.5px !important; color: #000 !important; background: transparent !important; vertical-align: top; }
        table th { font-weight: 700; text-align: left; }
        a { color: #000 !important; text-decoration: none !important; }

        /* Status dicetak sebagai teks biasa */
        .badge-status { background: transparent !important; color: #000 !important; padding: 0; font-size: 9.5px; }
        .badge-status i { display: none; }
    }
</style>
@endpush

@section('content')

        <div class="page-head">
            <div>
                <h1>Daftar Permohonan SKK</h1>
                <p>Kelola pengajuan Sertifikat Keamanan Kebakaran (Baru &amp; Perpanjangan).</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <!-- ==============================================
                     TOMBOL TAMBAH DIBUNGKUS HAK AKSES
                     ============================================== -->
                @hasanyrole('Pencegahan|Super User')
                <a href="{{ route('skk.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah SKK</a>
                @endhasanyrole

                <button onclick="window.print()" class="btn-print-rekap"><i class="fas fa-print"></i> Cetak Rekap</button>
            </div>
        </div>

        <!-- Header khusus cetak rekap -->
        <div class="print-only print-header">
            <h1>Rekap Permohonan Sertifikat Keamanan Kebakaran (SKK)</h1>
            <p>Dicetak: {{ now()->translatedFormat('d F Y, H:i') }} WIB &nbsp;|&nbsp; SKK Baru: {{ $skk_baru->count() }} data &nbsp;|&nbsp; Perpanjangan: {{ $skk_perpanjang->count() }} data</p>
        </div>

        <div class="content-card">
            <!-- NAV TABS -->
            <ul class="nav nav-tabs" id="skkTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="baru-tab" data-bs-toggle="tab" data-bs-target="#baru" type="button" role="tab"><i class="fas fa-certificate me-2"></i> SKK Baru</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="perpanjang-tab" data-bs-toggle="tab" data-bs-target="#perpanjang" type="button" role="tab"><i class="fas fa-sync-alt me-2"></i> Perpanjangan SKK</button>
                </li>
            </ul>

            <div class="tab-content" id="skkTabContent">
                
                <!-- ================= TAB 1: SKK BARU ================= -->
                <div class="tab-pane fade show active" id="baru" role="tabpanel">
                    <div class="print-only print-section-title">A. SKK BARU ({{ $skk_baru->count() }} data)</div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="print-only-col" style="width:34px;">No</th>
                                    <th>Tanggal</th>
                                    <th>Pemohon</th>
                                    <th>Usaha &amp; Lokasi</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="no-print-col text-center">Lampiran</th>
                                    <th class="text-center no-print-col" width="160px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skk_baru as $p)
                                <tr>
                                    <td class="print-only-col">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->created_at->format('d M Y') }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--info);">{{ $p->nama_pemohon }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:700;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a><br>
                                        <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="font-size: 0.85rem;">{{ $p->kategori_bangunan }}</div>
                                    </td>
                                    <td>
                                        @if($p->status_permohonan == 'Pending') <span class="badge-status status-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @elseif($p->status_permohonan == 'Diproses') <span class="badge-status status-diproses"><i class="fas fa-spinner"></i> Diproses</span>
                                        @elseif($p->status_permohonan == 'Memenuhi Syarat') <span class="badge-status status-memenuhi"><i class="fas fa-check-circle"></i> Memenuhi</span>
                                        @else <span class="badge-status status-tidak-memenuhi"><i class="fas fa-times-circle"></i> Ditolak</span>
                                        @endif
                                    </td>

                                    <!-- ==============================================
                                         KOLOM LAMPIRAN DENGAN CEK DATA OFFLINE
                                         ============================================== -->
                                    <td class="no-print-col text-center">
                                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && $p->file_surat_permohonan !== 'Tidak dilampirkan (Offline)')
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="lampiran-badge pdf text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="alert('Tidak ada data lampiran Surat Permohonan (Offline)');" class="lampiran-badge kosong text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @endif

                                        @if($p->file_persyaratan_lainnya && $p->file_persyaratan_lainnya !== '["Tidak dilampirkan (Offline)"]')
                                            <br><a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="lampiran-badge syarat text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @else
                                            <br><a href="javascript:void(0);" onclick="alert('Tidak ada data lampiran Syarat Lainnya (Offline)');" class="lampiran-badge kosong text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @endif
                                    </td>

                                    <td class="no-print-col">
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=baru" class="btn-action bg-detail"><i class="fas fa-search me-1"></i> Detail</a>
                                            
                                            <!-- ==============================================
                                                 TOMBOL UPDATE/CRUD DIBUNGKUS HAK AKSES
                                                 ============================================== -->
                                            @hasanyrole('Pencegahan|Super User')
                                            <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatusBaru{{ $p->id }}"><i class="fas fa-edit me-1"></i> Status</button>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('skk.edit', $p->id) }}" class="btn-action bg-edit w-50"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('skk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data permohonan SKK ini?');" class="w-50 m-0">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action bg-delete w-100"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                            @endhasanyrole

                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=baru&auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print me-1"></i> Cetak</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL UPDATE STATUS SKK BARU (DIBUNGKUS HAK AKSES) -->
                                @hasanyrole('Pencegahan|Super User')
                                <div class="modal fade" id="modalStatusBaru{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Status SKK Baru</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/internal/pencegahan/kelola-skk/update-status/{{ $p->id }}" method="POST">
                                                @csrf
                                                <div class="modal-body text-start">
                                                    <p class="mb-3 text-muted" style="font-size: 0.9rem;">Ubah status berkas pengajuan <strong>{{ $p->nama_usaha }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="font-size: 0.88rem;">Pilih Status Baru</label>
                                                        <select name="status_permohonan" class="form-select" required>
                                                            <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                            <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                            <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light" style="border-radius: 0 0 var(--r-lg) var(--r-lg);">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3 fw-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background:var(--navy); border:none; border-radius: 8px;"><i class="fas fa-save me-1"></i> Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endhasanyrole
                                
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted"><i class="fas fa-folder-open mb-2" style="font-size: 32px; color: var(--line-dark);"></i><br>Belum ada pengajuan SKK Baru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ================= TAB 2: PERPANJANG SKK ================= -->
                <div class="tab-pane fade" id="perpanjang" role="tabpanel">
                    <div class="print-only print-section-title">B. PERPANJANGAN SKK ({{ $skk_perpanjang->count() }} data)</div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="print-only-col" style="width:34px;">No</th>
                                    <th>Tanggal</th>
                                    <th>Pemohon</th>
                                    <th>Usaha &amp; Lokasi</th>
                                    <th>Kategori</th>
                                    <th>SKK Lama</th>
                                    <th>Status</th>
                                    <th class="no-print-col text-center">Lampiran</th>
                                    <th class="text-center no-print-col" width="160px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skk_perpanjang as $p)
                                <tr>
                                    <td class="print-only-col">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->created_at->format('d M Y') }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $p->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: var(--info);">{{ $p->nama_pemohon }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->no_whatsapp) }}" target="_blank" class="text-success text-decoration-none" style="font-size: 11px; font-weight:700;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a><br>
                                        <span class="text-muted" style="font-size: 11px;">NIK: {{ $p->nik_pemilik_usaha }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p->nama_usaha }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Kec. {{ $p->kecamatan }} - Kel. {{ $p->kelurahan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="font-size: 0.85rem;">{{ $p->kategori_bangunan }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="font-size: 0.85rem;">{{ $p->nomor_skk_lama ?: '-' }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Berlaku s/d {{ $p->masa_berlaku_skk_lama ? \Carbon\Carbon::parse($p->masa_berlaku_skk_lama)->format('d M Y') : '-' }}</div>
                                    </td>
                                    <td>
                                        @if($p->status_permohonan == 'Pending') <span class="badge-status status-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @elseif($p->status_permohonan == 'Diproses') <span class="badge-status status-diproses"><i class="fas fa-spinner"></i> Diproses</span>
                                        @elseif($p->status_permohonan == 'Memenuhi Syarat') <span class="badge-status status-memenuhi"><i class="fas fa-check-circle"></i> Memenuhi</span>
                                        @else <span class="badge-status status-tidak-memenuhi"><i class="fas fa-times-circle"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    
                                    <!-- ==============================================
                                         KOLOM LAMPIRAN DENGAN CEK DATA OFFLINE
                                         ============================================== -->
                                    <td class="no-print-col text-center">
                                        @if($p->file_surat_permohonan && $p->file_surat_permohonan !== 'offline_registered' && $p->file_surat_permohonan !== 'Tidak dilampirkan (Offline)')
                                            <a href="{{ asset('storage/' . $p->file_surat_permohonan) }}" target="_blank" class="lampiran-badge pdf text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="alert('Tidak ada data lampiran Surat Permohonan (Offline)');" class="lampiran-badge kosong text-decoration-none mb-1"><i class="fas fa-file-pdf"></i> Surat</a>
                                        @endif

                                        @if($p->file_persyaratan_lainnya && $p->file_persyaratan_lainnya !== '["Tidak dilampirkan (Offline)"]')
                                            <br><a href="{{ asset('storage/' . $p->file_persyaratan_lainnya) }}" target="_blank" class="lampiran-badge syarat text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @else
                                            <br><a href="javascript:void(0);" onclick="alert('Tidak ada data lampiran Syarat Lainnya (Offline)');" class="lampiran-badge kosong text-decoration-none mt-1"><i class="fas fa-paperclip"></i> Syarat</a>
                                        @endif
                                    </td>

                                    <td class="no-print-col">
                                        <div class="btn-action-group">
                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=perpanjang" class="btn-action bg-detail"><i class="fas fa-search me-1"></i> Detail</a>
                                            
                                            <!-- ==============================================
                                                 TOMBOL UPDATE/CRUD DIBUNGKUS HAK AKSES
                                                 ============================================== -->
                                            @hasanyrole('Pencegahan|Super User')
                                            <button type="button" class="btn-action bg-status" data-bs-toggle="modal" data-bs-target="#modalStatusPerpanjang{{ $p->id }}"><i class="fas fa-edit me-1"></i> Status</button>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('skk.edit', $p->id) }}?tipe=perpanjang" class="btn-action bg-edit w-50"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('skk.destroy', $p->id) }}?tipe=perpanjang" method="POST" onsubmit="return confirm('Yakin ingin menghapus data permohonan SKK ini?');" class="w-50 m-0">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action bg-delete w-100"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                            @endhasanyrole

                                            <a href="/internal/pencegahan/kelola-skk/{{ $p->id }}?tipe=perpanjang&auto_print=true" target="_blank" class="btn-action bg-cetak"><i class="fas fa-print me-1"></i> Cetak</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL UPDATE STATUS PERPANJANG SKK (DIBUNGKUS HAK AKSES) -->
                                @hasanyrole('Pencegahan|Super User')
                                <div class="modal fade" id="modalStatusPerpanjang{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Status Perpanjangan SKK</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/internal/pencegahan/kelola-perpanjang-skk/update-status/{{ $p->id }}" method="POST">
                                                @csrf
                                                <div class="modal-body text-start">
                                                    <p class="mb-3 text-muted" style="font-size: 0.9rem;">Ubah status berkas perpanjangan <strong>{{ $p->nama_usaha }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="font-size: 0.88rem;">Pilih Status Baru</label>
                                                        <select name="status_permohonan" class="form-select" required>
                                                            <option value="Pending" {{ $p->status_permohonan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Diproses" {{ $p->status_permohonan == 'Diproses' ? 'selected' : '' }}>Diproses Tim Inspeksi</option>
                                                            <option value="Memenuhi Syarat" {{ $p->status_permohonan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat / Diterima</option>
                                                            <option value="Tidak Memenuhi Syarat" {{ $p->status_permohonan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat / Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light" style="border-radius: 0 0 var(--r-lg) var(--r-lg);">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3 fw-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background:var(--navy); border:none; border-radius: 8px;"><i class="fas fa-save me-1"></i> Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endhasanyrole
                                
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-folder-open mb-2" style="font-size: 32px; color: var(--line-dark);"></i><br>Belum ada pengajuan Perpanjang SKK.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

<!-- Scripts -->
@endsection