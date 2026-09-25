<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Keterangan Korban Kebakaran</title>
    <style>
        /* PENGATURAN KERTAS & MENGHILANGKAN TEXT BROWSER */
        @page { 
            size: A4 portrait; 
            margin: 0; 
        }
        
        body { 
            margin: 0; padding: 0; background: #525659; 
            display: flex; justify-content: center; 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 12pt; 
            color: #000; 
        }
        
        .kertas-surat {
            width: 210mm;
            min-height: 297mm;
            background: white;
            padding: 10mm 20mm 10mm 25mm; 
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            margin: 20px 0;
            position: relative;
        }

        /* 1. KOP SURAT */
        .tabel-kop { width: 100%; border-collapse: collapse; }
        .tabel-kop td { vertical-align: middle; }
        .tabel-kop img { width: 80px; height: auto; }
        .kop-text { text-align: center; }
        .kop-text h2 { margin: 0; font-size: 14pt; font-weight: normal; }
        .kop-text h1 { margin: 0; font-size: 16pt; font-weight: bold; line-height: 1.1; }
        .kop-text p { margin: 2px 0 0 0; font-size: 10pt; }

        .garis-kop {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        /* 2. JUDUL SURAT */
        .judul-surat { text-align: center; margin-bottom: 10px; line-height: 1.1; }
        .judul-surat h3 { margin: 0; font-size: 12pt; font-weight: bold; text-decoration: underline; }
        .judul-surat p { margin: 0; font-size: 12pt; }

        /* 3. DASAR HUKUM */
        .dasar-hukum { margin-bottom: 8px; text-align: justify; line-height: 1.1; }
        .dasar-hukum p { margin: 0 0 2px 0; }
        .tabel-list { width: 100%; border-collapse: collapse; }
        .tabel-list td { vertical-align: top; padding-bottom: 2px; }
        .td-nomor { width: 30px; text-align: right; padding-right: 8px; }
        .td-isi { text-align: justify; }

        /* 4. TABEL BIODATA */
        .teks-pembuka { text-align: justify; margin-bottom: 4px; line-height: 1.1; }
        .tabel-biodata { width: 100%; margin-left: 0; margin-bottom: 8px; border-collapse: collapse; line-height: 1.1; }
        .tabel-biodata td { vertical-align: top; padding: 1px 0; }
        .td-label { width: 160px; }
        .td-titik { width: 15px; text-align: left; }

        /* 5. ISI SURAT */
        .teks-isi { text-align: justify; line-height: 1.1; margin-bottom: 6px; }

        /* 6. TANDA TANGAN (LEBAR KOTAK DIPERKECIL JADI 240px AGAR LEBIH MENTOK KANAN) */
        .ttd-container { width: 100%; margin-top: 10px; display: flex; justify-content: flex-end; }
        .ttd-box { width: 240px; text-align: left; line-height: 1.1; } 
        .ttd-info { display: flex; margin-bottom: 2px; }
        .ttd-info-label { width: 100px; } 
        .ttd-info-titik { width: 10px; }
        .ttd-instansi { margin-top: 5px; margin-bottom: 45px; } 
        .ttd-nama { font-weight: bold; text-decoration: underline; margin-bottom: 2px; }

        /* 7. TEMBUSAN */
        .tembusan { margin-top: 10px; font-size: 10pt; line-height: 1.1; }
        .tembusan p { margin: 0 0 2px 0; }
        .tembusan ol { margin: 0; padding-left: 15px; }

        /* PENGATURAN SAAT DI-PRINT */
        @media print {
            body { background: white; margin: 0; }
            .kertas-surat { 
                box-shadow: none; 
                margin: 0; 
                padding: 10mm 20mm 5mm 25mm !important; 
                width: 100%; 
                height: 297mm; 
                overflow: hidden; 
                page-break-after: avoid; 
                page-break-inside: avoid;
            }
            .btn-print { display: none; }
        }

        .btn-print { position: fixed; bottom: 30px; right: 30px; background: #10b981; color: white; border: none; padding: 15px 25px; font-size: 16px; border-radius: 50px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.3); font-weight: bold; z-index: 999; }
        .btn-print:hover { background: #059669; }
    </style>
</head>
<body>

    <button class="btn-print" onclick="window.print()">Cetak PDF Sekarang</button>

    <div class="kertas-surat">
        
        <!-- 1. KOP SURAT -->
        <table class="tabel-kop">
            <tr>
                <td style="width: 15%; text-align: left;">
                    <img src="{{ asset('images/jambi.png') }}" alt="Logo Pemkot">
                </td>
                <td style="width: 70%;" class="kop-text">
                    <h2>PEMERINTAH KOTA JAMBI</h2>
                    <h1>DINAS PEMADAM KEBAKARAN<br>DAN PENYELAMATAN</h1>
                    <p>Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171<br>JAMBI</p>
                </td>
                <td style="width: 15%; text-align: right;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Damkar" style="width: 100px; height: auto;">
                </td>
            </tr>
        </table>
        
        <div class="garis-kop"></div>

        <!-- 2. JUDUL SURAT -->
        <div class="judul-surat">
            <h3>SURAT KETERANGAN KORBAN KEBAKARAN</h3>
            <p>Nomor: ${nomor_naskah}</p>
        </div>

        <!-- 3. DASAR HUKUM -->
        <div class="dasar-hukum">
            <p>Berdasarkan :</p>
            <table class="tabel-list">
                <tr>
                    <td class="td-nomor">1.</td>
                    <td class="td-isi">Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 114 Tahun 2018 (Pasal 5 ayat 2 huruf b) tentang Standar Teknis Pelayanan Dasar Pada Standar Pelayanan Minimal Sub. Urusan Kebakaran Daerah Kabupaten/Kota.</td>
                </tr>
                <tr>
                    <td class="td-nomor">2.</td>
                    <td class="td-isi">Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 16 Tahun 2020 Tentang Pedoman Nomenklatur Dinas Pemadam Kebakaran dan Penyelamatan Provinsi dan Kabupaten/Kota.</td>
                </tr>
                <tr>
                    <td class="td-nomor">3.</td>
                    <td class="td-isi">Peraturan Daerah Nomor 8 Tahun 2003 tentang Pencegahan dan Penanggulangan Bahaya Kebakaran.</td>
                </tr>
                <tr>
                    <td class="td-nomor">4.</td>
                    <td class="td-isi">Peraturan Walikota Jambi Nomor 50 Tahun 2025 tentang Susunan Organisasi, dan Tata Kerja pada Perangkat Daerah Kota Jambi.</td>
                </tr>
            </table>
        </div>

        <p class="teks-pembuka">Kepala Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi Provinsi Jambi dengan ini menerangkan:</p>

        <!-- 4. TABEL BIODATA -->
        <table class="tabel-biodata">
            <tr>
                <td class="td-label">Nama</td>
                <td class="td-titik">:</td>
                <td style="font-weight: bold; text-transform: uppercase;">{{ $surat->nama_korban ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Status Kepemilikan</td>
                <td class="td-titik">:</td>
                <td>{{ ucwords(strtolower($surat->status_kepemilikan ?? '')) }}</td>
            </tr>
            <tr>
                <td class="td-label">NIK</td>
                <td class="td-titik">:</td>
                <td>{{ $surat->nik ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Tempat/Tgl. Lahir</td>
                <td class="td-titik">:</td>
                <td>{{ ucwords(strtolower($surat->tempat_lahir ?? '')) }}, {{ isset($surat->tanggal_lahir) ? \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') : '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Alamat</td>
                <td class="td-titik">:</td>
                <td>{{ $surat->alamat ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Status</td>
                <td class="td-titik">:</td>
                <td>{{ ucwords(strtolower($surat->status_perkawinan ?? '')) }}</td>
            </tr>
            <tr>
                <td class="td-label">Pekerjaan</td>
                <td class="td-titik">:</td>
                <td>{{ ucwords(strtolower($surat->pekerjaan ?? '')) }}</td>
            </tr>
        </table>

        <!-- 5. PARAGRAF ISI SURAT -->
        <p class="teks-isi">
            Adalah <strong>Benar Korban Kebakaran</strong> {{ ucwords(strtolower($surat->objek_terbakar ?? '')) }} yang Terjadi pada Hari {{ ucwords(strtolower($surat->hari_kejadian ?? '')) }} Tanggal {{ isset($surat->tanggal_kejadian) ? \Carbon\Carbon::parse($surat->tanggal_kejadian)->translatedFormat('d F Y') : '' }}, Pukul {{ isset($surat->waktu_kejadian) ? \Carbon\Carbon::parse($surat->waktu_kejadian)->format('H.i') : '' }} WIB beralamat sebagaimana tersebut diatas dan telah dilakukan pemadaman oleh Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.
        </p>
        
        <p class="teks-isi">Demikian surat keterangan korban kebakaran ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

        <!-- 6. TANDA TANGAN -->
        <div class="ttd-container">
            <div class="ttd-box">
                <div class="ttd-info">
                    <div class="ttd-info-label">Dikeluarkan di</div>
                    <div class="ttd-info-titik">:</div>
                    <div>Jambi</div>
                </div>
                <div class="ttd-info">
                    <div class="ttd-info-label">Tanggal</div>
                    <div class="ttd-info-titik">:</div>
                    <div>${tanggal_naskah}</div>
                </div>
                
                <div class="ttd-instansi">
                    Dinas Pemadam Kebakaran dan<br>
                    Penyelamatan Kota Jambi<br>
                    <br><br>
                    ${ttd_pengirim}
                </div>

                <div class="ttd-nama">${nama_pengirim}</div>
                <div>Pembina Utama Muda</div>
                <div>NIP. ${nip_pengirim}</div>
            </div>
        </div>

        <!-- 7. TEMBUSAN -->
        <div class="tembusan">
            <p>Tembusan disampaikan Kepada Yth:</p>
            <ol>
                <li>Bapak Walikota Jambi, di Jambi (sebagai laporan)</li>
                <li>Kepala Pelaksana Badan Penanggulangan Bencana Daerah Kota Jambi</li>
                <li>Kepala Badan Pengelola Keuangan dan Aset Daerah Kota Jambi</li>
                <li>Kepala Dinas Kependudukan dan Pencatatan Sipil Kota Jambi</li>
                <li>Kepala Dinas Sosial Kota Jambi</li>
                <li>Camat {{ ucwords(strtolower($surat->tembusan_camat ?? '.......................')) }} Kota Jambi</li>
                <li>Lurah {{ ucwords(strtolower($surat->tembusan_lurah ?? '.......................')) }} Kota Jambi</li>
                <li>Arsip</li>
            </ol>
        </div>

    </div>

</body>
</html>