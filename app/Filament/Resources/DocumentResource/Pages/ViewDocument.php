<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewDocument extends ViewRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->url(null),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecordTitle();
    }

    /** remove the '> View' part of the breadcrumbs */
    public function getBreadcrumbs(): array
    {
        $breadcrumbs = parent::getBreadcrumbs();
        array_pop($breadcrumbs);
        return $breadcrumbs;
    }
}
