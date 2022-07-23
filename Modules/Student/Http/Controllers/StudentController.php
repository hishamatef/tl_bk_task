<?php


namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CrudInterface;
use Illuminate\Support\Facades\Response;
use Modules\School\Entities\School;
use Modules\Student\Entities\Student;
use Modules\Student\Http\Requests\StudentRequest;
use Throwable;

class StudentController extends Controller
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
        $students = $this->student->all();
        return view('student::index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('student::create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        try {
            $this->student->store($request->validated());
            toastr()->success(__('public.success_create'));
            return redirect()->route('students.index');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**12
     * Display the specified resource.
     *
     * @param \Modules\Student\Entities\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student::show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Modules\Student\Entities\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $schools = School::all();
        return view('student::edit', compact('student', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Student\Entities\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        try {
            $this->student->update($request->validated(), $student);
            toastr()->success(__('public.success_update'));
            return redirect()->route('students.index');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Modules\Student\Entities\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return Response::json(['status' => 'success', 'message' => __('public.success_delete')]);
        } catch (Throwable $e) {
            return Response::json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
