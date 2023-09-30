<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sectionsSeeder extends Seeder
{
    public function run()
    {
        // if sections table has at least one data delete them we dont have to truncate due to it will not work due to relation
        // if not do nothing
        if (DB::table('sections')->first()) {
            DB::table('sections')->delete();
        }

        DB::table('sections')->insert([
            [
                'id'            => '1',
                'section_name'  => '{"ar":"\u0623","en":"A"}',
                'status'        => 1,
                'grade_id'      => 1,
                'classroom_id'  => 140,
            ],
            [
                'id'            => '3',
                'section_name'  => '{"ar":"\u0628","en":"B"}',
                'status'        => 1,
                'grade_id'      => 1,
                'classroom_id'  => 140,
            ],
            [
                'id'            => '8',
                'section_name'  => '{"ar":"claass test","en":"\u0641\u0635\u0644 \u0627\u062e\u062a\u0628\u0627\u0631"}',
                'status'        => 1,
                'grade_id'      => 2,
                'classroom_id'  => 142,
            ],
            [
                'id'            => '9',
                'section_name'  => '{"ar":"\u062c","en":"C"}',
                'status'        => 1,
                'grade_id'      => 1,
                'classroom_id'  => 140,
            ],
            [
                'id'            => '10',
                'section_name'  => '{"ar":"\u0639\u0644\u0648\u0645","en":"science"}',
                'status'        => 1,
                'grade_id'      => 1,
                'classroom_id'  => 145,
            ],
            [
                'id'            => '11',
                'section_name'  => '{"ar":"\u0623","en":"A"}',
                'status'        => 1,
                'grade_id'      => 3,
                'classroom_id'  => 144,
            ],
        ]);
    }
}
