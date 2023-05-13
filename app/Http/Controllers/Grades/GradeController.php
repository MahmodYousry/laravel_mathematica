<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\GradeRequest;
use App\Http\Controllers\Controller;

class GradeController extends Controller {

    public function index() {
        $grades = Grade::all();
        return view('pages.grades.index', compact('grades'));
    }

    public function create() {

    }

    public function store(GradeRequest $request, Grade $grade) {

        try {
            $grade = new Grade();
            $grade->name = ['ar' => $request->name, 'en' => $request->name_en];
            $grade->notes = $request->notes;
            $grade->save();
            return redirect()->route('grades.index')->with('success', trans('grades.add_success'));
        }

        catch (\Exception $e){
            return redirect()->route('grades.index')->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show(Grade $grade) {

    }

    public function edit(grade $grade) {

    }

    public function update(GradeRequest $request, grade $grade) {
        try {
            $grade->update([
                $grade->name = ['ar' => $request->name, 'en' => $request->name_en],
                $grade->notes = $request->notes,
            ]);
            return redirect()->route('grades.index')->with('success', trans('grades.edit_success'));
        }

        catch (\Exception $e){
            return redirect()->route('grades.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(grade $grade) {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Row Deleted Successfully!');
    }
}
