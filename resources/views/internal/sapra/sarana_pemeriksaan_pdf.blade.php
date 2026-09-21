<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Sarana Pemeriksaan - SIMERAH KOJA</title>
    <style>
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            font-size: 12px; 
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .kop-surat { 
            text-align: center; 
            margin-bottom: 25px; 
            border-bottom: 3px double #000; 
            padding-bottom: 15px; 
        }
        .kop-surat h2 { 
            margin: 0 0 5px 0; 
            font-size: 18px; 
            font-weight: bold; 
            text-transform: uppercase;
        }
        .kop-surat p { 
            margin: 0; 
            font-size: 14px; 
            color: #555;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            vertical-align: middle; 
        }
        th { 
            background-color: #0f172a; 
            color: #ffffff; 
            text-align: center; 
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        
        .pos-title-row td { 
            background-color: #e2e8f0; 
            font-weight: bold; 
            font-size: 13px;
            color: #0f172a;
            padding: 12px 10px;
        }

        /* Styling Gambar di PDF */
        .img-container {
            width: 80px;
            height: 60px;
            overflow: hidden;
            border-radius: 4px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-qty {
            background-color: #eff6ff;
            color: #0284c7;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #bae6fd;
            font-weight: bold;
            display: inline-block;
        }

        .footer-ttd {
            width: 100%;
            margin-top: 50px;
        }
        .footer-ttd table {
            width: 100%;
            border: none;
            margin: 0;
        }
        .footer-ttd td {
            border: none;
            padding: 0;
            text-align: center;
            vertical-align: bottom;
        }
        .footer-ttd .tanggal { margin-bottom: 70px; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h2>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</h2>
        <p>Laporan Data Sarana Pemeriksaan Proteksi Kebakaran</p>
    </div>

    @foreach($posPemadam as $pos)
        @php 
            $dataFilter = $dataPemeriksaan->where('id_pos', $pos->id_pos); 
        @endphp
        
        @if($dataFilter->count() > 0)
            <table>
                <thead>
                    <tr class="pos-title-row">
                        <td colspan="4">LOKASI: {{ strtoupper($pos->nama_pos) }}</td>
                    </tr>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="45%" class="text-left" style="padding-left: 15px;">JENIS SARANA PEMERIKSAAN</th>
                        <th width="20%">JUMLAH</th>
                        <th width="30%">GAMBAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataFilter as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-left" style="padding-left: 15px; font-weight: bold;">
                                {{ strtoupper($item->jenis_sarana) }}
                            </td>
                            <td class="text-center">
                                <span class="badge-qty">{{ $item->jumlah }} Unit</span>
                            </td>
                            <td class="text-center">
                                @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                    <!-- LOGIKA MENAMPILKAN GAMBAR DARI PUBLIC FOLDER KE PDF -->
                                    @php
                                        $imagePath = public_path($item->path_gambar);
                                        $imageData = base64_encode(file_get_contents($imagePath));
                                        $src = 'data:'.mime_content_type($imagePath).';base64,'.$imageData;
                                    @endphp
                                    <div class="img-container">
                                        <img src="{{ $src }}" alt="Gambar">
                                    </div>
                                @else
                                    <span style="color: #999; font-size: 10px;"><i>Tidak ada gambar</i></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach

    <div class="footer-ttd">
        <table>
            <tr>
                <td width="60%"></td>
                <td width="40%">
                    <div class="tanggal">Jambi, {{ \Carbon\Carbon::parse('now')->translatedFormat('d F Y') }}</div>
                    <p><strong>_______________________</strong></p>
                    <p style="margin-top: 5px;">Admin / Petugas Sapra</p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>