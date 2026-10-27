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
            DistribusiStaffSeeder::class,
            RekapLayananTableSeeder::class,
            LaporanPenyelamatansTableSeeder::class,
            LpTeknisLogistiksTableSeeder::class,
            LpDokumentasisTableSeeder::class,
            LpKategoriKhususTableSeeder::class,
            LaporanEvakuasiSeeder::class,
            RekapNonKebakaransTableSeeder::class,
            KejadianDamkarTableSeeder::class,
            DokumenSopSeeder::class,
            DokumenPublikSeeder::class,
        ]);
    }
}
