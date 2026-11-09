<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Perbaikan Kendaraan Operasional</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 15px;
        }

        /* =======================================================
           KOP SURAT STYLES
           ======================================================= */
        table.kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 14px;
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
            margin: 0 0 4px 0;
            font-size: 13px;
            text-transform: uppercase;
        }
        .doc-title p {
            margin: 0;
            font-size: 11px;
            font-weight: bold;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
            vertical-align: middle;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }

        .pdf-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .pdf-list li {
            margin-bottom: 3px;
            line-height: 1.35;
        }
        .pdf-list li:last-child {
            margin-bottom: 0;
        }

        .dup-note {
            margin-top: 5px;
            padding: 3px 5px;
            background-color: #fef2f2;
            border: 1px solid #dc2626;
            color: #991b1b;
            font-size: 9.5px;
            font-weight: bold;
        }

        .ttd-container {
            width: 100%;
            margin-top: 35px;
        }
        .ttd-box {
            float: right;
            width: 280px;
            text-align: center;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

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
                    $damkarPath = public_path('images/logo.png');
                    $damkarLogo = file_exists($damkarPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($damkarPath)) : '';
                @endphp
                @if($damkarLogo)
                    <img src="{{ $damkarLogo }}" alt="Logo Yudha Brama Jaya">
                @else
                    <span style="font-size:10px;">(Logo Damkar)</span>
                @endif
            </td>
        </tr>
    </table>

    <div class="doc-title">
        <h3>DATA PERBAIKAN KENDARAAN OPERASIONAL DINAS DAMKARTAN KOTA JAMBI {{ $labelTahun }}</h3>
        @if(!empty($labelJenis))
            <p>KATEGORI JENIS KENDARAAN: {{ $labelJenis }}</p>
        @endif
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="4%">NO</th>
                <th width="11%">NOPOL KENDARAAN</th>
                <th width="7%">JENIS</th>
                <th width="12%">MERK KENDARAAN</th>
                <th width="10%">TGL PERBAIKAN</th>
                <th width="22%">JENIS KERUSAKAN / PENGGANTIAN BARANG</th>
                <th width="12%">MEREK / TIPE BARANG</th>
                <th width="6%">SATUAN</th>
                <th width="10%">TOTAL HARGA</th>
                <th width="6%">FOTO</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataPerbaikan as $index => $item)
                @php $rincianList = $item->rincian_items ?? []; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center fw-bold">{{ $item->nopol_kendaraan }}</td>
                    <td class="text-center fw-bold">{{ strtoupper($item->jenis_kendaraan) }}</td>
                    <td>{{ $item->merk_kendaraan }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tgl_perbaikan)->format('d-m-Y') }}</td>
                    <td>
                        @if(!empty($rincianList))
                            <ul class="pdf-list">
                                @foreach($rincianList as $rincian)
                                    <li class="fw-bold">- {{ strtoupper($rincian['barang']) }}</li>
                                @endforeach
                            </ul>
                        @else
                            <div class="fw-bold">{{ strtoupper($item->jenis_kerusakan) }}</div>
                        @endif
                        @if(!empty($item->barang_berulang))
                            @foreach($item->barang_berulang as $dup)
                                <div class="dup-note">
                                    Ganti "{{ $dup['barang'] }}" {{ $dup['count'] }}x di Tahun {{ $dup['tahun'] }} ({{ implode(', ', $dup['tanggal_list']) }})
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(!empty($rincianList))
                            <ul class="pdf-list">
                                @foreach($rincianList as $rincian)
                                    <li>- {{ $rincian['merek'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $item->merek_tipe_barang ?: '-' }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(!empty($rincianList))
                            <ul class="pdf-list">
                                @foreach($rincianList as $rincian)
                                    <li>{{ $rincian['satuan'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $item->satuan ?: '-' }}
                        @endif
                    </td>
                    <td class="text-right fw-bold">Rp {{ number_format((int) $item->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @php
                            $fotoBase64 = '';
                            if (!empty($item->foto) && file_exists(public_path($item->foto))) {
                                $ext = strtolower(pathinfo($item->foto, PATHINFO_EXTENSION));
                                $mime = $ext === 'jpg' ? 'jpeg' : $ext;
                                $fotoBase64 = 'data:image/' . $mime . ';base64,' . base64_encode(file_get_contents(public_path($item->foto)));
                            }
                        @endphp
                        @if($fotoBase64)
                            <img src="{{ $fotoBase64 }}" alt="Foto" style="max-width: 55px; max-height: 45px; object-fit: cover;">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada data perbaikan kendaraan operasional.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" class="text-right fw-bold" style="background-color: #f1f5f9;">TOTAL BIAYA PERBAIKAN:</td>
                <td class="text-right fw-bold" style="background-color: #f1f5f9;">
                    Rp {{ number_format($dataPerbaikan->sum('total_harga'), 0, ',', '.') }}
                </td>
                <td style="background-color: #f1f5f9;"></td>
            </tr>
        </tfoot>
    </table>

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
