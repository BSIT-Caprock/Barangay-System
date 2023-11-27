<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\EducationalLevel;
use App\Models\Sex;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FirstTimeJobSeeker>
 */
class FirstTimeJobSeekerFactory extends Factory
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
            'birth_date' => fake()->date(),
            'sex_id' => fake()->randomElement([Sex::MALE, Sex::FEMALE]),
            'educational_level_id' => EducationalLevel::COLLEGE,
            'course_id' => Course::firstOrCreate(['name' => 'BS Information Technology'])->id,
            'date_applied' => now()->toDateString(),
        ];
    }
}
