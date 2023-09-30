<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class classroomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if classrooms table has at least one data truncate if not do nothing
        if (DB::table('classrooms')->first()) {
            DB::table('classrooms')->truncate();
        }

        DB::table('classrooms')->insert([
            [
                'id'            => '140',
                'class_name'    => '{"en":"class 1","ar":"\u0627\u0644\u0635\u0641 \u0627\u0644\u0627\u0648\u0644"}',
                'grade_id'      => 1,
                'created_at'    => '2023-05-20 09:30:02',
                'updated_at'    => '2023-09-13 16:59:08',
            ],
            [
                'id'            => '141',
                'class_name'    => '{"en":"class 5","ar":"\u0627\u0644\u0635\u0641 5"}',
                'grade_id'      => 2,
                'created_at'    => '2023-05-20 09:31:24',
                'updated_at'    => '2023-09-13 16:59:31',
            ],
            [
                'id'            => '142',
                'class_name'    => '{"en":"class 12","ar":"\u0627\u0644\u0641\u0635\u0644 \u0627\u0644 12"}',
                'grade_id'      => 2,
                'created_at'    => '2023-05-20 09:32:18',
                'updated_at'    => '2023-05-22 09:17:21',
            ],
            [
                'id'            => '144',
                'class_name'    => '{"en":"class 2","ar":"\u0641\u0635\u0644 2"}',
                'grade_id'      => 3,
                'created_at'    => '2023-05-22 09:14:14',
                'updated_at'    => '2023-05-22 09:14:14',
            ],
            [
                'id'            => '145',
                'class_name'    => '{"en":"class 2","ar":"\u0627\u0644\u0635\u0641 \u0627\u0644\u062b\u0627\u0646\u0649"}',
                'grade_id'      => 1,
                'created_at'    => '2023-09-13 15:41:59',
                'updated_at'    => '2023-09-13 16:59:50',
            ],
        ]);



    }
}
