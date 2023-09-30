<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // if religions table has at least one data truncate if not do nothing
        if (DB::table('religions')->first()) {
            DB::table('religions')->truncate();
        }

        $religions = [

            [
                'en'=> 'Muslim',
                'ar'=> 'مسلم'
            ],
            [
                'en'=> 'Christian',
                'ar'=> 'مسيحي'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'غيرذلك'
            ],

        ];

        foreach ($religions as $R) {
            Religion::create(['name' => $R]);
        }
    }
}
