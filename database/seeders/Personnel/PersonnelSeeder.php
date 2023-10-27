<?php

namespace Database\Seeders\Personnel;

use App\Models\Locations\BarangayRecord;
use App\Models\Personnel\Personnel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangay = BarangayRecord::where('barangay', 'Poblacion Dist. I')
            ->latest('created_at')
            ->firstOrFail();
        
        Personnel::createRecord([
            'barangay_id' => $barangay->id,
            'last_name' => 'Santiago',
            'middle_name' => 'Ramos',
            'first_name' => 'Pedro',
            'position' => 'secretary',
        ]);
    }
}
