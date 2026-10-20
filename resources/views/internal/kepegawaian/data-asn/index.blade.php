@extends('layouts.dashboard')

@section('title', 'Rekap Data ASN')

@push('styles')
<style>
    .topbar {
        position: sticky; top: 0; z-index: 1020;
        height: var(--topbar-h);
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 0 28px;
        background: var(--ink);
        border-bottom: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 2px 12px rgba(13, 27, 42, .16);
    }
    .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: #fff; color: var(--ink);
        display: grid; place-items: center;
        font-family: var(--font-display); font-weight: 700; font-size: .9rem; flex: none;
    }
    .user-meta strong {
        font-size: .84rem; font-weight: 700; max-width: 160px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #fff;
    }
    .btn-logout {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 8px; height: 40px; padding: 0 17px; border-radius: 999px;
        background: #fff; color: var(--ink);
        font-weight: 600; font-size: .84rem; border: none;
        transition: background .2s, color .2s, transform .1s, box-shadow .2s;
    }
    .sidebar {
        width: var(--sidebar-w); flex: none;
        position: sticky; top: var(--topbar-h);
        height: calc(100vh - var(--topbar-h));
        overflow-y: auto; overflow-x: hidden;
        background: #fff; border-right: 1px solid var(--line);
        padding: 20px 14px 32px;
        scrollbar-width: thin; scrollbar-color: #d8dee8 transparent;
    }
    .side-link.active { background: var(--ink); color: #fff; box-shadow: 0 4px 10px rgba(13,27,42,.10); }
    .side-link.active i { color: #fff; }
    .side-group summary .grp-ico { flex: none; width: 20px; text-align: center; font-size: .95rem; color: var(--navy); margin-top: 3px; }
    .side-group summary .grp-label {
        flex: 1 1 auto; min-width: 0;
        white-space: normal; overflow: visible; text-overflow: clip; line-height: 1.4;
    }
    .side-group summary .chev { flex: none; font-size: .7rem; margin-top: 4px; transition: transform .25s ease; }
    
    .page-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 26px; gap: 16px; flex-wrap: wrap; }
    .page-head h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    
    .btn-add, .btn-excel { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
    .btn-add { background: var(--success); color: #fff; }
    .btn-add:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }
    .btn-excel { background: #fff; color: #1d6f42; border: 1.5px solid #1d6f42; }
    .btn-excel:hover { background: #1d6f42; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(29, 111, 66, .18); }
    .btn-excel[disabled] { opacity: .6; cursor: wait; transform: none; box-shadow: none; }

    /* ---------- Penghitung Statistik ASN ---------- */
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-pns     { border-left-color: var(--info); }
    .rekap-pns     .rekap-ico { background: var(--info-soft); color: var(--info); }
    .rekap-pppk    { border-left-color: #d97706; }
    .rekap-pppk    .rekap-ico { background: rgba(244, 183, 64, .15); color: #d97706; }

    .content-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 24px; box-shadow: var(--shadow-xs); overflow: hidden; transition: box-shadow .2s ease, border-color .2s ease; }
    .content-card:hover { box-shadow: var(--shadow-sm); border-color: #d2dae5; }
    
    .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: var(--line); color: var(--ink); font-size: .92rem; vertical-align: middle; }
    .table thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); background: var(--paper); border-bottom: 2px solid var(--line-dark); }
    .table tbody tr { transition: background .2s; }
    .table tbody tr:hover { background: #f8fafc; }

    .btn-action-group { display: flex; flex-direction: column; gap: 6px; }
    .btn-action { display: inline-flex; align-items: center; justify-content: flex-start; gap: 6px; padding: 6px 12px; border-radius: 6px; font-size: .8rem; font-weight: 600; transition: all .2s; text-decoration: none; border: none; width: 100%; cursor: pointer; }
    .btn-edit { background: rgba(244, 183, 64, .15); color: #b45309; }
    .btn-edit:hover { background: #d97706; color: #ffffff; }
    .btn-delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-delete:hover { background: var(--signal); color: #ffffff; }

    @media (max-width: 700px) {
        :root { --topbar-h: 64px; }
        .topbar { height: var(--topbar-h); padding: 0 14px; gap: 10px; }
        .content { padding: 26px 16px 50px; }
        .page-head h1 { font-size: 1.55rem; }
        .page-head p { font-size: .88rem; }
        .content-card { padding: 14px; }
    }
</style>
@endpush

@section('content')
@php
    $listAsn = collect($dataAsn ?? []);
    $totalJabatan = $listAsn->count();
    $tpns   = $totalPns ?? 0;
    $tpppk  = $totalPppk ?? 0;
    $tsel   = $totalSeluruh ?? 0;

    /* Data siap rekap Excel */
    $barisExcel = $listAsn->values()->map(function ($asn, $i) {
        return [
            'no'             => $i + 1,
            'nama_jabatan'   => (string) $asn->nama_jabatan,
            'pns'            => is_numeric($asn->pns) ? (int) $asn->pns : 0,
            'pppk'           => is_numeric($asn->pppk) ? (int) $asn->pppk : 0,
            'jumlah_seluruh' => is_numeric($asn->jumlah_seluruh) ? (int) $asn->jumlah_seluruh : 0,
        ];
    })->all();

    $rekapData = [
        'rows' => $barisExcel,
        'sum'  => [
            'jabatan' => $totalJabatan,
            'pns'     => $tpns,
            'pppk'    => $tpppk,
            'seluruh' => $tsel,
        ]
    ];
@endphp

        <div class="page-head">
            <div>
                <h1>Rekap Data ASN</h1>
                <p>Kelola rekapitulasi jumlah pegawai PNS dan PPPK.</p>
            </div>
            
            <div class="d-flex gap-2 flex-wrap">
                @can('asn-create')
                <a href="{{ route('data-asn.create') }}" class="btn-add text-decoration-none">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endcan

                <button type="button" id="btnExportExcel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>
            </div>
        </div>

        <!-- REKAP GRID STATISTIK -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-sitemap"></i></div>
                <div>
                    <div class="rekap-num">{{ $totalJabatan }}</div>
                    <div class="rekap-label">Total Jabatan</div>
                    <div class="rekap-sub">Posisi terdata</div>
                </div>
            </div>
            <div class="rekap-item rekap-pns">
                <div class="rekap-ico"><i class="fas fa-user-tie"></i></div>
                <div>
                    <div class="rekap-num">{{ number_format($tpns, 0, ',', '.') }}</div>
                    <div class="rekap-label">Total PNS</div>
                    <div class="rekap-sub">Pegawai Negeri Sipil</div>
                </div>
            </div>
            <div class="rekap-item rekap-pppk">
                <div class="rekap-ico"><i class="fas fa-users"></i></div>
                <div>
                    <div class="rekap-num">{{ number_format($tpppk, 0, ',', '.') }}</div>
                    <div class="rekap-label">Total PPPK</div>
                    <div class="rekap-sub">Pegawai P3K</div>
                </div>
            </div>
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-chart-pie"></i></div>
                <div>
                    <div class="rekap-num">{{ number_format($tsel, 0, ',', '.') }}</div>
                    <div class="rekap-label">Keseluruhan ASN</div>
                    <div class="rekap-sub">PNS + PPPK</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="6%" class="text-center">No</th>
                            <th>Nama Jabatan</th>
                            <th width="15%" class="text-center">PNS</th>
                            <th width="15%" class="text-center">PPPK</th>
                            <th width="15%" class="text-center">Jumlah Seluruh</th>
                            @if(auth()->check() && (auth()->user()->can('asn-edit') || auth()->user()->can('asn-delete')))
                            <th width="130px" class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listAsn as $key => $asn)
                        <tr>
                            <td class="text-center fw-bold text-secondary">{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $asn->nama_jabatan }}</td>
                            <td class="text-center">{{ $asn->pns ?: '-' }}</td>
                            <td class="text-center">{{ $asn->pppk ?: '-' }}</td>
                            <td class="text-center fw-bold">{{ $asn->jumlah_seluruh }}</td>
                            
                            @if(auth()->check() && (auth()->user()->can('asn-edit') || auth()->user()->can('asn-delete')))
                            <td>
                                <div class="btn-action-group">
                                    @can('asn-edit')
                                    <a href="{{ route('data-asn.edit', $asn->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-pen" style="width: 14px;"></i> Edit
                                    </a>
                                    @endcan
                                    
                                    @can('asn-delete')
                                    <form action="{{ route('data-asn.destroy', $asn->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete w-100">
                                            <i class="fas fa-trash" style="width: 14px;"></i> Hapus
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada rekap data ASN.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($listAsn->count() > 0)
                    <tfoot>
                        <tr style="background-color: var(--paper); border-top: 2px solid var(--line-dark);">
                            <td colspan="2" class="text-end fw-bold py-3">TOTAL KESELURUHAN :</td>
                            <td class="text-center fw-bold py-3 text-primary">{{ number_format($tpns, 0, ',', '.') }}</td>
                            <td class="text-center fw-bold py-3 text-primary">{{ number_format($tpppk, 0, ',', '.') }}</td>
                            <td class="text-center fw-bold py-3 text-danger fs-6">{{ number_format($tsel, 0, ',', '.') }}</td>
                            @if(auth()->check() && (auth()->user()->can('asn-edit') || auth()->user()->can('asn-delete')))
                            <td></td>
                            @endif
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
<script>
var REKAP = @json($rekapData);

function rekapKolomASN() {
    return [
        { k: 'no',             t: 'No',             w: 6,  a: 'center', int: true },
        { k: 'nama_jabatan',   t: 'Nama Jabatan',   w: 36 },
        { k: 'pns',            t: 'PNS',            w: 16, a: 'center', int: true },
        { k: 'pppk',           t: 'PPPK',           w: 16, a: 'center', int: true },
        { k: 'jumlah_seluruh', t: 'Jumlah Seluruh', w: 18, a: 'center', int: true }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }
    if (!REKAP.rows.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Belum ada data rekap ASN untuk diexport.', confirmButtonColor: '#163a63' });
        return;
    }

    var oldHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';

    try {
        var NAVY = 'FF163A63';
        var thin = { style: 'thin', color: { argb: 'FFBFC8D4' } };
        var border = { top: thin, left: thin, bottom: thin, right: thin };
        var fillOf = function (argb) { return { type: 'pattern', pattern: 'solid', fgColor: { argb: argb } }; };

        var now = new Date();
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tglCetak = pad(now.getDate()) + '/' + pad(now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ' WIB';
        var tglFile  = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());

        var wb = new ExcelJS.Workbook();
        wb.creator = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        wb.created = now;

        /* ===== Sheet 1: Rekap Data ASN ===== */
        var rows  = REKAP.rows;
        var sum   = REKAP.sum;
        var HEAD  = 5;
        var FIRST = HEAD + 1;
        var cols  = rekapKolomASN();
        var NCOL  = cols.length;
        var LAST  = HEAD + Math.max(rows.length, 1);

        var ws = wb.addWorksheet('Rekap Data ASN', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 2 }],
            pageSetup: { paperSize: 9, orientation: 'portrait', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
        });
        cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c.w; });

        ws.mergeCells(1, 1, 1, NCOL);
        ws.getCell('A1').value = 'REKAPITULASI DATA APARATUR SIPIL NEGARA (ASN)';
        ws.getCell('A1').font = { name: 'Calibri', size: 15, bold: true, color: { argb: NAVY } };
        ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
        ws.getRow(1).height = 26;

        ws.mergeCells(2, 1, 2, NCOL);
        ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        ws.getCell('A2').font = { size: 11, bold: true };

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak +
            '   |   Total Jabatan: ' + sum.jabatan +
            '   |   Total PNS: ' + sum.pns +
            '   |   Total PPPK: ' + sum.pppk +
            '   |   Keseluruhan: ' + sum.seluruh;
        ws.getCell('A3').font = { size: 10, italic: true, color: { argb: 'FF64748B' } };

        var hr = ws.getRow(HEAD);
        cols.forEach(function (c, i) { hr.getCell(i + 1).value = c.t; });
        hr.height = 32;
        hr.eachCell(function (cell) {
            cell.font = { bold: true, color: { argb: 'FFFFFFFF' }, size: 10.5 };
            cell.fill = fillOf(NAVY);
            cell.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            cell.border = border;
        });

        rows.forEach(function (r, idx) {
            var row = ws.getRow(FIRST + idx);
            row.values = cols.map(function (c) { return r[c.k]; });
            row.eachCell({ includeEmpty: true }, function (cell, n) {
                var c = cols[n - 1];
                cell.border = border;
                cell.alignment = { vertical: 'top', wrapText: true, horizontal: c.a || 'left' };
                if (c.int) cell.numFmt = '#,##0';
            });
        });

        // Baris Total di bagian bawah tabel excel
        var totalExcelRow = ws.getRow(LAST + 1);
        totalExcelRow.values = [null, 'TOTAL KESELURUHAN', { formula: 'SUM(C' + FIRST + ':C' + LAST + ')', result: sum.pns }, { formula: 'SUM(D' + FIRST + ':D' + LAST + ')', result: sum.pppk }, { formula: 'SUM(E' + FIRST + ':E' + LAST + ')', result: sum.seluruh }];
        totalExcelRow.height = 24;
        totalExcelRow.eachCell({ includeEmpty: true }, function (cell, n) {
            cell.border = border;
            cell.font = { bold: true };
            cell.alignment = { vertical: 'middle', horizontal: n === 2 ? 'right' : 'center' };
            if (n >= 3) cell.numFmt = '#,##0';
        });

        ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_Data_ASN_' + tglFile + '.xlsx';
        document.body.appendChild(a);
        a.click();
        a.remove();
        setTimeout(function () { URL.revokeObjectURL(url); }, 1500);
    } catch (err) {
        console.error(err);
        Swal.fire({ icon: 'error', title: 'Gagal membuat Excel', text: 'Terjadi kesalahan saat menyusun file. Silakan coba lagi.', confirmButtonColor: '#163a63' });
    } finally {
        btn.disabled = false;
        btn.innerHTML = oldHtml;
    }
}
document.getElementById('btnExportExcel').addEventListener('click', exportRekapExcel);
</script>
@endpush