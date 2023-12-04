<?php

namespace App\Filament\Resources\PersonWithDisabilityResource\Pages;

use App\Filament\Resources\PersonWithDisabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonWithDisability extends EditRecord
{
    protected static string $resource = PersonWithDisabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
