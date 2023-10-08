<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    //    protected static ?string $slug = 'users';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Users Management';
    protected static ?int $navigationSort = 0;


    public static function form(Form $form): Form
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
                Forms\Components\Section::make('User Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->unique(User::class, 'email', ignoreRecord: true)
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('username')
                            ->unique(User::class, 'username', ignoreRecord: true)
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->telRegex('/^(\+1)?[ -]?(\(809\)|\(849\)|\(829\)|809|849|829)[ -]?(\d{3})[ -]?(\d{4})$/')
                            //                            ->telRegex('/^[+][1-9]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\.\/0-9]*$/')
                            //                            ->telRegex('/^(\+1)?[ -]?(\([2-9]\d{2}\)|[2-9]\d{2})[ -]?(\d{3})[ -]?(\d{4})$/')
                            //                            ->telRegex('/^(\+1)?[ -]?(809|829|849)[ -]?(\d{3})[ -]?(\d{4})$/')
                            ->maxLength(20),

                        //                    Forms\Components\TextInput::make('photo')
                        //                        ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn(Model $record): int => $record->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin') ? 3 : 2]),

                Forms\Components\Section::make('Manage Password')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label(fn(string $operation): string => match ($operation) {
                                'create' => 'Password',
                                'edit' => 'New Password',
                            })
                            ->password()
                            ->live(debounce: 250)
                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                            ->rule(Password::default())
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label(fn(string $operation): string => match ($operation) {
                                'create' => 'Confirm Password',
                                'edit' => 'Confirm New Password',
                            })
                            ->password()
                            ->visible(fn(Get $get): bool => filled($get('password')))
                            ->required(fn(Get $get): bool => filled($get('password')))
                            ->requiredWith('password')
                            ->same('password')
                            ->maxLength(255),

                        //                        Forms\Components\TextInput::make('new_password')
                        //                            ->password()
                        ////                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        //                            ->rule(Password::default())
                        //                            ->maxLength(255),
                        //                        Forms\Components\TextInput::make('new_password_confirmation')
                        //                            ->password()
                        //                            ->requiredWith('new_password')
                        //                            ->same('new_password')
                        //                            ->maxLength(255),
                    ])
                    ->hidden(fn(Model $record): bool => $record->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin'))
                    ->columns(1)
                    ->columnSpan(['lg' => 1])
                    ->heading(fn(string $operation): string => match ($operation) {
                        'create' => 'Manage Password',
                        'edit' => 'Change Password',
                    }),

                Tabs::make('Roles & Permissions')
                    ->tabs([
                        Tabs\Tab::make('Roles')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->description('Select all necessary roles for this user.')
                                    ->schema([
                                        Forms\Components\CheckboxList::make('roles')
                                            ->relationship('roles', 'name')
                                            ->getOptionLabelFromRecordUsing(fn(Model $record) => Str::headline($record->name))
                                            ->bulkToggleable()
                                            ->live()
                                            ->columns([
                                                'sm' => 2,
                                                'lg' => 3,
                                            ])
                                            ->gridDirection('row')
                                    ])
                                    ->compact()
                            ]),
                        Tabs\Tab::make('Permissions')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->description('Select all necessary permissions for this role.')
                                    ->schema(function() use ($groupedPermissions) {
                                        $sections = [];

                                        foreach($groupedPermissions as $model => $modelPermissions) {

                                            $formattedPermissions = array_map(function($permission) {
                                                return Str::headline($permission['name']);
                                            }, $modelPermissions);

                                            $sections[] = Forms\Components\Section::make($model)
                                                ->description("Permissions for $model")
                                                ->schema([
                                                    Forms\Components\CheckboxList::make('permissions')
                                                        ->hiddenLabel()
                                                        ->relationship('permissions', 'name')
                                                        ->bulkToggleable()
                                                        ->searchable()
                                                        ->noSearchResultsMessage('No permissions found.')
                                                        ->gridDirection('row')
                                                        ->options(array_combine(
                                                            array_column($modelPermissions, 'id'),
                                                            $formattedPermissions
                                                        ))
                                                ])->columnSpan(1);
                                        }
                                        return $sections;
                                    })
                                    ->compact()
                                    ->columns(3)

                            ]),
                    ])
                    //                    ->visible(fn(string $operation): bool => $operation === 'create')
                    ->hidden(fn(string $operation): bool => $operation === 'view' && !(auth()->user()->hasAnyRole(['Super Admin'], 'web') || auth()->user()->hasAnyPermission(['update:Role'], 'web')))
                    ->contained(true)
                    //                    ->persistTabInQueryString()
                    ->columnSpanFull(),

                //                Forms\Components\Grid::make()
                //                    ->schema([
                //                        Forms\Components\Section::make('Roles')
                //                            ->description('Select all necessary roles for this user.')
                //                            ->schema([
                //                                Forms\Components\CheckboxList::make('roles')
                //                                    ->relationship('roles', 'name')
                //                                    ->bulkToggleable()
                //                                    ->live()
                //                                    ->columns([
                //                                        'sm' => 2,
                //                                        'lg' => 3,
                //                                    ])
                //                                    ->gridDirection('row')
                //                            ])
                //                            ->columnSpan(1)
                //                            ->hidden(fn(string $operation): bool => $operation === 'view'),
                //
                //                        Forms\Components\Section::make('Permissions')
                //                            ->description('Select all necessary permissions for this role.')
                //                            ->schema([
                //                                Forms\Components\CheckboxList::make('permissions')
                //                                    ->relationship('permissions', 'name')
                //                                    ->bulkToggleable()
                //                                    ->columns([
                //                                        'sm' => 2,
                //                                        'lg' => 3,
                //                                    ])
                //                                    ->gridDirection('row')
                //                            ])
                //                            ->columnSpan(1)
                //                            ->hidden(fn(string $operation): bool => $operation === 'view'),
                //                    ])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                //Put the User role in the table
                Tables\Columns\TextColumn::make('roles')
                    ->label('Role')
                    //                    ->sortable()
                    //                    ->searchable()
                    //                    ->getStateUsing(fn(User $record): string => $record->roles->pluck('name')->join(', '))
                    //                    ->getStateUsing(function (User $record): string {
                    //                        $roleNames = $record->roles->pluck('name')->toArray();
                    //                        return implode(', ', array_map(fn($roleName) => Str::headline($roleName), $roleNames));
                    //                    })
                    ->getStateUsing(function(User $record): string {
                        if($record->hasRole('Super Admin')) {
                            return Str::headline('Super Admin');
                        } elseif($record->hasRole('Admin')) {
                            return Str::headline('Admin');
                        } elseif($record->roles->count() > 0) {
                            return Str::headline($record->getRoleNames()->first());
                        } else {
                            return 'Sin Rol';
                        }
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Super Admin' => 'primary',
                        'Admin' => 'secondary',
                        'User' => 'tertiary',
                        'Sin Rol' => 'danger',
                        default => 'warning'
                    }),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Permissions')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->getStateUsing(fn(User $record): string => $record->getAllPermissions()->count()),
                Tables\Columns\TextColumn::make('username')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                //                Tables\Columns\TextColumn::make('email_verified_at')
                //                    ->dateTime()
                //                    ->sortable()
                //                    ->toggleable(isToggledHiddenByDefault: true),
                //                Tables\Columns\TextColumn::make('photo')
                //                    ->searchable(),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Active')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Activo' => 'success',
                        'Inactivo' => 'danger',
                    })
                    ->getStateUsing(fn(User $record): string => $record->is_active ? 'Activo' : 'Inactivo'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('Deleted users'),
                Tables\Filters\SelectFilter::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->preload()
                    ->relationship('roles', 'name')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('User Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->icon('heroicon-m-user')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextEntry\TextEntrySize::Medium),
                                TextEntry::make('email')
                                    ->icon('heroicon-m-envelope')
                                    ->size(TextEntry\TextEntrySize::Medium)->weight(FontWeight::Bold),
                                TextEntry::make('username')
                                    ->icon('heroicon-m-at-symbol'),
                                TextEntry::make('phone_number')
                                    ->icon('heroicon-m-phone')
                                    ->default('(xxx) xxx-xxxx'),
                            ]),
                    ])
                    ->columnSpan(['lg' => fn(?User $record) => $record === null ? 3 : 2]),
                Section::make()
                    ->schema([
                        IconEntry::make('is_active')
                            ->columnSpanFull()
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->since(),
                        TextEntry::make('updated_at')
                            ->since(),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn(?User $record) => $record === null),

            ])->columns(3);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RolesRelationManager::class,
            RelationManagers\PermissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'secondary';
    }

    public static function canDelete(Model $record): bool
    {
        return $record->id !== auth()->user()->id;
    }
}
