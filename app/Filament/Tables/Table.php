<?php

namespace App\Filament\Tables;

use Filament\Tables;

class Table extends \Filament\Tables\Table
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actionsPosition(Tables\Enums\ActionsPosition::BeforeColumns);
    }
}