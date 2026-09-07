<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata_REDKAR_{{ $relawan->nama_lengkap }}</title>
    <style>
        /* Desain Khusus Kertas Dokumen */
        body { font-family: 'Arial', sans-serif; color: #000; background-color: #525659; margin: 0; padding: 20px; display: flex; justify-content: center; }
        .document-page { background: #fff; width: 210mm; min-height: 297mm; padding: 20mm; box-shadow: 0 0 10px rgba(0,0,0,0.5); }
        
        .kop-surat { display: flex; align-items: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-surat img { width: 80px; }
        .kop-teks { flex: 1; text-align: center; }
        .kop-teks h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .kop-teks h1 { margin: 5px 0; font-size: 24px; font-weight: bold; text-transform: uppercase; }
        .kop-teks p { margin: 0; font-size: 12px; }

        .doc-title { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 20px; text-decoration: underline; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px; }
        td { padding: 8px; vertical-align: top; }
        .label-col { width: 30%; font-weight: bold; }
        .separator { width: 2%; text-align: center; font-weight: bold; }
        .value-col { width: 68%; }

        /* Sembunyikan elemen web saat proses Save to PDF / Print */
        @media print {
            body { background-color: #fff; padding: 0; }
            .document-page { box-shadow: none; width: 100%; padding: 0; margin: 0; min-height: auto; }
            .no-print { display: none !important; }
        }

        .btn-print { background-color: #10b981; color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; position: fixed; bottom: 30px; right: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .btn-print:hover { background-color: #059669; }
    </style>
</head>
<body>

    <button onclick="window.print()" class="btn-print no-print">
        💾 Download PDF / Cetak Dokumen
    </button>

    <div class="document-page">
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <img src="/images/jambi.png" alt="Logo Jambi">
            <div class="kop-teks">
                <h2>Pemerintah Kota Jambi</h2>
                <h1>Dinas Pemadam Kebakaran dan Penyelamatan</h1>
                <p>Jl. HOS. Cokroaminoto, Suka Karya, Kec. Kota Baru, Kota Jambi</p>
                <p>Email: damkar.jbi@gmail.com | Website: damkar.jambikota.go.id</p>
            </div>
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
        </div>

        <div class="doc-title">
            FORMULIR PENDAFTARAN RELAWAN PEMADAM KEBAKARAN (REDKAR)
        </div>

        <table>
            <tr>
                <td class="label-col">Tanggal Pendaftaran</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->created_at->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label-col">NIK (Nomor Induk Kependudukan)</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nik }}</td>
            </tr>
            <tr>
                <td class="label-col">Nama Lengkap</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td class="label-col">Jenis Kelamin</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="label-col">Tempat, Tanggal Lahir</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->tempat_lahir }}, {{ \Carbon\Carbon::parse($relawan->tanggal_lahir)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label-col">Status Perkawinan</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->status_perkawinan }}</td>
            </tr>
            <tr>
                <td class="label-col">Agama</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->agama }}</td>
            </tr>
            <tr>
                <td class="label-col">Nomor HP / WhatsApp</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->nomor_telp }}</td>
            </tr>
            <tr>
                <td class="label-col">Alamat Lengkap</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->alamat }}, {{ $relawan->rt_rw }}, Kel. {{ $relawan->kelurahan }}, Kec. {{ $relawan->kecamatan }}, {{ $relawan->kabupaten_kota }}, {{ $relawan->provinsi }} - {{ $relawan->kode_pos }}</td>
            </tr>
            <tr>
                <td class="label-col">Pekerjaan</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->pekerjaan }}</td>
            </tr>
            <tr>
                <td class="label-col">Pendidikan Terakhir</td>
                <td class="separator">:</td>
                <td class="value-col">{{ $relawan->pendidikan_terakhir }}</td>
            </tr>
            <tr>
                <td class="label-col">Kondisi Fisik & Kesehatan</td>
                <td class="separator">:</td>
                <td class="value-col">
                    Sehat Jasmani: <b>{{ $relawan->sehat_jasmani }}</b><br>
                    Buta Warna: <b>{{ $relawan->buta_warna }}</b><br>
                    Golongan Darah: <b>{{ $relawan->golongan_darah }}</b>
                </td>
            </tr>
        </table>

        <div style="margin-top: 50px; text-align: right; padding-right: 50px;">
            <p>Jambi, {{ $relawan->created_at->format('d F Y') }}</p>
            <p style="margin-bottom: 80px;">Calon Relawan,</p>
            <p style="font-weight: bold; text-decoration: underline;">{{ $relawan->nama_lengkap }}</p>
        </div>
    </div>

    <!-- Script otomatis buka dialog print/save PDF saat halaman dimuat (Bisa dihapus jika ingin klik tombol manual saja) -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>