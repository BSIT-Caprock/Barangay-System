<?php

namespace Database\Seeders\Lookups;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuffixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suffixes = [
            ['suffix' => 'Jr'],
            ['suffix' => 'Sr'],
            ['suffix' => 'I'],
            ['suffix' => 'II'],
            ['suffix' => 'III'],
            ['suffix' => 'IV'],
            ['suffix' => 'V'],
        ];
        DB::table('suffixes')->insert($suffixes);
    }
}
