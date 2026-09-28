<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Distribusi Personil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 10px 20px;
        }

        /* =======================================================
           KOP SURAT STYLES (KONSISTEN)
           ======================================================= */
        table.kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
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

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            page-break-before: auto;
            page-break-inside: auto;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 7px 10px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
        }
        /* Mencegah baris terpotong */
        table.data-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold; }
        .bg-light { background-color: #f8fafc; }
        
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

        @media print {
            body { padding: 0; }
            @page { size: portrait; margin: 1cm; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT MENGGUNAKAN TEKNIK BASE64 AGAR BISA DIBACA PDF / PRINT -->
    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                @php
                    $jambiPath = public_path('images/jambi.png');
                    $jambiLogo = file_exists($jambiPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($jambiPath)) : '';
                @endphp
                @if($jambiLogo)
                    <img src="{{ $jambiLogo }}" alt="Logo Kota Jambi">
                @else
                    <span style="font-size:10px;">(Logo Jambi)</span>
                @endif
            </td>
            <td class="kop-teks">
                <div class="pemerintah">PEMERINTAH KOTA JAMBI</div>
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN KOTA JAMBI</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
            </td>
            <td class="kop-logo">
                @php
                    $logoPath = public_path('images/logo.png');
                    $logoFile = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
                @endphp
                @if($logoFile)
                    <img src="{{ $logoFile }}" alt="Logo Instansi">
                @else
                    <span style="font-size:10px;">(Logo Instansi)</span>
                @endif
            </td>
        </tr>
    </table>

    <div class="doc-title">
        <h3>REKAPITULASI DISTRIBUSI BARANG / INVENTARIS PERSONIL</h3>
    </div>

    <!-- TABEL DATA -->
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="25%">NAMA PERSONIL</th>
                <th width="35%">BARANG / INVENTARIS DITERIMA</th>
                <th width="15%">WAKTU TERIMA</th>
                <th width="20%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($dataDistribusi as $nama => $items)
                
                <!-- BARIS HEADER NAMA STAFF -->
                <tr>
                    <td class="text-center fw-bold" rowspan="{{ count($items) + 1 }}">{{ $no++ }}</td>
                    <td colspan="4" class="bg-light fw-bold" style="text-transform: uppercase;">
                        {{ $nama }} <span style="font-weight: normal; font-size: 10px; margin-left: 5px;">(Total: {{ count($items) }} Barang)</span>
                    </td>
                </tr>
                
                <!-- BARIS RINCIAN BARANG -->
                @foreach($items as $item)
                    <tr>
                        <!-- Kolom Nama Personil dikosongkan -->
                        <td class="text-center" style="color: #9ca3af;">-</td>
                        
                        <td style="padding-left: 15px;">
                            <span class="fw-bold">{{ $item->nama_barang }}</span>
                            @if($item->detail_barang) 
                                <br><i style="font-size: 10px; color: #444;">Kategori/Detail: {{ $item->detail_barang }}</i> 
                            @endif
                        </td>
                        
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->waktu_terima)->format('d M Y') }}<br>
                            <span style="font-size: 10px;">{{ \Carbon\Carbon::parse($item->waktu_terima)->format('H:i') }} WIB</span>
                        </td>
                        
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach

            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Belum ada data distribusi barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- FORMAT TANDA TANGAN (Hanya muncul kalau tidak diexport ke excel) -->
    @if(!request()->has('export'))
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p><strong>Bagian Sarana dan Prasarana</strong></p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline; margin-bottom: 2px;">(Nama Petugas/Admin)</p>
            <p style="margin-top: 0;">NIP. ........................................</p>
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