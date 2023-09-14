<?php

namespace Tests\Feature;

use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BarangaySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_there_are_37_barangays_after_seeding(): void
    {
        $this->seed(BarangaySeeder::class);
        $this->assertDatabaseCount('barangays', 37);
    }
}
