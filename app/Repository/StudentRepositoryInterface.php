<?php

namespace App\Repository;

interface StudentRepositoryInterface {

    // Get Students
    public function getStudents();

    // Get Add Form Student
    public function createStudent();

    // Edit Students
    public function editStudent($id);

    // Store Student
    public function storeStudent($request);

    // Update Student
    public function updateStudent($request);

    // Delete Student
    public function deleteStudent($id);

    // Get classrooms
    public function Get_classrooms($id);

    //Get Sections
    public function Get_Sections($id);

}
