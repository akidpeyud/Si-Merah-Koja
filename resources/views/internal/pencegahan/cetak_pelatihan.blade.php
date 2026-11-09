<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF - PELATIHAN KELUARGA TANGGAP KEBAKARAN</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 12mm 14mm;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            color: #000;
            background: #fff;
            font-size: 10pt;
            line-height: 1.35;
        }

        /* KOP SURAT RESMI */
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            border: none;
            border-bottom: 3px solid #000;
            margin-bottom: 2px;
        }
        .kop-line-thin {
            border-top: 1px solid #000;
            margin-bottom: 16px;
        }
        .kop-surat td {
            border: none;
            padding: 0 0 8px 0;
            vertical-align: middle;
        }
        .kop-logo-left {
            width: 90px;
            text-align: left;
        }
        .kop-logo-right {
            width: 90px;
            text-align: right;
        }
        .kop-logo-left img,
        .kop-logo-right img {
            width: 72px;
            height: auto;
        }
        .kop-teks {
            text-align: center;
            padding: 0 10px;
        }
        .kop-teks h2 {
            margin: 0;
            font-size: 15pt;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .kop-teks h1 {
            margin: 2px 0 4px;
            font-size: 17pt;
            font-weight: bold;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }
        .kop-teks p {
            margin: 0;
            font-size: 10pt;
        }

        /* JUDUL LAPORAN */
        .judul-laporan {
            text-align: center;
            margin: 14px 0 16px;
        }
        .judul-laporan h3 {
            margin: 0;
            font-size: 12.5pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            letter-spacing: 0.3px;
        }
        .judul-laporan span {
            display: block;
            margin-top: 3px;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* TABEL UTAMA */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 9.5pt;
        }
        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 6px 7px;
            vertical-align: middle;
            word-wrap: break-word;
        }
        table.data-table thead th {
            background-color: #e5e7eb !important;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 9pt;
            line-height: 1.25;
            padding: 8px 6px;
        }
        table.data-table tr {
            page-break-inside: avoid;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }

        table.data-table tfoot td {
            background-color: #e5e7eb !important;
            font-weight: bold;
            font-size: 9.5pt;
            padding: 8px 7px;
        }
    </style>
</head>
<body onload="window.print()">

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="kop-logo-left">
                <img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi">
            </td>
            <td class="kop-teks">
                <h2>PEMERINTAH KOTA JAMBI</h2>
                <h1>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</h1>
                <p>Jl. HOS Cokroaminoto No. 113 Telp. (0741) 41171 Kota Jambi</p>
            </td>
            <td class="kop-logo-right">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar">
            </td>
        </tr>
    </table>
    <div class="kop-line-thin"></div>

    <!-- JUDUL LAPORAN -->
    <div class="judul-laporan">
        <h3>DATA PELATIHAN KELUARGA TANGGAP KEBAKARAN</h3>
        <span>{{ !empty($tahun) ? 'TAHUN ' . $tahun : 'SEMUA TAHUN' }}</span>
    </div>

    <!-- TABEL DATA -->
    <table class="data-table">
        <colgroup>
            <col style="width: 4%;">   <!-- NO -->
            <col style="width: 17%;">  <!-- NAMA PESERTA -->
            <col style="width: 11%;">  <!-- JENIS KELAMIN -->
            <col style="width: 12%;">  <!-- KELURAHAN -->
            <col style="width: 12%;">  <!-- KECAMATAN -->
            <col style="width: 16%;">  <!-- HARI/TANGGAL PELAKSANAAN -->
            <col style="width: 11%;">  <!-- TEMPAT PELAKSANAAN -->
            <col style="width: 17%;">  <!-- ALAMAT PELAKSANAAN -->
        </colgroup>
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA PESERTA</th>
                <th>JENIS KELAMIN</th>
                <th>KELURAHAN</th>
                <th>KECAMATAN</th>
                <th>HARI/TANGGAL PELAKSANAAN</th>
                <th>TEMPAT PELAKSANAAN</th>
                <th>ALAMAT PELAKSANAAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalLaki = 0;
                $totalPerempuan = 0;
            @endphp

            @forelse ($data as $index => $item)
                @php
                    $hariTanggal = !empty($item->tanggal_pelaksanaan)
                        ? mb_strtoupper(\Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l, d F Y'))
                        : '-';

                    $jk = trim((string) ($item->jenis_kelamin ?? ''));
                    if (mb_strtolower($jk) === 'laki-laki') {
                        $totalLaki++;
                    } elseif (mb_strtolower($jk) === 'perempuan') {
                        $totalPerempuan++;
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $item->nama_peserta ?? '-' }}</td>
                    <td class="text-center">{{ $jk !== '' ? $jk : '-' }}</td>
                    <td class="text-center">{{ $item->kelurahan ?? '-' }}</td>
                    <td class="text-center">{{ $item->kecamatan ?? '-' }}</td>
                    <td class="text-center">{{ $hariTanggal }}</td>
                    <td class="text-center">{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                    <td class="text-left">{{ $item->alamat_pelaksanaan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 18px;">Belum ada data Pelatihan Keluarga Tanggap Kebakaran.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($data) > 0)
        <tfoot>
            <tr>
                <td colspan="8" style="text-align: right; padding-right: 12px;">
                    TOTAL PESERTA: {{ count($data) }} ORANG (LAKI-LAKI: {{ $totalLaki }} | PEREMPUAN: {{ $totalPerempuan }})
                </td>
            </tr>
        </tfoot>
        @endif
    </table>

</body>
</html>
