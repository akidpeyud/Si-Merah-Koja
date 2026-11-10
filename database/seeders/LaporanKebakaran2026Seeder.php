<?php

namespace Database\Seeders;

use App\Models\LaporanPenyelamatan;
use App\Models\LpDokumentasi;
use App\Models\LpTeknisLogistik;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LaporanKebakaran2026Seeder extends Seeder
{
    /**
     * Jalankan seeder data laporan kebakaran tahun 2026.
     */
    public function run(): void
    {
        $user = User::whereHas('roles', fn ($q) => $q->whereIn('name', ['Damtan', 'Super User']))->first() ?? User::first();
        if (! $user) {
            $this->call(UsersTableSeeder::class);
            $user = User::whereHas('roles', fn ($q) => $q->whereIn('name', ['Damtan', 'Super User']))->first() ?? User::first();
        }
        $userId = $user ? $user->id : 1;

        $jsonDatasetPath = database_path('seeders/data/laporan_kebakaran_2025_2026.json');
        if (! File::exists($jsonDatasetPath)) {
            $jsonDatasetPath = database_path('seeders/data/laporan_kebakaran_2026.json');
        }
        if (! File::exists($jsonDatasetPath)) {
            $this->command->error("File dataset seeder tidak ditemukan di: {$jsonDatasetPath}");

            return;
        }

        $this->command->info('Memuat dataset seeder laporan kebakaran tahun 2025-2026 dari file JSON...');
        $content = File::get($jsonDatasetPath);
        $dataset = json_decode($content, true);

        if (! is_array($dataset) || empty($dataset)) {
            $this->command->warn('Dataset laporan kebakaran kosong atau format tidak valid.');

            return;
        }

        $totalRecords = count($dataset);
        $this->command->info("Ditemukan {$totalRecords} data laporan kebakaran (2025 - 2026). Memulai proses seeding...");

        // Bersihkan data laporan lama sebelum 2025 pada tabel ini saja agar data teman ikut sinkron
        DB::table('laporan_penyelamatans')->where('tahun_kejadian', '<', 2025)->delete();

        $inserted = 0;
        $skipped = 0;

        // Proses dalam chunk transaksi untuk performa dan integritas database
        $chunks = array_chunk($dataset, 50);
        foreach ($chunks as $chunk) {
            DB::transaction(function () use ($chunk, $userId, &$inserted, &$skipped) {
                foreach ($chunk as $item) {
                    $nomor = $item['nomor_laporan'] ?? null;
                    $tgl = $item['tanggal_kejadian'] ?? null;
                    $alamat = $item['alamat'] ?? null;

                    // Cek duplikasi agar seeder aman dijalankan berulang kali
                    $exists = LaporanPenyelamatan::where('nomor_laporan', $nomor)
                        ->orWhere(function ($q) use ($tgl, $alamat) {
                            $q->where('tanggal_kejadian', $tgl)
                                ->where('alamat', $alamat)
                                ->where('kategori_kejadian', 'kebakaran');
                        })
                        ->exists();

                    if ($exists) {
                        $skipped++;

                        continue;
                    }

                    $teknis = $item['teknis_logistik'] ?? [];
                    $dok = $item['dokumentasi'] ?? [];

                    $armada = $item['armada'] ?? ($teknis['armada'] ?? null);
                    $armadaJson = is_array($armada) ? json_encode($armada) : $armada;
                    $armadaArr = is_array($armada) ? $armada : (is_string($armada) ? json_decode($armada, true) : null);

                    $laporan = LaporanPenyelamatan::create([
                        'nomor_laporan'              => $nomor ?? $this->buatNomorLaporan(Carbon::parse($tgl)),
                        'id_laporan'                 => $item['id_laporan'] ?? Str::uuid()->toString(),
                        'user_id'                    => $userId,
                        'tanggal_kejadian'           => $tgl,
                        'hari_kejadian'              => $item['hari_kejadian'] ?? Carbon::parse($tgl)->locale('id')->translatedFormat('l'),
                        'bulan_kejadian'             => $item['bulan_kejadian'] ?? Carbon::parse($tgl)->locale('id')->translatedFormat('F'),
                        'tahun_kejadian'             => (int) ($item['tahun_kejadian'] ?? Carbon::parse($tgl)->year),

                        'nama_pelapor'               => $item['nama_pelapor'] ?? 'Masyarakat',
                        'telepon_pelapor'            => $item['telepon_pelapor'] ?? '-',
                        'media_pelaporan'            => $item['media_pelaporan'] ?? 'WhatsApp / Telepon',

                        'kategori_kejadian'          => 'kebakaran',
                        'kategori_kebakaran'         => $item['kategori_kebakaran'] ?? 'lainnya',
                        'keterangan_objek_kebakaran' => $item['keterangan_objek_kebakaran'] ?? 'Kebakaran',
                        'prioritas'                  => $item['prioritas'] ?? 'sedang',

                        'waktu_kejadian'             => $item['waktu_kejadian'] ?? ($tgl.' 08:00:00'),
                        'waktu_terima'               => $item['waktu_terima'] ?? $item['waktu_kejadian'] ?? ($tgl.' 08:00:00'),
                        'waktu_berangkat'            => $item['waktu_berangkat'] ?? null,
                        'waktu_tiba'                 => $item['waktu_tiba'] ?? null,
                        'waktu_selesai'              => $item['waktu_selesai'] ?? null,
                        'waktu_kembali'              => $item['waktu_kembali'] ?? null,

                        'alamat'                     => $alamat ?? '-',
                        'jarak_tempuh'               => $item['jarak_tempuh'] ?? null,
                        'jumlah_jiwa'                => (int) ($item['jumlah_jiwa'] ?? 0),
                        'warga_terdampak'            => (int) ($item['warga_terdampak'] ?? 0),
                        'korban_selamat'             => (int) ($item['korban_selamat'] ?? 0),
                        'korban_ringan'              => (int) ($item['korban_ringan'] ?? 0),
                        'korban_berat'               => (int) ($item['korban_berat'] ?? 0),
                        'korban_meninggal'           => (int) ($item['korban_meninggal'] ?? 0),
                        'korban_hewan_aset'          => $item['korban_hewan_aset'] ?? null,
                        'status_evakuasi'            => $item['status_evakuasi'] ?? ($teknis['status_evakuasi'] ?? 'Selesai'),
                        'objek_terdampak'            => $item['objek_terdampak'] ?? ($teknis['objek_terdampak'] ?? null),
                        'hambatan_lapangan'          => $item['hambatan_lapangan'] ?? ($teknis['hambatan_lapangan'] ?? null),

                        'armada'                     => $armadaJson,
                        'liter_air'                  => (int) ($item['liter_air'] ?? ($teknis['liter_air'] ?? 0)),
                        'dugaan_penyebab'            => $item['dugaan_penyebab'] ?? ($dok['dugaan_penyebab'] ?? 'lainnya'),
                        'dugaan_penyebab_lainnya'    => $item['dugaan_penyebab_lainnya'] ?? ($dok['dugaan_penyebab_lainnya'] ?? null),
                        'kronologi_lengkap'          => $item['kronologi_lengkap'] ?? ($dok['kronologi_lengkap'] ?? null),
                    ]);

                    LpTeknisLogistik::create([
                        'laporan_id'       => $laporan->id,
                        'pimpinan_operasi' => $teknis['pimpinan_operasi'] ?? ($item['pimpinan_operasi'] ?? null),
                        'pendamping_operasi' => $teknis['pendamping_operasi'] ?? ($item['pendamping_operasi'] ?? null),
                        'satuan_tugas'     => $teknis['satuan_tugas'] ?? ($item['satuan_tugas'] ?? 'Mako Damkar'),
                        'tim_respontime'   => $teknis['tim_respontime'] ?? ($item['tim_respontime'] ?? null),
                        'jumlah_personel'  => (int) ($teknis['jumlah_personel'] ?? ($item['jumlah_personel'] ?? 0)),
                        'langkah_penanganan' => $teknis['langkah_penanganan'] ?? ($item['langkah_penanganan'] ?? null),
                        'hambatan_lapangan'  => $teknis['hambatan_lapangan'] ?? ($item['hambatan_lapangan'] ?? null),
                        'hasil_tindakan'   => $teknis['hasil_tindakan'] ?? ($item['hasil_tindakan'] ?? 'Terlayani'),
                        'status_evakuasi'  => $teknis['status_evakuasi'] ?? ($item['status_evakuasi'] ?? 'Selesai'),
                        'objek_terdampak'  => $teknis['objek_terdampak'] ?? ($item['keterangan_objek_kebakaran'] ?? null),
                        'korban_selamat'   => (int) ($item['korban_selamat'] ?? 0),
                        'korban_ringan'    => (int) ($item['korban_ringan'] ?? 0),
                        'korban_berat'     => (int) ($item['korban_berat'] ?? 0),
                        'korban_meninggal' => (int) ($item['korban_meninggal'] ?? 0),
                        'korban_hewan_aset'=> $item['korban_hewan_aset'] ?? null,
                        'armada'           => $armadaArr,
                        'liter_air'        => (int) ($item['liter_air'] ?? ($teknis['liter_air'] ?? 0)),
                        'konsumsi_alat'    => $teknis['konsumsi_alat'] ?? ($item['konsumsi_alat'] ?? null),
                    ]);

                    LpDokumentasi::create([
                        'laporan_id'              => $laporan->id,
                        'dugaan_penyebab'         => $dok['dugaan_penyebab'] ?? ($item['dugaan_penyebab'] ?? 'lainnya'),
                        'dugaan_penyebab_lainnya' => $dok['dugaan_penyebab_lainnya'] ?? ($item['dugaan_penyebab_lainnya'] ?? null),
                        'kronologi_lengkap'       => $dok['kronologi_lengkap'] ?? ($item['kronologi_lengkap'] ?? null),
                    ]);

                    $inserted++;
                }
            });
        }

        $this->command->info("Seeding data laporan kebakaran 2026 selesai! Berhasil disimpan: {$inserted}, Duplikat dilewati: {$skipped}.");
    }

    /**
     * Format nomor laporan standar: REG-YYYYMMDD-0001
     */
    private function buatNomorLaporan(Carbon $tanggal): string
    {
        $prefix = 'REG-'.$tanggal->format('Ymd').'-';

        $terakhir = LaporanPenyelamatan::where('nomor_laporan', 'like', $prefix.'%')
            ->orderByDesc('nomor_laporan')
            ->value('nomor_laporan');

        $urut = $terakhir ? ((int) substr($terakhir, -4)) + 1 : 1;

        return $prefix.str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }
}
