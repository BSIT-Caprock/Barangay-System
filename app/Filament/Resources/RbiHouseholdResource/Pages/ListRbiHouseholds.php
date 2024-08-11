<?php

namespace App\Filament\Resources\RbiHouseholdResource\Pages;

use App\Filament\Resources\RbiHouseholdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRbiHouseholds extends ListRecords
{
    protected static string $resource = RbiHouseholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
