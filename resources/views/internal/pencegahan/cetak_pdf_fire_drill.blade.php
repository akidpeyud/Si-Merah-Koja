<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Fire Drill</title>
    <style>
        @page { size: landscape; margin: 15mm; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; color: #000; }
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 15px; }
        .kop-surat td { border: none; padding: 0; }
        .logo-kiri { text-align: left; width: 15%; }
        .logo-kanan { text-align: right; width: 15%; }
        .teks-tengah { text-align: center; width: 70%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 16px; font-family: Arial, sans-serif; }
        .teks-tengah .dinas { font-size: 24px; font-weight: bold; font-family: Arial, sans-serif; }
        .teks-tengah .alamat { font-size: 13px; font-family: Arial, sans-serif; }
        .judul-dokumen { text-align: center; font-weight: bold; font-size: 14px; margin-bottom: 20px; line-height: 1.5; font-family: Arial, sans-serif; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 10px; font-family: Arial, sans-serif; font-size: 12px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table-data th { background-color: #f2f2f2; text-align: center; font-weight: bold; vertical-align: middle; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <table class="kop-surat">
        <tr>
            <td class="logo-kiri"><img src="/images/jambi.png" alt="Logo Jambi" style="width: 80px; height: auto;"></td>
            <td class="teks-tengah">
                <span class="pemerintah">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span class="alamat">Jl, HOS Cokroaminoto No, 113 Telp. 0741-41171</span>
            </td>
            <td class="logo-kanan"><img src="/images/logo.png" alt="Logo Damkar" style="width: 80px; height: auto;"></td>
        </tr>
    </table>
    
    <div class="judul-dokumen">
        DATA PELAKSANAAN FIRE DRILL KOTA JAMBI<br>
        TAHUN {{ date('Y') }}
    </div>
    
    <table class="table-data">
        <thead>
            <tr>
                <th rowspan="2" width="5%">NO</th>
                <th rowspan="2" width="20%">NAMA INSTANSI</th>
                <th rowspan="2" width="10%">TAHUN</th>
                <th rowspan="2" width="15%">TANGGAL PELAKSANAAN</th>
                <th rowspan="2" width="20%">TEMPAT PELAKSANAAN</th>
                <th colspan="3">JUMLAH PESERTA</th>
            </tr>
            <tr>
                <th width="10%">LAKI-LAKI</th>
                <th width="10%">PEREMPUAN</th>
                <th width="10%">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_instansi ?? '-' }}</td>
                <td class="text-center">{{ $item->tahun ?? '-' }}</td>
                <td class="text-center">{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
                <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                <td class="text-center">{{ $item->peserta_laki_laki ?? '0' }}</td>
                <td class="text-center">{{ $item->peserta_perempuan ?? '0' }}</td>
                <td class="text-center fw-bold">{{ $item->total_peserta ?? '0' }}</td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada data Fire Drill</td></tr>
            @endforelse
        </tbody>
    </table>
    <script>window.onload = function() { window.print(); }</script>
</body>
</html>