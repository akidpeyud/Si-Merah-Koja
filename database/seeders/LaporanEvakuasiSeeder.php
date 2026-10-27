<?php

namespace Database\Seeders;

use App\Imports\LaporanEvakuasiImport;
use App\Models\LaporanPenyelamatan;
use App\Models\LpDokumentasi;
use App\Models\LpKategoriKhusus;
use App\Models\LpTeknisLogistik;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LaporanEvakuasiSeeder extends Seeder
{
    /**
     * Jalankan seeder data laporan evakuasi / penyelamatan non-kebakaran.
     */
    public function run(): void
    {
        $user = User::whereHas('roles', fn ($q) => $q->whereIn('name', ['Damtan', 'Super User']))->first() ?? User::first();
        $userId = $user ? $user->id : 1;

        // 1. Cek apakah ada file Excel di sistem
        $candidatePaths = [
            base_path('laporan evakuasi 2025.xlsx'),
            base_path('Laporan Evakuasi 2025.xlsx'),
            'C:\\Users\\ADVAN\\Downloads\\laporan evakuasi 2025.xlsx',
            storage_path('app/import/laporan evakuasi 2025.xlsx'),
            storage_path('app/laporan evakuasi 2025.xlsx'),
        ];

        $foundFile = null;
        foreach ($candidatePaths as $p) {
            if (File::exists($p)) {
                $foundFile = $p;
                break;
            }
        }

        // Jika file Excel ditemukan, impor langsung via Maatwebsite/Excel
        if ($foundFile) {
            $this->command->info("Mengimpor data evakuasi dari file Excel: {$foundFile}");

            $availableSheets = [];
            try {
                $reader = IOFactory::createReaderForFile($foundFile);
                $availableSheets = $reader->listWorksheetNames($foundFile);
            } catch (\Throwable) {
                $availableSheets = [];
            }

            $import = new LaporanEvakuasiImport(
                userId: $userId,
                targetSheet: null,
                allSheets: true,
                availableSheets: $availableSheets,
                dryRun: false
            );

            Excel::import($import, $foundFile);
            $this->command->info("Selesai mengimpor dari Excel! Berhasil disimpan: {$import->totalDisimpan}, Duplikat dilewati: {$import->totalDuplikat}.");

            return;
        }

        // 2. Fallback: Dataset mandiri 55 data evakuasi Januari 2025 (tanpa bergantung file Excel)
        $this->command->info('File Excel tidak ditemukan di path lokal, menjalankan seeder dari dataset 55 laporan evakuasi Januari 2025...');

        $dataset = $this->getDatasetJanuari2025();
        $insertedCount = 0;
        $skippedCount = 0;

        foreach ($dataset as $item) {
            $tglKejadian = $item['tgl'];
            $namaPelapor = $item['pelapor'];
            $rawAlamat = $item['lokasi'];
            $kec = $item['kec'];
            $rawJenis = $item['jenis'];
            $rawSatgas = $item['satgas'];
            $rawDurasi = $item['durasi'];
            $telepon = $item['hp'] !== '-' ? $item['hp'] : '-';

            $alamatLengkap = $rawAlamat;
            if (! empty($kec) && ! str_contains(strtolower($alamatLengkap), strtolower($kec))) {
                $alamatLengkap = rtrim($alamatLengkap, ', ').', Kec. '.$kec;
            }

            // Cek duplikasi
            $exists = LaporanPenyelamatan::where('tanggal_kejadian', $tglKejadian)
                ->where('nama_pelapor', $namaPelapor)
                ->exists();

            if ($exists) {
                $skippedCount++;

                continue;
            }

            $dt = Carbon::parse($tglKejadian)->locale('id');
            $hariKejadian = $dt->translatedFormat('l');
            $bulanKejadian = $dt->translatedFormat('F');
            $tahunKejadian = $dt->year;

            // Jam kejadian
            $waktuDefault = $tglKejadian.' '.$this->parseJamKejadian($item['jam']);

            // Parsing kategori
            $kategori = $this->klasifikasiJenisPelayanan($rawJenis);
            [$pimpinan, $satgas, $pendamping] = $this->parseSatgasTeks($rawSatgas);

            DB::transaction(function () use (
                $userId, $dt, $tglKejadian, $hariKejadian, $bulanKejadian, $tahunKejadian,
                $namaPelapor, $telepon, $alamatLengkap, $waktuDefault, $kategori,
                $pimpinan, $satgas, $pendamping, $rawDurasi, $rawSatgas, $rawJenis
            ) {
                $nomorLaporan = $this->buatNomorLaporan($dt);

                $laporan = LaporanPenyelamatan::create([
                    'nomor_laporan' => $nomorLaporan,
                    'id_laporan' => Str::uuid()->toString(),
                    'user_id' => $userId,
                    'tanggal_kejadian' => $tglKejadian,
                    'hari_kejadian' => $hariKejadian,
                    'bulan_kejadian' => $bulanKejadian,
                    'tahun_kejadian' => $tahunKejadian,

                    'nama_pelapor' => $namaPelapor,
                    'telepon_pelapor' => $telepon,
                    'media_pelaporan' => 'WhatsApp / Telepon',

                    'kategori_kejadian' => $kategori['kategori_kejadian'],
                    'kategori_non_kebakaran' => $kategori['kategori_non_kebakaran'],
                    'rincian_kategori_non_kebakaran' => $kategori['rincian_kategori_non_kebakaran'],
                    'prioritas' => 'rendah',

                    'waktu_kejadian' => $waktuDefault,
                    'waktu_terima' => $waktuDefault,
                    'waktu_berangkat' => $waktuDefault,
                    'waktu_tiba' => Carbon::parse($waktuDefault)->addMinutes(10)->format('Y-m-d H:i:s'),
                    'waktu_selesai' => Carbon::parse($waktuDefault)->addMinutes(30)->format('Y-m-d H:i:s'),
                    'waktu_kembali' => null,

                    'alamat' => $alamatLengkap,
                ]);

                LpTeknisLogistik::create([
                    'laporan_id' => $laporan->id,
                    'pimpinan_operasi' => $pimpinan,
                    'pendamping_operasi' => $pendamping,
                    'satuan_tugas' => $satgas,
                    'langkah_penanganan' => ! empty($rawDurasi) ? "Lamanya penanganan: {$rawDurasi}" : null,
                    'hasil_tindakan' => 'Selesai ditangani dengan aman.',
                    'status_evakuasi' => 'Selesai',
                    'objek_terdampak' => $rawJenis,
                ]);

                LpDokumentasi::create([
                    'laporan_id' => $laporan->id,
                    'kronologi_lengkap' => "Pelayanan evakuasi {$rawJenis} di {$alamatLengkap}. Petugas: {$rawSatgas}.".(! empty($rawDurasi) ? " Durasi: {$rawDurasi}." : ''),
                ]);

                LpKategoriKhusus::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hewan' => $kategori['jenis_hewan'],
                    'spesies_hewan' => $kategori['spesies_hewan'],
                    'jenis_benda_bahaya' => $kategori['jenis_benda_bahaya'],
                    'jenis_objek_tumbang' => $kategori['jenis_objek_tumbang'],
                ]);
            });

            $insertedCount++;
        }

        $this->command->info("Seeding selesai! Berhasil disimpan: {$insertedCount}, Duplikat dilewati: {$skippedCount}.");
    }

    protected function buatNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-'.$tanggal->format('Ymd').'-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix.'%')
            ->lockForUpdate()
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix.str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }

    protected function parseJamKejadian(string $jamRaw): string
    {
        if (preg_match('/(\d{1,2})[\s.:]+(\d{2})/i', $jamRaw, $m)) {
            $jam = (int) $m[1];
            $menit = (int) $m[2];
            if ($menit >= 60) {
                $jam += intdiv($menit, 60);
                $menit = $menit % 60;
            }
            if ($jam >= 24) {
                $jam = 23;
                $menit = 59;
            }

            return sprintf('%02d:%02d:00', $jam, $menit);
        }

        return '08:00:00';
    }

    protected function parseSatgasTeks(string $rawSatgas): array
    {
        $pimpinan = null;
        $satgas = null;
        $pendamping = null;

        if (preg_match('/Pimpinan\s*Operasi\s*:\s*([^.]+?)(?=(?:Satuan\s*Tugas|Regu\s*Evakuasi|Satuan\s*Regu|Pendamping|\.|$))/i', $rawSatgas, $mP)) {
            $pimpinan = trim(rtrim($mP[1], '.,; '));
        }

        if (preg_match('/(?:Satuan\s*Tugas|Regu\s*Evakuasi|Satuan\s*Regu)\s*:\s*([^.]+?)(?=(?:Pimpinan|Pendamping|\.|$))/i', $rawSatgas, $mS)) {
            $satgas = trim(rtrim($mS[1], '.,; '));
        }

        if (preg_match('/Pendamping(?:\s*Operasi)?\s*:\s*([^.]+?)(?=(?:Satuan\s*Tugas|Regu\s*Evakuasi|Pimpinan|\.|$))/i', $rawSatgas, $mD)) {
            $pendamping = trim(rtrim($mD[1], '.,; '));
        }

        if (! $pimpinan && ! $satgas) {
            $pimpinan = $rawSatgas;
        }

        return [$pimpinan, $satgas, $pendamping];
    }

    protected function klasifikasiJenisPelayanan(string $rawJenis): array
    {
        $lower = strtolower(trim($rawJenis));
        $kategoriKejadian = 'penyelamatan_hewan';
        $kategoriNonKebakaran = 'evakuasi_liar';
        $jenisHewan = null;
        $spesiesHewan = null;
        $jenisBenda = null;
        $objekTumbang = null;

        if (str_contains($lower, 'ular')) {
            $jenisHewan = 'Ular';
            if (str_contains($lower, 'sanca')) {
                $spesiesHewan = 'Ular Sanca';
            } elseif (str_contains($lower, 'kobra') || str_contains($lower, 'cobra')) {
                $spesiesHewan = 'Ular Kobra';
            } elseif (str_contains($lower, 'koros') || str_contains($lower, 'coros')) {
                $spesiesHewan = 'Ular Koros';
            } elseif (str_contains($lower, 'piton')) {
                $spesiesHewan = 'Ular Piton';
            } else {
                $spesiesHewan = 'Ular Lainnya';
            }
        } elseif (str_contains($lower, 'biawak')) {
            $jenisHewan = 'Biawak';
        } elseif (str_contains($lower, 'kucing')) {
            $jenisHewan = 'Kucing';
        } elseif (str_contains($lower, 'tawon') || str_contains($lower, 'lebah')) {
            $jenisHewan = 'Tawon / Lebah';
            $spesiesHewan = str_contains($lower, 'vespa') ? 'Tawon Vespa' : 'Lebah Madu';
        } elseif (str_contains($lower, 'monyet')) {
            $jenisHewan = 'Monyet';
        } elseif (str_contains($lower, 'cincin') || str_contains($lower, 'sendok')) {
            $kategoriKejadian = 'penyelamatan_manusia';
            $kategoriNonKebakaran = 'pelepasan_cincin';
            $jenisBenda = $rawJenis;
        } elseif (str_contains($lower, 'pohon')) {
            $kategoriKejadian = 'bencana_alam';
            $kategoriNonKebakaran = 'pohon_tumbang';
            $objekTumbang = 'Pohon Tumbang';
        }

        return [
            'kategori_kejadian' => $kategoriKejadian,
            'kategori_non_kebakaran' => $kategoriNonKebakaran,
            'rincian_kategori_non_kebakaran' => $rawJenis,
            'jenis_hewan' => $jenisHewan,
            'spesies_hewan' => $spesiesHewan,
            'jenis_benda_bahaya' => $jenisBenda,
            'jenis_objek_tumbang' => $objekTumbang,
        ];
    }

    /**
     * Dataset 55 data evakuasi Januari 2025
     */
    protected function getDatasetJanuari2025(): array
    {
        return [
            ['tgl' => '2025-01-02', 'jam' => '07.50 WIB', 'pelapor' => 'Aldrian Junior', 'hp' => '-', 'lokasi' => 'Lrg. Mustika RT. 21 Kel. Paal Merah', 'kec' => 'Paal Merah', 'jenis' => 'Evakuasi Cincin Titanium', 'satgas' => 'Pimpinan Operasi : Danru I Mako ( Saiful Musfofa ) Regu Evakuasi : Regu I Pleton III Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-02', 'jam' => '08.18 WIB', 'pelapor' => 'Maulidin Fitra', 'hp' => '082281400952', 'lokasi' => 'Jl. Sersan Muslim Lrg. Abadi Utama RT. 6 Kel. Paal Merah', 'kec' => 'Jambi Selatan', 'jenis' => 'Evakuasi Biawak', 'satgas' => 'Pimpinan Operasi : Danpos Paal Merah ( Hermanyanto ). Satuan Tugas : Regu III Pos Paal Merah', 'durasi' => '30 Menit'],
            ['tgl' => '2025-01-02', 'jam' => '21.45 WIB', 'pelapor' => 'Laxmi', 'hp' => '081274912492', 'lokasi' => 'Jl. Raden Wijaya No. 57 RT. 25 Lorong Galaksi, Thehok', 'kec' => 'Jambi Selatan', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru III Pleton III Mako ( Adriansyah ). Satuan Tugas : Pleton III Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-02', 'jam' => '22.10 WIB', 'pelapor' => 'Gustomo', 'hp' => '08127418122', 'lokasi' => 'Perumahan Grand Kenali RT. 32 Kel. Mayang Mengurai', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru Regu III Albar ( Abdul Muthalib ). Satuan Tugas : Regu III Posyankar Alam Barajo', 'durasi' => '26 Menit'],
            ['tgl' => '2025-01-04', 'jam' => '15.14 WIB', 'pelapor' => 'Amy Auditha', 'hp' => '081271420912', 'lokasi' => 'Jl. Abdul Chatab No. 26 Kel. Pasir Putih', 'kec' => 'Jambi Selatan', 'jenis' => 'Evakuasi Cincin Emas', 'satgas' => 'Pimpinan Operasi : Danru I Mako. Satuan Tugas : Pleton II Mako', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-04', 'jam' => '20.39 WIB', 'pelapor' => 'Mustafa Kamal', 'hp' => '081283446386', 'lokasi' => 'Perumahan Laskar Amuntai No. F.28 Kenali Besar', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Ular Cobra', 'satgas' => 'Pimpinan Operasi : Danru Regu II Posyankar Alam Barajo ( Hendra. S ). Satuan Tugas : Regu II Posyankar Alam Barajo', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-05', 'jam' => '17.12 WIB', 'pelapor' => 'Iqbal Putra', 'hp' => '081271420912', 'lokasi' => 'Perum. Baogenvil Blok if 07 RT. 026 Kel. Kenali Besar', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Cincin', 'satgas' => 'Pimpinan Operasi : Danru I Pleton III Mako ( Saiful Mustofa ). Satuan Tugas : Pleton III Mako', 'durasi' => '15 Menit'],
            ['tgl' => '2025-01-06', 'jam' => '08.30 WIB', 'pelapor' => 'Satria Darma', 'hp' => '082281158802', 'lokasi' => 'Perumahan Mustika Paal Merah Lama', 'kec' => 'Paal Merah', 'jenis' => 'Evakuasi Biawak', 'satgas' => 'Pimpinan Operasi : Danpos Paal Merah, Danru I Pos Paal Merah ( Arif Masdianto ). Satuan Tugas : Regu I Paal Merah', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-06', 'jam' => '22.30 WIB', 'pelapor' => 'Vindi Annisa', 'hp' => '082132937071', 'lokasi' => 'Jl. Inu Kertapati Kel. Pematang Sulur', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru I Mako ( Amir Hamzh ). Satuan Tugas : Pleton I Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-08', 'jam' => '20.00 WIB', 'pelapor' => 'Zikwan', 'hp' => '08117401008', 'lokasi' => 'Jl. Lindung Indah RT. 25 Kel. Lingakar Selatan', 'kec' => 'Paal Merah', 'jenis' => 'Pembasmian Sarang Tawon Vespa', 'satgas' => 'Pimpinan Operasi : Danpos Paal Merah ( Hermanyanto ). Satuan Tugas : Regu III Posyankar Paal Merah', 'durasi' => '1 Jam 26 Menit'],
            ['tgl' => '2025-01-10', 'jam' => '07.52 WIB', 'pelapor' => 'Muhammad Abay Fadillah', 'hp' => '081324283543', 'lokasi' => 'Jl. Kopral Umar RT. 21 Kel. Kenali Asam Atas', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Cincin', 'satgas' => 'Pimpinan Operasi : Danru II Mako. Satuan Tugas : Pleton II Mko', 'durasi' => '8 Menit'],
            ['tgl' => '2025-01-11', 'jam' => '10.31 WIB', 'pelapor' => 'Angga', 'hp' => '085273027225', 'lokasi' => 'Jl. Sunan Drajat RT. 01 Kel. Kenali Asam', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru III Pleton III Mako ( Adriansyah ). Satuan Tugas : Pleton III Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-11', 'jam' => '16.56 WIB', 'pelapor' => 'Eca', 'hp' => '085783001599', 'lokasi' => 'Jl. Ir. Juanda RT. 25 Kel. Simpang III Sipin', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Sendok Es Krim', 'satgas' => 'Pimpinan Operasi : Danru IV Pleton III Mako ( Efendi ). Satuan Tugas : Pleton III Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-11', 'jam' => '22.42 WIB', 'pelapor' => 'Rafdinal', 'hp' => '082388416057', 'lokasi' => 'Jl. Abdulrahman Shaleh Kel. Paal Lima', 'kec' => 'Jambi Selatan', 'jenis' => 'Evakuasi Kucing dalam Sumur', 'satgas' => 'Pimpinan Operasi : Danru I Pleton III Mako ( Saiful Mustofa ). Satuan Tugas : Pleton III Mako', 'durasi' => '20 Menit'],
            ['tgl' => '2025-01-12', 'jam' => '00.25 WIB', 'pelapor' => 'M. Rioga', 'hp' => '085805047469', 'lokasi' => 'Jl. Pendidikan RT. 10 Kel. Kenali Asam', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca Kembang', 'satgas' => 'Pimpinan Operasi : Danru III Posyankar Kota Baru ( Aulia Rahman ). Satuan Tugas : Regu III Posyankar Kota Baru', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-12', 'jam' => '14.00 WIB', 'pelapor' => 'Winda', 'hp' => '088272277502', 'lokasi' => 'Jl. Veteran RT. 04 Kel. Bagan Pete', 'kec' => 'Alam Barajo', 'jenis' => 'Penyelamatan Hewan Kucing Masuk Sumur', 'satgas' => 'Pimpinan Operasi : Danpos Alam Barajo ( Kms. Muamar ). Satuan Tugas : Regu I Posyankar Alam Barajo', 'durasi' => '15 Menit'],
            ['tgl' => '2025-01-12', 'jam' => '23.59 WIB', 'pelapor' => 'Agus Setiawan', 'hp' => '081366856452', 'lokasi' => 'Jl. Purnama RT. 07 Kel. Suka Karya', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru II Pleton I ( M. Sanuasi Andrian ). Satuan Tugas : Pleton I Mako', 'durasi' => '15 Menit'],
            ['tgl' => '2025-01-13', 'jam' => '16.34 WIB', 'pelapor' => 'Alikha', 'hp' => '085273259343', 'lokasi' => 'Jl. Tanjung Harapan RT. 20 Kel. Talang Bakung', 'kec' => 'Paal Merah', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru II Pos Paal Merah ( Firdaus ). Satuan Tugas : Pos Paal Merah regu II', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-14', 'jam' => '05.47 WIB', 'pelapor' => 'Mardiayanto', 'hp' => '088268353441', 'lokasi' => 'Jl. Surya damai, Perumahan Fajar Kenali Asam Bawah', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru Regu II Pos Kota Baru ( Agus Wiyoto ). Satuan Tugas : Regu II Pos Kota Baru', 'durasi' => '45 Menit'],
            ['tgl' => '2025-01-14', 'jam' => '21.10 WIB', 'pelapor' => 'Yulianto', 'hp' => '082184621919', 'lokasi' => 'Jl. Untung Surapati RT. 46 Kel. Jelutung', 'kec' => 'Jelutung', 'jenis' => 'Evakuasi Monyet', 'satgas' => 'Pimpinan Operasi : Danton III Mako ( Kasianto ). Satuan Tugas : Pleton III Mako', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-15', 'jam' => '21.26 WIB', 'pelapor' => 'Dinda', 'hp' => '083803163962', 'lokasi' => 'Lrg. Hidayat RT. 22 Kel. Rawasari', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru I Pos Alam Barajo ( Wakijan ). Satuan Tugas : Regu I Pos Alam Barajo', 'durasi' => '20 Menit'],
            ['tgl' => '2025-01-17', 'jam' => '19.55 WIB', 'pelapor' => 'Rifqon Hadi', 'hp' => '081297793939', 'lokasi' => 'Perumnas Aur Duri Blok C No. 49 Kel. Aur Kenali', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Sarang Tawon Vespa', 'satgas' => 'Pimpinan Operasi : Danpos Jamkose ( M. Rusdi ). Satuan Tugas : Regu 3 Posyankar Jamkose', 'durasi' => '50 Menit'],
            ['tgl' => '2025-01-17', 'jam' => '22.01 WIB', 'pelapor' => 'Hermansyah', 'hp' => '082384371283', 'lokasi' => 'Lorong sebelah Trono Express Rt. 01 RW. 02 Kenali Besar', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Tawon Vespa', 'satgas' => 'Pimpinan Operasi : Danru III Pos Albar ( Abdul Muthalib hs ). Satuan Tugas : Regu III Posyankar Alam Barajo', 'durasi' => '24 Menit'],
            ['tgl' => '2025-01-18', 'jam' => '23.59 WIB', 'pelapor' => 'M. Yusuf', 'hp' => '082176788325', 'lokasi' => 'RT. 11 Kel. Olak Kemang', 'kec' => 'Danau Teluk', 'jenis' => 'Evakuasi Ular Cobra', 'satgas' => 'Pimpinan Operasi : Danpos Jamkose ( M. Rusdi ). Satuan Tugas : Regu 3 Posyankar Jamkose', 'durasi' => '1 Jam'],
            ['tgl' => '2025-01-18', 'jam' => '06.46 WIB', 'pelapor' => 'Ipah Idayani', 'hp' => '08127330144', 'lokasi' => 'Jl. Purnama RT. 07 Kel. Sukakarya', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular', 'satgas' => 'Pimpinan Operasi : Danru III Pleton III Mako ( Adryansah ). Satuan Tugas : Pleton III Mako', 'durasi' => '25 Menit'],
            ['tgl' => '2025-01-18', 'jam' => '11.20 WIB', 'pelapor' => 'Rika', 'hp' => '085768700747', 'lokasi' => 'Jl. A. Mayor Marzuki Kel. Paal Lima', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru IV Mako ( Hari Candra ). Satuan Tugas : Pleton I Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-19', 'jam' => '12.34 WIB', 'pelapor' => 'Asmayanti', 'hp' => '082287854416', 'lokasi' => 'Perumahan Puri Indah Alam Barajo Blok N7 RT. 17 Kel. Kenali Besar', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Ular Cobra', 'satgas' => 'Pimpinan Operasi : Danru Regu II Posyankar Alam Barajo ( Hendra S ). Satuan Tugas : Regu II Posyankar Alam Barajo', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-19', 'jam' => '13.15 WIB', 'pelapor' => 'Harmain', 'hp' => '081367073184', 'lokasi' => 'Komplek Guru H. Agus Salim Jl. H. Suwandi RT. 01 No. 25 Kel. Handil Jaya', 'kec' => 'Jelutung', 'jenis' => 'Evakuasi Ular Koros', 'satgas' => 'Pimpinan Operasi : Danru III Mako ( Suprapto ). Satuan Tugas : Pleton II Mako', 'durasi' => '30 Menit'],
            ['tgl' => '2025-01-20', 'jam' => '15.45 WIB', 'pelapor' => 'Chintyia', 'hp' => '082376212016', 'lokasi' => 'Jl. Letmud Sarniem Komplek Kavling Nirwana Kel. Kenali Asam Bawah', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Lidi', 'satgas' => 'Pimpinan Operasi : Danru IV Pleton III Mako ( Effendi ). Satuan Tugas : Pleton III Mako', 'durasi' => '20 Menit'],
            ['tgl' => '2025-01-20', 'jam' => '20.22 WIB', 'pelapor' => 'Yola', 'hp' => '083121905231', 'lokasi' => 'Jl. H. Adam Malik Lrg. Bunga Kel. Thehok', 'kec' => 'Jambi Selatan', 'jenis' => 'Pembasmian sarang Lebah Madu', 'satgas' => 'Pimpinan Operasi : Danpos Paal Merah ( Hermanyanto ). Satuan Tugas : Regu III Posyankar Paal Merah', 'durasi' => '45 Menit'],
            ['tgl' => '2025-01-21', 'jam' => '10.43 WIB', 'pelapor' => 'Supriyanto', 'hp' => '081369108484', 'lokasi' => 'Jl. Kol. M. Kukuh Kel. Paal Lima', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru I Pleton I Mako ( Amir Hamza ). Satuan Tugas : Pleton I Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-21', 'jam' => '15.27 WIB', 'pelapor' => 'M. Husairi', 'hp' => '085369873899', 'lokasi' => 'Lrg. Diamond RT. 02 Kel. Tengah', 'kec' => 'Pelayangan', 'jenis' => 'Evakuasi Sarang Tawon Vespa', 'satgas' => 'Pimpinan Operasi : Danru I Jamkose. Satuan Tugas : Regu I Jamkose', 'durasi' => '20 Menit'],
            ['tgl' => '2025-01-22', 'jam' => '15.54 WIB', 'pelapor' => 'Julia', 'hp' => '085155449638', 'lokasi' => 'Perum Griya Raya 3 Blok K 18 Kel. Pematang Sulur', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Anak Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru II Mako ( Ragil Ade Nugroho ). Satuan Tugas : Pleton II Mako', 'durasi' => '60 Menit'],
            ['tgl' => '2025-01-22', 'jam' => '23.21 WIB', 'pelapor' => 'Lidya', 'hp' => '085210792712', 'lokasi' => 'Jl. PLTG Batanghari Selincah', 'kec' => 'Paal Merah', 'jenis' => 'Evakuasi Ular Cobra', 'satgas' => 'Pimpinan Operasi : Danru II Posyankar Jambi Timur ( Poniadi ). Satuan Tugas : Regu II Jambi Timur', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-23', 'jam' => '16.03 WIB', 'pelapor' => 'Dini Mirza', 'hp' => '085366421417', 'lokasi' => 'Jl. H. Manaf No. 4A RT. 09 Kel, Telanaipura', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru I Pleton III Mako ( Saiful Mustopa ). Satuan Tugas : Regu I Pleton III', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-24', 'jam' => '10.24 WIB', 'pelapor' => 'Tomas', 'hp' => '081274745567', 'lokasi' => 'Jl. Raden Wijaya RT. 32 No. 27 Komplek Pepabri Kel. Thehok', 'kec' => 'Jambi Selatan', 'jenis' => 'Evakuasi Cincin', 'satgas' => 'Pimpinan Operasi : Danru I Mako ( Amir Hamzah ). Satuan tugas : Pleton I Mako', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-25', 'jam' => '11.53 WIB', 'pelapor' => 'Soraya', 'hp' => '085184497759', 'lokasi' => 'Jl. Kaca Piring Komplek Teluk Permai No. 29 Kel. Simpang IV Sipin', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru Regu II Posyankar Alam Barajo ( Hendra S ). Satuan Tugas : Regu II Posyankar Alam Barajo', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-25', 'jam' => '19.18 WIB', 'pelapor' => 'Edy Hermanto', 'hp' => '089504094672', 'lokasi' => 'Jl. Kol. Abunjani No. 12 A Kel. Selamat', 'kec' => 'Danau Sipin', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru III Pleton II Mako ( Suprapto ). Satuan Tugas : Regu III Pleton II Mako', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-25', 'jam' => '21.27 WIB', 'pelapor' => 'Daffa Okta', 'hp' => '083802142798', 'lokasi' => 'Jl. Arjuna 1 RT. 25 Kel. Eka Jaya', 'kec' => 'Paal Merah', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danpos Paal Merah ( Hermanyanto ). Satuan Tugas : Pos Paal Merah Regu II', 'durasi' => '30 Menit'],
            ['tgl' => '2025-01-26', 'jam' => '17.07 WIB', 'pelapor' => 'Denil Irwandi', 'hp' => '085266009427', 'lokasi' => 'Jl. Golf 1 No. 92 RT. 23 Kel. Pematang Sulur', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Ular Sanca di dalam Mobil', 'satgas' => 'Pimpinan Operasi : Danru II Pleton III Mako ( Ade Rifai ). Satuan Tugas : Regu II Pleton III Mako', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-26', 'jam' => '19.30 WIB', 'pelapor' => 'Ari', 'hp' => '085267739344', 'lokasi' => 'Cafe Senyala Jl. Sunan Giri No. 81 kel. Simpang III sipin', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular sanca', 'satgas' => 'Pimpinan Operasi : Danki ( Julianto ) Danton III Mako ( Kasianto ). Satuan tugas : Danru IV Pleton III Mako ( Effendi )', 'durasi' => '4 Jam'],
            ['tgl' => '2025-01-27', 'jam' => '11.50 WIB', 'pelapor' => 'Syaiful Lukman', 'hp' => '085366960605', 'lokasi' => 'Jl. Berbah Dalam Lrg. Pepaya RT. 16 Kel. Bakung Jaya', 'kec' => 'Paal Merah', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danpos Paal Merah Danru 1 Pos Paal Merah ( Arif Masdianto ). Satuan Tugas : Regu I Paal Merah', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-27', 'jam' => '13.52 WIB', 'pelapor' => 'Andrianto', 'hp' => '087899535754', 'lokasi' => 'Jl. Kapten Patimura Kel. Kenali Besar RT. 06 no. 16', 'kec' => 'Kenali Besar', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru I Pos Alam Barajo ( Wakijan ). Satuan Tugas : Regu I Pos Alam Barajo', 'durasi' => '20 Menit'],
            ['tgl' => '2025-01-28', 'jam' => '16.43 WIB', 'pelapor' => 'Zakiatul Fahira', 'hp' => '0895632894371', 'lokasi' => 'RT. 12 Kel. Arab Melayu', 'kec' => 'Pelayangan', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru II Pos Jamkose ( Isnaini ). Satuan Tugas : Regu II Jamkose', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-29', 'jam' => '08.10 WIB', 'pelapor' => 'Gita', 'hp' => '083874635239', 'lokasi' => 'Jl. Hutan Kota Kel. Mayang Mengurai', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru I Pleton III Mako ( Saipul Mustofa ). Satuan Tugas : Regu I Pleton III Mako', 'durasi' => '5 menit'],
            ['tgl' => '2025-01-29', 'jam' => '18.55 WIB', 'pelapor' => 'Aditya', 'hp' => '088276446124', 'lokasi' => 'Jl. Kapten Patimura Kel. Kenali Besar RT. 05 No. 22', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Ular Kobra', 'satgas' => 'Pimpinan Operasi : Danru Regu III Albar ( Abdul Muthalib ). Satuan Tugas : Regu III Posyankar Alam Barajo', 'durasi' => '35 Menit'],
            ['tgl' => '2025-01-29', 'jam' => '21.20 WIB', 'pelapor' => 'Johardi', 'hp' => '085357698217', 'lokasi' => 'Jl. Pangeran Hidayat RT. 14 No. 60 Kel. Suka Karya', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru II Pleton III Mako ( Ade Rifai ). Satuan Tugas : Regu II Pleton III Mako', 'durasi' => '5 menit'],
            ['tgl' => '2025-01-29', 'jam' => '21.32 WIB', 'pelapor' => 'Eni Puspita Sari', 'hp' => '082374531123', 'lokasi' => 'Perumahan Kota Baru Indah blok b6 No. 170 Kel. Kenali Besar', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Lebah', 'satgas' => 'Pimpinan Operasi : Danru III Pos Albar ( Abdul Muthalib hs ). Satuan Tugas : Regu III Posyankar Alam Barajo', 'durasi' => '43 Menit'],
            ['tgl' => '2025-01-30', 'jam' => '06.31 WIB', 'pelapor' => 'A. Ridho Aljufri', 'hp' => '081366359301', 'lokasi' => 'Jl. Kh. M. Ja\'far RT. 01 Kel. Arab Melayu', 'kec' => 'Pelayangan', 'jenis' => 'Evakuasi Ular Piton', 'satgas' => 'Pimpinan Operasi : Danpos Jamkose ( M. Rusdi ). Satuan Tugas : Regu III & Regu I Jamkose', 'durasi' => '3 Jam'],
            ['tgl' => '2025-01-30', 'jam' => '12.38 WIB', 'pelapor' => 'Hidayati', 'hp' => '083826550472', 'lokasi' => 'Jl. Widuri 2 RT. 27 No. 52 Kel. Paal Lima', 'kec' => 'Kota Baru', 'jenis' => 'Evakuasi Ular Kobra', 'satgas' => 'Pimpinan Operasi : Danru III Pleton I Mako ( Ja\'i ). Satuan Tugas : Pleton I Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-31', 'jam' => '14.58 WIB', 'pelapor' => 'Dynie Mirza', 'hp' => '085366421417', 'lokasi' => 'Jl. H. A. Manaf No. 4A RT. 09', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Ular Sanca', 'satgas' => 'Pimpinan Operasi : Danru II Pleton II Mako ( Ragil Ade Nugroho ). Satuan Tugas : Pleton II Mako', 'durasi' => '10 Menit'],
            ['tgl' => '2025-01-31', 'jam' => '20.26 WIB', 'pelapor' => 'Ringo', 'hp' => '082316942432', 'lokasi' => 'Jl. P. Polim RT. 11 Kel. Rajawali', 'kec' => 'Jambi Timur', 'jenis' => 'Evakuasi Tawon Madu', 'satgas' => 'Pimpinan Operasi : Danpos Posyankar Jambi Timur. Satuan Tugas : Regu II Posyankar Jambi Timur', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-31', 'jam' => '20.37 WIB', 'pelapor' => 'Eka', 'hp' => '081324772179', 'lokasi' => 'Jl. Andalas Kel. Kebun Handil', 'kec' => 'Jelutung', 'jenis' => 'Evakuasi Sarang Tawon', 'satgas' => 'Pimpinan Operasi : Danru I Pleton II Mako ( Juliansyah Sulaiman ). Satuan Tugas : Pleton II Mako', 'durasi' => '5 Menit'],
            ['tgl' => '2025-01-31', 'jam' => '20.31 WIB', 'pelapor' => 'Angga', 'hp' => '082279520007', 'lokasi' => 'Perumahan Permata Land Blok Intan D12', 'kec' => 'Alam Barajo', 'jenis' => 'Evakuasi Sarang Tawon Vespa', 'satgas' => 'Pimpinan Operasi : Danru II Albar ( Hendra S ). Satuan Tugas : Regu II Posyankar Alam Barajo', 'durasi' => '15 Menit'],
            ['tgl' => '2025-01-31', 'jam' => '20.25 WIB', 'pelapor' => 'Rifqon Hadi', 'hp' => '081297793939', 'lokasi' => 'Perumnas Aurduri Blok C No. 49 Kel. Aur Duri', 'kec' => 'Telanaipura', 'jenis' => 'Evakuasi Sarang Tawon Vespa', 'satgas' => 'Pimpinan Operasi : Danpos Jamkose ( Rusdi ) didampingi Danru II Jamkose ( Isnaini ). Satuan Tugas : Regu II Posyankar Jamkose', 'durasi' => '15 Menit'],
        ];
    }
}
