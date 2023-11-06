<?php

namespace Tests\Feature\Models;

use App\Models\Street;
use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StreetTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
    }

    public function test_can_be_randomly_created()
    {
        $street = Street::factory()->create();
        $this->assertModelExists($street);
    }
}
