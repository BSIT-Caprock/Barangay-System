<?php

namespace Database\Factories;

use App\Models\Inhabitant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyMember>
 */
class FamilyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_id' => FamilyFactory::new(),
            'inhabitant_id' => InhabitantFactory::new(),
            'is_lgbtq' => fake()->boolean(),
            'has_disability' => fake()->boolean(),
            'has_disease' => fake()->boolean(),
            'is_pregnant' => fake()->boolean(),
            'pregnancy_due' => fake()->date(),
        ];
    }
}
