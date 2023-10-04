<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IconResource\Pages;
use App\Filament\Resources\IconResource\RelationManagers;
use App\Models\Icon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IconResource extends Resource
{
    protected static ?string $model = Icon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
//                                            ->columnSpan(1),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageIcons::route('/'),
        ];
    }
}
