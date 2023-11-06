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
