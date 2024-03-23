<?php

namespace App\Filament\Resources\ResidencyCertificateResource\Pages;

use App\Filament\Resources\ResidencyCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageResidencyCertificates extends ManageRecords
{
    protected static string $resource = ResidencyCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \App\FilamentExcel\Actions\Pages\ExportTableAction::make(),
            Actions\CreateAction::make()->url(null),
        ];
    }
}
