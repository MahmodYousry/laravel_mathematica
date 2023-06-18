<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeachers;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        $teachers = $this->Teacher->getAllTeachers();
        return view('pages.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $specializations = $this->Teacher->getAllSpecialization();
        $genders = $this->Teacher->getAllGender();
        return view('pages.teachers.create', compact('specializations', 'genders'));
    }

    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $teacher = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->getAllSpecialization();
        $genders = $this->Teacher->getAllGender();
        return view('pages.teachers.edit', compact('teacher','specializations','genders'));
    }

    public function update(Request $request)
    {
        return $this->Teacher->updateTeachers($request);
    }

    public function destroy(Request $request)
    {
        return $this->Teacher->deleteTeachers($request);
    }
}
