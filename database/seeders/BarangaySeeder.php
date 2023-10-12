<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    public static string $region = 'Eastern Visayas';

    public static string $province = 'Leyte';

    public static string $municipality = 'Barugo';

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
        foreach (self::$barangays as $barangay) {
            Barangay::createWithNewKey([
                'region' => self::$region,
                'province' => self::$province,
                'city_or_municipality' => self::$municipality,
                'barangay' => $barangay,
            ]);
        }
    }
}
