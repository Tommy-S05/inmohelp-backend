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
    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $navigationGroup = 'Gestión de Usuarios';
    protected static ?string $breadcrumb = 'roles';
    protected static ?string $label = 'roles';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        // Obtén todos los permisos de Spatie
        $permissions = \Spatie\Permission\Models\Permission::all();

        // Inicializa un array para agrupar los permisos por modelo
        $groupedPermissions = [];

        // Agrupa los permisos por modelo
        foreach($permissions as $permission) {
            [$action, $model] = explode(':', $permission->name);
            $groupedPermissions[$model][] = [
                'id' => $permission->id,
                'name' => $permission->name,
            ];
        }

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

                Forms\Components\Section::make('Permisos')
                    ->description('Seleccione todos los permisos necesarios para este rol.')
                    ->schema(function() use ($groupedPermissions) {
                        $sections = [];
                        // Crea una sección para cada modelo
                        foreach($groupedPermissions as $model => $modelPermissions) {

                            $formattedPermissions = array_map(function($permission) {
                                return Str::headline($permission['name']);
                            }, $modelPermissions);

                            $sections[] = Forms\Components\Section::make($model)
                                ->description("Permisos para $model")
                                ->schema([
                                    Forms\Components\CheckboxList::make('permissions')
                                        ->label('Permisos')
                                        ->relationship('permissions', 'name')
                                        ->bulkToggleable()
                                        ->searchable()
                                        ->noSearchResultsMessage('No permissions found.')
                                        ->gridDirection('row')
                                        ->options(array_combine(
                                            array_column($modelPermissions, 'id'), // Utiliza los IDs como claves
                                            $formattedPermissions // Utiliza los nombres formateados como valores
                                        ))
                                ])->columnSpan(1);
                        }
                        return $sections;
                    })
                    ->collapsible()
                    ->collapsed(true)
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
                    ->label('Users')
                    ->counts('users')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Permisos')
                    ->badge()
                    ->label('Permissions')
                    ->counts('permissions')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
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
