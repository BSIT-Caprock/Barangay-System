<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            // // Stat::make('Total Residents', Resident::count())
            // Stat::make('Total Residents', 108)
            // // change the value of other stats if there's a data added
            // ->description('Increased residents as of now')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->color('success')
            // ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            // Stat::make('Total Barangay', 37)
            // ->description('Updated barangay-data as of now')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->color('primary')
            // ->chart([7, 4, 5, 7, 3, 5, 8, 10]),

            // Stat::make('Total Document Requested', 50)
            // ->description('Updated document-requested as of now')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->color('danger')
            // ->chart([7, 4, 3, 5, 3, 5, 6, 10]),
        ];
    }
}
