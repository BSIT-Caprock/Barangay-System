<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentResource\Pages;
use App\Filament\Resources\ResidentResource\RelationManagers;
use App\Models\Resident;
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

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Individual Record of Barangay Inhabitants')
                ->schema([
                    TextInput::make('province')->required(),
                    TextInput::make('city_or_municipality')->label('City / Municipality') ->required(),
                    TextInput::make('barangay')->label('Barangay') ->required()
                ])->columns(4),

                Forms\Components\Section::make('Personal Information')
                ->description('Kindly fill out the information below.')
                ->schema([
                    TextInput::make('last_name')->required(),
                    TextInput::make('first_name')->required(),
                    TextInput::make('middle_name'),
                    TextInput::make('extension_name'),
                ])->columns(2),

                Forms\Components\Section::make('')
                ->schema([
                    DatePicker::make('birth_date')
                        ->label('Date of Birth')
                        ->format('Y-m'),

                    TextInput::make('birth_place')
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
                    Select::make('citizenship')
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

                    Select::make('ocupation')
                        ->label('Profession / Occupation')
                        ->options([
                            'teacher' => 'Teacher',
                            'nurse' => 'Nurse',
                            'police' => 'Police',
                            'student' => 'Student'
                        ])->required(),

                ])->columns(3),

                Forms\Components\Section::make('Residence Address')
                ->schema([
                    TextInput::make('houses_id')
                        ->label('House No.')
                        ->required(),

                    TextInput::make('street')
                        ->label('Street Name')
                        ->required(),

                    TextInput::make('zone')
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

                Tables\Columns\TextColumn::make('barangay_id')
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

                Tables\Columns\TextColumn::make('extension_name')
                    ->label('Extension Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Date of Birth')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('birth_place_id')
                    ->label('Place of Birth')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('gender_id')
                    ->label('Gender')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('civil_status_id')
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

                Tables\Columns\TextColumn::make('houses_number')
                    ->label('House No.')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('street_id')
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
