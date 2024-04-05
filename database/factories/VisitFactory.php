<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{

    public function definition()
    {
        return [
            //

    'notes' => $this->faker->text(50) ,
    'Day' => $this->faker->text(50) ,
    'Date' => $this->faker->date() ,
    'time' => $this->faker->time() ,
    'clinic_id'=>$this->faker->numberBetween(1,30),
    'doctor_id'=>$this->faker->numberBetween(1,30),
    'patiant_id'=>$this->faker->numberBetween(1,30),
    'treatment_id'=>$this->faker->numberBetween(1,30),

    // 'Day',
    // 'Date',
    // 'time',
    // 'notes',
    // 'clinic_id',
    // 'doctor_id',
    // 'patiant_id',
    // 'treatment_id',

        ];


}
}
