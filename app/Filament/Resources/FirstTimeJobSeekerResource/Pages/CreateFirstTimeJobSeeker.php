<?php

namespace App\Filament\Resources\FirstTimeJobSeekerResource\Pages;

use App\Filament\Resources\FirstTimeJobSeekerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFirstTimeJobSeeker extends CreateRecord
{
    protected static string $resource = FirstTimeJobSeekerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
