<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Prasarana Mako & Pos</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h4 { text-align: center; margin: 5px 0; }
        .pos-title { font-size: 14px; font-weight: bold; margin-top: 20px; background-color: #f0f0f0; padding: 5px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #333; color: white; text-align: center; }
        .text-center { text-align: center; }
        .img-prasarana { width: 120px; height: auto; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>DATA PRASARANA MAKO & POS</h2>
    <h4>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</h4>
    <hr style="margin-bottom: 20px;">

    @foreach($posPemadam as $pos)
        <div class="pos-title">{{ $pos->nama_pos }}</div>
        <p style="margin: 5px 0;"><strong>Alamat:</strong> {{ $pos->alamat ?? '-' }} | <strong>Kode Map:</strong> {{ $pos->kode_map ?? '-' }}</p>

        <table>
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="45%">JENIS PRASARANA</th>
                    <th width="50%">GAMBAR</th>
                </tr>
            </thead>
            <tbody>
                @php $dataFilter = $dataPrasarana->where('id_pos', $pos->id_pos); @endphp
                
                @forelse($dataFilter as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->jenis_prasarana }}</td>
                        <td class="text-center">
                            <!-- Cek apakah gambar ada di folder server -->
                            @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                <img src="{{ public_path($item->path_gambar) }}" class="img-prasarana">
                            @else
                                <i>Tidak ada gambar</i>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data prasarana untuk pos ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</body>
</html>