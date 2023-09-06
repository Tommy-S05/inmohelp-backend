<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
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
                    ])->columns(2),

                Forms\Components\Section::make('Manage Password')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                            ->rule(Password::default())
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
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
                    ])->columns(1),
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
