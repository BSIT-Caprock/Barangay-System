<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // list of barangays in Barugo, Leyte
        $barangayNames = [
            'Abango',
            'Amahit',
            'Balire',
            'Balud',
            'Bukid',
            'Bulod',
            'Busay',
            'Cabarasan',
            'Cabolo-An',
            'Calingcaguing',
            'Can-Isak',
            'Canomantag',
            'Cuta',
            'Domogdog',
            'Duka',
            'Guindaohan',
            'Hiagsam',
            'Hilaba',
            'Hinugayan',
            'Ibag',
            'Minuhang',
            'Minuswang',
            'Pikas',
            'Pitogo',
            'Poblacion Dist. I',
            'Poblacion Dist. II',
            'Poblacion Dist. III',
            'Poblacion Dist. IV',
            'Poblacion Dist. V',
            'Poblacion Dist. VI',
            'Pongso',
            'Roosevelt',
            'San Isidro',
            'San Roque',
            'Santa Rosa',
            'Santarin',
            'Tutug-An',
        ];
        // create barangays
        foreach ($barangayNames as $name) {
            Barangay::create([
                'name' => $name,
                'logo' => 'logo',
            ]);
        }
    }
}
