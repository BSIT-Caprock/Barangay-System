<?php

namespace App\Filament\Resources\InhabitantResource\Widgets;

use App\Models\Inhabitant;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class MaleAndFemaleInhabitantsChart extends ChartWidget
{
    // protected static ?string $heading = 'Chart';

    protected static ?string $maxHeight = '100px';

    protected static string $color = 'primary';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [Inhabitant::male()->count(), Inhabitant::female()->count()],
                ]
            ],
            'labels' => ['Male', 'Female'],
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
            'colors' => [
                'enabled' => true,
            ]
        ];
    }
}
