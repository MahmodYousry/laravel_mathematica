<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSections;
use App\Models\Teacher;

class SectionController extends Controller
{

    public function index()
    {
        $grades = Grade::with(['sections'])->get();
        $grades_list = Grade::all();
        $teachers = Teacher::all();
        return view('pages.sections.index', compact('grades', 'grades_list', 'teachers'));
    }

    public function create()
    {
        //
    }

    public function store(StoreSections $request)
    {

        try {

            $validated = $request->validated();
            $Sections = new Section();
            $Sections->section_name = ['ar' => $request->section_name, 'en' => $request->section_name_en];
            $Sections->grade_id = $request->grade_id;
            $Sections->classroom_id = $request->class_id;
            $Sections->status = 1;
            $Sections->save();

            $Sections->teachers()->attach($request->teacher_id);

            return redirect()->back()->with('success', trans('action.data_save_success'));

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(StoreSections $request)
    {
        try {
            $validated = $request->validated();
            $Sections = Section::findOrFail($request->id);

            $Sections->section_name = ['ar' => $request->section_name, 'en' => $request->section_name_en];
            $Sections->grade_id     = $request->grade_id;
            $Sections->classroom_id = $request->class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }

            // Update Pivote Table
            if (isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id);
            } else {
                $Sections->teachers()->sync(array());
            }

            $Sections->save();

            return redirect()->route('sections.index')->with('success', trans('action.data_edit_success'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(request $request)
    {
        if (Section::findOrFail($request->id)->delete()) {
            return redirect()->route('sections.index')->with('success', trans('action.data_delete_success'));
        } else {
            return redirect()->route('sections.index')->with('success', trans('action.data_delete_fail'));
        }
    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("class_name", "id");
        return $list_classes;
    }

}
