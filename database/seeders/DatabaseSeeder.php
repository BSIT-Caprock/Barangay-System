<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BirthPlaceSeeder::class,
            SexSeeder::class,
            CivilStatusSeeder::class,
            CitizenshipSeeder::class,
            OccupationSeeder::class,
            ZoneSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            EducationalLevelSeeder::class,
        ]);
    }
}
