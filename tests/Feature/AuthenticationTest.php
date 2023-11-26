<?php

use App\Models\Barangay;
use App\Models\User;
use Filament\Pages\Auth\Login;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset;
use Filament\Pages\Auth\Register;

use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    // seed database
    seed();
});

test('has login page', function () {
    get('/login')
        ->assertOk()
        ->assertSeeLivewire(Login::class);
});

test('can redirect to login page', function () {
    get('/')
        ->assertRedirect('/login');
});

test('user can log in', function () {
    // create user
    User::factory()->for(Barangay::find(1))->create([
        'email' => 'email@test.com',
        'password' => 'testpass',
    ]);
    // visit page
    livewire(Login::class)
        ->fillForm([
            'email' => 'email@test.com',
            'password' => 'testpass',
        ])
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect('/');
});

test('has password reset page', function () {
    get('/password-reset/request')
        ->assertOk()
        ->assertSeeLivewire(RequestPasswordReset::class);
});

test('can reset pasword', function () {
})->markTestIncomplete();

test('has registration page', function () {
    get('/register')
        ->assertOk()
        ->assertSeeLivewire(Register::class);
});

test('can register new account', function () {
})->markTestIncomplete();
