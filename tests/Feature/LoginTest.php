<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Pages\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSeeLivewire(Login::class);
    }
    
    // public function test_unauthenticated_user_is_redirected_to_login(): void
    // {
    //     $response = $this->get('/');
    //     $response->assertRedirect('/login');
    // }
    
    // public function test_authenticated_user_(): void
    // {
    //     $this->actingAs(User::factory()->create());
    //     $response = $this->get('/');
    //     $response->assertStatus(200);
    // }
    
    public function test_validation(): void
    {
        Livewire::test(Login::class)
            ->call('authenticate')
            ->assertHasErrors();
    }

}
