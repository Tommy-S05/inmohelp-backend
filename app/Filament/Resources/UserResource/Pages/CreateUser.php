<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class CreateUser extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.')
            ->actions([
                Action::make('view')
                    ->button()
//                    ->url(route('filament.admin.resources.users.view', $this->record->id)),
                    ->url($this->getResource()::getUrl('view', ['record' => $this->getRecord()])),
                Action::make('undo')
                    ->color('gray')
                    ->close(),
            ]);
    }

    protected function getSteps(): array
    {
        return [
            Step::make('User Account')
                ->description('Give the account user data')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->unique(User::class, 'email', ignoreRecord: true)
                        ->email()
                        ->required()
                        ->maxLength(255),

                    TextInput::make('username')
                        ->unique(User::class, 'username', ignoreRecord: true)
                        ->required()
                        ->maxLength(255),
                ]),
            Step::make('User Details')
                ->description('User personal information')
                ->schema([
                    TextInput::make('phone_number')
                        ->tel()
                        ->telRegex('/^(\+1)?[ -]?(\(809\)|\(849\)|\(829\)|809|849|829)[ -]?(\d{3})[ -]?(\d{4})$/')
                        ->maxLength(20),
                    Toggle::make('is_active')
                        ->default(true)
                        ->label('Active')
                        ->inline(false)
                        ->required(),
                    Select::make('roles')
                        ->multiple()
                        ->preload()
                        ->relationship('roles', 'name'),
                    Select::make('permissions')
                        ->multiple()
                        ->preload()
                        ->relationship('permissions', 'name'),
                    Textarea::make('address')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])->columns(2),
            Step::make('Manage Password')
                ->description('Set the account password')
                ->schema([
                    TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        ->rule(Password::default())
                        ->dehydrated(fn(?string $state): bool => filled($state))
                        ->required(fn(string $operation): bool => $operation === 'create')
                        ->maxLength(255),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->requiredWith('password')
                        ->same('password')
                        ->maxLength(255),
                ]),
        ];
    }
}
