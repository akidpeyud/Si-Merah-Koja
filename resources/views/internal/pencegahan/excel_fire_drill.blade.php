<meta charset="UTF-8">
<style>
    table { border-collapse: collapse; font-family: Arial, sans-serif; font-size: 11pt; }
    th, td { border: 1px solid #000000; padding: 5px 8px; }
    .header-title { font-weight: bold; font-size: 14pt; text-align: center; border: none; }
    .header-sub { font-weight: bold; font-size: 12pt; text-align: center; border: none; }
    .th-head { background-color: #f2f2f2; font-weight: bold; text-align: center; vertical-align: middle; }
    .td-center { text-align: center; vertical-align: middle; }
    .td-middle { vertical-align: middle; }
    .td-top { vertical-align: top; }
</style>

<table border="1">
    <tr>
        <td colspan="10" class="header-title">DATA PELAKSANAAN FIRE DRILL KOTA JAMBI</td>
    </tr>
    <tr>
        <td colspan="10" class="header-sub">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</td>
    </tr>
    <tr><td colspan="10" style="border:none;"></td></tr>

    <tr class="th-head">
        <th rowspan="2" width="45">NO</th>
        <th rowspan="2" width="220">NAMA INSTANSI</th>
        <th rowspan="2" width="70">TAHUN</th>
        <th rowspan="2" width="160">TANGGAL PELAKSANAAN</th>
        <th rowspan="2" width="200">TEMPAT PELAKSANAAN</th>
        <th colspan="3">JUMLAH PESERTA</th>
        <th colspan="2">DAFTAR NAMA PESERTA</th>
    </tr>
    <tr class="th-head">
        <th width="90">LAKI-LAKI</th>
        <th width="90">PEREMPUAN</th>
        <th width="80">TOTAL</th>
        <th width="220">NAMA PESERTA LAKI-LAKI</th>
        <th width="220">NAMA PESERTA PEREMPUAN</th>
    </tr>

    @forelse($data as $index => $item)
        @php
            $listLaki = !empty($item->nama_peserta_laki_laki) 
                ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_laki_laki)))) 
                : [];
            $listPerempuan = !empty($item->nama_peserta_perempuan) 
                ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_perempuan)))) 
                : [];
            
            $punyaDetailGender = ($item->peserta_laki_laki > 0 || $item->peserta_perempuan > 0 || count($listLaki) > 0 || count($listPerempuan) > 0);
            
            // Hitung jumlah baris yang dibutuhkan untuk instansi ini (minimal 1 baris)
            $maxBaris = max(1, count($listLaki), count($listPerempuan));
        @endphp

        @for($i = 0; $i < $maxBaris; $i++)
        <tr>
            @if($i === 0)
                <td rowspan="{{ $maxBaris }}" class="td-center">{{ $index + 1 }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-middle">{{ $item->nama_instansi ?? '-' }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-center">{{ $item->tahun ?? '-' }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-center">{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-middle">{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-center">{{ $punyaDetailGender ? ($item->peserta_laki_laki ?? 0) : '-' }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-center">{{ $punyaDetailGender ? ($item->peserta_perempuan ?? 0) : '-' }}</td>
                <td rowspan="{{ $maxBaris }}" class="td-center" style="font-weight:bold;">{{ $item->total_peserta ?? 0 }}</td>
            @endif

            <!-- Kolom Nama Peserta Laki-laki per baris -->
            <td class="td-top">
                @if(isset($listLaki[$i]))
                    {{ ($i + 1) . '. ' . $listLaki[$i] }}
                @elseif($i === 0 && count($listLaki) === 0)
                    -
                @endif
            </td>

            <!-- Kolom Nama Peserta Perempuan per baris -->
            <td class="td-top">
                @if(isset($listPerempuan[$i]))
                    {{ ($i + 1) . '. ' . $listPerempuan[$i] }}
                @elseif($i === 0 && count($listPerempuan) === 0)
                    -
                @endif
            </td>
        </tr>
        @endfor
    @empty
    <tr>
        <td colspan="10" align="center">Belum ada data Fire Drill</td>
    </tr>
    @endforelse
</table>