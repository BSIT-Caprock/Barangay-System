<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            // 1
            ['name' => 'Punong Barangay'],
            // 2
            ['name' => 'Barangay Secretary'],
            // 3
            ['name' => 'Barangay Treasurer'],
            // 4
            ['name' => 'Barangay Kagawad'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
