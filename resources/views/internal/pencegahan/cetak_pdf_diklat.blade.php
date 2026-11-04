<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Rekap Peningkatan Kapasitas | SIMERAH KOJA</title>
    <style>
        /* Kertas landscape, margin tipis & font kecil agar muat 16 kolom */
        @page { size: A4 landscape; margin: 10mm; }

        * { box-sizing: border-box; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 11px; color: #000; margin: 0; }

        /* KOP SURAT (Hanya sekali di paling atas) */
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 12px; border-collapse: collapse; }
        .kop-surat td { border: none; padding: 0; vertical-align: middle; }
        .logo-kiri { text-align: left; width: 12%; }
        .logo-kanan { text-align: right; width: 12%; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 15px; font-family: Arial, sans-serif; }
        .teks-tengah .dinas { font-size: 22px; font-weight: bold; font-family: Arial, sans-serif; }
        .teks-tengah .alamat { font-size: 12px; font-family: Arial, sans-serif; }

        /* JUDUL UTAMA DOKUMEN */
        .judul-dokumen { text-align: center; font-weight: bold; font-size: 12px; margin-bottom: 15px; line-height: 1.5; font-family: Arial, sans-serif; }

        /* PEMISAH BAGIAN DIKLAT */
        .section-diklat { margin-bottom: 25px; page-break-inside: avoid; }
        .sub-judul { font-family: Arial, sans-serif; font-size: 11px; font-weight: bold; background: #e9ecef; padding: 5px 8px; border: 1px solid #000; border-bottom: none; text-transform: uppercase; }

        /* TABEL DATA */
        .table-data { width: 100%; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif; font-size: 7px; margin-bottom: 5px; }
        .table-data th, .table-data td {
            border: 1px solid #000; padding: 3px 4px; text-align: left; vertical-align: top;
            word-wrap: break-word; overflow-wrap: anywhere;
        }
        .table-data th { background-color: #f8f9fa; text-align: center; font-weight: bold; vertical-align: middle; text-transform: uppercase; font-size: 6.5px; }
        .table-data thead { display: table-header-group; }
        .text-center { text-align: center; }

        /* RINGKASAN & INFO CETAK */
        .ringkasan { font-family: Arial, sans-serif; font-size: 9px; margin-top: 3px; }
        .cetak-info { margin-top: 15px; font-family: Arial, sans-serif; font-size: 9px; color: #444; text-align: right; }
    </style>
</head>
<body>

    @php
        $daftarBagian = isset($semua_diklat)
            ? $semua_diklat
            : [['judul' => $judul ?? 'DIKLAT', 'data' => $data ?? collect([])]];

        // Tanggal berformat YYYY-MM-DD ditampilkan d-m-Y, teks bebas (data lama) apa adanya
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

    <!-- KOP SURAT (HANYA MUNCUL SEKALI DI AWAL HALAMAN) -->
    <table class="kop-surat">
        <tr>
            <td class="logo-kiri">
                <img src="/images/jambi.png" alt="Logo Jambi" style="width: 75px; height: auto;">
            </td>
            <td class="teks-tengah">
                <span class="pemerintah">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span class="alamat">Jl, HOS Cokroaminoto No, 113 Telp. 0741-41171</span>
            </td>
            <td class="logo-kanan">
                <img src="/images/logo.png" alt="Logo Damkar" style="width: 75px; height: auto;">
            </td>
        </tr>
    </table>

    <!-- JUDUL UTAMA -->
    <div class="judul-dokumen">
        REKAPITULASI JUMLAH APARATUR DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI<br>
        YANG MEMENUHI STANDAR KUALIFIKASI PEMADAM KEBAKARAN (SESUAI PERMENDAGRI 16 TAHUN 2009)<br>
        TAHUN {{ date('Y') }}
    </div>

    <!-- LOOPING TIAP JENIS DIKLAT -->
    @foreach($daftarBagian as $bagian)
    <div class="section-diklat">
        <!-- Penanda Jenis Diklat -->
        <div class="sub-judul">KATEGORI: DATA {{ strtoupper($bagian['judul']) }}</div>

        <table class="table-data">
            <colgroup>
                <col style="width:3%">    <!-- Nomor -->
                <col style="width:9%">    <!-- Nama -->
                <col style="width:7%">    <!-- NIP -->
                <col style="width:5.5%">  <!-- Tempat Lahir -->
                <col style="width:5%">    <!-- Tanggal Lahir -->
                <col style="width:6.5%">  <!-- Pangkat/Golongan Ruang -->
                <col style="width:7%">    <!-- Jabatan -->
                <col style="width:7%">    <!-- Kualifikasi -->
                <col style="width:8%">    <!-- Tempat Pelaksanaan -->
                <col style="width:5.5%">  <!-- Tanggal Pelaksanaan -->
                <col style="width:5.5%">  <!-- Tanggal Selesai Pelaksanaan -->
                <col style="width:4%">    <!-- Jumlah Jam Pelajaran -->
                <col style="width:7%">    <!-- No STTP -->
                <col style="width:5.5%">  <!-- Tanggal STTP -->
                <col style="width:8%">    <!-- Pejabat yang Menandatangani -->
                <col style="width:6.5%">  <!-- Upload Sertifikat -->
            </colgroup>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Pangkat/Golongan Ruang</th>
                    <th>Jabatan</th>
                    <th>Kualifikasi</th>
                    <th>Tempat Pelaksanaan</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Tanggal Selesai Pelaksanaan</th>
                    <th>Jumlah Jam Pelajaran</th>
                    <th>No STTP</th>
                    <th>Tanggal STTP</th>
                    <th>Pejabat yang Menandatangani</th>
                    <th>Upload Sertifikat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bagian['data'] as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama ?? '-' }}</td>
                    <td>{{ $item->nip ?? '-' }}</td>
                    <td>{{ $item->tempat_lahir ?? '-' }}</td>
                    <td>{{ $tampilTanggal($item->tgl_lahir ?? null) }}</td>
                    <td>{{ $item->pangkat_golongan ?? '-' }}</td>
                    <td>{{ $item->jabatan ?? '-' }}</td>
                    <td>{{ $item->kualifikasi ?? '-' }}</td>
                    <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                    <td>{{ $tampilTanggal($item->tanggal_pelaksanaan ?? null) }}</td>
                    <td>{{ $tampilTanggal($item->tanggal_selesai_pelaksanaan ?? null) }}</td>
                    <td class="text-center">{{ $item->jumlah_jam_pelajaran ?? '-' }}</td>
                    <td>{{ $item->no_sttp ?? '-' }}</td>
                    <td>{{ $tampilTanggal($item->tanggal_sttp ?? null) }}</td>
                    <td>{{ $item->ditandatangani_oleh ?? '-' }}</td>
                    <td class="text-center">{{ ! empty($item->file_sertifikat) ? 'Ada' : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="16" class="text-center">Belum ada data {{ $bagian['judul'] }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="ringkasan"><strong>Total data {{ $bagian['judul'] }}:</strong> {{ count($bagian['data']) }} orang</div>
    </div>
    @endforeach

    <div class="cetak-info">
        Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB melalui SIMERAH KOJA
    </div>

    <script>
        window.onload = function () { window.print(); }
    </script>
</body>
</html>