<?php

namespace Database\Factories;

use App\Models\Sex;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inhabitant>
 */
class InhabitantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sexId = fake()->randomElement([
            Sex::MALE,
            Sex::FEMALE,
        ]);

        $gender = [
            Sex::MALE => 'male',
            Sex::FEMALE => 'female',
        ][$sexId];

        return [
            'household_id' => null,
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName($gender),
            'middle_name' => fake()->lastName(),
            'extension_name' => fake()->suffix(),
            'house_id' => null,
            'street_id' => null,
            'zone_id' => null,
            'birth_place_id' => null,
            'birth_date' => fake()->date(),
            'sex_id' => $sexId,
            'civil_status_id' => null,
            'citizenship_id' => null,
            'occupation_id' => null,
            'date_accomplished' => fake()->date(),
        ];
    }
}
