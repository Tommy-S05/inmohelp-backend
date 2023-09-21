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

        foreach ($permissions as $permission) {
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
                    ])
                    ->columns([
                        'sm' => 2,
                        'lg' => 2,
                    ]),

                Forms\Components\Section::make('Permissions')
                    ->description('Select all necessary permissions for this role.')
                    ->schema(function () use ($groupedPermissions) {
                        $sections = [];

                        foreach ($groupedPermissions as $model => $modelPermissions) {

                            $formattedPermissions = array_map(function ($permission) {
                                return Str::headline($permission['name']);
                            }, $modelPermissions);

                            $sections[] = Forms\Components\Section::make($model)
                                ->description("Permissions for $model")
                                ->schema([
                                    Forms\Components\CheckboxList::make('permissions')
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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
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
                'create:Role',
                'update:Role',
                'delete:Role',
            ]) || auth()->user()->hasRole('super_admin'));
    }

    protected function canView(Model $record): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('view:Role', 'web');
    }

    protected function canViewAny(): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('view_any:Role', 'web');
    }

    protected function canCreate(): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('create:Role', 'web');
    }

    protected function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('update:Role', 'web');
    }

    protected function canAttach(): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('update:Role', 'web');
    }

    protected function canDetach(Model $record): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('update:Role', 'web');
    }

    protected function canDetachAny(): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('update:Role', 'web');
    }

    protected function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(['super_admin']) || auth()->user()->hasPermissionTo('delete:Role', 'web');
    }
}
