<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Mutu Baku & Pengadaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }
        .header h2, .header h3, .header h4 {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }
        th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .ttd-container {
            width: 100%;
            margin-top: 50px;
        }
        .ttd-box {
            float: right;
            width: 300px;
            text-align: center;
        }
        .clear { clear: both; }

        /* Sembunyikan elemen ini saat diunduh sebagai Excel (menggunakan namespace mso) */
        @media print {
            body { padding: 0; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT LAPORAN -->
    <div class="header">
        <h3>PEMERINTAH KOTA JAMBI</h3>
        <h2>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</h2>
        <h4>DATA MUTU BAKU & RIWAYAT PENGADAAN SARANA PRASARANA</h4>
        <p>Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
    </div>

    <!-- TABEL GABUNGAN -->
    <table>
        <thead>
            <tr>
                <th rowspan="2" width="3%">NO</th>
                <th rowspan="2" width="20%">URAIAN BARANG / JASA</th>
                <th rowspan="2" width="5%">DIBUTUHKAN (TARGET)</th>
                <th colspan="{{ count($listTahun) }}">RIWAYAT PENGADAAN TAHUNAN</th>
                <th rowspan="2" width="5%">TERSEDIA (STOK)</th>
                <th rowspan="2" width="5%">BELUM TERSEDIA</th>
            </tr>
            <tr>
                @foreach($listTahun as $tahun)
                    <th>{{ $tahun }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($dataKebutuhan as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left" style="padding-left: 10px;">{{ $item->uraian }}</td>
                    <td class="text-center">{{ $item->jumlah_dibutuhkan }}</td>
                    
                    <!-- Loop Tahun Pengadaan -->
                    @foreach($listTahun as $tahun)
                        <td class="text-center">
                            {{ $pengadaanMapped[$item->id][$tahun] ?? '-' }}
                        </td>
                    @endforeach

                    <td class="text-center"><b>{{ $item->jumlah_tersedia }}</b></td>
                    <td class="text-center">{{ $item->jumlah_belum_tersedia }}</td>
                </tr>
            @endforeach
            
            <!-- BARIS TOTAL -->
            @if($dataKebutuhan->count() > 0)
                <tr style="font-weight: bold; background-color: #f8fafc;">
                    <td colspan="2" style="text-align: right; padding-right: 15px;">TOTAL KESELURUHAN</td>
                    <td class="text-center">{{ $dataKebutuhan->sum('jumlah_dibutuhkan') }}</td>
                    
                    @foreach($listTahun as $tahun)
                        <td class="text-center">
                            @php
                                $totalTahunIni = 0;
                                foreach($dataKebutuhan as $item) {
                                    $totalTahunIni += ($pengadaanMapped[$item->id][$tahun] ?? 0);
                                }
                            @endphp
                            {{ $totalTahunIni > 0 ? $totalTahunIni : '-' }}
                        </td>
                    @endforeach

                    <td class="text-center">{{ $dataKebutuhan->sum('jumlah_tersedia') }}</td>
                    <td class="text-center">{{ $dataKebutuhan->sum('jumlah_belum_tersedia') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- FORMAT TANDA TANGAN (Hanya muncul kalau di-print biasa, tidak di excel) -->
    @if(!request()->has('export'))
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">(Nama Kepala Bidang)</p>
            <p>NIP. .....................................</p>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Script otomatis buka jendela Print -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
    @endif

</body>
</html>