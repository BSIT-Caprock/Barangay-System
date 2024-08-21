<?php

namespace App\Filament\Resources\PrpwdPersonWithDisabilityResource\Pages;

use App\Filament\Resources\PrpwdPersonWithDisabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrpwdPersonWithDisabilities extends ListRecords
{
    protected static string $resource = PrpwdPersonWithDisabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
