<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Municipality;
use App\Models\Neighborhood;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;

//use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
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
                    self::getPropertyInformationWizard(),

                    self::getPropertyLocationWizard(),

                    self::getPropertyAmenitiesWizard(),

                    self::getPropertyGalleryWizard(),

                    self::getPropertyStatusWizard()
                ])
                    ->skippable()
                    ->persistStepInQueryString()
                    ->columnSpanFull()

                /*

                */
            ]);
    }

    public static function getNameFormField()
    {
        return TextInput::make('name')
            ->autofocus()
            ->required()
            ->live(onBlur: true)
            ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state)))
            ->maxLength(255);
    }

    public static function getSlugFormField(): Forms\Components\TextInput
    {
        return TextInput::make('slug')
            ->required()
            ->unique(ignoreRecord: true)
            ->disabled()
            ->dehydrated()
            ->maxLength(255);
    }

    public static function getPropertyInformationWizard()
    {
        return Wizard\Step::make('Property Information')
            ->icon('heroicon-o-home')
            ->columns(3)
            ->schema([
                Section::make()
                    ->columns(2)
                    ->columnSpan(2)
                    ->schema([
                        self::getNameFormField(),
                        self::getSlugFormField(),

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
                                        self::getNameFormField(),
                                        self::getSlugFormField(),
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
                                'Venta' => 'Venta',
                                'Alquiler' => 'Alquiler',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('area')
                            ->numeric()
                            ->label('Property Size')
                            ->required()
                            ->placeholder('Size in square meters')
                            ->suffix('m²')
                            ->minValue(0),

                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->inputMode('float')
                            ->minValue(0)
                            ->prefix('$')
                            ->suffix('DOP')
                            ->minValue(0),

                        DatePicker::make('year_built')
                            ->placeholder('Select a date')
                            ->displayFormat('M Y')
                            ->maxDate(now())
                            ->closeOnDateSelection()
                            ->native(false),
                    ]),
            ]);
    }

    public static function getPropertyLocationWizard()
    {
        return Wizard\Step::make('Property Location')
            ->icon('heroicon-o-map-pin')
            ->columns(2)
            ->schema([
                Select::make('province_id')
                    ->required()
                    ->relationship('province', 'name')
                    ->afterStateUpdated(function(Set $set, $state) {
                        $set('municipality_id', null);
                        $set('neighborhood_id', null);
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->native(false),

                Select::make('municipality_id')
                    ->label('Municipality')
                    ->required()
                    ->options(fn(Get $get): Collection => Municipality::query()
                        ->where('province_id', $get('province_id'))
                        ->pluck('name', 'id'))
                    ->afterStateUpdated(fn(Set $set, $state) => $set('neighborhood_id', null))
                    ->searchable()
                    ->preload()
                    ->live()
                    ->native(false),

                Select::make('neighborhood_id')
                    ->label('Neighborhood')
                    ->required()
                    ->options(fn(Get $get): Collection => Neighborhood::query()
                        ->where('municipality_id', $get('municipality_id'))
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->live()
                    ->native(false),
                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function getPropertyAmenitiesWizard()
    {
        return Wizard\Step::make('Property Amenities')
            ->icon('heroicon-o-sparkles')
            ->schema([
                Section::make('Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('bedrooms')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('bathrooms')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('garages')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('floors')
                            ->numeric()
                            ->minValue(0)
                    ]),

                Section::make('Amenities')
                    ->schema([
                        CheckboxList::make('amenities')
                            ->relationship('amenities', 'name')
                            ->columnSpanFull()
                            ->columns(3)
                            ->bulkToggleable()
                            ->searchable()
                            ->noSearchResultsMessage('No amenities found.')
                            ->gridDirection('row')
                    ])
            ]);
    }

    public static function getPropertyGalleryWizard()
    {
        return Wizard\Step::make('Property Gallery')
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make('Thumbnail')
                    ->columns(1)
                    ->collapsed(false)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->disk('public')
                            ->moveFiles()
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull()
                    ]),
                Section::make('Gallery')
                    ->columns(1)
                    ->collapsed()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->collection('gallery')
                            ->disk('public')
                            ->multiple()
                            ->reorderable()
                            ->imageEditor()
                            ->moveFiles()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull()
                    ])
            ]);
    }

    public static function getPropertyStatusWizard()
    {
        return Wizard\Step::make('Property Status')
            ->icon('heroicon-o-battery-50')
            ->columns(2)
            ->schema([
                Section::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\Group::make()
                            ->columns(2)
                            ->columnSpanFull()
                            ->schema([
                                Select::make('property_status_id')
                                    ->relationship('propertyStatus', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->native(false),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->placeholder('Select a date')
                                    ->required()
                                    ->native(false),
                            ]),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('published')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('available')
                            ->default(true),
                        Forms\Components\Toggle::make('featured'),
                        Forms\Components\Toggle::make('negotiable'),
                        Forms\Components\Toggle::make('furnished'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail'),
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('gallery')
                    ->label('Gallery')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('code')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->limit(20)
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Agent')
                    ->sortable(),
                Tables\Columns\TextColumn::make('propertyType.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('municipality.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('neighborhood.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('propertyStatus.name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('featured')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('available')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('published'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('is_active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            //            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->tooltip('View Property'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Edit Property'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Delete Property'),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'secondary';
    }
}
