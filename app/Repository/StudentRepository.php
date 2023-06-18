<?php

namespace App\Repository;

use Exception;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\Blood_Type;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{

    public function getStudents()
    {
        $students = Student::all();
        return view('pages.students.index', compact('students'));
    }

    public function createStudent()
    {

        $data['grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['blood_type'] = Blood_Type::all();

        return view('pages.students.create', $data);
    }

    public function Get_classrooms($id)
    {

        $list_classes = Classroom::where("grade_id", $id)->pluck("class_name", "id");
        return $list_classes;
    }

    //Get Sections
    public function Get_Sections($id)
    {

        $list_sections = Section::where("classroom_id", $id)->pluck("section_name", "id");
        return $list_sections;
    }

    public function editStudent($id) {

        // get the data using student id
        $student =  Student::findOrFail($id);

        // other data needed to change options
        $data['grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['blood_type'] = Blood_Type::all();

        // return the page with all data needed for edit
        return view('pages.students.edit', $data, compact('student'));
    }

    public function storeStudent($request)
    {
        try {
            $students = new Student();

            $students->name             = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email            = $request->email;
            $students->password         = Hash::make($request->password);
            $students->gender_id        = $request->gender_id;
            $students->nationality_id   = $request->nationality_id;
            $students->blood_id         = $request->blood_id;
            $students->birth_date       = $request->birth_date;
            $students->grade_id         = $request->grade_id;
            $students->classroom_id     = $request->classroom_id;
            $students->section_id       = $request->section_id;
            $students->parent_id        = $request->parent_id;
            $students->academic_year    = $request->academic_year;

            $students->save();

            return redirect()->route('students.create')->with('success', trans('action.data_save_success'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateStudent($request)
    {
        try {

            // get the student data using the id
            $editStudent = Student::findOrFail($request->id);

            // fields
            $editStudent->name             = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $editStudent->email            = $request->email;
            $editStudent->password         = Hash::make($request->password);
            $editStudent->gender_id        = $request->gender_id;
            $editStudent->nationality_id   = $request->nationality_id;
            $editStudent->blood_id         = $request->blood_id;
            $editStudent->birth_date       = $request->birth_date;
            $editStudent->grade_id         = $request->grade_id;
            $editStudent->classroom_id     = $request->classroom_id;
            $editStudent->section_id       = $request->section_id;
            $editStudent->parent_id        = $request->parent_id;
            $editStudent->academic_year    = $request->academic_year;

            // save them
            $editStudent->save();

            // return with success
            return redirect()->route('students.index')->with('success', trans('action.data_edit_success'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteStudent($id) {
        try {
            Student::destroy($id);
            return redirect()->route('students.index')->with('success', trans('action.data_delete_success'));
        } catch (\Exception $e) {
            return 'Error deleting student: ' . $e->getMessage();
        }
    }
}
