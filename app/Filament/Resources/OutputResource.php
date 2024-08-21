<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutputResource\Pages;
use App\Models\Generator\Output;
use App\Models\Generator\Template;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class OutputResource extends Resource
{
    protected static ?string $model = Output::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Document Generator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('template_id')
                    ->disabledOn('edit')
                    ->relationship('template', 'title')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if (empty($state)) {
                            return;
                        }
                        $set('template_data', array_fill_keys(Template::find($state)->macros, null));
                    }),
                Forms\Components\KeyValue::make('template_data')
                    ->required()
                    ->visible(fn (Get $get) => (bool) $get('template_id'))
                    ->editableKeys(false) //! do not remove
                    ->dehydrateStateUsing(fn ($state) => Arr::dot($state)) //! do not remove
                    ->hintAction(
                        Forms\Components\Actions\Action::make('download')
                            ->icon('heroicon-c-arrow-down-tray')
                            ->action(function (Get $get) {
                                if (empty($get('template_id'))) {
                                    return;
                                }
                                /** @var Template */
                                $template = Template::find($get('template_id'));
                                $processor = $template->makeProcessor();
                                $processor->setValues($get('template_data'));
                                $filename = \Illuminate\Support\Str::ulid().$template->file_name;
                                $filepath = Storage::path($filename);
                                $processor->saveAs($filepath);

                                return response()->download($filepath, $filename)->deleteFileAfterSend();
                            })
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('template.title'),
                Tables\Columns\TextColumn::make('template_data')
                    ->badge()
                    ->getStateUsing(function (Output $record) {
                        $template_data = $record->template_data;

                        return array_map(fn ($k, $v) => "$k: $v", array_keys($template_data), $template_data);
                    }),
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
            'index' => Pages\ListOutputs::route('/'),
            'create' => Pages\CreateOutput::route('/create'),
            'edit' => Pages\EditOutput::route('/{record}/edit'),
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
