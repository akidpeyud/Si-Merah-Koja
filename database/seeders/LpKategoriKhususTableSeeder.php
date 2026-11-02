<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LpKategoriKhususTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('lp_kategori_khusus')->exists()) {
            return;
        }
        
        
        
    }
}