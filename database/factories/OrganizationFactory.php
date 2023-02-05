<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Resta.Labs',
            'slug' => 'resta-labs',
            'server' => 'https://restalabschein250322-co.iiko.it:443/resto',
            'login' => 'rlabs',
            'password' => 'da4b9237bacccdf19c0760cab7aec4a8359010b0'
        ];
    }
}
