<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use App\Models\PropertyType;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $letters = PropertyType::select('code')->where('id', $data['property_type_id'])->first();
        $code = Str::upper($letters->code) . rand(1000, 9999);
        $data['code'] = $code;
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Cancel')
                ->icon('heroicon-o-arrow-left')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray'),
        ];
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

    public function hasSkippableSteps(): bool
    {
        return true;
    }

    public function getSteps(): array
    {
        return [
            PropertyResource::getPropertyInformationWizard(),

            PropertyResource::getPropertyLocationWizard(),

            PropertyResource::getPropertyAmenitiesWizard(),

            PropertyResource::getPropertyGalleryWizard(),

            PropertyResource::getPropertyStatusWizard()
        ];
    }

}
