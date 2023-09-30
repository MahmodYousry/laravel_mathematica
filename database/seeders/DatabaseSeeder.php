<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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
        // Genders
        $this->call(GenderSeeder::class);
        // Specialization Of Subject
        $this->call(SpecializationSeeder::class);

        // call this with quee
        $this->call(teachersSectionsSeeder::class);
        $this->call(sectionsSeeder::class);
        $this->call(classroomsSeeder::class);
    }
}
