<?php

namespace App\Filament\Tables\Actions;

class DownloadAction extends \Filament\Tables\Actions\Action
{
    public static function getDefaultName(): ?string
    {
        return 'download';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->icon('heroicon-m-arrow-down-tray');
        $this->iconButton();
    }
}
