<?php

namespace Tests\Feature;

use App\Models\Barangay;
use App\Models\BarangayKey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BarangayModelsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public static array $sampleData = [
        'region' => '',
        'province' => '',
        'city_or_municipality' => '',
        'barangay' => '',
    ];

    public function test_barangay_can_be_created_with_new_key(): void
    {
        $brgy = Barangay::createWithNewKey(self::$sampleData);
        $this->assertInstanceOf(BarangayKey::class, $brgy->record_key);
    }

    public function test_barangay_can_have_new_record(): void
    {
        $rec1 = Barangay::createWithNewKey(self::$sampleData);
        $rec2 = $rec1->newRecord(self::$sampleData);
        $this->assertEquals($rec1->record_key->id, $rec2->record_key->id);
    }

    public function test_barangay_belongs_to_key(): void
    {
        $brgy = Barangay::createWithNewKey(self::$sampleData);
        $key = BarangayKey::find($brgy->record_key->id);
        $this->assertEquals($key->id, $brgy->record_key->id);
    }

    public function test_barangay_has_record_history(): void
    {
        $brgy = Barangay::createWithNewKey(self::$sampleData);
        $rec2 = $brgy->newRecord(self::$sampleData);
        $this->assertTrue($brgy->record_history->contains($rec2));
        $this->assertEquals($brgy->record_history->count(), 2);
    }
}
