<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Interfaces\CrudInterface;
use Modules\Student\Entities\Student;
use Modules\Student\Http\Requests\StudentRequest;
use Modules\Student\Http\Resources\StudentResource;
use Throwable;

class StudentController extends ApiController
{
    protected $student;

    public function __construct(CrudInterface $student)
    {
        $this->student = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $students = Student::all();
        return $this->ok('',StudentResource::collection($students)->resolve());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        try{
            $student = $this->student->store($request->validated());
            return $this->ok(__('public.success_create'),[new StudentResource($student)] );
        }catch(Throwable $e){
            return $this->invalid([$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Student\Entities\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return $this->ok('',[new StudentResource($student)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Student\Entities\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        try{
            $student_update = $this->student->update($request->validated(), $student);
            return $this->ok('',[new StudentResource($student_update)], null, __('public.success_update'));
        }catch(Throwable $e){
            return $this->invalid([$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Student\Entities\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try{
            $student->delete();
            return $this->ok(__('public.success_delete'));
        }catch(Throwable $e){
            return $this->invalid([$e->getMessage()]);
        }
    }
}
