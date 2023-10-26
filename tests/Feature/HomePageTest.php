<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Pages\Auth\Login;
use Filament\Pages\Dashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated(): void
    {
        $response = $this->get('/');

        // redirect to login
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    // public function test_renders_successfully()
    // {
    //     $user = User::factory()->create();
    //     $this->actingAs($user);
    //     $response = $this->get('/');
    //     $response->assertSeeLivewire(Dashboard::class);
    // }
}
