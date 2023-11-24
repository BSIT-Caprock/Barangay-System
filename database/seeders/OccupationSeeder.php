<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Seeder;
use SplFileObject;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = new SplFileObject(database_path('data/occupations.csv'));
        $file->setFlags(
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );
        // skip first line
        $file->next();
        // parse each line as csv
        while ($data = $file->fgetcsv()) {
            Occupation::create([
                'name' => $data[0],
            ]);
        }
        // close file
        $file = null;
    }
}
