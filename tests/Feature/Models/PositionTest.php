<?php

namespace Tests\Feature\Models;

use App\Models\Position;
use Database\Seeders\PositionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PositionSeeder::class);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, Position::count());
    }

    public function test_may_be_punong_barangay()
    {
        $position = Position::getPunongBarangay();
        $this->assertModelExists($position);
    }
    public function test_may_be_barangay_secretary()
    {
        $position = Position::getBarangaySecretary();
        $this->assertModelExists($position);
    }
    public function test_may_be_barangay_treasurer()
    {
        $position = Position::getBarangayTreasurer();
        $this->assertModelExists($position);
    }
    public function test_may_be_barangay_kagawad()
    {
        $position = Position::getBarangayKagawad();
        $this->assertModelExists($position);
    }
}
