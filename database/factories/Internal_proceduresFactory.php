<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internal_procedures>
 */
class Internal_proceduresFactory extends Factory
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


        'name' => $this->faker->text(10) ,
        'type' => $this->faker->text(10) ,
        'place' => $this->faker->text(10) ,

        'examination_id' => $this->faker->numberBetween(1,30),
        'treatment_id' => $this->faker->numberBetween(1,30),

        ];
    }
}
