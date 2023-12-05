<?php

namespace App\Filament\Widgets;

use App\Models\Inhabitant;
use ArberMustafa\FilamentGoogleCharts\Widgets\DonutChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AgeChart extends DonutChartWidget
{
    protected static ?string $heading = 'Age Groups';

    protected static ?float $pieHole = 0.5;

    protected static ?array $options = [
        'legend' => [
            'position' => 'top',
        ],
        'height' => 400,

    ];

    protected function getHeading(): string
    {
        return 'Age Group';
    }

    protected function getData(): array
    {
        $currentYear = date('Y');
        $results = Inhabitant::selectRaw("strftime('%Y', birth_date) AS birth_year")->get();
        $infantCount = 0;
        $toddlerCount = 0;
        $childCount= 0;
        $teenCount = 0;
        $adultCount = 0;
        $midAgeCount = 0;
        $seniorCount = 0;

        foreach ($results as $result) {
            $birthYear = $result->birth_year;
            $age = $currentYear - $birthYear;
            if ($age <= 1){
                $infantCount++;
            }
            if ($age > 1 && $age < 5){
                $toddlerCount++;
            }
            if ($age > 6 && $age < 13){
                $childCount++;
            }
            if ($age > 14 && $age < 20){
                $teenCount++;
            }
            if ($age > 19 && $age < 40){
                $adultCount++;
            }
            if ($age > 39 && $age < 60){
                $midAgeCount++;
            }
            if ($age > 60){
                $seniorCount++;
            }
        }

        return [
            ['Label', 'Aggregate'],
            ['Infant', $infantCount],
            ['Toddler', $toddlerCount],
            ['Child', $childCount],
            ['Teen', $teenCount],
            ['Adult', $adultCount],
            ['Middle Age Adult', $midAgeCount],
            ['Senior Citizen', $seniorCount],
        ];
    }

    // protected function getType(): string
    // {
    //     return 'doughnut';
    // }
}
