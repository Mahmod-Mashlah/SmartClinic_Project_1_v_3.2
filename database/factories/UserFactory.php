<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Fname' => $this->faker->firstName($gender = 'male'|'female'),
            'lname' => $this->faker->firstName($gender = 'male'|'female'),
            'Birthday' => $this->faker->date(),
            'Image' => $this->faker->text(5),
            'Gender' => $this->faker->word(),
            'address' => $this->faker->country() ,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->unique()->password(2,9),
    //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),



        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
