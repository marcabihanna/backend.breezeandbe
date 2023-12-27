<?php

namespace App\Filament\Resources\RealStoreResource\Pages;

use App\Filament\Resources\RealStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRealStore extends ViewRecord
{
    protected static string $resource = RealStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
