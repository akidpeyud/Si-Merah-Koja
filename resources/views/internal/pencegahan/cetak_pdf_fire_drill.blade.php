<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Data Pelaksanaan Fire Drill | SIMERAH KOJA</title>
    <style>
        @page { size: A4 landscape; margin: 12mm; }
        * { box-sizing: border-box; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        body { font-family: Arial, sans-serif; font-size: 10px; color: #000; margin: 0; padding: 0; background: #fff; }

        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 14px; border-collapse: collapse; }
        .kop-surat td { border: none !important; padding: 0; vertical-align: middle; }
        .logo-kiri { text-align: left; width: 12%; }
        .logo-kanan { text-align: right; width: 12%; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 15px; font-weight: bold; }
        .teks-tengah .dinas { font-size: 21px; font-weight: bold; }
        .teks-tengah .alamat { font-size: 12px; }

        .judul-utama { text-align: center; font-weight: bold; font-size: 12px; line-height: 1.45; margin-bottom: 14px; text-transform: uppercase; }

        .table-data { width: 100%; border-collapse: collapse; table-layout: fixed; margin-bottom: 12px; font-size: 9.5px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 5px 6px; vertical-align: middle; word-wrap: break-word; overflow-wrap: anywhere; }
        .table-data th {
            background-color: #e9ecef !important;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
        .table-data thead { display: table-header-group; }
        .tr-total td {
            background-color: #f2f2f2 !important;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .cetak-info { margin-top: 6px; font-size: 9px; color: #444; }

        .no-print { margin-bottom: 14px; display: flex; justify-content: flex-end; gap: 8px; }
        .btn-cetak { padding: 8px 16px; background: #163a63; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 12px; }
        @media print {
            .no-print { display: none !important; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="btn-cetak" onclick="window.print()">Cetak / Simpan PDF</button>
    </div>

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="logo-kiri">
                <img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi" style="width: 72px; height: auto;">
            </td>
            <td class="teks-tengah">
                <span class="pemerintah">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span class="alamat">Jl. HOS Cokroaminoto No. 113 Telp. (0741) 41171 Kota Jambi</span>
            </td>
            <td class="logo-kanan">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar" style="width: 72px; height: auto;">
            </td>
        </tr>
    </table>

    <div class="judul-utama">
        DATA INSTANSI / LEMBAGA YANG MELAKSANAKAN PELATIHAN PEMADAM KEBAKARAN (FIRE DRILL)<br>
        @if(!empty($tahunDipilih))
            TAHUN {{ $tahunDipilih }}
        @else
            TAHUN {{ date('Y') }}
        @endif
        @if(!empty($instansiDipilih))
            <br><span style="font-size: 11px; font-weight: normal;">Filter Instansi: {{ strtoupper($instansiDipilih) }}</span>
        @endif
    </div>

    @php
        $koleksi = collect($data ?? []);
        $totalPeserta = 0;
    @endphp

    <table class="table-data">
        <colgroup>
            <col style="width:4%">   <!-- No -->
            <col style="width:19%">  <!-- Nama Instansi/Lembaga -->
            <col style="width:14%">  <!-- Tanggal Pelaksanaan -->
            <col style="width:18%">  <!-- Tempat Pelaksanaan -->
            <col style="width:10%">  <!-- Jumlah Peserta -->
            <col style="width:14%">  <!-- Nama Penanggung Jawab -->
            <col style="width:13%">  <!-- No Telfon/WA Penanggung Jawab -->
            <col style="width:8%">   <!-- Upload SPT -->
        </colgroup>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Instansi/Lembaga</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Tempat Pelaksanaan</th>
                <th>Jumlah Peserta</th>
                <th>Nama Penanggung Jawab</th>
                <th>No Telfon/WA Penanggung Jawab</th>
                <th>Upload SPT</th>
            </tr>
        </thead>
        <tbody>
            @forelse($koleksi as $idx => $item)
                @php
                    $jml = (int) ($item->total_peserta ?? 0);
                    $totalPeserta += $jml;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_instansi ?? '-' }}</td>
                    <td class="text-center">{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
                    <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>
                    <td class="text-center">{{ number_format($jml, 0, ',', '.') }} Orang</td>
                    <td>{{ $item->nama_penanggung_jawab ?? '-' }}</td>
                    <td class="text-center">{{ $item->no_telepon ?? '-' }}</td>
                    <td class="text-center">{{ !empty($item->surat_perintah_tugas) ? 'Ada' : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data Fire Drill.</td>
                </tr>
            @endforelse

            @if($koleksi->isNotEmpty())
                <tr class="tr-total">
                    <td colspan="4" class="text-center">JUMLAH TOTAL ({{ $koleksi->count() }} INSTANSI/LEMBAGA)</td>
                    <td class="text-center">{{ number_format($totalPeserta, 0, ',', '.') }} Orang</td>
                    <td colspan="3"></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="cetak-info">Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB melalui SIMERAH KOJA</div>

    <script>window.onload = function () { window.print(); };</script>
</body>
</html>
