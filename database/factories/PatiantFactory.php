<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patiant>
 */
class PatiantFactory extends Factory
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


        'Careear' => $this->faker->text(15) ,
        'description' => $this->faker->text(15) ,
        'weigh' => $this->faker->numberBetween(10,150) ,

        'clinic_id'=>$this->faker->numberBetween(1,30),
        'doctor_id'=>$this->faker->numberBetween(1,30),
        'user_id'=>$this->faker->numberBetween(1,30),



        ];
    }
}
