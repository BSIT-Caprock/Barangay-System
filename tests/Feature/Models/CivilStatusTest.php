<?php

namespace Tests\Feature\Models;

use App\Models\CivilStatus;
use Database\Seeders\CivilStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CivilStatusTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CivilStatusSeeder::class);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, CivilStatus::count());
    }

    public function test_may_be_single()
    {
        $civilStatus = CivilStatus::getSingle();
        $this->assertModelExists($civilStatus);
    }
    
    public function test_may_be_married()
    {
        $civilStatus = CivilStatus::getMarried();
        $this->assertModelExists($civilStatus);
    }
    
    public function test_may_be_widow_or_widower()
    {
        $civilStatus = CivilStatus::getWidowed();
        $this->assertModelExists($civilStatus);
    }
    
    public function test_may_be_separated()
    {
        $civilStatus = CivilStatus::getSeparated();
        $this->assertModelExists($civilStatus);
    }
}
