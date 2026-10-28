<style>
/* ==========================================================
   SIMERAH KOJA - DAMTAN (PEMADAMAN) INTERNAL RESPONSIVE ENHANCEMENTS
   Menjamin sidebar off-canvas mobile & tampilan konten rapi (identik dengan Sapra)
   ========================================================== */

/* 1. Sidebar & Layout Mobile (< 900px) */
@media (max-width: 900px) {
    .side-toggle {
        display: inline-flex !important;
    }
    .user-meta {
        display: none !important;
    }
    .topbar {
        padding: 0 16px !important;
    }
    body {
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }
    .shell {
        height: auto !important;
        min-height: calc(100vh - var(--topbar-h)) !important;
    }
    .sidebar {
        position: fixed !important;
        z-index: 1010 !important;
        top: var(--topbar-h) !important;
        left: 0 !important;
        height: calc(100dvh - var(--topbar-h)) !important;
        width: var(--sidebar-w, 272px) !important;
        transform: translateX(-100%) !important;
        transition: transform .3s cubic-bezier(.4, 0, .2, 1) !important;
        box-shadow: var(--shadow-lg, 0 20px 45px rgba(13, 27, 42, .14)) !important;
    }
    body.side-open .sidebar {
        transform: none !important;
    }
    .sidebar-backdrop {
        display: block !important;
        position: fixed !important;
        inset: var(--topbar-h) 0 0 0 !important;
        z-index: 1000 !important;
        background: rgba(13, 27, 42, .45) !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity .3s !important;
    }
    body.side-open .sidebar-backdrop {
        opacity: 1 !important;
        pointer-events: auto !important;
    }
    .content {
        height: auto !important;
        overflow-y: visible !important;
        padding: 16px 14px 60px !important;
        max-width: 100vw !important;
        box-sizing: border-box !important;
    }
}

/* 2. Header & Action Buttons (< 768px) */
@media (max-width: 768px) {
    .page-header,
    .page-head,
    .page-toolbar {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 12px !important;
        margin-bottom: 20px !important;
    }
    .page-header-text h1,
    .page-head h1,
    .page-toolbar h1 {
        font-size: 1.45rem !important;
        line-height: 1.25 !important;
        margin-bottom: 4px !important;
    }
    .page-header-text p,
    .page-head p,
    .page-toolbar p {
        font-size: .86rem !important;
        line-height: 1.4 !important;
    }
    .page-header .d-flex,
    .header-actions,
    .toolbar-actions {
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
    }
    .page-header .d-flex > *,
    .page-header .dropdown,
    .page-header .dropdown button,
    .page-header .btn-custom-primary,
    .page-header .btn-custom-light,
    .page-header .btn-navy,
    .header-actions .btn-add,
    .header-actions .btn-excel,
    .header-actions .btn-pdf,
    .btn-export-dropdown,
    .btn-create-top {
        width: 100% !important;
        justify-content: center !important;
        text-align: center !important;
    }
    .export-menu {
        max-width: calc(100vw - 32px) !important;
    }
}

/* 3. Tab Kategori, Stat Cards & Filter (< 768px) */
@media (max-width: 768px) {
    .tab-kategori,
    .custom-nav-tabs,
    .nav-pills {
        display: flex !important;
        width: 100% !important;
        padding: 4px !important;
        margin-bottom: 16px !important;
        border-radius: 12px !important;
    }
    .tab-kategori a,
    .custom-nav-tabs .nav-link {
        flex: 1 1 0 !important;
        text-align: center !important;
        padding: 9px 12px !important;
        font-size: .84rem !important;
        justify-content: center !important;
    }
    .stats-grid {
        grid-template-columns: 1fr !important;
        gap: 10px !important;
    }
    .card-custom .card-header {
        padding: 16px 14px !important;
    }
    .filter-bar {
        gap: 10px 0 !important;
    }
    .filter-bar .col-12,
    .filter-bar .col-md-4,
    .filter-bar .col-md-3,
    .filter-bar .col-md-2,
    .filter-bar .col-md-auto,
    .filter-bar .col-6 {
        width: 100% !important;
    }
    .filter-bar .btn-reset,
    .filter-bar .btn {
        width: 100% !important;
        justify-content: center !important;
        margin-top: 4px !important;
    }
}

/* 4. Rekap Tables & Cards (< 768px) */
@media (max-width: 768px) {
    .rekap-scroll,
    .tbl-scroll {
        padding: 12px 10px !important;
        -webkit-overflow-scrolling: touch !important;
    }
    .rekap-wrap,
    .tbl-frame {
        border-radius: 12px !important;
    }
    .table-rekap thead th,
    .tbl thead th {
        padding: 10px 8px !important;
        font-size: .82rem !important;
    }
    .table-rekap tbody td,
    .tbl tbody td {
        padding: 10px 8px !important;
        font-size: .82rem !important;
    }
    .pagination-container {
        padding: 12px 10px !important;
        flex-direction: column !important;
        gap: 10px !important;
        align-items: center !important;
    }
}

/* 5. Detail View, Form & Modal (< 768px) */
@media (max-width: 768px) {
    .card-custom {
        border-radius: 12px !important;
    }
    .pdf-grid {
        grid-template-columns: 1fr !important;
        row-gap: 8px !important;
    }
    .data-row {
        flex-direction: column !important;
        padding: 8px 0 !important;
        gap: 2px !important;
    }
    .data-label {
        width: 100% !important;
        font-size: .8rem !important;
    }
    .data-colon {
        display: none !important;
    }
    .data-value {
        width: 100% !important;
        font-size: .88rem !important;
    }
    .form-panel {
        padding: 18px 14px !important;
    }
    .action-bar {
        flex-direction: column !important;
        gap: 10px !important;
    }
    .action-bar .btn {
        width: 100% !important;
    }
    .edit-modal-box {
        width: 100% !important;
        max-width: 100% !important;
        border-radius: 16px !important;
        margin: 10px !important;
    }
    .edit-modal-body {
        padding: 18px 14px !important;
    }
}
</style>
