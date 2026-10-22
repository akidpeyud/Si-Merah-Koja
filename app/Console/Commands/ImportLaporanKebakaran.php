<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

/**
 * Impor Laporan Kebakaran (Excel 2022-2025) ke tabel damtan:
 *   laporan_penyelamatans, lp_teknis_logistiks, lp_dokumentasis
 *
 * Hanya kolom yang ada di form web yang diisi. Kolom Excel Jumlah Kerugian,
 * Tingkat Kepuasan, dan Nama Korban tidak diimpor (tidak ada di format web).
 *
 * Simpan di: app/Console/Commands/ImportLaporanKebakaran.php
 *
 * Contoh:
 *   php artisan damtan:import-kebakaran storage/app/import --user=1 --dry-run
 *   php artisan damtan:import-kebakaran storage/app/import --user=1
 */
class ImportLaporanKebakaran extends Command
{
    protected $signature = 'damtan:import-kebakaran
                            {sumber* : Folder berisi file .xlsx, atau path file .xlsx (boleh lebih dari satu)}
                            {--user= : ID user pemilik data hasil import (wajib)}
                            {--dry-run : Simulasi saja, tidak menyimpan apa pun ke database}';

    protected $description = 'Impor Laporan Kebakaran dari file Excel ke database damtan';

    private const BULAN = [
        'januari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4, 'mei' => 5, 'juni' => 6,
        'juli' => 7, 'agustus' => 8, 'september' => 9, 'oktober' => 10, 'november' => 11, 'desember' => 12,
    ];

    // Urutan penting: pola yang lebih spesifik dicek lebih dulu.
    private const OBJEK = [
        'tempat_sampah'      => '/sampah|\btpa\b|\btps\b/i',
        'rumah_ibadah'       => '/masjid|mushola|musholla|surau|gereja|vihara|klenteng|\bpura\b|ibadah/i',
        'sarana_kesehatan'   => '/rumah sakit|\brs\b|\brsud\b|puskesmas|klinik|posyandu/i',
        'sekolah'            => '/sekolah|\b(sd|sdn|smp|smpn|sma|sman|smk|smkn|mts|man|paud|tk)\b|madrasah|kampus|universitas|\buin\b|pesantren|ponpes/i',
        'gudang'             => '/gudang/i',
        'ruko'               => '/\bruko\b|kios|toko|warung/i',
        'pasar_tempat_usaha' => '/pasar|bengkel|restoran|rumah makan|kedai|cafe|kafe|salon|pabrik|mini ?market|alfamart|indomaret|hotel|dealer|spbu|pom bensin|studio|\bmall\b/i',
        'kantor'             => '/kantor|\bdinas\b|\bbalai\b/i',
        'rumah'              => '/rumah|bedeng|\bkost\b|\bkos\b|asrama|kontrakan|\bmess\b|\bmes\b/i',
        'kendaraan_bermotor' => '/motor|mobil|kendaraan|truk|truck|\bbus\b|angkot|pick ?up|ambulans/i',
        'gardu_listrik'      => '/gardu|trafo|kabel|tiang|listrik|amper|meteran|\bkwh\b/i',
        'lahan_pohon'        => '/lahan|pohon|semak|kebun|rumput|hutan|gambut|belukar|ilalang/i',
    ];

    private array $kolomCache = [];
    private array $kolomDilewati = [];
    private array $urutNomor = [];
    private array $catatan = [];

    public function handle(): int
    {
        $userId = $this->option('user');
        if (!$userId || !DB::table('users')->where('id', $userId)->exists()) {
            $this->error('Isi --user dengan ID user yang valid, contoh: --user=1');
            return self::FAILURE;
        }

        $dry = (bool) $this->option('dry-run');
        $files = $this->kumpulkanFile($this->argument('sumber'));
        if (empty($files)) {
            $this->error('Tidak ada file .xlsx yang ditemukan.');
            return self::FAILURE;
        }

        $this->info($dry ? 'MODE SIMULASI: tidak ada yang disimpan.' : 'Mengimpor ke database...');

        $ringkas = [];
        foreach ($files as $file) {
            $ringkas[] = $this->importFile($file, (int) $userId, $dry);
        }

        $this->table(['File', 'Tahun', 'Kejadian', 'Masuk', 'Sudah ada', 'Dilewati'], $ringkas);

        if (!empty($this->kolomDilewati)) {
            $this->warn('Kolom ini tidak ada di tabel, jadi datanya tidak tersimpan:');
            foreach ($this->kolomDilewati as $tabel => $kolom) {
                $this->line('  ' . $tabel . ': ' . implode(', ', array_keys($kolom)));
            }
        }

        $laporan = storage_path('app/import_kebakaran_catatan.csv');
        $fh = fopen($laporan, 'w');
        fputcsv($fh, ['file', 'no', 'catatan']);
        foreach ($this->catatan as $c) {
            fputcsv($fh, $c);
        }
        fclose($fh);
        $this->info(count($this->catatan) . ' catatan untuk dicek manual: ' . $laporan);

        return self::SUCCESS;
    }

    // ------------------------------------------------------------------
    // Proses satu file
    // ------------------------------------------------------------------
    private function importFile(string $path, int $userId, bool $dry): array
    {
        $nama = basename($path);
        $sheet = IOFactory::load($path)->getActiveSheet();
        $rows = $sheet->toArray(null, true, false, false);

        // Sel yang di-merge: nilainya hanya ada di sel kiri-atas, salin ke seluruh rentang
        foreach ($sheet->getMergeCells() as $range) {
            [[$c1, $r1], [$c2, $r2]] = Coordinate::rangeBoundaries($range);
            $nilai = $rows[$r1 - 1][$c1 - 1] ?? null;
            for ($r = $r1; $r <= $r2; $r++) {
                for ($c = $c1; $c <= $c2; $c++) {
                    $rows[$r - 1][$c - 1] = $nilai;
                }
            }
        }

        // Tahun laporan dari judul ("TAHUN 2022", "JANUARI - DESEMBER 2025") atau nama file
        $tahun = null;
        foreach (array_slice($rows, 0, 5) as $r) {
            if (!empty($r[0]) && preg_match('/(20\d{2})/', (string) $r[0], $m)) {
                $tahun = (int) $m[1];
                break;
            }
        }
        $tahun = $tahun ?: (preg_match('/(20\d{2})/', $nama, $m) ? (int) $m[1] : null);
        if (!$tahun) {
            $this->catat($nama, '-', 'Tahun laporan tidak terbaca, file dilewati.');
            return [$nama, '?', 0, 0, 0, 0];
        }

        // Baris judul kolom (kolom pertama = "No")
        $hdr = null;
        foreach ($rows as $i => $r) {
            if (Str::lower(trim((string) ($r[0] ?? ''))) === 'no') {
                $hdr = $i;
                break;
            }
        }
        if ($hdr === null) {
            $this->catat($nama, '-', 'Baris judul kolom tidak ditemukan, file dilewati.');
            return [$nama, $tahun, 0, 0, 0, 0];
        }

        // Peta judul kolom -> indeks (kemunculan pertama dipakai; "NO" kedua = no. korban, diabaikan)
        $h = [];
        foreach ($rows[$hdr] as $i => $v) {
            $k = Str::lower(trim((string) $v));
            if ($k !== '' && !isset($h[$k])) {
                $h[$k] = $i;
            }
        }
        $cari = function (array $awalan) use ($h) {
            foreach ($h as $k => $i) {
                foreach ($awalan as $a) {
                    if (str_starts_with($k, $a)) {
                        return $i;
                    }
                }
            }
            return null;
        };
        $C = [
            'no'     => $h['no'] ?? 0,
            'tgl'    => $cari(['tanggal']),
            'jam'    => $cari(['jam']),
            'jenis'  => $cari(['jenis']),
            'sebab'  => $cari(['penyebab']),
            'lok'    => $cari(['lokasi']),
            'pel'    => $cari(['nama pemilik', 'nama pelapor']),
            'arm'    => $cari(['armada']),
            'air'    => $cari(['jumlah air']),
            'resp'   => $cari(['respon']),
            'ket'    => $cari(['ket']),
        ];
        if ($C['tgl'] === null || $C['jam'] === null || $C['lok'] === null) {
            $this->catat($nama, '-', 'Kolom Tanggal/Jam/Lokasi tidak ditemukan, file dilewati.');
            return [$nama, $tahun, 0, 0, 0, 0];
        }

        // Kelompokkan baris per nomor kejadian (satu kejadian bisa punya banyak baris korban)
        $kejadian = [];
        for ($i = $hdr + 1; $i < count($rows); $i++) {
            $no = $rows[$i][$C['no']] ?? null;
            if (!is_numeric($no)) {
                continue;
            }
            $kejadian[(int) $no][] = $rows[$i];
        }

        $masuk = $ada = $lewat = 0;

        foreach ($kejadian as $no => $baris) {
            $r = $baris[0];
            $g = fn ($k) => $C[$k] !== null ? ($r[$C[$k]] ?? null) : null;

            // ---- Tanggal (tahun dipaksa mengikuti tahun laporan) ----
            $tglMentah = $g('tgl');
            $tgl = $this->parseTanggal($tglMentah, $tahun);
            if (!$tgl) {
                $this->catat($nama, $no, 'Tanggal tidak terbaca (' . json_encode($tglMentah) . '), kejadian dilewati.');
                $lewat++;
                continue;
            }
            if (preg_match('/(\d{4})\s*$/', trim((string) $tglMentah, " \t\"'"), $my) && (int) $my[1] !== $tahun) {
                $this->catat($nama, $no, "Tahun di tanggal ({$my[1]}) dikoreksi menjadi {$tahun}.");
            }

            // ---- Jam, respon time ----
            $jam = $this->parseJam($g('jam'));
            $respon = $this->parseRespon($C['resp'] !== null ? $g('resp') : null);
            $terima = $jam ? $tgl->copy()->setTime($jam[0], $jam[1]) : null;
            $tiba = ($terima && $respon !== null) ? $terima->copy()->addMinutes($respon) : null;
            if (!$jam) {
                $this->catat($nama, $no, 'Jam tidak terbaca (' . json_encode($g('jam')) . '), waktu_terima dikosongkan.');
            } elseif ($respon === null) {
                $this->catat($nama, $no, 'Respon time kosong, waktu_tiba dikosongkan.');
            }

            // ---- Pelapor (2025: nama + nomor HP dalam kurung) ----
            $pelapor = $this->bersih($g('pel'));
            $telepon = null;
            if ($pelapor && preg_match('/((?:\+?62|0)\d{8,13})/', $pelapor, $m)) {
                $telepon = $m[1];
                $pelapor = $this->bersih(trim(preg_replace('/\(?\s*' . preg_quote($m[1], '/') . '\s*\)?/', '', $pelapor), " -/,;"));
            }

            // ---- Objek & penyebab ----
            $jenisAsli = $this->bersih($g('jenis'));
            $kategori = $jenisAsli ? $this->petaObjek($jenisAsli) : null;
            if ($jenisAsli && $kategori === null) {
                $kategori = $jenisAsli; // belum cocok dengan dropdown: simpan teks aslinya
                $this->catat($nama, $no, "Objek \"{$jenisAsli}\" belum cocok dengan daftar objek, disimpan sebagai teks asli.");
            }

            $sebabAsli = $this->bersih($g('sebab'));
            [$sebab, $sebabLain] = $this->petaPenyebab($sebabAsli);

            // ---- Air ----
            [$liter, $konsumsi, $airCatatan] = $this->parseAir($g('air'));
            if ($airCatatan) {
                $this->catat($nama, $no, $airCatatan);
            }

            $alamat = $this->bersih($g('lok'));
            $armada = $this->bersih($g('arm'));
            $satgas = $this->bersih($g('ket'));

            // ---- Hindari ganda jika command dijalankan dua kali ----
            $terimaStr = $terima ? $terima->format('Y-m-d H:i:s') : null;
            $sudah = DB::table('laporan_penyelamatans')
                ->where('kategori_kejadian', 'kebakaran')
                ->where('tanggal_kejadian', $tgl->toDateString())
                ->where('alamat', $alamat)
                ->when($terimaStr, fn ($q) => $q->where('waktu_terima', $terimaStr))
                ->exists();
            if ($sudah) {
                $ada++;
                continue;
            }

            if ($dry) {
                $masuk++;
                continue;
            }

            DB::beginTransaction();
            try {
                $now = now();
                $id = DB::table('laporan_penyelamatans')->insertGetId($this->saring('laporan_penyelamatans', [
                    'user_id'       => $userId,
                    'nomor_laporan' => $this->nomorLaporan($tgl),
                    'id_laporan'    => (string) Str::uuid(),

                    'tanggal_kejadian' => $tgl->toDateString(),
                    'hari_kejadian'    => $tgl->copy()->locale('id')->translatedFormat('l'),
                    'bulan_kejadian'   => $tgl->copy()->locale('id')->translatedFormat('F'),
                    'tahun_kejadian'   => $tgl->year,

                    'nama_pelapor'    => $pelapor,
                    'telepon_pelapor' => $telepon,

                    'kategori_kejadian'          => 'kebakaran',
                    'kategori_kebakaran'         => $kategori,
                    'keterangan_objek_kebakaran' => $jenisAsli,
                    'prioritas'                  => 'rendah',

                    'waktu_kejadian' => $terimaStr,
                    'waktu_terima'   => $terimaStr,
                    'waktu_tiba'     => $tiba ? $tiba->format('Y-m-d H:i:s') : null,
                    'alamat'         => $alamat,

                    'created_at' => $now,
                    'updated_at' => $now,
                ]));

                DB::table('lp_teknis_logistiks')->insert($this->saring('lp_teknis_logistiks', [
                    'laporan_id'     => $id,
                    'satuan_tugas'   => $satgas,
                    'armada'         => $armada ? json_encode([$armada]) : null,
                    'liter_air'      => $liter,
                    'konsumsi_alat'  => $konsumsi,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]));

                DB::table('lp_dokumentasis')->insert($this->saring('lp_dokumentasis', [
                    'laporan_id'              => $id,
                    'dugaan_penyebab'         => $sebab,
                    'dugaan_penyebab_lainnya' => $sebabLain,
                    'created_at'              => $now,
                    'updated_at'              => $now,
                ]));

                DB::commit();
                $masuk++;
            } catch (\Throwable $e) {
                DB::rollBack();
                $this->catat($nama, $no, 'GAGAL disimpan: ' . $e->getMessage());
                $lewat++;
            }
        }

        return [$nama, $tahun, count($kejadian), $masuk, $ada, $lewat];
    }

    // ------------------------------------------------------------------
    // Parser
    // ------------------------------------------------------------------
    private function parseTanggal($v, int $tahun): ?Carbon
    {
        if ($v === null || $v === '') {
            return null;
        }

        // Tanggal tersimpan sebagai angka serial Excel
        if (is_numeric($v) && !is_string($v) && $v > 20000) {
            $d = Carbon::instance(ExcelDate::excelToDateTimeObject($v));
            return checkdate($d->month, $d->day, $tahun) ? Carbon::create($tahun, $d->month, $d->day, 0, 0, 0) : null;
        }

        // Buang karakter di depan (apostrof, koma), mis. "'06 Juni 2026" atau ",04 Maret 2023"
        $s = preg_replace('/^[^\d]+/', '', trim((string) $v));
        if (!preg_match('/^(\d{1,2})\s+([A-Za-z]+)/', $s, $m)) {
            return null;
        }
        $bulan = self::BULAN[Str::lower($m[2])] ?? null;
        $hari = (int) $m[1];
        if (!$bulan || !checkdate($bulan, $hari, $tahun)) {
            return null;
        }

        return Carbon::create($tahun, $bulan, $hari, 0, 0, 0);
    }

    private function parseJam($v): ?array
    {
        if ($v === null || $v === '') {
            return null;
        }
        // Sel berformat waktu: pecahan hari (0.5 = 12:00)
        if (!is_string($v) && is_numeric($v) && $v >= 0 && $v < 1) {
            $menit = ((int) round($v * 1440)) % 1440;
            return [intdiv($menit, 60), $menit % 60];
        }
        $s = trim((string) $v, " \t\"'");
        if (preg_match('/^(\d{1,2})[.,:](\d{2})$/', $s, $m) || preg_match('/^(\d{2})(\d{2})$/', $s, $m)) {
            $jam = (int) $m[1];
            $mnt = (int) $m[2];
            if ($jam < 24 && $mnt < 60) {
                return [$jam, $mnt];
            }
        }
        return null;
    }

    private function parseRespon($v): ?int
    {
        $s = $this->bersih($v);
        if ($s === null || !preg_match('/\d+/', $s, $m)) {
            return null;
        }
        return (int) $m[0];
    }

    /** @return array [liter_air, konsumsi_alat, catatan|null] */
    private function parseAir($v): array
    {
        $s = $this->bersih($v);
        if ($s === null) {
            return [0, null, null];
        }
        if (is_numeric($s)) {
            return [(int) round((float) $s), null, "Jumlah air \"{$s}\" tanpa satuan, dianggap liter."];
        }

        $liter = 0;
        if (preg_match('/(\d[\d.,]*)\s*liter/i', $s, $m)) {
            $n = $m[1];
            // "48.000" / "3,000" = pemisah ribuan; selain itu desimal
            $n = preg_match('/^\d{1,3}([.,]\d{3})+$/', $n) ? preg_replace('/[.,]/', '', $n) : str_replace(',', '.', $n);
            $liter = (int) round((float) $n);
        }

        // Teks non-angka (APAR, mesin apung, dll.) disimpan di konsumsi_alat
        $teks = ($liter === 0 || stripos($s, 'apar') !== false) ? $s : null;

        return [$liter, $teks, null];
    }

    private function petaObjek(string $teks): ?string
    {
        foreach (self::OBJEK as $kunci => $pola) {
            if (preg_match($pola, $teks)) {
                return $kunci;
            }
        }
        return null;
    }

    /** @return array [dugaan_penyebab, dugaan_penyebab_lainnya] */
    private function petaPenyebab(?string $teks): array
    {
        if ($teks === null) {
            return [null, null];
        }
        $s = Str::lower($teks);

        if (preg_match('/konsleting|korslet|korsleting|listrik|arus pendek|kabel|kipas|colokan|\bac\b|magic ?com|setrika|charger|stop ?kontak|steker/', $s)) {
            return ['arus_pendek', null];
        }
        if (str_contains($s, 'petir')) {
            return ['sambaran_petir', null];
        }
        if (str_contains($s, 'gas')) {
            return ['kebocoran_gas', null];
        }
        if (!str_contains($s, 'pencuri')
            && preg_match('/sampah|puntung|rokok|obat nyamuk|korek|lilin|lalai|kelalaian|bakar|membakar|pembakaran/', $s)) {
            return ['kelalaian_manusia', null];
        }
        if (preg_match('/faktor alam|cuaca|kemarau/', $s)) {
            return ['faktor_alam', null];
        }

        return ['lainnya', $teks];
    }

    // ------------------------------------------------------------------
    // Helper
    // ------------------------------------------------------------------
    private function bersih($v): ?string
    {
        if ($v === null) {
            return null;
        }
        $s = trim(preg_replace('/\s+/u', ' ', (string) $v), " \t\"'");
        return ($s === '' || $s === '-' || $s === '.') ? null : $s;
    }

    /** Format sama dengan DamtanController::buatNomorLaporan (REG-YYYYMMDD-0001). */
    private function nomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-' . $tanggal->format('Ymd') . '-';

        if (!isset($this->urutNomor[$prefix])) {
            $akhir = DB::table('laporan_penyelamatans')
                ->where('nomor_laporan', 'like', $prefix . '%')
                ->orderByDesc('nomor_laporan')
                ->value('nomor_laporan');
            $this->urutNomor[$prefix] = $akhir ? (int) substr($akhir, -4) : 0;
        }

        return $prefix . str_pad(++$this->urutNomor[$prefix], 4, '0', STR_PAD_LEFT);
    }

    private function kolom(string $tabel): array
    {
        return $this->kolomCache[$tabel] ??= Schema::getColumnListing($tabel);
    }

    /** Hanya kolom yang benar-benar ada di tabel; kolom lain dicatat agar kelihatan. */
    private function saring(string $tabel, array $data): array
    {
        $ada = $this->kolom($tabel);
        foreach ($data as $k => $v) {
            if (!in_array($k, $ada, true)) {
                // kolom opsional yang memang belum ditambahkan tidak perlu dilaporkan jika nilainya kosong
                if ($v !== null && $v !== '') {
                    $this->kolomDilewati[$tabel][$k] = true;
                }
                unset($data[$k]);
            }
        }
        return $data;
    }

    private function catat(string $file, $no, string $pesan): void
    {
        $this->catatan[] = [$file, $no, $pesan];
    }

    private function kumpulkanFile(array $sumber): array
    {
        $hasil = [];
        foreach ($sumber as $s) {
            if (is_dir($s)) {
                foreach (glob(rtrim($s, '/\\') . DIRECTORY_SEPARATOR . '*.xlsx') ?: [] as $f) {
                    if (!str_starts_with(basename($f), '~$')) {
                        $hasil[] = $f;
                    }
                }
            } elseif (is_file($s)) {
                $hasil[] = $s;
            } else {
                $this->warn("Tidak ditemukan: {$s}");
            }
        }
        sort($hasil);
        return $hasil;
    }
}
