<?php

namespace Database\Seeders\Locations;

use App\Models\Locations\BarangayRecord;
use App\Models\Locations\House;
use App\Models\Locations\Street;
use App\Models\Locations\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangay = BarangayRecord::where('barangay', 'Poblacion Dist. I')
            ->latest('created_at')
            ->firstOrFail();

        $zone = Zone::where([
                ['barangay_id', $barangay->id],
                ['zone', 'Zone I'],
            ])->firstOrFail();

        $street = Street::where([
                ['barangay_id', $barangay->id],
                ['street', 'Abanilla St.'],
            ])->firstOrFail();

        $numbers = [
                '100-A',
                '101-B',
                '102-C',
            ];

        foreach ($numbers as $number) {
            House::create([
                'barangay_id' => $barangay->id,
                'zone_id' => $zone->id,
                'street_id' => $street->id,
                'number' => $number
            ]);
        }
    }
}
