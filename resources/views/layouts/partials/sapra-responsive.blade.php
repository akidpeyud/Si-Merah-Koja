<style>
/* ==========================================================
   SIMERAH KOJA - SAPRA INTERNAL RESPONSIVE & MODAL SCROLL ENHANCEMENTS
   Memastikan modal CRUD bisa di-scroll lancar di Desktop & Mobile
   ========================================================== */

/* 1. Modal CRUD Global (Desktop & Mobile) - Memastikan .sheet-body BISA DI-SCROLL */
dialog.sheet {
    overflow: hidden !important;
}

dialog.sheet[open] {
    display: flex !important;
    flex-direction: column !important;
}

/* KUNCI UTAMA: Tag <form> di dalam <dialog> harus flex agar mewariskan batas tinggi ke .sheet-body */
dialog.sheet form {
    display: flex !important;
    flex-direction: column !important;
    flex: 1 1 auto !important;
    min-height: 0 !important;
    overflow: hidden !important;
    margin: 0 !important;
}

dialog.sheet .sheet-head {
    flex: 0 0 auto !important;
}

dialog.sheet .sheet-body {
    flex: 1 1 auto !important;
    min-height: 0 !important;
    overflow-y: auto !important;
    -webkit-overflow-scrolling: touch !important;
    overscroll-behavior: contain !important;
    touch-action: pan-y !important;
}

dialog.sheet .sheet-body::-webkit-scrollbar {
    width: 6px !important;
}

dialog.sheet .sheet-body::-webkit-scrollbar-thumb {
    background: #cbd5e1 !important;
    border-radius: 10px !important;
}

dialog.sheet .sheet-foot {
    flex: 0 0 auto !important;
}

/* 2. Perbaikan Body & Shell Scroll pada Mobile (< 900px) */
@media (max-width: 900px) {
    .side-toggle {
        display: inline-flex !important;
    }
    body {
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }
    .shell {
        height: auto !important;
        min-height: calc(100vh - var(--topbar-h)) !important;
    }
    .content {
        height: auto !important;
        overflow-y: visible !important;
        padding: 16px 14px 60px !important;
    }
}

/* 3. Toolbar & Aksi di Mobile (< 768px) */
@media (max-width: 768px) {
    .page-toolbar {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 12px !important;
        margin-bottom: 18px !important;
    }
    .page-toolbar h1 {
        font-size: 1.4rem !important;
        line-height: 1.25 !important;
    }
    .page-toolbar p {
        font-size: .85rem !important;
        line-height: 1.4 !important;
    }
    .toolbar-actions {
        width: 100% !important;
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 8px !important;
    }
    .toolbar-actions .search {
        width: 100% !important;
        max-width: 100% !important;
        order: -1 !important;
    }
    .toolbar-actions .search input {
        height: 44px !important;
        font-size: 16px !important;
    }
    .toolbar-actions .btn {
        flex: 1 1 calc(50% - 6px) !important;
        height: 42px !important;
        padding: 0 12px !important;
        font-size: .84rem !important;
        justify-content: center !important;
    }
    .toolbar-actions .btn[onclick*="print"] {
        display: none !important;
    }
}

/* 4. Tab Pos Pemadam & Kartu Info (< 768px) */
@media (max-width: 768px) {
    .tabs {
        width: 100% !important;
        border-radius: 12px !important;
        padding: 5px !important;
        gap: 4px !important;
        scroll-snap-type: x mandatory !important;
        -webkit-overflow-scrolling: touch !important;
        margin-bottom: 14px !important;
    }
    .tab {
        padding: 8px 14px !important;
        font-size: .8rem !important;
        scroll-snap-align: start !important;
    }
    .info-card {
        padding: 14px 16px !important;
        gap: 8px 16px !important;
        border-radius: 12px !important;
    }
    .info-card h2 {
        font-size: .98rem !important;
    }
    .info-row {
        font-size: .82rem !important;
    }
}

/* 5. Tabel Responsif & Gambar Thumbnail (< 768px) */
@media (max-width: 768px) {
    .table-wrap {
        border-radius: 12px !important;
        position: relative !important;
    }
    .table-scroll {
        -webkit-overflow-scrolling: touch !important;
    }
    .data-table {
        min-width: 650px !important;
    }
    .data-table thead th {
        padding: 12px 10px !important;
        font-size: .72rem !important;
    }
    .data-table tbody td {
        padding: 12px 10px !important;
        font-size: .84rem !important;
    }
    .img-sarana {
        width: 85px !important;
        height: 60px !important;
        border-radius: 4px !important;
    }
    .cell-name {
        font-size: .88rem !important;
        margin-bottom: 4px !important;
    }
    .tag-row {
        gap: 4px !important;
    }
    .tag {
        padding: 3px 7px !important;
        font-size: .7rem !important;
    }
    .row-actions .icon-btn {
        width: 36px !important;
        height: 36px !important;
        font-size: .82rem !important;
    }
}

/* 6. FORM CRUD & MODAL DIALOG OPTIMAL DI MOBILE (< 768px) */
@media (max-width: 768px) {
    /* Bentuk Modal Bottom-Sheet di Ponsel */
    dialog.sheet {
        width: 100% !important;
        max-width: 100vw !important;
        margin: auto 0 0 0 !important;
        max-height: 88dvh !important;
        height: 88dvh !important; /* Fixed viewport height agar .sheet-body mutlak bisa di-scroll */
        border-radius: 20px 20px 0 0 !important;
        box-shadow: 0 -10px 40px rgba(0, 0, 0, .25) !important;
    }
    dialog.sheet[open] {
        display: flex !important;
        flex-direction: column !important;
        animation: slideUpMobile .25s cubic-bezier(.16, 1, .3, 1) !important;
    }
    @keyframes slideUpMobile {
        from { transform: translateY(100%); opacity: .5; }
        to   { transform: translateY(0); opacity: 1; }
    }

    /* Header Modal (Tetap diam di atas) */
    .sheet-head {
        padding: 16px 20px !important;
        border-bottom: 1px solid var(--line) !important;
        flex: 0 0 auto !important;
        background: #fff !important;
    }
    .sheet-head h2 {
        font-size: 1.05rem !important;
        line-height: 1.3 !important;
    }
    .sheet-x {
        width: 40px !important;
        height: 40px !important;
        font-size: 1.1rem !important;
    }

    /* Badan Form Input (Bisa di-scroll bebas ke bawah) */
    .sheet-body {
        padding: 18px 20px 24px !important;
        gap: 16px !important;
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch !important;
        overscroll-behavior: contain !important;
        flex: 1 1 auto !important;
        min-height: 0 !important;
    }

    /* Form Multi-Kolom Jadi 1 Kolom Penuh */
    .f-row,
    .f-row-3,
    .recap-grid {
        grid-template-columns: 1fr !important;
        gap: 14px !important;
    }

    /* Label Input */
    .f-label {
        font-size: .88rem !important;
        margin-bottom: 6px !important;
        font-weight: 600 !important;
    }

    /* Input, Select, Textarea Touch-Friendly & Anti Auto-Zoom */
    .f-input,
    select.f-input,
    input.f-input,
    textarea.f-input,
    .ss-btn {
        font-size: 16px !important;
        height: 46px !important;
        padding: 0 14px !important;
        border-radius: 10px !important;
    }
    textarea.f-input {
        height: auto !important;
        min-height: 80px !important;
        padding: 10px 14px !important;
    }
    input[type="file"].f-input {
        height: auto !important;
        min-height: 46px !important;
        padding: 9px 12px !important;
        font-size: 14px !important;
    }
    .f-hint {
        font-size: .78rem !important;
        line-height: 1.4 !important;
        margin-top: 5px !important;
    }

    /* Tombol Aksi Bawah Modal (Tetap diam di bawah layar) */
    .sheet-foot {
        padding: 12px 20px max(16px, env(safe-area-inset-bottom)) !important;
        border-top: 1px solid var(--line) !important;
        flex-direction: column-reverse !important;
        gap: 8px !important;
        background: #fff !important;
        flex: 0 0 auto !important;
        box-shadow: 0 -4px 12px rgba(0, 0, 0, .05) !important;
    }
    .sheet-foot .btn-cancel,
    .sheet-foot .btn-save {
        width: 100% !important;
        height: 44px !important;
        font-size: .95rem !important;
        font-weight: 700 !important;
        border-radius: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .sheet-foot .btn-save {
        background: var(--navy) !important;
        color: #fff !important;
    }
    .sheet-foot .btn-cancel {
        background: var(--paper) !important;
        border: 1px solid var(--line) !important;
        color: var(--steel) !important;
    }
}

/* 7. Kartu Rekapitulasi (Hidran Kota) */
@media (max-width: 768px) {
    .recap-wrap {
        grid-template-columns: 1fr !important;
        margin-top: 18px !important;
    }
    .recap-card {
        padding: 18px !important;
    }
}
@media (min-width: 1200px) {
    .recap-wrap {
        grid-template-columns: repeat(auto-fit, minmax(320px, 460px)) !important;
    }
}
</style>
