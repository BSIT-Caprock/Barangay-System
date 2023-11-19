<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangay = Barangay::where('name', 'Poblacion Dist. I')->first();
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
                'barangay_id' => $barangay->id,
                'name' => $zone,
            ]);
        }
    }
}
