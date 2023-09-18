<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
//    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.auth.edit-profile';
    protected static string $layout = 'filament-panels::components.layout.index';

    protected function hasFullWidthFormActions(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Account')
                    ->description('Give the account user data')
                    ->aside()
                    ->schema([
                        $this->getNameFormComponent(),
                        TextInput::make('username')
                            ->required()
                            ->maxLength(255),
                        $this->getEmailFormComponent(),
                    ]),
                Section::make('User Details')
                    ->description('Give the account user details')
                    ->aside()
                    ->schema([
                        TextInput::make('phone_number')
                            ->unique(ignoreRecord: true)
                            ->tel()
                            ->telRegex('/^(\+1)?[ -]?(\(809\)|\(849\)|\(829\)|809|849|829)[ -]?(\d{3})[ -]?(\d{4})$/')
                            ->maxLength(20),
                        Textarea::make('address')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),

                Section::make('Manage Password')
                    ->description('Change your password')
                    ->aside()
                    ->schema([
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
            ]);
    }
}
