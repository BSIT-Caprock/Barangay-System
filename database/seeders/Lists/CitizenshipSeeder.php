<?php

namespace Database\Seeders\Lists;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitizenshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('citizenships')->insertOrIgnore(['citizenship' => 'Filipino']);
    }
}
