<?php

namespace App\Repository;

use Exception;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\My_Parent;
use App\Models\Blood_Type;
use App\Models\Nationality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function showStudent($id) {
        $studentInfo = Student::findOrFail($id);
        return view('pages.students.show', compact('studentInfo'));
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
        DB::beginTransaction();

        try {
            $newStudent = new Student();

            $newStudent->name             = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $newStudent->email            = $request->email;
            $newStudent->password         = Hash::make($request->password);
            $newStudent->gender_id        = $request->gender_id;
            $newStudent->nationality_id   = $request->nationality_id;
            $newStudent->blood_id         = $request->blood_id;
            $newStudent->birth_date       = $request->birth_date;
            $newStudent->grade_id         = $request->grade_id;
            $newStudent->classroom_id     = $request->classroom_id;
            $newStudent->section_id       = $request->section_id;
            $newStudent->parent_id        = $request->parent_id;
            $newStudent->academic_year    = $request->academic_year;

            $newStudent->save();

            // insert img
            if( $request->hasfile('photos') ) // if there is photos selected
            {

                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$newStudent->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename       = $name;
                    $images->imageable_id   = $newStudent->id;
                    $images->imageable_type = 'App\Models\Student';

                    $images->save();
                }
            }

            DB::commit(); // insert data

            return redirect()->route('students.create')->with('success', trans('action.data_save_success'));
        } catch (\Exception $e) {
            DB::rollback();
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

    public function upload_attachments($request) {
        foreach ($request->file('photos') as $file) {

            $file_name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name, $file_name, 'upload_attachments');

            // insert into the database
            $images = new Image();
            $images->filename       = $file_name;
            $images->imageable_id   = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        return redirect()->route('students.show', $request->student_id)->with('success', trans('action.data_save_success'));
    }

    public function delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in database
         image::where('id',$request->id)->where('filename',$request->filename)->delete();

        // return redirect
        return redirect()->route('students.show', $request->student_id)
            ->with('success', trans('action.data_delete_success'));
    }

    public function download_attachments($studentName, $fileName)
    {
        return response()->download(public_path('attachments/students/'.$studentName.'/'.$fileName));
    }


}
