<?php

namespace Database\Factories;

use App\Factories\Concerns\ForCurrentBarangay;
use App\Models\Street;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Family>
 */
class FamilyFactory extends Factory
{
    use ForCurrentBarangay;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function forLocation($model): static
    {
        return $this->for($model, 'location');
    }

    public function forRandomLocation(): static
    {
        return $this->forLocation(fake()->randomElement([
            Zone::inRandomOrder()->firstOr(fn () => Zone::create(['name' => 'Test Zone'])),
            Street::inRandomOrder()->firstOr(fn () => Street::create(['name' => 'Test Street'])),
        ]));
    }
}
