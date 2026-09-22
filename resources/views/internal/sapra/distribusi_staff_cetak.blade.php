<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Distribusi Personil</title>
    <style>
        /* Menggunakan font standar dokumen resmi */
        body { font-family: 'Times New Roman', Times, serif; color: #000; font-size: 12px; line-height: 1.5; margin: 0; padding: 0; }
        
        /* Kop Surat */
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; position: relative; }
        .kop-surat::after { content: ''; position: absolute; bottom: -6px; left: 0; right: 0; border-bottom: 1px solid #000; }
        .kop-surat h2, .kop-surat h3, .kop-surat p { margin: 0; padding: 2px; }
        .kop-surat h2 { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .kop-surat h3 { font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .kop-surat p { font-size: 12px; }
        
        .judul-laporan { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 20px; text-decoration: underline; text-transform: uppercase; }
        
        /* Tabel */
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #000; padding: 8px 10px; vertical-align: middle; }
        th { background-color: #e5e7eb; text-align: center; font-weight: bold; font-size: 12px; padding: 12px 10px; }
        
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .bg-light { background-color: #f9fafb; }
        
        /* Tanda Tangan */
        .ttd-area { width: 100%; margin-top: 40px; display: table; }
        .ttd-box { display: table-cell; width: 40%; text-align: center; vertical-align: bottom; }
        .ttd-spacer { display: table-cell; width: 20%; }
        .ttd-space { height: 80px; }

        @media print {
            @page { margin: 1.5cm; size: A4; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- KOP SURAT -->
    <div class="kop-surat">
        <h2>PEMERINTAH KOTA JAMBI</h2>
        <h3>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</h3>
        <p>Jl. H. Zainir Haviz, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36128</p>
    </div>

    <div class="judul-laporan">REKAPITULASI DISTRIBUSI BARANG / INVENTARIS PERSONIL</div>

    <!-- TABEL DATA -->
    <table>
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="25%">NAMA PERSONIL</th>
                <th width="35%">BARANG / INVENTARIS DITERIMA</th>
                <th width="15%">WAKTU TERIMA</th>
                <th width="20%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($dataDistribusi as $nama => $items)
                
                <!-- BARIS HEADER NAMA STAFF -->
                <tr>
                    <td class="text-center fw-bold" rowspan="{{ count($items) + 1 }}">{{ $no++ }}</td>
                    <td colspan="4" class="bg-light fw-bold" style="text-transform: uppercase;">
                        {{ $nama }} <span style="font-weight: normal; font-size: 11px; margin-left: 5px;">(Total: {{ count($items) }} Barang)</span>
                    </td>
                </tr>
                
                <!-- BARIS RINCIAN BARANG -->
                @foreach($items as $item)
                    <tr>
                        <!-- Kolom Nama Personil sengaja dikosongkan agar sejajar -->
                        <td class="text-center" style="color: #9ca3af;">-</td>
                        
                        <!-- Kolom Barang -->
                        <td style="padding-left: 15px;">
                            <span class="fw-bold">{{ $item->nama_barang }}</span>
                            @if($item->detail_barang) 
                                <br><i style="font-size: 11px;">Kategori/Detail: {{ $item->detail_barang }}</i> 
                            @endif
                        </td>
                        
                        <!-- Kolom Waktu -->
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->waktu_terima)->format('d M Y') }}<br>
                            <span style="font-size: 11px;">{{ \Carbon\Carbon::parse($item->waktu_terima)->format('H:i') }} WIB</span>
                        </td>
                        
                        <!-- Kolom Keterangan -->
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach

            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Belum ada data distribusi barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- AREA TANDA TANGAN -->
    <div class="ttd-area">
        <div class="ttd-spacer"></div>
        <div class="ttd-spacer"></div>
        <div class="ttd-box">
            <p style="margin-bottom: 5px;">Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p><strong>Bagian Sarana dan Prasarana</strong></p>
            <div class="ttd-space"></div>
            <p style="margin-bottom: 2px;"><u>_________________________</u></p>
            <p>NIP. ........................................</p>
        </div>
    </div>

</body>
</html>