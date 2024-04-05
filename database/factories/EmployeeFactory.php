<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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

    'status' => $this->faker->boolean() ,
    'jobTitle' => $this->faker->text(50) ,
    'startDate' => $this->faker->date() ,
    'endDate' => $this->faker->date() ,
    'user_id' => $this->faker->unique()->numberBetween(1,30),
        ];


    }
}

