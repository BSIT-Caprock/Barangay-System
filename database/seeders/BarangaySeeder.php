<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SplFileObject;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = new SplFileObject(database_path('data/barangays.csv'));
        $file->setFlags(
            SplFileObject::READ_AHEAD | 
            SplFileObject::SKIP_EMPTY | 
            SplFileObject::DROP_NEW_LINE
        );
        // skip first line
        $file->next(); 
        // parse each line as csv
        while ($data = $file->fgetcsv()) {
            Barangay::create([
                'name' => $data[0],
            ]);
        }
        // close file
        $file = null;
    }
}
