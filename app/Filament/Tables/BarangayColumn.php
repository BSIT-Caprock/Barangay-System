<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class BarangayColumn extends TextColumn
{
    public static function make(string $name = 'barangay'): static
    {
        return parent::make($name)
            // show only if user has no barangay
            ->visible(!auth()->user()->barangay)
            // allow toggling only if column is visible
            ->toggleable(fn (Column $column) => $column->isVisible());
    }
}
