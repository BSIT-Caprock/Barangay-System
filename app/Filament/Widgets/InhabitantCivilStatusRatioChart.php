<?php

namespace App\Filament\Widgets;

use App\Models\Inhabitant;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class InhabitantCivilStatusRatioChart extends ChartWidget
{
    protected static ?string $heading = 'Civil Status';

    protected function getData(): array
    {
        return [
            'datasets' => [[
                'label' => 'Inhabitants',
                'data' => [
                    Inhabitant::single()->count(),
                    Inhabitant::married()->count(),
                    Inhabitant::widowed()->count(),
                    Inhabitant::separated()->count(),
                ],
                'backgroundColor' => [
                    '#ef4444', // red
                    // '#f97316', // orange
                    '#eab308', // yellow
                    // '#22c55e', // green
                    '#3b82f6', // blue
                    '#8b5cf6', // violet
                ],
                'rotation' => 180,
            ]],
            'labels' => ['Single', 'Married', 'Widow/Widower', 'Separated'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array|RawJs|null
    {
        return [
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
        ];
    }
}
