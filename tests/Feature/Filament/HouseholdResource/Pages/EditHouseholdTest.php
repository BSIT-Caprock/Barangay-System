<?php

use App\Filament\Resources\HouseholdResource;
use App\Filament\Resources\HouseholdResource\Pages\EditHousehold;
use App\Filament\Resources\HouseholdResource\Pages\ListHouseholds;
use App\Models\Household;
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

test('can retrieve data from household', function () {
    $record = Household::create(['number' => 'test001']);
    $page = livewire(EditHousehold::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->assertFormSet([
        'number' => $record->number,
    ]);
});

test('can save household details', function () {
    $record = Household::create(['number' => 'test001']);
    $newRecord = Household::create(['number' => 'test001B']);
    $page = livewire(EditHousehold::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->fillForm([
        'number' => $newRecord->number,
    ]);
    $page->call('save');
    $page->assertHasNoFormErrors();
    $record->refresh();
    assertEquals($record->number, $newRecord->number);
});

test('can validate input for editing household', function () {
    $record = Household::create(['number' => 'test001']);
    $page = livewire(EditHousehold::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->fillForm([
        'number' => null,
    ]);
    $page->call('save');
    $page->assertHasFormErrors([
        'number' => 'required',
    ]);
});

test('can delete household from edit form', function () {
    $record = Household::create(['number' => 'test001']);
    $page = livewire(EditHousehold::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->callAction(DeleteAction::class);
    $list = livewire(ListHouseholds::class);
    $list->assertCanNotSeeTableRecords(Household::all());
});

test('can restore deleted household', function () {
    $record = Household::create(['number' => 'test001']);
    $record->delete();
    $page = livewire(EditHousehold::class, [
        'record' => $record->getRouteKey(),
    ]);
    $page->callAction('restore');
    $list = livewire(ListHouseholds::class);
    $list->filterTable('trashed', true);
    $list->assertCanSeeTableRecords(Household::all());
});
