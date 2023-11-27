<?php

use App\Filament\Resources\InhabitantResource\Pages\CreateInhabitant;
use App\Filament\Resources\InhabitantResource\Pages\EditInhabitant;
use App\Filament\Resources\InhabitantResource\Pages\ListInhabitants;
use App\Models\Barangay;
use App\Models\Inhabitant;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Maatwebsite\Excel\Excel;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertEqualsCanonicalizing;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotContains;

beforeEach(function () {
    // seed database
    seed();
    // create test user with barangay
    $user = User::factory()->for(Barangay::find(1))->create();
    // login
    auth()->login($user);
});

test('can list inhabitants', function () {
    // create inhabitants
    $inhabitants = inhabitantFactory()->count(10)->create();
    // visit page
    get(ListInhabitants::getUrl())
        ->assertOk();
    livewire(ListInhabitants::class)
        // assert
        ->assertCanSeeTableRecords($inhabitants);
});

test('can add inhabitants', function () {
    // inhabitant data
    $data = inhabitantFactory()->raw();
    // visit page
    get(CreateInhabitant::getUrl())
        ->assertOk();
    livewire(CreateInhabitant::class)
        ->fillForm($data)
        ->call('create')
        ->assertHasNoFormErrors();
    assertDatabaseHas(Inhabitant::class, $data);
});

test('can edit inhabitants', function () {
    // create inhabitant
    $inhabitant = inhabitantFactory()->create();
    // current data
    $currentData = collect($inhabitant->getAttributes())->only($inhabitant->getFillable())->toArray();
    // new data
    $newData = inhabitantFactory()->raw();
    // visit page
    get(ListInhabitants::getUrl(['record' => $inhabitant->getRouteKey()]))
        ->assertOk();
    livewire(EditInhabitant::class, ['record' => $inhabitant->getRouteKey()])
        // assert has current data
        ->assertFormSet($currentData)
        // fill with new data
        ->fillForm($newData)
        // save
        ->call('save')
        // assert
        ->assertHasNoFormErrors();
    // reload
    $inhabitant->refresh();
    // get saved data
    $savedData = collect($inhabitant->getAttributes())->only($inhabitant->getFillable())->toArray();
    // assert
    assertEqualsCanonicalizing($newData, $savedData);
});

test('can delete inhabitants', function () {
    // create inhabitant
    $inhabitant = inhabitantFactory()->create();
    // visit page
    get(ListInhabitants::getUrl(['record' => $inhabitant->getRouteKey()]))
        ->assertOk();
    livewire(EditInhabitant::class, ['record' => $inhabitant->getRouteKey()])
        // delete
        ->callAction(DeleteAction::class)
        // refresh
        ->assertHasNoActionErrors();
    // assert
    assertNotContains($inhabitant, Inhabitant::all());
});

test('can restore deleted inhabitants', function () {
    // create inhabitant
    $inhabitant = inhabitantFactory()->create();
    // delete
    $inhabitant->delete();
    // visit page
    get(ListInhabitants::getUrl(['record' => $inhabitant->getRouteKey()]))
        ->assertOk();
    livewire(EditInhabitant::class, ['record' => $inhabitant->getRouteKey()])
        // delete
        ->callAction(RestoreAction::class)
        // refresh
        ->assertHasNoActionErrors();
    // reload
    $inhabitant->refresh();
    // assert
    assertFalse($inhabitant->trashed());
});

test('can export table to CSV', function () {
    // create inhabitants
    inhabitantFactory()->count(10)->create();
    // visit page
    exportTable(ListInhabitants::class, Excel::CSV)
        // assert
        ->assertFileDownloaded();
});

test('can export table to XLS', function () {
    // create inhabitants
    inhabitantFactory()->count(10)->create();
    // visit page
    exportTable(ListInhabitants::class, Excel::XLS)
        // assert
        ->assertFileDownloaded();
});

test('can export seleted records to CSV', function () {
    // create inhabitants
    $records = inhabitantFactory()->count(10)->create();
    // visit page
    exportSelectedRecords(ListInhabitants::class, $records, Excel::CSV)
        // assert
        ->assertFileDownloaded();
});

test('can export selected records to XLS', function () {
    // create inhabitants
    $records = inhabitantFactory()->count(10)->create();
    // visit page
    exportSelectedRecords(ListInhabitants::class, $records, Excel::XLS)
        // assert
        ->assertFileDownloaded();
});

function inhabitantFactory()
{
    return Inhabitant::factory()->for(auth()->user()->barangay);
}
