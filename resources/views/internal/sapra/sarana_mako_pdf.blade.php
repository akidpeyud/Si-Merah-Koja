<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Sarana Mako & Pos</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h2, h4 { text-align: center; margin: 5px 0; }
        .pos-title { font-size: 14px; font-weight: bold; margin-top: 20px; background-color: #e2e8f0; padding: 8px; text-transform: uppercase; border-left: 4px solid #0284c7; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #94a3b8; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #1e293b; color: white; text-align: center; font-size: 11px; letter-spacing: 0.5px; }
        .text-center { text-align: center; }
        /* Gambar dibikin 150px biar seimbang sama tabel Prasarana */
        .img-sarana { width: 150px; height: auto; border-radius: 4px; border: 1px solid #ccc; padding: 2px; }
        
        /* Tambahan untuk styling Tahun, Plat, & STNK */
        .sarana-name { font-weight: bold; font-size: 13px; text-transform: uppercase; margin-bottom: 3px; }
        .sarana-meta { font-size: 11px; color: #475569; margin-top: 4px; }
    </style>
</head>
<body>
    <h2>LAPORAN DATA SARANA MARKAS KOMANDO & POS</h2>
    <h4>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</h4>
    <hr style="margin-bottom: 20px; border: 1px solid #0f172a;">

    @foreach($posPemadam as $pos)
        <div class="pos-title">{{ $pos->nama_pos }}</div>
        <p style="margin: 6px 0; font-size: 11px;">
            <strong>Alamat:</strong> {{ $pos->alamat ?? '-' }} &nbsp;|&nbsp; 
            <strong>Kode Map:</strong> {{ $pos->kode_map ?? '-' }}
        </p>

        <table>
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="40%">JENIS SARANA KEBAKARAN</th>
                    <th width="15%">JUMLAH</th>
                    <th width="40%">GAMBAR</th>
                </tr>
            </thead>
            <tbody>
                @php $dataFilter = $dataSarana->where('id_pos', $pos->id_pos); @endphp
                
                @forelse($dataFilter as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <!-- Nama Barang -->
                            <div class="sarana-name">{{ $item->jenis_sarana }}</div>
                            
                            <!-- Munculin Tahun, Plat Nomor, & STNK secara dinamis -->
                            @if($item->tahun || $item->plat_nomor || $item->no_stnk)
                                <div class="sarana-meta">
                                    @php
                                        $metaDetails = [];
                                        
                                        if(!empty($item->tahun)) {
                                            $metaDetails[] = "Tahun: " . $item->tahun;
                                        }
                                        if(!empty($item->plat_nomor)) {
                                            $metaDetails[] = "Plat: <span style='text-transform: uppercase;'>" . $item->plat_nomor . "</span>";
                                        }
                                        if(!empty($item->no_stnk)) {
                                            $metaDetails[] = "STNK: <span style='text-transform: uppercase;'>" . $item->no_stnk . "</span>";
                                        }
                                    @endphp
                                    
                                    <!-- Menampilkan array dengan pemisah garis '|' -->
                                    {!! implode(' &nbsp;|&nbsp; ', $metaDetails) !!}
                                </div>
                            @endif
                        </td>
                        <td class="text-center" style="font-size: 14px;"><strong>{{ $item->jumlah }}</strong> Unit</td>
                        <td class="text-center">
                            @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                <img src="{{ public_path($item->path_gambar) }}" class="img-sarana">
                            @else
                                <i style="color: #94a3b8; font-size: 11px;">Tidak ada gambar</i>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 15px; color: #64748b;">
                            Belum ada data sarana untuk pos ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</body>
</html>