<?php

namespace Database\Factories;

use App\Models\Disability;
use App\Models\DisabilityCause;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonWithDisability>
 */
class PersonWithDisabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'extension_name' => fake()->suffix(),
            'address' => fake()->address(),
            'disability_id' => Disability::inRandomOrder()->first(),
            'disability_cause_id' => DisabilityCause::inRandomOrder()->first(),
        ];
    }
}
