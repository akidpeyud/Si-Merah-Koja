<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Sarana Penyelamatan - PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0 0 5px 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 0; font-size: 12px; color: #555; }
        
        .pos-section { margin-bottom: 30px; page-break-inside: avoid; }
        .pos-title { font-size: 14px; font-weight: bold; background-color: #f1f5f9; padding: 8px; border: 1px solid #cbd5e1; margin-bottom: 0; text-transform: uppercase; }
        .pos-address { font-size: 11px; padding: 5px 8px; border: 1px solid #cbd5e1; border-top: none; margin-bottom: 10px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #e2e8f0; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        
        .img-container { width: 120px; height: 80px; text-align: center; }
        .img-container img { max-width: 100%; max-height: 100%; object-fit: contain; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Data Sarana Penyelamatan (Rescue)</h2>
        <p>Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi</p>
    </div>

    @foreach($posPemadam as $pos)
        @php 
            // Saring data sesuai pos yang sedang di-looping
            $dataFilter = $dataPenyelamatan->where('id_pos', $pos->id_pos); 
        @endphp

        <div class="pos-section">
            <div class="pos-title">{{ $pos->nama_pos }}</div>
            <div class="pos-address">
                Alamat: {{ $pos->alamat ?? '-' }} | Kode Map: {{ $pos->kode_map ?? '-' }}
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="45%">JENIS SARANA PENYELAMATAN</th>
                        <th width="15%">JUMLAH</th>
                        <th width="35%">GAMBAR</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataFilter as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->jenis_sarana }}</td>
                            <td class="text-center"><b>{{ $item->jumlah }}</b></td>
                            <td class="text-center">
                                @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                    <div class="img-container">
                                        <!-- Menggunakan base64 agar gambar bisa di-render oleh dompdf -->
                                        @php
                                            $path = public_path($item->path_gambar);
                                            $type = pathinfo($path, PATHINFO_EXTENSION);
                                            $data = file_get_contents($path);
                                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        @endphp
                                        <img src="{{ $base64 }}" alt="Gambar">
                                    </div>
                                @else
                                    <span style="color: #999; font-style: italic;">Tidak ada gambar</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center" style="color: #777;">Belum ada data sarana penyelamatan untuk pos ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endforeach

</body>
</html>