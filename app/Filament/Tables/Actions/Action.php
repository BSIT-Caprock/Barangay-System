<?php

namespace App\Filament\Tables\Actions;

class Action extends \Filament\Tables\Actions\Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->iconButton();
    }
}