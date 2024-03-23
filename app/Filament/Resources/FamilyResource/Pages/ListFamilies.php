<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use App\Models\Family;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilies extends ListRecords
{
    protected static string $resource = FamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \App\FilamentExcel\Actions\Pages\ExportTableAction::make(),
            Actions\CreateAction::make()
                ->url(null)
                ->successRedirectUrl(fn (Family $record): string => $this->getResource()::getUrl('edit', ['record' => $record])),
        ];
    }
}
