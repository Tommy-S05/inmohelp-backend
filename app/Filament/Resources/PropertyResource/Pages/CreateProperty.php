<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Set;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateProperty extends CreateRecord
{
//    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['code'] = Str::upper(Str::random(6));
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Property registered')
            ->body('The property has been created successfully.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->url($this->getResource()::getUrl('view', ['record' => $this->getRecord()])),
                Action::make('undo')
                    ->color('gray')
                    ->close(),
            ]);
    }

    /*
    public function getSteps(): array
    {
        return [
            Step::make('Property Information')
                ->icon('heroicon-o-home')
                ->schema([
                    Section::make()
                        ->columns(2)
                        ->schema([
                            TextInput::make('name')
                                ->autofocus()
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state)))
                                ->maxLength(255),
                            TextInput::make('slug')
                                ->required()
                                ->disabled()
                                ->maxLength(255),

                            Select::make('property_type_id')
                                ->relationship('propertyType', 'name')
                                ->required()
                                ->preload()
                                ->searchable()
                                ->native(false)
                                ->createOptionForm([
                                    Section::make()
                                        ->columns(2)
                                        ->schema([
                                            TextInput::make('name')
                                                ->autofocus()
                                                ->required()
                                                ->maxLength(255)
                                                ->live(onBlur: true)
                                                ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                            TextInput::make('slug')
                                                ->disabled()
                                                ->dehydrated()
                                                ->required()
                                                ->maxLength(255),
                                            Textarea::make('description')
                                                ->rows(4)
                                                ->maxLength(65535)
                                                ->nullable()
                                                ->columnSpanFull(),
                                            Toggle::make('is_active')
                                                ->default(true)
                                                ->label('Active')
                                                ->required(),
                                        ])
                                ]),


                        ])
                ])
        ];
    }
    */
}
