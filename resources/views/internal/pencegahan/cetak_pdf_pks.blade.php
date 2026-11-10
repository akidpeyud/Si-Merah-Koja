<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Data Perjanjian Kerjasama (PKS) | SIMERAH KOJA</title>
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
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px 8px; vertical-align: middle; word-wrap: break-word; overflow-wrap: anywhere; }
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
                <span class="alamat">Jl. Hos Cokroaminoto No. 01 Kel. Simpang III Sipin Kec. Kota Baru Kota Jambi</span>
            </td>
            <td class="logo-kanan">
                <img src="{{ asset('images/logo damkar.png') }}" alt="Logo Damkar" style="width: 72px; height: auto;">
            </td>
        </tr>
    </table>

    <!-- JUDUL -->
    <div class="judul-utama">
        PERJANJIAN KERJASAMA PERUSAHAAN DENGAN DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI
        @if(!empty($tahunDipilih))
            <br><span style="font-size: 11px; font-weight: normal;">TAHUN {{ $tahunDipilih }}</span>
        @endif
        @if(!empty($perusahaanDipilih))
            <br><span style="font-size: 11px; font-weight: normal;">PERUSAHAAN: {{ strtoupper($perusahaanDipilih) }}</span>
        @endif
    </div>

    <!-- TABEL DATA 8 KOLOM SESUAI FOTO -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 4%;">No.</th>
                <th style="width: 22%;">Nama Perusahaan</th>
                <th style="width: 18%;">Nomor PKS</th>
                <th style="width: 12%;">Tanggal Perjanjian</th>
                <th style="width: 10%;">Lama Kerjasama</th>
                <th style="width: 17%;">Pihak Pertama</th>
                <th style="width: 17%;">Pihak Kedua</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $row->nama_perusahaan ?? '-' }}</strong></td>
                    <td class="text-center">{{ $row->nomor_pks ?? '-' }}</td>
                    <td class="text-center">
                        {{ !empty($row->tanggal_perjanjian) ? \Carbon\Carbon::parse($row->tanggal_perjanjian)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td class="text-center">{{ $row->lama_kerjasama ?? '-' }}</td>
                    <td>{{ $row->pihak_pertama ?? '-' }}</td>
                    <td>{{ $row->pihak_kedua ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data Perjanjian Kerjasama (PKS).</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="tr-total">
                <td colspan="4" class="text-center">TOTAL PERJANJIAN KERJASAMA</td>
                <td colspan="3" class="text-center">{{ $data->count() }} Perusahaan</td>
            </tr>
        </tfoot>
    </table>

    <div class="cetak-info">
        Dicetak dari Sistem Informasi Manajemen SIMERAH KOJA pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
    </div>
</body>
</html>
