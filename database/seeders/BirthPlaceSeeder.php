<?php

namespace Database\Seeders;

use App\Models\BirthPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SplFileObject;

class BirthPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = new SplFileObject(database_path('data/birth_places.csv'));
        $file->setFlags(
            SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE
        );
        // skip first line
        $file->next();
        // parse each line as csv
        while ($data = $file->fgetcsv()) {
            $model = BirthPlace::create([
                'province' => $data[1],
                'city_or_municipality' => $data[0],
            ]);
            // $model->id = $model->newUniqueId();
            // dump($model->getAttributes());
        }
        // close file
        $file = null;
    }
}
