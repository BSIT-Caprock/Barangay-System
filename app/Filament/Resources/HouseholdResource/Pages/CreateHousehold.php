<?php

namespace App\Filament\Resources\HouseholdResource\Pages;

use App\Filament\Resources\HouseholdResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHousehold extends CreateRecord
{
    protected static string $resource = HouseholdResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getSubheading(): ?string
    {
        return __('(*) fields are required.');
    }
}
