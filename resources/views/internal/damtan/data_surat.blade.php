@extends('layouts.dashboard')

@section('title', 'Kelola Surat Korban')

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
    .side-group summary .grp-label { flex: 1 1 auto; min-width: 0; white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4; }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    .page-header { margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
    .page-header-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-header-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0;}
    .card-custom {
                background: #ffffff;
                border: 1px solid var(--line);
                border-radius: var(--r-md);
                box-shadow: var(--shadow-xs);
                overflow: hidden;
            }
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
                transition: all .2s ease; text-decoration: none;
            }
    .btn-custom-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 27, 42, .15); color: #fff;}
    .btn-custom-light {
                display: inline-flex; align-items: center; justify-content: center; gap: 8px;
                min-height: 44px; padding: 0 24px;
                background: var(--white); color: var(--ink);
                border: 1px solid var(--line-dark); border-radius: 8px;
                font-size: .92rem; font-weight: 600;
                transition: all .2s ease;
            }
    .btn-custom-light:hover { background: #f8fafc; border-color: var(--steel-soft); color: var(--ink); }
    .table th { background-color: #f8fafc; color: var(--ink-3); font-weight: 700; font-size: 13px; padding: 16px; border-bottom: 1px solid var(--line); font-family: var(--font-display); letter-spacing: 0.02em;}
    .table td { padding: 16px; font-size: 14px; color: var(--ink); vertical-align: middle; border-bottom: 1px solid var(--line); }
    .table tbody tr:hover { background-color: var(--paper); }
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; font-size: 13px; transition: all 0.2s; text-decoration: none; }
    .action-btn.view { background-color: var(--info-tint); color: var(--info); }
    .action-btn.view:hover { background-color: #dbeafe; }
    .action-btn.edit { background-color: rgba(255, 182, 39, 0.15); color: #d97706; margin: 0 5px; }
    .action-btn.edit:hover { background-color: rgba(255, 182, 39, 0.25); }
    .action-btn.delete { background-color: var(--signal-tint); color: var(--signal); }
    .action-btn.delete:hover { background-color: #fecaca; }
    .pagination-container nav ul.pagination { margin-bottom: 0 !important; }
    .pagination-container nav p { display: none; }
    @page { margin: 0; }
    @media print {
        .topbar, .sidebar, .sidebar-backdrop, .page-header, .card-header, .card-footer,
                .btn, .dropdown, form, .modal, .action-btn, #globalSuccessAlert, #globalErrorAlert { display: none !important; }
        body { background-color: white !important; font-size: 12px; margin: 1.5cm !important; -webkit-print-color-adjust: exact; }
        .shell { display: block; }
        .content { padding: 0 !important; margin: 0 !important; }
        .card-custom { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
        .card-body { padding: 0 !important; }
        .table { width: 100% !important; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid black !important; padding: 8px !important; text-align: left; }
        .table th { background-color: #f2f2f2 !important; font-weight: bold; color: black !important; text-align: left !important; }
        th:last-child, td:last-child { display: none !important; }
    }
</style>
@endpush

@section('content')
@section('content')

        <div class="page-header">
            <div class="page-header-text">
                <h1>Kelola Surat Korban</h1>
                <p>Daftar seluruh Surat Keterangan Kejadian yang telah diterbitkan.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn-custom-light shadow-sm" type="button" onclick="window.print()">
                    <i class="fas fa-download me-2"></i> Ekspor Semua
                </button>

                <!-- HAK AKSES CREATE HANYA UNTUK DAMTAN DAN SUPER USER -->
                @hasanyrole('Damtan|Super User')
                <a href="/internal/surat-korban/create" class="btn-custom-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Buat Surat Baru
                </a>
                @endhasanyrole
            </div>
        </div>

        <div class="card-custom">
            <!-- Filter & Search Bar -->
            <div class="card-header bg-white p-4 border-bottom border-light">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari nomor surat, nama korban...">
                        </div>
                    </div>
                    <div class="col-md-4 text-end ms-auto">
                        <button class="btn-custom-light w-100 py-2 border-light fw-bold" onclick="resetFilter()"><i class="fas fa-sync-alt me-2"></i>Reset Filter</button>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    
                    <!-- HEADER KHUSUS CETAK PDF MENGGUNAKAN FLEXBOX ANTI-ERROR BOOTSTRAP -->
                    <div id="print-header" class="d-none d-print-block" style="width: 100%; margin-bottom: 20px;">
                        <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; width: 100% !important; margin-bottom: 15px;">
                            
                            <!-- Logo Kiri -->
                            <div style="width: 15% !important; text-align: left !important;">
                                <img src="/images/jambi.png" style="width: 80px; height: auto;">
                            </div>
                            
                            <!-- Teks Tengah Dipaksa Center -->
                            <div style="width: 70% !important; text-align: center !important;">
                                <div style="font-size: 14pt; color: #000; margin-bottom: 2px; font-family: 'Times New Roman', Times, serif;">PEMERINTAH KOTA JAMBI</div>
                                <div style="font-size: 16pt; font-weight: bold; color: #000; line-height: 1.1; margin-bottom: 5px; font-family: 'Times New Roman', Times, serif;">DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</div>
                                <div style="font-size: 10pt; color: #000; font-family: 'Times New Roman', Times, serif;">Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</div>
                            </div>
                            
                            <!-- Logo Kanan -->
                            <div style="width: 15% !important; text-align: right !important;">
                                <img src="/images/logo.png" style="width: 100px; height: auto;">
                            </div>
                        </div>
                        
                        <!-- Garis Ganda -->
                        <div style="border-top: 3px solid black !important; border-bottom: 1px solid black !important; height: 2px !important; width: 100% !important; margin-bottom: 15px !important;"></div>
                        
                        <h3 style="text-align: center !important; font-weight: bold; margin-bottom: 5px; font-size: 16px; color: black; font-family: 'Times New Roman', Times, serif;">REKAPITULASI SURAT KETERANGAN KEJADIAN</h3>
                        <p style="text-align: center !important; font-size: 12px; margin-bottom: 15px; color: black; font-family: 'Times New Roman', Times, serif;">Dicetak pada: {{ date('d F Y') }}</p>
                    </div>
                    <!-- AKHIR HEADER CETAK -->

                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="25%">Nomor Surat</th>
                                <th width="35%">Nama Korban / Instansi</th>
                                <th width="20%">Tanggal Diterbitkan</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($surat as $index => $row)
                            <tr>
                                <td class="text-center text-muted">{{ $surat->firstItem() + $index }}</td>
                                <td><strong>{{ $row->nomor_surat }}</strong></td>
                                <td class="text-capitalize">{{ $row->nama_korban }}</td>
                                <td>
                                    <div class="text-dark fw-bold">
                                        {{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <!-- Tombol Cetak PDF -->
                                    <a href="/internal/surat-korban/cetak/{{ $row->id }}" class="action-btn view" target="_blank" title="Cetak Surat"><i class="fas fa-print"></i></a>

                                    <!-- HAK AKSES UPDATE & DELETE HANYA UNTUK DAMTAN DAN SUPER USER -->
                                    @hasanyrole('Damtan|Super User')
                                    <a href="/internal/surat-korban/edit/{{ $row->id }}" class="action-btn edit" title="Edit Surat"><i class="fas fa-edit"></i></a>
                                    <form action="/internal/surat-korban/delete/{{ $row->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat nomor {{ $row->nomor_surat }} secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endhasanyrole
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-envelope-open-text mb-3" style="font-size: 24px;"></i><br>
                                    Belum ada surat keterangan korban yang diterbitkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white p-4 d-flex justify-content-between align-items-center border-top">
                <span class="text-muted" style="font-size: 13px;" id="dataCount">
                    Menampilkan {{ $surat->firstItem() ?? 0 }} - {{ $surat->lastItem() ?? 0 }} dari total {{ $surat->total() }} surat
                </span>
                <div class="pagination-container mb-0">
                    {{ $surat->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

<!-- Script Bootstrap & Fungsi Search/Filter JavaScript -->
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';
        /* ---------- FUNGSI SEARCH FRONTEND ---------- */
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) {
                // Abaikan baris "Belum ada data"
                if (rows[i].getElementsByTagName('td').length === 1) continue; 
                
                const rowText = rows[i].textContent.toLowerCase();
                const matchesSearch = rowText.includes(searchTerm);

                rows[i].style.display = matchesSearch ? '' : 'none';
            }
        }

        searchInput.addEventListener('keyup', filterTable);
    });

    function resetFilter() {
        document.getElementById('searchInput').value = "";
        document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
    }
</script>
@endpush
