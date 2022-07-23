<?php

namespace Modules\Student\Database\factories;

use Modules\School\Entities\School;
use Modules\Student\Entities\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $school_id = $this->faker->numberBetween(1, School::count());
        return [
            'name' => $this->faker->name(),
            'school_id' => $school_id,
        ];
    }
}
