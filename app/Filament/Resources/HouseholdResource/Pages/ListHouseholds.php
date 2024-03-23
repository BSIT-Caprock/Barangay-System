<?php

namespace App\Filament\Resources\HouseholdResource\Pages;

use App\Filament\Resources\HouseholdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListHouseholds extends ListRecords
{
    protected static string $resource = HouseholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \App\FilamentExcel\Actions\Pages\ExportTableAction::make(),
            Actions\CreateAction::make()->url(null)
                ->successRedirectUrl(fn (Model $record): string => $this->getResource()::getUrl('edit', ['record' => $record])),
        ];
    }
}
