<?php

namespace Database\Seeders;

use App\Models\Blood_Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    public function run()
    {

        // if blood__types table has at least one data truncate if not do nothing
        if (DB::table('blood__types')->first()) {
            DB::table('blood__types')->truncate();
        }

        $bgs = ['O-','O+', 'A+', 'A-', 'B+', 'B-', 'AB+' , 'AB-'];

        foreach ($bgs as $bg) {
            Blood_Type::Create(['name' => $bg]);
        }

    }
}
