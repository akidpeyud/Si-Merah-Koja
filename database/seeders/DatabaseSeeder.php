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
        ]);
<<<<<<< HEAD
        $this->call(RekapLayananTableSeeder::class);
        $this->call(LaporanPenyelamatansTableSeeder::class);
        $this->call(LpTeknisLogistiksTableSeeder::class);
        $this->call(LpDokumentasisTableSeeder::class);
        $this->call(LpKategoriKhususTableSeeder::class);
        $this->call(RekapNonKebakaransTableSeeder::class);
=======
        $this->call(KejadianDamkarTableSeeder::class);
>>>>>>> a9a343837ce665a0df0190fd375aa2e01e023ced
    }
}