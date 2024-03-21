<?php

namespace App\Filament\Resources;

use App\FilamentExcel\Actions\Tables\TableExportBulkAction;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'filename';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('filepath')
                    ->required()
                    ->label('Template file')
                    ->acceptedFileTypes([
                        'text/plain',
                        'text/html',
                        'text/richtext',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.oasis.opendocument.text',
                        'application/pdf',
                    ])
                    ->storeFileNamesIn('filename')
                    ->disk(Document::DISK)
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('filename')
                    ->searchable(),
                Tables\Columns\TextColumn::make('filepath')
                    ->searchable(),
                Tables\Columns\TextColumn::make('outputs_count')
                    ->label('Total outputs')
                    ->counts('outputs'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download')->iconButton()
                    ->icon('heroicon-m-arrow-down-tray')
                    ->action(function (Document $record) {
                        return response()->download($record->full_path, $record->filename)->deleteFileAfterSend();
                    }),
                Tables\Actions\EditAction::make()->iconButton()->url(null),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ], Tables\Enums\ActionsPosition::BeforeColumns)
            ->bulkActions([
                TableExportBulkAction::make(),
                // Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OutputsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'view' => Pages\ViewDocument::route('/{record}'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
