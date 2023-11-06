<?php

namespace Tests\Feature;

use App\Filament\Resources\ResidentResource\Pages\CreateResident;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateResidentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_renders_successfully()
    {
        $user = null;

        Livewire::actingAs($user)
            ->test(Resident::class)
            ->assertStatus(200);
    }
    
    /** @test */
    public function test_form_fields_exist()
    {
        Livewire::test(CreateResident::class)
            ->assertStatus(200);
    }
    
    /** @test */
    public function test_can_create_resident()
    {
        Livewire::test(CreateResident::class)
            ->assertStatus(200);
    }
}
