<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF - PELATIHAN KELUARGA TANGGAP KEBAKARAN</title>
    <style>
        /* Pengaturan Kertas dan Font (A4 Landscape) */
        @page { size: A4 landscape; margin: 20mm; }
        body { font-family: 'Times New Roman', Times, serif; color: #000; background: #fff; margin: 0; padding: 0; }
        
        /* Desain Kop Surat */
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 20px; }
        .kop-surat table { width: 100%; border-collapse: collapse; }
        .kop-surat td { text-align: center; vertical-align: middle; }
        .logo-kiri { width: 90px; height: auto; }
        .logo-kanan { width: 100px; height: auto; }
        
        .teks-kop h4 { margin: 0; font-size: 18px; font-weight: normal; }
        .teks-kop h2 { margin: 2px 0; font-size: 24px; font-weight: bold; }
        .teks-kop p { margin: 0; font-size: 14px; }
        
        /* Judul Dokumen */
        .judul-dokumen { text-align: center; font-weight: bold; font-size: 16px; margin-bottom: 20px; }
        
        /* Desain Tabel Data */
        .tabel-data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .tabel-data th, .tabel-data td { border: 1px solid #000; padding: 8px 10px; font-size: 12px; }
        .tabel-data th { background-color: #f2f2f2; text-align: center; font-weight: bold; text-transform: uppercase; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        
        /* Sembunyikan elemen saat di-print */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <div class="kop-surat">
        <table>
            <tr>
                <td width="15%">
                    <!-- Pastikan file logo_jambi.png ada di folder public/images -->
                    <td class="logo-kiri"><img src="{{ asset('images/jambi.png') }}" alt="Logo Jambi" style="width: 80px; height: auto;"></td>
                </td>
                <td width="70%" class="teks-kop">
                    <h4>PEMERINTAH KOTA JAMBI</h4>
                    <h2>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN</h2>
                    <p>Jl. HOS Cokroaminoto No, 113 Telp. 0741-41171</p>
                </td>
                <td width="15%">
                    <!-- Pastikan file logo_damkar.png ada di folder public/images -->
                     <td class="logo-kanan"><img src="{{ asset('images/logo.png') }}" alt="Logo Damkar" style="width: 80px; height: auto;"></td>
                </td>
            </tr>
        </table>
    </div>

    <!-- JUDUL DOKUMEN -->
    <div class="judul-dokumen">
        PELATIHAN KELUARGA TANGGAP KEBAKARAN
<br>
        TAHUN {{ date('Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="tabel-data">
        <thead>
            <tr>
                <th rowspan="2" width="5%">NO</th>
                <th rowspan="2" width="15%">TANGGAL</th>
                <th rowspan="2" width="15%">KECAMATAN</th>
                <th rowspan="2" width="15%">KELURAHAN</th>
                <th rowspan="2" width="5%">RT</th>
                <th rowspan="2" width="15%">POSYANDU</th>
                <th colspan="3" width="30%">JUMLAH PESERTA</th>
            </tr>
            <tr>
                <th>LAKI-LAKI</th>
                <th>PEREMPUAN</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data ?? [] as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <!-- Format Tanggal menjadi format Indonesia (Contoh: 12 Agustus 2026) -->
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->translatedFormat('d F Y') }}</td>
                <td class="text-center">{{ $item->kecamatan }}</td>
                <td class="text-center">{{ $item->kelurahan }}</td>
                <td class="text-center">{{ $item->rt }}</td>
                <td class="text-center">{{ $item->posyandu ?: '-' }}</td>
                <td class="text-center">{{ $item->peserta_laki_laki ?? 0 }}</td>
                <td class="text-center">{{ $item->peserta_perempuan ?? 0 }}</td>
                <!-- Menjumlahkan total peserta laki-laki dan perempuan otomatis -->
                <td class="text-center fw-bold">{{ ($item->peserta_laki_laki ?? 0) + ($item->peserta_perempuan ?? 0) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center" style="padding: 20px;">Belum ada data riwayat Sosialisasi & Edukasi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Script agar browser otomatis memunculkan dialog Print (Simpan sbg PDF) -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>