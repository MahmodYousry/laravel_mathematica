<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // if specializations table has at least one data truncate if not do nothing
        if (DB::table('specializations')->first()) {
            DB::table('specializations')->truncate();
        }

        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'اللغة العربية'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],
        ];

        foreach ($specializations as $s) {
            Specialization::create(['Name' => $s]);
        }
    }
}
