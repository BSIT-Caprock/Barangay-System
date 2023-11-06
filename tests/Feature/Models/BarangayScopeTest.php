<?php

namespace Tests\Feature\Models;

use App\Models\Barangay;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Street;
use App\Models\User;
use App\Models\Zone;
use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangayScopeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
        $user = User::factory()->create(['barangay_id' => 1]);
        $this->actingAs($user);
    }
    public function test_filter_out_other_zones()
    {
        $myZone = Zone::create(['barangay_id' => 1, 'name' => 'My Zone']);
        $otherZone = Zone::create(['barangay_id' => 2, 'name' => 'Other Zone']);
        $zones = Zone::all();
        $this->assertTrue($zones->contains($myZone));
        $this->assertFalse($zones->contains($otherZone));
    }

    public function test_filter_out_other_streets()
    {
        $myStreet = Street::create(['barangay_id' => 1, 'name' => 'My Street']);
        $otherStreet = Street::create(['barangay_id' => 2, 'name' => 'Other Street']);
        $streets = Street::all();
        $this->assertTrue($streets->contains($myStreet));
        $this->assertFalse($streets->contains($otherStreet));
    }

    public function test_filter_out_other_households()
    {
        $myHousehold = Household::factory()->create(['barangay_id' => 1]);
        $otherHousehold = Household::factory()->create(['barangay_id' => 2]);
        $households = Household::all();
        $this->assertTrue($households->contains($myHousehold));
        $this->assertFalse($households->contains($otherHousehold));
    }

    public function test_filter_out_other_residents()
    {
        $myResident = Resident::factory()->create(['barangay_id' => 1]);
        $otherResident = Resident::factory()->create(['barangay_id' => 2]);
        $residents = Resident::all();
        $this->assertTrue($residents->contains($myResident));
        $this->assertFalse($residents->contains($otherResident));
    }
}
