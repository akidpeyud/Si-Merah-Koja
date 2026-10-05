<meta charset="UTF-8">
<table border="1">
    <tr>
        <td colspan="8" align="center" style="font-weight:bold; font-size:14px;">
            DATA PELAKSANAAN FIRE DRILL KOTA JAMBI
        </td>
    </tr>
    <tr>
        <td colspan="8" align="center">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</td>
    </tr>
    <tr><td colspan="8"></td></tr>

    <tr style="background-color:#f2f2f2; font-weight:bold;" align="center">
        <th rowspan="2">NO</th>
        <th rowspan="2">NAMA INSTANSI</th>
        <th rowspan="2">TAHUN</th>
        <th rowspan="2">TANGGAL PELAKSANAAN</th>
        <th rowspan="2">TEMPAT PELAKSANAAN</th>
        <th colspan="3">JUMLAH PESERTA</th>
    </tr>
    <tr style="background-color:#f2f2f2; font-weight:bold;" align="center">
        <th>LAKI-LAKI</th>
        <th>PEREMPUAN</th>
        <th>TOTAL</th>
    </tr>

    @forelse($data as $index => $item)
    <tr>
        <td align="center">{{ $index + 1 }}</td>
        <td>{{ $item->nama_instansi ?? '-' }}</td>
        <td align="center">{{ $item->tahun ?? '-' }}</td>
        <td align="center">{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
        <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
        <td align="center">{{ $item->peserta_laki_laki ?? 0 }}</td>
        <td align="center">{{ $item->peserta_perempuan ?? 0 }}</td>
        <td align="center">{{ $item->total_peserta ?? 0 }}</td>
    </tr>
    @empty
    <tr><td colspan="8" align="center">Belum ada data Fire Drill</td></tr>
    @endforelse
</table>