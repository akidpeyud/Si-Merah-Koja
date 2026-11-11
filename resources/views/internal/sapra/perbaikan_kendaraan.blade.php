@extends('layouts.dashboard')

@section('title', 'Data Perbaikan Kendaraan Operasional')

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
        --line-dark: #d5dce6;

        --font-display: 'Bricolage Grotesque', system-ui, sans-serif;
        --font-body: 'Instrument Sans', system-ui, sans-serif;

        --r-lg: 18px;
        --r-md: 14px;
        --r-sm: 10px;

        --shadow-xs: 0 1px 2px rgba(13, 27, 42, .04);
        --shadow-sm: 0 4px 12px rgba(13, 27, 42, .06);
        --shadow-md: 0 10px 25px rgba(13, 27, 42, .08);
        --shadow-lg: 0 20px 45px rgba(13, 27, 42, .14);
    }

    body:has(dialog[open]) { overflow: hidden; }
    a { color: inherit; text-decoration: none; transition: color .2s, background .2s, border-color .2s; }
    button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; transition: background .2s, color .2s; }
    table { border-collapse: collapse; width: 100%; }

    .page-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
    .page-toolbar h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.45rem, 2.4vw, 1.85rem); line-height: 1.25; letter-spacing: -.02em; color: var(--ink); margin-bottom: 4px; }
    .page-toolbar p { color: var(--steel); font-size: .95rem; margin: 0; }
    .control-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 14px; margin-bottom: 20px; }
    .toolbar-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin-left: auto; }
    .mode-badge { display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; padding: 6px 14px; border-radius: 999px; background: var(--info-soft); color: var(--info); border: 1px solid rgba(37, 99, 235, .2); font-size: .78rem; font-weight: 700; }

    .search { position: relative; width: 240px; max-width: 100%; }
    .search i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--steel); font-size: .85rem; pointer-events: none; }
    .search input { width: 100%; height: 44px; padding: 0 16px 0 42px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff; font: inherit; font-size: .9rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .search input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .search input::placeholder { color: var(--steel-soft); }

    .year-filter { position: relative; display: inline-flex; align-items: center; }
    .year-filter i { position: absolute; left: 15px; color: var(--navy); font-size: .85rem; pointer-events: none; }
    .year-filter select { height: 44px; padding: 0 36px 0 38px; border-radius: 999px; border: 1px solid var(--line-dark); background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; appearance: none; -webkit-appearance: none; font: inherit; font-weight: 600; font-size: .88rem; color: var(--ink); cursor: pointer; transition: border-color .2s, box-shadow .2s; }
    .year-filter select:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }

    .btn { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 18px; border-radius: 8px; font-weight: 600; font-size: .88rem; transition: background .2s, transform .1s, box-shadow .2s; white-space: nowrap; border: none; }
    .btn:active { transform: translateY(0); }
    .btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-sm); }
    .btn-primary { background: var(--navy); color: #fff; }
    .btn-primary:hover { background: var(--navy-dark); }
    .btn-outline { background: #fff; border: 1px solid var(--line-dark); color: var(--ink); }
    .btn-outline:hover { border-color: var(--navy); background: var(--paper); }
    .btn-outline.green { color: var(--success); }
    .btn-outline.green:hover { border-color: var(--success); background: #f0fdf4; }
    .btn-outline.red { color: var(--signal); }
    .btn-outline.red:hover { border-color: var(--signal); background: #fef2f2; }

    /* TABS FILTER JENIS KENDARAAN (SERASI DENGAN SARANA MAKO & MUTU BAKU) */
    .tabs { display: flex; gap: 6px; padding: 6px; width: max-content; max-width: 100%; background: #fff; border: 1px solid var(--line); border-radius: 999px; box-shadow: var(--shadow-xs); overflow-x: auto; scrollbar-width: none; margin: 0; }
    .tabs::-webkit-scrollbar { display: none; }
    .tab { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; padding: 9px 18px; border-radius: 999px; font-weight: 700; font-size: .85rem; color: var(--steel); transition: background .2s, color .2s; }
    .tab:hover { background: var(--paper); color: var(--ink); }
    .tab[aria-selected="true"] { background: var(--navy); color: #fff; box-shadow: var(--shadow-sm); }

    /* INFO CARD PERINGATAN GANTI BARANG BERULANG (SERASI DENGAN INFO-CARD SAPRA) */
    .info-card { display: flex; flex-wrap: wrap; align-items: center; gap: 10px 14px; background: #fff; border: 1px solid var(--line); border-left: 4px solid var(--signal); border-radius: var(--r-md); padding: 18px 22px; margin-bottom: 20px; box-shadow: var(--shadow-xs); }
    .info-card h2 { font-family: var(--font-display); font-weight: 700; font-size: .95rem; letter-spacing: -.01em; text-transform: uppercase; flex-basis: 100%; color: var(--ink); margin: 0 0 4px 0; display: flex; align-items: center; gap: 8px; }
    .info-card h2 i { color: var(--signal); }

    /* TABEL DATA SAPRA */
    .table-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); overflow: hidden; box-shadow: var(--shadow-xs); transition: box-shadow .2s, border-color .2s; }
    .table-wrap:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    .table-scroll { overflow-x: auto; width: 100%; }
    .data-table { font-size: .89rem; min-width: 1080px; width: 100%; border-collapse: collapse; text-align: left; }
    .data-table thead th { position: sticky; top: 0; z-index: 5; background: var(--paper); color: var(--steel); padding: 16px 14px; font-weight: 700; font-size: .75rem; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap; border-bottom: 1px solid var(--line); border-top: 1px solid var(--line); }
    .data-table thead th.c { text-align: center; }
    .data-table thead th.r { text-align: right; }
    .data-table tbody td { padding: 16px 14px; border-bottom: 1px solid var(--line); vertical-align: middle; color: var(--ink); }
    .data-table tbody td.c { text-align: center; }
    .data-table tbody td.r { text-align: right; }
    .data-table tbody tr { transition: background .2s; }
    .data-table tbody tr:hover { background: #f8fafc; }
    .data-table tfoot td { background: var(--paper); padding: 15px 14px; font-weight: 700; font-size: .9rem; color: var(--ink); border-top: 1px solid var(--line-dark); }

    .cell-name { font-weight: 700; color: var(--ink); font-size: .92rem; }
    .cell-sub { display: block; font-size: .79rem; font-weight: 500; color: var(--steel); margin-top: 3px; }
    .cell-empty { text-align: center; padding: 60px 20px; color: var(--steel-soft); font-weight: 600; font-size: 1rem; }

    /* CHIPS & TAGS SERAGAM SAPRA */
    .chip { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 6px; font-weight: 700; font-size: .76rem; letter-spacing: .02em; text-transform: uppercase; border: 1px solid transparent; white-space: nowrap; }
    .chip-navy { background: var(--navy-light); color: var(--navy); border-color: #cfdcec; }
    .chip-blue { background: var(--info-soft); color: var(--info); border-color: rgba(37, 99, 235, 0.2); }
    .chip-red { background: var(--signal-soft); color: var(--signal-dark); border-color: rgba(220, 53, 69, 0.2); }
    .chip-muted { color: var(--steel-soft); background: var(--paper); border-color: var(--line); font-weight: 600; text-transform: none; }

    .tag-row { display: flex; flex-wrap: wrap; gap: 6px; }
    .tag { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border-radius: 8px; font-size: .75rem; font-weight: 600; background: var(--paper); border: 1px solid var(--line); color: var(--steel); white-space: nowrap; }
    .tag .val { color: var(--ink); font-weight: 700; }
    .tag.warn { background: var(--signal-soft); border-color: rgba(220, 53, 69, .2); color: var(--signal-dark); }
    .tag.warn .val { color: var(--signal-dark); }

    /* DAFTAR BARIS ITEM MENURUN KE BAWAH DI TABEL */
    .item-stack { display: flex; flex-direction: column; gap: 6px; align-items: flex-start; }
    .item-stack.c-align { align-items: center; }
    .item-stack.r-align { align-items: flex-end; }
    .item-line { display: inline-flex; align-items: center; gap: 6px; min-height: 28px; }
    .item-bullet { color: var(--steel-soft); font-weight: 700; font-size: .82rem; }
    .item-subtotal { margin-top: 8px; padding-top: 6px; border-top: 1px dashed var(--line-dark); display: flex; align-items: center; justify-content: flex-end; gap: 6px; font-size: .82rem; color: var(--steel); }
    .item-subtotal strong { font-size: .9rem; font-weight: 800; color: var(--navy); }

    /* INPUT DINAMIS MULTI-BARANG DI MODAL */
    .dyn-box { background: var(--paper); border: 1px solid var(--line); border-radius: 10px; padding: 14px; display: grid; gap: 10px; }
    .dyn-head { display: grid; grid-template-columns: 1.35fr .95fr .6fr 1fr 36px; gap: 8px; font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em; color: var(--steel); padding: 0 2px; }
    .dyn-rows { display: grid; gap: 8px; }
    .dyn-row { display: grid; grid-template-columns: 1.35fr .95fr .6fr 1fr 36px; gap: 8px; align-items: center; }
    .dyn-row .f-input { height: 40px; padding: 0 11px; font-size: .86rem; }
    .btn-del-row { width: 36px; height: 40px; border-radius: 8px; display: grid; place-items: center; background: #fff; border: 1px solid var(--line-dark); color: var(--signal); transition: background .2s, color .2s, border-color .2s; }
    .btn-del-row:hover { background: var(--signal); color: #fff; border-color: var(--signal); }
    .btn-add-row { display: inline-flex; align-items: center; justify-content: center; gap: 7px; height: 38px; padding: 0 14px; border-radius: 8px; background: #fff; border: 1px dashed var(--navy); color: var(--navy); font-weight: 700; font-size: .82rem; width: fit-content; transition: background .2s; }
    .btn-add-row:hover { background: var(--navy-light); }
    @media (max-width: 640px) {
        .dyn-head { display: none; }
        .dyn-row { grid-template-columns: 1fr; padding-bottom: 10px; border-bottom: 1px solid var(--line); }
        .btn-del-row { width: 100%; height: 34px; }
    }

    /* GAMBAR THUMBNAIL SERASI SARANA MAKO */
    .img-wrap { display: inline-block; padding: 4px; border: 1px solid var(--line); border-radius: 8px; background: var(--paper); transition: transform .2s, border-color .2s; cursor: pointer; }
    .img-wrap:hover { transform: scale(1.04); border-color: var(--navy); }
    .img-wrap img { width: 76px; height: 52px; object-fit: cover; border-radius: 5px; display: block; }
    .img-empty { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 999px; background: var(--paper); border: 1px solid var(--line); font-size: .75rem; font-weight: 600; color: var(--steel); }

    .row-actions { display: inline-flex; gap: 8px; }
    .icon-btn { width: 34px; height: 34px; border-radius: 8px; display: inline-grid; place-items: center; font-size: .85rem; color: #fff; transition: background .2s, transform .1s; }
    .icon-btn:hover { transform: translateY(-1px); box-shadow: var(--shadow-xs); }
    .icon-btn.edit { background: var(--navy); }
    .icon-btn.edit:hover { background: var(--navy-dark); }
    .icon-btn.delete { background: var(--signal); }
    .icon-btn.delete:hover { background: var(--signal-dark); }

    /* RECAP CARD BAWAH (SERASI DATA HIDRANT KOTA) */
    .recap-wrap { margin-top: 24px; display: grid; grid-template-columns: minmax(280px, 460px); gap: 20px; }
    .recap-card { background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); }
    .recap-head { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-weight: 700; font-size: .95rem; text-transform: uppercase; letter-spacing: .02em; color: var(--ink); padding-bottom: 14px; margin-bottom: 16px; border-bottom: 1px solid var(--line); }
    .recap-head i { color: var(--info); }
    .recap-list { display: grid; gap: 12px; font-size: .9rem; }
    .recap-row { display: flex; justify-content: space-between; align-items: center; color: var(--steel); font-weight: 500; }
    .recap-row strong { color: var(--ink); font-weight: 700; font-size: 1rem; }
    .recap-row.total { margin-top: 8px; padding-top: 14px; border-top: 1px solid var(--line); color: var(--ink); font-weight: 700; }
    .recap-row.total strong { color: var(--navy); font-size: 1.1rem; }

    /* DIALOG MODAL */
    dialog.sheet { margin: auto; padding: 0; border: 0; border-radius: var(--r-md); width: min(760px, calc(100vw - 24px)); max-height: min(90vh, 820px); background: #fff; color: var(--ink); overflow: hidden; box-shadow: var(--shadow-lg); }
    dialog.sheet[open] { display: flex; flex-direction: column; animation: pop .22s cubic-bezier(.16,.84,.3,1); }
    dialog.sheet::backdrop { background: rgba(13,27,42,.6); -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px); }
    @keyframes pop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    .sheet-head { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 20px 24px; border-bottom: 1px solid var(--line); background: #fafafa; }
    .sheet-head h2 { font-family: var(--font-display); font-weight: 700; font-size: 1.15rem; color: var(--ink); margin: 0; }
    .sheet-x { flex: none; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: var(--paper); color: var(--steel); }
    .sheet-x:hover { background: #fdeceb; color: var(--signal-dark); }
    .sheet-body { padding: 24px; overflow-y: auto; display: grid; gap: 16px; }
    .sheet-foot { padding: 16px 24px; border-top: 1px solid var(--line); background: #fafafa; display: flex; justify-content: flex-end; gap: 12px; }
    .f-label { display: block; margin-bottom: 6px; font-size: .85rem; font-weight: 600; color: var(--ink); }
    .f-optional { font-weight: 500; color: var(--steel); }
    .f-hint { font-size: .76rem; color: var(--steel); margin-top: 4px; }
    .f-input { display: block; width: 100%; height: 44px; padding: 0 14px; border: 1px solid var(--line-dark); border-radius: 8px; background: #fff; font: inherit; font-size: .92rem; color: var(--ink); transition: border-color .2s, box-shadow .2s; }
    .f-input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    select.f-input { appearance: none; -webkit-appearance: none; padding-right: 40px; cursor: pointer; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%235b6c7f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 14px center; }
    input[type="file"].f-input { height: auto; padding: 9px 12px; font-size: .86rem; }
    .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .btn-cancel { height: 42px; padding: 0 20px; border-radius: 8px; background: #fff; border: 1px solid var(--line-dark); color: var(--ink); font-weight: 600; font-size: .88rem; }
    .btn-cancel:hover { background: var(--paper); }
    .btn-save { height: 42px; padding: 0 24px; border-radius: 8px; background: var(--navy); color: #fff; font-weight: 600; font-size: .88rem; }
    .btn-save:hover { background: var(--navy-dark); }

    @media print {
        .topbar, .sidebar, .sidebar-backdrop, .toolbar-actions, .tabs, .row-actions, .col-aksi, dialog, .mode-badge { display: none !important; }
        body { background: #fff !important; }
        .content { padding: 0 !important; }
        .table-wrap { border: none !important; box-shadow: none !important; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
</style>
@endpush

@section('content')
<style>
    .print-doc-area { display: none; }

    @media print {
        @page { size: A4 landscape; margin: 1cm; }
        html, body {
            background: #fff !important;
            color: #000 !important;
            font-family: 'Arial', sans-serif !important;
            font-size: 11px !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
            height: auto !important;
        }
        .topbar, .sidebar, .sidebar-backdrop, .screen-only-area, dialog, .auto-dismiss-alert, .alert {
            display: none !important;
        }
        .shell, .content {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            height: auto !important;
            overflow: visible !important;
        }
        .print-doc-area {
            display: block !important;
            width: 100% !important;
            color: #000 !important;
            font-family: 'Arial', sans-serif !important;
            font-size: 11px !important;
        }
        .print-doc-area table.kop-surat {
            width: 100% !important;
            border-collapse: collapse !important;
            border-bottom: 3px double #000 !important;
            margin-bottom: 14px !important;
        }
        .print-doc-area table.kop-surat td {
            border: none !important;
            padding: 5px !important;
            vertical-align: middle !important;
        }
        .print-doc-area .kop-logo { width: 15% !important; text-align: center !important; }
        .print-doc-area .kop-logo img { width: 75px !important; height: auto !important; display: inline-block !important; }
        .print-doc-area .kop-teks { width: 70% !important; text-align: center !important; line-height: 1.3 !important; }
        .print-doc-area .kop-teks .pemerintah { font-size: 14px !important; font-weight: normal !important; color: #000 !important; }
        .print-doc-area .kop-teks .dinas { font-size: 18px !important; font-weight: bold !important; color: #000 !important; margin: 3px 0 !important; }
        .print-doc-area .kop-teks .alamat { font-size: 11px !important; font-weight: normal !important; color: #000 !important; }
        .print-doc-area .doc-title { text-align: center !important; margin-bottom: 14px !important; }
        .print-doc-area .doc-title h3 { margin: 0 0 4px 0 !important; font-size: 13px !important; font-weight: bold !important; text-transform: uppercase !important; color: #000 !important; }
        .print-doc-area .doc-title p { margin: 0 !important; font-size: 11px !important; font-weight: bold !important; color: #000 !important; }
        .print-doc-area table.pdf-table { width: 100% !important; border-collapse: collapse !important; margin-top: 10px !important; }
        .print-doc-area table.pdf-table th, .print-doc-area table.pdf-table td {
            border: 1px solid #000 !important;
            padding: 6px !important;
            vertical-align: top !important;
            color: #000 !important;
            font-size: 11px !important;
        }
        .print-doc-area table.pdf-table th {
            background-color: #e2e8f0 !important;
            text-align: center !important;
            font-weight: bold !important;
            font-size: 10px !important;
            vertical-align: middle !important;
        }
        .print-doc-area .pdf-list { margin: 0 !important; padding: 0 !important; list-style: none !important; }
        .print-doc-area .pdf-list li { margin-bottom: 3px !important; line-height: 1.35 !important; }
        .print-doc-area .pdf-list li:last-child { margin-bottom: 0 !important; }
        .print-doc-area .dup-note {
            margin-top: 5px !important;
            padding: 3px 5px !important;
            background-color: #fef2f2 !important;
            border: 1px solid #dc2626 !important;
            color: #991b1b !important;
            font-size: 9.5px !important;
            font-weight: bold !important;
        }
        .print-doc-area .ttd-container { width: 100% !important; margin-top: 35px !important; page-break-inside: avoid !important; }
        .print-doc-area .ttd-box { float: right !important; width: 280px !important; text-align: center !important; }
        .print-doc-area .clear { clear: both !important; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
</style>

@php
    $user = Auth::user();
    $bisaCrud = $user->hasRole('Sapra') || $user->hasRole('Super User');
    $tahunSekarang = date('Y');

    $daftarTahun = $dataPerbaikan
        ->map(fn ($item) => $item->tahun_perbaikan)
        ->push($tahunSekarang)
        ->unique()
        ->sortDesc()
        ->values();
@endphp

<div class="screen-only-area">

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3 auto-dismiss-alert" role="alert" style="border-radius: 12px; font-weight: 600; transition: opacity .4s ease, transform .4s ease;">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3 auto-dismiss-alert" role="alert" style="border-radius: 12px; font-weight: 600; transition: opacity .4s ease, transform .4s ease;">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-radius: 12px;">
        <strong><i class="fas fa-triangle-exclamation me-1"></i> Periksa kembali inputan Anda:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="page-toolbar">
    <div>
        <h1>
            Data Perbaikan Kendaraan Operasional Dinas Damkartan Kota Jambi
            <span id="judulTahunText">Tahun {{ $tahunSekarang }}</span>
        </h1>
        <p>Rekapitulasi riwayat servis, perbaikan, dan penggantian suku cadang kendaraan operasional.</p>
        @unless($bisaCrud)
            <span class="mode-badge"><i class="fas fa-eye"></i> Mode lihat &amp; cetak</span>
        @endunless
    </div>
</div>

<!-- BARIS FILTER & AKSI (KIRI: TAB JENIS KENDARAAN, KANAN: PENCARIAN + TAHUN + EXPORT + TAMBAH) -->
<div class="control-bar">
    <div class="tabs" role="tablist" aria-label="Pilih Jenis Kendaraan">
        <button type="button" class="tab" role="tab" aria-selected="true" data-jenis-tab="all">
            <i class="fas fa-layer-group"></i> Semua Jenis
        </button>
        <button type="button" class="tab" role="tab" aria-selected="false" data-jenis-tab="R2">
            <i class="fas fa-motorcycle"></i> R2
        </button>
        <button type="button" class="tab" role="tab" aria-selected="false" data-jenis-tab="R4">
            <i class="fas fa-car-side"></i> R4
        </button>
        <button type="button" class="tab" role="tab" aria-selected="false" data-jenis-tab="R6">
            <i class="fas fa-truck"></i> R6
        </button>
        <button type="button" class="tab" role="tab" aria-selected="false" data-jenis-tab="R10">
            <i class="fas fa-truck-moving"></i> R10
        </button>
    </div>

    <div class="toolbar-actions">
        <label class="search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nopol, merk, barang..." autocomplete="off">
        </label>

        <div class="year-filter">
            <i class="fas fa-calendar-alt"></i>
            <select id="filterTahun" aria-label="Filter Tahun">
                <option value="all" selected>Semua Tahun</option>
                @foreach($daftarTahun as $thn)
                    <option value="{{ $thn }}">Tahun {{ $thn }}</option>
                @endforeach
            </select>
        </div>

        <a href="/sapra/perbaikan-kendaraan/cetak-excel?tahun=all&jenis=all" id="btnExportExcel" class="btn btn-outline green">
            <i class="fas fa-file-excel"></i> Excel
        </a>

        <a href="/sapra/perbaikan-kendaraan/cetak-pdf?tahun=all&jenis=all" id="btnExportPdf" class="btn btn-outline red">
            <i class="fas fa-file-pdf"></i> PDF
        </a>

        @if($bisaCrud)
            <button type="button" class="btn btn-primary" data-open="dlgTambah">
                <i class="fas fa-plus"></i> Tambah data
            </button>
        @endif
    </div>
</div>

@if($peringatanBerulang->isNotEmpty())
    <div class="info-card" id="repeatAlertBox">
        <h2>
            <i class="fas fa-exclamation-circle"></i>
            Catatan Penggantian Barang yang Sama (&ge; 2 Kali dalam 1 Tahun per Nopol)
        </h2>
        <div class="tag-row">
            @foreach($peringatanBerulang as $warn)
                <span class="tag warn" data-warn-year="{{ $warn['tahun'] }}">
                    <i class="fas fa-rotate"></i>
                    <span class="val">{{ $warn['nopol'] }} ({{ $warn['jenis_kendaraan'] }})</span>
                    — Ganti <span class="val">{{ $warn['barang'] }}</span> ({{ $warn['count'] }}x di {{ $warn['tahun'] }}: {{ implode(', ', $warn['tanggal_list']) }})
                </span>
            @endforeach
        </div>
    </div>
@endif

<div class="table-wrap">
    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="c" style="width: 4%">No</th>
                    <th class="c" style="width: 12%">Nopol Kendaraan</th>
                    <th class="c" style="width: 9%">Jenis Kendaraan</th>
                    <th style="width: 12%">Merk Kendaraan</th>
                    <th class="c" style="width: 10%">Tgl Perbaikan</th>
                    <th style="width: 22%">Jenis Kerusakan / Penggantian Barang</th>
                    <th style="width: 11%">Merek / Tipe Barang</th>
                    <th class="c" style="width: 7%">Satuan</th>
                    <th class="r" style="width: 10%">Total Harga</th>
                    <th class="c" style="width: 8%">Upload Foto</th>
                    @if($bisaCrud)
                        <th class="c col-aksi" style="width: 8%">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($dataPerbaikan as $item)
                    @php
                        $barangBerulang = $item->barang_berulang ?? [];
                        $isBerulang = !empty($barangBerulang);
                        $namaBarangDupMap = collect($barangBerulang)->keyBy(fn ($b) => strtolower($b['barang']));
                    @endphp
                    <tr class="data-row"
                        data-year="{{ $item->tahun_perbaikan }}"
                        data-jenis="{{ strtoupper($item->jenis_kendaraan) }}"
                        data-nopol="{{ strtoupper($item->nopol_kendaraan) }}"
                        data-harga="{{ (int) $item->total_harga }}"
                        data-repeat="{{ $isBerulang ? '1' : '0' }}">
                        <td class="c row-num" style="font-weight: 700; color: var(--steel);">{{ $loop->iteration }}</td>
                        <td class="c">
                            <span class="chip chip-navy">{{ $item->nopol_kendaraan }}</span>
                        </td>
                        <td class="c">
                            <span class="chip chip-blue">{{ strtoupper($item->jenis_kendaraan) }}</span>
                        </td>
                        <td>
                            <div class="cell-name">{{ $item->merk_kendaraan }}</div>
                        </td>
                        <td class="c" style="white-space: nowrap; font-weight: 600;">
                            {{ \Carbon\Carbon::parse($item->tgl_perbaikan)->format('d M Y') }}
                        </td>
                        <td>
                            @php $rincianList = $item->rincian_items ?? []; @endphp
                            @if(!empty($rincianList))
                                <div class="item-stack">
                                    @foreach($rincianList as $rincian)
                                        <div class="item-line">
                                            <span class="item-bullet">&bull;</span>
                                            <span class="chip {{ $rincian['is_dup'] ? 'chip-red' : 'chip-navy' }}">
                                                @if($rincian['is_dup'])
                                                    <i class="fas fa-rotate"></i>
                                                @endif
                                                {{ $rincian['barang'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="cell-name" style="text-transform: uppercase;">{{ $item->jenis_kerusakan }}</div>
                            @endif

                            @if($isBerulang)
                                <div class="tag-row" style="margin-top: 8px;">
                                    @foreach($barangBerulang as $dup)
                                        <span class="tag warn">
                                            <i class="fas fa-exclamation-circle"></i>
                                            Ganti <span class="val">{{ $dup['barang'] }}</span> {{ $dup['count'] }}x di Tahun {{ $dup['tahun'] }}
                                            ({{ implode(', ', $dup['tanggal_list']) }})
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td>
                            @if(!empty($rincianList))
                                <div class="item-stack">
                                    @foreach($rincianList as $rincian)
                                        <div class="item-line">
                                            <span class="item-bullet">&bull;</span>
                                            @if($rincian['merek'] !== '-')
                                                <span style="font-weight: 600;">{{ $rincian['merek'] }}</span>
                                            @else
                                                <span class="chip chip-muted">-</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($item->merek_tipe_barang)
                                <span style="font-weight: 600;">{{ $item->merek_tipe_barang }}</span>
                            @else
                                <span class="chip chip-muted">-</span>
                            @endif
                        </td>
                        <td class="c">
                            @if(!empty($rincianList))
                                <div class="item-stack c-align">
                                    @foreach($rincianList as $rincian)
                                        <div class="item-line">
                                            @if($rincian['satuan'] !== '-')
                                                <span class="tag"><span class="val">{{ $rincian['satuan'] }}</span></span>
                                            @else
                                                <span class="chip chip-muted">-</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($item->satuan)
                                <span class="tag"><span class="val">{{ $item->satuan }}</span></span>
                            @else
                                <span class="chip chip-muted">-</span>
                            @endif
                        </td>
                        <td class="r" style="white-space: nowrap; color: var(--ink);">
                            @php
                                $hasMultiHarga = count($rincianList) > 1 && collect($rincianList)->contains(fn ($r) => ($r['harga'] ?? null) !== null);
                            @endphp
                            @if($hasMultiHarga)
                                <div class="item-stack r-align">
                                    @foreach($rincianList as $rincian)
                                        <div class="item-line">
                                            @if(($rincian['harga'] ?? null) !== null)
                                                <span style="font-weight: 600; color: var(--steel); font-size: .83rem;">
                                                    <span class="item-bullet">&bull;</span> Rp {{ number_format((int) $rincian['harga'], 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="chip chip-muted">-</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="item-subtotal">
                                    <span>Total:</span>
                                    <strong>Rp {{ number_format((int) $item->total_harga, 0, ',', '.') }}</strong>
                                </div>
                            @else
                                <span style="font-weight: 700;">Rp {{ number_format((int) $item->total_harga, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="c">
                            @if($item->foto && file_exists(public_path($item->foto)))
                                <div class="img-wrap" data-preview-src="{{ asset($item->foto) }}" data-preview-caption="{{ $item->nopol_kendaraan }} — {{ $item->jenis_kerusakan }}">
                                    <img src="{{ asset($item->foto) }}" alt="Foto Perbaikan" loading="lazy" decoding="async">
                                </div>
                            @else
                                <span class="img-empty"><i class="far fa-image"></i> Kosong</span>
                            @endif
                        </td>
                        @if($bisaCrud)
                            <td class="c col-aksi">
                                <div class="row-actions">
                                    <button type="button" class="icon-btn edit" data-open="dlgEdit{{ $item->id }}" aria-label="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="/sapra/perbaikan-kendaraan/delete/{{ $item->id }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus data perbaikan kendaraan Nopol {{ $item->nopol_kendaraan }} ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn delete" aria-label="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr id="initialEmptyRow">
                        <td colspan="{{ $bisaCrud ? 11 : 10 }}" class="cell-empty">
                            <div style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 10px;"><i class="fas fa-screwdriver-wrench"></i></div>
                            Belum ada data perbaikan kendaraan operasional.
                        </td>
                    </tr>
                @endforelse
                <tr id="filterEmptyRow" style="display: none;">
                    <td colspan="{{ $bisaCrud ? 11 : 10 }}" class="cell-empty">
                        <div style="font-size: 2.2rem; color: #cbd5e1; margin-bottom: 10px;"><i class="fas fa-search"></i></div>
                        Tidak ada data perbaikan kendaraan pada filter tahun / jenis ini.
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="r">Total Biaya Perbaikan:</td>
                    <td class="r" id="totalHargaFooter" style="white-space: nowrap; color: var(--navy);">
                        Rp {{ number_format($dataPerbaikan->sum('total_harga'), 0, ',', '.') }}
                    </td>
                    <td colspan="{{ $bisaCrud ? 2 : 1 }}"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- REKAPITULASI BAWAH (SERASI DATA HIDRANT KOTA) -->
<div class="recap-wrap">
    <div class="recap-card">
        <div class="recap-head">
            <i class="fas fa-chart-pie"></i> Ringkasan Perbaikan Kendaraan
        </div>
        <div class="recap-list">
            <div class="recap-row">
                <span>Jumlah Riwayat Perbaikan:</span>
                <strong id="statTotalRiwayat">{{ $dataPerbaikan->count() }} Data</strong>
            </div>
            <div class="recap-row">
                <span>Jumlah Kendaraan (Nopol):</span>
                <strong id="statTotalUnit">{{ $dataPerbaikan->pluck('nopol_kendaraan')->unique()->count() }} Unit</strong>
            </div>
            <div class="recap-row">
                <span>Penggantian Barang Berulang (&ge;2x/Thn):</span>
                <strong id="statTotalBerulang" style="color: {{ $peringatanBerulang->count() > 0 ? 'var(--signal-dark)' : 'var(--ink)' }};">
                    {{ $peringatanBerulang->count() }} Temuan
                </strong>
            </div>
            <div class="recap-row total">
                <span>Total Biaya Perbaikan:</span>
                <strong id="statTotalBiaya">Rp {{ number_format($dataPerbaikan->sum('total_harga'), 0, ',', '.') }}</strong>
            </div>
        </div>
    </div>
</div>
</div><!-- /.screen-only-area -->

<!-- DOKUMEN CETAK RESMI (IDENTIK DENGAN PDF SAAT KLIK TOMBOL CETAK) -->
<div class="print-doc-area">
    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                <img src="{{ asset('images/jambi.png') }}" alt="Logo Kota Jambi">
            </td>
            <td class="kop-teks">
                <div class="pemerintah">PEMERINTAH KOTA JAMBI</div>
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN KOTA JAMBI</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
            </td>
            <td class="kop-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Yudha Brama Jaya">
            </td>
        </tr>
    </table>

    <div class="doc-title">
        <h3>DATA PERBAIKAN KENDARAAN OPERASIONAL DINAS DAMKARTAN KOTA JAMBI <span id="printJudulTahun">SEMUA TAHUN</span></h3>
        <p id="printJudulJenis" style="display: none;"></p>
    </div>

    <table class="pdf-table">
        <thead>
            <tr>
                <th width="4%">NO</th>
                <th width="11%">NOPOL KENDARAAN</th>
                <th width="7%">JENIS</th>
                <th width="12%">MERK KENDARAAN</th>
                <th width="10%">TGL PERBAIKAN</th>
                <th width="22%">JENIS KERUSAKAN / PENGGANTIAN BARANG</th>
                <th width="12%">MEREK / TIPE BARANG</th>
                <th width="6%">SATUAN</th>
                <th width="10%">TOTAL HARGA</th>
                <th width="6%">FOTO</th>
            </tr>
        </thead>
        <tbody id="printTableBody">
            @forelse($dataPerbaikan as $index => $item)
                @php $rincianList = $item->rincian_items ?? []; @endphp
                <tr class="print-row"
                    data-year="{{ $item->tahun_perbaikan }}"
                    data-jenis="{{ strtoupper($item->jenis_kendaraan) }}"
                    data-harga="{{ (int) $item->total_harga }}">
                    <td class="print-num" style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $item->nopol_kendaraan }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ strtoupper($item->jenis_kendaraan) }}</td>
                    <td>{{ $item->merk_kendaraan }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tgl_perbaikan)->format('d-m-Y') }}</td>
                    <td>
                        @if(!empty($rincianList))
                            <ul class="pdf-list">
                                @foreach($rincianList as $rincian)
                                    <li style="font-weight: bold;">- {{ strtoupper($rincian['barang']) }}</li>
                                @endforeach
                            </ul>
                        @else
                            <div style="font-weight: bold;">{{ strtoupper($item->jenis_kerusakan) }}</div>
                        @endif
                        @if(!empty($item->barang_berulang))
                            @foreach($item->barang_berulang as $dup)
                                <div class="dup-note">
                                    Ganti "{{ $dup['barang'] }}" {{ $dup['count'] }}x di Tahun {{ $dup['tahun'] }} ({{ implode(', ', $dup['tanggal_list']) }})
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(!empty($rincianList))
                            <ul class="pdf-list">
                                @foreach($rincianList as $rincian)
                                    <li>- {{ $rincian['merek'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $item->merek_tipe_barang ?: '-' }}
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if(!empty($rincianList))
                            <ul class="pdf-list">
                                @foreach($rincianList as $rincian)
                                    <li>{{ $rincian['satuan'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $item->satuan ?: '-' }}
                        @endif
                    </td>
                    <td style="text-align: right;">
                        @php
                            $hasMultiHargaPrint = count($rincianList) > 1 && collect($rincianList)->contains(fn ($r) => ($r['harga'] ?? null) !== null);
                        @endphp
                        @if($hasMultiHargaPrint)
                            <ul class="pdf-list" style="text-align: right;">
                                @foreach($rincianList as $rincian)
                                    <li>
                                        {{ ($rincian['harga'] ?? null) !== null ? 'Rp ' . number_format((int) $rincian['harga'], 0, ',', '.') : '-' }}
                                    </li>
                                @endforeach
                            </ul>
                            <div style="margin-top: 4px; padding-top: 4px; border-top: 1px dashed #64748b; font-weight: bold;">
                                Total: Rp {{ number_format((int) $item->total_harga, 0, ',', '.') }}
                            </div>
                        @else
                            <span style="font-weight: bold;">Rp {{ number_format((int) $item->total_harga, 0, ',', '.') }}</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if(!empty($item->foto) && file_exists(public_path($item->foto)))
                            <img src="{{ asset($item->foto) }}" alt="Foto" style="max-width: 55px; max-height: 45px; object-fit: cover; display: inline-block;">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center;">Belum ada data perbaikan kendaraan operasional.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" style="text-align: right; font-weight: bold; background-color: #f1f5f9;">TOTAL BIAYA PERBAIKAN:</td>
                <td id="printTotalHargaFooter" style="text-align: right; font-weight: bold; background-color: #f1f5f9;">
                    Rp {{ number_format($dataPerbaikan->sum('total_harga'), 0, ',', '.') }}
                </td>
                <td style="background-color: #f1f5f9;"></td>
            </tr>
        </tfoot>
    </table>

    <div class="ttd-container">
        <div class="ttd-box">
            <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">(Nama Kepala Bidang)</p>
            <p>NIP. .....................................</p>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- MODAL PREVIEW FOTO -->
<dialog class="sheet" id="dlgPreviewFoto" style="width: min(680px, calc(100vw - 24px));">
    <div class="sheet-head">
        <h2 id="previewFotoTitle">Foto Bukti Perbaikan</h2>
        <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <div class="sheet-body" style="place-items: center; background: #0f172a; padding: 16px;">
        <img id="previewFotoImg" src="" alt="Preview Foto" style="max-width: 100%; max-height: 70vh; border-radius: 8px; object-fit: contain;">
    </div>
</dialog>

@if($bisaCrud)
    <!-- MODAL EDIT PER ITEM -->
    @foreach($dataPerbaikan as $item)
        <dialog class="sheet" id="dlgEdit{{ $item->id }}">
            <div class="sheet-head">
                <h2>Edit Perbaikan Kendaraan ({{ $item->nopol_kendaraan }})</h2>
                <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
            </div>
            <form action="/sapra/perbaikan-kendaraan/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sheet-body">
                    <div class="f-row">
                        <div>
                            <label class="f-label">Nopol Kendaraan</label>
                            <input type="text" name="nopol_kendaraan" class="f-input" value="{{ $item->nopol_kendaraan }}" placeholder="Contoh: BH 8001 XX" required>
                        </div>
                        <div>
                            <label class="f-label">Jenis Kendaraan</label>
                            <select name="jenis_kendaraan" class="f-input" required>
                                @foreach(['R2', 'R4', 'R6', 'R10'] as $jk)
                                    <option value="{{ $jk }}" {{ strtoupper($item->jenis_kendaraan) === $jk ? 'selected' : '' }}>{{ $jk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="f-row">
                        <div>
                            <label class="f-label">Merk Kendaraan</label>
                            <input type="text" name="merk_kendaraan" class="f-input" value="{{ $item->merk_kendaraan }}" placeholder="Contoh: Hino / Isuzu / Toyota" required>
                        </div>
                        <div>
                            <label class="f-label">Tgl Perbaikan</label>
                            <input type="date" name="tgl_perbaikan" class="f-input" value="{{ \Carbon\Carbon::parse($item->tgl_perbaikan)->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div>
                        <label class="f-label">Rincian Penggantian Barang / Kerusakan</label>
                        <div class="dyn-box">
                            <div class="dyn-head">
                                <span>Jenis Barang / Kerusakan</span>
                                <span>Merek / Tipe <small style="text-transform:none;font-weight:500;">(Ops)</small></span>
                                <span>Satuan</span>
                                <span>Harga Item (Rp)</span>
                                <span></span>
                            </div>
                            <div class="dyn-rows">
                                @php
                                    $editRows = !empty($item->rincian_items) ? $item->rincian_items : [[
                                        'barang' => $item->jenis_kerusakan,
                                        'merek' => $item->merek_tipe_barang ?? '-',
                                        'satuan' => $item->satuan ?? '-',
                                        'harga' => (int) $item->total_harga,
                                    ]];
                                @endphp
                                @foreach($editRows as $er)
                                    <div class="dyn-row">
                                        <input type="text" name="items_barang[]" class="f-input" value="{{ $er['barang'] }}" placeholder="Contoh: Aki" required>
                                        <input type="text" name="items_merek[]" class="f-input" value="{{ $er['merek'] !== '-' ? $er['merek'] : '' }}" placeholder="Contoh: GS">
                                        <input type="text" name="items_satuan[]" class="f-input" value="{{ $er['satuan'] !== '-' ? $er['satuan'] : '' }}" placeholder="Cth: 1">
                                        <input type="number" name="items_harga[]" class="f-input inp-item-harga" value="{{ ($er['harga'] ?? null) !== null ? (int) $er['harga'] : '' }}" min="0" placeholder="Rp Harga">
                                        <button type="button" class="btn-del-row" title="Hapus baris"><i class="fas fa-times"></i></button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-add-row">
                                <i class="fas fa-plus"></i> Tambah Item Barang
                            </button>
                        </div>
                    </div>

                    <div class="f-row">
                        <div>
                            <label class="f-label">Total Harga Keseluruhan (Rp) <span class="f-optional">(Otomatis dijumlahkan)</span></label>
                            <input type="number" name="total_harga" class="f-input inp-total-harga" value="{{ (int) $item->total_harga }}" min="0" required>
                        </div>
                        <div>
                            <label class="f-label">Ganti Foto <span class="f-optional">(Maks 4MB)</span></label>
                            <input type="file" name="foto" class="f-input" accept="image/jpeg,image/png,image/webp">
                        </div>
                    </div>
                </div>
                <div class="sheet-foot">
                    <button type="button" class="btn-cancel" data-close>Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </dialog>
    @endforeach

    <!-- MODAL TAMBAH DATA BARU -->
    <dialog class="sheet" id="dlgTambah">
        <div class="sheet-head">
            <h2>Input Perbaikan Kendaraan Baru</h2>
            <button type="button" class="sheet-x" data-close aria-label="Tutup"><i class="fas fa-times"></i></button>
        </div>
        <form action="/sapra/perbaikan-kendaraan/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sheet-body">
                <div class="f-row">
                    <div>
                        <label class="f-label" for="addNopol">Nopol Kendaraan</label>
                        <input type="text" id="addNopol" name="nopol_kendaraan" class="f-input" placeholder="Contoh: BH 8012 AZ" required>
                    </div>
                    <div>
                        <label class="f-label" for="addJenis">Jenis Kendaraan</label>
                        <select id="addJenis" name="jenis_kendaraan" class="f-input" required>
                            <option value="">— Pilih Jenis (R2/R4/R6/R10) —</option>
                            <option value="R2">R2 (Roda 2)</option>
                            <option value="R4">R4 (Roda 4)</option>
                            <option value="R6">R6 (Roda 6)</option>
                            <option value="R10">R10 (Roda 10)</option>
                        </select>
                    </div>
                </div>

                <div class="f-row">
                    <div>
                        <label class="f-label" for="addMerk">Merk Kendaraan</label>
                        <input type="text" id="addMerk" name="merk_kendaraan" class="f-input" placeholder="Contoh: Hino Ranger / Mercy / Isuzu" required>
                    </div>
                    <div>
                        <label class="f-label" for="addTgl">Tgl Perbaikan</label>
                        <input type="date" id="addTgl" name="tgl_perbaikan" class="f-input" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div>
                    <label class="f-label">Rincian Penggantian Barang / Kerusakan</label>
                    <div class="dyn-box">
                        <div class="dyn-head">
                            <span>Jenis Barang / Kerusakan</span>
                            <span>Merek / Tipe <small style="text-transform:none;font-weight:500;">(Ops)</small></span>
                            <span>Satuan</span>
                            <span>Harga Item (Rp)</span>
                            <span></span>
                        </div>
                        <div class="dyn-rows">
                            <div class="dyn-row">
                                <input type="text" name="items_barang[]" class="f-input" placeholder="Contoh: Aki" required>
                                <input type="text" name="items_merek[]" class="f-input" placeholder="Contoh: GS">
                                <input type="text" name="items_satuan[]" class="f-input" placeholder="Cth: 1">
                                <input type="number" name="items_harga[]" class="f-input inp-item-harga" min="0" placeholder="Rp Harga">
                                <button type="button" class="btn-del-row" title="Hapus baris"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <button type="button" class="btn-add-row">
                            <i class="fas fa-plus"></i> Tambah Item Barang
                        </button>
                    </div>
                </div>

                <div class="f-row">
                    <div>
                        <label class="f-label" for="addHarga">Total Harga Keseluruhan (Rp) <span class="f-optional">(Otomatis dijumlahkan)</span></label>
                        <input type="number" id="addHarga" name="total_harga" class="f-input inp-total-harga" placeholder="Otomatis terhitung dari harga item" min="0" required>
                    </div>
                    <div>
                        <label class="f-label" for="addFoto">Upload Foto <span class="f-optional">(Opsional, Maks 4MB)</span></label>
                        <input type="file" id="addFoto" name="foto" class="f-input" accept="image/jpeg,image/png,image/webp">
                    </div>
                </div>
            </div>
            <div class="sheet-foot">
                <button type="button" class="btn-cancel" data-close>Batal</button>
                <button type="submit" class="btn-save">Simpan Data</button>
            </div>
        </form>
    </dialog>
@endif
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ---------- Auto-hide Alert Sukses / Error (3 Detik) ---------- */
    document.querySelectorAll('.auto-dismiss-alert').forEach(function (alertEl) {
        setTimeout(function () {
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-8px)';
            setTimeout(function () {
                if (alertEl.parentNode) alertEl.parentNode.removeChild(alertEl);
            }, 400);
        }, 3000);
    });

    /* ---------- Tambah / Hapus Baris Item Barang & Auto-Sum Harga di Modal ---------- */
    function recalcFormTotal(formEl) {
        if (!formEl) return;
        var hargaInputs = formEl.querySelectorAll('.inp-item-harga');
        var totalInput = formEl.querySelector('.inp-total-harga');
        if (!totalInput || !hargaInputs.length) return;

        var sum = 0;
        var hasFilled = false;
        hargaInputs.forEach(function (inp) {
            var val = parseInt(inp.value, 10);
            if (!isNaN(val) && val > 0) {
                sum += val;
                hasFilled = true;
            }
        });
        if (hasFilled) {
            totalInput.value = sum;
        }
    }

    function bindHargaInput(inp) {
        if (!inp) return;
        inp.addEventListener('input', function () {
            recalcFormTotal(inp.closest('form'));
        });
    }

    document.querySelectorAll('.inp-item-harga').forEach(bindHargaInput);

    function bindDelRow(btn) {
        btn.addEventListener('click', function () {
            var formEl = btn.closest('form');
            var container = btn.closest('.dyn-rows');
            var row = btn.closest('.dyn-row');
            if (!container || !row) return;
            if (container.querySelectorAll('.dyn-row').length > 1) {
                row.remove();
            } else {
                row.querySelectorAll('input').forEach(function (inp) { inp.value = ''; });
            }
            recalcFormTotal(formEl);
        });
    }

    document.querySelectorAll('.btn-del-row').forEach(bindDelRow);

    document.querySelectorAll('.btn-add-row').forEach(function (addBtn) {
        addBtn.addEventListener('click', function () {
            var box = addBtn.closest('.dyn-box');
            var container = box ? box.querySelector('.dyn-rows') : null;
            if (!container) return;

            var row = document.createElement('div');
            row.className = 'dyn-row';
            row.innerHTML =
                '<input type="text" name="items_barang[]" class="f-input" placeholder="Contoh: Ban / Lampu" required>' +
                '<input type="text" name="items_merek[]" class="f-input" placeholder="Contoh: GS">' +
                '<input type="text" name="items_satuan[]" class="f-input" placeholder="Cth: 2">' +
                '<input type="number" name="items_harga[]" class="f-input inp-item-harga" min="0" placeholder="Rp Harga">' +
                '<button type="button" class="btn-del-row" title="Hapus baris"><i class="fas fa-times"></i></button>';

            container.appendChild(row);
            bindDelRow(row.querySelector('.btn-del-row'));
            bindHargaInput(row.querySelector('.inp-item-harga'));
            var firstInput = row.querySelector('input');
            if (firstInput) firstInput.focus();
        });
    });

    /* ---------- Buka / Tutup Dialog Modal ---------- */
    document.querySelectorAll('[data-open]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = document.getElementById(btn.getAttribute('data-open'));
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });

    document.querySelectorAll('dialog').forEach(function (dlg) {
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg || e.target.closest('[data-close]')) dlg.close();
        });
    });

    /* ---------- Preview Foto ---------- */
    var dlgPreview = document.getElementById('dlgPreviewFoto');
    var previewImg = document.getElementById('previewFotoImg');
    var previewTitle = document.getElementById('previewFotoTitle');

    document.querySelectorAll('[data-preview-src]').forEach(function (el) {
        el.addEventListener('click', function () {
            if (!dlgPreview || !previewImg) return;
            previewImg.src = el.getAttribute('data-preview-src');
            if (previewTitle) previewTitle.textContent = el.getAttribute('data-preview-caption') || 'Foto Bukti Perbaikan';
            dlgPreview.showModal();
        });
    });

    /* ---------- Filter Real-time (Tahun, Tab Jenis Kendaraan, Pencarian) ---------- */
    var searchInput = document.getElementById('searchInput');
    var filterTahun = document.getElementById('filterTahun');
    var jenisTabs = Array.prototype.slice.call(document.querySelectorAll('[data-jenis-tab]'));
    var activeJenis = 'all';

    var judulTahunText = document.getElementById('judulTahunText');
    var totalHargaFooter = document.getElementById('totalHargaFooter');
    var statTotalRiwayat = document.getElementById('statTotalRiwayat');
    var statTotalBiaya = document.getElementById('statTotalBiaya');
    var statTotalUnit = document.getElementById('statTotalUnit');
    var filterEmptyRow = document.getElementById('filterEmptyRow');
    var repeatAlertBox = document.getElementById('repeatAlertBox');
    var btnExportExcel = document.getElementById('btnExportExcel');
    var btnExportPdf = document.getElementById('btnExportPdf');
    var dataRows = Array.prototype.slice.call(document.querySelectorAll('#tableBody tr.data-row'));
    var printRows = Array.prototype.slice.call(document.querySelectorAll('#printTableBody tr.print-row'));
    var printJudulTahun = document.getElementById('printJudulTahun');
    var printJudulJenis = document.getElementById('printJudulJenis');
    var printTotalHargaFooter = document.getElementById('printTotalHargaFooter');

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka || 0).toLocaleString('id-ID');
    }

    function applyFilter() {
        var q = searchInput ? searchInput.value.toLowerCase().trim() : '';
        var thn = filterTahun ? filterTahun.value : 'all';
        var jns = activeJenis || 'all';

        if (judulTahunText) {
            judulTahunText.textContent = thn === 'all' ? 'Tahun {{ $tahunSekarang }}' : ('Tahun ' + thn);
        }
        if (printJudulTahun) {
            printJudulTahun.textContent = thn === 'all' ? 'SEMUA TAHUN' : ('TAHUN ' + thn);
        }
        if (printJudulJenis) {
            if (jns !== 'all') {
                printJudulJenis.style.display = 'block';
                printJudulJenis.textContent = 'KATEGORI JENIS KENDARAAN: ' + jns;
            } else {
                printJudulJenis.style.display = 'none';
            }
        }

        if (btnExportExcel) {
            btnExportExcel.href = '/sapra/perbaikan-kendaraan/cetak-excel?tahun=' + encodeURIComponent(thn) + '&jenis=' + encodeURIComponent(jns);
        }
        if (btnExportPdf) {
            btnExportPdf.href = '/sapra/perbaikan-kendaraan/cetak-pdf?tahun=' + encodeURIComponent(thn) + '&jenis=' + encodeURIComponent(jns);
        }

        var visibleNo = 0;
        var totalBiaya = 0;
        var nopolSet = {};

        dataRows.forEach(function (row) {
            var rowYear = row.getAttribute('data-year') || '';
            var rowJenis = row.getAttribute('data-jenis') || '';
            var rowNopol = row.getAttribute('data-nopol') || '';
            var rowHarga = parseInt(row.getAttribute('data-harga') || '0', 10);
            var rowText = row.textContent.toLowerCase();

            var matchYear = (thn === 'all') || (rowYear === thn);
            var matchJenis = (jns === 'all') || (rowJenis === jns);
            var matchSearch = (q === '') || (rowText.indexOf(q) !== -1);

            if (matchYear && matchJenis && matchSearch) {
                visibleNo++;
                row.style.display = '';
                var numCell = row.querySelector('.row-num');
                if (numCell) numCell.textContent = visibleNo;
                totalBiaya += rowHarga;
                if (rowNopol) nopolSet[rowNopol] = true;
            } else {
                row.style.display = 'none';
            }
        });

        if (totalHargaFooter) totalHargaFooter.textContent = formatRupiah(totalBiaya);
        if (printTotalHargaFooter) printTotalHargaFooter.textContent = formatRupiah(totalBiaya);
        if (statTotalRiwayat) statTotalRiwayat.textContent = visibleNo + ' Data';
        if (statTotalBiaya) statTotalBiaya.textContent = formatRupiah(totalBiaya);
        if (statTotalUnit) statTotalUnit.textContent = Object.keys(nopolSet).length + ' Unit';

        var printNo = 0;
        printRows.forEach(function (pRow) {
            var pYear = pRow.getAttribute('data-year') || '';
            var pJenis = pRow.getAttribute('data-jenis') || '';
            var pText = pRow.textContent.toLowerCase();

            var mY = (thn === 'all') || (pYear === thn);
            var mJ = (jns === 'all') || (pJenis === jns);
            var mS = (q === '') || (pText.indexOf(q) !== -1);

            if (mY && mJ && mS) {
                printNo++;
                pRow.style.display = '';
                var pNum = pRow.querySelector('.print-num');
                if (pNum) pNum.textContent = printNo;
            } else {
                pRow.style.display = 'none';
            }
        });

        if (filterEmptyRow) {
            filterEmptyRow.style.display = (dataRows.length > 0 && visibleNo === 0) ? '' : 'none';
        }

        if (repeatAlertBox) {
            var pills = repeatAlertBox.querySelectorAll('[data-warn-year]');
            var visiblePills = 0;
            pills.forEach(function (pill) {
                var py = pill.getAttribute('data-warn-year');
                if (thn === 'all' || py === thn) {
                    pill.style.display = '';
                    visiblePills++;
                } else {
                    pill.style.display = 'none';
                }
            });
            repeatAlertBox.style.display = visiblePills > 0 ? '' : 'none';
        }
    }

    jenisTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            jenisTabs.forEach(function (t) { t.setAttribute('aria-selected', 'false'); });
            tab.setAttribute('aria-selected', 'true');
            activeJenis = tab.getAttribute('data-jenis-tab') || 'all';
            applyFilter();
        });
    });

    if (searchInput) searchInput.addEventListener('input', applyFilter);
    if (filterTahun) filterTahun.addEventListener('change', applyFilter);

    applyFilter();
})();
</script>
@endpush
