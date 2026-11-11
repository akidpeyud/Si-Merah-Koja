<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Sarana Pemeriksaan Proteksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 10px 18px;
        }

        /* =======================================================
           KOP SURAT RESMI
           ======================================================= */
        table.kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 16px;
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
            width: 72px;
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
            font-size: 17px;
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
           JUDUL DOKUMEN & SEKSI POS
           ======================================================= */
        .doc-title {
            text-align: center;
            margin-bottom: 16px;
        }
        .doc-title h3 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .doc-title p {
            margin: 0;
            font-size: 10.5px;
            color: #334155;
        }

        .pos-block {
            margin-bottom: 18px;
        }
        .section-title {
            font-size: 11.5px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #163a63;
            color: #ffffff;
            padding: 7px 10px;
            margin-top: 14px;
            margin-bottom: 0;
            border: 1px solid #000;
            border-bottom: none;
            page-break-after: avoid;
        }
        .section-meta {
            font-size: 10px;
            color: #1e293b;
            padding: 5px 10px;
            border: 1px solid #000;
            border-bottom: none;
            background-color: #f8fafc;
            page-break-after: avoid;
        }

        /* =======================================================
           TABEL DATA
           ======================================================= */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            page-break-before: auto;
            page-break-inside: auto;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #e2e8f0;
            color: #000;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        table.data-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }

        .img-container {
            width: 120px;
            height: 78px;
            text-align: center;
            margin: 0 auto;
        }
        .img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            padding: 2px;
            background: #fff;
        }

        .ttd-container {
            width: 100%;
            margin-top: 35px;
            page-break-inside: avoid;
        }
        .ttd-box {
            float: right;
            width: 260px;
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

    <div class="doc-title">
        <h3>DATA SARANA PEMERIKSAAN PROTEKSI KEBAKARAN</h3>
        <p>Rekapitulasi Peralatan Pemeriksaan Proteksi Kebakaran per Pos Pemadam Kebakaran Kota Jambi</p>
    </div>

    @foreach($posPemadam as $pos)
        @php
            $dataFilter = $dataPemeriksaan->where('id_pos', $pos->id_pos);
        @endphp

        <div class="pos-block">
            <div class="section-title">{{ $pos->nama_pos }}</div>
            <div class="section-meta">
                <strong>Alamat:</strong> {{ $pos->alamat ?? '-' }} &nbsp;&bull;&nbsp;
                <strong>Kode Map:</strong> {{ $pos->kode_map ?? '-' }}
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th width="6%">NO</th>
                        <th width="50%">JENIS SARANA PEMERIKSAAN</th>
                        <th width="16%">JUMLAH</th>
                        <th width="28%">DOKUMENTASI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataFilter as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-bold" style="text-transform: uppercase;">{{ $item->jenis_sarana }}</td>
                            <td class="text-center fw-bold">{{ $item->jumlah }} Unit</td>
                            <td class="text-center">
                                @if($item->path_gambar && file_exists(public_path($item->path_gambar)))
                                    <div class="img-container">
                                        @php
                                            $path = public_path($item->path_gambar);
                                            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                            $mime = $ext === 'jpg' ? 'jpeg' : $ext;
                                            $base64 = 'data:image/' . $mime . ';base64,' . base64_encode(file_get_contents($path));
                                        @endphp
                                        <img src="{{ $base64 }}" alt="Gambar Sarana Pemeriksaan">
                                    </div>
                                @else
                                    <span style="color: #64748b; font-style: italic; font-size: 9.5px;">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center" style="padding: 12px; color: #64748b; font-style: italic;">
                                Belum ada data sarana pemeriksaan untuk pos ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endforeach

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
