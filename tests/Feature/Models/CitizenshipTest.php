<?php

namespace Tests\Feature\Models;

use App\Models\Citizenship;
use Database\Seeders\CitizenshipSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CitizenshipTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CitizenshipSeeder::class);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, Citizenship::count());
    }

    public function test_must_have_name()
    {
        // pick citizenship
        $citizenship = Citizenship::inRandomOrder()->first();
        $this->assertNotNull($citizenship->name);
    }
}
