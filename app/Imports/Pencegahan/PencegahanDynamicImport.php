<?php

namespace App\Imports\Pencegahan;

use App\Models\FireDrill;
use App\Models\InspeksiBangunan;
use App\Models\KunjunganSekolah;
use App\Models\PelatihanKeluarga;
use App\Models\PerjanjianKerjasama;
use App\Models\PermohonanEdukasi;
use App\Models\PermohonanRpkbgl;
use App\Models\PermohonanSkk;
use App\Models\RedkarRegistration;
use App\Models\SosialisasiEdukasi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class PencegahanDynamicImport implements SkipsEmptyRows, ToCollection, WithCalculatedFormulas, WithChunkReading, WithHeadingRow
{
    public const TABEL_DIKLAT = [
        'diksar' => 'tbl_diksar',
        'diklat-f1' => 'tbl_diklat_f1',
        'diklat-f2' => 'tbl_diklat_f2',
        'diklat-rescue' => 'tbl_diklat_rescue',
        'diklat-mfr' => 'tbl_diklat_mfr',
        'diklat-operator' => 'tbl_diklat_operator',
        'diklat-inspektur' => 'tbl_diklat_inspektur',
        'diklat-ppl' => 'tbl_diklat_ppl',
    ];

    public int $insertedCount = 0;

    public int $skippedCount = 0;

    public function __construct(public string $modul) {}

    public function chunkSize(): int
    {
        return 250;
    }

    public function collection(Collection $rows): void
    {
        if ($rows->isEmpty()) {
            return;
        }

        DB::transaction(function () use ($rows): void {
            foreach ($rows as $row) {
                $data = $this->normalizeRow($row->toArray());
                if ($this->isCompletelyEmpty($data)) {
                    continue;
                }

                $saved = match (true) {
                    isset(self::TABEL_DIKLAT[$this->modul]) => $this->importDiklat(self::TABEL_DIKLAT[$this->modul], $data),
                    $this->modul === 'inspeksi-bangunan' => $this->importInspeksiBangunan($data),
                    $this->modul === 'fire-drill' => $this->importFireDrill($data),
                    $this->modul === 'pks' => $this->importPks($data),
                    $this->modul === 'sosialisasi' => $this->importSosialisasi($data),
                    $this->modul === 'kunjungan-sekolah' => $this->importKunjunganSekolah($data),
                    $this->modul === 'pelatihan-keluarga' => $this->importPelatihanKeluarga($data),
                    $this->modul === 'edukasi' => $this->importEdukasi($data),
                    $this->modul === 'redkar' => $this->importRedkar($data),
                    $this->modul === 'rpkbgl' => $this->importRpkbgl($data),
                    $this->modul === 'skk' => $this->importSkk($data),
                    default => false,
                };

                if ($saved) {
                    $this->insertedCount++;
                } else {
                    $this->skippedCount++;
                }
            }
        });
    }

    private function importDiklat(string $table, array $row): bool
    {
        $nama = $this->pick($row, ['nama', 'nama_peserta', 'nama_lengkap']);
        if ($nama === null) {
            return false;
        }

        $record = [
            'nama' => $nama,
            'nip' => $this->pick($row, ['nip', 'nip_nrp']),
            'tempat_lahir' => $this->pick($row, ['tempat_lahir']),
            'tgl_lahir' => $this->parseDate($this->pick($row, ['tgl_lahir', 'tanggal_lahir'])),
            'pangkat_golongan' => $this->pick($row, ['pangkat_golongan', 'pangkat_golongan_ruang', 'pangkat']),
            'jabatan' => $this->pick($row, ['jabatan']),
            'kualifikasi' => $this->pick($row, ['kualifikasi']),
            'tempat_pelaksanaan' => $this->pick($row, ['tempat_pelaksanaan', 'lokasi', 'tempat']),
            'tanggal_pelaksanaan' => $this->parseDate($this->pick($row, ['tanggal_pelaksanaan', 'tgl_pelaksanaan', 'tanggal_mulai'])),
            'tanggal_selesai_pelaksanaan' => $this->parseDate($this->pick($row, ['tanggal_selesai_pelaksanaan', 'tanggal_selesai', 'tgl_selesai'])),
            'jumlah_jam_pelajaran' => $this->pick($row, ['jumlah_jam_pelajaran', 'jp', 'jam_pelajaran']),
            'no_sttp' => $this->pick($row, ['no_sttp', 'nomor_sttp', 'no_sertifikat']),
            'tanggal_sttp' => $this->parseDate($this->pick($row, ['tanggal_sttp', 'tgl_sttp'])),
            'pejabat_penandatangan' => $this->pick($row, ['pejabat_penandatangan', 'pejabat_yang_menandatangani', 'pejabat']),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table($table)->insert($record);

        return true;
    }

    private function importInspeksiBangunan(array $row): bool
    {
        $namaTempat = $this->pick($row, ['nama_bangunan', 'nama_tempat', 'nama_gedung']);
        if ($namaTempat === null) {
            return false;
        }

        $luas = $this->pick($row, ['luas_bangunan', 'luas']) ?? '-';
        if ($luas !== '-' && ! preg_match('/(m²|m2)$/iu', $luas)) {
            $luas = preg_replace('/\s*(m²|m2)$/iu', '', $luas).' m²';
        }

        $tglInspeksi = $this->parseDate($this->pick($row, ['tanggal_inspeksi', 'tanggal_pemeriksaan', 'tgl_inspeksi']));
        $tahun = $tglInspeksi ? (int) Carbon::parse($tglInspeksi)->format('Y') : (int) date('Y');

        $payload = [
            'nama_tempat' => $namaTempat,
            'jenis_usaha' => strtoupper($this->pick($row, ['jenis_bangunan', 'jenis_usaha']) ?? 'UMUM'),
            'kualifikasi_bangunan' => $this->normalizeLevel($this->pick($row, ['kualifikasi_bangunan', 'kualifikasi']), 'Rendah'),
            'resiko_kebakaran' => $this->normalizeLevel($this->pick($row, ['resiko_kebakaran', 'risiko_kebakaran', 'resiko']), 'Rendah'),
            'luas_bangunan' => $luas,
            'alamat' => $this->pick($row, ['alamat', 'lokasi']) ?? '-',
            'nama_penanggung_jawab' => $this->pick($row, ['nama_penanggung_jawab', 'penanggung_jawab']) ?? '-',
            'no_telepon' => $this->pick($row, ['no_telepon', 'no_telfon', 'telepon', 'no_hp']) ?? '-',
            'sistem_proteksi_kebakaran' => $this->normalizeProteksi($this->pick($row, ['sistem_proteksi_kebakaran', 'sistem_proteksi', 'status_proteksi'])),
            'tanggal_inspeksi' => $tglInspeksi ?? date('Y-m-d'),
        ];

        if (Schema::hasColumn('inspeksi_bangunans', 'tahun')) {
            $payload['tahun'] = $tahun;
        }

        InspeksiBangunan::create($payload);

        return true;
    }

    private function importFireDrill(array $row): bool
    {
        $instansi = $this->pick($row, ['nama_instansi', 'nama_perusahaan', 'instansi']);
        if ($instansi === null) {
            return false;
        }

        $tglRaw = $this->pick($row, ['tanggal_pelaksanaan', 'tanggal', 'tgl_pelaksanaan']) ?? date('Y-m-d');
        $tglParsed = $this->parseDate($tglRaw) ?? $tglRaw;
        $tahun = preg_match('/\b(19\d{2}|20\d{2})\b/', (string) $tglParsed, $m) ? (int) $m[1] : (int) date('Y');

        FireDrill::create([
            'nama_instansi' => $instansi,
            'tahun' => $tahun,
            'tanggal_pelaksanaan' => $tglParsed,
            'tempat_pelaksanaan' => $this->pick($row, ['tempat_pelaksanaan', 'tempat', 'lokasi']) ?? '-',
            'total_peserta' => $this->toInt($this->pick($row, ['total_peserta', 'jumlah_peserta', 'peserta'])),
            'nama_penanggung_jawab' => $this->pick($row, ['nama_penanggung_jawab', 'penanggung_jawab']) ?? '-',
            'no_telepon' => $this->pick($row, ['no_telepon', 'no_telfon', 'telepon']) ?? '-',
        ]);

        return true;
    }

    private function importPks(array $row): bool
    {
        $perusahaan = $this->pick($row, ['nama_perusahaan', 'perusahaan', 'nama_instansi']);
        $nomorPks = $this->pick($row, ['nomor_pks', 'no_pks']);
        if ($perusahaan === null || $nomorPks === null) {
            return false;
        }

        $tgl = $this->parseDate($this->pick($row, ['tanggal_perjanjian', 'tgl_perjanjian', 'tanggal']));
        $tahun = $tgl ? (int) date('Y', strtotime($tgl)) : (int) date('Y');

        PerjanjianKerjasama::create([
            'nama_perusahaan' => $perusahaan,
            'nomor_pks' => $nomorPks,
            'tanggal_perjanjian' => $tgl,
            'tahun' => $tahun,
            'lama_kerjasama' => $this->pick($row, ['lama_kerjasama', 'jangka_waktu']),
            'pihak_pertama' => $this->pick($row, ['pihak_pertama']),
            'pihak_kedua' => $this->pick($row, ['pihak_kedua']),
            'keterangan' => $this->pick($row, ['keterangan', 'catatan']),
        ]);

        return true;
    }

    private function importSosialisasi(array $row): bool
    {
        $instansi = $this->pick($row, ['nama_instansi', 'nama_instansi_lembaga', 'instansi']);
        if ($instansi === null) {
            return false;
        }

        $jenisRaw = strtolower((string) ($this->pick($row, ['jenis_kegiatan', 'jenis']) ?? 'luar'));
        $jenis = str_contains($jenisRaw, 'dalam') ? 'Dalam' : 'Luar';

        SosialisasiEdukasi::create([
            'jenis_kegiatan' => $jenis,
            'no_tanggal_surat_permohonan' => $this->pick($row, ['no_tanggal_surat_permohonan', 'no_surat_permohonan', 'surat_permohonan']),
            'nama_instansi' => $instansi,
            'tempat_pelaksanaan' => $this->pick($row, ['tempat_pelaksanaan', 'tempat']) ?? '-',
            'alamat' => $this->pick($row, ['alamat']) ?? '-',
            'tanggal_pelaksanaan' => $this->parseDate($this->pick($row, ['tanggal_pelaksanaan', 'tgl_pelaksanaan'])) ?? date('Y-m-d'),
            'jumlah_peserta' => $this->toInt($this->pick($row, ['jumlah_peserta', 'total_peserta', 'peserta'])),
            'nama_penanggung_jawab' => $this->pick($row, ['nama_penanggung_jawab', 'penanggung_jawab']) ?? '-',
            'no_telepon' => $this->pick($row, ['no_telepon', 'no_telfon', 'no_hp', 'telepon']) ?? '-',
        ]);

        return true;
    }

    private function importKunjunganSekolah(array $row): bool
    {
        $sekolah = $this->pick($row, ['nama_sekolah', 'sekolah', 'nama_instansi']);
        if ($sekolah === null) {
            return false;
        }

        $p = $this->toInt($this->pick($row, ['siswa_perempuan', 'perempuan']));
        $l = $this->toInt($this->pick($row, ['siswa_laki_laki', 'laki_laki']));
        $g = $this->toInt($this->pick($row, ['guru']));
        $o = $this->toInt($this->pick($row, ['orang_tua']));
        $total = $this->toInt($this->pick($row, ['total_kunjungan', 'total']));
        if ($total === 0) {
            $total = $p + $l + $g + $o;
        }

        $tglRaw = $this->pick($row, ['tanggal_kunjungan', 'tanggal']) ?? date('Y-m-d');
        $tgl = $this->parseDate($tglRaw) ?? $tglRaw;

        KunjunganSekolah::create([
            'nama_sekolah' => $sekolah,
            'tanggal_kunjungan' => $tgl,
            'siswa_perempuan' => $p,
            'siswa_laki_laki' => $l,
            'guru' => $g,
            'orang_tua' => $o,
            'total_kunjungan' => $total,
        ]);

        return true;
    }

    private function importPelatihanKeluarga(array $row): bool
    {
        $nama = $this->pick($row, ['nama_peserta', 'nama_lengkap', 'nama']);
        if ($nama === null) {
            return false;
        }

        $jkRaw = strtolower((string) ($this->pick($row, ['jenis_kelamin', 'jk']) ?? 'l'));
        $jk = (str_starts_with($jkRaw, 'p') || str_contains($jkRaw, 'perempuan')) ? 'Perempuan' : 'Laki-laki';

        PelatihanKeluarga::create([
            'nama_peserta' => $nama,
            'jenis_kelamin' => $jk,
            'kelurahan' => $this->pick($row, ['kelurahan']) ?? '-',
            'kecamatan' => $this->pick($row, ['kecamatan']) ?? '-',
            'tanggal_pelaksanaan' => $this->parseDate($this->pick($row, ['tanggal_pelaksanaan', 'tanggal'])) ?? date('Y-m-d'),
            'tempat_pelaksanaan' => $this->pick($row, ['tempat_pelaksanaan', 'tempat']) ?? '-',
            'alamat_pelaksanaan' => $this->pick($row, ['alamat_pelaksanaan', 'alamat']) ?? '-',
        ]);

        return true;
    }

    private function importEdukasi(array $row): bool
    {
        $institusi = $this->pick($row, ['institusi', 'nama_institusi', 'nama_instansi']);
        $namaPemohon = $this->pick($row, ['nama_pemohon', 'pemohon']);
        if ($institusi === null && $namaPemohon === null) {
            return false;
        }

        PermohonanEdukasi::create([
            'institusi' => $institusi ?? ($namaPemohon ?? '-'),
            'alamat_institusi' => $this->pick($row, ['alamat_institusi', 'alamat']) ?? '-',
            'kecamatan' => $this->pick($row, ['kecamatan']) ?? '-',
            'kelurahan' => $this->pick($row, ['kelurahan']) ?? '-',
            'nama_pemohon' => $namaPemohon ?? ($institusi ?? '-'),
            'jabatan_pemohon' => $this->pick($row, ['jabatan_pemohon', 'jabatan']) ?? '-',
            'nik' => preg_replace('/\D/', '', (string) ($this->pick($row, ['nik']) ?? '0000000000000000')),
            'no_kontak' => $this->pick($row, ['no_kontak', 'no_whatsapp', 'no_telepon', 'telepon']) ?? '-',
            'tgl_kegiatan' => $this->parseDate($this->pick($row, ['tgl_kegiatan', 'tanggal_kegiatan', 'tanggal'])) ?? date('Y-m-d'),
            'usia_3_6' => $this->toInt($this->pick($row, ['usia_3_6'])),
            'usia_7_12' => $this->toInt($this->pick($row, ['usia_7_12'])),
            'usia_13_18' => $this->toInt($this->pick($row, ['usia_13_18'])),
            'usia_18_keatas' => $this->toInt($this->pick($row, ['usia_18_keatas'])),
            'status_permohonan' => $this->normalizeStatus($this->pick($row, ['status_permohonan', 'status'])),
        ]);

        return true;
    }

    private function importRedkar(array $row): bool
    {
        $nama = $this->pick($row, ['nama_lengkap', 'nama']);
        $nik = preg_replace('/\D/', '', (string) ($this->pick($row, ['nik']) ?? ''));
        if ($nama === null || $nik === '') {
            return false;
        }

        if (RedkarRegistration::where('nik', $nik)->exists()) {
            return false;
        }

        $jkRaw = strtolower((string) ($this->pick($row, ['jenis_kelamin', 'jk']) ?? 'l'));
        $jk = (str_starts_with($jkRaw, 'p') || str_contains($jkRaw, 'perempuan')) ? 'Perempuan' : 'Laki-Laki';

        RedkarRegistration::create([
            'username' => 'redkar_'.$nik.'_'.Str::lower(Str::random(3)),
            'password' => Hash::make($nik),
            'nik' => $nik,
            'nama_lengkap' => $nama,
            'jenis_kelamin' => $jk,
            'tempat_lahir' => $this->pick($row, ['tempat_lahir']) ?? '-',
            'tanggal_lahir' => $this->parseDate($this->pick($row, ['tanggal_lahir', 'tgl_lahir'])) ?? '1990-01-01',
            'status_perkawinan' => $this->pick($row, ['status_perkawinan']) ?? 'Belum Kawin',
            'agama' => $this->pick($row, ['agama']) ?? 'Islam',
            'nomor_telp' => $this->pick($row, ['nomor_telp', 'no_telp', 'no_hp', 'telepon']) ?? '-',
            'tanggal_pembentukan' => $this->parseDate($this->pick($row, ['tanggal_pembentukan'])),
            'tanggal_pengukuhan' => $this->parseDate($this->pick($row, ['tanggal_pengukuhan'])),
            'alamat' => $this->pick($row, ['alamat']) ?? '-',
            'rt_rw' => $this->pick($row, ['rt_rw']) ?? '-',
            'kode_pos' => $this->pick($row, ['kode_pos']) ?? '-',
            'provinsi' => $this->pick($row, ['provinsi']) ?? 'Jambi',
            'kabupaten_kota' => $this->pick($row, ['kabupaten_kota', 'kota']) ?? 'Kota Jambi',
            'kecamatan' => $this->pick($row, ['kecamatan']) ?? '-',
            'kelurahan' => $this->pick($row, ['kelurahan']) ?? '-',
            'pendidikan_terakhir' => $this->pick($row, ['pendidikan_terakhir', 'pendidikan']) ?? 'SMA',
            'latar_belakang_pendidikan' => $this->pick($row, ['latar_belakang_pendidikan', 'jurusan']) ?? '-',
            'pekerjaan' => $this->pick($row, ['pekerjaan']) ?? '-',
            'sehat_jasmani' => $this->pick($row, ['sehat_jasmani']) ?? 'Sehat',
            'buta_warna' => $this->pick($row, ['buta_warna']) ?? 'Tidak',
            'golongan_darah' => $this->pick($row, ['golongan_darah']) ?? 'Tidak Tahu',
            'status_verifikasi' => $this->normalizeStatus($this->pick($row, ['status_verifikasi', 'status']), 'Terverifikasi'),
        ]);

        return true;
    }

    private function importRpkbgl(array $row): bool
    {
        $namaPemohon = $this->pick($row, ['nama_pemohon', 'pemohon']);
        $namaUsaha = $this->pick($row, ['nama_usaha', 'nama_bangunan', 'usaha']);
        if ($namaPemohon === null && $namaUsaha === null) {
            return false;
        }

        $liftRaw = strtolower((string) ($this->pick($row, ['ada_lift', 'lift']) ?? 'tidak'));
        $adaLift = in_array($liftRaw, ['1', 'ya', 'yes', 'ada', 'true'], true) ? 1 : 0;

        PermohonanRpkbgl::create([
            'nama_pemohon' => $namaPemohon ?? ($namaUsaha ?? '-'),
            'email_pemohon' => $this->pick($row, ['email_pemohon', 'email']) ?? 'admin@damkarjambi.go.id',
            'no_whatsapp' => $this->pick($row, ['no_whatsapp', 'no_telepon', 'no_hp']) ?? '-',
            'nama_usaha' => $namaUsaha ?? ($namaPemohon ?? '-'),
            'nik_pemilik_usaha' => preg_replace('/\D/', '', (string) ($this->pick($row, ['nik_pemilik_usaha', 'nik']) ?? '0000000000000000')),
            'alamat_pemilik_usaha' => $this->pick($row, ['alamat_pemilik_usaha', 'alamat_pemilik']) ?? '-',
            'kategori_bangunan' => $this->pick($row, ['kategori_bangunan', 'kategori']) ?? 'Komersial',
            'alamat_bangunan' => $this->pick($row, ['alamat_bangunan', 'alamat']) ?? '-',
            'kecamatan' => $this->pick($row, ['kecamatan']) ?? '-',
            'kelurahan' => $this->pick($row, ['kelurahan']) ?? '-',
            'luas_lahan' => $this->toFloat($this->pick($row, ['luas_lahan'])),
            'luas_bangunan' => $this->toFloat($this->pick($row, ['luas_bangunan'])),
            'tinggi_bangunan' => $this->toFloat($this->pick($row, ['tinggi_bangunan'])),
            'ada_lift' => $adaLift,
            'tgl_pemeriksaan' => $this->parseDate($this->pick($row, ['tgl_pemeriksaan', 'tanggal_pemeriksaan'])),
            'status_permohonan' => $this->normalizeStatus($this->pick($row, ['status_permohonan', 'status'])),
        ]);

        return true;
    }

    private function importSkk(array $row): bool
    {
        $namaPemohon = $this->pick($row, ['nama_pemohon', 'pemohon']);
        $namaUsaha = $this->pick($row, ['nama_usaha', 'nama_bangunan', 'usaha']);
        if ($namaPemohon === null && $namaUsaha === null) {
            return false;
        }

        PermohonanSkk::create([
            'nama_pemohon' => $namaPemohon ?? ($namaUsaha ?? '-'),
            'email_pemohon' => $this->pick($row, ['email_pemohon', 'email']) ?? 'admin@damkarjambi.go.id',
            'no_whatsapp' => $this->pick($row, ['no_whatsapp', 'no_telepon', 'no_hp']) ?? '-',
            'nama_usaha' => $namaUsaha ?? ($namaPemohon ?? '-'),
            'nik_pemilik_usaha' => preg_replace('/\D/', '', (string) ($this->pick($row, ['nik_pemilik_usaha', 'nik']) ?? '0000000000000000')),
            'alamat_pemilik_usaha' => $this->pick($row, ['alamat_pemilik_usaha', 'alamat_pemilik']) ?? '-',
            'kategori_bangunan' => $this->pick($row, ['kategori_bangunan', 'kategori']) ?? 'Komersial',
            'alamat_bangunan' => $this->pick($row, ['alamat_bangunan', 'alamat']) ?? '-',
            'kecamatan' => $this->pick($row, ['kecamatan']) ?? '-',
            'kelurahan' => $this->pick($row, ['kelurahan']) ?? '-',
            'luas_lahan' => $this->toFloat($this->pick($row, ['luas_lahan'])),
            'luas_bangunan' => $this->toFloat($this->pick($row, ['luas_bangunan'])),
            'tinggi_bangunan' => $this->toFloat($this->pick($row, ['tinggi_bangunan'])),
            'status_permohonan' => $this->normalizeStatus($this->pick($row, ['status_permohonan', 'status'])),
        ]);

        return true;
    }

    private function normalizeRow(array $row): array
    {
        $normalized = [];
        foreach ($row as $k => $v) {
            $key = Str::slug(str_replace(['/', '-'], '_', (string) $k), '_');
            $normalized[$key] = is_string($v) ? trim($v) : $v;
        }

        return $normalized;
    }

    private function isCompletelyEmpty(array $row): bool
    {
        foreach ($row as $v) {
            if ($v !== null && trim((string) $v) !== '' && trim((string) $v) !== '-') {
                return false;
            }
        }

        return true;
    }

    private function pick(array $row, array $keys): ?string
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row)) {
                $val = trim((string) ($row[$key] ?? ''));
                if ($val !== '' && $val !== '-') {
                    return $val;
                }
            }
        }

        return null;
    }

    private function toInt(?string $val): int
    {
        if ($val === null) {
            return 0;
        }

        return max(0, (int) preg_replace('/[^\d-]/', '', $val));
    }

    private function toFloat(?string $val): float
    {
        if ($val === null) {
            return 0.0;
        }

        $clean = str_replace(',', '.', preg_replace('/[^0-9.,]/', '', $val));

        return (float) $clean;
    }

    private function normalizeLevel(?string $val, string $default = 'Rendah'): string
    {
        if ($val === null) {
            return $default;
        }

        return match (strtolower(trim($val))) {
            'tinggi' => 'Tinggi',
            'sedang' => 'Sedang',
            'rendah' => 'Rendah',
            default => $default,
        };
    }

    private function normalizeProteksi(?string $val): string
    {
        if ($val === null) {
            return 'Memenuhi Syarat';
        }

        $low = strtolower(trim($val));
        if (str_contains($low, 'tidak')) {
            return 'Tidak Memenuhi Syarat';
        }
        if (str_contains($low, 'catatan')) {
            return 'Memenuhi Syarat dengan Catatan';
        }

        return 'Memenuhi Syarat';
    }

    private function normalizeStatus(?string $val, string $default = 'Pending'): string
    {
        if ($val === null) {
            return $default;
        }

        $low = strtolower(trim($val));
        if (str_contains($low, 'terverifikasi') || str_contains($low, 'verif')) {
            return 'Terverifikasi';
        }
        if (str_contains($low, 'setuju') || str_contains($low, 'approve') || str_contains($low, 'selesai')) {
            return 'Disetujui';
        }
        if (str_contains($low, 'tolak') || str_contains($low, 'reject')) {
            return 'Ditolak';
        }

        return $default;
    }

    private function parseDate(?string $raw): ?string
    {
        if ($raw === null) {
            return null;
        }

        $text = trim($raw);
        if ($text === '' || $text === '-') {
            return null;
        }

        if (is_numeric($text) && (float) $text > 1000) {
            try {
                return Carbon::instance(ExcelDate::excelToDateTimeObject((float) $text))->format('Y-m-d');
            } catch (\Throwable) {
                return null;
            }
        }

        $indoMonths = [
            'januari' => 'January', 'februari' => 'February', 'maret' => 'March',
            'april' => 'April', 'mei' => 'May', 'juni' => 'June',
            'juli' => 'July', 'agustus' => 'August', 'september' => 'September',
            'oktober' => 'October', 'november' => 'November', 'desember' => 'December',
            'nopember' => 'November', 'agu' => 'Aug', 'okt' => 'Oct', 'des' => 'Dec',
        ];
        $normalized = str_ireplace(array_keys($indoMonths), array_values($indoMonths), $text);

        try {
            return Carbon::parse($normalized)->format('Y-m-d');
        } catch (\Throwable) {
            return null;
        }
    }
}
