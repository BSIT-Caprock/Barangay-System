<?php

namespace Database\Seeders;

use App\Models\CivilStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $civilStatuses = [
            // 1
            ['name' => 'Single'],
            // 2
            ['name' => 'Married'],
            // 3
            ['name' => 'Widow/Widower'],
            // 4
            ['name' => 'Separated'],
        ];

        foreach ($civilStatuses as $civilStatus) {
            CivilStatus::create($civilStatus);
        }
    }
}
