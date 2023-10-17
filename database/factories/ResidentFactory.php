<?php

namespace Database\Factories;

use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResidentRecord>
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
        $g = fake()->randomElement([
            'female',
            'male',
        ]);

        $gender = [
            'female' => Gender::Female->value,
            'male' => Gender::Male->value,
        ][$g];

        return [
            'key_id' => Resident::factory(),
            'household_id' => 1,
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName($g),
            'middle_name' => fake()->lastName(),
            'suffix' => fake()->suffix(),
            'birth_place' => fake()->randomElement([
                fake()->city(),
                fake()->municipality(),
            ]),
            'birth_date' => fake()->date(),
            'gender' => $gender,
            'civil_status' => fake()->randomElement(
                array_column(CivilStatus::cases(), 'value')
            ),
            'citizenship' => 'Filipino',
            'occupation' => fake()->word(),
            'house_number' => fake()->numberBetween(1000, 9999),
            'street_name' => fake()->streetName(),
            'area_name' => fake()->streetSuffix(),
        ];
    }
}
