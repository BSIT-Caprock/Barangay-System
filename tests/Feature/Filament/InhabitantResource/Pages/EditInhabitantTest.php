<?php

use App\Filament\Resources\InhabitantResource;
use App\Filament\Resources\InhabitantResource\Pages\EditInhabitant;
use App\Filament\Resources\InhabitantResource\Pages\ListInhabitants;
use App\Models\Inhabitant;
use App\Models\User;
use Filament\Actions\DeleteAction;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    seed();
    $user = User::find(2);
    actingAs($user);
});

test('can retrieve data from inhabitant', function () {
    $record = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->create();
    $page = livewire(EditInhabitant::class, [
        'record' => $record->getRouteKey(),
    ]);
    $attributes = collect($record->getAttributes())->only($record->getFillable())->toArray();
    $page->assertFormSet($attributes);
});

test('can save inhabitant details', function () {
    $record = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->create();
    $newRecord = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->make();
    $page = livewire(EditInhabitant::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->fillForm($newRecord->getAttributes());
    $page->call('save');
    $page->assertHasNoFormErrors();
    $record->refresh();
    $oldAttributes = collect($record->getAttributes())->only($record->getFillable())->toArray();
    $newAttributes = collect($newRecord->getAttributes())->only($newRecord->getFillable())->toArray();
    assertEquals($oldAttributes, $newAttributes);
});

test('can validate input for editing inhabitant', function () {
    $record = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->create();
    $page = livewire(EditInhabitant::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->fillForm(collect($record->getAttributes())->map(fn ($v) => null)->all());
    $page->call('save');
    $page->assertHasFormErrors();
});

test('can delete inhabitant from edit form', function () {
    $record = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->create();
    $page = livewire(EditInhabitant::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->callAction(DeleteAction::class);
    $list = livewire(ListInhabitants::class);
    $list->assertCanNotSeeTableRecords(Inhabitant::all());
});

test('can restore deleted inhabitant', function () {
    $record = Inhabitant::factory()
        ->for(auth()->user()->barangay)
        ->create();
    $record->delete();
    $page = livewire(EditInhabitant::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->callAction('restore');
    $list = livewire(ListInhabitants::class);
    $list->filterTable('trashed', true);
    $list->assertCanSeeTableRecords(Inhabitant::all());
});
