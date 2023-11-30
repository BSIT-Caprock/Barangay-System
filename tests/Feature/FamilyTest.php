<?php

use App\Filament\Resources\FamilyResource;
use App\Filament\Resources\FamilyResource\Pages\CreateFamily;
use App\Filament\Resources\FamilyResource\Pages\EditFamily;
use App\Filament\Resources\FamilyResource\Pages\ListFamilies;
use App\Models\Barangay;
use App\Models\User;
use Database\Factories\FamilyFactory;
use Database\Factories\FamilyMemberFactory;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertEqualsCanonicalizing;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotContains;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    // seed database
    seed();
    // create test user with barangay
    $user = User::factory()->for(Barangay::find(1))->create();
    // login
    auth()->login($user);
});

test('can list families', function () {
    $records = FamilyFactory::new()
        ->count(3)
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->create();

    get(ListFamilies::getUrl())->assertOk();

    livewire(ListFamilies::class)
        ->assertCanRenderTableColumn('location')
        ->assertCanRenderTableColumn('total_members')
        ->assertCanSeeTableRecords($records);
});

test('can add family', function () {
    get(CreateFamily::getUrl())->assertOk();

    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->make();

    livewire(CreateFamily::class)
        ->fillForm($record->getAttributes())
        ->call('create')
        ->assertHasNoErrors();

    assertDatabaseHas($record::class, $record->getAttributes());
});

test('can edit family', function () {
    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->create();

    $currentData = getModelFillable($record);

    $newData = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->raw();

    livewire(EditFamily::class, ['record' => $record->getRouteKey()])
        ->assertFormSet($currentData)
        ->fillForm($newData)
        ->call('save')
        ->assertHasNoErrors();

    $savedData = getModelFillable($record->refresh());

    assertEqualsCanonicalizing($newData, $savedData);
});

test('can delete family', function () {
    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->create();

    livewire(EditFamily::class, ['record' => $record->getRouteKey()])
        ->callAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertNotContains($record, $record->all());
});

test('can restore family', function () {
    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->create();

    $record->delete();

    livewire(EditFamily::class, ['record' => $record->getRouteKey()])
        ->callAction(RestoreAction::class)
        ->assertHasNoErrors();

    $record->refresh();

    assertFalse($record->trashed());
});

test('can list family members', function () {
    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->has(FamilyMemberFactory::new()->count(3), 'members')
        ->create();

    livewire(FamilyResource\RelationManagers\MembersRelationManager::class, [
        'ownerRecord' => $record,
        'pageClass' => EditFamily::class,
    ])
        ->assertCanRenderTableColumn('is_lgbtq')
        ->assertCanRenderTableColumn('has_disability')
        ->assertCanRenderTableColumn('has_disease')
        ->assertCanRenderTableColumn('is_pregnant')
        ->assertCanSeeTableRecords($record->members);
});

test('can add family members', function () {
    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->create();

    $member = FamilyMemberFactory::new()->make();

    livewire(FamilyResource\RelationManagers\MembersRelationManager::class, [
        'ownerRecord' => $record,
        'pageClass' => EditFamily::class,
    ])
        ->callTableAction('create', data: getModelFillable($member))
        ->assertHasNoErrors();

    $record->refresh();

    assertTrue($record->members->count() > 0);
});

test('can edit family member', function () {
    $record = FamilyFactory::new()
        ->forCurrentBarangay()
        ->forRandomLocation()
        ->has(FamilyMemberFactory::new(), 'members')
        ->create();

    $member = $record->members->first();

    $currentData = getModelFillable($member);

    dump($currentData);

    $newData = FamilyMemberFactory::new()->for($record, 'family')->raw();

    $livewire = livewire(FamilyResource\RelationManagers\MembersRelationManager::class, [
        'ownerRecord' => $record,
        'pageClass' => EditFamily::class,
    ]);

    dump($livewire->getData()['mountedTableActionsData']);

    $livewire->mountTableAction('edit', $member)
        ->assertActionDataSet([
            // 'inhabitant_id' => $currentData['inhabitant_id'],
            // 'is_lgbtq' => $currentData['is_lgbtq'],
            'has_disability' => $currentData['has_disability'],
            // 'has_disease' => $currentData['has_disease'],
            // 'is_pregnant' => $currentData['is_pregnant'],
            // 'pregnancy_due' => $currentData['pregnancy_due'],
        ]);

    $record->refresh();

    assertTrue($record->members->count() > 0);
})->skip();

test('can delete family member', function () {
})->skip();

test('can restore family member', function () {
})->skip();
