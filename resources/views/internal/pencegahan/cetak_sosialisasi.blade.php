<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sosialisasi &amp; Edukasi - Tahun {{ $tahun ?? date('Y') }}</title>
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

        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            border: none;
            border-bottom: 3px solid #000;
            margin-bottom: 2px;
        }
        .kop-line-thin {
            border-top: 1px solid #000;
            margin-bottom: 14px;
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

        .judul-laporan {
            text-align: center;
            margin: 12px 0 16px;
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

        .sub-judul-tabel {
            margin: 16px 0 8px;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        table.tabel-laporan {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 9.5pt;
            margin-bottom: 18px;
        }
        table.tabel-laporan th,
        table.tabel-laporan td {
            border: 1px solid #000;
            padding: 6px 6px;
            vertical-align: middle;
            word-wrap: break-word;
        }
        table.tabel-laporan thead th {
            background-color: #e5e7eb !important;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 9pt;
            line-height: 1.25;
            padding: 8px 5px;
        }
        table.tabel-laporan tr {
            page-break-inside: avoid;
        }
        table.tabel-laporan tfoot td {
            background-color: #e5e7eb !important;
            font-weight: bold;
            font-size: 9.5pt;
            padding: 7px 6px;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .tgl-utama { font-weight: bold; display: block; }
        .tgl-hari { font-size: 8.5pt; color: #333; font-style: italic; }
        a.spt-link { color: #000; text-decoration: underline; }
    </style>
</head>
<body onload="window.print()">
    @php
        $koleksi = collect($data ?? []);
        $dataLuar = $koleksi->filter(fn ($i) => ($i->jenis_kegiatan ?? 'Luar') !== 'Dalam')->values();
        $dataDalam = $koleksi->filter(fn ($i) => ($i->jenis_kegiatan ?? 'Luar') === 'Dalam')->values();
        $filterJenis = $jenis ?? null;
    @endphp

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
        <h3>
            @if($filterJenis === 'Luar')
                DATA SOSIALISASI DAN PENYULUHAN PENCEGAHAN KEBAKARAN
            @elseif($filterJenis === 'Dalam')
                DATA KUNJUNGAN DAN EDUKASI PENCEGAHAN KEBAKARAN
            @else
                DATA SOSIALISASI, PENYULUHAN, KUNJUNGAN &amp; EDUKASI PENCEGAHAN KEBAKARAN
            @endif
        </h3>
        <span>{{ !empty($tahun) ? 'TAHUN ' . $tahun : 'REKAPITULASI SEMUA TAHUN' }}</span>
    </div>

    <!-- TABEL 1: SOSIALISASI DAN PENYULUHAN -->
    @if($filterJenis !== 'Dalam')
        @if(!$filterJenis)
            <div class="sub-judul-tabel">A. SOSIALISASI DAN PENYULUHAN</div>
        @endif
        <table class="tabel-laporan">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: 17%;">
                <col style="width: 14%;">
                <col style="width: 18%;">
                <col style="width: 12%;">
                <col style="width: 9%;">
                <col style="width: 11%;">
                <col style="width: 9%;">
                <col style="width: 6%;">
            </colgroup>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA INSTANSI/LEMBAGA</th>
                    <th>TEMPAT PELAKSANAAN</th>
                    <th>ALAMAT</th>
                    <th>TANGGAL PELAKSANAAN</th>
                    <th>JUMLAH PESERTA</th>
                    <th>NAMA PENANGGUNG JAWAB</th>
                    <th>NO TELFON/WA PENANGGUNG JAWAB</th>
                    <th>UPLOAD SPT</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPesertaLuar = 0; @endphp
                @forelse($dataLuar as $index => $item)
                    @php
                        $jml = (int) ($item->jumlah_peserta ?? 0);
                        $totalPesertaLuar += $jml;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td><strong>{{ $item->nama_instansi ?? $item->posyandu_sekolah ?? '-' }}</strong></td>
                        <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td class="text-center">
                            @if(!empty($item->tanggal_pelaksanaan))
                                <span class="tgl-utama">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') }}</span>
                                <span class="tgl-hari">({{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l') }})</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center"><strong>{{ number_format($jml, 0, ',', '.') }} Orang</strong></td>
                        <td>{{ $item->nama_penanggung_jawab ?? '-' }}</td>
                        <td class="text-center">{{ $item->no_telepon ?? '-' }}</td>
                        <td class="text-center">
                            @if(!empty($item->surat_perintah_tugas))
                                <a class="spt-link" href="{{ url('/uploads/sosialisasi/' . $item->surat_perintah_tugas) }}" target="_blank">Ada</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center" style="padding: 16px;">Belum ada data Sosialisasi dan Penyuluhan.</td>
                    </tr>
                @endforelse
            </tbody>
            @if($dataLuar->isNotEmpty())
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right" style="padding-right: 12px;">TOTAL PESERTA</td>
                        <td class="text-center">{{ number_format($totalPesertaLuar, 0, ',', '.') }} Orang</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    @endif

    <!-- TABEL 2: KUNJUNGAN DAN EDUKASI -->
    @if($filterJenis !== 'Luar')
        @if(!$filterJenis)
            <div class="sub-judul-tabel">B. KUNJUNGAN DAN EDUKASI</div>
        @endif
        <table class="tabel-laporan">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: 13%;">
                <col style="width: 17%;">
                <col style="width: 12%;">
                <col style="width: 14%;">
                <col style="width: 11%;">
                <col style="width: 8%;">
                <col style="width: 9%;">
                <col style="width: 7%;">
                <col style="width: 5%;">
            </colgroup>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NO DAN TANGGAL SURAT PERMOHONAN</th>
                    <th>NAMA INSTANSI/LEMBAGA (TK/SD/SLTP/SLTA/PERGURUAN TINGGI)</th>
                    <th>TEMPAT PELAKSANAAN</th>
                    <th>ALAMAT</th>
                    <th>TANGGAL PELAKSANAAN</th>
                    <th>JUMLAH PESERTA</th>
                    <th>NAMA PENANGGUNG JAWAB</th>
                    <th>NO TELFON/WA PENANGGUNG JAWAB</th>
                    <th>UPLOAD SPT</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPesertaDalam = 0; @endphp
                @forelse($dataDalam as $index => $item)
                    @php
                        $jml = (int) ($item->jumlah_peserta ?? 0);
                        $totalPesertaDalam += $jml;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->no_tanggal_surat_permohonan ?? '-' }}</td>
                        <td><strong>{{ $item->nama_instansi ?? $item->posyandu_sekolah ?? '-' }}</strong></td>
                        <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td class="text-center">
                            @if(!empty($item->tanggal_pelaksanaan))
                                <span class="tgl-utama">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('d F Y') }}</span>
                                <span class="tgl-hari">({{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l') }})</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center"><strong>{{ number_format($jml, 0, ',', '.') }} Orang</strong></td>
                        <td>{{ $item->nama_penanggung_jawab ?? '-' }}</td>
                        <td class="text-center">{{ $item->no_telepon ?? '-' }}</td>
                        <td class="text-center">
                            @if(!empty($item->surat_perintah_tugas))
                                <a class="spt-link" href="{{ url('/uploads/sosialisasi/' . $item->surat_perintah_tugas) }}" target="_blank">Ada</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center" style="padding: 16px;">Belum ada data Kunjungan dan Edukasi.</td>
                    </tr>
                @endforelse
            </tbody>
            @if($dataDalam->isNotEmpty())
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-right" style="padding-right: 12px;">TOTAL PESERTA</td>
                        <td class="text-center">{{ number_format($totalPesertaDalam, 0, ',', '.') }} Orang</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    @endif

</body>
</html>
