<?php

namespace App\Filament\Resources\IconTypeResource\Pages;

use App\Filament\Resources\IconTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIconTypes extends ManageRecords
{
    protected static string $resource = IconTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
