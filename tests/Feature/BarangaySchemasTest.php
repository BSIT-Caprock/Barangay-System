<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BarangaySchemasTest extends TestCase
{
    use RefreshDatabase;

    public function test_barangay_keys_table_exists(): void
    {
        $this->assertTrue(Schema::hasTable('barangay_keys'));
    }

    public function test_barangays_table_exists(): void
    {
        $this->assertTrue(Schema::hasTable('barangays'));
    }

    public function test_barangay_keys_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumn('barangay_keys', 'id'));
    }

    public function test_barangays_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('barangays', [
            'key_id',
            'region',
            'province',
            'city_or_municipality',
            'barangay',
        ]));
    }
}
