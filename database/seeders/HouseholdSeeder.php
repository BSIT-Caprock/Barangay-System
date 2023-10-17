<?php

namespace Database\Seeders;

use App\Models\HouseholdRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HouseholdRecord::factory(10)->create();
    }
}
