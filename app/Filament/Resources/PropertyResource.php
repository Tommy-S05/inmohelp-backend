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
    protected static ?string $navigationLabel = 'Propiedades';
    protected static ?string $navigationGroup = 'Propiedades';
    protected static ?string $breadcrumb = 'propiedades';
    protected static ?string $label = 'propiedades';
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
            ->label('Nombre')
            ->autofocus()
            ->required()
            ->live(onBlur: true)
            ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state)))
            ->maxLength(255);
    }

    public static function getSlugFormField(): Forms\Components\TextInput
    {
        return TextInput::make('slug')
            ->label('Slug')
            ->required()
            ->unique(ignoreRecord: true)
            ->disabled()
            ->dehydrated()
            ->maxLength(255);
    }

    public static function getPropertyInformationWizard()
    {
        return Wizard\Step::make('Información')
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
                            ->label('Tipo de propiedad')
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
                                            ->label('Descripción')
                                            ->rows(4)
                                            ->maxLength(65535)
                                            ->nullable()
                                            ->columnSpanFull(),
                                        Toggle::make('is_active')
                                            ->label('Activo')
                                            ->default(true)
                                            ->label('Active')
                                            ->required(),
                                    ])
                            ]),

                        Textarea::make('short_description')
                            ->label('Descripción corta')
                            ->autosize()
                            ->maxLength(65535),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->maxLength(65535)
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make()
                    ->columns(1)
                    ->columnSpan(1)
                    ->schema([
                        Select::make('purpose')
                            ->label('Propósito')
                            ->options([
                                'Venta' => 'Venta',
                                'Alquiler' => 'Alquiler',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('area')
                            ->label('Tamaño de la propiedad')
                            ->numeric()
                            ->required()
                            ->placeholder('Size in square meters')
                            ->suffix('m²')
                            ->minValue(0),

                        TextInput::make('price')
                            ->label('Precio')
                            ->numeric()
                            ->required()
                            ->inputMode('float')
                            ->minValue(0)
                            ->prefix('$')
                            ->suffix('DOP')
                            ->minValue(0),

                        DatePicker::make('year_built')
                            ->label('Año de construcción')
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
        return Wizard\Step::make('Localización')
            ->icon('heroicon-o-map-pin')
            ->columns(2)
            ->schema([
                Select::make('province_id')
                    ->label('Provincia')
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
                    ->label('Municipio')
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
                    ->label('Sector')
                    ->required()
                    ->options(fn(Get $get): Collection => Neighborhood::query()
                        ->where('municipality_id', $get('municipality_id'))
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->live()
                    ->native(false),
                TextInput::make('address')
                    ->label('Dirección')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function getPropertyAmenitiesWizard()
    {
        return Wizard\Step::make('Amenidades')
            ->icon('heroicon-o-sparkles')
            ->schema([
                Section::make('Detalles')
                    ->columns(2)
                    ->schema([
                        TextInput::make('bedrooms')
                            ->label('Habitaciones')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('bathrooms')
                            ->label('Baños')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('garages')
                            ->label('Garajes')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('floors')
                            ->label('Pisos')
                            ->numeric()
                            ->minValue(0)
                    ]),

                Section::make('Amenidades')
                    ->schema([
                        CheckboxList::make('amenities')
                            ->label('Amenidades')
                            ->relationship('amenities', 'name')
                            ->columnSpanFull()
                            ->columns(3)
                            ->bulkToggleable()
                            ->searchable()
                            ->noSearchResultsMessage('No se encuentran amenidades.')
                            ->gridDirection('row')
                    ])
            ]);
    }

    public static function getPropertyGalleryWizard()
    {
        return Wizard\Step::make('Galería')
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make('Miniatura')
                    ->columns(1)
                    ->collapsed(false)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Miniatura')
                            ->collection('thumbnail')
                            ->disk('public')
                            ->moveFiles()
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull()
                    ]),
                Section::make('Galería')
                    ->columns(1)
                    ->collapsed()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->label('Imagénes')
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
        return Wizard\Step::make('Estado')
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
                                    ->label('Estado')
                                    ->relationship('propertyStatus', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->native(false),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Fecha de publicación')
                                    ->placeholder('Select a date')
                                    ->required()
                                    ->native(false),
                            ]),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('published')
                            ->label('Publicada')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('available')
                            ->label('Disponible')
                            ->default(true),
                        Forms\Components\Toggle::make('featured')
                            ->label('Destacada')
                            ->default(false),
//                        Forms\Components\Toggle::make('negotiable'),
//                        Forms\Components\Toggle::make('furnished'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Miniatura')
                    ->collection('thumbnail'),
                SpatieMediaLibraryImageColumn::make('images')
                    ->label('Galería')
                    ->collection('gallery')
                    ->label('Gallery')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->limit(20)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Agente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('propertyType.name')
                    ->label('Tipo de propiedad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->label('Propósito')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->label('Área')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money('DOP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->label('Provincia')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('municipality.name')
                    ->label('Municipio')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('neighborhood.name')
                    ->label('Sector')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('propertyStatus.name')
                    ->label('Estado')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('featured')
                    ->label('Destacada')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('available')
                    ->label('Disponible')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('published')
                    ->label('Publicada'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Fecha de publicación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Activa'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizada')
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
                    ->tooltip('Ver Propiedad'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Editar Propiedad'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Eliminar Propiedad'),
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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        if(auth()->user()->hasRole([1, 'Admin'])) {
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }

    public static function getNavigationBadge(): ?string
    {
        $count = self::getEloquentQuery()->count();
        return $count !== null ? (string)$count : '0';
        //        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'secondary';
    }
}
