<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Bulanan Riwayat Aktivitas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            font-size: 10.5px;
            margin: 0;
            padding: 14px;
        }
        table.kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 14px;
        }
        table.kop-surat td {
            border: none;
            padding: 4px;
            vertical-align: middle;
        }
        .kop-logo {
            width: 15%;
            text-align: center;
        }
        .kop-logo img {
            width: 70px;
            height: auto;
        }
        .kop-teks {
            width: 70%;
            text-align: center;
            line-height: 1.3;
        }
        .kop-teks .pemerintah {
            font-size: 13px;
        }
        .kop-teks .dinas {
            font-size: 16px;
            font-weight: bold;
            margin: 3px 0;
        }
        .kop-teks .alamat {
            font-size: 10.5px;
        }
        .doc-title {
            text-align: center;
            margin-bottom: 14px;
        }
        .doc-title h3 {
            margin: 0 0 4px 0;
            font-size: 12.5px;
            text-transform: uppercase;
        }
        .doc-title p {
            margin: 0;
            font-size: 10.5px;
            font-weight: bold;
        }
        .section-label {
            margin: 14px 0 6px 0;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            color: #163a63;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            font-size: 9.5px;
        }
        table.data-table tfoot td {
            background-color: #f1f5f9;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold; }
        .meta-note {
            font-size: 9.5px;
            color: #334155;
            margin-bottom: 10px;
        }
        .ttd-container {
            width: 100%;
            margin-top: 24px;
            page-break-inside: avoid;
        }
        .ttd-box {
            float: right;
            width: 260px;
            text-align: center;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                @php
                    $jambiPath = public_path('images/jambi.png');
                    $jambiLogo = file_exists($jambiPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($jambiPath)) : '';
                @endphp
                @if($jambiLogo)
                    <img src="{{ $jambiLogo }}" alt="Logo Kota Jambi">
                @endif
            </td>
            <td class="kop-teks">
                <div class="pemerintah">PEMERINTAH KOTA JAMBI</div>
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN KOTA JAMBI</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
            </td>
            <td class="kop-logo">
                @php
                    $damkarPath = public_path('images/logo.png');
                    $damkarLogo = file_exists($damkarPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($damkarPath)) : '';
                @endphp
                @if($damkarLogo)
                    <img src="{{ $damkarLogo }}" alt="Logo Yudha Brama Jaya">
                @endif
            </td>
        </tr>
    </table>

    <div class="doc-title">
        <h3>REKAPITULASI BULANAN RIWAYAT AKTIVITAS SISTEM (SIMERAH KOJA)</h3>
        <p>{{ $labelTahun }} &bull; KATEGORI: {{ $labelKategori }}</p>
    </div>

    <div class="meta-note">
        Dicetak pada: {{ $printedAt }} WIB &bull; Total Keseluruhan: <strong>{{ number_format($recap['summary']['total_all']) }}</strong> aktivitas
        (Internal: <strong>{{ number_format($recap['summary']['total_internal']) }}</strong>, Permohonan Pemohon: <strong>{{ number_format($recap['summary']['total_pemohon']) }}</strong>)
    </div>

    @if($selectedCategory !== 'pemohon')
        <div class="section-label">A. Rekap Bulanan Aktivitas Internal Pegawai</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="16%">Periode</th>
                    <th width="9%">Tambah</th>
                    <th width="9%">Ubah</th>
                    <th width="9%">Hapus</th>
                    <th width="9%">Lainnya</th>
                    <th width="11%">Total</th>
                    <th>Modul Teratas</th>
                    <th width="12%">Sumber</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recap['monthly_internal'] as $index => $row)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $row['period_label'] }}</td>
                        <td class="text-right">{{ number_format($row['tambah']) }}</td>
                        <td class="text-right">{{ number_format($row['ubah']) }}</td>
                        <td class="text-right">{{ number_format($row['hapus']) }}</td>
                        <td class="text-right">{{ number_format($row['lainnya']) }}</td>
                        <td class="text-right fw-bold">{{ number_format($row['total']) }}</td>
                        <td>
                            @if(!empty($row['top_modules']))
                                {{ implode(', ', array_map(fn ($m) => "{$m['module']} ({$m['total']})", $row['top_modules'])) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">{{ $row['source'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada data aktivitas internal untuk filter ini.</td>
                    </tr>
                @endforelse
            </tbody>
            @if($recap['monthly_internal']->isNotEmpty())
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">TOTAL INTERNAL</td>
                        <td class="text-right">{{ number_format($recap['monthly_internal']->sum('tambah')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_internal']->sum('ubah')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_internal']->sum('hapus')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_internal']->sum('lainnya')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_internal']->sum('total')) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    @endif

    @if($selectedCategory !== 'internal')
        <div class="section-label">{{ $selectedCategory === 'pemohon' ? 'A.' : 'B.' }} Rekap Bulanan Permohonan Surat (Pemohon)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="18%">Periode</th>
                    <th width="10%">RPKBGL</th>
                    <th width="9%">SKK</th>
                    <th width="12%">Izin Keramaian</th>
                    <th width="12%">Sarana Damkar</th>
                    <th width="12%">Edukasi</th>
                    <th width="8%">Lainnya</th>
                    <th width="10%">Total</th>
                    <th width="12%">Sumber</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recap['monthly_pemohon'] as $index => $row)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $row['period_label'] }}</td>
                        <td class="text-right">{{ number_format($row['rpkbgl']) }}</td>
                        <td class="text-right">{{ number_format($row['skk']) }}</td>
                        <td class="text-right">{{ number_format($row['izin']) }}</td>
                        <td class="text-right">{{ number_format($row['sarana']) }}</td>
                        <td class="text-right">{{ number_format($row['edukasi']) }}</td>
                        <td class="text-right">{{ number_format($row['lainnya']) }}</td>
                        <td class="text-right fw-bold">{{ number_format($row['total']) }}</td>
                        <td class="text-center">{{ $row['source'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada data permohonan surat pemohon untuk filter ini.</td>
                    </tr>
                @endforelse
            </tbody>
            @if($recap['monthly_pemohon']->isNotEmpty())
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">TOTAL PEMOHON</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('rpkbgl')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('skk')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('izin')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('sarana')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('edukasi')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('lainnya')) }}</td>
                        <td class="text-right">{{ number_format($recap['monthly_pemohon']->sum('total')) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    @endif

    <div class="section-label">Rincian Aktivitas Per Modul &amp; Layanan</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Periode</th>
                <th width="18%">Kategori</th>
                <th>Modul / Layanan</th>
                <th width="11%">Aksi</th>
                <th width="10%">Arsip</th>
                <th width="10%">Live</th>
                <th width="10%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recap['module_details'] as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $detail['period_label'] }}</td>
                    <td>{{ $detail['category_label'] }}</td>
                    <td>{{ $detail['module'] }}</td>
                    <td class="text-center">{{ $detail['action'] }}</td>
                    <td class="text-right">{{ number_format($detail['archived_total']) }}</td>
                    <td class="text-right">{{ number_format($detail['live_total']) }}</td>
                    <td class="text-right fw-bold">{{ number_format($detail['total']) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada rincian aktivitas untuk filter ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd-box">
            <p>Jambi, {{ $printedDate }}</p>
            <p>Petugas Pencetak,</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">{{ $printedBy }}</p>
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>
