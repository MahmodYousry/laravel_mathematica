<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Blood Type Seeder
        $this->call(BloodTableSeeder::class);
        // Nationality
        $this->call(NationalityTableSeeder::class);
        // Religion
        $this->call(ReligionTableSeeder::class);
        // User Email
        $this->call(UserSeeder::class);
    }
}
