<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement([
            'female',
            'male',
        ]);

        $gender_id = [
            'male' => 1,
            'female' => 2,
        ][$gender];

        return [
            'barangay_id' => 1,
            'household_id' => null,
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName($gender),
            'middle_name' => fake()->lastName(),
            'extension_name' => fake()->suffix(),
            'house_number' => fake()->numberBetween(1000, 9999),
            'street_id' => null,
            'zone_id' => null,
            'birth_place_id' => null,
            'birth_date' => fake()->date(),
            'gender_id' => null,
            'civil_status_id' => null,
            'citizenship_id' => null,
            'occupation_id' => null,
            'date_accomplished' => fake()->date(),
        ];
    }
}
