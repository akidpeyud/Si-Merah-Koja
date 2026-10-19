<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata_REDKAR_{{ $relawan->nama_lengkap }}</title>
    <style>
        /* Desain Khusus Kertas Dokumen A4 */
        body { 
            font-family: 'Times New Roman', Times, serif; 
            color: #000; 
            background-color: #525659; 
            margin: 0; 
            padding: 20px 10px; 
            display: flex; 
            justify-content: center; 
        }
        
        .document-page { 
            background: #fff; 
            width: 210mm; 
            min-height: 297mm; 
            padding: 15mm 20mm; 
            box-shadow: 0 0 15px rgba(0,0,0,0.5); 
            box-sizing: border-box; 
            position: relative;
        }
        
        /* Kop Surat Resmi */
        .kop-surat { 
            display: flex; 
            align-items: center; 
            border-bottom: 3px double #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .kop-surat img { width: 70px; height: auto; }
        .kop-teks { flex: 1; text-align: center; padding: 0 10px; }
        .kop-teks h2 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
        .kop-teks h1 { margin: 3px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; }
        .kop-teks p { margin: 2px 0 0 0; font-size: 9pt; font-family: 'Arial', sans-serif; }

        .doc-title { 
            text-align: center; 
            font-size: 13pt; 
            font-weight: bold; 
            margin-bottom: 4px; 
            text-decoration: underline; 
            letter-spacing: 0.5px; 
            text-transform: uppercase;
        }

        /* Nomor Registrasi */
        .no-pendaftaran {
            text-align: center;
            font-size: 11pt;
            margin-bottom: 22px;
            font-weight: bold;
        }
        
        /* Tabel Data Diri */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
            font-size: 11.5pt; 
            line-height: 1.5; 
        }
        td { padding: 5px 4px; vertical-align: top; }
        .label-col { width: 35%; }
        .separator { width: 3%; text-align: center; }
        .value-col { width: 62%; font-weight: bold; text-transform: capitalize; }

        /* Tabel Sub-detail untuk Riwayat Kesehatan agar titik dua sejajar */
        .sub-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }
        .sub-table td {
            padding: 1px 0;
            font-weight: normal;
        }

        /* Area Tanda Tangan */
        .signature-section {
            margin-top: 35px; 
             float: right;
            width: 240px;
            text-align: center; 
            font-size: 11.5pt;
        }
        .signature-space {
            height: 70px;
        }

        /* Tombol melayang untuk cetak/download */
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
        .btn-print:hover { background-color: #059669; transform: translateY(-1px); }

        /* Aturan Print Murni 1 Halaman A4 */
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
                padding: 12mm 18mm;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="btn-print no-print">
        🖨️ Cetak / Download PDF
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
            DATA BIODATA RELAWAN PEMADAM KEBAKARAN (REDKAR)
        </div>
        <div class="no-pendaftaran">
            No. Register: {{ str_pad($relawan->id, 4, '0', STR_PAD_LEFT) }} / REDKAR-JBI / {{ \Carbon\Carbon::parse($relawan->created_at)->format('Y') }}
        </div>

        <table>
            <tr>
                <td class="label-col">1. Tanggal Pendataan</td>
                <td class="separator">:</td>
                <td class="value-col">{{ \Carbon\Carbon::parse($relawan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="label-col">2. NIK (Nomor KTP)</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nik }}</td>
            </tr>
            <tr>
                <td class="label-col">3. Nama Lengkap</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td class="label-col">4. Jenis Kelamin</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->jenis_kelamin == 'L' ? 'Laki-Laki' : ($relawan->jenis_kelamin == 'P' ? 'Perempuan' : $relawan->jenis_kelamin) }}</td>
            </tr>
            <tr>
                <td class="label-col">5. Tempat, Tanggal Lahir</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->tempat_lahir }}, {{ \Carbon\Carbon::parse($relawan->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="label-col">6. Status Perkawinan</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->status_perkawinan }}</td>
            </tr>
            <tr>
                <td class="label-col">7. Agama</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->agama }}</td>
            </tr>
            <tr>
                <td class="label-col">8. Nomor Telepon / WA</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nomor_telp }}</td>
            </tr>
            <tr>
                <td class="label-col">9. Pendidikan Terakhir</td>
                <td class="separator">:</td>
                <td class="value-col">
                    {{ strtoupper($relawan->pendidikan_terakhir) }}
                    @if($relawan->latar_belakang_pendidikan)
                        ({{ $relawan->latar_belakang_pendidikan }})
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label-col">10. Pekerjaan</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->pekerjaan }}</td>
            </tr>
            <tr>
                <td class="label-col">11. Alamat Lengkap</td>
                <td class="separator">:</td>
                <td class="value-col" style="line-height: 1.45;">
                    {{ $relawan->alamat }}, RT/RW {{ $relawan->rt_rw }}<br>
                    Kel. {{ $relawan->kelurahan }}, Kec. {{ $relawan->kecamatan }}<br>
                    {{ $relawan->kabupaten_kota }}, {{ $relawan->provinsi }} {{ $relawan->kode_pos ? '- ' . $relawan->kode_pos : '' }}
                </td>
            </tr>
            <tr>
                <td class="label-col">12. Keterangan Kesehatan</td>
                <td class="separator">:</td>
                <td class="value-col">
                    <table class="sub-table">
                        <tr>
                            <td style="width: 175px;">- Sehat Jasmani & Rohani</td>
                            <td style="width: 15px;">:</td>
                            <td><b>{{ $relawan->sehat_jasmani }}</b></td>
                        </tr>
                        <tr>
                            <td>- Golongan Darah</td>
                            <td>:</td>
                            <td><b>{{ strtoupper($relawan->golongan_darah) }}</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="signature-section">
            <p style="margin: 0 0 4px 0;">Jambi, {{ \Carbon\Carbon::parse($relawan->created_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
            <p style="margin: 0;">Anggota Relawan (REDKAR),</p>
            <div class="signature-space"></div>
            <p style="font-weight: bold; text-decoration: underline; text-transform: uppercase; margin: 0;">{{ $relawan->nama_lengkap }}</p>
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