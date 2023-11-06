<?php

namespace Tests\Feature\Models;

use App\Models\Gender;
use Database\Seeders\GenderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GenderSeeder::class);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, Gender::count());
    }

    public function test_may_be_male()
    {
        $gender = Gender::getMale();
        $this->assertModelExists($gender);
    }

    public function test_may_be_female()
    {
        $gender = Gender::getFemale();
        $this->assertModelExists($gender);
    }
}
