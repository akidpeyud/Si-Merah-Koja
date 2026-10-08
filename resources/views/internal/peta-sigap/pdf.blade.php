<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Titik SIGAP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <h2>Laporan Data Titik SIGAP</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nama Titik</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titikSigaps as $index => $titik)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $titik->kategori)) }}</td>
                    <td>{{ $titik->nama }}</td>
                    <td>{{ $titik->tanggal ? \Carbon\Carbon::parse($titik->tanggal)->format('d M Y') : '-' }}</td>
                    <td>{{ $titik->lokasi }}</td>
                    <td>{{ $titik->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data titik SIGAP.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>