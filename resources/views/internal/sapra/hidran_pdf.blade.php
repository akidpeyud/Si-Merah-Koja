<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Prasarana - SIMERAH KOJA</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
        .header-title { text-align: center; margin-bottom: 25px; color: #0f172a; }
        .header-title h2 { margin: 0; padding: 0; font-size: 16px; font-weight: bold; }
        .header-title p { margin: 5px 0 0 0; font-size: 12px; }
        .category-title { margin-top: 20px; margin-bottom: 10px; font-size: 13px; font-weight: bold; color: #1e293b; border-left: 4px solid #2563eb; padding-left: 8px; text-transform: uppercase; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table, th, td { border: 1px solid #94a3b8; }
        th { background-color: #1e293b; color: #ffffff; padding: 10px 8px; text-align: center; font-size: 11px; letter-spacing: 0.5px; }
        td { padding: 8px; vertical-align: top; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        .total-row { font-weight: bold; background-color: #f1f5f9; }
    </style>
</head>
<body>

    <div class="header-title">
        <h2>LAPORAN DATA REKAP HIDRANT GEDUNG </h2>
        <p>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</p>
    </div>

    <!-- Kita buat list kategorinya untuk memisahkan tabel secara otomatis -->
    @php
        $kategoriList = ['Hidrant Pilar', 'Hidrant Gedung', 'Embung', 'Danau'];
    @endphp

    @foreach($kategoriList as $kat)
        @php
            // Filter data khusus untuk kategori yang sedang diloop
            $items = $dataHidran->where('kategori', $kat);
        @endphp

        <!-- Hanya tampilkan tabel jika datanya ada -->
        @if($items->count() > 0)
            <div class="category-title">
                Data {{ $kat }}
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="25%">NAMA LOKASI / GEDUNG</th>
                        <th width="40%">ALAMAT</th>
                        <th width="15%">KODE MAPS</th>
                        <th width="15%">{{ ($kat == 'Hidrant Pilar' || $kat == 'Hidrant Gedung') ? 'JUMLAH' : 'LUAS AREA' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="text-center">{{ $item->no_urut }}</td>
                        <td class="fw-bold">{{ $item->nama_gedung }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">{{ $item->kode_maps ?? '-' }}</td>
                        <td class="text-center fw-bold">
                            @if($kat == 'Hidrant Pilar' || $kat == 'Hidrant Gedung')
                                {{ $item->jumlah ?? '0' }} Unit
                            @else
                                {{ $item->luas ?? '-' }}
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    <!-- Munculkan baris total otomatis khusus untuk Hidrant -->
                    @if($kat == 'Hidrant Pilar' || $kat == 'Hidrant Gedung')
                    <tr class="total-row">
                        <td colspan="4" class="text-right" style="padding-right: 15px;">TOTAL KESELURUHAN :</td>
                        <td class="text-center">{{ $items->sum('jumlah') }} Unit</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        @endif
    @endforeach

</body>
</html>