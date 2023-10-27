<?php

namespace Database\Seeders\Locations;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceSeeder extends Seeder
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
                DB::table('places')->insert([
                    'country' => 'Philippines',
                    'province' => $data['1'],
                    'city_or_municipality' => $data['0'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvfile);
    }
}
