<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            PosPemadamSeeder::class,
            SaranaKebakaranSeeder::class,
            PrasaranaKebakaranSeeder::class,
            SaranaPenyelamatanMakoSeeder::class,
            SumberAirSeeder::class,
            HidranKotaSeeder::class,
            KebutuhanSarprasSeeder::class,
            PengadaanSarprasSeeder::class,
            PerbaikanKendaraanSeeder::class,
            DistribusiStaffSeeder::class,
            RekapLayananTableSeeder::class,
            // Legacy seeder 2022-2024 dinonaktifkan agar hanya menyisakan data 2025 & 2026:
            // LaporanPenyelamatansTableSeeder::class,
            // LpTeknisLogistiksTableSeeder::class,
            // LpDokumentasisTableSeeder::class,
            // LpKategoriKhususTableSeeder::class,
            LaporanEvakuasiSeeder::class,
            LaporanKebakaran2026Seeder::class,
            RekapNonKebakaransTableSeeder::class,
            KejadianDamkarTableSeeder::class,
            DokumenSopSeeder::class,
            DokumenPublikSeeder::class,
            SotkSeeder::class,
            CascadeTupoksiSeeder::class,
            ProdukHukumSeeder::class,
            FireDrillSeeder::class,
            InspeksiBangunanSeeder::class,
            SosialisasiPenyuluhanSeeder::class,
            KunjunganEdukasiSeeder::class,
            PelatihanKeluargaSeeder::class,
            PetaJabatanSeeder::class,
        ]);
    }
}
