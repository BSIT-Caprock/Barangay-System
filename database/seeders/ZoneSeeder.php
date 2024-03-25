<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            'Zone I',
            'Zone II',
            'Zone III',
            'Zone IV',
            'Zone V',
            'Zone VI',
        ];
        foreach ($zones as $zone) {
            Zone::create([
                'name' => $zone,
            ]);
        }
    }
}
