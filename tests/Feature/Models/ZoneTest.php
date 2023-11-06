<?php

namespace Tests\Feature\Models;

use App\Models\Zone;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\ZoneSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZoneTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            BarangaySeeder::class,
            ZoneSeeder::class,
        ]);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, Zone::count());
    }
}
