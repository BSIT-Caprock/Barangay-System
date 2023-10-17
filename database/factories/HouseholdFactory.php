<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdRecord>
 */
class HouseholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key_id' => Household::factory(), // Create a related HouseholdKey
            'barangay_id' => 1, // Replace with the appropriate barangay_id
            'number' => $this->faker->numberBetween(100, 999),
        ];
    }
}
