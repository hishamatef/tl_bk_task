<?php

namespace Modules\Student\Http\Services;

use Modules\Student\Entities\Student;
use App\Http\Interfaces\CrudInterface;

class StudentService implements CrudInterface
{
    private $model;
    public function __construct(Student $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        $students = $this->model->all();
        return $students;
    }
    public function store(array $data)
    {
        $student = $this->model->create($data);
        return $student;
    }

    public function update(array $data, $student)
    {
        $student->update($data);
        return $student;
    }
}
