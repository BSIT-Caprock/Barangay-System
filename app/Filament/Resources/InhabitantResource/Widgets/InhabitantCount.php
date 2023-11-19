<?php

namespace App\Filament\Resources\InhabitantResource\Widgets;

use App\Models\Inhabitant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InhabitantCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('No. of inhabitants', Inhabitant::count()),
        ];
    }
}
