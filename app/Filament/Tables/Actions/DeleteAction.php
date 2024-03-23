<?php

namespace App\Filament\Tables\Actions;

class DeleteAction extends \Filament\Tables\Actions\DeleteAction
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->iconButton();
    }
}