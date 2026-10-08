<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data {{ $judul ?? 'Diklat' }} | SIMERAH KOJA</title>
    <style>
        /* Kertas landscape, 21 kolom -> margin tipis & font kecil */
        @page { size: A4 landscape; margin: 10mm; }

        * { box-sizing: border-box; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 11px; color: #000; margin: 0; }

        /* KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 12px; border-collapse: collapse; }
        .kop-surat td { border: none; padding: 0; vertical-align: middle; }
        .logo-kiri { text-align: left; width: 12%; }
        .logo-kanan { text-align: right; width: 12%; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 15px; font-family: Arial, sans-serif; }
        .teks-tengah .dinas { font-size: 22px; font-weight: bold; font-family: Arial, sans-serif; }
        .teks-tengah .alamat { font-size: 12px; font-family: Arial, sans-serif; }

        /* JUDUL DOKUMEN */
        .judul-dokumen { text-align: center; font-weight: bold; font-size: 12px; margin-bottom: 12px; line-height: 1.5; font-family: Arial, sans-serif; }

        /* TABEL DATA */
        .table-data { width: 100%; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif; font-size: 7px; }
        .table-data th, .table-data td {
            border: 1px solid #000; padding: 3px 4px; text-align: left; vertical-align: top;
            word-wrap: break-word; overflow-wrap: anywhere;
        }
        .table-data th { background-color: #e9ecef; text-align: center; font-weight: bold; vertical-align: middle; text-transform: uppercase; font-size: 6.5px; }
        .table-data thead { display: table-header-group; }   /* header diulang tiap halaman */
        .table-data tr { page-break-inside: avoid; }
        .text-center { text-align: center; }

        /* RINGKASAN & TANDA TANGAN */
        .ringkasan { margin-top: 10px; font-family: Arial, sans-serif; font-size: 10px; }
        .cetak-info { margin-top: 4px; font-family: Arial, sans-serif; font-size: 9px; color: #444; }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
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

    <!-- JUDUL DOKUMEN -->
    <div class="judul-dokumen">
        JUMLAH APARATUR DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI<br>
        YANG MEMENUHI STANDAR KUALIFIKASI PEMADAM KEBAKARAN<br>
        ( SESUAI PERMENDAGRI 16 TAHUN 2009 / DATA {{ strtoupper($judul ?? 'DIKLAT') }} )<br>
        TAHUN {{ date('Y') }}
    </div>

    <!-- TABEL DATA (21 KOLOM, SAMA DENGAN TABEL DI HALAMAN) -->
    <table class="table-data">
        <colgroup>
            <col style="width:2.5%">  <!-- No -->
            <col style="width:7%">    <!-- Nama -->
            <col style="width:4.5%">  <!-- Tempat Lahir -->
            <col style="width:4.5%">  <!-- Tgl Lahir -->
            <col style="width:6.5%">  <!-- NIK -->
            <col style="width:4.5%">  <!-- Jabatan -->
            <col style="width:6%">    <!-- Instansi -->
            <col style="width:5%">    <!-- Ditanda tangani -->
            <col style="width:4.5%">  <!-- Tgl Pelaksanaan -->
            <col style="width:3.5%">  <!-- Jam Pelajaran -->
            <col style="width:5.5%">  <!-- Penyelenggara -->
            <col style="width:4%">    <!-- Provinsi -->
            <col style="width:4%">    <!-- Kota -->
            <col style="width:6%">    <!-- No Sertifikat -->
            <col style="width:4.5%">  <!-- Kode Verifikasi -->
            <col style="width:3.5%">  <!-- Persentase -->
            <col style="width:4%">    <!-- Jenis Diklat -->
            <col style="width:4.5%">  <!-- Created at -->
            <col style="width:4.5%">  <!-- Updated at -->
            <col style="width:4%">    <!-- TTL -->
            <col style="width:4%">    <!-- Ket -->
        </colgroup>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tgl Lahir</th>
                <th>NIK</th>
                <th>Jabatan</th>
                <th>Instansi / Perangkat Daerah</th>
                <th>Ditanda Tangani Oleh</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Jumlah Jam Pelajaran</th>
                <th>Instansi Penyelenggara</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Nomor Sertifikat</th>
                <th>Kode Verifikasi</th>
                <th>Persentase Penilaian</th>
                <th>Jenis Diklat</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>TTL</th>
                <th>Ket</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama ?? '-' }}</td>
                <td>{{ $item->tempat_lahir ?? '-' }}</td>
                <td>{{ $item->tgl_lahir ?? '-' }}</td>
                <td>{{ $item->nik ?? '-' }}</td>
                <td>{{ $item->jabatan ?? '-' }}</td>
                <td>{{ $item->instansi ?? '-' }}</td>
                <td>{{ $item->ditandatangani_oleh ?? '-' }}</td>
                <td>{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
                <td class="text-center">{{ $item->jumlah_jam_pelajaran ?? '-' }}</td>
                <td>{{ $item->instansi_penyelenggara ?? '-' }}</td>
                <td>{{ $item->provinsi ?? '-' }}</td>
                <td>{{ $item->kota ?? '-' }}</td>
                <td>{{ $item->nomor_sertifikat ?? '-' }}</td>
                <td>{{ $item->kode_verifikasi ?? '-' }}</td>
                <td class="text-center">{{ $item->persentase_penilaian ?? '-' }}</td>
                <td>{{ $item->jenis_diklat ?? '-' }}</td>
                <td>{{ $item->created_at ?? '-' }}</td>
                <td>{{ $item->updated_at ?? '-' }}</td>
                <td>{{ $item->ttl ?? '-' }}</td>
                <td>{{ $item->ket ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="21" class="text-center">Belum ada data {{ $judul ?? 'Diklat' }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ringkasan"><strong>Total data:</strong> {{ count($data) }} orang</div>
    <div class="cetak-info">Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB melalui SIMERAH KOJA</div>

    <!-- Auto Print -->
    <script>
        window.onload = function () { window.print(); }
    </script>
</body>
</html>