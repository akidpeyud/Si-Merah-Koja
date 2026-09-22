<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
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
=======
    <title>Laporan Data Prasarana Mako & Pos</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h2, h4 { text-align: center; margin: 5px 0; }
        .pos-title { font-size: 14px; font-weight: bold; margin-top: 20px; background-color: #e2e8f0; padding: 8px; text-transform: uppercase; border-left: 4px solid #0284c7; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #94a3b8; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #1e293b; color: white; text-align: center; font-size: 11px; letter-spacing: 0.5px; }
        .text-center { text-align: center; }
        .img-prasarana { width: 150px; height: auto; border-radius: 4px; border: 1px solid #ccc; padding: 2px; }
        
        /* Tambahan untuk styling Nama Prasarana & Luas Bangunan */
        .prasarana-name { font-weight: bold; font-size: 13px; text-transform: uppercase; margin-bottom: 3px; }
        .prasarana-meta { font-size: 11px; color: #475569; margin-top: 4px; }
    </style>
</head>
<body>
    <h2>LAPORAN DATA PRASARANA MARKAS KOMANDO & POS</h2>
    <h4>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</h4>
    <hr style="margin-bottom: 20px; border: 1px solid #0f172a;">

    @foreach($posPemadam as $pos)
        <div class="pos-title">{{ $pos->nama_pos }}</div>
        <p style="margin: 6px 0; font-size: 11px;">
            <strong>Alamat:</strong> {{ $pos->alamat ?? '-' }} &nbsp;|&nbsp; 
            <strong>Kode Map:</strong> {{ $pos->kode_map ?? '-' }}
        </p>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573

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
<<<<<<< HEAD
                        <td>{{ $item->jenis_prasarana }}</td>
=======
                        <td>
                            <!-- Nama Prasarana -->
                            <div class="prasarana-name">{{ $item->jenis_prasarana }}</div>
                            
                            <!-- Munculin Luas Tanah/Bangunan kalau ada isinya -->
                            @if($item->luas_bangunan)
                                <div class="prasarana-meta">
                                    <span>Luas: {{ $item->luas_bangunan }}</span>
                                </div>
                            @endif
                        </td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                        <td class="text-center">
                            <!-- Cek apakah gambar ada di folder server -->
                            @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                <img src="{{ public_path($item->path_gambar) }}" class="img-prasarana">
                            @else
<<<<<<< HEAD
                                <i>Tidak ada gambar</i>
=======
                                <i style="color: #94a3b8; font-size: 11px;">Tidak ada gambar</i>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
<<<<<<< HEAD
                        <td colspan="3" class="text-center">Belum ada data prasarana untuk pos ini.</td>
=======
                        <td colspan="3" class="text-center" style="padding: 15px; color: #64748b;">
                            Belum ada data prasarana untuk pos ini.
                        </td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</body>
</html>