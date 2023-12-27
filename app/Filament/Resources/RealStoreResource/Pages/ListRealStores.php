<?php

namespace App\Filament\Resources\RealStoreResource\Pages;

use App\Filament\Resources\RealStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRealStores extends ListRecords
{
    protected static string $resource = RealStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
