<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use Exception;

class TeacherRepository implements TeacherRepositoryInterface {

    public function getAllTeachers() {
        return Teacher::all();
    }

    public function getAllSpecialization() {
        return Specialization::all();
    }

    public function getAllGender() {
       return Gender::all();
    }

    public function storeTeachers($request) {

        try {
            $Teachers = new Teacher();

            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;

            $Teachers->save();

            return redirect()->route('teachers.create')->with('success', trans('action.data_save_success'));
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }

    public function updateTeachers($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);

            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;

            $Teachers->save();

            return redirect()->route('teachers.index')->with('success', trans('action.data_edit_success'));
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function deleteTeachers($request)
    {
        Teacher::findOrFail($request->id)->delete();
        return redirect()->route('teachers.index')->with('error', trans('action.data_delete_success'));
    }

}
