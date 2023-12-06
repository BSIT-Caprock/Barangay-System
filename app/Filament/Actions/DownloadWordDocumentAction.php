<?php

namespace App\Filament\Actions;

use App\Contracts\DownloadableDocument;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class DownloadWordDocumentAction extends Action
{
    protected $template = null;

    protected $data = null;

    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->icon('heroicon-s-document-arrow-down')
            ->action(function (DownloadableDocument $record) {
                $processor = new TemplateProcessor($record->getTemplate());
                $processor->setValues($record->getTemplateValues());
                $filename = $record->getFilename();
                $filepath = Storage::path($filename);
                $processor->saveAs($filepath);

                return response()->download($filepath, $filename)->deleteFileAfterSend();
            });
    }
}
