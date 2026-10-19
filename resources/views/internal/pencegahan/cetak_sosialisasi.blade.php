<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Sosialisasi & Edukasi - Tahun {{ date('Y') }}</title>
    <style>
        /* Pengaturan kertas Landscape A4/F4 resmi */
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
            font-size: 10.5pt;
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
            font-style: normal;
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
        table.tabel-laporan {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10pt;
        }
        table.tabel-laporan th,
        table.tabel-laporan td {
            border: 1px solid #000;
            padding: 6px 7px;
            vertical-align: middle;
            word-wrap: break-word;
        }
        table.tabel-laporan thead th {
            background-color: #e5e7eb !important;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 9.5pt;
            line-height: 1.25;
            padding: 8px 6px;
        }

        /* Prevent row split saat pindah halaman */
        table.tabel-laporan tr {
            page-break-inside: avoid;
        }

        /* Alignment khusus per jenis kolom */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .valign-top { vertical-align: top !important; }

        /* Tanggal & Hari */
        .tgl-utama {
            font-weight: bold;
            display: block;
        }
        .tgl-hari {
            font-size: 9pt;
            color: #333;
            font-style: italic;
        }

        /* Styling Kolom Peserta (Jumlah di atas, Daftar Nama bernomor di bawah) */
        .td-peserta {
            padding: 0 !important;
            vertical-align: top !important;
        }
        .peserta-header-count {
            text-align: center;
            font-weight: bold;
            padding: 6px 4px;
            background-color: #f9fafb;
        }
        .peserta-header-count.has-names {
            border-bottom: 1px dashed #9ca3af;
        }
        .peserta-daftar {
            margin: 0;
            padding: 6px 8px 6px 24px;
            text-align: left;
            font-size: 9.2pt;
            line-height: 1.35;
            list-style-type: decimal !important;
        }
        .peserta-daftar li {
            margin-bottom: 2px;
            text-transform: capitalize;
        }

        /* Kolom Link Dokumentasi */
        .col-link {
            font-size: 8.5pt;
            line-height: 1.3;
            word-break: break-all;
            text-align: left;
        }
        .col-link.empty {
            text-align: center;
        }
        .col-link a {
            color: #000;
            text-decoration: underline;
        }

        /* Footer Total */
        table.tabel-laporan tfoot td {
            background-color: #e5e7eb !important;
            font-weight: bold;
            font-size: 10pt;
            padding: 8px 7px;
        }
    </style>
</head>
<body onload="window.print()">

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="kop-logo-left">
                <img src="{{ asset('images/jambi.png') }}" alt="Logo Kota Jambi">
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
        <h3>DATA SOSIALISASI &amp; EDUKASI PENCEGAHAN KEBAKARAN</h3>
        <span>TAHUN {{ date('Y') }}</span>
    </div>

    <!-- TABEL DATA -->
    <table class="tabel-laporan">
        <colgroup>
            <col style="width: 4%;">   <!-- NO -->
            <col style="width: 12%;">  <!-- HARI / TGL -->
            <col style="width: 7%;">   <!-- RT (diperlebar agar 01-02-03 muat 1 baris) -->
            <col style="width: 11%;">  <!-- KELURAHAN -->
            <col style="width: 11%;">  <!-- KECAMATAN -->
            <col style="width: 15%;">  <!-- POSYANDU / NAMA SEKOLAH -->
            <col style="width: 11%;">  <!-- LAKI-LAKI -->
            <col style="width: 11%;">  <!-- PEREMPUAN -->
            <col style="width: 7%;">   <!-- TOTAL PESERTA -->
            <col style="width: 11%;">  <!-- LINK DOKUMENTASI -->
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">HARI / TGL</th>
                <th rowspan="2">RT</th>
                <th rowspan="2">KELURAHAN</th>
                <th rowspan="2">KECAMATAN</th>
                <th rowspan="2">POSYANDU /<br>NAMA SEKOLAH</th>
                <th colspan="3">JUMLAH &amp; DAFTAR PESERTA</th>
                <th rowspan="2">LINK<br>DOKUMENTASI</th>
            </tr>
            <tr>
                <th>LAKI-LAKI</th>
                <th>PEREMPUAN</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_semua_lakilaki = 0;
                $total_semua_perempuan = 0;
                $total_semua_peserta = 0;

                $parseNama = function ($raw) {
                    if (is_array($raw)) {
                        return collect($raw)->map(fn($n) => trim((string) $n))->filter()->values();
                    }
                    if (is_string($raw) && str_starts_with(trim($raw), '[')) {
                        $decoded = json_decode($raw, true);
                        if (is_array($decoded)) {
                            return collect($decoded)->map(fn($n) => trim((string) $n))->filter()->values();
                        }
                    }
                    return collect(preg_split('/[\r\n,;]+/', (string) $raw))
                        ->map(fn($n) => trim($n))
                        ->filter()
                        ->values();
                };
            @endphp

            @forelse ($data as $index => $item)
                @php
                    $rawNamaL = $item->nama_peserta_laki_laki
                        ?? $item->daftar_peserta_laki_laki
                        ?? $item->peserta_laki_nama
                        ?? $item->nama_laki_laki
                        ?? '';

                    $rawNamaP = $item->nama_peserta_perempuan
                        ?? $item->daftar_peserta_perempuan
                        ?? $item->peserta_perempuan_nama
                        ?? $item->nama_perempuan
                        ?? '';

                    $listNamaL = $parseNama($rawNamaL);
                    $listNamaP = $parseNama($rawNamaP);

                    $lakilaki = (int) ($item->peserta_laki_laki ?? $listNamaL->count());
                    $perempuan = (int) ($item->peserta_perempuan ?? $listNamaP->count());
                    $total_peserta = $lakilaki + $perempuan;

                    $total_semua_lakilaki += $lakilaki;
                    $total_semua_perempuan += $perempuan;
                    $total_semua_peserta += $total_peserta;

                    $links = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $item->link_dokumentasi ?? ''))));
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        @if(!empty($item->tanggal_pelaksanaan))
                            <span class="tgl-utama">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') }}</span>
                            <span class="tgl-hari">({{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l') }})</span>
                        @else
                            {{ $item->hari_tgl ?? '-' }}
                        @endif
                    </td>
                    <td class="text-center">{{ $item->rt ?? '-' }}</td>
                    <td class="text-center">{{ $item->kelurahan ?? '-' }}</td>
                    <td class="text-center">{{ $item->kecamatan ?? '-' }}</td>
                    <td class="text-center"><strong>{{ strtoupper($item->posyandu_sekolah ?? $item->nama_sekolah ?? '-') }}</strong></td>

                    <!-- LAKI-LAKI -->
                    <td class="td-peserta">
                        <div class="peserta-header-count {{ $listNamaL->isNotEmpty() ? 'has-names' : '' }}">
                            {{ $lakilaki }} Orang
                        </div>
                        @if($listNamaL->isNotEmpty())
                            <ol class="peserta-daftar">
                                @foreach($listNamaL as $namaL)
                                    <li>{{ $namaL }}</li>
                                @endforeach
                            </ol>
                        @endif
                    </td>

                    <!-- PEREMPUAN -->
                    <td class="td-peserta">
                        <div class="peserta-header-count {{ $listNamaP->isNotEmpty() ? 'has-names' : '' }}">
                            {{ $perempuan }} Orang
                        </div>
                        @if($listNamaP->isNotEmpty())
                            <ol class="peserta-daftar">
                                @foreach($listNamaP as $namaP)
                                    <li>{{ $namaP }}</li>
                                @endforeach
                            </ol>
                        @endif
                    </td>

                    <!-- TOTAL PESERTA -->
                    <td class="text-center">
                        <strong>{{ $total_peserta }} Orang</strong>
                    </td>

                    <!-- LINK DOKUMENTASI -->
                    <td class="col-link {{ empty($links) ? 'empty' : '' }}">
                        @forelse ($links as $i => $link)
                            @php
                                $url = preg_match('/^https?:\/\//i', $link) ? $link : 'https://' . $link;
                            @endphp
                            {{ count($links) > 1 ? ($i + 1) . '. ' : '' }}<a href="{{ $url }}" target="_blank" rel="noopener">{{ $url }}</a>@if(!$loop->last)<br>@endif
                        @empty
                            -
                        @endforelse
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center" style="padding: 18px;">Belum ada data riwayat Sosialisasi &amp; Edukasi.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($data) > 0)
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: right; padding-right: 14px;">TOTAL SELURUH PESERTA</td>
                <td class="text-center">{{ $total_semua_lakilaki }} Orang</td>
                <td class="text-center">{{ $total_semua_perempuan }} Orang</td>
                <td class="text-center">{{ $total_semua_peserta }} Orang</td>
                <td></td>
            </tr>
        </tfoot>
        @endif
    </table>

</body>
</html>