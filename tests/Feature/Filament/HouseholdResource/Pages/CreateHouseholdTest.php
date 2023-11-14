<?php

use App\Filament\Resources\HouseholdResource\Pages\CreateHousehold;
use App\Models\Household;
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

test('can create household', function () {
    $page = livewire(CreateHousehold::class);
    $page->fillForm([
        'number' => 'test001',
    ]);
    $page->call('create');
    $page->assertHasNoFormErrors();
    assertDatabaseHas(Household::class, [
        'number' => 'test001',
    ]);
});

test('can validate input for creating household', function () {
    $page = livewire(CreateHousehold::class);
    $page->fillForm([
        'number' => null,
    ]);
    $page->call('create');
    $page->assertHasFormErrors();
});
