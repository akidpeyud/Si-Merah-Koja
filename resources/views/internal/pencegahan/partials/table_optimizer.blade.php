<style>
    /* ===== OPTIMALISASI PERFORMA & RESPONSIF SEMUA DEVICE (BIDANG PENCEGAHAN) ===== */
    .content table tbody tr {
        animation: none !important;
        transition: background-color .12s ease !important;
    }
    .content .table-scroll-wrapper,
    .content .table-responsive,
    .content .custom-nav-tabs {
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }
    .content .custom-nav-tabs {
        scroll-snap-type: x proximity;
    }
    .content .custom-nav-tabs .nav-link {
        scroll-snap-align: start;
    }
    tr.pg-hidden {
        display: none !important;
    }
    .btn-import-excel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 42px;
        padding: 0 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: .84rem;
        color: #fff;
        background: #0284c7;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: filter .15s ease, transform .15s ease;
        box-shadow: 0 2px 6px rgba(2, 132, 199, .18);
        white-space: nowrap;
    }
    .btn-import-excel:hover {
        color: #fff;
        filter: brightness(1.06);
        transform: translateY(-1px);
    }
    .pg-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin: -22px 0 30px;
        padding: 12px 16px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: .82rem;
        color: #475569;
    }
    .pg-controls {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }
    .pg-select {
        height: 34px;
        padding: 0 10px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #f8fafc;
        font-size: .8rem;
        font-weight: 600;
        color: #0f172a;
        cursor: pointer;
    }
    .pg-btn {
        min-width: 34px;
        height: 34px;
        padding: 0 10px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font-weight: 700;
        font-size: .8rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .pg-btn:hover:not(:disabled) {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    .pg-btn.active {
        background: #0f172a;
        color: #fff;
        border-color: #0f172a;
    }
    .pg-btn:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .content .page-toolbar,
        .content .page-head-bar {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
        }
        .content .toolbar-actions {
            width: 100%;
            justify-content: flex-start;
        }
        .content .toolbar-actions > *,
        .content .btn-import-excel {
            flex: 1 1 auto;
            justify-content: center;
            min-height: 38px;
            height: 38px;
            font-size: .78rem;
            padding: 0 12px;
        }
        .content .filter-bar {
            padding: 12px !important;
            gap: 8px !important;
        }
        .content .search-box,
        .content .filter-select,
        .content .btn-reset-filter {
            width: 100% !important;
            max-width: 100% !important;
            flex: 1 1 100% !important;
        }
        .pg-bar {
            margin: -14px 0 24px;
            flex-direction: column;
            align-items: flex-start;
        }
        .pg-controls {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    var tbody = document.querySelector('#tableBody') || document.querySelector('table tbody');
    if (!tbody) return;

    var allDataRows = Array.from(tbody.querySelectorAll('tr')).filter(function (tr) {
        return !tr.classList.contains('empty-row') &&
               tr.id !== 'emptyFilterRow' &&
               tr.id !== 'emptyFilterState' &&
               !tr.querySelector('td[colspan]');
    });

    if (allDataRows.length <= 25) {
        // Tetap tambahkan debounce ringan pada pencarian meski baris sedikit
        attachDebounce();
        return;
    }

    var tableWrapper = tbody.closest('.table-scroll-wrapper') || tbody.closest('.table-responsive') || tbody.closest('table');
    var pageSize = 25;
    var currentPage = 1;

    var pgBar = document.createElement('div');
    pgBar.className = 'pg-bar';
    pgBar.innerHTML =
        '<div class="pg-info" id="pgInfoText"></div>' +
        '<div class="pg-controls">' +
            '<label class="d-inline-flex align-items-center gap-1 me-2">' +
                '<span>Tampil:</span>' +
                '<select class="pg-select" id="pgSizeSelect" aria-label="Jumlah baris per halaman">' +
                    '<option value="25" selected>25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="all">Semua</option>' +
                '</select>' +
            '</label>' +
            '<div class="d-inline-flex align-items-center gap-1" id="pgButtonsWrap"></div>' +
        '</div>';

    if (tableWrapper && tableWrapper.parentNode) {
        tableWrapper.parentNode.insertBefore(pgBar, tableWrapper.nextSibling);
    }

    var pgInfo = document.getElementById('pgInfoText');
    var pgSizeSelect = document.getElementById('pgSizeSelect');
    var pgButtonsWrap = document.getElementById('pgButtonsWrap');

    function getMatchedRows() {
        return allDataRows.filter(function (tr) {
            return tr.style.display !== 'none';
        });
    }

    function renderPagination() {
        var matched = getMatchedRows();
        var total = matched.length;
        var limit = pageSize === 'all' ? Math.max(1, total) : pageSize;
        var totalPages = Math.max(1, Math.ceil(total / limit));

        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        var startIdx = (currentPage - 1) * limit;
        var endIdx = startIdx + limit;

        allDataRows.forEach(function (tr) {
            tr.classList.remove('pg-hidden');
        });

        matched.forEach(function (tr, idx) {
            if (idx < startIdx || idx >= endIdx) {
                tr.classList.add('pg-hidden');
            }
        });

        if (total === 0) {
            pgInfo.textContent = 'Menampilkan 0 data';
        } else {
            var showStart = startIdx + 1;
            var showEnd = Math.min(endIdx, total);
            pgInfo.innerHTML = 'Menampilkan <strong>' + showStart + '–' + showEnd + '</strong> dari <strong>' + total + '</strong> data';
        }

        pgButtonsWrap.innerHTML = '';
        if (totalPages <= 1) return;

        var prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = 'pg-btn';
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.disabled = currentPage === 1;
        prevBtn.addEventListener('click', function () {
            currentPage--;
            renderPagination();
        });
        pgButtonsWrap.appendChild(prevBtn);

        var startPage = Math.max(1, currentPage - 2);
        var endPage = Math.min(totalPages, startPage + 4);
        if (endPage - startPage < 4) startPage = Math.max(1, endPage - 4);

        for (var p = startPage; p <= endPage; p++) {
            (function (pageNum) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'pg-btn' + (pageNum === currentPage ? ' active' : '');
                btn.textContent = pageNum;
                btn.addEventListener('click', function () {
                    currentPage = pageNum;
                    renderPagination();
                });
                pgButtonsWrap.appendChild(btn);
            })(p);
        }

        var nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'pg-btn';
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.addEventListener('click', function () {
            currentPage++;
            renderPagination();
        });
        pgButtonsWrap.appendChild(nextBtn);
    }

    if (pgSizeSelect) {
        pgSizeSelect.addEventListener('change', function () {
            pageSize = pgSizeSelect.value === 'all' ? 'all' : parseInt(pgSizeSelect.value, 10);
            currentPage = 1;
            renderPagination();
        });
    }

    function scheduleResetAndRender() {
        currentPage = 1;
        setTimeout(renderPagination, 25);
    }

    function attachDebounce() {
        var timer = null;
        document.querySelectorAll('.filter-bar input, #searchInput, #searchDiklat').forEach(function (inp) {
            inp.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    if (typeof renderPagination === 'function') {
                        currentPage = 1;
                        renderPagination();
                    }
                }, 120);
            });
        });
        document.querySelectorAll('.filter-bar select, .btn-reset-filter, #btnResetFilter').forEach(function (el) {
            el.addEventListener('change', scheduleResetAndRender);
            el.addEventListener('click', scheduleResetAndRender);
        });
    }

    attachDebounce();
    renderPagination();
});
</script>
