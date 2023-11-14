<?php

use App\Filament\Resources\HouseholdResource\Pages\ListHouseholds;
use App\Models\Household;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    seed();
    $user = User::find(2);
    actingAs($user);
});

test('can list households', function () {
    Household::create(['number' => 'test001']);
    $page = livewire(ListHouseholds::class);
    $page->assertCanSeeTableRecords(Household::all());
});

test('can filter to see deleted households', function () {
    $household = Household::create(['number' => 'test001']);
    $household->delete();
    $page = livewire(ListHouseholds::class);
    $page->filterTable('trashed', true);
    $page->assertCanSeeTableRecords(Household::all());
});
