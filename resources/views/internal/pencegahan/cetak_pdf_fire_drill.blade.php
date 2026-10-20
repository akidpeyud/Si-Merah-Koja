<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Data Pelaksanaan Fire Drill</title>
    <style>
        @page { size: landscape; margin: 12mm 15mm; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #000; margin: 0; padding: 0; }

        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 16px; border-collapse: collapse; }
        .kop-surat td { border: none !important; padding: 0; vertical-align: middle; }
        .logo-kiri { text-align: left; width: 12%; }
        .logo-kanan { text-align: right; width: 12%; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 16px; font-weight: bold; }
        .teks-tengah .dinas { font-size: 21px; font-weight: bold; }
        .teks-tengah .alamat { font-size: 12px; }

        .judul-utama { text-align: center; font-weight: bold; font-size: 13px; line-height: 1.45; margin-bottom: 10px; text-transform: uppercase; }
        .sub-tahun { text-align: center; font-weight: bold; font-size: 13px; margin: 22px 0 8px; text-transform: uppercase; }

        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 18px; font-size: 11px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px 8px; vertical-align: middle; }
        .table-data th {
            background-color: #d9d9d9 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            text-align: center;
            font-weight: bold;
        }
        .tr-total td {
            background-color: #f2f2f2 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-weight: bold;
        }
        .tr-grand-total td {
            background-color: #ffe699 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-weight: bold;
            font-size: 11.5px;
        }
        .text-center { text-align: center; }
        .ol-peserta { margin: 0; padding-left: 16px; line-height: 1.45; text-align: left; }

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
        <button class="btn-cetak" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
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
        INSTANSI PEMERINTAH / SWASTA<br>
        YANG MELAKSANAKAN PELATIHAN PEMADAM KEBAKARAN
        @if(!empty($tahunDipilih))
            <br>TAHUN {{ $tahunDipilih }}
        @endif
        @if(!empty($instansiDipilih))
            <br><span style="font-size: 11px; font-weight: normal;">Filter Instansi: {{ strtoupper($instansiDipilih) }}</span>
        @endif
    </div>

    @php
        $groups = isset($groupedByYear) ? $groupedByYear : collect($data)->groupBy('tahun');

        // Pengaman: kalau ada tahun dipilih, hanya tahun itu yang tampil
        if (!empty($tahunDipilih)) {
            $groups = $groups->filter(fn($items, $thn) => (string) $thn === (string) $tahunDipilih);
        }

        // Selalu urut 2023, 2024, 2025, 2026, ...
        $groups = $groups->sortKeys();

        $grandInstansi = 0;
        $grandLaki = 0;
        $grandPerempuan = 0;
        $grandPeserta = 0;
    @endphp

    @forelse($groups as $tahun => $items)
        @php
            $adaGender = $items->contains(fn($i) => ($i->peserta_laki_laki > 0 || $i->peserta_perempuan > 0));
            $adaNamaPeserta = $items->contains(fn($i) => (!empty(trim($i->nama_peserta_laki_laki ?? '')) || !empty(trim($i->nama_peserta_perempuan ?? ''))));
            $totalLaki = 0;
            $totalPerempuan = 0;
            $totalPeserta = 0;
        @endphp

        @if(empty($tahunDipilih))
            <div class="sub-tahun">TAHUN {{ $tahun }}</div>
        @endif

        <table class="table-data">
            <thead>
                @if(!$adaGender && !$adaNamaPeserta)
                    <tr>
                        <th width="5%">NO</th>
                        <th width="33%">NAMA INSTANSI</th>
                        <th width="20%">TANGGAL PELAKSANAAN</th>
                        <th width="30%">TEMPAT PELAKSANAAN</th>
                        <th width="12%">JUMLAH PESERTA</th>
                    </tr>
                @elseif($adaGender && !$adaNamaPeserta)
                    <tr>
                        <th width="5%">NO</th>
                        <th width="29%">NAMA INSTANSI</th>
                        <th width="18%">TANGGAL PELAKSANAAN</th>
                        <th width="24%">TEMPAT PELAKSANAAN</th>
                        <th width="8%">Laki-laki</th>
                        <th width="8%">Perempuan</th>
                        <th width="8%">JUMLAH PESERTA</th>
                    </tr>
                @else
                    <tr>
                        <th rowspan="2" width="4%">NO</th>
                        <th rowspan="2" width="20%">NAMA INSTANSI</th>
                        <th rowspan="2" width="13%">TANGGAL PELAKSANAAN</th>
                        <th rowspan="2" width="17%">TEMPAT PELAKSANAAN</th>
                        <th colspan="3" width="18%">JUMLAH PESERTA</th>
                        <th colspan="2" width="28%">DAFTAR NAMA PESERTA</th>
                    </tr>
                    <tr>
                        <th width="6%">Laki-laki</th>
                        <th width="6%">Perempuan</th>
                        <th width="6%">TOTAL</th>
                        <th width="14%">LAKI-LAKI</th>
                        <th width="14%">PEREMPUAN</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @foreach($items->values() as $idx => $item)
                    @php
                        $totalLaki += (int) ($item->peserta_laki_laki ?? 0);
                        $totalPerempuan += (int) ($item->peserta_perempuan ?? 0);
                        $totalPeserta += (int) ($item->total_peserta ?? 0);
                        $listLaki = !empty($item->nama_peserta_laki_laki) ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_laki_laki)))) : [];
                        $listPerempuan = !empty($item->nama_peserta_perempuan) ? array_values(array_filter(preg_split('/\r\n|\r|\n/', trim($item->nama_peserta_perempuan)))) : [];
                        $punyaLP = ($item->peserta_laki_laki > 0 || $item->peserta_perempuan > 0 || count($listLaki) > 0 || count($listPerempuan) > 0);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td>{{ $item->nama_instansi ?? '-' }}</td>
                        <td>{{ $item->tanggal_pelaksanaan ?? '-' }}</td>
                        <td>{{ $item->tempat_pelaksanaan ?? '-' }}</td>

                        @if(!$adaGender && !$adaNamaPeserta)
                            <td class="text-center">{{ $item->total_peserta ?: 0 }}</td>
                        @elseif($adaGender && !$adaNamaPeserta)
                            <td class="text-center">{{ $punyaLP ? ($item->peserta_laki_laki ?? 0) : '-' }}</td>
                            <td class="text-center">{{ $punyaLP ? ($item->peserta_perempuan ?? 0) : '-' }}</td>
                            <td class="text-center">{{ $item->total_peserta ?: 0 }}</td>
                        @else
                            <td class="text-center">{{ $punyaLP ? ($item->peserta_laki_laki ?? 0) : '-' }}</td>
                            <td class="text-center">{{ $punyaLP ? ($item->peserta_perempuan ?? 0) : '-' }}</td>
                            <td class="text-center" style="font-weight:bold;">{{ $item->total_peserta ?: 0 }}</td>
                            <td style="vertical-align: top;">
                                @if(count($listLaki) > 0)
                                    <ol class="ol-peserta">
                                        @foreach($listLaki as $nL) <li>{{ $nL }}</li> @endforeach
                                    </ol>
                                @else
                                    <div class="text-center">-</div>
                                @endif
                            </td>
                            <td style="vertical-align: top;">
                                @if(count($listPerempuan) > 0)
                                    <ol class="ol-peserta">
                                        @foreach($listPerempuan as $nP) <li>{{ $nP }}</li> @endforeach
                                    </ol>
                                @else
                                    <div class="text-center">-</div>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach

                <tr class="tr-total">
                    <td colspan="4" class="text-center">JUMLAH TOTAL TAHUN {{ $tahun }}</td>
                    @if(!$adaGender && !$adaNamaPeserta)
                        <td class="text-center">{{ number_format($totalPeserta, 0, ',', '.') }}</td>
                    @elseif($adaGender && !$adaNamaPeserta)
                        <td class="text-center">{{ number_format($totalLaki, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($totalPerempuan, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($totalPeserta, 0, ',', '.') }}</td>
                    @else
                        <td class="text-center">{{ number_format($totalLaki, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($totalPerempuan, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($totalPeserta, 0, ',', '.') }}</td>
                        <td colspan="2"></td>
                    @endif
                </tr>
            </tbody>
        </table>

        @php
            $grandInstansi += $items->count();
            $grandLaki += $totalLaki;
            $grandPerempuan += $totalPerempuan;
            $grandPeserta += $totalPeserta;
        @endphp
    @empty
        <table class="table-data">
            <tr><td class="text-center">Belum ada data Fire Drill.</td></tr>
        </table>
    @endforelse

    @if(empty($tahunDipilih) && $groups->count() > 1)
        <div class="sub-tahun" style="margin-top: 28px;">REKAPITULASI TOTAL PESERTA PER TAHUN &amp; KESELURUHAN</div>
        <table class="table-data">
            <thead>
                <tr>
                    <th width="6%">NO</th>
                    <th width="24%">TAHUN PELAKSANAAN</th>
                    <th width="22%">JUMLAH INSTANSI</th>
                    <th width="24%">RINCIAN LAKI-LAKI &amp; PEREMPUAN</th>
                    <th width="24%">JUMLAH TOTAL PESERTA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $thn => $items)
                    @php
                        $lThn = $items->sum(fn($i) => (int) ($i->peserta_laki_laki ?? 0));
                        $pThn = $items->sum(fn($i) => (int) ($i->peserta_perempuan ?? 0));
                        $tThn = $items->sum(fn($i) => (int) ($i->total_peserta ?? 0));
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center" style="font-weight:bold;">Tahun {{ $thn }}</td>
                        <td class="text-center">{{ $items->count() }} Instansi</td>
                        <td class="text-center">
                            {{ ($lThn > 0 || $pThn > 0) ? "Laki-laki: {$lThn} | Perempuan: {$pThn}" : '-' }}
                        </td>
                        <td class="text-center" style="font-weight:bold;">{{ number_format($tThn, 0, ',', '.') }} Orang</td>
                    </tr>
                @endforeach
                <tr class="tr-grand-total">
                    <td colspan="2" class="text-center">JUMLAH TOTAL KESELURUHAN (SEMUA TAHUN)</td>
                    <td class="text-center">{{ number_format($grandInstansi, 0, ',', '.') }} Instansi</td>
                    <td class="text-center">Laki-laki: {{ number_format($grandLaki, 0, ',', '.') }} | Perempuan: {{ number_format($grandPerempuan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($grandPeserta, 0, ',', '.') }} Orang</td>
                </tr>
            </tbody>
        </table>
    @endif

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>