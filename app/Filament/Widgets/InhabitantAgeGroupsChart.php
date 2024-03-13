<?php

namespace App\Filament\Widgets;

use App\Models\Inhabitant;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class InhabitantAgeGroupsChart extends ChartWidget
{
    protected static ?string $heading = 'Age Groups';

    protected int | string | array $columnSpan = '2';

    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $yearNow = now()->year;
        $inhabitants = Inhabitant::select(DB::raw(''));

        $currentYear = date('Y');
        $results = Inhabitant::selectRaw("strftime('%Y', birth_date) AS birth_year")->get();
        $infantCount = 0;
        $toddlerCount = 0;
        $childCount = 0;
        $teenCount = 0;
        $adultCount = 0;
        $seniorCount = 0;

        foreach ($results as $result) {
            $birthYear = $result->birth_year;
            $age = $currentYear - $birthYear;
            
            if ($age < 1) {
                $infantCount++;
            }

            if ($age >= 1 && $age <= 5) {
                $toddlerCount++;
            }

            if ($age >= 6 && $age <= 12) {
                $childCount++;
            }

            if ($age >= 13 && $age <= 19) {
                $teenCount++;
            }

            if ($age >= 20 && $age <= 59) {
                $adultCount++;
            }

            if ($age >= 60) {
                $seniorCount++;
            }
        }

        return [
            'datasets' => [[
                'label' => 'Age Groups',
                'data' => [
                    // Inhabitant::agedBetween(0)->count(),
                    // Inhabitant::agedBetween(1, 5)->count(),
                    // Inhabitant::agedBetween(6, 12)->count(),
                    // Inhabitant::agedBetween(13, 19)->count(),
                    // Inhabitant::agedBetween(20, 59)->count(),
                    // Inhabitant::agedBetween(60, 180)->count(),

                    $infantCount,
                    $toddlerCount,
                    $childCount,
                    $teenCount,
                    $adultCount,
                    $seniorCount,
                ],
                'backgroundColor' => [
                    '#ef4444', // red
                    '#f97316', // orange
                    '#eab308', // yellow
                    '#22c55e', // green
                    '#3b82f6', // blue
                    '#8b5cf6', // violet
                ],
                'borderColor' => '#fff'
            ]],
            'labels' => [
                '< 1',
                '1-5',
                '6-12',
                '13-19',
                '20-59',
                '> 60',
            ]
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array|RawJs|null
    {
        return [
            // 'plugins' => [
            //     'legend' => [
            //         'display' => false,
            //     ]
            // ]
        ];
    }
}
