<?php

namespace Tests\Feature\Models\Barangays;

use App\Models\Barangays\Barangay;
use Database\Seeders\Barangays\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BarangayTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_must_have_a_name(): void
    {
        // create barangays
        $this->seed(BarangaySeeder::class);
        // get names
        $names = Barangay::pluck('name');
        // assert
        $this->assertNotEmpty($names); 
    }

    public function test_may_have_a_logo(): void
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

    public function test_all_fields_must_be_in_history(): void
    {
        // get barangay fields
        $barangayFields = Schema::getColumnListing('barangays');
        // get history fields
        $historyFields = Schema::getColumnListing('barangay_histories');
        // assert history has barangay fields
        foreach ($barangayFields as $field) {
            $this->assertContains($field, $historyFields);
        }
    }

    public function test_created_barangay_must_have_history(): void
    {
        // create one barangay
        $barangay = Barangay::create([
            'name' => 'Test',
        ]);
        // get history
        $history = $barangay->history;
        // assert
        $this->assertNotEmpty($history);
    }

    public function test_history_entry_must_be_inserted_when_updating(): void
    {
        // create one barangay
        $barangay = Barangay::create([
            'name' => 'Test',
        ]);
        // update barangay
        $barangay->update(['name' => 'New Test']);
        // get history
        $history = $barangay->history;
        // there should be two history entries
        $this->assertCount(2, $history);
    }

    public function test_history_entry_must_be_inserted_when_deleting(): void
    {
        // create one barangay
        $barangay = Barangay::create([
            'name' => 'Test',
        ]);
        // delete barangay
        $barangay->delete();
        // get history
        $history = $barangay->history()->withTrashed()->get();
        // there should be two history entries
        $this->assertCount(2, $history);
        $trashed = $barangay->onlyTrashed()->first();
        // barangay and inserted history must have the same deleted_at
        $this->assertEquals($barangay->deleted_at, $trashed->deleted_at);
    }

    public function test_history_entry_must_be_inserted_when_restoring(): void
    {
        $this->markTestIncomplete('need to ask other programmers');
        // create one barangay
        $barangay = Barangay::create([
            'name' => 'Test',
        ]);
        // delete barangay
        $barangay->delete();
        // there should be two history entries
        $this->assertEquals(2, $barangay->history()->withTrashed()->get()->count());
        // restore barangay
        $barangay->restore();
        // there should be 3 history entries
        $this->assertEquals(3, $barangay->history()->withTrashed()->get()->count());
    }
}
