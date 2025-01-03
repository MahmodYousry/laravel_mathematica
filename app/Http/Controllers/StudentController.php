<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{

    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return $this->student->getStudents();
    }

    public function create()
    {
        return $this->student->createStudent();
    }

    public function store(StoreStudentsRequest $request)
    {
        return $this->student->storeStudent($request);
    }

    public function edit($id)
    {
        return $this->student->editStudent($id);
    }

    public function show($id)
    {
        return $this->student->showStudent($id);
    }

    public function update(StoreStudentsRequest $request)
    {
        return $this->student->updateStudent($request);
    }

    public function destroy($id)
    {
        return $this->student->deleteStudent($id);
    }


    // ========= Other Methods =========

    // get classrooms for ajax call
    public function Get_classrooms($id)
    {
        return $this->student->Get_classrooms($id);
    }

    // get sections for ajax call
    public function Get_Sections($id)
    {
        return $this->student->Get_Sections($id);
    }

    // upload Attachments
    public function upload_attachments(Request $request) {
        return $this->student->upload_attachments($request);
    }

    // Download Attachments
    public function downloadAttachments($studentName, $fileName) {
        return $this->student->download_attachments($studentName, $fileName);
    }

    // Delete Attachments
    public function delete_attachment(Request $request)
    {
        return $this->student->delete_attachment($request);
    }
}
