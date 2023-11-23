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

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Cancelar')
                ->icon('heroicon-o-arrow-left')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $letters = PropertyType::select('code')->where('id', $data['property_type_id'])->first();
        $code = Str::upper($letters->code) . rand(1000, 9999);
        $data['code'] = $code;
        $data['user_id'] = auth()->id();

        return $data;
    }

    //    protected function afterCreate(): void
    //    {
    //        if ($this->data['images']) {
    //            foreach ($this->data['images'] as $uuid => $image) {
    //                $this->record->images()->create([
    //                    'image' => $image
    //                ]);
    //            }
    //        }
    //    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Propiedad creada')
            ->body('La propiedad se ha creado correctamente.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->url($this->getResource()::getUrl('Ver', ['record' => $this->getRecord()])),
                Action::make('cerrar')
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
