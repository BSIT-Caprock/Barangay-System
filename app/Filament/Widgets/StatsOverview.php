<?php

namespace App\Filament\Widgets;

use App\Models\Reports;
use App\Models\Transaction;
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

            Stat::make('Total Transaction Logs', Transaction::count())
            ->description('')
            ->descriptionIcon('heroicon-s-arrow-trending-up')
            ->color('success')
            ->chart([5,2,7,3,9,4,6,])
        ];
    }
}
