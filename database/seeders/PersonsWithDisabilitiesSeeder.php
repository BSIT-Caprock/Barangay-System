<?php

namespace Database\Seeders;

use App\Models\Disability;
use App\Models\DisabilityCause;
use Illuminate\Database\Seeder;

class PersonsWithDisabilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Disability::create(['name' => 'Deaf or Hard of Hearing']);
        Disability::create(['name' => 'Intellectual Disability']);
        Disability::create(['name' => 'Learning Disability']);
        Disability::create(['name' => 'Mental Disability']);
        Disability::create(['name' => 'Physical Disablity / Orthopedic']);
        Disability::create(['name' => 'Psychosocial Disability']);
        Disability::create(['name' => 'Speech & Language Impairment']);
        Disability::create(['name' => 'Visual Disability']);
        Disability::create(['name' => 'Cancer (RA 11215)']);
        Disability::create(['name' => 'Rare Disease (RA 10747)']);

        DisabilityCause::create(['name' => 'Autism (Congenital/Inborn)']);
        DisabilityCause::create(['name' => 'ADHD (Congenital/Inborn)']);
        DisabilityCause::create(['name' => 'Cerebral Palsy (Congenital/Inborn)']);
        DisabilityCause::create(['name' => 'Down Syndrome (Congenital/Inborn)']);
        DisabilityCause::create(['name' => 'Chronic Illness (Acquired)']);
        DisabilityCause::create(['name' => 'Cerebral Palsy (Acquired)']);
        DisabilityCause::create(['name' => 'Injury (Acquired)']);
    }
}
