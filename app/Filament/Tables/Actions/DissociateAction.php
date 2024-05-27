<?php

namespace App\Filament\Tables\Actions;

class DissociateAction extends \Filament\Tables\Actions\DissociateAction
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->iconButton();
    }
}