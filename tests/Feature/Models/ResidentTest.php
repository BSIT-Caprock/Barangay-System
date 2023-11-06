<?php

namespace Tests\Feature\Models;

use App\Models\Household;
use App\Models\Resident;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\BirthPlaceSeeder;
use Database\Seeders\CitizenshipSeeder;
use Database\Seeders\CivilStatusSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\OccupationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResidentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            BarangaySeeder::class,
            BirthPlaceSeeder::class,
            GenderSeeder::class,
            CivilStatusSeeder::class,
            CitizenshipSeeder::class,
            OccupationSeeder::class,
        ]);
        Household::factory()->create();
    }

    public function test_can_be_randomly_created()
    {
        $resident = Resident::factory()->create();
        $this->assertModelExists($resident);
    }

    public function test_history_must_be_inserted_when_created()
    {
        $resident = Resident::factory()->create();
        $this->assertEquals(1, $resident->history->count());
    }

    public function test_history_must_be_inserted_when_updated()
    {
        $resident = Resident::factory()->create();
        $resident->update(['last_name' => 'Testname']);
        $this->assertEquals(2, $resident->history->count());
    }

    public function test_history_must_be_inserted_when_deleted()
    {
        $resident = Resident::factory()->create();
        $resident->delete();
        $this->assertEquals(2, $resident->history->count());
    }

    public function test_history_must_be_inserted_when_restored()
    {
        $this->markTestSkipped();
    }

    public function test_must_have_barangay()
    {
        $resident = Resident::factory()->create();
        $this->assertModelExists($resident->barangay);
    }
    
    public function test_must_have_household_number()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->household_number);
    }
    public function test_must_have_last_name()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->last_name);
    }
    public function test_must_have_first_name()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->first_name);
    }
    public function test_may_have_middle_name()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->middle_name);
    }
    public function test_may_have_extension_name()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->extension_name);
    }
    public function test_may_have_house_number()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->house_number);
    }
    public function test_may_have_street_name()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->street_name);
    }
    
    /**
     * @testdox May have name of subdivision/zone/sitio/purok
     */
    public function test_may_have_zone_name()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->zone_name);
    }
    public function test_may_have_birth_place()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->birth_place);
    }
    
    public function test_may_have_birth_date()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->birth_date);
    }
    public function test_may_have_gender()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->gender);
    }
    public function test_may_have_civil_status()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->civil_status);
    }
    public function test_may_have_citizenship()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->citizenship);
    }
    public function test_may_have_occupation()
    {
        $resident = Resident::factory()->create();
        $this->assertNotNull($resident->occupation);
    }

    public function test_all_entries_must_be_capitalized()
    {
        $this->markTestSkipped();
    }
}
