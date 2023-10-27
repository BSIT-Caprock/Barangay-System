<?php

namespace Database\Seeders\Locations;

use App\Models\Locations\Barangay;
use App\Models\Locations\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    public static array $barangays = [
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

        foreach (self::$barangays as $barangay) {
            Barangay::createRecord([
                'place_id' => $place->id,
                'barangay' => $barangay,
            ]);
        }
    }
}
