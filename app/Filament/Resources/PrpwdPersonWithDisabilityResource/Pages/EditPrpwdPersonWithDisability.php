<?php

namespace App\Filament\Resources\PrpwdPersonWithDisabilityResource\Pages;

use App\Filament\Resources\PrpwdPersonWithDisabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrpwdPersonWithDisability extends EditRecord
{
    protected static string $resource = PrpwdPersonWithDisabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
