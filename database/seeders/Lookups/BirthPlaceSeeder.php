<?php

namespace Database\Seeders\Lookups;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BirthPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvfile = fopen('database/data/MunCit_Prov.csv', 'r');
        
        $firstline = true;
        while (($data = fgetcsv($csvfile, null, ',')) !== false) {
            if (!$firstline) {
                DB::table('birth_places')->insert([
                    'city_or_municipality' => $data['0'],
                    'province' => $data['1'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvfile);
    }
}
