<?php

namespace App\Filament\Resources\InhabitantResource\Pages;

use App\Filament\Resources\InhabitantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInhabitants extends ListRecords
{
    protected static string $resource = InhabitantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \App\FilamentExcel\Actions\Pages\ExportTableAction::make(),
            Actions\CreateAction::make(),
        ];
    }
}
