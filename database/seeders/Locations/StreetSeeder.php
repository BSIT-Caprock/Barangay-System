<?php

namespace Database\Seeders\Locations;

use App\Models\Locations\BarangayRecord;
use App\Models\Locations\Street;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangay = BarangayRecord::where('barangay', 'Poblacion Dist. I')
            ->latest('created_at')
            ->firstOrFail();

        $streets = [
            'Abanilla St.',
            'Arcon',
            'Core Shelter',
            'Plaridel St.',
            'Simeona St.',
            'Sto. Rosario St.',
        ];

        foreach ($streets as $street) {
            Street::create([
                'barangay_id' => $barangay->id,
                'street' => $street,
            ]);
        }
    }
}
