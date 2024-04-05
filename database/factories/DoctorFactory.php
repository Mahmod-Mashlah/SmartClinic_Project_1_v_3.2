<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //

            'description' => $this->faker->text(50) ,
            'work_day' => $this->faker->text(50) ,
            'experiance' => $this->faker->text(50) ,
            'specialize' => $this->faker->text(50) ,


            'previewDuration(Minutes)'=>$this->faker->numberBetween(1,30),
            'evalution'=>$this->faker->numberBetween(1,30),


            'start_time' => $this->faker->time() ,
            'end_time' => $this->faker->time() ,


            'Clinic_id'=>$this->faker->numberBetween(1,30),
            'employee_id'=>$this->faker->numberBetween(1,30),



        ];
    }
}
