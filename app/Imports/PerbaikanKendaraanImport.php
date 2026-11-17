<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class PerbaikanKendaraanImport implements ToCollection, WithCalculatedFormulas
{
    public int $insertedCount = 0;

    public int $updatedCount = 0;

    public int $skippedCount = 0;

    /**
     * Proses data baris demi baris dari Excel
     */
    public function collection(Collection $rows): void
    {
        if ($rows->isEmpty()) {
            return;
        }

        $headerRowIndex = null;
        $colIndex = [];

        // 1. Cari baris header secara dinamis (mencari kolom Nopol / No Polisi / Kendaraan)
        foreach ($rows as $rIdx => $row) {
            foreach ($row as $cIdx => $cell) {
                $val = strtolower(trim((string) $cell));
                if (str_contains($val, 'nopol') || str_contains($val, 'no polisi') || str_contains($val, 'nomor polisi')) {
                    $headerRowIndex = $rIdx;
                    break 2;
                }
            }
        }

        // Jika ditemukan baris header, petakan kolom berdasarkan teks header
        if ($headerRowIndex !== null) {
            $headerRow = $rows[$headerRowIndex];
            foreach ($headerRow as $cIdx => $cell) {
                $h = strtolower(trim((string) $cell));
                if (str_contains($h, 'nopol') || str_contains($h, 'no polisi') || str_contains($h, 'nomor polisi')) {
                    $colIndex['nopol'] = $cIdx;
                } elseif (str_contains($h, 'jenis kendaraan') || $h === 'jenis') {
                    $colIndex['jenis_kendaraan'] = $cIdx;
                } elseif (str_contains($h, 'merk') || str_contains($h, 'merek kendaraan')) {
                    $colIndex['merk_kendaraan'] = $cIdx;
                } elseif (str_contains($h, 'tgl') || str_contains($h, 'tanggal')) {
                    $colIndex['tgl_perbaikan'] = $cIdx;
                } elseif (str_contains($h, 'kerusakan') || str_contains($h, 'penggantian') || str_contains($h, 'barang')) {
                    if (! isset($colIndex['jenis_kerusakan'])) {
                        $colIndex['jenis_kerusakan'] = $cIdx;
                    } elseif (! isset($colIndex['merek_tipe_barang']) && (str_contains($h, 'merek') || str_contains($h, 'tipe'))) {
                        $colIndex['merek_tipe_barang'] = $cIdx;
                    }
                } elseif (str_contains($h, 'merek / tipe') || str_contains($h, 'tipe barang')) {
                    $colIndex['merek_tipe_barang'] = $cIdx;
                } elseif (str_contains($h, 'satuan') || str_contains($h, 'qty') || str_contains($h, 'jumlah')) {
                    $colIndex['satuan'] = $cIdx;
                } elseif (str_contains($h, 'rincian harga') || str_contains($h, 'harga satuan')) {
                    $colIndex['rincian_harga'] = $cIdx;
                } elseif (str_contains($h, 'total') || str_contains($h, 'biaya')) {
                    $colIndex['total_harga'] = $cIdx;
                }
            }
            $dataRows = $rows->slice($headerRowIndex + 1);
        } else {
            // Fallback: Jika tidak ada baris header yang terdeteksi, gunakan urutan default sesuai format export
            // Col 1: Nopol, 2: Jenis, 3: Merk, 4: Tgl, 5: Kerusakan, 6: Merek Tipe, 7: Satuan, 8: Rincian Harga, 9: Total Harga
            $colIndex = [
                'nopol' => 1,
                'jenis_kendaraan' => 2,
                'merk_kendaraan' => 3,
                'tgl_perbaikan' => 4,
                'jenis_kerusakan' => 5,
                'merek_tipe_barang' => 6,
                'satuan' => 7,
                'rincian_harga' => 8,
                'total_harga' => 9,
            ];
            $dataRows = $rows->slice(1);
        }

        foreach ($dataRows as $row) {
            $nopolRaw = trim((string) ($row[$colIndex['nopol'] ?? 1] ?? ''));
            if ($nopolRaw === '' || str_starts_with($nopolRaw, '#') || strtolower($nopolRaw) === 'nopol kendaraan') {
                continue;
            }

            // Normalisasi Nopol
            $nopol = strtoupper(preg_replace('/\s+/', ' ', $nopolRaw));

            // Normalisasi Jenis Kendaraan (R2, R4, R6, R10)
            $jenisRaw = strtoupper(trim((string) ($row[$colIndex['jenis_kendaraan'] ?? 2] ?? '')));
            $jenis = 'R4'; // default
            if (in_array($jenisRaw, ['R2', 'R4', 'R6', 'R10'])) {
                $jenis = $jenisRaw;
            } elseif (str_contains($jenisRaw, 'MOTOR') || str_contains($jenisRaw, 'RODA 2') || str_contains($jenisRaw, 'RODA DUA')) {
                $jenis = 'R2';
            } elseif (str_contains($jenisRaw, 'R6') || str_contains($jenisRaw, 'RODA 6') || str_contains($jenisRaw, 'TRUK') || str_contains($jenisRaw, 'DAMKAR')) {
                $jenis = 'R6';
            } elseif (str_contains($jenisRaw, 'R10') || str_contains($jenisRaw, 'RODA 10') || str_contains($jenisRaw, 'FUSO')) {
                $jenis = 'R10';
            }

            // Merk Kendaraan
            $merk = trim((string) ($row[$colIndex['merk_kendaraan'] ?? 3] ?? ''));
            if ($merk === '') {
                $merk = '-';
            }

            // Tanggal Perbaikan
            $tglRaw = $row[$colIndex['tgl_perbaikan'] ?? 4] ?? null;
            $tglPerbaikan = $this->parseTanggal($tglRaw);
            if (! $tglPerbaikan) {
                // Jika tanggal tidak valid, lewati baris ini
                $this->skippedCount++;

                continue;
            }

            // Jenis Kerusakan / Penggantian Barang
            $kerusakan = trim((string) ($row[$colIndex['jenis_kerusakan'] ?? 5] ?? ''));
            if ($kerusakan === '') {
                $kerusakan = 'Perbaikan Operasional';
            }

            // Merek / Tipe Barang
            $merekBarang = trim((string) ($row[$colIndex['merek_tipe_barang'] ?? 6] ?? ''));
            if ($merekBarang === '' || $merekBarang === '-') {
                $merekBarang = null;
            }

            // Satuan (Qty)
            $satuan = trim((string) ($row[$colIndex['satuan'] ?? 7] ?? ''));
            if ($satuan === '' || $satuan === '-') {
                $satuan = null;
            }

            // Rincian Harga
            $rincianHarga = trim((string) ($row[$colIndex['rincian_harga'] ?? 8] ?? ''));
            if ($rincianHarga === '' || $rincianHarga === '-') {
                $rincianHarga = null;
            }

            // Total Harga
            $totalRaw = $row[$colIndex['total_harga'] ?? 9] ?? 0;
            $totalHarga = $this->parseHarga($totalRaw);

            // ========================================================
            // LOGIKA ANTI-DUPLIKASI (Cek Nopol + Tanggal + Kerusakan)
            // ========================================================
            $existing = DB::table('perbaikan_kendaraans')
                ->where('nopol_kendaraan', $nopol)
                ->whereDate('tgl_perbaikan', $tglPerbaikan)
                ->where('jenis_kerusakan', $kerusakan)
                ->first();

            $payload = [
                'nopol_kendaraan' => $nopol,
                'jenis_kendaraan' => $jenis,
                'merk_kendaraan' => $merk,
                'tgl_perbaikan' => $tglPerbaikan,
                'jenis_kerusakan' => $kerusakan,
                'merek_tipe_barang' => $merekBarang,
                'satuan' => $satuan,
                'rincian_harga' => $rincianHarga,
                'total_harga' => $totalHarga,
                'updated_at' => now(),
            ];

            if ($existing) {
                // Data sudah ada -> lakukan Update data agar tidak terjadi data dobel
                DB::table('perbaikan_kendaraans')
                    ->where('id', $existing->id)
                    ->update($payload);
                $this->updatedCount++;
            } else {
                // Data belum ada -> Tambahkan data baru
                $payload['created_at'] = now();
                DB::table('perbaikan_kendaraans')->insert($payload);
                $this->insertedCount++;
            }
        }
    }

    /**
     * Konversi berbagai format tanggal Excel menjadi format YYYY-MM-DD
     */
    private function parseTanggal(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Jika berupa angka serial tanggal Excel (misal: 45620)
        if (is_numeric($value) && (float) $value > 25000 && (float) $value < 60000) {
            try {
                $dt = ExcelDate::excelToDateTimeObject((float) $value);

                return $dt->format('Y-m-d');
            } catch (\Throwable) {
                // fallback di bawah
            }
        }

        $str = trim((string) $value);

        // Ganti nama bulan bahasa Indonesia ke bahasa Inggris agar bisa diparse Carbon
        $mapBulan = [
            'januari' => 'january', 'februari' => 'february', 'maret' => 'march',
            'april' => 'april', 'mei' => 'may', 'juni' => 'june',
            'juli' => 'july', 'agustus' => 'august', 'september' => 'september',
            'oktober' => 'october', 'november' => 'november', 'desember' => 'december',
            'ags' => 'aug', 'okt' => 'oct', 'des' => 'dec',
        ];
        $strLower = strtolower($str);
        foreach ($mapBulan as $id => $en) {
            if (str_contains($strLower, $id)) {
                $strLower = str_replace($id, $en, $strLower);
                break;
            }
        }

        try {
            return Carbon::parse($strLower)->format('Y-m-d');
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Bersihkan teks harga (misal "Rp 1.700.000", "1,700,000", "1700000") menjadi integer
     */
    private function parseHarga(mixed $value): int
    {
        if (is_numeric($value)) {
            return (int) $value;
        }

        $clean = preg_replace('/[^0-9]/', '', (string) $value);

        return $clean !== '' ? (int) $clean : 0;
    }
}
