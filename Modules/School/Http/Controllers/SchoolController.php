<?php


namespace Modules\School\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CrudInterface;
use Illuminate\Support\Facades\Response;
use Modules\School\Entities\School;
use Modules\School\Http\Requests\SchoolRequest;
use Modules\Student\Entities\Student;
use Throwable;

class SchoolController extends Controller
{
    protected $school;

    public function __construct(CrudInterface $school)
    {
        $this->school = $school;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = $this->school->all();

        return view('school::index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolRequest $request)
    {
        try {
            $this->school->store($request->validated());
            toastr()->success(__('public.success_create'));
            return redirect()->route('schools.index');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \Modules\School\Entities\School $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('school::show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Modules\School\Entities\School $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('school::edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Modules\School\Entities\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolRequest $request, School $school)
    {
        try {
            $this->school->update($request->validated(), $school);
            toastr()->success(__('public.success_update'));
            return redirect()->route('schools.index');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Modules\School\Entities\School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        try {
            if (Student::where('school_id', $school->id)->count() > 0) {
                return Response::json(['status' => 'error', 'message' => __('public.error_delete')]);
            }
            $school->delete();
            return Response::json(['status' => 'success', 'message' => __('public.success_delete')]);
        } catch (Throwable $e) {
            return Response::json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
