<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    public function form(Form $form): Form
    {
        $permissions = \Spatie\Permission\Models\Permission::all();

        $groupedPermissions = [];

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
                            ->default('web')
                            ->searchable()
                            ->nullable(),
                    ])
                    ->columns([
                        'sm' => 2,
                        'lg' => 2,
                    ]),

                Forms\Components\Section::make('Permisos')
                    ->description('Seleccione todos los permisos necesarios para este rol.')
                    ->schema(function() use ($groupedPermissions) {
                        $sections = [];

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
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public function isReadOnly(): bool
    {
        return !(auth()->user()->hasAnyPermission([
                'crear:Roles',
                'actualizar:Roles',
                'eliminar:Roles',
            ]) || auth()->user()->hasAnyRole(['Super Admin'], 'web'));
    }

    protected function canViewAny(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['ver_todos:Roles'], 'web');
    }

    protected function canView(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['mostrar:Roles'], 'web');
    }

    protected function canCreate(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['crear:Roles'], 'web');
    }

    protected function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['actualizar:Roles'], 'web');
    }

    protected function canAttach(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['actualizar:Roles'], 'web');
    }

    protected function canDetach(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['actualizar:Roles'], 'web');
    }

    protected function canDetachAny(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['actualizar:Roles'], 'web');
    }

    protected function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['eliminar:Roles'], 'web');
    }
}
