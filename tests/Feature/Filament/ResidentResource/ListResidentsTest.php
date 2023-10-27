<?php

namespace Tests\Feature\Filament\ResidentResource;

use App\Filament\Resources\ResidentResource\Pages\ListResidents;
use App\Models\Residents\Resident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

class ListResidentsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_page_renders_successfully(): void
    {
        $response = $this->get('/residents');
        $response->assertStatus(200);
        $response->assertSeeLivewire(ListResidents::class);
    }

    public function test_list_residents(): void
    {
        
    }
}
