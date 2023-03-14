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
            'corporation_id' => 1,
            'name' => 'Павел Дыкин',
            'email' => 'paulrestalabs@gmail.com',
            'password' => '$2y$10$cVhquzPbFV5oPlkLOj8TpuzptMMCv5MPU8c7Sy2wHawhzsR5.7/r6', // 12345678
            'role' => 0,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
