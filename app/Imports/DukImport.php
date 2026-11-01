<?php

namespace App\Imports;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class DukImport implements ToCollection, WithCalculatedFormulas
{
    protected int $importedCount = 0;

    public function __construct(
        protected bool $truncateFirst = true
    ) {}

    /**
     * Handle proses collection data Excel
     */
    public function collection(Collection $rows): void
    {
        $headerCol = null;
        $headerRowIndex = null;

        // Cari baris header yang memuat kolom NAMA dan NIP
        foreach ($rows as $rowIndex => $row) {
            foreach ($row as $colIndex => $cell) {
                $val = strtoupper(trim((string) $cell));
                if ($val === 'NAMA' || $val === 'NAMA PEGAWAI') {
                    // Pastikan di sekitar kolom ini ada NIP
                    $nipCandidate = strtoupper(trim((string) ($row[$colIndex + 1] ?? '')));
                    if ($nipCandidate === 'NIP' || str_contains($nipCandidate, 'NIP')) {
                        $headerCol = $colIndex;
                        $headerRowIndex = $rowIndex;
                        break 2;
                    }
                }
            }
        }

        // Jika tidak ditemukan secara otomatis, fallback ke index default (nama di index 2 jika col 0 kosong, atau index 1)
        if ($headerCol === null) {
            $headerCol = 2;
            $headerRowIndex = 6;
        }

        $baseCol = $headerCol; // Kolom NAMA

        $colMap = [
            'no' => $baseCol - 1,
            'nama' => $baseCol,
            'nip' => $baseCol + 1,
            'pangkat_gol' => $baseCol + 2,
            'pangkat_tmt' => $baseCol + 3,
            'jabatan_nama' => $baseCol + 4,
            'jabatan_tmt' => $baseCol + 5,
            'masa_th' => $baseCol + 6,
            'masa_bln' => $baseCol + 7,
            'diklat_nama' => $baseCol + 8,
            'diklat_tahun' => $baseCol + 9,
            'diklat_tempat' => $baseCol + 10,
            'pend_nama' => $baseCol + 11,
            'pend_tahun' => $baseCol + 12,
            'pend_tingkat' => $baseCol + 13,
            'ttl' => $baseCol + 14,
            'jk' => $baseCol + 15,
            'mutasi' => $baseCol + 16,
            'status' => $baseCol + 17,
        ];

        $pegawaiList = [];
        $currentPegawai = null;

        foreach ($rows as $idx => $row) {
            // Lewati baris header dan di atasnya
            if ($idx <= ($headerRowIndex + 1)) {
                continue;
            }

            $namaVal = trim((string) ($row[$colMap['nama']] ?? ''));
            $nipRaw = trim((string) ($row[$colMap['nip']] ?? ''));
            $nipClean = preg_replace('/[^\d]/', '', $nipRaw);

            // Lewati baris penomoran kolom standar BKN/Excel (misal 1, 2, 3...)
            if ($namaVal === '2' || $namaVal === '2.0' || $nipClean === '3') {
                continue;
            }

            // Lewati baris footer (Kepala Dinas, Tanda tangan, Jambi, Oktober dll)
            $upperNama = strtoupper($namaVal);
            if (
                str_contains($upperNama, 'KEPALA DINAS') ||
                str_contains($upperNama, 'PEMBINA UTAMA') ||
                str_contains($upperNama, 'DAFTAR URUT') ||
                str_contains($upperNama, 'DINAS PEMADAM')
            ) {
                continue;
            }

            // Cek apakah baris ini adalah data pegawai baru
            $isNewPegawai = (! empty($namaVal) && ! empty($nipClean) && strlen($nipClean) >= 8);

            if ($isNewPegawai) {
                // Simpan pegawai sebelumnya jika ada
                if ($currentPegawai !== null) {
                    $pegawaiList[] = $this->finalizePegawaiData($currentPegawai);
                }

                $rawNo = trim((string) ($row[$colMap['no']] ?? ''));
                $cleanNo = (int) round((float) preg_replace('/[^\d.]/', '', $rawNo ?: '0'));

                $rawMasaTh = trim((string) ($row[$colMap['masa_th']] ?? '0'));
                $cleanMasaTh = (int) round((float) preg_replace('/[^\d.]/', '', $rawMasaTh ?: '0'));

                $rawMasaBln = trim((string) ($row[$colMap['masa_bln']] ?? '0'));
                $cleanMasaBln = (int) round((float) preg_replace('/[^\d.]/', '', $rawMasaBln ?: '0'));

                $jkVal = trim((string) ($row[$colMap['jk']] ?? ''));
                $gender = str_contains(strtoupper($jkVal), 'P') && ! str_contains(strtoupper($jkVal), 'LAKI')
                    ? 'Perempuan'
                    : 'Laki-laki';

                $currentPegawai = [
                    'no_urut' => $cleanNo ?: (count($pegawaiList) + 1),
                    'nama' => $namaVal,
                    'nip' => $nipClean,
                    'pangkat_gol_ruang' => $this->cleanString($row[$colMap['pangkat_gol']] ?? null),
                    'pangkat_tmt' => $this->parseExcelDate($row[$colMap['pangkat_tmt']] ?? null),
                    'jabatan_nama' => $this->cleanString($row[$colMap['jabatan_nama']] ?? null),
                    'jabatan_tmt' => $this->parseExcelDate($row[$colMap['jabatan_tmt']] ?? null),
                    'masa_kerja_th' => $cleanMasaTh,
                    'masa_kerja_bln' => $cleanMasaBln,
                    'tempat_tanggal_lahir' => $this->cleanString($row[$colMap['ttl']] ?? null),
                    'jenis_kelamin' => $gender,
                    'catatan_mutasi_pegawai' => $this->cleanString($row[$colMap['mutasi']] ?? null),
                    'status_pegawai' => 'Aktif',
                    'diklat_nama' => [],
                    'diklat_tahun' => [],
                    'diklat_tempat' => [],
                    'pend_nama' => [],
                    'pend_tahun' => [],
                    'pend_tingkat' => [],
                ];

                $this->appendRiwayat($currentPegawai, $row, $colMap);
            } elseif ($currentPegawai !== null) {
                // Baris lanjutan untuk riwayat Diklat atau Pendidikan
                $this->appendRiwayat($currentPegawai, $row, $colMap);
            }
        }

        // Simpan pegawai terakhir
        if ($currentPegawai !== null) {
            $pegawaiList[] = $this->finalizePegawaiData($currentPegawai);
        }

        if (empty($pegawaiList)) {
            return;
        }

        // Simpan ke database menggunakan transaksi
        DB::transaction(function () use ($pegawaiList) {
            if ($this->truncateFirst) {
                Schema::disableForeignKeyConstraints();
                Pegawai::query()->delete();
                Schema::enableForeignKeyConstraints();
            }

            foreach ($pegawaiList as $index => $pegawaiData) {
                $pegawaiData['no_urut'] = $index + 1; // Pastikan nomor urut rapi dari 1..n
                Pegawai::updateOrCreate(
                    ['nip' => $pegawaiData['nip']],
                    $pegawaiData
                );
                $this->importedCount++;
            }
        });
    }

    /**
     * Tambahkan riwayat Diklat / Pendidikan ke pegawai aktif
     */
    protected function appendRiwayat(array &$pegawai, $row, array $colMap): void
    {
        $diklatNama = $this->cleanString($row[$colMap['diklat_nama']] ?? null);
        $diklatTahun = $this->cleanYear($row[$colMap['diklat_tahun']] ?? null);
        $diklatTempat = $this->cleanString($row[$colMap['diklat_tempat']] ?? null);

        if ($diklatNama && $diklatNama !== '-') {
            $pegawai['diklat_nama'][] = $diklatNama;
            $pegawai['diklat_tahun'][] = $diklatTahun ?: '-';
            $pegawai['diklat_tempat'][] = $diklatTempat ?: '-';
        }

        $pendNama = $this->cleanString($row[$colMap['pend_nama']] ?? null);
        $pendTahun = $this->cleanYear($row[$colMap['pend_tahun']] ?? null);
        $pendTingkat = $this->cleanString($row[$colMap['pend_tingkat']] ?? null);

        if ($pendNama && $pendNama !== '-') {
            $pegawai['pend_nama'][] = $pendNama;
            $pegawai['pend_tahun'][] = $pendTahun ?: '-';
            $pegawai['pend_tingkat'][] = $pendTingkat ?: $pendNama;
        }

        // Cek jika baris lanjutan memuat tanggal lahir di kolom TTL
        $subTtl = $this->cleanString($row[$colMap['ttl']] ?? null);
        if ($subTtl && $subTtl !== '-') {
            $formattedDate = $this->formatTanggalLahir($subTtl);
            if ($formattedDate) {
                $baseTtl = rtrim((string) ($pegawai['tempat_tanggal_lahir'] ?? ''), ', ');
                $pegawai['tempat_tanggal_lahir'] = $baseTtl ? "{$baseTtl}, {$formattedDate}" : $formattedDate;
            }
        }

        // Cek jika baris lanjutan memuat catatan mutasi
        $subMutasi = $this->cleanString($row[$colMap['mutasi']] ?? null);
        if ($subMutasi && $subMutasi !== '-') {
            $baseMutasi = trim((string) ($pegawai['catatan_mutasi_pegawai'] ?? ''));
            $pegawai['catatan_mutasi_pegawai'] = $baseMutasi ? "{$baseMutasi} {$subMutasi}" : $subMutasi;
        }
    }

    /**
     * Susun array pegawai menjadi format database (string multiline \n)
     */
    protected function finalizePegawaiData(array $pegawai): array
    {
        $ttlFinal = $this->ensureTtlHasDate($pegawai['tempat_tanggal_lahir'] ?? null, $pegawai['nip'] ?? '');

        return [
            'no_urut' => $pegawai['no_urut'],
            'nip' => $pegawai['nip'],
            'nama' => $pegawai['nama'],
            'tempat_tanggal_lahir' => $ttlFinal,
            'jenis_kelamin' => $pegawai['jenis_kelamin'],
            'status_pegawai' => $pegawai['status_pegawai'],
            'pangkat_gol_ruang' => $pegawai['pangkat_gol_ruang'],
            'pangkat_tmt' => $pegawai['pangkat_tmt'],
            'jabatan_nama' => $pegawai['jabatan_nama'],
            'jabatan_tmt' => $pegawai['jabatan_tmt'],
            'masa_kerja_th' => $pegawai['masa_kerja_th'],
            'masa_kerja_bln' => $pegawai['masa_kerja_bln'],
            'latihan_jabatan_nama' => ! empty($pegawai['diklat_nama']) ? implode("\n", $pegawai['diklat_nama']) : null,
            'latihan_jabatan_tahun_lulus' => ! empty($pegawai['diklat_tahun']) ? implode("\n", $pegawai['diklat_tahun']) : null,
            'latihan_jabatan_tempat' => ! empty($pegawai['diklat_tempat']) ? implode("\n", $pegawai['diklat_tempat']) : null,
            'pendidikan_nama' => ! empty($pegawai['pend_nama']) ? implode("\n", $pegawai['pend_nama']) : null,
            'pendidikan_tahun_lulus' => ! empty($pegawai['pend_tahun']) ? implode("\n", $pegawai['pend_tahun']) : null,
            'pendidikan_tingkat_ijazah' => ! empty($pegawai['pend_tingkat']) ? implode("\n", $pegawai['pend_tingkat']) : null,
            'catatan_mutasi_pegawai' => $pegawai['catatan_mutasi_pegawai'],
        ];
    }

    /**
     * Format nilai tanggal lahir dari serial Excel maupun teks tanggal
     */
    protected function formatTanggalLahir(mixed $val): ?string
    {
        if (empty($val) || $val === '-' || trim((string) $val) === '') {
            return null;
        }

        // Jika angka serial Excel (misal 31190.0)
        if (is_numeric($val)) {
            $num = (float) $val;
            if ($num > 10000 && $num < 90000) {
                try {
                    return ExcelDate::excelToDateTimeObject($num)->format('d-m-Y');
                } catch (\Throwable) {
                    $timestamp = ($num - 25569) * 86400;

                    return gmdate('d-m-Y', (int) $timestamp);
                }
            }
        }

        $clean = trim((string) $val);
        $bulanMap = [
            'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
            'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
            'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
            'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December',
        ];
        $cleanTranslated = strtr($clean, $bulanMap);

        try {
            return Carbon::parse($cleanTranslated)->format('d-m-Y');
        } catch (\Throwable) {
            return $clean;
        }
    }

    /**
     * Pastikan TTL memiliki tanggal lahir. Jika belum, ekstrak dari NIP (YYYYMMDD)
     */
    protected function ensureTtlHasDate(?string $ttl, string $nip): ?string
    {
        $ttlClean = trim((string) $ttl);
        if ($ttlClean === '' || $ttlClean === '-') {
            $ttlClean = 'Jambi';
        }

        // Cek apakah sudah mengandung angka 4 digit (tahun)
        if (preg_match('/\d{4}/', $ttlClean)) {
            return $ttlClean;
        }

        // Jika belum ada tanggal, ekstrak dari 8 digit awal NIP (YYYYMMDD)
        $nipClean = preg_replace('/[^\d]/', '', $nip);
        if (strlen($nipClean) >= 8) {
            $tahun = substr($nipClean, 0, 4);
            $bulan = substr($nipClean, 4, 2);
            $tanggal = substr($nipClean, 6, 2);

            if (checkdate((int) $bulan, (int) $tanggal, (int) $tahun)) {
                $tglLahir = sprintf('%02d-%02d-%04d', (int) $tanggal, (int) $bulan, (int) $tahun);

                return rtrim($ttlClean, ', ').', '.$tglLahir;
            }
        }

        return $ttlClean;
    }

    /**
     * Konversi nilai tanggal Excel atau teks tanggal
     */
    protected function parseExcelDate(mixed $value): ?string
    {
        if (empty($value) || $value === '-' || $value === '.' || trim((string) $value) === '') {
            return null;
        }

        // Jika angka numerik serial Excel date
        if (is_numeric($value)) {
            $num = (float) $value;
            if ($num > 10000 && $num < 90000) {
                try {
                    return ExcelDate::excelToDateTimeObject($num)->format('Y-m-d');
                } catch (\Throwable) {
                    $timestamp = ($num - 25569) * 86400;

                    return gmdate('Y-m-d', (int) $timestamp);
                }
            }
        }

        $clean = trim((string) $value);
        $bulanMap = [
            'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
            'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
            'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
            'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December',
        ];
        $clean = strtr($clean, $bulanMap);

        try {
            return Carbon::parse($clean)->format('Y-m-d');
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Bersihkan string umum
     */
    protected function cleanString(mixed $val): ?string
    {
        if ($val === null) {
            return null;
        }

        $str = trim((string) $val);

        return ($str === '' || $str === '-' || $str === '- - -') ? null : $str;
    }

    /**
     * Bersihkan tahun (contoh 1999.0 -> 1999)
     */
    protected function cleanYear(mixed $val): ?string
    {
        if ($val === null) {
            return null;
        }

        $str = trim((string) $val);
        $str = preg_replace('/\.0+$/', '', $str);

        return ($str === '' || $str === '-') ? null : $str;
    }

    /**
     * Dapatkan jumlah data pegawai yang berhasil diimpor
     */
    public function getImportedCount(): int
    {
        return $this->importedCount;
    }
}
