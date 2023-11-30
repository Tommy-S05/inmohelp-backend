<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Todos' => ListRecords\Tab::make(),
            'Esta semana' => ListRecords\Tab::make()
//                ->modifyQueryUsing(fn(Builder $query): Builder => $query->where('created_at', '>=', now()->subWeek())),
                ->query(fn($query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
                ->badge(User::query()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()),
            'Este mes' => ListRecords\Tab::make()
                ->query(fn($query) => $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]))
                ->badge(User::query()->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count()),
            'Este año' => ListRecords\Tab::make()
                ->query(fn($query) => $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]))
                ->badge(User::query()->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->count()),


//            'Super Admins' => ListRecords\Tab::make()
//                ->query(function ($query) {
//                    $query->whereHas('roles', function ($query) {
//                        $query->where('name', 'super_admin');
//                    });
//                }),
//            'Admins' => ListRecords\Tab::make()
//                ->query(function ($query) {
//                    $query->whereHas('roles', function ($query) {
//                        $query->where('name', 'admin');
//                    });
//                }),
        ];
    }
}
