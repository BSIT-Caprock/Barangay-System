<?php

use App\Filament\Resources\HouseholdResource;
use App\Filament\Resources\HouseholdResource\Widgets\HouseholdCount;
use App\Models\Household;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
    $user = User::find(2);
    actingAs($user);
});

test('can render list of households', function () {
    $response = get(HouseholdResource::getUrl('index'));
    $response->assertSuccessful();
});

test('can render form for creating household', function () {
    $response = get(HouseholdResource::getUrl('create'));
    $response->assertSuccessful();
});

test('can render form for editing household', function () {
    $record = Household::create(['number' => 'test001']);
    $response = get(HouseholdResource::getUrl('edit', [
        'record' => $record,
    ]));
    $response->assertSuccessful();
});

test('can see widget for households count', function () {
    $response = get(HouseholdResource::getUrl('index'));
    $response->assertSeeLivewire(HouseholdCount::class);
});
