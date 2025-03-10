<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityResource\Pages;
use App\Filament\Resources\AmenityResource\RelationManagers;
use App\Models\Amenity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AmenityResource extends Resource
{
    protected static ?string $model = Amenity::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Amenidades';
    protected static ?string $navigationGroup = 'Propiedades';
    protected static ?string $breadcrumb = 'amenidades';
    protected static ?string $label = 'amenidades';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->autofocus()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->inline(false)
                            ->required(),
                        /*
                        Forms\Components\Select::make('icon_id')
                            ->relationship('icon', 'name')
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->autofocus()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('icon')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        Forms\Components\Select::make('icon_type_id')
                                            ->relationship('iconType', 'name')
                                            ->required()
                                            ->preload()
                                            ->searchable()
                                            ->createOptionForm([
                                                Forms\Components\Section::make()
                                                    ->schema([
                                                        Forms\Components\TextInput::make('name')
                                                            ->autofocus()
                                                            ->required()
                                                            ->unique()
                                                            ->maxLength(255),
                                                        Forms\Components\Toggle::make('is_active')
                                                            ->default(true)
                                                            ->label('Active')
                                                            ->inline(false)
                                                            ->required(),

                                                        Forms\Components\Textarea::make('description')
                                                            ->rows(4)
                                                            ->maxLength(65535)
                                                            ->nullable()
                                                            ->columnSpanFull(),
                                                    ])->columns(2),
                                            ]),

                                        Forms\Components\TextInput::make('icon_family')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('description')
                                            ->rows(4)
                                            ->maxLength(65535)
                                            ->nullable()
                                            ->columnSpanFull(),

                                        Forms\Components\Toggle::make('is_active')
                                            ->default(true)
                                            ->label('Active')
                                            ->required(),
                                    ])->columns(2),
                            ]),
                        */

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->rows(4)
                            ->maxLength(65535)
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
//                Tables\Columns\TextColumn::make('icon.name')
//                    ->label('Icono')
//                    ->searchable()
//                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizada')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label(''),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAmenities::route('/'),
        ];
    }
}
