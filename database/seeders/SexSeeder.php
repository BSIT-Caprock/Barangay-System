<?php

namespace Database\Seeders;

use App\Models\Sex;
use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        Sex::create(['name' => 'Male']);
        // 2
        Sex::create(['name' => 'Female']);
    }
}
