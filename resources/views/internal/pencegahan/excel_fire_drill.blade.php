<meta charset="UTF-8">
<table border="1">
    <tr>
        <td colspan="10" align="center" style="font-weight:bold; font-size:14px;">
            DATA PELAKSANAAN FIRE DRILL KOTA JAMBI
        </td>
    </tr>
    <tr>
        <td colspan="10" align="center" style="font-weight:bold;">
            DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI
        </td>
    </tr>
    <tr><td colspan="10"></td></tr>

    <tr style="background-color:#f2f2f2; font-weight:bold;" align="center">
        <th rowspan="2">NO</th>
        <th rowspan="2">NAMA INSTANSI</th>
        <th rowspan="2">TAHUN</th>
        <th rowspan="2">TANGGAL PELAKSANAAN</th>
        <th rowspan="2">TEMPAT PELAKSANAAN</th>
        <th colspan="3">JUMLAH PESERTA</th>
        <th colspan="2">DAFTAR NAMA PESERTA</th>
    </tr>
    <tr style="background-color:#f2f2f2; font-weight:bold;" align="center">
        <th>LAKI-LAKI</th>
        <th>PEREMPUAN</th>
        <th>TOTAL</th>
        <th>NAMA PESERTA LAKI-LAKI</th>
        <th>NAMA PESERTA PEREMPUAN</th>
    </tr>

    @forelse($data as $index => $item)
    @php
        $listLaki = !empty($item->nama_peserta_laki_laki) ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_laki_laki)))) : [];
        $listPerempuan = !empty($item->nama_peserta_perempuan) ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_perempuan)))) : [];
        $punyaDetailGender = ($item->peserta_laki_laki > 0 || $item->peserta_perempuan > 0 || count($listLaki) > 0 || count($listPerempuan) > 0);

        $formatNamaLaki = count($listLaki) > 0 
            ? collect($listLaki)->map(fn($n, $i) => ($i + 1) . '. ' . $n)->implode(', ') 
            : '-';
        $formatNamaPerempuan = count($listPerempuan) > 0 
            ? collect($listPerempuan)->map(fn($n, $i) => ($i + 1) . '. ' . $n)->implode(', ') 
            : '-';
    @endphp
    <tr>
        <td align="center" valign="top">{{ $index + 1 }}</td>
        <td valign="top">{{ $item->nama_instansi ?? '-' }}</td>
        <td align="center" valign="top">{{ $item->tahun ?? '-' }}</td>
        <td align="center" valign="top">{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
        <td valign="top">{{ $item->tempat_pelaksanaan ?? '-' }}</td>
        <td align="center" valign="top">{{ $punyaDetailGender ? ($item->peserta_laki_laki ?? 0) : '-' }}</td>
        <td align="center" valign="top">{{ $punyaDetailGender ? ($item->peserta_perempuan ?? 0) : '-' }}</td>
        <td align="center" valign="top" style="font-weight:bold;">{{ $item->total_peserta ?? 0 }}</td>
        <td valign="top">{{ $formatNamaLaki }}</td>
        <td valign="top">{{ $formatNamaPerempuan }}</td>
    </tr>
    @empty
    <tr><td colspan="10" align="center">Belum ada data Fire Drill</td></tr>
    @endforelse
</table>