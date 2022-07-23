<?php

namespace Modules\School\Http\Services;

use App\Http\Interfaces\CrudInterface;
use Modules\School\Entities\School;

class SchoolService implements  CrudInterface
{
    private $model;

    public function __construct(School $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $schools = $this->model->all();
        return $schools;
    }

    public function store(array $data)
    {
        $school = $this->model->create($data);
        return $school ;
    }

    public function update(array $data, $school)
    {
        $school->update($data);
        return $school;
    }

}
