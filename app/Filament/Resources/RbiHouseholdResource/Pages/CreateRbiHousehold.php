<?php

namespace App\Filament\Resources\RbiHouseholdResource\Pages;

use App\Filament\Resources\RbiHouseholdResource;
use App\Filament\Widgets\ResourcePageTableWidget;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRbiHousehold extends CreateRecord
{
    protected static string $resource = RbiHouseholdResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            ResourcePageTableWidget::makeWith($this->getResource(), initialWhere: []),
        ];
    }
}
