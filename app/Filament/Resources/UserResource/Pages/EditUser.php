<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
//    protected function getRedirectUrl(): string
//    {
//        return $this->getResource()::getUrl('index');
//    }

//    public function mutateFormDataBeforeSave(array $data): array
//    {
//        if (array_key_exists('new_password', $data) && filled($data['new_password'])) {
//            $this->record->password = Hash::make($data['new_password']);
////            $data['password'] = Hash::make($data['new_password']);
//        }
//        return $data;
//    }
}
