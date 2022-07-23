<?php

namespace Modules\Student\Console\Commands;

use Modules\School\Entities\School;
use Illuminate\Console\Command;
use Modules\Student\Events\SendReOrderEmailEvent;
use Illuminate\Support\Facades\DB;
use Modules\Student\Entities\Student;

class ReOrderStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:reOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reorder all student by school ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $schools = School::all();
        foreach ($schools as $school) {
            $students = Student::where('school_id',$school->id)->orderBy('order','ASC')->get();
            $studentsCount = count($students);
            if($studentsCount == 0 || $studentsCount == (int) $students[$studentsCount-1]->order) {
                continue;
            } else {
                foreach ($students as $key => $student) {
                    Student::where('id',$student->id)->update(['order' => $key + 1]);
                }
            }
        }
        $this->info('ReOrder command done successfully!');
        event(new SendReOrderEmailEvent());
    }
}
