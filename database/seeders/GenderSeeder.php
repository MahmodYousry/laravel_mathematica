<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // if genders table has at least one data truncate if not do nothing
        if (DB::table('genders')->first()) {
            DB::table('genders')->truncate();
        }

        $genders = [
            ['en' => 'Male', 'ar' => 'ذكر'],
            ['en' => 'Female', 'ar' => 'انثى'],
        ];

        foreach ($genders as $ge) {
            Gender::create(['Name' => $ge]);
        }

    }
}
