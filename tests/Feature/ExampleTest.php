<?php

use App\Database\MultiRecord\Record;
use App\Filament\Resources\ResidentResource\Pages\ListResidents;
use App\Models\Locations\Barangay;
use App\Models\Locations\BarangayRecord;
use Filament\Pages\Auth\Login;

use function Pest\Livewire\livewire;

it('renders successfully', function () {
    $response = $this->get('/login');
    $response->assertSuccessful();
    $response->assertSeeLivewire(Login::class);
});

test('livewire has method', function () {
    $lw = livewire(ListResidents::class);
    // $hasMethod = method_exists($lw, 'assertCanSeeTableRecords');
    // expect($hasMethod)->toBe(true);
    livewire(ListResidents::class)->assertCanSeeTableRecords();
});


test('123', function () {
    $cls = Barangay::class;
    $record = new BarangayRecord;
    dump($cls::getRecordModel());
    dump($cls::getForeignId());
    dump($record->getFillable());
    dump($record->entity()->getRelated());
});

test('test hello');
