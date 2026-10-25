<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Sarana Mako & Pos</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 11px; 
            color: #333;
        }
        h2, h4 { 
            text-align: center; 
            margin: 5px 0; 
        }
        
        /* KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-logo { width: 15%; text-align: center; vertical-align: middle; }
        .kop-logo img { width: 70px; height: auto; }
        .kop-teks { width: 70%; text-align: center; }
        .kop-teks .pemerintah { font-size: 14px; font-weight: bold; letter-spacing: 1px; }
        .kop-teks .dinas { font-size: 18px; font-weight: bold; margin: 5px 0; }
        .kop-teks .alamat { font-size: 10px; font-style: italic; }

        /* KONTEN */
        .doc-title { text-align: center; margin-bottom: 20px; }
        .doc-title h3 { margin: 0; text-decoration: underline; font-size: 14px; }
        
        .pos-header { 
            background-color: #f1f5f9; 
            border: 1px solid #cbd5e1; 
            padding: 8px 12px; 
            margin-top: 20px; 
            font-weight: bold; 
            font-size: 12px;
            text-transform: uppercase;
        }
        .pos-meta {
            font-size: 10px;
            color: #475569;
            padding: 4px 12px;
            border: 1px solid #cbd5e1;
            border-top: none;
            margin-bottom: 5px;
        }

        /* TABEL */
        table.data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px; 
        }
        .data-table th, .data-table td { 
            border: 1px solid #64748b; 
            padding: 6px; 
            vertical-align: middle; 
        }
        .data-table th { 
            background-color: #1e293b; 
            color: #ffffff; 
            text-align: center; 
            font-size: 10px;
            text-transform: uppercase;
        }
        .text-center { text-align: center; }
        .img-sarana { width: 90px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc; }

        /* TANDA TANGAN */
        .ttd-container { width: 100%; margin-top: 40px; }
        .ttd-box { width: 35%; float: right; text-align: center; font-size: 12px; }
        .clear { clear: both; }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                @php
                    $jambiPath = public_path('images/jambi.png');
                    $jambiLogo = file_exists($jambiPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($jambiPath)) : '';
                @endphp
                @if($jambiLogo)
                    <img src="{{ $jambiLogo }}" alt="Logo Kota Jambi">
                @else
                    <span style="font-size:10px;">(Logo Jambi)</span>
                @endif
            </td>
            <td class="kop-teks">
                <div class="pemerintah">PEMERINTAH KOTA JAMBI</div>
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
            </td>
            <td class="kop-logo">
                @php
                    $logoPath = public_path('images/logo.png');
                    $logoFile = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
                @endphp
                @if($logoFile)
                    <img src="{{ $logoFile }}" alt="Logo Damkar">
                @else
                    <span style="font-size:10px;">(Logo Damkar)</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- JUDUL LAPORAN -->
    <div class="doc-title">
        <h3>DATA SARANA DAN ARMADA PEMADAM KEBAKARAN</h3>
    </div>

    <!-- LOOPING UNTUK SETIAP POS -->
    @foreach($posPemadam as $pos)
        
        <!-- Header Pos -->
        <div class="pos-header">{{ $pos->nama_pos }}</div>
        <div class="pos-meta">
            <strong>Alamat:</strong> {{ $pos->alamat ?? '-' }} &nbsp;|&nbsp; <strong>Kode Map:</strong> {{ $pos->kode_map ?? '-' }}
        </div>
        
        <!-- Tabel Data -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Gambar / Foto</th>
                    <th width="25%">Jenis Sarana / Armada</th>
                    <th width="15%">Plat Nomor</th>
                    <th width="15%">No. STNK</th>
                    <th width="10%">Tahun</th>
                    <th width="10%">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Filter data sarana khusus untuk pos ini saja
                    $saranaPos = $dataSarana->where('id_pos', $pos->id_pos);
                @endphp

                @forelse($saranaPos as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                <!-- Render Gambar Lokal -->
                                <img src="{{ public_path($item->path_gambar) }}" class="img-sarana">
                            @else
                                <span style="font-size: 9px; color: #999;">Tidak ada foto</span>
                            @endif
                        </td>
                        <td style="font-weight: bold;">{{ strtoupper($item->jenis_sarana) }}</td>
                        <td class="text-center">{{ $item->plat_nomor ?? '-' }}</td>
                        <td class="text-center">{{ $item->no_stnk ?? '-' }}</td>
                        <td class="text-center">{{ $item->tahun ?? '-' }}</td>
                        <td class="text-center"><strong>{{ $item->jumlah }}</strong> Unit</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center" style="padding: 15px; font-style: italic; color: #666;">
                            Belum ada data sarana untuk pos ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

    <!-- FORMAT TANDA TANGAN -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">(Nama Kepala Bidang / Pejabat)</p>
            <p>NIP. .....................................</p>
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>