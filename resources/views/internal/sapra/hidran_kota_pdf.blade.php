<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Hidrant Kota Jambi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; color: #333; }
        .header-title { text-align: center; margin-bottom: 20px; color: #0f172a; }
        .header-title h2 { margin: 0; padding: 0; font-size: 14px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #64748b; }
        th { background-color: #f1f5f9; padding: 8px 5px; text-align: center; text-transform: uppercase; }
        td { padding: 6px; vertical-align: middle; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
    </style>
</head>
<body>

    <div class="header-title">
        <h2>DATA HIDRANT DI KOTA JAMBI</h2>
        <p style="margin-top: 5px; font-size: 11px;">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</p>
    </div>

    <table>
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
            <tr><td colspan="11" class="text-center">Belum ada data hidrant kota.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>