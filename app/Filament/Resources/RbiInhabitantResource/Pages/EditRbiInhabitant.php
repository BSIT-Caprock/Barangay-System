<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Filament\Resources\RbiInhabitantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRbiInhabitant extends EditRecord
{
    protected static string $resource = RbiInhabitantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
