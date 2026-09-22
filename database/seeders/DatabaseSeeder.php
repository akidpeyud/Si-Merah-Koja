<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
<<<<<<< HEAD
            UserSeeder::class,
=======
            UsersTableSeeder::class,
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
        ]);
    }
}