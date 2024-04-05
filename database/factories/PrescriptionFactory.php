<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'prescription_date' => $this->faker->date() ,
            'note' => $this->faker->text(50) ,
            'treatment_id'=>$this->faker->numberBetween(1,30),

        ];
    }
}
