<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Repository\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class graduateController extends Controller
{

    protected $graduated;
    public function __construct(StudentGraduatedRepositoryInterface $Graduated) {
        $this->graduated = $Graduated;
    }

    public function index()
    {
        return $this->graduated->index();
    }

    public function create()
    {
        return $this->graduated->create();
    }

    public function store(Request $request)
    {
        return $this->graduated->softDelete($request);
    }

    public function update(Request $request)
    {
        return $this->graduated->returnStudent($request);
    }

    public function destroy($id)
    {
        return $this->graduated->destroy($id);
    }
}
