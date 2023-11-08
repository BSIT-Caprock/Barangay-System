<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportsResource\Pages;
use App\Filament\Resources\ReportsResource\RelationManagers;
use App\Models\Reports;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class ReportsResource extends Resource
{
    protected static ?string $model = Reports::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Committee Reports';

    protected static ?string $navigationLabel = 'Monthly Reports';
    
    public static function getNavigationBadge(): ?string {

        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('')
                    ->description('Kindly fill up the needed information to generate the report.')
                    ->schema([
                        Forms\Components\TextInput::make('month')
                        ->label('Month of')
                        ->required(),

                        Forms\Components\TextInput::make('year')
                        ->label('Year of')
                        ->required(),

                    ])->columns(2),

                    Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\TextInput::make('type')
                        ->label('Type of Report')
                        ->required()
                        ->maxLength(125),

                        Forms\Components\MarkdownEditor::make('name')
                        ->label('Name / Description of the Activities')
                        ->columnSpanFull()
                        ->required()
                        ->columnSpanFull(),
                    ])
                
                    ]),


                Forms\Components\Group::make()
                ->schema([

                    Forms\Components\Section::make('Date Implementation')
                    ->schema([
                        Forms\Components\DatePicker::make('date_started')
                        ->required(),
                        
                        Forms\Components\DatePicker::make('date_completed')
                        ->required(),

                        Forms\Components\TextInput::make('remarks')
                        ->helperText('Type here such as On-going or -do-')
                        ->required()
                        ->maxLength(125),
                    ])
                    ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('month')
                    ->label('Month')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Year')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type of Reports')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name / Description of the Activities')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_started')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_completed')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('remarks')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReports::route('/create'),
            'edit' => Pages\EditReports::route('/{record}/edit'),
        ];
    }    
}
