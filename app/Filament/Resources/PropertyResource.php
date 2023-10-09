<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;

//use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Properties';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Property Information')
                        ->icon('heroicon-o-home')
                        ->columns(3)
                        ->schema([
                            Section::make()
                                ->columns(2)
                                ->columnSpan(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->autofocus()
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state)))
                                        ->maxLength(255),
                                    TextInput::make('slug')
                                        ->required()
                                        ->disabled()
                                        ->dehydrated()
                                        ->maxLength(255),

                                    Select::make('property_type_id')
                                        ->relationship('propertyType', 'name')
                                        ->required()
                                        ->preload()
                                        ->searchable()
                                        ->native(false)
                                        ->createOptionForm([
                                            Section::make()
                                                ->columns(2)
                                                ->schema([
                                                    TextInput::make('name')
                                                        ->autofocus()
                                                        ->required()
                                                        ->maxLength(255)
                                                        ->live(onBlur: true)
                                                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state))),
                                                    TextInput::make('slug')
                                                        ->disabled()
                                                        ->dehydrated()
                                                        ->required()
                                                        ->maxLength(255),
                                                    Textarea::make('description')
                                                        ->rows(4)
                                                        ->maxLength(65535)
                                                        ->nullable()
                                                        ->columnSpanFull(),
                                                    Toggle::make('is_active')
                                                        ->default(true)
                                                        ->label('Active')
                                                        ->required(),
                                                ])
                                        ]),

                                    Textarea::make('short_description')
//                                        ->rows(3)
                                        ->autosize()
                                        ->maxLength(65535),

                                    RichEditor::make('description')
                                        ->maxLength(65535)
                                        ->columnSpanFull(),
                                ]),

                            Section::make()
                                ->columns(1)
                                ->columnSpan(1)
                                ->schema([
                                    Select::make('purpose')
                                        ->options([
                                            'venta' => 'Venta',
                                            'alquiler' => 'Alquiler',
                                        ])
                                        ->required()
                                        ->native(false),

                                    TextInput::make('area')
                                        ->label('Property Size')
                                        ->placeholder('Size in square meters')
                                        ->suffix('m²')
                                        ->numeric(),

                                    TextInput::make('price')
                                        ->numeric()
                                        ->required()
                                        ->inputMode('float')
                                        ->minValue(0)
                                        ->prefix('$')
                                        ->suffix('DOP'),

                                    DatePicker::make('year_built')
                                        ->placeholder('Select a date')
                                        ->displayFormat('M Y')
                                        ->maxDate(now())
                                        ->closeOnDateSelection()
                                        ->native(false),
                                ]),

                            FileUpload::make('thumbnail')
                                ->columnSpanFull()
                                ->disk('public')
                                ->directory('properties/thumbnails')
//                                        ->image()
                                ->imageEditor()
                                ->moveFiles()
                                ->openable()
                                ->downloadable()
                        ]),

                ])->columnSpanFull()

                /*
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('property_type_id')
                    ->relationship('propertyType', 'name')
                    ->required(),
                Forms\Components\Select::make('province_id')
                    ->relationship('province', 'name'),
                Forms\Components\Select::make('municipality_id')
                    ->relationship('municipality', 'name'),
                Forms\Components\Select::make('neighborhood_id')
                    ->relationship('neighborhood', 'name'),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('thumbnail')
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\Textarea::make('map')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->maxLength(255),
                Forms\Components\TextInput::make('longitude')
                    ->maxLength(255),
                Forms\Components\TextInput::make('purpose')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('area')
                    ->numeric(),
                Forms\Components\TextInput::make('bedrooms')
                    ->numeric(),
                Forms\Components\TextInput::make('bathrooms')
                    ->numeric(),
                Forms\Components\TextInput::make('garages')
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('floors')
                    ->numeric(),
                Forms\Components\TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('featured')
                    ->required(),
                Forms\Components\Toggle::make('sold'),
                Forms\Components\Toggle::make('rented'),
                Forms\Components\Toggle::make('available')
                    ->required(),
                Forms\Components\Toggle::make('negotiable')
                    ->required(),
                Forms\Components\Toggle::make('furnished'),
                Forms\Components\Toggle::make('published')
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at'),
                Forms\Components\DatePicker::make('year_built'),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('propertyType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipality.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('neighborhood.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('purpose')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bedrooms')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bathrooms')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('garages')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('floors')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('available')
                    ->boolean(),
                Tables\Columns\IconColumn::make('negotiable')
                    ->boolean(),
                Tables\Columns\IconColumn::make('furnished')
                    ->boolean(),
                Tables\Columns\IconColumn::make('published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_built')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
