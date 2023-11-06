<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentResource\Pages;
use App\Filament\Resources\ResidentResource\RelationManagers;
use App\Models\Residents\Resident;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;


class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'latest_record.full_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Individual Record of Barangay Inhabitants')
                ->schema([
                    TextInput::make('region')->required(),
                    TextInput::make('province')->required(),
                    TextInput::make('city_or_municipality')->label('City / Municipality') ->required(),
                    TextInput::make('barangay')->required()
                ])->columns(4),

                Forms\Components\Section::make('Personal Information')
                ->description('Kindly fill out the information below.')
                ->schema([
                    TextInput::make('last_name')->required(),
                    TextInput::make('first_name')->required(),
                    TextInput::make('middle_name'),
                    TextInput::make('suffix_name'),
                ])->columns(2),

                Forms\Components\Section::make('')
                ->schema([
                    DatePicker::make('birth_date')
                        ->label('Date of Birth')
                        ->format('m/d/'),

                    TextInput::make('birth_place_id')
                        ->label('Place of Birth') 
                        ->required(),     
                    
                    Select::make('gender')
                        ->label('Sex')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                        ])->required(),
                    
                ])->columns(3),

                Forms\Components\Section::make('')
                ->schema([
                    Select::make('citizenship_id')
                        ->label('Citizenship')
                        ->options([
                            'filipino' => 'Filipino',
                            'american' => 'American',
                            'japanese' => 'Japanese',
                        ])->required(),

                    Select::make('civil_status')
                        ->label('Civil Status')
                        ->options([
                            'single' => 'Single',
                            'married' => 'Married',
                            'widowed' => 'Widowed',
                            'separated' => 'Separated',
                        ])->required(),

                    Select::make('ocupation_id')
                        ->label('Profession / Occupation')
                        ->options([
                            'teacher' => 'Filipino',
                            'nurse' => 'Nurse',
                            'police' => 'Nurse',
                        ])->required(),

                ])->columns(3),

                Forms\Components\Section::make('Residence Address')
                ->schema([
                    TextInput::make('houses_id')
                        ->label('House No.')
                        ->required(),

                    TextInput::make('streets_id')
                        ->label('Street Name')
                        ->required(),

                    TextInput::make('zone_id')
                        ->label('Zone No.')
                        ->required(),

                ])->columns(3),

                Forms\Components\Section::make('Thumbmark')
                ->schema([
                    FileUpload::make('left_fingerprint')
                        ->label('Left Thumbmark')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->preserveFilenames()
                        ->openable()
                        ->downloadable()
                        ->previewable(false),

                    FileUpload::make('right_fingerprint')
                        ->label('Right Thumbmark')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->preserveFilenames()
                        ->openable()
                        ->downloadable()
                        ->previewable(false)

                ])->columns(2)

            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('region')
                    ->label('Region')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('province')
                    ->label('Province')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('city_or_municipality')
                    ->label('Municipality')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('barangay')
                    ->label('Barangay')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('middle_name')
                    ->label('Middle Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('suffix_name')
                    ->label('Suffix Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('Date of Birth')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('birth_place_id')
                    ->label('Place of Birth')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('civil_status')
                    ->label('Civil Status')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('citizenship_id')
                    ->label('Citizenship')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('occupation_id')
                    ->label('Profession / Occupation')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('houses_id')
                    ->label('House No.')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('streets_id')
                    ->label('Street Name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('zone_id')
                    ->label('Zone No.')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('left_fingerprint')
                    ->label('Left Thumbmark')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('right_fingerprint')
                    ->label('Right Thumbmark')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('age')
                    ->options([
                        'minor' => 'Minor',
                        'adult' => 'Adult',
                        'senior citizen' => 'Senior citizen',
                    ])
                    ->query(function (Builder $builder, array $data) {
                        // query scope
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListResidents::route('/'),
            'create' => Pages\CreateResident::route('/create'),
            'edit' => Pages\EditResident::route('/{record}/edit'),
        ];
    }
}
