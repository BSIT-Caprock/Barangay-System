<?php

namespace App\Filament\Resources\InhabitantResource\Widgets;

use App\Models\Inhabitant;
use App\Models\Sex;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalInhabitants extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total inhabitants', Inhabitant::count()),
            Stat::make('Male', Inhabitant::whereRelation('sex', 'id', Sex::MALE)->count()),
            Stat::make('Female', Inhabitant::whereRelation('sex', 'id', Sex::FEMALE)->count()),
        ];
    }
}
