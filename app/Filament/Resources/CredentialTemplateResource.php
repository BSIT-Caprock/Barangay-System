<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CredentialTemplateResource\Pages;
use App\Filament\Resources\CredentialTemplateResource\RelationManagers;
use App\Models\CredentialTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CredentialTemplateResource extends Resource
{
    protected static ?string $model = CredentialTemplate::class;

    protected static ?string $navigationParentItem = 'Credentials';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('file_path')
                    ->required()
                    ->label('File')
                    ->disk('local')
                    ->directory('templates')
                    ->storeFileNamesIn('file_name')
                    ->downloadable()
                    ->afterStateUpdated(static function (TemporaryUploadedFile $state, Forms\Get $get, Forms\Set $set, string $operation) {
                        if ($operation == 'create' && blank($get('title'))) {
                            $set('title', pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME));
                        }
                    }),
                Forms\Components\TextInput::make('title')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
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
