<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $permissions = \Spatie\Permission\Models\Permission::all();
        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            [$action, $model] = explode(':', $permission->name);
            $groupedPermissions[$model][] = [
                'id' => $permission->id,
                'name' => $permission->name,
            ];
        }

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
                    Textarea::make('address')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])->columns(2),

            Step::make('Roles & Permissions')
                ->description('User roles and permissions')
                ->schema([
                    Tabs::make('Roles & Permissions')
                        ->tabs([
                            Tabs\Tab::make('Roles')
                                ->schema([
                                    Section::make()
                                        ->description('Select all necessary roles for this user.')
                                        ->schema([
                                            CheckboxList::make('roles')
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
                                ]),

                            Tabs\Tab::make('Permissions')
                                ->schema([
                                    Section::make()
                                        ->description('Select all necessary permissions for this role.')
                                        ->schema(function () use ($groupedPermissions) {
                                            $sections = [];

                                            foreach ($groupedPermissions as $model => $modelPermissions) {

                                                $formattedPermissions = array_map(function ($permission) {
                                                    return Str::headline($permission['name']);
                                                }, $modelPermissions);

                                                $sections[] = Section::make($model)
                                                    ->description("Permissions for $model")
                                                    ->schema([
                                                        CheckboxList::make('permissions')
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
                                        ->columns(3)

                                ]),
                        ])
                        ->hidden(fn(string $operation): bool => $operation === 'view')
//                        ->contained(false)
                        ->columnSpanFull(),

                ])->columns(4),
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
