<?php

use App\Filament\Resources\InhabitantResource;
use App\Filament\Resources\InhabitantResource\Widgets\TotalInhabitants;
use App\Models\Inhabitant;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed();
    $user = User::find(2);
    actingAs($user);
});

test('has list page', function () {
    $response = get(InhabitantResource::getUrl('index'));
    $response->assertSuccessful();
});

test('has create page', function () {
    $response = get(InhabitantResource::getUrl('create'));
    $response->assertSuccessful();
});

test('has edit page', function () {
    $record = Inhabitant::factory()->create();
    $response = get(InhabitantResource::getUrl('edit', [
        'record' => $record,
    ]));
    $response->assertSuccessful();
});

test('has widget for total inhabitants', function () {
    $response = get(InhabitantResource::getUrl('index'));
    $response->assertSeeLivewire(TotalInhabitants::class);
});
