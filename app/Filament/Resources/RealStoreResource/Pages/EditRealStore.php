<?php

namespace App\Filament\Resources\RealStoreResource\Pages;

use App\Filament\Resources\RealStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRealStore extends EditRecord
{
    protected static string $resource = RealStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
