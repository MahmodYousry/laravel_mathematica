<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface {

    public function index() {
        $grades = Grade::all();
        return view('pages.promotions.index', compact('grades'));
    }

    public function create() {
        $promotions = Promotion::all();
        return view('pages.promotions.management', compact('promotions'));
    }

    public function store($request) {

        DB::beginTransaction();

        try {

            $students = student::where('grade_id', $request->grade_id)
                ->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student) {

                $ids = explode(',',$student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'grade_id'      =>  $request->new_grade_id,
                        'classroom_id'  =>  $request->new_classroom_id,
                        'section_id'    =>  $request->new_section_id,
                        'academic_year' =>  $request->new_academic_year,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'        =>  $student->id,
                    'from_grade'        =>  $request->grade_id,
                    'from_classroom'    =>  $request->classroom_id,
                    'from_section'      =>  $request->section_id,
                    'to_grade'          =>  $request->new_grade_id,
                    'to_classroom'      =>  $request->new_classroom_id,
                    'to_section'        =>  $request->new_section_id,
                    'academic_year'     =>  $request->academic_year,
                    'new_academic_year' =>  $request->new_academic_year,
                ]);

            }
            DB::commit();

            return redirect()->route('promotion.index')->with(['success' => trans('action.data_save_success')]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('promotion.index')->with('error',$e->getMessage());
        }
    }

    public function destroy($request) {

        try {
            DB::beginTransaction();

            // delete all
            if ($request->page_id == 1) {
                $promotions = Promotion::all();

                // update the students table
                foreach ($promotions as $promotion) {
                    $ids = explode(',',$promotion->student_id);
                    Student::whereIn('id', $ids)->update([
                        'grade_id'      =>  $promotion->from_grade,
                        'classroom_id'  =>  $promotion->from_classroom,
                        'section_id'    =>  $promotion->from_section,
                        'academic_year' =>  $promotion->academic_year,
                    ]);
                }

                // Reset the promotions table
                Promotion::truncate();


            } else { // delete all
                $promotion = Promotion::findOrFail($request->id);

                // from the old info in promotion update the student info
                Student::where('id', $promotion->student_id)->update([
                    'grade_id'      =>  $promotion->from_grade,
                    'classroom_id'  =>  $promotion->from_classroom,
                    'section_id'    =>  $promotion->from_section,
                    'academic_year' =>  $promotion->academic_year,
                ]);

                // Delete the specific promotion
                $promotion->delete();

            }
        DB::commit();
        // return redirect
        return redirect()->route('promotion.create')->with('success', trans('action.data_delete_success'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('promotion.create')->with('error',$e->getMessage());
        }
    }

}
