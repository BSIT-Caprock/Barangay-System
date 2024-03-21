<?php

namespace App\Filament\Resources;

use App\Filament\Tables\Actions\DownloadWordDocumentAction;
use App\FilamentExcel\Actions\Tables\TableExportAction;
use App\FilamentExcel\Actions\Tables\TableExportBulkAction;
use App\Filament\Resources\ResidencyCertificateResource\Pages;
use App\Models\CivilStatus;
use App\Models\Inhabitant;
use App\Models\ResidencyCertificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResidencyCertificateResource extends Resource
{
    protected static ?string $model = ResidencyCertificate::class;

    protected static ?string $navigationGroup = 'Certificates';

    protected static ?string $navigationIcon = 'icon-certificate-24';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\Grid::make(1)->schema(
                        [
                            Forms\Components\Select::make('inhabitant')
                                ->label('Select existing inhabitant')
                                ->searchable()
                                ->searchPrompt('<Name> or <Last name, First name>')
                                ->getSearchResultsUsing(fn (string $search): array => Inhabitant::whereFullName($search)
                                    ->limit(10)
                                    ->get()
                                    ->pluck('full_name', 'id')
                                    ->toArray())
                                ->afterStateUpdated(function ($state, Forms\Set $set) {
                                    $model = Inhabitant::find($state);

                                    $set('resident_name', strtoupper($model->full_name_first));
                                    $set('resident_age', $model->age);
                                    $set('resident_citizenship', (string) $model->citizenship);
                                    $set('resident_civil_status', (string) $model->civil_status);
                                })
                                ->live(),
                        ]
                    ),

                    Forms\Components\TextInput::make('resident_name')->required()->autocapitalize(),

                    Forms\Components\TextInput::make('resident_age')->required(),

                    Forms\Components\TextInput::make('resident_citizenship')->required(),

                    Forms\Components\Select::make('resident_civil_status')->required()
                        ->options(CivilStatus::all()->pluck('name', 'name'))
                        ->native(false),

                    Forms\Components\TextInput::make('punong_barangay')->required()->autocapitalize(),

                    Forms\Components\DatePicker::make('date_issued')->required(),

                    Forms\Components\TextInput::make('amount_paid')->required(),

                    Forms\Components\TextInput::make('dst')->label('DST')->required(),

                    Forms\Components\TextInput::make('receipt_number')->label('O.R. #')->required(),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    Tables\Columns\TextColumn::make('receipt_number')->label('O.R. #'),

                    Tables\Columns\TextColumn::make('resident_name'),

                    Tables\Columns\TextColumn::make('resident_age')->toggleable()->toggledHiddenByDefault(),

                    Tables\Columns\TextColumn::make('resident_civil_status')->toggleable()->toggledHiddenByDefault(),

                    Tables\Columns\TextColumn::make('amount_paid')->money('Php'),

                    Tables\Columns\TextColumn::make('dst')->label('DST')->money('Php'),

                    Tables\Columns\TextColumn::make('date_issued')->date('M d, Y'),
                ]
            )
            ->filters(
                [
                    Tables\Filters\TrashedFilter::make(),
                ]
            )
            ->headerActions(
                [
                    TableExportAction::make(),

                    Tables\Actions\CreateAction::make(),
                ]
            )
            ->actions(
                [
                    Tables\Actions\EditAction::make()->iconButton()->color('primary'),

                    DownloadWordDocumentAction::make('download_document')->iconButton(),
                ],
                Tables\Enums\ActionsPosition::BeforeColumns
            )
            ->bulkActions(
                [
                    TableExportBulkAction::make(),

                    Tables\Actions\RestoreBulkAction::make(),

                    Tables\Actions\DeleteBulkAction::make(),
                ]
            );
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageResidencyCertificates::route('/'),
        ];
    }
}
