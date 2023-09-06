<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
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
    //                    Forms\Components\TextInput::make('username')
    //                        ->unique(User::class, 'username', ignoreRecord: true)
    //                        ->required()
    //                        ->maxLength(255),
    //                    Forms\Components\TextInput::make('phone_number')
    //                        ->tel()
    //                        ->maxLength(20),
    //                    Forms\Components\DateTimePicker::make('email_verified_at'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->visible(fn($livewire) => $livewire instanceof CreateUser)
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->rule(Password::default())
    //                        ->dehydrated(fn (?string $state): bool => filled($state))
    //                        ->required(fn (string $operation): bool => $operation === 'create')
                            ->maxLength(255),
    //                    Forms\Components\TextInput::make('photo')
    //                        ->maxLength(255),
    //                    Forms\Components\Textarea::make('address')
    //                        ->maxLength(65535)
    //                        ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Change Password')
                    ->schema([
                        Forms\Components\TextInput::make('new_password')
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->rule(Password::default())
                            ->maxLength(255),
                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->password()
                            ->requiredWith('new_password')
                            ->same('new_password')
                            ->maxLength(255),
                    ])->columns(1)->visible(fn($livewire) => $livewire instanceof EditUser),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            //
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
}
