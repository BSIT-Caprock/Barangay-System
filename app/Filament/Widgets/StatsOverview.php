<?php

namespace App\Filament\Widgets;

use App\Models\Reports;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Montly Reports', Reports::count())
            ->description('')
            ->descriptionIcon('heroicon-s-arrow-trending-up')
            ->color('primary')
            ->chart([2,5,8,3,5,2,6]),

            
        ];
    }
}
