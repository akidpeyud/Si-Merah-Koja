<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Sarana Pemeriksaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 10px 20px;
        }

        /* =======================================================
           KOP SURAT STYLES
           ======================================================= */
        table.kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
        }
        table.kop-surat td {
            border: none;
            padding: 5px;
            vertical-align: middle;
        }
        .kop-logo {
            width: 15%;
            text-align: center;
        }
        .kop-logo img {
            width: 75px;
            height: auto;
        }
        .kop-teks {
            width: 70%;
            text-align: center;
            line-height: 1.3;
        }
        .kop-teks .pemerintah {
            font-size: 14px;
            font-weight: normal;
            color: #000;
        }
        .kop-teks .dinas {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin: 3px 0;
        }
        .kop-teks .alamat {
            font-size: 11px;
            font-weight: normal;
            color: #000;
        }

        /* =======================================================
           JUDUL DOKUMEN & TABEL DATA
           ======================================================= */
        .doc-title {
            text-align: center;
            margin-bottom: 15px;
        }
        .doc-title h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            background-color: #0d1b2a;
            color: #ffffff;
            padding: 6px 10px;
            margin-top: 20px;
            margin-bottom: 0;
            border: 1px solid #000;
            border-bottom: none;
            page-break-after: avoid; /* Pastikan judul nempel dengan tabel di bawahnya */
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-before: auto;
            page-break-inside: auto; /* Biarkan tabel memecah halaman secara alami */
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 7px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }
        /* Mencegah baris terpotong separuh teksnya saat pindah halaman */
        table.data-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        
        .img-container { width: 120px; height: 80px; text-align: center; margin: 0 auto; }
        .img-container img { max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 4px; border: 1px solid #ccc; padding: 2px;}

        .ttd-container {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .ttd-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .clear { clear: both; }

        @media print {
            body { padding: 0; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT MENGGUNAKAN TEKNIK BASE64 AGAR TERBACA DI DOMPDF -->
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
                <div class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN KOTA JAMBI</div>
                <div class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. 0741-41171</div>
            </td>
            <td class="kop-logo">
                @php
                    $logoPath = public_path('images/logo.png');
                    $logoFile = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
                @endphp
                @if($logoFile)
                    <img src="{{ $logoFile }}" alt="Logo Instansi">
                @else
                    <span style="font-size:10px;">(Logo Instansi)</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- JUDUL LAPORAN -->
    <div class="doc-title">
        <h3>DATA SARANA PEMERIKSAAN PROTEKSI KEBAKARAN</h3>
    </div>

    <!-- LOOPING UNTUK SETIAP POS -->
    @foreach($posPemadam as $pos)
        @php 
            $dataFilter = $dataPemeriksaan->where('id_pos', $pos->id_pos); 
        @endphp

        <!-- Pembungkus tanpa 'page-break-inside: avoid' agar tabel mengalir secara natural -->
        <div>
            <div class="section-title">{{ $pos->nama_pos }}</div>
            <div style="font-size: 10px; padding: 4px 8px; border: 1px solid #000; border-top: none; border-bottom: none; background-color: #f8fafc; page-break-after: avoid;">
                <strong>Alamat:</strong> {{ $pos->alamat ?? '-' }} &nbsp;|&nbsp; <strong>Kode Map:</strong> {{ $pos->kode_map ?? '-' }}
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="45%">JENIS SARANA PEMERIKSAAN</th>
                        <th width="15%">JUMLAH</th>
                        <th width="35%">GAMBAR</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataFilter as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold" style="font-size: 12px; text-transform: uppercase;">{{ $item->jenis_sarana }}</div>
                            </td>
                            <td class="text-center" style="font-size: 12px;"><b>{{ $item->jumlah }}</b> Unit</td>
                            <td class="text-center">
                                @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                    <div class="img-container">
                                        @php
                                            $path = public_path($item->path_gambar);
                                            $type = pathinfo($path, PATHINFO_EXTENSION);
                                            $data = file_get_contents($path);
                                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        @endphp
                                        <img src="{{ $base64 }}" alt="Gambar">
                                    </div>
                                @else
                                    <span style="color: #999; font-style: italic; font-size: 10px;">Tidak ada gambar</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center" style="color: #777;">Belum ada data sarana pemeriksaan untuk pos ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endforeach

    <!-- FORMAT TANDA TANGAN -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">(Nama Kepala Bidang)</p>
            <p>NIP. .....................................</p>
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>