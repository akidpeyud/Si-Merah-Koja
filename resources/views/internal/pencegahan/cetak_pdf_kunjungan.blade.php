<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Kunjungan Sekolah</title>
    <style>
        @page { size: A4 landscape; margin: 15mm; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; color: #000; }
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 15px; }
        .kop-surat td { padding: 0; vertical-align: middle; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .dinas { font-size: 22px; font-weight: bold; font-family: Arial, sans-serif; }
        .judul { text-align: center; font-weight: bold; font-size: 14px; margin-bottom: 15px; font-family: Arial, sans-serif; }
        .table-data { width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 11px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px 8px; text-align: center; vertical-align: middle; }
        .table-data th { background-color: #e9ecef; font-weight: bold; }
        .table-data td.kiri { text-align: left; }
    </style>
</head>
<body>
    <table class="kop-surat">
        <tr>
            <td width="12%"><img src="/images/jambi.png" style="width: 75px;"></td>
            <td class="teks-tengah">
                <span style="font-size: 15px; font-family: Arial;">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span style="font-size: 12px; font-family: Arial;">Jl, HOS Cokroaminoto No, 113 Telp. 0741-41171</span>
            </td>
            <td width="12%" align="right"><img src="/images/logo.png" style="width: 75px;"></td>
        </tr>
    </table>

    <div class="judul">
        DATA KUNJUNGAN SEKOLAH KE DINAS PEMADAM KEBAKARAN<br>
        {{ $tahunDipilih ? "TAHUN " . $tahunDipilih : "TAHUN " . date('Y') }}
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th rowspan="2" width="5%">No</th>
                <th rowspan="2" width="25%">Nama Sekolah</th>
                <th rowspan="2" width="20%">Tanggal</th>
                <th colspan="4">Banyak Kunjungan</th>
                <th rowspan="2" width="10%">Total</th>
            </tr>
            <tr>
                <th width="10%">Siswa Pr</th>
                <th width="10%">Siswa Lk</th>
                <th width="10%">Guru</th>
                <th width="10%">Orang Tua</th>
            </tr>
        </thead>
        <tbody>
            @php $gTotal = 0; @endphp
            @forelse($data as $index => $item)
                @php $gTotal += $item->total_kunjungan; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="kiri">{{ $item->nama_sekolah }}</td>
                    <td>{{ $item->tanggal_kunjungan }}</td>
                    <td>{{ $item->siswa_perempuan }}</td>
                    <td>{{ $item->siswa_laki_laki }}</td>
                    <td>{{ $item->guru }}</td>
                    <td>{{ $item->orang_tua }}</td>
                    <td><b>{{ $item->total_kunjungan }}</b></td>
                </tr>
            @empty
                <tr><td colspan="8">Belum ada data kunjungan.</td></tr>
            @endforelse
            @if($data->isNotEmpty())
                <tr>
                    <td colspan="7" align="right" style="padding-right: 15px;"><b>TOTAL KESELURUHAN PESERTA</b></td>
                    <td><b>{{ $gTotal }}</b></td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>window.onload = function() { window.print(); }</script>
</body>
</html>