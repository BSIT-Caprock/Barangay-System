<?php

namespace App\Filament\Resources\CredentialTemplateResource\Pages;

use App\Filament\Resources\CredentialTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCredentialTemplate extends EditRecord
{
    protected static string $resource = CredentialTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
