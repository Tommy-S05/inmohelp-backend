<?php

namespace App\Filament\Resources\RoleResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Permisos')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->getStateUsing(fn(User $record): string => $record->getAllPermissions()->count()),
                Tables\Columns\TextColumn::make('username')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Activo')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Activo' => 'success',
                        'Inactivo' => 'danger',
                    })
                    ->getStateUsing(fn(User $record): string => $record->is_active ? 'Activo' : 'Inactivo'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return !(auth()->user()->hasAnyPermission([
                'crear:Usuarios',
                'actualizar:Usuarios',
                'eliminar:Usuarios',
            ]) || auth()->user()->hasAnyRole(['Super Admin'], 'web'));
    }

    protected function canViewAny(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['ver_todos:Usuarios'], 'web');
    }

    protected function canView(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['mostrar:Usuarios'], 'web');
    }

    protected function canCreate(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['crear:Usuarios'], 'web');
    }

    protected function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['actualizar:Usuarios'], 'web');
    }

    protected function canAttach(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['atachar_rol:Usuarios'], 'web');
    }

    protected function canDetach(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['detachar_rol:Usuarios'], 'web');
    }

    protected function canDetachAny(): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['detachar_todos_rol:Usuarios'], 'web');
    }

    protected function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(['Super Admin']) || auth()->user()->hasAnyPermission(['eliminar:Usuarios'], 'web');
    }
}
