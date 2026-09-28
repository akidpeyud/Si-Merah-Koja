<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PrasaranaImport;

class PrasaranaSeeder extends Seeder
{
    public function run(): void
    {
        // Sesuaikan dengan nama file Anda
        $filePath = storage_path('app/data_prasarana.xlsx');

        if (file_exists($filePath)) {
            Excel::import(new PrasaranaImport, $filePath);
            $this->command->info('Mantap bro! Seluruh data Prasarana Hidrant berhasil dimasukkan ke database.');
        } else {
            $this->command->error('Waduh, file data_prasarana.xlsx tidak ditemukan di folder storage/app/');
        }
    }
}