<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class CompanyFactory extends Factory
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
            'name' => 'Точка 1',
            'slug' => 'first-point',
            'server' => 'https://retsolabs300821demo.iiko.it:443/resto',
            'login' => 'rlabs',
            'password' => 'da4b9237bacccdf19c0760cab7aec4a8359010b0'
        ];
    }
}
