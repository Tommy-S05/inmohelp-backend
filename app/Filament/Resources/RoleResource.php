<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Users Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        // Obtén todos los permisos de Spatie
        $permissions = \Spatie\Permission\Models\Permission::all();

        // Inicializa un array para agrupar los permisos por modelo
        $groupedPermissions = [];

        // Agrupa los permisos por modelo
        foreach ($permissions as $permission) {
            [$action, $model] = explode(':', $permission->name);
            $groupedPermissions[$model][] = $permission->name; // Guarda solo el nombre del permiso
        }

        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('guard_name')
                            ->options([
                                'web' => 'Web',
                                'api' => 'Api',
                            ])
                            ->default('web')
                            ->searchable()
                            ->nullable(),
                        Forms\Components\Toggle::make('select_all')
                            ->onIcon('heroicon-s-shield-check')
                            ->offIcon('heroicon-s-shield-exclamation')
                            ->helperText('Select all permissions')
                            ->dehydrated(false)
                            ->live(),
//                                Select::make('permissions')
//                                    ->multiple()
//                                    ->preload()
//                                    ->relationship('permissions', 'name'),
                    ])
                    ->columns([
                        'sm' => 2,
                        'lg' => 3,
                    ]),


                Forms\Components\Section::make('Permissions')
                    ->description('Select all necessary permissions for this role.')
                    ->schema(function () use ($groupedPermissions) {
                        $sections = [];
                        // Crea una sección para cada modelo
                        foreach ($groupedPermissions as $model => $modelPermissions) {
                            $sections[] = Forms\Components\Section::make($model)
                                ->description("Permissions for $model")
                                ->schema([
                                    Forms\Components\CheckboxList::make('permissions_' . $model)
                                        ->relationship('permissions', 'name')
                                        ->bulkToggleable()
                                        ->searchable()
                                        ->noSearchResultsMessage('No permissions found.')
                                        ->gridDirection('row')
                                        ->options($modelPermissions)
                                ])->columnSpan(1);
                        }
                        return $sections;
                    })
                    ->columns(3)
                    ->hidden(fn(string $operation): bool => $operation === 'view'),
//                Forms\Components\Section::make('Permissions')
//                    ->description('Select all necessary permissions for this role.')
//                    ->schema([
//                        Forms\Components\CheckboxList::make('permissions')
//                            ->relationship('permissions', 'name')
//                            ->bulkToggleable()
//                            ->columns([
//                                'sm' => 2,
//                                'lg' => 3,
//                            ])
//                            ->searchable()
//                            ->noSearchResultsMessage('No permissions found.')
//                            ->gridDirection('row')
//                    ])->hidden(fn(string $operation): bool => $operation === 'view'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->badge()
                    ->formatStateUsing(fn($state): string => Str::headline($state))
                    ->colors(['primary'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->badge()
                    ->colors(['tertiary']),
                Tables\Columns\TextColumn::make('users_count')
                    ->badge()
                    ->label('Users')
                    ->counts('users')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->badge()
                    ->label('Permissions')
                    ->counts('permissions')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
            RelationManagers\PermissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
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

//    public static function getEloquentQuery(): Builder
//    {
//        return parent::getEloquentQuery()->where('name', '!=', 'super_admin');
//    }
}
