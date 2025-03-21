<?php

namespace App\Filament\Resources\RoleResource\RelationManagers;

use App\Models\Permission;
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

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    public function form(Form $form): Form
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label('Guard')
                    ->badge()
                    ->colors(['tertiary']),
                Tables\Columns\TextColumn::make('roles_count')
                    ->label('Roles')
                    ->badge()
                    ->label('Roles')
                    ->counts('roles')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
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
                'crear:Permisos',
                'actualizar:Permisos',
                'eliminar:Permisos',
            ]) || auth()->user()->hasAnyRole(['Super Admin'], 'web'));
    }

    protected function canViewAny(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['ver_todos:Permisos'], 'web');
    }

    protected function canView(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['mostrar:Permisos'], 'web');
    }

    protected function canCreate(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['crear:Permisos'], 'web');
    }

    protected function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['actualizar:Permisos'], 'web');
    }

    protected function canAttach(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['atachar_rol:Permisos'], 'web');
    }

    protected function canDetach(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['detachar_rol:Permisos'], 'web');
    }

    protected function canDetachAny(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['detachar_todos_rol:Permisos'], 'web');
    }

    protected function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['eliminar:Permisos'], 'web');
    }
}
