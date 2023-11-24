<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;

class SelectBarangay extends Select
{
    public static function make(string $name = 'barangay_id'): static
    {
        return parent::make($name)
            ->relationship('barangay', 'name');
    }
}
