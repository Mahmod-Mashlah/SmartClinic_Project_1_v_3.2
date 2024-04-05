<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookAdate>
 */
class BookAdateFactory extends Factory
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


            'date' => $this->faker->date() ,
            'time' => $this->faker->time() ,
            'doctor_id'=>$this->faker->numberBetween(1,30),
            'clinic_id'=>$this->faker->numberBetween(1,30),
            'patiant_id'=>$this->faker->numberBetween(1,30),


        ];
    }
}
