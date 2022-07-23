<?php

namespace Modules\School\Database\Seeders;

use Modules\School\Entities\School;
use Modules\Student\Entities\Student;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::factory(5)->create()->each(function($q){
            $school_id = $q->id;
            Student::factory(20)->create([
                'school_id' => $school_id,
            ]);
        });
    }
}
