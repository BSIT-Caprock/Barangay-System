<?php

namespace App\Filament\Resources\RbiHouseholdResource\Pages;

use App\Filament\Resources\RbiHouseholdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRbiHousehold extends EditRecord
{
    protected static string $resource = RbiHouseholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
