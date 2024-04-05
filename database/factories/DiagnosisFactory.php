<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnosis>
 */
class DiagnosisFactory extends Factory
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

    'visit_id'=>$this->faker->numberBetween(1,30),

        ];
    }
}
