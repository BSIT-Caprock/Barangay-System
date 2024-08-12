<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Filament\Resources\RbiInhabitantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRbiInhabitants extends ListRecords
{
    protected static string $resource = RbiInhabitantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
