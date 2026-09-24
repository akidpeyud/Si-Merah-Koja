<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Hidrant Kota Jambi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 20px;
        }

        /* =======================================================
           KOP SURAT STYLES
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

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold; }
        
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

        /* Sembunyikan elemen ini saat diunduh sebagai Excel */
        @media print {
            body { padding: 0; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT MENGGUNAKAN TEKNIK BASE64 AGAR BACA DI PDF -->
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
                    $damkarPath = public_path('images/logo.png');
                    $damkarLogo = file_exists($damkarPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($damkarPath)) : '';
                @endphp
                @if($damkarLogo)
                    <img src="{{ $damkarLogo }}" alt="Logo Yudha Brama Jaya">
                @else
                    <span style="font-size:10px;">(Logo Damkar)</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- JUDUL LAPORAN -->
    <div class="doc-title">
        <h3>REKAPITULASI DATA HIDRANT DI KOTA JAMBI</h3>
    </div>

    <!-- TABEL DATA -->
    <table class="data-table">
        <thead>
            <tr>
                <th width="3%">NO</th>
                <th width="15%">JALAN</th>
                <th width="12%">KECAMATAN</th>
                <th width="12%">KELURAHAN</th>
                <th width="5%">RT</th>
                <th width="15%">LOKASI TERDEKAT</th>
                <th width="8%">KODE MAP</th>
                <th width="7%">KONDISI</th>
                <th width="7%">TEKANAN</th>
                <th width="7%">MACHINO</th>
                <th width="15%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataMaintenance as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->jalan }}</td>
                <td>{{ $item->kecamatan }}</td>
                <td>{{ $item->kelurahan }}</td>
                <td class="text-center">{{ $item->rt ?? '-' }}</td>
                <td>{{ $item->lokasi_terdekat }}</td>
                <td class="text-center">{{ $item->kode_map ?? '-' }}</td>
                <td class="text-center fw-bold">{{ $item->kondisi_hidran }}</td>
                <td class="text-center fw-bold">{{ $item->tekanan }}</td>
                <td class="text-center fw-bold">{{ $item->machino }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Belum ada data hidrant kota.</td>
            </tr>
            @endforelse
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