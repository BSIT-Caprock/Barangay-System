<?php

namespace App\Filament\Resources\HouseholdResource\Widgets;

use App\Models\Household;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HouseholdCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('No. of households', Household::count()),
        ];
    }
}
