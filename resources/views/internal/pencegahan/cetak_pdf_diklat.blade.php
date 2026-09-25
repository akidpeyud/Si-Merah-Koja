<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        /* Pengaturan Kertas Landscape biar muat banyak kolom */
        @page { size: landscape; margin: 15mm; }
        
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; color: #000; }
        
        /* STYLE KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 15px; }
        .kop-surat td { border: none; padding: 0; } /* Hilangkan border tabel khusus untuk kop */
        .logo-kiri { text-align: left; width: 15%; }
        .logo-kanan { text-align: right; width: 15%; }
        .teks-tengah { text-align: center; width: 70%; line-height: 1.3; }
        
        .teks-tengah .pemerintah { font-size: 16px; font-family: Arial, sans-serif; }
        .teks-tengah .dinas { font-size: 24px; font-weight: bold; font-family: Arial, sans-serif; }
        .teks-tengah .alamat { font-size: 13px; font-family: Arial, sans-serif; }

        /* STYLE JUDUL DOKUMEN */
        .judul-dokumen { text-align: center; font-weight: bold; font-size: 13px; margin-bottom: 20px; line-height: 1.5; font-family: Arial, sans-serif; }

        /* STYLE TABEL DATA */
        .table-data { width: 100%; border-collapse: collapse; margin-top: 10px; font-family: Arial, sans-serif; font-size: 11px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px 8px; text-align: left; }
        .table-data th { background-color: #f2f2f2; text-align: center; font-weight: bold; vertical-align: middle; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

   <!-- KOP SURAT MERUJUK PADA FOTO -->
    <table class="kop-surat">
        <tr>
            <!-- Logo Kiri: Kota Jambi -->
            <td class="logo-kiri">
                <img src="/images/jambi.png" alt="Logo Jambi" style="width: 80px; height: auto;">
            </td>
            
            <td class="teks-tengah">
                <span class="pemerintah">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span class="alamat">Jl, HOS Cokroaminoto No, 113 Telp. 0741-41171</span>
            </td>
            
            <!-- Logo Kanan: Damkar -->
            <td class="logo-kanan">
                <img src="/images/logo.png" alt="Logo Damkar" style="width: 80px; height: auto;">
            </td>
        </tr>
    </table>
    
    <!-- JUDUL DOKUMEN -->
    <div class="judul-dokumen">
        JUMLAH APARATUR DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI<br>
        YANG MEMENUHI STANDAR KUALIFIKASI PEMADAM KEBAKARAN<br>
        ( SESUAI PERMENDAGRI 16 TAHUN 2009 / DATA {{ strtoupper($judul) }} )<br>
        TAHUN {{ date('Y') }}
    </div>
    
    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th width="3%">NO</th>
                <th width="15%">NAMA</th>
                <th width="10%">TEMPAT LAHIR</th>
                <th width="10%">TGL LAHIR</th>
                <th width="12%">NIK</th>
                <th width="10%">JABATAN</th>
                <th width="15%">INSTANSI/PERANGKAT DAERAH</th>
                <th width="15%">DITANDA TANGANI OLEH</th>
                <th width="10%">TANGGAL</th>
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
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Belum ada data {{ $judul }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Auto Print -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>