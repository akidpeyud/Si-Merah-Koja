<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata_REDKAR_{{ $relawan->nama_lengkap }}</title>
    <style>
<<<<<<< HEAD
        @media print {
    /* Mengatur ukuran kertas murni A4 dan memperkecil margin browser */
    @page {
        size: A4 portrait;
        margin: 1cm; /* Margin 1cm keliling */
    }

    /* Mereset margin dan memperkecil ukuran font agar muat 1 lembar */
    body {
        margin: 0 !important;
        padding: 0 !important;
        font-size: 12px !important; /* Perkecil sedikit font khusus saat diprint */
        background-color: white !important;
    }

    /* Menghilangkan shadow, border luar, atau jarak yang tidak perlu */
    .container, .card, .cetak-container {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Menyembunyikan tombol print agar tidak ikut tercetak */
    .btn-print, .no-print {
        display: none !important;
    }

    /* Memastikan tabel dan elemen penting tidak terpotong ke halaman 2 */
    table, tr, td, th {
        page-break-inside: avoid !important;
        padding: 5px !important; /* Perkecil jarak dalam tabel */
    }
    
    h1, h2, h3 {
        margin-top: 0 !important;
    }
}
        /* Desain Khusus Kertas Dokumen A4 */
        body { font-family: 'Times New Roman', Times, serif; color: #000; background-color: #525659; margin: 0; padding: 20px; display: flex; justify-content: center; }
        .document-page { background: #fff; width: 210mm; min-height: 297mm; padding: 25mm 20mm; box-shadow: 0 0 10px rgba(0,0,0,0.5); box-sizing: border-box; }
        
        /* Kop Surat Resmi */
        .kop-surat { display: flex; align-items: center; border-bottom: 4px double #000; padding-bottom: 12px; margin-bottom: 25px; }
        .kop-surat img { width: 85px; height: auto; }
        .kop-teks { flex: 1; text-align: center; padding: 0 15px; }
        .kop-teks h2 { margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .kop-teks h1 { margin: 5px 0; font-size: 18pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; }
        .kop-teks p { margin: 2px 0 0 0; font-size: 10pt; font-family: 'Arial', sans-serif; }

        .doc-title { text-align: center; font-size: 14pt; font-weight: bold; margin-bottom: 30px; text-decoration: underline; letter-spacing: 0.5px; }
        
        /* Tabel Data Diri */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12pt; line-height: 1.5; }
        td { padding: 6px 4px; vertical-align: top; }
        .label-col { width: 32%; }
        .separator { width: 3%; text-align: center; }
        .value-col { width: 65%; font-weight: bold; text-transform: capitalize; }

        /* Sembunyikan tombol web saat diprint */
        @media print {
            body { background-color: #fff; padding: 0; }
            .document-page { box-shadow: none; width: 100%; padding: 0; margin: 0; min-height: auto; }
            .no-print { display: none !important; }
        }

        /* Tombol melayang untuk download */
        .btn-print { background-color: #10b981; color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; position: fixed; bottom: 30px; right: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); transition: 0.2s; font-family: 'Arial', sans-serif; }
        .btn-print:hover { background-color: #059669; }
=======
        /* Desain Khusus Kertas Dokumen A4 */
        body { 
            font-family: 'Times New Roman', Times, serif; 
            color: #000; 
            background-color: #525659; 
            margin: 0; 
            padding: 10px; 
            display: flex; 
            justify-content: center; 
        }
        
        .document-page { 
            background: #fff; 
            width: 210mm; 
            height: 297mm; /* Mengunci tinggi agar pas 1 halaman penuh */
            padding: 12mm 15mm; 
            box-shadow: 0 0 10px rgba(0,0,0,0.5); 
            box-sizing: border-box; 
            position: relative;
            overflow: hidden;
        }
        
        /* Kop Surat Resmi (Dipadatkan) */
        .kop-surat { 
            display: flex; 
            align-items: center; 
            border-bottom: 3px double #000; 
            padding-bottom: 8px; 
            margin-bottom: 15px; 
        }
        .kop-surat img { width: 70px; height: auto; }
        .kop-teks { flex: 1; text-align: center; padding: 0 10px; }
        .kop-teks h2 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
        .kop-teks h1 { margin: 3px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; }
        .kop-teks p { margin: 1px 0 0 0; font-size: 9pt; font-family: 'Arial', sans-serif; }

        .doc-title { 
            text-align: center; 
            font-size: 13pt; 
            font-weight: bold; 
            margin-bottom: 5px; 
            text-decoration: underline; 
            letter-spacing: 0.5px; 
        }

        /* Nomor Pendaftaran */
        .no-pendaftaran {
            text-align: center;
            font-size: 11pt;
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        /* Tabel Data Diri (Dipadatkan jaraknya) */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px; 
            font-size: 11.5pt; 
            line-height: 1.4; 
        }
        td { padding: 4px 3px; vertical-align: top; }
        .label-col { width: 35%; }
        .separator { width: 3%; text-align: center; }
        .value-col { width: 62%; font-weight: bold; text-transform: capitalize; }

        /* Area Tanda Tangan */
        .signature-section {
            margin-top: 25px; 
            text-align: right; 
            padding-right: 30px; 
            font-size: 11.5pt;
        }
        .signature-space {
            height: 65px;
        }

        /* Tombol melayang untuk download */
        .btn-print { 
            background-color: #10b981; 
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 8px; 
            font-size: 15px; 
            font-weight: bold; 
            cursor: pointer; 
            position: fixed; 
            bottom: 25px; 
            right: 25px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.3); 
            transition: 0.2s; 
            font-family: 'Arial', sans-serif; 
            z-index: 1000;
        }
        .btn-print:hover { background-color: #059669; }

        /* Aturan Print Murni 1 Halaman */
        @media print {
            @page {
                size: A4 portrait;
                margin: 0; 
            }

            body {
                background-color: white !important;
                padding: 0 !important;
                margin: 0 !important;
                display: block;
            }

            .document-page {
                width: 100%;
                height: 100vh;
                box-shadow: none;
                padding: 10mm 15mm;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }
        }
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    </style>
</head>
<body>

    <button onclick="window.print()" class="btn-print no-print">
<<<<<<< HEAD
        💾 Cetak / Download PDF
=======
        🖨️ Cetak / Download PDF
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    </button>

    <div class="document-page">
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <img src="/images/jambi.png" alt="Logo Jambi">
            <div class="kop-teks">
                <h2>Pemerintah Kota Jambi</h2>
                <h1>Dinas Pemadam Kebakaran dan Penyelamatan</h1>
                <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi 36125</p>
                <p>Email: damkar.jbi@gmail.com | Website: damkar.jambikota.go.id</p>
            </div>
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </div>

        <div class="doc-title">
            FORMULIR PENDAFTARAN RELAWAN PEMADAM KEBAKARAN (REDKAR)
        </div>
<<<<<<< HEAD
=======
        <div class="no-pendaftaran">
            No. Register: {{ $relawan->id }}
        </div>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573

        <table>
            <tr>
                <td class="label-col">1. Tanggal Pendaftaran</td>
                <td class="separator">:</td>
                <td class="value-col">{{ \Carbon\Carbon::parse($relawan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">2. NIK (Nomor KTP)</td>
=======
                <td class="label-col">2. Username (Akun Sistem)</td>
                <td class="separator">:</td>
                <td class="value-col" style="text-transform: none;">{{ $relawan->username }}</td>
            </tr>
            <tr>
                <td class="label-col">3. NIK (Nomor KTP)</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nik }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">3. Nama Lengkap</td>
=======
                <td class="label-col">4. Nama Lengkap</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nama_lengkap }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">4. Jenis Kelamin</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="label-col">5. Tempat, Tanggal Lahir</td>
=======
                <td class="label-col">5. Jenis Kelamin</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td class="label-col">6. Tempat, Tanggal Lahir</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->tempat_lahir }}, {{ \Carbon\Carbon::parse($relawan->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">6. Status Perkawinan</td>
=======
                <td class="label-col">7. Status Perkawinan</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->status_perkawinan }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">7. Agama</td>
=======
                <td class="label-col">8. Agama</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->agama }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">8. Nomor Telepon / WA</td>
=======
                <td class="label-col">9. Nomor Telepon / WA</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nomor_telp }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">9. Pendidikan Terakhir</td>
                <td class="separator">:</td>
                <td class="value-col">{{ strtoupper($relawan->pendidikan_terakhir) }}</td>
            </tr>
            <tr>
                <td class="label-col">10. Pekerjaan</td>
=======
                <td class="label-col">10. Pendidikan Terakhir</td>
                <td class="separator">:</td>
                <td class="value-col">{{ strtoupper($relawan->pendidikan_terakhir) }} - ({{ $relawan->latar_belakang_pendidikan }})</td>
            </tr>
            <tr>
                <td class="label-col">11. Pekerjaan</td>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->pekerjaan }}</td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">11. Alamat Lengkap</td>
                <td class="separator">:</td>
                <td class="value-col" style="line-height: 1.6;">
                    {{ $relawan->alamat }}, {{ $relawan->rt_rw }}<br>
=======
                <td class="label-col">12. Alamat Lengkap</td>
                <td class="separator">:</td>
                <td class="value-col" style="line-height: 1.4;">
                    {{ $relawan->alamat }}, RT/RW {{ $relawan->rt_rw }}<br>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                    Kel. {{ $relawan->kelurahan }}, Kec. {{ $relawan->kecamatan }}<br>
                    {{ $relawan->kabupaten_kota }}, {{ $relawan->provinsi }} - {{ $relawan->kode_pos }}
                </td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td class="label-col">12. Riwayat Kesehatan</td>
                <td class="separator">:</td>
                <td class="value-col" style="font-weight: normal; line-height: 1.6;">
                    - Sehat Jasmani & Rohani &nbsp;: <b>{{ $relawan->sehat_jasmani }}</b><br>
                    - Tidak Buta Warna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $relawan->buta_warna }}</b><br>
                    - Golongan Darah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ strtoupper($relawan->golongan_darah) }}</b>
=======
                <td class="label-col">13. Riwayat Kesehatan</td>
                <td class="separator">:</td>
                <td class="value-col" style="font-weight: normal; line-height: 1.4;">
                    - Sehat Jasmani & Rohani : <b>{{ $relawan->sehat_jasmani }}</b><br>
                    - Golongan Darah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ strtoupper($relawan->golongan_darah) }}</b>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
                </td>
            </tr>
        </table>

<<<<<<< HEAD
        <div style="margin-top: 60px; text-align: right; padding-right: 40px; font-size: 12pt;">
            <p>Jambi, {{ \Carbon\Carbon::parse($relawan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
            <p style="margin-bottom: 90px;">Calon Relawan,</p>
            <p style="font-weight: bold; text-decoration: underline; text-transform: uppercase;">{{ $relawan->nama_lengkap }}</p>
=======
        <div class="signature-section">
            <p>Jambi, {{ \Carbon\Carbon::parse($relawan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
            <p style="margin-bottom: 0;">Calon Relawan,</p>
            <div class="signature-space"></div>
            <p style="font-weight: bold; text-decoration: underline; text-transform: uppercase; margin: 0;">{{ $relawan->nama_lengkap }}</p>
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
        </div>
    </div>

    <!-- Script otomatis buka dialog print -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>