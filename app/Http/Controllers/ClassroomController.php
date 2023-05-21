<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Psy\ExecutionLoopClosure;
use App\Http\Requests\StoreClassroom;

class ClassroomController extends Controller
{
    public function index()
    {
        $my_classes = Classroom::all();
        $grades = Grade::all();
        return view('pages.classrooms.index', compact('grades', 'my_classes'));
    }

    public function create()
    {
        $classes = Classroom::all();
        $grades = Grade::all();

        return response()->json(compact('grades', 'classes'));
    }

    public function store(StoreClassroom $request)
    {

        $validatedData = $request->validated();

        try {
            foreach ($validatedData as $data) {
                $classroom = new Classroom();
                $classroom->class_name = ['en' => $data['class_name_en'], 'ar' => $data['class_name']];
                $classroom->grade_id = $data['grade_id'];
                $classroom->save();
            }

            return response()->json(['message' => 'Data saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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

    public function update(Request $request, Classroom $classroom)
    {
        //$validated = $request->validated();

        $validated = $request->validate([
            'class_name' => 'required|string',
            'class_name_en' => 'required|string',
            'grade_id' => 'required|integer',
        ]);

        try {

            $classroom->class_name = ['en' => $request['class_name_en'], 'ar' => $request['class_name']];
            $classroom->grade_id = $request['grade_id'];

            if ($classroom->update()) {
                return redirect()->back()->with('success', trans('action.data_edit_success'));
            } else {
                return redirect()->back()->with('error', trans('action.data_update_fail'));
            }

        }
        catch (\Exception $e ) {
            return redirect()->back()->withErrors([ 'error' => $e->getMessage() ]);
        }

    }

    public function destroy($id)
    {
        try {
            Classroom::findOrFail($id)->delete();
            return redirect()->back()->with('success', trans('action.data_delete_success'));
        }

        catch (\Exception $e ) {
            return redirect()->back()->withErrors([ 'error' => $e->getMessage() ]);
        }
    }

    public function delete_all(Request $request)
    {
        // Make array first because whereIn method needs array of values
        $delete_all_id = explode(",", $request->delete_all_id);
        // Use WhereIn method to look for id matches value in this array
        Classroom::whereIn('id', $delete_all_id)->Delete();
        // redirect
        return redirect()->back()->with('success', trans('action.data_delete_success'));
    }

    public function filter_classes(Request $request) {
        $my_classes = Classroom::where('grade_id', $request->grade_id)->get();
        $grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();
        return view('pages.classrooms.index', [
          'grades' => $grades,
          'my_classes' => $my_classes,
          'details' => $Search
        ]);
      }

}
