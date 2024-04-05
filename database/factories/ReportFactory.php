<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
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


            'clinic_id'=>$this->faker->numberBetween(1,30),
            'doctor_id'=>$this->faker->numberBetween(1,30),
            'patiant_id'=>$this->faker->numberBetween(1,30),
            'secretary_id'=>$this->faker->numberBetween(1,30),
            'lap_id'=>$this->faker->numberBetween(1,30),


        ];
    }
}
