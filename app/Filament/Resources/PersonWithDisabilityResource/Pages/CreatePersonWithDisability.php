<?php

namespace App\Filament\Resources\PersonWithDisabilityResource\Pages;

use App\Filament\Resources\PersonWithDisabilityResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonWithDisability extends CreateRecord
{
    protected static string $resource = PersonWithDisabilityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
