<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF - SOSIALISASI & EDUKASI</title>
    <style>
        /* Memaksa tampilan cetak browser menjadi Landscape */
        @page {
            size: landscape;
            margin: 10mm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 10px;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
        }
        .header h3, .header h2, .header p {
            margin: 2px 0;
        }
        .title {
            text-align: center;
            margin: 15px 0;
            font-weight: bold;
            font-size: 13pt;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px 4px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
            text-transform: uppercase;
        }
        /* Style khusus gambar agar rapi di tabel */
        .img-thumb {
            max-width: 70px;
            max-height: 70px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        @media print {
            th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body onload="window.print()">
<!-- KOP SURAT -->
<table style="width: 100%; border-collapse: collapse; border: none; margin-bottom: 15px; border-bottom: 3px double #000; padding-bottom: 10px;">
    <tr>
        <!-- Logo Jambi (Kiri) -->
        <td style="width: 15%; text-align: left; vertical-align: middle; border: none;">
            <img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi" style="width: 75px; height: auto;">
        </td>
        
        <!-- Teks Kop Surat (Tengah) -->
        <td style="width: 70%; text-align: center; vertical-align: middle; border: none;">
            <h2 style="margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase;">PEMERINTAH KOTA JAMBI</h2>
            <h3 style="margin: 3px 0; font-size: 13pt; font-weight: bold; text-transform: uppercase;">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</h3>
            <p style="margin: 0; font-size: 9pt;">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</p>
        </td>

        <!-- Logo Damkar / Brama Jaya (Kanan) -->
        <td style="width: 15%; text-align: right; vertical-align: middle; border: none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar" style="width: 75px; height: auto;">
        </td>
    </tr>
</table>

    <!-- JUDUL LAPORAN -->
    <div class="title">
        DATA SOSIALISASI & EDUKASI PENCEGAHAN KEBAKARAN<br>
        TAHUN {{ date('Y') }}
    </div>

    <!-- TABEL DATA -->
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 35px;">NO</th>
                <th rowspan="2" style="width: 110px;">HARI / TGL</th>
                <th rowspan="2" style="width: 40px;">RT</th>
                <th rowspan="2">KELURAHAN</th>
                <th rowspan="2">KECAMATAN</th>
                <th rowspan="2">POSYANDU / NAMA SEKOLAH</th>
                <th colspan="3">JUMLAH PESERTA</th>
                <th rowspan="2" style="width: 90px;">FOTO DAN VIDEO</th>
            </tr>
            <tr>
                <th style="width: 75px;">PEREMPUAN</th>
                <th style="width: 75px;">LAKI-LAKI</th>
                <th style="width: 65px;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_semua_perempuan = 0;
                $total_semua_lakilaki = 0;
                $total_semua_peserta = 0;
            @endphp

            @forelse ($data as $index => $item)
                @php
                    $perempuan = $item->peserta_perempuan ?? 0;
                    $lakilaki = $item->peserta_laki_laki ?? 0;
                    $total_peserta = $perempuan + $lakilaki;

                    $total_semua_perempuan += $perempuan;
                    $total_semua_lakilaki += $lakilaki;
                    $total_semua_peserta += $total_peserta;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if(!empty($item->tanggal_pelaksanaan))
                            {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->translatedFormat('d F Y') }}<br>
                            <small style="color: #555;">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->translatedFormat('l') }}</small>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->rt ?? '-' }}</td>
                    <td>{{ $item->kelurahan ?? '-' }}</td>
                    <td>{{ $item->kecamatan ?? '-' }}</td>
                    <td>{{ $item->posyandu_sekolah ?? '-' }}</td>
                    <td>{{ $perempuan }}</td>
                    <td>{{ $lakilaki }}</td>
                    <td><strong>{{ $total_peserta }}</strong></td>
                    <td>
                        @if(!empty($item->foto_video))
                            {{-- Menampilkan foto jika file tersimpan di uploads/pemberdayaan/ --}}
                            <img src="{{ asset('uploads/pemberdayaan/' . $item->foto_video) }}" class="img-thumb" alt="Foto">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="padding: 15px;">Belum ada data riwayat Sosialisasi & Edukasi.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($data) > 0)
        <tfoot>
            <tr style="font-weight: bold; background-color: #f3f4f6;">
                <td colspan="6" style="text-align: right; padding-right: 10px;">TOTAL SELURUH PESERTA</td>
                <td>{{ $total_semua_perempuan }}</td>
                <td>{{ $total_semua_lakilaki }}</td>
                <td>{{ $total_semua_peserta }}</td>
                <td></td>
            </tr>
        </tfoot>
        @endif
    </table>

</body>
</html>