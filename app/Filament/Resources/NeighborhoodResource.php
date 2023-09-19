<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NeighborhoodResource\Pages;
use App\Filament\Resources\NeighborhoodResource\RelationManagers;
use App\Models\Neighborhood;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NeighborhoodResource extends Resource
{
    protected static ?string $model = Neighborhood::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Territories';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('municipality_id')
                            ->relationship('municipality', 'name')
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
                                        Forms\Components\Select::make('province_id')
                                            ->relationship('province', 'name')
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
                                                        Forms\Components\Select::make('region_id')
                                                            ->relationship('region', 'name')
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
                                                                    ])
                                                            ])->createOptionModalHeading('Create region'),
                                                    ])->columns(2),
                                            ])->createOptionModalHeading('Create province'),
                                    ])->columns(2),
                            ])->createOptionModalHeading('Create municipality'),

                        Forms\Components\TextInput::make('average_price')
                            ->numeric()
                            ->required()
                            ->inputMode('float')
                            ->minValue(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipality.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('average_price')
                    ->numeric(
                        decimalPlaces: 2,
                        decimalSeparator: '.',
                        thousandsSeparator: ',',
                    )
                    ->money('dop')
                    ->badge()
                    ->color(function ($state): string {
                        if ($state > 7000) return 'danger';
                        elseif ($state > 4000) return 'warning';
                        return 'success';
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->toggledHiddenByDefault(false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNeighborhoods::route('/'),
            'view' => Pages\ViewNeighborhood::route('/{record}'),
            'edit' => Pages\EditNeighborhood::route('/{record}/edit'),
        ];
    }
}
