<?php

namespace App\Filament\Resources\InhabitantResource\Pages;

use App\Filament\Resources\InhabitantResource;
use App\Filament\Resources\InhabitantResource\Widgets\TotalInhabitants;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInhabitants extends ListRecords
{
    protected static string $resource = InhabitantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TotalInhabitants::class,
        ];
    }
}
