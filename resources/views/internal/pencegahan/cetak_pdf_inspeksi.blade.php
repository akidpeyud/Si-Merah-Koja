<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Inspeksi Bangunan | SIMERAH KOJA</title>
    <style>
        @page { size: A4 landscape; margin: 10mm; }
        * { box-sizing: border-box; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 11px; color: #000; margin: 0; background: #fff; }

        /* KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 12px; border-collapse: collapse; }
        .kop-surat td { border: none; padding: 0; vertical-align: middle; }
        .logo-kiri { text-align: left; width: 12%; }
        .logo-kanan { text-align: right; width: 12%; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 15px; font-family: Arial, sans-serif; }
        .teks-tengah .dinas { font-size: 22px; font-weight: bold; font-family: Arial, sans-serif; }
        .teks-tengah .alamat { font-size: 12px; font-family: Arial, sans-serif; }

        .judul-dokumen { text-align: center; font-weight: bold; font-size: 12px; margin-bottom: 14px; line-height: 1.5; font-family: Arial, sans-serif; }

        /* TABEL */
        .table-data { width: 100%; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif; font-size: 8px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 4px 5px; text-align: left; vertical-align: top; word-wrap: break-word; overflow-wrap: anywhere; }
        .table-data th { background-color: #e9ecef; text-align: center; font-weight: bold; vertical-align: middle; text-transform: uppercase; font-size: 7.5px; }
        .table-data thead { display: table-header-group; }
        .table-data tr { page-break-inside: avoid; }
        .text-center { text-align: center; }

        .ringkasan { margin-top: 10px; font-family: Arial, sans-serif; font-size: 10px; }
        .cetak-info { margin-top: 4px; font-family: Arial, sans-serif; font-size: 9px; color: #444; }

        @media print {
            body { background: #fff !important; }
        }
    </style>
</head>
<body>

    @php
        $tampilTanggal = function ($nilai) {
            $nilai = trim((string) $nilai);
            if ($nilai === '') {
                return '-';
            }

            return preg_match('/^\d{4}-\d{2}-\d{2}/', $nilai)
                ? \Carbon\Carbon::parse($nilai)->format('d-m-Y')
                : $nilai;
        };
    @endphp

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="logo-kiri"><img src="/images/jambi.png" alt="Logo Jambi" style="width: 75px; height: auto;"></td>
            <td class="teks-tengah">
                <span class="pemerintah">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span class="alamat">Jl, HOS Cokroaminoto No, 113 Telp. 0741-41171</span>
            </td>
            <td class="logo-kanan"><img src="/images/logo.png" alt="Logo Damkar" style="width: 75px; height: auto;"></td>
        </tr>
    </table>

    <div class="judul-dokumen">
        DATA INSPEKSI KEBAKARAN BANGUNAN GEDUNG DAN LINGKUNGAN<br>
        TAHUN {{ date('Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <colgroup>
            <col style="width:3.5%">  <!-- No -->
            <col style="width:10%">   <!-- Nama Bangunan -->
            <col style="width:7.5%">  <!-- Jenis Bangunan -->
            <col style="width:7%">    <!-- Kualifikasi Bangunan -->
            <col style="width:7%">    <!-- Resiko Kebakaran -->
            <col style="width:6.5%">  <!-- Luas Bangunan -->
            <col style="width:11%">   <!-- Alamat -->
            <col style="width:9%">    <!-- Nama Penanggung Jawab -->
            <col style="width:7.5%">  <!-- No Telfon -->
            <col style="width:11%">   <!-- Sistem Proteksi Kebakaran -->
            <col style="width:7%">    <!-- Tanggal Pemeriksaan -->
            <col style="width:6.5%">  <!-- Upload SPT -->
            <col style="width:6.5%">  <!-- Upload Rekomendasi -->
        </colgroup>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bangunan</th>
                <th>Jenis Bangunan</th>
                <th>Kualifikasi Bangunan</th>
                <th>Resiko Kebakaran</th>
                <th>Luas Bangunan</th>
                <th>Alamat</th>
                <th>Nama Penanggung Jawab</th>
                <th>No Telfon</th>
                <th>Sistem Proteksi Kebakaran</th>
                <th>Tanggal Pemeriksaan</th>
                <th>Upload SPT</th>
                <th>Upload Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_tempat ?? '-' }}</td>
                <td>{{ $item->jenis_usaha ?? '-' }}</td>
                <td class="text-center">{{ $item->kualifikasi_bangunan ?? '-' }}</td>
                <td class="text-center">{{ $item->resiko_kebakaran ?? '-' }}</td>
                <td class="text-center">{{ $item->luas_bangunan ?? '-' }}</td>
                <td>{{ $item->alamat ?? '-' }}</td>
                <td>{{ $item->nama_penanggung_jawab ?? '-' }}</td>
                <td class="text-center">{{ $item->no_telepon ?? '-' }}</td>
                <td class="text-center">{{ $item->sistem_proteksi_kebakaran ?? '-' }}</td>
                <td class="text-center">{{ $tampilTanggal($item->tanggal_inspeksi ?? null) }}</td>
                <td class="text-center">{{ !empty($item->surat_perintah_tugas) ? 'Ada' : '-' }}</td>
                <td class="text-center">{{ !empty($item->rekomendasi) ? 'Ada' : '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="13" class="text-center">Belum ada data Inspeksi Bangunan</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="ringkasan"><strong>Total data:</strong> {{ count($data) }} bangunan</div>
    <div class="cetak-info">Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB melalui SIMERAH KOJA</div>

    <script>window.onload = function () { window.print(); }</script>
</body>
</html>
