<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * This seeder is used for the test database.
 * Model factories are used to generate fake data.
 */
class TestDatabaseSeeder extends Seeder
{
    // prevent models from dispatching events
    // use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            Locations\PlaceSeeder::class,
            Locations\BarangaySeeder::class,
            Locations\ZoneSeeder::class,
            Locations\StreetSeeder::class,
            Locations\HouseSeeder::class,

            Lists\CitizenshipSeeder::class,
            Lists\OccupationSeeder::class,
            Lists\SuffixSeeder::class,

            Residents\HouseholdSeeder::class,
            Residents\ResidentSeeder::class,
            
            Personnel\PersonnelSeeder::class,
        ]);
    }
}
