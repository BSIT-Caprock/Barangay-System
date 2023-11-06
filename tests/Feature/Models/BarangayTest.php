<?php

namespace Tests\Feature\Models;

use App\Models\Barangay;
use App\Models\Zone;
use App\Models\Resident;
use App\Models\User;
use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BarangayTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
    }

    public function test_exists()
    {
        $this->assertGreaterThan(0, Barangay::count());
    }

    public function test_must_have_name()
    {
        $barangay = Barangay::inRandomOrder()->first();
        $this->assertNotNull($barangay->name);
    }

    public function test_may_have_logo()
    {
        // create one barangay
        // notice we did not put logo
        $barangay = Barangay::create([
            'name' => 'Test',
        ]);
        // fake storage
        Storage::fake('public');
        // fake file
        $file = UploadedFile::fake()->image('test_logo.png');
        // add logo to barangay
        $barangay->logo = $file->store('barangays/logos', 'public');
        $barangay->save();
        // get path to logo
        $path = $barangay->logo;
        // assert path exists
        $this->assertTrue(Storage::disk('public')->exists($path));
    }

    public function test_has_users()
    {
        // get barangay
        $barangay = Barangay::inRandomOrder()->first();
        // create barangay user
        $user = User::factory()->for($barangay)->create();
        // assert
        $this->assertGreaterThan(0, $barangay->users->count());
    }

    public function test_has_zones()
    {
        // get barangay
        $barangay = Barangay::inRandomOrder()->first();
        // create barangay zone
        $barangay->zones()->create(
            ['name' => 'Zone 1'],
        );
        // assert
        $this->assertGreaterThan(0, $barangay->zones->count());
    }

    public function test_has_households()
    {
        // get barangay
        $barangay = Barangay::inRandomOrder()->first();
        // create barangay zone
        $barangay->households()->create(
            ['number' => '1010'],
        );
        // assert
        $this->assertGreaterThan(0, $barangay->households->count());
    }

    public function test_has_residents()
    {
        // get barangay
        $barangay = Barangay::first();
        // create resident
        Resident::factory()->for($barangay)->create();
        // assert
        $this->assertGreaterThan(0, $barangay->residents->count());
    }

    public function test_has_document_templates()
    {
        $this->markTestIncomplete();
    }

    public function test_has_document_requests()
    {
        $this->markTestIncomplete();
    }
}
