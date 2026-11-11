<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Serah Terima Barang - {{ $namaPenerima }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm 1.5cm 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            font-size: 11.5pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat Resmi */
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
            width: 14%;
            text-align: center;
        }
        .kop-logo img {
            width: 68px;
            height: auto;
        }
        .kop-teks {
            width: 72%;
            text-align: center;
            line-height: 1.25;
        }
        .kop-teks .pemerintah {
            font-size: 13pt;
            font-weight: normal;
            letter-spacing: 0.5px;
        }
        .kop-teks .dinas {
            font-size: 14.5pt;
            font-weight: bold;
            margin: 2px 0;
        }
        .kop-teks .alamat {
            font-size: 10pt;
            font-weight: normal;
        }
        .kop-teks .kota {
            font-size: 11pt;
            font-weight: bold;
            letter-spacing: 4px;
            margin-top: 2px;
        }

        /* Judul Surat */
        .doc-header {
            text-align: center;
            margin-bottom: 14px;
        }
        .doc-title {
            font-size: 12.5pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
        }
        .doc-nomor {
            font-size: 11pt;
            margin: 3px 0 0 0;
        }
        .doc-periode {
            font-size: 9.5pt;
            color: #333;
            margin: 6px 0 0 0;
            text-align: center;
            line-height: 1.35;
        }

        .paragraf {
            text-align: justify;
            margin: 0 0 10px 0;
        }

        /* Blok Identitas Pihak Pertama & Kedua */
        table.pihak-table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0 10px 0;
        }
        table.pihak-table td {
            border: none;
            padding: 2px 4px;
            vertical-align: top;
        }
        table.pihak-table td.lbl {
            width: 110px;
        }
        table.pihak-table td.sep {
            width: 14px;
            text-align: center;
        }
        .sebutan-pihak {
            font-style: italic;
            padding-top: 2px;
            padding-bottom: 8px;
        }

        /* Tabel Rincian Barang */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 12px 0;
            font-size: 10.5pt;
        }
        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
        }
        table.data-table tr {
            page-break-inside: avoid;
        }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .sub-detail {
            font-size: 9.5pt;
            color: #333;
            font-style: italic;
            margin-top: 2px;
        }

        /* Tanda Tangan */
        .ttd-wrap {
            width: 100%;
            margin-top: 18px;
            page-break-inside: avoid;
        }
        table.ttd-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.ttd-table td {
            border: none;
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 4px 10px;
        }
        .ttd-space {
            height: 54px;
        }
        .ttd-space-sm {
            height: 46px;
        }
        .ttd-row-mengetahui td {
            padding-top: 22px;
        }
    </style>
</head>
<body>
    @php
        $jambiPath = public_path('images/jambi.png');
        $jambiLogo = file_exists($jambiPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($jambiPath)) : '';
        $damkarPath = public_path('images/logo.png');
        $damkarLogo = file_exists($damkarPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($damkarPath)) : '';
    @endphp

    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                @if($jambiLogo)
                    <img src="{{ $jambiLogo }}" alt="Logo Kota Jambi">
                @endif
            </td>
            <td class="kop-teks">
                <div class="pemerintah">PEMERINTAH KOTA JAMBI</div>
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
                <div class="kota">JAMBI</div>
            </td>
            <td class="kop-logo">
                @if($damkarLogo)
                    <img src="{{ $damkarLogo }}" alt="Logo Yudha Brama Jaya">
                @endif
            </td>
        </tr>
    </table>

    <div class="doc-header">
        <div class="doc-title">BERITA ACARA SERAH TERIMA BARANG</div>
        <div class="doc-nomor">Nomor : ......................................................</div>
        <div class="doc-periode">
            <strong>Periode Data :</strong> {{ $labelPeriode }}
            @if(!empty($daftarTanggalLabel))
                <br><strong>Tanggal Penyerahan Tercatat :</strong> {{ $daftarTanggalLabel }}
            @endif
        </div>
    </div>

    <p class="paragraf">
        Pada hari ini, .......................... Tanggal ........ Bulan .......................... Tahun ...............,
        Kami yang bertanda tangan di bawah ini :
    </p>

    <table class="pihak-table">
        <tr>
            <td class="lbl">Nama</td>
            <td class="sep">:</td>
            <td>................................................................................</td>
        </tr>
        <tr>
            <td class="lbl">NIP</td>
            <td class="sep">:</td>
            <td>................................................................................</td>
        </tr>
        <tr>
            <td class="lbl">Jabatan</td>
            <td class="sep">:</td>
            <td>................................................................................</td>
        </tr>
        <tr>
            <td colspan="3" class="sebutan-pihak">Selanjutnya disebut <strong>PIHAK PERTAMA</strong></td>
        </tr>
        <tr>
            <td class="lbl">Nama</td>
            <td class="sep">:</td>
            <td class="fw-bold">{{ $namaPenerima }}</td>
        </tr>
        <tr>
            <td class="lbl">Jabatan</td>
            <td class="sep">:</td>
            <td>................................................................................</td>
        </tr>
        <tr>
            <td colspan="3" class="sebutan-pihak" style="padding-bottom: 2px;">Selanjutnya disebut <strong>PIHAK KEDUA</strong></td>
        </tr>
    </table>

    <p class="paragraf">
        <strong>PIHAK PERTAMA</strong> telah menyerahkan barang kepada <strong>PIHAK KEDUA</strong>,
        dan <strong>PIHAK KEDUA</strong> menyatakan telah menerima barang dari <strong>PIHAK PERTAMA</strong> berupa :
    </p>

    <table class="data-table">
        <thead>
            <tr>
                <th width="6%">No</th>
                <th width="34%">Jenis Barang</th>
                <th width="12%">Jumlah</th>
                <th width="20%">Tanggal Terima</th>
                <th width="28%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <span class="fw-bold">{{ $item->nama_barang }}</span>
                        @if(!empty($item->detail_barang))
                            <div class="sub-detail">{{ $item->detail_barang }}</div>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->jumlah ?? 1 }} Unit</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->waktu_terima)->locale('id')->translatedFormat('d F Y') }}
                    </td>
                    <td>{{ !empty($item->keterangan) ? $item->keterangan : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="paragraf">
        Demikianlah berita acara serah terima barang ini dibuat oleh kedua belah pihak, adapun barang-barang tersebut dalam keadaan baik dan cukup, sejak penandatanganan berita acara ini, maka barang tersebut menjadi tanggung jawab <strong>PIHAK KEDUA</strong>, memelihara / merawat dengan baik serta dipergunakan untuk keperluan (tempat dimana barang itu dibutuhkan).
    </p>

    <div class="ttd-wrap">
        <table class="ttd-table">
            <tr>
                <td>
                    Yang Menerima :<br>
                    <strong>PIHAK KEDUA</strong>
                    <div class="ttd-space"></div>
                    <strong>( {{ $namaPenerima }} )</strong><br>
                    <span style="font-size: 10pt;">NIP. ...........................................</span>
                </td>
                <td>
                    Yang Menyerahkan,<br>
                    <strong>PIHAK PERTAMA</strong>
                    <div class="ttd-space"></div>
                    ( .................................................. )<br>
                    <span style="font-size: 10pt;">NIP. ...........................................</span>
                </td>
            </tr>
            <tr class="ttd-row-mengetahui">
                <td>
                    Mengetahui,<br>
                    ..................................................
                    <div class="ttd-space-sm"></div>
                    ( .................................................. )<br>
                    <span style="font-size: 10pt;">NIP. ...........................................</span>
                </td>
                <td>
                    Mengetahui,<br>
                    ..................................................
                    <div class="ttd-space-sm"></div>
                    ( .................................................. )<br>
                    <span style="font-size: 10pt;">NIP. ...........................................</span>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
