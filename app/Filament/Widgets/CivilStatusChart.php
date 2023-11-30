<?php

namespace App\Filament\Widgets;

use App\Models\Inhabitant;
use ArberMustafa\FilamentGoogleCharts\Widgets\DonutChartWidget;

class CivilStatusChart extends DonutChartWidget
{
    protected static ?string $heading = 'Civil Status';

    protected static ?float $pieHole = 0.5;

    protected static ?array $options = [
        'legend' => [
            'position' => 'top',
        ],
        'height' => 400,

    ];

    protected function getData(): array
    {
        $singleCount = Inhabitant::where('civil_status_id', 1)->count();
        $marriedCount = Inhabitant::where('civil_status_id', 2)->count();
        $widowedCount = Inhabitant::where('civil_status_id', 3)->count();
        $separatedCount = Inhabitant::where('civil_status_id', 4)->count();

        return [
            ['Label', 'Aggregate'],
            ['Single', $singleCount],
            ['Married', $marriedCount],
            ['Widowed', $widowedCount],
            ['Separated', $separatedCount],
        ];
    }

    // protected function getType(): string
    // {
    //     return 'pie';
    // }
}
