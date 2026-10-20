@extends('layouts.dashboard')

@section('title', 'Kelola Dokumen Publik')

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
    .page-head-text h1 { font-family: var(--font-display); font-weight: 700; font-size: clamp(1.6rem, 3vw, 2.1rem); line-height: 1.2; letter-spacing: -.02em; margin-bottom: 5px; color: var(--ink); }
    .page-head-text p { color: var(--steel); font-size: .95rem; margin-bottom: 0; }
    
    .btn-add, .btn-excel { display: inline-flex; align-items: center; gap: 8px; height: 44px; padding: 0 20px; border-radius: 8px; font-size: .9rem; font-weight: 600; transition: all .2s; border: none; text-decoration: none; cursor: pointer; }
    .btn-add { background: var(--success); color: #fff; }
    .btn-add:hover { background: #146c43; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, .15); color: #fff; }
    .btn-excel { background: #fff; color: #1d6f42; border: 1.5px solid #1d6f42; }
    .btn-excel:hover { background: #1d6f42; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(29, 111, 66, .18); }
    .btn-excel[disabled] { opacity: .6; cursor: wait; transform: none; box-shadow: none; }

    /* ---------- Penghitung Statistik Dinamis Kategori Dokumen Publik ---------- */
    .rekap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .rekap-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 16px 18px; box-shadow: var(--shadow-xs); border-left-width: 4px; }
    .rekap-ico { flex: none; width: 42px; height: 42px; border-radius: 10px; display: grid; place-items: center; font-size: 1.05rem; }
    .rekap-num { font-family: var(--font-display); font-weight: 700; font-size: 1.7rem; line-height: 1; color: var(--ink); }
    .rekap-label { font-size: .74rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--steel-soft); margin-top: 4px; }
    .rekap-sub { font-size: .72rem; color: var(--steel); margin-top: 2px; }
    
    .rekap-total   { border-left-color: var(--ink); }
    .rekap-total   .rekap-ico { background: rgba(13, 27, 42, .08); color: var(--ink); }
    .rekap-renstra { border-left-color: #2563eb; }
    .rekap-renstra .rekap-ico { background: rgba(37, 99, 235, .12); color: #2563eb; }
    .rekap-renja   { border-left-color: #10b981; }
    .rekap-renja   .rekap-ico { background: rgba(16, 185, 129, .12); color: #10b981; }
    .rekap-spm     { border-left-color: #d97706; }
    .rekap-spm     .rekap-ico { background: rgba(244, 183, 64, .15); color: #d97706; }
    .rekap-sakip   { border-left-color: #8b5cf6; }
    .rekap-sakip   .rekap-ico { background: rgba(139, 92, 246, .12); color: #8b5cf6; }
    .rekap-lppd    { border-left-color: #e5383b; }
    .rekap-lppd    .rekap-ico { background: rgba(229, 56, 59, .12); color: #e5383b; }

    .base-card { background: #ffffff; border: 1px solid var(--line); border-radius: var(--r-md); padding: 26px; box-shadow: var(--shadow-xs); transition: box-shadow .2s ease; overflow: hidden; }
    .base-card:hover { box-shadow: var(--shadow-sm); }
    
    .card-title-custom {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 22px; padding-bottom: 14px; border-bottom: 1px solid var(--line);
        font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--ink);
        flex-wrap: wrap; gap: 12px;
    }
    .card-title-custom .title-left { display: flex; align-items: center; gap: 10px; }
    .card-title-custom .title-left::before { content: ""; width: 4px; height: 18px; background: var(--navy); border-radius: 4px; }
    
    .table-responsive { border-radius: var(--r-sm); border: 1px solid var(--line); overflow: hidden; }
    .table { margin-bottom: 0; font-size: .92rem; }
    .table thead th { background: var(--paper); color: var(--steel); font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; border-bottom: 1px solid var(--line-dark); padding: 14px 16px; }
    .table tbody td { padding: 14px 16px; vertical-align: middle; border-bottom: 1px solid var(--line); color: var(--ink); }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr:hover { background-color: var(--navy-soft); }
    
    .badge-kategori { display: inline-flex; align-items: center; padding: 5px 12px; border-radius: 6px; font-size: .75rem; font-weight: 700; text-transform: uppercase; background: var(--navy-soft); color: var(--navy); }
    
    .form-label { font-size: .88rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .form-control, .form-select { min-height: 44px; font-size: .92rem; border: 1px solid var(--line-dark); border-radius: 8px; color: var(--ink); box-shadow: none; transition: all .2s ease; }
    .form-control:focus, .form-select:focus { border-color: var(--navy); box-shadow: 0 0 0 3px var(--navy-soft); }
    .form-control::file-selector-button { background: var(--paper); color: var(--ink); border: none; border-right: 1px solid var(--line-dark); padding: 0 16px; margin-right: 12px; height: 100%; font-weight: 600; transition: background .2s; }
    .form-control::file-selector-button:hover { background: var(--line); }
    
    .btn-action-group { display: flex; align-items: center; justify-content: center; gap: 6px; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 6px; border: none; font-size: .9rem; transition: all .2s ease; cursor: pointer; text-decoration: none; }
    .btn-icon.edit { background: var(--info-soft); color: var(--info); }
    .btn-icon.edit:hover { background: var(--info); color: #fff; }
    .btn-icon.delete { background: var(--signal-soft); color: var(--signal-dark); }
    .btn-icon.delete:hover { background: var(--signal); color: #fff; }
    
    .modal-content { border: none; border-radius: var(--r-md); box-shadow: var(--shadow-lg); }
    .modal-header { border-bottom: 1px solid var(--line); padding: 20px 24px; }
    .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.2rem; }
    .modal-body { padding: 24px; }
    .modal-footer { border-top: 1px solid var(--line); padding: 16px 24px; background: var(--paper); border-radius: 0 0 var(--r-md) var(--r-md); }
    
    @media (max-width: 700px) {
        .base-card { padding: 20px; }
        .card-title-custom { flex-direction: column; align-items: flex-start; gap: 14px; }
    }
</style>
@endpush

@section('content')
@php
    use App\Models\DokumenPublik;

    $listDokumen = $dokumens instanceof \Illuminate\Pagination\LengthAwarePaginator
        ? $dokumens->getCollection()
        : collect($dokumens ?? []);

    $daftarKategori = [
        'Renstra' => ['label' => 'Renstra', 'class' => 'rekap-renstra', 'icon' => 'fa-book'],
        'Renja'   => ['label' => 'Renja',   'class' => 'rekap-renja',   'icon' => 'fa-calendar-alt'],
        'SPM'     => ['label' => 'SPM',     'class' => 'rekap-spm',     'icon' => 'fa-clipboard-check'],
        'SAKIP'   => ['label' => 'SAKIP',   'class' => 'rekap-sakip',   'icon' => 'fa-chart-line'],
        'LPPD'    => ['label' => 'LPPD',    'class' => 'rekap-lppd',    'icon' => 'fa-file-invoice'],
    ];

    $barisExcel = $listDokumen->values()->map(function ($item, $index) {
        $getValue = function ($key, $default = '') use ($item) {
            if (is_array($item)) {
                return $item[$key] ?? $default;
            }
            return data_get($item, $key, $default);
        };

        $namaFile = $getValue('nama_file', '');

        return [
            'no'        => $index + 1,
            'id'        => $getValue('id'),
            'judul'     => (string) $getValue('judul_dokumen', ''),
            'kategori'  => (string) $getValue('kategori', 'Umum'),
            'nama_file' => (string) $namaFile,
            'file_url'  => $namaFile ? asset('storage/' . ltrim($namaFile, '/')) : '',
        ];
    })->all();

    $totalDokumen = count($barisExcel);
    $hitungKategori = [];

    foreach ($daftarKategori as $kategori => $config) {
        $hitungKategori[$kategori] = collect($barisExcel)
            ->filter(fn($item) => strcasecmp(trim($item['kategori']), trim($kategori)) === 0)
            ->count();
    }

    $rekapData = [
        'rows' => $barisExcel,
        'sum'  => array_merge(['total' => $totalDokumen], $hitungKategori),
        'per_kategori' => collect($daftarKategori)->map(fn($config, $kategori) => [
            'nama'   => $kategori,
            'jumlah' => $hitungKategori[$kategori] ?? 0,
        ])->values()->all(),
    ];
@endphp

        <div class="page-head">
            <div class="page-head-text">
                <h1>Kelola Dokumen Publik</h1>
                <p>Manajemen file dokumen publik (Renstra, Renja, SPM, SAKIP, dan LPPD)[cite: 10].</p>
            </div>
            
            <div class="d-flex gap-2 flex-wrap">
                @hasanyrole('Super User|Sekretariat|Operator')
                <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus"></i> Tambah Dokumen
                </button>
                @endhasanyrole

                <button type="button" id="btnExportExcel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Rekap Excel
                </button>
            </div>
        </div>

        <!-- REKAP GRID STATISTIK DINAMIS KATEGORI -->
        <div class="rekap-grid">
            <div class="rekap-item rekap-total">
                <div class="rekap-ico"><i class="fas fa-folder-open"></i></div>
                <div>
                    <div class="rekap-num">{{ $totalDokumen }}</div>
                    <div class="rekap-label">Total Dokumen</div>
                    <div class="rekap-sub">Terpublikasi di sistem</div>
                </div>
            </div>

            @foreach($daftarKategori as $key => $info)
            <div class="rekap-item {{ $info['class'] }}">
                <div class="rekap-ico"><i class="fas {{ $info['icon'] }}"></i></div>
                <div>
                    <div class="rekap-num">{{ $hitungKategori[$key] }}</div>
                    <div class="rekap-label">{{ $info['label'] }}</div>
                    <div class="rekap-sub">Kategori Publik</div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tabel Data & Filter -->
        <div class="base-card">
            <div class="card-title-custom">
                <div class="title-left">Daftar Dokumen Publik Terpublikasi</div>
                
                <form method="GET" action="{{ route('dokumen-publik.index') }}" class="d-flex align-items-center">
                    <select name="kategori" class="form-select form-select-sm" style="min-width: 220px;" onchange="this.form.submit()">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($daftarKategori as $key => $info)
                            <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul Dokumen</th>
                            <th width="20%">Kategori</th>
                            <th width="25%">File</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listDokumen as $index => $item)
                        @php
                            $itemId   = data_get($item, 'id');
                            $judul    = data_get($item, 'judul_dokumen', '-');
                            $kategori = data_get($item, 'kategori', 'Umum');
                            $namaFile = data_get($item, 'nama_file', '');
                        @endphp

                        <tr>
                            <td>{{ (isset($dokumens) && method_exists($dokumens, 'firstItem') && $dokumens->firstItem()) ? (int) $dokumens->firstItem() + $index : $index + 1 }}</td>
                            <td><strong>{{ $judul }}</strong></td>
                            <td><span class="badge-kategori">{{ $kategori }}</span></td>
                            <td>
                                @if ($namaFile)
                                    <a href="{{ route('publik.dokumen-publik.download', $itemId) }}" target="_blank" class="text-primary text-decoration-none">
                                        <i class="fas fa-download me-1"></i> Unduh File
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @hasanyrole('Super User|Sekretariat|Operator')
                                <div class="btn-action-group justify-content-center">
                                    <button type="button" class="btn-icon edit" title="Edit Data"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $itemId }}">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <form action="{{ route('dokumen-publik.destroy', $itemId) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon delete" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                                @else
                                    <span class="text-muted" style="font-size: .8rem;"><i>Tidak ada akses</i></span>
                                @endhasanyrole
                            </td>
                        </tr>

                        <!-- MODAL EDIT DATA PER ITEM -->
                        @hasanyrole('Super User|Sekretariat|Operator')
                        <div class="modal fade" id="modalEdit{{ $itemId }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $itemId }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $itemId }}">Edit Dokumen Publik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('dokumen-publik.update', $itemId) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body text-start">
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Judul Dokumen</label>
                                                <input type="text" name="judul_dokumen" class="form-control" value="{{ $judul }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select name="kategori" class="form-select" required>
                                                    @foreach($daftarKategori as $key => $info)
                                                        <option value="{{ $key }}" {{ $kategori == $key ? 'selected' : '' }}>{{ $key }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Ganti File (Opsional)</label>
                                                <input type="file" name="nama_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                                <small class="text-muted mt-1 d-block">Format: PDF, DOC, DOCX, Gambar. Maksimal 10MB.</small>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                                            <button type="submit" class="btn-primary-custom">
                                                <i class="fas fa-save"></i> Perbarui Dokumen
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole

                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: var(--steel-soft);"></i><br>
                                Belum ada data dokumen publik yang tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if(isset($dokumens) && method_exists($dokumens, 'links'))
                <div class="mt-4">
                    {{ $dokumens->withQueryString()->links() }}
                </div>
            @endif
        </div>

<!-- ==================== MODAL TAMBAH DATA ==================== -->
@hasanyrole('Super User|Sekretariat|Operator')
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Dokumen Publik Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dokumen-publik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-start">
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Dokumen</label>
                        <input type="text" name="judul_dokumen" class="form-control" placeholder="Contoh: Renstra Dinas Tahun 2026-2031" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            @foreach($daftarKategori as $key => $info)
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Upload File Dokumen</label>
                        <input type="file" name="nama_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                        <small class="text-muted mt-1 d-block">Format: PDF, DOC, DOCX, Gambar. Maksimal ukuran file 10MB.</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal" style="min-height: 44px; border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save"></i> Simpan Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endhasanyrole
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
<script>
var REKAP = @json($rekapData);

function rekapKolomDokumenPublik() {
    return [
        { k: 'no',       t: 'No',          w: 6,  a: 'center', int: true },
        { k: 'judul',    t: 'Judul Dokumen', w: 42 },
        { k: 'kategori', t: 'Kategori',    w: 22, a: 'center' },
        { k: 'file_url', t: 'Tautan Unduh', w: 35 }
    ];
}

async function exportRekapExcel() {
    var btn = document.getElementById('btnExportExcel');

    if (typeof ExcelJS === 'undefined') {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library Excel belum termuat. Periksa koneksi internet lalu muat ulang halaman.', confirmButtonColor: '#163a63' });
        return;
    }
    if (!REKAP.rows.length) {
        Swal.fire({ icon: 'info', title: 'Tidak ada data', text: 'Belum ada dokumen publik untuk direkap.', confirmButtonColor: '#163a63' });
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

        var rows  = REKAP.rows;
        var sum   = REKAP.sum;
        var HEAD  = 5;
        var FIRST = HEAD + 1;
        var cols  = rekapKolomDokumenPublik();
        var NCOL  = cols.length;
        var LAST  = HEAD + Math.max(rows.length, 1);
        var katIdx = cols.map(function (c) { return c.k; }).indexOf('kategori') + 1;

        var ws = wb.addWorksheet('Dokumen Publik', {
            views: [{ state: 'frozen', ySplit: HEAD, xSplit: 2 }],
            pageSetup: { paperSize: 9, orientation: 'portrait', fitToPage: true, fitToWidth: 1, fitToHeight: 0 }
        });
        cols.forEach(function (c, i) { ws.getColumn(i + 1).width = c.w; });

        ws.mergeCells(1, 1, 1, NCOL);
        ws.getCell('A1').value = 'REKAPITULASI DOKUMEN PUBLIK (RENSTRA, RENJA, SPM, SAKIP, LPPD)';
        ws.getCell('A1').font = { name: 'Calibri', size: 14, bold: true, color: { argb: NAVY } };
        ws.getCell('A1').alignment = { vertical: 'middle', horizontal: 'left' };
        ws.getRow(1).height = 26;

        ws.mergeCells(2, 1, 2, NCOL);
        ws.getCell('A2').value = 'Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi';
        ws.getCell('A2').font = { size: 11, bold: true };

        ws.mergeCells(3, 1, 3, NCOL);
        ws.getCell('A3').value = 'Dicetak: ' + tglCetak + '   |   Total Dokumen: ' + sum.total;
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
                if (c.k === 'file_url' && r.file_url) {
                    cell.value = { text: 'Unduh Berkas', hyperlink: r.file_url };
                    cell.font = { color: { argb: 'FF0000FF' }, underline: true };
                }
            });
        });

        ws.autoFilter = { from: { row: HEAD, column: 1 }, to: { row: LAST, column: NCOL } };

        var katLetter = ws.getColumn(katIdx).letter;
        var rngKat = "'Dokumen Publik'!$" + katLetter + '$' + FIRST + ':$' + katLetter + '$' + LAST;

        var sm = wb.addWorksheet('Ringkasan Kategori');
        sm.getColumn(1).width = 8;
        sm.getColumn(2).width = 30;
        sm.getColumn(3).width = 18;

        sm.mergeCells('A1:C1');
        sm.getCell('A1').value = 'RINGKASAN DOKUMEN PUBLIK BERDASARKAN KATEGORI';
        sm.getCell('A1').font = { size: 14, bold: true, color: { argb: NAVY } };
        sm.getCell('A2').value = 'Per ' + tglCetak;
        sm.getCell('A2').font = { italic: true, color: { argb: 'FF64748B' } };

        var headSm = sm.getRow(4);
        ['No', 'Kategori Dokumen', 'Jumlah Dokumen'].forEach(function (t, i) { headSm.getCell(i + 1).value = t; });
        headSm.eachCell(function (c) {
            c.font = { bold: true, color: { argb: 'FFFFFFFF' } };
            c.fill = fillOf(NAVY);
            c.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
            c.border = border;
        });
        headSm.height = 26;

        REKAP.per_kategori.forEach(function (item, i) {
            var r = 5 + i;
            var rw = sm.getRow(r);
            rw.getCell(1).value = i + 1;
            rw.getCell(2).value = item.nama;
            rw.getCell(3).value = { formula: 'COUNTIF(' + rngKat + ',"' + item.nama + '")', result: item.jumlah };
            for (var n = 1; n <= 3; n++) {
                var c = rw.getCell(n);
                c.border = border;
                c.alignment = { vertical: 'middle', horizontal: n === 2 ? 'left' : 'center' };
                if (n === 3) c.numFmt = '#,##0';
            }
        });

        var endKatRow = 4 + REKAP.per_kategori.length;
        var totalRow = sm.getRow(endKatRow + 1);
        totalRow.getCell(1).value = '';
        totalRow.getCell(2).value = 'TOTAL KESELURUHAN';
        totalRow.getCell(3).value = {
            formula: endKatRow >= 5 ? 'SUM(C5:C' + endKatRow + ')' : '0',
            result: sum.total
        };
        for (var n = 1; n <= 3; n++) {
            var tc = totalRow.getCell(n);
            tc.font = { bold: true };
            tc.border = border;
            tc.alignment = { vertical: 'middle', horizontal: n === 2 ? 'left' : 'center' };
            if (n === 3) tc.numFmt = '#,##0';
        }

        var buf  = await wb.xlsx.writeBuffer();
        var blob = new Blob([buf], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
        var url  = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'Rekap_Dokumen_Publik_' + tglFile + '.xlsx';
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