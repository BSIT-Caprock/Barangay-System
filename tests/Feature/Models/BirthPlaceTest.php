<?php

namespace Tests\Feature\Models;

use App\Models\BirthPlace;
use Database\Seeders\BirthPlaceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BirthPlaceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BirthPlaceSeeder::class);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, BirthPlace::count());
    }

    public function test_may_have_province()
    {
        // create a birth place
        $birthPlace = BirthPlace::create([
            'label' => 'Test Label',
        ]);
        // add province
        $birthPlace->update([
            'province' => 'Test Province',
        ]);
        $this->assertNotNull($birthPlace->province);
    }

    public function test_may_have_city_or_municipality()
    {
        // create a birth place
        $birthPlace = BirthPlace::create([
            'label' => 'Test',
        ]);
        // add city_or_municipality
        $birthPlace->update([
            'city_or_municipality' => 'Test City',
        ]);
        $this->assertNotNull($birthPlace->city_or_municipality);
    }

    public function test_may_set_custom_label()
    {
        $expectedLabel = 'Custom Test City';
        // create a birth place
        $birthPlace = BirthPlace::create([
            'province' => 'Test Province',
            'city_or_municipality' => 'Test City',
            'label' => $expectedLabel,
        ]);
        $this->assertEquals($expectedLabel, $birthPlace->label);
    }

    public function test_automatically_set_label_if_not_set()
    {
        // create a birth place
        $birthPlace = BirthPlace::create([
            'province' => 'Test Province',
            'city_or_municipality' => 'Test City',
        ]);
        $expectedLabel = 'Test City, Test Province';
        $this->assertEquals($expectedLabel, $birthPlace->label);
    }
}
