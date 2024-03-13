<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getColumns(): int | string | array
    {
        return [
            'sm' => 2,
            'md' => 3,
            'xl' => 4,
        ];
    }
}
