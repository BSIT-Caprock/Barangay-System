<?php

namespace App\Filament\Resources\DocumentResource\RelationManagers;

use App\Filament\Actions\FilamentExcel\TableExportAction;
use App\Models\Document;
use App\Models\DocumentOutput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class OutputsRelationManager extends RelationManager
{
    protected static string $relationship = 'outputs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\KeyValue::make('data'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('data')
                    ->searchable()
                    ->badge()
                    ->state(function (DocumentOutput $record) {
                        return array_map(fn ($key, $value) => "$key: $value", array_keys($record->data), $record->data);
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                TableExportAction::make(),
                Tables\Actions\CreateAction::make()->authorize(true),
            ])
            ->actions([
                Tables\Actions\Action::make('download')->iconButton()
                    ->icon('heroicon-m-arrow-down-tray')
                    ->action(function (DocumentOutput $record) {
                        $template = new TemplateProcessor($record->template->full_path);
                        $template->setValues($record->data);
                        $tempPath = Storage::path('randomName');
                        $template->saveAs($tempPath);

                        return response()->download($tempPath, now()->unix() . '_' . $record->template->filename)->deleteFileAfterSend();
                    }),
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),

            ], Tables\Enums\ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
