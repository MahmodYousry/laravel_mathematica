<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\GradeRequest;
use App\Http\Controllers\Controller;

class GradeController extends Controller {

    public function index() {
        $grades = Grade::all();
        return view('pages.grades.index', compact('grades'));
    }

    public function store(GradeRequest $request, Grade $grade) {

        try {
            $grade = new Grade();
            $grade->name = ['ar' => $request->name, 'en' => $request->en_name];
            $grade->notes = $request->notes;
            $grade->save();
            return redirect()->route('grades.index')->with('success', trans('grades.add_success'));
        }

        catch (\Exception $e){
            return redirect()->route('grades.index')->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(GradeRequest $request, grade $grade) {
        try {
            $grade->name = ['ar' => $request->name, 'en' => $request->en_name];
            $grade->notes = $request->notes;

            if ($grade->update()) {
                return redirect()->route('grades.index')->with('success', trans('action.data_save_success'));
            } else {
                return redirect()->route('grades.index')->with('success', trans('action.data_save_fail'));
            }

        }

        catch (\Exception $e){
            return redirect()->route('grades.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Grade $grade) {
        // look for grade id in classroom table if there is then it cannot be deleted
        $classroom_grade_id = Classroom::where('grade_id', $grade->id)->pluck('grade_id');

        if ($classroom_grade_id->count() == 0) {
            $grade->delete();
            return redirect()->route('grades.index')->with('success', trans('action.data_delete_success'));
        } else {
            return redirect()->route('grades.index')->with('error', trans('action.data_exist_else_success'));
        }
    }
}
