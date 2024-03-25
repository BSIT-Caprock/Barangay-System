<?php

use App\Filament\Resources\ResidencyCertificateResource;
use App\Filament\Resources\ResidencyCertificateResource\Pages\ManageResidencyCertificates;
use App\Models\Barangay;
use Database\Factories\UserFactory;

use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    // seed database
    seed();
    // create test user with barangay
    $user = UserFactory::new()->create();
    // login
    auth()->login($user);
});

test('can render', function () {
    get(ResidencyCertificateResource::getUrl('index'))->assertOk();
});

test('table columns', function () {
    livewire(ManageResidencyCertificates::class)
        ->assertTableColumnExists('resident_name');
});

test('form fields', function () {
    livewire(ManageResidencyCertificates::class)
        ->assertFormFieldExists('resident_name');
})->skip();
