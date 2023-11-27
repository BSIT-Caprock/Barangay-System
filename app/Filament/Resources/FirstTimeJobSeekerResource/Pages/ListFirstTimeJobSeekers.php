<?php

namespace App\Filament\Resources\FirstTimeJobSeekerResource\Pages;

use App\Filament\Resources\FirstTimeJobSeekerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstTimeJobSeekers extends ListRecords
{
    protected static string $resource = FirstTimeJobSeekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
