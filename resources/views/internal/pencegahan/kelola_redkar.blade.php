@extends('layouts.dashboard')

@section('title', 'Kelola Redkar')

@push('styles')
<style>
    /* =========================================================
       KELOLA REDKAR — gaya khusus halaman
       Memakai variabel warna dari layouts.dashboard (dengan fallback)
       ========================================================= */
    .rk {
        --rk-ink: var(--ink, #0d1b2a);
        --rk-navy: var(--navy, #1b365d);
        --rk-steel: var(--steel, #4a5a6e);
        --rk-muted: var(--steel-soft, #7b8a9c);
        --rk-line: var(--line, #e4e9f0);
        --rk-paper: var(--paper, #f6f8fb);
        --rk-red: var(--signal, #e5383b);
        --rk-red-soft: var(--signal-soft, #fdeaea);
        --rk-green: var(--success, #10b981);
        --rk-green-soft: #e3f7ef;
        --rk-amber: #b7791f;
        --rk-amber-soft: #fdf3dc;
        --rk-blue: var(--info, #2563eb);
        --rk-blue-soft: var(--info-soft, #e6eefd);
    }

    /* ---------- Header halaman ---------- */
    .rk-hero {
        position: relative;
        display: flex; align-items: center; justify-content: space-between;
        gap: 20px; flex-wrap: wrap;
        padding: 28px 32px;
        margin-bottom: 20px;
        border-radius: 20px;
        color: #fff;
        background:
            radial-gradient(520px 220px at 100% 0%, rgba(229, 56, 59, .38), transparent 70%),
            linear-gradient(120deg, var(--rk-ink) 0%, var(--rk-navy) 100%);
        overflow: hidden;
    }
    .rk-hero::after {
        content: ""; position: absolute; right: -40px; bottom: -70px;
        width: 220px; height: 220px; border-radius: 50%;
        border: 28px solid rgba(255, 255, 255, .05);
        pointer-events: none;
    }
    .rk-hero-head {
        display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
        margin-bottom: 6px;
    }
    .rk-hero h1 {
        font-family: var(--font-display, inherit);
        font-weight: 700; letter-spacing: -.02em; line-height: 1.2;
        font-size: clamp(1.45rem, 2.6vw, 1.95rem);
        margin: 0;
    }
    .rk-hero-badge {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 5px 14px; border-radius: 999px;
        background: rgba(255, 255, 255, .14);
        border: 1px solid rgba(255, 255, 255, .24);
        color: #fff; font-size: .82rem; font-weight: 600;
        backdrop-filter: blur(4px);
    }
    .rk-hero-badge b { font-size: .92rem; font-weight: 800; color: #fff; }
    .rk-hero p { margin: 0; color: rgba(255, 255, 255, .72); font-size: .94rem; max-width: 52ch; }
    .rk-hero-actions { display: flex; gap: 10px; flex-wrap: wrap; position: relative; z-index: 1; }

    .rk-btn {
        display: inline-flex; align-items: center; gap: 9px;
        height: 44px; padding: 0 20px; border-radius: 12px;
        font-size: .9rem; font-weight: 600; text-decoration: none;
        border: 1px solid transparent; cursor: pointer;
        transition: transform .15s ease, box-shadow .2s ease, background .2s ease;
    }
    .rk-btn:focus-visible { outline: 3px solid rgba(255, 255, 255, .6); outline-offset: 2px; }
    .rk-btn:active { transform: translateY(1px); }
    .rk-btn-primary { background: var(--rk-green); color: #fff; box-shadow: 0 6px 16px rgba(16, 185, 129, .3); }
    .rk-btn-primary:hover { background: #0e9f6e; color: #fff; transform: translateY(-1px); }
    .rk-btn-ghost { background: rgba(255, 255, 255, .1); color: #fff; border-color: rgba(255, 255, 255, .25); backdrop-filter: blur(4px); }
    .rk-btn-ghost:hover { background: rgba(255, 255, 255, .2); color: #fff; }

    /* ---------- Panel daftar ---------- */
    .rk-panel { background: #fff; border: 1px solid var(--rk-line); border-radius: 20px; overflow: hidden; }
    .rk-toolbar {
        display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
        padding: 16px 20px; border-bottom: 1px solid var(--rk-line);
    }
    .rk-search { position: relative; flex: 1 1 260px; max-width: 420px; }
    .rk-search i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--rk-muted); font-size: .85rem; pointer-events: none; }
    .rk-input, .rk-select {
        width: 100%; height: 42px; border-radius: 12px;
        border: 1px solid var(--rk-line); background: var(--rk-paper);
        font-size: .9rem; color: var(--rk-ink);
        transition: border-color .2s, box-shadow .2s, background .2s;
    }
    .rk-input { padding: 0 14px 0 38px; }
    .rk-select { padding: 0 34px 0 14px; width: auto; min-width: 180px; cursor: pointer; }
    .rk-input:focus, .rk-select:focus {
        outline: none; background: #fff;
        border-color: var(--rk-navy); box-shadow: 0 0 0 4px rgba(27, 54, 93, .12);
    }
    .rk-count { margin-left: auto; font-size: .85rem; color: var(--rk-muted); }
    .rk-count b { color: var(--rk-ink); }

    /* ---------- Tabel ---------- */
    .rk-table { width: 100%; border-collapse: separate; border-spacing: 0; margin: 0; }
    .rk-table thead th {
        position: sticky; top: 0;
        padding: 12px 20px; background: var(--rk-paper);
        font-size: .76rem; font-weight: 700; letter-spacing: .03em;
        color: var(--rk-muted); border-bottom: 1px solid var(--rk-line);
        white-space: nowrap;
    }
    .rk-table tbody td {
        padding: 14px 20px; vertical-align: middle;
        border-bottom: 1px solid var(--rk-line);
        font-size: .9rem; color: var(--rk-ink);
    }
    .rk-table tbody tr { transition: background .15s ease; }
    .rk-table tbody tr:hover { background: #f9fbfd; }
    .rk-table tbody tr:last-child td { border-bottom: none; }

    .rk-person { display: flex; align-items: center; gap: 12px; min-width: 220px; }
    .rk-avatar {
        flex: none; width: 42px; height: 42px; border-radius: 50%;
        display: grid; place-items: center;
        font-weight: 700; font-size: .88rem; color: var(--rk-navy);
        background: #e7edf6;
    }
    .rk-person strong { display: block; font-weight: 600; line-height: 1.3; }
    .rk-person small { display: block; color: var(--rk-muted); font-size: .78rem; }
    .rk-nik { font-variant-numeric: tabular-nums; letter-spacing: .01em; color: var(--rk-steel); }

    .rk-chip {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 11px; border-radius: 999px;
        background: var(--rk-blue-soft); color: var(--rk-navy);
        font-size: .8rem; font-weight: 600; white-space: nowrap;
    }
    .rk-chip i { font-size: .7rem; opacity: .7; }

    .rk-wa {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 6px 12px; border-radius: 10px;
        background: var(--rk-green-soft); color: #0b7a56;
        font-size: .84rem; font-weight: 600; text-decoration: none;
        transition: background .2s, color .2s;
    }
    .rk-wa:hover { background: #0e9f6e; color: #fff; }

    .rk-badge { display: inline-flex; align-items: center; gap: 6px; font-size: .8rem; font-weight: 600; white-space: nowrap; }
    .rk-badge.ok { color: #0b7a56; }
    .rk-badge.none { color: var(--rk-muted); font-weight: 500; }
    .rk-badge a { color: inherit; text-decoration: none; padding: 5px 11px; border-radius: 10px; background: var(--rk-green-soft); transition: background .2s, color .2s; }
    .rk-badge a:hover { background: #0e9f6e; color: #fff; }

    /* Tombol aksi: ikon bulat, label muncul lewat tooltip */
    .rk-actions { display: flex; justify-content: flex-end; gap: 6px; }
    .rk-icon-btn {
        position: relative; width: 36px; height: 36px; border-radius: 10px;
        display: grid; place-items: center; font-size: .85rem;
        border: none; cursor: pointer; text-decoration: none;
        transition: background .2s, color .2s, transform .15s;
    }
    .rk-icon-btn:hover { transform: translateY(-2px); }
    .rk-icon-btn:focus-visible { outline: 3px solid rgba(27, 54, 93, .35); outline-offset: 2px; }
    .rk-icon-btn.edit  { background: var(--rk-amber-soft); color: var(--rk-amber); }
    .rk-icon-btn.edit:hover  { background: var(--rk-amber); color: #fff; }
    .rk-icon-btn.print { background: var(--rk-blue-soft); color: var(--rk-blue); }
    .rk-icon-btn.print:hover { background: var(--rk-blue); color: #fff; }
    .rk-icon-btn.del   { background: var(--rk-red-soft); color: var(--rk-red); }
    .rk-icon-btn.del:hover   { background: var(--rk-red); color: #fff; }
    .rk-icon-btn::after {
        content: attr(data-tip);
        position: absolute; bottom: calc(100% + 8px); left: 50%;
        transform: translate(-50%, 4px);
        padding: 4px 9px; border-radius: 8px;
        background: var(--rk-ink); color: #fff;
        font-size: .72rem; font-weight: 600; white-space: nowrap;
        opacity: 0; pointer-events: none;
        transition: opacity .15s, transform .15s;
    }
    .rk-icon-btn:hover::after, .rk-icon-btn:focus-visible::after { opacity: 1; transform: translate(-50%, 0); }
    .rk-inline-form { display: inline; margin: 0; }

    /* ---------- Kosong ---------- */
    .rk-empty { text-align: center; padding: 56px 20px; color: var(--rk-muted); }
    .rk-empty-ico {
        width: 68px; height: 68px; margin: 0 auto 14px; border-radius: 50%;
        display: grid; place-items: center; font-size: 1.5rem;
        background: var(--rk-paper); color: var(--rk-muted);
    }
    .rk-empty h3 { font-size: 1.05rem; color: var(--rk-ink); margin-bottom: 4px; font-weight: 700; }
    .rk-empty p { margin: 0 0 16px; font-size: .9rem; }
    .rk-empty .rk-btn-primary { box-shadow: none; }
    #rk-no-result { display: none; }

    .rk-pagination { padding: 14px 20px; border-top: 1px solid var(--rk-line); }

    /* ---------- Responsif ---------- */
    @media (max-width: 900px) {
        .rk-count { margin-left: 0; width: 100%; }
    }
    @media (max-width: 768px) {
        .rk-hero { padding: 22px 20px; border-radius: 18px; }
        .rk-hero-actions { width: 100%; }
        .rk-hero-actions .rk-btn { flex: 1 1 auto; justify-content: center; }
        .rk-search { max-width: none; }
        .rk-select { width: 100%; }

        /* tabel berubah jadi kartu */
        .rk-table thead { display: none; }
        .rk-table, .rk-table tbody, .rk-table tr, .rk-table td { display: block; width: 100%; }
        .rk-table tbody tr { padding: 16px; border-bottom: 8px solid var(--rk-paper); }
        .rk-table tbody tr:last-child { border-bottom: none; }
        .rk-table tbody td { padding: 6px 0; border: none; }
        .rk-table tbody td[data-label]::before {
            content: attr(data-label);
            display: block; margin-bottom: 2px;
            font-size: .72rem; font-weight: 700; letter-spacing: .03em;
            color: var(--rk-muted);
        }
        .rk-table tbody td.rk-cell-person::before,
        .rk-table tbody td.rk-cell-actions::before { display: none; }
        .rk-table tbody td.rk-cell-actions { padding-top: 12px; margin-top: 8px; border-top: 1px dashed var(--rk-line); }
        .rk-actions { justify-content: flex-start; }
        .rk-icon-btn { width: 42px; height: 42px; }
        .rk-icon-btn::after { display: none; }
    }

    @media (prefers-reduced-motion: reduce) {
        .rk * { transition: none !important; }
    }
</style>
@endpush

@section('content')
@php
    $totalRelawan    = $relawan->count();
    $daftarKecamatan = $relawan->pluck('kecamatan')->filter()->unique()->sort()->values();
@endphp

<div class="rk">

    {{-- ===== Header (Perhitungan jumlah data dimasukkan di sini) ===== --}}
    <div class="rk-hero">
        <div>
            <div class="rk-hero-head">
                <h1>Data Relawan Pemadam Kebakaran</h1>
                <span class="rk-hero-badge">
                    <i class="fas fa-users"></i>
                    <b>{{ $totalRelawan }}</b> Relawan Terdaftar
                </span>
            </div>
        </div>
        <div class="rk-hero-actions">
            {{-- Tambah: hanya Pencegahan & Super User --}}
            @hasanyrole('Pencegahan|Super User')
            <a href="/internal/pencegahan/tambah-redkar" class="rk-btn rk-btn-primary">
                <i class="fas fa-user-plus"></i> Tambah relawan
            </a>
            @endhasanyrole

            {{-- Cetak Rekap Excel: semua role --}}
            @if($totalRelawan > 0)
            <button type="button" onclick="exportRekapExcel()" class="rk-btn rk-btn-ghost">
                <i class="fas fa-file-excel"></i> Cetak Rekap Excel
            </button>
            @endif
        </div>
    </div>

    {{-- ===== Notifikasi setelah simpan / ubah / hapus ===== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 14px;">
            <i class="fas fa-check-circle"></i> <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 14px;">
            <i class="fas fa-exclamation-triangle"></i> <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- ===== Daftar ===== --}}
    <div class="rk-panel">

        @if($totalRelawan > 0)
        <div class="rk-toolbar">
            <label class="rk-search">
                <i class="fas fa-search"></i>
                <input type="search" id="rk-search" class="rk-input" placeholder="Cari nama, NIK, atau nomor telepon" autocomplete="off" aria-label="Cari relawan">
            </label>
            <select id="rk-kecamatan" class="rk-select" aria-label="Filter kecamatan">
                <option value="">Semua kecamatan</option>
                @foreach($daftarKecamatan as $kec)
                    <option value="{{ strtolower($kec) }}">{{ $kec }}</option>
                @endforeach
            </select>
            <div class="rk-count" aria-live="polite">Menampilkan <b id="rk-shown">{{ $totalRelawan }}</b> dari {{ $totalRelawan }} relawan</div>
        </div>
        @endif

        <div class="table-responsive">
            <table class="rk-table">
                <thead>
                    <tr>
                        <th>Relawan</th>
                        <th>NIK</th>
                        <th>Kecamatan</th>
                        <th>WhatsApp</th>
                        <th class="no-print-col">Berkas KTP</th>
                        <th class="no-print-col text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody id="rk-body">
                    @forelse($relawan as $r)
                    @php
                        $inisial = collect(preg_split('/\s+/', trim($r->nama_lengkap)))
                            ->filter()->take(2)
                            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                            ->implode('');
                        $punyaKtp = $r->file_ktp && $r->file_ktp !== 'offline_registered';
                    @endphp
                    <tr class="rk-row"
                        data-search="{{ strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp) }}"
                        data-kecamatan="{{ strtolower($r->kecamatan) }}">
                        <td class="rk-cell-person">
                            <div class="rk-person">
                                <div class="rk-avatar" aria-hidden="true">{{ $inisial }}</div>
                                <div>
                                    <strong>{{ $r->nama_lengkap }}</strong>
                                    <small>Diinput {{ $r->created_at->format('d M Y') }}, {{ $r->created_at->format('H:i') }} WIB</small>
                                </div>
                            </div>
                        </td>
                        <td data-label="NIK"><span class="rk-nik">{{ $r->nik }}</span></td>
                        <td data-label="Kecamatan">
                            <span class="rk-chip"><i class="fas fa-map-marker-alt"></i>{{ $r->kecamatan }}</span>
                        </td>
                        <td data-label="WhatsApp">
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $r->nomor_telp) }}" target="_blank" rel="noopener" class="rk-wa">
                                <i class="fab fa-whatsapp"></i> {{ $r->nomor_telp }}
                            </a>
                        </td>
                        <td data-label="Berkas KTP" class="no-print-col">
                            @if($punyaKtp)
                                <span class="rk-badge ok">
                                    <a href="/storage/{{ $r->file_ktp }}" target="_blank" rel="noopener">
                                        <i class="fas fa-id-card me-1"></i> Lihat KTP
                                    </a>
                                </span>
                            @else
                                <span class="rk-badge none"><i class="fas fa-minus-circle"></i> Belum ada</span>
                            @endif
                        </td>
                        <td class="rk-cell-actions no-print-col">
                            <div class="rk-actions">
                                {{-- Edit: hanya Pencegahan & Super User --}}
                                @hasanyrole('Pencegahan|Super User')
                                <a href="/internal/pencegahan/edit-redkar/{{ $r->id }}" class="rk-icon-btn edit" data-tip="Edit data" aria-label="Edit data {{ $r->nama_lengkap }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @endhasanyrole

                                {{-- Cetak PDF per orang: semua role --}}
                                <a href="/internal/pencegahan/cetak-redkar/{{ $r->id }}" target="_blank" rel="noopener" class="rk-icon-btn print" data-tip="Cetak PDF" aria-label="Cetak PDF {{ $r->nama_lengkap }}">
                                    <i class="fas fa-print"></i>
                                </a>

                                {{-- Hapus: hanya Pencegahan & Super User --}}
                                @hasanyrole('Pencegahan|Super User')
                                <form action="/internal/pencegahan/hapus-redkar/{{ $r->id }}" method="POST" class="rk-inline-form" onsubmit="return confirm('Yakin ingin menghapus data relawan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rk-icon-btn del" data-tip="Hapus" aria-label="Hapus data {{ $r->nama_lengkap }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endhasanyrole
                            </div>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Kondisi: belum ada data sama sekali --}}
        @if($totalRelawan === 0)
        <div class="rk-empty">
            <div class="rk-empty-ico"><i class="fas fa-folder-open"></i></div>
            <h3>Belum ada relawan terdaftar</h3>
            <p>Data relawan REDKAR akan muncul di sini setelah ditambahkan.</p>
            @hasanyrole('Pencegahan|Super User')
            <a href="/internal/pencegahan/tambah-redkar" class="rk-btn rk-btn-primary">
                <i class="fas fa-user-plus"></i> Tambah relawan pertama
            </a>
            @endhasanyrole
        </div>
        @endif

        {{-- Kondisi: pencarian tidak menemukan hasil --}}
        <div class="rk-empty" id="rk-no-result">
            <div class="rk-empty-ico"><i class="fas fa-search"></i></div>
            <h3>Relawan tidak ditemukan</h3>
            <p>Coba kata kunci lain atau pilih "Semua kecamatan".</p>
        </div>

        @if(method_exists($relawan, 'links'))
        <div class="rk-pagination no-print-col">{{ $relawan->links() }}</div>
        @endif
    </div>

    {{-- ===== Tabel Tersembunyi Khusus Export Excel ===== --}}
    <table id="rk-excel-table" style="display: none;">
        <thead>
            <tr>
                <th colspan="15" style="font-size: 14pt; font-weight: bold; text-align: center;">REKAPITULASI DATA RELAWAN PEMADAM KEBAKARAN (REDKAR) KOTA JAMBI</th>
            </tr>
            <tr>
                <th colspan="15" style="text-align: center;">Total Terdaftar: {{ $totalRelawan }} Relawan | Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</th>
            </tr>
            <tr></tr>
            <tr style="background-color: #1b365d; color: #ffffff; font-weight: bold;">
                <th>No</th>
                <th>No. Register</th>
                <th>Tanggal Input</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Agama</th>
                <th>Status Perkawinan</th>
                <th>No. Telepon / WA</th>
                <th>Alamat Lengkap</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Pendidikan Terakhir</th>
                <th>Pekerjaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($relawan as $index => $r)
            <tr class="rk-excel-row"
                data-search="{{ strtolower($r->nama_lengkap . ' ' . $r->nik . ' ' . $r->nomor_telp) }}"
                data-kecamatan="{{ strtolower($r->kecamatan) }}">
                <td class="excel-no">{{ $index + 1 }}</td>
                <td>{{ $r->id }}</td>
                <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                <td style="mso-number-format:'\@';">{{ $r->nik }}</td>
                <td>{{ $r->nama_lengkap }}</td>
                <td>{{ $r->jenis_kelamin }}</td>
                <td>{{ $r->tempat_lahir }}, {{ \Carbon\Carbon::parse($r->tanggal_lahir)->format('d/m/Y') }}</td>
                <td>{{ $r->agama }}</td>
                <td>{{ $r->status_perkawinan }}</td>
                <td style="mso-number-format:'\@';">{{ $r->nomor_telp }}</td>
                <td>{{ $r->alamat }}, RT/RW {{ $r->rt_rw }}</td>
                <td>{{ $r->kecamatan }}</td>
                <td>{{ $r->kelurahan }}</td>
                <td>{{ $r->pendidikan_terakhir }} ({{ $r->latar_belakang_pendidikan }})</td>
                <td>{{ $r->pekerjaan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

@push('scripts')
<script>
    (function () {
        var search = document.getElementById('rk-search');
        var select = document.getElementById('rk-kecamatan');
        if (!search || !select) return;

        var rows      = Array.prototype.slice.call(document.querySelectorAll('.rk-row'));
        var excelRows = Array.prototype.slice.call(document.querySelectorAll('.rk-excel-row'));
        var shown     = document.getElementById('rk-shown');
        var empty     = document.getElementById('rk-no-result');

        function apply() {
            var q   = search.value.trim().toLowerCase();
            var kec = select.value;
            var n   = 0;

            rows.forEach(function (row, idx) {
                var ok = (!q || row.dataset.search.indexOf(q) > -1) &&
                         (!kec || row.dataset.kecamatan === kec);
                row.style.display = ok ? '' : 'none';
                
                if (excelRows[idx]) {
                    excelRows[idx].setAttribute('data-export', ok ? '1' : '0');
                }
                if (ok) n++;
            });

            shown.textContent = n;
            empty.style.display = n === 0 ? 'block' : 'none';
        }

        search.addEventListener('input', apply);
        select.addEventListener('change', apply);
    })();

    /* ---------- Fungsi Export ke Excel (.xls) ---------- */
    function exportRekapExcel() {
        var sourceTable = document.getElementById('rk-excel-table');
        if (!sourceTable) return;

        var clone = sourceTable.cloneNode(true);
        clone.style.display = 'table';

        // Hanya mengikutsertakan baris yang sesuai filter pencarian/kecamatan aktif
        var bodyRows = clone.querySelectorAll('tbody tr');
        var no = 1;
        bodyRows.forEach(function (tr) {
            if (tr.getAttribute('data-export') === '0') {
                tr.remove();
            } else {
                var noCell = tr.querySelector('.excel-no');
                if (noCell) noCell.textContent = no++;
            }
        });

        var html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" ' +
                   'xmlns:x="urn:schemas-microsoft-com:office:excel" ' +
                   'xmlns="http://www.w3.org/TR/REC-html40">' +
                   '<head><meta charset="UTF-8">' +
                   '<style>' +
                   'table { border-collapse: collapse; font-family: Arial, sans-serif; font-size: 10pt; }' +
                   'th, td { border: 1px solid #000000; padding: 6px 10px; vertical-align: middle; }' +
                   '</style></head><body>' +
                   clone.outerHTML +
                   '</body></html>';

        var blob = new Blob(['\ufeff', html], { type: 'application/vnd.ms-excel;charset=utf-8;' });
        var url  = URL.createObjectURL(blob);
        var link = document.createElement('a');
        var tgl  = new Date().toISOString().slice(0, 10);

        link.href = url;
        link.download = 'Rekap_Data_Relawan_REDKAR_' + tgl + '.xls';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }
</script>
@endpush