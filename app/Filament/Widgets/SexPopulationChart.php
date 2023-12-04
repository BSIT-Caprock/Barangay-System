<?php

namespace App\Filament\Widgets;

use App\Models\Inhabitant;
use ArberMustafa\FilamentGoogleCharts\Widgets\PieChartWidget;

class SexPopulationChart extends PieChartWidget
{
    protected static ?string $heading = 'Population';

    protected static ?array $options = [
        'legend' => [
            'position' => 'top',
            'alignment' => 'center',
        ],
        'height' => 400,
        'is3D' => false,
    ];

    protected function getHeading(): string
    {
        return 'Population';
    }

    protected function getData(): array
    {
        $femaleCount = Inhabitant::where('sex_id', 2)->count();
        $maleCount = Inhabitant::where('sex_id', 1)->count();

        return [

            ['Label', 'Aggregate'],
            ['Female', $femaleCount],
            ['Male', $maleCount],
        ];
    }

    // protected function getType(): string
    // {
    //     return 'doughnut';
    // }
}
