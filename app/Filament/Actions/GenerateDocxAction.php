<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class GenerateDocxAction extends Action
{
    protected $template = null;

    protected $data = null;

    public static function make(?string $name = null): static
    {
        $static = parent::make($name)
            ->icon('heroicon-s-document-arrow-down')
            ->color('primary');
        
        return $static;
    }

    public function processTemplate(\Closure $template, \Closure $data, \Closure $identifier)
    {
        $this->action(function (Model $record) use ($template, $data, $identifier) {
            $template = $template($record);
            $processor = new TemplateProcessor($template);
            $data = $data($record);
            $processor->setValues($data);
            $templateinfo = pathinfo($template);
            $filename = time()  . '_' . $identifier($record) . "_{$templateinfo['basename']}";
            $filepath = Storage::path("/tmp/{$filename}");
            $processor->saveAs($filepath);

            return response()->download($filepath, $filename)->deleteFileAfterSend();
        });

        return $this;
    }
}
