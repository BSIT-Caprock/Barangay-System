<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CredentialTemplateResource\Pages;
use App\Filament\Resources\CredentialTemplateResource\RelationManagers;
use App\Models\CredentialTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CredentialTemplateResource extends Resource
{
    protected static ?string $model = CredentialTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('filepath')
                    ->required()
                    ->label('File')
                    ->disk('local')
                    ->directory('templates')
                    ->storeFileNamesIn('filename')
                    ->afterStateUpdated(static function (TemporaryUploadedFile $state, Set $set) {
                        $set('title', pathinfo($state->getClientOriginalName())['filename']);
                    }),
                Forms\Components\TextInput::make('title'),
                Forms\Components\TextInput::make('storage_path')
                    ->label('Filepath')
                    ->visibleOn('edit')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(static function (?string $state, string $operation, ?CredentialTemplate $record) {
                        return $operation === 'edit' ? $record->filepath : $state;
                    }),
                Forms\Components\KeyValue::make('placeholders')
                    ->visibleOn('edit')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn () => [
                        'token_a|format_1' => 'value 1',
                        'Label B|token_a|format_2' => 'value 2',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('filename')
                    ->searchable(),
                Tables\Columns\TextColumn::make('filepath')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCredentialTemplates::route('/'),
            'create' => Pages\CreateCredentialTemplate::route('/create'),
            'edit' => Pages\EditCredentialTemplate::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
