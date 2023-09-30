<?php

namespace App\Repository;

interface StudentGraduatedRepositoryInterface {

    public function index();

    public function create();

    public function softDelete($request);

    public function returnStudent($request);

    public function destroy($id);

}
