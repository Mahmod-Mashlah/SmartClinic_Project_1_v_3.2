<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
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

    'name' => $this->faker->text(50) ,
    'type_medicine' => $this->faker->text(50) ,
    'type_give' => $this->faker->text(50) ,
    'number_give' => $this->faker->randomNumber(3) ,

    'prescription_id' => $this->faker->numberBetween(1,30) ,


        ];
    }
}
