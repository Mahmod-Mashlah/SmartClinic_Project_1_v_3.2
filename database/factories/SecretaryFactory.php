<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Secretary>
 */
class SecretaryFactory extends Factory
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

    'employee_id'=>$this->faker->numberBetween(1,30),
    'expirance' => $this->faker->text(50) ,
    'TypingSpeed'=>$this->faker->numberBetween(1,500),


        ];
    }
}
