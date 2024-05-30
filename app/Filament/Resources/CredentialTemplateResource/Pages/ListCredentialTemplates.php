<?php

namespace App\Filament\Resources\CredentialTemplateResource\Pages;

use App\Filament\Resources\CredentialTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCredentialTemplates extends ListRecords
{
    protected static string $resource = CredentialTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
