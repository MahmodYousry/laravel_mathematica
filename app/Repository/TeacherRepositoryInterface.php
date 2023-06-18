<?php

namespace App\Repository;

interface TeacherRepositoryInterface {

    // get all teachers
    public function getAllTeachers();

    // get all specialization
    public function getAllSpecialization();

    // get all Genders
    public function getAllGender();

    // store teachers
    public function storeTeachers($request);

    // edit teachers
    public function editTeachers($request);

    // Update teachers
    public function updateTeachers($request);

    // Delete teachers
    public function deleteTeachers($request);

}
