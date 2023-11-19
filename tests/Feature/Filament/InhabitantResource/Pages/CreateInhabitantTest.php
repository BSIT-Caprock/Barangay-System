<?php

use App\Filament\Resources\InhabitantResource\Pages\CreateInhabitant;
use App\Models\Inhabitant;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    seed();
    $user = User::find(2);
    actingAs($user);
});

test('can create inhabitant', function () {
    $page = livewire(CreateInhabitant::class);
    $attributes = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->make()
        ->getAttributes();
    $page->fillForm($attributes);
    $page->call('create');
    $page->assertHasNoFormErrors();
    assertDatabaseHas(Inhabitant::class, $attributes);
});

test('can validate input for creating inhabitant', function () {
    $page = livewire(CreateInhabitant::class);
    $attributes = [];
    $page->fillForm($attributes);
    $page->call('create');
    $page->assertHasFormErrors();
});
