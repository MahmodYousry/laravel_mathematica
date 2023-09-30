<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface {

    public function index() {
        $students = Student::onlyTrashed()->get();
        return view('pages.students.graduated.index', compact('students'));
    }

    public function create() {
        $grades = Grade::all();
        return view('pages.students.graduated.create', compact('grades'));
    }

    public function softDelete($request) {

        $students = Student::where('grade_id', $request->grade_id)->where('classroom_id', $request->classroom_id)
        ->where('section_id', $request->section_id)->get();

        if ($students->count() < 1) {
            return redirect()->back()->with('error', trans('action.data_get_no_data'));
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);

            // soft delete it
            Student::whereIn('id', $ids)->delete();
        }

        return redirect()->route('graduate.index')->with('success', trans('action.data_save_success'));
    }

    public function returnStudent($request) {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        return redirect()->back()->with('success', trans('action.data_restore_success'));
    }

    public function destroy($id) {
        // this function need update because we need to know if there is any attachments for this student or parent to delete first
        student::onlyTrashed()->where('id', $id)->first()->forceDelete();
        return redirect()->back()->with('success', trans('action.data_delete_success'));
    }

}
