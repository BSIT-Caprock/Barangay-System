<?php

namespace Tests\Feature\Models;

use App\Models\Occupation;
use Database\Seeders\OccupationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OccupationTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(OccupationSeeder::class);
    }
    public function test_exists(): void
    {
        $this->assertGreaterThan(0, Occupation::count());
    }

    public function test_must_have_name()
    {
        $occupation = Occupation::inRandomOrder()->first();
        $this->assertNotNull($occupation->name);
    }
}
