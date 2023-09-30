<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class teachersSectionsSeeder extends Seeder
{
    public function run()
    {
        // if teacher_section table has at least one data truncate if not do nothing
        if (DB::table('teacher_section')->first()) {
            DB::table('teacher_section')->truncate();
        }

        DB::table('teacher_section')->insert([
            [
                'id'            => 3,
                'teacher_id'    => 3,
                'section_id'    => 8,
            ],
            [
                'id'            => 4,
                'teacher_id'    => 4,
                'section_id'    => 8,
            ],
            [
                'id'            => 9,
                'teacher_id'    => 3,
                'section_id'    => 10,
            ]
        ]);

    }
}
