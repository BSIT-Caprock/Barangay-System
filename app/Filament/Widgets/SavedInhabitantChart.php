<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Inhabitant;

class SavedInhabitantChart extends ChartWidget
{
    protected static ?string $heading = 'Saved Inhabitants Record Per Month';

    protected function getData(): array
    {
        $data = Trend::model(Inhabitant::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Saved Inhabitants Record',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
    protected static string $color = 'danger';

    protected function getType(): string
    {
        return 'bar';

    }
}
