<?php

namespace App\Filament\Resources\InhabitantResource\Pages;

use App\Filament\Resources\InhabitantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInhabitant extends CreateRecord
{
    protected static string $resource = InhabitantResource::class;

    public function getSubheading(): ?string
    {
        return __('(*) fields are required.');
    }
}
