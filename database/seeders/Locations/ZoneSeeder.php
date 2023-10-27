<?php

namespace Database\Seeders\Locations;

use App\Models\Locations\BarangayRecord;
use App\Models\Locations\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangay = BarangayRecord::where('barangay', 'Poblacion Dist. I')
            ->latest('created_at')
            ->firstOrFail();

        $zones = [
            'Zone I',
            'Zone IA',
            'Zone II',
            'Zone III',
            'Zone IV',
            'Zone V',
            'Zone VI',
        ];

        foreach ($zones as $zone) {
            Zone::create([
                'barangay_id' => $barangay->id,
                'zone' => $zone,
            ]);
        }
    }
}
