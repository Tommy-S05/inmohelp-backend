<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers;
use App\Models\Permission;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?string $navigationLabel = 'Permisos';
    protected static ?string $navigationGroup = 'Gestión de Usuarios';
    protected static ?string $breadcrumb = 'permisos';
    protected static ?string $label = 'permisos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->autofocus()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('guard_name')
                            ->label('Guard')
                            ->disabled()
                            ->options([
                                'web' => 'Web',
                                'api' => 'Api',
                            ])
                            ->default('web'),
                    ])
                    ->columns([
                        'sm' => 2,
                        'lg' => 2,
                    ]),

                Section::make('Roles')
                    ->label('Roles')
                    ->description('Seleccione todos los roles necesarios para este permiso.')
                    ->schema([
                        CheckboxList::make('roles')
                            ->label('Roles')
                            ->relationship('roles', 'name')
                            ->getOptionLabelFromRecordUsing(fn(Model $record) => Str::headline($record->name))
                            ->bulkToggleable()
                            ->live()
                            ->columns([
                                'sm' => 2,
                                'lg' => 3,
                            ])
                            ->gridDirection('row')
                    ])->collapsed(fn(string $operation): bool => !($operation === 'create')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->badge()
                    ->formatStateUsing(fn($state): string => Str::headline($state))
                    ->colors(['primary'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label('Guard')
                    ->badge()
                    ->colors(['tertiary']),
                Tables\Columns\TextColumn::make('users_count')
                    ->label('Usuarios')
                    ->badge()
                    //                    ->counts('users')
                    ->getStateUsing(function(Permission $record): int {
                        return User::whereHas('roles.permissions', function($query) use ($record) {
                            $query->where('permissions.id', $record->id);
                        })->orWhereHas('permissions', function($query) use ($record) {
                            $query->where('permissions.id', $record->id);
                        })->distinct()->count();
                    })
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('roles_count')
                    ->label('Roles')
                    ->badge()
                    ->counts('roles')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            RelationManagers\UsersRelationManager::class,
            RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'view' => Pages\ViewPermission::route('/{record}'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
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
