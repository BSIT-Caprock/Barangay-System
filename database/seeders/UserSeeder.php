<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barangay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User */
        $user = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@example.com',
            'password' => 'super',
        ]);
        
        $user->assignRole('Superadministrator');

        $poblacion1Sect = User::create([
            'name' => 'Pob. 1 Secretary',
            'email' => 'sec@pob1.com',
            'password' => 'pob1',
            'barangay_id' => Barangay::where(['name' => 'Poblacion Dist. I'])->first()->id,
        ]);

        $poblacion1Sect->assignRole('Barangay Secretary');

    }
}
