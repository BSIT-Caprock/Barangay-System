<?php

namespace Database\Seeders\Residents;

use App\Models\Locations\BarangayRecord;
use App\Models\Residents\Household;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangay = BarangayRecord::where('barangay', 'Poblacion Dist. I')->latest('created_at')->firstOrFail();

        $numbers = [
            '1010',
            '1020',
            '1030',
        ];

        foreach ($numbers as $number) {
            Household::createRecord([
                'barangay_id' => $barangay->id,
                'number' => $number,
            ]);
        }
    }
}
