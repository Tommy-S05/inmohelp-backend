<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationLabel = 'Categorías';
    protected static ?string $navigationGroup = 'Finanzas';
    protected static ?string $breadcrumb = 'categorías';
    protected static ?string $label = 'categorías';
    protected static ?int $navigationSort = 2;


    //    protected static ?string $navigationLabel = 'Categorías';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        //                Forms\Components\TextInput::make('name')
                        //                    ->required()
                        //                    ->maxLength(255)
                        //                    ->live()
                        //                    //                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        //                    ->afterStateUpdated(function(Get $get, Set $set, ?string $old, ?string $state) {
                        //                        if(($get('slug') ?? '') !== Str::slug($old)) {
                        //                            return;
                        //                        }
                        //
                        //                        $set('slug', Str::slug($state));
                        //                    }),
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->autofocus()
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->unique(Category::class, 'slug', ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(Category::class, 'slug', ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'income' => 'Ingresos',
                                'expense' => 'Gastos',
                            ])
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('description')
                            ->label('Descripción')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->getStateUsing(fn(Category $record): string => $record->type === 'income' ? 'Ingresos' : 'Gastos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\SubCategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
