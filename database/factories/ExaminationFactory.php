<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExaminationFactory extends Factory
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

        'examination_date' => $this->faker->date() ,

        'clinic_id' => $this->faker->numberBetween(1,30),
        'doctor_id' => $this->faker->numberBetween(1,30),
        'patiant_id' => $this->faker->numberBetween(1,30),
        'report_id' => $this->faker->numberBetween(1,30),


        ];
    }
}
