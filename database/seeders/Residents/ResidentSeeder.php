<?php

namespace Database\Seeders\Residents;

use App\Models\Locations\Place;
use App\Models\Residents\HouseholdRecord;
use App\Models\Residents\Resident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $place = Place::where([
            ['country', 'Philippines'],
            ['province', 'Leyte'],
            ['city_or_municipality', 'Barugo'],
        ])->firstOrFail();

        $household = HouseholdRecord::where('number', '1010')->latest('created_at')->firstOrFail();

        Resident::createRecord([
            'household_id' => $household->id,
            'last_name' => 'Cruz',
            'middle_name' => 'Go',
            'first_name' => 'Juan',
            //'suffix_id' => 1,
            'birth_place_id' => $place->id,
            'birth_date' => '1999-09-09',
            'gender' => 'M',
            'civil_status' => 'S',
            'citizenship_id' => 1,
            'occupation_id' => 1,
            'residence_id' => 1,
        ]);
    }
}
