<?php

namespace App\Filament\Tables\Actions;

class ViewAction extends \Filament\Tables\Actions\ViewAction
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->iconButton();
        $this->color('primary');
    }
}