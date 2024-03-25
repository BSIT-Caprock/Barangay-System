<?php

use App\Filament\Resources\PersonWithDisabilityResource\Pages\CreatePersonWithDisability;
use App\Filament\Resources\PersonWithDisabilityResource\Pages\ListPersonWithDisabilities;
use App\Models\Barangay;
use App\Models\Disability;
use App\Models\DisabilityCause;
use App\Models\PersonWithDisability;
use App\Scopes\CurrentBarangayScope;
use Database\Factories\PersonWithDisabilityFactory;
use Database\Factories\UserFactory;
use Database\Seeders\PersonsWithDisabilitiesSeeder;

use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertGreaterThan;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    // seed database
    seed();
    // create test user with barangay
    $user = UserFactory::new()->create();
    // login
    auth()->login($user);
});

test('table columns', function () {
    livewire(ListPersonWithDisabilities::class)
        ->assertTableColumnExists('barangay')
        ->assertTableColumnExists('last_name')
        ->assertTableColumnExists('first_name')
        ->assertTableColumnExists('middle_name')
        ->assertTableColumnExists('extension_name')
        ->assertTableColumnExists('address')
        ->assertTableColumnExists('disability')
        ->assertTableColumnExists('disability_cause');
});

test('form fields', function () {
    seed(PersonsWithDisabilitiesSeeder::class);
    livewire(CreatePersonWithDisability::class)
        ->assertFormFieldExists('barangay_id')
        ->assertFormFieldExists('last_name')
        ->assertFormFieldExists('first_name')
        ->assertFormFieldExists('middle_name')
        ->assertFormFieldExists('extension_name')
        ->assertFormFieldExists('address')
        ->assertFormFieldExists('disability_id')
        ->assertFormFieldExists('disability_cause_id');
});

test('choices for disability', function () {
    seed(PersonsWithDisabilitiesSeeder::class);
    assertGreaterThan(0, Disability::count());
});

test('choices for cause of disability', function () {
    seed(PersonsWithDisabilitiesSeeder::class);
    assertGreaterThan(0, DisabilityCause::count());
});

test('disability to string', function () {
    $model = Disability::create(['name' => 'Test']);
    assertEquals($model->name, (string) $model);
});

test('cause of disability to string', function () {
    $model = DisabilityCause::create(['name' => 'Test']);
    assertEquals($model->name, (string) $model);
});

test('model factory', function () {
    seed(PersonsWithDisabilitiesSeeder::class);
    $models = PersonWithDisabilityFactory::new()->count(10)->create();
    foreach ($models as $model) {
        assertModelExists($model);
    }
});

test('autofill barangay', function () {
    seed(PersonsWithDisabilitiesSeeder::class);
    $model = PersonWithDisabilityFactory::new()->create(['barangay_id' => null]);
    assertEquals($model->barangay->id, auth()->user()->barangay->id);
});

test('current barangay scope', function () {
    assertTrue(PersonWithDisability::hasGlobalScope(CurrentBarangayScope::class));
});
