<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Filament\Resources\RbiInhabitantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRbiInhabitant extends CreateRecord
{
    protected static string $resource = RbiInhabitantResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            RbiInhabitantResource\Widgets\ExistingInhabitants::class,
        ];
    }

    public function getFooterWidgetsColumns(): int|string|array
    {
        return 1;
    }
}
