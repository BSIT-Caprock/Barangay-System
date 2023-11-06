<?php

namespace Tests\Feature\Models;

use App\Models\Household;
use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseholdTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
    }

    public function test_can_be_randomly_created()
    {
        $household = Household::factory()->create();
        $this->assertModelExists($household);
    }

    public function test_history_must_be_inserted_when_created()
    {
        $household = Household::factory()->create();
        $this->assertEquals(1, $household->history->count());
    }

    public function test_history_must_be_inserted_when_updated()
    {
        $household = Household::factory()->create();
        $household->update(['number' => '1234']);
        $this->assertEquals(2, $household->history->count());
    }

    public function test_history_must_be_inserted_when_deleted()
    {
        $household = Household::factory()->create();
        $household->delete();
        $this->assertEquals(2, $household->history->count());
    }

    public function test_history_must_be_inserted_when_restored()
    {
        $this->markTestSkipped();
    }

    public function test_must_have_barangay()
    {
        $household = Household::factory()->create();
        $this->assertEquals(1, $household->history->count());
    }
}
