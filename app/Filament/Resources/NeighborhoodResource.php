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
use Illuminate\Support\Carbon;

class NeighborhoodResource extends Resource
{
    protected static ?string $model = Neighborhood::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Sectores';
    protected static ?string $navigationGroup = 'Territorios';
    protected static ?string $breadcrumb = 'sectores';
    protected static ?string $label = 'sectores';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('municipality_id')
                            ->label('Municipio')
                            ->relationship('municipality', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nombre')
                                            ->autofocus()
                                            ->required()
                                            ->unique()
                                            ->maxLength(255),
                                        Forms\Components\Select::make('province_id')
                                            ->label('Provincia')
                                            ->relationship('province', 'name')
                                            ->required()
                                            ->preload()
                                            ->searchable()
                                            ->createOptionForm([
                                                Forms\Components\Section::make()
                                                    ->schema([
                                                        Forms\Components\TextInput::make('name')
                                                            ->label('Nombre')
                                                            ->autofocus()
                                                            ->required()
                                                            ->unique()
                                                            ->maxLength(255),
                                                        Forms\Components\Select::make('region_id')
                                                            ->label('Región')
                                                            ->relationship('region', 'name')
                                                            ->required()
                                                            ->preload()
                                                            ->searchable()
                                                            ->createOptionForm([
                                                                Forms\Components\Section::make()
                                                                    ->schema([
                                                                        Forms\Components\TextInput::make('name')
                                                                            ->label('Nombre')
                                                                            ->autofocus()
                                                                            ->required()
                                                                            ->unique()
                                                                            ->maxLength(255),
                                                                    ])
                                                            ])->createOptionModalHeading('Crear región'),
                                                    ])->columns(2),
                                            ])->createOptionModalHeading('Crear provincia'),
                                    ])->columns(2),
                            ])->createOptionModalHeading('Crear municipio'),

                        Forms\Components\TextInput::make('average_price')
                            ->label('Indice de precio')
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
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipality.name')
                    ->label('Municipio')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('average_price')
                    ->label('Indice de precio')
                    ->numeric(
                        decimalPlaces: 2,
                        decimalSeparator: '.',
                        thousandsSeparator: ',',
                    )
                    ->money('dop')
                    ->badge()
                    ->color(function($state): string {
                        if($state > 20000) return 'danger';
                        elseif($state > 10000) return 'warning';
                        return 'success';
                    })
                    //                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    //                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->toggledHiddenByDefault(false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('municipality')
                    ->label('Municipio')
                    ->relationship('municipality', 'name')
                    ->placeholder('All Municipalities')
                    ->multiple()
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('updated_at')
                    ->label('Actualizado')
                    ->form([
                        Forms\Components\DateTimePicker::make('updated_from')->label('Actualizado desde'),
                        Forms\Components\DateTimePicker::make('updated_until')->label('Actualizado hasta'),
                    ])
                    ->query(function(Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['updated_from'],
                                fn(Builder $query, $date): Builder => $query->where('updated_at', '>=', $date),
                            )
                            ->when(
                                $data['updated_until'],
                                fn(Builder $query, $date): Builder => $query->where('updated_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function(array $data): array {
                        $indicators = [];

                        if($data['updated_from'] ?? null) {
                            $indicators['updated_from'] = 'Updated from ' . Carbon::parse($data['updated_from'])->format('d-m-Y H:i:s');
                        }

                        if($data['updated_until'] ?? null) {
                            $indicators['updated_until'] = 'Updated until ' . Carbon::parse($data['updated_until'])->format('d-m-Y H:i:s');
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Eliminar'),
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
        ];
    }
}
