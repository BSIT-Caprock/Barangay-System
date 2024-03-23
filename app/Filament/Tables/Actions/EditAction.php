<?php

namespace App\Filament\Tables\Actions;

class EditAction extends \Filament\Tables\Actions\EditAction
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->iconButton();
    }
}