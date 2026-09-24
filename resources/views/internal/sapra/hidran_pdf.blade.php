@php
    // Mapping data agar mudah di-looping menjadi 4 tabel terpisah di PDF
    $kategoriList = [
        [
            'title' => 'HIDRANT PILAR', 
            'data' => $hidranPilar ?? collect(), 
            'name_label' => 'NAMA GEDUNG / LOKASI',
            'qty_label' => 'JUMLAH (UNIT)', 
            'is_luas' => false
        ],
        [
            'title' => 'HIDRANT GEDUNG', 
            'data' => $hidranGedung ?? collect(), 
            'name_label' => 'NAMA GEDUNG',
            'qty_label' => 'JUMLAH (UNIT)', 
            'is_luas' => false
        ],
        [
            'title' => 'EMBUNG / KOLAM', 
            'data' => $embung ?? collect(), 
            'name_label' => 'NAMA LOKASI',
            'qty_label' => 'KAPASITAS AIR', 
            'is_luas' => true
        ],
        [
            'title' => 'DANAU', 
            'data' => $danau ?? collect(), 
            'name_label' => 'NAMA DANAU',
            'qty_label' => 'KAPASITAS AIR', 
            'is_luas' => true
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Sumber Air</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 10px 20px;
        }

        /* =======================================================
           KOP SURAT STYLES
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
            margin-bottom: 15px;
        }
        .doc-title h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            text-transform: uppercase;
        }
        .doc-title p {
            margin: 0;
            font-size: 11px;
            color: #333;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            background-color: #0d1b2a;
            color: #ffffff;
            padding: 6px 10px;
            margin-top: 15px;
            margin-bottom: 0;
            border: 1px solid #000;
            border-bottom: none;
            page-break-after: avoid; /* Pastikan judul nempel dengan tabel di bawahnya */
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-before: auto;
            page-break-inside: auto; /* Biarkan tabel memecah halaman secara alami */
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 7px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }
        /* Mencegah baris terpotong separuh teksnya saat pindah halaman */
        table.data-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold; }
        
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
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT MENGGUNAKAN TEKNIK BASE64 AGAR TERBACA DI DOMPDF -->
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
                    // MENGGUNAKAN LOGO.PNG
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

    <!-- JUDUL LAPORAN -->
    <div class="doc-title">
        <h3>REKAPITULASI DATA SUMBER AIR KOTA JAMBI</h3>
        <p>Kategori: Hidrant Pilar, Hidrant Gedung, Embung, dan Danau</p>
    </div>

    <!-- LOOPING UNTUK KE-4 KATEGORI -->
    @foreach($kategoriList as $kategori)
        <!-- Dihilangkan div pembungkus avoid page break yang bikin tabel melompat ke halaman 2 -->
        <div class="section-title">{{ $kategori['title'] }}</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="25%">{{ $kategori['name_label'] }}</th>
                    <th width="40%">ALAMAT LENGKAP</th>
                    <th width="15%">KODE MAPS</th>
                    <th width="15%">{{ $kategori['qty_label'] }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori['data'] as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $item->nama_gedung }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">{{ $item->kode_maps ?? '-' }}</td>
                        <td class="text-center fw-bold">
                            @if($kategori['is_luas'])
                                {{ $item->luas ?? '-' }}
                            @else
                                {{ $item->jumlah ?? '0' }} Unit
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center" style="color:#555;">Belum ada data untuk kategori {{ $kategori['title'] }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

    <!-- FORMAT TANDA TANGAN -->
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

</body>
</html>