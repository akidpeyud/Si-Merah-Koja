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
            font-size: 11px;
            margin: 0;
            padding: 10px 20px;
        }

        /* =======================================================
           KOP SURAT STYLES (KONSISTEN BASE64)
           ======================================================= */
        table.kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 15px;
        }
        table.kop-surat td {
            border: none;
            padding: 5px;
            vertical-align: middle;
        }
        .kop-logo {
            width: 15%;
            text-align: center;
        }
        .kop-logo img {
            width: 75px;
            height: auto;
        }
        .kop-teks {
            width: 70%;
            text-align: center;
            line-height: 1.3;
        }
        .kop-teks .pemerintah {
            font-size: 14px;
            font-weight: normal;
            color: #000;
        }
        .kop-teks .dinas {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin: 3px 0;
        }
        .kop-teks .alamat {
            font-size: 11px;
            font-weight: normal;
            color: #000;
        }

        /* =======================================================
           JUDUL DOKUMEN & TABEL DATA
           ======================================================= */
        .doc-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .doc-title h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            text-transform: uppercase;
        }
        .doc-title p {
            margin: 0;
            font-size: 11px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            page-break-before: auto;
            page-break-inside: auto;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }
        /* Mencegah baris terpotong saat diprint */
        table.data-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        
        /* =======================================================
           FORMAT TANDA TANGAN
           ======================================================= */
        .ttd-container {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .ttd-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .clear { clear: both; }

        /* Sembunyikan elemen ini saat diunduh sebagai Excel */
        @media print {
            body { padding: 0; }
            @page { size: landscape; margin: 1cm; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                @if(request('export') == 'excel')
                    <!-- Kosongkan gambar jika diexport ke Excel untuk mencegah error image linking -->
                @else
                    @php
                        $jambiPath = public_path('images/jambi.png');
                        $jambiLogo = file_exists($jambiPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($jambiPath)) : '';
                    @endphp
                    @if($jambiLogo)
                        <img src="{{ $jambiLogo }}" alt="Logo Kota Jambi">
                    @else
                        <span style="font-size:10px;">(Logo Jambi)</span>
                    @endif
                @endif
            </td>
            <td class="kop-teks">
                <div class="pemerintah">PEMERINTAH KOTA JAMBI</div>
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN KOTA JAMBI</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
            </td>
            <td class="kop-logo">
                @if(request('export') == 'excel')
                    <!-- Kosongkan gambar jika diexport ke Excel -->
                @else
                    @php
                        $logoPath = public_path('images/logo.png');
                        $logoFile = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
                    @endphp
                    @if($logoFile)
                        <img src="{{ $logoFile }}" alt="Logo Instansi">
                    @else
                        <span style="font-size:10px;">(Logo Instansi)</span>
                    @endif
                @endif
            </td>
        </tr>
    </table>

    <!-- JUDUL LAPORAN -->
    <div class="doc-title">
        <h3>DATA MUTU BAKU & RIWAYAT PENGADAAN SARANA PRASARANA</h3>
        <p>Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
    </div>

    <!-- TABEL GABUNGAN -->
    <table class="data-table">
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
                    <td class="text-left" style="padding-left: 10px; font-weight: bold;">{{ $item->uraian }}</td>
                    <td class="text-center">{{ $item->jumlah_dibutuhkan }}</td>
                    
                    <!-- Loop Tahun Pengadaan -->
                    @foreach($listTahun as $tahun)
                        <td class="text-center">
                            {{ $pengadaanMapped[$item->id][$tahun] ?? '-' }}
                        </td>
                    @endforeach

                    <td class="text-center"><b>{{ $item->jumlah_tersedia }}</b></td>
                    <td class="text-center" style="{{ $item->jumlah_belum_tersedia > 0 ? 'color: red; font-weight: bold;' : '' }}">
                        {{ $item->jumlah_belum_tersedia }}
                    </td>
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
            <p style="font-weight: bold; text-decoration: underline; margin-bottom: 2px;">(Nama Kepala Bidang)</p>
            <p style="margin-top: 0;">NIP. .....................................</p>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Script otomatis buka jendela Print saat halaman diload -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
    @endif

</body>
</html>