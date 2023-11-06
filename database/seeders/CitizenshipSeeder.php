<?php

namespace Database\Seeders;

use App\Models\Citizenship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitizenshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Citizenship::create([
            'name' => 'Filipino',
        ]);
    }
}
